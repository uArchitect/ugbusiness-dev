<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?=("https://teslimat.ugmanager.com.tr/assets/dist/css/")?>bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    @font-face { font-family: kalam-regular; 
    src: url('./Kalam-Regular.ttf'); } 
  
    .square {
      max-height: 20px;
      margin-top:5px;
      min-width: 20px;
      background-color: white;
      border-width: 2px;
      border-color: black;
      border-style: solid;
      display: inline-block;
    }

    .noktali-bolge {
    position: relative;
    font-family: kamal-regular;
}

.noktali-bolge::after {
    content: attr(data-isim);
    color: blue;
    position: absolute;
    top: -5px;
    margin-bottom: 10px;
    left: 2px;
    width: max-content;
}


.noktali-bolge2 {
    position: relative;
    font-family: kamal-regular;
}

.noktali-bolge2::after {
    content: attr(data-isim);
    color: blue; 
    top: -5px;
    margin-bottom: 10px;
    left: 2px;
    width: max-content;
}


.noktali-bolge-mt2 {
    position: relative;
}

.noktali-bolge-mt2::after {
    content: attr(data-isim);
    color: blue;
    position: absolute;
    top: 0px;
    margin-bottom: 5px;
    left: 8px;
    width: max-content;
    font-size:14px;
}
 
    </style>
</head>
<body>
 
<div class="text-center">
  <h3 style="font-weight: bold;"><i>TESLİMAT DENETİM FORMU</i></h3>
  
</div>
<div class="text-right" style="margin-top:-30px">
  <h4 style="margin-right:40px"><i>Tarih :  <?=date('d / m / Y',strtotime($data->kurulum_tarihi));?></i></h4>
  
</div>
<div class="container">
  <div class="row">
    <div class="col-sm-6">
      <h3 style="border-radius: 20px;width: 170px; padding:5px;padding-left:15px; font-weight: bold; font-size:17px; background-color:  rgb(236, 234, 234);"><i>Kullanıcı Bilgileri</i></h3>
      <p>İşyeri Adı : <span class="noktali-bolge" data-isim="<?=$data->merkez_adi?>">..........................................................................</span></p>
      <p>Yetkili : <span class="noktali-bolge" data-isim="<?=$data->musteri_ad?>"></span> ............................................................................</p>
      <p>Adres : <span class="noktali-bolge2" data-isim="<?=$data->merkez_adresi?>" style="width: 100% !important;"></span> </p>
      <p>İl : <span class="noktali-bolge" data-isim="<?=($data->sehir_adi)?>"></span> .................................... İlçe : <span class="noktali-bolge" data-isim="<?=$data->ilce_adi?>"></span> ......................................</p>
    
      <h3 style="border-radius: 20px;  padding:5px;padding-left:15px; font-weight: 600; font-size:16px; background-color:  rgb(236, 234, 234); color: rgb(90, 90, 90);"><i>Telefon :</i><span class="noktali-bolge-mt2" data-isim="<?=$data->musteri_iletisim_numarasi?>"></span></h3>
     <span style="color: blue;">
     <?php
     if($data->yetkili_adi_2 != ""){
        echo "2. Yetkili : ".$data->yetkili_adi_2."( ".$data->iletisim_numarasi_2." )";
     }
     ?></span>
    </div>
    <div class="col-sm-6">
      <h3 style="border-radius: 20px;width: 150px; padding:5px;padding-left:15px; font-weight: bold; font-size:17px; background-color:  rgb(236, 234, 234);"><i>Detaylı Bilgiler</i></h3>
      <h3 style="border-radius: 20px;  padding:5px;padding-left:15px;   font-size:16px; background-color:  rgb(236, 234, 234); color: rgb(90, 90, 90);">
      
        <p><i>Araç Plaka : </i><span class="noktali-bolge-mt2" data-isim="
        <?php
        echo $data->sirket_arac_plaka;
        ?>
        
        "></span></p>
        <p><i>Kurulum :</i><span class="noktali-bolge-mt2" data-isim=" <?php 
        $klist = [];
        foreach ($kurulum_ekip as $kurulum_kisi) {
          $klist[] = $kurulum_kisi->kullanici_ad_soyad;
        }
         echo  implode(', ', $klist);
        ?>"></span></p>
        <p><i>Eğitim Veren Kişi : </i><span class="noktali-bolge-mt2" data-isim="
        <?php 
               $elist = [];
               foreach ($egitim_ekip as $egitim_kisi) {
                 $elist[] = $egitim_kisi->kullanici_ad_soyad;
               }
                echo  implode(', ', $elist);
        ?>"></span></p>
       <?php
       $count=0;
      foreach ($cihazlar as $value) {
        $count++;
        ?>
         <p><i><?php if(count($cihazlar) > 1) {echo $count.".";} ?> Cihaz Marka : </i><span class="noktali-bolge-mt2" data-isim=" 
         
         
         <?php
                                                                       
                                                                        echo $value->urun_adi;
                                                                        echo ($value->renk_adi) ? " (".$value->renk_adi.")" : "";
                                                                    ?>
         
         
         "></span></p>
         <p><i><?php if(count($cihazlar) > 1) {echo $count.".";} ?> Cihaz Seri No : </i><span class="noktali-bolge-mt2" data-isim="<?= $value->seri_numarasi?>"></span></p>
      
        <?php
      }
       ?>
       
       
      </h3>
       </div>
  </div>
</div>

<?php 
if($data->degerlendirme_formu != ""){



?>
<hr style="min-height: 2px !important; margin-right:35px;margin-left:35px; background-color: black;">
<div class="container" style="margin-left:20px;">
  <div style="display:flex">
    <div class="square">&nbsp</div> 
    <div style="margin-left:20px;margin-top:5px;font-size:18px">
      <i>Varış Saati</i>  : <span class="noktali-bolge" data-isim="<?=json_decode($data->degerlendirme_formu)[0]->value?>"></span>  ...........................
    </div>
  </div>
  <div style="display:flex; margin-top: 15px;">
    <div class="square">&nbsp</div> 
    <div style="margin-left:20px;margin-top:5px;font-size:18px">
      <i>Müşteriye teslimat ile alakalı bilgiler verildi mi?</i>  : <span class="noktali-bolge" data-isim="<?=json_decode($data->degerlendirme_formu)[1]->value?>"></span>  ...........................................................
    </div>
  </div>
   
  <div style="display:flex; margin-top: 15px;">
    <div class="square">&nbsp</div> 
    <div style="margin-left:20px;margin-top:5px;font-size:18px">
      <i>Konum istendi mi?</i>  : <span class="noktali-bolge" data-isim="<?=json_decode($data->degerlendirme_formu)[2]->value?>"></span>  .......................................................................................................
    </div>
  </div>
  <div style="display:flex; margin-top: 15px;">
    <div class="square">&nbsp</div> 
    <div style="margin-left:20px;margin-top:5px;font-size:18px">
      <i>Cihaz verilen adrese ulaştı mı?</i>  : <span class="noktali-bolge" data-isim="<?=json_decode($data->degerlendirme_formu)[3]->value?>"></span>  ...................................................................................
    </div>
  </div>
  <div style="display:flex; margin-top: 15px;">
    <div class="square">&nbsp</div> 
    <div style="margin-left:20px;margin-top:5px;font-size:18px">
      <i>Kurulum tamamlandı mı?</i>  : <span class="noktali-bolge" data-isim="<?=json_decode($data->degerlendirme_formu)[4]->value?>"></span> ............................................................................................
    </div>
  </div>

  <div style="display:flex; margin-top: 15px;">
    <div class="square">&nbsp</div> 
    <div style="margin-left:20px;margin-top:5px;font-size:18px">
      <i>Roll up (Branda)</i>  : <span class="noktali-bolge" data-isim="<?=json_decode($data->degerlendirme_formu)[5]->value?>"></span>  ..............................
    </div>
    <div style="margin-left:20px;margin-top:5px;font-size:18px">
      <i>UmexAilesi (Plexi tabela)</i>  : <span class="noktali-bolge" data-isim="<?=json_decode($data->degerlendirme_formu)[6]->value?>"></span>  .............................
    </div>
  </div>

  <div style="display:flex; margin-top: 15px;">
    <div class="square">&nbsp</div> 
    <div style="margin-left:20px;margin-top:5px;font-size:18px">
      <i>Kurulum bittikten sonra oda temizliği yapıldı mı?</i>  : <span class="noktali-bolge" data-isim="<?=json_decode($data->degerlendirme_formu)[7]->value?>"></span>  ........................................................
    </div>
  </div>

  <div style="display:flex; margin-top: 15px;">
    <div class="square">&nbsp</div> 
    <div style="margin-left:20px;margin-top:5px;font-size:18px">
      <i>Eğitim tamamlandı ve eğitim formu dolduruldu mu?</i>  : <span class="noktali-bolge" data-isim="<?=json_decode($data->degerlendirme_formu)[8]->value?>"></span>  ...................................................
    </div>
  </div>

  <div style="display:flex; margin-top: 15px;">
    <div class="square">&nbsp</div> 
    <div style="margin-left:20px;margin-top:5px;font-size:18px">
      <i>Cihaz fotosu çekildi mi (4 Farklı Açıdan)?</i>  : <span class="noktali-bolge" data-isim="<?=json_decode($data->degerlendirme_formu)[9]->value?>"></span>  .................................................................
    </div>
  </div>
  <div style="display:flex; margin-top: 15px;">
    <div class="square">&nbsp</div> 
    <div style="margin-left:20px;margin-top:5px;font-size:18px">
      <i>Cihazda herhangi bir çizik ya da hasar var mı?</i>  : <span class="noktali-bolge" data-isim="<?=json_decode($data->degerlendirme_formu)[10]->value?>"></span>  ..........................................................
    </div>
  </div>
  <div style="display:flex; margin-top: 15px;">
    <div class="square">&nbsp</div> 
    <div style="margin-left:20px;margin-top:5px;font-size:18px">
      <i>Senet yapıldı mı ?</i>  : <span class="noktali-bolge" data-isim="<?=json_decode($data->degerlendirme_formu)[11]->value?>"></span>  .......................................................................................................
    </div>
  </div>

  <div style="display:flex; margin-top: 15px;">
    <div class="square">&nbsp</div> 
    <div style="margin-left:20px;margin-top:5px;font-size:18px">
      <i>Sözleme yapıldı mı ?</i>  : <span class="noktali-bolge" data-isim="<?=json_decode($data->degerlendirme_formu)[12]->value?>"></span>  ...................................................................................................
    </div>
  </div>

  <div style="display:flex;margin-top: 15px;">
    <div class="square">&nbsp</div> 
    <div style="margin-left:20px;margin-top:5px;font-size:18px">
      <i>Çıkış Saati</i>  : <span class="noktali-bolge" data-isim="<?=json_decode($data->degerlendirme_formu)[13]->value?>"></span>  ................
    </div>
  </div>

</div>



<?php } ?>




<script type="text/javascript">
    window.onload = function() { window.print(); }
</script>
</body>
</html>
