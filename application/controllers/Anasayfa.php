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

public function talep_profil()
	{
$this->db->select('talepler.*'); 
            $this->db->from('talepler');
            $this->db->where('talepler.talep_cep_telefon',str_replace("+9", "",str_replace(" ", "",$_GET["telefon"])));
            $query = $this->db->get();
			if(count($query->result()) > 0){	 	 
				redirect("https://ugbusiness.com.tr/talep/duzenle/".$query->result()[0]->talep_id);	 
			}

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
	$kullanicilar = $this->db ->order_by("siralama","asc") ->where("kullanici_departman_id !=",19)->where("kullanici_id !=",7)->where("kullanici_aktif = 0 or kullanici_liste_gorunum = 0")
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
			$kullanicilar = $this->db->order_by("kullanicilar.rehber_sira_no","ASC")->where("kullanici_departman_id !=",19)->where(["rehberde_goster"=>1])
			->join('departmanlar', 'departmanlar.departman_id = kullanicilar.kullanici_departman_id')
			->join('kullanici_gruplari', 'kullanici_gruplari.kullanici_grup_id = kullanicilar.kullanici_grup_no')
			 
			->get("kullanicilar")->result();
	 
			$viewData["kullanicilar"] = $kullanicilar;
			$viewData["page"] = "rehber";
			$this->load->view('base_view',$viewData);
		}
		
	}
public function etiket()
	{   
        $data = [];
         




$data[] = "A708";
$data[] = "ERKEK PİM";
$data[] = "DİŞİ HEADER";
$data[] = "ALİMİNYUM SOĞUTUCU";
$data[] = "ARDUINO LEVHASI";
$data[] = "1 K DİRENÇ";
$data[] = "2K2 DİRENÇ";
$data[] = "4K7 DİRENÇ";
$data[] = "10 K DİRENÇ";
$data[] = "400 K DİRENÇ";
$data[] = "10 R DİRENÇ";
$data[] = "100 R DİRENÇ";
$data[] = "220 R DİRENÇ";
$data[] = "470 R DİRENÇ";
$data[] = "1N4007";
$data[] = "22 PF";
$data[] = "10 MHZ KRİSTAL";
$data[] = "100 N 630 V";
$data[] = "BC 307";
$data[] = "BC546";
$data[] = "BC 547";
$data[] = "39 K DİRENÇ";
$data[] = "68 K DİRENÇ";
$data[] = "SİGORTA YUVASI";
$data[] = "ERKEK SARI PABUÇ";
$data[] = "16 LI ENTEGRE YUVASI";
$data[] = "8 Lİ ENTEGRE YUVASI";
$data[] = "BD 139";
$data[] = "20 K TRİMPOT";
$data[] = "1000 UF 25 V";
$data[] = "BUZZER";
$data[] = "40 LI ENTEGRE SOKETİ";
$data[] = "2 Lİ POWER";
$data[] = "8 Lİ TUNİK";
$data[] = "5 Lİ TUNİK";
$data[] = "TURUNCU RÖLE";
$data[] = "3 LÜ TUNİK";
$data[] = "4 LÜ TUNİK";
$data[] = "HCNR201";
$data[] = "8 Lİ RÖLE";
$data[] = "5 Lİ RÖLE";
$data[] = "100 N 400 V";
$data[] = "150 R 1 W";
$data[] = "100 UF 25 V";
$data[] = "ANAKART LED";
$data[] = "SOĞUTUCU PLAKA";
$data[] = "BOBİN";
$data[] = "BU406";
$data[] = "5 A SİGORTA ";
$data[] = "20 A SİGORTA";
$data[] = "4N7 400 V";
$data[] = "1N5 250 V";
$data[] = "100 PF 2 KW";
$data[] = "20 UH";
$data[] = "47 UF 50 V";
$data[] = "100 UH DİRENÇ";
$data[] = "1 NF";
$data[] = "10 NF";
$data[] = "45 LİK KAUÇUK BORU";
$data[] = "ŞEFFAF HORTUM 4x5 MM ";
$data[] = "ALTIN İĞNE BAŞLIK PLASTİĞİ";
$data[] = "BUTON PLASTİĞİ";
$data[] = "HAVA HORTUMU";
$data[] = "HAVA HORTUMU DİRSEK PARLAK";
$data[] = "HAVA HORTUMU DİRSEK MAT ";
$data[] = "PNÖMATİK HORTUM 12*8 MM MAVİ";
$data[] = "PNÖMATİK HORTUM  12*8 MM ŞEFFAF";
$data[] = "PNÖMATİK HORTUM  12*9 MM MAVİ";
$data[] = "PNÖMATİK HORTUM  12*9 MM ŞEFFAF";
$data[] = "PNÖMATİK HORTUM  2.5*4 MM MAVİ";
$data[] = "PNÖMATİK HORTUM  4*2 MM ŞEFFAF";
$data[] = "PNÖMATİK HORTUM  6*4 MM ŞEFFAF";
$data[] = "PNÖMATİK HORTUM 8*5,5 MM  MAVİ ";
$data[] = "PNÖMATİK HORTUM  8*5.5 MM ŞEFFAF ";
$data[] = "KABLO ÇORABI 50 MM SİYAH";
$data[] = "KABLO ÇORABI 30MM SİYAH";
$data[] = "KROŞE YAPIŞKANLI 28*28MM";
$data[] = "MAKARON 1.5 MM";
$data[] = "MAKARON 2.5 MM";
$data[] = "MAKARON 4.5 MM";
$data[] = "MAKARON 4.8 MM";
$data[] = "MAKARON 5 MM";
$data[] = "MAKARON 16 MM";
$data[] = "MAKARON 6x4";
$data[] = "SERT HORTUM SİYAH 4X6 MM";
$data[] = "SİLİKON BAŞLIK";
$data[] = "SİYAH FİLTRE";
$data[] = "SLİM DERLİN (BÜYÜK) RADYO FREKANS";
$data[] = "SLİM DERLİN (KÜÇÜK) ULTRASONİK";
$data[] = "SLİM DERLİN (ORTA) RADYO FREKANS";
$data[] = "SLİM DERLİN (ORTA) ULTRASONİK";
$data[] = "SPİRAL HORTUM PG-9";
$data[] = "SPİRAL HORTUM PG-9/11";
$data[] = "STREÇ ";
$data[] = "ŞAMPANYA SİYAH KAUÇUK ";
$data[] = "PİPO";
$data[] = "YAPIŞKAN KROŞE";
$data[] = "1/2-6 PLS DÜZ REKOR";
$data[] = "1/4-6 PLS DÜZ REKOR";
$data[] = "1/4-8 PLS DÜZ REKOR";
$data[] = "1/8 PNÖMATİK TAPA SUSTURUCU";
$data[] = "1/8-6 PLS DÜZ REKOR";
$data[] = "12 PLS PNÖMATİK DİRSEK";
$data[] = "12-8 PLS BORU REDÜKSİYON";
$data[] = "4-8 PLS ORANTILI NİPEL";
$data[] = "6 PLS PNÖMATİK PERDE GEÇİŞ NİPEL";
$data[] = "8 PLS PNÖMATİK DİRSEK";
$data[] = "8 PLS PNÖMATİK PERDE GEÇİŞ NİPEL";
$data[] = "8-12 PLS ORANTILI NİPEL";
$data[] = "8-4-4 PNÖMATİK YE BAĞLANTI";
$data[] = "8-6 PLS BORU REDÜKSİYON";
$data[] = "8-6-8 PNÖMATİK TE BAĞLANTI";
$data[] = "M5 6 PLS DÜZ REKOR";
$data[] = "EXPFLEX 1/4-10 METAL DİRSEK";
$data[] = "BROTECH 1/2-6 PLS DİRSEK";
$data[] = "8-8 DÜZ REKOR";
$data[] = "6-6 DİRSEK";
$data[] = "12 DÜZ NİPEL";
$data[] = "BBL ACİL ANAHTAR PLEXİSİ";
$data[] = "BBL ARKA SAC ALT";
$data[] = "BBL ARKA SAC ÜST";
$data[] = "BBL BAŞLIK TUTACAĞI PLEXİ";
$data[] = "BBL KART SACI";
$data[] = "BBL KONNEKTÖR ARA SACI";
$data[] = "BBL LED SACI ÖN";
$data[] = "BBL ÖN ALT PLEKSİ";
$data[] = "BBL RADYATÖR SACI";
$data[] = "BBL SCARFX BBL YAZILI PLEXİ";
$data[] = "BBL SİGORTA SACI";
$data[] = "BBL TEKER SACI";
$data[] = "BBL ÜST FİLTRE PLEXİ";
$data[] = "DİODE ARKA SAC";
$data[] = "DİODE BAŞLIK TUTACAĞI PLEXİ";
$data[] = "DİODE GÖZ SACI";
$data[] = "DİODE KART SACI";
$data[] = "DİODE KONNEKTÖR SACI";
$data[] = "DİODE LED SACI ÖN";
$data[] = "DİODE ÖN SAC";
$data[] = "DİODE SİGORTA SACI";
$data[] = "EMS ARKA SAC";
$data[] = "EMS EKRAN ARKA SACI";
$data[] = "EMS GÖZ SACI";
$data[] = "EMS KART SACI";
$data[] = "EMS LED SACI ÖN";
$data[] = "EMS ÖN SAC";
$data[] = "EMS RADYATÖR SACI";
$data[] = "EMS SİGORTA SACI";
$data[] = "EMS ÜST SAC";
$data[] = "GOLD ARKA SAC";
$data[] = "GOLD BAŞLIK TUTACAĞI";
$data[] = "GOLD EKRAN ARKA SACI";
$data[] = "GOLD GÖZ SACI";
$data[] = "GOLD KART SACI";
$data[] = "GOLD LED SACI ÖN";
$data[] = "GOLD ÖN SAC";
$data[] = "GOLD ÖN SAC LED PLEXİ";
$data[] = "GOLD SİGORTA SACI";
$data[] = "Q SWİTCH ARKA SAC";
$data[] = "Q SWİTCH EKRAN ARKA SACI";
$data[] = "Q SWİTCH GÖZ SACI";
$data[] = "Q SWİTCH KART SACI";
$data[] = "Q SWİTCH KONDANSER SACI";
$data[] = "Q SWİTCH KONNEKTÖR ARA SACI";
$data[] = "Q SWİTCH LED SACI ÖN";
$data[] = "Q SWİTCH ÖN SAC";
$data[] = "Q SWİTCH ÖN SAC LED PLEXİ";
$data[] = "Q SWİTCH RADYATÖR SACI";
$data[] = "Q SWİTCH SİGORTA SACI";
$data[] = "Q SWİTCH ÜST SAC";
$data[] = "SCARFİX ARKA SAC";
$data[] = "SCARFİX KALEM BAŞLIK TUTACAĞI";
$data[] = "SCARFİX KART SACI";
$data[] = "SCARFİX LED SACI ÖN";
$data[] = "SCARFİX ÖN SAC";
$data[] = "SCARFİX RF BAŞLIK TUTACAĞI";
$data[] = "SLİM 4 LÜ BAŞLIK TUTACAĞI";
$data[] = "SLİM ARKA SAC";
$data[] = "SLİM EKRAN ARKA SACI";
$data[] = "SLİM GÖZ SACI";
$data[] = "SLİM KART SACI";
$data[] = "SLİM LED SACI ÖN";
$data[] = "SLİM ÖN SAC";
$data[] = "SLİM ÖN SAC LED PLEXİ";
$data[] = "SLİM SİGORTA SACI";
$data[] = "UMEX-S ARKA SAC";
$data[] = "UMEX-S BAŞLIK TUTACAĞI";
$data[] = "UMEX-S EKRAN ARKA SACI";
$data[] = "UMEX-S GÖZ PLEXİ";
$data[] = "UMEX-S KART SACI";
$data[] = "UMEX-S KASA YAN LED PLEXİ";
$data[] = "UMEX-S KONNEKTÖR ARA SACI";
$data[] = "UMEX-S LED SACI ÖN";
$data[] = "UMEX-S ÖN SAC";
$data[] = "UMEX-S ÖN SAC LED PLEXİ";
$data[] = "UMEX-S SİGORTA SACI";
$data[] = "UMEX-S ÜST SAC";
$data[] = "UMEX-S YAN SAC";
$data[] = "UMEX PLUS BUZ BAŞLIK";
$data[] = "UMEX PLUS SOĞUK BAŞLIK";
$data[] = "ALTIN İĞNE BAŞLIK";
$data[] = "BBL BAŞLIK";
$data[] = "DİODE BAŞLIK";
$data[] = "Q SWİTCH BAŞLIK";
$data[] = "UMEX LAZER BUZ BAŞLIK";
$data[] = "UMEX LAZER SOĞUK BAŞLIK";
$data[] = "UMEX SLİM BAŞLIK  ( TAKIM )";
$data[] = "UMEX-S BUZ BAŞLIK";
$data[] = "UMEX-S SOĞUK BAŞLIK";
$data[] = "GÖZLÜK";
$data[] = "Q SWİTCH HASTA GÖZLÜĞÜ";


        ini_set('mbstring.language','Turkish');
      
			    $viewData["isimler"] = json_encode($data);
              $this->load->view('egitim/etiket_create',$viewData);

    }

	 

	public function index($k = 0)
	{
 $aa = $this->session->userdata('aktif_kullanici_id');

 $kurallar = $this->db->query("SELECT sablon_kategoriler.sablon_kategori_adi,sablon_veriler.sablon_veri_adi,sablon_veriler.sablon_veri_detay,kullanicilar.kullanici_ad_soyad,kullanicilar.kullanici_id FROM `kullanici_sablon_tanimlari`
INNER JOIN sablon_veriler ON sablon_veriler.sablon_veri_id = kullanici_sablon_tanimlari.sablon_no
INNER JOIN sablon_kategoriler ON sablon_kategoriler.sablon_kategori_id = sablon_veriler.sablon_veri_kategori_id
INNER JOIN kullanicilar ON kullanicilar.kullanici_id = kullanici_sablon_tanimlari.kullanici_no   WHERE kullanicilar.kullanici_id=$aa ORDER BY sablon_kategoriler.sablon_kategori_id ASC")->result();
$viewData["page"] = "anasayfa";
$viewData["kurallar"] = $kurallar;
$this->load->model('Yemek_model');
		$viewData["yemek"] = $this->Yemek_model->get_by_id(date("d"))[0];
		$this->load->view('base_view',$viewData);
		return;



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
