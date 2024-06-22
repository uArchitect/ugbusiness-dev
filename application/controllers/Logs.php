<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs extends CI_Controller {
	function __construct(){
        parent::__construct(); 
        date_default_timezone_set('Europe/Istanbul');
        session_control();
    }
 
	public function index()
	{  
        yetki_kontrol("log_goruntule");
        $this->db->join('kullanicilar', 'kullanicilar.kullanici_id = log_kullanici_no')->select("*");
        $this->db->from("logs");
        $query = $this->db->get()->result();

        $viewData["logs"] = $query;
        $viewData["page"] = "logs/list";
		$this->load->view('base_view',$viewData);
	}

    
}
