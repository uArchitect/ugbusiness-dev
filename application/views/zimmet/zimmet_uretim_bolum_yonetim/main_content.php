 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
 
<section class="content text-md">
 
 <div class="row">
   


 <div id="accordion">

               <?php 
                      foreach ($kullanicilar as $s) {
                        
                       ?>
                       


  <div class="card">
    <div class="card-header p-2" id="headingOne">
      <h5 class="mb-0 p-0">
        <button class="btn btn-link p-0" data-toggle="collapse" data-target="#collapse<?= $s->zimmet_alt_bolum_id ?>" aria-expanded="true" aria-controls="collapseOne">
          <?=$s->zimmet_alt_bolum_adi?>
        </button>
      </h5>
    </div>

    <div id="collapse<?= $s->zimmet_alt_bolum_id ?>" class="collapse <?=(!isset($_GET["act"]) && $_GET["act"] == $s->zimmet_alt_bolum_id)?"show":""?>" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
       
    
    <table     class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Stok Adı</th>
                      <th>Bölüm Adı</th>
                      
                      



                      <th>Tanımlanan Miktar</th>
                      <th>İşlem Tarihi</th> 
                      <th>İşlem</th> 

                      
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    foreach ($kullanicihareketlerdetay as $h) {
                      if($h->zimmet_departman_no != $secilen_departman || $h->zimmet_hareket_cikis_miktar == 0){
                        continue;
                      }
                      if($h->zimmet_hareket_alt_bolum_no != $s->zimmet_alt_bolum_id ){
                        continue;
                      }
                     
                     ?>
                     <tr style="<?=$flag1?"background:#caffca":""?>">
                      <td> </td>
                      <td style="    padding-top: 9px !important;"><?=$h->zimmet_stok_adi?> </td>
                      <td style="    padding-top: 9px !important;"> <?=$h->zimmet_alt_bolum_adi?> </td>
                       
                      <td style="    padding-top: 9px !important;"><?=$h->zimmet_hareket_cikis_miktar?>
                     
                      <td style="    padding-top: 9px !important;"><?=date("d.m.Y H:i",strtotime($h->zimmet_hareket_tarihi))?></td>
                      <td>
                    
                      <div class="btn-group">
                        <a href="<?=base_url("zimmet/uretimdagitim/$secilen_departman/$h->zimmet_hareket_id")?>" type="button" class="btn btn-default btn-sm">
                        <i class="fa fa-pen"></i>
                        </a>
                        <button onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu hareketi silmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Onayla','<?=base_url('zimmet/hareket_sil/').$h->zimmet_hareket_id?>');" type="button" class="btn btn-default btn-sm">
                        <i class="fa fa-trash"></i>
                        </button> 
                      </div>

                      </td>
                       
                    </tr>
                     <?php
                    }
                    ?>
                     
                  </tbody>
                </table>
    
    
    </div>
    </div>
  </div>

    <?php
                      }
                      ?>

  
   
</div>


</div>

</section>
</div>