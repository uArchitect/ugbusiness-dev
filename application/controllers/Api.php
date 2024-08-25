<?php

class Api extends CI_Controller {
	function __construct(){
        parent::__construct();
		header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
   
        date_default_timezone_set('Europe/Istanbul');
    }

	public function door_control($user_id)
	{
		echo json_encode($this->db->where("kullanici",$user_id)->get("kullanicilar")->result()[0]);
	}


	public function beklemeye_al($apikey = "",$istek_id = 0)
	{/*
		if($apikey != "" && $istek_id != 0){
			$kullanici = $this->db->where("kullanici_api_pc_key",$apikey)
			->select('kullanicilar.*')->from('kullanicilar')
			->get()->result();

			$istek = $this->db->where("istek_id",$istek_id)
			->select('istekler.*')->from('istekler')
			->get()->result();
			
			if(count($kullanici) > 0 && count($istek) > 0){
				if(count($kullanici) > 0 && count($istek) > 0){
					if($istek[0]->istek_durum_no==3)
					if($istek[0]->istek_yonetici_id == $kullanici[0]->kullanici_id){
						$this->db->where("istek_id",$istek_id)->update("istekler",["istek_durum_no"=>2]);
					}
				}
				}
			}
		}
		*/
	}
	public function isleme_al($apikey = "",$istek_id = 0)
	{
		if($apikey != "" && $istek_id != 0){
			$kullanici = $this->db->where("kullanici_api_pc_key",$apikey)
			->select('kullanicilar.*')->from('kullanicilar')
			->get()->result();

			$istek = $this->db->where("istek_id",$istek_id)
			->select('istekler.*')->from('istekler')
			->get()->result();
			
			if(count($kullanici) > 0 && count($istek) > 0){
				if(count($kullanici) > 0 && count($istek) > 0){

					if($istek[0]->istek_yonetici_id == $kullanici[0]->kullanici_id){
						$this->db->where("istek_id",$istek_id)->update("istekler",["istek_durum_no"=>3,"istek_isleme_alinma_tarihi"=>date("Y-m-d H:i")]);
					}
					 
				}
			}
		}
		
	}

	public function tamamla($apikey = "",$istek_id = 0)
	{
		if($apikey != "" && $istek_id != 0){
			$kullanici = $this->db->where("kullanici_api_pc_key",$apikey)
			->select('kullanicilar.*')->from('kullanicilar')
			->get()->result();

			$istek = $this->db->where("istek_id",$istek_id)
			->select('istekler.*')->from('istekler')
			->get()->result();
			
			if(count($kullanici) > 0 && count($istek) > 0){
				if(count($kullanici) > 0 && count($istek) > 0){

					if($istek[0]->istek_yonetici_id == $kullanici[0]->kullanici_id){
						$this->db->where("istek_id",$istek_id)->update("istekler",["istek_durum_no"=>4,"istek_tamamlanma_tarihi"=>date("Y-m-d H:i")]);
					}
					 
				}
			}
		}
		
	}

	public function index($apikey = "",$filter = "0")
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
		if($apikey != "200670632902742" && $apikey != "HC16317401" && $apikey != "140425105902036" && $apikey != "BSS-0123456789"){
		//	sendSmsData("05382197344", " YENİ API ISTEK : ".$apikey);

		}
		
		if($apikey != "" && $apikey != null){
			
			$kquery = $this->db->where("kullanici_api_pc_key",$apikey)
			->select('kullanicilar.*')->from('kullanicilar')
			->get()->result();
			if(count($kquery)>=0){
				if($filter == 2 || $filter == 3 || $filter == 4){
					$this->db
					->where("istek_durum_no",$filter)
					->where("istek_sorumlu_kullanici_id",$kquery[0]->kullanici_id);
					
				}else{
					$this->db
					->where("istek_sorumlu_kullanici_id",$kquery[0]->kullanici_id)
					->or_where("istek_yonetici_id",$kquery[0]->kullanici_id);
				}
				$query = $this->db
				->select('istekler.*, kullanicilar.kullanici_ad_soyad as kullanici_ad_soyad, yonetici_kullanicilar.kullanici_ad_soyad as gorevlendirilen_kullanici_ad_soyad')
				->join('kullanicilar', 'kullanicilar.kullanici_id = istekler.istek_sorumlu_kullanici_id', 'left')
				->join('kullanicilar as yonetici_kullanicilar', 'yonetici_kullanicilar.kullanici_id = istekler.istek_yonetici_id', 'left')
				->order_by("istek_id","desc")
				->from('istekler')
				->get()->result();
				if(count($query)>=0){
					$json_data = [
						"userName" => $kquery[0]->kullanici_ad_soyad,
						"userTitle" => $kquery[0]->kullanici_unvan, 
						"userImage" => "https://ugbusiness.com.tr/uploads/".$kquery[0]->kullanici_resim, 
						"waitCount" => count($this->db->query('SELECT * FROM ugbusine_erpdatabase.istekler where (istek_yonetici_id = '.$kquery[0]->kullanici_id.' or istek_sorumlu_kullanici_id = '.$kquery[0]->kullanici_id.') and istek_durum_no = 2')->result()),  
						
						 "processCount" => count($this->db->query('SELECT * FROM ugbusine_erpdatabase.istekler where (istek_yonetici_id = '.$kquery[0]->kullanici_id.' or istek_sorumlu_kullanici_id = '.$kquery[0]->kullanici_id.') and istek_durum_no = 3')->result()),
						"completedCount" => count($this->db->query('SELECT * FROM ugbusine_erpdatabase.istekler where (istek_yonetici_id = '.$kquery[0]->kullanici_id.' or istek_sorumlu_kullanici_id = '.$kquery[0]->kullanici_id.') and istek_durum_no = 4')->result()),  
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
		echo base64_encode(json_encode($json_data));		
		}
	
	}
 