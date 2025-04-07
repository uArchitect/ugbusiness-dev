<div class="content" style="margin-top:-1px;background:#ffffff;padding-top:10px;margin-left:0!important;">

<div class="row">
  <div class="col-9">

  
<section class="content text-md">

  
<div class="row">
  <?php 
  $days = [
    'Pazartesi' => $day1, 
    'Salı' => $day2, 
    'Çarşamba' => $day3, 
    'Perşembe' => $day4, 
    'Cuma' => $day5,
    'Cumartesi' => $day6,
    'Pazar' => $day7
  ];
  foreach ($days as $dayName => $dayData): ?>
    <div class="col mb-4">
      <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header bg-primary text-white text-center">
          <h5 class="mb-0"><?= $dayName ?></h5>
        </div>
        <div class="card-body">
          <div class="timeline">
            <div class="timeline-items">
              <?php if (!empty($dayData)) foreach ($dayData as $value): ?>
                <div class="timeline-item mb-3">
                  <div class="timeline-header p-2 rounded-3" style="background: #f0f0f0;">
                    <a href="<?= base_url('siparis/report/'.urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$value[0]->siparis_id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE"))) ?>" class="text-decoration-none text-dark">
                      <?= ($value->merkez_adi == "#NULL#") ? "<span class='badge bg-danger'>Merkez Adı Girilmedi</span>" : $value->merkez_adi ?>
                    </a>
                  </div>
                  <div class="timeline-body">
                    <div class="mb-2">
                      <strong>Kurulum Tarihi:</strong> <?= date("d.m.Y", strtotime($value->kurulum_tarihi)) ?>
                    </div>
                    <div class="mb-2">
                      <?= ($value->merkez_adresi == "0" || $value->merkez_adresi == "") 
                        ? "<span style='opacity:0.7'>".$value->ilce_adi." / ".$value[0]->sehir_adi."</span>"
                        : "<span style='opacity:0.7'>".$value->ilce_adi." / ".$value[0]->sehir_adi."</span>" 
                      ?>
                    </div>
                    <div>
                      <?php foreach (get_siparis_urunleri($value[0]->siparis_id) as $ur): ?>
                        <b><?= $ur->urun_adi ?></b><br><span class="text-muted"><?= $ur[0]->seri_numarasi ?></span><br>
                      <?php endforeach; ?>
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
</section>

  </div>
  <div class="col-3">


  
  <!-- Yemek Listesi Bölümü -->
  <section class="content text-md ">
    <div class="row">
      <div class="col-12">
        <div class="card shadow-lg border-0 rounded-3"  >
          <div class="card-header bg-success text-white text-center">
            <h5 class="mb-0">Bugünkü Yemek Menüsü</h5>
          </div>
          <div class="card-body">
            <ul class="list-unstyled">
              <li><b>Pazartesi:</b>  Nohut Yahni , Pirinç Pilavı , Yoğurt , Turşu</li> 
            </ul>
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
















<style>
    * {
      box-sizing: border-box;
    }

    html, body {
      margin: 0;
      padding: 0;
      height: 100%;font-family:arial;
    }

    table {
      width: 100%;
      height: 100%;
      border-collapse: collapse;
      table-layout: fixed;
    }

    th, td {
      border: 1px solid black;
      text-align: center;
      padding: 8px;
    }
 
    .title-row th {
      border: none;
      font-size: 34px;
      font-weight: bold;
      padding: 20px 0;
    }

    .date-row th {
      font-weight: normal;padding: 20px 0; font-size: 25px;
    }

    .day-row th {
      font-weight: bold;  font-size: 25px; padding:25px;
    }

    .yellow-row td {
      background-color: #ffcc00;
      height:75px;
    }

    tbody tr:not(.yellow-row) td {
      height: calc((100% - 150px) / 6); /* ekran yüksekliği - başlık tahmini */
    }
  </style>



<table>
    <thead>
      <tr class="title-row" style=" padding: 50px!important;">
        <th colspan="5" style=" padding: 50px!important;">UMEX ÜRETİM LİSTESİ</th>
      </tr>
      <tr class="date-row">
        <th style="border: 0;">31.03.2024</th>
        <th style="border: 0;">1.04.2024</th>
        <th style="border: 0;">2.04.2024</th>
        <th style="border: 0;">3.04.2024</th>
        <th style="border: 0;">4.04.2024</th>
      </tr>
      <tr class="day-row">
        <th>PAZARTESİ</th>
        <th>SALI</th>
        <th>ÇARŞAMBA</th>
        <th>PERŞEMBE</th>
        <th>CUMA</th>
      </tr>
    </thead>
    <tbody>




 

  <tr>
    <td><?=get_siparis_urunleri($day1[0]->siparis_id)[0]->urun_adi?></td>
    <td><?=get_siparis_urunleri($day2[0]->siparis_id)[0]->urun_adi?></td>
    <td><?=get_siparis_urunleri($day3[0]->siparis_id)[0]->urun_adi?></td>
    <td><?=get_siparis_urunleri($day4[0]->siparis_id)[0]->urun_adi?></td>
    <td><?=get_siparis_urunleri($day5[0]->siparis_id)[0]->urun_adi?></td>
  </tr>
  <tr>
    <td><?=get_siparis_urunleri($day1[0]->siparis_id)[1]->urun_adi?></td>
    <td><?=get_siparis_urunleri($day2[0]->siparis_id)[1]->urun_adi?></td>
    <td><?=get_siparis_urunleri($day3[0]->siparis_id)[1]->urun_adi?></td>
    <td><?=get_siparis_urunleri($day4[0]->siparis_id)[1]->urun_adi?></td>
    <td><?=get_siparis_urunleri($day5[0]->siparis_id)[1]->urun_adi?></td>
  </tr>
  <tr>
    <td><?=get_siparis_urunleri($day1[0]->siparis_id)[2]->urun_adi?></td>
    <td><?=get_siparis_urunleri($day2[0]->siparis_id)[2]->urun_adi?></td>
    <td><?=get_siparis_urunleri($day3[0]->siparis_id)[2]->urun_adi?></td>
    <td><?=get_siparis_urunleri($day4[0]->siparis_id)[2]->urun_adi?></td>
    <td><?=get_siparis_urunleri($day5[0]->siparis_id)[2]->urun_adi?></td>
  </tr>
  <tr>
    <td><?=get_siparis_urunleri($day1[0]->siparis_id)[3]->urun_adi?></td>
    <td><?=get_siparis_urunleri($day2[0]->siparis_id)[3]->urun_adi?></td>
    <td><?=get_siparis_urunleri($day3[0]->siparis_id)[3]->urun_adi?></td>
    <td><?=get_siparis_urunleri($day4[0]->siparis_id)[3]->urun_adi?></td>
    <td><?=get_siparis_urunleri($day5[0]->siparis_id)[3]->urun_adi?></td>
  </tr>
  <tr>
    <td><?=get_siparis_urunleri($day1[0]->siparis_id)[4]->urun_adi?></td>
    <td><?=get_siparis_urunleri($day2[0]->siparis_id)[4]->urun_adi?></td>
    <td><?=get_siparis_urunleri($day3[0]->siparis_id)[4]->urun_adi?></td>
    <td><?=get_siparis_urunleri($day4[0]->siparis_id)[4]->urun_adi?></td>
    <td><?=get_siparis_urunleri($day5[0]->siparis_id)[4]->urun_adi?></td>
  </tr>
  <tr>
    <td><?=get_siparis_urunleri($day1[0]->siparis_id)[5]->urun_adi?></td>
    <td><?=get_siparis_urunleri($day2[0]->siparis_id)[5]->urun_adi?></td>
    <td><?=get_siparis_urunleri($day3[0]->siparis_id)[5]->urun_adi?></td>
    <td><?=get_siparis_urunleri($day4[0]->siparis_id)[5]->urun_adi?></td>
    <td><?=get_siparis_urunleri($day5[0]->siparis_id)[5]->urun_adi?></td>
  </tr>
  <tr>
    <td><?=get_siparis_urunleri($day1[0]->siparis_id)[6]->urun_adi?></td>
    <td><?=get_siparis_urunleri($day2[0]->siparis_id)[6]->urun_adi?></td>
    <td><?=get_siparis_urunleri($day3[0]->siparis_id)[6]->urun_adi?></td>
    <td><?=get_siparis_urunleri($day4[0]->siparis_id)[6]->urun_adi?></td>
    <td><?=get_siparis_urunleri($day5[0]->siparis_id)[6]->urun_adi?></td>
  </tr>
 
 
      <tr class="yellow-row">
        <td colspan="5"></td> 
      </tr>
    </tbody>
  </table>