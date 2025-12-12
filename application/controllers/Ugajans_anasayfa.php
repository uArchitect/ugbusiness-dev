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

		$this->load->model('Yemek_model');
		$viewData["yemek"] = $this->Yemek_model->get_by_id(date("d"))[0];

		
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
		$insertData["atanan_kullanici_no"] =  $this->input->post("atanan_kullanici_no");
	
		$this->db->insert("ugajans_yapilacak_isler",$insertData);
	 
		redirect(base_url("ugajans_anasayfa"));
	}
	public function duyuru_guncelle()
	{ 
		if(ugajans_aktif_kullanici()->duyuru_guncelleme_yetki == 0){
			$this->session->set_flashdata('flashDanger', "Duyuru güncelleme yetkiniz bulunmamaktadır. Sistem yöneticiniz ile iletişime geçiniz.");
			redirect($_SERVER['HTTP_REFERER']);
			return;
		}
		
		$duyuru_metni = $this->input->post("ugajans_duyuru");
		
		// Duyuru güncelle
		$this->db->where("ugajans_parameters_id",1)->update("ugajans_parameters",["ugajans_duyuru"=>$duyuru_metni]);
		
		// SMS gönderimi sadece duyuru metni varsa yapılır
		if (!empty($duyuru_metni) && trim($duyuru_metni) != '') {
			// SMS mesajı hazırla
			$sms_mesaji = "UGAJANS DUYURU: " . $duyuru_metni;
			
			// UGAjans personellerine SMS gönder
			$ugajans_personeller = $this->db->select("*")->from("ugajans_kullanicilar")->get()->result();
			
			$gonderilen_sayisi = 0;
			$hata_sayisi = 0;
			
			// Tablo kolonlarını kontrol et
			$columns = $this->db->list_fields('ugajans_kullanicilar');
			
			foreach ($ugajans_personeller as $personel) {
				// Telefon numarası alanlarını kontrol et
				$telefon_no = null;
				
				// Önce telefon_numarasi alanını kontrol et (tablo yapısına göre)
				if (in_array('telefon_numarasi', $columns) && isset($personel->telefon_numarasi) && !empty($personel->telefon_numarasi)) {
					$telefon_no = $personel->telefon_numarasi;
				}
				// Alternatif alan adları
				elseif (in_array('ugajans_kullanici_telefon', $columns) && isset($personel->ugajans_kullanici_telefon) && !empty($personel->ugajans_kullanici_telefon)) {
					$telefon_no = $personel->ugajans_kullanici_telefon;
				}
				elseif (in_array('ugajans_kullanici_iletisim_numarasi', $columns) && isset($personel->ugajans_kullanici_iletisim_numarasi) && !empty($personel->ugajans_kullanici_iletisim_numarasi)) {
					$telefon_no = $personel->ugajans_kullanici_iletisim_numarasi;
				}
				elseif (isset($personel->telefon) && !empty($personel->telefon)) {
					$telefon_no = $personel->telefon;
				}
				
				if ($telefon_no) {
					// Telefon numarasını temizle (sadece rakamlar)
					$telefon_no_temiz = preg_replace('/[^0-9]/', '', $telefon_no);
					
					// Telefon numarası format kontrolü (10 veya 11 haneli olmalı)
					if (strlen($telefon_no_temiz) >= 10) {
						// 0 ile başlıyorsa kaldır, 90 ile başlamıyorsa ekle
						if (substr($telefon_no_temiz, 0, 1) == '0') {
							$telefon_no_temiz = substr($telefon_no_temiz, 1);
						}
						if (substr($telefon_no_temiz, 0, 2) != '90') {
							$telefon_no_temiz = '90' . $telefon_no_temiz;
						}
						
						try {
							// SMS gönder
							sendSmsData($telefon_no_temiz, $sms_mesaji);
							$gonderilen_sayisi++;
						} catch (Exception $e) {
							$hata_sayisi++;
							log_message('error', 'UGAjans duyuru SMS gönderme hatası (Personel ID: ' . $personel->ugajans_kullanici_id . '): ' . $e->getMessage());
						}
					} else {
						$hata_sayisi++;
					}
				}
			}
			
			// 5078928490 numarasına SMS gönder
			try {
				$ozel_numara = '905078928490'; // 90 ile başlamalı
				sendSmsData($ozel_numara, $sms_mesaji);
				$gonderilen_sayisi++;
			} catch (Exception $e) {
				$hata_sayisi++;
				log_message('error', 'UGAjans duyuru SMS gönderme hatası (Özel numara): ' . $e->getMessage());
			}
			
			// Başarı mesajı
			if ($gonderilen_sayisi > 0) {
				$this->session->set_flashdata('flashSuccess', "Duyuru güncellendi ve " . $gonderilen_sayisi . " kişiye SMS gönderildi.");
			} else {
				$this->session->set_flashdata('flashDanger', "Duyuru güncellendi ancak SMS gönderilemedi.");
			}
		} else {
			$this->session->set_flashdata('flashSuccess', "Duyuru güncellendi.");
		}
		
		redirect(base_url("ugajans_anasayfa"));
	}

	public function yapilacak_is_sil($id)
	{
		$this->db->where("yapilacak_isler_id ",$id)->delete("ugajans_yapilacak_isler");
		redirect(base_url("ugajans_anasayfa"));
	}

	public function profil()
	{
		$kullanici_id = $this->session->userdata('ugajans_aktif_kullanici_id');
		$kullanici = $this->db->where("ugajans_kullanici_id", $kullanici_id)->get("ugajans_kullanicilar")->row();
		
		$viewData["kullanici"] = $kullanici;
		$viewData["page"] = "ugajansviews/profil";
		$this->load->view('ugajansviews/base_view',$viewData);
	}

	public function profil_guncelle()
	{
		$kullanici_id = $this->session->userdata('ugajans_aktif_kullanici_id');
		
		// Kullanıcının sadece kendi profilini düzenleyebilmesi için kontrol
		if (!$kullanici_id) {
			$this->session->set_flashdata('flashDanger', "Oturum bilgisi bulunamadı.");
			redirect(base_url("ugajans_anasayfa"));
			return;
		}

		$updateData = [];

		// Ad Soyad güncelleme
		if ($this->input->post("ugajans_kullanici_ad_soyad")) {
			$updateData["ugajans_kullanici_ad_soyad"] = $this->input->post("ugajans_kullanici_ad_soyad");
		}

		// Email güncelleme (eğer alan varsa)
		$columns = $this->db->list_fields('ugajans_kullanicilar');
		if (in_array('ugajans_kullanici_email', $columns) && $this->input->post("ugajans_kullanici_email")) {
			$updateData["ugajans_kullanici_email"] = $this->input->post("ugajans_kullanici_email");
		}

		// Telefon güncelleme (eğer alan varsa)
		if (in_array('ugajans_kullanici_telefon', $columns) && $this->input->post("ugajans_kullanici_telefon")) {
			$updateData["ugajans_kullanici_telefon"] = $this->input->post("ugajans_kullanici_telefon");
		}

		// Şifre güncelleme (eğer girildiyse)
		if ($this->input->post("yeni_sifre") && $this->input->post("yeni_sifre") != "") {
			$mevcut_sifre = $this->input->post("mevcut_sifre");
			$yeni_sifre = $this->input->post("yeni_sifre");
			$yeni_sifre_tekrar = $this->input->post("yeni_sifre_tekrar");

			// Mevcut şifre kontrolü
			$kullanici = $this->db->where("ugajans_kullanici_id", $kullanici_id)->get("ugajans_kullanicilar")->row();
			if ($kullanici->ugajans_kullanici_sifre != $mevcut_sifre) {
				$this->session->set_flashdata('flashDanger', "Mevcut şifre hatalı.");
				redirect(base_url("ugajans_anasayfa/profil"));
				return;
			}

			// Yeni şifreler eşleşiyor mu kontrolü
			if ($yeni_sifre != $yeni_sifre_tekrar) {
				$this->session->set_flashdata('flashDanger', "Yeni şifreler eşleşmiyor.");
				redirect(base_url("ugajans_anasayfa/profil"));
				return;
			}

			$updateData["ugajans_kullanici_sifre"] = $yeni_sifre;
		}

		// Profil fotoğrafı yükleme
		if (!empty($_FILES['profil_fotografi']['name'])) {
			$config['upload_path'] = './uploads/ugajans_profil/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['max_size'] = 2048; // 2MB
			$config['encrypt_name'] = true;
			$config['overwrite'] = false;

			// Klasör yoksa oluştur
			if (!is_dir($config['upload_path'])) {
				mkdir($config['upload_path'], 0777, true);
			}

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('profil_fotografi')) {
				$upload_data = $this->upload->data();
				$updateData["ugajans_kullanici_gorsel"] = 'uploads/ugajans_profil/' . $upload_data['file_name'];

				// Eski fotoğrafı sil (varsa)
				$eski_kullanici = $this->db->where("ugajans_kullanici_id", $kullanici_id)->get("ugajans_kullanicilar")->row();
				if ($eski_kullanici && $eski_kullanici->ugajans_kullanici_gorsel && file_exists(FCPATH . $eski_kullanici->ugajans_kullanici_gorsel)) {
					@unlink(FCPATH . $eski_kullanici->ugajans_kullanici_gorsel);
				}
			} else {
				$error = $this->upload->display_errors('', '');
				$this->session->set_flashdata('flashDanger', "Fotoğraf yükleme hatası: " . $error);
				redirect(base_url("ugajans_anasayfa/profil"));
				return;
			}
		}

		// Veritabanını güncelle
		if (!empty($updateData)) {
			$this->db->where("ugajans_kullanici_id", $kullanici_id)->update("ugajans_kullanicilar", $updateData);
			$this->session->set_flashdata('flashSuccess', "Profil bilgileriniz başarıyla güncellendi.");
		} else {
			$this->session->set_flashdata('flashDanger', "Güncellenecek bilgi bulunamadı.");
		}

		redirect(base_url("ugajans_anasayfa/profil"));
	}
}
