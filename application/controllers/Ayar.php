<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ayar extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Ayar_model');  
        date_default_timezone_set('Europe/Istanbul');
    }
 
    public function index()
	{     
        yetki_kontrol("sistem_ayar_duzenle"); 
        $ayar = $this->Ayar_model->get_by_id(1);
        $viewData["ayar"] = $ayar[0];
        $viewData["page"] = "ayar/form";
		$this->load->view('base_view',$viewData);
	}

    public function save($id)
	{   
        yetki_kontrol("sistem_ayar_duzenle"); 
        $data['netgsm_kullanici_ad']          = escape($this->input->post('netgsm_kullanici_ad'));
        $data['netgsm_kullanici_sifre']       = base64_encode(escape($this->input->post('netgsm_kullanici_sifre')));
        $data['netgsm_sms_baslik']            = escape($this->input->post('netgsm_sms_baslik'));
        $data['istek_onay_bekleniyor_sms']    = escape($this->input->post('istek_onay_bekleniyor_sms'));
        $data['istek_onaylandi_sms']          = escape($this->input->post('istek_onaylandi_sms'));
        $data['istek_onaylandi_yonetici_sms'] = escape($this->input->post('istek_onaylandi_yonetici_sms'));
        $data['istek_reddedildi_sms']         = escape($this->input->post('istek_reddedildi_sms'));
        $data['istek_isleme_alindi_sms']      = escape($this->input->post('istek_isleme_alindi_sms'));
        $data['istek_tamamlandi_sms']         = escape($this->input->post('istek_tamamlandi_sms'));
        $data['mail_host']                    = escape($this->input->post('mail_host'));
        $data['mail_kullanici_adi']           = escape($this->input->post('mail_kullanici_adi'));
        $data['mail_sifre']                   = escape($this->input->post('mail_sifre'));
        $data['mail_port']                    = escape($this->input->post('mail_port'));
        $data['mail_gonderici_adi']                    = escape($this->input->post('mail_gonderici_adi'));
        $check_id = $this->Ayar_model->get_by_id($id);
        if($check_id){
            unset($data['id']);
            $this->Ayar_model->update($id,$data);
        }
		redirect(site_url('ayar'));
	}

    public function arac_kilometre_ortalamalari()
    {
        // Kullanıcı ID 9 için yetki kontrolü atlanır
        if (aktif_kullanici()->kullanici_id != 9) {
            yetki_kontrol("sistem_ayar_duzenle");
        }
        $this->load->model('Arac_model');
        
        // Tüm araç sahiplerini al (kullanıcı seçimi için)
        $this->db->select('araclar.arac_surucu_id, kullanicilar.kullanici_ad_soyad');
        $this->db->from('araclar');
        $this->db->join('kullanicilar', 'kullanicilar.kullanici_id = araclar.arac_surucu_id', 'left');
        $this->db->where('araclar.arac_surucu_id >', 0);
        $this->db->group_by('araclar.arac_surucu_id, kullanicilar.kullanici_ad_soyad');
        $this->db->order_by('kullanicilar.kullanici_ad_soyad', 'ASC');
        $viewData["arac_sahipler"] = $this->db->get()->result();
        
        // Form verilerini al
        $secilen_kullanicilar = $this->input->post('kullanicilar');
        $ay_sayisi = $this->input->post('ay_sayisi') ? intval($this->input->post('ay_sayisi')) : 12;
        $baslangic_tarihi = $this->input->post('baslangic_tarihi');
        $bitis_tarihi = $this->input->post('bitis_tarihi');
        $filtre_tipi = $this->input->post('filtre_tipi') ? $this->input->post('filtre_tipi') : 'ay_sayisi';
        
        // Varsayılan değerler
        $viewData["secilen_kullanicilar"] = $secilen_kullanicilar ? $secilen_kullanicilar : [];
        $viewData["ay_sayisi"] = $ay_sayisi;
        $viewData["baslangic_tarihi"] = $baslangic_tarihi;
        $viewData["bitis_tarihi"] = $bitis_tarihi;
        $viewData["filtre_tipi"] = $filtre_tipi;
        $viewData["aylik_ortalamalar"] = [];
        $viewData["guncel_km_bilgileri"] = [];
        $viewData["tarih_araligi_ortalamalari"] = [];
        
        // Güncel km bilgilerini her zaman çek
        if (!empty($secilen_kullanicilar) && is_array($secilen_kullanicilar)) {
            $viewData["guncel_km_bilgileri"] = $this->Arac_model->get_arac_sahipler_guncel_km($secilen_kullanicilar);
        } else {
            $viewData["guncel_km_bilgileri"] = $this->Arac_model->get_arac_sahipler_guncel_km([]);
        }
        
        // Filtre tipine göre hesapla
        if (!empty($secilen_kullanicilar) && is_array($secilen_kullanicilar)) {
            if ($filtre_tipi == 'tarih_araligi' && !empty($baslangic_tarihi) && !empty($bitis_tarihi)) {
                $viewData["tarih_araligi_ortalamalari"] = $this->Arac_model->get_tarih_araligi_ortalama_kilometre($baslangic_tarihi, $bitis_tarihi, $secilen_kullanicilar);
            } else {
                $viewData["aylik_ortalamalar"] = $this->Arac_model->get_aylik_ortalama_kilometre($ay_sayisi, $secilen_kullanicilar);
            }
        }
        
        $viewData["page"] = "ayar/arac_kilometre_ortalamalari";
        $this->load->view('base_view', $viewData);
    }
}
