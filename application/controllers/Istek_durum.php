<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Istek_durum extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Istek_durum_model'); 
        date_default_timezone_set('Europe/Istanbul');
    }
 
	public function index()
	{
        yetki_kontrol("istek_durum_goruntule");
        $data = $this->Istek_durum_model->get_all(); 
		$viewData["istek_durumlari"] = $data;
		$viewData["page"] = "Istek_durum/list";
		$this->load->view('base_view',$viewData);
	}

	public function add()
	{   
        yetki_kontrol("istek_durum_ekle");
		$viewData["page"] = "Istek_durum/form";
		$this->load->view('base_view',$viewData);
	}

	public function edit($id = '')
	{  
        yetki_kontrol("istek_durum_duzenle");
		$check_id = $this->Istek_durum_model->get_by_id($id); 
        if($check_id){  
            $viewData['istek_durum'] = $check_id[0];
			$viewData["page"] = "Istek_durum/form"; 
			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('istek_durum'));
        }
 
	}

    public function delete($id)
	{     
        yetki_kontrol("istek_durum_sil");
		$this->Istek_durum_model->delete($id);  
        $viewData["page"] = "istek_durum/list";
		$this->load->view('base_view',$viewData);
	}



	public function save($id = '')
	{   
        if(empty($id)){
            yetki_kontrol("istek_durum_ekle");
        }else{
            yetki_kontrol("istek_durum_duzenle");
        }

        $this->form_validation->set_rules('istek_durum_adi',  'Departman Adı',  'required'); 
        
        $data['istek_durum_adi']  = escape($this->input->post('istek_durum_adi'));
        $data['istek_durum_aciklama']  = escape($this->input->post('istek_durum_aciklama'));
        $data['istek_durum_guncelleme_tarihi'] = date('Y-m-d H:i:s');
        $data['istek_durum_renk'] = escape($this->input->post('istek_durum_renk'));
       
        if ($this->form_validation->run() != FALSE && !empty($id)) {
            $check_id = $this->Istek_durum_model->get_by_id($id);
            if($check_id){
                unset($data['id']);
                $this->Istek_durum_model->update($id,$data);
            }
        }elseif($this->form_validation->run() != FALSE && empty($id)){
            $data['istek_durum_sorumlu_kullanici_id']  = escape($this->session->userdata('aktif_kullanici_id'));
      
            $this->Istek_durum_model->insert($data);
        }else{
            $this->session->set_flashdata('form_errors', json_encode($this->form_validation->error_array()));
            redirect(site_url('istek_durum/ekle'));
        }
		redirect(site_url('istek_durum'));
	}
}
