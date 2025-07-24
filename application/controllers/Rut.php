<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rut extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        date_default_timezone_set('Europe/Istanbul');
    }
 
	public function index()
	{
		yetki_kontrol("rut_haritasi_goruntule");
		$this->load->model('Sehir_model'); 
		$sehirler = $this->Sehir_model->get_all();
        $viewData["sehirler"] = $sehirler;
		$viewData["page"] = "rut/map";
		$this->load->view('base_view',$viewData);
	}

	public function rut_tanimlari()
	{
		$query = $this->db  
		->where(["rut_kullanici_id"=>aktif_kullanici()->kullanici_id])
		->select("rut_tanimlari.*,kullanicilar.*,sehirler.sehir_adi,araclar.*")
		->from('rut_tanimlari')->order_by("rut_tanimlari.rut_tanim_id","asc")
		->join('kullanicilar', 'kullanicilar.kullanici_id = rut_tanimlari.rut_kullanici_id')
		->join('sehirler', 'sehirler.sehir_id = rut_tanimlari.rut_sehir_id')
		->join('araclar', 'araclar.arac_id = rut_tanimlari.rut_arac_id','left')
		->get();
		$viewData["rut_tanimlari"] = $query->result();
		$viewData["page"] = "rut/rut_tanimlari";
		$this->load->view('base_view',$viewData);
	}

	public function form($sehir_id = 0,$rut_tanim_id = 0)
	{
		yetki_kontrol("rut_duzenle");
		$this->load->model('Talep_yonlendirme_model'); 
		 
		$filter_ids =   $this->db
		->select('MAX(talep_yonlendirmeler.talep_yonlendirme_id) as talep_yonlendirme_id', false)
		->from('talep_yonlendirmeler')
	   
		->group_by('talep_yonlendirmeler.talep_no')->get()->result_array();

		if($filter_ids){
		  $filter_data = array_column($filter_ids, 'talep_yonlendirme_id');
		}

		$this->db->where(["talepler.talep_sehir_no"=>$sehir_id,"talep_yonlendirmeler.rut_gorusmesi_mi"=>"1"]);
		$data = $this->db 
		->select("talep_yonlendirmeler.*,markalar.*,sehirler.sehir_adi,talep_sonuclar.*, talepler.*, yonlendiren.kullanici_ad_soyad AS yonlendiren_ad_soyad, yonlenen.kullanici_ad_soyad AS yonlenen_ad_soyad, GROUP_CONCAT(urunler.urun_adi) as urun_adlari")
		->from('talep_yonlendirmeler')
		->join('talepler', 'talepler.talep_id = talep_yonlendirmeler.talep_no')
		->join('markalar', 'markalar.marka_id = talepler.talep_kullanilan_cihaz_id')
		->join('kullanicilar AS yonlendiren', 'yonlendiren.kullanici_id = talep_yonlendirmeler.yonlendiren_kullanici_id')
		->join('kullanicilar AS yonlenen', 'yonlenen.kullanici_id = talep_yonlendirmeler.yonlenen_kullanici_id')
		->join('urunler', 'FIND_IN_SET(urunler.urun_id, REPLACE(REPLACE(REPLACE(talepler.talep_urun_id, \'["\', \'\'), \'"]\', \'\'), \'"\', \'\'))', 'left')
		->join('sehirler', 'sehirler.sehir_id = talepler.talep_sehir_no','left')
		->join('talep_sonuclar', 'talep_yonlendirmeler.gorusme_sonuc_no = talep_sonuclar.talep_sonuc_id')
   
		->group_by("talep_yonlendirmeler.talep_no")
		->where_in('talep_yonlendirmeler.talep_yonlendirme_id', $filter_data)
		->order_by('talep_yonlendirmeler.yonlendirme_tarihi', 'DESC')
		->get()->result(); 

		//echo json_encode($data);return;
		$this->load->model('Sehir_model'); 
		$this->load->model('Ilce_model'); 
		$sehir = $this->Sehir_model->get_all(["sehir_id"=>$sehir_id]);
        $viewData["sehir"] = $sehir[0];
		$ilceler = $this->Ilce_model->get_all(["ilceler.sehir_id"=>$sehir[0]->sehir_id]);
		$viewData["ilceler"] = $ilceler;
        $viewData["talepler"] = $data;
		$this->load->model('Kullanici_model'); 
	 
		$kullanicilar = $this->db->order_by('kullanici_adi', 'ASC')->where("kullanici_departman_id !=",19)->where(["kullanici_satisci_mi"=>1])->where(["kullanici_aktif"=>1])
        ->join('departmanlar', 'departmanlar.departman_id = kullanicilar.kullanici_departman_id')
        ->join('kullanici_gruplari', 'kullanici_gruplari.kullanici_grup_id = kullanicilar.kullanici_grup_no')
        ->get("kullanicilar")->result();
		$viewData["kullanicilar"] = $kullanicilar;

		if($rut_tanim_id != 0){
			$data = $this->db  
                    ->where(["rut_tanim_id"=>$rut_tanim_id])
                    ->select("*")
                    ->from('rut_tanimlari')
					
                    ->get()->result();
					$viewData["rut_tanim"] = $data[0];

		}else{
			$viewData["rut_tanim"] = false;
		}

		$query = $this->db  
                    ->where(["rut_sehir_id"=>$sehir_id])
                    ->select("rut_tanimlari.*,kullanicilar.*,araclar.*")
                    ->from('rut_tanimlari')->order_by("rut_tanimlari.rut_tanim_id","asc")
                    ->join('kullanicilar', 'kullanicilar.kullanici_id = rut_tanimlari.rut_kullanici_id')
					->join('araclar', 'araclar.arac_id = rut_tanimlari.rut_arac_id','left')
                    ->get();
	  $viewData["rut_tanimlari"] = $query->result();



		$viewData["page"] = "rut/form";
		$this->load->view('base_view',$viewData);
	}

	public function rut_tanimla()
	{
		yetki_kontrol("rut_duzenle");
		$this->load->model('Arac_model'); 
		$guncel_arac = $this->Arac_model->get_all_araclar(["arac_surucu_id" => $this->input->post("kullanici_id")]); 
		$arac_id = 0;
		if(count($guncel_arac) > 0){
			$arac_id = $guncel_arac[0]->arac_id;
		}
		$this->db->insert('rut_tanimlari', [
			"rut_sehir_id"=>$this->input->post("sehir_id"),
			"rut_ilce_bilgisi"=>json_encode($this->input->post("rut_ilce_id")),
			"rut_kullanici_id"=>$this->input->post("kullanici_id"),
			"rut_baslangic_tarihi"=>date('Y-m-d',strtotime($this->input->post('rut_baslangic_tarihi'))),
			"rut_bitis_tarihi"=>date('Y-m-d',strtotime($this->input->post('rut_bitis_tarihi'))),
			"rut_arac_id"=>$arac_id
		]);







		$rkul = $this->db->where("kullanici_id",$this->input->post("kullanici_id"))->get("kullanicilar")->result()[0];
		$rarac = $this->db->where("arac_id",$arac_id)->get("araclar")->result()[0];
	 
		$rilce = "";
		if(json_encode($this->input->post("rut_ilce_id")) != "[]" && json_encode($this->input->post("rut_ilce_id")) != "null" && json_encode($this->input->post("rut_ilce_id")) != null) {
	 
		  
		 $ilcelers = json_decode(json_encode($this->input->post("rut_ilce_id")));
		 $totalIlceler = count($ilcelers);
		 $ilceler = $this->db->get("ilceler")->result();
		 foreach ($ilcelers as $key => $secilen_ilce) {
		 
		   foreach ($ilceler as $ilce) {
			if($ilce->ilce_id == $secilen_ilce){
			 $rilce .= $ilce->ilce_adi;
			}
		   }
		   $count++;
		 if ($key != $totalIlceler - 1) {
			 $rilce .= ", ";
		   }
	   }
	  
	 
	   $ril = $this->db->where("sehir_id",$this->input->post("sehir_id"))->get("sehirler")->result()[0];
		
	   sendSmsData(str_replace(" ","",$rkul->kullanici_bireysel_iletisim_no),
	"Sn. $rkul->kullanici_ad_soyad, size yeni rut tanımlanması yapılmıştır. Rut detayları aşağıda yer almaktadır:\n\nBaşlangıç : ".date('d.m.Y',strtotime($this->input->post('rut_baslangic_tarihi')))
	   ."\nBitiş : ".date('d.m.Y',strtotime($this->input->post('rut_bitis_tarihi')))
	   . 
	   "\nAdres : [ ".$rilce ." ] / ". $ril->sehir_adi
	);
	    
	 }

 

		redirect(base_url("rut/form/".$this->input->post("sehir_id")));
	}
	public function rut_duzenle($rut_tanim_id)
	{
		yetki_kontrol("rut_duzenle");
		$this->db->where('rut_tanim_id', $rut_tanim_id);
		$this->db->update('rut_tanimlari', [
			"rut_kullanici_id"=>$this->input->post("kullanici_id"),
			"rut_baslangic_tarihi"=>date('Y-m-d',strtotime($this->input->post('rut_baslangic_tarihi'))),
			"rut_bitis_tarihi"=>date('Y-m-d',strtotime($this->input->post('rut_bitis_tarihi'))),
			"rut_ilce_bilgisi"=>json_encode($this->input->post("rut_ilce_id"))
		]);





		$this->load->model('Arac_model'); 
		$guncel_arac = $this->Arac_model->get_all_araclar(["arac_surucu_id" => $this->input->post("kullanici_id")]); 
		$arac_id = 0;
		if(count($guncel_arac) > 0){
			$arac_id = $guncel_arac[0]->arac_id;
		}



		$rutsehirid = $this->db->where("rut_tanim_id",$rut_tanim_id)->get("rut_tanimlari")->result()[0];
		$rkul = $this->db->where("kullanici_id",$this->input->post("kullanici_id"))->get("kullanicilar")->result()[0];
		$rarac = $this->db->where("arac_id",$arac_id)->get("araclar")->result()[0];
	 
		$rilce = "";
		if(json_encode($this->input->post("rut_ilce_id")) != "[]" && json_encode($this->input->post("rut_ilce_id")) != "null" && json_encode($this->input->post("rut_ilce_id")) != null) {
	 
		  
		 $ilcelers = json_decode(json_encode($this->input->post("rut_ilce_id")));
		 $totalIlceler = count($ilcelers);
		 $ilceler = $this->db->get("ilceler")->result();
		 foreach ($ilcelers as $key => $secilen_ilce) {
		 
		   foreach ($ilceler as $ilce) {
			if($ilce->ilce_id == $secilen_ilce){
			 $rilce .= $ilce->ilce_adi;
			}
		   }
		   $count++;
		 if ($key != $totalIlceler - 1) {
			 $rilce .= ", ";
		   }
	   }
	  
	   
	   $ril = $this->db->where("sehir_id",$rutsehirid->rut_sehir_id)->get("sehirler")->result()[0];
		
	   sendSmsData(str_replace(" ","",$rkul->kullanici_bireysel_iletisim_no),
	"DÜZENLEME BİLDİRİMİ\nSn. $rkul->kullanici_ad_soyad, tanımlanmış olan rut bilgilerinde düzenleme yapılmıştır. Rut detayları aşağıda yer almaktadır:\n\nBaşlangıç : ".date('d.m.Y',strtotime($this->input->post('rut_baslangic_tarihi')))
	   ."\nBitiş : ".date('d.m.Y',strtotime($this->input->post('rut_bitis_tarihi')))
	   . 
	   "\nAdres : [ ".$rilce ." ] / ". $ril->sehir_adi
	);
	    
	 }







		redirect(base_url("rut/form/".$this->input->post("sehir_id")));
	}
	public function rut_sil($rut_tanim_id)
	{
		yetki_kontrol("rut_duzenle");
		$this->db->where(["rut_tanim_id"=>$rut_tanim_id]);
		$this->db->delete("rut_tanimlari");
		redirect(base_url("rut/form/".$this->input->post("sehir_id")));
	}
}
