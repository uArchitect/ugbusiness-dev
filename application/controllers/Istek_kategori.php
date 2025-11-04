<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Istek_kategori extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Istek_kategori_model'); 
        $this->load->model('Istek_birim_model'); 
        date_default_timezone_set('Europe/Istanbul');
    }
 
	public function index()
	{
        yetki_kontrol("istek_kategori_goruntule");
        $data = $this->Istek_kategori_model->get_all(); 
		$viewData["istek_kategorileri"] = $data;
		$viewData["page"] = "istek_kategori/list";
		$this->load->view('base_view',$viewData);
	}

	public function add()
	{   
        yetki_kontrol("istek_kategori_ekle");
         $istek_birimleri = $this->Istek_birim_model->get_all(); 
         $viewData["istek_birimleri"] = $istek_birimleri; 
		$viewData["page"] = "istek_kategori/form";
		$this->load->view('base_view',$viewData);
	}

	public function edit($id = '')
	{  
        yetki_kontrol("istek_kategori_duzenle");
		$check_id = $this->Istek_kategori_model->get_by_id($id); 
        if($check_id){  
            $istek_birimleri = $this->Istek_birim_model->get_all(); 
            $viewData["istek_birimleri"] = $istek_birimleri; 
            $viewData['istek_kategori'] = $check_id[0];
			$viewData["page"] = "istek_kategori/form"; 
			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('istek_kategori'));
        }
 
	}

    public function delete($id)
	{     
        yetki_kontrol("istek_kategori_sil");
		$this->Istek_kategori_model->delete($id);  
        $viewData["page"] = "istek_kategori/list";
		$this->load->view('base_view',$viewData);
	}



	public function save($id = '')
	{   
        if(empty($id)){
            yetki_kontrol("istek_kategori_ekle");
        }else{
            yetki_kontrol("istek_kategori_duzenle");
        }

        $this->form_validation->set_rules('istek_kategori_adi',  'Istek Kategori Adı',  'required'); 
        
        $data['istek_kategori_adi']  = escape($this->input->post('istek_kategori_adi'));
        $data['istek_kategori_aciklama']  = escape($this->input->post('istek_kategori_aciklama'));
        $data['istek_kategori_guncelleme_tarihi'] = date('Y-m-d H:i:s');
        $data['birim_id'] = escape($this->input->post('birim_id'));

        if ($this->form_validation->run() != FALSE && !empty($id)) {
            $check_id = $this->Istek_kategori_model->get_by_id($id);
            if($check_id){
                unset($data['id']);
                $this->Istek_kategori_model->update($id,$data);
            }
        }elseif($this->form_validation->run() != FALSE && empty($id)){
            $data['istek_kategori_sorumlu_kullanici_id']  = escape($this->session->userdata('aktif_kullanici_id'));
       
            $this->Istek_kategori_model->insert($data);
        }else{
            $this->session->set_flashdata('form_errors', json_encode($this->form_validation->error_array()));
            redirect(site_url('istek_kategori/ekle'));
        }
		redirect(site_url('istek_kategori'));
	}

    public function getKategoriler($birim_id)
    { 
        $data = $this->Istek_kategori_model->get_all(["birim_id"=>$birim_id]);
        echo json_encode($data);
    }
}
