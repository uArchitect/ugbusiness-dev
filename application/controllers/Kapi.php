<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kapi extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control(); 
        date_default_timezone_set('Europe/Istanbul');
    }
 
	public function index()
	{
        yetki_kontrol("kapi_yonetim");
        //sendSmsData("05382197344","Kapı Giriş : ".aktif_kullanici()->kullanici_ad_soyad." - Tarih : ".date("d.m.Y H:i"));
		$viewData["kullanicilar_aktif"] = $this->db->where("kullanici_aktif",1)->where("kapi1_giris",1)->get("kullanicilar")->result();
		$viewData["kullanicilar_pasif"] = $this->db->where("kullanici_aktif",1)->where("kapi1_giris",0)->get("kullanicilar")->result();
		
		$viewData["page"] = "kapi/list";
		$this->load->view('base_view',$viewData);
	}





 
  
}
