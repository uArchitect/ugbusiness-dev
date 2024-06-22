<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ilce_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
    public function get_by_id($id){
		$response = false;
		$query = $this->db->get_where("ilceler",array('ilce_id' => $id));
		if($query && $query->num_rows()){
			$response = $query->result();
		}
		return $response;
    }
    
    public function delete($id){
      $this->db->delete('ilceler', array('ilce_id' => $id));
          /* LOGDATA */
     log_data("Kayıt Silme","[".$id."] nolu [İlçe] kaydı silindi.");
     /* LOGDATA */
    }
    public function get_all($where = null)
    {
      if($where != null){
        $this->db->where($where);
      }
      $query = $this->db->order_by('ilce_id', 'ASC')->join('sehirler', 'ilceler.sehir_id = sehirler.sehir_id')->get("ilceler");
      return $query->result();
    }
    public function insert($data){
		$this->db->insert('ilceler', $data);
          
	}
  public function update($id,$data){
		$this->db->where('ilce_id', $id);
		$this->db->update('ilceler', $data);
          /* LOGDATA */
          log_data("Kayıt Güncelleme","[".$id."] nolu [İlçe] kaydı güncellendi.");
          /* LOGDATA */
	}
}