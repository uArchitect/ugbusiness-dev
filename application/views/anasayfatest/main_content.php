


<section class="col-lg-<?=goruntuleme_kontrol("yemek_listesi_goruntule") ? "8" : "12"?> connectedSortable pl-0  d-none">



<style>
  .content-wrapper>.content {
padding: 0 0rem;
}
  .bg-dark{
    background:#003675!important;
    border-radius:0px!important;

  }
  .content-wrapper{
    padding:0px!important;
  }
.card2 { 
background: #fff;
border-radius: 5px;    border: 1px solid #073773;
padding: 10px 5px;
margin:5px;
box-shadow: 0 5px 5px rgba(0, 0, 0, 0.05);
transition: all 0.4s ease;
}@media (max-width: 768px) { /* Tabletler için */
.card2 {
width: calc(100% / 2 - 10px); /* 3 sütun */
}
}

@media (max-width: 480px) { /* Telefonlar için */
.card2 {
width: calc(100% / 2 - 10px); /* 3 sütun */
}
}
.card2 .content {
width: 100%;
display: flex;
flex-direction: column;
justify-content: center;
align-items: center;
text-align: center;
}
</style>

<div class="row">
<?php foreach ($kullanicilar as $kullanici) : ?>

<div class="card2">
<div class="content">
<div class="img">
<img style="border: 3px solid #ffffff; outline: 2px solid #393c3721;width:40px;height:40px;border-radius:50%; object-fit:cover" src="<?=base_url("uploads/$kullanici->kullanici_resim")?>"> 
                      
</div>
<div class="details">
<div class="name text-bold"><?=$kullanici->kullanici_ad_soyad?></div>
  <div class="job"><?=$kullanici->kullanici_unvan?></div>
  </div>
  <div onclick="location.href='tel:<?=$kullanici->kullanici_bireysel_iletisim_no?>';" class="media-icons text-primary" style="background: #ebebeb; color: black !important; border-radius: 5px; padding: 5px 5px;">
<i class="fa fa-phone"></i> <?=$kullanici->kullanici_bireysel_iletisim_no?>
  </div>  
</div>
</div>

<?php endforeach; ?>
</div>





   

   
</section> 
<?php  if(goruntuleme_kontrol("yemek_listesi_goruntule")) : ?>
          <section class="col-lg-4 pl-0 text-center pr-2  d-block d-lg-none" style="    padding-right: 1.0rem !important;">
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


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper p-1 mobil-genislik d-none d-sm-block" style="padding-top:0px;margin-top:-4px;      margin-right: -4px;">





<div style="background: #3d3a3a;
    height: 40px;
    width: 100%;
    color: #ffffff;
    border-top: 1px solid #1b1c21;
    text-align: right;
    /* background: linear-gradient(181deg, rgba(2, 0, 36, 1) 0%, rgb(24 24 24) 35%, rgb(24 24 24) 100%); */
    padding-top: 9px;
    border-bottom: 2px solid #181818;" class="<?=($yemek->yemek_detay=="")?"d-none":""?>">

<b>YEMEK MENÜ : </b>
<?php
    $items = explode('#', $yemek->yemek_detay);
    $lastItem = end($items);  
    
    foreach ($items as $item) {
        echo $item;
        if ($item !== $lastItem) {
            echo " , ";  
        }else{
           echo "  ";
        }
    }
?>
 &nbsp;
</div>
<div tabindex="-1" class=" d-none d-sm-block" style="position: relative; width: 100%;  height: 1051px; padding-top: 50.0000%;
 padding-bottom: 0; box-shadow: 0 2px 8px 0 rgba(63,69,81,0.16);  margin-bottom: 0.9em; overflow: hidden;
 border-radius: 8px; will-change: transform;">
  <iframe loading="lazy" style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; border: none; padding: 0;margin: 0;"
    src="https://www.canva.com/design/DAGT7hcPHQc/tL9MP00uO79UoQqzpAqasw/view?embed" allowfullscreen="allowfullscreen" allow="fullscreen">
  </iframe>
</div> 

 

</div>

<style>
  .grid-container {
    display: flex;
    justify-content: center;
    align-items: center;
    
  }

  .grid {
    display: grid;
    grid-template-columns: repeat(13, 1fr);  
    grid-template-rows: repeat(19, 1fr);    
    gap: 1px;  
    width: 100%;
    height: 100%;
  }

  .grid-button {
    width: 100%;
    height: 100%;
    padding: 10px 3px 10px 3px;
    background-color: #ffffff;
    border: 0px solid whitesmoke;
    cursor: pointer;
    transition: background-color 0.3s;
  }

  .grid-button:hover {
    background-color: #f0f0f0;  
  }

  main footer{
    display:none!important;
  }
</style>
