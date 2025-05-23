 <style>
  @media only screen and (max-width: 800px) {
 .col{
  width:33%!important;
 }
}
  </style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px;background:#000d2b;">
 
<section class="content text-md">

<div class="row">
<div class="col"><a href="<?=base_url("cihaz/cihaz_harita/$secilen_urun")?>" class="btn btn-<?=$secilen_urun == 1 ? "primary" : "dark" ?> p-4 pt-0" style="height:80px;padding-top:5px!important;background:red;font-size:20px!important">HARİTA'YA GERİ DÖN</a> </div>
  
  
  <div class="col"><a href="<?=base_url("cihaz/cihaz_harita_il_detay/".$secilen_sehir."/1")?>" class="btn btn-<?=$secilen_urun == 1 ? "primary" : "dark" ?> p-4 pt-0" style="height:80px;width:100%;padding-top:5px!important;"><img style="object-fit: contain; height: auto; height: 41px; max-width: 100%; width: auto; max-width: 100%;" src="https://www.umex.com.tr/assets/images/layouts/umex-logo-white.png" class="text-center" alt=""> <span class="custom_count"><?=$urun_adet_1 ?? 0?></span></a> </div>
  <div class="col"><a href="<?=base_url("cihaz/cihaz_harita_il_detay/".$secilen_sehir."/8")?>" class="btn btn-<?=$secilen_urun == 8 ? "primary" : "dark" ?>" style="height:80px;width:100%;"><img style="object-fit: contain; height: auto; height: 41px; max-width: 100%; width: auto; max-width: 100%;" src="https://www.umex.com.tr/assets/images/layouts/umexplus-logo.png" class="text-center" alt=""> <span class="custom_count"><?=$urun_adet_8 ?? 0?></span> </a> </div>
  <div class="col"><a href="<?=base_url("cihaz/cihaz_harita_il_detay/".$secilen_sehir."/5")?>" class="btn btn-<?=$secilen_urun == 5 ? "primary" : "dark" ?>" style="height:80px;width:100%;"><img style="object-fit: contain; height: auto; height: 41px; max-width: 100%; width: auto; max-width: 100%;" src="https://www.umex.com.tr/assets/images/layouts/umex-slim.svg" class="text-center" alt=""> <span class="custom_count"><?=$urun_adet_5 ?? 0?></span></a>  </div>
  <div class="col"><a href="<?=base_url("cihaz/cihaz_harita_il_detay/".$secilen_sehir."/3")?>" class="btn btn-<?=$secilen_urun == 3 ? "primary" : "dark" ?>" style="height:80px;width:100%;"><img style="object-fit: contain; height: auto; height: 41px; max-width: 100%; width: auto; max-width: 100%;" src="https://www.umex.com.tr/assets/images/layouts/umex-ems.svg" class="text-center" alt=""> <span class="custom_count"><?=$urun_adet_3 ?? 0?></span></a> </div>
  <div class="col"><a href="<?=base_url("cihaz/cihaz_harita_il_detay/".$secilen_sehir."/6")?>" class="btn btn-<?=$secilen_urun == 6 ? "primary" : "dark" ?>" style="height:80px;width:100%;"><img style="object-fit: contain; height: auto; height: 41px; max-width: 100%; width: auto; max-width: 100%;" src="https://www.umex.com.tr/assets/images/layouts/umex-s.svg" class="text-center" alt=""> <span class="custom_count"><?=$urun_adet_6 ?? 0?></span></a> </div>
  <div class="col"><a href="<?=base_url("cihaz/cihaz_harita_il_detay/".$secilen_sehir."/2")?>" class="btn btn-<?=$secilen_urun == 2 ? "primary" : "dark" ?>" style="height:80px;width:100%;"><img style="object-fit: contain; height: auto; height: 41px; max-width: 100%; width: auto; max-width: 100%;" src="https://www.umex.com.tr/assets/images/layouts/umex-diode.svg" class="text-center" alt=""> <span class="custom_count"><?=$urun_adet_2 ?? 0?></span></a> </div>
  <div class="col"><a href="<?=base_url("cihaz/cihaz_harita_il_detay/".$secilen_sehir."/4")?>" class="btn btn-<?=$secilen_urun == 4 ? "primary" : "dark" ?>" style="height:80px;width:100%;"><img style="object-fit: contain; height: auto; height: 41px; max-width: 100%; width: auto; max-width: 100%;" src="https://www.umex.com.tr/assets/images/layouts/umex-gold.svg" class="text-center" alt=""> <span class="custom_count"><?=$urun_adet_4 ?? 0?></span></a>  </div>
  <div class="col"><a href="<?=base_url("cihaz/cihaz_harita_il_detay/".$secilen_sehir."/7")?>" class="btn btn-<?=$secilen_urun == 7 ? "primary" : "dark" ?>" style="height:80px;width:100%;"><img style="object-fit: contain; height: auto; height: 41px; max-width: 100%; width: auto; max-width: 100%;" src="https://www.umex.com.tr/assets/images/layouts/umex-q.svg" class="text-center" alt=""> <span class="custom_count"><?=$urun_adet_7 ?? 0?></span></a> </div>
  

</div>

<div class="card card-dark m-2" style="border-radius:0px !important;">
         

           <span style="background: #02377d;font-size: 34px;color: white;text-align: center;font-weight: 800;"><?=$secilen_sehir_adi?></span>
              <!-- /.card-header -->
              <div class="card-body p-1 pt-2 " style="font-size: small;    border: 2px solid #181818;
    border-radius: 3px;">
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

                </div></div>
 
<script src="https://code.jquery.com/jquery-1.12.4.min.js"   integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="   crossorigin="anonymous"></script>
 
</section>
</div>





<script type="text/javascript">
        $(document).ready(function() {










          const urlParams = new URLSearchParams(window.location.search);
 


            $('#users_table').DataTable({
                "processing": true,
                "serverSide": true,
                "pageLength": 13,
                scrollX: true,
                "ajax": {
                    "url": '<?php echo site_url("cihaz/cihazlar_ajax/$secilen_sehir/$secilen_urun/1"); ?>',
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
       .custom_count{
        display: block;
    background: #ffffff;
    border-radius: 5px;color:black;
    width: fit-content;
    margin: auto;
    bottom: 5px;
    padding-left: 5px;
    padding-right: 5px;
    position: absolute;
    left: 45%;
       }
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