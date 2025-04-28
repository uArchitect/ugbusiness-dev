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
<body class="hold-transition sidebar-mini layout-fixed layout-footer-fixed text-sm">
<div id="successread" style="display:none;background: #039503;/* display:none; */height: 100vh;/* min-height: 1080px; */width: 100%;z-index: 99999;position: absolute;align-items: center;display: none;text-align: center;">
<span style="
    font-size: 120px;
    color: white;
    margin: auto;
">QR OKUMA<br>BAŞARILI</span>
</div>

<div id="overlay"></div>
<div class="  " style="visibility:collapsed!important;"></div>
    <div class="wrapper" style="background-color:#f2f4f7">
        <!-- Preloader -->
        <?php if($page !== "talep/yonlendirilenler_list"){ ?>
        <?php if($page !== "baslik/isleme_alinanlar"){ ?> 
          <?php if($page !== "stok/stok_tanimlari"){ ?>   
           <?php if($page !== "servis/detay"){ ?>
            <?php if($page !== "musteri/list"){ ?>     
                <?php if($page !== "servis/list"){ ?>        <?php if($page !== "kullanici/satis_limit"){ ?>
                   <?php if($page !== "cihaz/list"){ ?>
                    <?php if($page !== "merkez/list"){
                      if($page !== "siparis/list"){ ?>
        <?php if(!$this->session->flashdata('flashDanger')){ ?>
    
        <?php }}}}} } }} }} }  ?>
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

 
<?php
 
if($this->session->userdata('aktif_kullanici_id') == 9 || $this->session->userdata('aktif_kullanici_id') == 4){
?>
 <style>
        #draggableButton {
            position: absolute;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none; cursor: context-menu;
            border-radius: 5px;
            z-index : 9999;
        }
    </style>
<button id="draggableButton" class="btn btn-danger" onclick="goBack()"><i class="fa fa-arrow-left"></i>  
Geri Git</button>
    <script>
        const button = document.getElementById("draggableButton");

        // Son konumu yükle
        const savedPosition = JSON.parse(localStorage.getItem("buttonPosition"));
        if (savedPosition) {
            button.style.left = savedPosition.x + "px";
            button.style.top = savedPosition.y + "px";
        }

        let offsetX, offsetY, isDragging = false;

        button.addEventListener("mousedown", (e) => {
            isDragging = true;
            offsetX = e.clientX - button.offsetLeft;
            offsetY = e.clientY - button.offsetTop;
            button.style.cursor = "grabbing";
        });

        document.addEventListener("mousemove", (e) => {
            if (isDragging) {
                let x = e.clientX - offsetX;
                let y = e.clientY - offsetY;
                button.style.left = x + "px";
                button.style.top = y + "px";
            }
        });

        document.addEventListener("mouseup", () => {
            if (isDragging) {
                localStorage.setItem("buttonPosition", JSON.stringify({
                    x: button.offsetLeft,
                    y: button.offsetTop
                }));
            }
            isDragging = false;
            button.style.cursor = "grab";
        });

        function goBack() {
            window.history.back();
        }
    </script>
<?php
}


?>
        <?php $this->load->view("$page/main_content"); ?> 
    </div>
        <?php $this->load->view("includes/footer"); ?>
        <?php $this->load->view("includes/right_side_bar"); ?>


  


    </div>
    <!-- ./wrapper -->
    <?php $this->load->view("includes/include_script"); ?>
    <style>
        @keyframes scroll-left {
            from {
                transform: translateX(10%);
            }
            to {
                transform: translateX(-100%);
            }
        }
        .footer div:hover {
            animation-play-state: paused;
        }
    </style>
  
    <style>
        
        .sa {
  width: 140px;
  height: 140px;
  padding: 26px;
  background-color: #fff;
        }
        .yanipsonenyazi3 {
     
      background:#060181;
      margin:0px;
      padding:5px;
      height: 30px;
      display: inline-block;
      }

        .yanipsonenyazis2 {
      animation: blinker 1s linear infinite;
      color: #1c87c9;
   
  
      } @keyframes blinker {  
      50% { opacity: 0; }
      }
        </style>
    <script>



function confirm_stop_system() {
    Swal.fire({
        title: "Dikkat",
        text: "Sistemi tamamen durdurmak istediğinize emin misiniz? Bu işlem sonunda tüm oturumlar sonlandırılacak ve ug business sistemi umex.com.tr adresine yönlendirilecektir.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: 'green',
        cancelButtonColor: '#d33',
        confirmButtonText: "Sistemi Durdur",
        cancelButtonText: "İptal"
    }).then((result) => {
        if (result.isConfirmed) {
            const endPoint = "https://ugbusiness.com.tr/anasayfa/acil_durum_update";
            fetch(endPoint)
                .then(data => {
                    postChatDanger('danger');
  
                })
                .then(res => {
                    console.log(res)
                });
        }
    })
}









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

function postChatDanger(message) {
 

 const timestamp = Date.now();

 db.ref("messages").remove();
 db.ref("messages/" + timestamp).set({
   usr: message,
   msg: message,
 });
}

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
  var mp3_url2 = 'https://ugbusiness.com.tr/assets/dist/yenitalep.wav';
  const messages = snapshot.val();


  
  if(username == "kullanici1"  || username == "kullanici6" || username == "kullanici4" ){ 
    let metin = messages.msg;   
    if (metin.startsWith("redirect:")){ 

     let url = metin.substring(9);  
     window.location.href = url;
    }
  }

  if(messages.usr == "danger" )
  { 
    const timestamp = Date.now();

    db.ref("messages").remove();
    db.ref("messages/" + timestamp).set({
      usr: "ugbusiness",
      msg: "ugbusiness",
    });
    window.location.href = 'https://ugbusiness.com.tr/logout';
    
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

  if(messages.msg == "TALEP"){
    (new Audio(mp3_url2)).play();
  }else{
    (new Audio(mp3_url)).play();
  }
 
  db.ref("messages").remove();
  }}
});


function changeTakasDurum(e,v){
        alert(e.value);
       
          $('#takas_alinan_merkez_id').val("1312");
         
      }
  </script>
 
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>	




<script>

jQuery.fn.DataTable.ext.type.search.string = function (sVal) {
var letters = { "İ": "i", "I": "ı","i": "İ", "ı": "I" };
return sVal.replace(/(([İI]))/g, function (letter) { return letters[letter]; }) ;
};
</script>	


<style>
        /* Modal Arkaplan */
        .popup-modal {
            display: none; /* Başlangıçta gizli */
            position: fixed;
            z-index: 999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
        }

        /* İçerik Kutusu */
        .popup-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            text-align: center;
            max-width: 90%;
        }

        /* Kapatma Butonu */
        .close-popup {
            cursor: pointer;
            background: red;
            color: white;
            border: none;
            padding: 8px 15px;
            margin-top: 10px;
            border-radius: 5px;
        }

        /* Resim */
        .popup-image {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
    </style>
       
       <div id="popupModal" class="popup-modal">
        <div class="popup-content">
            <img src="<?=base_url("uploads/yeniyemek.png")?>" alt="Günlük Duyuru" class="popup-image">
            <br>
            <button class="close-popup" onclick="closePopup()">Kapat</button>
        </div>
    </div>


    <script>
        // LocalStorage ile bugünün tarihini al
        function getTodayDate() {
            const today = new Date();
            return today.getFullYear() + "-" + (today.getMonth() + 1) + "-" + today.getDate();
        }

        // Pop-up'ı göster
        function showPopup() {
            document.getElementById("popupModal").style.display = "block";
        }

        // Pop-up'ı kapat ve tarihi kaydet
        function closePopup() {
            document.getElementById("popupModal").style.display = "none";
            localStorage.setItem("popupShownDate", getTodayDate());
        }

        // MUHASEBE RAPOR ÇAKIŞIYOR
    /*   window.onload = function () {
            const lastShownDate = localStorage.getItem("popupShownDate");
            if (lastShownDate !== getTodayDate()) {
                showPopup();
            }
        };*/
    </script>
</body>
</html>
