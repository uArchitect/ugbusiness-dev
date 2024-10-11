<style>
        /* Genel stil */
        .mobil-genislik {
          margin-left: 235px; 
        }
        .table th {
    background: #ffffff !important;
    color: #0a0a0a!important;
    padding: 10px!important;
    padding-left: 10px !important;
}
        /* Mobil cihazlar için stil */
        @media only screen and (max-width: 600px) {
            .mobil-genislik {
              margin-left: -10px; 
            }
        }
    </style>
 

<script>
function myFunction() { 
  window.open('http://192.168.2.118', 'newWindow', 'width=600,height=400');
}
</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper pr-2 mobil-genislik" style="padding-top:15px">
 

    <!-- Main content -->
    <section class="content pr-0">
      <div class="container-fluid pr-0" style="margin-left: -8px;">
         
        <!-- Main row -->
        <div class="row" style="margin-right:-8px;">
















        

        <div class="col-12" style="padding: 0;">
        <div class="card card-widget widget-user-2" style="    margin-bottom: 5px;">

<div class="widget-user-header bg-dark"  >
<div class="widget-user-image">
<img style="BACKGROUND: #001cab;
    border: 2px solid white !important;object-fit: cover;width:65px;height:65px" class="img-circle elevation-2" src="<?=aktif_kullanici()->kullanici_resim ? base_url("uploads/$aktif_kullanici->kullanici_resim") : base_url("uploads/default.png")?>" alt="User Avatar">
</div>

<h3 class="widget-user-username"><?=$aktif_kullanici->kullanici_ad_soyad?> / <?=$aktif_kullanici->kullanici_unvan?></h3>
<h5 class="widget-user-desc" style="font-weight: 300; font-size: medium;">

<div class="comment-text ml-0">
       <i class="fa fa-envelope"></i> Email : <?=$aktif_kullanici->kullanici_email_adresi?>
       <i class="fa fa-phone ml-3"></i>  Dahili Numarası : <?=$aktif_kullanici->kullanici_dahili_iletisim_no?>
       <i class="fa fa-building ml-3"></i>  Departman : <?=$aktif_kullanici->departman_adi?>
       
        </div>

</h5>
</div>

 

</div>


  
        </div>


          <!-- Left col -->
          
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-12 connectedSortable p-0 d-none">

            




          













            
<div class="row d-none">
  <div class="col p-0 pr-1">
 <!-- Custom tabs (Charts with tabs)-->
 <div class="card card-dark mb-2">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fa fa-bell mr-1"></i>
                  Duyurular
                </h3>
                
              </div><!-- /.card-header -->
  
 <!-- /.card-header -->
 <div class="card-body p-0">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">               
                  <div class="carousel-inner">

                    <?php 
                      $count=0;
                      foreach ($duyurular as $duyuru) {
                        $count++;
                          ?>
                          <div class="carousel-item <?=($count==1)?"active":""?>">
                            <div class="card mb-0">
                              <div class="card-body" style="min-height:105px;height:105px;max-height:105px">
                                <h5 class="card-title"><b><?=$duyuru->duyuru_kategori_adi?></b></h5>
                                <p class="card-text">
                                <?=$duyuru->duyuru_aciklama?>
                                </p>
                               </div>
                              <div class="card-footer"  >
                                 
                                <a href="#" class="card-link">Duyuru Tarihi : </a><?=date("d.m.Y",strtotime($duyuru->duyuru_kayit_tarihi))?>
                                <a href="#" class="card-link">Geçerlilik Tarihi :</a> </a><?=date("d.m.Y",strtotime($duyuru->duyuru_bitis_tarihi))?>
                              </div>
                            </div>
                          </div>
                          <?php
                      }
                    ?>

                  </div>    
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
  </div>
</div>













          </section>
          <!-- right col -->







          <section class="col-lg-<?=goruntuleme_kontrol("yemek_listesi_goruntule") ? "8" : "12"?> connectedSortable pl-0">



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
    width: calc(100% / 5 - 10px);
    background: #fff;
    border-radius: 5px;    border: 1px solid #073773;
    padding: 10px 5px;
    margin:5px;
    box-shadow: 0 5px 5px rgba(0, 0, 0, 0.05);
    transition: all 0.4s ease;
}@media (max-width: 768px) { /* Tabletler için */
  .card2 {
    width: calc(100% / 3 - 10px); /* 3 sütun */
  }
}

@media (max-width: 480px) { /* Telefonlar için */
  .card2 {
    width: calc(100% / 3 - 10px); /* 3 sütun */
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
            <div class="media-icons text-primary" style="background: #ebebeb; color: black !important; border-radius: 5px; padding: 5px 5px;">
          <i class="fa fa-phone"></i> <?=$kullanici->kullanici_bireysel_iletisim_no?>
            </div>  
        </div>
      </div>
  
    <?php endforeach; ?>
</div>

   



             

             
          </section> 
          <?php  if(goruntuleme_kontrol("yemek_listesi_goruntule")) : ?>
          <section class="col-lg-4 pl-0 text-center pr-2" style="    padding-right: 1.0rem !important;">
      
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
      <br>
      <span style="color: white; font-size: 16px;">
        <b>Tarih:</b> <?=date("d.m.Y")?> 
        <b style="margin-left: 10px;">Yemek Saati:</b> 12:00
      </span>
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
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->