<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Istek_birim_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
    public function get_by_id($id){
		$response = false;
		$query = $this->db->join('kullanicilar', 'kullanicilar.kullanici_id = birim_yetkili_kullanici_id')->get_where("istek_birimleri",array('istek_birim_id' => $id));
		if($query && $query->num_rows()){
			$response = $query->result();
		}
		return $response;
    }
    
    public function delete($id){
      $this->db->delete('istek_birimleri', array('istek_birim_id' => $id));
          /* LOGDATA */
     log_data("Kayıt Silme","[".$id."] nolu [İstek Birim] kaydı silindi.");
     /* LOGDATA */
    }
    public function get_all()
    {
      $query = $this->db->order_by('istek_birim_id', 'ASC')->join('kullanicilar', 'kullanicilar.kullanici_id = birim_yetkili_kullanici_id')->get("istek_birimleri");
      return $query->result();
    }
    public function insert($data){
		$this->db->insert('istek_birimleri', $data);
        
	}
  public function update($id,$data){
		$this->db->where('istek_birim_id', $id);
		$this->db->update('istek_birimleri', $data);
          /* LOGDATA */
          log_data("Kayıt Güncelleme","[".$id."] nolu [İstek Birim] kaydı güncellendi.");
          /* LOGDATA */
	}
}