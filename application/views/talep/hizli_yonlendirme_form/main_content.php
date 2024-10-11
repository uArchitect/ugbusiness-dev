 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper pt-2">
  <div class="row">
    <section class="content col-lg-6">
      <div class="card card-dark p-0">
        <div class="card-header with-border">
          <h3 class="card-title"> <i class="ion ion-person-stalker"></i> Talep Bilgileri</h3>
        </div>

 
    <form class="form-horizontal" onsubmit="submitFormWaiting()" method="POST" id="form_talep" action="<?php echo site_url('talep/save');?>">

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
          <input type="text" required name="talep_cep_telefon" id="talep_cep_telefon" class="form-control rounded-2" value="<?php echo  !empty($talep) ? $talep->talep_cep_telefon : '';?>" placeholder="Müşteri Cep Numarasını Giriniz" data-inputmask="&quot;mask&quot;: &quot;0999 999 99 99&quot;" data-mask="" inputmode="numeric">
          <button onclick="kopyalayiYapistir()"><i class="fas fa-paste"></i> Panodan Yapıştır</button>
        </div>
      </div>
 
  

      </div>

<div class="row">
     <div class="col">
     <div class="form-group   pr-3">
        <label for="formClient-Code">Talep Kaynak</label>
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <select name="talep_kaynak_no" <?=$kontrol ? "" : "required"?> class="select2 form-control rounded-2" style="width: 100%;">
          <option   value="2" selected="selected">SOSYAL MEDYA</option>
          <option   value="1" selected="selected">WEBSITE</option>
        </select>        
      </div>
     </div>
     <div class="col">
     <div class="form-group">
        <label for="formClient-Code"> İlgilendiği Cihaz</label>

        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
         <select name="secilen_cihazlar" class="select2 form-control rounded-2" style="width: 100%;">
    
            <option   value="8" selected="selected">UMEX PLUS</option>
            <option   value="1" selected="selected">UMEX LAZER</option>

          </select> 
 

      </div>

     </div>
</div>

       










 
 
     
<div class="card card-dark" style="<?=(!empty($talep_yonlendirme)) ? "":"display:none;"?>">
  
  
    <div class="card-body " style="background:#fff8e8;border: 4px dashed #fabf49;border-top:0px">
        
  







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
   
         var temizMetin = clipText.replace("+9", "");
        
         if (temizMetin.substring(0, 1) !== "0") {
             temizMetin = "0" + temizMetin;
         }
      
         document.getElementById("talep_cep_telefon").value = temizMetin;    
     });
 }
         
        </script>

 
