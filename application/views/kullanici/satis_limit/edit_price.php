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

   <div class="card card-primary m-3">
    <div class="card-header with-border">
      <h3 class="card-title"> (<b><?=$limit->kullanici_ad_soyad?> - <?=$limit->urun_adi?></b>) Fiyat Limitlerini Güncelle</h3>
     
     
    </div>
  
                
        <div class="card-body">

        <div class="row">
        <div class="col">
        <div class="form-group">
        <label for="formClient-Name"> Nakit Takassız Satış Fiyat <span style="font-weight:normal">Alt Limit</span></label>
        <input type="number" onfocus="handleFocus(this)" onblur="handleBlur(this)" value="<?=trim(str_replace(",","",str_replace(".","",number_format($limit->nakit_takassiz_satis_fiyat,0)))) ?>" name="nakit_takassiz_satis_fiyat" class="form-control" required="">
      </div>
        </div>
     
    </div>


    <div class="row">
        <div class="col">
        <div class="form-group">
        <label for="formClient-Name"> Vadeli Takassız Satış Fiyat <span style="font-weight:normal">Alt Limit</span></label>
        <input type="number" onfocus="handleFocus(this)" onblur="handleBlur(this)" value="<?=trim(str_replace(",","",str_replace(".","",number_format($limit->vadeli_takassiz_satis_fiyat,0)))) ?>" name="vadeli_takassiz_satis_fiyat" class="form-control" required="">
      </div>
        </div>
        <div class="col">
        <div class="form-group">
        <label for="formClient-Name"> Peşinat Tutarı <span style="font-weight:normal">Alt Limit</span></label>
        <input type="number" onfocus="handleFocus(this)" onblur="handleBlur(this)" value="<?=trim(str_replace(",","",str_replace(".","",number_format($limit->vadeli_pesinat_fiyat,0)))) ?>" name="vadeli_pesinat_fiyat" class="form-control" required="">
      </div>
        </div>
    </div>


    <div class="row">
        <div class="col">
        <div class="form-group">
        <label for="formClient-Name"> Nakit Umex Takas Fiyat <span style="font-weight:normal">Alt Limit</span></label>
        <input type="number" onfocus="handleFocus(this)" onblur="handleBlur(this)" value="<?=trim(str_replace(",","",str_replace(".","",number_format($limit->nakit_umex_takas_fiyat,0)))) ?>" name="nakit_umex_takas_fiyat" class="form-control" required="">
      </div>
        </div>
        <div class="col">
        <div class="form-group">
        <label for="formClient-Name"> Vadeli Umex Takas Fiyat <span style="font-weight:normal">Alt Limit</span></label>
        <input type="number" onfocus="handleFocus(this)" onblur="handleBlur(this)" value="<?=trim(str_replace(",","",str_replace(".","",number_format($limit->vadeli_umex_takas_fiyat,0)))) ?>" name="vadeli_umex_takas_fiyat" class="form-control" required="">
      </div>
        </div>
    </div>
     
     <div class="row">
        <div class="col">
        <div class="form-group">
        <label for="formClient-Name"> Nakit Robotx Takas Fiyat <span style="font-weight:normal">Alt Limit</span></label>
        <input type="number" onfocus="handleFocus(this)" onblur="handleBlur(this)" value="<?=trim(str_replace(",","",str_replace(".","",number_format($limit->nakit_robotix_takas_fiyat,0)))) ?>" name="nakit_robotix_takas_fiyat" class="form-control" required="">
      </div>
        </div>
        <div class="col">

        <div class="form-group">
        <label for="formClient-Name"> Vadeli Robotx Takas Fiyat <span style="font-weight:normal">Alt Limit</span></label>
        <input type="number" onfocus="handleFocus(this)" onblur="handleBlur(this)" value="<?=trim(str_replace(",","",str_replace(".","",number_format($limit->vadeli_robotix_takas_fiyat,0)))) ?>" name="vadeli_robotix_takas_fiyat" class="form-control" required="">
      </div>
        </div>
     </div>
     <div class="row">
        <div class="col">


        <div class="form-group">
        <label for="formClient-Name"> Nakit Diğer Cihaz Takas Fiyat <span style="font-weight:normal">Alt Limit</span></label>
        <input type="number" onfocus="handleFocus(this)" onblur="handleBlur(this)" value="<?=trim(str_replace(",","",str_replace(".","",number_format($limit->nakit_diger_takas_fiyat,0)))) ?>" name="nakit_diger_takas_fiyat" class="form-control" required="">
      </div>
        </div>
        <div class="col">
            

      <div class="form-group">
        <label for="formClient-Name"> Vadeli Diğer Cihaz Takas Fiyat <span style="font-weight:normal">Alt Limit</span></label>
        <input type="number" onfocus="handleFocus(this)" onblur="handleBlur(this)" value="<?=trim(str_replace(",","",str_replace(".","",number_format($limit->vadeli_diger_takas_fiyat,0)))) ?>" name="vadeli_diger_takas_fiyat" class="form-control" required="">
      </div>
        </div>
     </div>
     
     
  
 




      
 
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <div class="row">
        <div class="col text-right"><button style="    width: 100%;" type="submit" class="btn  btn-success"><i class="far fa-save"></i> Satış Temsilcisi Fiyat Limitlerini Güncelle</button></div>
      </div>
    </div>
    <!-- /.card-footer-->

  </div>

 
   </form>



   <script>
        function handleFocus(input) {
            if (input.value === '0') {
                input.value = '';
            }
        }

        function handleBlur(input) {
            if (input.value === '') {
                input.value = '0';
            }
        }
    </script>
</body>
</html>