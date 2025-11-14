<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dogum_gunu extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        date_default_timezone_set('Europe/Istanbul');
    }
 
    public function index()
	{     
        yetki_kontrol("sistem_ayar_duzenle"); 
        $viewData["page"] = "dogum_gunu/list";
		$this->load->view('base_view',$viewData);
	}
}

