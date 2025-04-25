<script src="<?=base_url("assets")?>/dist/js/qrcode.min.js"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper pt-2">
  <div class="row">
    <section class="content col-lg-5">
      <div class="card card-dark p-0">
        <div class="card-header with-border">
          <h3 class="card-title"> <i class="ion ion-person-stalker"></i> Parça Kontrol</h3>
        </div>


            <form class="form-horizontal" onsubmit="submitFormWaiting()" method="POST" action="<?php echo site_url('stok/parca_kontrol');?>">

    <div class="card-body" style="background:#ffffff;">
  

      <div class="row">
     <div class="col">
     <div class="form-group">
        <label for="formClient-Name">Parça Seri Numarası</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text rounded-2"><i class="fas fa-qrcode"></i></span>
          </div>
          <input type="text" required name="parca_seri_numarasi" id="parca_seri_numarasi" placeholder="Sorgulamak istediğiniz parça seri kodunu giriniz" class="form-control rounded-2">
        
        </div>
      </div>
     </div>


      

      </div>
 
  

       



      





 

 
   
    </div>
    <!-- /.card-body -->

    <div class="card-footer" style="background:#e9e9e9;">
      <div class="row">
        <div class="col">
           
        <button type="submit" class="btn  btn-success"><i class="ion ion-checkmark-circled"></i> Sorgula</button></div>
      </div>
    </div>
    <!-- /.card-footer-->

    </form>
  </div>
            <!-- /.card -->

            <?php if(!empty($coklu_stok_kayitlari)){ ?>
              <?php if(count($coklu_stok_kayitlari)>0){ ?>
                <div class="card card-success">
                <div class="card-header">STOK BİLGİLERİ</div>
                <?php foreach($coklu_stok_kayitlari as $sparca){ ?>
                
           
                <div class="card-body">
                  <h4 style="margin-left: 6px;background: #e6e6e6;padding: 10px;"><?=$sparca->stok_tanim_ad?></h4>
                  <div class="row">
                    <div class="col" style="max-width:124px!important">
                      <div id="qrcode<?=$sparca->stok_id?>"></div> 
                      <script>
 
 var qrcode = new QRCode("qrcode<?=$sparca->stok_id?>", {
 text: "<?=((!empty($sparca) && ($sparca != "snull")) ? $sparca->stok_seri_kod : "")?>",
 width: 110,
 height: 110,
 colorDark : "#000000",
 colorLight : "#ffffff",
 correctLevel : QRCode.CorrectLevel.L
});

</script>
                    </div>
                    <div class="col">
                      <dl class="row">
                        <dt class="col-sm-3">Stok Seri Kod</dt>
                        <dd class="col-sm-9"><?=$sparca->stok_seri_kod?></dd>
                                <dt class="col-sm-3">Tanımlanan Cihaz</dt>
                        <dd class="col-sm-9"><?=($sparca->tanimlanan_cihaz_seri_numarasi == "0" || $sparca->tanimlanan_cihaz_seri_numarasi == "") ? "<span class='text-danger'>Cihaz Tanımlaması Yapılmadı</span>" 
                        : "<span class='text-success'>".$sparca->tanimlanan_cihaz_seri_numarasi."</span>"?>
                        </dd>
                        <dt class="col-sm-3">Müşteri Bilgileri</dt>
                        <dd class="col-sm-9">
                        <?php $mbilgi = get_merkez($sparca->tanimlanan_cihaz_seri_numarasi); ?> 
                        <?=($sparca->tanimlanan_cihaz_seri_numarasi == "0" || $sparca->tanimlanan_cihaz_seri_numarasi == "") ? "<span class='text-danger'>Cihaz Tanımlaması Yapılmadı</span>" 
                        : (($mbilgi  != null) ?( "<span style='font-weight:500'>".$mbilgi->musteri_ad . " / ". $mbilgi->merkez_adi."</span><br>ADRES : ".$mbilgi->merkez_adresi): "Müşteri Bilgisi Bulunamadı.")
                        ?>
                        </dd>
                      </dl>
                    </div>
                    </div>
                    </div>
              <?php }
            ?> 
            
             </div>
            <?php  
            }
              else{
                ?>
                    <div class="card card-danger">
                        <div class="card-header">CİHAZ TANIMLI PARÇA KAYDI BULUNAMADI.</div>
                      
                      </div>
                <?php
              }
            
            
            }else{
                  if(!empty($sparca)){
     
                    if($sparca == "snull"){
                      ?>
                        <div class="card card-danger">
                        <div class="card-header">STOK KAYDI BULUNAMADI.</div>
                      
                      </div>
                      <?php
                    }else{
                      ?>
                      <div class="card card-success">
                          <div class="card-header">STOK BİLGİLERİ</div>
                          <div class="card-body">
                          <h4 style="    margin-left: 6px;
                            background: #e6e6e6;
                            padding: 10px;"><?=$sparca->stok_tanim_ad?></h4>
                           <div class="row">
                            <div class="col" style="max-width:124px!important">
                              <div id="qrcode"></div> 
                            </div>
                            <div class="col">
      
                            <dl class="row">
      <dt class="col-sm-3">Stok Seri Kod</dt>
      <dd class="col-sm-9"><?=$sparca->stok_seri_kod?></dd>
      <dt class="col-sm-3">Stok Kayıt Tarihi</dt>
      <dd class="col-sm-9"><?=date("d.m.Y H:i",strtotime($sparca->stok_kayit_tarihi))?></dd>
      <dt class="col-sm-3">Stok Çıkış Tarihi</dt>
      <dd class="col-sm-9"><?=($sparca->stok_cikis_yapildi == "1") ? date("d.m.Y H:i",strtotime($sparca->stok_cikis_tarihi)) : "<span class='text-danger'>Stok Çıkışı Yapılmadı</span>"?></dd>
      <dt class="col-sm-3">Tanımlanan Cihaz</dt>
      <dd class="col-sm-9"><?=($sparca->tanimlanan_cihaz_seri_numarasi == "0" || $sparca->tanimlanan_cihaz_seri_numarasi == "") ? "<span class='text-danger'>Cihaz Tanımlaması Yapılmadı</span>" 
      : "<span class='text-success'>".$sparca->tanimlanan_cihaz_seri_numarasi."</span>"?>
      </dd>
      <dt class="col-sm-3">Müşteri Bilgileri</dt>
      <dd class="col-sm-9">
        <?=($sparca->tanimlanan_cihaz_seri_numarasi == "0" || $sparca->tanimlanan_cihaz_seri_numarasi == "") ? "<span class='text-danger'>Cihaz Tanımlaması Yapılmadı</span>" 
      : (($scihaz != null) ?( "<span style='font-weight:500'>".$scihaz->musteri_ad . " / ". $scihaz->merkez_adi."</span><br>ADRES : ".$scihaz->merkez_adresi): "Müşteri Bilgisi Bulunamadı.")
      ?>
      </dd>
      </dl>
      
                            </div>
                           </div>
                          
      
                          
      
      
      
                        </div>
                        </div>
                      
                      <?php
                    }
                   
                  }





                }
           
            
            ?>
</section>
 

</div>




            </div>

           
  <script>
 
    var qrcode = new QRCode("qrcode", {
    text: "<?=((!empty($sparca) && ($sparca != "snull")) ? $sparca->stok_seri_kod : "")?>",
    width: 110,
    height: 110,
    colorDark : "#000000",
    colorLight : "#ffffff",
    correctLevel : QRCode.CorrectLevel.L
});

	</script>

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