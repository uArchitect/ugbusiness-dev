<div class="content" style="margin-top:-1px;background:#ffffff;padding-top:10px;margin-left:0!important;">

<div class="row">
  <div class="col-12">

  
<section class="content text-md">
<div class="row" style="display:block;font-size:30px;text-align:center;padding:20px;">
  UMEX ÜRETİM LİSTESİ</div>
  
<div class="row">
  <?php 
  $days = [
    'Pazartesi' => $day1, 
    'Salı' => $day2, 
    'Çarşamba' => $day3, 
    'Perşembe' => $day4, 
    'Cuma' => $day5 
  ];
  foreach ($days as $dayName => $dayData): ?>
    <div class="col  ">
      <div class="card border-0 rounded-3" style="    height: 682px;">
        <div class="card-header bg-primary text-white text-center">
          <h5 class="mb-0"><?= $dayName ?></h5>
        </div>
        <div class="card-body">
          <div class="timeline">
            <div class="timeline-items">
              <?php if (!empty($dayData)) foreach ($dayData as $value): ?>
                <div class="timeline-item mb-3">
                  
                  <div class="timeline-body">
                    
                   
                    <div>
                    <b><?= $value->urun_adi ?> ( <?=$value->renk_adi?> )</b>
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
</div>


<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
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
   // location.reload();  goFullScreen();
}, 5000);  // 60000 milisaniye = 1 dakika
function goFullScreen() {
            if (document.documentElement.requestFullscreen) {
                document.documentElement.requestFullscreen();
            } else if (document.documentElement.mozRequestFullScreen) { // Firefox için
                document.documentElement.mozRequestFullScreen();
            } else if (document.documentElement.webkitRequestFullscreen) { // Chrome ve Safari için
                document.documentElement.webkitRequestFullscreen();
            } else if (document.documentElement.msRequestFullscreen) { // Internet Explorer için
                document.documentElement.msRequestFullscreen();
            }
        }
 
  </script>