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
        
        $viewData["paylasim_data"] = $this->db->get("paylasim_takip")->result();

        $viewData["page"] = "paylasim/list";
		$this->load->view('base_view',$viewData);

 
	}
  
	public function update_state($kayit_id,$alan_adi,$durum)
	{
        
       $this->db->where("paylasim_takip_id",$kayit_id)->update("paylasim_takip",[$alan_adi=>$durum]);
       
       
      // $this->session->set_flashdata('flashSuccess', $alan_adi ." için paylaşım durumu güncellenmiştir.");
        
       redirect($_SERVER['HTTP_REFERER']);
  

 
	}
}
