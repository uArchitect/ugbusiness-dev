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
  <style>
    /* Bakım Modu Bildirimi */
    .maintenance-toast {
      position: fixed;
      top: 70px;
      right: 20px;
      z-index: 9999;
      background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);
      color: white;
      padding: 10px 14px;
      border-radius: 8px;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.3);
      min-width: 240px;
      max-width: 280px;
      animation: slideInRight 0.5s ease-out, maintenanceBlink 2s ease-in-out infinite;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
      border-left: 3px solid #fff;
    }
    
    @keyframes slideInRight {
      from {
        transform: translateX(100%);
        opacity: 0;
      }
      to {
        transform: translateX(0);
        opacity: 1;
      }
    }
    
    @keyframes maintenanceBlink {
      0%, 100% {
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.3);
      }
      50% {
        box-shadow: 0 4px 16px rgba(255, 107, 107, 0.6), 0 0 12px rgba(255, 107, 107, 0.4);
      }
    }
    
    .maintenance-toast-header {
      display: flex;
      align-items: center;
      margin-bottom: 6px;
      font-weight: 600;
      font-size: 12px;
    }
    
    .maintenance-toast-icon {
      margin-right: 6px;
      font-size: 12px;
      animation: iconPulse 1.5s ease-in-out infinite;
    }
    
    @keyframes iconPulse {
      0%, 100% {
        transform: scale(1);
      }
      50% {
        transform: scale(1.1);
      }
    }
    
    .maintenance-toast-message {
      font-size: 10px;
      line-height: 1.3;
      margin-bottom: 8px;
      opacity: 0.95;
      color: white !important;
    }
    
    .maintenance-countdown {
      display: flex;
      align-items: center;
      justify-content: center;
      background: rgba(255, 255, 255, 0.2);
      padding: 6px;
      border-radius: 5px;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.3px;
      margin-top: 4px;
      backdrop-filter: blur(10px);
    }
    
    .maintenance-countdown-item {
      display: inline-block;
      margin: 0 3px;
      text-align: center;
    }
    
    .maintenance-countdown-label {
      font-size: 7px;
      font-weight: 500;
      opacity: 0.8;
      text-transform: uppercase;
      letter-spacing: 0.2px;
      margin-top: 2px;
    }
    
    .maintenance-countdown-separator {
      font-size: 11px;
      opacity: 0.7;
      margin: 0 1px;
    }
    
    /* Mobil için tam ekran overlay */
    @media (max-width: 768px) {
      .maintenance-toast {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        width: 100%;
        height: 100vh;
        min-width: 100%;
        max-width: 100%;
        padding: 40px 20px;
        border-radius: 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        z-index: 99999;
        background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);
        box-shadow: none;
      }
      
      /* Mobilde tüm tıklamaları engelle */
      .maintenance-toast::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: -1;
        background: rgba(0, 0, 0, 0.3);
      }
      
      body.maintenance-active {
        overflow: hidden !important;
        position: fixed !important;
        width: 100% !important;
        height: 100% !important;
        touch-action: none;
      }
      
      body.maintenance-active *:not(.maintenance-toast):not(.maintenance-toast *) {
        pointer-events: none !important;
        user-select: none !important;
      }
      
      body.maintenance-active .maintenance-toast,
      body.maintenance-active .maintenance-toast * {
        pointer-events: auto !important;
        user-select: text !important;
      }
      
      .maintenance-toast-header {
        font-size: 18px;
        margin-bottom: 20px;
        color: white;
        text-align: center;
      }
      
      .maintenance-toast-icon {
        font-size: 24px;
        margin-right: 8px;
      }
      
      .maintenance-toast-message {
        font-size: 16px;
        line-height: 1.6;
        margin-bottom: 20px;
        color: white !important;
        text-align: center;
        font-weight: bold;
      }
      
      .maintenance-countdown {
        padding: 10px;
        font-size: 14px;
        margin-top: 20px;
        border-radius: 6px;
      }
      
      .maintenance-countdown-item {
        margin: 0 4px;
      }
      
      .maintenance-countdown-label {
        font-size: 10px;
        margin-top: 4px;
      }
      
      .maintenance-countdown-separator {
        font-size: 14px;
        margin: 0 2px;
      }
    }
    
    /* Çok küçük ekranlar için */
    @media (max-width: 480px) {
      .maintenance-toast {
        padding: 30px 15px;
      }
      
      .maintenance-toast-header {
        font-size: 16px;
        margin-bottom: 15px;
      }
      
      .maintenance-toast-icon {
        font-size: 20px;
      }
      
      .maintenance-toast-message {
        font-size: 14px;
        line-height: 1.5;
        color: white !important;
      }
      
      .maintenance-countdown {
        font-size: 12px;
        padding: 8px;
      }
      
      .maintenance-countdown-label {
        font-size: 8px;
      }
      
      .maintenance-countdown-separator {
        font-size: 12px;
      }
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
    <ul class="navbar-nav ml-auto d-none d-sm-flex align-items-center">

      <li class="nav-item mr-4 d-flex align-items-center">
        <span class="text-white">
          <i class="fa fa-user-circle"></i>
          <b><?= aktif_kullanici()->kullanici_ad_soyad ?></b> / <?= aktif_kullanici()->kullanici_unvan ?>
        </span>
      </li>

      <!-- Bildirim İkonu (Sadece ID 1 için) -->
      <li class="nav-item mr-3 position-relative">
        <a class="nav-link p-2" href="<?= site_url('sistem_bildirimleri') ?>">
          <i class="far fa-bell text-white" style="font-size: 20px;"></i>
          <?php 
            $bildirim_sayisi = get_okunmamis_bildirim_sayisi();
            if ($bildirim_sayisi > 0): 
          ?>
            <span class="badge badge-danger"
                  style="position: absolute; top: 2px; right: 2px; font-size: 11px; padding: 3px 6px; min-width: 20px; height: 20px; line-height: 14px; border-radius: 10px; border: 2px solid #181818;">
              <?= $bildirim_sayisi > 99 ? '99+' : $bildirim_sayisi ?>
            </span>
          <?php endif; ?>
        </a>
      </li>

      <li class="nav-item">
        <a class="btn btn-danger btn-sm" href="https://ugbusiness.com.tr/logout">
          <i class="fas fa-sign-out-alt"></i> Oturumu Sonlandır
        </a>
      </li>

    </ul>
    
    <!-- Bakım Modu Bildirimi (Kullanıcı ID 1 ve 9 hariç) -->
    <?php if(aktif_kullanici()->kullanici_id != 1 && aktif_kullanici()->kullanici_id != 9): ?>
    <div id="maintenance-toast" class="maintenance-toast" data-user-id="<?= aktif_kullanici()->kullanici_id ?>">
      <div class="maintenance-toast-header">
        <i class="fas fa-tools maintenance-toast-icon"></i>
        <span>Bakım Modu</span>
      </div>
      <div class="maintenance-toast-message" style="font-weight:bold; color:white !important;">
        DİKKAT: Bakım işlemleri BAŞLAMIŞTIR!<br>
        Şu andan itibaren yapacağınız hiçbir işlem veya veri kaydedilmeyecektir.<br>
        Lütfen acil bir işlem gerçekleştirmeyin ve bakım bitene kadar sistemde değişiklik yapmayınız!
      </div>
    </div>
    <?php endif; ?>
  </nav>
  <a class="btn btn-dark btn-sm d-block d-lg-none mnav"   style="
    width: -webkit-fill-available;border-radius:0px!important;
"><i class="fa fa-user-circle"></i> <?=aktif_kullanici()->kullanici_ad_soyad?>/<?=aktif_kullanici()->kullanici_unvan?></a>
  <a class="btn btn-danger btn-sm d-block d-lg-none mnav" href="https://ugbusiness.com.tr/logout" style="
    width: -webkit-fill-available;
"><i class="fas fa-sign-out-alt"></i> Oturumu Sonlandır</a>

  <!-- /.navbar -->
  
  <script>
    // Mobilde bakım modu bildirimi varsa tıklamaları engelle (Kullanıcı ID 1 hariç)
    (function() {
      var maintenanceToast = document.getElementById('maintenance-toast');
      if (maintenanceToast) {
        // Kullanıcı ID kontrolü
        var userId = maintenanceToast.getAttribute('data-user-id');
        if (userId === '1' || userId === '9') {
          // Kullanıcı ID 1 veya 9 ise hiçbir engel uygulanmasın
          return;
        }
        
        function checkMobile() {
          var isMobile = window.innerWidth <= 768;
          if (isMobile) {
            // Body'ye class ekle
            document.body.classList.add('maintenance-active');
            
            // Scroll'u engelle
            document.body.style.overflow = 'hidden';
            document.documentElement.style.overflow = 'hidden';
            
            // Tüm tıklama olaylarını engelle (maintenance-toast hariç)
            document.addEventListener('click', function(e) {
              if (!e.target.closest('.maintenance-toast')) {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
                return false;
              }
            }, true);
            
            document.addEventListener('touchstart', function(e) {
              if (!e.target.closest('.maintenance-toast')) {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
                return false;
              }
            }, true);
            
            document.addEventListener('touchend', function(e) {
              if (!e.target.closest('.maintenance-toast')) {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
                return false;
              }
            }, true);
          }
        }
        
        // Sayfa yüklendiğinde kontrol et
        checkMobile();
        
        // Ekran boyutu değiştiğinde kontrol et
        window.addEventListener('resize', checkMobile);
      }
    })();
  </script>