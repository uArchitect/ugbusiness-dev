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
    yetki_kontrol("arvento_goruntule");


        
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
 




 
$viewData["data_arac"] = $this->db->where("arac_surucu_id",$kullanici_id)->get("araclar")->result()[0];
$viewData["driverdata"] = $driverdata;

		$viewData["page"] = "arvento";
		$this->load->view('base_view',$viewData);
	}
 









  
	public function get_yakit($node = "")
  {

 
// SOAP endpoint
$url = "https://ws.arvento.com/v1/report.asmx";

// SOAP isteği
$xml_post_string = '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
               xmlns:xsd="http://www.w3.org/2001/XMLSchema"
               xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <CanBusFuelInfo xmlns="http://www.arvento.com/">
      <Username>ugteknoloji1</Username>
      <PIN1>Umexapi.2425</PIN1>
      <PIN2>Umexapi.2425</PIN2>
      <StartDate>'.date("2025-07-01 00:00").'</StartDate>
      <EndDate>'.date("Y-m-d 23:59").'</EndDate>
      <Node>'.$node.'</Node>
      <Group></Group>
      <Compress>false</Compress>
      <MinuteDif>180</MinuteDif>
      <Language>tr</Language>
    </CanBusFuelInfo>
  </soap:Body>
</soap:Envelope>';

// cURL ile SOAP isteği gönder
$headers = [
    "Content-type: text/xml; charset=utf-8",
    "SOAPAction: \"http://www.arvento.com/CanBusFuelInfo\"",
    "Content-length: " . strlen($xml_post_string),
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Hata: ' . curl_error($ch);
}
curl_close($ch);

// XML cevabını parse et
$xml = simplexml_load_string($response);
$namespaces = $xml->getNamespaces(true);
$body = $xml->children($namespaces['soap'])->Body;
$result = $body->children($namespaces[''])->CanBusFuelInfoResponse->CanBusFuelInfoResult;

// XML içeriğini parse et (muhtemelen base64 encoded string içeriyor olabilir)
$dataXml = simplexml_load_string($result);

// Örnek veri tabloya yazdırma
echo "<table border='1'>";
echo "<tr><th>Plaka</th><th>Tarih</th><th>Yakıt Tüketimi</th><th>KM</th></tr>";

foreach ($dataXml->CanBusFuel as $item) {
    echo "<tr>";
    echo "<td>" . $item->PlateNumber . "</td>";
    echo "<td>" . $item->Date . "</td>";
    echo "<td>" . $item->FuelConsumption . "</td>";
    echo "<td>" . $item->Odometer . "</td>";
    echo "</tr>";
}
echo "</table>";
 
  
  }







  
	public function get_speed_alarm_data()
  {
  
  
      $now = new DateTime();
  $currentTime = $now->format('mdYHis'); // AyGünYılSaatDakikaSaniye formatı
  
  // 5 dakika öncesi
  $now->modify('-15 minutes');
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
      'Address' => (string)$adresses->item($i)->nodeValue,
  ];
  
  } 
  
  
  
  
   
      echo json_encode($result);
  }

}
