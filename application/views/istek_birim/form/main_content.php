 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">İstek Birim Form</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url()?>">Giriş</a></li>
              <li class="breadcrumb-item active">İstek Birim Form</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<section class="content col-md-4">
<div class="card card-dark">
    <div class="card-header with-border">
      <h3 class="card-title"> İstek Birim Bilgileri</h3>
     
     
    </div>
  
    <?php if(!empty($istek_birim)){?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('istek_birim/save').'/'.$istek_birim->istek_birim_id;?>">
    <?php }else{?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('istek_birim/save');?>">
    <?php } ?>
    <div class="card-body">

    

      <div class="form-group">
        <label for="formClient-Name"> İstek Birim Adı</label>
        <input type="text" value="<?php echo  !empty($istek_birim) ? $istek_birim->istek_birim_adi : '';?>" class="form-control" name="istek_birim_adi" required="" placeholder="İstek Birim Adını Giriniz..." autofocus="">
        <p style="color: red;"> <?php echo json_decode($this->session->flashdata('form_errors'))->istek_birim_adi ?? ''; ?></p>
      </div>

      <div class="form-group">
        <label for="formClient-Code"> İstek Birim Açıklama</label>
        <input type="text" value="<?php echo !empty($istek_birim) ? $istek_birim->istek_birim_aciklama : '';?>" class="form-control" name="istek_birim_aciklama" placeholder="İstek Birim Açıklamasını Giriniz..." autofocus="">
        <p style="color: red;"> <?php echo json_decode($this->session->flashdata('form_errors'))->istek_birim_aciklama ?? ''; ?></p>
      </div>
  
      <div class="form-group">
      <label for="formClient-Code"> Birim Sorumlusu</label>
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <div class="input-group" style="flex-wrap: nowrap;">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fas fa-user"></i></span>
              </div>
             
              <select name="birim_yetkili_kullanici_id" class="select2 form-control rounded-0" style="width: 100%;">
                  <?php foreach($kullanicilar as $kullanici) : ?> 
                              <option  value="<?=$kullanici->kullanici_id?>" <?php echo  (!empty($istek_birim) && $istek_birim->birim_yetkili_kullanici_id == $kullanici->kullanici_id) ? 'selected="selected"'  : '';?>><?=$kullanici->kullanici_ad_soyad?> / <?=$kullanici->kullanici_unvan?> / <?=$kullanici->departman_adi?></option>
                
                    <?php endforeach; ?>  
              </select>
             
        </div>  
        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
      Bu birime istek yapan kullanıcıya daha önce sorumlu atanmamışsa, burada seçilmiş olan sorumluya onaya düşecektir. <strong>Birim Sorumlu</strong> bilgilerine Menü / Parametreler / İstek Birimleri sekmesini kullanarak ulaşabilirsiniz.
      </p>
      </div>



    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <div class="row">
        <div class="col"><a href="<?=base_url("istek_birim")?>"  class="btn btn-flat btn-danger"> İptal</a></div>
        <div class="col text-right"><button type="submit" class="btn btn-flat btn-primary"> Kaydet</button></div>
      </div>
    </div>
    <!-- /.card-footer-->

    </form>
  </div>
            <!-- /.card -->
</section>
            </div>