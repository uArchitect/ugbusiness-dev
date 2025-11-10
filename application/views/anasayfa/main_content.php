  
<div class="content-wrapper pr-2 mobil-genislik" style="padding-top:15px">


 <?php  if(goruntuleme_kontrol("yemek_listesi_goruntule")) : ?>


  <div class="row">
    <div class="col-md-10  ">
      <div class="col-md-6 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Günlük Menü</span>
                <span class="info-box-number">
                   <?php
        $items = explode('#', $yemek->yemek_detay);
      ?>
      <div class="row">
      <?php 
      $count = 0;
      foreach ($items as $item) { 
        $count++;
         


        echo  $item." "  ; 
    }
      ?>
                </span>
              </div>
              
            </div>
           
          </div>
    </div>
  </div>
  
       
<?php  endif; ?>


  <section class="content pr-0">
    <div class="row">
      <div class="col-12">
        <h3 style="font-size: xxx-large; color: blue; text-align: center; padding: 10px; font-weight: 600;"> 
          
        ŞİRKET KURALLARI
      
      </h3>
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