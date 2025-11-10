 
 
<div class="content-wrapper" style="padding-top:10px">
 
<section class="content text-md">
<div class="card card-dark" style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong>Destek</strong> - Parametreler - Bordro Yönetimi</h3>
                <a href="<?=base_url("bordro/add")?>" type="button" class="btn btn-primary btn-sm" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Kayıt Ekle</a>
              </div>
              
              <div class="card-body">
                <table id="example1" class="table table-bordered nowrap table-striped">
                  <thead>
                  <tr>
                    <th style="width: 42px;">ID</th> 
                    <th>Belge Türü</th> 
                    <th>Kullanıcı</th> 
                    <th style="width: 180px;">Belge Tarihi</th>
                    <th style="width: 180px;">Yüklenme Tarihi</th>
                    <th style="width: 240px; ">İşlem</th> 
                  </tr>
                  </thead>
                  <tbody>
                    <?php $count=0; foreach ($bordrolar as $bordro) : ?>
                      <?php $count++?>
                    <tr>
                      <td><?=$count?></td> 
                      <td><i class="far fa-file-alt" style="margin-right:5px;opacity:1"></i> 
                       BORDRO 
                    </td>
                      <td><i class="far fa-user" style="margin-right:5px;opacity:1"></i> 
                       <?=$bordro->kullanici_ad_soyad?> / <?=$bordro->kullanici_unvan?>  / <?=$bordro->departman_adi?> 
                    </td>
                      <td >
                        <i class="far fa-calendar" style="margin-right:5px;opacity:0.8"></i>
                     
                        <?php
$aylar = array(1=>"Ocak", 2=>"Şubat", 3=>"Mart", 4=>"Nisan", 5=>"Mayıs", 6=>"Haziran", 7=>"Temmuz", 8=>"Ağustos", 9=>"Eylül", 10=>"Ekim", 11=>"Kasım", 12=>"Aralık");
$sayi = $bordro->bordro_ay; 
echo $aylar[$sayi];
?>
                        
                        
                        / <?=$bordro->bordro_yil?>
 
                      </td>
                      <td><i class="far fa-calendar-plus" style="margin-right:5px;opacity:1"></i> <?=date('d.m.Y H:i',strtotime($bordro->bordro_yuklenme_tarihi));?></td>
                     
                      <td>
                    
                          <a href="<?=site_url("bordro/edit/$bordro->bordro_id")?>" type="button" class="btn btn-warning btn-xs"><i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> Düzenle</a>
                          <a type="button" onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu kaydı silmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Onayla','<?=base_url('bordro/delete/').$bordro->bordro_id?>');" class="btn btn-danger btn-xs"><i class="fa fa-times" style="font-size:12px" aria-hidden="true"></i> Kayıt Sil</a>
                          <a type="button" href="<?=base_url("bordro/bordro_goruntule/".$bordro->bordro_id)?>" target="_blank" class="btn btn-dark btn-xs"><i class="fa fa-eye" style="font-size:12px" aria-hidden="true"></i> Bordro Görüntüle</a>
                        
                      </td>
                       
                    </tr>
                  <?php  endforeach; ?>
                  </tbody>
                   
                </table>
              </div>
             
            </div>
           
</section>
            </div>