<?php
/**
 * Onay bekleyen siparişler için mobil card partial
 * 
 * @param object $siparis Sipariş objesi
 * @param array $data Son adım bilgileri
 * @param int $ak Aktif kullanıcı ID
 * @param bool $tum_siparisler_tabi Tüm siparişler tabı aktif mi?
 * @param array $kullanici_yetkili_adimlar Kullanıcının yetkili olduğu adımlar
 * @return void
 */

// Helper fonksiyonları yükle
$this->load->helper('siparis_view_helper');

// Sipariş görüntüleme linki oluştur
$link = base_url("siparis/report/") . urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE" . $siparis->siparis_id . "Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE"));

// Fiyat kontrolü
$hatali_fiyat = hatali_fiyat_kontrol($siparis->siparis_id) == 1;

// Merkez adı kontrolü
$merkez_adi = ($siparis->merkez_adi == "#NULL#") 
    ? "<span class='badge bg-danger' style='background: #ffd1d1 !important; color: #b30000 !important; border: 1px solid red; font-size: 10px;'><i class='nav-icon fas fa-exclamation-circle'></i> Merkez Adı Yok</span>"
    : '<i class="far fa-building" style="color: green;"></i> ' . mb_substr($siparis->merkez_adi, 0, 30) . (mb_strlen($siparis->merkez_adi) > 30 ? '...' : '');

// Merkez adresi kontrolü
$merkez_adresi = ($siparis->merkez_adresi == "" || $siparis->merkez_adresi == "0" || $siparis->merkez_adresi == ".") 
    ? "ADRES GİRİLMEDİ" 
    : $siparis->merkez_adresi;
$merkez_adresi_kisa = mb_strlen($merkez_adresi) > 50 ? mb_substr($merkez_adresi, 0, 50) . '...' : $merkez_adresi;

// Müşteri sabit numara
$musteri_sabit_numara = $siparis->musteri_sabit_numara ? "<br>" . $siparis->musteri_sabit_numara : "";

// Yenilenmiş cihaz kontrolü
$yenilenmis_cihaz_var = false;
$yenilenmis_check = $this->db
    ->select('COUNT(*) as count')
    ->from('siparis_urunleri')
    ->where('siparis_kodu', $siparis->siparis_id)
    ->where('yenilenmis_cihaz_mi', 1)
    ->where('siparis_urun_aktif', 1)
    ->get()
    ->row();
if($yenilenmis_check && $yenilenmis_check->count > 0) {
    $yenilenmis_cihaz_var = true;
}

// Sipariş oluşturan fotoğrafı
$kullanici_foto = '';
if(!empty($siparis->kullanici_resim) && $siparis->kullanici_resim != "" && $siparis->kullanici_resim != ".") {
    $kullanici_foto = base_url("uploads/".$siparis->kullanici_resim);
} else {
    $kullanici_foto = base_url("uploads/user-default.jpg");
}

// İkinci onay kontrolü
$ikinci_onay_bekleniyor = false;
$ikinci_onay_kullanici_id = null;
if(isset($siparis->adim_no) && $siparis->adim_no == 3 && isset($siparis->siparis_ust_satis_onayi) && $siparis->siparis_ust_satis_onayi == 0) {
    $ikinci_onay_bekleniyor = true;
    $ikinci_onay_kullanicilar = $this->db
        ->select('kullanici_id')
        ->from('kullanici_yetki_tanimlari')
        ->where('yetki_kodu', 'siparis_ikinci_onay')
        ->get()
        ->result();
    
    if(!empty($ikinci_onay_kullanicilar)) {
        $ikinci_onay_kullanici_id = $ikinci_onay_kullanicilar[0]->kullanici_id;
    }
}

// Adım 4'te ve 2. satış onayı bekleyen siparişler için kritik işaretleme
$adim_4_ikinci_onay_bekliyor = false;
if(isset($data[0]->adim_sira_numarasi) && $data[0]->adim_sira_numarasi == 4 && 
   isset($siparis->siparis_ust_satis_onayi) && $siparis->siparis_ust_satis_onayi == 0) {
    $adim_4_ikinci_onay_bekliyor = true;
}

$card_class = $adim_4_ikinci_onay_bekliyor ? 'mobile-siparis-card critical' : 'mobile-siparis-card';
?>

<div class="<?= $card_class ?>" onclick="showWindow2('<?= $link ?>');">
  <!-- Card Header -->
  <div class="mobile-card-header">
    <div class="mobile-card-id">#<?= $siparis->siparis_id ?></div>
    <div class="mobile-card-status">
      <?php if($hatali_fiyat): ?>
        <span class="mobile-card-badge mobile-card-badge-danger">
          <i class="fas fa-exclamation-circle"></i> HATALI
        </span>
      <?php else: ?>
        <span class="mobile-card-badge mobile-card-badge-success">
          <i class="fas fa-check"></i> GEÇERLİ
        </span>
        <span class="mobile-card-step">Adım <?= $siparis->adim_no + 1 ?></span>
        <?php if($ikinci_onay_bekleniyor && $ikinci_onay_kullanici_id !== null): ?>
          <span style="font-size: 10px; color: #dc3545; font-weight: bold; margin-top: 2px;">
            <i class="fas fa-user-check"></i> 2. Onay: ID <?= $ikinci_onay_kullanici_id ?>
          </span>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </div>

  <!-- Müşteri Bilgileri -->
  <div class="mobile-card-section">
    <div class="mobile-card-label">
      <i class="fas fa-user"></i> Müşteri
    </div>
    <div class="mobile-card-value">
      <div class="mobile-card-musteri">
        <i class="fa fa-user-circle mobile-card-musteri-icon"></i>
        <div style="flex: 1;">
          <a href="<?= base_url("musteri/profil/$siparis->musteri_id") ?>" target="_blank" onclick="event.stopPropagation();" style="color: #001657; text-decoration: none; font-weight: 600;">
            <?= $siparis->musteri_ad ?>
          </a>
          <?php if($yenilenmis_cihaz_var): ?>
            <span class="badge badge-success" style="background:#28a745;color:#fff;padding:3px 6px;border-radius:4px;font-size:10px;margin-left:6px;">
              <i class="fas fa-recycle"></i> Yenilenmiş
            </span>
          <?php endif; ?>
          <div class="mobile-card-phone">
            <i class="fas fa-phone"></i>
            <?= $siparis->musteri_iletisim_numarasi ?>
            <?php if($musteri_sabit_numara): ?>
              <br><i class="fas fa-phone-alt"></i> <?= $siparis->musteri_sabit_numara ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Merkez Detayları -->
  <div class="mobile-card-section">
    <div class="mobile-card-label">
      <i class="fas fa-building"></i> Merkez
    </div>
    <div class="mobile-card-value">
      <div class="mobile-card-merkez-name">
        <?= $merkez_adi ?>
      </div>
      <div class="mobile-card-location">
        <i class="fas fa-map-marker-alt"></i>
        <?= $siparis->sehir_adi ?> / <?= $siparis->ilce_adi ?>
      </div>
      <?php if($merkez_adresi != "ADRES GİRİLMEDİ"): ?>
        <div class="mobile-card-address">
          <i class="fas fa-home"></i>
          <span><?= $merkez_adresi_kisa ?></span>
        </div>
      <?php else: ?>
        <div style="font-size: 11px; color: #dc3545; margin-top: 4px;">
          <i class="fas fa-exclamation-triangle"></i> Adres yok
        </div>
      <?php endif; ?>
    </div>
  </div>

  <!-- Sipariş Oluşturan -->
  <div class="mobile-card-section">
    <div class="mobile-card-label">
      <i class="fas fa-user-tie"></i> Sipariş Oluşturan
    </div>
    <div class="mobile-card-value">
      <div class="mobile-card-creator">
        <img src="<?= $kullanici_foto ?>" alt="<?= htmlspecialchars($siparis->kullanici_ad_soyad) ?>">
        <div class="mobile-card-creator-info">
          <a href="<?= base_url("kullanici/profil_new/$siparis->kullanici_id") ?>?subpage=ozluk-dosyasi" target="_blank" onclick="event.stopPropagation();" class="mobile-card-creator-name">
            <?= $siparis->kullanici_ad_soyad ?>
          </a>
          <div class="mobile-card-creator-date">
            <i class="far fa-clock"></i>
            <?= date('d.m.Y H:i', strtotime($siparis->kayit_tarihi)) ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Son Durum -->
  <div class="mobile-card-section">
    <div class="mobile-card-label">
      <i class="fas fa-info-circle"></i> Son Durum
    </div>
    <div class="mobile-card-value">
      <div class="mobile-card-status-name">
        <?= $data[0]->adim_adi ?>
      </div>
      <div class="mobile-card-status-badge">
        Bekleniyor...
      </div>
      <div class="mobile-card-steps">
        <?php for($i = 1; $i <= 12; $i++): 
          $is_active = $siparis->adim_no + 1 >= $i;
          $is_current = $siparis->adim_no + 1 == $i;
          $step_class = $is_current ? 'active' : ($is_active ? 'completed' : 'pending');
        ?>
        <div class="mobile-card-step-indicator <?= $step_class ?>" title="Adım <?= $i ?>">
          <?php if($is_active && !$is_current): ?>
            <i class="fa fa-check" style="font-size: 10px;"></i>
          <?php endif; ?>
        </div>
        <?php endfor; ?>
      </div>
    </div>
  </div>

  <!-- İşlemler -->
  <div class="mobile-card-actions">
    <a href="#" onclick="event.stopPropagation(); showWindow2('<?= $link ?>');" class="mobile-card-action-btn">
      <i class="fas fa-search"></i>
      GÖRÜNTÜLE
    </a>
  </div>
</div>

