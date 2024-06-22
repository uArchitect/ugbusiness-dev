 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
 
ESKİ SERVİS KAYDINI YENİ SERVİSE AKTAR

<section class="content text-md"> 




<?php 

$output = ""; // Tüm verileri tutacak bir çıktı dizesi oluşturalım
foreach ($query_result as $row) {
    $output .= "Eski Servis ID: " . $row->eski_servis_id . "<br>";
    $output .= "Eski Servis Seri Numarası: " . $row->eski_servis_seri_numarasi . "<br>";
    $output .= "Eski Servis Merkez Adı: " . $row->eski_servis_merkez_adi . "<br>";
    $output .= "Eski Servis İletişim: " . $row->eski_servis_iletisim_numarasi . "<br>";
$output .= "Eski Servis Sorun Bildirimi: " . $row->eski_servis_sorun . "<br>";
$output .= "Eski Servis İşlemler: " . $row->eski_servis_islem . "<br>";
$output .= "Eski Servis Görevler: " . $row->eski_servis_gorev . "<br>";
$output .= "Eski Servis Tip: " . $row->eski_servis_tip . "<br>";
$output .= "Eski Servis Garanti: " . $row->eski_garanti_durumu . "<br>";
    $output .= "Eski Servis Durum: " . $row->eski_servis_durum . "<br>";
$output .= "Eski Servis Kayıt Tarihi: " . $row->eski_servis_kayit_tarihi . "<br>";
$output .= "Eski Servis Kapatma Tarihi: " . $row->eski_servis_kapatma_tarihi . "<br><br>";
  

$output .= "Güncel Merkez: " . $row->merkez_adi . "<br>";
    $output .= "Güncel Müşteri: " . $row->musteri_ad . "<br>"; 
    $output .= "\n"; // Her kayıt arasına bir boş satır ekleyelim
}
echo $output; // Tüm verileri ekrana yazdır

?>





<div class="row">
  <div class="card">
    
  </div>
</div>



</section>
            </div>

             