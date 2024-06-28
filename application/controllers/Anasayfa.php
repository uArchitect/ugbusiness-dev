<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anasayfa extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Istek_model'); 
        $this->load->model('Duyuru_model'); 
        $this->load->model('Departman_model'); 
        $this->load->model('Banner_model'); 
        $this->load->model('Kullanici_model'); 
        date_default_timezone_set('Europe/Istanbul');
    }

	public function genel_arama()
	{
		$aranan_deger = $this->input->post("aranan_deger");
		

		$this->db->select('siparis_urunleri.*'); 
		$this->db->from('siparis_urunleri');
		$this->db->where('siparis_urunleri.seri_numarasi', $aranan_deger);
		$query = $this->db->get();
		if(count($query->result()) > 0){	 	 
			redirect("https://ugbusiness.com.tr/cihaz/duzenle/".$query->result()[0]->siparis_urun_id);	 
		}else{
			$this->db->select('talepler.*'); 
            $this->db->from('talepler');
            $this->db->where('talepler.talep_cep_telefon', str_replace(" ", "",$aranan_deger));
            $query = $this->db->get();
			if(count($query->result()) > 0){	 	 
				redirect("https://ugbusiness.com.tr/talep/duzenle/".$query->result()[0]->talep_id);	 
			}else{
				$this->session->set_flashdata('flashDanger', "Girmiş olduğunuz bilgilere eşleşen bir kayıt bulunamadı.");
              
				redirect($_SERVER['HTTP_REFERER']);
			 }
		}
	
			
		
	}



    public function arvento()
	{
        yetki_kontrol("arvento_goruntule");
		header("X-Frame-Options: ALLOWALL");
		$viewData["page"] = "arvento";
		$this->load->view('base_view',$viewData);
	}


	public function index()
	{
		$istekler = $this->Istek_model->get_all(); 
		$viewData["istekler"] = $istekler;

        $duyurular = $this->Duyuru_model->get_all(); 
		$viewData["duyurular"] = $duyurular;

		$kullanicilar = $this->db->order_by("rehber_sira_no","desc")->where(["rehberde_goster"=>1])
        ->join('departmanlar', 'departmanlar.departman_id = kullanicilar.kullanici_departman_id')
        ->join('kullanici_gruplari', 'kullanici_gruplari.kullanici_grup_id = kullanicilar.kullanici_grup_no')
		
        ->get("kullanicilar")->result();
 
		$viewData["kullanicilar"] = $kullanicilar;

        $bannerlar = $this->Banner_model->get_all(); 
		$viewData["bannerlar"] = $bannerlar;

        $aktif_kullanici = $this->Kullanici_model->get_by_id($this->session->userdata('aktif_kullanici_id')); 
		$viewData["aktif_kullanici"] = $aktif_kullanici[0];

        $yonetici = $this->Kullanici_model->get_by_id($aktif_kullanici[0]->kullanici_yonetici_kullanici_id); 
		$viewData["aktif_kullanici_yonetici_adi"] = "";

        $departmanlar = $this->Departman_model->get_all(); 
		$viewData["departmanlar"] = $departmanlar;

		$viewData["page"] = "anasayfa";
		$this->load->view('base_view',$viewData);
	}
}
