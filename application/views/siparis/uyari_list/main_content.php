<?php $this->load->view('siparis/includes/styles'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper content-wrapper-siparis">
  <section class="content pr-0">
    <div class="row">
      <div class="col-12">
        <div class="card card-siparis">
          <!-- Card Header -->
          <div class="card-header card-header-siparis">
            <div class="d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3 card-header-icon-wrapper">
                  <i class="fas fa-exclamation-triangle card-header-icon"></i>
                </div>
                <div>
                  <h3 class="mb-0 card-header-title">
                    Tamamlanmayanlar
                  </h3>
                  <small class="card-header-subtitle">Tamamlanmamış siparişleri görüntüle</small>
                </div>
              </div>
              <a href="<?=base_url("siparis/merkez")?>" type="button" class="btn btn-light btn-sm">
                <i class="fa fa-plus"></i> Yeni Kayıt Ekle
              </a>
            </div>
          </div>
          
          <!-- Modern Tab Navigation Bar -->
          <?php $this->load->view('siparis/includes/tabs'); ?>
          
          <!-- Card Body -->
          <div class="card-body card-body-siparis">
            <div class="card-body-content">
              <div class="table-responsive">
                <table id="users_tablce" class="table table-siparis table-bordered table-striped nowrap" style="width:100%">
                  <thead>
                    <tr>
                      <th style="width: 42px;">Sipariş Kodu</th> 
                      <th>Müşteri Adı</th> 
                      <th>Adres</th> 
                      <th>İşlem</th> 
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<style>
  .swal2-content iframe {
    width: 90%;
    height: 100%;
    border: none;
  }

  .swal2-html-container{
    height: 690px;
    display: block;
    padding: 0px !important;
    margin: 0px!important;
  }
  
  .swal2-title{
    display: none!important;
    padding: 0!important;
  }
  
  .swal2-close{
    background: red!important;
    color: white!important;
  }
</style>

<script>
  function showWindow($url) {
    var width = 1350;
    var height = 720;
    var left = (screen.width / 2) - (width / 2);
    var top = (screen.height / 2) - (height / 2);
    var newWindow = window.open($url, 'Yeni Pencere', 'width=' + width + ',height=' + height + ',top=' + top + ',left=' + left);

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
</script>

<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#users_tablce').DataTable({
      "processing": true,
      "serverSide": true,
      "pageLength": 500,
      scrollX: true,
      "ajax": {
        "url": "<?php echo site_url('siparis/tamamlanmayanlar_ajax'); ?>",
        "type": "GET"
      },
      "language": {
        "processing": '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>'
      },
      "columns": [
        { "data": 0 },
        { "data": 1 },
        { "data": 2 },
        { "data": 3 } 
      ],
      "createdRow": function (row, data, dataIndex) {
        if (Object.values(data).some(val => String(val).includes("Cihaz"))) {
          $(row).css("background-color", "#9beaae"); // Bootstrap success yeşili
        }
      }
    });
  });
</script>