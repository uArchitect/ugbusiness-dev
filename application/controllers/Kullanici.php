<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kullanici extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Kullanici_model');
        $this->load->model('Kullanici_yetkileri_model'); 
        $this->load->model('Departman_model');  $this->load->model('Egitim_model'); 
        $this->load->model('Kullanici_grup_model'); 
        $this->load->model('Arac_model');
        date_default_timezone_set('Europe/Istanbul');
    }

    public function profil_kullanici_egitim_rapor($kullanici_id = 1)
	{   
        $edata = $this->Egitim_model->get_all(["egitim_kayit_sorumlu_kullanici_id"=>$kullanici_id]); 

        $viewData["secilen_kullanici"] = $kullanici_id;
        $viewData["egitimler"] =  $edata;
        $viewData["kullanici_data"] =  $this->Kullanici_model->get_all(["kullanici_id"=>$kullanici_id])[0]; 
        $viewData["kullanicilar"] = $this->db->where("kullanici_departman_id !=",19)->get("kullanicilar")->result();
        $viewData["page"] = "kullanici/profil";
        $viewData["onpage"] = "profil_egitim_raporu";
        $this->load->view('base_view',$viewData);
    }

    public function profil_kullanici_arac_rapor($kullanici_id = 1)
	{   

        $dd = $this->db->where("arac_surucu_id",$kullanici_id)->or_where("arac_surucu_id_2",$kullanici_id)->get("araclar")->result();
        if(count($dd) > 0){
            redirect("https://ugbusiness.com.tr/arac/index/".$dd[0]->arac_id);
        }else{
            $this->session->set_flashdata('flashDanger', "Bu kullanıcıya tanımlı araç kaydı bulunamadı.");
              
            redirect("https://ugbusiness.com.tr/kullanici/kullanici_profil/$kullanici_id");
        }

        $viewData["secilen_kullanici"] = $kullanici_id;
        $viewData["tanimli_araclar"] = $this->db->where("arac_surucu_id",$kullanici_id)->or_where("arac_surucu_id_2",$kullanici_id)->get("araclar")->result();
        $viewData["kullanici_data"] =  $this->Kullanici_model->get_all(["kullanici_id"=>$kullanici_id])[0]; 
        $viewData["kullanicilar"] = $this->db->where("kullanici_departman_id !=",19)->get("kullanicilar")->result();
        $viewData["page"] = "kullanici/profil";
        $viewData["onpage"] = "profil_arac_raporu";
        $this->load->view('base_view',$viewData);
    }
    public function profil_kullanici_kapi($kullanici_id = 1)
	{
        $viewData["secilen_kullanici"] = $kullanici_id;
        $viewData["kullanici_data"] =  $this->Kullanici_model->get_all(["kullanici_id"=>$kullanici_id])[0]; 

        $viewData["gecis_data"] = json_encode(
            $this->db->where("mesai_takip_kullanici_id", $this->session->userdata('aktif_kullanici_id'))
                     ->get("mesai_takip")
                     ->result()
        );

          $viewData["kullanicilar"] = $this->db->where("kullanici_departman_id !=",19)->get("kullanicilar")->result();
        $viewData["page"] = "kullanici/profil";
        $viewData["onpage"] = "kapi_gecis_rapor";
        $this->load->view('base_view',$viewData);
    }
 public function profil_kullanici_sms_view($kullanici_id = 1)
	{
        $viewData["secilen_kullanici"] = $kullanici_id;
        $viewData["kullanici_data"] =  $this->Kullanici_model->get_all(["kullanici_id"=>$kullanici_id])[0]; 
        $viewData["son_gonderilen_smsler"] =  $this->db->order_by("gonderim_tarihi","DESC")->where("gonderilen_sms_kullanici_id",$kullanici_id)->select("gonderilen_smsler.*,kullanicilar.kullanici_ad_soyad")->from("gonderilen_smsler")->join("kullanicilar","kullanicilar.kullanici_id = gonderilen_smsler.gonderen_kullanici_id ")->get()->result(); 
        $viewData["kullanicilar"] = $this->db->get("kullanicilar")->result();
        $viewData["page"] = "kullanici/profil";
        $viewData["onpage"] = "sms_gonder";
        $this->load->view('base_view',$viewData);
    }

    
    public function profil_kullanici_sms_save($kullanici_id = 0)
	{
        if($kullanici_id != 0){

       
        sendSmsData($this->input->post("iletisim_numarasi"),  $this->input->post("sms_detay"));
        

        $insertData["gonderilen_sms_kullanici_id"] = $kullanici_id;
        $insertData["gonderilen_sms_detay"] = $this->input->post("sms_detay");
        $insertData["gonderen_kullanici_id"] = $this->session->userdata('aktif_kullanici_id');
       $this->db->insert("gonderilen_smsler",$insertData);

       $this->session->set_flashdata('flashSuccess','SMS gönderiminiz başarıyla gerçekleştirilmiştir.');
    }else{
        $this->session->set_flashdata('flashDanger','SMS gönderimi başarısız.');
    }
       redirect("kullanici/profil_kullanici_sms_view/$kullanici_id");
        
    }
 public function profil_kullanici_sms_save2($kullanici_id = 0)
	{
        if($kullanici_id != 0){

       
        sendSmsData($this->input->post("iletisim_numarasi"),  $this->input->post("sms_detay"));
        

        $insertData["gonderilen_sms_kullanici_id"] = $kullanici_id;
        $insertData["gonderilen_sms_detay"] = $this->input->post("sms_detay");
        $insertData["gonderen_kullanici_id"] = $this->session->userdata('aktif_kullanici_id');
       $this->db->insert("gonderilen_smsler",$insertData);

       $this->session->set_flashdata('flashSuccess','SMS gönderiminiz başarıyla gerçekleştirilmiştir.');
    }else{
        $this->session->set_flashdata('flashDanger','SMS gönderimi başarısız.');
    }
       redirect("kullanici/profil_new/$kullanici_id?subpage=iletisim");
        
    }
    public function profil_kullanici_satis_rapor($kullanici_id = 1,$ay_filtre = 0,$yil_filtre = 2025)
	{
        if($ay_filtre == 0){
            $ay_filtre = date("m");
        }
      
        $sql = "SELECT kullanicilar.kullanici_ad_soyad,siparisler.siparis_kodu,siparisler.siparis_id,musteriler.musteri_ad,musteriler.musteri_iletisim_numarasi,siparis_urunleri.odeme_secenek, `satis_fiyati`,`pesinat_fiyati`,`kapora_fiyati`,`takas_bedeli`,`vade_sayisi`,`fatura_tutari`,`urun_adi`,siparisler.kayit_tarihi,siparisler.siparis_kodu
        FROM `siparis_urunleri`
        INNER JOIN siparisler on siparis_urunleri.siparis_kodu = siparisler.siparis_id
        INNER JOIN merkezler on merkezler.merkez_id = siparisler.merkez_no
        INNER JOIN musteriler on musteriler.musteri_id = merkezler.merkez_yetkili_id
        INNER JOIN urunler on urunler.urun_id = siparis_urunleri.urun_no
        INNER JOIN kullanicilar on kullanicilar.kullanici_id = siparisler.siparisi_olusturan_kullanici
        where (kullanicilar.kullanici_departman_id = 12 or kullanicilar.kullanici_departman_id = 17 or kullanicilar.kullanici_departman_id = 18 or kullanicilar.kullanici_id = 2 or kullanicilar.kullanici_id = 9) and siparisler.siparis_aktif = 1 and kullanicilar.kullanici_id = $kullanici_id
        ".($ay_filtre != 0 ? "AND MONTH(siparisler.kayit_tarihi) = $ay_filtre" : "")." "."AND YEAR(siparisler.kayit_tarihi) = $yil_filtre"." ORDER BY siparisler.kayit_tarihi desc";
     
       $query = $this->db->query($sql);
    
        $viewData["satislar"] =  $query->result(); 
        $kquery = $this->db->order_by('kullanici_adi', 'ASC')->where("kullanici_departman_id !=",19)->where(["kullanici_id"=>$kullanici_id])
        ->join('departmanlar', 'departmanlar.departman_id = kullanicilar.kullanici_departman_id')
        ->join('kullanici_gruplari', 'kullanici_gruplari.kullanici_grup_id = kullanicilar.kullanici_grup_no')
        ->get("kullanicilar")->result();
        $viewData["kullanici_data"] =  $kquery[0]; 


        $viewData["kullanicilar"] = $this->db->where("kullanici_departman_id !=",19)->get("kullanicilar")->result();
        $viewData["page"] = "kullanici/profil";
        $viewData["onpage"] = "profil_satis_raporu";

         $viewData["secilen_ay"] = $ay_filtre;
         $viewData["secilen_kullanici"] = $kullanici_id;
         $viewData["secilen_yil"] = $yil_filtre;


        $this->load->view('base_view',$viewData);

    }
    public function kullanici_profil($kullanici_id = 1)
	{
        redirect("kullanici/profil_kullanici_satis_rapor/$kullanici_id");
    }
    
    
    public function limit_kontrol_ekle()
	{
        yetki_kontrol("satis_limitlerini_yonet");
        $query = $this->db
        ->update("kullanicilar",[
            "kullanici_limit_kontrol"=>1
        ]);
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function limit_kontrol_kaldir($l_kullanici_id = 0)
	{
        yetki_kontrol("satis_limitlerini_yonet");

        if($l_kullanici_id != 0){
            $query = $this->db
        ->update("kullanicilar",[
            "kullanici_limit_kontrol"=>0
        ]);
        }
       
        redirect($_SERVER['HTTP_REFERER']);
    }



    public function kontrol_guncelle($satis_fiyat_limit_id,$durum)
	{
        yetki_kontrol("satis_limitlerini_yonet");
        $query = $this->db->where(["satis_fiyat_limit_id"=>$satis_fiyat_limit_id])
        ->update("satis_fiyat_limitleri",[
            "limit_kontrol"=>$durum
        ]);
		echo "Limit Kontrol Bilgisi Güncellendi. Bu ekranı kapatabilirsiniz.<script> window.close();</script>";
    }
    
    public function tum_limitleri_kapat($kullanici_id)
	{
        if($kullanici_id != 0){
            yetki_kontrol("satis_limitlerini_yonet");
            $query = $this->db->where(["limit_kullanici_id"=>$kullanici_id])
            ->update("satis_fiyat_limitleri",[
                "limit_kontrol"=>0
            ]);
        }
        redirect($_SERVER['HTTP_REFERER']);
	}

    public function tum_limitleri_ac($kullanici_id)
	{
        if($kullanici_id != 0){
            yetki_kontrol("satis_limitlerini_yonet");
            $query = $this->db->where(["limit_kullanici_id"=>$kullanici_id])
            ->update("satis_fiyat_limitleri",[
                "limit_kontrol"=>1
            ]);
        }
        redirect($_SERVER['HTTP_REFERER']);
	}


  public function fiyat_guncelle_save($satis_fiyat_limit_id)
	{  yetki_kontrol("satis_limitlerini_yonet");
         


        if($this->input->post("tumu_icin_guncelle")){
            $query1 = $this->db->where(["satis_fiyat_limit_id"=>$satis_fiyat_limit_id])
        ->get("satis_fiyat_limitleri")->result();


        $query = $this->db->where(["limit_urun_id"=>$query1[0]->limit_urun_id])
            ->update("satis_fiyat_limitleri",[
                "nakit_takassiz_satis_fiyat"=>$this->input->post("nakit_takassiz_satis_fiyat"),
                "vadeli_takassiz_satis_fiyat"=>$this->input->post("vadeli_takassiz_satis_fiyat"),
                "vadeli_pesinat_fiyat"=>$this->input->post("vadeli_pesinat_fiyat"),
                "nakit_umex_takas_fiyat"=>$this->input->post("nakit_umex_takas_fiyat"),
                "vadeli_umex_takas_fiyat"=>$this->input->post("vadeli_umex_takas_fiyat"),
                "nakit_robotix_takas_fiyat"=>$this->input->post("nakit_robotix_takas_fiyat"),
                "vadeli_robotix_takas_fiyat"=>$this->input->post("vadeli_robotix_takas_fiyat"),
                "nakit_diger_takas_fiyat"=>$this->input->post("nakit_diger_takas_fiyat"),
                "vadeli_diger_takas_fiyat"=>$this->input->post("vadeli_diger_takas_fiyat")
            
            ]);
        }else{
            $query = $this->db->where(["satis_fiyat_limit_id"=>$satis_fiyat_limit_id])
            ->update("satis_fiyat_limitleri",[
                "nakit_takassiz_satis_fiyat"=>$this->input->post("nakit_takassiz_satis_fiyat"),
                "vadeli_takassiz_satis_fiyat"=>$this->input->post("vadeli_takassiz_satis_fiyat"),
                "vadeli_pesinat_fiyat"=>$this->input->post("vadeli_pesinat_fiyat"),
                "nakit_umex_takas_fiyat"=>$this->input->post("nakit_umex_takas_fiyat"),
                "vadeli_umex_takas_fiyat"=>$this->input->post("vadeli_umex_takas_fiyat"),
                "nakit_robotix_takas_fiyat"=>$this->input->post("nakit_robotix_takas_fiyat"),
                "vadeli_robotix_takas_fiyat"=>$this->input->post("vadeli_robotix_takas_fiyat"),
                "nakit_diger_takas_fiyat"=>$this->input->post("nakit_diger_takas_fiyat"),
                "vadeli_diger_takas_fiyat"=>$this->input->post("vadeli_diger_takas_fiyat")
            
            ]);
        }

       
		echo "Limit Bilgileri Güncellendi. Bu ekranı kapatabilirsiniz.<script> window.close();</script>";
    }

    public function fiyat_guncelle_view($satis_fiyat_limit_id)
	{  yetki_kontrol("satis_limitlerini_yonet");
        $query = $this->db->where(["satis_fiyat_limit_id"=>$satis_fiyat_limit_id])
        ->join('kullanicilar', 'kullanicilar.kullanici_id = limit_kullanici_id')
        ->join('urunler', 'urunler.urun_id = limit_urun_id')
        ->get("satis_fiyat_limitleri")->result();
		$this->load->view('kullanici/satis_limit/edit_price.php',["limit_data"=>$query]);
    }
    public function get_fiyat_limitleri()
	{

        if(aktif_kullanici()->kullanici_limit_kontrol == 0){
            $data = array('status' => 'fullaccess', 'message' => '', 'data' =>  []);
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
            return;
        }



        $urun_id        = $this->input->post("urun_id");
        $vade_sayisi    = $this->input->post("vade_sayisi");
        $pesinat_tutari = $this->input->post("pesinat_tutari");
         
        $urun_fiyat = $this->db->where("urun_id",$urun_id)->get("urunler")->result();
               
        $result = []; 
        $result[0]["limit_urun_id"]              = $urun_id; 
        $result[0]["pesinat_fiyati"]             = $urun_fiyat[0]->urun_pesinat_fiyati;
        $result[0]["nakit_takassiz_satis_fiyat"]         = $urun_fiyat[0]->urun_satis_fiyati;
        $result[0]["nakit_takassiz_satis_fiyat_kontrol"] = $urun_fiyat[0]->urun_satis_fiyati-$urun_fiyat[0]->satis_pazarlik_payi;

        $result[0]["nakit_umex_takas_fiyat"]     = $urun_fiyat[0]->urun_nakit_umex_takas_fiyat; 
        $result[0]["vadeli_umex_takas_fiyat"]     = $urun_fiyat[0]->urun_vadeli_umex_takas_fiyat; 
        $result[0]["nakit_robotix_takas_fiyat"]  = $urun_fiyat[0]->urun_nakit_robotix_takas_fiyat;
        $result[0]["vadeli_robotix_takas_fiyat"] = $urun_fiyat[0]->urun_vadeli_robotix_takas_fiyat;
        $result[0]["nakit_diger_takas_fiyat"]    = $urun_fiyat[0]->urun_nakit_diger_takas_fiyat;
        $result[0]["vadeli_diger_takas_fiyat"]   = $urun_fiyat[0]->urun_vadeli_diger_takas_fiyat;
        if($vade_sayisi != 0){
               $result[0]["vadeli_satis_fiyat"]    = dip_fiyat_hesapla($pesinat_tutari,$vade_sayisi,$urun_fiyat[0]->urun_satis_fiyati,$urun_fiyat[0]->urun_vade_farki,$urun_fiyat[0]->satis_pazarlik_payi)->toplam_dip_fiyat_yuvarlanmis;
                $result[0]["vadeli_satis_fiyat_kontrol"]    = dip_fiyat_hesapla($pesinat_tutari,$vade_sayisi,$urun_fiyat[0]->urun_satis_fiyati,$urun_fiyat[0]->urun_vade_farki,$urun_fiyat[0]->satis_pazarlik_payi)->toplam_dip_fiyat_yuvarlanmis_satisci;
       
               }
        $data = array('status' => 'ok', 'message' => '', 'data' =>  $result);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));

	}

function hesapla($pesinat_fiyati, $vade, $urun_satis_fiyati, $urun_vade_farki, $satis_pazarlik_payi) {
    // Senet tutarı hesaplanıyor
    $senet_result = (($urun_satis_fiyati - $pesinat_fiyati) * (($urun_vade_farki / 12) * $vade) + ($urun_satis_fiyati - $pesinat_fiyati));

    // Hesaplanan değerleri bir nesneye atıyoruz
    $urun = new stdClass();
    $urun->pesinat_fiyati = $pesinat_fiyati;
    $urun->vade = $vade;
    $urun->senet = $senet_result;
    $urun->aylik_taksit_tutar = $senet_result / $vade;
    $urun->toplam_dip_fiyat = $senet_result + $pesinat_fiyati;
    $urun->toplam_dip_fiyat_yuvarlanmis = floor(($senet_result + $pesinat_fiyati) / 5000) * 5000;
    $urun->toplam_dip_fiyat_yuvarlanmis_satisci = (floor(($senet_result + $pesinat_fiyati) / 5000) * 5000) - $satis_pazarlik_payi;

    // Tek bir sonuç döndürüyoruz
    return $urun;
}







	public function index()
	{
        // Kullanıcı Yetki Kontrol
        yetki_kontrol("kullanicilari_goruntule");

        $data = $this->Kullanici_model->get_all();    
		$viewData["kullanicilar"] = $data;
		$viewData["page"] = "kullanici/list";
		$this->load->view('base_view',$viewData);
	}

  

    public function list_boxed()
	{
        // Kullanıcı Yetki Kontrol
        yetki_kontrol("kullanicilari_goruntule");

        $data = $this->Kullanici_model->get_all();    
		$viewData["kullanicilar"] = $data;
		$viewData["page"] = "kullanici/list_boxed";
		$this->load->view('base_view',$viewData);
	}







    public function delete($id)
	{     
        yetki_kontrol("kullanici_sil");

        if($id==1){
            $this->session->set_flashdata('flashDanger', 'Geçersiz İşlem. Sisteme tanımlı ana kullanıcı olduğu için bu kayıt sistemden silinemez.');   
            $viewData["page"] = "kullanici/list";
            $this->load->view('base_view',$viewData);
            return;
        }
		$this->Kullanici_model->delete($id);  
        $viewData["page"] = "kullanici/list";
		$this->load->view('base_view',$viewData);
	}



	public function add()
	{   
        // Kullanıcı Yetki Kontrol
        yetki_kontrol("kullanici_ekle");

        //Kullanıcı Grup : 3 => Sorumlu
        $data = $this->Kullanici_model->get_all(["kullanici_grup_no"=>"3"]);    
        $viewData["sorumlu_kullanicilar"] = $data;
        $viewData["departmanlar"] = $this->Departman_model->get_all();
        $viewData["kullanici_gruplari"] = $this->Kullanici_grup_model->get_all();
        $viewData["kullanici_yetkileri"] = $this->Kullanici_yetkileri_model->get_all();
		$viewData["page"] = "kullanici/form";
		$this->load->view('base_view',$viewData);
	}

	public function edit($id = '')
	{  

        if($id == 1 && aktif_kullanici()->kullanici_id != 1){
            $this->session->set_flashdata('flashDanger','Bu kullanıcının bilgileri düzenlenemez. Sistem yöneticiniz ile iletişime geçiniz.');
			redirect(base_url("kullanici"));
        }
         // Kullanıcı Yetki Kontrol
         yetki_kontrol("kullanici_duzenle");

		$check_id = $this->Kullanici_model->get_by_id($id); 
        if($check_id){ 
            $this->db->select("*")
            ->from("logs")
            ->join('kullanicilar', 'kullanicilar.kullanici_id = logs.log_kullanici_no')
            ->where("logs.log_kullanici_no", $id)
            ->order_by('logs.log_id', "DESC");
   
            $query = $this->db->get()->result();

            //Kullanıcı Grup : 3 => Sorumlu
            $data = $this->Kullanici_model->get_all(["kullanici_grup_no"=>"3"]);    
            $viewData["sorumlu_kullanicilar"]           = $data;
            $viewData["departmanlar"]                   = $this->Departman_model->get_all();
            $viewData["kullanici_gruplari"]             = $this->Kullanici_grup_model->get_all();
            $viewData["kullanici_yetkileri"]            = $this->Kullanici_yetkileri_model->get_all();
            $viewData["kullanici_yetki_tanimlari"]      = $this->Kullanici_yetkileri_model->get_by_user_id($id);
            $viewData['kullanici']                      = $check_id[0];
            $viewData['logs']                           = $query;
			$viewData["page"]                           = "kullanici/form"; 
			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('kullanici'));
        }
 
	}




    public function smssifre($id = '')
	{  
      
		$check_id = $this->Kullanici_model->get_by_id($id); 
        if($check_id){ 
            sendSmsData($check_id[0]->kullanici_bireysel_iletisim_no,"UG Business sistemine giriş yaparken kullanacağınız Kullanıcı Adı : ".$check_id[0]->kullanici_email_adresi." Şifreniz : ".base64_decode($check_id[0]->kullanici_sifre)." Güvenlik için şifrenizi değiştirmeniz gerekmektedir.");
          //  redirect(site_url('kullanici'));
        }else{
          // redirect(site_url('kullanici'));
        }
 
	}









    public function getContactData()
    {
        $filterAdSoyad   = $this->input->post("filterAdSoyad"); 
        $filterTelefon   = $this->input->post("filterTelefon"); 
        $filterDepartman = $this->input->post("filterDepartman"); 
        if($filterAdSoyad != null && $filterAdSoyad != ""){
            $this->db->like('kullanici_ad_soyad', $filterAdSoyad, 'both'); 
        }
        if($filterTelefon != null && $filterTelefon != ""){
            $this->db->like('kullanici_bireysel_iletisim_no', $filterTelefon, 'both'); 
        }
        if($filterDepartman != null && $filterDepartman != ""){
            $this->db->where('kullanici_departman_id', $filterDepartman); 
        }
        $this->db->join('departmanlar', 'departmanlar.departman_id = kullanicilar.kullanici_departman_id');
        $this->db->join('kullanici_gruplari', 'kullanici_gruplari.kullanici_grup_id = kullanicilar.kullanici_grup_no');
        $this->db->select('*')->from('kullanicilar');

         
        $query = $this->db->get();
 
        
        echo json_encode($query->result());
    }



	public function sifre_degistir()
	{   
	      	$viewData["page"]                           = "kullanici/sifre_degistir"; 
			$this->load->view('base_view',$viewData);
	}
	public function changepassword()
	{   
	    $currentuserid = $this->session->userdata('aktif_kullanici_id');
	    $currentuser = $this->Kullanici_model->get_by_id($currentuserid); 
	   $yenisifre = base64_encode(escape($this->input->post('yeni_sifre')));
	   $yenisifretekrar = base64_encode(escape($this->input->post('yeni_sifre_tekrar')));
	  
	    $eski_sifre = $currentuser[0]->kullanici_sifre;
	    $eski_kontrol_sifre = base64_encode(escape($this->input->post('eski_sifre')));
         if($yenisifre !== $yenisifretekrar){
              $this->session->set_flashdata('flashDanger', "Yeni Şifre ve Yeni Şifre(Tekrar) alanları birbiriyle uyuşmuyor. Lütfen tekrar deneyiniz.");
         }elseif($eski_sifre !== $eski_kontrol_sifre){
                $this->session->set_flashdata('flashDanger', "Eski şifrenizi yanlış girdiniz. Şifre güncelleme işlemi başarısız.");
         }else{
             if($yenisifre == null || $yenisifre == ""){
                  $this->session->set_flashdata('flashDanger', "Yeni şifre alanı boş geçilemez. Şifre güncelleme işlemi başarısız.");
             }else{
                  $data['kullanici_sifre']  = $yenisifre;
                    $data['gecici_sifre']  = 0;
                  $this->Kullanici_model->update($currentuserid,$data); 
                    echo "<script>alert('Şifreniz başarıyla güncellenmiştir. Oturum sonlandırılıyor, tekrar giriş yapınız.');window.location = 'https://destek.rayvag.com.tr/logout';</script>";
         
                  ;
             }
         }
         
         	$viewData["page"]                           = "kullanici/sifre_degistir"; 
			$this->load->view('base_view',$viewData);
	}






    public function menu_gorunum_parametrelerini_guncelle($kullanici_id)
	{   
        $this->db->where("kullanici_id",$kullanici_id)->update("kullanicilar",$this->input->post());
	    redirect($_SERVER['HTTP_REFERER']);
	}

	






    public function kullanici_list_boyut_guncelle($kullanici_id,$boyut)
	{   
        $this->db->where("kullanici_id",$kullanici_id)->update("kullanicilar",["kullanici_liste_boyut"=>$boyut]);
	    redirect($_SERVER['HTTP_REFERER']);
	}



    public function kullanici_list_gizle($kullanici_id)
	{   
        $this->db->where("kullanici_id",$kullanici_id)->update("kullanicilar",["kullanici_liste_gorunum"=>0]);
	    redirect($_SERVER['HTTP_REFERER']);
	}
public function kullanici_list_goster($kullanici_id)
	{   
        $this->db->where("kullanici_id",$kullanici_id)->update("kullanicilar",["kullanici_liste_gorunum"=>1]);
	    redirect($_SERVER['HTTP_REFERER']);
	}

 public function bilgi_guncelle($kullanici_id)
	{   
        $this->db->where("kullanici_id",$kullanici_id)->update("kullanicilar",$this->input->post());
	    redirect($_SERVER['HTTP_REFERER']);
	}



	public function kullanici_detay_rapor()
	{   


        
            yetki_kontrol("satisci_rapor_goruntule");

            $data = $this->Kullanici_model->get_all();    
     

        $sql = "SELECT 
        kullanicilar.*,departmanlar.*,
        COUNT(CASE WHEN talep_yonlendirmeler.yonlenen_kullanici_id = talep_yonlendirmeler.yonlendiren_kullanici_id THEN 1 END) AS kendi_girdigi_talep_sayisi,
        COUNT(CASE WHEN talep_yonlendirmeler.gorusme_sonuc_no = 2 THEN 1 END) AS satis_sayisi,
        COUNT(*) AS toplam_yonlendirme_sayisi,
        CONCAT(
            ROUND(
                (COUNT(CASE WHEN talep_yonlendirmeler.gorusme_sonuc_no = 2 THEN 1 END) / COUNT(*) * 100), 
                2
            ), 
            '%'
        ) AS basari_yuzdesi,
        CONCAT(
            FLOOR(AVG(TIMESTAMPDIFF(SECOND, talep_yonlendirmeler.yonlendirme_tarihi, talep_yonlendirmeler.gorusme_sonuc_guncelleme_tarihi)) / (24*60*60)),
            ' gün ',
            FLOOR(MOD(AVG(TIMESTAMPDIFF(SECOND, talep_yonlendirmeler.yonlendirme_tarihi, talep_yonlendirmeler.gorusme_sonuc_guncelleme_tarihi)), (24*60*60)) / 3600),
            ' saat ',
            FLOOR(MOD(AVG(TIMESTAMPDIFF(SECOND, talep_yonlendirmeler.yonlendirme_tarihi, talep_yonlendirmeler.gorusme_sonuc_guncelleme_tarihi)), 3600) / 60),
            ' dakika ' 
        ) AS ortalama_donus_suresi
    FROM 
        talep_yonlendirmeler
    INNER JOIN 
        kullanicilar ON talep_yonlendirmeler.yonlenen_kullanici_id = kullanicilar.kullanici_id
        INNER JOIN 
        talepler ON talepler.talep_id = talep_yonlendirmeler.talep_no
        INNER JOIN 
    departmanlar ON departmanlar.departman_id = kullanicilar.kullanici_departman_id
    WHERE talepler.talep_kayit_tarihi > '2024-01-01'
    GROUP BY 
        kullanicilar.kullanici_ad_soyad 
    ORDER BY
        kullanicilar.kullanici_aktif DESC";
$query = $this->db->query($sql);
 

        $viewData["kullanicilar"] = $query->result();
        $viewData["page"] = "kullanici/list_rapor";
        $this->load->view('base_view',$viewData);

    }

public function profil_new($kullanici_id){
    yetki_kontrol("kullanici_profil_goruntule");

    $filter = $_GET["subpage"];
   
    if($filter == "ozluk-dosyasi"){
       
        $viewData["data_kullanici"] = get_yonlendiren_kullanici($kullanici_id); 
        $viewData["page"] = "kullanici/profile_new";
        $viewData["subpage"] = "kullanici/profile_new/ozluk_dosyasi";
        $this->load->view('base_view',$viewData);
    }
    if($filter == "arac-bilgisi"){
        $arac = $this->db->where("arac_surucu_id",$kullanici_id)->get("araclar")->result();
        $viewData["data_arac"] = (count(arac)>0 ? $arac[0] : null);

$secilen_arac_id = $arac[0]->arac_id;
        $viewData["secilen_arac"] = $this->Arac_model->get_all_araclar(["arac_id"=>$secilen_arac_id]);
        $viewData["bakim_kayitlari"] = $this->Arac_model->get_all_bakimlar($secilen_arac_id);
        $viewData["sigorta_kayitlari"] = $this->Arac_model->get_all_sigortalar($secilen_arac_id);
        $viewData["kasko_kayitlari"] = $this->Arac_model->get_all_kaskolar($secilen_arac_id);
        $viewData["arac_kmler"] = $this->Arac_model->get_all_km($secilen_arac_id);
        $viewData["muayene_kayitlari"] = $this->Arac_model->get_all_muayeneler($secilen_arac_id);

        

        $viewData["driverdata"] = get_arvento_arac_detay(); 
        $viewData["data_kullanici"] = get_yonlendiren_kullanici($kullanici_id); 
        $viewData["page"] = "kullanici/profile_new";
        $viewData["subpage"] = "kullanici/profile_new/arac_bilgisi";
        $this->load->view('base_view',$viewData);
    }
    

 if($filter == "mesai-bilgileri"){
    $viewData["gecis_data"] = json_encode(
        $this->db->where("mesai_takip_kullanici_id", $kullanici_id)
                 ->get("mesai_takip")
                 ->result()
    );
        $viewData["data_kullanici"] = get_yonlendiren_kullanici($kullanici_id); 
        $viewData["page"] = "kullanici/profile_new";
        $viewData["subpage"] = "kullanici/profile_new/mesai_bilgileri";
        $this->load->view('base_view',$viewData);
    }

    

    if($filter == "iletisim"){
         $viewData["son_gonderilen_smsler"] =  $this->db->order_by("gonderim_tarihi","DESC")->where("gonderilen_sms_kullanici_id",$kullanici_id)->select("gonderilen_smsler.*,kullanicilar.kullanici_ad_soyad")->from("gonderilen_smsler")->join("kullanicilar","kullanicilar.kullanici_id = gonderilen_smsler.gonderen_kullanici_id ")->get()->result(); 
      
            $viewData["data_kullanici"] = get_yonlendiren_kullanici($kullanici_id); 
            $viewData["page"] = "kullanici/profile_new";
            $viewData["subpage"] = "kullanici/profile_new/iletisim";
            $this->load->view('base_view',$viewData);
        }


if($filter == "parameter"){
        
            $viewData["data_kullanici"] = get_yonlendiren_kullanici($kullanici_id); 
            $viewData["page"] = "kullanici/profile_new";
            $viewData["subpage"] = "kullanici/profile_new/parameter";
            $this->load->view('base_view',$viewData);
        }

    if($filter == "envanter"){
                    
                    $viewData["envanterler"] = $this->db->order_by('demirbas_id', 'ASC')
                    ->where("demirbas_kullanici_id",$kullanici_id)
                    ->join('kullanicilar', 'kullanicilar.kullanici_id = demirbas_kullanici_id')
                    ->join('demirbas_kategorileri', 'demirbas_kategorileri.demirbas_kategori_id = kategori_id')
                    ->get("demirbaslar")->result();
            $viewData["data_kullanici"] = get_yonlendiren_kullanici($kullanici_id); 
            $viewData["page"] = "kullanici/profile_new";
            $viewData["subpage"] = "kullanici/profile_new/envanter";
            $this->load->view('base_view',$viewData);
        }



      if($filter == "satis"){
                    $ayfiltre = $_GET["selected_month"];
                    $yilfiltre = $_GET["selected_year"];
               $sql = "SELECT kullanicilar.kullanici_ad_soyad,kullanicilar.kullanici_id,siparisler.siparis_kodu,siparisler.siparis_id,musteriler.musteri_ad,musteriler.musteri_id,musteriler.musteri_iletisim_numarasi,siparis_urunleri.odeme_secenek, `satis_fiyati`,`pesinat_fiyati`,`kapora_fiyati`,`takas_bedeli`,`vade_sayisi`,`fatura_tutari`,`urun_adi`,siparisler.kayit_tarihi,siparisler.siparis_kodu
                    FROM `siparis_urunleri`
                    INNER JOIN siparisler on siparis_urunleri.siparis_kodu = siparisler.siparis_id
                    INNER JOIN merkezler on merkezler.merkez_id = siparisler.merkez_no
                    INNER JOIN musteriler on musteriler.musteri_id = merkezler.merkez_yetkili_id
                    INNER JOIN urunler on urunler.urun_id = siparis_urunleri.urun_no
                    INNER JOIN kullanicilar on kullanicilar.kullanici_id = siparisler.siparisi_olusturan_kullanici
                    where (kullanicilar.kullanici_departman_id = 12 or kullanicilar.kullanici_departman_id = 17 or kullanicilar.kullanici_departman_id = 18 or kullanicilar.kullanici_id = 2 or kullanicilar.kullanici_id = 9) and siparisler.siparis_aktif = 1 and siparisler.siparisi_olusturan_kullanici = $kullanici_id
                     ".($ayfiltre != 0 ? "AND MONTH(siparisler.kayit_tarihi) = $ayfiltre" : "").
                    " AND YEAR(siparisler.kayit_tarihi) = $yilfiltre
                     ORDER BY siparisler.kayit_tarihi desc";

                   $query = $this->db->query($sql);
                    $viewData["satislar"] = $query->result(); 
            $viewData["data_kullanici"] = get_yonlendiren_kullanici($kullanici_id); 
            $viewData["page"] = "kullanici/profile_new";
            $viewData["subpage"] = "kullanici/profile_new/satis";
            $this->load->view('base_view',$viewData);
        }
   if($filter == "talep"){
    $durum_filter = isset($_GET["subfilter"]) ?  $_GET["subfilter"] : "1";
    $this->load->model('Talep_yonlendirme_model'); 
            $this->db->where(["yonlenen_kullanici_id"=>$kullanici_id,"gorusme_sonuc_no"=>$durum_filter]);
            $data = $this->Talep_yonlendirme_model->get_all([],"DESC"); 
            $viewData["talepler"] = $data;


            $viewData["data_kullanici"] = get_yonlendiren_kullanici($kullanici_id); 
            $viewData["page"] = "kullanici/profile_new";
            $viewData["subpage"] = "kullanici/profile_new/talep";
            $this->load->view('base_view',$viewData);
        }


        if($filter == "egitim"){
                    
            $this->load->model('Egitim_model'); 
            $data = $this->Egitim_model->get_all(["egitim_kayit_sorumlu_kullanici_id"=>$kullanici_id]); 
                    $viewData["egitimler"] = $data;
        
        
                    $viewData["data_kullanici"] = get_yonlendiren_kullanici($kullanici_id); 
                    $viewData["page"] = "kullanici/profile_new";
                    $viewData["subpage"] = "kullanici/profile_new/egitim";
                    $this->load->view('base_view',$viewData);
                }
}



public function siralama_guncelle() {

    if($this->session->userdata('aktif_kullanici_id') == 9 || $this->session->userdata('aktif_kullanici_id') == 1){
   


    // JSON olarak gelen veriyi al
    $json_data = file_get_contents("php://input");
    $data = json_decode($json_data, true);

    if (!isset($data['order'])) {
        echo json_encode(["status" => "error", "message" => "Veri alınamadı"]);
        return;
    }

    // Veritabanını güncelle
    foreach ($data['order'] as $row) {
        $this->db->where('kullanici_id', $row['id']);
        $this->db->update('kullanicilar', ['siralama' => $row['siralama']]);
    }

    echo json_encode(["status" => "success", "message" => $data['order']]);
}
}

 
 public function hizliduzenle($id)
    {
        // Kullanıcıyı çek
        $kullanici = $this->db->where('kullanici_id', $id)->get('kullanicilar')->row();

        if (!$kullanici) {
            show_404();
        }

        // POST geldiyse güncelle
      if ($this->input->post()) {
    $alanlar = $this->db->list_fields('kullanicilar');
    $post = $this->input->post();

    $data = array();
    foreach ($alanlar as $alan) {
        if ($alan != 'kullanici_id' && isset($post[$alan]) && $post[$alan] !== '') {
            $data[$alan] = $post[$alan];
        }
    }

    if (!empty($data)) {
        $data['kullanici_guncelleme_tarihi'] = date("Y-m-d H:i:s");

        $this->db->where('kullanici_id', $id)
                 ->update('kullanicilar', $data);

        $this->session->set_flashdata('success', 'Kullanıcı bilgileri güncellendi.');
    } else {
        $this->session->set_flashdata('info', 'Güncelleme yapılacak bir alan yok.');
    }

    redirect("kullanici/hizliduzenle/".$id);
}


        $this->load->view('base_view', ["kullanici"=>$kullanici,"page"=>"kullanici/hizlikayit"]);
    
    }

    public function muhasebe_rapor($ay_filtre = 0,$secilen_yil = 2025)
	{   



 

  
            yetki_kontrol("muhasebe_rapor_goruntule");
            $data = $this->Kullanici_model->get_all();  
             
             
            $sql = "SELECT kullanicilar.kullanici_ad_soyad,kullanicilar.kullanici_id,siparisler.siparis_kodu,siparisler.siparis_id,musteriler.musteri_ad,musteriler.musteri_id,musteriler.musteri_iletisim_numarasi,siparis_urunleri.odeme_secenek,siparis_urunleri.para_birimi,siparisler.kurulum_tarihi,siparisler.musteri_talep_teslim_tarihi, `satis_fiyati`,`pesinat_fiyati`,`kapora_fiyati`,`takas_bedeli`,`vade_sayisi`,`fatura_tutari`,`urun_adi`,siparisler.kayit_tarihi,siparis_urunleri.yenilenmis_cihaz_mi,siparisler.siparis_kodu,siparis_onay_hareketleri.adim_no
            FROM `siparis_urunleri`
            INNER JOIN siparisler on siparis_urunleri.siparis_kodu = siparisler.siparis_id
            INNER JOIN merkezler on merkezler.merkez_id = siparisler.merkez_no
            INNER JOIN musteriler on musteriler.musteri_id = merkezler.merkez_yetkili_id
            INNER JOIN urunler on urunler.urun_id = siparis_urunleri.urun_no
            INNER JOIN kullanicilar on kullanicilar.kullanici_id = siparisler.siparisi_olusturan_kullanici
JOIN (
    SELECT *, ROW_NUMBER() OVER (PARTITION BY siparis_no ORDER BY adim_no DESC) as row_num
    FROM siparis_onay_hareketleri
) AS siparis_onay_hareketleri
    ON siparis_onay_hareketleri.siparis_no = siparisler.siparis_id
    AND siparis_onay_hareketleri.row_num = 1
JOIN siparis_onay_adimlari
    ON siparis_onay_adimlari.adim_id = siparis_onay_hareketleri.adim_no
            
            where (kullanicilar.kullanici_departman_id = 12 or kullanicilar.kullanici_departman_id = 17 or kullanicilar.kullanici_departman_id = 18 or kullanicilar.kullanici_id = 2 or kullanicilar.kullanici_id = 9) and siparisler.siparis_aktif = 1
            ".($ay_filtre != 0 ? "AND MONTH(siparisler.kayit_tarihi) = $ay_filtre" : "").
            " AND YEAR(siparisler.kayit_tarihi) = $secilen_yil".
            " ORDER BY kullanicilar.kullanici_ad_soyad asc";
         
           $query = $this->db->query($sql);
            $viewData["kullanicilar"] = $query->result(); 
            
            
            
            $sql2 = "SELECT 
            kullanicilar.kullanici_ad_soyad,
            siparis_urunleri.odeme_secenek,
            COUNT(*) AS toplam_satis_adedi,
            SUM(siparis_urunleri.satis_fiyati) AS toplam_satis_fiyati,
            SUM(siparis_urunleri.kapora_fiyati) AS toplam_kapora_fiyati,
            SUM(siparis_urunleri.pesinat_fiyati) AS toplam_pesinat_fiyati,
            SUM(siparis_urunleri.takas_bedeli) AS toplam_takas_bedeli,
            SUM(siparis_urunleri.fatura_tutari) AS toplam_fatura_tutari
        FROM 
            siparis_urunleri
            INNER JOIN siparisler ON siparis_urunleri.siparis_kodu = siparisler.siparis_id
            INNER JOIN merkezler ON merkezler.merkez_id = siparisler.merkez_no
            INNER JOIN musteriler ON musteriler.musteri_id = merkezler.merkez_yetkili_id
            INNER JOIN urunler ON urunler.urun_id = siparis_urunleri.urun_no
            INNER JOIN kullanicilar ON kullanicilar.kullanici_id = siparisler.siparisi_olusturan_kullanici
        WHERE 
          (kullanicilar.kullanici_departman_id = 12 or kullanicilar.kullanici_departman_id = 17 or kullanicilar.kullanici_departman_id = 18 or kullanicilar.kullanici_id = 2 or kullanicilar.kullanici_id = 9)
            AND siparisler.siparis_aktif = 1 AND siparis_urunleri.odeme_secenek = 2 ".($ay_filtre != 0 ? "AND MONTH(siparisler.kayit_tarihi) = $ay_filtre" : "")." AND YEAR(siparisler.kayit_tarihi) = $secilen_yil"."
        GROUP BY 
            kullanicilar.kullanici_ad_soyad";

            $query2 = $this->db->query($sql2);
            $viewData["satis_vadeli_reports"] = $query2->result(); 
            
            
        
            
            $sql3 = "SELECT 
            kullanicilar.kullanici_ad_soyad,
            siparis_urunleri.odeme_secenek,
            COUNT(*) AS toplam_satis_adedi,
            SUM(siparis_urunleri.satis_fiyati) AS toplam_satis_fiyati,
            SUM(siparis_urunleri.kapora_fiyati) AS toplam_kapora_fiyati,
            SUM(siparis_urunleri.pesinat_fiyati) AS toplam_pesinat_fiyati,
            SUM(siparis_urunleri.takas_bedeli) AS toplam_takas_bedeli,
            SUM(siparis_urunleri.fatura_tutari) AS toplam_fatura_tutari
        FROM 
            siparis_urunleri
            INNER JOIN siparisler ON siparis_urunleri.siparis_kodu = siparisler.siparis_id
            INNER JOIN merkezler ON merkezler.merkez_id = siparisler.merkez_no
            INNER JOIN musteriler ON musteriler.musteri_id = merkezler.merkez_yetkili_id
            INNER JOIN urunler ON urunler.urun_id = siparis_urunleri.urun_no
            INNER JOIN kullanicilar ON kullanicilar.kullanici_id = siparisler.siparisi_olusturan_kullanici
        WHERE 
           (kullanicilar.kullanici_departman_id = 12 or kullanicilar.kullanici_departman_id = 17 or kullanicilar.kullanici_departman_id = 18 or kullanicilar.kullanici_id = 2 or kullanicilar.kullanici_id = 9)
            AND siparisler.siparis_aktif = 1  ".($ay_filtre != 0 ? "AND MONTH(siparisler.kayit_tarihi) = $ay_filtre" : "")." AND YEAR(siparisler.kayit_tarihi) = $secilen_yil"."
        GROUP BY 
            kullanicilar.kullanici_ad_soyad";

            $query3 = $this->db->query($sql3);
            $viewData["satis_pesin_reports"] = $query3->result(); 
            
            
            
            







 
            
            $sql4 = "SELECT 
            aylar.ay,
            IFNULL(satis_adedi, 0) AS toplam_satis_adedi
        FROM 
            (SELECT 1 AS ay UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12) AS aylar
        LEFT JOIN 
            (SELECT 
                 kullanicilar.kullanici_ad_soyad,
                 MONTH(siparisler.kayit_tarihi) AS ay,
                 COUNT(*) AS satis_adedi,
                 SUM(siparis_urunleri.satis_fiyati) AS toplam_satis_fiyati,
                 SUM(siparis_urunleri.kapora_fiyati) AS toplam_kapora_fiyati
             FROM 
                 siparis_urunleri
                 INNER JOIN siparisler ON siparis_urunleri.siparis_kodu = siparisler.siparis_id
                 INNER JOIN kullanicilar ON kullanicilar.kullanici_id = siparisler.siparisi_olusturan_kullanici
             WHERE 
             YEAR(siparisler.kayit_tarihi) = $secilen_yil AND
                 (kullanicilar.kullanici_departman_id = 12 or kullanicilar.kullanici_departman_id = 17 or kullanicilar.kullanici_departman_id = 18 or kullanicilar.kullanici_id = 2 or kullanicilar.kullanici_id = 9)
                 AND siparisler.siparis_aktif = 1  
             GROUP BY 
                
                 MONTH(siparisler.kayit_tarihi)) AS satislar ON aylar.ay = satislar.ay
        ORDER BY 
            aylar.ay";

            $query4 = $this->db->query($sql4);
            $viewData["satis_ay_reports"] = $query4->result(); 










            


            $sql5 = "SELECT
                 ROW_NUMBER() OVER(PARTITION BY 'urun_adi' ) AS row_num ,
                urunler.urun_adi,
                COALESCE(satis_adedi, 0) AS satis_adedi
            FROM
                urunler
            LEFT JOIN (
                SELECT
                    siparis_urunleri.urun_no,
                    COUNT(*) AS satis_adedi
                FROM
                    siparis_urunleri
                    INNER JOIN siparisler ON siparis_urunleri.siparis_kodu = siparisler.siparis_id
                    INNER JOIN kullanicilar ON kullanicilar.kullanici_id = siparisler.siparisi_olusturan_kullanici
                WHERE
                     YEAR(siparisler.kayit_tarihi) = $secilen_yil AND
                    (kullanicilar.kullanici_departman_id = 12 or kullanicilar.kullanici_departman_id = 17 or kullanicilar.kullanici_departman_id = 18 or kullanicilar.kullanici_id = 2 or kullanicilar.kullanici_id = 9)
                    AND siparisler.siparis_aktif = 1  
                GROUP BY
                    siparis_urunleri.urun_no
            ) AS satis ON urunler.urun_id = satis.urun_no
            ORDER BY
                satis_adedi DESC;
            
            ";

            $query5 = $this->db->query($sql5);
            $viewData["satis_urun_reports"] = $query5->result(); 



             
            $sql6 = "SELECT 
            kullanicilar.kullanici_bolge,
           COUNT(*) AS toplam_satis_adedi
       FROM 
           siparis_urunleri
           INNER JOIN siparisler ON siparis_urunleri.siparis_kodu = siparisler.siparis_id
           INNER JOIN kullanicilar ON kullanicilar.kullanici_id = siparisler.siparisi_olusturan_kullanici
           INNER JOIN departmanlar ON kullanicilar.kullanici_departman_id = departmanlar.departman_id
       WHERE siparisler.siparis_aktif = 1 AND kullanicilar.kullanici_bolge <> '' ".($ay_filtre != 0 ? "AND MONTH(siparisler.kayit_tarihi) = $ay_filtre" : "")." AND YEAR(siparisler.kayit_tarihi) = $secilen_yil"."
       GROUP BY 
          kullanicilar.kullanici_bolge";

            $query6 = $this->db->query($sql6);


/*
              $this->load->model('Ayar_model');  
        date_default_timezone_set('Europe/Istanbul');
 try {
    function curlitjson($url, $content) {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);				
        $json_response = curl_exec($curl);
        curl_close($curl);				
        return $json_response;
    }

    // Ayın ilk ve son günü (Netgsm için uygun format)
    $start_date = date('dmY0000', strtotime("first day of this month"));
    $end_date   = date('dmY2359', strtotime("last day of this month"));

    $ayar = $this->Ayar_model->get_by_id(1);
    $arr_acc = array(
        'usercode' => $ayar[0]->netgsm_kullanici_ad,
        'password' => base64_decode($ayar[0]->netgsm_kullanici_sifre),
        'startdate' => $start_date,
        'stopdate'  => $end_date
    );

    $url_acc = "https://api.netgsm.com.tr/netsantral/report";  
    $content_acc = json_encode($arr_acc);				  
    $send_acc = curlitjson($url_acc, $content_acc);
    $send_acc = json_decode($send_acc, true);

    $viewData["santral_kayitlar"] = $send_acc;

} catch (Exception $exc) {
    echo $exc->getMessage();
}



*/







            $viewData["satis_bolge_adet_reports"] = $query6->result(); 
            
            $viewData["secilen_yil"] = $secilen_yil;
            $viewData["current_month"] = $ay_filtre;





            $viewData["page"] = "kullanici/muhasebe_rapor";
            $this->load->view('base_view',$viewData);

    }












	public function save($id = '')
	{   

         
        // Kullanıcı Yetki Kontrol
        if(empty($id)){
            yetki_kontrol("kullanici_ekle");
        }else{
            yetki_kontrol("kullanici_duzenle");
        }


        $this->form_validation->set_rules('kullanici_ad_soyad',            'Kullanıcı Ad Soyad',             'required'); 
        $this->form_validation->set_rules('kullanici_email_adresi',        'Kullanıcı Email Adresi',         'required'); 
        $this->form_validation->set_rules('kullanici_departman_id',        'Kullanıcı Departman',            'required');
        $this->form_validation->set_rules('kullanici_grup_no',             'Kullanıcı Grup',                 'required');
        $this->form_validation->set_rules('kullanici_adi',                 'Kullanıcı Adı',                  'required');
        $this->form_validation->set_rules('kullanici_sifre',               'Kullanıcı Şifre',                'required'); 
        $this->form_validation->set_rules('kullanici_yonetici_kullanici_id',  'Kullanıcı Yöneticisi',                'required'); 
        $data['kullanici_adi']                  = escape($this->input->post('kullanici_adi'));
        $data['kullanici_sifre']                = base64_encode(escape($this->input->post('kullanici_sifre')));
        $data['kullanici_email_adresi']         = escape($this->input->post('kullanici_email_adresi'));
        $data['kullanici_ad_soyad']             = escape($this->input->post('kullanici_ad_soyad'));
        $data['kullanici_dahili_iletisim_no']   = escape($this->input->post('kullanici_dahili_iletisim_no'));
        $data['kullanici_bireysel_iletisim_no'] = escape($this->input->post('kullanici_bireysel_iletisim_no'));
        $data['kullanici_departman_id']         = escape($this->input->post('kullanici_departman_id'));
        $data['kullanici_grup_no']              = escape($this->input->post('kullanici_grup_no'));
        $data['kullanici_yonetici_kullanici_id']              = escape($this->input->post('kullanici_yonetici_kullanici_id'));
        $data['kullanici_unvan']              = escape($this->input->post('kullanici_unvan'));
        $data['kullanici_api_pc_key']              = escape($this->input->post('kullanici_api_pc_key'));
        $data['kullanici_ise_giris_tarihi']              = $this->input->post('kullanici_ise_giris_tarihi');
        $data['kullanici_dogum_tarihi']              = $this->input->post('kullanici_dogum_tarihi');
 $data['kullanici_kart']              = $this->input->post('kullanici_kart');
 $data['kullanici_adres']              = $this->input->post('kullanici_adres');




        if($this->input->post('fileNames')!= null){
            $data['kullanici_resim']  =  escape($this->input->post('fileNames'));  
        }

        
        if ($this->form_validation->run() != FALSE && !empty($id)) {
            $check_id = $this->Kullanici_model->get_by_id($id);
            if($check_id){
                unset($data['id']);
                $this->Kullanici_model->update($id,$data);
                
                $yetkiler = json_decode(json_encode($this->input->post('yetki[]')));
                $kullanici_yetkileri = [];
 
              if($yetkiler != null){
                    foreach ($yetkiler as $yetki) {
                                        $kullanici_yetkileri[] = [
                                            'kullanici_id' => $id,
                                            'yetki_kodu'  => $yetki
                                        ];
                                    }
              }
               
                     
                $this->Kullanici_yetkileri_model->delete_user_permission($id);
                if($yetkiler != null){
                    $this->db->insert_batch('kullanici_yetki_tanimlari', $kullanici_yetkileri);
                }   
               
            }
        }elseif($this->form_validation->run() != FALSE && empty($id)){
            $inserted_id = $this->Kullanici_model->insert($data);

            $yetkiler = json_decode(json_encode($this->input->post('yetki[]')));
            $kullanici_yetkileri = [];
            if($yetkiler){
                foreach ($yetkiler as $yetki) {
                    $kullanici_yetkileri[] = [
                        'kullanici_id' => $inserted_id,
                        'yetki_kodu'  => $yetki
                    ];
                }
                $this->Kullanici_yetkileri_model->delete_user_permission($id);
    
                $this->db->insert_batch('kullanici_yetki_tanimlari', $kullanici_yetkileri);
            }
            

        }else{
            echo json_encode($this->form_validation->error_array());
            return;
        }
		redirect(site_url('kullanici'));
	}
}
