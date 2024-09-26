<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Fiyat_limit extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control(); 
        date_default_timezone_set('Europe/Istanbul');
    }
 
	public function index($k_id = 0)
	{     yetki_kontrol("satis_limitlerini_yonet");
      redirect(base_url("urun"));
        if($k_id != 0){
            $this->db->where(["limit_kullanici_id"=>$k_id]);
        }
        $query = $this->db
                      ->join('kullanicilar', 'kullanicilar.kullanici_id = limit_kullanici_id')
                      ->join('urunler', 'urunler.urun_id = limit_urun_id')
                      ->get("satis_fiyat_limitleri");
        $data = $query->result();
		$viewData["limitler"] = $data;
        $viewData["kullanici_ad_soyad"] = $data[0]->kullanici_ad_soyad;
		$viewData["page"] = "kullanici/satis_limit";
		$this->load->view('base_view',$viewData);
	}

	public function add()
	{   
        yetki_kontrol("departman_ekle");
		$viewData["page"] = "departman/form";
		$this->load->view('base_view',$viewData);
	}

	public function edit($id = '')
	{  
        yetki_kontrol("departman_duzenle");
		$check_id = $this->Departman_model->get_by_id($id); 
        if($check_id){  
            $viewData['departman'] = $check_id[0];
			$viewData["page"] = "departman/form"; 
			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('departman'));
        }
 
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
            redirect(site_url('departman/ekle'));
        }
		redirect(site_url('departman'));
	}
}
