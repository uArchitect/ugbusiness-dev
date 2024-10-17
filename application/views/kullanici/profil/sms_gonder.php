 
    <div class="row" style="max-height: 865px; overflow-y: auto;"> 
    <div class="col-3"> </div>
<div class="col-6">

<div class="card card-dark mt-3" style="background:white;border:1px solid black">
    <div class="card-header with-border">
      <h3 class="card-title"> KULLANICI SMS GÖNDER</h3>
     
     
    </div>
  
    
            <form class="form-horizontal" method="POST" action="<?php echo site_url('kullanici/profil_kullanici_sms_save/'.$secilen_kullanici);?>">
 
    <div class="card-body">

    

      <div class="form-group">
        <label for="formClient-Name"> İletişim Numarası</label>
        <input type="text" readonly value="<?=str_replace(" ","",$kullanici_data->kullanici_bireysel_iletisim_no)?>" class="form-control" name="iletisim_numarasi" required="" autofocus="">
        
      </div>

      <div class="form-group">
        <label for="formClient-Name"> SMS Başlık</label>
        <input type="text" readonly  value="UGTEKNOLOJI" class="form-control" required="" autofocus="">
        
      </div>

      <div class="form-group">
        <label for="formClient-Code"> Mesajınız</label>
        <textarea type="text" value="<?php echo !empty($departman) ? $departman->departman_aciklama : '';?>" class="form-control" name="sms_detay" placeholder="Mesajınızı Giriniz..." autofocus=""></textarea>
       
      </div>
  
      
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <div class="row">
        <div class="col"><a href="<?=base_url("departman")?>"  class="btn btn-flat btn-danger"> İptal</a></div>
        <div class="col text-right"><button type="submit" class="btn btn-flat btn-primary"> Kaydet</button></div>
      </div>
    </div>
    <!-- /.card-footer-->

    </form>
  </div>
 
  </div> 



  <div class="col-3"> </div>



  <div class="col-3"> </div>
<div class="col-6">


<div class="card card-warning">
  <div class="card-header">
    Son Gönderilen Smsler (Kullanıcı Bazlı)
  </div>
  <div class="card-body">
    <?php 
    foreach ($son_gonderilen_smsler as $sms) {
      
    }
    ?>
  </div>
</div>




</div>
<div class="col-3"> </div>


</div>