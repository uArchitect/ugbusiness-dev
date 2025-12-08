<?php $this->load->view('musteri/includes/styles'); ?>
<?php $this->load->view('musteri/includes/tabs'); ?>

<style>
  .filter-row {
    background-color: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 20px;
  }

  .filter-form-group {
    margin-bottom: 15px;
  }

  .filter-label {
    font-weight: 600;
    margin-bottom: 8px;
    display: block;
    color: var(--primary-color);
    font-size: 14px;
  }

  .filter-select {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #ced4da;
    border-radius: 6px;
    font-size: 14px;
    transition: all 0.3s ease;
  }

  .filter-select:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(0, 22, 87, 0.25);
    outline: none;
  }

  .filter-btn {
    width: 100%;
    padding: 12px;
    background: var(--primary-gradient);
    color: white;
    border: none;
    border-radius: 6px;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
  }

  .filter-btn:hover {
    background: #002a7a;
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0, 22, 87, 0.2);
  }

  .table-musteri {
    margin-top: 20px;
  }

  @media (max-width: 768px) {
    .filter-row {
      padding: 15px;
    }
  }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper content-wrapper-musteri">
  <section class="content pr-0">
    <div class="row">
      <div class="col-12">
        <div class="card card-musteri">
          <div class="card-header-musteri">
            <div class="d-flex align-items-center">
              <div class="card-header-icon-wrapper d-flex align-items-center justify-content-center rounded-circle mr-3">
                <i class="fas fa-map-marker-alt card-header-icon"></i>
              </div>
              <div>
                <h3 class="card-header-title mb-0">İl Bazlı Cihazlar</h3>
                <span class="card-header-subtitle">İl ve cihaz tipine göre filtreleme yaparak cihazları görüntüleyin</span>
              </div>
            </div>
          </div>
          <div class="card-body-musteri">
            <div class="card-body-content">
              <!-- Filter Form -->
              <form action="<?=base_url('cihaz/tumcihazlarilbazli')?>" method="post" class="filter-row">
                <div class="row">
                  <div class="col-md-6 filter-form-group">
                    <label class="filter-label">
                      <i class="fas fa-microchip mr-2"></i>Cihaz Tipi
                    </label>
                    <select class="filter-select" name="cihaz_id">
                      <option <?=$filter_cihaz_id==1?"selected":""?> value="1">UMEX LAZER</option>
                      <option <?=$filter_cihaz_id==2?"selected":""?> value="2">UMEX DIODE</option>
                      <option <?=$filter_cihaz_id==3?"selected":""?> value="3">UMEX EMS</option>
                      <option <?=$filter_cihaz_id==4?"selected":""?> value="4">UMEX GOLD</option>
                      <option <?=$filter_cihaz_id==5?"selected":""?> value="5">UMEX SLIM</option>
                      <option <?=$filter_cihaz_id==6?"selected":""?> value="6">UMEX S</option>
                      <option <?=$filter_cihaz_id==7?"selected":""?> value="7">UMEX Q</option>
                      <option <?=$filter_cihaz_id==8?"selected":""?> value="8">UMEX PLUS</option>
                    </select>
                  </div>
                  <div class="col-md-6 filter-form-group">
                    <label class="filter-label">
                      <i class="fas fa-map-marker-alt mr-2"></i>İl Seçimi
                    </label>
                    <select class="filter-select" name="il_id">
                      <option value="9999">TÜM İLLER</option>
                      <?php 
                      foreach ($sehirler as $il) {
                        ?>
                        <option <?=$il->sehir_id==$filter_il_id?"selected":""?> value="<?=$il->sehir_id?>"><?=$il->sehir_adi?></option>
                        <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <button class="filter-btn" type="submit">
                      <i class="fas fa-filter mr-2"></i>Filtrele
                    </button>
                  </div>
                </div>
              </form>

              <!-- DataTable -->
              <div class="table-responsive">
                <table id="example963yonlendirilentablo" class="table table-musteri table-bordered table-striped nowrap" style="width:100%;">
                  <thead>
                    <tr>
                      <th>Garanti Bitiş</th>
                      <th>Cihaz</th>
                      <th>Seri Numarası</th>
                      <th>Müşteri Adı</th>
                      <th>Merkez Bilgisi</th>
                      <th>Adres</th>
                      <th>İl</th>
                      <th>İlçe</th>
                      <th>İletişim Numarası</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    foreach ($data as $musteri) {
                      ?>
                      <tr>
                        <td>
                          <?=date("d.m.Y",strtotime($musteri->garanti_bitis_tarihi))?>
                          <?php 
                          $kalangun = gunSayisiHesapla(date("Y-m-d"),date("Y-m-d",strtotime($musteri->garanti_bitis_tarihi)));
                          if(date("Y-m-d",strtotime($musteri->garanti_bitis_tarihi)) > date("Y-m-d"))
                          {
                            echo "<span class='text-success d-block mt-1'><small>".$kalangun." Gün Kaldı</small></span>";
                          }else{
                            echo "<span class='text-danger d-block mt-1'><small>".($kalangun)." Gün Geçti</small></span>";
                          }
                          ?> 
                        </td>
                        <td><?=$musteri->urun_adi?></td>
                        <td><?=$musteri->seri_numarasi?></td>
                        <td><?=$musteri->musteri_ad?></td>
                        <td><?=$musteri->merkez_adi?></td>
                        <td><?=$musteri->merkez_adresi?></td>
                        <td><?=$musteri->sehir_adi?></td>
                        <td><?=$musteri->ilce_adi?></td>
                        <td><?=$musteri->musteri_iletisim_numarasi?></td>
                      </tr>
                      <?php
                    }
                    ?>
                  </tbody>
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
    $('#example963yonlendirilentablo').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Turkish.json"
        },
        "responsive": true,
        "scrollX": true,
        "pageLength": 25,
        "order": [[0, "asc"]],
        "deferRender": true,
        "stateSave": false
    });
});
</script>
