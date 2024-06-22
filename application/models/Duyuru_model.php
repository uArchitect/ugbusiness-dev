<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Duyuru_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
    public function get_by_id($id){
		$response = false;
		$query = $this->db->join('kullanicilar', 'kullanicilar.kullanici_id = duyuru_sorumlu_kullanici_id')->get_where("duyurular",array('duyuru_id' => $id));
		if($query && $query->num_rows()){
			$response = $query->result();
		}
		return $response;
    }
    
    public function delete($id){
      $this->db->delete('duyurular', array('duyuru_id' => $id));
      /* LOGDATA */
     log_data("Kayıt Silme","[".$id."] nolu [Duyuru] kaydı silindi.");
     /* LOGDATA */
    }
    public function get_all($order = 'duyuru_id',$type = 'ASC')
    {
      $query = $this->db->order_by($order,$type)
      ->join('kullanicilar', 'kullanicilar.kullanici_id = duyuru_sorumlu_kullanici_id')
      ->join('duyuru_kategorileri', 'duyuru_kategorileri.duyuru_kategori_id = kategori_id')
      ->get("duyurular");
      return $query->result();
    }
    public function insert($data){
		$this->db->insert('duyurular', $data);
        
	}
  public function update($id,$data){
		$this->db->where('duyuru_id', $id);
		$this->db->update('duyurular', $data);
    /* LOGDATA */
    log_data("Kayıt Güncelleme","[".$id."] nolu [Duyuru] kaydı güncellendi.");
    /* LOGDATA */
	}
}