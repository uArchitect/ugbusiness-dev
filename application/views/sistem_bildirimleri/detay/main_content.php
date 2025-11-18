<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top: 25px; background-color: #f8f9fa;">
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
          <!-- Card Header -->
          <div class="card-header border-0" style="background: linear-gradient(135deg, #001657 0%, #001657 100%); padding: 18px 25px;">
            <div class="d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3" style="width: 40px; height: 40px; background-color: rgba(255,255,255,0.2);">
                  <i class="fas fa-bell" style="color: #ffffff; font-size: 18px;"></i>
                </div>
                <div>
                  <h3 class="mb-0" style="color: #ffffff; font-weight: 700; font-size: 20px; letter-spacing: 0.5px; line-height: 1.2;">
                    Bildirim Detayı
                  </h3>
                  <small style="color: rgba(255,255,255,0.9); font-size: 13px; line-height: 1.4;">
                    <?=htmlspecialchars($bildirim->baslik)?>
                  </small>
                </div>
              </div>
              <div>
                <a href="<?=site_url('sistem_bildirimleri')?>" class="btn btn-light btn-sm shadow-sm" style="border-radius: 8px; font-weight: 600;">
                  <i class="fas fa-arrow-left"></i> Geri Dön
                </a>
              </div>
            </div>
          </div>
          
          <!-- Card Body -->
          <div class="card-body" style="padding: 30px; background-color: #ffffff;">
            <div class="row">
              <!-- Sol Taraf - Bildirim Bilgileri -->
              <div class="col-md-8">
                <h5 class="mb-4" style="color: #001657; font-weight: 600; border-bottom: 2px solid #001657; padding-bottom: 10px;">
                  <i class="fas fa-info-circle mr-2"></i>Bildirim Bilgileri
                </h5>
                
                <div class="mb-4">
                  <label style="color: #6c757d; font-size: 13px; font-weight: 500; margin-bottom: 5px;">Bildirim Tipi</label>
                  <div style="color: #495057; font-size: 15px; font-weight: 500;">
                    <span class="badge badge-info" style="font-size: 13px; padding: 6px 12px;">
                      <i class="fas fa-tag mr-1"></i><?=htmlspecialchars($bildirim->tip_adi)?>
                    </span>
                  </div>
                </div>
                
                <div class="mb-4">
                  <label style="color: #6c757d; font-size: 13px; font-weight: 500; margin-bottom: 5px;">Başlık</label>
                  <div style="color: #495057; font-size: 18px; font-weight: 600;">
                    <?=htmlspecialchars($bildirim->baslik)?>
                  </div>
                </div>
                
                <div class="mb-4">
                  <label style="color: #6c757d; font-size: 13px; font-weight: 500; margin-bottom: 5px;">Mesaj</label>
                  <div style="color: #495057; font-size: 15px; background-color: #f8f9fa; padding: 15px; border-radius: 6px; border-left: 3px solid #001657; white-space: pre-wrap;">
                    <?=nl2br(htmlspecialchars($bildirim->mesaj))?>
                  </div>
                </div>
                
                <?php if(!empty($bildirim->gonderen_ad_soyad)): ?>
                <div class="mb-4">
                  <label style="color: #6c757d; font-size: 13px; font-weight: 500; margin-bottom: 5px;">Gönderen</label>
                  <div style="color: #495057; font-size: 15px; font-weight: 500;">
                    <i class="far fa-user mr-2"></i>
                    <?=htmlspecialchars($bildirim->gonderen_ad_soyad)?>
                  </div>
                </div>
                <?php endif; ?>
                
                <div class="mb-4">
                  <label style="color: #6c757d; font-size: 13px; font-weight: 500; margin-bottom: 5px;">Oluşturulma Tarihi</label>
                  <div style="color: #6c757d; font-size: 14px;">
                    <i class="far fa-calendar mr-1"></i>
                    <?=date('d.m.Y H:i', strtotime($bildirim->created_at))?>
                  </div>
                </div>
              </div>
              
              <!-- Sağ Taraf - Onay Durumu ve İşlemler -->
              <div class="col-md-4">
                <h5 class="mb-4" style="color: #001657; font-weight: 600; border-bottom: 2px solid #001657; padding-bottom: 10px;">
                  <i class="fas fa-clipboard-check mr-2"></i>Durum ve İşlemler
                </h5>
                
                <!-- Onay Durumu -->
                <div class="mb-4">
                  <label style="color: #6c757d; font-size: 13px; font-weight: 500; margin-bottom: 8px;">Onay Durumu</label>
                  <div>
                    <?php 
                    if ($bildirim->onay_durumu == 'approved'): ?>
                      <span class="badge badge-success" style="font-size: 13px; padding: 8px 14px;">
                        <i class="fa fa-check mr-1"></i>Onaylandı
                      </span>
                    <?php elseif ($bildirim->onay_durumu == 'rejected'): ?>
                      <span class="badge badge-danger" style="font-size: 13px; padding: 8px 14px;">
                        <i class="fa fa-times mr-1"></i>Reddedildi
                      </span>
                    <?php else: ?>
                      <span class="badge badge-warning" style="font-size: 13px; padding: 8px 14px;">
                        <i class="fa fa-clock mr-1"></i>Beklemede
                      </span>
                    <?php endif; ?>
                    
                    <?php if (!empty($bildirim->onaylayan_ad_soyad)): ?>
                      <div class="mt-2" style="color: #6c757d; font-size: 13px;">
                        <i class="fa fa-user mr-1"></i><?=htmlspecialchars($bildirim->onaylayan_ad_soyad)?>
                      </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($bildirim->onaylanma_tarihi)): ?>
                      <div class="mt-1" style="color: #6c757d; font-size: 12px;">
                        <i class="far fa-calendar mr-1"></i><?=date('d.m.Y H:i', strtotime($bildirim->onaylanma_tarihi))?>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
                
                <!-- Gereken Onay Seviyesi -->
                <?php if($bildirim->gereken_onay_seviyesi > 0): ?>
                <div class="mb-4">
                  <label style="color: #6c757d; font-size: 13px; font-weight: 500; margin-bottom: 5px;">Gereken Onay Seviyesi</label>
                  <div style="color: #495057; font-size: 14px;">
                    <?php
                    $seviye_text = [
                      0 => 'Onay Gerekmiyor',
                      1 => 'Amir Onayı',
                      2 => 'Müdür Onayı',
                      3 => 'Üst Yönetim Onayı'
                    ];
                    echo $seviye_text[$bildirim->gereken_onay_seviyesi] ?? 'Bilinmiyor';
                    ?>
                  </div>
                </div>
                <?php endif; ?>
                
                <!-- İşlem Butonları -->
                <?php if($bildirim->onay_durumu == 'pending' && $bildirim->gereken_onay_seviyesi > 0): ?>
                <div class="mb-4">
                  <label style="color: #6c757d; font-size: 13px; font-weight: 500; margin-bottom: 8px;">İşlemler</label>
                  <div class="d-flex flex-column">
                    <a href="<?=site_url('sistem_bildirimleri/onayla/'.$bildirim->id)?>" 
                       class="btn btn-success btn-sm mb-2" 
                       onclick="return confirm('Bu bildirimi onaylamak istediğinize emin misiniz?');">
                      <i class="fas fa-check"></i> Onayla
                    </a>
                    <a href="<?=site_url('sistem_bildirimleri/reddet/'.$bildirim->id)?>" 
                       class="btn btn-danger btn-sm" 
                       onclick="return confirm('Bu bildirimi reddetmek istediğinize emin misiniz?');">
                      <i class="fas fa-times"></i> Reddet
                    </a>
                  </div>
                </div>
                <?php endif; ?>
              </div>
            </div>
            
            <!-- Hareket Geçmişi -->
            <?php if(!empty($hareketler)): ?>
            <div class="row mt-4 pt-4 border-top">
              <div class="col-md-12">
                <h5 class="mb-4" style="color: #001657; font-weight: 600; border-bottom: 2px solid #001657; padding-bottom: 10px;">
                  <i class="fas fa-history mr-2"></i>Hareket Geçmişi
                </h5>
                <div class="timeline">
                  <?php foreach($hareketler as $hareket): ?>
                  <div class="mb-3" style="padding-left: 30px; position: relative; border-left: 2px solid #dee2e6; margin-left: 15px;">
                    <div style="position: absolute; left: -8px; top: 0; width: 14px; height: 14px; border-radius: 50%; background-color: #001657; border: 2px solid #ffffff;"></div>
                    <div style="display: flex; justify-content: space-between; align-items: start;">
                      <div>
                        <div style="font-weight: 600; color: #495057; font-size: 14px;">
                          <?php
                          $hareket_icon = [
                            'gonderildi' => 'fa-paper-plane',
                            'goruldu' => 'fa-eye',
                            'onaylandi' => 'fa-check-circle',
                            'reddedildi' => 'fa-times-circle'
                          ];
                          $hareket_text = [
                            'gonderildi' => 'Gönderildi',
                            'goruldu' => 'Görüntülendi',
                            'onaylandi' => 'Onaylandı',
                            'reddedildi' => 'Reddedildi'
                          ];
                          $hareket_color = [
                            'gonderildi' => 'primary',
                            'goruldu' => 'info',
                            'onaylandi' => 'success',
                            'reddedildi' => 'danger'
                          ];
                          ?>
                          <i class="fas <?=$hareket_icon[$hareket->hareket_tipi] ?? 'fa-circle'?> text-<?=$hareket_color[$hareket->hareket_tipi] ?? 'secondary'?> mr-2"></i>
                          <?=$hareket_text[$hareket->hareket_tipi] ?? ucfirst($hareket->hareket_tipi)?>
                        </div>
                        <?php if(!empty($hareket->aciklama)): ?>
                        <div style="color: #6c757d; font-size: 13px; margin-top: 5px;">
                          <?=htmlspecialchars($hareket->aciklama)?>
                        </div>
                        <?php endif; ?>
                        <div style="color: #6c757d; font-size: 12px; margin-top: 5px;">
                          <i class="fa fa-user mr-1"></i><?=htmlspecialchars($hareket->kullanici_ad_soyad)?>
                        </div>
                      </div>
                      <div style="color: #6c757d; font-size: 12px;">
                        <?=date('d.m.Y H:i', strtotime($hareket->created_at))?>
                      </div>
                    </div>
                  </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
            <?php endif; ?>
            
            <!-- Geri Dön Butonu -->
            <div class="row mt-4 pt-4 border-top">
              <div class="col-md-12">
                <div class="d-flex justify-content-end">
                  <a href="<?=site_url('sistem_bildirimleri')?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Listeye Dön
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<style>
  .card {
    transition: box-shadow 0.3s ease;
  }
  
  .card:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.15) !important;
  }
  
  .badge {
    font-weight: 500;
  }
  
  .timeline {
    position: relative;
  }
</style>

