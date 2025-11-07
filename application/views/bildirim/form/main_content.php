 
 
<div class="content-wrapper">
     
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Öneri, Şikayet ve Talep Form</h1>
          </div> 
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url()?>">Giriş</a></li>
              <li class="breadcrumb-item active">Öneri, Şikayet ve Talep Form</li>
            </ol>
          </div> 
        </div> 
      </div> 
    </div>
    
<section class="content col-md-4">
<div class="card card-primary">
    <div class="card-header with-border">
      <h3 class="card-title"> Form Bilgileri</h3>
     
     
    </div>
  
    <?php if(!empty($bildirim)){?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('bildirim/save').'/'.$bildirim->bildirim_id;?>">
    <?php }else{?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('bildirim/save');?>">
    <?php } ?>
    <div class="card-body">

    

      <div class="form-group">
        <label for="formClient-Name"> Bildirim Konusu</label>
        <input type="text" value="<?php echo  !empty($bildirim) ? $bildirim->bildirim_konusu : '';?>" class="form-control" name="bildirim_konusu" required="" placeholder="Bildirim Konusu Giriniz..." autofocus="">
           </div>

      <div class="form-group">
        <label for="formClient-Code"> Bildirim Açıklama</label>
        <input type="text" value="<?php echo !empty($bildirim) ? $bildirim->bildirim_detay : '';?>" class="form-control" name="bildirim_detay" placeholder="Bildirim Açıklamasını Giriniz..." autofocus="">
         </div>
  
      
    </div>
     
    <div class="card-footer">
      <div class="row">
        <div class="col"><a href="<?=base_url("bildirim")?>"  class="btn btn-flat btn-danger"> İptal</a></div>

        <?php 
          switch ($bildirim->kalite_durum) {
            case 'value':
              
              break;
            
            default:
               
              break;
          }
        ?>
        
        <div class="col text-right"><button type="submit" class="btn btn-flat btn-primary"> Kaydet</button></div>
      </div>
    </div>
    
    </form>
  </div>
           
</section>
            </div>