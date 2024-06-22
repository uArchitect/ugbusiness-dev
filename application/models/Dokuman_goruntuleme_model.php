<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokuman_goruntuleme_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 

    public function get_all($where = null)
    {
      if($where != null){
        $query = $this->db
                      ->order_by('dokuman_goruntuleme_id', 'ASC')
                      ->where($where)
                      ->join('dokumanlar', 'dokumanlar.dokuman_id = dokuman_no')
                      ->join('kullanicilar', 'kullanicilar.kullanici_id = kullanici_no')
                      ->get("dokuman_goruntulemeleri");
     
      }else{
        $query = $this->db
                      ->order_by('dokuman_goruntuleme_id', 'ASC')
                      ->join('dokumanlar', 'dokumanlar.dokuman_id = dokuman_no')
                      ->join('kullanicilar', 'kullanicilar.kullanici_id = kullanici_no')
                      ->get("dokuman_goruntulemeleri");
      }
      return $query->result();
    }
    public function insert($data){
      $this->db->insert('dokuman_goruntulemeleri', $data);
       
    }
 
}