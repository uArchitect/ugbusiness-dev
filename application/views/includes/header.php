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


  ?>



<?php 
$bitmeye_yaklasan_sigortalar = bitmeye_yaklasan_sigortalar();
if($bitmeye_yaklasan_sigortalar > 0){
  ?>
    <a href="<?=base_url("arac")?>" class="btn btn-danger text-white yanipsonenyazis2 mr-2">Sigorta Uyarısı (<?=$bitmeye_yaklasan_sigortalar?>)</a>
  <?php
}


$bitmeye_yaklasan_kaskolar = bitmeye_yaklasan_kaskolar();
if($bitmeye_yaklasan_kaskolar > 0){
  ?>
    <a href="<?=base_url("arac")?>" class="btn btn-danger text-white yanipsonenyazis2 mr-2">Kasko Uyarısı (<?=$bitmeye_yaklasan_kaskolar?>)</a>
  <?php
}

$bitmeye_yaklasan_muayeneler = bitmeye_yaklasan_muayeneler();
if($bitmeye_yaklasan_muayeneler > 0){
  ?>
    <a href="<?=base_url("arac")?>" class="btn btn-danger text-white yanipsonenyazis2 mr-2">Muayene Uyarısı (<?=$bitmeye_yaklasan_muayeneler?>)</a>
  <?php
}

$km_kaydi_6_gun_olmayanlar = km_kaydi_6_gun_olmayanlar();
if($km_kaydi_6_gun_olmayanlar > 0){
  ?>
    <a href="<?=base_url("arac")?>" class="btn btn-danger text-white yanipsonenyazis2 mr-2">KM Giriş Uyarısı (<?=$km_kaydi_6_gun_olmayanlar?>)</a>
  <?php
}


?>



  <?php
/*
  if(get_arac_bildirim()){
    ?>
    <a href="<?=base_url("arac")?>" class="btn btn-danger text-white yanipsonenyazinew">Kasko Sigorta Uyarısı</a>
    <?php
  }
  else{

  

    $aracidler = [2,227,19,20,4,5,6,7,16,17,18,12,13,14,228];
foreach ($aracidler as $id) {
  $kmlastdata2 = get_arac_km_son_kayit($id);
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
      */
    }
        ?>













      </li>
      
       
    </ul>
   
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto   d-none d-sm-flex">

    <span class="text-white mt-1 mr-5"><i class="fa fa-user-circle"></i> 
    <b><?=aktif_kullanici()->kullanici_ad_soyad?></b> /<?=aktif_kullanici()->kullanici_unvan?>
</span>

    <?php if(aktif_kullanici()->kullanici_id == 1): ?>
      <!-- Bildirim İkonu (Sadece ID 1 için) -->
      <li class="nav-item" style="margin-right: 15px;">
        <a class="nav-link" href="<?=site_url('sistem_bildirimleri')?>" style="position: relative; padding: 8px 12px;">
          <i class="far fa-bell text-white" style="font-size: 20px;"></i>
          <?php 
          $bildirim_sayisi = get_okunmamis_bildirim_sayisi();
          if($bildirim_sayisi > 0): 
          ?>
            <span class="badge badge-danger" style="position: absolute; top: 2px; right: 2px; font-size: 11px; padding: 3px 6px; min-width: 20px; height: 20px; line-height: 14px; border-radius: 10px; border: 2px solid #181818;">
              <?=$bildirim_sayisi > 99 ? '99+' : $bildirim_sayisi?>
            </span>
          <?php endif; ?>
        </a>
      </li>
    <?php endif; ?>

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