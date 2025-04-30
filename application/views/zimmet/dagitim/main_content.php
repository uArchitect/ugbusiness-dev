
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper pt-2"> <div class="col-md-12">
            <div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  KULLANICI BAZLI STOK TANIMLA
                </h3>
              </div>
              <div class="card-body" style="height: 800px;">
               
            

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
                
                
                  <div class="card card-success card-outline">
              <div class="card-header">
                <h3 class="card-title">Kullanıcıya Envanter Tanımla
 
                </h3>
             
              </div>
              <div class="card-body">
              <form action="<?=base_url("zimmet/kullaniciya_stok_tanimla/$secilen_departman")?>" method="post">
               <div class="row">
               <div class="col-3">
                    <select required name="zimmet_kullanici_no" class="select2 form-control" id="">

                    <option value="">Kullanıcı Seçiniz</option>

                      <?php 
                      foreach ($kullanicilar as $s) {
                        if($s->zimmet_departman_kullanici_tanim_departman_no != $secilen_departman){
                          continue;
                        }
                       ?>
                       <option value="<?= $s->kullanici_id?>"><?=$s->kullanici_ad_soyad?></option>
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
                       <option value="<?= $s->zimmet_stok_id?>"><?=$s->zimmet_stok_adi?></option>
                       <?php
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-3">
                    <input type="number" required name="zimmet_hareket_giris_miktar" class="form-control" min="1" placeholder="Stok Miktarı Giriniz">
                  </div>
                  <div class="col-3">
                    <button type="submit" class="btn btn-danger" style="    width: -webkit-fill-available;">
                      KAYDET
                    </button>
                  </div>
                </div>
               </form>
              </div>
              <!-- /.card-body -->
            </div>




<div class="card card-warning card-outline">
              <div class="card-header">
                <h3 class="card-title">Kullanıcılar Verilen Envanter Bilgileri
 
                </h3>
             
              </div>
              <div class="card-body">
              <table    class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Stok Adı</th>
                      <th>Kullanıcı</th>
                      
                      



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
                     
                     ?>
                     <tr style="<?=$flag1?"background:#caffca":""?>">
                      <td> </td>
                      <td style="    padding-top: 9px !important;"><?=$h->zimmet_stok_adi?> </td>
                      <td style="    padding-top: 9px !important;"><a href="<?=base_url("kullanici/profil_new/$h->kullanici_id?subpage=envanter")?>" target="_blank"><?=$h->kullanici_ad_soyad?></a></td>
                       
                      <td style="    padding-top: 9px !important;"><?=$h->zimmet_hareket_cikis_miktar?>
                     
                      <td style="    padding-top: 9px !important;"><?=date("d.m.Y H:i",strtotime($h->zimmet_hareket_tarihi))?></td>
                      <td>
                    
                      <div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm">
                        <i class="fa fa-pen"></i>
                        </button>
                        <button type="button" class="btn btn-default btn-sm">
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
              <!-- /.card-body -->
            </div>



<div class="card card-danger ">
              <div class="card-header">
                <h3 class="card-title">Toplu Stok Tanımlama (Test)
 
                </h3>
             
              </div>
              <div class="card-body">
              <table id="table_2_kategori" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Stok Adı</th> 
                      <th>Kalan</th> 
                      <th>Verilecek Stok Miktarı</th> 
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
                    
                      <td><?=$h->kalan?></td>
                      <td>
                        <input type="number" class="form-control" max="<?=$h->kalan?>">
                      </td>
                      
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
                </div>

  </div>

 </div>








                
              </div>
              <!-- /.card -->
            </div>
          </div>
</div>
 