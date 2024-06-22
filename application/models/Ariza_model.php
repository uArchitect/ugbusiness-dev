<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ariza_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
    public function get_by_id($id){
		$response = false;
		$query = $this->db->get_where("urun_baslik_arizalar",array('urun_baslik_ariza_id' => $id));
		if($query && $query->num_rows()){
			$response = $query->result();
		}
		return $response;
    }
    
    public function delete($id){
      $this->db->delete('urun_baslik_arizalar', array('urun_baslik_ariza_id' => $id));
                
    }
    public function get_all()
    {
      $query = $this->db->order_by('urun_baslik_ariza_id', 'ASC')
      ->join('urun_basliklari', 'urun_basliklari.baslik_id = urun_baslik_tanim_no')
      ->get("urun_baslik_arizalar");
      return $query->result();
    }
    public function insert($data){
		$this->db->insert('urun_baslik_arizalar', $data);
         
	}
  public function update($id,$data){
		$this->db->where('urun_baslik_ariza_id', $id);
		$this->db->update('urun_baslik_arizalar', $data);
          
	}
}