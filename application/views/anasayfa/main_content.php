<div class="content-wrapper pr-2 mobil-genislik" style="padding-top: 25px; background-color: #f8f9fa;">
  <?php if(goruntuleme_kontrol("yemek_listesi_goruntule")) : ?>
    <div class="row mb-4">
      <div class="col-12">
        <div class="card border-0 shadow" style="border-radius: 12px; overflow: hidden;">
          <div class="card-header border-0 pb-0" style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); padding: 20px 25px;">
            <div class="d-flex align-items-center">
              <div class="rounded-circle d-flex align-items-center justify-content-center mr-3" style="width: 40px; height: 40px; background-color: rgba(255,255,255,0.2);">
                <i class="fas fa-utensils" style="color: #ffffff; font-size: 18px;"></i>
              </div>
              <div>
                <h3 class="mb-0" style="color: #ffffff; font-weight: 700; font-size: 20px; letter-spacing: 0.5px;">
                  Günlük Menü
                </h3>
                <small style="color: rgba(255,255,255,0.9); font-size: 13px;">Bugünün menü seçenekleri</small>
              </div>
            </div>
          </div>
          <div class="card-body" style="padding: 25px; background-color: #ffffff;">
            <?php
            $items = explode('#', $yemek->yemek_detay);
            if (!empty($items) && !empty(trim($items[0]))) :
            ?>
              <div class="d-flex flex-wrap" style="gap: 10px;">
                <?php 
                foreach ($items as $index => $item) { 
                  $item = trim($item);
                  if (!empty($item)) :
                ?>
                  <span class="badge" style="font-size: 14px; padding: 10px 18px; background-color: #fff3cd; color: #856404; border: 1px solid #ffeaa7; border-radius: 8px; font-weight: 500;">
                    <?= htmlspecialchars($item) ?>
                  </span>
                <?php 
                  endif;
                }
                ?>
              </div>
            <?php else : ?>
              <div class="text-center py-3">
                <i class="fas fa-info-circle" style="color: #adb5bd; font-size: 24px; margin-bottom: 10px;"></i>
                <p class="text-muted mb-0" style="font-size: 15px;">Menü bilgisi bulunmamaktadır.</p>
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
        <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden; background: linear-gradient(135deg, #667eea 0%, #667eea 100%);">
          <div class="card-body text-center" style="padding: 20px 15px;">
            <div class="mb-1">
              <i class="fas fa-gavel" style="color: #ffffff; font-size: 24px; opacity: 0.9;"></i>
            </div>
            <h2 class="mb-0" style="color: #ffffff; font-weight: 700; letter-spacing: 1px; font-size: 16px; text-transform: uppercase;">
              Şirket Kuralları
            </h2>
            <div style="width: 60px; height: 2px; background-color: rgba(255,255,255,0.5); margin: 10px auto 0; border-radius: 2px;"></div>
          </div>
        </div>
      </div>
      
      <?php 
      if (!empty($kurallar)) :
        foreach ($kurallar as $index => $kural) :
      ?>
        <div class="col-md-6 col-12 mb-4">
          <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden; border-top: 4px solid #dc3545;">
            <div class="card-header border-0" style="background-color: #dc3545; padding: 18px 25px;">
              <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3" style="width: 40px; height: 40px; background-color: #ff6b7a;">
                  <i class="fas fa-file-alt" style="color: #ffffff; font-size: 18px;"></i>
                </div>
                <div class="flex-grow-1">
                  <h4 class="mb-0" style="color: #ffffff; font-weight: 600; font-size: 16px; line-height: 1.4;">
                    <span><?= htmlspecialchars($kural->sablon_kategori_adi) ?></span>
                    <span class="mx-2" style="opacity: 0.7; font-weight: 300;">/</span>
                    <span style="font-weight: 500;"><?= htmlspecialchars($kural->sablon_veri_adi) ?></span>
                  </h4>
                </div>
              </div>
            </div>
            <div class="card-body" style="padding: 25px; background-color: #ffffff; line-height: 1.9;">
              <div style="font-size: 15px; color: #495057;">
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
          <div class="card border-0 shadow-sm" style="border-radius: 12px;">
            <div class="card-body text-center" style="padding: 50px 20px;">
              <div class="mb-3">
                <i class="fas fa-info-circle" style="color: #adb5bd; font-size: 48px;"></i>
              </div>
              <p class="text-muted mb-0" style="font-size: 16px; font-weight: 500;">Henüz kural tanımlanmamıştır.</p>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>     
  </section> 
</div> 