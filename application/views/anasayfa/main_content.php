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
<img style="    object-fit: cover;width:65px;height:65px" class="img-circle elevation-2" src="<?=aktif_kullanici()->kullanici_resim ? base_url("uploads/$aktif_kullanici->kullanici_resim") : base_url("uploads/default.png")?>" alt="User Avatar">
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







          <section class="col-lg-12 connectedSortable pl-0">




  <!-- Custom tabs (Charts with tabs)-->
  <div class="card card-dark " style="border-radius:0px">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fa fa-phone mr-1"></i>
                  Telefon Rehberi
                </h3>
               
              </div><!-- /.card-header -->
              <div class="card-body p-0">
                
              <div class="row">
               
                <div class="col">
                  


                <div class="card-body  table-responsive p-0 pt-4">
                <table id="examplekullanicilar" class="table table-bordered table-striped"    >
                  <thead>
                  <tr>
               
                    <th>Ad Soyad</th>
                    <th >Ünvan</th>
                    <th style="width: 130px;">Departman</th>
                    <th>İletişim Numarası</th>
                    <th>Email Adresi</th>
            
                  </tr>
                  </thead>
                  <tbody>
                    <?php $count=0; foreach ($kullanicilar as $kullanici) : ?>
                      <?php $count++?>
                    <tr>
                  
                      <td>
                        <?php
                          if($kullanici->kullanici_resim != ""){
                                ?>
                                   <img style="width:20px;border-radius:50%; height:20px;object-fit:cover" src="<?=base_url("uploads/$kullanici->kullanici_resim")?>"> 
                                <?php
                          }else{
                            ?>
                                 <img style="width:20px;border-radius:50%; height:20px;object-fit:cover" src="<?=base_url("uploads/user-default.jpg")?>"> 
                              
                            <?php
                          }
                        ?>
                      
                      
                      
                      <b><a style="color:black" href="<?=site_url("kullanici/duzenle/$kullanici->kullanici_id")?>"><?=mb_strtoupper(str_replace("i","İ",$kullanici->kullanici_ad_soyad))?></a></b>
                    </td>
                    <td>
                    <?=$kullanici->kullanici_unvan?> 
                    </td>
                    <td><i class="fa fa-building" style="margin-right:5px;opacity:0.8"></i> <?=$kullanici->departman_adi?></td>
                      
                      <td><i class="fa fa-phone" style="margin-right:5px;opacity:0.8"></i> <?=$kullanici->kullanici_bireysel_iletisim_no?></td>
                      <td><i class="fa fa-envelope" style="margin-right:5px;opacity:0.8"></i> <?=$kullanici->kullanici_email_adresi?></td>
                     
                     
                       
                    </tr>
                  <?php  endforeach; ?>
                  </tbody>
 
                </table>
      </div>
      <!-- /.card-body -->        





                </div>

              </div>
               



              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->



             

             
          </section>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->