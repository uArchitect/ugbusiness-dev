<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Demirbas extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Demirbas_model'); 
        $this->load->model('Demirbas_kategori_model'); 
        $this->load->model('Demirbas_birim_model'); 
        $this->load->model('Kullanici_model');
        $this->load->model('Demirbas_islem_model');  
        date_default_timezone_set('Europe/Istanbul');
    }
 
	public function index($birim = 0)
    { 
            
        yetki_kontrol("demirbas_goruntule");

            if($birim != 0){
                 $data = $this->Demirbas_model->get_all(["demirbas_birim_no"=>$birim]); 
                 $viewData["kategori_kontrol"] = true;
            }else{
                $data = $this->Demirbas_model->get_all(); 
            }
      
		$viewData["demirbaslar"] = $data;
		$viewData["page"] = "demirbas/list";
		$this->load->view('base_view',$viewData);
	}

	public function add()
	{   
        yetki_kontrol("demirbas_ekle");
        $demirbas_birimleri_data = $this->Demirbas_birim_model->get_all(); 
		$viewData["demirbas_birimleri"] = $demirbas_birimleri_data;

        $data = $this->Demirbas_kategori_model->get_all(); 
		$viewData["demirbas_kategorileri"] = $data;
        
        $kullanici_data = $this->Kullanici_model->get_all();    
        $viewData["kullanicilar"] = $kullanici_data;

		$viewData["page"] = "demirbas/form";
		$this->load->view('base_view',$viewData);
	}

	public function edit($id = '')
	{  
        yetki_kontrol("demirbas_duzenle");
		$check_id = $this->Demirbas_model->get_by_id($id); 
        if($check_id){  
            $demirbas_birimleri_data = $this->Demirbas_birim_model->get_all(); 
            $viewData["demirbas_birimleri"] = $demirbas_birimleri_data;

            $data = $this->Demirbas_kategori_model->get_all(); 
		    $viewData["demirbas_kategorileri"] = $data;
            
            $kullanici_data = $this->Kullanici_model->get_all();    
            $viewData["kullanicilar"] = $kullanici_data;

             
            $islem_data = $this->Demirbas_islem_model->get_all(["islem_demirbas_no"=>$id]);    
            $viewData["demirbas_islemleri"] = $islem_data;

            $viewData['demirbas'] = $check_id[0];
			$viewData["page"] = "demirbas/form"; 
			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('demirbas'));
        }
 
	}

    public function delete($id)
	{    
        yetki_kontrol("demirbas_sil"); 
		$this->Demirbas_model->delete($id);  
        $viewData["page"] = "demirbas/list";
		$this->load->view('base_view',$viewData);
	}

    public function delete_action($demirbas_id,$id)
	{   
        yetki_kontrol("demirbas_islem_sil"); 
		$this->Demirbas_islem_model->delete($id);  
        redirect(base_url("demirbas/duzenle/$demirbas_id"));
	}


    public function save_action($id = '')
	{   
        
        yetki_kontrol("demirbas_islem_kayit_ekle");
       

        $data['islem_sorumlu_kullanici_id'] = escape($this->session->userdata('aktif_kullanici_id'));
        $data['islem_aciklama']             = escape($this->input->post('islem_aciklama'));
        $data['islem_demirbas_no']          = $id;
        $this->Demirbas_islem_model->insert($data);
		redirect(site_url('demirbas/duzenle/').$id);
	}




	public function save($id = '')
	{   
        if(empty($id)){
            yetki_kontrol("demirbas_ekle");
        }else{
            yetki_kontrol("demirbas_duzenle");
        }
        
        $this->form_validation->set_rules('demirbas_adi',  'Demirbaş Adı',  'required'); 
        
        $data['kategori_id']                    = escape($this->input->post('kategori_id'));
        $data['demirbas_adi']                   = escape($this->input->post('demirbas_adi'));
        $data['demirbas_aciklama']              = escape($this->input->post('demirbas_aciklama'));
        $data['demirbas_guncelleme_tarihi']     = date('Y-m-d H:i:s');
        $data['demirbas_marka']                 = escape($this->input->post('demirbas_marka'));
        $data['demirbas_model']                 = escape($this->input->post('demirbas_model'));
        $data['demirbas_seri_numarasi']         = escape($this->input->post('demirbas_seri_numarasi'));
        $data['demirbas_birim_no']              = escape($this->input->post('demirbas_birim_no'));
        $data['demirbas_islemci']               = escape($this->input->post('demirbas_islemci'));
        $data['demirbas_ram']                   = escape($this->input->post('demirbas_ram'));
        $data['demirbas_disk']                  = escape($this->input->post('demirbas_disk'));
        $data['demirbas_kullanici_id']          = escape($this->input->post('demirbas_kullanici_id'));
        $data['demirbas_pin_kodu']          = escape($this->input->post('demirbas_pin_kodu'));
        $data['demirbas_puk_kodu']          = escape($this->input->post('demirbas_puk_kodu'));
       
        if($this->input->post('demirbas_garanti_tarihi') != null){
            $data['demirbas_garanti_tarihi']          = escape(date('Y-m-d H:i:s',strtotime($this->input->post('demirbas_garanti_tarihi'))));
       
        }
        
         $data['demirbas_telefon_numarasi']          = escape($this->input->post('demirbas_telefon_numarasi'));
        
        
        if($this->input->post('fileNames')!= null){
            $data['demirbas_dosya_adi']  =  escape($this->input->post('fileNames'));  
        }
        
        if ($this->form_validation->run() != FALSE && !empty($id)) {
            $check_id = $this->Demirbas_model->get_by_id($id);
            if($check_id){
                unset($data['id']);
                $data['demirbas_kodu']          = str_pad($id,5,"0",STR_PAD_LEFT);
       
                $this->Demirbas_model->update($id,$data);
            }
        }elseif($this->form_validation->run() != FALSE && empty($id)){
            $data['demirbas_sorumlu_kullanici_id']  = escape($this->session->userdata('aktif_kullanici_id'));
      
            $this->Demirbas_model->insert($data);
            $inserted_id = $this->db->insert_id();
     
            $data['demirbas_kodu']          = str_pad($inserted_id,5,"0",STR_PAD_LEFT);
          
            $this->Demirbas_model->update($inserted_id,$data);
 
        }else{
            $this->session->set_flashdata('form_errors', json_encode($this->form_validation->error_array()));
            redirect(site_url('demirbas/ekle'));
        }
		redirect(site_url('demirbas'));
	}
}
