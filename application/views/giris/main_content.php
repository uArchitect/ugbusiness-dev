<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>UG Business | Kurumsal ERP Sistemi</title>
  <meta name="robots" content="noindex">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url("assets")?>/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?=base_url("assets")?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url("assets")?>/dist/css/adminlte.min.css">
  
  <link href="https://www.umex.com.tr/assets/images/icon/favicon.ico" rel="icon"> 
</head>
<body class="hold-transition login-page"  style="    background: #eef3">
    
<div class="login-box" style="width:100%;max-width:700px">

 
  <!-- /.login-logo -->
  <div class="card card-outline card-primary" style="border: 3px solid #3c7ccc;">
    <div class="card-header text-center" style="border-bottom: 0px;padding:0"> 
    <div class="card pb-0 mb-1">
           
           <!-- /.card-header -->
           <div class="card-body p-0">
             <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
               <ol class="carousel-indicators">
                 <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
               
               </ol>
               <div class="carousel-inner">
                 <?php
                   $count=0;
                   if(!empty($bannerlar) && count($bannerlar) > 0)
                   foreach ($bannerlar as $banner) {
                     $count++;
                     ?>
                          <div class="carousel-item <?=($count==1)?"active":""?>">
                           <img class="d-block w-100" src="<?=base_url("uploads/$banner->banner_dosya")?>">
                         </div>
                     <?php
                   }
                 ?>
              
                
               </div>
               <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                 <span class="carousel-control-custom-icon" aria-hidden="true">
                   <i class="fas fa-chevron-left"></i>
                 </span>
                 <span class="sr-only">Previous</span>
               </a>
               <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                 <span class="carousel-control-custom-icon" aria-hidden="true">
                   <i class="fas fa-chevron-right"></i>
                 </span>
                 <span class="sr-only">Next</span>
               </a>
             </div>
           </div>
           <!-- /.card-body -->
         </div>
         <!-- /.card -->
    </div>
    <div class="card-body" style="text-align: center;padding:0;padding-top:0px">


<div class="row <?=($yemek->yemek_detay=="")?"m-2":""?>">
  <div class="col <?=($yemek->yemek_detay=="")?"text-center pb-2":"text-left"?>" style=" border: 1px solid #d9d7d7;margin-left: 5px;padding: 5px;border-radius: 10px;">


 
 

  <a href="../../index2.html" style="text-align:left !important" class="h2"><b style="text-align:left" >Hoşgeldinizfs</b> </a>
      <p class="login-box-msg pl-1  <?=($yemek->yemek_detay==null)?"text-center pb-2":"text-left"?>"" >Devam etmek için kullanıcı adı ve şifrenizle giriş yapınız. Giriş bilgileriniz <br>kurumsal mail ve sms ile size iletilmiştir.</p>

      <form style="max-width: 350px;
    margin: auto;" action="<?=base_url("login/giris_yap")?>" method="post">
        <div class="input-group mb-3">
          <input type="text" name="username" id="username" class="form-control" placeholder="Email Adresinizi Giriniz">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-1">
          <input type="password" name="password" id="password" class="form-control" placeholder="Kullanıcı Şifrenizi Giriniz">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
     
        <div class="row">
          <div style="margin: auto;    width: -webkit-fill-available;">
            <button type="submit" id="submitbutton" class="mt-3 btn btn-success btn-block">Giriş Yap</button>
       
           
          </div>
          <!-- /.col -->
        </div>
      </form>


  
  </div>



  <div class="col <?=($yemek->yemek_detay=="")?"d-none":""?>" style="text-align:left !important;border: 1px solid #d9d7d7;margin-right: 5px;margin-left: 5px;;padding: 5px;border-radius: 10px;">

  <div style="padding:10px;padding-top:5px;height:100%;width:100%;border-radius:10px; background-image: url('<?=base_url("assets/dist/img/menuarkaplan.png")?>')">
 <?php
 
 $guncelTarih = getdate();
 $gunSayisi = date('t', mktime(0, 0, 0, $guncelTarih['mon'], 1, $guncelTarih['year']));
 
 ?>
  <a href="" style="color:white;text-align:left !important" class="h4"><b style="text-align:left" >Öğle Yemek Menüsü</b> </a>

  <br><span style="color:white;font-size:15px;"><b>Tarih :</b> <?=date("d.m.Y")?> <b style="margin-left:5px">Yemek Saati :</b> 12:00</span>
  <br>  <br>  <br>
  <a href="" style="color:white;text-align:center !important;    display: block;font-weight:normal !important;" class="h4">
                   <?=preg_replace('/#/', "<br>", $yemek->yemek_detay);?>
</a>


  </div>

</div>


      <div class="card-footer mt-5" style="    width: 100%;text-align: center;">



      <div class="row">
        <div class="col-4">
        <p class="mb-0 text-left">
         
        </p>
        </div>
        <div class="col-4"> 
        <p class="mb-0 text-center" style="opacity:0.5">
        ©2023 UG Teknoloji
       </p>
        </div>
        <div class="col-4"> 
        <p class="mb-0 text-right">
            <a href="https://www.umex.com.tr/iletisim/" class="text-center text-dark"><i class="fa fa-info-circle" style="margin-right:5px; "></i>Sorun Bildir</a>
      </p>
        </div>

        </div>



     
      
</div>
      <!-- /.social-auth-links -->

      
     
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
