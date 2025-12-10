<?php $this->load->view('uretim/includes/styles'); ?>

<div class="content-wrapper content-wrapper-uretim">
  <section class="content pr-0">
    <div class="row">
      <div class="col-12">
        <div class="card card-uretim">
          <!-- Card Header -->
          <div class="card-header card-header-uretim">
            <div class="d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3 card-header-icon-wrapper">
                  <i class="fas fa-microchip card-header-icon"></i>
                </div>
                <div>
                  <h3 class="mb-0 card-header-title">
                    Cihaz Havuzu
                  </h3>
                  <small class="card-header-subtitle">Cihaz stok havuzu yönetimi</small>
                </div>
              </div>
              <div class="d-flex gap-2">
                <a href="<?=base_url("stok/anakart_kontrol_view")?>" class="btn btn-light btn-sm">
                  <i class="fas fa-search"></i> Anakart Onayla
                </a>
                <a onclick="showWindow('https://ugbusiness.com.tr/stok/parca_kontrol')" class="btn btn-light btn-sm">
                  <i class="fas fa-search"></i> Parça Sorgula
                </a>
                <a href="<?=base_url("cihaz/cihaz_havuz_tanimla_view")?>" class="btn btn-light btn-sm">
                  <i class="fas fa-plus-circle"></i> Yeni Kayıt Ekle
                </a>
              </div>
            </div>
          </div>
          
          <!-- Modern Tab Navigation Bar -->
          <?php $this->load->view('uretim/includes/tabs'); ?>
          
          <!-- Card Body -->
          <div class="card-body card-body-uretim">
            <div class="card-body-content" style="padding: 15px;">
              <div class="table-responsive">
                <table id="example1" class="table table-uretim table-bordered table-striped nowrap">
                  <thead>
                    <tr>
                      <th style="width: 42px;">ID</th> 
                      <th style="width: 130px;">Cihaz Adı</th>
                      <th style="width: 130px;">Renk</th>
                      <th style="width: 130px;">Cihaz Seri Numarası</th>
                      <th style="width: 130px;">Stok Durumu</th>
                      <th style="width: 130px;">İşlem</th> 
                    </tr>
                  </thead>
                  <tbody>
                    <?php $count=0; foreach ($cihazlar as $cihaz) : ?>
                      <?php $count++?>
                      <tr>
                        <td><?=$cihaz->cihaz_havuz_id?></td> 
                        <td>
                          <i class="far fa-file-alt" style="margin-right:5px;opacity:1"></i> 
                          <?=$cihaz->urun_adi?> 
                        </td>
                        <td>
                          <i class="far fa-file-alt" style="margin-right:5px;opacity:1"></i> 
                          <?=$cihaz->renk_adi?> 
                        </td>
                        <td>
                          <i class="far fa-file-alt" style="margin-right:5px;opacity:0.8"></i>
                          <?=$cihaz->cihaz_havuz_seri_numarasi?>
                        </td>
                        <td>
                          <?php 
                          $aa = get_merkez($cihaz->cihaz_havuz_seri_numarasi);
                          if($cihaz->cihaz_havuz_durum == 0 || $aa != null){
                          ?>
                            <button type="button" class="btn btn-block btn-outline-success" style="background-color:#51e76f1a;color:#00891f">
                              <b><?=$aa ? $aa->musteri_ad." / ".$aa->merkez_adi : "Satış"?></b> / Satış
                            </button>
                          <?php
                          }else{
                          ?>
                            <button type="button" class="btn btn-block btn-outline-warning" style="background-color:#fcc03530;color:#9f7700">
                              <b>Satış Yapılmadı</b> / Stokta Bekliyor
                            </button>
                          <?php
                          }
                          ?>
                        </td>
                        <td>
                          <?php 
                          if($this->session->userdata('aktif_kullanici_id') == 7 || $this->session->userdata('aktif_kullanici_id') == 1){
                          ?>
                            <a type="button" href="<?=base_url("cihaz_kontrol/detay/0/".$cihaz->urun_id."/".$cihaz->cihaz_havuz_id)?>" class="btn btn-dark btn-xs">
                              <i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> Cihaz Testi
                            </a>
                          <?php
                          }
                          ?>
                          <a type="button" href="<?=base_url("cihaz/cihaz_havuz_tanimla_update_view/".$cihaz->cihaz_havuz_id)?>" class="btn btn-warning btn-xs">
                            <i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> Düzenle
                          </a>
                          <a type="button" onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu kaydı silmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Onayla','<?=base_url('cihaz/cihaz_havuz_sil/').$cihaz->cihaz_havuz_id?>');" class="btn btn-danger btn-xs">
                            <i class="fa fa-times" style="font-size:12px" aria-hidden="true"></i> Kayıt Sil
                          </a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
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
  function showWindow($url) {
    var width = 750;
    var height = 685;
    var left = (screen.width / 2) - (width / 2);
    var top = (screen.height / 2) - (height / 2);
    var newWindow = window.open($url, 'Yeni Pencere', 'width=' + width + ',height=' + height + ',top=' + top + ',left=' + left);
  }
</script>
