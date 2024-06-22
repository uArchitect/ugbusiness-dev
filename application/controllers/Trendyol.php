<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trendyol extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        date_default_timezone_set('Europe/Istanbul');
    }
 
	public function index($secilen_arac_id = 0)
	{
		yetki_kontrol("trendyol_hesaplama");
		$viewData["page"] = "trendyol";
		$this->load->view('base_view',$viewData);
	}

}
