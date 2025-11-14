<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sms_templates extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Sms_templates_model'); 
        date_default_timezone_set('Europe/Istanbul');
    }
 
	public function index()
	{
        yetki_kontrol("sistem_ayar_duzenle");
        $data = $this->Sms_templates_model->get_all(); 
		$viewData["sms_templates"] = $data;
		$viewData["page"] = "sms_templates/list";
		$this->load->view('base_view',$viewData);
	}

	public function save()
	{   
        yetki_kontrol("sistem_ayar_duzenle");
        
        $id = $this->input->post('id');
        $this->form_validation->set_rules('title', 'Şablon Adı', 'required|max_length[100]');
        $this->form_validation->set_rules('message', 'SMS Metni', 'required');
        
        $data['title'] = escape($this->input->post('title'));
        $data['message'] = escape($this->input->post('message'));
        $data['is_active'] = $this->input->post('is_active') ? 1 : 0;

        if ($this->form_validation->run() != FALSE) {
            if (!empty($id)) {
                $check_id = $this->Sms_templates_model->get_by_id($id);
                if($check_id){
                    $this->Sms_templates_model->update($id, $data);
                    echo json_encode(array('success' => true, 'message' => 'Şablon başarıyla güncellendi.'));
                } else {
                    echo json_encode(array('success' => false, 'message' => 'Şablon bulunamadı.'));
                }
            } else {
                $this->Sms_templates_model->insert($data);
                echo json_encode(array('success' => true, 'message' => 'Şablon başarıyla eklendi.'));
            }
        } else {
            echo json_encode(array('success' => false, 'message' => validation_errors()));
        }
	}

    public function delete()
	{     
        yetki_kontrol("sistem_ayar_duzenle");
        $id = $this->input->post('id');
        
        if (!empty($id)) {
            $check_id = $this->Sms_templates_model->get_by_id($id);
            if($check_id){
                $this->Sms_templates_model->delete($id);
                echo json_encode(array('success' => true, 'message' => 'Şablon başarıyla silindi.'));
            } else {
                echo json_encode(array('success' => false, 'message' => 'Şablon bulunamadı.'));
            }
        } else {
            echo json_encode(array('success' => false, 'message' => 'Geçersiz ID.'));
        }
	}

    public function get_template()
	{     
        yetki_kontrol("sistem_ayar_duzenle");
        $id = $this->input->post('id');
        
        if (!empty($id)) {
            $template = $this->Sms_templates_model->get_by_id($id);
            if($template){
                echo json_encode(array('success' => true, 'data' => $template[0]));
            } else {
                echo json_encode(array('success' => false, 'message' => 'Şablon bulunamadı.'));
            }
        } else {
            echo json_encode(array('success' => false, 'message' => 'Geçersiz ID.'));
        }
	}
}

