 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
 
<section class="content text-md">
<div class="card card-dark" style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - Parametreler - Demirbaş Yönetimi</h3>
              
              <a href="<?=base_url("demirbas/ekle/1")?>" type="button" class="btn btn-primary btn-sm" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Kayıt Ekle</a>
            

              <?php
                if(!empty($kategori_kontrol)){
                    ?>
                    <a href="<?=base_url("demirbas")?>" type="button" class="btn btn-danger btn-sm mr-2" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-times text-white" style="font-size:12px" aria-hidden="true"></i> Filtrelemeyi kaldır, tüm kayıtları göster  </a>
            
                    <?php
                }
               ?> 
              
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped text-sm">
                  <thead>
                  <tr>
                    <th style="width: 42px;">Kod</th> 
                    <th>Envanter Bilgisi</th>
                    <th>Kategori</th>   
                 
                    <th>Envanter Kullanıcısı</th>
                    <th style="width: 130px;">Kayıt Tarihi</th>
                    <th style="width: 170px;">İşlem</th> 
                  </tr>
                  </thead>
                  <tbody>
                    <?php $count=0; foreach ($demirbaslar2 as $demirbas) : ?>
                    
                    <tr>
                      <td>  
                      <?php 
                       if($demirbas->kategori_id == 1){
                        ?>
                        <img style="width:40px" src="https://m.media-amazon.com/images/I/71s72QE+voL.jpg">
                        <?php
                       } 
                       if($demirbas->kategori_id == 2){
                        ?>
                        <img style="width:40px" src="https://cdn.vatanbilgisayar.com/Upload/PRODUCT/lenovo/thumb/147559-1_large.jpg">
                        <?php
                       } 
                       if($demirbas->kategori_id == 3){
                        ?>
                        <img style="width:40px" src="https://yemekkarti.co/sites/yemekkarti.co/files/inline-images/MN_dikey_erkek.png">
                        <?php
                       } 
                       if($demirbas->kategori_id == 4){
                        ?>
                        <img style="width:40px" src="https://cdn.qukasoft.com/f/752658/bzR6WmFtNG0vcUp3ZUdGdEg4MXZKZWxESUE9PQ/p/intel-i3-4n-8gb-120gb-ssd-19-mon-masaustu-bilgisayar-195154728-sw1000sh1000.webp">
                        <?php
                       } 
                       ?>
                      </td> 
                      <td> 
                       <?=$demirbas->demirbas_adi?> 
                    
                       <?php 
                       if($demirbas->kategori_id == 3){
                        ?>
                        <span style="margin-top:9px" class="d-block">Multinet Kart</span> 
                        <?php
                       }else{
                        ?>
                        <span  style="margin-top:9px" class="d-block"><?=$demirbas->demirbas_marka?></span> 
                        <?php
                       }
                       ?>
                    </td>
                      <td style="display: flex;">
                     
                        <?=($demirbas->demirbas_kategori_adi) ? "<span  style='margin-top:9px'>".$demirbas->demirbas_kategori_adi."</span>" : "<span style='opacity:0.4'>Açıklama Girilmedi</span>"?>
                      </td>

                      
                   
                      <td><span style="margin-top:9px;display:block"><i class="fa fa-user-circle" style="margin-right:5px;opacity:0.8"></i> <?=$demirbas->kullanici_ad_soyad?></span></td>
                      <td>
                        
                        <span style="margin-top:9px;display:block">
                          <i class="far fa-calendar-plus" style="margin-right:5px;opacity:1"></i>
                          <?=date('d.m.Y H:i',strtotime($demirbas->demirbas_kayit_tarihi));?>
                        </span>

                      </td>
                      
                      <td>
                    
                          <a href="<?=site_url("demirbas/duzenle/$demirbas->demirbas_id")?>" type="button" class="btn btn-warning btn-xs"><i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> Düzenle</a>
                          <a type="button" onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu kaydı silmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Onayla','<?=base_url('demirbas/sil/').$demirbas->demirbas_id?>');" class="btn btn-danger btn-xs"><i class="fa fa-times" style="font-size:12px" aria-hidden="true"></i> Kayıt Sil</a>
                        
                      </td>
                       
                    </tr>
                  <?php  endforeach; ?>
                  </tbody>
                  <tfoot>
                  <tr>
                  <th style="width: 42px;">Kod</th> 
                  <th>Envanter Bilgisi</th>
                    <th>Kategori</th>  
             
                    <th>Envanter Kullanıcısı</th>
                    <th style="width: 130px;">Kayıt Tarihi</th>
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