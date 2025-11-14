<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top: 25px; background-color: #f8f9fa;">
  <section class="content pr-0">
    <div class="row">
      <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
          <!-- Card Header -->
          <div class="card-header border-0" style="background: linear-gradient(135deg, #001657 0%, #001657 100%); padding: 18px 25px;">
            <div class="d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3" style="width: 40px; height: 40px; background-color: rgba(255,255,255,0.2);">
                  <i class="fas fa-birthday-cake" style="color: #ffffff; font-size: 18px;"></i>
                </div>
                <div>
                  <h3 class="mb-0" style="color: #ffffff; font-weight: 700; font-size: 20px; letter-spacing: 0.5px; line-height: 1.2;">
                    Doğum Günü Bildirimleri
                  </h3>
                  <small style="color: rgba(255,255,255,0.9); font-size: 13px; line-height: 1.4;">Çalışanların doğum günü takibi ve SMS bildirimleri</small>
                </div>
              </div>
              <div class="d-flex align-items-center">
                <div class="custom-control custom-switch mr-2">
                  <input type="checkbox" class="custom-control-input" id="otomatikSmsSwitch" <?= $otomatik_sms_aktif == 1 ? 'checked' : '' ?>>
                  <label class="custom-control-label text-white" for="otomatikSmsSwitch" style="font-weight: 600; cursor: pointer;">
                    <span id="switch-label-text"><?= $otomatik_sms_aktif == 1 ? 'Otomatik Mesaj Gönderimi Açık' : 'Otomatik Mesaj Gönderimi Kapalı' ?></span>
                  </label>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Card Body -->
          <div class="card-body" style="padding: 25px; background-color: #ffffff;">
            
            <!-- İstatistikler -->
            <div class="row mb-4">
              <div class="col-md-4 col-6 mb-3">
                <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #001657 0%, #001657 100%); border-radius: 12px; overflow: hidden;">
                  <div class="card-body text-white" style="padding: 20px;">
                    <div class="d-flex align-items-center justify-content-between">
                      <div>
                        <h4 class="mb-1" style="font-weight: 700; font-size: 32px; line-height: 1;"><?= $bu_ay_dogum_gunu_sayisi ?></h4>
                        <small style="opacity: 0.9; font-size: 14px;">Bu Ay Doğum Günü</small>
                      </div>
                      <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background-color: rgba(255,255,255,0.15);">
                        <i class="fas fa-birthday-cake" style="font-size: 28px;"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-6 mb-3">
                <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #001657 0%, #001657 100%); border-radius: 12px; overflow: hidden;">
                  <div class="card-body text-white" style="padding: 20px;">
                    <div class="d-flex align-items-center justify-content-between">
                      <div>
                        <h4 class="mb-1" style="font-weight: 700; font-size: 32px; line-height: 1;"><?= $bugun_dogum_gunu_sayisi ?></h4>
                        <small style="opacity: 0.9; font-size: 14px;">Bugün Doğum Günü</small>
                      </div>
                      <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background-color: rgba(255,255,255,0.15);">
                        <i class="fas fa-calendar-day" style="font-size: 28px;"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-6 mb-3">
                <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #001657 0%, #001657 100%); border-radius: 12px; overflow: hidden;">
                  <div class="card-body text-white" style="padding: 20px;">
                    <div class="d-flex align-items-center justify-content-between">
                      <div>
                        <h4 class="mb-1" style="font-weight: 700; font-size: 32px; line-height: 1;"><?= $toplam_calisan ?></h4>
                        <small style="opacity: 0.9; font-size: 14px;">Toplam Çalışan</small>
                      </div>
                      <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background-color: rgba(255,255,255,0.15);">
                        <i class="fas fa-users" style="font-size: 28px;"></i>
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
              <div class="card-body" style="padding: 20px;">
                <div class="table-responsive">
                  <table class="table table-hover align-middle mb-0">
                    <thead class="text-white text-center" style="background: linear-gradient(135deg, #001657 0%, #001657 100%);">
                      <tr>
                        <th style="font-weight: 600; padding: 15px 12px;">Çalışan Adı</th>
                        <th style="font-weight: 600; padding: 15px 12px;">Departman</th>
                        <th style="font-weight: 600; padding: 15px 12px;">Yaş</th>
                        <th style="font-weight: 600; padding: 15px 12px;">Telefon</th>
                        <th style="font-weight: 600; padding: 15px 12px; width: 140px;">İşlem</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($bugun_dogum_gunu)): ?>
                        <?php foreach ($bugun_dogum_gunu as $k): 
                          $bas_harfler = mb_substr(trim($k->kullanici_ad_soyad ?? ''), 0, 2, 'UTF-8');
                          $dogum_tarihi_obj = new DateTime($k->kullanici_dogum_tarihi);
                          $bugun_obj = new DateTime();
                          $yas = $bugun_obj->diff($dogum_tarihi_obj)->y;
                        ?>
                        <tr>
                          <td style="padding: 15px 12px;">
                            <div class="d-flex align-items-center">
                              <div class="rounded-circle text-white d-flex align-items-center justify-content-center mr-3" style="width: 40px; height: 40px; font-weight: 600; background-color: #001657;">
                                <?= $bas_harfler ?>
                              </div>
                              <div>
                                <strong style="color: #495057;"><?= htmlspecialchars($k->kullanici_ad_soyad) ?></strong>
                                <?php if (!empty($k->kullanici_unvan)): ?>
                                  <br><small style="color: #6c757d;"><?= htmlspecialchars($k->kullanici_unvan) ?></small>
                                <?php endif; ?>
                              </div>
                            </div>
                          </td>
                          <td style="padding: 15px 12px; color: #6c757d;"><?= htmlspecialchars($k->departman_adi ?? '-') ?></td>
                          <td style="padding: 15px 12px;">
                            <span class="badge" style="padding: 6px 12px; font-size: 13px; background-color: #001657; color: #ffffff; border-radius: 6px; font-weight: 500;"><?= $yas ?> Yaş</span>
                          </td>
                          <td style="padding: 15px 12px; color: #6c757d;">
                            <i class="fas fa-phone mr-1" style="color: #001657;"></i>
                            <?= htmlspecialchars($k->kullanici_bireysel_iletisim_no ?? '-') ?>
                          </td>
                          <td style="padding: 15px 12px; text-align: center;">
                            <button class="btn btn-sm shadow-sm" style="border-radius: 6px; background-color: #001657; color: #ffffff; border: none; font-weight: 500; cursor: not-allowed; opacity: 0.6; padding: 6px 12px;" disabled>
                              <i class="fas fa-sms mr-1"></i> SMS Gönder
                            </button>
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
              <div class="card-body" style="padding: 20px;">
                <div class="table-responsive">
                  <table class="table table-hover align-middle mb-0">
                    <thead class="text-white text-center" style="background: linear-gradient(135deg, #001657 0%, #001657 100%);">
                      <tr>
                        <th style="font-weight: 600; padding: 15px 12px;">Çalışan Adı</th>
                        <th style="font-weight: 600; padding: 15px 12px;">Departman</th>
                        <th style="font-weight: 600; padding: 15px 12px;">Doğum Tarihi</th>
                        <th style="font-weight: 600; padding: 15px 12px;">Yaş</th>
                        <th style="font-weight: 600; padding: 15px 12px;">Kalan Gün</th>
                        <th style="font-weight: 600; padding: 15px 12px;">Telefon</th>
                        <th style="font-weight: 600; padding: 15px 12px; width: 140px;">İşlem</th>
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
                        ?>
                        <tr>
                          <td style="padding: 15px 12px;">
                            <div class="d-flex align-items-center">
                              <div class="rounded-circle text-white d-flex align-items-center justify-content-center mr-3" style="width: 40px; height: 40px; font-weight: 600; background-color: #001657;">
                                <?= $bas_harfler ?>
                              </div>
                              <div>
                                <strong style="color: #495057;"><?= htmlspecialchars($k->kullanici_ad_soyad) ?></strong>
                                <?php if (!empty($k->kullanici_unvan)): ?>
                                  <br><small style="color: #6c757d;"><?= htmlspecialchars($k->kullanici_unvan) ?></small>
                                <?php endif; ?>
                              </div>
                            </div>
                          </td>
                          <td style="padding: 15px 12px; color: #6c757d;"><?= htmlspecialchars($k->departman_adi ?? '-') ?></td>
                          <td style="padding: 15px 12px; color: #6c757d;"><?= date("d.m.Y", strtotime($k->kullanici_dogum_tarihi)) ?></td>
                          <td style="padding: 15px 12px;">
                            <span class="badge" style="padding: 6px 12px; font-size: 13px; background-color: #001657; color: #ffffff; border-radius: 6px; font-weight: 500;"><?= $yas ?> Yaş</span>
                          </td>
                          <td style="padding: 15px 12px;">
                            <?php if ($durum == 'gecmiş'): ?>
                              <span class="badge" style="padding: 6px 12px; font-size: 13px; background-color: #6c757d; color: #ffffff; border-radius: 6px; font-weight: 500;">Bu Ay Geçti</span>
                            <?php elseif ($durum == 'bugun'): ?>
                              <span class="badge" style="padding: 6px 12px; font-size: 13px; background-color: #dc3545; color: #ffffff; border-radius: 6px; font-weight: 500;">Bugün</span>
                            <?php else: ?>
                              <span class="badge" style="padding: 6px 12px; font-size: 13px; background-color: <?= $kalan_gun <= 7 ? '#ffc107' : '#001657' ?>; color: #ffffff; border-radius: 6px; font-weight: 500;"><?= $kalan_gun ?> Gün Kaldı</span>
                            <?php endif; ?>
                          </td>
                          <td style="padding: 15px 12px; color: #6c757d;">
                            <i class="fas fa-phone mr-1" style="color: #001657;"></i>
                            <?= htmlspecialchars($k->kullanici_bireysel_iletisim_no ?? '-') ?>
                          </td>
                          <td style="padding: 15px 12px; text-align: center;">
                            <button class="btn btn-sm shadow-sm" style="border-radius: 6px; background-color: #001657; color: #ffffff; border: none; font-weight: 500; cursor: not-allowed; opacity: 0.6; padding: 6px 12px;" disabled>
                              <i class="fas fa-sms mr-1"></i> SMS Gönder
                            </button>
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
  const switchElement = document.getElementById('otomatikSmsSwitch');
  const labelText = document.getElementById('switch-label-text');
  
  if (switchElement) {
    switchElement.addEventListener('change', function() {
      const durum = this.checked ? 1 : 0;
      
      // Switch'i geçici olarak devre dışı bırak
      this.disabled = true;
      
      $.ajax({
        url: '<?= base_url("dogum_gunu/otomatik_sms_durum_guncelle") ?>',
        type: 'POST',
        data: { durum: durum },
        dataType: 'json',
        success: function(response) {
          if (response.success) {
            // Label'ı güncelle
            labelText.textContent = durum == 1 ? 'Otomatik Mesaj Gönderimi Açık' : 'Otomatik Mesaj Gönderimi Kapalı';
            
            // Başarı mesajı göster
            const alertClass = durum == 1 ? 'alert-success' : 'alert-info';
            const alertHtml = `
              <div class="alert ${alertClass} alert-dismissible fade show" style="position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px; border-left: 4px solid ${durum == 1 ? '#28a745' : '#17a2b8'};">
                <i class="fas fa-${durum == 1 ? 'check-circle' : 'info-circle'} mr-2"></i>
                ${response.message}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            `;
            $('body').append(alertHtml);
            
            // 3 saniye sonra alert'i kaldır
            setTimeout(function() {
              $('.alert').fadeOut('slow', function() {
                $(this).remove();
              });
            }, 3000);
          } else {
            // Hata durumunda switch'i geri al
            switchElement.checked = !switchElement.checked;
            alert('Bir hata oluştu: ' + (response.message || 'Bilinmeyen hata'));
          }
        },
        error: function() {
          // Hata durumunda switch'i geri al
          switchElement.checked = !switchElement.checked;
          alert('Bir hata oluştu. Lütfen tekrar deneyin.');
        },
        complete: function() {
          // Switch'i tekrar aktif et
          switchElement.disabled = false;
        }
      });
    });
  }
});
</script>

<style>
.custom-switch .custom-control-label::before {
  background-color: #adb5bd;
  border-color: #adb5bd;
}

.custom-switch .custom-control-input:checked ~ .custom-control-label::before {
  background-color: #001657;
  border-color: #001657;
}

.custom-switch .custom-control-input:focus ~ .custom-control-label::before {
  box-shadow: 0 0 0 0.2rem rgba(0, 22, 87, 0.25);
}

.custom-switch .custom-control-label {
  color: #ffffff !important;
  font-size: 14px;
}
</style>

