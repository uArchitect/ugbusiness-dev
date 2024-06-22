<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Talep_sonuc_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
    public function get_by_id($id){
		$response = false;
		$query = $this->db->get_where("talep_sonuclar",array('talep_sonuc_id' => $id));
		if($query && $query->num_rows()){
			$response = $query->result();
		}
		return $response;
    }
    
    public function delete($id){
      $this->db->delete('talep_sonuclar', array('talep_sonuc_id' => $id));
    }
    public function get_all()
    {
      $query = $this->db->order_by('talep_sonuc_id', 'ASC')->get("talep_sonuclar");
      return $query->result();
    }
    public function insert($data){
		$this->db->insert('talep_sonuclar', $data);
         
	}
  public function update($id,$data){
		$this->db->where('talep_sonuc_id', $id);
		$this->db->update('talep_sonuclar', $data);
	}
 
}