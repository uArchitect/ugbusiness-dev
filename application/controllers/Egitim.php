<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Egitim extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Egitim_model'); 
        $this->load->model('Siparis_model');  
         $this->load->model('Merkez_model');      $this->load->model('Cihaz_model'); 
        date_default_timezone_set('Europe/Istanbul');
    }
 
	public function index()
	{  
        yetki_kontrol("egitim_bilgilerini_goruntule");
        
        if(goruntuleme_kontrol("tum_egitim_bilgilerini_goruntule")){
            $data = $this->Egitim_model->get_all(); 
        }else{
            $data = $this->Egitim_model->get_all(["egitim_kayit_sorumlu_kullanici_id"=>$this->session->userdata('aktif_kullanici_id')]); 
        }



        
    
		$viewData["egitimler"] = $data;
		$viewData["page"] = "egitim/list";
        $viewData["filtre"] = "tum";
		$this->load->view('base_view',$viewData);
	}

    public function onay_bekleyenler_sertifikalar()
	{  
        yetki_kontrol("onay_bekleyen_sertifikalari_goruntule");
       
        if(goruntuleme_kontrol("tum_egitim_bilgilerini_goruntule")){
            $data = $this->Egitim_model->get_all(["sertifika_onay_durumu"=>"0"]); 
        }else{
            $data = $this->Egitim_model->get_all(["sertifika_onay_durumu"=>"0","egitim_kayit_sorumlu_kullanici_id"=>$this->session->userdata('aktif_kullanici_id')]); 
        }

      
		$viewData["egitimler"] = $data;
		$viewData["page"] = "egitim/list";
        $viewData["filtre"] = "onay_sertifika";
		$this->load->view('base_view',$viewData);
	}
    public function uretilecek_sertifikalar()
	{   
        yetki_kontrol("uretilecek_sertifikalari_goruntule");
        if(goruntuleme_kontrol("tum_egitim_bilgilerini_goruntule")){
            $data = $this->Egitim_model->get_all(["sertifika_onay_durumu"=>1,"sertifika_uretim_durumu" => 0]); 
        }else{
            $data = $this->Egitim_model->get_all(["sertifika_onay_durumu"=>1,"sertifika_uretim_durumu" => 0,"egitim_kayit_sorumlu_kullanici_id"=>$this->session->userdata('aktif_kullanici_id')]); 
        }

     
		$viewData["egitimler"] = $data;
		$viewData["page"] = "egitim/list";
        $viewData["filtre"] = "uretim_sertifika";
		$this->load->view('base_view',$viewData);
	}
    public function uretilecek_kalemler()
	{   
        yetki_kontrol("uretilecek_kalemleri_goruntule");
        if(goruntuleme_kontrol("tum_egitim_bilgilerini_goruntule")){
            $data = $this->Egitim_model->get_all(["sertifika_kalem_uretim_durumu" => 0,"sertifika_onay_durumu" => 1]); 
        }else{
            $data = $this->Egitim_model->get_all(["sertifika_kalem_uretim_durumu" => 0,"egitim_kayit_sorumlu_kullanici_id"=>$this->session->userdata('aktif_kullanici_id')]); 
        }


     
		$viewData["egitimler"] = $data;
		$viewData["page"] = "egitim/list";
        $viewData["filtre"] = "uretim_kalem";
		$this->load->view('base_view',$viewData);
	}
    public function kargo_bekleyen_sertifikalar()
	{   
        yetki_kontrol("kargo_bekleyen_sertifikalari_goruntule");
       
            $data = $this->Egitim_model->get_all(["sertifika_onay_durumu"=>1,"sertifika_uretim_durumu" => 1,"sertifika_kargo_durumu" => 0]); 
		
       

      $viewData["egitimler"] = $data;
        $viewData["filtre"] = "kargo";
		$viewData["page"] = "egitim/list";
		$this->load->view('base_view',$viewData);
	}


	public function add($cihaz_id = '')
	{   
        $control = $this->Cihaz_model->get_all(["siparis_urun_id"=>$cihaz_id]); 
		$check_id = $this->Merkez_model->get_by_id($control[0]->merkez_id); 
        $controlegitim = $this->db->where("siparis_urun_no",$cihaz_id)->get("cihaz_egitimleri")->result();
        
        $urun = $this->db
        ->select("siparis_urunleri.siparis_urun_id,urunler.urun_adi,urunler.urun_aciklama,siparis_urunleri.seri_numarasi")
        ->where("siparis_urun_id", $cihaz_id)
        ->join("urunler","siparis_urunleri.urun_no = urunler.urun_id")->get("siparis_urunleri")->result();
        
        if($check_id){  
            $viewData['merkez'] = $check_id;
            $viewData['urunler'] = $urun;

			$viewData["page"] = "egitim/form"; 
            $this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('egitim'));
        }
	}

	public function edit($egitim_id = '')
	{   
        
       
		$egitim = $this->Egitim_model->get_by_id($egitim_id);
        $control = $this->Cihaz_model->get_all(["siparis_urun_id"=>$egitim[0]->siparis_urun_no]); 
		$merkez = $this->Merkez_model->get_by_id($control[0]->merkez_id); 
       
        $urun = $this->db
        ->select("siparis_urunleri.siparis_urun_id,urunler.urun_adi,urunler.urun_aciklama,siparis_urunleri.seri_numarasi")
        ->where("siparis_urun_id", $egitim[0]->siparis_urun_no)
        ->join("urunler","siparis_urunleri.urun_no = urunler.urun_id")->get("siparis_urunleri")->result();
    

        if($egitim){  
            $viewData['merkez'] = $merkez;
            $viewData['egitim'] = $egitim[0];
            $viewData['urunler'] = $urun;

			$viewData["page"] = "egitim/form"; 
            $this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('egitim'));
        }
	}

    public function delete($id)
	{      
        yetki_kontrol("egitim_sil");
		$this->Egitim_model->delete($id);  
        redirect(site_url('egitim'));
	}
    public function egitim_islem_durumu_guncelle($egitim_id)
	{   
        $egitim = $this->Egitim_model->get_by_id($egitim_id);
        if($egitim != null){
         if($egitim[0]->sertifika_onay_durumu == 0){
            $this->session->set_flashdata('flashDanger', "Sertifika onaylanmadığı için işleme alınamaz.");
            redirect($_SERVER['HTTP_REFERER']);
         }
            $data['sertifika_isleme_alindi'] =  ($egitim[0]->sertifika_isleme_alindi == 0) ? 1 : 0;
            $this->Egitim_model->update($egitim_id,$data);
            redirect($_SERVER['HTTP_REFERER']);
        }
    }



    public function egitim_onay($egitim_id)
	{   
        yetki_kontrol("sertifika_kontrol_onayla");
        $egitim = $this->Egitim_model->get_by_id($egitim_id);
        if($egitim != null){
            if($egitim[0]->sertifika_uretim_durumu == 1 && $egitim[0]->sertifika_onay_durumu == 1){
return;
            }

            $data['sertifika_onay_durumu'] =  ($egitim[0]->sertifika_onay_durumu == 0) ? 1 : 0;
            $data['sertifika_onay_tarihi'] = date("Y-m-d H:i:s");
            $data['sertifika_onay_sorumlu_kullanici_id'] = $this->session->userdata('aktif_kullanici_id');
            $this->Egitim_model->update($egitim_id,$data);
            redirect($_SERVER['HTTP_REFERER']);
        }
    }



    public function hizli_sertifika_olustur($urun_id)
	{   
         $egitimler = $this->Egitim_model->get_all(["sertifika_onay_durumu"=>1,"sertifika_uretim_durumu" => 0]); 
        $data = [];
        ini_set('mbstring.language','Turkish');
        foreach ($egitimler as $egitim) {
            if($egitim->sertifika_isleme_alindi == 1 && $egitim->urun_id == $urun_id){
              
              $kursiyerler = json_decode($egitim->kursiyerler, true);

              foreach ($kursiyerler as $ad) {
               
                $ad = trim(mb_strtoupper(str_replace("i", "İ", $ad), 'UTF-8'));
                $ad = sonKelimeBuyuk($ad);
                $ilkHarf = mb_substr($ad, 0, 1, "UTF-8");
                $kalan = mb_substr($ad, 1, null, "UTF-8");
                switch ($ilkHarf) {
                    case 'ç':
                        $ilkHarf = 'Ç';
                        break;
                    case 'ğ':
                        $ilkHarf = 'Ğ';
                        break;
                    case 'ı':
                        $ilkHarf = 'I';
                        break;
                    case 'i':
                        $ilkHarf = 'İ';
                        break;
                    case 'ö':
                        $ilkHarf = 'Ö';
                        break;
                    case 'ş':
                        $ilkHarf = 'Ş';
                        break;
                    case 'ü':
                        $ilkHarf = 'Ü';
                        break;
                    default:
                        $ilkHarf = mb_strtoupper($ilkHarf, "UTF-8");
                        break;
                }
                $data[] = $ilkHarf . $kalan;
            }
            }
           
              }

               $viewData["isimler"] = json_encode($data);
               switch ($urun_id) {
                case '1':
                    $viewData["certname"] = "umex-lazer";
                    break;
                case '2':
                    $viewData["certname"] = "umex-diode";
                    break;
                case '3':
                    $viewData["certname"] = "umex-ems";
                    break;
                case '4':
                    $viewData["certname"] = "umex-gold";
                    break;
                case '5':
                    $viewData["certname"] = "umex-slim";
                    break;
                case '6':
                    $viewData["certname"] = "umex-s";
                    break;
                case '7':
                    $viewData["certname"] = "umex-q";
                    break;
                case '8':
                    $viewData["certname"] = "umex-plus";
                    break;               
                default:
                    # code...
                    break;
               }
              $this->load->view('egitim/create_certificate',$viewData);

    }

    public function ozel_sertifika_olustur()
	{   
        $data = [];
        $lines = explode(PHP_EOL, $this->input->post("kursiyer_adlari"));
        ini_set('mbstring.language','Turkish');
        foreach ($lines as $ad) {
            $data[] = $ad;
        }
           
               $viewData["isimler"] = json_encode($data);
               switch ($this->input->post("urun_id")) {
                case '1':
                    $viewData["certname"] = "umex-lazer";
                    break;
                case '2':
                    $viewData["certname"] = "umex-diode";
                    break;
                case '3':
                    $viewData["certname"] = "umex-ems";
                    break;
                case '4':
                    $viewData["certname"] = "umex-gold";
                    break;
                case '5':
                    $viewData["certname"] = "umex-slim";
                    break;
                case '6':
                    $viewData["certname"] = "umex-s";
                    break;
                case '7':
                    $viewData["certname"] = "umex-q";
                    break;
                case '8':
                    $viewData["certname"] = "umex-plus";
                    break;               
                default:
                    # code...
                    break;
               }
              $this->load->view('egitim/create_certificate',$viewData);

    }

    public function coklu_sertifika_olustur()
	{   
        $data = [];
        $lines = explode(PHP_EOL, $this->input->post("kursiyer_adlari"));

        ini_set('mbstring.language','Turkish');
      
            foreach ($lines as $ad) {
                $data[] = $ad;
            }
           
              $brands = "";
              if($this->input->post("umex-plus")){
                $brands .="Umex Plus  ";
              }

              if($this->input->post("umex-lazer")){
                $brands .="Umex Lazer  ";
              }
              if($this->input->post("umex-slim")){
                $brands .="Umex Slim  ";
              }
              if($this->input->post("umex-ems")){
                $brands .="Umex Ems  ";
              }
              if($this->input->post("umex-q")){
                $brands .="Umex Q  ";
              }
              if($this->input->post("umex-gold")){
                $brands .="Umex Gold  ";
              }
             
              if($this->input->post("umex-s")){
                $brands .="Umex S  ";
              }
              if($this->input->post("umex-diode")){
                $brands .="Umex Diode  ";
              }
             
              
              $brands = str_replace("  ",", ",trim($brands));

               $viewData["isimler"] = json_encode($data);
               $viewData["brand_names"] = $brands;
               
              $this->load->view('egitim/create_certificate_multi',$viewData);

    }



    public function uretim_onay($egitim_id)
	{   
        yetki_kontrol("sertifika_uretim_onayla");
        $egitim = $this->Egitim_model->get_by_id($egitim_id);
        if($egitim[0]->sertifika_isleme_alindi == 0){
             show_error('No status text available. Please check your status code number or supply your own message text.', 500);
           
        }
        if($egitim != null){
            $data['sertifika_uretim_durumu'] = ($egitim[0]->sertifika_uretim_durumu == 0) ? 1 : 0;
            $data['sertifika_uretim_tarihi'] = date("Y-m-d H:i:s");
            $data['sertifika_uretim_sorumlu_kullanici_id'] = $this->session->userdata('aktif_kullanici_id');
            $this->Egitim_model->update($egitim_id,$data);
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function kalem_onay($egitim_id)
	{   
        yetki_kontrol("kalem_uretim_onayla");
        $egitim = $this->Egitim_model->get_by_id($egitim_id);
       
        if($egitim != null){
            $data['sertifika_kalem_uretim_durumu'] = ($egitim[0]->sertifika_kalem_uretim_durumu == 0) ? 1 : 0;
            $data['sertifika_kalem_uretim_tarihi'] = date("Y-m-d H:i:s");
            $data['sertifika_kalem_sorumlu_kullanici_id'] = $this->session->userdata('aktif_kullanici_id');
            $this->Egitim_model->update($egitim_id,$data);
            redirect($_SERVER['HTTP_REFERER']);
        }
    }    
    public function kargo_onay($egitim_id)
	{   
        yetki_kontrol("sertifika_kargo_onayla");
        $egitim = $this->Egitim_model->get_by_id($egitim_id);
        if($egitim != null){
            $data['sertifika_kargo_durumu'] = ($egitim[0]->sertifika_kargo_durumu == 0) ? 1 : 0;
            $data['sertifika_kargo_tarihi'] = date("Y-m-d H:i:s");
            $data['sertifika_kargo_sorumlu_kullanici_id'] = $this->session->userdata('aktif_kullanici_id');
            $this->Egitim_model->update($egitim_id,$data);
            redirect($_SERVER['HTTP_REFERER']);
        }
    }




	public function save($id,$cihaz_id = '')
	{    
        if($id != 0){
            yetki_kontrol("egitim_bilgilerini_duzenle");
        }else{
            yetki_kontrol("egitim_kaydi_ekle");
        }
        
        if($id != 0){
            $egitim = $this->Egitim_model->get_by_id($id);
            if($egitim != null){ 
                $data['kursiyerler'] = json_encode($this->input->post("urun".$cihaz_id)); 
                $this->Egitim_model->update($id,$data);
                redirect(base_url("egitim"));
            }
        }else{
             	
            if($this->input->post("urun".$cihaz_id) != null){
                $dataegitim = array(
                    'siparis_urun_no'=>$cihaz_id,
                    'kursiyerler'=>json_encode($this->input->post("urun".$cihaz_id)),
                    'egitim_kayit_sorumlu_kullanici_id' =>$this->session->userdata('aktif_kullanici_id')
                );
                $this->db->insert('cihaz_egitimleri',$dataegitim);
            }
            redirect(base_url("egitim"));

        }
   }
}
