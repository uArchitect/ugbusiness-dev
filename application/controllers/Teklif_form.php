<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teklif_form extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Teklif_form_model'); 
        $this->load->model('Urun_model'); 
        date_default_timezone_set('Europe/Istanbul');
    }
 
	public function index()
	{
        
        if(goruntuleme_kontrol("tum_teklif_formlarini_goruntule") == true){
            $data = $this->Teklif_form_model->get_all(); 
        }elseif(goruntuleme_kontrol("sadece_kendi_teklif_formlarini_goruntule") == true){
            $data = $this->Teklif_form_model->get_all(["teklif_form_kullanici_id"=>aktif_kullanici()->kullanici_id]); 
        }
    
		$viewData["teklif_formlari"] = $data;
		$viewData["page"] = "teklif_form/list";
		$this->load->view('base_view',$viewData);
	}

	public function add()
	{   
        yetki_kontrol("teklif_formu_ekle");
        $viewData["urunler"] = $this->Urun_model->get_all(["harici_cihaz"=>0]);
		$viewData["page"] = "teklif_form/form";
		$this->load->view('base_view',$viewData);
	}

	public function edit($id = '')
	{  
        $check_id = $this->Teklif_form_model->get_all(["teklif_form_id"=>$id]); 
       
        if(goruntuleme_kontrol("tum_teklif_formlarini_goruntule") == true){
            
        }elseif(goruntuleme_kontrol("sadece_kendi_teklif_formlarini_goruntule") == true){
           if($check_id[0]->teklif_form_kullanici_id != aktif_kullanici()->kullanici_id){
            yetki_kontrol("errorapp");
           }
        }else{
            yetki_kontrol("errorapp");
        }



		 if($check_id){  
            $viewData["urunler"] = $this->Urun_model->get_all(["harici_cihaz"=>0]);
            $viewData['teklif_form'] = $check_id[0];
			$viewData["page"] = "teklif_form/form"; 
			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('teklif_form'));
        }
 
	}


    public function yazdir($id = '')
	{  
        $check_id = $this->Teklif_form_model->get_all(["teklif_form_id"=>$id]); 
       
        if(goruntuleme_kontrol("tum_teklif_formlarini_goruntule") == true){
            
        }elseif(goruntuleme_kontrol("sadece_kendi_teklif_formlarini_goruntule") == true){
           if($check_id[0]->teklif_form_kullanici_id != aktif_kullanici()->kullanici_id){
            yetki_kontrol("errorapp");
           }
        }else{
            yetki_kontrol("errorapp");
        }


		 if($check_id){  
            $viewData['teklif_form'] = $check_id[0]; 
			$this->load->view('teklif_form/rapor/report',$viewData);
        }else{
            redirect(site_url('teklif_form'));
        }
 
	}

	public function save($id = '')
	{   
        $check_id = $this->Teklif_form_model->get_all(["teklif_form_id"=>$id]);
            
        if(empty($id)){
            yetki_kontrol("teklif_formu_ekle");
        }else{
            if(goruntuleme_kontrol("tum_teklif_formlarini_goruntule") == true){
            
        }elseif(goruntuleme_kontrol("sadece_kendi_teklif_formlarini_goruntule") == true){
           if($check_id[0]->teklif_form_kullanici_id != aktif_kullanici()->kullanici_id){
            yetki_kontrol("errorapp");
           }
        }else{
            yetki_kontrol("errorapp");
        }
        }
        $this->form_validation->set_rules('teklif_form_musteri_ad',  'Müşteri Adı',  'required'); 
        
        $data['teklif_form_musteri_ad']  = escape($this->input->post('teklif_form_musteri_ad'));
        $data['teklif_form_birinci_not']  = escape($this->input->post('teklif_form_birinci_not'));
        $data['teklif_form_ikinci_not']  = escape($this->input->post('teklif_form_ikinci_not'));
        $data['teklif_form_tarihi'] = date('Y-m-d H:i:s',strtotime($this->input->post('teklif_form_tarihi')));
      
        $data['teklif_form_urunler'] = json_encode($this->input->post('teklif_form_urunler'));
        $data['teklif_form_adetler'] = json_encode($this->input->post('teklif_form_adetler'));
        $data['teklif_form_pesinler'] = json_encode($this->input->post('teklif_form_pesinler'));
        $data['teklif_form_vadeliler'] = json_encode($this->input->post('teklif_form_vadeliler'));
        $data['teklif_form_pesinatlar'] = json_encode($this->input->post('teklif_form_pesinatlar'));
        $data['teklif_form_takas_bedelleri'] = json_encode($this->input->post('teklif_form_takaslar'));


      
        if ($this->form_validation->run() != FALSE && !empty($id)) {
            $check_id = $this->Teklif_form_model->get_all(["teklif_form_id"=>$id])[0];
            if($check_id){
                $this->Teklif_form_model->update($id,$data);
            }
        }elseif($this->form_validation->run() != FALSE && empty($id)){
            $data['teklif_form_kullanici_id']  = aktif_kullanici()->kullanici_id;
            $this->db->insert('teklif_formlari', $data);

        }else{
            $this->session->set_flashdata('form_errors', json_encode($this->form_validation->error_array()));
            redirect(site_url('teklif_form/add'));
        }
		redirect(site_url('teklif_form'));
	}
}
