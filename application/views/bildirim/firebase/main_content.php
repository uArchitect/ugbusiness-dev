 
 
<div class="content-wrapper">
     
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Bildirim Gönder</h1>
          </div> 
         
        </div> 
      </div> 
    </div> 
<section class="content col-md-4">
<div class="card card-primary">
    <div class="card-header with-border">
      <h3 class="card-title"> Bildirim Detayları</h3>
     
     
    </div>
  
    <form class="form-horizontal" method="POST" action="<?php echo site_url('bildirim/gonder');?>">
    <div class="card-body">

    

      <div class="form-group">
        <label for="formClient-Name"> Bildirim Konusu</label>
        <input type="text"   class="form-control" name="bildirim_konusu" required="" placeholder="Bildirim Başlık Giriniz..." autofocus="">
           </div>

      <div class="form-group">
        <label for="formClient-Code"> Bildirim Açıklama</label>
        <input type="text"  class="form-control" name="bildirim_detay" placeholder="Bildirim Mesaj Giriniz..." autofocus="">
         </div>
         <div class="form-group">
        <label for="formClient-Code"> Bildirim Görsel</label>
        <input type="text"  class="form-control" name="bildirim_gorsel" placeholder="Bildirim Görsel Url Giriniz..." autofocus="">
         </div>
      
    </div>
     
    <div class="card-footer">
      <div class="row">
        <div class="col"><a href="<?=base_url("bildirim")?>"  class="btn btn-flat btn-danger"> İptal</a></div>
 
        
        <div class="col text-right"><button type="submit" class="btn btn-flat btn-success"> Bildirim Gönder</button></div>
      </div>
    </div>
     
    </form>
  </div>
            
</section>
            </div>


 