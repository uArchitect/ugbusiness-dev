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
            
            // Eğer bildirim bir izin talebi ile ilgiliyse, izin talebi ID'sini bul
            $izin_talep_id = null;
            if(!empty($bildirim[0]->tip_adi) && $bildirim[0]->tip_adi == 'İzin Bildirimi' && !empty($bildirim[0]->gonderen_id)){
                $izin_talebi = $this->db->select('izin_talepleri.izin_talep_id')
                                      ->from('sistem_bildirimleri')
                                      ->join('izin_talepleri', 'izin_talepleri.izin_talep_eden_kullanici_id = sistem_bildirimleri.gonderen_id')
                                      ->where('sistem_bildirimleri.id', $id)
                                      ->like('sistem_bildirimleri.baslik', 'İzin Talebi')
                                      ->order_by('izin_talepleri.izin_talep_id', 'desc')
                                      ->limit(1)
                                      ->get()
                                      ->row();
                if($izin_talebi){
                    $izin_talep_id = $izin_talebi->izin_talep_id;
                }
            }
            $viewData['izin_talep_id'] = $izin_talep_id;
            
            // Okunma durumunu kontrol et
            $kullanici_id = $this->session->userdata('aktif_kullanici_id');
            $okunma_durumu = $this->db->select('okundu')
                                     ->from('sistem_bildirim_alicilar')
                                     ->where('bildirim_id', $id)
                                     ->where('alici_id', $kullanici_id)
                                     ->get()
                                     ->row();
            $viewData['okunmamis'] = ($okunma_durumu && $okunma_durumu->okundu == 0);
            
            $viewData["page"] = "sistem_bildirimleri/detay";
            $this->load->view('base_view', $viewData);
        } else {
            redirect(site_url('sistem_bildirimleri'));
        }
    }
    
    public function okundu_isaretle($id)
    {
        $kullanici_id = $this->session->userdata('aktif_kullanici_id');
        
        // Bildirim bilgilerini al
        $bildirim = $this->Sistem_bildirimleri_model->get_by_id($id);
        if(!$bildirim || empty($bildirim)){
            if($this->input->is_ajax_request()){
                $this->output->set_content_type('application/json')->set_output(json_encode(['success' => false, 'message' => 'Bildirim bulunamadı']));
                return;
            }
            redirect(site_url('sistem_bildirimleri'));
            return;
        }
        
        $bildirim_data = $bildirim[0];
        
        // Eğer bildirim bir izin talebi ile ilgiliyse, tüm ilgili bildirimleri işaretle
        if(!empty($bildirim_data->tip_adi) && $bildirim_data->tip_adi == 'İzin Bildirimi' && !empty($bildirim_data->gonderen_id)){
            // İzin talebi ile ilişkili tüm bildirimleri bul
            $bildirimler = $this->db->select('sistem_bildirimleri.id')
                                   ->from('sistem_bildirimleri')
                                   ->join('sistem_bildirim_alicilar', 'sistem_bildirim_alicilar.bildirim_id = sistem_bildirimleri.id')
                                   ->where('sistem_bildirim_alicilar.alici_id', $kullanici_id)
                                   ->where('sistem_bildirim_alicilar.okundu', 0)
                                   ->where('sistem_bildirimleri.gonderen_id', $bildirim_data->gonderen_id)
                                   ->like('sistem_bildirimleri.baslik', 'İzin Talebi')
                                   ->get()
                                   ->result();
            
            $isaretlenen_sayisi = 0;
            
            // İlgili bildirimleri okundu olarak işaretle
            foreach($bildirimler as $bildirim_item){
                $this->db->where('bildirim_id', $bildirim_item->id)
                         ->where('alici_id', $kullanici_id)
                         ->update('sistem_bildirim_alicilar', ['okundu' => 1]);
                
                // Hareket kaydı ekle
                $this->db->insert('sistem_bildirim_hareketleri', [
                    'bildirim_id' => $bildirim_item->id,
                    'kullanici_id' => $kullanici_id,
                    'hareket_tipi' => 'goruldu',
                    'aciklama' => 'Bildirim detay sayfasından görüntülendi'
                ]);
                
                $isaretlenen_sayisi++;
            }
        } else {
            // Normal bildirim - sadece bu bildirimi işaretle
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
            
            $isaretlenen_sayisi = 1;
        }
        
        // AJAX isteği ise JSON döndür
        if($this->input->is_ajax_request()){
            $this->output->set_content_type('application/json')->set_output(json_encode([
                'success' => true, 
                'message' => $isaretlenen_sayisi . ' bildirim okundu olarak işaretlendi.'
            ]));
            return;
        }
        
        // Normal istek ise redirect yap
        $this->session->set_flashdata('flashSuccess', 'Bildirim okundu olarak işaretlendi.');
        redirect(site_url('sistem_bildirimleri/detay/'.$id));
    }
    
    public function tumunu_okundu_isaretle()
    {
        $kullanici_id = $this->session->userdata('aktif_kullanici_id');
        
        // Kullanıcının tüm okunmamış bildirimlerini bul
        $okunmamis_bildirimler = $this->db->select('sistem_bildirim_alicilar.bildirim_id')
                                          ->from('sistem_bildirim_alicilar')
                                          ->where('alici_id', $kullanici_id)
                                          ->where('okundu', 0)
                                          ->get()
                                          ->result();
        
        $isaretlenen_sayisi = 0;
        
        // Tüm okunmamış bildirimleri okundu olarak işaretle
        foreach($okunmamis_bildirimler as $bildirim_item){
            $this->db->where('bildirim_id', $bildirim_item->bildirim_id)
                     ->where('alici_id', $kullanici_id)
                     ->update('sistem_bildirim_alicilar', [
                         'okundu' => 1
                     ]);
            
            // Hareket kaydı ekle
            $this->db->insert('sistem_bildirim_hareketleri', [
                'bildirim_id' => $bildirim_item->bildirim_id,
                'kullanici_id' => $kullanici_id,
                'hareket_tipi' => 'goruldu',
                'aciklama' => 'Tümünü okudum butonu ile toplu olarak işaretlendi'
            ]);
            
            $isaretlenen_sayisi++;
        }
        
        // AJAX isteği ise JSON döndür
        if($this->input->is_ajax_request()){
            $this->output->set_content_type('application/json')->set_output(json_encode([
                'success' => true, 
                'message' => $isaretlenen_sayisi . ' bildirim okundu olarak işaretlendi.',
                'count' => $isaretlenen_sayisi
            ]));
            return;
        }
        
        // Normal istek ise redirect yap
        $this->session->set_flashdata('flashSuccess', $isaretlenen_sayisi . ' bildirim okundu olarak işaretlendi.');
        redirect(site_url('sistem_bildirimleri'));
    }
    
    public function onayla($id)
    {
        // yetki_kontrol("sistem_bildirimleri_onayla");
        
        $kullanici_id = $this->session->userdata('aktif_kullanici_id');
        
        // Bildirim bilgilerini al
        $bildirim = $this->Sistem_bildirimleri_model->get_by_id($id);
        if(!$bildirim || empty($bildirim)){
            $this->session->set_flashdata('flashDanger', 'Bildirim bulunamadı.');
            redirect(site_url('sistem_bildirimleri'));
            return;
        }
        
        $bildirim_data = $bildirim[0];
        
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
        
        // Eğer bildirim bir izin talebi ile ilgiliyse, personelin son izin talebini güncelle
        if(!empty($bildirim_data->tip_adi) && $bildirim_data->tip_adi == 'İzin Bildirimi' && !empty($bildirim_data->gonderen_id)){
            // Personelin son izin talebini bul (amir onayı bekleyen en son izin talebi)
            $this->db->select('izin_talepleri.izin_talep_id')
                     ->from('izin_talepleri')
                     ->where('izin_talepleri.izin_talep_eden_kullanici_id', $bildirim_data->gonderen_id)
                     ->where('izin_talepleri.izin_durumu', 1) // Aktif izin talepleri
                     ->group_start()
                         ->where('izin_talepleri.amir_onay_durumu', NULL)
                         ->or_where('izin_talepleri.amir_onay_durumu', 0)
                     ->group_end()
                     ->order_by('izin_talepleri.izin_talep_id', 'desc')
                     ->limit(1);
            
            $izin_talebi = $this->db->get()->row();
            
            if($izin_talebi){
                // AMİR ONAYI: İzin talebinin amir onay bilgilerini güncelle
                $this->db->where('izin_talep_id', $izin_talebi->izin_talep_id)
                         ->update('izin_talepleri', [
                             'amir_onay_durumu' => 1,
                             'amir_onay_tarihi' => date('Y-m-d H:i:s'),
                             'amir_onay_kullanici_id' => $kullanici_id
                         ]);
                
                // Amir onayladıktan sonra MÜDÜRE bildirim gönder (ID: 9)
                $mudur_id = 9;
                $this->mudur_onay_bildirimi_gonder($izin_talebi->izin_talep_id, $bildirim_data->gonderen_id, $mudur_id);
            }
        }
        
        // Eğer bildirim bir MÜDÜR onayı ile ilgiliyse
        if(!empty($bildirim_data->tip_adi) && $bildirim_data->tip_adi == 'İzin Müdür Onay Bildirimi' && !empty($bildirim_data->gonderen_id)){
            // Personelin müdür onayı bekleyen izin talebini bul
            $this->db->select('izin_talepleri.izin_talep_id')
                     ->from('izin_talepleri')
                     ->where('izin_talepleri.izin_talep_eden_kullanici_id', $bildirim_data->gonderen_id)
                     ->where('izin_talepleri.izin_durumu', 1)
                     ->where('izin_talepleri.amir_onay_durumu', 1) // Amir onaylamış
                     ->group_start()
                         ->where('izin_talepleri.mudur_onay_durumu', NULL)
                         ->or_where('izin_talepleri.mudur_onay_durumu', 0)
                     ->group_end()
                     ->order_by('izin_talepleri.izin_talep_id', 'desc')
                     ->limit(1);
            
            $izin_talebi = $this->db->get()->row();
            
            if($izin_talebi){
                // MÜDÜR ONAYI: İzin talebinin müdür onay bilgilerini güncelle
                $this->db->where('izin_talep_id', $izin_talebi->izin_talep_id)
                         ->update('izin_talepleri', [
                             'mudur_onay_durumu' => 1,
                             'mudur_onay_tarihi' => date('Y-m-d H:i:s'),
                             'mudur_onay_kullanici_id' => $kullanici_id
                         ]);
                
                // Müdür onayladıktan sonra personele onay bildirimi gönder
                $this->izin_onay_bildirimi_gonder($izin_talebi->izin_talep_id, $bildirim_data->gonderen_id, $kullanici_id);
            }
        }
        
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
    
    /**
     * Amir onayladıktan sonra müdüre bildirim gönder
     */
    private function mudur_onay_bildirimi_gonder($izin_talep_id, $personel_id, $mudur_id){
        // Bildirim tipi ID'sini al (İzin Müdür Onay Bildirimi)
        $bildirim_tipi = $this->db->where('ad', 'İzin Müdür Onay Bildirimi')
                                  ->get('bildirim_tipleri')
                                  ->row();
        
        if(!$bildirim_tipi){
            // Bildirim tipi yoksa oluştur
            $this->db->insert('bildirim_tipleri', [
                'ad' => 'İzin Müdür Onay Bildirimi',
                'gereken_onay_seviyesi' => 2,
                'aciklama' => 'Amir onayından sonra müdür onayı için gönderilen bildirim'
            ]);
            $tip_id = $this->db->insert_id();
        } else {
            $tip_id = $bildirim_tipi->id;
        }
        
        // Personel bilgilerini al
        $personel = $this->db->where('kullanici_id', $personel_id)
                            ->get('kullanicilar')
                            ->row();
        
        // İzin bilgilerini al
        $izin = $this->db->where('izin_talep_id', $izin_talep_id)
                        ->get('izin_talepleri')
                        ->row();
        
        // İzin nedeni bilgisini al
        $izin_nedeni = '';
        if($izin && !empty($izin->izin_neden_no)){
            $neden = $this->db->where('izin_neden_id', $izin->izin_neden_no)
                             ->get('izin_nedenleri')
                             ->row();
            if($neden){
                $izin_nedeni = $neden->izin_neden_detay;
            }
        }
        
        // Bildirim başlığı ve mesajı
        $baslik = 'İzin Talebi - Müdür Onayı Bekleniyor';
        $mesaj = 'Sayın Genel Müdürümüz,';
        $mesaj .= "\n\n" . ($personel ? $personel->kullanici_ad_soyad : 'Bir personel') . ' tarafından oluşturulan izin talebi amir onayından geçmiştir.';
        $mesaj .= "\nMüdür onayınız beklenmektedir.";
        
        if($izin){
            $mesaj .= "\n\nİzin Detayları:";
            if($izin_nedeni){
                $mesaj .= "\nİzin Nedeni: " . $izin_nedeni;
            }
            $mesaj .= "\nBaşlangıç: " . date('d.m.Y H:i', strtotime($izin->izin_baslangic_tarihi));
            $mesaj .= "\nBitiş: " . date('d.m.Y H:i', strtotime($izin->izin_bitis_tarihi));
            if(!empty($izin->izin_notu)){
                $mesaj .= "\nNot: " . $izin->izin_notu;
            }
        }
        
        // Bildirim oluştur
        $this->db->insert('sistem_bildirimleri', [
            'tip_id' => $tip_id,
            'gonderen_id' => $personel_id,
            'baslik' => $baslik,
            'mesaj' => $mesaj,
            'okundu' => 0,
            'onay_durumu' => 'pending'
        ]);
        $bildirim_id = $this->db->insert_id();
        
        // Müdüre bildirim gönder
        $this->db->insert('sistem_bildirim_alicilar', [
            'bildirim_id' => $bildirim_id,
            'alici_id' => $mudur_id,
            'okundu' => 0
        ]);
        
        // Hareket kaydı ekle
        $this->db->insert('sistem_bildirim_hareketleri', [
            'bildirim_id' => $bildirim_id,
            'kullanici_id' => $personel_id,
            'hareket_tipi' => 'gonderildi',
            'aciklama' => 'Müdür onayı için bildirim gönderildi - İzin ID: ' . $izin_talep_id
        ]);
    }
    
    /**
     * İzin onaylandığında personele bildirim gönder
     */
    private function izin_onay_bildirimi_gonder($izin_talep_id, $personel_id, $onaylayan_id){
        // Bildirim tipi ID'sini al (İzin Onay Bildirimi)
        $bildirim_tipi = $this->db->where('ad', 'İzin Onay Bildirimi')
                                  ->get('bildirim_tipleri')
                                  ->row();
        
        if(!$bildirim_tipi){
            // Bildirim tipi yoksa oluştur
            $this->db->insert('bildirim_tipleri', [
                'ad' => 'İzin Onay Bildirimi',
                'gereken_onay_seviyesi' => 0,
                'aciklama' => 'İzin talebi onaylandığında personele gönderilen bildirim'
            ]);
            $tip_id = $this->db->insert_id();
        } else {
            $tip_id = $bildirim_tipi->id;
        }
        
        // Personel bilgilerini al
        $personel = $this->db->where('kullanici_id', $personel_id)
                            ->get('kullanicilar')
                            ->row();
        
        // Onaylayan kişi bilgilerini al
        $onaylayan = $this->db->where('kullanici_id', $onaylayan_id)
                             ->get('kullanicilar')
                             ->row();
        
        // İzin bilgilerini al
        $izin = $this->db->where('izin_talep_id', $izin_talep_id)
                        ->get('izin_talepleri')
                        ->row();
        
        // İzin nedeni bilgisini al
        $izin_nedeni = '';
        if($izin && !empty($izin->izin_neden_no)){
            $neden = $this->db->where('izin_neden_id', $izin->izin_neden_no)
                             ->get('izin_nedenleri')
                             ->row();
            if($neden){
                $izin_nedeni = $neden->izin_neden_detay;
            }
        }
        
        // Bildirim başlığı ve mesajı
        $baslik = 'İzin Talebiniz Onaylandı';
        $mesaj = 'Sayın ' . ($personel ? $personel->kullanici_ad_soyad : 'Personel') . ',';
        $mesaj .= "\n\nİzin talebiniz onaylanmıştır.";
        
        if($onaylayan){
            $mesaj .= "\n\nOnaylayan: " . $onaylayan->kullanici_ad_soyad;
        }
        
        if($izin){
            $mesaj .= "\n\nİzin Detayları:";
            if($izin_nedeni){
                $mesaj .= "\nİzin Nedeni: " . $izin_nedeni;
            }
            $mesaj .= "\nBaşlangıç: " . date('d.m.Y H:i', strtotime($izin->izin_baslangic_tarihi));
            $mesaj .= "\nBitiş: " . date('d.m.Y H:i', strtotime($izin->izin_bitis_tarihi));
            if(!empty($izin->izin_notu)){
                $mesaj .= "\nNot: " . $izin->izin_notu;
            }
        }
        
        $mesaj .= "\n\nOnay Tarihi: " . date('d.m.Y H:i');
        
        // Bildirim oluştur
        $this->db->insert('sistem_bildirimleri', [
            'tip_id' => $tip_id,
            'gonderen_id' => $onaylayan_id,
            'baslik' => $baslik,
            'mesaj' => $mesaj,
            'okundu' => 0,
            'onay_durumu' => 'approved' // Onay bildirimi zaten onaylı durumda
        ]);
        $bildirim_id = $this->db->insert_id();
        
        // Personele bildirim gönder
        $this->db->insert('sistem_bildirim_alicilar', [
            'bildirim_id' => $bildirim_id,
            'alici_id' => $personel_id,
            'okundu' => 0
        ]);
        
        // Hareket kaydı ekle
        $this->db->insert('sistem_bildirim_hareketleri', [
            'bildirim_id' => $bildirim_id,
            'kullanici_id' => $onaylayan_id,
            'hareket_tipi' => 'gonderildi',
            'aciklama' => 'İzin onay bildirimi gönderildi - İzin ID: ' . $izin_talep_id
        ]);
    }
}

