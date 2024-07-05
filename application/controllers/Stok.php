<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
		$this->load->model('Stok_model');
        $this->load->model('Urun_model');
        date_default_timezone_set('Europe/Istanbul');
       
    }
	public function index()
	{ yetki_kontrol("stok_yonetim");
		redirect(base_url("stok/stok_genel_bakis"));
	}
 
	public function stok_seri_no_kontrol()
	{	 
		$query = $this->Stok_model->get_stok_kayitlari(["stok_seri_kod"=>$this->input->post('seri_numarasi'),"stok_cikis_yapildi"=>1]) ;    
        if (count($query) > 0) {
            $stok_durumu = ($query[0]->stok_durum == 0) ? 0 : 1;
            $alt_parcalar = $this->db->where(["stok_ust_grup_kayit_no" => $query[0]->stok_id])->select('*')->from('stoklar')->get()->result();
   
 
        } else {    
            $stok_durumu = 2;
        }
		echo json_encode(array('stok_durumu' => $stok_durumu,'alt_parcalar' => $alt_parcalar));
	} 
    
    public function get_parca_alt_stoklar()
	{
        
        $query = $this->Stok_model->get_stok_kayitlari(["stok_seri_kod"=>$this->input->post('seri_numarasi')]) ;    
        
		echo json_encode($this->Stok_model->get_stok_tanimlari(["st.stok_tanim_ust_grup_id"=>$query[0]->stok_tanim_kayit_id]));
		 
	} 

	public function get_cihaz_stok_tanimlari($id)
	{
		echo json_encode($this->Stok_model->get_cihaz_stok_tanimlari(["urun_id"=>$id,"stok_paketleme"=>0]));
		 
	} 

	public function stok_genel_bakis()
	{
		$data = $this->Stok_model->get_stok_genel_bakis();
		$viewData["stok_tanim_list"] = $data;
		$viewData["stok_tanimlari"] = $data;
		$viewData["page"] = "stok/stok_tanimlari";
		$this->load->view('base_view',$viewData);
	}
	public function cikis_stok_kayitlari()
	{
        $data = $this->Stok_model->get_stok_tanimlari();
        $viewData["stok_tanim_list"] = $data;
		$viewData["stoklar"] = $this->Stok_model->get_stok_kayitlari(); 
		$viewData["page"] = "stok/stok_tanimlari";
		$this->load->view('base_view',$viewData);
	} 
    public function giris_stok_kayitlari()
	{
        $data = $this->Stok_model->get_stok_tanimlari();
        $viewData["stok_tanim_list"] = $data;
		$viewData["stoklar"] = $this->Stok_model->get_stok_kayitlari(); 
		$viewData["page"] = "stok/stok_tanimlari";
		$this->load->view('base_view',$viewData);
	} 



    public function cihaz_stok_tanimlari()
	{
        $data = $this->Stok_model->get_cihaz_stok_tanimlari();
        $viewData["cihazlardata"] = $this->Urun_model->get_all();
        $data1 = $this->Stok_model->get_stok_genel_bakis();
		$viewData["stok_tanim_list"] = $data1;
        $viewData["cihaz_stok_tanimlari"] = $data;
		$viewData["page"] = "stok/stok_tanimlari";
		$this->load->view('base_view',$viewData);
	} 
   
    public function coklu_stok_cikis()
	{
		$viewData["page"] = "stok/stok_cikis";
		$this->load->view('base_view',$viewData);
	} 
   


    public function coklu_stok_cikis_kontrol() {
        $seriKod = $this->input->post('seriKod');
        $urun = $this->Stok_model->get_stok_kayitlari(["stok_seri_kod" => $this->input->post("seriKod")]); 
           
        if ($urun) {
            echo json_encode($urun);
        } else {
            echo json_encode(['error' => 'Ürün bulunamadı']);
        }
    }







	public function stok_kaydet()
    {
        $stokdata["stok_tanim_kayit_id"] = $this->input->post("stok_tanim_kayit_id");
        $amount = $this->input->post("stok_miktar");
        
        if ($amount > 0) {
            if($this->input->post("seri_kod")){
                $data = $this->Stok_model->get_stok_kayitlari(["stok_seri_kod" => $this->input->post("seri_kod")]); 
                if(count($data)>0){
                    $this->session->set_flashdata('flashDanger','Girilen seri numarası daha önce başka bir parça için kaydedilmiştir. Bilgileri kontrol edip tekrar deneyiniz.');
                    redirect($_SERVER['HTTP_REFERER']); 
                }
            }

            $stok_takip_kontrol_data = $this->Stok_model->get_stok_tanimlari(["st.stok_tanim_id" => $this->input->post("stok_tanim_kayit_id")]); 
       
            if($stok_takip_kontrol_data[0]->stok_takip == 0){
                for ($i = 0; $i < $amount; $i++) {
                    $insert_id = $this->Stok_model->add_stok($stokdata);
                    $stok_eklenen_data = $this->Stok_model->get_stok_kayitlari(["stok_id" => $insert_id]);
                   
                    $stok_giris_data = [];
                    $stok_giris_data["stok_fg_id"] = $insert_id;
                    $stok_giris_data["giris_miktar"] = 1;
                    $stok_giris_data["hareket_kaydeden_kullanici"] = aktif_kullanici()->kullanici_id;
                    $this->Stok_model->add_stok_hareket($stok_giris_data);

                    if ($stok_eklenen_data) {
                        if($this->input->post("seri_kod")){
                            $this->Stok_model->update_stok($insert_id, ["stok_seri_kod" => "01.034/LM".$this->input->post("seri_kod")]);
                        }else{
                            $this->update_stok_seri_kod($stok_eklenen_data[0], $insert_id);
                        }
                    }
                }
            }else{
                    
                    $data = $this->Stok_model->get_stok_kayitlari(["stok_tanim_kayit_id" => $this->input->post("stok_tanim_kayit_id")]); 
                    if(count($data)>0){
                        $insert_id = $data[0]->stok_id;
               
                    }else{
                        $insert_id = $this->Stok_model->add_stok($stokdata);
               
                    }
                        $stok_eklenen_data = $this->Stok_model->get_stok_kayitlari(["stok_id" => $insert_id]);
                   
                    $this->update_stok_seri_kod($stok_eklenen_data[0], $insert_id); 
                    
                    $stok_giris_data = [];
                    $stok_giris_data["stok_fg_id"] = $insert_id;
                    $stok_giris_data["giris_miktar"] = $amount;
                    $stok_giris_data["hareket_kaydeden_kullanici"] = aktif_kullanici()->kullanici_id;
                    $this->Stok_model->add_stok_hareket($stok_giris_data);
            }
           
        }
        redirect(base_url("stok/giris_stok_kayitlari"));
    } 
public function stok_sorgula()
{
    $data = [];
   
    $yeni_lamba = $this->db->where(["stok_tanimlanma_durum"=>0,"stok_cikis_yapildi"=>1,"stok_seri_kod" => str_replace(" ","",$this->input->post("lamba_seri_kod"))])->select('*')->from('stoklar sh')->get()->result();
    if (count($yeni_lamba)<=0) {
         $data["lamba_durum"] = "false";
    }else{
        $data["lamba_durum"] = "true";
    }


    $baslik = $this->db->where(["stok_seri_kod" => str_replace(" ","",$this->input->post("baslik_kod"))])->select('*')->from('stoklar sh')->get()->result();
    if(count($baslik) > 0){
        $stok = $this->db->where(["stok_ust_grup_kayit_no"=>$baslik[0]->stok_id,"stok_seri_kod" => str_replace(" ","",$this->input->post("eski_lamba_seri_kod"))])->select('*')->from('stoklar sh')->get()->result();
        if (count($stok)<=0) {
        $data["eski_lamba_durum"] = "false";
         
     } else{
        $data["eski_lamba_durum"] = "true";
         
     }
    }else{
        $data["eski_lamba_durum"] = "true";
    }

    echo json_encode($data);
 

}
 

public function eski_lamba_sorgula()
{
    $baslik = $this->db->where(["stok_seri_kod" => str_replace(" ","",$this->input->post("baslik_kod"))])->select('*')->from('stoklar sh')->get()->result();
   if(count($baslik) > 0){
    $stok = $this->db->where(["stok_ust_grup_kayit_no"=>$baslik[0]->stok_id])->select('*')->from('stoklar sh')->get()->result();
    if (count($stok)<=0) {
         echo "false";
    } else{
        echo "true";
    }
   }else{
    echo "false";
}
 
}



public function lamba_sorgula()
{
    $baslik = $this->db->where(["stok_seri_kod" => str_replace(" ","",$this->input->post("baslik_kod"))])->select('*')->from('stoklar sh')->get()->result();
   if(count($baslik) > 0){
    $stok = $this->db->where(["stok_ust_grup_kayit_no"=>$baslik[0]->stok_id,"stok_seri_kod" => str_replace(" ","",$this->input->post("lamba_kod"))])->select('*')->from('stoklar sh')->get()->result();
    if (count($stok)<=0) {
         echo "false";
    }else{
        echo "true";
    }
   }else{
    echo "true";
}
 
}


private function update_stok_seri_kod($stok_data, $insert_id)
{
    if (!empty($stok_data->stok_tanim_prefix)) {
        $grup = $stok_data->stok_tanim_grup_kod;
        $prefix = $stok_data->stok_tanim_prefix;
        $date = date("dmy");
        $uretim = count($this->Stok_model->get_stok_kayitlari(null, "$grup/$prefix$date")) + 1;
        if($prefix != ""){
            $seri_kod = "$grup/$prefix$date." . str_pad($uretim, 3, "0", STR_PAD_LEFT);
           

        }else{
            $seri_kod = $grup;
        }
       
        $this->Stok_model->update_stok($insert_id, ["stok_seri_kod" => $seri_kod]);
    }else{
        $grup = $stok_data->stok_tanim_grup_kod; 
        $this->Stok_model->update_stok($insert_id, ["stok_seri_kod" => $grup]);
    }
}


public function update_power_stok()
{
    $qr1 = $this->input->post('birinci_stok_seri_kod');
    $qr2 = $this->input->post('ikinci_stok_seri_kod');
    
    $birinci_stok = $this->db->where(["stok_cikis_yapildi"=>1,"stok_seri_kod" => str_replace(" ","",$qr1)])->select('*')->from('stoklar sh')->get()->result();
    $ikinci_stok = $this->db->where(["stok_cikis_yapildi"=>1,"stok_seri_kod" => str_replace(" ","",$qr2)])->select('*')->from('stoklar sh')->get()->result();
    
   
    
    if (count($birinci_stok)<=0 ||count($ikinci_stok)<=0 ) {
        $this->session->set_flashdata('flashDanger', "Girilen seri numarası ile tanımlanmış ve stok çıkışı yapılmış kayıt bulunamadı. Stok eşleşmesi başarısız.");
        redirect(base_url("stok/cikis_stok_kayitlari"));
    }
    $this->db->where(["stok_id"=>$ikinci_stok[0]->stok_id]);
    $this->db->update("stoklar",["stok_ust_grup_kayit_no"=>$birinci_stok[0]->stok_id]);

    $this->session->set_flashdata('flashSuccess', "Stok eşleşmesi başarıyla tamamlanmıştır.");
    redirect($_SERVER['HTTP_REFERER']."?filter=stok-eslestir");
}



public function stok_cikis_yap()
{
    $control = $this->Stok_model->stok_kayitlari_all(["sh.stok_seri_kod" => str_replace(" ","",escape($this->input->post('cikis_yapilacak_seri_kod')))]);
    if (count($control) <= 0) {
        $control = $this->Stok_model->stok_kayitlari_all(["sh.stok_seri_kod" => "01.034/LM".str_replace(" ","",escape($this->input->post('cikis_yapilacak_seri_kod')))]);
   
    }
    if (count($control) > 0) {
        
        if ($control[0]->stok_cikis_yapildi == 1) {
            $this->session->set_flashdata('flashDanger', "Girilen seri kodlu stok için ".date("d.m.Y H:s")." tarihinde çıkış işlemi yapılmıştır. Tekrar çıkış işlemi yapılamaz.");
            redirect(base_url("stok/cikis_stok_kayitlari")."?filter=stok-cikis");
        }else{
 
            $this->Stok_model->update_stok($control[0]->stok_id, ["stok_cikis_yapildi" => 1,"stok_cikis_tarihi" => date("Y-m-d H:i:s")]);
            
            $stok_cikis_data = [];
            $stok_cikis_data["stok_fg_id"] = $control[0]->stok_id;
            $stok_cikis_data["cikis_miktar"] = $this->input->post('stok_cikis_miktar');
            $stok_cikis_data["hareket_kaydeden_kullanici"] = aktif_kullanici()->kullanici_id;
            $stok_cikis_data["stok_cikis_birim_fg_id"] = $this->input->post('stok_cikis_birim_fg_id'); 
           
            $this->Stok_model->add_stok_hareket($stok_cikis_data);


            
            $alt_parcalar = $this->db->where(["stok_ust_grup_kayit_no" => $control[0]->stok_id])->select('*')->from('stoklar sh')->get()->result();
   
           // echo json_encode($alt_parcalar );return;
            foreach ($alt_parcalar as $alt_parca) {
                $this->Stok_model->update_stok($alt_parca->stok_id, ["stok_cikis_tarihi" => date("Y-m-d H:i:s"),"stok_cikis_yapildi" => 1]);
                $stok_cikis_data = [];
                $stok_cikis_data["stok_fg_id"] = $alt_parca->stok_id;
                $stok_cikis_data["cikis_miktar"] = $this->input->post('stok_cikis_miktar');
                $stok_cikis_data["hareket_kaydeden_kullanici"] = aktif_kullanici()->kullanici_id;
                  $stok_cikis_data["stok_cikis_birim_fg_id"] = $this->input->post('stok_cikis_birim_fg_id'); 
           
                $this->Stok_model->add_stok_hareket($stok_cikis_data);
            }
            redirect(base_url("stok/cikis_stok_kayitlari")."?filter=stok-cikis");
        }  
    }else{
        
        $this->session->set_flashdata('flashDanger', "Girilen seri kodlu stok kaydı bulunamamıştır. Stok çıkış işlemi başarısız.");
        redirect(base_url("stok/cikis_stok_kayitlari")."?filter=stok-cikis");
    }
    
}

public function stok_degisim()
{
    $control = $this->db->where(["sh.stok_seri_kod" => str_replace(" ","",escape($this->input->post('degisim_yapilacak_seri_kod')))])->select('*')->from('stoklar sh')->get()->result();
    $alt_parcalar = $this->db->where(["stok_ust_grup_kayit_no" => $control[0]->stok_id])->select('*')->from('stoklar sh')->get()->result();
    if(count($alt_parcalar) <= 0){
        $this->session->set_flashdata('flashDanger', "Girilen stok kaydı ile ile ilgili stok eşleşmeleri tamamlanmadığı için stok giriş işlemi başarısız.");
        redirect($_SERVER['HTTP_REFERER']."?filter=stok-degisim");
    }


    if (count($control) > 0) {
        if ($control[0]->stok_cikis_yapildi == 0) {
            $this->session->set_flashdata('flashDanger', "Girilen seri kodlu için stok giriş yapmadan önce stok çıkış işlemi yapmanız gerekmektedir.");
            redirect($_SERVER['HTTP_REFERER']."?filter=stok-degisim");
        }else{
 

            // YENİ STOK KAYIT
            $stokdata["stok_tanim_kayit_id"] = $this->input->post("degisim_stok_tanim_kayit_id");
            $insert_id = $this->Stok_model->add_stok($stokdata);
           
            $stok_giris_data = [];
            $stok_giris_data["stok_fg_id"] =$insert_id;
            $stok_giris_data["giris_miktar"] = 1;
            $stok_giris_data["hareket_kaydeden_kullanici"] = aktif_kullanici()->kullanici_id;
            $this->Stok_model->add_stok_hareket($stok_giris_data);


            $stok_eklenen_data = $this->Stok_model->get_stok_kayitlari(["stok_id" => $insert_id]);
            if ($stok_eklenen_data) {
                $this->update_stok_seri_kod($stok_eklenen_data[0], $insert_id);
            }
            // YENİ STOK KAYIT - END 
            $this->Stok_model->update_stok($control[0]->stok_id, ["stok_ust_grup_kayit_no" => $insert_id,"qr_durum" => 0,"stok_cikis_yapildi" => 0]);
            $stok_giris_data = [];
            $stok_giris_data["stok_fg_id"] =$control[0]->stok_id;
            $stok_giris_data["giris_miktar"] = 1;
            $stok_giris_data["hareket_kaydeden_kullanici"] = aktif_kullanici()->kullanici_id;
            $this->Stok_model->add_stok_hareket($stok_giris_data);


            $alt_parcalar = $this->db
                ->where(["stok_ust_grup_kayit_no" => $control[0]->stok_id])
                ->select('*')
                ->from('stoklar sh')->get()->result();
            foreach ($alt_parcalar as $alt_parca) {
                $this->Stok_model->update_stok($alt_parca->stok_id, ["stok_ust_grup_kayit_no" => $insert_id,"qr_durum" => 0,"stok_cikis_yapildi" => 0]);
                $stok_giris_data = [];
                $stok_giris_data["stok_fg_id"] =$alt_parca->stok_id;
                $stok_giris_data["giris_miktar"] = 1;
                $stok_giris_data["hareket_kaydeden_kullanici"] = aktif_kullanici()->kullanici_id;
                $this->Stok_model->add_stok_hareket($stok_giris_data);
            }
            $this->session->set_flashdata('flashSuccess', "Konnektör > Başlık tanımlanması başarıyla tamamlanmıştır.");
          
            redirect(base_url("stok/giris_stok_kayitlari")."?filter=stok-degisim");
        }  
    }else{
        $this->session->set_flashdata('flashDanger', "Girilen seri kodlu stok kaydı bulunamamıştır. Stok çıkış işlemi başarısız.");
        redirect($_SERVER['HTTP_REFERER']."?filter=stok-degisim");
    }
    
}





public function update_qr_durum($stok_id)
{
    $control = $this->Stok_model->get_stok_kayitlari(["stok_id" => $stok_id]);
    if (count($control) > 0) {
        $new_qr_durum = $control[0]->qr_durum == 0 ? 1 : 0;
        $this->Stok_model->update_stok($stok_id, ["qr_durum" => $new_qr_durum,"qr_durum_degistirme_tarihi" => date("Y-m-d H:i:s"),"qr_durum_degistiren_kullanici_id"=>aktif_kullanici()->kullanici_id]);
        echo json_encode(array('qr_durum' => $new_qr_durum));
    }
    
}

}
