 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">İş Tipi Form</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url()?>">Giriş</a></li>
              <li class="breadcrumb-item active">İş Tipi Form</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<section class="content col-md-4">
<div class="card card-primary">
    <div class="card-header with-border">
      <h3 class="card-title"> İş Tipi Bilgileri</h3>
     
     
    </div>
  
    <?php if(!empty($is_tip)){?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('is_tip/save').'/'.$is_tip->is_tip_id;?>">
    <?php }else{?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('is_tip/save');?>">
    <?php } ?>
    <div class="card-body">

    

      <div class="form-group">
        <label for="formClient-Name"> İş Tipi Adı</label>
        <input type="text" value="<?php echo  !empty($is_tip) ? $is_tip->is_tip_adi : '';?>" class="form-control" name="is_tip_adi" required="" placeholder="İş Tipi Adını Giriniz..." autofocus="">
        <p style="color: red;"> <?php echo json_decode($this->session->flashdata('form_errors'))->is_tip_adi ?? ''; ?></p>
      </div>

      <div class="form-group">
        <label for="formClient-Code"> İş Tipi Açıklama</label>
        <input type="text" value="<?php echo !empty($is_tip) ? $is_tip->is_tip_aciklama : '';?>" class="form-control" name="is_tip_aciklama" placeholder="İş Tipi Açıklamasını Giriniz..." autofocus="">
        <p style="color: red;"> <?php echo json_decode($this->session->flashdata('form_errors'))->is_tip_aciklama ?? ''; ?></p>
      </div>
  


      <div class="form-group">
        <label for="formClient-Code"> Kategori</label>
        
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <select name="kategori_id" required class="select2 form-control rounded-0" style="width: 100%;">
        <?php foreach($istek_kategorileri as $kategori) : ?> 
                    <option  value="<?=$kategori->istek_kategori_id?>" <?php echo  (!empty($is_tip) && $is_tip->kategori_id == $kategori->istek_kategori_id) ? 'selected="selected"'  : '';?>><?=$kategori->istek_kategori_adi?></option>
      
          <?php endforeach; ?>  
                  </select>
                  
      </div>


      <div class="form-group">
        <label for="formClient-Code"> Sorumlu</label>
        <input type="text" value="<?php echo !empty($is_tip) ? $is_tip->kullanici_ad_soyad : $this->session->userdata('aktif_kullanici_ad_soyad'); ?>" disabled="" class="form-control" name="code" autofocus="">
       
      </div>

      <div class="form-group">
        <label for="formClient-Code"> Kayıt Tarihi</label>
        <input type="text" value="<?=strftime('%e %B %Y %A %H:%M')?>" disabled="" class="form-control" name="code" autofocus="">
     
      </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <div class="row">
        <div class="col"><a href="<?=base_url("is_tip")?>"  class="btn btn-flat btn-danger"> İptal</a></div>
        <div class="col text-right"><button type="submit" class="btn btn-flat btn-primary"> Kaydet</button></div>
      </div>
    </div>
    <!-- /.card-footer-->

    </form>
  </div>
            <!-- /.card -->
</section>
            </div>