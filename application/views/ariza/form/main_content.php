 
 
<div class="content-wrapper">
     
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Arıza Form</h1>
          </div> 
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url()?>">Giriş</a></li>
              <li class="breadcrumb-item active">Arıza Form</li>
            </ol>
          </div> 
        </div> 
      </div> 
    </div>
     
<section class="content col-md-4">
<div class="card card-primary">
    <div class="card-header with-border">
      <h3 class="card-title"> Arıza Bilgileri</h3>
     
     
    </div>
  
    <?php if(!empty($ariza)){?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('ariza/save').'/'.$ariza->urun_baslik_ariza_id;?>">
    <?php }else{?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('ariza/save');?>">
    <?php } ?>
    <div class="card-body">

    






      <div class="form-group">
        <label for="formClient-Name"> Ariza Adı</label>
        <input type="text" value="<?php echo  !empty($ariza) ? $ariza->urun_baslik_ariza_adi : '';?>" class="form-control" name="urun_baslik_ariza_adi" required="" placeholder="Ariza Adını Giriniz..." autofocus="">
 
      </div>


      <div class="col-md-12">
        <label for="formClient-Code"> Başlık Bilgisi</label>
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <div class="input-group" style="flex-wrap: nowrap;">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fas fa-filter"></i></span>
              </div>
             
              <select name="urun_baslik_tanim_no" class="select2 form-control rounded-0" style="width: 100%;">
              <?php foreach($baslik_tanimlari as $baslik) : ?> 
                          <option  value="<?=$baslik->baslik_id?>" <?php echo  (!empty($ariza) && $ariza->urun_baslik_tanim_no == $baslik->baslik_id) ? 'selected="selected"'  : '';?>><?=$baslik->baslik_adi?></option>
            
                <?php endforeach; ?>  
                        </select>
        </div>  
      </div>
   
      
    </div>
     

    <div class="card-footer">
      <div class="row">
        <div class="col"><a href="<?=base_url("ariza")?>"  class="btn btn-flat btn-danger"> İptal</a></div>
        <div class="col text-right"><button type="submit" class="btn btn-flat btn-primary"> Kaydet</button></div>
      </div>
    </div>
     

    </form>
  </div>
             
</section>
            </div>