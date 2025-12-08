<?php
$current_url = current_url();
$current_path = parse_url($current_url, PHP_URL_PATH);
$base_path = parse_url(base_url(), PHP_URL_PATH);
$relative_path = str_replace($base_path, '', $current_path);
$relative_path = trim($relative_path, '/');

$tabs = [];

// Departman ID'si 15 olan kullanıcılar sertifikalardaki her şeye erişebilir
$aktif_kullanici = aktif_kullanici();
$is_departman_15 = isset($aktif_kullanici->kullanici_departman_id) && $aktif_kullanici->kullanici_departman_id == 15;

// Yeni Eğitim Ekle
if(goruntuleme_kontrol("egitim_kaydi_ekle") || $is_departman_15) {
  $tabs[] = [
    'url' => base_url("cihaz"),
    'icon' => 'fas fa-plus-circle',
    'label' => 'Yeni Eğitim Ekle',
    'active' => (strpos($relative_path, 'cihaz') !== false && strpos($relative_path, 'cihaz_tanimlama') === false && strpos($relative_path, 'tum-cihazlar') === false && strpos($relative_path, 'list') === false)
  ];
}

// Onaylanacak Sertifikalar
if(goruntuleme_kontrol("onay_bekleyen_sertifikalari_goruntule") || $is_departman_15) {
  $tabs[] = [
    'url' => base_url("sertifika/onay-bekleyen-sertifikalar"),
    'icon' => 'far fa-check-circle',
    'label' => 'Onaylanacak Sertifikalar',
    'active' => (strpos($relative_path, 'onay-bekleyen-sertifikalar') !== false || (isset($filtre) && $filtre == 'onay_sertifika'))
  ];
}

// Üretilecek Sertifikalar
if(goruntuleme_kontrol("uretilecek_sertifikalari_goruntule") || $is_departman_15) {
  $tabs[] = [
    'url' => base_url("sertifika/uretilecek-sertifikalar"),
    'icon' => 'far fa-id-card',
    'label' => 'Üretilecek Sertifikalar',
    'active' => (strpos($relative_path, 'uretilecek-sertifikalar') !== false || (isset($filtre) && $filtre == 'uretim_sertifika'))
  ];
}

// Üretilecek Kalemler
if(goruntuleme_kontrol("uretilecek_kalemleri_goruntule") || $is_departman_15) {
  $tabs[] = [
    'url' => base_url("sertifika/uretilecek-kalemler"),
    'icon' => 'fas fa-pen-alt',
    'label' => 'Kalemler',
    'active' => (strpos($relative_path, 'uretilecek-kalemler') !== false || (isset($filtre) && $filtre == 'uretim_kalem'))
  ];
}

// Kargo Bekleyenler
if(goruntuleme_kontrol("kargo_bekleyen_sertifikalari_goruntule") || $is_departman_15) {
  $tabs[] = [
    'url' => base_url("sertifika/kargo-bekleyen-sertifikalar"),
    'icon' => 'fas fa-truck-loading',
    'label' => 'Kargo Bekleyenler',
    'active' => (strpos($relative_path, 'kargo-bekleyen-sertifikalar') !== false || (isset($filtre) && $filtre == 'kargo'))
  ];
}

// Tüm Eğitimler
if(goruntuleme_kontrol("egitim_bilgilerini_goruntule") || $is_departman_15) {
  $tabs[] = [
    'url' => base_url("egitim"),
    'icon' => 'fas fa-list-alt',
    'label' => 'Tüm Eğitimler',
    'active' => (($relative_path == 'egitim' || strpos($relative_path, 'egitim') !== false) && (!isset($filtre) || $filtre == 'tum') && strpos($relative_path, 'onay-bekleyen') === false && strpos($relative_path, 'uretilecek') === false && strpos($relative_path, 'kargo-bekleyen') === false)
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

