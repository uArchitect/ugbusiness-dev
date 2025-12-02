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
            <form method="GET" action="<?=base_url('cihaz/garanti_sorgulayanlar')?>" id="filtreForm" onsubmit="return true;">
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
                    <th style="display: none;">Durum Class</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Veriler AJAX ile yüklenecek -->
                </tbody>
              </table>
            </div>
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
(function() {
  function initSelect2() {
    // Select2 başlatma
    if (typeof jQuery !== 'undefined' && typeof jQuery.fn.select2 !== 'undefined') {
      $('.select2').select2({
        theme: 'bootstrap4',
        width: '100%'
      });
      
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
                // Select2'yi yeniden başlat
                ilce_select.select2({
                  theme: 'bootstrap4',
                  width: '100%'
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
    } else {
      setTimeout(initSelect2, 100);
    }
  }
  
  function initDataTable() {
    // jQuery ve DataTable yüklü mü kontrol et
    if (typeof jQuery !== 'undefined' && typeof jQuery.fn.DataTable !== 'undefined') {
      try {
        // Mevcut DataTable varsa yok et
        if ($.fn.DataTable.isDataTable('#garantiTable')) {
          $('#garantiTable').DataTable().destroy();
        }
        
        // Filtre parametrelerini al
        var urlParams = new URLSearchParams(window.location.search);
        var tarih_baslangic = urlParams.get('tarih_baslangic') || '';
        var tarih_bitis = urlParams.get('tarih_bitis') || '';
        var seri_numarasi = urlParams.get('seri_numarasi') || '';
        var musteri_adi = urlParams.get('musteri_adi') || '';
        var merkez_adi = urlParams.get('merkez_adi') || '';
        var il_id = urlParams.get('il_id') || '';
        var ilce_id = urlParams.get('ilce_id') || '';
        var garanti_durumu = urlParams.get('garanti_durumu') || '';
        
        // DataTable initialization - Server-side processing
        var table = $('#garantiTable').DataTable({
          "processing": true,
          "serverSide": true,
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
          "pageLength": 25,
          "ajax": {
            "url": "<?=base_url('cihaz/garanti_sorgulayanlar_ajax')?>",
            "type": "GET",
            "data": function(d) {
              d.tarih_baslangic = tarih_baslangic;
              d.tarih_bitis = tarih_bitis;
              d.seri_numarasi = seri_numarasi;
              d.musteri_adi = musteri_adi;
              d.merkez_adi = merkez_adi;
              d.il_id = il_id;
              d.ilce_id = ilce_id;
              d.garanti_durumu = garanti_durumu;
            },
            "dataSrc": function(json) {
              return json.data;
            }
          },
          "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Turkish.json",
            "processing": '<div style="text-align:center;padding:20px;"><i class="fa fa-spinner fa-spin fa-3x" style="color:#001657;"></i><br><span style="margin-top:10px;display:block;">Veriler yükleniyor...</span></div>'
          },
          "order": [[5, "desc"]], // Sorgulama tarihine göre sıralama
          "columnDefs": [
            {
              "orderable": true,
              "targets": [0, 1, 2, 3, 4, 5, 6]
            },
            {
              "visible": false,
              "targets": [7], // Durum class sütunu gizli
              "orderable": false
            }
          ],
          "createdRow": function(row, data, dataIndex) {
            // Son sütundaki class'ı al (garanti durumu)
            var rowClass = data[7] || '';
            if(rowClass) {
              $(row).addClass('garanti-row ' + rowClass);
              $(row).css('cursor', 'pointer');
            } else {
              $(row).addClass('garanti-row');
              $(row).css('cursor', 'pointer');
            }
          }
        });
      } catch(error) {
        console.error('DataTable hatası:', error);
      }
    } else {
      // jQuery henüz yüklenmediyse, biraz bekle ve tekrar dene
      setTimeout(initDataTable, 100);
    }
  }

  // DOM yüklendiğinde başlat
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function() {
      initSelect2();
      initDataTable();
    });
  } else {
    // DOM zaten yüklenmişse
    initSelect2();
    initDataTable();
  }
})();
</script>
