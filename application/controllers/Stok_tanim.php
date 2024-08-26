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

		 $viewData["page"] = "stok/stok_kayit";
            
            $this->load->view('base_view',$viewData); 
	}
}