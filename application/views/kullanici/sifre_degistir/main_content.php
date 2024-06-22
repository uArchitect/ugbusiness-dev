 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Kullanıcı Şifre Değiştirme Formu</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url()?>">Giriş</a></li>
              <li class="breadcrumb-item active">Kullanıcı Şifre Form</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<section class="content col-md-4">
<div class="card card-primary">
    <div class="card-header with-border">
      <h3 class="card-title"> Şifre Bilgileri</h3>
     
     
    </div>
  
   <form class="form-horizontal" method="POST" action="<?php echo site_url('kullanici/changepassword')?>">
    <div class="card-body">

    

      <div class="form-group">
        <label for="formClient-Name"> Eski Şifrenizi Giriniz</label>
        <input type="text"  class="form-control" name="eski_sifre" required="" placeholder="Eski Şifrenizi Giriniz..." autofocus="">
      </div>

      <div class="form-group">
        <label for="formClient-Code"> Yeni Şifre</label>
        <input type="text"  class="form-control" name="yeni_sifre" placeholder="Yeni Şifrenizi Giriniz..." autofocus="">
      </div>
  
      <div class="form-group">
        <label for="formClient-Code"> Yeni Şifre (Tekrar)</label>
        <input type="text" class="form-control" name="yeni_sifre_tekrar" placeholder="Yeni Şifrenizi Tekrar Giriniz..." name="code" autofocus="">
       
      </div>
 
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <div class="row">
        <div class="col text-right"><button type="submit" class="btn btn-flat btn-primary"> Şifremi Güncelle</button></div>
      </div>
    </div>
    <!-- /.card-footer-->

    </form>
  </div>
            <!-- /.card -->
</section>
            </div>