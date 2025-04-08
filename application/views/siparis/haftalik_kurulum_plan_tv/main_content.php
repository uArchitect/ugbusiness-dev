<div class="content" style="margin-top:-1px;background:#041678;padding-top:10px;margin-left:0!important;">

<div class="row">
  <div class="col-12">

  
<section class="content text-md">
<div class="row" style="display:block;font-size:30px;text-align:center;padding:20px;">
<img src="https://api.ugbusiness.com.tr/umexlogo.png" style="
        width: 279px;
    margin-top: -27px;
"></div>
  <div class="row" style="display:block;font-size:50px;text-align:center;padding:20px;text-align: right;position: absolute;top: 0;right: 0;font-size: 37px;font-weight: 900;margin-top: -10px;color:white;" id="current-time"></div>

  <div class="row" style="display:block;font-size:50px;text-align:center;padding:20px;text-align: right;position: absolute;top: 0;font-size: 37px;font-weight: 900;margin-top: -10px;color:white;"  ><?=date("d.m.Y")?></div>


 

<script>
  function updateTime() {
    const now = new Date();
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const seconds = String(now.getSeconds()).padStart(2, '0');
    
    document.getElementById('current-time').textContent = `${hours}:${minutes}:${seconds}`;
  }

  setInterval(updateTime, 1000);
  updateTime();  // Initially set the time
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
  foreach ($days as $dayName => $dayData): ?>
    <div class="col  ">
      <div class="card border-0 rounded-3" style="  background: #000c55;  height: 650px;">
        <div class="card-header bg-primary text-white text-center" style="    background-color: #0018a4 !important;">
          <h5 class="mb-0"><?= $dayName ?></h5>
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