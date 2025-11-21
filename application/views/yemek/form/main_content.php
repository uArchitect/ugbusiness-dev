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
                  <i class="fas fa-utensils" style="color: #ffffff; font-size: 18px;"></i>
                </div>
                <div>
                  <h3 class="mb-0" style="color: #ffffff; font-weight: 700; font-size: 20px; letter-spacing: 0.5px; line-height: 1.2;">
                    Yemek Menü Form
                  </h3>
                  <small style="color: rgba(255,255,255,0.9); font-size: 13px; line-height: 1.4;">Günlük yemek menülerini düzenleyin</small>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Card Body -->
          <div class="card-body" style="padding: 30px; background-color: #ffffff;">
            <form class="form-horizontal" method="POST" action="<?php echo site_url('yemek/save')?>" id="yemekForm">
              <?php
              $guncelTarih = getdate();
              $gunSayisi = date('t', mktime(0, 0, 0, $guncelTarih['mon'], 1, $guncelTarih['year']));
              $bugununGunu = (int)date("d"); // Bugünün gün numarası
              
              foreach ($yemekler as $yemek) { 
                // Geçmiş günleri hidden input olarak ekle (index kaymasını önlemek için)
                if($yemek->yemek_id < $bugununGunu) {
                  // Geçmiş günler için hidden input ekle
                  echo '<input type="hidden" name="yemekbilgileri[]" value="' . htmlspecialchars($yemek->yemek_detay) . '">';
                  continue; // Geçmiş günleri görsel olarak gösterme
                }
              ?>
                <div class="form-group-modern mb-4">
                  <label for="yemek_<?=$yemek->yemek_id?>" class="form-label-modern">
                    <i class="fas fa-calendar-day <?php if($yemek->yemek_id > $gunSayisi) echo "text-danger"; else echo "text-primary"; ?> mr-2"></i>
                    <?=$yemek->yemek_id?>.<?=date("m.Y")?> - Yemek Menü 
                    <?php if($yemek->yemek_id > $gunSayisi): ?>
                      <span class="text-danger">(Geçersiz Tarih)</span>
                    <?php endif; ?>
                  </label>
                  <input 
                    type="text" 
                    class="form-control form-control-modern <?php if($yemek->yemek_id > $gunSayisi) echo "border-danger"; ?>" 
                    value="<?=$yemek->yemek_detay?>" 
                    name="yemekbilgileri[]" 
                    id="yemek_<?=$yemek->yemek_id?>"
                    placeholder="<?=$yemek->yemek_id?>.<?=date("m.Y")?> - Yemek Menü Bilgisini Giriniz...">
                  <small class="form-text text-muted">
                    <i class="fas fa-info-circle"></i> <?=$yemek->yemek_id?>. günün yemek menüsünü giriniz
                  </small>
                </div>
              <?php } ?>

              <!-- Butonlar -->
              <div class="form-actions-modern d-flex justify-content-between align-items-center pt-3 border-top">
                <a href="<?=base_url("departman")?>" class="btn btn-secondary-modern">
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

  .form-control-modern.border-danger {
    border-color: #dc3545;
  }

  .form-control-modern.border-danger:focus {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.15);
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
// Form gönderilirken loading state
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('yemekForm');
    const submitBtn = form.querySelector('button[type="submit"]');
    
    form.addEventListener('submit', function(e) {
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Kaydediliyor...';
        submitBtn.disabled = true;
    });
});
</script>