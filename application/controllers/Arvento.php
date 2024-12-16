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
$latitudeNodes = $xpath->query("//Driver"); 
$latitudeNodes2 = $xpath->query("//Device_x0020_No"); 

// Konum bilgilerini al ve ekrana yazdır
$driverdata = [];
 
for ($i = 0; $i < $latitudeNodes->length; $i++) { 
    $driverdata[] = ["driver" => $latitudeNodes->item($i)->nodeValue,"node" => $latitudeNodes2->item($i)->nodeValue];
 
}
 





$now = new DateTime();
$currentTime = $now->format('mdYHis'); // AyGünYılSaatDakikaSaniye formatı

// 5 dakika öncesi
$now->modify('-5 minutes');
$fiveMinutesAgo = $now->format('mdYHis');

    // SOAP endpoint URL
    $url = "http://ws.arvento.com/v1/report.asmx";

    // SOAP XML isteği
    $soapRequest = '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <SpeedAlarm xmlns="http://www.arvento.com/">
      <Username>ugteknoloji1</Username>
      <PIN1>Umexapi.2425</PIN1>
      <PIN2>Umexapi.2425</PIN2>
      <StartDate>'.$fiveMinutesAgo.'</StartDate>
      <EndDate>'.$currentTime.'</EndDate>
      <Node>K1200007333</Node>
      <Group>0</Group>
      <Compress>0</Compress>
      <Locale>0</Locale>
      <Language>1</Language>
      <Duration>0</Duration>
    </SpeedAlarm>
  </soap:Body>
</soap:Envelope>
';




$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://ws.arvento.com/v1/report.asmx");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $soapRequest);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: text/xml; charset=utf-8",
    "SOAPAction: \"http://www.arvento.com/SpeedAlarm\"",
    "Content-Length: " . strlen($soapRequest),
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


     

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo json_encode(['status' => 'error', 'message' => curl_error($ch)]);
        curl_close($ch);
        return;
    }

    curl_close($ch);

    $doc = new DOMDocument();
    $doc->loadXML($response);
    
    $xpath = new DOMXPath($doc);
    $xpath->registerNamespace("soap", "http://schemas.xmlsoap.org/soap/envelope/");
    $xpath->registerNamespace("diffgr", "urn:schemas-microsoft-com:xml-diffgram-v1");
    
$drivers = $xpath->query("//Driver");
$plakas = $xpath->query("//License_x0020_Plate");
$devices = $xpath->query("//Device_x0020_No");
$dates = $xpath->query("//Date_x002F_Time");
$limits = $xpath->query("//Speed_x0020_Limit");
$speeds = $xpath->query("//Speed_x0020_km_x002F_h");
$adresses = $xpath->query("//Address");

$durations = $xpath->query("//Speed_x0020_Violation_x0020_Duration");
$result = [];
for ($i = 0; $i < $devices->length; $i++) {
   
   $result[] = [
    'Device_No' => (string)$devices->item($i)->nodeValue,
    'License_Plate' => (string)$plakas->item($i)->nodeValue ,
    'Driver' => (string)$drivers->item($i)->nodeValue,
    'Date' => (string)$dates->item($i)->nodeValue,
    'Limit' => (string)$limits->item($i)->nodeValue,
    'Speed' => (string)$speeds->item($i)->nodeValue,
    'Duration' => (string)$durations->item($i)->nodeValue,
    'Adress' => (string)$adresses->item($i)->nodeValue,
];

} 






$viewData["speedalarms"] = $result;



$viewData["driverdata"] = $driverdata;

		$viewData["page"] = "arvento";
		$this->load->view('base_view',$viewData);
	}
 
















  
	private function get_speed_alarm_data()
  {
  
  
      $now = new DateTime();
  $currentTime = $now->format('mdYHis'); // AyGünYılSaatDakikaSaniye formatı
  
  // 5 dakika öncesi
  $now->modify('-5 minutes');
  $fiveMinutesAgo = $now->format('mdYHis');
  
      // SOAP endpoint URL
      $url = "http://ws.arvento.com/v1/report.asmx";
  
      // SOAP XML isteği
      $soapRequest = '<?xml version="1.0" encoding="utf-8"?>
  <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
    <soap:Body>
      <SpeedAlarm xmlns="http://www.arvento.com/">
        <Username>ugteknoloji1</Username>
        <PIN1>Umexapi.2425</PIN1>
        <PIN2>Umexapi.2425</PIN2>
        <StartDate>'.$fiveMinutesAgo.'</StartDate>
        <EndDate>'.$currentTime.'</EndDate>
        <Node>K1200007333</Node>
        <Group>0</Group>
        <Compress>0</Compress>
        <Locale>0</Locale>
        <Language>1</Language>
        <Duration>0</Duration>
      </SpeedAlarm>
    </soap:Body>
  </soap:Envelope>
  ';
  
  
  
  
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "http://ws.arvento.com/v1/report.asmx");
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $soapRequest);
  curl_setopt($ch, CURLOPT_HTTPHEADER, [
      "Content-Type: text/xml; charset=utf-8",
      "SOAPAction: \"http://www.arvento.com/SpeedAlarm\"",
      "Content-Length: " . strlen($soapRequest),
  ]);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
  
       
  
      $response = curl_exec($ch);
  
      if (curl_errno($ch)) {
          echo json_encode(['status' => 'error', 'message' => curl_error($ch)]);
          curl_close($ch);
          return;
      }
  
      curl_close($ch);
  
      $doc = new DOMDocument();
      $doc->loadXML($response);
      
      $xpath = new DOMXPath($doc);
      $xpath->registerNamespace("soap", "http://schemas.xmlsoap.org/soap/envelope/");
      $xpath->registerNamespace("diffgr", "urn:schemas-microsoft-com:xml-diffgram-v1");
      
  $drivers = $xpath->query("//Driver");
  $plakas = $xpath->query("//License_x0020_Plate");
  $devices = $xpath->query("//Device_x0020_No");
  $dates = $xpath->query("//Date_x002F_Time");
  $limits = $xpath->query("//Speed_x0020_Limit");
  $speeds = $xpath->query("//Speed_x0020_km_x002F_h");
  
  $durations = $xpath->query("//Speed_x0020_Violation_x0020_Duration");
  $result = [];
  for ($i = 0; $i < $devices->length; $i++) {
     
     $result[] = [
      'Device_No' => (string)$devices->item($i)->nodeValue,
      'License_Plate' => (string)$plakas->item($i)->nodeValue ,
      'Driver' => (string)$drivers->item($i)->nodeValue,
      'Date' => (string)$dates->item($i)->nodeValue,
      'Limit' => (string)$limits->item($i)->nodeValue,
      'Speed' => (string)$speeds->item($i)->nodeValue,
      'Duration' => (string)$durations->item($i)->nodeValue,
  ];
  
  } 
  
  
  
  
   
      return json_encode($result);
  }

}
