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



        $this->db->select('
        zs.*,
        zh.*,
        d.*,
        SUM(zh.zimmet_hareket_giris_miktar) AS toplam_giris,
        SUM(zh.zimmet_hareket_cikis_miktar) AS toplam_cikis,
        (SUM(zh.zimmet_hareket_giris_miktar) - SUM(zh.zimmet_hareket_cikis_miktar)) AS kalan
    ');
    $this->db->from('zimmet_hareketler zh');
    $this->db->join('zimmet_stoklar zs', 'zh.zimmet_stok_no = zs.zimmet_stok_id', 'left');
    $this->db->join('zimmet_departmanlar d', 'zh.zimmet_departman_no = d.zimmet_departman_id', 'left');
    $this->db->group_by(['zh.zimmet_stok_no', 'zh.zimmet_departman_no']);
    $this->db->order_by('zs.zimmet_stok_adi', 'ASC');



        $viewData["hareketler"] =  $this->db->get()->result();

		$viewData["page"] = "zimmet/departman";
		$this->load->view('base_view',$viewData);
	}

	 
}
