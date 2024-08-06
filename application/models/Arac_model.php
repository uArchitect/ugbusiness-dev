<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arac_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
    public function get_all()
    {
      $query = $this->db->order_by('sirket_arac_id', 'ASC')->get("sirket_araclari");
      return $query->result();
    }

    public function delete($arac_id)
    {
      $this->db->where(["arac_id"=>$bakim_id]);
      $this->db->delete("araclar");
      return true;
    }



    public function get_all_araclar($where = null,$orwhere = null)
    {
      if($where != null){
        $this->db->where($where);
        
      }
      if($orwhere != null){
        $this->db->or_where($orwhere);
        
      }

      $query = $this->db  
      ->select("araclar.*,kullanicilar.*")
      ->from('araclar')->order_by("arac_id","asc")
      ->join('kullanicilar', 'kullanicilar.kullanici_id = araclar.arac_surucu_id', 'left')
      ->get();
      return $query->result();
    }
    public function update_arac($arac_id,$arac_data)
    {
      $this->db->where(["arac_id"=>$arac_id]);
      $this->db->update("araclar",$arac_data);
      return true;
    }



    public function get_all_bakimlar($arac_id)
    {
      $query = $this->db->where(["arac_tanim_id"=>$arac_id])->order_by('arac_bakim_id', 'ASC')->get("arac_bakimlar");
      return $query->result();
    }
    public function add_bakim($bakim_data)
    {
      $this->db->insert("arac_bakimlar",$bakim_data);
      return true;
    }
    public function update_bakim($bakim_id,$bakim_data)
    {
      $this->db->where(["arac_bakim_id"=>$bakim_id]);
      $this->db->update("arac_bakimlar",$bakim_data);
      return true;
    }
    public function delete_bakim($bakim_id)
    {
      $this->db->where(["arac_bakim_id"=>$bakim_id]);
      $this->db->delete("arac_bakimlar");
      return true;
    }



    public function get_all_sigortalar($arac_id)
    {
      $query = $this->db->where(["arac_tanim_id"=>$arac_id])->order_by('arac_sigorta_id', 'ASC')->get("arac_sigortalar");
      return $query->result();
    }
    public function add_sigorta($sigorta_data)
    {
      $this->db->insert("arac_sigortalar",$sigorta_data);
      return true;
    }
    public function update_sigorta($sigorta_id,$sigorta_data)
    {
      $this->db->where(["arac_sigorta_id"=>$sigorta_id]);
      $this->db->update("arac_sigortalar",$sigorta_data);
      return true;
    }
    public function delete_sigorta($sigorta_id)
    {
      $this->db->where(["arac_sigorta_id"=>$sigorta_id]);
      $this->db->delete("arac_sigortalar");
      return true;
    }


    public function add_muayene($muayene_data)
    {
      $this->db->insert("arac_muayeneler",$muayene_data);
      return true;
    }
    public function update_muayene($muayene_id,$muayene_data)
    {
      $this->db->where(["arac_muayene_id"=>$muayene_id]);
      $this->db->update("arac_muayeneler",$muayene_data);
      return true;
    }



    public function get_all_km($arac_id)
    {
      $query = $this->db->where(["arac_tanim_id"=>$arac_id])->order_by('arac_km_id', 'DESC')->get("arac_kmler");
      return $query->result();
    }
    public function add_km($km_data)
    {
      $this->db->insert("arac_kmler",$km_data);
      return true;
    }
    public function update_km($arac_km_id,$km_data)
    {
      $this->db->where(["arac_km_id"=>$arac_km_id]);
      $this->db->update("arac_kmler",$km_data);
      return true;
    }
    public function delete_km($arac_km_id)
    {
      $this->db->where(["arac_km_id"=>$arac_km_id]);
      $this->db->delete("arac_kmler");
      return true;
    }




    public function add_lastik($lastik_data)
    {
      $this->db->insert("arac_lastikler",$lastik_data);
      return true;
    }


    public function get_all_muayeneler($arac_id)
    {
      $query = $this->db->where(["arac_tanim_id"=>$arac_id])->order_by('arac_muayene_id', 'ASC')->get("arac_muayeneler");
      return $query->result();
    }
    public function get_all_kaskolar($arac_id)
    {
      $query = $this->db->where(["arac_tanim_id"=>$arac_id])->order_by('arac_kasko_id', 'ASC')->get("arac_kaskolar");
      return $query->result();
    }
    public function add_kasko($kasko_data)
    {
      $this->db->insert("arac_kaskolar",$kasko_data);
      return true;
    }
    public function update_kasko($kasko_id,$kasko_data)
    {
      $this->db->where(["arac_kasko_id"=>$kasko_id]);
      $this->db->update("arac_kaskolar",$kasko_data);
      return true;
    }
    public function delete_kasko($kasko_id)
    {
      $this->db->where(["arac_kasko_id"=>$kasko_id]);
      $this->db->delete("arac_kaskolar");
      return true;
    }


    public function delete_muayene($muayene_id)
    {
      $this->db->where(["arac_muayene_id"=>$muayene_id]);
      $this->db->delete("arac_muayeneler");
      return true;
    }







}