<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Is_tip extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Is_tip_model'); 
        $this->load->model('Istek_kategori_model'); 
        date_default_timezone_set('Europe/Istanbul');
    }
 
	public function index()
	{
        yetki_kontrol("is_tip_goruntule");
        $data = $this->Is_tip_model->get_all(); 
		$viewData["is_tipleri"] = $data;
		$viewData["page"] = "is_tip/list";
		$this->load->view('base_view',$viewData);
	}

	public function add()
	{   
        yetki_kontrol("is_tip_ekle");
        $data = $this->Istek_kategori_model->get_all(); 
		$viewData["istek_kategorileri"] = $data;

		$viewData["page"] = "is_tip/form";
		$this->load->view('base_view',$viewData);
	}

	public function edit($id = '')
	{  
        yetki_kontrol("is_tip_duzenle");
		$check_id = $this->Is_tip_model->get_by_id($id); 
        if($check_id){  
            $data = $this->Istek_kategori_model->get_all(); 
		    $viewData["istek_kategorileri"] = $data;
        
            $viewData['is_tip'] = $check_id[0];
			$viewData["page"] = "is_tip/form"; 
			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('is_tip'));
        }
	}

    public function delete($id)
	{     
        yetki_kontrol("is_tip_sil");
		$this->Is_tip_model->delete($id);  
        $viewData["page"] = "is_tip/list";
		$this->load->view('base_view',$viewData);
	}
	public function save($id = '')
	{   
        
        if(empty($id)){
            yetki_kontrol("is_tip_ekle");
        }else{
            yetki_kontrol("is_tip_duzenle");
        }

        $this->form_validation->set_rules('is_tip_adi',  'İş Tip Adı',  'required'); 
        
        $data['is_tip_adi']  = escape($this->input->post('is_tip_adi'));
        $data['is_tip_aciklama']  = escape($this->input->post('is_tip_aciklama'));
        $data['is_tip_guncelleme_tarihi'] = date('Y-m-d H:i:s');
        $data['kategori_id'] = escape($this->input->post('kategori_id'));

        if ($this->form_validation->run() != FALSE && !empty($id)) {
            $check_id = $this->Is_tip_model->get_by_id($id);
            if($check_id){
                unset($data['id']);
                $this->Is_tip_model->update($id,$data);
            }
        }elseif($this->form_validation->run() != FALSE && empty($id)){
            $data['is_tip_sorumlu_kullanici_id']  = escape($this->session->userdata('aktif_kullanici_id'));
      
            $this->Is_tip_model->insert($data);
        }else{
            $this->session->set_flashdata('form_errors', json_encode($this->form_validation->error_array()));
            redirect(site_url('is_tip/ekle'));
        }
		redirect(site_url('is_tip'));
	}

    public function getIstipleri($birim_id)
    { 
        $data = $this->Is_tip_model->get_all(["kategori_id"=>$birim_id]);
        echo json_encode($data);
    }
}
