 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
<div class="row">
  <div class="col-lg-3 col-6">
    <div class="small-box bg-dark">
      <div class="inner">
        <h3>
          
        </h3>
        <p>Toplam Servis Kayıtları</p>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
      <a href="<?=base_url("servis")?>" class="small-box-footer">Tümünü Görüntüle <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <div class="col-lg-3 col-6">
    <div class="small-box bg-warning">
      <div class="inner">
        <h3>
         
        </h3>
        <p>Devam Eden Servis Kayıtları</p>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
      <a href="<?=base_url("servis")."?page=1"?>" class="small-box-footer">Tümünü Görüntüle <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>

  <div class="col-lg-3 col-6">
    <div class="small-box bg-success">
      <div class="inner">
        <h3>
         
        </h3>
        <p>Tamamlanan Servis Kayıtları</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
      <a href="<?=base_url("servis")."?page=2"?>" class="small-box-footer">Tümünü Görüntüle <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>

  <div class="col-lg-3 col-6">
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>
        
        </h3>
        <p>İptal Servis Kayıtları</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
      <a href="<?=base_url("servis")."?page=3"?>" class="small-box-footer">Tümünü Görüntüle <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>









</div>


<section class="content text-md">
<div class="card card-dark">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - Servis Kayıtları</h3>
                <a href="<?=base_url("servis/servis_cihaz_sorgula_view")?>" type="button" class="btn btn-success btn-sm" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Servis Kaydı Oluştur</a>
                <?php $parcakontrolurl = base_url("stok/parca_kontrol"); ?>
        <a href="<?=$parcakontrolurl?>" target="_blank" class="btn btn-danger ml-2" style="float: right!;color: white;border: 0px;height: 37px;padding-top: 8px;">
        <i class="fas fa-search"></i> Parça Sorgula</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                 






                <table id="users_table"  class="table table-bordered table-striped nowrap" style="width:100%">
                  <thead>
                  <tr>
                    <th >#</th>
                    <th >Servis Kodu</th>
                    <th >Servis Bilgileri</th> 
                    <th >Müşteri Bilgileri</th>
                    <th >Cihaz Bilgileri</th>
                   
                   
                   
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
              
.yanipsonenyazifast {
      animation: blinker2 0.4s linear infinite;
   
      }
      @keyframes blinker2 {  
      50% { opacity: 0; }
      }


.yanipsonenyazi {
      animation: blinker 1.3s linear infinite;
      color: #1c87c9;
    
      font-weight: bold;
      font-family: sans-serif;
      }
      @keyframes blinker {  
      50% { opacity: 0; }
      }

      .custom-href:hover {
        text-decoration: underline;
      }

     
    .anim-rotate {
        animation: rotate 1s linear infinite;
    }

    @keyframes rotate {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }
 
      

      .custom-href:hover {
            text-decoration: underline;
          }
    
          .users_table_processing{
            margin-top:50px;
          }
       
         
    table.dataTable tbody th, table.dataTable tbody td {
        padding: 8px 10px  ;
    }

    .table-striped tbody tr:nth-of-type(odd) {
      background-color: rgb(177 176 176 / 18%);
}
     </style>
    

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
                "pageLength": 10,
                scrollX: true,
              
                "ajax": {
                    "url": "<?php echo site_url('servis/filter_ajax'); ?>"+filter_d,
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
                    { "data": 4 } 
                ]
            });
    
             
    
    
        });
    </script>