<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top: 25px; background-color: #f8f9fa;">
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- Ana Kart -->
        <div class="card border-0 shadow-lg" style="border-radius: 16px; overflow: hidden; border-top: 4px solid #001657;">
          <!-- Card Header -->
          <div class="card-header border-0" style="background: linear-gradient(135deg, #001657 0%, #001657 100%); padding: 25px 30px;">
            <div class="d-flex align-items-center justify-content-between flex-wrap">
              <div class="d-flex align-items-center mb-2 mb-md-0">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3" style="width: 50px; height: 50px; background-color: rgba(255,255,255,0.25); box-shadow: 0 4px 8px rgba(0,0,0,0.15);">
                  <i class="fas fa-bell" style="color: #ffffff; font-size: 22px;"></i>
                </div>
                <div>
                  <h3 class="mb-1" style="color: #ffffff; font-weight: 700; font-size: 24px; letter-spacing: 0.5px; line-height: 1.2;">
                    Bildirim Detayı
                  </h3>
                  <div class="d-flex align-items-center">
                    <span class="badge badge-light mr-2" style="font-size: 12px; padding: 5px 10px; font-weight: 600;">
                      <i class="fas fa-hashtag mr-1"></i>#<?=$bildirim->id?>
                    </span>
                    <?php if ($bildirim->onay_durumu == 'approved'): ?>
                      <span class="badge badge-success" style="font-size: 12px; padding: 5px 10px;">
                        <i class="fas fa-check-circle mr-1"></i>Onaylandı
                      </span>
                    <?php elseif ($bildirim->onay_durumu == 'rejected'): ?>
                      <span class="badge badge-danger" style="font-size: 12px; padding: 5px 10px;">
                        <i class="fas fa-times-circle mr-1"></i>Reddedildi
                      </span>
                    <?php else: ?>
                      <span class="badge badge-warning" style="font-size: 12px; padding: 5px 10px;">
                        <i class="fas fa-clock mr-1"></i>Beklemede
                      </span>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
              <div class="d-flex align-items-center">
                <a href="<?=site_url('sistem_bildirimleri')?>" class="btn btn-light btn-sm shadow-sm mr-2" style="border-radius: 8px; font-weight: 600; padding: 8px 16px;">
                  <i class="fas fa-arrow-left mr-1"></i> Geri Dön
                </a>
                <?php if(isset($okunmamis) && $okunmamis && !empty($bildirim->tip_adi) && $bildirim->tip_adi == 'İzin Bildirimi'): ?>
                <button type="button" 
                        class="btn btn-success btn-sm shadow-sm" 
                        style="border-radius: 8px; font-weight: 600; padding: 8px 16px;"
                        onclick="okunduIsaretle(<?=$bildirim->id?>)">
                  <i class="fas fa-check-circle mr-1"></i> Okundu İşaretle
                </button>
                <?php endif; ?>
              </div>
            </div>
          </div>
          
          <!-- Card Body -->
          <div class="card-body" style="padding: 35px; background-color: #ffffff;">
            <div class="row">
              <!-- Sol Taraf - Bildirim Bilgileri -->
              <div class="col-lg-8 col-md-12 mb-4 mb-lg-0">
                <div class="info-section" style="background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%); padding: 25px; border-radius: 12px; border: 1px solid #e9ecef; height: 100%;">
                  <div class="d-flex align-items-center mb-4">
                    <div class="section-icon" style="width: 45px; height: 45px; background: linear-gradient(135deg, #001657 0%, #001657 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 15px; box-shadow: 0 4px 8px rgba(0,22,87,0.2);">
                      <i class="fas fa-info-circle" style="color: #ffffff; font-size: 20px;"></i>
                    </div>
                    <h5 class="mb-0" style="color: #001657; font-weight: 700; font-size: 18px; letter-spacing: 0.3px;">
                      Bildirim Bilgileri
                    </h5>
                  </div>
                  
                  <!-- Bildirim Tipi -->
                  <div class="info-item mb-4" style="padding: 15px; background-color: #ffffff; border-radius: 8px; border-left: 4px solid #007bff; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                    <label class="info-label" style="color: #6c757d; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; display: block;">
                      Bildirim Tipi
                    </label>
                    <div style="color: #212529; font-size: 15px; font-weight: 500;">
                      <span class="badge badge-info" style="font-size: 13px; padding: 8px 14px; font-weight: 600;">
                        <i class="fas fa-tag mr-1"></i><?=htmlspecialchars($bildirim->tip_adi)?>
                      </span>
                    </div>
                  </div>
                  
                  <!-- Başlık -->
                  <div class="info-item mb-4" style="padding: 15px; background-color: #ffffff; border-radius: 8px; border-left: 4px solid #001657; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                    <label class="info-label" style="color: #6c757d; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; display: block;">
                      Başlık
                    </label>
                    <div style="color: #212529; font-size: 18px; font-weight: 600; line-height: 1.4;">
                      <?=htmlspecialchars($bildirim->baslik)?>
                    </div>
                  </div>
                  
                  <!-- Mesaj -->
                  <div class="info-item mb-4" style="padding: 15px; background-color: #ffffff; border-radius: 8px; border-left: 4px solid #28a745; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                    <label class="info-label" style="color: #6c757d; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; display: block;">
                      Mesaj
                    </label>
                    <div style="color: #495057; font-size: 15px; line-height: 1.6; white-space: pre-wrap;">
                      <?=nl2br(htmlspecialchars($bildirim->mesaj))?>
                    </div>
                  </div>
                  
                  <!-- Gönderen -->
                  <?php if(!empty($bildirim->gonderen_ad_soyad)): ?>
                  <div class="info-item mb-4" style="padding: 15px; background-color: #ffffff; border-radius: 8px; border-left: 4px solid #ffc107; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                    <label class="info-label" style="color: #6c757d; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; display: block;">
                      Gönderen
                    </label>
                    <div class="d-flex align-items-center">
                      <div class="personel-avatar" style="width: 40px; height: 40px; background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 12px; box-shadow: 0 2px 6px rgba(255,193,7,0.2);">
                        <i class="fas fa-user" style="color: #ffffff; font-size: 16px;"></i>
                      </div>
                      <div style="color: #212529; font-size: 15px; font-weight: 500;">
                        <?=htmlspecialchars($bildirim->gonderen_ad_soyad)?>
                      </div>
                    </div>
                  </div>
                  <?php endif; ?>
                  
                  <!-- Oluşturulma Tarihi -->
                  <div class="info-item" style="padding: 15px; background-color: #f8f9fa; border-radius: 8px; border-left: 3px solid #6c757d;">
                    <label class="info-label" style="color: #6c757d; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; display: block;">
                      <i class="far fa-calendar mr-1"></i>Oluşturulma Tarihi
                    </label>
                    <div style="color: #495057; font-size: 14px; font-weight: 500;">
                      <?=date('d.m.Y H:i', strtotime($bildirim->created_at))?>
                    </div>
                  </div>
                </div>
              </div>
              
              <!-- Sağ Taraf - Onay Durumu ve İşlemler -->
              <div class="col-lg-4 col-md-12">
                <div class="approval-section" style="background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%); padding: 25px; border-radius: 12px; border: 1px solid #e9ecef; height: 100%;">
                  <div class="d-flex align-items-center mb-4">
                    <div class="section-icon" style="width: 45px; height: 45px; background: linear-gradient(135deg, #28a745 0%, #20c997 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 15px; box-shadow: 0 4px 8px rgba(40,167,69,0.2);">
                      <i class="fas fa-clipboard-check" style="color: #ffffff; font-size: 20px;"></i>
                    </div>
                    <h5 class="mb-0" style="color: #001657; font-weight: 700; font-size: 18px; letter-spacing: 0.3px;">
                      Durum ve İşlemler
                    </h5>
                  </div>
                  
                  <!-- Onay Durumu -->
                  <div class="approval-card mb-4" style="padding: 20px; background-color: #ffffff; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border: 1px solid #e9ecef;">
                    <label class="info-label" style="color: #6c757d; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 12px; display: block;">
                      Onay Durumu
                    </label>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                      <div>
                        <?php 
                        if ($bildirim->onay_durumu == 'approved'): ?>
                          <span class="badge badge-success" style="font-size: 13px; padding: 10px 16px; font-weight: 600; border-radius: 20px;">
                            <i class="fa fa-check mr-1"></i>Onaylandı
                          </span>
                        <?php elseif ($bildirim->onay_durumu == 'rejected'): ?>
                          <span class="badge badge-danger" style="font-size: 13px; padding: 10px 16px; font-weight: 600; border-radius: 20px;">
                            <i class="fa fa-times mr-1"></i>Reddedildi
                          </span>
                        <?php else: ?>
                          <span class="badge badge-warning" style="font-size: 13px; padding: 10px 16px; font-weight: 600; border-radius: 20px;">
                            <i class="fa fa-clock mr-1"></i>Beklemede
                          </span>
                        <?php endif; ?>
                      </div>
                    </div>
                    
                    <?php if (!empty($bildirim->onaylayan_ad_soyad)): ?>
                    <div style="padding: 12px; background-color: #f8f9fa; border-radius: 6px; margin-top: 10px;">
                      <div style="color: #495057; font-size: 13px; font-weight: 500; margin-bottom: 5px;">
                        <i class="fa fa-user mr-1" style="color: #6c757d;"></i><?=htmlspecialchars($bildirim->onaylayan_ad_soyad)?>
                      </div>
                      <?php if (!empty($bildirim->onaylanma_tarihi)): ?>
                      <div style="color: #6c757d; font-size: 12px;">
                        <i class="far fa-calendar mr-1"></i><?=date('d.m.Y H:i', strtotime($bildirim->onaylanma_tarihi))?>
                      </div>
                      <?php endif; ?>
                    </div>
                    <?php endif; ?>
                  </div>
                  
                  <!-- Gereken Onay Seviyesi -->
                  <?php if($bildirim->gereken_onay_seviyesi > 0): ?>
                  <div class="approval-card mb-4" style="padding: 20px; background-color: #ffffff; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border: 1px solid #e9ecef;">
                    <label class="info-label" style="color: #6c757d; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; display: block;">
                      Gereken Onay Seviyesi
                    </label>
                    <div style="color: #495057; font-size: 14px; font-weight: 500;">
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
                  <div class="approval-card mb-4" style="padding: 15px; background-color: #ffffff; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border: 1px solid #e9ecef;">
                    <label class="info-label" style="color: #6c757d; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 10px; display: block;">
                      İşlemler
                    </label>
                    <div class="d-flex flex-column" style="gap: 8px;">
                      <a href="<?=site_url('sistem_bildirimleri/onayla/'.$bildirim->id)?>" 
                         class="btn btn-success shadow-sm" 
                         style="border-radius: 6px; font-weight: 500; font-size: 12px; padding: 6px 12px; border: none;"
                         onclick="return confirm('Bu bildirimi onaylamak istediğinize emin misiniz?');">
                        <i class="fas fa-check" style="font-size: 11px;"></i> Onayla
                      </a>
                      <a href="<?=site_url('sistem_bildirimleri/reddet/'.$bildirim->id)?>" 
                         class="btn btn-danger shadow-sm" 
                         style="border-radius: 6px; font-weight: 500; font-size: 12px; padding: 6px 12px; border: none;"
                         onclick="return confirm('Bu bildirimi reddetmek istediğinize emin misiniz?');">
                        <i class="fas fa-times" style="font-size: 11px;"></i> Reddet
                      </a>
                    </div>
                  </div>
                  <?php endif; ?>
                  
                  <!-- İzin Talebi Linki -->
                  <?php if(!empty($bildirim->tip_adi) && $bildirim->tip_adi == 'İzin Bildirimi' && !empty($izin_talep_id)): ?>
                  <div class="approval-card" style="padding: 20px; background-color: #e7f3ff; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border: 1px solid #b3d9ff;">
                    <label class="info-label" style="color: #0066cc; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; display: block;">
                      <i class="fas fa-link mr-1"></i>İlgili İzin Talebi
                    </label>
                    <div style="color: #495057; font-size: 13px; margin-bottom: 10px;">
                      Bu bildirim bir izin talebi ile ilgilidir.
                    </div>
                    <a href="<?=site_url('izin/detay/'.$izin_talep_id)?>" 
                       class="btn btn-info btn-sm shadow-sm" 
                       style="border-radius: 8px; font-weight: 600; width: 100%;">
                      <i class="fas fa-external-link-alt mr-1"></i> İzin Talebini Görüntüle
                    </a>
                  </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
            
            <!-- Hareket Geçmişi -->
            <?php if(!empty($hareketler)): ?>
            <div class="row mt-4 pt-4" style="border-top: 2px solid #e9ecef;">
              <div class="col-md-12">
                <div class="d-flex align-items-center mb-4">
                  <div class="section-icon" style="width: 45px; height: 45px; background: linear-gradient(135deg, #6c757d 0%, #495057 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 15px; box-shadow: 0 4px 8px rgba(108,117,125,0.2);">
                    <i class="fas fa-history" style="color: #ffffff; font-size: 20px;"></i>
                  </div>
                  <h5 class="mb-0" style="color: #001657; font-weight: 700; font-size: 18px; letter-spacing: 0.3px;">
                    Hareket Geçmişi
                  </h5>
                </div>
                <div class="timeline" style="padding-left: 20px;">
                  <?php foreach($hareketler as $hareket): ?>
                  <div class="mb-4" style="padding-left: 30px; position: relative; border-left: 3px solid #dee2e6; margin-left: 15px;">
                    <div style="position: absolute; left: -10px; top: 0; width: 20px; height: 20px; border-radius: 50%; background-color: #001657; border: 3px solid #ffffff; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"></div>
                    <div style="display: flex; justify-content: space-between; align-items: start; flex-wrap: wrap;">
                      <div style="flex: 1; min-width: 200px;">
                        <div style="font-weight: 600; color: #495057; font-size: 15px; margin-bottom: 8px;">
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
                            'gonderildi' => '#007bff',
                            'goruldu' => '#17a2b8',
                            'onaylandi' => '#28a745',
                            'reddedildi' => '#dc3545'
                          ];
                          ?>
                          <i class="fas <?=$hareket_icon[$hareket->hareket_tipi] ?? 'fa-circle'?> mr-2" style="color: <?=$hareket_color[$hareket->hareket_tipi] ?? '#6c757d'?>;"></i>
                          <?=$hareket_text[$hareket->hareket_tipi] ?? ucfirst($hareket->hareket_tipi)?>
                        </div>
                        <?php if(!empty($hareket->aciklama)): ?>
                        <div style="color: #6c757d; font-size: 14px; margin-bottom: 8px; padding: 10px; background-color: #f8f9fa; border-radius: 6px;">
                          <?=htmlspecialchars($hareket->aciklama)?>
                        </div>
                        <?php endif; ?>
                        <div style="color: #6c757d; font-size: 13px;">
                          <i class="fa fa-user mr-1"></i><?=htmlspecialchars($hareket->kullanici_ad_soyad)?>
                        </div>
                      </div>
                      <div style="color: #6c757d; font-size: 13px; font-weight: 500; margin-top: 5px;">
                        <i class="far fa-clock mr-1"></i><?=date('d.m.Y H:i', strtotime($hareket->created_at))?>
                      </div>
                    </div>
                  </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
            <?php endif; ?>
            
            <!-- Geri Dön Butonu -->
            <div class="row mt-4 pt-4" style="border-top: 2px solid #e9ecef;">
              <div class="col-md-12">
                <div class="d-flex justify-content-end">
                  <a href="<?=site_url('sistem_bildirimleri')?>" class="btn btn-secondary shadow-sm" style="border-radius: 8px; font-weight: 600; padding: 10px 20px;">
                    <i class="fas fa-arrow-left mr-1"></i> Listeye Dön
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
  /* Kurumsal Tasarım Stilleri */
  .card {
    transition: all 0.3s ease;
  }
  
  .card:hover {
    box-shadow: 0 8px 24px rgba(0,0,0,0.12) !important;
    transform: translateY(-2px);
  }
  
  .info-section, .approval-section {
    transition: all 0.3s ease;
  }
  
  .info-section:hover, .approval-section:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  }
  
  .info-item, .approval-card {
    transition: all 0.3s ease;
  }
  
  .info-item:hover, .approval-card:hover {
    transform: translateX(5px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1) !important;
  }
  
  .section-icon {
    transition: transform 0.3s ease;
  }
  
  .section-icon:hover {
    transform: scale(1.1) rotate(5deg);
  }
  
  .badge {
    font-weight: 600;
    letter-spacing: 0.3px;
  }
  
  .btn {
    transition: all 0.3s ease;
  }
  
  .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15) !important;
  }
  
  .timeline {
    position: relative;
  }
  
  /* Responsive Düzenlemeler */
  @media (max-width: 768px) {
    .card-body {
      padding: 20px !important;
    }
    
    .card-header {
      padding: 20px !important;
    }
    
    .info-section, .approval-section {
      padding: 20px !important;
    }
    
    .info-item, .approval-card {
      padding: 12px !important;
    }
  }
</style>

<script>
function okunduIsaretle(bildirimId) {
  if (confirm('Bildirimleri okundu olarak işaretlemek istediğinize emin misiniz?')) {
    // Butonu devre dışı bırak
    var btn = $('button[onclick*="okunduIsaretle"]');
    btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> İşleniyor...');
    
    // AJAX ile okundu işaretle
    $.ajax({
      url: '<?=site_url("sistem_bildirimleri/okundu_isaretle")?>/' + bildirimId,
      type: 'GET',
      dataType: 'json',
      headers: {
        'X-Requested-With': 'XMLHttpRequest'
      },
      success: function(response) {
        if (response && response.success) {
          // Butonu görsel olarak değiştir
          btn.removeClass('btn-success')
            .addClass('btn-secondary')
            .html('<i class="fas fa-check-circle mr-1"></i> Okundu İşaretlendi');
          
          // Başarı mesajı göster
          alert(response.message || 'Bildirimler okundu olarak işaretlendi.');
        } else {
          btn.prop('disabled', false).html('<i class="fas fa-check-circle mr-1"></i> Okundu İşaretle');
          alert('Bir hata oluştu: ' + (response ? response.message : 'Bilinmeyen hata'));
        }
      },
      error: function(xhr, status, error) {
        // AJAX başarısız olursa normal redirect yap
        btn.prop('disabled', false).html('<i class="fas fa-check-circle mr-1"></i> Okundu İşaretle');
        // Normal sayfa yükleme ile yap
        window.location.href = '<?=site_url("sistem_bildirimleri/okundu_isaretle")?>/' + bildirimId;
      }
    });
  }
}
</script>
