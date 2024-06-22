<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kullanici_yetkileri extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Kullanici_yetkileri_model'); 
        $this->load->model('Kullanici_yetki_grup_model'); 
        date_default_timezone_set('Europe/Istanbul');
    }
 
	public function index()
	{
        yetki_kontrol("kullanici_yetkilerini_goruntule");
        $data = $this->Kullanici_yetkileri_model->get_all(); 
		$viewData["kullanici_yetkileri"] = $data;
		$viewData["page"] = "kullanici_yetkileri/list";
		$this->load->view('base_view',$viewData);
	}
    public function delete($id)
	{     
        yetki_kontrol("kullanici_yetki_sil");
		$this->Kullanici_yetkileri_model->delete($id);  
        $viewData["page"] = "kullanici_yetkileri/list";
		$this->load->view('base_view',$viewData);
	}
	public function add()
	{   
        yetki_kontrol("kullanici_yetki_ekle");
        $viewData["kullanici_yetki_gruplari"] = $this->Kullanici_yetki_grup_model->get_all(); 
		$viewData["page"] = "kullanici_yetkileri/form";
		$this->load->view('base_view',$viewData);
	}

	public function edit($id = '')
	{  
        yetki_kontrol("kullanici_yetki_duzenle");
		$check_id = $this->Kullanici_yetkileri_model->get_by_id($id); 
        if($check_id){ 
            $viewData["kullanici_yetki_gruplari"] = $this->Kullanici_yetki_grup_model->get_all(); 
            $viewData['kullanici_yetki'] = $check_id[0];
			$viewData["page"] = "kullanici_yetkileri/form"; 
			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('kullanici-yetkileri'));
        }
 
	}

	public function save($id = '')
	{   
        if(empty($id)){
            yetki_kontrol("kullanici_yetki_ekle");
        }else{
            yetki_kontrol("kullanici_yetki_duzenle");
        }
        $this->form_validation->set_rules('kullanici_yetki_adi',  'Kullanıcı Yetki Adı',  'required');
        $this->form_validation->set_rules('kullanici_yetki_kodu', 'Kullanıcı Yetki Kodu', 'required'); 
        
         $data['kullanici_yetki_adi']  = escape($this->input->post('kullanici_yetki_adi'));
        $data['kullanici_yetki_kodu'] = escape($this->input->post('kullanici_yetki_kodu'));
        $data['yetki_grup_id'] = escape($this->input->post('yetki_grup_id'));
        $data['kullanici_yetki_guncelleme_tarihi'] = date('Y-m-d H:i:s');
        if ($this->form_validation->run() != FALSE && !empty($id)) {
            $check_id = $this->Kullanici_yetkileri_model->get_by_id($id);
            if($check_id){
                unset($data['id']);
                $this->Kullanici_yetkileri_model->update($id,$data);
            }
        }elseif($this->form_validation->run() != FALSE && empty($id)){
            $data['kullanici_yetki_sorumlu_kullanici_id']  = escape($this->session->userdata('aktif_kullanici_id'));
     
            $this->Kullanici_yetkileri_model->insert($data);
        }else{
            $this->session->set_flashdata('form_errors', json_encode($this->form_validation->error_array()));
            redirect(site_url('kullanici-yetkileri/ekle'));
        }
		redirect(site_url('kullanici-yetkileri'));
	}
}
