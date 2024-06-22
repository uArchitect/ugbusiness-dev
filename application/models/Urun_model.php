<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Urun_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
    public function get_by_id($id){
		$response = false;
		$query = $this->db->join('kullanicilar', 'kullanicilar.kullanici_id = urun_sorumlu_kullanici_id')->get_where("urunler",array('urun_id' => $id));
		if($query && $query->num_rows()){
			$response = $query->result();
		}
		return $response;
    }
    
    public function delete($id){
      $this->db->delete('urunler', array('urun_id' => $id));
                 /* LOGDATA */
     log_data("Kayıt Silme","[".$id."] nolu [Ürün] kaydı silindi.");
     /* LOGDATA */
    }
    public function get_all($where = null)
    {
      if($where != null){
        $this->db->where($where);
     
      }
      $query = $this->db->order_by('urun_id', 'ASC')->join('kullanicilar', 'kullanicilar.kullanici_id = urun_sorumlu_kullanici_id')->get("urunler");
      return $query->result();
    }
    public function get_baslik_tanimlari($where = null)
    {
      if($where != null){
        $this->db->where($where);
      }
      $query = $this->db->order_by('urun_baslik_tanim_id', 'ASC')
                    ->join('urun_basliklari', 'urun_baslik_tanimlari.urun_baslik_no = urun_basliklari.baslik_id')  
                    ->get("urun_baslik_tanimlari");
      return $query->result();
    }

    public function get_basliklar()
    {
     
      $query = $this->db->order_by('baslik_id', 'ASC')  
                    ->get("urun_basliklari");
      return $query->result();
    }


    public function insert($data){
		$this->db->insert('urunler', $data);
	}
  public function update($id,$data){
		$this->db->where('urun_id', $id);
		$this->db->update('urunler', $data);
          /* LOGDATA */
          log_data("Kayıt Güncelleme","[".$id."] nolu [Ürün] kaydı güncellendi.");
          /* LOGDATA */
	}
}