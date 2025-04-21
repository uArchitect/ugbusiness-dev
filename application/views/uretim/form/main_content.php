 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Üretim Form</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url()?>">Giriş</a></li>
              <li class="breadcrumb-item active">Üretim Form</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<section class="content col-md-4">
<div class="card card-primary">
    <div class="card-header with-border">
      <h3 class="card-title"> Üretim Bilgileri</h3>
     
     
    </div>
  
    <?php if(!empty($departman)){?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('departman/save').'/'.$departman->departman_id;?>">
    <?php }else{?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('departman/save');?>">
    <?php } ?>
    <div class="card-body">

    

      <div class="form-group">
        <label for="formClient-Name"> Üretim Adı</label>
        <input type="text" value="<?php echo  !empty($departman) ? $departman->departman_adi : '';?>" class="form-control" name="departman_adi" required="" placeholder="Üretim Adını Giriniz..." autofocus="">
        <p style="color: red;"> <?php echo json_decode($this->session->flashdata('form_errors'))->departman_adi ?? ''; ?></p>
      </div>

      <div class="form-group">
        <label for="formClient-Code"> Üretim Açıklama</label>
        <input type="text" value="<?php echo !empty($departman) ? $departman->departman_aciklama : '';?>" class="form-control" name="departman_aciklama" placeholder="Üretim Açıklamasını Giriniz..." autofocus="">
        <p style="color: red;"> <?php echo json_decode($this->session->flashdata('form_errors'))->departman_aciklama ?? ''; ?></p>
      </div>
  
      
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <div class="row">
        <div class="col"><a href="<?=base_url("departman")?>"  class="btn btn-flat btn-danger"> İptal</a></div>
        <div class="col text-right"><button type="submit" class="btn btn-flat btn-primary"> Kaydet</button></div>
      </div>
    </div>
    <!-- /.card-footer-->

    </form>
  </div>
            <!-- /.card -->
</section>
            </div>