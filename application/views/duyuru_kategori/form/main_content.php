 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Duyuru Kategori Form</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url()?>">Giriş</a></li>
              <li class="breadcrumb-item active">Duyuru Kategori Form</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<section class="content col-md-4">
<div class="card card-primary">
    <div class="card-header with-border">
      <h3 class="card-title"> Duyuru Kategori Bilgileri</h3>
     
     
    </div>
  
    <?php if(!empty($duyuru_kategori)){?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('duyuru_kategori/save').'/'.$duyuru_kategori->duyuru_kategori_id;?>">
    <?php }else{?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('duyuru_kategori/save');?>">
    <?php } ?>
    <div class="card-body">

    

      <div class="form-group">
        <label for="formClient-Name"> Duyuru Kategori Adı</label>
        <input type="text" value="<?php echo  !empty($duyuru_kategori) ? $duyuru_kategori->duyuru_kategori_adi : '';?>" class="form-control" name="duyuru_kategori_adi" required="" placeholder="Duyuru Kategori Adını Giriniz..." autofocus="">
        <p style="color: red;"> <?php echo json_decode($this->session->flashdata('form_errors'))->duyuru_kategori_adi ?? ''; ?></p>
      </div>

      <div class="form-group">
        <label for="formClient-Code"> Duyuru Kategori Açıklama</label>
        <input type="text" value="<?php echo !empty($duyuru_kategori) ? $duyuru_kategori->duyuru_kategori_aciklama : '';?>" class="form-control" name="duyuru_kategori_aciklama" placeholder="Duyuru Kategori Açıklamasını Giriniz..." autofocus="">
        <p style="color: red;"> <?php echo json_decode($this->session->flashdata('form_errors'))->duyuru_kategori_aciklama ?? ''; ?></p>
      </div>
   
    


      <div class="form-group">
        <label for="formClient-Code"> Sorumlu</label>
        <input type="text" value="<?php echo !empty($duyuru_kategori) ? $duyuru_kategori->kullanici_ad_soyad : $this->session->userdata('aktif_kullanici_ad_soyad'); ?>" disabled="" class="form-control" name="code" autofocus="">
       
      </div>

      <div class="form-group">
        <label for="formClient-Code"> Kayıt Tarihi</label>
        <input type="text" value="<?=strftime('%e %B %Y %A %H:%M')?>" disabled="" class="form-control" name="code" autofocus="">
     
      </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <div class="row">
        <div class="col"><a href="<?=base_url("duyuru-kategori")?>"  class="btn btn-flat btn-danger"> İptal</a></div>
        <div class="col text-right"><button type="submit" class="btn btn-flat btn-primary"> Kaydet</button></div>
      </div>
    </div>
    <!-- /.card-footer-->

    </form>
  </div>
            <!-- /.card -->
</section>
            </div>