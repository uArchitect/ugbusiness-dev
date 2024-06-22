<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kullanici_grup_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
    public function get_by_id($id){
		$response = false;
		$query = $this->db->join('kullanicilar', 'kullanicilar.kullanici_id = kullanici_grup_sorumlu_kullanici_id')->get_where("kullanici_gruplari",array('kullanici_gruplari.kullanici_grup_id' => $id));
		if($query && $query->num_rows()){
			$response = $query->result();
		}
		return $response;
    }
    
    public function delete($id){
      $this->db->delete('kullanici_gruplari', array('kullanici_grup_id' => $id));
          /* LOGDATA */
     log_data("Kayıt Silme","[".$id."] nolu [Kullanici Grup] kaydı silindi.");
     /* LOGDATA */
    }
    public function get_all()
    {
      $query = $this->db->order_by('kullanici_grup_id', 'ASC')->join('kullanicilar', 'kullanicilar.kullanici_id = kullanici_grup_sorumlu_kullanici_id')->get("kullanici_gruplari");
      return $query->result();
    }
    public function insert($data){
      $this->db->insert('kullanici_gruplari', $data);
	}
  public function update($id,$data){
		$this->db->where('kullanici_grup_id', $id);
		$this->db->update('kullanici_gruplari', $data);
    /* LOGDATA */
    log_data("Kayıt Güncelleme","[".$id."] nolu [Kullanıcı Grup] kaydı güncellendi.");
    /* LOGDATA */
	}
}