
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper pt-2"> <div class="col-md-6">
            <div class="card card-dark ">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  KULLANICI BAZLI STOK TANIMLA
                </h3>
              </div>
              <div class="card-body"  >
               
            

 <div class="row">
   

  <div class="col">
    <div class="row">
                  <div class="col">
                



 
              <?php 
$gruplar = [];
foreach ($kullanicihareketlerdetay as $h) {
    if($h->zimmet_departman_no != $secilen_departman || $h->zimmet_hareket_cikis_miktar == 0){
        continue;
    }
    $gruplar[$h->kullanici_id]['adsoyad'] = $h->kullanici_ad_soyad;
    $gruplar[$h->kullanici_id]['veriler'][] = $h;
}
?>

 
        <?php foreach($gruplar as $kullanici_id => $kullanici): ?>
          
 <a href="<?=base_url("kullanici/profil_new/$kullanici_id?subpage=envanter")?>" target="_blank"><?=$kullanici['adsoyad']?></a>

 <table class="table table-sm table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Stok Adı</th>
                                <th>Miktar</th> 
                               
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($kullanici['veriler'] as $veri): ?>
                                <tr>
                                    <td><?=$veri->zimmet_stok_adi?></td>
                                    <td><?=$veri->zimmet_hareket_cikis_miktar?></td>
                                    
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
        <?php endforeach; ?>
     

               
 





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
     
   $(".kullanici-row").click(function(){
        var target = $(this).data("target");
        $("." + target).toggle();
        $(this).find("i").toggleClass("fa-chevron-down fa-chevron-up");
    });
     });
 </script>