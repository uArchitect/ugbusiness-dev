<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Senet extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('senet_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('url');
    }
 
 public function index()
{
    // --- YENİ EKLENEN BÖLÜM: Grafik verilerini hazırlamak için ---

    // 1. Grafik için TÜM senetleri al (arama terimi olmadan)
    $tum_senetler = $this->senet_model->get_all_senetler(null); // veya get_all_senetler('')

    // 2. Grafik verileri için sayaçları başlat
    $grafik_verileri = [
        'toplam' => count($tum_senetler),
        'gecen' => 0,
        'yaklasan_7_gun' => 0,
        'yaklasan_30_gun' => 0,
        'diger' => 0,
    ];

    $bugun = new DateTime();
    $bugun->setTime(0, 0, 0);

    foreach ($tum_senetler as $senet) {
        $senet_tarihi = new DateTime($senet->senet_tarihi);
        $senet_tarihi->setTime(0, 0, 0);

        if ($bugun > $senet_tarihi) {
            $grafik_verileri['gecen']++;
        } else {
            $fark = $bugun->diff($senet_tarihi)->days;
            if ($fark >= 0 && $fark <= 7) { // 0. gün de dahil
                $grafik_verileri['yaklasan_7_gun']++;
            }
            if ($fark > 7 && $fark <= 30) {
                $grafik_verileri['yaklasan_30_gun']++;
            }
            if ($fark > 30) {
                 $grafik_verileri['diger']++;
            }
        }
    }
    // --- YENİ BÖLÜM SONU ---


    // --- SİZİN MEVCUT KODUNUZ (Tablo verilerini hazırlamak için) ---
    $data['title'] = 'Senet Takip Listesi';
    $search_term = $this->input->get('q');
    $data['search_term'] = $search_term;
    
    // Tablo için senetleri al (arama terimi varsa filtrelenmiş olarak)
    $data['senetler'] = $this->senet_model->get_all_senetler($search_term);

    // --- View'a gönderilecek tüm verileri birleştir ---
    $data['grafik_verileri'] = $grafik_verileri; // Hesaplanan grafik verisini ekle
    $data['page'] = 'senet/list'; // Yüklenecek sayfa içeriği

      
    
    // Ana view'ı yükle
    $this->load->view('base_view', $data);
}

 
    public function ekle()
    {
        $data['title'] = 'Yeni Senet Ekle';

        $this->form_validation->set_rules('musteri_adsoyad', 'Müşteri Ad Soyad', 'required');
        $this->form_validation->set_rules('iletisim_numarasi', 'İletişim Numarası', 'required');
        $this->form_validation->set_rules('senet_tarihi', 'Senet Tarihi', 'required');

        if ($this->form_validation->run() === FALSE)
        {
              $data['page'] = 'senet/add'; 
        $this->load->view('base_view', $data); 
        }
        else
        {
            $data = array(
                'musteri_adsoyad' => $this->input->post('musteri_adsoyad'),
                'iletisim_numarasi' => $this->input->post('iletisim_numarasi'),
                'senet_tarihi' => $this->input->post('senet_tarihi')
            );

            if ($this->senet_model->add_senet($data))
            {
                $this->session->set_flashdata('success', 'Senet başarıyla eklendi.');
                redirect('senet');
            }
            else
            {
                $this->session->set_flashdata('error', 'Senet eklenirken bir hata oluştu.');
                redirect('senet/ekle');
            }
        }
    }

   
    public function duzenle($id)
    {
        $data['title'] = 'Senet Düzenle';
        $data['senet'] = $this->senet_model->get_senet_by_id($id);

        if (empty($data['senet'])) {
            show_404();
        }

        $this->form_validation->set_rules('musteri_adsoyad', 'Müşteri Ad Soyad', 'required');
        $this->form_validation->set_rules('iletisim_numarasi', 'İletişim Numarası', 'required');
        $this->form_validation->set_rules('senet_tarihi', 'Senet Tarihi', 'required');

        if ($this->form_validation->run() === FALSE)
        {
              $data['page'] = 'senet/edit'; 
        $this->load->view('base_view', $data); 
        }
        else
        {
            $update_data = array(
                'musteri_adsoyad' => $this->input->post('musteri_adsoyad'),
                'iletisim_numarasi' => $this->input->post('iletisim_numarasi'),
                'senet_tarihi' => $this->input->post('senet_tarihi')
            );

            if ($this->senet_model->update_senet($id, $update_data))
            {
                $this->session->set_flashdata('success', 'Senet başarıyla güncellendi.');
                redirect('senet');
            }
            else
            {
                $this->session->set_flashdata('error', 'Senet güncellenirken bir hata oluştu.');
                redirect('senet/duzenle/' . $id);
            }
        }
    }

    
    public function sil($id)
    {
        if ($this->senet_model->delete_senet($id))
        {
            $this->session->set_flashdata('success', 'Senet başarıyla silindi.');
        }
        else
        {
            $this->session->set_flashdata('error', 'Senet silinirken bir hata oluştu.');
        }
        redirect('senet');
    }
}