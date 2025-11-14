<div class="content-wrapper pr-2 mobil-genislik anasayfa-responsive" style="padding-top: 25px; background-color: #f8f9fa;">
  <?php if(goruntuleme_kontrol("yemek_listesi_goruntule")) : ?>
    <div class="row mb-4">
      <div class="col-12">
        <div class="card border-0 shadow" style="border-radius: 12px; overflow: hidden;">
          <div class="card-header border-0 pb-0 yemek-header" style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);">
            <div class="d-flex align-items-center">
              <div class="rounded-circle d-flex align-items-center justify-content-center mr-3 yemek-icon" style="width: 40px; height: 40px; background-color: rgba(255,255,255,0.2);">
                <i class="fas fa-utensils" style="color: #ffffff; font-size: 18px;"></i>
              </div>
              <div>
                <h3 class="mb-0 yemek-baslik" style="color: #ffffff; font-weight: 700; font-size: 20px; letter-spacing: 0.5px;">
                  Günlük Menü
                </h3>
                <small class="yemek-alt-baslik" style="color: rgba(255,255,255,0.9); font-size: 13px;">Bugünün menü seçenekleri</small>
              </div>
            </div>
          </div>
          <div class="card-body yemek-body" style="padding: 25px; background-color: #ffffff;">
            <?php
            $items = explode('#', $yemek->yemek_detay);
            if (!empty($items) && !empty(trim($items[0]))) :
            ?>
              <div class="d-flex flex-wrap yemek-badge-container" style="gap: 10px;">
                <?php 
                foreach ($items as $index => $item) { 
                  $item = trim($item);
                  if (!empty($item)) :
                ?>
                  <span class="badge yemek-badge" style="font-size: 14px; padding: 10px 18px; background-color: #fff3cd; color: #856404; border: 1px solid #ffeaa7; border-radius: 8px; font-weight: 500;">
                    <?= htmlspecialchars($item) ?>
                  </span>
                <?php 
                  endif;
                }
                ?>
              </div>
            <?php else : ?>
              <div class="text-center py-3">
                <i class="fas fa-info-circle yemek-empty-icon" style="color: #adb5bd; font-size: 24px; margin-bottom: 10px;"></i>
                <p class="text-muted mb-0 yemek-empty-text" style="font-size: 15px;">Menü bilgisi bulunmamaktadır.</p>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>
  
  <section class="content pr-0">
    <div class="row">
      <div class="col-12 mb-4">
        <div class="card border-0 shadow-sm kurallar-baslik-card" style="border-radius: 12px; overflow: hidden; background: linear-gradient(135deg, #667eea 0%, #667eea 100%);">
          <div class="card-body text-center kurallar-baslik-body" style="padding: 20px 15px;">
            <div class="mb-1">
              <i class="fas fa-gavel kurallar-icon" style="color: #ffffff; font-size: 24px; opacity: 0.9;"></i>
            </div>
            <h2 class="mb-0 kurallar-baslik" style="color: #ffffff; font-weight: 700; letter-spacing: 1px; font-size: 16px; text-transform: uppercase;">
              Şirket Kuralları
            </h2>
            <div class="kurallar-divider" style="width: 60px; height: 2px; background-color: rgba(255,255,255,0.5); margin: 10px auto 0; border-radius: 2px;"></div>
          </div>
        </div>
      </div>
      
      <?php 
      if (!empty($kurallar)) :
        foreach ($kurallar as $index => $kural) :
      ?>
        <div class="col-md-12 col-12 mb-4">
          <div class="card border-0 shadow-sm kural-card" style="border-radius: 12px; overflow: hidden; border-top: 4px solid #dc3545;">
            <div class="card-header border-0 kural-header" style="background-color: #dc3545; padding: 18px 25px;">
              <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3 kural-icon" style="width: 40px; height: 40px; background-color: #ff6b7a;">
                  <i class="fas fa-file-alt" style="color: #ffffff; font-size: 18px;"></i>
                </div>
                <div class="flex-grow-1">
                  <h4 class="mb-0 kural-baslik" style="color: #ffffff; font-weight: 600; font-size: 16px; line-height: 1.4;">
                    <span><?= htmlspecialchars($kural->sablon_kategori_adi) ?></span>
                    <span class="mx-2 kural-ayrac" style="opacity: 0.7; font-weight: 300;">/</span>
                    <span style="font-weight: 500;"><?= htmlspecialchars($kural->sablon_veri_adi) ?></span>
                  </h4>
                </div>
              </div>
            </div>
            <div class="card-body kural-body" style="padding: 25px; background-color: #ffffff; line-height: 1.9;">
              <div class="kural-icerik" style="font-size: 15px; color: #495057;">
                <?= $kural->sablon_veri_detay ?>
              </div>
            </div>
          </div>
        </div>
      <?php 
        endforeach;
      else :
      ?>
        <div class="col-12">
          <div class="card border-0 shadow-sm">
            <div class="card-body text-center kural-empty-body" style="padding: 50px 20px;">
              <div class="mb-3">
                <i class="fas fa-info-circle kural-empty-icon" style="color: #adb5bd; font-size: 48px;"></i>
              </div>
              <p class="text-muted mb-0 kural-empty-text" style="font-size: 16px; font-weight: 500;">Henüz kural tanımlanmamıştır.</p>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>     
  </section> 
</div>

<style>
  /* Responsive ayarlar - Tablet (768px ve altı) */
  @media (max-width: 768px) {
    .anasayfa-responsive {
      padding-top: 15px !important;
      padding-right: 10px !important;
    }

    /* Günlük Menü - Tablet */
    .yemek-header {
      padding: 15px 20px !important;
    }

    .yemek-icon {
      width: 35px !important;
      height: 35px !important;
      margin-right: 12px !important;
    }

    .yemek-icon i {
      font-size: 16px !important;
    }

    .yemek-baslik {
      font-size: 18px !important;
    }

    .yemek-alt-baslik {
      font-size: 12px !important;
    }

    .yemek-body {
      padding: 20px !important;
    }

    .yemek-badge {
      font-size: 13px !important;
      padding: 8px 14px !important;
    }

    .yemek-badge-container {
      gap: 8px !important;
    }

    /* Şirket Kuralları Başlık - Tablet */
    .kurallar-baslik-body {
      padding: 18px 12px !important;
    }

    .kurallar-icon {
      font-size: 20px !important;
    }

    .kurallar-baslik {
      font-size: 14px !important;
    }

    .kurallar-divider {
      width: 50px !important;
      margin: 8px auto 0 !important;
    }

    /* Kural Kartları - Tablet */
    .kural-header {
      padding: 15px 20px !important;
    }

    .kural-icon {
      width: 35px !important;
      height: 35px !important;
      margin-right: 12px !important;
    }

    .kural-icon i {
      font-size: 16px !important;
    }

    .kural-baslik {
      font-size: 15px !important;
      line-height: 1.3 !important;
    }

    .kural-ayrac {
      margin: 0 4px !important;
    }

    .kural-body {
      padding: 20px !important;
    }

    .kural-icerik {
      font-size: 14px !important;
      line-height: 1.7 !important;
    }

    .kural-empty-body {
      padding: 40px 15px !important;
    }

    .kural-empty-icon {
      font-size: 40px !important;
    }

    .kural-empty-text {
      font-size: 15px !important;
    }
  }

  /* Responsive ayarlar - Mobil (576px ve altı) */
  @media (max-width: 576px) {
    .anasayfa-responsive {
      padding-top: 10px !important;
      padding-right: 5px !important;
    }

    /* Günlük Menü - Mobil */
    .yemek-header {
      padding: 12px 15px !important;
    }

    .yemek-icon {
      width: 32px !important;
      height: 32px !important;
      margin-right: 10px !important;
    }

    .yemek-icon i {
      font-size: 14px !important;
    }

    .yemek-baslik {
      font-size: 16px !important;
      letter-spacing: 0.3px !important;
    }

    .yemek-alt-baslik {
      font-size: 11px !important;
      display: block;
      margin-top: 2px;
    }

    .yemek-body {
      padding: 15px !important;
    }

    .yemek-badge {
      font-size: 12px !important;
      padding: 6px 12px !important;
      border-radius: 6px !important;
    }

    .yemek-badge-container {
      gap: 6px !important;
    }

    .yemek-empty-icon {
      font-size: 20px !important;
      margin-bottom: 8px !important;
    }

    .yemek-empty-text {
      font-size: 14px !important;
    }

    /* Şirket Kuralları Başlık - Mobil */
    .kurallar-baslik-body {
      padding: 15px 10px !important;
    }

    .kurallar-icon {
      font-size: 18px !important;
    }

    .kurallar-baslik {
      font-size: 13px !important;
      letter-spacing: 0.5px !important;
    }

    .kurallar-divider {
      width: 40px !important;
      height: 1.5px !important;
      margin: 6px auto 0 !important;
    }

    /* Kural Kartları - Mobil */
    .kural-card {
      margin-bottom: 15px !important;
    }

    .kural-header {
      padding: 12px 15px !important;
    }

    .kural-icon {
      width: 30px !important;
      height: 30px !important;
      margin-right: 10px !important;
    }

    .kural-icon i {
      font-size: 14px !important;
    }

    .kural-baslik {
      font-size: 14px !important;
      line-height: 1.2 !important;
    }

    .kural-ayrac {
      margin: 0 3px !important;
      font-size: 12px !important;
    }

    .kural-body {
      padding: 15px !important;
    }

    .kural-icerik {
      font-size: 13px !important;
      line-height: 1.6 !important;
    }

    .kural-icerik img {
      max-width: 100% !important;
      height: auto !important;
    }

    .kural-icerik table {
      font-size: 12px !important;
      display: block;
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
    }

    .kural-empty-body {
      padding: 30px 15px !important;
    }

    .kural-empty-icon {
      font-size: 36px !important;
    }

    .kural-empty-text {
      font-size: 14px !important;
    }

    /* Row margin ayarları */
    .row {
      margin-left: -5px !important;
      margin-right: -5px !important;
    }

    .row > [class*="col-"] {
      padding-left: 5px !important;
      padding-right: 5px !important;
    }
  }

  /* Çok küçük ekranlar (480px ve altı) */
  @media (max-width: 480px) {
    .yemek-baslik {
      font-size: 15px !important;
    }

    .kural-baslik {
      font-size: 13px !important;
    }

    .kural-icerik {
      font-size: 12px !important;
    }
  }

  /* Yatay mod (landscape) için özel ayarlar */
  @media (max-width: 768px) and (orientation: landscape) {
    .anasayfa-responsive {
      padding-top: 10px !important;
    }

    .yemek-body,
    .kural-body {
      padding: 15px !important;
    }
  }
</style> 