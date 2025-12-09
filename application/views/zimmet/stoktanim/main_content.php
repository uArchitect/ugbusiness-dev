<?php $this->load->view('zimmet/includes/styles'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper content-wrapper-zimmet pt-2">
  <section class="content pr-0">
    <div class="row">
      <div class="col-12">
        <div class="card card-zimmet">
          <!-- Card Header -->
          <div class="card-header card-header-zimmet">
            <div class="d-flex align-items-center justify-content-between w-100">
              <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3 card-header-icon-wrapper">
                  <i class="fas fa-edit card-header-icon"></i>
                </div>
                <div>
                  <h3 class="mb-0 card-header-title">
                    Stok Düzenle / Sil
                  </h3>
                  <small class="card-header-subtitle">Stok tanımlarını düzenle ve sil</small>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Modern Tab Navigation Bar -->
          <?php $this->load->view('zimmet/includes/tabs'); ?>
          
          <!-- Card Body -->
          <div class="card-body card-body-zimmet">
            <div class="card-body-content">
<div class="col-md-5">
            <div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  KULLANICI BAZLI STOK TANIMLA
                </h3>
              </div>
              <div class="card-body"  >
               <table id="table_2_kategori" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Stok Adı</th>
                      <th>Hareket Sayısı</th>  
                      <th>Sil</th>  
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    foreach ($zimmet_stoklar as $h) {
                      ?>
                     <tr>
                      <td></td>
                      <td><?=$h->zimmet_stok_adi?> </td>
                          <td><?=$h->hareket_sayisi?> </td>
                          <td>
                            <?php 
                            if($h->hareket_sayisi <= 1){
                              ?>
                                <a class="btn btn-danger" href="<?=base_url("zimmet/stoktanimsil/$h->zimmet_stok_id")?>">KAYIT SİL</a>
                        
                              <?php
                            }
                            ?>
                        
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
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
  