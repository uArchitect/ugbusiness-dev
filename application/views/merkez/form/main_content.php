 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
  
    <!-- /.content-header -->
<section class="content mt-2 col-md-5">
<div class="card card-primary">
    <div class="card-header with-border">
      <h3 class="card-title"> Merkez Bilgileri</h3>
     
     
    </div>
  
    <?php if(!empty($merkez)){?>
            <form class="form-horizontal" onsubmit="submitFormWaiting()" id="form-banner" method="POST" action="<?php echo site_url('merkez/save').'/'.$merkez->merkez_id;?>">
    <?php }else{?>
            <form class="form-horizontal" onsubmit="submitFormWaiting()" id="form-banner" method="POST" action="<?php echo site_url('merkez/save');?>">
    <?php } ?>
    <div class="card-body">
 <input type="text" name="sipariskod" value="<?php echo $_GET["siparis"];?>" id="">
 
 <div style="background:whitesmoke;border: 2px dashed #b5b5b5;" class="p-2">




 <div class="form-group">
        <label for="formClient-Code"> Merkez Yetkilisi</label>
        
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
 
        <select name="merkez_yetkili_id" id="merkez_yetkili_id" required class="select2 form-control rounded-0" style="width: 100%;">
        <option  value="">Müşteri Seçimi Yapınız</option>
        <?php foreach($musteriler as $musteri) : ?> 
                    <option <?=($secilen_musteri == $musteri->musteri_id)?"selected":""?> value="<?=$musteri->musteri_id?>"><?=$musteri->musteri_ad?>(<?=$musteri->merkez_adi?>) <?=$musteri->ilce_adi?> / <?=$musteri->sehir_adi?> / <?=$musteri->musteri_iletisim_numarasi?></option>
          <?php endforeach; ?>  
                  </select> 
                       </div>





        <div class="form-group">
          <label for="formClient-Code"> İşyeri / Merkez Adı</label>
          <input type="text" value="<?=(!empty($merkez) ? $merkez->merkez_adi : "")?>" class="form-control" name="merkez_adi" maxlength="50" placeholder="İşyeri / Merkez Adı Giriniz..."  >
        </div>
        <div class="row">






        <div class="input-group ">
        <div class="input-group-prepend">
        <span class="input-group-text" style="background: #e6f6ff;"><i class="far fa-map" style="color:#0455ad"></i></span>
        </div>
         
        <select name="ulke_id" required class="select2 form-control rounded-0" >
            <option  value="">ÜLKE SEÇİLMEDİ</option>
            <?php foreach($ulkeler as $ulke) : ?> 
                <option  value="<?=$ulke->ulke_id?>"  <?php echo  (!empty($merkez) && $merkez->merkez_ulke_id == $ulke->ulke_id) ? 'selected="selected"'  : '';?>><?=$ulke->ulke_adi?></option>
              <?php endforeach; ?>  
            </select>
      
      </div>








        
          <div class="form-group col pl-0">
            <label for="formClient-Code">  İşyeri / Merkez Adresi</label>
            <select name="merkez_il_id" id="merkez_il_id" class="select2 form-control rounded-0" style="width: 100%;">
            <option  value="0">İL SEÇİLMEDİ</option>
            <?php foreach($sehirler as $sehir) : ?> 
                <option  value="<?=$sehir->sehir_id?>"  <?php echo  (!empty($merkez) && $merkez->merkez_il_id == $sehir->sehir_id) ? 'selected="selected"'  : '';?>><?=$sehir->sehir_adi?></option>
              <?php endforeach; ?>  
            </select>
          </div>
          <div class="form-group col pr-0">
            <label for="formClient-Code">&nbsp; </label>
            <div id="ilceler">
              <select name="merkez_ilce_id" id="merkez_ilce_id" class="select2 form-control rounded-0" style="width: 100%;">
              <option  value="0">İLÇE SEÇİLMEDİ</option>
              <?php foreach($ilceler as $ilce) : ?> 
                  <option  value="<?=$ilce->ilce_id?>"  <?php echo  (!empty($merkez) && $merkez->merkez_ilce_id == $ilce->ilce_id) ? 'selected="selected"'  : '';?>><?=$ilce->ilce_adi?></option>
                <?php endforeach; ?>  
              </select>
            </div>
          </div>
        </div>
        <div class="form-group">
          <textarea name="merkez_adresi" id="summernotemusteri"><?=(!empty($merkez) ? $merkez->merkez_adresi : "")?></textarea>
        </div>
      </div>
     
  
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <div class="row">
        <button type="submit" style="flex:1"  class="btn   btn-success"><i class="fa fa-save"></i> Bilgileri Kaydet</button>
       <a href="<?=base_url("merkez")?>" style="flex:1"  class="btn   btn-danger"><i class="fas fa-times"></i> İptal</a>
        
        
      </div>
    </div>
    <!-- /.card-footer-->

    </form>
  </div>
            <!-- /.card -->
</section>
            </div>







            

<script src="https://code.jquery.com/jquery-1.12.4.min.js"   integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="   crossorigin="anonymous"></script>

	

<script>
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