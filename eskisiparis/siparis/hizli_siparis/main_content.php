 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper pt-2">
  <div class="row">
    <section class="content col-lg-6">
      <div class="card card-dark p-0">
        <div class="card-header with-border">
          <h3 class="card-title"> <i class="ion ion-person-stalker"></i> Hızlı Sipariş Oluştur</h3>
        </div>


            <form class="form-horizontal" onsubmit="submitFormWaiting()" method="POST" id="form_talep" action="<?php echo site_url('siparis/hizli_siparis_olustur');?>">

    <div class="card-body" style="background:#ffffff;">
    <?php $kontrol = !goruntuleme_kontrol("talep_yonlendirme") ?> 

      <div class="row">
      <div class="form-group <?=$kontrol ? "col-12" : "col-12"?> pl-0">
        <label for="formClient-Name">Cep Telefonu Numarası</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text rounded-2"><i class="fas fa-phone"></i></span>
          </div>
          <input type="text" required name="talep_cep_telefon" id="talep_cep_telefon" class="form-control rounded-2" value="<?php echo  !empty($talep) ? $talep->talep_cep_telefon : '';?>" placeholder="Müşteri Cep Numarasını Giriniz" data-inputmask="&quot;mask&quot;: &quot;0999 999 99 99&quot;" data-mask="" <?=(!empty($talep))?'':'onblur="validatePhoneNumber(this.value)"'?>   inputmode="numeric">
        
        </div>
      </div>


      

      </div>
 
  

       



      





 

 
   
    </div>
    <!-- /.card-body -->

    <div class="card-footer" style="background:#e9e9e9;">
      <div class="row">
        <div class="col">
           
        <button type="submit" class="btn  btn-success"><i class="ion ion-checkmark-circled"></i> Hızlı Sipariş Oluştur</button>
        <a href="<?=base_url("musteri/ekle")?>" target="_blank" class="btn btn-primary"><i class="ion ion-checkmark-circled"></i> Yeni Müşteri Kayıt</a>
      
      </div>
      </div>
    </div>
    <!-- /.card-footer-->

    </form>
  </div>
            <!-- /.card -->
</section>



















<section class="content col-lg-6 <?=!empty($talep) ? "":"d-none"?>">
 

<div class="card card-dark">
    <div class="card-header with-border">
      <h3 class="card-title"> <i class="ion ion-shuffle"></i> Yönlendirme Bilgileri</h3>
    </div>
  
    <div class="card-body p-0 ">
         
  
  
    <table id="exampleyonlendirmeler" class="table table-bordered table-striped nowrap">
                  <thead>
                  <tr>
                    
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
                        $message = "*Kullanıcı Girişi";
                      }else{
                        $background = "";
                        $color = "#bfbfbf";
                        $message = "*Yönlendirme";
                      }
                      ?>
                    <tr style="background:<?=$background?>;">
                      
                      <td><i class="fa fa-user" style="font-size:13px"></i>    <?=$talep->yonlenen_ad_soyad?><span style="color:<?=$color?>"> <?=$message?></span> </td>
                      <td><i class="fa fa-arrow-circle-right" style="font-size:13px"></i>    <?=$talep->yonlendiren_ad_soyad?> </td>  
                      <td><i class="far fa-calendar-plus" style="margin-right:5px;opacity:1"></i> <?=$talep->talep_sonuc_adi?></td>
                     
                    
                      <td><i class="far fa-calendar-plus" style="margin-right:5px;opacity:1"></i> <?=date('d.m.Y H:i',strtotime($talep->yonlendirme_tarihi));?></td>
                    
                     
                    </tr>
                  <?php  endforeach; ?>
                  </tbody>
                  <tfoot>
                  <tr>
                      
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
.card-dark:not(.card-outline)>.card-header a.active {
    /* color: #ffffff; */
    color: black;
}

</style>








<script src="https://code.jquery.com/jquery-1.12.4.min.js"   integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="   crossorigin="anonymous"></script>

	

<script>
    
    function validatePhoneNumber(urun_id) {
     
      
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
      });

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
        up_names[0].focus();
    });
}
        </script>