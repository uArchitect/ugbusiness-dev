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
    
    /* Mobil için responsive ayarlar */
    @media (max-width: 768px) {
      .maintenance-toast {
        right: 8px;
        left: 8px;
        top: 55px;
        min-width: auto;
        max-width: none;
        padding: 8px 10px;
        border-radius: 6px;
      }
      
      .maintenance-toast-header {
        font-size: 10px;
        margin-bottom: 4px;
      }
      
      .maintenance-toast-icon {
        font-size: 10px;
        margin-right: 5px;
      }
      
      .maintenance-toast-message {
        font-size: 9px;
        line-height: 1.2;
        margin-bottom: 6px;
      }
      
      .maintenance-countdown {
        padding: 5px;
        font-size: 9px;
        margin-top: 3px;
        border-radius: 4px;
      }
      
      .maintenance-countdown-item {
        margin: 0 2px;
      }
      
      .maintenance-countdown-label {
        font-size: 6px;
        margin-top: 1px;
      }
      
      .maintenance-countdown-separator {
        font-size: 9px;
        margin: 0 1px;
      }
    }
    
    /* Çok küçük ekranlar için */
    @media (max-width: 480px) {
      .maintenance-toast {
        top: 50px;
        padding: 6px 8px;
      }
      
      .maintenance-toast-header {
        font-size: 9px;
      }
      
      .maintenance-toast-icon {
        font-size: 9px;
      }
      
      .maintenance-toast-message {
        font-size: 8px;
      }
      
      .maintenance-countdown {
        font-size: 8px;
        padding: 4px;
      }
      
      .maintenance-countdown-label {
        font-size: 5px;
      }
      
      .maintenance-countdown-separator {
        font-size: 8px;
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
    
    <!-- Bakım Modu Bildirimi -->
    <div id="maintenance-toast" class="maintenance-toast">
      <div class="maintenance-toast-header">
        <i class="fas fa-tools maintenance-toast-icon"></i>
        <span>Bakım Modu</span>
      </div>
      <div class="maintenance-toast-message">
        Bakım modu başlayacaktır. Lütfen aşağıdaki süre içerisinde bugünlük işlemlerinizi tamamlayın.
      </div>
      <div class="maintenance-countdown" id="maintenance-countdown">
        <div class="maintenance-countdown-item">
          <div id="countdown-hours">00</div>
          <div class="maintenance-countdown-label">Saat</div>
        </div>
        <span class="maintenance-countdown-separator">:</span>
        <div class="maintenance-countdown-item">
          <div id="countdown-minutes">00</div>
          <div class="maintenance-countdown-label">Dakika</div>
        </div>
        <span class="maintenance-countdown-separator">:</span>
        <div class="maintenance-countdown-item">
          <div id="countdown-seconds">00</div>
          <div class="maintenance-countdown-label">Saniye</div>
        </div>
      </div>
    </div>
    
    <script>
      (function() {
        // Bakım modu başlangıç zamanı: 19.12.2025 saat 20:00
        const maintenanceStartTime = new Date('2025-12-19T20:00:00');
        
        const countdownElement = document.getElementById('maintenance-countdown');
        const hoursElement = document.getElementById('countdown-hours');
        const minutesElement = document.getElementById('countdown-minutes');
        const secondsElement = document.getElementById('countdown-seconds');
        
        function updateCountdown() {
          const now = new Date();
          const timeLeft = maintenanceStartTime - now;
          
          if (timeLeft <= 0) {
            hoursElement.textContent = '00';
            minutesElement.textContent = '00';
            secondsElement.textContent = '00';
            return;
          }
          
          const hours = Math.floor(timeLeft / (1000 * 60 * 60));
          const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
          const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
          
          hoursElement.textContent = String(hours).padStart(2, '0');
          minutesElement.textContent = String(minutes).padStart(2, '0');
          secondsElement.textContent = String(seconds).padStart(2, '0');
        }
        
        // İlk güncelleme
        updateCountdown();
        
        // Her saniye güncelle
        setInterval(updateCountdown, 1000);
      })();
    </script>
  </nav>
  <a class="btn btn-dark btn-sm d-block d-lg-none mnav"   style="
    width: -webkit-fill-available;border-radius:0px!important;
"><i class="fa fa-user-circle"></i> <?=aktif_kullanici()->kullanici_ad_soyad?>/<?=aktif_kullanici()->kullanici_unvan?></a>
  <a class="btn btn-danger btn-sm d-block d-lg-none mnav" href="https://ugbusiness.com.tr/logout" style="
    width: -webkit-fill-available;
"><i class="fas fa-sign-out-alt"></i> Oturumu Sonlandır</a>

  <!-- /.navbar -->