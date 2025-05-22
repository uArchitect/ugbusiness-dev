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
                ->order_by("stok_onay_id","desc")->get()->result();
 
		$viewData["talepler"] = $data;
		$viewData["page"] = "depo_onay/list";
		$this->load->view('base_view',$viewData);
	}



    	public function update($talep_id = 0)
	{
         

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
	{   
        $this->db->where("stok_onay_id",$kayit_id)->update("stok_onaylar",["kayit_durum"=>0]); 
        redirect("depo_onay");
	}
    public function aktif($kayit_id)
	{   
        $this->db->where("stok_onay_id",$kayit_id)->update("stok_onaylar",["kayit_durum"=>1]); 
        redirect("depo_onay");
	} 
    



     public function on_onay($kayit_id)
	{   

        yetki_kontrol("depo_on_onay");
            $abc = $this->db->where("stok_onay_id",$kayit_id)->get("stok_onaylar")->result()[0]->teslim_alacak_kullanici_no;
             $kll = $this->db->where("kullanici_id", $abc)->get("kullanicilar")->result()[0];
            
        sendSmsData("05382197344","DEPO ÜRÜN İSTEK\n".date("d.m.Y H:i")." tarihinde ".aktif_kullanici()->kullanici_ad_soyad." adlı kullanıcı tarafından depodan ürün almak için form oluşturulmuştur.");
        sendSmsData("05413625944","DEPO ÜRÜN İSTEK\n".date("d.m.Y H:i")." tarihinde ".aktif_kullanici()->kullanici_ad_soyad." adlı kullanıcı tarafından depodan ürün almak için form oluşturulmuştur.");




        

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

            foreach ($stoklar as $i => $stok_id) {
                $miktar = $miktarlar[$i];
                
                 
                $this->db->insert('stok_talep_edilen_malzemeler', [
                    'stok_talep_no'=> $talepid ,
                    'stok_talep_edilen_malzeme_stok_no' => $stok_id,
                    'stok_talep_edilen_malzeme_miktar' => $miktar 
                ]);
            }








            $abc = $this->db->where("stok_onay_id",$kayit_id)->get("stok_onaylar")->result()[0]->teslim_alacak_kullanici_no;
             $kll = $this->db->where("kullanici_id", $abc)->get("kullanicilar")->result()[0];
            
         sendSmsData($kll->kullanici_bireysel_iletisim_no,"Sn. $kll->kullanici_ad_soyad ".date("d.m.Y H:i")." tarihinde oluşturduğunuz talep için çıkış onayı verilmiştir. Teslim aldım onayı vermeniz gerekmektedir.");

        $this->db->where("stok_onay_id",$kayit_id)->update("stok_onaylar",["birinci_onay_durumu"=>1,"birinci_onay_tarihi"=>date("Y-m-d H:i"),"birinci_onay_kullanici_no"=>$this->session->userdata('aktif_kullanici_id')]); 
        redirect("depo_onay");
 

	}





	public function talep_olustur_save($kullanici_id)
	{   



            $veri = [
                        'talep_olusturan_kullanici_no'    => $this->session->userdata('aktif_kullanici_id'),
                        'teslim_alacak_kullanici_no'         => $this->input->post('teslim_alacak_kullanici_no')  
                    ];


        if($this->session->userdata('aktif_kullanici_id') == 1305 || $this->session->userdata('aktif_kullanici_id') == 11  || $this->session->userdata('aktif_kullanici_id') == 12 ){
           $veri["on_onay_durumu"] = 1;
           $veri["on_onay_kullanici_no"] = $this->session->userdata('aktif_kullanici_id');
           
            }   


             $insert_id = $this->db->insert('stok_onaylar', $veri) ? $this->db->insert_id() : false;

            $stoklar = $this->input->post('stok_kayit_no');
            $miktarlar = $this->input->post('talep_miktar');

            foreach ($stoklar as $i => $stok_id) {
                $miktar = $miktarlar[$i];
                
                 
                $this->db->insert('stok_talep_edilen_malzemeler', [
                    'stok_talep_no'=> $insert_id ,
                    'stok_talep_edilen_malzeme_stok_no' => $stok_id,
                    'stok_talep_edilen_malzeme_miktar' => $miktar 
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
}






