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
                  <i class="fas fa-file-invoice-dollar" style="color: #ffffff; font-size: 18px;"></i>
                </div>
                <div>
                  <h3 class="mb-0" style="color: #ffffff; font-weight: 700; font-size: 20px; letter-spacing: 0.5px; line-height: 1.2;">
                    Teklif Form Yönetimi
                  </h3>
                  <small style="color: rgba(255,255,255,0.9); font-size: 13px; line-height: 1.4;">Teklif formları ve takibi</small>
                </div>
              </div>
              <a href="<?=base_url("teklif_form/add")?>" class="btn btn-light btn-sm shadow-sm" style="border-radius: 8px; font-weight: 600;">
                <i class="fas fa-plus"></i> Yeni Teklif Formu
              </a>
            </div>
          </div>
          
          <!-- Card Body -->
          <div class="card-body" style="padding: 25px; background-color: #ffffff;">
            <?php if (!empty($teklif_formlari)): ?>
              <div class="table-responsive">
                <table id="teklifFormTable" class="table table-bordered table-hover align-middle mb-0" style="border-radius: 8px; overflow: hidden;">
                  <thead class="text-white text-center" style="background: linear-gradient(135deg, #001657 0%, #001657 100%);">
                    <tr>
                      <th style="font-weight: 600; padding: 15px 10px;">Müşteri Bilgisi</th>
                      <th style="font-weight: 600; padding: 15px 10px;">Teklif Tarihi</th>
                      <th style="font-weight: 600; padding: 15px 10px;">Kayıt Oluşturma Tarihi</th>
                      <th style="font-weight: 600; padding: 15px 10px;">Oluşturan Kullanıcı</th>
                      <th style="font-weight: 600; padding: 15px 10px; width: 200px;">İşlemler</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($teklif_formlari as $teklif_form): 
                      // Durum belirleme
                      $row_class = 'active';
                      $has_error = ($teklif_form->teklif_form_adetler == '[""]');
                      if($has_error) {
                        $row_class = 'warning';
                      }
                    ?>
                    <tr class="teklif-row <?php echo $row_class; ?>" style="cursor: pointer; transition: all 0.2s ease;">
                      <td style="padding: 15px 10px; vertical-align: middle;">
                        <div style="display: flex; align-items: center; gap: 8px;">
                          <i class="fas fa-user-tie" style="color: #6c757d; font-size: 14px;"></i>
                          <strong style="color: #495057; font-size: 14px;"><?=$teklif_form->teklif_form_musteri_ad?></strong>
                        </div>
                        <?php if($has_error): ?>
                        <div style="margin-top: 5px;">
                          <span class="badge" style="font-size: 11px; padding: 4px 8px; background-color: #dc3545; color: #ffffff; border-radius: 4px; font-weight: 500;">
                            <i class="fas fa-exclamation-triangle"></i> Ürün bilgileri eksik veya hatalı
                          </span>
                        </div>
                        <?php endif; ?>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle; text-align: center;">
                        <div style="display: flex; align-items: center; justify-content: center; gap: 6px;">
                          <i class="far fa-calendar-alt" style="color: #6c757d; font-size: 14px;"></i>
                          <span style="color: #495057; font-size: 14px;"><?=date("d.m.Y",strtotime($teklif_form->teklif_form_tarihi))?></span>
                        </div>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle; text-align: center;">
                        <div style="display: flex; align-items: center; justify-content: center; gap: 6px;">
                          <i class="far fa-clock" style="color: #6c757d; font-size: 14px;"></i>
                          <span style="color: #495057; font-size: 14px;"><?=date("d.m.Y H:i",strtotime($teklif_form->teklif_form_kayit_tarihi))?></span>
                        </div>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle; text-align: center;">
                        <div style="display: flex; align-items: center; justify-content: center; gap: 6px;">
                          <i class="fas fa-user" style="color: #6c757d; font-size: 14px;"></i>
                          <span style="color: #495057; font-size: 14px;"><?=$teklif_form->kullanici_ad_soyad?></span>
                        </div>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle; text-align: center;">
                        <div style="display: flex; gap: 8px; justify-content: center; flex-wrap: wrap;">
                          <a href="<?=base_url("teklif_form/edit/".$teklif_form->teklif_form_id)?>" 
                             class="btn btn-sm shadow-sm" 
                             style="border-radius: 6px; font-weight: 500; padding: 6px 12px; background-color: #ffc107; color: #856404; border: none;"
                             onclick="event.stopPropagation();">
                            <i class="fas fa-edit"></i> Düzenle
                          </a>
                          <a href="<?=base_url("teklif_form/yazdir/".$teklif_form->teklif_form_id)?>" 
                             class="btn btn-sm shadow-sm" 
                             style="border-radius: 6px; font-weight: 500; padding: 6px 12px; background-color: #007bff; color: #ffffff; border: none;"
                             onclick="event.stopPropagation();">
                            <i class="fas fa-file-pdf"></i> PDF
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
                  <i class="fas fa-file-invoice-dollar" style="color: #adb5bd; font-size: 48px;"></i>
                </div>
                <p class="text-muted mb-0" style="font-size: 16px; font-weight: 500;">Henüz teklif formu kaydı bulunmamaktadır.</p>
                <a href="<?=base_url("teklif_form/add")?>" class="btn btn-primary mt-3" style="border-radius: 8px;">
                  <i class="fas fa-plus"></i> İlk Teklif Formunu Oluştur
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
  .teklif-row {
    transition: all 0.2s ease;
  }

  .teklif-row:hover {
    background-color: #f8f9fa !important;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  }

  /* Duruma göre arka plan renkleri */
  .teklif-row.active {
    background-color: #f9fffb;
  }
  
  .teklif-row.warning {
    background-color: #fff7e6;
  }

  /* Tablo hover efekti */
  .table tbody tr {
    border-left: 3px solid transparent;
  }

  .table tbody tr:hover {
    border-left-color: #0066ff;
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

    .btn {
      font-size: 12px;
      padding: 4px 8px !important;
    }
  }
</style>

<script>
  // jQuery yüklendiğinden emin ol
  (function() {
    function initDataTable() {
      // jQuery ve DataTable yüklü mü kontrol et
      if (typeof jQuery !== 'undefined' && typeof jQuery.fn.DataTable !== 'undefined') {
        // DataTable initialization
        var table = $('#teklifFormTable').DataTable({
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
          "order": [[2, "desc"]], // Kayıt tarihine göre ters sıralama (varsayılan)
          "columnDefs": [
            {
              "orderable": false,
              "targets": [4] // İşlemler sütunu sıralanamaz
            }
          ]
        });

        // Satır tıklama ile düzenleme sayfasına yönlendirme
        $('#teklifFormTable tbody').on('click', 'tr.teklif-row', function(e) {
          // Buton tıklamalarını hariç tut
          if ($(e.target).closest('a, button').length) {
            return;
          }
          const editLink = $(this).find('a[href*="edit"]');
          if (editLink.length) {
            window.location.href = editLink.attr('href');
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
