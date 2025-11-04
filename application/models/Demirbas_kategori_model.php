<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Demirbas_kategori_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
    public function get_by_id($id){
		$response = false;
		$query = $this->db->join('kullanicilar', 'kullanicilar.kullanici_id = demirbas_kategori_sorumlu_kullanici_id')->get_where("demirbas_kategorileri",array('demirbas_kategori_id' => $id));
		if($query && $query->num_rows()){
			$response = $query->result();
		}
		return $response;
    }
    
    public function delete($id){
      $this->db->delete('demirbas_kategorileri', array('demirbas_kategori_id' => $id));
       /* LOGDATA */
       log_data("Kayıt Sil","[".$id."] nolu [Demirbaş Kategori] kaydı silindi.");
       /* LOGDATA */
    }
    public function get_all()
    {
      $query = $this->db->order_by('demirbas_kategori_id', 'ASC') ->get("demirbas_kategorileri");
      return $query->result();
    }
    public function insert($data){
		$this->db->insert('demirbas_kategorileri', $data);
      
	}
  public function update($id,$data){
		$this->db->where('demirbas_kategori_id', $id);
		$this->db->update('demirbas_kategorileri', $data);
     /* LOGDATA */
     log_data("Kayıt Güncelleme","[".$id."] nolu [Demirbaş Kategori] kaydı güncellendi.");
     /* LOGDATA */
	}



 
    public function anaKategorileriGetir() {
      $query = $this->db->get_where('demirbas_kategorileri', array('demirbas_kategori_ust_kategori_id' => 1));
      return $query->result();
  }
 
  public function altKategorileriGetir($ustKategoriID) {
      $query = $this->db->get_where('demirbas_kategorileri', array('demirbas_kategori_ust_kategori_id' => $ustKategoriID));
      return $query->result();
  }
}