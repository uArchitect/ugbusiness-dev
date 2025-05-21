<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arac extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Arac_model');   $this->load->model('Kullanici_model'); 
        date_default_timezone_set('Europe/Istanbul');
    }
 
	public function index($secilen_arac_id = 0)
	{
		if(goruntuleme_kontrol("sadece_kendi_aracini_yonet")){
			$data = $this->Arac_model->get_all_araclar(["arac_surucu_id"=>aktif_kullanici()->kullanici_id],["arac_surucu_id_2"=>aktif_kullanici()->kullanici_id]); 
			if(!$data){
				$this->session->set_flashdata('flashDanger', "Size tanımlanmış araç olmadığı için bu modülü görüntüleyemezsiniz.");
				redirect($_SERVER['HTTP_REFERER']);
			}
		}else{
			yetki_kontrol("tum_arac_goruntule");
			$data = $this->Arac_model->get_all_araclar(); 
		}
      
       
		if($secilen_arac_id != 0){
			$viewData["secilen_arac"] = $this->Arac_model->get_all_araclar(["arac_id"=>$secilen_arac_id]);
			$viewData["bakim_kayitlari"] = $this->Arac_model->get_all_bakimlar($secilen_arac_id);
			$viewData["sigorta_kayitlari"] = $this->Arac_model->get_all_sigortalar($secilen_arac_id);
			$viewData["kasko_kayitlari"] = $this->Arac_model->get_all_kaskolar($secilen_arac_id);
			$viewData["arac_kmler"] = $this->Arac_model->get_all_km($secilen_arac_id);
			$viewData["muayene_kayitlari"] = $this->Arac_model->get_all_muayeneler($secilen_arac_id);
			
		}



		$sql = "SELECT 
		a.*, 
		k.*, 
		s.*, 
		DATEDIFF(k.arac_kasko_bitis_tarihi, CURDATE()) AS kasko_kalan_gun,
		DATEDIFF(s.arac_sigorta_bitis_tarihi, CURDATE()) AS sigorta_kalan_gun
	FROM 
		araclar a
	LEFT JOIN 
		(SELECT arac_tanim_id, MAX(arac_kasko_bitis_tarihi) AS arac_kasko_bitis_tarihi FROM arac_kaskolar GROUP BY arac_tanim_id) AS k_max ON a.arac_id = k_max.arac_tanim_id
	LEFT JOIN 
		arac_kaskolar k ON k_max.arac_tanim_id = k.arac_tanim_id AND k_max.arac_kasko_bitis_tarihi = k.arac_kasko_bitis_tarihi
	LEFT JOIN 
		(SELECT arac_tanim_id, MAX(arac_sigorta_bitis_tarihi) AS arac_sigorta_bitis_tarihi FROM arac_sigortalar GROUP BY arac_tanim_id) AS s_max ON a.arac_id = s_max.arac_tanim_id
	LEFT JOIN 
		arac_sigortalar s ON s_max.arac_tanim_id = s.arac_tanim_id AND s_max.arac_sigorta_bitis_tarihi = s.arac_sigorta_bitis_tarihi

		LEFT JOIN 
		(SELECT arac_tanim_id, MAX(arac_muayene_bitis_tarihi) AS arac_muayene_bitis_tarihi FROM arac_muayeneler GROUP BY arac_tanim_id) AS m_max ON a.arac_id = m_max.arac_tanim_id
	LEFT JOIN 
		arac_muayeneler m ON m_max.arac_tanim_id = s.arac_tanim_id AND m_max.arac_muayene_bitis_tarihi = m.arac_muayene_bitis_tarihi
";

	$query = $this->db->query($sql);
	$viewData["arac_liste"] = $query->result(); 






		$viewData["kullanicilar"] = $this->db->order_by('kullanici_ad_soyad', 'ASC')->where("kullanici_departman_id !=",19)->get("kullanicilar")->result();  
		$viewData["araclar"] = $data;
		$viewData["page"] = "arac/list";
		$this->load->view('base_view',$viewData);
	}

	public function add()
	{   
        yetki_kontrol("arac_ekle");
		$viewData["page"] = "arac/form";
		$this->load->view('base_view',$viewData);
	}

	public function edit($id = '')
	{  
        yetki_kontrol("arac_duzenle");
		$check_id = $this->Arac_model->get_by_id($id); 
        if($check_id){  
            $viewData['arac'] = $check_id[0];
			$viewData["page"] = "arac/form"; 
			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('arac'));
        }
 
	}

    public function delete($id)
	{     
        yetki_kontrol("arac_sil");
		$this->Arac_model->delete($id);  
        $viewData["page"] = "arac/list";
		$this->load->view('base_view',$viewData);
	}

public function arac_lastik_kaydet($arac_id)
	{      
		$kmdata=[]; 
		$kmdata["arac_lastik_km_deger"] = $this->input->post("arac_lastik_km_deger");
		$kmdata["arac_lastik_arac_tanim_id"] = $arac_id;
		$kmdata["arac_lastik_kaydeden_kullanici_id"] = aktif_kullanici()->kullanici_id;
		$kmdata["arac_lastik_aciklama"] = $this->input->post("arac_lastik_aciklama");
		
		$this->Arac_model->add_lastik($kmdata);  

	}

	public function arac_km_kaydet($arac_id)
	{      
		$kmdata=[]; 
		$kmdata["arac_km_deger"] = $this->input->post("arac_km_deger");
		$kmdata["arac_tanim_id"] = $arac_id;
		$kmdata["arac_km_kaydeden_kullanici_id"] = aktif_kullanici()->kullanici_id;
		$kmdata["arac_km_aciklama"] = "Standart km güncelleme ekranından girilmiştir.";
		
		$this->Arac_model->add_km($kmdata);  

	}


public function arac_model_guncelle($arac_id)
	{      
		$aracdata=[]; 
		$aracdata["arac_marka"] = $this->input->post("arac_marka");
		$aracdata["arac_model"] = $this->input->post("arac_model");
		
		$this->Arac_model->update_arac($arac_id,$aracdata);  

	}






	public function sigorta_sil($sigorta_id)
	{      
		 
		$this->Arac_model->delete_sigorta($sigorta_id);  

	}
	public function bakim_sil($bakim_id)
	{      
		 
		$this->Arac_model->delete_bakim($bakim_id);  

	}
	public function kasko_sil($kasko_id)
	{      
		 
		$this->Arac_model->delete_kasko($kasko_id);  

	}
	public function muayene_sil($muayene_id)
	{      
		 
		$this->Arac_model->delete_muayene($muayene_id);  

	}



	public function arac_surucu_guncelle($arac_id)
	{      
		$aracdata=[]; 
		$aracdata["arac_surucu_id"] = $this->input->post("arac_surucu_id"); 
		
		$this->Arac_model->update_arac($arac_id,$aracdata);  

	}



	public function arac_muayene_kaydet($arac_id)
	{      
		$data=[]; 
		$data["arac_muayene_baslangic_tarihi"] = date("Y-m-d",strtotime($this->input->post("arac_muayene_baslangic_tarihi")));
		$data["arac_muayene_bitis_tarihi"] = date("Y-m-d",strtotime($this->input->post("arac_muayene_bitis_tarihi")));
		
		 
		
		$data["arac_muayene_detay"] = $this->input->post("arac_muayene_detay");
		$data["arac_tanim_id"] = $arac_id;
		$data["arac_muayene_kaydeden_kullanici_id"] = aktif_kullanici()->kullanici_id;
		
		$this->Arac_model->add_muayene($data);  



		 
	}

	public function arac_bakim_kaydet($arac_id)
	{      
		$data=[]; 
		$data["arac_bakim_baslangic_tarihi"] = date("Y-m-d",strtotime($this->input->post("arac_bakim_baslangic_tarihi")));
		$data["arac_bakim_guncel_km"] = $this->input->post("arac_bakim_guncel_km");
		$data["arac_sonraki_bakim_km"] = $this->input->post("arac_sonraki_bakim_km");
		
		
		$data["arac_bakim_detay"] = $this->input->post("arac_bakim_detay");
		$data["arac_tanim_id"] = $arac_id;
		$data["arac_bakim_kaydeden_kullanici_id"] = aktif_kullanici()->kullanici_id;
		
		$this->Arac_model->add_bakim($data);  



		$kmdata=[]; 
		$kmdata["arac_km_deger"] = $this->input->post("arac_bakim_guncel_km");
		$kmdata["arac_tanim_id"] = $arac_id;
		$kmdata["arac_km_kaydeden_kullanici_id"] = aktif_kullanici()->kullanici_id;
		$kmdata["arac_km_aciklama"] = "Bakım kaydı sırasında güncellenmiştir.";
		
		$this->Arac_model->add_km($kmdata);  

	}





	public function arac_sigorta_kaydet($arac_id)
	{      
		$data=[]; 
		$data["arac_sigorta_baslangic_tarihi"] = date("Y-m-d",strtotime($this->input->post("arac_sigorta_baslangic_tarihi")));
		$data["arac_sigorta_bitis_tarihi"] = date("Y-m-d",strtotime($this->input->post("arac_sigorta_bitis_tarihi")));
		$data["arac_sigorta_guncel_km"] = $this->input->post("arac_sigorta_guncel_km");
		$data["arac_sigorta_detay"] = $this->input->post("arac_sigorta_detay");
		$data["arac_sigorta_kaydeden_kullanici_id"] = aktif_kullanici()->kullanici_id;
		$data["arac_tanim_id"] = $arac_id;
		$this->Arac_model->add_sigorta($data);  



		$kmdata=[]; 
		$kmdata["arac_km_deger"] = $this->input->post("arac_sigorta_guncel_km");
		$kmdata["arac_tanim_id"] = $arac_id;
		$kmdata["arac_km_kaydeden_kullanici_id"] = aktif_kullanici()->kullanici_id;
		$kmdata["arac_km_aciklama"] = "Sigorta kaydı sırasında güncellenmiştir.";
		
		$this->Arac_model->add_km($kmdata);  

	}




	public function arac_kasko_kaydet($arac_id)
	{      
		$data=[]; 
		$data["arac_kasko_baslangic_tarihi"] = date("Y-m-d",strtotime($this->input->post("arac_kasko_baslangic_tarihi")));
		$data["arac_kasko_bitis_tarihi"] = date("Y-m-d",strtotime($this->input->post("arac_kasko_bitis_tarihi")));
		$data["arac_kasko_guncel_km"] = $this->input->post("arac_kasko_guncel_km");
		$data["arac_kasko_detay"] = $this->input->post("arac_kasko_detay");
		$data["arac_kasko_kaydeden_kullanici_id"] = aktif_kullanici()->kullanici_id;
		$data["arac_tanim_id"] = $arac_id;
		$this->Arac_model->add_kasko($data);  



		$kmdata=[]; 
		$kmdata["arac_km_deger"] = $this->input->post("arac_kasko_guncel_km");
		$kmdata["arac_tanim_id"] = $arac_id;
		$kmdata["arac_km_kaydeden_kullanici_id"] = aktif_kullanici()->kullanici_id;
		$kmdata["arac_km_aciklama"] = "Kasko kaydı sırasında güncellenmiştir.";
		
		$this->Arac_model->add_km($kmdata);  

	}


	public function arac_rut_km_kaydet($rut_id,$durum)
	{      

		if($durum == 0){
			$this->db->where(["rut_tanim_id"=>$rut_id]);
			$this->db->update("rut_tanimlari",["rut_satisci_baslatma_km"=>$this->input->post("arac_km_deger")]);
			
		}
		
		if($durum == 1){
			$this->db->where(["rut_tanim_id"=>$rut_id]);
			$this->db->update("rut_tanimlari",["rut_satisci_bitis_km"=>$this->input->post("arac_km_deger")]);
			
		}
		

		$query = $this->db  
		->where(["rut_tanim_id"=>$rut_id])
		->select("rut_tanimlari.*,kullanicilar.*,sehirler.sehir_adi,araclar.*")
		->from('rut_tanimlari')->order_by("rut_tanimlari.rut_tanim_id","asc")
		->join('kullanicilar', 'kullanicilar.kullanici_id = rut_tanimlari.rut_kullanici_id')
		->join('sehirler', 'sehirler.sehir_id = rut_tanimlari.rut_sehir_id')
		->join('araclar', 'araclar.arac_id = rut_tanimlari.rut_arac_id','left')
		->get()->result();

		if($query[0]->rut_arac_id != 0){
			$kmdata=[]; 
			$kmdata["arac_km_deger"] = $this->input->post("arac_km_deger");
			$kmdata["arac_tanim_id"] = $query[0]->rut_arac_id;
			$kmdata["arac_km_kaydeden_kullanici_id"] = aktif_kullanici()->kullanici_id;
			$kmdata["arac_km_aciklama"] = $query[0]->kullanici_ad_soyad." / ".$query[0]->sehir_adi." rut kaydı için km güncellemesi yapılmıştır. RUT KAYIT ID : ".$rut_id." (".($durum==0?"BAŞLANGIÇ":"BİTİŞ").")";
			
			$this->Arac_model->add_km($kmdata); 
			redirect(site_url('rut/rut_tanimlari'));
		}else{
			$this->session->set_flashdata('form_errors', 'Bu satışçı için araç tanımlası yapılmadığından dolayı km bilgisi güncellenemedi.');
            redirect(site_url('rut/rut_tanimlari'));
		}
		 

	}


	 
}
