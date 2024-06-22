<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Demirbas_birim extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Demirbas_birim_model'); 
        $this->load->model('Kullanici_model'); 
        date_default_timezone_set('Europe/Istanbul');
    }
 
	public function index()
	{   yetki_kontrol("demirbas_birim_goruntule");
        $data = $this->Demirbas_birim_model->get_all(); 
		$viewData["demirbas_birimleri"] = $data;
		$viewData["page"] = "demirbas_birim/list";
		$this->load->view('base_view',$viewData);
	}

	public function add()
	{   
        yetki_kontrol("demirbas_birim_ekle");
        $kullanici_data = $this->Kullanici_model->get_all();    
        $viewData["kullanicilar"] = $kullanici_data;
		$viewData["page"] = "demirbas_birim/form";
		$this->load->view('base_view',$viewData);
	}

	public function edit($id = '')
	{  
        yetki_kontrol("demirbas_birim_duzenle");
		$check_id = $this->Demirbas_birim_model->get_by_id($id); 
        if($check_id){ 
            $kullanici_data = $this->Kullanici_model->get_all();    
            $viewData["kullanicilar"] = $kullanici_data; 
            $viewData['demirbas_birim'] = $check_id[0];
			$viewData["page"] = "demirbas_birim/form"; 
			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('demirbas_birim'));
        }
 
	}

    public function delete($id)
	{   
        yetki_kontrol("demirbas_birim_sil");
		$this->Demirbas_birim_model->delete($id);  
        $viewData["page"] = "demirbas_birim/list";
		$this->load->view('base_view',$viewData);
	}



	public function save($id = '')
	{   
        if(empty($id)){
            yetki_kontrol("demirbas_birim_ekle");
        }else{
            yetki_kontrol("demirbas_birim_duzenle");
        }


        $this->form_validation->set_rules('demirbas_birim_adi',  'Istek Birim Adı',  'required'); 
        
        $data['demirbas_birim_adi']  = escape($this->input->post('demirbas_birim_adi'));
        $data['demirbas_birim_aciklama']  = escape($this->input->post('demirbas_birim_aciklama'));
        $data['demirbas_birim_guncelleme_tarihi'] = date('Y-m-d H:i:s');
        
        if ($this->form_validation->run() != FALSE && !empty($id)) {
            $check_id = $this->Demirbas_birim_model->get_by_id($id);
            if($check_id){
                unset($data['id']);
                $this->Demirbas_birim_model->update($id,$data);
            }
        }elseif($this->form_validation->run() != FALSE && empty($id)){
            $this->Demirbas_birim_model->insert($data);
        }else{
            $this->session->set_flashdata('form_errors', json_encode($this->form_validation->error_array()));
            redirect(site_url('demirbas_birim/ekle'));
        }
		redirect(site_url('demirbas_birim'));
	}
}
