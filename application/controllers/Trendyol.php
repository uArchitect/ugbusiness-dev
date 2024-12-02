<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trendyol extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        date_default_timezone_set('Europe/Istanbul');
    }
 
	public function index()
	{
        yetki_kontrol("trendyol_siparislerini_goruntule");
       
  
$username = 'KRgGB8YfCyHNgTp1vu5N';  
$password = 'leVtgjJK3JE6Upeu8oEO';  
$api_url = 'https://api.trendyol.com/sapigw/suppliers/534419/orders?sort=DESC';  

  
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Basic ' . base64_encode("$username:$password"),
    'Content-Type: application/json'
]);
 
$response = curl_exec($ch);
 
if (curl_errno($ch)) {
    echo 'Hata: ' . curl_error($ch);
    curl_close($ch);
    exit;
}

curl_close($ch);
 
$data = json_decode($response, true);
 
if (isset($data['content'])) {
  

    
    $viewData["siparis_data"] = $data;
    $viewData["page"] = "trendyol/siparis";
    $this->load->view('base_view',$viewData);
} else {
    echo "Sipariş bulunamadı veya API'den bir hata döndü." . PHP_EOL;
}







	}

	
}
