<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Baslik_model extends CI_Model {
  public function __construct()
  {
    parent::__construct();
  } 
  public function get_by_id($where = null){
    $response = false;
    if($where != null){
      $this->db->where($where);
    }
    $query = $this->db
    ->select("urun_baslik_tanimlari.dahili_baslik,urun_baslik_tanimlari.baslik_tanim_kayit_tarihi,urunler.urun_slug,merkezler.merkez_adresi,urun_baslik_tanimlari.urun_baslik_tanim_id,urun_basliklari.baslik_resim,urun_baslik_tanimlari.baslik_seri_no,merkezler.merkez_id,siparisler.siparis_id,urun_basliklari.baslik_adi,urun_baslik_tanimlari.baslik_garanti_bitis_tarihi,urun_baslik_tanimlari.baslik_garanti_baslangic_tarihi,
    musteriler.musteri_ad,
              merkezler.merkez_adi,urun_basliklari.baslik_adi,
              urunler.urun_adi,
              siparis_urunleri.siparis_urun_id,musteriler.musteri_iletisim_numarasi,
              siparis_urunleri.seri_numarasi,
              siparis_urunleri.garanti_baslangic_tarihi,
              siparis_urunleri.garanti_bitis_tarihi,
              sehirler.sehir_adi,
              ilceler.ilce_adi")
    ->order_by('siparis_urun_id', 'ASC')
    ->join("urun_basliklari","urun_baslik_tanimlari.urun_baslik_no = urun_basliklari.baslik_id")
    ->join("siparis_urunleri","urun_baslik_tanimlari.siparis_urun_id = siparis_urunleri.siparis_urun_id")
    ->join("urunler","urunler.urun_id = siparis_urunleri.urun_no")
    ->join("siparisler","siparis_urunleri.siparis_kodu = siparisler.siparis_id")
    ->join("merkezler","siparisler.merkez_no = merkezler.merkez_id")
    ->join("musteriler","merkezler.merkez_yetkili_id = musteriler.musteri_id")
    ->join("sehirler","merkezler.merkez_il_id = sehirler.sehir_id")
    ->join("ilceler","merkezler.merkez_ilce_id = ilceler.ilce_id") 
    ->get("urun_baslik_tanimlari");
    if($query && $query->num_rows()){
      $response = $query->result();
    }
    return $response;
  }








  public function get_by_havuz($where = null){
    $response = false;
    if($where != null){
      $this->db->where($where);
    }
    $query = $this->db
    ->select("*")
    ->join("urunler","baslik_havuzu.cihaz_kayit_no = urunler.urun_id")
    ->join("urun_basliklari","baslik_havuzu.baslik_kayit_no = urun_basliklari.baslik_id")
    ->order_by("baslik_havuzu.baslik_havuz_id","desc")
    ->get("baslik_havuzu");
    
      $response = $query->result();
 
    return $response;
  }





  public function delete($id){
    $this->db->delete('urun_baslik_tanimlari', array('urun_baslik_tanim_id' => $id));
  }



  public function isleme_alinan_basliklar($where = null)
  {
    if($where != null){
      $this->db->where($where);
    }
    $query = $this->db
                  ->select("urun_baslik_ariza_tanimlari.urun_baslik_ariza_tanim_id,
                  urun_baslik_ariza_tanimlari.urun_baslik_ariza_durum_no,
                  urun_baslik_ariza_tanimlari.urun_baslik_ariza,
 urun_baslik_ariza_tanimlari.siparis_urun_baslik_no,
urun_baslik_ariza_tanimlari.urun_baslik_ariza_aciklama,urun_baslik_ariza_tanimlari.ariza_tamamlandi,urun_baslik_ariza_tanimlari.urun_baslik_ariza_sonlandirma_tarihi,
         urun_baslik_ariza_tanimlari.urun_baslik_ariza_kayit_tarihi,
         urun_baslik_ariza_siparis_durumlari.urun_baslik_ariza_siparis_durum_adi,

                  urun_baslik_tanimlari.urun_baslik_tanim_id, urun_baslik_ariza_tanimlari.ariza_siparis_durum_guncelleme_tarihi,
                            urun_basliklari.baslik_adi,urun_basliklari.baslik_id,
                            urun_baslik_tanimlari.baslik_garanti_bitis_tarihi,  urun_baslik_tanimlari.dahili_baslik, urun_baslik_tanimlari.baslik_seri_no,
                            urun_baslik_tanimlari.baslik_garanti_baslangic_tarihi,
                            musteriler.musteri_ad,  
                            musteriler.musteri_iletisim_numarasi,
                            musteriler.musteri_kod,
                            merkezler.merkez_adi,         merkezler.merkez_adresi,
                            urunler.urun_adi, urunler.urun_id,
                            siparis_urunleri.siparis_urun_id,
                            siparis_urunleri.seri_numarasi,   
                            borclu_cihazlar.borc_durum as cihaz_borc_uyarisi,
                            siparis_urunleri.garanti_baslangic_tarihi,
                            siparis_urunleri.garanti_bitis_tarihi,
                            sehirler.sehir_adi,
                            ilceler.ilce_adi")
                  
                  ->join("urun_baslik_tanimlari","urun_baslik_tanimlari.urun_baslik_tanim_id = urun_baslik_ariza_tanimlari.siparis_urun_baslik_no")
                  ->join("urun_basliklari","urun_baslik_tanimlari.urun_baslik_no = urun_basliklari.baslik_id")
                  ->join("siparis_urunleri","urun_baslik_tanimlari.siparis_urun_id = siparis_urunleri.siparis_urun_id")
                  ->join("urunler","urunler.urun_id = siparis_urunleri.urun_no")
                  ->join("siparisler","siparis_urunleri.siparis_kodu = siparisler.siparis_id")
                  ->join("merkezler","siparisler.merkez_no = merkezler.merkez_id")
                  ->join("musteriler","merkezler.merkez_yetkili_id = musteriler.musteri_id")
                  ->join("sehirler","merkezler.merkez_il_id = sehirler.sehir_id")
                  ->join("ilceler","merkezler.merkez_ilce_id = ilceler.ilce_id")
                  ->join("urun_baslik_ariza_siparis_durumlari","urun_baslik_ariza_tanimlari.urun_baslik_ariza_durum_no = urun_baslik_ariza_siparis_durumlari.urun_baslik_ariza_siparis_durum_id")
                  ->join("borclu_cihazlar","borclu_cihazlar.borclu_seri_numarasi = siparis_urunleri.seri_numarasi","left")
                  
                  
                  ->order_by("urun_baslik_ariza_tanimlari.urun_baslik_ariza_tanim_id","desc")
                  ->get("urun_baslik_ariza_tanimlari");
                  return $query->result();
  }


  public function get_all()
  {
    $query = $this->db
                  ->select("urun_baslik_tanimlari.urun_baslik_tanim_id,urun_basliklari.baslik_adi,urun_baslik_tanimlari.baslik_garanti_bitis_tarihi,urun_baslik_tanimlari.baslik_seri_no,urun_baslik_tanimlari.dahili_baslik,urun_baslik_tanimlari.baslik_garanti_baslangic_tarihi,
                  musteriler.musteri_ad,
                            merkezler.merkez_adi,
                            urunler.urun_adi,
                            siparis_urunleri.siparis_urun_id,
                            siparis_urunleri.seri_numarasi,
                            siparis_urunleri.garanti_baslangic_tarihi,
                            siparis_urunleri.garanti_bitis_tarihi,
                            sehirler.sehir_adi,
                            ilceler.ilce_adi")
                  ->order_by('siparis_urun_id', 'ASC')
                  ->join("urun_basliklari","urun_baslik_tanimlari.urun_baslik_no = urun_basliklari.baslik_id")
                  ->join("siparis_urunleri","urun_baslik_tanimlari.siparis_urun_id = siparis_urunleri.siparis_urun_id")
                  ->join("urunler","urunler.urun_id = siparis_urunleri.urun_no")
                  ->join("siparisler","siparis_urunleri.siparis_kodu = siparisler.siparis_id")
                  ->join("merkezler","siparisler.merkez_no = merkezler.merkez_id")
                  ->join("musteriler","merkezler.merkez_yetkili_id = musteriler.musteri_id")
                  ->join("sehirler","merkezler.merkez_il_id = sehirler.sehir_id")
                  ->join("ilceler","merkezler.merkez_ilce_id = ilceler.ilce_id")
                  ->get("urun_baslik_tanimlari");
                  return $query->result();
  }
  public function insert_baslik_ariza($data){
    $this->db->insert('urun_baslik_ariza_tanimlari', $data);      
  }
  public function insert($data){
    $this->db->insert('urun_baslik_tanimlari', $data);      
  }
  public function update($id,$data){
		$this->db->where('urun_baslik_tanim_id', $id);
		$this->db->update('urun_baslik_tanimlari', $data);
	}
  public function update_all($id,$data){
		$this->db->where(["siparis_urun_id"=>$id])->where(["dahili_baslik"=>1])->update('urun_baslik_tanimlari', $data);
	}
}