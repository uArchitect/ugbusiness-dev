 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Kullanıcı Yetki Form</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url()?>">Giriş</a></li>
              <li class="breadcrumb-item active">Kullanıcı Yetki Form</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<section class="content col-md-4">
<div class="card card-dark">
    <div class="card-header with-border">
      <h3 class="card-title"> Kullanıcı Yetkisi Oluştur</h3>
     
     
    </div>
  
    <?php if(!empty($kullanici_yetki)){?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('Kullanici_yetkileri/save').'/'.$kullanici_yetki->kullanici_yetki_id;?>">
    <?php }else{?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('Kullanici_yetkileri/save');?>">
    <?php } ?>
    <div class="card-body">

    

      <div class="form-group">
        <label for="formClient-Name"> Kullanıcı Yetki Tanımı</label>
        <input type="text" value="<?php echo  !empty($kullanici_yetki) ? $kullanici_yetki->kullanici_yetki_adi : '';?>" class="form-control" name="kullanici_yetki_adi" required="" placeholder="Kullanıcı Yetki Adını Giriniz..." autofocus="">
        <p style="color: red;"> <?php echo json_decode($this->session->flashdata('form_errors'))->kullanici_yetki_adi ?? ''; ?></p>
      </div>

      <div class="form-group">
        <label for="formClient-Code"> Kullanıcı Yetki Kodu</label>
        <input type="text" value="<?php echo !empty($kullanici_yetki) ? $kullanici_yetki->kullanici_yetki_kodu : '';?>" class="form-control" name="kullanici_yetki_kodu" required="" placeholder="Kullanıcı Yetki Kodunu Giriniz..." autofocus="">
        <p style="color: red;"> <?php echo json_decode($this->session->flashdata('form_errors'))->kullanici_yetki_kodu ?? ''; ?></p>
      </div>
 <div class="form-group">
        <label for="formClient-Code"> Kullanıcı Yetki Grubu</label>
        <select name="yetki_grup_id" class="form-control rounded-0" style="width: 100%;">
          <?php foreach($kullanici_yetki_gruplari as $kullanici_yetki_grup) : ?>
                    <option value="<?=$kullanici_yetki_grup->kullanici_yetki_grup_id?>" <?php echo  (!empty($kullanici_yetki) && $kullanici_yetki->yetki_grup_id == $kullanici_yetki_grup->kullanici_yetki_grup_id) ? 'selected="selected"'  : '';?>><?=$kullanici_yetki_grup->kullanici_yetki_grup_adi?></option>
          <?php endforeach; ?>         
        </select>
      </div>
       
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <div class="row">
        <div class="col"><a href="<?=base_url("kullanici-yetkileri")?>"  class="btn btn-flat btn-danger"> İptal</a></div>
        <div class="col text-right"><button type="submit" class="btn btn-flat btn-primary"> Kaydet</button></div>
      </div>
    </div>
    <!-- /.card-footer-->

    </form>
  </div>
            <!-- /.card -->
</section>
            </div>