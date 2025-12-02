<!-- Loader -->
<div id="talepLoader" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); z-index: 9999; display: flex; align-items: center; justify-content: center;">
  <div style="background: white; padding: 30px; border-radius: 12px; text-align: center; box-shadow: 0 4px 20px rgba(0,0,0,0.3);">
    <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem; margin-bottom: 15px;">
      <span class="sr-only">Yükleniyor...</span>
    </div>
    <div style="font-size: 16px; font-weight: 600; color: #001657;">
      Veriler yükleniyor...
    </div>
    <div style="font-size: 13px; color: #6c757d; margin-top: 5px;">
      Lütfen bekleyin
    </div>
  </div>
</div>

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
            <!-- Filtreler -->
            <div class="card mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
              <div class="card-header" style="background-color: #f8f9fa; border-bottom: 1px solid #e0e0e0; padding: 12px 15px;">
                <h5 class="mb-0" style="font-size: 16px; font-weight: 600; color: #495057;">
                  <i class="fas fa-filter mr-2" style="color: #001657;"></i>Filtreler
                </h5>
              </div>
              <div class="card-body" style="padding: 20px;">
                <form method="GET" action="<?=base_url('talep/rapor_detay')?>" id="filterForm" onsubmit="showLoader(); return true;">
                  <input type="hidden" name="kaynak_adi" value="<?=htmlspecialchars($kaynak_adi)?>">
                  <input type="hidden" name="baslangic_tarihi" value="<?=htmlspecialchars($baslangic_tarihi ?? '')?>">
                  <input type="hidden" name="bitis_tarihi" value="<?=htmlspecialchars($bitis_tarihi ?? '')?>">
                  
                  <div class="row">
                    <!-- Arama -->
                    <div class="col-md-4 mb-3">
                      <label style="font-weight: 600; color: #495057; font-size: 13px; margin-bottom: 5px;">
                        <i class="fas fa-search mr-1"></i> Müşteri/Telefon Ara
                      </label>
                      <input type="text" name="arama" class="form-control" 
                             placeholder="Müşteri adı veya telefon..." 
                             value="<?=htmlspecialchars($secilen_arama ?? '')?>"
                             style="border-radius: 6px; border: 1px solid #ced4da;">
                    </div>
                    
                    <!-- Sorumlu Kullanıcı -->
                    <div class="col-md-4 mb-3">
                      <label style="font-weight: 600; color: #495057; font-size: 13px; margin-bottom: 5px;">
                        <i class="fas fa-user mr-1"></i> Sorumlu Kullanıcı
                      </label>
                      <select name="sorumlu_kullanici_id" class="form-control" style="border-radius: 6px; border: 1px solid #ced4da;">
                        <option value="">Tümü</option>
                        <?php foreach($kullanicilar as $kullanici): ?>
                          <option value="<?=$kullanici->kullanici_id?>" <?=($secilen_sorumlu == $kullanici->kullanici_id) ? 'selected' : ''?>>
                            <?=htmlspecialchars($kullanici->kullanici_ad_soyad)?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    
                    <!-- Talep Sonucu -->
                    <div class="col-md-4 mb-3">
                      <label style="font-weight: 600; color: #495057; font-size: 13px; margin-bottom: 5px;">
                        <i class="fas fa-check-circle mr-1"></i> Talep Durumu
                      </label>
                      <select name="talep_sonuc_id" class="form-control" style="border-radius: 6px; border: 1px solid #ced4da;">
                        <option value="">Tümü</option>
                        <?php foreach($talep_sonuclar as $sonuc): ?>
                          <option value="<?=$sonuc->talep_sonuc_id?>" <?=($secilen_sonuc == $sonuc->talep_sonuc_id) ? 'selected' : ''?>>
                            <?=htmlspecialchars($sonuc->talep_sonuc_adi)?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  
                  <div class="row mt-2">
                    <div class="col-12">
                      <button type="submit" class="btn btn-primary" style="border-radius: 6px; font-weight: 600; padding: 8px 20px;">
                        <i class="fas fa-filter mr-2"></i> Filtrele
                      </button>
                      <a href="<?=base_url('talep/rapor_detay?kaynak_adi='.urlencode($kaynak_adi).'&baslangic_tarihi='.urlencode($baslangic_tarihi ?? '').'&bitis_tarihi='.urlencode($bitis_tarihi ?? ''))?>" 
                         class="btn btn-secondary" style="border-radius: 6px; font-weight: 600; padding: 8px 20px; margin-left: 10px;"
                         onclick="showLoader();">
                        <i class="fas fa-redo mr-2"></i> Filtreleri Temizle
                      </a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            
            <!-- Tablo Container -->
            <div class="table-responsive" id="tableContainer">
              <table id="talepDetayTable" class="table table-bordered table-hover align-middle mb-0" style="border-radius: 8px; overflow: hidden;">
                <thead class="text-white text-center" style="background: linear-gradient(135deg, #001657 0%, #001657 100%);">
                  <tr>
                    <th style="font-weight: 600; padding: 15px 10px;">Talep ID</th>
                    <th style="font-weight: 600; padding: 15px 10px;">Müşteri Adı</th>
                    <th style="font-weight: 600; padding: 15px 10px;">Telefon</th>
                    <th style="font-weight: 600; padding: 15px 10px;">Kayıt Tarihi</th>
                    <th style="font-weight: 600; padding: 15px 10px;">Sorumlu</th>
                    <th style="font-weight: 600; padding: 15px 10px;">Durum</th>
                    <th style="font-weight: 600; padding: 15px 10px; width: 120px;">İşlem</th>
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

  /* Loader animasyonu */
  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }
  
  .spinner-border {
    border: 4px solid #f3f3f3;
    border-top: 4px solid #001657;
    border-radius: 50%;
    animation: spin 1s linear infinite;
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
    
    .card-body .row .col-md-3 {
      margin-bottom: 15px;
    }
    
    .card-body .btn {
      width: 100%;
      margin-bottom: 10px;
      margin-left: 0 !important;
    }
  }
</style>

<script>
// Loader göster fonksiyonu
function showLoader() {
  var loader = document.getElementById('talepLoader');
  if (loader) {
    loader.style.display = 'flex';
  }
}

(function() {
  var loader = document.getElementById('talepLoader');
  var tableContainer = document.getElementById('tableContainer');
  
  function initDataTable() {
    // jQuery ve DataTable yüklü mü kontrol et
    if (typeof jQuery !== 'undefined' && typeof jQuery.fn.DataTable !== 'undefined') {
      try {
        // Mevcut DataTable varsa yok et
        if ($.fn.DataTable.isDataTable('#talepDetayTable')) {
          $('#talepDetayTable').DataTable().destroy();
        }
        
        // Filtre parametrelerini al
        var urlParams = new URLSearchParams(window.location.search);
        var kaynak_adi = urlParams.get('kaynak_adi') || '<?=htmlspecialchars($kaynak_adi)?>';
        var baslangic_tarihi = urlParams.get('baslangic_tarihi') || '<?=htmlspecialchars($baslangic_tarihi ?? '')?>';
        var bitis_tarihi = urlParams.get('bitis_tarihi') || '<?=htmlspecialchars($bitis_tarihi ?? '')?>';
        var sorumlu_kullanici_id = urlParams.get('sorumlu_kullanici_id') || '';
        var talep_sonuc_id = urlParams.get('talep_sonuc_id') || '';
        var arama = urlParams.get('arama') || '';
        
        // DataTable initialization - Server-side processing
        var table = $('#talepDetayTable').DataTable({
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
            "url": "<?=base_url('talep/rapor_detay_ajax')?>",
            "type": "GET",
            "data": function(d) {
              d.kaynak_adi = kaynak_adi;
              d.baslangic_tarihi = baslangic_tarihi;
              d.bitis_tarihi = bitis_tarihi;
              d.sorumlu_kullanici_id = sorumlu_kullanici_id;
              d.talep_sonuc_id = talep_sonuc_id;
              d.arama = arama;
            },
            "dataSrc": function(json) {
              return json.data;
            },
            "beforeSend": function() {
              // Her AJAX isteğinde loader göster
              if (loader) {
                loader.style.display = 'flex';
              }
            },
            "complete": function() {
              // İstek tamamlandığında loader gizle
              if (loader) {
                loader.style.display = 'none';
              }
            },
            "error": function(xhr, error, thrown) {
              console.error('AJAX hatası:', error);
              if (loader) {
                loader.style.display = 'none';
              }
              if (tableContainer) {
                tableContainer.style.display = 'block';
              }
            }
          },
          "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Turkish.json",
            "processing": '<div style="text-align:center;padding:20px;"><i class="fa fa-spinner fa-spin fa-3x" style="color:#001657;"></i><br><span style="margin-top:10px;display:block;">Veriler yükleniyor...</span></div>'
          },
          "order": [[3, "desc"]], // Kayıt tarihine göre sıralama
          "columnDefs": [
            {
              "orderable": true,
              "targets": [0, 1, 2, 3, 4, 5, 6]
            }
          ],
          "drawCallback": function(settings) {
            // Her çizim sonrası satır tıklama event'lerini yeniden bağla
            attachRowClickEvents();
          },
          "createdRow": function(row, data, dataIndex) {
            // Satırlara tıklanabilir class ekle
            $(row).addClass('talep-row');
            $(row).css('cursor', 'pointer');
          }
        });
        
        // Satır tıklama event'lerini bağla
        attachRowClickEvents();
        
      } catch(error) {
        console.error('DataTable hatası:', error);
        if (loader) {
          loader.style.display = 'none';
        }
        if (tableContainer) {
          tableContainer.style.display = 'block';
        }
      }
    } else {
      // jQuery/DataTable henüz yüklenmediyse, biraz bekle ve tekrar dene
      setTimeout(initDataTable, 100);
    }
  }
  
  function attachRowClickEvents() {
    // Satır tıklama ile detay sayfasına yönlendirme
    $('#talepDetayTable tbody').off('click', 'tr').on('click', 'tr', function(e) {
      // Buton veya link tıklamalarını hariç tut
      if ($(e.target).closest('a, button').length) {
        return;
      }
      const detailLink = $(this).find('a[href*="edit"]');
      if (detailLink.length) {
        window.location.href = detailLink.attr('href');
      }
    });
  }

  // Sayfa yüklendiğinde başlat
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function() {
      // Loader'ı göster
      if (loader) {
        loader.style.display = 'flex';
      }
      setTimeout(initDataTable, 100);
    });
  } else {
    // Loader'ı göster
    if (loader) {
      loader.style.display = 'flex';
    }
    setTimeout(initDataTable, 100);
  }
})();
</script>

