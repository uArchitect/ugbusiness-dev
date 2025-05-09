<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Egitim_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
    public function get_by_id($id){
      $response = false;
      $query = $this->db->where(array('egitim_id' => $id))->order_by('egitim_id', 'ASC')->get("cihaz_egitimleri");
      if($query){
        $response = $query->result();
      }
      return $response;



      ;
      return $query->result();
    }
    public function delete($id){
      $this->db->delete('cihaz_egitimleri', array('egitim_id' => $id));    
    }
    public function get_all($where = null,$where2 = null)
    {
      if($where != null){
        $this->db->where($where);
        if($where2 != null){
          $this->db->where($where2);
          
        }
      }
      $query = $this->db->select("cihaz_egitimleri.*,sehirler.*,ilceler.*,urunler.*,siparis_urunleri.seri_numarasi,merkezler.*,siparisler.*,musteriler.*,kullanicilar.kullanici_id,kullanicilar.kullanici_ad_soyad")
      ->order_by('egitim_id', 'DESC')
      ->from('cihaz_egitimleri')
      ->join('siparis_urunleri', 'siparis_urunleri.siparis_urun_id = cihaz_egitimleri.siparis_urun_no','left')
      ->join('siparisler', 'siparis_urunleri.siparis_kodu = siparisler.siparis_id','left')
      ->join('urunler', 'siparis_urunleri.urun_no = urunler.urun_id','left')
      ->join('merkezler', 'merkezler.merkez_id = siparisler.merkez_no')
      ->join('sehirler', 'sehirler.sehir_id = merkez_il_id','left')
      ->join('ilceler', 'ilceler.ilce_id = merkez_ilce_id','left')
      ->join('kullanicilar', 'kullanicilar.kullanici_id = egitim_kayit_sorumlu_kullanici_id')
      ->join('musteriler', 'musteriler.musteri_id = merkezler.merkez_yetkili_id')->get()
      ;
      return $query->result();
    }
    public function insert($data){
		$this->db->insert('cihaz_egitimleri', $data);     
	}
  public function update($egitim_id,$data){
		$this->db->where('egitim_id', $egitim_id);
		$this->db->update('cihaz_egitimleri', $data);
	}
}