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
        
        if(goruntuleme_kontrol("depo_birinci_onay") == true){

        }else if(goruntuleme_kontrol("depo_ikinci_onay") == true){

        }else{
            $this->db->where("talep_olusturan_kullanici_no",$this->session->userdata('aktif_kullanici_id'));
        }


        $data = $this->db->select('stok_onaylar.*,kullanicilar.kullanici_ad_soyad,kullanicilar.kullanici_id,stok_tanimlari.stok_tanim_ad,')
                     ->from('stok_onaylar') 
                     ->join('kullanicilar', 'kullanicilar.kullanici_id = stok_onaylar.talep_olusturan_kullanici_no')
                     ->join('stok_tanimlari', 'stok_tanimlari.stok_tanim_id = stok_onaylar.stok_kayit_no')
                     ->get();


		$viewData["talepler"] = $data;
		$viewData["page"] = "depo_onay/list";
		$this->load->view('base_view',$viewData);
	}
public function sil($kayit_id)
	{   
        $this->db->where("stok_onay_id",$kayit_id)->delete("stok_onaylar"); 
        redirect("depo_onay");
	}
	public function talep_olustur()
	{   
        $data = $this->db->select('stok_tanim_id,stok_tanim_ad')->from('stok_tanimlari')->get()->result();
		$viewData["stok_tanimlari"] = $data;
		$viewData["page"] = "depo_onay/form";
		$this->load->view('base_view',$viewData);
	}
 
	public function talep_olustur_save($kullanici_id)
	{   
       $insertdata =array(
            'stok_kayit_no'      => $this->input->post('stok_kayit_no'),
            'talep_olusturan_kullanici_no' => $this->session->userdata('aktif_kullanici_id'),
            'talep_miktar' => $this->input->post('talep_miktar'),
        );
        $this->db->insert("stok_onaylar",$insertdata);
        redirect("depo_onay");

	}
}
