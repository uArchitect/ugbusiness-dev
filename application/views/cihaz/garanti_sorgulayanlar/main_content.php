 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
 
<section class="content text-md">



<div class="card card-dark" style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - Umex.com.tr - Garanti Sorgulayanlar</h3>
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
                   
                  <th>Seri Numarası</th>
                    <th>Müşteri / Merkez Bilgisi</th>
                    <th>Garanti Başlangıç Tarihi</th>
                    <th>Garanti Bitiş Tarihi</th>
                    <th>Sorgulama Tarihi</th>
               
                  </tr>
                  </thead>
                  <tbody>
                  
                    <?php foreach ($urunler as $urun) : ?>
                  

                    <tr>
                     
 
                    

                    <td><i class="fas fa-qrcode" style="margin-right:5px;opacity:1"></i> 
                       <?=$urun->sorgulanan_seri_numarasi ?? "<span style='opacity:0.3'>UG00000000UX00</span>"?> 
                    </td>
                      
                      <td><i class="far fa-user-circle" style="margin-right:5px;opacity:1"></i> 
                      
                      <?php 
                      
                      if($urun->musteri_ad){
?>
 <?=$urun->musteri_ad?> / <?=$urun->merkez_adi?>  / <span style="font-weight:normal"><?=$urun->musteri_iletisim_numarasi?></span>
                    
<?php
                      }else{
                  echo "<span style='opacity:0.5'>Cihaz seri numarası sistemde bulunamadı. </span>";
                      }
                      
                      ?>
                     
                    
                      </td>
                  
                    
                     
                      <td>
                        <?php
                          if($urun->musteri_ad){
                            ?>
                                     <?=date("d.m.Y H:i",strtotime($urun->garanti_baslangic_tarihi))?>             
                            <?php
                                                  }else{
                                              echo "<span style='opacity:0.5'>Sistemde bulunamadı. </span>";
                                                  }
                        ?>

                      
                    </td>
                  
                    <td>
                      <?php 
                          if($urun->musteri_ad){
                            ?>
                                <?=date("d.m.Y H:i",strtotime($urun->garanti_bitis_tarihi))?>                 
                            <?php
                                                  }else{
                                              echo "<span style='opacity:0.5'>Sistemde bulunamadı. </span>";
                                                  }
                        ?>
                     
                       
                    </td>
                  
                     
                    <td>
                      
                       <?=date("d.m.Y H:i",strtotime($urun->sorgulama_tarihi))?> 
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