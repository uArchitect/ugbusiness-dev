<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Demirbas_birim_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
    public function get_by_id($id){
		$response = false;
		$query = $this->db->get_where("demirbas_birimleri",array('demirbas_birim_id' => $id));
		if($query && $query->num_rows()){
			$response = $query->result();
		}
		return $response;
    }
    
    public function delete($id){
      $this->db->delete('demirbas_birimleri', array('demirbas_birim_id' => $id));
      /* LOGDATA */
      log_data("Kayıt Silme","[$id] nolu [Demirbaş Birim] kaydı silindi.");
      /* LOGDATA */
    }
    public function get_all()
    {
      $query = $this->db->order_by('demirbas_birim_id', 'ASC')->get("demirbas_birimleri");
      return $query->result();
    }
    public function insert($data){
		$this->db->insert('demirbas_birimleri', $data);
           
	}
  public function update($id,$data){
		$this->db->where('demirbas_birim_id', $id);
		$this->db->update('demirbas_birimleri', $data);

      /* LOGDATA */
      log_data("Kayıt Güncelleme","[".$id."] nolu [Demirbaş Birim] kaydı güncellendi.");
      /* LOGDATA */
	}
}