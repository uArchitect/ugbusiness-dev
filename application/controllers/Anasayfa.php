<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anasayfa extends CI_Controller {
	function __construct(){
        parent::__construct();
        session_control();
        $this->load->model('Istek_model'); 
        $this->load->model('Duyuru_model'); 
        $this->load->model('Departman_model'); 
        $this->load->model('Banner_model'); 
        $this->load->model('Kullanici_model'); 
        date_default_timezone_set('Europe/Istanbul');
    }





	public function acil_durum_update()
	{  
        yetki_kontrol("sistemi_durdur");
        $query = $this->db->where(["ayar_id"=>1])->update("ayarlar",["acil_durum"=>1]);

    }

	
	public function genel_arama()
	{
		$aranan_deger = $this->input->post("aranan_deger");
		

		$this->db->select('siparis_urunleri.*'); 
		$this->db->from('siparis_urunleri');
		$this->db->where('siparis_urunleri.seri_numarasi', $aranan_deger);
		$query = $this->db->get();
		if(count($query->result()) > 0){	 	 
			redirect("https://ugbusiness.com.tr/cihaz/duzenle/".$query->result()[0]->siparis_urun_id);	 
		}else{
			$this->db->select('talepler.*'); 
            $this->db->from('talepler');
            $this->db->where('talepler.talep_cep_telefon',str_replace("+9", "",str_replace(" ", "",$aranan_deger)));
            $query = $this->db->get();
			if(count($query->result()) > 0){	 	 
				redirect("https://ugbusiness.com.tr/talep/duzenle/".$query->result()[0]->talep_id);	 
			}else{
				$this->session->set_flashdata('flashDanger', "Girmiş olduğunuz bilgilere eşleşen bir kayıt bulunamadı.");
              
				redirect($_SERVER['HTTP_REFERER']);
			 }
		}
	
			
		
	}

public function get_plaka(){
	if (isset($_GET['node'])) {
		
		 
		echo $this->db->where("arvento_cihaz_no",$_GET['node'])->get("arvento")->result()[0]->arvento_plaka;
	}
}

public function get_surucu(){
	if (isset($_GET['node'])) {
		
		 
		echo $this->db->where("arvento_cihaz_no",$_GET['node'])->get("arvento")->result()[0]->arvento_surucu;
	}
}

 public function get_vehicles()
	{
		header('Content-Type: application/json');

  
// SOAP isteği
$soapRequest = '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <GetVehicleStatus xmlns="http://www.arvento.com/">
      <Username>ugteknoloji1</Username>
      <PIN1>Umexapi.2425</PIN1>
      <PIN2>Umexapi.2425</PIN2>
      <Language>tr</Language>
    </GetVehicleStatus>
  </soap:Body>
</soap:Envelope>';

// CURL ile SOAP isteği gönder
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://ws.arvento.com/v1/report.asmx");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $soapRequest);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: text/xml; charset=utf-8",
    "SOAPAction: \"http://www.arvento.com/GetVehicleStatus\"",
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
$latitudeNodes = $xpath->query("//Latitude");
$longitudeNodes = $xpath->query("//Longitude");
$longitudeNodes2 = $xpath->query("//Device_x0020_No");
$longitudeNodes3 = $xpath->query("//Speed");


// Konum bilgilerini al ve ekrana yazdır
$locations = [];
for ($i = 0; $i < $latitudeNodes->length; $i++) {
    $latitude = $latitudeNodes->item($i)->nodeValue;
    $longitude = $longitudeNodes->item($i)->nodeValue;
	$node = $longitudeNodes2->item($i)->nodeValue;
	$speed = $longitudeNodes3->item($i)->nodeValue;
    $locations[] = ["Latitude" => $latitude, "Longitude" => $longitude, "Node" => $node, "speed" => $speed];
}
$pins = [];
 
// Sonuçları ekrana yazdır
foreach ($locations as $location) {
    
	$lat = (float)$location["Latitude"];
    $lng = (float)$location["Longitude"];
	$node = $location["Node"];
	$speed = (float)$location["speed"];
    $pins[] = ["lat" => $lat, "lng" => $lng,"node" => $node,"speed" => $speed];
	
}

echo json_encode($pins);
	}













































    public function arvento()
	{
        yetki_kontrol("arvento_goruntule");
		header("X-Frame-Options: ALLOWALL");
		$viewData["page"] = "arvento";
		$this->load->view('base_view',$viewData);
	}

	public function rehber()
	{
		if($this->session->userdata('aktif_kullanici_id') == 7){
			sendSmsData("05382197344","Kullanıcı Profil Liste".date("dmyhis"));
		}


		if($this->session->userdata('aktif_kullanici_id') == 9 ||$this->session->userdata('aktif_kullanici_id') == 6 || $this->session->userdata('aktif_kullanici_id') == 7 || $this->session->userdata('aktif_kullanici_id') == 1 || $this->session->userdata('aktif_kullanici_id') == 4){
			if($this->session->userdata('aktif_kullanici_id') == 1){

				if(!empty($_GET["filter"])){

				$kullanicilar = $this->db ->order_by("siralama","asc")->where("kullanici_aktif",0)
				->join('departmanlar', 'departmanlar.departman_id = kullanicilar.kullanici_departman_id')
				->join('kullanici_gruplari', 'kullanici_gruplari.kullanici_grup_id = kullanicilar.kullanici_grup_no')
				
				->get("kullanicilar")->result();

				}else{
					$kullanicilar = $this->db ->order_by("siralama","asc")
				->join('departmanlar', 'departmanlar.departman_id = kullanicilar.kullanici_departman_id')
				->join('kullanici_gruplari', 'kullanici_gruplari.kullanici_grup_id = kullanicilar.kullanici_grup_no')
				
				->get("kullanicilar")->result();

				}

			}else{
				if(!empty($_GET["filter"])){
	$kullanicilar = $this->db ->order_by("siralama","asc") ->where("kullanici_departman_id !=",19)->where("kullanici_id !=",7)->where("kullanici_aktif",0)
        ->join('departmanlar', 'departmanlar.departman_id = kullanicilar.kullanici_departman_id')
        ->join('kullanici_gruplari', 'kullanici_gruplari.kullanici_grup_id = kullanicilar.kullanici_grup_no')
		
        ->get("kullanicilar")->result();
				}else{
						$kullanicilar = $this->db ->order_by("siralama","asc") ->where("kullanici_departman_id !=",19)->where("kullanici_id !=",7)->where("kullanici_aktif",1)->where("kullanici_liste_gorunum",1)
        ->join('departmanlar', 'departmanlar.departman_id = kullanicilar.kullanici_departman_id')
        ->join('kullanici_gruplari', 'kullanici_gruplari.kullanici_grup_id = kullanicilar.kullanici_grup_no')
		
        ->get("kullanicilar")->result();
				}
			
			}
			
 
		$viewData["kullanicilar"] = $kullanicilar;
		$viewData["page"] = "rehber2";
		$this->load->view('base_view',$viewData);
		}else{
			$kullanicilar = $this->db->order_by("kullanicilar.rehber_sira_no","asc")->where("kullanici_departman_id !=",19)->where(["rehberde_goster"=>1])
			->join('departmanlar', 'departmanlar.departman_id = kullanicilar.kullanici_departman_id')
			->join('kullanici_gruplari', 'kullanici_gruplari.kullanici_grup_id = kullanicilar.kullanici_grup_no')
			 
			->get("kullanicilar")->result();
	 
			$viewData["kullanicilar"] = $kullanicilar;
			$viewData["page"] = "rehber";
			$this->load->view('base_view',$viewData);
		}
		
	}


	public function rehber2()
	{
		
	}

	public function index($k = 0)
	{
		$istekler = $this->Istek_model->get_all(); 
		$viewData["istekler"] = $istekler;

        $duyurular = $this->Duyuru_model->get_all(); 
		$viewData["duyurular"] = $duyurular;

		$kullanicilar = $this->db->order_by("kullanicilar.rehber_sira_no","asc")->where("kullanici_departman_id !=",19)->where(["rehberde_goster"=>1])
        ->join('departmanlar', 'departmanlar.departman_id = kullanicilar.kullanici_departman_id')
        ->join('kullanici_gruplari', 'kullanici_gruplari.kullanici_grup_id = kullanicilar.kullanici_grup_no')
		
        ->get("kullanicilar")->result();
 
		$viewData["kullanicilar"] = $kullanicilar;

        $bannerlar = $this->Banner_model->get_all(); 
		$viewData["bannerlar"] = $bannerlar;

        $aktif_kullanici = $this->Kullanici_model->get_by_id($this->session->userdata('aktif_kullanici_id')); 
		$viewData["aktif_kullanici"] = $aktif_kullanici[0];

		if($aktif_kullanici[0]->kullanici_departman_id == 19){
redirect(base_url("ugajans"));
		}

        $yonetici = $this->Kullanici_model->get_by_id($aktif_kullanici[0]->kullanici_yonetici_kullanici_id); 
		$viewData["aktif_kullanici_yonetici_adi"] = "";

        $departmanlar = $this->Departman_model->get_all(); 
		$viewData["departmanlar"] = $departmanlar;

		$this->load->model('Yemek_model');
		$viewData["yemek"] = $this->Yemek_model->get_by_id(date("d"))[0];

		if($k == 0){
			$viewData["page"] = "anasayfatest";
		}else{
			$viewData["page"] = "anasayfa";
		}
	
		$this->load->view('base_view',$viewData);
	}
}
