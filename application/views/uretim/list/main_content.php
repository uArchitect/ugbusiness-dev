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
                  <i class="fas fa-calendar-alt card-header-icon"></i>
                </div>
                <div>
                  <h3 class="mb-0 card-header-title">
                    Üretim Planlama
                  </h3>
                  <small class="card-header-subtitle">Üretim planları ve takvim görünümü</small>
                </div>
              </div>
              <a href="<?=base_url("uretim_planlama/add")?>" onclick="waiting('Yeni Üretim Planı Ekle');" type="button" class="btn btn-light btn-sm">
                <i class="fa fa-plus"></i> Yeni Kayıt Ekle
              </a>
            </div>
          </div>
          
          <!-- Modern Tab Navigation Bar -->
          <?php $this->load->view('uretim/includes/tabs'); ?>
          
          <!-- Card Body -->
          <div class="card-body card-body-uretim">
            <div class="card-body-content" style="padding: 15px;">
              <!-- Takvim Görünümü -->
              <?php if($this->session->userdata('aktif_kullanici_id') == 1 || $this->session->userdata('aktif_kullanici_id') == 9 || $this->session->userdata('aktif_kullanici_id') == 37 || $this->session->userdata('aktif_kullanici_id') == 8): ?>
                
                <!-- Bu Hafta -->
                <div class="mb-3">
                  <h4 class="mb-2" style="color: #001657; font-weight: 600; font-size: 16px;">
                    <i class="fas fa-calendar-week mr-2"></i> Bu Hafta - <?=date("d.m.Y")?>
                    <span id="saat" style="font-size: 14px; margin-left: 10px; color: #6b7280;"></span>
                  </h4>
                  
                  <script>
                  function saatiGuncelle() {
                    const now = new Date();
                    const saat = now.getHours().toString().padStart(2, '0');
                    const dakika = now.getMinutes().toString().padStart(2, '0');
                    const saniye = now.getSeconds().toString().padStart(2, '0');
                    const saatElement = document.getElementById('saat');
                    if(saatElement) {
                      saatElement.innerText = `${saat}:${dakika}:${saniye}`;
                    }
                  }
                  saatiGuncelle();
                  setInterval(saatiGuncelle, 1000);
                  </script>
                  
                  <?php
                  $gunler[0]["gun"] = "PAZARTESİ";
                  $gunler[0]["data"] = $d1; 
                  $gunler[1]["gun"] = "SALI";
                  $gunler[1]["data"] = $d2; 
                  $gunler[2]["gun"] = "ÇARŞAMBA";
                  $gunler[2]["data"] = $d3; 
                  $gunler[3]["gun"] = "PERŞEMBE";
                  $gunler[3]["data"] = $d4; 
                  $gunler[4]["gun"] = "CUMA";
                  $gunler[4]["data"] = $d5; 
                  ?>
                  
                  <div class="row" style="margin-left: -5px; margin-right: -5px;">
                    <?php foreach ($gunler as $g): ?>
                      <div class="col-md-2 col-sm-6 mb-2" style="padding-left: 5px; padding-right: 5px;">
                        <div class="card" style="border: 1px solid #e5e7eb; border-radius: 6px; height: 100%;">
                          <div class="card-header text-center" style="background: #001657; color: white; padding: 6px 8px;">
                            <b style="font-size: 11px;"><?=$g["gun"]?></b><br>
                            <small style="font-size: 10px;"><?=$g["data"]?></small>
                          </div>
                          <div class="card-body" style="padding: 8px; min-height: 150px; max-height: 400px; overflow-y: auto;">
                            <?php 
                            $gunKayitlari = [];
                            foreach ($data as $d) {
                              if(date("Y-m-d",strtotime($d->uretim_tarihi)) == date("Y-m-d",strtotime($g["data"]))) {
                                $gunKayitlari[] = $d;
                              }
                            }
                            ?>
                            
                            <?php if(empty($gunKayitlari)): ?>
                              <p class="text-muted text-center" style="font-size: 12px; margin-top: 20px;">Kayıt yok</p>
                            <?php else: ?>
                              <?php foreach ($gunKayitlari as $d): ?>
                                <div class="mb-2" style="border: 1px solid #d1d5db; border-radius: 5px; padding: 8px; background: #f9fafb;">
                                  <a href="<?=base_url("uretim_planlama/edit/$d->uretim_planlama_id")?>" style="text-decoration: none; color: #001657;">
                                    <b style="font-size: 11px; display: block; margin-bottom: 3px;">
                                      <?=$d->urun_adi?> / <?=($d->renk_adi == "Umex Grisi")?"Gri":$d->renk_adi?>
                                    </b>
                                  </a>
                                  <?php if($d->kayit_notu != ""): ?>
                                    <span class="badge badge-success" style="font-size: 10px; padding: 2px 5px; margin-bottom: 3px; display: block;">
                                      <?=$d->kayit_notu?>
                                    </span>
                                  <?php endif; ?>
                                  <div style="font-size: 10px; color: #6b7280; margin-bottom: 3px;">
                                    <?=$d->baslik_bilgisi?>
                                  </div>
                                  <?php if($d->guncelleme_notu != ""): ?>
                                    <div style="font-size: 9px; color: #dc2626; margin-bottom: 3px;">
                                      <?=$d->guncelleme_notu?>
                                    </div>
                                  <?php endif; ?>
                                  <a type="button" onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu kaydı silmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Onayla','<?=base_url('uretim_planlama/delete/').$d->uretim_planlama_id?>');" 
                                     class="btn btn-danger btn-xs" style="font-size: 10px; padding: 2px 5px; width: 100%;">
                                    <i class="fa fa-times"></i> Sil
                                  </a>
                                </div>
                              <?php endforeach; ?>
                            <?php endif; ?>
                            
                            <a href="<?=base_url("uretim_planlama/add?date=".$g["data"])?>" 
                               class="btn btn-sm btn-outline-success" 
                               style="width: 100%; margin-top: 5px; font-size: 11px; padding: 5px;">
                              <i class="fas fa-plus-circle"></i> Yeni Ekle
                            </a>
                          </div>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>
                
                <!-- Sonraki Hafta -->
                <div class="mb-3">
                  <h4 class="mb-2" style="color: #001657; font-weight: 600; font-size: 16px;">
                    <i class="fas fa-calendar-alt mr-2"></i> Sonraki Hafta
                  </h4>
                  
                  <?php
                  $gunler1[0]["gun"] = "PAZARTESİ";
                  $gunler1[0]["data"] = $d7; 
                  $gunler1[1]["gun"] = "SALI";
                  $gunler1[1]["data"] = $d8; 
                  $gunler1[2]["gun"] = "ÇARŞAMBA";
                  $gunler1[2]["data"] = $d9; 
                  $gunler1[3]["gun"] = "PERŞEMBE";
                  $gunler1[3]["data"] = $d10; 
                  $gunler1[4]["gun"] = "CUMA";
                  $gunler1[4]["data"] = $d11; 
                  ?>
                  
                  <div class="row" style="margin-left: -5px; margin-right: -5px;">
                    <?php foreach ($gunler1 as $g): ?>
                      <div class="col-md-2 col-sm-6 mb-2" style="padding-left: 5px; padding-right: 5px;">
                        <div class="card" style="border: 1px solid #e5e7eb; border-radius: 6px; height: 100%;">
                          <div class="card-header text-center" style="background: #6b7280; color: white; padding: 6px 8px;">
                            <b style="font-size: 11px;"><?=$g["gun"]?></b><br>
                            <small style="font-size: 10px;"><?=$g["data"]?></small>
                          </div>
                          <div class="card-body" style="padding: 8px; min-height: 150px; max-height: 400px; overflow-y: auto;">
                            <?php 
                            $gunKayitlari = [];
                            foreach ($data as $d) {
                              if(date("Y-m-d",strtotime($d->uretim_tarihi)) == date("Y-m-d",strtotime($g["data"]))) {
                                $gunKayitlari[] = $d;
                              }
                            }
                            ?>
                            
                            <?php if(empty($gunKayitlari)): ?>
                              <p class="text-muted text-center" style="font-size: 12px; margin-top: 20px;">Kayıt yok</p>
                            <?php else: ?>
                              <?php foreach ($gunKayitlari as $d): ?>
                                <div class="mb-2" style="border: 1px solid #d1d5db; border-radius: 5px; padding: 8px; background: #f9fafb;">
                                  <a href="<?=base_url("uretim_planlama/edit/$d->uretim_planlama_id")?>" style="text-decoration: none; color: #001657;">
                                    <b style="font-size: 11px; display: block; margin-bottom: 3px;">
                                      <?=$d->urun_adi?> / <?=($d->renk_adi == "Umex Grisi")?"Gri":$d->renk_adi?>
                                    </b>
                                  </a>
                                  <?php if($d->kayit_notu != ""): ?>
                                    <span class="badge badge-success" style="font-size: 10px; padding: 2px 5px; margin-bottom: 3px; display: block;">
                                      <?=$d->kayit_notu?>
                                    </span>
                                  <?php endif; ?>
                                  <div style="font-size: 10px; color: #6b7280; margin-bottom: 3px;">
                                    <?=$d->baslik_bilgisi?>
                                  </div>
                                  <?php if($d->guncelleme_notu != ""): ?>
                                    <div style="font-size: 9px; color: #dc2626; margin-bottom: 3px;">
                                      <?=$d->guncelleme_notu?>
                                    </div>
                                  <?php endif; ?>
                                  <a type="button" onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu kaydı silmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Onayla','<?=base_url('uretim_planlama/delete/').$d->uretim_planlama_id?>');" 
                                     class="btn btn-danger btn-xs" style="font-size: 10px; padding: 2px 5px; width: 100%;">
                                    <i class="fa fa-times"></i> Sil
                                  </a>
                                </div>
                              <?php endforeach; ?>
                            <?php endif; ?>
                            
                            <a href="<?=base_url("uretim_planlama/add?date=".$g["data"])?>" 
                               class="btn btn-sm btn-outline-success" 
                               style="width: 100%; margin-top: 5px; font-size: 11px; padding: 5px;">
                              <i class="fas fa-plus-circle"></i> Yeni Ekle
                            </a>
                          </div>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>
                
              <?php endif; ?>
              
              <!-- Tüm Kayıtlar Tablosu -->
              <div class="card mt-3" style="border: 0; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);">
                <div class="card-header" style="background: #001657; color: white; padding: 10px 15px;">
                  <h3 class="card-title mb-0" style="color: white; font-weight: 600; font-size: 16px;">
                    <i class="fas fa-list mr-2"></i> Tüm Üretim Planları
                  </h3>
                </div>
                <div class="card-body" style="padding: 10px;">
                  <div class="table-responsive">
                    <table id="example1" class="table table-uretim table-bordered table-striped">
                      <thead>
                        <tr>
                          <th style="width: 42px;">ID</th> 
                          <th>Cihaz Adı</th>
                          <th>Renk</th>
                          <th>Başlık</th>
                          <th style="width: 130px;">Üretim Tarihi</th>
                          <th>Onay</th>
                          <th style="width: 250px;">İşlem</th> 
                        </tr>
                      </thead>
                      <tbody>
                        <?php $count=0; foreach ($uretim_planlar as $uplanv): ?>
                          <?php $count++?>
                          <tr <?=$uplanv->aktif_kayit == 0 ? "style='background:#ffdfdf;'" : ""?>>
                            <td><?=$count?></td> 
                            <td class="<?=($uplanv->aktif_kayit == 1)?"":"text-danger"?>"> 
                              <?=$uplanv->urun_adi?> 
                              <?php if($uplanv->kayit_notu): ?>
                                <span class="badge badge-success"><?=$uplanv->kayit_notu?></span>
                              <?php endif; ?>
                            </td>
                            <td class="<?=($uplanv->aktif_kayit == 1)?"":"text-danger"?>">
                              <?=$uplanv->renk_adi?> 
                            </td>
                            <td class="<?=($uplanv->aktif_kayit == 1)?"":"text-danger"?>"> 
                              <?=$uplanv->baslik_bilgisi?>
                            </td>
                            <td class="<?=($uplanv->aktif_kayit == 1)?"":"text-danger"?>"> 
                              <?=date('d.m.Y',strtotime($uplanv->uretim_tarihi));?>
                            </td>
                            <td> 
                              <?=($uplanv->onay_durumu == 0) ? "<span class='badge badge-danger'>Onay Bekleniyor</span>" : "<span class='badge badge-success'>Onaylandı</span>"?>
                            </td>
                            <td>
                              <?php if($uplanv->aktif_kayit == 1): ?>
                                <?php if($uplanv->onay_durumu == 0): ?>
                                  <a href="<?=site_url("uretim_planlama/onay/$uplanv->uretim_planlama_id")?>" type="button" class="btn btn-success btn-xs">
                                    <i class="fa fa-check" style="font-size:12px"></i> Onayla
                                  </a>
                                <?php else: ?>
                                  <a href="<?=site_url("uretim_planlama/onay_geri/$uplanv->uretim_planlama_id")?>" type="button" class="btn btn-dark btn-xs">
                                    <i class="fas fa-exclamation-circle" style="font-size:12px"></i> Onay İptal
                                  </a>
                                <?php endif; ?>
                                <a href="<?=site_url("uretim_planlama/edit/$uplanv->uretim_planlama_id")?>" type="button" class="btn btn-warning btn-xs">
                                  <i class="fa fa-pen" style="font-size:12px"></i> Düzenle
                                </a>
                                <a type="button" onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu kaydı silmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Onayla','<?=base_url('uretim_planlama/delete/').$uplanv->uretim_planlama_id?>');" 
                                   class="btn btn-danger btn-xs">
                                  <i class="fa fa-times" style="font-size:12px"></i> Sil
                                </a>
                              <?php else: ?>
                                <span class="badge badge-danger">KAYIT SİLİNDİ</span>
                              <?php endif; ?>
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
      </div>
    </div>
  </section>
</div>
