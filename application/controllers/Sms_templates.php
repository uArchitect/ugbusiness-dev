<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sms_templates extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        date_default_timezone_set('Europe/Istanbul');
    }
 
	public function index()
	{
        
        $data = $this->db->order_by('id', 'DESC')->get("sms_templates")->result(); 
		$viewData["sms_templates"] = $data;
		$viewData["page"] = "sms_templates/list";
		$this->load->view('base_view',$viewData);
	}

	public function save()
	{   
        
        
        $id = $this->input->post('id');
        $this->form_validation->set_rules('title', 'Şablon Adı', 'required|max_length[100]');
        $this->form_validation->set_rules('message', 'SMS Metni', 'required');
        
        $data['title'] = escape($this->input->post('title'));
        $data['message'] = escape($this->input->post('message'));
        $data['is_active'] = $this->input->post('is_active') ? 1 : 0;

        if ($this->form_validation->run() != FALSE) {
            if (!empty($id)) {
                $check_id = $this->db->get_where("sms_templates", array('id' => $id))->result();
                if($check_id){
                    $this->db->where('id', $id);
                    $this->db->update('sms_templates', $data);
                    /* LOGDATA */
                    log_data("Kayıt Güncelleme","[".$id."] nolu [SMS Şablonu] kaydı güncellendi.");
                    /* LOGDATA */
                    $this->session->set_flashdata('success', 'Şablon başarıyla güncellendi.');
                } else {
                    $this->session->set_flashdata('error', 'Şablon bulunamadı.');
                }
            } else {
                $this->db->insert('sms_templates', $data);
                /* LOGDATA */
                log_data("Kayıt Ekleme","[SMS Şablonu] kaydı eklendi: " . $data['title']);
                /* LOGDATA */
                $this->session->set_flashdata('success', 'Şablon başarıyla eklendi.');
            }
        } else {
            $this->session->set_flashdata('form_errors', json_encode($this->form_validation->error_array()));
        }
        
        redirect(site_url('sms_templates'));
	}

    public function delete($id)
	{     
        
        
        if (!empty($id)) {
            $check_id = $this->db->get_where("sms_templates", array('id' => $id))->result();
            if($check_id){
                $this->db->delete('sms_templates', array('id' => $id));
                /* LOGDATA */
                log_data("Kayıt Silme","[".$id."] nolu [SMS Şablonu] kaydı silindi.");
                /* LOGDATA */
                $this->session->set_flashdata('success', 'Şablon başarıyla silindi.');
            } else {
                $this->session->set_flashdata('error', 'Şablon bulunamadı.');
            }
        } else {
            $this->session->set_flashdata('error', 'Geçersiz ID.');
        }
        
        redirect(site_url('sms_templates'));
	}

    public function edit($id = '')
	{     
        
        
        if (!empty($id)) {
            $template = $this->db->get_where("sms_templates", array('id' => $id))->result();
            if($template){
                $data = $this->db->order_by('id', 'DESC')->get("sms_templates")->result();
                $viewData['sms_templates'] = $data;
                $viewData['template'] = $template[0];
                $viewData["page"] = "sms_templates/list";
                $this->load->view('base_view',$viewData);
            } else {
                redirect(site_url('sms_templates'));
            }
        } else {
            redirect(site_url('sms_templates'));
        }
	}
}

