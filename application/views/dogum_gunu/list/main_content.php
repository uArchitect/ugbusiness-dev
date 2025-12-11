<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top: 25px; background-color: #f8f9fa;">
  <section class="content pr-0">
    <div class="row">
      <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
          <!-- Card Header -->
          <div class="card-header border-0" style="background: linear-gradient(135deg, #001657 0%, #001657 100%); padding: 15px 20px;">
            <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between">
              <div class="d-flex align-items-center mb-3 mb-md-0 flex-shrink-0">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-2 mr-md-3" style="width: 40px; height: 40px; background-color: rgba(255,255,255,0.2); flex-shrink: 0;">
                  <i class="fas fa-birthday-cake" style="color: #ffffff; font-size: 18px;"></i>
                </div>
                <div>
                  <h3 class="mb-0" style="color: #ffffff; font-weight: 700; font-size: 18px; letter-spacing: 0.5px; line-height: 1.2;">
                    Doğum Günü Bildirimleri
                  </h3>
                  <small class="d-none d-md-block" style="color: rgba(255,255,255,0.9); font-size: 13px; line-height: 1.4;">Çalışanların doğum günü takibi ve SMS bildirimleri</small>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Card Body -->
          <div class="card-body" style="padding: 25px; background-color: #ffffff;">
            
            <!-- İstatistikler -->
            <div class="row mb-4">
              <div class="col-lg-4 col-md-6 col-12 mb-3">
                <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #001657 0%, #001657 100%); border-radius: 12px; overflow: hidden;">
                  <div class="card-body text-white" style="padding: 18px 20px;">
                    <div class="d-flex align-items-center justify-content-between">
                      <div class="flex-grow-1">
                        <h4 class="mb-1" style="font-weight: 700; font-size: 28px; line-height: 1;"><?= $bu_ay_dogum_gunu_sayisi ?></h4>
                        <small style="opacity: 0.9; font-size: 13px;">Bu Ay Doğum Günü</small>
                      </div>
                      <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 50px; height: 50px; background-color: rgba(255,255,255,0.15);">
                        <i class="fas fa-birthday-cake" style="font-size: 24px;"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-12 mb-3">
                <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #001657 0%, #001657 100%); border-radius: 12px; overflow: hidden;">
                  <div class="card-body text-white" style="padding: 18px 20px;">
                    <div class="d-flex align-items-center justify-content-between">
                      <div class="flex-grow-1">
                        <h4 class="mb-1" style="font-weight: 700; font-size: 28px; line-height: 1;"><?= $bugun_dogum_gunu_sayisi ?></h4>
                        <small style="opacity: 0.9; font-size: 13px;">Bugün Doğum Günü</small>
                      </div>
                      <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 50px; height: 50px; background-color: rgba(255,255,255,0.15);">
                        <i class="fas fa-calendar-day" style="font-size: 24px;"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-12 mb-3">
                <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #001657 0%, #001657 100%); border-radius: 12px; overflow: hidden;">
                  <div class="card-body text-white" style="padding: 18px 20px;">
                    <div class="d-flex align-items-center justify-content-between">
                      <div class="flex-grow-1">
                        <h4 class="mb-1" style="font-weight: 700; font-size: 28px; line-height: 1;"><?= $toplam_calisan ?></h4>
                        <small style="opacity: 0.9; font-size: 13px;">Toplam Çalışan</small>
                      </div>
                      <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 50px; height: 50px; background-color: rgba(255,255,255,0.15);">
                        <i class="fas fa-users" style="font-size: 24px;"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Bugün Doğum Günü Olanlar -->
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px; border-left: 4px solid #001657;">
              <div class="card-header bg-white border-0" style="padding: 18px 25px;">
                <h5 class="mb-0" style="color: #001657; font-weight: 700; font-size: 18px;">
                  <i class="fas fa-calendar-day mr-2"></i> Bugün Doğum Günü Olanlar
                </h5>
              </div>
              <div class="card-body" style="padding: 15px 20px;">
                <div class="table-responsive">
                  <table class="table table-hover align-middle mb-0" style="min-width: 600px;">
                    <thead class="text-white text-center" style="background: linear-gradient(135deg, #001657 0%, #001657 100%);">
                      <tr>
                        <th style="font-weight: 600; padding: 12px 10px; white-space: nowrap;">Çalışan Adı</th>
                        <th class="d-none d-md-table-cell" style="font-weight: 600; padding: 12px 10px; white-space: nowrap;">Departman</th>
                        <th style="font-weight: 600; padding: 12px 10px; white-space: nowrap;">Yaş</th>
                        <th class="d-none d-lg-table-cell" style="font-weight: 600; padding: 12px 10px; white-space: nowrap;">Telefon</th>
                        <th style="font-weight: 600; padding: 12px 10px; white-space: nowrap; min-width: 150px;">SMS Durumu</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($bugun_dogum_gunu)): ?>
                        <?php foreach ($bugun_dogum_gunu as $k): 
                          $bas_harfler = mb_substr(trim($k->kullanici_ad_soyad ?? ''), 0, 2, 'UTF-8');
                          $dogum_tarihi_obj = new DateTime($k->kullanici_dogum_tarihi);
                          $bugun_obj = new DateTime();
                          $yas = $bugun_obj->diff($dogum_tarihi_obj)->y;
                          $sms_gonderildi = in_array($k->kullanici_id, $sms_gonderilen_ids ?? array());
                        ?>
                        <tr>
                          <td style="padding: 12px 10px;">
                            <div class="d-flex align-items-center">
                              <div class="rounded-circle text-white d-flex align-items-center justify-content-center mr-2 mr-md-3 flex-shrink-0" style="width: 40px; height: 40px; font-weight: 600; background-color: #001657;">
                                <?= $bas_harfler ?>
                              </div>
                              <div class="flex-grow-1" style="min-width: 0;">
                                <strong style="color: #495057; font-size: 14px; display: block; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?= htmlspecialchars($k->kullanici_ad_soyad) ?></strong>
                                <?php if (!empty($k->kullanici_unvan)): ?>
                                  <small class="d-none d-md-block" style="color: #6c757d; font-size: 12px;"><?= htmlspecialchars($k->kullanici_unvan) ?></small>
                                <?php endif; ?>
                                <small class="d-md-none" style="color: #6c757d; font-size: 12px;"><?= htmlspecialchars($k->departman_adi ?? '-') ?></small>
                              </div>
                            </div>
                          </td>
                          <td class="d-none d-md-table-cell" style="padding: 12px 10px; color: #6c757d; font-size: 14px;"><?= htmlspecialchars($k->departman_adi ?? '-') ?></td>
                          <td style="padding: 12px 10px;">
                            <span class="badge" style="padding: 5px 10px; font-size: 12px; background-color: #001657; color: #ffffff; border-radius: 6px; font-weight: 500;"><?= $yas ?> Yaş</span>
                          </td>
                          <td class="d-none d-lg-table-cell" style="padding: 12px 10px; color: #6c757d; font-size: 14px;">
                            <i class="fas fa-phone mr-1" style="color: #001657;"></i>
                            <?= htmlspecialchars($k->kullanici_bireysel_iletisim_no ?? '-') ?>
                          </td>
                          <td style="padding: 12px 10px; text-align: center;">
                            <?php if ($sms_gonderildi): ?>
                              <span class="badge" style="padding: 5px 10px; font-size: 12px; background-color: #28a745; color: #ffffff; border-radius: 6px; font-weight: 500;">
                                <i class="fas fa-check-circle mr-1"></i> <span class="d-none d-sm-inline">Gönderildi</span><span class="d-sm-none">✓</span>
                              </span>
                            <?php else: ?>
                              <button class="btn btn-success btn-xs manuel-sms-gonder" data-kullanici-id="<?= $k->kullanici_id ?>" data-kullanici-ad="<?= htmlspecialchars($k->kullanici_ad_soyad) ?>" style="font-size: 11px; padding: 6px 12px; white-space: nowrap;">
                                <i class="fas fa-paper-plane mr-1" style="font-size: 10px;"></i> <span class="d-none d-md-inline">Mesaj Gönder</span><span class="d-md-none">Gönder</span>
                              </button>
                            <?php endif; ?>
                          </td>
                        </tr>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <tr><td colspan="5" class="text-center" style="padding: 30px; color: #6c757d;">
                          <i class="fas fa-info-circle" style="font-size: 24px; margin-bottom: 10px; display: block;"></i>
                          Bugün doğum günü olan çalışan bulunmamaktadır.
                        </td></tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <!-- Bu Ay Doğum Günü Olanlar -->
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px; border-left: 4px solid #001657;">
              <div class="card-header bg-white border-0" style="padding: 18px 25px;">
                <h5 class="mb-0" style="color: #001657; font-weight: 700; font-size: 18px;">
                  <i class="fas fa-calendar-alt mr-2"></i> Bu Ay Doğum Günü Olanlar
                </h5>
              </div>
              <div class="card-body" style="padding: 15px 20px;">
                <div class="table-responsive">
                  <table class="table table-hover align-middle mb-0" style="min-width: 800px;">
                    <thead class="text-white text-center" style="background: linear-gradient(135deg, #001657 0%, #001657 100%);">
                      <tr>
                        <th style="font-weight: 600; padding: 12px 10px; white-space: nowrap;">Çalışan Adı</th>
                        <th class="d-none d-md-table-cell" style="font-weight: 600; padding: 12px 10px; white-space: nowrap;">Departman</th>
                        <th class="d-none d-lg-table-cell" style="font-weight: 600; padding: 12px 10px; white-space: nowrap;">Doğum Tarihi</th>
                        <th style="font-weight: 600; padding: 12px 10px; white-space: nowrap;">Yaş</th>
                        <th style="font-weight: 600; padding: 12px 10px; white-space: nowrap;">Kalan Gün</th>
                        <th class="d-none d-xl-table-cell" style="font-weight: 600; padding: 12px 10px; white-space: nowrap;">Telefon</th>
                        <th style="font-weight: 600; padding: 12px 10px; white-space: nowrap; min-width: 150px;">SMS Durumu</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($bu_ay_dogum_gunu)): ?>
                        <?php foreach ($bu_ay_dogum_gunu as $k): 
                          $bas_harfler = mb_substr(trim($k->kullanici_ad_soyad ?? ''), 0, 2, 'UTF-8');
                          $dogum_tarihi_obj = new DateTime($k->kullanici_dogum_tarihi);
                          $bugun_obj = new DateTime();
                          $yas = $bugun_obj->diff($dogum_tarihi_obj)->y;
                          
                          $dogum_gunu_bu_yil = date('Y') . '-' . date('m-d', strtotime($k->kullanici_dogum_tarihi));
                          $bugun_tarih = date('Y-m-d');
                          
                          if ($dogum_gunu_bu_yil < $bugun_tarih) {
                            // Bu ay geçti
                            $kalan_gun = null;
                            $durum = 'gecmiş';
                          } elseif ($dogum_gunu_bu_yil == $bugun_tarih) {
                            // Bugün
                            $kalan_gun = 0;
                            $durum = 'bugun';
                          } else {
                            // Gelecek
                            $kalan_gun = floor((strtotime($dogum_gunu_bu_yil) - strtotime($bugun_tarih)) / 86400);
                            $durum = 'gelecek';
                          }
                          
                          // Bugün doğum günü ise SMS durumunu kontrol et
                          $sms_gonderildi = ($durum == 'bugun') ? in_array($k->kullanici_id, $sms_gonderilen_ids ?? array()) : false;
                        ?>
                        <tr>
                          <td style="padding: 12px 10px;">
                            <div class="d-flex align-items-center">
                              <div class="rounded-circle text-white d-flex align-items-center justify-content-center mr-2 mr-md-3 flex-shrink-0" style="width: 40px; height: 40px; font-weight: 600; background-color: #001657;">
                                <?= $bas_harfler ?>
                              </div>
                              <div class="flex-grow-1" style="min-width: 0;">
                                <strong style="color: #495057; font-size: 14px; display: block; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?= htmlspecialchars($k->kullanici_ad_soyad) ?></strong>
                                <?php if (!empty($k->kullanici_unvan)): ?>
                                  <small class="d-none d-md-block" style="color: #6c757d; font-size: 12px;"><?= htmlspecialchars($k->kullanici_unvan) ?></small>
                                <?php endif; ?>
                                <small class="d-md-none" style="color: #6c757d; font-size: 12px;"><?= htmlspecialchars($k->departman_adi ?? '-') ?></small>
                                <small class="d-lg-none d-md-block" style="color: #6c757d; font-size: 12px;"><?= date("d.m.Y", strtotime($k->kullanici_dogum_tarihi)) ?></small>
                              </div>
                            </div>
                          </td>
                          <td class="d-none d-md-table-cell" style="padding: 12px 10px; color: #6c757d; font-size: 14px;"><?= htmlspecialchars($k->departman_adi ?? '-') ?></td>
                          <td class="d-none d-lg-table-cell" style="padding: 12px 10px; color: #6c757d; font-size: 14px;"><?= date("d.m.Y", strtotime($k->kullanici_dogum_tarihi)) ?></td>
                          <td style="padding: 12px 10px;">
                            <span class="badge" style="padding: 5px 10px; font-size: 12px; background-color: #001657; color: #ffffff; border-radius: 6px; font-weight: 500;"><?= $yas ?> Yaş</span>
                          </td>
                          <td style="padding: 12px 10px;">
                            <?php if ($durum == 'gecmiş'): ?>
                              <span class="badge" style="padding: 5px 10px; font-size: 12px; background-color: #6c757d; color: #ffffff; border-radius: 6px; font-weight: 500;">Geçti</span>
                            <?php elseif ($durum == 'bugun'): ?>
                              <span class="badge" style="padding: 5px 10px; font-size: 12px; background-color: #dc3545; color: #ffffff; border-radius: 6px; font-weight: 500;">Bugün</span>
                            <?php else: ?>
                              <span class="badge" style="padding: 5px 10px; font-size: 12px; background-color: <?= $kalan_gun <= 7 ? '#ffc107' : '#001657' ?>; color: #ffffff; border-radius: 6px; font-weight: 500;"><?= $kalan_gun ?> Gün</span>
                            <?php endif; ?>
                          </td>
                          <td class="d-none d-xl-table-cell" style="padding: 12px 10px; color: #6c757d; font-size: 14px;">
                            <i class="fas fa-phone mr-1" style="color: #001657;"></i>
                            <?= htmlspecialchars($k->kullanici_bireysel_iletisim_no ?? '-') ?>
                          </td>
                          <td style="padding: 12px 10px; text-align: center;">
                            <?php if ($durum == 'bugun'): ?>
                              <?php if ($sms_gonderildi): ?>
                                <span class="badge" style="padding: 5px 10px; font-size: 12px; background-color: #28a745; color: #ffffff; border-radius: 6px; font-weight: 500;">
                                  <i class="fas fa-check-circle mr-1"></i> <span class="d-none d-sm-inline">Gönderildi</span><span class="d-sm-none">✓</span>
                                </span>
                              <?php else: ?>
                                <button class="btn btn-success btn-xs manuel-sms-gonder" data-kullanici-id="<?= $k->kullanici_id ?>" data-kullanici-ad="<?= htmlspecialchars($k->kullanici_ad_soyad) ?>" style="font-size: 11px; padding: 6px 12px; white-space: nowrap;">
                                  <i class="fas fa-paper-plane mr-1" style="font-size: 10px;"></i> <span class="d-none d-md-inline">Mesaj Gönder</span><span class="d-md-none">Gönder</span>
                                </button>
                              <?php endif; ?>
                            <?php elseif ($durum == 'gelecek'): ?>
                              <span class="badge" style="padding: 5px 10px; font-size: 12px; background-color: #6c757d; color: #ffffff; border-radius: 6px; font-weight: 500; opacity: 0.7;">
                                <i class="fas fa-calendar-alt mr-1"></i> <span class="d-none d-lg-inline"><?= $kalan_gun ?> gün sonra</span><span class="d-lg-none"><?= $kalan_gun ?> gün</span>
                              </span>
                            <?php else: ?>
                              <span class="badge" style="padding: 5px 10px; font-size: 12px; background-color: #6c757d; color: #ffffff; border-radius: 6px; font-weight: 500; opacity: 0.5;">
                                <i class="fas fa-minus mr-1"></i> -
                              </span>
                            <?php endif; ?>
                          </td>
                        </tr>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <tr><td colspan="7" class="text-center" style="padding: 30px; color: #6c757d;">
                          <i class="fas fa-info-circle" style="font-size: 24px; margin-bottom: 10px; display: block;"></i>
                          Bu ay doğum günü olan çalışan bulunmamaktadır.
                        </td></tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>


          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Manuel SMS Gönderme
  $('.manuel-sms-gonder').on('click', function() {
    const btn = $(this);
    const kullaniciId = btn.data('kullanici-id');
    const kullaniciAd = btn.data('kullanici-ad');
    
    if (!confirm('Doğum günü mesajını ' + kullaniciAd + ' için şimdi göndermek istediğinize emin misiniz?')) {
      return;
    }
    
    btn.prop('disabled', true);
    btn.html('<i class="fas fa-spinner fa-spin"></i> Gönderiliyor...');
    
    $.ajax({
      url: '<?= base_url("dogum_gunu/manuel_sms_gonder") ?>',
      type: 'POST',
      data: { kullanici_id: kullaniciId },
      dataType: 'json',
      success: function(response) {
        if (response.success) {
          // Başarı mesajı
          const alertHtml = `
            <div class="alert alert-success alert-dismissible fade show" style="position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px; border-left: 4px solid #28a745;">
              <i class="fas fa-check-circle mr-2"></i>
              ${response.message}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          `;
          $('body').append(alertHtml);
          
          // Sayfayı yenile
          setTimeout(function() {
            window.location.reload();
          }, 2000);
        } else {
          // Hata mesajı
          alert('Hata: ' + (response.message || 'Bilinmeyen hata'));
          btn.prop('disabled', false);
          btn.html('<i class="fas fa-paper-plane mr-1"></i> <span class="d-none d-md-inline">Mesaj Gönder</span><span class="d-md-none">Gönder</span>');
        }
      },
        error: function() {
        alert('Bir hata oluştu. Lütfen tekrar deneyin.');
        btn.prop('disabled', false);
        btn.html('<i class="fas fa-paper-plane mr-1"></i> <span class="d-none d-md-inline">Mesaj Gönder</span><span class="d-md-none">Gönder</span>');
      }
    });
  });
  
});
</script>

<style>
/* Responsive Ayarlar */
@media (max-width: 767.98px) {
  .content-wrapper {
    padding-top: 15px !important;
  }
  
  .card-header {
    padding: 15px !important;
  }
  
  .card-body {
    padding: 15px !important;
  }
  
  .table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
  }
  
  .table {
    font-size: 13px;
  }
  
  .badge {
    font-size: 11px !important;
    padding: 4px 8px !important;
  }
  
  /* İstatistik kartları mobilde tam genişlik */
  .col-12.mb-3 {
    margin-bottom: 15px !important;
  }
}

/* Tablo sütunlarının kaymaması için */
.table {
  table-layout: auto;
}

.table th,
.table td {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

/* Mobilde bazı sütunlar için özel genişlik */
@media (max-width: 575.98px) {
  .table th:nth-child(1),
  .table td:nth-child(1) {
    min-width: 150px;
    max-width: 200px;
  }
  
  .table th:last-child,
  .table td:last-child {
    min-width: 120px;
  }
}

/* Manuel SMS Gönder Butonu Stili */
.manuel-sms-gonder {
  transition: all 0.3s ease;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.manuel-sms-gonder:hover {
  transform: translateY(-1px);
  box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.manuel-sms-gonder:active {
  transform: translateY(0);
}

.manuel-sms-gonder:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}
</style>

