
    <!-- /.content-header -->
    <section class="content col-md-12 mt-2">
    <div class="card card-dark">
    <div class="card-header with-border bg-dark">
      <h3 class="card-title"> Hızlı Müşteri Kaydı Oluştur</h3>
     
     
    </div>
  
    <?php if(!empty($musteri)){?>
            <form class="form-horizontal" onsubmit="submitFormWaiting()" id="form-banner" method="POST" action="<?php echo site_url('musteri/save').'/'.$musteri->musteri_id;?>">
    <?php }else{?> 
            <form class="form-horizontal" onsubmit="submitFormWaiting()" id="form-banner" method="POST" action="<?php echo site_url('musteri/save');?>">
    <?php } ?>
    <div class="card-body">

    

 <input type="hidden" name="sipariskod" value="<?php echo $_GET["siparis"];?>" id="">

     






      <div class="row">

     
     


      <div class="form-group col pl-0">
        <label for="formClient-Name"> Müşteri Ad Soyad</label>

        <div class="input-group">
        <div class="input-group-prepend">
        <span class="input-group-text" style="background: #e6f6ff;"><i class="far fa-user" style="color:#0455ad"></i></span>
        </div>
        <input type="text" value="<?php echo  !empty($musteri) ? $musteri->musteri_ad : (!empty($talep) ? $talep[0]->talep_musteri_ad_soyad : "");?>" class="form-control" name="musteri_ad" required="" placeholder="Müşteri Adını Giriniz..."   autofocus=""  oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
       </div>

          </div>
   

      </div>

 



      <div class="row">


<div class="form-group col pl-0">
  <label for="formClient-Code"> İletişim Numarası (*CEP)</label>
  
  
  <div class="input-group">
        <div class="input-group-prepend">
        <span class="input-group-text" style="background: #e6f6ff;"><i class="fas fa-mobile-alt" style="color:#0455ad"></i></span>
        </div>
        <input type="text"  required value="<?php echo !empty($musteri) ? $musteri->	musteri_iletisim_numarasi : (!empty($talep) ? $talep[0]->talep_cep_telefon : (!empty($eski_data) ? $eski_data[0]->Telefon : ""));?>" class="form-control" name="musteri_iletisim_numarasi" placeholder="Müşteri İletişim Numarası Giriniz (Yurtdışı numaralar dahil)..."   inputmode="tel" onblur="validatePhoneNumber(this.value)" autofocus="">
        <div id="phoneError" style="color: red;"></div>
      </div>
  
   </div>

<div class="form-group col pr-0">
  <label for="formClient-Code"> Sabit Telefon</label>
  <div class="input-group">
        <div class="input-group-prepend">
        <span class="input-group-text" style="background: #e6f6ff;"><i class="far fa-id-card" style="color:#0455ad"></i></span>
        </div>
        <input type="text" value="<?php echo !empty($musteri) ? $musteri->musteri_sabit_numara : '';?>" class="form-control" name="musteri_sabit_numara" placeholder="Müşteri Sabit Numara Giriniz..." autofocus="">
  </div>
 
  </div>






</div>






      <div class="row">

      <div class="form-group col pl-0">
        <label for="formClient-Code"> Email Adresi </label>
        
        <div class="input-group">
        <div class="input-group-prepend">
        <span class="input-group-text" style="background: #e6f6ff;"><i class="far fa-envelope-open" style="color:#0455ad"></i></span>
        </div>
        <input type="text" value="<?php echo !empty($musteri) ? $musteri->musteri_email_adresi : '';?>" class="form-control" name="musteri_email_adresi" placeholder="Müşteri Email Adresini Giriniz..." autofocus="">
       </div>
        
         </div>
       <div class="form-group col pr-0">
        <label for="formClient-Code"> Cinsiyet </label>
       
        <div class="input-group">
        <div class="input-group-prepend">
        <span class="input-group-text" style="background: #e6f6ff;"><i class="fas fa-venus-mars" style="color:#0455ad"></i></span>
        </div>
      
        
        <select name="musteri_cinsiyet" class="select2 form-control">
        <option value="B">Seçim Yapılmadı</option>
        <option value="K" <?php echo (!empty($musteri) && ($musteri->musteri_cinsiyet == "K")) ? 'selected="selected"' : '';?> >Kadın</option>
        <option value="E" <?php echo (!empty($musteri) && ($musteri->musteri_cinsiyet == "E")) ? 'selected="selected"' : '';?> >Erkek</option>
        <option value="B" <?php echo (!empty($musteri) && ($musteri->musteri_cinsiyet == "B")) ? 'selected="selected"' : '';?> >Belirtilmedi</option>
      </select>
      
      </div>
       
       
      
      
      </div>

      </div>
     
      <div style="background:#e7f6fe73;border: 2px dashed #b5b5b5;opacity: 0;
    height: 18px;" class="p-2 mb-2">
      <div class="row">


<div class="form-group col pl-0 mb-0">
  <label for="formClient-Code"> 2. Yetkili Adı</label>
  
  
  <div class="input-group">
        <div class="input-group-prepend">
        <span class="input-group-text" style="background: #e6f6ff;"><i class="far fa-user" style="color:#0455ad"></i></span>
        </div>
        <input type="text" value="<?php echo !empty($musteri) ? $musteri->yetkili_adi_2 : (!empty($talep) ? $talep[0]->talep_cep_telefon : "");?>" class="form-control" name="yetkili_adi_2" placeholder="2. Yetkili Adını Giriniz..."    inputmode="text" autofocus="">
   </div>
  
  </div>

<div class="form-group col pr-0 mb-0">
  <label for="formClient-Code"> 2. Yetkili İletişimss Numarası</label>
 
 
  <div class="input-group">
        <div class="input-group-prepend">
        <span class="input-group-text" style="background: #e6f6ff;"><i class="fas fa-mobile-alt" style="color:#0455ad"></i></span>
        </div>
       
  <input type="text" value="<?php echo !empty($musteri) ? $musteri->yetkili_iletisim_2 : '';?>" class="form-control" name="yetkili_iletisim_2" placeholder="2. Yetkili İletişim Giriniz..." autofocus="" data-inputmask="&quot;mask&quot;: &quot;0999 999 99 99&quot;" data-mask="">
 </div>
 
 </div>






</div>


</div>










<?php


if(empty($musteri)){
        ?>
 <div style="background:whitesmoke;border: 2px dashed #b5b5b5;" class="p-2">
        <div class="form-group">
          <label for="formClient-Code"> İşyeri / Merkez Adı</label>

          <div class="input-group">
        <div class="input-group-prepend">
        <span class="input-group-text" style="background: #e6f6ff;"><i class="far fa-building" style="color:#0455ad"></i></span>
        </div>
       
        <input type="text" required value="<?=(!empty($talep) ? $talep[0]->talep_isletme_adi : (!empty($eski_data) ? $eski_data[0]->SalonAdi : ""))?>" class="form-control" name="merkez_adi" maxlength="50" placeholder="İşyeri / Merkez Adı Giriniz..."   oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);">
      </div>
 


        </div>


        <div style="background:whitesmoke;border: 2px dashed #b5b5b5;" class="p-2">
        <div class="form-group">
          <label for="formClient-Code"> Ülke</label>

          <div class="input-group">
        <div class="input-group-prepend">
        <span class="input-group-text" style="background: #e6f6ff;"><i class="far fa-building" style="color:#0455ad"></i></span>
        </div>
       
        <select name="ulke_id" required class="select2 form-control rounded-0" >
            <option  value="">ÜLKE SEÇİLMEDİ</option>
            <?php foreach($ulkeler as $ulke) : ?> 
                <option  value="<?=$ulke->ulke_id?>"   <?php echo  ($ulke->ulke_id == 190) ? 'selected="selected"'  : '';?>><?=$ulke->ulke_adi?></option>
              <?php endforeach; ?>  
            </select>
          
          </div>
 


        </div>






        <div class="row">

  
        


          <div class="form-group col pl-0">
            <label for="formClient-Code">  İşyeri / Merkez Adresi</label>
           
          


           
            <div class="input-group ">
        <div class="input-group-prepend">
        <span class="input-group-text" style="background: #e6f6ff;"><i class="far fa-map" style="color:#0455ad"></i></span>
        </div>
         
        <select name="merkez_il_id" required id="merkez_il_id" class="select2 form-control rounded-0" >
            <option  value="">İL SEÇİLMEDİ</option>
            <?php foreach($sehirler as $sehir) : ?> 
                <option  value="<?=$sehir->sehir_id?>"><?=$sehir->sehir_adi?></option>
              <?php endforeach; ?>  
            </select>
      
      </div>
           
           
          
          </div>





          <div class="form-group col pr-0">
            <label for="formClient-Code">&nbsp; </label>
            <div id="ilceler">
             
            
            
            <div class="input-group ">
        <div class="input-group-prepend">
        <span class="input-group-text" style="background: #e6f6ff;"><i class="far fa-map" style="color:#0455ad"></i></span>
        </div>
         
        <select name="merkez_ilce_id" id="merkez_ilce_id" class="select2 form-control rounded-0">
              <option  value="0">İLÇE SEÇİLMEDİ</option>
              <?php foreach($ilceler as $ilce) : ?> 
                  <option  value="<?=$ilce->ilce_id?>"><?=$ilce->ilce_adi?></option>
                <?php endforeach; ?>  
              </select>
      
      </div>
            
            
            
            
            
          
            </div>
          </div>
        </div>
        <div class="form-group">
          <textarea name="merkez_adresi" required class="form-control" rows="4" placeholder="Merkez adresini giriniz"></textarea>
        </div>
      </div>
     

<?php
}


?>

     






      <input type="hidden" name="fileNames" id="fileNames">
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <div class="row">
        <button type="submit" style="flex:1"  class="btn   btn-warning mr-2"><i class="fa fa-save"></i> Müşteri Kaydı Oluştur</button>
       <a href="<?=base_url("musteri")?>" style="flex:1"  class="btn   btn-danger"><i class="fas fa-times"></i> İptal</a>
        
        
      </div>
    </div>
    <!-- /.card-footer-->

    </form>
  </div>
            <!-- /.card -->
</section>
         







            

<script src="https://code.jquery.com/jquery-1.12.4.min.js"   integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="   crossorigin="anonymous"></script>

	

<script>

function validatePhoneNumber(phoneNumber) {
 /* alert(phoneNumber);
   alert(phoneNumber.replace("_","").length);
    if (phoneNumber.replace(" ","").replace("_","").length < 11) {
   
        alert("İletişim numarası hatalı.");
       
        document.getElementsByName("musteri_iletisim_numarasi")[0].focus();
    }*/
}




		$(document).ready(function(){
			$('#merkez_il_id').on('change', function(e){
				var il_id = $(this).val();
      
				$.post('<?=base_url("ilce/get_ilceler/")?>'+il_id, {}, function(result){
         
 
					if ( result && result.status != 'error' )
					{
          
						var ilceler = result.data;
						var select = '<select name="merkez_ilce_id" id="merkez_ilce_id" class="select2 form-control rounded-0">';
						for( var i = 0; i < ilceler.length; i++)
						{
							select += '<option value="'+ ilceler[i].id +'">'+ ilceler[i].ilce +'</option>';
						}
						select += '</select>';
						$('#ilceler').empty().html(select);
             
            $('.select2').select2();
					}
					else
					{
						alert('Hata : ' + result.message );
					}					
				});
			});
		});

	</script>