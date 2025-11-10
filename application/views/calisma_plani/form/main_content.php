 
 
<div class="content-wrapper">
    
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Çalışma Planı Form</h1>
          </div> 
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url()?>">Giriş</a></li>
              <li class="breadcrumb-item active">Çalışma Planı Form</li>
            </ol>
          </div> 
        </div> 
      </div> 
    </div>
     
<section class="content col-md-4">
<div class="card card-primary">
    <div class="card-header with-border">
      <h3 class="card-title"> Çalışma Planı Bilgileri</h3>
     
     
    </div>
  
    <?php if(!empty($calisma_plani)){?>
            <form class="form-horizontal" id="form-banner" method="POST" action="<?php echo site_url('calisma_plan/save').'/'.$calisma_plani->calisma_plan_id;?>">
    <?php }else{?>
            <form class="form-horizontal" id="form-banner" method="POST" action="<?php echo site_url('calisma_plan/save');?>">
    <?php } ?>
    <div class="card-body">

    



     
<div class="row" style="background: whitesmoke;border: 2px dashed #495057ab;padding:5px;padding-top:18px;margin:1px;margin-bottom:10px !important">
        <div class="col-md-12 mt-2">
         
 
      <div class="form-group">
        <label for="formClient-Name"> Çalışma Plan Detay</label>
        <input type="text" value="<?php echo  !empty($calisma_plani) ? $calisma_plani->calisma_plani_baslik : '';?>" class="form-control" name="calisma_plani_baslik" required="" placeholder="Plan Detayını Giriniz..." autofocus="">
       </div>

      <div class="form-group">
        <label for="formClient-Code"> Geçerlilik Tarihi</label>
         <input type="date" required class="form-control" value="<?php echo  !empty($calisma_plani) ? date("Y-m-d",strtotime($calisma_plani->calisma_plani_gecerlilik_tarihi)) : date("Y-m-d")?>" name="calisma_plani_gecerlilik_tarihi" data-inputmask-alias="datetime" data-inputmask-inputformat="dd.mm.yyyy" data-mask="" inputmode="numeric">
      </div>

    </div></div>
     

    <div class="card-footer" style="    width: -webkit-fill-available;">
      <div class="row">
        <div class="col"><a href="<?=base_url("calisma_plan")?>"  class="btn btn-flat btn-danger"> İptal</a></div>
        <div class="col text-right"><button type="submit" class="btn btn-flat btn-primary"> Kaydet</button></div>
      </div>
    </div>
    

    </form>
  </div>
          
</section>
            </div>