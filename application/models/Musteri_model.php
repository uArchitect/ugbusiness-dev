<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Musteri_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
    public function get_by_id($id){
		$response = false;
		$query = $this->db->join('kullanicilar', 'kullanicilar.kullanici_id = musteri_sorumlu_kullanici_id')->get_where("musteriler",array('musteri_id' => $id));
		if($query && $query->num_rows()){
			$response = $query->result();
		}
		return $response;
    }
    
    public function delete($id){
      $this->db->delete('musteriler', array('musteri_id' => $id));
 
    }
    public function get_all($where = null)
    {
      
          if($where != null){
            $this->db->where($where);
          }

      $this->db->select('musteriler.*, merkezler.*,sehirler.*,ilceler.*');
      $this->db->from('musteriler');
      $this->db->join('(SELECT * FROM merkezler ORDER BY merkez_id DESC) as merkezler', 'merkezler.merkez_yetkili_id = musteri_id', 'left');
      $this->db->join('sehirler', 'sehirler.sehir_id = merkez_il_id','left');
      $this->db->join('ilceler', 'ilceler.ilce_id = merkez_ilce_id','left');
      $this->db->order_by('musteri_id', 'DESC');
      $this->db->group_by('musteriler.musteri_id');
      $query = $this->db->get();
      return $query->result();
 
    }
    public function pre_up($str){
      $str = str_replace('i', 'İ', $str);
      $str = str_replace('ı', 'I', $str);
      return $str;
  }
    public function insert($data){
      
 		$this->db->insert('musteriler', $data);
 
   
	}
  public function update($id,$data){
    
		$this->db->where('musteri_id', $id);
		$this->db->update('musteriler', $data);

             
	}
}