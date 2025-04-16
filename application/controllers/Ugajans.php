<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ugajans extends CI_Controller {
	function __construct(){
        parent::__construct();
       // session_control();  $this->load->model('Kullanici_model'); 
        date_default_timezone_set('Europe/Istanbul');
    }
 






    public function giris_yap()
	{ 
       
		if($this->input->method()=="post"){

            $this->form_validation->set_rules('password','Şifre','trim|required');
            $this->form_validation->set_rules('username','Kullanıcı Adı','trim|required');        
            if($this->form_validation->run() == FALSE){
                redirect(base_url("ugajans"));
            }else{

                $query = $this->db->where([
                    'ugajans_kullanici_sifre' => strip_tags(trim($this->security->xss_clean($this->input->post('password',true)))),
                    'ugajans_kullanici_adi' => strip_tags(trim($this->security->xss_clean($this->input->post('username',true))))
                ])->get("ugajans_kullanicilar")->result();

 
 
                
                if($query){
                     
                    $combine = $this->input->ip_address().$this->input->post('username');
                    $crypto = sha1(md5($combine));
                    $this->session->set_userdata([
                        'ugajans_user_session' => $crypto,
                        'ugajans_username' => $this->input->post('username'),
                        'ugajans_aktif_kullanici_id' => $query[0]->ugajans_kullanici_id 
                    ]);

                        redirect(base_url('ugajans_anasayfa')); 
                        
   
                } else{
                    $this->session->set_flashdata('flashDanger', "Kullanıcı adı veya şifre hatalı bilgileri kontrol edip tekrar deneyiniz.");
                    redirect($_SERVER['HTTP_REFERER']);
                 
                }
            }
        }
	}
 















	public function index()
	{   
       
 
        $this->load->view('ugajansviews/login');
return;


        $aktif_kullanici = $this->Kullanici_model->get_by_id($this->session->userdata('aktif_kullanici_id')); 
		 
		if($aktif_kullanici[0]->kullanici_departman_id != 19){
redirect(base_url());
		}


        $this->load->model('Yemek_model');
		$viewData["yemek"] = $this->Yemek_model->get_by_id(date("d"))[0];


        $gorev_filter = (!isset($_GET["gorev_filter"]) ? "1" : $_GET["gorev_filter"] );
       
        
       
       
        $viewData["gorevler"] = $this->db
        ->order_by("gorev_id","desc")
        ->where("gorev_durum",$gorev_filter)
        ->where("gorev_aktif",1)
        ->select("
        ug_ajans_gorevler.*,
        olusturan_kullanici.kullanici_id as olusturan_kullanici_id,
        olusturan_kullanici.kullanici_ad_soyad as olusturan_kullanici_ad_soyad,
        atanan_kullanici.kullanici_id as atanan_kullanici_id,
        atanan_kullanici.kullanici_ad_soyad as atanan_kullanici_ad_soyad   
        ")
        ->join("kullanicilar as olusturan_kullanici","olusturan_kullanici.kullanici_id = ug_ajans_gorevler.gorev_olusturan_kullanici")
        ->join("kullanicilar as atanan_kullanici","atanan_kullanici.kullanici_id = ug_ajans_gorevler.gorev_atanan_kullanici")
        
        ->get("ug_ajans_gorevler")->result();



        $viewData["beklemede_gorev_count"]      = $this->db->where("gorev_durum",1)->where("gorev_aktif",1)->get('ug_ajans_gorevler')->num_rows();
        $viewData["islemde_gorev_count"]        = $this->db->where("gorev_durum",2)->where("gorev_aktif",1)->get('ug_ajans_gorevler')->num_rows();
        $viewData["tamamlandi_gorev_count"]     = $this->db->where("gorev_durum",3)->where("gorev_aktif",1)->get('ug_ajans_gorevler')->num_rows();
        $viewData["iptal_gorev_count"]          = $this->db->where("gorev_durum",4)->where("gorev_aktif",1)->get('ug_ajans_gorevler')->num_rows();

        $viewData["yemek"] = $this->Yemek_model->get_by_id(date("d"))[0];



        $viewData["page"] = "ugajans/anasayfa";
        $this->load->view('ug_ajans_base_view',$viewData);
 
    }



    public function talep()
	{   $aktif_kullanici = $this->Kullanici_model->get_by_id($this->session->userdata('aktif_kullanici_id')); 
		
        if($aktif_kullanici[0]->kullanici_departman_id != 19){
            redirect(base_url());
                    }
        yetki_kontrol("ugajans_talepleri_goruntule");
        $gorev_filter = (!isset($_GET["talep_filter"]) ? "1" : $_GET["talep_filter"] );
       if(!isset($_GET["talep_filter"])){
        redirect(base_url("ugajans/talep?talep_filter=1"));
       }

        $viewData["talepler"] = $this->db
                                        ->order_by("ugajans_talep_id ","desc")
                                        ->where("ugajans_talep_durum",$gorev_filter)
                                        ->where("talep_aktif",1)
                                        ->select("*")
                                        ->join("ugajans_hizmetler","ugajans_hizmetler.ugajans_hizmet_id = ug_ajans_talep.ugajans_talep_konu")
                                        ->get("ug_ajans_talep")->result();



                                        $viewData["beklemede_talep_count"]      = $this->db->where("ugajans_talep_durum",1)->where("talep_aktif",1)->get('ug_ajans_talep')->num_rows();
                                        $viewData["islemde_talep_count"]        = $this->db->where("ugajans_talep_durum",2)->where("talep_aktif",1)->get('ug_ajans_talep')->num_rows();
                                        $viewData["donus_talep_count"]     = $this->db->where("ugajans_talep_durum",3)->where("talep_aktif",1)->get('ug_ajans_talep')->num_rows();
                                        $viewData["olumlu_talep_count"]          = $this->db->where("ugajans_talep_durum",4)->where("talep_aktif",1)->get('ug_ajans_talep')->num_rows();
                                        $viewData["olumsuz_talep_count"]          = $this->db->where("ugajans_talep_durum",5)->where("talep_aktif",1)->get('ug_ajans_talep')->num_rows();
                                        $viewData["iptal_talep_count"]          = $this->db->where("ugajans_talep_durum",6)->where("talep_aktif",1)->get('ug_ajans_talep')->num_rows();

        $viewData["page"] = "ugajans/talep";
        $this->load->view('ug_ajans_base_view',$viewData);
    }

    public function talep_durum_guncelle($talep_id)
	{  
        $update_data = [];        
        $update_data["ugajans_talep_sonlandirma_notu"] = $this->input->post("ugajans_talep_sonlandirma_notu"); 
        $update_data["ugajans_talep_durum"] = $this->input->post("ugajans_talep_durum");  
        $this->db->where("ugajans_talep_id ",$talep_id)->update("ug_ajans_talep",$update_data);
        $this->session->set_flashdata('flashSuccess','Talep Durum Bilgileri Başarıyla Güncellenmiştir.');
        redirect($_SERVER['HTTP_REFERER']); 
    }


 public function rehber()
	{ 
        $aktif_kullanici = $this->Kullanici_model->get_by_id($this->session->userdata('aktif_kullanici_id')); 
		
        if($aktif_kullanici[0]->kullanici_departman_id != 19){
        redirect(base_url());
                }
        $viewData["ug_kullanicilar"] = $this->db->order_by("kullanici_id","desc")->where("kullanici_departman_id",19)->get("kullanicilar")->result();
        $viewData["page"] = "ugajans/rehber";
        $this->load->view('ug_ajans_base_view',$viewData);
    }

    public function gorev_ekle_view()
	{  
        $viewData["gorev_kullanicilari"] = $this->db->where("kullanici_departman_id",19)->get("kullanicilar")->result();
        $viewData["page"] = "ugajans/gorev_ekle";
        $this->load->view('ug_ajans_base_view',$viewData);
    }

 public function gorev_ekle()
	{  
        $insert_data = [];
        $insert_data["gorev_atanan_kullanici"] = $this->input->post("gorev_atanan_kullanici");        
        $insert_data["gorev_detaylari"] = $this->input->post("gorev_detaylari");  
        $insert_data["gorev_olusturan_kullanici"] = $this->session->userdata("aktif_kullanici_id");  
        $insert_data["gorev_durum"] = 1; 
        $this->db->insert("ug_ajans_gorevler",$insert_data);
        $this->session->set_flashdata('flashSuccess','Yeni Görev Bilgileri Başarıyla Kaydedilmiştir.');
        redirect($_SERVER['HTTP_REFERER']); 
    }

   

 public function gorev_durum_guncelle($gorev_id)
	{  
        $update_data = [];        
        $update_data["gorev_tamamlama_notu"] = $this->input->post("gorev_tamamlama_notu"); 
        $update_data["gorev_durum"] = $this->input->post("gorev_durum");  
        $this->db->where("gorev_id",$gorev_id)->update("ug_ajans_gorevler",$update_data);
        $this->session->set_flashdata('flashSuccess','Görev Durum Bilgileri Başarıyla Güncellenmiştir.');
        redirect($_SERVER['HTTP_REFERER']); 
    }

  public function talep_sil($gorev_id)
 {  
     $update_data = [];         
     $update_data["talep_aktif"] = 0;  
     $this->db->where("ugajans_talep_id",$gorev_id)->update("ug_ajans_talep",$update_data);
     $this->session->set_flashdata('flashSuccess','Talep Bilgileri Başarıyla Silinmiştir.');
     redirect($_SERVER['HTTP_REFERER']); 
 }
  
 public function gorev_sil($gorev_id)
 {  
     $update_data = [];         
     $update_data["gorev_aktif"] = 0;  
     $this->db->where("gorev_id",$gorev_id)->update("ug_ajans_gorevler",$update_data);
     $this->session->set_flashdata('flashSuccess','Görev Bilgileri Başarıyla Silinmiştir.');
     redirect($_SERVER['HTTP_REFERER']); 
 }

    
}