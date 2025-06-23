
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
               <table id="table_2_kategori" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Stok Adı</th>
                      <th>Hareket Sayısı</th>  
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    foreach ($zimmet_stoklar as $h) {
                      ?>
                     <tr>
                      <td></td>
                      <td><?=$h->zimmet_stok_adi?> </td>
                              <td><?=$h->zimmet_stok_adi?> </td>
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
  