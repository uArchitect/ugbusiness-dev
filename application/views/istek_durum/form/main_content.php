 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">İstek Durum Form</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url()?>">Giriş</a></li>
              <li class="breadcrumb-item active">İstek Durum Form</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<section class="content col-md-4">
<div class="card card-primary">
    <div class="card-header with-border">
      <h3 class="card-title"> İstek Durum Bilgileri</h3>
     
     
    </div>
  
    <?php if(!empty($istek_durum)){?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('istek_durum/save').'/'.$istek_durum->istek_durum_id;?>">
    <?php }else{?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('istek_durum/save');?>">
    <?php } ?>
    <div class="card-body">

    

      <div class="form-group">
        <label for="formClient-Name"> İstek Durum Adı</label>
        <input type="text" value="<?php echo  !empty($istek_durum) ? $istek_durum->istek_durum_adi : '';?>" class="form-control" name="istek_durum_adi" required="" placeholder="İstek Durum Adını Giriniz..." autofocus="">
        <p style="color: red;"> <?php echo json_decode($this->session->flashdata('form_errors'))->istek_durum_adi ?? ''; ?></p>
      </div>

      <div class="form-group">
        <label for="formClient-Code"> İstek Durum Açıklama</label>
        <input type="text" value="<?php echo !empty($istek_durum) ? $istek_durum->istek_durum_aciklama : '';?>" class="form-control" name="istek_durum_aciklama" placeholder="İstek Durum Açıklamasını Giriniz..." autofocus="">
        <p style="color: red;"> <?php echo json_decode($this->session->flashdata('form_errors'))->istek_durum_aciklama ?? ''; ?></p>
      </div>
      <div class="form-group">
        <label for="formClient-Code"> İstek Durum Rengi</label>
        <select class="select2 form-control rounded-0" name="istek_durum_renk">
          <option <?php echo (!empty($istek_durum) && $istek_durum->istek_durum_renk == "warning") ? 'selected' : '' ;?>  value="warning">Sarı</option>
          <option <?php echo (!empty($istek_durum) && $istek_durum->istek_durum_renk == "primary") ? 'selected' : '' ;?> value="primary">Mavi</option>
          <option <?php echo (!empty($istek_durum) && $istek_durum->istek_durum_renk == "dark") ? 'selected' : '' ;?> value="dark">Siyah</option>
          <option <?php echo (!empty($istek_durum) && $istek_durum->istek_durum_renk == "success") ? 'selected' : '' ;?> value="success">Yeşil</option>
          <option <?php echo (!empty($istek_durum) && $istek_durum->istek_durum_renk == "danger") ? 'selected' : '' ;?> value="danger">Kırmızı</option>
        </select>
      </div>
      <div class="form-group">
        <label for="formClient-Code"> Sorumlu</label>
        <input type="text" value="<?php echo !empty($istek_durum) ? $istek_durum->kullanici_ad_soyad : $this->session->userdata('aktif_kullanici_ad_soyad'); ?>" disabled="" class="form-control" name="code" autofocus="">
       
      </div>

      <div class="form-group">
        <label for="formClient-Code"> Kayıt Tarihi</label>
        <input type="text" value="<?=strftime('%e %B %Y %A %H:%M')?>" disabled="" class="form-control" name="code" autofocus="">
     
      </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <div class="row">
        <div class="col"><a href="<?=base_url("istek_durum")?>"  class="btn btn-flat btn-danger"> İptal</a></div>
        <div class="col text-right"><button type="submit" class="btn btn-flat btn-primary"> Kaydet</button></div>
      </div>
    </div>
    <!-- /.card-footer-->

    </form>
  </div>
            <!-- /.card -->
</section>
            </div>