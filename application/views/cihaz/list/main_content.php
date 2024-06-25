 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
 
<section class="content text-md">
<div class="card card-dark" style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - Cihaz Yönetimi - Tüm Cihazlar</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-1 pt-2" style="font-size: small;">
                <div class="row d-none">

                <div class="col">

<div class="small-box bg-dark" style="background-color: #003061!important;">
  <div class="inner">
    <h3>[#]</h3>
    <p>Garantisi Başlatılmamış Cihazlar</p>
  </div>
  <div class="icon">
    <i class="ion ion-clock text-warning"></i>
  </div>
  <a href="#" class="small-box-footer">Tümünü Göster <i class="fas fa-arrow-circle-right"></i></a>
</div>

</div>


                  <div class="col p-0">
                  <div class="small-box bg-dark" style="background-color: #003061!important;">
                    <div class="inner">
                      <h3>[#]</h3>
                      <p>Garantisi Devam Eden Cihazlar</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-checkmark text-success"></i>
                    </div>
                    <a href="#" class="small-box-footer">Tümünü Göster <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                  </div>
                  <div class="col">

                  <div class="small-box bg-dark" style="background-color: #003061!important;">
                    <div class="inner">
                      <h3>[#]</h3>
                      <p>Garantisi Sona Eren Cihazlar</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-alert text-danger"></i>
                    </div>
                    <a href="<?=base_url("cihaz/garanti-suresi-biten-cihazlar")?>" class="small-box-footer">Tümünü Göster <i class="fas fa-arrow-circle-right"></i></a>
                  </div>

                  </div>
                 


                  <div class="col p-0 pr-2">

<div class="small-box bg-dark" style="background-color: #003061!important;">
  <div class="inner">
    <h3>[#]</h3>
    <p>Tüm Cihazlar</p>
  </div>
  <div class="icon">
    <i class="ion ion-folder text-primary"></i>
  </div>
  <a href="#" class="small-box-footer">Tümünü Göster <i class="fas fa-arrow-circle-right"></i></a>
</div>

</div>
                  
                </div>
                <table id="example1" class="table table-bordered table-striped nowrap" style="font-weight: 600;">
                  <thead>
                  <tr>
                    <th style="width: 42px;">ID</th> 
                 <th>Cihaz Adı</th>
                    <th>Müşteri / Merkez Bilgisi</th>
                    <th>Seri Numarası</th>
                    <th>İl İlçe</th>
                    <th style="width: 130px;">Garanti Başlangıç</th>
                    <th style="width: 130px;">Garanti Bitiş</th> 
                    <th style="width: 130px;">İşlem</th> 
                  </tr>
                  </thead>
                  <tbody>
                  
                    <?php foreach ($urunler as $urun) : ?>
                    <?php 
                      $bcolor="#e4ffe6";
                      $fcolor = "";
                      $rowbg = "";
                      if(date("Y-m-d",strtotime($urun->garanti_bitis_tarihi)) == date("Y-m-d",strtotime($urun->garanti_baslangic_tarihi))){
                        $bcolor = "#fef7ea";
                        $fcolor = "#000000";
                        $rowbg = "#fef7ea";
                      }
                      else if(date("Y-m-d",strtotime($urun->garanti_bitis_tarihi)) < date("Y-m-d")){
                        $bcolor = "#ffe0e0";
                        $fcolor = "#a30000";
                        $rowbg = "#ffe0e0";
                      } 
                      ?>

                    <tr style="background:<?=$rowbg?>;color:<?=$fcolor?>">
                      <td><?=$urun->siparis_urun_id?></td>




                       <td>  
                       <?=$urun->urun_adi?>
                    </td> 
                      <td> 
                       <?=$urun->musteri_ad?> / <?=$urun->merkez_adi?>  / <span style="font-weight:normal"><?=$urun->musteri_iletisim_numarasi?></span>
                    </td>
                  
                      <td> 
                       <?=$urun->seri_numarasi ?? "<span style='opacity:0.3'>UG00000000UX00</span>"?> 
                    </td>
                    <td> 
                       <?=$urun->sehir_adi?> / <?=$urun->ilce_adi?> 
                    </td>
                    <td style="background:<?=$bcolor?>; color:<?=$fcolor?>">
                    <?php 
                    
                    if(date("Y-m-d",strtotime($urun->garanti_bitis_tarihi)) == date("Y-m-d",strtotime($urun->garanti_baslangic_tarihi))){
                      echo "Başlatılmadı";
                
                    }else{
                      echo date("d.m.Y",strtotime($urun->garanti_baslangic_tarihi));
                    }
                    
                    ?> 
                     
                    </td>
                    <td style="background:<?=$bcolor?>; color:<?=$fcolor?>">
                    
                    <?php 
                    
                    if(date("Y-m-d",strtotime($urun->garanti_bitis_tarihi)) == date("Y-m-d",strtotime($urun->garanti_baslangic_tarihi))){
                      echo '<i class="fas fa-exclamation-circle" style="padding:4px;border-radius:7px;color:white;background:#ee9500;margin-right:5px;opacity:1"></i> '." Başlatılmadı";
                
                    }else{
                      if(date("Y-m-d",strtotime($urun->garanti_bitis_tarihi)) < date("Y-m-d")){
                        echo date("d.m.Y",strtotime($urun->garanti_bitis_tarihi));
                      }else if(date("Y-m-d",strtotime($urun->garanti_bitis_tarihi)) == date("Y-m-d",strtotime($urun->garanti_baslangic_tarihi))){
                        echo '<i class="fas fa-exclamation-circle" style="padding:4px;border-radius:7px;color:white;background:#ee9500;margin-right:5px;opacity:1"></i> '." Başlatılmadı";
                  
                      }else{
                        echo date("d.m.Y",strtotime($urun->garanti_bitis_tarihi));
                      }
                         }
                    
                    ?> 
                   
                       <?php 
                        
                     
                       ?>
                    </td>
                      
                      <td> <a type="button" href="<?=base_url("cihaz/duzenle/".$urun->siparis_urun_id)?>" class="" style="font-size: 12px!important;font-weight:normal"> Düzenle</a>
                      <a type="button" href="<?=base_url("egitim/add/".$urun->siparis_urun_id)?>" class="" style="font-size: 12px!important;font-weight:normal"> Eğitim Ekle</a>
                           
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

       