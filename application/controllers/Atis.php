<?php

class Api extends CI_Controller {
	function __construct(){
        parent::__construct();
		
		header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
   
        date_default_timezone_set('Europe/Istanbul');
		$this->load->model('Stok_model');
    }

	
	public function atis_kontrol() {
		
		http_response_code(200);
		echo "true";
    }

 
	
	}
 