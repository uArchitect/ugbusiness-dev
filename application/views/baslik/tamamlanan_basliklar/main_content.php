 
 
<div class="content-wrapper" style="padding-top:10px">
 
<section class="content text-md">
<div class="card card-dark" style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - Cihaz Yönetimi - Tüm Cihaz Başlıkları</h3>
              </div>
               
              <div class="card-body p-1 pt-2">
               
                <table id="example1tamamlananbasliklar" class="table   table-bordered table-striped nowrap text-sm" style="font-weight: 600;">
                  <thead>
                  <tr>
                    <th style="width: 42px;">ID</th> 
                    <th>Başlık Bilgileri</th>
                    <th>Müşteri / Merkez Bilgisi</th>
                
                    <th>Cihaz Bilgileri</th>
                    <th>Sipariş Durumu</th>
                    <th style="width: 130px;">Arıza Bilgileri</th>
                    <th style="width: 130px;">Garanti Bilgileri</th> 
                    
                  </tr>
                  </thead>
                  <tbody>
                  
                    <?php foreach ($basliklar as $urun) : ?>
                    <?php 
                      $bcolor="#e4ffe6";
                      $fcolor = "";
                      $rowbg = "";
                      if(date("Y-m-d",strtotime($urun->baslik_garanti_bitis_tarihi)) < date("Y-m-d")){
                        $bcolor = "#bd0606";
                        $fcolor = "#ffffff";
                        $rowbg = "#bd0606";
                      }else if(date("Y-m-d",strtotime($urun->baslik_garanti_bitis_tarihi)) == date("Y-m-d")){
                        $bcolor = "#fef7ea";
                        $fcolor = "#616161";
                        $rowbg = "#fef7ea";
                      }
                      ?>

                    <tr style="background:<?=$rowbg?>;color:<?=$fcolor?>">
                      <td><?=$urun->urun_baslik_ariza_tanim_id?></td>
                      <td>
                       <?=$urun->baslik_adi?><br><span style='font-weight:normal'><?=$urun->baslik_seri_no?></span>
                    </td>
                      <td>
                       <?=$urun->musteri_ad?> / <?=$urun->merkez_adi?><span class="text-danger" style="background:white;"> <?=$urun->urun_baslik_kargo_adi?></span>
                       <br><span style='font-weight:normal'><?php echo mb_substr($urun->merkez_adresi,0,40); ?> <?=$urun->sehir_adi?> / <?=$urun->ilce_adi?> </span>
                    </td>
                    <td>
                       <?=$urun->urun_adi?><br><span style='font-weight:normal'><?=$urun->seri_numarasi?></span>
                    </td>
                    
                    
                    <td>
                       <?=$urun->urun_baslik_ariza_siparis_durum_adi?>
                       <br>
                       <span style='font-weight:normal'><?=date("d.m.Y",strtotime($urun->ariza_siparis_durum_guncelleme_tarihi))?></span>
                        
                    </td>
                    <td style="background:<?=$bcolor?>; color:<?=$fcolor?>">
                    <span style="
    background: #125b001c;
    padding: 2px;
    padding-left: 5px; 
    padding-right: 10px;
    width: 100%;font-weight: 500;
    display: block; 
">
 Kayıt Tarih : <?=date("d.m.Y H:i",strtotime($urun->urun_baslik_ariza_kayit_tarihi))?>
                    
</span>

                    <?php

                                      $jsonData = json_encode(get_arizalar($urun->urun_baslik_ariza), true);
                                     
                                      $data = json_decode($jsonData, true);

                                       
                                      $basliklar = array_map(function($item) use($urun) {
                                        
                                          return preg_replace('/\([^)]+\)/', '', $item['urun_baslik_ariza_adi']);
                                      }, $data);

                                      if($urun->urun_baslik_ariza != null && $urun->urun_baslik_ariza != "" && $urun->urun_baslik_ariza != "null")
                                      { 
                                        echo '<i class="fas fa-check-circle"></i> '.implode('<br><i class="fas fa-check-circle"></i> ', $basliklar);
                                        
                                     
                                      }
                                     
                                      else{
                                        echo "<span class='text-danger'><i class='fas fa-exclamation-circle'></i>  Arıza Seçilmedi</span>";

                                      }
                                      if($urun->urun_baslik_ariza_aciklama != ""  && $urun->urun_baslik_ariza_aciklama != null){
                                        echo '<br><div style="height:5px">.</div><span style=" max-width: 150px!important; padding: 5px; background: #ffe2e2; color: #d00000; margin-top: 5px; margin-bottom: 5px; border: 2px solid #ff00007d; border-radius: 5px;"><i class="fas fa-exclamation-circle"></i> '.$urun->urun_baslik_ariza_aciklama."</span>";
                                      echo '<div style="height:5px">.</div>';
                                      }
                                    
                                      ?>
                     
                    </td>
                    <td style="background:<?=$bcolor?>; color:<?=$fcolor?>">
                    
                 

<span style="padding:5px;margin-top:2px;">
Başlangıç : 
                    <?php 
                    
                    if(date("Y-m-d",strtotime($urun->baslik_garanti_bitis_tarihi)) == date("Y-m-d",strtotime($urun->baslik_garanti_baslangic_tarihi))){
                      echo '<i class="fas fa-exclamation-circle" style="padding:4px;border-radius:7px;color:white;background:#ee9500;margin-right:5px;opacity:1"></i> '." Başlatılmadı";
                
                    }else{
                      echo date("d.m.Y",strtotime($urun->baslik_garanti_baslangic_tarihi));
                    }
                    
                    ?> <br>
                    <span style="padding:5px;font-weight:normal">
                       Bitiş : 
                       <?php 
                        if(date("Y-m-d",strtotime($urun->baslik_garanti_bitis_tarihi)) < date("Y-m-d")){
                          echo '<i class="fas fa-exclamation-triangle" style="padding:4px;border-radius:7px;color:white;background:#ea4e2c;margin-right:5px;opacity:1"></i> '.date("d.m.Y",strtotime($urun->baslik_garanti_bitis_tarihi))." / (".gunSayisiHesapla(date("d.m.Y"),date("d.m.Y",strtotime($urun->baslik_garanti_bitis_tarihi)))." gün önce)";
                        }else if(date("Y-m-d",strtotime($urun->baslik_garanti_bitis_tarihi)) == date("Y-m-d",strtotime($urun->baslik_garanti_baslangic_tarihi))){
                          echo '<i class="fas fa-exclamation-circle" style="padding:4px;border-radius:7px;color:white;background:#ee9500;margin-right:5px;opacity:1"></i> '." Başlatılmadı";
                    
                        }else{
                          echo date("d.m.Y",strtotime($urun->baslik_garanti_bitis_tarihi))." (".gunSayisiHesapla(date("d.m.Y"),date("d.m.Y",strtotime($urun->baslik_garanti_bitis_tarihi)))." gün kaldı)";
                        }
                     
                       ?></span>


                      </span>
                    </td>
                      
                     
                       
                    </tr>
                  <?php  endforeach; ?>
              
                  </tbody>
            
                </table>
              </div>
            
            </div>
           
</section>
            </div>