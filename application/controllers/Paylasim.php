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

    public function paylasim_sil($id)
{
    $this->db->where("paylasim_takip_id", $id);
    $this->db->delete("paylasim_takip");
}


    public function paylasim_guncelle($id)
    {
        $update_data = [];
        $update_data["paylasim_adi"] = $this->input->post("paylasim_adi");
        $update_data["paylasim_tarihi"] = $this->input->post("paylasim_tarihi");
    
        $this->db->where("paylasim_takip_id", $id);
        $this->db->update("paylasim_takip", $update_data);
    }
    

    public function paylasim_kaydet()
	{      
		$insert_data=[]; 
		$insert_data["paylasim_adi"] = $this->input->post("paylasim_adi");
		$insert_data["paylasim_tarihi"] =  $this->input->post("paylasim_tarihi");
		
		$this->db->insert("paylasim_takip",$insert_data);

	}
}
