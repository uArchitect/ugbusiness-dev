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
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://ws.arvento.com/v1/report.asmx");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $soapRequest);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: text/xml; charset=utf-8",
        "SOAPAction: \"http://www.arvento.com/GetDriverNodeMappings\"",
        "Content-Length: " . strlen($soapRequest),
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    $response = curl_exec($ch); 
    
    if (curl_errno($ch)) {
        echo json_encode(["error" => curl_error($ch)]);
        curl_close($ch);
        exit;
    }
    curl_close($ch);
    
    // Response boş mu kontrol et
    if (empty($response)) {
        $viewData["driverdata"] = [];
        $viewData["data_arac"] = null;
        $viewData["page"] = "arvento";
        $this->load->view('base_view', $viewData);
        return;
    }
    
    $doc = new DOMDocument();
    // XML parse hatası kontrolü
    libxml_use_internal_errors(true);
    $loaded = $doc->loadXML($response);
    
    if (!$loaded) {
        $errors = libxml_get_errors();
        libxml_clear_errors();
        $viewData["driverdata"] = [];
        $viewData["data_arac"] = null;
        $viewData["page"] = "arvento";
        $this->load->view('base_view', $viewData);
        return;
    }
    $xpath = new DOMXPath($doc);
    $xpath->registerNamespace("soap", "http://schemas.xmlsoap.org/soap/envelope/");
    $xpath->registerNamespace("diffgr", "urn:schemas-microsoft-com:xml-diffgram-v1");
    $latitudeNodes = $xpath->query("//Driver"); 
    $latitudeNodes2 = $xpath->query("//Device_x0020_No"); 
    $driverdata = [];
    
    for ($i = 0; $i < $latitudeNodes->length; $i++) { 
        if ($latitudeNodes->item($i) && $latitudeNodes2->item($i)) {
            $driverdata[] = ["driver" => $latitudeNodes->item($i)->nodeValue,"node" => $latitudeNodes2->item($i)->nodeValue];
        }
    }
    
    // XML parse hatası kontrolü
    if (empty($driverdata)) {
        // XML parse edilemedi veya veri yok
        $driverdata = [];
    }
    
    $kullanici_id = $this->session->userdata('aktif_kullanici_id');
    $arac_result = $this->db->where("arac_surucu_id", $kullanici_id)->get("araclar")->result();
    $viewData["data_arac"] = !empty($arac_result) ? $arac_result[0] : null;
    $viewData["driverdata"] = $driverdata;

		$viewData["page"] = "arvento";
		$this->load->view('base_view',$viewData);
	}
  //sa
 
	public function get_yakit($node = "")
  {
        $url = "https://ws.arvento.com/v1/report.asmx";
        $request = <<<XML
        <?xml version="1.0" encoding="utf-8"?>
        <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
                      xmlns:xsd="http://www.w3.org/2001/XMLSchema" 
                      xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
          <soap:Body>
            <CanBusFuelInfo xmlns="http://www.arvento.com/">
                <Username>ugteknoloji1</Username>
              <PIN1>Umexapi.2425</PIN1>
              <PIN2>Umexapi.2425</PIN2>
              <StartDate>01072025000000</StartDate>
              <EndDate>07072025090000</EndDate>
              <Node>$node</Node>
              <Group></Group>
              <Compress>false</Compress>
              <MinuteDif>0</MinuteDif>
              <Language></Language>
            </CanBusFuelInfo>
          </soap:Body>
        </soap:Envelope>
        XML;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: text/xml; charset=utf-8",
            "SOAPAction: \"http://www.arvento.com/CanBusFuelInfo\"",
            "Content-Length: " . strlen($request)
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $response = curl_exec($ch);
        curl_close($ch); 
        
        $xml = simplexml_load_string($response);

        $xml->registerXPathNamespace('soap', 'http://schemas.xmlsoap.org/soap/envelope/');
        $xml->registerXPathNamespace('diffgr', 'urn:schemas-microsoft-com:xml-diffgram-v1');
        $xml->registerXPathNamespace('msdata', 'urn:schemas-microsoft-com:xml-msdata');
        $xml->registerXPathNamespace('arvento', 'http://www.arvento.com/');
        $records = $xml->xpath('//diffgr:diffgram/NewDataSet/Table1');

        $data = array();
        foreach ($records as $record) {
            $data[] = array(
                'kayit_no'      => (string) $record->Kayıt_x0020_No,
                'cihaz'         => (string) $record->Cihaz,
                'plaka'         => (string) $record->Plaka,
                'surucu'        => isset($record->Sürücü) ? (string) $record->Sürücü : 'N/A',
                'tarih_saat'    => (string) $record->Tarih_x002F_Saat,
                'durum'         => (string) $record->Durum,
                'deger'         => (string) $record->Değer,
                'odometre'      => (string) $record->Odometre
            );
        }
        $this->load->view('base_view', ['yakit_verileri' => $data,'secilenkey'=>$node,'page' => "arvento_rapor",'araclar'=>$this->db->where("arac_arvento_key !=","")->get("araclar")->result()]);
  }

	public function get_speed_alarm_data()
  {
      $now = new DateTime();
      $currentTime = $now->format('mdYHis');
      $now->modify('-15 minutes');
      $fiveMinutesAgo = $now->format('mdYHis');
      $url = "https://ws.arvento.com/v1/report.asmx";
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
      curl_setopt($ch, CURLOPT_URL, "https://ws.arvento.com/v1/report.asmx");
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $soapRequest);
      curl_setopt($ch, CURLOPT_HTTPHEADER, [
          "Content-Type: text/xml; charset=utf-8",
          "SOAPAction: \"http://www.arvento.com/SpeedAlarm\"",
          "Content-Length: " . strlen($soapRequest),
      ]);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
      curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
  
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
