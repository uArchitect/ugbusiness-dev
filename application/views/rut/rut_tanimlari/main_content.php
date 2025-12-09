<?php $this->load->view('talep/includes/styles'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper content-wrapper-siparis pt-2">
  <section class="content pr-0">
    <div class="row">
      <div class="col-12">
        <div class="card card-siparis">
          <!-- Card Header -->
          <div class="card-header card-header-siparis">
            <div class="d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3 card-header-icon-wrapper">
                  <i class="fas fa-route card-header-icon"></i>
                </div>
                <div>
                  <h3 class="mb-0 card-header-title">
                    Rut Listesi Restore
                  </h3>
                  <small class="card-header-subtitle">Rut planlama ve yönetim modülleri</small>
                </div>
              </div>
            </div>
          </div>

          <!-- Modern Tab Navigation Bar -->
          <?php $this->load->view('talep/includes/tabs'); ?>

          <!-- Card Body -->
          <div class="card-body card-body-siparis">
            <div class="card-body-content">
              <?php if(empty($rut_tanimlari) || count($rut_tanimlari) == 0): ?>
                <div class="alert alert-info text-center">
                  <i class="fas fa-info-circle"></i> Henüz rut planlaması bulunmamaktadır.
                </div>
              <?php else: ?>
                <div class="row">
                  <?php foreach ($rut_tanimlari as $rut): ?>
                    <div class="col-md-6 mb-3">
                      <div class="card card-dark card-outline">
                        <div class="card-header">
                          <div class="d-flex justify-content-between align-items-start">
                            <div class="flex-grow-1">
                              <h5 class="card-title mb-2" style="font-size: large;">
                                <i class="fas fa-user"></i> <b><?=$rut->kullanici_ad_soyad?></b> / <?=$rut->sehir_adi?>
                              </h5>
                              <div class="card-tools">
                                <a href="<?=base_url("rut/form/".$rut->rut_sehir_id."/".$rut->rut_tanim_id)?>" class="btn btn-tool btn-sm" title="Düzenle">
                                  <i class="fas fa-edit text-primary"></i>
                                </a>
                                <a href="<?=base_url("rut/delete/".$rut->rut_tanim_id)?>" class="btn btn-tool btn-sm" title="Sil" onclick="return confirm('Bu rut planlamasını silmek istediğinize emin misiniz?');">
                                  <i class="fas fa-times text-danger"></i>
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="card-body">
                          <!-- Tarih Bilgileri -->
                          <div class="mb-2">
                            <span style="font-size:13px">
                              <i class="far fa-calendar-alt text-primary"></i> <b>Başlangıç</b>: <?=date("d.m.Y",strtotime($rut->rut_baslangic_tarihi))?>
                              <span class="ml-3">
                                <i class="far fa-calendar-alt text-danger"></i> <b>Bitiş</b>: <?=date("d.m.Y",strtotime($rut->rut_bitis_tarihi))?>
                              </span>
                            </span>
                          </div>

                          <!-- Araç Bilgisi -->
                          <div class="mb-2">
                            <span style="font-size:13px">
                              <i class="fas fa-car text-info"></i> <b>Araç</b>: 
                              <?php if($rut->arac_plaka): ?>
                                <span class="text-success"><?=$rut->arac_plaka?></span>
                              <?php else: ?>
                                <span class="text-danger">ARAÇ TANIMLANMADI</span>
                              <?php endif; ?>
                            </span>
                          </div>

                          <!-- İlçe Bilgisi -->
                          <div class="mb-2">
                            <span style="font-size:13px">
                              <i class="fas fa-map-marker-alt text-warning"></i> <b>İlçe</b>: 
                              <?php
                              if($rut->rut_ilce_bilgisi != "[]" && $rut->rut_ilce_bilgisi != "null" && $rut->rut_ilce_bilgisi != null) {
                                $ilcelers = json_decode($rut->rut_ilce_bilgisi);
                                if(is_array($ilcelers) && count($ilcelers) > 0) {
                                  $CI =& get_instance();
                                  $ilceler = $CI->db->get("ilceler")->result();
                                  $ilce_adlari = [];
                                  foreach ($ilcelers as $secilen_ilce_id) {
                                    foreach ($ilceler as $ilce) {
                                      if($ilce->ilce_id == $secilen_ilce_id) {
                                        $ilce_adlari[] = $ilce->ilce_adi;
                                        break;
                                      }
                                    }
                                  }
                                  echo "<span class='text-success'>".implode(", ", $ilce_adlari)."</span>";
                                } else {
                                  echo "<span class='text-success'>Tüm İlçeler</span>";
                                }
                              } else {
                                echo "<span class='text-danger'>İLÇE TANIMLANMADI</span>";
                              }
                              ?>
                            </span>
                          </div>

                          <!-- Rut Durum -->
                          <div class="mb-2">
                            <span style="font-size:13px">
                              <i class="fas fa-info-circle text-info"></i> <b>Rut Durum</b>: 
                              <?php
                              $rut_baslangic_tarihi = strtotime($rut->rut_baslangic_tarihi);
                              $rut_bitis_tarihi = strtotime($rut->rut_bitis_tarihi);
                              $simdi = strtotime(date("Y-m-d 00:00"));

                              if ($simdi < $rut_baslangic_tarihi) {
                                echo "<span class='badge badge-warning'>Başlamadı</span>";
                              } elseif ($simdi >= $rut_baslangic_tarihi && $simdi <= $rut_bitis_tarihi) {
                                echo "<span class='badge badge-success'>Devam Ediyor</span>";
                              } elseif ($simdi > $rut_bitis_tarihi) {
                                echo "<span class='badge badge-danger'>Tamamlandı</span>";
                              }
                              ?>
                            </span>
                          </div>

                          <!-- Araç KM Bilgileri -->
                          <?php if($rut->arac_plaka): ?>
                            <div class="mb-2">
                              <span style="font-size:13px">
                                <i class="fas fa-tachometer-alt text-success"></i> <b>Başlangıç KM</b>: <?=$rut->rut_satisci_baslatma_km ? number_format($rut->rut_satisci_baslatma_km, 0, ',', '.') : '0'?>
                                <span class="ml-3">
                                  <i class="fas fa-tachometer-alt text-danger"></i> <b>Bitiş KM</b>: <?=$rut->rut_satisci_bitis_km ? number_format($rut->rut_satisci_bitis_km, 0, ',', '.') : '0'?>
                                </span>
                              </span>
                            </div>

                            <!-- KM Güncelleme Formları -->
                            <?php if($rut->rut_satisci_baslatma_km == 0): ?>
                              <div class="form-group mt-3 p-2" style="background: #f8f9fa; border-radius: 5px;">
                                <label for="baslangic_km_<?=$rut->rut_tanim_id?>"><small>Rut Başlangıç Araç Km Bilgisi</small></label>
                                <form action="<?=base_url("arac/arac_rut_km_kaydet/".$rut->rut_tanim_id."/0")?>" method="POST">
                                  <div class="input-group input-group-sm">
                                    <input type="number" min="1" name="arac_km_deger" class="form-control" placeholder="KM giriniz" required>
                                    <div class="input-group-append">
                                      <button type="submit" class="btn btn-success btn-flat">
                                        <i class="fas fa-save"></i> Kaydet
                                      </button>
                                    </div>
                                  </div>
                                </form>
                              </div>
                            <?php endif; ?>

                            <?php if($rut->rut_satisci_baslatma_km > 0 && $rut->rut_satisci_bitis_km == 0): ?>
                              <div class="form-group mt-3 p-2" style="background: #f8f9fa; border-radius: 5px;">
                                <label for="bitis_km_<?=$rut->rut_tanim_id?>"><small>Rut Bitiş Araç Km Bilgisi</small></label>
                                <form action="<?=base_url("arac/arac_rut_km_kaydet/".$rut->rut_tanim_id."/1")?>" method="POST">
                                  <div class="input-group input-group-sm">
                                    <input type="number" min="1" name="arac_km_deger" class="form-control" placeholder="KM giriniz" required>
                                    <div class="input-group-append">
                                      <button type="submit" class="btn btn-success btn-flat">
                                        <i class="fas fa-save"></i> Kaydet
                                      </button>
                                    </div>
                                  </div>
                                </form>
                              </div>
                            <?php endif; ?>
                          <?php else: ?>
                            <div class="alert alert-warning mt-2 mb-0" style="padding: 8px; font-size: 12px;">
                              <i class="fas fa-exclamation-circle"></i> Satış temsilcisi için araç tanımlanmadığından dolayı km güncelleme formu gösterilmiyor.
                            </div>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>
            </div>
          </div>

          <!-- Card Footer -->
          <div class="card-footer">
            <span class="text-muted">
              <i class="fas fa-info-circle"></i> Toplam <strong><?=($rut_tanimlari) ? count($rut_tanimlari) : "0"?></strong> adet rut planlaması listelenmiştir.
            </span>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
