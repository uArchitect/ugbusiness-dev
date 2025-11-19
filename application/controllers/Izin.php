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


        
        $user = $this->Kullanici_model->get_by_id($this->session->userdata('aktif_kullanici_id'))[0];
        $viewData = [
            "istekler" => $this->Izin_model->get_all(
                ["izin_onaylayacak_sorumlu_id = $user->kullanici_id"],
                ["izin_talep_eden_kullanici_id = $user->kullanici_id"]),
                  "kullanicilar" => $this->db->where("kullanici_aktif",1)->get("kullanicilar")->result(),
            "nedenler" => $this->db->get("izin_nedenleri")->result(),
             
            "page" => "izin/list"
        ];




         
        $this->db->select('kullanicilar.kullanici_ad_soyad,kullanicilar.kullanici_id,stajyer_id,pazartesi,sali,carsamba,persembe,cuma', false);
        $this->db->from('stajyerler'); 
        $this->db->join('kullanicilar', 'kullanicilar.kullanici_id = stajyer_kullanici_id');
        $viewData["stajyerler"] = $this->db->get()->result();
    

  $this->db->order_by("kullanici_ad_soyad","asc");
        $data = $this->Kullanici_model->get_all(["kullanici_aktif"=>1,"mesai_takip_kontrolü"=>1]);    
$viewData["takipkullanicilar"] = $data;


        $this->load->view('base_view', $viewData);
    }



public function staj_durum_degistir($id,$gun,$durum) {
       $updateData[$gun] = $durum;
       $this->db->where("stajyer_id",$id)->update("stajyerler",$updateData);
       redirect(base_url("izin"));
       
    }




    public function add() {
        $user = $this->Kullanici_model->get_by_id($this->session->userdata('aktif_kullanici_id'))[0];
        $viewData = [
            "kullanicilar" => $this->db->where("kullanici_aktif",1)->get("kullanicilar")->result(),
            "nedenler" => $this->db->get("izin_nedenleri")->result(),
             
            "page" => "izin/form"
        ];
        $this->load->view('base_view', $viewData);
    }

    public function save() {
        // İzin talebini kaydet
        $this->db->insert("izin_talepleri", $this->input->post());
        $izin_talep_id = $this->db->insert_id();
        
        // Bildirim gönderme mantığı
        $talep_eden_kullanici_id = $this->input->post('izin_talep_eden_kullanici_id');
        if(empty($talep_eden_kullanici_id)){
            $talep_eden_kullanici_id = $this->session->userdata('aktif_kullanici_id');
        }
        
        // Personel bilgilerini al
        $personel = $this->db->where('kullanici_id', $talep_eden_kullanici_id)
                            ->get('kullanicilar')
                            ->row();
        
        if($personel && !empty($personel->mesai_departman_no)){
            // Departman bilgilerini al
            $departman = $this->db->where('departman_id', $personel->mesai_departman_no)
                                 ->get('departmanlar')
                                 ->row();
            
            if($departman && !empty($departman->departman_sorumlu_kullanici_id)){
                $amir_id = $departman->departman_sorumlu_kullanici_id;
                
                // Eğer amiri kendisi değilse amirine bildirim gönder
                if($amir_id != $talep_eden_kullanici_id){
                    $this->izin_bildirimi_gonder($izin_talep_id, $talep_eden_kullanici_id, $amir_id);
                } else {
                    // Eğer amiri kendisi ise üst yöneticiye gönder (ID 1)
                    $ust_yonetici_id = 1;
                    if($ust_yonetici_id != $talep_eden_kullanici_id){
                        $this->izin_bildirimi_gonder($izin_talep_id, $talep_eden_kullanici_id, $ust_yonetici_id);
                    }
                }
            } else {
                // Departman yöneticisi yoksa üst yöneticiye gönder
                $ust_yonetici_id = 1;
                if($ust_yonetici_id != $talep_eden_kullanici_id){
                    $this->izin_bildirimi_gonder($izin_talep_id, $talep_eden_kullanici_id, $ust_yonetici_id);
                }
            }
        } else {
            // Departman bilgisi yoksa üst yöneticiye gönder
            $ust_yonetici_id = 1;
            if($ust_yonetici_id != $talep_eden_kullanici_id){
                $this->izin_bildirimi_gonder($izin_talep_id, $talep_eden_kullanici_id, $ust_yonetici_id);
            }
        }
        
        redirect("izin");
    }
    
    /**
     * İzin talebi bildirimi gönder
     */
    private function izin_bildirimi_gonder($izin_talep_id, $talep_eden_kullanici_id, $alici_id){
        // Bildirim tipi ID'sini al (İzin Bildirimi)
        $bildirim_tipi = $this->db->where('ad', 'İzin Bildirimi')
                                  ->get('bildirim_tipleri')
                                  ->row();
        
        if(!$bildirim_tipi){
            // Bildirim tipi yoksa oluştur
            $this->db->insert('bildirim_tipleri', [
                'ad' => 'İzin Bildirimi',
                'gereken_onay_seviyesi' => 2,
                'aciklama' => 'İzin talepleri için müdür onayı gerekir'
            ]);
            $tip_id = $this->db->insert_id();
        } else {
            $tip_id = $bildirim_tipi->id;
        }
        
        // Personel bilgilerini al
        $personel = $this->db->where('kullanici_id', $talep_eden_kullanici_id)
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
        $baslik = 'Yeni İzin Talebi';
        $mesaj = ($personel ? $personel->kullanici_ad_soyad : 'Bir personel') . ' tarafından yeni bir izin talebi oluşturuldu.';
        if($izin){
            $mesaj .= "\n\nİzin Nedeni: " . $izin_nedeni;
            $mesaj .= "\nBaşlangıç: " . date('d.m.Y H:i', strtotime($izin->izin_baslangic_tarihi));
            $mesaj .= "\nBitiş: " . date('d.m.Y H:i', strtotime($izin->izin_bitis_tarihi));
            if(!empty($izin->izin_notu)){
                $mesaj .= "\nNot: " . $izin->izin_notu;
            }
        }
        
        // Bildirim oluştur
        $this->db->insert('sistem_bildirimleri', [
            'tip_id' => $tip_id,
            'gonderen_id' => $talep_eden_kullanici_id,
            'baslik' => $baslik,
            'mesaj' => $mesaj,
            'okundu' => 0,
            'onay_durumu' => 'pending'
        ]);
        $bildirim_id = $this->db->insert_id();
        
        // Alıcıya bildirim gönder
        $this->db->insert('sistem_bildirim_alicilar', [
            'bildirim_id' => $bildirim_id,
            'alici_id' => $alici_id,
            'okundu' => 0
        ]);
        
        // Hareket kaydı ekle
        $this->db->insert('sistem_bildirim_hareketleri', [
            'bildirim_id' => $bildirim_id,
            'kullanici_id' => $talep_eden_kullanici_id,
            'hareket_tipi' => 'gonderildi',
            'aciklama' => 'İzin talebi bildirimi gönderildi'
        ]);
    }


    public function detay($id = '') {
        $izin = $this->Izin_model->get_by_id($id);
        if($izin && !empty($izin)){
            $viewData = [
                "izin" => $izin[0],
                "page" => "izin/detay"
            ];
            $this->load->view('base_view', $viewData);
        } else {
            redirect(site_url('izin'));
        }
    }
    
    public function okundu_isaretle($id) {
        $kullanici_id = $this->session->userdata('aktif_kullanici_id');
        
        // İzin talebi bilgilerini al
        $izin = $this->Izin_model->get_by_id($id);
        if(!$izin || empty($izin)){
            if($this->input->is_ajax_request()){
                $this->output->set_content_type('application/json')->set_output(json_encode(['success' => false, 'message' => 'İzin talebi bulunamadı']));
                return;
            }
            redirect(site_url('izin'));
            return;
        }
        
        $izin_data = $izin[0];
        
        // İzin talebi ile ilişkili bildirimleri bul
        $bildirimler = $this->db->select('sistem_bildirimleri.id')
                               ->from('sistem_bildirimleri')
                               ->join('sistem_bildirim_alicilar', 'sistem_bildirim_alicilar.bildirim_id = sistem_bildirimleri.id')
                               ->where('sistem_bildirim_alicilar.alici_id', $kullanici_id)
                               ->where('sistem_bildirim_alicilar.okundu', 0)
                               ->where('sistem_bildirimleri.gonderen_id', $izin_data->izin_talep_eden_kullanici_id)
                               ->like('sistem_bildirimleri.baslik', 'İzin Talebi')
                               ->get()
                               ->result();
        
        $isaretlenen_sayisi = 0;
        
        // İlgili bildirimleri okundu olarak işaretle
        foreach($bildirimler as $bildirim){
            $this->db->where('bildirim_id', $bildirim->id)
                     ->where('alici_id', $kullanici_id)
                     ->update('sistem_bildirim_alicilar', ['okundu' => 1]);
            
            // Hareket kaydı ekle
            $this->db->insert('sistem_bildirim_hareketleri', [
                'bildirim_id' => $bildirim->id,
                'kullanici_id' => $kullanici_id,
                'hareket_tipi' => 'goruldu',
                'aciklama' => 'İzin talebi detay sayfasından görüntülendi'
            ]);
            
            $isaretlenen_sayisi++;
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
        redirect(site_url('izin/detay/'.$id));
    }

    public function edit($id = '') {
         $izin = $this->Izin_model->get_by_id($id)[0];
 
        $viewData = [
             "kullanicilar" => $this->db->where("kullanici_aktif",1)->get("kullanicilar")->result(),
            "nedenler" => $this->db->get("izin_nedenleri")->result(),
             
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
        
        // İzin talebini iptal et
        $this->Izin_model->update($id, ['izin_durumu' => 0]);
        
        // SADECE BU İZNE AİT bildirimleri sil
        $this->izin_talep_bildirimlerini_sil($izin->izin_talep_eden_kullanici_id, $id);
        
        $this->session->set_flashdata('flashSuccess', "İzin talebi ve ilgili bildirimler başarıyla iptal edildi.");
        redirect(site_url('izin/onay_bekleyenler'));
    }

    private function update_status($id, $field, $status) {
        $this->Izin_model->update($id, [
            $field => $status,
            "{$field}_tarihi" => date('Y-m-d H:i:s')
        ]);
    }
    public function iptal_et($id) {
        // İzin bilgilerini al
        $izin = $this->Izin_model->get_by_id($id);
        
        if($izin && !empty($izin)){
            $izin_data = $izin[0];
            
            // İzin talebini iptal et
            $this->Izin_model->update($id, [
               "izin_durumu" => 0 
            ]);
            
            // SADECE BU İZNE AİT bildirimleri sil
            $this->izin_talep_bildirimlerini_sil($izin_data->izin_talep_eden_kullanici_id, $id);
            
            $this->session->set_flashdata('flashSuccess', 'İzin talebi ve ilgili bildirimler başarıyla iptal edildi.');
        } else {
            $this->session->set_flashdata('flashDanger', 'İzin talebi bulunamadı.');
        }
        
        redirect(base_url('izin'));
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

    /**
     * SADECE belirli bir izin talebine ait bildirimleri sil
     * @param int $talep_eden_kullanici_id - İzin talebini oluşturan kullanıcı ID
     * @param int $izin_talep_id - Silinecek izin talebi ID
     */
    private function izin_talep_bildirimlerini_sil($talep_eden_kullanici_id, $izin_talep_id){
        // Bu izin talebine ait bildirimleri bul
        // Bildirimler ilişkilendirilirken izin_talep_id açıkça saklanmadığı için 
        // tarih ve gönderen bilgisine göre eşleştirme yapacağız
        
        // İzin talebi bilgilerini al
        $izin = $this->db->where('izin_talep_id', $izin_talep_id)
                        ->get('izin_talepleri')
                        ->row();
        
        if(!$izin){
            return 0;
        }
        
        // İzin talebi oluşturma zamanına yakın (±1 saat) bildirimleri bul
        $izin_kayit_tarihi = $izin->izin_kayit_tarihi;
        $baslangic = date('Y-m-d H:i:s', strtotime($izin_kayit_tarihi . ' -1 hour'));
        $bitis = date('Y-m-d H:i:s', strtotime($izin_kayit_tarihi . ' +1 hour'));
        
        // 1. Amire gönderilen talep bildirimlerini bul
        $talep_bildirimleri = $this->db->select('sistem_bildirimleri.id')
                                      ->from('sistem_bildirimleri')
                                      ->join('bildirim_tipleri', 'bildirim_tipleri.id = sistem_bildirimleri.tip_id')
                                      ->where('sistem_bildirimleri.gonderen_id', $talep_eden_kullanici_id)
                                      ->where('bildirim_tipleri.ad', 'İzin Bildirimi')
                                      ->where('sistem_bildirimleri.created_at >=', $baslangic)
                                      ->where('sistem_bildirimleri.created_at <=', $bitis)
                                      ->get()
                                      ->result();
        
        // 2. Müdüre gönderilen onay bildirimlerini bul (amir onayladıysa)
        $mudur_bildirimleri = $this->db->select('sistem_bildirimleri.id')
                                       ->from('sistem_bildirimleri')
                                       ->join('bildirim_tipleri', 'bildirim_tipleri.id = sistem_bildirimleri.tip_id')
                                       ->where('sistem_bildirimleri.gonderen_id', $talep_eden_kullanici_id)
                                       ->where('bildirim_tipleri.ad', 'İzin Müdür Onay Bildirimi')
                                       ->get()
                                       ->result();
        
        // 3. Personele gönderilen onay bildirimlerini bul (müdür onayladıysa)
        $onay_bildirimleri = $this->db->select('sistem_bildirimleri.id')
                                     ->from('sistem_bildirimleri')
                                     ->join('bildirim_tipleri', 'bildirim_tipleri.id = sistem_bildirimleri.tip_id')
                                     ->join('sistem_bildirim_alicilar', 'sistem_bildirim_alicilar.bildirim_id = sistem_bildirimleri.id')
                                     ->where('sistem_bildirim_alicilar.alici_id', $talep_eden_kullanici_id)
                                     ->where('bildirim_tipleri.ad', 'İzin Onay Bildirimi')
                                     ->like('sistem_bildirimleri.baslik', 'İzin Talebiniz Onaylandı')
                                     ->get()
                                     ->result();
        
        // Tüm bildirimleri birleştir
        $tum_bildirimler = array_merge($talep_bildirimleri, $mudur_bildirimleri, $onay_bildirimleri);
        
        $silinen_sayi = 0;
        
        // Bildirimleri ve ilişkili kayıtları sil
        foreach($tum_bildirimler as $bildirim){
            $bildirim_id = $bildirim->id;
            
            // 1. Alıcı ilişkilerini sil
            $this->db->where('bildirim_id', $bildirim_id)
                     ->delete('sistem_bildirim_alicilar');
            
            // 2. Hareket kayıtlarını sil
            $this->db->where('bildirim_id', $bildirim_id)
                     ->delete('sistem_bildirim_hareketleri');
            
            // 3. Ana bildirim kaydını sil
            $this->db->where('id', $bildirim_id)
                     ->delete('sistem_bildirimleri');
            
            $silinen_sayi++;
        }
        
        return $silinen_sayi;
    }
    
    /**
     * Yetkisiz kullanıcılar için izin talebi oluşturma sayfası
     */
    public function talebi_olustur() {
        $aktif_kullanici_id = $this->session->userdata('aktif_kullanici_id');
        
        // Kullanıcının geçmiş izin taleplerini çek (izin listesi sayfasıyla aynı alanları çek)
        $gecmis_izinler = $this->db->select('izin_talepleri.*,
                                   izin_nedenleri.izin_neden_detay,
                                   amir_kullanici.kullanici_ad_soyad as amir_ad_soyad,
                                   amir_kullanici.kullanici_id as amir_kullanici_id')
                        ->from('izin_talepleri')
                        ->join('izin_nedenleri', 'izin_nedenleri.izin_neden_id = izin_talepleri.izin_neden_no', 'left')
                        ->join('kullanicilar as amir_kullanici', 'amir_kullanici.kullanici_id = izin_talepleri.amir_onay_kullanici_id', 'left')
                        ->where('izin_talepleri.izin_talep_eden_kullanici_id', $aktif_kullanici_id)
                        ->order_by('izin_talepleri.izin_talep_id', 'desc')
                        ->get()
                        ->result();
        
        $viewData = [
            "nedenler" => $this->db->get("izin_nedenleri")->result(),
            "gecmis_izinler" => $gecmis_izinler,
            "page" => "izin/talebi_olustur"
        ];
        $this->load->view('base_view', $viewData);
    }

    /**
     * Yetkisiz kullanıcılar için izin talebi kaydetme
     */
    public function talebi_kaydet() {
        // Aktif kullanıcı ID'sini al
        $aktif_kullanici_id = $this->session->userdata('aktif_kullanici_id');
        
        if(empty($aktif_kullanici_id)) {
            $this->session->set_flashdata('flashDanger', 'Oturum bulunamadı. Lütfen tekrar giriş yapın.');
            redirect(site_url('izin/talebi_olustur'));
            return;
        }

        // Form verilerini al
        $data = [
            'izin_talep_eden_kullanici_id' => $aktif_kullanici_id,
            'izin_baslangic_tarihi' => $this->input->post('izin_baslangic_tarihi'),
            'izin_bitis_tarihi' => $this->input->post('izin_bitis_tarihi'),
            'izin_neden_no' => $this->input->post('izin_neden_no'),
            'izin_notu' => $this->input->post('izin_notu')
        ];

        // İzin talebini kaydet
        $this->db->insert("izin_talepleri", $data);
        $izin_talep_id = $this->db->insert_id();
        
        // Bildirim gönderme mantığı
        $personel = $this->db->where('kullanici_id', $aktif_kullanici_id)
                            ->get('kullanicilar')
                            ->row();
        
        if($personel && !empty($personel->mesai_departman_no)){
            // Departman bilgilerini al
            $departman = $this->db->where('departman_id', $personel->mesai_departman_no)
                                 ->get('departmanlar')
                                 ->row();
            
            if($departman && !empty($departman->departman_sorumlu_kullanici_id)){
                $amir_id = $departman->departman_sorumlu_kullanici_id;
                
                // Eğer amiri kendisi değilse amirine bildirim gönder
                if($amir_id != $aktif_kullanici_id){
                    $this->izin_bildirimi_gonder($izin_talep_id, $aktif_kullanici_id, $amir_id);
                } else {
                    // Eğer amiri kendisi ise üst yöneticiye gönder (ID 1)
                    $ust_yonetici_id = 1;
                    if($ust_yonetici_id != $aktif_kullanici_id){
                        $this->izin_bildirimi_gonder($izin_talep_id, $aktif_kullanici_id, $ust_yonetici_id);
                    }
                }
            } else {
                // Departman yöneticisi yoksa üst yöneticiye gönder
                $ust_yonetici_id = 1;
                if($ust_yonetici_id != $aktif_kullanici_id){
                    $this->izin_bildirimi_gonder($izin_talep_id, $aktif_kullanici_id, $ust_yonetici_id);
                }
            }
        } else {
            // Departman bilgisi yoksa üst yöneticiye gönder
            $ust_yonetici_id = 1;
            if($ust_yonetici_id != $aktif_kullanici_id){
                $this->izin_bildirimi_gonder($izin_talep_id, $aktif_kullanici_id, $ust_yonetici_id);
            }
        }
        
        $this->session->set_flashdata('flashSuccess', 'İzin talebiniz başarıyla oluşturuldu.');
        redirect(site_url('izin/talebi_olustur'));
    }
}
