<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Istek_hareket_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
    public function get_all_by_ticket_id($id)
    {
      $query = $this
      ->db
      ->where(["istek_no"=>$id])
      ->order_by('istek_hareket_id', 'ASC')
      ->join('kullanicilar','kullanicilar.kullanici_id = istek_hareket_kullanici_id')
      ->join('departmanlar','departmanlar.departman_id = kullanicilar.kullanici_departman_id')
      ->get("istek_hareketleri");
      return $query->result();
    }
    public function insert($data){
     
      $this->db->insert('istek_hareketleri', $data);
         
    }
    public function update($id,$data){
      $this->db->where('istek_hareket_id', $id);
      $this->db->update('istek_hareketleri', $data);
            /* LOGDATA */
            log_data("Kayıt Güncelleme","[".$id."] nolu [İstek Hareket] kaydı güncellendi.");
            /* LOGDATA */
    }
}