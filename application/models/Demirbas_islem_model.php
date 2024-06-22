<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Demirbas_islem_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
    public function get_by_id($id){
		$response = false;
		$query = $this->db->join('kullanicilar', 'kullanicilar.kullanici_id = islem_sorumlu_kullanici_id')->get_where("demirbas_islemleri",array('islem_id' => $id));
		if($query && $query->num_rows()){
			$response = $query->result();
		}
		return $response;
    }
    
    public function delete($id){
      $this->db->delete('demirbas_islemleri', array('islem_id' => $id));
            /* LOGDATA */
            log_data("Kayıt Silme","[".$id."] nolu [Demirbaş İşlem] kaydı silindi.");
            /* LOGDATA */
    }
    public function get_all($where = null)
    {
      if($where != null){
        $this->db->where($where);
      } 
      $query = $this->db->order_by('islem_id', 'ASC')
      ->join('kullanicilar', 'kullanicilar.kullanici_id = islem_sorumlu_kullanici_id') 
      ->get("demirbas_islemleri");
      return $query->result();
    }
    public function insert($data){
		$this->db->insert('demirbas_islemleri', $data);
        
	}
  public function update($id,$data){
		$this->db->where('islem_id', $id);
		$this->db->update('demirbas_islemleri', $data);
          /* LOGDATA */
          log_data("Kayıt Güncelleme","[".$id."] nolu [Demirbaş İşlem] kaydı güncellendi.");
          /* LOGDATA */
	}
}