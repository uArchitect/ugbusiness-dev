<?php
$current_url = current_url();
$current_path = parse_url($current_url, PHP_URL_PATH);
$base_path = parse_url(base_url(), PHP_URL_PATH);
$relative_path = str_replace($base_path, '', $current_path);
$relative_path = trim($relative_path, '/');

$tabs = [];

// Tüm Müşteriler - Yetki kontrolü
if(goruntuleme_kontrol("musterileri_goruntule")) {
  $tabs[] = [
    'url' => base_url("musteri"),
    'icon' => 'fas fa-users',
    'label' => 'Tüm Müşteriler',
    'active' => ($relative_path == 'musteri' || strpos($relative_path, 'musteri') !== false && strpos($relative_path, 'cihaz') === false && strpos($relative_path, 'merkez') === false)
  ];
}

// Tüm Cihazlar - Yetki kontrolü
if(goruntuleme_kontrol("cihazlari_goruntule")) {
  $tabs[] = [
    'url' => base_url("cihaz/tum-cihazlar"),
    'icon' => 'fas fa-microchip',
    'label' => 'Tüm Cihazlar',
    'active' => (($relative_path == 'cihaz' || strpos($relative_path, 'cihaz/tum-cihazlar') !== false || strpos($relative_path, 'cihaz/list') !== false) && strpos($current_url, 'durum') === false && strpos($relative_path, 'borclu') === false && strpos($relative_path, 'rgmedikal') === false && strpos($relative_path, 'tumcihazlarilbazli') === false && strpos($relative_path, 'cihaz_tanimlama') === false)
  ];
  
  // İade Cihazları
  $tabs[] = [
    'url' => base_url("cihaz/tum-cihazlar?durum=iade"),
    'icon' => 'fas fa-undo',
    'label' => 'İade Cihazları',
    'active' => (strpos($current_url, 'durum=iade') !== false)
  ];
  
  // Takas Cihazları
  $tabs[] = [
    'url' => base_url("cihaz/tum-cihazlar?durum=takas"),
    'icon' => 'fas fa-exchange-alt',
    'label' => 'Takas Cihazları',
    'active' => (strpos($current_url, 'durum=takas') !== false)
  ];
  
  // Yeni Cihaz Tanımla
  $tabs[] = [
    'url' => base_url("cihaz/cihaz_tanimlama_view"),
    'icon' => 'fas fa-plus-circle',
    'label' => 'Yeni Cihaz',
    'active' => (strpos($relative_path, 'cihaz_tanimlama') !== false)
  ];
}

// Borçlu Müşteriler - Yetki kontrolü
if(goruntuleme_kontrol("borclu_cihazlari_goruntule")) {
  $tabs[] = [
    'url' => base_url("cihaz/borclu_cihazlar"),
    'icon' => 'fas fa-exclamation-circle',
    'label' => 'Borçlu Müşteriler',
    'active' => (strpos($relative_path, 'borclu_cihazlar') !== false)
  ];
}

// Merkezler - Yetki kontrolü
if(goruntuleme_kontrol("merkezleri_goruntule")) {
  $tabs[] = [
    'url' => base_url("merkez"),
    'icon' => 'far fa-building',
    'label' => 'Merkezler',
    'active' => ($relative_path == 'merkez' || strpos($relative_path, 'merkez') !== false)
  ];
}

// İl Bazlı Cihazlar - Yetki kontrolü
if(goruntuleme_kontrol("ilbazli_tum_cihazlari_goruntule")) {
  $tabs[] = [
    'url' => base_url("cihaz/tumcihazlarilbazli"),
    'icon' => 'fas fa-map-marker-alt',
    'label' => 'İl Bazlı Cihazlar',
    'active' => (strpos($relative_path, 'tumcihazlarilbazli') !== false)
  ];
}

// RG MEDİKAL - Özel kullanıcılar
$current_user_id = $this->session->userdata("aktif_kullanici_id");
if(in_array($current_user_id, [1, 9, 1330, 8])) {
  $tabs[] = [
    'url' => base_url("cihaz/rgmedikalindex"),
    'icon' => 'far fa-circle',
    'label' => 'RG MEDİKAL',
    'active' => (strpos($relative_path, 'rgmedikal') !== false)
  ];
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
