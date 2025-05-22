<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cihaz_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
    public function get_by_id($id){
		$response = false;
		$query = $this->db->join("urunler","urunler.urun_id = siparis_urunleri.urun_no")
    ->get_where("siparis_urunleri",array('siparis_urun_id' => $id));
		if($query && $query->num_rows()){
			$response = $query->result();
		}
		return $response;
    }
    
    public function delete($id){
      $this->db->delete('siparis_urunleri', array('siparis_urun_id' => $id));
                 
    }
   
   
   
    public function get_all($where = null,$where2=null)
    {if($where != null){
      $this->db->where($where);
      if($where2 != null){
        $this->db->or_where($where2);
      }
    }
    $this->db->where(["siparis_aktif"=>1]);
      $query = $this->db
                    ->select("musteriler.musteri_id,musteriler.musteri_ad,borclu_cihazlar.borc_durum as cihaz_borc_uyarisi,musteriler.musteri_kod,musteriler.musteri_iletisim_numarasi,
                    merkezler.merkez_adi,merkezler.merkez_adresi,merkezler.merkez_yetkili_id,  merkezler.merkez_id,
                              urunler.urun_adi, urunler.urun_slug,siparis_urunleri.takas_cihaz_mi,siparis_urunleri.takas_alinan_merkez_id,
                              siparis_urunleri.siparis_urun_id, siparis_urunleri.musteri_degisim_aciklama,
                              siparis_urunleri.seri_numarasi,,siparis_urunleri.urun_iade_durum,siparis_urunleri.urun_iade_tarihi,siparis_urunleri.urun_iade_notu,
                              siparis_urunleri.garanti_baslangic_tarihi, siparis_urunleri.teslimat_merkez_no,
                              siparis_urunleri.garanti_bitis_tarihi, siparis_urunleri.satis_fiyati,siparisler.siparis_kodu,siparisler.siparis_id,
                              sehirler.sehir_adi,
                              ilceler.ilce_adi,urun_renkleri.renk_adi")
                    ->order_by('siparis_urun_id', 'DESC')
                    ->join("urunler","urunler.urun_id = siparis_urunleri.urun_no")
                    ->join("siparisler","siparis_urunleri.siparis_kodu = siparisler.siparis_id")
                    ->join("merkezler","siparisler.merkez_no = merkezler.merkez_id")
                    ->join("musteriler","merkezler.merkez_yetkili_id = musteriler.musteri_id")
                    ->join("sehirler","merkezler.merkez_il_id = sehirler.sehir_id")
                    ->join("ilceler","merkezler.merkez_ilce_id = ilceler.ilce_id")
                    ->join("borclu_cihazlar","borclu_cihazlar.borclu_seri_numarasi = siparis_urunleri.seri_numarasi","left")
                    ->join("urun_renkleri","siparis_urunleri.renk = urun_renkleri.renk_id","left")
                    ->get("siparis_urunleri");
      return $query->result();
    }


    public function get_garanti_sorgulayanlar($where = null)
    {if($where != null){
      $this->db->where($where);
    }
      $query = $this->db
                    ->select("musteriler.musteri_ad,garanti_sorgulama_log.*,musteriler.musteri_kod,musteriler.musteri_iletisim_numarasi,
                    merkezler.merkez_adi,merkezler.merkez_adresi,merkezler.merkez_yetkili_id,  merkezler.merkez_id,
                              urunler.urun_adi, urunler.urun_slug,
                              siparis_urunleri.siparis_urun_id,
                              siparis_urunleri.seri_numarasi,
                              siparis_urunleri.garanti_baslangic_tarihi,
                              siparis_urunleri.garanti_bitis_tarihi,
                              sehirler.sehir_adi,
                              ilceler.ilce_adi")
                    ->order_by('garanti_sorgulama_log.sorgulama_tarihi', 'DESC')
                    ->join("siparis_urunleri","garanti_sorgulama_log.sorgulanan_seri_numarasi = siparis_urunleri.seri_numarasi","left")
                    
                    ->join("urunler","urunler.urun_id = siparis_urunleri.urun_no","left")
                    ->join("siparisler","siparis_urunleri.siparis_kodu = siparisler.siparis_id","left")
                    ->join("merkezler","siparisler.merkez_no = merkezler.merkez_id","left")
                    ->join("musteriler","merkezler.merkez_yetkili_id = musteriler.musteri_id","left")
                    ->join("sehirler","merkezler.merkez_il_id = sehirler.sehir_id","left")
                    ->join("ilceler","merkezler.merkez_ilce_id = ilceler.ilce_id","left")
                    
                    ->get("garanti_sorgulama_log");
      return $query->result();
    }


    public function get_borclular($where = null)
    {if($where != null){
      $this->db->where($where);
    }
      $query = $this->db
                    ->select("musteriler.musteri_ad,borclu_cihazlar.borclu_id,borclu_cihazlar.borc_durum_guncelleme_tarihi,borclu_cihazlar.borclu_aciklama,borclu_cihazlar.borclu_seri_numarasi,borclu_cihazlar.borc_durum as cihaz_borc_uyarisi,musteriler.musteri_id,musteriler.musteri_kod,musteriler.musteri_iletisim_numarasi,
                    merkezler.merkez_adi,merkezler.merkez_adresi,merkezler.merkez_yetkili_id,  merkezler.merkez_id,
                              urunler.urun_adi, urunler.urun_slug,
                              siparis_urunleri.siparis_urun_id,
                              siparis_urunleri.seri_numarasi,
                              siparis_urunleri.garanti_baslangic_tarihi,
                              siparis_urunleri.garanti_bitis_tarihi,
                              sehirler.sehir_adi,
                              ilceler.ilce_adi")
                    ->order_by('borclu_cihazlar.borclu_id', 'DESC')
                    ->join("siparis_urunleri","borclu_cihazlar.borclu_seri_numarasi = siparis_urunleri.seri_numarasi","left")
                    
                    ->join("urunler","urunler.urun_id = siparis_urunleri.urun_no","left")
                    ->join("siparisler","siparis_urunleri.siparis_kodu = siparisler.siparis_id","left")
                    ->join("merkezler","siparisler.merkez_no = merkezler.merkez_id","left")
                    ->join("musteriler","merkezler.merkez_yetkili_id = musteriler.musteri_id","left")
                    ->join("sehirler","merkezler.merkez_il_id = sehirler.sehir_id","left")
                    ->join("ilceler","merkezler.merkez_ilce_id = ilceler.ilce_id","left")
                    
                    ->get("borclu_cihazlar");
      return $query->result();
    }








    public function insert($data){
		$this->db->insert('siparis_urunleri', $data);
         
	}











 public function get_report(){
    $query = $this->db->where("siparis_urun_aktif",1)->order_by("urunler.uretim_siralama","asc")
    ->select("urunler.urun_adi,urunler.urun_kod,count(*) as toplam")
    ->order_by('siparis_urun_id', 'ASC')
    ->join("urunler","urunler.urun_id = siparis_urunleri.urun_no")
    ->group_by("urunler.urun_adi")
    ->get("siparis_urunleri");

    return $query->result();
	}



 

  public function get_country_total_device($urun_id){
    $this->db->where(["siparis_aktif"=>1]);
    if($urun_id != 0){
      $this->db->where(["urunler.urun_id"=>$urun_id]);
    }
  
    $this->db->where(["sehirler.sehir_id !="=>82]);
    $query = $this->db
    ->select("count(*) as toplam")
    ->join("urunler","urunler.urun_id = siparis_urunleri.urun_no")
    ->join("siparisler","siparisler.siparis_id = siparis_urunleri.siparis_kodu")
    ->join("merkezler","merkezler.merkez_id = siparisler.merkez_no")
    ->join("sehirler","sehirler.sehir_id = merkezler.merkez_il_id","left")
    ->get("siparis_urunleri");

return $query->result();
	}



  public function get_country_device($urun_id,$sehir_id = 0){
    $this->db->where(["siparis_aktif"=>1]);
    if($urun_id != 0){
      $this->db->where(["urunler.urun_id"=>$urun_id]);
    }
    
    $this->db->where(["sehirler.sehir_id !="=>82]);
    if($sehir_id != 0){
      $this->db->where(["sehirler.sehir_id"=>$sehir_id]);
    }
    if($urun_id != 0){
      
    $query = $this->db
    ->select("sehirler.*,count(*) as toplam")
    ->order_by('toplam', 'desc')
    ->join("urunler","urunler.urun_id = siparis_urunleri.urun_no")
    ->join("siparisler","siparisler.siparis_id = siparis_urunleri.siparis_kodu")
    ->join("merkezler","merkezler.merkez_id = siparisler.merkez_no")
    ->join("sehirler","sehirler.sehir_id = merkezler.merkez_il_id","left")
    ->group_by("sehirler.sehir_adi,urunler.urun_adi")
    ->get("siparis_urunleri");
    
    }else{
      $query = $this->db
      ->select("sehirler.*,count(*) as toplam")
      ->order_by('toplam', 'desc')
      ->join("urunler","urunler.urun_id = siparis_urunleri.urun_no")
      ->join("siparisler","siparisler.siparis_id = siparis_urunleri.siparis_kodu")
      ->join("merkezler","merkezler.merkez_id = siparisler.merkez_no")
      ->join("sehirler","sehirler.sehir_id = merkezler.merkez_il_id","left")
      ->group_by("sehirler.sehir_adi")
      ->get("siparis_urunleri");
    }

return $query->result();
	}
  public function get_country_report(){
    $this->db->where(["siparis_aktif"=>1]);
    $this->db->where(["sehirler.sehir_id !="=>82]);
    $query = $this->db
    ->select("sehirler.*,urunler.urun_adi,urunler.urun_kod,count(*) as toplam")
    ->order_by('toplam', 'desc')
    ->join("urunler","urunler.urun_id = siparis_urunleri.urun_no")
    ->join("siparisler","siparisler.siparis_id = siparis_urunleri.siparis_kodu")
    ->join("merkezler","merkezler.merkez_id = siparisler.merkez_no")
    ->join("sehirler","sehirler.sehir_id = merkezler.merkez_il_id","left")
    ->group_by("sehirler.sehir_adi,urunler.urun_adi")
    ->get("siparis_urunleri");

return $query->result();
	}
  
  
  public function update($id,$data){
		$this->db->where('siparis_urun_id', $id);
		$this->db->update('siparis_urunleri', $data);
	}
}