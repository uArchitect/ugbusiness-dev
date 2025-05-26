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
            'checklist' => $checklist
        ]);
    }
    
}
