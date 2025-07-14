
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper pt-2"> <div class="col-md-12">
            <div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  KULLANICI BAZLI STOK TANIMLA
                </h3>
              </div>
              <div class="card-body"  >
               
            

 <div class="row">
  <div class="col-lg-5">



  <div class="card card-dark card-outline">
              <div class="card-header">
                <h3 class="card-title" style="font-size: 22px; font-weight: 600; margin-top: 2px;"><?=$secilen_departman == 1 ? "Üretim" : "Servis"?> Departmanı <small>(Tanımlanan Stoklar)</small></h3>
               
              </div>
              <div class="card-body">
              <table id="table_2_kategori" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Stok Adı</th>
                      <th>Toplam Verilen</th>
                      <th>Toplam Dağıtılan</th>
                      <th>Kalan</th> 
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    foreach ($hareketler as $h) {
                      if($h->zimmet_departman_no != $secilen_departman){
                        continue;
                      }
                      $flag1 = ($this->session->flashdata('departmanID')==$secilen_departman&&$this->session->flashdata('insertedID')==$h->zimmet_stok_no);
                     ?>
                     <tr style="<?=$flag1?"background:#caffca":""?>">
                      <td> </td>
                      <td><?=$h->zimmet_stok_adi?> </td>
                      <td><?=$h->toplam_giris?>
                    <?php 
                    if($flag1){
                      ?>
                      <img src="https://i.pinimg.com/originals/49/02/54/4902548424a02117b7913c17d2e379ff.gif" style=" width: 18px; margin: 0; scale: 1.9; margin-top: -2px; ">
                      <span class="text-success">+<?=$this->session->flashdata('count')?> Eklendi</span>
                      <?php
                    }
                    ?>
                    </td>
                      <td><?=$h->toplam_cikis?></td>
                      <td><?=$h->kalan?></td>
                       
                    </tr>
                     <?php
                    }
                    ?>
                     
                  </tbody>
                </table>
 
              </div>
              <!-- /.card-body -->
            </div>













  </div>


  <div class="col-lg-7">
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
                      <th>İşlem</th> 

                      
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
                      <td>
                    
                      <div class="btn-group">
                        <a href="<?=base_url("zimmet/uretimdagitim/$secilen_departman/$h->zimmet_hareket_id")?>" type="button" class="btn btn-default btn-sm">
                        <i class="fa fa-pen"></i>
                        </a>
                        <button onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu hareketi silmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Onayla','<?=base_url('zimmet/hareket_sil/').$h->zimmet_hareket_id?>');" type="button" class="btn btn-default btn-sm">
                        <i class="fa fa-trash"></i>
                        </button> 
                      </div>

                      </td>
                       
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

           


<div class="card card-danger ">
              <div class="card-header">
                <h3 class="card-title">Üretim Bölümüne Stok Tanımlama 
 
                </h3>
             
              </div>
              <div class="card-body">


              <form action="<?=base_url("zimmet/toplu_stok_kaydet_uretim/$secilen_departman")?>" method="post">

              <h4>Üretim Bölüm Seçimi Yapınız</h4>
  <h5 style="font-weight:normal;font-size:14px">Sisteme tanımlı üretim bölümlerini düzenlemek için <a href="<?=base_url("zimmet/uretimbolumyonetimi")?>">tıklayınız</a></h5>


              <select id="zimmet_bolum_select" name="zimmet_kullanici_no" class="form-control" style="margin-bottom:10px!important" required>
    <option value="">Üretim Bölümü Seçiniz</option>
    <?php foreach ($kullanicilar as $s): ?>
        <option value="<?= $s->zimmet_alt_bolum_id ?>"><?= $s->zimmet_alt_bolum_adi ?></option>
    <?php endforeach; ?>
</select>

<br>
<ul class="users-list clearfix" id="users-list">
    <!-- AJAX ile dolacak -->
</ul>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $('#zimmet_bolum_select').on('change', function () {
    
        var bolum_id = $(this).val();
 
        $.ajax({
            url: "<?= base_url('zimmet/bolume_gore_kullanicilar/'.$bolum_id) ?>", // controller/metod
            method: "POST",
            data: { bolum_id: bolum_id },
            success: function (response) {
              
                $('#users-list').html(response);
            }
        });
    });
</script>


<br>
              <div style="height:500px;overflow: auto;">
              <table id="table_2_toplustok" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th style="width: 250px">Stok Adı</th> 
                      <th style="width: 120px" >Verilecek Miktar</th> 
                      <th>Güncel Stok</th> 
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    foreach ($hareketler as $h) {
                      if($h->zimmet_departman_no != $secilen_departman){
                        continue;
                      }
                      $flag1 = ($this->session->flashdata('departmanID')==$secilen_departman&&$this->session->flashdata('insertedID')==$h->zimmet_stok_no);
                     ?>
                     <tr style="<?=$flag1?"background:#caffca":""?>">
                      <td> </td>
                      <td><?=$h->zimmet_stok_adi?> </td>
                      <td>
                        <input type="hidden" name="id[]" class="form-control"  value="<?=$h->zimmet_stok_id?>"> 
                        <input type="number" name="miktar[]" class="form-control" min="1" max="<?=$h->kalan?>">
                      </td>
                      <td><?=$h->kalan?></td>
                    
                      
                    </tr>
                     <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
                <button type="submit" class="btn btn-success" style="width: -webkit-fill-available; padding: 11px; margin-top: 10px;font-size:16px!important">Bilgileri Kaydet</button>

</form>
              </div>
              <!-- /.card-body -->
            </div>





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