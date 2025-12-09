<style>
    @keyframes blink {
        0% { opacity: 1; }
        50% { opacity: 0; }
        100% { opacity: 1; }
    }
    rect {
        fill: yellow;
    }
    .blinking {
        animation: blink 1s infinite;
        background-color: yellow;
    }

    

<?php $this->load->view('talep/includes/styles'); ?>

</style> 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper content-wrapper-siparis" style="padding-top:10px;background:#e7e7e7;">
  <section class="content pr-0">
    <div class="row">
      <div class="col-12">
        <div class="card card-siparis">
          <!-- Card Header -->
          <div class="card-header card-header-siparis">
            <div class="d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3 card-header-icon-wrapper">
                  <i class="fas fa-route card-header-icon"></i>
                </div>
                <div>
                  <h3 class="mb-0 card-header-title">
                    Rut Planları Restore
                  </h3>
                  <small class="card-header-subtitle">Rut yönetim modülleri</small>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Modern Tab Navigation Bar -->
          <?php $this->load->view('talep/includes/tabs'); ?>
          
          <!-- Card Body -->
          <div class="card-body card-body-siparis">
            <div class="card-body-content">
              <div class="row">
                <div class="col col-md-12">
                  <div class="card">
                    <div class="card-header" style="background: #3aff4c52; color: black;">
                      <i class="fas fa-route"></i> Tüm Rut Planlamaları
                    </div>
                    <div class="card-body">

    <?php 
    foreach ($rut_tanimlari as $rut) {
      ?>
       <div class="card card-dark card-outline mb-2">
                <div class="card-header" style="">
                  <h5 class="card-title" style="font-size: large;"><b><?=$rut->kullanici_ad_soyad?></b> / <?=$rut->sehir_adi?>
                  <br>
                <span style="font-size:13px">
                   <i class="far fa-calendar-alt"></i> <b>Başlangıç</b> : <?=date("d.m.Y",strtotime($rut->rut_baslangic_tarihi))?>               
                    <span>
                   <i class="far fa-calendar-alt ml-2"></i> <b>Bitiş</b> : <?=date("d.m.Y",strtotime($rut->rut_bitis_tarihi))?> 
                  </span>


                </span>
                <br>
                  <span style="font-size:13px">
                   <i class="fas fa-car"></i> <b>Araç</b> : <?=($rut->arac_plaka) ? $rut->arac_plaka : "ARAÇ TANIMLANMADI"?>         
                       
                  </span>
                  <br>
                  <span style="font-size:13px">
                   <i class="fas fa-info-circle"></i> <b>Rut Durum</b> : 
                   
                   <?php 

 
$rut_baslangic_tarihi = strtotime($rut->rut_baslangic_tarihi);   
$rut_bitis_tarihi = strtotime($rut->rut_bitis_tarihi);  
$simdi = strtotime(date("Y-m-d 00:00"));  

 
if ($simdi < $rut_baslangic_tarihi) {
  echo "<span class='text-orange'>Başlamadı</span>";
   
} 

if ($simdi >= $rut_baslangic_tarihi && $simdi <= $rut_bitis_tarihi) {
  echo "<span class='text-success'>Devam Ediyor</span>";
  
   
}  
if ($simdi > $rut_bitis_tarihi) {
  echo "<span class='text-danger'>Tamamlandı</span>";
  

} 

?> <br>

<br>


<?php if($rut->arac_plaka) :?>


<span style="font-size:13px">
                   <i class="fas fa-tachometer-alt text-success"></i> <b>Rut Başlangıç Araç KM  </b> : <?=$rut->rut_satisci_baslatma_km?>               
                    <span>
                   <i class="fas fa-tachometer-alt text-danger ml-2"></i> <b>Rut Bitiş Araç KM </b> : <?=$rut->rut_satisci_bitis_km?> 
                  </span><br>
<br>


                  <div class="form-group col pl-0 <?=($rut->rut_satisci_baslatma_km == 0) ? "":"d-none"?>">
        <label for="formClient-Name"> Rut Başlangıç Araç Km Bilgisi</label>
        <form action="<?=base_url("arac/arac_rut_km_kaydet/".$rut->rut_tanim_id."/0")?>" method="POST">
         <div class="input-group input-group-sm">
         
<input type="number" min="1" name="arac_km_deger" class="form-control">
<span class="input-group-append">
<button type="submit" class="btn btn-success btn-flat">Kaydet</button>
</span>
 

</div></form>
      </div>
      <br>




      <div class="form-group col pl-0 <?=($rut->rut_satisci_baslatma_km > 0 && $rut->rut_satisci_bitis_km == 0) ? "":"d-none"?>">
        <label for="formClient-Name"> Rut Bitiş Araç Km Bilgisi</label>
        <form action="<?=base_url("arac/arac_rut_km_kaydet/".$rut->rut_tanim_id."/1")?>" method="POST">   <div class="input-group input-group-sm">
       
<input type="number" min="1" name="arac_km_deger" class="form-control">
<span class="input-group-append">
<button type="submit" class="btn btn-success btn-flat">Kaydet</button>
</span>

</div></form>      </div>

 
                  </span>
              </h5>
              <?php endif;?>
              
              
              <?php if(!$rut->arac_plaka) :?>
                <div style="background: #fff4f4;padding: 10px;color: #d10000;margin-top: 0px;margin-bottom: 5px;border: 2px solid #ff00007d;border-radius: 5px;">
     <span><i class="fas fa-exclamation-circle" style="
    margin-right: 4px;
    color: #f50000;
"></i>Satış temsilcisi için araç tanımlanmadığından dolayı km güncelleme formu gösterilmiyor.</span>
 </div>

                <?php endif;?>
            
<br>






                </div>
              </div>

      <?php
    }
    
    ?>

   


    </div>
    <div class="card-footer">
    <span class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
         Toplam <?=($rut_tanimlari) ? count($rut_tanimlari) : "0"?> adet rut planlaması listelenmiştir.
                  </span>
    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
       