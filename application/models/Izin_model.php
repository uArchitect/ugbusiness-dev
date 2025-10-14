<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Izin_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
    public function get_by_id($id){
		$response = false;
    $query = $this->db->order_by('izin_talep_id', 'ASC')
    ->join('kullanicilar', 'kullanicilar.kullanici_id = izin_talep_eden_kullanici_id')
    ->join('departmanlar', 'departmanlar.departman_id = kullanicilar.kullanici_departman_id')
    ->join('izin_nedenleri', 'izin_nedenleri.izin_neden_id = izin_neden_no')
    ->get_where("izin_talepleri",array('izin_talep_id' => $id));
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
    
      $query = $this->db->order_by('izin_talep_id', 'ASC')
      ->join('kullanicilar', 'kullanicilar.kullanici_id = izin_talep_eden_kullanici_id')
      ->join('departmanlar', 'departmanlar.departman_id = kullanicilar.kullanici_departman_id')
      ->join('izin_nedenleri', 'izin_nedenleri.izin_neden_id = izin_neden_no')
      ->order_by("izin_talep_id","desc")
      ->get("izin_talepleri");
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