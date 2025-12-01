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
                  <i class="fas fa-warehouse" style="color: #ffffff; font-size: 18px;"></i>
                </div>
                <div>
                  <h3 class="mb-0" style="color: #ffffff; font-weight: 700; font-size: 20px; letter-spacing: 0.5px; line-height: 1.2;">
                    Depo Malzeme Çıkış Talep Formu
                  </h3>
                  <small style="color: rgba(255,255,255,0.9); font-size: 13px; line-height: 1.4;">Yeni depo malzeme çıkış talebi oluşturun</small>
                </div>
              </div>
              <a href="<?=base_url("depo_onay")?>" class="btn btn-light btn-sm shadow-sm" style="border-radius: 8px; font-weight: 600;">
                <i class="fas fa-arrow-left"></i> Listeye Dön
              </a>
            </div>
          </div>
          
          <!-- Card Body -->
          <div class="card-body" style="padding: 30px; background-color: #ffffff;">
            <form class="form-horizontal" method="POST" action="<?php echo site_url('depo_onay/talep_olustur_save').'/'.$this->session->userdata('aktif_kullanici_id');?>" id="talepForm">
              
              <!-- Teslim Alacak Kişi -->
              <div class="form-group-modern mb-4">
                <label for="teslim_alacak_kullanici_no" class="form-label-modern">
                  <i class="fas fa-user-check text-primary mr-2"></i>
                  Teslim Alacak Kişi <span class="text-danger">*</span>
                </label>
                <select name="teslim_alacak_kullanici_no" 
                        required 
                        id="teslim_alacak_kullanici_no" 
                        class="select2 form-control form-control-modern" 
                        style="width: 100%;">
                  <option value="">Kişi Seçimi Yapınız</option>
                  <?php foreach($kullanicilar as $kul) : ?> 
                    <option value="<?=$kul->kullanici_id?>"><?=$kul->kullanici_ad_soyad?></option>
                  <?php endforeach; ?>  
                </select>
                <small class="form-text text-muted">
                  <i class="fas fa-info-circle"></i> Malzemeyi teslim alacak kişiyi seçiniz
                </small>
              </div>

              <!-- Malzeme Bilgileri -->
              <div class="mb-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                  <label class="form-label-modern" style="margin-bottom: 0;">
                    <i class="fas fa-boxes text-danger mr-2"></i>
                    Talep Edilen Malzemeler
                  </label>
                  <button type="button" 
                          id="malzemeEkleBtn" 
                          class="btn shadow-sm" 
                          style="border-radius: 8px; font-weight: 600; padding: 8px 16px; background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: #ffffff; border: none;">
                    <i class="fas fa-plus-circle"></i> Yeni Malzeme Ekle
                  </button>
                </div>

                <div id="malzeme-container">
                  <div class="malzeme-row row mb-3">
                    <div class="col-md-8 col-lg-9">
                      <div class="form-group-modern mb-0">
                        <label class="form-label-modern" style="font-size: 13px;">
                          Talep Edilen Malzeme <span class="text-danger">*</span>
                        </label>
                        <select name="stok_kayit_no[]" 
                                required 
                                class="select2 form-control form-control-modern" 
                                style="width: 100%;">
                          <option value="">Malzeme Seçimi Yapınız</option>
                          <?php foreach($stok_tanimlari as $malzeme): ?> 
                            <option value="<?=$malzeme->stok_tanim_id?>"><?=$malzeme->stok_tanim_ad?></option>
                          <?php endforeach; ?>  
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4 col-lg-3">
                      <div class="form-group-modern mb-0">
                        <label class="form-label-modern" style="font-size: 13px;">
                          Talep Edilen Miktar <span class="text-danger">*</span>
                        </label>
                        <input type="number" 
                               required 
                               class="form-control form-control-modern" 
                               min="1" 
                               name="talep_miktar[]"
                               placeholder="Miktar">
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Bilgi Kutusu -->
              <div class="alert alert-info alert-modern mb-4" role="alert">
                <i class="fas fa-lightbulb mr-2"></i>
                <strong>İpucu:</strong> Birden fazla malzeme eklemek için "Yeni Malzeme Ekle" butonunu kullanabilirsiniz. Her malzeme için miktar belirtmeyi unutmayın.
              </div>

              <!-- Butonlar -->
              <div class="form-actions-modern d-flex justify-content-between align-items-center pt-3 border-top">
                <a href="<?=base_url("depo_onay")?>" class="btn btn-secondary-modern">
                  <i class="fas fa-times"></i> İptal
                </a>
                <button type="submit" class="btn btn-primary-modern">
                  <i class="fas fa-save"></i> Kaydet
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<style>
  /* Modern Form Stilleri */
  .form-group-modern {
    margin-bottom: 1.5rem;
  }

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

  /* Select2 Modern Stil */
  .select2-container--default .select2-selection--single {
    border: 2px solid #e0e0e0 !important;
    border-radius: 8px !important;
    height: auto !important;
    padding: 8px 12px !important;
    transition: all 0.3s ease !important;
  }

  .select2-container--default .select2-selection--single:focus,
  .select2-container--default.select2-container--focus .select2-selection--single {
    border-color: #001657 !important;
    box-shadow: 0 0 0 0.2rem rgba(0, 22, 87, 0.15) !important;
  }

  .select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 1.5 !important;
    padding: 0 !important;
  }

  .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 100% !important;
    right: 10px !important;
  }

  /* Malzeme Satırları */
  .malzeme-row {
    padding: 15px;
    background-color: #f8f9fa;
    border-radius: 8px;
    border: 1px solid #e0e0e0;
    margin-bottom: 15px;
    transition: all 0.3s ease;
  }

  .malzeme-row:hover {
    background-color: #ffffff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    border-color: #001657;
  }

  .malzeme-row:first-child {
    margin-top: 0;
  }

  .remove-row-btn {
    background-color: #dc3545;
    border: none;
    color: #ffffff;
    border-radius: 8px;
    padding: 8px 12px;
    font-weight: 600;
    transition: all 0.3s ease;
    cursor: pointer;
  }

  .remove-row-btn:hover {
    background-color: #c82333;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
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
  }

  .btn-primary-modern:active {
    transform: translateY(0);
  }

  .btn-secondary-modern {
    background-color: #6c757d;
    border: none;
    color: #ffffff;
    padding: 12px 24px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
  }

  .btn-secondary-modern:hover {
    background-color: #5a6268;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(108, 117, 125, 0.3);
    color: #ffffff;
  }

  /* Alert Stilleri */
  .alert-modern {
    border-radius: 8px;
    border: none;
    padding: 16px 20px;
    font-size: 14px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
  }

  .alert-modern i {
    font-size: 16px;
  }

  /* Form Actions */
  .form-actions-modern {
    margin-top: 2rem;
    padding-top: 1.5rem;
  }

  /* Responsive Düzenlemeler */
  @media (max-width: 992px) {
    .malzeme-row .col-md-8,
    .malzeme-row .col-md-4 {
      margin-bottom: 15px;
    }
  }

  @media (max-width: 768px) {
    .card-body {
      padding: 20px !important;
    }

    .form-group-modern {
      margin-bottom: 1.25rem;
    }

    .form-actions-modern {
      flex-direction: column;
      gap: 10px;
    }

    .form-actions-modern .btn {
      width: 100%;
    }

    .malzeme-row {
      padding: 12px;
    }

    .malzeme-row .col-md-8,
    .malzeme-row .col-md-4 {
      margin-bottom: 15px;
    }

    #malzemeEkleBtn {
      width: 100%;
      margin-top: 10px;
    }
  }

  @media (max-width: 576px) {
    .card-header {
      padding: 15px 20px !important;
    }

    .card-header h3 {
      font-size: 18px !important;
    }

    .card-header small {
      font-size: 12px !important;
    }

    .form-label-modern {
      font-size: 13px;
    }

    .form-control-modern {
      padding: 10px 14px;
      font-size: 13px;
    }
  }

  /* Input Focus Animasyonu */
  .form-control-modern:focus {
    animation: inputFocus 0.3s ease;
  }

  @keyframes inputFocus {
    0% {
      transform: scale(1);
    }
    50% {
      transform: scale(1.01);
    }
    100% {
      transform: scale(1);
    }
  }

  /* Buton Hover Efektleri */
  .btn:hover {
    transform: translateY(-2px);
    transition: all 0.3s ease;
  }

  #malzemeEkleBtn:hover {
    background: linear-gradient(135deg, #20c997 0%, #28a745 100%) !important;
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

<script>
document.addEventListener('DOMContentLoaded', function () {
  const malzemeOptions = `<?php foreach($stok_tanimlari as $malzeme): ?> 
    <option value="<?=$malzeme->stok_tanim_id?>"><?=$malzeme->stok_tanim_ad?></option>
  <?php endforeach; ?>`;

  // Select2'yi başlat
  $('.select2').select2({
    theme: 'bootstrap4',
    width: '100%'
  });

  // Malzeme ekleme butonu
  document.getElementById('malzemeEkleBtn').addEventListener('click', function(e) {
    e.preventDefault();

    const container = document.getElementById('malzeme-container');
    const malzemeCount = container.querySelectorAll('.malzeme-row').length;

    const newRow = document.createElement('div');
    newRow.classList.add('malzeme-row', 'row', 'mb-3');
    newRow.innerHTML = `
      <div class="col-md-8 col-lg-9">
        <div class="form-group-modern mb-0">
          <label class="form-label-modern" style="font-size: 13px;">
            Talep Edilen Malzeme <span class="text-danger">*</span>
          </label>
          <select name="stok_kayit_no[]" required class="select2 form-control form-control-modern" style="width: 100%;">
            <option value="">Malzeme Seçimi Yapınız</option>
            ${malzemeOptions}
          </select>
        </div>
      </div>
      <div class="col-md-3 col-lg-2">
        <div class="form-group-modern mb-0">
          <label class="form-label-modern" style="font-size: 13px;">
            Talep Edilen Miktar <span class="text-danger">*</span>
          </label>
          <input type="number" required class="form-control form-control-modern" min="1" name="talep_miktar[]" placeholder="Miktar">
        </div>
      </div>
      <div class="col-md-1 col-lg-1 d-flex align-items-end">
        <button type="button" class="btn remove-row-btn" title="Satırı Sil" style="width: 100%; padding: 10px;">
          <i class="fas fa-trash"></i>
        </button>
      </div>
    `;

    container.appendChild(newRow);

    // Yeni eklenen select2'yi initialize et
    $(newRow).find('select').select2({
      theme: 'bootstrap4',
      width: '100%'
    });

    // Silme butonu event listener
    newRow.querySelector('.remove-row-btn').addEventListener('click', function () {
      if(confirm('Bu malzeme satırını silmek istediğinize emin misiniz?')) {
        newRow.remove();
      }
    });
  });

  // Form gönderilirken loading state
  const form = document.getElementById('talepForm');
  const submitBtn = form.querySelector('button[type="submit"]');
  
  form.addEventListener('submit', function(e) {
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Kaydediliyor...';
    submitBtn.disabled = true;
  });
});
</script>
