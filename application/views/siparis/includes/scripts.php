<?php
/**
 * JavaScript kodları partial
 * 
 * @return void
 */
?>

<script>
  function showdetail(e, param) {
    Swal.fire({
      html: '<iframe src="' + param + '" width="100%" height="100%" frameborder="0"></iframe>',
      showCloseButton: true,
      showConfirmButton: false,
      focusConfirm: false,
      width: '80%',
      height: '80%',
    });
    if (e && e.classList) {
      e.classList.add('sel');
    }
  }
  
  function showWindow(url) {
    var width = 950;
    var height = 720;
    var left = (screen.width / 2) - (width / 2);
    var top = (screen.height / 2) - (height / 2);
    var newWindow = window.open(url, 'Yeni Pencere', 'width=' + width + ',height=' + height + ',top=' + top + ',left=' + left);
    
    if (newWindow) {
      var interval = setInterval(function() {
        if (newWindow.closed) {
          clearInterval(interval);
          if (typeof jQuery !== 'undefined' && jQuery('#users_tablce').length && jQuery.fn.DataTable.isDataTable('#users_tablce')) {
            try {
              var currentPage = jQuery('#users_tablce').DataTable().page();
              jQuery('#users_tablce').DataTable().ajax.reload(function() {
                jQuery('#users_tablce').DataTable().page(currentPage).draw(false);
              });
            } catch(err) {
              console.error('DataTable reload hatası:', err);
            }
          }
        }
      }, 1000);
    }
  }
  
  function showWindow2(url) {
    var width = 950;
    var height = 720;
    var left = (screen.width / 2) - (width / 2);
    var top = (screen.height / 2) - (height / 2);
    var newWindow = window.open(url, 'Yeni Pencere', 'width=' + width + ',height=' + height + ',top=' + top + ',left=' + left);
    
    if (newWindow) {
      var interval = setInterval(function() {
        if (newWindow.closed) {
          clearInterval(interval);
          location.reload();
        }
      }, 1000);
    }
  }
  
  function confirmOnay(siparisId, adimNo) {
    return confirm('Sipariş #' + siparisId + ' için Adım ' + adimNo + ' onayını vermek istediğinizden emin misiniz?');
  }
</script>

<!-- DataTables CDN -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
  // custom.js'in onaybekleyensiparisler tablosunu başlatmasını engelle
  if (typeof window !== 'undefined') {
    window.skipOnayBekleyenDataTable = true;
  }
  
  // jQuery yüklendikten sonra çalış
  (function() {
    function initDataTable() {
      // jQuery ve DataTable yüklü mü kontrol et
      if (typeof jQuery === 'undefined' || typeof jQuery.fn === 'undefined' || typeof jQuery.fn.DataTable === 'undefined') {
        setTimeout(initDataTable, 100);
        return;
      }
      
      var $ = jQuery;
      
      // Filtre formu submit edildiğinde DataTable'ı yenile
      var filterForm = document.getElementById('filterForm');
      if (filterForm) {
        $(filterForm).off('submit').on('submit', function(e) {
          e.preventDefault();
          var usersTable = $('#users_tablce');
          if (usersTable.length && $.fn.DataTable.isDataTable('#users_tablce')) {
            try {
              usersTable.DataTable().ajax.reload();
            } catch(err) {
              console.error('DataTable reload hatası:', err);
            }
          }
        });
      }

      // Onay bekleyen siparişler tablosu - Yeni ID kullan
      // Mobilde DataTable başlatma (sadece desktop'ta)
      var isMobile = window.innerWidth <= 767.98;
      var onayTable = document.getElementById('onaybekleyensiparisler_new');
      if (onayTable && typeof $.fn.DataTable !== 'undefined' && !isMobile) {
        try {
          // DataTable zaten başlatılmış mı kontrol et
          if ($.fn.DataTable.isDataTable('#onaybekleyensiparisler_new')) {
            // Eğer başlatılmışsa, destroy et
            $('#onaybekleyensiparisler_new').DataTable().destroy();
          }
          
          // DataTable'ı başlat (sadece desktop'ta)
          $('#onaybekleyensiparisler_new').DataTable({
            "processing": true,
            "serverSide": false,
            "pageLength": 10,
            "order": [[0, "desc"]],
            "language": {
              "url": "https://cdn.datatables.net/plug-ins/1.13.7/i18n/tr.json",
              "processing": '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>'
            },
            "columnDefs": [
              { "width": "80px", "targets": 0 },
              { "width": "180px", "targets": 1 },
              { "width": "200px", "targets": 2 },
              { "width": "150px", "targets": 3 },
              { "width": "220px", "targets": 4 },
              { "width": "140px", "targets": 5, "orderable": false }
            ],
            "autoWidth": false,
            "responsive": false,
            "destroy": true
          });
        } catch (e) {
          console.error('DataTable başlatma hatası:', e);
        }
      }
      
      // Resize event - mobil/desktop geçişinde DataTable'ı yeniden başlat
      var resizeTimeout;
      window.addEventListener('resize', function() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(function() {
          var currentIsMobile = window.innerWidth <= 767.98;
          if (currentIsMobile !== isMobile) {
            isMobile = currentIsMobile;
            // DataTable'ı yeniden başlat
            if (!isMobile && onayTable && typeof $.fn.DataTable !== 'undefined') {
              if ($.fn.DataTable.isDataTable('#onaybekleyensiparisler_new')) {
                $('#onaybekleyensiparisler_new').DataTable().destroy();
              }
              $('#onaybekleyensiparisler_new').DataTable({
                "processing": true,
                "serverSide": false,
                "pageLength": 10,
                "order": [[0, "desc"]],
                "language": {
                  "url": "https://cdn.datatables.net/plug-ins/1.13.7/i18n/tr.json",
                  "processing": '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>'
                },
                "columnDefs": [
                  { "width": "80px", "targets": 0 },
                  { "width": "180px", "targets": 1 },
                  { "width": "200px", "targets": 2 },
                  { "width": "150px", "targets": 3 },
                  { "width": "220px", "targets": 4 },
                  { "width": "140px", "targets": 5, "orderable": false }
                ],
                "autoWidth": false,
                "responsive": false,
                "destroy": true
              });
            } else if (isMobile && $.fn.DataTable.isDataTable('#onaybekleyensiparisler_new')) {
              $('#onaybekleyensiparisler_new').DataTable().destroy();
            }
          }
        }, 300);
      });
      
      // users_tablce tablosu için DataTable başlatma
      var usersTable = document.getElementById('users_tablce');
      if (usersTable && typeof $.fn.DataTable !== 'undefined') {
        try {
          // DataTable zaten başlatılmış mı kontrol et
          if ($.fn.DataTable.isDataTable('#users_tablce')) {
            // Zaten başlatılmış, yeniden başlatma
            return;
          }
          
          // DataTable'ı başlat
          $('#users_tablce').DataTable({
            "processing": true,
            "serverSide": true,
            "pageLength": 11,
            scrollX: true,
            "order": [[0, "desc"]],
            "ajax": {
              "url": "<?php echo site_url('siparis/siparisler_ajax'); ?>",
              "type": "GET",
              "data": function(d) {
                var sehirSelect = document.querySelector('select[name="sehir_id"]');
                var kullaniciSelect = document.querySelector('select[name="kullanici_id"]');
                var tarihBaslangic = document.querySelector('input[name="tarih_baslangic"]');
                var tarihBitis = document.querySelector('input[name="tarih_bitis"]');
                var teslimDurumu = document.querySelector('select[name="teslim_durumu"]');
                
                d.sehir_id = sehirSelect ? sehirSelect.value : '';
                d.kullanici_id = kullaniciSelect ? kullaniciSelect.value : '';
                d.tarih_baslangic = tarihBaslangic ? tarihBaslangic.value : '';
                d.tarih_bitis = tarihBitis ? tarihBitis.value : '';
                d.teslim_durumu = teslimDurumu ? teslimDurumu.value : '';
              }
            },
            "language": {
              "processing": '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>'
            },
            "columns": [
              { "data": 0 },
              { "data": 1 },
              { "data": 2 },
              { "data": 3 },
              { "data": 4 }
            ]
          });
        } catch (e) {
          console.error('users_tablce DataTable başlatma hatası:', e);
        }
      }
    }
    
    // DOM hazır olduğunda çalış
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initDataTable);
    } else {
      // DOM zaten yüklenmiş
      setTimeout(initDataTable, 500);
    }
  })();
</script>
