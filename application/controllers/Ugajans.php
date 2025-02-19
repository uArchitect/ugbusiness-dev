<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ugajans extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control(); 
        date_default_timezone_set('Europe/Istanbul');
    }
 
	public function index()
	{
        $viewData["page"] = "ugajans/anasayfa";
        $this->load->view('ug_ajans_base_view',$viewData);
 
    }
}