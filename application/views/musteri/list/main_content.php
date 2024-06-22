 
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
                <table id="examplemusteriler" class="table table-bordered table-striped nowrap">
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
                      <a style="   color:#000000;" class="custom-href" href="<?=base_url("musteri/profil/".$musteri->musteri_id)?>">
                      <b>
                      <?=$musteri->musteri_ad?></b>
                     <b class="d-none">
                      <?=mb_strtoupper(str_replace('ı', 'I', str_replace('i', 'İ', $musteri->musteri_ad)), 'UTF-8')?></b>
                      <b class="d-none">
                      <?=mb_strtolower(str_replace('I', 'ı', str_replace('İ', 'i', $musteri->musteri_ad)), 'UTF-8')?></b>
                    </a>
                    </td>
                    <td >
                      
                        <?=$musteri->merkez_adi?>
                       </td>
                      <td >
                          <?=$musteri->ilce_adi?> <?=($musteri->sehir_adi != "") ? " / ".$musteri->sehir_adi : ""?>
                      </td>
                      <td>
                        <?=$musteri->musteri_iletisim_numarasi?>

                      </td>
                     
                      <td>
                      <a href="https://ugbusiness.com.tr/cihaz/cihaz_tanimlama_view/<?=$musteri->merkez_id?>" class="text-orange">Cihaz Tanımla</a>
                     
                          <a href="<?=site_url("musteri/duzenle/$musteri->musteri_id")?>" onclick="waiting('Müşteri Bilgilerini Düzenle');" type="button"  >Düzenle</a>
                          
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