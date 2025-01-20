<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Takasli_siparis extends CI_Controller {
	function __construct(){
        parent::__construct();
		$this->load->model('Siparis_model'); 
		$this->load->model('Siparis_urun_model'); 
		$this->load->model('Siparis_onay_hareket_model'); 
		$this->load->model('Urun_model'); 
		$this->load->model('Kullanici_model'); 
		$this->load->model('Kullanici_yetkileri_model'); 
		$this->load->model('Merkez_model');
        date_default_timezone_set('Europe/Istanbul');
        session_control();
    }
 
	public function index()
	{
		$viewData["urunler"] = $this->Urun_model->get_all(["harici_cihaz"=>0]);
		
		$viewData["page"] = "takasli_siparis";
		$this->load->view('base_view',$viewData);
	}
}
