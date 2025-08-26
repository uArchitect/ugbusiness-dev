<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
		$this->load->model('Stok_model');
        $this->load->model('Urun_model');      $this->load->model('Cihaz_model');
        date_default_timezone_set('Europe/Istanbul');
       
    }
	public function index()
	{   yetki_kontrol("stok_yonetim");
		redirect(base_url("stok/stok_genel_bakis"));
	}

    
     public function urungonderim()
	{ 
       // yetki_kontrol("urungonderim_goruntule"); 
		$viewData["page"] = "urungonderim/list";
		$this->load->view('base_view',$viewData);
	}


 public function urungonderim_ajax()
	{ 
	    //yetki_kontrol("urungonderim_goruntule");
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

       $query = $this->db->where(["siparis_urun_aktif"=>1])
        ->select("musteriler.musteri_kayit_tarihi,kullanicilar.kullanici_ad_soyad,merkezler.merkez_kayit_guncelleme_notu,musteriler.musteri_kayit_guncelleme_notu,musteriler.musteri_ad,borclu_cihazlar.borc_durum as cihaz_borc_uyarisi,musteriler.musteri_id,musteriler.musteri_kod,musteriler.musteri_iletisim_numarasi,
        merkezler.merkez_adi,merkezler.merkez_adresi,merkezler.merkez_yetkili_id,  merkezler.merkez_id,
                  urunler.urun_adi, urunler.urun_slug,siparisler.siparis_kodu,siparisler.siparis_id,
                  siparis_urunleri.siparis_urun_id, siparis_urunleri.musteri_degisim_aciklama,
                  siparis_urunleri.seri_numarasi,siparis_urunleri.urun_iade_durum,siparis_urunleri.urun_iade_tarihi,
                  siparis_urunleri.garanti_baslangic_tarihi,
                  siparis_urunleri.garanti_bitis_tarihi,siparis_urunleri.siparis_urun_aktif,
                  siparis_urunleri.takas_bedeli,siparis_urunleri.satis_fiyati,siparis_urunleri.takas_cihaz_mi,siparis_urunleri.yenilenmis_cihaz_mi,
                  sehirler.sehir_adi, sehirler.sehir_id,
                  ilceler.ilce_adi,urun_renkleri.renk_adi")
        ->order_by('siparis_urun_id', 'DESC')
        ->join("siparis_urunleri","siparis_urunleri.siparis_urun_id = urun_gonderimleri.cihaz_kayit_no")
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
        ->get("urun_gonderimleri");

        echo json_encode($query);return;
 
        $data = [];
        foreach ($query->result() as $row) {
         

            $c_count = get_siparis_urunleri_by_musteri_id($row->musteri_id);
            $data[] = [
                 "<span style='opacity:0.5'>#".$row->musteri_kod."</span>",
                '<a style="color:black;font-weight: 500;" href="https://ugbusiness.com.tr/musteri/profil/'.$row->musteri_id.'"><i class="fa fa-user-circle" style="color: #035ab9;"></i> '.$row->musteri_ad.'</a><span style="color:#145bb5"> '.get_musteri_urun_bilgileri($row->musteri_id).'</span>',
                ($row->merkez_adi == "#NULL#") ? "<span class='badge bg-danger' style='background: #ffd1d1 !important; color: #b30000 !important; border: 1px solid red;'><i class='nav-icon 	fas fa-exclamation-circle'></i> Merkez Adı Girilmedi</span>":'<i class="far fa-building" style="color: green;"></i> '.$row->merkez_adi,
                
                '<i class="fa fa-map-marker" style="color: green;"></i> <span style="    font-weight: 500;">'.$row->sehir_adi."</span>",
                '<i class="fa fa-phone" style="color:#813a3a;"></i> '.formatTelephoneNumber($row->musteri_iletisim_numarasi), 
                (($c_count == 0) ? "<a class='btn btn-xs btn-danger' style='' href='".base_url("musteri/musteri_gizle/".$row->musteri_id)."'><i class='fas fa-eye-slash'></i> Müşteri Gizle </a>" : '<a style="border-color: #000000;background-color: #ddecff !important;" href="https://ugbusiness.com.tr/musteri/profil/'.$row->musteri_id.'" class="btn btn-xs btn-warning"><i class="fa fa-user-circle"></i> Müşteri Profili</a>')
                .' 

                <a style="border-color: #000000;color: #000000;background-color:#d7fed0!important;" href="https://ugbusiness.com.tr/musteri/duzenle/'.$row->musteri_id.'" class="btn btn-xs btn-dark"><i class="fa fa-pen"></i> Düzenle</a>',
            ];
        }
       
        $totalData = $this->db->count_all('musteriler');
        $totalFiltered = $totalData;

        $json_data = [
            "draw" => intval($this->input->get('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        ];

        echo json_encode($json_data);
	}


     


    

    public function parca_kontrol_view()
	{	 
        $viewData["page"] = "stok/parca_kontrol";
        $this->load->view('base_view',$viewData);
    } 
    public function parca_kontrol()
	{	 

        $aranan_deger = $this->input->post("parca_seri_numarasi");
		if(trim($aranan_deger) == ""){
            $viewData["sparca"] = "snull";
            $viewData["page"] = "stok/parca_kontrol";
                    $this->load->view('base_view',$viewData);
        return;
        }


		$havuzquery =  $this->db->select('cihaz_havuzu.*')->from('cihaz_havuzu')->where('cihaz_havuz_seri_numarasi', $aranan_deger)->get();

		$this->db->select('siparis_urunleri.*')->from('siparis_urunleri')->where('siparis_urunleri.seri_numarasi', $aranan_deger);
		$query = $this->db->get();
		if(count($query->result()) > 0){	 	 

            $viewData["coklu_stok_kayitlari"] = $this->Stok_model->stok_kayitlari_all(["sh.tanimlanan_cihaz_seri_numarasi"=>$query->result()[0]->seri_numarasi]);
            $viewData["page"] = "stok/parca_kontrol";
            
            $this->load->view('base_view',$viewData);
		}else if(count($havuzquery->result()) > 0){
        
            $viewData["coklu_stok_kayitlari"] = $this->Stok_model->stok_kayitlari_all(["sh.tanimlanan_cihaz_seri_numarasi"=>$havuzquery->result()[0]->cihaz_havuz_seri_numarasi]);
            $viewData["page"] = "stok/parca_kontrol";
            $this->load->view('base_view',$viewData);
        
        }
            
            else{




            $query = $this->Stok_model->stok_kayitlari_all(["stok_seri_kod"=>$this->input->post('parca_seri_numarasi')]) ;    
            if (count($query) > 0) {
             
                $viewData["sparca"] = $query[0];
                 if($query[0]->tanimlanan_cihaz_seri_numarasi != "0" && $query[0]->tanimlanan_cihaz_seri_numarasi != ""){
                    
                        
                $viewData["scihaz"] = $this->Cihaz_model->get_all(["seri_numarasi"=>$query[0]->tanimlanan_cihaz_seri_numarasi])[0];	 
                    
    
                 }else{
                    $viewData["sparca"] = "snull";
                 }
     
            } else {    
                $viewData["sparca"] = "snull";
               
            }
            
           $viewData["page"] = "stok/parca_kontrol";
           $this->load->view('base_view',$viewData);




        }


    
    } 


	public function stok_seri_no_kontrol()
	{	 
		$query = $this->Stok_model->get_stok_kayitlari(["stok_seri_kod"=>$this->input->post('seri_numarasi'),"stok_cikis_yapildi"=>1]) ;    
        if (count($query) > 0) {
            $stok_durumu = ($query[0]->stok_tanimlanma_durum == 0) ? 0 : 1;
            $stok_tanimlanan_cihaz = $query[0]->tanimlanan_cihaz_seri_numarasi;
            $alt_parcalar = $this->db->where(["stok_ust_grup_kayit_no" => $query[0]->stok_id])->select('*')->from('stoklar')->get()->result();
   
 
        } else {    
            $stok_durumu = 2;
            $alt_parcalar = [];
        }
		echo json_encode(array('stok_durumu' => $stok_durumu,'stok_tanimlanan_cihaz' => $stok_tanimlanan_cihaz,'alt_parcalar' => $alt_parcalar));
	} 
    
    public function get_parca_alt_stoklar()
	{
        
        $query = $this->Stok_model->get_stok_kayitlari(["stok_seri_kod"=>$this->input->post('seri_numarasi')]) ;    
        
		echo json_encode($this->Stok_model->get_stok_tanimlari(["st.stok_tanim_ust_grup_id"=>$query[0]->stok_tanim_kayit_id]));
		 
	} 

	public function get_cihaz_stok_tanimlari($id)
	{
        
            $this->db->where(["urun_id"=>$id,"stok_paketleme"=>0]);
            $this->db->select('cihaz_stok_tanimlari.*,urunler.*, stok_tanimlari.*');
            $this->db->from('cihaz_stok_tanimlari');
            $this->db->join('urunler', 'urunler.urun_id = cihaz_stok_tanimlari.urun_fg_id');
            $this->db->join('stok_tanimlari', 'stok_tanimlari.stok_tanim_id = cihaz_stok_tanimlari.stok_fg_id'); 
            $this->db->order_by('cihaz_stok_sira_no', 'ASC'); 
            $query = $this->db->get();
 
		echo json_encode($query->result());
		 
	} 

	public function stok_genel_bakis()
	{
		$data = $this->Stok_model->get_stok_genel_bakis();
		$viewData["stok_tanim_list"] = $data;
		$viewData["stok_tanimlari"] = $data;
		$viewData["page"] = "stok/stok_tanimlari";
		$this->load->view('base_view',$viewData);
	}



	


    
    public function stok_hareketleri()
	{
		$viewData["page"] = "stok/stok_hareketleri";
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
		$viewData["stoklar"] = [""]; 
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
            echo json_encode($urun[0]);
        } else {
            echo json_encode(['error' => 'Ürün bulunamadı']);
        }
    }







	public function stok_kaydet() 
    {
        $stokdata["stok_tanim_kayit_id"] = $this->input->post("stok_tanim_kayit_id");
        //************* */
        $stokdata["cikma_parca_mi"] = $this->input->post("cikma_parca_mi");
        if($this->input->post("eski_cihaz_seri_no")){
            $stokdata["cikma_parca_seri_no"] = $this->input->post("eski_cihaz_seri_no");
        
        }
        //************* */
        $amount = $this->input->post("stok_miktar");
        
        if ($amount > 0) {
            if($this->input->post("seri_kod")){
                $data = $this->Stok_model->get_stok_kayitlari(["stok_seri_kod" => "01.034/LM".$this->input->post("seri_kod")]); 
                if(count($data)>0){

                    echo json_encode(['success' => false, 'message' => 'Stok ekleme hatası: ' . "Bu koda tanımlı stok kaydı bulunduğu için tekrar kayıt eklenemez."]);
                    return;
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

                    //******* */
                    if($this->input->post("cikma_parca_mi") == 1){
                        if($this->input->post("eski_cihaz_seri_no")){
                            $stok_giris_data["hareket_detay"] = $this->input->post("eski_cihaz_seri_no")." seri nolu cihazdan çıkarılmış parça.";
                        }else{
                            $stok_giris_data["hareket_detay"] = "2. El olarak kaydedildi.";
                      
                        }
                       
                    }
                    //******* */

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


                    /******* */

                    if($this->input->post("cikma_parca_mi") == 1){
                        if($this->input->post("eski_cihaz_seri_no")){
                            $stok_giris_data["hareket_detay"] = $this->input->post("eski_cihaz_seri_no")." seri nolu cihazdan çıkarılmış parça.";
                        }else{
                            $stok_giris_data["hareket_detay"] = "2. El olarak kaydedildi.";
                      
                        }
                       
                    }

                    /******* */



                    $this->Stok_model->add_stok_hareket($stok_giris_data);
            }
           
        }

        echo json_encode(['success' => true, 'message' => '']);
                  
       // redirect(base_url("stok/giris_stok_kayitlari"));
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
    
    $data["eski_lamba_durum"] = "true";
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
        $date = ($this->input->post("eski_tarih") != null) ? $this->input->post("eski_tarih") :date("dmy");
        $uretim = count($this->Stok_model->stok_kayitlari_all(null, "$grup/$prefix$date")) + 1;
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
    $control = $this->db->select('stoklar.*,st.stok_takip,st.stok_tanim_id,st.senkron_stok_id')->from("stoklar")
    ->join('stok_tanimlari st', 'stoklar.stok_tanim_kayit_id = st.stok_tanim_id', 'left')
    ->where(["stok_seri_kod" => str_replace(" ","",escape($this->input->post('cikis_yapilacak_seri_kod')))])->get()->result();
    if (count($control) <= 0) {

   $control = $this->db->select('stoklar.*,st.stok_takip,st.stok_tanim_id,st.senkron_stok_id')->from("stoklar")
   ->join('stok_tanimlari st', 'stoklar.stok_tanim_kayit_id = st.stok_tanim_id', 'left')
   ->where(["stok_seri_kod" => "01.034/LM".str_replace(" ","",escape($this->input->post('cikis_yapilacak_seri_kod')))])->get()->result();
   
    }
    if (count($control) > 0) {
        
        if ($control[0]->stok_cikis_yapildi == 1 && $control[0]->stok_takip == 0) {
             
            $response['status'] = 'error';
           $response['message'] = "Girilen seri kodlu stok için ".date("d.m.Y H:i:s",strtotime($control[0]->stok_cikis_tarihi))." tarihinde çıkış işlemi yapılmıştır. Tekrar çıkış işlemi yapılamaz.";
           echo json_encode($response);
        }else{
 
            $this->Stok_model->update_stok($control[0]->stok_id, ["stok_cikis_yapildi" => 1,"stok_cikis_tarihi" => date("Y-m-d H:i:s")]);
            
            $stok_cikis_data = [];
            $stok_cikis_data["stok_fg_id"] = $control[0]->stok_id;
            $stok_cikis_data["cikis_miktar"] = $this->input->post('stok_cikis_miktar');
            $stok_cikis_data["hareket_kaydeden_kullanici"] = aktif_kullanici()->kullanici_id;
            $stok_cikis_data["stok_cikis_birim_fg_id"] = $this->input->post('stok_cikis_birim_fg_id'); 
           
            $this->Stok_model->add_stok_hareket($stok_cikis_data);

            if($control[0]->senkron_stok_id != 0){
                $stok_cikis_data = [];
                $stok_cikis_data["stok_fg_id"] = $control[0]->senkron_stok_id;
                $stok_cikis_data["cikis_miktar"] = $this->input->post('stok_cikis_miktar');
                $stok_cikis_data["hareket_kaydeden_kullanici"] = aktif_kullanici()->kullanici_id;
                $stok_cikis_data["stok_cikis_birim_fg_id"] = $this->input->post('stok_cikis_birim_fg_id'); 
            
                $this->Stok_model->add_stok_hareket($stok_cikis_data);
            }

            
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

            $response['status'] = 'success';
            echo json_encode($response);
           // redirect(base_url("stok/cikis_stok_kayitlari")."?filter=stok-cikis");
        }  
    }else{
        $response['status'] = 'error';
        $response['message'] = "Girilen seri kodlu stok kaydı bulunamamıştır. Çıkış işlemi başarısız";
        echo json_encode($response);
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
          
            redirect(base_url("stok/giris_stok_kayitlari"));
        }  
    }else{
        $this->session->set_flashdata('flashDanger', "Girilen seri kodlu stok kaydı bulunamamıştır. Stok çıkış işlemi başarısız.");
        redirect($_SERVER['HTTP_REFERER']."?filter=stok-degisim");
    }
    
}





public function update_qr_durum($stok_id)
{
    $control = $this->Stok_model->stok_kayitlari_all(["stok_id" => $stok_id]);
    if (count($control) > 0) {
        $new_qr_durum = $control[0]->qr_durum == 0 ? 1 : 0;
        $this->Stok_model->update_stok($stok_id, ["qr_durum" => $new_qr_durum,"qr_durum_degistirme_tarihi" => date("Y-m-d H:i:s"),"qr_durum_degistiren_kullanici_id"=>aktif_kullanici()->kullanici_id]);
        echo json_encode(array('qr_durum' => $new_qr_durum));
    }
    
}









public function get_stok_hareketleri_ajax() {
   



 
    $limit = $this->input->get('length');
    $start = $this->input->get('start');
    $search = $this->input->get('search')['value']; 
    $order = $this->input->get('order')[0]['column'];
    $dir = $this->input->get('order')[0]['dir'];
    if(!empty($search)) {
        $this->db->where(["musteri_aktif"=>1]);
        $this->db->like('musteri_ad', $search); 
        $this->db->or_like('merkez_adi', $search); 
    }
    
    $this->db->limit($limit, $start);
    $query = $this->db->query("SELECT stok_hareketleri.stok_hareket_id,kullanicilar.kullanici_ad_soyad,stok_tanimlari.stok_tanim_ad,stok_hareketleri.giris_miktar,stok_hareketleri.cikis_miktar,stok_hareketleri.hareket_kayit_tarihi FROM `stok_hareketleri`
    INNER JOIN stoklar ON stok_id = stok_hareketleri.stok_fg_id
    INNER JOIN stok_tanimlari ON stok_tanimlari.stok_tanim_id = stoklar.stok_tanim_kayit_id
    INNER JOIN kullanicilar ON kullanicilar.kullanici_id = stok_hareketleri.hareket_kaydeden_kullanici
    order by stok_hareket_id desc");

    $data = [];
    foreach ($query->result() as $row) {
     
       
        $data[] = [
             "<span style='opacity:0.5'>#".$row->stok_hareket_id."</span>",
             "<span style='opacity:1'>".$row->stok_tanim_ad."</span>",
             "<span style='opacity:1'>".$row->giris_miktar."</span>",
             "<span style='opacity:1'>".$row->cikis_miktar."</span>",
             "<span style='opacity:1'>".$row->kullanici_ad_soyad."</span>",
             "<span style='opacity:1'>".(date("d.m.Y H:i",strtotime($row->hareket_kayit_tarihi)))."</span>"
        ];
    }
   
    $totalData = $this->db->count_all('stok_hareketleri');
    $totalFiltered = $totalData;

    $json_data = [
        "draw" => intval($this->input->get('draw')),
        "recordsTotal" => intval($totalData),
        "recordsFiltered" => intval($totalFiltered),
        "data" => $data
    ];

    echo json_encode($json_data);



}


public function get_stok_kayitlari_ajax() {
    $limit = $this->input->get('length');
    $start = $this->input->get('start');
    $search = $this->input->get('search')['value']; 
    $order = $this->input->get('order')[0]['column'];
    $dir = $this->input->get('order')[0]['dir'];



    $request = $_REQUEST;

    $copFilter = $this->input->get('filter');
 
    if(!empty($copFilter) &&  $copFilter == "cop-kutusu") {
        
        $this->db->where(["stok_cop_mu"=>1]); 
         
      
    }


    // Ekstra filtreleme verisini alın
    $extraFilter = $this->input->get('extra_filter');
    if(!empty($extraFilter) &&  $extraFilter != "0") {
        
        $this->db->where(["stok_cikis_yapildi"=>1]); 
         
        if($extraFilter == "5"){
            $this->db->where('stok_cikis_tarihi >=', date('Y-m-d H:i:s', strtotime("-10 minutes")));
      
          
        }
        $this->db->order_by("stok_cikis_tarihi","DESC");
    }

 




    if(!empty($search)) {
       
        $this->db->like('st.stok_tanim_ad', $search); 
        $this->db->or_like('stok_seri_kod', $search); 
    }
   
    $this->load->model('Stok_model');

    $this->db->limit($limit, $start);
  
    $this->db->select('sh.stok_id,sh.cikma_parca_mi,sh.stok_cop_mu,sh.stok_seri_kod,sh.stok_cikis_yapildi,sh.stok_kayit_tarihi,sh.qr_durum,sh.stok_cikis_tarihi,sh.tanimlanan_cihaz_seri_numarasi, st.*');
    $this->db->from('stoklar sh');
    $this->db->join('stok_tanimlari st', 'sh.stok_tanim_kayit_id = st.stok_tanim_id', 'left');  
    $this->db->order_by('sh.stok_id', 'DESC');
    $query = $this->db->get();
    $list = $query->result();
    
    $data = array();
    $no = 0;
    
    foreach ($list as $stok_tanim) {

        
    $alt_urunler = $this->Stok_model->stok_kayitlari_all(["stok_ust_grup_kayit_no"=>$stok_tanim->stok_id]);


        $no++;
        $row = array();
        $row['stok_id'] = $stok_tanim->stok_id;
        $row['stok_tanim_ad'] = "<a href='https://ugbusiness.com.tr/stok_tanim/index/$stok_tanim->stok_id/$stok_tanim->stok_tanim_id' style='".(count($alt_urunler)>0 ? "color:white" : "color:black")."' target='_blank'>".(count($alt_urunler)>0 ? "".$stok_tanim->stok_tanim_ad."" : "".$stok_tanim->stok_tanim_ad)."</a>".($stok_tanim->cikma_parca_mi ? '<span style="height: 19px;padding: 5px; margin-left: 4px;" class="badge bg-warning"> 2. El Parça</span>' : '').(($stok_tanim->stok_cop_mu == 1) ? '<span style="height: 19px;padding: 5px; margin-left: 4px;" class="badge bg-danger"> Çöp</span>' : '').($stok_tanim->stok_tanim_aciklama != "" ? "<br><span style='opacity:0.6'>$stok_tanim->stok_tanim_aciklama</span>" : "");
        $row['stok_seri_kod'] = $stok_tanim->stok_seri_kod ?: "<span style='opacity:0.5;'>Seri Kod Tanımlanmadı</span>";
        $row['stok_kayit_tarihi'] = date("d.m.Y H:i", strtotime($stok_tanim->stok_kayit_tarihi));
        
        if ($stok_tanim->stok_takip == 1) {
            $row['stok_cikis_tarihi'] = "<span style='opacity:0.6'><i class='fas fa-info-circle'></i> Takipsiz stok ürünü.</span>";
            $row['qr_durum'] = "";
            $row['stok_durumu'] = "";
        } else {
            $row['stok_cikis_tarihi'] = $stok_tanim->stok_cikis_yapildi ? "<span class='".(count($alt_urunler)>0 ? "text-white" : "text-success")."'>" . date("d.m.Y H:i", strtotime($stok_tanim->stok_cikis_tarihi)) . "</span>" : "<span class='text-danger'>Çıkış Yapılmadı</span>";
            $row['qr_durum'] = $stok_tanim->qr_durum == 1 ? "<span class='text-custom-success toggle_qr_status'  style='cursor:pointer;' onclick='qrchange(\"$stok_tanim->stok_id\");' data-record-id='{$stok_tanim->stok_id}'><i class='fas fa-check-circle'></i> QR Yazdırıldı</span>" : "<span class='text-custom-warning toggle_qr_status'  style='cursor:pointer;' onclick='qrchange(\"$stok_tanim->stok_id\");' data-record-id='{$stok_tanim->stok_id}'><i class='fas fa-hourglass-half'></i> QR Yazdırılmadı</span>";
            $row['stok_durumu'] = $stok_tanim->tanimlanan_cihaz_seri_numarasi ? "<span class='text-custom-success'><i class='fas fa-check-circle'></i> {$stok_tanim->tanimlanan_cihaz_seri_numarasi}</span>" : "<span class='text-custom-warning'><i class='fas fa-hourglass-half'></i> Cihaza Tanımlanmadı</span>";
        }
if(count($alt_urunler)>0){
    $row['rowClass'] = 'top-bg-success-custom'; 

}
        $data[] = $row;

if(count($alt_urunler)>0){
    foreach ($alt_urunler as $stok_tanim_alt) {
        $no++;
        $row = array();
        $row['stok_id'] = $stok_tanim_alt->stok_id;
        $row['stok_tanim_ad'] = '<a href="https://ugbusiness.com.tr/stok_tanim/index/'.$stok_tanim_alt->stok_id.'/'.$stok_tanim_alt->stok_tanim_id.'"  style="color:#004710" target="_blank">'.'<span class="text-success"><i class="fas fa-arrow-circle-right" style="color:#004710"></i></span> '.$stok_tanim_alt->stok_tanim_ad."</a>".(($stok_tanim_alt->stok_cop_mu == 1) ? '<span style="height: 19px;padding: 5px; margin-left: 4px;" class="badge bg-danger"> Çöp</span>' : '').($stok_tanim->cikma_parca_mi ? '<span style="height: 19px;padding: 5px; margin-left: 4px;" class="badge bg-warning"> 2. El Parça</span>' : '');
        $row['stok_seri_kod'] = $stok_tanim_alt->stok_seri_kod ?: "<span style='opacity:0.5;'>Seri Kod Tanımlanmadı</span>";
        $row['stok_kayit_tarihi'] = date("d.m.Y H:i", strtotime($stok_tanim_alt->stok_kayit_tarihi));
        
        if ($stok_tanim_alt->stok_takip == 1) {
            $row['stok_cikis_tarihi'] = "<span style='opacity:0.6'><i class='fas fa-info-circle'></i> Takipsiz stok ürünü.</span>";
            $row['qr_durum'] = "";
            $row['stok_durumu'] = "";
        } else {
            $row['stok_cikis_tarihi'] = $stok_tanim_alt->stok_cikis_yapildi ? "<span class='text-success'>" . date("d.m.Y H:i", strtotime($stok_tanim_alt->stok_cikis_tarihi)) . "</span>" : "<span class='text-danger'>Çıkış Yapılmadı</span>";
            $row['qr_durum'] = $stok_tanim_alt->qr_durum == 1 ? "<span class='text-custom-success' style='cursor:pointer;' onclick='qrchange(\"$stok_tanim_alt->stok_id\");' data-record-id='{$stok_tanim_alt->stok_id}'><i class='fas fa-check-circle'></i> QR Yazdırıldı</span>" : "<span class='text-custom-warning' style='cursor:pointer!important;' onclick='qrchange(\"$stok_tanim_alt->stok_id\");' data-record-id='{$stok_tanim_alt->stok_id}'><i class='fas fa-hourglass-half'></i> QR Yazdırılmadı</span>";
            $row['stok_durumu'] = $stok_tanim_alt->tanimlanan_cihaz_seri_numarasi ? "<span class='text-custom-success'><i class='fas fa-check-circle'></i> {$stok_tanim_alt->tanimlanan_cihaz_seri_numarasi}</span>" : "<span class='text-custom-warning'><i class='fas fa-hourglass-half'></i> Cihaza Tanımlanmadı</span>";
            $row['rowClass'] = 'bg-success-custom'; 
        }
    
        $data[] = $row;
    }
   
}



        








    }

    $totalData = $this->db->count_all('musteriler');
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
