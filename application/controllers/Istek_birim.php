<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Istek_birim extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Istek_birim_model'); 
        $this->load->model('Kullanici_model'); 
        date_default_timezone_set('Europe/Istanbul');
    }
 
	public function index()
	{
        yetki_kontrol("istek_birim_goruntule");
        $data = $this->Istek_birim_model->get_all(); 
		$viewData["istek_birimleri"] = $data;
		$viewData["page"] = "istek_birim/list";
		$this->load->view('base_view',$viewData);
	}

	public function add()
	{   
        yetki_kontrol("istek_birim_ekle");
        $kullanici_data = $this->Kullanici_model->get_all();    
        $viewData["kullanicilar"] = $kullanici_data;
		$viewData["page"] = "istek_birim/form";
		$this->load->view('base_view',$viewData);
	}

	public function edit($id = '')
	{  
        yetki_kontrol("istek_birim_duzenle");
		$check_id = $this->Istek_birim_model->get_by_id($id); 
        if($check_id){ 
            $kullanici_data = $this->Kullanici_model->get_all();    
            $viewData["kullanicilar"] = $kullanici_data; 
            $viewData['istek_birim'] = $check_id[0];
			$viewData["page"] = "istek_birim/form"; 
			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('istek_birim'));
        }
 
	}

    public function delete($id)
	{     
        yetki_kontrol("istek_birim_sil");
		$this->Istek_birim_model->delete($id);  
        $viewData["page"] = "istek_birim/list";
		$this->load->view('base_view',$viewData);
	}



	public function save($id = '')
	{   
        if(empty($id)){
            yetki_kontrol("istek_birim_ekle");
        }else{
            yetki_kontrol("istek_birim_duzenle");
        }
        $this->form_validation->set_rules('istek_birim_adi',  'Istek Birim Adı',  'required'); 
        
        $data['istek_birim_adi']  = escape($this->input->post('istek_birim_adi'));
        $data['istek_birim_aciklama']  = escape($this->input->post('istek_birim_aciklama'));
        $data['istek_birim_guncelleme_tarihi'] = date('Y-m-d H:i:s');
        $data['birim_yetkili_kullanici_id']  = escape($this->input->post('birim_yetkili_kullanici_id'));
      
        if ($this->form_validation->run() != FALSE && !empty($id)) {
            $check_id = $this->Istek_birim_model->get_by_id($id);
            if($check_id){
                unset($data['id']);
                $this->Istek_birim_model->update($id,$data);
            }
        }elseif($this->form_validation->run() != FALSE && empty($id)){
            $this->Istek_birim_model->insert($data);
        }else{
            $this->session->set_flashdata('form_errors', json_encode($this->form_validation->error_array()));
            redirect(site_url('istek_birim/ekle'));
        }
		redirect(site_url('istek_birim'));
	}
}
