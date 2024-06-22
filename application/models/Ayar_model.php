<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ayar_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
    public function get_by_id($id){
      $response = false;
      $query = $this->db->get_where("ayarlar",array('ayar_id' => $id));
      if($query && $query->num_rows()){
        $response = $query->result();
      }
		  return $response;
    }
    
    public function update($id,$data){
      $this->db->where('ayar_id', $id);
      $this->db->update('ayarlar', $data);

        /* LOGDATA */
        log_data("Kayıt Güncelleme","[$id] nolu [Ayar] kaydı güncellendi.");
        /* LOGDATA */
 
    }
}