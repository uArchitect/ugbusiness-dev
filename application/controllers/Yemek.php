<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Yemek extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Yemek_model');  
        date_default_timezone_set('Europe/Istanbul');
    }
 
	public function index()
	{
        yetki_kontrol("yemek_goruntule");
        $data_yemek = $this->Yemek_model->get_all();
		$viewData["yemekler"] = $data_yemek;
		$viewData["page"] = "yemek/form";
		$this->load->view('base_view',$viewData);
	}

 

	public function edit($id = '')
	{  
        yetki_kontrol("yemek_duzenle");
		$check_id = $this->Sehir_model->get_by_id($id); 
        if($check_id){  
            $viewData['sehir'] = $check_id[0];
			$viewData["page"] = "sehir/form"; 
			$this->load->view('base_view',$viewData);
        }else{
            redirect(site_url('sehir'));
        }
 
	}

    
	public function save($id = '')
	{   
        yetki_kontrol("yemek_duzenle");
        $datalist =json_decode(json_encode($this->input->post('yemekbilgileri')), true);
        $updated_yemekler = array();
        $d = [];
        foreach ($datalist as $index => $yemek) {
            $d["yemek_id"] = $index + 1; ;
            $d['yemek_detay'] = $yemek;  
            $updated_yemekler[]=$d; 
        }
        $this->db->update_batch('yemekler', $updated_yemekler, 'yemek_id');
		redirect(site_url('yemek'));
	}
}
