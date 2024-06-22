<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siparis_onay_hareket_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
  

    public function insert($data){
		  $this->db->insert('siparis_onay_hareketleri', $data);    
	  }
 
}