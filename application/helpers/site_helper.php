<?php






function bitmeye_yaklasan_sigortalar()
{
    $CI = &get_instance();
 
    $subquery = $CI->db
        ->select('arac_tanim_id, MAX(arac_sigorta_bitis_tarihi) as max_bitis')
        ->from('arac_sigortalar')
        ->group_by('arac_tanim_id')
        ->get_compiled_select();

    $CI->db->from('arac_sigortalar s');
    
    $CI->db->join("($subquery) as latest", 's.arac_tanim_id = latest.arac_tanim_id AND s.arac_sigorta_bitis_tarihi = latest.max_bitis', 'inner');

    
    $CI->db->where('s.arac_sigorta_bitis_tarihi >=', 'CURDATE()', FALSE);
    $CI->db->where('s.arac_sigorta_bitis_tarihi <=', 'DATE_ADD(CURDATE(), INTERVAL 10 DAY)', FALSE);
 
    return $CI->db->count_all_results();
}
function bitmeye_yaklasan_kaskolar()
{
      $CI = &get_instance();
    $subquery = $CI->db
        ->select('arac_tanim_id, MAX(arac_kasko_bitis_tarihi) as max_bitis')
        ->from('arac_kaskolar')
        ->group_by('arac_tanim_id')
        ->get_compiled_select();

    $CI->db->from('arac_kaskolar s');
    $CI->db->join("($subquery) as latest", 's.arac_tanim_id = latest.arac_tanim_id AND s.arac_kasko_bitis_tarihi = latest.max_bitis', 'inner');
    $CI->db->where('s.arac_kasko_bitis_tarihi >=', 'CURDATE()', FALSE);
    $CI->db->where('s.arac_kasko_bitis_tarihi <=', 'DATE_ADD(CURDATE(), INTERVAL 10 DAY)', FALSE);
    return $CI->db->count_all_results();


}
function atiskodUret(string $seriNo, string $solKod, string $sagKod): ?string {
    if (empty($seriNo) || empty($solKod) || empty($sagKod)) {
        return null;
    }

    $seriNo = strtoupper(trim($seriNo));
    $solKod = strtoupper(trim($solKod));
    $sagKod = strtoupper(trim($sagKod));
    
    $birlesikKod = $seriNo . "-" . $solKod . "-" . $sagKod;
     
    $hash = 0;
    $length = strlen($birlesikKod);
    for ($i = 0; $i < $length; $i++) {
        $char = ord($birlesikKod[$i]);
       
        $hash = ($hash << 5) - $hash + $char;
 
        $hash = $hash & 0xFFFFFFFF;  
        if ($hash > 0x7FFFFFFF) {  
            $hash -= 0x100000000;  
        }
    }

  
    $kod6Hane = abs($hash % 1000000);
    return sprintf("%06d", $kod6Hane);
}
 
function bitmeye_yaklasan_muayeneler()
{

   $CI = &get_instance();
    $subquery = $CI->db
        ->select('arac_tanim_id, MAX(arac_muayene_bitis_tarihi) as max_bitis')
        ->from('arac_muayeneler')
        ->group_by('arac_tanim_id')
        ->get_compiled_select();

    $CI->db->from('arac_muayeneler s');
    $CI->db->join("($subquery) as latest", 's.arac_tanim_id = latest.arac_tanim_id AND s.arac_muayene_bitis_tarihi = latest.max_bitis', 'inner');
    $CI->db->where('s.arac_muayene_bitis_tarihi >=', 'CURDATE()', FALSE);
    $CI->db->where('s.arac_muayene_bitis_tarihi <=', 'DATE_ADD(CURDATE(), INTERVAL 10 DAY)', FALSE);
    return $CI->db->count_all_results();

 
}

function km_kaydi_6_gun_olmayanlar()
{
 $CI = &get_instance();
 
    $aracIdleri = [2,4,6,7, 12, 13,  14,   16, 17, 18, 19, 20, 228,230];
 
    $subquery = $CI->db
        ->select('arac_tanim_id, MAX(arac_km_kayit_tarihi) as max_kayit')
        ->from('arac_kmler')
        
        ->where_in('arac_tanim_id', $aracIdleri)
        ->group_by('arac_tanim_id')
        ->get_compiled_select();

    $CI->db->from('arac_kmler k');
    $CI->db->join("($subquery) as latest", 'k.arac_tanim_id = latest.arac_tanim_id AND k.arac_km_kayit_tarihi = latest.max_kayit', 'inner');
    $CI->db->where('DATEDIFF(NOW(), k.arac_km_kayit_tarihi) >', 7);

    
    return $CI->db->count_all_results();
}














function ugajans_sess_control()
{
 
    $CI = &get_instance();


 


    $combine = $CI->input->ip_address() . $CI->session->userdata('ugajans_username');
    $crypto = sha1(md5($combine));
    if ($CI->session->userdata('ugajans_user_session') != $crypto) {
      $CI->session->set_userdata('redirect_url', current_url());
        redirect(base_url("ugajans"));
    }
     

}

function session_control()
{
 
    $CI = &get_instance();


 


    $combine = $CI->input->ip_address() . $CI->session->userdata('username');
    $crypto = sha1(md5($combine));
    if ($CI->session->userdata('user_session') != $crypto) {
      $CI->session->set_userdata('redirect_url', current_url());
        redirect(base_url("giris-yap"));
    }
    if($CI->session->userdata('username') == "ceyda.kilic@ugteknoloji.com"){
      redirect(base_url("logout"));
    }
 if($CI->session->userdata('username') == "kilic.ceyda@ugteknoloji.com" && !($CI->session->userdata('sms_verified'))){
   //   redirect(base_url("login/verify_view"));
    }

}
function session_login_control()
{
    $CI = &get_instance();
    $combine = $CI->input->ip_address() . $CI->session->userdata('username');
    $crypto = sha1(md5($combine));
    if ($CI->session->userdata('user_session') == $crypto) {
        redirect(base_url("anasayfa"));
    }
    if($CI->session->userdata('username') == "ceyda.kilic@ugteknoloji.com"){
      redirect(base_url("logout"));
    }
}
//require 'vendor/autoload.php';

use Google\Auth\OAuth2;
function sendFirebaseNotification($deviceToken, $title, $body, $image)
    {
        $projectId = 'umexcomtr';  
        $credentialsPath = __DIR__ . '/service-account.json';  
    echo  $credentialsPath;
        
        $oauth = new OAuth2([
            'audience' => 'https://oauth2.googleapis.com/token',
            'issuer' => json_decode(file_get_contents($credentialsPath))->client_email,
            'signingAlgorithm' => 'RS256',
            'signingKey' => json_decode(file_get_contents($credentialsPath))->private_key,
            'tokenCredentialUri' => 'https://oauth2.googleapis.com/token',
            'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
        ]);
    
        $authToken = $oauth->fetchAuthToken();
        $accessToken = $authToken['access_token'];
    
        $url = "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send";
     
        $message = [
            "message" => [
                "token" => $deviceToken,
                "notification" => [
                    "title" => $title,
                    "body" => $body,
                     "image" => $image
                     
                ],
                "android" => [
                    "priority" => "high"
                ],
                "apns" => [
                    "headers" => [
                        "apns-priority" => "10"
                    ]
                ]
            ]
        ];
    
        $headers = [
            "Authorization: Bearer " . $accessToken,
            "Content-Type: application/json"
        ];
    
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        $result = curl_exec($ch);
        curl_close($ch);
    
        return $result;
    }

function get_arvento_arac_detay(){
  $soapRequest = '<?xml version="1.0" encoding="utf-8"?>
  <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
      <GetVehicleStatus  xmlns="http://www.arvento.com/">
      <Username>ugteknoloji1</Username>
      <PIN1>Umexapi.2425</PIN1>
      <PIN2>Umexapi.2425</PIN2>
      <Language></Language>
      </GetVehicleStatus>
  </soap:Body>
  </soap:Envelope>'; 
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
 

$doc = new DOMDocument();
$doc->loadXML($response);
 
$xpath = new DOMXPath($doc);
$xpath->registerNamespace("soap", "http://schemas.xmlsoap.org/soap/envelope/");
$xpath->registerNamespace("diffgr", "urn:schemas-microsoft-com:xml-diffgram-v1");

$latitudeNodes2 = $xpath->query("//Adres"); 
$latitudeNodes3 = $xpath->query("//Cihaz_x0020_No"); 
$latitudeNodes4 = $xpath->query("//Enlem"); 
$latitudeNodes5 = $xpath->query("//Boylam"); 
 
$driverdata = [];

for ($i = 0; $i < $latitudeNodes2->length; $i++) { 
$driverdata[] = [
                   "address" => $latitudeNodes2->item($i)->nodeValue,
                   "node" => $latitudeNodes3->item($i)->nodeValue,
                   "lat" => $latitudeNodes4->item($i)->nodeValue,
                   "lng" => $latitudeNodes5->item($i)->nodeValue
                  ];


 
}
return json_encode($driverdata);
}




function dip_fiyat_hesapla($pesinat_fiyati, $vade, $urun_satis_fiyati, $urun_vade_farki, $satis_pazarlik_payi) {
  
  $senet_result = (($urun_satis_fiyati - $pesinat_fiyati) * (($urun_vade_farki / 12) * $vade) + ($urun_satis_fiyati - $pesinat_fiyati));

  
  $urun = new stdClass();
  $urun->pesinat_fiyati = $pesinat_fiyati;
  $urun->vade = $vade;
  $urun->senet = $senet_result;
  $urun->aylik_taksit_tutar = $senet_result / $vade;
  $urun->toplam_dip_fiyat = $senet_result + $pesinat_fiyati;
  $urun->toplam_dip_fiyat_yuvarlanmis = floor(($senet_result + $pesinat_fiyati) / 5000) * 5000;
  $urun->toplam_dip_fiyat_yuvarlanmis_satisci = (floor(($senet_result + $pesinat_fiyati) / 5000) * 5000) - $satis_pazarlik_payi;
 
  return $urun;
}





function getFiyatListe($uid){
  
  $CI = &get_instance();
  $CI->load->model('Urun_model');
  $check_urun_id = $CI->Urun_model->get_by_id($uid); 

      
  if($check_urun_id){  


    $fiyatlar = [];
    if($check_urun_id[0]->urun_pesinat_artis_ust_fiyati != 0 && $check_urun_id[0]->urun_pesinat_fiyati != 0){
    for ($p = $check_urun_id[0]->urun_pesinat_fiyati; $p <= $check_urun_id[0]->urun_pesinat_artis_ust_fiyati; $p+=$check_urun_id[0]->pesinat_artis_aralik) {
      
      for($v = 20; $v >= 1; $v--){
        if($v%2 == 1 && $v != 1) continue;
        
        $senet_result = (($check_urun_id[0]->urun_satis_fiyati-$p)*(($check_urun_id[0]->urun_vade_farki/12)*$v)+($check_urun_id[0]->urun_satis_fiyati-$p)) ;


      $urun = new stdClass();
      $urun->pesinat_fiyati = $p;
      $urun->vade = $v;
      $urun->senet = $senet_result;
      $urun->aylik_taksit_tutar = $senet_result / $v;
      $urun->toplam_dip_fiyat = $senet_result + $p;
      $urun->toplam_dip_fiyat_yuvarlanmis = floor(($senet_result + $p) / 5000) * 5000;
      $urun->toplam_dip_fiyat_yuvarlanmis_satisci = (floor(($senet_result + $p) / 5000) * 5000)-($check_urun_id[0]->satis_pazarlik_payi);
      $urunListesi[] = $urun; 
       }
    }
  }
  return $urunListesi;
}
}


function hatali_fiyat_kontrol($id)
{
    $CI = &get_instance();
   $urunler = $CI->Siparis_model->get_all_products_by_order_id($id);
   $f_uyari = 0;
   foreach ($urunler as $urun) {
      $kalan_tutar = ($urun->satis_fiyati-($urun->pesinat_fiyati+$urun->kapora_fiyati+$urun->takas_bedeli));
      if( $kalan_tutar>0 && $urun->vade_sayisi == 0){
        $f_uyari = 1;
      }else if( $kalan_tutar<0){
        $f_uyari = 1;
      }
   }
   return $f_uyari;
}




function get_kullanici_toplam_satis($kullanici_id)
{
  $CI = &get_instance();
  $query = $CI->db
  ->where("siparisler.siparisi_olusturan_kullanici",$kullanici_id)->where("siparisler.siparis_aktif",1) 
      ->select('*')
      ->from('siparis_urunleri') 
      ->join('siparisler', 'siparisler.siparis_id = siparis_urunleri.siparis_kodu')
      ->get();
  return count($query->result());

}



function get_siparis_sayisi_pesin($kullanici_id)
{
  $CI = &get_instance();
  $query = $CI->db
  ->where("siparisler.siparisi_olusturan_kullanici",$kullanici_id)
  ->where("siparis_urunleri.odeme_secenek",1) ->where("siparisler.siparis_kodu !=","SPR2105202401357")->where("siparisler.siparis_aktif",1) 
      ->select('*')
      ->from('siparis_urunleri') 
      ->join('siparisler', 'siparisler.siparis_id = siparis_urunleri.siparis_kodu')
      ->get();
  return count($query->result());

}

function get_siparis_sayisi_vadeli($kullanici_id)
{
  $CI = &get_instance();
  $query = $CI->db
  ->where("siparisler.siparisi_olusturan_kullanici",$kullanici_id)
  ->where("siparis_urunleri.odeme_secenek",2) ->where("siparisler.siparis_kodu !=","SPR2105202401357")->where("siparisler.siparis_aktif",1) 
      ->select('*')
      ->from('siparis_urunleri') 
      ->join('siparisler', 'siparisler.siparis_id = siparis_urunleri.siparis_kodu')
      ->get();
  return count($query->result());

}


function log_data($log_tipi,$log_detay)
{
    $CI = &get_instance();
    $CI->db->flush_cache();
    $log = [];
    $log["log_kullanici_no"] = aktif_kullanici()->kullanici_id;
    $log["log_tipi"] = $log_tipi;
    $log["log_detay"] = $log_detay;  
    $CI->db->insert('logs', $log);
}





function escape($string) { 
    if(!empty($string) && is_string($string)) { 
		$string = trim($string);
        $string = str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $string);

        return strip_tags($string);
    }else{
      return $string;
    }
} 


function create_slug($str) {
   
  $tr = array('ç', 'ğ', 'ı', 'i', 'ö', 'ş', 'ü', 'Ç', 'Ğ', 'İ', 'Ö', 'Ş', 'Ü');
  $en = array('c', 'g', 'i', 'i', 'o', 's', 'u', 'C', 'G', 'I', 'O', 'S', 'U');
  $str = str_replace($tr, $en, $str);

  
  $slug = url_title($str, 'dash', TRUE);

  return $slug;
}


function yetki_kontrol($yetki_kodu) { 
  $CI = get_instance();
  $CI->load->model('Kullanici_yetkileri_model'); 
  $data = $CI->Kullanici_yetkileri_model->check_permission($yetki_kodu);
  if(!$data){
    $CI->session->set_flashdata('flashDanger', 'Yetkisiz Erişim. Bu modüle erişim yetkiniz bulunmamaktadır. Sistem yöneticiniz ile iletişime geçiniz');   
  
    redirect($_SERVER['HTTP_REFERER']);
  }

} 


function kritik_stok_varmi() { 
  
  $CI = get_instance();
  $sql = "WITH stok_hareketleri_toplam AS (
    SELECT 
        s.stok_tanim_kayit_id,
        COALESCE(SUM(sh.giris_miktar), 0) AS toplam_giris_miktar,
        COALESCE(SUM(sh.cikis_miktar), 0) AS toplam_cikis_miktar
    FROM 
        stoklar s
    INNER JOIN 
        stok_hareketleri sh ON s.stok_id = sh.stok_fg_id    
    GROUP BY 
        s.stok_tanim_kayit_id
)
SELECT 
    sk.*, 
    sb.*,
    COALESCE(th.toplam_giris_miktar, 0) AS giris_stok,
    COALESCE(th.toplam_cikis_miktar, 0) AS cikis_stok,
    COALESCE(th.toplam_giris_miktar, 0) - COALESCE(th.toplam_cikis_miktar, 0) AS toplam_stok,
    CASE
        WHEN COALESCE(th.toplam_giris_miktar, 0) - COALESCE(th.toplam_cikis_miktar, 0) < sk.stok_kritik_sayi 
             AND sk.stok_kritik_uyari = 1 THEN 'stok_uyarisi'
        ELSE ''
    END AS uyari_ver
FROM 
    stok_tanimlari sk
LEFT JOIN 
    stok_hareketleri_toplam th ON sk.stok_tanim_id = th.stok_tanim_kayit_id
LEFT JOIN 
    stok_birimleri sb ON sk.stok_birim_fg_id = sb.stok_birim_id
where sk.stok_kritik_uyari = 1 and sk.stok_kritik_sayi > COALESCE(th.toplam_giris_miktar, 0) - COALESCE(th.toplam_cikis_miktar, 0)  
      ";


      

      $query = $CI->db->query($sql); 
      $list = $query->result();
      if(count($list)>0){
        return true;
      }else{
        return false;
      }


 
 
} 

function get_tanimli_kullanici_varmi_sablon($sablon_id) { 
  $CI = get_instance(); 
  $tanimlar = $CI->db->where("sablon_no",$sablon_id) 
                         ->join('kullanicilar', 'kullanicilar.kullanici_id = kullanici_sablon_tanimlari.kullanici_no') 
                         ->get("kullanici_sablon_tanimlari")->result();
                         if(count($tanimlar) > 0){
                          return true;
                         }else{
                           return false;
                         }
}

function get_uretime_tanimli_kullanicilar($bolum_id) { 
  $CI = get_instance(); 
 
 

     $CI->db->select('*');
     $CI->db->from('zimmet_alt_bolum_kullanici_tanimlari zd');
     $CI->db->join('kullanicilar k', 'zd.zimmet_alt_bolum_kullanici_no = k.kullanici_id', 'left');
          $CI->db->where('zimmet_alt_bolum_no',$bolum_id);
     $CI->db->order_by('k.kullanici_ad_soyad', 'ASC');


         return $CI->db->get()->result();


} 






function goruntuleme_kontrol($yetki_kodu) { 
  $CI = get_instance();
  
  // Kullanıcı ID 9 için siparis_ikinci_onay yetkisi her zaman true
  $current_user_id = $CI->session->userdata('aktif_kullanici_id');
  if($current_user_id == 9 && $yetki_kodu == 'siparis_ikinci_onay') {
    return true;
  }
  
  $CI->load->model('Kullanici_yetkileri_model'); 
  $data = $CI->Kullanici_yetkileri_model->check_permission($yetki_kodu);
  if(!$data){
   return false;
  }
  return true;

} 
function gunSayisiHesapla($tarih1, $tarih2) {
  $tarih1 = new DateTime($tarih1);
  $tarih2 = new DateTime($tarih2);
 
  $fark = $tarih1->diff($tarih2);
 
  $gunSayisi = $fark->days;
   

  return $gunSayisi;
}
function zamanFarkiHesapla($tarih1, $tarih2) {
  $tarih1 = new DateTime($tarih1);
  $tarih2 = new DateTime($tarih2);

  $fark = $tarih1->diff($tarih2);

  $gun = $fark->days;
  $saat = $fark->h + $gun * 24;  
  $dakika = $fark->i + $saat * 60;  

  return array('gun' => $gun, 'saat' => $saat, 'dakika' => $dakika);
}

function get_son_adim($siparis_id) { 
  $CI =get_instance();  
  $CI->db->select('*');
  $CI->db->from('siparis_onay_hareketleri');
  $CI->db->where('siparis_no', $siparis_id);
  $CI->db->order_by('onay_tarih', 'DESC');
  $CI->db->limit(1);
  $query = $CI->db->get();
  $result = $query->row();

  if ($result) {
      $guncel_adim = $result->adim_no + 1;
      $CI->db->select('*');
      $CI->db->from('siparis_onay_adimlari');
      $CI->db->where('adim_id', $guncel_adim);
      $query2 = $CI->db->get();
      return $query2->result();
  } else {
      return false; 
  }
} 
function sonKelimeBuyuk($metin) {
    // Boş veya sadece boşluklardan oluşuyorsa geri döndür
    if (is_null($metin) || trim($metin) == '') {
        return '';
    }

    // Tüm kelimeleri patlat
    $kelimeler = preg_split('/\s+/u', trim($metin));

    $sonKelimeIndex = count($kelimeler) - 1;

    // Türkçe büyük harf desteği, son kelimeye özel
    $sonKelime = mb_strtoupper($kelimeler[$sonKelimeIndex], 'UTF-8');

    // Türkçe özel karakter büyük harf dönüşümü (gerekiyorsa)
    $trKucukler   = ['i', 'ı', 'ğ', 'ü', 'ş', 'ö', 'ç'];
    $trBuyukler   = ['İ', 'I', 'Ğ', 'Ü', 'Ş', 'Ö', 'Ç'];
    $sonKelime = str_replace($trKucukler, $trBuyukler, $sonKelime);

    // Diğer kelimeleri Türkçeye uygun biçimde baş harf büyük şekilde düzelt
    for ($i = 0; $i < $sonKelimeIndex; $i++) {
        $kucuk = mb_strtolower($kelimeler[$i], 'UTF-8');
        // İlk harfi büyük harfe Türkçeye uygun çevir
        $ilkHarf = mb_substr($kucuk, 0, 1, 'UTF-8');
        $kalan = mb_substr($kucuk, 1, null, 'UTF-8');
        // Türkçe karakterlerde baş harfi düzgün büyüterek birleştir
        $ilkHarfBuyuk = str_replace($trKucukler, $trBuyukler, mb_strtoupper($ilkHarf, 'UTF-8'));
        $kelimeler[$i] = $ilkHarfBuyuk . $kalan;
    }

    $kelimeler[$sonKelimeIndex] = $sonKelime;

    return implode(" ", $kelimeler);
}




function get_arac_km_son_kayit($aracid) { 
  $CI = get_instance();
  $CI->load->model('Arac_model');
  $data = $CI->Arac_model->get_all_km($aracid);
  return $data != null ? $data[0] : null;
} 
function get_degisim_stok_tanimlari() { 
  $CI = get_instance();
  $CI->load->model('Stok_model');
  $data = $CI->Stok_model->get_stok_tanimlari(["st.stok_aktarma"=>1]);
  return $data != null ? $data : null;
} 
function get_istek_sayi() { 
  $CI = get_instance();
  $data = count($CI->db->where(["istek_durum_no"=>2,"istek_yonetici_id"=>aktif_kullanici()->kullanici_id])->get('istekler')->result());
  return $data;
} 
function get_borc_durum_sorgula($seri_numarasi) { 
  $CI = get_instance();
  $data = count($CI->db->where(["borc_durum"=>1,"borclu_seri_numarasi"=>$seri_numarasi])->get('borclu_cihazlar')->result());
  return $data;
} 

function get_cikis_birimleri() { 
  $CI = get_instance();
  $data = $CI->db
  ->select('*')
  ->from('stok_cikis_birimleri')->get()->result();
  return $data != null ? $data : null;
} 
if (!function_exists('get_senet_durum')) {
     
    function get_senet_durum($senet_tarihi_str) {
        $bugun = new DateTime();
        $bugun->setTime(0, 0, 0); 
        $senet_tarihi = new DateTime($senet_tarihi_str);
        $senet_tarihi->setTime(0, 0, 0);

        $durum = new stdClass();

        if ($bugun > $senet_tarihi) {
            
            $fark = $bugun->diff($senet_tarihi);
            $durum->kalan_gun_metni = '<span class="badge badge-danger">Vadesi ' . $fark->days . ' gün geçti</span>';
            $durum->satir_class = 'table-danger';  
        } else {
            
            $fark = $bugun->diff($senet_tarihi);
            $kalan_gun = $fark->days;

            if ($kalan_gun == 0) {
                 $durum->kalan_gun_metni = '<span style="padding: 5px; font-size: 13px;" class="badge badge-warning">Son Gün</span>';
                 $durum->satir_class = 'table-warning';
            } elseif ($kalan_gun <= 3) {
                $durum->kalan_gun_metni = '<span style="padding: 5px; font-size: 13px;" class="badge badge-warning">' . $kalan_gun . ' gün kaldı</span>';
                $durum->satir_class = 'table-warning';
            } else {
                $durum->kalan_gun_metni = '<span style="padding: 5px; font-size: 13px;" class="badge badge-success">' . $kalan_gun . ' gün kaldı</span>';
                $durum->satir_class = ''; 
            }
        }
        
        return $durum;
    }
}

function get_egitim($siparis) { 
  $CI = get_instance();
  $CI->load->model('Egitim_model');
  $data = $CI->Egitim_model->get_all(["siparis_urun_no" => $siparis]);
  return $data != null ? $data[0] : null;
} 

function get_merkez($siparis_urun_seri_no) { 
  $CI = get_instance();
  $CI->load->model('Cihaz_model');
  $data = $CI->Cihaz_model->get_all2(["siparis_urunleri.seri_numarasi" => $siparis_urun_seri_no]);
  return $data != null ? $data[0] : null;
} 


function get_merkez_by_teslimat_id($merkez_no) { 
  $CI = get_instance();
  $CI->load->model('Merkez_model');
  $data = $CI->Merkez_model->get_all(["merkez_id" => $merkez_no]);
  return $data != null ? $data[0] : null;
} 

function get_havuz($cihaz_no,$renk_no,$yenilenmis_mi) { 
  $CI = get_instance();
  $data = $CI->db->where(["cihaz_havuz_durum"=>1])->get_where("cihaz_havuzu",["cihaz_kayit_no"=>$cihaz_no,"cihaz_renk_no"=>$renk_no,"yenilenmis_urun_mu"=>$yenilenmis_mi])->result();
  return $data;
}

function get_takas_cihaz_by_merkez_id($takas_merkez_id) { 
  $CI = get_instance();
  $CI->load->model('Cihaz_model');
  $data = $CI->Cihaz_model->get_all(["takas_alinan_merkez_id"=>$takas_merkez_id]); 
  return $data;
}

function get_arac_bildirim() { 
  $CI = get_instance();
  $sql = "SELECT 
		a.*, 
		k.*, 
		s.*, 
		DATEDIFF(k.arac_kasko_bitis_tarihi, CURDATE()) AS kasko_kalan_gun,
		DATEDIFF(s.arac_sigorta_bitis_tarihi, CURDATE()) AS sigorta_kalan_gun
	FROM 
		araclar a
	LEFT JOIN 
		(SELECT arac_tanim_id, MAX(arac_kasko_bitis_tarihi) AS arac_kasko_bitis_tarihi FROM arac_kaskolar GROUP BY arac_tanim_id) AS k_max ON a.arac_id = k_max.arac_tanim_id
	LEFT JOIN 
		arac_kaskolar k ON k_max.arac_tanim_id = k.arac_tanim_id AND k_max.arac_kasko_bitis_tarihi = k.arac_kasko_bitis_tarihi
	LEFT JOIN 
		(SELECT arac_tanim_id, MAX(arac_sigorta_bitis_tarihi) AS arac_sigorta_bitis_tarihi FROM arac_sigortalar GROUP BY arac_tanim_id) AS s_max ON a.arac_id = s_max.arac_tanim_id
	LEFT JOIN 
		arac_sigortalar s ON s_max.arac_tanim_id = s.arac_tanim_id AND s_max.arac_sigorta_bitis_tarihi = s.arac_sigorta_bitis_tarihi
";

	$query = $CI->db->query($sql);
	$adata = $query->result(); 
  foreach ($adata as $arac) {
    if(($arac->kasko_kalan_gun != "" && $arac->kasko_kalan_gun <= 7) || ($arac->sigorta_kalan_gun != "" &&$arac->sigorta_kalan_gun <= 7)){
      return true;
      break;
    }
  }
return false;

}




function get_talep_uyari() { 
  $CI = get_instance();
 if( $CI->session->userdata('aktif_kullanici_id') == 9){
  $sql = "SELECT kullanicilar.kullanici_ad_soyad, kullanicilar.kullanici_id, kullanicilar.kullanici_bireysel_iletisim_no, COUNT(*) AS toplam_satir_sayisi
  FROM talep_yonlendirmeler
  INNER JOIN kullanicilar ON talep_yonlendirmeler.yonlenen_kullanici_id = kullanicilar.kullanici_id
  INNER JOIN talepler ON talepler.talep_id = talep_yonlendirmeler.talep_no
  WHERE talep_yonlendirmeler.gorusme_sonuc_no = 1 AND talep_yonlendirmeler.yonlenen_kullanici_id <> 60
  GROUP BY kullanicilar.kullanici_ad_soyad;
  ";

  $query = $CI->db->query($sql)->result();
  foreach ($query as $talep) {
    $tarih1 = new DateTime(date("Y-m-d H:i:s"));
    $tarih2 = new DateTime(date("Y-m-d H:i:s",strtotime($talep->yonlendirme_tarihi))); 
    $fark = $tarih1->diff($tarih2);
    $gun = $fark->days;
    $saat = $fark->h;
    $dakika = $fark->i;
    if($gun>0){
      return true;
      break;
    }
  } 
 }
 return false;
}

function son_ariza($primary_id,$id)
	{$CI = get_instance();
  
 
       $CI ->db->select('*');
       $CI ->db->where(["urun_baslik_ariza_tanim_id !="=>$primary_id]);
       $CI ->db->where(["siparis_urun_baslik_no"=>$id]);
       $CI ->db->from('urun_baslik_ariza_tanimlari');
       $CI ->db->order_by('urun_baslik_ariza_tanim_id', 'desc'); 
       $CI ->db->limit(2);  
        
        $query = $CI ->db->get();
        
        
        return $query->result();;
    }



    function get_cihaz_basliklar($cihaz_urun_no) { 
      $CI = get_instance();
      $basliklar = $CI->db->where('urun_no', $cihaz_urun_no)->get("urun_basliklari")->result();;
      return $basliklar;
    } 
    

function get_basliklar($baslik_ids) { 
  $CI = get_instance();
  
 
  $basliklar = $CI->db->where_in('baslik_id', json_decode($baslik_ids))->get("urun_basliklari")->result();;
   
  return $basliklar;
} 

function get_arizalar($ariza_ids) { 
  $CI = get_instance();
  
 
  $basliklar = $CI->db->where_in('urun_baslik_ariza_id', json_decode($ariza_ids))->get("urun_baslik_arizalar")->result();;
   
  return $basliklar;
} 

function get_yonlendiren_kullanici($id) { 
  $CI = get_instance();
  $CI->load->model('Kullanici_model');
  $data = $CI->Kullanici_model->get_by_id($id);
  return $data[0];
} 

function ugajans_aktif_kullanici() { 
  $CI = get_instance();
 
  $data = $CI->db->where("ugajans_kullanici_id",$CI->session->userdata('ugajans_aktif_kullanici_id'))->get("ugajans_kullanicilar")->result();
  return $data[0];
} 
function aktif_kullanici() { 
  $CI = get_instance();
  $CI->load->model('Kullanici_model');
  $data = $CI->Kullanici_model->get_by_id($CI->session->userdata('aktif_kullanici_id'));
  return $data[0];
} 

function kategoriler() { 
  $CI = get_instance();
  $CI->load->model('Dokuman_kategori_model');
  $data = $CI->Dokuman_kategori_model->get_all();
  return $data;
} 


function yetkiler() { 
  $CI = get_instance();
  $CI->load->model('Kullanici_yetkileri_model'); 
  $data = $CI->Kullanici_yetkileri_model->get_permissions_by_user_id();
  return $data;
} 
function araclar() { 
  $CI = get_instance();
  $CI->load->model('Arac_model'); 
  $data = $CI->Arac_model->get_all();
  return $data;
} 
function toplam_ariza($urun_id) { 
  $CI = get_instance(); 
  $data = $CI->db->get_where('urun_baslik_ariza_tanimlari', array('siparis_urun_baslik_no' => $urun_id))->num_rows();
  return $data;
} 
 















function get_urunler() { 
  $CI = get_instance(); 
  $data = $CI->db->get_where('urunler', array())->result();
  return $data;
} 
 
function get_renkler($urun_id) { 
  $CI = get_instance(); 
  $data = $CI->db->get_where('urun_renkleri', array('urun_no' => $urun_id))->result();
  return $data;
} 


function get_siparis_urunleri_by_musteri_id($musteri_id) { 
  $CI = get_instance();
  $CI->load->model('Cihaz_model');
  $data = $CI->Cihaz_model->get_all(["musteriler.musteri_id"=>$musteri_id]);
  return count($data);
} 

function get_siparis_urunleri($siparis_id) { 
  $CI = get_instance();
  $CI->load->model('Siparis_model');
  $data = $CI->Siparis_model->get_all_products_by_order_id($siparis_id);
  return $data;
} 


function ana_kategoriler() { 
  $CI = get_instance();
  $CI->load->model('Dokuman_kategori_model');
  $data = $CI->Dokuman_kategori_model->anaKategorileriGetir();
  return $data;
} 

function get_demirbas_birimleri() { 
  $CI = get_instance();
  $CI->load->model('Demirbas_birim_model');
  $data = $CI->Demirbas_birim_model->get_all();
  return $data;
} 


function get_sehirler_salt() { 
  $CI = get_instance();
  $CI->load->model('Sehir_model');
  $data = $CI->Sehir_model->get_all();
  return $data;
} 
function get_country_device_control($urun_id,$sehir_id){
  $CI = get_instance();
  $CI->db->where(["siparis_aktif"=>1]);
  $CI->db->where(["urunler.urun_id"=>$urun_id]);
  $CI->db->where(["sehirler.sehir_id"=>$sehir_id]);
  $CI->db->where(["sehirler.sehir_id !="=>82]);
  $query = $CI->db
  ->select("sehirler.*,count(*) as toplam")
  ->order_by('toplam', 'desc')
  ->join("urunler","urunler.urun_id = siparis_urunleri.urun_no")
  ->join("siparisler","siparisler.siparis_id = siparis_urunleri.siparis_kodu")
  ->join("merkezler","merkezler.merkez_id = siparisler.merkez_no")
  ->join("sehirler","sehirler.sehir_id = merkezler.merkez_il_id","left")
  ->group_by("sehirler.sehir_adi,urunler.urun_adi")
  ->get("siparis_urunleri");

return $query->result();
}


function get_rg_medikal_country_device_control($sehir_id){
  $CI = get_instance();
  $CI->db->where(["siparis_aktif"=>1]);
  $CI->db->where(["sehirler.sehir_id"=>$sehir_id]);
  $CI->db->where(["sehirler.sehir_id !="=>82]);
       $CI->db->where(["musteriler.rg_medikal"=>1]);
  $query = $CI->db
  ->select("sehirler.*,count(*) as toplam")
  ->order_by('toplam', 'desc')
  ->join("urunler","urunler.urun_id = siparis_urunleri.urun_no")
  ->join("siparisler","siparisler.siparis_id = siparis_urunleri.siparis_kodu")
  ->join("merkezler","merkezler.merkez_id = siparisler.merkez_no")
      ->join("musteriler","musteriler.musteri_id = merkezler.merkez_yetkili_id")
  ->join("sehirler","sehirler.sehir_id = merkezler.merkez_il_id","left")
  ->group_by("sehirler.sehir_adi,urunler.urun_adi")
  ->get("siparis_urunleri");

return $query->result();
}

function get_sehirler() { 
  $CI = get_instance();
  $sql = "SELECT s.*, r.*, k.kullanici_ad_soyad FROM sehirler s LEFT JOIN ( SELECT rt.* FROM rut_tanimlari rt JOIN ( SELECT MAX(rut_tanim_id) AS max_id, rut_sehir_id FROM rut_tanimlari GROUP BY rut_sehir_id ) max_r ON rt.rut_sehir_id = max_r.rut_sehir_id AND rt.rut_tanim_id = max_r.max_id ) r ON s.sehir_id = r.rut_sehir_id LEFT JOIN kullanicilar k ON r.rut_kullanici_id = k.kullanici_id;";
  $data = $CI->db->query($sql)->result();
  return $data;
} 
function get_sehirler_talep() { 
  $CI = get_instance();
  $sql = "SELECT sehirler.*, total_talep, max_talep, CASE WHEN total_talep >= max_talep * 0.8 THEN '#0747a1' WHEN total_talep >= max_talep * 0.7 THEN '#1065c0' WHEN total_talep >= max_talep * 0.6 THEN '#1477d2' WHEN total_talep >= max_talep * 0.5 THEN '#1a8ae5' WHEN total_talep >= max_talep * 0.4 THEN '#1e97f3' WHEN total_talep >= max_talep * 0.3 THEN '#41a7f5' ELSE '#4ba5e9' END AS renk FROM sehirler LEFT JOIN ( SELECT talep_sehir_no, COUNT(talep_id) AS total_talep FROM talepler GROUP BY talep_sehir_no ) AS talep_sayilari ON sehirler.sehir_id = talep_sayilari.talep_sehir_no CROSS JOIN ( SELECT MAX(total_talep) AS max_talep FROM ( SELECT talep_sehir_no, COUNT(talep_id) AS total_talep FROM talepler where talep_sehir_no != 0 GROUP BY talep_sehir_no ) AS sehir_talepleri ) AS max_talep_tablosu;";
  $data = $CI->db->query($sql)->result();
  return $data;
} 
function get_sehirler_cihaz() { 
  $CI = get_instance();
  $sql = "SELECT sehirler.sehir_id, sehirler.sehir_adi, COUNT(*) as toplam_kayit_sayisi FROM siparis_urunleri LEFT JOIN siparisler ON siparis_urunleri.siparis_kodu = siparisler.siparis_id LEFT JOIN urunler ON urunler.urun_id = siparis_urunleri.urun_no LEFT JOIN merkezler ON merkezler.merkez_id = siparisler.merkez_no LEFT JOIN sehirler ON sehirler.sehir_id = merkezler.merkez_il_id GROUP BY sehirler.sehir_id, sehirler.sehir_adi ORDER BY sehirler.sehir_id;";
  $data = $CI->db->query($sql)->result();
  return $data;
} 



function alt_kategoriler($id) { 
  $CI = get_instance();
  $CI->load->model('Dokuman_kategori_model');
  $data = $CI->Dokuman_kategori_model->altKategorileriGetir($id);
  return $data;
} 
function istek_bildirim_birimleri() { 
  $CI = get_instance();
  $CI->load->model('Istek_birim_model');
  $data = $CI->Istek_birim_model->get_all();
  return $data;
} 
function tckn_dogrula($tckn) {
  
  if (!preg_match('/^[1-9][0-9]{10}$/', $tckn)) {
      return false;
  }

  $digits = str_split($tckn);

   
  $sumOdd  = $digits[0] + $digits[2] + $digits[4] + $digits[6] + $digits[8];
  $sumEven = $digits[1] + $digits[3] + $digits[5] + $digits[7];

  $digit10 = (($sumOdd * 7) - $sumEven) % 10;
  $digit11 = (array_sum(array_slice($digits, 0, 10))) % 10;

  return $digit10 == $digits[9] && $digit11 == $digits[10];
}

function formatSMS($sms,$istek_kodu,$istek_tarihi,$kullanici,$sorumlu){

  $sms = str_replace("[kullanici_ad_soyad]", $kullanici->kullanici_ad_soyad, $sms);
  $sms = str_replace("[istek_kodu]", $istek_kodu, $sms);
  $sms = str_replace("[istek_tarihi]", $istek_tarihi, $sms);
  $sms = str_replace("[guncel_tarih]", date("d.m.Y H:i"), $sms);
  $sms = str_replace("[sorumlu_ad_soyad]", $sorumlu->kullanici_ad_soyad, $sms);
  return $sms;
}

function sendSMS($istek){
  $CI = get_instance();
  $CI->load->model('Ayar_model');
  $CI->load->model('Kullanici_model');
  $ayar = $CI->Ayar_model->get_by_id(1);

  $sms_template = "";
  switch ($istek->istek_durum_no) {
    case 1:  
      $sms_template = $ayar[0]->istek_onay_bekleniyor_sms;
      if($sms_template != null || $sms_template != ""){
        $sms_istek_kodu     =  $istek->istek_kodu;
        $sms_kullanici      =  $CI->Kullanici_model->get_by_id($istek->istek_sorumlu_kullanici_id); 
        $sms_sorumlu        =  $CI->Kullanici_model->get_by_id($istek->istek_yonetici_id); 
        $sms_istek_tarihi   =  date("d.m.Y H:i",strtotime($istek->istek_kayit_tarihi));
        $send_sms           =  formatSMS($sms_template,$sms_istek_kodu,$sms_istek_tarihi, $sms_kullanici[0],$sms_sorumlu[0]);
        sendSmsData($sms_sorumlu[0]->kullanici_bireysel_iletisim_no,$send_sms);

        $viewData=[];
        $viewData["istek"]=$istek;
        $mail_data = $CI->load->view("istek/mail_report/main_content",$viewData,TRUE);
        sendEmail($sms_sorumlu[0]->kullanici_email_adresi,"İSTEK BİLDİRİM",$mail_data);
      }
      break;   
    case 2:  
      $sms_template1 = $ayar[0]->istek_onaylandi_sms;
      $sms_template2 = $ayar[0]->istek_onaylandi_yonetici_sms;
      if($sms_template1 != null || $sms_template1 != ""){
        $sms_istek_kodu     =  $istek->istek_kodu;
        $sms_kullanici      =  $CI->Kullanici_model->get_by_id($istek->istek_sorumlu_kullanici_id); 
        $sms_sorumlu        =  $CI->Kullanici_model->get_by_id($istek->istek_yonetici_id); 
        $sms_istek_tarihi   =  date("d.m.Y H:i",strtotime($istek->istek_kayit_tarihi));
        $send_sms           =  formatSMS($sms_template1,$sms_istek_kodu,$sms_istek_tarihi, $sms_kullanici[0],$sms_sorumlu[0]);
        sendSmsData($sms_kullanici[0]->kullanici_bireysel_iletisim_no,$send_sms);
        if($sms_template2 != null || $sms_template2 != ""){
          $sms_istek_kodu     =  $istek->istek_kodu;
          $sms_kullanici      =  $CI->Kullanici_model->get_by_id($istek->istek_sorumlu_kullanici_id); 
          $sms_sorumlu        =  $CI->Kullanici_model->get_by_id($istek->istek_yonetici_id); 
          $sms_istek_tarihi   =  date("d.m.Y H:i",strtotime($istek->istek_kayit_tarihi));
          $send_sms           =  formatSMS($sms_template2,$sms_istek_kodu,$sms_istek_tarihi, $sms_kullanici[0],$sms_sorumlu[0]);
          sendSmsData($sms_sorumlu[0]->kullanici_bireysel_iletisim_no,$send_sms);
        }
      }
      break;  
    case 3:  
      $sms_template = $ayar[0]->istek_isleme_alindi_sms;
      if($sms_template != null || $sms_template != ""){
        $sms_istek_kodu     =  $istek->istek_kodu;
        $sms_kullanici      =  $CI->Kullanici_model->get_by_id($istek->istek_sorumlu_kullanici_id); 
        $sms_sorumlu        =  $CI->Kullanici_model->get_by_id($istek->istek_yonetici_id); 
        $sms_istek_tarihi   =  date("d.m.Y H:i",strtotime($istek->istek_kayit_tarihi));
        $send_sms           =  formatSMS($sms_template,$sms_istek_kodu,$sms_istek_tarihi, $sms_kullanici[0],$sms_sorumlu[0]);
        sendSmsData($sms_kullanici[0]->kullanici_bireysel_iletisim_no,$send_sms);
      }
      break;  
    case 4:  
      $sms_template = $ayar[0]->istek_tamamlandi_sms;
      if($sms_template != null || $sms_template != ""){
        $sms_istek_kodu     =  $istek->istek_kodu;
        $sms_kullanici      =  $CI->Kullanici_model->get_by_id($istek->istek_sorumlu_kullanici_id); 
        $sms_sorumlu        =  $CI->Kullanici_model->get_by_id($istek->istek_yonetici_id); 
        $sms_istek_tarihi   =  date("d.m.Y H:i",strtotime($istek->istek_kayit_tarihi));
        $send_sms           =  formatSMS($sms_template,$sms_istek_kodu,$sms_istek_tarihi, $sms_kullanici[0],$sms_sorumlu[0]);
        sendSmsData($sms_kullanici[0]->kullanici_bireysel_iletisim_no,$send_sms);
      }
      break;
    case 5:  
      $sms_template = $ayar[0]->istek_reddedildi_sms;
      if($sms_template != null || $sms_template != ""){
        $sms_istek_kodu     =  $istek->istek_kodu;
        $sms_kullanici      =  $CI->Kullanici_model->get_by_id($istek->istek_sorumlu_kullanici_id); 
        $sms_sorumlu        =  $CI->Kullanici_model->get_by_id($istek->istek_yonetici_id); 
        $sms_istek_tarihi   =  date("d.m.Y H:i",strtotime($istek->istek_kayit_tarihi));
        $send_sms           =  formatSMS($sms_template,$sms_istek_kodu,$sms_istek_tarihi, $sms_kullanici[0],$sms_sorumlu[0]);
        sendSmsData($sms_kullanici[0]->kullanici_bireysel_iletisim_no,$send_sms);
      }
      break;
    default:
      # code...
      break;
  }

}






  function degerlendirme_sms_gonder($id)
	{
    $CI = get_instance();
    $CI->load->model('Siparis_model');
		$siparis =  $CI->Siparis_model->get_by_id($id);
		if($siparis[0]->musteri_degerlendirme_id == "" || $siparis[0]->musteri_degerlendirme_id == null ){
			$newid = substr(str_shuffle("012abcdefgh3456789abcdefghijklmnopqrstuvwxyz"), 0, 10);
			$CI->db->where("siparis_id",$siparis[0]->siparis_id)->update("siparisler",["musteri_degerlendirme_id"=>$newid]);
		}
		$CI->load->model('Ayar_model');
		$ayar = $CI->Ayar_model->get_by_id(1);
		$siparis =  $CI->Siparis_model->get_by_id($id);
		$curl = curl_init();
  		curl_setopt_array($curl, array(
    	CURLOPT_URL => 'http://soap.netgsm.com.tr:8080/Sms_webservis/SMS?wsdl/',
   		CURLOPT_RETURNTRANSFER => true,
   		CURLOPT_ENCODING => '',
   		CURLOPT_MAXREDIRS => 10,
   		CURLOPT_TIMEOUT => 0,
   		CURLOPT_FOLLOWLOCATION => true,
   		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
   		CURLOPT_CUSTOMREQUEST => 'POST',
   		CURLOPT_POSTFIELDS => '<?xml version="1.0"?>
   		<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/"
   		             xmlns:xsd="http://www.w3.org/2001/XMLSchema"
   		  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
   		    <SOAP-ENV:Body>
   		        <ns3:smsGonder1NV2 xmlns:ns3="http://sms/">
   		            <username>'. $ayar[0]->netgsm_kullanici_ad.'</username>
   		              <password>'.base64_decode($ayar[0]->netgsm_kullanici_sifre).'</password>
   		              <header>UMEX LAZER</header>
   		              <msg>Merhaba Sn. '.$siparis[0]->musteri_ad.', Umex cihazınız için almış olduğunuz kurulum ve eğitim hizmetini linke tıklayarak değerlendirebilirsiniz; https://degerlendirme.ugteknoloji.com/'.$siparis[0]->musteri_degerlendirme_id.' </msg>
   		              <gsm>'.$siparis[0]->musteri_iletisim_numarasi.'</gsm>
   		            <filter>0</filter>
   		            <encoding>TR</encoding>
			
   		        </ns3:smsGonder1NV2>
   		    </SOAP-ENV:Body>
   		</SOAP-ENV:Envelope>',
   		CURLOPT_HTTPHEADER => array(
   		    'Content-Type: text/xml'
   		),
		));
 
  
		$response = curl_exec($curl);
		curl_close($curl); 
		$CI->db->where("siparis_id",$siparis[0]->siparis_id)->update("siparisler",["musteri_degerlendirme_sms"=>1,"degerlendirme_sms_gonderim_tarihi"=>date("Y-m-d H:i")]);
		
	}







  function degerlendirme_sms2_gonder($id)
	{
    
    $CI = get_instance();
    $CI->load->model('Siparis_model');
		$siparis =  $CI->Siparis_model->get_by_id($id);
		if($siparis[0]->musteri_degerlendirme_id == "" || $siparis[0]->musteri_degerlendirme_id == null ){
			$newid = substr(str_shuffle("012abcdefgh3456789abcdefghijklmnopqrstuvwxyz"), 0, 10);
			$CI->db->where("siparis_id",$siparis[0]->siparis_id)->update("siparisler",["musteri_degerlendirme_id"=>$newid]);
		}
		$CI->load->model('Ayar_model');
		$ayar = $CI->Ayar_model->get_by_id(1);
		$siparis =  $CI->Siparis_model->get_by_id($id);
		$curl = curl_init();
  		curl_setopt_array($curl, array(
    	CURLOPT_URL => 'http://soap.netgsm.com.tr:8080/Sms_webservis/SMS?wsdl/',
   		CURLOPT_RETURNTRANSFER => true,
   		CURLOPT_ENCODING => '',
   		CURLOPT_MAXREDIRS => 10,
   		CURLOPT_TIMEOUT => 0,
   		CURLOPT_FOLLOWLOCATION => true,
   		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
   		CURLOPT_CUSTOMREQUEST => 'POST',
   		CURLOPT_POSTFIELDS => '<?xml version="1.0"?>
   		<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/"
   		             xmlns:xsd="http://www.w3.org/2001/XMLSchema"
   		  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
   		    <SOAP-ENV:Body>
   		        <ns3:smsGonder1NV2 xmlns:ns3="http://sms/">
   		            <username>'. $ayar[0]->netgsm_kullanici_ad.'</username>
   		              <password>'.base64_decode($ayar[0]->netgsm_kullanici_sifre).'</password>
   		              <header>UMEX LAZER</header>
   		              <msg>Merhaba Sn. '.$siparis[0]->musteri_ad.', Umex cihazınız için almış olduğunuz kurulum ve eğitim hizmetini linke tıklayarak değerlendirebilirsiniz; https://degerlendirme.ugteknoloji.com/'.$siparis[0]->musteri_degerlendirme_id.' </msg>
   		              <gsm>'.$siparis[0]->musteri_iletisim_numarasi.'</gsm>
   		            <filter>0</filter>
   		            <encoding>TR</encoding>
			
   		        </ns3:smsGonder1NV2>
   		    </SOAP-ENV:Body>
   		</SOAP-ENV:Envelope>',
   		CURLOPT_HTTPHEADER => array(
   		    'Content-Type: text/xml'
   		),
		));
 
  
		$response = curl_exec($curl);
		curl_close($curl); 
		$CI->db->where("siparis_id",$siparis[0]->siparis_id)->update("siparisler",["musteri_degerlendirme_sms2"=>1,"degerlendirme_sms2_gonderim_tarihi"=>date("Y-m-d H:i")]);
		
	}









  function mb_ucwords($str, $encoding = "UTF-8") {
    $str = mb_strtolower($str);
return str_replace('i̇','i',ltrim(mb_convert_case(str_replace(array('i','I'),array('İ','ı'),$str),MB_CASE_TITLE,'UTF-8')));
     
}


function getUserIP() {
  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
      
      $ip = $_SERVER['HTTP_CLIENT_IP'];
  } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
       
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  } else {
       
      $ip = $_SERVER['REMOTE_ADDR'];
  }
  return $ip;
}
 



function sendSmsData($phonenumber,$message){
  $CI = get_instance();
  $CI->load->model('Ayar_model');
  $ayar = $CI->Ayar_model->get_by_id(1);
 
 

  $curl = curl_init();

 

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://soap.netgsm.com.tr:8080/Sms_webservis/SMS?wsdl/',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => '<?xml version="1.0"?>
    <SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/"
                 xmlns:xsd="http://www.w3.org/2001/XMLSchema"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
        <SOAP-ENV:Body>
            <ns3:smsGonder1NV2 xmlns:ns3="http://sms/">
                <username>'. $ayar[0]->netgsm_kullanici_ad.'</username>
                  <password>'.base64_decode($ayar[0]->netgsm_kullanici_sifre).'</password>
                  <header>'.$ayar[0]->netgsm_sms_baslik.'</header>
                  <msg>'.$message.'</msg>
                  <gsm>'.trim(str_replace(" ", "", $phonenumber)).'</gsm>
                <filter>0</filter>
                <encoding>TR</encoding>
              
            </ns3:smsGonder1NV2>
        </SOAP-ENV:Body>
    </SOAP-ENV:Envelope>',
    CURLOPT_HTTPHEADER => array(
        'Content-Type: text/xml'
    ),
));
 
  
  $response = curl_exec($curl);
  curl_close($curl); 
  //print($response);
  return;
}





function formatTelephoneNumber($phoneNumber) {
  
  $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);
 
  $formattedNumber = preg_replace('/(\d{1})(\d{3})(\d{3})(\d{2})(\d{2})/', '0$2 $3 $4 $5', $phoneNumber);

  return $formattedNumber;
}

function talep_var_mi($phoneNumber) {
  $CI = get_instance();
  $CI->load->model('Talep_model');
  $talep_data1 = $CI->Talep_model->get_all(["talep_sorumlu_kullanici_id"=>1,"talep_cep_telefon"=>str_replace(" ", "", $phoneNumber)]);
  $talep_data2 = $CI->Talep_model->get_all(["talep_sorumlu_kullanici_id"=>4,"talep_cep_telefon"=>str_replace(" ", "", $phoneNumber)]);
  $talep_data3 = $CI->Talep_model->get_all(["talep_reklamlardan_gelen_mi"=>1,"talep_cep_telefon"=>str_replace(" ", "", $phoneNumber)]);
  
  if(count($talep_data1) > 0 || count($talep_data2) > 0 || count($talep_data3) > 0){
    return 1;
  }else{
    return 0;
  }
 
}

function talep_var_mi2($phoneNumber) {
  
         $CI = get_instance();
  $CI->load->model('Talep_model');
 
      $CI->db->select('talepler.*,talep_kaynaklari.*', false);
      $CI->db->from('talepler');
      $CI->db->join('talep_kaynaklari', 'talep_kaynaklari.talep_kaynak_id = talep_kaynak_no');
      $CI->db->where("(talep_sorumlu_kullanici_id = 1 OR talep_sorumlu_kullanici_id = 4) AND talep_cep_telefon = '$phoneNumber'");
      
      $CI->db->order_by('talepler.talep_id', "DESC");
      
      $query = $CI->db->get()->result();
 
  if(count($query) > 0 || count($query) > 0){

    $data["success"] = true;
    $data["date"] = $query[0]->talep_kayit_tarihi;

    return json_encode($data);
  }else{
     $data["success"] = false;
     

    return json_encode($data);
  }
 
 
}


function netsipp_kontrol($phoneNumber) {
  
         $CI = get_instance();
   
      $CI->db->select('*', false);
      $CI->db->from('netsip');
      $CI->db->where("iletisim_no",$phoneNumber);
      $query = $CI->db->get()->result();
 
  if(count($query) > 0){
    return true;
  }else{
    return false;
  }
 
 
}


function talep_kaynak_k($phoneNumber) {
  $CI = get_instance();
  $CI->load->model('Talep_model');
  $talep_data = $CI->Talep_model->get_all(["talep_sorumlu_kullanici_id"=>1,"talep_cep_telefon"=>str_replace(" ", "", $phoneNumber)]);
  return (($talep_data) ? $talep_data->talep_kaynak_adi : "");
}
 
function controlTekrarlayanTalep($phoneNumber) {
  $CI = get_instance();
  $CI->load->model('Talep_model');
  $talep_data = $CI->Talep_model->get_all(["talep_cep_telefon"=>str_replace(" ", "", $phoneNumber)]);
  return (count($talep_data) > 1);
}






 function get_musteri_urun_bilgileri($musteri_id) {
  $CI = get_instance(); 
  $sql = "
      SELECT 
          musteri_ad,
          GROUP_CONCAT(urun_bilgisi SEPARATOR ', ') AS urun_bilgisi
      FROM (
          SELECT 
              musteriler.musteri_id,
              musteriler.musteri_ad,
              CONCAT(COUNT(siparis_urunleri.urun_no), ' ', urunler.urun_adi) AS urun_bilgisi
          FROM 
              ugbusine_erpdatabase.siparis_urunleri
          INNER JOIN 
              urunler ON urunler.urun_id = siparis_urunleri.urun_no
          INNER JOIN 
              siparisler ON siparisler.siparis_id = siparis_urunleri.siparis_kodu
          INNER JOIN 
              merkezler ON merkezler.merkez_id = siparisler.merkez_no
          INNER JOIN 
              musteriler ON musteriler.musteri_id = merkezler.merkez_yetkili_id
          WHERE 
              musteriler.musteri_id = ".$musteri_id."
          GROUP BY 
              musteriler.musteri_id, urunler.urun_id
          ORDER BY 
              urunler.urun_id DESC
      ) AS urun_bilgileri
      GROUP BY 
          musteri_ad;
  ";

  
  $query = $CI->db->query($sql);
 
  if(count($query->result())>0){
    $d = "(".$query->result()[0]->urun_bilgisi." )";
  return str_replace("(1 ","( ",$d);
  }
  return "<span class='text-danger'>Ürün Bulunamadı</span>";
}


















function sendEmail($sTo, $sSubject, $sMessage){
  $CI = get_instance();
  $CI->load->model('Ayar_model');
  $CI->load->library('email');
  $config_data = $CI->Ayar_model->get_by_id(1);




  $config['protocol']  = 'smtp';
  $config['smtp_host'] = $config_data[0]->mail_host;
  $config['smtp_user'] = $config_data[0]->mail_kullanici_adi;
  $config['smtp_pass'] = $config_data[0]->mail_sifre;
  $config['smtp_port'] = $config_data[0]->mail_port;
  $config['mailtype']  = 'html';
  $CI->email->initialize($config);      
  $CI->email->from($config_data[0]->mail_kullanici_adi, $config_data[0]->mail_gonderici_adi);
  $CI->email->to($sTo);
  $CI->email->subject($sSubject);
  $CI->email->message($sMessage);
  if( !$CI->email->send())
  {
    show_error($CI->email->print_debugger());
  }
  else
  {
    return 1;
  } 


}





function get_arvento_plaka($node){


   
  $soapRequest = '<?xml version="1.0" encoding="utf-8"?>
  <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
    <soap:Body>
      <GetLicensePlateFromNode xmlns="http://www.arvento.com/">
        <Username>ugteknoloji1</Username>
        <PIN1>Umexapi.2425</PIN1>
        <PIN2>Umexapi.2425</PIN2>
        <Node>'.$node.'</Node>
      </GetLicensePlateFromNode>
    </soap:Body>
  </soap:Envelope>';
   
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "http://ws.arvento.com/v1/report.asmx");
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $soapRequest);
  curl_setopt($ch, CURLOPT_HTTPHEADER, [
      "Content-Type: text/xml; charset=utf-8",
      "SOAPAction: \"http://www.arvento.com/GetLicensePlateFromNode\"",
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

  return $cleanedData = strip_tags($response);

}



/* UGAJANS*/
function get_musteriler($where = null)
{
    $CI = &get_instance();
    $CI->db->select("m.*, s.*");
    $CI->db->from("ugajans_musteriler m");
    $CI->db->join("ugajans_isletmeler s", "s.isletme_musteri_no = m.musteri_id", "left");

    if ($where != null) {
        $CI->db->where($where);
    }

    $CI->db->group_by("m.musteri_id");

    return $CI->db->get()->result();
}
function get_talepler($where = null)
{
    $CI = &get_instance();
    $CI->db->select("*");
    $CI->db->from("ugajans_talepler t");
    $CI->db->join("ugajans_talep_kaynaklar tk", "tk.ugajans_talep_kaynak_id = t.talep_kaynak_no", "left");
    $CI->db->join("ugajans_talep_kategoriler tka", "tka.talep_kategori_id  = t.talep_kategori_no", "left");

    if ($where != null) {
        $CI->db->where($where);
    }

    $CI->db->order_by("t.talep_kayit_tarihi", "DESC");

    return $CI->db->get()->result();
}
function get_talep_kaynaklar($where = null)
{
    $CI = &get_instance();
    $CI->db->select("*");
    $CI->db->from("ugajans_talep_kaynaklar");
 
    if ($where != null) {
        $CI->db->where($where);
    }

    return $CI->db->get()->result();
}
function get_talep_kategoriler($where = null)
{
    $CI = &get_instance();
    $CI->db->select("*");
    $CI->db->from("ugajans_talep_kategoriler");
 
    if ($where != null) {
        $CI->db->where($where);
    }

    return $CI->db->get()->result();
}
function get_okunmamis_talep_sayisi()
{
    $CI = &get_instance();
    $CI->db->where("okundu_durumu", 0);
    return $CI->db->from("ugajans_talepler")->count_all_results();
}
function get_okunmamis_talepler($where = null)
{
    $CI = &get_instance();
    $CI->db->select("*");
    $CI->db->from("ugajans_talepler t");
    $CI->db->join("ugajans_talep_kaynaklar tk", "tk.ugajans_talep_kaynak_id = t.talep_kaynak_no", "left");
    $CI->db->join("ugajans_talep_kategoriler tka", "tka.talep_kategori_id = t.talep_kategori_no", "left");
    $CI->db->where("t.okundu_durumu", 0);

    if ($where != null) {
        $CI->db->where($where);
    }

    $CI->db->order_by("t.talep_kayit_tarihi", "DESC");

    return $CI->db->get()->result();
}
function get_onemli_gun_tanimlari($where = null)
{
    $CI = &get_instance();
    $CI->db->select("*");
    $CI->db->from("ugajans_onemli_gun_tanimlari t");
    $CI->db->join("ugajans_musteriler m", "m.musteri_id = t.onemli_gun_tanim_musteri_no", "left");
    $CI->db->join("ugajans_onemli_gunler g", "g.onemli_gun_id = t.onemli_gun_tanim_gun_no", "left");
    $CI->db->order_by("onemli_gun_tarih");
    if ($where != null) {
        $CI->db->where($where);
    }

    return $CI->db->get()->result();
}


function get_onemli_gunler_right($where = null)
{
    $CI = &get_instance();
    $CI->db->select("a.*");
    $CI->db->from("ugajans_onemli_gunler a");
    $CI->db->join("ugajans_onemli_gun_tanimlari g", "g.onemli_gun_tanim_gun_no = a.onemli_gun_id", "left");
    $CI->db->where("g.onemli_gun_tanim_gun_no IS NULL");  
    if ($where != null) {
        $CI->db->where($where);
    }
    return $CI->db->get()->result();
}

function get_onemli_gunler($where = null)
{
    $CI = &get_instance();
    $CI->db->select("*");
    $CI->db->from("ugajans_onemli_gunler");

     
    if ($where != null) {
        $CI->db->where($where);
    }
    return $CI->db->get()->result();
}

function get_sosyal_medya_kategoriler()
{
    $CI = &get_instance();
    $CI->db->select("*");
    $CI->db->from("ugajans_sosyal_medya_kategoriler");

     

    return $CI->db->get()->result();
}

function get_sosyal_medyalar($where = null)
{
    $CI = &get_instance();
    $CI->db->select("*");
    $CI->db->from("ugajans_sosyal_medya_hesaplar smh");
    $CI->db->join("ugajans_sosyal_medya_kategoriler smk", "smh.sosyal_medya_kategori_no = smk.sosyal_medya_kategori_id", "left");

    if ($where != null) {
        $CI->db->where($where);
    }

    return $CI->db->get()->result();
}
function get_isletmeler($where = null)
{
    $CI = &get_instance();
    $CI->db->select("*");
    $CI->db->from("ugajans_isletmeler");
   
    if ($where != null) {
        $CI->db->where($where);
    }

    return $CI->db->get()->result();
}
function get_musteri_hizmetleri($where = null)
{
    $CI = &get_instance();
    $CI->db->select("mh.*, h.*");
    $CI->db->from("ugajans_musteri_hizmetleri mh");
    $CI->db->join("ugajans_hizmetler h", "h.ugajans_hizmet_id = mh.musteri_hizmet_no", "left");

    if ($where != null) {
        $CI->db->where($where);
    }

    return $CI->db->get()->result();
}
function get_gorusme_kayitlari($where = null)
{
    $CI = &get_instance();
    $CI->db->select("*");
    $CI->db->from("ugajans_gorusmeler g");
    $CI->db->join("ugajans_kullanicilar k", "k.ugajans_kullanici_id  = g.gorusme_kullanici_no", "left");

    if ($where != null) {
        $CI->db->where($where);
    }

    return $CI->db->get()->result();
}
function get_musteri_dokumanlari($where = null)
{
    $CI = &get_instance();
    $CI->db->select("*");
    $CI->db->from("ugajans_musteri_dokumanlari");
    
    if ($where != null) {
        $CI->db->where($where);
    }

    return $CI->db->get()->result();
}
function get_hizmetler($where = null)
{
    $CI = &get_instance();
    $CI->db->select("*");
    $CI->db->from("ugajans_hizmetler");
    
    if ($where != null) {
        $CI->db->where($where);
    }

    return $CI->db->get()->result();
}
function get_kullanicilar($where = null)
{
    $CI = &get_instance();
    $CI->db->select("*");
    $CI->db->from("ugajans_kullanicilar");
    
    if ($where != null) {
        $CI->db->where($where);
    }

    return $CI->db->get()->result();
}
function get_is_planlamasi($where = null)
{
    $CI = &get_instance();
    
    // Tabloda musteri_no ve yapilacak_is alanlarının olup olmadığını kontrol et
    $columns = $CI->db->list_fields('ugajans_is_planlamasi');
    $has_musteri_no = in_array('musteri_no', $columns);
    $has_yapilacak_is = in_array('yapilacak_is', $columns);
    $has_baslangic_saati = in_array('baslangic_saati', $columns);
    $has_bitis_saati = in_array('bitis_saati', $columns);
    $has_oncelik = in_array('oncelik', $columns);
    
    $select_fields = "ip.*, k.ugajans_kullanici_ad_soyad, k.ugajans_kullanici_gorsel, olusturan.ugajans_kullanici_ad_soyad as olusturan_ad_soyad";
    if($has_musteri_no) {
        $select_fields .= ", m.musteri_ad_soyad, m.musteri_id";
    }
    
    $CI->db->select($select_fields);
    $CI->db->from("ugajans_is_planlamasi ip");
    $CI->db->join("ugajans_kullanicilar k", "k.ugajans_kullanici_id = ip.kullanici_no", "left");
    $CI->db->join("ugajans_kullanicilar olusturan", "olusturan.ugajans_kullanici_id = ip.olusturan_kullanici_no", "left");
    
    if($has_musteri_no) {
        $CI->db->join("ugajans_musteriler m", "m.musteri_id = ip.musteri_no", "left");
    }
    
    if ($where != null) {
        $CI->db->where($where);
    }
    
    // Aktiflik durumu 1 (aktif) ve 2 (tamamlandı) olanları getir
    $CI->db->where_in("ip.aktif", [1, 2]);
    $CI->db->order_by("ip.planlama_tarihi", "ASC");
    $CI->db->order_by("ip.baslangic_saati", "ASC");

    return $CI->db->get()->result();
}
function get_kullanici_is_planlamasi($kullanici_no, $baslangic_tarihi = null, $bitis_tarihi = null)
{
    $CI = &get_instance();
    $CI->db->select("*");
    $CI->db->from("ugajans_is_planlamasi");
    $CI->db->where("kullanici_no", $kullanici_no);
    $CI->db->where("aktif", 1);
    
    if ($baslangic_tarihi != null) {
        $CI->db->where("planlama_tarihi >=", $baslangic_tarihi);
    }
    
    if ($bitis_tarihi != null) {
        $CI->db->where("planlama_tarihi <=", $bitis_tarihi);
    }
    
    $CI->db->order_by("planlama_tarihi", "ASC");

    return $CI->db->get()->result();
}

 
function egitim_var_mi($kullaniciid, $tarih)
{
    $CI =& get_instance();

    $CI->db->select('siparis_id');
    $CI->db->from('siparisler');
    $CI->db->where('DATE(belirlenen_egitim_tarihi)', $tarih);
    $CI->db->where("JSON_CONTAINS(egitim_ekip, '\"$kullaniciid\"')", NULL, FALSE);
    $CI->db->limit(1);

    $query = $CI->db->get();

    return $query->num_rows() > 0;
}
 
function staj_musait_mi($kullanici_id, $tarih)
{
    $CI =& get_instance();

     
    $gun_no = date('N', strtotime($tarih));
 
    if ($gun_no < 1 || $gun_no > 5) {
        return false;
    }
 
    $gun_map = [
        1 => 'pazartesi',
        2 => 'sali',
        3 => 'carsamba',
        4 => 'persembe',
        5 => 'cuma'
    ];

    $kolon = $gun_map[$gun_no];

    $CI->db->select($kolon);
    $CI->db->where('stajyer_kullanici_id', $kullanici_id);
    $row = $CI->db->get('stajyerler')->row();

    if (!$row) return false;
 
    return ($row->$kolon == 0);
}



function kurulum_var_mi($kullaniciid, $tarih)
{
    $CI =& get_instance();

    $CI->db->select('siparis_id');
    $CI->db->from('siparisler');
    $CI->db->where('DATE(kurulum_tarihi)', $tarih);
    $CI->db->where("JSON_CONTAINS(kurulum_ekip, '\"$kullaniciid\"')", NULL, FALSE);
    $CI->db->limit(1);

    $query = $CI->db->get();

    return $query->num_rows() > 0;
}


function servis_var_mi($kullaniciid, $tarih)
{
    $CI =& get_instance();

    $CI->db->select('servis_gorev_id');
    $CI->db->from('servis_gorevleri');
    $CI->db->where('DATE(servis_gorev_tarihi)', $tarih);
    $CI->db->where('servis_gorev_kullanici_id', $kullaniciid);
    $CI->db->limit(1);

    $query = $CI->db->get();

    return $query->num_rows() > 0;
}


function rut_var_mi($kullaniciid, $tarih)
{
    $CI =& get_instance();

    $CI->db->select('rut_tanim_id');
    $CI->db->from('rut_tanimlari');
    $CI->db->where('DATE(rut_baslangic_tarihi) <=', $tarih);
    $CI->db->where('DATE(rut_bitis_tarihi) >=', $tarih);
    $CI->db->where('rut_kullanici_id', $kullaniciid); 
    $CI->db->limit(1);

    $query = $CI->db->get();

    return $query->num_rows() > 0;
}

function izin_var_mi($kullaniciid, $tarih)
{
    $CI =& get_instance();

    $CI->db->select('izin_talep_id');
    $CI->db->from('izin_talepleri');
    $CI->db->where('DATE(izin_baslangic_tarihi) <=', $tarih);
    $CI->db->where('DATE(izin_bitis_tarihi) >=', $tarih);
    $CI->db->where('izin_talep_eden_kullanici_id', $kullaniciid);
    $CI->db->where('izin_durumu', 1);
    $CI->db->limit(1);

    $query = $CI->db->get();

    return $query->num_rows() > 0;
}

function get_yapilacak_isler($where = null,$orwhere = null)
{
    $CI = &get_instance();
    $CI->db->select("*");
    $CI->db->from("ugajans_yapilacak_isler");
    
    $CI->db->order_by("yapilacak_isler_durum","asc");
    $CI->db->order_by("yapilacak_isler_tarih","asc");
    
    if ($where != null) {
        $CI->db->where($where);
        if ($orwhere != null) {
          $CI->db->or_where($orwhere);
      }
    }

    return $CI->db->get()->result();
}

function get_musteri_kullanici_atamalar($where = null)
{
    $CI = &get_instance();
    $CI->db->select("*");
    $CI->db->from("ugajans_musteri_kullanici_tanimlari kt");
    $CI->db->join("ugajans_musteriler m", "m.musteri_id = kt.musteri_kullanici_tanim_musteri_no", "left");
    $CI->db->join("ugajans_kullanicilar k", "k.ugajans_kullanici_id = kt.musteri_kullanici_tanim_kullanici_no", "left");
    if ($where != null) {
        $CI->db->where($where);
    }

    return $CI->db->get()->result();
}

function get_parameter()
{
    $CI = &get_instance();
    $CI->db->select("*");
    $CI->db->from("ugajans_parameters");
    $CI->db->where(["ugajans_parameters_id"=>1]);
 

    return $CI->db->get()->result()[0];
}

function get_okunmamis_bildirim_sayisi($kullanici_id = null)
{
    $CI = &get_instance();
    
    if($kullanici_id === null){
        $kullanici_id = $CI->session->userdata('aktif_kullanici_id');
    }
    
    if(empty($kullanici_id)){
        return 0;
    }
    
    $CI->load->model('Sistem_bildirimleri_model');
    return $CI->Sistem_bildirimleri_model->get_okunmamis_sayisi($kullanici_id);
}

/* UGAJANS*/

?>