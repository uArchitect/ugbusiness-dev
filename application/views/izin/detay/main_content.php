<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top: 25px; background-color: #f8f9fa;">
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- Ana Kart -->
        <div class="card border-0 shadow-lg" style="border-radius: 16px; overflow: hidden; border-top: 4px solid #001657;">
          <!-- Card Header -->
          <div class="card-header border-0" style="background: linear-gradient(135deg, #001657 0%, #001657 100%); padding: 25px 30px;">
            <div class="d-flex align-items-center justify-content-between flex-wrap">
              <div class="d-flex align-items-center mb-2 mb-md-0">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3" style="width: 50px; height: 50px; background-color: rgba(255,255,255,0.25); box-shadow: 0 4px 8px rgba(0,0,0,0.15);">
                  <i class="fas fa-calendar-check" style="color: #ffffff; font-size: 22px;"></i>
                </div>
                <div>
                  <h3 class="mb-1" style="color: #ffffff; font-weight: 700; font-size: 24px; letter-spacing: 0.5px; line-height: 1.2;">
                    İzin Talebi Detayı
                  </h3>
                  <div class="d-flex align-items-center">
                    <span class="badge badge-light mr-2" style="font-size: 12px; padding: 5px 10px; font-weight: 600;">
                      <i class="fas fa-hashtag mr-1"></i>T<?=str_pad($izin->izin_talep_id, 5, '0', STR_PAD_LEFT)?>
                    </span>
                    <?php if ($izin->izin_durumu == 0): ?>
                      <span class="badge badge-danger" style="font-size: 12px; padding: 5px 10px;">
                        <i class="fas fa-times-circle mr-1"></i>İptal Edildi
                      </span>
                    <?php else: ?>
                      <span class="badge badge-success" style="font-size: 12px; padding: 5px 10px;">
                        <i class="fas fa-check-circle mr-1"></i>Aktif
                      </span>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
              <div class="d-flex align-items-center">
                <a href="<?=site_url('izin')?>" class="btn btn-light btn-sm shadow-sm mr-2" style="border-radius: 8px; font-weight: 600; padding: 8px 16px;">
                  <i class="fas fa-arrow-left mr-1"></i> Geri Dön
                </a>
                <button type="button" 
                        class="btn btn-success btn-sm shadow-sm" 
                        style="border-radius: 8px; font-weight: 600; padding: 8px 16px;"
                        onclick="okunduIsaretle(<?=$izin->izin_talep_id?>)">
                  <i class="fas fa-check-circle mr-1"></i> Okundu İşaretle
                </button>
              </div>
            </div>
          </div>
          
          <!-- Card Body -->
          <div class="card-body" style="padding: 35px; background-color: #ffffff;">
            <div class="row">
              <!-- Sol Taraf - Temel Bilgiler -->
              <div class="col-lg-6 col-md-12 mb-4 mb-lg-0">
                <div class="info-section" style="background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%); padding: 25px; border-radius: 12px; border: 1px solid #e9ecef; height: 100%;">
                  <div class="d-flex align-items-center mb-4">
                    <div class="section-icon" style="width: 45px; height: 45px; background: linear-gradient(135deg, #001657 0%, #001657 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 15px; box-shadow: 0 4px 8px rgba(0,22,87,0.2);">
                      <i class="fas fa-info-circle" style="color: #ffffff; font-size: 20px;"></i>
                    </div>
                    <h5 class="mb-0" style="color: #001657; font-weight: 700; font-size: 18px; letter-spacing: 0.3px;">
                      Temel Bilgiler
                    </h5>
                  </div>
                  
                  <!-- Personel Bilgisi -->
                  <div class="info-item mb-4" style="padding: 15px; background-color: #ffffff; border-radius: 8px; border-left: 4px solid #001657; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                    <label class="info-label" style="color: #6c757d; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; display: block;">
                      Talep Eden Personel
                    </label>
                    <div class="d-flex align-items-center">
                      <div class="personel-avatar" style="width: 45px; height: 45px; background: linear-gradient(135deg, #001657 0%, #001657 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 12px; box-shadow: 0 2px 6px rgba(0,22,87,0.2);">
                        <i class="fas fa-user" style="color: #ffffff; font-size: 18px;"></i>
                      </div>
                      <div>
                        <div style="color: #212529; font-size: 16px; font-weight: 600; margin-bottom: 3px;">
                          <?=htmlspecialchars($izin->kullanici_ad_soyad)?>
                        </div>
                        <div style="color: #6c757d; font-size: 13px;">
                          <i class="fas fa-building mr-1"></i><?=htmlspecialchars($izin->departman_adi)?>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <!-- İzin Nedeni -->
                  <div class="info-item mb-4" style="padding: 15px; background-color: #ffffff; border-radius: 8px; border-left: 4px solid #28a745; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                    <label class="info-label" style="color: #6c757d; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; display: block;">
                      İzin Nedeni
                    </label>
                    <div style="color: #212529; font-size: 15px; font-weight: 500;">
                      <i class="far fa-file-alt mr-2" style="color: #28a745;"></i>
                      <?=htmlspecialchars($izin->izin_neden_detay)?>
                    </div>
                  </div>
                  
                  <!-- Tarih Bilgileri -->
                  <div class="row">
                    <div class="col-6">
                      <div class="info-item mb-3" style="padding: 15px; background-color: #ffffff; border-radius: 8px; border-left: 4px solid #007bff; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                        <label class="info-label" style="color: #6c757d; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; display: block;">
                          Başlangıç
                        </label>
                        <div style="color: #212529; font-size: 14px; font-weight: 600;">
                          <i class="far fa-calendar-check mr-2" style="color: #007bff;"></i>
                          <?=date('d.m.Y', strtotime($izin->izin_baslangic_tarihi))?>
                        </div>
                        <div style="color: #6c757d; font-size: 12px; margin-top: 4px;">
                          <i class="far fa-clock mr-1"></i><?=date('H:i', strtotime($izin->izin_baslangic_tarihi))?>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="info-item mb-3" style="padding: 15px; background-color: #ffffff; border-radius: 8px; border-left: 4px solid #dc3545; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                        <label class="info-label" style="color: #6c757d; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; display: block;">
                          Bitiş
                        </label>
                        <div style="color: #212529; font-size: 14px; font-weight: 600;">
                          <i class="far fa-calendar-times mr-2" style="color: #dc3545;"></i>
                          <?=date('d.m.Y', strtotime($izin->izin_bitis_tarihi))?>
                        </div>
                        <div style="color: #6c757d; font-size: 12px; margin-top: 4px;">
                          <i class="far fa-clock mr-1"></i><?=date('H:i', strtotime($izin->izin_bitis_tarihi))?>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <!-- İzin Notu -->
                  <?php if(!empty($izin->izin_notu)): ?>
                  <div class="info-item" style="padding: 15px; background-color: #fff9e6; border-radius: 8px; border-left: 4px solid #ffc107; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                    <label class="info-label" style="color: #6c757d; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; display: block;">
                      <i class="far fa-sticky-note mr-1" style="color: #ffc107;"></i>İzin Notu
                    </label>
                    <div style="color: #495057; font-size: 14px; line-height: 1.6;">
                      <?=nl2br(htmlspecialchars($izin->izin_notu))?>
                    </div>
                  </div>
                  <?php endif; ?>
                </div>
              </div>
              
              <!-- Sağ Taraf - Onay Durumları -->
              <div class="col-lg-6 col-md-12">
                <div class="approval-section" style="background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%); padding: 25px; border-radius: 12px; border: 1px solid #e9ecef; height: 100%;">
                  <div class="d-flex align-items-center mb-4">
                    <div class="section-icon" style="width: 45px; height: 45px; background: linear-gradient(135deg, #28a745 0%, #20c997 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 15px; box-shadow: 0 4px 8px rgba(40,167,69,0.2);">
                      <i class="fas fa-clipboard-check" style="color: #ffffff; font-size: 20px;"></i>
                    </div>
                    <h5 class="mb-0" style="color: #001657; font-weight: 700; font-size: 18px; letter-spacing: 0.3px;">
                      Onay Durumları
                    </h5>
                  </div>
                  
                  <!-- Amir Onayı -->
                  <div class="approval-card mb-4" style="padding: 20px; background-color: #ffffff; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border: 1px solid #e9ecef;">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                      <div class="d-flex align-items-center">
                        <div class="approval-icon" style="width: 40px; height: 40px; background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 12px; box-shadow: 0 2px 6px rgba(255,193,7,0.3);">
                          <i class="fas fa-user-tie" style="color: #ffffff; font-size: 16px;"></i>
                        </div>
                        <div>
                          <div style="color: #212529; font-size: 14px; font-weight: 600; margin-bottom: 2px;">Amir Onayı</div>
                          <div style="color: #6c757d; font-size: 12px;">Birinci seviye onay</div>
                        </div>
                      </div>
                      <?php 
                      $amir_durum = isset($izin->amir_onay_durumu) ? (int)$izin->amir_onay_durumu : 0;
                      if ($amir_durum == 0): ?>
                        <span class="badge badge-warning" style="font-size: 12px; padding: 8px 14px; font-weight: 600; border-radius: 20px;">
                          <i class="fa fa-clock mr-1"></i>Beklemede
                        </span>
                      <?php elseif ($amir_durum == 1): ?>
                        <span class="badge badge-success" style="font-size: 12px; padding: 8px 14px; font-weight: 600; border-radius: 20px;">
                          <i class="fa fa-check mr-1"></i>Onaylandı
                        </span>
                      <?php else: ?>
                        <span class="badge badge-danger" style="font-size: 12px; padding: 8px 14px; font-weight: 600; border-radius: 20px;">
                          <i class="fa fa-times mr-1"></i>Reddedildi
                        </span>
                      <?php endif; ?>
                    </div>
                    
                    <?php if (!empty($izin->amir_ad_soyad)): ?>
                    <div style="padding: 12px; background-color: #f8f9fa; border-radius: 6px; margin-top: 10px;">
                      <div style="color: #495057; font-size: 13px; font-weight: 500; margin-bottom: 5px;">
                        <i class="fa fa-user mr-1" style="color: #6c757d;"></i><?=htmlspecialchars($izin->amir_ad_soyad)?>
                      </div>
                      <?php if (!empty($izin->amir_onay_tarihi)): ?>
                      <div style="color: #6c757d; font-size: 12px;">
                        <i class="far fa-calendar mr-1"></i><?=date('d.m.Y H:i', strtotime($izin->amir_onay_tarihi))?>
                      </div>
                      <?php endif; ?>
                    </div>
                    <?php endif; ?>
                  </div>
                  
                  <!-- Müdür Onayı -->
                  <div class="approval-card mb-4" style="padding: 20px; background-color: #ffffff; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border: 1px solid #e9ecef;">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                      <div class="d-flex align-items-center">
                        <div class="approval-icon" style="width: 40px; height: 40px; background: linear-gradient(135deg, #001657 0%, #002080 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 12px; box-shadow: 0 2px 6px rgba(0,22,87,0.3);">
                          <i class="fas fa-user-shield" style="color: #ffffff; font-size: 16px;"></i>
                        </div>
                        <div>
                          <div style="color: #212529; font-size: 14px; font-weight: 600; margin-bottom: 2px;">Müdür Onayı</div>
                          <div style="color: #6c757d; font-size: 12px;">İkinci seviye onay</div>
                        </div>
                      </div>
                      <?php 
                      $mudur_durum = isset($izin->mudur_onay_durumu) ? (int)$izin->mudur_onay_durumu : 0;
                      if ($mudur_durum == 0): ?>
                        <span class="badge badge-warning" style="font-size: 12px; padding: 8px 14px; font-weight: 600; border-radius: 20px;">
                          <i class="fa fa-clock mr-1"></i>Beklemede
                        </span>
                      <?php elseif ($mudur_durum == 1): ?>
                        <span class="badge badge-success" style="font-size: 12px; padding: 8px 14px; font-weight: 600; border-radius: 20px;">
                          <i class="fa fa-check mr-1"></i>Onaylandı
                        </span>
                      <?php else: ?>
                        <span class="badge badge-danger" style="font-size: 12px; padding: 8px 14px; font-weight: 600; border-radius: 20px;">
                          <i class="fa fa-times mr-1"></i>Reddedildi
                        </span>
                      <?php endif; ?>
                    </div>
                    
                    <?php if (!empty($izin->mudur_ad_soyad ?? '')): ?>
                    <div style="padding: 12px; background-color: #f8f9fa; border-radius: 6px; margin-top: 10px;">
                      <div style="color: #495057; font-size: 13px; font-weight: 500; margin-bottom: 5px;">
                        <i class="fa fa-user mr-1" style="color: #6c757d;"></i><?=htmlspecialchars($izin->mudur_ad_soyad)?>
                      </div>
                      <?php if (!empty($izin->mudur_onay_tarihi ?? '')): ?>
                      <div style="color: #6c757d; font-size: 12px;">
                        <i class="far fa-calendar mr-1"></i><?=date('d.m.Y H:i', strtotime($izin->mudur_onay_tarihi))?>
                      </div>
                      <?php endif; ?>
                    </div>
                    <?php endif; ?>
                  </div>
                  
                  <!-- Kayıt Bilgisi -->
                  <div style="padding: 15px; background-color: #f8f9fa; border-radius: 8px; border-left: 3px solid #6c757d;">
                    <div style="color: #6c757d; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">
                      <i class="far fa-clock mr-1"></i>Kayıt Tarihi
                    </div>
                    <div style="color: #495057; font-size: 14px; font-weight: 500;">
                      <?=date('d.m.Y H:i', strtotime($izin->izin_kayit_tarihi))?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- İşlem Butonları -->
            <div class="row mt-4 pt-4" style="border-top: 2px solid #e9ecef;">
              <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                  <div>
                    <?php if ($izin->izin_durumu != 0): ?>
                      <a href="<?=site_url('izin/iptal_et/'.$izin->izin_talep_id)?>" 
                         class="btn btn-danger shadow-sm" 
                         style="border-radius: 8px; font-weight: 600; padding: 10px 20px;"
                         onclick="return confirm('Bu izin talebini iptal etmek istediğinize emin misiniz?');">
                        <i class="fa fa-times mr-1"></i> İptal Et
                      </a>
                    <?php endif; ?>
                  </div>
                  <div>
                    <a href="<?=site_url('izin')?>" class="btn btn-secondary shadow-sm" style="border-radius: 8px; font-weight: 600; padding: 10px 20px;">
                      <i class="fas fa-arrow-left mr-1"></i> Listeye Dön
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
  /* Kurumsal Tasarım Stilleri */
  .card {
    transition: all 0.3s ease;
  }
  
  .card:hover {
    box-shadow: 0 8px 24px rgba(0,0,0,0.12) !important;
    transform: translateY(-2px);
  }
  
  .info-section, .approval-section {
    transition: all 0.3s ease;
  }
  
  .info-section:hover, .approval-section:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  }
  
  .info-item, .approval-card {
    transition: all 0.3s ease;
  }
  
  .info-item:hover, .approval-card:hover {
    transform: translateX(5px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1) !important;
  }
  
  .section-icon {
    transition: transform 0.3s ease;
  }
  
  .section-icon:hover {
    transform: scale(1.1) rotate(5deg);
  }
  
  .badge {
    font-weight: 600;
    letter-spacing: 0.3px;
  }
  
  .btn {
    transition: all 0.3s ease;
  }
  
  .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15) !important;
  }
  
  /* Responsive Düzenlemeler */
  @media (max-width: 768px) {
    .card-body {
      padding: 20px !important;
    }
    
    .card-header {
      padding: 20px !important;
    }
    
    .info-section, .approval-section {
      padding: 20px !important;
    }
    
    .info-item, .approval-card {
      padding: 12px !important;
    }
  }
</style>

<script>
function okunduIsaretle(izinId) {
  if (confirm('Bildirimleri okundu olarak işaretlemek istediğinize emin misiniz?')) {
    // Butonu devre dışı bırak
    var btn = $('button[onclick*="okunduIsaretle"]');
    btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> İşleniyor...');
    
    // AJAX ile okundu işaretle
    $.ajax({
      url: '<?=site_url("izin/okundu_isaretle")?>/' + izinId,
      type: 'GET',
      dataType: 'json',
      headers: {
        'X-Requested-With': 'XMLHttpRequest'
      },
      success: function(response) {
        if (response && response.success) {
          // Butonu görsel olarak değiştir
          btn.removeClass('btn-success')
            .addClass('btn-secondary')
            .html('<i class="fas fa-check-circle mr-1"></i> Okundu İşaretlendi');
          
          // Başarı mesajı göster
          alert(response.message || 'Bildirimler okundu olarak işaretlendi.');
        } else {
          btn.prop('disabled', false).html('<i class="fas fa-check-circle mr-1"></i> Okundu İşaretle');
          alert('Bir hata oluştu: ' + (response ? response.message : 'Bilinmeyen hata'));
        }
      },
      error: function(xhr, status, error) {
        // AJAX başarısız olursa normal redirect yap
        btn.prop('disabled', false).html('<i class="fas fa-check-circle mr-1"></i> Okundu İşaretle');
        // Normal sayfa yükleme ile yap
        window.location.href = '<?=site_url("izin/okundu_isaretle")?>/' + izinId;
      }
    });
  }
}
</script>
