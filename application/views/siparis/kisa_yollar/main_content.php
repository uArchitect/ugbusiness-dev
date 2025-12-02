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
                  <i class="fas fa-shopping-cart" style="color: #ffffff; font-size: 18px;"></i>
                </div>
                <div>
                  <h3 class="mb-0" style="color: #ffffff; font-weight: 700; font-size: 20px; letter-spacing: 0.5px; line-height: 1.2;">
                    Siparişler Kısa Yolları
                  </h3>
                  <small style="color: rgba(255,255,255,0.9); font-size: 13px; line-height: 1.4;">Sipariş yönetim modülleri</small>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Card Body -->
          <div class="card-body" style="padding: 25px; background-color: #ffffff;">
            <div class="row">
              <!-- Tüm Siparişler Box -->
              <div class="col-md-6 col-lg-3 mb-4">
                <a href="<?=base_url("tum-siparisler")?>" class="siparis-kisa-yol-box" style="text-decoration: none; color: inherit; display: block;">
                  <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; overflow: hidden; transition: all 0.3s ease; cursor: pointer; border-left: 3px solid transparent;">
                    <div class="card-body" style="padding: 20px; background: linear-gradient(135deg, #001657 0%, #001657 100%);">
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center" style="flex: 1;">
                          <div class="rounded-circle d-flex align-items-center justify-content-center mr-3" style="width: 50px; height: 50px; background-color: rgba(255,255,255,0.2);">
                            <i class="fas fa-list-alt" style="color: #ffffff; font-size: 24px;"></i>
                          </div>
                          <div>
                            <h5 class="mb-0" style="color: #ffffff; font-weight: 600; font-size: 16px; letter-spacing: 0.3px;">
                              TÜM SİPARİŞLER
                            </h5>
                            <small style="color: rgba(255,255,255,0.8); font-size: 12px;">Tüm siparişleri görüntüle</small>
                          </div>
                        </div>
                        <div class="ml-3">
                          <i class="fas fa-arrow-right" style="color: rgba(255,255,255,0.7); font-size: 18px;"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
              </div>

              <!-- Onay Bekleyen Siparişler Box -->
              <div class="col-md-6 col-lg-3 mb-4">
                <a href="<?=base_url("onay-bekleyen-siparisler")?>" class="siparis-kisa-yol-box" style="text-decoration: none; color: inherit; display: block;">
                  <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; overflow: hidden; transition: all 0.3s ease; cursor: pointer; border-left: 3px solid transparent;">
                    <div class="card-body" style="padding: 20px; background: linear-gradient(135deg, #001657 0%, #001657 100%);">
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center" style="flex: 1;">
                          <div class="rounded-circle d-flex align-items-center justify-content-center mr-3" style="width: 50px; height: 50px; background-color: rgba(255,255,255,0.2);">
                            <i class="far fa-check-circle" style="color: #ffffff; font-size: 24px;"></i>
                          </div>
                          <div>
                            <h5 class="mb-0" style="color: #ffffff; font-weight: 600; font-size: 16px; letter-spacing: 0.3px;">
                              ONAY BEKLEYENLER
                            </h5>
                            <small style="color: rgba(255,255,255,0.8); font-size: 12px;">Onay bekleyen siparişler</small>
                          </div>
                        </div>
                        <div class="ml-3">
                          <i class="fas fa-arrow-right" style="color: rgba(255,255,255,0.7); font-size: 18px;"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
              </div>

              <!-- Haftalık Kurulum Planı Box -->
              <div class="col-md-6 col-lg-3 mb-4">
                <a href="<?=base_url("siparis/haftalik_kurulum_plan")?>" class="siparis-kisa-yol-box" style="text-decoration: none; color: inherit; display: block;">
                  <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; overflow: hidden; transition: all 0.3s ease; cursor: pointer; border-left: 3px solid transparent;">
                    <div class="card-body" style="padding: 20px; background: linear-gradient(135deg, #001657 0%, #001657 100%);">
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center" style="flex: 1;">
                          <div class="rounded-circle d-flex align-items-center justify-content-center mr-3" style="width: 50px; height: 50px; background-color: rgba(255,255,255,0.2);">
                            <i class="far fa-calendar-alt" style="color: #ffffff; font-size: 24px;"></i>
                          </div>
                          <div>
                            <h5 class="mb-0" style="color: #ffffff; font-weight: 600; font-size: 16px; letter-spacing: 0.3px;">
                              KURULUM PLANI
                            </h5>
                            <small style="color: rgba(255,255,255,0.8); font-size: 12px;">Haftalık kurulum planı</small>
                          </div>
                        </div>
                        <div class="ml-3">
                          <i class="fas fa-arrow-right" style="color: rgba(255,255,255,0.7); font-size: 18px;"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
              </div>

              <!-- Hızlı Sipariş Oluştur Box -->
              <div class="col-md-6 col-lg-3 mb-4">
                <a href="<?=base_url("siparis/hizli_siparis_olustur_view")?>" class="siparis-kisa-yol-box" style="text-decoration: none; color: inherit; display: block;">
                  <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; overflow: hidden; transition: all 0.3s ease; cursor: pointer; border-left: 3px solid transparent;">
                    <div class="card-body" style="padding: 20px; background: linear-gradient(135deg, #001657 0%, #001657 100%);">
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center" style="flex: 1;">
                          <div class="rounded-circle d-flex align-items-center justify-content-center mr-3" style="width: 50px; height: 50px; background-color: rgba(255,255,255,0.2);">
                            <i class="fa fa-plus" style="color: #ffc107; font-size: 24px;"></i>
                          </div>
                          <div>
                            <h5 class="mb-0" style="color: #ffffff; font-weight: 600; font-size: 16px; letter-spacing: 0.3px;">
                              HIZLI SİPARİŞ
                            </h5>
                            <small style="color: rgba(255,255,255,0.8); font-size: 12px;">Hızlı sipariş oluştur</small>
                          </div>
                        </div>
                        <div class="ml-3">
                          <i class="fas fa-arrow-right" style="color: rgba(255,255,255,0.7); font-size: 18px;"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
              </div>

              <!-- İptal Edilen Siparişler Box -->
              <div class="col-md-6 col-lg-3 mb-4">
                <a href="<?=base_url("cihaz/iptal_edilen_siparisler")?>" class="siparis-kisa-yol-box" style="text-decoration: none; color: inherit; display: block;">
                  <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; overflow: hidden; transition: all 0.3s ease; cursor: pointer; border-left: 3px solid transparent;">
                    <div class="card-body" style="padding: 20px; background: linear-gradient(135deg, #001657 0%, #001657 100%);">
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center" style="flex: 1;">
                          <div class="rounded-circle d-flex align-items-center justify-content-center mr-3" style="width: 50px; height: 50px; background-color: rgba(255,255,255,0.2);">
                            <i class="fas fa-ban" style="color: #dc3545; font-size: 24px;"></i>
                          </div>
                          <div>
                            <h5 class="mb-0" style="color: #ffffff; font-weight: 600; font-size: 16px; letter-spacing: 0.3px;">
                              İPTAL EDİLENLER
                            </h5>
                            <small style="color: rgba(255,255,255,0.8); font-size: 12px;">İptal edilen siparişler</small>
                          </div>
                        </div>
                        <div class="ml-3">
                          <i class="fas fa-arrow-right" style="color: rgba(255,255,255,0.7); font-size: 18px;"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
              </div>

              <!-- SMS Sonuçları Box -->
              <div class="col-md-6 col-lg-3 mb-4">
                <a href="<?=base_url("siparis/degerlendirme_rapor")?>" class="siparis-kisa-yol-box" style="text-decoration: none; color: inherit; display: block;">
                  <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; overflow: hidden; transition: all 0.3s ease; cursor: pointer; border-left: 3px solid transparent;">
                    <div class="card-body" style="padding: 20px; background: linear-gradient(135deg, #001657 0%, #001657 100%);">
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center" style="flex: 1;">
                          <div class="rounded-circle d-flex align-items-center justify-content-center mr-3" style="width: 50px; height: 50px; background-color: rgba(255,255,255,0.2);">
                            <i class="fa fa-envelope" style="color: #ffffff; font-size: 24px;"></i>
                          </div>
                          <div>
                            <h5 class="mb-0" style="color: #ffffff; font-weight: 600; font-size: 16px; letter-spacing: 0.3px;">
                              SMS SONUÇLARI
                            </h5>
                            <small style="color: rgba(255,255,255,0.8); font-size: 12px;">SMS değerlendirme raporu</small>
                          </div>
                        </div>
                        <div class="ml-3">
                          <i class="fas fa-arrow-right" style="color: rgba(255,255,255,0.7); font-size: 18px;"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<style>
  .siparis-kisa-yol-box .card {
    transition: all 0.3s ease;
  }

  .siparis-kisa-yol-box .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 22, 87, 0.3) !important;
    border-left-color: #ffc107 !important;
  }

  .siparis-kisa-yol-box .card:hover .rounded-circle {
    background-color: rgba(255,255,255,0.3) !important;
    transform: scale(1.1);
    transition: all 0.3s ease;
  }

  .siparis-kisa-yol-box .card:hover .fa-arrow-right {
    color: #ffc107 !important;
    transform: translateX(5px);
    transition: all 0.3s ease;
  }

  /* Responsive düzenlemeler */
  @media (max-width: 768px) {
    .siparis-kisa-yol-box .card-body {
      padding: 15px !important;
    }
    
    .siparis-kisa-yol-box h5 {
      font-size: 14px !important;
    }
    
    .siparis-kisa-yol-box .rounded-circle {
      width: 40px !important;
      height: 40px !important;
    }
    
    .siparis-kisa-yol-box .rounded-circle i {
      font-size: 20px !important;
    }
  }
</style>

