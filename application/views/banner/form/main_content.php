 
 
<div class="content-wrapper">
    
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Banner Form</h1>
          </div> 
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url()?>">Giriş</a></li>
              <li class="breadcrumb-item active">Banner Form</li>
            </ol>
          </div> 
        </div> 
      </div> 
    </div>
    
<section class="content col-md-4">
<div class="card card-primary">
    <div class="card-header with-border">
      <h3 class="card-title"> Banner Bilgileri</h3>
     
     
    </div>
  
    <?php if(!empty($banner)){?>
            <form class="form-horizontal" id="form-banner" method="POST" action="<?php echo site_url('banner/save').'/'.$banner->banner_id;?>">
    <?php }else{?>
            <form class="form-horizontal" id="form-banner" method="POST" action="<?php echo site_url('banner/save');?>">
    <?php } ?>
    <div class="card-body">

    


 
<div class="row" style="background: whitesmoke;border: 2px dashed #495057ab;padding:5px;padding-top:18px;margin:1px;margin-bottom:10px !important">
        <div class="col-md-12 mt-2">
         
         
        <div id="actions" class="row">
          <div class="col-lg-12">
            <div class="btn-group w-100">
              <span class="btn btn-success col fileinput-button">
                <i class="fas fa-plus"></i>
                <span>Dosya Ekle</span>
              </span>
              <button type="submit" class="btn btn-primary col start">
                <i class="fas fa-upload"></i>
                <span>Yüklemeyi Başlat</span>
              </button>
              <button type="reset" class="btn btn-warning col cancel">
                <i class="fas fa-times-circle"></i>
                <span>Yüklemeyi İptal Et</span>
              </button>
            </div>
          </div>
          <div class="col-lg-6 d-none align-items-center">
            <div class="fileupload-process w-100">
              <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
              </div>
            </div>
          </div>
        </div>
        <div class="table table-striped files" id="previews">
          <div id="template" class="row mt-2">
            <div class="col-4 d-flex align-items-center">
              <p class="mb-0">
           
              <span class="lead" data-dz-name></span>
                (<span data-dz-size></span>)
              </p>
              <strong class="error text-danger" data-dz-errormessage></strong>
            </div>
            <div class="col-4 d-flex align-items-center">
              <div class="progress progress-striped active w-100" style="height:0.3rem" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                <div class="progress-bar progress-bar-success" style="background-color:#01711a;width:0%;" data-dz-uploadprogress></div>
              </div>
            </div>
            <div class="col-4 d-flex pl-0 align-items-center">
              <div class="btn-group" style="display: contents;">
                <button type="button" class="btn btn-dark start">
                  <i class="fas fa-upload"></i>
                  <span>Yükle</span>
                </button>
                <button type="button" data-dz-remove class="btn btn-dark cancel">
                  <i class="fas fa-times-circle"></i>
                  <span>İptal</span>
                </button>
                <button type="button" data-dz-remove class="btn btn-danger delete">
                  <i class="fas fa-trash"></i>
                  <span>Sil</span>
                </button>
              </div>
            </div>
          </div>     
        </div> 
      </div>
    </div> 




      <div class="form-group">
        <label for="formClient-Name"> Banner Adı</label>
        <input type="text" value="<?php echo  !empty($banner) ? $banner->banner_adi : '';?>" class="form-control" name="banner_adi" required="" placeholder="Banner Adını Giriniz..." autofocus="">
        <p style="color: red;"> <?php echo json_decode($this->session->flashdata('form_errors'))->banner_adi ?? ''; ?></p>
      </div>

      <div class="form-group">
        <label for="formClient-Code"> Banner Açıklama</label>
        <input type="text" value="<?php echo !empty($banner) ? $banner->banner_aciklama : '';?>" class="form-control" name="banner_aciklama" placeholder="Banner Açıklamasını Giriniz..." autofocus="">
        <p style="color: red;"> <?php echo json_decode($this->session->flashdata('form_errors'))->banner_aciklama ?? ''; ?></p>
      </div>
  
    
      <input type="hidden" name="fileNames" id="fileNames">
    </div>
     
    <div class="card-footer">
      <div class="row">
        <div class="col"><a href="<?=base_url("banner")?>"  class="btn btn-flat btn-danger"> İptal</a></div>
        <div class="col text-right"><button type="submit" class="btn btn-flat btn-primary"> Kaydet</button></div>
      </div>
    </div>
     
    </form>
  </div>
            
</section>
            </div>