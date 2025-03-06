 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-top:-1px;background:#ffffff;padding-top:10px">
 
<section class="content text-md">

  
<div class="card card-dark" style="border-radius:0px !important;margin-top:-8px">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - Tüm Siparişler</h3>
                <a href="<?=base_url("siparis/merkez")?>" type="button" class="btn btn-primary btn-sm" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Kayıt Ekle</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body" >
 
                <table id="users_tablce" class="table table-bordered table-striped nowrap " style="width:100%">
                  <thead>
                  <tr >
                
                    <th style="width: 42px;">Sipariş Kodu</th> 
                
                    <th>Müşteri Adı</th> 
                    <th>Adres</th> 
                 
                    <th>İşlem</th> 
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
   function showWindow(param){
            Swal.fire({
               
                html: '<iframe src="'+param+'" width="100%" height="100%" frameborder="0"></iframe>',
                showCloseButton: true,
                showConfirmButton: false,
                focusConfirm: false,
                width: '80%',
                height: '80%',
            });
        };
      
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
                ]
            });
    
             
    
    
        });
    </script>