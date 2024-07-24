 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Yeni Cihaz Tanımlama Formu</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url()?>">Giriş</a></li>
              <li class="breadcrumb-item active">Yeni Cihaz Tanımlama Formu</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<section class="content col-md-4">
<div class="card card-primary">
    <div class="card-header with-border">
      <h3 class="card-title"> Cihaz Bilgileri</h3>
     
     
    </div>

    <form class="form-horizontal" method="POST" action="<?php echo site_url('cihaz/cihaz_havuz_tanimla_updatesave/'.$cihaz->cihaz_havuz_id);?>">

    <div class="card-body">

      <div class="form-group">
        <label for="formClient-Code"> Cihaz</label>
        
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <select name="cihaz_id" id="ekle_urun" required class="select2 form-control rounded-0" style="width: 100%;">
        <option  value="">Cihaz Seçimi Yapınız</option>
        <?php foreach($cihazlar as $ci) : ?> 
                    <option  value="<?=$ci->urun_id?>" <?=($cihaz->cihaz_kayit_no == $ci->urun_id) ? "selected":""?>><?=$ci->urun_adi?></option>
          <?php endforeach; ?>  
                  </select>      
      </div>

 
      <div class="form-group col-md-6 pr-0 pl-0 mb-1">
        <label for="formClient-Name"><i class="fas fa-swatchbook text-primary"></i> Renk</label>
     
   <div id="urun_renk_div">
   <select name="ekle_renk" id="ekle_renk" class="select2 form-control rounded-0">
   <?php foreach($renkler as $renk) : ?> 
                    <option  value="<?=$renk->renk_id?>" <?=($cihaz->cihaz_renk_no == $renk->renk_id) ? "selected":""?>><?=$renk->renk_adi?></option>
          <?php endforeach; ?>  
        </select>
                </div>


              
        </div>

      <div class="form-group">
        <label for="formClient-Name">Cihaz Seri Numarası</label>
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <input type="text" class="form-control" name="cihaz_seri_numarasi" required="" value="<?=$cihaz->cihaz_havuz_seri_numarasi?>" placeholder="Seri No Giriniz..." autofocus="">
       </div>

 


<?php 

foreach ($stoklar as $stok) {
 ?>
<div class="form-group">
        <label for="exampleInputFile">Stok Tanım Adı</label>
        <div class="input-group">
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="exampleInputFile">
            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
          </div>
          <div class="input-group-append">
            <span class="input-group-text">Upload</span>
          </div>
        </div>
      </div>
 <?php
}

?>


      




    </div>









    <!-- /.card-body -->

    <div class="card-footer">
      <div class="row">
        
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
			$('#ekle_urun').on('change', function(e){
				var urun_id = $(this).val();
      
				$.post('<?=base_url("urun/get_renkler/")?>'+urun_id, {}, function(result){
         
 
					if ( result && result.status != 'error' )
					{
          
						var renkler = result.data;
						var select = '<select name="ekle_renk" id="ekle_renk" class="select2 form-control rounded-0">';
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
				});	});	});     </script>