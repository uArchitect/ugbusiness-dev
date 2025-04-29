<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Abonelik extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
		$this->load->model('Abonelik_model');
        date_default_timezone_set('Europe/Istanbul');
		yetki_kontrol("abonelik");
    } 

    public function index() {
        $data['abonelikler'] = $this->Abonelik_model->get_all_abonelikler();
		$data['page'] = 'abonelik/list';
     
		$this->load->view('base_view', $data);
    }

    public function ekle() {
		$data['page'] = 'abonelik/form';
        $this->load->view('base_view',$data);
    }

    public function ekle_islem() {
        $data = [
            'abonelik_baslik' => $this->input->post('baslik'),
            'abonelik_aciklama' => $this->input->post('aciklama'),
            'abonelik_baslangic_tarihi' => $this->input->post('baslangic_tarihi'),
            'abonelik_bitis_tarihi' => $this->input->post('bitis_tarihi')
        ];
        $this->Abonelik_model->insert_abonelik($data);
        redirect('abonelik');
    }

	  
	  public function duzenle($id) {
        $data['abonelik'] = $this->Abonelik_model->get_abonelik_by_id($id);
		$data['page'] = 'abonelik/edit';
        $this->load->view('base_view', $data);
    }

   
    public function duzenle_islem($id) {
        $data = [
            'abonelik_baslik' => $this->input->post('baslik'),
            'abonelik_aciklama' => $this->input->post('aciklama'),
            'abonelik_baslangic_tarihi' => $this->input->post('baslangic_tarihi'),
            'abonelik_bitis_tarihi' => $this->input->post('bitis_tarihi')
        ];
        $this->Abonelik_model->update_abonelik($id, $data);
        redirect('abonelik');
    }
}
