  
<div class="content-wrapper pr-2 mobil-genislik" style="padding-top:15px">


 <?php  if(goruntuleme_kontrol("yemek_listesi_goruntule")) : ?>
          <section class="col-lg-4 pl-0 text-center pr-2" style="    padding-right: 1.0rem !important;">
          <?php
        $items = explode('#', $yemek->yemek_detay);
      ?>
      <div class="row">
      <?php 
      $count = 0;
      foreach ($items as $item) {
        echo "<div class='col text-center'>";
        $count++;
        if($count == 1){
          echo "<img src='$yemek->yemek_resim_1' style='width: 70px; display: block; margin: auto; border-radius: 50%; height: 70px; object-fit: cover;'>";
        }
        if($count == 2){
          echo "<img src='$yemek->yemek_resim_2' style='width: 70px; display: block; margin: auto; border-radius: 50%; height: 70px; object-fit: cover;'>";
        }
        if($count == 3){
          echo "<img src='$yemek->yemek_resim_3' style='width: 70px; display: block; margin: auto; border-radius: 50%; height: 70px; object-fit: cover;'>";
        }
        if($count == 4){
          echo "<img src='$yemek->yemek_resim_4' style='width: 70px; display: block; margin: auto; border-radius: 50%; height: 70px; object-fit: cover;'>";
        }
        if($count == 5){
          echo "<img src='$yemek->yemek_resim_5' style='width: 70px; display: block; margin: auto; border-radius: 50%; height: 70px; object-fit: cover;'>";
        }


        echo  $item  ;
        echo "</div>";
    }
      ?>

                    </section>
<?php  endif; ?>


  <section class="content pr-0">
    <div class="row">
      <div class="col-12">
        <h3 style="font-size: xxx-large; color: red; text-align: center; padding: 10px; font-weight: 600;">ŞİRKET KURALLARI</h3>
      </div>
      <div class="col-12">
        <?php 
        foreach ($kurallar as $kural) :
        ?>
        <div class="card card-danger" >
          <div class="card-header" style="font-weight:800;background-color:#df0015;">
            <span><?=$kural->sablon_kategori_adi?></span>  /   <?=$kural->sablon_veri_adi?>   
          </div>
          <div class="card-body">
 <?=$kural->sablon_veri_detay?>
          </div>
        </div>
        <?php 
        endforeach;
        ?>
      </div>
    </div>     
  </section> 
</div> 