<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dogum_gunu extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
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
        
        $viewData["bugun_dogum_gunu"] = $bugun_dogum_gunu;
        $viewData["bu_ay_dogum_gunu"] = $bu_ay_dogum_gunu;
        $viewData["toplam_calisan"] = $this->db->where('kullanici_aktif', 1)->get('kullanicilar')->num_rows();
        $viewData["bu_ay_dogum_gunu_sayisi"] = count($bu_ay_dogum_gunu);
        $viewData["bugun_dogum_gunu_sayisi"] = count($bugun_dogum_gunu);
        $viewData["page"] = "dogum_gunu/list";
        
		$this->load->view('base_view',$viewData);
	}

    public function test_sms_gonder()
	{     
        // Şu anki tarih ve saat
        $simdi = date('Y-m-d H:i:s');
        $simdi_formatted = date('d.m.Y H:i:s');
        
        // SMS Template ID 1'i çek
        $sms_template = $this->db->get_where("sms_templates", array('id' => 1, 'is_active' => 1))->row();
        
        if (!$sms_template) {
            echo json_encode(array(
                'success' => false, 
                'message' => 'SMS şablonu bulunamadı veya aktif değil.',
                'simdi' => $simdi_formatted
            ));
            return;
        }
        
        // Test verileri (dinamik değişkenler için)
        $test_personel = (object) array(
            'kullanici_ad_soyad' => 'Test Personel',
            'departman_adi' => 'Test Departman',
            'kullanici_unvan' => 'Test Ünvan'
        );
        
        // Dinamik değişkenleri değiştir
        $sms_mesaji = $sms_template->message;
        $sms_mesaji = str_replace('[PERSONEL_AD_SOYAD]', $test_personel->kullanici_ad_soyad, $sms_mesaji);
        $sms_mesaji = str_replace('[DEPARTMAN]', $test_personel->departman_adi, $sms_mesaji);
        $sms_mesaji = str_replace('[UNVAN]', $test_personel->kullanici_unvan, $sms_mesaji);
        
        // SMS gönder
        $telefon_no = "5078928490";
        sendSmsData($telefon_no, $sms_mesaji);
        
        // SMS log kaydı
        $insertData = array(
            'gonderilen_sms_kullanici_id' => 0, // Test için
            'gonderilen_sms_detay' => $sms_mesaji,
            'gonderen_kullanici_id' => $this->session->userdata('aktif_kullanici_id'),
            'gonderim_tarihi' => date('Y-m-d H:i:s')
        );
        $this->db->insert('gonderilen_smsler', $insertData);
        
        echo json_encode(array(
            'success' => true,
            'message' => 'SMS başarıyla gönderildi!',
            'simdi' => $simdi_formatted,
            'gonderim_zamani' => date('d.m.Y H:i:s'),
            'telefon' => $telefon_no,
            'sms_mesaji' => $sms_mesaji,
            'template_id' => 1
        ));
	}

    public function test_sms_onizleme()
	{     
        // SMS Template ID 1'i çek
        $sms_template = $this->db->get_where("sms_templates", array('id' => 1, 'is_active' => 1))->row();
        
        if (!$sms_template) {
            echo json_encode(array('success' => false, 'message' => 'SMS şablonu bulunamadı.'));
            return;
        }
        
        // Test verileri (dinamik değişkenler için)
        $test_personel = (object) array(
            'kullanici_ad_soyad' => 'Test Personel',
            'departman_adi' => 'Test Departman',
            'kullanici_unvan' => 'Test Ünvan'
        );
        
        // Dinamik değişkenleri değiştir
        $sms_mesaji = $sms_template->message;
        $sms_mesaji = str_replace('[PERSONEL_AD_SOYAD]', $test_personel->kullanici_ad_soyad, $sms_mesaji);
        $sms_mesaji = str_replace('[DEPARTMAN]', $test_personel->departman_adi, $sms_mesaji);
        $sms_mesaji = str_replace('[UNVAN]', $test_personel->kullanici_unvan, $sms_mesaji);
        
        echo json_encode(array(
            'success' => true,
            'sms_mesaji' => $sms_mesaji,
            'template_id' => 1
        ));
	}
}

