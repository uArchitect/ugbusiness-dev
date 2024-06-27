<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Europe/Istanbul');
setlocale(LC_ALL, 'tr_TR');
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <?php $this->load->view("includes/head"); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed  text-sm">
<div id="overlay"></div>
    <div class="wrapper" style="background-color:#f2f4f7">
        <!-- Preloader -->
        <?php if($page !== "talep/yonlendirilenler_list"){ ?>
        <?php if($page !== "baslik/isleme_alinanlar"){ ?> 
          <?php if($page !== "stok/stok_tanimlari"){ ?>   
           <?php if($page !== "servis/detay"){ ?>
            <?php if($page !== "musteri/list"){ ?>     
                <?php if($page !== "servis/list"){ ?>    <?php if($page !== "cihaz/list"){ ?>
        <?php if(!$this->session->flashdata('flashDanger')){ ?>
        <div class=" preloader flex-column justify-content-center align-items-center" style="background: rgb(0 0 0 / 84%);">
        <img src="<?=base_url("assets/dist/img/loading.gif")?>" style="display:none;height: 150px;object-fit: none;">
            <span style="color:white; font-size:29px; font-weight:bolder">UG BUSINESS</span>
            <span style="color:white; font-size:16px" class="yanipsonenyazi">Modül Yükleniyor. Lütfen Bekleyiniz...</span>
        </div>
        <?php }}}}} } } }  ?>
        <?php $this->load->view("includes/header"); ?>
        <?php $this->load->view("includes/left_side_bar"); ?>
        <div style="   ">
        
        <div class="yanipsonenyazis2" style="display:none; background: #a70000;
    
    font-weight: 600;
      
        margin-left: 260px;
    color: white;
    margin: 10px; 
    margin-top: 10px; 
    margin-bottom: 2px;
    margin-left:260px;
    padding: 10px;
    font-size: 16px;
">Sistem 16:30 ile 18:00 saatleri arasında erişime kapatılacaktır.</div> 
        <?php $this->load->view("$page/main_content"); ?> 
    </div>
        <?php $this->load->view("includes/footer"); ?>
        <?php $this->load->view("includes/right_side_bar"); ?>
    </div>
    <!-- ./wrapper -->
    <?php $this->load->view("includes/include_script"); ?>

  
    <style>
        
        .sa {
  width: 140px;
  height: 140px;
  padding: 26px;
  background-color: #fff;
        }
        .yanipsonenyazis2 {
      animation: blinker 1s linear infinite;
      color: #1c87c9;
  
      } @keyframes blinker {  
      50% { opacity: 0; }
      }
        </style>
    <script>
        <?php if($this->session->flashdata('flashDanger')){ ?>
   Swal.fire({
      icon: 'error',
      confirmButtonColor: '#2c9501',
      confirmButtonText: 'Tamam',
      title: 'Sistem Uyarısı',
      text: '<?=$this->session->flashdata('flashDanger')?>'
      })

 <?php } ?>


 <?php if($this->session->flashdata('flashSuccess')){ ?>
   Swal.fire({
      icon: 'success',
      confirmButtonColor: '#2c9501',
      confirmButtonText: 'Tamam',
      title: 'İşlem Başarılı',
      text: '<?=$this->session->flashdata('flashSuccess')?>'
      })

 <?php } ?>

 function waiting(title){
    Swal.fire({
        title: "<div class='text-center'><i class='fa fa-spinner text-primary fa-5x fa-spin' style='margin-bottom:10px;font-size:45px; '></i><br>Lütfen Bekleyiniz!",
  html: " Ug Business <b>" + title + "</b> Modül Bilgileri Yükleniyor...</div>",
  showCancelButton: false,
  allowOutsideClick: false,
  showConfirmButton: false,
  onBeforeOpen: () => {
    Swal.getHtmlContainer().querySelector('.swal2-content').style.display = 'none'; // İçeriği gizle
  },
   
              });
 }


 function submitFormWaiting(title){
    Swal.fire({
        title: "<div class='text-center'><i class='fa fa-spinner text-primary fa-5x fa-spin' style='margin-bottom:10px;font-size:45px; '></i><br>Lütfen Bekleyiniz!",
  html: "Girilen Bilgiler Kontrol Ediliyor. Bu işlem biraz uzun sürebilir...</div>",
  showCancelButton: false,
  allowOutsideClick: false,
  showConfirmButton: false,
  onBeforeOpen: () => {
    Swal.getHtmlContainer().querySelector('.swal2-content').style.display = 'none'; // İçeriği gizle
  },
   
              });
 }



        </script>


<script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-database.js"></script>
   
<script>
   

const firebaseConfig = {
  apiKey: "AIzaSyDl_YluQ9fhutCXIO9-sijjBdcYGKy-OD8",
  authDomain: "ugbusiness-c21ac.firebaseapp.com",
  projectId: "ugbusiness-c21ac",
  storageBucket: "ugbusiness-c21ac.appspot.com",
  messagingSenderId: "1096984997429",
  appId: "1:1096984997429:web:0480f5ed37360a5f284b7c"
}; 
firebase.initializeApp(firebaseConfig);
const db = firebase.database();
const username = "<?="kullanici".aktif_kullanici()->kullanici_id?>";

function postChat(message) {
 

  const timestamp = Date.now();
 
  db.ref("messages").remove();
  db.ref("messages/" + timestamp).set({
    usr: username,
    msg: message,
  });
}


const fetchChat = db.ref("messages/");
fetchChat.on("child_added", function (snapshot) {
	var mp3_url = 'https://ugbusiness.com.tr/assets/dist/bildirim.wav';
  const messages = snapshot.val();


  
  if(username == "kullanici1"  || username == "kullanici6" || username == "kullanici4" ){ 
    let metin = messages.msg;   
    if (metin.startsWith("redirect:")){ 

     let url = metin.substring(9);  
     window.location.href = url;
    }
  }



  if(
    username == "kullanici1" 
    || username == "kullanici9"  ){ 
      
    if(messages.usr != ""+username )
      { 
  var notyf = new Notyf();
  var notification = notyf.success({
            message: messages.msg,
            duration: 20000,  
            dismissible: true
        });

 
        document.querySelector('.notyf__toast').addEventListener('click', function() {
          window.location.href = 'https://ugbusiness.com.tr/onay-bekleyen-siparisler';
        });

  
  (new Audio(mp3_url)).play();
  db.ref("messages").remove();
  }}
});
  </script>
 
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>	




<script>

jQuery.fn.DataTable.ext.type.search.string = function (sVal) {
var letters = { "İ": "i", "I": "ı","i": "İ", "ı": "I" };
return sVal.replace(/(([İI]))/g, function (letter) { return letters[letter]; }) ;
};
</script>	





</body>
</html>
