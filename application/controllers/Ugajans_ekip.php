<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ugajans_ekip extends CI_Controller {

	function __construct(){
        parent::__construct();
        ugajans_sess_control();
        date_default_timezone_set('Europe/Istanbul');
    }

	public function index()
	{
		$viewData["kullanicilar_data"] = get_kullanicilar();
		$viewData["page"] = "ugajansviews/ekip_liste";
		$this->load->view('ugajansviews/base_view',$viewData);
	}

	public function is_planlamasi()
	{
		$viewData["kullanicilar_data"] = get_kullanicilar();
		$viewData["is_planlamasi_data"] = get_is_planlamasi();
		$viewData["musteriler_data"] = get_musteriler();
		$viewData["page"] = "ugajansviews/ekip_is_planlamasi";
		$this->load->view('ugajansviews/base_view',$viewData);
	}

	public function is_planlamasi_ekle()
	{
		$insertData["kullanici_no"] = $this->input->post("kullanici_no");
		$insertData["planlama_tarihi"] = $this->input->post("planlama_tarihi");
		$insertData["planlama_tipi"] = $this->input->post("planlama_tipi");
		$insertData["is_notu"] = $this->input->post("is_notu");
		$insertData["musteri_no"] = $this->input->post("musteri_no") ? $this->input->post("musteri_no") : null;
		$insertData["yapilacak_is"] = $this->input->post("yapilacak_is") ? $this->input->post("yapilacak_is") : null;
		$insertData["planlama_durumu"] = 0;
		$insertData["olusturan_kullanici_no"] = $this->session->userdata('ugajans_aktif_kullanici_id');
		
		$this->db->insert("ugajans_is_planlamasi", $insertData);
		$this->session->set_flashdata('flashSuccess', "İş planlaması başarıyla eklendi.");
		redirect(base_url("ugajans_ekip/is_planlamasi"));
	}

	public function is_planlamasi_guncelle($is_planlamasi_id)
	{
		$updateData["planlama_tarihi"] = $this->input->post("planlama_tarihi");
		$updateData["planlama_tipi"] = $this->input->post("planlama_tipi");
		$updateData["is_notu"] = $this->input->post("is_notu");
		$updateData["musteri_no"] = $this->input->post("musteri_no") ? $this->input->post("musteri_no") : null;
		$updateData["yapilacak_is"] = $this->input->post("yapilacak_is") ? $this->input->post("yapilacak_is") : null;
		$updateData["planlama_durumu"] = $this->input->post("planlama_durumu");
		
		$this->db->where("is_planlamasi_id", $is_planlamasi_id)->update("ugajans_is_planlamasi", $updateData);
		$this->session->set_flashdata('flashSuccess', "İş planlaması başarıyla güncellendi.");
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function is_planlamasi_sil($is_planlamasi_id)
	{
		$this->db->where("is_planlamasi_id", $is_planlamasi_id)->update("ugajans_is_planlamasi", ["aktif" => 0]);
		$this->session->set_flashdata('flashSuccess', "İş planlaması başarıyla silindi.");
		redirect($_SERVER['HTTP_REFERER']);
	}
}

