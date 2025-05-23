
<?php
// Başlangıçta var olan trjsconfig dizisi
$trjsconfig = array(
    "general" => array(
        "borderColor" => "whitesmoke",
        "visibleNames" => "#ffffff"
    )
);

$sehirler = get_sehirler_salt(); 
foreach ($sehirler as $sehir) {
  $color = "";
  $c = get_country_device_control($secilen_urun,$sehir->sehir_id);
  
  if(count($c)<=0){
    $newObject = array(
      "hover" => $sehir->sehir_adi,
      "url" => base_url("cihaz/rg_medikal_cihaz_harita_il_detay/".$sehir->sehir_id."/".$secilen_urun),
      "target" => "same_window",
      "upColor" =>"#008814" ,
      "overColor" => "#3535358f",
      "downColor" => "#0c0c0c",
      "active" => true
    );
  }else{
    $newObject = array(
      "hover" => $sehir->sehir_adi,
      "url" => base_url("cihaz/rg_medikal_cihaz_harita_il_detay/".$sehir->sehir_id."/".$secilen_urun),
      "target" => "same_window",
      "upColor" => "#008814",
      "overColor" => "#3535358f",
      "downColor" => "#0c0c0c",
      "active" => true
    );
  }



$trjsconfig[$sehir->map_kodu] = $newObject;



}


$js_trjsconfig = json_encode($trjsconfig);
?>

<script>
var trjsconfig = <?php echo $js_trjsconfig; ?>;
</script>