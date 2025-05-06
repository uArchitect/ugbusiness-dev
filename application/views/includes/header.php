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

















 
<?php 
if(aktif_kullanici()->kullanici_id == 4){
  ?>
  <a href="https://ugbusiness.com.tr/talep/talep_hizli_yonlendirme_save_view" class="btn btn-warning">Hızlı Talep Oluştur</a>
  <?php
}
?>
    <!-- Left navbar links -->
    <ul class="navbar-nav  col-md-6">
      <li class="nav-item" style="display: flex;">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars text-white"></i></a>



        
        


        <?php 
        
        if(get_talep_uyari()){
          ?>
          <a href="<?=base_url("talep/bekleyen_rapor_list")?>" class="btn btn-danger text-white yanipsonenyazinew mr-2">Bekleyen Talep Uyarısı</a>
          <?php
        }
        ?>
 

<?php 
if(aktif_kullanici()->kullanici_id == 9 || aktif_kullanici()->kullanici_id == 7 || aktif_kullanici()->kullanici_id == 8 || aktif_kullanici()->kullanici_id == 37){
 
  if(kritik_stok_varmi()){
    ?>
    <a href="<?=base_url("api/kritik_stoklar")?>" class="btn btn-danger text-white yanipsonenyazinew mr-2">Kritik Stok Uyarısı</a>
    <?php
  } 
  if(get_arac_bildirim()){
    ?>
    <a href="<?=base_url("arac")?>" class="btn btn-danger text-white yanipsonenyazinew">Kasko Sigorta Uyarısı</a>
    <?php
  }else{

  

        for ($i=1; $i < 15; $i++) { 
          if($i == 9 || $i == 10 || $i == 11 || $i == 15){
            continue;
          }
          $kmlastdata2 = get_arac_km_son_kayit($i);
          if($kmlastdata2){
            $gun2 = gunSayisiHesapla(date("d.m.Y"),date("d.m.Y",strtotime($kmlastdata2->arac_km_kayit_tarihi)));
            if($gun2 >= 7){
             ?>
             <a href="<?=base_url("arac")?>" class="btn btn-danger text-white yanipsonenyazis2"><?= $kmlastdata2->arac_km_kayit_tarihi?> Km Giriş Uyarısı</a>
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
  <a class="btn btn-dark btn-sm d-block d-lg-none mnav"   style="
    width: -webkit-fill-available;border-radius:0px!important;
"><i class="fa fa-user-circle"></i> <?=aktif_kullanici()->kullanici_ad_soyad?>/<?=aktif_kullanici()->kullanici_unvan?></a>
  <a class="btn btn-danger btn-sm d-block d-lg-none mnav" href="https://ugbusiness.com.tr/logout" style="
    width: -webkit-fill-available;
"><i class="fas fa-sign-out-alt"></i> Oturumu Sonlandır</a>

  <!-- /.navbar -->