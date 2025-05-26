<div class="content-wrapper" style="zoom: 0.990; padding-left:2px; <?=$pageformat == "1" ? "margin-left:0px!important;":""?>">
  <section class="content col" style="padding: 2px;padding-top: 0;">
     <div class="card card-dark" style=" margin-bottom: 2px;border-radius:0px;">
       <div class="card-header with-border" style="background:#061f3a;    padding: 8px;">
          
       <h3 class="card-title" style="color: #6bc0ff;width: 710px;">
       <div class="row">
       <div class="col" style="max-width: 267px !important;padding: 0;display: flex;">
        <a href="<?=base_url("servis")?>" class="btn btn-warning " style="color: white;background: #147321;border: 0px;height: 37px;padding-top: 8px;">
        <i class="fas fa-arrow-circle-left"></i> Tüm Servisler</a>
      
      </div>


        <div class="col">
        SERVİS - <?=$servis->servis_kod?><br>
            <span style="font-size:13px;color: #ffffff;">
                  <i class="fa fa-user-circle"></i> Oluşturan Kullanıcı : <?=$servis->kullanici_ad_soyad?>                  <i class="far fa-calendar-alt ml-2"></i> Kayıt Tarihi : <?=date("d.m.Y H:i",strtotime($servis->servis_kayit_tarihi))?>                <span>
                </span>
        </div>
       </div>
         
          </h3>
       
        <div class="card-tools">
        <a href="<?=base_url("servis/servis_detay/".$servis->servis_id)?>" class="btn btn-warning" style="color: white;background: #0a376b;border: 0px;height: 37px;padding-top: 8px;    margin-right: 4px;"><i class="fas fa-sync-alt"></i></a>
      
          <a href="<?=base_url("servis/servis_detay/".$servis->servis_id)?>" class="btn btn-success <?=((!empty($filter))?"":"d-none")?>" style="height: 37px;padding-top: 8px;    margin-right: 8px;"><i class="fas fa-arrow-circle-left"></i> SERVİS İŞLEM SAYFASINA GİT</a>
          <a href="?filter=duzenle" class="btn btn-warning <?=((!empty($filter))?"d-none":"")?>" style="color: white;background: #0a376b;border: 0px;height: 37px;padding-top: 8px;    margin-right: 8px;"><i class="far fa-edit"></i> SERVİS BİLGİLERİNİ DÜZENLE</a>
        </div>
        </div>
        <div class="card-body" style="padding-bottom: 0px;padding-top: 1px; padding-left: 1px; padding-right: 1px;">
        




        <div class="row">
          <div class="col-lg-3 col-6" style="padding: 0px;">
            <div class="small-box bg-success" style="    margin-bottom: 2px !important; border-radius: 0px;background: #103869!important;">
              <div class="inner">
                <h3><?=count($gecmis_servisler)?>
                </h3>
                <p>Toplam Servis Sayısı</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?=base_url("servis/servis_detay/".$servis->servis_id)?>" class="small-box-footer" style="background-color: rgb(0 0 0 / 29%);">Tüm Servisleri Görüntüle <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>  
          <div class="col-lg-3 col-6" style="padding: 0px;padding-left: 2px;">
            <div class="small-box bg-success" style=" margin-bottom: 2px !important;border-radius: 0px;background: #103869!important;">
              <div class="inner">
                <h3><?=count($servis_islemleri)?>
                </h3>
                <p>Servis İşlem Sayısı</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?=base_url("servis/servis_detay/".$servis->servis_id)?>" class="small-box-footer" style="background-color: rgb(0 0 0 / 29%);">Tüm İşlemleri Görüntüle <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>  
          <div class="col-lg-3 col-6" style="padding: 0px;padding-left: 2px;">
            <div class="small-box bg-success" style=" margin-bottom: 2px !important;border-radius: 0px;background: #103869!important;">
              <div class="inner">
                <h3><?=($atis_yukleme_sayisi) ? $atis_yukleme_sayisi : "0"?>
                </h3>
                <p>Toplam Atış Sayısı</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?=base_url("servis/servis_detay/".$servis->servis_id)."?atis_filter=1"?>" class="small-box-footer" style="background-color: rgb(0 0 0 / 29%);">Tüm Atışları Görüntüle <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>  
          <div class="col-lg-3 col-6" style="padding: 0px;padding-left: 2px;">
            <div class="small-box bg-success" style=" margin-bottom: 2px !important;border-radius: 0px;background: #103869!important;">
              <div class="inner">
                <h3><?=date("d.m.Y H:i",strtotime($servis->servis_kayit_tarihi))?>
                </h3>
                <p>Servis Başlatılma Tarihi</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer" style="background-color: rgb(0 0 0 / 29%);"> 



<?php 


$tarih1 = new DateTime(date("Y-m-d H:i:s"));

 
$tarih2 = new DateTime(date("Y-m-d H:i:s",strtotime($servis->servis_kayit_tarihi)));

 
$fark = $tarih1->diff($tarih2);

 
$gun = $fark->days;
$saat = $fark->h;
$dakika = $fark->i;

echo "<span><b>$gun</b> gün, <b>$saat</b> saat, <b>$dakika</b> dakika önce</span>";

?>


              
              </a>
            </div>
          </div>  
    </div>





    <div class="row">

  <div class="col-12 col-sm-6" style="padding: 0;">
    <div class="info-box bg-light" style="    margin-bottom: 0px;border-radius: 0px;background: #0e2849 !important;">
      <div class="info-box-content">
      <span class="info-box-text text-white text-center text-muted"  style=" color: #8f8f8f !important; font-weight: 400; /* background: #1a375b; */ ">
        CİHAZ BİLGİLERİ
      </span>
        <span class="info-box-number text-white text-center text-muted mb-0">
        <i class="fas fa-box text-success"></i> Ürün Adı : <span style="font-weight:normal"><?=$cihaz->urun_adi?></span>
        <i class="fas fa-qrcode text-success ml-2"></i> Seri No : <span style="font-weight:normal"><?=$cihaz->seri_numarasi?></span>
        <br>  <i class="far fa-calendar-alt text-success ml-2"></i> Garanti Bilgileri : <span style="font-weight:normal"><?=date("d.m.Y",strtotime($cihaz->garanti_baslangic_tarihi))?> / <?=date("d.m.Y",strtotime($cihaz->garanti_bitis_tarihi))?></span>
     
      </span>
      </div>
    </div>
  </div>
  <div class="col-12 col-sm-6" style="padding: 0;padding-left: 2px;">
    <div class="info-box bg-light" style="    margin-bottom: 0px;border-radius: 0px;background: #0e2849 !important;">
      <div class="info-box-content">
      <span class="info-box-text text-white text-center text-muted"  style=" color: #8f8f8f !important; font-weight: 400; /* background: #1a375b; */ ">
        
        <?php 
        if($cihaz->musteri_degisim_aciklama == ""){
          echo "MÜŞTERİ BİLGİLERİ";
        }else{
          echo "<span class='yanipsonenyazi' style='padding: 10px;color:white;background:#9d0000'>".$cihaz->musteri_degisim_aciklama."</span>";
        }
        
        ?>
      </span>
        <span class="info-box-number text-white text-center text-muted mb-0">
        <i class="fa fa-user-circle text-success"></i> Müşteri : <span style="font-weight:normal"><?=$cihaz->musteri_ad?></span>
        <i class="fas fa-qrcode text-success ml-2"></i> Merkez : <span style="font-weight:normal"><?=$cihaz->merkez_adi?></span>
        <i class="fas fa-phone text-success ml-2"></i> İletişim : <span style="font-weight:normal"><?=$cihaz->musteri_iletisim_numarasi?></span>
        
        <br>
        <span style="font-weight:normal"><?=$cihaz->merkez_adresi?></span>

        </span>
      </div>
    </div>
  </div>


</div>
 







        </div>
      </div>
   




<div class="row">
  <div class="col-3" style="    padding: 0;">





<?php if(!empty($guncellenecek_islem)): ?>

  <div class="card card-warning" style=" margin-bottom: 2px;">
          <div class="card-header with-border" style="border-radius: 0px;">
          <h3 class="card-title text-center">
          <i class="fas fa-pencil-alt"></i> İŞLEM BİLGİLERİNİ DÜZENLE
          </h3>
          </div>
          <div class="card-body">

          <form action="<?=base_url("servis/servis_islem_guncelle/".$servis->servis_id."/".$guncellenecek_islem->servis_islem_id)?>" method="POST">
              <div class="form-group">
                <label for="formClient-Code"> Servis İşlem </label>
                <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
                <select name="servis_islem_tanim_id" id="servis_islem_tanim_id" required class="select2 form-control rounded-0" style="width: 100%;">
                  <option value="">İşlem Seçiniz</option>
                  <?php 
                    foreach ($servis_islem_kategorileri as $islem_kategori) {
                  ?>
                    <option value="<?=$islem_kategori->servis_islem_kategori_id ?>" <?=($guncellenecek_islem->servis_islem_tanim_id  == $islem_kategori->servis_islem_kategori_id)?"selected='selected'":""?>><?=$islem_kategori->servis_islem_kategori_adi?></option>
                  <?php
                    }
                  ?>
                </select>   
              </div>
              <div class="form-group">
                <label for="formClient-Code"> Servis İşlem Açıklama </label>
                <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*İsteğe Bağlı)</label>
                <textarea type="text" class="form-control mb-2" name="servis_islem_aciklama" placeholder="İşlem açıklamasını giriniz..."><?=$guncellenecek_islem->servis_islem_aciklama?></textarea>
              
              </div>
              <button class="btn btn-warning" type="submit"><i class="far fa-save"></i> Bilgileri Güncelle</button>
           
              <a href="<?=base_url("servis/servis_detay/".$servis->servis_id)?>" class="btn btn-danger"><i class="fa fa-times"></i> İptal</a>
           
            </form>


          </div>
        </div>
        <?php endif; ?>









        <?php if(empty($guncellenecek_islem)): ?>

  <div class="card card-dark <?=(!empty($filter) ? "d-none":"")?>" style=" margin-bottom: 2px;">
          <div class="card-header with-border" style="border-radius: 0px;background:#007317">
          <h3 class="card-title text-center">
          <i class="fas fa-folder-plus"></i> YENİ SERVİS İŞLEMİ TANIMLA
          </h3>
          </div>
          <div class="card-body">

          <form action="<?=base_url("servis/servis_islem_tanimla/".$servis->servis_id)?>" method="POST">
              <div class="form-group">
                <label for="formClient-Code"> Servis İşlem </label>
                <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
                <select name="servis_islem_tanim_id" id="servis_islem_tanim_id" required class="select2 form-control rounded-0" style="width: 100%;">
                  <option value="">İşlem Seçiniz</option>
                  <?php 
                    foreach ($servis_islem_kategorileri as $islem_kategori) {
                  ?>
                    <option value="<?=$islem_kategori->servis_islem_kategori_id ?>"><?=$islem_kategori->servis_islem_kategori_adi?></option>
                  <?php
                    }
                  ?>
                </select>   
              </div>
              <div class="form-group">
                <label for="formClient-Code"> Yeni Takılan Parça Seri No: </label>
                <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*İsteğe Bağlı)</label>
                <input type="text" class="form-control mb-2" name="servis_parca_seri_no" placeholder="Parça seri numarasını giriniz..."></textarea>
              
              </div>

              <div class="form-group">
                <label for="formClient-Code"> İşlem Ücreti: </label>
                <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*İsteğe Bağlı)</label>
                <input type="text" class="form-control mb-2" name="servis_islem_ucreti" placeholder="İşlem ücretini giriniz..."></textarea>
              
              </div>

              <div class="form-group">
                <label for="formClient-Code"> Servis İşlem Açıklama </label>
                <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*İsteğe Bağlı)</label>
                <textarea type="text" class="form-control mb-2" name="servis_islem_aciklama" placeholder="İşlem açıklamasını giriniz..."></textarea>
              
              </div>
              <button class="btn btn-success" type="submit"><i class="far fa-save"></i> İşlemi Kaydet</button>
            </form>


          </div>
        </div>

        <?php endif; ?>






  <div class="card card-dark <?=(!empty($filter) ? "d-none":"")?>" style="margin-bottom: 2px;    border-radius: 0px;">
          <div class="card-header with-border" style="border-radius: 0px;background:#061f3a">
          <h3 class="card-title text-center">
          <i class="fas fa-history"></i> CİHAZ ESKİ SERVİS KAYITLARI
          </h3>
          </div>
          <div class="card-body" style="min-height: 230px;max-height: 200px; overflow-y: scroll;">

         


          <?php 
          $servis_count = 0;
foreach ($gecmis_servisler as $gservis) {
  if($gservis->servis_id == $servis->servis_id){
      continue;
  }
  $servis_count++;
  ?>
    <a type="button" href="<?=base_url("servis/servis_detay/".$gservis->servis_id)?>" class="btn btn-default btn-block">
      <b><?=$gservis->servis_kod?></b> - <?=date("d.m.Y H:i",strtotime($gservis->servis_kayit_tarihi))?>
</a>  
  <?php
}
?>  

<?php 
      if($servis_count == 0){
        ?>
     
<div class="text-center">

<img width="110" style="margin:auto;margin-bottom:10px;" src="https://ugbusiness.com.tr/assets/dist/img/empty-place-holder2.png">      
          <h4 style="font-size:20px;color:#134b98ad;font-weight:bolder">Servis Bulunamadı</h4>
          <h5 style="margin:auto;margin-bottom:30px;max-width:450px;font-size:11px;color:#00449957"><?=$cihaz->seri_numarasi?> seri nolu <?=$cihaz->urun_adi?> adlı cihaza tanımlı eski servis kaydı bulunamadı.</h5>
      
</div>
      
       
     <?php
      }
      
      ?>



          </div>
        </div>
     





  <div class="card card-dark <?=(!empty($filter) ? "d-none":"")?>" style="margin-bottom: 2px;    border-radius: 0px;">
     
 <div class="card-header with-border" style="border-radius: 0px;background:#061f3a">
          <h3 class="card-title text-center">
          <i class="fas fa-history"></i> CİHAZA TANIMLI STOK KAYITLARI
          </h3>
          </div>
          <div class="card-body" style="min-height: 230px;max-height: 600px; overflow-y: scroll;">



            
          <?php 

foreach ($cstoklar as $stok) {
 ?>
<div class="form-group mt-2">
        <label for="exampleInputFile"><?=$stok->stok_tanim_ad?> / <span class="text-danger" style="font-weight:normal"><b>Tanımlama Tarihi :</b> <?=(date("d.m.Y H:i",strtotime($stok->cihaz_tanimlama_tarihi)) == "25.07.2024 09:54") ? "-" : date("d.m.Y H:i",strtotime($stok->cihaz_tanimlama_tarihi) )?></span></label>
        <div class="input-group input-group-xl">
        <div class="input-group-prepend">
<span class="input-group-text"><i class="fas fa-microchip"></i></span>
</div>
<input type="text" disabled value="<?=$stok->stok_seri_kod?>" class="form-control">
<span class="input-group-append">
<button type="button" onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu stoğun <?=$cihaz->seri_numarasi?> seri numaraları cihaz tanımı sıfırlanacaktır ? İlgili stok daha sonra başka cihaza tanımlanmak üzere beklemeye alınacaktır. İşlemi onaylıyor musunuz ?','Onayla','<?=base_url('cihaz/cihaz_havuz_stok_sil/').$stok->stok_id?>');" class="btn btn-danger btn-flat" style="    border-radius: 0 5px 5px 0;">Kayıt Sil</button>
</span>
</div>
      </div>
 <?php
}

?>





   
  </div>     
   
  </div>     


  </div>

  <div class="col-3 <?=(empty($_GET["atis_filter"]) ? "d-none":"")?>" style="    padding: 0;padding-left:2px;">





  <div class="card card-dark" style="margin-bottom: 2px;    border-radius: 0px;">
          <div class="card-header with-border" style="border-radius: 0px;background:#970101">
          <h3 class="card-title text-center">
          <i class="fas fa-download"></i> CİHAZ ATIŞ YÜKLEMELERİ
          </h3>
          </div>
          <div class="card-body text-center" style="min-height: 522px;">

          

          <?php 
      if(count($atis_yuklemeleri)==0){
        ?>
         <img width="170" style="margin:auto" src="https://ugbusiness.com.tr/assets/dist/img/empty-place-holder.png">      
          <h4 style="font-size:15px;color:#e78301;font-weight:bolder">Geçmiş Atış Yüklemeleri</h4>
          <h5 style="margin:auto;margin-bottom:30px;max-width:450px;font-size:13px;color:#edaf56"><?=$cihaz->seri_numarasi?> seri nolu <?=$cihaz->urun_adi?> adlı cihaza tanımlı geçmiş atış yükleme kaydı bulunamadı.</h5>
        <?php
      }
      
      ?>

<?php 
foreach ($atis_yuklemeleri as $atis) {
  ?>
    <button type="button" class="btn btn-default btn-block">
      <b><?=$atis->servis_atis_kod?></b> - <?=date("d.m.Y",strtotime($atis->servis_atis_yukleme_tarihi))?>
      </button>  
  <?php
}
?>





          </div>
        </div>
     






  </div>

  <div class="col" style="padding: 0px;
    padding-left: 2px;">




      <div class="card card-dark <?=(!empty($filter) ? "d-none":"")?>" style="      margin-bottom: 5px;  border-radius: 0px; ">
          <div class="card-header with-border" style="   padding: 5px;  padding-right: 15px;   border-radius: 0px;background:#094a9b">
          <h3 class="card-title text-center" style="margin-top: 6px;">
          <i class="fas fa-tools"></i> SERVİS İŞLEMLER
          </h3>
          <div class="card-tools">
          <a class="btn btn-warning btn-sm" style="color:black" href="?filter=duzenle"><i class="fas fa-exclamation-triangle"></i> 
          <?php 
          if(count($servis_bildirimleri)>0){
            echo "<b>SORUN : </b>".$servis_bildirimleri[0]->servis_sorun_kategori_adi;
          }else{
            echo "SERVİS SORUN BİLGİSİ GİRİLMEDİ";
          }
          ?>
        </a>
             
            <?php 
            if(count($servis_gorevleri) <= 0){
              ?>
              <a class="btn btn-danger btn-sm" href="?filter=duzenle"><i class="fas fa-exclamation-triangle"></i> Teknisyen Tanımlanmadı</a>
              <?php
            }else{
              ?>
              <a class="btn btn-success btn-sm" href="?filter=duzenle"><i class="fas fa-users-cog"></i>
              <b>Teknisyen : </b>
               <?php
               foreach ($servis_gorevleri as $gorev) {
               echo $gorev->kullanici_ad_soyad." ";
               }
               ?>
              
              </a>
              <?php
            }
            ?>
          </div>
          </div>
          <div class="card-body" style="min-height: 483px;max-height: 483px; overflow-y: scroll;">




          <?php 
if(!empty($query_result)){
  $output="";
foreach ($query_result as $row) {
  $output .= "<b>Fixidesk Servis ID:</b> " . $row->eski_servis_id ." / ". $row->eski_servis_seri_numarasi ." / " . $row->eski_servis_merkez_adi ." / ". $row->eski_servis_iletisim_numarasi ." / ". $row->eski_servis_kayit_tarihi ." / ".$row->eski_servis_kapatma_tarihi. "<br>";
$output .= "<b>Fixidesk Servis Sorun Bildirimi:</b> " . $row->eski_servis_sorun . "<br>";
$output .= "<b>Fixidesk Servis İşlemler:</b> " . $row->eski_servis_islem . "<br>";
}
echo "<span style='background: #3f00ff0d; display: flow; border: 3px solid #584592; border-radius: 10px; padding: 10px; color: #584592; margin-bottom: 10px;'><img src='".base_url("assets/dist/img/fixidesk.png")."' style=' width: 150px; display: block; margin-bottom: 10px; '>".$output."</span>";

}
?>





          

            <table class="table text-md table-bordered table-striped nowrap" style="zoom:0.85">
              <thead>
                <tr>
                  <th><i class="far fa-user"></i> İşlem Detayı</th>
                  <th style="width:220px"><i class="far fa-calendar-alt"></i> İşlem Tarihi</th>
                  <th><i class="far fa-comment-dots"></i> İşlem Açıklaması</th>
                  <th style="width:275px"><i class="fas fa-tasks"></i> İşlem</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                foreach ($servis_islemleri as $islem) {
                  ?>

                    <tr>   
                      <td>
                        <b><?=$islem->servis_islem_kategori_adi?></b>
                        <?php if($islem->servis_parca_seri_no) echo "<br> <span style='color:#00830e'>Yeni Parça Seri No :</span> ".$islem->servis_parca_seri_no?>
                      </td>

                  
                      <td>
                      <?=date("d.m.Y H:i:s",strtotime($islem->servis_islem_kayit_tarihi))?>
                      </td>
                      <td> <?=($islem->servis_islem_aciklama != "") ? $islem->servis_islem_aciklama : "<span style='opacity:0.6'>İşlem Açıklaması Girilmedi.</span>"?></td>
                      <td>
                      <a href="<?=base_url("servis/servis_detay/".$servis->servis_id."/".$islem->servis_islem_id)?>" class="btn btn-dark" ><i class="fas fa-edit"></i> İşlemi Düzenle</a>
                        <button class="btn btn-danger" <?=($servis->servis_durum_tanim_id == 2)?"disabled":""?> onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu işlem kaydını silmek istediğinize emin misiniz? Bu işlem geri alınamaz.','Onayla','<?=base_url('servis/servis_islem_sil/'.$servis->servis_id.'/'.$islem->servis_islem_id )?>');"><i class="fas fa-user-times"></i> İşlemi Sil</button>
                      </td>
                  
                    </tr>

                  <?php
                }
                ?>
                
              </tbody>
            </table>


            <?php 
      if(count($servis_islemleri)==0){
        ?>
        <div class="text-center" style="margin-top: 110px;">

      
         <img width="110" style="margin:auto;margin-bottom:10px;" src="https://ugbusiness.com.tr/assets/dist/img/empty-place-holder2.png">      
          <h4 style="font-size:25px;color:#134b98ad;font-weight:bolder">İşlem Bulunamadı</h4>
          <h5 style="margin:auto;margin-bottom:30px;max-width:450px;font-size:16px;color:#00449957"><?=$cihaz->seri_numarasi?> seri nolu <?=$cihaz->urun_adi?> adlı cihaza tanımlı servis işlem kaydı bulunamadı.</h5>
          </div>
     <?php
      }
      
      ?>



          </div>




        </div>
     







        <div class="btn-group <?=(!empty($filter) ? "d-none":"")?>" style="margin-left:2px;">
        
<a type="button" href="<?=base_url("servis/servis_sonlandir/".$servis->servis_id)?>"  class="btn btn-danger <?=($servis->servis_durum_tanim_id == 2) ? "disabled" : ""?>"><i class="fas fa-stop-circle"></i> Servisi Sonlandır</a>
<a type="button" href="<?=base_url("servis/servis_devam_ettir/".$servis->servis_id)?>"  class="btn btn-success <?=($servis->servis_durum_tanim_id == 1) ? "disabled" : ""?>"><i class="fas fa-play-circle"></i> Servisi Devam Ettir</a>
<a type="button" target="_blank" href="<?=base_url("servis/servis_rapor/".$servis->servis_id)?>" class="btn btn-warning"><i class="fas fa-file-signature"></i> Servis İşlem Raporu</a>
<?php 
if($servis->servis_durum_tanim_id == 2){
?>
<a type="button" class="btn btn-default"><i class="fas fa-info-circle"></i> Bu servis kaydı <b><?=date("d.m.Y H:i",strtotime($servis->servis_durum_guncelleme_tarihi))?></b> tarihinde <b><?=get_yonlendiren_kullanici($servis->servis_durum_guncelleyen_kullanici_id)->kullanici_ad_soyad?></b> tarafından sonlandırılmıştır. </a>

<?php
}
?>
</div>




        
     




  </div>
</div>









<div class="card card-dark  mt-2 <?=(empty($filter) ? "d-none":"")?>" style="margin-top: 0px !important;    margin-bottom: 2px; ">
  <div class="card-header with-border" style="background:#143967;">
  <h3 class="card-title text-center" >
    SERVİS BİLGİLERİNİ DÜZENLE
  </h3>
  </div>
  <div class="card-body">

  
<form action="<?=base_url("servis/servis_bilgi_guncelle/".$servis->servis_id)?>" method="POST">








<div class="row">



<div class="col" style="padding-left: 0;">
    <div class="form-group">
        <label for="formClient-Code"><i class="fas fa-question-circle text-primary"></i> Servis Türü</label>
        <select class="form-control select2" name="servis_bildirim_tanim_no" data-select2-id="1">
              <?php 
              foreach ($bildirimler as $bildirim) {
                ?>
                <option value="<?=$bildirim->servis_bildirim_kategori_id?>" <?=($servis->servis_bildirim_tanim_no == $bildirim->servis_bildirim_kategori_id) ? "selected='selected'":""?>><?=$bildirim->servis_bildirim_kategori_adi?></option>
                <?php
              }
              ?>
            </select>
</div>
    </div>

    


<div class="col">
    <div class="form-group">
        <label for="formClient-Code"><i class="fas fa-question-circle text-primary"></i> Servis Tipi</label>
        <select class="form-control select2" name="servis_tip_tanim_no" data-select2-id="6">
              <?php 
              foreach ($servis_tipleri as $servis_tip) {
                ?>
                <option value="<?=$servis_tip->servis_tip_id?>" <?=($servis->servis_tip_tanim_no == $servis_tip->servis_tip_id) ? "selected='selected'":""?>><?=$servis_tip->servis_tip_adi?></option>
                <?php
              }
              ?>
            </select>
</div>
    </div>
  
    <div class="col" style="padding-right: 0;">
    <div class="form-group">
        <label for="formClient-Code"><i class="fas fa-money-bill-wave text-success"></i> Ödeme Durumu</label>
        <select class="form-control select2" name="servis_odeme_tanim_no" data-select2-id="5">
              <?php 
              foreach ($odeme_durumlari as $odeme_durum) {
                ?>
                <option value="<?=$odeme_durum->servis_odeme_durum_id?>" <?=($servis->servis_odeme_tanim_no == $odeme_durum->servis_odeme_durum_id) ? "selected='selected'":""?>><?=$odeme_durum->servis_odeme_durum_adi?></option>
                <?php
              }
              ?>
            </select>
</div>
    </div>


    
      <div class="col" style="    max-width: 150px;">
      <button class="btn btn-success" style="margin-top: 29px;" type="submit"><i class="far fa-save"></i> Bilgileri Kaydet</button>


      </div>
    </div>







</form>


  </div>
</div>












<div class="card card-dark <?=(empty($filter) ? "d-none":"")?>"  style="margin-top: 2px !important; margin-bottom:2px;">
          <div class="card-header with-border" style="background:#091e39">
          <h3 class="card-title text-center">
            SERVİS BİLDİRİMLERİ
          </h3>
          </div>
          <div class="card-body">

          

          <table id="servisDetaylariTable" class="table text-md table-bordered table-striped nowrap">
      <thead>
        <tr>
          <th style="width:50%"><i class="far fa-user"></i> Bildirim Detay</th>
          <th><i class="far fa-comment-dots"></i> Bildirim Açıklaması</th>
          <th style="width:300px"><i class="fas fa-tasks"></i> İşlem</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        foreach ($servis_bildirimleri as $bildirim) {
          ?>

            <tr>
              <td>
                <?=$bildirim->servis_sorun_kategori_adi?>
              </td> 
              <td> <?=($bildirim->servis_bildirim_aciklama != "") ? $bildirim->servis_bildirim_aciklama : "<span style='opacity:0.6'>Bildirim Açıklaması Girilmedi.</span>"?></td>
 
              <td>
              <a href="<?=base_url("servis/servis_detay/".$servis->servis_id."/"."0"."/"."0"."/".$bildirim->servis_bildirim_id)."?filter=duzenle"?>" class="btn btn-dark"><i class="fas fa-edit"></i> Bilgileri Düzenle</a>
                <button  <?=($servis->servis_durum_tanim_id == 2)?"disabled":""?> class="btn btn-danger" onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu bildirim kaydını silmek istediğinize emin misiniz? Bu işlem geri alınamaz.','Onayla','<?=base_url('servis/servis_bildirim_sil/'.$servis->servis_id.'/'.$bildirim->servis_bildirim_id)?>');"><i class="fas fa-user-times"></i> Bildirimi Sil</button>
              </td>

            </tr>

          <?php
        }
        ?>
        
      </tbody>
    </table>

<div class="row"><?php if(!empty($guncellenecek_bildirim)): ?>

<div class="col <?=(empty($filter) ? "d-none":"")?>" style="padding-left: 0;"> 
    
<div class="card card-warning mt-2" style=" border-radius: 0px;">
  <div class="card-header with-border" style="background: #fdc03514;border: 1px solid #fdc035;border-bottom: 0;">
  <h3 class="card-title text-center">
    SERVİS BİLDİRİMİ DÜZENLE
  </h3>
  </div>
  <div class="card-body" style="border: 1px solid #fdc035;">

  
<form action="<?=base_url("servis/servis_bildirim_guncelle/".$servis->servis_id."/".$guncellenecek_bildirim->servis_bildirim_id)?>" method="POST">
<div class="row pb-2">
<div class="col">
<select class="select2 form-control" name="servis_bildirim_kategori_id" required>
<option value="">Sorun Seçiniz</option>
                 <?php 
         foreach ($sorunlar as $sorun) {
        ?>
        <option value="<?=$sorun->servis_sorun_kategori_id?>" <?=($sorun->servis_sorun_kategori_id == $guncellenecek_bildirim->servis_bildirim_kategori_id)?"selected='selected'":""?>><?=$sorun->servis_sorun_kategori_adi?></option>
        <?php
      }
      ?>
    </select>
</div>
</div>
<div class="row pb-2">

<div class="col">
<input type="text" class="form-control" value="<?=$guncellenecek_bildirim->servis_bildirim_aciklama?>" name="servis_bildirim_aciklama" placeholder="Bildirim açıklamasını giriniz...">
</div>
</div>
<div class="row">

<div class="col">
<button class="btn btn-warning" type="submit" style="width: -webkit-fill-available;"><i class="far fa-save"></i> Bilgileri Güncelle</button>
</div>
<div class="col">
<a href="<?=base_url("servis/servis_detay/".$servis->servis_id)."?filter=duzenle"?>" class="btn btn-danger" type="submit" style="width: -webkit-fill-available;"><i class="far fa-save"></i> İptal</a>
</div>
</div>
</form>


  </div>
</div>



</div><?php endif; ?>
<div class="col <?=(empty($filter) ? "d-none":"")?>" style="padding-right: 0;"> 


<div class="card card-success mt-2" style=" border-radius:0px;">
          <div class="card-header with-border" style="background:#67ff8a2b;    border: 1px solid green; border-bottom:0;">
          <h3 class="card-title text-center" style="color:black;">
            YENİ SERVİS BİLDİRİMİ TANIMLA
          </h3>
          </div>
          <div class="card-body" style="border: 1px solid green;">

          
<form action="<?=base_url("servis/servis_bildirim_tanimla/".$servis->servis_id)?>" method="POST">
<div class="row pb-2">
<div class="col">
<select class="select2 form-control" name="servis_bildirim_kategori_id" required>
<option value="">Sorun Seçiniz</option>
                         <?php 
              foreach ($sorunlar as $sorun) {
                ?>
                <option value="<?=$sorun->servis_sorun_kategori_id?>"><?=$sorun->servis_sorun_kategori_adi?></option>
                <?php
              }
              ?>
            </select>
</div>

</div>
<div class="row pb-2">


<div class="col">
<input type="text" class="form-control" name="servis_bildirim_aciklama" placeholder="Sorun açıklamasını giriniz...">
</div>

</div>
<div class="row">

<div class="col">
<button class="btn btn-success" type="submit" style="width: -webkit-fill-available;"><i class="far fa-save"></i> Servis Bildirimi Kaydet</button>
</div>

</div>
</form>


          </div>
        </div>



        </div>
  
        </div>





          </div>
        </div>










       









      










        <div class="card card-dark <?=(empty($filter) ? "d-none":"")?>" style=" ">
          <div class="card-header with-border" style="background:#061f3a">
          <h3 class="card-title text-center">
            SERVİS TEKNİSYENLERİ
          </h3>
          </div>
          <div class="card-body">

          

          <table id="servisDetaylariTable" class="table text-md table-bordered table-striped nowrap">
      <thead>
        <tr>
          <th style="width:20%"><i class="far fa-user"></i> Teknisyen Ad Soyad</th>
          <th style="width:20%"><i class="far fa-calendar-alt"></i> Tanımlanma Tarihi</th>
          <th><i class="far fa-comment-dots"></i> Görev Açıklaması</th>
          <th style="width:300px"><i class="fas fa-tasks"></i> İşlem</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        foreach ($servis_gorevleri as $gorev) {
          ?>

            <tr>
              <td>
                <?=$gorev->kullanici_ad_soyad?>
              </td>
              <td>
              <?=date("d.m.Y H:i:s",strtotime($gorev->servis_gorev_kayit_tarihi))?>
              </td>
              <td> <?=($gorev->servis_gorev_aciklama != "") ? $gorev->servis_gorev_aciklama : "<span style='opacity:0.6'>Görev Açıklaması Girilmedi.</span>"?></td>
              <td>
              <a href="<?=base_url("servis/servis_detay/".$servis->servis_id."/"."0"."/".$gorev->servis_gorev_id)."?filter=duzenle"?>" class="btn btn-dark"><i class="fas fa-edit"></i> Bilgileri Düzenle</a>
                <button  <?=($servis->servis_durum_tanim_id == 2)?"disabled":""?> class="btn btn-danger" onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu görev kaydını silmek istediğinize emin misiniz? Bu işlem geri alınamaz.','Onayla','<?=base_url('servis/servis_gorev_sil/'.$servis->servis_id.'/'.$gorev->servis_gorev_id)?>');"><i class="fas fa-user-times"></i> Teknisyeni Sil</button>
              </td>
          
            </tr>

          <?php
        }
        ?>
        
      </tbody>
    </table>





<div class="row">
<?php if(!empty($guncellenecek_gorev)): ?>

  <div class="col"  style="padding-left: 0;">

 
<div class="card card-warning mt-2 <?=(empty($filter) ? "d-none":"")?>" style=" ">
  <div class="card-header with-border"  style="background: #fdc03514;border: 1px solid #fdc035;border-bottom: 0;">
  <h3 class="card-title text-center">
    SERVİS KULLANICISI DÜZENLE
  </h3>
  </div>
  <div class="card-body"  style="border: 1px solid #fdc035;">

  
<form action="<?=base_url("servis/servis_gorev_guncelle/".$servis->servis_id."/".$guncellenecek_gorev->servis_gorev_id)?>" method="POST">
<div class="row pb-2">
<div class="col">
<select class="select2 form-control" name="servis_gorev_kullanici_id" required>
<option value="">Teknisyen Seçiniz</option>
                 <?php 
      foreach ($kullanicilar as $kullanici) {
        ?>
        <option value="<?=$kullanici->kullanici_id?>" <?=($kullanici->kullanici_id == $guncellenecek_gorev->servis_gorev_kullanici_id)?"selected='selected'":""?>><?=$kullanici->kullanici_ad_soyad?></option>
        <?php
      }
      ?>
    </select>
</div>
</div>
<div class="row pb-2">

<div class="col">
<input type="text" class="form-control" value="<?=$guncellenecek_gorev->servis_gorev_aciklama?>" name="servis_gorev_aciklama" placeholder="Görev açıklamasını giriniz...">
</div>
</div>
<div class="row">

<div class="col">
<button class="btn btn-warning" type="submit" style="width: -webkit-fill-available;"><i class="far fa-save"></i> Bilgileri Güncelle</button>
</div>
<div class="col">
<a href="<?=base_url("servis/servis_detay/".$servis->servis_id)."?filter=duzenle"?>" class="btn btn-danger" type="submit" style="width: -webkit-fill-available;"><i class="far fa-save"></i> İptal</a>
</div>
</div>
</form>


  </div>
</div>






  </div>

  <?php endif; ?>


  <div class="col"  style="padding-right: 0;">

  <div class="card card-success mt-2 <?=(empty($filter) ? "d-none":"")?>" style=" ">
          <div class="card-header with-border"  style="background:#67ff8a2b;    border: 1px solid green; border-bottom:0px;">
          <h3 class="card-title text-center" style="color:black">
            YENİ SERVİS TEKNİSYENİ TANIMLA
          </h3>
          </div>
          <div class="card-body"  style="border: 1px solid green;">

          
<form action="<?=base_url("servis/servis_gorev_tanimla/".$servis->servis_id)?>" method="POST">
<div class="row pb-2">
<div class="col">
<select class="select2 form-control" name="servis_gorev_kullanici_id" required>
<option value="">Teknisyen Seçiniz</option>
                         <?php 
              foreach ($kullanicilar as $kullanici) {
                ?>
                <option value="<?=$kullanici->kullanici_id?>"><?=$kullanici->kullanici_ad_soyad?></option>
                <?php
              }
              ?>
            </select>
</div>

</div>
<div class="row pb-2">


<div class="col">
<input type="text" class="form-control" name="servis_gorev_aciklama" placeholder="Görev açıklamasını giriniz...">
</div>

</div>
<div class="row">

<div class="col">
<button class="btn btn-success" type="submit" style="width: -webkit-fill-available;"><i class="far fa-save"></i> Teknisyeni Kaydet</button>
</div>
</div>
</form>


          </div>
        </div>


  </div>
</div>












          </div>
        </div>








 


        






       



  </section>
</div>


<script>
  
  function showWindow($url) {
        
        var width = 750;
      var height = 685;

     
      var left = (screen.width / 2) - (width / 2);
      var top = (screen.height / 2) - (height / 2);
      var newWindow = window.open($url, 'Yeni Pencere', 'width=' + width + ',height=' + height + ',top=' + top + ',left=' + left);
      
  };
  </script>

 <style>
  .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    color: #ffffff;
    background-color: #104cbd;
    border-color: #dee2e6 #dee2e6 #fff;
}
.table th {
    background: #ffffff !important;
    color: #174b85;
    padding: 12px;
    padding-left: 10px;
}
.form-control:disabled, .form-control[readonly] {
    background-color: #ffffff;
    opacity: 1;
}

.btn.disabled, .btn:disabled {
    opacity: .35;
    box-shadow: none;
}
.yanipsonenyazi {
      animation: blinker 1s linear infinite;
 
      }
      @keyframes blinker {  
      50% { opacity: 0; }
      }
  </style>

  