<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teslimat extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Ayar_model');  
        date_default_timezone_set('Europe/Istanbul');
    }
 
    public function index()
	{     
        yetki_kontrol("teslimat_belge_yukleme"); 
      
        $viewData["page"] = "teslimat/form";
		$this->load->view('base_view',$viewData);
	}

    
}
