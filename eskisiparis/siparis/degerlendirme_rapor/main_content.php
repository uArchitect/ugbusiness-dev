<div class="content-wrapper">


 

<section class="content mt-3">
    <div class="row">




    
        <div class="col-xs-12">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
            <?php
                        $birinciSoruToplam  = 0;
                        $ikinciSoruToplam   = 0;
                        $ucuncuSoruToplam   = 0;
                        $dorduncuSoruToplam = 0;

                        $soruAdet         = 0;
                        $birinciOrtalama  = 0;
                        $ikinciOrtalama   = 0;
                        $ucuncuOrtalama   = 0;
                        $dorduncuOrtalama = 0;
                        $color1 = "red";
                        $color2 = "red";
                        $color3 = "red";
                        $color4 = "red";

                        foreach ($products as $value) {
                            if($value->degerlendirme_soru_1 != 0){
                                $birinciSoruToplam  += $value->degerlendirme_soru_1;
                                $ikinciSoruToplam   += $value->degerlendirme_soru_2;
                                $ucuncuSoruToplam   += $value->degerlendirme_soru_3;
                                $dorduncuSoruToplam += $value->degerlendirme_soru_4;
                                $soruAdet++;
                            }
                        }
                        if($soruAdet > 0){
                            $birinciOrtalama  = number_format($birinciSoruToplam  / $soruAdet, 2);
                            $ikinciOrtalama   = number_format($ikinciSoruToplam   / $soruAdet, 2);
                            $ucuncuOrtalama   = number_format($ucuncuSoruToplam   / $soruAdet, 2);
                            $dorduncuOrtalama = number_format($dorduncuSoruToplam / $soruAdet, 2);

                            $color1 = ($birinciOrtalama < 2)  ? "red" : (($birinciOrtalama < 4)  ? "yellow" : "green");
                            $color2 = ($ikinciOrtalama < 2)   ? "red" : (($ikinciOrtalama < 4)   ? "yellow" : "green");
                            $color3 = ($ucuncuOrtalama < 2)   ? "red" : (($ucuncuOrtalama < 4)   ? "yellow" : "green");
                            $color4 = ($dorduncuOrtalama < 2) ? "red" : (($dorduncuOrtalama < 4) ? "yellow" : "green");
                        }
                       

                    ?>
                <div class="small-box bg-<?=$color1?>">
                <div class="inner text-center">
                    <h3 style="font-size:60px">
                    <?=$birinciOrtalama?>
                    </h3>
                    <p  style="padding-left:20px;padding-right:20px;min-height:30px;max-height:30px">Teknik servis ekibimizin size karşı hitap ve davranışlarını değerlendirin.
                <br>
                <div class="row">
                        <style>
                            .fa-star{
                                font-size:10px
                            }
                            </style>
                        

                    </div>
                </p>
                </div>
               
                <a href="#" class="small-box-footer"> 1. SORU PUAN ORTALAMASI  
                </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-<?=$color2?>">
                <div class="inner text-center">
                    <h3 style="font-size:60px">
                    <?=$ikinciOrtalama?>
                    </h3>
                    <p  style="padding-left:20px;padding-right:20px;min-height:30px;max-height:30px">Eğitmenin size karşı hitap ve davranışlarını değerlendirin.<br>
                       <div class="row">
                        <style>
                            .fa-star{
                                font-size:10px
                            }
                            </style>
                       

                    </div>
                </p>
                </div>
               
                <a href="#" class="small-box-footer"> 2. SORU PUAN ORTALAMASI
                </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-<?=$color3?>">
                <div class="inner text-center">
                    <h3 style="font-size:60px">
                    <?=$ucuncuOrtalama?>
                </h3>
                    <p  style="padding-left:20px;padding-right:20px;min-height:30px;max-height:30px">Sorularınız net ve eksiksiz cevaplandı mı?<br><br>
                
                    <div class="row">
                        <style>
                            .fa-star{
                                font-size:10px
                            }
                            </style>
                     

                    </div>
                </p>
                </div>
                
                <a href="#" class="small-box-footer">3. SORU PUAN ORTALAMASI
                </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-<?=$color4?>">
                <div class="inner text-center">
                    <h3 style="font-size:60px">
                    <?=$dorduncuOrtalama?>
                </h3>
                    <p  style="padding-left:20px;padding-right:20px;min-height:30px;max-height:30px">Bizi tavsiye eder misiniz?<br><br>
                    <div class="row">
                        <style>
                            .fa-star{
                                font-size:10px
                            }
                            </style>
                       
                        
                    </div></p>
                </div>
               
                <a href="#" class="small-box-footer"> 4. SORU PUAN ORTALAMASI
                </a>
                </div>
            </div>
            </div>
            <div class="box">
                <div class="box-body">
                <style>
  #smsgonderilensiparislertablo td {
    white-space: nowrap;
  }

  #smsgonderilensiparislertablo td:last-child {
    white-space: normal;
  }
  
</style>
 
                    <table id="smsgonderilensiparislertablo" class="table table-bordered table-striped" style="width:100%;">
                        <thead>
                            <tr>
                                <th>Sipariş Bilgileri</th>     
                                <th>Müşteri Bilgileri</th>
                                <th>Merkez Bilgileri</th>       
                                <th>Satış Temsilcisi</th>     
                                <th>Teknik servis ekibimizin size karşı hitap ve davranışlarını değerlendirin.</th>      
                                <th>Eğitmenin size karşı hitap ve davranışlarını değerlendirin.</th>
                                <th>Sorularınız net ve eksiksiz cevaplandı mı?</th>
                                <th>Bizi tavsiye eder misiniz?</th>
                                <th>Öneri</th>
                               
                            </tr>
                        </thead>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

</div>






<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
 



    <script type="text/javascript">
        $(document).ready(function() {

        
            $('#smsgonderilensiparislertablo').DataTable({
                "processing": true,
                "serverSide": true,
                "pageLength": 11,
                scrollX: true,
                "ajax": {
                    "url": "<?php echo site_url('siparis/sms_gonderilen_siparisler'); ?>",
                    "type": "GET"
                },
                "language": {
                        "processing": '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>'
                    },
                "columns": [
                    { "data": 0 },
                    { "data": 1 },
                    { "data": 2 },
                    { "data": 3 },
                    { "data": 4 }, 
                    { "data": 5 }, 
                    { "data": 6 }, 
                    { "data": 7 }, 
                    { "data": 8 }, 
                ]
            });
    
             
             
        });







      
    </script>







<script>
  
  function showWindow($url) {
        
        var width = 950;
      var height = 720;

    
      var left = (screen.width / 2) - (width / 2);
      var top = (screen.height / 2) - (height / 2);
      var newWindow = window.open($url, 'Yeni Pencere', 'width=' + width + ',height=' + height + ',top=' + top + ',left=' + left);

     
      var interval = setInterval(function() {
          if (newWindow.closed) {
              clearInterval(interval);
              var currentPage = $('#smsgonderilensiparislertablo').DataTable().page();
              $('#smsgonderilensiparislertablo').DataTable().ajax.reload(function() {
                  $('#smsgonderilensiparislertablo').DataTable().page(currentPage).draw(false);
              });
              
            
          }
      }, 1000);
  };
  


  
  function showWindow2($url) {
        
        var width = 950;
      var height = 720;

    
      var left = (screen.width / 2) - (width / 2);
      var top = (screen.height / 2) - (height / 2);
      var newWindow = window.open($url, 'Yeni Pencere', 'width=' + width + ',height=' + height + ',top=' + top + ',left=' + left);

     
      var interval = setInterval(function() {
          if (newWindow.closed) {
              clearInterval(interval);
          
                location.reload();
            
          }
      }, 1000);
  };
  </script>