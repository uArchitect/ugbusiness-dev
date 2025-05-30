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
$api_url = 'https://api.trendyol.com/sapigw/suppliers/534419/orders';  

  
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

 
$api_product_url = 'https://api.trendyol.com/sapigw/suppliers/534419/products';  

  
$ch2 = curl_init();
curl_setopt($ch2, CURLOPT_URL, $api_product_url);
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch2, CURLOPT_HTTPHEADER, [
    'Authorization: Basic ' . base64_encode("$username:$password"),
    'Content-Type: application/json'
]);
 
$response2 = curl_exec($ch2);
 
if (curl_errno($ch2)) {
    echo 'Hata: ' . curl_error($ch2);
    curl_close($ch2);
    exit;
}

curl_close($ch2);
 
$data2 = json_decode($response2, true);

 


$api_question_url = 'https://api.trendyol.com/sapigw/suppliers/534419/questions/filter';  

  
$ch3 = curl_init();
curl_setopt($ch3, CURLOPT_URL, $api_question_url);
curl_setopt($ch3, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch3, CURLOPT_HTTPHEADER, [
    'Authorization: Basic ' . base64_encode("$username:$password"),
    'Content-Type: application/json'
]);
 
$response3 = curl_exec($ch3);
 
if (curl_errno($ch3)) {
    echo 'Hata: ' . curl_error($ch3);
    curl_close($ch3);
    exit;
}

curl_close($ch3);
 
$data3 = json_decode($response3, true);





 
if (isset($data['content'])) {
  
    $viewData["soru_data"] = $data3;
    $viewData["urun_data"] = $data2;
    $viewData["siparis_data"] = $data;
    $viewData["page"] = "trendyol/siparis";
    $this->load->view('base_view',$viewData);
} else {
    echo "Sipariş bulunamadı veya API'den bir hata döndü." . PHP_EOL;
}







	}

	
}
