<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dogum_gunu extends CI_Controller {
	function __construct(){
        parent::__construct();
        // Cron job için session kontrolü yok
        if ($this->uri->segment(2) != 'cron_otomatik_sms_gonder') {
            session_control();
        }
        date_default_timezone_set('Europe/Istanbul');
    }
 
    public function index()
	{     
        yetki_kontrol("sistem_ayar_duzenle"); 
        
        $bugun_ay = date('m');
        $bugun_gun = date('d');
        
        // Bugün doğum günü olanlar
        $bugun_dogum_gunu = $this->db
            ->select('kullanicilar.*, departmanlar.departman_adi')
            ->from('kullanicilar')
            ->join('departmanlar', 'departmanlar.departman_id = kullanicilar.kullanici_departman_id', 'left')
            ->where('kullanici_aktif', 1)
            ->where('kullanici_dogum_tarihi IS NOT NULL')
            ->where('kullanici_dogum_tarihi !=', '0000-00-00')
            ->where("MONTH(kullanici_dogum_tarihi)", $bugun_ay)
            ->where("DAY(kullanici_dogum_tarihi)", $bugun_gun)
            ->order_by('kullanici_ad_soyad', 'ASC')
            ->get()->result();
        
        // Bugün SMS gönderilmiş kullanıcı ID'lerini al
        $bugun_tarih = date('Y-m-d');
        $sms_gonderilen_kullanici_ids = $this->db
            ->select('gonderilen_sms_kullanici_id')
            ->from('gonderilen_smsler')
            ->where('gonderen_kullanici_id', 0) // Sistem otomatik gönderimi
            ->where('DATE(gonderim_tarihi)', $bugun_tarih)
            ->get()
            ->result();
        
        $sms_gonderilen_ids = array();
        foreach ($sms_gonderilen_kullanici_ids as $sms) {
            $sms_gonderilen_ids[] = $sms->gonderilen_sms_kullanici_id;
        }
        
        // Bu ay doğum günü olanlar
        $bu_ay_dogum_gunu_query = $this->db
            ->select('kullanicilar.*, departmanlar.departman_adi')
            ->from('kullanicilar')
            ->join('departmanlar', 'departmanlar.departman_id = kullanicilar.kullanici_departman_id', 'left')
            ->where('kullanici_aktif', 1)
            ->where('kullanici_dogum_tarihi IS NOT NULL')
            ->where('kullanici_dogum_tarihi !=', '0000-00-00')
            ->where("MONTH(kullanici_dogum_tarihi)", $bugun_ay)
            ->order_by('DAY(kullanici_dogum_tarihi)', 'ASC')
            ->get();
        $bu_ay_dogum_gunu = $bu_ay_dogum_gunu_query->result();
        
        // Sıralama: Bugün -> Gelecek -> Geçmiş
        usort($bu_ay_dogum_gunu, function($a, $b) {
            $dogum_gunu_a = date('Y') . '-' . date('m-d', strtotime($a->kullanici_dogum_tarihi));
            $dogum_gunu_b = date('Y') . '-' . date('m-d', strtotime($b->kullanici_dogum_tarihi));
            $bugun = date('Y-m-d');
            
            $durum_a = ($dogum_gunu_a < $bugun) ? 3 : (($dogum_gunu_a == $bugun) ? 1 : 2);
            $durum_b = ($dogum_gunu_b < $bugun) ? 3 : (($dogum_gunu_b == $bugun) ? 1 : 2);
            
            if ($durum_a != $durum_b) {
                return $durum_a <=> $durum_b;
            }
            
            return strtotime($dogum_gunu_a) <=> strtotime($dogum_gunu_b);
        });
        
        // Otomatik SMS gönderimi ayarını kontrol et
        $ayar = $this->db->get_where("ayarlar", array('ayar_id' => 1))->row();
        $otomatik_sms_aktif = isset($ayar->otomatik_sms_gonderme) ? $ayar->otomatik_sms_gonderme : 0;
        
        $viewData["bugun_dogum_gunu"] = $bugun_dogum_gunu;
        $viewData["bu_ay_dogum_gunu"] = $bu_ay_dogum_gunu;
        $viewData["toplam_calisan"] = $this->db->where('kullanici_aktif', 1)->get('kullanicilar')->num_rows();
        $viewData["bu_ay_dogum_gunu_sayisi"] = count($bu_ay_dogum_gunu);
        $viewData["bugun_dogum_gunu_sayisi"] = count($bugun_dogum_gunu);
        $viewData["otomatik_sms_aktif"] = $otomatik_sms_aktif;
        $viewData["sms_gonderilen_ids"] = $sms_gonderilen_ids; // Bugün SMS gönderilmiş kullanıcı ID'leri
        $viewData["page"] = "dogum_gunu/list";
        
		$this->load->view('base_view',$viewData);
	}

    public function otomatik_sms_durum_guncelle()
	{     
        yetki_kontrol("sistem_ayar_duzenle");
        
        $durum = $this->input->post('durum') == '1' ? 1 : 0;
        
        // Ayarı güncelle
        $this->db->where('ayar_id', 1)->update('ayarlar', array('otomatik_sms_gonderme' => $durum));
        
        echo json_encode(array(
            'success' => true,
            'message' => $durum == 1 ? 'Otomatik mesaj gönderimi açıldı.' : 'Otomatik mesaj gönderimi kapatıldı.',
            'durum' => $durum
        ));
	}

    // Manuel SMS gönderme (tek kullanıcı için)
    public function manuel_sms_gonder()
    {
        yetki_kontrol("sistem_ayar_duzenle");
        
        $kullanici_id = $this->input->post('kullanici_id');
        
        if (empty($kullanici_id)) {
            echo json_encode(array('success' => false, 'message' => 'Kullanıcı ID eksik.'));
            return;
        }
        
        // Kullanıcı bilgilerini al
        $kullanici = $this->db
            ->select('kullanicilar.*, departmanlar.departman_adi')
            ->from('kullanicilar')
            ->join('departmanlar', 'departmanlar.departman_id = kullanicilar.kullanici_departman_id', 'left')
            ->where('kullanici_id', $kullanici_id)
            ->where('kullanici_aktif', 1)
            ->get()
            ->row();
        
        if (!$kullanici) {
            echo json_encode(array('success' => false, 'message' => 'Kullanıcı bulunamadı.'));
            return;
        }
        
        // Doğum günü kontrolü
        $bugun_ay = date('m');
        $bugun_gun = date('d');
        $kullanici_dogum_ay = date('m', strtotime($kullanici->kullanici_dogum_tarihi));
        $kullanici_dogum_gun = date('d', strtotime($kullanici->kullanici_dogum_tarihi));
        
        if ($kullanici_dogum_ay != $bugun_ay || $kullanici_dogum_gun != $bugun_gun) {
            echo json_encode(array('success' => false, 'message' => 'Bugün bu kullanıcının doğum günü değil.'));
            return;
        }
        
        // Bugün zaten SMS gönderilmiş mi kontrol et
        $bugun_tarih = date('Y-m-d');
        $bugun_gonderilen = $this->db
            ->where('gonderilen_sms_kullanici_id', $kullanici_id)
            ->where('gonderen_kullanici_id', 0) // Sistem otomatik gönderimi
            ->where('DATE(gonderim_tarihi)', $bugun_tarih)
            ->get('gonderilen_smsler')
            ->num_rows();
        
        if ($bugun_gonderilen > 0) {
            echo json_encode(array('success' => false, 'message' => 'Bu kullanıcıya bugün zaten SMS gönderilmiş.'));
            return;
        }
        
        // SMS şablonunu al
        $sms_template = $this->db->get_where("sms_templates", array('id' => 1, 'is_active' => 1))->row();
        
        if (!$sms_template) {
            echo json_encode(array('success' => false, 'message' => 'SMS şablonu bulunamadı veya aktif değil.'));
            return;
        }
        
        // Telefon numarası kontrolü
        $telefon_no = trim(str_replace(" ", "", $kullanici->kullanici_bireysel_iletisim_no));
        
        if (empty($telefon_no)) {
            echo json_encode(array('success' => false, 'message' => 'Telefon numarası bulunamadı.'));
            return;
        }
        
        // Telefon numarası format kontrolü
        $telefon_no_temiz = preg_replace('/[^0-9]/', '', $telefon_no);
        if (strlen($telefon_no_temiz) < 10) {
            echo json_encode(array('success' => false, 'message' => 'Geçersiz telefon numarası.'));
            return;
        }
        
        // SMS içeriğini hazırla
        $sms_mesaji = $sms_template->message;
        $sms_mesaji = str_replace('[PERSONEL_AD_SOYAD]', $kullanici->kullanici_ad_soyad ?? '', $sms_mesaji);
        $sms_mesaji = str_replace('[DEPARTMAN]', $kullanici->departman_adi ?? '', $sms_mesaji);
        $sms_mesaji = str_replace('[UNVAN]', $kullanici->kullanici_unvan ?? '', $sms_mesaji);
        
        try {
            // SMS gönder (global sendSmsData fonksiyonu)
            sendSmsData($telefon_no_temiz, $sms_mesaji);
            
            // SMS log kaydı
            $insertData = array(
                'gonderilen_sms_kullanici_id' => $kullanici_id,
                'gonderilen_sms_detay' => $sms_mesaji,
                'gonderen_kullanici_id' => 0, // 0 = Sistem otomatik gönderimi
                'gonderim_tarihi' => date('Y-m-d H:i:s')
            );
            $this->db->insert('gonderilen_smsler', $insertData);
            
            echo json_encode(array(
                'success' => true, 
                'message' => $kullanici->kullanici_ad_soyad . ' için doğum günü mesajı başarıyla gönderildi!'
            ));
        } catch (Exception $e) {
            echo json_encode(array(
                'success' => false, 
                'message' => 'SMS gönderilemedi: ' . $e->getMessage()
            ));
        }
    }

    // Cron job için otomatik SMS gönderimi (session kontrolü yok)
    public function cron_otomatik_sms_gonder()
	{     
        // Cron job güvenlik kontrolü (opsiyonel: API key kontrolü eklenebilir)
        // Şu an için sadece switch kontrolü yeterli
        
        // GÜVENLİK KONTROLÜ 1: Otomatik SMS gönderimi aktif mi kontrol et
        $ayar = $this->db->get_where("ayarlar", array('ayar_id' => 1))->row();
        $otomatik_sms_aktif = isset($ayar->otomatik_sms_gonderme) ? $ayar->otomatik_sms_gonderme : 0;
        
        if ($otomatik_sms_aktif != 1) {
            // Switch kapalı, sessizce çık
            return;
        }
        
        // Aşağıdaki fonksiyonu çağır (JSON çıktı vermeden)
        $this->otomatik_sms_gonder_internal(false);
	}

    // İç fonksiyon: Otomatik SMS gönderimi (güvenlik kontrolleri ile)
    private function otomatik_sms_gonder_internal($return_json = true)
	{     
        // GÜVENLİK KONTROLÜ 1: Otomatik SMS gönderimi aktif mi kontrol et (tekrar kontrol - güvenlik için)
        $ayar = $this->db->get_where("ayarlar", array('ayar_id' => 1))->row();
        $otomatik_sms_aktif = isset($ayar->otomatik_sms_gonderme) ? $ayar->otomatik_sms_gonderme : 0;
        
        if ($otomatik_sms_aktif != 1) {
            if ($return_json) {
                echo json_encode(array('success' => false, 'message' => 'Otomatik SMS gönderimi kapalı.'));
            }
            return;
        }
        
        // GÜVENLİK KONTROLÜ 2: SMS Template kontrolü (şablon yoksa hiç gönderme)
        $sms_template = $this->db->get_where("sms_templates", array('id' => 1, 'is_active' => 1))->row();
        
        if (!$sms_template) {
            echo json_encode(array('success' => false, 'message' => 'SMS şablonu bulunamadı veya aktif değil.'));
            return;
        }
        
        $bugun_ay = date('m');
        $bugun_gun = date('d');
        $bugun_tarih = date('Y-m-d');
        
        // GÜVENLİK KONTROLÜ 3: Sadece bugün doğum günü olan AKTİF kullanıcıları çek
        $bugun_dogum_gunu = $this->db
            ->select('kullanicilar.*, departmanlar.departman_adi')
            ->from('kullanicilar')
            ->join('departmanlar', 'departmanlar.departman_id = kullanicilar.kullanici_departman_id', 'left')
            ->where('kullanici_aktif', 1) // Sadece aktif kullanıcılar
            ->where('kullanici_dogum_tarihi IS NOT NULL')
            ->where('kullanici_dogum_tarihi !=', '0000-00-00')
            ->where("MONTH(kullanici_dogum_tarihi)", $bugun_ay)
            ->where("DAY(kullanici_dogum_tarihi)", $bugun_gun)
            ->order_by('kullanici_ad_soyad', 'ASC')
            ->get()->result();
        
        if (empty($bugun_dogum_gunu)) {
            echo json_encode(array('success' => true, 'message' => 'Bugün doğum günü olan çalışan bulunamadı.', 'gonderilen' => 0));
            return;
        }
        
        // GÜVENLİK KONTROLÜ 4: Maksimum gönderim limiti (güvenlik için)
        $max_gonderim_limit = 100; // Güvenlik için maksimum 100 SMS
        if (count($bugun_dogum_gunu) > $max_gonderim_limit) {
            echo json_encode(array(
                'success' => false, 
                'message' => "GÜVENLİK UYARISI: Bugün doğum günü olan çalışan sayısı limiti aşıyor ({$max_gonderim_limit}). Lütfen manuel kontrol edin."
            ));
            return;
        }
        
        $gonderilen_sayisi = 0;
        $hata_sayisi = 0;
        $atlanan_sayisi = 0; // Gün içinde zaten gönderilmiş
        
        foreach ($bugun_dogum_gunu as $kullanici) {
            try {
                // GÜVENLİK KONTROLÜ 5: Telefon numarası kontrolü
                $telefon_no = trim(str_replace(" ", "", $kullanici->kullanici_bireysel_iletisim_no));
                
                if (empty($telefon_no)) {
                    $hata_sayisi++;
                    continue;
                }
                
                // Telefon numarası format kontrolü (sadece rakam, minimum 10 karakter)
                $telefon_no_temiz = preg_replace('/[^0-9]/', '', $telefon_no);
                if (strlen($telefon_no_temiz) < 10) {
                    $hata_sayisi++;
                    continue;
                }
                
                // GÜVENLİK KONTROLÜ 6: Bugün bu kullanıcıya sistem tarafından SMS gönderilmiş mi?
                // (gonderen_kullanici_id = 0 sistem otomatik gönderimi demektir)
                $bugun_gonderilen = $this->db
                    ->where('gonderilen_sms_kullanici_id', $kullanici->kullanici_id)
                    ->where('gonderen_kullanici_id', 0) // Sistem otomatik gönderimi
                    ->where('DATE(gonderim_tarihi)', $bugun_tarih)
                    ->get('gonderilen_smsler')
                    ->num_rows();
                
                if ($bugun_gonderilen > 0) {
                    // Bugün zaten sistem tarafından gönderilmiş, atla (tekrar gönderme)
                    $atlanan_sayisi++;
                    continue;
                }
                
                // GÜVENLİK KONTROLÜ 7: Doğum tarihi kontrolü (bugün gerçekten doğum günü mü?)
                $dogum_tarihi = date('m-d', strtotime($kullanici->kullanici_dogum_tarihi));
                $bugun_tarih_format = date('m-d');
                
                if ($dogum_tarihi != $bugun_tarih_format) {
                    // Doğum tarihi bugün değil, atla
                    $hata_sayisi++;
                    continue;
                }
                
                // Dinamik değişkenleri değiştir
                $sms_mesaji = $sms_template->message;
                $sms_mesaji = str_replace('[PERSONEL_AD_SOYAD]', $kullanici->kullanici_ad_soyad ?? '', $sms_mesaji);
                $sms_mesaji = str_replace('[DEPARTMAN]', $kullanici->departman_adi ?? '', $sms_mesaji);
                $sms_mesaji = str_replace('[UNVAN]', $kullanici->kullanici_unvan ?? '', $sms_mesaji);
                
                // SMS gönder
                sendSmsData($telefon_no_temiz, $sms_mesaji);
                
                // SMS log kaydı (ÖNCE LOG, SONRA SAYAÇ - güvenlik için)
                $insertData = array(
                    'gonderilen_sms_kullanici_id' => $kullanici->kullanici_id,
                    'gonderilen_sms_detay' => $sms_mesaji,
                    'gonderen_kullanici_id' => 0, // Sistem otomatik gönderimi
                    'gonderim_tarihi' => date('Y-m-d H:i:s')
                );
                $this->db->insert('gonderilen_smsler', $insertData);
                
                $gonderilen_sayisi++;
                
            } catch (Exception $e) {
                $hata_sayisi++;
                continue;
            }
        }
        
        if ($return_json) {
            echo json_encode(array(
                'success' => true,
                'message' => "Toplam {$gonderilen_sayisi} SMS gönderildi. ({$atlanan_sayisi} kullanıcıya bugün zaten gönderilmiş, {$hata_sayisi} hata)",
                'gonderilen' => $gonderilen_sayisi,
                'atlanan' => $atlanan_sayisi,
                'hata' => $hata_sayisi
            ));
        }
	}

    // Manuel test için (JSON response döner)
    public function otomatik_sms_gonder()
	{     
        // GÜVENLİK KONTROLÜ 1: Otomatik SMS gönderimi aktif mi kontrol et
        $ayar = $this->db->get_where("ayarlar", array('ayar_id' => 1))->row();
        $otomatik_sms_aktif = isset($ayar->otomatik_sms_gonderme) ? $ayar->otomatik_sms_gonderme : 0;
        
        if ($otomatik_sms_aktif != 1) {
            echo json_encode(array('success' => false, 'message' => 'Otomatik SMS gönderimi kapalı.'));
            return;
        }
        
        // İç fonksiyonu çağır ve JSON response döndür
        $this->otomatik_sms_gonder_internal(true);
	}
}

