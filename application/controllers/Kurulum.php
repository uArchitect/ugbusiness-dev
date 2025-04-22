<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kurulum extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control(); 
        date_default_timezone_set('Europe/Istanbul'); 
    } 

    public function index() {
        
		$this->load->view('kurulum/tarama/main_content.php', $data);
    }

    public function kurulum_list() {
        
      $query = $this->db
      ->join('siparis_urunleri', 'siparis_urunleri.siparis_urun_id  = kurulum_data.kurulum_data_siparis_urun_no')
      ->join('urunler', 'urunler.urun_id = siparis_urunleri.urun_no')
      ->get("kurulum_data");
      $viewData["kurulum_data"] = $query->result();
     
      $viewData["page"] = "kurulum/list";
      $this->load->view('base_view', $viewData);

      }
}
