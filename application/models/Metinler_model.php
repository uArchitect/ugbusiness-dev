<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metinler_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Yeni metin ekleme
    public function ekle_metin($data) {
        return $this->db->insert('metinler', $data);
    }

    // Mevcut metni güncelleme
    public function guncelle_metin($metin_id, $data) {
      
       $this->db->where('metin_id', $metin_id);
       $query = $this->db->get('metinler');
       
       if ($query->num_rows() > 0) {
            
           $update_data = array();
           if (!empty($data['metin_almanca'])) {
            if($data['metin_almanca'] === " "){
                $update_data['metin_almanca'] = "";
            }else{
                $update_data['metin_almanca'] = $data['metin_almanca'];
            }
               
           }
           if (!empty($data['metin_arapca'])) {
            if($data['metin_arapca'] == " "){
                $update_data['metin_arapca'] = "";
            }else{
                $update_data['metin_arapca'] = $data['metin_arapca'];
            }

           
           }
           if (!empty($data['metin_ingilizce'])) {
            if($data['metin_ingilizce'] == " "){
                $update_data['metin_ingilizce'] = "";
            }else{
                $update_data['metin_ingilizce'] = $data['metin_ingilizce'];
            }
               
           }
           if (!empty($data['metin_rusca'])) {

            if($data['metin_rusca'] == " "){
                $update_data['metin_rusca'] = "";
            }else{
                $update_data['metin_rusca'] = $data['metin_rusca'];
            }
            
           }
           
        
           if (!empty($update_data)) {
               $this->db->where('metin_id', $metin_id);
               $this->db->update('metinler', $update_data);
           }
       } else {
            
       }
       
    }
 
    public function get_metin($metin_id) {
        $this->db->where('metin_id', $metin_id);
        $query = $this->db->get('metinler');
        return $query->row();
    }
 
    public function get_metinler() {
        $query = $this->db->get('metinler');
        return $query->result();
    }
}
