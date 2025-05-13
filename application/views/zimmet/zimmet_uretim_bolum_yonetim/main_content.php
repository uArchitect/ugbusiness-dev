 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
 
<section class="content text-md">
 <div class="row">
  



<?php 
foreach ($bolumler as $bolum) :
?>
  <div class="col">
    <div class="card card-dark" style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong><?=$bolum->zimmet_alt_bolum_adi?></strong> </h3>
               
              </div>
              <!-- /.card-header -->
              <div class="card-body">



<ul class="products-list product-list-in-card pl-2 pr-2">

                  <?php 
                    $kullanicilar = get_uretime_tanimli_kullanicilar($bolum->zimmet_alt_bolum_id);
                    ?>
                    <?php foreach ($kullanicilar as $kullanici) : ?>

                  <li class="item">
                    <div class="product-img">

                      <?php
                          if($kullanici->kullanici_resim != ""){
                                ?>
                                   <img class="img-size-80" style="width: auto; height: 68px; margin-right: 5px;" src="<?=base_url("uploads/$kullanici->kullanici_resim")?>"> 
                                <?php
                          }else{
                            ?>
                                 <img class="img-size-50" style="width: auto; height: 68px; margin-right: 5px;" src="<?=base_url("uploads/user-default.jpg")?>"> 
                              
                            <?php
                          }
                        ?>


                      
                    </div>
                    <div class="product-info" style="margin-top:-5px">
                      <a href="javascript:void(0)" class="product-title"><?=$kullanici->kullanici_ad_soyad?>
                       
                      </a>

                        
                      <span class="product-description">
                      <?=$kullanici->kullanici_unvan?>
                      </span>

<span class="product-description mt-2">
                      <span class="badge badge-danger float-left mr-1"><i class="fa fa-times"></i> Listeden Kaldır </span>
                      
                        <span class="badge badge-success float-left"><i class="fa fa-check"></i> Sorumlu</span>
                      
                      </span>

                      
                    </div>
                  </li><?php endforeach; ?>
                  <!-- /.item -->
                   
                </ul>
 
              </div>

              <div class="card-footer">
                 <form action="<?=base_url("zimmet/bolum_kullanici_tanimla/$bolum->zimmet_alt_bolum_id")?>" method="post">

            <div class="input-group input-group-sm">
                  <select  name="kullanici_no" class="select2 form-control  " style="margin-bottom:10px!important" required>

                    <option value="">Kullanıcı Seçiniz</option>

                      <?php 
                      foreach ($listkullanicilar as $s) {
                        if($s->zimmet_departman_kullanici_tanim_departman_no != $secilen_departman){
                          continue;
                        }
                       ?>
                       <option value="<?= $s->kullanici_id?>"><?=$s->kullanici_ad_soyad?></option>
                       <?php
                      }
                      ?>
                    </select>
                  <span class="input-group-append">
                    <button type="submit" class="btn btn-success btn-flat">Ekle</button>
                  </span>
                </div>

             
                    </form>
              </div>
              <!-- /.card-body -->
            </div>
  </div>
 
<?php 
endforeach;
?>
 </div>
</section>
            </div>