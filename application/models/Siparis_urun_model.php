<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siparis_urun_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
  

    public function insert($data){
		  $this->db->insert('siparis_urunleri', $data);    
	  }
 
}