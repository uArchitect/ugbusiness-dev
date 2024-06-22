<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Is_tip_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
    public function get_by_id($id){
		$response = false;
		$query = $this->db->join('kullanicilar', 'kullanicilar.kullanici_id = is_tip_sorumlu_kullanici_id')->get_where("is_tipleri",array('is_tip_id' => $id));
		if($query && $query->num_rows()){
			$response = $query->result();
		}
		return $response;
    }
    
    public function delete($id){
      $this->db->delete('is_tipleri', array('is_tip_id' => $id));
          /* LOGDATA */
     log_data("Kayıt Silme","[".$id."] nolu [İş Tip] kaydı silindi.");
     /* LOGDATA */
    }
    public function get_all($where = null)
    {
      if($where != null){
        $query = $this->db->order_by('is_tip_id', 'ASC')->where($where)->join('kullanicilar', 'kullanicilar.kullanici_id = is_tip_sorumlu_kullanici_id')->get("is_tipleri");
      }else{
        $query = $this->db->order_by('is_tip_id', 'ASC')->join('kullanicilar', 'kullanicilar.kullanici_id = is_tip_sorumlu_kullanici_id')->get("is_tipleri"); 
      }
      return $query->result();
    }
    public function insert($data){
		$this->db->insert('is_tipleri', $data);
        
	}
  public function update($id,$data){
		$this->db->where('is_tip_id', $id);
		$this->db->update('is_tipleri', $data);
          /* LOGDATA */
          log_data("Kayıt Güncelleme","[".$id."] nolu [İş Tip] kaydı güncellendi.");
          /* LOGDATA */
	}
}