<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokuman_kategori_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
    public function get_by_id($id){
		$response = false;
		$query = $this->db->join('kullanicilar', 'kullanicilar.kullanici_id = dokuman_kategori_sorumlu_kullanici_id')->get_where("dokuman_kategorileri",array('dokuman_kategori_id' => $id));
		if($query && $query->num_rows()){
			$response = $query->result();
		}
		return $response;
    }
    
    public function delete($id){
      $this->db->delete('dokuman_kategorileri', array('dokuman_kategori_id' => $id));
          /* LOGDATA */
     log_data("Kayıt Silme","[".$id."] nolu [Döküman Kategori] kaydı silindi.");
     /* LOGDATA */
    }
    public function get_all()
    {
      $query = $this->db->order_by('dokuman_kategori_id', 'ASC')->join('kullanicilar', 'kullanicilar.kullanici_id = dokuman_kategori_sorumlu_kullanici_id')->get("dokuman_kategorileri");
      return $query->result();
    }
    public function insert($data){
		$this->db->insert('dokuman_kategorileri', $data);
         
	}
  public function update($id,$data){
		$this->db->where('dokuman_kategori_id', $id);
		$this->db->update('dokuman_kategorileri', $data);

          /* LOGDATA */
          log_data("Kayıt Güncelleme","[".$id."] nolu [Döküman Kategori] kaydı güncellendi.");
          /* LOGDATA */
	}




    // Ana kategorileri getirir
    public function anaKategorileriGetir() {
      $query = $this->db->get_where('dokuman_kategorileri', array('dokuman_kategori_ust_kategori_id' => 1));
      return $query->result();
  }

  // Belirli bir üst kategoriye ait alt kategorileri getirir
  public function altKategorileriGetir($ustKategoriID) {
      $query = $this->db->get_where('dokuman_kategorileri', array('dokuman_kategori_ust_kategori_id' => $ustKategoriID));
      return $query->result();
  }
}