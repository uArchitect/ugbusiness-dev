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

    /**
     * Senetleri listeleyen ve arama yapan sayfa.
     */
    public function index()
    {
        $data['title'] = 'Senet Takip Listesi';
        $search_term = $this->input->get('q'); // Arama terimini GET metodu ile alıyoruz
        $data['search_term'] = $search_term;
        $data['senetler'] = $this->senet_model->get_all_senetler($search_term);
        $data['page'] = 'senet/list'; 
        $this->load->view('base_view', $data); 
    }

    /**
     * Yeni senet ekleme formu ve işlemleri.
     */
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

    /**
     * Senet düzenleme formu ve işlemleri.
     * @param int $id Düzenlenecek senet ID'si
     */
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

    /**
     * Senet silme işlemi.
     * @param int $id Silinecek senet ID'si
     */
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