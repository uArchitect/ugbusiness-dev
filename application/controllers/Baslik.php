<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Baslik extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Baslik_model');  
        $this->load->model('Siparis_model');    
        $this->load->model('Musteri_model');   
        $this->load->model('Urun_model');  
        $this->load->model('Stok_model'); 
        $this->load->model('Merkez_model');        
        $this->load->model('Cihaz_model'); 
        date_default_timezone_set('Europe/Istanbul');
    }
 
	public function index()
	{
        yetki_kontrol("baslik_goruntule");
        $data = $this->Baslik_model->get_all(); 
		$viewData["basliklar"] = $data;
		$viewData["page"] = "baslik/list";
		$this->load->view('base_view',$viewData);
	}
    public function iade_etiket()
	{    
		$this->load->view('baslik/iade_etiket/main_content.php');
	}
    public function print_kargo($id)
	{
        $data = $this->Baslik_model->get_by_id(["urun_baslik_tanim_id"=>$id]);
        $viewData["alici"] = $data[0];
		$this->load->view('baslik/print_kargo/main_content.php',$viewData);
	}
    public function print($id)
	{ 
        $data = $this->Baslik_model->get_by_id(["urun_baslik_tanim_id"=>$id]);
        $viewData["baslik_adi"] =  $data[0]->baslik_adi;
		$viewData["baslik_seri_no"] = $data[0]->baslik_seri_no;
        $viewData["cihaz_seri_no"] = $data[0]->seri_numarasi;
		$this->load->view('baslik/qr/print_qr',$viewData);
	}
    public function print_havuz($id)
	{
        $data = $this->Baslik_model->get_by_havuz(["baslik_havuz_id"=>$id]);
        $viewData["baslik_adi"] = $data[0]->baslik_adi;
		$viewData["baslik_seri_no"] = $data[0]->baslik_seri_numarasi;
        $viewData["cihaz_seri_no"] = $data[0]->cihaz_seri_numarasi;
		$this->load->view('baslik/qr/print_qr',$viewData);
	}

    public function baslik_sorgula()
	{
        $data = $this->Baslik_model->get_by_id(["baslik_seri_no"=>$this->input->post("barcode")]);
       if($data){
        echo json_encode($data);
       }else{
    
            $response = false;
            $query = $this->db
            ->or_where(["Baslik1"=>$this->input->post("barcode")])
            ->or_where(["Baslik2"=>$this->input->post("barcode")])
            ->or_where(["Baslik3"=>$this->input->post("barcode")])
            ->or_where(["Baslik4"=>$this->input->post("barcode")])
            ->or_where(["Baslik5"=>$this->input->post("barcode")])
            ->or_where(["Baslik6"=>$this->input->post("barcode")])
            ->get("t_cihaz")
            ;
            if($query && $query->num_rows()){
                $response = $query->result();
            }
            echo json_encode($response);
        
       }
	}
    public function eski_baslik_kayit_olustur($id)
	{
        $t_cihaz_data = $this->db->get_where("t_cihaz",["Logicalref"=>$id])->result();
        if($t_cihaz_data){
            $check_id = $this->Cihaz_model
            ->get_all(["musteriler.musteri_iletisim_numarasi"=>$t_cihaz_data[0]->Telefon],
                      ["seri_numarasi"=>$t_cihaz_data[0]->CihazSerino]); 
                      
            if($check_id){
                redirect(base_url("cihaz/duzenle/".$check_id[0]->siparis_urun_id));
            }else{
                $musteri = $this->Merkez_model
                ->get_all(["musteriler.musteri_iletisim_numarasi"=>$t_cihaz_data[0]->Telefon]); 
               if($musteri){
                redirect(base_url("cihaz/cihaz_tanimlama_view/".$musteri[0]->merkez_id));
               }else{
                redirect(base_url("musteri/add/0/". $t_cihaz_data[0]->Logicalref));
               }
            }
     
        }else{
            redirect(base_url("musteri/add"));
        }
       
	}
    public function arizalar()
	{
        $data = $this->db->get_where("urun_baslik_arizalar",["urun_baslik_tanim_no"=>$this->input->post("urun_baslik_tanim_no")])->result();
        echo json_encode($data);
	}

    public function gecmis_arizalar()
	{
        $data = $this->Baslik_model->isleme_alinan_basliklar(["siparis_urun_baslik_no"=>$this->input->post("siparis_urun_baslik_no")]); 
        $new_data = [];
        foreach ($data as $item) {
            $item_array = (array) $item;
            $jsonData = json_encode(get_arizalar($item->urun_baslik_ariza), true);                        
            $data = json_decode($jsonData, true);
            $basliklar = array_map(function($itemw){
             
                return preg_replace('/\([^)]+\)/', '', $itemw['urun_baslik_ariza_adi']);
            }, $data);

            if($item->urun_baslik_ariza != null && $item->urun_baslik_ariza != "" && $item->urun_baslik_ariza != "null")
            { 
                $item_array['ariza_detaylari'] = implode(', ', $basliklar);
            }
           
            else{
                $item_array['ariza_detaylari'] = "<span class='text-danger'><i class='fas fa-exclamation-circle'></i>  Arıza Seçilmedi</span>";

            }
            if($item->urun_baslik_ariza_tanim_id != $this->input->post("ariza_tanim_id")){
                $new_data[] = (object) $item_array;
            }     
        }
       
        echo json_encode($new_data);
	}

    function baslik_havuz_tanimla_view() {   
        $viewData["cihazlar"] = $this->Urun_model->get_all();
        $viewData["page"] = "baslik/baslik_havuz_tanimla";
		$this->load->view('base_view',$viewData);
    } 

    function baslik_havuz_liste_view() {    
        $viewData["basliklar"] = $this->Baslik_model->get_by_havuz();
        $viewData["page"] = "baslik/baslik_havuz_liste";
		$this->load->view('base_view',$viewData);
      } 

    function baslik_havuz_tanimla_save() {  
        $control = $this->db->where(["sh.stok_seri_kod" => str_replace(" ","",escape($this->input->post('baslik_seri_numarasi')))])->select('*')->from('stoklar sh')->get()->result();
            
        if (count($control) > 0) {
            $alt_parcalar = $this->db->where(["stok_ust_grup_kayit_no" => $control[0]->stok_id])->select('*')->from('stoklar sh')->get()->result();
            if(count($alt_parcalar) <= 0){
            //    $this->session->set_flashdata('flashDanger', "Girilen stok kaydı ile ile ilgili stok eşleşmeleri tamamlanmadığı için stok giriş işlemi başarısız.");
             //   redirect($_SERVER['HTTP_REFERER']);
            }
            if ($control[0]->tanimlanan_cihaz_seri_numarasi != 0) {
                if($control[0]->tanimlanan_cihaz_seri_numarasi != escape($this->input->post('cihaz_seri_numarasi'))){
                    $this->session->set_flashdata('flashDanger', "Girilen seri kodlu başlık başka bir cihaza tanımlanmıştır. İşlem Başarısız");
                    redirect($_SERVER['HTTP_REFERER']);
                }
            }
            if ($control[0]->stok_cikis_yapildi == 0) {
                $this->session->set_flashdata('flashDanger', "Girilen seri kodlu için başlık için stok çıkış işlemi yapılması gerekmektedir. İşlem Başarısız");
                redirect($_SERVER['HTTP_R']);
            }else{
                $this->db->where(["stok_seri_kod"=>escape($this->input->post('baslik_seri_numarasi'))]);
                $this->db->update("stoklar",["tanimlanan_cihaz_seri_numarasi"=>$this->input->post('cihaz_seri_numarasi'),"stok_tanimlanma_durum"=>1]);
                $alt_parcalar = $this->db->where(["stok_ust_grup_kayit_no" => $control[0]->stok_id])->select('*')->from('stoklar sh')->get()->result();
                foreach ($alt_parcalar as $altstok) {
                    $this->db->where(["stok_id"=>$altstok->stok_id]);
                    $this->db->update("stoklar",["tanimlanan_cihaz_seri_numarasi"=>$this->input->post('cihaz_seri_numarasi'),"stok_tanimlanma_durum"=>1]);
                }
                $data['baslik_seri_numarasi']   = escape($this->input->post('baslik_seri_numarasi')) ?? "B".date("dmYHis")."UG01"; 
                $data['cihaz_seri_numarasi']    = escape($this->input->post('cihaz_seri_numarasi'));
                $data['cihaz_kayit_no']         = escape($this->input->post('cihaz_id'));
                $data['baslik_kayit_no']        = escape($this->input->post('baslik_kayit_no'));
                $this->db->insert('baslik_havuzu',$data);
               redirect(base_url("baslik/baslik_havuz_liste_view"));
            }
        }else{
            $this->session->set_flashdata('flashDanger', "Girilen seri kodlu stok kaydı bulunamamıştır.");
            redirect($_SERVER['HTTP_REFERER']."?filter=stok-degisim");
        }
      } 

    function get_arizalar() {  
        $basliklar = $this->db->where_in('urun_baslik_ariza_id', json_decode($this->input->post("ariza_id")))->get("urun_baslik_arizalar")->result();
        echo json_encode($basliklar);
      } 

      public function ariza_siparis_sonlandir($id)
      {
        $this->db->where('urun_baslik_ariza_tanim_id', $id);
        $this->db->update("urun_baslik_ariza_tanimlari", array('ariza_tamamlandi' => 1,'urun_baslik_ariza_sonlandirma_tarihi' => date("Y-m-d H:i:s")));
        return true;
      }

    public function ariza_siparis_durum_guncelle($id,$durum)
	{
        $this->db->where('urun_baslik_ariza_tanim_id', $id);
        $this->db->update("urun_baslik_ariza_tanimlari", array('urun_baslik_ariza_durum_no' => $durum,'ariza_siparis_durum_guncelleme_tarihi' => date("Y-m-d H:i:s")));
        return true;
	}
    public function baslik_isleme_al($id,$kargono = 0)
	{
        $check_data = $this->db
        ->select("*")
        ->where(['siparis_urun_baslik_no'=>$id])
        ->where(['ariza_tamamlandi'=>0])
        ->get("urun_baslik_ariza_tanimlari")
         ;

        if($check_data && $check_data->num_rows()){
            $this->session->set_flashdata('flashDanger','Seri numarasına tanımlı olan başlık zaten işleme alınmıştır. Tekrar işleme almadan önce, eski işlemi sonlandırınız.');
            redirect(base_url('baslik/isleme_alinan_basliklar'));    
        }
        $baslik_data = [];
        $baslik_data["siparis_urun_baslik_no"] = $id;
        $baslik_data["urun_baslik_ariza_durum_no"] = 1;
        $baslik_data["ariza_tamamlandi"] = 0;  
        $baslik_data["urun_baslik_gelen_kargo_no"] = $kargono;
        $this->Baslik_model->insert_baslik_ariza($baslik_data);
        redirect(base_url("baslik/isleme_alinan_basliklar"));
	}

    public function ariza_kaydet()
	{
        $this->db->where('urun_baslik_ariza_tanim_id',  $this->input->post("urun_baslik_ariza_tanim_id"));
        $this->db->update("urun_baslik_ariza_tanimlari", array('urun_baslik_ariza' => json_encode(escape( $this->input->post("ariza_select"))),'urun_baslik_ariza_aciklama' =>  strip_tags($this->input->post("ariza_aciklama"))));
        redirect($_SERVER['HTTP_REFERER']);
	}

    public function isleme_alinan_basliklar()
	{      
        yetki_kontrol("isleme_alinan_basliklari_goruntule");
        $data = $this->Baslik_model->isleme_alinan_basliklar(["ariza_tamamlandi"=>0]); 
		$viewData["basliklar"] = $data;
		$viewData["page"] = "baslik/isleme_alinanlar";
        $viewData["islemde_bekleyen_count"] = count($data);
        $viewData["tamamlanan_count"] = $this->db->where(["ariza_tamamlandi"=>1])->get("urun_baslik_ariza_tanimlari")->num_rows();
        $viewData["tum_basliklar_count"] = $this->db->get("urun_baslik_ariza_tanimlari")->num_rows();
        $viewData["garanti_bitenler_count"] = $this->db->where(["baslik_garanti_bitis_tarihi <"=>date("Y-m-d")])->get("urun_baslik_tanimlari")->num_rows();
		$this->load->view('base_view',$viewData);
	}
    public function tamamlanan_basliklar()
	{         
        yetki_kontrol("tamamlanan_basliklari_goruntule");
        $data = $this->Baslik_model->isleme_alinan_basliklar(["ariza_tamamlandi"=>1]); 
		$viewData["basliklar"] = $data;
		$viewData["page"] = "baslik/tamamlanan_basliklar";
        $viewData["islemde_bekleyen_count"] = count($data);
        $viewData["tamamlanan_count"] = $this->db->where(["ariza_tamamlandi"=>1])->get("urun_baslik_ariza_tanimlari")->num_rows();
        $viewData["tum_basliklar_count"] = $this->db->get("urun_baslik_ariza_tanimlari")->num_rows();
        $viewData["garanti_bitenler_count"] = $this->db->where(["baslik_garanti_bitis_tarihi <"=>date("Y-m-d")])->get("urun_baslik_tanimlari")->num_rows();
		$this->load->view('base_view',$viewData);
	}
    public function eski_lamba_kodu()
    {
        $baslik = $this->db->where(["stok_seri_kod" => str_replace(" ","",$this->input->post("baslik_seri_no"))])->select('*')->from('stoklar sh')->get()->result();
        if(count($baslik) > 0){
            $stok = $this->db->where(["stok_ust_grup_kayit_no"=>$baslik[0]->stok_id])->select('*')->from('stoklar sh')->get()->result();
            if (count($stok)<=0) {
            $data["eski_lamba_durum"] = "false";
            
        } else{
        
            $data["eski_lamba_durum"] = $stok[0]->stok_seri_kod;
        }
        }else{
            $data["eski_lamba_durum"] = "false";
        }
         echo json_encode($data);
    }

    public function lamba_tanimla()
	{   
        if($this->input->post("lamba_seri_kod") != "" && $this->input->post("lamba_seri_kod") != null){

        $secilen_stok = $this->db->where(["stok_seri_kod"=>$this->input->post("lamba_takilacak_baslik_seri_kod")])->get("stoklar")->result();
        $tanimlanacak_stok = $this->db->where(["tanimlanan_cihaz_seri_numarasi"=>"0","stok_cikis_yapildi"=>1,"stok_cop_mu"=>0,"stok_seri_kod"=>$this->input->post("lamba_seri_kod")])->get("stoklar")->result();
        if(count($secilen_stok) <= 0){
            
            $baslik_tanim = $this->db->where(["baslik_seri_no"=>$this->input->post("lamba_takilacak_baslik_seri_kod")])->get("urun_baslik_tanimlari")->result();
            $baslik_kayit = $this->db->where(["baslik_id"=>$baslik_tanim[0]->urun_baslik_no])->get("urun_basliklari")->result();

            $stokdata["stok_tanim_kayit_id"]    = $baslik_kayit[0]->stok_eslesme_kodu;
            $stokdata["stok_seri_kod"]          = $this->input->post("lamba_takilacak_baslik_seri_kod");
            $stokdata["stok_cikis_yapildi"]     = 1;
            $stokdata["stok_tanimlanma_durum"]  = 1;
            $stokdata["tanimlanan_cihaz_seri_numarasi"] = $this->input->post("cihaz_seri_no");
            
            $insert_id = $this->Stok_model->add_stok($stokdata);
                 
            $this->db->where(["stok_id"=>$tanimlanacak_stok[0]->stok_id]);
            $this->db->update("stoklar",["stok_ust_grup_kayit_no"=>20,"stok_cikis_yapildi"=>1,"stok_tanimlanma_durum"=>1,"tanimlanan_cihaz_seri_numarasi"=>$this->input->post("cihaz_seri_no")]);
            $secilen_stok = $this->db->where(["stok_id"=>$insert_id])->get("stoklar")->result();
       
        }
        
      
/*
            $eski_lamba = $this->db->where(["stok_tanim_kayit_id"=>34,"stok_ust_grup_kayit_no"=>$secilen_stok[0]->stok_id])->get("stoklar")->result();
            if(count($eski_lamba) > 0){

                $eski_lamba_durum = $this->input->post("eski_lamba_kullanim_durumu");
                if($eski_lamba_durum == 0){
                    echo "ESKİ LAMBA ÇÖPE ATILDI<br><br>";

                    $this->db->where(["stok_id"=>$eski_lamba[0]->stok_id]);
                    $this->db->update("stoklar",["tanimlanan_cihaz_seri_numarasi"=>"0","stok_ust_grup_kayit_no"=>0,"stok_cikis_yapildi"=>0,"stok_tanimlanma_durum"=>0,"stok_cop_mu"=>1,"stok_cop_seri_no"=>$secilen_stok[0]->tanimlanan_cihaz_seri_numarasi,"stok_cop_tarihi"=>date("Y-m-d H:i:s")]);
        

                }else{
                    echo "ESKİ LAMBA STOĞA GİRDİ<br><br>";
                    
                    $this->db->where(["stok_id"=>$eski_lamba[0]->stok_id]);
                    $this->db->update("stoklar",["tanimlanan_cihaz_seri_numarasi"=>"0","stok_ust_grup_kayit_no"=>0,"stok_cikis_yapildi"=>0,"stok_tanimlanma_durum"=>0,"cikma_parca_mi"=>1,"cikma_parca_seri_no"=>$secilen_stok[0]->tanimlanan_cihaz_seri_numarasi,"cikma_parca_tarihi"=>date("Y-m-d H:i:s")]);
        
                    $stok_giris_data = [];
                    $stok_giris_data["stok_fg_id"] = $eski_lamba[0]->stok_id;
                    $stok_giris_data["giris_miktar"] = 1;
                    $stok_giris_data["hareket_kaydeden_kullanici"] = aktif_kullanici()->kullanici_id;
                    $stok_giris_data["hareket_detay"] = $secilen_stok[0]->tanimlanan_cihaz_seri_numarasi." çıkma parça olarak stoğa girildi.";
                    $this->Stok_model->add_stok_hareket($stok_giris_data);

                }

            
            }else{
                echo "ESKİ LAMBA BULUNAMADI<br><br>";




                $eski_lamba_durum = $this->input->post("eski_lamba_kullanim_durumu");
                if($eski_lamba_durum == 0){
                    echo "ESKİ LAMBA ÇÖPE ATILDI<br><br>";
                   $this->db->insert("stoklar",
                    [
                        "stok_tanim_kayit_id"=>34,
                        "stok_seri_kod"=>"01.034/LM".str_replace("01.034/LM","",$this->input->post("lamba_seri_kod_eski")),
                        "tanimlanan_cihaz_seri_numarasi"=>"0",
                        "stok_ust_grup_kayit_no"=>0,
                        "stok_cikis_yapildi"=>0,
                        "stok_tanimlanma_durum"=>0,
                        "stok_cop_mu"=>1,
                        "stok_cop_seri_no"=>$this->input->post("cihaz_seri_no"),
                        "stok_cop_tarihi"=>date("Y-m-d H:i:s")
                    ]
                );
              


                }else{
                    echo "ESKİ LAMBA STOĞA GİRDİ<br><br>";

                   
                    $this->db->insert("stoklar",
                        [
                            "stok_tanim_kayit_id"=>34,
                            "stok_seri_kod"=>"01.034/LM".str_replace("01.034/LM","",$this->input->post("lamba_seri_kod_eski")),
                            "tanimlanan_cihaz_seri_numarasi"=>"0",
                            "stok_ust_grup_kayit_no"=>0,
                            "stok_cikis_yapildi"=>0,
                            "stok_tanimlanma_durum"=>0,
                            "cikma_parca_mi"=>1,
                            "cikma_parca_seri_no"=>$this->input->post("cihaz_seri_no"),
                            "cikma_parca_tarihi"=>date("Y-m-d H:i:s")
                        ]
                    );
                    $in_id = $this->db->insert_id();
                  
                    $stok_giris_data = [];
                    $stok_giris_data["stok_fg_id"] = $in_id;
                    $stok_giris_data["giris_miktar"] = 1;
                    $stok_giris_data["hareket_kaydeden_kullanici"] = aktif_kullanici()->kullanici_id;
                    $stok_giris_data["hareket_detay"] = $this->input->post("cihaz_seri_no")." çıkma parça olarak stoğa girildi.";
                    $this->Stok_model->add_stok_hareket($stok_giris_data);

                }
            }
*/
   
            $this->db->where(["stok_id"=>$tanimlanacak_stok[0]->stok_id])->update("stoklar",["tanimlanan_cihaz_seri_numarasi"=>$secilen_stok[0]->tanimlanan_cihaz_seri_numarasi,"stok_ust_grup_kayit_no"=>$secilen_stok[0]->stok_id,"stok_tanimlanma_durum"=>1]);
            echo "LAMBA TANIMLANDI";
        }

            redirect($_SERVER['HTTP_REFERER']); 
        
    }
    public function serialqr()
	{   
        $this->load->view("baslik/qr/serial");
    }

    public function baslik_tanimla($cihaz_id,$baslik_id)
	{   

        yetki_kontrol("cihaz_duzenle");
            $check_id = $this->Cihaz_model->get_by_id($cihaz_id); 
            $garanti_baslangic = date('Y-m-d',strtotime($check_id[0]->garanti_baslangic_tarihi));
            $garanti_bitis     = date('Y-m-d',strtotime($check_id[0]->garanti_bitis_tarihi));
            
            $baslik_data = [];
            $baslik_data["siparis_urun_id"] = $cihaz_id;
            $baslik_data["urun_baslik_no"]  = $baslik_id;
            $baslik_data["dahili_baslik"]   = 1;
            $baslik_data["baslik_seri_no"]  = "B".date('dmYHis')."UG01";
            $baslik_data["baslik_garanti_baslangic_tarihi"] = $garanti_baslangic;
           
            $baslik_data["baslik_garanti_bitis_tarihi"] = $garanti_bitis;
            $this->Baslik_model->insert($baslik_data); 
      
        
	}
	public function add()
	{   
        yetki_kontrol("baslik_ekle");
		$viewData["page"] = "baslik/form";
		$this->load->view('base_view',$viewData);
	}

	public function edit($id = '')
	{  
		$check_id = $this->Baslik_model->get_by_id(["urun_baslik_tanim_id"=>$id]); 
        if($check_id){  
            $viewData['urun'] = $this->Cihaz_model->get_by_id($check_id[0]->siparis_urun_id)[0]; 
            $siparis = $this->Siparis_model->get_by_id($check_id[0]->siparis_id); 
            $viewData['siparis'] = $siparis[0];
            $viewData['baslik'] = $check_id[0];
            $viewData['merkez'] =  $this->Merkez_model->get_by_id($siparis[0]->merkez_no);
			$viewData["page"] = "baslik/form"; 
			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('cihaz'));
        }
 
	}

    public function delete($id)
	{     
        yetki_kontrol("baslik_sil");
		$this->Baslik_model->delete($id);  
        redirect($_SERVER['HTTP_REFERER']); 
	}

 public function baslik_havuz_sil($id)
	{     
        yetki_kontrol("baslik_havuz_sil");
        $this->db->delete('baslik_havuzu', array('baslik_havuz_id' => $id));
        redirect($_SERVER['HTTP_REFERER']); 
	}


	public function save($id = '')
	{   
        if(empty($id)){
            yetki_kontrol("baslik_ekle");
        }else{
            yetki_kontrol("baslik_duzenle");
        }
        $this->form_validation->set_rules('seri_numarasi',  'Cihaz Adı',  'required');  
        $garanti_baslangic       = date('Y-m-d',strtotime($this->input->post('garanti_baslangic_tarihi')));
        $garanti_bitis           = date('Y-m-d',strtotime($this->input->post('garanti_bitis_tarihi')));
        $data['baslik_seri_no']  = escape($this->input->post('seri_numarasi'));
        $data['baslik_garanti_baslangic_tarihi'] = $garanti_baslangic; 
        $data['baslik_garanti_bitis_tarihi']     = $garanti_bitis;
        $data['dahili_baslik'] = escape($this->input->post('dahili_baslik'));

        if ($this->form_validation->run() != FALSE && !empty($id)) {
            $check_id = $this->Baslik_model->get_by_id(["urun_baslik_tanim_id"=>$id]);
            if($check_id){
                $this->Baslik_model->update($id,$data);
                redirect(base_url("cihaz/edit/".$check_id[0]->siparis_urun_id));
             }
        } else{
            $this->session->set_flashdata('form_errors', json_encode($this->form_validation->error_array()));
            redirect(site_url('baslik/ekle'));
        }
		redirect(site_url('baslik'));
	}
}
