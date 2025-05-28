 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
 
<section class="content text-md">
  <div class="row">




  
    <div class="col-4">
<div class="card card-dark " style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - Cihaz Kontrol CheckList</h3>
                <a href="<?=base_url("urun/ekle")?>" type="button" class="btn btn-primary btn-sm" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Kayıt Ekle</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="height: 786px; overflow: auto;">
              
              
              <?php 
              foreach ($urunler as $urun) {
                ?>

                <a   style="padding-right: 0px;width: 100%;  margin-bottom:10px;   border: 1px dashed #002355;padding-left:0px;"  type="button" class="btn btn-default text-left pb-2">
   <div class="row" style="height: 71px;">
     <div class="col" style="max-width: 87px;">
       <img src="
				<?="https://www.umex.com.tr/uploads/products/".$urun->urun_slug.".png"?>" alt="..." style="width: 83px;" class="rounded img-thumbnail">
     </div>
     <div class="col" style="padding-left: 0px;margin-top:-5px;">
       <span style="
    display: block;  
    color: white;
    border-radius: 5px;
    border-radius: 3px 3px 0 0;
">
         <span style="min-width: 230px;padding:9px; display: inline-block; margin-left:5px">
           <b style="color:#0f3979"> <?=$urun->urun_adi?> </b>  <br>
         
<div class="btn-group">
  <?php
  $sayi = $urun->cihaz_test_sayisi;
  for ($i=1; $i <= $sayi ; $i++) { 
    
  ?>
  
                        <button type="button" class="btn btn-default"><?=$i?>. Test</button>

                        <?php } ?> 
                      </div>


          </span>
       </span>
       <br>

          
     </div>
   </div>
 </a>



                <?php
              }
              ?>



              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

</div>



    <div class="col-4">
<div class="card card-dark " style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - Cihaz Kontrol CheckList</h3>
                <a href="<?=base_url("urun/ekle")?>" type="button" class="btn btn-primary btn-sm" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Kayıt Ekle</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>  
                    <th>Checklist Başlık</th> 
                    <th >İşlem</th> 
                  </tr>
                  </thead>
                  <tbody>
                    <?php $count=0; foreach ($checklist as $c) : ?>
                      <?php $count++?>
                    <tr> 
                      <td>  
                       <?=$c->kontrol_form_checklist_label?> 
                    </td>
                      
                     
                      <td>
                    
                          <a href="<?=site_url("urun/duzenle/$c->kontrol_form_checklist_id ")?>" type="button" class="btn btn-warning btn-xs"><i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> Düzenle</a>
                         
                      </td>
                       
                    </tr>
                  <?php  endforeach; ?>
                  </tbody> 
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

</div>


          <div class="col-4">      
<div class="card card-dark  " style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - Cihaz Kontrol Ölçüm Headers</h3>
                <a href="<?=base_url("urun/ekle")?>" type="button" class="btn btn-primary btn-sm" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Kayıt Ekle</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>  
                    <th>Ölçüm Data Header</th> 
                    <th >İşlem</th> 
                  </tr>
                  </thead>
                  <tbody>
                    <?php $count=0; foreach ($dataheaders as $d) : ?>
                      <?php $count++?>
                    <tr> 
                      <td>  
                       <?=$d->kontrol_form_baslik_adi?> 
                    </td>
                      
                     
                      <td>
                    
                          <a href="<?=site_url("urun/duzenle/$c->kontrol_form_baslik_id  ")?>" type="button" class="btn btn-warning btn-xs"><i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> Düzenle</a>
                         
                      </td>
                       
                    </tr>
                  <?php  endforeach; ?>
                  </tbody> 
                </table>
              </div>
              <!-- /.card-body -->
            </div> 
          
          <div class="card card-dark  " style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - Cihaz Kontrol Ölçüm Rows</h3>
                <a href="<?=base_url("urun/ekle")?>" type="button" class="btn btn-primary btn-sm" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Kayıt Ekle</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>  
                    <th>Ölçüm Data Row</th> 
                    <th >İşlem</th> 
                  </tr>
                  </thead>
                  <tbody>
                    <?php $count=0; foreach ($datarows as $d) : ?>
                      <?php $count++?>
                    <tr> 
                      <td>  
                       <?=$d->kontrol_form_data_row_label?> 
                    </td>
                      
                     
                      <td>
                    
                          <a href="<?=site_url("urun/duzenle/$c->kontrol_form_data_row_id   ")?>" type="button" class="btn btn-warning btn-xs"><i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> Düzenle</a>
                         
                      </td>
                       
                    </tr>
                  <?php  endforeach; ?>
                  </tbody> 
                </table>
              </div>
              <!-- /.card-body -->
            </div> 
          
          </div>
            <!-- /.card --></div>
</section>
            </div>