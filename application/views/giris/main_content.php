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

  <style>
    .fa-chevron-right{
      display:none!important;
    } .fa-chevron-left{
      display:none!important;
    } .carousel-indicators{
      display:none!important;
    }
    </style>
</head>
<body class="hold-transition login-page"  style="      background: url(<?=base_url("assets/dist/img/ugback.jpg")?>);">
    
<div class="login-box" style="width:100%;max-width: 600px;
    border-radius: 4px;">

 
  <!-- /.login-logo -->
  <div class="card card-outline card-primary" style="border: 7px solid #ebebeb">
    <div class="card-header text-center" style="border-bottom: 0px;padding:0"> 
    <div class="card pb-0 mb-1">
           
           <!-- /.card-header -->
           <div class="card-body p-0">
             <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
               <ol class="carousel-indicators">
                 <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
               
               </ol>
               <div class="carousel-inner" style="width: 100.3%;margin: -1px;">
                 <?php
                   $count=0;
                   if(!empty($bannerlar) && count($bannerlar) > 0)
                   foreach ($bannerlar as $banner) {
                     $count++;
                     ?>
                          <div class="carousel-item <?=($count==1)?"active":""?>">
                           <img class="d-block w-100" src="<?=base_url("assets/dist/img/ug.jpg")?>">
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
    <div class="card-body" style="    border: 2px solid #0a369f;    margin-left: -1px;
    margin-right: -1px;
    margin-top: -5px;text-align: center;padding:0;padding-top:20px;">


<div class="row <?=($yemek->yemek_detay=="")?"m-2":""?>">
  <div class="col    <?=($yemek->yemek_detay=="")?"text-center pb-2":"text-left"?>" style="    margin: auto;
    max-width: 450px; border: 0px solid #d9d7d7;padding: 5px;border-radius: 10px;">


 

  

  <a style="text-align:left !important" class="h2"><b style="text-align:left" >Hoşgeldiniz</b> </a>
      <p class="login-box-msg pl-1  <?=($yemek->yemek_detay==null)?"text-center pb-2":"text-left"?>">  Ug Business Devam etmek için kullanıcı adı ve kullanıcı şifrenizle giriş yapınız. </p>

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
            <button type="submit" style="width: 100px;
    margin: auto;" id="submitbutton" class="mt-3 btn btn-success btn-block">Giriş Yap</button>
       
           
          </div>
          <!-- /.col -->
        </div>
      </form>


  
  </div>






      <div class="card-footer mt-5" style=" background:#00000014;   width: 100%;text-align: center;">



      <div class="row">
        
        <div class="col-12"> 
        <p class="mb-0 text-center" style="opacity:0.5">
        ©2023 UG Yazılım tarafından geliştirilmiştir. Tüm hakları saklıdır.
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
<style>
        .alt-sag-kose {
          position: fixed;
            bottom: 10px; 
            left: 50%; 
            transform: translateX(-50%);
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            text-align: center;
        }
        .alt-sag-kose-danger {
          position: fixed;
            bottom: 10px; 
            left: 50%;
            transform: translateX(-50%); 
            background-color: rgba(255, 0, 0, 0.7);
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            text-align: center;
        }
    </style>
    <?php 
    if(md5(getUserIP()) == "1a8a528fc45d6c1ffe0303d98c0f8ca2"){
      ?>
      <div class="alt-sag-kose">UG YAZILIM TEKNOLOJİ MEDİKAL SAN.VE TİC.LTD.ŞTİ.</div>
      <?php
    }
    ?>

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>

<script type="text/javascript" src="<?=base_url("assets/dist/js")?>/sweetalert2.all.min.js"></script>
<script>
  <?php if($this->session->flashdata('flashDanger')){ ?>
   Swal.fire({
      icon: 'error',
      confirmButtonColor: '#2c9501',
      confirmButtonText: 'Tamam',
      title: 'Sistem Uyarısı',
      text: '<?=$this->session->flashdata('flashDanger')?>'
      })

 <?php } ?>

  </script>
</body>
</html>
