<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Atis_log_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Load the database library
    }

    public function get_all_logs() {
        $this->db->limit(50);
        $this->db->order_by('islem_tarihi', 'DESC'); // Order by date, newest first
        $query = $this->db->get('atis_log');
        return $query->result(); // Return result as an array of objects
    }
}