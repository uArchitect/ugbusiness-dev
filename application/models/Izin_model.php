<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Izin_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
    public function get_by_id($id){
		$response = false;
        $query = $this->db->select('izin_talepleri.*,
                                   kullanicilar.kullanici_ad_soyad,
                                   kullanicilar.kullanici_departman_id,
                                   departmanlar.departman_adi,
                                   izin_nedenleri.izin_neden_detay,
                                   amir_kullanici.kullanici_ad_soyad as amir_ad_soyad,
                                   amir_kullanici.kullanici_id as amir_kullanici_id,
                                   mudur_kullanici.kullanici_ad_soyad as mudur_ad_soyad,
                                   mudur_kullanici.kullanici_id as mudur_kullanici_id')
                         ->from('izin_talepleri')
                         ->join('kullanicilar', 'kullanicilar.kullanici_id = izin_talepleri.izin_talep_eden_kullanici_id')
                         ->join('departmanlar', 'departmanlar.departman_id = kullanicilar.kullanici_departman_id')
                         ->join('izin_nedenleri', 'izin_nedenleri.izin_neden_id = izin_talepleri.izin_neden_no')
                         ->join('kullanicilar as amir_kullanici', 'amir_kullanici.kullanici_id = izin_talepleri.amir_onay_kullanici_id', 'left')
                         ->join('kullanicilar as mudur_kullanici', 'mudur_kullanici.kullanici_id = izin_talepleri.mudur_onay_kullanici_id', 'left')
                         ->where('izin_talepleri.izin_talep_id', $id)
                         ->get();
		if($query && $query->num_rows()){
			$response = $query->result();
		}
		return $response;
    }
    
    public function delete($id){
      $this->db->delete('istekler', array('istek_id' => $id));
         
    }
    public function get_all($where = null,$where2 = null)
    {
      if($where != null){
        $this->db->where($where);
        if($where2 != null){
          $this->db->or_where($where2);
        }
      }
    
      $query = $this->db->select('izin_talepleri.*,
                                   kullanicilar.kullanici_ad_soyad,
                                   kullanicilar.kullanici_departman_id,
                                   departmanlar.departman_adi,
                                   izin_nedenleri.izin_neden_detay,
                                   amir_kullanici.kullanici_ad_soyad as amir_ad_soyad,
                                   amir_kullanici.kullanici_id as amir_kullanici_id,
                                   mudur_kullanici.kullanici_ad_soyad as mudur_ad_soyad,
                                   mudur_kullanici.kullanici_id as mudur_kullanici_id')
                        ->order_by('izin_talepleri.izin_talep_id', 'desc')
                        ->from('izin_talepleri')
                        ->join('kullanicilar', 'kullanicilar.kullanici_id = izin_talepleri.izin_talep_eden_kullanici_id')
                        ->join('departmanlar', 'departmanlar.departman_id = kullanicilar.kullanici_departman_id')
                        ->join('izin_nedenleri', 'izin_nedenleri.izin_neden_id = izin_talepleri.izin_neden_no')
                        ->join('kullanicilar as amir_kullanici', 'amir_kullanici.kullanici_id = izin_talepleri.amir_onay_kullanici_id', 'left')
                        ->join('kullanicilar as mudur_kullanici', 'mudur_kullanici.kullanici_id = izin_talepleri.mudur_onay_kullanici_id', 'left')
                        ->get();
      return $query->result();
    }
    public function insert($data){
		$this->db->insert('izin_talepleri', $data);
	}
  public function update($id,$data){
		$this->db->where('izin_talep_id', $id);
		$this->db->update('izin_talepleri', $data);
	}
}
