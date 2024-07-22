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
 


    public function gecikme_uyari_sms()
	{
		$query = $this->db->query("
        SELECT siparis_id,siparis_kodu, kayit_tarihi, otuz_gun_uyari_sms, kirk_bes_gun_uyari_sms
        FROM siparisler 
        INNER JOIN kullanicilar ON kullanicilar.kullanici_id = siparisler.siparisi_olusturan_kullanici
        INNER JOIN (
            SELECT *, ROW_NUMBER() OVER (PARTITION BY siparis_no ORDER BY adim_no DESC) as row_num 
            FROM siparis_onay_hareketleri
        ) as siparis_onay_hareketleri 
        ON siparis_onay_hareketleri.siparis_no = siparisler.siparis_id 
        AND siparis_onay_hareketleri.row_num = 1
        WHERE kayit_tarihi < DATE_SUB(CURDATE(), INTERVAL 45 DAY)
        AND siparis_aktif = 1
		AND kirk_bes_gun_uyari_sms = 0
        AND siparis_onay_hareketleri.adim_no < 12
    ");
	$smsdata = ""; 
    foreach ($query->result() as $row) {
        $data = array(
            'kirk_bes_gun_uyari_sms' => 1,
			'otuz_gun_uyari_sms' => 1
        );
		 
		$smsdata .= $row->siparis_kodu."\n";
        $this->db->where('siparis_id', $row->siparis_id);
        $this->db->update('siparisler', $data);
    }
	sendSmsData("05382197344","GECİKME UYARISI\nAşağıd a listelenen siparişlerin sipariş tarihinin üstünden 45 gün geçmiştir.\n\n".$smsdata);
	sendSmsData("05468311015","GECİKME UYARISI\nAşağıda listelenen siparişlerin sipariş tarihinin üstünden 45 gün geçmiştir.\n\n".$smsdata);
	


	$querynew = $this->db->query("
	SELECT siparis_id,siparis_kodu, kayit_tarihi, otuz_gun_uyari_sms, kirk_bes_gun_uyari_sms
	FROM siparisler 
	INNER JOIN kullanicilar ON kullanicilar.kullanici_id = siparisler.siparisi_olusturan_kullanici
	INNER JOIN (
		SELECT *, ROW_NUMBER() OVER (PARTITION BY siparis_no ORDER BY adim_no DESC) as row_num 
		FROM siparis_onay_hareketleri
	) as siparis_onay_hareketleri 
	ON siparis_onay_hareketleri.siparis_no = siparisler.siparis_id 
	AND siparis_onay_hareketleri.row_num = 1
	WHERE kayit_tarihi < DATE_SUB(CURDATE(), INTERVAL 30 DAY)
	AND siparis_aktif = 1
	AND kirk_bes_gun_uyari_sms = 0
	AND siparis_onay_hareketleri.adim_no < 12
");

	$smsdata = ""; 
    foreach ($querynew->result() as $row) {
        $data = array(
			'otuz_gun_uyari_sms' => 1
        );
		 
		$smsdata .= $row->siparis_kodu."\n";
        $this->db->where('siparis_id', $row->siparis_id);
        $this->db->update('siparisler', $data);
    }
	sendSmsData("05382197344","GECİKME UYARISI\nAşağıd a listelenen siparişlerin sipariş tarihinin üstünden 30 gün geçmiştir.\n\n".$smsdata);
	sendSmsData("05468311015","GECİKME UYARISI\nAşağıd a listelenen siparişlerin sipariş tarihinin üstünden 30 gün geçmiştir.\n\n".$smsdata);
	







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
                    $combine = $this->input->ip_address().$this->input->post('username');
                    $crypto = sha1(md5($combine));
                    $this->session->set_userdata([
                        'user_session' => $crypto,
                        'username' => $this->input->post('username'),
                        'aktif_kullanici_id' => $query[0]->kullanici_id
                    ]);
                    if($query[0]->gecici_sifre == "1"){
                        redirect(base_url('kullanici/sifre_degistir')); 
                    }
                   if($query[0]->baslangic_ekrani == "" || $query[0]->baslangic_ekrani == null){
                    redirect(base_url('onay-bekleyen-siparisler')); 
                   }else{
                    redirect(base_url($query[0]->baslangic_ekrani)); 
                   }
                       
                }else{
                    $this->session->set_flashdata('flashDanger', "Email veya şifre bilgilerinizi hatalı girdiniz.");
                  
                redirect(base_url("giris-yap"));
                }
            }
        }
	}
}
