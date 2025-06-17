<style>
  .inventory {
            display: none; 
        }

         .inventory.active {
            display: revert;
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
     
    ?>
                    
                    <tr onclick="toggleInventory('invc<?=$demirbas1->kullanici_id?>')" style="background-color: rgb(125 125 125 / 5%)!important;cursor:pointer">
    <td style="display:flex;">
    <span style="height: 1em; width: 1em; color: white; border: .15em solid white; margin-top:10px; margin-right:10px; border-radius: 1em; box-shadow: 0 0 .2em #444; box-sizing: content-box; text-align: center; text-indent: 0 !important; font-family: 'Courier New', Courier, monospace; line-height: 1em; content: '+'; background-color: #0275d8;">+</span>
        <span style="margin-top:9px;display:block"> <?=$demirbas1->kullanici_ad_soyad?></span> 
    </td>
    <td></td>
    <td></td> 
</tr>
                    



                    <?php $count=0; foreach ($demirbaslar2 as $demirbas) : ?>
                    <?php 
                      if($demirbas1->kullanici_id != $demirbas->kullanici_id){
                        continue;
                      }
                      ?>
                       


                    <tr class="inventory invc<?=$demirbas1->kullanici_id?>">
                      <td colspan="4">



<button style="padding-right: 0px;width: 100%; border: 1px dashed #002355;padding-left:0px;" type="button" class="btn btn-default text-left pb-2">   
  <div class="row">
    <div class="col" style="max-width: 87px;">
      <?php 
        if($demirbas->kategori_id == 1){
        ?>
          <img src="https://m.media-amazon.com/images/I/71s72QE+voL.jpg" alt="..." style="width: 83px;" class="rounded img-thumbnail">
            

        <?php
        } 
        if($demirbas->kategori_id == 2){
        ?>
          <img src="https://cdn.vatanbilgisayar.com/Upload/PRODUCT/lenovo/thumb/147559-1_large.jpg" alt="..." style="width: 83px;" class="rounded img-thumbnail">
            

        <?php
        } 
        if($demirbas->kategori_id == 3){
        ?>
          <img src="https://yemekkarti.co/sites/yemekkarti.co/files/inline-images/MN_dikey_erkek.png" alt="..." style="width: 83px;" class="rounded img-thumbnail">
            

        <?php
        } 
        if($demirbas->kategori_id == 4){
        ?> 
        <img src="https://cdn.qukasoft.com/f/752658/bzR6WmFtNG0vcUp3ZUdGdEg4MXZKZWxESUE9PQ/p/intel-i3-4n-8gb-120gb-ssd-19-mon-masaustu-bilgisayar-195154728-sw1000sh1000.webp" alt="..." style="width: 83px;" class="rounded img-thumbnail">
            

        <?php
        } 
        ?> 
  </div>
  <div class="col" style="padding-left: 0px;">
    <span style="display: block;background: #dbdbdb;padding: 5px;color: white;border-radius: 5px;border-radius: 3px 3px 0 0;">
      <span style="min-width: 230px; width: 230px; display: inline-block; margin-left:5px">
        <b style="color:#0f3979">
        <?php 
        if($demirbas->kategori_id == 3){
          echo  "MULTINET KART";
        }else{
          echo  $demirbas->demirbas_marka;
        }
        ?>  
        </b>
      </span>                 
    </span>
    <span style="height: 11px;"></span>
    <div style="padding-left:10px;background:white;border:1px solid;border-top:0px;border: 1px solid #dbdbdb; border-top: 0px; border-radius: 0px 0px 3px 3px;">
    <b>Envanter Kayıt Tarihi : </b> <?=date('d.m.Y H:i',strtotime($demirbas->demirbas_kayit_tarihi));?><br>
     
    
<?php 
                       if($demirbas->kategori_id == 1){
                        ?>
                        
                        <span>Telefon Numarası : </span><span><?=$demirbas->demirbas_telefon_numarasi?></span><br>
                        <span>Icloud Mail : </span><span><?=$demirbas->demirbas_icloud_adres?></span> 
                        <span>Icloud Şifre : </span>  <span><?=$demirbas->demirbas_icloud_adres?></span>
                        
                        <?php
                       } 
                        
                       if($demirbas->kategori_id == 3){
                        ?>
                        
                        <span>Kart Numarası : </span><span><?=$demirbas->demirbas_multinet_kart_no?></span><br>
                        <span>Kart CVV : </span><span><?=$demirbas->demirbas_multinet_cvv?></span><br>
                        <span>Bakiye : </span><span><?=$demirbas->demirbas_multinet_bakiye?> 
                      
                        <?php
                       } 
                       ?>
    
    <br><br>
     
     <a href="<?=site_url("demirbas/duzenle/$demirbas->demirbas_id")?>" type="button" class="btn btn-warning btn-xs"><i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> Düzenle</a>
                          <a type="button" onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu kaydı silmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Onayla','<?=base_url('demirbas/sil/').$demirbas->demirbas_id?>');" class="btn btn-danger btn-xs"><i class="fa fa-times" style="font-size:12px" aria-hidden="true"></i> Kayıt Sil</a>
                          <br>            
    </div>
  </div>
</div>
</button>






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
 

    document.querySelectorAll('tr.'+card).forEach(function(div) {
  div.classList.toggle('active');
});
  }
</script>


 