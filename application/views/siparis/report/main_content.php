




<div class="content-wrapper p-0 mt-1"  style="<?=$pageformat == "1" ? "margin-left:0px!important;zoom:0.9":""?>;margin-top:7px!important" >
 
 


<section class="content pr-0 pl-0">
      <div class="container-fluid pr-0 pl-0">
        <div class="row" style="    flex-wrap: wrap-reverse;">

      







          <div class="col-12 " style="flex: 1;">
            <!-- Main content -->
            <div class="invoice p-2 mb-3" style="background:#ffffff">
              <!-- title row -->
              <div class="row" style="background:#011a41;color:white">
                <div class="col-4">
                 <h4 style="margin-top:5px;text-align:left;font-size: 17px;padding-top: 5px;">
                     <i class="fa fa-globe"></i>  
                     <small class="  mt-1">Sipariş Detayları</small>
                  </h4>
                </div>
                <div class="col-4">
                <h4 style="font-size: 17px;text-align:center;padding-top: 5px;">
                    <img src="<?=base_url("assets/dist/img/umex-logo-white.png")?>" width="80">
                   
                  </h4>
                </div>
                <div class="col-4">
                  <h4 style="font-size: 17px;padding-top: 10px;">
                
                    <small class="float-right mt-1">Sipariş Kodu: <b><?=$siparis->siparis_kodu?></b></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->

              <div class="row">
              <div class="badge bg-dark text-md p-4" style="flex:1;font-weight:500;border-radius:0px;border: 1px solid #093d7d;background: radial-gradient(circle, rgba(10,74,140,1) 0%, rgba(3,83,163,1) 25%, rgba(0,64,129,1) 56%, rgba(0,64,129,1) 100%);">
                 <i class="fa fa-user-circle" style="font-size:25px"></i>
                 <br>
                 <div style="height:5px;"></div>
                 <span style="font-weight:bold;font-size:x-large">
                 
                 

                 <?php
$metin = mb_strtoupper($siparis->musteri_ad);
 
$metin = str_ireplace("HANIM", "<span class='yanipsonenyazi2' style='color: yellow;'>HANIM</span>", $metin);
$metin = str_ireplace(" BEY", "<span class='yanipsonenyazi2' style='color: yellow;'> BEY</span>", $metin);

echo $metin;
?>
                
                </span> <br>
                 <div style="height:5px;"></div>
                 
               <span style="margin-top:5px !important;font-weight: 300;font-size: small;">  <?=mb_strtoupper($siparis->merkez_adi)?></span>
               <br>
               <div style="height:5px;"></div>
               <div style="   
    margin: auto;">
               <a style="width: auto;background: white;" onclick="showWindow('<?=base_url("musteri/duzenle/")?><?=$siparis->musteri_id?>');" class="btn btn-white mr-2 col-4 mt-1" style="background:white;color:#043b91!important;">
                        <i class="fas fa-user"></i> Müşteri Düzenle
                    </a>
                    <a style="width: auto;background: white;" onclick="showWindow('<?=base_url("merkez/duzenle/")?><?=$siparis->merkez_id?>');" class="btn btn-white mr-2 col-4 mt-1" style="background:white;color:#043b91!important;">
                        <i class="fas fa-building"></i> Merkez Düzenle
                    </a> 
                    <?php 
                    if($siparis_fiyat_goruntule)
                    {
?>
 <a style="width: auto;background: #00891c;color:white;" onclick="showWhatsapp()" class="btn btn-white mr-2 col-4 mt-1" style="background:white;color:#043b91!important;">
                        <i class="fab fa-whatsapp"></i> Whatsapp Onay
                    </a>
<?php
                    }
                    ?>
                   



<?php 
$f_uyari = 0;
foreach ($urunler as $urun) {
  $kalan_tutar = ($urun->satis_fiyati-($urun->pesinat_fiyati+$urun->kapora_fiyati+$urun->takas_bedeli));
 
if( $kalan_tutar>0 && $urun->vade_sayisi == 0){
  ?>
 <a  class="btn btn-danger mr-2 col-4 mt-1 yanipsonenyazi2" style="background:white;color:#043b91!important;">
                        <i class="fab fa-whatsapp"></i> HATALI FİYAT BİLGİSİ
                    </a>
<?php
}
}
?>





                   
                    <br>
                    <?php 


                    $takas_varmi = 0;
                    foreach ($urunler as $ur) {
                      if($ur->takas_bedeli > 0){
                        ?>
                        <br>
                         <span class="badge bg-warning yanipsonenyazinew" style=" margin-left:-5px;padding:5px"><br><i class="fas fa-exclamation-circle"></i> Bu siparişte takas alınacak ürün bulunmaktadır.<br><br></span>
                   
                        <?php
                        break;
                      }
                    }


                    ?>
               </div>
                </div> 
               
              </div>
              <div class="row" style="height:auto;min-height:38px;color:white;background:#00356b!important;">
             
                  <div class="col text-center pt-2" style="padding:auto">   <i class="far fa-address-card" style="color:#ffffff;opacity:0.8"></i> Müşteri Kodu :  <?=$siparis->musteri_kod?></div>
                  <div class="col text-center pt-2" style=" "> <i class="fa fa-mobile-alt " style="color:#ffffff"></i> İletişim :  <?=$siparis->musteri_iletisim_numarasi?>
                </div>
                  <div class="col text-center pt-2"> <i class="fa fa-envelope " style="color:#ffffff"></i>   <?=$siparis->musteri_email_adresi != "" ? $siparis->musteri_email_adresi  : "Email Adresi Girilmedi"?>
                </div>
                 
                </div>

              <div class="row invoice-info mt-1" style="    ">
             
            
             
             
              <div class="col-sm-6 invoice-col mr-1 p-0" style="border: 3px solid #e1eeff;background:#ffffff;border: 1px solid #005cbf;background: radial-gradient(circle, rgba(237,237,237,1) 0%, rgba(255,255,255,1) 38%, rgba(255,255,255,1) 65%, rgba(226,226,226,1) 100%);">
                  <span style="font-weight:bold;color:#073669;text-align:center;background: #e3effe;display: block;padding:5px;border-bottom: 1px solid #005cbf;">

                    Siparişi Oluşturan Kullanıcı
                  </span>
                  <address class="m-2 text-center">
                   
                    <span class="badge bg-dark text-xs" style="font-weight:500">
                    <i class="fa fa-user-circle"></i> <strong><?=mb_strtoupper($siparisi_olusturan_kullanici[0]->kullanici_ad_soyad)?></strong> / <?=$siparisi_olusturan_kullanici[0]->kullanici_unvan?></span><br>
                  <span><?=$siparisi_olusturan_kullanici[0]->kullanici_unvan?><br>
                  <?php 
                  if($siparis->yonlendiren_kisi != 0){
?>
 <b class="badge bg-warning text-xs"><i class="fa fa-check-circle"></i> <?=(get_yonlendiren_kullanici($siparis->yonlendiren_kisi)->kullanici_ad_soyad)?> tarafından yönlendirildi.</b>
                 
<?php
                  }
                  ?>
                 
                 
                  <br>
                    <span style="font-weight:500"><i class="fa fa-building"></i> Departman :</span> <?=$siparisi_olusturan_kullanici[0]->departman_adi?><br>
                    <span style="font-weight:500"><i class="fa fa-envelope"></i> Email Adresi :</span> <?=$siparisi_olusturan_kullanici[0]->kullanici_email_adresi?><br>
                    <span style="font-weight:500"><i class="fa fa-phone"></i> Dahili No :</span> <?=$siparisi_olusturan_kullanici[0]->kullanici_bireysel_iletisim_no?>
                 
                </address>
              </div>
                
                <!-- /.col -->
                <div class="col-sm-6 invoice-col p-0" style="border:3px solid #e1eeff;flex: 1;background:#ffffff;border: 1px solid #005cbf;background: radial-gradient(circle, rgba(237,237,237,1) 0%, rgba(255,255,255,1) 38%, rgba(255,255,255,1) 65%, rgba(226,226,226,1) 100%);">
                <span style="font-weight:bold;color:#073669;background: #e3effe;display: block;padding:5px;text-align:center;border-bottom: 1px solid #005cbf;">

Sipariş Detayları
</span>

              <address class="p-2 text-center">
              <b class="badge bg-warning text-xs"><i class="fa fa-check-circle"></i> SİPARİŞİN SON DURUMU</b><br> <?=$hareketler[count($hareketler)-1]->adim_adi?><br><br>
              
                
                <b style="font-weight:500"><i class="fa fa-calendar-alt text-dark"></i> Sipariş Tarihi:</b> <?=date("d.m.Y H:i",strtotime($siparis->kayit_tarihi))?><br>
            
                <span style="font-weight:500"><i class="fa fa-map"></i> Teslimat Adresi :</span> <?=($siparis->merkez_adresi == "") ? '<span class="badge bg-danger yanipsonenyazi2">Merkez Adresi Girilmedi</span>':$siparis->merkez_adresi?> <?=$siparis->ilce_adi?> / <?=$siparis->sehir_adi?>
              <br>  <span style="font-weight:500"><i class="fa fa-calendar-alt"></i> Teslimat Tarihi :</span> <?=($guncel_adim>4) ? date("d.m.Y",strtotime($siparis->musteri_talep_teslim_tarihi)) : "<span>Tarih Belirlenmedi.</span>"?>               
              </address>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
 
             

              






             
 <!-- Table row -->
 <div class="row mt-2">



<!-- YENİ -->


<!-- YENİ -->




 
 <div class="col pb-2" style="background: #e2efff; "> 
 <label for="formClient-Code " class="mt-2" style="color:#07357a;margin-bottom:0px;margin-top:0px">
 <div class="fa fa-box"></div>
 SİPARİŞ / ÜRÜN BİLGİLERİ
</label>
 
 </div>
 <div class="col text-right" style="background: #e2efff;">
 <label for="formClient-Code " class="mt-2" style="color: #07357a;font-weight:normal;margin-bottom:0px;margin-top:0px"> 

<i class="fa fa-info-circle"></i>
 Siparişe tanımlı toplam <?=count($urunler)?> adet ürün listelenmiştir.

</label>
 
 </div>
                <div class="col-12 table-responsive pl-0 pr-0 " style="margin-top:-6px" >
                  <table id="tableurunlersf" class="table table-striped" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    <thead>
                    <tr>
                      <th style="padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Kod</th>
                      <th style="min-width:120px;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Ürün</th>
                      <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;min-width:120px;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Ürün Başlıkları</th>
                     
                      <th style="padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Seri Numarası</th>
                      <th style="padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Renk</th>
                     
                    <?php 
                    if($siparis_fiyat_goruntule){
                      ?>

                          <th style="min-width:120px;padding-top:5px;padding-bottom:5px;font-weight: 700; color:white;background: #00347d;border-bottom:0px solid">Satış Fiyatı</th>
                          <th style="min-width:120px;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Kapora Fiyatı</th>
                          <th style="min-width:120px;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Peşinat Fiyatı</th>
                     
                          <th style="min-width:120px;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Takas Bedeli</th>
                          <th style="min-width:120px;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Kalan Tutar</th>
                          <th style="min-width:120px;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Vade Sayısı</th>
                          <th style="min-width:120px;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Fatura Tutarı</th>
                      <?php
                    }
                      ?>

                    
                      <th style="padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Damla Etiket</th>
                      <th style="padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Açılış Ekranı</th>
                  
                      <th style="padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Takas Cihaz Seri Kod</th>
                      <th style="padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Takas Cihaz Model</th>
                      <th style="padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Takas Cihaz Renk</th>
                  
                    </tr>
                    </thead>
                    <tbody>
                        <?php $count = 0;
                            foreach ($urunler as $urun) {
                              $count++;
                               ?>
                                    <tr>
                                        <td><?=$urun->urun_kod?></td>
                                        <td><?=$urun->urun_adi?></td>
                                        <td>
                                          
                                       
                                        <?php

                                      $jsonData = json_encode(get_basliklar($urun->basliklar), true);
                                     
                                      $data = json_decode($jsonData, true);

                                       
                                      $basliklar = array_map(function($item) use($urun) {
                                          return str_replace("($urun->urun_adi)","",$item['baslik_adi']);
                                      }, $data);

                                      if($urun->basliklar != null && $urun->basliklar != "" && $urun->basliklar != "null")
                                      { 
                                        echo implode(", ", $basliklar);

                                      }
                                      else{
                                        echo "<span class='text-danger'>Başlık Seçilmedi</span>";

                                      }
                                     
                                      ?>
                                      
                                      </td>
                                        <td>
                                      
                                      <?php 
                                        if($urun->seri_numarasi != ""){
                                            echo $urun->seri_numarasi;
                                        }else{
                                          echo '<span class="badge bg-default text-xs" style="background: #cbcaca;padding:5px;font-weight:normal"><i class="fas fa-spinner"></i> Üretim Süreci Bekleniyor</span>';
                                        }
                                      
                                      ?>
                                      
                                      </td>
                                        <td><?=$urun->renk_adi?></td>
                                        
                                          
                                        <?php 
                                          if($siparis_fiyat_goruntule){
                                            echo "<td style='font-weight: 700;'>".number_format($urun->satis_fiyati,2)." ₺"."</td>";
                                          }
                                        
                                        ?>
                                        
                                    
                                        <?php 
                                          if($siparis_fiyat_goruntule){
                                            echo "<td>".number_format($urun->kapora_fiyati,2)." ₺"."</td>";
                                          }
                                        
                                        ?>
                            
                                     
                                        <?php 
                                          if($siparis_fiyat_goruntule){
                                            echo "<td>".number_format($urun->pesinat_fiyati,2)." ₺"."</td>";
                                          }
                                        ?>  
  

<?php 
                                          if($siparis_fiyat_goruntule){
                                            echo "<td>".number_format($urun->takas_bedeli,2)." ₺"."</td>";
                                          }
                                        ?>  
                                        
                                        <?php 
                                          if($siparis_fiyat_goruntule){
                                            $kalan_tutar = ($urun->satis_fiyati-($urun->pesinat_fiyati+$urun->kapora_fiyati+$urun->takas_bedeli));
                                            echo "<td>".number_format($kalan_tutar ,2)." ₺</td>";
                                       
                                          }
                                        ?>  

                                        <?php 
                                          if($siparis_fiyat_goruntule){
                                            echo "<td>".$urun->vade_sayisi;

                                            if($urun->vade_sayisi > 0){
                                              echo "<span style='opacity:0.5'> - Taksit :".(number_format($kalan_tutar/$urun->vade_sayisi)." ₺</span>");
                                            } 
                                           
                                            echo "</td>";
                                          }
                                        ?>  

<?php 
                                          if($siparis_fiyat_goruntule){
                                            echo "<td>".number_format($urun->fatura_tutari,2)." ₺"."</td>";
                                          }
                                        ?>
                                            <td>



                                            
                                        <?=(($urun->damla_etiket == 1) ? "<span class='badge bg-default  text-success' style='background: #d6ebd1;padding:5px;font-weight:normal'><i class='fa fa-check-circle text-success'></i> EVET / YAPILACAK</span>" : "<span style='background: #ffdddd;padding:5px;font-weight:normal' class='badge bg-default  text-danger'><i class='fa fa-times-circle text-danger'></i> HAYIR / YAPILMAYACAK</span>")?>
                                          </td>

                                          <td>
                                          <?=(($urun->acilis_ekrani == 1) ? "<span class='badge bg-default  text-success'style='background: #d6ebd1;padding:5px;font-weight:normal'><i class='fa fa-check-circle text-success'></i> EVET / YAPILACAK</span>" : "<span style='background: #ffdddd;padding:5px;font-weight:normal' class='badge bg-default  text-danger'><i class='fa fa-times-circle text-danger'></i> HAYIR / YAPILMAYACAK</span>")?>
                                        
                                          </td>

                                          <td>
                                          <?=$urun->takas_alinan_seri_kod ?? '<span style="opacity:0.5">Takas Bilgisi Bulunamadı</span>'?>
                                        
                                          </td>
                                          <td>
                                          <?=$urun->takas_alinan_model ?? '<span style="opacity:0.5">Takas Bilgisi Bulunamadı</span>'?>
                                        
                                          </td>
                                          <td>
                                          <?=$urun->takas_alinan_renk ?? '<span style="opacity:0.5">Takas Bilgisi Bulunamadı</span>'?>
                                        
                                          </td>
                                    </tr>
                               <?php
                            }
                        ?>
                    
                  
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->





              <?php if($siparis->kurulum_ekip) : ?>
                
              
                <!-- Table row -->
                <div class="row mt-2">
                <div class="col pb-2" style="background: #fff4da; max-width:270px"> 
                <label for="formClient-Code " class="mt-2" style="color:#c75c00;margin-bottom:0px;margin-top:0px">
                <div class="fa fa-users"></div>
                KURULUM / TESLİMAT BİLGİLERİ
               </label>
                
                </div>
                <div class="col text-right" style="background: #fff4da;">
                <label for="formClient-Code " class="mt-2" style="color: #07357a;font-weight:normal;margin-bottom:0px;margin-top:0px"> 
               
               <i class="fa fa-calendar-alt"></i>
               <b>Kurulum Tarihi :</b> <?=date("d.m.Y",strtotime($siparis->kurulum_tarihi))?>
               
                <i class="fa fa-truck ml-2"></i>
                <b>Araç Plaka : </b><?=$siparis->sirket_arac_plaka?> / <?=$siparis->sirket_arac_marka?> / <?=$siparis->sirket_arac_model?>
               
               
               </label>
                
                </div>
                               <div class="col-12 table-responsive pl-0 pr-0 " style="margin-top:-6px" >
                                 <table id="tableurunlers" class="table table-striped nowrap" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                   <thead>
                                   <tr>
                                     <th style="padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Kod</th>
                                     <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Kullanıcı</th>
                                     <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Ünvan</th>
                                     <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">İletişim</th>
                                    
                                     <th style="padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Email Adresi</th>
                                    
               
                                   
                                   </tr>
                                   </thead>
                                   <tbody>
                                       <?php $count = 0;
                                           foreach ($kurulum_ekip as $kullanici) {
                                             $count++;
                                              ?>
                                                   <tr>
                                                       <td><?=$kullanici->kullanici_kod?></td>
                                                       <td><i class="fa fa-user-circle"></i> <?=$kullanici->kullanici_ad_soyad?></td>
                                                      
                                                       <td><?=$kullanici->kullanici_unvan?></td>
                                                       <td><?=$kullanici->kullanici_bireysel_iletisim_no?></td>
                                                       <td><?=$kullanici->kullanici_email_adresi?></td>
                                                        
                                                     
                                                   </tr>
                                              <?php
                                           }
                                       ?>
                                   
                                 
                                   </tbody>
                                 </table>
                               </div>
                               <!-- /.col -->
                             </div>
                             <!-- /.row -->
               
               
               
                             <?php endif; ?>
               
                            
               
                             <?php if($siparis->egitim_var_mi) : ?>
                           
                <!-- Table row -->
                <div class="row mt-2">
                <div class="col pb-2" style="background: #efffea; "> 
                <label for="formClient-Code " class="mt-2" style="color:#127501;margin-bottom:0px;margin-top:0px">
                <div class="fa fa-users"></div>
                EĞİTİM / EĞİTMEN EKİP BİLGİLERİ
               </label>
                
                </div>
                <div class="col text-right" style="background: #efffea;">
                <label for="formClient-Code " class="mt-2" style="color: #127501;font-weight:normal;margin-bottom:0px;margin-top:0px"> 
               
               <i class="fa fa-calendar-alt"></i>
                Eğitim Tarihi : <?=date("d.m.Y",strtotime($siparis->belirlenen_egitim_tarihi))?>
               
                
               </label>
                
                </div>
                               <div class="col-12 table-responsive pl-0 pr-0 " style="margin-top:-6px" >
                                 <table id="tableurunlers" class="table table-striped" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                   <thead>
                                   <tr>
                                     <th style="padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Kod</th>
                                     <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Kullanıcı</th>
                                     <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Ünvan</th>
                                     <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">İletişim</th> 
                                     <th style="padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Email</th> 
                                    
               
               
                                  
               
                                   
                                   </tr>
                                   </thead>
                                   <tbody>
                                       <?php $count = 0;
                                           foreach ($egitim_ekip as $kullanici) {
                                             $count++;
                                              ?>
                                                   <tr>
                                                       <td><?=$kullanici->kullanici_kod?></td>
                                                       <td><i class="fa fa-user-circle"></i> <?=$kullanici->kullanici_ad_soyad?></td>
                                                       <td><?=$kullanici->kullanici_unvan?></td>
                                                       <td><?=$kullanici->kullanici_bireysel_iletisim_no?></td>
                                                       <td>
                                                       <?=$kullanici->kullanici_email_adresi?></td>
                                                        
                                                     
                                                   </tr>
                                              <?php
                                           }
                                       ?>
                                   
                                 
                                   </tbody>
                                 </table>
                               </div>
                               <!-- /.col -->
                             </div>
                             <!-- /.row -->
               
               
                             <?php endif; ?>
               
               
               




                             <?php /* if(get_egitim($siparis->siparis_id) != null) : ?>
                                  
                                  <!-- Table row -->
                                  <div class="row mt-2">
                                  <div class="col pb-2" style="background: #f1f1f1; "> 
                                  <label for="formClient-Code " class="mt-2" style="color:#127501;margin-bottom:0px;margin-top:0px">
                                  <div class="fa fa-users"></div>
                                  KURSİYER BİLGİLERİ
                                 </label>
                                  
                                  </div>
                                  <div class="col text-right" style="background:#f1f1f1;">
                                  <label for="formClient-Code " class="mt-2" style="color: #127501;font-weight:normal;margin-bottom:0px;margin-top:0px"> 
                                 
                                 
                                  
                                 </label>
                                  
                                  </div>
                                                 <div class="col-12 table-responsive pl-0 pr-0 " style="margin-top:-6px" >
                                                   <table id="tableurunlers" class="table table-striped">
                                                     <thead>
                                                     <tr>
                                                       <th style="padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Kursiyer Ad Soyad</th>
                                                       <th style="padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Ürün / Cihaz Bilgisi</th>
                                                      
                                 
                                 
                                                    
                                 
                                                     
                                                     </tr>
                                                     </thead>
                                                     <tbody>
                                                         <?php $count = 0;
                                                        $data = get_egitim($siparis->siparis_id)->kursiyerler;
                                                       // JSON verisini PHP dizisine çevir
                                                        $dataArray = json_decode($data, true);

                                                        // Tüm isimleri ekrana yazdır
                                                        foreach ($dataArray as $urun) {
                                                            $isimler = json_decode($urun['data']);
                                                            $urun = $urun['info'];
                                                            foreach ($isimler as $isim) {
                                                                echo "<tr><td><i class='fa fa-user-circle'></i> ".$isim."</td><td>".$urun."</td></tr>";
                                                            }
                                                        }
                                                        ?>
                                                     
                                                   
                                                     </tbody>
                                                   </table>
                                                 </div>
                                                 <!-- /.col -->
                                               </div>
                                               <!-- /.row -->
                                 
                                 
                                               <?php endif; */echo ""; ?>


                                


 <!-- Table row -->
 <div class="row">



<div class="row" style="display: contents;margin-bottom:-5px">
<div class="col-5 pb-2" style="background:#efefef;padding-bottom:5px">
 <label for="formClient-Code " class="mt-2" style="color:#07357a;margin-bottom:0px;margin-top:0px">
 <div class="fa fa-users"></div>
 SİPARİŞ ONAY / İŞLEM HAREKETLERİ
</label>
 
 </div>
 <div class="col text-right" style="background:#efefef">
 <label for="formClient-Code " class="mt-2" style="color: #07357a;font-weight:normal;margin-bottom:0px;margin-top:0px"> 

<i class="fa fa-info-circle"></i>
 Siparişe tanımlı toplam <?=count($hareketler)?> adet onay hareketi listelenmiştir.

</label>
 
 </div>
</div>





                <div class="col-12 table-responsive pl-0 pr-0" style="margin-top: -7px !important;">
                  <table id="tableharesketler" class="table table-striped nowrap" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    <thead>
                    <tr>
                      <th style="padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #031b40;border-bottom:0px solid">No</th>
                      <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #031b40;border-bottom:0px solid">Hareket Detayları</th>
                      <th style="padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #031b40;border-bottom:0px solid">Onay Notu</th>
                      <th style="min-width:150px;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #031b40;border-bottom:0px solid">Onaylayan K.</th>
                      <th style="min-width:120px;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #031b40;border-bottom:0px solid">Onay Tarih</th>
                    
                    </tr>
                    </thead>
                    <tbody>
                        <?php $count = 0; 
                            foreach ($hareketler as $hareket) {
                              $count++;
                               ?>
                                    <tr>
                                        <td><?=$count?></td>
                                        <td><b><i class="fa fa-check text-success"></i> <?=$hareket->adim_adi?></b> 
                                      <br>
                                       
                                      </td>


                                      <td>
                                      <span>
                                      <?=$hareket->onay_aciklama != "" ? "<span onclick=\"openSweetAlertHareket('".$hareket->siparis_onay_hareket_id."','".$hareket->onay_aciklama."')\" class='badge bg-".((stripos($hareket->onay_aciklama, "otomatik") !== false) ?"default":"danger yanipsonenyazi") ."' style='padding:5px'><i class='fas fa-exclamation-circle'></i> ".$hareket->onay_aciklama."</span>" :"<span onclick=\"openSweetAlertHareket('".$hareket->siparis_onay_hareket_id."','".$hareket->onay_aciklama."')\"  class='badge bg-default' style='background:#f3f3f3;padding:5px'><i class='far fa-comment'></i> Sipariş Onay Notu Girilmedi</span>"?>
                                      </span>
                                      </td>


                                        <td>
                                          <b>
                                          <i class="fa fa-user-circle"></i>  
                                        <?=$hareket->kullanici_ad_soyad?>
                            </b> 
                                      </td>
                                      
                                        <td>
                                          <b>   
                                           <?=date("d.m.Y",strtotime($hareket->onay_tarih))?></b> 
                                          <?=date("H:i",strtotime($hareket->onay_tarih))?>
                                        </td>
                                    </tr>
                               <?php
                            }
                        ?>
                    

                    <?php foreach ($adimlar as $adim) :?>
                      <?php if($guncel_adim > $adim->adim_sira_numarasi) continue; ?>
                     <tr> <td><?=$adim->adim_sira_numarasi?></td>
                      <td style="opacity:0.6"><i class="fas fa-hourglass-half mr-1"></i> <?=$adim->adim_adi?></td>
                      <td style="opacity:0.3"><i class="fas fa-hourglass-half mr-1"></i> Onay Bekleniyor</td>
                      <td style="opacity:0.3"><i class="fas fa-hourglass-half mr-1"></i> Onay Bekleniyor</td>
                      <td style="opacity:0.3"><i class="fas fa-hourglass-half mr-1"></i> Onay Bekleniyor</td> </tr>
                    <?php endforeach; ?>
                  
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->















           





              

              <div class=" mt-2">
       
      
        <div class="form-group">
        <?php 
              if($onay_durum == true){
                ?>
        <label for="formClient-Code">  SİPARİŞİ ONAYLA</label> 
            <form action="<?=base_url("siparis/onayla/$siparis->siparis_id")?>" onsubmit="wait_action()" method="post">


           
        <?php if($guncel_adim == 4) : ?>
                 <!-- ADIM 4-->
            <div style="background: #f6faff;border: 2px dashed #07357a;" class="p-2 mt-2">
            <label for="formClient-Code">  ADIM 4 - Merkez Bilgi Doğrulama</label>
            




            <div class="timeline mb-0">
  




            <?php foreach ($urunler as $urun) { ?>
          
  <div>
    <i class="fas fa-envelope bg-blue"></i>
    <div class="timeline-item">
      <span class="time text-white d-none d-lg-block d-xl-none">
      <i class="fas fa-exclamation-circle text-white"></i> Damla Etiket ve Açılış Ekranı alanları zorunludur</span>
      <h3 class="timeline-header bg-dark">
      <a href="#"><?=$urun->urun_adi?></a> <?=$urun->urun_aciklama?>
      </h3>
      <div class="timeline-body"> 
        
      
      <div class="row">

      <div class="form-group col">
      <i class="fas fa-tint text-primary"></i> Damla Etiket
       <select name="urun_damla_etiket<?=$urun->siparis_urun_id?>" id="" required  class="form-control">
        <option value="">SEÇİM YAPINIZ</option>
        <option value="1" <?=($urun->damla_etiket == "1") ? 'selected="selected"' : ''?>>EVET</option>
        <option value="0" <?=($urun->damla_etiket == "0") ? 'selected="selected"' : ''?>>HAYIR</option>
       </select>
      </div>
      <div class="form-group col">
      <i class="fas fa-desktop text-success"></i> Açılış Ekranı 
       <select name="urun_acilis_ekran<?=$urun->siparis_urun_id?>" required id="" class="form-control">
        <option value="">SEÇİM YAPINIZ</option>
        <option value="1" <?=($urun->acilis_ekrani == "1") ? 'selected="selected"' : ''?>>EVET</option>
        <option value="0" <?=($urun->acilis_ekrani == "0") ? 'selected="selected"' : ''?>>HAYIR</option>
       </select>
      </div>


      </div>

 
 
      </div>
   
    </div>
  </div>

  


  <?php } ?>






  <div>
                  <i class="fas fa-envelope bg-blue"></i>
                  <div class="timeline-item">
                    <span class="time d-none d-lg-block d-xl-block">
                    <i class="fas fa-exclamation-circle"></i> Teslim Tarihi alanları zorunludur </span>
                 
                    </span>
                    <h3 class="timeline-header bg-warning">
                      <a href="#">Üretim Bilgileri</a> - Talep
                    </h3>
                    <div class="timeline-body"> 
                      <i class="fas fa-qrcode text-danger"></i>
                      Teslim Tarihi (Müşteri Talebi)
                      <div class="input-group">
                        <div class="input-group-prepend"></div>
                        <input type="text" required class="form-control" value="<?=date("d.m.Y",strtotime($siparis->musteri_talep_teslim_tarihi))?>" name="musteri_talep_teslim_tarihi" data-inputmask-alias="datetime" data-inputmask-inputformat="dd.mm.yyyy" data-mask="" inputmode="numeric">
                      </div>
                    </div> 
                  </div>
                </div>



                <div>
                  <i class="fas fa-envelope bg-blue"></i>
                  <div class="timeline-item">
                    <span class="time d-none d-lg-block d-xl-block">
                    <i class="fas fa-exclamation-circle"></i> Teslim Tarihi alanları zorunludur </span>
                 
                    </span>
                    <h3 class="timeline-header bg-success">
                      <a href="#">Eğitim Bilgileri</a>
                    </h3>
                    <div class="timeline-body"> 
                      <i class="fas fa-graduation-cap text-success"></i>
                      Eğitim Durumu
                      <div class="input-group">
                        <div class="input-group-prepend"></div>
                        <select class="select2 d-block" name="egitim_var_mi" style="width:100%">
                          <option value="1" <?=($siparis->egitim_var_mi == 1) ? "selected='selected'" : ""?>>Eğitim Var</option>
                          <option value="0" <?=($siparis->egitim_var_mi == 0) ? "selected='selected'" : ""?>>Eğitim Yok</option>
                        </select> 
                      </div>
                    </div> 
                  </div>
                </div>




  </div>


            </div>  
             <!-- ADIM 4-->

<?php endif; ?>
          

<?php if($guncel_adim == 7) : ?>
                 <!-- ADIM 7-->
            <div style="background: #f6faff;border: 2px dashed #07357a;" class="p-2 mt-2">
            <label for="formClient-Code " style="color:red">  ADIM 7 - Üretim Süreci</label>
            <br>
       



            <div class="timeline mb-0">
            <?php $count = 0;
                            foreach ($urunler as $urun) {
                              $count++;
                               ?>
          
              <div>
                <i class="fas fa-envelope bg-blue"></i>
                <div class="timeline-item">
                  <span class="time text-white d-none d-lg-block d-xl-none" style="opacity:0.8">
                    <i class="fas fa-exclamation-circle text-white"></i> Seri numarasi ve üretim tarihi alanları zorunludur </span>
                  <h3 class="timeline-header bg-dark">
                    <a href="#"><?=$urun->urun_adi?></a> <?=$urun->urun_aciklama?>
                  </h3>
                  <div class="timeline-body"> 
               <i class="fas fa-qrcode text-primary"></i> Seri Numarası

               <select class="select2 d-block" placeholder="Cihaz Stok Havuzundan Seri Numarası Seçimi Yapınız" required name="urun_seri_no<?=$urun->siparis_urun_id?>" style="width:100%">
               <option value="">Seri No Seçilmedi</option>
             
               <?php 
               $cihazlarhavuz = get_havuz($urun->urun_id,$urun->renk_id);
               foreach ($cihazlarhavuz as $value) {
               ?>
                <option value="<?=$value->cihaz_havuz_seri_numarasi?>" <?=($urun->seri_numarasi==$value->cihaz_havuz_seri_numarasi)?"selected":""?>><?=$value->cihaz_havuz_seri_numarasi?></option>
   
               <?php
               }
               
               ?>
                         </select> 

                   
                
                 <div class="mt-2">
                 <i class="fas fa-calendar-alt text-danger"></i>
                      Üretim Tarihi
                      <div class="input-group">
                        <div class="input-group-prepend"></div>
                        <input type="text" required class="form-control" value="<?=date("d.m.Y",strtotime($urun->uretim_tarihi))?>" name="uretim_tarih<?=$urun->siparis_urun_id?>" data-inputmask-alias="datetime" data-inputmask-inputformat="dd.mm.yyyy" data-mask="" inputmode="numeric">
                      </div>
                 </div>
                

                 
                
                  </div>
                 
                </div>
              </div>
    
            <?php
                            }
                        ?>



 




          </div>
            </div>  
             <!-- ADIM 7-->
<?php endif; ?>
            
<?php if($guncel_adim == 9) : ?>

               <!-- ADIM 9-->
            <div style="background: #f6faff;border: 2px dashed #07357a;" class="p-2 mt-2">
            <label for="formClient-Code">  ADIM 9 - Kurulum Programlama</label>
            



            <div class="timeline mb-0">
  
          
              <div>
                <i class="fas fa-envelope bg-blue"></i>
                <div class="timeline-item">
                  <span class="time text-white d-none d-lg-block d-xl-none">
            
                    <i class="fas fa-exclamation-circle text-white"></i> Kurulum Tarihi, Araç Plaka ve Kurulum Ekip alanları zorunludur </span>
                  </span>
                  <h3 class="timeline-header bg-dark">
                    <a href="#">Kurulum Programlama</a>
                  </h3>
                  <div class="timeline-body"> 
                    
                  
                  <div class="form-group">
                  <i class="fas fa-calendar-alt text-danger"></i> Kurulum Tarihi
                  <input type="text" required class="form-control" name="kurulum_tarih" value="<?=date("d.m.Y",strtotime($siparis->kurulum_tarihi))?>" data-inputmask-alias="datetime" data-inputmask-inputformat="dd.mm.yyyy" data-mask="" inputmode="numeric">

                  </div>

                  <div class="form-group col pl-0">
            <label for="formClient-Code"><i class="fas fa-car text-success"></i>  Kurulum Araç Bilgisi</label>
            <select name="kurulum_arac_plaka" id="kurulum_arac_plaka" class="select2 form-control rounded-0" style="width: 100%;">
            <option  value="0">ARAÇ SEÇİLMEDİ</option>
            <?php foreach(araclar() as $arac) : ?> 
                <option  value="<?=$arac->sirket_arac_id?>"  <?php echo  $siparis->kurulum_arac_plaka == $arac->sirket_arac_id ? 'selected="selected"'  : '';?>><?=$arac->sirket_arac_plaka?> / <?=$arac->sirket_arac_marka?> / <?=$arac->sirket_arac_model?></option>
              <?php endforeach; ?>  
            </select>
          </div>
 

                  <div class="form-group">
                    <i class="fas fa-users text-orange"></i> Kurulum Ekibi Bilgileri
                    <select class="select2bs4" required inputmode='none' name="kurulum_ekip[]" multiple data-placeholder="Personel Seçimi Yapınız" style="width: 100%;">
                    <?php foreach($kurulum_kullanicilari as $kullanici) : ?> 
                      <?php
                               
                               $selected = (is_array( json_decode($siparis->kurulum_ekip)) && in_array($kullanici->kullanici_id, json_decode($siparis->kurulum_ekip))) ? 'selected="selected"' : '';
                           ?>
                        <option value="<?=$kullanici->kullanici_id?>" <?=$selected?>>
                      <strong>  <?=$kullanici->kullanici_ad_soyad?></strong> / 
                        <?=$kullanici->kullanici_unvan?>
                      </option>
                    <?php endforeach; ?> 
                </select>
                  
                  
                </div>
                  </div>
               
                </div>
              </div>
    
              </div>





            </div>  
             <!-- ADIM 9-->
<?php endif; ?>
<?php if($guncel_adim == 10) : ?>
              <!-- ADIM 10-->
            <div style="background: #f6faff;border: 2px dashed #07357a;" class="p-2 mt-2">
            <label for="formClient-Code">  ADIM 10 - Eğitim Programlama
</label>
            








            <div class="timeline mb-0">
  

            
          
  <div>
    <i class="fas fa-envelope bg-blue"></i>
    <div class="timeline-item">
      <span class="time text-white d-none d-lg-block d-xl-none">
    
        <i class="fas fa-exclamation-circle text-white"></i> Eğitim Tarihi, Eğitim Ekip alanları zorunludur </span>
                 
      </span>
      <h3 class="timeline-header bg-dark">
        <a href="#">Eğitim Programlama</a>
      </h3>
      <div class="timeline-body"> 
        











      <div class="form-group">
      <i class="fas fa-calendar-alt text-danger"></i> Eğitim Durumu
      <div class="input-group">
                        <div class="input-group-prepend"></div>
                        <select class="select2 d-block" required name="egitim_var_mi2" style="width:100%">
                        <option value="">Seçim Yapınız</option>
                       
                        <option value="1" <?=($siparis->egitim_var_mi == 1) ? "selected='selected'" : ""?>>Eğitim Var</option>
                          <option value="0" <?=($siparis->egitim_var_mi == 0) ? "selected='selected'" : ""?>>Eğitim Yok</option>
                        </select> 
                      </div>
      </div>





      
      <div class="form-group">
      <i class="fas fa-calendar-alt text-danger"></i> Eğitim Tarihi
      <input type="text" required class="form-control" name="egitim_tarih"  data-inputmask-alias="datetime" data-inputmask-inputformat="dd.mm.yyyy" data-mask="" inputmode="numeric">

      </div>


 

      <div class="form-group">
        <i class="fas fa-users text-primary"></i> Eğitmen
        <select class="select2bs4" required name="egitim_ekip[]" data-placeholder="Eğitmen Seçimi Yapınız" style="width: 100%;">
        <?php foreach($egitmenler as $kullanici) : ?> 
          <?php
                               
                               $selected = (is_array( json_decode($siparis->egitim_ekip)) && in_array($kullanici->kullanici_id, json_decode($siparis->egitim_ekip))) ? 'selected="selected"' : '';
                           ?>
            <option <?=$selected?> value="<?=$kullanici->kullanici_id?>">
          <strong>  <?=$kullanici->kullanici_ad_soyad?></strong> / 
            <?=$kullanici->kullanici_unvan?>
          </option>
        <?php endforeach; ?> 
    </select>
      
      
    </div>
      </div>
   
    </div>
  </div>

  </div>












            </div>  
             <!-- ADIM 10-->
          <?php endif; ?>
            


<br>





<?php if($guncel_adim == 12) : ?>
  <?php if($egitim_ekip[0]->kullanici_id == $this->session->userdata('aktif_kullanici_id')) : ?>

   <!-- ADIM 12-->
   <div style="background: #f6faff;border: 2px dashed #07357a;" class="p-2 mt-2">
            <label for="formClient-Code " style="color:red">  ADIM 12 - Eğitim Onayı</label>
            <br>
       



            <div class="timeline mb-0">
            <?php $count1 = 0;
                            foreach ($urunler as $urun) {
                              $count1++;
                               ?>
          
              <div>
                <i class="fas fa-envelope bg-blue"></i>
                <div class="timeline-item">
<?php 
if($count1>1){
?>
  <span class="time text-white p-0">
                 <a class="btn btn-xs btn-warning mr-1" onclick="copyPersons('<?=$urun->siparis_urun_id?>','<?=$urun->urun_adi?>')" style="margin-top:5px">   <i class="fas fa-arrow-alt-circle-down"></i>  Kişileri Aktar</a>
                
                </span>

<?php
}

?>

                


                  <h3 class="timeline-header bg-dark">
                    <a href="#"><?=$urun->urun_adi?></a> <?=$urun->urun_aciklama?>
                  </h3>
                  <div class="timeline-body"  id="adSoyadContainer<?=$urun->siparis_urun_id?>"> 
               
                  <?php 
                    for ($i=1; $i <= 5; $i++) { 
                      $uniqueid = uniqid();
                      ?>
                        <div id="row<?=$uniqueid?>">
                          <i class="fas fa-user text-dark <?=($i != 1) ? "mt-3" : ""?> mb-1"></i><b> Kursiyer Ad Soyad</b> (Zorunlu) :</span> 
                          <div class="input-group">
                            <input type="text" required name="urun_<?=$urun->siparis_urun_id?>_sertifika_kisi[]" class="form-control" placeholder="Ad Soyad Giriniz - <?=$urun->urun_adi?>">
                                            
                            <div class="input-group-append">
                            <a class="btn btn-danger" onclick="deleteRow('<?=$uniqueid?>');"><i class="fas fa-times"></i> İptal</a>
                            </div>
                            </div>
                        </div>

                      <?php
                    }
                  
                  ?>
                 
               
             
                 
                
                  </div>
                <div class="p-2">
                <a class="btn btn-success d-block p-2" style=" border: 2px dotted #6cbd6b;   color: #126503;background: #dfffde;width:100%" onclick="addNewInput('<?=$urun->urun_adi?>','<?=$urun->siparis_urun_id?>')"><i class="fa fa-plus-circle"></i> Yeni Kişi Ekle (<?=$urun->urun_adi?> Eğitimi)</a>
               
                </div> 

                </div>
              </div>
    
            <?php
                            }
                        ?>



 




          </div>
            </div>  
             <!-- ADIM 12-->


             <?php endif; ?>
             <?php endif; ?>
























            <br>



           <?php 
              if($onay_durum == true){
                ?> 
                 <textarea name="onay_aciklama" id="summernoteonay"></textarea>

                 <div class="row mb-2">
                    <!-- Siparişi Onayla -->
                    <button target="_blank" class="btn btn-success" style="flex:1">
                        <i class="fas fa-check"></i> SİPARİŞİ ONAYLA
                    </button>


                   
                </div>

                <?php
              }
            ?>

         



          </form>
          <?php } ?>

          <div class="row">
                   
                   
                    <!-- Merkez Bilgilerini Düzenle -->
                    <a href="<?=base_url("siparis/save_merkez_bilgi_dogrulama_view/".$siparis->siparis_id)?>" class="btn btn-dark mr-2 col-6 col-md-3" style="flex:1">
                        <i class="fas fa-pen"></i> Sipariş Detaylarını Düzenle (Fiyatlar)
                    </a>  
                      <!-- Merkez Bilgilerini Düzenle -->
                    <a href="<?=base_url("siparis/siparis_genel_duzenleme_view/".$siparis->siparis_id)?>" class="btn btn-dark mr-2 col-6 col-md-3" style="flex:1">
                        <i class="fas fa-pen"></i> Sipariş Detaylarını Düzenle 
                    </a> 
                     <!-- Eğitim Bilgilerini Düzenle -->
                    <a href="<?=base_url("siparis/save_uretim_sureci_view/".$siparis->siparis_id)?>" class="btn btn-dark mr-2 col-6 col-md-3" style="flex:1">
                     <i class="fas fa-pen"></i> Üretim Süreci Düzenle
                    </a>
                    <!-- Eğitim Bilgilerini Düzenle -->
                    <a href="<?=base_url("siparis/save_kurulum_programlama_view/".$siparis->siparis_id)?>" class="btn btn-dark mr-2 col-6 col-md-3" style="flex:1">
                     <i class="fas fa-pen"></i> Kurulum Programlama Düzenle
                    </a> 
                    
                    <!-- Eğitim Bilgilerini Düzenle -->
                     <a href="<?=base_url("siparis/save_egitim_programlama_view/".$siparis->siparis_id)?>" class="btn btn-dark mr-2 col-6 col-md-3" style="flex:1">
                     <i class="fas fa-pen"></i> Eğitim Bilgilerini Düzenle
                    </a>
                   
 <!-- Eğitim Bilgilerini Düzenle -->
 <a href="<?=base_url("siparis/bekleme_islem/".$siparis->siparis_id)?>" class="btn btn-dark mr-2 col-6 col-md-3" style="flex:1">
                     <i class="fas fa-pen"></i> <?=($siparis->beklemede == 1) ? "Beklemeden Çıkar" : "Beklemeye Al"?>
                    </a>
                   
                </div>



        </div>
      </div>

            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->














          
        </div><!-- /.row -->















        
      </div><!-- /.container-fluid -->











      
    </section>
    <!-- /.content -->











</div>









<div class="modal fade" id="modal-default"  data-backdrop="static">
              <div class="modal-dialog  modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">WHATSAPP ONAY MESAJI</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                 

                  <textarea rows="25" style="width:100%">

SN. <?=$siparis->musteri_ad?>;

<?php 
$s_fiyat = 0; $k_fiyat = 0;$p_fiyat = 0;
foreach ($urunler as $urun) {
$s_fiyat+=$urun->satis_fiyati;
$k_fiyat+=$urun->kapora_fiyati;$p_fiyat+=$urun->pesinat_fiyati;
  echo "*".mb_strtoupper($urun->urun_adi)."* (".mb_strtoupper($urun->renk_adi).") ŞİPARİŞİNİZ;";


  $jsonData = json_encode(get_basliklar($urun->basliklar), true);
 
  $data = json_decode($jsonData, true);

   
  $basliklar = array_map(function($item) use($urun) {
      return str_replace("($urun->urun_adi)","",$item['baslik_adi']);
  }, $data);

  if($urun->basliklar != null && $urun->basliklar != "" && $urun->basliklar != "null")
  { 
    echo "\n".mb_strtoupper(str_replace(" 1","",implode(" BAŞLIK, ", $basliklar)))." BAŞLIK";

  }
  else{
    echo "<span class='text-danger'>Başlık Seçilmedi</span>";

  }
 
  

}

?>

İLE BERABER;

<?="*".date("d.m.Y",strtotime($siparis->musteri_talep_teslim_tarihi))."*"?>  TARİHİNDE TESLİM EDİLECEKTİR.

ÖDEME PLANINIZ ŞU ŞEKİLDEDİR :

*ÖDENECEK TOPLAM TUTAR:* <?=number_format($s_fiyat,0)?> ₺

*KAPORA:* <?=number_format($k_fiyat,0)?> ₺ ALINDI

*PEŞİNAT:* <?=number_format($p_fiyat,0)?> ₺ CİHAZ KURULUMU SIRASINDA ALINACAKTIR

<?php 
 $kalan_tutar = ($urun->satis_fiyati-($urun->pesinat_fiyati+$urun->kapora_fiyati+$urun->takas_bedeli));
 
?>
<?php 
if($kalan_tutar > 0){
?>
*KALAN :* <?=number_format($kalan_tutar ,2)?> <?=($urun->vade_sayisi > 0) ? $urun->vade_sayisi." AY VADELİ SENET YAPILACAKTIR" : ""?>

<?php
}
?>

RİCA ETSEM  AŞAĞIDA İSTEDİĞİM BİLGİLERİ YAZABİLİR MİSİNİZ?

*AD VE SOYAD*
*GÜZELLİK MERKEZİ ADI*
*MERKEZİN AÇIK ADRESİ*

VE MÜSAİT OLDUĞUNUZDA CİHAZI KURACAĞIMIZ ADRESİN KONUMUNU PAYLAŞIRSANIZ SEVİNİRİM. 

İYİ GÜNLER DİLERİM.

</textarea>






                </div>
              <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>    </div>
            <!-- /.modal -->










<style>
    .table td, .table th {
            border-left: 1px solid #dee2e6;
       
        }

        .table {
            border-bottom: 1px solid #dee2e6;
            border-right: 1px solid #dee2e6;
        }
        .timeline>div { 
    margin-right: 0px;  
}
</style>

<script>
  

  function wait_action(){
    Swal.fire({
          title: "Lütfen Bekleyiniz!",
          html: "İşlem gerçekleştiriliyor...",
          timer: 5500,
          timerProgressBar: true,
          showCancelButton: false,
          allowOutsideClick: false,
          showConfirmButton: false
        });

  }

function copyPersons(id,urun_adi){
  var adSoyadContainerDivs = document.querySelectorAll('[id^="adSoyadContainer"]');
  if (adSoyadContainerDivs.length > 0) {
   
    var firstAdSoyadContainerDiv = adSoyadContainerDivs[0];

   
    var inputElements = firstAdSoyadContainerDiv.querySelectorAll('input');

    document.getElementById("adSoyadContainer"+id).innerHTML = '';
    inputElements.forEach(function(input) {
      if(input.value.trim() != ""){
        document.getElementById("adSoyadContainer"+id).appendChild(addNewInput(urun_adi,id,input.value));
   
      }
     
    });
} else {
    console.log("adSoyadContainer ile başlayan id'ye sahip div bulunamadı.");
}
}

  function generateUniqueID() {
     var timestamp = new Date().getTime();

     var randomNumber = Math.floor(Math.random() * 10000);

  
    var uniqueID = timestamp + '-' + randomNumber;

    return uniqueID;
}

    function deleteRow(id){
      var divToBeRemoved = document.getElementById("row"+id);
      divToBeRemoved.remove();
    }

    function addNewInput(urun_adi,urun_id,val="") {
      var inputCounter =  document.getElementById("adSoyadContainer"+urun_id).getElementsByTagName("input").length;
        
        var newDiv = document.createElement("div");
        newDiv.className = "timeline-body";
        var uid = generateUniqueID();
        newDiv.id = "row"+uid;
        var div1 = document.createElement("div");
        div1.className = "input-group";

        var div2 = document.createElement("div");
        div2.className = "input-group-append";

        var button_delete = document.createElement("a");
        button_delete.className = "btn btn-danger";

       
        var deleteIcon = document.createElement("i");
        deleteIcon.className = "fas fa-times";


        var deleteText = document.createElement("span");
        deleteText.innerHTML =  " İptal";

      

        var newIcon = document.createElement("i");
        newIcon.className = "fas fa-user text-dark mt-3";

       
        var newLabel = document.createElement("b");
        newLabel.innerHTML =  " Kursiyer Ad Soyad";

        var newLabel2 = document.createElement("span");
        newLabel2.innerHTML =  " (Zorunlu) :";

        var newInput = document.createElement("input");
        newInput.type = "text";
        newInput.required = true;
        newInput.name = "urun_"+urun_id+"_sertifika_kisi[]";
        newInput.className = "form-control";
        newInput.placeholder ="Ad Soyad Giriniz - "+urun_adi;
        if(val!=""){
          newInput.value = val;
        }
        button_delete.appendChild(deleteIcon);
        button_delete.appendChild(deleteText);


        button_delete.addEventListener("click", function() {
            deleteRow(uid);
        });

        div1.appendChild(newInput);

        div2.appendChild(button_delete);
        div1.appendChild(div2);

 
        newDiv.appendChild(newIcon);
        newDiv.appendChild(newLabel);
        newDiv.appendChild(newLabel2);
        newDiv.appendChild(div1);

    


        if(val!=""){
          return newDiv;
        }else{
          document.getElementById("adSoyadContainer"+urun_id).appendChild(newDiv);
   
        }

        
    }
</script>


<style>
    body {
      
        font-family: Arial, sans-serif;
    }
    
    .scroll-indicator {
      position: fixed;
        bottom: 20px;
        right: 20px;
        display: flex;
        align-items: center;
        gap: 5px;
        color: #fff;
        justify-content: center;
        width: -webkit-fill-available;
    }
    
    
    
    .scroll-arrow {
        width: 0;
        height: 0;
        border-left: 8px solid transparent;
        border-right: 8px solid transparent;
        border-top: 8px solid white;
		margin-bottom:15px;
        animation: scroll 1s infinite alternate;
    }
    
    @keyframes scroll {
        0% {
            transform: translateY(0);
        }
        100% {
            transform: translateY(5px);
        }
    }
    
    @keyframes scroll {
        0% {
            transform: translateY(0);
        }
        100% {
            transform: translateY(10px);
        }
    }
</style>


<script>
        // Sayfanın en altına kaydırıldığında oku gizle
        window.onscroll = function() {
            var scrollIndicator = document.querySelector('.scroll-indicator');
            if (document.body.scrollHeight - window.innerHeight <= window.scrollY) {
                scrollIndicator.style.display = 'none';
            } else {
                scrollIndicator.style.display = 'flex';
            }
        };
    </script>



<style> 


.yanipsonenyazinew {
      animation: blinker1 0.3s linear infinite;
      color: #1c87c9;
    
      font-weight: bold;
      font-family: sans-serif;
      }
      @keyframes blinker1 {  
      50% { opacity: 0.6; }
      }


      .yanipsonenyazi {
      animation: blinker 0.7s linear infinite;
      color: #1c87c9;
    
      font-weight: bold;
      font-family: sans-serif;
      }
      @keyframes blinker {  
      50% { opacity: 0.5; }
      }


      .yanipsonenyazi2 {
      animation: blinker 0.3s linear infinite;
      color: #1c87c9;
  
      }
      @keyframes blinker {  
      50% { opacity: 0.5; }
      }
  </style>




<script>


function showWindow($url) {
          var width = 750;
        var height = 620;

        // Pencerenin konumunu hesapla
        var left = (screen.width / 2) - (width / 2);
        var top = (screen.height / 2) - (height / 2);
        var newWindow = window.open($url, 'Yeni Pencere', 'width=' + width + ',height=' + height + ',top=' + top + ',left=' + left);

        // Pencere kapanma olayını dinle
        var interval = setInterval(function() {
            if (newWindow.closed) {
                clearInterval(interval);
                location.reload();
              
            }
        }, 1000);
    };



 function showWhatsapp() {
  $('#modal-default').modal('show');
 }



  function openSweetAlertHareket(kayitid, text) {
   
        let spanText = text;

        Swal.fire({
            title: 'Onay Notunu Düzenle',
            input: 'text',
            inputLabel: "",
            inputValue: spanText,
            showCancelButton: true,
            confirmButtonText: 'Onayla',
            cancelButtonText: 'İptal'
        }).then((result) => {
            if (result.isConfirmed) {
                let newText = result.value;



                $.ajax({
        url: '<?= base_url('siparis/siparis_onay_hareket_guncelle') ?>',
        method: 'POST',
        data: {onay_aciklama: newText,kayit_id:kayitid},
        success: function(response) {
          window.location.reload();
            },
            error: function(xhr, status, error) {
                alert('Bir hata oluştu. Lütfen tekrar deneyin.');
            }
      });

 
            }
        });
    
}

  </script>