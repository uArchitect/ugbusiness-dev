<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
    public function get_by_id($id){
		$response = false;
		$query = $this->db->join('kullanicilar', 'kullanicilar.kullanici_id = banner_sorumlu_kullanici_id')->get_where("bannerlar",array('banner_id' => $id));
		if($query && $query->num_rows()){
			$response = $query->result();
		}
		return $response;
    }
    
    public function delete($id){
      $this->db->delete('bannerlar', array('banner_id' => $id));
      
      /* LOGDATA */
        log_data("Kayıt Silme","[$id] nolu [Banner] kaydı silindi.");
      /* LOGDATA */
    }
    public function get_all()
    {
      $query = $this->db->order_by('banner_id', 'ASC')->join('kullanicilar', 'kullanicilar.kullanici_id = banner_sorumlu_kullanici_id')->get("bannerlar");
      return $query->result();
    }
    public function insert($data){
        
		$this->db->insert('bannerlar', $data);
 
   
	}
  public function update($id,$data){
		$this->db->where('banner_id', $id);
		$this->db->update('bannerlar', $data);

            /* LOGDATA */
            log_data("Kayıt Güncelleme","[$id] nolu [Banner] kaydı güncellendi.");
            /* LOGDATA */
	}
}