<style>
    @keyframes blink {
        0% { opacity: 1; }
        50% { opacity: 0; }
        100% { opacity: 1; }
    }
    rect {
        fill: yellow;
    }
    .blinking {
        animation: blink 1s infinite;
        background-color: yellow;
    }

    

</style> 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px;background:#e7e7e7;">
 
<section class="content text-md">
  
<span alt="" style="
    margin: auto;
    text-align:center;
    align-items: center;
    display: block;
    font-size:35px;
    margin-right:10px;
    color: #000000;
    margin-bottom: -20px;
    margin-top: -10px;
    margin-left:5px;
    font-weight: 800;
">
<?=$sehir->sehir_adi?> RUT PLANLANMA VE GÖRÜŞME KAYITLARI
</span>
<a href="<?=base_url("rut")?>" class="btn btn-dark" style="
    margin-top: -50px;
    margin-left:10px;
"><i class="fas fa-arrow-circle-left"></i> HARİTAYA GERİ DÖN</a>
<div class="row" style="flex-wrap: nowrap;">
  <div class="col col-md-4">
  <div class="card">
  <div class="card-header" style="
    background: #00890c;
    color: white;
">
      <i class="fas fa-user-plus"></i> Yeni Rut Planı
    </div>
    <div class="card-body">

<?php 

if($rut_tanim == false){
?>
<form action="<?=base_url("rut/rut_tanimla")?>" method="POST">
<?php
}else{
  ?>
<form action="<?=base_url("rut/rut_duzenle/".$rut_tanim->rut_tanim_id)?>" method="POST">
<?php
}

?>
    <div class="form-group">
      <label for="formClient-Code"> Satış Temsilcisi</label>
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <div class="input-group" style="flex-wrap: nowrap;">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fas fa-user"></i></span>
              </div>
            
              <select name="kullanici_id" required class="select2 form-control rounded-0" style="width: 100%;">
              <option  value="">Seçim Yapılmadı</option>
                  
              <?php foreach($kullanicilar as $kullanici) : ?>  
                              <option  value="<?=$kullanici->kullanici_id?>" <?php echo  (($rut_tanim != false) && $rut_tanim->rut_kullanici_id == $kullanici->kullanici_id) ? 'selected="selected"'  : '';?>><?=$kullanici->kullanici_ad_soyad?> / <?=$kullanici->kullanici_unvan?> / <?=$kullanici->departman_adi?></option>
                
                    <?php endforeach; ?>  
              </select>
              <input type="text" name="sehir_id" style="opacity:0" value="<?=$sehir->sehir_id?>">

                 
        </div>  
        <label class="mt-2" for="formClient-Code"> Rut Başlangıç Tarihi</label>
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <input type="date" required class="form-control" value="<?php echo  (($rut_tanim != false)) ? date("Y-m-d",strtotime($rut_tanim->rut_baslangic_tarihi )) : '';?>" name="rut_baslangic_tarihi" data-inputmask-alias="datetime" data-inputmask-inputformat="dd.mm.yyyy" data-mask="" inputmode="numeric">
        <label class="mt-2" for="formClient-Code">  Rut Bitiş Tarihi</label>
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>  
                    <input type="date" required class="form-control" value="<?php echo  (($rut_tanim != false)) ? date("Y-m-d",strtotime($rut_tanim->rut_bitis_tarihi )) : '';?>" name="rut_bitis_tarihi" data-inputmask-alias="datetime" data-inputmask-inputformat="dd.mm.yyyy" data-mask="" inputmode="numeric">
                      
 <label class="mt-2" for="formClient-Code">  İlçe Bilgisi</label>
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>  
         <select class="select2bs4" id="rut_ilce_id"  name="rut_ilce_id[]" multiple data-placeholder="İlçe Seçimi Yapınız" style="width: 100%;">
       
        <option value="">Seçim Yapılmadı</option>
        <?php foreach($ilceler as $ilce) : ?> 
          <?php
            $ilce_id = $ilce->ilce_id;
            $selected = (!empty($rut_tanim) && is_array(json_decode($rut_tanim->rut_ilce_bilgisi)) && in_array($ilce_id, json_decode($rut_tanim->rut_ilce_bilgisi))) ? 'selected="selected"' : '';
        ?>
                    <option  data-icon="fab fa-gg"  value="<?=$ilce->ilce_id?>" <?=$selected?>><?=$ilce->ilce_adi?></option>
      
          <?php endforeach; ?>  
                  </select>

        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
        Yeni bir rut planı oluşturulduğunda haritadaki ilgili şehirde son tanımlanan rut bilgisindeki satış temsilcisinin adı yer almaktadır.
      </p>

      <?php 
      
      if($rut_tanim != false){

?>
    <button type="submit" class="btn btn-success" style="
     
     "><i class="fas fa-save"></i> Bilgileri Güncelle</button>
<?php

      }else{
        ?>
    <button type="submit" class="btn btn-success" style="
     
     "><i class="fas fa-save"></i> Kaydet</button>
<?php
      }
      ?>
  

</form>


      </div>
    </div>
    <div class="card-footer">

    </div>
  </div>

  <div class="card">
  <div class="card-header" style="
    background: #3aff4c52;
    color: black;
">
     <i class="fas fa-route"></i> Geçmiş Rut Planlamaları
    </div>
    <div class="card-body">

    <?php 
    foreach ($rut_tanimlari as $rut) {
      ?>
       <div class="card card-dark card-outline mb-2">
                <div class="card-header" style="">
                  <h5 class="card-title" style="font-size: large;"><b><?=$rut->kullanici_ad_soyad?></b> / <?=$rut->kullanici_unvan?>
                  <br>
                <span style="font-size:13px">
                   <i class="far fa-calendar-alt"></i> <b>Başlangıç</b> : <?=date("d.m.Y",strtotime($rut->rut_baslangic_tarihi))?>                <span>
                   <i class="far fa-calendar-alt ml-2"></i> <b>Bitiş</b> : <?=date("d.m.Y",strtotime($rut->rut_bitis_tarihi))?> 
                  </span></span>
                  <br>
                  <span style="font-size:13px">
                   <i class="fas fa-car"></i> <b>Araç</b> : <?=($rut->arac_plaka) ? $rut->arac_plaka : "ARAÇ TANIMLANMADI"?>         
                       
                  </span>

                  <br>
                  <span style="font-size:13px">
                  <i class="fas fa-map-marker-alt"></i>&nbsp; <b>İlçe</b> &nbsp;&nbsp;: <?php
                  if($rut->rut_ilce_bilgisi != "[]" && $rut->rut_ilce_bilgisi != "null" && $rut->rut_ilce_bilgisi != null) {

                    echo "<span class='text-success'>";
                    $ilcelers = json_decode($rut->rut_ilce_bilgisi);
                    $totalIlceler = count($ilcelers);

                    foreach ($ilcelers as $key => $secilen_ilce) {
                    
                      foreach ($ilceler as $ilce) {
                       if($ilce->ilce_id == $secilen_ilce){
                        echo $ilce->ilce_adi;
                       }
                      }
                      $count++;
                    if ($key != $totalIlceler - 1) {
                          echo ", ";
                      }
                  }
                  echo "</span>";
                  } else{

                  
                    echo "<span class='text-danger'>İLÇE TANIMLANMADI</span>";
                  }
                  
?>         
                       
                  </span>
              
                </h5>
                  <div class="card-tools">
                    
                                      

                  <a class="btn btn-warning" href="<?=base_url("rut/form/".$sehir->sehir_id."/".$rut->rut_tanim_id)?>">
                  <i class="fas fa-edit"></i>
                    </a>
                    <a class="btn btn-danger" onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu kaydı silmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Onayla','<?=base_url('rut/rut_sil/').$rut->rut_tanim_id?>');">
                    <i class="fas fa-trash-alt"></i> İptal Et
                    </a>
                  </div>
                </div>
              </div>

      <?php
    }
    
    ?>

   


    </div>
    <div class="card-footer">
    <span class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
         Toplam <?=($rut_tanimlari) ? count($rut_tanimlari) : "0"?> adet rut planlaması listelenmiştir.
                  </span>
    </div>
  </div>


  </div>
  <div class="col">
  <div class="card">
  <div class="card-header" style="
    background: #021547;color:white;
">
      <i class="fas fa-people-arrows"></i> Tüm Rut Görüşmeleri
    </div>
    <div class="card-body">
      



<div>
  

<table id="example1yonlendirilentablo" class="table text-xs table-bordered table-responsive table-striped nowrap">
                  <thead>
                  <tr>
                    <th style="width: 42px;">Talep Durum</th> 
                    <th>Müşteri Adı Soyadı</th> 
                    <th>Kullandığı Marka</th>
                 
                    <th>İletişim Numarası</th>
                 
                    <th>Satış Temsilcisi</th> 
                    <th style="width: 130px;">Yönlendirme Tarihi</th>
               
                    <th style="width: 42px;">Görüşme Detay</th>     
                  </tr>
                  </thead>
                  <tbody >
                    <?php $count=0; foreach ($talepler as $talep) : ?>
                      <?php $count++?>
                    <tr>
                      <td><button type="button" class="btn btn-xs bg-<?=$talep->talep_sonuc_renk?>" style="font-size: 11px !important;width: -webkit-fill-available;"><i class="<?=$talep->talep_sonuc_ikon
                      ?>"></i> <?=$talep->talep_sonuc_adi?></button> </td> 
                      <td>
                        <i class="fa fa-user" style="font-size:13px"></i> <?=$talep->talep_musteri_ad_soyad?>
                      /  <?=$talep->talep_isletme_adi == "" ? "<span style='opacity:0.5'>Girilmedi</span>" :$talep->talep_isletme_adi." (".$talep->sehir_adi.")" ?>
                      
   
                  </td>
                  <td>
                      <i class="far fa-question-circle"></i>
                        <?=($talep->marka_id != 2) ? $talep->marka_adi : $talep->talep_kullanilan_cihaz_aciklama?>
                        
                      
                      </td>
                  
                      <td >
                        <i class="fa fa-mobile-alt"></i>
                        <?=formatTelephoneNumber($talep->talep_cep_telefon)?>
                        
                      
                      </td>
                    
                    
                     
                      <td><i class="fas fa-arrow-circle-right text-orange"></i> <?=$talep->yonlendiren_ad_soyad?></td>
                      

                      <td><?=date('d.m.Y H:i',strtotime($talep->yonlendirme_tarihi));?></td>
                  
                    
                    

                        <td  >
                          <?php 
                          if(($talep->gorusme_detay == "")){
                         
                            ?>
                             <button disabled style="width: -webkit-fill-available;opacity:0.5;" class="btn btn-default" >
                               X
                              </button>
                            <?php
                          }else{
?>
 <button style="width: -webkit-fill-available;" class="btn btn-default showAlertButton custombutton" data-message="<?=$talep->gorusme_detay?>">
 <i class="fas fa-comment-dots"></i> Detay
 </button>
<?php
                          }
                          
                          ?>


</td>   

                    </tr>

                  

                    
                  <?php  endforeach; ?>
                  </tbody>
               
                </table>


</div>














    
    </div>
    <div class="card-footer">

    </div>
  </div>
  </div>
</div>



            <!-- /.card -->
</section>

            </div>

       
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  
var buttons = document.getElementsByClassName('showAlertButton');

 
for (var i = 0; i < buttons.length; i++) {
    buttons[i].addEventListener('click', function() {
      
        var message = this.getAttribute('data-message');
       
        if (message.trim() !== '') {
          Swal.fire({
                title: "Görüşme Detayı",
                html: message,
                
                icon:"info",
              
                showCancelButton: false,
                showConfirmButton: true
              });
        } else {
            swal("Hata", "Lütfen bir metin girin!", "error");
        }
    });
}


var buttons = document.querySelectorAll(".custombutton");

buttons.forEach(function(button) {
    button.addEventListener("click", function() {
        this.classList.toggle("clicked");
    });
});


  </script>


<style>
  .custombutton.clicked {
    background-color: #ebf377;
}
  </style>