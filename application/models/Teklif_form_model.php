<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teklif_form_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
    
    public function get_all($where = null)
    {
      if($where != null){
          $this->db->where($where);
      }
      $query = $this->db
      ->order_by('teklif_form_id', 'ASC')
      ->join('kullanicilar', 'kullanicilar.kullanici_id = teklif_formlari.teklif_form_kullanici_id')
      ->get("teklif_formlari");
      return $query->result();
    }
    public function insert($data){
		$this->db->insert('teklif_formlari', $data);
         
	}
  public function update($id,$data){
		$this->db->where('teklif_form_id', $id);
		$this->db->update('teklif_formlari', $data);
	}
}