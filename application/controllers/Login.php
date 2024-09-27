<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct(){
        parent::__construct(); 
        date_default_timezone_set('Europe/Istanbul');
        $this->load->model('Kullanici_model');
        $this->load->model('Yemek_model');
        $this->load->model('Banner_model');
        session_login_control();
    }
 


    



    public function lock_system()
	{   
        if(!empty($_GET["lock_key"])){
            if($_GET["lock_key"] == "UG434EFEA11ECC547"){
                $query = $this->db->where(["ayar_id"=>1])->update("ayarlar",["acil_durum"=>0]);
                redirect(base_url("login"));

            }
        }
      
    }

    
	public function index()
	{      
        $query = $this->db
          ->select("acil_durum")
          ->from('ayarlar')

          ->get()->result();
          if($query[0]->acil_durum == 1){
            redirect("https://umex.com.tr");
          }
        
        $bannerlar = $this->Banner_model->get_all(); 
		$viewData["bannerlar"] = $bannerlar;
        $viewData["yemek"] = $this->Yemek_model->get_by_id(date("d"))[0];
		$this->load->view('giris/main_content',$viewData);
	}

    public function giris_yap()
	{ 
       
		if($this->input->method()=="post"){

            $this->form_validation->set_rules('password','Şifre','trim|required');
            $this->form_validation->set_rules('username','Kullanıcı Adı','trim|required');        
            if($this->form_validation->run() == FALSE){
                
                redirect(base_url("login"));
            }else{
                $query = $this->Kullanici_model->get_all([
                    'kullanici_sifre' => base64_encode(strip_tags(trim($this->security->xss_clean($this->input->post('password',true))))),
                    'kullanici_email_adresi' => strip_tags(trim($this->security->xss_clean($this->input->post('username',true))))
                ]);

            
                if($query){
                }else{
                   
                }
                
                if($query){
                    $this->db->where("kullanici_id",$query[0]->kullanici_id)->update("kullanicilar",["giris_deneme" => 0])
                  

                    $combine = $this->input->ip_address().$this->input->post('username');
                    $crypto = sha1(md5($combine));
                    $this->session->set_userdata([
                        'user_session' => $crypto,
                        'username' => $this->input->post('username'),
                        'aktif_kullanici_id' => $query[0]->kullanici_id
                    ]);



                     
                    $redirect_url = $this->session->userdata('redirect_url');
                    $this->session->unset_userdata('redirect_url');  
                
                    if ($redirect_url) {
                        redirect($redirect_url);
                    }  



                    if($query[0]->gecici_sifre == "1"){
                        redirect(base_url('kullanici/sifre_degistir')); 
                    }
                   if($query[0]->baslangic_ekrani == "" || $query[0]->baslangic_ekrani == null){
                    redirect(base_url('onay-bekleyen-siparisler')); 
                   }else{
                    redirect(base_url($query[0]->baslangic_ekrani)); 
                   }
                       
                }else{

                    $query = $this->Kullanici_model->get_all([
                        'kullanici_email_adresi' => strip_tags(trim($this->security->xss_clean($this->input->post('username',true))))
                    ]);

                    if($query){
                        $deneme = $query[0]->giris_deneme+1;
                        $this->db->where("kullanici_id",$query[0]->kullanici_id)->update("kullanicilar",["giris_deneme" => $deneme])
                    }

                    $this->session->set_flashdata('flashDanger', "Email veya şifre bilgilerinizi hatalı girdiniz.");
                  
                redirect(base_url("giris-yap"));
                }
            }
        }
	}
}
