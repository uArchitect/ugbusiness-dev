 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
 
<section class="content text-md">
<div class="card card-dark" style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - Parametreler - Döküman Kategorileri</h3>
                <a href="<?=base_url("dokuman_kategori/ekle")?>" type="button" class="btn btn-primary btn-sm" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Kayıt Ekle</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped nowrap">
                  <thead>
                  <tr>
                    <th style="width: 42px;">ID</th> 
                    <th>Döküman Kategori Adı</th>
                    <th>Döküman Kategori Açıklaması</th>
                    <th>Kullanıcı</th>
                    <th style="width: 130px;">Kayıt Tarihi</th>
                    <th style="width: 130px;">Güncelleme Tarihi</th>
                    <th style="width: 130px;">İşlem</th> 
                  </tr>
                  </thead>
                  <tbody>
                    <?php $temp_category_id=1; $count=0; foreach ($dokuman_kategorileri as $dokuman_kategori) : ?>
                      <?php 
                   
                       if($count==0){
                        $count++;
                        continue;
                       }
                       $count++;
                      ?>
                    <tr>
                      <td><?=$count-1?></td> 
                      <td>
                      <span >  
                      <i class="far fa-file-alt" style="margin-right:5px;opacity:1"></i> 
                       <?=$dokuman_kategori->dokuman_kategori_adi?> </span>
                    </td>
                      <td style="display: flex;">
                        <i class="far fa-file-alt" style="margin-right:5px;opacity:0.8"></i>
                        <?=($dokuman_kategori->dokuman_kategori_aciklama) ? $dokuman_kategori->dokuman_kategori_aciklama : "<span style='opacity:0.4'>Açıklama Girilmedi</span>"?>
 
                      </td>
                      <td><i class="fa fa-user-circle" style="margin-right:5px;opacity:0.8"></i> <?=$dokuman_kategori->kullanici_ad_soyad?></td>
                      <td><i class="far fa-calendar-plus" style="margin-right:5px;opacity:1"></i> <?=date('d.m.Y H:i',strtotime($dokuman_kategori->dokuman_kategori_kayit_tarihi));?></td>
                      <td>
                        <?php
                          if($dokuman_kategori->dokuman_kategori_guncelleme_tarihi > $dokuman_kategori->dokuman_kategori_kayit_tarihi){
                            ?>
                              <i class="fa fa-sync" style="margin-right:5px;opacity:1"></i> <?=date('d.m.Y H:i',strtotime($dokuman_kategori->dokuman_kategori_guncelleme_tarihi));?>
                            <?php
                          }else{
                            ?>
                              <span style="opacity:0.3; font-size:15px"><i class="fa fa-sync" style="margin-right:5px;opacity:1"></i> Güncellenmedi...</span>
                            <?php
                          }
                        ?>
                         </td>
                      <td>
                    
                          <a href="<?=site_url("dokuman_kategori/duzenle/$dokuman_kategori->dokuman_kategori_id")?>" type="button" class="btn btn-warning btn-xs"><i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> Düzenle</a>
                          <a type="button" onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu kaydı silmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Onayla','<?=base_url('dokuman_kategori/sil/').$dokuman_kategori->dokuman_kategori_id?>');" class="btn btn-danger btn-xs"><i class="fa fa-times" style="font-size:12px" aria-hidden="true"></i> Kayıt Sil</a>
                        
                      </td>
                       
                    </tr>
                  <?php
                      $temp_category_id = $dokuman_kategori->dokuman_kategori_ust_kategori_id;
                        endforeach; ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th style="width: 42px;">ID</th> 
                    <th>Döküman Kategori Adı</th>
                    <th>Döküman Kategori Açıklaması</th>
                    <th>Kullanıcı</th>
                    <th style="width: 130px;">Kayıt Tarihi</th>
                    <th style="width: 130px;">Güncelleme Tarihi</th>
                    <th style="width: 130px;">İşlem</th> 
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
</section>
            </div>