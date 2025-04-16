
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
              <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Task</th>
                      <th>Progress</th>
                      <th style="width: 40px">Label</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1.</td>
                      <td>Update software</td>
                      <td>
                        <div class="progress progress-xs">
                          <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                        </div>
                      </td>
                      <td><span class="badge bg-danger">55%</span></td>
                    </tr>
                    <tr>
                      <td>2.</td>
                      <td>Clean database</td>
                      <td>
                        <div class="progress progress-xs">
                          <div class="progress-bar bg-warning" style="width: 70%"></div>
                        </div>
                      </td>
                      <td><span class="badge bg-warning">70%</span></td>
                    </tr>
                    <tr>
                      <td>3.</td>
                      <td>Cron job running</td>
                      <td>
                        <div class="progress progress-xs progress-striped active">
                          <div class="progress-bar bg-primary" style="width: 30%"></div>
                        </div>
                      </td>
                      <td><span class="badge bg-primary">30%</span></td>
                    </tr>
                    <tr>
                      <td>4.</td>
                      <td>Fix and squish bugs</td>
                      <td>
                        <div class="progress progress-xs progress-striped active">
                          <div class="progress-bar bg-success" style="width: 90%"></div>
                        </div>
                      </td>
                      <td><span class="badge bg-success">90%</span></td>
                    </tr>
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


