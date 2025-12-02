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
                  <i class="fas fa-list-alt" style="color: #ffffff; font-size: 18px;"></i>
                </div>
                <div>
                  <h3 class="mb-0" style="color: #ffffff; font-weight: 700; font-size: 20px; letter-spacing: 0.5px; line-height: 1.2;">
                    <?=htmlspecialchars($kaynak_adi)?> Talepleri
                  </h3>
                  <small style="color: rgba(255,255,255,0.9); font-size: 13px; line-height: 1.4;">
                    <?php if(isset($baslangic_tarihi) && isset($bitis_tarihi)): ?>
                      <?=date("d.m.Y", strtotime($baslangic_tarihi))?> - <?=date("d.m.Y", strtotime($bitis_tarihi))?> tarihleri arası
                    <?php else: ?>
                      Tüm tarihler
                    <?php endif; ?>
                  </small>
                </div>
              </div>
              <a href="<?=base_url('talep/rapor')?>" class="btn btn-light btn-sm shadow-sm" style="border-radius: 8px; font-weight: 600;">
                <i class="fas fa-arrow-left mr-2"></i> Rapor Sayfasına Dön
              </a>
            </div>
          </div>
          
          <!-- Card Body -->
          <div class="card-body" style="padding: 25px; background-color: #ffffff;">
            <?php if (!empty($talepler)): ?>
              <div class="mb-3">
                <span class="badge badge-primary" style="font-size: 14px; padding: 8px 15px;">
                  Toplam <?=count($talepler)?> Talep
                </span>
              </div>
              
              <div class="table-responsive">
                <table id="talepDetayTable" class="table table-bordered table-hover align-middle mb-0" style="border-radius: 8px; overflow: hidden;">
                  <thead class="text-white text-center" style="background: linear-gradient(135deg, #001657 0%, #001657 100%);">
                    <tr>
                      <th style="font-weight: 600; padding: 15px 10px;">Talep ID</th>
                      <th style="font-weight: 600; padding: 15px 10px;">Müşteri Adı</th>
                      <th style="font-weight: 600; padding: 15px 10px;">Telefon</th>
                      <th style="font-weight: 600; padding: 15px 10px;">Kayıt Tarihi</th>
                      <th style="font-weight: 600; padding: 15px 10px;">Sorumlu</th>
                      <th style="font-weight: 600; padding: 15px 10px; width: 120px;">İşlem</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($talepler as $talep): ?>
                    <tr class="talep-row" style="cursor: pointer; transition: all 0.2s ease;">
                      <td style="padding: 15px 10px; vertical-align: middle; text-align: center;">
                        <strong style="color: #495057; font-size: 14px;">
                          #<?=$talep->talep_id?>
                        </strong>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle;">
                        <div style="color: #495057; font-size: 14px; font-weight: 600;">
                          <i class="far fa-user-circle mr-2" style="color: #001657;"></i>
                          <?php 
                            $musteri_adi = '';
                            if(!empty($talep->talep_musteri_ad_soyad)) {
                              $musteri_adi = $talep->talep_musteri_ad_soyad;
                            } elseif(!empty($talep->talep_isletme_adi)) {
                              $musteri_adi = $talep->talep_isletme_adi;
                            } else {
                              $musteri_adi = 'Müşteri adı belirtilmemiş';
                            }
                            echo htmlspecialchars($musteri_adi);
                          ?>
                        </div>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle;">
                        <div style="color: #495057; font-size: 14px;">
                          <i class="fas fa-phone mr-2" style="color: #001657;"></i>
                          <?=htmlspecialchars($talep->talep_cep_telefon ?? '-')?>
                        </div>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle; text-align: center; color: #495057; font-size: 14px;">
                        <i class="far fa-clock mr-2" style="color: #001657;"></i>
                        <?=date("d.m.Y H:i", strtotime($talep->talep_kayit_tarihi))?>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle; text-align: center; color: #6c757d; font-size: 13px;">
                        <?=htmlspecialchars($talep->sorumlu_kullanici ?? 'Atanmamış')?>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle; text-align: center;">
                        <a href="<?=base_url('talep/edit/'.$talep->talep_id)?>" 
                           class="btn btn-sm btn-primary shadow-sm" 
                           style="border-radius: 6px; font-weight: 500; padding: 6px 12px;"
                           onclick="event.stopPropagation();">
                          <i class="fas fa-eye"></i> Detay
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
                  <i class="fas fa-inbox" style="color: #adb5bd; font-size: 48px;"></i>
                </div>
                <p class="text-muted mb-0" style="font-size: 16px; font-weight: 500;">
                  <?=htmlspecialchars($kaynak_adi)?> kaynağına ait talep bulunmamaktadır.
                </p>
                <a href="<?=base_url('talep/rapor')?>" class="btn btn-primary mt-3" style="border-radius: 8px;">
                  <i class="fas fa-arrow-left mr-2"></i> Rapor Sayfasına Dön
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
  .talep-row {
    transition: all 0.2s ease;
  }

  .talep-row:hover {
    background-color: #f8f9fa !important;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  }

  /* Tablo hover efekti */
  .table tbody tr {
    border-left: 3px solid transparent;
  }

  .table tbody tr:hover {
    border-left-color: #0066ff;
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
(function() {
  function initDataTable() {
    // jQuery ve DataTable yüklü mü kontrol et
    if (typeof jQuery !== 'undefined' && typeof jQuery.fn.DataTable !== 'undefined') {
      // DataTable initialization
      var table = $('#talepDetayTable').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "pageLength": 25,
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Turkish.json"
        },
        "order": [[3, "desc"]], // Kayıt tarihine göre sıralama
        "columnDefs": [
          {
            "orderable": true,
            "targets": [0, 1, 2, 3, 4, 5]
          }
        ]
      });
      
      // Satır tıklama ile detay sayfasına yönlendirme
      $('#talepDetayTable tbody').on('click', 'tr.talep-row', function(e) {
        // Buton tıklamalarını hariç tut
        if ($(e.target).closest('a, button').length) {
          return;
        }
        const detailLink = $(this).find('a[href*="edit"]');
        if (detailLink.length) {
          window.location.href = detailLink.attr('href');
        }
      });
    } else {
      // jQuery henüz yüklenmediyse, biraz bekle ve tekrar dene
      setTimeout(initDataTable, 100);
    }
  }

  // DOM yüklendiğinde başlat
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initDataTable);
  } else {
    // DOM zaten yüklenmişse
    initDataTable();
  }
})();
</script>

