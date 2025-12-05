<?php $this->load->view('musteri/includes/styles'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper content-wrapper-musteri">
  <?php if($siparis_uyari == 1): ?>
  <div class="col">
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h5><i class="icon fas fa-info"></i> Yeni Sipariş Oluştur / Merkez Seçimi</h5>
      Tüm merkez listesi listelenmiştir. Sipariş oluşturmak için öncelikle listeden merkez seçimi yapmalısınız.
    </div>
  </div>
  <?php endif; ?>
  
  <section class="content pr-0">
    <div class="row">
      <div class="col-12">
        <div class="card card-musteri">
          <!-- Card Header -->
          <div class="card-header card-header-musteri">
            <div class="d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3 card-header-icon-wrapper">
                  <i class="far fa-building card-header-icon"></i>
                </div>
                <div>
                  <h3 class="mb-0 card-header-title">
                    Merkez Bilgileri
                  </h3>
                  <small class="card-header-subtitle">Merkez listesi ve yönetim modülleri</small>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Modern Tab Navigation Bar -->
          <?php $this->load->view('musteri/includes/tabs'); ?>
          
          <!-- Card Body -->
          <div class="card-body card-body-musteri">
            <div class="card-body-content">
              <div class="table-responsive">
                <table id="users_table" class="table table-musteri table-bordered text-xs table-striped nowrap" style="width:100%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                  <thead>
                    <tr>
                      <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px; border-bottom:0px solid; width:50px">İşlem</th> 
                      <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px; border-bottom:0px solid">Merkez Adı</th>
                      <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px; border-bottom:0px solid">İletişim Numarası</th>
                      <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px; border-bottom:0px solid">Adres</th>
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
    $('#users_table').DataTable({
      "processing": true,
      "serverSide": true,
      "pageLength": 19,
      scrollX: true,
      "ajax": {
        "url": "<?php echo site_url('merkez/merkezler_ajax'); ?>",
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
      ]
    });
  });
</script>