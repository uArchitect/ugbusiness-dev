<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kullanici_yetkileri_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
 
    public function get_permissions_by_user_id(){
      $response = false;
      $current_user_id =  $this->session->userdata('aktif_kullanici_id');
     
      $query = $this->db->select("yetki_kodu")->get_where("kullanici_yetki_tanimlari",array('kullanici_id' => $current_user_id));
      if($query && $query->num_rows()){
        $response = $query->result();
      }
		  return $response;
    }




    public function check_permission($yetki_kodu){
      $response = false;
      $current_user_id =  $this->session->userdata('aktif_kullanici_id');
      
      // Kullanıcı ID 7 veya admin grubundaki kullanıcılar için özel kontrol
      if ($current_user_id == 7) {
        return true; // Kullanıcı ID 7 her zaman yetkili
      }
      
      // Admin grubu kontrolü
      $kullanici = $this->db->select('kullanici_gruplari.kullanici_grup_adi')
                            ->from('kullanicilar')
                            ->join('kullanici_gruplari', 'kullanici_gruplari.kullanici_grup_id = kullanicilar.kullanici_grup_no', 'left')
                            ->where('kullanicilar.kullanici_id', $current_user_id)
                            ->get()
                            ->row();
      
      if ($kullanici && !empty($kullanici->kullanici_grup_adi)) {
        $grup_adi = mb_strtolower(trim($kullanici->kullanici_grup_adi), 'UTF-8');
        if ($grup_adi == 'admin' || $grup_adi == 'administrator' || $grup_adi == 'yönetici') {
          return true; // Admin grubundaki kullanıcılar her zaman yetkili
        }
      }
     
      // Normal yetki kontrolü
      $query = $this->db->get_where("kullanici_yetki_tanimlari",array('kullanici_id' => $current_user_id,'yetki_kodu' => $yetki_kodu));
      if($query && $query->num_rows()){
        $response = true;
      }
		  return $response;
    }

    public function get_by_user_id($id){
      $response = false;
      $query = $this->db->select('yetki_kodu')->get_where('kullanici_yetki_tanimlari', array('kullanici_id' => $id));

      if($query && $query->num_rows()){
        $response = $query->result();
      }
		  return $response;
    }
    public function get_by_id($id){
      $response = false;
      $query = $this->db->join('kullanicilar', 'kullanicilar.kullanici_id = kullanici_yetki_sorumlu_kullanici_id')->get_where("kullanici_yetkileri",array('kullanici_yetki_id' => $id));
      if($query && $query->num_rows()){
        $response = $query->result();
      }
		  return $response;
    }
      public function delete($id){
      $this->db->delete("kullanici_yetkileri", array('kullanici_yetki_id' => $id));

          /* LOGDATA */
     log_data("Kayıt Silme","[".$id."] nolu [Kullanıcı Yetki] kaydı silindi.");
     /* LOGDATA */
    }
    public function get_all()
    {
            $query = $this->db
            ->order_by("kullanici_yetki_id asc")
            ->join('kullanicilar', 'kullanicilar.kullanici_id = kullanici_yetki_sorumlu_kullanici_id')
            ->join('kullanici_yetki_gruplari', 'kullanici_yetki_gruplari.kullanici_yetki_grup_id = yetki_grup_id')
            ->get("kullanici_yetkileri");
            return $query->result();
    }
    public function insert($data){
		$this->db->insert('kullanici_yetkileri', $data);
 
	}
  public function update($id,$data){
		$this->db->where('kullanici_yetki_id', $id);
		$this->db->update('kullanici_yetkileri', $data);

          /* LOGDATA */
          log_data("Kayıt Güncelleme","[".$id."] nolu [Kullanıcı] kaydı güncellendi.");
          /* LOGDATA */
	}


  public function delete_user_permission($id){
    $this -> db -> where('kullanici_id', $id);
    $this -> db -> delete('kullanici_yetki_tanimlari');
}
}