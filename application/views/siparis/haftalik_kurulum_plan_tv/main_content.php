<div class="content" style="margin-top:-1px;background:#ffffff;padding-top:10px;margin-left:0!important;">

<div class="row">
  <div class="col-12">

  
<section class="content text-md">
<div class="row" style="font-size:35px;text-align:center">
  UMEX ÜRETİM LİSTESİ</div>
  
<div class="row">
  <?php 
  $days = [
    'Pazartesi' => $day2, 
    'Salı' => $day3, 
    'Çarşamba' => $day4, 
    'Perşembe' => $day5, 
    'Cuma' => $day6 
  ];
  foreach ($days as $dayName => $dayData): ?>
    <div class="col mb-4">
      <div class="card   border-0 rounded-3">
        <div class="card-header bg-primary text-white text-center">
          <h5 class="mb-0"><?= $dayName ?></h5>
        </div>
        <div class="card-body">
          <div class="timeline">
            <div class="timeline-items">
              <?php if (!empty($dayData)) foreach ($dayData as $value): ?>
                <div class="timeline-item mb-3">
                <?php foreach (get_siparis_urunleri($value->siparis_id) as $ur): ?>
                 
                 
                  <div class="timeline-body">
                    <div class="mb-2">
                      <strong>Kurulum Tarihi:</strong> <?= date("d.m.Y", strtotime($value->kurulum_tarihi)) ?>
                    </div>
                   
                    <div>
                      
                        <b><?= $ur->urun_adi ?></b> <br>
                  
                    </div>
                  </div>   
                  
                  
                  <?php endforeach; ?>


                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>
</section>

  </div>
   
</div>


</div>


<script>
  setInterval(function() {
    location.reload();  goFullScreen();
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





