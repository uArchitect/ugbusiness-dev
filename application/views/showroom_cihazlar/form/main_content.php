 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top: 25px; background-color: #f8f9fa;"> 
  <section class="content pr-0">
    <div class="row">
      <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden; margin-bottom: 30px;">
          <!-- Card Header -->
          <div class="card-header border-0" style="background: linear-gradient(135deg, #001657 0%, #001657 100%); padding: 18px 25px;">
            <div class="d-flex align-items-center">
              <div class="rounded-circle d-flex align-items-center justify-content-center mr-3" style="width: 40px; height: 40px; background-color: rgba(255,255,255,0.2);">
                <i class="fas <?=isset($guncellenecekcihaz) ? 'fa-edit' : 'fa-plus-circle'?>" style="color: #ffffff; font-size: 18px;"></i>
              </div>
              <div>
                <h3 class="mb-0" style="color: #ffffff; font-weight: 700; font-size: 20px; letter-spacing: 0.5px; line-height: 1.2;">
                  <?=isset($guncellenecekcihaz) ? "BİLGİLERİ GÜNCELLE" : "YENİ KAYIT EKLE"?>
                </h3>
                <small style="color: rgba(255,255,255,0.9); font-size: 13px; line-height: 1.4;">
                  <?=isset($guncellenecekcihaz) ? "Showroom cihaz bilgilerini güncelleyin" : "Yeni showroom cihaz kaydı oluşturun"?>
                </small>
              </div>
            </div>
          </div>
          
          <!-- Card Body -->
          <div class="card-body" style="padding: 30px; background-color: #ffffff;">
            <?php 
            if(isset($guncellenecekcihaz)){
              ?>
              <form action="<?=base_url("cihaz/showroom_guncelle/$guncellenecekcihaz->showroom_cihaz_id")?>" method="post"> 
                <div class="row">
                  <div class="col-md-3 mb-3">
                    <label class="form-label-modern">
                      <i class="fas fa-store text-primary mr-2"></i>
                      Showroom <span class="text-danger">*</span>
                    </label>
                    <select class="form-control form-control-modern" name="showroom_cihaz_bolum_no" id="showroom_bolum_update" required> 
                      <option <?=$guncellenecekcihaz->showroom_cihaz_bolum_no == 1 ? "selected":""?> value="1">ADANA SHOWROOM</option>
                      <option <?=$guncellenecekcihaz->showroom_cihaz_bolum_no == 2 ? "selected":""?> value="2">İSTANBUL SHOWROOM</option>
                      <option <?=$guncellenecekcihaz->showroom_cihaz_bolum_no == 3 ? "selected":""?> value="3">ANKARA SHOWROOM</option>
                    </select>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label class="form-label-modern">
                      <i class="fas fa-box text-primary mr-2"></i>
                      Ürün <span class="text-danger">*</span>
                    </label>
                    <select class="form-control form-control-modern" name="showroom_cihaz_urun_no" id="urun_update" required> 
                      <option <?=$guncellenecekcihaz->showroom_cihaz_urun_no == 8 ? "selected":""?> value="8">UMEX PLUS</option>
                      <option <?=$guncellenecekcihaz->showroom_cihaz_urun_no == 1 ? "selected":""?> value="1">UMEX LAZER</option>
                      <option <?=$guncellenecekcihaz->showroom_cihaz_urun_no == 2 ? "selected":""?> value="2">UMEX DIODE</option>
                      <option <?=$guncellenecekcihaz->showroom_cihaz_urun_no == 3 ? "selected":""?> value="3">UMEX EMS</option>
                      <option <?=$guncellenecekcihaz->showroom_cihaz_urun_no == 4 ? "selected":""?> value="4">UMEX GOLD</option>
                      <option <?=$guncellenecekcihaz->showroom_cihaz_urun_no == 5 ? "selected":""?> value="5">UMEX SLIM</option>
                      <option <?=$guncellenecekcihaz->showroom_cihaz_urun_no == 6 ? "selected":""?> value="6">UMEX S</option>
                      <option <?=$guncellenecekcihaz->showroom_cihaz_urun_no == 7 ? "selected":""?> value="7">UMEX Q</option>
                    </select>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label class="form-label-modern">
                      <i class="fas fa-barcode text-primary mr-2"></i>
                      Seri Numarası <span class="text-danger">*</span>
                    </label>
                    <input type="text" value="<?=$guncellenecekcihaz->showroom_cihaz_seri_no?>" class="form-control form-control-modern" name="showroom_cihaz_seri_no" placeholder="Cihaz Seri Numarasını Giriniz" required>
                  </div>
                  <div class="col-md-3 mb-3 d-flex align-items-end">
                    <div class="w-100 d-flex gap-2">
                      <a href="<?=base_url("cihaz/showroom_urun_sil/$guncellenecekcihaz->showroom_cihaz_id")?>" 
                         class="btn btn-danger-modern flex-fill" 
                         onclick="return confirm('Bu kaydı silmek istediğinizden emin misiniz?');">
                        <i class="fas fa-trash"></i> Sil
                      </a>
                      <button type="submit" class="btn btn-primary-modern flex-fill">
                        <i class="fas fa-save"></i> Kaydet
                      </button>
                    </div>
                  </div>
                </div>
              </form>
              <?php
            } else {
              ?>
              <form action="<?=base_url("cihaz/showroom_kaydet")?>" method="post"> 
                <div class="row">
                  <div class="col-md-3 mb-3">
                    <label class="form-label-modern">
                      <i class="fas fa-store text-primary mr-2"></i>
                      Showroom <span class="text-danger">*</span>
                    </label>
                    <select class="form-control form-control-modern" name="showroom_cihaz_bolum_no" id="showroom_bolum" required>
                      <option value="">Showroom Seçiniz</option>
                      <option value="1">ADANA SHOWROOM</option>
                      <option value="2">İSTANBUL SHOWROOM</option>
                      <option value="3">ANKARA SHOWROOM</option>
                    </select>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label class="form-label-modern">
                      <i class="fas fa-box text-primary mr-2"></i>
                      Ürün <span class="text-danger">*</span>
                    </label>
                    <select class="form-control form-control-modern" name="showroom_cihaz_urun_no" id="urun" required>
                      <option value="">Ürün Seçiniz</option>
                      <option value="8">UMEX PLUS</option>
                      <option value="1">UMEX LAZER</option>
                      <option value="2">UMEX DIODE</option>
                      <option value="3">UMEX EMS</option>
                      <option value="4">UMEX GOLD</option>
                      <option value="5">UMEX SLIM</option>
                      <option value="6">UMEX S</option>
                      <option value="7">UMEX Q</option>
                    </select>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label class="form-label-modern">
                      <i class="fas fa-barcode text-primary mr-2"></i>
                      Seri Numarası <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control form-control-modern" name="showroom_cihaz_seri_no" placeholder="Cihaz Seri Numarasını Giriniz" required>
                  </div>
                  <div class="col-md-2 mb-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary-modern w-100">
                      <i class="fas fa-save"></i> Kaydet
                    </button>
                  </div>
                </div>
              </form>
              <?php
            }
            ?>
          </div>
        </div>
      </div>
    </div>

    <!-- Showroom Listeleri -->
    <div class="row">
      <section class="content col-md-4 mb-4">
        <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
          <div class="card-header border-0" style="background: linear-gradient(135deg, #001657 0%, #001657 100%); padding: 15px 20px;">
            <div class="d-flex align-items-center">
              <div class="rounded-circle d-flex align-items-center justify-content-center mr-2" style="width: 35px; height: 35px; background-color: rgba(255,255,255,0.2);">
                <i class="fas fa-map-marker-alt" style="color: #ffffff; font-size: 16px;"></i>
              </div>
              <h3 class="card-title mb-0" style="color: #ffffff; font-weight: 700; font-size: 18px;">ADANA SHOWROOM</h3>
            </div>
          </div>
          <div class="card-body" style="padding: 20px; background-color: #ffffff; min-height: 400px;">
            <?php 
            $adanaCount = 0;
            foreach ($cihazlar as $urun) { 
              if($urun->showroom_cihaz_bolum_no != 1){
                continue;
              }
              $adanaCount++;
              ?>
              <a href="<?=base_url("cihaz/showrooms/$urun->showroom_cihaz_id")?>" class="showroom-item-link">
                <div class="showroom-item">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <img src="<?="https://www.umex.com.tr/uploads/products/".$urun->urun_slug.".png"?>" 
                           alt="<?=$urun->urun_adi?>" 
                           class="showroom-item-img">
                    </div>
                    <div class="col">
                      <div class="showroom-item-content">
                        <h5 class="showroom-item-title"><?=$urun->urun_adi?></h5>
                        <p class="showroom-item-serial">
                          <i class="fas fa-barcode mr-1"></i>
                          Seri No: <strong><?= $urun->showroom_cihaz_seri_no?></strong>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
              <?php
            }
            if($adanaCount == 0) {
              ?>
              <div class="text-center py-5">
                <i class="fas fa-inbox" style="color: #adb5bd; font-size: 48px;"></i>
                <p class="text-muted mt-3 mb-0">Henüz cihaz kaydı bulunmamaktadır.</p>
              </div>
              <?php
            }
            ?>
          </div>
        </div>
      </section>

      <section class="content col-md-4 mb-4">
        <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
          <div class="card-header border-0" style="background: linear-gradient(135deg, #001657 0%, #001657 100%); padding: 15px 20px;">
            <div class="d-flex align-items-center">
              <div class="rounded-circle d-flex align-items-center justify-content-center mr-2" style="width: 35px; height: 35px; background-color: rgba(255,255,255,0.2);">
                <i class="fas fa-map-marker-alt" style="color: #ffffff; font-size: 16px;"></i>
              </div>
              <h3 class="card-title mb-0" style="color: #ffffff; font-weight: 700; font-size: 18px;">İSTANBUL SHOWROOM</h3>
            </div>
          </div>
          <div class="card-body" style="padding: 20px; background-color: #ffffff; min-height: 400px;">
            <?php 
            $istanbulCount = 0;
            foreach ($cihazlar as $urun) { 
              if($urun->showroom_cihaz_bolum_no != 2){
                continue;
              }
              $istanbulCount++;
              ?>
              <a href="<?=base_url("cihaz/showrooms/$urun->showroom_cihaz_id")?>" class="showroom-item-link">
                <div class="showroom-item">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <img src="<?="https://www.umex.com.tr/uploads/products/".$urun->urun_slug.".png"?>" 
                           alt="<?=$urun->urun_adi?>" 
                           class="showroom-item-img">
                    </div>
                    <div class="col">
                      <div class="showroom-item-content">
                        <h5 class="showroom-item-title"><?=$urun->urun_adi?></h5>
                        <p class="showroom-item-serial">
                          <i class="fas fa-barcode mr-1"></i>
                          Seri No: <strong><?= $urun->showroom_cihaz_seri_no?></strong>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
              <?php
            }
            if($istanbulCount == 0) {
              ?>
              <div class="text-center py-5">
                <i class="fas fa-inbox" style="color: #adb5bd; font-size: 48px;"></i>
                <p class="text-muted mt-3 mb-0">Henüz cihaz kaydı bulunmamaktadır.</p>
              </div>
              <?php
            }
            ?>
          </div>
        </div>
      </section>

      <section class="content col-md-4 mb-4">
        <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
          <div class="card-header border-0" style="background: linear-gradient(135deg, #001657 0%, #001657 100%); padding: 15px 20px;">
            <div class="d-flex align-items-center">
              <div class="rounded-circle d-flex align-items-center justify-content-center mr-2" style="width: 35px; height: 35px; background-color: rgba(255,255,255,0.2);">
                <i class="fas fa-map-marker-alt" style="color: #ffffff; font-size: 16px;"></i>
              </div>
              <h3 class="card-title mb-0" style="color: #ffffff; font-weight: 700; font-size: 18px;">ANKARA SHOWROOM</h3>
            </div>
          </div>
          <div class="card-body" style="padding: 20px; background-color: #ffffff; min-height: 400px;">
            <?php 
            $ankaraCount = 0;
            foreach ($cihazlar as $urun) { 
              if($urun->showroom_cihaz_bolum_no != 3){
                continue;
              }
              $ankaraCount++;
              ?>
              <a href="<?=base_url("cihaz/showrooms/$urun->showroom_cihaz_id")?>" class="showroom-item-link">
                <div class="showroom-item">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <img src="<?="https://www.umex.com.tr/uploads/products/".$urun->urun_slug.".png"?>" 
                           alt="<?=$urun->urun_adi?>" 
                           class="showroom-item-img">
                    </div>
                    <div class="col">
                      <div class="showroom-item-content">
                        <h5 class="showroom-item-title"><?=$urun->urun_adi?></h5>
                        <p class="showroom-item-serial">
                          <i class="fas fa-barcode mr-1"></i>
                          Seri No: <strong><?= $urun->showroom_cihaz_seri_no?></strong>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
              <?php
            }
            if($ankaraCount == 0) {
              ?>
              <div class="text-center py-5">
                <i class="fas fa-inbox" style="color: #adb5bd; font-size: 48px;"></i>
                <p class="text-muted mt-3 mb-0">Henüz cihaz kaydı bulunmamaktadır.</p>
              </div>
              <?php
            }
            ?>
          </div>
        </div>
      </section>
    </div>
  </section>
</div>

<style>
  /* Modern Form Stilleri */
  .form-label-modern {
    display: block;
    font-weight: 600;
    color: #495057;
    margin-bottom: 0.5rem;
    font-size: 14px;
    letter-spacing: 0.3px;
  }

  .form-control-modern {
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    padding: 12px 16px;
    font-size: 14px;
    transition: all 0.3s ease;
    background-color: #ffffff;
    width: 100%;
  }

  .form-control-modern:focus {
    border-color: #001657;
    box-shadow: 0 0 0 0.2rem rgba(0, 22, 87, 0.15);
    outline: none;
  }

  .form-control-modern::placeholder {
    color: #adb5bd;
    font-style: italic;
  }

  /* Modern Butonlar */
  .btn-primary-modern {
    background: linear-gradient(135deg, #001657 0%, #001657 100%);
    border: none;
    color: #ffffff;
    padding: 12px 24px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px rgba(0, 22, 87, 0.2);
  }

  .btn-primary-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 22, 87, 0.3);
    background: linear-gradient(135deg, #002080 0%, #001657 100%);
    color: #ffffff;
  }

  .btn-primary-modern:active {
    transform: translateY(0);
  }

  .btn-danger-modern {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    border: none;
    color: #ffffff;
    padding: 12px 24px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px rgba(220, 53, 69, 0.2);
  }

  .btn-danger-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
    background: linear-gradient(135deg, #c82333 0%, #bd2130 100%);
    color: #ffffff;
  }

  /* Showroom Item Stilleri */
  .showroom-item-link {
    text-decoration: none;
    color: inherit;
    display: block;
    margin-bottom: 15px;
  }

  .showroom-item {
    background: #ffffff;
    border: 2px solid #e0e0e0;
    border-radius: 10px;
    padding: 15px;
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
  }

  .showroom-item:hover {
    border-color: #001657;
    box-shadow: 0 4px 12px rgba(0, 22, 87, 0.15);
    transform: translateY(-2px);
  }

  .showroom-item-img {
    width: 80px;
    height: 80px;
    object-fit: contain;
    border-radius: 8px;
    padding: 5px;
    background: #f8f9fa;
    border: 1px solid #e0e0e0;
  }

  .showroom-item-content {
    padding-left: 10px;
  }

  .showroom-item-title {
    color: #001657;
    font-weight: 700;
    font-size: 16px;
    margin-bottom: 8px;
    line-height: 1.3;
  }

  .showroom-item-serial {
    color: #6c757d;
    font-size: 13px;
    margin-bottom: 0;
    line-height: 1.4;
  }

  .showroom-item-serial strong {
    color: #495057;
    font-weight: 600;
  }

  .gap-2 {
    gap: 10px;
  }

  /* Responsive Düzenlemeler */
  @media (max-width: 992px) {
    .col-md-4 {
      margin-bottom: 20px;
    }
  }

  @media (max-width: 768px) {
    .card-body {
      padding: 20px !important;
    }

    .form-label-modern {
      font-size: 13px;
    }

    .form-control-modern {
      padding: 10px 14px;
      font-size: 13px;
    }

    .btn-primary-modern,
    .btn-danger-modern {
      padding: 10px 20px;
      font-size: 13px;
    }

    .showroom-item {
      padding: 12px;
    }

    .showroom-item-img {
      width: 60px;
      height: 60px;
    }

    .showroom-item-title {
      font-size: 14px;
    }

    .showroom-item-serial {
      font-size: 12px;
    }
  }

  /* Card Header Icon Animasyonu */
  .card-header .rounded-circle {
    transition: all 0.3s ease;
  }

  .card-header:hover .rounded-circle {
    transform: rotate(5deg);
    background-color: rgba(255,255,255,0.3) !important;
  }
</style>