<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Talep_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
    public function get_by_id($id){
		$response = false;
		$query = $this
    ->db
    ->join('kullanicilar', 'kullanicilar.kullanici_id = talep_sorumlu_kullanici_id')
    ->get_where("talepler",array('talep_id' => $id));
		if($query && $query->num_rows()){
			$response = $query->result();
		}
		return $response;
    }
    
    public function delete($id){
      $this->db->delete('talepler', array('talep_id' => $id));
    }
    public function get_count(){
     return $this->db->from("talepler")->count_all_results();
    }

    public function get_all_talep_filter($where=null,$orwhere=null)
    {
      if($where != null){
        $this->db->where($where);
        if($orwhere != null){
          $this->db->or_where($orwhere);
        }
      }

      $this->db->select('talepler.*,talep_kaynaklari.*, GROUP_CONCAT(urunler.urun_adi) as urun_adlari', false);
      $this->db->from('talepler');
      $this->db->join('urunler', 'FIND_IN_SET(urunler.urun_id, REPLACE(REPLACE(REPLACE(talepler.talep_urun_id, \'["\', \'\'),\'"]\', \'\'),\'"\', \'\'))', 'left');
      $this->db->join('talep_kaynaklari', 'talep_kaynaklari.talep_kaynak_id = talep_kaynak_no');
      $this->db->group_by('talepler.talep_id');
      $this->db->join('kullanicilar', 'kullanicilar.kullanici_id = talep_sorumlu_kullanici_id');
     
      $this->db->order_by('talepler.talep_id', $order);
      
      $query = $this->db->get()->result();
      return $query;
    }


    public function get_all($where=null,$order='ASC')
    {
      if($where != null){
        $this->db->where($where);
      }

      $this->db->select('talepler.*,talep_kaynaklari.*, GROUP_CONCAT(urunler.urun_adi) as urun_adlari', false);
      $this->db->from('talepler');
      $this->db->join('urunler', 'FIND_IN_SET(urunler.urun_id, REPLACE(REPLACE(REPLACE(talepler.talep_urun_id, \'["\', \'\'),\'"]\', \'\'),\'"\', \'\'))', 'left');
      $this->db->join('talep_kaynaklari', 'talep_kaynaklari.talep_kaynak_id = talep_kaynak_no');
      $this->db->group_by('talepler.talep_id');
      $this->db->join('kullanicilar', 'kullanicilar.kullanici_id = talep_sorumlu_kullanici_id');
     
      $this->db->order_by('talepler.talep_id', $order);
      
      $query = $this->db->get()->result();
      return $query;
    }
    public function insert($data){
		$this->db->insert('talepler', $data);
	}
  public function update($id,$data){
		$this->db->where('talep_id', $id);
		$this->db->update('talepler', $data); 
	}
}