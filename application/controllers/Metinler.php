<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metinler extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Metinler_model');
    }
 
    public function ekle() {
        if($this->input->post()) {
            $data = array(
                'metin_turkce' => $this->input->post('metin_turkce')
            );

            $this->Metinler_model->ekle_metin($data);
            redirect('metinler/ekle');
        } else {
            $this->load->view('metin_ekle_form');
        }
    }
 
    public function guncelle($metin_id) {
        if($this->input->post()) {
            $data = array(
                'metin_turkce' => $this->input->post('metin_turkce'),
                'metin_almanca' => $this->input->post('metin_almanca'),
                'metin_arapca' => $this->input->post('metin_arapca'),
                'metin_ingilizce' => $this->input->post('metin_ingilizce'),
                'metin_rusca' => $this->input->post('metin_rusca')
            );

            $this->Metinler_model->guncelle_metin($metin_id, $data);
            redirect('metinler/listele');
        } else {
            $data['metin'] = $this->Metinler_model->get_metin($metin_id);
            $this->load->view('metin_guncelle_form', $data);
        }
    }
 
    public function listele() { 
    }
}
