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
        $this->load->model('Yemek_model');
		$viewData["yemek"] = $this->Yemek_model->get_by_id(date("d"))[0];


        $gorev_filter = (!isset($_GET["gorev_filter"]) ? "1" : $_GET["gorev_filter"] );
        $viewData["gorevler"] = $this->db->where("gorev_durum",$gorev_filter)->get("ug_ajans_gorevler")->result();

        $viewData["yemek"] = $this->Yemek_model->get_by_id(date("d"))[0];



        $viewData["page"] = "ugajans/anasayfa";
        $this->load->view('ug_ajans_base_view',$viewData);
 
    }
}