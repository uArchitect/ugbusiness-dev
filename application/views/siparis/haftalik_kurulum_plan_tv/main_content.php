
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