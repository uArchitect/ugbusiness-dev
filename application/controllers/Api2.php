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
}
