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
          
          <!-- Tab Navigation Bar -->
          <div class="siparis-tabs-container" style="background-color: #001657; overflow-x: auto; border-bottom: 1px solid rgba(255,255,255,0.1);">
            <div class="d-flex" style="min-width: max-content;">
              <a href="<?=base_url("tum-siparisler")?>" class="siparis-tab" style="background-color: #001657; color: white; padding: 10px 18px; text-decoration: none; font-weight: 500; font-size: 13px; white-space: nowrap; border-right: 1px solid rgba(255,255,255,0.15); transition: all 0.2s; display: flex; align-items: center; gap: 6px;">
                <i class="fas fa-list-alt" style="font-size: 14px;"></i>
                <span>Tüm Siparişler</span>
              </a>
              <a href="<?=base_url("onay-bekleyen-siparisler")?>" class="siparis-tab" style="background-color: #001657; color: white; padding: 10px 18px; text-decoration: none; font-weight: 500; font-size: 13px; white-space: nowrap; border-right: 1px solid rgba(255,255,255,0.15); transition: all 0.2s; display: flex; align-items: center; gap: 6px;">
                <i class="far fa-check-circle" style="font-size: 14px;"></i>
                <span>Onay Bekleyenler</span>
              </a>
              <a href="<?=base_url("siparis/haftalik_kurulum_plan")?>" class="siparis-tab" style="background-color: #001657; color: white; padding: 10px 18px; text-decoration: none; font-weight: 500; font-size: 13px; white-space: nowrap; border-right: 1px solid rgba(255,255,255,0.15); transition: all 0.2s; display: flex; align-items: center; gap: 6px;">
                <i class="far fa-calendar-alt" style="font-size: 14px;"></i>
                <span>Kurulum Planı</span>
              </a>
              <a href="<?=base_url("siparis/hizli_siparis_olustur_view")?>" class="siparis-tab" style="background-color: #001657; color: white; padding: 10px 18px; text-decoration: none; font-weight: 500; font-size: 13px; white-space: nowrap; border-right: 1px solid rgba(255,255,255,0.15); transition: all 0.2s; display: flex; align-items: center; gap: 6px;">
                <i class="fa fa-plus-circle" style="font-size: 14px;"></i>
                <span>Hızlı Sipariş</span>
              </a>
              <a href="<?=base_url("cihaz/iptal_edilen_siparisler")?>" class="siparis-tab" style="background-color: #001657; color: white; padding: 10px 18px; text-decoration: none; font-weight: 500; font-size: 13px; white-space: nowrap; border-right: 1px solid rgba(255,255,255,0.15); transition: all 0.2s; display: flex; align-items: center; gap: 6px;">
                <i class="fas fa-ban" style="font-size: 14px;"></i>
                <span>İptal Edilenler</span>
              </a>
              <a href="<?=base_url("siparis/degerlendirme_rapor")?>" class="siparis-tab" style="background-color: #001657; color: white; padding: 10px 18px; text-decoration: none; font-weight: 500; font-size: 13px; white-space: nowrap; border-right: none; transition: all 0.2s; display: flex; align-items: center; gap: 6px;">
                <i class="fa fa-envelope" style="font-size: 14px;"></i>
                <span>SMS Sonuçları</span>
              </a>
            </div>
          </div>
          
          <!-- Card Body -->
          <div class="card-body" style="padding: 25px; background-color: #ffffff;">
            <!-- İçerik buraya gelecek -->
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<style>
  .siparis-tabs-container {
    -webkit-overflow-scrolling: touch;
    scrollbar-width: thin;
  }

  .siparis-tabs-container::-webkit-scrollbar {
    height: 5px;
  }

  .siparis-tabs-container::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
  }

  .siparis-tabs-container::-webkit-scrollbar-thumb {
    background: #001657;
    border-radius: 10px;
  }

  .siparis-tabs-container::-webkit-scrollbar-thumb:hover {
    background: #002a7a;
  }

  .siparis-tab {
    display: inline-flex;
    align-items: center;
    cursor: pointer;
    user-select: none;
    position: relative;
  }

  .siparis-tab:hover {
    opacity: 0.9;
    filter: brightness(1.1);
  }

  .siparis-tab:active {
    transform: scale(0.98);
  }

  .siparis-tab i {
    opacity: 0.95;
  }

  /* Responsive düzenlemeler */
  @media (max-width: 768px) {
    .siparis-tab {
      padding: 8px 14px !important;
      font-size: 12px !important;
    }
    
    .siparis-tab i {
      font-size: 12px !important;
    }
  }

  @media (max-width: 576px) {
    .siparis-tab {
      padding: 8px 12px !important;
      font-size: 11px !important;
    }
    
    .siparis-tab span {
      display: none;
    }
    
    .siparis-tab i {
      font-size: 14px !important;
    }
  }
</style>

