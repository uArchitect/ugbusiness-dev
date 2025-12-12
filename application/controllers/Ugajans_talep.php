<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ugajans_talep extends CI_Controller {

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
 
		 if(ugajans_aktif_kullanici()->talep_goruntuleme == 0){
			$this->session->set_flashdata('flashDanger', "Müşteri talepleri goruntuleme yetkiniz bulunmamaktadır. Sistem yöneticiniz ile iletişime geçiniz.");
			redirect($_SERVER['HTTP_REFERER']);
		}
		 
		$viewData["talepler_data"] = get_talepler();
		$viewData["page"] = "ugajansviews/talepler";
		$this->load->view('ugajansviews/base_view',$viewData);
	}

	public function yeni()
	{
		if(ugajans_aktif_kullanici()->talep_ekleme == 0){
			$this->session->set_flashdata('flashDanger', "Müşteri talepleri ekleme yetkiniz bulunmamaktadır. Sistem yöneticiniz ile iletişime geçiniz.");
			redirect(base_url("ugajans_talep"));
		}
		
		$viewData["page"] = "ugajansviews/talepler_yeni";
		$this->load->view('ugajansviews/base_view',$viewData);
	}

	public function duzenle($talep_id)
	{
		if(ugajans_aktif_kullanici()->talep_goruntuleme == 0){
			$this->session->set_flashdata('flashDanger', "Müşteri talepleri goruntuleme yetkiniz bulunmamaktadır. Sistem yöneticiniz ile iletişime geçiniz.");
			redirect(base_url("ugajans_talep"));
		}

		$talep = get_talepler(["talep_id"=>$talep_id]);
		if(count($talep) == 0){
			$this->session->set_flashdata('flashDanger', "Talep bulunamadı.");
			redirect(base_url("ugajans_talep"));
		}

		$dc = $talep[0];
		$kk = ugajans_aktif_kullanici();
		
		if($kk->ugajans_kullanici_id != $dc->talep_kaydeden_kullanici_no && $kk->talep_duzenleme == 0){
			$this->session->set_flashdata('flashDanger', "Sadece kendi taleplerinizi güncelleyebilirsiniz.");
			redirect(base_url("ugajans_talep"));
		}

		$viewData["edit_talep"] = $dc;
		$viewData["page"] = "ugajansviews/talepler_duzenle";
		$this->load->view('ugajansviews/base_view',$viewData);
	}

	public function talep_ekle()
	{
	  
		 
		 if(ugajans_aktif_kullanici()->talep_ekleme == 0){
			$this->session->set_flashdata('flashDanger', "Müşteri talepleri goruntuleme yetkiniz bulunmamaktadır. Sistem yöneticiniz ile iletişime geçiniz.");
			redirect($_SERVER['HTTP_REFERER']);
		}
		 
		 $this->db->insert("ugajans_talepler",$this->input->post());
		 $this->session->set_flashdata('flashSuccess', "Yeni talep başarıyla oluşturuldu.");
		 redirect(base_url("ugajans_talep?filter=".$this->input->post("talep_kategori_no")));
	}

	public function talep_sil($talep_id)
	{
		
		  
 if(ugajans_aktif_kullanici()->talep_silme == 0){
	$this->session->set_flashdata('flashDanger', "Müşteri talepleri silme yetkiniz bulunmamaktadır. Sistem yöneticiniz ile iletişime geçiniz.");
	redirect($_SERVER['HTTP_REFERER']);
} 

		 $this->db->where("talep_id",$talep_id)->delete("ugajans_talepler");
		 redirect(base_url("ugajans_talep"));
	}

	public function talep_guncelle($talep_id)
	{
			
		$dc = get_talepler(["talep_id"=>$talep_id])[0];
		$kk = ugajans_aktif_kullanici();
		if($kk->ugajans_kullanici_id == $dc->talep_kaydeden_kullanici_no){

		}
		else if(($kk->talep_duzenleme == 0) && ($kk->ugajans_kullanici_id != $dc->talep_kaydeden_kullanici_no)){
			$this->session->set_flashdata('flashDanger', "Sadece kendi taleplerinizi güncelleyebilirsiniz.");
				redirect($_SERVER['HTTP_REFERER']);
		}
		else{
			if($kk->talep_duzenleme == 0){

				
				$this->session->set_flashdata('flashDanger', "Müşteri talepleri düzenleme yetkiniz bulunmamaktadır. Sistem yöneticiniz ile iletişime geçiniz.");
				redirect($_SERVER['HTTP_REFERER']);
			}
		}

 
		$uData["talep_kategori_no"] = $this->input->post("talep_kategori_no");
		$uData["talep_kaynak_no"] = $this->input->post("talep_kaynak_no");
		$uData["talep_ad_soyad"] = $this->input->post("talep_ad_soyad");
		$uData["talep_iletisim_numarasi"] = $this->input->post("talep_iletisim_numarasi");
		$uData["talep_email_adresi"] = $this->input->post("talep_email_adresi");
		$uData["talep_gorusme_detaylari"] = $this->input->post("talep_gorusme_detaylari");
 
		$uData["talep_kaydeden_kullanici_no"] = $kk->ugajans_kullanici_id;
 
 


		 $this->db->where("talep_id",$talep_id)->update("ugajans_talepler",$uData);
		 $this->session->set_flashdata('flashSuccess', "Talep başarıyla güncellendi.");
		 redirect(base_url("ugajans_talep?filter=".$this->input->post("talep_kategori_no")));
	}
}
