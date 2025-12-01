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
                  <i class="fas fa-shield-alt" style="color: #ffffff; font-size: 18px;"></i>
                </div>
                <div>
                  <h3 class="mb-0" style="color: #ffffff; font-weight: 700; font-size: 20px; letter-spacing: 0.5px; line-height: 1.2;">
                    Garanti Sorgulayanlar
                  </h3>
                  <small style="color: rgba(255,255,255,0.9); font-size: 13px; line-height: 1.4;">Garanti sorgulama kayıtları ve detayları</small>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Filtre Bölümü -->
          <div class="card-body border-bottom" style="background-color: #f8f9fa; padding: 20px 25px;">
            <form method="GET" action="<?=base_url('cihaz/garanti_sorgulayanlar')?>" id="filtreForm">
              <div class="row">
                <!-- Tarih Aralığı -->
                <div class="col-md-3 mb-3">
                  <label class="form-label" style="font-weight: 600; color: #495057; font-size: 13px; margin-bottom: 5px;">
                    <i class="fas fa-calendar-alt mr-1"></i> Başlangıç Tarihi
                  </label>
                  <input type="date" name="tarih_baslangic" class="form-control" 
                         value="<?=isset($filtreler['tarih_baslangic']) ? $filtreler['tarih_baslangic'] : ''?>" 
                         style="border-radius: 6px; border: 1px solid #ced4da;">
                </div>
                <div class="col-md-3 mb-3">
                  <label class="form-label" style="font-weight: 600; color: #495057; font-size: 13px; margin-bottom: 5px;">
                    <i class="fas fa-calendar-check mr-1"></i> Bitiş Tarihi
                  </label>
                  <input type="date" name="tarih_bitis" class="form-control" 
                         value="<?=isset($filtreler['tarih_bitis']) ? $filtreler['tarih_bitis'] : ''?>" 
                         style="border-radius: 6px; border: 1px solid #ced4da;">
                </div>
                
                <!-- Seri Numarası -->
                <div class="col-md-3 mb-3">
                  <label class="form-label" style="font-weight: 600; color: #495057; font-size: 13px; margin-bottom: 5px;">
                    <i class="fas fa-qrcode mr-1"></i> Seri Numarası
                  </label>
                  <input type="text" name="seri_numarasi" class="form-control" 
                         value="<?=isset($filtreler['seri_numarasi']) ? $filtreler['seri_numarasi'] : ''?>" 
                         placeholder="Seri numarası ara..." 
                         style="border-radius: 6px; border: 1px solid #ced4da;">
                </div>
                
                <!-- Müşteri Adı -->
                <div class="col-md-3 mb-3">
                  <label class="form-label" style="font-weight: 600; color: #495057; font-size: 13px; margin-bottom: 5px;">
                    <i class="fas fa-user mr-1"></i> Müşteri Adı
                  </label>
                  <input type="text" name="musteri_adi" class="form-control" 
                         value="<?=isset($filtreler['musteri_adi']) ? $filtreler['musteri_adi'] : ''?>" 
                         placeholder="Müşteri adı ara..." 
                         style="border-radius: 6px; border: 1px solid #ced4da;">
                </div>
              </div>
              
              <div class="row">
                <!-- Merkez Adı -->
                <div class="col-md-3 mb-3">
                  <label class="form-label" style="font-weight: 600; color: #495057; font-size: 13px; margin-bottom: 5px;">
                    <i class="fas fa-building mr-1"></i> Merkez Adı
                  </label>
                  <input type="text" name="merkez_adi" class="form-control" 
                         value="<?=isset($filtreler['merkez_adi']) ? $filtreler['merkez_adi'] : ''?>" 
                         placeholder="Merkez adı ara..." 
                         style="border-radius: 6px; border: 1px solid #ced4da;">
                </div>
                
                <!-- İl -->
                <div class="col-md-3 mb-3">
                  <label class="form-label" style="font-weight: 600; color: #495057; font-size: 13px; margin-bottom: 5px;">
                    <i class="fas fa-map-marker-alt mr-1"></i> İl
                  </label>
                  <select name="il_id" id="il_id" class="form-control select2" 
                          style="border-radius: 6px; border: 1px solid #ced4da; width: 100%;">
                    <option value="">Tüm İller</option>
                    <?php foreach($iller as $il): ?>
                      <option value="<?=$il->sehir_id?>" <?=isset($filtreler['il_id']) && $filtreler['il_id'] == $il->sehir_id ? 'selected' : ''?>>
                        <?=$il->sehir_adi?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
                
                <!-- İlçe -->
                <div class="col-md-3 mb-3">
                  <label class="form-label" style="font-weight: 600; color: #495057; font-size: 13px; margin-bottom: 5px;">
                    <i class="fas fa-map-pin mr-1"></i> İlçe
                  </label>
                  <select name="ilce_id" id="ilce_id" class="form-control select2" 
                          style="border-radius: 6px; border: 1px solid #ced4da; width: 100%;">
                    <option value="">Tüm İlçeler</option>
                  </select>
                </div>
                
                <!-- Garanti Durumu -->
                <div class="col-md-3 mb-3">
                  <label class="form-label" style="font-weight: 600; color: #495057; font-size: 13px; margin-bottom: 5px;">
                    <i class="fas fa-check-circle mr-1"></i> Garanti Durumu
                  </label>
                  <select name="garanti_durumu" class="form-control" 
                          style="border-radius: 6px; border: 1px solid #ced4da;">
                    <option value="">Tümü</option>
                    <option value="aktif" <?=isset($filtreler['garanti_durumu']) && $filtreler['garanti_durumu'] == 'aktif' ? 'selected' : ''?>>Aktif</option>
                    <option value="bitmis" <?=isset($filtreler['garanti_durumu']) && $filtreler['garanti_durumu'] == 'bitmis' ? 'selected' : ''?>>Süresi Dolmuş</option>
                  </select>
                </div>
              </div>
              
              <!-- Filtre Butonları -->
              <div class="row">
                <div class="col-12">
                  <button type="submit" class="btn btn-primary shadow-sm" style="border-radius: 6px; font-weight: 600; padding: 8px 20px;">
                    <i class="fas fa-filter mr-2"></i> Filtrele
                  </button>
                  <a href="<?=base_url('cihaz/garanti_sorgulayanlar')?>" class="btn btn-secondary shadow-sm" style="border-radius: 6px; font-weight: 600; padding: 8px 20px;">
                    <i class="fas fa-redo mr-2"></i> Filtreleri Temizle
                  </a>
                </div>
              </div>
            </form>
          </div>
          
          <!-- Card Body -->
          <div class="card-body" style="padding: 25px; background-color: #ffffff;">
            <?php if (!empty($urunler)): ?>
              <div class="table-responsive">
                <table id="garantiTable" class="table table-bordered table-hover align-middle mb-0" style="border-radius: 8px; overflow: hidden;">
                  <thead class="text-white text-center" style="background: linear-gradient(135deg, #001657 0%, #001657 100%);">
                    <tr>
                      <th style="font-weight: 600; padding: 15px 10px;">Seri Numarası</th>
                      <th style="font-weight: 600; padding: 15px 10px;">Müşteri / Merkez Bilgisi</th>
                      <th style="font-weight: 600; padding: 15px 10px;">Ürün</th>
                      <th style="font-weight: 600; padding: 15px 10px;">Garanti Başlangıç</th>
                      <th style="font-weight: 600; padding: 15px 10px;">Garanti Bitiş</th>
                      <th style="font-weight: 600; padding: 15px 10px;">Sorgulama Tarihi</th>
                      <th style="font-weight: 600; padding: 15px 10px;">Konum</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($urunler as $urun): 
                      // Garanti durumu kontrolü
                      $bugun = date('Y-m-d');
                      $garanti_bitis = $urun->garanti_bitis_tarihi ? date('Y-m-d', strtotime($urun->garanti_bitis_tarihi)) : null;
                      
                      if($garanti_bitis && $garanti_bitis < $bugun){
                        $row_class = 'expired';
                        $garanti_durum = '<span class="badge" style="font-size: 12px; padding: 6px 12px; background-color: #dc3545; color: #ffffff; border-radius: 6px; font-weight: 500;">Süresi Doldu</span>';
                      } elseif($garanti_bitis && $garanti_bitis >= $bugun){
                        $row_class = 'active';
                        $garanti_durum = '<span class="badge" style="font-size: 12px; padding: 6px 12px; background-color: #28a745; color: #ffffff; border-radius: 6px; font-weight: 500;">Aktif</span>';
                      } else {
                        $row_class = '';
                        $garanti_durum = '<span class="badge" style="font-size: 12px; padding: 6px 12px; background-color: #6c757d; color: #ffffff; border-radius: 6px; font-weight: 500;">Bilinmiyor</span>';
                      }
                    ?>
                    <tr class="garanti-row <?php echo $row_class; ?>" style="cursor: pointer; transition: all 0.2s ease;">
                      <td style="padding: 15px 10px; vertical-align: middle;">
                        <strong style="color: #495057; font-size: 14px;">
                          <i class="fas fa-qrcode mr-2" style="color: #001657;"></i>
                          <?=$urun->sorgulanan_seri_numarasi ?? "<span style='opacity:0.5'>Bulunamadı</span>"?>
                        </strong>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle;">
                        <?php if($urun->musteri_ad): ?>
                          <div style="color: #495057; font-size: 14px; font-weight: 600;">
                            <i class="far fa-user-circle mr-2" style="color: #001657;"></i>
                            <?=htmlspecialchars($urun->musteri_ad)?>
                          </div>
                          <div style="color: #6c757d; font-size: 13px; margin-top: 3px;">
                            <i class="fas fa-building mr-2" style="font-size: 11px;"></i>
                            <?=htmlspecialchars($urun->merkez_adi ?? '')?>
                          </div>
                          <?php if($urun->musteri_iletisim_numarasi): ?>
                            <div style="color: #6c757d; font-size: 12px; margin-top: 2px;">
                              <i class="fas fa-phone mr-2" style="font-size: 11px;"></i>
                              <?=htmlspecialchars($urun->musteri_iletisim_numarasi)?>
                            </div>
                          <?php endif; ?>
                        <?php else: ?>
                          <span style="opacity:0.5; font-size: 13px;">Cihaz seri numarası sistemde bulunamadı.</span>
                        <?php endif; ?>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle; color: #495057; font-size: 14px;">
                        <?=$urun->urun_adi ?? '<span style="opacity:0.5">-</span>'?>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle; text-align: center; color: #495057; font-size: 14px;">
                        <?php if($urun->garanti_baslangic_tarihi): ?>
                          <?=date("d.m.Y", strtotime($urun->garanti_baslangic_tarihi))?>
                        <?php else: ?>
                          <span style="opacity:0.5">-</span>
                        <?php endif; ?>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle; text-align: center;">
                        <?php if($urun->garanti_bitis_tarihi): ?>
                          <div style="color: #495057; font-size: 14px;">
                            <?=date("d.m.Y", strtotime($urun->garanti_bitis_tarihi))?>
                          </div>
                          <div style="margin-top: 5px;">
                            <?=$garanti_durum?>
                          </div>
                        <?php else: ?>
                          <span style="opacity:0.5">-</span>
                        <?php endif; ?>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle; text-align: center; color: #495057; font-size: 14px;">
                        <i class="far fa-clock mr-2" style="color: #001657;"></i>
                        <?=date("d.m.Y H:i", strtotime($urun->sorgulama_tarihi))?>
                      </td>
                      <td style="padding: 15px 10px; vertical-align: middle; text-align: center; color: #6c757d; font-size: 13px;">
                        <?php if($urun->sehir_adi): ?>
                          <i class="fas fa-map-marker-alt mr-1"></i>
                          <?=$urun->sehir_adi?>
                          <?php if($urun->ilce_adi): ?>
                            / <?=$urun->ilce_adi?>
                          <?php endif; ?>
                        <?php else: ?>
                          <span style="opacity:0.5">-</span>
                        <?php endif; ?>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            <?php else: ?>
              <div class="text-center py-5">
                <div class="mb-3">
                  <i class="fas fa-shield-alt" style="color: #adb5bd; font-size: 48px;"></i>
                </div>
                <p class="text-muted mb-0" style="font-size: 16px; font-weight: 500;">Henüz garanti sorgulama kaydı bulunmamaktadır.</p>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<style>
  .garanti-row {
    transition: all 0.2s ease;
  }

  .garanti-row:hover {
    background-color: #f8f9fa !important;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  }

  /* Duruma göre arka plan renkleri */
  .garanti-row.active {
    background-color: #f9fffb;
  }
  
  .garanti-row.expired {
    background-color: #ffeaea;
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
$(document).ready(function() {
  // Select2 başlatma
  if(typeof $.fn.select2 !== 'undefined') {
    $('.select2').select2({
      theme: 'bootstrap4',
      width: '100%'
    });
  }
  
  // İl değiştiğinde ilçeleri yükle
  $('#il_id').on('change', function() {
    var il_id = $(this).val();
    var ilce_select = $('#ilce_id');
    
    ilce_select.html('<option value="">Yükleniyor...</option>');
    
    if(il_id) {
      $.ajax({
        url: '<?=base_url("ilce/get_ilceler")?>/' + il_id,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
          ilce_select.html('<option value="">Tüm İlçeler</option>');
          if(data.status === 'ok' && data.data) {
            $.each(data.data, function(index, item) {
              var selected = '<?=isset($filtreler["ilce_id"]) ? $filtreler["ilce_id"] : ""?>' == item.id ? 'selected' : '';
              ilce_select.append('<option value="' + item.id + '" ' + selected + '>' + item.ilce + '</option>');
            });
          }
        },
        error: function() {
          ilce_select.html('<option value="">Hata oluştu</option>');
        }
      });
    } else {
      ilce_select.html('<option value="">Tüm İlçeler</option>');
    }
  });
  
  // Sayfa yüklendiğinde il seçiliyse ilçeleri yükle
  <?php if(isset($filtreler['il_id']) && !empty($filtreler['il_id'])): ?>
    $('#il_id').trigger('change');
  <?php endif; ?>
  
  // DataTable başlatma
  if(typeof $.fn.DataTable !== 'undefined') {
    $('#garantiTable').DataTable({
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
      "order": [[5, "desc"]], // Sorgulama tarihine göre sıralama
      "columnDefs": [
        {
          "orderable": true,
          "targets": [0, 1, 2, 3, 4, 5, 6]
        }
      ]
    });
  }
});
</script>
