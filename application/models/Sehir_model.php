<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sehir_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
    public function get_by_id($id){
		$response = false;
		$query = $this->db->get_where("sehirler",array('sehir_id' => $id));
		if($query && $query->num_rows()){
			$response = $query->result();
		}
		return $response;
    }
    
    public function delete($id){
      $this->db->delete('sehirler', array('sehir_id' => $id));
          /* LOGDATA */
     log_data("Kayıt Silme","[".$id."] nolu [Şehir] kaydı silindi.");
     /* LOGDATA */
    }
    public function get_all($where = null)
    {
      if($where != null){
      $this->db->where($where);
    }
      $query = $this->db->order_by('sehir_id', 'ASC')->get("sehirler");
      return $query->result();
    }
    public function get_all_ulkeler()
    {
      $query = $this->db->order_by('ulke_id', 'ASC')->get("ulkeler");
      return $query->result();
    }
    public function insert($data){
		$this->db->insert('sehirler', $data);
	}
  public function update($id,$data){
		$this->db->where('sehir_id', $id);
		$this->db->update('sehirler', $data);
          /* LOGDATA */
          log_data("Kayıt Güncelleme","[".$id."] nolu [Şehir] kaydı güncellendi.");
          /* LOGDATA */
	}
}