<div class="content-wrapper">

<div class="header" style="margin: 13px;">
                <h2 style="font-size: 1.3rem;margin-bottom:-2px">Envanter Bilgileri</h2>
                <p>Kullanıcıya tanımlanmış olan envanter bilgileri aşağıda listelenmiştir. </p>
            </div>

<?php $count=0; foreach ($envanterler as $demirbas) : ?>
                 


                    <tr class="inventory m-4">
                      <td colspan="4">



<button style="padding-right: 0px;    width: -webkit-fill-available;margin: 13px;
    margin-top: 1px; border: 1px dashed #002355;padding-left:0px;" type="button" class="btn btn-default text-left pb-2">   
  <div class="row">
    <div class="col" style="max-width: 87px;">
      <?php 
        if($demirbas->kategori_id == 1){
        ?>
          <img src="https://m.media-amazon.com/images/I/71s72QE+voL.jpg" alt="..." style="width: 83px;height: -webkit-fill-available; object-fit: contain;" class="rounded img-thumbnail">
            

        <?php
        } 
        if($demirbas->kategori_id == 2){
        ?>
          <img src="https://cdn.vatanbilgisayar.com/Upload/PRODUCT/lenovo/thumb/147559-1_large.jpg" alt="..." style="width: 83px;height: -webkit-fill-available; object-fit: contain;" class="rounded img-thumbnail">
            

        <?php
        } 
        if($demirbas->kategori_id == 3){
        ?>
          <img src="https://yemekkarti.co/sites/yemekkarti.co/files/inline-images/MN_dikey_erkek.png" alt="..." style="width: 83px;height: -webkit-fill-available; object-fit: contain;" class="rounded img-thumbnail">
            

        <?php
        } 
        if($demirbas->kategori_id == 4){
        ?> 
        <img src="https://cdn.qukasoft.com/f/752658/bzR6WmFtNG0vcUp3ZUdGdEg4MXZKZWxESUE9PQ/p/intel-i3-4n-8gb-120gb-ssd-19-mon-masaustu-bilgisayar-195154728-sw1000sh1000.webp" alt="..." style="width: 83px;height: -webkit-fill-available; object-fit: contain;" class="rounded img-thumbnail">
            

        <?php
        } 
        ?> 
  </div>
  <div class="col-md-6" style="padding-left: 0px;">
    <span style="display: block;background: #dbdbdb;padding: 5px;color: white;border-radius: 5px;border-radius: 3px 3px 0 0;">
      <span style="min-width: 230px; width: 230px; display: inline-block; margin-left:5px">
        <b style="color:#0f3979">
        <?php 
        if($demirbas->kategori_id == 3){
          echo  "MULTINET KART";
        }else{
          echo  $demirbas->demirbas_marka;
        }

          echo  " / ".$demirbas->kullanici_ad_soyad;
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
                          <br>      <br>            
    </div>
  </div>
</div>
</button>






                      </td>
                      </tr>
                      <?php  endforeach; ?>



</div>