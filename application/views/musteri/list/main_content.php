 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
 
<section class="content text-md" style="    margin-top: -5px;">
<div class="card card-dark" style="border-radius:0px !important;">
              <div class="card-header" style="background:#00264f!important">
              <h3 class="card-title"><strong>UG Business</strong> - Müşteri Bilgileri</h3>
                <a href="<?=base_url("musteri/ekle")?>" onclick="waiting('Yeni Müşteri Ekle');" type="button" class="btn btn-primary btn-sm" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Kayıt Ekle</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="    min-height: 790px !important;">
              <table id="users_table"   class="table table-bordered table-striped nowrap" style="width:100%;">
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
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
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
        padding: 8px 10px  ;
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