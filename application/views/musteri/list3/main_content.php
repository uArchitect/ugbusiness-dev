 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
 
<section class="content text-md">
<div class="card card-dark" style="border-radius:0px !important;">
              <div class="card-header" style="background:#00264f!important">
              <h3 class="card-title"><strong>UG Business</strong> - Müşteri Bilgileri</h3>
                <a href="<?=base_url("musteri/ekle")?>" onclick="waiting('Yeni Müşteri Ekle');" type="button" class="btn btn-primary btn-sm" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Kayıt Ekle</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table text-xs table-bordered table-striped nowrap">
                  <thead>
                  <tr>
                    <th style="width: 42px;">ID</th> 
                  
                     <th>Müşteri Adı</th>
                     <th>Merkez Bilgisi</th>
                     <th>Adres</th>
                    <th>İletişim Numarası</th>
                    <th style="width: 130px;">İşlem</th> 
                  </tr>
                  </thead>
                  <tbody>

                    <?php $count=0;  foreach ($musteriler as $musteri) : ?>
                      <?php $count++?>
                    <tr>
                      <td> <span style="opacity:0.5"><?=$musteri->musteri_kod?></span></td> 
                     
                      <td>
                      <i class="fas fa-user-circle" style="margin-right:2px; "></i> 
                      <a style="   color:#000000;" class="custom-href" href="<?=base_url("musteri/profil/".$musteri->musteri_id)?>">
                     <b>
                      <?=$musteri->musteri_ad?></b>
                    </a>
                    </td>
                    <td >
                        <i class="fas fa-building" style="margin-right:2px "></i>
                        <?=$musteri->merkez_adi?>
                       </td>
                      <td >
                          <b style="color: #00750a;background: #eeffee;padding: 2px 9px;border-radius: 22px;border: 1px solid #14751a;font-size: 15px;"><i class="fas fa-map-marker-alt"></i> <?=$musteri->ilce_adi?> <?=($musteri->sehir_adi != "") ? " / ".$musteri->sehir_adi : ""?></b>
                      </td>
                      <td>
                        <i class="fas fa-mobile-alt" style="margin-right:2px "></i>
                        <?=$musteri->musteri_iletisim_numarasi?>

                      </td>
                     
                      <td>
                      <a href="<?=site_url("cihaz/cihaz_tanimlama_view/".$musteri->merkez_id)?>" onclick="waiting('Yeni Cihaz Tanımla');" type="button" class="btn btn-primary btn-xs"><i class="fa fa-plus-circle" style="font-size:12px" aria-hidden="true"></i> Cihaz Tanımla</a>
                     <a href="<?=site_url("musteri/profil/$musteri->musteri_id")?>" type="button" class="d-none btn btn-primary btn-xs"><i class="fa fa-user-circle" style="font-size:12px" aria-hidden="true"></i> Profili Görüntüle</a>
                         
                          <a href="<?=site_url("musteri/duzenle/$musteri->musteri_id")?>" onclick="waiting('Müşteri Bilgilerini Düzenle');" type="button" class="btn btn-warning btn-xs"><i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> Düzenle</a>
                          <a type="button" onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu kaydı silmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Onayla','<?=base_url('musteri/sil/').$musteri->musteri_id?>');" class="btn btn-danger btn-xs"><i class="fa fa-times" style="font-size:12px" aria-hidden="true"></i> Kayıt Sil</a>
                        
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
     .table th {
    background: #ffffff !important;
    color: #0a0a0a!important;
    padding: 10px!important;
    padding-left: 10px !important;
}
  .custom-href:hover {
        text-decoration: underline;
      }

 </style>