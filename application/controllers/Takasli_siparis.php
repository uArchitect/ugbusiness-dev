<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Takasli_siparis extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
    }
 
	public function index()
	{
		$viewData["page"] = "takasli_siparis";
		$this->load->view('base_view',$viewData);
	}
}
