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
                  <i class="fas fa-users card-header-icon"></i>
                </div>
                <div>
                  <h3 class="mb-0 card-header-title">
                    Müşteri Bilgileri
                  </h3>
                  <small class="card-header-subtitle">Müşteri listesi ve yönetim modülleri</small>
                </div>
              </div>
              <a href="<?=base_url("musteri/ekle")?>" onclick="waiting('Yeni Müşteri Ekle');" type="button" class="btn btn-light btn-sm">
                <i class="fa fa-plus"></i> Yeni Kayıt Ekle
              </a>
            </div>
          </div>
          
          <!-- Modern Tab Navigation Bar -->
          <?php $this->load->view('musteri/includes/tabs'); ?>
          
          <!-- Card Body -->
          <div class="card-body card-body-musteri">
            <div class="card-body-content">
              <div class="table-responsive">
                <table id="users_table" class="table table-musteri table-bordered table-striped nowrap" style="width:100%;">
                  <thead>
                    <tr>
                      <th style="max-width:70px;width:70px;">Müşteri ID</th>
                      <th>Müşteri Adı</th>
                      <th>Merkez Bilgisi</th> 
                      <th>Adres</th>
                      <th>İletişim Numarası</th>
                      <th style="width:120px">İşlem</th>
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
  .custom-href:hover {
    text-decoration: underline;
  }

  .users_table_processing{
    margin-top:50px;
  }
       
  table.dataTable tbody th, table.dataTable tbody td {
    padding: 8px 10px;
  }
</style>

<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#users_table').DataTable({
      "processing": true,
      "serverSide": true,
      "pageLength": 16,
      scrollX: true,
      "ajax": {
        "url": "<?php echo site_url('musteri/musteriler_ajax'); ?>",
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
        { "data": 5 }
      ]
    });
    
    $('#users_table').on('click', '.edit-btn', function() {
      var id = $(this).data('id');
      window.location.href = "<?php echo site_url('users/edit/'); ?>" + id;
    });
  });
</script>