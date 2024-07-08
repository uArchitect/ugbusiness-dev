 
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
                  return $istek->istek_durum_no == 1;
              }));
              echo $istek_durumu_1_sayisi;
                ?>

                </h3>

                <p>Onay Bekleyen İstekler</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="?filter=1" class="small-box-footer">Onay Bekleyen İstekleri Görüntüle <i class="fas fa-arrow-circle-right"></i></a>
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
                  return $istek->istek_durum_no == 2;
              }));
              echo $istek_durumu_1_sayisi;
                ?>

                </h3>

                <p>Onaylanan İstekler</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="?filter=2" class="small-box-footer">Onaylanan İstekleri Görüntüle <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col pb-0 p-0">
            <!-- small box -->
            <div class="small-box bg-dark mb-2">
              <div class="inner">
                <h3>

                <?php
                $istek_durumu_1_sayisi = count(array_filter($istekler, function($istek) {
                  return $istek->istek_durum_no == 3;
              }));
              echo $istek_durumu_1_sayisi;
                ?>

                </h3>

                <p>İşleme Alınan İstekler</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="?filter=3" class="small-box-footer">İşleme Alınan İstekleri Görüntüle <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
       
          <!-- ./col -->
          <div class="col pb-0 pr-0">
            <!-- small box -->
            <div class="small-box bg-danger mb-2">
              <div class="inner">
                <h3>
                <?php
                $istek_durumu_1_sayisi = count(array_filter($istekler, function($istek) {
                  return $istek->istek_durum_no == 5;
              }));
              echo $istek_durumu_1_sayisi;
                ?>
                </h3>

                <p>Reddedilen İstekler</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="?filter=5" class="small-box-footer">Reddedilen İstekleri Görüntüle <i class="fas fa-arrow-circle-right"></i></a>
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
                $istek_durumu_1_sayisi = count(array_filter($istekler, function($istek) {
                  return $istek->istek_durum_no == 4;
              }));
              echo $istek_durumu_1_sayisi;
                ?>
                </h3>

                <p>Tamamlanan İstekler</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="?filter=4" class="small-box-footer">Tamamlanan İstekleri Görüntüle <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->






        </div>
        <!-- /.row -->



<div class="card card-default" style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - Parametreler - İstek Yönetimi</h3>
                <a href="<?=base_url("istek/ekle")?>" type="button" class="btn btn-primary btn-sm" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Kayıt Ekle</a>
               <?php
                if(!empty($_GET["filter"])){
                    ?>
                    <a href="<?=base_url("istek")?>" type="button" class="btn btn-danger btn-sm mr-2" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-times text-white" style="font-size:12px" aria-hidden="true"></i> Filtrelemeyi kaldır, tüm kayıtları göster  </a>
            
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
                    <th>İstek Adı</th>
                  
                    <th style="width: 160px;">İstek Tarihi</th>
                    <th style="width: 130px;">İstek Durumu</th>
                  
                         <th style="width: 190px;">İşlem</th> 
                    
                  </tr>
                  </thead>
                  <tbody>
                    <?php $count=0; foreach ($istekler as $istek) : ?>
                      <?php if(!empty($_GET["filter"]) && $istek->istek_durum_no != $_GET["filter"] ){continue;} $count++?>
                    <tr>
                      <td><?=$istek->istek_kodu?></td> 
                      <td>  
                      <b>  <?=$istek->istek_adi?> <br>  </b>
                      <i class="far fa-comment-dots" style="margin-right:5px;opacity:1"></i> <?=$istek->istek_aciklama?> 
                      <?=($istek->istek_notu != "") ? "<br><div style=' background: #03ff351c; border: 1px solid #00b324; border-radius: 3px; padding: 2px; color: green; '><b style='color:green;font-weight:500'><i class='fas fa-check-circle'></i> Ergül Kızılkaya : </b>".$istek->istek_notu : "</div>"?>
                    </td>
 
                   


                      
                      <td class="align-items-center;min-height: 100vh">
                        <i class="fa fa-user-circle" style="margin-right:5px;opacity:0.8"></i> 
                        <b><?=$istek->kullanici_ad_soyad?></b>
                        <br>
                        <?=date('d.m.Y H:i',strtotime($istek->istek_kayit_tarihi));?></td>
                      <td>
                    
                      <button type="button" class="btn btn-block btn-xs btn-<?=$istek->istek_durum_renk?>"><?=$istek->istek_durum_adi?></button>
                     <?php
                   if($istek->istek_yonetici_id == aktif_kullanici()->kullanici_id)
                      if($istek->istek_durum_no == 1){
                        ?>
                         <button onclick="confirm_ticket_success_action('İstek Durumunu Onayla','Seçilen bu isteği onaylamak istediğinize emin misiniz ?','Onayla','<?=base_url('istek/onayla/').$istek->istek_id?>');" style="margin-top:2px;    padding-right: 10px;font-size:13px !important;" type="button" class="btn btn-xs btn-success-dark"><i class="fas fa-check"></i> ONAYLA</button>
                         <button onclick="confirm_ticket_danger_action('İsteği Reddet','Seçilen bu isteği reddetmek istediğinize emin misiniz ?','Reddet','<?=base_url('istek/reddet/').$istek->istek_id?>');" style="margin-top:2px;font-size:13px !important;" type="button" class="btn btn-xs btn-danger-dark"><i class="fas fa-arrow-circle-right"></i> REDDET</button>
                        <?php
                      }else if($istek->istek_durum_no == 2){
                        ?>
                          <button onclick="confirm_ticket_start_action('İstek Durumunu İşleme Al','Seçilen bu isteği işleme almak istediğinize emin misiniz ?','Onayla','<?=base_url('istek/islem/').$istek->istek_id?>');" style="margin-top:2px;font-size:13px !important;" type="button" class="btn btn-block btn-xs btn-<?=$istek->istek_durum_renk?>-dark"><i class="fas fa-check"></i> İşleme Al </button>
                       
                        <?php
                      }else{
                        ?>
                          <button onclick="fetchData('<?=base_url('istek/get_ticket_actions/').$istek->istek_id?>','<?=$istek->istek_adi?>','<?=base_url()?>');" style="margin-top:2px;font-size:13px !important;" type="button" class="btn btn-block btn-xs btn-<?=$istek->istek_durum_renk?>-dark"> İstek Hareketleri <i class="fas fa-arrow-circle-right"></i></button>
                       
                        <?php
                      }
                     ?>
                     
                    </td>
               
 <td>
                    <?php 
                      if($istek->istek_yonetici_id == aktif_kullanici()->kullanici_id){
?>
 <a href="<?=site_url("istek/duzenle/$istek->istek_id")?>" type="button" style="min-width:50%" class="btn btn-dark btn-block btn-xs"><i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> Düzenle</a>
                    <a style="0px;min-width:48%" type="button" onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu kaydı silmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Onayla','<?=base_url('istek/sil/').$istek->istek_id?>');" class="btn btn-block btn-dark btn-xs"><i class="fa fa-times" style="font-size:12px;" aria-hidden="true"></i> Kayıt Sil</a>
          
<?php
                      }
                    ?>
                   
                </td>

                     
                       
                    </tr>
                  <?php  endforeach; ?>
                  </tbody>
                  <tfoot>
                  <tr>
                  <th style="width: 42px;">Kod</th> 
                    <th>İstek Adı</th>
                    
                    <th style="width: 130px;">İstek Tarihi</th>
                   
                    <th style="width: 130px;">İstek Durumu</th>
              
                    
                         <th style="width: 190px;">İşlem</th> 
                    
                 
                  </tr>
                  </tfoot>
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