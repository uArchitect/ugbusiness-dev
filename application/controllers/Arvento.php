<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ariza extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Ariza_model');     $this->load->model('Urun_model'); 
        date_default_timezone_set('Europe/Istanbul');
    }
 
	public function index()
	{ 
		$viewData["page"] = "arvento";
		$this->load->view('base_view',$viewData);
	}
 
}
