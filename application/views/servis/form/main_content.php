 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Servis Kaydı Oluştur</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url()?>">Giriş</a></li>
              <li class="breadcrumb-item active">Servis Kaydı Oluştur</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<section class="content col-md-4">
<div class="card card-dark">
    <div class="card-header with-border">
      <h3 class="card-title"> Yeni Servis Kaydı Oluştur</h3>
     
     
    </div>
  
    <?php if(!empty($kullanici_yetki)){?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('Kullanici_yetkileri/save').'/'.$kullanici_yetki->kullanici_yetki_id;?>">
    <?php }else{?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('servis/servis_cihaz_sorgula');?>">
    <?php } ?>
    <div class="card-body">

    

      <div class="form-group">
        <label for="formClient-Name"> Cihaz Seri Numarası</label>
        <input type="text" class="form-control" value="<?=(!empty($_GET["data"]) ? $_GET["data"] : "")?>" name="cihaz_seri_numarasi" required placeholder="Servis Tanımlamak İstediğini Cihaz Seri Numarasını Giriniz..." autofocus="">
        <p style="color: red;"> <?php echo json_decode($this->session->flashdata('form_errors'))->kullanici_yetki_adi ?? ''; ?></p>
      </div>

       <div class="form-group">
       <button type="submit" class="btn btn-block btn-success btn-lg"><i class="fas fa-search"></i> Cihaz Sorgula</button>
      </div>
       
    </div>
    <!-- /.card-body -->

    
    <!-- /.card-footer-->

    </form>
  </div>
            <!-- /.card -->
</section>
            </div>