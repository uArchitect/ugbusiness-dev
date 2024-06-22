<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bordro_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
    public function get_by_id($id){
		$response = false;
		$query = $this->db->get_where("bordrolar",array('bordro_id' => $id));
		if($query && $query->num_rows()){
			$response = $query->result();
		}
		return $response;
    }
    
    public function delete($id){
      $this->db->delete('bordrolar', array('bordro_id' => $id));
    }
    public function get_all($where = null)
    {
      if($where != null){
        $this->db->where($where);
      }
      $query = $this->db->order_by('bordro_id', 'ASC')
      ->join('kullanicilar', 'kullanicilar.kullanici_id = bordro_kullanici_id')
      ->join('departmanlar', 'departmanlar.departman_id = kullanici_departman_id')
      ->get("bordrolar");
      return $query->result();
    }


    public function get_actions($where = null)
    {
      if($where != null){
        $this->db->where($where);
      }
      $query = $this->db->order_by('bordro_goruntuleme_id', 'ASC')
      ->join('kullanicilar', 'kullanicilar.kullanici_id = goruntuleyen_kullanici_id')
      ->join('departmanlar', 'departmanlar.departman_id = kullanici_departman_id')
      ->get("bordro_goruntulemeleri");
      return $query->result();
    }


    public function insert($data){
		$this->db->insert('bordrolar', $data);
         
	}
  public function update($id,$data){
		$this->db->where('bordro_id', $id);
		$this->db->update('bordrolar', $data);
 
	}
}