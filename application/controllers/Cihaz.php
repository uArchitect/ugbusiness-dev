<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cihaz extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Cihaz_model'); 
        $this->load->model('Siparis_model'); 
        $this->load->model('Urun_model');    $this->load->model('Siparis_urun_model'); $this->load->model('Servis_model'); 
        $this->load->model('Baslik_model');       $this->load->model('kullanici_model');    $this->load->model('Egitim_model');  
        $this->load->model('Musteri_model'); 
        $this->load->model('Merkez_model');    $this->load->model('Stok_model');         $this->load->model('Siparis_onay_hareket_model'); 
        date_default_timezone_set('Europe/Istanbul');
    }
 

    public function borclu_kayit_ekle()
	{
        if($this->input->post("borclu_seri_numarasi") != ""){
            yetki_kontrol("borclu_cihazlari_goruntule");
            $data = $this->Cihaz_model->get_borclular(["borclu_seri_numarasi"=>$this->input->post("borclu_seri_numarasi")]); 
            if(count($data)>0){
                $this->session->set_flashdata('flashDanger','Girilen seri numarası daha önce borçlu olarak kaydedilmiştir. Bilgileri kontrol edip tekrar deneyiniz.');
                redirect($_SERVER['HTTP_REFERER']); 
            }
    
            $datainsert = []; 
            $datainsert["borclu_seri_numarasi"] = $this->input->post("borclu_seri_numarasi"); 

             $datainsert["borclu_aciklama"] = $this->input->post("borclu_aciklama"); 
            $this->db->insert("borclu_cihazlar",$datainsert);
     
            redirect(base_url("cihaz/borclu_cihazlar"));
        }
        
	}


    public function garanti_sorgulayanlar()
	{
        
        yetki_kontrol("garanti_sorgulayanlari_goruntule");
        $data = $this->Cihaz_model->get_garanti_sorgulayanlar(); 
 
		$viewData["urunler"] = $data;
		$viewData["page"] = "cihaz/garanti_sorgulayanlar";
		$this->load->view('base_view',$viewData);
	}

    public function borclu_cihazlar()
	{
        
        yetki_kontrol("borclu_cihazlari_goruntule");
        $data = $this->Cihaz_model->get_borclular(); 
 
		$viewData["urunler"] = $data;
		$viewData["page"] = "cihaz/borclu_cihazlar";
		$this->load->view('base_view',$viewData);
	}


  public function borc_uyarisi_ekle($borclu_id)
	{
        
        yetki_kontrol("borc_uyarisi_ekle");

        $data = [];
        $data["borc_durum"] = 1;
        $data["borc_durum_guncelleyen_kullanici_id"] = aktif_kullanici()->kullanici_id;
        $data["borc_durum_guncelleme_tarihi"] = date("Y-m-d H:i:s");
        $this->db->where("borclu_id",$borclu_id)->update("borclu_cihazlar",$data);
     
        redirect(base_url("cihaz/borclu_cihazlar"));
	}

    public function borc_uyarisi_kaldir($borclu_id)
	{
        
        yetki_kontrol("borc_uyarisi_kaldir");
        $data = [];
        $data["borc_durum"] = 0;
        $data["borc_durum_guncelleyen_kullanici_id"] = aktif_kullanici()->kullanici_id;
        $data["borc_durum_guncelleme_tarihi"] = date("Y-m-d H:i:s");
        $this->db->where("borclu_id",$borclu_id)->update("borclu_cihazlar",$data);
        redirect(base_url("cihaz/borclu_cihazlar"));
	}


    public function showrooms($gid = 0)
	{
        $data = $this->db->select("*")->from("showroom_cihazlar")->join("urunler","urunler.urun_id = showroom_cihazlar.showroom_cihaz_urun_no")->get()->result();

        $viewData["cihazlar"] =  $data;

        if($gid != 0){
        $datag = $this->db->where("showroom_cihaz_id",$gid)->get("showroom_cihazlar")->result()[0];

        $viewData["guncellenecekcihaz"] =  $datag;

        }


        $viewData["page"] = "showroom_cihazlar/form";
		$this->load->view('base_view',$viewData);
    }

    public function showroom_kaydet()
	{
        $data = $this->db->where(["showroom_cihaz_seri_no"=>$this->input->post("showroom_cihaz_seri_no")])->get("showroom_cihazlar")->result();
        if(count($data) > 0){
            $this->session->set_flashdata('flashDanger','Girilen seri numarası daha önce tanımlanmıştır.');
            redirect($_SERVER['HTTP_REFERER']); 
        }
        $insertData["showroom_cihaz_urun_no"]  = $this->input->post("showroom_cihaz_urun_no");
        $insertData["showroom_cihaz_bolum_no"] = $this->input->post("showroom_cihaz_bolum_no");
        $insertData["showroom_cihaz_seri_no"]  = $this->input->post("showroom_cihaz_seri_no");
        $this->db->insert("showroom_cihazlar",$insertData);
        redirect($_SERVER['HTTP_REFERER']); 
    }
public function showroom_guncelle($id)
	{
        
        $updateData["showroom_cihaz_urun_no"]  = $this->input->post("showroom_cihaz_urun_no");
        $updateData["showroom_cihaz_bolum_no"] = $this->input->post("showroom_cihaz_bolum_no");
        $updateData["showroom_cihaz_seri_no"]  = $this->input->post("showroom_cihaz_seri_no");
        
         $data = $this->db->where(["showroom_cihaz_id "=>$id])->update("showroom_cihazlar",$updateData);

        redirect(base_url("cihaz/showrooms")); 
    }



    public function iptal_edilen_siparisler()
	{
        
        yetki_kontrol("iptal_edilen_siparisleri_goruntule");
        $this->db->where(["siparis_aktif"=>0]);
        $data = $this->db
        ->select("musteriler.musteri_ad,borclu_cihazlar.borc_durum as cihaz_borc_uyarisi,musteriler.musteri_kod,musteriler.musteri_iletisim_numarasi,
        merkezler.merkez_adi,merkezler.merkez_adresi,merkezler.merkez_yetkili_id,  merkezler.merkez_id,
                  urunler.urun_adi, urunler.urun_slug,
                  siparis_urunleri.siparis_urun_id, siparis_urunleri.musteri_degisim_aciklama,
                  siparis_urunleri.seri_numarasi,
                  siparis_urunleri.satis_fiyati,
                  siparis_urunleri.pesinat_fiyati,     
                   siparis_urunleri.kapora_fiyati,      
                  siparis_urunleri.fatura_tutari,
                  siparis_urunleri.takas_bedeli,
                  sehirler.sehir_adi,siparisler.siparis_iptal_nedeni,
                  ilceler.ilce_adi")
        ->order_by('siparis_urun_id', 'DESC')
        ->join("urunler","urunler.urun_id = siparis_urunleri.urun_no")
        ->join("siparisler","siparis_urunleri.siparis_kodu = siparisler.siparis_id")
        ->join("merkezler","siparisler.merkez_no = merkezler.merkez_id")
        ->join("musteriler","merkezler.merkez_yetkili_id = musteriler.musteri_id")
        ->join("sehirler","merkezler.merkez_il_id = sehirler.sehir_id")
        ->join("ilceler","merkezler.merkez_ilce_id = ilceler.ilce_id")
        ->join("borclu_cihazlar","borclu_cihazlar.borclu_seri_numarasi = siparis_urunleri.seri_numarasi","left")
        
        ->get("siparis_urunleri")->result();
 
		$viewData["urunler"] = $data;
		$viewData["page"] = "cihaz/iptal_edilen_siparis_urunleri";
		$this->load->view('base_view',$viewData);
	}


	public function index($filter = null)
	{    
        yetki_kontrol("cihazlari_goruntule");
      /*  switch ($filter) {
            case 'garanti':
                $data = $this->Cihaz_model->get_all(["garanti_bitis_tarihi <=" => date("Y-m-d")]); 
                break;
            
            default:
                $data = $this->Cihaz_model->get_all(); 
                break;
        }
        
		$viewData["urunler"] = $data;*/
		$viewData["page"] = "cihaz/list";
		$this->load->view('base_view',$viewData);
	}



    public function rgmedikalindex($filter = null)
	{    
        yetki_kontrol("cihazlari_goruntule");
      /*  switch ($filter) {
            case 'garanti':
                $data = $this->Cihaz_model->get_all(["garanti_bitis_tarihi <=" => date("Y-m-d")]); 
                break;
            
            default:
                $data = $this->Cihaz_model->get_all(); 
                break;
        }
        
		$viewData["urunler"] = $data;*/
		$viewData["page"] = "cihaz/rglist";
		$this->load->view('base_view',$viewData);
	}


public function report()
	{   

        yetki_kontrol("cihaz_raporu_goruntule");
        $data = $this->Cihaz_model->get_report();
        $sehir_data = $this->Cihaz_model->get_country_report();
        $viewData["satis_verileri"] = $data; 
        $viewData["sehir_verileri"] = $sehir_data;
		$viewData["page"] = "cihaz/report";
		$this->load->view('base_view',$viewData);
	}


    public function cihaz_harita($urun_id = 0)
	{
        yetki_kontrol("cihaz_raporu_goruntule");
        $sehir_data = $this->Cihaz_model->get_country_device($urun_id);
        $viewData["sehir_verileri"] = $sehir_data;
        $olmayansehirler = $this->db
            ->select("*")
            ->from("sehirler")
            ->get()->result();
        $viewData["olmayansehirler"] = $olmayansehirler;
        $viewData["secilen_urun"]    = $urun_id;
        $viewData["urun_adet_0"]     =  $this->Cihaz_model->get_country_total_device(0,0)[0]->toplam;
        $viewData["urun_adet_1"]     =  $this->Cihaz_model->get_country_total_device(1,0)[0]->toplam;
        $viewData["urun_adet_2"]     =  $this->Cihaz_model->get_country_total_device(2,0)[0]->toplam;
        $viewData["urun_adet_3"]     =  $this->Cihaz_model->get_country_total_device(3,0)[0]->toplam;
        $viewData["urun_adet_4"]     =  $this->Cihaz_model->get_country_total_device(4,0)[0]->toplam;
        $viewData["urun_adet_5"]     =  $this->Cihaz_model->get_country_total_device(5,0)[0]->toplam;
        $viewData["urun_adet_6"]     =  $this->Cihaz_model->get_country_total_device(6,0)[0]->toplam;
        $viewData["urun_adet_7"]     =  $this->Cihaz_model->get_country_total_device(7,0)[0]->toplam;
        $viewData["urun_adet_8"]     =  $this->Cihaz_model->get_country_total_device(8,0)[0]->toplam;
		$viewData["page"] = "talep/cihaz_harita";
		$this->load->view('base_view',$viewData);
	}

    public function cihaz_harita_il_detay($sehir_id = 1,$urun_id = 1)
	{
        yetki_kontrol("cihaz_raporu_goruntule");
        $sehir_data = $this->Cihaz_model->get_country_device($urun_id);
        $viewData["sehir_verileri"] = $sehir_data;
        $viewData["secilen_urun"] = $urun_id;
        $viewData["secilen_sehir"] = $sehir_id;
        $viewData["secilen_sehir_adi"] = $this->db->where("sehir_id",$sehir_id)->select("sehir_adi")->from("sehirler")->get()->result()[0]->sehir_adi;
        $viewData["urun_adet_1"] =  $this->Cihaz_model->get_country_device(1,$sehir_id)[0]->toplam;
        $viewData["urun_adet_2"] =  $this->Cihaz_model->get_country_device(2,$sehir_id)[0]->toplam;
        $viewData["urun_adet_3"] =  $this->Cihaz_model->get_country_device(3,$sehir_id)[0]->toplam;
        $viewData["urun_adet_4"] =  $this->Cihaz_model->get_country_device(4,$sehir_id)[0]->toplam;
        $viewData["urun_adet_5"] =  $this->Cihaz_model->get_country_device(5,$sehir_id)[0]->toplam;
        $viewData["urun_adet_6"] =  $this->Cihaz_model->get_country_device(6,$sehir_id)[0]->toplam;
        $viewData["urun_adet_7"] =  $this->Cihaz_model->get_country_device(7,$sehir_id)[0]->toplam;
        $viewData["urun_adet_8"] =  $this->Cihaz_model->get_country_device(8,$sehir_id)[0]->toplam;
        $viewData["page"] = "talep/sehir_detay";
		$this->load->view('base_view',$viewData);
	}




    public function rg_medikal_cihaz_harita($urun_id = 0)
	{
        yetki_kontrol("cihaz_raporu_goruntule");
        $sehir_data = $this->Cihaz_model->get_rg_medikal_country_device($urun_id);
        $viewData["sehir_verileri"] = $sehir_data;
        $olmayansehirler = $this->db
            ->select("*")
            ->from("sehirler")
            ->get()->result();
        $viewData["olmayansehirler"] = $olmayansehirler;
        $viewData["secilen_urun"] = $urun_id;
        $viewData["urun_adet_0"] =  $this->Cihaz_model->get_rg_medikal_country_total_device(0,0)[0]->toplam;
        $viewData["urun_adet_1"] =  $this->Cihaz_model->get_rg_medikal_country_total_device(1,0)[0]->toplam;
        $viewData["urun_adet_2"] =  $this->Cihaz_model->get_rg_medikal_country_total_device(2,0)[0]->toplam;
        $viewData["urun_adet_3"] =  $this->Cihaz_model->get_rg_medikal_country_total_device(3,0)[0]->toplam;
        $viewData["urun_adet_4"] =  $this->Cihaz_model->get_rg_medikal_country_total_device(4,0)[0]->toplam;
        $viewData["urun_adet_5"] =  $this->Cihaz_model->get_rg_medikal_country_total_device(5,0)[0]->toplam;
        $viewData["urun_adet_6"] =  $this->Cihaz_model->get_rg_medikal_country_total_device(6,0)[0]->toplam;
        $viewData["urun_adet_7"] =  $this->Cihaz_model->get_rg_medikal_country_total_device(7,0)[0]->toplam;
        $viewData["urun_adet_8"] =  $this->Cihaz_model->get_rg_medikal_country_total_device(8,0)[0]->toplam;
		$viewData["page"] = "talep/rg_medikal_cihaz_harita";
		$this->load->view('base_view',$viewData);
	}

    public function rg_medikal_cihaz_harita_il_detay($sehir_id = 1,$urun_id = 1)
	{
        yetki_kontrol("cihaz_raporu_goruntule");
        $sehir_data = $this->Cihaz_model->get_rg_medikal_country_device($urun_id);
        $viewData["sehir_verileri"] = $sehir_data;
        $viewData["secilen_urun"] = $urun_id;
        $viewData["secilen_sehir"] = $sehir_id;
        $viewData["secilen_sehir_adi"] = $this->db->where("sehir_id",$sehir_id)->select("sehir_adi")->from("sehirler")->get()->result()[0]->sehir_adi;
        $viewData["urun_adet_1"] =  $this->Cihaz_model->get_rg_medikal_country_device(1,$sehir_id)[0]->toplam;
        $viewData["urun_adet_2"] =  $this->Cihaz_model->get_rg_medikal_country_device(2,$sehir_id)[0]->toplam;
        $viewData["urun_adet_3"] =  $this->Cihaz_model->get_rg_medikal_country_device(3,$sehir_id)[0]->toplam;
        $viewData["urun_adet_4"] =  $this->Cihaz_model->get_rg_medikal_country_device(4,$sehir_id)[0]->toplam;
        $viewData["urun_adet_5"] =  $this->Cihaz_model->get_rg_medikal_country_device(5,$sehir_id)[0]->toplam;
        $viewData["urun_adet_6"] =  $this->Cihaz_model->get_rg_medikal_country_device(6,$sehir_id)[0]->toplam;
        $viewData["urun_adet_7"] =  $this->Cihaz_model->get_rg_medikal_country_device(7,$sehir_id)[0]->toplam;
        $viewData["urun_adet_8"] =  $this->Cihaz_model->get_rg_medikal_country_device(8,$sehir_id)[0]->toplam;
        $viewData["page"] = "talep/rg_medikal_sehir_detay";
		$this->load->view('base_view',$viewData);
	}















    public function cihaz_tanimlama_view($musteri_id=0)
	{  
        yetki_kontrol("cihaz_tanimlama");
		$cihazlar = $this->Urun_model->get_all(); 
        $musteriler = $this->Merkez_model->get_all(["musteri_aktif"=>1]); 
        $viewData['cihazlar']        =  $cihazlar;
        $viewData['musteriler']      =  $musteriler;
        $viewData['secilen_musteri'] =  $musteri_id;


        
		$viewData["page"] = "cihaz/yeni_cihaz_tanimla"; 
		$this->load->view('base_view',$viewData);
	}

     public function rg_medikal_cihaz_tanimlama_view($musteri_id=0)
	{  
        yetki_kontrol("cihaz_tanimlama");
		$cihazlar = $this->Urun_model->get_all(); 
        $musteriler = $this->Merkez_model->get_all(["musteri_aktif"=>1]); 
        $viewData['cihazlar'] =  $cihazlar;
        $viewData['musteriler'] =  $musteriler;
        $viewData['secilen_musteri'] =  $musteri_id;
        $this->load->model('Sehir_model'); 
        $il_data = $this->Sehir_model->get_all();    
		$viewData["sehirler"] = $il_data;
        
		$viewData["page"] = "cihaz/rg_yeni_cihaz_tanimla"; 
		$this->load->view('base_view',$viewData);
	}
    public function cihaz_tanimla_save($servis_kayit = 0)
	{  
        yetki_kontrol("cihaz_tanimlama");
		$siparis_id        = $this->input->post("siparis_id"); 
        $musteri_id        = $this->input->post("musteri_id"); 
        $cihaz_id          = $this->input->post("cihaz_id"); 
        $seri_numarasi     = $this->input->post("seri_numarasi"); 
        $renk              = $this->input->post("renk"); 
        $garanti_baslangic = $this->input->post("garanti_baslangic"); 
        $garanti_bitis     = $this->input->post("garanti_bitis"); 
       

        $check_data = $this->db
        ->select("*")
        ->where(['seri_numarasi'=> $seri_numarasi])
        ->get("siparis_urunleri");

        if($check_data && $check_data->num_rows()){
            $this->session->set_flashdata('flashDanger','Girilen seri numarası başka bir cihaza tanımlanmıştır. Bilgileri kontrol edip tekrar deneyiniz.');
            redirect($_SERVER['HTTP_REFERER']); 
          }





        if($siparis_id == 0){

            $yeni_siparis["merkez_no"] =  $musteri_id;
            $yeni_siparis["siparisi_olusturan_kullanici"] =  $this->session->userdata('aktif_kullanici_id');
            $this->Siparis_model->insert($yeni_siparis);
            $siparis_id = $this->db->insert_id();
            $siparis_kod_format = "SPR".date("dmY").str_pad($siparis_id, 5, '0', STR_PAD_LEFT);
            $this->db->where('siparis_id', $siparis_id);
            $this->db->update('siparisler', ["siparis_kodu"=>$siparis_kod_format]);
            for ($i=1; $i <= 12 ; $i++) { 
                $siparis_onay_hareket_adim["siparis_no"] =  $siparis_id;
                $siparis_onay_hareket_adim["adim_no"] = $i;
                $siparis_onay_hareket_adim["onay_durum"] =  1;
                $siparis_onay_hareket_adim["onay_aciklama"] =   "Hızlı Sipariş Tanımlama - Otomatik Onay";
                $siparis_onay_hareket_adim["onay_kullanici_id"] =    $this->session->userdata('aktif_kullanici_id');   
                $this->Siparis_onay_hareket_model->insert($siparis_onay_hareket_adim);
            } 
		
        }

            $siparis_urun["siparis_kodu"] 		= $siparis_id;
			$siparis_urun["urun_no"] 			=  $cihaz_id;
            $siparis_urun["garanti_baslangic_tarihi"] =  $garanti_baslangic;
            $siparis_urun["garanti_bitis_tarihi"] 	  =  $garanti_bitis;
            $siparis_urun["seri_numarasi"] 		=  $seri_numarasi;
			$siparis_urun["satis_fiyati"] 		= "0";
			$siparis_urun["pesinat_fiyati"] 	= "0";
			$siparis_urun["kapora_fiyati"] 		= "0";
			$siparis_urun["renk"] 				= $renk;
			$siparis_urun["odeme_secenek"]		= 1;
			$siparis_urun["vade_sayisi"]		= 0;
			$siparis_urun["damla_etiket"]		= 0;
			$siparis_urun["acilis_ekrani"]		= 0;
			$siparis_urun["basliklar"]		    = null;	
			$siparis_urun["siparis_urun_notu"] 	= "Hızlı Sipariş Tanımlama - Otomatik Onay";
			$this->Siparis_urun_model->insert($siparis_urun);
            $inserted_id = $this->db->insert_id();

            if($servis_kayit != 0){
                redirect(base_url("servis/servis_cihaz_sorgula_view?data=".$seri_numarasi));
              }

              
            redirect(base_url("cihaz/edit/".$inserted_id));

	}






  public function pre_up($str){
        $str = str_replace('i', 'İ', $str);
        $str = str_replace('ı', 'I', $str);
        return $str;
    }


     public function rg_medikal_cihaz_tanimla_save()
	{  

 

        yetki_kontrol("cihaz_tanimlama");


       
 $data['rg_medikal'] = 1;
        $data['musteri_ad']                 = mb_strtoupper($this->pre_up(escape($this->input->post('musteri_ad'))), 'UTF-8');
        $data['musteri_iletisim_numarasi']  = escape(str_replace(" ","",$this->input->post('musteri_iletisim_numarasi')));
        $query = $this->db->where([
                "musteri_iletisim_numarasi" => str_replace(" ","",$this->input->post('musteri_iletisim_numarasi'))
            ])->get("musteriler");

            if(count($query->result()) > 0){
                $this->session->set_flashdata('flashDanger', escape($this->input->post('musteri_iletisim_numarasi'))." nolu iletişim bilgisiyle daha önce müşteri kaydı oluşturulmuştur. Tekrar müşteri kaydı oluşturulamaz.");
                redirect($_SERVER['HTTP_REFERER']);
            }



            $data['musteri_sorumlu_kullanici_id']  = escape($this->session->userdata('aktif_kullanici_id'));
           
            $this->Musteri_model->insert($data);
            $insert_musteri_id = $this->db->insert_id();
                            
            $musteridata['musteri_kod']   = "M1".str_pad($insert_musteri_id,5,"0",STR_PAD_LEFT);;
            $this->Musteri_model->update($insert_musteri_id,$musteridata);



            $merkez_data["merkez_yetkili_id"] = $insert_musteri_id;
            $merkez_data["merkez_adi"] = "MERKEZ ADI GİRİLMEDİ";
 
            $merkez_data["merkez_il_id"] = escape($this->input->post('merkez_il_id'));
            $merkez_data["merkez_ilce_id"] = escape($this->input->post('merkez_ilce_id'));
            $merkez_data["merkez_adresi"] ="#NULL#";
            $this->Merkez_model->insert($merkez_data);
            $insert_merkez_id = $this->db->insert_id();


 




		$siparis_id        = 0; 
        $musteri_id        = $insert_musteri_id; 
        $cihaz_id          = $this->input->post("cihaz_id"); 
        $seri_numarasi     = $this->input->post("seri_numarasi"); 
        $renk              = $this->input->post("renk"); 
        $garanti_baslangic = $this->input->post("garanti_baslangic"); 
        $garanti_bitis     = $this->input->post("garanti_bitis"); 
       

        $check_data = $this->db
        ->select("*")
        ->where(['seri_numarasi'=> $seri_numarasi])
        ->get("siparis_urunleri");

        if($check_data && $check_data->num_rows()){
            $this->session->set_flashdata('flashDanger','Girilen seri numarası başka bir cihaza tanımlanmıştır. Bilgileri kontrol edip tekrar deneyiniz.');
            redirect($_SERVER['HTTP_REFERER']); 
          }





        if($siparis_id == 0){

            $yeni_siparis["merkez_no"] =   $insert_merkez_id;
            $yeni_siparis["siparisi_olusturan_kullanici"] =  $this->session->userdata('aktif_kullanici_id');
            $this->Siparis_model->insert($yeni_siparis);
            $siparis_id = $this->db->insert_id();
            $siparis_kod_format = "SPR".date("dmY").str_pad($siparis_id, 5, '0', STR_PAD_LEFT);
            $this->db->where('siparis_id', $siparis_id);
            $this->db->update('siparisler', ["siparis_kodu"=>$siparis_kod_format]);
            for ($i=1; $i <= 12 ; $i++) { 
                $siparis_onay_hareket_adim["siparis_no"] =  $siparis_id;
                $siparis_onay_hareket_adim["adim_no"] = $i;
                $siparis_onay_hareket_adim["onay_durum"] =  1;
                $siparis_onay_hareket_adim["onay_aciklama"] =   "RG Medikal Hızlı Tanımlama - Otomatik Onay";
                $siparis_onay_hareket_adim["onay_kullanici_id"] =    $this->session->userdata('aktif_kullanici_id');   
                $this->Siparis_onay_hareket_model->insert($siparis_onay_hareket_adim);
            } 
		
        }

            $siparis_urun["siparis_kodu"] 		= $siparis_id;
			$siparis_urun["urun_no"] 			=  $cihaz_id;
            $siparis_urun["garanti_baslangic_tarihi"] 			=  $garanti_baslangic;
            $siparis_urun["garanti_bitis_tarihi"] 			=  $garanti_bitis;
            $siparis_urun["seri_numarasi"] 		=  $seri_numarasi;
			$siparis_urun["satis_fiyati"] 		= "0";
			$siparis_urun["pesinat_fiyati"] 	= "0";
			$siparis_urun["kapora_fiyati"] 		= "0";
			$siparis_urun["renk"] 				= $renk;
			$siparis_urun["odeme_secenek"]		= 1;
			$siparis_urun["vade_sayisi"]		= 0;
			$siparis_urun["damla_etiket"]		= 0;
			$siparis_urun["acilis_ekrani"]		= 0;
			$siparis_urun["basliklar"]		    = null;	
			$siparis_urun["siparis_urun_notu"] 	= "Hızlı Sipariş Tanımlama - Otomatik Onay";
			$this->Siparis_urun_model->insert($siparis_urun);
            $inserted_id = $this->db->insert_id();
 
    
            redirect(base_url("cihaz/rgmedikalindex"));
 
	}





    function cihaz_degisim($siparis_urun_id = 0) {  

        yetki_kontrol("cihaz_degisim");

        if($siparis_urun_id != 0 ){
            $siparis_urun = $this->Cihaz_model->get_all(["siparis_urun_id"=>$siparis_urun_id])[0];
            $viewData["siparis_urun"] =  $siparis_urun;
            $viewData["musteriler"] = $this->Merkez_model->get_all(["musteri_aktif"=>1]);
            $viewData["kullanicilar"] = $this->kullanici_model->get_all();
        }




        $this->load->model('Sehir_model'); 
        $this->load->model('Ilce_model');       
        $viewData1["page"] = "musteri/form";
        $ulke_data = $this->Sehir_model->get_all_ulkeler();    
		$viewData1["ulkeler"] = $ulke_data;
        $il_data = $this->Sehir_model->get_all();    
		$viewData1["sehirler"] = $il_data;
        $ilce_data = $this->Ilce_model->get_all();    
		$viewData1["ilceler"] = $ilce_data;
        $viewData["musteri_form"] =$this->load->view('musteri/form/main_content_clear.php', $viewData1, TRUE); 








     
        $viewData["page"] = "cihaz/cihaz_degisim";
		$this->load->view('base_view',$viewData);
      }






      function cihaz_degisim_save(){

        yetki_kontrol("cihaz_degisim");


        if($this->input->post("eski_merkez_id") == $this->input->post("yeni_merkez_id")){
            $this->session->set_flashdata('flashDanger','Cihaz değişim işlemi için farklı bir merkez kaydı seçmeniz gerekir. Bilgileri kontrol edip tekrar deneyiniz.');
            redirect($_SERVER['HTTP_REFERER']); 
        }



        $hareketdata = [];
        $hareketdata["siparis_urun_fg_id"] = $this->input->post("siparis_urun_id");
        $hareketdata["eski_merkez_id"] = $this->input->post("eski_merkez_id");
        $hareketdata["yeni_merkez_id"] = $this->input->post("yeni_merkez_id");
        $hareketdata["degisim_talep_eden_kullanici_id"] = $this->input->post("degisim_talep_eden_kullanici_id");
        $hareketdata["hareket_sorumlu_kullanici_id"] = aktif_kullanici()->kullanici_id;
        $this->db->insert("cihaz_degisim_hareketleri",$hareketdata);


        $check_id = $this->Cihaz_model->get_by_id($this->input->post("siparis_urun_id")); 
        $urunler = $this->Siparis_model->get_all_products_by_order_id($check_id[0]->siparis_kodu);
        if(count($urunler) > 1){
           
            $siparis = [];
            $siparis["merkez_no"] =  $this->input->post("yeni_merkez_id");
            $siparis["siparisi_olusturan_kullanici"] = 1;
            $this->Siparis_model->insert($siparis);
            $siparis_kodu = $this->db->insert_id();
            $siparis_kod_format = "SPR".date("dmY").str_pad($siparis_kodu, 5, '0', STR_PAD_LEFT);
            $this->db->where('siparis_id', $siparis_kodu);
            $this->db->update('siparisler', ["siparis_kodu"=>$siparis_kod_format]);

            $this->db->where('siparis_urun_id', $this->input->post("siparis_urun_id"));
            $this->db->update('siparis_urunleri', ["siparis_kodu"=>$siparis_kodu,"takas_alinan_merkez_id"=>$this->input->post("yeni_merkez_id")]);

        }else{
       
            $this->db->where('siparis_id', $check_id[0]->siparis_kodu);
            $this->db->update('siparisler', ["merkez_no"=>$this->input->post("yeni_merkez_id")]);
        }

       


 
	

        $this->session->set_flashdata('flashSuccess','Müşteriler arası cihaz değişim işlemi başarıyla gerçekleştirilmiştir.');
        redirect($_SERVER['HTTP_REFERER']); 
        

      }




    






  function urun_iade($urun_id) { 

    $a = aktif_kullanici()->kullanici_ad_soyad;


        $this->db->where('siparis_urun_id', $urun_id);
        $this->db->update('siparis_urunleri', ["urun_iade_durum"=>1,"urun_iade_tarihi"=>date("Y-m-d H:i:s"),"urun_iade_notu"=>$a]);
        redirect($_SERVER['HTTP_REFERER']); 
    }
    function urun_iade_sifirla($urun_id) { 
        $this->db->where('siparis_urun_id', $urun_id);
        $this->db->update('siparis_urunleri', ["urun_iade_durum"=>0]);
        redirect($_SERVER['HTTP_REFERER']); 
    }


    function power_kurulum_view() { 
        $viewData["cihazlar"] = $this->Urun_model->get_all();
        $viewData["page"] = "stok/power_kurulum";
		$this->load->view('base_view',$viewData);
      }



 function stok_tanimla() {  
    
    $data['urun_fg_id']  = escape($this->input->post('urun_fg_id'));
    $data['stok_fg_id']  = escape($this->input->post('stok_fg_id'));
    echo json_encode($data);
    $this->db->insert("cihaz_stok_tanimlari",$data);
    redirect(base_url("stok/cihaz_stok_tanimlari"));

}

public function stok_tanim_sil($id)
{     
  
    $this->db->delete('cihaz_stok_tanimlari', array('cihaz_stok_id' => $id));
    redirect($_SERVER['HTTP_REFERER']); 
}




    public function cihaz_havuz_sil($id)
	{     
        yetki_kontrol("cihaz_havuz_sil");
        $this->db->delete('cihaz_havuzu', array('cihaz_havuz_id' => $id));
        redirect($_SERVER['HTTP_REFERER']); 
	}



    function cihaz_havuz_tanimla_view() { 
        yetki_kontrol("cihaz_havuz_goruntule");
        $viewData["cihazlar"] =  $this->db->order_by('uretim_siralama', 'ASC')->get("urunler")->result();
        $viewData["page"] = "cihaz/cihaz_havuz_tanimla";
		$this->load->view('base_view',$viewData);
      } 


function cihaz_havuz_tanimla_stok_kaydet($cihaz_havuz_id = 0) { 
    $kullaniciaktif = aktif_kullanici();
    $check_id =$this->db->get_where("cihaz_havuzu",array('cihaz_havuz_id' => $cihaz_havuz_id))->result();
       
if($cihaz_havuz_id != 0 && count($check_id) > 0){
    $stok_kontrol = $this->db->where(["stok_cikis_yapildi"=>1,"stok_tanimlanma_durum"=>0,"stok_seri_kod" => str_replace(" ","",$this->input->post("havuz_parca_seri_no"))])->select('*')->from('stoklar sh')->get()->result();
    if(count($stok_kontrol) <= 0){
        $this->session->set_flashdata('flashDanger','Girilen seri numarası ile tanımlanmış ve stok çıkışı yapılmış parça kaydı bulunamadı. Stok yetkiliniz ile iletişime geçiniz.');
        redirect(base_url("cihaz/cihaz_havuz_tanimla_update_view/".$cihaz_havuz_id));
    }else{
        $this->db->where(["stok_id"=>$stok_kontrol[0]->stok_id]);
        $this->db->update("stoklar",["tanimlanan_cihaz_seri_numarasi"=>$check_id[0]->cihaz_havuz_seri_numarasi,"stok_tanimlanma_durum"=>1,"cihaz_tanimlama_tarihi"=>date("Y-m-d H:i"),"cihaz_tanimlama_notlari"=>($stok_kontrol[0]->cihaz_tanimlama_notlari.",".date("Y-m-d H:i")." Havuz düzenleme sırasında tanımlandı (".$kullaniciaktif->kullanici_ad_soyad.")")]);
        $this->session->set_flashdata('flashSuccess','Yeni parça tanımı başarıyla gerçekleştirilmiştir.');
        redirect(base_url("cihaz/cihaz_havuz_tanimla_update_view/".$cihaz_havuz_id));
    }
}else{
    $this->session->set_flashdata('flashDanger','Kayıt bulunamadı. Stok tanımlama işlemi başarısız.');
    redirect(base_url("cihaz/cihaz_havuz_tanimla_update_view/".$cihaz_havuz_id));

}

}



function cihaz_havuz_stok_sil($stok_id = 0) { 
    yetki_kontrol("cihaz_tanimli_parca_sil");
    $kullaniciaktif = aktif_kullanici(); 
    if($stok_id != 0){
        $stok_kontrol = $this->db->where(["stok_id"=>$stok_id])->select('*')->from('stoklar sh')->get()->result();
        if(count($stok_kontrol) <= 0){
            $this->session->set_flashdata('flashDanger','Seçilen kayıt ID ile tanımlanmış stok bulunamadı. Stok yetkiliniz ile iletişime geçiniz.');
            redirect($_SERVER['HTTP_REFERER']); 
        }else{
            $this->db->where(["stok_id"=>$stok_id]);
            $this->db->update("stoklar",["tanimlanan_cihaz_seri_numarasi"=>"0","stok_tanimlanma_durum"=>0,"cihaz_tanimlama_notlari"=>($stok_kontrol[0]->cihaz_tanimlama_notlari.",".date("Y-m-d H:i")." Havuz düzenleme sırasında cihazdan silindi. (".$kullaniciaktif->kullanici_ad_soyad.")")]);

        }
    }else{
        $this->session->set_flashdata('flashDanger','Kayıt bulunamadı. Stok tanımlama işlemi başarısız.');
        redirect($_SERVER['HTTP_REFERER']); 

    }

}

  function pasifeal($urunid) { 
    $this->db->where("siparis_urun_id",$urunid)->update("siparis_urunleri",["cihaz_satilmis_aktif_degil"=>1,"cihaz_satilmis_aktif_degil_guncelleme_tarihi"=>date("Y-m-d H:i")]);
    redirect($_SERVER['HTTP_REFERER']); 
  }
 function aktifeal($urunid) { 
     $this->db->where("siparis_urun_id",$urunid)->update("siparis_urunleri",["cihaz_satilmis_aktif_degil"=>0,"cihaz_satilmis_aktif_degil_guncelleme_tarihi"=>date("Y-m-d H:i")]);
    redirect($_SERVER['HTTP_REFERER']); 
  }



      function cihaz_havuz_tanimla_update_view($id = 0) { 
        yetki_kontrol("cihaz_havuz_duzenle");
        $check_id =$this->db->get_where("cihaz_havuzu",array('cihaz_havuz_id' => $id))->result();
        if($check_id){
            $viewData["cihazlar"] = $this->Urun_model->get_all();
            $viewData["cihaz"] = $check_id[0];
            $viewData["renkler"] = $this->db->get_where('urun_renkleri', array('urun_no' => $check_id[0]->cihaz_kayit_no))->result();

            $this->db->order_by("cihaz_tanimlama_tarihi","DESC");
            $viewData["stoklar"] = $this->Stok_model->stok_kayitlari_all(["tanimlanan_cihaz_seri_numarasi"=>$check_id[0]->cihaz_havuz_seri_numarasi]); 



            $viewData["page"] = "cihaz/cihaz_havuz_guncelle";
            $this->load->view('base_view',$viewData);
        }else{
            redirect($_SERVER['HTTP_REFERER']); 
        }
       
      } 
      function cihaz_havuz_liste_view() { 
        //->where("cihaz_havuz_durum",1)
        yetki_kontrol("cihaz_havuz_goruntule");
        $this->db->order_by('cihaz_havuz_durum',"DESC");
        $viewData["cihazlar"] = $this->db
        ->join("urunler","cihaz_havuzu.cihaz_kayit_no = urunler.urun_id")
        ->join("urun_renkleri","cihaz_havuzu.cihaz_renk_no = urun_renkleri.renk_id")
        ->get("cihaz_havuzu")->result();
        $viewData["page"] = "cihaz/cihaz_havuz_liste";
		$this->load->view('base_view',$viewData);
      } 

      function cihaz_havuz_tanimla_save() { 

        
        $check_data = $this->db
        ->select("*")
        ->where(['seri_numarasi'=> escape($this->input->post('cihaz_seri_numarasi'))])
        ->get("siparis_urunleri");

        if($check_data && $check_data->num_rows()){
            $this->session->set_flashdata('flashDanger','Girilen seri numarası başka bir sipariş cihazına tanımlanmıştır. Bilgileri kontrol edip tekrar deneyiniz.');
            redirect($_SERVER['HTTP_REFERER']); 
          }

          $check_data = $this->db
          ->select("*")
          ->where(['cihaz_havuz_seri_numarasi'=> escape($this->input->post('cihaz_seri_numarasi'))])
          ->get("cihaz_havuzu");
  
          if($check_data && $check_data->num_rows()){
              $this->session->set_flashdata('flashDanger','Girilen seri numarası başka bir stok cihaza tanımlanmıştır. Bilgileri kontrol edip tekrar deneyiniz.');
              redirect($_SERVER['HTTP_REFERER']); 
            }
  





        $data['cihaz_havuz_seri_numarasi']  = escape($this->input->post('cihaz_seri_numarasi'));
        $data['cihaz_kayit_no']             = escape($this->input->post('cihaz_id')); 
        $data['cihaz_renk_no']              = escape($this->input->post('ekle_renk')); 
        $data['cihaz_havuz_durum']          = 1; 
        $data['yenilenmis_urun_mu']         = escape($this->input->post('yenilenmis_urun_mu')); 
        $this->db->insert('cihaz_havuzu',$data);





 
        $seri_kodlar = json_decode(json_encode($this->input->post('parca_seri_numaralar[]')));
       // echo json_encode($this->input->post('parca_seri_numaralar[]'));return;
            foreach ($seri_kodlar as $seri_kod) {
              
                $this->db->where(["stok_seri_kod"=>$seri_kod]);
                $this->db->update("stoklar",["tanimlanan_cihaz_seri_numarasi"=>$this->input->post('cihaz_seri_numarasi'),"stok_tanimlanma_durum"=>1,"cihaz_tanimlama_tarihi"=>date("Y-m-d H:i")]);
/*
                if(
                str_starts_with($seri_kod, '13.0001') ||
                str_starts_with($seri_kod, '13.0002') ||
                str_starts_with($seri_kod, '13.0009') ||
                str_starts_with($seri_kod, '13.00010') 
                ){

                    $control_stok_tanim = $this->db->where([""])->get("stok_tanimlari")->result()[0];
                    $havuzbaslikdata = [];
                    $havuzbaslikdata["baslik_seri_numarasi"] = $seri_kod;
                    $havuzbaslikdata["cihaz_seri_numarasi"] = escape($this->input->post('cihaz_seri_numarasi'));
                    $havuzbaslikdata["cihaz_kayit_no"] = escape($this->input->post('cihaz_id'));
                    $havuzbaslikdata["baslik_kayit_no"] = ;
                    $this->db->insert("baslik_havuzu",$havuzbaslikdata)
                }
               */

            }
 




       redirect(base_url("cihaz/cihaz_havuz_liste_view"));
      } 

    function cihaz_havuz_tanimla_updatesave($id = '') { 
    yetki_kontrol("cihaz_havuz_duzenle");
    $check_id =$this->db->get_where("cihaz_havuzu",array('cihaz_havuz_id' => $id))->result();

     
        if($check_id){
            $data['cihaz_havuz_seri_numarasi']  = escape($this->input->post('cihaz_seri_numarasi'));
            $data['cihaz_kayit_no']             = escape($this->input->post('cihaz_id')); 
            $data['cihaz_renk_no']              = escape($this->input->post('ekle_renk')); 
            $this->db->where('cihaz_havuz_id', $id);
            $this->db->update('cihaz_havuzu', $data); 
         }
     
       redirect(base_url("cihaz/cihaz_havuz_liste_view"));
      } 

 function edit($id = '',$modal_format = 0)
	{  
        
        yetki_kontrol("cihaz_duzenle");
		$check_id = $this->Cihaz_model->get_by_id($id); 
        if($check_id){  
            $viewData['urun'] = $check_id[0];

            $siparis = $this->Siparis_model->get_by_id($check_id[0]->siparis_kodu); 
            $viewData['siparis']         = $siparis[0];
            $viewData['basliklar']       =  $this->Urun_model->get_baslik_tanimlari(["siparis_urun_id"=>$id]);
             $viewData['basliklar_data'] =  $this->Urun_model->get_basliklar();
            
            $viewData['urunler']    =  $this->Siparis_model->get_all_products_by_order_id($id);
            $viewData['merkez']     =  $this->Merkez_model->get_by_id($siparis[0]->merkez_no);
            $viewData["egitimler"]  = $this->Egitim_model->get_all(["siparis_urun_id"=>$id]); 

            $viewData["atis_yuklemeleri"] = $this->Servis_model->get_atis_yuklemeleri(["siparis_urun_id"=>$id]); 
            $viewData["servisler"] = $this->Servis_model->get_all(["siparis_urun_id"=>$id]);    
           
            $viewData["mymusteriler"] = $this->Merkez_model->get_all();

			$viewData["page"] = "cihaz/form"; 

            if($modal_format == 1){
				$viewData["pageformat"] = "1";
				$this->load->view('base_view_modal',$viewData);
			}else{
				$viewData["pageformat"] = "0";
				$this->load->view('base_view',$viewData);
			}



			 
        }else{
            redirect(site_url('cihaz'));
        }
 
	}

	public function save($id = '')
	{   
        $a = aktif_kullanici()->kullanici_ad_soyad;


        if(empty($id)){
            yetki_kontrol("cihaz_ekle");
        }else{
            yetki_kontrol("cihaz_duzenle");
        }
        $this->form_validation->set_rules('seri_numarasi',  'Cihaz Adı',  'required'); 
        
        $garanti_baslangic = date('Y-m-d',strtotime($this->input->post('garanti_baslangic_tarihi')));
        $garanti_bitis = date('Y-m-d',strtotime($this->input->post('garanti_bitis_tarihi')));

        $data['seri_numarasi']            = escape($this->input->post('seri_numarasi'));
        $data['garanti_baslangic_tarihi'] = $garanti_baslangic; 
        $data['garanti_bitis_tarihi']     = $garanti_bitis;
       
        $data['takas_alinan_merkez_id'] = $this->input->post("takas_alinan_merkez_id");
        $data['takas_cihaz_mi']         = escape($this->input->post('c_takas_cihaz_mi'));
        if($this->input->post("takas_cihaz_mi") == "1"){
            $data['urun_takas_notu']        = (date("d.m.Y H:i")." tarihinde ".$a." tarafından takas olarak işaretlenmiştir.");
    
        }
     



        if ($this->form_validation->run() != FALSE && !empty($id)) {
            $check_id = $this->Cihaz_model->get_by_id($id);
            if($check_id){
                $this->Cihaz_model->update($id,$data);
                $this->Baslik_model->update_all($id,["baslik_garanti_baslangic_tarihi"=>$garanti_baslangic,"baslik_garanti_bitis_tarihi"=>$garanti_bitis]);
            }
        }elseif($this->form_validation->run() != FALSE && empty($id)){
            $check_data = $this->db
        ->select("*")
        ->where(['seri_numarasi'=> escape($this->input->post('seri_numarasi'))])
        ->get("siparis_urunleri");

        if($check_data && $check_data->num_rows()){
            $this->session->set_flashdata('flashDanger','Girilen seri numarası başka bir cihaza tanımlanmıştır. Bilgileri kontrol edip tekrar deneyiniz.');
            redirect($_SERVER['HTTP_REFERER']); 
          }



            $data['cihaz_sorumlu_kullanici_id']  = escape($this->session->userdata('aktif_kullanici_id'));
            $this->Cihaz_model->insert($data);
        }else{
            $this->session->set_flashdata('form_errors', json_encode($this->form_validation->error_array()));
            redirect(site_url('cihaz/ekle'));
        }
		redirect(site_url('cihaz'));
	}



 public function tummusteriler() { 
    
    yetki_kontrol("demirbas_goruntule");
    $query = $this->db->where(["siparis_urun_aktif"=>1])
    ->select("musteriler.musteri_kayit_tarihi,kullanicilar.kullanici_ad_soyad,merkezler.merkez_kayit_guncelleme_notu,musteriler.musteri_kayit_guncelleme_notu,musteriler.musteri_ad,borclu_cihazlar.borc_durum as cihaz_borc_uyarisi,musteriler.musteri_id,musteriler.musteri_kod,musteriler.musteri_iletisim_numarasi,
    merkezler.merkez_adi,merkezler.merkez_adresi,merkezler.merkez_yetkili_id,  merkezler.merkez_id,
              urunler.urun_adi, urunler.urun_slug,siparisler.siparis_kodu,siparisler.siparis_id,
              siparis_urunleri.siparis_urun_id, siparis_urunleri.musteri_degisim_aciklama,
              siparis_urunleri.seri_numarasi,siparis_urunleri.urun_iade_durum,siparis_urunleri.urun_iade_tarihi,
              siparis_urunleri.garanti_baslangic_tarihi,
              siparis_urunleri.garanti_bitis_tarihi,siparis_urunleri.siparis_urun_aktif,
              siparis_urunleri.takas_bedeli,siparis_urunleri.satis_fiyati,siparis_urunleri.takas_cihaz_mi,
              sehirler.sehir_adi, sehirler.sehir_id,
              ilceler.ilce_adi,urun_renkleri.renk_adi")
    ->order_by('siparis_urun_id', 'DESC')
    ->join("urunler","urunler.urun_id = siparis_urunleri.urun_no")
    ->join("siparisler","siparis_urunleri.siparis_kodu = siparisler.siparis_id")
    ->join("merkezler","siparisler.merkez_no = merkezler.merkez_id")
    ->join("musteriler","merkezler.merkez_yetkili_id = musteriler.musteri_id")
    ->join("sehirler","merkezler.merkez_il_id = sehirler.sehir_id")
    ->join("ilceler","merkezler.merkez_ilce_id = ilceler.ilce_id")
    ->join("borclu_cihazlar","borclu_cihazlar.borclu_seri_numarasi = siparis_urunleri.seri_numarasi","left")
    ->join("kullanicilar","kullanicilar.kullanici_id = musteriler.musteri_sorumlu_kullanici_id","left")
    ->join("urun_renkleri","siparis_urunleri.renk = urun_renkleri.renk_id","left")
    ->order_by($order, $dir)
    ->order_by('siparis_urun_id', 'DESC')

    ->limit($limit, $start)
    ->get("siparis_urunleri");
    $viewData["data"] = $query->result();
    $viewData["page"] = "musteri/tummusteriler";
    $this->load->view('base_view',$viewData);

 }

 public function tumcihazlar() { 
    
    if(empty($this->input->post('filter_garanti_bitis_tarihi')) || $this->input->post('filter_garanti_bitis_tarihi') == null){
        $garanti_bitis = date('Y-m-d');
    }else{
        $garanti_bitis = date('Y-m-d',strtotime($this->input->post('filter_garanti_bitis_tarihi')));
    }
    
    $control = date('Y-m-d',strtotime("01.01.2010"));
    yetki_kontrol("cihazlari_goruntule");
    $query = $this->db->where(["siparis_urun_aktif"=>1])->where(["garanti_bitis_tarihi <="=> $garanti_bitis])->where(["garanti_bitis_tarihi >"=> $control])->where(["seri_numarasi !="=> ""])
    ->select("musteriler.musteri_kayit_tarihi,kullanicilar.kullanici_ad_soyad,merkezler.merkez_kayit_guncelleme_notu,musteriler.musteri_kayit_guncelleme_notu,musteriler.musteri_ad,borclu_cihazlar.borc_durum as cihaz_borc_uyarisi,musteriler.musteri_id,musteriler.musteri_kod,musteriler.musteri_iletisim_numarasi,
    merkezler.merkez_adi,merkezler.merkez_adresi,merkezler.merkez_yetkili_id,  merkezler.merkez_id,
              urunler.urun_adi, urunler.urun_slug,siparisler.siparis_kodu,siparisler.siparis_id,
              siparis_urunleri.siparis_urun_id, siparis_urunleri.musteri_degisim_aciklama,
              siparis_urunleri.seri_numarasi,siparis_urunleri.urun_iade_durum,siparis_urunleri.urun_iade_tarihi,
              siparis_urunleri.garanti_baslangic_tarihi,siparis_urunleri.cihaz_satilmis_aktif_degil,
              siparis_urunleri.garanti_bitis_tarihi,siparis_urunleri.siparis_urun_aktif,
              siparis_urunleri.takas_bedeli,siparis_urunleri.satis_fiyati,siparis_urunleri.takas_cihaz_mi,
              sehirler.sehir_adi, sehirler.sehir_id,
              ilceler.ilce_adi,urun_renkleri.renk_adi")
    ->order_by('garanti_bitis_tarihi', 'ASC')
    ->join("urunler","urunler.urun_id = siparis_urunleri.urun_no")
    ->join("siparisler","siparis_urunleri.siparis_kodu = siparisler.siparis_id")
    ->join("merkezler","siparisler.merkez_no = merkezler.merkez_id")
    ->join("musteriler","merkezler.merkez_yetkili_id = musteriler.musteri_id")
    ->join("sehirler","merkezler.merkez_il_id = sehirler.sehir_id")
    ->join("ilceler","merkezler.merkez_ilce_id = ilceler.ilce_id")
    ->join("borclu_cihazlar","borclu_cihazlar.borclu_seri_numarasi = siparis_urunleri.seri_numarasi","left")
    ->join("kullanicilar","kullanicilar.kullanici_id = musteriler.musteri_sorumlu_kullanici_id","left")
    ->join("urun_renkleri","siparis_urunleri.renk = urun_renkleri.renk_id","left")
    ->get("siparis_urunleri");
    $viewData["data"] = $query->result();
    $viewData["page"] = "musteri/tumcihazlar"; 
    $this->load->view('base_view',$viewData);

 }
 



 public function adana_mersin_cihazlari() { 
    
     
     
    yetki_kontrol("cihazlari_goruntule");
    $query = $this->db
    ->where('siparis_urun_aktif', 1)
->group_start()
    ->where('merkezler.merkez_il_id', 1)
    ->or_where('merkezler.merkez_il_id', 58)
->group_end()
->where('seri_numarasi !=', '')

    ->select("musteriler.musteri_kayit_tarihi,kullanicilar.kullanici_ad_soyad,merkezler.merkez_kayit_guncelleme_notu,musteriler.musteri_kayit_guncelleme_notu,musteriler.musteri_ad,borclu_cihazlar.borc_durum as cihaz_borc_uyarisi,musteriler.musteri_id,musteriler.musteri_kod,musteriler.musteri_iletisim_numarasi,
    merkezler.merkez_adi,merkezler.merkez_adresi,merkezler.merkez_yetkili_id,  merkezler.merkez_id,
              urunler.urun_adi, urunler.urun_slug,siparisler.siparis_kodu,siparisler.siparis_id,
              siparis_urunleri.siparis_urun_id, siparis_urunleri.musteri_degisim_aciklama,
              siparis_urunleri.seri_numarasi,siparis_urunleri.urun_iade_durum,siparis_urunleri.urun_iade_tarihi,
              siparis_urunleri.garanti_baslangic_tarihi,siparis_urunleri.cihaz_satilmis_aktif_degil,
              siparis_urunleri.garanti_bitis_tarihi,siparis_urunleri.siparis_urun_aktif,
              siparis_urunleri.takas_bedeli,siparis_urunleri.satis_fiyati,siparis_urunleri.takas_cihaz_mi,
              sehirler.sehir_adi, sehirler.sehir_id,
              ilceler.ilce_adi,urun_renkleri.renk_adi")
    ->order_by('garanti_bitis_tarihi', 'ASC')
    ->join("urunler","urunler.urun_id = siparis_urunleri.urun_no")
    ->join("siparisler","siparis_urunleri.siparis_kodu = siparisler.siparis_id")
    ->join("merkezler","siparisler.merkez_no = merkezler.merkez_id")
    ->join("musteriler","merkezler.merkez_yetkili_id = musteriler.musteri_id")
    ->join("sehirler","merkezler.merkez_il_id = sehirler.sehir_id")
    ->join("ilceler","merkezler.merkez_ilce_id = ilceler.ilce_id")
    ->join("borclu_cihazlar","borclu_cihazlar.borclu_seri_numarasi = siparis_urunleri.seri_numarasi","left")
   ->join("kullanicilar","kullanicilar.kullanici_id = siparisler.siparisi_olusturan_kullanici","left")
    ->join("urun_renkleri","siparis_urunleri.renk = urun_renkleri.renk_id","left")
    ->get("siparis_urunleri");
    $viewData["data"] = $query->result();
    $viewData["page"] = "musteri/tumcihazlaradanamersin"; 
    $this->load->view('base_view',$viewData);

 }
 


public function tumcihazlarilbazli() { 
      $this->load->model('Sehir_model'); 
     $sehirler = $this->Sehir_model->get_all();
        $viewData["sehirler"] = $sehirler;

if(empty($this->input->post('cihaz_id'))){
    $filter_cihaz_id = 1;
  
} else{
     $filter_cihaz_id = $this->input->post('cihaz_id');
}
if(empty($this->input->post('il_id'))){
    $filter_il_id = 1;
  
} else{
      $filter_il_id = $this->input->post('il_id');
}

if($this->input->post('il_id')!=9999){
   
  $this->db->where(["merkezler.merkez_il_id"=> $filter_il_id]);
}
 
    $query = $this->db->where(["siparis_urun_aktif"=>1])
    ->where(["urunler.urun_id"=> $filter_cihaz_id])
    ->where(["seri_numarasi !="=> ""])
    ->select("musteriler.musteri_kayit_tarihi,kullanicilar.kullanici_ad_soyad,merkezler.merkez_kayit_guncelleme_notu,musteriler.musteri_kayit_guncelleme_notu,musteriler.musteri_ad,borclu_cihazlar.borc_durum as cihaz_borc_uyarisi,musteriler.musteri_id,musteriler.musteri_kod,musteriler.musteri_iletisim_numarasi,
    merkezler.merkez_adi,merkezler.merkez_adresi,merkezler.merkez_yetkili_id,  merkezler.merkez_id,
              urunler.urun_adi, urunler.urun_slug,siparisler.siparis_kodu,siparisler.siparis_id,
              siparis_urunleri.siparis_urun_id, siparis_urunleri.musteri_degisim_aciklama,
              siparis_urunleri.seri_numarasi,siparis_urunleri.urun_iade_durum,siparis_urunleri.urun_iade_tarihi,
              siparis_urunleri.garanti_baslangic_tarihi,
              siparis_urunleri.garanti_bitis_tarihi,siparis_urunleri.siparis_urun_aktif,
              siparis_urunleri.takas_bedeli,siparis_urunleri.satis_fiyati,siparis_urunleri.takas_cihaz_mi,
              sehirler.sehir_adi, sehirler.sehir_id,
              ilceler.ilce_adi,urun_renkleri.renk_adi")
    ->order_by('garanti_bitis_tarihi', 'ASC')
    ->join("urunler","urunler.urun_id = siparis_urunleri.urun_no")
    ->join("siparisler","siparis_urunleri.siparis_kodu = siparisler.siparis_id")
    ->join("merkezler","siparisler.merkez_no = merkezler.merkez_id")
    ->join("musteriler","merkezler.merkez_yetkili_id = musteriler.musteri_id")
    ->join("sehirler","merkezler.merkez_il_id = sehirler.sehir_id")
    ->join("ilceler","merkezler.merkez_ilce_id = ilceler.ilce_id")
    ->join("borclu_cihazlar","borclu_cihazlar.borclu_seri_numarasi = siparis_urunleri.seri_numarasi","left")
    ->join("kullanicilar","kullanicilar.kullanici_id = musteriler.musteri_sorumlu_kullanici_id","left")
    ->join("urun_renkleri","siparis_urunleri.renk = urun_renkleri.renk_id","left")
 
    ->get("siparis_urunleri");
    $viewData["data"] = $query->result();
        $viewData["filter_cihaz_id"] = $filter_cihaz_id ; 
                $viewData["filter_il_id"] = $filter_il_id ; 
            $viewData["page"] = "musteri/tumcihazlarilbazli";  
    $this->load->view('base_view',$viewData);

 }




        public function tumcihazlaryenilenmis() { 
            
            yetki_kontrol("demirbas_goruntule");
            $query = $this->db->where(["siparis_urun_aktif"=>1])->where("yenilenmis_cihaz_mi",1)->where(["seri_numarasi !="=> ""])
            ->select("musteriler.musteri_kayit_tarihi,kullanicilar.kullanici_ad_soyad,merkezler.merkez_kayit_guncelleme_notu,musteriler.musteri_kayit_guncelleme_notu,musteriler.musteri_ad,borclu_cihazlar.borc_durum as cihaz_borc_uyarisi,musteriler.musteri_id,musteriler.musteri_kod,musteriler.musteri_iletisim_numarasi,
                    merkezler.merkez_adi,merkezler.merkez_adresi,merkezler.merkez_yetkili_id,  merkezler.merkez_id,
                    urunler.urun_adi, urunler.urun_slug,siparisler.siparis_kodu,siparisler.siparis_id,
                    siparis_urunleri.siparis_urun_id, siparis_urunleri.musteri_degisim_aciklama,
                    siparis_urunleri.seri_numarasi,siparis_urunleri.urun_iade_durum,siparis_urunleri.urun_iade_tarihi,
                    siparis_urunleri.garanti_baslangic_tarihi,
                    siparis_urunleri.garanti_bitis_tarihi,siparis_urunleri.siparis_urun_aktif,
                    siparis_urunleri.takas_bedeli,siparis_urunleri.satis_fiyati,siparis_urunleri.takas_cihaz_mi,
                    sehirler.sehir_adi, sehirler.sehir_id,
                    ilceler.ilce_adi,urun_renkleri.renk_adi")
            ->order_by('garanti_bitis_tarihi', 'ASC')
            ->join("urunler","urunler.urun_id = siparis_urunleri.urun_no")
            ->join("siparisler","siparis_urunleri.siparis_kodu = siparisler.siparis_id")
            ->join("merkezler","siparisler.merkez_no = merkezler.merkez_id")
            ->join("musteriler","merkezler.merkez_yetkili_id = musteriler.musteri_id")
            ->join("sehirler","merkezler.merkez_il_id = sehirler.sehir_id")
            ->join("ilceler","merkezler.merkez_ilce_id = ilceler.ilce_id")
            ->join("borclu_cihazlar","borclu_cihazlar.borclu_seri_numarasi = siparis_urunleri.seri_numarasi","left")
            ->join("kullanicilar","kullanicilar.kullanici_id = musteriler.musteri_sorumlu_kullanici_id","left")
            ->join("urun_renkleri","siparis_urunleri.renk = urun_renkleri.renk_id","left")
        
            ->get("siparis_urunleri");
            $viewData["data"] = $query->result(); 
            $viewData["page"] = "musteri/tumcihazlaryenilenmis";
            $this->load->view('base_view',$viewData);

        }


    public function sadece_musteri_ajax($search) {



        $query = $this->db->get("musteriler");
        $data = [];
        foreach ($query->result() as $row) {
             $data[] = [ "","","","","","",""];
        }
        $totalData = $this->db->count_all('siparis_urunleri');
        $totalFiltered = $totalData;

        $json_data = [
            "draw" => intval($this->input->get('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        ];

        echo json_encode($json_data);

    }
   




    public function cihazlar_ajax($sehir_id = 0,$urun_id = 0,$rg_mi=0) {

		yetki_kontrol("cihazlari_goruntule");
        $kullanici_id = aktif_kullanici()->kullanici_id;
        $limit = $this->input->get('length');
        $start = $this->input->get('start');
        $search = $this->input->get('search')['value']; 
        $order = $this->input->get('order')[0]['column'];
        $dir = $this->input->get('order')[0]['dir'];
if($search != null)
{ 
    if (!(strncmp(mb_strtoupper($search), "UG", 2) === 0)){
       $query = $this->db
    ->group_start()
        ->like("musteri_ad", $search)
        ->or_like("musteri_iletisim_numarasi", $search)
        ->or_like("merkez_adi", $search)
        ->or_like("sehir_adi", $search)
        ->or_like("ilce_adi", $search)
    ->group_end()
    ->where("musteri_aktif", 1)
    ->where("rg_medikal", $rg_mi)
    ->join('musteriler', 'musteriler.musteri_id = merkez_yetkili_id')
    ->join('sehirler', 'sehirler.sehir_id = merkez_il_id','left')
    ->join('ilceler', 'ilceler.ilce_id = merkez_ilce_id','left')
     ->order_by('merkez_id', 'ASC')
    ->get("merkezler");


        $data = [];
        foreach ($query->result() as $row) {
         
          
            $musteri = '<a target="_blank" style="font-weight: 500;"  href="https://ugbusiness.com.tr/musteri/profil/'.$row->musteri_id.'"><i class="fa fa-user-circle" style="color: #035ab9;"></i> '.$row->musteri_ad.'</a>';     

             $data[] = [ "","",$musteri."<span>($row->musteri_iletisim_numarasi)</span>",$row->merkez_adi,"<span style='font-weight:400'>".$row->merkez_adresi."</span>"." ".$row->ilce_adi." / ".$row->sehir_adi,"",""];
        }
        $totalData = $this->db->count_all('siparis_urunleri');
        $totalFiltered = $totalData;

        $json_data = [
            "draw" => intval($this->input->get('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        ];

        echo json_encode($json_data);
        return;
      }
}
 
    
  $this->db->where("musteriler.rg_medikal",$rg_mi);
  if($sehir_id != 0){
                $this->db->where(["sehirler.sehir_id"=>$sehir_id]);
            }
            if($urun_id != 0){
                $this->db->where(["urunler.urun_id"=>$urun_id]);
            }
        if(!empty($search)) {
            if($search == "iade"){
                $this->db->where(["urun_iade_durum"=>1]);
            }if($search == "takas"){
                $this->db->where(["takas_cihaz_mi"=>1]);
            }
            else{
                $this->db->like('urun_adi', $search); 
                $this->db->or_like('seri_numarasi', $search);   
                 $this->db->or_like('musteri_iletisim_numarasi', $search); 
                 $this->db->or_like('musteri_ad', $search); 
                 $this->db->or_like('merkez_adi', $search); 
                 $this->db->or_like('sehir_adi', $search); 
                 $this->db->or_like('ilce_adi', $search); 
            }
    
        }

 


		$query = $this->db->where(["siparis_urun_aktif"=>1])
        ->select("musteriler.musteri_kayit_tarihi,kullanicilar.kullanici_ad_soyad,merkezler.merkez_kayit_guncelleme_notu,musteriler.musteri_kayit_guncelleme_notu,musteriler.musteri_ad,borclu_cihazlar.borc_durum as cihaz_borc_uyarisi,musteriler.musteri_id,musteriler.musteri_kod,musteriler.musteri_iletisim_numarasi,
        merkezler.merkez_adi,merkezler.merkez_adresi,merkezler.merkez_yetkili_id,  merkezler.merkez_id,
                  urunler.urun_adi, urunler.urun_slug,siparisler.siparis_kodu,siparisler.siparis_id,
                  siparis_urunleri.siparis_urun_id, siparis_urunleri.musteri_degisim_aciklama,
                  siparis_urunleri.seri_numarasi,siparis_urunleri.urun_iade_durum,siparis_urunleri.urun_iade_tarihi,
                  siparis_urunleri.garanti_baslangic_tarihi,  siparis_urunleri.egitim_cihazi_mi,
                  siparis_urunleri.garanti_bitis_tarihi,siparis_urunleri.siparis_urun_aktif,
                  siparis_urunleri.takas_bedeli,siparis_urunleri.satis_fiyati,siparis_urunleri.takas_cihaz_mi,siparis_urunleri.yenilenmis_cihaz_mi,
                  sehirler.sehir_adi, sehirler.sehir_id,
                  ilceler.ilce_adi,urun_renkleri.renk_adi")
        ->order_by('siparis_urun_id', 'DESC')
        ->join("urunler","urunler.urun_id = siparis_urunleri.urun_no")
        ->join("siparisler","siparis_urunleri.siparis_kodu = siparisler.siparis_id")
        ->join("merkezler","siparisler.merkez_no = merkezler.merkez_id")
        ->join("musteriler","merkezler.merkez_yetkili_id = musteriler.musteri_id")
        ->join("sehirler","merkezler.merkez_il_id = sehirler.sehir_id")
        ->join("ilceler","merkezler.merkez_ilce_id = ilceler.ilce_id")
        ->join("borclu_cihazlar","borclu_cihazlar.borclu_seri_numarasi = siparis_urunleri.seri_numarasi","left")
        ->join("kullanicilar","kullanicilar.kullanici_id = musteriler.musteri_sorumlu_kullanici_id","left")
        ->join("urun_renkleri","siparis_urunleri.renk = urun_renkleri.renk_id","left")
        ->order_by($order, $dir)
		->order_by('siparis_urun_id', 'DESC')
	
		->limit($limit, $start)
        ->get("siparis_urunleri");
				   
		 
				

                      

        $data = [];
        foreach ($query->result() as $row) {




            if($row->siparis_urun_aktif == 0){
                continue;
            }



                $a = get_borc_durum_sorgula($row->seri_numarasi);
              if($row->seri_numarasi != "" && ($a>0) ){
                $uu =  '<br><a style="padding-top:3px;color:white!important;font-size: 12px!important;" class="btn btn-danger yanipsonenyazinew   btn-xs">Borç Uyarısı</a>';
            }else{
                $uu = '';
            }




            $gbaslangic = "";
            if(date("Y-m-d",strtotime($row->garanti_bitis_tarihi)) == date("Y-m-d",strtotime($row->garanti_baslangic_tarihi))){
                $gbaslangic =  '<i class="fas fa-exclamation-circle" style="border-radius:7px;color:#000000;margin-right:5px;opacity:1"></i> '." <span style='color:#c1c1c1'>Başlama: Başlatılmadı</span>";
          
              }else{
                if(date("Y-m-d",strtotime($row->garanti_bitis_tarihi)) < date("Y-m-d")){
                    $gbaslangic =  '<i class="fas fa-times" style="    padding-right: 4px;border-radius:7px;color:red; margin-right:5px;opacity:1"></i>'."<span style='color:red'>Başlama: ".date("d.m.Y",strtotime($row->garanti_baslangic_tarihi))."</span>";
                }else if(date("Y-m-d",strtotime($row->garanti_bitis_tarihi)) == date("Y-m-d",strtotime($row->garanti_baslangic_tarihi))){
                    $gbaslangic =  '<i class="fas fa-exclamation-circle" style="border-radius:7px;color:#000000;margin-right:5px;opacity:1"></i> '." <span style='color:#c1c1c1'>Başlama: Başlatılmadı</span>";
            
                }else{
                    $gbaslangic =  '<i class="fas fa-check" style="border-radius:7px;color:#00711a;margin-right:5px;opacity:1"></i>'."<span style='color:#00711a'>Başlama:  ".date("d.m.Y",strtotime($row->garanti_baslangic_tarihi))."</span>";
                }
                   }




            $gbitis = "";
            if(date("Y-m-d",strtotime($row->garanti_bitis_tarihi)) == date("Y-m-d",strtotime($row->garanti_baslangic_tarihi))){
                $gbitis =  '<i class="fas fa-exclamation-circle" style="border-radius:7px;color:#000000; margin-right:5px;opacity:1"></i> '." <span style='color:#c1c1c1'>Bitiş: Başlatılmadı</span>";
          
              }else{
                if(date("Y-m-d",strtotime($row->garanti_bitis_tarihi)) < date("Y-m-d")){
                    $gbitis =  '<i class="fas fa-times" style="    padding-right: 4px;border-radius:7px;color:red; margin-right:5px;opacity:1"></i>'."<span style='color:red'>Bitiş: ".date("d.m.Y",strtotime($row->garanti_bitis_tarihi))."</span>";
                }else if(date("Y-m-d",strtotime($row->garanti_bitis_tarihi)) == date("Y-m-d",strtotime($row->garanti_baslangic_tarihi))){
                    $gbitis =  '<i class="fas fa-exclamation-circle" style="border-radius:7px;color:#000000; margin-right:5px;opacity:1"></i> '." <span style='color:#c1c1c1'>Bitiş: Başlatılmadı</span>";
            
                }else{
                    $gbitis =  '<i class="fas fa-check" style="border-radius:7px;color:#00711a; margin-right:5px;opacity:1"></i>'."<span style='color:#00711a'>Bitiş: ".date("d.m.Y",strtotime($row->garanti_bitis_tarihi))."</span>";
                }
                   }

                   $musteri = '<a target="_blank" style="font-weight: 500;"  href="https://ugbusiness.com.tr/musteri/profil/'.$row->musteri_id.'"><i class="fa fa-user-circle" style="color: #035ab9;"></i> '.$row->musteri_ad.'</a>';     
  
                    $musteri .= '<a  target="_blank" type="button" onclick="showWindow(\''.base_url("musteri/duzenle/".$row->musteri_id).'\');"  class="btn btn-xs btn-warning p-0 pl-1 pr-1" style="font-size: 10px!important;font-weight:normal;margin-left:10px;"><i class="fa fa-pen"></i> Düzenle</a>';     
$urlcustom = base_url("siparis/report/").urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$row->siparis_id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE"));
			
$filter_merkez_adresi = ((strlen($row->merkez_adresi) > 50) ? mb_substr($row->merkez_adresi, 0, 40) . '...': $row->merkez_adresi) ;

            $data[] = [ 
			  $row->siparis_urun_id.(($row->yurtdisi_mi == 1)?"<br><span style='color:red'  class='yanipsonenyazinew'>YURTDIŞI CİHAZ</span>":""),
			  "<span class='".($row->egitim_cihazi_mi == 1 ? "egitimcihazi" : "n")."' style='font-weight:bold'>".$row->urun_adi." (".$row->renk_adi.")</span>".
              "<br><span style='font-weight:normal'>".(($row->seri_numarasi) ? $row->seri_numarasi : "<span style='opacity:0.2'>UG00000000UX00</span>").
              (($row->yenilenmis_cihaz_mi == 1) ? "<br><span class='text-success'>(Yenilenmiş Cihaz)</span>" : "").
               
              "</span>" .$uu.($row->urun_iade_durum != 0 ? '<br><div style="  background: #ff03031c;border: 1px solid #ff0000;border-radius: 3px;padding: 2px;color: #801e00; "><i class="fas fa-times-circle"></i><b style="font-weight: 490;"> İade : </b><span style="font-weight:normal"> '.date("d.m.Y",strtotime($row->urun_iade_tarihi)).'</span></div>' : "")
              .($row->takas_cihaz_mi != 0 ? '<br><div style="  background: #ffb7001c;border: 1px solid #ff9d00;border-radius: 3px;padding: 2px;color: #d23100; "><i class="fas fa-arrow-circle-down"></i><b style="font-weight: 490;"> TAKAS CİHAZI </b></div>' : ""),
              $musteri."<br><span style='font-weight:normal'>İletişim : ".formatTelephoneNumber($row->musteri_iletisim_numarasi)."</span>"."<span style='display:none'>".$row->musteri_iletisim_numarasi."</span>"
              .'<div style="background: #938f8f1c;border: 1px solid #7b7b7b4f;border-radius: 3px;padding: 2px;color: #646564;margin-bottom: 3px;"><i class="fas fa-check-circle"></i><b style="font-weight: 490;"> Kaydedildi &nbsp;&nbsp; : </b><span style="font-weight:normal"> '.$row->kullanici_ad_soyad.' - '.date("d.m.Y H:i",strtotime($row->musteri_kayit_tarihi)).'</span></div>'
              .($row->musteri_kayit_guncelleme_notu != "" ? '<div style=" background: #03ff351c; border: 1px solid #00b324; border-radius: 3px; padding: 2px; color: green; "><i class="fas fa-check-circle"></i><b style="font-weight: 490;"> Güncellendi : </b><span style="font-weight:normal"> '.$row->musteri_kayit_guncelleme_notu.'</span></div>' : ""),
                
              "<span style='font-weight:normal'><b>".' <i class="fa fa-building" style="color: #ff6c00;"></i> '.($row->merkez_adi != "#NULL#" ? $row->merkez_adi : '<span class="badge bg-danger" style="background: #ffd1d1 !important; color: #b30000 !important; border: 1px solid red;"><i class="nav-icon 	fas fa-exclamation-circle"></i> Merkez Adı Girilmedi</span>')."</b> ". '<a type="button"  onclick="showWindow(\''.base_url("merkez/duzenle/".$row->merkez_id).'\');" target="_blank" class="btn btn-xs btn-warning p-0 pl-1 pr-1" style="font-size: 10px!important;font-weight:normal;"><i class="fa fa-pen"></i> Düzenle</a>'."<br>Sipariş Kodu : ".'<a class="text-primary" style="cursor:pointer" onclick="showDetail(\''.$urlcustom.'/1\')">'.(($row->satis_fiyati > 0) ? $row->siparis_kodu : "<span style='opacity:0.5;color:black!important'>Sistem Öncesi Kayıt / Sipariş Yok</span>")."</a>".($row->takas_bedeli > 0 ? " <span style='color: red;'>(Takaslı)</span>" : "")."</span>"
              .($row->merkez_kayit_guncelleme_notu != "" ? '<br><div style=" background: #03ff351c; border: 1px solid #00b324; border-radius: 3px; padding: 2px; color: green; "><i class="fas fa-check-circle"></i><b style="font-weight: 490;"> Güncellendi : </b><span style="font-weight:normal"> '.$row->merkez_kayit_guncelleme_notu.'</span></div>' : "")
              ,
             
              "<span title='$row->merkez_adresi' style='font-weight:normal'><b><i class='fas fa-map-marked-alt' style='color: #178018;'></i> ".$row->sehir_adi." / ".$row->ilce_adi."</b><br>".(($row->merkez_adresi == "" || $row->merkez_adresi == "0" || $row->merkez_adresi == ".")?"<span style='opacity:0.4'>BU MERKEZE TANIMLI ADRES KAYDI BULUNAMADI</span>":$filter_merkez_adresi)."</span>"
              .($row->merkez_kayit_guncelleme_notu != "" ? '<br><div style=" background: #03ff351c; border: 1px solid #00b324; border-radius: 3px; padding: 2px; color: green; "><i class="fas fa-check-circle"></i><b style="font-weight: 490;"> Güncellendi : </b><span style="font-weight:normal"> '.$row->merkez_kayit_guncelleme_notu.'</span></div>' : "")
            
              ,
             "<span style='font-weight:normal'>". $gbaslangic."<br>".$gbitis."</span>", 
              '
              <a type="button" onclick="showWindow(\''.base_url("cihaz/duzenle/".$row->siparis_urun_id).'\');" class="btn btn-primary mt-1" style="font-size: 12px!important;font-weight:normal"><i class="fa fa-pen"></i> Düzenle</a>
              <a type="button" '.($row->seri_numarasi == "" ? "disabled" : "").' href="https://ugbusiness.com.tr/cihaz/cihaz_degisim/'.$row->siparis_urun_id.'" class="btn btn-success mt-1" style="font-size: 12px!important;font-weight:normal;'.($row->seri_numarasi == "" ? " pointer-events: none;cursor: default;opacity: 0.1;background:black!important;" : "").'"><i class="fas fa-random"></i></a>
             
              <a type="button" href="https://ugbusiness.com.tr/egitim/add/'.$row->siparis_urun_id.'" class="btn btn-dark mt-1 " style="font-size: 12px!important;font-weight:normal"><i class="fa fa-plus"></i> Eğitim Ekle</a>
              '

			  
			];
        }
       
        $totalData = $this->db->count_all('siparis_urunleri');
        $totalFiltered = $totalData;

        $json_data = [
            "draw" => intval($this->input->get('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        ];

        echo json_encode($json_data);
    }



}
