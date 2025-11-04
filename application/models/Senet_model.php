<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Senet_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
 
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
 
    public function add_senet($data)
    {
        return $this->db->insert('senetler', $data);
    }
 
    public function get_senet_by_id($id)
    {
        $query = $this->db->get_where('senetler', array('id' => $id));
        return $query->row();
    }
 
    public function update_senet($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('senetler', $data);
    }
 
    public function delete_senet($id)
    {
        return $this->db->delete('senetler', array('id' => $id));
    }
}