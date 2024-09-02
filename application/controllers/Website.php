<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        date_default_timezone_set('Europe/Istanbul');
       
    }
	public function index()
	{  
        $viewData["page"]= "website_panel";
        $this->load->view("base_view",$viewData);
	}
}
