 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
 
<section class="content text-md">
<div class="card card-dark" style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - Parametreler - Eğitimler</h3>
                <a href="<?=base_url("cihaz")?>" type="button" class="btn btn-primary " style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Eğitim Ekle</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

              <div class="col-12 table-responsive pl-0 pr-0 " style="margin-top:-6px" >

                <table id="exampleeg" class="table table-striped table-bordered nowrap text-sm" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-weight:500;height: 100%; width: 100%;">
                  <thead>
                  <tr>

                    <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">İşlem</th> 

                    <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Müşteri - Merkez Adı</th>
                    <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Ürün</th>
                    
                    <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Kayıt Bilgileri</th> 
                    <?php if($filtre == "uretim_sertifika"){?>
                      <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">İşleme Al</th> 
                    <?php }?>
                    
                    <?php if($filtre == "onay_sertifika"){?>
                    <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Onay</th>
                    <?php }?>
                    <?php if($filtre == "uretim_sertifika"){?>
                      <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Sertifika Üretim</th>
                    <?php }?>
                    <?php if($filtre == "uretim_kalem"){?>
                      <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Kalem Üretim</th>
                    <?php }?>
                    <?php if($filtre == "kargo"){?>
                      <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Kargo</th>
                     <?php }?>
                    
                    
                     <?php if($filtre == "tum"){?>
                      <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Onay</th>
                      <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Sertifika Üretim</th>
                      <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Kalem Üretim</th>
                      <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Kargo</th>
                  
                      
                    
                      <?php }?>

                   
                  </tr>
                  </thead>
                  <tbody>



                    <?php $count=0; foreach ($egitimler as $egitim) : ?>
                      <?php $count++?>
                    <tr>
                    
                      <td style="padding:2px !important;">
                      <?php 
                       if($egitim->sertifika_onay_durumu == 1){
                        ?>

                          <button disabled style="padding: 9px 10px 9px 10px;width:67%;" type="button" class="btn btn-dark btn-flat btn-xs"><i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> Düzenle</button>
                        
                          <?php 
                      }else{
                        ?>
                          <a href="<?=site_url("egitim/duzenle/$egitim->egitim_id")?>"  style="padding: 9px 10px 9px 10px;width:67%;" type="button" class="btn btn-dark btn-flat btn-xs"><i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> Düzenle</a>
                        
                        
                        
                        <?php
                      }
                        ?>

                        
                        
                        
                          <a href="<?=site_url("egitim/delete/$egitim->egitim_id")?>"  style="padding: 9px 10px 9px 10px;width:30%;" type="button" class="btn btn-danger btn-flat btn-xs"><i class="fa fa-times" style="font-size:12px" aria-hidden="true"></i> Sil</a>
                     
                        </td>
                      <td><i class="fa fa-user-circle" style="margin-right:1px;opacity:1"></i> 
                       <?=sonKelimeBuyuk($egitim->musteri_ad)?> / 
                       <?php 
                        echo $egitim->merkez_adi;
 

                       ?><br>
                    <span style="font-weight:normal">
                      <?=$egitim->merkez_adresi?>  <?=$egitim->ilce_adi?> / <?=$egitim->sehir_adi?>
                    </span>

                   <br>
                       <span style="opacity:0.5;font-weight:normal">
                      
                      <?php
                      
                      $kursiyerler = json_decode($egitim->kursiyerler);
$count = 0;
$totalKursiyerler = count($kursiyerler);

foreach ($kursiyerler as $key => $kursiyer) {
    echo $kursiyer;
    $count++;

   
    if ($count % 3 == 0 && $key != $totalKursiyerler - 1) {
        echo "<br>";
    } elseif ($key != $totalKursiyerler - 1) {
        echo ", ";
    }
}
                      
                      
                      ?>
                      </span>
                      
                       <td><i class="fas fa-layer-group" style="margin-right:1px;opacity:1"></i> 
                       <?=$egitim->urun_adi?> <br><span style="opacity:0.5;font-weight:normal"><?=$egitim->seri_numarasi?> </span>
                    </td>
                    <td><i class="fa fa-calendar-alt" style="margin-right:1px;opacity:1"></i> 
                       <span style="opacity:0.5;font-weight:normal">Eğitim :</span><?=date("d.m.Y H:i",strtotime($egitim->egitim_tarihi))?><br>
                       <i class="fa fa-calendar-alt" style="margin-right:1px;opacity:1"></i>
                       <span style="opacity:0.5;font-weight:normal">Kayıt :</span><?=date("d.m.Y H:i",strtotime($egitim->egitim_kayit_tarihi))?><br>
                      
                       
                       <span style="opacity:0.5;font-weight:normal"><?=$egitim->kullanici_ad_soyad?></span>
                      
                        
                    </td>
                    <?php if($filtre == "uretim_sertifika"){?>
                      <td>
                        <?php 
                        if($egitim->sertifika_isleme_alindi == 0){
                              ?>
                                  <div class="icheck-primary d-inline">
                                      <input type="checkbox" id="asfasf<?=$egitim->egitim_id?>" onclick="confirm_action('Eğitim İşleme Al','Seçilen bu eğitim kaydına ait sertifika işleme alınacaktır. Bu işlemi onaylıyor musunuz ?','Onayla','<?=base_url('egitim/egitim_islem_durumu_guncelle/').$egitim->egitim_id?>');this.checked=false;">
                                      <label for="asfasf<?=$egitim->egitim_id?>" style="font-weight:normal">
                                      Beklemede
                                      </label>
                                  </div>
                              <?php
                        }else{
                          ?>
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox"  id="asfasf<?=$egitim->egitim_id?>" checked="true" onclick="confirm_action('Eğitim İşleme Al','Seçilen bu eğitim kaydına ait sertifika işlemden çıkarılacaktır. Bu işlemi onaylıyor musunuz ?','Onayla','<?=base_url('egitim/egitim_islem_durumu_guncelle/').$egitim->egitim_id?>');this.checked=true;">
                                    <label class="text-danger" for="asfasf<?=$egitim->egitim_id?>">
                                    İşleme Alındı
                                    </label>
                                </div>
                      <?php
                        }
                        ?>
                   


</td>      <?php }?>
                    

<?php 
                     if($filtre == "onay_sertifika" || $filtre == "tum"){

                   ?>
                    <td style="padding:2px !important;">
                     <?php 
                       if($egitim->sertifika_onay_durumu == 0){
                        ?>
                          <a onclick="confirm_action('Eğitimi Onayla','Seçilen bu eğitim kaydına ait sertifikayı onaylıyor musunuz ?','Onayla','<?=base_url('egitim/egitim_onay/'.$egitim->egitim_id)?>');" type="button" style="padding:  9px 10px 9px 10px;" class="btn btn-block btn-xs btn-flat btn-warning"><i class='fas fa-spinner mr-2'></i>Beklemede</a>
                         <?php
                       }else{
                        ?>
                           <a  onclick="confirm_action('Eğitimi Onayla','Seçilen bu eğitim kaydına ait sertifikanın onay durumunu iptal etmek istediğinize emin misiniz ?','Onayla','<?=base_url('egitim/egitim_onay/'.$egitim->egitim_id)?>');" type="button" style="padding:  9px 10px 9px 10px;" class="btn btn-block btn-xs btn-flat btn-success">
                           <i class='fas fa-check mr-2'></i>Onaylandı 
                          
                          </a>
                   
                        <?php
                       }
                     ?>
                    </td>
                    <?php
                       }
                     ?>
                    <?php 
                     if($filtre == "uretim_sertifika" || $filtre == "tum"){

                   ?>
                    <td style="padding:2px !important;" >
                    <?php 
                       if($egitim->sertifika_uretim_durumu == 0){
                        ?>
                          <button <?=($egitim->sertifika_onay_durumu == 0)?"disabled style='opacity:0.3;padding:  9px 10px 9px 10px;'":""?>  onclick="confirm_action('Eğitimi Onayla','Seçilen bu eğitim kaydına ait sertifikanın üretimini onaylıyor musunuz ?','Onayla','<?=base_url('egitim/uretim_onay/'.$egitim->egitim_id)?>');" type="button" style="padding:  9px 10px 9px 10px;" class="btn btn-block btn-xs btn-flat btn-warning"><i class='fas fa-spinner mr-2'></i>Beklemede</button>
                   
                        <?php
                       }else{
                        ?>
                         <button <?=($egitim->sertifika_onay_durumu == 0)?"disabled style='opacity:0.3;padding:  9px 10px 9px 10px;'":""?>  onclick="confirm_action('Eğitimi Onayla','Seçilen bu eğitim kaydına ait sertifikanın üretimi onaydan çıkarılacaktır.Devam etmek istiyor musunuz ?','Onayla','<?=base_url('egitim/uretim_onay/'.$egitim->egitim_id)?>');" type="button" style="padding:  9px 10px 9px 10px;" class="btn btn-block btn-xs btn-flat btn-success"><i class='fas fa-check mr-2'></i>Baskıya Verildi</button>
                   
                        <?php
                       }
                     ?>
                    </td>

                    <?php
                       }
                     ?>
                    <?php 
                     if($filtre == "uretim_kalem" || $filtre == "tum"){

                   ?>
                    <td style="padding:2px !important;">
                    <?php 
                       if($egitim->sertifika_kalem_uretim_durumu == 0){
                        ?>
                          <button <?=($egitim->sertifika_uretim_durumu == 0)?"disabled style='opacity:0.3;padding:  9px 10px 9px 10px;'":""?>  onclick="confirm_action('Eğitimi Onayla','Seçilen bu eğitim kaydına ait sertifikanın kalem üretimini onaylıyor musunuz ?','Onayla','<?=base_url('egitim/kalem_onay/'.$egitim->egitim_id)?>');" type="button" style="padding: 9px 10px 9px 10px;" class="btn btn-block btn-xs btn-flat btn-warning"><i class='fas fa-spinner mr-2'></i>Beklemede</button>
                   
                        <?php
                       }else{
                        ?>
                        <button <?=($egitim->sertifika_uretim_durumu == 0)?"disabled style='opacity:0.3;padding:  9px 10px 9px 10px;'":""?>  onclick="confirm_action('Eğitimi Onayla','Seçilen bu eğitim kaydına ait sertifikanın kalem üretimi onaydan çıkarılacaktır.Devam etmek istiyor musunuz ?','Onayla','<?=base_url('egitim/kalem_onay/'.$egitim->egitim_id)?>');" type="button" style="padding:  9px 10px 9px 10px;" class="btn btn-block btn-xs btn-flat btn-success"><i class='fas fa-check mr-2'></i>Üretildi</button>
                   
                        <?php
                       }
                     ?>
                     </td>

                     <?php
                       }
                     ?>


                     <?php 
                     if($filtre == "kargo" || $filtre == "tum"){

                   ?>
                    <td style="padding:2px !important;">
                    <?php 
                       if($egitim->sertifika_kargo_durumu == 0){
                        ?>
                         <button <?=($egitim->sertifika_uretim_durumu == 0)?"disabled style='opacity:0.3;padding:  9px 10px 9px 10px;'":""?>  onclick="confirm_action('Eğitimi Onayla','Seçilen bu eğitim kaydına ait sertifikanın kargo durumunu onaylıyor musunuz ?','Onayla','<?=base_url('egitim/kargo_onay/'.$egitim->egitim_id)?>');" type="button" style="padding:  9px 10px 9px 10px;" class="btn btn-block btn-xs btn-flat btn-warning"><i class='fas fa-spinner mr-2'></i>Beklemede</button>
                   
                        <?php
                       }else{
                        ?>
                        <button <?=($egitim->sertifika_uretim_durumu == 0)?"disabled style='opacity:0.3;padding:  9px 10px 9px 10px;'":""?>  onclick="confirm_action('Eğitimi Onayla','Seçilen bu eğitim kaydına ait sertifikanın kargo durumu onaydan çıkarılacaktır.Devam etmek istiyor musunuz ?','Onayla','<?=base_url('egitim/kargo_onay/'.$egitim->egitim_id)?>');" type="button" style="padding: 9px 10px 9px 10px;" class="btn btn-block btn-xs btn-flat btn-success"><i class='fas fa-check mr-2'></i>Kargoya Verildi</button>
                   
                        <?php
                       }
                     ?>
                    </td>
                   <?php
                  }
                  ?>
                       
                    </tr>
                  <?php  endforeach; ?>

               
                  </tbody>
                  <tfoot>
          
                  </tfoot>
                </table>
              </div>
            

              
            
            
            </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            
<div class="row <?=($filtre != "uretim_sertifika") ? "d-none":""?>">

<?php 

                       foreach (get_urunler() as $urun) {
                        if($urun->harici_cihaz == 1){
                          continue;
                        }
                        ?>
                           <div class="col"><div class="card"><div class="card-header bg-dark"><?=$urun->urun_adi?></div>
                         
                           <textarea name="" class="form-control" id="" cols="30" rows="10"><?php
                            foreach ($egitimler as $egitim) {
                              if($egitim->sertifika_isleme_alindi == 1 && $egitim->urun_id == $urun->urun_id){
                                
                                $kursiyerler = json_decode($egitim->kursiyerler, true);

                                foreach ($kursiyerler as $ad) {
                                   echo $ad . "\n";
                                }
                              }
                             
                                }?></textarea>
                          </div>
                        <a href="<?=base_url("egitim/hizli_sertifika_olustur/".$urun->urun_id)?>" class="btn btn-warning">
Sertifika Oluştur
                              </a>
                        </div>
                                
                        <?php
                       }

?>


 </div>
</section>



            </div>


            