  <style>
    table.dataTable{
          margin-top: 0px !important;
    }
    </style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px; ">
 
<section class="content text-md" >


<div class="row">
 <div class="col-md-6">



 <div class="card card-dark" style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - Parametreler - Şehir Yönetimi</h3>
                <a href="<?=base_url("sehir/ekle")?>" type="button" class="btn btn-primary btn-sm" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Kayıt Ekle</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example_table_sehir" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="width: 42px;">ID</th> 
                    <th>Şehir Adı</th>  
                    <th style="width: 130px;">İşlem</th> 
                  </tr>
                  </thead>
                  <tbody>
                    <?php $count=0; foreach ($sehirler as $sehir) : ?>
                      <?php $count++?>
                    <tr>
                      <td><?=$count?></td> 
                      <td><i class="far fa-file-alt" style="margin-right:5px;opacity:1"></i> 
                       <?=$sehir->sehir_adi?> 
                    </td>
                      
                      <td>
                        <a href="<?=site_url("sehir/duzenle/$sehir->sehir_id")?>"  type="button" class="btn btn-warning btn-xs"><i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> Düzenle</a>
                        <a type="button" onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu kaydı silmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Onayla','<?=base_url('sehir/sil/').$sehir->sehir_id?>');" class="btn btn-dark btn-xs"><i class="fa fa-times" style="font-size:12px" aria-hidden="true"></i> Kayıt Sil</a>
                      </td>
                       
                    </tr>
                  <?php  endforeach; ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th style="width: 42px;">ID</th> 
                    <th>Şehir Adı</th>  
                    <th style="width: 130px;">İşlem</th> 
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->



 </div>
 <div class="col-md-6">




 <div class="card card-dark" style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - Parametreler - İlçe Yönetimi</h3>
                <a href="<?=base_url("ilce/ekle")?>" type="button" class="btn btn-primary btn-sm" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Kayıt Ekle</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example_table_ilce" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="width: 42px;">ID</th> 
                    <th>İlçe Adı</th> 
                    <th>Şehir Adı</th>  
                    <th style="width: 130px;">İşlem</th> 
                  </tr>
                  </thead>
                  <tbody>
                    <?php $count=0; foreach ($ilceler as $ilce) : ?>
                      <?php $count++?>
                    <tr>
                      <td><?=$count?></td> 
                      
                      <td><i class="far fa-file-alt" style="margin-right:5px;opacity:1"></i> 
                       <?=$ilce->ilce_adi?> 
                    </td>
                    <td><i class="far fa-file-alt" style="margin-right:5px;opacity:1"></i> 
                       <?=$ilce->sehir_adi?> 
                    </td>
                      <td>
                    
                          <a href="<?=site_url("ilce/duzenle/$ilce->ilce_id")?>" type="button" class="btn btn-warning btn-xs"><i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> Düzenle</a>
                          <a type="button" onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu kaydı silmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Onayla','<?=base_url('ilce/sil/').$ilce->ilce_id?>');"   class="btn btn-dark btn-xs"><i class="fa fa-times" style="font-size:12px" aria-hidden="true"></i> Kayıt Sil</a>
                        
                      </td>
                       
                    </tr>
                  <?php  endforeach; ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th style="width: 42px;">ID</th> 
                    <th>İlçe Adı</th>  
                    <th>Şehir Adı</th>  
                    <th style="width: 130px;">İşlem</th> 
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

 </div>













             
</div>


</section>
            </div>