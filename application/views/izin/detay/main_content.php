<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top: 25px; background-color: #f8f9fa;">
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
          <!-- Card Header -->
          <div class="card-header border-0" style="background: linear-gradient(135deg, #001657 0%, #001657 100%); padding: 18px 25px;">
            <div class="d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3" style="width: 40px; height: 40px; background-color: rgba(255,255,255,0.2);">
                  <i class="fas fa-calendar-alt" style="color: #ffffff; font-size: 18px;"></i>
                </div>
                <div>
                  <h3 class="mb-0" style="color: #ffffff; font-weight: 700; font-size: 20px; letter-spacing: 0.5px; line-height: 1.2;">
                    İzin Talebi Detayı
                  </h3>
                  <small style="color: rgba(255,255,255,0.9); font-size: 13px; line-height: 1.4;">
                    Talep Kodu: T<?=str_pad($izin->izin_talep_id, 5, '0', STR_PAD_LEFT)?>
                  </small>
                </div>
              </div>
              <div>
                <a href="<?=site_url('izin')?>" class="btn btn-light btn-sm shadow-sm mr-2" style="border-radius: 8px; font-weight: 600;">
                  <i class="fas fa-arrow-left"></i> Geri Dön
                </a>
                <a href="<?=site_url('izin/okundu_isaretle/'.$izin->izin_talep_id)?>" class="btn btn-success btn-sm shadow-sm" style="border-radius: 8px; font-weight: 600;">
                  <i class="fas fa-check-circle"></i> Okundu İşaretle
                </a>
              </div>
            </div>
          </div>
          
          <!-- Card Body -->
          <div class="card-body" style="padding: 30px; background-color: #ffffff;">
            <div class="row">
              <!-- Sol Taraf - Temel Bilgiler -->
              <div class="col-md-6">
                <h5 class="mb-4" style="color: #001657; font-weight: 600; border-bottom: 2px solid #001657; padding-bottom: 10px;">
                  <i class="fas fa-info-circle mr-2"></i>Temel Bilgiler
                </h5>
                
                <div class="mb-3">
                  <label style="color: #6c757d; font-size: 13px; font-weight: 500; margin-bottom: 5px;">Talep Eden Personel</label>
                  <div style="color: #495057; font-size: 15px; font-weight: 500;">
                    <i class="far fa-user mr-2"></i>
                    <strong><?=htmlspecialchars($izin->kullanici_ad_soyad)?></strong>
                  </div>
                  <small style="color: #6c757d;">
                    <i class="fas fa-building mr-1"></i><?=htmlspecialchars($izin->departman_adi)?>
                  </small>
                </div>
                
                <div class="mb-3">
                  <label style="color: #6c757d; font-size: 13px; font-weight: 500; margin-bottom: 5px;">İzin Nedeni</label>
                  <div style="color: #495057; font-size: 15px; font-weight: 500;">
                    <i class="far fa-file-alt mr-2"></i>
                    <?=htmlspecialchars($izin->izin_neden_detay)?>
                  </div>
                </div>
                
                <div class="mb-3">
                  <label style="color: #6c757d; font-size: 13px; font-weight: 500; margin-bottom: 5px;">İzin Başlangıç Tarihi</label>
                  <div style="color: #495057; font-size: 15px; font-weight: 500;">
                    <i class="far fa-calendar-check mr-2"></i>
                    <?=date('d.m.Y H:i', strtotime($izin->izin_baslangic_tarihi))?>
                  </div>
                </div>
                
                <div class="mb-3">
                  <label style="color: #6c757d; font-size: 13px; font-weight: 500; margin-bottom: 5px;">İzin Bitiş Tarihi</label>
                  <div style="color: #495057; font-size: 15px; font-weight: 500;">
                    <i class="far fa-calendar-times mr-2"></i>
                    <?=date('d.m.Y H:i', strtotime($izin->izin_bitis_tarihi))?>
                  </div>
                </div>
                
                <?php if(!empty($izin->izin_notu)): ?>
                <div class="mb-3">
                  <label style="color: #6c757d; font-size: 13px; font-weight: 500; margin-bottom: 5px;">İzin Notu</label>
                  <div style="color: #495057; font-size: 14px; background-color: #f8f9fa; padding: 12px; border-radius: 6px; border-left: 3px solid #001657;">
                    <i class="far fa-sticky-note mr-2"></i>
                    <?=nl2br(htmlspecialchars($izin->izin_notu))?>
                  </div>
                </div>
                <?php endif; ?>
              </div>
              
              <!-- Sağ Taraf - Onay Durumları -->
              <div class="col-md-6">
                <h5 class="mb-4" style="color: #001657; font-weight: 600; border-bottom: 2px solid #001657; padding-bottom: 10px;">
                  <i class="fas fa-clipboard-check mr-2"></i>Onay Durumları
                </h5>
                
                <!-- Amir Onayı -->
                <div class="mb-4">
                  <label style="color: #6c757d; font-size: 13px; font-weight: 500; margin-bottom: 8px;">Amir Onayı</label>
                  <div>
                    <?php 
                    $amir_durum = isset($izin->amir_onay_durumu) ? (int)$izin->amir_onay_durumu : 0;
                    if ($amir_durum == 0): ?>
                      <span class="badge badge-warning" style="font-size: 13px; padding: 8px 14px;">
                        <i class="fa fa-clock mr-1"></i>Beklemede
                      </span>
                    <?php elseif ($amir_durum == 1): ?>
                      <span class="badge badge-success" style="font-size: 13px; padding: 8px 14px;">
                        <i class="fa fa-check mr-1"></i>Onaylandı
                      </span>
                    <?php else: ?>
                      <span class="badge badge-danger" style="font-size: 13px; padding: 8px 14px;">
                        <i class="fa fa-times mr-1"></i>Reddedildi
                      </span>
                    <?php endif; ?>
                    
                    <?php if (!empty($izin->amir_ad_soyad)): ?>
                      <div class="mt-2" style="color: #6c757d; font-size: 13px;">
                        <i class="fa fa-user mr-1"></i><?=htmlspecialchars($izin->amir_ad_soyad)?>
                      </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($izin->amir_onay_tarihi)): ?>
                      <div class="mt-1" style="color: #6c757d; font-size: 12px;">
                        <i class="far fa-calendar mr-1"></i><?=date('d.m.Y H:i', strtotime($izin->amir_onay_tarihi))?>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
                
                <!-- Müdür Onayı -->
                <div class="mb-4">
                  <label style="color: #6c757d; font-size: 13px; font-weight: 500; margin-bottom: 8px;">Müdür Onayı</label>
                  <div>
                    <?php 
                    $mudur_durum = isset($izin->mudur_onay_durumu) ? (int)$izin->mudur_onay_durumu : 0;
                    if ($mudur_durum == 0): ?>
                      <span class="badge badge-warning" style="font-size: 13px; padding: 8px 14px;">
                        <i class="fa fa-clock mr-1"></i>Beklemede
                      </span>
                    <?php elseif ($mudur_durum == 1): ?>
                      <span class="badge badge-success" style="font-size: 13px; padding: 8px 14px;">
                        <i class="fa fa-check mr-1"></i>Onaylandı
                      </span>
                    <?php else: ?>
                      <span class="badge badge-danger" style="font-size: 13px; padding: 8px 14px;">
                        <i class="fa fa-times mr-1"></i>Reddedildi
                      </span>
                    <?php endif; ?>
                    
                    <?php if (!empty($izin->mudur_ad_soyad ?? '')): ?>
                      <div class="mt-2" style="color: #6c757d; font-size: 13px;">
                        <i class="fa fa-user mr-1"></i><?=htmlspecialchars($izin->mudur_ad_soyad)?>
                      </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($izin->mudur_onay_tarihi ?? '')): ?>
                      <div class="mt-1" style="color: #6c757d; font-size: 12px;">
                        <i class="far fa-calendar mr-1"></i><?=date('d.m.Y H:i', strtotime($izin->mudur_onay_tarihi))?>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
                
                <!-- Genel Durum -->
                <div class="mb-3">
                  <label style="color: #6c757d; font-size: 13px; font-weight: 500; margin-bottom: 8px;">Genel Durum</label>
                  <div>
                    <?php if ($izin->izin_durumu == 0): ?>
                      <span class="badge badge-danger" style="font-size: 13px; padding: 8px 14px;">
                        <i class="fas fa-times-circle mr-1"></i>İptal Edildi
                      </span>
                    <?php else: ?>
                      <span class="badge badge-info" style="font-size: 13px; padding: 8px 14px;">
                        <i class="fas fa-hourglass-half mr-1"></i>Aktif
                      </span>
                    <?php endif; ?>
                  </div>
                </div>
                
                <!-- Kayıt Tarihi -->
                <div class="mb-3">
                  <label style="color: #6c757d; font-size: 13px; font-weight: 500; margin-bottom: 5px;">Kayıt Tarihi</label>
                  <div style="color: #6c757d; font-size: 13px;">
                    <i class="far fa-clock mr-1"></i>
                    <?=date('d.m.Y H:i', strtotime($izin->izin_kayit_tarihi))?>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- İşlem Butonları -->
            <div class="row mt-4 pt-4 border-top">
              <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <?php if ($izin->izin_durumu != 0): ?>
                      <a href="<?=site_url('izin/iptal_et/'.$izin->izin_talep_id)?>" 
                         class="btn btn-danger" 
                         onclick="return confirm('Bu izin talebini iptal etmek istediğinize emin misiniz?');">
                        <i class="fa fa-times"></i> İptal Et
                      </a>
                    <?php endif; ?>
                  </div>
                  <div>
                    <a href="<?=site_url('izin')?>" class="btn btn-secondary">
                      <i class="fas fa-arrow-left"></i> Listeye Dön
                    </a>
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

<style>
  .card {
    transition: box-shadow 0.3s ease;
  }
  
  .card:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.15) !important;
  }
  
  .badge {
    font-weight: 500;
  }
</style>

