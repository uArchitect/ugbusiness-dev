 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
 
<section class="content text-md">
<div class="card card-dark" style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - İptal Edilen Sipariş Ürünleri</h3>
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
                <table id="example1" class="table table-bordered table-striped nowrap">
                  <thead>
                  <tr>
                    <th style="width: 42px;">ID</th> 
                 <th>Cihaz Adı</th>
                    <th>Müşteri / Merkez Bilgisi</th>
                   
                    <th>İl İlçe</th>
                    <th>Satış Fiyatı</th>
                    <th>Kapora</th> 
                    <th>Peşinat</th> 
                    <th>Fatura Tutarı</th>  
                    <th>Takas Bedeli</th>
                      <th>İptal Nedeni</th>
                    

                    
                  </tr>
                  </thead>
                  <tbody>
                  
                    <?php foreach ($urunler as $urun) : ?>
                     

                    <tr  >
                      <td><?=$urun->siparis_urun_id?></td>
 



                       <td>  
                       <?=$urun->urun_adi?>
                    </td> 
                      <td><i class="far fa-user-circle" style="margin-right:5px;opacity:1"></i> 
                       <?=$urun->musteri_ad?> / <?=$urun->merkez_adi?>  / <span style="font-weight:normal"><?=$urun->musteri_iletisim_numarasi?></span>
                    </td>
                  
                      
                    <td><i class="fas fa-map-marker-alt" style="margin-right:5px;opacity:1"></i> 
                       <?=$urun->sehir_adi?> / <?=$urun->ilce_adi?> 
                    </td>
                    
                    <td> 
                    <?=number_format($urun->satis_fiyati,2)." ₺"?>  
                    
                    </td>
                    <td> 
                    <?=number_format($urun->kapora_fiyati,2)." ₺"?>  
                  
                    </td>
                    <td> 
                    <?=number_format($urun->pesinat_fiyati,2)." ₺"?>  
                   
                    </td>
                    <td> 
                    <?=number_format($urun->fatura_tutari,2)." ₺"?>  
                      
                    </td>
                    <td> 
                    <?=number_format($urun->takas_bedeli,2)." ₺"?>  
                    
                    </td>
                          <td> 
                    <?=$urun->siparis_iptal_nedeni?>  
                    
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