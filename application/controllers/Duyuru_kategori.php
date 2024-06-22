<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Duyuru_kategori extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Duyuru_kategori_model'); 
        date_default_timezone_set('Europe/Istanbul');
    }
 
	public function index()
	{
        yetki_kontrol("duyuru_kategori_goruntule");
        $data = $this->Duyuru_kategori_model->get_all(); 
		$viewData["duyuru_kategorileri"] = $data;
		$viewData["page"] = "duyuru_kategori/list";
		$this->load->view('base_view',$viewData);
	}

	public function add()
	{   
        yetki_kontrol("duyuru_kategori_ekle");
        $data = $this->Duyuru_kategori_model->get_all(); 
		$viewData["duyuru_kategorileri"] = $data;
		$viewData["page"] = "duyuru_kategori/form";
		$this->load->view('base_view',$viewData);
	}

	public function edit($id = '')
	{  
        yetki_kontrol("duyuru_kategori_duzenle");
		$check_id = $this->Duyuru_kategori_model->get_by_id($id); 
        if($check_id){  
            $data = $this->Duyuru_kategori_model->get_all(); 
            $viewData["duyuru_kategorileri"] = $data;
            $viewData['duyuru_kategori'] = $check_id[0];
			$viewData["page"] = "duyuru_kategori/form"; 
			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('duyuru_kategori'));
        }
 
	}

    public function delete($id)
	{     
        yetki_kontrol("duyuru_kategori_sil");
		$this->Duyuru_kategori_model->delete($id);  
        $viewData["page"] = "duyuru_kategori/list";
		$this->load->view('base_view',$viewData);
	}



	public function save($id = '')
	{   
        if(empty($id)){
            yetki_kontrol("duyuru_kategori_ekle");
        }else{
            yetki_kontrol("duyuru_kategori_duzenle");
        }
        $this->form_validation->set_rules('duyuru_kategori_adi',  'Döküman Kategori Adı',  'required'); 
        
         $data['duyuru_kategori_adi']  = escape($this->input->post('duyuru_kategori_adi'));
        $data['duyuru_kategori_aciklama']  = escape($this->input->post('duyuru_kategori_aciklama'));
        $data['duyuru_kategori_guncelleme_tarihi'] = date('Y-m-d H:i:s');

        if ($this->form_validation->run() != FALSE && !empty($id)) {
            $check_id = $this->Duyuru_kategori_model->get_by_id($id);
            if($check_id){
                unset($data['id']);
                $this->Duyuru_kategori_model->update($id,$data);
            }
        }elseif($this->form_validation->run() != FALSE && empty($id)){
            $data['duyuru_kategori_sorumlu_kullanici_id']  = escape($this->session->userdata('aktif_kullanici_id'));
     
            $this->Duyuru_kategori_model->insert($data);
        }else{
            $this->session->set_flashdata('form_errors', json_encode($this->form_validation->error_array()));
            redirect(site_url('duyuru_kategori/ekle'));
        }
		redirect(site_url('duyuru_kategori'));
	}
}
