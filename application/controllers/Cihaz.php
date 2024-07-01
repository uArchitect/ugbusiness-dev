<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cihaz extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Cihaz_model'); 
        $this->load->model('Siparis_model'); 
        $this->load->model('Urun_model');    $this->load->model('Siparis_urun_model'); 
        $this->load->model('Baslik_model');
        $this->load->model('Musteri_model'); 
        $this->load->model('Merkez_model');         $this->load->model('Siparis_onay_hareket_model'); 
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



    public function cihaz_tanimlama_view($musteri_id=0)
	{  
        yetki_kontrol("cihaz_tanimlama");
		$cihazlar = $this->Urun_model->get_all(); 
        $musteriler = $this->Merkez_model->get_all(); 
        $viewData['cihazlar'] =  $cihazlar;
        $viewData['musteriler'] =  $musteriler;
        $viewData['secilen_musteri'] =  $musteri_id;


        
		$viewData["page"] = "cihaz/yeni_cihaz_tanimla"; 
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

            if($servis_kayit != 0){
                redirect(base_url("servis/servis_cihaz_sorgula_view?data=".$seri_numarasi));
              }

              
            redirect(base_url("cihaz/edit/".$inserted_id));

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
        $viewData["cihazlar"] = $this->Urun_model->get_all();
        $viewData["page"] = "cihaz/cihaz_havuz_tanimla";
		$this->load->view('base_view',$viewData);
      } 
      function cihaz_havuz_tanimla_update_view($id = 0) { 
        yetki_kontrol("cihaz_havuz_duzenle");
        $check_id =$this->db->get_where("cihaz_havuzu",array('cihaz_havuz_id' => $id))->result();
        if($check_id){
            $viewData["cihazlar"] = $this->Urun_model->get_all();
            $viewData["cihaz"] = $check_id[0];
            $viewData["renkler"] = $this->db->get_where('urun_renkleri', array('urun_no' => $check_id[0]->cihaz_kayit_no))->result();
            $viewData["page"] = "cihaz/cihaz_havuz_guncelle";
            $this->load->view('base_view',$viewData);
        }else{
            redirect($_SERVER['HTTP_REFERER']); 
        }
       
      } 
      function cihaz_havuz_liste_view() { 
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
        $data['cihaz_kayit_no']  = escape($this->input->post('cihaz_id')); 
        $data['cihaz_renk_no']  = escape($this->input->post('ekle_renk')); 
        $data['cihaz_havuz_durum']  = 1; 
        $this->db->insert('cihaz_havuzu',$data);


 
        $seri_kodlar = json_decode(json_encode($this->input->post('parca_seri_numaralar[]')));
       // echo json_encode($this->input->post('parca_seri_numaralar[]'));return;
            foreach ($seri_kodlar as $seri_kod) {
              
                $this->db->where(["stok_seri_kod"=>$seri_kod]);
                $this->db->update("stoklar",["tanimlanan_cihaz_seri_numarasi"=>$this->input->post('cihaz_seri_numarasi'),"stok_tanimlanma_durum"=>1]);
            }
 




       redirect(base_url("cihaz/cihaz_havuz_liste_view"));
      } 

    function cihaz_havuz_tanimla_updatesave($id = '') { 
    yetki_kontrol("cihaz_havuz_duzenle");
    $check_id =$this->db->get_where("cihaz_havuzu",array('cihaz_havuz_id' => $id))->result();

     
        if($check_id){
            $data['cihaz_havuz_seri_numarasi']  = escape($this->input->post('cihaz_seri_numarasi'));
            $data['cihaz_kayit_no']  = escape($this->input->post('cihaz_id')); 
            $data['cihaz_renk_no']  = escape($this->input->post('ekle_renk')); 
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
            $viewData['siparis'] = $siparis[0];
            $viewData['basliklar'] =  $this->Urun_model->get_baslik_tanimlari(["siparis_urun_id"=>$id]);
             $viewData['basliklar_data'] =  $this->Urun_model->get_basliklar();
            
            $viewData['urunler'] =  $this->Siparis_model->get_all_products_by_order_id($id);
            $viewData['merkez'] =  $this->Merkez_model->get_by_id($siparis[0]->merkez_no);
  
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
       
        if(empty($id)){
            yetki_kontrol("cihaz_ekle");
        }else{
            yetki_kontrol("cihaz_duzenle");
        }
        $this->form_validation->set_rules('seri_numarasi',  'Cihaz Adı',  'required'); 
        
        $garanti_baslangic = date('Y-m-d',strtotime($this->input->post('garanti_baslangic_tarihi')));
        $garanti_bitis = date('Y-m-d',strtotime($this->input->post('garanti_bitis_tarihi')));

        $data['seri_numarasi']  = escape($this->input->post('seri_numarasi'));
        $data['garanti_baslangic_tarihi'] = $garanti_baslangic; 
        $data['garanti_bitis_tarihi'] = $garanti_bitis;
        
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












    public function cihazlar_ajax() { 
		yetki_kontrol("cihazlari_goruntule");
        $kullanici_id = aktif_kullanici()->kullanici_id;
        $limit = $this->input->get('length');
        $start = $this->input->get('start');
        $search = $this->input->get('search')['value']; 
        $order = $this->input->get('order')[0]['column'];
        $dir = $this->input->get('order')[0]['dir'];

        if(!empty($search)) {
            $this->db->like('urun_adi', $search); 
            $this->db->or_like('seri_numarasi', $search);   
			 $this->db->or_like('musteri_iletisim_numarasi', $search); 
			 $this->db->or_like('musteri_ad', $search); 
			 $this->db->or_like('merkez_adi', $search); 
             $this->db->or_like('sehir_adi', $search); 
             $this->db->or_like('ilce_adi', $search); 
        }

 


		$query = $this->db
        ->select("musteriler.musteri_ad,borclu_cihazlar.borc_durum as cihaz_borc_uyarisi,musteriler.musteri_id,musteriler.musteri_kod,musteriler.musteri_iletisim_numarasi,
        merkezler.merkez_adi,merkezler.merkez_adresi,merkezler.merkez_yetkili_id,  merkezler.merkez_id,
                  urunler.urun_adi, urunler.urun_slug,siparisler.siparis_kodu,
                  siparis_urunleri.siparis_urun_id, siparis_urunleri.musteri_degisim_aciklama,
                  siparis_urunleri.seri_numarasi,
                  siparis_urunleri.garanti_baslangic_tarihi,
                  siparis_urunleri.garanti_bitis_tarihi,
                  siparis_urunleri.takas_bedeli,
                  sehirler.sehir_adi,
                  ilceler.ilce_adi")
        ->order_by('siparis_urun_id', 'DESC')
        ->join("urunler","urunler.urun_id = siparis_urunleri.urun_no")
        ->join("siparisler","siparis_urunleri.siparis_kodu = siparisler.siparis_id")
        ->join("merkezler","siparisler.merkez_no = merkezler.merkez_id")
        ->join("musteriler","merkezler.merkez_yetkili_id = musteriler.musteri_id")
        ->join("sehirler","merkezler.merkez_il_id = sehirler.sehir_id")
        ->join("ilceler","merkezler.merkez_ilce_id = ilceler.ilce_id")
        ->join("borclu_cihazlar","borclu_cihazlar.borclu_seri_numarasi = siparis_urunleri.seri_numarasi","left")
        ->order_by($order, $dir)
		->order_by('siparis_urun_id', 'DESC')
	
		->limit($limit, $start)
        ->get("siparis_urunleri");
				   
		 
				

                      

        $data = [];
        foreach ($query->result() as $row) {




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

                   $musteri = '<a target="_blank" style="color:black;font-weight: 500;" href="https://ugbusiness.com.tr/musteri/profil/'.$row->musteri_id.'"><i class="fa fa-user-circle" style="color: #035ab9;"></i> '.$row->musteri_ad.'</a>';     

  
            $data[] = [ 
			  $row->siparis_urun_id,
			  "<span style='font-weight:bold'>".$row->urun_adi."</span>".
              "<br><span style='font-weight:normal'>".(($row->seri_numarasi) ? $row->seri_numarasi : "<span style='opacity:0.2'>UG00000000UX00</span>").
              "</span>",
              $musteri."<br><span style='font-weight:normal'>İletişim : ".formatTelephoneNumber($row->musteri_iletisim_numarasi)."</span>"."<span style='display:none'>".$row->musteri_iletisim_numarasi."</span>",

              "<span style='font-weight:normal'><b>".$row->merkez_adi."</b> "."<br>Sipariş Kodu : ".$row->siparis_kodu.($row->takas_bedeli > 0 ? " <span style='color: red;'>(Takaslı Siparis)</span>" : "")."</span>",
            
              "<span style='font-weight:normal'><b>".$row->sehir_adi." / ".$row->ilce_adi."</b><br>".(($row->merkez_adresi != "" && $row->merkez_adresi != 0 && $row->merkez_adresi != ".")?$row->merkez_adresi:"<span style='opacity:0.4'>BU MERKEZE TANIMLI ADRES KAYDI BULUNAMADI</span>")."</span>",
             "<span style='font-weight:normal'>". $gbaslangic."<br>".$gbitis."</span>", 
              '
              <a type="button" href="https://ugbusiness.com.tr/cihaz/duzenle/'.$row->siparis_urun_id.'" class="btn btn-warning mt-1" style="font-size: 12px!important;font-weight:normal"><i class="fa fa-pen"></i> Düzenle</a>
              <a type="button" href="https://ugbusiness.com.tr/egitim/add/'.$row->siparis_urun_id.'" class="btn btn-dark mt-1" style="font-size: 12px!important;font-weight:normal"><i class="fa fa-plus"></i> Eğitim Ekle</a>
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
