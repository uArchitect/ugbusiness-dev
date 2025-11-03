<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cihaz_kontrol extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control(); 
        date_default_timezone_set('Europe/Istanbul');
    }
 

    public function parameter($urun_no, $test_sira_no)
    {

        $datarows    = $this->db->where("kontrol_form_data_row_urun_no",$urun_no)->where("kontrol_form_data_row_test_sira_no",$test_sira_no)->get("kontrol_form_data_rows")->result();
        $checklist   = $this->db->where("kontrol_form_checklist_urun_no",$urun_no)->where("kontrol_form_checklist_test_sira_no",$test_sira_no)->get("kontrol_form_checklist")->result();
        $dataheaders = $this->db->where("kontrol_form_urun_no",$urun_no)->where("kontrol_form_basliklar_test_sira_no",$test_sira_no)->get("kontrol_form_basliklar")->result();
        $urunler     = $this->db->get("urunler")->result();

        $this->load->view('base_view', [
            'page' => 'cihaz_kontrol/parametreler',
            'datarows' => $datarows,
            'checklist' => $checklist,
            'dataheaders' => $dataheaders,
            'urunler' => $urunler,
            'urun_no' => $urun_no,
            'test_sira_no' => $test_sira_no
        ]);

    }






     public function detay($form_id = 0,$urun_no,$cihaz_no)
    {

          $cih = $this->db->where("cihaz_havuz_id",$cihaz_no)->get("cihaz_havuzu")->result()[0];
            $formlar = $this->db->where("cihaz_kontrol_form_seri_numarasi",$cih->cihaz_havuz_seri_numarasi)->get("cihaz_kontrol_formlar")->result();
            if(count($formlar) <= 0){
                $uruntestsayi = $this->db->where("urun_id",$urun_no)->get("urunler")->result()[0]->cihaz_test_sayisi;
                for ($i=1; $i <= $uruntestsayi ; $i++) { 
                    $cinsertData["cihaz_kontrol_form_seri_numarasi"] =   $cih->cihaz_havuz_seri_numarasi;
                    $cinsertData["cihaz_kontrol_form_urun_fg_id"] =   $cih->cihaz_kayit_no;
                    $cinsertData["cihaz_kontrol_form_test_sira_no"] =  $i;
                    $cinsertData["cihaz_kontrol_form_kullanici_no"] =  0;
                    $cinsertData["cihaz_kontrol_form_kullanici_no"] =  0;
                    $cinsertData["cihaz_kontrol_form_test_baslangic_tarihi"] = date('Y-m-d', strtotime("+".($i-1)." week"));
                    $cinsertData["cihaz_kontrol_form_test_bitis_tarihi"] = date('Y-m-d', strtotime("+".($i-1)." week"));
                    $this->db->insert("cihaz_kontrol_formlar",$cinsertData);
                    
                } 
                redirect(base_url("cihaz_kontrol/detay/".$this->db->insert_id()."/".$urun_no."/".$cihaz_no));
         
            }else{
                if($form_id == 0){
                    redirect(base_url("cihaz_kontrol/detay/".$formlar[0]->cihaz_kontrol_form_id ."/".$urun_no."/".$cihaz_no));
                }
                 
            }

        $dataform = $this->db->where("cihaz_kontrol_form_id ",$form_id)->get("cihaz_kontrol_formlar")->result()[0];

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

        $urundetay = $this->db->where("urun_id",$urun_no)->get("urunler")->result()[0];
         
        $this->load->view('base_view', [
            'page' => 'cihaz_kontrol/form',
            'headers' => $headers,
            'rows' => $rows,
            'data' => $data,
            'checklist' => $checklist,
            'form_id' => $form_id,
            'urun_detay' =>$urundetay,
            'test_planlari' => $formlar,
            'dataform'=>$dataform
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
