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
        
        // Bugünün tarihini al
        $bugun_ay = date('m');
        $bugun_gun = date('d');
        $bugun_tarih = date('Y-m-d');
        
        // Bu ayın başlangıç ve bitiş tarihleri
        $bu_ay_baslangic = date('Y-m-01');
        $bu_ay_bitis = date('Y-m-t');
        
        // Bugün doğum günü olan aktif kullanıcıları bul
        $this->db->select('kullanicilar.*, departmanlar.departman_adi');
        $this->db->from('kullanicilar');
        $this->db->join('departmanlar', 'departmanlar.departman_id = kullanicilar.kullanici_departman_id', 'left');
        $this->db->where('kullanici_aktif', 1);
        $this->db->where('kullanici_dogum_tarihi IS NOT NULL');
        $this->db->where('kullanici_dogum_tarihi !=', '0000-00-00');
        $this->db->where("MONTH(kullanici_dogum_tarihi)", $bugun_ay);
        $this->db->where("DAY(kullanici_dogum_tarihi)", $bugun_gun);
        $this->db->order_by('kullanici_ad_soyad', 'ASC');
        $bugun_dogum_gunu = $this->db->get()->result();
        
        // Bu ay doğum günü olan aktif kullanıcıları bul
        $this->db->select('kullanicilar.*, departmanlar.departman_adi');
        $this->db->from('kullanicilar');
        $this->db->join('departmanlar', 'departmanlar.departman_id = kullanicilar.kullanici_departman_id', 'left');
        $this->db->where('kullanici_aktif', 1);
        $this->db->where('kullanici_dogum_tarihi IS NOT NULL');
        $this->db->where('kullanici_dogum_tarihi !=', '0000-00-00');
        $this->db->where("MONTH(kullanici_dogum_tarihi)", $bugun_ay);
        $this->db->order_by('DAY(kullanici_dogum_tarihi)', 'ASC');
        $bu_ay_dogum_gunu = $this->db->get()->result();
        
        // Toplam aktif çalışan sayısı
        $toplam_calisan = $this->db->where('kullanici_aktif', 1)->get('kullanicilar')->num_rows();
        
        // Bu ay gönderilen doğum günü SMS'lerini bul
        $bu_ay_baslangic_tarih = date('Y-m-01 00:00:00');
        $bu_ay_bitis_tarih = date('Y-m-t 23:59:59');
        
        $this->db->select('gonderilen_smsler.*, kullanicilar.kullanici_ad_soyad, kullanicilar.kullanici_bireysel_iletisim_no');
        $this->db->from('gonderilen_smsler');
        $this->db->join('kullanicilar', 'kullanicilar.kullanici_id = gonderilen_smsler.gonderilen_sms_kullanici_id', 'left');
        $this->db->where('gonderim_tarihi >=', $bu_ay_baslangic_tarih);
        $this->db->where('gonderim_tarihi <=', $bu_ay_bitis_tarih);
        $this->db->like('gonderilen_sms_detay', 'Doğum Gününüz Kutlu Olsun', 'after');
        $this->db->order_by('gonderim_tarihi', 'DESC');
        $sms_gecmisi = $this->db->get()->result();
        
        // İstatistikler
        $viewData["bugun_dogum_gunu"] = $bugun_dogum_gunu;
        $viewData["bu_ay_dogum_gunu"] = $bu_ay_dogum_gunu;
        $viewData["toplam_calisan"] = $toplam_calisan;
        $viewData["bu_ay_dogum_gunu_sayisi"] = count($bu_ay_dogum_gunu);
        $viewData["bugun_dogum_gunu_sayisi"] = count($bugun_dogum_gunu);
        $viewData["bu_ay_sms_sayisi"] = count($sms_gecmisi);
        $viewData["sms_gecmisi"] = $sms_gecmisi;
        
        $viewData["page"] = "dogum_gunu/list";
		$this->load->view('base_view',$viewData);
	}
}

