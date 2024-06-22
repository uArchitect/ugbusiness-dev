<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Banner_model'); 
        date_default_timezone_set('Europe/Istanbul');
    }
 
	public function index()
	{
        yetki_kontrol("bannerlari_goruntule");
        $data = $this->Banner_model->get_all(); 
		$viewData["bannerlar"] = $data;
		$viewData["page"] = "banner/list";
		$this->load->view('base_view',$viewData);
	}

	public function add()
	{   
        yetki_kontrol("banner_ekle");
		$viewData["page"] = "banner/form";
		$this->load->view('base_view',$viewData);
	}

	public function edit($id = '')
	{  
        yetki_kontrol("banner_duzenle");
		$check_id = $this->Banner_model->get_by_id($id); 
        if($check_id){  
            $viewData['banner'] = $check_id[0];
			$viewData["page"] = "banner/form"; 
			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('banner'));
        }
 
	}

    public function delete($id)
	{     
        yetki_kontrol("banner_sil");
		$this->Banner_model->delete($id);  
        $viewData["page"] = "banner/list";
		$this->load->view('base_view',$viewData);
	}



	public function save($id = '')
	{   
        if(empty($id)){
            yetki_kontrol("banner_ekle");
        }else{
            yetki_kontrol("banner_duzenle");
        }
        $this->form_validation->set_rules('banner_adi',  'Banner Adı',  'required'); 
        
        
        $data['banner_adi']  = escape($this->input->post('banner_adi'));
        $data['banner_aciklama']  = escape($this->input->post('banner_aciklama'));
        $data['banner_guncelleme_tarihi'] = date('Y-m-d H:i:s');
       
        if($this->input->post('fileNames') != "" || $this->input->post('fileNames') != null){
            $data['banner_dosya'] = escape($this->input->post('fileNames'));

        }
        if ($this->form_validation->run() != FALSE && !empty($id)) {
            $check_id = $this->Banner_model->get_by_id($id);
            if($check_id){
                unset($data['id']);
                $this->Banner_model->update($id,$data);
            }
        }elseif($this->form_validation->run() != FALSE && empty($id)){
            $data['banner_sorumlu_kullanici_id']  = escape($this->session->userdata('aktif_kullanici_id'));
            $this->Banner_model->insert($data);
        }else{
            $this->session->set_flashdata('form_errors', json_encode($this->form_validation->error_array()));
            redirect(site_url('banner/ekle'));
        }
		redirect(site_url('banner'));
	}
}
