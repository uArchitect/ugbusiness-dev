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

        } else{
            $this->db->where("talep_olusturan_kullanici_no",$this->session->userdata('aktif_kullanici_id'));
        }


        $data = $this->db->select('stok_onaylar.*,kullanicilar.kullanici_ad_soyad,kullanicilar.kullanici_id,stok_tanimlari.stok_tanim_ad')
                     ->from('stok_onaylar') 
                     ->join('kullanicilar', 'kullanicilar.kullanici_id = stok_onaylar.talep_olusturan_kullanici_no')
                     ->join('stok_tanimlari', 'stok_tanimlari.stok_tanim_id = stok_onaylar.stok_kayit_no')->
                     order_by("stok_onay_id","desc")->get()->result();
 
		$viewData["talepler"] = $data;
		$viewData["page"] = "depo_onay/list";
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
    
    public function birinci_onay($kayit_id)
	{   
        $this->db->where("stok_onay_id",$kayit_id)->update("stok_onaylar",["birinci_onay_durumu"=>1,"birinci_onay_tarihi"=>date("Y-m-d H:i"),"birinci_onay_kullanici_no"=>$this->session->userdata('aktif_kullanici_id')]); 
        redirect("depo_onay");
	}

    public function teslim_onay($kayit_id)
	{   
        $this->db->where("stok_onay_id",$kayit_id)->update("stok_onaylar",["teslim_alma_onayi"=>1,"teslim_alma_onay_tarihi"=>date("Y-m-d H:i")]); 
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
