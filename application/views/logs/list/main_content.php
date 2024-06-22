 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
 
<section class="content text-md">
<div class="card card-dark">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - Log</h3>
                <a href="<?=base_url("kullanici-yetkileri/ekle")?>" type="button" class="btn btn-success btn-sm" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Kayıt Ekle</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="examplelog" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="width: 42px;">ID</th>
                    <th>Kullanıcı Adı</th>
                    <th>İşlem Tipi</th>
                    <th>İşlem Detayı</th>
                    <th>İşlem Tarihi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $count=0; foreach ($logs as $log) : ?>
                      <?php $count++?>
                    <tr>
                      <td><?=$count?></td>
                      <td><i class="fa fa-user-circle" style="margin-right:5px;opacity:0.8"></i> <?=$log->kullanici_ad_soyad?></td>
                      <td><i class="far fa-file-alt" style="margin-right:5px;opacity:1"></i> 
                       <?=$log->log_tipi?> 
                    </td>
                      <td style="display: flex;">
                        <i class="fa fa-code" style="margin-right:5px;opacity:0.8"></i>
                        <?=$log->log_detay?>
                        
                      </td>
                      <td> <?=date("d.m.Y H:i:s",strtotime($log->log_kayit_tarihi))?></td>
                 
                       
                       
                    </tr>
                  <?php  endforeach; ?>
                  </tbody>
                  <tfoot>
                  <tr>
                  <th style="width: 42px;">ID</th>
                    <th>Kullanıcı Adı</th>
                    <th>İşlem Tipi</th>
                    <th>İşlem Detayı</th>
                    <th>İşlem Tarihi</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
</section>
            </div>