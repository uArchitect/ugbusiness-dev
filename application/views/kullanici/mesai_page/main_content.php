<?php 
 $api_url = "https://ugbusiness.com.tr/api/tv_api";
                    $response = @file_get_contents($api_url);

?>
<?php
 
function createPersonnelCard(array $data, int $departmanId, string $baslik, string $colClass, int $desktopColumns = 3): void
{
     
    $filteredPersonnel = array_filter($data, function ($personel) use ($departmanId) {
        return ($personel["kullanici_departman_id"] == $departmanId);
    });

     
    if (empty($filteredPersonnel)) {
        return;
    }
    
   
    $flexBasis = '';
    if ($desktopColumns > 4) {
        
        $flexBasis = "flex-basis: calc(100% / {$desktopColumns} - 5px); min-width: 100px;";
    } else {
         
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
        $renk = match($personel["durum_renk"]) {
            "green"  => "green",
            "orange" => "#fa6402",
            "blue"   => "#0000ff",
            "black"  => "#000000",
            default  => "#bb0707"
        };
        $yaziRenk = $personel["durum_renk"] === "orange" ? "#522401" : "#fff";

         
        echo '        <button type="button" class="btn btn-secondary custombtn me-1 m-1 mb-1"';
        echo '          style="flex-grow: 1; ' . $flexBasis . ' height:65px; line-height:12px; padding:5px; border-radius:3px;';
        echo '          border:2px solid black; background-color:' . $renk . '; color:' . $yaziRenk . ';">';
        echo '          <span style="font-size:7px">';
        echo '            <b style="font-size:10px">';
        echo                htmlspecialchars($personel["kullanici_ad_soyad"]) . '<br>';
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
 
$json = json_decode($response ?? '{}', true);  
$allData = $json["data"] ?? [];
?>

<div class="content-wrapper" style="padding-top:8px">
    <section class="content text-md">
        <div class="row g-2">

            <?php 
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
 
            // Üretim Personel
            createPersonnelCard($allData, 10, "Üretim Personel Mesai Bilgileri", "col-12 col-lg-6", 7);

            // Teknik Servis Personel
            createPersonnelCard($allData, 11, "Teknik Servis Personel Mesai Bilgileri", "col-12 col-lg-6", 7);
            
            ?>
        </div>
    </section>
</div>