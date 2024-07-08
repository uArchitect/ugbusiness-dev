 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
 <?php if($siparis_uyari == 1){
?>
<div class="col">
<div class="alert alert-success alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<h5><i class="icon fas fa-info"></i> Yeni Sipariş Oluştur / Merkez Seçimi</h5>
Tüm merkez listesi listelenmiştir. Sipariş oluşturmak için öncelikle listeden merkez seçimi yapmalısınız.
</div>

</div>

<?php
 }
?>
<section class="content text-md">
<div class="card card-dark" style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - Merkez Bilgileri</h3>
               </div>
              <!-- /.card-header -->
              <div class="card-body">
                


                <table id="users_table" class="table table-bordered text-xs table-striped nowrap" style=" width:100%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                  <thead>
                  <tr>
                  <th  style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;   border-bottom:0px solid; width:50px">İşlem</th> 
                
                    <th  style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;   border-bottom:0px solid">Merkez Adı</th>
                      <th  style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;   border-bottom:0px solid">İletişim Numarası</th>
                    <th  style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;   border-bottom:0px solid">Adres</th>
                  </tr>
                  </thead>
                  </table>




              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
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