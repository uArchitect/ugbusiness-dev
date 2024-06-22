<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Demirbas_kategori extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Demirbas_kategori_model'); 
        date_default_timezone_set('Europe/Istanbul');
    }
 
	public function index()
	{
        yetki_kontrol("demirbas_kategori_goruntule");
        $data = $this->Demirbas_kategori_model->get_all(); 
		$viewData["demirbas_kategorileri"] = $data;
		$viewData["page"] = "demirbas_kategori/list";
		$this->load->view('base_view',$viewData);
	}

	public function add()
	{   
        yetki_kontrol("demirbas_kategori_ekle");
        $data = $this->Demirbas_kategori_model->get_all(); 
		$viewData["demirbas_kategorileri"] = $data;
		$viewData["page"] = "demirbas_kategori/form";
		$this->load->view('base_view',$viewData);
	}

	public function edit($id = '')
	{  
        yetki_kontrol("demirbas_kategori_duzenle");
		$check_id = $this->Demirbas_kategori_model->get_by_id($id); 
        if($check_id){  
            $data = $this->Demirbas_kategori_model->get_all(); 
            $viewData["demirbas_kategorileri"] = $data;
            $viewData['demirbas_kategori'] = $check_id[0];
			$viewData["page"] = "demirbas_kategori/form"; 
			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('demirbas_kategori'));
        }
 
	}

    public function delete($id)
	{   
        yetki_kontrol("demirbas_kategori_sil");  
		$this->Demirbas_kategori_model->delete($id);  
        $viewData["page"] = "demirbas_kategori/list";
		$this->load->view('base_view',$viewData);
	}



	public function save($id = '')
	{   
        if(empty($id)){
            yetki_kontrol("demirbas_kategori_ekle");
        }else{
            yetki_kontrol("demirbas_kategori_duzenle");
        }

        $this->form_validation->set_rules('demirbas_kategori_adi',  'Döküman Kategori Adı',  'required'); 
        
        $data['demirbas_kategori_adi']  = escape($this->input->post('demirbas_kategori_adi'));
        $data['demirbas_kategori_aciklama']  = escape($this->input->post('demirbas_kategori_aciklama'));
        $data['demirbas_kategori_ust_kategori_id']  = escape($this->input->post('demirbas_kategori_ust_kategori_id'));
        $data['demirbas_kategori_guncelleme_tarihi'] = date('Y-m-d H:i:s');

        if ($this->form_validation->run() != FALSE && !empty($id)) {
            $check_id = $this->Demirbas_kategori_model->get_by_id($id);
            if($check_id){
                unset($data['id']);
                $this->Demirbas_kategori_model->update($id,$data);
            }
        }elseif($this->form_validation->run() != FALSE && empty($id)){
            $data['demirbas_kategori_sorumlu_kullanici_id']  = escape($this->session->userdata('aktif_kullanici_id'));
      
            $this->Demirbas_kategori_model->insert($data);
        }else{
            $this->session->set_flashdata('form_errors', json_encode($this->form_validation->error_array()));
            redirect(site_url('demirbas_kategori/ekle'));
        }
		redirect(site_url('demirbas_kategori'));
	}
}
