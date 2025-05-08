 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
 
<section class="content text-md">
<div class="card card-dark" style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - Depo Malzeme Çıkış Talepleri</h3>
                <a href="<?=base_url("depo_onay/talep_olustur")?>" type="button" class="btn btn-primary " style="float: right!important;padding: 5px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Talep Oluştur</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="width: 42px;">ID</th> 
                    <th>Talep Oluşturan</th>
                    <th>Malzeme Bilgisi</th>
                    <th>Miktar</th>
                    <th>Talep Tarihi</th>
                    <th>Depo Çıkış Onayı</th>
                    <th>Teslim Alındı Onayı</th>
                    <th style="width: 130px;">İşlem</th> 
                  </tr>
                  </thead>
                  <tbody>
                    <?php   foreach ($talepler as $d) : ?>
                   
                    <tr>
                      <td><?=$d->stok_onay_id ?></td> 
                      <td><i class="far fa-file-alt" style="margin-right:5px;opacity:1"></i> 
                        <?=$d->kullanici_ad_soyad?> 
 
                    </td>
                      <td>
                        <i class="far fa-file-alt" style="margin-right:5px;opacity:0.8"></i>
                        <?=$d->stok_tanim_ad?>
                      </td>
                      <td>
                        <i class="far fa-file-alt" style="margin-right:5px;opacity:0.8"></i>
                        <?=$d->talep_miktar?>
                      </td>
                      <td>
                        <i class="far fa-file-alt" style="margin-right:5px;opacity:0.8"></i>
                        <?=date("d.m.Y H:i",strtotime($d->talep_olusturulma_tarihi))?>
                      </td>

                      <td>
                        <?php 
                        if($d->kayit_durum == 0){
                          echo "<span class='text-danger'>İPTAL EDİLDİ</span>";
                        }else{
                           if($d->birinci_onay_durumu == 0){
                          ?>
                             <a onclick="confirm_action('Aktifleştirme İşlemini Onayla','Seçilen bu talebe çıkış onayı vermek istediğinize emin misiniz ?','Onayla','<?=base_url('depo_onay/birinci_onay/').$d->stok_onay_id ?>');"  href="" class="btn btn-warning">Onayla</a>
                          <?php
                        }else{
                          ?>
                          <a class="btn btn-success"><i class="fa fa-check"></i> Onay Verildi</a>
                          <?php
                        }
                        }
                       
                        ?>
                      </td>
                     

                      <td style="display: flex;">
                        <?php 

if($d->kayit_durum == 0){
  echo "<span class='text-danger'>İPTAL EDİLDİ</span>";
}else{
    if($d->birinci_onay_durumu == 0){
                                ?>
                                <span class="text-danger">Çıkış Onayı Bekleniyor.</span>
                                <?php
                               }else{
                                if($d->teslim_alma_onayi == 0){
                                  ?>
                                  <a onclick="confirm_action('Aktifleştirme İşlemini Onayla','Seçilen bu talebe (teslim aldım) onayı vermek istediğinize emin misiniz ?','Onayla','<?=base_url('depo_onay/teslim_onay/').$d->stok_onay_id ?>');"  href="" class="btn btn-warning">Onayla</a>
                                  <?php
                                }else{
                                  ?>
                                  <a class="btn btn-success"><i class="fa fa-check"></i> Teslim Alındı</a>
                                  <?php
                                }
                               }
}

                             
                        
                        ?>
                      </td>

                      <td>
                      <?php 
                      
                      if($d->kayit_durum == 0){
                       
                        ?>
                          <a type="button" onclick="confirm_action('Aktifleştirme İşlemini Onayla','Seçilen bu talebi aktif etmek istediğinize emin misiniz ?','Onayla','<?=base_url('depo_onay/aktif/').$d->stok_onay_id ?>');" class="btn btn-dark btn-xs"><i class="fa fa-eye" style="font-size:12px" aria-hidden="true"></i> Tekrar Aktifleştir</a>
                        <?php
                      }else{
                        ?>
                          <a type="button" onclick="confirm_action('İptal İşlemini Onayla','Seçilen bu talebi iptal etmek istediğinize emin misiniz ?','Onayla','<?=base_url('depo_onay/sil/').$d->stok_onay_id ?>');" class="btn btn-danger btn-xs"><i class="fa fa-times" style="font-size:12px" aria-hidden="true"></i> İptal Et</a>
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