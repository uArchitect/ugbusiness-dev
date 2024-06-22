<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Talep_kaynak_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
    public function get_by_id($id){
		$response = false;
		$query = $this->db->get_where("talep_kaynaklari",array('talep_kaynak_id' => $id));
		if($query && $query->num_rows()){
			$response = $query->result();
		}
		return $response;
    }
    
    public function delete($id){
      $this->db->delete('talep_kaynaklari', array('talep_kaynak_id' => $id));
    }
    public function get_all()
    {
      $query = $this->db->order_by('talep_kaynak_id', 'ASC')->get("talep_kaynaklari");
      return $query->result();
    }
    public function insert($data){
		$this->db->insert('talep_kaynaklari', $data);
         
	}
  public function update($id,$data){
		$this->db->where('talep_kaynak_id', $id);
		$this->db->update('talep_kaynaklari', $data);
	}
 
}