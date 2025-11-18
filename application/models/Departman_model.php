<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departman_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
    public function get_by_id($id){
		$response = false;
		$query = $this->db->join('kullanicilar', 'kullanicilar.kullanici_id = departman_sorumlu_kullanici_id')->get_where("departmanlar",array('departman_id' => $id));
		if($query && $query->num_rows()){
			$response = $query->result();
		}
		return $response;
    }
    
    public function delete($id){
      $this->db->delete('departmanlar', array('departman_id' => $id));
                 /* LOGDATA */
     log_data("Kayıt Silme","[".$id."] nolu [Departman] kaydı silindi.");
     /* LOGDATA */
    }
    public function get_all()
    {
      $query = $this->db->select('departmanlar.*, 
                                   yonetici.kullanici_ad_soyad as yonetici_ad_soyad,
                                   yonetici.kullanici_id as yonetici_id,
                                   yonetici.kullanici_resim as yonetici_resim,
                                   yonetici.kullanici_unvan as yonetici_unvan')
                         ->from('departmanlar')
                         ->join('kullanicilar as yonetici', 'yonetici.kullanici_id = departmanlar.departman_sorumlu_kullanici_id', 'left')
                         ->order_by('departmanlar.departman_id', 'ASC')
                         ->get();
      return $query->result();
    }
    public function insert($data){
		$this->db->insert('departmanlar', $data);
         
	}
  public function update($id,$data){
		$this->db->where('departman_id', $id);
		$this->db->update('departmanlar', $data);
          /* LOGDATA */
          log_data("Kayıt Güncelleme","[".$id."] nolu [Departman] kaydı güncellendi.");
          /* LOGDATA */
	}
}