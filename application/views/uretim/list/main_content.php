 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
 
<section class="content text-md">
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
                    <th style="width: 180px;">İşlem</th> 
                  </tr>
                  </thead>
                  <tbody>
                    <?php $count=0; foreach ($uretim_planlar as $uplanv) : ?>
                      <?php $count++?>
                    <tr>
                      <td><?=$count?></td> 
                      <td> 
                       <?=$uplanv->urun_adi?> 
                    </td>
                      <td style="display: flex;">
                
                        <?=$uplanv->renk_adi?> 
                      </td>
                      <td> <?=$uplanv->baslik_bilgisi?></td>
                      <td> 
                      <?=date('d.m.Y',strtotime($uplanv->uretim_tarihi));?>
                         </td>

                         <td> <?=($uplanv->onay_durumu == 0) ? "<span style='color:orange'>Onay Bekleniyor</span>" : "<span class='success'>Onaylandı</span>"?></td>
                      <td>
                    
                          <a href="<?=site_url("uretim_planlama/edit/$uplanv->uretim_planlama_id")?>" type="button" class="btn btn-warning btn-xs"><i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> Düzenle</a>
                          <a type="button" onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu kaydı silmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Onayla','<?=base_url('uretim_planlama/delete/').$uplanv->uretim_planlama_id?>');" class="btn btn-danger btn-xs"><i class="fa fa-times" style="font-size:12px" aria-hidden="true"></i> Kayıt Sil</a>
                        
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
                    <th style="width: 180px;">İşlem</th> 
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
</section>
            </div>