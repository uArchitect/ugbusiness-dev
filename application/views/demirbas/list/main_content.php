<style>
  .inventory {
            display: none; 
        }

         .inventory.active {
            display: contents;
        }
        .arrow {
          font-size: 12px;
    margin-left: 4px;
    margin-top: 13px;
    margin-right: 10px;
}

.arrow-up {
    transform: rotate(180deg);
}
       
</style> 


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
 
<section class="content text-md">
<div class="card card-dark" style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - Parametreler - Demirbaş Yönetimi</h3>
              
              <a href="<?=base_url("demirbas/ekle/1")?>" type="button" class="btn btn-primary btn-sm" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Kayıt Ekle</a>
            

              <?php
                if(!empty($kategori_kontrol)){
                    ?>
                    <a href="<?=base_url("demirbas")?>" type="button" class="btn btn-danger btn-sm mr-2" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-times text-white" style="font-size:12px" aria-hidden="true"></i> Filtrelemeyi kaldır, tüm kayıtları göster  </a>
            
                    <?php
                }
               ?> 
              
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table   class="table table-bordered table-striped text-sm">
                  <thead>
                    <th></th>
                    <th></th>
                    <th></th> 
              </thead>
                  <tbody>
                    <?php $count=0; $seenUsers = []; // Kullanıcıları takip edeceğimiz dizi
foreach ($demirbaslar as $demirbas1) : 
    // Eğer bu kullanıcı daha önce görüldüyse, geç ve continue ile geç
    if (in_array($demirbas1->kullanici_id, $seenUsers)) {
        continue;
    } 
    $seenUsers[] = $demirbas1->kullanici_id;
    ?>
                    
                    <tr onclick="toggleInventory('inv<?=$demirbas1->kullanici_id?>')" style="background-color: rgb(125 125 125 / 5%)!important;cursor:pointer">
    <td style="display:flex;">
    <i class="fas fa-chevron-down arrow" id="arrow9"></i>
        <span style="margin-top:9px;display:block"> <?=$demirbas1->kullanici_ad_soyad?></span> 
    </td>
    <td></td>
    <td></td> 
</tr>
                    



                    <?php $count=0; foreach ($demirbaslar as $demirbas) : ?>
                    <?php 
                      if($demirbas1->kullanici_ad_soyad != $demirbas->kullanici_ad_soyad){
                        continue;
                      }
                      ?>
                      <tr class="inventory" id="inv<?=$demirbas1->kullanici_id?>" style="background-color: white!important;" >
                      <td style="    display: flex
;">  
                      <?php 
                       if($demirbas->kategori_id == 1){
                        ?>
                        <img style="width:40px" src="https://m.media-amazon.com/images/I/71s72QE+voL.jpg">
                        <?php
                       } 
                       if($demirbas->kategori_id == 2){
                        ?>
                        <img style="width:40px" src="https://cdn.vatanbilgisayar.com/Upload/PRODUCT/lenovo/thumb/147559-1_large.jpg">
                        <?php
                       } 
                       if($demirbas->kategori_id == 3){
                        ?>
                        <img style="width:40px" src="https://yemekkarti.co/sites/yemekkarti.co/files/inline-images/MN_dikey_erkek.png">
                        <?php
                       } 
                       if($demirbas->kategori_id == 4){
                        ?>
                        <img style="width:40px" src="https://cdn.qukasoft.com/f/752658/bzR6WmFtNG0vcUp3ZUdGdEg4MXZKZWxESUE9PQ/p/intel-i3-4n-8gb-120gb-ssd-19-mon-masaustu-bilgisayar-195154728-sw1000sh1000.webp">
                        <?php
                       } 
                       ?> 
                       <?=$demirbas->demirbas_adi?> 

                       <?php 
                       if($demirbas->kategori_id == 3){
                        ?>
                        <span style="margin-top:9px" class="d-block">Multinet Kart</span> 
                        <?php
                       }else{
                        ?>
                        <span  style="margin-top:9px" class="d-block"><?=$demirbas->demirbas_marka?></span> 
                        <?php
                       }
                       ?>
                    </td>
                      
                      
                      <td>
                        
                        <span style="margin-top:9px;display:block">
                          <i class="far fa-calendar-plus" style="margin-right:5px;opacity:1"></i>
                          <?=date('d.m.Y H:i',strtotime($demirbas->demirbas_kayit_tarihi));?>
                        </span>

                      </td>
                      
                      <td>
                    
                          <a href="<?=site_url("demirbas/duzenle/$demirbas->demirbas_id")?>" type="button" class="btn btn-warning btn-xs"><i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> Düzenle</a>
                          <a type="button" onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu kaydı silmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Onayla','<?=base_url('demirbas/sil/').$demirbas->demirbas_id?>');" class="btn btn-danger btn-xs"><i class="fa fa-times" style="font-size:12px" aria-hidden="true"></i> Kayıt Sil</a>
                        
                      </td>
                       
                    </tr>
                      <?php  endforeach; ?>







                  <?php  endforeach; ?>
                  </tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
</section>
            </div>


            <script>
  function toggleInventory(card) {
    // Tıklanan elementin id'si ve eşleşen ok id'sini al
    const inventory = document.getElementById(card);
    const arrow = document.getElementById('arrow' + card.replace('inv', ''));

    // Önce tüm inv ile başlayan elementlerden active sınıfını kaldır
    // Örneğin, tüm inventory class'ına sahip elementler kontrol ediliyor
    const allInventories = document.querySelectorAll('[id^="inv"]');
    allInventories.forEach(function(item) {
      if(item.id !== card) {
        item.classList.remove('active');
      }
    });

    // İlgili arrow elementleri için de aynı şekilde
    const allArrows = document.querySelectorAll('[id^="arrow"]');
    allArrows.forEach(function(item) {
      // Eğer ilgili ok element tıklananla eşleşmiyorsa
      if(item.id !== 'arrow' + card.replace('inv', '')) {
        item.classList.remove('arrow-up');
      }
    });

    // Son olarak tıklanan elementte toggle işlemi yap
    inventory.classList.toggle('active');
    arrow.classList.toggle('arrow-up');
  }
</script>
