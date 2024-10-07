
<div class="p-2 m-2" style="background:#f1f1f1">
<span class=" text-black text-bold"><i class="fa fa-tag"></i> KULLANICI BAZLI SATIŞ RAPORU <span style="font-weight:400">(TARİH FİLTRELEMESİ YAPILMADI, TÜM KAYITLAR LİSTELENDİ)</span></span>
<span class="d-block pl-2 ml-2" style="margin-top:0px;opacity:0.6">Seçilen kullanıcının girmiş olduğu sipariş ve satış tutarları listelenmiştir. Detay görüntülemek için Sipariş Kodu'na tıklayabilirsiniz.</span>

</div>
<div class="row pr-1 pl-1 pb-2">
    <div class="col-lg-4 col-6 p-1">
        <div class="small-box bg-default" style="border:1px solid black">
            <div class="inner">
            <h3>150</h3>
            <p>Tüm Satış Toplam Adet</p>
            </div>
            <div class="icon">
            <i class="ion ion-bag"></i>
            </div>
       </div>
    </div>
    <div class="col-lg-4 col-6 p-1">
        <div class="small-box bg-default" style="border:1px solid green">
            <div class="inner">
            <h3 class="text-success">150</h3>
            <p>Peşin Satış Toplam Adet</p>
            </div>
            <div class="icon">
            <i class="ion ion-bag"></i>
            </div>
         </div>
    </div>
    <div class="col-lg-4 col-6 p-1">
        <div class="small-box bg-default" style="border:1px solid red">
            <div class="inner">
            <h3 class="text-danger">150</h3>
            <p>Vadeli Satış Toplam Adet</p>
            </div>
            <div class="icon">
            <i class="ion ion-bag"></i>
            </div>
         </div>
    </div>
     
</div>

<div class="row p-2 pl-2 pr-2" style="margin-top:-30px;    flex-wrap: nowrap;">
    <div class="col" style="padding:2px"><a class="btn btn-default" style="border-radius:90px!important;width: -webkit-fill-available;">OCAK</a></div>
    <div class="col" style="padding:2px"><a class="btn btn-default" style="border-radius:90px!important;width: -webkit-fill-available;">ŞUBAT</a></div>
    <div class="col" style="padding:2px"><a class="btn btn-default" style="border-radius:90px!important;width: -webkit-fill-available;">MART</a></div>
    <div class="col" style="padding:2px"><a class="btn btn-default" style="border-radius:90px!important;width: -webkit-fill-available;">NİSAN</a></div>
    <div class="col" style="padding:2px"><a class="btn btn-default" style="border-radius:90px!important;width: -webkit-fill-available;">MAYIS</a></div>
    <div class="col" style="padding:2px"><a class="btn btn-default" style="border-radius:90px!important;width: -webkit-fill-available;">HAZİRAN</a></div>
    <div class="col" style="padding:2px"><a class="btn btn-default" style="border-radius:90px!important;width: -webkit-fill-available;">TEMMUZ</a></div>
    <div class="col" style="padding:2px"><a class="btn btn-default" style="border-radius:90px!important;width: -webkit-fill-available;">AĞUSTOS</a></div>
    <div class="col" style="padding:2px"><a class="btn btn-default" style="border-radius:90px!important;width: -webkit-fill-available;">EYLÜL</a></div>
    <div class="col" style="padding:2px"><a class="btn btn-default" style="border-radius:90px!important;width: -webkit-fill-available;">EKİM</a></div>
    <div class="col" style="padding:2px"><a class="btn btn-default" style="border-radius:90px!important;width: -webkit-fill-available;">KASIM</a></div>
    <div class="col" style="padding:2px"><a class="btn btn-default" style="border-radius:90px!important;width: -webkit-fill-available;">ARALIK</a></div>
</div>



<div class="row">
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
<table id="example1muhasebe" class="table text-sm table-bordered table-responsive table-striped" style=";zoom:0.88"   >
                  <thead style="width: 100% !important;">
                  <tr>
                  <th>Sipariş Kayıt Tarihi</th> 
                    <th>Temsilci</th>
                    <th>Müşteri</th>
                    <th>İletişim</th>
                    <th>Ürün</th> 

                    <th>Satış</th> 
                    <th>Kapora</th> 
                    <th>Peşinat</th> 
                    <th>Takas</th> 
                
                    <th>Vade</th> 
                    <th style="width: 100%;">Satış Türü</th> 
                
                  </tr>
                  </thead>
                  <tbody style="width: 100% !important;">
                    <?php $a_id = aktif_kullanici()->kullanici_id; ?>
                    <?php 
                    
                    $t_satis_fiyati = 0;
                    $t_kapora = 0;
                    $t_pesinat = 0;
                    $t_takas_bedeli = 0;
                    $t_taksit = 0;
                    $t_fatura = 0;

                    $vadeli_t_satis_fiyati = 0;
                    $vadeli_t_kapora = 0;
                    $vadeli_t_pesinat = 0;
                    $vadeli_t_takas_bedeli = 0;
                    $vadeli_t_taksit = 0;
                    $vadeli_t_fatura = 0;

                    $pesin_t_satis_fiyati = 0;
                    $pesin_t_kapora = 0;
                    $pesin_t_pesinat = 0;
                    $pesin_t_takas_bedeli = 0;
                    $pesin_t_taksit = 0;
                    $pesin_t_fatura = 0;
                    ?>
                  
                   <?php foreach ($satislar as $satis){?>
                    <?php 
                    
                    $t_satis_fiyati += $satis->satis_fiyati;
                    $t_kapora += $satis->kapora_fiyati;
                    $t_pesinat += $satis->pesinat_fiyati;
                    $t_takas_bedeli += $satis->takas_bedeli;
                    $t_fatura += $satis->fatura_tutari;
                   
                    if($satis->odeme_secenek == "1"){
                      $pesin_t_satis_fiyati += $satis->satis_fiyati;
                      $pesin_t_kapora += $satis->kapora_fiyati;
                      $pesin_t_pesinat += $satis->pesinat_fiyati;
                      $pesin_t_takas_bedeli += $satis->takas_bedeli;
                      $pesin_t_fatura += $satis->fatura_tutari;
                  
                    }else{
                      $vadeli_t_satis_fiyati += $satis->satis_fiyati;
                      $vadeli_t_kapora += $satis->kapora_fiyati;
                      $vadeli_t_pesinat += $satis->pesinat_fiyati;
                      $vadeli_t_takas_bedeli += $satis->takas_bedeli;
                      $vadeli_t_fatura += $satis->fatura_tutari;
                    }
                  

                  
                    
                    ?>
                    <tr>
                    <td>
                         <?=date("d.m.Y H:i",strtotime($satis->kayit_tarihi))?> 
                         (<?=$satis->siparis_kodu?>)
                      </td>
                      <td>
                        
                        <?=$satis->kullanici_ad_soyad?> 
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
                      <td>
                        <?php 
                          if($satis->odeme_secenek == "1"){
                              ?>
                               <i class="fa fa-info-circle text-success" ></i>
                               <b>Peşin Satış</b>
                              <?php
                          }else{
                            ?>
                           
                              <span style="text-orange">Vadeli</span>

                           <?php
                            $kalan_tutar = ($satis->satis_fiyati-($satis->pesinat_fiyati+$satis->kapora_fiyati+$satis->takas_bedeli));
                            echo " (".(($f_kontrol ? number_format($kalan_tutar ,2)." ₺" : "<span class='text-danger'>**.***</span>"));
                            echo "<span style='opacity:0.6'> - Taksit :".($f_kontrol ? number_format($kalan_tutar/$satis->vade_sayisi)." ₺</span>)" : "<span class='text-danger'>**.***</span>)");
                          $t_taksit += ($kalan_tutar/$satis->vade_sayisi);
                          if($satis->odeme_secenek == "1"){
                            $pesin_t_taksit += ($kalan_tutar/$satis->vade_sayisi);
                        
                          }else{
                            $vadeli_t_taksit += ($kalan_tutar/$satis->vade_sayisi);
                          }
                         
                         
                        }
                        
                        ?>
                       
                      </td>
                     
                    </tr>
                  <?php  } ?>
                   
                  
                 
                  </tbody>
 
                </table>


</div>