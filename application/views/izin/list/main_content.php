 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
 
<section class="content text-md">




<div class="row">
  
          <div class="col pb-0 p-0">
            <!-- small box -->
            <div class="small-box bg-warning mb-2">
              <div class="inner">
                <h3>

                <?php
                $istek_durumu_1_sayisi = count(array_filter($istekler, function($istek) {
                  return $istek->sorumlu_onay_durumu == 0;
              }));
              echo $istek_durumu_1_sayisi;
                ?>

                </h3>

                <p>Onay Bekleyen İzinler</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="?filter=0" class="small-box-footer">Onay Bekleyen İzinleri Görüntüle <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col col-xs-12 pb-0">
            <!-- small box -->
            <div class="small-box bg-primary mb-2">
              <div class="inner">
                <h3>
                <?php
                $istek_durumu_1_sayisi = count(array_filter($istekler, function($istek) {
                  return $istek->insan_kaynaklari_onay_durumu == 1;
              }));
              echo $istek_durumu_1_sayisi;
                ?>

                </h3>

                <p>Onaylanan İzinler</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="?filter=1" class="small-box-footer">Onaylanan İzinleri Görüntüle <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
   
       
          <!-- ./col -->
          <div class="col pb-0 pr-0">
            <!-- small box -->
            <div class="small-box bg-danger mb-2">
              <div class="inner">
                <h3>
                <?php
                $istek_durumu_1_sayisi = count(array_filter($istekler, function($istek) {
                  return ($istek->sorumlu_onay_durumu == 2 || $istek->insan_kaynaklari_onay_durumu == 2);
              }));
              echo $istek_durumu_1_sayisi;
                ?>
                </h3>

                <p>Reddedilen İzinler</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="?filter=2" class="small-box-footer">Reddedilen İzinleri Görüntüle <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->


       
          <!-- ./col -->
          <div class="col pb-0 pr-0">
            <!-- small box -->
            <div class="small-box bg-success mb-2">
              <div class="inner">
                <h3>
                <?php
               
              echo count($istekler);
                ?>
                </h3>

                <p>Toplam İzin Talepleri</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="<?=base_url("izin/onay_bekleyenler")?>" class="small-box-footer">İzin Taleplerini Görüntüle <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->






        </div>
        <!-- /.row -->



<div class="card card-default" style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong>Business</strong> - İnsan Kaynakları - İzin Yönetimi</h3>
                <a href="<?=base_url("izin/add")?>" type="button" class="btn btn-primary btn-sm" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Kayıt Ekle</a>
               <?php
                if(!empty($_GET["filter"])){
                    ?>
                    <a href="<?=base_url("izin/onay_bekleyenler")?>" type="button" class="btn btn-danger btn-sm mr-2" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-times text-white" style="font-size:12px" aria-hidden="true"></i> Filtrelemeyi kaldır, tüm kayıtları göster  </a>
            
                    <?php
                }
               ?>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered nowrap table-striped text-sm">
                  <thead>
                  <tr>
                    <th style="width: 42px;">Kod</th> 
                    <th>Talep Eden Kullanıcı</th>
                  
                    <th>İzin Nedeni</th>
                 
                    <th style="width: 160px;">İzin Başlangıç</th>
                    <th style="width: 130px;">İzin Bitiş</th>
                    <th style="width: 130px;">Birim Sorumlu Onayı</th>
                    <th style="width: 130px;">İnsan Kaynakları Onayı</th>
                    <th style="width: 190px;">İşlem</th> 
                  </tr>
                  </thead>
                  <tbody>
                    <?php $count=0; foreach ($istekler as $istek) : ?>
                      <?php 
                        if(!empty($_GET["filter"]) && ($istek->insan_kaynaklari_onay_durumu != $_GET["filter"]) ){continue;} 
                        
                        
                        
                        
                        $count++?>
                    <tr>
                      <td>T<?=str_pad($istek->izin_talep_id,5,"0",STR_PAD_LEFT);?></td> 
                      <td>  
                      <b> <i class="far fa-file-alt" style="margin-right:5px;opacity:1"></i>  <?=$istek->kullanici_ad_soyad?>    </b> / <?=$istek->departman_adi?> 
                      
                    </td>
 
                    <td>
                   <b> <i class="far fa-building" style="margin-right:5px;opacity:1"></i>  <?=$istek->izin_neden_detay?>   </b>
                  
                    </td>


                      
                      <td class="align-items-center;min-height: 100vh">
                        <i class="fa fa-user-circle" style="margin-right:5px;opacity:0.8"></i> 
                        <b>
                      
                        <?=date('d.m.Y H:i',strtotime($istek->izin_baslangic_tarihi));?></b></td>



                        <td class="align-items-center;min-height: 100vh">
                        <i class="fa fa-user-circle" style="margin-right:5px;opacity:0.8"></i> 
                        <b>
                      
                        <?=date('d.m.Y H:i',strtotime($istek->izin_bitis_tarihi));?></b></td>












                        <td>
                    
                    <?php
                       if($istek->izin_durumu == 0){
                        ?>
                        <span class="text-danger"><i class="fas fa-exclamation-circle"></i> İptal edildi.</span>
                        <?php
                      }else{

                    if($istek->sorumlu_onay_durumu == 0){
                      if($sorumlu_onay_yetki){
                        ?>
                        <button onclick="confirm_ticket_success_action('İzin Durumunu Onayla','Seçilen bu izin talebini onaylamak istediğinize emin misiniz ?','Onayla','<?=base_url('izin/sorumlu_onayla/').$istek->izin_talep_id?>');" style="margin-top:2px;    padding-right: 10px;font-size:13px !important;" type="button" class="btn btn-xs btn-success-dark"><i class="fas fa-check"></i> ONAYLA</button>
                        <button onclick="confirm_ticket_danger_action('İzin Talebini Reddet','Seçilen bu izin talebini reddetmek istediğinize emin misiniz ?','Reddet','<?=base_url('izin/sorumlu_reddet/').$istek->izin_talep_id?>');" style="margin-top:2px;font-size:13px !important;" type="button" class="btn btn-xs btn-danger-dark"><i class="fas fa-arrow-circle-right"></i> REDDET</button>
                       <?php
                      }else{
                        ?>
                          <button onclick="confirm_ticket_success_action('İstek Durumunu Onayla','Seçilen bu isteği onaylamak istediğinize emin misiniz ?','Onayla','<?=base_url('istek/onayla/').$istek->izin_talep_id?>');" style="margin-top:2px;    padding-right: 10px;font-size:13px !important;" type="button" class="btn btn-xs btn-warning-dark"><i class="fas fa-spinner"></i> Onay Bekleniyor</button>
                        <?php
                      }
                     
                    }elseif($istek->sorumlu_onay_durumu == 1){
                      ?>
                        
                      <button style="margin-top:2px;    padding-right: 10px;font-size:13px !important; background:transparent!important;color:green!important" type="button" class="btn btn-xs btn-success-dark"><i class="fas fa-check"></i> ONAYLANDI</button>
                      
                      
                      <?php
                    }elseif($istek->sorumlu_onay_durumu == 2){
                      ?>
                        
                       <span class="text-danger"> REDDEDİLDİ</span>
                      
                      <?php
                    }}
                   ?>
                   
                  </td>


                      <td>
                    



                      
                      
                     <?php



                    if($istek->izin_durumu == 0){
                      ?>
                      <span class="text-danger"><i class="fas fa-exclamation-circle"></i> İptal edildi.</span>
                      <?php
                    }else{
                         



                      if($istek->sorumlu_onay_durumu == 1){
                        if($istek->insan_kaynaklari_onay_durumu == 0){

                          if($ik_onay_yetki){
                            ?>
                            <button onclick="confirm_ticket_success_action('İzin Durumunu Onayla','Seçilen bu izin talebini onaylamak istediğinize emin misiniz ?','Onayla','<?=base_url('izin/ik_onayla/').$istek->izin_talep_id?>');" style="margin-top:2px;    padding-right: 10px;font-size:13px !important;" type="button" class="btn btn-xs btn-success-dark"><i class="fas fa-check"></i> ONAYLA</button>
                       <button onclick="confirm_ticket_danger_action('İzin Talebini Reddet','Seçilen bu izin talebini reddetmek istediğinize emin misiniz ?','Reddet','<?=base_url('izin/ik_reddet/').$istek->izin_talep_id?>');" style="margin-top:2px;font-size:13px !important;" type="button" class="btn btn-xs btn-danger-dark"><i class="fas fa-arrow-circle-right"></i> REDDET</button>
                      <?php
                          }else{
                            ?>
                              <button onclick="confirm_ticket_success_action('İstek Durumunu Onayla','Seçilen bu isteği onaylamak istediğinize emin misiniz ?','Onayla','<?=base_url('istek/onayla/').$istek->izin_talep_id?>');" style="margin-top:2px;    padding-right: 10px;font-size:13px !important;" type="button" class="btn btn-xs btn-warning-dark"><i class="fas fa-spinner"></i> Onay Bekleniyor</button>
                            <?php
                          }

                          
                          
                        }elseif($istek->insan_kaynaklari_onay_durumu == 1){
                          ?>
                            
                            <button style="margin-top:2px;    padding-right: 10px;font-size:13px !important; background:transparent!important;color:green!important" type="button" class="btn btn-xs btn-success-dark"><i class="fas fa-check"></i> ONAYLANDI</button>
                      
                          
                          <?php
                        }elseif($istek->insan_kaynaklari_onay_durumu == 2){
                          ?>
                         <button style="margin-top:2px;    padding-right: 10px;font-size:13px !important; background:transparent!important" type="button" class="btn btn-xs btn-danger-dark"><i class="fas fa-times"></i> REDDEDİLDİ</button>  <?php
                        }
                      
                      }elseif($istek->sorumlu_onay_durumu == 0){
                        ?>
                          
                          <button onclick="confirm_ticket_success_action('İstek Durumunu Onayla','Seçilen bu isteği onaylamak istediğinize emin misiniz ?','Onayla','<?=base_url('istek/onayla/').$istek->izin_talep_id?>');" style="margin-top:2px;    padding-right: 10px;font-size:13px !important;" type="button" class="btn btn-xs btn-warning-dark"><i class="fas fa-spinner"></i> Birim Sorumlu Onayı Bekleniyor</button>
                        
                        
                        <?php
                      }elseif($istek->sorumlu_onay_durumu == 2){
                        ?>
                          
                          <span class="text-danger"> REDDEDİLDİ (Sorumlu Tarafından)</span>
                        
                        <?php
                      }
                      
                      else{
                        ?>
                        
                       
                        
                        <?php
                      }}
                     ?>
                     
                    </td>
                      <td>
                    <?php
                    
                    if($istek->izin_durumu == 0){
                      ?>
                      <span class="text-danger"><i class="fas fa-exclamation-circle"></i> İptal edildi.</span>
                      <?php
                    }else{
                        ?>

                        <a href="<?=site_url("izin/edit/$istek->izin_talep_id")?>" type="button" style="min-width:33%" class="btn btn-warning btn-xs"><i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> </a>
                        <a href="<?=site_url("izin/edit/$istek->izin_talep_id")?>" type="button" style="min-width:33%" class="btn btn-dark btn-xs"><i class="fa fa-print" style="font-size:12px" aria-hidden="true"></i> </a>
                        <a href="<?=base_url('izin/izin_iptal/').$istek->izin_talep_id?>"   type="button" style="min-width:33%" class="btn btn-danger btn-xs"><i class="fa fa-times" style="font-size:12px" aria-hidden="true"></i> İptal</a>
                                                

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

            <style>
              .swal2-title{
                line-height: 0.89 !important;
                display: block;
    background: #f7f7f7;
    padding-bottom: 30px;
              }

              div:where(.swal2-container) div:where(.swal2-popup){
                width:auto;
                min-width:22em;
              }
              </style>