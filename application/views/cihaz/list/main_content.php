<style>
  tr:has(.egitimcihazi) {
  background-color: yellow;
}
</style> 


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px; margin-top:-2px">
 
<section class="content text-md">
<div class="card card-dark" style="border-radius:0px !important;">
           
              <!-- /.card-header -->
              <div class="card-body p-1 pt-2" style="font-size: small;    border: 2px solid #181818;
    border-radius: 3px;">
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
                 




                <table id="users_table" class="table table-bordered table-striped nowrap" style="font-weight: 600;width:100%;">
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
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
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
                    "url": "<?php echo site_url('cihaz/cihazlar_ajax'); ?>"+filter_d,
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
  $('#users_table').DataTable().search(getiade).draw(); // Arama terimini geri yükle
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
    };

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

    
    <script>
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
  };
    
      
  </script>

 
