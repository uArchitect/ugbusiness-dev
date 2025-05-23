 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
<div class="row"> 


</div>


<section class="content text-md">


<div class="row">
  <div class="col-4">


  
<div class="card card-dark">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - Servis Kayıtları</h3>
               
               
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  </div> 

  </div>
  </div>
  <div class="col-8">


  
<div class="card card-dark">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - Servis Kayıtları</h3>
               
               
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                 






                <table id="users_table"  class="table table-bordered table-striped nowrap" style="width:100%">
                  <thead>
                  <tr> 
                    <th >Servis Kodu</th>
                    <th >Servis Bilgileri</th>  
                    <th >Cihaz Bilgileri</th>
                   
                   
                   
                  </tr>
                  </thead>

                  </table>








              </div>
              <!-- /.card-body -->
            </div>

  </div>
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
                    { "data": 2 } 
                ]
            });
    
             
    
    
        });
    </script>