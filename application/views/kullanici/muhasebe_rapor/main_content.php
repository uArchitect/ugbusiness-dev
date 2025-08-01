 
 <?php 
 $reklamtoplam = 0;
 $temsilcitoplam = 0;
 
 ?>
 
 
 <div class="row" style="margin-left: 246px; margin-top: 21px; margin-bottom: 21px;">
  <div class="col text-center">
    
    <a href="<?=base_url("kullanici/muhasebe_rapor/$current_month/2024")?>" style="border-radius: 54px;width:250px;  font-weight: 700;" class="btn btn-<?=$secilen_yil == 2024 ? "success" : "default"?> mr-2">2024</a>
    <a href="<?=base_url("kullanici/muhasebe_rapor/$current_month/2025")?>" style="border-radius: 54px;width:250px;  font-weight: 700;" class="btn btn-<?=$secilen_yil == 2025 ? "success" : "default"?>">2025</a>
  
  </div> 
</div>


 <?php 
 $giris_yapan_kul = aktif_kullanici()->kullanici_id;
 $f_kontrol = false; $toplam_kontrol = false;
 if(
  $giris_yapan_kul == 1
  || $giris_yapan_kul == 7
  || $giris_yapan_kul == 9
  || $giris_yapan_kul == 10 || $giris_yapan_kul == 86
 ){
  $f_kontrol = true;
 }


 if(
  $giris_yapan_kul == 1
  || $giris_yapan_kul == 7
  || $giris_yapan_kul == 9
  || $giris_yapan_kul == 10  
 ){
  $f_kontrol = true;
  $toplam_kontrol = true;
 }
 ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:8px">
 <style>.dataTables_wrapper th, td { white-space: nowrap; }</style>



 <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

 

 <div class="row ">
  <div class="col">
    
<!-- PIE CHART -->
<div class="card card-dark ">
              <div class="card-header">
                <h3 class="card-title">Satış Adetleri (Kullanıcı Bazlı)</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
              
                </div>
              </div>
              <div class="card-body" style="border: 1px solid black;">


              <script>
window.onload = function () {
 
  CanvasJS.addColorSet("greenShades",
  ["#5e1914", "#800000", "#b80f0b", "#7c0a01", "#960019", "#c31808", "#ff2801", "#ff0702", "#fe2400"]
);

CanvasJS.addColorSet("mixShades",
  ["#003f5c", "#f95d6a", "#ffa600", "#ff7c43", "#d45087", "#2f4b7c", "#a05195", "#665191"]
);
CanvasJS.addColorSet("redShades",
  ["red", "darkred"]
);

  var donutData=[];
  var phpVeri = <?php echo json_encode($satis_pesin_reports); ?>;
  console.log(phpVeri);
    phpVeri.forEach(function(entry) {
        
        donutData.push({
                    y: entry.toplam_satis_adedi,
                    label: entry.kullanici_ad_soyad
                });
           
    });
var chart = new CanvasJS.Chart("chartContainer", {
  colorSet: "mixShades",
	animationEnabled: true,
	title:{
		
		horizontalAlign: "left"
	},
	data: [{
		type: "pie",
		startAngle: 60,
    indexLabelFontSize: 12,
		//innerRadius: 60, 
		indexLabel: "{label} - {y} ",
		toolTipContent: "<b>{label}:</b> {y} ",
		dataPoints: donutData
	}]
});
chart.render();



/*
var donutData1=[];
  var phpVeri1 = <?php echo json_encode($satis_vadeli_reports); ?>;
    phpVeri1.forEach(function(entry) {
        
        donutData1.push({
                    y: entry.toplam_satis_adedi,
                    label: entry.kullanici_ad_soyad
                });
           
    });
var chart1 = new CanvasJS.Chart("chartContainer1", {
  colorSet: "mixShades",
	animationEnabled: true,
	title:{
		
		horizontalAlign: "left"
	},
	data: [{
		type: "pie",
		startAngle: 60,
    indexLabelFontSize: 12,
		//innerRadius: 60, 
		indexLabel: "{label} - {y} ",
		toolTipContent: "<b>{label}:</b> {y} ",
		dataPoints: donutData1
	}]
});
chart1.render();

*/





var donutData2=[];
  var phpVeri2 = <?php echo json_encode($satis_bolge_adet_reports); ?>;
    phpVeri2.forEach(function(entry) {
        
        donutData2.push({
                    y: entry.toplam_satis_adedi,
                    label: entry.kullanici_bolge
                });
           
    });
var chart2 = new CanvasJS.Chart("chartContainer2", {
  colorSet: "mixShades",
	animationEnabled: true,
	title:{
		
		horizontalAlign: "left"
	},
	data: [{
		type: "pie",
		startAngle: 60,
    indexLabelFontSize: 12,
		//innerRadius: 60, 
		indexLabel: "{label} - {y} ",
		toolTipContent: "<b>{label}:</b> {y} ",
		dataPoints: donutData2
	}]
});
chart2.render();







var ay_kayitlari = [[],[1,'Ocak'], [2,'Şubat'], [3,'Mart'], [4,'Nisan'], [5,'Mayıs'], [6,'Haziran'], [7,'Temmuz'], [8,'Ağustos'], [9,'Eylül'], [10,'Ekim'], [11,'Kasım'], [12,'Aralık']];
var donutData2aa=[];
  var phpVeri2aa = <?php echo json_encode($satis_ay_reports); ?>;
    phpVeri2aa.forEach(function(entry) {
        
        donutData2aa.push({
                    y: parseInt(entry.toplam_satis_adedi),
                    label: ay_kayitlari[entry.ay][1]
                });
           
    });
    console.log("aaaaa"+donutData2aa);
var chart3a =  new CanvasJS.Chart("chartContaineraa", {
  colorSet: "mixShades",
	animationEnabled: true,
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	title:{
		text: ""
	},
	axisY: {
		title: ""
	},
	data: [{        
		type: "column",  
		showInLegend: false, 
    indexLabelPlacement: "inside",  
	  indexLabelFontColor: "white",
    indexLabelFontSize: 15,
    indexLabelFontWeight: 500,
    indexLabel: "{y} ADET",
		dataPoints:donutData2aa,
	}]
});
chart3a.render();


}
</script>
              <div id="chartContainer" style="height: 260px; width: 100%;"></div>
           

 
              </div>

             
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            </div>
            <div class="col d-none "> 
            
<!-- PIE CHART -->
<div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title">Vadeli Satış Raporu (Kullanıcı Bazlı)</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  
                </div>
              </div>
              <div class="card-body" style="border: 1px solid black;">
              
                <div id="chartContainer1" style="height: 260px; width: 100%;"></div>
              

              
              











              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
  </div>







  <div class="col">
    
    <!-- PIE CHART -->
    <div class="card card-dark">
                  <div class="card-header">
                    <h3 class="card-title">Bölge Bazlı Satış Raporu</h3>
    
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    
                    </div>
                  </div>
                  <div class="card-body" style="border: 1px solid black;">
                      <div id="chartContainer2" style="height: 260px; width: 100%;"></div>
              

                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
    
                </div>


<?php 
if($this->session->userdata('aktif_kullanici_id') == 1 || $this->session->userdata('aktif_kullanici_id') == 4 || $this->session->userdata('aktif_kullanici_id') == 6){
  ?>



  <div class="col">
    
    <!-- PIE CHART -->
    <div class="card card-dark">
                  <div class="card-header">
                    <h3 class="card-title">Reklam / Temsilci Satış Raporu</h3>
    
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    
                    </div>
                  </div>
                  <div class="card-body" style="border: 1px solid black;">
                      <div id="chartContainer3" style="height: 260px; width: 100%;"></div>
              

                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
    
                </div>





  <?php
}

?>





</div>
 


















<section class="content text-md">
<div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title"><strong>UG Business</strong> - Kullanıcı Bazlı Satış Detayları</h3>
                
              </div>
              <div class="btn-group" style="padding: 0px;">
                  <a href="<?=base_url("kullanici/muhasebe_rapor/0/$secilen_yil")?>"   style="<?=($current_month == 0 ? "background : #7d0000;color:white;" : "background:black;color:white;")?> border-radius: 0px; margin-left: -1px;" onclick="//filterwrite(this,'');" class="btn btn-default">Tümünü Görüntüle</a> 
                  <a href="<?=base_url("kullanici/muhasebe_rapor/1/$secilen_yil")?>"   style="<?=($current_month == 1 ? "background : #7d0000;color:white;" : "background:black;color:white;")?> " class="btn btn-default">Ocak <?=$secilen_yil?></a>
                  <a href="<?=base_url("kullanici/muhasebe_rapor/2/$secilen_yil")?>"   style="<?=($current_month == 2 ? "background : #7d0000;color:white;" : "background:black;color:white;")?> " class="btn btn-default">Şubat <?=$secilen_yil?></a>
                  <a href="<?=base_url("kullanici/muhasebe_rapor/3/$secilen_yil")?>"   style="<?=($current_month == 3 ? "background : #7d0000;color:white;" : "background:black;color:white;")?> " class="btn btn-default">Mart <?=$secilen_yil?></a>
                  <a href="<?=base_url("kullanici/muhasebe_rapor/4/$secilen_yil")?>"   style="<?=($current_month == 4 ? "background : #7d0000;color:white;" : "background:black;color:white;")?> " class="btn btn-default">Nisan <?=$secilen_yil?></a>
                  <a href="<?=base_url("kullanici/muhasebe_rapor/5/$secilen_yil")?>"   style="<?=($current_month == 5 ? "background : #7d0000;color:white;" : "background:black;color:white;")?> " class="btn btn-default">Mayıs <?=$secilen_yil?></a>
                  <a href="<?=base_url("kullanici/muhasebe_rapor/6/$secilen_yil")?>"   style="<?=($current_month == 6 ? "background : #7d0000;color:white;" : "background:black;color:white;")?> " class="btn btn-default">Haziran <?=$secilen_yil?></a>
                  <a href="<?=base_url("kullanici/muhasebe_rapor/7/$secilen_yil")?>"   style="<?=($current_month == 7 ? "background : #7d0000;color:white;" : "background:black;color:white;")?> " class="btn btn-default">Temmuz <?=$secilen_yil?></a>
                  <a href="<?=base_url("kullanici/muhasebe_rapor/8/$secilen_yil")?>"   style="<?=($current_month == 8 ? "background : #7d0000;color:white;" : "background:black;color:white;")?> " class="btn btn-default">Ağustos <?=$secilen_yil?></a>
                  <a href="<?=base_url("kullanici/muhasebe_rapor/9/$secilen_yil")?>"   style="<?=($current_month == 9 ? "background : #7d0000;color:white;" : "background:black;color:white;")?> " class="btn btn-default">Eylül <?=$secilen_yil?></a>
                  <a href="<?=base_url("kullanici/muhasebe_rapor/10/$secilen_yil")?>"  style="<?=($current_month == 10 ? "background : #7d0000;color:white;" : "background:black;color:white;")?> " class="btn btn-default">Ekim <?=$secilen_yil?></a>
                  <a href="<?=base_url("kullanici/muhasebe_rapor/11/$secilen_yil")?>"  style="<?=($current_month == 11 ? "background : #7d0000;color:white;" : "background:black;color:white;")?> " class="btn btn-default">Kasım <?=$secilen_yil?></a>
                  <a href="<?=base_url("kullanici/muhasebe_rapor/12/$secilen_yil")?>"  style="<?=($current_month == 12 ? "background : #7d0000;color:white;" : "background:black;color:white;")?> border-radius: 0px; margin-right: -1px;" class="btn btn-default">Aralık <?=$secilen_yil?></a>
                </div>
              <!-- /.card-header --> 
              <div class="card-body" style="border: 1px solid black;">
             
                <table id="example1muhasebe" class="table text-sm table-bordered table-responsive table-striped" style="zoom:0.88"   >
                  <thead style="width: 100% !important;">
                  <tr>
                  <th>Sipariş Kayıt Tarihi</th> 
                  <th>Teslimat Tarihi</th> 
                    <th>Satış Temsilcisi</th>
                    <th>Müşteri Ad Soyad</th>
                    <th>İletişim Numarası</th>
                    <th>Ürün Adı</th> 

                    <th>Satış Fiyatı</th> 
                    <th>Kapora</th> 
                    <th>Peşinat</th> 
                    <th>Takas Bedeli</th> 
               
                    <th>Fatura Tutarı</th> 
                    <th>Vade</th> 
                    <th style="width: 100%;">Satış Türü</th> 
                
                  </tr>
                  </thead>
                  <tbody style="width: 100% !important;">
                    <?php $a_id = aktif_kullanici()->kullanici_id; ?>
                    <?php 
                    
                    $t_satis_fiyati = 0;
                    $t_kapora = 0;
                    $t_pesinat = 0;
                    $t_takas_bedeli = 0;
                    $t_taksit = 0;
                    $t_fatura = 0;


                      $dolar_satis_fiyati = 0;
                      $dolar_kapora = 0;
                      $dolar_pesinat = 0;
                      $dolar_takas_bedeli = 0;
                      $dolar_taksit = 0;
                      $dolar_fatura = 0;



                      $euro_satis_fiyati = 0;
                      $euro_kapora = 0;
                      $euro_pesinat = 0;
                      $euro_takas_bedeli = 0;
                      $euro_taksit = 0;
                      $euro_fatura = 0;


                    $vadeli_t_satis_fiyati = 0;
                    $vadeli_t_kapora = 0;
                    $vadeli_t_pesinat = 0;
                    $vadeli_t_takas_bedeli = 0;
                    $vadeli_t_taksit = 0;
                    $vadeli_t_fatura = 0;

                    $vadeli_dolar_satis_fiyati = 0;
                    $vadeli_dolar_kapora = 0;
                    $vadeli_dolar_pesinat = 0;
                    $vadeli_dolar_takas_bedeli = 0;
                    $vadeli_dolar_taksit = 0;
                    $vadeli_dolar_fatura = 0;


                    $vadeli_euro_satis_fiyati = 0;
                    $vadeli_euro_kapora = 0;
                    $vadeli_euro_pesinat = 0;
                    $vadeli_euro_takas_bedeli = 0;
                    $vadeli_euro_taksit = 0;
                    $vadeli_euro_fatura = 0;

                    $pesin_t_satis_fiyati = 0;
                    $pesin_t_kapora = 0;
                    $pesin_t_pesinat = 0;
                    $pesin_t_takas_bedeli = 0;
                    $pesin_t_taksit = 0;
                    $pesin_t_fatura = 0;


                    $pesin_dolar_satis_fiyati = 0;
                    $pesin_dolar_kapora = 0;
                    $pesin_dolar_pesinat = 0;
                    $pesin_dolar_takas_bedeli = 0;
                    $pesin_dolar_taksit = 0;
                    $pesin_dolar_fatura = 0;

                    $pesin_euro_satis_fiyati = 0;
                    $pesin_euro_kapora = 0;
                    $pesin_euro_pesinat = 0;
                    $pesin_euro_takas_bedeli = 0;
                    $pesin_euro_taksit = 0;
                    $pesin_euro_fatura = 0;
                    ?>
                   <?php foreach ($kullanicilar as $kullanici){?>
                    <?php 
                    
                    if($kullanici->para_birimi == "TRY"){
                      $picon = " ₺";
                    }
                    if($kullanici->para_birimi == "EUR"){
                      $picon = " €";
                    }
                    if($kullanici->para_birimi == "USD"){
                      $picon = " $";
                    }

if($kullanici->para_birimi == "TRY"){
                       $t_satis_fiyati += $kullanici->satis_fiyati;
                    $t_kapora += $kullanici->kapora_fiyati;
                    $t_pesinat += $kullanici->pesinat_fiyati;
                    $t_takas_bedeli += $kullanici->takas_bedeli;
                    $t_fatura += $kullanici->fatura_tutari;

                      }
                      if($kullanici->para_birimi == "EUR"){
                       $euro_satis_fiyati += $kullanici->satis_fiyati;
                       $euro_kapora += $kullanici->kapora_fiyati;
                       $euro_pesinat += $kullanici->pesinat_fiyati;
                       $euro_takas_bedeli += $kullanici->takas_bedeli;
                       $euro_fatura += $kullanici->fatura_tutari;

                      }
                      if($kullanici->para_birimi == "USD"){
                        $dolar_satis_fiyati += $kullanici->satis_fiyati;
                        $dolar_kapora += $kullanici->kapora_fiyati;
                        $dolar_pesinat += $kullanici->pesinat_fiyati;
                        $dolar_takas_bedeli += $kullanici->takas_bedeli;
                        $dolar_fatura += $kullanici->fatura_tutari;

                      }



                   
                    if($kullanici->odeme_secenek == "1"){
                      if($kullanici->para_birimi == "TRY"){
                        $pesin_t_satis_fiyati += $kullanici->satis_fiyati;
                        $pesin_t_kapora += $kullanici->kapora_fiyati;
                        $pesin_t_pesinat += $kullanici->pesinat_fiyati;
                        $pesin_t_takas_bedeli += $kullanici->takas_bedeli;
                        $pesin_t_fatura += $kullanici->fatura_tutari;
                      }
                      if($kullanici->para_birimi == "EUR"){
                        $pesin_euro_satis_fiyati += $kullanici->satis_fiyati;
                        $pesin_euro_kapora += $kullanici->kapora_fiyati;
                        $pesin_euro_pesinat += $kullanici->pesinat_fiyati;
                        $pesin_euro_takas_bedeli += $kullanici->takas_bedeli;
                        $pesin_euro_fatura += $kullanici->fatura_tutari;
                      }
                      if($kullanici->para_birimi == "USD"){
                        $pesin_dolar_satis_fiyati += $kullanici->satis_fiyati;
                        $pesin_dolar_kapora += $kullanici->kapora_fiyati;
                        $pesin_dolar_pesinat += $kullanici->pesinat_fiyati;
                        $pesin_dolar_takas_bedeli += $kullanici->takas_bedeli;
                        $pesin_dolar_fatura += $kullanici->fatura_tutari;
                      }
                     
                  
                    }else{


                      if($kullanici->para_birimi == "TRY"){
                          $vadeli_t_satis_fiyati += $kullanici->satis_fiyati;
                          $vadeli_t_kapora += $kullanici->kapora_fiyati;
                          $vadeli_t_pesinat += $kullanici->pesinat_fiyati;
                          $vadeli_t_takas_bedeli += $kullanici->takas_bedeli;
                          $vadeli_t_fatura += $kullanici->fatura_tutari;
                      }
                      if($kullanici->para_birimi == "EUR"){
                          $vadeli_euro_satis_fiyati += $kullanici->satis_fiyati;
                          $vadeli_euro_kapora += $kullanici->kapora_fiyati;
                          $vadeli_euro_pesinat += $kullanici->pesinat_fiyati;
                          $vadeli_euro_takas_bedeli += $kullanici->takas_bedeli;
                          $vadeli_euro_fatura += $kullanici->fatura_tutari;
                      }
                      if($kullanici->para_birimi == "USD"){
                          $vadeli_dolar_satis_fiyati += $kullanici->satis_fiyati;
                          $vadeli_dolar_kapora += $kullanici->kapora_fiyati;
                          $vadeli_dolar_pesinat += $kullanici->pesinat_fiyati;
                          $vadeli_dolar_takas_bedeli += $kullanici->takas_bedeli;
                          $vadeli_dolar_fatura += $kullanici->fatura_tutari;
                      }


                    
                    }
                  

                  
                    
                    ?>
                    <tr  <?php 
                         if($kullanici->yenilenmis_cihaz_mi == 1){
                         echo "style='background:#e7fbe7;'";
                         }
                         ?>>
                    <td>
                         <?=date("d.m.Y H:i",strtotime($kullanici->kayit_tarihi))?> 
                         <?php 
                         $urlcustom = base_url("siparis/report/").urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$kullanici->siparis_id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE"));
                         ?>
                         <a href="#" onclick="showWindow('<?= $urlcustom?>');">(<?=$kullanici->siparis_kodu?>)</a>
                      </td>


                      <?php   $stylec = "";
                      if($kullanici->kurulum_tarihi < date("Y-m-d") && $kullanici->kurulum_tarihi != $kullanici->kayit_tarihi && $kullanici->adim_no<11){
                           $stylec = "background:red!important;color:white!important;";
                      }else if(strtotime($kullanici->musteri_talep_teslim_tarihi) == strtotime($kullanici->kayit_tarihi)){
                        $stylec = "";
                      }
                      
                      else{
                        if($kullanici->adim_no<11 && $kullanici->kurulum_tarihi < date("Y-m-d")){
                          $stylec = "background:#ff000059;color:white;";
                        }
                     
                      }
                      ?>
                      


                      <td style="<?= $stylec?>">
                      
                      <?php 
                      if($kullanici->kurulum_tarihi != $kullanici->kayit_tarihi){
                        echo '<i class="fa fa-check-circle text-success" style="'.$stylec.'"></i><span class="text-success" style="'.$stylec.'"> '.date("d.m.Y",strtotime($kullanici->kurulum_tarihi))."</span>".($kullanici->adim_no>11 ? "  <span class='text-success' style='$stylec'> / Teslim Edildi</span>":'');
                      }else if(strtotime($kullanici->musteri_talep_teslim_tarihi) == strtotime($kullanici->kayit_tarihi)){
                        echo "<span class='text-danger'>Tarih Belirlenmedi</span>";
                      }
                      
                      else{
                        echo '<i class="fas fa-clock  "  ></i> '.date("d.m.Y",strtotime($kullanici->musteri_talep_teslim_tarihi));
                      }
                      ?>
                      

                      </td>

                      
                      <td>
                        <i class="fa fa-user" style="margin-right:5px;opacity:0.8"></i>
                        <?php 
                        $pkurl = base_url("kullanici/kullanici_profil/$kullanici->kullanici_id");
                        ?>
                        <a style="cursor:pointer;color:block;text-decoration:underline;" href="#"  onclick="showWindow('<?= $pkurl?>');">  <?=mb_strtoupper($kullanici->kullanici_ad_soyad)?>  </a>
                      </td>
                      <td>
                        <i class="fa fa-users" style="margin-right:5px;opacity:0.8"></i>
                        <?php 
                        $purl = base_url("musteri/profil/$kullanici->musteri_id");
                        ?>
                        <a style="cursor:pointer; " href="#" onclick="showWindow('<?= $purl?>');"><?=$kullanici->musteri_ad?> </a>
                      </td>
                      <td data-numara="<?=$kullanici->musteri_iletisim_numarasi?>" class="goster" style="cursor:pointer;<?=talep_var_mi($kullanici->musteri_iletisim_numarasi) ? "background:#0f6700;color:white":""?>">
                        <i class="fa fa-phone" style="margin-right:5px;opacity:0.8"></i>
                     <?php 
                        if($a_id != 111 ){

                          $cvc =  talep_var_mi($kullanici->musteri_iletisim_numarasi);
                          if($cvc){
                            $reklamtoplam++;
                          }else{
                                  $temsilcitoplam++;
                          }
?>
    <span ><?=$kullanici->musteri_iletisim_numarasi?> <?=$cvc ? "(Reklam)".talep_kaynak_k($kullanici->musteri_iletisim_numarasi):""?></span>
                    
<?php
                        }else{
                          ?>
    <span><?=$kullanici->musteri_iletisim_numarasi?></span>
                    
<?php
                        }
                     ?>
                      </td>
                      <td>
                         <?=$kullanici->urun_adi?> 
                         <?php 
                         if($kullanici->yenilenmis_cihaz_mi == 1){
                          ?>
                          <span class="text-success">Yenilenmiş Cihaz</span>
                          <?php
                         }
                         ?>
                      </td>
                     
                      <td style="background:#47ff6f38;text-align:right;">
                        
                        <?=($f_kontrol ? number_format($kullanici->satis_fiyati,2)." $picon" : "<span class='text-danger'>**.***</span>")?> 
                      </td>
                      <td style="text-align:right;<?php if($kullanici->kapora_fiyati == 0){ echo "background:#ff000045;";}?>">
                      
                      <?=($f_kontrol ? number_format($kullanici->kapora_fiyati,2)." $picon" : "<span class='text-danger'>**.***</span>")?> 
                    </td>
                      <td style="text-align:right;">
                       
                       <?=($f_kontrol ? number_format($kullanici->pesinat_fiyati,2)." $picon" : "<span class='text-danger'>**.***</span>")?> 
                      </td>
                    
                      <td style="text-align:right;<?php if($kullanici->takas_bedeli == 0){ echo "background:#ffff0033;";}?>">
                        
                         <?=($f_kontrol ? number_format($kullanici->takas_bedeli,2)." $picon" : "<span class='text-danger'>**.***</span>")?> 
                      </td>
                     
                      <td style="text-align:right;<?php if($kullanici->fatura_tutari == 0){ echo "background:#ff000045;";}?>">
                        
                        <?=($f_kontrol ? number_format($kullanici->fatura_tutari,2)." $picon" : "<span class='text-danger'>**.***</span>")?> 
                      </td>
                      <td>
                        
                        <?=($kullanici->odeme_secenek == 1) ?"-" :$kullanici->vade_sayisi." Ay"?> 
                      </td>
                      <td>
                        <?php 
                          if($kullanici->odeme_secenek == "1"){
                              ?>
                               <i class="fa fa-info-circle text-success" ></i>
                               <b>Peşin Satış</b>
                              <?php
                          }else{
                            ?>
                           
                              <span style="text-orange">Vadeli</span>

                           <?php
                            $kalan_tutar = ($kullanici->satis_fiyati-($kullanici->pesinat_fiyati+$kullanici->kapora_fiyati+$kullanici->takas_bedeli));
                            echo " (".(($f_kontrol ? number_format($kalan_tutar ,2)." $picon" : "<span class='text-danger'>**.***</span>"));
                            echo "<span style='opacity:0.6'> - Taksit :".($f_kontrol ? number_format($kalan_tutar/$kullanici->vade_sayisi)." $picon</span>)" : "<span class='text-danger'>**.***</span>)");
                          $t_taksit += ($kalan_tutar/$kullanici->vade_sayisi);
                          if($kullanici->odeme_secenek == "1"){
                          

                             if($kullanici->para_birimi == "TRY"){
                          $pesin_t_taksit += ($kalan_tutar/$kullanici->vade_sayisi);
                            
                      }
                      if($kullanici->para_birimi == "EUR"){
                         $pesin_euro_taksit += ($kalan_tutar/$kullanici->vade_sayisi);
                            
                      }
                      if($kullanici->para_birimi == "USD"){
                           $pesin_dolar_taksit += ($kalan_tutar/$kullanici->vade_sayisi);
                            
                      }



                        
                          }else{
                           
                                if($kullanici->para_birimi == "TRY"){
                          $vadeli_t_taksit += ($kalan_tutar/$kullanici->vade_sayisi);

                            
                      }
                      if($kullanici->para_birimi == "EUR"){
                        $vadeli_euro_taksit += ($kalan_tutar/$kullanici->vade_sayisi);

                            
                      }
                      if($kullanici->para_birimi == "USD"){
                          $vadeli_dolar_taksit += ($kalan_tutar/$kullanici->vade_sayisi);

                            
                      }
                          }
                         
                         
                        }
                        
                        ?>
                       
                      </td>
                     
                    </tr>
                  <?php  } ?>
                  <?php 
                  
                  if($toplam_kontrol){
                    setlocale(LC_MONETARY, 'tr_TR');
 
                    ?>
                      <tr style="background: #ffffff; color: red;">   
                        <td style="text-align: end;font-weight:bold" colspan="6">VADELİ SATIŞLAR TOPLAM : </td>
                        <td style="font-weight:bold">
                        
                        
                        <?= number_format($vadeli_t_satis_fiyati, 2, '.', ',') . ' TRY' ?>
                        <br>
                        <?= number_format($vadeli_dolar_satis_fiyati, 2, '.', ',') . ' USD' ?>
                        <br>
                        <?= number_format($vadeli_euro_satis_fiyati, 2, '.', ',') . ' EUR' ?>
                     
 

                        </td>
                        <td style="font-weight:bold"> 
                      
                      
                        <?= number_format($vadeli_t_kapora, 2, '.', ',') . ' TRY' ?>
                        <br>
                        <?= number_format($vadeli_dolar_kapora, 2, '.', ',') . ' USD' ?>
                        <br>
                        <?= number_format($vadeli_euro_kapora, 2, '.', ',') . ' EUR' ?>
                     
                      </td>
                        <td style="font-weight:bold"> 
                      
                       <?= number_format($vadeli_t_pesinat, 2, '.', ',') . ' TRY' ?>
                        <br>
                        <?= number_format($vadeli_dolar_pesinat, 2, '.', ',') . ' USD' ?>
                        <br>
                        <?= number_format($vadeli_euro_pesinat, 2, '.', ',') . ' EUR' ?>
                     
                      </td>
                        <td style="font-weight:bold"> 
                      
                        <?= number_format($vadeli_t_takas_bedeli, 2, '.', ',') . ' TRY' ?>
                        <br>
                        <?= number_format($vadeli_dolar_takas_bedeli, 2, '.', ',') . ' USD' ?>
                        <br>
                        <?= number_format($vadeli_euro_takas_bedeli, 2, '.', ',') . ' EUR' ?>
                     
                      
                      
                      </td>
                        <td style="font-weight:bold"> 
                      
                        <?= number_format($vadeli_t_fatura, 2, '.', ',') . ' TRY' ?>
                        <br>
                        <?= number_format($vadeli_dolar_fatura, 2, '.', ',') . ' USD' ?>
                        <br>
                        <?= number_format($vadeli_euro_fatura, 2, '.', ',') . ' EUR' ?>
                     
                      
                      </td>
                        <td style="font-weight:bold">-</td>
                        <td style="font-weight:bold"> 
                      
                        <?= number_format($vadeli_t_taksit, 2, '.', ',') . ' TRY' ?>
                        <br>
                        <?= number_format($vadeli_dolar_taksit, 2, '.', ',') . ' USD' ?>
                        <br>
                        <?= number_format($vadeli_euro_taksit, 2, '.', ',') . ' EUR' ?>
                     
                      </td>
                      </tr>
                      <tr style="background: #ffffff; color: red;">   
                        <td style="text-align: end;font-weight:bold" colspan="6">PEŞİN SATIŞLAR TOPLAM : </td>
                        <td style="font-weight:bold"> 
                       <?= number_format($pesin_t_satis_fiyati, 2, '.', ',') . ' TRY' ?>
                        <br>
                        <?= number_format($pesin_dolar_satis_fiyati, 2, '.', ',') . ' USD' ?>
                        <br>
                        <?= number_format($pesin_euro_satis_fiyati, 2, '.', ',') . ' EUR' ?>
                     
                      
                      </td>
                        <td style="font-weight:bold"> 
                       <?= number_format($pesin_t_kapora, 2, '.', ',') . ' TRY' ?>
                        <br>
                        <?= number_format($pesin_dolar_kapora, 2, '.', ',') . ' USD' ?>
                        <br>
                        <?= number_format($pesin_euro_kapora, 2, '.', ',') . ' EUR' ?>
                     
                      </td>
                        <td style="font-weight:bold"> 
                      
                         <?= number_format($pesin_t_pesinat, 2, '.', ',') . ' TRY' ?>
                        <br>
                        <?= number_format($pesin_dolar_pesinat, 2, '.', ',') . ' USD' ?>
                        <br>
                        <?= number_format($pesin_euro_pesinat, 2, '.', ',') . ' EUR' ?>
                     
                      
                      </td>
                        <td style="font-weight:bold"> 
                      
                        <?= number_format($pesin_t_takas_bedeli, 2, '.', ',') . ' TRY' ?>
                        <br>
                        <?= number_format($pesin_dolar_takas_bedeli, 2, '.', ',') . ' USD' ?>
                        <br>
                        <?= number_format($pesin_euro_takas_bedeli, 2, '.', ',') . ' EUR' ?>
                     
                      
                      </td>
                        <td style="font-weight:bold"> 
                      
                        <?= number_format($pesin_t_fatura, 2, '.', ',') . ' TRY' ?>
                        <br>
                        <?= number_format($pesin_dolar_fatura, 2, '.', ',') . ' USD' ?>
                        <br>
                        <?= number_format($pesin_euro_fatura, 2, '.', ',') . ' EUR' ?>
                     
                      </td>
                        <td style="font-weight:bold">-</td>
                        <td style="font-weight:bold">-</td>
                      </tr>
                      <tr style="background: #7d0000;color: white;">   
                        <td style="text-align: end;font-weight:bold" colspan="6">GENEL TOPLAM : </td>
                        <td style="font-weight:bold">
                           
                        <?= number_format($t_satis_fiyati, 2, '.', ',') . ' TRY' ?>
                        <br>
                        <?= number_format($dolar_satis_fiyati, 2, '.', ',') . ' USD' ?>
                        <br>
                        <?= number_format($euro_satis_fiyati, 2, '.', ',') . ' EUR' ?>
                     


                      </td>
                        <td style="font-weight:bold"> 
                      
                          <?= number_format($t_kapora, 2, '.', ',') . ' TRY' ?>
                        <br>
                        <?= number_format($dolar_kapora, 2, '.', ',') . ' USD' ?>
                        <br>
                        <?= number_format($euro_kapora, 2, '.', ',') . ' EUR' ?>
                     

                      
                      </td>
                        <td style="font-weight:bold"> 
                      
                         <?= number_format($t_pesinat, 2, '.', ',') . ' TRY' ?>
                        <br>
                        <?= number_format($dolar_pesinat, 2, '.', ',') . ' USD' ?>
                        <br>
                        <?= number_format($euro_pesinat, 2, '.', ',') . ' EUR' ?>
                     

                      
                      </td>
                        <td style="font-weight:bold"> 
                      
                        <?= number_format($t_takas_bedeli, 2, '.', ',') . ' TRY' ?>
                        <br>
                        <?= number_format($dolar_takas_bedeli, 2, '.', ',') . ' USD' ?>
                        <br>
                        <?= number_format($euro_takas_bedeli, 2, '.', ',') . ' EUR' ?>
                     
                      </td>
                        <td style="font-weight:bold"> 
                      
                       <?= number_format($t_fatura, 2, '.', ',') . ' TRY' ?>
                        <br>
                        <?= number_format($dolar_fatura, 2, '.', ',') . ' USD' ?>
                        <br>
                        <?= number_format($euro_fatura, 2, '.', ',') . ' EUR' ?>
                     </td>
                        <td style="font-weight:bold">-</td>
                        <td style="font-weight:bold"> 
                      
                       <?= number_format($t_taksit, 2, '.', ',') . ' TRY' ?>
                        <br>
                        <?= number_format($dolar_taksit, 2, '.', ',') . ' USD' ?>
                        <br>
                        <?= number_format($euro_taksit, 2, '.', ',') . ' EUR' ?>
                      </td>
                      </tr>
                    <?php
                  }
                  ?>
                 
                  </tbody>
 
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
</section>










<div class="col col-md-12  "> 
            
            <!-- PIE CHART -->
            <div class="card card-dark">
                          <div class="card-header">
                       
                            <h3 class="card-title"><strong>UG Business</strong> - Yıllık Satış Grafiği (Satış Adet)</h3>
                            <div class="card-tools">
                              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                              </button>
                             
                            </div>
                          </div>
                          <div class="card-body" style="border: 1px solid black;">
                          
                          <div id="chartContaineraa" style="height: 260px; width: 100%;"></div>
           

                          </div>
                          <!-- /.card-body --> 
                        </div>
                        <!-- /.card -->
              </div>
           





















<div class="row  ">





<div class="col col-md-12"> 
            
            <!-- PIE CHART -->
            <div class="card card-dark">
                          <div class="card-header">
                            <h3 class="card-title">Yıllık Satış Grafiği (Ürün Bazlı Adet)</h3>
            
                            <div class="card-tools">
                              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                              </button>
                            
                            </div>
                          </div>
                          <div class="card-body" style="border: 1px solid black;">
                          <div id="bar-chart2" style="height: 300px;"></div>
                          </div>
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
              </div>
           


</div>




            </div>





<!-- jQuery -->
<script src="<?=base_url("assets/")?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url("assets/")?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?=base_url("assets/")?>plugins/chart.js/Chart.min.js"></script>


<script src="<?=base_url("assets/")?>plugins/flot/jquery.flot.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="<?=base_url("assets/")?>plugins/flot/plugins/jquery.flot.resize.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="<?=base_url("assets/")?>plugins/flot/plugins/jquery.flot.pie.js"></script>




            <style>
              .table-striped tbody tr:nth-of-type(odd) {
    background-color: #7d7d7d30;
}
              </style>
              <script>

function showWindow($url) {
        
        var width = 1350;
      var height = 820;

    
      var left = (screen.width / 2) - (width / 2);
      var top = (screen.height / 2) - (height / 2);
      var newWindow = window.open($url, 'Yeni Pencere', 'width=' + width + ',height=' + height + ',top=' + top + ',left=' + left);

      
  };



                 function filterwrite(currentbutton,text){

                  var buttons = document.querySelectorAll('.btn-group button');
buttons.forEach(function(button) {
    button.style.background = '#000000';
    button.style.color = 'white';
});

currentbutton.style.background = '#ffc107!important';
currentbutton.style.color = '#ffc107';
                  var inputElement = document.querySelector('#example1muhasebe_filter input[type="search"]');

 
inputElement.value = text;
var event = new Event('input', {
        bubbles: true,
        cancelable: true,
    });
    inputElement.dispatchEvent(event);
    }

 




 







 










 









 /*
     * BAR CHART
     * ---------
     */

     var bar_data_cihaz = {
    data: [],
    bars: { show: true }
};

var phpVeri4 = <?php echo json_encode($satis_urun_reports); ?>;


for (let i = 0; i < 8; i++) {
  bar_data_cihaz.data.push([]);
}

 

for (let index = 0; index < 8; index++) {
  bar_data_cihaz.data[index].push(phpVeri4[index].row_num); 
  bar_data_cihaz.data[index].push(phpVeri4[index].satis_adedi);
}
   
   
var bar_data_cihaz_isim = {
    data: []
};
for (let i = 0; i < 8; i++) {
  bar_data_cihaz_isim.data.push([]);
}

for (let index = 0; index < 8; index++) {
  bar_data_cihaz_isim.data[index].push(phpVeri4[index].row_num); 
  bar_data_cihaz_isim.data[index].push(phpVeri4[index].urun_adi);
}
   
console.log(bar_data_cihaz_isim.data);

    $.plot('#bar-chart2', [bar_data_cihaz], {
      grid  : {
        borderWidth: 1,
        borderColor: '#f3f3f3',
        tickColor  : '#f3f3f3'
      },
      series: {
         bars: {
          show: true, barWidth: 0.5, align: 'center',
        },
      },
      colors: ['#04852d'],
      xaxis : {
        ticks:  bar_data_cihaz_isim.data
      }
    })
    /* END BAR CHART */

















</script>

<style>

.canvasjs-chart-credit{
  display:none;
}
  </style>


 
<script>
$(document).ready(function(){
    $('.goster').on('click', function(){
        var numara = $(this).data('numara');

        $.ajax({
            url: '<?= base_url("talep/get_detaylar") ?>',
            method: 'POST',
            data: { numara: numara },
            dataType: 'json',
            success: function(response){
    if(response.status === 'success'){
        let html = `<div style="display: flex; flex-direction: column; gap: 20px;">`;

        response.data.forEach(function(item){
            html += `
            <div style="
                background: linear-gradient(90deg, #f1f3f5, #ffffff);
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0,0,0,0.05);
                padding: 20px;
                width: 100%;
                font-family: 'Segoe UI', sans-serif;
                border-left: 5px solid #007bff;
            ">
                <div style="font-size: 18px; font-weight: bold; color:#343a40; margin-bottom:10px;">
                    ${item.yonlendiren} → ${(item.yonlenen == item.yonlendiren) ? "Satışçı Kendisi Kayıt Oluşturdu" : item.yonlenen}
                </div>
                <div style="display: flex; flex-wrap: wrap; gap: 15px;">
                    <div><strong>📞 Telefon:</strong> ${item.talep_cep_telefon}</div>
                    <div><strong>🕒 Tarih:</strong> ${new Date(item.yonlendirme_tarihi).getDate()}.${new Date(item.yonlendirme_tarihi).getMonth()+1}.${new Date(item.yonlendirme_tarihi).getFullYear()} ${new Date(item.yonlendirme_tarihi).getHours()}:${new Date(item.yonlendirme_tarihi).getMinutes()}</div>
                    <div><strong>📄 Detay:</strong> ${item.gorusme_detay}</div>
                    <div><strong>📊 Sonuç:</strong> ${item.talep_sonuc_adi}</div>
                    <div><strong>🔗 Kaynak:</strong> ${item.talep_kaynak_adi}</div>
                </div>
            </div>`;
        });

        html += `</div>`;

        Swal.fire({
            title: 'Yönlendirme Detayları',
            html: html,
            width: '80%',
            confirmButtonText: 'Kapat',
            customClass: {
                popup: 'scrollable-popup'
            }
        });
    } else {
        Swal.fire('Hata', 'Veri bulunamadı.', 'error');
    }
}


        });
    });

 var kontrolkul = <?=$this->session->userdata('aktif_kullanici_id')?>;
 if(kontrolkul == 6 || kontrolkul == 1 || kontrolkul == 4){
  
  var donutData3=[];
   
        donutData3.push({
                    y: <?= $reklamtoplam?>,
                    label: "REKLAM"
                });
                      donutData3.push({
                    y: <?= $temsilcitoplam?>,
                    label: "SATIŞ TEMSİLCİSİ"
                });
var chart3 = new CanvasJS.Chart("chartContainer3", {
  colorSet: "mixShades",
	animationEnabled: true,
	title:{
		
		horizontalAlign: "left"
	},
	data: [{
		type: "pie",
		startAngle: 60,
    indexLabelFontSize: 12,
		//innerRadius: 60, 
		indexLabel: "{label} - {y} ",
		toolTipContent: "<b>{label}:</b> {y} ",
		dataPoints: donutData3
	}]
});
chart3.render();
 }

 
});
</script>

<style>
.swal2-popup.scrollable-popup {
    max-height: 80vh !important;
    overflow-y: auto !important;
}
</style>