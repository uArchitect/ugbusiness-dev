<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kullanici_grup extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Kullanici_grup_model'); 
        date_default_timezone_set('Europe/Istanbul');
    }
 
	public function index()
	{
        yetki_kontrol("kullanici_grup_goruntule");
        $data = $this->Kullanici_grup_model->get_all(); 
		$viewData["kullanici_gruplari"] = $data;
		$viewData["page"] = "kullanici_grup/list";
		$this->load->view('base_view',$viewData);
	}

	public function add()
	{   
        yetki_kontrol("kullanici_grup_ekle");
		$viewData["page"] = "kullanici_grup/form";
		$this->load->view('base_view',$viewData);
	}

	public function edit($id = '')
	{  
        yetki_kontrol("kullanici_grup_duzenle");
		$check_id = $this->Kullanici_grup_model->get_by_id($id); 
        if($check_id){  
            if($check_id->kullanici_grup_id <= 3){
                $this->session->set_flashdata('flashDanger', "Sisteme tanımlanan Genel Kullanıcı ve Sorumlu grupları düzenlenemez.");
                redirect(site_url('kullanici_grup'));
            }
            $viewData['kullanici_grup'] = $check_id[0];
			$viewData["page"] = "kullanici_grup/form"; 
			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('kullanici_grup'));
        }
 
	}

    public function delete($id)
	{     
        yetki_kontrol("kullanici_grup_sil");
		$this->Kullanici_grup_model->delete($id);  
        $viewData["page"] = "kullanici_grup/list";
		$this->load->view('base_view',$viewData);
	}



	public function save($id = '')
	{   
        if(empty($id)){
            yetki_kontrol("kullanici_grup_ekle");
        }else{
            yetki_kontrol("kullanici_grup_duzenle");
        }
        $this->form_validation->set_rules('kullanici_grup_adi',  'Kullanıcı Grup Adı',  'required'); 
        
        $data['kullanici_grup_adi']  = escape($this->input->post('kullanici_grup_adi'));
        $data['kullanici_grup_guncelleme_tarihi'] = date('Y-m-d H:i:s');

        if ($this->form_validation->run() != FALSE && !empty($id)) {
            $check_id = $this->Kullanici_grup_model->get_by_id($id);
            if($check_id){
                unset($data['id']);
                $this->Kullanici_grup_model->update($id,$data);
            }
        }elseif($this->form_validation->run() != FALSE && empty($id)){
            $data['kullanici_grup_sorumlu_kullanici_id']  = escape($this->session->userdata('aktif_kullanici_id'));
       
            $this->Kullanici_grup_model->insert($data);
        }else{
            $this->session->set_flashdata('form_errors', json_encode($this->form_validation->error_array()));
            redirect(site_url('kullanici_grup/ekle'));
        }
		redirect(site_url('kullanici_grup'));
	}
}
