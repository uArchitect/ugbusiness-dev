<?php
/**
 * Umex Müşteri Mobil uygulaması
 * 
 * Bu controller müşteri mobil uygulaması için API endpoint'lerini sağlar.
 * Telefon numarası ile kimlik doğrulama, SMS OTP doğrulama,
 * cihaz yönetimi, eğitim videoları, şube bilgileri ve profil yönetimi gibi
 * özellikleri içerir.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Api3 extends CI_Controller
{
    private $musteri_id = null;
    private $musteri_data = null;

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

        $this->load->model('Musteri_model');
        $this->load->model('Merkez_model');
        $this->load->model('Cihaz_model');
        $this->load->model('Egitim_model');
        $this->load->model('Baslik_model');
    }


    public function test()
    {
        $this->jsonResponse([
            'status' => 'success',
            'message' => 'API3 test endpoint çalışıyor!'
        ]);
    }

    /** CORS ve header ayarları */
    private function _setHeaders()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    }

    /** Genel response çıktısı için yardımcı fonksiyon */
    private function jsonResponse($data, $status = 200)
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }

    /** Telefon numarasını temizle ve formatla */
    private function cleanPhoneNumber($phone)
    {
        // Boşluk, tire, parantez gibi karakterleri temizle
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        // Başında 0 varsa kaldır
        if (substr($phone, 0, 1) == '0') {
            $phone = substr($phone, 1);
        }
        
        // 90 ile başlıyorsa kaldır
        if (substr($phone, 0, 2) == '90') {
            $phone = substr($phone, 2);
        }
        
        return $phone;
    }

    /** Token ile müşteri doğrulama */
    private function authenticate()
    {
        $headers = getallheaders();
        $token = isset($headers['Authorization']) ? str_replace('Bearer ', '', $headers['Authorization']) : null;
        
        if (empty($token)) {
            $this->jsonResponse([
                'status' => 'error',
                'message' => 'Token bulunamadı'
            ], 401);
        }

        // Token'ı decode et (basit bir token sistemi - production'da JWT kullanılmalı)
        $token_data = json_decode(base64_decode($token), true);
        
        if (!$token_data || !isset($token_data['musteri_id']) || !isset($token_data['expires_at'])) {
            $this->jsonResponse([
                'status' => 'error',
                'message' => 'Geçersiz token'
            ], 401);
        }

        // Token süresi dolmuş mu kontrol et
        if (strtotime($token_data['expires_at']) < time()) {
            $this->jsonResponse([
                'status' => 'error',
                'message' => 'Token süresi dolmuş'
            ], 401);
        }

        // Müşteri bilgilerini çek
        $musteri = $this->Musteri_model->get_by_id($token_data['musteri_id']);
        
        if (!$musteri) {
            $this->jsonResponse([
                'status' => 'error',
                'message' => 'Müşteri bulunamadı'
            ], 401);
        }

        $this->musteri_id = $token_data['musteri_id'];
        $this->musteri_data = $musteri[0];
        
        return true;
    }

    /** Token oluştur */
    private function generateToken($musteri_id)
    {
        $token_data = [
            'musteri_id' => $musteri_id,
            'created_at' => date('Y-m-d H:i:s'),
            'expires_at' => date('Y-m-d H:i:s', strtotime('+30 days')) // 30 gün geçerli
        ];
        
        return base64_encode(json_encode($token_data));
    }

    /**
     * 1. Telefon numarası ile OTP gönderme
     * POST /api3/send_otp
     * Body: { "telefon": "5551234567" }
     */
    public function send_otp()
    {
        if ($this->input->method(true) !== 'POST') {
            $this->jsonResponse([
                'status' => 'error',
                'message' => 'Sadece POST metodu kabul edilir.'
            ], 405);
        }

        $input_data = json_decode(file_get_contents('php://input'), true) ?? [];
        $telefon = isset($input_data['telefon']) ? $this->cleanPhoneNumber($input_data['telefon']) : null;

        if (empty($telefon)) {
            $this->jsonResponse([
                'status' => 'error',
                'message' => 'Telefon numarası gereklidir'
            ], 400);
        }

        // Müşteriyi telefon numarası ile bul
        $musteriler = $this->Musteri_model->get_all();
        $musteri = null;
        
        foreach ($musteriler as $m) {
            $musteri_telefon = $this->cleanPhoneNumber($m->musteri_iletisim_numarasi);
            if ($musteri_telefon == $telefon) {
                $musteri = $m;
                break;
            }
        }

        if (!$musteri) {
            $this->jsonResponse([
                'status' => 'error',
                'message' => 'Bu telefon numarası ile kayıtlı müşteri bulunamadı'
            ], 404);
        }

        // OTP kodu oluştur (6 haneli)
        $otp_code = rand(100000, 999999);
        
        // OTP'yi veritabanına kaydet
        // Önce eski OTP'yi sil (varsa)
        $this->db->where('musteri_id', $musteri->musteri_id)
                 ->delete('musteri_otp');
        
        // Yeni OTP'yi kaydet
        $otp_data = [
            'musteri_id' => $musteri->musteri_id,
            'otp_code' => $otp_code,
            'otp_created_at' => date('Y-m-d H:i:s'),
            'otp_expires_at' => date('Y-m-d H:i:s', strtotime('+5 minutes')),
            'otp_used' => 0
        ];
        
        // Tablo var mı kontrol et
        if (!$this->db->table_exists('musteri_otp')) {
            // Tablo yoksa hata döndür
            $this->jsonResponse([
                'status' => 'error',
                'message' => 'OTP tablosu bulunamadı. Lütfen musteri_otp_table.sql dosyasını veritabanınızda çalıştırın.'
            ], 500);
        }
        
        $insert_result = $this->db->insert('musteri_otp', $otp_data);
        
        // Insert işleminin başarılı olup olmadığını kontrol et
        if (!$insert_result) {
            $db_error = $this->db->error();
            // Hata varsa logla ve hata döndür
            log_message('error', 'OTP kayıt hatası - Müşteri ID: ' . $musteri->musteri_id . ' - Hata: ' . ($db_error['message'] ?? 'Bilinmeyen hata'));
            $this->jsonResponse([
                'status' => 'error',
                'message' => 'OTP kaydedilemedi: ' . ($db_error['message'] ?? 'Veritabanı hatası')
            ], 500);
        }

        // SMS gönder
        $message = "Sn. " . $musteri->musteri_ad . ", UG Business mobil uygulaması için doğrulama kodunuz: " . $otp_code;
        sendSmsData($musteri->musteri_iletisim_numarasi, $message);

        $this->jsonResponse([
            'status' => 'success',
            'message' => 'OTP kodu gönderildi',
            'musteri_id' => $musteri->musteri_id,
            'musteri_ad' => $musteri->musteri_ad
        ]);
    }

    /**
     * 2. OTP doğrulama ve token alma
     * POST /api3/verify_otp
     * Body: { "musteri_id": 123, "otp": "123456" }
     */
    public function verify_otp()
    {
        if ($this->input->method(true) !== 'POST') {
            $this->jsonResponse([
                'status' => 'error',
                'message' => 'Sadece POST metodu kabul edilir.'
            ], 405);
        }

        $input_data = json_decode(file_get_contents('php://input'), true) ?? [];
        $musteri_id = isset($input_data['musteri_id']) ? intval($input_data['musteri_id']) : null;
        $otp = isset($input_data['otp']) ? $input_data['otp'] : null;

        if (empty($musteri_id) || empty($otp)) {
            $this->jsonResponse([
                'status' => 'error',
                'message' => 'Müşteri ID ve OTP kodu gereklidir'
            ], 400);
        }

        // OTP'yi veritabanından kontrol et
        $otp_record = $this->db
            ->where('musteri_id', $musteri_id)
            ->where('otp_code', $otp)
            ->where('otp_used', 0)
            ->where('otp_expires_at >', date('Y-m-d H:i:s'))
            ->get('musteri_otp')
            ->row();

        if (!$otp_record) {
            $this->jsonResponse([
                'status' => 'error',
                'message' => 'Geçersiz veya süresi dolmuş OTP kodu'
            ], 401);
        }

        // Müşteri bilgilerini çek
        $musteri = $this->Musteri_model->get_by_id($musteri_id);
        
        if (!$musteri) {
            $this->jsonResponse([
                'status' => 'error',
                'message' => 'Müşteri bulunamadı'
            ], 404);
        }

        // Token oluştur
        $token = $this->generateToken($musteri_id);

        // OTP'yi kullanıldı olarak işaretle
        $this->db->where('musteri_otp_id', $otp_record->musteri_otp_id)
                 ->update('musteri_otp', ['otp_used' => 1, 'otp_used_at' => date('Y-m-d H:i:s')]);

        $this->jsonResponse([
            'status' => 'success',
            'message' => 'Giriş başarılı',
            'token' => $token,
            'musteri' => [
                'musteri_id' => $musteri[0]->musteri_id,
                'musteri_ad' => $musteri[0]->musteri_ad,
                'musteri_iletisim_numarasi' => $musteri[0]->musteri_iletisim_numarasi
            ]
        ]);
    }

    /**
     * 3. Ana Sayfa - Müşteri özet bilgileri
     * GET /api3/anasayfa
     * Header: Authorization: Bearer {token}
     */
    public function anasayfa()
    {
        $this->authenticate();

        // Cihaz sayısı
        $cihaz_sayisi = $this->db
            ->select('COUNT(*) as toplam')
            ->from('siparis_urunleri')
            ->join('siparisler', 'siparisler.siparis_id = siparis_urunleri.siparis_kodu')
            ->join('merkezler', 'siparisler.merkez_no = merkezler.merkez_id')
            ->where('merkezler.merkez_yetkili_id', $this->musteri_id)
            ->where('siparis_urunleri.siparis_urun_aktif', 1)
            ->get()->row()->toplam;

        // Şube sayısı
        $sube_sayisi = $this->db
            ->where('merkez_yetkili_id', $this->musteri_id)
            ->count_all_results('merkezler');

        // Garantisi biten cihaz sayısı
        $garanti_biten = $this->db
            ->select('COUNT(*) as toplam')
            ->from('siparis_urunleri')
            ->join('siparisler', 'siparisler.siparis_id = siparis_urunleri.siparis_kodu')
            ->join('merkezler', 'siparisler.merkez_no = merkezler.merkez_id')
            ->where('merkezler.merkez_yetkili_id', $this->musteri_id)
            ->where('siparis_urunleri.siparis_urun_aktif', 1)
            ->where('siparis_urunleri.garanti_bitis_tarihi <', date('Y-m-d'))
            ->get()->row()->toplam;

        $this->jsonResponse([
            'status' => 'success',
            'data' => [
                'musteri_ad' => $this->musteri_data->musteri_ad,
                'musteri_iletisim_numarasi' => $this->musteri_data->musteri_iletisim_numarasi,
                'istatistikler' => [
                    'toplam_cihaz' => intval($cihaz_sayisi),
                    'toplam_sube' => intval($sube_sayisi),
                    'garanti_biten_cihaz' => intval($garanti_biten)
                ]
            ]
        ]);
    }

    /**
     * 4. Cihaz Listesi
     * GET /api3/cihazlar
     * Header: Authorization: Bearer {token}
     */
    public function cihazlar()
    {
        $this->authenticate();

        $cihazlar = $this->db
            ->select('siparis_urunleri.siparis_urun_id, siparis_urunleri.seri_numarasi, 
                     urunler.urun_adi, urunler.urun_slug,
                     siparis_urunleri.garanti_baslangic_tarihi, siparis_urunleri.garanti_bitis_tarihi,
                     merkezler.merkez_adi, merkezler.merkez_id,
                     sehirler.sehir_adi, ilceler.ilce_adi')
            ->from('siparis_urunleri')
            ->join('urunler', 'urunler.urun_id = siparis_urunleri.urun_no')
            ->join('siparisler', 'siparisler.siparis_id = siparis_urunleri.siparis_kodu')
            ->join('merkezler', 'siparisler.merkez_no = merkezler.merkez_id')
            ->join('sehirler', 'sehirler.sehir_id = merkezler.merkez_il_id', 'left')
            ->join('ilceler', 'ilceler.ilce_id = merkezler.merkez_ilce_id', 'left')
            ->where('merkezler.merkez_yetkili_id', $this->musteri_id)
            ->where('siparis_urunleri.siparis_urun_aktif', 1)
            ->order_by('siparis_urunleri.siparis_urun_id', 'DESC')
            ->get()->result();

        $cihaz_listesi = [];
        foreach ($cihazlar as $cihaz) {
            $garanti_durumu = 'Aktif';
            if ($cihaz->garanti_bitis_tarihi && strtotime($cihaz->garanti_bitis_tarihi) < time()) {
                $garanti_durumu = 'Süresi Dolmuş';
            } elseif (!$cihaz->garanti_baslangic_tarihi) {
                $garanti_durumu = 'Bilinmiyor';
            }

            $cihaz_listesi[] = [
                'cihaz_id' => $cihaz->siparis_urun_id,
                'seri_numarasi' => $cihaz->seri_numarasi,
                'urun_adi' => $cihaz->urun_adi,
                'urun_slug' => $cihaz->urun_slug,
                'garanti_baslangic_tarihi' => $cihaz->garanti_baslangic_tarihi,
                'garanti_bitis_tarihi' => $cihaz->garanti_bitis_tarihi,
                'garanti_durumu' => $garanti_durumu,
                'merkez_adi' => $cihaz->merkez_adi,
                'merkez_id' => $cihaz->merkez_id,
                'lokasyon' => trim(($cihaz->ilce_adi ? $cihaz->ilce_adi . ' / ' : '') . ($cihaz->sehir_adi ? $cihaz->sehir_adi : ''))
            ];
        }

        $this->jsonResponse([
            'status' => 'success',
            'data' => [
                'toplam_cihaz' => count($cihaz_listesi),
                'cihazlar' => $cihaz_listesi
            ]
        ]);
    }

    /**
     * 5. Cihaz Detayı
     * GET /api3/cihaz_detay/{cihaz_id}
     * Header: Authorization: Bearer {token}
     */
    public function cihaz_detay($cihaz_id = null)
    {
        $this->authenticate();

        if (empty($cihaz_id)) {
            $this->jsonResponse([
                'status' => 'error',
                'message' => 'Cihaz ID gereklidir'
            ], 400);
        }

        $cihaz = $this->db
            ->select('siparis_urunleri.*, 
                     urunler.urun_adi, urunler.urun_slug,
                     merkezler.merkez_adi, merkezler.merkez_adresi, merkezler.merkez_id,
                     sehirler.sehir_adi, ilceler.ilce_adi,
                     siparisler.siparis_kodu')
            ->from('siparis_urunleri')
            ->join('urunler', 'urunler.urun_id = siparis_urunleri.urun_no')
            ->join('siparisler', 'siparisler.siparis_id = siparis_urunleri.siparis_kodu')
            ->join('merkezler', 'siparisler.merkez_no = merkezler.merkez_id')
            ->join('sehirler', 'sehirler.sehir_id = merkezler.merkez_il_id', 'left')
            ->join('ilceler', 'ilceler.ilce_id = merkezler.merkez_ilce_id', 'left')
            ->where('siparis_urunleri.siparis_urun_id', $cihaz_id)
            ->where('merkezler.merkez_yetkili_id', $this->musteri_id)
            ->where('siparis_urunleri.siparis_urun_aktif', 1)
            ->get()->row();

        if (!$cihaz) {
            $this->jsonResponse([
                'status' => 'error',
                'message' => 'Cihaz bulunamadı'
            ], 404);
        }

        // Cihaza bağlı eğitim videolarını çek
        $egitimler = $this->db
            ->select('cihaz_egitimleri.*, urunler.urun_adi, siparis_urunleri.seri_numarasi')
            ->from('cihaz_egitimleri')
            ->join('siparis_urunleri', 'siparis_urunleri.siparis_urun_id = cihaz_egitimleri.siparis_urun_no')
            ->join('urunler', 'urunler.urun_id = siparis_urunleri.urun_no', 'left')
            ->where('siparis_urunleri.siparis_urun_id', $cihaz_id)
            ->order_by('cihaz_egitimleri.egitim_tarihi', 'DESC')
            ->get()->result();

        $egitim_listesi = [];
        foreach ($egitimler as $egitim) {
            // Eğitim notlarından video URL'lerini çıkar (basit regex ile)
            $video_urls = [];
            if (!empty($egitim->egitim_notlari)) {
                // YouTube, Vimeo gibi video URL'lerini bul
                preg_match_all('/(https?:\/\/[^\s]+(?:youtube|youtu\.be|vimeo|dailymotion)[^\s]*)/i', $egitim->egitim_notlari, $matches);
                if (!empty($matches[1])) {
                    $video_urls = $matches[1];
                }
            }

            $egitim_listesi[] = [
                'egitim_id' => $egitim->egitim_id,
                'egitim_tarihi' => $egitim->egitim_tarihi,
                'urun_adi' => $egitim->urun_adi,
                'video_urls' => $video_urls
            ];
        }

        $garanti_durumu = 'Aktif';
        if ($cihaz->garanti_bitis_tarihi && strtotime($cihaz->garanti_bitis_tarihi) < time()) {
            $garanti_durumu = 'Süresi Dolmuş';
        } elseif (!$cihaz->garanti_baslangic_tarihi) {
            $garanti_durumu = 'Bilinmiyor';
        }

        $this->jsonResponse([
            'status' => 'success',
            'data' => [
                'cihaz_id' => $cihaz->siparis_urun_id,
                'seri_numarasi' => $cihaz->seri_numarasi,
                'urun_adi' => $cihaz->urun_adi,
                'urun_slug' => $cihaz->urun_slug,
                'siparis_kodu' => $cihaz->siparis_kodu,
                'garanti_baslangic_tarihi' => $cihaz->garanti_baslangic_tarihi,
                'garanti_bitis_tarihi' => $cihaz->garanti_bitis_tarihi,
                'garanti_durumu' => $garanti_durumu,
                'merkez' => [
                    'merkez_id' => $cihaz->merkez_id,
                    'merkez_adi' => $cihaz->merkez_adi,
                    'merkez_adresi' => $cihaz->merkez_adresi,
                    'lokasyon' => trim(($cihaz->ilce_adi ? $cihaz->ilce_adi . ' / ' : '') . ($cihaz->sehir_adi ? $cihaz->sehir_adi : ''))
                ],
                'egitimler' => $egitim_listesi
            ]
        ]);
    }

    /**
     * 6. Eğitim Videoları
     * GET /api3/egitim_videolari
     * Header: Authorization: Bearer {token}
     */
    public function egitim_videolari()
    {
        $this->authenticate();

        // Müşteriye ait tüm cihazların seri numaralarını al
        $seri_numaralari = $this->db
            ->select('siparis_urunleri.seri_numarasi')
            ->from('siparis_urunleri')
            ->join('siparisler', 'siparisler.siparis_id = siparis_urunleri.siparis_kodu')
            ->join('merkezler', 'siparisler.merkez_no = merkezler.merkez_id')
            ->where('merkezler.merkez_yetkili_id', $this->musteri_id)
            ->where('siparis_urunleri.siparis_urun_aktif', 1)
            ->where('siparis_urunleri.seri_numarasi IS NOT NULL')
            ->where('siparis_urunleri.seri_numarasi !=', '')
            ->get()->result();

        $seri_list = [];
        foreach ($seri_numaralari as $seri) {
            $seri_list[] = $seri->seri_numarasi;
        }

        $videolar = [];
        if (!empty($seri_list)) {
            $egitimler = $this->db
                ->select('cihaz_egitimleri.*, urunler.urun_adi, siparis_urunleri.siparis_urun_id as cihaz_id, siparis_urunleri.seri_numarasi')
                ->from('cihaz_egitimleri')
                ->join('siparis_urunleri', 'siparis_urunleri.siparis_urun_id = cihaz_egitimleri.siparis_urun_no')
                ->join('urunler', 'urunler.urun_id = siparis_urunleri.urun_no', 'left')
                ->where_in('siparis_urunleri.seri_numarasi', $seri_list)
                ->order_by('cihaz_egitimleri.egitim_tarihi', 'DESC')
                ->get()->result();

            foreach ($egitimler as $egitim) {
                // Eğitim notlarından video URL'lerini çıkar
                $video_urls = [];
                if (!empty($egitim->egitim_notlari)) {
                    preg_match_all('/(https?:\/\/[^\s]+(?:youtube|youtu\.be|vimeo|dailymotion)[^\s]*)/i', $egitim->egitim_notlari, $matches);
                    if (!empty($matches[1])) {
                        $video_urls = array_unique($matches[1]);
                    }
                }

                if (!empty($video_urls)) {
                    $videolar[] = [
                        'egitim_id' => $egitim->egitim_id,
                        'cihaz_id' => $egitim->cihaz_id,
                        'urun_adi' => $egitim->urun_adi,
                        'seri_numarasi' => $egitim->seri_numarasi,
                        'egitim_tarihi' => $egitim->egitim_tarihi,
                        'video_urls' => array_values($video_urls)
                    ];
                }
            }
        }

        $this->jsonResponse([
            'status' => 'success',
            'data' => [
                'toplam_video' => count($videolar),
                'videolar' => $videolar
            ]
        ]);
    }

    /**
     * 7. Şube Listesi
     * GET /api3/subeler
     * Header: Authorization: Bearer {token}
     */
    public function subeler()
    {
        $this->authenticate();

        $subeler = $this->Merkez_model->get_all(['merkez_yetkili_id' => $this->musteri_id]);

        $sube_listesi = [];
        foreach ($subeler as $sube) {
            $sube_listesi[] = [
                'sube_id' => $sube->merkez_id,
                'sube_adi' => $sube->merkez_adi,
                'adres' => $sube->merkez_adresi,
                'sehir' => $sube->sehir_adi ?? '',
                'ilce' => $sube->ilce_adi ?? '',
                'telefon' => $this->musteri_data->musteri_iletisim_numarasi,
                'lokasyon' => trim(($sube->ilce_adi ? $sube->ilce_adi . ' / ' : '') . ($sube->sehir_adi ? $sube->sehir_adi : ''))
            ];
        }

        $this->jsonResponse([
            'status' => 'success',
            'data' => [
                'toplam_sube' => count($sube_listesi),
                'subeler' => $sube_listesi
            ]
        ]);
    }

    /**
     * 8. Profil Bilgileri
     * GET /api3/profil
     * Header: Authorization: Bearer {token}
     */
    public function profil()
    {
        $this->authenticate();

        // Cihaz sayısı
        $cihaz_sayisi = $this->db
            ->select('COUNT(*) as toplam')
            ->from('siparis_urunleri')
            ->join('siparisler', 'siparisler.siparis_id = siparis_urunleri.siparis_kodu')
            ->join('merkezler', 'siparisler.merkez_no = merkezler.merkez_id')
            ->where('merkezler.merkez_yetkili_id', $this->musteri_id)
            ->where('siparis_urunleri.siparis_urun_aktif', 1)
            ->get()->row()->toplam;

        // Şube sayısı
        $sube_sayisi = $this->db
            ->where('merkez_yetkili_id', $this->musteri_id)
            ->count_all_results('merkezler');

        // Şube listesi (kısa)
        $subeler = $this->Merkez_model->get_all(['merkez_yetkili_id' => $this->musteri_id]);
        $sube_listesi = [];
        foreach ($subeler as $sube) {
            $sube_listesi[] = [
                'sube_id' => $sube->merkez_id,
                'sube_adi' => $sube->merkez_adi,
                'lokasyon' => trim(($sube->ilce_adi ? $sube->ilce_adi . ' / ' : '') . ($sube->sehir_adi ? $sube->sehir_adi : ''))
            ];
        }

        $this->jsonResponse([
            'status' => 'success',
            'data' => [
                'musteri_id' => $this->musteri_data->musteri_id,
                'musteri_ad' => $this->musteri_data->musteri_ad,
                'musteri_kod' => $this->musteri_data->musteri_kod ?? '',
                'telefon' => $this->musteri_data->musteri_iletisim_numarasi,
                'istatistikler' => [
                    'toplam_cihaz' => intval($cihaz_sayisi),
                    'toplam_sube' => intval($sube_sayisi)
                ],
                'subeler' => $sube_listesi
            ]
        ]);
    }

    /**
     * 9. Müşteri Bilgilerini Güncelleme
     * PUT /api3/musteri_guncelle
     * Header: Authorization: Bearer {token}
     * Body: { "musteri_ad": "...", "musteri_iletisim_numarasi": "...", "musteri_email_adresi": "...", ... }
     */
    public function musteri_guncelle()
    {
        $this->authenticate();

        if ($this->input->method(true) !== 'PUT') {
            $this->jsonResponse([
                'status' => 'error',
                'message' => 'Sadece PUT metodu kabul edilir.'
            ], 405);
        }

        $input_data = json_decode(file_get_contents('php://input'), true) ?? [];

        // Güncellenebilir alanlar
        $update_data = [];

        if (isset($input_data['musteri_ad'])) {
            $update_data['musteri_ad'] = mb_strtoupper($this->pre_up(escape($input_data['musteri_ad'])), 'UTF-8');
        }

        if (isset($input_data['musteri_iletisim_numarasi'])) {
            $telefon = escape(str_replace(" ", "", $input_data['musteri_iletisim_numarasi']));
            
            // Telefon numarası başka bir müşteride kullanılıyor mu kontrol et
            $check_telefon = $this->db
                ->where('musteri_iletisim_numarasi', $telefon)
                ->where('musteri_id !=', $this->musteri_id)
                ->get('musteriler');

            if ($check_telefon->num_rows() > 0) {
                $this->jsonResponse([
                    'status' => 'error',
                    'message' => 'Bu telefon numarası başka bir müşteri tarafından kullanılıyor'
                ], 400);
            }

            $update_data['musteri_iletisim_numarasi'] = $telefon;
        }

        if (isset($input_data['musteri_sabit_numara'])) {
            $update_data['musteri_sabit_numara'] = escape($input_data['musteri_sabit_numara']);
        }

        if (isset($input_data['musteri_email_adresi'])) {
            $update_data['musteri_email_adresi'] = escape($input_data['musteri_email_adresi']);
        }

        if (isset($input_data['musteri_cinsiyet'])) {
            $update_data['musteri_cinsiyet'] = escape($input_data['musteri_cinsiyet']);
        }

        if (isset($input_data['yetkili_adi_2'])) {
            $update_data['yetkili_adi_2'] = escape($input_data['yetkili_adi_2']);
        }

        if (isset($input_data['yetkili_iletisim_2'])) {
            $update_data['yetkili_iletisim_2'] = escape(str_replace(" ", "", $input_data['yetkili_iletisim_2']));
        }

        if (empty($update_data)) {
            $this->jsonResponse([
                'status' => 'error',
                'message' => 'Güncellenecek alan bulunamadı'
            ], 400);
        }

        // Güncelleme notu ekle
        $update_data['musteri_guncelleme_tarihi'] = date('Y-m-d H:i:s');
        $update_data['musteri_kayit_guncelleme_notu'] = 'Mobil Uygulama - ' . date("d.m.Y H:i");

        // Güncelleme işlemi
        $this->Musteri_model->update($this->musteri_id, $update_data);

        // Güncellenmiş müşteri bilgilerini çek
        $musteri = $this->Musteri_model->get_by_id($this->musteri_id);

        $this->jsonResponse([
            'status' => 'success',
            'message' => 'Müşteri bilgileri güncellendi',
            'data' => [
                'musteri_id' => $musteri[0]->musteri_id,
                'musteri_ad' => $musteri[0]->musteri_ad,
                'musteri_iletisim_numarasi' => $musteri[0]->musteri_iletisim_numarasi,
                'musteri_email_adresi' => $musteri[0]->musteri_email_adresi ?? ''
            ]
        ]);
    }

    /**
     * 10. Şube Bilgilerini Güncelleme
     * PUT /api3/sube_guncelle/{sube_id}
     * Header: Authorization: Bearer {token}
     * Body: { "merkez_adi": "...", "merkez_adresi": "...", "merkez_il_id": 1, "merkez_ilce_id": 1 }
     */
    public function sube_guncelle($sube_id = null)
    {
        $this->authenticate();

        if ($this->input->method(true) !== 'PUT') {
            $this->jsonResponse([
                'status' => 'error',
                'message' => 'Sadece PUT metodu kabul edilir.'
            ], 405);
        }

        if (empty($sube_id)) {
            $this->jsonResponse([
                'status' => 'error',
                'message' => 'Şube ID gereklidir'
            ], 400);
        }

        // Şubenin bu müşteriye ait olduğunu kontrol et
        $sube = $this->db
            ->where('merkez_id', $sube_id)
            ->where('merkez_yetkili_id', $this->musteri_id)
            ->get('merkezler')
            ->row();

        if (!$sube) {
            $this->jsonResponse([
                'status' => 'error',
                'message' => 'Şube bulunamadı veya bu şubeye erişim yetkiniz yok'
            ], 404);
        }

        $input_data = json_decode(file_get_contents('php://input'), true) ?? [];

        // Güncellenebilir alanlar
        $update_data = [];

        if (isset($input_data['merkez_adi'])) {
            $update_data['merkez_adi'] = escape($input_data['merkez_adi']);
        }

        if (isset($input_data['merkez_adresi'])) {
            $update_data['merkez_adresi'] = escape($input_data['merkez_adresi']);
        }

        if (isset($input_data['merkez_il_id'])) {
            $update_data['merkez_il_id'] = intval($input_data['merkez_il_id']);
        }

        if (isset($input_data['merkez_ilce_id'])) {
            $update_data['merkez_ilce_id'] = intval($input_data['merkez_ilce_id']);
        }

        if (empty($update_data)) {
            $this->jsonResponse([
                'status' => 'error',
                'message' => 'Güncellenecek alan bulunamadı'
            ], 400);
        }

        // Güncelleme işlemi
        $this->Merkez_model->update($sube_id, $update_data);

        // Güncellenmiş şube bilgilerini çek
        $guncellenmis_sube = $this->Merkez_model->get_by_id($sube_id);

        $this->jsonResponse([
            'status' => 'success',
            'message' => 'Şube bilgileri güncellendi',
            'data' => [
                'sube_id' => $guncellenmis_sube->merkez_id,
                'sube_adi' => $guncellenmis_sube->merkez_adi,
                'adres' => $guncellenmis_sube->merkez_adresi,
                'sehir' => $guncellenmis_sube->sehir_adi ?? '',
                'ilce' => $guncellenmis_sube->ilce_adi ?? ''
            ]
        ]);
    }

    /**
     * Helper: String'i büyük harfe çevir (Türkçe karakter desteği ile)
     */
    private function pre_up($str)
    {
        $str = str_replace('i', 'İ', $str);
        $str = str_replace('ı', 'I', $str);
        return $str;
    }

    /**
     * 11. Başlık Sorgulama
     * GET /api3/baslik_sorgula?seri_no={baslik_seri_no}
     * Header: Authorization: Bearer {token}
     */
    public function baslik_sorgula()
    {
        $this->authenticate();

        $seri_no = $this->input->get('seri_no');

        if (empty($seri_no)) {
            $this->jsonResponse([
                'status' => 'error',
                'message' => 'Başlık seri numarası gereklidir'
            ], 400);
        }

        // Başlık bilgilerini çek (müşteri kontrolü ile)
        $baslik = $this->db
            ->select('urun_baslik_tanimlari.urun_baslik_tanim_id,
                     urun_baslik_tanimlari.baslik_seri_no,
                     urun_baslik_tanimlari.baslik_garanti_baslangic_tarihi,
                     urun_baslik_tanimlari.baslik_garanti_bitis_tarihi,
                     urun_baslik_tanimlari.dahili_baslik,
                     urun_baslik_tanimlari.baslik_tanim_kayit_tarihi,
                     urun_basliklari.baslik_adi,
                     urun_basliklari.baslik_resim,
                     urunler.urun_adi,
                     urunler.urun_slug,
                     siparis_urunleri.siparis_urun_id,
                     siparis_urunleri.seri_numarasi as cihaz_seri_numarasi,
                     siparis_urunleri.garanti_baslangic_tarihi as cihaz_garanti_baslangic,
                     siparis_urunleri.garanti_bitis_tarihi as cihaz_garanti_bitis,
                     siparisler.siparis_id,
                     siparisler.siparis_kodu,
                     merkezler.merkez_id,
                     merkezler.merkez_adi,
                     merkezler.merkez_adresi,
                     sehirler.sehir_adi,
                     ilceler.ilce_adi,
                     musteriler.musteri_id,
                     musteriler.musteri_ad')
            ->from('urun_baslik_tanimlari')
            ->join('urun_basliklari', 'urun_baslik_tanimlari.urun_baslik_no = urun_basliklari.baslik_id')
            ->join('siparis_urunleri', 'urun_baslik_tanimlari.siparis_urun_id = siparis_urunleri.siparis_urun_id')
            ->join('urunler', 'urunler.urun_id = siparis_urunleri.urun_no')
            ->join('siparisler', 'siparis_urunleri.siparis_kodu = siparisler.siparis_id')
            ->join('merkezler', 'siparisler.merkez_no = merkezler.merkez_id')
            ->join('musteriler', 'merkezler.merkez_yetkili_id = musteriler.musteri_id')
            ->join('sehirler', 'merkezler.merkez_il_id = sehirler.sehir_id', 'left')
            ->join('ilceler', 'merkezler.merkez_ilce_id = ilceler.ilce_id', 'left')
            ->where('urun_baslik_tanimlari.baslik_seri_no', $seri_no)
            ->where('merkezler.merkez_yetkili_id', $this->musteri_id)
            ->get()
            ->row();

        if (!$baslik) {
            $this->jsonResponse([
                'status' => 'error',
                'message' => 'Başlık bulunamadı veya bu başlığa erişim yetkiniz yok'
            ], 404);
        }

        // Garanti durumu hesapla
        $garanti_durumu = 'Aktif';
        if ($baslik->baslik_garanti_bitis_tarihi && strtotime($baslik->baslik_garanti_bitis_tarihi) < time()) {
            $garanti_durumu = 'Süresi Dolmuş';
        } elseif (!$baslik->baslik_garanti_baslangic_tarihi) {
            $garanti_durumu = 'Bilinmiyor';
        }

        // Başlığa ait arıza durumunu kontrol et
        $ariza_durumu = null;
        $ariza_bilgisi = $this->db
            ->select('urun_baslik_ariza_tanimlari.*,
                     urun_baslik_ariza_siparis_durumlari.urun_baslik_ariza_siparis_durum_adi,
                     urun_baslik_kargolar.urun_baslik_kargo_adi')
            ->from('urun_baslik_ariza_tanimlari')
            ->join('urun_baslik_ariza_siparis_durumlari', 'urun_baslik_ariza_tanimlari.urun_baslik_ariza_durum_no = urun_baslik_ariza_siparis_durumlari.urun_baslik_ariza_siparis_durum_id', 'left')
            ->join('urun_baslik_kargolar', 'urun_baslik_ariza_tanimlari.urun_baslik_gelen_kargo_no = urun_baslik_kargolar.urun_baslik_kargo_id', 'left')
            ->where('urun_baslik_ariza_tanimlari.siparis_urun_baslik_no', $baslik->urun_baslik_tanim_id)
            ->where('urun_baslik_ariza_tanimlari.ariza_tamamlandi', 0)
            ->order_by('urun_baslik_ariza_tanimlari.urun_baslik_ariza_tanim_id', 'DESC')
            ->get()
            ->row();

        if ($ariza_bilgisi) {
            $ariza_durumu = [
                'durum_adi' => $ariza_bilgisi->urun_baslik_ariza_siparis_durum_adi ?? 'Bilinmiyor',
                'durum_no' => $ariza_bilgisi->urun_baslik_ariza_durum_no,
                'aciklama' => $ariza_bilgisi->urun_baslik_ariza_aciklama ?? '',
                'kargo_no' => $ariza_bilgisi->urun_baslik_kargo_adi ?? '',
                'kayit_tarihi' => $ariza_bilgisi->urun_baslik_ariza_kayit_tarihi,
                'guncelleme_tarihi' => $ariza_bilgisi->ariza_siparis_durum_guncelleme_tarihi
            ];
        }

        $this->jsonResponse([
            'status' => 'success',
            'data' => [
                'baslik_id' => $baslik->urun_baslik_tanim_id,
                'baslik_seri_no' => $baslik->baslik_seri_no,
                'baslik_adi' => $baslik->baslik_adi,
                'baslik_resim' => $baslik->baslik_resim ? base_url($baslik->baslik_resim) : null,
                'dahili_baslik' => (bool)$baslik->dahili_baslik,
                'garanti_baslangic_tarihi' => $baslik->baslik_garanti_baslangic_tarihi,
                'garanti_bitis_tarihi' => $baslik->baslik_garanti_bitis_tarihi,
                'garanti_durumu' => $garanti_durumu,
                'kayit_tarihi' => $baslik->baslik_tanim_kayit_tarihi,
                'cihaz' => [
                    'cihaz_id' => $baslik->siparis_urun_id,
                    'seri_numarasi' => $baslik->cihaz_seri_numarasi,
                    'urun_adi' => $baslik->urun_adi,
                    'urun_slug' => $baslik->urun_slug,
                    'garanti_baslangic_tarihi' => $baslik->cihaz_garanti_baslangic,
                    'garanti_bitis_tarihi' => $baslik->cihaz_garanti_bitis
                ],
                'siparis' => [
                    'siparis_id' => $baslik->siparis_id,
                    'siparis_kodu' => $baslik->siparis_kodu
                ],
                'merkez' => [
                    'merkez_id' => $baslik->merkez_id,
                    'merkez_adi' => $baslik->merkez_adi,
                    'merkez_adresi' => $baslik->merkez_adresi,
                    'lokasyon' => trim(($baslik->ilce_adi ? $baslik->ilce_adi . ' / ' : '') . ($baslik->sehir_adi ? $baslik->sehir_adi : ''))
                ],
                'ariza_durumu' => $ariza_durumu
            ]
        ]);
    }

    /**
     * 12. Çıkış Yapma
     * POST /api3/logout
     * Header: Authorization: Bearer {token}
     */
    public function logout()
    {
        // Token'ı geçersiz kıl (production'da token blacklist kullanılmalı)
        $this->jsonResponse([
            'status' => 'success',
            'message' => 'Çıkış yapıldı'
        ]);
    }
}

