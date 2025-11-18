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
                  <i class="fas fa-building" style="color: #ffffff; font-size: 18px;"></i>
                </div>
                <div>
                  <h3 class="mb-0" style="color: #ffffff; font-weight: 700; font-size: 20px; letter-spacing: 0.5px; line-height: 1.2;">
                    Departmanlar
                  </h3>
                  <small style="color: rgba(255,255,255,0.9); font-size: 13px; line-height: 1.4;">Departman listesi ve yönetimi</small>
                </div>
              </div>
              <a href="<?php echo site_url('departman/ekle'); ?>" class="btn btn-light btn-sm shadow-sm" style="border-radius: 8px; font-weight: 600;">
                <i class="fas fa-plus"></i> Yeni Departman
              </a>
            </div>
          </div>
          
          <!-- Card Body -->
          <div class="card-body" style="padding: 25px; background-color: #ffffff;">
            <?php if (!empty($departmanlar)): ?>
              <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0" style="border-radius: 8px; overflow: hidden;">
                  <thead class="text-white text-center" style="background: linear-gradient(135deg, #001657 0%, #001657 100%);">
                    <tr>
                      <th style="font-weight: 600; padding: 15px 10px; width: 60px;">ID</th>
                      <th style="font-weight: 600; padding: 15px 10px;">Departman Adı</th>
                      <th style="font-weight: 600; padding: 15px 10px;">Açıklama</th>
                      <th style="font-weight: 600; padding: 15px 10px;">Yönetici</th>
                      <th style="font-weight: 600; padding: 15px 10px;">Kayıt Tarihi</th>
                      <th style="font-weight: 600; padding: 15px 10px;">Güncelleme Tarihi</th>
                      <th style="font-weight: 600; padding: 15px 10px; width: 180px;">İşlem</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $count = 0; foreach ($departmanlar as $departman): $count++; ?>
                    <tr class="departman-row" style="cursor: pointer; transition: all 0.2s ease;">
                      <td style="padding: 15px 10px; vertical-align: middle; text-align: center; color: #6c757d; font-weight: 600;">
                        #<?=$count?>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle;">
                        <div class="d-flex align-items-center">
                          <div class="rounded-circle d-flex align-items-center justify-content-center mr-2" style="width: 36px; height: 36px; background: linear-gradient(135deg, #001657 0%, #001657 100%);">
                            <i class="fas fa-building" style="color: #ffffff; font-size: 14px;"></i>
                          </div>
                          <strong style="color: #495057; font-size: 15px;"><?=htmlspecialchars($departman->departman_adi)?></strong>
                        </div>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle; color: #6c757d; font-size: 14px;">
                        <?php if(!empty($departman->departman_aciklama)): ?>
                          <i class="fas fa-info-circle text-primary mr-1"></i>
                          <?=htmlspecialchars($departman->departman_aciklama)?>
                        <?php else: ?>
                          <span style="opacity: 0.4; font-style: italic;">
                            <i class="fas fa-minus-circle mr-1"></i>Açıklama girilmedi
                          </span>
                        <?php endif; ?>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle;">
                        <?php if(!empty($departman->yonetici_ad_soyad)): ?>
                          <div class="d-flex align-items-center">
                            <div class="rounded-circle d-flex align-items-center justify-content-center mr-2" style="width: 32px; height: 32px; background-color: #e3f2fd;">
                              <i class="fas fa-user-tie" style="color: #1976d2; font-size: 12px;"></i>
                            </div>
                            <div>
                              <div style="color: #495057; font-weight: 500; font-size: 14px;"><?=htmlspecialchars($departman->yonetici_ad_soyad)?></div>
                              <small style="color: #6c757d; font-size: 12px;">Yönetici</small>
                            </div>
                          </div>
                        <?php else: ?>
                          <span class="badge" style="font-size: 12px; padding: 6px 12px; background-color: #f0f0f0; color: #6c757d; border-radius: 6px;">
                            <i class="fas fa-user-slash mr-1"></i>Yönetici Atanmamış
                          </span>
                        <?php endif; ?>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle; text-align: center; color: #495057; font-size: 14px;">
                        <i class="far fa-calendar-plus text-primary mr-1"></i>
                        <?=date('d.m.Y H:i', strtotime($departman->departman_kayit_tarihi))?>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle; text-align: center;">
                        <?php if(!empty($departman->departman_guncelleme_tarihi) && $departman->departman_guncelleme_tarihi > $departman->departman_kayit_tarihi): ?>
                          <div style="color: #28a745; font-size: 14px;">
                            <i class="fa fa-sync text-success mr-1"></i>
                            <?=date('d.m.Y H:i', strtotime($departman->departman_guncelleme_tarihi))?>
                          </div>
                          <small style="color: #6c757d; font-size: 11px;">Güncellendi</small>
                        <?php else: ?>
                          <span style="opacity: 0.4; font-size: 13px; color: #6c757d;">
                            <i class="fa fa-sync mr-1"></i>Güncellenmedi
                          </span>
                        <?php endif; ?>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle; text-align: center;">
                        <div class="btn-group" role="group">
                          <a href="<?=site_url("departman/duzenle/".$departman->departman_id)?>" 
                             class="btn btn-sm shadow-sm" 
                             style="border-radius: 6px 0 0 6px; font-weight: 500; padding: 6px 14px; background-color: #ffc107; color: #856404; border: none;"
                             onclick="event.stopPropagation();">
                            <i class="fas fa-edit"></i> Düzenle
                          </a>
                          <a type="button" 
                             onclick="event.stopPropagation(); confirm_action('Silme İşlemini Onayla','Seçilen bu kaydı silmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Onayla','<?=base_url('departman/sil/').$departman->departman_id?>');" 
                             class="btn btn-sm shadow-sm" 
                             style="border-radius: 0 6px 6px 0; font-weight: 500; padding: 6px 14px; background-color: #dc3545; color: #ffffff; border: none;">
                            <i class="fas fa-trash"></i> Sil
                          </a>
                        </div>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            <?php else: ?>
              <div class="text-center py-5">
                <div class="mb-3">
                  <i class="fas fa-building" style="color: #adb5bd; font-size: 48px;"></i>
                </div>
                <p class="text-muted mb-0" style="font-size: 16px; font-weight: 500;">Henüz departman kaydı bulunmamaktadır.</p>
                <a href="<?php echo site_url('departman/ekle'); ?>" class="btn btn-primary mt-3" style="border-radius: 8px;">
                  <i class="fas fa-plus"></i> İlk Departmanı Ekle
                </a>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<style>
  .departman-row {
    transition: all 0.2s ease;
  }

  .departman-row:hover {
    background-color: #f8f9fa !important;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transform: translateY(-1px);
  }

  /* Tablo hover efekti */
  .table tbody tr {
    border-left: 3px solid transparent;
  }

  .table tbody tr:hover {
    border-left-color: #001657;
  }

  /* Buton hover efektleri */
  .btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15) !important;
  }

  .btn-group .btn:hover {
    z-index: 1;
  }

  /* Responsive düzenlemeler */
  @media (max-width: 768px) {
    .table {
      font-size: 13px;
    }
    
    .table th,
    .table td {
      padding: 10px 5px !important;
    }

    .btn-group {
      display: flex;
      flex-direction: column;
    }

    .btn-group .btn {
      border-radius: 6px !important;
      margin-bottom: 5px;
    }
  }

  /* Badge stilleri */
  .badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
  }
</style>

<script>
  // Satır tıklama ile düzenleme sayfasına yönlendirme
  document.addEventListener('DOMContentLoaded', function() {
    const rows = document.querySelectorAll('.departman-row');
    rows.forEach(row => {
      row.addEventListener('click', function(e) {
        // Buton tıklamalarını hariç tut
        if (e.target.closest('a, button')) {
          return;
        }
        const editLink = row.querySelector('a[href*="duzenle"]');
        if (editLink) {
          window.location.href = editLink.href;
        }
      });
    });
  });
</script>
