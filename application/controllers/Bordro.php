<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bordro extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Bordro_model'); 
         $this->load->model('Kullanici_model'); 
        date_default_timezone_set('Europe/Istanbul');
    }
 
    public function kilit_kontrol(){


        $session_security_code = $this->session->userdata('locked_bordro_value');
        $input_security_code   = $this->input->post('txt_bordro_lock_value');
        if($session_security_code == $input_security_code){
            $this->session->set_userdata('locked_bordro',  true);
            redirect(site_url('bordro'));
        }else{
            $this->session->set_userdata('locked_bordro',  false);
            $this->session->set_flashdata('formDanger', "Tek kullanımlık güvenlik kodunu yanlış girdiniz. Bordro sayfasına erişim sağlanamamıştır.");
            redirect(site_url('bordro'));
        }

 
    }

	public function index()
	{
        if(goruntuleme_kontrol("tum_bordrolari_goruntule") == true){
            $data = $this->Bordro_model->get_all(); 
        }elseif(goruntuleme_kontrol("kendi_bordrolarini_goruntule") == true){
            $data = $this->Bordro_model->get_all(["bordro_kullanici_id"=>$this->session->userdata('aktif_kullanici_id')]); 
        }else{
            $this->session->set_flashdata('flashDanger', "Bordroları görüntüleme yetkiniz bulunmamaktadır. sistem yöneticiniz ile iletişime geçiniz.");
            redirect(base_url("anasayfa"));
        }
        
         $abc_value = $this->session->userdata('locked_bordro');
     
         if ($abc_value !== false && $abc_value !== null) {
            
            $this->session->set_userdata('locked_bordro', false);
         } else {
          
            $randomNumber = rand(100000, 999999);
            sendSmsData(aktif_kullanici()->kullanici_bireysel_iletisim_no,"Bordro modülüne giriş yaparken kullanacağınız tek kullanımlık güvenlik kodu : ".$randomNumber);

            $this->session->set_userdata('locked_bordro_value', $randomNumber);
            $viewData["page"] = "bordro/lock";
            $this->load->view('base_view',$viewData);return;
             
            }
        


		$viewData["bordrolar"] = $data;
		$viewData["page"] = "bordro/list";
		$this->load->view('base_view',$viewData);
	}

	public function add()
	{   
        yetki_kontrol("bordro_ekle");
        $kullanici_data = $this->Kullanici_model->get_all();  
        $viewData["kullanicilar"] = $kullanici_data;
		$viewData["page"] = "bordro/form";
		$this->load->view('base_view',$viewData);
	}

	public function edit($id = '')
	{  
        yetki_kontrol("bordro_duzenle");
		$check_id = $this->Bordro_model->get_by_id($id); 
        if($check_id){  
            $kullanici_data = $this->Kullanici_model->get_all();  
            $viewData["bordro_hareketleri"] = $this->Bordro_model->get_actions(["goruntulenen_bordro_id"=>$id]);
            $viewData["kullanicilar"] = $kullanici_data;
            $viewData['bordro'] = $check_id[0];
			$viewData["page"] = "bordro/form"; 
			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('bordro'));
        }
 
	}



    public function bordro_goruntule($id)
	{     
        $check_id = $this->Bordro_model->get_by_id($id); 
        if($check_id[0]->bordro_yukleyen_kullanici_id != $this->session->userdata('aktif_kullanici_id')){
         
            if($check_id[0]->bordro_kullanici_id != $this->session->userdata('aktif_kullanici_id')){
                $this->session->set_flashdata('flashDanger', "Sadece kendinize ait bordro belgelerini görüntüleyebilirsiniz.");
                redirect(site_url('bordro'));
            }

        }
        $datagoruntuleme['goruntuleyen_kullanici_id'] =escape($this->session->userdata('aktif_kullanici_id'));
        $datagoruntuleme['goruntulenen_bordro_id'] =escape($check_id[0]->bordro_id);
        $this->db->insert('bordro_goruntulemeleri', $datagoruntuleme);

        redirect(site_url('uploads/'.$check_id[0]->bordro_belge));

	}


    public function delete($id)
	{     
        yetki_kontrol("bordro_sil");
		$this->Bordro_model->delete($id);  
        $viewData["page"] = "bordro/list";
		$this->load->view('base_view',$viewData);
	}



	public function save($id = '')
	{   
        if(empty($id)){
            yetki_kontrol("bordro_ekle");
        }else{
            yetki_kontrol("bordro_duzenle");
        }
        $this->form_validation->set_rules('bordro_kullanici_id',  'Bordro Kullanici',  'required'); 
        
        $data['bordro_kullanici_id']  = escape($this->input->post('bordro_kullanici_id'));
        $data['bordro_yukleyen_kullanici_id']  = escape($this->session->userdata('aktif_kullanici_id'));
        $data['bordro_ay'] =escape($this->input->post('bordro_ay'));
        $data['bordro_yil'] =escape($this->input->post('bordro_yil'));
        $bordro_belge_path = "";

        if(true){
            $bordro_belge_path = 'file_'.uniqid() . uniqid() . uniqid();
            $config = array(
                'upload_path' => "uploads/",
                'allowed_types' => "pdf",
                'overwrite' => TRUE,
                'max_size' => "5048000",
                'file_name' => $bordro_belge_path
                );
                $this->load->library('upload', $config);
                if($this->upload->do_upload('bordro_belge'))
                {
                
                }else
                {
              
                }

                $data['bordro_belge'] =$bordro_belge_path.".pdf";
        }
    
        if ($this->form_validation->run() != FALSE && !empty($id)) {
            $check_id = $this->Bordro_model->get_by_id($id);
            if($check_id){
                $this->Bordro_model->update($id,$data);
            }
        }elseif($this->form_validation->run() != FALSE && empty($id)){
            $this->Bordro_model->insert($data);
        }else{
            $this->session->set_flashdata('form_errors', json_encode($this->form_validation->error_array()));
            redirect(site_url('bordro/ekle'));
        }
		redirect(site_url('bordro'));
	}
}
