 

<div class="content-wrapper"> 
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Yeni Başlık Tanımlama Formu</h1>
          </div> 
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url()?>">Giriş</a></li>
              <li class="breadcrumb-item active">Yeni Başlık Tanımlama Formu</li>
            </ol>
          </div> 
        </div> 
      </div> 
    </div> 
<section class="content col-md-4">
<div class="card card-primary">
    <div class="card-header with-border">
      <h3 class="card-title"> Başlık Bilgileri</h3>
     
     
    </div>

    <form class="form-horizontal" method="POST" action="<?php echo site_url('baslik/baslik_havuz_tanimla_save');?>">

    <div class="card-body">

      <div class="form-group">
        <label for="formClient-Code"> Cihaz</label>
        
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <select name="cihaz_id" id="cihaz_id" required class="select2 form-control rounded-0" style="width: 100%;">
        <option  value="">Cihaz Seçimi Yapınız</option>
        <?php foreach($cihazlar as $cihaz) : ?> 
                    <option  value="<?=$cihaz->urun_id?>"><?=$cihaz->urun_adi?></option>
          <?php endforeach; ?>  
                  </select>      
      </div>

  <div class="form-group">
        <label for="formClient-Code"> Başlık Türü</label>
        
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <div id="urun_renk_div">
        <select name="renkc" id="renkc" disabled class="select2 form-control rounded-0" style="width: 100%;">
        <option  value="">Başlık Seçmek İçin Önce Cihaz Seçimi Yapınız</option>
         
                  </select>  
                </div>    
      </div>
      <div class="form-group">
        <label for="formClient-Name">Başlık Seri Kodunu Giriniz (QR)</label>
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <input type="text" class="form-control" name="baslik_seri_numarasi" required="" placeholder="Başlık Kodunu Giriniz..." autofocus="">
       </div>

      <div class="form-group">
        <label for="formClient-Name">Cihaz Seri Numarası (UG00000000UX00)</label>
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <input type="text" class="form-control" name="cihaz_seri_numarasi" required="" placeholder="Seri No Giriniz..." autofocus="">
       </div>

 

    </div>








 

    <div class="card-footer">
      <div class="row">
        <div class="col"><a href="<?=base_url("istek-kategori")?>"  class="btn btn-flat btn-danger"> İptal</a></div>
        <div class="col text-right"><button type="submit" class="btn btn-flat btn-primary"> Kaydet</button></div>
      </div>
    </div> 

    </form>
  </div> 
</section>
            </div>

            <script src="https://code.jquery.com/jquery-1.12.4.min.js"   integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="   crossorigin="anonymous"></script>

            <script>


$(document).ready(function(){
			$('#cihaz_id').on('change', function(e){
				var urun_id = $(this).val();
      
				$.post('<?=base_url("urun/get_basliklar/")?>'+urun_id, {}, function(result){
    
 
					if ( result && result.status != 'error' )
					{
          
						var renkler = result.data;
						var select = '<select name="baslik_kayit_no" id="ekle_renk" class="select2 form-control rounded-0">';
						for( var i = 0; i < renkler.length; i++)
						{
							select += '<option value="'+ renkler[i].id +'">'+ renkler[i].renk +'</option>';
						}
						select += '</select>';
						$('#urun_renk_div').empty().html(select);
             
            $('#ekle_renk').select2();
					}
					else
					{
						alert('Hata : ' + result.message );
					}					
				});

			});
 

		});



              </script>