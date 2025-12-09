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
    e.classList.add('sel');
  }
  
  function showWindow(url) {
    var width = 950;
    var height = 720;
    var left = (screen.width / 2) - (width / 2);
    var top = (screen.height / 2) - (height / 2);
    var newWindow = window.open(url, 'Yeni Pencere', 'width=' + width + ',height=' + height + ',top=' + top + ',left=' + left);
    
    var interval = setInterval(function() {
      if (newWindow.closed) {
        clearInterval(interval);
        var currentPage = $('#users_tablce').DataTable().page();
        $('#users_tablce').DataTable().ajax.reload(function() {
          $('#users_tablce').DataTable().page(currentPage).draw(false);
        });
      }
    }, 1000);
  }
  
  function showWindow2(url) {
    var width = 950;
    var height = 720;
    var left = (screen.width / 2) - (width / 2);
    var top = (screen.height / 2) - (height / 2);
    var newWindow = window.open(url, 'Yeni Pencere', 'width=' + width + ',height=' + height + ',top=' + top + ',left=' + left);
    
    var interval = setInterval(function() {
      if (newWindow.closed) {
        clearInterval(interval);
        location.reload();
      }
    }, 1000);
  }
  
  function confirmOnay(siparisId, adimNo) {
    return confirm('Sipariş #' + siparisId + ' için Adım ' + adimNo + ' onayını vermek istediğinizden emin misiniz?');
  }
</script>

<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    // Filtre formu submit edildiğinde DataTable'ı yenile
    $('#filterForm').on('submit', function(e) {
      e.preventDefault();
      if($('#users_tablce').length && $('#users_tablce').DataTable().length) {
        $('#users_tablce').DataTable().ajax.reload();
      }
    });

    // Onay bekleyen siparişler tablosu
    if ($('#onaybekleyensiparisler').length) {
      $('#onaybekleyensiparisler').DataTable({
        "processing": true,
        "serverSide": false, // Veriler zaten controller'dan geliyor
        "pageLength": 10,
        "order": [[0, "desc"]], // Kayıt No'ya göre DESC sıralama (en yeni en üstte)
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Turkish.json",
          "processing": '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>'
        },
        "columnDefs": [
          { "width": "80px", "targets": 0 }, // Kayıt No
          { "width": "180px", "targets": 1 }, // Müşteri Adı
          { "width": "200px", "targets": 2 }, // Merkez Detayları
          { "width": "150px", "targets": 3 }, // Sipariş Oluşturan
          { "width": "220px", "targets": 4 }, // Son Durum
          { "width": "140px", "targets": 5, "orderable": false } // İşlemler
        ],
        "autoWidth": false,
        "responsive": true
      });
    }

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
          d.sehir_id = $('select[name="sehir_id"]').val();
          d.kullanici_id = $('select[name="kullanici_id"]').val();
          d.tarih_baslangic = $('input[name="tarih_baslangic"]').val();
          d.tarih_bitis = $('input[name="tarih_bitis"]').val();
          d.teslim_durumu = $('select[name="teslim_durumu"]').val();
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
  });
</script>

