 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">İlçe Form</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url()?>">Giriş</a></li>
              <li class="breadcrumb-item active">İlçe Form</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<section class="content col-md-4">
<div class="card card-primary">
    <div class="card-header with-border">
      <h3 class="card-title"> İlçe Bilgileri</h3>
     
     
    </div>
  
    <?php if(!empty($ilce)){?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('ilce/save').'/'.$ilce->ilce_id;?>">
    <?php }else{?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('ilce/save');?>">
    <?php } ?>
    <div class="card-body">

    

      <div class="form-group">
        <label for="formClient-Name"> İlçe Adı</label>
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <input type="text" value="<?php echo  !empty($ilce) ? $ilce->ilce_adi : '';?>" class="form-control" name="ilce_adi" required="" placeholder="İlçe Adını Giriniz..." autofocus="">
        <p style="color: red;"> <?php echo json_decode($this->session->flashdata('form_errors'))->ilce_adi ?? ''; ?></p>
      </div>
 

      <div class="form-group">
        <label for="formClient-Code"> İl</label>
        
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <select name="sehir_id" class="select2 form-control rounded-0" style="width: 100%;">
        <?php foreach($sehirler as $sehir) : ?> 
                    <option  value="<?=$sehir->sehir_id?>" <?php echo  (!empty($ilce) && $ilce->sehir_id == $sehir->sehir_id) ? 'selected="selected"'  : '';?>><?=$sehir->sehir_adi?></option>
      
          <?php endforeach; ?>  
                  </select>
                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
        Sisteme tanımlanmış <strong>sehir</strong> bilgilerine yeni kayıt eklemek için  Menü / Parametreler / İl - İlçe Yönetimi / <a href="<?=base_url("sehir/ekle")?>">+ Yeni Ekle</a> sekmesini kullanabilirsiniz.
        </p>
      </div>




    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <div class="row">
        <div class="col"><a href="<?=base_url("sehir")?>"  class="btn btn-flat btn-danger"> İptal</a></div>
        <div class="col text-right"><button type="submit" class="btn btn-flat btn-primary"> Kaydet</button></div>
      </div>
    </div>
    <!-- /.card-footer-->

    </form>
  </div>
            <!-- /.card -->
</section>
            </div>