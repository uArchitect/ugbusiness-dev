<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Senet_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Tüm senetleri veritabanından getirir. Arama terimi varsa filtreler.
     * @param string $search_term Arama yapılacak müşteri adı veya iletişim numarası.
     * @return array
     */
    public function get_all_senetler($search_term = NULL)
    {
        $this->db->select('*');
        $this->db->from('senetler');

        if ($search_term) {
            $this->db->like('musteri_adsoyad', $search_term);
            $this->db->or_like('iletisim_numarasi', $search_term);
        }

        $this->db->order_by('senet_tarihi', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Yeni bir senet kaydı ekler.
     * @param array $data
     * @return bool
     */
    public function add_senet($data)
    {
        return $this->db->insert('senetler', $data);
    }

    /**
     * Belirtilen ID'ye sahip senedi getirir.
     * @param int $id Senet ID'si
     * @return object
     */
    public function get_senet_by_id($id)
    {
        $query = $this->db->get_where('senetler', array('id' => $id));
        return $query->row();
    }

    /**
     * Belirtilen ID'ye sahip senedi günceller.
     * @param int $id Senet ID'si
     * @param array $data Güncellenecek veriler
     * @return bool
     */
    public function update_senet($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('senetler', $data);
    }

    /**
     * Belirtilen ID'ye sahip senedi siler.
     * @param int $id Senet ID'si
     * @return bool
     */
    public function delete_senet($id)
    {
        return $this->db->delete('senetler', array('id' => $id));
    }
}