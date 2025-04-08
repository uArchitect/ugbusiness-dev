

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?=base_url("assets")?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url("assets")?>/dist/css/adminlte.min.css">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white" style="margin-left:0px;">
   <div class="container" style="
    text-align: center;
    display: block;
    font-size: 29px;
    font-weight: bolder;
    padding: 13px;
">
    
UMEX ÜRETİM LİSTESİ (<span style="color:red"> TEST EKRANI</span>)
      
       
 
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper pt-2" style="display: grid
;background:#e9e9e9;margin-left:0px">
    <!-- Content Header (Page header) -->
    
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content" style="    height: 100%!important;">
      <div class="container" style="     height: 100%!important;       max-width: 100%!important;">
        <div class="row pb-3" style="    height: 100%!important;">
          
		    
		   


        <?php 
  $days = [
    'PAZARTESİ' => $day1, 
    'SALI' => $day2, 
    'ÇARŞAMBA' => $day3, 
    'PERŞEMBE' => $day4, 
    'CUMA' => $day5
  ];




  $gun = date('N');
  $count = 0;
  foreach ($days as $dayName => $dayData): ?>




<div class="col" style="    height: 100%!important;">
             

            <div class="card card-primary card-outline" style="    height: 100%!important;">
			<div class="card-header  text-center"><?= $dayName ?>
			</div>
              <div class="card-body" style="height:420px">
              <button style="   padding-right: 6px;
    width: 100%!important;
    border: 1px dashed #002355;
    padding-left: 6px;"   type="button" class="btn btn-default text-left pb-2">   
<div class="row">
  
  <div class="col" style="padding-left: 0px;">



  <span style="display: block;background: #dbdbdb;padding: 5px;color: white;border-radius: 5px;border-radius: 3px 3px 0 0;">   <span style="min-width: 230px; width: 230px;   margin-left:5px"> <b style="color:#0f3979">Umex Plus / Gri</b>    </span> 
                        
    </span>

                                  <span style="
    height: 11px;
"></span>
<div style="padding-left:10px;background:white;border:1px solid;border-top:0px;border: 1px solid #dbdbdb; border-top: 0px; border-radius: 0px 0px 3px 3px;">
                             Buzlanan Başlık<br>   Buzlanan Başlık  <br>

 
                            
                                                         


                             </div>
  </div>
</div>
                               
                              </button>
							  
                
              </div>
              <div class="card-footer"><b>Yemek Menüsü : </b>Karnabahar, Mercimek Çorbası, Cacık, Tatlı
              </div>
            </div><!-- /.card -->
          </div>

 
  <?php endforeach; ?>



  <div class="col" style="    height: 100%;">
             

             <div class="card card-primary card-outline" style="    height: 100%;">
       <div class="card-header text-bold"><?= $dayName ?>
       </div>
               <div class="card-body" style="height:420px">
               <button style="   padding-right: 6px;
     width: 100%;
     border: 1px dashed #002355;
     padding-left: 6px;"   type="button" class="btn btn-default text-left pb-2">   
 <div class="row">
 
   <div class="col" style="padding-left: 0px;">
 
 
 
   <span style="display: block;background: #dbdbdb;padding: 5px;color: white;border-radius: 5px;border-radius: 3px 3px 0 0;">   <span style="min-width: 230px; width: 230px;   margin-left:5px"> <b style="color:#0f3979">Umex Plus / Gri</b>    </span> 
                         
     </span>
 
                                   <span style="
     height: 11px;
 "></span>
 <div style="padding-left:10px;background:white;border:1px solid;border-top:0px;border: 1px solid #dbdbdb; border-top: 0px; border-radius: 0px 0px 3px 3px;">
                              Buzlanan Başlık<br>   Buzlanan Başlık  <br>
 
  
                             
                                                          
 
 
                              </div>
   </div>
 </div>
                                
                               </button>
                 
                 
               </div>
               <div class="card-footer"><b>Yemek Menüsü : </b>Karnabahar, Mercimek Çorbası, Cacık, Tatlı
               </div>
             </div><!-- /.card -->
           </div>
 
 
          <!-- /.col-md-6 -->
           
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 
 
  <!-- Main Footer -->
  <footer class="main-footer" style="margin-left:0px;margin-top:-20px">
    <!-- To the right -->
	<div class="text-center  " style="margin-bottom:-30px">
      <img src="<?=base_url("uploads")?>/umexlogo.svg"></img>
    </div>
    <div class="float-right d-none d-sm-inline">
      Son Güncelleme : 08.04.2025 15:20
    </div>
    <!-- Default to the left -->
   ÜRETİM DEPARTMANI
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?=base_url("assets")?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url("assets")?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url("assets")?>/dist/js/adminlte.min.js"></script>
<script>
 setInterval(function() {
    location.reload();  goFullScreen();
}, 300000);  
  </script>
</body>
</html>

























 