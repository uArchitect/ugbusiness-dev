<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kullanici_sablon_tanim extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control(); 
        date_default_timezone_set('Europe/Istanbul');
	//	yetki_kontrol("kullanici_sablon_tanimlama");
    } 

    public function index($sablon_id) {

        $tanimlar = $this->db->where("sablon_no",$sablon_id) 
                         ->join('kullanicilar', 'kullanicilar.kullanici_id = kullanici_sablon_tanimlari.kullanici_no') 
                         ->get("kullanici_sablon_tanimlari")->result();

        $data['tanimlar'] = $tanimlar;

        $data['veri'] = $this->db->where("sablon_veri_id",$sablon_id)->get("sablon_veriler")->result()[0];
        $data['kategori'] = $this->db->where("sablon_kategori_id ",$data['veri']->sablon_veri_kategori_id)->get("sablon_kategoriler")->result()[0];

    $kullanicilar = $this->db  
    ->join('kullanici_sablon_tanimlari', 'kullanicilar.kullanici_id = kullanici_sablon_tanimlari.kullanici_no', 'left')
    ->where("kullanici_aktif", 1)
    ->where("sablon_no IS NULL")  // Sabon no'ya sahip olmayanları almak için
    ->get("kullanicilar")
    ->result();
        
        $data['kullanicilar'] =$kullanicilar;



		$data['page'] = 'kullanici_sablon_tanim/list';
     
		$this->load->view('base_view', $data);
    }

    
    public function ekle_tanim($kullanici_no,$sablon_veri_no) {
        $data = [
            'kullanici_no' => $kullanici_no,
            'sablon_no' => $sablon_veri_no
        ];
        $this->db->insert("kullanici_sablon_tanimlari",$data);
        redirect('kullanici_sablon_tanim/index/'.$sablon_veri_no);
    }
 
    public function cikar_tanim($kayit_id,$sablon_veri_no) {
         
        $this->db->where("kullanici_sablon_tanim_id",$kayit_id)->delete("kullanici_sablon_tanimlari");
        redirect('kullanici_sablon_tanim/index/'.$sablon_veri_no);
    }
}
