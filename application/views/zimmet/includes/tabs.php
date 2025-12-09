<?php
$current_url = current_url();
$current_path = parse_url($current_url, PHP_URL_PATH);
$base_path = parse_url(base_url(), PHP_URL_PATH);
$relative_path = str_replace($base_path, '', $current_path);
$relative_path = trim($relative_path, '/');

$tabs = [];

// Envanter Zimmet - Default tab
$is_envanter_zimmet = ($relative_path == 'zimmet' || 
                       $relative_path == 'zimmet/fabrika_zimmet' || 
                       (strpos($relative_path, 'zimmet') !== false && 
                        strpos($relative_path, 'dagitim') === false && 
                        strpos($relative_path, 'uretimdagitim') === false && 
                        strpos($relative_path, 'stoktanimlar') === false &&
                        strpos($relative_path, 'kullanici') === false &&
                        strpos($relative_path, 'uretim_envanter') === false &&
                        strpos($relative_path, 'zimmet_uretim') === false));

$tabs[] = [
  'url' => base_url("zimmet"),
  'icon' => 'fas fa-boxes',
  'label' => 'Envanter Zimmet',
  'active' => $is_envanter_zimmet
];

// Servis Dağıtım
$is_servis_dagitim = (strpos($relative_path, 'zimmet/dagitim') !== false);

$tabs[] = [
  'url' => base_url("zimmet/dagitim/2"),
  'icon' => 'fas fa-tools',
  'label' => 'Servis Dağıtım',
  'active' => $is_servis_dagitim
];

// Üretim Dağıtım
$is_uretim_dagitim = (strpos($relative_path, 'uretimdagitim') !== false);

$tabs[] = [
  'url' => base_url("zimmet/uretimdagitim/1"),
  'icon' => 'fas fa-industry',
  'label' => 'Üretim Dağıtım',
  'active' => $is_uretim_dagitim
];

// Stok Düzenle / Sil
$is_stok_tanim = (strpos($relative_path, 'stoktanimlar') !== false || strpos($relative_path, 'stoktanim') !== false);

$tabs[] = [
  'url' => base_url("zimmet/stoktanimlar"),
  'icon' => 'fas fa-edit',
  'label' => 'Stok Düzenle / Sil',
  'active' => $is_stok_tanim
];
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

