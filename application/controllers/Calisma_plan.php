<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calisma_plan extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        date_default_timezone_set('Europe/Istanbul');
    }
 
	public function index()
	{
        yetki_kontrol("calisma_plani_goruntule");
        $data = $this->db
        ->join("kullanicilar","kullanicilar.kullanici_id = calisma_plani.calisma_plani_sorumlu_kullanici_id")
        ->get("calisma_plani")
        ->result(); 
		$viewData["calisma_planlari"] = $data;
		$viewData["page"] = "calisma_plani/list";
		$this->load->view('base_view',$viewData);
	}

	public function add()
	{   
        yetki_kontrol("calisma_plan_ekle");
		$viewData["page"] = "calisma_plani/form";
		$this->load->view('base_view',$viewData);
	}

    public function is_beklemeye_al($id)
	{   
        yetki_kontrol("calisma_plan_duzenle");
        $this->db->where("calisma_plan_id",$id);
        $this->db->update("calisma_plani",["calisma_plani_durum"=>1]);
		redirect(base_url("calisma_plan"));
	}
	public function is_tamamla($id)
	{   
        yetki_kontrol("calisma_plan_duzenle");
        $this->db->where("calisma_plan_id",$id);
        $this->db->update("calisma_plani",["calisma_plani_durum"=>0]);
		redirect(base_url("calisma_plan"));
	}

	public function edit($id = '')
	{  
        yetki_kontrol("calisma_plan_duzenle");
       
		$check_id =  $this->db->where("calisma_plan_id",$id)->get("calisma_plani")->result(); 
        if($check_id[0]->calisma_plani_sorumlu_kullanici_id != aktif_kullanici()->kullanici_id){
            redirect(site_url('calisma_plan'));
        }
        if($check_id){  
            $viewData['calisma_plani'] = $check_id[0];
			$viewData["page"] = "calisma_plani/form"; 
			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('calisma_plan'));
        }
 
	}

    public function delete($id)
	{     
        yetki_kontrol("calisma_plan_sil");
        $check_id =  $this->db->where("calisma_plan_id",$id)->get("calisma_plani")->result(); 
        if($check_id[0]->calisma_plani_sorumlu_kullanici_id != aktif_kullanici()->kullanici_id){
            redirect(site_url('calisma_plan'));
        }

        $this->db->where("calisma_plan_id",$id);
        $this->db->delete("calisma_plani");
        redirect(site_url('calisma_plan'));
	}



	public function save($id = '')
	{   
        if(empty($id)){
           yetki_kontrol("calisma_plan_ekle");
        }else{
            yetki_kontrol("calisma_plan_duzenle");
        }
        $this->form_validation->set_rules('calisma_plani_baslik',  'Plan detayı',  'required'); 
        
        
        $data['calisma_plani_baslik']  = escape($this->input->post('calisma_plani_baslik'));
        $data['calisma_plani_gecerlilik_tarihi']  = escape($this->input->post('calisma_plani_gecerlilik_tarihi'));
        $data['calisma_plani_sorumlu_kullanici_id']  = aktif_kullanici()->kullanici_id;
       
        if ($this->form_validation->run() != FALSE && !empty($id)) {
            $check_id =  $this->db->where("calisma_plan_id",$id)->get("calisma_plani")->result(); 
     
            if($check_id){
                $this->db->where("calisma_plan_id",$id);
                $this->db->update("calisma_plani", $data);
            }
        }elseif($this->form_validation->run() != FALSE && empty($id)){
            $this->db->insert("calisma_plani", $data);
        }else{
            $this->session->set_flashdata('form_errors', json_encode($this->form_validation->error_array()));
            redirect(site_url('calisma_plan'));
        }
		redirect(site_url('calisma_plan'));
	}
}
