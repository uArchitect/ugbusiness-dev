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
        
      $viewData["page"] = "kurulum/list";
      $this->load->view('base_view', $viewData);
      }
}
