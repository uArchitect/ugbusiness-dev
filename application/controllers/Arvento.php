<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arvento extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Ariza_model');     $this->load->model('Urun_model'); 
        date_default_timezone_set('Europe/Istanbul');
    }
 
	public function index()
	{ 




        
$soapRequest = '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <GetDriverNodeMappings  xmlns="http://www.arvento.com/">
      <Username>ugteknoloji1</Username>
      <PIN1>Umexapi.2425</PIN1>
      <PIN2>Umexapi.2425</PIN2>
      <Language>tr</Language>
    </GetDriverNodeMappings>
  </soap:Body>
</soap:Envelope>';

// CURL ile SOAP isteği gönder
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://ws.arvento.com/v1/report.asmx");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $soapRequest);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: text/xml; charset=utf-8",
    "SOAPAction: \"http://www.arvento.com/GetDriverNodeMappings\"",
    "Content-Length: " . strlen($soapRequest),
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch); 
 
if (curl_errno($ch)) {
    echo json_encode(["error" => curl_error($ch)]);
    curl_close($ch);
    exit;
}
curl_close($ch);

// Yanıtı çözümle ve koordinatları çıkar
 
$doc = new DOMDocument();
$doc->loadXML($response);

// XPath ile Latitude ve Longitude elemanlarını bul
$xpath = new DOMXPath($doc);
$xpath->registerNamespace("soap", "http://schemas.xmlsoap.org/soap/envelope/");
$xpath->registerNamespace("diffgr", "urn:schemas-microsoft-com:xml-diffgram-v1");

// Latitude ve Longitude elemanlarını seç
$latitudeNodes = $xpath->query("//Sürücü"); 

// Konum bilgilerini al ve ekrana yazdır
$drivers = [];
for ($i = 0; $i < $latitudeNodes->length; $i++) { 
    $drivers[] = ["driver" => $latitudeNodes->item($i)->nodeValue];
}
$driverdata = [];
 
// Sonuçları ekrana yazdır
foreach ($drivers as $driver) {
     
    $driverdata[] = ["driver" => $driver["driver"]];
	
}











$viewData["driverdata"] = $driverdata;

		$viewData["page"] = "arvento";
		$this->load->view('base_view',$viewData);
	}
 
}
