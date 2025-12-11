<?php $this->load->view('musteri/includes/styles'); ?>

<style>
  .custom-href:hover {
    text-decoration: underline;
  }

  .users_table_processing{
    margin-top:50px;
  }
       
  table.dataTable tbody th, table.dataTable tbody td {
    padding: 8px 10px;
  }

  /* Filter Styles */
  .filter-row {
    background-color: #f8f9fa;
    padding: 15px 15px 15px 0;
    border-radius: 5px;
    margin-bottom: 15px;
    margin-left: 0;
    margin-right: 0;
  }

  .filter-form {
    width: 100%;
  }

  .filter-row-inner {
    margin-left: 0;
    margin-right: 0;
  }

  .filter-col {
    padding-left: 15px;
    padding-right: 15px;
  }

  .filter-label {
    font-weight: 600;
    margin-bottom: 5px;
    display: block;
    color: var(--primary-color);
    font-size: 13px;
  }

  .filter-input-group-text {
    background-color: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
  }

  .filter-form-control {
    border-color: var(--primary-color);
    border-radius: 4px;
  }

  .filter-buttons-wrapper {
    display: flex;
    align-items: flex-end;
    gap: 5px;
  }

  .filter-btn-primary {
    background: var(--primary-gradient);
    color: white;
    border-color: var(--primary-color);
    flex: 1;
  }

  .filter-btn-secondary {
    flex: 1;
  }

  .input-group:focus-within .input-group-text {
    background-color: #002a7a;
    border-color: #002a7a;
  }

  @media (max-width: 768px) {
    .filter-col {
      margin-bottom: 10px;
    }
    
    .filter-buttons-wrapper {
      flex-direction: column;
    }
    
    .filter-buttons-wrapper .btn {
      width: 100%;
    }
  }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper content-wrapper-musteri">
  <section class="content pr-0">
    <div class="row">
      <div class="col-12">
        <div class="card card-musteri">
          <!-- Card Header -->
          <div class="card-header card-header-musteri">
            <div class="d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3 card-header-icon-wrapper">
                  <i class="fas fa-users card-header-icon"></i>
                </div>
                <div>
                  <h3 class="mb-0 card-header-title">
                    Müşteri Bilgileri
                  </h3>
                  <small class="card-header-subtitle">Müşteri listesi ve yönetim modülleri</small>
                </div>
              </div>
              <div class="d-flex align-items-center gap-2">
                <?php 
                // Departman kontrolü - Sadece yönetim ve bilgi işlem departmanları görebilir
                $aktif_kullanici = aktif_kullanici();
                $departman_adi = isset($aktif_kullanici->departman_adi) ? mb_strtolower(trim($aktif_kullanici->departman_adi), 'UTF-8') : '';
                $is_yonetim = (strpos($departman_adi, 'yönetim') !== false || strpos($departman_adi, 'yonetim') !== false);
                $is_bilgi_islem = (strpos($departman_adi, 'bilgi işlem') !== false || strpos($departman_adi, 'bilgi islem') !== false || strpos($departman_adi, 'bilgi') !== false);
                
                if ($is_yonetim || $is_bilgi_islem):
                  // Mevcut filtreleri export URL'ine ekle
                  $export_url = base_url("musteri/excel_export");
                  $params = [];
                  if (isset($_GET['sehir_id']) && !empty($_GET['sehir_id'])) {
                    $params[] = 'sehir_id=' . urlencode($_GET['sehir_id']);
                  }
                  if (isset($_GET['ilce_id']) && !empty($_GET['ilce_id'])) {
                    $params[] = 'ilce_id=' . urlencode($_GET['ilce_id']);
                  }
                  if (isset($_GET['musteri_durum']) && !empty($_GET['musteri_durum'])) {
                    $params[] = 'musteri_durum=' . urlencode($_GET['musteri_durum']);
                  }
                  if (!empty($params)) {
                    $export_url .= '?' . implode('&', $params);
                  }
                ?>
                <a href="<?=$export_url?>" onclick="waiting('Excel\'e Aktarılıyor...');" type="button" class="btn btn-success btn-sm">
                  <i class="fa fa-file-excel"></i> Excel'e Aktar
                </a>
                <?php endif; ?>
                <a href="<?=base_url("musteri/ekle")?>" onclick="waiting('Yeni Müşteri Ekle');" type="button" class="btn btn-light btn-sm">
                  <i class="fa fa-plus"></i> Yeni Kayıt Ekle
                </a>
              </div>
            </div>
          </div>
          
          <!-- Modern Tab Navigation Bar -->
          <?php $this->load->view('musteri/includes/tabs'); ?>
          
          <!-- Card Body -->
          <div class="card-body card-body-musteri">
            <!-- Filtreler -->
            <div class="row mb-3 filter-row">
              <form method="GET" action="<?=base_url('musteri')?>" id="filterForm" class="filter-form">
                <div class="row filter-row-inner">
                  <div class="col-md-3 col-sm-6 filter-col">
                    <label class="filter-label">
                      <i class="fas fa-map-marker-alt"></i> Şehir
                    </label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text filter-input-group-text">
                          <i class="fas fa-city"></i>
                        </span>
                      </div>
                      <select name="sehir_id" id="sehir_id" class="form-control filter-form-control">
                        <option value="">Tüm Şehirler</option>
                        <?php foreach($sehirler as $sehir): ?>
                          <option value="<?=$sehir->sehir_id?>" <?=(isset($_GET['sehir_id']) && $_GET['sehir_id'] == $sehir->sehir_id) ? 'selected' : ''?>>
                            <?=$sehir->sehir_adi?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-3 col-sm-6 filter-col">
                    <label class="filter-label">
                      <i class="fas fa-map-pin"></i> İlçe
                    </label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text filter-input-group-text">
                          <i class="fas fa-map-marked-alt"></i>
                        </span>
                      </div>
                      <select name="ilce_id" id="ilce_id" class="form-control filter-form-control">
                        <option value="">Tüm İlçeler</option>
                        <?php if(isset($_GET['sehir_id']) && !empty($_GET['sehir_id'])): ?>
                          <?php 
                          foreach($ilceler as $ilce): 
                            if($ilce->sehir_id == $_GET['sehir_id']):
                          ?>
                            <option value="<?=$ilce->ilce_id?>" <?=(isset($_GET['ilce_id']) && $_GET['ilce_id'] == $ilce->ilce_id) ? 'selected' : ''?>>
                              <?=$ilce->ilce_adi?>
                            </option>
                          <?php 
                            endif;
                          endforeach; 
                          ?>
                        <?php endif; ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-3 col-sm-6 filter-col">
                    <label class="filter-label">
                      <i class="fas fa-toggle-on"></i> Durum
                    </label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text filter-input-group-text">
                          <i class="fas fa-info-circle"></i>
                        </span>
                      </div>
                      <select name="musteri_durum" id="musteri_durum" class="form-control filter-form-control">
                        <option value="">Tümü</option>
                        <option value="aktif" <?=(isset($_GET['musteri_durum']) && $_GET['musteri_durum'] == 'aktif') ? 'selected' : ''?>>Aktif</option>
                        <option value="pasif" <?=(isset($_GET['musteri_durum']) && $_GET['musteri_durum'] == 'pasif') ? 'selected' : ''?>>Pasif</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-3 col-sm-6 filter-col">
                    <label class="filter-label">&nbsp;</label>
                    <div class="filter-buttons-wrapper">
                      <button type="submit" class="btn btn-sm filter-btn-primary">
                        <i class="fas fa-filter"></i> Filtrele
                      </button>
                      <a href="<?=base_url('musteri')?>" class="btn btn-sm btn-secondary filter-btn-secondary">
                        <i class="fas fa-redo"></i> Temizle
                      </a>
                    </div>
                  </div>
                </div>
              </form>
            </div>

            <div class="card-body-content">
              <div class="table-responsive">
                <table id="users_table" class="table table-musteri table-bordered table-striped nowrap" style="width:100%;">
                  <thead>
                    <tr>
                      <th style="max-width:70px;width:70px;">Müşteri ID</th>
                      <th>Müşteri Adı</th>
                      <th>Merkez Bilgisi</th> 
                      <th>Adres</th>
                      <th>İletişim Numarası</th>
                      <th style="width:120px">İşlem</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    // Şehir değiştiğinde ilçeleri güncelle
    $('#sehir_id').on('change', function() {
      var sehir_id = $(this).val();
      var ilce_select = $('#ilce_id');
      
      ilce_select.html('<option value="">Tüm İlçeler</option>');
      
      if(sehir_id) {
        // AJAX ile ilçeleri getir
        $.ajax({
          url: '<?=base_url("ilce/get_ilceler")?>/' + sehir_id,
          type: 'GET',
          dataType: 'json',
          success: function(data) {
            if(data.status === 'ok' && data.data) {
              $.each(data.data, function(index, item) {
                ilce_select.append('<option value="' + item.id + '">' + item.ilce + '</option>');
              });
            }
          },
          error: function() {
            ilce_select.html('<option value="">Hata oluştu</option>');
          }
        });
      }
    });

    // DataTable başlatma (optimize edilmiş - performans iyileştirmeleri)
    var table = $('#users_table').DataTable({
      "processing": true,
      "serverSide": true,
      "pageLength": 16,
      "deferRender": true, // Performans için
      "scrollX": true,
      "searchDelay": 800, // Arama için 800ms bekle (debounce) - daha uzun süre bekle
      "minLength": 2, // Minimum 2 karakter girilmeden arama yapma
      "ajax": {
        "url": "<?php echo site_url('musteri/musteriler_ajax'); ?>",
        "type": "GET",
        "data": function(d) {
          // Filtre parametrelerini ekle
          d.sehir_id = $('#sehir_id').val();
          d.ilce_id = $('#ilce_id').val();
          d.musteri_durum = $('#musteri_durum').val();
        },
        "dataSrc": function(json) {
          // Response'u optimize et
          return json.data;
        }
      },
      "language": {
        "processing": '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>',
        "emptyTable": "Kayıt bulunamadı",
        "info": "Toplam _TOTAL_ kayıttan _START_ - _END_ arası gösteriliyor",
        "infoEmpty": "Kayıt yok",
        "infoFiltered": "(_MAX_ kayıt içerisinden bulunan)",
        "lengthMenu": "Sayfa başına _MENU_ kayıt göster",
        "loadingRecords": "Yükleniyor...",
        "zeroRecords": "Eşleşen kayıt bulunamadı"
      },
      "columns": [
        { "data": 0 },
        { "data": 1 },
        { "data": 2 },
        { "data": 3 },
        { "data": 4 },
        { "data": 5 }
      ],
      "order": [[0, "desc"]], // Varsayılan sıralama
      "stateSave": false, // Performans için state save kapalı
      "pagingType": "full_numbers"
      // dom ayarı kaldırıldı - varsayılan olarak tüm elementler gösterilir (arama input dahil)
    });

    // Form submit olduğunda DataTable'ı yenile
    $('#filterForm').on('submit', function(e) {
      e.preventDefault();
      table.ajax.reload();
    });
    
    $('#users_table').on('click', '.edit-btn', function() {
      var id = $(this).data('id');
      window.location.href = "<?php echo site_url('users/edit/'); ?>" + id;
    });
  });
</script>