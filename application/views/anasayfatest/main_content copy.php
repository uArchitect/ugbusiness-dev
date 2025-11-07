<style>
      
        .mobil-genislik {
          margin-left: 235px; 
        }
 
        @media only screen and (max-width: 600px) {
            .mobil-genislik {
              margin-left: -10px; 
            }
        }
    </style>

 
<div class="content-wrapper p-1 pr-2 mobil-genislik" style="padding-top:15px">
 
 
    <section class="content pr-0">
      <div class="container-fluid pr-0">
          
        <div class="row"> 
          <section class="col-lg-6 connectedSortable pl-0">






          <div class="card pb-0 mb-1">
           
            
              <div class="card-body p-0">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                  
                  </ol>
                  <div class="carousel-inner">
                    <?php
                      $count=0;
                      foreach ($bannerlar as $banner) {
                        $count++;
                        ?>
                             <div class="carousel-item <?=($count==1)?"active":""?>">
                              <img class="d-block w-100" src="<?=base_url("uploads/$banner->banner_dosya")?>">
                            </div>
                        <?php
                      }
                    ?>
                 
                   
                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-custom-icon" aria-hidden="true">
                      <i class="fas fa-chevron-left"></i>
                    </span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-custom-icon" aria-hidden="true">
                      <i class="fas fa-chevron-right"></i>
                    </span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
              </div>
            
            </div>
            








            
<div class="row">
  <div class="col p-0 pr-1"> 
 <div class="card card-dark mb-2">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fa fa-bell mr-1"></i>
                  Duyurular
                </h3>
                <a href="<?=base_url("demirbas/ekle/1")?>" type="button" class="btn btn-dark " style="background:#080808;float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-list" style="font-size:12px" aria-hidden="true"></i> Tüm Duyuruları Görüntüle</a>
            
              </div> 
              





 
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
                                <a href="#" class="card-link">Geçerlilik Tarihi :</a> </a><?=date("d.m.Y",strtotime($duyuru->duyuru_kayit_tarihi))?>
                              </div>
                            </div>
                          </div>
                          <?php
                      }
                    ?>






                     






                  
                  </div>
                  
                </div>
              </div> 





            </div>
            
  </div>







  
</div>

           

 
  <div class="card card-dark" style="border-radius:0px">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fa fa-phone mr-1"></i>
                  Telefon Rehberi
                </h3>
               
              </div> 
              <div class="card-body p-0">
                
              <div class="row">
                <div class="col-md-3 ml-0 pl-0">
                <div class="card card-primar m-0">
                  
                 
                    <div class="card-body p-1 pl-2 pr-2">
                      <div class="form-group">
                      <label for="exampleInputFile">Rehber Kayıt Bul</label>
                        <input type="text" class="form-control" id="formAdSoyad" placeholder="Ad Soyad">
                      </div>
                      <div class="form-group">
                   
                        <input type="text" class="form-control" id="formTelefonNumarasi" placeholder="İletişim Numarası">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputFile">Departman</label>
                        <select name="formDepartman" id="formDepartman" class="select2 form-control rounded-0" style="width: 100%;">
                          <?php foreach($departmanlar as $departman) : ?> 
                                      <option  value="<?=$departman->departman_id?>"><?=$departman->departman_adi?></option>
                        
                            <?php endforeach; ?>  
                       </select>
                      </div>
                    </div>
                    <div class="card-footer">
                      <button type="text" id="buttonRehberAra" onclick="showAlert()" class="btn btn-primary">Sonuçları Filtrele</button>
                    </div>
                
                </div>
                </div>
                <div class="col">
                  


                <div class="card-body  table-responsive p-0 pt-4">
      <table id="examplecontactss" class="table table-bordered mt-2 table-striped text-sm">
      <thead>
        <tr>
            <th style="padding: 5px;">Kullanıcı Ad Soyad</th>
            <th style="padding: 5px;">Departman</th>
            <th style="padding: 5px;">Kullanıcı Bireysel İletişim No</th>
             
        </tr>
    </thead>
    <tbody>
         
    </tbody>
                   
                </table>
      </div>
      




                </div>

              </div>
               



              </div> 
            </div>
             



             

             
          </section>
         
          <section class="col-lg-6 connectedSortable p-0">

            




          <div class="card card-widget widget-user-2" style="    margin-bottom: 5px;">

          <div class="widget-user-header bg-dark" style="background:#181818 !important;">
<div class="widget-user-image">
<img style="    object-fit: cover;width:65px;height:65px" class="img-circle elevation-2" src="<?=aktif_kullanici()->kullanici_resim ? base_url("uploads/$aktif_kullanici->kullanici_resim") : base_url("uploads/default.png")?>" alt="User Avatar">
</div>

<h3 class="widget-user-username"><?=$aktif_kullanici->kullanici_ad_soyad?></h3>
<h5 class="widget-user-desc"><?=$aktif_kullanici->kullanici_unvan?></h5>
</div>
 


<div class="card-footer card-comments">
                <div class="card-comment">
              
                  <div class="comment-text ml-0">
                    <span class="username">
                      Profil Bilgileri 
                    </span> 
                 <i class="fa fa-envelope"></i> Email : <?=$aktif_kullanici->kullanici_email_adresi?>
                 <i class="fa fa-phone ml-3"></i>  Dahili Numarası : <?=$aktif_kullanici->kullanici_dahili_iletisim_no?>
                 <i class="fa fa-building ml-3"></i>  Departman : <?=$aktif_kullanici->departman_adi?>
                 <i class="fa fa-user ml-3"></i>  Sorumlu : <?=$aktif_kullanici_yonetici_adi?>
                  </div>
                
                </div>
                
                 
              </div>

</div>











 
            <div class="card card-default mb-2" style="border-radius:0px">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-ticket-alt mr-1"></i>
                  İstek Bildirim
                </h3>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a class="nav-link" href="#pane0" data-toggle="tab">
                      <i class="fa fa-all nav-icon text-default" style="font-size:13px"></i>    
                      Tümü</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href="#pane1" data-toggle="tab">
                      <i class="fa fa-clock nav-icon text-default" style="font-size:13px"></i>  
                      Onay Bekleyenler
                      
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#pane2" data-toggle="tab">
                      <i class="fa fa-check nav-icon text-default" style="font-size:13px"></i>  
                      Onaylandı</a>
                    </li>
                    
                    <li class="nav-item">
                      <a class="nav-link" href="#pane3" data-toggle="tab">
                      <i class="fa fa-cogs nav-icon text-default" style="font-size:13px"></i>  
                      İşleme Alındı</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#pane4" data-toggle="tab">
                      <i class="fa fa-check-double nav-icon text-default" style="font-size:13px"></i>  
                      Tamamlandı</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#pane5" data-toggle="tab">
                      <i class="fa fa-times nav-icon text-default" style="font-size:13px"></i>  
                      Reddedildi</a>
                    </li>
                  </ul>
                </div>
              </div> 
              <div class="card-body p-1 pr-0" style="min-height:587px;max-height:587px;    overflow-y: scroll;">
                <div class="tab-content p-0">
                  

                  <?php
                    for ($i=0; $i < 6 ; $i++) { 


                    

                      ?>



                    <div class="tab-pane <?=($i==1)?"active":""?>" id="pane<?=$i?>"
                       style="position: relative; height: 300px;">
  
                      <div class="timeline timeline-inverse">
                        
                      <div style="margin-right:0px">


                        <?php foreach ($istekler as $istek) : ?>
                          <?php if($i != 0 && $istek->istek_durum_no != $i){continue;} ?>


                          <?php
                                switch ($istek->istek_durum_no) {
                                  case 1:
                                    $theme = "card-warning";
                                    $text = "text-warning";
                                    $bg="#fcc03517";
                                    $icon="fa-clock";
                                    break;
                                    case 2:
                                      $theme = "card-primary";
                                      $text = "text-primary";
                                       $bg="#007cff12";
                                       $icon="fa-check";
                                      break;
                                      case 3:
                                        $theme = "card-dark";
                                        $text = "text-dark";
                                        $bg="#343a4014";
                                        $icon="fa-cogs";
                                        break;
                                        case 4:
                                          $theme = "card-success";
                                          $text = "text-success";
                                          $bg="#35a74c1a";
                                          $icon="fa-check-double";
                                          break;
                                          case 5:
                                            $theme = "card-danger";
                                            $text = "text-danger";
                                              $bg="#ff002617";
                                              $icon="fa-times";
                                            break;
                                          
                                  default:
                                    
                                    break;
                                }
                          ?>




                          <div class="card  <?= $theme ?> card-outline mb-1" style="background:<?=$bg?>;border-radius:0px">
                           
                          <div class="card-tools" style="margin:20px;position:absolute">
                          <i class="fa <?=$icon?> nav-icon <?=$text?>" style="opacity:0.3;font-size:33px"></i>
                           </div>
                          
                          <div class="card-header">
                            <h5 class="card-title" style="margin-left:50px;font-weight:600">
                              <?=$istek->istek_adi?><br>
                            <span style="font-weight:normal">
                            <span style="opacity:0.7 !important" id="istek-anasayfa"><?=$istek->istek_aciklama?><br></span>
                           
                            <span style="font-weight:normal;opacity:0.4;font-size:14px"><b> <i class="fa fa-calendar-alt"></i> Oluşturma Tarihi :</b> <?=date("d.m.Y H:i:s",strtotime($istek->istek_kayit_tarihi))?></span>
                            <span style="font-weight:normal;opacity:0.4;font-size:14px" class="ml-2"><b> <i class="fa fa-building"></i> Birim :</b> <?=$istek->istek_birim_adi?></span>
                         
                         
                          </span>
                            </h5>

                            <div class="card-tools" style="    text-align: right;">
                           
                            <span class="time  <?= $text ?>"><i class="far fa-clock"></i> <?=$istek->istek_durum_adi?></span><br>
                            <a href="#" class="btn btn-tool btn-link" style="padding-right: 0;">#<?=$istek->istek_kodu?></a>
                            </div>
                            
                            </div>
                          </div>


                         

                          <?php endforeach; ?>






                        </div> 

                      </div>

                   </div>




                      <?php
                    }
                  ?>




                   
                </div>
              </div> 




              <div class="card-footer"  >
                                 
                           
                                <?php
                                $titles= ["Onay Bekleyenler","Onaylananlar","İşleme Alınanlar","Tamamlananlar","Reddedilenler"];
                                $title_colors= ["text-orange","text-primary","text-dark","text-success","text-danger"];
                                $icons= ["text-orange","text-primary","text-dark","text-success","text-danger"];
                                for ($i=1; $i < 6; $i++) { 
                                  $istek_durumu_1_sayisi = count(array_filter($istekler, function($istek) use ($i) {
                                      return $istek->istek_durum_no == $i;
                                  }));
                                  echo ' <a href="#" class="'.$title_colors[$i-1].' card-link">'.$titles[$i-1].' : </a>'.$istek_durumu_1_sayisi;
                                }
                                
                                  
                                    ?>
 
                              </div>


            </div> 
































         
            





            
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->