<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sistem_bildirimleri extends CI_Controller {
    function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Sistem_bildirimleri_model'); 
        date_default_timezone_set('Europe/Istanbul');
    }
 
    public function index()
    {
        // Yetki kontrolü opsiyonel - eğer yetki yoksa sadece kendi bildirimlerini görsün
        // yetki_kontrol("sistem_bildirimleri_goruntule");
        
        $kullanici_id = $this->session->userdata('aktif_kullanici_id');
        $bildirimler = $this->Sistem_bildirimleri_model->get_kullanici_bildirimleri($kullanici_id);
        
        $viewData = [
            "bildirimler" => $bildirimler,
            "page" => "sistem_bildirimleri/list"
        ];
        
        $this->load->view('base_view', $viewData);
    }
    
    public function detay($id = '')
    {
        // yetki_kontrol("sistem_bildirimleri_goruntule");
        
        $bildirim = $this->Sistem_bildirimleri_model->get_by_id($id);
        if($bildirim){
            $viewData['bildirim'] = $bildirim[0];
            
            // Hareket geçmişini getir
            $hareketler = $this->db->select('sistem_bildirim_hareketleri.*,
                                             kullanicilar.kullanici_ad_soyad')
                                   ->from('sistem_bildirim_hareketleri')
                                   ->join('kullanicilar', 'kullanicilar.kullanici_id = sistem_bildirim_hareketleri.kullanici_id')
                                   ->where('sistem_bildirim_hareketleri.bildirim_id', $id)
                                   ->order_by('sistem_bildirim_hareketleri.created_at', 'asc')
                                   ->get()
                                   ->result();
            $viewData['hareketler'] = $hareketler;
            
            $viewData["page"] = "sistem_bildirimleri/detay";
            $this->load->view('base_view', $viewData);
        } else {
            redirect(site_url('sistem_bildirimleri'));
        }
    }
    
    public function okundu_isaretle($id)
    {
        $kullanici_id = $this->session->userdata('aktif_kullanici_id');
        
        // Alıcı tablosunda okundu olarak işaretle
        $this->db->where('bildirim_id', $id)
                 ->where('alici_id', $kullanici_id)
                 ->update('sistem_bildirim_alicilar', ['okundu' => 1]);
        
        // Hareket kaydı ekle
        $this->db->insert('sistem_bildirim_hareketleri', [
            'bildirim_id' => $id,
            'kullanici_id' => $kullanici_id,
            'hareket_tipi' => 'goruldu',
            'aciklama' => 'Bildirim görüntülendi'
        ]);
        
        redirect(site_url('sistem_bildirimleri/detay/'.$id));
    }
    
    public function onayla($id)
    {
        // yetki_kontrol("sistem_bildirimleri_onayla");
        
        $kullanici_id = $this->session->userdata('aktif_kullanici_id');
        
        // Bildirimi onayla
        $this->Sistem_bildirimleri_model->update($id, [
            'onay_durumu' => 'approved',
            'onaylayan_id' => $kullanici_id,
            'onaylanma_tarihi' => date('Y-m-d H:i:s')
        ]);
        
        // Hareket kaydı ekle
        $this->db->insert('sistem_bildirim_hareketleri', [
            'bildirim_id' => $id,
            'kullanici_id' => $kullanici_id,
            'hareket_tipi' => 'onaylandi',
            'aciklama' => 'Bildirim onaylandı'
        ]);
        
        $this->session->set_flashdata('flashSuccess', 'Bildirim başarıyla onaylandı.');
        redirect(site_url('sistem_bildirimleri'));
    }
    
    public function reddet($id)
    {
        // yetki_kontrol("sistem_bildirimleri_onayla");
        
        $kullanici_id = $this->session->userdata('aktif_kullanici_id');
        
        // Bildirimi reddet
        $this->Sistem_bildirimleri_model->update($id, [
            'onay_durumu' => 'rejected',
            'onaylayan_id' => $kullanici_id,
            'onaylanma_tarihi' => date('Y-m-d H:i:s')
        ]);
        
        // Hareket kaydı ekle
        $this->db->insert('sistem_bildirim_hareketleri', [
            'bildirim_id' => $id,
            'kullanici_id' => $kullanici_id,
            'hareket_tipi' => 'reddedildi',
            'aciklama' => 'Bildirim reddedildi'
        ]);
        
        $this->session->set_flashdata('flashSuccess', 'Bildirim reddedildi.');
        redirect(site_url('sistem_bildirimleri'));
    }
}

