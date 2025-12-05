<?php $this->load->view('envanter/includes/styles'); ?>

<div class="content-wrapper content-wrapper-envanter">
  <section class="content pr-0">
    <div class="row">
      <div class="col-12">
        <div class="card card-envanter">
          <!-- Card Header -->
          <div class="card-header card-header-envanter">
            <div class="d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3 card-header-icon-wrapper">
                  <i class="fas fa-box card-header-icon"></i>
                </div>
                <div>
                  <h3 class="mb-0 card-header-title">
                    Envanter Bilgileri
                  </h3>
                  <small class="card-header-subtitle">Kullanıcıya tanımlanmış olan envanter bilgileri</small>
                </div>
              </div>
              <?php if(goruntuleme_kontrol("demirbas_ekle")): ?>
                <a href="<?=base_url("demirbas/ekle/1")?>" onclick="waiting('Yeni Envanter Ekle');" type="button" class="btn btn-light btn-sm">
                  <i class="fa fa-plus"></i> Yeni Envanter Ekle
                </a>
              <?php endif; ?>
            </div>
          </div>
          
          <!-- Modern Tab Navigation Bar -->
          <?php $this->load->view('envanter/includes/tabs'); ?>
          
          <!-- Card Body -->
          <div class="card-body card-body-envanter">
            <div class="card-body-content">
              <?php if(empty($envanterler)): ?>
                <div class="text-center py-5">
                  <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                  <p class="text-muted">Henüz envanter kaydı bulunmamaktadır.</p>
                  <?php if(goruntuleme_kontrol("demirbas_ekle")): ?>
                    <a href="<?=base_url("demirbas/ekle/1")?>" onclick="waiting('Yeni Envanter Ekle');" class="btn btn-primary">
                      <i class="fa fa-plus"></i> Yeni Envanter Ekle
                    </a>
                  <?php endif; ?>
                </div>
              <?php else: ?>
                <div class="row">
                  <?php foreach ($envanterler as $demirbas): ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                      <div class="card" style="border: 1px solid #e5e7eb; border-radius: 8px; overflow: hidden;">
                        <div class="card-body p-0">
                          <!-- Kategori Görseli -->
                          <div class="text-center p-3" style="background: #f9fafb; border-bottom: 1px solid #e5e7eb;">
                            <?php 
                            $img_url = '';
                            $kategori_adi = '';
                            if($demirbas->kategori_id == 1){
                              $img_url = 'https://m.media-amazon.com/images/I/71s72QE+voL.jpg';
                              $kategori_adi = 'CEP TELEFONU';
                            } elseif($demirbas->kategori_id == 2){
                              $img_url = 'https://cdn.vatanbilgisayar.com/Upload/PRODUCT/lenovo/thumb/147559-1_large.jpg';
                              $kategori_adi = 'TABLET';
                            } elseif($demirbas->kategori_id == 3){
                              $img_url = 'https://yemekkarti.co/sites/yemekkarti.co/files/inline-images/MN_dikey_erkek.png';
                              $kategori_adi = 'MULTINET KART';
                            } elseif($demirbas->kategori_id == 4){
                              $img_url = 'https://cdn.qukasoft.com/f/752658/bzR6WmFtNG0vcUp3ZUdGdEg4MXZKZWxESUE9PQ/p/intel-i3-4n-8gb-120gb-ssd-19-mon-masaustu-bilgisayar-195154728-sw1000sh1000.webp';
                              $kategori_adi = 'LAPTOP / MASAÜSTÜ PC';
                            } elseif($demirbas->kategori_id == 5){
                              $img_url = 'https://www.fotografmania.com/wp-content/uploads/2018/03/n-resm-e1635440611350.jpg';
                              $kategori_adi = 'DEMİRBAŞ';
                            }
                            ?>
                            <img src="<?=$img_url?>" alt="<?=$kategori_adi?>" style="width: 100px; height: 100px; object-fit: contain;" class="rounded">
                          </div>
                          
                          <!-- Envanter Bilgileri -->
                          <div class="p-3">
                            <h5 class="mb-2" style="color: #001657; font-weight: 600; font-size: 16px;">
                              <?php 
                              if($demirbas->kategori_id == 3){
                                echo "MULTINET KART";
                              } else {
                                echo $demirbas->demirbas_marka ? htmlspecialchars($demirbas->demirbas_marka) : 'Marka Belirtilmemiş';
                              }
                              ?>
                            </h5>
                            <p class="text-muted mb-2" style="font-size: 13px;">
                              <i class="fas fa-user mr-1"></i> <?=htmlspecialchars($demirbas->kullanici_ad_soyad)?>
                            </p>
                            <p class="text-muted mb-2" style="font-size: 12px;">
                              <i class="far fa-calendar mr-1"></i> Kayıt: <?=date('d.m.Y H:i',strtotime($demirbas->demirbas_kayit_tarihi))?>
                            </p>
                            
                            <!-- Kategoriye Özel Bilgiler -->
                            <div class="mt-3" style="font-size: 12px;">
                              <?php if($demirbas->kategori_id == 1): ?>
                                <?php if($demirbas->demirbas_telefon_numarasi): ?>
                                  <p class="mb-1"><strong>Telefon:</strong> <?=htmlspecialchars($demirbas->demirbas_telefon_numarasi)?></p>
                                <?php endif; ?>
                                <?php if($demirbas->demirbas_icloud_adres): ?>
                                  <p class="mb-1"><strong>iCloud:</strong> <?=htmlspecialchars($demirbas->demirbas_icloud_adres)?></p>
                                <?php endif; ?>
                                <?php if($demirbas->demirbas_puk_kodu): ?>
                                  <p class="mb-1"><strong>PUK:</strong> <?=htmlspecialchars($demirbas->demirbas_puk_kodu)?></p>
                                <?php endif; ?>
                              <?php elseif($demirbas->kategori_id == 3): ?>
                                <?php if($demirbas->demirbas_multinet_kart_no): ?>
                                  <p class="mb-1"><strong>Kart No:</strong> <?=htmlspecialchars($demirbas->demirbas_multinet_kart_no)?></p>
                                <?php endif; ?>
                                <?php if($demirbas->demirbas_multinet_cvv): ?>
                                  <p class="mb-1"><strong>CVV:</strong> <?=htmlspecialchars($demirbas->demirbas_multinet_cvv)?></p>
                                <?php endif; ?>
                                <?php if($demirbas->demirbas_multinet_bakiye): ?>
                                  <p class="mb-1"><strong>Bakiye:</strong> <?=htmlspecialchars($demirbas->demirbas_multinet_bakiye)?></p>
                                <?php endif; ?>
                              <?php endif; ?>
                            </div>
                            
                            <!-- İşlem Butonları -->
                            <div class="mt-3 pt-3 border-top">
                              <div class="btn-group w-100" role="group">
                                <a href="<?=site_url("demirbas/duzenle/$demirbas->demirbas_id")?>" class="btn btn-warning btn-sm">
                                  <i class="fa fa-pen"></i> Düzenle
                                </a>
                                <a type="button" onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu kaydı silmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Onayla','<?=base_url('demirbas/sil/').$demirbas->demirbas_id?>');" class="btn btn-danger btn-sm">
                                  <i class="fa fa-times"></i> Sil
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
