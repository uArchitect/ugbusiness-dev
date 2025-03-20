<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sablon extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        
        date_default_timezone_set('Europe/Istanbul');
    }
 
	public function index()
	{
        $viewData["sablonlar"] = $this->db->get("sablon_kategoriler")->result();
		$viewData["page"] = "sablon";
		$this->load->view('base_view',$viewData);
	}

	 public function sablon_veri_ekle($sablon_kategori_id)
	{
        $insertData["sablon_veri_kategori_id"] = $sablon_kategori_id;
        $insertData["sablon_veri_adi"]     = $this->input->post("sablon_veri_adi");
        $this->db->insert("sablon_veriler",$insertData);
        redirect($_SERVER['HTTP_REFERER']); 
	}
}
