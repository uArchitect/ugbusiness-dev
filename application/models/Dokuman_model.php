<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokuman_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
    public function get_by_id($id){
		$response = false;
		$query = $this->db->join('kullanicilar', 'kullanicilar.kullanici_id = dokuman_sorumlu_kullanici_id')->get_where("dokumanlar",array('dokuman_id' => $id));
		if($query && $query->num_rows()){
			$response = $query->result();
		}
		return $response;
    }
    
    public function delete($id){
      $this->db->delete('dokumanlar', array('dokuman_id' => $id));
                 /* LOGDATA */
     log_data("Kayıt Silme","[".$id."] nolu [Döküman] kaydı silindi.");
     /* LOGDATA */
    }
    public function get_all($where = null)
    {
      if($where != null){
        $query = $this->db->order_by('dokuman_id', 'ASC')->where($where)->join('kullanicilar', 'kullanicilar.kullanici_id = dokuman_sorumlu_kullanici_id')->get("dokumanlar");
     
      }else{
        $query = $this->db->order_by('dokuman_id', 'ASC')->join('kullanicilar', 'kullanicilar.kullanici_id = dokuman_sorumlu_kullanici_id')->get("dokumanlar");
     
      }
      return $query->result();
    }
    public function insert($data){
		$this->db->insert('dokumanlar', $data);
        
	}
  public function update($id,$data){
		$this->db->where('dokuman_id', $id);
		$this->db->update('dokumanlar', $data);

          /* LOGDATA */
          log_data("Kayıt Güncelleme","[".$id."] nolu [Döküman] kaydı güncellendi.");
          /* LOGDATA */
	}
}