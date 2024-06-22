<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sehir extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Sehir_model'); 
        $this->load->model('Ilce_model'); 
        date_default_timezone_set('Europe/Istanbul');
    }
 
	public function index()
	{
        yetki_kontrol("il_ilce_kayit_goruntule");
        $data_sehir = $this->Sehir_model->get_all(); 
        $data_ilce = $this->Ilce_model->get_all(); 
		$viewData["sehirler"] = $data_sehir;
        $viewData["ilceler"] = $data_ilce;
		$viewData["page"] = "sehir/list";
		$this->load->view('base_view',$viewData);
	}

	public function add()
	{   
        yetki_kontrol("il_ilce_kayit_ekle");
		$viewData["page"] = "sehir/form";
		$this->load->view('base_view',$viewData);
	}

	public function edit($id = '')
	{  
        yetki_kontrol("il_ilce_kayit_duzenle");
		$check_id = $this->Sehir_model->get_by_id($id); 
        if($check_id){  
            $viewData['sehir'] = $check_id[0];
			$viewData["page"] = "sehir/form"; 
			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('sehir'));
        }
 
	}

    public function delete($id)
	{     
        yetki_kontrol("il_ilce_kayit_sil");
		$this->Sehir_model->delete($id);  
        $viewData["page"] = "sehir/list";
		$this->load->view('base_view',$viewData);
	}



	public function save($id = '')
	{   

        if(empty($id)){
            yetki_kontrol("il_ilce_kayit_ekle");
        }else{
            yetki_kontrol("il_ilce_kayit_duzenle");
        }


        $this->form_validation->set_rules('sehir_adi',  'Şehir Adı',  'required'); 
         
        $data['sehir_adi']  = escape($this->input->post('sehir_adi'));  

        if ($this->form_validation->run() != FALSE && !empty($id)) {
            $check_id = $this->Sehir_model->get_by_id($id);
            if($check_id){
                unset($data['id']);
                $this->Sehir_model->update($id,$data);
            }
        }elseif($this->form_validation->run() != FALSE && empty($id)){
            $this->Sehir_model->insert($data);
        }else{
            $this->session->set_flashdata('form_errors', json_encode($this->form_validation->error_array()));
            redirect(site_url('sehir/ekle'));
        }
		redirect(site_url('sehir'));
	}
}
