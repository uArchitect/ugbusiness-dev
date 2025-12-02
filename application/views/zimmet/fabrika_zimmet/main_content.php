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
                  <i class="fas fa-charging-station" style="color: #ffffff; font-size: 18px;"></i>
                </div>
                <div>
                  <h3 class="mb-0" style="color: #ffffff; font-weight: 700; font-size: 20px; letter-spacing: 0.5px; line-height: 1.2;">
                    Fabrika Zimmet
                  </h3>
                  <small style="color: rgba(255,255,255,0.9); font-size: 13px; line-height: 1.4;">Zimmet yönetim modülleri</small>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Card Body -->
          <div class="card-body" style="padding: 25px; background-color: #ffffff;">
            <div class="row">
              <!-- Envanter / Zimmet Box -->
              <div class="col-md-6 col-lg-3 mb-4">
                <a href="<?=base_url("zimmet")?>" class="fabrika-zimmet-module-box" style="text-decoration: none; color: inherit; display: block;">
                  <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; overflow: hidden; transition: all 0.3s ease; cursor: pointer; border-left: 3px solid transparent;">
                    <div class="card-body" style="padding: 20px; background: linear-gradient(135deg, #001657 0%, #001657 100%);">
                      <div class="d-flex align-items-center">
                        <div class="rounded-circle d-flex align-items-center justify-content-center mr-3" style="width: 50px; height: 50px; background-color: rgba(255,255,255,0.2);">
                          <i class="fas fa-boxes" style="color: #ffffff; font-size: 24px;"></i>
                        </div>
                        <div>
                          <h5 class="mb-0" style="color: #ffffff; font-weight: 600; font-size: 16px; letter-spacing: 0.3px;">
                            ENVANTER / ZİMMET
                          </h5>
                          <small style="color: rgba(255,255,255,0.8); font-size: 12px;">Envanter ve zimmet yönetimi</small>
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
              </div>

              <!-- Servis Dağıtım Box -->
              <div class="col-md-6 col-lg-3 mb-4">
                <a href="<?=base_url("zimmet/dagitim/2")?>" class="fabrika-zimmet-module-box" style="text-decoration: none; color: inherit; display: block;">
                  <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; overflow: hidden; transition: all 0.3s ease; cursor: pointer; border-left: 3px solid transparent;">
                    <div class="card-body" style="padding: 20px; background: linear-gradient(135deg, #001657 0%, #001657 100%);">
                      <div class="d-flex align-items-center">
                        <div class="rounded-circle d-flex align-items-center justify-content-center mr-3" style="width: 50px; height: 50px; background-color: rgba(255,255,255,0.2);">
                          <i class="fas fa-tools" style="color: #ffffff; font-size: 24px;"></i>
                        </div>
                        <div>
                          <h5 class="mb-0" style="color: #ffffff; font-weight: 600; font-size: 16px; letter-spacing: 0.3px;">
                            SERVİS DAĞITIM
                          </h5>
                          <small style="color: rgba(255,255,255,0.8); font-size: 12px;">Servis dağıtım yönetimi</small>
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
              </div>

              <!-- Üretim Dağıtım Box -->
              <div class="col-md-6 col-lg-3 mb-4">
                <a href="<?=base_url("zimmet/uretimdagitim/1")?>" class="fabrika-zimmet-module-box" style="text-decoration: none; color: inherit; display: block;">
                  <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; overflow: hidden; transition: all 0.3s ease; cursor: pointer; border-left: 3px solid transparent;">
                    <div class="card-body" style="padding: 20px; background: linear-gradient(135deg, #001657 0%, #001657 100%);">
                      <div class="d-flex align-items-center">
                        <div class="rounded-circle d-flex align-items-center justify-content-center mr-3" style="width: 50px; height: 50px; background-color: rgba(255,255,255,0.2);">
                          <i class="fas fa-industry" style="color: #ffffff; font-size: 24px;"></i>
                        </div>
                        <div>
                          <h5 class="mb-0" style="color: #ffffff; font-weight: 600; font-size: 16px; letter-spacing: 0.3px;">
                            ÜRETİM DAĞITIM
                          </h5>
                          <small style="color: rgba(255,255,255,0.8); font-size: 12px;">Üretim dağıtım yönetimi</small>
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
              </div>

              <!-- Stok Düzenle / Sil Box -->
              <div class="col-md-6 col-lg-3 mb-4">
                <a href="<?=base_url("zimmet/stoktanimlar")?>" class="fabrika-zimmet-module-box" style="text-decoration: none; color: inherit; display: block;">
                  <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; overflow: hidden; transition: all 0.3s ease; cursor: pointer; border-left: 3px solid transparent;">
                    <div class="card-body" style="padding: 20px; background: linear-gradient(135deg, #001657 0%, #001657 100%);">
                      <div class="d-flex align-items-center">
                        <div class="rounded-circle d-flex align-items-center justify-content-center mr-3" style="width: 50px; height: 50px; background-color: rgba(255,255,255,0.2);">
                          <i class="fas fa-edit" style="color: #ffc107; font-size: 24px;"></i>
                        </div>
                        <div>
                          <h5 class="mb-0" style="color: #ffffff; font-weight: 600; font-size: 16px; letter-spacing: 0.3px;">
                            STOK DÜZENLE / SİL
                          </h5>
                          <small style="color: rgba(255,255,255,0.8); font-size: 12px;">Stok tanımları yönetimi</small>
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
  .fabrika-zimmet-module-box .card {
    transition: all 0.3s ease;
  }

  .fabrika-zimmet-module-box .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 22, 87, 0.3) !important;
    border-left-color: #ffc107 !important;
  }

  .fabrika-zimmet-module-box .card:hover .rounded-circle {
    background-color: rgba(255,255,255,0.3) !important;
    transform: scale(1.1);
    transition: all 0.3s ease;
  }

  /* Responsive düzenlemeler */
  @media (max-width: 768px) {
    .fabrika-zimmet-module-box .card-body {
      padding: 15px !important;
    }
    
    .fabrika-zimmet-module-box h5 {
      font-size: 14px !important;
    }
    
    .fabrika-zimmet-module-box .rounded-circle {
      width: 40px !important;
      height: 40px !important;
    }
    
    .fabrika-zimmet-module-box .rounded-circle i {
      font-size: 20px !important;
    }
  }
</style>

