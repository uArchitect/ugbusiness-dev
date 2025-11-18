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
        yetki_kontrol("izinleri_yonet");

        $user = $this->db->where('kullanici_id', $this->session->userdata('aktif_kullanici_id'))->get('kullanicilar')->row();
        $user_id = $user->kullanici_id;
        
        // Tüm izin taleplerini getir (amir onay bekleyenler, müdür onay bekleyenler, kendi talepleri)
        $this->db->where("izin_durumu", 1);
        $this->db->group_start();
        $this->db->where("amir_onay_durumu", 0); // Amir onay bekleyenler
        $this->db->or_group_start();
        $this->db->where("amir_onay_durumu", 1);
        $this->db->where("mudur_onay_durumu", 0); // Müdür onay bekleyenler
        $this->db->group_end();
        $this->db->or_where("izin_talep_eden_kullanici_id", $user_id); // Kendi talepleri
        $this->db->group_end();
        
        $istekler = $this->db->select('izin_talepleri.*, 
                kullanicilar.kullanici_ad_soyad, kullanicilar.kullanici_departman_id,
                departmanlar.departman_adi,
                izin_nedenleri.izin_neden_detay,
                amir_kullanici.kullanici_ad_soyad as amir_ad_soyad,
                mudur_kullanici.kullanici_ad_soyad as mudur_ad_soyad,
                izin_talepleri.amir_onay_kullanici_id,
                izin_talepleri.mudur_onay_kullanici_id')
            ->order_by('izin_talep_id', 'desc')
            ->join('kullanicilar', 'kullanicilar.kullanici_id = izin_talepleri.izin_talep_eden_kullanici_id')
            ->join('departmanlar', 'departmanlar.departman_id = kullanicilar.kullanici_departman_id')
            ->join('izin_nedenleri', 'izin_nedenleri.izin_neden_id = izin_talepleri.izin_neden_no')
            ->join('kullanicilar as amir_kullanici', 'amir_kullanici.kullanici_id = izin_talepleri.amir_onay_kullanici_id', 'left')
            ->join('kullanicilar as mudur_kullanici', 'mudur_kullanici.kullanici_id = izin_talepleri.mudur_onay_kullanici_id', 'left')
            ->get("izin_talepleri")->result();
        
        $viewData = [
            "istekler" => $istekler,
            "kullanicilar" => $this->db->where("kullanici_aktif",1)->get("kullanicilar")->result(),
            "nedenler" => $this->db->get("izin_nedenleri")->result(),
            "aktif_kullanici_id" => $user_id,
            "page" => "izin/list"
        ];




         
        $this->db->select('kullanicilar.kullanici_ad_soyad,kullanicilar.kullanici_id,stajyer_id,pazartesi,sali,carsamba,persembe,cuma', false);
        $this->db->from('stajyerler'); 
        $this->db->join('kullanicilar', 'kullanicilar.kullanici_id = stajyer_kullanici_id');
        $viewData["stajyerler"] = $this->db->get()->result();
    

        $this->db->order_by("kullanici_ad_soyad","asc");
        $data = $this->db->where("kullanici_aktif", 1)->where("mesai_takip_kontrolü", 1)->get("kullanicilar")->result();    
        $viewData["takipkullanicilar"] = $data;


        $this->load->view('base_view', $viewData);
    }



public function staj_durum_degistir($id,$gun,$durum) {
       $updateData[$gun] = $durum;
       $this->db->where("stajyer_id",$id)->update("stajyerler",$updateData);
       redirect(base_url("izin"));
       
    }




    public function add() {
        $viewData = [
            "kullanicilar" => $this->db->where("kullanici_aktif",1)->get("kullanicilar")->result(),
            "nedenler" => $this->db->get("izin_nedenleri")->result(),
            "page" => "izin/form"
        ];
        $this->load->view('base_view', $viewData);
    }

    public function save() {
        $data = $this->input->post();
        // Yeni izin talebi oluşturulurken onay durumlarını 0 (beklemede) olarak set et
        $data['amir_onay_durumu'] = 0;
        $data['mudur_onay_durumu'] = 0;
        $data['izin_durumu'] = 1; // Aktif
        $data['izin_kayit_tarihi'] = date('Y-m-d H:i:s');
        
        $this->db->insert("izin_talepleri", $data);
        $this->session->set_flashdata('flashSuccess', "İzin talebi başarıyla oluşturuldu.");
        redirect("izin");
    }


    public function edit($id = '') {
        $izin = $this->db->where('izin_talep_id', $id)
            ->join('kullanicilar', 'kullanicilar.kullanici_id = izin_talepleri.izin_talep_eden_kullanici_id')
            ->join('departmanlar', 'departmanlar.departman_id = kullanicilar.kullanici_departman_id')
            ->join('izin_nedenleri', 'izin_nedenleri.izin_neden_id = izin_talepleri.izin_neden_no')
            ->get("izin_talepleri")->row();
 
        $viewData = [
            "kullanicilar" => $this->db->where("kullanici_aktif",1)->get("kullanicilar")->result(),
            "nedenler" => $this->db->get("izin_nedenleri")->result(),
            "istek" => $izin, 
            "page" => "izin/form"
        ];
        $this->load->view('base_view', $viewData);
    }

    public function izin_iptal($id) {
        $user = $this->db->where('kullanici_id', $this->session->userdata('aktif_kullanici_id'))->get('kullanicilar')->row();
        $izin = $this->db->where('izin_talep_id', $id)->get('izin_talepleri')->row();

        if ($user->kullanici_grup_no != 1 && $izin->izin_talep_eden_kullanici_id != $user->kullanici_id) {
            $this->session->set_flashdata('flashDanger', "Sadece kendi talebinizi iptal edebilirsiniz.");
            redirect(site_url('izin/onay_bekleyenler'));
        }
        if (isset($izin->insan_kaynaklari_onay_durumu) && $izin->insan_kaynaklari_onay_durumu != 0) {
            $this->session->set_flashdata('flashDanger', "Onaylanan talep iptal edilemez.");
            redirect(site_url('izin/onay_bekleyenler'));
        }
        
        $this->db->where('izin_talep_id', $id)->update('izin_talepleri', ['izin_durumu' => 0]);
        $this->session->set_flashdata('flashSuccess', "İzin talebi başarıyla iptal edildi.");
        redirect(site_url('izin/onay_bekleyenler'));
    }

    private function update_status($id, $field, $status, $kullanici_id = null) {
        $updateData = [
            $field => $status,
            "{$field}_tarihi" => date('Y-m-d H:i:s')
        ];
        
        // Kullanıcı ID'si varsa ekle
        if ($kullanici_id !== null) {
            $updateData["{$field}_kullanici_id"] = $kullanici_id;
        }
        
        // Debug için log
        log_message('debug', "İzin güncelleme - ID: $id, Field: $field, Status: $status, Kullanici ID: " . ($kullanici_id ?? 'NULL'));
        log_message('debug', "Update Data: " . json_encode($updateData));
        
        $this->db->where('izin_talep_id', $id);
        $result = $this->db->update('izin_talepleri', $updateData);
        
        // Güncelleme sonrası kontrol
        $check = $this->db->where('izin_talep_id', $id)->get('izin_talepleri')->row();
        log_message('debug', "Güncelleme sonrası - amir_onay_durumu: " . ($check->amir_onay_durumu ?? 'NULL') . ", amir_onay_kullanici_id: " . ($check->amir_onay_kullanici_id ?? 'NULL'));
        
        return $result;
    }
    
    public function iptal_et($id) {
        $this->db->where('izin_talep_id', $id)->update('izin_talepleri', [
           "izin_durumu" => 0 
        ]);
        $this->session->set_flashdata('flashSuccess', "İzin talebi iptal edildi.");
        redirect(base_url('izin'));
    }
    
    // Amir onay fonksiyonları
    public function amir_onayla($id) {
        $user_id = $this->session->userdata('aktif_kullanici_id');
        $response=  $this->update_status($id, 'amir_onay_durumu', 1, $user_id);

        print_r($response);
        if($response){
            $this->session->set_flashdata('flashSuccess', "İzin talebi amir tarafından onaylandı.");
            redirect(base_url('izin'));
        }else{
            $this->session->set_flashdata('flashDanger', "İzin talebi amir tarafından onaylanamadı.");
            redirect(base_url('izin'));
        }
    }

    public function amir_reddet($id) {
        $user_id = $this->session->userdata('aktif_kullanici_id');
        $this->update_status($id, 'amir_onay_durumu', 2, $user_id);
        // Amir reddederse müdür onayına geçmesin, direkt reddedilmiş olsun
        $this->update_status($id, 'mudur_onay_durumu', 2, null);
        $this->session->set_flashdata('flashSuccess', "İzin talebi amir tarafından reddedildi.");
        redirect(base_url('izin'));
    }

    // Müdür onay fonksiyonları
    public function mudur_onayla($id) {
        // Önce amir onayını kontrol et
        $izin = $this->db->where('izin_talep_id', $id)->get('izin_talepleri')->row();
        if (empty($izin) || (isset($izin->amir_onay_durumu) && $izin->amir_onay_durumu != 1)) {
            $this->session->set_flashdata('flashDanger', "Önce amir onayı gereklidir.");
            redirect(base_url('izin'));
        }
        
        $user_id = $this->session->userdata('aktif_kullanici_id');
        $this->update_status($id, 'mudur_onay_durumu', 1, $user_id);
        $this->session->set_flashdata('flashSuccess', "İzin talebi müdür tarafından onaylandı.");
        redirect(base_url('izin'));
    }

    public function mudur_reddet($id) {
        // Önce amir onayını kontrol et
        $izin = $this->db->where('izin_talep_id', $id)->get('izin_talepleri')->row();
        if (empty($izin) || (isset($izin->amir_onay_durumu) && $izin->amir_onay_durumu != 1)) {
            $this->session->set_flashdata('flashDanger', "Önce amir onayı gereklidir.");
            redirect(base_url('izin'));
        }
        
        $user_id = $this->session->userdata('aktif_kullanici_id');
        $this->update_status($id, 'mudur_onay_durumu', 2, $user_id);
        $this->session->set_flashdata('flashSuccess', "İzin talebi müdür tarafından reddedildi.");
        redirect(base_url('izin'));
    }
}
