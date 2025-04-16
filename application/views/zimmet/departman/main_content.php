
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper pt-2"> <div class="col-md-12">
            <div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  DEPARTMAN BAZLI STOK TANIMLA
                </h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12 col-lg-6">
                    <h4>Üretim Departmanı  </h4>
                    <div class="card card-danger card-outline">
              <div class="card-header">
                <h3 class="card-title">Yeni Stok Tanımla</h3>
              </div>
              <div class="card-body">
               <form action="<?=base_url("zimmet/departmana_stok_tanimla/1")?>" method="post">
               <div class="row">
                  <div class="col-5">
                    <select name="zimmet_stok_no" class="select2 form-control" id="">
                      <?php 
                      foreach ($stoklar as $s) {
                       ?>
                       <option value="<?= $s->zimmet_stok_id?>"><?=$s->zimmet_stok_adi?></option>
                       <?php
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-5">
                    <input type="number" name="zimmet_hareket_giris_miktar" class="form-control" min="1" placeholder="Stok Miktarı Giriniz">
                  </div>
                  <div class="col-2">
                    <button type="submit" class="btn btn-success" style="    width: -webkit-fill-available;">
                      KAYDET
                    </button>
                  </div>
                </div>
               </form>
              </div>
              <!-- /.card-body -->
            </div>


            <div class="card card-danger card-outline">
              <div class="card-header">
                <h3 class="card-title">Üretim Departmanı <small>(Tanımlanan Stoklar)</small></h3>
              </div>
              <div class="card-body">
              <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Stok Adı</th>
                      <th>Verilen</th>
                      <th>Dağıtılan</th>
                      <th>Kalan</th>
                      <th style="width: 140px">İşlem Tarihi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    foreach ($hareketler as $h) {

                      $flag1 = ($this->session->flashdata('departmanID')==1&&$this->session->flashdata('insertedID')==$h->zimmet_stok_no);
                     ?>
                     <tr style="<?=$flag1?"background:#caffca":""?>">
                      <td>1.</td>
                      <td><?=$h->zimmet_stok_adi?>(<?=$h->zimmet_departman_adi?>)</td>
                      <td><?=$h->toplam_giris?>
                    <?php 
                    if($flag1){
                      ?>
                      <img src="https://i.pinimg.com/originals/49/02/54/4902548424a02117b7913c17d2e379ff.gif" style=" width: 18px; margin: 0; scale: 1.9; margin-top: -2px; ">
                      <?php
                    }
                    ?>
                    </td>
                      <td><?=$h->toplam_cikis?></td>
                      <td><?=$h->kalan?></td>
                      <td> <?=date("d.m.Y h:i",strtotime($h->zimmet_hareket_tarihi))?></td>
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
                  <div class="col-12 col-lg-6">
                    <h4>Servis Departmanı <small>(Tanımlanan Stoklar)</small></h4>
                    <div class="card card-danger card-outline">
              <div class="card-header">
                <h3 class="card-title">Yeni Stok Tanımla</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-5">
                    <select name="" class="select2 form-control" id="">
                      <?php 
                      foreach ($stoklar as $s) {
                       ?>
                       <option value=""><?=$s->zimmet_stok_adi?></option>
                       <?php
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-5">
                    <input type="number" class="form-control" min="1" placeholder="Stok Miktarı Giriniz">
                  </div>
                  <div class="col-2">
                    <button class="btn btn-success" style="    width: -webkit-fill-available;">
                      KAYDET
                    </button>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
                  </div>
                </div>
            
                
              </div>
              <!-- /.card -->
            </div>
          </div>
</div>


