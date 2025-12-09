<?php
$current_url = current_url();
$current_path = parse_url($current_url, PHP_URL_PATH);
$base_path = parse_url(base_url(), PHP_URL_PATH);
$relative_path = str_replace($base_path, '', $current_path);
$relative_path = trim($relative_path, '/');

// URL'den aktif tab'ı belirle
$active_tab = '';
if(strpos($relative_path, 'urun/satici_limit') !== false) {
  $active_tab = 'urun/satici_limit';
} elseif(strpos($relative_path, 'talep/ekle') !== false) {
  $active_tab = 'talep/ekle';
} elseif(strpos($relative_path, 'rut/rut_tanimlari') !== false) {
  $active_tab = 'rut/rut_tanimlari';
} elseif(strpos($relative_path, 'musteri/karaliste_view') !== false) {
  $active_tab = 'musteri/karaliste_view';
} else {
  $active_tab = $relative_path;
}

$tabs = [];

// Ürün Satıcı Limit
$tabs[] = [
  'url' => base_url("urun/satici_limit/1"),
  'icon' => 'fas fa-dollar-sign',
  'label' => 'Fiyat Limitleri',
  'active' => (strpos($relative_path, 'urun/satici_limit') !== false)
];

// Yeni Talep Ekle
$tabs[] = [
  'url' => base_url("talep/ekle"),
  'icon' => 'fas fa-plus',
  'label' => 'Yeni Talep Ekle',
  'active' => ($relative_path == 'talep/ekle')
];

// Rut Listesi
$tabs[] = [
  'url' => base_url("rut/rut_tanimlari"),
  'icon' => 'fas fa-route',
  'label' => 'Rut Listesi',
  'active' => ($relative_path == 'rut/rut_tanimlari')
];

// TALEP - Ana sayfa
$tabs[] = [
  'url' => base_url("tum-taleplerim"),
  'icon' => 'fas fa-list',
  'label' => 'TALEP',
  'active' => ($relative_path == 'tum-taleplerim')
];

// Bekleyen Talepler
$tabs[] = [
  'url' => base_url("bekleyen-talepler"),
  'icon' => 'fas fa-clock',
  'label' => 'Bekleyen Talepler',
  'active' => ($relative_path == 'bekleyen-talepler')
];

// Satış Talepler
$tabs[] = [
  'url' => base_url("satis-talepler"),
  'icon' => 'fas fa-check-circle',
  'label' => 'Satış',
  'active' => ($relative_path == 'satis-talepler')
];

// Bilgi Verildi
$tabs[] = [
  'url' => base_url("bilgi-verildi-talepler"),
  'icon' => 'fas fa-info-circle',
  'label' => 'Bilgi Verildi',
  'active' => ($relative_path == 'bilgi-verildi-talepler')
];

// Müşteri Memnuniyeti
$tabs[] = [
  'url' => base_url("musteri-memnuniyeti-talepler"),
  'icon' => 'fas fa-smile',
  'label' => 'Müşteri Memnuniyeti',
  'active' => ($relative_path == 'musteri-memnuniyeti-talepler')
];

// Dönüş Yapılacak
$tabs[] = [
  'url' => base_url("donus-yapilacak-talepler"),
  'icon' => 'fas fa-phone',
  'label' => 'Dönüş Yapılacak',
  'active' => ($relative_path == 'donus-yapilacak-talepler')
];

// Olumsuz Talepler
$tabs[] = [
  'url' => base_url("olumsuz-talepler"),
  'icon' => 'fas fa-times-circle',
  'label' => 'Olumsuz',
  'active' => ($relative_path == 'olumsuz-talepler')
];

// Numara Hatalı
$tabs[] = [
  'url' => base_url("numara-hatali-talepler"),
  'icon' => 'fas fa-exclamation-triangle',
  'label' => 'Numara Hatalı',
  'active' => ($relative_path == 'numara-hatali-talepler')
];

// Tekrar Aranacak
$tabs[] = [
  'url' => base_url("tekrar-aranacak-talepler"),
  'icon' => 'fas fa-redo',
  'label' => 'Tekrar Aranacak',
  'active' => ($relative_path == 'tekrar-aranacak-talepler')
];

// Kara Liste
$tabs[] = [
  'url' => base_url("musteri/karaliste_view"),
  'icon' => 'fas fa-ban',
  'label' => 'Kara Liste',
  'active' => ($relative_path == 'musteri/karaliste_view')
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

