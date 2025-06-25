
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper pt-2"> <div class="col-md-5">
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
                            if($h->hareket_sayisi <= 0){
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
  