 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
 
<section class="content text-md">
<div class="card card-dark">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - Kullanıcı Yetkileri</h3>
                <a href="<?=base_url("kullanici-yetkileri/ekle")?>" type="button" class="btn btn-success btn-sm" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Kayıt Ekle</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table text-md table-bordered table-striped nowrap">
                  <thead>
                  <tr>
                    <th style="width: 42px;">ID</th>
                    <th>Kullanıcı Yetki Grup</th>
                    <th>Kullanıcı Yetki Tanımı</th>
                    <th>Yetki Kodu</th>
                    <th>Kullanıcı</th>
                    <th style="width: 130px;">İşlem</th> 
                  </tr>
                  </thead>
                  <tbody>
                    <?php $count=0; foreach ($kullanici_yetkileri as $kullanici_yetki) : ?>
                      <?php $count++?>
                    <tr>
                      <td><?=$count?></td>
                      <td><i class="far fa-folder-open"></i> <?=$kullanici_yetki->kullanici_yetki_grup_adi?></td>
                      <td><i class="far fa-file-alt" style="margin-right:5px;opacity:1"></i> 
                       <?=$kullanici_yetki->kullanici_yetki_adi?> 
                    </td>
                      <td style="display: flex;">
                        <i class="fa fa-code" style="margin-right:5px;opacity:0.8"></i>
                        <?=$kullanici_yetki->kullanici_yetki_kodu?>
                        <button id="button<?=$count?>" onclick="copy('<?=$kullanici_yetki->kullanici_yetki_kodu?>','<?=$count?>');" style="opacity:0.7" type="button" class="btn btn-default btn-xs">
                          
                          <span id="span<?=$count?>">Kopyala</span> 
                        </button>
                      </td>
                      <td><i class="fa fa-user-circle" style="margin-right:5px;opacity:0.8"></i> <?=$kullanici_yetki->kullanici_ad_soyad?></td>
                 
                      <td>
                    
                          <a href="<?=site_url("kullanici-yetkileri/duzenle/$kullanici_yetki->kullanici_yetki_id")?>" type="button" class="btn btn-warning btn-xs"><i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> Düzenle</a>
                          <a type="button" onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu kaydı silmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Onayla','<?=base_url('kullanici-yetkileri/sil/').$kullanici_yetki->kullanici_yetki_id?>');" class="btn btn-danger btn-xs"><i class="fa fa-times" style="font-size:12px" aria-hidden="true"></i> Kayıt Sil</a>
                        
                      </td>
                       
                    </tr>
                  <?php  endforeach; ?>
                  </tbody>
                  <tfoot>
                  <tr>
                  <th style="width: 42px;">ID</th>
                  
                  <th>Kullanıcı Yetki Grup</th>
                    <th>Kullanıcı Yetki Tanımı</th>
                    <th>Yetki Kodu</th>
          
                    <th>Kullanıcı</th>
                    <th>İşlem</th> 
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
</section>
            </div>