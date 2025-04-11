<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ugajans_talep extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	 function __construct(){
        parent::__construct();
        ugajans_sess_control();
        date_default_timezone_set('Europe/Istanbul');
    }
	public function index($edit_talep_id = 0)
	{
		if($edit_talep_id != 0){
			$viewData["edit_talep"] = get_talepler(["talep_id"=>$edit_talep_id])[0];
		
		}
		$viewData["talepler_data"] = get_talepler();
		$viewData["page"] = "ugajansviews/talepler";
		$this->load->view('ugajansviews/base_view',$viewData);
	}

	public function talep_ekle()
	{
	  
		 $this->db->insert("ugajans_talepler",$this->input->post());
		 redirect(base_url("ugajans_talep?filter=".$this->input->post("talep_kategori_no")));
	}

	public function talep_sil($talep_id)
	{
		
		 


		 $this->db->where("talep_id",$talep_id)->delete("ugajans_talepler");
		 redirect(base_url("ugajans_talep"));
	}

	public function talep_guncelle($talep_id)
	{
		
		$uData["talep_kategori_no"] = $this->input->post("talep_kategori_no");
		$uData["talep_kaynak_no"] = $this->input->post("talep_kaynak_no");
		$uData["talep_ad_soyad"] = $this->input->post("talep_ad_soyad");
		$uData["talep_iletisim_numarasi"] = $this->input->post("talep_iletisim_numarasi");
		$uData["talep_email_adresi"] = $this->input->post("talep_email_adresi");
		$uData["talep_gorusme_detaylari"] = $this->input->post("talep_gorusme_detaylari");
 

 


		 $this->db->where("talep_id",$talep_id)->update("ugajans_talepler",$uData);
		 redirect(base_url("ugajans_talep?filter=".$this->input->post("talep_kategori_no")));
	}
}
