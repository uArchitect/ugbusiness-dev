<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Talep extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Talep_model'); 
        $this->load->model('Musteri_model'); 
        $this->load->model('Merkez_model'); 

        $this->load->model('Talep_yonlendirme_model'); 
        $this->load->model('Talep_kaynak_model');  
         $this->load->model('Talep_sonuc_model'); 
        $this->load->model('Urun_model'); 
        $this->load->model('Sehir_model'); 
        $this->load->model('Ilce_model'); 
        $this->load->model('Kullanici_model'); 
        date_default_timezone_set('Europe/Istanbul');
    }
 











    public function numara_kontrol($numara)
    {
         
        if (empty($numara) )
        {
            $data = array('status' => 'error', 'message' => 'Numara Bilgisi Alınamadı..!');
        }
        else
        {
            
                $data = array('status' => 'ok', 'message' => '', 'data' => $talep);
           
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));

    }








	public function index($filter = 0)
	{
        yetki_kontrol("talep_havuzu_goruntule");
    
        if($filter == 0){
            $data = $this->Talep_model->get_all(["talep_yonlendirildi_mi"=>0]); 
            $viewData["talepler"] = $data;
            $viewData["tekrar_kontrol"] = true;
        }else{
            $data = $this->Talep_model->get_all([],"DESC"); 
            $viewData["talepler"] = $data;
            $viewData["tekrar_kontrol"] = false;
        }
             
        $query = $this->db->order_by('kullanici_adi', 'ASC')->where(["kullanici_departman_id"=>12])->or_where(["kullanici_departman_id"=>17])
        ->join('departmanlar', 'departmanlar.departman_id = kullanicilar.kullanici_departman_id')
        ->join('kullanici_gruplari', 'kullanici_gruplari.kullanici_grup_id = kullanicilar.kullanici_grup_no')
        ->get("kullanicilar");
        $this->db->group_start();
$this->db->where('kullanici_departman_id', 12);
$this->db->or_where('kullanici_departman_id', 17);
$this->db->or_where('kullanici_id', 2);
$this->db->group_end();
$this->db->where('kullanici_aktif', 1);
        $kullanicilar = $this->Kullanici_model->get_all([]); 
		$viewData["kullanicilar"] = $kullanicilar;

        $devam_eden_talep = $this->Talep_yonlendirme_model->get_all(["gorusme_sonuc_no"=>1]);
        $tamamlanan_talep = $this->Talep_yonlendirme_model->get_all(["gorusme_sonuc_no !="=>1]);

        
        $viewData["devam_eden_toplam"] = count($devam_eden_talep);
        $viewData["tamamlanan_toplam"] = count($tamamlanan_talep);


        $viewData["filter"] = $filter;

		$viewData["page"] = "talep/list";
		$this->load->view('base_view',$viewData);
	}



    public function seyhantalep()
	{

         
/*
            $cn = json_decode($data);
      
            foreach ($cn as $key) {

                $urunid = "";
                if(strtolower($key->Urun)=="umexlazer"){
                    $urunid = '["1"]';
                }
                if(strtolower($key->Urun)=="umexdiode"){
                    $urunid = '["2"]';
                }
                if(strtolower($key->Urun)=="umexems"){
                    $urunid = '["3"]';
                }
                if(strtolower($key->Urun)=="umexgold"){
                    $urunid = '["4"]';
                }
                if(strtolower($key->Urun)=="umexslim"){
                    $urunid = '["5"]';
                }
                if(strtolower($key->Urun)=="umexs"){
                    $urunid = '["6"]';
                }
                if(strtolower($key->Urun)=="umexq"){
                    $urunid = '["7"]';
                }
                if(strtolower($key->Urun)=="umexplus"){
                    $urunid = '["8"]';
                }


                $gorusme_sonuc = "";
                if(strtolower($key->Sonuc)=="0"){
                    $gorusme_sonuc = '1';
                }
                if(strtolower($key->Sonuc)=="1"){
                    $gorusme_sonuc = '3';
                }
                if(strtolower($key->Sonuc)=="2"){
                    $gorusme_sonuc = '6';
                }
                if(strtolower($key->Sonuc)=="3"){
                    $gorusme_sonuc = '8';
                }
                if(strtolower($key->Sonuc)=="4"){
                    $gorusme_sonuc = '5';
                }
                if(strtolower($key->Sonuc)=="5"){
                    $gorusme_sonuc = '2';
                }
                if(strtolower($key->Sonuc)=="6"){
                    $gorusme_sonuc = '4';
                }

 

              

              $data = [];
              $data['talep_kaynak_no']            = (escape($key->Nerden) == "umex.com.tr") ? "1" : "2";
              $data['talep_musteri_ad_soyad']     = escape($key->AdSoyad);
              $data['talep_isletme_adi']          = (escape($key->Salonismi) == "") ? "#NULL#" : escape($key->Salonismi);
              $data['talep_cep_telefon']          = (substr($key->Telefon, 0, 1) == '0') ? escape(str_replace(" ", "", $key->Telefon)) : "0".escape(str_replace(" ", "", $key->Telefon));
              $data['talep_sabit_telefon']        = "";
              $data['talep_fiyat_teklifi']        = 0;
              $data['talep_urun_id']              = $urunid;
              $data['talep_sehir_no']             = escape($key->Il);
              $data['talep_yonlendirildi_mi']     = "1";
              $data['talep_sorumlu_kullanici_id'] = "1";   
              $data['talep_kayit_tarihi'] = date("Y-m-d H:i:s",strtotime($key->TarihSaat));
              $data['talep_uyari_notu']           = "";
              $this->Talep_model->insert($data);

              $inserted_id = $this->db->insert_id(); 


              $gorusmedata = [];
              $gorusmedata['talep_no']                   = $inserted_id;
              $gorusmedata['yonlenen_kullanici_id']      = "19";
              $gorusmedata['yonlendiren_kullanici_id']   = "1";
              $gorusmedata['gorusme_detay']              = escape($key->Aciklama);
              $gorusmedata['gorusme_sonuc_no']        = $gorusme_sonuc;
              $gorusmedata['gorusme_sonuc_guncelleme_tarihi']        = date("Y-m-d H:i:s",strtotime($key->BitisTarih));;
              $gorusmedata['gorusme_puan']              =escape($key->Puan); 
              $gorusmedata['yonlendirme_tarihi']    =date("Y-m-d H:i:s",strtotime($key->TarihSaat));
               $this->Talep_yonlendirme_model->insert($gorusmedata);
            }
*/
    }


    public function bekleyen_rapor()
	{   

 
        
         yetki_kontrol("kullanici_bekleyen_talep_uyari_sms_gonder");

            
            
        $sql = "SELECT kullanicilar.kullanici_ad_soyad, kullanicilar.kullanici_bireysel_iletisim_no, COUNT(*) AS toplam_satir_sayisi
        FROM talep_yonlendirmeler
        INNER JOIN kullanicilar ON talep_yonlendirmeler.yonlenen_kullanici_id = kullanicilar.kullanici_id
        INNER JOIN talepler ON talepler.talep_id = talep_yonlendirmeler.talep_no
        WHERE talep_yonlendirmeler.gorusme_sonuc_no = 1 AND talep_yonlendirmeler.yonlenen_kullanici_id <> 60
        GROUP BY kullanicilar.kullanici_ad_soyad;
        ";

        $query = $this->db->query($sql)->result();

      
        foreach ($query as $d) { 
            sendSmsData($d->kullanici_bireysel_iletisim_no,"TALEP UYARI \n Sn. ".$d->kullanici_ad_soyad.", UG Business sisteminde toplam ".$d->toplam_satir_sayisi." adet bekleyen talebiniz bulunmaktadır. Belirli bir süre işlem yapılmayan talepler geri çekilerek talep havuzuna aktarılır. Bekleyen taleplerinizi görüntülemek için : https://ugbusiness.com.tr/bekleyen-talepler adresini ziyaret edebilirsiniz.");

        }
       
 
        $this->session->set_flashdata('flashSuccess', "Satış temsilcilerine bekleyen talep uyarısı sms ile gönderilmiştir.");
        redirect(site_url('anasayfa'));

    }
 
    

    public function ucgunekle($talep_yonlendirme_id){
        if($this->session->userdata('aktif_kullanici_id') == 1 || $this->session->userdata('aktif_kullanici_id') == 9){
            $this->db->set('yonlendirme_tarihi', 'DATE_ADD(yonlendirme_tarihi, INTERVAL 3 DAY)', false)
            ->where('talep_yonlendirme_id', $talep_yonlendirme_id)
            ->update('talep_yonlendirmeler');
    
            $this->session->set_flashdata('flashSuccess', "Bu numara yönlendirme koruması 3 gün daha uzatılmıştır.");
            
            redirect($_SERVER['HTTP_REFERER']);
        }else{
            $this->session->set_flashdata('flashDanger', "Yetkisiz erişim. Bu işlem sadece yetkili kişi tarafından yapılmaktadır.");
            
            redirect($_SERVER['HTTP_REFERER']);
        }
       

    }

    public function ucguncikar($talep_yonlendirme_id){
        if($this->session->userdata('aktif_kullanici_id') == 1 || $this->session->userdata('aktif_kullanici_id') == 9){
            $this->db->set('yonlendirme_tarihi', 'DATE_SUB(yonlendirme_tarihi, INTERVAL 3 DAY)', false)
            ->where('talep_yonlendirme_id', $talep_yonlendirme_id)
            ->update('talep_yonlendirmeler');
            $this->session->set_flashdata('flashSuccess', "Bu numara yönlendirme koruması 3 gün geriye çekilmiştir.");
            
            redirect($_SERVER['HTTP_REFERER']);
        }else{
            $this->session->set_flashdata('flashDanger', "Yetkisiz erişim. Bu işlem sadece yetkili kişi tarafından yapılmaktadır.");
            
            redirect($_SERVER['HTTP_REFERER']);
        }
        
     
    }

    public function bekleyen_rapor_list($filter = 0)
	{   

            $durumfilter = 1;
            if($filter != 0){
                $durumfilter = $filter;
            }
            if(!empty($_GET["page"])){
                $durumfilter = $_GET["page"];

                if($_GET["page"] == "5" || $_GET["page"] == "8" ){
                    $tarihfilter = "AND talep_yonlendirmeler.yonlendirme_tarihi >= DATE_SUB(NOW(), INTERVAL 1 MONTH)";
                }
            }
           
        
         yetki_kontrol("kullanici_bazli_bekleyen_talep_raporunu_goruntule");

            
            
        $sql = "SELECT kullanicilar.kullanici_ad_soyad, kullanicilar.kullanici_id, kullanicilar.kullanici_bireysel_iletisim_no, COUNT(*) AS toplam_satir_sayisi
        FROM talep_yonlendirmeler
        INNER JOIN kullanicilar ON talep_yonlendirmeler.yonlenen_kullanici_id = kullanicilar.kullanici_id
        INNER JOIN talepler ON talepler.talep_id = talep_yonlendirmeler.talep_no
        WHERE talep_yonlendirmeler.gorusme_sonuc_no = $durumfilter AND talep_yonlendirmeler.yonlenen_kullanici_id <> 60
        AND talep_yonlendirmeler.yonlenen_kullanici_id <> talep_yonlendirmeler.yonlendiren_kullanici_id
        GROUP BY kullanicilar.kullanici_ad_soyad;
        ";

        $query = $this->db->query($sql)->result();
        $viewData["bekleyenler"] = $query;


               
        $sql2 = "SELECT kullanicilar.kullanici_ad_soyad, kullanicilar.kullanici_id, kullanicilar.kullanici_bireysel_iletisim_no,talep_yonlendirmeler.*,talepler.*
        FROM talep_yonlendirmeler
        INNER JOIN kullanicilar ON talep_yonlendirmeler.yonlenen_kullanici_id = kullanicilar.kullanici_id
        INNER JOIN talepler ON talepler.talep_id = talep_yonlendirmeler.talep_no
        WHERE talep_yonlendirmeler.gorusme_sonuc_no = $durumfilter AND talep_yonlendirmeler.yonlenen_kullanici_id <> 60 AND talep_yonlendirmeler.yonlenen_kullanici_id <> 66
        AND talep_yonlendirmeler.yonlenen_kullanici_id <> talep_yonlendirmeler.yonlendiren_kullanici_id
        $tarihfilter
        ";
        $tquery = $this->db->query($sql2)->result();
        $viewData["talepler"] = $tquery;


        $kullanicilar = $this->db->order_by('kullanici_adi', 'ASC')->where("kullanici_aktif",1)->where_in("kullanici_departman_id",['17','12'])
        ->join('departmanlar', 'departmanlar.departman_id = kullanicilar.kullanici_departman_id')
        ->join('kullanici_gruplari', 'kullanici_gruplari.kullanici_grup_id = kullanicilar.kullanici_grup_no')
        ->get("kullanicilar")->result();

       // $kullanicilar = $this->Kullanici_model->get_all(["kullanici_departman_id"=>12]);  
		$viewData["kullanicilar"] = $kullanicilar;
        
		$viewData["page"] = "talep/kullanici_bekleyen_talepler";
		$this->load->view('base_view',$viewData);

    }



    public function yonlendirmeler($filter = 0)
	{
        yetki_kontrol("talep_havuzu_goruntule");
        $secilen_kullanici = 0; 

        if(!empty($this->input->post("yonlendiren_kullanici_id"))){
            $this->db->where(["yonlendiren_kullanici_id"=>$this->input->post("yonlendiren_kullanici_id")]);
            if(!empty($this->input->post("yonlenen_kullanici_id"))){
                $this->db->where(["yonlenen_kullanici_id"=>$this->input->post("yonlenen_kullanici_id")]);
            }
            
            $viewData["yonlendiren_kullanici_id"] = $this->input->post("yonlendiren_kullanici_id");

        }
        if(!empty($this->input->post("yonlenen_kullanici_id"))){
            $this->db->where(["yonlenen_kullanici_id"=>$this->input->post("yonlenen_kullanici_id")]);
            $viewData["yonlenen_kullanici_id"] = $this->input->post("yonlenen_kullanici_id");
            $secilen_kullanici = $this->input->post("yonlenen_kullanici_id");


           

            
        }
        if(!empty($this->input->post("baslangic_tarihi"))){
            $this->db->where(["yonlendirme_tarihi >="=>date("Y-m-d 00:00:00",strtotime($this->input->post("baslangic_tarihi")))]);
            $viewData["baslangic_tarihi"] = $this->input->post("baslangic_tarihi");

        }
        if(!empty($this->input->post("bitis_tarihi"))){
            $this->db->where(["yonlendirme_tarihi <="=>date("Y-m-d 23:59:59",strtotime($this->input->post("bitis_tarihi")))]);
            $viewData["bitis_tarihi"] = $this->input->post("bitis_tarihi");
        } 
        
        if(!empty($this->input->post("talep_durum"))){
            $this->db->where(["gorusme_sonuc_no"=>$this->input->post("talep_durum")]);
            $viewData["talep_durum"] = $this->input->post("talep_durum");
        }else{
            if($filter == 1){
                if(empty($this->input->post("sehir_no"))){
                    if(empty($this->input->get("sehir_no"))){
                        $this->db->where(["gorusme_sonuc_no"=>1]);
                        $viewData["talep_durum"] = 1;
                    }
                   
                } 
            }
            
        
        }

        if(!empty($this->input->get("sehir_no"))){
            //$this->db->where(["talep_sehir_no"=>$this->input->get("sehir_no")]);
            $viewData["secilen_sehir"] = $this->input->get("sehir_no");
        } 

        if(!empty($this->input->post("sehir_no"))){
            //$this->db->where(["talep_sehir_no"=>$this->input->post("sehir_no")]);
            $viewData["secilen_sehir"] = $this->input->post("sehir_no");
        } 
        

  if(!empty($this->input->post("reklam_mi"))){
        
            $viewData["secilen_reklam"] = "1";
        } 

        
        $data = $this->Talep_yonlendirme_model->get_all([],"DESC"); 
        $viewData["talepler"] = $data;
        $viewData["tekrar_kontrol"] = false;
    
             
       
       


        $kullanicilar = $this->Kullanici_model->get_all(["kullanici_departman_id"=>12]); 
		$viewData["kullanicilar"] = $kullanicilar;

        $kullanicilar2 = $this->Kullanici_model->get_all(); 

        $queryq = $this->db->where("yetki_kodu","talep_yonlendirme")->order_by('kullanici_ad_soyad', 'ASC')
		->join('kullanicilar', 'kullanicilar.kullanici_id = kullanici_yetki_tanimlari.kullanici_id')
		->get("kullanici_yetki_tanimlari");
		$dkul = $queryq->result();

		$viewData["tum_kullanicilar_yonlendiren"] = $dkul;


        $queryq = $this->db->where("yetki_kodu","siparis_onay_1")->order_by('kullanici_aktif', 'DESC')->order_by('kullanici_ad_soyad', 'ASC')
		->join('kullanicilar', 'kullanicilar.kullanici_id = kullanici_yetki_tanimlari.kullanici_id')
		->get("kullanici_yetki_tanimlari");
		$dkul2 = $queryq->result();

		$viewData["tum_kullanicilar_yonlenen"] = $dkul2;




        $devam_eden_talep = $this->Talep_yonlendirme_model->get_all(["gorusme_sonuc_no"=>1]);
        $tamamlanan_talep = $this->Talep_yonlendirme_model->get_all(["gorusme_sonuc_no !="=>1]);

        
        $viewData["devam_eden_toplam"] = count($devam_eden_talep);
        $viewData["tamamlanan_toplam"] = count($tamamlanan_talep);


    
    $viewData["secilen_kullanici"] =  $secilen_kullanici;
    $kquery = $this->db->order_by('kullanici_adi', 'ASC')->where(["kullanici_id"=>$secilen_kullanici])
    ->join('departmanlar', 'departmanlar.departman_id = kullanicilar.kullanici_departman_id')
    ->join('kullanici_gruplari', 'kullanici_gruplari.kullanici_grup_id = kullanicilar.kullanici_grup_no')
    ->get("kullanicilar")->result();
    $viewData["kullanici_data"] =  $kquery[0]; 
		$viewData["page"] = "talep/yonlendirilenler_list";
		$this->load->view('base_view',$viewData);
	}







    public function get_talepler_yonlendirmeler()
	{
        yetki_kontrol("talep_havuzu_goruntule");
       
        if(!empty($this->input->post("yonlendiren_kullanici_id"))){
            $this->db->where(["yonlendiren_kullanici_id"=>$this->input->post("yonlendiren_kullanici_id")]);
            $this->db->where(["yonlenen_kullanici_id !="=>$this->input->post("yonlendiren_kullanici_id")]);
            $viewData["yonlendiren_kullanici_id"] = $this->input->post("yonlendiren_kullanici_id");

        }
        if(!empty($this->input->post("yonlenen_kullanici_id"))){
            $this->db->where(["yonlenen_kullanici_id"=>$this->input->post("yonlenen_kullanici_id")]);
            $viewData["yonlenen_kullanici_id"] = $this->input->post("yonlenen_kullanici_id");

        }
        if(!empty($this->input->post("baslangic_tarihi"))){
            $this->db->where(["yonlendirme_tarihi >="=>date("Y-m-d 00:00:00",strtotime($this->input->post("baslangic_tarihi")))]);
            $viewData["baslangic_tarihi"] = $this->input->post("baslangic_tarihi");

        }
        if(!empty($this->input->post("bitis_tarihi"))){
            $this->db->where(["yonlendirme_tarihi <="=>date("Y-m-d 23:59:59",strtotime($this->input->post("bitis_tarihi")))]);
            $viewData["bitis_tarihi"] = $this->input->post("bitis_tarihi");
        }
       
       
        






	}













    public function yonlendirilen_talepler()
	{ 
        if(aktif_kullanici()->kullanici_id == 60){
            $data = $this->Talep_yonlendirme_model->get_all(
                ["yonlendiren_kullanici_id"=>$this->session->userdata('aktif_kullanici_id')],
                ["yonlendiren_kullanici_id"=>61],
                ["yonlendiren_kullanici_id"=>62],
                ["yonlendiren_kullanici_id"=>64],
                ["yonlendiren_kullanici_id"=>80]
            ); 
        
        }else{
            $data = $this->Talep_yonlendirme_model->get_all(["yonlendiren_kullanici_id"=>$this->session->userdata('aktif_kullanici_id')]); 
        
        }
        
        
        $viewData["talepler"] = $data; 
        
        $kullanicilar = $this->Kullanici_model->get_all(); 
		$viewData["kullanicilar"] = $kullanicilar;
        
        $viewData["filter"] =  "";
 
		$viewData["page"] = "talep/list_boxed";
		$this->load->view('base_view',$viewData);
    }




    public function index_boxed($filter = "",$is_admin = 0)
	{ 
        if($is_admin == 0){
            $data = $this->Talep_yonlendirme_model->get_all(["yonlenen_kullanici_id"=>$this->session->userdata('aktif_kullanici_id')]); 
	 
        }else{
            $data = $this->Talep_yonlendirme_model->get_all([]); 
	 
        }
        if($this->session->userdata('aktif_kullanici_id') == 1341){
 echo json_encode( $data);
    return;
        }
   
    
        $viewData["talepler"] = $data; 
        
        $kullanicilar = $this->Kullanici_model->get_all(); 
		$viewData["kullanicilar"] = $kullanicilar;
        
        $viewData["filter"] = $filter;
 
		$viewData["page"] = "talep/list_boxed";
		$this->load->view('base_view',$viewData);
	}

    public function report()
	{/*
        $viewData["ay1"] = $this->db->query($this->buildDynamicQuery(1))->row();
        $viewData["ay2"] = $this->db->query($this->buildDynamicQuery(2))->row();
        $viewData["ay3"] = $this->db->query($this->buildDynamicQuery(3))->row();
        $viewData["ay4"] = $this->db->query($this->buildDynamicQuery(4))->row();
        $viewData["ay5"] = $this->db->query($this->buildDynamicQuery(5))->row();
        $viewData["ay6"] = $this->db->query($this->buildDynamicQuery(6))->row();
        $viewData["ay7"] = $this->db->query($this->buildDynamicQuery(7))->row();
        $viewData["ay8"] = $this->db->query($this->buildDynamicQuery(8))->row();
        $viewData["ay9"] = $this->db->query($this->buildDynamicQuery(9))->row();
        $viewData["ay10"] = $this->db->query($this->buildDynamicQuery(10))->row();
        $viewData["ay11"] = $this->db->query($this->buildDynamicQuery(11))->row();
        $viewData["ay12"] = $this->db->query($this->buildDynamicQuery(12))->row();
      //  echo json_encode($viewData); return;


        $data = $this->Talep_yonlendirme_model->get_all([]); 
        $viewData["talepler"] = $data;*/







        
        
        yetki_kontrol("talep_rapor_goruntule");
        $viewData["aciklama"] = "Tüm talepler raporlanmıştır.";
        
        $where ="";
        $where2 ="";
        if(!empty($this->input->get("filterMonth"))){
            if($this->input->get("filterMonth") != ""){

                 
                $ilk_gun = date("Y-m-01", strtotime(date("Y")."-".$this->input->get("filterMonth")."-01"));

             
                $son_gun = date("Y-m-t", strtotime(date("Y")."-".$this->input->get("filterMonth")."-01"));



                $where = "talep_kayit_tarihi >= '".date("Y-m-d 00:00:00",strtotime($ilk_gun))."'";
                $where2 = "talep_kayit_tarihi <= '".date("Y-m-d 23:59:59",strtotime($son_gun))."'";
                $viewData["baslangic_tarihi"] = date("Y-m-d 00:00:00",strtotime($ilk_gun));
                $viewData["bitis_tarihi"] = date("Y-m-d 23:59:59",strtotime($son_gun));
                
                $viewData["aciklama"] = date("d.m.Y",strtotime($ilk_gun))." ile ".date("d.m.Y",strtotime($son_gun))." tarihleri arasındaki veriler raporlanmıştır.";
                
            }
        }




        if(!empty($this->input->post("baslangic_tarihi"))){
            $where = "talep_kayit_tarihi >= '".date("Y-m-d 00:00:00",strtotime($this->input->post("baslangic_tarihi")))."'";
            $viewData["baslangic_tarihi"] = $this->input->post("baslangic_tarihi");
            $viewData["aciklama"] = $this->input->post("baslangic_tarihi")." ile ".date("d.m.Y")." tarihleri arasındaki veriler raporlanmıştır.";
        
            if(!empty($this->input->post("bitis_tarihi"))){
                $where2 = "talep_kayit_tarihi <= '".date("Y-m-d 23:59:59",strtotime($this->input->post("bitis_tarihi")))."'";
                $viewData["bitis_tarihi"] = $this->input->post("bitis_tarihi");
                $viewData["aciklama"] = date("d.m.Y",strtotime($this->input->post("baslangic_tarihi")))." ile ".date("d.m.Y",strtotime($this->input->post("bitis_tarihi")))." tarihleri arasındaki veriler raporlanmıştır.";
        
            }
        }
       

   
            $sql = "SELECT tk.talep_kaynak_adi AS kaynak_adi,tk.talep_kaynak_renk, COUNT(t.talep_id) AS toplam_talep_tayisi
FROM talep_kaynaklari tk
LEFT JOIN talepler t ON t.talep_kaynak_no = tk.talep_kaynak_id 
            "." ".(($where != "")?"WHERE ".$where:"")." ".(($where2 != "")?"AND ".$where2:"")." GROUP BY tk.talep_kaynak_adi";

        $query = $this->db->query($sql);


        $viewData["data"] = $query->result();
 

        
		$viewData["page"] = "talep/rapor";
		$this->load->view('base_view',$viewData);
	}




    private function buildDynamicQuery($ay) {
        $kaynaklar = $this->Talep_kaynak_model->get_all(); 
        $sonuclar = $this->Talep_sonuc_model->get_all(); 
        $sql = "SELECT ";
        
        foreach ($kaynaklar as $kaynak) {
            $temp = strtolower(str_replace("-","",$kaynak->talep_kaynak_adi));
            $sql .= "SUM(CASE WHEN tk.talep_kaynak_id = '{$kaynak->talep_kaynak_id}' THEN 1 ELSE 0 END) AS {$temp}, ";
        }
    
       foreach ($sonuclar as $sonuc) {

            $stemp = str_replace("-","",$sonuc->talep_sonuc_adi);
            $stemp = str_replace(" ","",$stemp);
            $stemp = strtolower(str_replace("/","",$stemp));
            $stemp = create_slug($stemp);
            $sql .= "SUM(CASE WHEN ts.talep_sonuc_id = '{$sonuc->talep_sonuc_id}' THEN 1 ELSE 0 END) AS {$stemp}, ";
        }
    
        $sql .= "MONTH(t.talep_kayit_tarihi) AS Ay ";
    
        $sql .= "FROM talep_yonlendirmeler ty
            JOIN talepler t ON t.talep_id = ty.talep_no
            JOIN talep_kaynaklari tk ON t.talep_kaynak_no = tk.talep_kaynak_id
            JOIN talep_sonuclar ts ON ty.gorusme_sonuc_no = ts.talep_sonuc_id
            WHERE MONTH(t.talep_kayit_tarihi) = $ay
            ";
    
      
    
        return $sql;
    }
    



    public function get_detaylar() {
        $numara = $this->input->post('numara');
        $this->load->database();

 


        $query = $this->db->query("
            SELECT yonlendiren.kullanici_ad_soyad as yonlendiren,yonlenen.kullanici_ad_soyad as yonlenen,talepler.talep_cep_telefon,yonlendirme_tarihi,talep_yonlendirmeler.gorusme_detay,talep_yonlendirmeler.gorusme_sonuc_no,talep_kaynaklari.talep_kaynak_adi,talep_sonuclar.talep_sonuc_adi FROM `talep_yonlendirmeler` 
INNER JOIN talepler ON talepler.talep_id = talep_yonlendirmeler.talep_no
INNER JOIN kullanicilar as yonlendiren ON yonlendiren.kullanici_id = talep_yonlendirmeler.yonlendiren_kullanici_id
INNER JOIN kullanicilar as yonlenen ON yonlenen.kullanici_id = talep_yonlendirmeler.yonlenen_kullanici_id
INNER JOIN talep_kaynaklari ON talep_kaynaklari.talep_kaynak_id = talepler.talep_kaynak_no
INNER JOIN talep_sonuclar ON talep_sonuclar.talep_sonuc_id = talep_yonlendirmeler.gorusme_sonuc_no
WHERE talepler.talep_cep_telefon = ?", array($numara)
        );

        if($query->num_rows() > 0){
            echo json_encode(['status' => 'success', 'data' => $query->result()]);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }






	public function add()
	{   
        yetki_kontrol("talep_ekle");

        $urunler = $this->Urun_model->get_all(["harici_cihaz"=>0]);
        $viewData["urunler"] = $urunler;

        $ulke_data = $this->Sehir_model->get_all_ulkeler();    
		$viewData["ulkeler"] = $ulke_data;
        $sehirler = $this->Sehir_model->get_all();
        $viewData["sehirler"] = $sehirler;
        
        
        $markalar = $this->db->order_by('marka_id', 'ASC')->get("markalar")->result();
        $viewData["markalar"] = $markalar;
      
        $kaynaklar = $this->Talep_kaynak_model->get_all(); 
		$viewData["kaynaklar"] = $kaynaklar;
    
        $talep_sonuclar = $this->Talep_sonuc_model->get_all(); 
		$viewData["talep_sonuclar"] = $talep_sonuclar;

        $ilceler = $this->Ilce_model->get_all();
        $viewData["ilceler"] = $ilceler;


		$viewData["page"] = "talep/form";
		$this->load->view('base_view',$viewData);
	}

	public function edit($id = '',$yonlendirme=0)
	{  
        
        $urunler = $this->Urun_model->get_all(["harici_cihaz"=>0]);
        $viewData["urunler"] = $urunler;

        if($yonlendirme == 0){
            $check_id = $this->Talep_model->get_by_id($id); 
            if(goruntuleme_kontrol("talep_tum_kayitlar_goruntule") == false){
                if($check_id[0]->yonlendiren_kullanici_id == $this->session->userdata('aktif_kullanici_id')){

                }else{
                    if($check_id[0]->talep_sorumlu_kullanici_id != $this->session->userdata('aktif_kullanici_id')){
                        echo "Bu talebi düzenleme yetkiniz yoktur.";
                         return;
                      
                    }
                }
               
            }

        }else{
            $temp_data_id = $this->Talep_yonlendirme_model->get_by_id($yonlendirme); 
            $check_id = $this->Talep_model->get_by_id($temp_data_id[0]->talep_no);
            $viewData['talep_yonlendirme'] = $temp_data_id[0];
            if(goruntuleme_kontrol("talep_tum_kayitlar_goruntule") == false){
                if($temp_data_id[0]->yonlendiren_kullanici_id == $this->session->userdata('aktif_kullanici_id')){

                }else{

                if($temp_data_id[0]->yonlenen_kullanici_id != $this->session->userdata('aktif_kullanici_id')){
                    echo "Bu talebi düzenleme yetkiniz yoktur.";
                    if(aktif_kullanici()->kullanici_id != 60){
                        return;
                       }
                    }
                }
            }
        }
		
       


        if($check_id){  


             

            $viewData['talep'] = $check_id[0];
         
			$viewData["page"] = "talep/form";     
            
            $yonlendirmeler = $this->Talep_yonlendirme_model->get_all_by_talep_no(["talep_no"=>$check_id[0]->talep_id]); 
            $viewData["yonlendirmeler"] = $yonlendirmeler; 
 
            $kaynaklar = $this->Talep_kaynak_model->get_all(); 
            $viewData["kaynaklar"] = $kaynaklar; 

            $markalar = $this->db->order_by('marka_id', 'ASC')->get("markalar")->result();
            $viewData["markalar"] = $markalar;


            $talep_sonuclar = $this->Talep_sonuc_model->get_all(); 
            $viewData["talep_sonuclar"] = $talep_sonuclar;
            $ulke_data = $this->Sehir_model->get_all_ulkeler();    
            $viewData["ulkeler"] = $ulke_data;
            $sehirler = $this->Sehir_model->get_all();
            $viewData["sehirler"] = $sehirler;
            if($check_id[0]->talep_sehir_no != 0){
                $ilceler = $this->Ilce_model->get_all(["ilceler.sehir_id" =>$check_id[0]->talep_sehir_no ]);
            }else{
                $ilceler = [];
            }
           
            $viewData["ilceler"] = $ilceler;
			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('talep'));
        }
 
	}

    public function delete($id)
	{     
        yetki_kontrol("talep_sil");
        $this->db->delete('talepler', array('talep_id' => $id)); 
        $viewData["page"] = "talep/list";
		$this->load->view('base_view',$viewData);
	}
    public function yonlendirme_delete($id)
	{     
        yetki_kontrol("talep_sil");
        $this->db->delete('talep_yonlendirmeler', array('talep_yonlendirme_id' => $id)); 
        $viewData["page"] = "talep/yonlendirilenler_list";
		$this->load->view('base_view',$viewData);
	}



    public function yonlendir($talep_id,$kullanici_id)
	{
        yetki_kontrol("talep_yonlendirme");


        $num = $this->db->where("talep_id",$talep_id)->get("talepler")->result()[0]->talep_cep_telefon;

        $this->db->select('talepler.*'); // Her iki tablodan gelen tüm sütunları seç
        $this->db->from('talepler');
        $this->db->join('talep_yonlendirmeler', 'talep_yonlendirmeler.talep_no = talepler.talep_id');
        $this->db->where('talep_yonlendirmeler.yonlendirme_tarihi >=', date('Y-m-d', strtotime('-3 days')));
        $this->db->where('talepler.talep_cep_telefon', str_replace(" ", "",$num));
        $query = $this->db->get();
        
        if(count($query->result()) > 0){


           $this->session->set_flashdata('flashDanger', $num." nolu iletişim bilgisiyle oluşturulmuş ve 3 günlük görüşme sürecinde olan bir kayıt bulunmaktadır. 3 gün içinde tekrar talep kaydı oluşturulamaz.");
           $response = [
            'status' => 'error',
            'message' => 'İşlem sırasında bir hata oluştu.'
        ];
           return $this->output
        ->set_content_type('application/json')
        ->set_status_header(400) // HTTP 400 Bad Request
        ->set_output(json_encode($response));

            redirect($_SERVER['HTTP_REFERER']);
        }






        $data['talep_no'] = $talep_id;
        $data['yonlenen_kullanici_id'] = $kullanici_id;
        $data['yonlendiren_kullanici_id'] = escape($this->session->userdata('aktif_kullanici_id'));
        $this->Talep_yonlendirme_model->insert($data);   

        $t_data["talep_yonlendirildi_mi"] = 1;
        $this->Talep_model->update($talep_id,$t_data);

        
        $queryq = $this->db->get_where("kullanicilar",array('kullanici_id' => $kullanici_id));
		$dkul = $queryq->result();
	
		sendSmsData($dkul[0]->kullanici_bireysel_iletisim_no,"Sn. ".$dkul[0]->kullanici_ad_soyad." ".date("d.m.Y H:i")." tarihinde tarafınıza yönlendirilmiş yeni müşteri talebiniz bulunmaktadır. Talebi görüntülemek için : https://ugbusiness.com.tr/bekleyen-talepler");

        redirect(site_url('talep'));
    }


 public function tekraryonlendir($talep_yonlendirme_id,$kullanici_id)
	{
        yetki_kontrol("talep_tekrar_yonlendirme");
     

        $t_data["yonlenen_kullanici_id"] = $kullanici_id;
        $t_data["yonlendiren_kullanici_id"] = aktif_kullanici()->kullanici_id;
        $t_data["gorusme_detay"] = "";
        $t_data["gorusme_sonuc_no"] = "1";
        $t_data["yonlendirme_tarihi"] = date("Y-m-d H:i:s");
         //echo "$talep_yonlendirme_id<br>".json_encode($t_data);return;
        $this->db->where("talep_yonlendirme_id" , $talep_yonlendirme_id);
        $this->db->update('talep_yonlendirmeler', $t_data); 
      
	
		 
        redirect(base_url('talep/bekleyen_rapor_list'));
    }


    public function yogunluk_haritasi()
	{
		yetki_kontrol("rut_haritasi_goruntule");
		$this->load->model('Sehir_model'); 
		$sehirler = $this->Sehir_model->get_all();
        $viewData["sehirler"] = $sehirler;
		$viewData["page"] = "talep/yogunluk_haritasi";
		$this->load->view('base_view',$viewData);
	}

	public function save($id = '')
	{   
            $kkontrolid = aktif_kullanici()->kullanici_id ;


        if(escape($this->input->post('gorusme_sonuc_no')) == "2"){
        $controlmusteriad = $this->input->post('talep_musteri_ad_soyad');
        if (str_word_count($controlmusteriad) === 1) {
            $this->session->set_flashdata('flashDanger','Ad Soyad Geçersiz. Soyad Bilgisi Zorunludur. Bilgileri Kontrol Edip Tekrar Deneyiniz.');
            redirect($_SERVER['HTTP_REFERER']); 
        }
        $kucukMetin = mb_strtolower($controlmusteriad, 'UTF-8');
        if (strpos($kucukMetin, 'hanım') !== false 
        || strpos($kucukMetin, 'hanim') !== false 
        || strpos($kucukMetin, ' bey') !== false
        || strpos($kucukMetin, 'by') !== false
        || strpos($kucukMetin, 'hanm') !== false
        || strpos($kucukMetin, 'hnm') !== false
        || strpos($kucukMetin, 'by') !== false
        || strpos($kucukMetin, 'hnım') !== false
        || strpos($kucukMetin, 'hnim') !== false
        || strpos($kucukMetin, 'isim') !== false
        || strpos($kucukMetin, 'hanımm') !== false
        || strpos($kucukMetin, 'hanimm') !== false
        || strpos($kucukMetin, 'haanim') !== false
        || strpos($kucukMetin, 'haanım') !== false
        || strpos($kucukMetin, 'beyi') !== false
        
        || strpos($kucukMetin, 'belirtilmedi') !== false
        
        ) {
            $this->session->set_flashdata('flashDanger','Müşteri Ad Soyad İçerisinde (Hanım, Bey, Hanim, By, Hanm, Hnm, Hnım, hnim) ifadelerine yer verilemez. Bilgileri kontrol edip tekrar deneyiniz.');
            redirect($_SERVER['HTTP_REFERER']); 
        }

    }
        

        if(empty($id)){
            yetki_kontrol("talep_ekle");
        }else{


            if(goruntuleme_kontrol("talep_tum_kayitlar_goruntule") == false){
                $yonlendirme_id = $this->input->post('talep_id');
                $ddata = $this->Talep_yonlendirme_model->get_by_id($yonlendirme_id); 
                if($ddata[0]->yonlenen_kullanici_id == $this->session->userdata('aktif_kullanici_id')){

                }else{

                if($ddata[0]->yonlendiren_kullanici_id == $this->session->userdata('aktif_kullanici_id')){
                    echo "Bu talebi düzenleme yetkiniz yoktur.";
                        return;
                     
                    }
                }
            }
                yetki_kontrol("talep_duzenle");
          
        }

 
          
        

        $this->form_validation->set_rules('talep_musteri_ad_soyad',  'Müşteri Adı',  'required'); 
        
        $data['talep_musteri_ad_soyad']     = escape($this->input->post('talep_musteri_ad_soyad'));
        $data['talep_isletme_adi']          = (escape($this->input->post('talep_isletme_adi')) == "") ? "#NULL#" : escape($this->input->post('talep_isletme_adi'));
    
        if( $kkontrolid  != 1341){
            $data['talep_cep_telefon']          = escape(str_replace(" ", "", $this->input->post('talep_cep_telefon')));
       

        }
    
        $data['talep_sabit_telefon']        = escape($this->input->post('talep_sabit_telefon'));
       
        $data['talep_fiyat_teklifi']        = escape($this->input->post('talep_fiyat_teklifi'));
        $data['talep_urun_id']              = json_encode(escape($this->input->post('secilen_cihazlar')));
        $data['talep_sehir_no']             = escape($this->input->post('talep_sehir_no'));
        $data['talep_ilce_no']              = escape($this->input->post('talep_ilce_no'));
        $data['talep_guncelleme_tarihi']    = date('Y-m-d H:i:s');
        $data['talep_kaynak_no']              = escape($this->input->post('talep_kaynak_no'));
        $data['talep_uyari_notu']              = escape($this->input->post('talep_uyari_notu'));
        $data['talep_kullanilan_cihaz_id']              = escape($this->input->post('talep_kullanilan_cihaz_id'));
        $data['talep_kullanilan_cihaz_aciklama']              = escape($this->input->post('talep_kullanilan_cihaz_aciklama'));


        if($this->session->userdata('aktif_kullanici_id') == 19 || $this->session->userdata('aktif_kullanici_id') == 5){
            $data['talep_reklamlardan_gelen_mi']              = escape($this->input->post('talep_reklamlardan_gelen_mi'));
        }else{
            $data['talep_reklamlardan_gelen_mi']  = 0;
        }

 
        
        if( $kkontrolid  == 1 ||  $kkontrolid  == 1331 ||  $kkontrolid  == 1341){
            $data['talep_yurtdisi_telefon']              = escape($this->input->post('talep_yurtdisi_telefon'));
        

        }



        if ($this->form_validation->run() != FALSE && !empty($id)) {
            $check_id = $this->Talep_model->get_by_id($id);




            if($check_id){
                unset($data['id']);





               


                $this->db->select('*');
                $this->db->from('talepler');
                $this->db->join('talep_yonlendirmeler', 'talep_yonlendirmeler.talep_no = talepler.talep_id');
                $this->db->where('talep_yonlendirmeler.yonlendirme_tarihi >=', date('Y-m-d', strtotime('-3 days')));

                  if( $kkontrolid  != 1341){
           $this->db->where('talepler.talep_cep_telefon', str_replace(" ", "", $this->input->post('talep_cep_telefon')));
              

        }
    

                $this->db->where('talepler.talep_id !=', $id);
                $query = $this->db->get();
                
                if(count($query->result()) > 0){
                   // $this->session->set_flashdata('flashDanger', escape($this->input->post('talep_cep_telefon'))." nolu iletişim bilgisiyle oluşturulmuş ve 3 günlük görüşme sürecinde olan bir kayıt bulunmaktadır. 3 gün içinde tekrar talep kaydı oluşturulamaz.");
                   // redirect($_SERVER['HTTP_REFERER']);
                }
        




                $this->Talep_model->update($id,$data);


                     $yonlendirme_id = $this->input->post('talep_id');
                     if($yonlendirme_id == "0"){
                        $yonlendirmeData['gorusme_detay']    =  escape($this->input->post('gorusme_detay'));
                        $yonlendirmeData['rut_gorusmesi_mi'] =  escape($this->input->post('rut_gorusmesi_mi'));
                       
                        $gunceldata = $this->Talep_yonlendirme_model->get_by_id($yonlendirme_id);
                        $yonlendirmeData['eski_gorusme_sonuc_no'] =  $gunceldata->gorusme_sonuc_no;
                        $yonlendirmeData['eski_gorusme_sonuc_guncelleme_tarihi'] =  date("Y-m-d H:i:s",strtotime($gunceldata->gorusme_sonuc_guncelleme_tarihi));
                      

                        $this->Talep_yonlendirme_model->update($yonlendirme_id,$yonlendirmeData);
                    }
                    if($yonlendirme_id != "0"){
                        $yonlendirmeData['gorusme_detay']    =  escape($this->input->post('gorusme_detay'));
                        $yonlendirmeData['gorusme_sonuc_no'] =  escape($this->input->post('gorusme_sonuc_no'));
                        $yonlendirmeData['gorusme_puan'] =  escape($this->input->post('gorusme_puan'));
                       
                        $yonlendirmeData['gorusme_sonuc_guncelleme_tarihi'] =  date("Y-m-d H:i:s");
                        $yonlendirmeData['rut_gorusmesi_mi'] =  escape($this->input->post('rut_gorusmesi_mi'));
        
                        $gunceldata = $this->Talep_yonlendirme_model->get_by_id($yonlendirme_id);
                        $yonlendirmeData['eski_gorusme_sonuc_no'] =  $gunceldata[0]->gorusme_sonuc_no;
                        $yonlendirmeData['eski_gorusme_sonuc_guncelleme_tarihi'] =  date("Y-m-d H:i:s",strtotime($gunceldata[0]->gorusme_sonuc_guncelleme_tarihi));
                      
                        if(escape($this->input->post('rut_gorusmesi_mi')) == "1"){
                            $k_id = aktif_kullanici()->kullanici_id;
                            $query = $this->db 
                             ->where("rut_ilce_bilgisi LIKE '%\"".escape($this->input->post('talep_ilce_no'))."\"%'") 
                            ->where(["rut_kullanici_id"=> $k_id])
                            ->select("rut_tanimlari.*")
                            ->from('rut_tanimlari')->order_by("rut_tanimlari.rut_tanim_id","asc")
                            ->get()->result();



                            $current_date_midnight = strtotime("today");
                           
                            if(count($query) > 0){
                           
                                if($current_date_midnight >= strtotime($query[count($query)-1]->rut_baslangic_tarihi) && $current_date_midnight <= strtotime($query[count($query)-1]->rut_bitis_tarihi . ' +1 day')) {
                                   
                                }else{
                                    $this->session->set_flashdata('flashDanger',$current_date_midnight." === ".strtotime($query[count($query)-1]->rut_baslangic_tarihi).'bRut tanımlaması yapılmadığı için, bu talebi rut olarak sonlandıramazsınız, birim yöneticiniz ile iletişime geçiniz.');
                                    redirect($_SERVER['HTTP_REFERER']); 
                                }
                            }else{
                                $this->session->set_flashdata('flashDanger','aRut tanımlaması yapılmadığı için, bu talebi rut olarak sonlandıramazsınız, birim yöneticiniz ile iletişime geçiniz.');
			                    redirect($_SERVER['HTTP_REFERER']); 
                            }
                        }




                   
                        $this->Talep_yonlendirme_model->update($yonlendirme_id,$yonlendirmeData);

                        if(escape($this->input->post('gorusme_sonuc_no')) == "2"){
                            
                            $merkez_kontrol = $this->Merkez_model->get_all(["musteriler.musteri_iletisim_numarasi"=>escape(str_replace(" ","",$this->input->post('talep_cep_telefon')))]);
                           
                            $data = false;
                            if($merkez_kontrol){
                                $data = $merkez_kontrol[0];
                            }
                            if($data){


                               
                              
                               
    
                                redirect(site_url('siparis/ekle/'.$data->merkez_id));
                            }

                           


                            $mdata['musteri_ad']                 = escape($this->input->post('talep_musteri_ad_soyad'));
                            $mdata['musteri_iletisim_numarasi']  = escape(str_replace(" ","",$this->input->post('talep_cep_telefon')));
                            $this->Musteri_model->insert($mdata);
                            $insert_musteri_id = $this->db->insert_id();
                            
                           
                            $musteridata['musteri_kod']   = "M1".str_pad($insert_musteri_id,5,"0",STR_PAD_LEFT);;
                            $this->Musteri_model->update($insert_musteri_id,$musteridata);






                            $merkez_data["merkez_yetkili_id"] = $insert_musteri_id;
                            $merkez_data["merkez_adi"] = escape($this->input->post('talep_isletme_adi')) ?? "#NULL#";
                            $merkez_data["merkez_ulke_id"] = escape($this->input->post('ulke_id'));
                           
                            $merkez_data["merkez_il_id"] = escape($this->input->post('talep_sehir_no'));
                            $merkez_data["merkez_ilce_id"] = escape($this->input->post('talep_ilce_no'));
                           

                            $this->Merkez_model->insert($merkez_data);
                            $insert_merkez_id = $this->db->insert_id();



                            redirect(site_url('siparis/ekle/'.$insert_merkez_id));
                        }
        
                    }

              





            }
        }elseif($this->form_validation->run() != FALSE && empty($id)){
            $data['talep_sorumlu_kullanici_id']  = escape($this->session->userdata('aktif_kullanici_id'));
       
 


            $this->db->select('talepler.*'); // Her iki tablodan gelen tüm sütunları seç
            $this->db->from('talepler');
            $this->db->join('talep_yonlendirmeler', 'talep_yonlendirmeler.talep_no = talepler.talep_id');
            $this->db->where('talep_yonlendirmeler.yonlendirme_tarihi >=', date('Y-m-d', strtotime('-3 days')));
            $this->db->where('talepler.talep_cep_telefon', str_replace(" ", "",$this->input->post('talep_cep_telefon')));
            $query = $this->db->get();
            
            if(count($query->result()) > 0 && ($this->session->userdata('aktif_kullanici_id') != 1341)){
               $this->session->set_flashdata('flashDanger', escape($this->input->post('talep_cep_telefon'))." nolu iletişim bilgisiyle oluşturulmuş ve 3 günlük görüşme sürecinde olan bir kayıt bulunmaktadır. 3 gün içinde tekrar talep kaydı oluşturulamaz.");
                // $this->session->set_flashdata('flashDanger', escape($this->input->post('talep_cep_telefon'))." nolu iletişim bilgisiyle oluşturulmuş bir kayıt bulunmaktadır. Tekrar talep kaydı oluşturulamaz.");
               if(aktif_kullanici()->kullanici_id == 1)
               {
                redirect("https://ugbusiness.com.tr/talep/duzenle/".$query->result()[0]->talep_id);
               }
                redirect($_SERVER['HTTP_REFERER']);
            }
    
            $this->db->select('talepler.*, talep_yonlendirmeler.*');
            $this->db->from('talepler');
            $this->db->join('talep_yonlendirmeler', 'talep_yonlendirmeler.talep_no = talepler.talep_id');
            $this->db->where('talepler.talep_cep_telefon', str_replace(" ", "", $this->input->post('talep_cep_telefon')));
            $query = $this->db->get();
            $talep_no = 0;
            $eski_kullanici = 0;
            if($this->input->post('talep_cep_telefon') != ""){

           
            if(count($query->result()) > 0){
                $talep_no = $query->result()[0]->talep_id;
                $eski_kullanici = $query->result()[0]->yonlenen_kullanici_id;
              $this->db->where("talep_yonlendirme_id",$query->result()[0]->talep_yonlendirme_id)->update("talep_yonlendirmeler",["kullaniciya_aktarildi"=>1]);
            }}
/*
            if(aktif_kullanici()->kullanici_id != 1){
                $query = $this
                ->db
                ->get_where("talepler",array('talep_musteri_ad_soyad' => escape($this->input->post('talep_musteri_ad_soyad'))));
                    
                if($query && $query->num_rows()){
                        $queryq = $this->db->where("yetki_kodu","ayni_adli_talep_bildirim")
                                ->join('kullanicilar', 'kullanicilar.kullanici_id = kullanici_yetki_tanimlari.kullanici_id')
                                ->get("kullanici_yetki_tanimlari");
                                $dkul = $queryq->result();
                                if($dkul){
                                    foreach ($dkul as $kullanici_data) {
                                        $tkod = "(T0000".$query->result()[0]->talep_id.")";
                                        sendSmsData($kullanici_data->kullanici_bireysel_iletisim_no,aktif_kullanici()->kullanici_ad_soyad." tarafından aynı müşteri adı ile talep oluşturulmuştur. Müşteri Adı :  ".escape($this->input->post('talep_musteri_ad_soyad')).$tkod);
                                        
                                    }
                                }
                    }
             }
*/


            $this->Talep_model->insert($data);
            $inserted_id = $this->db->insert_id();



         




            if(!goruntuleme_kontrol("talep_tum_kayitlar_goruntule")){
                $yonlendirme_data["talep_no"] = (($talep_no != 0) ? $talep_no : $inserted_id);
                $yonlendirme_data["yonlenen_kullanici_id"] = $this->session->userdata('aktif_kullanici_id');
                $yonlendirme_data["yonlendiren_kullanici_id"] = $this->session->userdata('aktif_kullanici_id');
                $yonlendirme_data["gorusme_sonuc_no"] = 1;
                if($eski_kullanici != 0){
                    $yonlendirme_data["aktarma_notu"] = get_yonlendiren_kullanici($eski_kullanici)->kullanici_ad_soyad." adlı kişiden aktarıldı.";
               
                }
                $this->Talep_yonlendirme_model->insert($yonlendirme_data);


                $t_data["talep_yonlendirildi_mi"] = 1;
                $this->Talep_model->update( $inserted_id,$t_data);

            }
            

        }else{
            $this->session->set_flashdata('form_errors', json_encode($this->form_validation->error_array()));
            redirect(site_url('talep/ekle'));
        }
        if(!goruntuleme_kontrol("talep_yonlendirme")){
            redirect(site_url('bekleyen-talepler'));
        }
        if(aktif_kullanici()->kullanici_id == 1 || aktif_kullanici()->kullanici_id == 4){
            redirect(site_url('talep'));
        }else{
            redirect(site_url('bekleyen-talepler'));
        }
		
	}


    public function talep_hizli_yonlendirme_save_view()
	{  
        yetki_kontrol("hizli_talep_yonlendirme");
        $query = $this->db->order_by('hizli_yonlendirme_sira_no', 'ASC')->where(["kullanici_departman_id"=>12])->or_where(["kullanici_departman_id"=>17])
        ->join('departmanlar', 'departmanlar.departman_id = kullanicilar.kullanici_departman_id')
        ->join('kullanici_gruplari', 'kullanici_gruplari.kullanici_grup_id = kullanicilar.kullanici_grup_no')
        ->get("kullanicilar");
        $this->db->group_start();
$this->db->where('kullanici_departman_id', 12);
$this->db->or_where('kullanici_departman_id', 17);
$this->db->or_where('kullanici_id', 2);
$this->db->group_end();
$this->db->where('kullanici_aktif', 1);
$this->db->where('kullanici_id !=', 2); 
        $kullanicilar = $this->Kullanici_model->get_all([]); 
		$viewData["kullanicilar"] = $kullanicilar;






        $this->db->where(["yonlendiren_kullanici_id"=>1]);
            
        $qtalep = $this->Talep_yonlendirme_model->get_all([],[],[],[],10); 

        $viewData["sontalepler"] = $qtalep;






        $viewData["page"] = "talep/hizli_yonlendirme_form";
        $this->load->view("base_view",$viewData);
    }

    public function talep_hizli_save()
	{ 
       
        $data['talep_musteri_ad_soyad']     = "İSİM BELİRTİLMEDİ";
        $data['talep_isletme_adi']          = "#NULL#" ;
        $data['talep_cep_telefon']          = escape(str_replace(" ", "", $this->input->post('talep_cep_telefon')));
        $data['talep_sabit_telefon']        = "";
       
        $data['talep_fiyat_teklifi']        = "";
        $data['talep_urun_id']              = "[\"".$this->input->post('urunid')."\"]";
        $data['talep_sehir_no']             = 0;
        $data['talep_ilce_no']              = 0;
        $data['talep_kaynak_no']            = escape($this->input->post('talep_kaynak_no'));
        $data['talep_kullanilan_cihaz_id']  = 1;
        $data['talep_kullanilan_cihaz_aciklama'] = "";
        $data['talep_sorumlu_kullanici_id']  = escape($this->session->userdata('aktif_kullanici_id'));
        $data['talep_uyari_notu']              = escape($this->input->post('talep_uyari_notu'));
        $this->db->select('talepler.*'); 
        $this->db->from('talepler');
        $this->db->join('talep_yonlendirmeler', 'talep_yonlendirmeler.talep_no = talepler.talep_id');
        $this->db->where('talep_yonlendirmeler.yonlendirme_tarihi >=', date('Y-m-d', strtotime('-3 days')));
        $this->db->where('talepler.talep_cep_telefon', str_replace(" ", "",$this->input->post('talep_cep_telefon')));
        $query = $this->db->get();
        
        if(count($query->result()) > 0){
           $this->session->set_flashdata('flashDanger', escape($this->input->post('talep_cep_telefon'))." nolu iletişim bilgisiyle oluşturulmuş ve 3 günlük görüşme sürecinde olan bir kayıt bulunmaktadır. 3 gün içinde tekrar talep kaydı oluşturulamaz.");
            redirect($_SERVER['HTTP_REFERER']);
        }


        $this->db->select('talepler.*, talep_yonlendirmeler.*');
        $this->db->from('talepler');
        $this->db->join('talep_yonlendirmeler', 'talep_yonlendirmeler.talep_no = talepler.talep_id');
        $this->db->where('talepler.talep_cep_telefon', str_replace(" ", "", $this->input->post('talep_cep_telefon')));
        $query = $this->db->get();
        $talep_no = 0;
        $eski_kullanici = 0;
        if(count($query->result()) > 0){
            $talep_no = $query->result()[0]->talep_id;
            $eski_kullanici = $query->result()[0]->yonlenen_kullanici_id;
            $this->db->where("talep_yonlendirme_id",$query->result()[0]->talep_yonlendirme_id)->update("talep_yonlendirmeler",["kullaniciya_aktarildi"=>1]);
        }

        $this->Talep_model->insert($data);
        $inserted_id = $this->db->insert_id();
        
        $yonlendirme_data["talep_no"] = (($talep_no != 0) ? $talep_no : $inserted_id);
        $yonlendirme_data["yonlenen_kullanici_id"] = $this->input->post('yonlenen_kullanici_id');
        $yonlendirme_data["yonlendiren_kullanici_id"] = 1;
        $yonlendirme_data["gorusme_sonuc_no"] = 1;
        if($eski_kullanici != 0){
            $yonlendirme_data["aktarma_notu"] = get_yonlendiren_kullanici($eski_kullanici)->kullanici_ad_soyad." adlı kişiden aktarıldı.";
       
        }
        $this->Talep_yonlendirme_model->insert($yonlendirme_data);


        $t_data["talep_yonlendirildi_mi"] = 1;
        $this->Talep_model->update( $inserted_id,$t_data);




        $tykul = $this->db->where("kullanici_id",$this->input->post('yonlenen_kullanici_id'))->get("kullanicilar")->result();
        sendSmsData($tykul[0]->kullanici_bireysel_iletisim_no,"Sn. ".$tykul[0]->kullanici_ad_soyad." ".date("d.m.Y H:i")." tarihinde tarafınıza yönlendirilmiş yeni müşteri talebiniz bulunmaktadır. Talebi görüntülemek için : https://ugbusiness.com.tr/bekleyen-talepler");


        $this->session->set_flashdata('flashSuccess', " Talep başarıyla oluşturulmuş ve satış temsilcisine yönlendirilmiştir.");
        redirect($_SERVER['HTTP_REFERER']);



    }
    


}
