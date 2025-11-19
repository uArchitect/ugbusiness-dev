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
                  <i class="fas fa-calendar-plus" style="color: #ffffff; font-size: 18px;"></i>
                </div>
                <div>
                  <h3 class="mb-0" style="color: #ffffff; font-weight: 700; font-size: 20px; letter-spacing: 0.5px; line-height: 1.2;">
                    İzin Talebi Oluştur
                  </h3>
                  <small style="color: rgba(255,255,255,0.9); font-size: 13px; line-height: 1.4;">Yeni izin talebi oluşturun</small>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Card Body -->
          <div class="card-body" style="padding: 30px; background-color: #ffffff;">
            <form action="<?php echo site_url('izin/talebi_kaydet'); ?>" method="post" onsubmit="return validateIzinForm()" id="izinTalebiForm">
              
              <!-- Tarih Alanları -->
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group-modern mb-4">
                    <label for="izin_baslangic_tarihi" class="form-label-modern">
                      <i class="fas fa-calendar-check text-success mr-2"></i>
                      İzin Başlangıç Tarihi <span class="text-danger">*</span>
                    </label>
                    <input 
                      type="datetime-local" 
                      name="izin_baslangic_tarihi" 
                      id="izin_baslangic_tarihi" 
                      class="form-control form-control-modern" 
                      required>
                    <small class="form-text text-muted">
                      <i class="fas fa-info-circle"></i> İzin başlangıç tarihi ve saati
                    </small>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group-modern mb-4">
                    <label for="izin_bitis_tarihi" class="form-label-modern">
                      <i class="fas fa-calendar-times text-danger mr-2"></i>
                      İzin Bitiş Tarihi <span class="text-danger">*</span>
                    </label>
                    <input 
                      type="datetime-local" 
                      name="izin_bitis_tarihi" 
                      id="izin_bitis_tarihi" 
                      class="form-control form-control-modern" 
                      required>
                    <small class="form-text text-muted">
                      <i class="fas fa-info-circle"></i> İzin bitiş tarihi ve saati
                    </small>
                  </div>
                </div>
              </div>

              <!-- İzin Nedeni -->
              <div class="form-group-modern mb-4">
                <label for="izin_neden_no" class="form-label-modern">
                  <i class="fas fa-question-circle text-primary mr-2"></i>
                  İzin Nedeni <span class="text-danger">*</span>
                </label>
                <select 
                  name="izin_neden_no" 
                  id="izin_neden_no" 
                  class="form-control form-control-modern" 
                  required>
                  <option value="">Seçim Yapınız</option>
                  <?php 
                  foreach ($nedenler as $neden) {
                    ?>
                    <option value="<?=$neden->izin_neden_id?>"><?=$neden->izin_neden_detay?></option>
                    <?php
                  }
                  ?>
                </select>
                <small class="form-text text-muted">
                  <i class="fas fa-info-circle"></i> İzin nedeninizi seçiniz
                </small>
              </div>

              <!-- İzin Notu -->
              <div class="form-group-modern mb-4">
                <label for="izin_notu" class="form-label-modern">
                  <i class="fas fa-align-left text-primary mr-2"></i>
                  İzin Notu
                </label>
                <textarea 
                  name="izin_notu" 
                  id="izin_notu" 
                  class="form-control form-control-modern" 
                  rows="4"
                  placeholder="İzin talebiniz hakkında ek bilgi vermek isterseniz buraya yazabilirsiniz (isteğe bağlı)"></textarea>
                <small class="form-text text-muted">
                  <i class="fas fa-info-circle"></i> İzin talebiniz hakkında ek açıklama (isteğe bağlı)
                </small>
              </div>

              <!-- Bilgi Kutusu -->
              <div class="alert alert-info alert-modern mb-4" role="alert">
                <i class="fas fa-lightbulb mr-2"></i>
                <strong>İpucu:</strong> İzin başlangıç tarihi bitiş tarihinden önce olmalıdır. Talebiniz onay sürecine gönderilecektir.
              </div>

              <!-- Butonlar -->
              <div class="form-actions-modern d-flex justify-content-end align-items-center pt-3 border-top">
                <button type="submit" class="btn btn-primary-modern">
                  <i class="fas fa-paper-plane"></i> Talebi Gönder
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

  select.form-control-modern {
    cursor: pointer;
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

  .btn-primary-modern:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
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
function validateIzinForm() {
    const baslangicTarihi = document.getElementById("izin_baslangic_tarihi").value;
    const bitisTarihi = document.getElementById("izin_bitis_tarihi").value;
    const izinNedeni = document.getElementById("izin_neden_no").value;

    if (!baslangicTarihi || !bitisTarihi) {
        alert("⚠️ Hata: Lütfen başlangıç ve bitiş tarihlerini giriniz!");
        return false;
    }

    if (baslangicTarihi >= bitisTarihi) {
        alert("⚠️ Hata: Başlangıç tarihi bitiş tarihinden önce olmalıdır!");
        document.getElementById("izin_baslangic_tarihi").focus();
        return false;
    }

    if (!izinNedeni) {
        alert("⚠️ Hata: Lütfen izin nedenini seçiniz!");
        document.getElementById("izin_neden_no").focus();
        return false;
    }

    return true;
}

// Form gönderilirken loading state
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('izinTalebiForm');
    const submitBtn = form.querySelector('button[type="submit"]');
    
    form.addEventListener('submit', function(e) {
        if (validateIzinForm()) {
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Gönderiliyor...';
            submitBtn.disabled = true;
        } else {
            e.preventDefault();
        }
    });

    // Tarih değişikliklerinde otomatik kontrol
    const baslangicInput = document.getElementById('izin_baslangic_tarihi');
    const bitisInput = document.getElementById('izin_bitis_tarihi');
    
    // Bugünün tarihini varsayılan olarak ayarla
    const today = new Date();
    today.setMinutes(today.getMinutes() - today.getTimezoneOffset());
    const todayISO = today.toISOString().slice(0, 16);
    
    [baslangicInput, bitisInput].forEach(input => {
        input.addEventListener('change', function() {
            if (baslangicInput.value && bitisInput.value) {
                if (baslangicInput.value >= bitisInput.value) {
                    input.style.borderColor = '#dc3545';
                    input.style.boxShadow = '0 0 0 0.2rem rgba(220, 53, 69, 0.25)';
                } else {
                    input.style.borderColor = '#28a745';
                    input.style.boxShadow = '0 0 0 0.2rem rgba(40, 167, 69, 0.25)';
                }
            } else {
                input.style.borderColor = '#e0e0e0';
                input.style.boxShadow = 'none';
            }
        });
    });

    // Başlangıç tarihi değiştiğinde, bitiş tarihinin minimum değerini güncelle
    baslangicInput.addEventListener('change', function() {
        if (baslangicInput.value) {
            // Başlangıç tarihinden 1 saat sonrasını minimum yap
            const baslangicDate = new Date(baslangicInput.value);
            baslangicDate.setHours(baslangicDate.getHours() + 1);
            const minDate = baslangicDate.toISOString().slice(0, 16);
            bitisInput.setAttribute('min', minDate);
            
            // Eğer bitiş tarihi başlangıç tarihinden önceyse, güncelle
            if (bitisInput.value && bitisInput.value <= baslangicInput.value) {
                bitisInput.value = minDate;
            }
        }
    });
});
</script>

