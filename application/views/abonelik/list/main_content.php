<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top: 25px; background-color: #f8f9fa;">
  <section class="content pr-0">
    <div class="row">
      <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
          <!-- Card Header -->
          <div class="card-header border-0" style="background: linear-gradient(135deg, #001657 0%, #00ccff 100%); padding: 18px 25px;">
            <div class="d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3" style="width: 40px; height: 40px; background-color: rgba(255,255,255,0.2);">
                  <i class="fas fa-clipboard-list" style="color: #ffffff; font-size: 18px;"></i>
                </div>
                <div>
                  <h3 class="mb-0" style="color: #ffffff; font-weight: 700; font-size: 20px; letter-spacing: 0.5px; line-height: 1.2;">
                    Abonelikler
                  </h3>
                  <small style="color: rgba(255,255,255,0.9); font-size: 13px; line-height: 1.4;">Aktif abonelik listesi ve takibi</small>
                </div>
              </div>
              <a href="<?php echo site_url('abonelik/ekle'); ?>" class="btn btn-light btn-sm shadow-sm" style="border-radius: 8px; font-weight: 600;">
                <i class="fas fa-plus"></i> Yeni Abonelik
              </a>
            </div>
          </div>
          
          <!-- Card Body -->
          <div class="card-body" style="padding: 25px; background-color: #ffffff;">
            <?php if (!empty($abonelikler)): 
              // Kalan gün sırasına göre sıralama (en az kalan günden en çok kalan güne)
              usort($abonelikler, function($a, $b) {
                $kalan_gun_a = gunSayisiHesapla(date("Y-m-d"), date("Y-m-d", strtotime($a->abonelik_bitis_tarihi)));
                $kalan_gun_b = gunSayisiHesapla(date("Y-m-d"), date("Y-m-d", strtotime($b->abonelik_bitis_tarihi)));
                return $kalan_gun_a <=> $kalan_gun_b;
              });
            ?>
              <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0" style="border-radius: 8px; overflow: hidden;">
                  <thead class="text-white text-center" style="background: linear-gradient(135deg, #001657 0%, #00ccff 100%);">
                    <tr>
                      <th style="font-weight: 600; padding: 15px 10px;">Ürün / Hizmet</th>
                      <th style="font-weight: 600; padding: 15px 10px;">Açıklama</th>
                      <th style="font-weight: 600; padding: 15px 10px;">Başlangıç Tarihi</th>
                      <th style="font-weight: 600; padding: 15px 10px;">Bitiş Tarihi</th>
                      <th style="font-weight: 600; padding: 15px 10px;">
                        <i class="fas fa-sort-amount-down"></i> Kalan Gün
                      </th>
                      <th style="font-weight: 600; padding: 15px 10px;">Durum</th>
                      <th style="font-weight: 600; padding: 15px 10px; width: 120px;">İşlem</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($abonelikler as $abonelik): 
                      $kalangun = gunSayisiHesapla(date("Y-m-d"), date("Y-m-d", strtotime($abonelik->abonelik_bitis_tarihi)));

                      if ($kalangun <= 0) {
                        $row_class = 'expired';
                        $status = '<span class="badge" style="font-size: 13px; padding: 8px 14px; background-color: #dc3545; color: #ffffff; border-radius: 6px; font-weight: 500;">Süresi Doldu</span>';
                      } elseif ($kalangun <= 30) {
                        $row_class = 'warning';
                        $status = '<span class="badge dolmak_uzere_alert" style="font-size: 13px; padding: 8px 14px; background-color: #ffc107; color: #856404; border-radius: 6px; font-weight: 500;">Süresi Dolmak Üzere</span>';
                      } else {
                        $row_class = 'active';
                        $status = '<span class="badge" style="font-size: 13px; padding: 8px 14px; background-color: #28a745; color: #ffffff; border-radius: 6px; font-weight: 500;">Aktif</span>';
                      }
                    ?>
                    <tr class="abonelik-row <?php echo $row_class; ?>" style="cursor: pointer; transition: all 0.2s ease;">
                      <td style="padding: 15px 10px; vertical-align: middle;">
                        <strong style="color: #495057; font-size: 15px;"><?php echo htmlspecialchars($abonelik->abonelik_baslik); ?></strong>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle; color: #6c757d; font-size: 14px;">
                        <?php echo htmlspecialchars($abonelik->abonelik_aciklama); ?>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle; text-align: center; color: #495057; font-size: 14px;">
                        <?php echo date("d.m.Y", strtotime($abonelik->abonelik_baslangic_tarihi)); ?>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle; text-align: center; color: #495057; font-size: 14px;">
                        <?php echo date("d.m.Y", strtotime($abonelik->abonelik_bitis_tarihi)); ?>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle; text-align: center;">
                        <?php  
                          if ($kalangun > 0) {
                            echo "<span class='fw-bold' style='color: #28a745; font-size: 14px;'>$kalangun Gün Kaldı</span>";
                          } else {
                            echo "<span class='fw-bold' style='color: #dc3545; font-size: 14px;'>" . abs($kalangun) . " Gün Geçti</span>";
                          }
                        ?>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle; text-align: center;">
                        <?php echo $status; ?>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle; text-align: center;">
                        <a href="<?php echo site_url('abonelik/duzenle/'.$abonelik->abonelik_id); ?>" 
                           class="btn btn-sm shadow-sm" 
                           style="border-radius: 6px; font-weight: 500; padding: 6px 12px; <?php echo $kalangun > 0 ? 'background-color: #ffc107; color: #856404; border: none;' : 'background-color: #dc3545; color: #ffffff; border: none;'; ?>"
                           onclick="event.stopPropagation();">
                          <i class="fas fa-edit"></i> Düzenle
                        </a>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            <?php else: ?>
              <div class="text-center py-5">
                <div class="mb-3">
                  <i class="fas fa-clipboard-list" style="color: #adb5bd; font-size: 48px;"></i>
                </div>
                <p class="text-muted mb-0" style="font-size: 16px; font-weight: 500;">Henüz abonelik kaydı bulunmamaktadır.</p>
                <a href="<?php echo site_url('abonelik/ekle'); ?>" class="btn btn-primary mt-3" style="border-radius: 8px;">
                  <i class="fas fa-plus"></i> İlk Aboneliği Ekle
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
  .abonelik-row {
    transition: all 0.2s ease;
  }

  .abonelik-row:hover {
    background-color: #f8f9fa !important;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  }

  /* Duruma göre arka plan renkleri */
  .abonelik-row.active {
    background-color: #f9fffb;
  }
  
  .abonelik-row.warning {
    background-color: #fff7e6;
  }
  
  .abonelik-row.expired {
    background-color: #ffeaea;
  }

  /* Tablo hover efekti */
  .table tbody tr {
    border-left: 3px solid transparent;
  }

  .table tbody tr:hover {
    border-left-color: #0066ff;
  }

  /* Blink animasyonu - Süresi dolmak üzere uyarısı */
  .dolmak_uzere_alert {
    animation: blink 1.5s infinite;
  }

  @keyframes blink {
    0%, 50%, 100% {
      opacity: 1;
    }
    25%, 75% {
      opacity: 0.6;
    }
  }

  /* Buton hover efektleri */
  .btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15) !important;
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
  }
</style>

<script>
  // Satır tıklama ile düzenleme sayfasına yönlendirme
  document.addEventListener('DOMContentLoaded', function() {
    const rows = document.querySelectorAll('.abonelik-row');
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
