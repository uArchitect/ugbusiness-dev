<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kullanici_yetki_grup_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 

    public function get_by_id($id){
      $response = false;
      $query = $this->db->join('kullanicilar', 'kullanicilar.kullanici_id = kullanici_yetki_grup_sorumlu_kullanici_id')->get_where("kullanici_yetki_gruplari",array('kullanici_yetki_grup_id' => $id));
      if($query && $query->num_rows()){
        $response = $query->result();
      }
		  return $response;
    }
      public function delete($id){
      $this->db->delete($this->$table_name, array('id' => $id));
          /* LOGDATA */
     log_data("Kayıt Silme","[".$id."] nolu [Kullanıcı Yetki Grup] kaydı silindi.");
     /* LOGDATA */
    }
    public function get_all()
    {
            $query = $this->db->order_by('kullanici_yetki_grup_id', 'ASC')->join('kullanicilar', 'kullanicilar.kullanici_id = kullanici_yetki_grup_sorumlu_kullanici_id')->get("kullanici_yetki_gruplari");
            return $query->result();
    }
    public function insert($data){
		$this->db->insert('kullanici_yetki_gruplari', $data);
        
	}
  public function update($id,$data){
		$this->db->where('kullanici_yetki_grup_id', $id);
		$this->db->update('kullanici_yetki_gruplari', $data);
          /* LOGDATA */
          log_data("Kayıt Güncelleme","[".$id."] nolu [Kullanıcı Yetki Grup] kaydı güncellendi.");
          /* LOGDATA */
	}
}