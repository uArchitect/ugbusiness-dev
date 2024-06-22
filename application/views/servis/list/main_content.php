 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
<div class="row">
  <div class="col-lg-3 col-6">
    <div class="small-box bg-dark">
      <div class="inner">
        <h3>
         <?php echo count($servisler); ?>
        </h3>
        <p>Toplam Servis Kayıtları</p>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
      <a href="<?=base_url("servis")?>" class="small-box-footer">Tümünü Görüntüle <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <div class="col-lg-3 col-6">
    <div class="small-box bg-warning">
      <div class="inner">
        <h3>
        <?php 
          $servis_durumu_1_kayitlar = array_filter($servisler, function($servis) {
            return $servis->servis_durum_tanim_id == 1;
          });
          echo count($servis_durumu_1_kayitlar);
          ?>
        </h3>
        <p>Devam Eden Servis Kayıtları</p>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
      <a href="<?=base_url("servis")."?page=1"?>" class="small-box-footer">Tümünü Görüntüle <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>

  <div class="col-lg-3 col-6">
    <div class="small-box bg-success">
      <div class="inner">
        <h3>
        <?php 
          $servis_durumu_1_kayitlar = array_filter($servisler, function($servis) {
            return $servis->servis_durum_tanim_id == 2;
          });
          echo count($servis_durumu_1_kayitlar);
          ?>
        </h3>
        <p>Tamamlanan Servis Kayıtları</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
      <a href="<?=base_url("servis")."?page=2"?>" class="small-box-footer">Tümünü Görüntüle <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>

  <div class="col-lg-3 col-6">
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>
        <?php 
          $servis_durumu_1_kayitlar = array_filter($servisler, function($servis) {
            return $servis->servis_durum_tanim_id == 3;
          });
          echo count($servis_durumu_1_kayitlar);
          ?>
        </h3>
        <p>İptal Servis Kayıtları</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
      <a href="<?=base_url("servis")."?page=3"?>" class="small-box-footer">Tümünü Görüntüle <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>









</div>


<section class="content text-md">
<div class="card card-dark">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - Servis Kayıtları</h3>
                <a href="<?=base_url("servis/servis_cihaz_sorgula_view")?>" type="button" class="btn btn-success btn-sm" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Servis Kaydı Oluştur</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1servisler" class="table text-xs table-bordered table-striped nowrap">
                  <thead>
                  <tr>
                    <th style="">#</th>
                    <th style="width: 42px;">Servis Kodu</th>
                    <th style="max-width: 100px; width: 100px; min-width: 100px;">Servis Kayıt Tarihi</th>
                    <th style="max-width: 100px; width: 100px; min-width: 100px;">Kapanma Tarihi</th>
                   
                    <th>Müşteri Bilgileri</th>
                    <th style="max-width: 100px; width: 100px; min-width: 100px;">Seri Numarası</th>
                    <th style="max-width: 80px; width: 80px; min-width: 80px;">Cihaz</th>
                    <th style="max-width: 90px; width: 90px; min-width: 90px;">İletişim No</th>
                   
                    <th style="width: 100px;">İşlem</th> 
                  </tr>
                  </thead>
                  <tbody>
                 
                    <?php  foreach ($servisler as $servis) : ?>
                  


                      <?php 
                          if(!empty($_GET["page"])){
                            if($_GET["page"] != $servis->servis_durum_tanim_id){
                              continue;
                            }
                          }
                        ?>
                    <tr style="<?=($servis->servis_durum_tanim_id == 3) ? "background:#ff00001c;":""?>">
                    <td style="padding-top: 0px !important;padding-bottom: 0px !important;"> 
                      <?php 
                      if($servis->servis_durum_tanim_id == 1){
                        ?>
                     

                        <div >
                          <svg aria-label="currently running: " width="17px" height="17px" fill="none" viewBox="0 0 16 16" class="anim-rotate" xmlns="http://www.w3.org/2000/svg">
                              <path fill="none" stroke="#DBAB0A" stroke-width="2" d="M3.05 3.05a7 7 0 1 1 9.9 9.9 7 7 0 0 1-9.9-9.9Z" opacity=".5"></path>
                              <path fill="#eda705" fill-rule="evenodd" d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Z" clip-rule="evenodd"></path>
                              <path fill="#eda705" d="M14 8a6 6 0 0 0-6-6V0a8 8 0 0 1 8 8h-2Z"></path>
                          </svg>
                    
                        </div>


                        <?php
                      }else if(($servis->servis_durum_tanim_id == 2)){
                        ?>
                          <span><i class="fas fa-check-circle text-green pt-2 pb-2" style="    font-size: 16px;"></i></span>
                        
                        <?php
                      }else{
                        ?>
                           <span><i class="fas fa-ban text-danger pt-2 pb-2" style="    font-size: 16px;"></i> </span>
                      
                        <?php
                      }
                      ?>
                    
                    </td>
                      <td><a style="   color:#000000;" class="custom-href" href="<?=base_url("servis/servis_detay/".$servis->servis_id)?>"><b><?=$servis->servis_kod?></b></a></td>
                     
                      <td style="color:green;"><?=date("d.m.Y H:i",strtotime($servis->servis_kayit_tarihi))?></td>
                      <td style="color:#cf0706;">
                        
                      <?php 
                      if(($servis->servis_durum_tanim_id == 2)){
                        ?>
                       <?=date("d.m.Y H:i",strtotime($servis->servis_durum_guncelleme_tarihi))?>
                      <?php
                      }else if(($servis->servis_durum_tanim_id == 1)){
                        echo "<span style='opacity:0.5;color:green;'>Devam Ediyor...</span>";
                      }
                        ?>


                     
                    
                    
                    
                    
                    
                    
                    </td>
                      
                      <td>
                      <?php 
if($servis->cihaz_borc_uyarisi == 1){
  ?>
  <a style="padding-top:3px;font-size: 12px!important;color:white!important;" class="btn btn-danger yanipsonenyazifast btn-xs">Borç Uyarısı</a>
  <?php
}
?>  
                      
                      <?="<a  class='custom-href' target='_blank' style='color:#00346d;' href='".base_url("musteri/profil/".$servis->musteri_id)."'><b>".$servis->musteri_ad."</b></a> / ".$servis->merkez_adi." / ".$servis->sehir_adi." (".$servis->ilce_adi.")"?></td>
                      <td><?=$servis->seri_numarasi?></td>
                      <td><?=$servis->urun_adi?></td>
                      <td><b><?=$servis->musteri_iletisim_numarasi?></b></td>
                      
                      <td>
                    
                      <?php 
                      if(($servis->servis_durum_tanim_id == 3)){
                        ?>
                        <span class="text-danger">İptal Edildi (<?=date("d.m.Y H:i",strtotime($servis->servis_durum_guncelleme_tarihi))?>)</span>
                        <?php
                      }else{
                        ?>
                        
                       <?php 
                        if(($servis->servis_durum_tanim_id == 1)){
?>
 <a type="button" onclick="confirm_action('İptal İşlemini Onayla','Seçilen bu kaydı iptal etmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Onayla','<?=base_url('servis/servis_iptal_et/'.$servis->servis_id)?>');" class="btn btn-danger btn-xs" ><i class="fas fa-times-circle"></i> İptal</a>                 
                      
<?php
                        }else{
                          ?>
                     
<?php
                        }
                       ?>
                       
                      <?php
                      }
                      ?>

                         
                        </td>
                       
                    </tr>
                  <?php  endforeach; ?>
                  </tbody>
                 
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
</section>
            </div>

            <style>
              
.yanipsonenyazifast {
      animation: blinker2 0.4s linear infinite;
   
      }
      @keyframes blinker2 {  
      50% { opacity: 0; }
      }


.yanipsonenyazi {
      animation: blinker 1.3s linear infinite;
      color: #1c87c9;
    
      font-weight: bold;
      font-family: sans-serif;
      }
      @keyframes blinker {  
      50% { opacity: 0; }
      }

      .custom-href:hover {
        text-decoration: underline;
      }

     
    .anim-rotate {
        animation: rotate 1s linear infinite;
    }

    @keyframes rotate {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }
</style>
