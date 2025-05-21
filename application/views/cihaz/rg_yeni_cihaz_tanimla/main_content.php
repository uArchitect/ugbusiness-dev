 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">RG Medikal Cihaz Tanımlama Formu</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url()?>">Giriş</a></li>
              <li class="breadcrumb-item active">RG Medikal Cihaz Tanımlama Formu</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<section class="content col-md-4">
<div class="card card-primary">
    <div class="card-header with-border">
      <h3 class="card-title">RG Medikal Cihaz Bilgileri</h3>
     
     
    </div>

    <form class="form-horizontal" method="POST" action="<?php echo site_url('cihaz/rg_medikal_cihaz_tanimla_save'.((!empty($_GET["filter"])) ? "/1" : ""));?>">

    <div class="card-body">
 

     <div class="form-group col pl-0">
        <label for="formClient-Name"> Müşteri Ad Soyad</label>

        <div class="input-group">
        <div class="input-group-prepend">
        <span class="input-group-text" style="background: #e6f6ff;"><i class="far fa-user" style="color:#0455ad"></i></span>
        </div>


        <input type="text" class="form-control" name="musteri_ad" required="" placeholder="Müşteri Adını Giriniz..."   autofocus="" >
       </div>

          </div>

<div class="form-group col pl-0">
  <label for="formClient-Code"> İletişim Numarası (*CEP)</label>
  
  
  <div class="input-group">
        <div class="input-group-prepend">
        <span class="input-group-text" style="background: #e6f6ff;"><i class="fas fa-mobile-alt" style="color:#0455ad"></i></span>
        </div>
        <input type="text"  required   class="form-control" name="musteri_iletisim_numarasi" placeholder="Müşteri İletişim Numarası Giriniz..." inputmode="text"  autofocus="">
        <div id="phoneError" style="color: red;"></div>
      </div>
  
   </div>



<div class="row">
  <div class="col">

   <div class="form-group col pl-0">
            <label for="formClient-Code">  İl İlçe Bilgileri</label>
           
          


           
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



  </div>
  <div class="col">


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
</div>
   

         




        

      <div class="form-group" style="height: 0px; opacity: 0;">

     

        <label for="formClient-Code"> Sipariş</label>
        
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <div id="urun_siparis_div">
        <select name="renkc" id="renkc" disabled class="select2 form-control rounded-0" style="width: 100%;">
        <option  value="0">Yeni Sipariş Oluştur</option>
         
                  </select>  
                </div>    
      </div>
    






      <div class="form-group" style="margin-top: -20px;">
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
        <label for="formClient-Code"> Renk</label>
        
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <div id="urun_renk_div">
        <select name="renkc" id="renkc" disabled class="select2 form-control rounded-0" style="width: 100%;">
        <option  value="">Renk Seçmek İçin Önce Cihaz Seçimi Yapınız</option>
         
                  </select>  
                </div>    
      </div>


      <div class="form-group">
        <label for="formClient-Name"> Seri Numarası</label>
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <input type="text" class="form-control" name="seri_numarasi" required="" placeholder="Seri No Giriniz..." autofocus="">
       </div>



       <div class="form-group">
        <label for="formClient-Name"> Garanti Başlangıç Tarihi</label>
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <input type="date" required class="form-control" value="<?=date("Y-m-d")?>" name="garanti_baslangic" data-inputmask-alias="datetime" data-inputmask-inputformat="dd.mm.yyyy" data-mask="" inputmode="numeric">
                       </div>

       <div class="form-group">
        <label for="formClient-Name"> Garanti Bitiş Tarihi</label>
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <input type="date" required class="form-control" value="<?=date("Y-m-d", strtotime('+2 years'))?>" name="garanti_bitis" data-inputmask-alias="datetime" data-inputmask-inputformat="dd.mm.yyyy" data-mask="" inputmode="numeric">
                        </div>






    </div>









    <!-- /.card-body -->

    <div class="card-footer">
      <div class="row">
        <div class="col"><a href="<?=base_url("cihaz/rgmedikalindex")?>"  class="btn btn-flat btn-danger"> İptal</a></div>
        <div class="col text-right"><button type="submit" class="btn btn-flat btn-primary"> Kaydet</button></div>
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






			$('#cihaz_id').on('change', function(e){
				var urun_id = $(this).val();
      
				$.post('<?=base_url("urun/get_renkler/")?>'+urun_id, {}, function(result){
    
 
					if ( result && result.status != 'error' )
					{
          
						var renkler = result.data;
						var select = '<select name="renk" id="ekle_renk" class="select2 form-control rounded-0">';
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







      $('#musteri_id').on('change', function(e){
				var urun_id = $(this).val();
      
				$.post('<?=base_url("siparis/get_siparisler/")?>'+urun_id, {}, function(result){
    
 
					if ( result && result.status != 'error' )
					{
          
						var siparisler = result.data;
						var select = '<select name="siparis_id" id="ekle_siparis" class="select2 form-control rounded-0">';
            select += '<option value="0">Yeni Sipariş Oluştur</option>';
						for( var i = 0; i < siparisler.length; i++)
						{
							select += '<option value="'+ siparisler[i].id +'"><b>'+ siparisler[i].siparis_kodu +'</b> / '+ siparisler[i].siparis_kayit_tarihi +'</option>';
						}
						select += '</select>';
						$('#urun_siparis_div').empty().html(select);
             
            $('#ekle_siparis').select2();
					}
					else
					{
            var select = '<select name="siparis_id" id="ekle_siparis" class="select2 form-control rounded-0">';
            select += '<option value="0">Yeni Sipariş Oluştur</option>';
						select += '</select>';
						$('#urun_siparis_div').empty().html(select);
             
            $('#ekle_siparis').select2();
					}					
				});

			});







		});



              </script>