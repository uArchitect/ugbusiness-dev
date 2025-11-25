<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top: 25px; background-color: #f8f9fa;">
  <div class="row">
    <section class="content pr-0 <?=(aktif_kullanici()->kullanici_id == 1 || aktif_kullanici()->kullanici_id == 9 || aktif_kullanici()->kullanici_id == 4 || aktif_kullanici()->kullanici_id == 6) ? "col-lg-4" : "col-lg-12" ?>" >
      <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
        <!-- Card Header -->
        <div class="card-header border-0" style="background: linear-gradient(135deg, #001657 0%, #001657 100%); padding: 18px 25px;">
          <div class="d-flex align-items-center justify-content-between flex-wrap">
            <div class="d-flex align-items-center">
              <div class="rounded-circle d-flex align-items-center justify-content-center mr-3" style="width: 40px; height: 40px; background-color: rgba(255,255,255,0.2);">
                <i class="fas fa-clipboard-list" style="color: #ffffff; font-size: 18px;"></i>
              </div>
              <div>
                <h3 class="mb-0" style="color: #ffffff; font-weight: 700; font-size: 20px; letter-spacing: 0.5px; line-height: 1.2;">
                  <?=!empty($talep) ? 'Talep Düzenle' : 'Yeni Talep Ekle'?>
                </h3>
                <small style="color: rgba(255,255,255,0.9); font-size: 13px; line-height: 1.4;"><?=!empty($talep) ? 'Talep bilgilerini güncelleyin' : 'Yeni talep kaydı oluşturun'?></small>
              </div>
            </div>
            <a href="<?=base_url("bekleyen-talepler")?>" class="btn btn-light btn-sm shadow-sm mt-2 mt-md-0" style="border-radius: 8px; font-weight: 600;">
              <i class="fas fa-arrow-left"></i> Listeye Dön
            </a>
          </div>
        </div>

    <?php if(!empty($talep)){?>
            <form class="form-horizontal" onsubmit="submitFormWaiting()" method="POST" id="form_talep" action="<?php echo site_url('talep/save').'/'.$talep->talep_id;?>">
    <?php }else{?>
            <form class="form-horizontal" onsubmit="submitFormWaiting()" method="POST" id="form_talep" action="<?php echo site_url('talep/save');?>">
    <?php } ?>
        <!-- Card Body -->
        <div class="card-body" style="padding: 30px; background-color: #ffffff;">
    <?php $kontrol = !goruntuleme_kontrol("talep_tum_kayitlar_goruntule");

    ?> 

      <div class="row">
         
          <div class="form-group-modern mb-4">
            <label for="talep_cep_telefon" class="form-label-modern">
              <i class="fas fa-phone text-primary mr-2"></i>
              Cep Telefonu Numarası <span class="text-danger">*</span>
            </label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" style="border: 2px solid #e0e0e0; border-right: none; border-radius: 8px 0 0 8px; background-color: #f8f9fa;">
                  <i class="fas fa-phone"></i>
                </span>
              </div>
              <input type="text" <?=(aktif_kullanici()->kullanici_id == 1331 || aktif_kullanici()->kullanici_id == 1341) ? "" : "required"?> name="talep_cep_telefon" id="talep_cep_telefon" class="form-control form-control-modern" value="<?php echo  !empty($talep) ? $talep->talep_cep_telefon : '';?>" placeholder="Müşteri Cep Numarasını Giriniz" data-inputmask="&quot;mask&quot;: &quot;0999 999 99 99&quot;" data-mask="" <?=(!empty($talep))?'':'onblur="validatePhoneNumber(this.value)"'?> inputmode="numeric" style="border-left: none; border-radius: 0 8px 8px 0;">
              <div class="input-group-append">
                <button type="button" onclick="kopyalayiYapistir()" class="btn btn-outline-secondary" style="border-radius: 0 8px 8px 0; border-left: none;">
                  <i class="fas fa-paste"></i> Panodan Yapıştır
                </button>
              </div>
            </div>
            <small class="form-text text-muted">
              <i class="fas fa-info-circle"></i> Müşteri cep telefon numarasını giriniz
            </small>
          </div> 
      <?php
      if(aktif_kullanici()->kullanici_id == 1 || aktif_kullanici()->kullanici_id == 4 || aktif_kullanici()->kullanici_id == 1331 || aktif_kullanici()->kullanici_id == 1341){
?>
          <div class="form-group-modern mb-4">
            <label for="talep_yurtdisi_telefon" class="form-label-modern">
              <i class="fas fa-globe text-primary mr-2"></i>
              Yabancı Numara
            </label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" style="border: 2px solid #e0e0e0; border-right: none; border-radius: 8px 0 0 8px; background-color: #f8f9fa;">
                  <i class="fas fa-phone"></i>
                </span>
              </div>
              <input type="text" name="talep_yurtdisi_telefon" id="talep_yurtdisi_telefon" class="form-control form-control-modern" value="<?php echo  !empty($talep) ? $talep->talep_yurtdisi_telefon : '';?>" placeholder="Müşteri Yabancı No Giriniz" inputmode="numeric" style="border-left: none; border-radius: 0 8px 8px 0;">
            </div>
            <small class="form-text text-muted">
              <i class="fas fa-info-circle"></i> Yurtdışı müşteriler için telefon numarası (isteğe bağlı)
            </small>
          </div>
<?php
      }
      
      ?>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group-modern mb-4">
                <label for="talep_musteri_ad_soyad" class="form-label-modern">
                  <i class="fas fa-user text-primary mr-2"></i>
                  Müşteri Ad Soyad <span class="text-danger">*</span>
                </label>
                <input type="text" value="<?php echo  !empty($talep) ? $talep->talep_musteri_ad_soyad : '';?>" class="form-control form-control-modern" name="talep_musteri_ad_soyad" required placeholder="Müşteri Ad Soyad Giriniz..." autofocus oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
                <small class="form-text text-muted">
                  <i class="fas fa-info-circle"></i> Müşterinin tam adını ve soyadını giriniz
                </small>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group-modern mb-4">
                <label for="talep_isletme_adi" class="form-label-modern">
                  <i class="fas fa-building text-primary mr-2"></i>
                  Merkez / İşletme Adı
                </label>
                <input type="text" value="<?php echo !empty($talep) ? $talep->talep_isletme_adi : '';?>" class="form-control form-control-modern" name="talep_isletme_adi" placeholder="İşletme Adını Giriniz..." oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
                <small class="form-text text-muted">
                  <i class="fas fa-info-circle"></i> İşletme veya merkez adı (isteğe bağlı)
                </small>
              </div>
            </div>
          </div>

          </div>

          <div class="row">



          <div class="form-group-modern mb-4 <?=$kontrol ? "d-none" : ""?>">
            <label for="talep_kaynak_no" class="form-label-modern">
              <i class="fas fa-source text-primary mr-2"></i>
              Talep Kaynak <span class="text-danger">*</span>
            </label>
            <select name="talep_kaynak_no" <?=$kontrol ? "" : "required"?> class="select2 form-control form-control-modern" style="width: 100%;">
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
            <small class="form-text text-muted">
              <i class="fas fa-info-circle"></i> Talebin kaynağını seçiniz
            </small>
          </div>

          <div class="row">
            <div class="col-md-4">
              <div class="form-group-modern mb-4">
                <label for="ulke_id" class="form-label-modern">
                  <i class="fas fa-globe text-primary mr-2"></i>
                  Ülke <span class="text-danger">*</span>
                </label>
                <select name="ulke_id" required class="select2 form-control form-control-modern">
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
                <small class="form-text text-muted">
                  <i class="fas fa-info-circle"></i> Müşterinin bulunduğu ülkeyi seçiniz
                </small>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group-modern mb-4">
                <label for="talep_sehir_no" class="form-label-modern">
                  <i class="fas fa-map-marker-alt text-primary mr-2"></i>
                  Şehir <span class="text-danger">*</span>
                </label>
                <select name="talep_sehir_no" <?=$kontrol ? "required " : ""?> id="talep_sehir_no" class="select2 form-control form-control-modern" style="width: 100%;">
       <option value="">Seçim Yapılmadı</option>
                  <?php foreach($sehirler as $sehir) : ?> 
                    <option  data-icon="fab fa-gg" value="<?=$sehir->sehir_id?>" <?php echo  (!empty($talep) && $talep->talep_sehir_no == $sehir->sehir_id) ? 'selected="selected"'  : '';?>><?=$sehir->sehir_adi?></option>
      
          <?php endforeach; ?>  
                </select>
                <small class="form-text text-muted">
                  <i class="fas fa-info-circle"></i> Müşterinin bulunduğu şehri seçiniz
                </small>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group-modern mb-4">
                <label for="talep_ilce_no" class="form-label-modern">
                  <i class="fas fa-map-marked-alt text-primary mr-2"></i>
                  İlçe <span class="text-danger">*</span>
                </label>
                <div id="ilceler">
                  <select name="talep_ilce_no" <?=$kontrol ? "required " : ""?> id="talep_ilce_no" class="select2 form-control form-control-modern" style="width: 100%;">
        <option value="">Seçim Yapılmadı</option>
        <?php foreach($ilceler as $ilce) : ?> 
                    <option  data-icon="fab fa-gg"  value="<?=$ilce->ilce_id?>"   <?php echo  (!empty($talep) && $talep->talep_ilce_no == $ilce->ilce_id) ? 'selected="selected"'  : '';?>><?=$ilce->ilce_adi?></option>
      
          <?php endforeach; ?>  
                  </select>
                </div>
                <small class="form-text text-muted">
                  <i class="fas fa-info-circle"></i> Müşterinin bulunduğu ilçeyi seçiniz
                </small>
              </div>
            </div>
          </div>





</div>
<input type="hidden" name="talep_id" id="talep_id" value="<?=!empty($talep_yonlendirme) && ($talep_yonlendirme != null) ? $talep_yonlendirme->talep_yonlendirme_id : 0?>">
          <div class="form-group-modern mb-4">
            <label for="secilen_cihazlar" class="form-label-modern">
              <i class="fas fa-mobile-alt text-primary mr-2"></i>
              İlgilendiği Cihaz <span class="text-danger">*</span>
            </label>
            <select class="select2bs4 form-control-modern" id="secilen_cihazlar" required name="secilen_cihazlar[]" multiple data-placeholder="Cihaz Seçimi Yapınız" style="width: 100%;">
    <?php foreach($urunler as $urun) : ?> 
        <?php
            $urun_id = $urun->urun_id;
            $selected = (!empty($talep) && is_array( json_decode($talep->talep_urun_id)) && in_array($urun_id, json_decode($talep->talep_urun_id))) ? 'selected="selected"' : '';
        ?>
        <option value="<?=$urun_id?>" <?=$selected?>><?=$urun->urun_adi?></option>
    <?php endforeach; ?> 
            </select>
            <small class="form-text text-muted">
              <i class="fas fa-info-circle"></i> Müşterinin ilgilendiği cihazları seçiniz (birden fazla seçim yapabilirsiniz)
            </small>
          </div>

          <div class="form-group-modern mb-4">
            <label for="talep_kullanilan_cihaz_id" class="form-label-modern">
              <i class="fas fa-laptop text-primary mr-2"></i>
              Kullandığı Cihaz Bilgisi <span class="text-danger">*</span>
            </label>
            <select name="talep_kullanilan_cihaz_id" required id="talep_kullanilan_cihaz_id" class="form-control form-control-modern" style="width: 100%;">
                  <option value="" >Seçim Yapılmadı</option>
                  <option  data-icon="fab fa-gg" value="18" <?php echo  (!empty($talep) && $talep->talep_kullanilan_cihaz_id == 18) ? 'selected="selected"'  : '';?>>Cihaz Kullanmıyor</option>
      
                  <?php foreach($markalar as $marka) : ?> 
                    <?php if($marka->marka_id == 18){continue;} ?> 
                    <option  data-icon="fab fa-gg" value="<?=$marka->marka_id?>" <?php echo  (empty($talep) && $marka->marka_id == 1 && (aktif_kullanici()->kullanici_id == 1 || aktif_kullanici()->kullanici_id == 4)) ? 'selected="selected"'  : '' ?> <?php echo  (!empty($talep) && $talep->talep_kullanilan_cihaz_id == $marka->marka_id) ? 'selected="selected"'  : '';?>><?=$marka->marka_adi?></option>
      
          <?php endforeach; ?>  
                  </select>
            <small class="form-text text-muted">
              <i class="fas fa-info-circle"></i> Müşterinin kullandığı cihaz markasını seçiniz
            </small>
          </div>

          <div class="form-group-modern mb-4" id="marka_bilgi_div" style="display: none;">
            <label for="kullanici_cihaz_marka_aciklama" class="form-label-modern">
              <i class="fas fa-tag text-primary mr-2"></i>
              Kullandığı Cihaz Marka Bilgisi
            </label>
            <input id="kullanici_cihaz_marka_aciklama" type="text" value="<?php echo  !empty($talep) ? $talep->talep_kullanilan_cihaz_aciklama : '';?>" class="form-control form-control-modern" name="talep_kullanilan_cihaz_aciklama" placeholder="Diğer Marka Adını Giriniz...">
            <small class="form-text text-muted">
              <i class="fas fa-info-circle"></i> Diğer marka seçildiğinde marka adını giriniz
            </small>
          </div>
  


 <?php 
 
 if($this->session->userdata('aktif_kullanici_id') == 19 || $this->session->userdata('aktif_kullanici_id') == 5){
  ?>
   <div class="form-group-modern mb-4">
        <label for="talep_reklamlardan_gelen_mi" class="form-label-modern">
          <i class="fas fa-ad text-danger mr-2"></i>
          Reklamlardan Gelen Talep Mi ? <span class="text-danger">*</span>
        </label>
        <select name="talep_reklamlardan_gelen_mi" required id="talep_reklamlardan_gelen_mi" class="form-control form-control-modern" style="width: 100%;">
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
        <small class="form-text text-muted">
          <i class="fas fa-info-circle"></i> Talep reklamlardan mı geldi?
        </small>
      </div>
               
  <?php
} 

 
 ?>
     






          <div class="row">
            <div class="col-md-6 <?=(!empty($talep) && $talep->talep_sabit_telefon=='') ? "d-none" : ""?>">
              <div class="form-group-modern mb-4">
                <label for="talep_sabit_telefon" class="form-label-modern">
                  <i class="fas fa-phone-alt text-primary mr-2"></i>
                  Sabit İletişim No
                </label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" style="border: 2px solid #e0e0e0; border-right: none; border-radius: 8px 0 0 8px; background-color: #f8f9fa;">
                      <i class="fas fa-phone"></i>
                    </span>
                  </div>
                  <input type="text" name="talep_sabit_telefon" class="form-control form-control-modern" value="<?php echo  !empty($talep) ? $talep->talep_sabit_telefon : '';?>" placeholder="Müşteri Sabit Numarayı Giriniz" data-mask="" inputmode="text" style="border-left: none; border-radius: 0 8px 8px 0;">
                </div>
                <small class="form-text text-muted">
                  <i class="fas fa-info-circle"></i> Müşterinin sabit telefon numarası (isteğe bağlı)
                </small>
              </div>
            </div>
          </div>







          <div class="form-group-modern mb-4">
            <label for="talep_uyari_notu" class="form-label-modern">
              <i class="fa fa-exclamation-triangle text-danger mr-2"></i>
              Talep Uyarı Notu
            </label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" style="border: 2px solid #f59797; border-right: none; border-radius: 8px 0 0 8px; background-color: #fff6f6;">
                  <i class="fa fa-exclamation-triangle text-danger"></i>
                </span>
              </div>
              <input type="text" value="<?php echo  !empty($talep) ? $talep->talep_uyari_notu : '';?>" class="form-control form-control-modern" name="talep_uyari_notu" id="talep_uyari_notu" placeholder="Talep Uyarı Notu Giriniz..." style="border-left: none; border-radius: 0 8px 8px 0; background:#fff6f6;border:2px solid #f59797;">
            </div>
            <div class="mt-2">
              <div class="btn-group btn-group-sm" role="group" style="width: 100%; flex-wrap: wrap;">
                <button type="button" class="btn btn-outline-success mb-1" onclick="document.getElementById('talep_uyari_notu').value='Müşteri sadece WhatsApp üzerinden iletişime geçilmesini talep etmiştir.';" style="flex: 1; min-width: 150px;">
                  <i class="fab fa-whatsapp"></i> Whatsapp Uyarı
                </button> 
                <button type="button" class="btn btn-outline-primary mb-1" onclick="document.getElementById('talep_uyari_notu').value='Müşteri sadece SMS üzerinden iletişime geçilmesini talep etmiştir.';" style="flex: 1; min-width: 150px;">
                  <i class="fa fa-sms"></i> SMS Uyarı
                </button>
                <button type="button" class="btn btn-outline-danger mb-1" onclick="document.getElementById('talep_uyari_notu').value='Müşteri 00:00 ile 18:00 saatleri arasında iletişime geçilmesini talep etmiştir.';" style="flex: 1; min-width: 150px;">
                  <i class="fas fa-clock"></i> Saat Uyarı
                </button>
                <button type="button" class="btn btn-outline-warning mb-1" onclick="document.getElementById('talep_uyari_notu').value='Bu talep YABANCI / YURTDIŞI müşterisi tarafından oluşturulmuştur.';" style="flex: 1; min-width: 150px;">
                  <i class="fa fa-user"></i> Yabancı Müşteri
                </button>
              </div>
            </div>
            <small class="form-text text-muted">
              <i class="fas fa-info-circle"></i> Müşteri için özel uyarı notu ekleyebilirsiniz
            </small>
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

        <!-- Butonlar -->
        <div class="form-actions-modern d-flex justify-content-between align-items-center pt-3 border-top">
          <a href="<?=base_url("bekleyen-talepler")?>" class="btn btn-secondary-modern">
            <i class="fas fa-times"></i> İptal
          </a>
          <button type="submit" class="btn btn-primary-modern">
            <i class="fas fa-save"></i> Bilgileri Kaydet
          </button>
        </div>
      </div>
    </div>

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

         
            <!-- /.card -->
</section>






</div>




            </div>



<style>
  /* Modern Form Stilleri */
  .form-group-modern {
    margin-bottom: 1.5rem;
  }

  .form-label-modern {
    display: block;
    font-weight: 600;
    color: #495057;
    margin-bottom: 0.5rem;
    font-size: 14px;
    letter-spacing: 0.3px;
  }

  .form-control-modern {
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    padding: 12px 16px;
    font-size: 14px;
    transition: all 0.3s ease;
    background-color: #ffffff;
  }

  .form-control-modern:focus {
    border-color: #001657;
    box-shadow: 0 0 0 0.2rem rgba(0, 22, 87, 0.15);
    outline: none;
  }

  .form-control-modern::placeholder {
    color: #adb5bd;
    font-style: italic;
  }

  textarea.form-control-modern {
    resize: vertical;
    min-height: 100px;
  }

  /* Modern Butonlar */
  .btn-primary-modern {
    background: linear-gradient(135deg, #001657 0%, #001657 100%);
    border: none;
    color: #ffffff;
    padding: 12px 24px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px rgba(0, 22, 87, 0.2);
  }

  .btn-primary-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 22, 87, 0.3);
    background: linear-gradient(135deg, #002080 0%, #001657 100%);
    color: #ffffff;
  }

  .btn-primary-modern:active {
    transform: translateY(0);
  }

  .btn-secondary-modern {
    background-color: #6c757d;
    border: none;
    color: #ffffff;
    padding: 12px 24px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
  }

  .btn-secondary-modern:hover {
    background-color: #5a6268;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(108, 117, 125, 0.3);
    color: #ffffff;
  }

  /* Form Actions */
  .form-actions-modern {
    margin-top: 2rem;
    padding-top: 1.5rem;
  }

  /* Select2 Modern Stil */
  .select2-container--default .select2-selection--single,
  .select2-container--default .select2-selection--multiple {
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    min-height: 48px;
    padding: 4px;
  }

  .select2-container--default .select2-selection--single:focus,
  .select2-container--default .select2-selection--multiple:focus {
    border-color: #001657;
    box-shadow: 0 0 0 0.2rem rgba(0, 22, 87, 0.15);
  }

  /* Input Group Modern */
  .input-group-text {
    border: 2px solid #e0e0e0;
    background-color: #f8f9fa;
  }

  /* Responsive Düzenlemeler */
  @media (max-width: 768px) {
    .content-wrapper {
      padding-top: 15px !important;
    }

    .card-body {
      padding: 20px !important;
    }

    .card-header {
      padding: 15px 20px !important;
    }

    .card-header h3 {
      font-size: 18px !important;
    }

    .card-header small {
      font-size: 12px !important;
    }

    .form-group-modern {
      margin-bottom: 1.25rem;
    }

    .form-actions-modern {
      flex-direction: column;
      gap: 10px;
    }

    .form-actions-modern .btn {
      width: 100%;
    }

    .row .col-md-6,
    .row .col-md-4 {
      margin-bottom: 0;
    }
  }

  @media (max-width: 576px) {
    .card-header {
      padding: 12px 15px !important;
    }

    .card-header .d-flex {
      flex-direction: column;
      align-items: flex-start !important;
    }

    .card-header .btn {
      margin-top: 10px;
      width: 100%;
    }
  }

  /* Input Focus Animasyonu */
  .form-control-modern:focus {
    animation: inputFocus 0.3s ease;
  }

  @keyframes inputFocus {
    0% {
      transform: scale(1);
    }
    50% {
      transform: scale(1.01);
    }
    100% {
      transform: scale(1);
    }
  }

  /* Buton Hover Efektleri */
  .btn:hover {
    transform: translateY(-2px);
    transition: all 0.3s ease;
  }

  /* Card Header Icon Animasyonu */
  .card-header .rounded-circle {
    transition: all 0.3s ease;
  }

  .card-header:hover .rounded-circle {
    transform: rotate(5deg);
    background-color: rgba(255,255,255,0.3) !important;
  }

  .card-dark:not(.card-outline)>.card-header a.active {
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