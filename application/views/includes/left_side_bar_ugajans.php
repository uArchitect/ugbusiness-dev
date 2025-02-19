
<?php $giris_yapan_k = aktif_kullanici();?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" id="main-sidebar">
    <!-- Brand Logo -->
    <a href="<?=($giris_yapan_k->baslangic_ekrani) ? base_url($giris_yapan_k->baslangic_ekrani) : base_url("anasayfa")?>" class="brand-link" style="text-align: center;border: 9px double #003a79;border-style: revert-layer;background:#0060c7;padding:4px">
      <span style="font-size:26px;color:white;">
        <strong>UG</strong> 
      BUSINESS 
 
      </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-2 d-flex">
        <div class="image" style="margin-top: 10px;">
          <img src="<?=$giris_yapan_k->kullanici_resim ? base_url("uploads/").$giris_yapan_k->kullanici_resim : base_url("uploads/default.png")?>" class="img-circle elevation-2" alt="User Image" style="BACKGROUND: #001cab;border: 2px solid white !important;">
        </div>
        <div class="info">
          <a href="#" class="d-block" style="text-transform: uppercase;"><?=$giris_yapan_k->kullanici_ad_soyad?></a>
          <a href="#" class="d-block text-sm"><?=$giris_yapan_k->kullanici_unvan?></a>
        </div>
      </div>


    




<div class="row" style="
    padding-top: 5px;
">
    <div class="col-5" style="
    padding-right: 0;
    padding-left: 0;
">
<a class="btn btn-warning btn-sm" style="     color: white !important;
    background: #2b2b2b57;
    width: 100%;
    font-size: 11px !important;
    font-weight: 700;
    border: 1px solid #5b5b5b;
    padding-left: 4px !important;" href="https://ugbusiness.com.tr/istek/ekle">
                <i class="fas fa-user-cog"></i>
                YENİ DESTEK</a>
        
</div><div class="col" style="padding-left: 3px;
    padding-right: 0;
">
        <a class="btn btn-success btn-sm mb-1" style="background:#2b2b2b57;color:white!important;width: 100%;font-size: 11px!important;padding: 0;padding-top: 4px;padding-bottom: 4px;font-weight: 700;border:1px solid #d1d1d161 !important" href="https://ugbusiness.com.tr/istek">
            
                <i class="fa fa-list"></i> DESTEK TALEPLERİ

                <?php
                $s = get_istek_sayi();
                if($s>0)
                {
?>
 <span class="badge bg-danger"><?=$s?></span>
<?php
                }
                ?>
</a>
        </div></div>





     


<a class="btn btn-success btn-sm mb-1" style="background: #0049a7ad;color:white!important;width: 100%;border: 1px solid #2474ff;" href="<?=base_url("dokuman")?>">
            
                <i class="fa fa-folder"></i> UG - UMEX ARŞİV</a>
              
                
      <!-- SidebarSearch Form -->
     

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-child-indent nav-flat" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
  

               <li class="nav-header">HIZLI ERİŞİM</li>
            
            


               <li class="nav-item">
                <a href="<?=base_url("anasayfa")?>" class="nav-link">
                <i class="nav-icon 	fas fa-home text-primary" style="font-size:13px"></i>
                <p style="font-size:15px">
                    ANASAYFA
                </p>
                </a>
            </li>
         

 <?php 
 
 if($giris_yapan_k->kullanici_id == 1 || $giris_yapan_k->kullanici_id == 4 || $giris_yapan_k->kullanici_id == 6)
 {
   ?>
   <li class="nav-item">
     <a href="<?=base_url("abonelik")?>" class="nav-link">
     <i class="far fa-folder-open nav-icon" style="font-size:13px"></i>
     <p style="font-size:15px">
      ABONELİKLER
     </p>
     </a>
 </li>
   <?php
 }
 
 ?>


<li class="nav-item">
     <a href="<?=base_url("anasayfa/rehber")?>" class="nav-link">
     <i class="fa fa-contact nav-icon" style="font-size:13px"></i>
     <p style="font-size:15px">
      KURUMSAL İLETİŞİM
     </p>
     </a>
 </li>
          

          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


  <script>
  document.addEventListener("DOMContentLoaded", function() {
    var sidebar = document.getElementById("main-sidebar");
    var contentWrappers = document.querySelectorAll(".content-wrapper");
 var headerWrappers = document.querySelectorAll(".main-header");

    if (window.opener && window.innerWidth < 1366) {
      sidebar.style.display = "none";
      contentWrappers.forEach(function(contentWrapper) {
        contentWrapper.style.marginLeft = "0";
      });
      headerWrappers.forEach(function(headerWrapper) {
      
        headerWrapper.style.display = "none";
      });
    }
  });
</script>