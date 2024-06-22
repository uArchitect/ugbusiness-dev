
<?php
// Başlangıçta var olan trjsconfig dizisi
$trjsconfig = array(
    "general" => array(
        "borderColor" => "#12489e",
        "visibleNames" => "#ffffff"
    )
);

$sehirler = get_sehirler_talep();
foreach ($sehirler as $sehir) {
  $color = "";
 
$newObject = array(
  "hover" => $sehir->sehir_adi,
  "url" => base_url("talep/yonlendirmeler?sehir_no=".$sehir->sehir_id),
  "target" => "same_window",
  "upColor" => $sehir->renk,
  "overColor" => "#3535358f",
  "downColor" => "#0c0c0c",
  "active" => true
);
$trjsconfig[$sehir->map_kodu] = $newObject;



}


$js_trjsconfig = json_encode($trjsconfig);
?>

<script>
var trjsconfig = <?php echo $js_trjsconfig; ?>;
</script>