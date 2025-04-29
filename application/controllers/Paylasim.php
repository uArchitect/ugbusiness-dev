<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class Paylasim extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control(); 
        date_default_timezone_set('Europe/Istanbul');


        
    }
 
	public function index()
	{
         
        $viewData["page"] = "paylasim/list";
		$this->load->view('base_view',$viewData);

 
	}
  
}
