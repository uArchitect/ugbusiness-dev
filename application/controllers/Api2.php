<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api2 extends CI_Controller {
	function __construct(){
        parent::__construct();	
		header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        date_default_timezone_set('Europe/Istanbul');
    }

	public function test()
	{
		$method = strtoupper($_SERVER['REQUEST_METHOD']);
		$input_data = null;
		
		if ($method == 'POST' || $method == 'PUT') {
			$json = file_get_contents('php://input');
			$input_data = json_decode($json, true);
			if ($input_data === null && !empty($json)) {
				parse_str($json, $input_data);
			}
		} else {
			$input_data = $this->input->get();
		}

		$response = [
			'status' => 'success',
			'message' => 'API2 test endpoint çalışıyor!',
			'timestamp' => date('Y-m-d H:i:s'),
			'method' => $method,
			'input_data' => $input_data,
			'server_info' => [
				'php_version' => phpversion(),
				'server_time' => date('Y-m-d H:i:s'),
				'timezone' => date_default_timezone_get()
			]
		];

		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	}

	// 1. Yemek Listesi
	public function yemek_listesi()
	{
		$this->load->model('Yemek_model');
		
		// Bugünün yemeğini al
		$bugun_yemek = $this->Yemek_model->get_by_id(date("d"));
		
		// Tüm yemek listesini al
		$tum_yemekler = $this->Yemek_model->get_all();
		
		$response = [
			'status' => 'success',
			'bugun_yemek' => $bugun_yemek ? $bugun_yemek[0] : null,
			'tum_yemekler' => $tum_yemekler,
			'tarih' => date('Y-m-d'),
			'gun_no' => date('d')
		];

		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	}

	// 2. Trendyol Siparişleri
	public function trendyol()
	{
		$username = 'KRgGB8YfCyHNgTp1vu5N';
		$password = 'leVtgjJK3JE6Upeu8oEO';
		
		// Siparişler
		$api_url = 'https://api.trendyol.com/sapigw/suppliers/534419/orders';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $api_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'Authorization: Basic ' . base64_encode("$username:$password"),
			'Content-Type: application/json'
		]);
		$response = curl_exec($ch);
		$siparis_data = json_decode($response, true);
		curl_close($ch);

		// Ürünler
		$api_product_url = 'https://api.trendyol.com/sapigw/suppliers/534419/products';
		$ch2 = curl_init();
		curl_setopt($ch2, CURLOPT_URL, $api_product_url);
		curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch2, CURLOPT_HTTPHEADER, [
			'Authorization: Basic ' . base64_encode("$username:$password"),
			'Content-Type: application/json'
		]);
		$response2 = curl_exec($ch2);
		$urun_data = json_decode($response2, true);
		curl_close($ch2);

		// Sorular
		$api_question_url = 'https://api.trendyol.com/sapigw/suppliers/534419/questions/filter';
		$ch3 = curl_init();
		curl_setopt($ch3, CURLOPT_URL, $api_question_url);
		curl_setopt($ch3, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch3, CURLOPT_HTTPHEADER, [
			'Authorization: Basic ' . base64_encode("$username:$password"),
			'Content-Type: application/json'
		]);
		$response3 = curl_exec($ch3);
		$soru_data = json_decode($response3, true);
		curl_close($ch3);

		$response = [
			'status' => 'success',
			'siparis_data' => $siparis_data,
			'urun_data' => $urun_data,
			'soru_data' => $soru_data,
			'timestamp' => date('Y-m-d H:i:s')
		];

		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	}

	// 3. İzin Listesi
	public function izin()
	{
		$this->load->model('Izin_model');
		
		// Tüm izin taleplerini al
		$izinler = $this->db
			->select('izin_talepleri.*, 
					  kullanicilar.kullanici_ad_soyad as talep_eden_ad_soyad,
					  izin_nedenleri.izin_neden_detay')
			->from('izin_talepleri')
			->join('kullanicilar', 'kullanicilar.kullanici_id = izin_talepleri.izin_talep_eden_kullanici_id', 'left')
			->join('izin_nedenleri', 'izin_nedenleri.izin_neden_id = izin_talepleri.izin_neden_no', 'left')
			->order_by('izin_talepleri.izin_talep_id', 'DESC')
			->get()
			->result();

		// İzin nedenlerini al
		$nedenler = $this->db->get("izin_nedenleri")->result();

		$response = [
			'status' => 'success',
			'izinler' => $izinler,
			'nedenler' => $nedenler,
			'toplam_kayit' => count($izinler),
			'timestamp' => date('Y-m-d H:i:s')
		];

		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	}

	// 4. Önemli Günler
	public function onemli_gun()
	{
		$bugun = date("Y-m-d");
		$otuz_gun_sonra = date("Y-m-d", strtotime("+45 days"));
		
		// Tüm önemli günler
		$tum_gunler = $this->db
			->order_by("onemli_gun_tarih", "asc")
			->get("onemli_gunler")
			->result();

		// Yaklaşan önemli günler (bugünden 45 gün sonrasına kadar)
		$yaklasan_gunler = $this->db
			->where("onemli_gun_tarih >=", $bugun)
			->where("onemli_gun_tarih <=", $otuz_gun_sonra)
			->order_by("onemli_gun_tarih", "asc")
			->get("onemli_gunler")
			->result();

		// Etkinlikler
		$etkinlikler = $this->db
			->where("etkinlik_mi", 1)
			->order_by("onemli_gun_tarih", "asc")
			->get("onemli_gunler")
			->result();

		$response = [
			'status' => 'success',
			'tum_gunler' => $tum_gunler,
			'yaklasan_gunler' => $yaklasan_gunler,
			'etkinlikler' => $etkinlikler,
			'bugun' => $bugun,
			'toplam_kayit' => count($tum_gunler),
			'timestamp' => date('Y-m-d H:i:s')
		];

		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	}
}

