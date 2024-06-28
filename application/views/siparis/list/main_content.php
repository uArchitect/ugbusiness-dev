 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-top:-1px;background:#ffffff;padding-top:10px">
 
<section class="content text-md">

<?php 
    if(empty($onay_bekleyen_siparisler) && empty($siparisler)){
?>
<div class="alert alert-dismissible" style="border: 1px solid #e3e3e1;padding-right:10px;max-width:450px;margin:auto;margin-top:20%;   
">

<h5 style="text-align:center;"><i class="icon fas fa-info-circle mb-2" style="font-size:50px;color:black"></i> <br>Sistem Bilgilendirme
<br><span style="text-align:center;font-weight:normal;font-size:16px"  >Onayda bekleyen sipariş kaydı bulunamadı.Onaya düşen sipariş bilgileri burada görüntülenecektir.</span>

 
</h5>


</div>
<?php
    }

?>



<?php if(!empty($onay_bekleyen_siparisler)) : ?>

<div class="card card-warning" style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - Onay Bekleyen Siparişler</h3>
                 </div>
              <!-- /.card-header -->
              <div class="card-body" style="margin-top: -12px;
    margin-left: -12px;
    margin-right: -12px;">
              <div class="btn-group d-flex">
<a type="button" href="?filter=2" class="btn btn-success" style="font-size: x-large !important;">İşlemde Olan Siparişler</a>
<a type="button" href="?filter=1" class="btn btn-dark" style="font-size: x-large !important;">Beklemede Olan Siparişler</a>
</div>
                <table id="onaybekleyensiparisler" class="table table-bordered table-striped nowrap">
                  <thead>
                  <tr>
                    <th style="width: 42px;">No</th> 
                
                    <th>Müşteri Adı</th>
                    <th>Merkez Detayları</th>
                    <th>Adres</th>
                    <th>İletişim Numarası</th>    
                        <th style="width: 130px;">Sipariş Oluşturan</th>   
                    <th style="width: 130px;">Sipariş Tarihi</th>   
                      <th style="width: 130px;">Son Durum</th>
                    <th style="width: 130px;">Sipariş İşlemleri</th> 
                  </tr>
                  </thead>
                  <tbody>
                    <?php $count=0; foreach ($onay_bekleyen_siparisler as $siparis) : ?>

                      <?php if(!empty($_GET["filter"])){
 if($_GET["filter"] == "1" && $siparis->beklemede == 0){
  continue;
}
if($_GET["filter"] == "2" && $siparis->beklemede == 1){
  continue;
} }
                      ?>

                     
                      <?php $count++; $link = base_url("siparis/report/").urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$siparis->siparis_id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE"));?>
                    <tr onclick="location.href='<?=$link?>';" style="cursor:pointer;">
                      <td><?=$count?></td> 
                      <td>
                        <i class="far fa-user-circle" style="margin-right:1px;opacity:1"></i> 
                        <?=$siparis->musteri_ad?> 
                      </td>
                      <td>
                        <?=($siparis->merkez_adi == "#NULL#") ? "<span class='badge bg-danger'>Merkez Adı Girilmedi</span>":$siparis->merkez_adi?>    
                      </td>
                      <td>
                       
                        <?=$siparis->sehir_adi?> / <?=$siparis->ilce_adi?> 

                     </td>
                      <td>   <?=$siparis->musteri_iletisim_numarasi?> 
                      
 <td> <?=$siparis->kullanici_ad_soyad?></td>
                      
                      <td> <?=date('d.m.Y H:i',strtotime($siparis->kayit_tarihi));?></td>
                      
                        <td>

                        <?php
                        $data = get_son_adim($siparis->siparis_id);
                      //  echo '<span class="badge bg-success" style="background:#072676!important;border-radius: 46%;">'.$data[0]->adim_sira_numarasi.'</span> ';
                        echo $data[0]->adim_adi;

                        ?>
                        </td>
                      
                      <td>
                      <a type="button" href="<?=base_url("siparis/report/").urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$siparis->siparis_id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE"))?>" onclick="waiting('Sipariş Detayları');" class="btn btn-warning btn-xs"><i class="fas fa-search" style="font-size:14px" aria-hidden="true"></i> <b>SİPARİŞİ GÖRÜNTÜLE</b></a>
                        
                         
                      </td>
                       
                    </tr>
                  <?php  endforeach; ?>
                  </tbody>
                  <tfoot>
                  <tr>
                  <th style="width: 42px;">No</th> 
                
                    <th>Müşteri Adı</th>
                    <th>Merkez Detayları</th>
                    <th>Adres</th>
                    <th>İletişim Numarası</th>
                    <th style="width: 130px;">Siparişi Oluşturan</th>
                    <th style="width: 130px;">Sipariş Tarihi</th>
                    <th style="width: 130px;">Son Durum</th>
                    <th style="width: 130px;">Sipariş İşlemleri</th> 
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->




            <?php endif; ?>



            <?php if(!empty($siparisler)) : ?>


<div class="card card-dark" style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - Tüm Siparişler</h3>
                <a href="<?=base_url("siparis/merkez")?>" type="button" class="btn btn-primary btn-sm" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Kayıt Ekle</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body" >
                <table id="example1yonlendirilentablo" class="table table-bordered table-striped nowrap">
                  <thead>
                  <tr >
                
                    <th style="width: 42px;">Sipariş Kodu</th> 
                
                    <th>Müşteri Adı</th> 
                    <th>Adres</th>
                    <th>İletişim Numarası</th>    <th style="width: 130px;">Siparişi Oluşturan</th>
                    <th style="width: 130px;">Sipariş Tarihi</th>
                    <th>İşlem</th> 
                  </tr>
                  </thead>
                  <tbody>
                    <?php $count=0;  foreach ($siparisler as $siparis) : ?>
                      <?php $count++?>
                    <tr <?=($siparis->adim_no>=11) ? "style='background:#d2ffb7;'":''?>>
                 
                      <td style="opacity: 0.6;"><?=$siparis->siparis_kodu?></td> 
                      <td>
                       
                        <strong style="font-weight:500"><?=$siparis->musteri_ad?></strong>  /   <?=($siparis->merkez_adi == "#NULL#") ? "<span class='badge bg-danger'>Merkez Adı Girilmedi</span>":$siparis->merkez_adi?>    
                          <?=($siparis->adim_no>=11) ? "<i class='fas fa-check-circle text-success'></i>":'<span style="margin-left:10px;opacity:0.5">Teslim Edilmedi</span>'?>
                      </td>
                     
                      <td>
                       
                      <strong style="font-weight:500"><?=$siparis->sehir_adi?></strong> / <?=$siparis->ilce_adi?> 

                     </td>
                      <td>   <?=formatTelephoneNumber($siparis->musteri_iletisim_numarasi)?> 
                      
                      <td> <?=$siparis->kullanici_ad_soyad?></td>
                      
                      
                      <td style="opacity: 0.6;"> <?=date('d.m.Y H:i',strtotime($siparis->kayit_tarihi));?></td>
                      
                      
                      <td>
                        <?php 
                       $urlcustom = base_url("siparis/report/").urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$siparis->siparis_id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE"));
                        
                        ?>
                      <a type="button" href="<?=$urlcustom?>"    class="btn btn-warning btn-xs"><i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> Düzenle</a>
                      <a type="button" onclick="showdetail('<?=$urlcustom?>/1');"    class="btn btn-dark btn-xs"><i class="fa fa-search" style="font-size:12px" aria-hidden="true"></i> Görüntüle</a>
                       
                          
                      </td>
                       
                    </tr>
                  <?php  endforeach; ?>
                  </tbody>
                
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

<?php endif; ?>





</section>
            </div>

 <style>
  .table-striped tbody tr:nth-of-type(odd) {
    background-color: rgb(7 38 118 / 13%);
    font-weight:500;
}
  </style>

<style>
       
        .swal2-content iframe {
            width: 90%;
            height: 100%;
            border: none;
        }

        .swal2-html-container{
          height: 690px;
          display: block;
    padding: 0px !important;
    margin: 0px!important;
        }
        .swal2-title{
          display: none!important;
          padding: 0!important;
        }
        .swal2-close{
          background: red!important;
    color: white!important;
        }
    </style>


<script>
   function showdetail(param){
            Swal.fire({
               
                html: '<iframe src="'+param+'" width="100%" height="100%" frameborder="0"></iframe>',
                showCloseButton: true,
                showConfirmButton: false,
                focusConfirm: false,
                width: '80%',
                height: '80%',
            });
        };
      
  </script>