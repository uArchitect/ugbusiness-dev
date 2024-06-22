 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Yemek Menü Form</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url()?>">Giriş</a></li>
              <li class="breadcrumb-item active">Yemek Menü Form</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<section class="content col-md-4">
<div class="card card-primary">
    <div class="card-header with-border">
      <h3 class="card-title"> Yemek Menü Bilgileri</h3>
     
     
    </div>
  
 
    <form class="form-horizontal" method="POST" action="<?php echo site_url('yemek/save')?>">
 
    <div class="card-body">

    

      <?php
      $guncelTarih = getdate();
      $gunSayisi = date('t', mktime(0, 0, 0, $guncelTarih['mon'], 1, $guncelTarih['year']));
      
      
      
      foreach ($yemekler as $yemek) { ?>
          <div class="form-group">
            <label for="formClient-Name" class="<?php if($yemek->yemek_id > $gunSayisi) echo "text-danger"; ?>"><?=$yemek->yemek_id?>.<?=date("m.Y")?> - Yemek Menü :</label>
            <input type="text" class="form-control" value="<?=$yemek->yemek_detay?>" name="yemekbilgileri[]" placeholder="<?=$yemek->yemek_id?>.<?=date("m.Y")?> - Yemek Menü Bilgisini Giriniz..." autofocus="">
          </div>
        <?php } ?>

       
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