<!DOCTYPE html>
 <!--
 This is a starter template page. Use this page to start your new project from
 scratch. This page gets rid of all links and provides the needed markup only.
 -->
 <html lang="en">
 <head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
 
   <!-- Google Font: Source Sans Pro -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
   <!-- Font Awesome Icons -->
   <link rel="stylesheet" href="<?=base_url("assets")?>/tv/plugins/fontawesome-free/css/all.min.css">
   <!-- Theme style -->
   <link rel="stylesheet" href="<?=base_url("assets")?>/tv/dist/css/adminlte2.min.css">
 
   <style>
       @media (min-width: 1200px) {
 
         .container,
         .container-lg,
         .container-md,
         .container-sm,
         .container-xl {
           max-width: 100% !important;
         }
       }
 
       .col {
         padding: 1px;
       }
 
       .card-header {
         border-radius: 0;
         text-align: center;
       }
 
       .card-body {
         border-radius: 0;
         padding: 4px;
         padding-left: 12px;
         padding-right: 12px;
       }
 
       .card {
         border-radius: 0;
         margin-bottom: 0px;
       }
 
       .col-12 {
         padding-right: 0px;
       }
     </style>
 </head>
 <body class="hold-transition layout-top-nav">
 
 <!-- ./wrapper -->
 <div class="wrapper" style="margin-left:0px ">
       <!-- Navbar -->
       <nav class="main-header navbar navbar-expand-md navbar-light navbar-white" style="background-color: #0003bd; color: #ffffff; padding: 0;margin-left: 0;">
         <div class="container" style="
     text-align: center;
      
     font-size: 22px;
     font-weight: bolder;
     padding: 13px;
     padding: 13px;justify-content: space-between; display: inline-flex ; width: 97%;
 "> 
  <span style="font-size:36px"><?=date("d.m.Y")?> </span>
 
 <span style=" font-size:36px;        margin-left: -92px;color:#ffffff">UMEX ÜRETİM LİSTESİ </span>
 <span id="saat" style="font-size:36px"></span>

<script>
function saatiGuncelle() {
    const now = new Date();
    const saat = now.getHours().toString().padStart(2, '0');
    const dakika = now.getMinutes().toString().padStart(2, '0');
    const saniye = now.getSeconds().toString().padStart(2, '0');
    document.getElementById('saat').innerText = `${saat}:${dakika}:${saniye}`;
}

// İlk çağırma ve sonra her saniyede bir yenileme
saatiGuncelle();
setInterval(saatiGuncelle, 1000);
</script>

 
 
 </div>
       </nav>
       <!-- /.navbar -->
       <!-- Content Wrapper. Contains page content -->
       <div class="content-wrapper " style="display: grid
 ;background:#f7f7f7;        margin-left: 0px;">
         <!-- Content Header (Page header) -->
         <!-- /.content-header -->
         <!-- Main content -->
         <div class="content" style="    height: 100%;padding:0">
           <div class="container" style="     height: 100%;       max-width: 100%;">
             <div class="row  " style="    height: 100%;">
               <div class="col" style="    height: 100%;">
                 <div class="card card-dark" style="    height: 100%;">
                   <div class="card-header text-bold" style="background:#000589">
                     <span style="font-weight:400;font-size:13px"><?=$d1?></span>
                     <br>PAZARTESİ
                   </div>
                   <div class="card-body" style="height:500px">


                  
                    <?php 
                    foreach ($data as $d) {
                      if(date("Y-m-d",strtotime($d->uretim_tarihi)) != date("Y-m-d",strtotime($d1))){
                        continue;
                      }
                      ?>
 <div class="row">
                       <div class="col mb-2" style="<?=($d->guncelleme_notu != "") ? "border-radius:5px;border:2px solid red;":"border:1px solid gray;border-radius:3px;"?>padding-left: 0px;margin-right: -1px; margin-top: -1px;">
                       <span style="display: block;background:#070db9;  padding: 5px;color: white;border-radius: 5px;border-radius: 3px 3px 0 0;">
                         <span style="min-width: 230px; width: 230px;    margin-left:5px">
                         
                         <div style="
    height: 15px;
    width: 15px;
    background: <?=$d->hex_code?>;
    border-radius: 50%;
    display: inline-block;
    margin-bottom: -2px;
    margin-right: 5px;    border: 2px solid #ffffff;
">
    
</div>
                         
                         
                         <b style="color:white;"><?=$d->urun_adi?> / <?=($d->renk_adi == "Umex Grisi")?"Gri":$d->renk_adi?></b>
                           </span>
                         </span>
                         <span style="height: 6px;"></span>
                         <div style="padding-left:10px;background:white;border:0px solid;border-top:0px;border-top: 0px; border-radius: 0px 0px 3px 3px;"> <?=$d->baslik_bilgisi?> 
                        
                         <?php 
                         if($d->guncelleme_notu != ""){
                          ?>
                          <span class="text-danger" style="font-size: 12px; font-weight: 400; color: red !important;"><?=$d->guncelleme_notu?></span>
                          <?php
                         }
                         ?>
                         <?php 
                         if($d->kayit_notu != ""){
                          ?>
                            <br><span class="text-success" style="font-size: 12px; font-weight: 700;  "><?=$d->kayit_notu?></span>
                            <?php
                         }
                         ?>
                        </div>
                       </div>
                       </div>
                      <?php
                    }
                    ?>
                      
                   


                   </div>
                 </div>
                 <!-- /.card -->
               </div>
               <div class="col" style="    height: 100%;">
                 <div class="card card-dark  " style="    height: 100%;">
                   <div class="card-header text-bold" style="background:#000589">
                     <span style="font-weight:400;font-size:13px"><?=$d2?></span>
                     <br>SALI
                   </div>
                   <div class="card-body" style="height:500px">



                   <?php 
                    foreach ($data as $d) {
                      if(date("Y-m-d",strtotime($d->uretim_tarihi)) != date("Y-m-d",strtotime($d2))){
                        continue;
                      }
                      ?>
 <div class="row">
                       <div class="col mb-2" style="<?=($d->guncelleme_notu != "") ? "border-radius:5px;border:2px solid red;":"border:1px solid gray;border-radius:3px;"?>padding-left: 0px;margin-right: -1px; margin-top: -1px;">
                       <span style="display: block;background:#070db9;  padding: 5px;color: white;border-radius: 5px;border-radius: 3px 3px 0 0;">
                         <span style="min-width: 230px; width: 230px;    margin-left:5px">
                             
                         <div style="
    height: 15px;
    width: 15px;
    background: <?=$d->hex_code?>;
    border-radius: 50%;
    display: inline-block;
    margin-bottom: -2px;
    margin-right: 5px;    border: 2px solid #ffffff;
">
    
</div>
                         <b style="color:white;"><?=$d->urun_adi?> /  <?=($d->renk_adi == "Umex Grisi")?"Gri":$d->renk_adi?></b>
                           </span>
                         </span>
                         <span style="height: 6px;"></span>
                         <div style="padding-left:10px;background:white;border:0px solid;border-top:0px;border-top: 0px; border-radius: 0px 0px 3px 3px;"> <?=$d->baslik_bilgisi?> 
                        
                         <?php 
                         if($d->guncelleme_notu != ""){
                          ?>
                          <span class="text-danger" style="font-size: 12px; font-weight: 400; color: red !important;"><?=$d->guncelleme_notu?></span>
                          <?php
                         }
                         ?>
                         <?php 
                         if($d->kayit_notu != ""){
                          ?>
                          <br><span class="text-success" style="font-size: 12px; font-weight: 700;  "><?=$d->kayit_notu?></span>
                          <?php
                         }
                         ?>
                        </div>
                       </div>
                       </div>
                      <?php
                    }
                    ?>

 
                   </div>
                 </div>
                 <!-- /.card -->
               </div>
               <div class="col" style="    height: 100%;">
                 <div class="card card-dark  " style="    height: 100%;">
                   <div class="card-header text-bold" style="background:#000589">
                     <span style="font-weight:400;font-size:13px"><?=$d3?></span>
                     <br>ÇARŞAMBA
                   </div>
                   <div class="card-body" style="height:500px">

                   <?php 
                    foreach ($data as $d) {
                      if(date("Y-m-d",strtotime($d->uretim_tarihi)) != date("Y-m-d",strtotime($d3))){
                        continue;
                      }
                      ?>
 <div class="row">
                       <div class="col mb-2" style="<?=($d->guncelleme_notu != "") ? "border-radius:5px;border:2px solid red;":"border:1px solid gray;border-radius:3px;"?>padding-left: 0px;margin-right: -1px; margin-top: -1px;">
                       <span style="display: block;background:#070db9;  padding: 5px;color: white;border-radius: 5px;border-radius: 3px 3px 0 0;">
                         <span style="min-width: 230px; width: 230px;    margin-left:5px">
                          
                         <div style="
    height: 15px;
    width: 15px;
    background: <?=$d->hex_code?>;
    border-radius: 50%;
    display: inline-block;
    margin-bottom: -2px;
    margin-right: 5px;    border: 2px solid #ffffff;
">
    
</div>
                         <b style="color:white;"><?=$d->urun_adi?> /  <?=($d->renk_adi == "Umex Grisi")?"Gri":$d->renk_adi?></b>
                           </span>
                         </span>
                         <span style="height: 6px;"></span>
                         <div style="padding-left:10px;background:white;border:0px solid;border-top:0px;border-top: 0px; border-radius: 0px 0px 3px 3px;"> <?=$d->baslik_bilgisi?> 
                        
                         <?php 
                         if($d->guncelleme_notu != ""){
                          ?>
                          <span class="text-danger" style="font-size: 12px; font-weight: 400; color: red !important;"><?=$d->guncelleme_notu?></span>
                          <?php
                         }
                         ?>
                         <?php 
                         if($d->kayit_notu != ""){
                          ?>
                          <br><span class="text-success" style="font-size: 12px; font-weight: 700;  "><?=$d->kayit_notu?></span>
                          <?php
                         }
                         ?>
                        </div>
                       </div>
                       </div>
                      <?php
                    }
                    ?>

                   </div>
                 </div>
                 <!-- /.card -->
               </div>
               <div class="col" style="    height: 100%;">
                 <div class="card card-dark" style="    height: 100%;">
                   <div class="card-header text-bold" style="background:#000589">
                     <span style="font-weight:400;font-size:13px"><?=$d4?></span>
                     <br>PERŞEMBE
                   </div>
                   <div class="card-body" style="height:500px">

                   <?php 
                    foreach ($data as $d) {
                      if(date("Y-m-d",strtotime($d->uretim_tarihi)) != date("Y-m-d",strtotime($d4))){
                        continue;
                      }
                      ?>
 <div class="row">
                       <div class="col mb-2" style="<?=($d->guncelleme_notu != "") ? "border-radius:5px;border:2px solid red;":"border:1px solid gray;border-radius:3px;"?>padding-left: 0px;margin-right: -1px; margin-top: -1px;">
                       <span style="display: block;background:#070db9;  padding: 5px;color: white;border-radius: 5px;border-radius: 3px 3px 0 0;">
                         <span style="min-width: 230px; width: 230px;    margin-left:5px">
                          
                         <div style="
    height: 15px;
    width: 15px;
    background: <?=$d->hex_code?>;
    border-radius: 50%;
    display: inline-block;
    margin-bottom: -2px;
    margin-right: 5px;    border: 2px solid #ffffff;
">
    
</div>
                         <b style="color:white;"><?=$d->urun_adi?> /  <?=($d->renk_adi == "Umex Grisi")?"Gri":$d->renk_adi?></b>
                           </span>
                         </span>
                         <span style="height: 6px;"></span>
                         <div style="padding-left:10px;background:white;border:0px solid;border-top:0px;border-top: 0px; border-radius: 0px 0px 3px 3px;"> <?=$d->baslik_bilgisi?> 
                        
                         <?php 
                         if($d->guncelleme_notu != ""){
                          ?>
                          <span class="text-danger" style="font-size: 12px; font-weight: 400; color: red !important;"><?=$d->guncelleme_notu?></span>
                          <?php
                         }
                         ?>
                         <?php 
                         if($d->kayit_notu != ""){
                          ?>
                           <br><span class="text-success" style="font-size: 12px; font-weight: 700;  "><?=$d->kayit_notu?></span>
                           <?php
                         }
                         ?>
                        </div>
                       </div>
                       </div>
                      <?php
                    }
                    ?>

                   </div>
                 </div>
                 <!-- /.card -->
               </div>
               <div class="col" style="    height: 100%;">
                 <div class="card card-dark" style="    height: 100%;">
                   <div class="card-header text-bold" style="background:#000589">
                     <span style="font-weight:400;font-size:13px"><?=$d5?></span>
                     <br>CUMA
                   </div>
                   <div class="card-body" style="height:500px!important">
                   <?php 
                    foreach ($data as $d) {
                      if(date("Y-m-d",strtotime($d->uretim_tarihi)) != date("Y-m-d",strtotime($d5))){
                        continue;
                      }
                      ?>
 <div class="row">
                       <div class="col mb-2" style="<?=($d->guncelleme_notu != "") ? "border-radius:5px;border:2px solid red;":"border:1px solid gray;border-radius:3px;"?>padding-left: 0px;margin-right: -1px; margin-top: -1px;">
                       <span style="display: block;background:#070db9;  padding: 5px;color: white;border-radius: 5px;border-radius: 3px 3px 0 0;">
                         <span style="min-width: 230px; width: 230px;    margin-left:5px">
                         <div style="
    height: 15px;
    width: 15px;
    background: <?=$d->hex_code?>;
    border-radius: 50%;
    display: inline-block;
    margin-bottom: -2px;
    margin-right: 5px;    border: 2px solid #ffffff;
">
    
</div> 
                         
                         <b style="color:white;"><?=$d->urun_adi?> /  <?=($d->renk_adi == "Umex Grisi")?"Gri":$d->renk_adi?></b>
                           </span>
                         </span>
                         <span style="height: 6px;"></span>
                         <div style="padding-left:10px;background:white;border:0px solid;border-top:0px;border-top: 0px; border-radius: 0px 0px 3px 3px;"> <?=$d->baslik_bilgisi?> 
                        
                         <?php 
                         if($d->guncelleme_notu != ""){
                          ?>
                          <span class="text-danger" style="font-size: 12px; font-weight: 400; color: red !important;"><?=$d->guncelleme_notu?></span>
                          <?php
                         }
                         ?>
                         <?php 
                         if($d->kayit_notu != ""){
                          ?>
                          <br><span class="text-success" style="font-size: 12px; font-weight: 700;  "><?=$d->kayit_notu?></span>
                          <?php
                         }
                         ?>
                        </div>
                       </div>
                       </div>
                      <?php
                    }
                    ?>
                   </div>
                 </div>
                 <!-- /.card -->
               </div>
               <div class="col" style="    height: 100%;">
                 <div class="card card-warning  " style="    height: 100%;">
                   <div class="card-header text-bold">
                     <span style="font-weight:400;font-size:13px"><?=$d6?></span>
                     <br>PAZARTESİ 
                   </div>
                   <div class="card-body" style="height:500px">
                   <?php 
                    foreach ($data as $d) {
                      if(date("Y-m-d",strtotime($d->uretim_tarihi)) != date("Y-m-d",strtotime($d6))){
                        continue;
                      }
                      ?>
 <div class="row">
                       <div class="col mb-2" style="<?=($d->guncelleme_notu != "") ? "border-radius:5px;border:2px solid red;":"border:1px solid gray;border-radius:3px;"?>padding-left: 0px;margin-right: -1px; margin-top: -1px;">
                       <span style="display: block;background:#070db9;  padding: 5px;color: white;border-radius: 5px;border-radius: 3px 3px 0 0;">
                         <span style="min-width: 230px; width: 230px;    margin-left:5px">
                            
                         <div style="
    height: 15px;
    width: 15px;
    background: <?=$d->hex_code?>;
    border-radius: 50%;
    display: inline-block;
    margin-bottom: -2px;
    margin-right: 5px;    border: 2px solid #ffffff;
">
    
</div>
                         <b style="color:white;"><?=$d->urun_adi?> /  <?=($d->renk_adi == "Umex Grisi")?"Gri":$d->renk_adi?></b>
                           </span>
                         </span>
                         <span style="height: 6px;"></span>
                         <div style="padding-left:10px;background:white;border:0px solid;border-top:0px;border-top: 0px; border-radius: 0px 0px 3px 3px;"> <?=$d->baslik_bilgisi?> 
                        
                         <?php 
                         if($d->guncelleme_notu != ""){
                          ?>
                          <span class="text-danger" style="font-size: 12px; font-weight: 400; color: red !important;"><?=$d->guncelleme_notu?></span>
                          <?php
                         }
                         ?>
 <?php 
                         if($d->kayit_notu != ""){
                          ?>
                          <br><span class="text-success" style="font-size: 12px; font-weight: 700;  "><?=$d->kayit_notu?></span>
                          <?php
                         }
                         ?>


                        
                        </div>
                       </div>
                       </div>
                      <?php
                    }
                    ?>
                   </div>
                 </div>
                 <!-- /.card -->
               </div>
               <div class="col" style=" height: 100%;">
                 <div class="card card-success mb-0">
                   <div class="card-header text-bold"  style="background:#000589">
                     <span style="font-weight:600;font-size:13px">12:30</span>
                     <br>YEMEK MENÜSÜ
                   </div>
                   <div class="card-body">
                     <div class="row">
                       <div class="col-12 text-center" style="  background-size: cover; background-color:rgba(255, 255, 255, 0.92); background-blend-mode: lighten; padding-left: 0px;">
                         <span style="font-weight: 400; font-size: sm;">
                         
                         <?php
        $items = explode('#', $yemek->yemek_detay);

        foreach ($items as $y) {
          echo $y."<br>";
        }
      ?>  </span>
                       </div>
                     </div>
                   </div>
                 </div>
                 <!-- /.card -->
                 <div class="card  card-danger  ">
                   <div class="card-header text-bold  " style="background:#040a86;font-size:13px">KART OKUTMAYANLAR </div>
                   <div class="card-body" style="    height: 383px;">
                     <div class="row">
                       <div class="col-12" style="padding-left: 0px;">
                         <span style="display: block;background: #dbdbdb87;padding: 5px;color: white;border-radius: 5px;border-radius: 3px 3px 0 0;">
                           <span style="min-width: 230px; width: 230px;   margin-left:5px">
                             <b style="color:#0f3979;font-size:10px;">Geliştirme Aşamasında...</b>
                           </span>
                         </span>         
                               
                        
                 
                       </div>
                     </div>
                   </div>
                 </div>
                 <!-- /.card -->
               </div>
               <!-- /.col-md-6 -->
               <!-- /.col-md-6 -->
             </div>
             <!-- /.row -->
           </div>
           <!-- /.container-fluid -->
         </div>
         <!-- /.content -->
       </div>
       <!-- /.content-wrapper -->
       <!-- Control Sidebar -->
       <aside class="control-sidebar control-sidebar-dark">
         <!-- Control sidebar content goes here -->
       </aside>
       <!-- /.control-sidebar -->
       <!-- Main Footer -->
       <footer class="main-footer" style="position: relative;margin-top:-20px;color:#2b4883;margin-left: 0;">
         <!-- To the right -->
         <div class="text-center  " style="margin-bottom:-30px">
           <img src="https://ugbusiness.com.tr/uploads/umexlogo.svg"></img>
         </div>
         <div class="float-right d-none d-sm-inline">
          
         </div>
         <!-- Default to the left --> ÜRETİM DEPARTMANI
       </footer>
 </div>
 <!-- REQUIRED SCRIPTS -->
 
 <!-- jQuery --> 
 <script src="<?=base_url("assets")?>/tv/plugins/jquery/jquery.min.js"></script>
 <!-- Bootstrap 4 -->
 <script src="<?=base_url("assets")?>/tv/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
 <!-- AdminLTE App -->
 <script src="<?=base_url("assets")?>/tv/dist/js/adminlte.min.js"></script>
 <script>
  setInterval(function() {
  //  window.location.href = window.location.href;
  }, 5000);
</script>
 </body>
 </html>