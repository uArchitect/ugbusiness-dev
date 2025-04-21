<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct(){
        parent::__construct(); 
        date_default_timezone_set('Europe/Istanbul');
        $this->load->model('Kullanici_model');  $this->load->model('Siparis_model');
        $this->load->model('Yemek_model');
        $this->load->model('Banner_model');
       // session_login_control();
    }
 


    public function haftalik_kurulum_plan()
    {
        date_default_timezone_set('Europe/Istanbul');
    
        // Pazartesi gününün timestamp'ini al
        $baslangicTimestamp = strtotime('monday this week');
        $sonrakiPazartesiTimestamp = strtotime('monday next week') - 1; // Pazar 23:59:59
    
        $baslangic = date('Y-m-d 00:00:00', $baslangicTimestamp);
        $sonrakipazartesi = date('Y-m-d 23:59:59', $sonrakiPazartesiTimestamp);
    

        $data = $this->db  
        
				->join('urunler', 'urunler.urun_id = uretim_planlama.urun_fg_id')
				->join('urun_renkleri', 'urun_renkleri.renk_id = uretim_planlama.renk_fg_id')
                ->where("uretim_tarihi >=", $baslangic)
                ->where("uretim_tarihi <=", $sonrakipazartesi)
              
				->get("uretim_planlama")->result();

 
    
        // Tarihleri ayarla
        $viewData["d1"] = date("d.m.Y", $baslangicTimestamp);
        $viewData["d2"] = date("d.m.Y", strtotime("+1 day", $baslangicTimestamp));
        $viewData["d3"] = date("d.m.Y", strtotime("+2 days", $baslangicTimestamp));
        $viewData["d4"] = date("d.m.Y", strtotime("+3 days", $baslangicTimestamp));
        $viewData["d5"] = date("d.m.Y", strtotime("+4 days", $baslangicTimestamp));
        $viewData["d6"] = date("d.m.Y", strtotime("+6 days", $baslangicTimestamp));
    
        $viewData["data"] = $data;
        $viewData["page"] = "siparis/haftalik_kurulum_plan_tv";
    
        $this->load->view('base_view_modal', $viewData);
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




	public function verify_view()
	{       
		$verification_code = rand(100000, 999999);
		$this->session->set_userdata('verification_code', $verification_code);

		  sendSmsData("05435293481","Sn. Ceyda Kılıç, ugbusiness sistemine girişte kullanacağınız doğrulama kodunuz : $verification_code");
		$this->load->view('sms_dogrulama/main_content');
	}

	public function verify_code() {
         
        $user_code = $this->input->post('verification_code');

 
        $session_code = $this->session->userdata('verification_code');

        if ($user_code == $session_code) {
			$this->session->set_userdata('sms_verified', true);

			redirect(base_url("onay-bekleyen-siparisler"));
        } else {
            
			 
			redirect(base_url("logout"));
        }
    }

    public function giris_yap()
	{ 
       
		if($this->input->method()=="post"){

            $this->form_validation->set_rules('password','Şifre','trim|required');
            $this->form_validation->set_rules('username','Kullanıcı Adı','trim|required');        
            if($this->form_validation->run() == FALSE){
                
                redirect(base_url("login"));
            }else{

                $query = $this->db->order_by('kullanici_adi', 'ASC')->where([
                    'kullanici_sifre' => base64_encode(strip_tags(trim($this->security->xss_clean($this->input->post('password',true))))),
                    'kullanici_email_adresi' => strip_tags(trim($this->security->xss_clean($this->input->post('username',true))))
                ])->where("kullanici_aktif",1)
                ->join('departmanlar', 'departmanlar.departman_id = kullanicilar.kullanici_departman_id')
                ->join('kullanici_gruplari', 'kullanici_gruplari.kullanici_grup_id = kullanicilar.kullanici_grup_no')
                ->get("kullanicilar")->result();

 
 
                
                if($query){
                     if($query[0]->kullanici_bloke == 1){
                    $this->session->set_flashdata('flashDanger', " 5 kere hatalı giriş denemesi yaptığınız için hesabınız bloklanmıştır. Lütfen sistem yöneticiniz ile iletişime geçiniz. ");
                  
                    redirect(base_url("giris-yap"));
                  }
                  $this->db->where("kullanici_id",$query[0]->kullanici_id)->update("kullanicilar",["giris_deneme" => 0]);
                





                    $combine = $this->input->ip_address().$this->input->post('username');
                    $crypto = sha1(md5($combine));
                    $this->session->set_userdata([
                        'user_session' => $crypto,
                        'username' => $this->input->post('username'),
                        'aktif_kullanici_id' => $query[0]->kullanici_id
                    ]);

                    if($query[0]->kullanici_departman_id == 19){
                        redirect(base_url('Ugajans')); 
                       }

                     
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
                    $u = strip_tags(trim($this->security->xss_clean($this->input->post('username',true)))); 
                    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                        $ip = $_SERVER['HTTP_CLIENT_IP'];
                    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                    } else {
                        $ip = $_SERVER['REMOTE_ADDR'];
                    }
                    $query = $this->Kullanici_model->get_all([
                        'kullanici_email_adresi' => strip_tags(trim($this->security->xss_clean($this->input->post('username',true))))
                    ]);

                    if($query){
                        $deneme = $query[0]->giris_deneme+1;
                        if($query[0]->kullanici_bloke == 0){
                            $this->db->where("kullanici_id",$query[0]->kullanici_id)->update("kullanicilar",["giris_deneme" => $deneme]);
                  
                        }
                        
                        if($deneme == 5){
                    $this->db->where("kullanici_id",$query[0]->kullanici_id)->update("kullanicilar",["kullanici_bloke" => 1]);
                    sendSmsData("05382197344","SİSTEM UYARISI\n5 kez Hatalı Giriş Denemesi Yapıldığı İçin Kullanıcı Hesabı Engellendi!\nMail:$u\nIP Adresi:".$ip."\nKalan Deneme Hakkı:".(5-$deneme));
                    sendSmsData("05461393309","SİSTEM UYARISI\n5 kez Hatalı Giriş Denemesi Yapıldığı İçin Kullanıcı Hesabı Engellendi!\nMail:$u\nIP Adresi:".$ip."\nKalan Deneme Hakkı:".(5-$deneme));
                  
                }else{
                    sendSmsData("05382197344","SİSTEM UYARISI\nHatalı Giriş Denemesi Yapıldı!\nMail:$u\nIP Adresi:".$ip."\nKalan Deneme Hakkı:".(5-$deneme));
                    sendSmsData("05461393309","SİSTEM UYARISI\nHatalı Giriş Denemesi Yapıldı!\nMail:$u\nIP Adresi:".$ip."\nKalan Deneme Hakkı:".(5-$deneme));
		
                   }
                    }else{
                        sendSmsData("05382197344","SİSTEM UYARISI\nHatalı Giriş Denemesi Yapıldı!\nMail:$u\nIP Adresi:".$ip);
                        sendSmsData("05461393309","SİSTEM UYARISI\nHatalı Giriş Denemesi Yapıldı!\nMail:$u\nIP Adresi:".$ip);
                        
                    }

                    
                    $this->session->set_flashdata('flashDanger', "Email veya şifre bilgilerinizi hatalı girdiniz. ".((5-$deneme)>0 ? "Kalan Deneme Hakkı :".(5-$deneme) : "0") );
                     
                redirect(base_url("giris-yap"));
                }
            }
        }
	}
}
