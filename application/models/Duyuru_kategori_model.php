<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Duyuru_kategori_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
    public function get_by_id($id){
		$response = false;
		$query = $this->db->join('kullanicilar', 'kullanicilar.kullanici_id = duyuru_kategori_sorumlu_kullanici_id')->get_where("duyuru_kategorileri",array('duyuru_kategori_id' => $id));
		if($query && $query->num_rows()){
			$response = $query->result();
		}
		return $response;
    }
    
    public function delete($id){
      $this->db->delete('duyuru_kategorileri', array('duyuru_kategori_id' => $id));
          /* LOGDATA */
     log_data("Kayıt Silme","[".$id."] nolu [Duyuru Kategori] kaydı silindi.");
     /* LOGDATA */
    }
    public function get_all()
    {
      $query = $this->db->order_by('duyuru_kategori_id', 'ASC')->join('kullanicilar', 'kullanicilar.kullanici_id = duyuru_kategori_sorumlu_kullanici_id')->get("duyuru_kategorileri");
      return $query->result();
    }
    public function insert($data){
		$this->db->insert('duyuru_kategorileri', $data);
         
	}
  public function update($id,$data){
		$this->db->where('duyuru_kategori_id', $id);
		$this->db->update('duyuru_kategorileri', $data);
          /* LOGDATA */
          log_data("Kayıt Güncelleme","[".$id."] nolu [Duyuru Kategori] kaydı güncellendi.");
          /* LOGDATA */
	}
 
}