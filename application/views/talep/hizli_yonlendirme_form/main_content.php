 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper pt-2">
  <div class="row">
    <section class="content col-lg-6">
      <div class="card card-dark p-0">
        <div class="card-header with-border">
          <h3 class="card-title"> <i class="ion ion-person-stalker"></i> Talep Bilgileri</h3>
        </div>

 
    <form class="form-horizontal" onsubmit="submitFormWaiting()" method="POST" id="form_talep" action="<?php echo site_url('talep/talep_hizli_save');?>">

    <div class="card-body" style="background:#ffffff;">
    <?php $kontrol = !goruntuleme_kontrol("talep_tum_kayitlar_goruntule");

    ?> 

      <div class="row">
      <div class="form-group <?=$kontrol ? "col-12" : "col-12"?> pl-0">
        <label for="formClient-Name">Cep Telefonu Numarası</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text rounded-2"><i class="fas fa-phone"></i></span>
          </div>
          <input type="text" required name="talep_cep_telefon" id="talep_cep_telefon" class="form-control rounded-2" value="<?php echo  !empty($talep) ? $talep->talep_cep_telefon : '';?>" placeholder="İletişim Numarasını Giriniz" data-inputmask="&quot;mask&quot;: &quot;0999 999 99 99&quot;" data-mask="" inputmode="numeric">
          <a onclick="kopyalayiYapistir();" class="btn btn-default"><i class="fas fa-paste"></i>  Yapıştır</a>
        </div>
      </div>
 
  

      </div>


      <label for="formClient-Code">Talep Kaynak</label>
      <div class="btn-group btn-group-toggle" style="    width: -webkit-fill-available;" data-toggle="buttons">
<label class="btn btn-default" style="width:50%">
<input type="radio" name="talep_kaynak_no"  value="1" id="option_a1" autocomplete="off" checked=""> WEBSITE
</label>
<label class="btn btn-default" style="width:50%">
<input type="radio" name="talep_kaynak_no"  value="2" id="option_a2" autocomplete="off"> SOSYAL MEDYA
</label> 
</div>

<label for="formClient-Code" class="mt-2">İlgilendiği Cihaz</label>
<div class="btn-group btn-group-toggle" style="    width: -webkit-fill-available;" data-toggle="buttons">
<label class="btn btn-default" style="width:50%">
<input type="radio" name="urunid" id="option_a1" value="8" autocomplete="off" checked=""> UMEX PLUS
</label>
<label class="btn btn-default" style="width:50%">
<input type="radio" name="urunid" id="option_a2" value="1" autocomplete="off"> UMEX LAZER
</label>  
</div>

 
       


<div class="row mt-2 mb-2">

<div class="form-group col pl-0">
        <label for="formClient-Name"> Talep Uyarı Notu</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text rounded-2 bg-danger"><i class="fa fa-exclamation-triangle"></i></span>
          </div>
          <input style="background:#fff6f6;border:1px solid #f59797" type="text" value="" class="form-control" name="talep_uyari_notu" id="talep_uyari_notu" placeholder="Talep Uyarı Notu Giriniz..." autofocus="">
          <div class="btn-group mt-2" style="width: 100%;">
                      <button type="button" class="btn btn-default" onclick="document.getElementById('talep_uyari_notu').value='Müşteri sadece WhatsApp üzerinden iletişime geçilmesini talep etmiştir.';"><i class="fab fa-whatsapp text-success"></i> Whatsapp Uyarı Ekle</button> 
                      <button type="button" class="btn btn-default" onclick="document.getElementById('talep_uyari_notu').value='Müşteri 00:00 ile 18:00 saatleri arasında iletişime geçilmesini talep etmiştir.';"><i class="fas fa-clock text-danger"></i> Saat Uyarı Ekle</button> 


                       <button type="button" class="btn btn-default" onclick="document.getElementById('talep_uyari_notu').value='Yenilenmiş Cihaz Kampanyası';"><i class="fas fa-clock text-danger"></i> Yenilenmiş Cihaz</button> 
                      </div>
        </div>
      </div>

</div>

<div class="row mt-2 mb-2">

<div class="row btn-group btn-group-toggle" style=" gap:5px;   " data-toggle="buttons">
 
<?php 
foreach ($kullanicilar as $kdata) {
  if($kdata->kullanici_id == 94){
    continue;
  }
    ?>
 
      <label class=" col-4 btn btn-default " style=" <?=($kdata->kullanici_id == 5 || $kdata->kullanici_id == 18 || $kdata->kullanici_id == 19) ? "border:2px solid darkgreen;" : "opacity:1;"?>   align-content: center;
width:31%;border-radius:2px;">
        <input type="radio" required name="yonlenen_kullanici_id" style=" <?=($kdata->kullanici_id == 5 || $kdata->kullanici_id == 18 || $kdata->kullanici_id == 19) ? "" :"opacity:0.6;" ?>" id="option_k<?=$kdata->kullanici_id?>" value="<?=$kdata->kullanici_id?>" autocomplete="off">
        <img class="<?=($kdata->kullanici_id == 5 || $kdata->kullanici_id == 18 || $kdata->kullanici_id == 19) ? "" : "d-none"?>" src="<?=aktif_kullanici()->kullanici_resim ? base_url("uploads/$kdata->kullanici_resim") : base_url("uploads/default.png")?>" width="50" height="50">
        <?=$kdata->kullanici_ad_soyad?>
      </label>
    <?php
}

?>
   
   <label class=" col-4 btn btn-default " style="opacity:1; align-content: center;
width:31%;border-radius:2px;">
        <input type="radio" required name="yonlenen_kullanici_id" style="opacity:0.6;" id="option_k2" value="2" autocomplete="off">
      
        Muhittin Çoban
      </label>
</div>


</div>



<style>
  
  .btn-default.active{
    background:#0c7900!important;
    color:white;
  }
  </style>
 
 
     
<div class="card card-dark" style="<?=(!empty($talep_yonlendirme)) ? "":"display:none;"?>">
  
  
    <div class="card-body " style="background:#fff8e8;border: 4px dashed #fabf49;border-top:0px">
        
  







  </div>


      
 
  
  
 









    </div>
    <!-- /.card-body -->

    <div class="card-footer" style="background:#e9e9e9;">
      <div class="row">
        <div class="col-4">

          <a href="<?=base_url("bekleyen-talepler")?>" style="    width: -webkit-fill-available;"  class="btn btn-danger"><i class="ion ion-close-circled"></i> İptal</a>
       
      </div>
      <div class="col-8">
          
        <button type="submit" style="    width: -webkit-fill-available;" class="btn  btn-success"><i class="ion ion-checkmark-circled"></i> Bilgileri Kaydet</button>
      
      </div>
      </div>
    </div>
    <!-- /.card-footer-->

    </form>
  </div>
            <!-- /.card -->
</section>


<section>
  <div class="row">
  <?php  
  $cc = 0;
  foreach ($sontalepler as $stalep) {
    $cc++;
    ?>
    <div class="col-12">
    <button class="btn btn-default d-block mb-2" style="width: -webkit-fill-available;">
      <span style="font-size:18px;"><b><?=formatTelephoneNumber($stalep->talep_cep_telefon)?></b></span><?=($cc==1) ? "<span class='text-danger'> SON EKLENEN </span>" : ""?><br>
      <span><?=$stalep->yonlenen_ad_soyad?></span><br>
      <span><?=date("d.m.Y H:i",strtotime($stalep->yonlendirme_tarihi))?></span>
    </button>
    </div>
    <?php
  }
  
  ?></div>
</section>














</div>

            </div>











<script src="https://code.jquery.com/jquery-1.12.4.min.js"   integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="   crossorigin="anonymous"></script>

	

<script>
  

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
   
         var temizMetin = clipText.replace("+90", "");
        
         if (temizMetin.substring(0, 1) !== "0") {
             temizMetin = "0" + temizMetin;
         }
      
         document.getElementById("talep_cep_telefon").value = temizMetin;    
     });
 }
         
        </script>

 
