 
 
<div class="content-wrapper" style="padding-top:10px">
 
<section class="content text-md">
<div class="card card-dark" style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - Cihaz Yönetimi - Tüm Cihaz Başlıkları</h3>
              </div>
             
              <div class="card-body p-1 pt-2">
               
                <table id="example1" class="table table-bordered table-striped nowrap text-sm" style="font-weight: 600;">
                  <thead>
                  <tr>
                    <th style="width: 42px;">ID</th> 
                    <th>Müşteri / Merkez Bilgisi</th>
                    <th>Cihaz Adı</th>
                    <th>Başlık Adı</th> 
                    
                    <th style="width: 130px;">Garanti Bilgileri</th>
          
                    <th style="">İşlem</th> 
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
                      <td><?=$urun->siparis_urun_id?></td>
                      <td>
                       <?=$urun->baslik_adi?>
                       <br>
                       <span style="font-weight:normal">  <?=$urun->baslik_seri_no?></span>
                 
                    </td>
                      <td>
                       <?=$urun->musteri_ad?> / <?=$urun->merkez_adi?> 
                       <br>
                       <span style="font-weight:normal">  <?=$urun->sehir_adi?> / <?=$urun->ilce_adi?></span>
                    </td>
                    <td>
                       <?=$urun->urun_adi?><br><?=$urun->seri_numarasi ?? "<span style='opacity:0.3'>UG00000000UX00</span>"?> 
                    </td>
                    
                      
                    
                    <td style="background:<?=$bcolor?>; color:<?=$fcolor?>">
                    <?php 
                    
                    if(date("Y-m-d",strtotime($urun->baslik_garanti_bitis_tarihi)) == date("Y-m-d",strtotime($urun->baslik_garanti_baslangic_tarihi))){
                      echo '<i class="fas fa-exclamation-circle" style="padding:4px;border-radius:7px;color:white;background:#ee9500;margin-right:5px;opacity:1"></i> '." Başlatılmadı";
                
                    }else{
                      ?>



<span style="
    background: #125b001c;
    padding: 2px;font-weight: 700;
    padding-left: 5px; 
    padding-right: 10px;
    width: 100%;
    display: block; 
">
<?=($urun->dahili_baslik==0) ? "Ekstra Başlık" : "Dahili Başlık"?>
</span> 

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







                      <?php
                    }
                    
                    ?> 
                     
                    </td>
                   
                      
                      <td>
                    
                          <a type="button" href="<?=base_url("baslik/duzenle/".$urun->urun_baslik_tanim_id)?>" class="btn btn-warning btn-xs"><i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> Düzenle</a>
                          <a type="button" onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu başlığı silmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Onayla','<?=base_url('baslik/sil/').$urun->urun_baslik_tanim_id?>');" class="btn btn-danger btn-xs"><i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> Kayıt Sil</a>
                          
                      </td>
                       
                    </tr>
                  <?php  endforeach; ?>
              
                  </tbody>
            
                </table>
              </div>
               
            </div>
            
</section>
            </div>