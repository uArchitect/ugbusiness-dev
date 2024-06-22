<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Istek_kategori_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
    public function get_by_id($id){
		$response = false;
		$query = $this->db->join('kullanicilar', 'kullanicilar.kullanici_id = istek_kategori_sorumlu_kullanici_id')->get_where("istek_kategorileri",array('istek_kategori_id' => $id));
		if($query && $query->num_rows()){
			$response = $query->result();
		}
		return $response;
    }
    
    public function delete($id){
      $this->db->delete('istek_kategorileri', array('istek_kategori_id' => $id));
          /* LOGDATA */
     log_data("Kayıt Silme","[".$id."] nolu [İstek Kategori] kaydı silindi.");
     /* LOGDATA */
    }
    public function get_all($where = null)
    {
      if($where != null){
        $query = $this->db->where($where)->order_by('istek_kategori_id', 'ASC')->join('kullanicilar', 'kullanicilar.kullanici_id = istek_kategori_sorumlu_kullanici_id')->get("istek_kategorileri");
     
      }else{
        $query = $this->db->order_by('istek_kategori_id', 'ASC')->join('kullanicilar', 'kullanicilar.kullanici_id = istek_kategori_sorumlu_kullanici_id')->get("istek_kategorileri");
     
      }
      return $query->result();
    }
    public function insert($data){
		$this->db->insert('istek_kategorileri', $data);
       
	}
  public function update($id,$data){
		$this->db->where('istek_kategori_id', $id);
		$this->db->update('istek_kategorileri', $data);
          /* LOGDATA */
          log_data("Kayıt Güncelleme","[".$id."] nolu [İstek Kategori] kaydı güncellendi.");
          /* LOGDATA */
	}
}