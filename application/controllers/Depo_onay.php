<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Depo_onay extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control(); 
        date_default_timezone_set('Europe/Istanbul');
    }
 
	public function index()
	{
        

        $aa = aktif_kullanici();

        if(goruntuleme_kontrol("depo_birinci_onay") == true){
 
        } 
        else if(goruntuleme_kontrol("depo_on_onay") == true){
            $this->db->where("kkul.kullanici_departman_id", $aa->kullanici_departman_id);
        } 
        
        else{
            $this->db->where("talep_olusturan_kullanici_no", $aa->kullanici_id);
        }


        $data = $this->db->where("kayit_durum",1)->select('stok_onaylar.*,
                                kkul.kullanici_ad_soyad as kayit_kullanici_ad_soyad,
                                kkul.kullanici_id as kayit_kullanici_id,
                                tkul.kullanici_ad_soyad as teslim_kullanici_ad_soyad,
                                tkul.kullanici_id as teslim_kullanici_id')
                     ->from('stok_onaylar') 
                     ->join('kullanicilar as kkul', 'kkul.kullanici_id = stok_onaylar.talep_olusturan_kullanici_no')
                        ->join('kullanicilar as tkul', 'tkul.kullanici_id = stok_onaylar.teslim_alacak_kullanici_no')
                ->order_by("stok_onaylar.talep_olusturulma_tarihi", "desc")
                ->order_by("stok_onay_id", "desc")
                ->get()->result();

        // Her talep için iade bekleyen ürün kontrolü
        foreach($data as $talep) {
            $iade_bekleyen = $this->db->where('stok_talep_no', $talep->stok_onay_id)
                                      ->where('eski_parca_alınacak', 1)
                                      ->where('eski_parca_alindi', 0)
                                      ->get('stok_talep_edilen_malzemeler')
                                      ->num_rows();
            $talep->iade_bekleyen_sayisi = $iade_bekleyen;
            $talep->iade_bekleniyor = $iade_bekleyen > 0;
        }

		$viewData["talepler"] = $data;
		$viewData["page"] = "depo_onay/list";
		$this->load->view('base_view',$viewData);
	}



    	public function update($talep_id = 0)
	{
          yetki_kontrol("depo_birinci_onay");

           $datak = $this->db->where("kullanici_departman_id = 10 or kullanici_departman_id = 11")->select('kullanici_id,kullanici_ad_soyad')->from('kullanicilar')->get()->result();
		$viewData["kullanicilar"] = $datak;



        $data2 = $this->db->select('stok_tanim_id,stok_tanim_ad')->from('stok_tanimlari')->get()->result();
		$viewData["stok_tanimlari"] = $data2;

        $data = $this->db->where("stok_talep_no",$talep_id)->select('*')
                                ->from('stok_talep_edilen_malzemeler') 
                                ->join('stok_tanimlari as st', 'st.stok_tanim_id = stok_talep_edilen_malzemeler.stok_talep_edilen_malzeme_stok_no') 
                                ->get()->result();
 
		$viewData["veriler"] = $data;		
        
        $viewData["talepid"] = $talep_id;




         $datam = $this->db->where("stok_onay_id",$talep_id)->select('*')
                                ->from('stok_onaylar')  
                                ->get()->result()[0];
$viewData["teslimalacakid"] = $datam->teslim_alacak_kullanici_no;
 
$viewData["kayitolusturanid"] = $datam->talep_olusturan_kullanici_no;

        
		$viewData["page"] = "depo_onay/update";
		$this->load->view('base_view',$viewData);
	}


public function sil($kayit_id)
	{   yetki_kontrol("depo_birinci_onay");

        $this->db->where("stok_onay_id",$kayit_id)->update("stok_onaylar",["kayit_durum"=>0]); 
        redirect("depo_onay");
	}
    public function aktif($kayit_id)
	{   yetki_kontrol("depo_birinci_onay");

        $this->db->where("stok_onay_id",$kayit_id)->update("stok_onaylar",["kayit_durum"=>1]); 
        redirect("depo_onay");
	} 
    



     public function on_onay($kayit_id)
	{   

        yetki_kontrol("depo_on_onay");
            $abc = $this->db->where("stok_onay_id",$kayit_id)->get("stok_onaylar")->result()[0]->teslim_alacak_kullanici_no;
             $kll = $this->db->where("kullanici_id", $abc)->get("kullanicilar")->result()[0];
            
        //sendSmsData("05382197344","DEPO ÜRÜN İSTEK\n".date("d.m.Y H:i")." tarihinde ".aktif_kullanici()->kullanici_ad_soyad." adlı kullanıcı tarafından depodan ürün almak için form oluşturulmuştur. https://ugbusiness.com.tr/depo_onay");
        sendSmsData("05413625944","DEPO ÜRÜN İSTEK\n".date("d.m.Y H:i")." tarihinde ".aktif_kullanici()->kullanici_ad_soyad." adlı kullanıcı tarafından depodan ürün almak için form oluşturulmuştur. https://ugbusiness.com.tr/depo_onay");
        sendSmsData("05411580100","DEPO ÜRÜN İSTEK\n".date("d.m.Y H:i")." tarihinde ".aktif_kullanici()->kullanici_ad_soyad." adlı kullanıcı tarafından depodan ürün almak için form oluşturulmuştur. https://ugbusiness.com.tr/depo_onay");
        $this->db->where("stok_onay_id",$kayit_id)->update("stok_onaylar",["on_onay_durumu"=>1,"on_onay_tarihi"=>date("Y-m-d H:i"),"on_onay_kullanici_no"=>$this->session->userdata('aktif_kullanici_id')]); 
        $abc = $this->db->where("stok_onay_id",$kayit_id)->get("stok_onaylar")->result()[0]->talep_olusturan_kullanici_no;
        $kll = $this->db->where("kullanici_id", $abc)->get("kullanicilar")->result()[0]; 
        sendSmsData($kll->kullanici_bireysel_iletisim_no,"Sn. $kll->kullanici_ad_soyad ".date("d.m.Y H:i")." tarihinde oluşturduğunuz talep için ön onay verilmiştir. Ürünleri teslim almak için depoya gidebilirsiniz.");
        redirect("depo_onay");
	}
    public function birinci_onay($kayit_id)
	{   
        yetki_kontrol("depo_birinci_onay");
        $abc = $this->db->where("stok_onay_id",$kayit_id)->get("stok_onaylar")->result()[0]->teslim_alacak_kullanici_no;
        $kll = $this->db->where("kullanici_id", $abc)->get("kullanicilar")->result()[0];  
        sendSmsData($kll->kullanici_bireysel_iletisim_no,"Sn. $kll->kullanici_ad_soyad ".date("d.m.Y H:i")." tarihinde oluşturduğunuz talep için çıkış onayı verilmiştir. Teslim onayı vermeniz gerekmektedir.");
        $this->db->where("stok_onay_id",$kayit_id)->update("stok_onaylar",["birinci_onay_durumu"=>1,"birinci_onay_tarihi"=>date("Y-m-d H:i"),"birinci_onay_kullanici_no"=>$this->session->userdata('aktif_kullanici_id')]); 
        redirect("depo_onay");
	}
    
    public function birinssci_onay_iptal($kayit_id)
	{   
        $kontrol = $this->db->where("stok_onay_id",$kayit_id)->get("stok_onaylar")->result()[0];
        if($kontrol->teslim_alma_onayi == 1){
            $this->session->set_flashdata('flashDanger', 'Teslim onayı verildiği için çıkış onayını iptal edemezsiniz.');
            redirect("depo_onay");
        }

        $this->db->where("stok_onay_id",$kayit_id)->update("stok_onaylar",["birinci_onay_durumu"=>0,"birinci_onay_tarihi"=>date("Y-m-d H:i"),"birinci_onay_kullanici_no"=>$this->session->userdata('aktif_kullanici_id')]); 
        redirect("depo_onay");
	}
    public function teslim_onay($kayit_id)
	{   

        $kontrol = $this->db->where("stok_onay_id",$kayit_id)->get("stok_onaylar")->result()[0];
        if($kontrol->teslim_alacak_kullanici_no != $this->session->userdata('aktif_kullanici_id')){
            $this->session->set_flashdata('flashDanger', 'Teslim onayını sadece teslim alan kişi verebilir. İşlem Başarısız');
            redirect("depo_onay");
        }

        $this->db->where("stok_onay_id",$kayit_id)->update("stok_onaylar",["teslim_alma_onayi"=>1,"teslim_alma_onay_tarihi"=>date("Y-m-d H:i")]); 
        redirect("depo_onay");
	}
	public function talep_olustur()
	{   
        $data = $this->db->select('stok_tanim_id,stok_tanim_ad')->from('stok_tanimlari')->get()->result();
		$viewData["stok_tanimlari"] = $data;
  //     $datak = $this->db->where("kullanici_departman_id = 10 or kullanici_departman_id = 11")->select('kullanici_id,kullanici_ad_soyad')->from('kullanicilar')->get()->result();
		        $datak = $this->db->select('kullanici_id,kullanici_ad_soyad')->from('kullanicilar')->get()->result();
		$viewData["kullanicilar"] = $datak;
		$viewData["page"] = "depo_onay/form";
		$this->load->view('base_view',$viewData);
	}
    
    public function talep_guncelle_save($talepid)
	{   
        yetki_kontrol("depo_birinci_onay");
        $this->db->where("stok_talep_no",$talepid)->delete("stok_talep_edilen_malzemeler");
            $stoklar = $this->input->post('stok_kayit_no');
            $miktarlar = $this->input->post('talep_miktar');
            $eski_parca_alınacak = $this->input->post('eski_parca_alınacak');
            $eski_parca_alindi_dropdown = $this->input->post('eski_parca_alindi_dropdown');
            $urun_ariza_aciklama = $this->input->post('urun_ariza_aciklama');
            
            $eski_parca_verilmeyen_malzemeler = []; // Bildirim için tutulacak
            
             foreach ($stoklar as $i => $stok_id) {
                $miktar = $miktarlar[$i];
                
                // Eski parça alınacak mı kontrolü
                $eski_parca_alınacak_deger = 0;
                if(!empty($eski_parca_alınacak) && in_array($i, $eski_parca_alınacak)) {
                    $eski_parca_alınacak_deger = 1;
                }
                
                // Eski parça alındı mı kontrolü
                $eski_parca_alindi_deger = 0;
                $eski_parca_alindi_tarih_deger = null;
                // Eğer eski parça alınacak işaretlenmişse dropdown değerini kontrol et
                if($eski_parca_alınacak_deger == 1 && !empty($eski_parca_alindi_dropdown[$i])) {
                    $eski_parca_alindi_deger = (int)$eski_parca_alindi_dropdown[$i];
                    if($eski_parca_alindi_deger == 1) {
                        $eski_parca_alindi_tarih_deger = date('Y-m-d H:i:s');
                    }
                }
                // Eğer eski parça alınacak işaretlenmemişse, alındı değeri de 0 olmalı
                if($eski_parca_alınacak_deger == 0) {
                    $eski_parca_alindi_deger = 0;
                    $eski_parca_alindi_tarih_deger = null;
                }
                
                // Eğer eski parça alınacak ama alınmamışsa bildirim için kaydet
                if($eski_parca_alınacak_deger == 1 && $eski_parca_alindi_deger == 0) {
                    $malzeme_adi = $this->db->where('stok_tanim_id', $stok_id)->get('stok_tanimlari')->row();
                    if($malzeme_adi) 
                    {
                        $eski_parca_verilmeyen_malzemeler[] = [
                            'malzeme_adi' => $malzeme_adi->stok_tanim_ad,
                            'miktar' => $miktar
                        ];
                    }
                }
                
                // Ürün arızası açıklaması
                $ariza_aciklama = !empty($urun_ariza_aciklama[$i]) ? $urun_ariza_aciklama[$i] : null;
                
                $this->db->insert('stok_talep_edilen_malzemeler', [
                    'stok_talep_no'=> $talepid ,
                    'stok_talep_edilen_malzeme_stok_no' => $stok_id,
                    'stok_talep_edilen_malzeme_miktar' => $miktar,
                    'eski_parca_alınacak' => $eski_parca_alınacak_deger,
                    'eski_parca_alindi' => $eski_parca_alindi_deger,
                    'eski_parca_alindi_tarih' => $eski_parca_alindi_tarih_deger,
                    'urun_ariza_aciklama' => $ariza_aciklama
                ]);
            }
            
            // Teslim alacak kullanıcı güncellemesi
            $teslim_alacak_kullanici_no = $this->input->post('teslim_alacak_kullanici_no');
            $teslim_alacak_kullanici_id = !empty($teslim_alacak_kullanici_no) ? intval($teslim_alacak_kullanici_no) : null;
            
            // Eğer teslim alacak kullanıcı değiştirilmediyse mevcut değeri al
            if (empty($teslim_alacak_kullanici_id)) {
                $teslim_alacak_kullanici_id = $this->db->where("stok_onay_id",$talepid)->get("stok_onaylar")->result()[0]->teslim_alacak_kullanici_no;
            }
            
            // Eğer eski parça alınacak ama alınmamış malzemeler varsa müdüre bildirim gönder
            if(!empty($eski_parca_verilmeyen_malzemeler)) {
                $this->eski_parca_verilmedi_bildirimi_gonder($talepid, $teslim_alacak_kullanici_id, $eski_parca_verilmeyen_malzemeler);
            }
            
            $kll = $this->db->where("kullanici_id", $teslim_alacak_kullanici_id)->get("kullanicilar")->result()[0]; 
            
         sendSmsData($kll->kullanici_bireysel_iletisim_no,"Sn. $kll->kullanici_ad_soyad ".date("d.m.Y H:i")." tarihinde oluşturduğunuz talep için çıkış onayı verilmiştir. Teslim aldım onayı vermeniz gerekmektedir.");

        $update_data = [
            "birinci_onay_durumu" => 1,
            "birinci_onay_tarihi" => date("Y-m-d H:i"),
            "birinci_onay_kullanici_no" => $this->session->userdata('aktif_kullanici_id')
        ];
        
        // Eğer teslim alacak kullanıcı değiştirildiyse güncelle
        if (!empty($teslim_alacak_kullanici_no)) {
            $update_data["teslim_alacak_kullanici_no"] = intval($teslim_alacak_kullanici_no);
        }
        
        $this->db->where("stok_onay_id",$talepid)->update("stok_onaylar", $update_data);
        redirect("depo_onay");
 

	}





	public function talep_olustur_save($kullanici_id)
	{   



            $veri = [
                        'talep_olusturan_kullanici_no'    => $this->session->userdata('aktif_kullanici_id'),
                        'teslim_alacak_kullanici_no'      => $this->input->post('teslim_alacak_kullanici_no')  
                    ];


        if($this->session->userdata('aktif_kullanici_id') == 1305 || $this->session->userdata('aktif_kullanici_id') == 11  || $this->session->userdata('aktif_kullanici_id') == 12 ){
           $veri["on_onay_durumu"] = 1;
           $veri["on_onay_kullanici_no"] = $this->session->userdata('aktif_kullanici_id');
           
            }   


             $insert_id = $this->db->insert('stok_onaylar', $veri) ? $this->db->insert_id() : false;

            $stoklar = $this->input->post('stok_kayit_no');
            $miktarlar = $this->input->post('talep_miktar');
            $eski_parca_alınacak = $this->input->post('eski_parca_alınacak');
            $eski_parca_alindi_dropdown = $this->input->post('eski_parca_alindi_dropdown');
            $urun_ariza_aciklama = $this->input->post('urun_ariza_aciklama');

            foreach ($stoklar as $i => $stok_id) {
                $miktar = $miktarlar[$i];
                
                // Eski parça alınacak mı kontrolü
                $eski_parca_alınacak_deger = 0;
                if(!empty($eski_parca_alınacak) && in_array($i, $eski_parca_alınacak)) {
                    $eski_parca_alınacak_deger = 1;
                }
                
                // Eski parça alındı mı kontrolü
                $eski_parca_alindi_deger = 0;
                $eski_parca_alindi_tarih_deger = null;
                // Eğer eski parça alınacak işaretlenmişse dropdown değerini kontrol et
                if($eski_parca_alınacak_deger == 1 && !empty($eski_parca_alindi_dropdown[$i])) {
                    $eski_parca_alindi_deger = (int)$eski_parca_alindi_dropdown[$i];
                    if($eski_parca_alindi_deger == 1) {
                        $eski_parca_alindi_tarih_deger = date('Y-m-d H:i:s');
                    }
                }
                // Eğer eski parça alınacak işaretlenmemişse, alındı değeri de 0 olmalı
                if($eski_parca_alınacak_deger == 0) {
                    $eski_parca_alindi_deger = 0;
                    $eski_parca_alindi_tarih_deger = null;
                }
                
                // Ürün arızası açıklaması
                $ariza_aciklama = !empty($urun_ariza_aciklama[$i]) ? $urun_ariza_aciklama[$i] : null;
                
                $this->db->insert('stok_talep_edilen_malzemeler', [
                    'stok_talep_no'=> $insert_id ,
                    'stok_talep_edilen_malzeme_stok_no' => $stok_id,
                    'stok_talep_edilen_malzeme_miktar' => $miktar,
                    'eski_parca_alınacak' => $eski_parca_alınacak_deger,
                    'eski_parca_alindi' => $eski_parca_alindi_deger,
                    'eski_parca_alindi_tarih' => $eski_parca_alindi_tarih_deger,
                    'urun_ariza_aciklama' => $ariza_aciklama
                ]);
            }






            $departman_id = aktif_kullanici()->kullanici_departman_id;

            if($this->session->userdata('aktif_kullanici_id') == 1305 || $this->session->userdata('aktif_kullanici_id') == 11  || $this->session->userdata('aktif_kullanici_id') == 12 ){
          
            }else{

            
            if($departman_id == 10){
                sendSmsData("05520087825","Sn. BARIŞ KALALI,\n".date("d.m.Y H:i")." tarihinde ".aktif_kullanici()->kullanici_ad_soyad." adlı kullanıcı tarafından depodan ürün almak için form oluşturulmuştur. Bilgileri Kontrol Edip Ön Onay Veriniz.");
               

            }
            if($departman_id == 11){
              sendSmsData("05468311012","Sn. FIRAT AYAZ,\n".date("d.m.Y H:i")." tarihinde ".aktif_kullanici()->kullanici_ad_soyad." adlı kullanıcı tarafından depodan ürün almak için form oluşturulmuştur. Bilgileri Kontrol Edip Ön Onay Veriniz.");
               sendSmsData("05468311011","Sn. ŞABAN HANÇER,\n".date("d.m.Y H:i")." tarihinde ".aktif_kullanici()->kullanici_ad_soyad." adlı kullanıcı tarafından depodan ürün almak için form oluşturulmuştur. Bilgileri Kontrol Edip Ön Onay Veriniz.");
               

            }
            }
 
        redirect("depo_onay");

	}

    public function get_detaylar() {
        $numara = $this->input->post('numara');
        $query = $this->db->where("stok_talep_no",$numara)->select('*')
                ->from('stok_talep_edilen_malzemeler') 
                ->join('stok_tanimlari as st', 'st.stok_tanim_id = stok_talep_edilen_malzemeler.stok_talep_edilen_malzeme_stok_no') 
                ->get();
            if($query->num_rows() > 0){
                echo json_encode(['status' => 'success', 'data' => $query->result()]);
            } else {
                echo json_encode(['status' => 'error']);
            }
        }
    
    /**
     * İade durumu güncelleme
     * Tek bir ürün için iade durumunu günceller
     */
    public function iade_durum_guncelle() {
        yetki_kontrol("depo_birinci_onay");
        
        $malzeme_id = $this->input->post('malzeme_id');
        $talep_id = $this->input->post('talep_id');
        $iade_durum = $this->input->post('iade_durum'); // 0 = Bekleniyor, 1 = Alındı
        
        if(empty($malzeme_id) || empty($talep_id)) {
            echo json_encode(['status' => 'error', 'message' => 'Eksik parametre']);
            return;
        }
        
        // Önce mevcut kaydı kontrol et - eski parça alınacak mı?
        $mevcut_kayit = $this->db->where('stok_talep_edilen_malzeme_id', $malzeme_id)
                                 ->where('stok_talep_no', $talep_id)
                                 ->get('stok_talep_edilen_malzemeler')
                                 ->row();
        
        if(!$mevcut_kayit) {
            echo json_encode(['status' => 'error', 'message' => 'Kayıt bulunamadı']);
            return;
        }
        
        // Eğer eski parça alınacak değilse, iade durumu güncellenemez
        if($mevcut_kayit->eski_parca_alınacak != 1) {
            echo json_encode(['status' => 'error', 'message' => 'Bu ürün için eski parça alınacak işaretlenmemiş']);
            return;
        }
        
        $update_data = [
            'eski_parca_alindi' => (int)$iade_durum
        ];
        
        // Eğer alındı seçildiyse otomatik olarak tarih ekle
        if($iade_durum == 1) {
            $update_data['eski_parca_alindi_tarih'] = date('Y-m-d H:i:s');
        } else {
            $update_data['eski_parca_alindi_tarih'] = null;
        }
        
        $this->db->where('stok_talep_edilen_malzeme_id', $malzeme_id)
                 ->where('stok_talep_no', $talep_id)
                 ->update('stok_talep_edilen_malzemeler', $update_data);
        
        if($this->db->affected_rows() > 0) {
            echo json_encode(['status' => 'success', 'message' => 'İade durumu güncellendi']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Güncelleme başarısız']);
        }
    }
    
    /**
     * Eski parça verilmedi bildirimi gönder
     * Eğer eski parça alınacak işaretlenmiş ama alınmamışsa müdüre bildirim gönder
     */
    private function eski_parca_verilmedi_bildirimi_gonder($talep_id, $teslim_alacak_kullanici_id, $verilmeyen_malzemeler) {
        // Bildirim tipi ID'sini al veya oluştur
        $bildirim_tipi = $this->db->where('ad', 'Eski Parça Verilmedi Bildirimi')
                                  ->get('bildirim_tipleri')
                                  ->row();
        
        if(!$bildirim_tipi){
            // Bildirim tipi yoksa oluştur
            $this->db->insert('bildirim_tipleri', [
                'ad' => 'Eski Parça Verilmedi Bildirimi',
                'gereken_onay_seviyesi' => 2, // Müdür onayı
                'aciklama' => 'Eski parça alınacak işaretlenmiş ama alınmamış malzemeler için müdür onayı gerekir'
            ]);
            $tip_id = $this->db->insert_id();
        } else {
            $tip_id = $bildirim_tipi->id;
        }
        
        // Teslim alacak kullanıcı bilgilerini al
        $teslim_alacak_kullanici = $this->db->where('kullanici_id', $teslim_alacak_kullanici_id)
                                           ->get('kullanicilar')
                                           ->row();
        
        // Talep bilgilerini al
        $talep = $this->db->where('stok_onay_id', $talep_id)
                         ->get('stok_onaylar')
                         ->row();
        
        // Bildirim başlığı ve mesajı
        $baslik = 'Eski Parça Verilmedi Uyarısı';
        $mesaj = 'Sayın Genel Müdürümüz,';
        $mesaj .= "\n\n";
        $mesaj .= ($teslim_alacak_kullanici ? $teslim_alacak_kullanici->kullanici_ad_soyad : 'Bir kullanıcı');
        $mesaj .= " tarafından oluşturulan depo çıkış talebi (#{$talep_id}) için çıkış onayı verilmiştir.";
        $mesaj .= "\n\n";
        $mesaj .= "Ancak aşağıdaki malzemeler için eski parça alınacak işaretlenmiş olmasına rağmen eski parça alınmamıştır:";
        $mesaj .= "\n\n";
        
        foreach($verilmeyen_malzemeler as $malzeme) {
            $mesaj .= "• " . $malzeme['malzeme_adi'] . " (Miktar: " . $malzeme['miktar'] . ")";
            $mesaj .= "\n";
        }
        
        $mesaj .= "\n";
        $mesaj .= "Bu durumun kontrol edilmesi gerekmektedir.";
        $mesaj .= "\n\n";
        $mesaj .= "Talep Tarihi: " . date('d.m.Y H:i');
        $mesaj .= "\n";
        $mesaj .= "Talep ID: #{$talep_id}";
        
        // Bildirim oluştur
        $this->db->insert('sistem_bildirimleri', [
            'tip_id' => $tip_id,
            'gonderen_id' => $teslim_alacak_kullanici_id,
            'baslik' => $baslik,
            'mesaj' => $mesaj,
            'okundu' => 0,
            'onay_durumu' => 'pending'
        ]);
        $bildirim_id = $this->db->insert_id();
        
        // Müdüre bildirim gönder (ID: 9)
        $mudur_id = 9;
        $this->db->insert('sistem_bildirim_alicilar', [
            'bildirim_id' => $bildirim_id,
            'alici_id' => $mudur_id,
            'okundu' => 0
        ]);
        
        // Hareket kaydı ekle
        $this->db->insert('sistem_bildirim_hareketleri', [
            'bildirim_id' => $bildirim_id,
            'kullanici_id' => $teslim_alacak_kullanici_id,
            'hareket_tipi' => 'gonderildi',
            'aciklama' => 'Eski parça verilmedi bildirimi gönderildi - Talep ID: ' . $talep_id
        ]);
    }
}






