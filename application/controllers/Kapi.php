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
        
		$viewData["page"] = "kapi/list";
		$this->load->view('base_view',$viewData);
	}
 
  
}
