 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
 
<section class="content text-md">
 <div class="row">
 <div class="col col-md-3">
  
 <div class="card card-warning" style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong> <?=$veri->sablon_veri_adi?></strong> (<?=$kategori->sablon_kategori_adi?>)</h3>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                          <?=$veri->sablon_veri_detay?>
              </div>
              <!-- /.card-body -->
            </div>
</div>
  <div class="col col-md-5">
    <div class="card card-dark" style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong>Kullanıcı Ataması Yap</strong> </h3>
               
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table id="examplekullanicilar" class="table table-bordered table-striped"    >
                  <thead>
                  <tr>
               
                    <th>Ad Soyad</th>  
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
                      
                      
                      
                      <b><a style="color:black" href="<?=site_url("kullanici/duzenle/$kullanici->kullanici_id")?>"><?=$kullanici->kullanici_ad_soyad?></a></b> - <?=$kullanici->kullanici_unvan?> 
                    </td>
                     
                       
                       
                    
                       
                    </tr>
                  <?php  endforeach; ?>
                  </tbody>
 
                </table>
              </div>
              <!-- /.card-body -->
            </div>
  </div>

  <div class="col col-md-4">



    <div class="card card-success" style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong>Kuralı Görüntüleyecek Kullanıcılar</strong> </h3>
                 
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table id="examplekullanicilar2" class="table table-bordered table-striped"    >
                  <thead>
                  <tr>
               
                    <th>Ad Soyad</th>  
                   </tr>
                  </thead>
                  <tbody>
                    <?php $count=0; foreach ($tanimlar as $kullanici) : ?>
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
                      
                      
                      
                      <b><a style="color:black" href="<?=site_url("kullanici/duzenle/$kullanici->kullanici_id")?>"><?=$kullanici->kullanici_ad_soyad?></a></b> - <?=$kullanici->kullanici_unvan?> 
                    </td>
                     
                       
                       
                    
                       
                    </tr>
                  <?php  endforeach; ?>
                  </tbody>
 
                </table>
              </div>
              <!-- /.card-body -->
            </div>
  </div>
 </div>
</section>
            </div>