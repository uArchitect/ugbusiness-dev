<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ugajans_anasayfa extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$viewData["page"] = "ugajansviews/anasayfa";
		$this->load->view('ugajansviews/base_view',$viewData);
	}

	public function yapilacak_is_beklemede($is_id)
	{
		$this->db->where("yapilacak_isler_id",$is_id)->update("ugajans_yapilacak_isler",["yapilacak_isler_durum"=>0]);
		redirect(base_url("ugajans_anasayfa"));
	}
	public function yapilacak_is_tamamlandi($is_id)
	{
		$this->db->where("yapilacak_isler_id",$is_id)->update("ugajans_yapilacak_isler",["yapilacak_isler_durum"=>1]);
		redirect(base_url("ugajans_anasayfa"));
	}
	
	public function duyuru_guncelle()
	{
		$this->db->where("ugajans_parameters_id",1)->update("ugajans_parameters",["ugajans_duyuru"=>$this->input->post("ugajans_duyuru")]);
		redirect(base_url("ugajans_anasayfa"));
	}
}
