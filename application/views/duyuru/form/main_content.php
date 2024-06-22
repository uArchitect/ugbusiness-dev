 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Duyuru Form</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url()?>">Giriş</a></li>
              <li class="breadcrumb-item active">Duyuru Form</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<section class="content col-md-4">
<div class="card card-primary">
    <div class="card-header with-border">
      <h3 class="card-title"> Duyuru Bilgileri</h3>
     
     
    </div>
  
    <?php if(!empty($duyuru)){?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('duyuru/save').'/'.$duyuru->duyuru_id;?>">
    <?php }else{?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('duyuru/save');?>">
    <?php } ?>
    <div class="card-body">

    

      <div class="form-group">
        <label for="formClient-Name"> Duyuru Adı</label>
        <input type="text" value="<?php echo  !empty($duyuru) ? $duyuru->duyuru_adi : '';?>" class="form-control" name="duyuru_adi" required="" placeholder="Duyuru Adını Giriniz..." autofocus="">
        <p style="color: red;"> <?php echo json_decode($this->session->flashdata('form_errors'))->duyuru_adi ?? ''; ?></p>
      </div>

      <div class="form-group">
        <label for="formClient-Code"> Duyuru Açıklama</label>
        <input type="text" value="<?php echo !empty($duyuru) ? $duyuru->duyuru_aciklama : '';?>" class="form-control" name="duyuru_aciklama" placeholder="Duyuru Açıklamasını Giriniz..." autofocus="">
        <p style="color: red;"> <?php echo json_decode($this->session->flashdata('form_errors'))->duyuru_aciklama ?? ''; ?></p>
      </div>
  


      <div class="form-group">
        <label for="formClient-Code"> Kategori</label> 
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <select name="kategori_id" class="select2 form-control rounded-0" style="width: 100%;">
        <?php foreach($duyuru_kategorileri as $kategori) : ?> 
                    <option  value="<?=$kategori->duyuru_kategori_id?>" <?php echo  (!empty($duyuru) && $duyuru->kategori_id == $kategori->duyuru_kategori_id) ? 'selected="selected"'  : '';?>><?=$kategori->duyuru_kategori_adi?></option>
      
          <?php endforeach; ?>  
                  </select>
                  
      </div>


      <div class="form-group">
        <label for="formClient-Code"> Duyuru Geçerlilik Tarihi</label>
        <input type="date" required value="<?php echo !empty($duyuru) ? date("Y-m-d",strtotime($duyuru->duyuru_bitis_tarihi)) : date( "Y-m-d", strtotime( date("Y-m-d")." +7 day" ) );?>" class="form-control" name="duyuru_bitis_tarihi"  id="duyuru_bitis_tarihi"  autofocus="">
        <div class="btn-group mt-1" style="    width: 100%;">
          <button type="button" class="btn btn-default" onclick="document.getElementById('duyuru_bitis_tarihi').value = new Date(new Date().getTime() + 1 * 24 * 60 * 60 * 1000).toISOString().split('T')[0]"><i class="fa fa-plus-circle text-success"></i> 1 Gün</button>
          <button type="button" class="btn btn-default" onclick="document.getElementById('duyuru_bitis_tarihi').value = new Date(new Date().getTime() + 7 * 24 * 60 * 60 * 1000).toISOString().split('T')[0]"><i class="fa fa-plus-circle text-success"></i> 1 Hafta</button>
          <button type="button" class="btn btn-default" onclick="document.getElementById('duyuru_bitis_tarihi').value = new Date(new Date().getTime() + 31 * 24 * 60 * 60 * 1000).toISOString().split('T')[0]"><i class="fa fa-plus-circle text-success"></i> 1 Ay</button>
          <button type="button" class="btn btn-default" onclick="document.getElementById('duyuru_bitis_tarihi').value = new Date(new Date().getTime() + 365 * 24 * 60 * 60 * 1000).toISOString().split('T')[0]"><i class="fa fa-plus-circle text-success"></i> 1 Yıl</button>
        </div>
      </div>


     
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <div class="row">
        <div class="col"><a href="<?=base_url("duyuru")?>"  class="btn btn-flat btn-danger"> İptal</a></div>
        <div class="col text-right"><button type="submit" class="btn btn-flat btn-primary"> Kaydet</button></div>
      </div>
    </div>
    <!-- /.card-footer-->

    </form>
  </div>
            <!-- /.card -->
</section>
            </div>