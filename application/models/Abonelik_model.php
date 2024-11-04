<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Abonelik_model extends CI_Model {

    public function get_all_abonelikler() {
        return $this->db->get('abonelikler')->result();
    }

    public function get_abonelik_by_id($id) {
        return $this->db->get_where('abonelikler', ['abonelik_id' => $id])->row();
    }

    public function insert_abonelik($data) {
        return $this->db->insert('abonelikler', $data);
    }

    public function update_abonelik($id, $data) {
        return $this->db->where('abonelik_id', $id)->update('abonelikler', $data);
    }

    public function delete_abonelik($id) {
        return $this->db->delete('abonelikler', ['abonelik_id' => $id]);
    }
  

     
}
