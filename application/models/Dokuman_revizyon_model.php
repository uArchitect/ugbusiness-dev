<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokuman_revizyon_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
    public function get_by_id($id){
		$response = false;
		$query = $this->db->join('kullanicilar', 'kullanicilar.kullanici_id = revizyon_sorumlu_kullanici_id')->get_where("dokuman_revizyonlari",array('revizyon_id' => $id));
		if($query && $query->num_rows()){
			$response = $query->result();
		}
		return $response;
    }
    
    public function delete($id){
      $this->db->delete('dokuman_revizyonlari', array('revizyon_id' => $id));
          /* LOGDATA */
     log_data("Kayıt Silme","[".$id."] nolu [Döküman Revizyon] kaydı silindi.");
     /* LOGDATA */
    }
    public function get_all($where = null)
    {
      if($where != null){
        $query = $this->db->order_by('revizyon_id', 'ASC')->where($where)->join('kullanicilar', 'kullanicilar.kullanici_id = revizyon_sorumlu_kullanici_id')->get("dokuman_revizyonlari");
     
      }else{
        $query = $this->db->order_by('revizyon_id', 'ASC')->join('kullanicilar', 'kullanicilar.kullanici_id = revizyon_sorumlu_kullanici_id')->get("dokuman_revizyonlari");
     
      }
      return $query->result();
    }
    public function insert($data){
		$this->db->insert('dokuman_revizyonlari', $data);
        
	}
  public function update($id,$data){
		$this->db->where('revizyon_id', $id);
		$this->db->update('dokuman_revizyonlari', $data);

          /* LOGDATA */
          log_data("Kayıt Güncelleme","[".$id."] nolu [Döküman Revizyon] kaydı güncellendi.");
          /* LOGDATA */
	}
}