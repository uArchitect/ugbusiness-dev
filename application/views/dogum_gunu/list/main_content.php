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
              <div class="d-flex align-items-center justify-content-end justify-content-md-end ml-auto">
                <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input" id="otomatikSmsSwitch" <?= $otomatik_sms_aktif == 1 ? 'checked' : '' ?>>
                  <label class="custom-control-label" for="otomatikSmsSwitch" style="font-weight: 600; cursor: pointer; color: #ffffff !important;">
                    <span id="switch-label-text" class="switch-text-full" style="color: #ffffff !important;"><?= $otomatik_sms_aktif == 1 ? 'Otomatik Mesaj Gönderimi Açık' : 'Otomatik Mesaj Gönderimi Kapalı' ?></span>
                    <span id="switch-label-text-short" class="switch-text-short" style="color: #ffffff !important; display: none;"><?= $otomatik_sms_aktif == 1 ? 'Açık' : 'Kapalı' ?></span>
                  </label>
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
                              <?php 
                                $simdi_saat = (int)date('H');
                                $simdi_dakika = (int)date('i');
                                $gonderim_saati = 9; // Cron job çalışma saati
                                
                                if ($simdi_saat < $gonderim_saati) {
                                  // Henüz 9'a gelmedi, bugün gönderilecek
                                  $zaman_bilgisi = "Bugün " . $gonderim_saati . ":00'da gönderilecek";
                                  $zaman_bilgisi_kisa = "Bugün " . $gonderim_saati . ":00";
                                  $badge_color = "#ffc107"; // Sarı - yakında gönderilecek
                                } else {
                                  // Saat 9'u geçti, cron çalışmamış
                                  $zaman_bilgisi = "Beklemede - " . $gonderim_saati . ":00'dan sonra gönderilecek";
                                  $zaman_bilgisi_kisa = "Beklemede";
                                  $badge_color = "#dc3545"; // Kırmızı - geç kaldı
                                }
                              ?>
                              <span class="badge" style="padding: 5px 10px; font-size: 12px; background-color: <?= $badge_color ?>; color: #ffffff; border-radius: 6px; font-weight: 500;" title="<?= $zaman_bilgisi ?>">
                                <i class="fas fa-clock mr-1"></i> <span class="d-none d-md-inline"><?= $zaman_bilgisi ?></span><span class="d-md-none"><?= $zaman_bilgisi_kisa ?></span>
                              </span>
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
                                <?php 
                                  $simdi_saat = (int)date('H');
                                  $simdi_dakika = (int)date('i');
                                  $gonderim_saati = 9; // Cron job çalışma saati
                                  
                                  if ($simdi_saat < $gonderim_saati) {
                                    // Henüz 9'a gelmedi, bugün gönderilecek
                                    $zaman_bilgisi = "Bugün " . $gonderim_saati . ":00'da gönderilecek";
                                    $zaman_bilgisi_kisa = "Bugün " . $gonderim_saati . ":00";
                                    $badge_color = "#ffc107"; // Sarı - yakında gönderilecek
                                  } else {
                                    // Saat 9'u geçti, cron çalışmamış
                                    $zaman_bilgisi = "Beklemede - " . $gonderim_saati . ":00'dan sonra gönderilecek";
                                    $zaman_bilgisi_kisa = "Beklemede";
                                    $badge_color = "#dc3545"; // Kırmızı - geç kaldı
                                  }
                                ?>
                                <span class="badge" style="padding: 5px 10px; font-size: 12px; background-color: <?= $badge_color ?>; color: #ffffff; border-radius: 6px; font-weight: 500;" title="<?= $zaman_bilgisi ?>">
                                  <i class="fas fa-clock mr-1"></i> <span class="d-none d-md-inline"><?= $zaman_bilgisi ?></span><span class="d-md-none"><?= $zaman_bilgisi_kisa ?></span>
                                </span>
                              <?php endif; ?>
                            <?php elseif ($durum == 'gelecek'): ?>
                              <?php 
                                $gonderim_saati = 9; // Cron job çalışma saati
                                $zaman_bilgisi = $kalan_gun . " gün sonra " . $gonderim_saati . ":00'da gönderilecek";
                                $zaman_bilgisi_kisa = $kalan_gun . " gün sonra";
                              ?>
                              <span class="badge" style="padding: 5px 10px; font-size: 12px; background-color: #6c757d; color: #ffffff; border-radius: 6px; font-weight: 500; opacity: 0.7;" title="<?= $zaman_bilgisi ?>">
                                <i class="fas fa-calendar-alt mr-1"></i> <span class="d-none d-lg-inline"><?= $zaman_bilgisi ?></span><span class="d-lg-none"><?= $zaman_bilgisi_kisa ?></span>
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
  const switchElement = document.getElementById('otomatikSmsSwitch');
  const labelText = document.getElementById('switch-label-text');
  
  // Sayfa yüklendiğinde switch durumuna göre yazıyı güncelle
  if (switchElement && labelText) {
    const initialDurum = switchElement.checked ? 1 : 0;
    const fullText = initialDurum == 1 ? 'Otomatik Mesaj Gönderimi Açık' : 'Otomatik Mesaj Gönderimi Kapalı';
    const shortText = initialDurum == 1 ? 'Açık' : 'Kapalı';
    
    const fullTextEl = document.querySelector('.switch-text-full');
    const shortTextEl = document.querySelector('.switch-text-short');
    
    if (fullTextEl) fullTextEl.textContent = fullText;
    if (shortTextEl) shortTextEl.textContent = shortText;
    
    // Responsive kontrol
    updateSwitchText();
  }
  
  // Responsive switch text güncelleme
  function updateSwitchText() {
    const fullTextEl = document.querySelector('.switch-text-full');
    const shortTextEl = document.querySelector('.switch-text-short');
    if (!fullTextEl || !shortTextEl) return;
    
    if (window.innerWidth >= 768) {
      fullTextEl.style.display = 'inline';
      shortTextEl.style.display = 'none';
    } else {
      fullTextEl.style.display = 'none';
      shortTextEl.style.display = 'inline';
    }
  }
  
  window.addEventListener('resize', updateSwitchText);
  
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
            const fullText = durum == 1 ? 'Otomatik Mesaj Gönderimi Açık' : 'Otomatik Mesaj Gönderimi Kapalı';
            const shortText = durum == 1 ? 'Açık' : 'Kapalı';
            
            const fullTextEl = document.querySelector('.switch-text-full');
            const shortTextEl = document.querySelector('.switch-text-short');
            
            if (fullTextEl) fullTextEl.textContent = fullText;
            if (shortTextEl) shortTextEl.textContent = shortText;
            
            updateSwitchText();
            
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
/* Switch kapalı durumda - Kırmızı */
.custom-switch .custom-control-label::before {
  background-color: #dc3545;
  border-color: #dc3545;
}

/* Switch açık durumda - Yeşil */
.custom-switch .custom-control-input:checked ~ .custom-control-label::before {
  background-color: #28a745;
  border-color: #28a745;
}

/* Switch içindeki beyaz yuvarlak buton */
.custom-switch .custom-control-label::after {
  background-color: #ffffff;
  border-color: #ffffff;
}

/* Focus durumu */
.custom-switch .custom-control-input:focus ~ .custom-control-label::before {
  box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
}

.custom-switch .custom-control-input:not(:checked):focus ~ .custom-control-label::before {
  box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
}

/* Label yazı rengi */
.custom-switch .custom-control-label {
  color: #ffffff !important;
  font-size: 14px;
}

.custom-switch .custom-control-label span {
  color: #ffffff !important;
}

/* Switch text varsayılan - Desktop'ta full, mobilde short */
.switch-text-full {
  display: inline;
}

.switch-text-short {
  display: none;
}

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
  
  /* Switch label mobilde kısa */
  .switch-text-full {
    display: none !important;
  }
  
  .switch-text-short {
    display: inline !important;
  }
}

@media (min-width: 768px) and (max-width: 991.98px) {
  /* Tablet ayarları */
  .table {
    font-size: 13px;
  }
  
  .badge {
    font-size: 12px !important;
  }
  
  .switch-text-full {
    display: inline !important;
  }
  
  .switch-text-short {
    display: none !important;
  }
}

@media (min-width: 992px) {
  /* Desktop - tam metin göster */
  .switch-text-full {
    display: inline !important;
  }
  
  .switch-text-short {
    display: none !important;
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
</style>

