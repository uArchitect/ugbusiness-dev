<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
	function __construct(){
        parent::__construct();
        date_default_timezone_set('Europe/Istanbul');
    }


	

	public function index($apikey = "")
	{
		$json_data = [
			"userName" => "error",
			"userTitle" => "error", 
			"waitCount" => "0", 
			"processCount" => "0",
			"completedCount" => "0",  
			"userImage" => "", 
			"data" => null
		];

		if($apikey != "" && $apikey != null){
			
			$kquery = $this->db->where("kullanici_api_pc_key",$apikey)
			->select('kullanicilar.*')->from('kullanicilar')
			->get()->result();
			if(count($kquery)>=0){
				$query = $this->db
				->where("istek_sorumlu_kullanici_id",$kquery[0]->kullanici_id)
				->or_where("istek_yonetici_id",$kquery[0]->kullanici_id)
				->select('istekler.*, kullanicilar.kullanici_ad_soyad as kullanici_ad_soyad, yonetici_kullanicilar.kullanici_ad_soyad as gorevlendirilen_kullanici_ad_soyad')
				->join('kullanicilar', 'kullanicilar.kullanici_id = istekler.istek_sorumlu_kullanici_id', 'left')
				->join('kullanicilar as yonetici_kullanicilar', 'yonetici_kullanicilar.kullanici_id = istekler.istek_yonetici_id', 'left')
				->from('istekler')
				->get()->result();
				if(count($query)>=0){
					$json_data = [
						"userName" => $kquery[0]->kullanici_ad_soyad,
						"userTitle" => $kquery[0]->kullanici_unvan, 
						"userImage" => "https://ugbusiness.com.tr/uploads/".$kquery[0]->kullanici_resim, 
						"waitCount" => $this->db->where("istek_durum_no",2)->where("istek_yonetici_id",$kquery[0]->kullanici_id)->count("istekler"), 
						"processCount" => $this->db->where("istek_durum_no",3)->where("istek_yonetici_id",$kquery[0]->kullanici_id)->count("istekler"),
						"completedCount" => $this->db->where("istek_durum_no",4)->where("istek_yonetici_id",$kquery[0]->kullanici_id)->count("istekler"),  
						"data" => $query
					];
			
				
				}else{
					$json_data = [
						"userName" => $kquery[0]->kullanici_ad_soyad,
						"userTitle" => $kquery[0]->kullanici_unvan, 
						"userImage" => "https://ugbusiness.com.tr/uploads/".$kquery[0]->kullanici_resim, 
						"waitCount" => "0", 
						"processCount" => "0",
						"completedCount" => "0", 
						"data" => null
					];
			
			
				}
			}
		}
		echo json_encode($json_data);		
		}
	
	}
 