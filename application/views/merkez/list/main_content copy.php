 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
 <?php if($siparis_uyari == 1){
?>
<div class="col">
<div class="alert alert-success alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<h5><i class="icon fas fa-info"></i> Yeni Sipariş Oluştur / Merkez Seçimi</h5>
Tüm merkez listesi listelenmiştir. Sipariş oluşturmak için öncelikle listeden merkez seçimi yapmalısınız.
</div>

</div>

<?php
 }
?>
<section class="content text-md">
<div class="card card-dark" style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - Merkez Bilgileri</h3>
               </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped nowrap" style="  white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                  <thead>
                  <tr>
                  <th  style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;   border-bottom:0px solid; width:50px">İşlem</th> 
                
                    <th  style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;   border-bottom:0px solid">Merkez Adı</th>
                      <th  style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;   border-bottom:0px solid">İletişim Numarası</th>
                    <th  style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;   border-bottom:0px solid">Adres</th>
                  </tr>
                  </thead>
                  <tbody style="font-size: small;">
                    <?php $count=0; foreach ($merkezler as $merkez) : ?>
                      <?php $count++?>
                    <tr>
                     
                    <td>
                      <?php if($siparis_uyari == 1){
?>
                     <a href="<?=site_url("siparis/ekle/$merkez->merkez_id")?>" onclick="waiting('Yeni Sipariş Ekle');" type="button" class="btn btn-primary btn-xs"><i class="fa fa-plus-circle" style="font-size:12px" aria-hidden="true"></i> Sipariş Oluştur</a>
                         <?php } ?>
                          
                         <a href="<?=site_url("merkez/duzenle/$merkez->merkez_id")?>" onclick="waiting('Merkez Bilgileri Düzenle');" type="button" class="btn btn-warning btn-xs"><i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> Düzenle</a>
                         

                         <a href="<?=site_url("merkez/kargo_yazdir/$merkez->merkez_id")?>" target="_blank" type="button" class="btn btn-primary btn-xs"><i class="fa fa-print" style="font-size:12px" aria-hidden="true"></i> Kargo Etiket</a>
                         
                      </td>
                      <td><i class="fas fa-building" style="color: #009688;margin-right:2px "></i>
                      <?=($merkez->merkez_adi == "#NULL#") ? "<span class='badge bg-danger'>Merkez Adı Girilmedi</span>":$merkez->merkez_adi?>    
                    /  <?=$merkez->musteri_ad?>
                    </td>
                    

                      <td>
                        <i class="fas fa-mobile-alt" style="margin-right:2px "></i>
                        <?=$merkez->musteri_iletisim_numarasi?>

                      </td>
                      <td>
                        <i class="fas fa-map-marker-alt" style="margin-right:2px "></i>
                        <?=$merkez->merkez_adresi?> <b><?=$merkez->ilce_adi?> / <?=$merkez->sehir_adi?></b>

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







