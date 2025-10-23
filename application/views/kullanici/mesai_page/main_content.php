<?php 
// Hata raporlamasını etkinleştirin (Geliştirme aşamasında hataları görmenizi sağlar)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// API URL'si
$api_url = "https://ugbusiness.com.tr/api/tv_api";
$response = false;

// ----------------------------------------------------
// cURL ile veri çekme (file_get_contents yerine)
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Yanıtı döndür
curl_setopt($ch, CURLOPT_TIMEOUT, 10);      // Maksimum 10 saniye bekle
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // SSL sertifika kontrolünü devre dışı bırak (Gerekliyse)

$response = curl_exec($ch);

if (curl_errno($ch)) {
    // cURL Hatası oluştu
    error_log('cURL Hatası: ' . curl_error($ch));
    $response = false; // Veri çekilemedi olarak işaretle
}

curl_close($ch);
// ----------------------------------------------------


// Eğer $response 'false' ise (hata veya veri yok), varsayılan olarak boş bir dizi kullan.
$json = json_decode($response ?? '{}', true); 
$allData = $json["data"] ?? [];
?>

<?php

/**
 * Belirtilen departmana ait personelleri listeleyen HTML kartını oluşturur.
 * (PHP 7.x ile tam uyumlu)
 *
 * @param array $data Tüm personel verileri dizisi.
 * @param int $departmanId Filtrelenecek departman ID'si.
 * @param string $baslik Kart başlığı.
 * @param string $colClass Kartın sütun sınıfı (Bootstrap/Grid).
 * @param int $desktopColumns Masaüstünde kaç sütuna yayılacağını belirler.
 * @return void
 */
function createPersonnelCard(array $data, int $departmanId, string $baslik, string $colClass, int $desktopColumns = 3): void
{
    // Departman ID'sine göre personeli filtrele
    $filteredPersonnel = array_filter($data, function ($personel) use ($departmanId) {
        return ($personel["kullanici_departman_id"] == $departmanId);
    });

    // Filtrelenmiş personel yoksa kartı oluşturma
    if (empty($filteredPersonnel)) {
        return;
    }
    
    // Masaüstü sütun sayısına göre flex-basis hesapla
    $flexBasis = '';
    if ($desktopColumns > 4) {
        // Özel sütun hesaplaması
        $flexBasis = "flex-basis: calc(100% / {$desktopColumns} - 5px); min-width: 100px;";
    } else {
        // Varsayılan minimum genişlik
        $flexBasis = "min-width: 100px;"; 
    }
    
    // HTML Başlangıcı
    echo '<div class="' . $colClass . '">';
    echo '  <div class="card" style="border:1px solid #031e49;">';
    echo '    <div class="card-header d-flex justify-content-between align-items-center" style="height:40px; background:whitesmoke">';
    echo '      <h6 class="mg-b-0" style="margin:5px;color:black;font-weight:900;">' . htmlspecialchars($baslik) . '</h6>';
    echo '    </div>';
    echo '    <div class="card-body" style="padding: 6px 3px 5px 6px;">';

    echo '      <div class="d-flex flex-wrap" id="personel-listesi-' . $departmanId . '">';
    
    
    foreach ($filteredPersonnel as $personel) {
        
        // PHP 7.x Uyumlu Renk Tanımlaması (match yerine switch kullanıldı)
        $renk = "#bb0707"; // default
        switch ($personel["durum_renk"]) {
            case "green":
                $renk = "green";
                break;
            case "orange":
                $renk = "#fa6402";
                break;
            case "blue":
                $renk = "#0000ff";
                break;
            case "black":
                $renk = "#000000";
                break;
        }

        // Koşullu (Ternary) operatör PHP 7.x'te desteklenir.
        $yaziRenk = $personel["durum_renk"] === "orange" ? "#522401" : "#fff";

        // Personel Kartı HTML'i
        echo '        <button type="button" class="btn btn-secondary custombtn me-1 m-1 mb-1"';
        echo '          style="flex-grow: 1; ' . $flexBasis . ' height:65px; line-height:12px; padding:5px; border-radius:3px;';
        echo '          border:2px solid black; background-color:' . $renk . '; color:' . $yaziRenk . ';">';
        echo '          <span style="font-size:7px">';
        echo '            <b style="font-size:10px">';
        echo                  htmlspecialchars($personel["kullanici_ad_soyad"]) . '<br>';
        echo '              <span style="opacity:1;font-weight:400;font-size:11px">';
        echo                  $personel["mesai_baslama_saati"];
        echo '              </span>';
        echo '            </b>';
        echo '          </span>';
        echo '        </button>';
    }
    
    // HTML Bitişi
    echo '      </div>'; // .d-flex.flex-wrap
    echo '    </div>'; // .card-body
    echo '  </div>'; // .card
    echo '</div>'; // .col-*
}
?>

<div class="content-wrapper" style="padding-top:8px">
    <section class="content text-md">
        <div class="row g-2">

            <?php 
            // Yönetim Departmanı
            createPersonnelCard($allData, 1, "Yönetim Departmanı Personel Mesai Bilgileri", "col-12 col-sm-6 col-lg-3");

            // Bilgi İşlem Departmanı
            createPersonnelCard($allData, 14, "Bilgi İşlem Departmanı Personel Mesai Bilgileri", "col-12 col-sm-6 col-lg-3");

            // Satış Departmanı
            createPersonnelCard($allData, 12, "Satış Departmanı Personel Mesai Bilgileri", "col-12 col-sm-6 col-lg-3");

            // İdari Personel
            createPersonnelCard($allData, 21, "İdari Personel Mesai Bilgileri", "col-12 col-sm-6 col-lg-3");

            // Muhasebe Personel
            createPersonnelCard($allData, 13, "Muhasebe Personel Mesai Bilgileri", "col-12 col-sm-6 col-lg-3");

            // Eğitmen Personel
            createPersonnelCard($allData, 15, "Eğitmen Personel Mesai Bilgileri", "col-12 col-sm-6 col-lg-3");

            // Satın Alma Personel
            createPersonnelCard($allData, 20, "Satın Alma Personel Mesai Bilgileri", "col-12 col-sm-6 col-lg-3");

            // Üretim Personel (Özel sütun sayısı: 7)
            createPersonnelCard($allData, 10, "Üretim Personel Mesai Bilgileri", "col-12 col-lg-6", 7);

            // Teknik Servis Personel (Özel sütun sayısı: 7)
            createPersonnelCard($allData, 11, "Teknik Servis Personel Mesai Bilgileri", "col-12 col-lg-6", 7);
            
            ?>
        </div>
    </section>
</div>