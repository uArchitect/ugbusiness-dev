<?php
$current_url = current_url();
$current_path = parse_url($current_url, PHP_URL_PATH);
$base_path = parse_url(base_url(), PHP_URL_PATH);
$relative_path = str_replace($base_path, '', $current_path);
$relative_path = trim($relative_path, '/');

$tabs = [];

// Tüm Envanterler - Yetki kontrolü
if(goruntuleme_kontrol("demirbas_goruntule")) {
  $tabs[] = [
    'url' => base_url("demirbas"),
    'icon' => 'fas fa-list',
    'label' => 'Tüm Envanterler',
    'active' => ($relative_path == 'demirbas' || strpos($relative_path, 'demirbas') !== false && strpos($relative_path, 'ekle') === false && strpos($relative_path, 'duzenle') === false)
  ];
}

// Yeni Envanter Ekle - Yetki kontrolü
if(goruntuleme_kontrol("demirbas_ekle")) {
  $tabs[] = [
    'url' => base_url("demirbas/ekle/1"),
    'icon' => 'fas fa-plus-circle',
    'label' => 'Yeni Envanter Ekle',
    'active' => (strpos($relative_path, 'demirbas/ekle') !== false || strpos($relative_path, 'demirbas/duzenle') !== false)
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

