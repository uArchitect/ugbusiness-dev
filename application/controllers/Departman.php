<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departman extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Departman_model'); 
        date_default_timezone_set('Europe/Istanbul');
    }
 
	public function index()
	{
        yetki_kontrol("departman_goruntule");
        $data = $this->Departman_model->get_all(); 
		$viewData["departmanlar"] = $data;
		$viewData["page"] = "departman/list";
		$this->load->view('base_view',$viewData);
	}

	public function add()
	{   
        yetki_kontrol("departman_ekle");
        // mesai_menu_gorunum = 1 olan kullanıcıları getir
        $viewData["kullanicilar"] = $this->db->where("kullanici_aktif", 1)
            ->where("mesai_menu_gorunum", 1)
            ->order_by("kullanici_ad_soyad", "asc")
            ->get("kullanicilar")->result();
		$viewData["page"] = "departman/form";
		$this->load->view('base_view',$viewData);
	}

	public function edit($id = '')
	{  
        yetki_kontrol("departman_duzenle");
		$check_id = $this->Departman_model->get_by_id($id); 
        if($check_id){  
            $viewData['departman'] = $check_id[0];
            // mesai_menu_gorunum = 1 olan kullanıcıları getir
            $viewData["kullanicilar"] = $this->db->where("kullanici_aktif", 1)
                ->where("mesai_menu_gorunum", 1)
                ->order_by("kullanici_ad_soyad", "asc")
                ->get("kullanicilar")->result();
			$viewData["page"] = "departman/form"; 
			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('departman'));
        }
 
	}

    public function delete($id)
	{     
        yetki_kontrol("departman_sil");
		$this->Departman_model->delete($id);  
        $viewData["page"] = "departman/list";
		$this->load->view('base_view',$viewData);
	}



	public function save($id = '')
	{   
        if(empty($id)){
            yetki_kontrol("departman_ekle");
        }else{
            yetki_kontrol("departman_duzenle");
        }
        $this->form_validation->set_rules('departman_adi',  'Departman Adı',  'required'); 
        
        $data['departman_adi']  = escape($this->input->post('departman_adi'));
        $data['departman_aciklama']  = escape($this->input->post('departman_aciklama'));
        $data['departman_guncelleme_tarihi'] = date('Y-m-d H:i:s');
        
        // Yönetici atama (boş değer de gönderilebilir)
        $yonetici_id = $this->input->post('departman_yonetici_kullanici_id');
        if($yonetici_id !== null && $yonetici_id !== ''){
            $data['departman_yonetici_kullanici_id'] = escape($yonetici_id);
        } else {
            $data['departman_yonetici_kullanici_id'] = null;
        }

        if ($this->form_validation->run() != FALSE && !empty($id)) {
            $check_id = $this->Departman_model->get_by_id($id);
            if($check_id){
                unset($data['id']);
                $this->Departman_model->update($id,$data);
            }
        }elseif($this->form_validation->run() != FALSE && empty($id)){
            $data['departman_sorumlu_kullanici_id']  = escape($this->session->userdata('aktif_kullanici_id'));
            $this->Departman_model->insert($data);
        }else{
            $this->session->set_flashdata('form_errors', json_encode($this->form_validation->error_array()));
            if(!empty($id)){
                redirect(site_url('departman/edit/'.$id));
            }else{
                redirect(site_url('departman/add'));
            }
        }
		redirect(site_url('departman'));
	}
}
