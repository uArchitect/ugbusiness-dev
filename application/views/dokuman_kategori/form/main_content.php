 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Döküman Kategori Form</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url()?>">Giriş</a></li>
              <li class="breadcrumb-item active">Döküman Kategori Form</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<section class="content col-md-4">
<div class="card card-primary">
    <div class="card-header with-border">
      <h3 class="card-title"> Döküman Kategori Bilgileri</h3>
     
     
    </div>
  
    <?php if(!empty($dokuman_kategori)){?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('dokuman_kategori/save').'/'.$dokuman_kategori->dokuman_kategori_id;?>">
    <?php }else{?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('dokuman_kategori/save');?>">
    <?php } ?>
    <div class="card-body">

    

      <div class="form-group">
        <label for="formClient-Name"> Döküman Kategori Adı</label>
        <input type="text" value="<?php echo  !empty($dokuman_kategori) ? $dokuman_kategori->dokuman_kategori_adi : '';?>" class="form-control" name="dokuman_kategori_adi" required="" placeholder="Döküman Kategori Adını Giriniz..." autofocus="">
        <p style="color: red;"> <?php echo json_decode($this->session->flashdata('form_errors'))->dokuman_kategori_adi ?? ''; ?></p>
      </div>

      <div class="form-group">
        <label for="formClient-Code"> Döküman Kategori Açıklama</label>
        <input type="text" value="<?php echo !empty($dokuman_kategori) ? $dokuman_kategori->dokuman_kategori_aciklama : '';?>" class="form-control" name="dokuman_kategori_aciklama" placeholder="Döküman Kategori Açıklamasını Giriniz..." autofocus="">
        <p style="color: red;"> <?php echo json_decode($this->session->flashdata('form_errors'))->dokuman_kategori_aciklama ?? ''; ?></p>
      </div>
   
      <div class="form-group">
        <label for="formClient-Code"> Döküman Kategori Üst Kategori</label>
        
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <select name="dokuman_kategori_ust_kategori_id" class="form-control rounded-0" style="width: 100%;">
        <?php foreach($dokuman_kategorileri as $d_kategori) { 
              if(empty($dokuman_kategori)){
              ?>
                <option  value="<?=$d_kategori->dokuman_kategori_id?>" <?php echo  (!empty($dokuman_kategori) && $dokuman_kategori->dokuman_kategori_ust_kategori_id == $d_kategori->dokuman_kategori_id) ? 'selected="selected"'  : '';?>><?=$d_kategori->dokuman_kategori_adi?></option>       
              <?php
              }else if(!empty($dokuman_kategori) && $dokuman_kategori->dokuman_kategori_id != $d_kategori->dokuman_kategori_id){
                ?>
                <option  value="<?=$d_kategori->dokuman_kategori_id?>" <?php echo  (!empty($dokuman_kategori) && $dokuman_kategori->dokuman_kategori_ust_kategori_id == $d_kategori->dokuman_kategori_id) ? 'selected="selected"'  : '';?>><?=$d_kategori->dokuman_kategori_adi?></option>       
              <?php
              }
          ?> 

                 
          <?php } ?>  
                  </select>
                 
      </div>


      <div class="form-group">
        <label for="formClient-Code"> Sorumlu</label>
        <input type="text" value="<?php echo !empty($dokuman_kategori) ? $dokuman_kategori->kullanici_ad_soyad : $this->session->userdata('aktif_kullanici_ad_soyad'); ?>" disabled="" class="form-control" name="code" autofocus="">
       
      </div>

      <div class="form-group">
        <label for="formClient-Code"> Kayıt Tarihi</label>
        <input type="text" value="<?=strftime('%e %B %Y %A %H:%M')?>" disabled="" class="form-control" name="code" autofocus="">
     
      </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <div class="row">
        <div class="col"><a href="<?=base_url("dokuman_kategori")?>"  class="btn btn-flat btn-danger"> İptal</a></div>
        <div class="col text-right"><button type="submit" class="btn btn-flat btn-primary"> Kaydet</button></div>
      </div>
    </div>
    <!-- /.card-footer-->

    </form>
  </div>
            <!-- /.card -->
</section>
            </div>