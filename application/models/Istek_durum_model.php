<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Istek_durum_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
    public function get_by_id($id){
		$response = false;
		$query = $this->db->join('kullanicilar', 'kullanicilar.kullanici_id = istek_durum_sorumlu_kullanici_id')->get_where("istek_durumlari",array('istek_durum_id' => $id));
		if($query && $query->num_rows()){
			$response = $query->result();
		}
		return $response;
    }
    
    public function delete($id){
      $this->db->delete('istek_durumlari', array('istek_durum_id' => $id));
          /* LOGDATA */
     log_data("Kayıt Silme","[".$id."] nolu [İstek Durum] kaydı silindi.");
     /* LOGDATA */
    }
    public function get_all()
    {
      $query = $this->db->order_by('istek_durum_id', 'ASC')->join('kullanicilar', 'kullanicilar.kullanici_id = istek_durum_sorumlu_kullanici_id')->get("istek_durumlari");
      return $query->result();
    }
    public function insert($data){
		$this->db->insert('istek_durumlari', $data);
        
	}
  public function update($id,$data){
		$this->db->where('istek_durum_id', $id);
		$this->db->update('istek_durumlari', $data);
          /* LOGDATA */
          log_data("Kayıt Güncelleme","[".$id."] nolu [İstek Durum] kaydı güncellendi.");
          /* LOGDATA */
	}
}