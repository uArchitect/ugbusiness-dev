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
                    <?=!empty($demirbas) ? 'Envanter Düzenle' : 'Yeni Envanter Ekle'?>
                  </h3>
                  <small class="card-header-subtitle">Envanter bilgilerini giriniz</small>
                </div>
              </div>
              <a href="<?=base_url("demirbas")?>" onclick="waiting('Envanter');" type="button" class="btn btn-light btn-sm">
                <i class="fa fa-arrow-left"></i> Geri Dön
              </a>
            </div>
          </div>
          
          <!-- Modern Tab Navigation Bar -->
          <?php $this->load->view('envanter/includes/tabs'); ?>
          
          <!-- Card Body -->
          <div class="card-body card-body-envanter">
            <div class="card-body-content">
              <?php if(!empty($demirbas)): ?>
                <form class="form-horizontal" id="form-demirbas" enctype="multipart/form-data" method="POST" action="<?php echo site_url('demirbas/save').'/'.$demirbas->demirbas_id;?>">
              <?php else: ?>
                <form class="form-horizontal" id="form-demirbas" enctype="multipart/form-data" method="POST" action="<?php echo site_url('demirbas/save');?>">
              <?php endif; ?>
              
              <!-- Kategori Seçimi -->
              <div class="mb-4">
                <label class="form-label" style="font-weight: 600; color: #001657; margin-bottom: 15px; display: block;">Kategori Seçiniz</label>
                <div class="row">
                  <?php 
                  $kategoriler = [
                    1 => ['url' => !empty($demirbas) ? base_url("demirbas/kategori_duzenle/$demirbas->demirbas_id/1") : base_url("demirbas/ekle/1"), 'img' => 'https://m.media-amazon.com/images/I/71s72QE+voL.jpg', 'label' => 'CEP TELEFONU'],
                    4 => ['url' => !empty($demirbas) ? base_url("demirbas/kategori_duzenle/$demirbas->demirbas_id/4") : base_url("demirbas/ekle/4"), 'img' => 'https://cdn.qukasoft.com/f/752658/bzR6WmFtNG0vcUp3ZUdGdEg4MXZKZWxESUE9PQ/p/intel-i3-4n-8gb-120gb-ssd-19-mon-masaustu-bilgisayar-195154728-sw1000sh1000.webp', 'label' => 'LAPTOP / MASAÜSTÜ PC'],
                    2 => ['url' => !empty($demirbas) ? base_url("demirbas/kategori_duzenle/$demirbas->demirbas_id/2") : base_url("demirbas/ekle/2"), 'img' => 'https://cdn.vatanbilgisayar.com/Upload/PRODUCT/lenovo/thumb/147559-1_large.jpg', 'label' => 'TABLET'],
                    3 => ['url' => !empty($demirbas) ? base_url("demirbas/kategori_duzenle/$demirbas->demirbas_id/3") : base_url("demirbas/ekle/3"), 'img' => 'https://yemekkarti.co/sites/yemekkarti.co/files/inline-images/MN_dikey_erkek.png', 'label' => 'MULTINET KART'],
                    5 => ['url' => !empty($demirbas) ? base_url("demirbas/kategori_duzenle/$demirbas->demirbas_id/5") : base_url("demirbas/ekle/5"), 'img' => 'https://www.fotografmania.com/wp-content/uploads/2018/03/n-resm-e1635440611350.jpg', 'label' => 'DEMİRBAŞ']
                  ];
                  
                  foreach($kategoriler as $kat_id => $kat): 
                    $is_active = $demirbas_secilen_kategori == $kat_id;
                    $onclick = !empty($demirbas) ? "onclick='confirmRedirect(\"".$kat['url']."\"); return false;'" : '';
                  ?>
                    <div class="col-md-4 col-sm-6 mb-3">
                      <a href="<?=!empty($demirbas) ? '#' : $kat['url']?>" <?=$onclick?> class="btn btn-default w-100" style="background:white!important; height: 150px; display: flex; flex-direction: column; align-items: center; justify-content: center; border: 2px solid <?=$is_active ? '#001657' : '#e5e7eb'?>; <?=$is_active ? '' : '-webkit-filter: grayscale(100%); filter: grayscale(100%);'?>">
                        <img src="<?=$kat['img']?>" style="width: 60px; height: 60px; object-fit: contain; margin-bottom: 10px; <?=$is_active ? '' : 'opacity: 0.6;'?>" alt="">
                        <span style="font-size: 12px; font-weight: 500; color: <?=$is_active ? '#001657' : '#6b7280'?>;"><?=$kat['label']?></span>
                      </a>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>

              <script>
              function confirmRedirect(url) {
                if (confirm("Bu envanterin kategorisi değiştirilecektir. İşlemi onaylıyor musunuz?")) {
                  window.location.href = url;
                }
              }
              </script>

              <input type="hidden" value="<?php echo !empty($demirbas) ? $demirbas->kategori_id : $demirbas_secilen_kategori;?>" class="form-control" name="kategori_id" autofocus="">

              <!-- Kategoriye Özel Form Alanları -->
              <?php if($demirbas_secilen_kategori == 1): ?>
                <!-- CEP TELEFONU -->
                <div class="row mb-3">
                  <div class="col-md-6">
                    <label for="demirbas_marka">Telefon Marka - Model <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-mobile-alt"></i></span>
                      </div>
                      <input type="text" value="<?php echo !empty($demirbas) ? $demirbas->demirbas_marka : '';?>" class="form-control" name="demirbas_marka" placeholder="Telefon Markası (Örn: iPhone 15 Plus)" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="demirbas_kullanici_id">Kullanıcı <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                      </div>
                      <select name="demirbas_kullanici_id" class="select2 form-control" style="width: 100%;" required>
                        <option value="">Kullanıcı Seçiniz</option>
                        <?php foreach($kullanicilar as $kullanici): ?>
                          <option value="<?=$kullanici->kullanici_id?>" <?php echo (!empty($demirbas) && $demirbas->demirbas_kullanici_id == $kullanici->kullanici_id) ? 'selected="selected"' : '';?>>
                            <?=$kullanici->kullanici_ad_soyad?> / <?=$kullanici->kullanici_unvan?> / <?=$kullanici->departman_adi?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-6">
                    <label for="demirbas_telefon_numarasi">Telefon Numarası</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-phone"></i></span>
                      </div>
                      <input type="text" value="<?php echo !empty($demirbas) ? $demirbas->demirbas_telefon_numarasi : '';?>" class="form-control" name="demirbas_telefon_numarasi" placeholder="Telefon Numarası">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="demirbas_garanti_bitis_tarihi">Garanti Bitiş Tarihi</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                      </div>
                      <input type="date" value="<?php echo !empty($demirbas) ? date("Y-m-d",strtotime($demirbas->demirbas_garanti_bitis_tarihi)) : date("Y-m-d");?>" class="form-control" name="demirbas_garanti_bitis_tarihi">
                    </div>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-6">
                    <label for="demirbas_pin_kodu">Pin Kodu</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                      </div>
                      <input type="text" value="<?php echo !empty($demirbas) ? $demirbas->demirbas_pin_kodu : '';?>" class="form-control" name="demirbas_pin_kodu" placeholder="Telefon Pin Bilgisini Giriniz">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="demirbas_puk_kodu">Puk Kodu</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                      </div>
                      <input type="text" value="<?php echo !empty($demirbas) ? $demirbas->demirbas_puk_kodu : '';?>" class="form-control" name="demirbas_puk_kodu" placeholder="Telefon Puk Bilgisini Giriniz">
                    </div>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-6">
                    <label for="demirbas_icloud_adres">iCloud Kullanıcı Adı</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                      </div>
                      <input type="text" value="<?php echo !empty($demirbas) ? $demirbas->demirbas_icloud_adres : '';?>" class="form-control" name="demirbas_icloud_adres" placeholder="iCloud Adresini Giriniz">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="demirbas_icloud_sifre">iCloud Şifre</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                      </div>
                      <input type="text" value="<?php echo !empty($demirbas) ? $demirbas->demirbas_icloud_sifre : '';?>" class="form-control" name="demirbas_icloud_sifre" placeholder="iCloud Şifresini Giriniz">
                    </div>
                  </div>
                </div>

              <?php elseif($demirbas_secilen_kategori == 4): ?>
                <!-- LAPTOP / MASAÜSTÜ PC -->
                <div class="row mb-3">
                  <div class="col-md-6">
                    <label for="demirbas_marka">Laptop Marka - Model <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-laptop"></i></span>
                      </div>
                      <input type="text" value="<?php echo !empty($demirbas) ? $demirbas->demirbas_marka : '';?>" class="form-control" name="demirbas_marka" placeholder="Bilgisayar Markası (Örn: HP Victus)" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="demirbas_kullanici_id">Kullanıcı <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                      </div>
                      <select name="demirbas_kullanici_id" class="select2 form-control" style="width: 100%;" required>
                        <option value="">Kullanıcı Seçiniz</option>
                        <?php foreach($kullanicilar as $kullanici): ?>
                          <option value="<?=$kullanici->kullanici_id?>" <?php echo (!empty($demirbas) && $demirbas->demirbas_kullanici_id == $kullanici->kullanici_id) ? 'selected="selected"' : '';?>>
                            <?=$kullanici->kullanici_ad_soyad?> / <?=$kullanici->kullanici_unvan?> / <?=$kullanici->departman_adi?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-12">
                    <label for="demirbas_garanti_bitis_tarihi">Garanti Bitiş Tarihi</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                      </div>
                      <input type="date" value="<?php echo !empty($demirbas) ? date("Y-m-d",strtotime($demirbas->demirbas_garanti_bitis_tarihi)) : date("Y-m-d");?>" class="form-control" name="demirbas_garanti_bitis_tarihi">
                    </div>
                  </div>
                </div>

              <?php elseif($demirbas_secilen_kategori == 2): ?>
                <!-- TABLET -->
                <div class="row mb-3">
                  <div class="col-md-6">
                    <label for="demirbas_marka">Tablet Marka - Model <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-tablet-alt"></i></span>
                      </div>
                      <input type="text" value="<?php echo !empty($demirbas) ? $demirbas->demirbas_marka : '';?>" class="form-control" name="demirbas_marka" placeholder="Bilgisayar Markası (Örn: Lenovo Tab M11)" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="demirbas_kullanici_id">Kullanıcı <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                      </div>
                      <select name="demirbas_kullanici_id" class="select2 form-control" style="width: 100%;" required>
                        <option value="">Kullanıcı Seçiniz</option>
                        <?php foreach($kullanicilar as $kullanici): ?>
                          <option value="<?=$kullanici->kullanici_id?>" <?php echo (!empty($demirbas) && $demirbas->demirbas_kullanici_id == $kullanici->kullanici_id) ? 'selected="selected"' : '';?>>
                            <?=$kullanici->kullanici_ad_soyad?> / <?=$kullanici->kullanici_unvan?> / <?=$kullanici->departman_adi?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-6">
                    <label for="demirbas_tablet_sifresi">Tablet Şifresi</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                      </div>
                      <input type="text" value="<?php echo !empty($demirbas) ? $demirbas->demirbas_tablet_sifresi : '';?>" class="form-control" name="demirbas_tablet_sifresi" placeholder="Tablet Şifresini Giriniz">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="demirbas_garanti_bitis_tarihi">Garanti Bitiş Tarihi</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                      </div>
                      <input type="date" value="<?php echo !empty($demirbas) ? date("Y-m-d",strtotime($demirbas->demirbas_garanti_bitis_tarihi)) : date("Y-m-d");?>" class="form-control" name="demirbas_garanti_bitis_tarihi">
                    </div>
                  </div>
                </div>

              <?php elseif($demirbas_secilen_kategori == 3): ?>
                <!-- MULTINET KART -->
                <div class="row mb-3">
                  <div class="col-md-6">
                    <label for="demirbas_multinet_kart_no">Multinet Kart No</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-credit-card"></i></span>
                      </div>
                      <input type="text" value="<?php echo !empty($demirbas) ? $demirbas->demirbas_multinet_kart_no : '665690001280';?>" class="form-control" name="demirbas_multinet_kart_no" placeholder="Multinet Kart Numarası Giriniz">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="demirbas_kullanici_id">Kullanıcı <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                      </div>
                      <select name="demirbas_kullanici_id" class="select2 form-control" style="width: 100%;" required>
                        <option value="">Kullanıcı Seçiniz</option>
                        <?php foreach($kullanicilar as $kullanici): ?>
                          <option value="<?=$kullanici->kullanici_id?>" <?php echo (!empty($demirbas) && $demirbas->demirbas_kullanici_id == $kullanici->kullanici_id) ? 'selected="selected"' : '';?>>
                            <?=$kullanici->kullanici_ad_soyad?> / <?=$kullanici->kullanici_unvan?> / <?=$kullanici->departman_adi?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-4">
                    <label for="demirbas_multinet_bakiye">Multinet Kart Bakiyesi</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-lira-sign"></i></span>
                      </div>
                      <input type="text" value="<?php echo !empty($demirbas) ? $demirbas->demirbas_multinet_bakiye : '';?>" class="form-control" name="demirbas_multinet_bakiye" placeholder="Kart Bakiyesi Giriniz">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <label for="demirbas_multinet_cvv">Multinet Kart CVV</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-credit-card"></i></span>
                      </div>
                      <input type="text" value="<?php echo !empty($demirbas) ? $demirbas->demirbas_multinet_cvv : '';?>" class="form-control" name="demirbas_multinet_cvv" placeholder="Kart CVV Giriniz">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <label for="demirbas_multinet_kart_gecerlilik_tarihi">Kart Son Kullanma Tarihi</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                      </div>
                      <input type="date" value="<?php echo !empty($demirbas) ? date("Y-m-d",strtotime($demirbas->demirbas_multinet_kart_gecerlilik_tarihi)) : date("Y-m-d");?>" class="form-control" name="demirbas_multinet_kart_gecerlilik_tarihi">
                    </div>
                  </div>
                </div>

              <?php elseif($demirbas_secilen_kategori == 5): ?>
                <!-- DEMİRBAŞ -->
                <div class="row mb-3">
                  <div class="col-md-6">
                    <label for="demirbas_marka">Marka - Model <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-box"></i></span>
                      </div>
                      <input type="text" value="<?php echo !empty($demirbas) ? $demirbas->demirbas_marka : '';?>" class="form-control" name="demirbas_marka" placeholder="Marka Model Bilgisi Giriniz" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="demirbas_kullanici_id">Kullanıcı <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                      </div>
                      <select name="demirbas_kullanici_id" class="select2 form-control" style="width: 100%;" required>
                        <option value="">Kullanıcı Seçiniz</option>
                        <?php foreach($kullanicilar as $kullanici): ?>
                          <option value="<?=$kullanici->kullanici_id?>" <?php echo (!empty($demirbas) && $demirbas->demirbas_kullanici_id == $kullanici->kullanici_id) ? 'selected="selected"' : '';?>>
                            <?=$kullanici->kullanici_ad_soyad?> / <?=$kullanici->kullanici_unvan?> / <?=$kullanici->departman_adi?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
              <?php endif; ?>

              <!-- Açıklama -->
              <div class="row mb-3">
                <div class="col-md-12">
                  <label for="demirbas_aciklama">Cihaz Açıklama</label>
                  <textarea name="demirbas_aciklama" id="summernote5" class="form-control" rows="3" placeholder="Açıklama giriniz..."><?php echo !empty($demirbas) ? $demirbas->demirbas_aciklama : '';?></textarea>
                </div>
              </div>

              <!-- Form Footer -->
              <div class="row mt-4 pt-3 border-top">
                <div class="col-md-12 d-flex justify-content-end">
                  <a href="<?=base_url("demirbas")?>" onclick="waiting('Envanter');" class="btn btn-secondary mr-2">
                    <i class="fa fa-times"></i> İptal
                  </a>
                  <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i> Kaydet
                  </button>
                </div>
              </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
