<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sistem_bildirimleri_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
    
    public function get_by_id($id){
        $response = false;
        $query = $this->db->select('sistem_bildirimleri.*,
                                   bildirim_tipleri.ad as tip_adi,
                                   bildirim_tipleri.gereken_onay_seviyesi,
                                   gonderen.kullanici_ad_soyad as gonderen_ad_soyad,
                                   onaylayan.kullanici_ad_soyad as onaylayan_ad_soyad')
                         ->from('sistem_bildirimleri')
                         ->join('bildirim_tipleri', 'bildirim_tipleri.id = sistem_bildirimleri.tip_id')
                         ->join('kullanicilar as gonderen', 'gonderen.kullanici_id = sistem_bildirimleri.gonderen_id', 'left')
                         ->join('kullanicilar as onaylayan', 'onaylayan.kullanici_id = sistem_bildirimleri.onaylayan_id', 'left')
                         ->where('sistem_bildirimleri.id', $id)
                         ->get();
        if($query && $query->num_rows()){
            $response = $query->result();
        }
        return $response;
    }
    
    public function get_all($where = null)
    {
        if($where != null){
            $this->db->where($where);
        }
        
        $query = $this->db->select('sistem_bildirimleri.*,
                                   bildirim_tipleri.ad as tip_adi,
                                   bildirim_tipleri.gereken_onay_seviyesi,
                                   gonderen.kullanici_ad_soyad as gonderen_ad_soyad,
                                   onaylayan.kullanici_ad_soyad as onaylayan_ad_soyad,
                                   sistem_bildirim_alicilar.okundu as kullanici_okundu')
                         ->from('sistem_bildirimleri')
                         ->join('bildirim_tipleri', 'bildirim_tipleri.id = sistem_bildirimleri.tip_id')
                         ->join('kullanicilar as gonderen', 'gonderen.kullanici_id = sistem_bildirimleri.gonderen_id', 'left')
                         ->join('kullanicilar as onaylayan', 'onaylayan.kullanici_id = sistem_bildirimleri.onaylayan_id', 'left')
                         ->join('sistem_bildirim_alicilar', 'sistem_bildirim_alicilar.bildirim_id = sistem_bildirimleri.id', 'left')
                         ->order_by('sistem_bildirimleri.created_at', 'desc')
                         ->get();
        return $query->result();
    }
    
    public function get_kullanici_bildirimleri($kullanici_id)
    {
        $query = $this->db->select('sistem_bildirimleri.*,
                                   bildirim_tipleri.ad as tip_adi,
                                   bildirim_tipleri.gereken_onay_seviyesi,
                                   gonderen.kullanici_ad_soyad as gonderen_ad_soyad,
                                   onaylayan.kullanici_ad_soyad as onaylayan_ad_soyad,
                                   sistem_bildirim_alicilar.okundu as kullanici_okundu')
                         ->from('sistem_bildirimleri')
                         ->join('bildirim_tipleri', 'bildirim_tipleri.id = sistem_bildirimleri.tip_id')
                         ->join('kullanicilar as gonderen', 'gonderen.kullanici_id = sistem_bildirimleri.gonderen_id', 'left')
                         ->join('kullanicilar as onaylayan', 'onaylayan.kullanici_id = sistem_bildirimleri.onaylayan_id', 'left')
                         ->join('sistem_bildirim_alicilar', 'sistem_bildirim_alicilar.bildirim_id = sistem_bildirimleri.id', 'inner')
                         ->where('sistem_bildirim_alicilar.alici_id', $kullanici_id)
                         ->order_by('sistem_bildirimleri.created_at', 'desc')
                         ->get();
        return $query->result();
    }
    
    public function get_okunmamis_sayisi($kullanici_id)
    {
        $query = $this->db->select('COUNT(*) as sayi')
                         ->from('sistem_bildirim_alicilar')
                         ->where('alici_id', $kullanici_id)
                         ->where('okundu', 0)
                         ->get();
        $result = $query->row();
        return $result ? (int)$result->sayi : 0;
    }
    
    public function insert($data){
        $this->db->insert('sistem_bildirimleri', $data);
        return $this->db->insert_id();
    }
    
    public function update($id, $data){
        $this->db->where('id', $id);
        $this->db->update('sistem_bildirimleri', $data);
    }
    
    public function delete($id){
        $this->db->delete('sistem_bildirimleri', array('id' => $id));
    }
}

