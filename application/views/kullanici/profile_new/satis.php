<table id="example1muhasebe" class="table text-sm table-bordered table-responsive table-striped" style="zoom:0.88"   >
                  <thead style="width: 100% !important;">
                  <tr>
                  <th>Sipariş Kayıt Tarihi</th> 
                    <th>Satış Temsilcisi</th>
                    <th>Müşteri Ad Soyad</th>
                    <th>İletişim Numarası</th>
                    <th>Ürün Adı</th> 

                    <th>Satış Fiyatı</th> 
                    <th>Kapora</th> 
                    <th>Peşinat</th> 
                    <th>Takas Bedeli</th> 
               
                    <th>Fatura Tutarı</th> 
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
                   <?php foreach ($satislar as $kullanici){?>
                    <?php 
                    
                    $t_satis_fiyati += $kullanici->satis_fiyati;
                    $t_kapora += $kullanici->kapora_fiyati;
                    $t_pesinat += $kullanici->pesinat_fiyati;
                    $t_takas_bedeli += $kullanici->takas_bedeli;
                    $t_fatura += $kullanici->fatura_tutari;
                   
                    if($kullanici->odeme_secenek == "1"){
                      $pesin_t_satis_fiyati += $kullanici->satis_fiyati;
                      $pesin_t_kapora += $kullanici->kapora_fiyati;
                      $pesin_t_pesinat += $kullanici->pesinat_fiyati;
                      $pesin_t_takas_bedeli += $kullanici->takas_bedeli;
                      $pesin_t_fatura += $kullanici->fatura_tutari;
                  
                    }else{
                      $vadeli_t_satis_fiyati += $kullanici->satis_fiyati;
                      $vadeli_t_kapora += $kullanici->kapora_fiyati;
                      $vadeli_t_pesinat += $kullanici->pesinat_fiyati;
                      $vadeli_t_takas_bedeli += $kullanici->takas_bedeli;
                      $vadeli_t_fatura += $kullanici->fatura_tutari;
                    }
                  

                  
                    
                    ?>
                    <tr>
                    <td>
                         <?=date("d.m.Y H:i",strtotime($kullanici->kayit_tarihi))?> 
                         <?php 
                         $urlcustom = base_url("siparis/report/").urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$kullanici->siparis_id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE"));
                         ?>
                         <a href="#" onclick="showWindow('<?= $urlcustom?>');">(<?=$kullanici->siparis_kodu?>)</a>
                      </td>
                      <td>
                        <i class="fa fa-user" style="margin-right:5px;opacity:0.8"></i>
                        <?php 
                        $pkurl = base_url("kullanici/kullanici_profil/$kullanici->kullanici_id");
                        ?>
                        <a style="cursor:pointer;color:block;text-decoration:underline;" href="#"  onclick="showWindow('<?= $pkurl?>');">  <?=mb_strtoupper($kullanici->kullanici_ad_soyad)?>  </a>
                      </td>
                      <td>
                        <i class="fa fa-users" style="margin-right:5px;opacity:0.8"></i>
                        <?php 
                        $purl = base_url("musteri/profil/$kullanici->musteri_id");
                        ?>
                        <a style="cursor:pointer; " href="#" onclick="showWindow('<?= $purl?>');"><?=$kullanici->musteri_ad?> </a>
                      </td>
                      <td style="<?=talep_var_mi($kullanici->musteri_iletisim_numarasi) ? "background:#0f6700;color:white":""?>">
                        <i class="fa fa-phone" style="margin-right:5px;opacity:0.8"></i>
                     <?php 
                        if($a_id != 111 ){
?>
    <span ><?=$kullanici->musteri_iletisim_numarasi?> <?=talep_var_mi($kullanici->musteri_iletisim_numarasi) ? "(Reklam)":""?></span>
                    
<?php
                        }else{
                          ?>
    <span><?=$kullanici->musteri_iletisim_numarasi?></span>
                    
<?php
                        }
                     ?>
                      </td>
                      <td>
                         <?=$kullanici->urun_adi?> 
                      </td>
                     
                      <td style="background:#47ff6f38;text-align:right;">
                        
                        <?=($f_kontrol ? number_format($kullanici->satis_fiyati,2)." ₺" : "<span class='text-danger'>**.***</span>")?> 
                      </td>
                      <td style="text-align:right;<?php if($kullanici->kapora_fiyati == 0){ echo "background:#ff000045;";}?>">
                      
                      <?=($f_kontrol ? number_format($kullanici->kapora_fiyati,2)." ₺" : "<span class='text-danger'>**.***</span>")?> 
                    </td>
                      <td style="text-align:right;">
                       
                       <?=($f_kontrol ? number_format($kullanici->pesinat_fiyati,2)." ₺" : "<span class='text-danger'>**.***</span>")?> 
                      </td>
                    
                      <td style="text-align:right;<?php if($kullanici->takas_bedeli == 0){ echo "background:#ffff0033;";}?>">
                        
                         <?=($f_kontrol ? number_format($kullanici->takas_bedeli,2)." ₺" : "<span class='text-danger'>**.***</span>")?> 
                      </td>
                     
                      <td style="text-align:right;<?php if($kullanici->fatura_tutari == 0){ echo "background:#ff000045;";}?>">
                        
                        <?=($f_kontrol ? number_format($kullanici->fatura_tutari,2)." ₺" : "<span class='text-danger'>**.***</span>")?> 
                      </td>
                      <td>
                        
                        <?=($kullanici->odeme_secenek == 1) ?"-" :$kullanici->vade_sayisi." Ay"?> 
                      </td>
                      <td>
                        <?php 
                          if($kullanici->odeme_secenek == "1"){
                              ?>
                               <i class="fa fa-info-circle text-success" ></i>
                               <b>Peşin Satış</b>
                              <?php
                          }else{
                            ?>
                           
                              <span style="text-orange">Vadeli</span>

                           <?php
                            $kalan_tutar = ($kullanici->satis_fiyati-($kullanici->pesinat_fiyati+$kullanici->kapora_fiyati+$kullanici->takas_bedeli));
                            echo " (".(($f_kontrol ? number_format($kalan_tutar ,2)." ₺" : "<span class='text-danger'>**.***</span>"));
                            echo "<span style='opacity:0.6'> - Taksit :".($f_kontrol ? number_format($kalan_tutar/$kullanici->vade_sayisi)." ₺</span>)" : "<span class='text-danger'>**.***</span>)");
                          $t_taksit += ($kalan_tutar/$kullanici->vade_sayisi);
                          if($kullanici->odeme_secenek == "1"){
                            $pesin_t_taksit += ($kalan_tutar/$kullanici->vade_sayisi);
                        
                          }else{
                            $vadeli_t_taksit += ($kalan_tutar/$kullanici->vade_sayisi);
                          }
                         
                         
                        }
                        
                        ?>
                       
                      </td>
                     
                    </tr>
                  <?php  } ?>
                  <?php 
                  
                  if($toplam_kontrol){
                    setlocale(LC_MONETARY, 'tr_TR');
 
                    ?>
                      <tr style="background: #ffffff; color: red;">   
                        <td style="text-align: end;font-weight:bold" colspan="5">VADELİ SATIŞLAR TOPLAM : </td>
                        <td style="font-weight:bold"><?=money_format('%i', $vadeli_t_satis_fiyati)?></td>
                        <td style="font-weight:bold"><?=money_format('%i', $vadeli_t_kapora)?></td>
                        <td style="font-weight:bold"><?=money_format('%i', $vadeli_t_pesinat)?></td>
                        <td style="font-weight:bold"><?=money_format('%i', $vadeli_t_takas_bedeli)?></td>
                        <td style="font-weight:bold"><?=money_format('%i', $vadeli_t_fatura)?></td>
                        <td style="font-weight:bold">-</td>
                        <td style="font-weight:bold"><?=money_format('%i', $vadeli_t_taksit)?></td>
                      </tr>
                      <tr style="background: #ffffff; color: red;">   
                        <td style="text-align: end;font-weight:bold" colspan="5">PEŞİN SATIŞLAR TOPLAM : </td>
                        <td style="font-weight:bold"><?=money_format('%i', $pesin_t_satis_fiyati)?></td>
                        <td style="font-weight:bold"><?=money_format('%i', $pesin_t_kapora)?></td>
                        <td style="font-weight:bold"><?=money_format('%i', $pesin_t_pesinat)?></td>
                        <td style="font-weight:bold"><?=money_format('%i', $pesin_t_takas_bedeli)?></td>
                        <td style="font-weight:bold"><?=money_format('%i', $pesin_t_fatura)?></td>
                        <td style="font-weight:bold">-</td>
                        <td style="font-weight:bold">-</td>
                      </tr>
                      <tr style="background: #7d0000;color: white;">   
                        <td style="text-align: end;font-weight:bold" colspan="5">GENEL TOPLAM : </td>
                        <td style="font-weight:bold"><?=money_format('%i', $t_satis_fiyati)?></td>
                        <td style="font-weight:bold"><?=money_format('%i', $t_kapora)?></td>
                        <td style="font-weight:bold"><?=money_format('%i', $t_pesinat)?></td>
                        <td style="font-weight:bold"><?=money_format('%i', $t_takas_bedeli)?></td>
                        <td style="font-weight:bold"><?=money_format('%i', $t_fatura)?></td>
                        <td style="font-weight:bold">-</td>
                        <td style="font-weight:bold"><?=money_format('%i', $t_taksit)?></td>
                      </tr>
                    <?php
                  }
                  ?>
                 
                  </tbody>
 
                </table>