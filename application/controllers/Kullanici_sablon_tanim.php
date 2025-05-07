<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kullanici_sablon_tanim extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control(); 
        date_default_timezone_set('Europe/Istanbul');
	//	yetki_kontrol("kullanici_sablon_tanimlama");
    } 

    public function index($sablon_id) {

        $tanimlar = $this->db  
                         ->join('kullanicilar', 'kullanicilar.kullanici_id = kullanici_sablon_tanimlari.kullanici_no') 
                         ->get("kullanici_sablon_tanimlari")->result();

        $data['tanimlar'] = $tanimlar;

        $data['veri'] = $this->db->where("sablon_veri_id",$sablon_id)->get("sablon_veriler")->result()[0];
        $data['kategori'] = $this->db->where("sablon_kategori_id ",$data['veri']->sablon_veri_kategori_id)->get("sablon_kategoriler")->result()[0];

        $kullanicilar = $this->db  
        ->join('kullanicilar', 'kullanicilar.kullanici_id = kullanici_sablon_tanimlari.kullanici_no','right')
        ->where("kullanici_aktif",1) 
        ->get("kullanici_sablon_tanimlari")->result();
        
        $data['kullanicilar'] =$kullanicilar;



		$data['page'] = 'kullanici_sablon_tanim/list';
     
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
