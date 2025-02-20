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
 <nav class="main-header navbar navbar-expand navbar-white navbar-light  " style="background: #181818;border: 1px solid black;">















  
   
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto   d-none d-sm-flex">

    <span class="text-white mt-1 mr-5"><i class="fa fa-user-circle"></i> 
    <b><?=aktif_kullanici()->kullanici_ad_soyad?></b> /<?=aktif_kullanici()->kullanici_unvan?>
</span>

      <!-- Navbar Search -->
 
         
     
      <li class="nav-item">
      <a class="btn btn-danger btn-sm" href="https://ugbusiness.com.tr/logout"><i class="fas fa-sign-out-alt"></i> Oturumu Sonlandır</a>
      </li>
    </ul>
  </nav>
  <a class="btn btn-dark btn-sm d-block d-lg-none"   style="
    width: -webkit-fill-available;border-radius:0px!important;
"><i class="fa fa-user-circle"></i> <?=aktif_kullanici()->kullanici_ad_soyad?>/<?=aktif_kullanici()->kullanici_unvan?></a>
  <a class="btn btn-danger btn-sm d-block d-lg-none" href="https://ugbusiness.com.tr/logout" style="
    width: -webkit-fill-available;
"><i class="fas fa-sign-out-alt"></i> Oturumu Sonlandır</a>

  <!-- /.navbar -->