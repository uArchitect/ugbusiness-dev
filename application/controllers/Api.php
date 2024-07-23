<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
	function __construct(){
        parent::__construct();
        date_default_timezone_set('Europe/Istanbul');
    }


	

	public function index()
	{
		 
			
		$query = $this->db
		->select('istekler.*, kullanicilar.kullanici_ad_soyad as kullanici_ad_soyad, yonetici_kullanicilar.kullanici_ad_soyad as gorevlendirilen_kullanici_ad_soyad')
		->join('kullanicilar', 'kullanicilar.kullanici_id = istekler.istek_sorumlu_kullanici_id', 'left')
		->join('kullanicilar as yonetici_kullanicilar', 'yonetici_kullanicilar.kullanici_id = istekler.istek_yonetici_id', 'left')
		->from('istekler')
		->get();
						 
					
	
						  
	
			
		   
			$totalData = $this->db->count_all('siparisler');
			$totalFiltered = $totalData;
	
			$json_data = [
				"draw" => intval($this->input->get('draw')),
				"recordsTotal" => intval($totalData),
				"recordsFiltered" => intval($totalFiltered),
				"data" => $query->result()
			];
	
			echo json_encode($json_data);
		}
	
	}
 