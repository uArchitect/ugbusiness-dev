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
    <ul class="navbar-nav ml-auto d-none d-sm-flex align-items-center">

      <li class="nav-item mr-4 d-flex align-items-center">
        <span class="text-white">
          <i class="fa fa-user-circle"></i>
          <b><?= aktif_kullanici()->kullanici_ad_soyad ?></b> / <?= aktif_kullanici()->kullanici_unvan ?>
        </span>
      </li>

      <!-- Bildirim İkonu Dropdown -->
      <li class="nav-item mr-3 position-relative" id="notificationDropdownContainer">
        <a class="nav-link p-2 notification-icon" href="javascript:void(0);" id="notificationDropdown" style="cursor: pointer;">
          <i class="far fa-bell text-white" style="font-size: 20px;"></i>
          <?php 
            $bildirim_sayisi = get_okunmamis_bildirim_sayisi();
            if ($bildirim_sayisi > 0): 
          ?>
            <span class="badge badge-danger notification-badge"
                  style="position: absolute; top: 2px; right: 2px; font-size: 11px; padding: 3px 6px; min-width: 20px; height: 20px; line-height: 14px; border-radius: 10px; border: 2px solid #181818; animation: pulse 2s infinite;">
              <?= $bildirim_sayisi > 99 ? '99+' : $bildirim_sayisi ?>
            </span>
          <?php endif; ?>
        </a>
        <div class="dropdown-menu dropdown-menu-right notification-dropdown" id="notificationDropdownMenu" style="display: none; position: absolute; right: 0; top: 100%; z-index: 1000; width: 350px; max-height: 500px; overflow-y: auto; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); padding: 0; margin-top: 10px; background: white;">
          <div class="notification-header" style="background: linear-gradient(135deg, #001657 0%, #001657 100%); padding: 15px; border-radius: 8px 8px 0 0;">
            <div class="d-flex justify-content-between align-items-center">
              <h6 class="mb-0 text-white" style="font-weight: 600;">
                <i class="fas fa-bell mr-2"></i>Bildirimler
              </h6>
              <button type="button" class="btn btn-sm btn-light tumunu-okudum-header" onclick="tumunuOkudumHeader()" style="font-size: 11px; padding: 4px 10px;">
                <i class="fas fa-check-double mr-1"></i>Tümünü Okudum
              </button>
            </div>
          </div>
          <div class="notification-list" id="notificationList" style="max-height: 400px; overflow-y: auto;">
            <div class="text-center p-4">
              <i class="fas fa-spinner fa-spin text-muted"></i>
              <p class="text-muted mb-0 mt-2">Yükleniyor...</p>
            </div>
          </div>
          <div class="notification-footer text-center p-2" style="border-top: 1px solid #dee2e6; background-color: #f8f9fa;">
            <a href="<?= site_url('sistem_bildirimleri') ?>" class="text-primary" style="font-size: 13px; font-weight: 600;">
              <i class="fas fa-eye mr-1"></i>Tümünü Görüntüle
            </a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="btn btn-danger btn-sm" href="https://ugbusiness.com.tr/logout">
          <i class="fas fa-sign-out-alt"></i> Oturumu Sonlandır
        </a>
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

<style>
  @keyframes pulse {
    0% {
      transform: scale(1);
      box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.7);
    }
    50% {
      transform: scale(1.05);
      box-shadow: 0 0 0 5px rgba(220, 53, 69, 0);
    }
    100% {
      transform: scale(1);
      box-shadow: 0 0 0 0 rgba(220, 53, 69, 0);
    }
  }
  
  .notification-badge {
    animation: pulse 2s infinite;
  }
  
  .notification-dropdown {
    margin-top: 10px !important;
  }
  
  .notification-item {
    padding: 12px 15px;
    border-bottom: 1px solid #f0f0f0;
    cursor: pointer;
    transition: background-color 0.2s;
  }
  
  .notification-item:hover {
    background-color: #f8f9fa;
  }
  
  .notification-item.unread {
    background-color: #e3f2fd;
    border-left: 3px solid #2196F3;
  }
  
  .notification-item .notification-time {
    font-size: 11px;
    color: #6c757d;
  }
  
  .notification-item .notification-title {
    font-weight: 600;
    font-size: 14px;
    color: #495057;
    margin-bottom: 4px;
  }
  
  .notification-item .notification-message {
    font-size: 13px;
    color: #6c757d;
    line-height: 1.4;
  }
</style>

<script>
$(document).ready(function() {
  // Dropdown açıldığında bildirimleri yükle
  $('#notificationDropdown').on('click', function(e) {
    e.preventDefault();
    e.stopPropagation();
    var $menu = $('#notificationDropdownMenu');
    if($menu.is(':visible')) {
      $menu.hide();
    } else {
      $menu.show();
      loadNotifications();
    }
  });
  
  // Dropdown dışına tıklandığında kapat
  $(document).on('click', function(e) {
    if (!$(e.target).closest('#notificationDropdownContainer').length) {
      $('#notificationDropdownMenu').hide();
    }
  });
  
  // Bildirimleri yükle
  function loadNotifications() {
    $.ajax({
      url: '<?= site_url("sistem_bildirimleri/son_bildirimler") ?>',
      type: 'GET',
      dataType: 'json',
      success: function(response) {
        if(response && response.success && response.bildirimler) {
          renderNotifications(response.bildirimler);
        } else {
          $('#notificationList').html(
            '<div class="text-center p-4">' +
            '<i class="fas fa-bell-slash text-muted" style="font-size: 32px;"></i>' +
            '<p class="text-muted mb-0 mt-2">Bildirim bulunmamaktadır</p>' +
            '</div>'
          );
        }
      },
      error: function() {
        $('#notificationList').html(
          '<div class="text-center p-4">' +
          '<i class="fas fa-exclamation-triangle text-danger"></i>' +
          '<p class="text-danger mb-0 mt-2">Bildirimler yüklenirken hata oluştu</p>' +
          '</div>'
        );
      }
    });
  }
  
  // Bildirimleri render et
  function renderNotifications(bildirimler) {
    if(bildirimler.length === 0) {
      $('#notificationList').html(
        '<div class="text-center p-4">' +
        '<i class="fas fa-bell-slash text-muted" style="font-size: 32px;"></i>' +
        '<p class="text-muted mb-0 mt-2">Bildirim bulunmamaktadır</p>' +
        '</div>'
      );
      return;
    }
    
    var html = '';
    bildirimler.forEach(function(bildirim) {
      var mesaj = bildirim.mesaj || '';
      if(mesaj.length > 80) {
        mesaj = mesaj.substring(0, 80) + '...';
      }
      
      var tarih = new Date(bildirim.created_at);
      var tarihStr = formatDate(tarih);
      
      var unreadClass = (bildirim.kullanici_okundu == 0) ? 'unread' : '';
      
      html += '<div class="notification-item ' + unreadClass + '" onclick="window.location.href=\'<?= site_url("sistem_bildirimleri/detay/") ?>' + bildirim.id + '\'">';
      html += '<div class="d-flex justify-content-between align-items-start">';
      html += '<div class="flex-grow-1">';
      html += '<div class="notification-title">' + escapeHtml(bildirim.baslik || '') + '</div>';
      html += '<div class="notification-message">' + escapeHtml(mesaj) + '</div>';
      html += '<div class="notification-time mt-1">';
      html += '<i class="far fa-clock mr-1"></i>' + tarihStr;
      if(bildirim.gonderen_ad_soyad) {
        html += ' <span class="mx-1">•</span> ' + escapeHtml(bildirim.gonderen_ad_soyad);
      }
      html += '</div>';
      html += '</div>';
      if(bildirim.kullanici_okundu == 0) {
        html += '<button type="button" class="btn btn-sm btn-link p-0 ml-2" onclick="event.stopPropagation(); okunduIsaretleHeader(' + bildirim.id + ', this);" title="Okundu İşaretle">';
        html += '<i class="far fa-circle text-primary"></i>';
        html += '</button>';
      }
      html += '</div>';
      html += '</div>';
    });
    
    $('#notificationList').html(html);
  }
  
  // Tarih formatla
  function formatDate(date) {
    var now = new Date();
    var diff = now - date;
    var seconds = Math.floor(diff / 1000);
    var minutes = Math.floor(seconds / 60);
    var hours = Math.floor(minutes / 60);
    var days = Math.floor(hours / 24);
    
    if(seconds < 60) return 'Az önce';
    if(minutes < 60) return minutes + ' dakika önce';
    if(hours < 24) return hours + ' saat önce';
    if(days < 7) return days + ' gün önce';
    
    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();
    var hour = date.getHours();
    var minute = date.getMinutes();
    
    return (day < 10 ? '0' + day : day) + '.' + 
           (month < 10 ? '0' + month : month) + '.' + 
           year + ' ' + 
           (hour < 10 ? '0' + hour : hour) + ':' + 
           (minute < 10 ? '0' + minute : minute);
  }
  
  // HTML escape
  function escapeHtml(text) {
    var map = {
      '&': '&amp;',
      '<': '&lt;',
      '>': '&gt;',
      '"': '&quot;',
      "'": '&#039;'
    };
    return text ? text.replace(/[&<>"']/g, function(m) { return map[m]; }) : '';
  }
  
  // Header'dan okundu işaretle
  window.okunduIsaretleHeader = function(bildirimId, btnElement) {
    var $btn = $(btnElement);
    $btn.prop('disabled', true);
    
    $.ajax({
      url: '<?= site_url("sistem_bildirimleri/okundu_isaretle/") ?>' + bildirimId,
      type: 'GET',
      dataType: 'json',
      success: function(response) {
        if(response && response.success) {
          $btn.closest('.notification-item').removeClass('unread');
          $btn.remove();
          // Badge'i güncelle
          updateNotificationBadge();
        } else {
          location.reload();
        }
      },
      error: function() {
        location.reload();
      }
    });
  };
  
  // Header'dan tümünü okudum
  window.tumunuOkudumHeader = function() {
    if (!confirm('Tüm bildirimleri okundu olarak işaretlemek istediğinize emin misiniz?')) {
      return;
    }
    
    var $btn = $('.tumunu-okudum-header');
    var originalHtml = $btn.html();
    $btn.prop('disabled', true);
    $btn.html('<i class="fas fa-spinner fa-spin mr-1"></i>İşleniyor...');
    
    $.ajax({
      url: '<?= site_url("sistem_bildirimleri/tumunu_okundu_isaretle") ?>',
      type: 'POST',
      dataType: 'json',
      success: function(response) {
        if(response && response.success) {
          loadNotifications();
          updateNotificationBadge();
          $btn.prop('disabled', false);
          $btn.html(originalHtml);
        } else {
          location.reload();
        }
      },
      error: function() {
        location.reload();
      }
    });
  };
  
  // Badge'i güncelle
  function updateNotificationBadge() {
    $.ajax({
      url: '<?= site_url("sistem_bildirimleri/son_bildirimler") ?>',
      type: 'GET',
      dataType: 'json',
      success: function(response) {
        if(response && response.success) {
          var count = response.bildirimler ? response.bildirimler.length : 0;
          var $badge = $('.notification-badge');
          
          if(count > 0) {
            $badge.text(count > 99 ? '99+' : count).show();
          } else {
            $badge.hide();
          }
        }
      }
    });
  }
  
  // Her 30 saniyede bir badge'i güncelle
  setInterval(function() {
    if($('#notificationDropdownMenu').is(':visible')) {
      loadNotifications();
    }
    updateNotificationBadge();
  }, 30000);
});
</script>