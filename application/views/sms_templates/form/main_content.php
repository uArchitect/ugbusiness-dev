 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url()?>">Giriş</a></li>
              <li class="breadcrumb-item"><a href="<?=base_url('sms_templates')?>">SMS Metinleri</a></li>
              <li class="breadcrumb-item active"><?= !empty($template) ? 'Düzenle' : 'Ekle' ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<section class="content">
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
<div class="card card-primary">
    <div class="card-header with-border" style="background: linear-gradient(135deg, #001657 0%, #001657 100%);">
      <h3 class="card-title" style="color: white;"> SMS Şablonu Bilgileri</h3>
    </div>
  
    <?php if(!empty($template)){?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('sms_templates/save').'/'.$template->id;?>">
    <?php }else{?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('sms_templates/save');?>">
    <?php } ?>
    <div class="card-body">

      <div class="form-group">
        <label for="template_title"> Şablon Adı <span class="text-danger">*</span></label>
        <input type="text" value="<?php echo !empty($template) ? htmlspecialchars($template->title) : '';?>" class="form-control" name="title" required="" placeholder="Örn: Doğum Günü Tebrik Mesajı" autofocus="">
        <p style="color: red;"> <?php echo json_decode($this->session->flashdata('form_errors'))->title ?? ''; ?></p>
      </div>

      <div class="form-group">
        <label for="template_message"> SMS Metni <span class="text-danger">*</span></label>
        
        <!-- Dinamik Değişkenler Bilgi Kutusu -->
        <div class="alert alert-info" style="background-color: #e7f3ff; border-left: 4px solid #001657; border-radius: 6px; padding: 12px 15px; margin-bottom: 15px;">
          <div style="display: flex; align-items: start;">
            <i class="fas fa-info-circle mr-2" style="color: #001657; margin-top: 3px; font-size: 16px;"></i>
            <div style="flex: 1;">
              <strong style="color: #001657; font-size: 13px; display: block; margin-bottom: 8px;">Dinamik Değişkenler Kullanımı:</strong>
              <p style="margin: 0; font-size: 12px; color: #495057; line-height: 1.6;">
                SMS metninde kişiye özel bilgileri otomatik olarak eklemek için aşağıdaki değişkenleri kullanabilirsiniz. 
                Bu değişkenler SMS gönderilirken gerçek bilgilerle değiştirilecektir.
              </p>
              <div style="margin-top: 10px; padding-top: 10px; border-top: 1px solid rgba(0,22,87,0.1);">
                <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                  <span style="background-color: #001657; color: white; padding: 4px 10px; border-radius: 4px; font-size: 11px; font-family: monospace;">[PERSONEL_AD_SOYAD]</span>
                  <span style="background-color: #001657; color: white; padding: 4px 10px; border-radius: 4px; font-size: 11px; font-family: monospace;">[DEPARTMAN]</span>
                  <span style="background-color: #001657; color: white; padding: 4px 10px; border-radius: 4px; font-size: 11px; font-family: monospace;">[UNVAN]</span>
                </div>
                <small style="display: block; margin-top: 8px; color: #6c757d; font-size: 11px;">
                  <i class="fas fa-lightbulb mr-1"></i> Örnek: "[PERSONEL_AD_SOYAD] değerli çalışanımız, doğum gününüzü kutlarız!"
                </small>
              </div>
            </div>
          </div>
        </div>
        
        <textarea class="form-control" name="message" rows="6" required="" placeholder="SMS metnini buraya yazın... Örn: [PERSONEL_AD_SOYAD] değerli çalışanımız, doğum gününüzü kutlarız!" style="resize: vertical;"><?php echo !empty($template) ? htmlspecialchars($template->message) : '';?></textarea>
        <small class="form-text text-muted">
          <span id="charCount"><?= !empty($template) ? strlen($template->message) : '0' ?></span> karakter (SMS limiti: 160 karakter)
        </small>
        <p style="color: red;"> <?php echo json_decode($this->session->flashdata('form_errors'))->message ?? ''; ?></p>
      </div>

      <div class="form-group">
        <label for="template_is_active" style="display: block; margin-bottom: 8px; font-weight: 500; color: #495057;">
          Durum
        </label>
        <div class="custom-control custom-switch custom-switch-lg">
          <input type="checkbox" class="custom-control-input" name="is_active" value="1" id="template_is_active" <?= (!empty($template) && $template->is_active == 1) || empty($template) ? 'checked' : '' ?>>
          <label class="custom-control-label" for="template_is_active" style="font-weight: 500;">
            <span id="switch-label-text"><?= (!empty($template) && $template->is_active == 1) || empty($template) ? 'Aktif' : 'Pasif' ?></span>
          </label>
        </div>
        <small class="form-text text-muted d-block mt-2">Aktif şablonlar SMS gönderiminde kullanılabilir</small>
      </div>
      
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <div class="row">
        <div class="col"><a href="<?=base_url("sms_templates")?>"  class="btn btn-flat btn-danger"> İptal</a></div>
        <div class="col text-right"><button type="submit" class="btn btn-flat btn-primary"> Kaydet</button></div>
      </div>
    </div>
    <!-- /.card-footer-->

    </form>
  </div>
            <!-- /.card -->
    </div>
  </div>
</section>
</div>

<script>
// Karakter sayacı
document.addEventListener('DOMContentLoaded', function() {
  const messageField = document.querySelector('textarea[name="message"]');
  const charCount = document.getElementById('charCount');
  
  if (messageField && charCount) {
    // İlk yüklemede karakter sayısını güncelle
    charCount.textContent = messageField.value.length;
    
    // Input olayını dinle
    messageField.addEventListener('input', function() {
      const count = this.value.length;
      charCount.textContent = count;
      
      if (count > 160) {
        charCount.style.color = '#dc3545';
        charCount.parentElement.style.color = '#dc3545';
      } else {
        charCount.style.color = '#6c757d';
        charCount.parentElement.style.color = '#6c757d';
      }
    });
  }
  
  // Switch button label güncelleme
  const switchInput = document.getElementById('template_is_active');
  const switchLabel = document.getElementById('switch-label-text');
  
  if (switchInput && switchLabel) {
    switchInput.addEventListener('change', function() {
      switchLabel.textContent = this.checked ? 'Aktif' : 'Pasif';
    });
  }
});
</script>

<style>
.custom-switch-lg .custom-control-label {
  padding-left: 2.5rem;
  font-size: 1rem;
}

.custom-switch-lg .custom-control-label::before {
  left: -2.5rem;
  width: 3rem;
  height: 1.5rem;
  border-radius: 1.5rem;
  background-color: #adb5bd;
  border-color: #adb5bd;
}

.custom-switch-lg .custom-control-label::after {
  top: calc(0.25rem + 2px);
  left: calc(-2.5rem + 2px);
  width: calc(1.5rem - 4px);
  height: calc(1.5rem - 4px);
  border-radius: 1.5rem;
  background-color: #fff;
  transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-transform 0.15s ease-in-out;
  transition: transform 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  transition: transform 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-transform 0.15s ease-in-out;
}

.custom-switch-lg .custom-control-input:checked ~ .custom-control-label::before {
  background-color: #001657;
  border-color: #001657;
}

.custom-switch-lg .custom-control-input:checked ~ .custom-control-label::after {
  transform: translateX(1.5rem);
}

.custom-switch-lg .custom-control-input:focus ~ .custom-control-label::before {
  box-shadow: 0 0 0 0.2rem rgba(0, 22, 87, 0.25);
}
</style>

