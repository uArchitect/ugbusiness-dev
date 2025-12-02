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
                <form method="GET" action="<?=base_url('talep/rapor_detay')?>" id="filterForm" onsubmit="showLoader()">
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
            
            <?php if (!empty($talepler)): ?>
              <div class="mb-3">
                <span class="badge badge-primary" style="font-size: 14px; padding: 8px 15px;">
                  Toplam <?=count($talepler)?> Talep
                </span>
              </div>
              
              <div class="table-responsive" id="tableContainer" style="display: none;">
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
                        <?php if(!empty($talep->son_durum_adi)): ?>
                          <span class="badge" style="font-size: 12px; padding: 6px 12px; border-radius: 6px; background-color: #6c757d; color: #ffffff;">
                            <?=htmlspecialchars($talep->son_durum_adi)?>
                          </span>
                        <?php else: ?>
                          <span class="badge" style="font-size: 12px; padding: 6px 12px; border-radius: 6px; background-color: #adb5bd; color: #ffffff;">
                            Durum Yok
                          </span>
                        <?php endif; ?>
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
  // Loader'ı göster
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
        
        // DataTable initialization - Büyük veri setleri için optimize edilmiş
        var table = $('#talepDetayTable').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
          "pageLength": 25,
          "deferRender": true, // Büyük veri setleri için
          "processing": false, // Server-side değil, client-side
          "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Turkish.json",
            "processing": "İşleniyor...",
            "loadingRecords": "Yükleniyor...",
            "emptyTable": "Tabloda veri bulunmamaktadır",
            "zeroRecords": "Eşleşen kayıt bulunamadı",
            "info": "_TOTAL_ kayıttan _START_ - _END_ arası gösteriliyor",
            "infoEmpty": "Kayıt yok",
            "infoFiltered": "(_MAX_ kayıt içerisinden bulunan)",
            "lengthMenu": "_MENU_ kayıt göster",
            "search": "Ara:",
            "paginate": {
              "first": "İlk",
              "last": "Son",
              "next": "Sonraki",
              "previous": "Önceki"
            }
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
          }
        });
        
        // Satır tıklama event'lerini bağla
        attachRowClickEvents();
        
        // Tabloyu göster
        if (tableContainer) {
          tableContainer.style.display = 'block';
        }
        
        // Loader'ı gizle
        if (loader) {
          loader.style.display = 'none';
        }
        
      } catch(error) {
        console.error('DataTable hatası:', error);
        // Hata durumunda da loader'ı gizle
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
    $('#talepDetayTable tbody').off('click', 'tr.talep-row').on('click', 'tr.talep-row', function(e) {
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
      // DOM hazır olduktan sonra biraz bekle (verilerin render edilmesi için)
      setTimeout(initDataTable, 100);
    });
  } else {
    // DOM zaten yüklenmişse
    setTimeout(initDataTable, 100);
  }
  
  // Window load event'i - tüm kaynaklar yüklendikten sonra
  window.addEventListener('load', function() {
    // Eğer hala loader görünüyorsa ve tablo hazırsa gizle
    setTimeout(function() {
      if (loader && loader.style.display !== 'none') {
        var tableExists = document.getElementById('talepDetayTable');
        if (tableExists) {
          loader.style.display = 'none';
          if (tableContainer) {
            tableContainer.style.display = 'block';
          }
        }
      }
    }, 500);
  });
})();
</script>

