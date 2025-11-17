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
                  <i class="fas fa-edit" style="color: #ffffff; font-size: 18px;"></i>
                </div>
                <div>
                  <h3 class="mb-0" style="color: #ffffff; font-weight: 700; font-size: 20px; letter-spacing: 0.5px; line-height: 1.2;">
                    Abonelik Düzenle
                  </h3>
                  <small style="color: rgba(255,255,255,0.9); font-size: 13px; line-height: 1.4;">Abonelik bilgilerini güncelleyin</small>
                </div>
              </div>
              <a href="<?php echo site_url('abonelik'); ?>" class="btn btn-light btn-sm shadow-sm" style="border-radius: 8px; font-weight: 600;">
                <i class="fas fa-arrow-left"></i> Listeye Dön
              </a>
            </div>
          </div>
          
          <!-- Card Body -->
          <div class="card-body" style="padding: 30px; background-color: #ffffff;">
            <form action="<?php echo site_url('abonelik/duzenle_islem/'.$abonelik->abonelik_id); ?>" method="post" onsubmit="return validateDates()" id="abonelikForm">
              
              <!-- Başlık -->
              <div class="form-group-modern mb-4">
                <label for="baslik" class="form-label-modern">
                  <i class="fas fa-heading text-primary mr-2"></i>
                  Başlık <span class="text-danger">*</span>
                </label>
                <input 
                  type="text" 
                  name="baslik" 
                  id="baslik" 
                  class="form-control form-control-modern" 
                  value="<?php echo htmlspecialchars($abonelik->abonelik_baslik, ENT_QUOTES, 'UTF-8'); ?>" 
                  required
                  placeholder="Abonelik başlığını giriniz">
                <small class="form-text text-muted">
                  <i class="fas fa-info-circle"></i> Abonelik için açıklayıcı bir başlık giriniz
                </small>
              </div>

              <!-- Açıklama -->
              <div class="form-group-modern mb-4">
                <label for="aciklama" class="form-label-modern">
                  <i class="fas fa-align-left text-primary mr-2"></i>
                  Açıklama
                </label>
                <textarea 
                  name="aciklama" 
                  id="aciklama" 
                  class="form-control form-control-modern" 
                  rows="4"
                  placeholder="Abonelik açıklamasını giriniz (isteğe bağlı)"><?php echo htmlspecialchars($abonelik->abonelik_aciklama ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>
                <small class="form-text text-muted">
                  <i class="fas fa-info-circle"></i> Abonelik hakkında detaylı bilgi (isteğe bağlı)
                </small>
              </div>

              <!-- Tarih Alanları -->
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group-modern mb-4">
                    <label for="baslangic_tarihi" class="form-label-modern">
                      <i class="fas fa-calendar-check text-success mr-2"></i>
                      Başlangıç Tarihi <span class="text-danger">*</span>
                    </label>
                    <input 
                      type="date" 
                      name="baslangic_tarihi" 
                      id="baslangic_tarihi" 
                      class="form-control form-control-modern" 
                      value="<?php echo htmlspecialchars($abonelik->abonelik_baslangic_tarihi, ENT_QUOTES, 'UTF-8'); ?>" 
                      required>
                    <small class="form-text text-muted">
                      <i class="fas fa-info-circle"></i> Aboneliğin başlangıç tarihi
                    </small>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group-modern mb-4">
                    <label for="bitis_tarihi" class="form-label-modern">
                      <i class="fas fa-calendar-times text-danger mr-2"></i>
                      Bitiş Tarihi <span class="text-danger">*</span>
                    </label>
                    <input 
                      type="date" 
                      name="bitis_tarihi" 
                      id="bitis_tarihi" 
                      class="form-control form-control-modern" 
                      value="<?php echo htmlspecialchars($abonelik->abonelik_bitis_tarihi, ENT_QUOTES, 'UTF-8'); ?>" 
                      required>
                    <small class="form-text text-muted">
                      <i class="fas fa-info-circle"></i> Aboneliğin bitiş tarihi
                    </small>
                  </div>
                </div>
              </div>

              <!-- Bilgi Kutusu -->
              <?php
                $kalangun = gunSayisiHesapla(date("Y-m-d"), date("Y-m-d", strtotime($abonelik->abonelik_bitis_tarihi)));
                $info_class = '';
                $info_icon = '';
                $info_text = '';
                
                if ($kalangun <= 0) {
                  $info_class = 'alert-danger';
                  $info_icon = 'fa-exclamation-triangle';
                  $info_text = 'Bu aboneliğin süresi dolmuş. Bitiş tarihini güncelleyin.';
                } elseif ($kalangun <= 30) {
                  $info_class = 'alert-warning';
                  $info_icon = 'fa-exclamation-circle';
                  $info_text = 'Bu aboneliğin süresi dolmak üzere (' . $kalangun . ' gün kaldı).';
                } else {
                  $info_class = 'alert-info';
                  $info_icon = 'fa-info-circle';
                  $info_text = 'Bu abonelik aktif. ' . $kalangun . ' gün kaldı.';
                }
              ?>
              <div class="alert <?php echo $info_class; ?> alert-modern mb-4" role="alert">
                <i class="fas <?php echo $info_icon; ?> mr-2"></i>
                <strong>Durum:</strong> <?php echo $info_text; ?>
              </div>

              <!-- Butonlar -->
              <div class="form-actions-modern d-flex justify-content-between align-items-center pt-3 border-top">
                <a href="<?php echo site_url('abonelik'); ?>" class="btn btn-secondary-modern">
                  <i class="fas fa-times"></i> İptal
                </a>
                <button type="submit" class="btn btn-primary-modern">
                  <i class="fas fa-save"></i> Güncelle
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

  textarea.form-control-modern {
    resize: vertical;
    min-height: 100px;
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

    .row .col-md-6 {
      margin-bottom: 0;
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
function validateDates() {
    const baslangicTarihi = document.getElementById("baslangic_tarihi").value;
    const bitisTarihi = document.getElementById("bitis_tarihi").value;

    if (baslangicTarihi && bitisTarihi && baslangicTarihi > bitisTarihi) {
        // Modern alert yerine SweetAlert veya Bootstrap modal kullanılabilir
        alert("⚠️ Hata: Başlangıç tarihi bitiş tarihinden büyük olamaz!");
        document.getElementById("baslangic_tarihi").focus();
        return false;
    }
    return true;
}

// Form gönderilirken loading state
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('abonelikForm');
    const submitBtn = form.querySelector('button[type="submit"]');
    
    form.addEventListener('submit', function(e) {
        if (validateDates()) {
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Güncelleniyor...';
            submitBtn.disabled = true;
        }
    });

    // Tarih değişikliklerinde otomatik kontrol
    const baslangicInput = document.getElementById('baslangic_tarihi');
    const bitisInput = document.getElementById('bitis_tarihi');
    
    [baslangicInput, bitisInput].forEach(input => {
        input.addEventListener('change', function() {
            if (baslangicInput.value && bitisInput.value) {
                if (baslangicInput.value > bitisInput.value) {
                    input.style.borderColor = '#dc3545';
                    input.style.boxShadow = '0 0 0 0.2rem rgba(220, 53, 69, 0.25)';
                } else {
                    input.style.borderColor = '#28a745';
                    input.style.boxShadow = '0 0 0 0.2rem rgba(40, 167, 69, 0.25)';
                }
            }
        });
    });
});
</script>
