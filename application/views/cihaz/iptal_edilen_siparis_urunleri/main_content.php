<?php $this->load->view('siparis/includes/styles'); ?>

<style>
/* İptal Edilen Siparişler Tablosu - Responsive ve Optimize */
.table-responsive-iptal {
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
  width: 100%;
}

#iptal-siparis-tablo {
  width: 100%;
  margin: 0;
  border-collapse: separate;
  border-spacing: 0;
  table-layout: auto;
}

/* Sütun Genişlikleri - Akıllı Optimizasyon */
#iptal-siparis-tablo .col-id {
  width: 50px;
  min-width: 50px;
  max-width: 60px;
  text-align: center;
  padding: 8px 4px !important;
}

#iptal-siparis-tablo .col-cihaz {
  width: 120px;
  min-width: 100px;
  max-width: 150px;
  padding: 8px 10px !important;
  white-space: normal;
  word-wrap: break-word;
}

#iptal-siparis-tablo .col-musteri {
  width: auto;
  min-width: 200px;
  max-width: 350px;
  padding: 8px 12px !important;
  white-space: normal;
  word-wrap: break-word;
}

#iptal-siparis-tablo .col-lokasyon {
  width: 120px;
  min-width: 100px;
  max-width: 150px;
  padding: 8px 10px !important;
  white-space: normal;
  font-size: 13px;
}

#iptal-siparis-tablo .col-fiyat {
  width: 100px;
  min-width: 90px;
  max-width: 120px;
  padding: 8px 8px !important;
  white-space: nowrap;
  font-size: 13px;
}

#iptal-siparis-tablo .col-islem {
  width: 110px;
  min-width: 100px;
  max-width: 120px;
  padding: 8px 6px !important;
  text-align: center;
}

/* Hücre İçerik Optimizasyonu - Gereksiz boşlukları kaldır */
#iptal-siparis-tablo tbody td {
  padding: 8px 10px;
  vertical-align: top;
  line-height: 1.4;
  border-spacing: 0;
  margin: 0;
}

#iptal-siparis-tablo thead th {
  padding: 10px 10px;
  font-size: 13px;
  font-weight: 600;
  white-space: nowrap;
  border-spacing: 0;
  margin: 0;
}

/* Gereksiz boşlukları kaldır */
#iptal-siparis-tablo {
  border-spacing: 0;
  border-collapse: separate;
  margin: 0;
}

#iptal-siparis-tablo td,
#iptal-siparis-tablo th {
  margin: 0;
  padding-left: 10px;
  padding-right: 10px;
}

/* Table Cell Content - Kompakt Görünüm - Gereksiz boşluklar kaldırıldı */
.table-cell-content {
  display: flex;
  align-items: flex-start;
  gap: 6px;
  margin: 0;
  padding: 0;
}

.table-cell-icon {
  font-size: 15px;
  color: var(--primary-color);
  margin-top: 1px;
  flex-shrink: 0;
  line-height: 1;
}

.table-cell-text {
  flex: 1;
  min-width: 0;
  line-height: 1.3;
  margin: 0;
  padding: 0;
}

.table-cell-text strong {
  display: block;
  margin-bottom: 1px;
  line-height: 1.3;
}

.table-cell-text small {
  display: block;
  line-height: 1.2;
  margin: 0;
  padding: 0;
}

/* İptal Nedeni - Kompakt - Gereksiz boşluklar kaldırıldı */
#iptal-siparis-tablo .text-danger {
  margin-top: 4px;
  padding-top: 4px;
  border-top: 1px solid #f0f0f0;
  line-height: 1.3;
  display: block;
}

/* Buton Optimizasyonu */
#iptal-siparis-tablo .btn {
  padding: 4px 8px;
  font-size: 12px;
  white-space: nowrap;
  width: 100%;
}

/* Responsive - Tablet */
@media (max-width: 1024px) {
  #iptal-siparis-tablo .col-musteri {
    min-width: 180px;
    max-width: 280px;
  }
  
  #iptal-siparis-tablo .col-fiyat {
    width: 85px;
    min-width: 80px;
    font-size: 12px;
  }
  
  #iptal-siparis-tablo tbody td,
  #iptal-siparis-tablo thead th {
    padding: 6px 8px;
    font-size: 12px;
  }
}

/* Responsive - Mobil */
@media (max-width: 768px) {
  .table-responsive-iptal {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
  }
  
  #iptal-siparis-tablo {
    min-width: 800px; /* Minimum genişlik - scroll için */
  }
  
  #iptal-siparis-tablo .col-id {
    width: 45px;
    min-width: 45px;
    padding: 6px 3px !important;
    font-size: 11px;
  }
  
  #iptal-siparis-tablo .col-cihaz {
    width: 100px;
    min-width: 90px;
    padding: 6px 8px !important;
    font-size: 12px;
  }
  
  #iptal-siparis-tablo .col-musteri {
    min-width: 160px;
    max-width: 220px;
    padding: 6px 8px !important;
    font-size: 11px;
  }
  
  #iptal-siparis-tablo .col-lokasyon {
    width: 90px;
    min-width: 85px;
    padding: 6px 6px !important;
    font-size: 11px;
  }
  
  #iptal-siparis-tablo .col-fiyat {
    width: 75px;
    min-width: 70px;
    padding: 6px 4px !important;
    font-size: 11px;
  }
  
  #iptal-siparis-tablo .col-islem {
    width: 90px;
    min-width: 85px;
    padding: 6px 4px !important;
  }
  
  #iptal-siparis-tablo tbody td,
  #iptal-siparis-tablo thead th {
    padding: 6px 6px;
    font-size: 11px;
  }
  
  .table-cell-icon {
    font-size: 14px;
  }
  
  #iptal-siparis-tablo .btn {
    padding: 3px 6px;
    font-size: 11px;
  }
  
  #iptal-siparis-tablo .text-danger {
    font-size: 10px;
    margin-top: 4px;
    padding-top: 4px;
  }
}

/* Çok Küçük Ekranlar */
@media (max-width: 480px) {
  #iptal-siparis-tablo {
    min-width: 750px;
  }
  
  #iptal-siparis-tablo .col-fiyat {
    width: 65px;
    min-width: 60px;
    font-size: 10px;
  }
  
  #iptal-siparis-tablo tbody td,
  #iptal-siparis-tablo thead th {
    padding: 4px 4px;
    font-size: 10px;
  }
}

/* Hover Efekti - Sadece Desktop */
@media (min-width: 769px) {
  #iptal-siparis-tablo tbody tr:hover {
    background-color: #f8f9fa;
  }
}

/* Tfoot Gizle - Mobilde */
@media (max-width: 768px) {
  #iptal-siparis-tablo tfoot {
    display: none;
  }
}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper content-wrapper-siparis">
  <section class="content pr-0">
    <div class="row">
      <div class="col-12">
        <div class="card card-siparis">
          <!-- Card Header -->
          <div class="card-header card-header-siparis">
            <div class="d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3 card-header-icon-wrapper">
                  <i class="fas fa-ban card-header-icon"></i>
                </div>
                <div>
                  <h3 class="mb-0 card-header-title">
                    İptal Edilen Sipariş Ürünleri
                  </h3>
                  <small class="card-header-subtitle">İptal edilen sipariş ürünlerini görüntüle</small>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Modern Tab Navigation Bar -->
          <?php $this->load->view('siparis/includes/tabs'); ?>
          
          <!-- Card Body -->
          <div class="card-body card-body-siparis">
            <div class="card-body-content">
              <div class="table-responsive table-responsive-iptal">
              <table id="iptal-siparis-tablo" class="table table-siparis table-bordered table-striped">
                <thead>
                  <tr>
                    <th class="col-id">ID</th> 
                    <th class="col-cihaz">Cihaz</th>
                    <th class="col-musteri">Müşteri / Merkez</th>
                    <th class="col-lokasyon">Lokasyon</th>
                    <th class="col-fiyat">Satış</th>
                    <th class="col-fiyat">Kapora</th> 
                    <th class="col-fiyat">Peşinat</th> 
                    <th class="col-fiyat">Fatura</th>  
                    <th class="col-fiyat">Takas</th>
                    <th class="col-islem">İşlem</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $onceki_siparis_id = 0;
                  foreach ($urunler as $urun) : 
                      // Aynı sipariş için sadece bir kez buton göster
                      $siparis_id = isset($urun->siparis_id) ? $urun->siparis_id : $urun->siparis_kodu;
                      $buton_goster = ($siparis_id != $onceki_siparis_id);
                      $onceki_siparis_id = $siparis_id;
                  ?>
                    <tr>
                      <td class="col-id"><?=$urun->siparis_urun_id?></td>
                      <td class="col-cihaz"><?=$urun->urun_adi?></td> 
                      <td class="col-musteri">
                        <div class="table-cell-content">
                          <i class="far fa-user-circle table-cell-icon"></i>
                          <div class="table-cell-text">
                            <strong><?=$urun->musteri_ad?></strong> / <?=$urun->merkez_adi?>
                            <br><small class="text-muted"><?=$urun->musteri_iletisim_numarasi?></small>
                            <?php if(isset($urun->siparis_kodu_text)): ?>
                              <br><small class="text-info">Sipariş: <?=$urun->siparis_kodu_text?></small>
                            <?php endif; ?>
                          </div>
                        </div>
                        <div class="text-danger mt-1" style="font-size:12px;">
                          <i class="fas fa-exclamation-triangle"></i> <?=mb_substr($urun->siparis_iptal_nedeni, 0, 80)?><?=mb_strlen($urun->siparis_iptal_nedeni) > 80 ? '...' : ''?>
                        </div>
                      </td>
                      <td class="col-lokasyon">
                        <i class="fas fa-map-marker-alt text-muted"></i> 
                        <?=$urun->sehir_adi?> / <?=$urun->ilce_adi?>
                      </td>
                      <td class="col-fiyat text-right"><?=number_format($urun->satis_fiyati,2)?> ₺</td>
                      <td class="col-fiyat text-right"><?=number_format($urun->kapora_fiyati,2)?> ₺</td>
                      <td class="col-fiyat text-right"><?=number_format($urun->pesinat_fiyati,2)?> ₺</td>
                      <td class="col-fiyat text-right"><?=number_format($urun->fatura_tutari,2)?> ₺</td>
                      <td class="col-fiyat text-right"><?=number_format($urun->takas_bedeli,2)?> ₺</td>
                      <td class="col-islem">
                        <?php if($buton_goster && ($this->session->userdata("aktif_kullanici_id") == 1 || $this->session->userdata("aktif_kullanici_id") == 9)): ?>
                          <a href="<?=base_url("cihaz/siparis_geri_yukle/".$siparis_id)?>" 
                             class="btn btn-sm btn-success btn-block" 
                             onclick="return confirm('Bu siparişi geri yüklemek istediğinize emin misiniz?');"
                             title="Siparişi Geri Yükle">
                            <i class="fas fa-undo"></i> <span class="d-none d-md-inline">Geri Yükle</span>
                          </a>
                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Cihaz</th>
                    <th>Müşteri / Merkez</th>
                    <th>Lokasyon</th>
                    <th>Satış</th>
                    <th>Kapora</th> 
                    <th>Peşinat</th> 
                    <th>Fatura</th>  
                    <th>Takas</th>
                    <th>İşlem</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script>
$(document).ready(function() {
  // DataTables başlatma - Responsive ve optimize
  if ($.fn.DataTable && $('#iptal-siparis-tablo').length) {
    $('#iptal-siparis-tablo').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "order": [[0, "desc"]], // ID'ye göre azalan sıralama
      "pageLength": 25,
      "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Tümü"]],
      "info": true,
      "autoWidth": false,
      "responsive": {
        "details": {
          "type": "column",
          "target": 0
        }
      },
      "scrollX": true,
      "scrollCollapse": true,
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Turkish.json",
        "emptyTable": "İptal edilen sipariş bulunamadı",
        "zeroRecords": "Eşleşen kayıt bulunamadı",
        "info": "_TOTAL_ kayıttan _START_ - _END_ arası gösteriliyor",
        "infoEmpty": "0 kayıttan 0 - 0 arası gösteriliyor",
        "infoFiltered": "(_MAX_ kayıt içerisinden bulunan)",
        "search": "Ara:",
        "lengthMenu": "_MENU_ kayıt göster",
        "paginate": {
          "first": "İlk",
          "last": "Son",
          "next": "Sonraki",
          "previous": "Önceki"
        }
      },
      "columnDefs": [
        {
          "targets": [0], // ID sütunu
          "orderable": true,
          "className": "text-center"
        },
        {
          "targets": [4, 5, 6, 7, 8], // Fiyat sütunları
          "orderable": true,
          "className": "text-right"
        },
        {
          "targets": [9], // İşlem sütunu
          "orderable": false,
          "className": "text-center"
        }
      ],
      "drawCallback": function(settings) {
        // Tablo çizildikten sonra responsive kontrolü
        if ($(window).width() <= 768) {
          $('#iptal-siparis-tablo').addClass('mobile-table');
        } else {
          $('#iptal-siparis-tablo').removeClass('mobile-table');
        }
      }
    });
  }
  
  // Window resize - responsive kontrol
  $(window).on('resize', function() {
    if ($.fn.DataTable && $.fn.DataTable.isDataTable('#iptal-siparis-tablo')) {
      $('#iptal-siparis-tablo').DataTable().columns.adjust().responsive.recalc();
    }
  });
});
</script>