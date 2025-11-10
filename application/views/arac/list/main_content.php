<?php 
if(count($araclar) == 1 && empty($secilen_arac)){
  redirect(base_url("arac/index/".$araclar[0]->arac_id));
}
?>
<div class="content-wrapper" style="zoom: 0.990; padding-left:2px;">
  <section class="content col" style="padding: 2px;padding-top: 0;">
     <div class="card card-dark" style=" margin-bottom: 2px;border-radius:0px;">
      <div class="card-header with-border" style="background:#061f3a;    padding: 8px;"> 
      <h3 class="card-title" style="color: #6bc0ff;width: 650px;">
        <div class="row">
        <div class="col-9">
          UMEX - TÜM ŞİRKET ARAÇ KAYITLARI <br>
          <span style="font-size:13px;color: #ffffff;">
            <i class="fa fa-user-circle"></i> Toplam Araç Sayısı : <?=count($araclar)?><span>
          </span>
          </div>
        </div>   
      </h3>
        </div>
        <div class="card-body" style="padding-bottom: 0px;padding-top: 1px; padding-left: 1px; padding-right: 1px;">
        </div>
      </div>
<div class="row">
  <div class="col-md-3" style="    padding: 0;">
  <div class="card card-dark <?=(count($araclar) == 1 ? "d-none":"")?>" style=" margin-bottom: 2px;">
          <div class="card-header with-border" style="border-radius: 0px;background:#081f39">
          <h3 class="card-title text-center">
          <i class="fas fa-folder-plus"></i> ARAÇ LİSTESİ
          </h3>
          </div>
          <div class="card-body" style="padding: 0;">

         <?php 
         foreach ($araclar as $arac_row) {
         ?>
          <div class="info-box p-3 <?=(!empty($secilen_arac) && $secilen_arac[0]->arac_id == $arac_row->arac_id) ? "info-box-active":""?>" onclick="location.href='<?=base_url('arac/index/'.$arac_row->arac_id)?>'" style="cursor: pointer;min-height: 68px;margin-top:2px;padding:0px;margin-bottom: 2px;">
            <span class="info-box-icon bg-success" id="ARAC<?=$arac_row->arac_id?>"><i class="fas fa-car"></i></span>
            <div class="info-box-content" style="line-height: 1;">
            <span class="info-box-text" style="font-weight: 400;color: #143967;"><?=$arac_row->arac_plaka?> / <?=$arac_row->arac_marka?> <?=$arac_row->arac_model?> / <?=($arac_row->kullanici_ad_soyad) ? " ".$arac_row->kullanici_ad_soyad : "<span style='opacity:0.5'>Sürücü Atanmadı</span>"?></span>
           
 

            <?php 
            foreach ($arac_liste as $alist) {
             if($alist->arac_id != $arac_row->arac_id){
              continue;
             }
             ?>
  <div class="d-flex">
  <i class="fas fa-info-circle" style="margin-top: 4px;"></i>
            <span class="info-box-number <?=($alist->sigorta_kalan_gun != "" && $alist->sigorta_kalan_gun < 11)?"yanipsonenyazi":""?>">&nbsp;Sigorta :</span>  <span class="info-box-number mr-1 <?=($alist->sigorta_kalan_gun != null && $alist->sigorta_kalan_gun < 11)?"yanipsonenyazi":""?>" style="margin-left: 3px;font-weight:normal;"> <?=($alist->sigorta_kalan_gun && $alist->sigorta_kalan_gun > 0) ? " ".$alist->sigorta_kalan_gun." Gün Kaldı" : "<span style='opacity:0.5'>#</span>"?></span> 
          
            <span class="info-box-number ml-2 <?=($alist->kasko_kalan_gun != "" && $alist->kasko_kalan_gun < 11)?"yanipsonenyazi":""?>">Kasko :</span>  <span class="info-box-number mr-1 <?=($alist->kasko_kalan_gun != null && $alist->kasko_kalan_gun < 11)?"yanipsonenyazi":""?>" style="margin-left: 3px;font-weight:normal;"> <?=($alist->kasko_kalan_gun && $alist->kasko_kalan_gun > 0) ? " ".$alist->kasko_kalan_gun." Gün Kaldı" : "<span style='opacity:0.5'>#</span>"?></span> 



              
            </div>
   <div class="d-flex">
            <span class="info-box-number ml-2 <?=($alist->muayene_kalan_gun != "" && $alist->muayene_kalan_gun < 11)?"yanipsonenyazi":""?>">Muayene :</span>  <span class="info-box-number mr-1 <?=($alist->muayene_kalan_gun != null && $alist->muayene_kalan_gun < 11)?"yanipsonenyazi":""?>" style="margin-left: 3px;font-weight:normal;"> <?=($alist->muayene_kalan_gun && $alist->muayene_kalan_gun > 0) ? " ".$alist->muayene_kalan_gun." Gün Kaldı" : "<span style='opacity:0.5'>SÜRE GEÇTİ ! ".($alist->muayene_kalan_gun*-1)." gün</span>"?></span> 
             </div>
            <div class="d-flex">
            <?php 
            $kmlastdata = get_arac_km_son_kayit($alist->arac_id);
            if($kmlastdata){
              ?>
             
               <span class="info-box-number"> <i class="fas fa-bell"></i> KM :</span>  
               <span class="info-box-number ml-1" style="font-weight:normal">
              <?php
             $gun = gunSayisiHesapla(date("d.m.Y"),date("d.m.Y",strtotime($kmlastdata->arac_km_kayit_tarihi)));
             
             if(($alist->kasko_kalan_gun != "" && $alist->kasko_kalan_gun < 11) || ($alist->kasko_kalan_gun != "" && $alist->sigorta_kalan_gun < 11)){
             
              echo "<script>var x".$arac_row->arac_id." = document.querySelectorAll('#ARAC".$arac_row->arac_id."');
              x".$arac_row->arac_id."[0].setAttribute('style', 'border-radius:0px;background-color: red !important');
              x".$arac_row->arac_id."[0].setAttribute('class', 'info-box-icon bg-danger yanipsonenyazi');
              
              </script>
              ";
            
             }  
             
             if($gun == 0){
              echo "$kmlastdata->arac_km_deger <span class='text-success'>Bugün güncellendi.</span>";
                  echo "<script>var x".$arac_row->arac_id." = document.querySelectorAll('#ARAC".$arac_row->arac_id."');
                        x".$arac_row->arac_id."[0].setAttribute('style', 'border-radius:0px;background-color: #007317 !important');
                       
                        </script>
                        ";
            
             }  
             else if($gun < 7 && ($arac_row->arac_id != 9 && $arac_row->arac_id != 15)){
                echo "$kmlastdata->arac_km_deger <span class='text-success'>".$gun." gün önce güncellendi.</span>";
                echo "<script>var x".$arac_row->arac_id." = document.querySelectorAll('#ARAC".$arac_row->arac_id."');
                x".$arac_row->arac_id."[0].setAttribute('style', 'border-radius:0px;background-color: #007317 !important');
                 
                </script>
                ";
               }else{
                if(($arac_row->arac_id != 9 && $arac_row->arac_id != 15)){
                if(($arac_row->arac_id != 9 && $arac_row->arac_id != 15)){
                  echo "$kmlastdata->arac_km_deger <span class='text-danger yanipsonenyazi'>".$gun." gün önce güncellendi.</span>";
              
                }else{
                  echo "$kmlastdata->arac_km_deger";
              
                }
                echo "<script>var x".$arac_row->arac_id." = document.querySelectorAll('#ARAC".$arac_row->arac_id."');
                x".$arac_row->arac_id."[0].setAttribute('style', 'border-radius:0px;background-color: red !important');
                x".$arac_row->arac_id."[0].setAttribute('class', 'info-box-icon bg-success yanipsonenyazi');
                
                </script>
                ";
               }   }
            }else{
              echo "<span class='text-warning mt-2'>Km kaydı oluşturulmadı.</span>";
              echo "<script>var x".$arac_row->arac_id." = document.querySelectorAll('#ARAC".$arac_row->arac_id."');
              x".$arac_row->arac_id."[0].setAttribute('style', 'border-radius:0px;color: black !important;background-color: orange !important;');
               
              </script>
              ";
            }
            ?></span>  


            </div>
             <?php
            }
           ?>
            
           </div>

          </div>
         <?php
         }
         ?>

          </div>
        </div>

     




  </div>

  

  <div class="<?=(count($araclar) == 1 ? "col-md-12":"col")?>" style="padding: 0px;
    padding-left: 2px;">





    <div class="row <?=!empty($secilen_arac) ? "d-none":""?>">
          <div class="col-lg-12 col-12" style="padding: 0px;">
            <div class="card card-dark" style="text-align: center;margin-bottom: 2px;min-height: 810px;">
                  <div style="    width: 550px;text-align: center;margin: auto;">
                    <img style="width: 750px;
    margin-left: -120px;" src=" <?=base_url("assets/dist/img/araba.png")?>">      
                    <br><br>
                    <span style="font-size: 25px;font-weight: 600;color: #1e386e;">   
                    ARAÇ SEÇİLMEDİ </span>
                    <br>
                    <span style="opacity: 0.7; font-size: 20px; color: #1e386e;">
                      Detayları görüntülemek ve işlem kaydetmek için sol menüden araç seçimi yapınız.
                    </span>
                  </div>
            </div>
          </div>
    </div>


<div class="row <?=empty($secilen_arac) ? "d-none":""?>">
          <div class="col-lg-12 col-12" style="padding: 0px;">
            <div class="card card-dark" style=" margin-bottom: 2px;">
              <div class="card-header with-border" style="border-radius: 0px;background:#0a1f38">
                <h3 class="card-title text-center">
                <i class="fas fa-car-side"></i> <?=!empty($secilen_arac)?$secilen_arac[0]->arac_plaka:""?>
                </h3>
                <div class="card-tools">


 <a onclick="lastik_kayit_olustur();" class="btn btn-warning" style="color: white; background: #1461c3; border: 0px; padding: 5px; padding-left: 8px; font-size: 10px !important; margin: 0px !important; margin-right: 4px; padding-right: 9px;"><i class="fas fa-cog"></i> ARAÇ LASTİK KAYDI EKLE</a>
       
                
        <a href="https://ugbusiness.com.tr/arac" class="btn btn-warning" style="color: white; background: red; border: 0px; padding: 5px; padding-left: 8px; font-size: 10px !important; margin: 0px !important; margin-right: 4px; padding-right: 9px;"><i class="fas fa-times"></i></a>
       
        </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-6"  style="cursor:pointer;padding: 0px;">
            <div class="small-box bg-success" style="      height: 99%;  margin-bottom: 2px !important; border-radius: 0px;background: #103869!important;">
              <div class="inner">
                <h3><?=(!empty($arac_kmler) && count($arac_kmler)>0) ? $arac_kmler[0]->arac_km_deger : "0"?>
                </h3>
                <p>Araç Km <span style="opacity:0.6">(Son Güncelleme : <?=(!empty($arac_kmler) && count($arac_kmler)>0) ? date("d.m.Y H:i",strtotime($arac_kmler[0]->arac_km_kayit_tarihi)) : "#"?>)</span></p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>

              <div style="
    display: flex;
">
  <a onclick="km_kayit_olustur();" class="small-box-footer" style="    padding: 3px;cursor:pointer;width: -webkit-fill-available;text-align: center;color: white;background-color: rgb(0 0 0 / 29%);"> Km Bilgisini Güncelle <i class="fas fa-arrow-circle-right"></i>
  </a>
  <a onclick="km_hareketlerini_goster();" class="small-box-footer" style="    padding: 3px;text-align: center;cursor:pointer;width: -webkit-fill-available;color: white;background-color: rgb(0 0 0 / 29%);"> Km Hareketleri <i class="fas fa-arrow-circle-right"></i>
  </a>
</div>
              
            </div>
          </div>  
         
          <?php 
          $kullaniciprofil = base_url("kullanici/profil_new/".$secilen_arac[0]->kullanici_id."?subpage=ozluk-dosyasi");
          ?>
          <div class="col-lg-4 col-6" style="cursor:pointer;padding: 0px;padding-left: 2px;">
            <div class="small-box bg-success" style=" margin-bottom: 2px !important;border-radius: 0px;background: #103869!important;">
              <div class="inner"  onclick="location.href='<?=$kullaniciprofil?>';">
                <h3><?=(!empty($secilen_arac) && $secilen_arac[0]->kullanici_ad_soyad)?$secilen_arac[0]->kullanici_ad_soyad:"#"?>

                </h3>
                
                <p>Sürücü Bilgisi</p>
              </div>
              <div class="icon">
                <?php 
                if((!empty($secilen_arac) && $secilen_arac[0]->kullanici_resim)){
?><i>
<img style="width: 90px;    border: 4px solid white;border-radius:50%;height: 90px;object-fit:cover;margin-top: -65px;" src="https://ugbusiness.com.tr/uploads/<?=$secilen_arac[0]->kullanici_resim?>">
</i>  
<?php
                }else{
                  ?>
<i class="ion ion-person-add"></i>
                  <?php
                }
                
                ?>
         
                
              </div>
              <a onclick="surucu_guncelle();" class="small-box-footer" style="background-color: rgb(0 0 0 / 29%);">Sürücü Bilgisini Güncelle <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>  

          <div class="col-lg-4 col-6" onclick="marka_model_guncelle();" style="cursor:pointer;padding: 0px;padding-left: 2px;">
            <div class="small-box bg-success" style="    height: 99%; margin-bottom: 2px !important;border-radius: 0px;background: #103869!important;">
              <div class="inner">
                <h3><?=!empty($secilen_arac)?$secilen_arac[0]->arac_marka:""?> <?=!empty($secilen_arac)?$secilen_arac[0]->arac_model:""?>
                </h3>
                <p>Marka Model</p>
              </div>
              <div class="icon">
                <?php 
                if($secilen_arac[0]->arac_resim){
                  ?>
                  <i style="    top: -20px;">
<img src="<?=$secilen_arac[0]->arac_resim?>" style="
    width: 200px;
"> 
</i>
                  <?php
                }else{
                  ?>
<i class="ion ion-stats-bars"></i>

                  <?php
                }
                ?>
                

              </div>
              <a onclick="marka_model_guncelle();" class="small-box-footer" style="background-color: rgb(0 0 0 / 29%);">Marka Model Bilgisini Güncelle <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>  
 
</div>











<div class="row <?=empty($secilen_arac) ? "d-none":""?>">

  <div class="col" style="padding: 0;overflow-y: scroll; max-height: 337px;">
  <div class="card card-dark <?=(!empty($filter) ? "d-none":"")?>" style="      margin-bottom: 5px;  border-radius: 0px; ">
          <div class="card-header with-border" style="   padding: 5px;  padding-right: 15px;   border-radius: 0px;background:#094a9b">
          <h3 class="card-title text-center" style="margin-top: 6px;">
          <i class="fas fa-tools"></i> ARAÇ BAKIM İŞLEMLERİ
          </h3>
          
          </div>
          <div class="card-body" style="padding: 0;min-height: 365px;max-height: 583px;">

          <div class="row <?=empty($bakim_kayitlari)?"d-none":""?>">
          <div style="padding:5px;background: #2196f33d;color: #001aa1;margin-top: 0px;border: 2px solid #3F51B5;">
     <span style="font-size:15px!important;"><i class="fas fa-exclamation-circle" style="
    margin-right: 4px;
    color: #f50000;
"></i> 
<b><?=!empty($secilen_arac)?$secilen_arac[0]->arac_plaka:""?></b>
   plakalı araç için en son <b><?=(!empty($bakim_kayitlari) && count($bakim_kayitlari)>0) ? date("d.m.Y",strtotime($bakim_kayitlari[count($bakim_kayitlari)-1]->arac_bakim_baslangic_tarihi)) : "#"?></b> tarihinde bakım kaydı oluşturulmuştur. <b class="yanipsonenyazi" style="color: red;"><?=$bakim_kayitlari[count($bakim_kayitlari)-1]->arac_sonraki_bakim_km?></b> km'de tekrar bakım yapılacaktır.</span>
 </div>
          </div>


          <table id="example1bakim" class="table text-xs table-bordered table-striped nowrap">
                  <thead>
                  <tr>
                    <th >Bakım Bilgileri</th>
                    <th style="max-width: 40px; width: 40px; min-width: 40px;">İşlem</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($bakim_kayitlari as $bkayit) {
                     ?>
                      <tr>
                        <td><b>BAKIM : </b> <?=date("d.m.Y",strtotime($bkayit->arac_bakim_baslangic_tarihi))?> <b style="margin-left:7px;">KM : </b> <?=$bkayit->arac_bakim_guncel_km?> <b style="margin-left:7px;">S. Bakım KM : </b> <?=$bkayit->arac_sonraki_bakim_km?></td>
                        <td>
                           <a type="button"  onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu kaydı silmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Onayla','<?=base_url('arac/bakim_sil/').$bkayit->arac_bakim_id?>');"   class="btn btn-xs btn-danger"><i class="fas fa-times"></i> Sil</a>
                        </td>
                      </tr>
                     <?php
                    }
                    ?>
              
                  </tbody>
                 
                 </table>


                 <div class="btn-group " style="margin-left:2px;">
        
        <button type="button" onclick="kayit_olustur('Bakım','bakim');" style="background:#ffffff;     color: green;   margin-left: 5px;" class="btn btn-success "><i class="fas fa-plus-circle"></i> Yeni Bakım Ekle</button>
         
        </div>


          </div>

        </div>


       
  </div>

  <div class="col" style="padding: 0px;padding-left:3px;">
  <div class="card card-dark <?=(!empty($filter) ? "d-none":"")?>" style="      margin-bottom: 5px;  border-radius: 0px; ">
          <div class="card-header with-border" style="   padding: 5px;  padding-right: 15px;   border-radius: 0px;background:#094a9b">
          <h3 class="card-title text-center" style="margin-top: 6px;">
          <i class="fas fa-tools"></i> ARAÇ SİGORTA İŞLEMLERİ
          </h3>
          
          </div>
          <div class="card-body" style="padding: 0;min-height: 365px;max-height: 365px;">



          <div class="row <?=empty($sigorta_kayitlari)?"d-none":""?>">
          <div style="padding:5px;background: #2196f33d;color: #001aa1;margin-top: 0px;border: 2px solid #3F51B5;">
     <span style="font-size:15px!important;"><i class="fas fa-exclamation-circle" style="
    margin-right: 4px;
    color: #f50000;
"></i> 
<b><?=!empty($secilen_arac)?$secilen_arac[0]->arac_plaka:""?></b>
   plakalı araç için en son <b><?=(!empty($sigorta_kayitlari) && count($sigorta_kayitlari)>0) ? date("d.m.Y",strtotime($sigorta_kayitlari[count($sigorta_kayitlari)-1]->arac_sigorta_baslangic_tarihi)) : "#"?></b> tarihinde sigorta kaydı oluşturulmuştur. Sigorta tarihinin sona ermesine <?=gunSayisiHesapla(date("d.m.Y"),date("d.m.Y",strtotime($sigorta_kayitlari[count($sigorta_kayitlari)-1]->arac_sigorta_bitis_tarihi)))?> gün kalmıştır.</span>
 </div>
          </div>


          <table id="example1sigorta" class="table text-xs table-bordered table-striped nowrap">
                  <thead>
                  <tr>
                    <th >Sigorta Bilgileri</th>
                    <th style="max-width: 40px; width: 40px; min-width: 40px;">İşlem</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    foreach ($sigorta_kayitlari as $skayit) {
                     ?>
                      <tr>
                        <td><b>SİGORTA : </b> <?=date("d.m.Y",strtotime($skayit->arac_sigorta_baslangic_tarihi))?> / <?=date("d.m.Y",strtotime($skayit->arac_sigorta_bitis_tarihi))?> <b style="margin-left:7px;">KM : </b> <?=$skayit->arac_sigorta_guncel_km?></td>
                        <td>
                          <a type="button" target="_blank" onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu kaydı silmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Onayla','<?=base_url('arac/sigorta_sil/').$skayit->arac_sigorta_id?>');" class="btn btn-xs btn-danger"><i class="fas fa-times"></i> Sil</a>
                        </td>
                      </tr>
                     <?php
                    }
                    ?>
                  </tbody>
                 
                 </table>


                 <div class="btn-group " style="margin-left:2px;">
        
        <a type="button"  onclick="kayit_olustur('Sigorta','sigorta');" style="background:#ffffff;     color: green;   margin-left: 5px;" class="btn btn-success "><i class="fas fa-plus-circle"></i> Yeni Sigorta Ekle</a>
         
        </div>

          </div>

        </div>
    </div>

    <div class="col" style="padding: 0;padding-left:3px;">
    <div class="card card-dark <?=(!empty($filter) ? "d-none":"")?>" style="      margin-bottom: 5px;  border-radius: 0px; ">
          <div class="card-header with-border" style="   padding: 5px;  padding-right: 15px;   border-radius: 0px;background:#094a9b">
          <h3 class="card-title text-center" style="margin-top: 6px;">
          <i class="fas fa-tools"></i> ARAÇ KASKO İŞLEMLERİ
          </h3>
          
          </div>
          <div class="card-body" style="padding: 0;min-height: 365px;max-height: 365px;">



       
          <div class="row <?=empty($kasko_kayitlari)?"d-none":""?>">
          <div style="padding:5px;background: #2196f33d;color: #001aa1;margin-top: 0px;border: 2px solid #3F51B5;">
     <span style="font-size:15px!important;"><i class="fas fa-exclamation-circle" style="
    margin-right: 4px;
    color: #f50000;
"></i> 
<b><?=!empty($secilen_arac)?$secilen_arac[0]->arac_plaka:""?></b>
   plakalı araç için en son <b><?=(!empty($kasko_kayitlari) && count($kasko_kayitlari)>0) ? date("d.m.Y",strtotime($kasko_kayitlari[count($kasko_kayitlari)-1]->arac_kasko_baslangic_tarihi)) : "#"?></b> tarihinde kasko kaydı oluşturulmuştur. Kasko tarihinin sona ermesine <?=gunSayisiHesapla(date("d.m.Y"),date("d.m.Y",strtotime($kasko_kayitlari[count($kasko_kayitlari)-1]->arac_kasko_bitis_tarihi)))?> gün kalmıştır.</span>
 </div>
          </div>




          <table id="example1kasko" class="table text-xs table-bordered table-striped nowrap">
                  <thead>
                  <tr>
                    <th >Kasko Bilgileri</th>
                    <th style="max-width: 40px; width: 40px; min-width: 40px;">İşlem</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    foreach ($kasko_kayitlari as $kkayit) {
                     ?>
                      <tr>
                        <td><b>KASKO : </b> <?=date("d.m.Y",strtotime($kkayit->arac_kasko_baslangic_tarihi))?> / <?=date("d.m.Y",strtotime($kkayit->arac_kasko_bitis_tarihi))?> <b style="margin-left:7px;">KM : </b> <?=$kkayit->arac_kasko_guncel_km?></td>
                        <td>
                           <a type="button"   onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu kaydı silmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Onayla','<?=base_url('arac/kasko_sil/').$kkayit->arac_kasko_id?>');" class="btn btn-xs btn-danger"><i class="fas fa-times"></i> Sil</a>
                        </td>
                      </tr>
                     <?php
                    }
                    ?>
                  </tbody>
                 
                 </table>


                 <div class="btn-group " style="margin-left:2px;">
        
        <a type="button"  onclick="kayit_olustur('Kasko','kasko');" style="background:#ffffff;     color: green;   margin-left: 5px;" class="btn btn-success "><i class="fas fa-plus-circle"></i> Yeni Kasko Ekle</a>
         
        </div>

          </div>

        </div>
    </div>


</div>











<div class="col-md-4 <?=empty($secilen_arac) ? "d-none":""?>" style="padding: 0;padding-left:3px;">
    <div class="card card-dark <?=(!empty($filter) ? "d-none":"")?>" style="      margin-bottom: 5px;  border-radius: 0px; ">
          <div class="card-header with-border" style="   padding: 5px;  padding-right: 15px;   border-radius: 0px;background:#094a9b">
          <h3 class="card-title text-center" style="margin-top: 6px;">
          <i class="fas fa-tools"></i> ARAÇ MUAYENE İŞLEMLERİ
          </h3>
          
          </div>
          <div class="card-body" style="padding: 0;min-height: 365px;max-height: 365px;">



       
          <div class="row <?=empty($muayene_kayitlari)?"d-none":""?>">
          <div style="padding:5px;background: #2196f33d;color: #001aa1;margin-top: 0px;border: 2px solid #3F51B5;">
     <span style="font-size:15px!important;"><i class="fas fa-exclamation-circle" style="
    margin-right: 4px;
    color: #f50000;
"></i> 
<b><?=!empty($secilen_arac)?$secilen_arac[0]->arac_plaka:""?></b>
   plakalı araç için en son <b><?=(!empty($muayene_kayitlari) && count($muayene_kayitlari)>0) ? date("d.m.Y",strtotime($muayene_kayitlari[count($muayene_kayitlari)-1]->arac_muayene_baslangic_tarihi)) : "#"?></b> tarihinde muayene kaydı oluşturulmuştur. Muayene tarihinin sona ermesine <?=gunSayisiHesapla(date("d.m.Y"),date("d.m.Y",strtotime($muayene_kayitlari[count($muayene_kayitlari)-1]->arac_muayene_bitis_tarihi)))?> gün kalmıştır.</span>

   <?php 
   
   if(strtotime($muayene_kayitlari[count($muayene_kayitlari)-1]->arac_muayene_bitis_tarihi) < strtotime(date())){
  echo "SÜRE GEÇTİ";  
  }



   ?>
 </div>
          </div>




          <table id="example1muayene" class="table text-xs table-bordered table-striped nowrap">
                  <thead>
                  <tr>
                    <th >Muayene Bilgileri</th>
                    <th style="max-width: 40px; width: 40px; min-width: 40px;">İşlem</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    foreach ($muayene_kayitlari as $mkayit) {
                     ?>
                      <tr>
                        <td><b>MUAYENE : </b> <?=date("d.m.Y",strtotime($mkayit->arac_muayene_baslangic_tarihi))?> / <?=date("d.m.Y",strtotime($mkayit->arac_muayene_bitis_tarihi))?></td>
                        <td>
                           <a type="button"   onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu kaydı silmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Onayla','<?=base_url('arac/muayene_sil/').$mkayit->arac_muayene_id?>');" class="btn btn-xs btn-danger"><i class="fas fa-times"></i> Sil</a>
                        </td>
                      </tr>
                     <?php
                    }
                    ?>
                  </tbody>
                 
                 </table>


                 <div class="btn-group " style="margin-left:2px;">
        
        <a type="button"  onclick="kayit_olustur('Muayene','muayene');" style="background:#ffffff;     color: green;   margin-left: 5px;" class="btn btn-success "><i class="fas fa-plus-circle"></i> Yeni Muayene Ekle</a>
         
        </div>

          </div>

        </div>
    </div>


</div>









     
     


 


  </div>
</div>




 









 









 







 


        






       



  </section>
</div>




 <style>
  .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    color: #ffffff;
    background-color: #104cbd;
    border-color: #dee2e6 #dee2e6 #fff;
}
.table th {
    background: #ffffff !important;
    color: #174b85;
    padding: 12px;
    padding-left: 10px;
}
.form-control:disabled, .form-control[readonly] {
    background-color: #ffffff;
    opacity: 1;
}

.btn.disabled, .btn:disabled {
    opacity: .35;
    box-shadow: none;
}

.info-box-active{

background:#081f39!important;
color:white!important;
}
.info-box-active span{
 
color:white!important;
}
.info-box:hover{

  background:#081f39!important;
  color:white!important;
  
}
.info-box:hover span {
  color: white!important;
}
.dataTables_info{
  display:none;
}
.dataTables_empty{
  padding: 10px !important;
}


div:where(.swal2-container) .swal2-input {
  margin-top: 6px!important;
  margin-bottom:12px!important;
  height: 2.025em!important;
}
div:where(.swal2-container) .swal2-textarea {
  margin-top: 6px!important;
  margin-bottom:12px!important; 
}
.swal2-validation-message{
  margin: 30px;
    margin-top: 0px;
}
  </style>
 






 <script src="https://code.jquery.com/jquery-1.12.4.min.js"   integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="   crossorigin="anonymous"></script>




 
 <script>

function km_hareketlerini_goster() {
  
 var kmListesi = "<ul style='padding-left: 0;'>";
        <?php foreach ($arac_kmler as $km): ?>
            kmListesi += "<li style='list-style-type: none;'><b>Arac Km Deger:</b> <?php echo $km->arac_km_deger; ?><br> <?php echo $km->arac_km_aciklama; ?><br><br></li>";
        <?php endforeach; ?>
        kmListesi += "</ul>";

        
        Swal.fire({
            title: 'Km Verileri',
            html: kmListesi,
            icon: 'info',
            confirmButtonText: 'Tamam'
        });

}



function surucu_guncelle() {




Swal.fire({
      title: "Sürücüyü Güncelle",
      html: 'Sürücü<br><select id="surucu" style="max-width: 100%;" class="select2 swal2-input"><option value="0">Seçilmedi</option><?php foreach ($kullanicilar as $kullanici) {echo '<option value="'.$kullanici->kullanici_id.'" '.((!empty($secilen_arac) && $secilen_arac[0]->arac_surucu_id == $kullanici->kullanici_id)?"selected":"").'>'.$kullanici->kullanici_ad_soyad.'</option>';} ?></select>',
      icon: "question",
      showCancelButton: true,
      confirmButtonColor: "#098f23",
      confirmButtonText: "Tamam",
      cancelButtonText: "İptal",
      allowOutsideClick: false,
      showConfirmButton: true,
      
      preConfirm: () => {
       var surucu = document.getElementById('surucu').value;  

          if (!surucu) {
            Swal.showValidationMessage("Lütfen tüm zorunlu alanları doldurun");
              return false;
          } else {

          
              $.ajax({
                  type: "POST",
                  data: {
                      'arac_surucu_id': surucu
                  },
                  url: 'https://ugbusiness.com.tr/arac/arac_surucu_guncelle/<?=!empty($secilen_arac)?$secilen_arac[0]->arac_id:""?>',
                  success: function (data) {
                      location.reload();
                  },
                  error: function (data) {
                      Swal.fire("Hata", "İşlem sırasında bir hata oluştu", "error");
                  }
              });
            

          }

      }
  });  



  $('.select2').select2({
                            minimumResultsForSearch: 15,
                            width: '100%',
                            placeholder: "Seleziona",
                            language: "it"
                        });
}















function marka_model_guncelle() {




Swal.fire({
      title: "Bilgileri Güncelle",
      html: 'Marka<br><input id="marka" type="text" placeholder="Marka" value="<?=!empty($secilen_arac)?$secilen_arac[0]->arac_marka:""?>" style="max-width: 100%;" class="swal2-input">' +
      '<br>Model<br><input id="model" type="text" placeholder="Model" value="<?=!empty($secilen_arac)?$secilen_arac[0]->arac_model:""?>" style="max-width: 100%;" class="swal2-input">',
      icon: "question",
      showCancelButton: true,
      confirmButtonColor: "#098f23",
      confirmButtonText: "Tamam",
      cancelButtonText: "İptal",
      allowOutsideClick: false,
      showConfirmButton: true,
      preConfirm: () => {
       var marka = document.getElementById('marka').value; 
       var model = document.getElementById('model').value; 

          if (!marka || !model) {
            Swal.showValidationMessage("Lütfen tüm zorunlu alanları doldurun");
              return false;
          } else {

          
              $.ajax({
                  type: "POST",
                  data: {
                      'arac_marka': marka,
                      'arac_model': model,
                  },
                  url: 'https://ugbusiness.com.tr/arac/arac_model_guncelle/<?=!empty($secilen_arac)?$secilen_arac[0]->arac_id:""?>',
                  success: function (data) {
                      location.reload();
                  },
                  error: function (data) {
                      Swal.fire("Hata", "İşlem sırasında bir hata oluştu", "error");
                  }
              });
            

          }

      }
  });
}













function lastik_kayit_olustur() {




Swal.fire({
      title: "Lastik Kaydı Oluştur",
      html: 'Km Bilgisi<br><input id="kmlastik" type="number" placeholder="Km" style="max-width: 100%;" class="swal2-input">' +
          '<br>Açıklama (Opsiyonel)<br><textarea id="aciklamalastik" placeholder="Açıklama" class="swal2-textarea"></textarea>',
      icon: "question",
      showCancelButton: true,
      confirmButtonColor: "#098f23",
      confirmButtonText: "Tamam",
      cancelButtonText: "İptal",
      allowOutsideClick: false,
      showConfirmButton: true,
      preConfirm: () => {
       var kmlastik = document.getElementById('kmlastik').value;
       var aciklamalastik = document.getElementById('aciklamalastik').value;

          if (!kmlastik) {
            Swal.showValidationMessage("Lütfen tüm zorunlu alanları doldurun");
              return false;
          } else {

          
              $.ajax({
                  type: "POST",
                  data: {
                      'arac_lastik_km_deger': kmlastik,
                      'arac_lastik_aciklama': aciklamalastik,
                  },
                  url: 'https://ugbusiness.com.tr/arac/arac_lastik_kaydet/<?=!empty($secilen_arac)?$secilen_arac[0]->arac_id:""?>',
                  success: function (data) {
                      location.reload();
                  },
                  error: function (data) {
                      Swal.fire("Hata", "İşlem sırasında bir hata oluştu", "error");
                  }
              });
            

          }

      }
  });
}























function km_kayit_olustur() {




  Swal.fire({
        title: "Km Kaydı Oluştur",
        html: 'Yeni Km Bilgisi<br><input id="km1" type="number" placeholder="Km" style="max-width: 100%;" class="swal2-input">' +
            '<br>Açıklama (Opsiyonel)<br><textarea id="aciklama1" placeholder="Açıklama" class="swal2-textarea"></textarea>',
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#098f23",
        confirmButtonText: "Tamam",
        cancelButtonText: "İptal",
        allowOutsideClick: false,
        showConfirmButton: true,
        preConfirm: () => {
         var km = document.getElementById('km1').value;
         var aciklama = document.getElementById('aciklama1').value;

            if (!km) {
              Swal.showValidationMessage("Lütfen tüm zorunlu alanları doldurun");
                return false;
            } else {

            
                $.ajax({
                    type: "POST",
                    data: {
                        'arac_km_deger': km,
                        'arac_km_aciklama': aciklama,
                    },
                    url: 'https://ugbusiness.com.tr/arac/arac_km_kaydet/<?=!empty($secilen_arac)?$secilen_arac[0]->arac_id:""?>',
                    success: function (data) {
                        location.reload();
                    },
                    error: function (data) {
                        Swal.fire("Hata", "İşlem sırasında bir hata oluştu", "error");
                    }
                });
              

            }

        }
    });
}


   function kayit_olustur(baslik,slug) {

    var htmldata = "";
    if(slug == "bakim"){
      htmldata = baslik+' Başlangıç Tarihi<input id="baslangicTarihi" type="date" placeholder="Başlangıç Tarihi" class="swal2-input">' +
         'Güncel Km Bilgisi<br><input id="km" type="number" placeholder="Km" style="max-width: 100%;" class="swal2-input">' +
         'Sonraki Bakım Km<br><input id="bildirimkm" type="number" placeholder="Km" style="max-width: 100%;" class="swal2-input">' +
        
         '<br>Açıklama (Opsiyonel)<br><textarea id="aciklama" placeholder="Açıklama" class="swal2-textarea"></textarea>';
    }
    
    else if(slug == "muayene"){
      htmldata = baslik+' Başlangıç Tarihi<input id="baslangicTarihi" type="date" placeholder="Başlangıç Tarihi" class="swal2-input">' +
        baslik+' Bitiş Tarihi<input id="bitisTarihi" type="date" placeholder="Bitiş Tarihi" class="swal2-input">' +
             
            '<br>Açıklama (Opsiyonel)<br><textarea id="aciklama" placeholder="Açıklama" class="swal2-textarea"></textarea>';
 }else{
      htmldata = baslik+' Başlangıç Tarihi<input id="baslangicTarihi" type="date" placeholder="Başlangıç Tarihi" class="swal2-input">' +
        baslik+' Bitiş Tarihi<input id="bitisTarihi" type="date" placeholder="Bitiş Tarihi" class="swal2-input">' +
            'Güncel Km Bilgisi<br><input id="km" type="number" placeholder="Km" style="max-width: 100%;" class="swal2-input">' +
            '<br>Açıklama (Opsiyonel)<br><textarea id="aciklama" placeholder="Açıklama" class="swal2-textarea"></textarea>';

    } 


    Swal.fire({
        title: baslik+" Kaydı Oluştur",
        html: htmldata,
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#098f23",
        confirmButtonText: "Tamam",
        cancelButtonText: "İptal",
        allowOutsideClick: false,
        showConfirmButton: true,
        preConfirm: () => {
        
          var baslangicTarihi = document.getElementById('baslangicTarihi').value;
           
            var km = 0;
            if(document.getElementById('km') != null){
              km = document.getElementById('km').value;
            } 
            var aciklama = document.getElementById('aciklama').value;

            if (!baslangicTarihi || km == null) {
              Swal.showValidationMessage("Lütfen tüm zorunlu alanları doldurun");
                return false;
            }
            else {

              if(slug == "bakim"){
                var bildirimkm = document.getElementById('bildirimkm').value;
                $.ajax({
                    type: "POST",
                    data: {
                        'arac_bakim_baslangic_tarihi': baslangicTarihi, 
                        'arac_bakim_guncel_km': km,
                        'arac_sonraki_bakim_km': bildirimkm,
                        'arac_bakim_detay': aciklama,
                    },
                    url: 'https://ugbusiness.com.tr/arac/arac_bakim_kaydet/<?=!empty($secilen_arac)?$secilen_arac[0]->arac_id:""?>',
                    success: function (data) {
                        location.reload();
                    },
                    error: function (data) {
                        Swal.fire("Hata", "İşlem sırasında bir hata oluştu", "error");
                    }
                });
              }
              if(slug == "sigorta"){
                var bitisTarihi = document.getElementById('bitisTarihi').value;
                $.ajax({
                    type: "POST",
                    data: {
                        'arac_sigorta_baslangic_tarihi': baslangicTarihi,
                        'arac_sigorta_bitis_tarihi': bitisTarihi,
                        'arac_sigorta_guncel_km': km,
                        'arac_sigorta_detay': aciklama,
                    },
                    url: 'https://ugbusiness.com.tr/arac/arac_sigorta_kaydet/<?=!empty($secilen_arac)?$secilen_arac[0]->arac_id:""?>',
                    success: function (data) {
                        location.reload();
                    },
                    error: function (data) {
                        Swal.fire("Hata", "İşlem sırasında bir hata oluştu", "error");
                    }
                });
              }
              if(slug == "kasko"){
                var bitisTarihi = document.getElementById('bitisTarihi').value;
                $.ajax({
                    type: "POST",
                    data: {
                        'arac_kasko_baslangic_tarihi': baslangicTarihi,
                        'arac_kasko_bitis_tarihi': bitisTarihi,
                        'arac_kasko_guncel_km': km,
                        'arac_kasko_detay': aciklama,
                    },
                    url: 'https://ugbusiness.com.tr/arac/arac_kasko_kaydet/<?=!empty($secilen_arac)?$secilen_arac[0]->arac_id:""?>',
                    success: function (data) {
                        location.reload();
                    },
                    error: function (data) {
                        Swal.fire("Hata", "İşlem sırasında bir hata oluştu", "error");
                    }
                });
              }

              if(slug == "muayene"){
                var bitisTarihi = document.getElementById('bitisTarihi').value;
                $.ajax({
                    type: "POST",
                    data: {
                        'arac_muayene_baslangic_tarihi': baslangicTarihi,
                        'arac_muayene_bitis_tarihi': bitisTarihi, 
                        'arac_muayene_detay': aciklama,
                    },
                    url: 'https://ugbusiness.com.tr/arac/arac_muayene_kaydet/<?=!empty($secilen_arac)?$secilen_arac[0]->arac_id:""?>',
                    success: function (data) {
                        location.reload();
                    },
                    error: function (data) {
                      console.log(data);
                        Swal.fire("Hata", "İşlem sırasında bir hata oluştu", "error");
                    }
                });
              }

               
            }

        }
    });


  };



</script>


<style>
  .yanipsonenyazi {
      animation: blinker 0.6s linear infinite;
      color: red;
    
      font-weight: bold;
      font-family: sans-serif;
      }
      @keyframes blinker {  
      50% { opacity: 0; }
      }
      .select2-container--open {
    z-index: 99999999999999;
    }
  </style>
