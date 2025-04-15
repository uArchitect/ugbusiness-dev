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

	 function __construct(){
        parent::__construct();
        ugajans_sess_control();
        date_default_timezone_set('Europe/Istanbul');
    }

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
	public function yapilacak_is_ekle()
	{
		$insertData["yapilacak_isler_detay"] =  $this->input->post("yapilacak_isler_detay");
		$insertData["yapilacak_isler_tarih"] =  $this->input->post("yapilacak_isler_tarih");
		$insertData["yapilacak_isler_kullanici_no"] =  $this->session->userdata('ugajans_aktif_kullanici_id');
 
		$this->db->insert("ugajans_yapilacak_isler",$insertData);
	 
		redirect(base_url("ugajans_anasayfa"));
	}
	public function duyuru_guncelle()
	{
		//yetki kontrol - start
		if(ugajans_aktif_kullanici()->duyuru_guncelleme_yetki == 0){
			$this->session->set_flashdata('flashDanger', "Duyuru güncelleme yetkiniz bulunmamaktadır. Sistem yöneticiniz ile iletişime geçiniz.");
			redirect($_SERVER['HTTP_REFERER']);
		}
		//yetki kontrol - end

		$this->db->where("ugajans_parameters_id",1)->update("ugajans_parameters",["ugajans_duyuru"=>$this->input->post("ugajans_duyuru")]);
		redirect(base_url("ugajans_anasayfa"));
	}public function yapilacak_is_sil($id)
	{
		$this->db->where("yapilacak_isler_id ",$id)->delete("ugajans_yapilacak_isler");
		redirect(base_url("ugajans_anasayfa"));
	}
}
