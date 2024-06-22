<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Europe/Istanbul');
setlocale(LC_ALL, 'tr_TR');
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <?php $this->load->view("includes/head"); ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed  text-sm">
    <div class="wrapper" style="background-color:#f2f4f7">
      
        <div style="   ">
    
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
      animation: blinker 0.3s linear infinite;
      color: #1c87c9;
  
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





 







</body>
</html>
