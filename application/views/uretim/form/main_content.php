 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Üretim Form</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url()?>">Giriş</a></li>
              <li class="breadcrumb-item active">Üretim Form</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<section class="content col-md-4">
<div class="card card-primary">
    <div class="card-header with-border">
      <h3 class="card-title"> Üretim Bilgileri</h3>
     
     
    </div>
  
    <?php if(!empty($uplan)){?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('departman/save').'/'.$uplan->uretim_planlama_id;?>">
    <?php }else{?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('departman/save');?>">
    <?php } ?>
    <div class="card-body">



    <div class="form-group">
        <label for="formClient-Code"> Ürün</label>

        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <select class="select2"  required  name="urun_fg_id" id="ekle_urun"  data-placeholder="Cihaz Seçimi Yapınız" style="width: 100%;">
        <option value="">Seçim Yapınız</option>
    <?php foreach($urunler as $urun) : ?> 
        <?php
            $urun_id = $urun->urun_id;
            $selected = (!empty($uplan) && $uplan->urun_fg_id == $urun->urun_id) ? 'selected="selected"' : '';
        ?>
        <option value="<?=$urun_id?>" <?=$selected?>><?=$urun->urun_adi?></option>
    <?php endforeach; ?> 
</select>

      </div>

      <div class="form-group col-md-6 pr-0 pl-0 mb-2">
     <label for="formClient-Name">  Renk</label>
  
<div id="urun_renk_div" style="width: 100%;">

<select class="select2"  disabled  data-placeholder="Önce Ürün Seçiniz" style="width: 100%;">
        <option value="">Önce Ürün Seçiniz</option>
   
</select>
             </div>


           
     </div>

      <div class="form-group">
        <label for="formClient-Name"> Başlık Bilgisi</label>
        <input type="text" value="<?php echo  !empty($uplan) ? $uplan->baslik_bilgisi : '';?>" class="form-control" name="baslik_bilgisi" required="" placeholder="Başlık Bilgisini Giriniz..." autofocus=""> 
      </div>

      <div class="form-group">
        <label for="formClient-Code"> Üretim Tarihi</label>
        <input type="date" value="<?php echo !empty($uplan) ? date("Y-m-d",strtotime($uplan->uretim_tarihi)) : '';?>" class="form-control" name="uretim_tarihi" placeholder="Üretim Tarihi Giriniz..." autofocus=""> 
      </div>
  
      
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <div class="row">
        <div class="col"><a href="<?=base_url("uretim_planlama")?>"  class="btn btn-flat btn-danger"> İptal</a></div>
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
     });
    })});


              </script>