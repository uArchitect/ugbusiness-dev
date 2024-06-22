 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
 
<section class="content text-md">
<div class="card col-12 card-dark" style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - Parametreler - Cihaz Stok Havuzu</h3>
                <a href="<?=base_url("cihaz/cihaz_havuz_tanimla_view")?>" type="button" class="btn btn-primary btn-sm" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Kayıt Ekle</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped nowrap">
                  <thead>
                  <tr>
                    <th style="width: 42px;">ID</th> 
                    <th style="width: 130px;">Cihaz Adı</th>
                    <th style="width: 130px;">Renk</th>
                    <th style="width: 130px;">Cihaz Seri Numarası</th>
                    <th style="width: 130px;">Stok Durumu</th>
                    <th style="width: 130px;">İşlem</th> 
                  </tr>
                  </thead>
                  <tbody>
                    <?php $count=0; foreach ($cihazlar as $cihaz) : ?>
                  
                    <tr>
                      <td>    <?=$cihaz->cihaz_havuz_id?> </td> 
                      <td><i class="far fa-file-alt" style="margin-right:5px;opacity:1"></i> 
                       <?=$cihaz->urun_adi?> 
                    </td>
                    <td><i class="far fa-file-alt" style="margin-right:5px;opacity:1"></i> 
                       <?=$cihaz->renk_adi?> 
                    </td>
                      <td style="display: flex;">
                        <i class="far fa-file-alt" style="margin-right:5px;opacity:0.8"></i>
                        <?=$cihaz->cihaz_havuz_seri_numarasi?>
                      </td>


                      <td>
                     <?php 
                     
                     if($cihaz->cihaz_havuz_durum == 0){
?>

<button type="button" class="btn btn-block btn-outline-success" style="background-color:#51e76f1a;color:#00891f">
<b>
<?=get_merkez($cihaz->cihaz_havuz_seri_numarasi) != null ? get_merkez($cihaz->cihaz_havuz_seri_numarasi)->merkez_adi:""?>
                     </b>/
Satış

</button>


<?php
                     }else{
                      ?>

                      <button type="button" class="btn btn-block btn-outline-warning" style="background-color:#fcc03530;color:#9f7700">
                      <b>
Satış Yapılmadı
                     </b>/
                      Stokta Bekliyor</button>
                      
                      
                      <?php
                     }
                     
                     ?>


                      </td>



                      <td>
                      <a type="button" href="<?=base_url("cihaz/cihaz_havuz_tanimla_update_view/".$cihaz->cihaz_havuz_id)?>"  class="btn btn-warning btn-xs"><i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> Düzenle</a>
                        
                           <a type="button" onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu kaydı silmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Onayla','<?=base_url('cihaz/cihaz_havuz_sil/').$cihaz->cihaz_havuz_id?>');" class="btn btn-danger btn-xs"><i class="fa fa-times" style="font-size:12px" aria-hidden="true"></i> Kayıt Sil</a>
                        
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