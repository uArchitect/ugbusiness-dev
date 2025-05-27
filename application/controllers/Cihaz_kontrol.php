<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cihaz_kontrol extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control(); 
        date_default_timezone_set('Europe/Istanbul');
    }
 
     public function detay($form_id,$urun_no)
    {
        // 1. Tüm başlıkları sırayla al
        $headers = $this->db
            ->select('*')
            ->where('kontrol_form_urun_no ', $urun_no)
            ->get('kontrol_form_basliklar')
            ->result_array();

        // 2. Tüm satırları sırayla al
        $rows = $this->db
            ->select('*')
            ->where('kontrol_form_data_row_urun_no', $urun_no)
            ->order_by('kontrol_form_data_row_sort_order', 'ASC')
            ->get('kontrol_form_data_rows')
            ->result_array();

        // 3. Tüm ölçümleri al
        $measurements = $this->db
            ->select('*')
            ->where('cihaz_kontrol_form_no', $form_id)
            ->get('kontrol_form_olcumler')
            ->result_array();

        // 4. Ölçümleri iki boyutlu diziye dönüştür
        $data = [];
        foreach ($measurements as $m) {
            $data[$m['kontrol_form_data_row_no']][$m['kontrol_form_baslik_no']] = $m['value'];
        }
        
        $checklist = $this->db
            ->select('*')
            ->where('kontrol_form_checklist_urun_no', $urun_no) 
            ->get('kontrol_form_checklist')
            ->result();


        // View'e gönder (veya JSON olarak dönebilirsin)
        $this->load->view('base_view', [
            'page' => 'cihaz_kontrol/form',
            'headers' => $headers,
            'rows' => $rows,
            'data' => $data,
            'checklist' => $checklist,
                'form_id' => $form_id
        ]);
    }



    public function olcum_update($form_id,$row_id,$col_id)
    {
        $control_data = $this->db->where("cihaz_kontrol_form_no",$form_id)->where("kontrol_form_data_row_no",$row_id)->where("kontrol_form_baslik_no",$col_id)->get("kontrol_form_olcumler")->result();
        if(count($control_data) <= 0){
            $insertData["cihaz_kontrol_form_no"] = $form_id;
            $insertData["kontrol_form_data_row_no"] = $row_id;
            $insertData["kontrol_form_baslik_no"] = $col_id;
            $insertData["value"] = $this->input->post("olcum_value");
            $this->db->insert("kontrol_form_olcumler",$insertData);   
        }else{
            $updateData["cihaz_kontrol_form_no"] = $form_id;
            $updateData["kontrol_form_data_row_no"] = $row_id;
            $updateData["kontrol_form_baslik_no"] = $col_id;
            $updateData["value"] = $this->input->post("olcum_value");
            $this->db->where("cihaz_kontrol_form_no",$form_id)->where("kontrol_form_data_row_no",$row_id)->where("kontrol_form_baslik_no",$col_id)->update("kontrol_form_olcumler",$updateData); 
        }
            $this->session->set_flashdata('flashSuccess', "Cihaz Test Ölçüm Verileri Güncellenmiştir.");
            redirect($_SERVER['HTTP_REFERER']);

    }
    
}
