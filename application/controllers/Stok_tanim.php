<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok_tanim extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
		$this->load->model('Stok_model');
        date_default_timezone_set('Europe/Istanbul');
       
    }
	public function index($stok_id)
	{   
        $stok = $this->Stok_model->stok_kayitlari_all(["stok_id"=>$stok_id]);
		$viewData["data"] = $stok[0];

		
		if($stok[0]->stok_ust_grup_kayit_no != 0){
			$ust_stok = $this->Stok_model->stok_kayitlari_all(["stok_id"=>$stok[0]->stok_ust_grup_kayit_no]);
			$viewData["ust_data"] = $ust_stok[0];

		}else{
			$viewData["ust_data"] = null;

		}
		

		$viewData["page"] = "stok/stok_kayit";
        $this->load->view('base_view',$viewData); 
	}
	
	public function ust_grup_sil($stok_id = 0)
	{   
	
         if($stok_id != 0){
			$guncellenecek_stok = $this->Stok_model->stok_kayitlari_all(["stok_id"=>$stok_id])[0]; 
			if($guncellenecek_stok){
				$this->db->where("stok_id",$stok_id)->update("stoklar",["stok_ust_grup_kayit_no"=>0,"stok_islem_detay"=>($guncellenecek_stok->stok_islem_detay."<br>"."Stok tanımı silindi. Silinen stok no : ".($guncellenecek_stok->stok_ust_grup_kayit_no))]);
			}



			
		 }

		redirect(base_url("stok_tanim/index/".$stok_id));
	}


	public function cihaz_baglanti_sil($stok_id = 0)
	{   
	
         if($stok_id != 0){
			$guncellenecek_stok = $this->Stok_model->stok_kayitlari_all(["stok_id"=>$stok_id])[0]; 
			if($guncellenecek_stok){
				$this->db->where("stok_id",$stok_id)->update("stoklar",["stok_ust_grup_kayit_no"=>0,"stok_islem_detay"=>($guncellenecek_stok->stok_islem_detay."<br>"."Stok tanımı silindi. Silinen stok no : ".($guncellenecek_stok->stok_ust_grup_kayit_no))]);
			}



			
		 }

		redirect(base_url("stok_tanim/index/".$stok_id));
	}

	public function save($stok_tanim_id = 0)
	{   
	
         if($stok_tanim_id != 0){
			$s_tanim_ad = $this->input->post("stok_tanim_ad");
			if($s_tanim_ad != "" && $s_tanim_ad != null){
				$this->db->where("stok_tanim_id",$stok_tanim_id)->update("stok_tanimlari",["stok_tanim_ad"=>$s_tanim_ad]);
			}
			
		 }

		 redirect($_SERVER['HTTP_REFERER']);
	}
}