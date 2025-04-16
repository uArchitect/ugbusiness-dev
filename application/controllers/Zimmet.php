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



        $this->db->select('*');
        $this->db->from('zimmet_hareketler zh');
        $this->db->join('zimmet_stoklar zs', 'zh.zimmet_stok_no = zs.zimmet_stok_id', 'left');
        $this->db->where('zimmet_kullanici_no',0);
        $this->db->order_by('zh.zimmet_hareket_tarihi', 'DESC');
        $viewData["hareketler"] =  $this->db->get()->result();

		$viewData["page"] = "zimmet/departman";
		$this->load->view('base_view',$viewData);
	}

	 
}
