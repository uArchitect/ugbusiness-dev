<?php
// Assume you have a function to get the limit details and update them
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   // Process the update
   $id = $_POST['id'];
   $new_price = $_POST['new_price'];
   // Update logic here...
   echo "<script>window.close();</script>";
   exit;
}
$limit = $limit_data[0]; // Define this function according to your setup
?>

<!DOCTYPE html>
<html>
<head>
<head>
    <?php $this->load->view("includes/head"); ?>
</head>
</head>
<body>
   <form method="POST" action="<?=base_url("kullanici/fiyat_guncelle_save/".$limit_data[0]->satis_fiyat_limit_id)?>">

   <div class="card card-primary">
    <div class="card-header with-border">
      <h3 class="card-title"> (<b><?=$limit->kullanici_ad_soyad?> - <?=$limit->urun_adi?></b>) Fiyat Limitlerini Güncelle</h3>
     
     
    </div>
  
                
        <div class="card-body">

    

      <div class="form-group">
        <label for="formClient-Name"> Nakit Satış Fiyat Alt Limit</label>
        <input type="text" value="<?=trim(str_replace(",","",str_replace(".","",number_format($limit->nakit_satis_fiyat_alt_limit,0)))) ?>" name="nakit_satis_fiyat_alt_limit" class="form-control" required="">
      </div>
      <div class="form-group">
        <label for="formClient-Name"> Vadeli Satış Fiyat Alt Limit</label>
        <input type="text" value="<?=trim(str_replace(",","",str_replace(".","",number_format($limit->vadeli_satis_fiyat_alt_limit,0)))) ?>" name="vadeli_satis_fiyat_alt_limit" class="form-control" required="">
      </div>
       
      <div class="form-group">
        <label for="formClient-Name"> Peşinat Fiyat Alt Limit</label>
        <input type="text" value="<?=trim(str_replace(",","",str_replace(".","",number_format($limit->pesinat_fiyat_alt_limit,0)))) ?>" name="pesinat_fiyat_alt_limit" class="form-control" required="">
      </div>
  
      
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <div class="row">
        <div class="col"><a href="http://192.168.2.211/ugbusiness/departman" class="btn btn-flat btn-danger"> İptal</a></div>
        <div class="col text-right"><button type="submit" class="btn btn-flat btn-primary"> Kaydet</button></div>
      </div>
    </div>
    <!-- /.card-footer-->

  </div>

 
   </form>
</body>
</html>