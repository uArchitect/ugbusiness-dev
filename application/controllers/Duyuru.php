<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Duyuru extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Duyuru_model'); 
        $this->load->model('Duyuru_kategori_model'); 
        date_default_timezone_set('Europe/Istanbul');
    }
 
	public function index()
	{
        yetki_kontrol("duyuru_goruntule");
        $data = $this->Duyuru_model->get_all(); 
		$viewData["duyurular"] = $data;
		$viewData["page"] = "duyuru/list";
		$this->load->view('base_view',$viewData);
	}
    public function boxed()
	{
        yetki_kontrol("duyuru_goruntule");
        $data = $this->Duyuru_model->get_all("duyuru_id","DESC"); 
		$viewData["duyurular"] = $data;
		$viewData["page"] = "duyuru/list_boxed";
		$this->load->view('base_view',$viewData);
	}
	public function add()
	{   
        yetki_kontrol("duyuru_ekle");
        $data = $this->Duyuru_kategori_model->get_all(); 
		$viewData["duyuru_kategorileri"] = $data;

		$viewData["page"] = "duyuru/form";
		$this->load->view('base_view',$viewData);
	}

	public function edit($id = '')
	{  
        yetki_kontrol("duyuru_duzenle");
		$check_id = $this->Duyuru_model->get_by_id($id); 
        if($check_id){  
            $data = $this->Duyuru_kategori_model->get_all(); 
		    $viewData["duyuru_kategorileri"] = $data;
        
            $viewData['duyuru'] = $check_id[0];
			$viewData["page"] = "duyuru/form"; 
			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('duyuru'));
        }
 
	}

    public function delete($id)
	{     
        yetki_kontrol("duyuru_sil");
		$this->Duyuru_model->delete($id);  
        $viewData["page"] = "duyuru/list";
		$this->load->view('base_view',$viewData);
	}



	public function save($id = '')
	{   
        if(empty($id)){
            yetki_kontrol("duyuru_ekle");
        }else{
            yetki_kontrol("duyuru_duzenle");
        }
        $this->form_validation->set_rules('duyuru_adi',  'Duyuru Adı',  'required'); 
        
        $data['duyuru_adi']  = escape($this->input->post('duyuru_adi'));
        $data['duyuru_aciklama']  = escape($this->input->post('duyuru_aciklama'));
        $data['duyuru_guncelleme_tarihi'] = date('Y-m-d H:i:s');
        $data['kategori_id'] = escape($this->input->post('kategori_id'));
        $data['duyuru_bitis_tarihi'] = escape($this->input->post('duyuru_bitis_tarihi'));

        if ($this->form_validation->run() != FALSE && !empty($id)) {
            $check_id = $this->Duyuru_model->get_by_id($id);
            if($check_id){
                unset($data['id']);
                $this->Duyuru_model->update($id,$data);
            }
        }elseif($this->form_validation->run() != FALSE && empty($id)){
            $data['duyuru_sorumlu_kullanici_id']  = escape($this->session->userdata('aktif_kullanici_id'));
       
            $this->Duyuru_model->insert($data);
        }else{
            $this->session->set_flashdata('form_errors', json_encode($this->form_validation->error_array()));
            redirect(site_url('duyuru/ekle'));
        }
		redirect(site_url('duyuru'));
	}
}
