
<?php
$aylars = array(1=>"Ocak", 2=>"Şubat", 3=>"Mart", 4=>"Nisan", 5=>"Mayıs", 6=>"Haziran", 7=>"Temmuz", 8=>"Ağustos", 9=>"Eylül", 10=>"Ekim", 11=>"Kasım", 12=>"Aralık");

?>

 
<div class="row pr-1 pl-1 pb-2">
    <div class="col-lg-4 col-6 p-1">
        <div class="small-box bg-default" style="border:1px solid black">
            <div class="inner">
            <h3 style="font-size:22px;"><?=count($satislar)?> ADET</h3>
            <p>Tüm Satış Toplam Adet</p>
            </div>
            <div class="icon">
            <i class="ion ion-bag" style="font-size:50px"></i>
            </div>
       </div>
    </div>
    <div class="col-lg-4 col-6 p-1">
        <div class="small-box bg-default" style="border:1px solid green">
            <div class="inner">
            <h3 class="text-success" style="font-size:22px;" id="pesindashboard">0</h3>
            <p>Peşin Satış Adet / Toplam</p>
            </div>
            <div class="icon">
            <i class="fa fa-money" style="font-size:50px"></i>
            </div>
         </div>
    </div>
    <div class="col-lg-4 col-6 p-1">
        <div class="small-box bg-default" style="border:1px solid red">
            <div class="inner">
            <h3 class="text-danger" style="font-size:22px;" id="vadelidashboard">0</h3>
            <p>Vadeli Satış Adet / Toplam</p>
            </div>
            <div class="icon">
            <i class="fa fa-calendar" style="font-size:50px"></i>
            </div>
         </div>
    </div>
     
</div>

<div class="row">
  <div class="col d-felx">
    <a href="<?=base_url("kullanici/profil_kullanici_satis_rapor/$secilen_kullanici/$secilen_ay/2024")?>" style="width:250px;font-size:22px;" class="btn btn-<?=$secilen_yil == 2024 ? "success" : "default"?> mr-2">2024</a>
    <a href="<?=base_url("kullanici/profil_kullanici_satis_rapor/$secilen_kullanici/$secilen_ay/2025")?>" style="width:250px;font-size:22px;" class="btn btn-<?=$secilen_yil == 2025 ? "success" : "default"?>">2025</a>
  
  </div> 
</div>

<br><br><br>
<div class="row p-2 pl-2 pr-2" style="margin-top:-30px;    flex-wrap: nowrap;">
    <div class="col" style="padding:2px"><a href="<?=base_url("kullanici/profil_kullanici_satis_rapor/$secilen_kullanici/1")?>" class="btn btn-default" style="<?=$secilen_ay == 1  ? "border:1px solid red;background-color:red;color:white;font-weight:bold;" : "background-color:#ffffff!important;"?>border-radius:90px!important;width: -webkit-fill-available;">OCAK</a></div>
    <div class="col" style="padding:2px"><a href="<?=base_url("kullanici/profil_kullanici_satis_rapor/$secilen_kullanici/2")?>" class="btn btn-default" style="<?=$secilen_ay == 2  ? "border:1px solid red;background-color:red;color:white;font-weight:bold;" : "background-color:#ffffff!important;"?>border-radius:90px!important;width: -webkit-fill-available;">ŞUBAT</a></div>
    <div class="col" style="padding:2px"><a href="<?=base_url("kullanici/profil_kullanici_satis_rapor/$secilen_kullanici/3")?>" class="btn btn-default" style="<?=$secilen_ay == 3  ? "border:1px solid red;background-color:red;color:white;font-weight:bold;" : "background-color:#ffffff!important;"?>border-radius:90px!important;width: -webkit-fill-available;">MART</a></div>
    <div class="col" style="padding:2px"><a href="<?=base_url("kullanici/profil_kullanici_satis_rapor/$secilen_kullanici/4")?>" class="btn btn-default" style="<?=$secilen_ay == 4  ? "border:1px solid red;background-color:red;color:white;font-weight:bold;" : "background-color:#ffffff!important;"?>border-radius:90px!important;width: -webkit-fill-available;">NİSAN</a></div>
    <div class="col" style="padding:2px"><a href="<?=base_url("kullanici/profil_kullanici_satis_rapor/$secilen_kullanici/5")?>" class="btn btn-default" style="<?=$secilen_ay == 5  ? "border:1px solid red;background-color:red;color:white;font-weight:bold;" : "background-color:#ffffff!important;"?>border-radius:90px!important;width: -webkit-fill-available;">MAYIS</a></div>
    <div class="col" style="padding:2px"><a href="<?=base_url("kullanici/profil_kullanici_satis_rapor/$secilen_kullanici/6")?>" class="btn btn-default" style="<?=$secilen_ay == 6  ? "border:1px solid red;background-color:red;color:white;font-weight:bold;" : "background-color:#ffffff!important;"?>border-radius:90px!important;width: -webkit-fill-available;">HAZİRAN</a></div>
    <div class="col" style="padding:2px"><a href="<?=base_url("kullanici/profil_kullanici_satis_rapor/$secilen_kullanici/7")?>" class="btn btn-default" style="<?=$secilen_ay == 7  ? "border:1px solid red;background-color:red;color:white;font-weight:bold;" : "background-color:#ffffff!important;"?>border-radius:90px!important;width: -webkit-fill-available;">TEMMUZ</a></div>
    <div class="col" style="padding:2px"><a href="<?=base_url("kullanici/profil_kullanici_satis_rapor/$secilen_kullanici/8")?>" class="btn btn-default" style="<?=$secilen_ay == 8  ? "border:1px solid red;background-color:red;color:white;font-weight:bold;" : "background-color:#ffffff!important;"?>border-radius:90px!important;width: -webkit-fill-available;">AĞUSTOS</a></div>
    <div class="col" style="padding:2px"><a href="<?=base_url("kullanici/profil_kullanici_satis_rapor/$secilen_kullanici/9")?>" class="btn btn-default" style="<?=$secilen_ay == 9  ? "border:1px solid red;background-color:red;color:white;font-weight:bold;" : "background-color:#ffffff!important;"?>border-radius:90px!important;width: -webkit-fill-available;">EYLÜL</a></div>
    <div class="col" style="padding:2px"><a href="<?=base_url("kullanici/profil_kullanici_satis_rapor/$secilen_kullanici/10")?>" class="btn btn-default" style="<?=$secilen_ay == 10 ? "border:1px solid red;background-color:red;color:white;font-weight:bold;" : "background-color:#ffffff!important;"?>border-radius:90px!important;width: -webkit-fill-available;">EKİM</a></div>
    <div class="col" style="padding:2px"><a href="<?=base_url("kullanici/profil_kullanici_satis_rapor/$secilen_kullanici/11")?>" class="btn btn-default" style="<?=$secilen_ay == 11 ? "border:1px solid red;background-color:red;color:white;font-weight:bold;" : "background-color:#ffffff!important;"?>border-radius:90px!important;width: -webkit-fill-available;">KASIM</a></div>
    <div class="col" style="padding:2px"><a href="<?=base_url("kullanici/profil_kullanici_satis_rapor/$secilen_kullanici/12")?>" class="btn btn-default" style="<?=$secilen_ay == 12 ? "border:1px solid red;background-color:red;color:white;font-weight:bold;" : "background-color:#ffffff!important;"?>border-radius:90px!important;width: -webkit-fill-available;">ARALIK</a></div>
</div>



<div class="row" style=" overflow-y: auto;">
<?php 
 $giris_yapan_kul = aktif_kullanici()->kullanici_id;
 $f_kontrol = false; $toplam_kontrol = false;
 if(
  $giris_yapan_kul == 1
  || $giris_yapan_kul == 7
  || $giris_yapan_kul == 9
  || $giris_yapan_kul == 10 || $giris_yapan_kul == 86
 ){
  $f_kontrol = true;
 }


 if(
  $giris_yapan_kul == 1
  || $giris_yapan_kul == 7
  || $giris_yapan_kul == 9
  || $giris_yapan_kul == 10  
 ){
  $f_kontrol = true;
  $toplam_kontrol = true;
 }
 ?>

                 <div class="col">
                  
<table id="example1muhasebe" class="table table-bordered table-striped" style="font-size:13px; width: -webkit-fill-available"   >
                  <thead >
                  <tr>
                  <th>Sipariş Kayıt Tarihi</th> 
                    
                    <th>Müşteri</th>
                    <th>İletişim</th>
                    <th>Ürün</th> 

                    <th>Satış</th> 
                    <th>Kapora</th> 
                    <th>Peşinat</th> 
                    <th>Takas</th> 
                
                    <th>Vade</th> 
                
                  </tr>
                  </thead>
                  <tbody style="width: 100% !important;">
                    <?php $a_id = aktif_kullanici()->kullanici_id; ?>
                    <?php 
                    
           

                    $vadeli_t_satis_fiyati = 0;
                    $vadeli_t_adet = 0;

                    $pesin_t_satis_fiyati = 0;
                    $pesin_t_adet = 0;
                 
                    ?>
                   
                   <?php foreach ($satislar as $satis){?>
                    <?php 
                    
                     
                   
                    if($satis->odeme_secenek == "1"){
                      $pesin_t_satis_fiyati += $satis->satis_fiyati;
                      $pesin_t_adet++;
                  
                    }else{
                      $vadeli_t_satis_fiyati += $satis->satis_fiyati;
                      $vadeli_t_adet++;
                    }
                  

                  
                    
                    ?>
                    <tr>
                    <td>
                        <?=$satis->siparis_kodu?>
                      </td>
                    
                      <td>
                        
                        <?=$satis->musteri_ad?> 
                      </td>
                      <td style="<?=talep_var_mi($satis->musteri_iletisim_numarasi) ? "background:#0f6700;color:white":""?>">
                        
                     <?php 
                        if($a_id != 111 ){
?>
    <span ><?=$satis->musteri_iletisim_numarasi?> <?=talep_var_mi($satis->musteri_iletisim_numarasi) ? "(Reklam)":""?></span>
                    
<?php
                        }else{
                          ?>
    <span><?=$satis->musteri_iletisim_numarasi?></span>
                    
<?php
                        }
                     ?>
                      </td>
                      <td>
                         <?=$satis->urun_adi?> 
                      </td>
                     
                      <td style="background:#47ff6f38;text-align:right;">
                        
                        <?=($f_kontrol ? number_format($satis->satis_fiyati,2)." ₺" : "<span class='text-danger'>**.***</span>")?> 
                      </td>
                      <td style="text-align:right;<?php if($satis->kapora_fiyati == 0){ echo "background:#ff000045;";}?>">
                      
                      <?=($f_kontrol ? number_format($satis->kapora_fiyati,2)." ₺" : "<span class='text-danger'>**.***</span>")?> 
                    </td>
                      <td style="text-align:right;">
                       
                       <?=($f_kontrol ? number_format($satis->pesinat_fiyati,2)." ₺" : "<span class='text-danger'>**.***</span>")?> 
                      </td>
                    
                      <td style="text-align:right;<?php if($satis->takas_bedeli == 0){ echo "background:#ffff0033;";}?>">
                        
                         <?=($f_kontrol ? number_format($satis->takas_bedeli,2)." ₺" : "<span class='text-danger'>**.***</span>")?> 
                      </td>
                     
                    
                      <td>
                        
                        <?=($satis->odeme_secenek == 1) ?"-" :$satis->vade_sayisi." Ay"?> 
                      </td>
                    
                     
                    </tr>
                  <?php  } ?>
                   
                  
                 
                  </tbody>
 
                </table>




                <script>
                 
                 document.getElementById("vadelidashboard").innerHTML = <?=$vadeli_t_adet?>+" Adet / <span style='font-weight:400;'>"+(<?=$vadeli_t_satis_fiyati?>).toLocaleString('tr-TR', { style: 'currency', currency: 'TRY', })+"</span>";
                 document.getElementById("pesindashboard").innerHTML = <?=$pesin_t_adet?>+" Adet / <span style='font-weight:400;'>"+(<?=$pesin_t_satis_fiyati?>).toLocaleString('tr-TR', { style: 'currency', currency: 'TRY', })+"</span>";
                  </script>
                 </div>


</div>
 