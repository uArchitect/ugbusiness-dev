 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12" style="text-align: center; margin-top:10%;">
            <i style="font-size:40px;color:red;" class="fas fa-lock"></i>
            <h1 class="m-0 mt-2">Modül Kilitli</h1>
            <h1 class="m-0" style="    width: 550px;
    display: inline-block;font-weight:normal;font-size:17px">Bordroları görüntülemek için
    <?php

function formatPhoneNumber($phoneNumber) {
   
    $phoneNumber = str_replace(" ", "", $phoneNumber);
    
  
    $prefix = substr($phoneNumber, 0, 3);
    $suffix = substr($phoneNumber, -2);
    
  
    $maskedMiddle = str_repeat("*", strlen($phoneNumber) - 5);
    

    return $prefix . $maskedMiddle . $suffix;
}

$phoneNumber = aktif_kullanici()->kullanici_bireysel_iletisim_no;
$formattedPhoneNumber = formatPhoneNumber($phoneNumber);
echo $formattedPhoneNumber;

?>
    
    no'lu cep telefonunuza gönderilen tek kullanımlık güvenlik kodunu giriniz.</h1>
         <h1 class="m-0 mt-2" style="font-weight: normal; font-size: 15px; color: #1d7dfa;" id="countdown">Modül Kilitli</h1>
      </div><!-- /.col -->
           
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<section class="content col-md-3" style="margin: auto;">
<div class="card card-danger">
   
    <form class="form-horizontal" method="POST" action="<?php echo site_url('bordro/kilit_kontrol');?>">
    
    <div class="card-body">

     

      <div class="form-group">
        <label for="formClient-Code"> Güvenlik Kodu</label>
        <input type="text" class="form-control" name="txt_bordro_lock_value" placeholder="Güvenlik Kodunu Giriniz..." autofocus="">
      </div>
  
      
    </div>
    

    <div class="card-footer">
      <div class="row">
        <div class="col text-right"><button type="submit" style="width: inherit;" class="btn btn-flat btn-success"> Giriş Yap</button></div>
      </div>
    </div>
     

    </form>
  </div>
         
</section>
            </div>


            <script>
var seconds = 180;

function startCountdown() {
    var countdownElement = document.getElementById("countdown");

    var countdownInterval = setInterval(function() {
        seconds--;

        countdownElement.textContent = "Kalan süre: " + formatTime(seconds);

        if (seconds <= 0) {
            clearInterval(countdownInterval);  
            window.location.href = "<?=base_url("anasayfa")?>";  
        }
    }, 1000);  
}
 
function formatTime(seconds) {
    var minutes = Math.floor(seconds / 60);
    var remainingSeconds = seconds % 60;
    return minutes + " dakika " + remainingSeconds + " saniye";
}

 
window.onload = startCountdown;
</script>