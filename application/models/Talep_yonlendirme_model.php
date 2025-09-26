<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Talep_yonlendirme_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        ini_set("pcre.backtrack_limit", "5000000");
    } 
    public function get_by_id($id){
		$response = false;
		$query = $this->db->get_where("talep_yonlendirmeler",array('talep_yonlendirme_id' => $id));
		if($query && $query->num_rows()){
			$response = $query->result();
		}
		return $response;
    }
    
    public function delete($id){
      $this->db->delete('talep_yonlendirmeler', array('talep_yonlendirme_id' => $id)); 
    }
    public function get_all($where = null,$where2=null,$where3=null,$where4=null,$limit=0)
    {

      
      if($where != null){
        $this->db->where($where);
      }
      $filter_ids =   $this->db
                    ->select('MAX(talep_yonlendirmeler.talep_yonlendirme_id) as talep_yonlendirme_id', false)
                    ->from('talep_yonlendirmeler')
                   
                    ->group_by('talep_yonlendirmeler.talep_no')->get()->result_array();
     
                    if($filter_ids){
                      $filter_data = array_column($filter_ids, 'talep_yonlendirme_id');
                      if($where != null){
                        $this->db->where($where);
                        if($where2 != null){
                          $this->db->or_where($where2);
                          if($where3 != null){
                            $this->db->or_where($where3);
                            if($where4 != null){
                              $this->db->or_where($where4);
                            }
                          }
                        }
                      }
                      if($limit != 0){
                        $this->db->limit($limit);
                      }
                      $query = $this->db 
                                    ->select("talep_yonlendirmeler.*,ulkeler.ulke_adi,ulkeler.ulke_id,markalar.*,sehirler.sehir_adi,talep_sonuclar.*, talepler.*, yonlendiren.kullanici_ad_soyad AS yonlendiren_ad_soyad, yonlenen.kullanici_ad_soyad AS yonlenen_ad_soyad,yonlenen.kullanici_id AS yonlenen_kullanici_id, GROUP_CONCAT(urunler.urun_adi) as urun_adlari")
                                    ->from('talep_yonlendirmeler')
                                    ->join('talepler', 'talepler.talep_id = talep_yonlendirmeler.talep_no')
                                    ->join('markalar', 'markalar.marka_id = talepler.talep_kullanilan_cihaz_id')
                                    ->join('kullanicilar AS yonlendiren', 'yonlendiren.kullanici_id = talep_yonlendirmeler.yonlendiren_kullanici_id')
                                    ->join('kullanicilar AS yonlenen', 'yonlenen.kullanici_id = talep_yonlendirmeler.yonlenen_kullanici_id')
                                    ->join('urunler', 'FIND_IN_SET(urunler.urun_id, REPLACE(REPLACE(REPLACE(talepler.talep_urun_id, \'["\', \'\'), \'"]\', \'\'), \'"\', \'\'))', 'left')
                                    ->join('sehirler', 'sehirler.sehir_id = talepler.talep_sehir_no','left')
                                    ->join('ulkeler', 'ulkeler.ulke_id = talepler.talep_ulke_id','left')
                                    
                                    ->join('talep_sonuclar', 'talep_yonlendirmeler.gorusme_sonuc_no = talep_sonuclar.talep_sonuc_id')
                               
                                    ->group_by("talep_yonlendirmeler.talep_no")
                                    ->where_in('talep_yonlendirmeler.talep_yonlendirme_id', $filter_data)
                                    ->order_by('talep_yonlendirmeler.yonlendirme_tarihi', 'DESC')
                                    ->get();
                                    return $query->result();
                    }else{
                      return [];
                    }
                   

    
    
    }



    public function get_all_by_talep_no($where = null)
    {

   
      $query = $this->db  
                    ->where($where)
                    ->select("talep_yonlendirmeler.*,talep_sonuclar.*, talepler.*, yonlendiren.kullanici_ad_soyad AS yonlendiren_ad_soyad, yonlenen.kullanici_ad_soyad AS yonlenen_ad_soyad")
                    
                    ->from('talep_yonlendirmeler')->order_by("talep_yonlendirmeler.talep_yonlendirme_id","asc")
                    ->join('talepler', 'talepler.talep_id = talep_yonlendirmeler.talep_no')
                    ->join('kullanicilar AS yonlendiren', 'yonlendiren.kullanici_id = talep_yonlendirmeler.yonlendiren_kullanici_id')
                    ->join('kullanicilar AS yonlenen', 'yonlenen.kullanici_id = talep_yonlendirmeler.yonlenen_kullanici_id')
                     
                    ->join('talep_sonuclar', 'talep_yonlendirmeler.gorusme_sonuc_no = talep_sonuclar.talep_sonuc_id')
                  
                    ->get();

    
      return $query->result();
    }




    public function insert($data){
		$this->db->insert('talep_yonlendirmeler', $data);
	}
  public function update($id,$data){
		$this->db->where('talep_yonlendirme_id', $id);
		$this->db->update('talep_yonlendirmeler', $data);
          /* LOGDATA */
          log_data("Kayıt Güncelleme","[".$id."] nolu [Talep Yönlendirme] kaydı güncellendi.");
          /* LOGDATA */
	}
}