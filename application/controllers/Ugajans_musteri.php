<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ugajans_musteri extends CI_Controller {

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
		//yetki kontrol - start
		if(ugajans_aktif_kullanici()->musterileri_goruntuleme_yetki == 0){
			$this->session->set_flashdata('flashDanger', "Müşterileri görüntüleme yetkiniz bulunmamaktadır. Sistem yöneticiniz ile iletişime geçiniz.");
            redirect($_SERVER['HTTP_REFERER']);
		}
		//yetki kontrol - end


		$viewData["musteriler_data"] = get_musteriler();
		$viewData["page"] = "ugajansviews/musteri_liste";
		$this->load->view('ugajansviews/base_view',$viewData);
	}
	public function profil($musteri_id = 0, $subpage = "musteri_profil_dashboard", $medya_id = 0)
	{

			//yetki kontrol - start
			if(ugajans_aktif_kullanici()->musteri_profil_goruntuleme_yetki == 0){
				$this->session->set_flashdata('flashDanger', "Müşteri profilini görüntüleme yetkiniz bulunmamaktadır. Sistem yöneticiniz ile iletişime geçiniz.");
				redirect($_SERVER['HTTP_REFERER']);
			}
			//yetki kontrol - end


			if(ugajans_aktif_kullanici()->musteri_duzenleme == 0){
			//yetki kontrol - start
			if($medya_id != 0){
				if($medya_id != 0){
					$cdata = $this->db->where("sosyal_medya_hesap_id",$medya_id)->get("ugajans_sosyal_medya_hesaplar")->result();
					if($cdata->atanan_kullanici_no != $this->session->userdata('ugajans_aktif_kullanici_id')){
						$this->session->set_flashdata('flashDanger', "Sosyal medya hesabı yönetimi için bu hesaba atanmış olmanız gerekmektedir. Sistem yöneticiniz ile iletişime geçiniz.");
						redirect($_SERVER['HTTP_REFERER']);
					}
				}
			
			}
		}
			//yetki kontrol - end


		$viewData["medya_no"] = $medya_id;
		$viewData["musteri_data"] = get_musteriler(["musteri_id"=>$musteri_id])[0];
		$viewData["page"] = "ugajansviews/musteri_profil";
		$viewData["subpage"] = "ugajansviews/".$subpage;
		$this->load->view('ugajansviews/base_view',$viewData);
	}
	public function onemli_gun_ekle($musteri_id,$medya_no)
	{

		
		$insertData["onemli_gun_adi"] =  $this->input->post("onemli_gun_adi");
		$insertData["onemli_gun_tarih"] =  $this->input->post("onemli_gun_tarih");
		$insertData["alt_metin"] =  $this->input->post("alt_metin");
		$this->db->insert("ugajans_onemli_gunler",$insertData);
		redirect(base_url("ugajans_musteri/profil/$musteri_id/musteri_profil_post_yonetimi/$medya_no"));
	}	
	
	public function gorusme_kaydi_olustur($mid)
	{

			//yetki kontrol - start
			if(ugajans_aktif_kullanici()->musteri_gorusme_ekleme_yetki == 0){
				$this->session->set_flashdata('flashDanger', "Müşteri görüşme ekleme yetkiniz bulunmamaktadır. Sistem yöneticiniz ile iletişime geçiniz.");
				redirect($_SERVER['HTTP_REFERER']);
			}
			//yetki kontrol - end

		$insertData["gorusme_detay"] =  $this->input->post("gorusme_detay");
		$insertData["gorusme_musteri_no"] =  $mid;
		$insertData["gorusme_tarihi"] =  $this->input->post("gorusme_tarihi");
		$insertData["gorusme_kullanici_no"] =  $this->session->userdata('ugajans_aktif_kullanici_id');
		$this->db->insert("ugajans_gorusmeler",$insertData);
		redirect(base_url("ugajans_musteri/profil/$mid"));
	}
	public function musteri_kaydet()
	{
		//yetki kontrol - start
		if(ugajans_aktif_kullanici()->musteri_ekleme_yetki == 0){
			$this->session->set_flashdata('flashDanger', "Yeni müşteri ekleme yetkiniz bulunmamaktadır. Sistem yöneticiniz ile iletişime geçiniz.");
			redirect($_SERVER['HTTP_REFERER']);
		}
		//yetki kontrol - end

		$insertData["musteri_ad_soyad"] =  $this->input->post("musteri_ad_soyad");
		$insertData["musteri_iletisim_numarasi"] =  $this->input->post("musteri_iletisim_numarasi");
		$insertData["musteri_email_adresi"] =  $this->input->post("musteri_email_adresi");
		$this->db->insert("ugajans_musteriler",$insertData);
		redirect(base_url("ugajans_musteri"));
	}
	public function onemli_gun_tanimla($musteri_id,$medya_no, $gun_id)
	{
		$insertData["onemli_gun_tanim_sosyal_medya_no"] = $medya_no;
		$insertData["onemli_gun_tanim_musteri_no"] = $musteri_id;
		$insertData["onemli_gun_tanim_gun_no"] = $gun_id;
		$this->db->insert("ugajans_onemli_gun_tanimlari",$insertData);
		redirect(base_url("ugajans_musteri/profil/$musteri_id/musteri_profil_post_yonetimi/$medya_no"));
	}
public function musteri_sil($musteri_id)
	{
		 //yetki kontrol - start
		 if(ugajans_aktif_kullanici()->musteri_silme_yetki == 0){
			$this->session->set_flashdata('flashDanger', "Müşteri görüşme ekleme yetkiniz bulunmamaktadır. Sistem yöneticiniz ile iletişime geçiniz.");
			redirect($_SERVER['HTTP_REFERER']);
		}
		//yetki kontrol - end

		$this->db->where("musteri_id",$musteri_id)->delete("ugajans_musteriler");
		redirect(base_url("ugajans_musteri"));
	}
	
	public function gorusme_sil($musteri_id,$g_id)
	{
		 //yetki kontrol - start
		 if(ugajans_aktif_kullanici()->musteri_gorusme_silme_yetki == 0){
			$this->session->set_flashdata('flashDanger', "Müşteri görüşme silme yetkiniz bulunmamaktadır. Sistem yöneticiniz ile iletişime geçiniz.");
			redirect($_SERVER['HTTP_REFERER']);
		}
		//yetki kontrol - end


		$this->db->where("gorusme_id",$g_id)->delete("ugajans_gorusmeler");
		redirect(base_url("ugajans_musteri/profil/$musteri_id"));
	}
	public function onemli_gun_sil($musteri_id,$gun_id,$medya_no)
	{
		 
		$this->db->where("onemli_gun_id",$gun_id)->delete("ugajans_onemli_gunler");
		redirect(base_url("ugajans_musteri/profil/$musteri_id/musteri_profil_post_yonetimi/$medya_no"));
	}
public function musteri_guncelle($musteri_id)
	{ 

		 //yetki kontrol - start
		 if(ugajans_aktif_kullanici()->musteri_duzenleme == 0){
			$this->session->set_flashdata('flashDanger', "Müşteri düzenleme yetkiniz bulunmamaktadır. Sistem yöneticiniz ile iletişime geçiniz.");
			redirect($_SERVER['HTTP_REFERER']);
		}
		//yetki kontrol - end

		$updateData["musteri_ad_soyad"] =  $this->input->post("musteri_ad_soyad");
		$updateData["musteri_iletisim_numarasi"] =  $this->input->post("musteri_iletisim_numarasi");
		$updateData["musteri_email_adresi"] =  $this->input->post("musteri_email_adresi");


		$this->db->where("musteri_id",$musteri_id)->update("ugajans_musteriler",$updateData);
		redirect(base_url("ugajans_musteri/profil/$musteri_id"));
	}
public function musteri_dokuman_sil($musteri_id,$dokuman_id)
	{
		 //yetki kontrol - start
		 if(ugajans_aktif_kullanici()->musteri_dokuman_silme == 0){
			$this->session->set_flashdata('flashDanger', "Müşteri dokuman silme yetkiniz bulunmamaktadır. Sistem yöneticiniz ile iletişime geçiniz.");
			redirect($_SERVER['HTTP_REFERER']);
		}
		//yetki kontrol - end


		$this->db->where("dokuman_id",$dokuman_id)->delete("ugajans_musteri_dokumanlari");
		redirect(base_url("ugajans_musteri/profil/$musteri_id/musteri_profil_dokuman_yonetimi"));
	}


	public function onemli_gun_durum_guncelle($musteri_id, $tanim_id, $durum,$medya_no)
	{ 
		$updateData["tanim_durum"] = $durum;
		$this->db->where("onemli_gun_tanim_id",$tanim_id)->update("ugajans_onemli_gun_tanimlari",$updateData);
		redirect(base_url("ugajans_musteri/profil/$musteri_id/musteri_profil_post_yonetimi/$medya_no"));
	}
	public function onemli_gun_tanim_sil($musteri_id, $tanim_id,$medya_no)
	{  
		$this->db->where("onemli_gun_tanim_id",$tanim_id)->delete("ugajans_onemli_gun_tanimlari");
		redirect(base_url("ugajans_musteri/profil/$musteri_id/musteri_profil_post_yonetimi/$medya_no"));
	}
	
	public function musteri_isletme_sil($musteri_id, $isletme_id)
	{  


			 //yetki kontrol - start
			 if(ugajans_aktif_kullanici()->musteri_isletme_silme_yetki == 0){
				$this->session->set_flashdata('flashDanger', "Müşteri işletme silme yetkiniz bulunmamaktadır. Sistem yöneticiniz ile iletişime geçiniz.");
				redirect($_SERVER['HTTP_REFERER']);
			}
			//yetki kontrol - end


		$list = $this->db->where("isletme_musteri_no",$musteri_id)->get("ugajans_isletmeler")->result();
		if(count($list) <= 1){
			$this->session->set_flashdata('err', 'En az 1 adet işletme bilgisi zorunludur. Bu işletmeyi silmeden önce bir işletme kaydı oluşturunuz.');
			redirect(base_url("ugajans_musteri/profil/$musteri_id/musteri_profil_isletmeler"));
		}
		$this->db->where("isletme_id",$isletme_id)->delete("ugajans_isletmeler");
		redirect(base_url("ugajans_musteri/profil/$musteri_id/musteri_profil_isletmeler"));
	}
	public function sosyal_medya_ekle($musteri_id)
	{

			 //yetki kontrol - start
			 if(ugajans_aktif_kullanici()->musteri_sosyal_medya_ekleme == 0){
				$this->session->set_flashdata('flashDanger', "Müşteri sosyal medya hesabı ekleme yetkiniz bulunmamaktadır. Sistem yöneticiniz ile iletişime geçiniz.");
				redirect($_SERVER['HTTP_REFERER']);
			}
			//yetki kontrol - end



		$insertData["sosyal_medya_kategori_no"] = $this->input->post("sosyal_medya_kategori_no");
		$insertData["sosyal_medya_musteri_no"] = $musteri_id;
		$insertData["sosyal_medya_kullanici_adi"] =  $this->input->post("sosyal_medya_kullanici_adi");
		$insertData["sosyal_medya_kullanici_sifre"] = $this->input->post("sosyal_medya_kullanici_sifre");
$insertData["sosyal_medya_url"] = $this->input->post("sosyal_medya_url");

		$this->db->insert("ugajans_sosyal_medya_hesaplar",$insertData);
		redirect(base_url("ugajans_musteri/profil/$musteri_id/musteri_profil_sosyal_medya"));
	}
	public function sosyal_medya_guncelle($musteri_id,$hesap_id)
	{

		 //yetki kontrol - start
		 if(ugajans_aktif_kullanici()->musteri_sosyal_medya_duzenleme == 0){
			$this->session->set_flashdata('flashDanger', "Müşteri sosyal medya hesabı düzenleme yetkiniz bulunmamaktadır. Sistem yöneticiniz ile iletişime geçiniz.");
			redirect($_SERVER['HTTP_REFERER']);
		}
		//yetki kontrol - end


		$updateData["sosyal_medya_kategori_no"] = $this->input->post("sosyal_medya_kategori_no");
		$updateData["sosyal_medya_kullanici_adi"] =  $this->input->post("sosyal_medya_kullanici_adi");
		$updateData["sosyal_medya_kullanici_sifre"] = $this->input->post("sosyal_medya_kullanici_sifre");
		$updateData["sosyal_medya_url"] = $this->input->post("sosyal_medya_url");

		$this->db->where("sosyal_medya_hesap_id",$hesap_id)->update("ugajans_sosyal_medya_hesaplar",$updateData);
		redirect(base_url("ugajans_musteri/profil/$musteri_id/musteri_profil_sosyal_medya"));
	}
	
	public function musteri_not_guncelle($musteri_id)
	{

		 //yetki kontrol - start
		 if(ugajans_aktif_kullanici()->musteri_notu_duzenleme_yetki == 0){
			$this->session->set_flashdata('flashDanger', "Müşteri notu düzenleme yetkiniz bulunmamaktadır. Sistem yöneticiniz ile iletişime geçiniz.");
			redirect($_SERVER['HTTP_REFERER']);
		}
		//yetki kontrol - end

		$updateData["musteri_not"] = $this->input->post("musteri_not");
		 
		$this->db->where("musteri_id",$musteri_id)->update("ugajans_musteriler",$updateData);
		redirect(base_url("ugajans_musteri/profil/$musteri_id/musteri_profil_dashboard"));
	}
	public function sosyal_medya_sil($musteri_id,$hesap_id)
	{
		 //yetki kontrol - start
		 if(ugajans_aktif_kullanici()->musteri_sosyal_medya_silme == 0){
			$this->session->set_flashdata('flashDanger', "Müşteri sosyal medya hesabı silme yetkiniz bulunmamaktadır. Sistem yöneticiniz ile iletişime geçiniz.");
			redirect($_SERVER['HTTP_REFERER']);
		}
		//yetki kontrol - end
		$this->db->where("sosyal_medya_hesap_id",$hesap_id)->delete("ugajans_sosyal_medya_hesaplar");
		redirect(base_url("ugajans_musteri/profil/$musteri_id/musteri_profil_sosyal_medya"));
	}

	public function musteri_hizmet_sil($musteri_id,$tanim_id)
	{
		 //yetki kontrol - start
		 if(ugajans_aktif_kullanici()->musteri_hizmet_silme_yetki == 0){
			$this->session->set_flashdata('flashDanger', "Müşteri hizmet kaydı silme yetkiniz bulunmamaktadır. Sistem yöneticiniz ile iletişime geçiniz.");
			redirect($_SERVER['HTTP_REFERER']);
		}
		//yetki kontrol - end
		$this->db->where("musteri_hizmet_id",$tanim_id)->delete("ugajans_musteri_hizmetleri");
		redirect(base_url("ugajans_musteri/profil/$musteri_id/musteri_profil_hizmetler"));
	}
	

	public function musteri_hizmet_ekle($musteri_id)
	{
		 //yetki kontrol - start
		 if(ugajans_aktif_kullanici()->musteri_hizmet_ekleme_yetki == 0){
			$this->session->set_flashdata('flashDanger', "Müşteri hizmet ekleme yetkiniz bulunmamaktadır. Sistem yöneticiniz ile iletişime geçiniz.");
			redirect($_SERVER['HTTP_REFERER']);
		}
		//yetki kontrol - end
		$insertData["musteri_hizmet_no"] = $this->input->post("musteri_hizmet_no");
		$insertData["musteri_hizmet_musteri_no"] = $musteri_id;
		$insertData["musteri_hizmet_aciklama"] =  $this->input->post("musteri_hizmet_aciklama");
		$insertData["musteri_hizmet_kayit_tarihi"] = $this->input->post("musteri_hizmet_kayit_tarihi");

		$this->db->insert("ugajans_musteri_hizmetleri",$insertData);
		redirect(base_url("ugajans_musteri/profil/$musteri_id/musteri_profil_hizmetler"));
	}





public function musteri_tum_gunleri_ekle($musteri_id,$medya_no)
	{
		$liste = get_onemli_gunler(); 
		$onemli_gun_data = get_onemli_gun_tanimlari(["onemli_gun_tanim_sosyal_medya_no"=>$medya_no]);

		foreach ($liste as $odata) {

			$flag = 0;
			foreach ($onemli_gun_data as $od) {
			 if($od->onemli_gun_tanim_gun_no == $odata->onemli_gun_id ){
			   $flag = 1;
			   break;
			 }
			}
			if($flag == 1){
			   continue;
			}


		$insertData["onemli_gun_tanim_gun_no"] = $odata->onemli_gun_id;
		$insertData["onemli_gun_tanim_musteri_no"] = $musteri_id; 
		$insertData["onemli_gun_tanim_sosyal_medya_no"] = $medya_no;

		$this->db->insert("ugajans_onemli_gun_tanimlari",$insertData);
		
	}


	redirect(base_url("ugajans_musteri/profil/$musteri_id/musteri_profil_post_yonetimi/$medya_no"));

}
	
	public function musteri_isletme_ekle($musteri_id)
	{
		  //yetki kontrol - start
		  if(ugajans_aktif_kullanici()->musteri_isletme_ekleme_yetki == 0){
			$this->session->set_flashdata('flashDanger', "Müşteri işletme ekleme yetkiniz bulunmamaktadır. Sistem yöneticiniz ile iletişime geçiniz.");
			redirect($_SERVER['HTTP_REFERER']);
		}
		//yetki kontrol - end



		$insertData["isletme_adi"] = $this->input->post("isletme_adi");
		$insertData["isletme_musteri_no"] = $musteri_id;
		$insertData["isletme_adresi"] =  $this->input->post("isletme_adresi");
		$insertData["isletme_iletisim_numarasi"] = $this->input->post("isletme_iletisim_numarasi");

		$this->db->insert("ugajans_isletmeler",$insertData);
		redirect(base_url("ugajans_musteri/profil/$musteri_id/musteri_profil_isletmeler"));
	}

	public function musteri_isletme_guncelle($musteri_id,$isletme_id)
	{

		  //yetki kontrol - start
		  if(ugajans_aktif_kullanici()->musteri_isletme_duzenleme_yetki == 0){
			$this->session->set_flashdata('flashDanger', "Müşteri işletme düzenleme yetkiniz bulunmamaktadır. Sistem yöneticiniz ile iletişime geçiniz.");
			redirect($_SERVER['HTTP_REFERER']);
		}
		//yetki kontrol - end

		$updateData["isletme_adi"] = $this->input->post("isletme_adi");
		$updateData["isletme_adresi"] =  $this->input->post("isletme_adresi");
		$updateData["isletme_iletisim_numarasi "] = $this->input->post("isletme_iletisim_numarasi");

		$this->db->where("isletme_id ",$isletme_id)->update("ugajans_isletmeler",$updateData);
		redirect(base_url("ugajans_musteri/profil/$musteri_id/musteri_profil_isletmeler"));
	}
	public function musteri_hizmet_guncelle($musteri_id,$hizmet_id)
	{

		 //yetki kontrol - start
		 if(ugajans_aktif_kullanici()->musteri_hizmet_duzenleme_yetki == 0){
			$this->session->set_flashdata('flashDanger', "Müşteri hizmet düzenleme yetkiniz bulunmamaktadır. Sistem yöneticiniz ile iletişime geçiniz.");
			redirect($_SERVER['HTTP_REFERER']);
		}
		//yetki kontrol - end

		$updateData["musteri_hizmet_no"] = $this->input->post("musteri_hizmet_no");
		$updateData["musteri_hizmet_aciklama"] =  $this->input->post("musteri_hizmet_aciklama");
		$updateData["musteri_hizmet_kayit_tarihi"] = $this->input->post("musteri_hizmet_kayit_tarihi");

		$this->db->where("musteri_hizmet_id",$hizmet_id)->update("ugajans_musteri_hizmetleri",$updateData);
		redirect(base_url("ugajans_musteri/profil/$musteri_id/musteri_profil_hizmetler"));
	}
	function format_file_size($size) {
		if ($size >= 1048576) { // 1 MB = 1024 * 1024 byte
			return number_format($size / 1048576, 2) . ' MB';
		} else {
			return number_format($size / 1024, 2) . ' KB';
		}
	}

	public function musteri_dokuman_yukle($musteri_id)
	{
	 
		 //yetki kontrol - start
		 if(ugajans_aktif_kullanici()->musteri_dokuman_ekleme == 0){
			$this->session->set_flashdata('flashDanger', "Müşteri dokuman ekleme yetkiniz bulunmamaktadır. Sistem yöneticiniz ile iletişime geçiniz.");
			redirect($_SERVER['HTTP_REFERER']);
		}
		//yetki kontrol - end

		$config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx|xls|xlsx';
        $config['max_size']      = 5048; // 2MB
        $config['encrypt_name']  = TRUE; // Dosya adını rastgele yapar

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('dokuman_dosya')) {
            $error = array('error' => $this->upload->display_errors());
           echo json_encode($error);
        } else {
            $uploadData = $this->upload->data();
            
          
            $rastgele_path = 'uploads/' . bin2hex(random_bytes(16)) . $uploadData['file_ext'];

            
            rename($uploadData['full_path'], $rastgele_path);


		 
			if ($uploadData['file_size'] >= 1024) {  
				$sizefile = number_format($uploadData['file_size'] / 1024, 2) . ' MB';
			} else {  
				$sizefile = number_format($uploadData['file_size'], 2) . ' KB';
			}

            
            $data = array(
                'dokuman_musteri_no'     => $musteri_id,  
                'dokuman_adi'            => $this->input->post('dokuman_adi'),
                'dokuman_path'           => $rastgele_path,
                'dokuman_boyut'          => $sizefile, 
            );
			$this->db->insert("ugajans_musteri_dokumanlari",$data);
            
			redirect(base_url("ugajans_musteri/profil/$musteri_id/musteri_profil_dokuman_yonetimi"));
        }

		
	}

}
