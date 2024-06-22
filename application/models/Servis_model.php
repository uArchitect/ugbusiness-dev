<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servis_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
    public function get_all($where=null)
    {
      if($where!=null){
        $this->db->where($where);
      }
      $query = $this->db
      ->select("servisler.*,kullanicilar.kullanici_ad_soyad,   borclu_cihazlar.borc_durum as cihaz_borc_uyarisi,siparis_urunleri.siparis_urun_id,urunler.urun_adi,servis_durum_kategorileri.servis_durum_kategori_adi,sehirler.sehir_adi,ilceler.ilce_adi,siparis_urunleri.seri_numarasi,siparis_urunleri.garanti_baslangic_tarihi,siparis_urunleri.garanti_bitis_tarihi,merkezler.*,musteriler.musteri_ad,musteriler.musteri_iletisim_numarasi,musteriler.yetkili_adi_2,musteriler.yetkili_iletisim_2,musteriler.musteri_id")
      ->from('servisler')
      ->join('siparis_urunleri', 'siparis_urunleri.siparis_urun_id = servisler.servis_cihaz_id')
      ->join('urunler', 'urunler.urun_id = siparis_urunleri.urun_no')
      ->join('siparisler', 'siparisler.siparis_id = siparis_urunleri.siparis_kodu')
      ->join('merkezler', 'merkezler.merkez_id = siparisler.merkez_no')
      ->join('musteriler', 'musteriler.musteri_id = merkezler.merkez_yetkili_id')
      ->join('servis_durum_kategorileri', 'servis_durum_kategorileri.servis_durum_kategori_id = servisler.servis_durum_tanim_id')
      ->join('sehirler', 'sehirler.sehir_id = merkezler.merkez_il_id')
      ->join('ilceler', 'ilceler.ilce_id = merkezler.merkez_ilce_id')
      ->join('kullanicilar', 'kullanicilar.kullanici_id = servisler.servis_kayit_olusturan_kullanici_id')
      ->join("borclu_cihazlar","borclu_cihazlar.borclu_seri_numarasi = siparis_urunleri.seri_numarasi","left")
                 
      
      ->order_by('servis_kayit_tarihi', 'DESC')
      ->get();
      return $query->result();
    }
    public function get_servis_bildirimleri($where=null)
    {
      if($where!=null){
        $this->db->where($where);
      }
      $query = $this->db
      ->select("servis_bildirimleri.*,servisler.*,servis_sorun_kategorileri.*")
      ->from('servis_bildirimleri')
      ->join('servisler', 'servisler.servis_id = servis_bildirimleri.servis_tanim_id')
      
      ->join('servis_sorun_kategorileri', 'servis_sorun_kategorileri.servis_sorun_kategori_id = servis_bildirimleri.servis_bildirim_kategori_id')
      ->order_by('servis_bildirim_id ', 'ASC')
      ->get();
      return $query->result();
    }

    
    public function get_servis_islemleri($where=null)
    {
      if($where!=null){
        $this->db->where($where);
      }
      $query = $this->db
      ->select("servis_islemleri.*,servis_islem_kategorileri.*,kullanicilar.kullanici_ad_soyad")
      ->from('servis_islemleri')
      ->join('kullanicilar', 'kullanicilar.kullanici_id = servis_islemleri.servis_islem_kullanici_id')
      ->join('servis_islem_kategorileri', 'servis_islem_kategorileri.servis_islem_kategori_id = servis_islemleri.servis_islem_tanim_id')
      ->order_by('servis_islem_id', 'ASC')
      ->get();
      return $query->result();
    }




    public function get_servis_gorevleri($where=null)
    {
      if($where!=null){
        $this->db->where($where);
      }
      $query = $this->db
      ->select("servis_gorevleri.*,kullanicilar.kullanici_ad_soyad")
      ->from('servis_gorevleri')
      ->join('kullanicilar', 'kullanicilar.kullanici_id = servis_gorevleri.servis_gorev_kullanici_id')
      ->order_by('servis_gorev_id', 'ASC')
      ->get();
      return $query->result();
    }

    
    public function get_servis_bildirim_kategorileri()
    {
      $query = $this->db
      ->select("*")
      ->from('servis_bildirim_kategorileri')
      ->order_by('servis_bildirim_kategori_id', 'ASC')
      ->get();
      return $query->result();
    }


    public function get_servis_tipleri()
    {
      $query = $this->db
      ->select("*")
      ->from('servis_tipleri')
      ->order_by('servis_tip_id', 'ASC')
      ->get();
      return $query->result();
    }
    public function get_servis_odeme_durumlari()
    {
      $query = $this->db
      ->select("*")
      ->from('servis_odeme_durumlari')
      ->order_by('servis_odeme_durum_id', 'ASC')
      ->get();
      return $query->result();
    }

    public function get_servis_sorun_kategorileri()
    {
      $query = $this->db
      ->select("*")
      ->from('servis_sorun_kategorileri')
      ->order_by('servis_sorun_kategori_id', 'ASC')
      ->get();
      return $query->result();
    }
    public function get_servis_islem_kategorileri()
    {
      $query = $this->db
      ->select("*")
      ->from('servis_islem_kategorileri')
      ->order_by('servis_islem_kategori_id', 'ASC')
      ->get();
      return $query->result();
    }
    public function get_atis_yuklemeleri($where = null)
    {
      if($where!=null){
        $this->db->where($where);
      }

      $query = $this->db
      ->select("*")
      ->from('servis_atis_yuklemeleri')
      ->join("servis_atis_kategorileri","servis_atis_kategorileri.servis_atis_kategori_id = servis_atis_yuklemeleri.servis_atis_kategori_no")
     
      ->join("siparis_urunleri","servis_atis_yuklemeleri.servis_atis_siparis_urun_id = siparis_urunleri.siparis_urun_id")
      ->join("urunler","urunler.urun_id = siparis_urunleri.urun_no")
      ->join("siparisler","siparis_urunleri.siparis_kodu = siparisler.siparis_id")
      ->join("merkezler","siparisler.merkez_no = merkezler.merkez_id")
      ->join("musteriler","merkezler.merkez_yetkili_id = musteriler.musteri_id")
      ->order_by('servis_atis_yukleme_id', 'DESC')
      ->get();
      return $query->result();
    }


    public function get_atis_yuklemesayisi($where = null)
    {
      if($where!=null){
        $this->db->where($where);
      }

      $this->db->select_sum('atis_yukleme_sayisi');
      $query = $this->db->get('servis_atis_yuklemeleri');
      return $query->row()->atis_yukleme_sayisi;
    }



  public function insert($data){ 
    $this->db->insert('servisler', $data);
    $inserted_id = $this->db->insert_id();  
    $servisdata['servis_kod']   = "SRV".str_pad($inserted_id,5,"0",STR_PAD_LEFT);
    $this->db->where('servis_id', $inserted_id );
		$this->db->update('servisler', $servisdata);
    return $inserted_id;
	}
  public function update($id,$data){
		$this->db->where('servis_id', $id);
		$this->db->update('servisler', $data);
	}
}