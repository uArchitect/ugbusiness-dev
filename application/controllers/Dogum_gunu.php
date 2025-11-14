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
}

