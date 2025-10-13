<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Izin extends CI_Controller {
    function __construct() {
        parent::__construct();
        session_control();
        $this->load->model([
            'Izin_model', 'Istek_birim_model', 'Istek_kategori_model', 'Is_tip_model',
            'Kullanici_model', 'Istek_durum_model', 'Istek_hareket_model', 'Ayar_model'
        ]);
        date_default_timezone_set('Europe/Istanbul');
    }

    public function index() {
        $user = $this->Kullanici_model->get_by_id($this->session->userdata('aktif_kullanici_id'))[0];
        $viewData = [
            "istekler" => $this->Izin_model->get_all(
                ["izin_onaylayacak_sorumlu_id = $user->kullanici_id"],
                ["izin_talep_eden_kullanici_id = $user->kullanici_id"]),
            "page" => "izin/list"
        ];
        $this->load->view('base_view', $viewData);
    }

    public function add() {
        $user = $this->Kullanici_model->get_by_id($this->session->userdata('aktif_kullanici_id'))[0];
        $viewData = [
            "istekler" => $this->db->where("kullanici_aktif",1)->get("kullanicilar")->result(),
            "nedenler" => $this->db->get("izin_nedenleri")->result(),
             
            "page" => "izin/form"
        ];
        $this->load->view('base_view', $viewData);
    }

    public function edit($id = '') {
        $user = $this->Kullanici_model->get_by_id($this->session->userdata('aktif_kullanici_id'))[0];
        $izin = $this->Izin_model->get_by_id($id)[0];

        if ($izin->sorumlu_onay_durumu != 0 || $izin->insan_kaynaklari_onay_durumu != 0) {
            $this->session->set_flashdata('flashDanger', "Farklı birim tarafından onaylandığı için düzenlenemez.");
            redirect(site_url('izin'));
        }
        
        $viewData = [
            "istek_durumlari" => $this->Istek_durum_model->get_all(),
            "istek_birimleri" => $this->db->get("izin_nedenleri")->result(),
            "istek_kategorileri" => $this->Istek_kategori_model->get_all(),
            "is_tipleri" => $this->Is_tip_model->get_all(),
            "kullanicilar" => $this->Kullanici_model->get_all(),
            "departman_adi" => $izin->departman_adi, 
            "istek" => $izin, 
            "page" => "izin/form"
        ];
        $this->load->view('base_view', $viewData);
    }

    public function izin_iptal($id) {
        $user = $this->Kullanici_model->get_by_id($this->session->userdata('aktif_kullanici_id'))[0];
        $izin = $this->Izin_model->get_by_id($id);

        if ($user->kullanici_grup_no != 1 && $izin->izin_talep_eden_kullanici_id != $user->kullanici_id) {
            $this->session->set_flashdata('flashDanger', "Sadece kendi talebinizi iptal edebilirsiniz.");
            redirect(site_url('izin/onay_bekleyenler'));
        }
        if ($izin->insan_kaynaklari_onay_durumu != 0) {
            $this->session->set_flashdata('flashDanger', "Onaylanan talep iptal edilemez.");
            redirect(site_url('izin/onay_bekleyenler'));
        }
        
        $this->Izin_model->update($id, ['izin_durumu' => 0]);
        $this->session->set_flashdata('flashSuccess', "İzin talebi başarıyla iptal edildi.");
        redirect(site_url('izin/onay_bekleyenler'));
    }

    private function update_status($id, $field, $status) {
        $this->Izin_model->update($id, [
            $field => $status,
            "{$field}_tarihi" => date('Y-m-d H:i:s')
        ]);
    }

    public function sorumlu_onayla($id) {
        $this->update_status($id, 'sorumlu_onay_durumu', 1);
    }

    public function sorumlu_reddet($id) {
        $this->update_status($id, 'sorumlu_onay_durumu', 2);
        $this->update_status($id, 'insan_kaynaklari_onay_durumu', 2);
    }

    public function ik_onayla($id) {
        $this->update_status($id, 'insan_kaynaklari_onay_durumu', 1);
    }

    public function ik_reddet($id) {
        $this->update_status($id, 'insan_kaynaklari_onay_durumu', 2);
    }
}
