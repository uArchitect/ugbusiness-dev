<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Yemek_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
    public function get_by_id($id){
		$response = false;
		$query = $this->db->get_where("yemekler",array('yemek_id' => $id));
		if($query && $query->num_rows()){
			$response = $query->result();
		}
		return $response;
    }
 
    public function get_all()
    {
      $query = $this->db->order_by('yemek_id', 'ASC')->get("yemekler");
      return $query->result();
    }
 
  public function update($id,$data){
		$this->db->where('yemek_id', $id);
		$this->db->update('yemekler', $data);
          /* LOGDATA */
          log_data("Kayıt Güncelleme","[".$id."] nolu [Yemek] kaydı güncellendi.");
          /* LOGDATA */
	}
}