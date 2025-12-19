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
        $kullanici_id = !empty($input_data['kullanici_id']) ? intval($input_data['kullanici_id']) : (!empty($input_data['user_id']) ? intval($input_data['user_id']) : 0); // null yerine 0
        
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
            $renk = !empty($urun['renk']) ? intval($urun['renk']) : 0;
            $odeme_secenek = intval($urun['odeme_secenek'] ?? $urun['odeme_secenegi'] ?? 1);
            $vade_sayisi = intval($urun['vade_sayisi'] ?? 0);
            $damla_etiket = isset($urun['damla_etiket']) ? intval($urun['damla_etiket']) : 0;
            $acilis_ekrani = isset($urun['acilis_ekrani']) ? intval($urun['acilis_ekrani']) : 0;
            $yenilenmis_cihaz_mi = isset($urun['yenilenmis_cihaz_mi']) ? intval($urun['yenilenmis_cihaz_mi']) : 0;
            $para_birimi = !empty($urun['para_birimi']) ? trim($urun['para_birimi']) : 'TRY';
            
            // Hediye no - 0, "0", null, boş string kontrolü
            $hediye_no_raw = $urun['hediye_no'] ?? $urun['hediye_id'] ?? null;
            $hediye_no = 0;
            if ($hediye_no_raw !== null && $hediye_no_raw !== '' && $hediye_no_raw !== '0' && $hediye_no_raw !== 0) {
                $hediye_no = intval($hediye_no_raw);
            }
            
            // Takas alanları - "0", 0, null, boş string kontrolü
            $takas_alinan_model_raw = $urun['takas_alinan_model'] ?? $urun['takas_model'] ?? null;
            $takas_alinan_model = '';
            if (!empty($takas_alinan_model_raw) && $takas_alinan_model_raw !== '0' && $takas_alinan_model_raw !== 0) {
                $takas_alinan_model = trim($takas_alinan_model_raw);
            }
            
            $takas_alinan_seri_kod_raw = $urun['takas_alinan_seri_kod'] ?? $urun['takas_seri_kod'] ?? $urun['takas_seri_no'] ?? null;
            $takas_alinan_seri_kod = '';
            if (!empty($takas_alinan_seri_kod_raw) && $takas_alinan_seri_kod_raw !== '0' && $takas_alinan_seri_kod_raw !== 0) {
                $takas_alinan_seri_kod = trim($takas_alinan_seri_kod_raw);
            }
            
            $takas_alinan_renk_raw = $urun['takas_alinan_renk'] ?? $urun['takas_renk'] ?? null;
            $takas_alinan_renk = '';
            if (!empty($takas_alinan_renk_raw) && $takas_alinan_renk_raw !== '0' && $takas_alinan_renk_raw !== 0) {
                $takas_alinan_renk = trim($takas_alinan_renk_raw);
            }
            
            // Fiyat alanları - string/number karışık gelebilir
            $satis_fiyati = str_replace([',', '₺', ' ', 'TL'], '', $urun['satis_fiyati'] ?? $urun['satis_fiyat'] ?? '0');
            $pesinat_fiyati = str_replace([',', '₺', ' ', 'TL'], '', $urun['pesinat_fiyati'] ?? $urun['pesinat_fiyat'] ?? '0');
            $kapora_fiyati = str_replace([',', '₺', ' ', 'TL'], '', $urun['kapora_fiyati'] ?? $urun['kapora_fiyat'] ?? '0');
            $fatura_tutari = str_replace([',', '₺', ' ', 'TL'], '', $urun['fatura_tutari'] ?? $urun['fatura_fiyati'] ?? '0');
            $takas_bedeli = str_replace([',', '₺', ' ', 'TL'], '', $urun['takas_bedeli'] ?? $urun['takas_fiyati'] ?? '0');
            
            // Başlıklar - array kontrolü (Siparis controller'daki mantığa göre JSON string olarak kaydedilir)
            $basliklar = '';
            $basliklar_raw = $urun['basliklar'] ?? $urun['baslik'] ?? null;
            if (!empty($basliklar_raw)) {
                if (is_string($basliklar_raw) && json_decode($basliklar_raw) !== null) {
                    $basliklar = $basliklar_raw;
                } elseif (is_array($basliklar_raw) && count($basliklar_raw) > 0) {
                    $basliklar = json_encode($basliklar_raw);
                }
            }
            
            // Sipariş notu - farklı field name'ler
            $siparis_notu_raw = $urun['siparis_notu'] ?? $urun['siparis_urun_notu'] ?? $urun['not'] ?? $urun['aciklama'] ?? null;
            $siparis_urun_notu = '';
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
                'satis_fiyati' => $satis_fiyati !== '' ? $satis_fiyati : 0,
                'pesinat_fiyati' => $pesinat_fiyati !== '' ? $pesinat_fiyati : 0,
                'kapora_fiyati' => $kapora_fiyati !== '' ? $kapora_fiyati : 0,
                'fatura_tutari' => $fatura_tutari !== '' ? $fatura_tutari : 0,
                'takas_bedeli' => $takas_bedeli !== '' ? $takas_bedeli : 0,
                'takas_alinan_seri_kod' => $takas_alinan_seri_kod !== '' ? $takas_alinan_seri_kod : 0,
                'takas_alinan_model' => $takas_alinan_model !== '' ? $takas_alinan_model : 0,
                'takas_alinan_renk' => $takas_alinan_renk !== '' ? $takas_alinan_renk : 0,
                'renk' => $renk !== 0 ? $renk : 0,
                'odeme_secenek' => $odeme_secenek !== 0 ? $odeme_secenek : 0,
                'vade_sayisi' => $vade_sayisi !== 0 ? $vade_sayisi : 0,
                'damla_etiket' => $damla_etiket !== 0 ? $damla_etiket : 0,
                'acilis_ekrani' => $acilis_ekrani !== 0 ? $acilis_ekrani : 0,
                'yenilenmis_cihaz_mi' => $yenilenmis_cihaz_mi !== 0 ? $yenilenmis_cihaz_mi : 0,
                'para_birimi' => $para_birimi,
                'hediye_no' => $hediye_no !== 0 ? $hediye_no : 0,
                'basliklar' => $basliklar !== '' ? $basliklar : 0,
                'siparis_urun_notu' => $siparis_urun_notu !== '' ? $siparis_urun_notu : 0,
                'siparis_urun_aktif' => 1  // Ürünün aktif olduğunu belirt
            ];
            
            // Ürün kaydını yap
            $insert_result = $this->Siparis_urun_model->insert($siparis_urun_data);
            $siparis_urun_id = $this->db->insert_id();
            
            // Hata kontrolü - insert işleminin başarılı olup olmadığını kontrol et
            $error = $this->db->error();
            if ($error['code'] != 0) {
                log_message('error', 'Api2::satis_olustur - Ürün kaydı başarısız: ' . $error['message']);
                $this->jsonResponse([
                    'status'  => 'error',
                    'message' => 'Ürün kaydı başarısız: ' . $error['message'],
                    'debug'   => [
                        'siparis_id' => $siparis_id,
                        'urun_no' => $urun_no,
                        'error_code' => $error['code']
                    ]
                ], 500);
                return;
            }
            
            if (!$siparis_urun_id) {
                log_message('error', 'Api2::satis_olustur - Ürün kaydı başarısız: insert_id döndü');
                $this->jsonResponse([
                    'status'  => 'error',
                    'message' => 'Ürün kaydı başarısız: insert_id alınamadı'
                ], 500);
                return;
            }
            
            // Ürün kaydedildikten sonra siparis_urun_aktif alanını kontrol et ve güncelle
            // Eğer veritabanında default değer 0 ise, manuel olarak 1 yap
            $check_aktif = $this->db->where('siparis_urun_id', $siparis_urun_id)
                                   ->get('siparis_urunleri')
                                   ->row();
            if (!$check_aktif) {
                log_message('error', 'Api2::satis_olustur - Ürün kaydı yapıldı ama veritabanında bulunamadı: ' . $siparis_urun_id);
                $this->jsonResponse([
                    'status'  => 'error',
                    'message' => 'Ürün kaydı yapıldı ama veritabanında bulunamadı'
                ], 500);
                return;
            }
            
            if (empty($check_aktif->siparis_urun_aktif) || $check_aktif->siparis_urun_aktif == 0) {
                $this->db->where('siparis_urun_id', $siparis_urun_id)
                         ->update('siparis_urunleri', ['siparis_urun_aktif' => 1]);
            }
            
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

        // Bildirim gönderme (Siparis controller'daki mantığa göre)
        $url = base_url('siparis/report/' . urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE" . $siparis_id . "Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE")));
        
        // Satış onayı yetkisi olan kullanıcılara SMS ve bildirim gönder
        $onay_yetkili_kullanicilar = $this->db
            ->where("yetki_kodu", "siparis_onay_3")
            ->join('kullanicilar', 'kullanicilar.kullanici_id = kullanici_yetki_tanimlari.kullanici_id')
            ->get("kullanici_yetki_tanimlari")
            ->result();
            
        if ($onay_yetkili_kullanicilar) {
            foreach ($onay_yetkili_kullanicilar as $kullanici_data) {
                // Eğer kullanıcının yöneticisi bu kullanıcı ise SMS ve bildirim gönder
                if ($kullanici->kullanici_yonetici_kullanici_id == $kullanici_data->kullanici_id) {
                    if (!empty($kullanici_data->kullanici_bireysel_iletisim_no)) {
                        $this->load->helper('site');
                        if (function_exists('sendSmsData')) {
                            sendSmsData($kullanici_data->kullanici_bireysel_iletisim_no, "Sn. " . $kullanici_data->kullanici_ad_soyad . " " . date("d.m.Y H:i") . " tarihinde işlem yapılan " . $siparis_kodu . " no'lu sipariş sizden satış onayı beklemektedir. Siparişi onaylamak için : " . $url);
                        }
                    }
                    
                    // Sistem bildirimi gönder
                    $this->_siparis_bildirimi_gonder($siparis_id, $siparis_kodu, $url, $kullanici_data->kullanici_id, $kullanici_id);
                }
            }
        }
        
        // Müdüre bildirim gönder (ID 9 - müdür)
       // $this->_siparis_bildirimi_gonder($siparis_id, $siparis_kodu, $url, 9, $kullanici_id);

        $this->jsonResponse([
            'status' => 'success',
            'message' => 'Satış başarıyla oluşturuldu.',
            'siparis_id' => $siparis_id,
            'siparis_kodu' => $siparis_kodu,
            'urunler_kaydedildi' => $urunler_kaydedildi,
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Sipariş bildirimi gönderme yardımcı fonksiyonu
     */
    private function _siparis_bildirimi_gonder($siparis_id, $siparis_kod_format, $url, $alici_id, $gonderen_id)
    {
        // Bildirim tipini getir, yoksa oluştur ve ID'sini al
        $bildirim_tipi = $this->db
            ->where('ad', 'Satış Bildirimi')
            ->get('bildirim_tipleri')
            ->row();

        if (!$bildirim_tipi) {
            $this->db->insert('bildirim_tipleri', [
                'ad' => 'Satış Bildirimi',
                'gereken_onay_seviyesi' => 2,
                'aciklama' => 'Yeni sipariş kayıtları için müdür onayı gerekir'
            ]);
            $tip_id = $this->db->insert_id();
        } else {
            $tip_id = $bildirim_tipi->id;
        }

        // Sipariş bilgisi
        $siparis = $this->db
            ->where('siparis_id', $siparis_id)
            ->get('siparisler')
            ->row();

        // Merkez bilgisi
        $merkez_adi = '';
        if ($siparis && !empty($siparis->merkez_no)) {
            $merkez = $this->db->where('merkez_id', $siparis->merkez_no)->get('merkezler')->row();
            if ($merkez) {
                $merkez_adi = $merkez->merkez_adi;
            }
        }

        // Gönderen kullanıcı bilgisi
        $gonderen = $this->db->where('kullanici_id', $gonderen_id)->get('kullanicilar')->row();

        // Mesaj
        $baslik = 'Yeni Sipariş Kaydı';
        $mesaj = ($gonderen ? $gonderen->kullanici_ad_soyad : 'Bir kullanıcı') . ' tarafından yeni bir sipariş kaydı oluşturuldu.';
        $mesaj .= "\n\nSipariş Kodu: " . $siparis_kod_format;
        if ($merkez_adi && $merkez_adi != '#NULL#') {
            $mesaj .= "\nMerkez: " . $merkez_adi;
        }
        if ($siparis && !empty($siparis->kayit_tarihi)) {
            $mesaj .= "\nKayıt Tarihi: " . date('d.m.Y H:i', strtotime($siparis->kayit_tarihi));
        } else {
            $mesaj .= "\nTarih: " . date('d.m.Y H:i');
        }
        $mesaj .= "\n\nDetay: " . $url;

        // Bildirim oluştur
        $this->db->insert('sistem_bildirimleri', [
            'tip_id' => $tip_id,
            'gonderen_id' => $gonderen_id,
            'baslik' => $baslik,
            'mesaj' => $mesaj,
            'okundu' => 0,
            'onay_durumu' => 'pending'
        ]);
        $bildirim_id = $this->db->insert_id();

        // Alıcı ilişkisi
        $this->db->insert('sistem_bildirim_alicilar', [
            'bildirim_id' => $bildirim_id,
            'alici_id' => $alici_id,
            'okundu' => 0
        ]);

        // Hareket kaydı
        $this->db->insert('sistem_bildirim_hareketleri', [
            'bildirim_id' => $bildirim_id,
            'kullanici_id' => $gonderen_id,
            'hareket_tipi' => 'gonderildi',
            'aciklama' => 'Sipariş bildirimi gönderildi - ' . $siparis_kod_format,
            'created_at' => date('Y-m-d H:i:s')
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

        // Tüm personelleri getir (kart okutma durumu dahil)
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

            // Ek durum kontrolleri
            $egitim_var_mi = egitim_var_mi($kullanici_id, $tarih) ? 1 : 0;
            $kurulum_var_mi = kurulum_var_mi($kullanici_id, $tarih) ? 1 : 0;
            $servis_var_mi = servis_var_mi($kullanici_id, $tarih) ? 1 : 0;
            $izin_var_mi = izin_var_mi($kullanici_id, $tarih) ? 1 : 0;
            $stajj = staj_musait_mi($kullanici_id, $tarih);
            $okulda_mi = $stajj ? 1 : 0; // Api.php'deki mantık ile aynı

            // Durum rengi belirleme
            $durum_renk = "green"; // Varsayılan kart okuttuysa yeşil göster
            if (!$kart_okutma_var) {
                $durum_renk = "red"; // Kart okutmadıysa kırmızı
            }
            if ($servis_var_mi == 1 || $izin_var_mi == 1 || $kurulum_var_mi == 1 || $egitim_var_mi == 1 || $okulda_mi == 1) {
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
                'mesai_takip_okutma_tarihi' => $kart_okutma_var ? $personel->mesai_takip_okutma_tarihi : null,
                'kart_okutma_var' => $kart_okutma_var,
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
            'message' => 'Tüm personeller getirildi.',
            'tarih' => $tarih,
            'data' => $formatted_data,
            'toplam_personel' => count($formatted_data),
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }

    /** 22. Siparişler Listesi - Tüm siparişleri listeler */
    public function siparisler()
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

        // Kullanıcı ID'sini al
        $kullanici_id = !empty($input_data['kullanici_id']) ? intval($input_data['kullanici_id']) : (!empty($input_data['user_id']) ? intval($input_data['user_id']) : null);
        
        if (empty($kullanici_id)) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'kullanici_id (veya user_id) gereklidir.'
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

        // Yetki kontrolü - tüm siparişleri görüntüleme yetkisi var mı?
        $has_permission = $this->db->where(['kullanici_id' => $kullanici_id, 'yetki_kodu' => 'tum_siparisleri_goruntule'])
                                   ->count_all_results('kullanici_yetki_tanimlari') > 0;

        // Yetki yoksa sadece kendi siparişlerini göster
        if (!$has_permission) {
            $this->db->where('siparisi_olusturan_kullanici', $kullanici_id);
        }

        // Arama parametresi
        $search = isset($input_data['search']) ? trim($input_data['search']) : '';
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('siparis_kodu', $search);
            $this->db->or_like('musteri_ad', $search);
            $this->db->or_like('musteri_iletisim_numarasi', str_replace(' ', '', $search));
            $this->db->or_like('merkez_adi', $search);
            $this->db->or_like('kullanici_ad_soyad', $search);
            $this->db->or_like('sehir_adi', $search);
            $this->db->or_like('ilce_adi', $search);
            $this->db->group_end();
        }

        // Sayfalama parametreleri
        $limit = isset($input_data['limit']) ? intval($input_data['limit']) : 50;
        $offset = isset($input_data['offset']) ? intval($input_data['offset']) : 0;
        $limit = min($limit, 100); // Maksimum 100 kayıt

        // Hariç tutulacak kullanıcılar
        $excluded_users = [1, 12, 11, 13];
        $this->db->where_not_in('siparisi_olusturan_kullanici', $excluded_users);
        $this->db->where('siparis_aktif', 1);

        // Siparişleri getir
        $query = $this->db
            ->select('siparisler.*,
                     kullanicilar.kullanici_ad_soyad,
                     kullanicilar.kullanici_id,
                     merkezler.merkez_adi,
                     merkezler.merkez_adresi,
                     merkezler.merkez_ulke_id,
                     ulkeler.ulke_adi,
                     musteriler.musteri_id,
                     musteriler.musteri_ad,
                     musteriler.musteri_iletisim_numarasi,
                     musteriler.musteri_sabit_numara,
                     sehirler.sehir_adi,
                     ilceler.ilce_adi,
                     siparis_onay_hareketleri.adim_no,
                     siparis_onay_adimlari.adim_adi')
            ->from('siparisler')
            ->join('merkezler', 'merkezler.merkez_id = siparisler.merkez_no')
            ->join('musteriler', 'musteriler.musteri_id = merkezler.merkez_yetkili_id')
            ->join('ulkeler', 'ulkeler.ulke_id = merkezler.merkez_ulke_id', 'left')
            ->join('sehirler', 'merkezler.merkez_il_id = sehirler.sehir_id', 'left')
            ->join('ilceler', 'merkezler.merkez_ilce_id = ilceler.ilce_id', 'left')
            ->join('kullanicilar', 'kullanicilar.kullanici_id = siparisler.siparisi_olusturan_kullanici', 'left')
            ->join(
                '(SELECT *, ROW_NUMBER() OVER (PARTITION BY siparis_no ORDER BY adim_no DESC) as row_num 
                  FROM siparis_onay_hareketleri) as siparis_onay_hareketleri',
                'siparis_onay_hareketleri.siparis_no = siparisler.siparis_id AND siparis_onay_hareketleri.row_num = 1',
                'left'
            )
            ->join('siparis_onay_adimlari', 'siparis_onay_adimlari.adim_id = siparis_onay_hareketleri.adim_no', 'left')
            ->order_by('siparisler.siparis_id', 'DESC')
            ->limit($limit, $offset)
            ->get();

        // Toplam kayıt sayısı (sayfalama için)
        $total_query = clone $this->db;
        if (!$has_permission) {
            $total_query->where('siparisi_olusturan_kullanici', $kullanici_id);
        }
        $total_query->where_not_in('siparisi_olusturan_kullanici', $excluded_users);
        $total_query->where('siparis_aktif', 1);
        if (!empty($search)) {
            $total_query->group_start();
            $total_query->like('siparis_kodu', $search);
            $total_query->or_like('musteri_ad', $search);
            $total_query->or_like('musteri_iletisim_numarasi', str_replace(' ', '', $search));
            $total_query->or_like('merkez_adi', $search);
            $total_query->or_like('kullanici_ad_soyad', $search);
            $total_query->or_like('sehir_adi', $search);
            $total_query->or_like('ilce_adi', $search);
            $total_query->group_end();
        }
        $total_records = $total_query->count_all_results('siparisler');

        // Siparişleri formatla
        $formatted_data = [];
        foreach ($query->result() as $row) {
            // Özel kontrol (belirli kullanıcı için belirli siparişi gizle)
            if ($kullanici_id == 2 && $row->siparis_id == 2687) {
                continue;
            }

            // Teslim durumu
            $teslim_edildi = ($row->adim_no > 11) ? true : false;

            // Merkez bilgisi formatla
            $merkez_bilgisi = '';
            if ($row->merkez_ulke_id == 190) {
                $merkez_bilgisi = $row->merkez_adi . ' / ' . $row->sehir_adi . ' (' . $row->ilce_adi . ')';
            } else {
                $merkez_bilgisi = $row->merkez_adi . ' / ' . ($row->ulke_adi ?? '');
            }

            $formatted_data[] = [
                'siparis_id' => intval($row->siparis_id),
                'siparis_kodu' => $row->siparis_kodu ?? null,
                'kayit_tarihi' => $row->kayit_tarihi ?? null,
                'kayit_tarihi_formatted' => $row->kayit_tarihi ? date('d.m.Y H:i', strtotime($row->kayit_tarihi)) : null,
                'musteri' => [
                    'musteri_id' => intval($row->musteri_id ?? 0),
                    'musteri_ad' => $row->musteri_ad ?? null,
                    'musteri_iletisim_numarasi' => $row->musteri_iletisim_numarasi ?? null,
                    'musteri_sabit_numara' => $row->musteri_sabit_numara ?? null
                ],
                'merkez' => [
                    'merkez_id' => intval($row->merkez_no ?? 0),
                    'merkez_adi' => $row->merkez_adi ?? null,
                    'merkez_adresi' => $row->merkez_adresi ?? null,
                    'merkez_bilgisi' => $merkez_bilgisi,
                    'sehir_adi' => $row->sehir_adi ?? null,
                    'ilce_adi' => $row->ilce_adi ?? null,
                    'ulke_adi' => $row->ulke_adi ?? null
                ],
                'olusturan_kullanici' => [
                    'kullanici_id' => intval($row->siparisi_olusturan_kullanici ?? 0),
                    'kullanici_ad_soyad' => $row->kullanici_ad_soyad ?? null
                ],
                'onay_durumu' => [
                    'adim_no' => !empty($row->adim_no) ? intval($row->adim_no) : null,
                    'adim_adi' => $row->adim_adi ?? null,
                    'teslim_edildi' => $teslim_edildi
                ],
                'siparis_gorusme_aciklama' => $row->siparis_gorusme_aciklama ?? null,
                'siparis_gorusme_aciklama_guncelleme_tarihi' => $row->siparis_gorusme_aciklama_guncelleme_tarihi ?? null
            ];
        }

        $this->jsonResponse([
            'status' => 'success',
            'message' => 'Siparişler başarıyla getirildi.',
            'data' => $formatted_data,
            'pagination' => [
                'limit' => $limit,
                'offset' => $offset,
                'total_records' => $total_records,
                'total_pages' => ceil($total_records / $limit),
                'current_page' => floor($offset / $limit) + 1
            ],
            'has_permission' => $has_permission,
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }

    /** 23. Üretim Planlama - Üretim planlarını listeler */
    public function uretim_planlama()
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

        // Kullanıcı ID'sini al (opsiyonel - yetki kontrolü için)
        $kullanici_id = !empty($input_data['kullanici_id']) ? intval($input_data['kullanici_id']) : (!empty($input_data['user_id']) ? intval($input_data['user_id']) : null);
        
        // Tarih aralığı parametreleri (opsiyonel)
        $baslangic_tarihi = isset($input_data['baslangic_tarihi']) ? trim($input_data['baslangic_tarihi']) : null;
        $bitis_tarihi = isset($input_data['bitis_tarihi']) ? trim($input_data['bitis_tarihi']) : null;
        
        // Onay durumu filtresi (opsiyonel: 0=onay bekliyor, 1=onaylandı, null=tümü)
        $onay_durumu = isset($input_data['onay_durumu']) ? intval($input_data['onay_durumu']) : null;
        
        // Sadece aktif kayıtlar (varsayılan: true)
        $aktif_kayit = isset($input_data['aktif_kayit']) ? intval($input_data['aktif_kayit']) : 1;

        // Tarih aralığı yoksa haftalık görünüm (bu hafta pazartesi - gelecek hafta cuma)
        if (empty($baslangic_tarihi) && empty($bitis_tarihi)) {
            $baslangicTimestamp = strtotime('monday this week');
            $sonrakiPazartesiTimestamp = strtotime('friday next week');
            $baslangic_tarihi = date('Y-m-d 00:00:00', $baslangicTimestamp);
            $bitis_tarihi = date('Y-m-d 23:59:59', $sonrakiPazartesiTimestamp);
        } else {
            // Tarih formatı kontrolü
            if (!empty($baslangic_tarihi) && !strtotime($baslangic_tarihi)) {
                $this->jsonResponse([
                    'status'  => 'error',
                    'message' => 'Geçersiz başlangıç tarihi formatı. Format: Y-m-d veya Y-m-d H:i:s'
                ], 400);
            }
            if (!empty($bitis_tarihi) && !strtotime($bitis_tarihi)) {
                $this->jsonResponse([
                    'status'  => 'error',
                    'message' => 'Geçersiz bitiş tarihi formatı. Format: Y-m-d veya Y-m-d H:i:s'
                ], 400);
            }
            
            // Tarih formatını düzelt
            if (!empty($baslangic_tarihi) && strlen($baslangic_tarihi) == 10) {
                $baslangic_tarihi .= ' 00:00:00';
            }
            if (!empty($bitis_tarihi) && strlen($bitis_tarihi) == 10) {
                $bitis_tarihi .= ' 23:59:59';
            }
        }

        // Sorgu oluştur
        $this->db->select('uretim_planlama.*,
                          urunler.urun_id,
                          urunler.urun_adi,
                            urun_renkleri.renk_id,
                            urun_renkleri.renk_adi')
                    ->from('uretim_planlama')
                 ->join('urunler', 'urunler.urun_id = uretim_planlama.urun_fg_id', 'left')
                 ->join('urun_renkleri', 'urun_renkleri.renk_id = uretim_planlama.renk_fg_id', 'left');

        // Tarih filtresi
        if (!empty($baslangic_tarihi)) {
            $this->db->where('uretim_tarihi >=', $baslangic_tarihi);
        }
        if (!empty($bitis_tarihi)) {
            $this->db->where('uretim_tarihi <=', $bitis_tarihi);
        }

        // Onay durumu filtresi
        if ($onay_durumu !== null) {
            $this->db->where('onay_durumu', $onay_durumu);
        }

        // Aktif kayıt filtresi
        if ($aktif_kayit !== null) {
            $this->db->where('aktif_kayit', $aktif_kayit);
        }

        // Sıralama
        $this->db->order_by('onay_durumu', 'ASC')
                 ->order_by('uretim_tarihi', 'DESC');

        $query = $this->db->get();
        $results = $query->result();

        // Verileri formatla
        $formatted_data = [];
        foreach ($results as $row) {
            $formatted_data[] = [
                'uretim_planlama_id' => intval($row->uretim_planlama_id),
                'urun' => [
                    'urun_id' => !empty($row->urun_id) ? intval($row->urun_id) : null,
                    'urun_adi' => $row->urun_adi ?? null
                ],
                'renk' => [
                    'renk_id' => !empty($row->renk_id) ? intval($row->renk_id) : null,
                    'renk_adi' => $row->renk_adi ?? null
                ],
                'baslik_bilgisi' => $row->baslik_bilgisi ?? null,
                'uretim_tarihi' => $row->uretim_tarihi ?? null,
                'uretim_tarihi_formatted' => $row->uretim_tarihi ? date('d.m.Y H:i', strtotime($row->uretim_tarihi)) : null,
                'kayit_notu' => $row->kayit_notu ?? null,
                'guncelleme_notu' => $row->guncelleme_notu ?? null,
                'onay_durumu' => !empty($row->onay_durumu) ? intval($row->onay_durumu) : 0,
                'onay_durumu_text' => !empty($row->onay_durumu) ? 'Onaylandı' : 'Onay Bekliyor',
                'aktif_kayit' => !empty($row->aktif_kayit) ? intval($row->aktif_kayit) : 0,
                'kayit_tarihi' => $row->kayit_tarihi ?? null,
                'guncelleme_tarihi' => $row->guncelleme_tarihi ?? null
            ];
        }

        // Haftalık görünüm için tarih bilgileri
        $haftalik_tarihler = [];
        if (empty($input_data['baslangic_tarihi']) && empty($input_data['bitis_tarihi'])) {
            $baslangicTimestamp = strtotime('monday this week');
            for ($i = 0; $i < 12; $i++) {
                $haftalik_tarihler[] = [
                    'gun_no' => $i + 1,
                    'tarih' => date('Y-m-d', strtotime("+{$i} days", $baslangicTimestamp)),
                    'tarih_formatted' => date('d.m.Y', strtotime("+{$i} days", $baslangicTimestamp))
                ];
            }
        }

        $this->jsonResponse([
            'status' => 'success',
            'message' => 'Üretim planları başarıyla getirildi.',
            'data' => $formatted_data,
            'filtreler' => [
                'baslangic_tarihi' => $baslangic_tarihi,
                'bitis_tarihi' => $bitis_tarihi,
                'onay_durumu' => $onay_durumu,
                'aktif_kayit' => $aktif_kayit
            ],
            'haftalik_tarihler' => $haftalik_tarihler,
            'toplam_kayit' => count($formatted_data),
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }

    /** 24. Showroom Cihazları - Showroom cihazlarını listeler */
    public function showrooms()
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

        // Kullanıcı ID'sini al (opsiyonel - yetki kontrolü için)
        $kullanici_id = !empty($input_data['kullanici_id']) ? intval($input_data['kullanici_id']) : (!empty($input_data['user_id']) ? intval($input_data['user_id']) : null);
        
        // Showroom filtresi (opsiyonel: 1=Adana, 2=İstanbul, 3=Ankara, null=tümü)
        $showroom_no = isset($input_data['showroom_no']) ? intval($input_data['showroom_no']) : null;

        // Sorgu oluştur
        $this->db->select('showroom_cihazlar.*,
                          urunler.urun_id,
                          urunler.urun_adi,
                          urunler.urun_slug')
                 ->from('showroom_cihazlar')
                 ->join('urunler', 'urunler.urun_id = showroom_cihazlar.showroom_cihaz_urun_no', 'left');

        // Showroom filtresi
        if ($showroom_no !== null && in_array($showroom_no, [1, 2, 3])) {
            $this->db->where('showroom_cihaz_bolum_no', $showroom_no);
        }

        // Sıralama
        $this->db->order_by('showroom_cihaz_bolum_no', 'ASC')
                 ->order_by('showroom_cihaz_id', 'DESC');

        $query = $this->db->get();
        $results = $query->result();

        // Verileri formatla
        $formatted_data = [];
        $showroom_istatistik = [
            'adana' => 0,
            'istanbul' => 0,
            'ankara' => 0
        ];

        foreach ($results as $row) {
            // Showroom adı
            $showroom_adi = '';
            if ($row->showroom_cihaz_bolum_no == 1) {
                $showroom_adi = 'ADANA SHOWROOM';
                $showroom_istatistik['adana']++;
            } elseif ($row->showroom_cihaz_bolum_no == 2) {
                $showroom_adi = 'İSTANBUL SHOWROOM';
                $showroom_istatistik['istanbul']++;
            } elseif ($row->showroom_cihaz_bolum_no == 3) {
                $showroom_adi = 'ANKARA SHOWROOM';
                $showroom_istatistik['ankara']++;
            }

            // Ürün görsel URL'i
            $urun_gorsel_url = null;
            if (!empty($row->urun_slug)) {
                $urun_gorsel_url = "https://www.umex.com.tr/uploads/products/" . $row->urun_slug . ".png";
            }

            $formatted_data[] = [
                'showroom_cihaz_id' => intval($row->showroom_cihaz_id),
                'showroom_no' => intval($row->showroom_cihaz_bolum_no),
                'showroom_adi' => $showroom_adi,
                'seri_no' => $row->showroom_cihaz_seri_no ?? null,
                'urun' => [
                    'urun_id' => !empty($row->urun_id) ? intval($row->urun_id) : null,
                    'urun_adi' => $row->urun_adi ?? null,
                    'urun_slug' => $row->urun_slug ?? null,
                    'urun_gorsel_url' => $urun_gorsel_url
                ]
            ];
        }

        $this->jsonResponse([
            'status' => 'success',
            'message' => 'Showroom cihazları başarıyla getirildi.',
            'data' => $formatted_data,
            'istatistikler' => [
                'toplam_cihaz' => count($formatted_data),
                'adana_showroom' => $showroom_istatistik['adana'],
                'istanbul_showroom' => $showroom_istatistik['istanbul'],
                'ankara_showroom' => $showroom_istatistik['ankara']
            ],
            'filtreler' => [
                'showroom_no' => $showroom_no
            ],
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }

    /** 25. Depo Onay Talepleri - Depo onay taleplerini listeler */
    public function depo_onay()
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

        // kullanıcı_id parametresi gelebilir ama zorunlu değildir, ve filtreleme/işlemde kullanılmaz!
        // Sorgu oluştur
        $this->db->select('stok_onaylar.*,
                          kkul.kullanici_ad_soyad as kayit_kullanici_ad_soyad,
                          kkul.kullanici_id as kayit_kullanici_id,
                          tkul.kullanici_ad_soyad as teslim_kullanici_ad_soyad,
                          tkul.kullanici_id as teslim_kullanici_id')
                 ->from('stok_onaylar')
                 ->join('kullanicilar as kkul', 'kkul.kullanici_id = stok_onaylar.talep_olusturan_kullanici_no', 'left')
                 ->join('kullanicilar as tkul', 'tkul.kullanici_id = stok_onaylar.teslim_alacak_kullanici_no', 'left')
                 ->where('stok_onaylar.kayit_durum', 1);

        // Sıralama
        $this->db->order_by('stok_onay_id', 'DESC');

        $query = $this->db->get();
        $results = $query->result();

        // Verileri formatla
        $formatted_data = [];
        foreach ($results as $row) {
            // Onay durumları
            $on_onay_durumu = intval($row->on_onay_durumu ?? 0);
            $birinci_onay_durumu = intval($row->birinci_onay_durumu ?? 0);
            $teslim_alma_onayi = intval($row->teslim_alma_onayi ?? 0);
            $kayit_durum = intval($row->kayit_durum ?? 0);

            // Durum metinleri
            $on_onay_durumu_text = $on_onay_durumu == 1 ? 'Ön Onay Verildi' : 'Ön Onay Bekleniyor';
            $birinci_onay_durumu_text = $birinci_onay_durumu == 1 ? 'Çıkış Onayı Verildi' : ($on_onay_durumu == 1 ? 'Çıkış Onayı Bekleniyor' : 'Ön Onay Bekleniyor');
            $teslim_alma_onayi_text = $teslim_alma_onayi == 1 ? 'Teslim Alındı' : ($birinci_onay_durumu == 1 ? 'Teslim Onayı Bekleniyor' : 'Çıkış Onayı Bekleniyor');
            $kayit_durum_text = $kayit_durum == 1 ? 'Aktif' : 'İptal Edildi';

            // Tarih formatları
            $talep_tarihi = $row->talep_olusturulma_tarihi ?? null;
            $talep_tarihi_formatted = $talep_tarihi ? date('d.m.Y H:i', strtotime($talep_tarihi)) : null;

            $on_onay_tarihi = $row->on_onay_tarihi ?? null;
            $on_onay_tarihi_formatted = $on_onay_tarihi ? date('d.m.Y H:i', strtotime($on_onay_tarihi)) : null;

            $birinci_onay_tarihi = $row->birinci_onay_tarihi ?? null;
            $birinci_onay_tarihi_formatted = $birinci_onay_tarihi ? date('d.m.Y H:i', strtotime($birinci_onay_tarihi)) : null;

            $teslim_alma_tarihi = $row->teslim_alma_onay_tarihi ?? null;
            $teslim_alma_tarihi_formatted = $teslim_alma_tarihi ? date('d.m.Y H:i', strtotime($teslim_alma_tarihi)) : null;

            $formatted_data[] = [
                'stok_onay_id' => intval($row->stok_onay_id),
                'talep_olusturan' => [
                    'kullanici_id' => !empty($row->kayit_kullanici_id) ? intval($row->kayit_kullanici_id) : null,
                    'kullanici_ad_soyad' => $row->kayit_kullanici_ad_soyad ?? null
                ],
                'teslim_alacak' => [
                    'kullanici_id' => !empty($row->teslim_kullanici_id) ? intval($row->teslim_kullanici_id) : null,
                    'kullanici_ad_soyad' => $row->teslim_kullanici_ad_soyad ?? null
                ],
                'talep_tarihi' => $talep_tarihi,
                'talep_tarihi_formatted' => $talep_tarihi_formatted,
                'on_onay' => [
                    'durum' => $on_onay_durumu,
                    'durum_text' => $on_onay_durumu_text,
                    'tarih' => $on_onay_tarihi,
                    'tarih_formatted' => $on_onay_tarihi_formatted,
                    'kullanici_id' => !empty($row->on_onay_kullanici_no) ? intval($row->on_onay_kullanici_no) : null
                ],
                'birinci_onay' => [
                    'durum' => $birinci_onay_durumu,
                    'durum_text' => $birinci_onay_durumu_text,
                    'tarih' => $birinci_onay_tarihi,
                    'tarih_formatted' => $birinci_onay_tarihi_formatted,
                    'kullanici_id' => !empty($row->birinci_onay_kullanici_no) ? intval($row->birinci_onay_kullanici_no) : null
                ],
                'teslim_alma' => [
                    'durum' => $teslim_alma_onayi,
                    'durum_text' => $teslim_alma_onayi_text,
                    'tarih' => $teslim_alma_tarihi,
                    'tarih_formatted' => $teslim_alma_tarihi_formatted
                ],
                'kayit_durum' => $kayit_durum,
                'kayit_durum_text' => $kayit_durum_text
            ];
        }

        // İstatistikler
        $istatistikler = [
            'toplam_talep' => count($formatted_data),
            'on_onay_bekleyen' => count(array_filter($formatted_data, function($item) { return $item['on_onay']['durum'] == 0 && $item['kayit_durum'] == 1; })),
            'cikis_onayi_bekleyen' => count(array_filter($formatted_data, function($item) { return $item['on_onay']['durum'] == 1 && $item['birinci_onay']['durum'] == 0 && $item['kayit_durum'] == 1; })),
            'teslim_onayi_bekleyen' => count(array_filter($formatted_data, function($item) { return $item['birinci_onay']['durum'] == 1 && $item['teslim_alma']['durum'] == 0 && $item['kayit_durum'] == 1; })),
            'tamamlanan' => count(array_filter($formatted_data, function($item) { return $item['teslim_alma']['durum'] == 1 && $item['kayit_durum'] == 1; })),
            'iptal_edilen' => count(array_filter($formatted_data, function($item) { return $item['kayit_durum'] == 0; }))
        ];

        $this->jsonResponse([
            'status' => 'success',
            'message' => 'Depo onay talepleri başarıyla getirildi.',
            'data' => $formatted_data,
            'istatistikler' => $istatistikler,
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }

    /** 26. Sipariş Detayları - Tek bir siparişin tüm detaylarını getirir */
    public function siparis_report()
    {
        // Filtreleri kaldırdık: Sadece siparis_id ile sipariş detayını getiriyoruz
        $input_data = $this->input->method(true) === 'POST'
            ? (json_decode(file_get_contents('php://input'), true) ?? [])
            : $this->input->get();

        // Sipariş ID veya kodu al
        $siparis_id = null;
        $siparis_kodu = null;
        
        if (!empty($input_data['siparis_id'])) {
            $siparis_id = intval($input_data['siparis_id']);
        } elseif (!empty($input_data['siparis_kodu'])) {
            // siparis_kodu string olarak gelebilir (örn: "SPR1712202412345")
            $siparis_kodu_raw = trim($input_data['siparis_kodu']);
            
            // Eğer numeric ise siparis_id olarak kabul et
            if (is_numeric($siparis_kodu_raw)) {
                $siparis_id = intval($siparis_kodu_raw);
            } else {
                // String ise siparis_kodu olarak kabul et
                $siparis_kodu = $siparis_kodu_raw;
            }
        }

        if (empty($siparis_id) && empty($siparis_kodu)) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'siparis_id (veya siparis_kodu) gereklidir.'
            ], 400);
        }

        // Sipariş modelini yükle
        $this->load->model('Siparis_model');
        
        // Sipariş bilgisini al
        $siparis = null;
        
        if (!empty($siparis_id)) {
            // siparis_id ile ara
            $siparis = $this->Siparis_model->get_by_id($siparis_id);
        } elseif (!empty($siparis_kodu)) {
            // siparis_kodu ile ara (string)
            $this->db->where(["siparis_aktif" => 1]);
            $this->db->where("siparis_kodu", $siparis_kodu);
            $query = $this->db
                ->select('siparisler.*, merkezler.*, musteriler.*,ulkeler.*, sehirler.sehir_adi, ilceler.ilce_adi,siparis_onay_hareketleri.*,siparis_onay_adimlari.*,sirket_araclari.*')
                ->from('siparisler')
                ->join('merkezler', 'merkezler.merkez_id = siparisler.merkez_no')
                ->join('musteriler', 'musteriler.musteri_id = merkezler.merkez_yetkili_id')
                ->join('sehirler', 'merkezler.merkez_il_id = sehirler.sehir_id', 'left')
                ->join('ilceler', 'merkezler.merkez_ilce_id = ilceler.ilce_id', 'left')
                ->join('ulkeler', 'merkezler.merkez_ulke_id = ulkeler.ulke_id', 'left')
                ->join('sirket_araclari', 'sirket_araclari.sirket_arac_id = kurulum_arac_plaka','left')
                ->join(
                    '(SELECT *, ROW_NUMBER() OVER (PARTITION BY siparis_no ORDER BY onay_tarih DESC) as row_num
                      FROM siparis_onay_hareketleri) as siparis_onay_hareketleri',
                    'siparis_onay_hareketleri.siparis_no = siparisler.siparis_id AND siparis_onay_hareketleri.row_num = 1',
                    'left'
                )
                ->join('siparis_onay_adimlari', 'siparis_onay_adimlari.adim_id = adim_no', 'left')
                ->order_by('siparisler.siparis_id', 'ASC')
                ->get();
            
            if ($query && $query->num_rows()) {
                $siparis = $query->result();
                // siparis_id'yi al
                $siparis_id = $siparis[0]->siparis_id;
            }
        }
        
        if (!$siparis || empty($siparis)) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Sipariş bulunamadı.'
            ], 404);
        }

        $siparis_data = $siparis[0];

        // Ürünleri getir
        $urunler = $this->Siparis_model->get_all_products_by_order_id($siparis_id);
        
        // Onay hareketlerini getir
        $hareketler = $this->Siparis_model->get_all_actions_by_order_id($siparis_id);
        
        // Onay adımlarını getir
        $adimlar = $this->Siparis_model->get_all_steps();
        
        // Ara ödemeleri getir
        $ara_odemeler = $this->db->where("siparis_ara_odeme_siparis_no", $siparis_id)
                                 ->get("siparis_ara_odemeler")
                                 ->result();
        
        // Takas fotoğraflarını getir
        $takas_fotograflari = $this->db->where("siparis_id", $siparis_id)
                                       ->get("takas_urun_fotograflari")
                                       ->result();
        
        // Kurulum ekibi
        $kurulum_ekip = [];
        if (!empty($siparis_data->kurulum_ekip)) {
            $kurulum_ekip_ids = explode(',', $siparis_data->kurulum_ekip);
            $kurulum_ekip = $this->db->where_in('kullanici_id', $kurulum_ekip_ids)
                                    ->get('kullanicilar')
                                    ->result();
        }
        
        // Eğitim ekibi
        $egitim_ekip = [];
        if (!empty($siparis_data->egitim_ekip)) {
            $egitim_ekip_ids = explode(',', $siparis_data->egitim_ekip);
            $egitim_ekip = $this->db->where_in('kullanici_id', $egitim_ekip_ids)
                                    ->get('kullanicilar')
                                    ->result();
        }
        
        // Siparişi oluşturan kullanıcı
        $siparisi_olusturan = $this->db->where('kullanici_id', $siparis_data->siparisi_olusturan_kullanici)
                                       ->get('kullanicilar')
                                       ->row();

        // Güncel adım
        $guncel_adim = !empty($hareketler) ? (end($hareketler)->adim_no + 1) : 1;
        
        // Teslim durumu
        $teslim_edildi = false;
        if (!empty($hareketler)) {
            $son_adim = end($hareketler)->adim_no;
            $teslim_edildi = ($son_adim > 11);
        }

        // Merkez bilgisi formatla
        $merkez_bilgisi = '';
        if ($siparis_data->merkez_ulke_id == 190) {
            $merkez_bilgisi = $siparis_data->merkez_adi . ' / ' . $siparis_data->sehir_adi . ' (' . $siparis_data->ilce_adi . ')';
        } else {
            $merkez_bilgisi = $siparis_data->merkez_adi . ' / ' . ($siparis_data->ulke_adi ?? '');
        }

        // Ürünleri formatla
        $formatted_urunler = [];
        foreach ($urunler as $urun) {
            // Başlıkları decode et
            $basliklar = [];
            if (!empty($urun->basliklar)) {
                // Önce JSON string olarak decode et
                $basliklar_json = json_decode($urun->basliklar, true);
                if (is_array($basliklar_json)) {
                    $basliklar = $basliklar_json;
                } else {
                    // Eğer JSON değilse base64 decode dene
                    $basliklar_decoded = json_decode(base64_decode($urun->basliklar), true);
                    if (is_array($basliklar_decoded)) {
                        $basliklar = $basliklar_decoded;
                    }
                }
            }

            $urun_data = [
                'siparis_urun_id' => intval($urun->siparis_urun_id),
                'urun' => [
                    'urun_id' => intval($urun->s_urun_no ?? $urun->urun_id ?? 0),
                    'urun_adi' => $urun->urun_adi ?? null,
                    'urun_aciklama' => $urun->urun_aciklama ?? null
                ],
                'renk' => [
                    'renk_id' => !empty($urun->renk_id) ? intval($urun->renk_id) : null,
                    'renk_adi' => $urun->renk_adi ?? null
                ],
                'basliklar' => $basliklar,
                'seri_numarasi' => $urun->seri_numarasi ?? null,
                'damla_etiket' => !empty($urun->damla_etiket) ? intval($urun->damla_etiket) : null,
                'acilis_ekrani' => !empty($urun->acilis_ekrani) ? intval($urun->acilis_ekrani) : null,
                'yenilenmis_cihaz_mi' => !empty($urun->yenilenmis_cihaz_mi) ? intval($urun->yenilenmis_cihaz_mi) : 0,
                'odeme_secenek' => !empty($urun->odeme_secenek) ? intval($urun->odeme_secenek) : null,
                'odeme_secenek_text' => !empty($urun->odeme_secenek) ? ($urun->odeme_secenek == 1 ? 'Peşin' : 'Vadeli') : null,
                'vade_sayisi' => !empty($urun->vade_sayisi) ? intval($urun->vade_sayisi) : null,
                'para_birimi' => $urun->para_birimi ?? 'TRY',
                'hediye' => [
                    'hediye_id' => !empty($urun->siparis_hediye_id) ? intval($urun->siparis_hediye_id) : null,
                    'hediye_adi' => $urun->siparis_hediye_adi ?? null
                ],
                'takas_alinan_model' => $urun->takas_alinan_model ?? null,
                'takas_alinan_seri_kod' => $urun->takas_alinan_seri_kod ?? null,
                'takas_alinan_renk' => $urun->takas_alinan_renk ?? null,
                'takas_cihaz_mi' => !empty($urun->takas_cihaz_mi) ? intval($urun->takas_cihaz_mi) : 0,
                'siparis_urun_notu' => $urun->siparis_urun_notu ?? null
            ];

            // Filtreler kaldırıldığı için fiyatı her zaman göster
            $urun_data['fiyatlar'] = [
                'satis_fiyati' => !empty($urun->satis_fiyati) ? floatval($urun->satis_fiyati) : null,
                'pesinat_fiyati' => !empty($urun->pesinat_fiyati) ? floatval($urun->pesinat_fiyati) : null,
                'kapora_fiyati' => !empty($urun->kapora_fiyati) ? floatval($urun->kapora_fiyati) : null,
                'fatura_tutari' => !empty($urun->fatura_tutari) ? floatval($urun->fatura_tutari) : null,
                'takas_bedeli' => !empty($urun->takas_bedeli) ? floatval($urun->takas_bedeli) : null
            ];

            $formatted_urunler[] = $urun_data;
        }

        // Onay hareketlerini formatla
        $formatted_hareketler = [];
        foreach ($hareketler as $hareket) {
            $formatted_hareketler[] = [
                'siparis_onay_hareket_id' => intval($hareket->siparis_onay_hareket_id),
                'adim_no' => intval($hareket->adim_no),
                'adim_adi' => $hareket->adim_adi ?? null,
                'onay_durum' => !empty($hareket->onay_durum) ? intval($hareket->onay_durum) : 0,
                'onay_aciklama' => $hareket->onay_aciklama ?? null,
                'onay_tarih' => $hareket->onay_tarih ?? null,
                'onay_tarih_formatted' => $hareket->onay_tarih ? date('d.m.Y H:i', strtotime($hareket->onay_tarih)) : null,
                'onay_kullanici' => [
                    'kullanici_id' => !empty($hareket->kullanici_id) ? intval($hareket->kullanici_id) : null,
                    'kullanici_ad_soyad' => $hareket->kullanici_ad_soyad ?? null,
                    'departman_adi' => $hareket->departman_adi ?? null
                ]
            ];
        }

        // Ara ödemeleri formatla
        $formatted_ara_odemeler = [];
        foreach ($ara_odemeler as $odeme) {
            $formatted_ara_odemeler[] = [
                'siparis_ara_odeme_id' => intval($odeme->siparis_ara_odeme_id),
                'odeme_tutari' => !empty($odeme->siparis_ara_odeme_tutari) ? floatval($odeme->siparis_ara_odeme_tutari) : null,
                'odeme_tarihi' => $odeme->siparis_ara_odeme_tarihi ?? null,
                'odeme_tarihi_formatted' => $odeme->siparis_ara_odeme_tarihi ? date('d.m.Y H:i', strtotime($odeme->siparis_ara_odeme_tarihi)) : null,
                'odeme_aciklama' => $odeme->siparis_ara_odeme_aciklama ?? null
            ];
        }

        // Takas fotoğraflarını formatla
        $formatted_takas_fotograflari = [];
        foreach ($takas_fotograflari as $foto) {
            $formatted_takas_fotograflari[] = [
                'takas_urun_fotograf_id' => intval($foto->takas_urun_fotograf_id),
                'urun_id' => !empty($foto->urun_id) ? intval($foto->urun_id) : null,
                'foto_url' => $foto->foto_url ? base_url($foto->foto_url) : null,
                'foto_path' => $foto->foto_url ?? null
            ];
        }

        // Kurulum ekibini formatla
        $formatted_kurulum_ekip = [];
        foreach ($kurulum_ekip as $kullanici) {
            $formatted_kurulum_ekip[] = [
                'kullanici_id' => intval($kullanici->kullanici_id),
                'kullanici_ad_soyad' => $kullanici->kullanici_ad_soyad ?? null
            ];
        }

        // Eğitim ekibini formatla
        $formatted_egitim_ekip = [];
        foreach ($egitim_ekip as $kullanici) {
            $formatted_egitim_ekip[] = [
                'kullanici_id' => intval($kullanici->kullanici_id),
                'kullanici_ad_soyad' => $kullanici->kullanici_ad_soyad ?? null
            ];
        }

        // Tüm onay adımlarını formatla
        $formatted_adimlar = [];
        foreach ($adimlar as $adim) {
            $formatted_adimlar[] = [
                'adim_id' => intval($adim->adim_id),
                'adim_adi' => $adim->adim_adi ?? null,
                'adim_sira_numarasi' => !empty($adim->adim_sira_numarasi) ? intval($adim->adim_sira_numarasi) : null
            ];
        }

        // Response oluştur
        $response = [
            'status' => 'success',
            'message' => 'Sipariş detayları başarıyla getirildi.',
            'data' => [
                'siparis' => [
                    'siparis_id' => intval($siparis_data->siparis_id),
                    'siparis_kodu' => $siparis_data->siparis_kodu ?? null,
                    'kayit_tarihi' => $siparis_data->kayit_tarihi ?? null,
                    'kayit_tarihi_formatted' => $siparis_data->kayit_tarihi ? date('d.m.Y H:i', strtotime($siparis_data->kayit_tarihi)) : null,
                    'beklemede' => !empty($siparis_data->beklemede) ? intval($siparis_data->beklemede) : 0,
                    'siparis_ust_satis_onayi' => !empty($siparis_data->siparis_ust_satis_onayi) ? intval($siparis_data->siparis_ust_satis_onayi) : 0,
                    'siparis_ust_satis_onay_tarihi' => $siparis_data->siparis_ust_satis_onay_tarihi ?? null,
                    'siparis_gorusme_aciklama' => $siparis_data->siparis_gorusme_aciklama ?? null,
                    'siparis_gorusme_aciklama_guncelleme_tarihi' => $siparis_data->siparis_gorusme_aciklama_guncelleme_tarihi ?? null
                ],
                'musteri' => [
                    'musteri_id' => intval($siparis_data->musteri_id ?? 0),
                    'musteri_ad' => $siparis_data->musteri_ad ?? null,
                    'musteri_iletisim_numarasi' => $siparis_data->musteri_iletisim_numarasi ?? null,
                    'musteri_sabit_numara' => $siparis_data->musteri_sabit_numara ?? null,
                    'musteri_tckn' => $siparis_data->musteri_tckn ?? null
                ],
                'merkez' => [
                    'merkez_id' => intval($siparis_data->merkez_id ?? 0),
                    'merkez_adi' => $siparis_data->merkez_adi ?? null,
                    'merkez_adresi' => $siparis_data->merkez_adresi ?? null,
                    'merkez_bilgisi' => $merkez_bilgisi,
                    'sehir_adi' => $siparis_data->sehir_adi ?? null,
                    'ilce_adi' => $siparis_data->ilce_adi ?? null,
                    'ulke_adi' => $siparis_data->ulke_adi ?? null
                ],
                'olusturan_kullanici' => [
                    'kullanici_id' => !empty($siparisi_olusturan) ? intval($siparisi_olusturan->kullanici_id) : null,
                    'kullanici_ad_soyad' => $siparisi_olusturan->kullanici_ad_soyad ?? null
                ],
                'onay_durumu' => [
                    'guncel_adim' => $guncel_adim,
                    'teslim_edildi' => $teslim_edildi,
                    'adim_no' => !empty($hareketler) ? intval(end($hareketler)->adim_no) : null,
                    'adim_adi' => !empty($hareketler) ? (end($hareketler)->adim_adi ?? null) : null
                ],
                'urunler' => $formatted_urunler,
                'onay_hareketleri' => $formatted_hareketler,
                'onay_adimlari' => $formatted_adimlar,
                'ara_odemeler' => $formatted_ara_odemeler,
                'takas_fotograflari' => $formatted_takas_fotograflari,
                'kurulum_ekip' => $formatted_kurulum_ekip,
                'egitim_ekip' => $formatted_egitim_ekip
            ],
            // Filtreler kaldırıldığı için fiyat görüntüleme izni her zaman true
            'permissions' => [
                'can_view_price' => true,
                'has_all_permission' => true
            ],
            'timestamp' => date('Y-m-d H:i:s')
        ];

        $this->jsonResponse($response);
    }

    /** 28. Talep Listesi - Tüm taleplerim ve filtreli talepler */
    public function talepler()
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

        // Kullanıcı ID'sini al
        $kullanici_id = !empty($input_data['kullanici_id']) ? intval($input_data['kullanici_id']) : (!empty($input_data['user_id']) ? intval($input_data['user_id']) : null);
        
        if (empty($kullanici_id)) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'kullanici_id (veya user_id) gereklidir.'
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

        // Filter parametresi (1=Bekleyen, 2=Satış, 3=Bilgi Verildi, 4=Müşteri Memnuniyeti, 5=Dönüş Yapılacak, 6=Olumsuz, 7=Numara Hatalı, 8=Tekrar Aranacak, 999=Tümü)
        $filter = isset($input_data['filter']) ? intval($input_data['filter']) : 999;
        
        // Admin kontrolü (is_admin parametresi varsa tüm talepleri göster)
        $is_admin = isset($input_data['is_admin']) ? intval($input_data['is_admin']) : 0;
        
        // Model yükle
        $this->load->model('Talep_yonlendirme_model');
        
        // Talep verilerini getir
        if ($is_admin == 0) {
            // Kullanıcıya yönlendirilen talepler
            $data = $this->Talep_yonlendirme_model->get_all(["yonlenen_kullanici_id" => $kullanici_id]);
        } else {
            // Tüm talepler (admin)
            $data = $this->Talep_yonlendirme_model->get_all([]);
        }

        // Filter uygula (999 ise tümü göster)
        $filtered_data = [];
        if ($filter != 999) {
            foreach ($data as $talep) {
                if ($talep->gorusme_sonuc_no == $filter) {
                    $filtered_data[] = $talep;
                }
            }
        } else {
            $filtered_data = $data;
        }

        // Verileri formatla
        $formatted_data = [];
        foreach ($filtered_data as $talep) {
            // Ürün adlarını decode et
            $urun_adlari = !empty($talep->urun_adlari) ? explode(',', $talep->urun_adlari) : [];
            
            // Telefon numarası formatla
            $telefon = !empty($talep->talep_cep_telefon) ? $talep->talep_cep_telefon : '';
            if (!empty($talep->talep_yurtdisi_telefon)) {
                $telefon = $talep->talep_yurtdisi_telefon;
            }
            
            // Şehir/Ülke bilgisi
            $lokasyon = '';
            if ($talep->talep_ulke_id == 190) {
                $lokasyon = $talep->sehir_adi ?? '';
            } else {
                $lokasyon = strtoupper($talep->ulke_adi ?? '');
            }

            $formatted_data[] = [
                'talep_id' => intval($talep->talep_id),
                'talep_yonlendirme_id' => intval($talep->talep_yonlendirme_id),
                'musteri' => [
                    'musteri_ad_soyad' => $talep->talep_musteri_ad_soyad ?? null,
                    'isletme_adi' => ($talep->talep_isletme_adi && $talep->talep_isletme_adi != '#NULL#') ? $talep->talep_isletme_adi : null,
                    'cep_telefon' => $telefon,
                    'sabit_telefon' => $talep->talep_sabit_telefon ?? null,
                    'yurtdisi_telefon' => $talep->talep_yurtdisi_telefon ?? null
                ],
                'urunler' => $urun_adlari,
                'lokasyon' => [
                    'sehir_adi' => $talep->sehir_adi ?? null,
                    'ulke_adi' => $talep->ulke_adi ?? null,
                    'ulke_id' => !empty($talep->talep_ulke_id) ? intval($talep->talep_ulke_id) : null,
                    'lokasyon_text' => $lokasyon
                ],
                'yonlendirme' => [
                    'yonlendiren_kullanici_id' => intval($talep->yonlendiren_kullanici_id ?? 0),
                    'yonlendiren_ad_soyad' => $talep->yonlendiren_ad_soyad ?? null,
                    'yonlenen_kullanici_id' => intval($talep->yonlenen_kullanici_id ?? 0),
                    'yonlenen_ad_soyad' => $talep->yonlenen_ad_soyad ?? null,
                    'yonlendirme_tarihi' => $talep->yonlendirme_tarihi ?? null,
                    'yonlendirme_tarihi_formatted' => $talep->yonlendirme_tarihi ? date('d.m.Y H:i', strtotime($talep->yonlendirme_tarihi)) : null
                ],
                'gorusme' => [
                    'gorusme_sonuc_no' => !empty($talep->gorusme_sonuc_no) ? intval($talep->gorusme_sonuc_no) : null,
                    'gorusme_sonuc_adi' => $talep->talep_sonuc_adi ?? null,
                    'gorusme_sonuc_renk' => $talep->talep_sonuc_renk ?? null,
                    'gorusme_sonuc_ikon' => $talep->talep_sonuc_ikon ?? null,
                    'gorusme_detay' => $talep->gorusme_detay ?? null,
                    'gorusme_puan' => !empty($talep->gorusme_puan) ? intval($talep->gorusme_puan) : null
                ],
                'talep_kayit_tarihi' => $talep->talep_kayit_tarihi ?? null,
                'talep_kayit_tarihi_formatted' => $talep->talep_kayit_tarihi ? date('d.m.Y H:i', strtotime($talep->talep_kayit_tarihi)) : null,
                'talep_uyari_notu' => $talep->talep_uyari_notu ?? null,
                'talep_fiyat_teklifi' => $talep->talep_fiyat_teklifi ?? null,
                'kullaniciya_aktarildi' => !empty($talep->kullaniciya_aktarildi) ? intval($talep->kullaniciya_aktarildi) : 0
            ];
        }

        // İstatistikler
        $istatistikler = [
            'bekleyen' => count(array_filter($data, function($t) { return $t->gorusme_sonuc_no == 1; })),
            'satis' => count(array_filter($data, function($t) { return $t->gorusme_sonuc_no == 2; })),
            'bilgi_verildi' => count(array_filter($data, function($t) { return $t->gorusme_sonuc_no == 3; })),
            'musteri_memnuniyeti' => count(array_filter($data, function($t) { return $t->gorusme_sonuc_no == 4; })),
            'donus_yapilacak' => count(array_filter($data, function($t) { return $t->gorusme_sonuc_no == 5; })),
            'olumsuz' => count(array_filter($data, function($t) { return $t->gorusme_sonuc_no == 6; })),
            'numara_hatali' => count(array_filter($data, function($t) { return $t->gorusme_sonuc_no == 7; })),
            'tekrar_aranacak' => count(array_filter($data, function($t) { return $t->gorusme_sonuc_no == 8; })),
            'toplam' => count($data)
        ];

        $this->jsonResponse([
            'status' => 'success',
            'message' => 'Talepler başarıyla getirildi.',
            'data' => $formatted_data,
            'istatistikler' => $istatistikler,
            'filter' => $filter,
            'filter_text' => $this->_getFilterText($filter),
            'toplam_kayit' => count($formatted_data),
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }

    /** Filter text helper */
    private function _getFilterText($filter)
    {
        $filters = [
            1 => 'Bekleyen Talepler',
            2 => 'Satış Talepler',
            3 => 'Bilgi Verildi Talepler',
            4 => 'Müşteri Memnuniyeti Talepler',
            5 => 'Dönüş Yapılacak Talepler',
            6 => 'Olumsuz Talepler',
            7 => 'Numara Hatalı Talepler',
            8 => 'Tekrar Aranacak Talepler',
            999 => 'Tüm Taleplerim'
        ];
        return $filters[$filter] ?? 'Tüm Taleplerim';
    }

    /** 29. Talep Ekle */
    public function talep_ekle()
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

        // Zorunlu alanlar
        if (empty($input_data['talep_musteri_ad_soyad']) || empty($input_data['talep_cep_telefon'])) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'talep_musteri_ad_soyad ve talep_cep_telefon alanları gereklidir.'
            ], 400);
        }

        // 3 günlük kontrol - aynı telefon numarası ile son 3 gün içinde talep var mı?
        $telefon = str_replace(' ', '', $input_data['talep_cep_telefon']);
        $this->db->select('talepler.*');
        $this->db->from('talepler');
        $this->db->join('talep_yonlendirmeler', 'talep_yonlendirmeler.talep_no = talepler.talep_id');
        $this->db->where('talep_yonlendirmeler.yonlendirme_tarihi >=', date('Y-m-d', strtotime('-3 days')));
        $this->db->where('talepler.talep_cep_telefon', $telefon);
        $kontrol_query = $this->db->get();
        
        if ($kontrol_query->num_rows() > 0) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => $telefon . ' nolu iletişim bilgisiyle oluşturulmuş ve 3 günlük görüşme sürecinde olan bir kayıt bulunmaktadır. 3 gün içinde tekrar talep kaydı oluşturulamaz.'
            ], 400);
        }

        // Model yükle
        $this->load->model('Talep_model');
        
        // Talep verilerini hazırla
        $talep_data = [
            'talep_musteri_ad_soyad' => strip_tags(trim($input_data['talep_musteri_ad_soyad'])),
            'talep_isletme_adi' => !empty($input_data['talep_isletme_adi']) ? strip_tags(trim($input_data['talep_isletme_adi'])) : '#NULL#',
            'talep_cep_telefon' => $telefon,
            'talep_sabit_telefon' => !empty($input_data['talep_sabit_telefon']) ? str_replace(' ', '', $input_data['talep_sabit_telefon']) : null,
            'talep_fiyat_teklifi' => !empty($input_data['talep_fiyat_teklifi']) ? strip_tags(trim($input_data['talep_fiyat_teklifi'])) : null,
            'talep_urun_id' => !empty($input_data['talep_urun_id']) ? json_encode($input_data['talep_urun_id']) : json_encode([]),
            'talep_sehir_no' => !empty($input_data['talep_sehir_no']) ? intval($input_data['talep_sehir_no']) : 0,
            'talep_ilce_no' => !empty($input_data['talep_ilce_no']) ? intval($input_data['talep_ilce_no']) : 0,
            'talep_ulke_id' => !empty($input_data['talep_ulke_id']) ? intval($input_data['talep_ulke_id']) : 190,
            'talep_kaynak_no' => !empty($input_data['talep_kaynak_no']) ? intval($input_data['talep_kaynak_no']) : 1,
            'talep_uyari_notu' => !empty($input_data['talep_uyari_notu']) ? strip_tags(trim($input_data['talep_uyari_notu'])) : null,
            'talep_kullanilan_cihaz_id' => !empty($input_data['talep_kullanilan_cihaz_id']) ? intval($input_data['talep_kullanilan_cihaz_id']) : 0,
            'talep_kullanilan_cihaz_aciklama' => !empty($input_data['talep_kullanilan_cihaz_aciklama']) ? strip_tags(trim($input_data['talep_kullanilan_cihaz_aciklama'])) : null,
            'talep_sorumlu_kullanici_id' => $kullanici_id,
            'talep_kayit_tarihi' => date('Y-m-d H:i:s'),
            'talep_guncelleme_tarihi' => date('Y-m-d H:i:s'),
            'talep_yonlendirildi_mi' => 0,
            'talep_reklamlardan_gelen_mi' => 0
        ];

        // Özel kullanıcılar için yurtdışı telefon
        if (in_array($kullanici_id, [1, 1331, 1341])) {
            $talep_data['talep_yurtdisi_telefon'] = !empty($input_data['talep_yurtdisi_telefon']) ? strip_tags(trim($input_data['talep_yurtdisi_telefon'])) : null;
        }

        // Talep kaydını yap
        $this->Talep_model->insert($talep_data);
        $talep_id = $this->db->insert_id();

        if (!$talep_id) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Talep kaydı oluşturulurken bir hata oluştu.'
            ], 500);
        }

        $this->jsonResponse([
            'status' => 'success',
            'message' => 'Talep başarıyla oluşturuldu.',
            'talep_id' => $talep_id,
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }

    /** 30. Talep Güncelle (Görüşme Sonucu) */
    public function talep_guncelle()
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
        $talep_yonlendirme_id = !empty($input_data['talep_yonlendirme_id']) ? intval($input_data['talep_yonlendirme_id']) : null;
        
        if (empty($kullanici_id) || empty($talep_yonlendirme_id)) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'kullanici_id (veya user_id) ve talep_yonlendirme_id gereklidir.'
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

        // Talep yönlendirme kontrolü
        $this->load->model('Talep_yonlendirme_model');
        $talep_yonlendirme = $this->Talep_yonlendirme_model->get_by_id($talep_yonlendirme_id);
        
        if (!$talep_yonlendirme || empty($talep_yonlendirme)) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Talep yönlendirme kaydı bulunamadı.'
            ], 404);
        }

        $yonlendirme_data = $talep_yonlendirme[0];
        
        // Yetki kontrolü - sadece yönlendirilen kullanıcı güncelleyebilir
        if ($yonlendirme_data->yonlenen_kullanici_id != $kullanici_id) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Bu talebi güncelleme yetkiniz yoktur. Sadece size yönlendirilen talepleri güncelleyebilirsiniz.'
            ], 403);
        }

        // Görüşme sonucu zorunlu
        if (empty($input_data['gorusme_sonuc_no'])) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'gorusme_sonuc_no gereklidir.'
            ], 400);
        }

        // Satış sonucu için müşteri ad soyad kontrolü
        if (intval($input_data['gorusme_sonuc_no']) == 2) {
            $musteri_ad = strip_tags(trim($input_data['talep_musteri_ad_soyad'] ?? ''));
            if (str_word_count($musteri_ad) === 1) {
                $this->jsonResponse([
                    'status'  => 'error',
                    'message' => 'Ad Soyad Geçersiz. Soyad Bilgisi Zorunludur.'
                ], 400);
            }
            
            // Geçersiz kelime kontrolü
            $kucuk_metin = mb_strtolower($musteri_ad, 'UTF-8');
            $gecersiz_kelimeler = ['hanım', 'hanim', 'bey', 'by', 'hanm', 'hnm', 'hnım', 'hnim', 'isim', 'hanımm', 'hanimm', 'haanim', 'haanım', 'beyi', 'belirtilmedi'];
            foreach ($gecersiz_kelimeler as $kelime) {
                if (strpos($kucuk_metin, $kelime) !== false) {
                    $this->jsonResponse([
                        'status'  => 'error',
                        'message' => 'Müşteri Ad Soyad İçerisinde (Hanım, Bey, Hanim, By, vb.) ifadelerine yer verilemez.'
                    ], 400);
                }
            }
        }

        // Talep güncelleme verileri
        $talep_data = [];
        if (!empty($input_data['talep_musteri_ad_soyad'])) {
            $talep_data['talep_musteri_ad_soyad'] = strip_tags(trim($input_data['talep_musteri_ad_soyad']));
        }
        if (isset($input_data['talep_isletme_adi'])) {
            $talep_data['talep_isletme_adi'] = !empty($input_data['talep_isletme_adi']) ? strip_tags(trim($input_data['talep_isletme_adi'])) : '#NULL#';
        }
        if (!empty($input_data['talep_fiyat_teklifi'])) {
            $talep_data['talep_fiyat_teklifi'] = strip_tags(trim($input_data['talep_fiyat_teklifi']));
        }
        if (!empty($input_data['talep_urun_id'])) {
            $talep_data['talep_urun_id'] = json_encode($input_data['talep_urun_id']);
        }
        if (!empty($input_data['talep_uyari_notu'])) {
            $talep_data['talep_uyari_notu'] = strip_tags(trim($input_data['talep_uyari_notu']));
        }
        $talep_data['talep_guncelleme_tarihi'] = date('Y-m-d H:i:s');

        // Talep kaydını güncelle
        if (!empty($talep_data)) {
            $this->load->model('Talep_model');
            $this->Talep_model->update($yonlendirme_data->talep_no, $talep_data);
        }

        // Yönlendirme güncelleme verileri
        $yonlendirme_update = [
            'gorusme_detay' => !empty($input_data['gorusme_detay']) ? strip_tags(trim($input_data['gorusme_detay'])) : null,
            'gorusme_sonuc_no' => intval($input_data['gorusme_sonuc_no']),
            'gorusme_puan' => !empty($input_data['gorusme_puan']) ? intval($input_data['gorusme_puan']) : null,
            'gorusme_sonuc_guncelleme_tarihi' => date('Y-m-d H:i:s'),
            'rut_gorusmesi_mi' => !empty($input_data['rut_gorusmesi_mi']) ? intval($input_data['rut_gorusmesi_mi']) : 0
        ];

        // Eski durum bilgilerini kaydet
        $yonlendirme_update['eski_gorusme_sonuc_no'] = $yonlendirme_data->gorusme_sonuc_no;
        $yonlendirme_update['eski_gorusme_sonuc_guncelleme_tarihi'] = !empty($yonlendirme_data->gorusme_sonuc_guncelleme_tarihi) 
            ? $yonlendirme_data->gorusme_sonuc_guncelleme_tarihi 
            : date('Y-m-d H:i:s');

        // Yönlendirme kaydını güncelle
        $this->Talep_yonlendirme_model->update($talep_yonlendirme_id, $yonlendirme_update);

        $this->jsonResponse([
            'status' => 'success',
            'message' => 'Talep başarıyla güncellendi.',
            'talep_yonlendirme_id' => $talep_yonlendirme_id,
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }

    /** 31. Talep Detay */
    public function talep_detay()
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

        // Kullanıcı ID'sini al
        $kullanici_id = !empty($input_data['kullanici_id']) ? intval($input_data['kullanici_id']) : (!empty($input_data['user_id']) ? intval($input_data['user_id']) : null);
        $talep_id = !empty($input_data['talep_id']) ? intval($input_data['talep_id']) : null;
        
        if (empty($kullanici_id) || empty($talep_id)) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'kullanici_id (veya user_id) ve talep_id gereklidir.'
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

        // Talep bilgisini getir
        $this->load->model('Talep_model');
        $talep = $this->Talep_model->get_by_id($talep_id);
        
        if (!$talep || empty($talep)) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Talep bulunamadı.'
            ], 404);
        }

        $talep_data = $talep[0];

        // Yönlendirmeleri getir
        $this->load->model('Talep_yonlendirme_model');
        $yonlendirmeler = $this->Talep_yonlendirme_model->get_all_by_talep_no(["talep_no" => $talep_id]);

        // Ürün adlarını decode et
        $urun_adlari = [];
        if (!empty($talep_data->talep_urun_id)) {
            $urun_ids = json_decode($talep_data->talep_urun_id, true);
            if (is_array($urun_ids)) {
                foreach ($urun_ids as $urun_id) {
                    $urun = $this->db->where('urun_id', $urun_id)->get('urunler')->row();
                    if ($urun) {
                        $urun_adlari[] = $urun->urun_adi;
                    }
                }
            }
        }

        // Yönlendirmeleri formatla
        $formatted_yonlendirmeler = [];
        foreach ($yonlendirmeler as $yon) {
            $formatted_yonlendirmeler[] = [
                'talep_yonlendirme_id' => intval($yon->talep_yonlendirme_id),
                'yonlendiren' => [
                    'kullanici_id' => intval($yon->yonlendiren_kullanici_id ?? 0),
                    'ad_soyad' => $yon->yonlendiren_ad_soyad ?? null
                ],
                'yonlenen' => [
                    'kullanici_id' => intval($yon->yonlenen_kullanici_id ?? 0),
                    'ad_soyad' => $yon->yonlenen_ad_soyad ?? null
                ],
                'gorusme_sonuc_no' => !empty($yon->gorusme_sonuc_no) ? intval($yon->gorusme_sonuc_no) : null,
                'gorusme_sonuc_adi' => $yon->talep_sonuc_adi ?? null,
                'gorusme_detay' => $yon->gorusme_detay ?? null,
                'yonlendirme_tarihi' => $yon->yonlendirme_tarihi ?? null,
                'yonlendirme_tarihi_formatted' => $yon->yonlendirme_tarihi ? date('d.m.Y H:i', strtotime($yon->yonlendirme_tarihi)) : null
            ];
        }

        // Talep kaynağı bilgisi
        $talep_kaynak = null;
        if (!empty($talep_data->talep_kaynak_no)) {
            $kaynak = $this->db->where('talep_kaynak_id', $talep_data->talep_kaynak_no)->get('talep_kaynaklari')->row();
            if ($kaynak) {
                $talep_kaynak = [
                    'talep_kaynak_id' => intval($kaynak->talep_kaynak_id),
                    'talep_kaynak_adi' => $kaynak->talep_kaynak_adi ?? null,
                    'talep_kaynak_renk' => $kaynak->talep_kaynak_renk ?? null
                ];
            }
        }

        $this->jsonResponse([
            'status' => 'success',
            'message' => 'Talep detayları başarıyla getirildi.',
            'data' => [
                'talep_id' => intval($talep_data->talep_id),
                'musteri' => [
                    'musteri_ad_soyad' => $talep_data->talep_musteri_ad_soyad ?? null,
                    'isletme_adi' => ($talep_data->talep_isletme_adi && $talep_data->talep_isletme_adi != '#NULL#') ? $talep_data->talep_isletme_adi : null,
                    'cep_telefon' => $talep_data->talep_cep_telefon ?? null,
                    'sabit_telefon' => $talep_data->talep_sabit_telefon ?? null,
                    'yurtdisi_telefon' => $talep_data->talep_yurtdisi_telefon ?? null
                ],
                'urunler' => $urun_adlari,
                'talep_kaynak' => $talep_kaynak,
                'talep_fiyat_teklifi' => $talep_data->talep_fiyat_teklifi ?? null,
                'talep_uyari_notu' => $talep_data->talep_uyari_notu ?? null,
                'talep_kayit_tarihi' => $talep_data->talep_kayit_tarihi ?? null,
                'talep_kayit_tarihi_formatted' => $talep_data->talep_kayit_tarihi ? date('d.m.Y H:i', strtotime($talep_data->talep_kayit_tarihi)) : null,
                'yonlendirmeler' => $formatted_yonlendirmeler
            ],
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }

    /** 32. Talep Yönlendir */
    public function talep_yonlendir()
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
        $talep_id = !empty($input_data['talep_id']) ? intval($input_data['talep_id']) : null;
        $yonlenen_kullanici_id = !empty($input_data['yonlenen_kullanici_id']) ? intval($input_data['yonlenen_kullanici_id']) : null;
        
        if (empty($kullanici_id) || empty($talep_id) || empty($yonlenen_kullanici_id)) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'kullanici_id (veya user_id), talep_id ve yonlenen_kullanici_id gereklidir.'
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

        // Talep kontrolü
        $this->load->model('Talep_model');
        $talep = $this->Talep_model->get_by_id($talep_id);
        
        if (!$talep || empty($talep)) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Talep bulunamadı.'
            ], 404);
        }

        // 3 günlük kontrol
        $telefon = str_replace(' ', '', $talep[0]->talep_cep_telefon);
        $this->db->select('talepler.*');
        $this->db->from('talepler');
        $this->db->join('talep_yonlendirmeler', 'talep_yonlendirmeler.talep_no = talepler.talep_id');
        $this->db->where('talep_yonlendirmeler.yonlendirme_tarihi >=', date('Y-m-d', strtotime('-3 days')));
        $this->db->where('talepler.talep_cep_telefon', $telefon);
        $kontrol_query = $this->db->get();
        
        if ($kontrol_query->num_rows() > 0) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => $telefon . ' nolu iletişim bilgisiyle oluşturulmuş ve 3 günlük görüşme sürecinde olan bir kayıt bulunmaktadır.'
            ], 400);
        }

        // Yönlendirme kaydı oluştur
        $this->load->model('Talep_yonlendirme_model');
        $yonlendirme_data = [
            'talep_no' => $talep_id,
            'yonlenen_kullanici_id' => $yonlenen_kullanici_id,
            'yonlendiren_kullanici_id' => $kullanici_id,
            'yonlendirme_tarihi' => date('Y-m-d H:i:s'),
            'gorusme_sonuc_no' => 1, // Bekleyen
            'rut_gorusmesi_mi' => 0
        ];
        
        $this->Talep_yonlendirme_model->insert($yonlendirme_data);
        $yonlendirme_id = $this->db->insert_id();

        // Talep yönlendirildi olarak işaretle
        $this->Talep_model->update($talep_id, ['talep_yonlendirildi_mi' => 1]);

        // Yönlenen kullanıcıya SMS gönder
        $yonlenen_kullanici = $this->db->where('kullanici_id', $yonlenen_kullanici_id)->get('kullanicilar')->row();
        if ($yonlenen_kullanici && !empty($yonlenen_kullanici->kullanici_bireysel_iletisim_no)) {
            $this->load->helper('site');
            if (function_exists('sendSmsData')) {
                sendSmsData(
                    $yonlenen_kullanici->kullanici_bireysel_iletisim_no,
                    "Sn. " . $yonlenen_kullanici->kullanici_ad_soyad . " " . date("d.m.Y H:i") . " tarihinde tarafınıza yönlendirilmiş yeni müşteri talebiniz bulunmaktadır. Talebi görüntülemek için : https://ugbusiness.com.tr/bekleyen-talepler"
                );
            }
        }

        $this->jsonResponse([
            'status' => 'success',
            'message' => 'Talep başarıyla yönlendirildi.',
            'talep_yonlendirme_id' => $yonlendirme_id,
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }

    /** 33. Rut Listesi */
    public function rut_listesi()
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

        // Kullanıcı ID'sini al
        $kullanici_id = !empty($input_data['kullanici_id']) ? intval($input_data['kullanici_id']) : (!empty($input_data['user_id']) ? intval($input_data['user_id']) : null);
        
        if (empty($kullanici_id)) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'kullanici_id (veya user_id) gereklidir.'
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

        // Controller Referansı: Rut.php::rut_tanimlari() (satır 21-34)
        // Model: rut_tanimlari tablosu
        $query = $this->db
            ->where(["rut_kullanici_id" => $kullanici_id])
            ->select("rut_tanimlari.*, kullanicilar.*, sehirler.sehir_adi, araclar.*")
            ->from('rut_tanimlari')
            ->order_by("rut_tanimlari.rut_tanim_id", "asc")
            ->join('kullanicilar', 'kullanicilar.kullanici_id = rut_tanimlari.rut_kullanici_id')
            ->join('sehirler', 'sehirler.sehir_id = rut_tanimlari.rut_sehir_id')
            ->join('araclar', 'araclar.arac_id = rut_tanimlari.rut_arac_id', 'left')
            ->get();

        $rut_tanimlari = $query->result();

        // Verileri formatla
        $formatted_data = [];
        foreach ($rut_tanimlari as $rut) {
            // İlçe bilgilerini decode et
            $ilceler = [];
            if (!empty($rut->rut_ilce_bilgisi)) {
                $ilce_ids = json_decode($rut->rut_ilce_bilgisi, true);
                if (is_array($ilce_ids)) {
                    foreach ($ilce_ids as $ilce_id) {
                        $ilce = $this->db->where('ilce_id', $ilce_id)->get('ilceler')->row();
                        if ($ilce) {
                            $ilceler[] = [
                                'ilce_id' => intval($ilce->ilce_id),
                                'ilce_adi' => $ilce->ilce_adi ?? null
                            ];
                        }
                    }
                }
            }

            $formatted_data[] = [
                'rut_tanim_id' => intval($rut->rut_tanim_id),
                'kullanici' => [
                    'kullanici_id' => intval($rut->rut_kullanici_id),
                    'kullanici_ad_soyad' => $rut->kullanici_ad_soyad ?? null
                ],
                'sehir' => [
                    'sehir_id' => !empty($rut->rut_sehir_id) ? intval($rut->rut_sehir_id) : null,
                    'sehir_adi' => $rut->sehir_adi ?? null
                ],
                'ilceler' => $ilceler,
                'arac' => [
                    'arac_id' => !empty($rut->rut_arac_id) ? intval($rut->rut_arac_id) : null,
                    'arac_plaka' => $rut->arac_plaka ?? null,
                    'arac_marka' => $rut->arac_marka ?? null,
                    'arac_model' => $rut->arac_model ?? null
                ],
                'rut_baslangic_tarihi' => $rut->rut_baslangic_tarihi ?? null,
                'rut_baslangic_tarihi_formatted' => $rut->rut_baslangic_tarihi ? date('d.m.Y', strtotime($rut->rut_baslangic_tarihi)) : null,
                'rut_bitis_tarihi' => $rut->rut_bitis_tarihi ?? null,
                'rut_bitis_tarihi_formatted' => $rut->rut_bitis_tarihi ? date('d.m.Y', strtotime($rut->rut_bitis_tarihi)) : null,
                'rut_satisci_durum' => !empty($rut->rut_satisci_durum) ? intval($rut->rut_satisci_durum) : 0,
                'rut_satisci_baslatma_tarihi' => $rut->rut_satisci_baslatma_tarihi ?? null,
                'rut_satisci_baslatma_km' => !empty($rut->rut_satisci_baslatma_km) ? intval($rut->rut_satisci_baslatma_km) : null,
                'rut_satisci_bitis_tarihi' => $rut->rut_satisci_bitis_tarihi ?? null,
                'rut_satisci_bitis_km' => !empty($rut->rut_satisci_bitis_km) ? intval($rut->rut_satisci_bitis_km) : null
            ];
        }

        $this->jsonResponse([
            'status' => 'success',
            'message' => 'Rut listesi başarıyla getirildi.',
            'data' => $formatted_data,
            'toplam_kayit' => count($formatted_data),
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }

    /** 34. Kara Liste */
    public function kara_liste()
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

        // Kullanıcı ID'sini al
        $kullanici_id = !empty($input_data['kullanici_id']) ? intval($input_data['kullanici_id']) : (!empty($input_data['user_id']) ? intval($input_data['user_id']) : null);
        
        if (empty($kullanici_id)) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'kullanici_id (veya user_id) gereklidir.'
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

        // Controller Referansı: Musteri.php::karaliste_view() (satır 529-544)
        // Model: kara_liste tablosu
        // View Referansı: application/views/musteri/karaliste/main_content.php

        // POST ise kara listeye ekle
        if ($method === 'POST' && !empty($input_data['kara_liste_iletisim_numarasi'])) {
            $telefon = str_replace(' ', '', $input_data['kara_liste_iletisim_numarasi']);
            
            // Zaten var mı kontrol et
            $kontrol = $this->db->where('kara_liste_kullanici_id', $kullanici_id)
                               ->where('kara_liste_iletisim_numarasi', $telefon)
                               ->get('kara_liste')
                               ->row();
            
            if ($kontrol) {
                $this->jsonResponse([
                    'status'  => 'error',
                    'message' => 'Bu numara zaten kara listenizde bulunmaktadır.'
                ], 400);
            }

            $kara_liste_data = [
                'kara_liste_iletisim_numarasi' => $telefon,
                'kara_liste_kullanici_id' => $kullanici_id
            ];
            
            $this->db->insert('kara_liste', $kara_liste_data);
            $kara_liste_id = $this->db->insert_id();

            $this->jsonResponse([
                'status' => 'success',
                'message' => 'Numara kara listeye eklendi.',
                'kara_liste_id' => $kara_liste_id,
                'timestamp' => date('Y-m-d H:i:s')
            ]);
        }

        // GET ise kara listeyi getir
        $kara_liste = $this->db
            ->where("kara_liste_kullanici_id", $kullanici_id)
            ->join("kullanicilar", "kullanici_id = kara_liste_kullanici_id")
            ->select("kullanicilar.kullanici_ad_soyad, kara_liste.*")
            ->from("kara_liste")
            ->order_by('kara_liste_id', 'DESC')
            ->get()
            ->result();

        $formatted_data = [];
        foreach ($kara_liste as $kayit) {
            $formatted_data[] = [
                'kara_liste_id' => intval($kayit->kara_liste_id),
                'iletisim_numarasi' => $kayit->kara_liste_iletisim_numarasi ?? null,
                'kullanici' => [
                    'kullanici_id' => intval($kayit->kara_liste_kullanici_id),
                    'kullanici_ad_soyad' => $kayit->kullanici_ad_soyad ?? null
                ],
                'kayit_tarihi' => $kayit->kara_liste_kayit_tarihi ?? null,
                'kayit_tarihi_formatted' => $kayit->kara_liste_kayit_tarihi ? date('d.m.Y H:i', strtotime($kayit->kara_liste_kayit_tarihi)) : null
            ];
        }

        $this->jsonResponse([
            'status' => 'success',
            'message' => 'Kara liste başarıyla getirildi.',
            'data' => $formatted_data,
            'toplam_kayit' => count($formatted_data),
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }

    /** 35. Kara Liste Sil */
    public function kara_liste_sil()
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
        $kara_liste_id = !empty($input_data['kara_liste_id']) ? intval($input_data['kara_liste_id']) : null;
        
        if (empty($kullanici_id) || empty($kara_liste_id)) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'kullanici_id (veya user_id) ve kara_liste_id gereklidir.'
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

        // Kara liste kaydı kontrolü - sadece kendi kaydını silebilir
        $kara_liste = $this->db->where('kara_liste_id', $kara_liste_id)
                              ->where('kara_liste_kullanici_id', $kullanici_id)
                              ->get('kara_liste')
                              ->row();

        if (!$kara_liste) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Kara liste kaydı bulunamadı veya bu kayıt size ait değil.'
            ], 404);
        }

        // Sil
        $this->db->where('kara_liste_id', $kara_liste_id)
                 ->where('kara_liste_kullanici_id', $kullanici_id)
                 ->delete('kara_liste');

        $this->jsonResponse([
            'status' => 'success',
            'message' => 'Kara liste kaydı başarıyla silindi.',
            'kara_liste_id' => $kara_liste_id,
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }

    /** 36. Talep Kaynakları */
    public function talep_kaynaklari()
    {
        // GET
        $kaynaklar = $this->db->order_by('talep_kaynak_id', 'ASC')->get('talep_kaynaklari')->result();
        
        $formatted_data = [];
        foreach ($kaynaklar as $kaynak) {
            $formatted_data[] = [
                'talep_kaynak_id' => intval($kaynak->talep_kaynak_id),
                'talep_kaynak_adi' => $kaynak->talep_kaynak_adi ?? null,
                'talep_kaynak_renk' => $kaynak->talep_kaynak_renk ?? null
            ];
        }

        $this->jsonResponse([
            'status' => 'success',
            'message' => 'Talep kaynakları başarıyla getirildi.',
            'data' => $formatted_data,
            'toplam_kayit' => count($formatted_data),
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }

    /** 37. Talep Sonuçları */
    public function talep_sonuclari()
    {
        // GET
        $sonuclar = $this->db->order_by('talep_sonuc_id', 'ASC')->get('talep_sonuclar')->result();
        
        $formatted_data = [];
        foreach ($sonuclar as $sonuc) {
            $formatted_data[] = [
                'talep_sonuc_id' => intval($sonuc->talep_sonuc_id),
                'talep_sonuc_adi' => $sonuc->talep_sonuc_adi ?? null,
                'talep_sonuc_renk' => $sonuc->talep_sonuc_renk ?? null,
                'talep_sonuc_ikon' => $sonuc->talep_sonuc_ikon ?? null
            ];
        }

        $this->jsonResponse([
            'status' => 'success',
            'message' => 'Talep sonuçları başarıyla getirildi.',
            'data' => $formatted_data,
            'toplam_kayit' => count($formatted_data),
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }

    /** 38. Fiyat Limitleri Listesi (Ürün Bazlı) */
    public function fiyat_limitleri_listesi()
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

        // Ürün ID'sini al
        $urun_id = !empty($input_data['urun_id']) ? intval($input_data['urun_id']) : null;
        
        if (empty($urun_id)) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'urun_id gereklidir.'
            ], 400);
        }

        // Ürün kontrolü
        $urun = $this->db->where('urun_id', $urun_id)->get('urunler')->row();
        
        if (!$urun) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Geçersiz ürün ID.'
            ], 404);
        }

        // Controller Referansı: Urun.php::satici_limit() (satır 113-163)
        // View Referansı: application/views/urun/satici_limitler/main_content.php

        // Fiyat listesi hesapla
        $fiyat_listesi = [];
        if ($urun->urun_pesinat_artis_ust_fiyati != 0 && $urun->urun_pesinat_fiyati != 0) {
            for ($p = $urun->urun_pesinat_fiyati; $p <= $urun->urun_pesinat_artis_ust_fiyati; $p += $urun->pesinat_artis_aralik) {
                for ($v = 20; $v >= 1; $v--) {
                    if ($v % 2 == 1 && $v != 1) continue;
                    
                    $senet_result = (($urun->urun_satis_fiyati - $p) * (($urun->urun_vade_farki / 12) * $v) + ($urun->urun_satis_fiyati - $p));
                    
                    $fiyat_listesi[] = [
                        'pesinat_fiyati' => floatval($p),
                        'vade' => intval($v),
                        'senet' => floatval($senet_result),
                        'aylik_taksit_tutar' => floatval($senet_result / $v),
                        'toplam_dip_fiyat' => floatval($senet_result + $p),
                        'toplam_dip_fiyat_yuvarlanmis' => floatval(floor(($senet_result + $p) / 5000) * 5000),
                        'toplam_dip_fiyat_yuvarlanmis_satisci' => floatval((floor(($senet_result + $p) / 5000) * 5000) - ($urun->satis_pazarlik_payi))
                    ];
                }
            }
        }

        $this->jsonResponse([
            'status' => 'success',
            'message' => 'Fiyat limitleri başarıyla getirildi.',
            'urun' => [
                'urun_id' => intval($urun->urun_id),
                'urun_adi' => $urun->urun_adi ?? null
            ],
            'fiyat_listesi' => $fiyat_listesi,
            'toplam_kayit' => count($fiyat_listesi),
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }

    /** 39. Abonelik Listesi */
    public function abonelikler()
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

        // Controller Referansı: Abonelik.php::index() (satır 13-17)
        // Model Referansı: Abonelik_model::get_all_abonelikler()

        $this->load->model('Abonelik_model');
        $abonelikler = $this->Abonelik_model->get_all_abonelikler();

        // Verileri formatla
        $formatted_data = [];
        foreach ($abonelikler as $abonelik) {
            $formatted_data[] = [
                'abonelik_id' => intval($abonelik->abonelik_id),
                'abonelik_baslik' => $abonelik->abonelik_baslik ?? null,
                'abonelik_aciklama' => $abonelik->abonelik_aciklama ?? null,
                'abonelik_baslangic_tarihi' => $abonelik->abonelik_baslangic_tarihi ?? null,
                'abonelik_bitis_tarihi' => $abonelik->abonelik_bitis_tarihi ?? null,
                'abonelik_aktif' => isset($abonelik->abonelik_aktif) ? intval($abonelik->abonelik_aktif) : 1
            ];
        }

        $this->jsonResponse([
            'status' => 'success',
            'message' => 'Abonelikler başarıyla getirildi.',
            'data' => $formatted_data,
            'toplam_kayit' => count($formatted_data),
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }

    /** 40. Abonelik Ekle */
    public function abonelik_ekle()
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

        // Controller Referansı: Abonelik.php::ekle_islem() (satır 24-33)
        // Model Referansı: Abonelik_model::insert_abonelik()

        // Zorunlu alanlar
        $baslik = !empty($input_data['baslik']) ? trim($input_data['baslik']) : null;
        $baslangic_tarihi = !empty($input_data['baslangic_tarihi']) ? trim($input_data['baslangic_tarihi']) : null;
        $bitis_tarihi = !empty($input_data['bitis_tarihi']) ? trim($input_data['bitis_tarihi']) : null;

        if (empty($baslik)) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'baslik alanı zorunludur.'
            ], 400);
        }

        if (empty($baslangic_tarihi)) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'baslangic_tarihi alanı zorunludur.'
            ], 400);
        }

        if (empty($bitis_tarihi)) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'bitis_tarihi alanı zorunludur.'
            ], 400);
        }

        // Tarih formatı kontrolü
        if (!strtotime($baslangic_tarihi)) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Geçersiz baslangic_tarihi formatı. Tarih formatı: Y-m-d (örn: 2024-01-15)'
            ], 400);
        }

        if (!strtotime($bitis_tarihi)) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Geçersiz bitis_tarihi formatı. Tarih formatı: Y-m-d (örn: 2024-01-15)'
            ], 400);
        }

        // Tarih karşılaştırması
        if (strtotime($baslangic_tarihi) > strtotime($bitis_tarihi)) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'baslangic_tarihi, bitis_tarihi\'nden sonra olamaz.'
            ], 400);
        }

        // Veriyi hazırla
        $data = [
            'abonelik_baslik' => $baslik,
            'abonelik_aciklama' => !empty($input_data['aciklama']) ? trim($input_data['aciklama']) : null,
            'abonelik_baslangic_tarihi' => date('Y-m-d', strtotime($baslangic_tarihi)),
            'abonelik_bitis_tarihi' => date('Y-m-d', strtotime($bitis_tarihi))
        ];

        $this->load->model('Abonelik_model');
        $insert_result = $this->Abonelik_model->insert_abonelik($data);

        if ($insert_result) {
            $abonelik_id = $this->db->insert_id();
            
            $this->jsonResponse([
                'status' => 'success',
                'message' => 'Abonelik başarıyla oluşturuldu.',
                'data' => [
                    'abonelik_id' => intval($abonelik_id),
                    'abonelik_baslik' => $data['abonelik_baslik'],
                    'abonelik_aciklama' => $data['abonelik_aciklama'],
                    'abonelik_baslangic_tarihi' => $data['abonelik_baslangic_tarihi'],
                    'abonelik_bitis_tarihi' => $data['abonelik_bitis_tarihi']
                ],
                'timestamp' => date('Y-m-d H:i:s')
            ]);
        } else {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Abonelik oluşturulurken bir hata oluştu.'
            ], 500);
        }
    }

    /** 41. Abonelik Güncelle */
    public function abonelik_guncelle()
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

        // Controller Referansı: Abonelik.php::duzenle_islem() (satır 41-50)
        // Model Referansı: Abonelik_model::update_abonelik()

        // Abonelik ID'sini al
        $abonelik_id = !empty($input_data['abonelik_id']) ? intval($input_data['abonelik_id']) : null;
        
        if (empty($abonelik_id)) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'abonelik_id gereklidir.'
            ], 400);
        }

        $this->load->model('Abonelik_model');
        
        // Abonelik kontrolü
        $abonelik = $this->Abonelik_model->get_abonelik_by_id($abonelik_id);
        
        if (!$abonelik) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Geçersiz abonelik ID.'
            ], 404);
        }

        // Güncellenecek verileri hazırla
        $data = [];

        if (isset($input_data['baslik'])) {
            $baslik = trim($input_data['baslik']);
            if (empty($baslik)) {
                $this->jsonResponse([
                    'status'  => 'error',
                    'message' => 'baslik boş olamaz.'
                ], 400);
            }
            $data['abonelik_baslik'] = $baslik;
        }

        if (isset($input_data['aciklama'])) {
            $data['abonelik_aciklama'] = trim($input_data['aciklama']);
        }

        if (isset($input_data['baslangic_tarihi'])) {
            $baslangic_tarihi = trim($input_data['baslangic_tarihi']);
            if (!strtotime($baslangic_tarihi)) {
                $this->jsonResponse([
                    'status'  => 'error',
                    'message' => 'Geçersiz baslangic_tarihi formatı. Tarih formatı: Y-m-d (örn: 2024-01-15)'
                ], 400);
            }
            $data['abonelik_baslangic_tarihi'] = date('Y-m-d', strtotime($baslangic_tarihi));
        }

        if (isset($input_data['bitis_tarihi'])) {
            $bitis_tarihi = trim($input_data['bitis_tarihi']);
            if (!strtotime($bitis_tarihi)) {
                $this->jsonResponse([
                    'status'  => 'error',
                    'message' => 'Geçersiz bitis_tarihi formatı. Tarih formatı: Y-m-d (örn: 2024-01-15)'
                ], 400);
            }
            $data['abonelik_bitis_tarihi'] = date('Y-m-d', strtotime($bitis_tarihi));
        }

        // Tarih karşılaştırması (her iki tarih de varsa)
        if (isset($data['abonelik_baslangic_tarihi']) && isset($data['abonelik_bitis_tarihi'])) {
            if (strtotime($data['abonelik_baslangic_tarihi']) > strtotime($data['abonelik_bitis_tarihi'])) {
                $this->jsonResponse([
                    'status'  => 'error',
                    'message' => 'baslangic_tarihi, bitis_tarihi\'nden sonra olamaz.'
                ], 400);
            }
        } elseif (isset($data['abonelik_baslangic_tarihi']) && isset($abonelik->abonelik_bitis_tarihi)) {
            if (strtotime($data['abonelik_baslangic_tarihi']) > strtotime($abonelik->abonelik_bitis_tarihi)) {
                $this->jsonResponse([
                    'status'  => 'error',
                    'message' => 'baslangic_tarihi, mevcut bitis_tarihi\'nden sonra olamaz.'
                ], 400);
            }
        } elseif (isset($abonelik->abonelik_baslangic_tarihi) && isset($data['abonelik_bitis_tarihi'])) {
            if (strtotime($abonelik->abonelik_baslangic_tarihi) > strtotime($data['abonelik_bitis_tarihi'])) {
                $this->jsonResponse([
                    'status'  => 'error',
                    'message' => 'bitis_tarihi, mevcut baslangic_tarihi\'nden önce olamaz.'
                ], 400);
            }
        }

        // Güncelleme yapılacak veri yoksa
        if (empty($data)) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Güncellenecek alan belirtilmedi.'
            ], 400);
        }

        // Güncelleme işlemi
        $update_result = $this->Abonelik_model->update_abonelik($abonelik_id, $data);

        if ($update_result) {
            // Güncellenmiş veriyi getir
            $updated_abonelik = $this->Abonelik_model->get_abonelik_by_id($abonelik_id);
            
            $this->jsonResponse([
                'status' => 'success',
                'message' => 'Abonelik başarıyla güncellendi.',
                'data' => [
                    'abonelik_id' => intval($updated_abonelik->abonelik_id),
                    'abonelik_baslik' => $updated_abonelik->abonelik_baslik ?? null,
                    'abonelik_aciklama' => $updated_abonelik->abonelik_aciklama ?? null,
                    'abonelik_baslangic_tarihi' => $updated_abonelik->abonelik_baslangic_tarihi ?? null,
                    'abonelik_bitis_tarihi' => $updated_abonelik->abonelik_bitis_tarihi ?? null
                ],
                'timestamp' => date('Y-m-d H:i:s')
            ]);
        } else {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Abonelik güncellenirken bir hata oluştu.'
            ], 500);
        }
    }

    /** 42. Abonelik Sil */
    public function abonelik_sil()
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

        // Model Referansı: Abonelik_model::delete_abonelik()

        // Abonelik ID'sini al
        $abonelik_id = !empty($input_data['abonelik_id']) ? intval($input_data['abonelik_id']) : null;
        
        if (empty($abonelik_id)) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'abonelik_id gereklidir.'
            ], 400);
        }

        $this->load->model('Abonelik_model');
        
        // Abonelik kontrolü
        $abonelik = $this->Abonelik_model->get_abonelik_by_id($abonelik_id);
        
        if (!$abonelik) {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Geçersiz abonelik ID.'
            ], 404);
        }

        // Silme işlemi
        $delete_result = $this->Abonelik_model->delete_abonelik($abonelik_id);

        if ($delete_result) {
            $this->jsonResponse([
                'status' => 'success',
                'message' => 'Abonelik başarıyla silindi.',
                'abonelik_id' => $abonelik_id,
                'timestamp' => date('Y-m-d H:i:s')
            ]);
        } else {
            $this->jsonResponse([
                'status'  => 'error',
                'message' => 'Abonelik silinirken bir hata oluştu.'
            ], 500);
        }
    }

}