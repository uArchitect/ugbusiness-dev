<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Istek_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
    public function get_by_id($id){
		$response = false;
		$query = $this->db->join('kullanicilar', 'kullanicilar.kullanici_id = istek_sorumlu_kullanici_id')
    ->join('departmanlar', 'departmanlar.departman_id = kullanicilar.kullanici_departman_id')
    ->join('istek_birimleri', 'istek_birimleri.istek_birim_id = istek_birim_no')
    ->join('istek_kategorileri', 'istek_kategorileri.istek_kategori_id = istek_kategori_no')
    ->join('is_tipleri', 'is_tipleri.is_tip_id = is_tip_no')
    ->get_where("istekler",array('istek_id' => $id));
		if($query && $query->num_rows()){
			$response = $query->result();
		}
		return $response;
    }
    
    public function delete($id){
      $this->db->delete('istekler', array('istek_id' => $id));
          
    }
    public function get_all($where = null,$where2 = null,$where3 = null)
    {
      if($where != null){
        $this->db->where($where);
        if($where2 != null){
          $this->db->or_where($where2);
          if($where3 != null){
            $this->db->or_where($where3);
          }
        }
      }
    
      $query = $this->db
      ->select("kullanicilar.kullanici_ad_soyad,ykullanicilar.kullanici_ad_soyad as gonderilen_kullanici,istekler.*,istek_durumlari.*,istek_birimleri.*,istek_kategorileri.*,is_tipleri.*")
      ->order_by('istek_id', 'DESC')
      ->join('kullanicilar', 'kullanicilar.kullanici_id = istek_sorumlu_kullanici_id')
      ->join('kullanicilar as ykullanicilar', 'ykullanicilar.kullanici_id = istek_yonetici_id')
      ->join('istek_durumlari', 'istek_durumlari.istek_durum_id = istek_durum_no')
      ->join('istek_birimleri', 'istek_birimleri.istek_birim_id = istek_birim_no')
      ->join('istek_kategorileri', 'istek_kategorileri.istek_kategori_id = istek_kategori_no')
      ->join('is_tipleri', 'is_tipleri.is_tip_id = is_tip_no')
      ->get("istekler");
      return $query->result();
    }
    public function insert($data){
		$this->db->insert('istekler', $data);
	}
  public function update($id,$data){
		$this->db->where('istek_id', $id);
		$this->db->update('istekler', $data);
	}
}