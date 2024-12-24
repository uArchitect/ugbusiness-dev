 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:8px">
 









<section class="content">

      <!-- Default box -->
      <div class="card card-dark">
      <div class="card-header">
                <h3 class="card-title"><strong>UG Business</strong> - Kullanıcılar</h3>
                   </div>
        <div class="card-body pb-0">
          <div class="row">
            
          
          
          <?php $count=0; foreach ($kullanicilar as $kullanici) : ?>
                      <?php $count++?>
          
          
          
          
          
          
          
          <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
            <?php
            $ur = base_url("kullanici/kullanici_profil/$kullanici->kullanici_id");
            ?>
              <div class="card d-flex flex-fill" style="border-radius:0;">
                <div class="card-header text-muted border-bottom-0">
                  
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                  <div class="col-4 text-center">
                      <img  onclick="location.href='<?=$ur?>';" src="<?=base_url("uploads/$kullanici->kullanici_resim")?>" style="cursor:pointer;object-fit:cover;max-width:110px;max-height:110px;min-width:110px;min-height:110px;border: 5px solid #272829c7;outline: 5px solid #393c3721;" alt="user-avatar" class="img-circle img-fluid">
                    </div>
                    <div class="col-8">
                      <form id="myform<?=$kullanici->kullanici_id?>" action="https://ugbusiness.com.tr/talep/yonlendirmeler" method="post">
                        <input type="hidden" name="yonlenen_kullanici_id" value="<?=$kullanici->kullanici_id?>">
                        <a style="cursor:pointer;font-size:22px;<?=$kullanici->kullanici_aktif == 0 ? "color:red!important;" : ""?>" href="<?=base_url("kullanici/kullanici_profil/$kullanici->kullanici_id")?>"  ><b><?=$kullanici->kullanici_ad_soyad?></b></a>
                      </form>
                     
                     
                      <p class="text-muted text-sm" style="margin-top:-5px"><i class="fas fa-info-circle" style="opacity:0.5"></i>
                       <?=$kullanici->kullanici_unvan ? $kullanici->kullanici_unvan : ""?>
                    </p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class=" mb-1"><span class="fa-li"><i class="fas fa-phone text-success"></i></span> <b>Toplam Görüşme:</b> <?=$kullanici->toplam_yonlendirme_sayisi ?? "<span style='opacity:0.5'>Email Adresi Belirtilmedi</span>"?></li>
                        <li class=" mb-1"><span class="fa-li"><i class="fas fa-user-plus text-primary"></i></span> <b>Talep Sayısı (Bireysel) :</b>  <?php echo $kullanici->kendi_girdigi_talep_sayisi != "" ? $kullanici->kendi_girdigi_talep_sayisi : "<span style='opacity:0.5'>İletişim No Belirtilmedi</span>"?></li>
                        <li class=" mb-1"><span class="fa-li"><i class="fas fa-people-arrows text-warning"></i></span><b>Talep Sayısı (Yönlendirme) :</b>  <?php echo $kullanici->toplam_yonlendirme_sayisi - $kullanici->kendi_girdigi_talep_sayisi;  ?></li>
                     
                        <li class=" mb-1"><span class="fa-li"><i class="fas fa-check text-success"></i></span><b>Toplam Satış :</b> <?php echo get_siparis_sayisi_pesin($kullanici->kullanici_id)+get_siparis_sayisi_vadeli($kullanici->kullanici_id); ?> </li>
                      
                        <li class=" mb-1"><span class="fa-li"> &nbsp;&nbsp;</span><b>Peşin :</b> <?php echo get_siparis_sayisi_pesin($kullanici->kullanici_id); ?>  / <b> Vadeli :</b> <?php echo get_siparis_sayisi_vadeli($kullanici->kullanici_id); ?> </li>
                        <li class=" mb-1"><span class="fa-li"><i class="fas fa-check text-success"></i></span> </li>
                     
                        <li class=" mb-1"><span class="fa-li"><i class="fas fa-chart-line text-danger"></i></span><b>Satış/Talep Başarı Oranı :</b> <?php echo $kullanici->basari_yuzdesi; ?></li>
                        <li class=""><span class="fa-li"><i class="fa  fa-clock text-purple"></i></span><b>Ort. Dönüş :</b>  <?php echo $kullanici->ortalama_donus_suresi; ?></li>
                      
                      </ul>
                    </div>
                  
                  </div>
                </div>
                <div class="card-footer">
                 
                </div>
              </div>
            </div>





            <?php  endforeach; ?>
            
          </div>
        </div>
        <!-- /.card-body -->
    
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->











 
            </div>


          