

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
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
   <div class="container" style="
    text-align: center;
    display: block;
    font-size: 29px;
    font-weight: bolder;
    padding: 13px;
">
    
UMEX ÜRETİM LİSTESİ
      
       
 
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper pt-2" style="display: grid
;background:#e9e9e9;margin-left:0px">
    <!-- Content Header (Page header) -->
    
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content" style="    height: 100%;">
      <div class="container" style="     height: 100%;       max-width: 100%;">
        <div class="row pb-3" style="    height: 100%;">
          
		    
		   


        <?php 
  $days = [
    'Pazartesi' => $day1, 
    'Salı' => $day2, 
    'Çarşamba' => $day3, 
    'Perşembe' => $day4, 
    'Cuma' => $day5
  ];




  $gun = date('N');
  $count = 0;
  foreach ($days as $dayName => $dayData): ?>




<div class="col" style="    height: 100%;">
             

            <div class="card card-primary card-outline" style="    height: 100%;">
			<div class="card-header text-bold"><?= $dayName ?>
			</div>
              <div class="card-body">
              <button style="   padding-right: 6px;
    width: 100%;
    border: 1px dashed #002355;
    padding-left: 6px;" onclick="if (event.target.tagName.toLowerCase() === 'a') { event.stopPropagation(); } else{ showcihaz(2369); }" type="button" class="btn btn-default text-left pb-2">   
<div class="row">
  <div class="col" style="max-width: 97px;">

  <img src="https://www.umex.com.tr/uploads/products/umex-plus.png" alt="..." style="width: 94px;" class="rounded img-thumbnail">
                            

  </div>
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



 
          <!-- /.col-md-6 -->
           
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
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
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url("assets")?>/dist/js/demo.js"></script>
</body>
</html>




























<style>
  
  .wrapper{
background:transparent!important;
  }
  body {
	background: linear-gradient(-45deg, 	#585858, #404040, #787878, #888888);
	background-size: 400% 400%;
	animation: gradient 15s ease infinite;
	height: 100vh;
  overflow-y: hidden!important;
}

@keyframes gradient {
	0% {
		background-position: 0% 50%;
	}
	50% {
		background-position: 100% 50%;
	}
	100% {
		background-position: 0% 50%;
	}
}


  </style>
<div class="content" style="margin-top:-1px; padding-top:10px;margin-left:0!important;">

<div class="row">
  <div class="col-12">

  
<section class="content text-md">
<div class="row" style="display:block;font-size:30px;text-align:center;padding:20px;">
<img src="https://api.ugbusiness.com.tr/umexlogo.png" style="
        width: 279px;
    margin-top: -27px; margin-bottom: -27px;
"><br>
<span style="text-align:center;font-size:34px;color:white;display:block"> HAFTALIK ÜRETİM LİSTESİ</span>
</div>
   <div class="row" style="display:block;font-size:50px;text-align:center;padding:20px;text-align: right;position: absolute;top: 0;right: 0;    font-size: 53px;font-weight: 900;margin-top: -10px;color:white;" id="current-time">


   <?=date("h:i:s")?>
   </div>

  <div class="row" style="display:block;font-size:50px;text-align:center;padding:20px;text-align: right;position: absolute;top: 0;    font-size: 53px;font-weight: 900;margin-top: -10px;color:white;"  ><?=date("d.m.Y")?></div>


 

<script>
  function updateTime() {
    const now = new Date();
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const seconds = String(now.getSeconds()).padStart(2, '0');
    
    document.getElementById('current-time').textContent = `${hours}:${minutes}:${seconds}`;
  }

  setInterval(updateTime, 1000);
  updateTime();  
</script>
<div class="row">
  <?php 
  $days = [
    'Pazartesi' => $day1, 
    'Salı' => $day2, 
    'Çarşamba' => $day3, 
    'Perşembe' => $day4, 
    'Cuma' => $day5
  ];




  $gun = date('N');
  $count = 0;
  foreach ($days as $dayName => $dayData): ?>
    <div class="col  ">
      <div class="card border-0 rounded-3" style="
     
      background: #000c55;
        height: 450px;">
        <div class="card-header bg-primary text-white text-center" style="   
        
         <?php
          $count++;
          if($count==$gun){
            echo "background:rgb(0, 163, 33)!important;;";
          }else{
            echo " background-color: #0018a4 !important;";
          }
          
          
          ?>
        
       ">
          <h5 class="mb-0"
          style="
          
          "
          
          ><?= $dayName ?></h5>
        </div>
        <div class="card-body">
          <div class="timeline">
            <div class="timeline-items">
              <?php if (!empty($dayData)) foreach ($dayData as $value): ?>
                <div class="timeline-item mb-3" style="    background: transparent;
    border: 1px dashed #5d8aff;
    color: white;">
                  
                  <div class="timeline-body">
                    
                   
                    <div>
                    <b style="font-size:14px"><?= $value->urun_adi ?> ( <?=($value->renk_adi == "Umex Grisi" ? "U. Grisi" : $value->renk_adi)?> )</b>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>









  <div class="col  ">
      <div class="card border-0 rounded-3" style="  background: #000c55;  height: 450px;">
        <div class="card-header bg-primary text-white text-center" style="  color:black!important;  background-color:rgb(255, 242, 0) !important;">
          <h5 class="mb-0" style="color:black!important;">Pazartesi</h5>
        </div>
        <div class="card-body">
          <div class="timeline">
            <div class="timeline-items">
            
            </div>
          </div>
        </div>
      </div>
    </div>










</div>


<div class="row">
  <div class="col">
    <div class="card" style=" background-color: #000c55 !important;">
      <div class="card-body" style="color:white">
        YEMEK LİSTESİ
      </div>
    </div>
  </div>
</div>

</section>

  </div>
   
</div>


</div>


<script>
  setInterval(function() {
    location.reload();  goFullScreen();
}, 300000);   
function goFullScreen() {
            if (document.documentElement.requestFullscreen) {
                document.documentElement.requestFullscreen();
            } else if (document.documentElement.mozRequestFullScreen) {  
                document.documentElement.mozRequestFullScreen();
            } else if (document.documentElement.webkitRequestFullscreen) {  
                document.documentElement.webkitRequestFullscreen();
            } else if (document.documentElement.msRequestFullscreen) {  
                document.documentElement.msRequestFullscreen();
            }
        }
 
  </script>