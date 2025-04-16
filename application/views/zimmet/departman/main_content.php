
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
                      <th>Miktar</th>
                      <th style="width: 140px">İşlem Tarihi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    foreach ($hareketler as $h) {
                     ?>
                     <tr>
                      <td>1.</td>
                      <td><?=$h->zimmet_stok_adi?></td>
                      <td>
                        <div class="progress progress-xs">
                          <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                        </div>
                      </td>
                      <td><span class="badge bg-danger">55%</span></td>
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


