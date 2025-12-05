<?php
$current_url = current_url();
$current_path = parse_url($current_url, PHP_URL_PATH);
$base_path = parse_url(base_url(), PHP_URL_PATH);
$relative_path = str_replace($base_path, '', $current_path);
$relative_path = trim($relative_path, '/');

$tabs = [];

// Tüm Siparişler - Herkes görebilir
$tabs[] = [
  'url' => base_url("siparis/siparisler_restore"),
  'icon' => 'fas fa-list',
  'label' => 'Tüm Siparişler',
  'active' => ($relative_path == 'tum-siparisler' || $relative_path == 'siparis/siparisler_restore' || empty($relative_path) && strpos($current_url, 'siparisler_restore') !== false)
];

// Onay Bekleyenler - Yetki kontrolüne göre URL değişir
if(goruntuleme_kontrol("siparis_beklemeye_al")) {
  $tabs[] = [
    'url' => base_url("onay-bekleyen-siparisler?filter=2"),
    'icon' => 'far fa-check-circle',
    'label' => 'Onay Bekleyenler',
    'active' => ($relative_path == 'onay-bekleyen-siparisler' || strpos($relative_path, 'onay-bekleyen-siparisler') !== false)
  ];
} else {
  $tabs[] = [
    'url' => base_url("onay-bekleyen-siparisler"),
    'icon' => 'far fa-check-circle',
    'label' => 'Onay Bekleyenler',
    'active' => ($relative_path == 'onay-bekleyen-siparisler' || strpos($relative_path, 'onay-bekleyen-siparisler') !== false)
  ];
}

// Kurulum Planı - Yetki kontrolü
if(goruntuleme_kontrol("haftalik_kurulum_plan_goruntule")) {
  $tabs[] = [
    'url' => base_url("siparis/haftalik_kurulum_plan"),
    'icon' => 'far fa-calendar-alt',
    'label' => 'Kurulum Planı',
    'active' => (strpos($relative_path, 'haftalik_kurulum_plan') !== false)
  ];
}

// Hızlı Sipariş - Herkes görebilir
$tabs[] = [
  'url' => base_url("siparis/hizli_siparis_olustur_view"),
  'icon' => 'fas fa-plus-circle',
  'label' => 'Hızlı Sipariş',
  'active' => (strpos($relative_path, 'hizli_siparis_olustur') !== false)
];

// İptal Edilenler - Yetki kontrolü
if(goruntuleme_kontrol("iptal_edilen_siparisleri_goruntule")) {
  $tabs[] = [
    'url' => base_url("cihaz/iptal_edilen_siparisler"),
    'icon' => 'fas fa-ban',
    'label' => 'İptal Edilenler',
    'active' => (strpos($relative_path, 'iptal_edilen_siparisler') !== false)
  ];
}

// SMS Sonuçları - Yetki kontrolü
if(goruntuleme_kontrol("sms_degerlendirme_raporunu_goruntule")) {
  $tabs[] = [
    'url' => base_url("siparis/degerlendirme_rapor"),
    'icon' => 'far fa-envelope',
    'label' => 'SMS Sonuçları',
    'active' => (strpos($relative_path, 'degerlendirme_rapor') !== false)
  ];
}

// Tamamlanmayanlar - Yetki kontrolü (controller'da da kontrol var)
$current_user_id = $this->session->userdata("aktif_kullanici_id");
$has_tum_siparis_yetki = goruntuleme_kontrol("tum_siparisleri_goruntule");
if($current_user_id == 37 || $current_user_id == 8 || $current_user_id == 1 || $current_user_id == 9 || $current_user_id == 7 || $has_tum_siparis_yetki) {
  $tabs[] = [
    'url' => base_url("siparis/tamamlanmayanlar_view"),
    'icon' => 'fas fa-exclamation-triangle',
    'label' => 'Tamamlanmayanlar',
    'active' => (strpos($relative_path, 'tamamlanmayanlar_view') !== false)
  ];
}

// Satış Limitleri - Yetki kontrolü
if(goruntuleme_kontrol("satis_limitlerini_yonet")) {
  $tabs[] = [
    'url' => base_url("fiyat_limit"),
    'icon' => 'far fa-check-circle',
    'label' => 'Satış Limitleri',
    'active' => (strpos($relative_path, 'fiyat_limit') !== false)
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
