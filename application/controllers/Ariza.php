<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ariza extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Ariza_model');     $this->load->model('Urun_model'); 
        date_default_timezone_set('Europe/Istanbul');
    }
 
	public function index()
	{
        yetki_kontrol("ariza_goruntule");
        $data                 = $this->Ariza_model->get_all(); 
		$viewData["arizalar"] = $data;
		$viewData["page"]     = "ariza/list";
		$this->load->view('base_view',$viewData);
	}

	public function add()
	{   
        yetki_kontrol("ariza_ekle");
        $viewData['baslik_tanimlari'] = $this->Urun_model->get_basliklar(); 
		$viewData["page"]             = "ariza/form";
		$this->load->view('base_view',$viewData);
	}

	public function edit($id = '')
	{  
        yetki_kontrol("ariza_duzenle");
		$check_id = $this->Ariza_model->get_by_id($id); 
        if($check_id){  
            $viewData['ariza']            = $check_id[0];
            $viewData['baslik_tanimlari'] = $this->Urun_model->get_basliklar(); 
			$viewData["page"]             = "ariza/form"; 
			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('ariza'));
        }
 
	}

    public function delete($id)
	{     
        yetki_kontrol("ariza_sil");
		$this->Ariza_model->delete($id);  
        redirect(site_url('ariza'));
	}

	public function save($id = '')
	{   
        if(empty($id)){
            yetki_kontrol("ariza_ekle");
        }else{
            yetki_kontrol("ariza_duzenle");
        }
        $this->form_validation->set_rules('urun_baslik_ariza_adi',  'Arıza Adı',  'required');   
        $data['urun_baslik_ariza_adi']  = escape($this->input->post('urun_baslik_ariza_adi'));
        $data['urun_baslik_tanim_no']  = escape($this->input->post('urun_baslik_tanim_no'));
        if ($this->form_validation->run() != FALSE && !empty($id)) {
            $check_id = $this->Ariza_model->get_by_id($id);
            if($check_id){
                $this->Ariza_model->update($id,$data);
            }
        }elseif($this->form_validation->run() != FALSE && empty($id)){
            $this->Ariza_model->insert($data);
        }else{
            $this->session->set_flashdata('form_errors', json_encode($this->form_validation->error_array()));
            redirect(site_url('ariza/save'));
        }
		redirect(site_url('ariza'));
	}
}
