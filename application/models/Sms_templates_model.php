<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sms_templates_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    } 
    
    public function get_by_id($id){
		$response = false;
		$query = $this->db->get_where("sms_templates", array('id' => $id));
		if($query && $query->num_rows()){
			$response = $query->result();
		}
		return $response;
    }
    
    public function delete($id){
      $this->db->delete('sms_templates', array('id' => $id));
      /* LOGDATA */
      log_data("Kayıt Silme","[".$id."] nolu [SMS Şablonu] kaydı silindi.");
      /* LOGDATA */
    }
    
    public function get_all()
    {
      $query = $this->db->order_by('id', 'DESC')->get("sms_templates");
      return $query->result();
    }
    
    public function get_active()
    {
      $query = $this->db->where('is_active', 1)->order_by('id', 'DESC')->get("sms_templates");
      return $query->result();
    }
    
    public function insert($data){
		$this->db->insert('sms_templates', $data);
		/* LOGDATA */
		log_data("Kayıt Ekleme","[SMS Şablonu] kaydı eklendi: " . $data['title']);
		/* LOGDATA */
	}
	
	public function update($id,$data){
		$this->db->where('id', $id);
		$this->db->update('sms_templates', $data);
		/* LOGDATA */
		log_data("Kayıt Güncelleme","[".$id."] nolu [SMS Şablonu] kaydı güncellendi.");
		/* LOGDATA */
	}
}

