 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
 
<section class="content text-md">




<?php

if($this->session->userdata('aktif_kullanici_id') == 1){

  
$gunler["gun1"] = ["gun"=>"Pazartesi","data"=>$d1];
$gunler["gun2"] = ["gun"=>"Salı","data"=>$d2];
$gunler["gun3"] = ["gun"=>"Çarşamba","data"=>$d3];
$gunler["gun4"] = ["gun"=>"Perşembe","data"=>$d4];
$gunler["gun5"] = ["gun"=>"Cuma","data"=>$d5];
$gunler["gun6"] = ["gun"=>"Pazartesi","data"=>$d6];

?>
<div class="row">
  
<?php
foreach ($gunler as $g) {
  ?>
<div class="col">
  <div class="card card-primary">
    <div class="card-header">
      <?=$g->gun?>
    </div>
    <div class="card-body">



    <?php 
                    foreach ($g->data as $d) {
                      if(date("Y-m-d",strtotime($d->uretim_tarihi)) != date("Y-m-d",strtotime($d6))){
                        continue;
                      }
                      ?>
 <div class="row">
                       <div class="col mb-2" style="<?=($d->guncelleme_notu != "") ? "border-radius:5px;border:2px solid red;":"border:1px solid gray;border-radius:3px;"?>padding-left: 0px;margin-right: -1px; margin-top: -1px;">
                       <span style="display: block;background:#070db9;  padding: 5px;color: white;border-radius: 5px;border-radius: 3px 3px 0 0;">
                         <span style="min-width: 230px; width: 230px;    margin-left:5px">
                            
                         <div style="
    height: 15px;
    width: 15px;
    background: <?=$d->hex_code?>;
    border-radius: 50%;
    display: inline-block;
    margin-bottom: -2px;
    margin-right: 5px;    border: 2px solid #ffffff;
">
    
</div>
                         <b style="color:white;"><?=$d->urun_adi?> /  <?=($d->renk_adi == "Umex Grisi")?"Gri":$d->renk_adi?></b>
                           </span>
                         </span>
                         <span style="height: 6px;"></span>
                         <div style="padding-left:10px;background:white;border:0px solid;border-top:0px;border-top: 0px; border-radius: 0px 0px 3px 3px;"> <?=$d->baslik_bilgisi?> 
                        
                         <?php 
                         if($d->guncelleme_notu != ""){
                          ?>
                          <span class="text-danger" style="font-size: 12px; font-weight: 400; color: red !important;"><?=$d->guncelleme_notu?></span>
                          <?php
                         }
                         ?>
 <?php 
                         if($d->kayit_notu != ""){
                          ?>
                          <br><span class="text-success" style="font-size: 12px; font-weight: 700;  "><?=$d->kayit_notu?></span>
                          <?php
                         }
                         ?>


                        
                        </div>
                       </div>
                       </div>
                      <?php
                    }
                    ?>



    </div>
  </div>
</div>

  <?php
}
?>

</div>
<?php
}

?>









<div class="card card-dark" style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - Parametreler - Üretim Planlama</h3>
                <a href="<?=base_url("uretim_planlama/add")?>" type="button" class="btn btn-primary btn-sm" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Kayıt Ekle</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="width: 42px;">ID</th> 
                    <th>Cihaz Adı</th>
                    <th>Renk</th>
                    <th >Başlık</th>
                    <th style="width: 130px;">Üretim Tarihi</th>
                    <th >Onay</th>
                    <th style="width: 250px;">İşlem</th> 
                  </tr>
                  </thead>
                  <tbody>
                    <?php $count=0; foreach ($uretim_planlar as $uplanv) : ?>
                      <?php $count++?>
                    <tr>
                      <td><?=$count?></td> 
                      <td class="<?=($uplanv->aktif_kayit == 1)?"":"text-danger"?>"> 
                       <?=$uplanv->urun_adi?> 
                    </td>
                      <td class="<?=($uplanv->aktif_kayit == 1)?"":"text-danger"?>" style="display: flex;">
                
                        <?=$uplanv->renk_adi?> 
                      </td>
                      <td class="<?=($uplanv->aktif_kayit == 1)?"":"text-danger"?>"> <?=$uplanv->baslik_bilgisi?></td>
                      <td class="<?=($uplanv->aktif_kayit == 1)?"":"text-danger"?>"> 
                      <?=date('d.m.Y',strtotime($uplanv->uretim_tarihi));?>
                         </td>

                         <td> <?=($uplanv->onay_durumu == 0) ? "<span class='text-danger'>Onay Bekleniyor</span>" : "<span class='text-success'>Onaylandı</span>"?></td>
                      <td>
                        <?php
                        if($uplanv->aktif_kayit == 1){
                          ?>

<?php 
                    if($uplanv->onay_durumu == 0){
                      ?>
                        <a href="<?=site_url("uretim_planlama/onay/$uplanv->uretim_planlama_id")?>" type="button" class="btn btn-success btn-xs"><i class="fa fa-check" style="font-size:12px" aria-hidden="true"></i> Onayla</a>
                      <?php
                    }else{
                      ?>
                      <a href="<?=site_url("uretim_planlama/onay_geri/$uplanv->uretim_planlama_id")?>" type="button" class="btn btn-dark btn-xs"><i class="fas fa-exclamation-circle" style="font-size:12px" aria-hidden="true"></i> Onay İptal</a>
                    <?php
                    }
                    ?>

                          <a href="<?=site_url("uretim_planlama/edit/$uplanv->uretim_planlama_id")?>" type="button" class="btn btn-warning btn-xs"><i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> Düzenle</a>


                          <a type="button" onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu kaydı silmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Onayla','<?=base_url('uretim_planlama/delete/').$uplanv->uretim_planlama_id?>');" class="btn btn-danger btn-xs"><i class="fa fa-times" style="font-size:12px" aria-hidden="true"></i> Kayıt Sil</a>
                        


                          <?php
                        }else{
                          ?>
                          <span class="text-danger">KAYIT SİLİNDİ</span>
                          <?php
                        }
                        
                        ?>
                    
                      </td>
                       
                    </tr>
                  <?php  endforeach; ?>
                  </tbody>
                  <tfoot>
                  <tr>
                  <th style="width: 42px;">ID</th> 
                    <th>Cihaz Adı</th>
                    <th>Renk</th>
                    <th  >Başlık</th>
                    <th style="width: 130px;">Üretim Tarihi</th>
                    <th >Onay</th>
                    <th style="width: 250px;">İşlem</th> 
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->



            <div class="card card-dark">
              <div class="card-header">HAFTALIK ÜRETİM - ÖNİZLEME</div>
              <div class="card-body">
                <iframe src="https://ugbusiness.com.tr/login/haftalik_kurulum_plan" style="width:100%;height: 750px;" frameborder="0"></iframe>
              </div>
            </div>
</section>
            </div>