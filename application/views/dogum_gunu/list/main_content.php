<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top: 25px; background-color: #f8f9fa;">
  <section class="content pr-0">
    <div class="row">
      <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
          <!-- Card Header -->
          <div class="card-header border-0 pb-0" style="background: linear-gradient(135deg, #0066ff 0%, #00ccff 100%);">
            <div class="d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3" style="width: 40px; height: 40px; background-color: rgba(255,255,255,0.2);">
                  <i class="fas fa-birthday-cake" style="color: #ffffff; font-size: 18px;"></i>
                </div>
                <div>
                  <h3 class="mb-0" style="color: #ffffff; font-weight: 700; font-size: 20px; letter-spacing: 0.5px;">
                    Doğum Günü Bildirimleri
                  </h3>
                  <small style="color: rgba(255,255,255,0.9); font-size: 13px;">Çalışanların doğum günü takibi ve SMS bildirimleri</small>
                </div>
              </div>
              <button class="btn btn-light btn-sm shadow-sm" style="border-radius: 8px; font-weight: 600;">
                <i class="fas fa-cog"></i> Ayarlar
              </button>
            </div>
          </div>
          
          <!-- Card Body -->
          <div class="card-body" style="padding: 25px; background-color: #ffffff;">
            
            <!-- İstatistikler -->
            <div class="row mb-4">
              <div class="col-md-4 col-6 mb-3">
                <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #061f3a 0%, #081f39 100%); border-radius: 10px;">
                  <div class="card-body text-center text-white">
                    <i class="fas fa-birthday-cake" style="font-size: 30px; margin-bottom: 10px;"></i>
                    <h4 class="mb-0" style="font-weight: 700;"><?= $bu_ay_dogum_gunu_sayisi ?></h4>
                    <small style="opacity: 0.9;">Bu Ay Doğum Günü</small>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-6 mb-3">
                <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #0066ff 0%, #00ccff 100%); border-radius: 10px;">
                  <div class="card-body text-center text-white">
                    <i class="fas fa-calendar-day" style="font-size: 30px; margin-bottom: 10px;"></i>
                    <h4 class="mb-0" style="font-weight: 700;"><?= $bugun_dogum_gunu_sayisi ?></h4>
                    <small style="opacity: 0.9;">Bugün Doğum Günü</small>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-6 mb-3">
                <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #081f39 0%, #061f3a 100%); border-radius: 10px;">
                  <div class="card-body text-center text-white">
                    <i class="fas fa-users" style="font-size: 30px; margin-bottom: 10px;"></i>
                    <h4 class="mb-0" style="font-weight: 700;"><?= $toplam_calisan ?></h4>
                    <small style="opacity: 0.9;">Toplam Çalışan</small>
                  </div>
                </div>
              </div>
            </div>

            <!-- Bugün Doğum Günü Olanlar -->
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 10px; border-left: 4px solid #0066ff;">
              <div class="card-header bg-white border-0" style="padding: 15px 20px;">
                <h5 class="mb-0" style="color: #0066ff; font-weight: 700;">
                  <i class="fas fa-calendar-day mr-2"></i> Bugün Doğum Günü Olanlar
                </h5>
              </div>
              <div class="card-body" style="padding: 20px;">
                <div class="table-responsive">
                  <table class="table table-hover align-middle mb-0">
                    <thead class="text-white text-center" style="background: linear-gradient(135deg, #0066ff 0%, #00ccff 100%);">
                      <tr>
                        <th style="font-weight: 600; padding: 12px;">Çalışan Adı</th>
                        <th style="font-weight: 600; padding: 12px;">Departman</th>
                        <th style="font-weight: 600; padding: 12px;">Yaş</th>
                        <th style="font-weight: 600; padding: 12px;">Telefon</th>
                        <th style="font-weight: 600; padding: 12px;">SMS Durumu</th>
                        <th style="font-weight: 600; padding: 12px; width: 120px;">İşlem</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($bugun_dogum_gunu)): ?>
                        <?php foreach ($bugun_dogum_gunu as $k): 
                          $bas_harfler = mb_substr($k->kullanici_ad_soyad, 0, 2, 'UTF-8');
                          $yas = date_diff(date_create($k->kullanici_dogum_tarihi), date_create())->y;
                          $sms_gonderildi = false;
                          foreach ($sms_gecmisi as $sms) {
                            if ($sms->gonderilen_sms_kullanici_id == $k->kullanici_id && date('Y-m-d', strtotime($sms->gonderim_tarihi)) == date('Y-m-d')) {
                              $sms_gonderildi = true;
                              break;
                            }
                          }
                        ?>
                        <tr>
                          <td style="padding: 15px 12px;">
                            <div class="d-flex align-items-center">
                              <div class="rounded-circle text-white d-flex align-items-center justify-content-center mr-3" style="width: 40px; height: 40px; font-weight: 600; background-color: #0066ff;">
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
                            <span class="badge" style="padding: 6px 12px; font-size: 13px; background-color: #0066ff; color: #ffffff; border-radius: 6px;"><?= $yas ?> Yaş</span>
                          </td>
                          <td style="padding: 15px 12px; color: #6c757d;"><?= htmlspecialchars($k->kullanici_bireysel_iletisim_no ?? '-') ?></td>
                          <td style="padding: 15px 12px;">
                            <?php if ($sms_gonderildi): ?>
                              <span class="badge" style="padding: 6px 12px; font-size: 13px; background-color: #28a745; color: #ffffff; border-radius: 6px;">
                                <i class="fas fa-check-circle"></i> Gönderildi
                              </span>
                            <?php else: ?>
                              <span class="badge" style="padding: 6px 12px; font-size: 13px; background-color: #ffc107; color: #856404; border-radius: 6px;">
                                <i class="fas fa-clock"></i> Bekliyor
                              </span>
                            <?php endif; ?>
                          </td>
                          <td style="padding: 15px 12px; text-align: center;">
                            <button class="btn btn-sm shadow-sm" style="border-radius: 6px; background-color: #6c757d; color: #ffffff; border: none; font-weight: 500; cursor: not-allowed; opacity: 0.6;" disabled>
                              <i class="fas fa-sms"></i> SMS Gönder
                            </button>
                          </td>
                        </tr>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <tr><td colspan="6" class="text-center" style="padding: 30px; color: #6c757d;">
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
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 10px; border-left: 4px solid #0066ff;">
              <div class="card-header bg-white border-0" style="padding: 15px 20px;">
                <h5 class="mb-0" style="color: #0066ff; font-weight: 700;">
                  <i class="fas fa-calendar-alt mr-2"></i> Bu Ay Doğum Günü Olanlar
                </h5>
              </div>
              <div class="card-body" style="padding: 20px;">
                <div class="table-responsive">
                  <table class="table table-hover align-middle mb-0">
                    <thead class="text-white text-center" style="background: linear-gradient(135deg, #0066ff 0%, #00ccff 100%);">
                      <tr>
                        <th style="font-weight: 600; padding: 12px;">Çalışan Adı</th>
                        <th style="font-weight: 600; padding: 12px;">Departman</th>
                        <th style="font-weight: 600; padding: 12px;">Doğum Tarihi</th>
                        <th style="font-weight: 600; padding: 12px;">Yaş</th>
                        <th style="font-weight: 600; padding: 12px;">Kalan Gün</th>
                        <th style="font-weight: 600; padding: 12px;">Telefon</th>
                        <th style="font-weight: 600; padding: 12px; width: 120px;">İşlem</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($bu_ay_dogum_gunu)): ?>
                        <?php foreach ($bu_ay_dogum_gunu as $k): 
                          $bas_harfler = mb_substr($k->kullanici_ad_soyad, 0, 2, 'UTF-8');
                          $yas = date_diff(date_create($k->kullanici_dogum_tarihi), date_create())->y;
                          $dogum_gunu = date('Y') . '-' . date('m-d', strtotime($k->kullanici_dogum_tarihi));
                          if ($dogum_gunu < date('Y-m-d')) $dogum_gunu = (date('Y') + 1) . '-' . date('m-d', strtotime($k->kullanici_dogum_tarihi));
                          $kalan_gun = (strtotime($dogum_gunu) - strtotime(date('Y-m-d'))) / 86400;
                        ?>
                        <tr>
                          <td style="padding: 15px 12px;">
                            <div class="d-flex align-items-center">
                              <div class="rounded-circle text-white d-flex align-items-center justify-content-center mr-3" style="width: 40px; height: 40px; font-weight: 600; background-color: #0066ff;">
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
                            <span class="badge" style="padding: 6px 12px; font-size: 13px; background-color: #0066ff; color: #ffffff; border-radius: 6px;"><?= $yas ?> Yaş</span>
                          </td>
                          <td style="padding: 15px 12px;">
                            <?php if ($kalan_gun == 0): ?>
                              <span class="badge" style="padding: 6px 12px; font-size: 13px; background-color: #dc3545; color: #ffffff; border-radius: 6px;">Bugün</span>
                            <?php else: ?>
                              <span class="badge" style="padding: 6px 12px; font-size: 13px; background-color: <?= $kalan_gun <= 7 ? '#ffc107' : '#0066ff' ?>; color: #ffffff; border-radius: 6px;"><?= $kalan_gun ?> Gün Kaldı</span>
                            <?php endif; ?>
                          </td>
                          <td style="padding: 15px 12px; color: #6c757d;"><?= htmlspecialchars($k->kullanici_bireysel_iletisim_no ?? '-') ?></td>
                          <td style="padding: 15px 12px; text-align: center;">
                            <button class="btn btn-sm shadow-sm" style="border-radius: 6px; background-color: #6c757d; color: #ffffff; border: none; font-weight: 500; cursor: not-allowed; opacity: 0.6;" disabled>
                              <i class="fas fa-sms"></i> SMS Gönder
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

