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
		$viewData["kullanicilar_aktif"] = $this->db->where("kullanici_aktif",1)->where("kapi1_giris",1)->where("kullanici_departman_id !=",19)->get("kullanicilar")->result();
		$viewData["kullanicilar_pasif"] = $this->db->where("kullanici_aktif",1)->where("kapi1_giris",0)->where("kullanici_departman_id !=",19)->get("kullanicilar")->result();
		$viewData["page"] = "kapi/list";
		$this->load->view('base_view',$viewData);
	}
	public function success_door($kullanici_id)
	{
        $this->db->where("kullanici_id",$kullanici_id)->update("kullanicilar",["kapi1_giris"=>1]);
		$viewData["page"] = "kapi/list";
		redirect(base_url("kapi"));
	}
	public function disable_door($kullanici_id)
	{
        $this->db->where("kullanici_id",$kullanici_id)->update("kullanicilar",["kapi1_giris"=>0]);
		$viewData["page"] = "kapi/list";
		redirect(base_url("kapi"));
	}
	
}
