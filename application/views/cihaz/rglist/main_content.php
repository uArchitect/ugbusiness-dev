<?php $this->load->view('musteri/includes/styles'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper content-wrapper-musteri">
  <section class="content pr-0">
    <div class="row">
      <div class="col-12">
        <div class="card card-musteri">
          <!-- Card Header -->
          <div class="card-header card-header-musteri">
            <div class="d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3 card-header-icon-wrapper">
                  <i class="far fa-circle card-header-icon"></i>
                </div>
                <div>
                  <h3 class="mb-0 card-header-title">
                    RG MEDİKAL
                  </h3>
                  <small class="card-header-subtitle">RG Medikal cihaz listesi ve yönetimi</small>
                </div>
              </div>
              <a href="<?=base_url("cihaz/rg_medikal_cihaz_tanimlama_view")?>" onclick="waiting('Yeni Cihaz Tanımla');" class="btn btn-light btn-sm">
                <i class="fa fa-plus-circle"></i> Yeni Cihaz Ekle
              </a>
            </div>
          </div>
          
          <!-- Modern Tab Navigation Bar -->
          <?php $this->load->view('musteri/includes/tabs'); ?>
          
          <!-- Card Body -->
          <div class="card-body card-body-musteri">
            <div class="card-body-content">
              <div class="row d-none">
                <div class="col">
                  <div class="small-box bg-dark" style="background-color: #003061!important;">
                    <div class="inner">
                      <h3>[#]</h3>
                      <p>Garantisi Başlatılmamış Cihazlar</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-clock text-warning"></i>
                    </div>
                    <a href="#" class="small-box-footer">Tümünü Göster <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                
                <div class="col p-0">
                  <div class="small-box bg-dark" style="background-color: #003061!important;">
                    <div class="inner">
                      <h3>[#]</h3>
                      <p>Garantisi Devam Eden Cihazlar</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-checkmark text-success"></i>
                    </div>
                    <a href="#" class="small-box-footer">Tümünü Göster <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                
                <div class="col">
                  <div class="small-box bg-dark" style="background-color: #003061!important;">
                    <div class="inner">
                      <h3>[#]</h3>
                      <p>Garantisi Sona Eren Cihazlar</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-alert text-danger"></i>
                    </div>
                    <a href="<?=base_url("cihaz/garanti-suresi-biten-cihazlar")?>" class="small-box-footer">Tümünü Göster <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                
                <div class="col p-0 pr-2">
                  <div class="small-box bg-dark" style="background-color: #003061!important;">
                    <div class="inner">
                      <h3>[#]</h3>
                      <p>Tüm Cihazlar</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-folder text-primary"></i>
                    </div>
                    <a href="#" class="small-box-footer">Tümünü Göster <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
              </div>
              
              <div class="table-responsive">
                <table id="users_table" class="table table-musteri table-bordered table-striped nowrap" style="font-weight: 600;width:100%;">
                  <thead>
                    <tr>
                      <th style="width: 42px;">ID</th> 
                      <th>Cihaz Adı</th>
                      <th>Müşteri</th>
                      <th>Merkez Bilgisi</th>
                      <th>Adres Detayları</th>
                      <th style="width: 130px;">Garanti Bilgileri</th>
                      <th style="width: 130px;">İşlem</th> 
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

<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    const urlParams = new URLSearchParams(window.location.search);
    const pageValue = urlParams.get('page');
    var filter_d = "";
    if (pageValue) {
      filter_d = "?page="+pageValue;
    }

    $('#users_table').DataTable({
      "processing": true,
      "serverSide": true,
      "pageLength": 13,
      scrollX: true,
      "ajax": {
        "url": "<?php echo site_url('cihaz/cihazlar_ajax/0/0/1'); ?>"+filter_d,
        "type": "GET"
      },
      "language": {
        "processing": '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>'
      },
      "columns": [
        { "data": 0 },
        { "data": 1 },
        { "data": 2 },
        { "data": 3 },
        { "data": 4 },
        { "data": 5 },
        { "data": 6 } 
      ]
    });
    
    var getiade = '<?=(!empty($_GET["durum"]) ? $_GET["durum"] : "")?>';
    var inputElement = document.querySelector('#users_table_filter input[type="search"]');
    inputElement.value = getiade;
    
    $('#users_table').DataTable().ajax.reload(function() {
      $('#users_table').DataTable().search(getiade).draw();  
    });
  });

  function showWindow($url) {
    var width = 750;
    var height = 620;
    var left = (screen.width / 2) - (width / 2);
    var top = (screen.height / 2) - (height / 2);
    var newWindow = window.open($url, 'Yeni Pencere', 'width=' + width + ',height=' + height + ',top=' + top + ',left=' + left);
    
    var interval = setInterval(function() {
      if (newWindow.closed) {
        clearInterval(interval);
        var currentPage = $('#users_table').DataTable().page();
        $('#users_table').DataTable().ajax.reload(function() {
          $('#users_table').DataTable().page(currentPage).draw(false);
        });
      }
    }, 1000);
  }

  function showDetail(url){
    var width = 750;
    var height = 620;
    var left = (screen.width / 2) - (width / 2);
    var top = (screen.height / 2) - (height / 2);
    var newWindow = window.open(url, 'Yeni Pencere', 'width=' + width + ',height=' + height + ',top=' + top + ',left=' + left);
    
    var interval = setInterval(function() {
      if (newWindow.closed) {
        clearInterval(interval);
        var currentPage = $('#users_table').DataTable().page();
        $('#users_table').DataTable().ajax.reload(function() {
          $('#users_table').DataTable().page(currentPage).draw(false);
        });
      }
    }, 1000);
  }
</script>

<style>
  .swal2-content iframe {
    height: 100%;
    border: none;
  }

  .swal2-html-container{
    height: 670px; 
    display: block;
    padding: 0px !important;
    margin: 0px!important;
    overflow:hidden!important;
  }

  .swal2-popup {
    padding: 15px!important;
  }
  
  .swal2-title{
    display: none!important;
    padding: 0!important;
  }
  
  .swal2-close{
    background: red!important;
    color: white!important;
    width: 20px;
    height: 20px;
    border-radius : 0 2px 0 0;
  }

  .table-striped tbody tr:nth-of-type(odd) {
    background-color: rgb(0 0 0 / 13%);
  }
</style>