<style>
   .yanipsonenyazifooter {
      animation: blinker2 0.7s linear infinite;
     
  
      } 
      @keyframes blinker2 {  
      50% { opacity: 0; }
      }
  </style>
 <style>
   .yanipsonenyazinew {
      animation: blinker1 0.7s linear infinite;
      color: #1c87c9;
  
      } 
      @keyframes blinker1 {  
      50% { opacity: 0; }
      }
  </style>
 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background: #181818">

    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item" style="display: flex;">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars text-white"></i></a>



        
        <form action="<?=base_url("anasayfa/genel_arama")?>" method="POST">
  <div class="input-group" data-widget="sidebar-search1">

    <input class="form-control form-control-sidebar" style="background:#1d2125;border: 1px solid #4d4d4d;" name="aranan_deger" type="search" placeholder="Hızlı Kayıt Ara..." aria-label="Search">
    <div class="input-group-append">
      <button class="btn btn-sidebar" type="submit" style="background:#1d2125;border: 1px solid #4d4d4d;color: white;">
        <i class="fas fa-search fa-fw"></i>
      </button>
    </div>


  </div>
  </form>


        <?php 
        
        if(get_talep_uyari()){
          ?>
          <a href="<?=base_url("talep/bekleyen_rapor_list")?>" class="btn btn-danger text-white yanipsonenyazinew mr-2">Bekleyen Talep Uyarısı</a>
          <?php
        }
        ?>


<?php 
if(aktif_kullanici()->kullanici_id == 9 || aktif_kullanici()->kullanici_id == 7){


  if(get_arac_bildirim()){
    ?>
    <a href="<?=base_url("arac")?>" class="btn btn-danger text-white yanipsonenyazinew">Kasko Sigorta Uyarısı</a>
    <?php
  }else{

  

        for ($i=1; $i < 15; $i++) { 
          if($i == 9 || $i == 10 || $i == 11){
            continue;
          }
          $kmlastdata2 = get_arac_km_son_kayit($i);
          if($kmlastdata2){
            $gun2 = gunSayisiHesapla(date("d.m.Y"),date("d.m.Y",strtotime($kmlastdata2->arac_km_kayit_tarihi)));
            if($gun2 >= 7){
             ?>
             <a href="<?=base_url("arac")?>" class="btn btn-danger text-white yanipsonenyazis2">Km Giriş Uyarısı</a>
             <?php
             break;
            }  
          }
        
        }
      }
    }
        ?>
      </li>
      
       
    </ul>
   
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

    <span class="text-white mt-1"><i class="fa fa-user-circle"></i> 
    <b><?=aktif_kullanici()->kullanici_ad_soyad?></b> / 
    <?=aktif_kullanici()->kullanici_unvan?>
</span>

      <!-- Navbar Search -->
     
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link"  href="<?=base_url("istek")?>">
          <i class="far fa-comments text-white"></i>
         
        </a>
         
      </li>
      <!-- Notifications Dropdown Menu -->
   
        <a class="nav-link"  href="<?=base_url("duyuru/tum-duyurular")?>">
          <i class="far fa-bell text-white"></i>
     
        </a>
         
    
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt text-white"></i>
        </a>
      </li>
      <li class="nav-item">
      <a class="btn btn-danger btn-sm" href="https://ugbusiness.com.tr/logout"><i class="fas fa-sign-out-alt"></i> Oturumu Sonlandır</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->