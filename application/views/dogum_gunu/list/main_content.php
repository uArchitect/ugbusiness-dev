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

<!-- Test SMS Gönderme Modal -->
<div class="modal fade" id="testSmsModal" tabindex="-1" role="dialog" aria-labelledby="testSmsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="border-radius: 12px;">
      <div class="modal-header" style="background: linear-gradient(135deg, #001657 0%, #001657 100%); color: white; border-radius: 12px 12px 0 0;">
        <h5 class="modal-title" id="testSmsModalLabel" style="font-weight: 700;">
          <i class="fas fa-sms mr-2"></i> Test SMS Gönderimi
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white; opacity: 0.8;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="padding: 25px;">
        <div class="alert alert-info" style="border-left: 4px solid #001657; border-radius: 6px;">
          <div class="d-flex align-items-start">
            <i class="fas fa-info-circle mr-2 mt-1" style="color: #001657;"></i>
            <div>
              <strong>Test SMS Bilgileri:</strong>
              <ul class="mb-0 mt-2" style="padding-left: 20px;">
                <li>Telefon: <strong>5078928490</strong></li>
                <li>Şablon ID: <strong>1</strong> (Doğum Günü Mesajı)</li>
                <li>Gönderim Zamanı: <strong id="gonderim-zamani">4 dakika sonra</strong></li>
              </ul>
            </div>
          </div>
        </div>
        
        <div id="countdown-container" style="text-align: center; padding: 20px;">
          <h3 style="color: #001657; margin-bottom: 15px;">Gönderim Sayacı</h3>
          <div id="countdown" style="font-size: 48px; font-weight: 700; color: #001657; margin-bottom: 10px;">04:00</div>
          <p class="text-muted mb-0">SMS <span id="gonderim-bilgisi">4 dakika sonra</span> gönderilecek</p>
        </div>
        
        <div id="sms-preview" style="display: none; margin-top: 20px;">
          <h6 style="color: #495057; margin-bottom: 10px;"><strong>SMS Önizleme:</strong></h6>
          <div class="alert alert-light" style="border: 1px solid #dee2e6; border-radius: 6px; padding: 15px;">
            <pre id="sms-mesaji-preview" style="margin: 0; white-space: pre-wrap; font-family: inherit; font-size: 14px;"></pre>
          </div>
        </div>
        
        <div id="sms-result" style="display: none; margin-top: 20px;"></div>
      </div>
      <div class="modal-footer" style="border-top: 1px solid #dee2e6; padding: 15px 25px;">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 8px; font-weight: 500;">
          <i class="fas fa-times mr-2"></i> Kapat
        </button>
        <button type="button" id="basla-test-sms" class="btn btn-primary" style="border-radius: 8px; font-weight: 500; background: linear-gradient(135deg, #001657 0%, #001657 100%); border: none;">
          <i class="fas fa-play mr-2"></i> Test SMS'i Başlat
        </button>
      </div>
    </div>
  </div>
</div>

<script>
let countdownInterval = null;
let remainingSeconds = 240; // 4 dakika = 240 saniye

function formatTime(seconds) {
  const mins = Math.floor(seconds / 60);
  const secs = seconds % 60;
  return String(mins).padStart(2, '0') + ':' + String(secs).padStart(2, '0');
}

function updateCountdown() {
  const countdownEl = document.getElementById('countdown');
  const bilgiEl = document.getElementById('gonderim-bilgisi');
  
  if (remainingSeconds > 0) {
    countdownEl.textContent = formatTime(remainingSeconds);
    const mins = Math.floor(remainingSeconds / 60);
    const secs = remainingSeconds % 60;
    bilgiEl.textContent = mins + ' dakika ' + secs + ' saniye sonra';
    remainingSeconds--;
  } else {
    clearInterval(countdownInterval);
    countdownEl.textContent = '00:00';
    bilgiEl.textContent = 'Gönderiliyor...';
    sendTestSMS();
  }
}

function sendTestSMS() {
  $.ajax({
    url: '<?= base_url("dogum_gunu/test_sms_gonder") ?>',
    type: 'POST',
    dataType: 'json',
    success: function(response) {
      const resultDiv = document.getElementById('sms-result');
      resultDiv.style.display = 'block';
      
      if (response.success) {
        resultDiv.innerHTML = `
          <div class="alert alert-success" style="border-left: 4px solid #28a745; border-radius: 6px;">
            <h6><i class="fas fa-check-circle mr-2"></i> SMS Başarıyla Gönderildi!</h6>
            <hr>
            <p class="mb-1"><strong>Gönderim Zamanı:</strong> ${response.gonderim_zamani}</p>
            <p class="mb-1"><strong>Telefon:</strong> ${response.telefon}</p>
            <p class="mb-0"><strong>Şablon ID:</strong> ${response.template_id}</p>
          </div>
          <div class="alert alert-light mt-3" style="border: 1px solid #dee2e6;">
            <strong>Gönderilen Mesaj:</strong><br>
            <pre style="margin: 10px 0 0 0; white-space: pre-wrap; font-family: inherit;">${response.sms_mesaji}</pre>
          </div>
        `;
      } else {
        resultDiv.innerHTML = `
          <div class="alert alert-danger" style="border-left: 4px solid #dc3545; border-radius: 6px;">
            <h6><i class="fas fa-exclamation-circle mr-2"></i> Hata!</h6>
            <p class="mb-0">${response.message}</p>
          </div>
        `;
      }
    },
    error: function() {
      const resultDiv = document.getElementById('sms-result');
      resultDiv.style.display = 'block';
      resultDiv.innerHTML = `
        <div class="alert alert-danger" style="border-left: 4px solid #dc3545; border-radius: 6px;">
          <h6><i class="fas fa-exclamation-circle mr-2"></i> Hata!</h6>
          <p class="mb-0">SMS gönderilirken bir hata oluştu.</p>
        </div>
      `;
    }
  });
}

// Test SMS butonu
document.addEventListener('DOMContentLoaded', function() {
  // Test SMS butonunu ekle (header'a)
  const headerDiv = document.querySelector('.card-header .d-flex.justify-content-between');
  if (headerDiv) {
    const testBtn = document.createElement('button');
    testBtn.className = 'btn btn-warning btn-sm shadow-sm';
    testBtn.style.cssText = 'border-radius: 8px; font-weight: 600;';
    testBtn.innerHTML = '<i class="fas fa-flask"></i> Test SMS';
    testBtn.setAttribute('data-toggle', 'modal');
    testBtn.setAttribute('data-target', '#testSmsModal');
    headerDiv.appendChild(testBtn);
  }
  
  // Test SMS başlat butonu
  document.getElementById('basla-test-sms')?.addEventListener('click', function() {
    this.disabled = true;
    this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Başlatıldı...';
    
    // Şablon önizlemesini göster
    $.ajax({
      url: '<?= base_url("dogum_gunu/test_sms_onizleme") ?>',
      type: 'POST',
      dataType: 'json',
      success: function(response) {
        if (response.success) {
          document.getElementById('sms-preview').style.display = 'block';
          document.getElementById('sms-mesaji-preview').textContent = response.sms_mesaji;
        }
      }
    });
    
    // Countdown başlat
    remainingSeconds = 240;
    countdownInterval = setInterval(updateCountdown, 1000);
    updateCountdown();
  });
  
  // Modal kapandığında countdown'ı durdur
  $('#testSmsModal').on('hidden.bs.modal', function () {
    if (countdownInterval) {
      clearInterval(countdownInterval);
      countdownInterval = null;
    }
    remainingSeconds = 240;
    document.getElementById('countdown').textContent = '04:00';
    document.getElementById('gonderim-bilgisi').textContent = '4 dakika sonra';
    document.getElementById('basla-test-sms').disabled = false;
    document.getElementById('basla-test-sms').innerHTML = '<i class="fas fa-play mr-2"></i> Test SMS\'i Başlat';
    document.getElementById('sms-result').style.display = 'none';
    document.getElementById('sms-preview').style.display = 'none';
  });
});
</script>

