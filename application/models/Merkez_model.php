<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Merkez_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
    public function get_by_id($id){
        $response = false;
        $query = $this->db
        ->join('musteriler', 'musteriler.musteri_id = merkez_yetkili_id')
        ->join('sehirler', 'sehirler.sehir_id = merkez_il_id','left')
        ->join('ilceler', 'ilceler.ilce_id = merkez_ilce_id','left')
        ->order_by('merkez_id', 'ASC')
        ->get_where("merkezler",array('merkez_id' => $id))
        ;
		if($query && $query->num_rows()){
			$response = $query->result()[0];
		}
		return $response;
    }
    
    public function delete($id){
      $this->db->delete('merkezler', array('merkez_id' => $id));
 
    }
    public function get_all($where = null,$orwhere = null)
    {
      if($where != null){
        $this->db->where($where);
        if($orwhere != null){
          $this->db->or_where($orwhere);
        }
      }
      $query = $this->db
      ->join('musteriler', 'musteriler.musteri_id = merkez_yetkili_id')
       ->join('sehirler', 'sehirler.sehir_id = merkez_il_id','left')
       ->join('ilceler', 'ilceler.ilce_id = merkez_ilce_id','left')
      ->order_by('merkez_id', 'ASC')->get("merkezler");
      return $query->result();
    }

    
    public function insert($data){
           
          $this->db->insert('merkezler', $data);
        }
  public function update($id,$data){
     
		$this->db->where('merkez_id', $id);
		$this->db->update('merkezler', $data);
	}
}