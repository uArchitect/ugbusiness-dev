<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Demirbas_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
    public function get_by_id($id){
		$response = false;
		$query = $this->db->join('kullanicilar', 'kullanicilar.kullanici_id = demirbas_kullanici_id')->get_where("demirbaslar",array('demirbas_id' => $id));
		if($query && $query->num_rows()){
			$response = $query->result();
		}
		return $response;
    }
    
    public function delete($id){
      $this->db->delete('demirbaslar', array('demirbas_id' => $id));
    /* LOGDATA */
     log_data("Kayıt Silme","[".$id."] nolu [Demirbaş] kaydı silindi.");
     /* LOGDATA */
    }
    public function get_all($where = null)
    {

      if($where != null){
        $this->db->where($where);
      } 
      $query = $this->db->order_by('demirbas_id', 'ASC')
      ->join('kullanicilar', 'kullanicilar.kullanici_id = demirbas_kullanici_id')
      ->join('demirbas_kategorileri', 'demirbas_kategorileri.demirbas_kategori_id = kategori_id')
      ->get("demirbaslar");
      return $query->result();
    }
    public function insert($data){
		$this->db->insert('demirbaslar', $data);
        
	}
  public function update($id,$data){
		$this->db->where('demirbas_id', $id);
		$this->db->update('demirbaslar', $data);

	}
}