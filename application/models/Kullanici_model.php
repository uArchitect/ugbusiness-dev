<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kullanici_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
    public function get_by_id($id){
		$response = false;
		$query = $this->db ->join('departmanlar', 'departmanlar.departman_id = kullanicilar.kullanici_departman_id') 
    ->get_where("kullanicilar",array('kullanici_id' => $id));
		if($query && $query->num_rows()){
			$response = $query->result();
		}
		return $response;
    }
      public function delete($id){
      $this->db->delete("kullanicilar", array('kullanici_id' => $id));
          /* LOGDATA */
     log_data("Kayıt Silme","[".$id."] nolu [Kullanıcı] kaydı silindi.");
     /* LOGDATA */
    }

 




    public function get_egitmen($where=null)
    {
        $query = $this->db->order_by('kullanici_id', 'ASC')->where($where)
        ->join('departmanlar', 'departmanlar.departman_id = kullanicilar.kullanici_departman_id')
        ->join('kullanici_gruplari', 'kullanici_gruplari.kullanici_grup_id = kullanicilar.kullanici_grup_no')
        ->get("kullanicilar");
      return $query->result();
    }



    public function get_all($where=null,$where_in = null)
    {
   
      if($where!=null){
        $query = $this->db->order_by('kullanici_adi', 'ASC')->where("kullanici_departman_id !=",19)->where($where)->where("kullanici_aktif",1)
        ->join('departmanlar', 'departmanlar.departman_id = kullanicilar.kullanici_departman_id')
        ->join('kullanici_gruplari', 'kullanici_gruplari.kullanici_grup_id = kullanicilar.kullanici_grup_no')
        ->get("kullanicilar");
     
      }else{
        if($where_in!=null){
          $user_ids = json_decode($where_in);

          $query = $this->db->order_by('kullanici_id', 'ASC')->where_in('kullanicilar.kullanici_id',$user_ids)
          ->join('departmanlar', 'departmanlar.departman_id = kullanicilar.kullanici_departman_id')
          ->join('kullanici_gruplari', 'kullanici_gruplari.kullanici_grup_id = kullanicilar.kullanici_grup_no')
          ->get("kullanicilar");
        } else{
          $query = $this->db->order_by('kullanici_id', 'ASC')->join('departmanlar', 'departmanlar.departman_id = kullanicilar.kullanici_departman_id')->get("kullanicilar");
     
        }

       
      }
      return $query->result();
    }
    public function insert($data){

      
      $this->db->insert('kullanicilar', $data);
      $inserted_id = $this->db->insert_id();
      
           
      return $inserted_id;

	}
  public function update($id,$data){
		$this->db->where('kullanici_id', $id);
		$this->db->update('kullanicilar', $data);
          /* LOGDATA */
          log_data("Kayıt Güncelleme","[".$id."] nolu [Kullanıcı] kaydı güncellendi.");
          /* LOGDATA */
	}
}