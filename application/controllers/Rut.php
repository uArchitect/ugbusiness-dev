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
		$data = $this->Talep_yonlendirme_model->get_all(["talepler.talep_sehir_no"=>$sehir_id,"talep_yonlendirmeler.rut_gorusmesi_mi"=>"1"]); 
		//echo json_encode($data);return;
		$this->load->model('Sehir_model'); 
		$this->load->model('Ilce_model'); 
		$sehir = $this->Sehir_model->get_all(["sehir_id"=>$sehir_id]);
        $viewData["sehir"] = $sehir[0];
		$ilceler = $this->Ilce_model->get_all(["ilceler.sehir_id"=>$sehir[0]->sehir_id]);
		$viewData["ilceler"] = $ilceler;
        $viewData["talepler"] = $data;
		$this->load->model('Kullanici_model'); 
	 
		$kullanicilar = $this->db->order_by('kullanici_adi', 'ASC')->where(["kullanici_satisci_mi"=>1])
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


/*
   $rkul = $this->db->where("kullanici_id",$this->input->post("kullanici_id"))->get("kullanicilar")->result();
   $rilce = $this->db->where("ilce_id",$this->input->post("kullanici_id"))->get("kullanicilar")->result();
		
*/


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
