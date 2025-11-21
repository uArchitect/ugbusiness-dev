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
                  <i class="fas fa-code" style="color: #ffffff; font-size: 18px;"></i>
                </div>
                <div>
                  <h3 class="mb-0" style="color: #ffffff; font-weight: 700; font-size: 20px; letter-spacing: 0.5px; line-height: 1.2;">
                    Yapılacak İşler
                  </h3>
                  <small style="color: rgba(255,255,255,0.9); font-size: 13px; line-height: 1.4;">Yazılım geliştirme işleri ve takibi</small>
                </div>
              </div>
              <button class="btn btn-light btn-sm shadow-sm" onclick="yeniIsEkle()" style="border-radius: 8px; font-weight: 600;">
                <i class="fas fa-plus"></i> Yeni İş Ekle
              </button>
            </div>
          </div>
          
          <!-- Card Body -->
          <div class="card-body" style="padding: 25px; background-color: #ffffff;">
            <?php if (!empty($data)): ?>
              <div class="table-responsive">
                <table id="yazilimTable" class="table table-bordered table-hover align-middle mb-0" style="border-radius: 8px; overflow: hidden;">
                  <thead class="text-white text-center" style="background: linear-gradient(135deg, #001657 0%, #001657 100%);">
                    <tr>
                      <th style="font-weight: 600; padding: 15px 10px;">Sıra</th>
                      <th style="font-weight: 600; padding: 15px 10px;">İş Detayı</th>
                      <th style="font-weight: 600; padding: 15px 10px;">Ekleyen</th>
                      <th style="font-weight: 600; padding: 15px 10px;">Kayıt Tarihi</th>
                      <th style="font-weight: 600; padding: 15px 10px;">Durum</th>
                      <th style="font-weight: 600; padding: 15px 10px; width: 200px;">İşlem</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($data as $d): 
                      $metin = str_replace("I","ı",$d->yazilim_detay);
                      $duzenlenmisMetin = mb_convert_case($metin, MB_CASE_TITLE, "UTF-8");
                      
                      if ($d->tamamlandi_mi == 1) {
                        $row_class = 'completed';
                        $status = '<span class="badge" style="font-size: 13px; padding: 8px 14px; background-color: #28a745; color: #ffffff; border-radius: 6px; font-weight: 500;"><i class="fas fa-check-circle"></i> Tamamlandı</span>';
                      } else {
                        $row_class = 'pending';
                        $status = '<span class="badge" style="font-size: 13px; padding: 8px 14px; background-color: #ffc107; color: #856404; border-radius: 6px; font-weight: 500;"><i class="fas fa-clock"></i> Devam Ediyor</span>';
                      }
                    ?>
                    <tr class="yazilim-row <?php echo $row_class; ?>" style="cursor: pointer; transition: all 0.2s ease;" data-status="<?= $d->tamamlandi_mi ?>">
                      <td style="padding: 15px 10px; vertical-align: middle; text-align: center; color: #495057; font-size: 14px; font-weight: 600;">
                        <?= $d->sira ?? '-' ?>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle;">
                        <strong style="color: #495057; font-size: 15px;"><?= htmlspecialchars($duzenlenmisMetin) ?></strong>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle; color: #6c757d; font-size: 14px;">
                        <i class="fas fa-user-circle mr-2"></i><?= htmlspecialchars($d->kullanici_ad_soyad ?? 'Belirtilmemiş') ?>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle; text-align: center; color: #495057; font-size: 14px;">
                        <?= date("d.m.Y H:i", strtotime($d->kayit_tarihi)) ?>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle; text-align: center;">
                        <?= $status ?>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle; text-align: center;">
                        <div class="btn-group" role="group">
                          <button class="btn btn-sm shadow-sm text-orange" 
                                  onclick="event.stopPropagation(); duzenle(<?= $d->yazilim_id ?>, '<?= htmlspecialchars($d->yazilim_detay, ENT_QUOTES) ?>', '<?= htmlspecialchars($d->kullanici_ad_soyad, ENT_QUOTES) ?>')"
                                  style="border-radius: 6px; font-weight: 500; padding: 6px 12px; background-color: #ffc107; color: #856404; border: none; margin-right: 5px;">
                            <i class="fas fa-pen"></i> Düzenle
                          </button>
                          <?php if($d->tamamlandi_mi == 0): ?>
                            <button class="btn btn-sm shadow-sm text-success" 
                                    onclick="event.stopPropagation(); tamamla(<?= $d->yazilim_id ?>)"
                                    style="border-radius: 6px; font-weight: 500; padding: 6px 12px; background-color: #28a745; color: #ffffff; border: none; margin-right: 5px;">
                              <i class="fas fa-check"></i> Tamamla
                            </button>
                          <?php else: ?>
                            <button class="btn btn-sm shadow-sm text-info" 
                                    onclick="event.stopPropagation(); bekleme(<?= $d->yazilim_id ?>)"
                                    style="border-radius: 6px; font-weight: 500; padding: 6px 12px; background-color: #17a2b8; color: #ffffff; border: none; margin-right: 5px;">
                              <i class="fas fa-clock"></i> Beklemeye Al
                            </button>
                          <?php endif; ?>
                          <button class="btn btn-sm shadow-sm text-danger" 
                                  onclick="event.stopPropagation(); sil(<?= $d->yazilim_id ?>)"
                                  style="border-radius: 6px; font-weight: 500; padding: 6px 12px; background-color: #dc3545; color: #ffffff; border: none;">
                            <i class="fas fa-trash"></i> Sil
                          </button>
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
                  <i class="fas fa-code" style="color: #adb5bd; font-size: 48px;"></i>
                </div>
                <p class="text-muted mb-0" style="font-size: 16px; font-weight: 500;">Henüz iş kaydı bulunmamaktadır.</p>
                <button class="btn btn-primary mt-3" onclick="yeniIsEkle()" style="border-radius: 8px;">
                  <i class="fas fa-plus"></i> İlk İşi Ekle
                </button>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<style>
  .yazilim-row {
    transition: all 0.2s ease;
  }

  .yazilim-row:hover {
    background-color: #f8f9fa !important;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  }

  /* Duruma göre arka plan renkleri */
  .yazilim-row.pending {
    background-color: #fff7e6;
    border-left: 3px solid #ffc107;
  }
  
  .yazilim-row.completed {
    background-color: #f9fffb;
    border-left: 3px solid #28a745;
    opacity: 0.85;
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

    .btn-group {
      flex-direction: column;
    }

    .btn-group .btn {
      margin-bottom: 5px;
      width: 100%;
    }
  }
</style>

<script>
function sil(id) {
  Swal.fire({
    title: 'Emin misiniz?',
    text: "Bu işi silmek istiyor musunuz?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Evet, sil!',
    cancelButtonText: 'İptal'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = "<?= base_url('yazilim/sil/') ?>" + id;
    }
  });
}

function bekleme(id) {
  Swal.fire({
    title: 'Beklemeye Al',
    text: "Bu işi beklemeye almak istiyor musunuz?",
    icon: 'question',
    showCancelButton: true,
    confirmButtonText: 'Evet',
    cancelButtonText: 'İptal'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = "<?= base_url('yazilim/bekleme/') ?>" + id;
    }
  });
}

function tamamla(id) {
  Swal.fire({
    title: 'Tamamlandı',
    text: "Bu işi tamamlandı olarak işaretlemek istiyor musunuz?",
    icon: 'question',
    showCancelButton: true,
    confirmButtonText: 'Evet',
    cancelButtonText: 'İptal'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = "<?= base_url('yazilim/tamamla/') ?>" + id;
    }
  });
}

function duzenle(id, detay, kullanici) {
  Swal.fire({
    title: 'İşi Düzenle',
    html:
      `<textarea id="detay" class="swal2-input" placeholder="Detay" style="min-height: 100px; width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; resize: vertical;">${detay}</textarea>`,
    showCancelButton: true,
    confirmButtonText: 'Kaydet',
    cancelButtonText: 'İptal',
    width: '600px',
    preConfirm: () => {
      const detay = document.getElementById('detay').value;
      if (!detay) {
        Swal.showValidationMessage('Tüm alanları doldurun');
      }
      return { detay }
    }
  }).then((result) => {
    if (result.isConfirmed) {
      const form = document.createElement('form');
      form.method = 'POST';
      form.action = "<?= base_url('yazilim/guncelle/') ?>" + id;

      const detayInput = document.createElement('input');
      detayInput.type = 'hidden';
      detayInput.name = 'yazilim_detay';
      detayInput.value = result.value.detay;

      form.appendChild(detayInput);
      document.body.appendChild(form);
      form.submit();
    }
  });
}

function yeniIsEkle() {
  Swal.fire({
    title: 'Yeni İş Ekle',
    html:
      `<textarea id="detay" class="swal2-input" placeholder="İş Detayı" style="min-height: 100px; width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; resize: vertical;"></textarea>`,
    showCancelButton: true,
    confirmButtonText: 'Ekle',
    cancelButtonText: 'İptal',
    width: '600px',
    preConfirm: () => {
      const detay = document.getElementById('detay').value;
      if (!detay) {
        Swal.showValidationMessage('Tüm alanları doldurun');
      }
      return { detay };
    }
  }).then((result) => {
    if (result.isConfirmed) {
      const form = document.createElement('form');
      form.method = 'POST';
      form.action = "<?= base_url('yazilim/ekle') ?>";

      const detayInput = document.createElement('input');
      detayInput.type = 'hidden';
      detayInput.name = 'yazilim_detay';
      detayInput.value = result.value.detay;
      
      form.appendChild(detayInput);
      document.body.appendChild(form);
      form.submit();
    }
  });
}

// DataTables initialization
(function() {
  function initDataTable() {
    if (typeof jQuery !== 'undefined' && typeof jQuery.fn.DataTable !== 'undefined') {
      var table = $('#yazilimTable').DataTable({
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
        "order": [[0, "asc"]], // Sıra sütununa göre sıralama
        "columnDefs": [
          {
            "orderable": false,
            "targets": [5] // İşlem sütunu sıralanamaz
          },
          {
            "type": "num",
            "targets": [0] // Sıra sütunu sayısal olarak sıralanır
          }
        ]
      });
    } else {
      setTimeout(initDataTable, 100);
    }
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initDataTable);
  } else {
    initDataTable();
  }
})();
</script>
