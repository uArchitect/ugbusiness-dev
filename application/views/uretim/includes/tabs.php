<?php
$current_url = current_url();
$current_path = parse_url($current_url, PHP_URL_PATH);
$base_path = parse_url(base_url(), PHP_URL_PATH);
$relative_path = str_replace($base_path, '', $current_path);
$relative_path = trim($relative_path, '/');

$tabs = [];

// Üretim Planlama - Yetki kontrolü
if(goruntuleme_kontrol("uretim_plan_yonetimi")) {
  $tabs[] = [
    'url' => base_url("uretim_planlama"),
    'icon' => 'fas fa-calendar-alt',
    'label' => 'Üretim Planlama',
    'active' => ($relative_path == 'uretim_planlama' || strpos($relative_path, 'uretim_planlama') !== false && strpos($relative_path, 'cihaz_havuz') === false && strpos($relative_path, 'baslik_havuz') === false)
  ];
}

// Cihaz Havuzu - Yetki kontrolü
if(goruntuleme_kontrol("cihaz_havuz_goruntule") || goruntuleme_kontrol("cihaz_havuz_duzenle")) {
  $tabs[] = [
    'url' => base_url("cihaz/cihaz_havuz_liste_view"),
    'icon' => 'fas fa-microchip',
    'label' => 'Cihaz Havuzu',
    'active' => (strpos($relative_path, 'cihaz_havuz') !== false && strpos($relative_path, 'baslik_havuz') === false)
  ];
  
  // Yeni Cihaz Kayıt - Yetki kontrolü
  if(goruntuleme_kontrol("cihaz_havuz_duzenle")) {
    $tabs[] = [
      'url' => base_url("cihaz/cihaz_havuz_tanimla_view"),
      'icon' => 'fas fa-plus-circle',
      'label' => 'Yeni Cihaz Kayıt',
      'active' => (strpos($relative_path, 'cihaz_havuz_tanimla') !== false)
    ];
  }
}

// Başlık Havuzu - Yetki kontrolü
if(goruntuleme_kontrol("baslik_havuz_goruntule") || goruntuleme_kontrol("baslik_havuz_duzenle")) {
  $tabs[] = [
    'url' => base_url("baslik/baslik_havuz_liste_view"),
    'icon' => 'fas fa-qrcode',
    'label' => 'Başlık Havuzu',
    'active' => (strpos($relative_path, 'baslik_havuz_liste') !== false)
  ];
  
  // Yeni Başlık QR - Yetki kontrolü
  if(goruntuleme_kontrol("baslik_havuz_duzenle")) {
    $tabs[] = [
      'url' => base_url("baslik/baslik_havuz_tanimla_view"),
      'icon' => 'fas fa-plus-circle',
      'label' => 'Yeni Başlık QR',
      'active' => (strpos($relative_path, 'baslik_havuz_tanimla') !== false)
    ];
  }
}
?>

<nav class="modern-tabs-nav" role="tablist">
  <div class="modern-tabs-container">
    <?php 
    $tab_count = count($tabs);
    $index = 0;
    foreach($tabs as $tab): 
      $index++;
    ?>
      <a href="<?=$tab['url']?>" 
         class="modern-tab <?=$tab['active'] ? 'active' : ''?>" 
         role="tab"
         aria-selected="<?=$tab['active'] ? 'true' : 'false'?>">
        <span class="modern-tab-icon">
          <i class="<?=$tab['icon']?>"></i>
        </span>
        <span class="modern-tab-label"><?=$tab['label']?></span>
      </a>
      <?php if($index < $tab_count): ?>
        <span class="modern-tab-separator">|</span>
      <?php endif; ?>
    <?php endforeach; ?>
  </div>
</nav>

