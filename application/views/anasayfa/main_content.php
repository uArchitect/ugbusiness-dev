  
<div class="content-wrapper pr-2 mobil-genislik" style="padding-top:15px">


 <?php  if(goruntuleme_kontrol("yemek_listesi_goruntule")) : ?>

  
          <section class="col-lg-10 pl-0 text-center pr-2" style="    padding-right: 1.0rem !important;">

          <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Günlük Menü:

                  <?php
        $items = explode('#', $yemek->yemek_detay);
      ?>
      <div class="row">
      <?php 
      $count = 0;
      foreach ($items as $item) {
        echo "<div class='col text-center'>";
        $count++;
         


        echo  $item  ;
        echo "</div>";
    }
      ?>
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
               
              <!-- /.card-body -->
            </div>

            

                    </section>
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