<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Atis_log_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); 
    }

    public function get_all_logs() {
        
        $this->db->order_by('islem_tarihi', 'DESC'); 
        $query = $this->db->get('atis_log');
        return $query->result();  
    }
}