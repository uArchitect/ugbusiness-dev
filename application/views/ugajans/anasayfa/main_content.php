
<div class="content-wrapper"> 
<?php  if(goruntuleme_kontrol("yemek_listesi_goruntule")) : ?>
          <section class="col-lg-4 pl-0 text-center pr-2  d-block d-lg-none" style="    padding-right: 1.0rem !important;">
      
          <div class="col <?=($yemek->yemek_detay=="")?"d-none":""?>" style="border: 1px solid #d9d7d7; margin: 5px; padding: 0; border-radius: 8px;">
  <div style="    border: 5px solid #ffffff;outline: 1px solid #073773;min-height:270px;position: relative; background-size: cover; background-position: center; background-image: url('https://beyazsayfayemek.com/wp-content/uploads/2021/10/awesome-indian-food-wallpaper-preview.jpg'); border-radius: 8px; overflow: hidden;">
    <div style="align-content: center;min-height:270px;background: rgba(0, 0, 0, 0.7); padding: 20px; border-radius: 8px;">
      <?php
      $guncelTarih = getdate();
      $gunSayisi = date('t', mktime(0, 0, 0, $guncelTarih['mon'], 1, $guncelTarih['year']));
      ?> 
      <a href="" style="color: white; font-size: 24px; font-weight: bold; text-decoration: none;">
      <i class="fas fa-clock" aria-hidden="true"></i><br>Öğle Yemek Menüsü
      </a>
       
      <br><br>
       
      <?php
        $items = explode('#', $yemek->yemek_detay);
      ?>
      <div class="row text-white">
      
      <?php 
      
      foreach ($items as $item) {
        echo "<div class='col m-2 p-2' style=' font-weight:bold;background:#000000a1;   align-content: center;border-radius:10px;border:1px solid #ffffff;font-size:16px'>".$item . "</div>";
    }
      ?>
      </div>
      
    </div>
  </div>
</div>


                    </section>
<?php  endif; ?>
</div>