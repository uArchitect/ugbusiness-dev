<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api2 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_setHeaders();
        date_default_timezone_set('Europe/Istanbul');
        
        // CORS preflight (OPTIONS) isteğini handle et
        if ($this->input->method(true) === 'OPTIONS') {
            http_response_code(200);
            exit;
        }


      
    }

    /** Genel response çıktısı için yardımcı fonksiyon */
    private function jsonResponse($data, $status = 200)
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }

    /** CORS ve header ayarları */
    private function _setHeaders()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    }

    /** Test endpoint */
    public function test()
    {
        $method = $this->input->method(true);
        $input_data = in_array($method, ['POST', 'PUT'])
            ? json_decode(file_get_contents('php://input'), true) ?? []
            : $this->input->get();

        $response = [
            'status'      => 'success',
            'message'     => 'API2 test endpoint çalışıyor!',
            'timestamp'   => date('Y-m-d H:i:s'),
            'method'      => $method,
            'input_data'  => $input_data,
            'server_info' => [
                'php_version'  => phpversion(),
                'server_time'  => date('Y-m-d H:i:s'),
                'timezone'     => date_default_timezone_get()
            ]
        ];

        $this->jsonResponse($response);
    }

    /** 1. Yemek Listesi */
    public function yemek_listesi()
    {
        $this->load->model('Yemek_model');
        $bugun_no = date("d");
        $data = [
            'status'       => 'success',
            'bugun_yemek'  => ($yemek = $this->Yemek_model->get_by_id($bugun_no)) ? $yemek[0] : null,
            'tum_yemekler' => $this->Yemek_model->get_all(),
            'tarih'        => date('Y-m-d'),
            'gun_no'       => $bugun_no
        ];
        $this->jsonResponse($data);
    }



    public function izin()
    {
        $this->load->model('Izin_model');
        
        $izinler = $this->db
            ->select('izin_talepleri.*, kullanicilar.kullanici_ad_soyad as talep_eden_ad_soyad, izin_nedenleri.izin_neden_detay')
            ->from('izin_talepleri')
            ->join('kullanicilar', 'kullanicilar.kullanici_id = izin_talepleri.izin_talep_eden_kullanici_id', 'left')
            ->join('izin_nedenleri', 'izin_nedenleri.izin_neden_id = izin_talepleri.izin_neden_no', 'left')
            ->order_by('izin_talepleri.izin_talep_id', 'DESC')
            ->get()->result();

        $nedenler = $this->db->get("izin_nedenleri")->result();

        $data = [
            'status'        => 'success',
            'izinler'       => $izinler,
            'nedenler'      => $nedenler,
            'toplam_kayit'  => count($izinler),
            'timestamp'     => date('Y-m-d H:i:s')
        ];
        $this->jsonResponse($data);
    }

    /** 4. Önemli Günler */
    public function onemli_gun()
    {
        $bugun           = date("Y-m-d");
        $sonra           = date("Y-m-d", strtotime("+45 days"));
        $gunlerTable     = $this->db->order_by("onemli_gun_tarih", "asc")->get("onemli_gunler");
        $tum_gunler      = $gunlerTable->result();
        $yaklasan_gunler = $this->db
            ->where("onemli_gun_tarih >=", $bugun)
            ->where("onemli_gun_tarih <=", $sonra)
            ->order_by("onemli_gun_tarih", "asc")
            ->get("onemli_gunler")->result();
        $etkinlikler     = $this->db
            ->where("etkinlik_mi", 1)
            ->order_by("onemli_gun_tarih", "asc")
            ->get("onemli_gunler")->result();

        $data = [
            'status'          => 'success',
            'tum_gunler'      => $tum_gunler,
            'yaklasan_gunler' => $yaklasan_gunler,
            'etkinlikler'     => $etkinlikler,
            'bugun'           => $bugun,
            'toplam_kayit'    => count($tum_gunler),
            'timestamp'       => date('Y-m-d H:i:s')
        ];
        $this->jsonResponse($data);
    }

    /** 5. Authentication - Giriş */
    public function auth()
    {
        $method = $this->input->method(true);
        
        // Sadece POST isteklerini kabul et
        if ($method !== 'POST') {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Sadece POST metodu kabul edilir.'
            ], 405);
        }

        // JSON input al
        $input_data = json_decode(file_get_contents('php://input'), true) ?? [];
        
        // E-posta ve şifre kontrolü
        if (empty($input_data['email']) || empty($input_data['password'])) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'E-posta ve şifre gereklidir.'
            ], 400);
        }

        $email = strip_tags(trim($this->security->xss_clean($input_data['email'])));
        $password = strip_tags(trim($this->security->xss_clean($input_data['password'])));
        
        // Kullanıcı kontrolü
        $kullanici = $this->db
            ->where([
                'kullanici_email_adresi' => $email,
                'kullanici_sifre' => base64_encode($password),
                'kullanici_aktif' => 1
            ])
            ->join('departmanlar', 'departmanlar.departman_id = kullanicilar.kullanici_departman_id', 'left')
            ->join('kullanici_gruplari', 'kullanici_gruplari.kullanici_grup_id = kullanicilar.kullanici_grup_no', 'left')
            ->get("kullanicilar")
            ->row();

        if (!$kullanici) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'E-posta veya şifre hatalı.'
            ], 401);
        }

        // Kullanıcı bilgilerini hazırla (şifreyi çıkar)
        $kullanici_data = [
            'kullanici_id' => $kullanici->kullanici_id,
            'kullanici_ad_soyad' => $kullanici->kullanici_ad_soyad,
            'kullanici_email_adresi' => $kullanici->kullanici_email_adresi,
            'kullanici_adi' => $kullanici->kullanici_adi,
            'kullanici_unvan' => $kullanici->kullanici_unvan ?? null,
            'kullanici_dahili_iletisim_no' => $kullanici->kullanici_dahili_iletisim_no ?? null,
            'kullanici_bireysel_iletisim_no' => $kullanici->kullanici_bireysel_iletisim_no ?? null,
            'kullanici_resim' => $kullanici->kullanici_resim ?? null,
            'departman' => [
                'departman_id' => $kullanici->departman_id ?? null,
                'departman_adi' => $kullanici->departman_adi ?? null
            ],
            'grup' => [
                'kullanici_grup_id' => $kullanici->kullanici_grup_id ?? null,
                'kullanici_grup_adi' => $kullanici->kullanici_grup_adi ?? null
            ],
            'kullanici_yonetici_kullanici_id' => $kullanici->kullanici_yonetici_kullanici_id ?? null,
            'kullanici_api_pc_key' => $kullanici->kullanici_api_pc_key ?? null
        ];

        $this->jsonResponse([
            'status'  => 'success',
            'message' => 'Giriş başarılı.',
            'user'    => $kullanici_data,
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }

    /** 6. Kurumsal İletişim (Rehber) */
    public function kurumsal_iletisim()
    {
        // Kurumsal iletişim (Rehber) bilgilerini getir
        $rehber_kullanicilar = $this->db
            ->select('kullanicilar.kullanici_id, kullanicilar.kullanici_ad_soyad, kullanicilar.kullanici_unvan, kullanicilar.kullanici_bireysel_iletisim_no, kullanicilar.kullanici_dahili_iletisim_no, kullanicilar.kullanici_resim, kullanicilar.kullanici_email_adresi, departmanlar.departman_adi, kullanici_gruplari.kullanici_grup_adi')
            ->from('kullanicilar')
            ->where('kullanicilar.kullanici_aktif', 1)
            ->where('kullanicilar.kullanici_departman_id !=', 19)
            ->where('kullanicilar.rehberde_goster', 1)
            ->where('kullanicilar.kullanici_bireysel_iletisim_no !=', '')
            ->where('kullanicilar.kullanici_bireysel_iletisim_no !=', '0000 000 00 00')
            ->join('departmanlar', 'departmanlar.departman_id = kullanicilar.kullanici_departman_id', 'left')
            ->join('kullanici_gruplari', 'kullanici_gruplari.kullanici_grup_id = kullanicilar.kullanici_grup_no', 'left')
            ->order_by('kullanicilar.rehber_sira_no', 'ASC')
            ->get()
            ->result();

        // Rehber kullanıcılarını formatla
        $kurumsal_iletisim = [];
        foreach ($rehber_kullanicilar as $rehber_kullanici) {
            $kurumsal_iletisim[] = [
                'kullanici_ad_soyad' => $rehber_kullanici->kullanici_ad_soyad,
                'kullanici_unvan' => $rehber_kullanici->kullanici_unvan ?? null,
                'kullanici_bireysel_iletisim_no' => $rehber_kullanici->kullanici_bireysel_iletisim_no ?? null,
                'kullanici_dahili_iletisim_no' => $rehber_kullanici->kullanici_dahili_iletisim_no ?? null,
                'kullanici_email_adresi' => $rehber_kullanici->kullanici_email_adresi ?? null,
                'kullanici_resim' => $rehber_kullanici->kullanici_resim ? base_url("uploads/{$rehber_kullanici->kullanici_resim}") : base_url("uploads/1710857373145.jpg"),
                'departman_adi' => $rehber_kullanici->departman_adi ?? null,
                'kullanici_grup_adi' => $rehber_kullanici->kullanici_grup_adi ?? null,
                'whatsapp_url' => $rehber_kullanici->kullanici_bireysel_iletisim_no ? 'https://wa.me/9' . str_replace(' ', '', $rehber_kullanici->kullanici_bireysel_iletisim_no) : null,
                'tel_url' => $rehber_kullanici->kullanici_bireysel_iletisim_no ? 'tel:' . $rehber_kullanici->kullanici_bireysel_iletisim_no : null,
                'sms_url' => $rehber_kullanici->kullanici_bireysel_iletisim_no ? 'sms:' . str_replace(' ', '', $rehber_kullanici->kullanici_bireysel_iletisim_no) : null
            ];
        }

        $this->jsonResponse([
            'status'  => 'success',
            'kurumsal_iletisim' => $kurumsal_iletisim,
            'toplam_kayit' => count($kurumsal_iletisim),
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }


    /** 7. İzin Talebi Ekle */
    public function izin_talebi_ekle()
    {
        $method = $this->input->method(true);
        
        // Sadece POST isteklerini kabul et
        if ($method !== 'POST') {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Sadece POST metodu kabul edilir.'
            ], 405);
        }

        // JSON input al
        $input_data = json_decode(file_get_contents('php://input'), true) ?? [];
        
        // Kullanıcı ID'sini al (hem user_id hem kullanici_id destekle)
        $user_id = !empty($input_data['kullanici_id']) ? $input_data['kullanici_id'] : (!empty($input_data['user_id']) ? $input_data['user_id'] : null);
        
        // Gerekli alanları kontrol et
        if (empty($user_id) || empty($input_data['izin_baslangic_tarihi']) || 
            empty($input_data['izin_bitis_tarihi']) || empty($input_data['izin_neden_no'])) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'kullanici_id (veya user_id), izin_baslangic_tarihi, izin_bitis_tarihi ve izin_neden_no alanları gereklidir.'
            ], 400);
        }

        // String değerleri integer'a çevir
        $user_id = intval($user_id);
        $izin_baslangic_tarihi = strip_tags(trim($input_data['izin_baslangic_tarihi']));
        $izin_bitis_tarihi = strip_tags(trim($input_data['izin_bitis_tarihi']));
        $izin_neden_no = intval($input_data['izin_neden_no']);
        $izin_notu = !empty($input_data['izin_notu']) ? strip_tags(trim($input_data['izin_notu'])) : null;

        // Kullanıcı kontrolü
        $kullanici = $this->db->where('kullanici_id', $user_id)
                              ->where('kullanici_aktif', 1)
                              ->get('kullanicilar')
                              ->row();

        if (!$kullanici) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Geçersiz kullanıcı ID veya kullanıcı aktif değil.'
            ], 404);
        }

        // İzin nedeni kontrolü
        $izin_nedeni = $this->db->where('izin_neden_id', $izin_neden_no)
                                ->get('izin_nedenleri')
                                ->row();

        if (!$izin_nedeni) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Geçersiz izin nedeni.'
            ], 400);
        }

        // Tarih formatı kontrolü
        if (!strtotime($izin_baslangic_tarihi) || !strtotime($izin_bitis_tarihi)) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Geçersiz tarih formatı. Tarih formatı: Y-m-d H:i:s veya Y-m-d'
            ], 400);
        }

        // Bitiş tarihi başlangıç tarihinden önce olamaz
        if (strtotime($izin_bitis_tarihi) < strtotime($izin_baslangic_tarihi)) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Bitiş tarihi başlangıç tarihinden önce olamaz.'
            ], 400);
        }

        // İzin talebi verilerini hazırla
        $data = [
            'izin_talep_eden_kullanici_id' => $user_id,
            'izin_baslangic_tarihi' => $izin_baslangic_tarihi,
            'izin_bitis_tarihi' => $izin_bitis_tarihi,
            'izin_neden_no' => $izin_neden_no,
            'izin_notu' => $izin_notu,
            'izin_kayit_tarihi' => date('Y-m-d H:i:s')
        ];

        // İzin talebini kaydet
        $this->db->insert('izin_talepleri', $data);
        $izin_talep_id = $this->db->insert_id();

        if (!$izin_talep_id) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'İzin talebi kaydedilirken bir hata oluştu.'
            ], 500);
        }

        // Bildirim gönderme mantığı (opsiyonel - basitleştirilmiş)
        // Bu kısım isteğe bağlı olarak eklenebilir

        $this->jsonResponse([
            'status'  => 'success',
            'message' => 'İzin talebi başarıyla eklendi.',
            'izin_talep_id' => $izin_talep_id,
            'data' => [
                'izin_baslangic_tarihi' => $izin_baslangic_tarihi,
                'izin_bitis_tarihi' => $izin_bitis_tarihi,
                'izin_neden' => $izin_nedeni->izin_neden_detay,
                'izin_notu' => $izin_notu
            ],
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }

    /** 8. Mobil Satış Sayfası Bilgileri */
    public function mobil_satis_sayfasi_bilgileri()
    {
        $this->load->model('Urun_model');
        $this->load->model('Merkez_model');
        
        // Ürünler listesi (harici cihaz olmayanlar)
        $urunler = $this->Urun_model->get_all(["harici_cihaz" => 0]);
        
        // Ürün fiyat listeleri
        $fiyat_listeleri = [];
        $urun_id_list = [1, 2, 3, 4, 5, 6, 7, 8]; // UMEX Lazer, Diode, EMS, Gold, Slim, S, Q Switch, Plus
        foreach ($urun_id_list as $urun_id) {
            $fiyat_liste = $this->_getFiyatListe($urun_id);
            if ($fiyat_liste) {
                $urun_bilgi = $this->Urun_model->get_by_id($urun_id);
                $fiyat_listeleri[] = [
                    'urun_id' => $urun_id,
                    'urun_adi' => $urun_bilgi ? $urun_bilgi[0]->urun_adi : '',
                    'fiyat_listesi' => $fiyat_liste
                ];
            }
        }
        
        // Hediyeler
        $hediyeler = $this->db->get("siparis_hediyeler")->result();
        
        // Başlıklar
        $basliklar = $this->Urun_model->get_basliklar()->result();
        
        // Ödeme seçenekleri
        $odeme_secenekleri = [
            ['id' => 1, 'adi' => 'Peşin'],
            ['id' => 2, 'adi' => 'Vadeli']
        ];
        
        // Para birimleri
        $para_birimleri = [
            ['id' => 'TRY', 'adi' => 'Türk Lirası (₺)'],
            ['id' => 'USD', 'adi' => 'Dolar ($)'],
            ['id' => 'EUR', 'adi' => 'Euro (€)']
        ];
        
        // Renk seçenekleri (genel)
        $renk_secenekleri = [
            'Siyah',
            'Beyaz',
            'Gri',
            'Kırmızı',
            'Mavi'
        ];
        
        $this->jsonResponse([
            'status' => 'success',
            'data' => [
                'urunler' => $urunler,
                'fiyat_listeleri' => $fiyat_listeleri,
                'hediyeler' => $hediyeler,
                'basliklar' => $basliklar,
                'odeme_secenekleri' => $odeme_secenekleri,
                'para_birimleri' => $para_birimleri,
                'renk_secenekleri' => $renk_secenekleri
            ],
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }

    /** Fiyat listesi hesaplama yardımcı fonksiyonu */
    private function _getFiyatListe($urun_id)
    {
        $urun = $this->Urun_model->get_by_id($urun_id);
        if (!$urun || empty($urun)) {
            return null;
        }
        
        $urun_data = $urun[0];
        $fiyat_listesi = [];
        
        if ($urun_data->urun_pesinat_artis_ust_fiyati != 0 && $urun_data->urun_pesinat_fiyati != 0) {
            for ($p = $urun_data->urun_pesinat_fiyati; $p <= $urun_data->urun_pesinat_artis_ust_fiyati; $p += $urun_data->pesinat_artis_aralik) {
                for ($v = 20; $v >= 1; $v--) {
                    if ($v % 2 == 1 && $v != 1) continue;
                    
                    $senet_result = (($urun_data->urun_satis_fiyati - $p) * (($urun_data->urun_vade_farki / 12) * $v) + ($urun_data->urun_satis_fiyati - $p));
                    
                    $fiyat_item = [
                        'pesinat_fiyati' => $p,
                        'vade' => $v,
                        'senet' => $senet_result,
                        'aylik_taksit_tutar' => $senet_result / $v,
                        'toplam_dip_fiyat' => $senet_result + $p,
                        'toplam_dip_fiyat_yuvarlanmis' => floor(($senet_result + $p) / 5000) * 5000,
                        'toplam_dip_fiyat_yuvarlanmis_satisci' => (floor(($senet_result + $p) / 5000) * 5000) - ($urun_data->satis_pazarlik_payi)
                    ];
                    
                    $fiyat_listesi[] = $fiyat_item;
                }
            }
        }
        
        return $fiyat_listesi;
    }

    /** 9. Satış Oluştur */
    public function satis_olustur()
    {
        $method = $this->input->method(true);
        
        // Sadece POST isteklerini kabul et
        if ($method !== 'POST') {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Sadece POST metodu kabul edilir.'
            ], 405);
        }

        // JSON input al
        $input_data = json_decode(file_get_contents('php://input'), true) ?? [];
        
        // Kullanıcı ID'sini al (hem user_id hem kullanici_id destekle)
        $kullanici_id = !empty($input_data['kullanici_id']) ? intval($input_data['kullanici_id']) : (!empty($input_data['user_id']) ? intval($input_data['user_id']) : null);
        
        // Gerekli alanları kontrol et
        if (empty($kullanici_id) || empty($input_data['merkez_id']) || empty($input_data['urunler']) || !is_array($input_data['urunler'])) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'kullanici_id (veya user_id), merkez_id ve urunler (array) alanları gereklidir.'
            ], 400);
        }

        $merkez_id = intval($input_data['merkez_id']);
        
        // Kullanıcı kontrolü
        $kullanici = $this->db->where('kullanici_id', $kullanici_id)
                              ->where('kullanici_aktif', 1)
                              ->get('kullanicilar')
                              ->row();

        if (!$kullanici) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Geçersiz kullanıcı ID veya kullanıcı aktif değil.'
            ], 404);
        }

        // Merkez kontrolü
        $merkez = $this->db->where('merkez_id', $merkez_id)
                           ->get('merkezler')
                           ->row();

        if (!$merkez) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Geçersiz merkez ID.'
            ], 404);
        }

        $this->load->model('Siparis_model');
        $this->load->model('Siparis_urun_model');
        $this->load->model('Siparis_onay_hareket_model');

        // Sipariş oluştur
        $siparis_data = [
            'merkez_no' => $merkez_id,
            'siparisi_olusturan_kullanici' => $kullanici_id
        ];
        
        $this->Siparis_model->insert($siparis_data);
        $siparis_id = $this->db->insert_id();
        
        // Sipariş kodu oluştur
        $siparis_kodu = "SPR" . date("dmY") . str_pad($siparis_id, 5, '0', STR_PAD_LEFT);
        $this->db->where('siparis_id', $siparis_id)
                 ->update('siparisler', ["siparis_kodu" => $siparis_kodu]);

        // Onay hareketi 1 (Görüşme kaydı)
        $onay_hareket_1 = [
            'siparis_no' => $siparis_id,
            'adim_no' => 1,
            'onay_durum' => 1,
            'onay_aciklama' => 'Görüşme kaydı otomatik oluşturuldu.',
            'onay_kullanici_id' => $kullanici_id
        ];
        $this->Siparis_onay_hareket_model->insert($onay_hareket_1);

        // Ürün notlarını birleştir
        $siparis_notu = "";
        foreach ($input_data['urunler'] as $urun) {
            if (!empty($urun['siparis_notu'])) {
                $siparis_notu .= " " . $urun['siparis_notu'];
            }
        }

        // Onay hareketi 2 (Sipariş kaydı)
        $onay_hareket_2 = [
            'siparis_no' => $siparis_id,
            'adim_no' => 2,
            'onay_durum' => 1,
            'onay_aciklama' => ($siparis_notu == "") ? "Sipariş kaydı otomatik oluşturuldu." : trim($siparis_notu),
            'onay_kullanici_id' => $kullanici_id
        ];
        $this->Siparis_onay_hareket_model->insert($onay_hareket_2);

        // Ürünleri kaydet
        $urunler_kaydedildi = [];
        foreach ($input_data['urunler'] as $urun) {
            // Field name normalizasyonu - farklı field name'leri destekle
            $urun_no = intval($urun['urun_no'] ?? $urun['urun_id'] ?? 0);
            $renk = !empty($urun['renk']) ? intval($urun['renk']) : null;
            $odeme_secenek = intval($urun['odeme_secenek'] ?? $urun['odeme_secenegi'] ?? 1);
            $vade_sayisi = intval($urun['vade_sayisi'] ?? 0);
            $damla_etiket = isset($urun['damla_etiket']) ? intval($urun['damla_etiket']) : null;
            $acilis_ekrani = isset($urun['acilis_ekrani']) ? intval($urun['acilis_ekrani']) : null;
            $yenilenmis_cihaz_mi = isset($urun['yenilenmis_cihaz_mi']) ? intval($urun['yenilenmis_cihaz_mi']) : 0;
            $para_birimi = !empty($urun['para_birimi']) ? trim($urun['para_birimi']) : 'TRY';
            
            // Hediye no - 0, "0", null, boş string kontrolü
            $hediye_no_raw = $urun['hediye_no'] ?? $urun['hediye_id'] ?? null;
            $hediye_no = null;
            if ($hediye_no_raw !== null && $hediye_no_raw !== '' && $hediye_no_raw !== '0' && $hediye_no_raw !== 0) {
                $hediye_no = intval($hediye_no_raw);
            }
            
            // Takas alanları - "0", 0, null, boş string kontrolü
            $takas_alinan_model_raw = $urun['takas_alinan_model'] ?? $urun['takas_model'] ?? null;
            $takas_alinan_model = null;
            if (!empty($takas_alinan_model_raw) && $takas_alinan_model_raw !== '0' && $takas_alinan_model_raw !== 0) {
                $takas_alinan_model = trim($takas_alinan_model_raw);
            }
            
            $takas_alinan_seri_kod_raw = $urun['takas_alinan_seri_kod'] ?? $urun['takas_seri_kod'] ?? $urun['takas_seri_no'] ?? null;
            $takas_alinan_seri_kod = null;
            if (!empty($takas_alinan_seri_kod_raw) && $takas_alinan_seri_kod_raw !== '0' && $takas_alinan_seri_kod_raw !== 0) {
                $takas_alinan_seri_kod = trim($takas_alinan_seri_kod_raw);
            }
            
            $takas_alinan_renk_raw = $urun['takas_alinan_renk'] ?? $urun['takas_renk'] ?? null;
            $takas_alinan_renk = null;
            if (!empty($takas_alinan_renk_raw) && $takas_alinan_renk_raw !== '0' && $takas_alinan_renk_raw !== 0) {
                $takas_alinan_renk = trim($takas_alinan_renk_raw);
            }
            
            // Fiyat alanları - string/number karışık gelebilir
            $satis_fiyati = str_replace([',', '₺', ' ', 'TL'], '', $urun['satis_fiyati'] ?? $urun['satis_fiyat'] ?? '0');
            $pesinat_fiyati = str_replace([',', '₺', ' ', 'TL'], '', $urun['pesinat_fiyati'] ?? $urun['pesinat_fiyat'] ?? '0');
            $kapora_fiyati = str_replace([',', '₺', ' ', 'TL'], '', $urun['kapora_fiyati'] ?? $urun['kapora_fiyat'] ?? '0');
            $fatura_tutari = str_replace([',', '₺', ' ', 'TL'], '', $urun['fatura_tutari'] ?? $urun['fatura_fiyati'] ?? '0');
            $takas_bedeli = str_replace([',', '₺', ' ', 'TL'], '', $urun['takas_bedeli'] ?? $urun['takas_fiyati'] ?? '0');
            
            // Başlıklar - array kontrolü
            $basliklar = null;
            $basliklar_raw = $urun['basliklar'] ?? $urun['baslik'] ?? null;
            if (!empty($basliklar_raw) && is_array($basliklar_raw) && count($basliklar_raw) > 0) {
                $basliklar = base64_encode(json_encode($basliklar_raw));
            }
            
            // Sipariş notu - farklı field name'ler
            $siparis_notu_raw = $urun['siparis_notu'] ?? $urun['siparis_urun_notu'] ?? $urun['not'] ?? $urun['aciklama'] ?? null;
            $siparis_urun_notu = null;
            if (!empty($siparis_notu_raw)) {
                $siparis_urun_notu = strip_tags(trim($siparis_notu_raw));
            }
            
            // Takas fotoğrafları - farklı field name'ler
            $takas_fotograflari = $urun['takas_fotograflari'] ?? $urun['takas_fotograflar'] ?? $urun['takas_foto'] ?? [];
            if (!is_array($takas_fotograflari)) {
                $takas_fotograflari = [];
            }
            
            $siparis_urun_data = [
                'siparis_kodu' => $siparis_id,
                'urun_no' => $urun_no,
                'satis_fiyati' => $satis_fiyati,
                'pesinat_fiyati' => $pesinat_fiyati,
                'kapora_fiyati' => $kapora_fiyati,
                'fatura_tutari' => $fatura_tutari,
                'takas_bedeli' => $takas_bedeli,
                'takas_alinan_seri_kod' => $takas_alinan_seri_kod,
                'takas_alinan_model' => $takas_alinan_model,
                'takas_alinan_renk' => $takas_alinan_renk,
                'renk' => $renk,
                'odeme_secenek' => $odeme_secenek,
                'vade_sayisi' => $vade_sayisi,
                'damla_etiket' => $damla_etiket,
                'acilis_ekrani' => $acilis_ekrani,
                'yenilenmis_cihaz_mi' => $yenilenmis_cihaz_mi,
                'para_birimi' => $para_birimi,
                'hediye_no' => $hediye_no,
                'basliklar' => $basliklar,
                'siparis_urun_notu' => $siparis_urun_notu
            ];
            
            $this->Siparis_urun_model->insert($siparis_urun_data);
            $siparis_urun_id = $this->db->insert_id();
            $urunler_kaydedildi[] = $siparis_urun_id;

            // Takas cihaz kontrolü - UMEX ise güncelle
            if (!empty($takas_alinan_model) && $takas_alinan_model == "UMEX" && !empty($takas_alinan_seri_kod)) {
                $this->db->where('seri_numarasi', $takas_alinan_seri_kod)
                         ->update('siparis_urunleri', [
                             "takas_cihaz_mi" => 1,
                             "takas_alinan_merkez_id" => $merkez_id,
                             "takas_siparis_islem_detay" => "$siparis_kodu nolu sipariş kayıt sırasında takas olarak işaretlendi."
                         ]);
            }

            // Takas fotoğrafları (eğer varsa)
            if (!empty($takas_fotograflari) && is_array($takas_fotograflari)) {
                foreach ($takas_fotograflari as $foto_url) {
                    if (!empty($foto_url) && is_string($foto_url)) {
                        $foto_data = [
                            'urun_id' => $siparis_urun_id,
                            'siparis_id' => $siparis_id,
                            'foto_url' => trim($foto_url)
                        ];
                        $this->db->insert('takas_urun_fotograflari', $foto_data);
                    }
                }
            }
        }

        $this->jsonResponse([
            'status' => 'success',
            'message' => 'Satış başarıyla oluşturuldu.',
            'siparis_id' => $siparis_id,
            'siparis_kodu' => $siparis_kodu,
            'urunler_kaydedildi' => $urunler_kaydedildi,
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }


    public function musteriler()
    {
        // GET ile gelen password'u al
        $password = $this->input->get('password');
        // Güçlü bir şifre belirleyelim
        $guclu_sifre = "12532302828";

        if ($password !== $guclu_sifre) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Şifre hatalı veya yetkisiz giriş.',
                'data' => null,
                'timestamp' => date('Y-m-d H:i:s')
            ]);
            return;
        }

        $data = $this->db->where("musteri_aktif", 1)
            ->select("musteri_id,musteri_ad,musteri_cinsiyet,musteri_kod,musteri_iletisim_numarasi,merkez_adi,merkez_id,sehir_adi,ilce_adi")
            ->from("musteriler")
            ->join("merkezler", "merkezler.merkez_yetkili_id = musteri_id")
            ->join("sehirler", "sehirler.sehir_id = merkezler.merkez_il_id")
            ->join("ilceler", "ilceler.ilce_id = merkezler.merkez_ilce_id")
            ->get()->result();

        $this->jsonResponse([
            'status'  => 'success',
            'message' => 'Müşteriler başarıyla getirildi.',
            'data' => $data,
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }



    public function departmanlar()
    {
        $base_url = base_url('uploads/') . '/';

        $data = $this->db
            ->select("departmanlar.*, kullanicilar.kullanici_ad_soyad as departman_sorumlu_kullanici_ad_soyad, kullanicilar.kullanici_resim as departman_sorumlu_kullanici_resim")
            ->from("departmanlar")
            ->join("kullanicilar", "kullanicilar.kullanici_id = departmanlar.departman_sorumlu_kullanici_id", "left")
            ->order_by("departmanlar.departman_id", "ASC")
            ->get()
            ->result();

        // Resmin başına base_url ve uploads ekle
        foreach ($data as &$item) {
            if (!empty($item->departman_sorumlu_kullanici_resim)) {
                $item->departman_sorumlu_kullanici_resim = $base_url . ltrim($item->departman_sorumlu_kullanici_resim, '/');
            } else {
                $item->departman_sorumlu_kullanici_resim = null;
            }
        }
        unset($item);
            
        $this->jsonResponse([
            'status'  => 'success',
            'message' => 'Departmanlar başarıyla getirildi.',
            'data' => $data,
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }

    /** 10. Depo Talep Etme Sayfası Bilgileri */
    public function depo_talep_etme_sayfasi()
    {
        // Stok tanımları (malzemeler/ürünler)
        $stok_tanimlari = $this->db
            ->select('stok_tanim_id, stok_tanim_ad')
            ->from('stok_tanimlari')
            ->order_by('stok_tanim_ad', 'ASC')
            ->get()
            ->result();

        // Kullanıcılar listesi (teslim alacak kişiler için)
        $kullanicilar = $this->db
            ->select('kullanici_id, kullanici_ad_soyad')
            ->from('kullanicilar')
            ->where('kullanici_aktif', 1)
            ->order_by('kullanici_ad_soyad', 'ASC')
            ->get()
            ->result();

        $this->jsonResponse([
            'status' => 'success',
            'data' => [
                'stok_tanimlari' => $stok_tanimlari,
                'kullanicilar' => $kullanicilar
            ],
            'toplam_malzeme' => count($stok_tanimlari),
            'toplam_kullanici' => count($kullanicilar),
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }

    /** 11. Sistem Bildirimleri - Kullanıcı Bildirimlerini Getir */
    public function sistem_bildirimleri()
    {
        $method = $this->input->method(true);
        
        // GET veya POST ile kullanici_id alınabilir
        if ($method === 'GET') {
            $kullanici_id = $this->input->get('kullanici_id') ?? $this->input->get('user_id');
        } else {
            $input_data = json_decode(file_get_contents('php://input'), true) ?? [];
            $kullanici_id = !empty($input_data['kullanici_id']) ? $input_data['kullanici_id'] : (!empty($input_data['user_id']) ? $input_data['user_id'] : null);
        }
        
        // Kullanıcı ID kontrolü
        if (empty($kullanici_id)) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'kullanici_id (veya user_id) gereklidir.'
            ], 400);
        }

        $kullanici_id = intval($kullanici_id);
        
        // Kullanıcı kontrolü
        $kullanici = $this->db->where('kullanici_id', $kullanici_id)
                              ->where('kullanici_aktif', 1)
                              ->get('kullanicilar')
                              ->row();

        if (!$kullanici) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Geçersiz kullanıcı ID veya kullanıcı aktif değil.'
            ], 404);
        }

        $this->load->model('Sistem_bildirimleri_model');
        
        // Kullanıcının bildirimlerini getir
        $bildirimler = $this->Sistem_bildirimleri_model->get_kullanici_bildirimleri($kullanici_id);
        
        // Okunmamış bildirim sayısı
        $okunmamis_sayisi = $this->Sistem_bildirimleri_model->get_okunmamis_sayisi($kullanici_id);
        
        // Bildirimleri formatla
        $formatted_bildirimler = [];
        foreach ($bildirimler as $bildirim) {
            $formatted_bildirimler[] = [
                'bildirim_id' => $bildirim->id,
                'tip_adi' => $bildirim->tip_adi ?? null,
                'baslik' => $bildirim->baslik ?? null,
                'mesaj' => $bildirim->mesaj ?? null,
                'gonderen_ad_soyad' => $bildirim->gonderen_ad_soyad ?? 'Sistem',
                'onaylayan_ad_soyad' => $bildirim->onaylayan_ad_soyad ?? null,
                'onay_durumu' => $bildirim->onay_durumu ?? null,
                'okundu' => isset($bildirim->kullanici_okundu) ? (int)$bildirim->kullanici_okundu : 0,
                'created_at' => $bildirim->created_at ?? null,
                'onaylanma_tarihi' => $bildirim->onaylanma_tarihi ?? null
            ];
        }

        $this->jsonResponse([
            'status' => 'success',
            'data' => $formatted_bildirimler,
            'okunmamis_sayisi' => $okunmamis_sayisi,
            'toplam_bildirim' => count($formatted_bildirimler),
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }

    /** 12. Sistem Bildirimi Okundu İşaretle */
    public function sistem_bildirim_okundu_isaretle()
    {
        $method = $this->input->method(true);
        
        // Sadece POST isteklerini kabul et
        if ($method !== 'POST') {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Sadece POST metodu kabul edilir.'
            ], 405);
        }

        // JSON input al
        $input_data = json_decode(file_get_contents('php://input'), true) ?? [];
        
        // Kullanıcı ID'sini al
        $kullanici_id = !empty($input_data['kullanici_id']) ? intval($input_data['kullanici_id']) : (!empty($input_data['user_id']) ? intval($input_data['user_id']) : null);
        $bildirim_id = !empty($input_data['bildirim_id']) ? intval($input_data['bildirim_id']) : null;
        
        // Gerekli alanları kontrol et
        if (empty($kullanici_id) || empty($bildirim_id)) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'kullanici_id (veya user_id) ve bildirim_id alanları gereklidir.'
            ], 400);
        }

        // Kullanıcı kontrolü
        $kullanici = $this->db->where('kullanici_id', $kullanici_id)
                              ->where('kullanici_aktif', 1)
                              ->get('kullanicilar')
                              ->row();

        if (!$kullanici) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Geçersiz kullanıcı ID veya kullanıcı aktif değil.'
            ], 404);
        }

        // Bildirim kontrolü - kullanıcıya ait mi?
        $bildirim_alici = $this->db->where('bildirim_id', $bildirim_id)
                                   ->where('alici_id', $kullanici_id)
                                   ->get('sistem_bildirim_alicilar')
                                   ->row();

        if (!$bildirim_alici) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Bildirim bulunamadı veya bu bildirim size ait değil.'
            ], 404);
        }

        // Zaten okundu mu?
        if ($bildirim_alici->okundu == 1) {
            $this->jsonResponse([
                'status'  => 'success',
                'message' => 'Bildirim zaten okundu olarak işaretlenmiş.',
                'bildirim_id' => $bildirim_id
            ]);
            return;
        }

        // Bildirimi okundu olarak işaretle
        $this->db->where('bildirim_id', $bildirim_id)
                 ->where('alici_id', $kullanici_id)
                 ->update('sistem_bildirim_alicilar', ['okundu' => 1]);

        // Hareket kaydı ekle
        $this->db->insert('sistem_bildirim_hareketleri', [
            'bildirim_id' => $bildirim_id,
            'kullanici_id' => $kullanici_id,
            'hareket_tipi' => 'goruldu',
            'aciklama' => 'Mobil API üzerinden okundu olarak işaretlendi',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        $this->jsonResponse([
            'status'  => 'success',
            'message' => 'Bildirim okundu olarak işaretlendi.',
            'bildirim_id' => $bildirim_id,
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }

    /** 13. Sistem Bildirim Okunmamış Sayısı */
    public function sistem_bildirim_okunmamis_sayisi()
    {
        $method = $this->input->method(true);
        
        // GET veya POST ile kullanici_id alınabilir
        if ($method === 'GET') {
            $kullanici_id = $this->input->get('kullanici_id') ?? $this->input->get('user_id');
        } else {
            $input_data = json_decode(file_get_contents('php://input'), true) ?? [];
            $kullanici_id = !empty($input_data['kullanici_id']) ? $input_data['kullanici_id'] : (!empty($input_data['user_id']) ? $input_data['user_id'] : null);
        }
        
        // Kullanıcı ID kontrolü
        if (empty($kullanici_id)) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'kullanici_id (veya user_id) gereklidir.'
            ], 400);
        }

        $kullanici_id = intval($kullanici_id);
        
        // Kullanıcı kontrolü
        $kullanici = $this->db->where('kullanici_id', $kullanici_id)
                              ->where('kullanici_aktif', 1)
                              ->get('kullanicilar')
                              ->row();

        if (!$kullanici) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Geçersiz kullanıcı ID veya kullanıcı aktif değil.'
            ], 404);
        }

        $this->load->model('Sistem_bildirimleri_model');
        
        // Okunmamış bildirim sayısı
        $okunmamis_sayisi = $this->Sistem_bildirimleri_model->get_okunmamis_sayisi($kullanici_id);

        $this->jsonResponse([
            'status' => 'success',
            'okunmamis_sayisi' => $okunmamis_sayisi,
            'kullanici_id' => $kullanici_id,
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }


    public function urunler()
    {
        // Ürünleri çek
        $urunler = $this->db->get('app_urunler')->result();

        // Her ürün için başlıkları ve renkleri çek
        $urunler_full = [];
        foreach ($urunler as $urun) {
            // Başlıkları al
            $basliklar = $this->db
                                ->where('urun_no', $urun->app_urun_id)
                                ->get('urun_basliklari')
                                ->result();

            // Renkleri al
            $renkler = $this->db
                                ->where('urun_no', $urun->app_urun_id)
                                ->get('urun_renkleri')
                                ->result();

            // Nesne olarak ekle
            $urun_data = (array)$urun;
            $urun_data['basliklar'] = $basliklar;
            $urun_data['renkler'] = $renkler;

            $urunler_full[] = $urun_data;
        }

        $this->jsonResponse([
            'status'    => 'success',
            'data'      => $urunler_full,
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }

    /** 14. Takas Kontrolü - Takas cihazının müşteri ile sipariş müşterisinin eşleşmesini kontrol eder */
    public function takas_kontrol()
    {
        $method = $this->input->method(true);
        
        // POST veya GET isteklerini kabul et
        if (in_array($method, ['POST', 'GET'])) {
            $input_data = ($method === 'POST') 
                ? json_decode(file_get_contents('php://input'), true) ?? []
                : $this->input->get();
        } else {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Sadece POST veya GET metodu kabul edilir.'
            ], 405);
        }

        // Gerekli parametreleri al
        $seri_no = isset($input_data['seri_no']) ? trim($input_data['seri_no']) : '';
        $telefon = isset($input_data['telefon']) ? preg_replace('/\s+/', '', $input_data['telefon']) : '';

        // Parametre kontrolü
        if (empty($seri_no) || empty($telefon)) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'seri_no ve telefon parametreleri gereklidir.',
                'durum'   => false
            ], 400);
        }

        $this->load->model('Siparis_model');

        // Seri numarasına göre sipariş ürününü bul
        $siparis_urun = $this->db->where("seri_numarasi", $seri_no)
                                 ->get("siparis_urunleri")
                                 ->row();

        if (!$siparis_urun) {
            // Seri numarası bulunamadıysa, takas yapılabilir (yeni cihaz)
            $this->jsonResponse([
                'status'  => 'success',
                'message' => 'Seri numarası bulunamadı. Takas yapılabilir.',
                'durum'   => true
            ]);
        }

        // Sipariş bilgisini al
        $siparis = $this->Siparis_model->get_by_id($siparis_urun->siparis_kodu);
        
        if (!$siparis || empty($siparis[0]->musteri_iletisim_numarasi)) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Sipariş bilgisi bulunamadı.',
                'durum'   => false
            ], 404);
        }

        // Müşteri iletişim numaralarını karşılaştır (boşlukları temizle)
        $siparis_telefon = preg_replace('/\s+/', '', $siparis[0]->musteri_iletisim_numarasi);
        
        if ($siparis_telefon != $telefon) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'TAKAS - MÜŞTERİ İLİŞKİSİ KURULAMADI. Takas cihazının müşterisi ile sipariş müşterisi eşleşmiyor.',
                'durum'   => false
            ]);
        }

        // Müşteriler eşleşiyor
        $this->jsonResponse([
            'status'  => 'success',
            'message' => 'Takas kontrolü başarılı. Müşteriler eşleşiyor.',
            'durum'   => true
        ]);
    }

    /** 15. Sipariş Validasyon Kontrolü - Tüm validasyon kurallarını kontrol eder */
    public function siparis_validasyon()
    {
        $method = $this->input->method(true);
        
        // Sadece POST isteklerini kabul et
        if ($method !== 'POST') {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Sadece POST metodu kabul edilir.'
            ], 405);
        }

        // JSON input al
        $input_data = json_decode(file_get_contents('php://input'), true) ?? [];
        
        // Kullanıcı ID'sini al
        $kullanici_id = !empty($input_data['kullanici_id']) ? intval($input_data['kullanici_id']) : (!empty($input_data['user_id']) ? intval($input_data['user_id']) : null);
        
        if (empty($kullanici_id)) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'kullanici_id (veya user_id) gereklidir.'
            ], 400);
        }

        // Kullanıcı bilgisini al
        $kullanici = $this->db->where('kullanici_id', $kullanici_id)
                              ->where('kullanici_aktif', 1)
                              ->get('kullanicilar')
                              ->row();

        if (!$kullanici) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Geçersiz kullanıcı ID veya kullanıcı aktif değil.'
            ], 404);
        }

        // Ürünleri kontrol et
        if (empty($input_data['urunler']) || !is_array($input_data['urunler'])) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'En az 1 adet ürün girmeniz gerekmektedir.',
                'valid'   => false,
                'errors'  => ['urunler' => 'En az 1 adet ürün girmeniz gerekmektedir.']
            ]);
        }

        $errors = [];
        $warnings = [];

        // Her ürün için validasyon
        foreach ($input_data['urunler'] as $index => $urun) {
            $urun_index = $index + 1;
            
            // 1. Başlık kontrolü
            if (empty($urun['basliklar']) || !is_array($urun['basliklar']) || count($urun['basliklar']) == 0) {
                $errors["urun_{$urun_index}_baslik"] = "Ürün {$urun_index} için en az 1 başlık seçilmelidir.";
            }

            // 2. Zorunlu alanlar
            if (empty($urun['urun_no'])) {
                $errors["urun_{$urun_index}_urun_no"] = "Ürün {$urun_index} için ürün seçilmelidir.";
            }
            if (empty($urun['renk'])) {
                $errors["urun_{$urun_index}_renk"] = "Ürün {$urun_index} için renk seçilmelidir.";
            }
            if (empty($urun['odeme_secenek'])) {
                $errors["urun_{$urun_index}_odeme_secenek"] = "Ürün {$urun_index} için ödeme seçeneği seçilmelidir.";
            }

            // 3. Fiyat kontrolleri
            $satis_fiyati = floatval(str_replace([',', '₺', ' '], '', $urun['satis_fiyati'] ?? '0'));
            $kapora_fiyati = floatval(str_replace([',', '₺', ' '], '', $urun['kapora_fiyati'] ?? '0'));
            $pesinat_fiyati = floatval(str_replace([',', '₺', ' '], '', $urun['pesinat_fiyati'] ?? '0'));
            $takas_bedeli = floatval(str_replace([',', '₺', ' '], '', $urun['takas_bedeli'] ?? '0'));
            $fatura_tutari = floatval(str_replace([',', '₺', ' '], '', $urun['fatura_tutari'] ?? '0'));
            $odeme_secenek = intval($urun['odeme_secenek'] ?? 1);
            $vade_sayisi = intval($urun['vade_sayisi'] ?? 0);
            $yenilenmis_cihaz_mi = intval($urun['yenilenmis_cihaz_mi'] ?? 0);

            // Peşin satış kontrolü
            if ($odeme_secenek == 1) {
                $hesaplanan_tutar = $kapora_fiyati + $pesinat_fiyati + $takas_bedeli;
                if (abs($satis_fiyati - $hesaplanan_tutar) > 0.01) {
                    $errors["urun_{$urun_index}_fiyat"] = "Peşin satışlarda Kapora, Peşinat ve Takas Bedeli tutarlarının toplamı Satış fiyatına eşit olmak zorundadır. (Satış: {$satis_fiyati}, Toplam: {$hesaplanan_tutar})";
                }
            }

            // Vadeli satış kontrolü
            if ($odeme_secenek == 2) {
                if ($vade_sayisi <= 0) {
                    $errors["urun_{$urun_index}_vade"] = "Vadeli satışlarda vade sayısı 0'dan büyük olmak zorundadır.";
                }
            }

            // Yenilenmiş cihaz kontrolü
            if ($yenilenmis_cihaz_mi == 1 && $fatura_tutari > 50000) {
                $errors["urun_{$urun_index}_fatura"] = "Yenilenmiş Cihazlarda Fatura Tutarını Maksimum 50.000 TL Girebilirsiniz";
            }

            // 4. Takas kontrolleri
            $takas_model = $urun['takas_alinan_model'] ?? '0';
            $takas_seri_kod = $urun['takas_alinan_seri_kod'] ?? '';
            $takas_renk = $urun['takas_alinan_renk'] ?? '';

            // Takas varsa kontrol et
            if ($takas_model != '0' && $takas_model != '') {
                // Takas bedeli kontrolü
                if ($takas_bedeli <= 0) {
                    $errors["urun_{$urun_index}_takas_bedel"] = "Takaslı satışlarda takas bedeli 0'dan büyük olmak zorundadır.";
                }

                // UMEX takas kontrolleri
                if ($takas_model == 'UMEX') {
                    if (empty($takas_seri_kod)) {
                        $errors["urun_{$urun_index}_takas_seri"] = "UMEX Takaslı Satışlarda TAKAS CİHAZ SERİ KOD alanı zorunludur.";
                    } else {
                        if (!preg_match('/^UG/', $takas_seri_kod) || strlen($takas_seri_kod) != 14) {
                            $errors["urun_{$urun_index}_takas_seri_format"] = "UMEX Takaslı Satışlarda TAKAS CİHAZ SERİ KODU UG ile başlamalı ve 14 karakter olmalıdır.";
                        }
                    }
                    if (empty($takas_renk)) {
                        $errors["urun_{$urun_index}_takas_renk"] = "UMEX Takaslı Satışlarda TAKAS CİHAZ RENK alanı zorunludur.";
                    }
                }
            }

            // 5. Ürün bazlı takas kontrolü
            $urun_no = intval($urun['urun_no'] ?? 0);
            if (!in_array($urun_no, [1, 8]) && $takas_model != '0' && $takas_model != '') {
                $warnings["urun_{$urun_index}_takas_urun"] = "Ürün ID {$urun_no} için takas yapılamaz. Takas bilgileri göz ardı edilecektir.";
            }
        }

        // Hata varsa
        if (!empty($errors)) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Validasyon hataları bulundu.',
                'valid'   => false,
                'errors'  => $errors,
                'warnings' => $warnings
            ], 400);
        }

        // Uyarı varsa ama hata yoksa
        if (!empty($warnings)) {
            $this->jsonResponse([
                'status'  => 'warning',
                'message' => 'Validasyon başarılı ancak bazı uyarılar var.',
                'valid'   => true,
                'warnings' => $warnings
            ]);
        }

        // Başarılı
        $this->jsonResponse([
            'status'  => 'success',
            'message' => 'Tüm validasyon kontrolleri başarılı.',
            'valid'   => true
        ]);
    }

    /** 16. Fiyat Limit Kontrolü - Kullanıcı limitlerine göre fiyat kontrolü yapar */
    public function fiyat_limit_kontrol()
    {
        $method = $this->input->method(true);
        
        // POST veya GET isteklerini kabul et
        if (in_array($method, ['POST', 'GET'])) {
            $input_data = ($method === 'POST') 
                ? json_decode(file_get_contents('php://input'), true) ?? []
                : $this->input->get();
        } else {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Sadece POST veya GET metodu kabul edilir.'
            ], 405);
        }

        // Kullanıcı ID'sini al
        $kullanici_id = !empty($input_data['kullanici_id']) ? intval($input_data['kullanici_id']) : (!empty($input_data['user_id']) ? intval($input_data['user_id']) : null);
        
        if (empty($kullanici_id)) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'kullanici_id (veya user_id) gereklidir.'
            ], 400);
        }

        // Kullanıcı bilgisini al
        $kullanici = $this->db->where('kullanici_id', $kullanici_id)
                              ->where('kullanici_aktif', 1)
                              ->get('kullanicilar')
                              ->row();

        if (!$kullanici) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Geçersiz kullanıcı ID veya kullanıcı aktif değil.'
            ], 404);
        }

        // Limit kontrolü kapalıysa
        if ($kullanici->kullanici_limit_kontrol == 0) {
            $this->jsonResponse([
                'status'  => 'success',
                'message' => 'Kullanıcı limit kontrolü kapalı. Tüm fiyatlar kabul edilir.',
                'fullaccess' => true,
                'data' => []
            ]);
        }

        // Gerekli parametreler
        $urun_id = isset($input_data['urun_id']) ? intval($input_data['urun_id']) : 0;
        $vade_sayisi = isset($input_data['vade_sayisi']) ? intval($input_data['vade_sayisi']) : 0;
        $pesinat_tutari = isset($input_data['pesinat_tutari']) ? floatval(str_replace([',', '₺', ' '], '', $input_data['pesinat_tutari'])) : 0;

        if (empty($urun_id)) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'urun_id gereklidir.'
            ], 400);
        }

        // Ürün bilgisini al
        $urun = $this->db->where("urun_id", $urun_id)->get("urunler")->row();
        
        if (!$urun) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Geçersiz ürün ID.'
            ], 404);
        }

        // Limit bilgilerini hazırla
        $result = [
            'limit_urun_id' => $urun_id,
            'pesinat_fiyati' => floatval($urun->urun_pesinat_fiyati),
            'nakit_takassiz_satis_fiyat' => floatval($urun->urun_satis_fiyati),
            'nakit_takassiz_satis_fiyat_kontrol' => floatval($urun->urun_satis_fiyati) - floatval($urun->satis_pazarlik_payi),
            'nakit_umex_takas_fiyat' => floatval($urun->urun_nakit_umex_takas_fiyat),
            'vadeli_umex_takas_fiyat' => floatval($urun->urun_vadeli_umex_takas_fiyat),
            'nakit_robotix_takas_fiyat' => floatval($urun->urun_nakit_robotix_takas_fiyat),
            'vadeli_robotix_takas_fiyat' => floatval($urun->urun_vadeli_robotix_takas_fiyat),
            'nakit_diger_takas_fiyat' => floatval($urun->urun_nakit_diger_takas_fiyat),
            'vadeli_diger_takas_fiyat' => floatval($urun->urun_vadeli_diger_takas_fiyat)
        ];

        // Vadeli satış için hesaplama
        if ($vade_sayisi > 0 && $pesinat_tutari > 0) {
            $this->load->helper('site');
            $hesaplama = dip_fiyat_hesapla(
                $pesinat_tutari,
                $vade_sayisi,
                floatval($urun->urun_satis_fiyati),
                floatval($urun->urun_vade_farki),
                floatval($urun->satis_pazarlik_payi)
            );
            
            $result['vadeli_satis_fiyat'] = $hesaplama->toplam_dip_fiyat_yuvarlanmis;
            $result['vadeli_satis_fiyat_kontrol'] = $hesaplama->toplam_dip_fiyat_yuvarlanmis_satisci;
        }

        $this->jsonResponse([
            'status' => 'success',
            'message' => 'Fiyat limitleri başarıyla getirildi.',
            'fullaccess' => false,
            'data' => [$result]
        ]);
    }

    /** 19. Hediyeler Listesi - Tüm hediyeleri getirir */
    public function hediyeler()
    {

        $hediyeler = $this->db->get("siparis_hediyeler")->result();
        $this->jsonResponse([
            'status' => 'success',
            'message' => 'Hediyeler başarıyla getirildi.',
            'data' => $hediyeler
        ]);
    }

    /** 20. Takas Fotoğraf Yükleme - Base64 formatında fotoğraf yükler */
    public function takas_fotograf_yukle()
    {
        $method = $this->input->method(true);
        
        // Sadece POST isteklerini kabul et
        if ($method !== 'POST') {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Sadece POST metodu kabul edilir.'
            ], 405);
        }

        // JSON input al
        $input_data = json_decode(file_get_contents('php://input'), true) ?? [];
        
        $base64 = isset($input_data['image']) ? $input_data['image'] : '';
        $urun_index = isset($input_data['urun_index']) ? intval($input_data['urun_index']) : 0;

        if (empty($base64)) {
            $this->jsonResponse([
                'status' => 'error',
                'message' => 'Görsel yok. Base64 formatında görsel gönderilmelidir.'
            ], 400);
        }

        // Base64 formatını kontrol et
        $image_parts = explode(";base64,", $base64);
        if (count($image_parts) !== 2) {
            $this->jsonResponse([
                'status' => 'error',
                'message' => 'Base64 formatı hatalı. Format: data:image/jpeg;base64,... veya data:image/png;base64,...'
            ], 400);
        }

        // Base64 decode
        $image_base64 = base64_decode($image_parts[1]);
        
        if ($image_base64 === false) {
            $this->jsonResponse([
                'status' => 'error',
                'message' => 'Base64 decode hatası.'
            ], 400);
        }

        // Dosya adı oluştur
        $filename = 'takas_' . uniqid('', true) . '_' . time() . '.jpg';
        $upload_dir = FCPATH . 'uploads/takas_fotograflari/';
        
        // Klasör yoksa oluştur
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Dosyayı kaydet
        $file_path = $upload_dir . $filename;
        $write_result = file_put_contents($file_path, $image_base64);
        
        if ($write_result === false) {
            $this->jsonResponse([
                'status' => 'error',
                'message' => 'Dosya yazma hatası. Sunucu izinlerini kontrol edin.'
            ], 500);
        }

        $foto_url = 'uploads/takas_fotograflari/' . $filename;
        
        $this->jsonResponse([
            'status' => 'success',
            'message' => 'Fotoğraf başarıyla yüklendi.',
            'foto_url' => base_url($foto_url),
            'foto_path' => $foto_url,
            'urun_index' => $urun_index,
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }

    /** 21. Kart Okutmayan Personeller - Belirtilen tarihte kart okutmayan personelleri listeler */
    public function kart_okutmayan_personeller()
    {
        $method = $this->input->method(true);
        
        // GET veya POST isteklerini kabul et
        if (in_array($method, ['POST', 'GET'])) {
            $input_data = ($method === 'POST') 
                ? json_decode(file_get_contents('php://input'), true) ?? []
                : $this->input->get();
        } else {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Sadece POST veya GET metodu kabul edilir.'
            ], 405);
        }

        // Tarih parametresi (opsiyonel - yoksa bugünkü tarih)
        $tarih = isset($input_data['tarih']) ? trim($input_data['tarih']) : date('Y-m-d');
        
        // Tarih formatı kontrolü
        if (!strtotime($tarih)) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Geçersiz tarih formatı. Tarih formatı: Y-m-d (örn: 2024-01-15)'
            ], 400);
        }

        $tarih = date('Y-m-d', strtotime($tarih));
        $today_start = $tarih . ' 00:00:00';
        $today_end = $tarih . ' 23:59:59';

        // Helper fonksiyonlarını yükle
        $this->load->helper('site');

        // Kart okutmayan personelleri getir
        $data = $this->db->select("kullanicilar.kullanici_id,
                                   kullanicilar.mesai_pos_x,
                                   kullanicilar.mesai_pos_y,
                                   kullanicilar.kullanici_ad_soyad,
                                   kullanicilar.mesai_baslangic_saati,
                                   kullanicilar.kullanici_bireysel_iletisim_no,
                                   kullanicilar.kullanici_departman_id,
                                   departmanlar.departman_adi,
                                   MIN(mesai_takip.mesai_takip_okutma_tarihi) as mesai_takip_okutma_tarihi")
            ->from("kullanicilar")
            ->join("mesai_takip",
                "kullanicilar.kullanici_id = mesai_takip.mesai_takip_kullanici_id
                 AND mesai_takip.mesai_takip_okutma_tarihi >= '{$today_start}'
                 AND mesai_takip.mesai_takip_okutma_tarihi <= '{$today_end}'",
                "left")
            ->join("departmanlar", "departmanlar.departman_id = kullanicilar.kullanici_departman_id", "left")
            ->where("kullanicilar.kullanici_aktif", 1)
            ->where("mesai_takip_kontrolü", 1)
            ->where("kullanicilar.kullanici_id !=", 1)
            ->group_by("kullanicilar.kullanici_id")
            ->order_by("kullanicilar.kullanici_ad_soyad", "asc")
            ->get()
            ->result();

        // Her personel için ek bilgileri ekle
        $formatted_data = [];
        foreach ($data as $personel) {
            $kullanici_id = $personel->kullanici_id;
            
            // Kart okutma durumu kontrolü
            $kart_okutma_var = !empty($personel->mesai_takip_okutma_tarihi);
            
            // Sadece kart okutmayanları listele
            if ($kart_okutma_var) {
                continue;
            }

            // Ek durum kontrolleri
            $egitim_var_mi = egitim_var_mi($kullanici_id, $tarih) ? 1 : 0;
            $kurulum_var_mi = kurulum_var_mi($kullanici_id, $tarih) ? 1 : 0;
            $servis_var_mi = servis_var_mi($kullanici_id, $tarih) ? 1 : 0;
            $izin_var_mi = izin_var_mi($kullanici_id, $tarih) ? 1 : 0;
            $stajj = staj_musait_mi($kullanici_id, $tarih);
            $okulda_mi = $stajj ? 1 : 0; // Api.php'deki mantık ile aynı

            // Durum rengi belirleme
            $durum_renk = "red"; // Varsayılan: kart okutmadı
            if ($servis_var_mi == 1) {
                $durum_renk = "blue";
            } else if ($izin_var_mi == 1) {
                $durum_renk = "blue";
            } else if ($kurulum_var_mi == 1) {
                $durum_renk = "blue";
            } else if ($egitim_var_mi == 1) {
                $durum_renk = "blue";
            } else if ($okulda_mi == 1) {
                $durum_renk = "blue";
            }

            $formatted_data[] = [
                'kullanici_id' => intval($personel->kullanici_id),
                'kullanici_ad_soyad' => $personel->kullanici_ad_soyad ?? null,
                'kullanici_bireysel_iletisim_no' => $personel->kullanici_bireysel_iletisim_no ?? null,
                'mesai_baslangic_saati' => $personel->mesai_baslangic_saati ?? null,
                'mesai_pos_x' => !empty($personel->mesai_pos_x) ? intval($personel->mesai_pos_x) : null,
                'mesai_pos_y' => !empty($personel->mesai_pos_y) ? intval($personel->mesai_pos_y) : null,
                'departman_id' => !empty($personel->kullanici_departman_id) ? intval($personel->kullanici_departman_id) : null,
                'departman_adi' => $personel->departman_adi ?? null,
                'mesai_takip_okutma_tarihi' => null, // Kart okutmadığı için null
                'kart_okutma_var' => false,
                'egitim_var_mi' => $egitim_var_mi,
                'kurulum_var_mi' => $kurulum_var_mi,
                'servis_var_mi' => $servis_var_mi,
                'izin_var_mi' => $izin_var_mi,
                'okulda_mi' => $okulda_mi,
                'durum_renk' => $durum_renk
            ];
        }

        $this->jsonResponse([
            'status' => 'success',
            'message' => 'Kart okutmayan personeller başarıyla getirildi.',
            'tarih' => $tarih,
            'data' => $formatted_data,
            'toplam_personel' => count($formatted_data),
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }

}