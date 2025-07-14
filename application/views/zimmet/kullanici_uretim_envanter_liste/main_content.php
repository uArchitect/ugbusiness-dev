
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper pt-2"> <div class="col-md-12">
            <div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  ÜRETİM ENVATERLER
                </h3>
              </div>
              <div class="card-body"  >
               
            

 <div class="row">
 
  <div class="col-lg-12">
    <div class="row">
                  <div class="col-12">
                



<div class="card card-warning card-outline">
              <div class="card-header">
                <h3 class="card-title">Üretim Bölümlerine Verilen Envanter Bilgileri
 
                </h3>
             
              </div>
              <div class="card-body">


              <div id="accordion">

               <?php 
                      foreach ($kullanicilar as $s) {
                        
                       ?>
                       


  <div class="card">
    <div class="card-header p-2" id="headingOne">
      <h5 class="mb-0 p-0">
        <button class="btn btn-link p-0" data-toggle="collapse" data-target="#collapse<?= $s->zimmet_alt_bolum_id ?>" aria-expanded="true" aria-controls="collapseOne">
          <?=$s->zimmet_alt_bolum_adi?>
        </button>
      </h5>
    </div>

    <div id="collapse<?= $s->zimmet_alt_bolum_id ?>" class="collapse <?=(!isset($_GET["act"]) && $_GET["act"] == $s->zimmet_alt_bolum_id)?"show":""?>" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
       
    
    <table     class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Stok Adı</th>
                      <th>Bölüm Adı</th>
                      
                      



                      <th>Tanımlanan Miktar</th>
                      <th>İşlem Tarihi</th> 
                 

                      
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    foreach ($kullanicihareketlerdetay as $h) {
                      if($h->zimmet_departman_no != $secilen_departman || $h->zimmet_hareket_cikis_miktar == 0){
                        continue;
                      }
                      if($h->zimmet_hareket_alt_bolum_no != $s->zimmet_alt_bolum_id ){
                        continue;
                      }
                     
                     ?>
                     <tr style="<?=$flag1?"background:#caffca":""?>">
                      <td> </td>
                      <td style="    padding-top: 9px !important;"><?=$h->zimmet_stok_adi?> </td>
                      <td style="    padding-top: 9px !important;"> <?=$h->zimmet_alt_bolum_adi?> </td>
                       
                      <td style="    padding-top: 9px !important;"><?=$h->zimmet_hareket_cikis_miktar?>
                     
                      <td style="    padding-top: 9px !important;"><?=date("d.m.Y H:i",strtotime($h->zimmet_hareket_tarihi))?></td>
                       
                       
                    </tr>
                     <?php
                    }
                    ?>
                     
                  </tbody>
                </table>
    
    
    </div>
    </div>
  </div>

    <?php
                      }
                      ?>

  
   
</div>


              
              </div>
              <!-- /.card-body -->
            </div>


                

            <?php 
            
            if(!empty($secilen_hareket)){
              ?>
 <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Hareket Bilgilerini Düzenle
 
                </h3>
             
              </div>
              <div class="card-body">
              <form action="<?=base_url("zimmet/bolume_stok_tanim_guncelle/$secilen_departman/$secilen_hareket->zimmet_hareket_id ")?>" method="post">
               <div class="row">
               <div class="col-3">
                    <select required name="zimmet_kullanici_no" class="select2 form-control" id="">

                    <option value="">Üretim Bölümü Seçiniz</option>

                      <?php 
                      foreach ($kullanicilar as $s) {
                        
                       ?>
                       <option value="<?= $s->zimmet_alt_bolum_id ?>" <?=($secilen_hareket->zimmet_hareket_alt_bolum_no  == $s->zimmet_alt_bolum_id  ? "selected" : "")?>><?=$s->zimmet_alt_bolum_adi?></option>
                       <?php
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-3">
                    <select required name="zimmet_stok_no" class="select2 form-control" id="">

                    <option value="">Stok Seçiniz</option>

                      <?php 
                      foreach ($stoklar as $s) {
                       ?>
                       <option value="<?= $s->zimmet_stok_id?>" <?=($secilen_hareket->zimmet_stok_no == $s->zimmet_stok_id ? "selected" : "")?>><?=$s->zimmet_stok_adi?></option>
                       <?php
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-3">
                  <input type="hidden"   name="temp_miktar" class="form-control" min="1"  value="<?=$secilen_hareket->zimmet_hareket_cikis_miktar?>">
                    <input type="number" required name="zimmet_hareket_giris_miktar" value="<?=$secilen_hareket->zimmet_hareket_cikis_miktar?>" class="form-control" min="1" placeholder="Stok Miktarı Giriniz">
                  </div>
                  <div class="col-3">
                    <button type="submit" class="btn btn-success" style="    width: -webkit-fill-available;">
                      KAYDET
                    </button>
                  </div>
                </div>
               </form>
              </div>
              <!-- /.card-body -->
            </div>
              <?php
            }
            ?>

            

                  </div>
                </div>

  </div>

 </div>








                
              </div>
              <!-- /.card -->
            </div>
          </div>
</div>
 


<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
 



 <script type="text/javascript">
     $(document).ready(function() {
      var table245 = $("#table_2_toplustok").DataTable({ "ordering": false, "pageLength": 999 });
        var table246 = $("#table_2_verilenler").DataTable({ "ordering": false, "pageLength": 10 });
     
  var table246 = $("#table_2_kategori").DataTable({ "ordering": false, "pageLength": 41 });
     
 
     });
 </script>