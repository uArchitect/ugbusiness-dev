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
                  <i class="fas fa-building" style="color: #ffffff; font-size: 18px;"></i>
                </div>
                <div>
                  <h3 class="mb-0" style="color: #ffffff; font-weight: 700; font-size: 20px; letter-spacing: 0.5px; line-height: 1.2;">
                    <?php echo !empty($departman) ? 'Departman Düzenle' : 'Yeni Departman Ekle'; ?>
                  </h3>
                  <small style="color: rgba(255,255,255,0.9); font-size: 13px; line-height: 1.4;">
                    <?php echo !empty($departman) ? 'Departman bilgilerini güncelleyin' : 'Yeni departman kaydı oluşturun'; ?>
                  </small>
                </div>
              </div>
              <a href="<?php echo site_url('departman'); ?>" class="btn btn-light btn-sm shadow-sm" style="border-radius: 8px; font-weight: 600;">
                <i class="fas fa-arrow-left"></i> Listeye Dön
              </a>
            </div>
          </div>
          
          <!-- Card Body -->
          <div class="card-body" style="padding: 30px; background-color: #ffffff;">
            <?php if(!empty($departman)): ?>
              <form class="form-horizontal" method="POST" action="<?php echo site_url('departman/save').'/'.$departman->departman_id;?>" id="departmanForm">
            <?php else: ?>
              <form class="form-horizontal" method="POST" action="<?php echo site_url('departman/save');?>" id="departmanForm">
            <?php endif; ?>
              
              <!-- Departman Adı -->
              <div class="form-group-modern mb-4">
                <label for="departman_adi" class="form-label-modern">
                  <i class="fas fa-building text-primary mr-2"></i>
                  Departman Adı <span class="text-danger">*</span>
                </label>
                <input 
                  type="text" 
                  name="departman_adi" 
                  id="departman_adi" 
                  class="form-control form-control-modern" 
                  required
                  value="<?php echo !empty($departman) ? htmlspecialchars($departman->departman_adi) : ''; ?>"
                  placeholder="Departman adını giriniz">
                <?php if(json_decode($this->session->flashdata('form_errors'))->departman_adi ?? ''): ?>
                  <p style="color: red; margin-top: 5px; font-size: 13px;">
                    <i class="fas fa-exclamation-circle"></i> <?php echo json_decode($this->session->flashdata('form_errors'))->departman_adi; ?>
                  </p>
                <?php endif; ?>
                <small class="form-text text-muted">
                  <i class="fas fa-info-circle"></i> Departman için açıklayıcı bir ad giriniz
                </small>
              </div>

              <!-- Departman Açıklama -->
              <div class="form-group-modern mb-4">
                <label for="departman_aciklama" class="form-label-modern">
                  <i class="fas fa-align-left text-primary mr-2"></i>
                  Departman Açıklama
                </label>
                <input 
                  type="text" 
                  name="departman_aciklama" 
                  id="departman_aciklama" 
                  class="form-control form-control-modern" 
                  value="<?php echo !empty($departman) ? htmlspecialchars($departman->departman_aciklama) : ''; ?>"
                  placeholder="Departman açıklamasını giriniz (isteğe bağlı)">
                <?php if(json_decode($this->session->flashdata('form_errors'))->departman_aciklama ?? ''): ?>
                  <p style="color: red; margin-top: 5px; font-size: 13px;">
                    <i class="fas fa-exclamation-circle"></i> <?php echo json_decode($this->session->flashdata('form_errors'))->departman_aciklama; ?>
                  </p>
                <?php endif; ?>
                <small class="form-text text-muted">
                  <i class="fas fa-info-circle"></i> Departman hakkında detaylı bilgi (isteğe bağlı)
                </small>
              </div>

              <!-- Yönetici Seçimi -->
              <div class="form-group-modern mb-4">
                <label for="departman_sorumlu_kullanici_id" class="form-label-modern">
                  <i class="fas fa-user-tie text-success mr-2"></i>
                  Departman Yöneticisi
                </label>
                <select 
                  name="departman_sorumlu_kullanici_id" 
                  id="departman_sorumlu_kullanici_id" 
                  class="form-control form-control-modern select2"
                  style="width: 100%;">
                  <option value="">Yönetici Seçiniz (İsteğe Bağlı)</option>
                  <?php if(!empty($kullanicilar)): ?>
                    <?php foreach ($kullanicilar as $kullanici): ?>
                      <option value="<?=$kullanici->kullanici_id?>" 
                        <?php echo (!empty($departman) && isset($departman->departman_sorumlu_kullanici_id) && $departman->departman_sorumlu_kullanici_id == $kullanici->kullanici_id) ? 'selected' : ''; ?>>
                        <?=$kullanici->kullanici_ad_soyad?>
                      </option>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </select>
                <small class="form-text text-muted">
                  <i class="fas fa-info-circle"></i> Bu departmanın yöneticisini seçiniz (isteğe bağlı)
                </small>
              </div>

              <!-- Butonlar -->
              <div class="form-actions-modern d-flex justify-content-between align-items-center pt-3 border-top">
                <a href="<?php echo site_url('departman'); ?>" class="btn btn-secondary-modern">
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

  select.form-control-modern {
    height: auto;
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

  .form-text {
    font-size: 12px;
    margin-top: 6px;
    color: #6c757d;
  }

  .form-text i {
    margin-right: 4px;
  }
</style>

<script>
$(document).ready(function() {
    // Select2 initialization
    if ($.fn.select2) {
        $('#departman_sorumlu_kullanici_id').select2({
            theme: 'bootstrap4',
            placeholder: 'Yönetici Seçiniz (İsteğe Bağlı)',
            allowClear: true
        });
    }
});
</script>
