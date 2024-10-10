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
      <div class="container-fluid pr-0">
         
        <!-- Main row -->
        <div class="row">
















        

        <div class="col-12" style="padding: 0;">
        <div class="card card-widget widget-user-2" style="    margin-bottom: 5px;">

<div class="widget-user-header bg-dark" style="background:#181818 !important;">
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
   .card2 {
    width: calc(100% / 5 - 10px);
    background: #fff;
    border-radius: 5px;
    padding: 10px;margin:5px;
    box-shadow: 0 5px 5px rgba(0, 0, 0, 0.05);
    transition: all 0.4s ease;
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
        <img style="width:40px;height:40px;border-radius:50%; object-fit:cover" src="<?=base_url("uploads/$kullanici->kullanici_resim")?>"> 
                                
        </div>
        <div class="details">
          <div class="name text-bold"><?=$kullanici->kullanici_ad_soyad?></div>
            <div class="job"><?=$kullanici->kullanici_unvan?></div>
            </div>
            <div class="media-icons text-primary">
          <i class="fa fa-phone"></i> <?=$kullanici->kullanici_bireysel_iletisim_no?>
            </div>  
        </div>
      </div>
  
    <?php endforeach; ?>
</div>

   



             

             
          </section> 
          <?php  if(goruntuleme_kontrol("yemek_listesi_goruntule")) : ?>
          <section class="col-lg-4 pl-0">
          <div class="col <?=($yemek->yemek_detay=="")?"d-none":""?>" style="text-align:left !important;border: 1px solid #d9d7d7;margin-right: 5px;margin-left: 5px;;padding: 5px;border-radius: 0px;">

<div style="padding:10px;padding-top:5px;height:100%;width:100%;border-radius:0px;background-size:cover; background-image: url('<?=base_url("assets/dist/img/menuarkaplan.png")?>')">
<?php

$guncelTarih = getdate();
$gunSayisi = date('t', mktime(0, 0, 0, $guncelTarih['mon'], 1, $guncelTarih['year']));

?>
<a href="" style="color:white;text-align:left !important" class="h4"><b style="text-align:left" >Öğle Yemek Menüsü</b> </a>

<br><span style="color:white;font-size:15px;"><b>Tarih :</b> <?=date("d.m.Y")?> <b style="margin-left:5px">Yemek Saati :</b> 12:00</span>
<br>  <br>  <br>
<a href="" style="color:white;text-align:center !important;    display: block;font-weight:normal !important;" class="h4">
                 <?=preg_replace('/#/', "<br>", $yemek->yemek_detay);?>
</a>


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