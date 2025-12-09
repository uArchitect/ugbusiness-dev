<?php $this->load->view('talep/includes/styles'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper content-wrapper-siparis pt-2">
  <section class="content pr-0">
    <div class="row">
      <div class="col-12">
        <div class="card card-siparis">
          <!-- Card Header -->
          <div class="card-header card-header-siparis">
            <div class="d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3 card-header-icon-wrapper">
                  <i class="fas fa-plus card-header-icon"></i>
                </div>
                <div>
                  <h3 class="mb-0 card-header-title">
                    <?=!empty($talep) ? 'Talep Düzenle' : 'Yeni Talep Ekle'?> Restore
                  </h3>
                  <small class="card-header-subtitle">Talep yönetim modülleri</small>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Modern Tab Navigation Bar -->
          <?php $this->load->view('talep/includes/tabs'); ?>
          
          <!-- Card Body -->
          <div class="card-body card-body-siparis">
            <div class="card-body-content">
              <div class="row">
                <section class="content <?=(aktif_kullanici()->kullanici_id == 1 || aktif_kullanici()->kullanici_id == 9 || aktif_kullanici()->kullanici_id == 4 || aktif_kullanici()->kullanici_id == 6) ? "col-lg-4" : "col-lg-12" ?>">
                  <div class="card card-dark p-0">
                    <div class="card-header with-border">
                      <h3 class="card-title"> <i class="ion ion-person-stalker"></i> Talep Bilgileri</h3>
                    </div>

    <?php if(!empty($talep)){?>
            <form class="form-horizontal" onsubmit="submitFormWaiting()" method="POST" id="form_talep" action="<?php echo site_url('talep/save').'/'.$talep->talep_id;?>">
    <?php }else{?>
            <form class="form-horizontal" onsubmit="submitFormWaiting()" method="POST" id="form_talep" action="<?php echo site_url('talep/save');?>">
    <?php } ?>
    <div class="card-body" style="background:#ffffff;">
    <?php $kontrol = !goruntuleme_kontrol("talep_tum_kayitlar_goruntule");

    ?> 

      <!-- İletişim Bilgileri -->
      <div class="row mb-3">
        <div class="col-12 col-md-6">
          <div class="form-group mb-0">
            <label for="formClient-Name"><i class="fas fa-phone text-primary"></i> Cep Telefonu Numarası <span class="text-danger">*</span></label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-phone"></i></span>
              </div>
              <input type="text" <?=(aktif_kullanici()->kullanici_id == 1331 || aktif_kullanici()->kullanici_id == 1341) ? "" : "required"?> name="talep_cep_telefon" id="talep_cep_telefon" class="form-control" value="<?php echo  !empty($talep) ? $talep->talep_cep_telefon : '';?>" placeholder="0XXX XXX XX XX" data-inputmask="&quot;mask&quot;: &quot;0999 999 99 99&quot;" data-mask="" <?=(!empty($talep))?'':'onblur="validatePhoneNumber(this.value)"'?> inputmode="numeric">
              <div class="input-group-append">
                <button type="button" class="btn btn-outline-secondary" onclick="kopyalayiYapistir()" title="Panodan Yapıştır">
                  <i class="fas fa-paste"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <?php
        if(aktif_kullanici()->kullanici_id == 1 || aktif_kullanici()->kullanici_id == 4 || aktif_kullanici()->kullanici_id == 1331 || aktif_kullanici()->kullanici_id == 1341){
        ?>
        <div class="col-12 col-md-6">
          <div class="form-group mb-0">
            <label for="formClient-Name"><i class="fas fa-globe text-info"></i> Yabancı Numara</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-phone"></i></span>
              </div>
              <input type="text" name="talep_yurtdisi_telefon" id="talep_yurtdisi_telefon" class="form-control" value="<?php echo  !empty($talep) ? $talep->talep_yurtdisi_telefon : '';?>" placeholder="Yabancı Numara" inputmode="numeric">
            </div>
          </div>
        </div>
        <?php } ?>
      </div>

      <!-- Müşteri Bilgileri -->
      <div class="row mb-3">
        <div class="col-12 col-md-6">
          <div class="form-group mb-0">
            <label for="formClient-Name"><i class="fas fa-user text-success"></i> Müşteri Ad Soyad <span class="text-danger">*</span></label>
            <input type="text" value="<?php echo  !empty($talep) ? $talep->talep_musteri_ad_soyad : '';?>" class="form-control" name="talep_musteri_ad_soyad" required placeholder="Müşteri Ad Soyad Giriniz..." autofocus oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="form-group mb-0">
            <label for="formClient-Code"><i class="fas fa-building text-warning"></i> Merkez / İşletme Adı</label>
            <input type="text" value="<?php echo !empty($talep) ? $talep->talep_isletme_adi : '';?>" class="form-control" name="talep_isletme_adi" placeholder="İşletme Adını Giriniz..." oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
          </div>
        </div>
      </div>

      <!-- Talep Kaynak ve Konum Bilgileri -->
      <div class="row mb-3">
        <div class="col-12 col-md-6 col-lg-3 <?=$kontrol ? "d-none" : ""?>">
          <div class="form-group mb-0">
            <label for="formClient-Code"><i class="fas fa-source text-primary"></i> Talep Kaynak <span class="text-danger">*</span></label>
            <select name="talep_kaynak_no" <?=$kontrol ? "" : "required"?> class="select2 form-control" style="width: 100%;">
        <option value="">
                  Seçim Yapılmadı
                </option>
        <?php foreach($kaynaklar as $kaynak) : ?> 


          <?php 
          
          if(aktif_kullanici()->kullanici_id == 1 ){
            if(empty($talep)){
              ?> 
                <option  <?php echo  (empty($talep) && $kaynak->talep_kaynak_id == 1 && (aktif_kullanici()->kullanici_id == 1 || aktif_kullanici()->kullanici_id == 4)) ? 'selected="selected"'  : '' ?>
                data-icon="<?=$kaynak->talep_kaynak_resim?>"
                value="<?=$kaynak->talep_kaynak_id?>">
                  <?=$kaynak->talep_kaynak_adi?>
                </option>
              <?php
            }else{
              ?>
               <option  data-icon="<?=$kaynak->talep_kaynak_resim?>" value="<?=$kaynak->talep_kaynak_id?>"  <?php echo  ($talep->talep_kaynak_no == $kaynak->talep_kaynak_id) ? 'selected="selected"'  : '';?>><?=$kaynak->talep_kaynak_adi?></option>
            
              <?php
            }
          }else{
            if(empty($talep)){
              ?> 
                <option <?php echo  ($kaynak->talep_kaynak_id == 6) ? 'selected="selected"'  : '';?>
                data-icon="<?=$kaynak->talep_kaynak_resim?>"
                value="<?=$kaynak->talep_kaynak_id?>">
                  <?=$kaynak->talep_kaynak_adi?>
                </option>
              <?php
            }else{
              ?>
              <option  data-icon="<?=$kaynak->talep_kaynak_resim?>" value="<?=$kaynak->talep_kaynak_id?>"  <?php echo  ($talep->talep_kaynak_no == $kaynak->talep_kaynak_id) ? 'selected="selected"'  : '';?>><?=$kaynak->talep_kaynak_adi?></option>
           
             <?php
            }
          }
            ?>

       
          <?php endforeach; ?>  
                  </select>
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
          <div class="form-group mb-0">
            <label for="formClient-Code"><i class="fas fa-flag text-danger"></i> Ülke <span class="text-danger">*</span></label>
            <select name="ulke_id" required class="select2 form-control" style="width: 100%;">
            <option  value="">ÜLKE SEÇİLMEDİ</option>
            <?php foreach($ulkeler as $ulke) : ?> 

              <?php 
                if(empty($talep)){
                  ?>
                   <option  value="190" selected="selected">TÜRKİYE</option>
           
                  <?php 
                }else{
                  ?>
   <?php 
                if($talep->talep_ulke_id != 190){
                  ?>
                    <option  value="<?=$ulke->ulke_id?>" <?php echo  ((!empty($talep) && $talep->talep_ulke_id == $ulke->ulke_id) ? 'selected="selected"'  : "");?>><?=$ulke->ulke_adi?></option>
           
                  <?php
                }else{
                   ?>
                    <option  value="<?=$ulke->ulke_id?>" <?php echo (($ulke->ulke_id == 190)?'selected="selected"':"")?>><?=$ulke->ulke_adi?></option>
           
                  <?php
                }
                ?>

                  <?php
                }
                ?>

           
                 <?php endforeach; ?>  
            </select>
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
          <div class="form-group mb-0">
            <label for="formClient-Code"><i class="fas fa-city text-info"></i> Şehir <span class="text-danger">*</span></label>
            <select name="talep_sehir_no" <?=$kontrol ? "required " : ""?> id="talep_sehir_no" class="select2 form-control" style="width: 100%;">
       <option value="">Seçim Yapılmadı</option>
                  <?php foreach($sehirler as $sehir) : ?> 
                    <option  data-icon="fab fa-gg" value="<?=$sehir->sehir_id?>" <?php echo  (!empty($talep) && $talep->talep_sehir_no == $sehir->sehir_id) ? 'selected="selected"'  : '';?>><?=$sehir->sehir_adi?></option>
      
          <?php endforeach; ?>  
                  </select>
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
          <div class="form-group mb-0">
            <label for="formClient-Code"><i class="fas fa-map-marker-alt text-success"></i> İlçe <span class="text-danger">*</span></label>
            <div id="ilceler">
              <select name="talep_ilce_no" <?=$kontrol ? "required " : ""?> id="talep_ilce_no" class="select2 form-control" style="width: 100%;">
        <option value="">Seçim Yapılmadı</option>
        <?php foreach($ilceler as $ilce) : ?> 
                    <option  data-icon="fab fa-gg"  value="<?=$ilce->ilce_id?>"   <?php echo  (!empty($talep) && $talep->talep_ilce_no == $ilce->ilce_id) ? 'selected="selected"'  : '';?>><?=$ilce->ilce_adi?></option>
      
          <?php endforeach; ?>  
                  </select>


        </div>
        
                  
      </div>





</div>
      <input type="hidden" name="talep_id" id="talep_id" value="<?=!empty($talep_yonlendirme) && ($talep_yonlendirme != null) ? $talep_yonlendirme->talep_yonlendirme_id : 0?>">
      
      <!-- Cihaz Bilgileri -->
      <div class="row mb-3">
        <div class="col-12 col-md-6">
          <div class="form-group mb-0">
            <label for="formClient-Code"><i class="fas fa-mobile-alt text-primary"></i> İlgilendiği Cihaz <span class="text-danger">*</span></label>
            <select class="select2bs4" id="secilen_cihazlar" required name="secilen_cihazlar[]" multiple data-placeholder="Cihaz Seçimi Yapınız" style="width: 100%;">
    <?php foreach($urunler as $urun) : ?> 
        <?php
            $urun_id = $urun->urun_id;
            $selected = (!empty($talep) && is_array( json_decode($talep->talep_urun_id)) && in_array($urun_id, json_decode($talep->talep_urun_id))) ? 'selected="selected"' : '';
        ?>
        <option value="<?=$urun_id?>" <?=$selected?>><?=$urun->urun_adi?></option>
    <?php endforeach; ?> 
</select>
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="form-group mb-0">
            <label for="formClient-Code"><i class="fas fa-laptop text-warning"></i> Kullandığı Cihaz Bilgisi <span class="text-danger">*</span></label>
            <select name="talep_kullanilan_cihaz_id" required id="talep_kullanilan_cihaz_id" class="form-control" style="width: 100%;">
                  <option value="" >Seçim Yapılmadı</option>
                  <option  data-icon="fab fa-gg" value="18" <?php echo  (!empty($talep) && $talep->talep_kullanilan_cihaz_id == 18) ? 'selected="selected"'  : '';?>>Cihaz Kullanmıyor</option>
      
                  <?php foreach($markalar as $marka) : ?> 
                    <?php if($marka->marka_id == 18){continue;} ?> 
                    <option  data-icon="fab fa-gg" value="<?=$marka->marka_id?>" <?php echo  (empty($talep) && $marka->marka_id == 1 && (aktif_kullanici()->kullanici_id == 1 || aktif_kullanici()->kullanici_id == 4)) ? 'selected="selected"'  : '' ?> <?php echo  (!empty($talep) && $talep->talep_kullanilan_cihaz_id == $marka->marka_id) ? 'selected="selected"'  : '';?>><?=$marka->marka_adi?></option>
      
          <?php endforeach; ?>  
                  </select>
          </div>
        </div>
        <div class="col-12 col-md-6" id="marka_bilgi_div" style="display: none;">
          <div class="form-group mb-0">
            <label for="formClient-Name"><i class="fas fa-tag text-info"></i> Kullandığı Cihaz Marka Bilgisi</label>
            <input id="kullanici_cihaz_marka_aciklama" type="text" value="<?php echo  !empty($talep) ? $talep->talep_kullanilan_cihaz_aciklama : '';?>" class="form-control" name="talep_kullanilan_cihaz_aciklama" placeholder="Diğer Marka Adını Giriniz...">
          </div>
        </div>
      </div>
  


 <?php 
 
 if($this->session->userdata('aktif_kullanici_id') == 19 || $this->session->userdata('aktif_kullanici_id') == 5){
  ?>
      <div class="row mb-3">
        <div class="col-12 col-md-6">
          <div class="form-group mb-0">
            <label for="formClient-Code" class="text-danger"><i class="fas fa-ad text-danger"></i> Reklamlardan Gelen Talep Mi ? <span class="text-danger">*</span></label>
            <select name="talep_reklamlardan_gelen_mi" required id="talep_reklamlardan_gelen_mi" class="form-control" style="width: 100%;">
                  <option value="" >Seçim Yapılmadı</option>
                  <option value="1" <?php
                  
                  if(!empty($talep)){
                    if($talep->talep_reklamlardan_gelen_mi == 1){
                      echo "selected";
                    }
                  }?>>EVET</option>


 
                  <option value="0" <?php
                  
                  if(!empty($talep)){
                    if($talep->talep_reklamlardan_gelen_mi == 0){
                      echo "selected";
                    }
                  }?> >HAYIR</option>
                  
                  </select>
          </div>
        </div>
      </div>
  <?php
}

 
 ?>
     






      <!-- Sabit Telefon -->
      <div class="row mb-3">
        <div class="col-12 col-md-6 <?=(!empty($talep) && $talep->talep_sabit_telefon=='') ? "d-none" : ""?>">
          <div class="form-group mb-0">
            <label for="formClient-Name"><i class="fas fa-phone-alt text-secondary"></i> Sabit İletişim No</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-phone"></i></span>
              </div>
              <input type="text" name="talep_sabit_telefon" class="form-control" value="<?php echo  !empty($talep) ? $talep->talep_sabit_telefon : '';?>" placeholder="Müşteri Sabit Numarayı Giriniz" data-mask="" inputmode="text">
            </div>
          </div>
        </div>
      </div>







      <!-- Talep Uyarı Notu -->
      <div class="row mb-3">
        <div class="col-12">
          <div class="form-group mb-0">
            <label for="formClient-Name"><i class="fa fa-exclamation-triangle text-danger"></i> Talep Uyarı Notu</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text bg-danger text-white"><i class="fa fa-exclamation-triangle"></i></span>
              </div>
              <input style="background:#fff6f6;border:1px solid #f59797" type="text" value="<?php echo  !empty($talep) ? $talep->talep_uyari_notu : '';?>" class="form-control" name="talep_uyari_notu" id="talep_uyari_notu" placeholder="Talep Uyarı Notu Giriniz..." autofocus="">
            </div>
            <div class="btn-group mt-2 w-100" role="group">
              <button type="button" class="btn btn-sm btn-outline-success" onclick="document.getElementById('talep_uyari_notu').value='Müşteri sadece WhatsApp üzerinden iletişime geçilmesini talep etmiştir.';"><i class="fab fa-whatsapp"></i> <span class="d-none d-md-inline">Whatsapp</span></button> 
              <button type="button" class="btn btn-sm btn-outline-primary" onclick="document.getElementById('talep_uyari_notu').value='Müşteri sadece SMS üzerinden iletişime geçilmesini talep etmiştir.';"><i class="fa fa-sms"></i> <span class="d-none d-md-inline">SMS</span></button>
              <button type="button" class="btn btn-sm btn-outline-danger" onclick="document.getElementById('talep_uyari_notu').value='Müşteri 00:00 ile 18:00 saatleri arasında iletişime geçilmesini talep etmiştir.';"><i class="fas fa-clock"></i> <span class="d-none d-md-inline">Saat</span></button>
              <button type="button" class="btn btn-sm btn-outline-warning" onclick="document.getElementById('talep_uyari_notu').value='Bu talep YABANCI / YURTDIŞI müşterisi tarafından oluşturulmuştur.';"><i class="fa fa-user"></i> <span class="d-none d-md-inline">Yabancı</span></button>
            </div>
          </div>
        </div>
      </div>



 
 
     
<div class="card card-dark" style="<?=(!empty($talep_yonlendirme)) ? "":"display:none;"?>">
    <div class="card-header p-2 pl-3 bg-warning with-border">
      <h3 class="card-title text-bold" style="font-size:14px">
      <i class="nav-icon 	fas fa-power-off text-dark" style="font-size:13px"></i>
      TALEBİ SONLANDIR / BİTİR</h3>
    </div>
  
    <div class="card-body " style="background:#fff8e8;border: 4px dashed #fabf49;border-top:0px">
        
  







<div class="form-group"> 
  
<label for="formClient-Code " style="font-weight:normal">Son Güncelleme : <b><?=date('d.m.Y H:i',strtotime($talep_yonlendirme->gorusme_sonuc_guncelleme_tarihi));?></b></label> 

<br>
        <label for="formClient-Code " style="font-weight:normal">Görüşme Sonucu</label>
        
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
       <select name="gorusme_sonuc_no" id="gorusme_sonuc_no" onchange="toggleDiv()"   class="select2 form-control rounded-2" style="width: 100%;">
        <?php foreach($talep_sonuclar as $sonuc) : ?> 
                    <option  value="<?=$sonuc->talep_sonuc_id?>" <?php if(!empty($talep_yonlendirme) && $talep_yonlendirme->gorusme_sonuc_no == $sonuc->talep_sonuc_id){echo 'selected="selected"';}?>><?=$sonuc->talep_sonuc_adi?></option>
      
          <?php endforeach; ?>  
                  </select>
                
      </div>


      <div class="form-group" id="gorusme_detay">
        <label for="formClient-Code" style="font-weight:normal"> Görüşme Puanı </label>
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <select name="gorusme_puan" id="gorusme_puan"   class="select2 form-control rounded-2" style="width: 100%;">
        <?php for ($i=1; $i <= 10 ; $i++) { 
          ?>
          
          <option  value="<?=$i?>" <?php if(!empty($talep_yonlendirme) && $talep_yonlendirme->gorusme_puan == $i){echo 'selected="selected"';}?>><?=$i?></option>
      

          <?php
        }
                      ?>
                  </select>   </div>



                  
      <div class="form-group" id="gorusme_detay">
        <label for="formClient-Code" style="font-weight:normal"> Talep Görüşme Türü </label>
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <select name="rut_gorusmesi_mi" id="rut_gorusmesi_mi" <?=(!empty($talep_yonlendirme)) ? "required":""?>   class="select2 form-control rounded-2" style="width: 100%;">
        <option  value="">Seçim Yapılmadı</option>
         
        <option  value="0" <?php if(!empty($talep_yonlendirme) && $talep_yonlendirme->rut_gorusmesi_mi == "0"){echo 'selected="selected"';}?>>Normal Talep / Görüşme</option>
          <option  value="1" <?php if(!empty($talep_yonlendirme) && $talep_yonlendirme->rut_gorusmesi_mi == "1"){echo 'selected="selected"';}?>>Rut Görüşmesi</option>
     
        </select>

      </div>

      
 <div class="form-group" id="gorusme_detay">
        <label for="formClient-Code" style="font-weight:normal"> Görüşmeyi Detayları </label>
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <textarea <?php if(!empty($talep_yonlendirme)){echo "required";}?> name="gorusme_detay" class="form-control" minlength = "20" ><?php if(!empty($talep_yonlendirme)){echo $talep_yonlendirme->gorusme_detay;}?></textarea>
      </div>

 
  
  
  </div>
 
  </div>


      
 
  
  
 









    </div>
    <!-- /.card-body -->

    <div class="card-footer" style="background:#e9e9e9;">
      <div class="row">
        <div class="col"><a href="<?=base_url("bekleyen-talepler")?>"  class="btn btn-danger"><i class="ion ion-close-circled"></i> İptal</a>
        <button type="submit" class="btn  btn-success"><i class="ion ion-checkmark-circled"></i> Bilgileri Kaydet</button></div>
      </div>
    </div>
    <!-- /.card-footer-->

    </form>
  </div>
            <!-- /.card -->
</section>



















<section class="content col-lg-8 <?=!empty($talep) ? "":"d-none"?>">
 

<div class="card card-dark <?=(aktif_kullanici()->kullanici_id == 1 || aktif_kullanici()->kullanici_id == 9 || aktif_kullanici()->kullanici_id == 4 || aktif_kullanici()->kullanici_id == 6) ? "" : "d-none"?>">
    <div class="card-header with-border">
      <h3 class="card-title"> <i class="ion ion-shuffle"></i> Yönlendirme Bilgileri</h3>
    </div>
  
    <div class="card-body p-0 ">
         
  
  
    <table id="exampleyonlendirmeler" class="table table-bordered table-striped nowrap">
                  <thead>
                  <tr>
                  <th>Süre Koruması</th>
                    <th>Yönlendirilen</th>
                    <th>Yönlendiren Kullanıcı</th>
                    <th>Görüşme Sonucu</th>
                    <th  >Tarih</th> 
                  </tr>
                  </thead>
                  <tbody>

                  <?php ?>
                    <?php $count=0; foreach ($yonlendirmeler as $talep) : ?>
                    <?php 
                      if($talep->yonlenen_kullanici_id == $talep->yonlendiren_kullanici_id){
                        $background = "#e7ffca";
                        $color="#108d15";
                        $message = "<br>*Kullanıcı Girişi";
                      }else{
                        $background = "";
                        $color = "#bfbfbf";
                        $message = "<br>*Yönlendirme";
                      }
                      ?>
                    <tr style="background:<?=$background?>;">
                    <td><a class="btn btn-danger mr-2" href="<?=base_url("talep/ucguncikar/$talep->talep_yonlendirme_id")?>">-3 Gün</a><a class="btn btn-success" href="<?=base_url("talep/ucgunekle/$talep->talep_yonlendirme_id")?>">+3 Gün</a> </td>
                     
                      <td><i class="fa fa-user" style="font-size:13px"></i>    <?=$talep->yonlenen_ad_soyad?><span style="color:<?=$color?>"> <?=$message?></span> </td>
                      <td><i class="fa fa-arrow-circle-right" style="font-size:13px"></i>    <?=$talep->yonlendiren_ad_soyad?> </td>  
                      <td><i class="far fa-calendar-plus" style="margin-right:5px;opacity:1"></i> <?=$talep->talep_sonuc_adi?>
                      <br><span><?=$talep->gorusme_detay?></span>
                      </td>
                     
                    
                      <td><i class="far fa-calendar-plus" style="margin-right:5px;opacity:1"></i> <?=date('d.m.Y H:i',strtotime($talep->yonlendirme_tarihi));?>
                    
                      <?php
$bitis_tarihi = strtotime($talep->yonlendirme_tarihi . ' +3 days');
$simdiki_tarih = time(); // Şu anki tarih ve saat

// Tarih farkını gün cinsinden hesapla
$kalan_gun = ceil(($bitis_tarihi - $simdiki_tarih) / (60 * 60 * 24)); 
?>
<br><?=$kalan_gun>0 ? "<span class='text-success'>".$kalan_gun." gün korumalı</span>" : "<span class='text-danger'>Koruma Aktif Değil</span>"?>
                    
                    </td>
                    
                     
                    </tr>
                  <?php  endforeach; ?>
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>Süre Koruması</th>
                  <th>Yönlendirilen</th>
                    <th>Yönlendiren Kullanıcı</th>
                    <th>Görüşme Sonucu</th>
                    <th style="width: 130px;">Yönlendirme Tarih</th>  
                  </tr>
                  </tfoot>
                </table>
  
  
  
  
  </div>


    <div class="card-footer">
       
    </div>
  </div>
            <!-- /.card -->
                </section>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>






</div>




            </div>



<style>
.card-dark:not(.card-outline)>.card-header a.active {
    /* color: #ffffff; */
    color: black;
}

</style>








<script src="https://code.jquery.com/jquery-1.12.4.min.js"   integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="   crossorigin="anonymous"></script>

	

<script>
    
    function validatePhoneNumber(urun_id) {
     
      /*
      $.post('<?=base_url("talep/numara_kontrol/")?>'+urun_id, {}, function(result){
       
        if ( result && result.status != 'error' )
        {
        
           
        }
        else
        {
          Swal.fire({
                title: "Sistem Uyarısı",
                icon: "error",
                html: urun_id+"nolu iletişim bilgisiyle oluşturulmuş ve 3 günlük görüşme sürecinde olan bir kayıt bulunmaktadır. 3 gün içinde tekrar talep kaydı oluşturulamaz.",
                showCancelButton: true,
                allowOutsideClick: true,
                showConfirmButton: false
              });

              document.getElementById("talep_cep_telefon").value = "";
        
        }					
      });*/

}

		$(document).ready(function(){

    
 












      	$('#form_talep').on('submit', function(e){
     
          Swal.fire({
          title: ' <i class="fa fa-spinner rotating"  style="color: #343639; font-size:49px; margin-bottom:10px"></i><br>Lütfen Bekleyiniz!',
          html: "İşlem gerçekleştiriliyor...",
          timer: 2500,
          icon: '  <i class="fa fa-spinner rotating"  style="color: #ffffff; font-size:49px; margin-bottom:10px"></i>',
          timerProgressBar: true,
          showCancelButton: false,
          closeOnClickOutside: false,
          showConfirmButton: false
        });

        });


      
       

			$('#talep_sehir_no').on('change', function(e){
     
				var il_id = $(this).val();
      
				$.post('<?=base_url("ilce/get_ilceler/")?>'+il_id, {}, function(result){
         
 
					if ( result && result.status != 'error' )
					{
          
						var ilceler = result.data;
						var select = '<select name="talep_ilce_no" id="talep_ilce_no" class="select12 form-control rounded-0">';
						for( var i = 0; i < ilceler.length; i++)
						{
							select += '<option value="'+ ilceler[i].id +'">'+ ilceler[i].ilce +'</option>';
						}
						select += '</select>';
						$('#ilceler').empty().html(select);
             
           $('.select12').select2();
					}
					else
					{
						alert('Hata : ' + result.message );
					}					
				});
			});
		});

	</script>
 

<script>
$(document).ready(function(){
        <?php if($this->session->flashdata('flashDanger') != ""){ ?>
          Swal.fire({
              title: "Sistem Uyarısı",
              text: "<?=$this->session->flashdata('flashDanger')?>",
              icon: "error",
              confirmButtonColor: "red", 
          confirmButtonText: "TAMAM"
            });

 <?php } ?>
          });


          function kopyalayiYapistir() {
     
    var kopyalanmisMetin = navigator.clipboard.readText().then(function(clipText) {
  
        var temizMetin = clipText.replace("+9", "");
       
        if (temizMetin.substring(0, 1) !== "0") {
            temizMetin = "0" + temizMetin;
        }
     
        document.getElementById("talep_cep_telefon").value = temizMetin;    
        
        const up_names = document.getElementsByName("talep_musteri_ad_soyad");
       // up_names[0].focus();
    });
}
        </script>

 


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
 
 

  $('#talep_kullanilan_cihaz_id').on('change', function(e) {
    var selectBox = document.getElementById("talep_kullanilan_cihaz_id");
    var markaBilgiDiv = document.getElementById("marka_bilgi_div");

    if (selectBox.value == "2") {
        markaBilgiDiv.style.display = "block";
        document.getElementById("kullanici_cihaz_marka_aciklama").setAttribute("required", "");
    } else {
        markaBilgiDiv.style.display = "none";
        document.getElementById("kullanici_cihaz_marka_aciklama").removeAttribute("required");
    }
});

 
</script>