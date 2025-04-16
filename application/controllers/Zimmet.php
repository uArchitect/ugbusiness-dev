<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Zimmet extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control(); 
        date_default_timezone_set('Europe/Istanbul');
    }
 
	public function index()
	{
        
        $data = $this->db->get("zimmet_stoklar")->result();
		$viewData["stoklar"] = $data;
		$viewData["page"] = "zimmet/departman";
		$this->load->view('base_view',$viewData);
	}

	 
}
