





<div class="content-wrapper p-0 mt-1"  style="<?=$pageformat == "1" ? "margin-left:0px!important;zoom:0.9":""?>;margin-top:7px!important" >
<button style="    width: -webkit-fill-available;background: #00891c;color:white;"    id="shareButton"  class="btn btn-success mr-2 mt-1" >
                        <i class="fab fa-whatsapp"></i> Sipariş Bilgilerini Whatsapp'tan Paylaş
                    </button>
<style>
        .multiline {
            white-space: pre-wrap; /* Satır sonlarını korur */
        }
    </style>
<script>
        document.getElementById('shareButton').addEventListener('click', function () {
            const message = `SATIŞ TEMSİLCİSİ : <?=$siparisi_olusturan_kullanici[0]->kullanici_ad_soyad?>\nMÜŞTERİ ADI SOYADI : <?=$siparis->musteri_ad?>\nİLETİŞİM : <?=$siparis->musteri_iletisim_numarasi?>\nİŞ YERİ ADI : <?=($siparis->merkez_adi == null || $siparis->merkez_adi == "#NULL#") ? "İŞYERİ ADI GİRİLMEDİ" : $siparis->merkez_adi?>\nTESLİMAT İL / İLÇE : <?=$siparis->sehir_adi?> / <?=$siparis->ilce_adi?>\nCİHAZ MARKASI : <?=$urunler[0]->urun_adi?>\nCİHAZ MODELİ : <?=$urunler[0]->urun_adi?>\nCİHAZ RENGİ : <?=$urunler[0]->renk_adi?>\nTOPLAM SATIŞ TUTARI : <?=number_format($urunler[0]->satis_fiyati,0)?>\nPEŞİNAT MİKTARI : <?=number_format($urunler[0]->pesinat_fiyati,0)?>\nKAPORA MİKTARI : <?=number_format($urunler[0]->kapora_fiyati,0)?>\nSENET VADE SAYISI : <?=$urunler[0]->vade_sayisi?>\nMÜŞTERİNİN İSTEDİĞİ ORTALAMA TESLİMAT TARİHİ : <?=date("d.m.Y",strtotime($siparis->musteri_talep_teslim_tarihi))?>\nVARSA HEDİYE BİLGİSİ : \nVARSA AÇIKLAMA : <?=$hareketler[1]->onay_aciklama?>
                              `;

            const encodedMessage = encodeURIComponent(message);
            const whatsappUrl = `https://wa.me/?text=${encodedMessage}`;

            window.open(whatsappUrl, '_blank');
        });
    </script>




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

                 <?php 
                        $purl = base_url("musteri/profil/$siparis->musteri_id");
                        ?>
                         
                 <span onclick="showWindow('<?= $purl?>');" style="font-weight:bold;font-size:x-large">
                 
                

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
               <a style="width: auto;background: white;" onclick="showWindow('<?=base_url("musteri/duzenle/")?><?=$siparis->musteri_id?><?="?siparis=$siparis->siparis_id"?>');" class="btn btn-white mr-2 col-4 mt-1" style="background:white;color:#043b91!important;">
                        <i class="fas fa-user"></i> Müşteri Düzenle
                    </a>
                    <a style="width: auto;background: white;" onclick="showWindow('<?=base_url("merkez/duzenle/")?><?=$siparis->merkez_id?><?="?siparis=$siparis->siparis_id"?>');" class="btn btn-white mr-2 col-4 mt-1" style="background:white;color:#043b91!important;">
                        <i class="fas fa-building"></i> Merkez Düzenle
                    </a> 
                    <?php 
                    if($siparis_fiyat_goruntule)
                    {
?>
<br>
 <a style="width: auto;background: #00891c;color:white;" onclick="showWhatsapp()" class="btn btn-white mr-2 col-4 mt-1" style="background:white;color:#043b91!important;">
                        <i class="fab fa-whatsapp"></i> Whatsapp Onay
                    </a>
<?php
                    }
                    ?>
                   <div class="row">
                    <div class="col">
                    <?php 
                  if($this->session->userdata("aktif_kullanici_id") == 37 || $this->session->userdata("aktif_kullanici_id") == 8 || $this->session->userdata("aktif_kullanici_id") == 1 || $this->session->userdata("aktif_kullanici_id") == 9){
                    ?><br><br>
                  <form method="POST" action="<?=base_url("siparis/gorusme_detay_update/$siparis->siparis_id")?>" style="display:grid">
                  <span>Sipariş Bilgi / Detay / Açıklama</span>
                  <span style="font-size:13px;opacity:0.8;margin-top:10px;margin-left:50px;margin-right:50px;">Bu bölüme girilen bilgiler tamamlanmayan siparişler ekranında gösterilmediktedir.<br>Bu işlem için yetkisi olan kullanıcılar :  İbrahim Bircan, Tolga Ağba </span>
                        <textarea name="siparis_gorusme_aciklama" class="form-control mt-2" id="siparis_gorusme_aciklama"><?=$siparis->siparis_gorusme_aciklama?></textarea>
                        <button class="btn btn-success mt-2">AÇIKLAMA KAYDET</button>
                  </form>
                    <?php
                  }
                  ?>
                    </div>
                     
                   </div>

                 
                   <script>
function silOnayla(url) {
    if (confirm("Bu kaydı silmek istediğinize emin misiniz?")) {
        window.location.href = url;
    }
}
</script>

<?php 
$f_uyari = 0;
foreach ($urunler as $urun) {
  $kalan_tutar = ($urun->satis_fiyati-($urun->pesinat_fiyati+$urun->kapora_fiyati+$urun->takas_bedeli));
 
if( $kalan_tutar>0 && $urun->vade_sayisi == 0){
  ?>
 <a  class="btn btn-danger yanipsonenyazi2" style="color:white" >
 <i class="fas fa-exclamation-circle"></i> HATALI FİYAT BİLGİSİ
                    </a>
<?php
}else if( $kalan_tutar<0){
  ?>
 <a  class="btn btn-danger yanipsonenyazi2" style="color:white" >
 <i class="fas fa-exclamation-circle"></i> HATALI FİYAT BİLGİSİ
                    </a>
<?php
}


}

 
 
$seriKodlar = array_column($urunler, 'takas_alinan_seri_kod');

 
$doluSeriKodlar = array_filter($seriKodlar);

 
if (count($doluSeriKodlar) > count(array_unique($doluSeriKodlar))) {
?>
    <a class="btn btn-danger yanipsonenyazi2" style="color:white">
        <i class="fas fa-exclamation-circle"></i> TEKRARLAYAN TAKAS SERİ KODU GİRDİNİZ!
    </a>
<?php
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
                  <div class="col text-center pt-2" style=" "> <i class="fa fa-mobile-alt " style="color:#ffffff"></i> İletişim :  <?=$siparis->musteri_iletisim_numarasi?>  <?=$siparis->musteri_sabit_numara != "" ? " / ".$siparis->musteri_sabit_numara:""?>
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
              <br>  <span style="font-weight:500"><i class="fa fa-calendar-alt"></i> Teslimat Tarihi :</span> <?=($guncel_adim>4) ? date("d.m.Y",strtotime($siparis->kurulum_tarihi)) : "<span>Tarih Belirlenmedi.</span>"?>               
              </address>
                </div>
                <!-- /.col -->







 <div class="col-sm-12 invoice-col mr-1 p-0 mt-1 <?=$siparis->degerlendirme_soru_1==0?"d-none":""?>" style="border: 3px solid #e1eeff;background:#ffffff;border: 1px solid #005cbf;background: radial-gradient(circle, rgba(237,237,237,1) 0%, rgba(255,255,255,1) 38%, rgba(255,255,255,1) 65%, rgba(226,226,226,1) 100%);">
                  <span style="font-weight:bold;color:#073669;text-align:center;background: #e3effe;display: block;padding:5px;border-bottom: 1px solid #005cbf;">

                    Sipariş Değerlendirme Sonuçları
                  </span>



                  <div class="row pt-2">
                                   <div class="col-lg-3 col-md-3 col-xs-6">
                                    <?php 
                                    $bg = "";
                                    if($siparis->degerlendirme_soru_1 == 1 || $siparis->degerlendirme_soru_1 == 2){
                                      $bg = "bg-danger";
                                    }
                                     if($siparis->degerlendirme_soru_1 == 3 || $siparis->degerlendirme_soru_1 == 4){
                                      $bg = "bg-warning";
                                    }

                                     if($siparis->degerlendirme_soru_1 == 5){
                                      $bg = "bg-success";
                                    }
                                    ?>
                    <div class="small-box <?=$bg ?>" style="height:148px">
                      <div class="inner text-center">
                        <h3 style="font-size:30px">
                          <?=$siparis->degerlendirme_soru_1?>
                        </h3>
                        <p  >
                          Teknik servis ekibimizin size karşı hitap ve davranışlarını değerlendirin.
                          <br>
                        </p> 
                      </div>
                    </div>
                  </div>
                                   <div class="col-lg-3 col-md-3 col-xs-6">

                                    <?php 
                                    $bg = "";
                                    if($siparis->degerlendirme_soru_2 == 1 || $siparis->degerlendirme_soru_2 == 2){
                                      $bg = "bg-danger";
                                    }
                                     if($siparis->degerlendirme_soru_2 == 3 || $siparis->degerlendirme_soru_2 == 4){
                                      $bg = "bg-warning";
                                    }

                                     if($siparis->degerlendirme_soru_2 == 5){
                                      $bg = "bg-success";
                                    }
                                    ?>

                    <div class="small-box <?=$bg?>" style="height:148px">
                      <div class="inner text-center">
                        <h3 style="font-size:30px">
                           <?=$siparis->degerlendirme_soru_2?>
                        </h3>
                        <p  >
                          Eğitmenin size karşı hitap ve davranışlarını değerlendirin.
                          <br>
                        </p> 
                      </div>
                    </div>
                  </div>
                                    <div class="col-lg-3 col-md-3 col-xs-6">

                                     <?php 
                                    $bg = "";
                                    if($siparis->degerlendirme_soru_3 == 1 || $siparis->degerlendirme_soru_3 == 2){
                                      $bg = "bg-danger";
                                    }
                                     if($siparis->degerlendirme_soru_3 == 3 || $siparis->degerlendirme_soru_3 == 4){
                                      $bg = "bg-warning";
                                    }

                                     if($siparis->degerlendirme_soru_3 == 5){
                                      $bg = "bg-success";
                                    }
                                    ?>
                    <div class="small-box <?=$bg?>" style="height:148px">
                      <div class="inner text-center">
                        <h3 style="font-size:30px">
                           <?=$siparis->degerlendirme_soru_3?>
                        </h3>
                        <p  >
                          Sorularınız net ve eksiksiz cevaplandı mı?
                          <br>
                        </p> 
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-xs-6">

                   <?php 
                                    $bg = "";
                                    if($siparis->degerlendirme_soru_4 == 1 || $siparis->degerlendirme_soru_4 == 2){
                                      $bg = "bg-danger";
                                    }
                                     if($siparis->degerlendirme_soru_4 == 3 || $siparis->degerlendirme_soru_4 == 4){
                                      $bg = "bg-warning";
                                    }

                                     if($siparis->degerlendirme_soru_4 == 5){
                                      $bg = "bg-success";
                                    }
                                    ?>
                    <div class="small-box <?=$bg?>" style="height:148px">
                      <div class="inner text-center">
                        <h3 style="font-size:30px">
                           <?=$siparis->degerlendirme_soru_4?>
                        </h3>
                        <p  >
                          Bizi tavsiye eder misiniz?
                          <br>
                        </p> 
                      </div>
                    </div>
                  </div>


                  <div class="col-lg-12 col-md-12 col-xs-12" style="margin-top:-5px">
                    <div class="small-box  " style="height:118px">
                      <div class="inner text-center">
                        <h3 style="font-size:20px">
                          Müşteri Öneri / Bilgi
                        </h3>
                        <p  >
                           <?=$siparis->degerlendirme_oneri != "" ? $siparis->degerlendirme_oneri : "<span style='opacity:0.5'>Müşteri tarafından öneri bilgisi girilmemiştir</span>"?>
                          <br>
                        </p> 
                      </div>
                    </div>
                  </div>

                </div>


            


                  
              </div>











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
                
                <style>
                  .button_plus { position: absolute; width: 19px; height: 20px; margin-left: 10px; background: #fff; cursor: pointer; border: 2px solid #095776; /* Mittig */   } .button_plus:after { content: ''; position: absolute; transform: translate(-50%, -50%); height: 2px; width: 50%; background: #095776; top: 50%; left: 50%; } .button_plus:before { content: ''; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: #095776; height: 50%; width: 2px; } .button_plus:hover:before, .button_plus:hover:after { background: #fff; transition: 0.2s; } .button_plus:hover { background-color: #095776; transition: 0.2s; }
                  </style>
                <table id="tableurunlersf" class="table table-striped" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    <thead>
                    <tr>
                      <th style="padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Kod</th>
                      <th style="min-width:160px;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Ürün</th>
                      <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;min-width:120px;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Ürün Başlıkları</th>
                     
                      <th style="padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Seri Numarası</th>
                      <th style="padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Renk</th>
                     
                    <?php 
                    if($siparis_fiyat_goruntule){
                      ?>

                          <th style="min-width:120px;padding-top:5px;padding-bottom:5px;font-weight: 700; color:white;background: #00347d;border-bottom:0px solid">Satış Fiyatı</th>
                          <th style="min-width:120px;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Kapora Fiyatı</th>
                          <th style="min-width:120px;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Peşinat Fiyatı</th>
                     
                          <th style="min-width:120px;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #b00101ff;border-bottom:0px solid">Hediye</th>
                          <th style="min-width:120px;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Kalan Tutar</th>
                          <th style="min-width:120px;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Vade Sayısı</th>
                          <th style="min-width:120px;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Fatura Tutarı</th>
                      <?php
                    }
                      ?>

                    
                      <th style="padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Takas Bedeli</th>
                      <th style="padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Açılış Ekranı</th>
                  
                      <th style="padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Takas Cihaz Seri Kod</th>
                      <th style="padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Takas Cihaz Model</th>
                      <th style="padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Takas Cihaz Renk</th>
                  <th style="padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Damla Etiket</th>
                  
                    </tr>
                    </thead>
                    <tbody>
                        <?php $count = 0;
                          $urunsayi = count($urunler);
                            foreach ($urunler as $urun) {

                              if($urun->para_birimi == "TRY"){
                                $paraicon = " ₺";
                              }
                               if($urun->para_birimi == "EUR"){
                                $paraicon = " €";
                              }
                               if($urun->para_birimi == "USD"){
                                $paraicon = " $";
                              }


                              $count++;
                               ?>
                                    <tr style="<?=($urun->yenilenmis_cihaz_mi == 1) ? "background:green;color:white;":""?>">
                                      
                                        <td>
                                          <?php 
                                          
                                          if($urunsayi>1){
                                            $aktarimurl = base_url('siparis/siparis_ayir/'.$siparis->siparis_id.'/'.$urun->siparis_urun_id);
                                            ?>
                                             
<a onclick="confirm_action('Aktarım İşlemini Onayla','Seçilen bu ürünü yeni siparişe aktarmak istediğinize emin misiniz ? Bu işlem geri alınamaz.','Onayla','<?=$aktarimurl?>');"  class='btn btn-warning'>Sipariş Ayır</a>
                                          
<?php
}else{
                                            echo "-";
                                          }
                                          
                                          ?>
                                        
                                        <?=$urunsayi>1 ? "" : "-" ?>
                                      
                                      <?php 
                                      if($urun->yurtdisi_mi == 1){
                                        ?>
                                        <span class="badge bg-danger yanipsonenyazi2">YURTDIŞI CİHAZ</span>
                                        <?php
                                      }
                                      ?>
                                      
                                      
                                      </td>
                                        <td><?=$urun->urun_adi?>
                                        <?php 
                                        if($urun->yenilenmis_cihaz_mi == 1){
                                          echo "<span>(Yenilenmiş Cihaz)</span>";
                                        }
                                        ?>
                                        
 

</td>
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
                                            echo "<td style='font-weight: 700;'>".number_format($urun->satis_fiyati,2)."$paraicon"."</td>";
                                          }
                                        
                                        ?>
                                        
                                    
                                        <?php 
                                          if($siparis_fiyat_goruntule){
                                            foreach ($ara_odemeler as $odeme) {
                                              $urun->kapora_fiyati += $odeme->siparis_ara_odeme_miktar;
                                            }
                                            echo "<td>".number_format($urun->kapora_fiyati,2)."$paraicon";
                                            ?>


                                              <span href="#" class="button_plus" onclick="document.getElementById('araodeme_form').style.display = 'grid';"></span>
                                            <?php
 
                  if( $this->session->userdata("aktif_kullanici_id") == 1 || $this->session->userdata("aktif_kullanici_id") == 9){
                  ?>
                    <br><br>
                  <form method="POST" action="<?=base_url("siparis/add_ara_odeme/$siparis->siparis_id")?>" id="araodeme_form" style="display:none;margin-bottom:10px;">
                
                  <div    >
                  <input type="number" required placeholder="Ara ödeme miktarı" min="1" class="form-control" name="siparis_ara_odeme_miktar" />
                  <input type="date"  required class="form-control" name="siparis_ara_odeme_tarih" value="<?=date("Y-m-d")?>" />
                  </div>
                        <button class="btn btn-success mt-2">ARA ÖDEME KAYDET</button>
                  </form>
                  <?php
  
                  }
                 
                                                                              
                                        foreach ($ara_odemeler as $odeme) {
                                            $toplamaraodeme += $odeme->siparis_ara_odeme_miktar;
                                            $araodemesira++;
                                            $silmeUrl = base_url("siparis/delete_ara_odeme/$odeme->siparis_ara_odeme_id/$siparis->siparis_id");  
                                      
                                          ?>
                                            <div class="d-flex align-items-center mb-2">
                                                <button type="button" class="btn btn-outline-warning btn-lg flex-grow-1" style="padding: 0 10px; color: green; border: 1px solid; font-size: 12px !important;">
                                                    <?= $odeme->siparis_ara_odeme_miktar ?> TL (<?= date("d.m.Y", strtotime($odeme->siparis_ara_odeme_tarih)) ?>)
                                                </button>
                                               
                                                <button   style="background: transparent;
    border: 0;color: #ff0000; margin-left: 7px;" onclick="silOnayla('<?= $silmeUrl ?>')">X</button>
                                            </div>
                                          <?php
                                        
                                        }
                                        


                                            echo "</td>";
                                          }
                                        
                                        ?>
                            
                                     
                                        <?php 
                                          if($siparis_fiyat_goruntule){
                                            echo "<td>".number_format($urun->pesinat_fiyati,2)."$paraicon"."</td>";
                                          }
                                        ?>  
  

<?php 
                                          if($siparis_fiyat_goruntule){
                                            ?>
                                            <td><?=$urun->siparis_hediye_adi?></td>
                                            <?php
                                           
                                          }
                                        ?>  
                                        
                                        <?php 
                                          if($siparis_fiyat_goruntule){
                                            $kalan_tutar = ($urun->satis_fiyati-($urun->pesinat_fiyati+$urun->kapora_fiyati+$urun->takas_bedeli));
                                            echo "<td>".((($kalan_tutar>0 && $urun->vade_sayisi == 0) || $kalan_tutar < 0) ? "<span class='text-danger yanipsonenyazi'>Hatalı</span> " : "").number_format($kalan_tutar ,2)."$paraicon</td>";
                                       
                                          }
                                        ?>  

                                        <?php 
                                          if($siparis_fiyat_goruntule){
                                            echo "<td>".$urun->vade_sayisi;

                                            if($urun->vade_sayisi > 0){
                                              echo "<span style='opacity:0.5'> - Taksit :".(number_format($kalan_tutar/$urun->vade_sayisi)."$paraicon</span>");
                                            } 
                                           
                                            echo "</td>";
                                          }
                                        ?>  

<?php 
                                          if($siparis_fiyat_goruntule){
                                            echo "<td>".number_format($urun->fatura_tutari,2)."$paraicon"."</td>";
                                          }
                                        ?>
                                            <td>
                                              <?php 
                                                echo number_format($urun->takas_bedeli,2)."$paraicon";
                                              ?>
                                                <?php
                                             if($urun->takas_bedeli>0){
                                              ?><br>
                                            <span class="badge bg-danger" style="font-size: 14px;  font-family: monospace;text-align: left;background: #ffd1d1 !important; color: #b30000 !important; border: 1px solid red;">
                                           <?php
                                              echo "<b>".$urun->takas_alinan_seri_kod."</b><br>";
                                              echo $urun->takas_alinan_model."(".$urun->takas_alinan_renk.")"."<br>";

                                              // Bu ürüne ait takas fotoğraflarını göster
                                              if(isset($takas_fotograflari) && !empty($takas_fotograflari) && is_array($takas_fotograflari)){
                                                  $urun_takas_fotograflari = array_filter($takas_fotograflari, function($foto) use ($urun) {
                                                      return isset($foto->urun_id) && isset($urun->siparis_urun_id) && $foto->urun_id == $urun->siparis_urun_id;
                                                  });
                                              }else{
                                                  $urun_takas_fotograflari = [];
                                              }
                                              if(!empty($urun_takas_fotograflari)){
                                                echo "<br><small style='color:#b30000'>Fotoğraflar:</small><br>";
                                                foreach($urun_takas_fotograflari as $foto){
                                                    if(isset($foto->foto_url)){
                                                        echo "<img src='".base_url($foto->foto_url)."' style='max-width:50px;max-height:50px;margin:2px;border:1px solid #ccc;' onclick='showTakasFoto(this.src)' />";
                                                    }
                                                }
                                              }
                                             }
                                             ?>
                                            </span>
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


                                          <td>
                                        <?=(($urun->damla_etiket == 1) ? "<span class='badge bg-default  text-success' style='background: #d6ebd1;padding:5px;font-weight:normal'><i class='fa fa-check-circle text-success'></i> EVET / YAPILACAK</span>" : "<span style='background: #ffdddd;padding:5px;font-weight:normal' class='badge bg-default  text-danger'><i class='fa fa-times-circle text-danger'></i> HAYIR / YAPILMAYACAK</span>")?>
                                          </td>
                                        

                                    </tr>

                                    <?php 
                                    if($urun->teslimat_merkez_no != 0){
                                      ?>
                                      <tr>
                                        <td>
                                          <b style="color:red">Teslimat Adresi : </b>
                                    </td>
                                        <td colspan = "15" style="color:red">
                                          <?php 
                                          $controlm = get_merkez_by_teslimat_id($urun->teslimat_merkez_no);
                                          ?>
                                          <?=$controlm->merkez_adi." - ".$controlm->merkez_adresi?>
                                        </td>
                                    </tr>
                                    <tr>
                                         
                                        <td colspan = "16">
                                         </td>
                                    </tr>
                                    <tr>
                                         
                                         <td colspan = "16">
                                          </td>
                                     </tr>
                                     
                                      <?php
                                    }
                                    ?>
                               <?php
                            }
                        ?>
                    
                  
                    </tbody>
                  </table>

<?php 
if($this->session->userdata("aktif_kullanici_id") == 1 || $this->session->userdata("aktif_kullanici_id") == 9){
?>
<div class="btn-group" style="display: contents;">
  <label for="" style="display: block; color: red;">Siparişe Yeni Cihaz Ekle</label>
  
  <a href="#" onclick='confirmRedirect("<?=base_url("siparis/siparise_urun_ekle/$siparis->siparis_id/8")?>")' class="btn btn-default">
    <i class="fa fa-plus-circle text-success"></i> Umex Plus
  </a>
  
  <a href="#" onclick='confirmRedirect("<?=base_url("siparis/siparise_urun_ekle/$siparis->siparis_id/1")?>")' class="btn btn-default">
    <i class="fa fa-plus-circle text-success"></i> Umex Lazer
  </a>
  
  <a href="#" onclick='confirmRedirect("<?=base_url("siparis/siparise_urun_ekle/$siparis->siparis_id/5")?>")' class="btn btn-default">
    <i class="fa fa-plus-circle text-success"></i> Umex Slim
  </a>
  
  <a href="#" onclick='confirmRedirect("<?=base_url("siparis/siparise_urun_ekle/$siparis->siparis_id/3")?>")' class="btn btn-default">
    <i class="fa fa-plus-circle text-success"></i> Umex EMS
  </a>
  
  <a href="#" onclick='confirmRedirect("<?=base_url("siparis/siparise_urun_ekle/$siparis->siparis_id/7")?>")' class="btn btn-default">
    <i class="fa fa-plus-circle text-success"></i> Umex Q
  </a>
  
  <a href="#" onclick='confirmRedirect("<?=base_url("siparis/siparise_urun_ekle/$siparis->siparis_id/6")?>")' class="btn btn-default">
    <i class="fa fa-plus-circle text-success"></i> Umex S
  </a>
  
  <a href="#" onclick='confirmRedirect("<?=base_url("siparis/siparise_urun_ekle/$siparis->siparis_id/4")?>")' class="btn btn-default">
    <i class="fa fa-plus-circle text-success"></i> Umex Gold
  </a>
  
  <a href="#" onclick='confirmRedirect("<?=base_url("siparis/siparise_urun_ekle/$siparis->siparis_id/2")?>")' class="btn btn-default">
    <i class="fa fa-plus-circle text-success"></i> Umex Diode
  </a>
</div><br><br><br>

<form action="<?=base_url("siparis/siparis_iptal_et/$siparis->siparis_id")?>" method="post" style="border: 2px dashed red;
    padding: 10px;">

<div class="form-group">
                    <label for="exampleInputPassword1" class="text-danger">Siparişi İptal Et</label>
                    <input type="text" name="siparis_iptal_nedeni" required class="form-control" placeholder="Siparişi iptal etme gerekçenizi giriniz">
                    <button type="submit" class="btn btn-danger mt-2">Siparişi İptal Et</button>
                  </div>

</form>


<br><br>
<?php
}

?>
                  


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
               
                            
               
                             <?php if($siparis->egitim_var_mi && $siparis->egitim_ekip != null) : ?>
                           
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
                                         <?php 
                                         if($count == 11){
                                            ?>
                                            <a href="<?=base_url("siparis/save_kurulum_rapor_view/".$siparis->siparis_id)?>" class="btn btn-default btn-xs">Teslimat Formu Düzenle</a>
                                            <?php
                                          if($siparis->musteri_degerlendirme_sms == 1){
                                            ?>
                                            <a class="btn btn-danger btn-xs">Sms Gönderildi : <?=date("d.m.Y H:i",strtotime($siparis->degerlendirme_sms_gonderim_tarihi))?></a>
                                           
                                            <?php
                                          } 
                                          ?>
                                           <?php
                                         }
                                         ?>
                                       
                                      </td>


                                      <td>
                                      <span>
                                        <?php 
                                        if($this->session->userdata('aktif_kullanici_id') == 9){
                                          ?>
                                           <?=$hareket->onay_aciklama != "" ? "<span onclick=\"openSweetAlertHareket('".$hareket->siparis_onay_hareket_id."','".$hareket->onay_aciklama."')\" class='badge bg-".((stripos($hareket->onay_aciklama, "otomatik") !== false) ?"default":"danger") ."' style='padding:5px'><i class='fas fa-exclamation-circle'></i> ".$hareket->onay_aciklama."</span>" :"<span onclick=\"openSweetAlertHareket('".$hareket->siparis_onay_hareket_id."','".$hareket->onay_aciklama."')\"  class='badge bg-default' style='background:#f3f3f3;padding:5px'><i class='far fa-comment'></i> Sipariş Onay Notu Girilmedi</span>"?>
                                    
                                          <?php
                                        }else{
                                          ?>
                                             <?=$hareket->onay_aciklama != "" ? "<span   class='badge bg-".((stripos($hareket->onay_aciklama, "otomatik") !== false) ?"default":"danger") ."' style='padding:5px'><i class='fas fa-exclamation-circle'></i> ".$hareket->onay_aciklama."</span>" :"<span    class='badge bg-default' style='background:#f3f3f3;padding:5px'><i class='far fa-comment'></i> Sipariş Onay Notu Girilmedi</span>"?>
                                    
                                          <?php
                                        }
                                        ?>
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
                                    if($siparis->siparis_ust_satis_onayi == 1 && $count == 3){
                                      ?>
                                      <tr style="background:#35a74c1c">
                                        <td>3.1</td>
                                        <td><b><i class="fa fa-check text-success"></i> Üst Yönetim Onayı</b> </td>
                                        <td><i class="fa fa-check text-success"></i> Uğur ÖLMEZ tarafından onaylanmıştır.</td>
                                        <td>
                                        <b>
                                          <i class="fa fa-user-circle"></i>  
                                        UĞUR ÖLMEZ
                            </b>   
                                       </td>
                                        <td><b><?=date("d.m.Y",strtotime($siparis->siparis_ust_satis_onay_tarihi))?></b> <?=date("H:i",strtotime($siparis->siparis_ust_satis_onay_tarihi))?></td>
                                    </tr>
                                      <?php
                                    }
                                    ?>









                               <?php
                            }
                        ?>
                    

                    <?php foreach ($adimlar as $adim) :?>
                      <?php if($guncel_adim > $adim->adim_sira_numarasi) continue; ?>
                     <tr> <td><?=$adim->adim_sira_numarasi?></td>
                      <td style="opacity:0.6"><i class="fas fa-hourglass-half mr-1"></i> <?=$adim->adim_adi?>
                      <?php 
                                         if($adim->adim_sira_numarasi == 11){
                                            ?>
                                            <a href="<?=base_url("siparis/save_kurulum_rapor_view/".$siparis->siparis_id)?>" class="btn btn-default btn-xs">Teslimat Formu Düzenle</a>
                                          
                                         
                                            
                                         <?php
                                         }
                                         ?>
                    </td>
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


        if($guncel_adim == 4 && $siparis->siparis_ust_satis_onayi == 0){

          if(goruntuleme_kontrol("siparis_ikinci_onay")){
            ?>
            <a href="<?=base_url("siparis/ust_satis_onayini_ver/".$siparis->siparis_id)?>" class="btn btn-danger" style="    width: 100%;
margin-bottom: 20px;">
                    <i class="fas fa-check"></i> 2. SATIŞ ONAYINI VER
            </a>


        <?php
          }
          
          

        }else{

        
              <?php 
              // View'da da ek kontrol: Kullanıcı bu adımı daha önce onaylamış mı?
              $kullanici_bu_adimi_onaylamis = false;
              if(!empty($hareketler) && count($hareketler) > 0 && isset($guncel_adim)){
                  foreach($hareketler as $hareket){
                      if($hareket->adim_no == $guncel_adim && isset($hareket->onay_kullanici_id) && $hareket->onay_kullanici_id == $this->session->userdata('aktif_kullanici_id')){
                          $kullanici_bu_adimi_onaylamis = true;
                          break;
                      }
                  }
              }
              
              // Sipariş tamamlanmış mı kontrol et (adim_no > 11)
              $siparis_tamamlanmis = false;
              if(!empty($hareketler) && count($hareketler) > 0){
                  $son_hareket = $hareketler[count($hareketler)-1];
                  if(isset($son_hareket->adim_no) && $son_hareket->adim_no > 11){
                      $siparis_tamamlanmis = true;
                  }
              }
              
              // Buton sadece: onay_durum true, kullanıcı bu adımı onaylamamış ve sipariş tamamlanmamışsa göster
              if($onay_durum == true && !$kullanici_bu_adimi_onaylamis && !$siparis_tamamlanmis){
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
 <div class="form-group col">
      <i class="fas fa-desktop text-success"></i> <span class="text-danger">Yurtdışı Cihazı Mı?</span>
       <select name="yurtdisi_mi<?=$urun->siparis_urun_id?>" required id="" class="form-control">
        <option value="">SEÇİM YAPINIZ</option>
        <option value="1" >EVET</option>
        <option value="0" >HAYIR</option>
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
               $cihazlarhavuz = get_havuz($urun->urun_id,$urun->renk_id,$urun->yenilenmis_cihaz_mi);
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
    <select class="select2 d-block" required name="egitim_var_mi2" style="width:100%" id="egitimDurumu">
      <option value="">Seçim Yapınız</option>
      <option value="1"  >Eğitim Var</option>
      <option value="0"  >Eğitim Yok</option>
    </select>
  </div>
</div>

<div class="form-group">
  <i class="fas fa-calendar-alt text-danger"></i> Eğitim Tarihi
  <input type="text"   class="form-control" name="egitim_tarih" data-inputmask-alias="datetime" data-inputmask-inputformat="dd.mm.yyyy" data-mask="" inputmode="numeric" id="egitimTarihi">
</div>

<div class="form-group">
  <i class="fas fa-users text-primary"></i> Eğitmen
  <select class="select2bs4"   name="egitim_ekip[]" data-placeholder="Eğitmen Seçimi Yapınız" style="width: 100%;" id="egitimEkip">
    <option value="">Seçim Yapınız</option>
    <?php foreach($egitmenler as $kullanici) : ?>
      <?php
        if($kullanici->kullanici_aktif == 0){
          continue;
        }
        $selected = (is_array(json_decode($siparis->egitim_ekip)) && in_array($kullanici->kullanici_id, json_decode($siparis->egitim_ekip))) ? 'selected="selected"' : '';
      ?>
      <option <?=$selected?> value="<?=$kullanici->kullanici_id?>">
        <strong><?=$kullanici->kullanici_ad_soyad?></strong> / <?=$kullanici->kullanici_unvan?>
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
            



<?php if($guncel_adim == 11) : ?>

  <div class="form-check">
    <input class="form-check-input" type="checkbox" required>
    <label class="form-check-label" style="    font-size: 18px;">Odanın Fotoğrafı Çekildi Mi ?</label>
  </div>
   <div class="form-check">
    <input class="form-check-input" type="checkbox" required>
    <label class="form-check-label" style="    font-size: 18px;">Cihazın Sağdan Fotoğrafı Çekildi Mi ?</label>
  </div>
   <div class="form-check">
    <input class="form-check-input" type="checkbox" required>
    <label class="form-check-label" style="    font-size: 18px;">Cihazın Soldan Fotoğrafı Çekildi Mi ?</label>
  </div>
   <div class="form-check">
    <input class="form-check-input" type="checkbox" required>
    <label class="form-check-label" style="    font-size: 18px;">Cihazın Önden Fotoğrafı Çekildi Mi ?</label>
  </div>

     <div class="form-check">
    <input class="form-check-input" type="checkbox" required>
    <label class="form-check-label" style="    font-size: 18px;">Cihazın Arkadan Fotoğrafı Çekildi Mi ?</label>
  </div>

   <div class="form-check">
    <input class="form-check-input" type="checkbox" >
    <label class="form-check-label" style="    font-size: 18px;">Yazıcı Çıktı Fotoğrafı Çekildi Mi ?</label>
  </div>

     <div class="form-check">
    <input class="form-check-input" type="checkbox" required>
    <label class="form-check-label" style="    font-size: 18px;">İzolasyon Görüntüsü ?</label>
  </div>


       <div class="form-check">
    <input class="form-check-input" type="checkbox" required>
    <label class="form-check-label" style="    font-size: 18px;">RollUp Fotoğrafı ?</label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="checkbox" required>
    <label class="form-check-label" style="    font-size: 18px;">Ölçü aleti videosu ?</label>
  </div>

 <div class="form-check">
    <input class="form-check-input" type="checkbox" required>
    <label class="form-check-label" style="    font-size: 18px;">Cihaz Su Gösterge Fotoğrafı ?</label>
  </div>

  

 <?php endif; ?>



<br>




<?php if($guncel_adim == 8) : ?>


 

  <div class="timeline mb-0">
  <div class="timeline-item">
  <div class="form-group">
  Etiket Kontrolleri Yapıldı Mı ?
  <select class="form-control" required style="width: 100%;" name="kontrol_1_select">
    <option value="">SEÇİM YAPINIZ</option>
    <option value="1">KONTROL EDİLDİ</option>
</select>
</div></div>
<div class="timeline-item">
<div class="form-group">
   <?php 
                                      if($urunler[0]->yurtdisi_mi == 1){
                                        ?>
                                          <img src="<?=base_url("assets/acil-button.png")?>" style="width:250px" alt="">
                                        <?php
                                      }
                                      ?>


Acil Button Kontrolü Yapıldı Mı ?
  <select class="form-control" required style="width: 100%;" name="kontrol_2_select">
    <option value="">SEÇİM YAPINIZ</option>
    <option value="1">KONTROL EDİLDİ</option>
</select>
</div>
</div>

<div class="timeline-item">
<div class="form-group">
Fiş Tipi Kontrolü Yapıldı Mı?
  <select class="form-control" required style="width: 100%;" name="kontrol_3_select">
    <option value="">SEÇİM YAPINIZ</option>
    <option value="1">KONTROL EDİLDİ</option>
</select>
<div class="btn-group btn-group-toggle" style="margin-top:15px;" data-toggle="buttons">
                  <label style="<?=(!$siparis->fis_tipi_A) ? "display:none;" : "padding: 0; background: white;  "?>" class="btn btn-secondary active">
                    <img src="<?=base_url("assets/dist/tip_a.png")?>" alt="" srcset="">
                  </label> 
                  <label style="<?=(!$siparis->fis_tipi_B) ? "display:none;" : "padding: 0; background: white; margin-left: 5px;"?>" class="btn btn-secondary active">
                    <img src="<?=base_url("assets/dist/tip_b.png")?>" alt="" srcset="">
                  </label> 
                  <label style="<?=(!$siparis->fis_tipi_C) ? "display:none;" : "padding: 0; background: white; margin-left: 5px;"?>" class="btn btn-secondary active">
                    <img src="<?=base_url("assets/dist/tip_c.png")?>" alt="" srcset="">
                  </label> 
                  <label style="<?=(!$siparis->fis_tipi_D) ? "display:none;" : "padding: 0; background: white; margin-left: 5px;"?>" class="btn btn-secondary active">
                    <img src="<?=base_url("assets/dist/tip_d.png")?>" alt="" srcset="">
                  </label> 
                  <label style="<?=(!$siparis->fis_tipi_E) ? "display:none;" : "padding: 0; background: white; margin-left: 5px;"?>" class="btn btn-secondary active">
                    <img src="<?=base_url("assets/dist/tip_e.png")?>" alt="" srcset="">
                  </label> 
                  <label style="<?=(!$siparis->fis_tipi_F) ? "display:none;" : "padding: 0; background: white; margin-left: 5px;"?>" class="btn btn-secondary active">
                    <img src="<?=base_url("assets/dist/tip_f.png")?>" alt="" srcset="">
                  </label> 
                  <label style="<?=(!$siparis->fis_tipi_G) ? "display:none;" : "padding: 0; background: white; margin-left: 5px;"?>" class="btn btn-secondary active">
                    <img src="<?=base_url("assets/dist/tip_g.png")?>" alt="" srcset="">
                  </label> 
                  <label style="<?=(!$siparis->fis_tipi_H) ? "display:none;" : "padding: 0; background: white; margin-left: 5px;"?>" class="btn btn-secondary active">
                    <img src="<?=base_url("assets/dist/tip_h.png")?>" alt="" srcset="">
                  </label> 
                  <label style="<?=(!$siparis->fis_tipi_I) ? "display:none;" : "padding: 0; background: white; margin-left: 5px;"?>" class="btn btn-secondary active">
                    <img src="<?=base_url("assets/dist/tip_i.png")?>" alt="" srcset="">
                  </label> 
                  <label style="<?=(!$siparis->fis_tipi_J) ? "display:none;" : "padding: 0; background: white; margin-left: 5px;"?>" class="btn btn-secondary active">
                    <img src="<?=base_url("assets/dist/tip_j.png")?>" alt="" srcset="">
                  </label> 
                  <label style="<?=(!$siparis->fis_tipi_K) ? "display:none;" : "padding: 0; background: white; margin-left: 5px;"?>" class="btn btn-secondary active">
                    <img src="<?=base_url("assets/dist/tip_k.png")?>" alt="" srcset="">
                  </label> 
                  <label style="<?=(!$siparis->fis_tipi_L) ? "display:none;" : "padding: 0; background: white; margin-left: 5px;"?>" class="btn btn-secondary active">
                    <img src="<?=base_url("assets/dist/tip_l.png")?>" alt="" srcset="">
                  </label> 
                  <label style="<?=(!$siparis->fis_tipi_M) ? "display:none;" : "padding: 0; background: white; margin-left: 5px;"?>" class="btn btn-secondary active">
                    <img src="<?=base_url("assets/dist/tip_m.png")?>" alt="" srcset="">
                  </label> 
                  <label style="<?=(!$siparis->fis_tipi_N) ? "display:none;" : "padding: 0; background: white; margin-left: 5px;"?>" class="btn btn-secondary active">
                    <img src="<?=base_url("assets/dist/tip_n.png")?>" alt="" srcset="">
                  </label> 
                  <label style="<?=(!$siparis->fis_tipi_O) ? "display:none;" : "padding: 0; background: white; margin-left: 5px;"?>" class="btn btn-secondary active">
                    <img src="<?=base_url("assets/dist/tip_o.png")?>" alt="" srcset="">
                  </label> 
                </div>
</div></div>

<div class="timeline-item">
<div class="form-group">
Cihaz Dil Kontrolü Yapıldı Mı?
  <select  class="form-control" required style="width: 100%;" name="kontrol_3_select">
    <option value="">SEÇİM YAPINIZ</option>
    <option value="1">KONTROL EDİLDİ</option>
</select>

</div></div>  <div class="timeline-item">

<div class="form-group">
Kullanım Kılavuzu Kontrolü Yapıldı Mı?
  <select  class="form-control" required style="width: 100%;" name="kontrol_4_select">
    <option value="">SEÇİM YAPINIZ</option>
    <option value="1">KONTROL EDİLDİ</option>
</select>

</div>

<?php  if($urunler[0]->yurtdisi_mi == 1){
                                        ?>
                                           
<div class="form-group">
Yedek Parça Kontrolü Yapıldı Mı?
  <select  class="form-control" required style="width: 100%;" name="kontrol_5_select">
    <option value="">SEÇİM YAPINIZ</option>
    <option value="1">KONTROL EDİLDİ</option>
</select>
<textarea readonly style="width: -webkit-fill-available;height:600px">
UMEX LAZER ANAKART
ANA VE YARDIMCI İŞLEMCİ (4620)
ENTEGRE ÇEŞİTLERİ (TLP521-2 / TLP521-4 / ULN 2003)
DİJİTAL ISI SENSÖR TAKIMI
1 TAKIM KONTAKTÖR
DİJİTAL SU AKIŞ SENSÖRÜ 
ACİL BUTON TAKIMI
AÇMA-KAPAMA ANAHTAR TAKIMI
GÜÇ KAYNAĞI ÇEŞİTLERİ
*12 V 1,3 AMPER
*12 V 4,2 AMPER
*12 V 8,5 AMPER
*24 V 8,8 AMPER
ŞALTER (C16 2'Lİ)
PNÖMATİK ÇEŞİTLERİ
*8-8 PERDE GEÇİŞ
*8-8 DİRSEK
*12-8 DÜZ
*8-4 DÜZ 
* 12-12 DİRSEK
*8-8-6 T PNÖMATİK
SU HORTUMU ÇEŞİTLERİ ( 4 LÜK - 6 LIK - 8 LİK - 12 LİK)
HAVA HORTUMU
BAŞLIK KULP TAKIMI
SU MOTORU
5*20 - 30 AMPER SERAMİK SİGORTA
BAŞLIK HAVA HORTUM GİRİŞ ORİNGİ
BAŞLIK ATIŞ BUTONU
50 CAM 50 SİLİKON
LAZER SOĞUK HAVALI BAŞLIK
ULTRASON JELİ
KULLANICI VE HASTA GÖZLÜĞÜ
                                      </textarea>
</div>

        <?php
                                      }
                                      ?>
<div class="form-group">
Paketleme Kutusu Kontrolü ?
  <select  class="form-control" required style="width: 100%;" name="kontrol_5_select">
    <option value="">SEÇİM YAPINIZ</option>
    <option value="1">KONTROL EDİLDİ</option>
</select>

</div>


</div>
</div>
<?php endif;?>







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
                    <button <?=($guncel_adim >= 4 && $guncel_adim != 5 && $this->session->userdata('aktif_kullanici_id') == 9 ) ? "disabled" : ""?> class="btn btn-success" style="flex:1">
                        <i class="fas fa-check"></i> SİPARİŞİ ONAYLA
                    </button>

                    
 
                   
                </div>

                <?php
              }
            ?>

         



          </form>
          <?php }} ?>

          <div class="row">
                   
                   
                    <!-- Merkez Bilgilerini Düzenle -->
                    <a href="<?=base_url("siparis/save_merkez_bilgi_dogrulama_view/".$siparis->siparis_id)?>" class="btn btn-dark mr-2 col-6 col-md-3" style="flex:1">
                        <i class="fas fa-pen"></i> Sipariş Detaylarını Düzenle
                    </a>  
                    <?php 
                    if($this->session->userdata("aktif_kullanici_id") != 9){
                      ?>
   <!-- Merkez Bilgilerini Düzenle -->
   <a href="<?=base_url("siparis/siparis_genel_duzenleme_view/".$siparis->siparis_id)?>" class="btn btn-dark mr-2 col-6 col-md-3" style="flex:1">
                        <i class="fas fa-pen"></i> Sipariş Detaylarını Düzenle 
                    </a>
                      <?php
                    }
                    ?>
                    
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
                    
                  
                    <?php 
                    if(isset($takas_fotograflari) && !empty($takas_fotograflari) && is_array($takas_fotograflari) && count($takas_fotograflari) > 0){
                    ?>    
                    <button type="button" class="btn btn-primary mr-2 col-6 col-md-3" style="flex:1" data-toggle="modal" data-target="#takasFotoModalAll<?=$siparis->siparis_id?>">
                        <i class="fas fa-camera"></i> Takas Fotoğrafları (<?=count($takas_fotograflari)?>)
                        </button>
                    <?php
                    }
                    ?>
                   
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
$kalan_tutar = 0;
foreach ($urunler as $urun) {
$s_fiyat+=$urun->satis_fiyati;
$k_fiyat+=$urun->kapora_fiyati;
$p_fiyat+=$urun->pesinat_fiyati;


  $kalan_tutar += ($urun->satis_fiyati-($urun->pesinat_fiyati+$urun->kapora_fiyati+$urun->takas_bedeli));
  echo (($urun->yenilenmis_cihaz_mi == 1) ? "YENİLENMİŞ " : "")."*".mb_strtoupper($urun->urun_adi)."* (".mb_strtoupper($urun->renk_adi).") SİPARİŞİNİZ;";


  $jsonData = json_encode(get_basliklar($urun->basliklar), true);
 
  $data = json_decode($jsonData, true);

   
  $basliklar = array_map(function($item) use($urun) {
      return str_replace("($urun->urun_adi)","",$item['baslik_adi']);
  }, $data);

  if($urun->basliklar != null && $urun->basliklar != "" && $urun->basliklar != "null")
  { 
    if($urun->urun_id == 5){
      echo "\nSTANDART SLİM BAŞLIK";
    }else{
      $edited_text =mb_strtoupper(str_replace("  "," ",str_replace(" 2","",str_replace(" 1","",implode(" BAŞLIK, ", $basliklar)))))."BAŞLIK" ;
      echo "\n".str_replace("SOĞUK HAVA BAŞLIK, SOĞUK HAVA BAŞLIK","2 ADET SOĞUK HAVA BAŞLIK",$edited_text);
  
    }
   
  }
  else{
    echo "<span class='text-danger'>Başlık Seçilmedi</span>";

  }
 
  echo " İLE BERABER;\n\n";

}

?>

<?="*".date("d.m.Y",strtotime($siparis->musteri_talep_teslim_tarihi))."*"?>  TARİHİNDE TESLİM EDİLECEKTİR.

_ÖDEME PLANINIZ ŞU ŞEKİLDEDİR :_
*ÖDENECEK TOPLAM TUTAR:* <?=number_format($s_fiyat,0)?> ₺
*KAPORA:* <?=number_format($k_fiyat,0)?> ₺ ALINDI
*PEŞİNAT:* <?=number_format($p_fiyat,0)?> ₺ CİHAZ KURULUMU SIRASINDA ALINACAKTIR
 
<?php 
if($kalan_tutar > 0){
?>

<?php  $kalan_tutary=0;
foreach ($urunler as $uruny) {

  $kalan_tutary  = ($uruny->satis_fiyati-($uruny->pesinat_fiyati+$uruny->kapora_fiyati+$uruny->takas_bedeli));
 ?>


*KALAN :* (<?=$uruny->urun_adi?>) <?=number_format($kalan_tutary ,2)?> ₺ <?=($uruny->vade_sayisi > 0) ? $uruny->vade_sayisi." AY VADELİ SENET YAPILACAKTIR" : ""?>
<?php
}

?>


<?php
}
?>
<?php echo "\n";?> ÖDEMELER FATURA KESİLECEĞİNDEN DOLAYI SADECE HAVALE İLE BANKA HESABI ÜZERİNDEN ALINACAKTIR. KREDİ KARTI VE ELDEN ÖDEME KABUL EDİLMEMEKTEDİR. BİLGİNİZE ARZ EDİLİR
RİCA ETSEM  AŞAĞIDA İSTEDİĞİM BİLGİLERİ YAZABİLİR MİSİNİZ?
*AD VE SOYAD*
*GÜZELLİK MERKEZİ ADI*
*MERKEZİN AÇIK ADRESİ*
*MERKEZİNİZE AİT SOSYAL MEDYA HESAP BİLGİLERİ*
*TC KİMLİK NUMARASI*

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



  function showTakasFoto(src) {
    Swal.fire({
      imageUrl: src,
      imageWidth: 600,
      imageHeight: 600,
      imageAlt: 'Takas Cihaz Fotoğrafı',
      showConfirmButton: false,
      showCloseButton: true,
      customClass: {
        popup: 'swal-wide'
      }
    });
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


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  function confirmRedirect(url) {
    Swal.fire({
      title: 'İşlem Onayı',
      text: "Bu ürünü siparişe eklemek istiyor musunuz?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Evet, ekle!',
      cancelButtonText: 'Hayır'
    }).then((result) => {
      if (result.isConfirmed) {
        // Linke git ve işlem tamamlandıktan sonra sayfayı yenile
        fetch(url)
          .then(() => {
            Swal.fire(
              'Başarılı!',
              'Ürün siparişe eklendi.',
              'success'
            ).then(() => {
              // Sayfayı yenile
              location.reload();
            });
          })
          .catch(() => {
            Swal.fire(
              'Hata!',
              'Ürün eklenirken bir sorun oluştu.',
              'error'
            );
          });
      }
    });
  }
</script>

<!-- Tüm Takas Fotoğrafları Modal CSS -->
<style>
.takas-foto-container-all {
    padding: 10px;
}

.takas-foto-grid-all {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 15px;
    margin-top: 10px;
}

.takas-foto-item-all {
    position: relative;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    overflow: hidden;
    background: #f8f9fa;
    transition: transform 0.2s, box-shadow 0.2s;
    cursor: pointer;
}

.takas-foto-item-all:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    border-color: #007bff;
}

.takas-foto-header {
    padding: 5px 8px;
    background: #fff;
    border-bottom: 1px solid #e0e0e0;
}

.takas-foto-img-all {
    width: 100%;
    height: 150px;
    object-fit: cover;
    display: block;
}

.takas-foto-overlay-all {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.2s;
}

.takas-foto-item-all:hover .takas-foto-overlay-all {
    background: rgba(0,0,0,0.3);
}

.takas-foto-zoom-icon-all {
    color: white;
    font-size: 24px;
    opacity: 0;
    transition: opacity 0.2s;
}

.takas-foto-item-all:hover .takas-foto-zoom-icon-all {
    opacity: 1;
}

@media (max-width: 768px) {
    .takas-foto-grid-all {
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        gap: 10px;
    }
    
    .takas-foto-img-all {
        height: 120px;
    }
}
</style>

<!-- Tüm Takas Fotoğrafları Modal -->
<?php
if(isset($takas_fotograflari) && !empty($takas_fotograflari) && is_array($takas_fotograflari) && count($takas_fotograflari) > 0){
?>
<div class="modal fade" id="takasFotoModalAll<?=$siparis->siparis_id?>" tabindex="-1" role="dialog" aria-labelledby="takasFotoModalAllLabel<?=$siparis->siparis_id?>" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="takasFotoModalAllLabel<?=$siparis->siparis_id?>">
                    <i class="fas fa-camera"></i> Sipariş Takas Cihaz Fotoğrafları
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Kapat">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="takas-foto-container-all">
                    <div class="takas-foto-grid-all">
                        <?php 
                        $foto_index = 0;
                        if(isset($takas_fotograflari) && is_array($takas_fotograflari)){
                            foreach($takas_fotograflari as $foto){ 
                                if(!isset($foto->foto_url) || empty($foto->foto_url)) continue;
                                
                                // Ürün bilgisini al
                                $foto_urun = null;
                                if(isset($urunler) && is_array($urunler)){
                                    foreach($urunler as $ur){
                                        if(isset($ur->siparis_urun_id) && isset($foto->urun_id) && $ur->siparis_urun_id == $foto->urun_id){
                                            $foto_urun = $ur;
                                            break;
                                        }
                                    }
                                }
                            ?>
                                <div class="takas-foto-item-all">
                                    <div class="takas-foto-header">
                                        <?php if($foto_urun && isset($foto_urun->urun_adi)){ ?>
                                            <small class="text-muted"><i class="fas fa-box"></i> <?=$foto_urun->urun_adi?></small>
                                        <?php } ?>
                                    </div>
                                    <img src="<?=base_url($foto->foto_url)?>"
                                         alt="Takas Fotoğrafı <?=$foto_index+1?>"
                                         class="takas-foto-img-all"
                                         onclick="openTakasFotoDetailAll('<?=base_url($foto->foto_url)?>', '<?=$siparis->siparis_id?>', '<?=$foto_index?>')">
                                    <div class="takas-foto-overlay-all">
                                        <i class="fas fa-search-plus takas-foto-zoom-icon-all"></i>
                                    </div>
                                </div>
                            <?php 
                                $foto_index++;
                            } 
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <small class="text-muted mr-auto">
                    <i class="fas fa-info-circle"></i> Toplam <?php echo count($takas_fotograflari); ?> fotoğraf
                </small>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>

<!-- Bireysel Fotoğraf Detay Modal -->
<?php 
$foto_index_detail = 0;
foreach($takas_fotograflari as $foto){ 
?>
<div class="modal fade" id="takasFotoModalDetailAll<?=$siparis->siparis_id?>_<?=$foto_index_detail?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <img src="<?=base_url($foto->foto_url)?>" class="img-fluid w-100" alt="Takas Fotoğrafı">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>
<?php 
    $foto_index_detail++;
} 
?>
<?php } ?>

<script>
// Tüm takas fotoğrafları detay modalını aç
function openTakasFotoDetailAll(fotoUrl, siparisId, index) {
    // Önce ana modalı kapat
    $('#takasFotoModalAll' + siparisId).modal('hide');
    
    // Kısa bir gecikme ile detay modalını aç
    setTimeout(function() {
        $('#takasFotoModalDetailAll' + siparisId + '_' + index).modal('show');
    }, 300);
}
</script>