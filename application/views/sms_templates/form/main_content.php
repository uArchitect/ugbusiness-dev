 
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
        <textarea class="form-control" name="message" rows="6" required="" placeholder="SMS metnini buraya yazın..." style="resize: vertical;"><?php echo !empty($template) ? htmlspecialchars($template->message) : '';?></textarea>
        <small class="form-text text-muted">
          <span id="charCount"><?= !empty($template) ? strlen($template->message) : '0' ?></span> karakter (SMS limiti: 160 karakter)
        </small>
        <p style="color: red;"> <?php echo json_decode($this->session->flashdata('form_errors'))->message ?? ''; ?></p>
      </div>

      <div class="form-group">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="is_active" value="1" id="template_is_active" <?= (!empty($template) && $template->is_active == 1) || empty($template) ? 'checked' : '' ?>>
          <label class="form-check-label" for="template_is_active">
            <i class="fas fa-check-circle mr-1"></i> Aktif
          </label>
          <small class="form-text text-muted d-block">Aktif şablonlar SMS gönderiminde kullanılabilir</small>
        </div>
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
});
</script>

