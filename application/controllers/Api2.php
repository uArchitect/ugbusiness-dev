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
            $siparis_urun_data = [
                'siparis_kodu' => $siparis_id,
                'urun_no' => intval($urun['urun_no']),
                'satis_fiyati' => str_replace([',', '₺', ' '], '', $urun['satis_fiyati'] ?? '0'),
                'pesinat_fiyati' => str_replace([',', '₺', ' '], '', $urun['pesinat_fiyati'] ?? '0'),
                'kapora_fiyati' => str_replace([',', '₺', ' '], '', $urun['kapora_fiyati'] ?? '0'),
                'fatura_tutari' => str_replace([',', '₺', ' '], '', $urun['fatura_tutari'] ?? '0'),
                'takas_bedeli' => str_replace([',', '₺', ' '], '', $urun['takas_bedeli'] ?? '0'),
                'takas_alinan_seri_kod' => $urun['takas_alinan_seri_kod'] ?? null,
                'takas_alinan_model' => $urun['takas_alinan_model'] ?? null,
                'takas_alinan_renk' => $urun['takas_alinan_renk'] ?? null,
                'renk' => $urun['renk'] ?? null,
                'odeme_secenek' => intval($urun['odeme_secenek'] ?? 1),
                'vade_sayisi' => intval($urun['vade_sayisi'] ?? 0),
                'damla_etiket' => $urun['damla_etiket'] ?? null,
                'acilis_ekrani' => $urun['acilis_ekrani'] ?? null,
                'yenilenmis_cihaz_mi' => isset($urun['yenilenmis_cihaz_mi']) ? intval($urun['yenilenmis_cihaz_mi']) : 0,
                'para_birimi' => $urun['para_birimi'] ?? 'TRY',
                'hediye_no' => !empty($urun['hediye_no']) ? intval($urun['hediye_no']) : null,
                'basliklar' => !empty($urun['basliklar']) ? base64_encode($urun['basliklar']) : null,
                'siparis_urun_notu' => $urun['siparis_notu'] ?? null
            ];
            
            $this->Siparis_urun_model->insert($siparis_urun_data);
            $siparis_urun_id = $this->db->insert_id();
            $urunler_kaydedildi[] = $siparis_urun_id;

            // Takas cihaz kontrolü
            if (!empty($urun['takas_alinan_model']) && $urun['takas_alinan_model'] == "UMEX") {
                $this->db->where('seri_numarasi', $urun['takas_alinan_seri_kod'])
                         ->update('siparis_urunleri', [
                             "takas_cihaz_mi" => 1,
                             "takas_alinan_merkez_id" => $merkez_id,
                             "takas_siparis_islem_detay" => "$siparis_kodu nolu sipariş kayıt sırasında takas olarak işaretlendi."
                         ]);
            }

            // Takas fotoğrafları (eğer varsa)
            if (!empty($urun['takas_fotograflari']) && is_array($urun['takas_fotograflari'])) {
                foreach ($urun['takas_fotograflari'] as $foto_url) {
                    if (!empty($foto_url)) {
                        $foto_data = [
                            'urun_id' => $siparis_urun_id,
                            'siparis_id' => $siparis_id,
                            'foto_url' => $foto_url
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

}
