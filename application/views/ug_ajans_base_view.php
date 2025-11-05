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


<div id="overlay"></div>
<div class="  " style="visibility:collapsed!important;"></div>
    <div class="wrapper" style="background-color:#f2f4f7">
        <!-- Preloader -->
        
        <?php $this->load->view("includes/header_ugajans"); ?> 
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
    Swal.getHtmlContainer().querySelector('.swal2-content').style.display = 'none'; 
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
    Swal.getHtmlContainer().querySelector('.swal2-content').style.display = 'none'; 
  },
   
              });
 }



        </script>
 


       

</body>
</html>
