 <?php 
 $giris_yapan_kul = aktif_kullanici()->kullanici_id;
 $f_kontrol = false;
 if(
  $giris_yapan_kul == 1
  || $giris_yapan_kul == 7
  || $giris_yapan_kul == 9
  || $giris_yapan_kul == 10
 ){
  $f_kontrol = true;
 }
 ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:8px">
 <style>.dataTables_wrapper th, td { white-space: nowrap; }</style>



 <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>






 <div class="row">
  <div class="col">
    
<!-- PIE CHART -->
<div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title">Peşin Satış Raporu (Kullanıcı Bazlı)</h3>

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
  ["#5e1914", "#800000", "#b80f0b", "#48b5c4", "#960019", "#c31808", "#ff2801", "#ff0702", "#fe2400"]
);
CanvasJS.addColorSet("redShades",
  ["red", "darkred"]
);

  var donutData=[];
  var phpVeri = <?php echo json_encode($satis_pesin_reports); ?>;
    phpVeri.forEach(function(entry) {
        
        donutData.push({
                    y: entry.toplam_satis_adedi,
                    label: entry.kullanici_ad_soyad
                });
           
    });
var chart = new CanvasJS.Chart("chartContainer", {
  colorSet: "greenShades",
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




var donutData1=[];
  var phpVeri1 = <?php echo json_encode($satis_vadeli_reports); ?>;
    phpVeri1.forEach(function(entry) {
        
        donutData1.push({
                    y: entry.toplam_satis_adedi,
                    label: entry.kullanici_ad_soyad
                });
           
    });
var chart1 = new CanvasJS.Chart("chartContainer1", {
  colorSet: "greenShades",
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







var donutData2=[];
  var phpVeri2 = <?php echo json_encode($satis_bolge_adet_reports); ?>;
    phpVeri2.forEach(function(entry) {
        
        donutData2.push({
                    y: entry.toplam_satis_adedi,
                    label: entry.kullanici_bolge
                });
           
    });
var chart2 = new CanvasJS.Chart("chartContainer2", {
  colorSet: "greenShades",
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
    console.log(donutData2aa);
var chart3a =  new CanvasJS.Chart("chartContaineraa", {
  colorSet: "redShades",
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
            <div class="col"> 
            
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








</div>
 


















<section class="content text-md">
<div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title"><strong>UG Business</strong> - Kullanıcı Bazlı Satış Detayları</h3>
                
              </div>
              <div class="btn-group" style="padding: 0px;">
                  <a href="<?=base_url("kullanici/muhasebe_rapor/0")?>"   style="<?=($current_month == 0 ? "background : #7d0000;color:white;" : "background:black;color:white;")?> border-radius: 0px; margin-left: -1px;" onclick="//filterwrite(this,'');" class="btn btn-default">Tümünü Görüntüle</a> 
                  <a href="<?=base_url("kullanici/muhasebe_rapor/1")?>"   style="<?=($current_month == 1 ? "background : #7d0000;color:white;" : "background:black;color:white;")?> " class="btn btn-default">Ocak <?=date('Y')?></a>
                  <a href="<?=base_url("kullanici/muhasebe_rapor/2")?>"   style="<?=($current_month == 2 ? "background : #7d0000;color:white;" : "background:black;color:white;")?> " class="btn btn-default">Şubat <?=date('Y')?></a>
                  <a href="<?=base_url("kullanici/muhasebe_rapor/3")?>"   style="<?=($current_month == 3 ? "background : #7d0000;color:white;" : "background:black;color:white;")?> " class="btn btn-default">Mart <?=date('Y')?></a>
                  <a href="<?=base_url("kullanici/muhasebe_rapor/4")?>"   style="<?=($current_month == 4 ? "background : #7d0000;color:white;" : "background:black;color:white;")?> " class="btn btn-default">Nisan <?=date('Y')?></a>
                  <a href="<?=base_url("kullanici/muhasebe_rapor/5")?>"   style="<?=($current_month == 5 ? "background : #7d0000;color:white;" : "background:black;color:white;")?> " class="btn btn-default">Mayıs <?=date('Y')?></a>
                  <a href="<?=base_url("kullanici/muhasebe_rapor/6")?>"   style="<?=($current_month == 6 ? "background : #7d0000;color:white;" : "background:black;color:white;")?> " class="btn btn-default">Haziran <?=date('Y')?></a>
                  <a href="<?=base_url("kullanici/muhasebe_rapor/7")?>"   style="<?=($current_month == 7 ? "background : #7d0000;color:white;" : "background:black;color:white;")?> " class="btn btn-default">Temmuz <?=date('Y')?></a>
                  <a href="<?=base_url("kullanici/muhasebe_rapor/8")?>"   style="<?=($current_month == 8 ? "background : #7d0000;color:white;" : "background:black;color:white;")?> " class="btn btn-default">Ağustos <?=date('Y')?></a>
                  <a href="<?=base_url("kullanici/muhasebe_rapor/9")?>"   style="<?=($current_month == 9 ? "background : #7d0000;color:white;" : "background:black;color:white;")?> " class="btn btn-default">Eylül <?=date('Y')?></a>
                  <a href="<?=base_url("kullanici/muhasebe_rapor/10")?>"  style="<?=($current_month == 10 ? "background : #7d0000;color:white;" : "background:black;color:white;")?> " class="btn btn-default">Ekim <?=date('Y')?></a>
                  <a href="<?=base_url("kullanici/muhasebe_rapor/11")?>"  style="<?=($current_month == 11 ? "background : #7d0000;color:white;" : "background:black;color:white;")?> " class="btn btn-default">Kasım <?=date('Y')?></a>
                  <a href="<?=base_url("kullanici/muhasebe_rapor/12")?>"  style="<?=($current_month == 12 ? "background : #7d0000;color:white;" : "background:black;color:white;")?> border-radius: 0px; margin-right: -1px;" class="btn btn-default">Aralık <?=date('Y')?></a>
                </div>
              <!-- /.card-header --> 
              <div class="card-body" style="border: 1px solid black;">
             
                <table id="example1muhasebe" class="table text-sm table-bordered table-responsive table-striped" style="zoom:0.88"   >
                  <thead style="width: 100% !important;">
                  <tr>
                  <th>Sipariş Kayıt Tarihi</th> 
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

                    $vadeli_t_satis_fiyati = 0;
                    $vadeli_t_kapora = 0;
                    $vadeli_t_pesinat = 0;
                    $vadeli_t_takas_bedeli = 0;
                    $vadeli_t_taksit = 0;
                    $vadeli_t_fatura = 0;

                    $pesin_t_satis_fiyati = 0;
                    $pesin_t_kapora = 0;
                    $pesin_t_pesinat = 0;
                    $pesin_t_takas_bedeli = 0;
                    $pesin_t_taksit = 0;
                    $pesin_t_fatura = 0;
                    ?>
                   <?php foreach ($kullanicilar as $kullanici){?>
                    <?php 
                    
                    $t_satis_fiyati += $kullanici->satis_fiyati;
                    $t_kapora += $kullanici->kapora_fiyati;
                    $t_pesinat += $kullanici->pesinat_fiyati;
                    $t_takas_bedeli += $kullanici->takas_bedeli;
                    $t_fatura += $kullanici->fatura_tutari;
                   
                    if($kullanici->odeme_secenek == "1"){
                      $pesin_t_satis_fiyati += $kullanici->satis_fiyati;
                      $pesin_t_kapora += $kullanici->kapora_fiyati;
                      $pesin_t_pesinat += $kullanici->pesinat_fiyati;
                      $pesin_t_takas_bedeli += $kullanici->takas_bedeli;
                      $pesin_t_fatura += $kullanici->fatura_tutari;
                  
                    }else{
                      $vadeli_t_satis_fiyati += $kullanici->satis_fiyati;
                      $vadeli_t_kapora += $kullanici->kapora_fiyati;
                      $vadeli_t_pesinat += $kullanici->pesinat_fiyati;
                      $vadeli_t_takas_bedeli += $kullanici->takas_bedeli;
                      $vadeli_t_fatura += $kullanici->fatura_tutari;
                    }
                  

                  
                    
                    ?>
                    <tr>
                    <td>
                         <?=date("d.m.Y H:i",strtotime($kullanici->kayit_tarihi))?> 
                      </td>
                      <td>
                        <i class="fa fa-user" style="margin-right:5px;opacity:0.8"></i>
                        <?=$kullanici->kullanici_ad_soyad?> 
                      </td>
                      <td>
                        <i class="fa fa-users" style="margin-right:5px;opacity:0.8"></i>
                        <?=$kullanici->musteri_ad?> 
                      </td>
                      <td style="<?=talep_var_mi($kullanici->musteri_iletisim_numarasi) ? "background:#0f6700;color:white":""?>">
                        <i class="fa fa-phone" style="margin-right:5px;opacity:0.8"></i>
                     <?php 
                        if($a_id != 111 ){
?>
    <span ><?=$kullanici->musteri_iletisim_numarasi?> <?=talep_var_mi($kullanici->musteri_iletisim_numarasi) ? "(Reklam)":""?></span>
                    
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
                      </td>
                     
                      <td style="background:#47ff6f38">
                        
                        <?=($f_kontrol ? number_format($kullanici->satis_fiyati,2)." ₺" : "<span class='text-danger'>**.***</span>")?> 
                      </td>
                      <td style="<?php if($kullanici->kapora_fiyati == 0){ echo "background:#ff000045;";}?>">
                      
                      <?=($f_kontrol ? number_format($kullanici->kapora_fiyati,2)." ₺" : "<span class='text-danger'>**.***</span>")?> 
                    </td>
                      <td>
                       
                       <?=($f_kontrol ? number_format($kullanici->pesinat_fiyati,2)." ₺" : "<span class='text-danger'>**.***</span>")?> 
                      </td>
                    
                      <td style="<?php if($kullanici->takas_bedeli == 0){ echo "background:#ffff0033;";}?>">
                        
                         <?=($f_kontrol ? number_format($kullanici->takas_bedeli,2)." ₺" : "<span class='text-danger'>**.***</span>")?> 
                      </td>
                     
                      <td style="<?php if($kullanici->fatura_tutari == 0){ echo "background:#ff000045;";}?>">
                        
                        <?=($f_kontrol ? number_format($kullanici->fatura_tutari,2)." ₺" : "<span class='text-danger'>**.***</span>")?> 
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
                            echo " (".(($f_kontrol ? number_format($kalan_tutar ,2)." ₺" : "<span class='text-danger'>**.***</span>"));
                            echo "<span style='opacity:0.6'> - Taksit :".($f_kontrol ? number_format($kalan_tutar/$kullanici->vade_sayisi)." ₺</span>)" : "<span class='text-danger'>**.***</span>)");
                          $t_taksit += ($kalan_tutar/$kullanici->vade_sayisi);
                          if($kullanici->odeme_secenek == "1"){
                            $pesin_t_taksit += ($kalan_tutar/$kullanici->vade_sayisi);
                        
                          }else{
                            $vadeli_t_taksit += ($kalan_tutar/$kullanici->vade_sayisi);
                          }
                         
                         
                        }
                        
                        ?>
                       
                      </td>
                     
                    </tr>
                  <?php  } ?>
                  <?php 
                  
                  if($f_kontrol){
                    setlocale(LC_MONETARY, 'tr_TR');
 
                    ?>
                      <tr style="background: #ffffff; color: red;">   
                        <td style="text-align: end;font-weight:bold" colspan="5">VADELİ SATIŞLAR TOPLAM : </td>
                        <td style="font-weight:bold"><?=money_format('%i', $vadeli_t_satis_fiyati)?></td>
                        <td style="font-weight:bold"><?=money_format('%i', $vadeli_t_kapora)?></td>
                        <td style="font-weight:bold"><?=money_format('%i', $vadeli_t_pesinat)?></td>
                        <td style="font-weight:bold"><?=money_format('%i', $vadeli_t_takas_bedeli)?></td>
                        <td style="font-weight:bold"><?=money_format('%i', $vadeli_t_fatura)?></td>
                        <td style="font-weight:bold">-</td>
                        <td style="font-weight:bold"><?=money_format('%i', $vadeli_t_taksit)?></td>
                      </tr>
                      <tr style="background: #ffffff; color: red;">   
                        <td style="text-align: end;font-weight:bold" colspan="5">PEŞİN SATIŞLAR TOPLAM : </td>
                        <td style="font-weight:bold"><?=money_format('%i', $pesin_t_satis_fiyati)?></td>
                        <td style="font-weight:bold"><?=money_format('%i', $pesin_t_kapora)?></td>
                        <td style="font-weight:bold"><?=money_format('%i', $pesin_t_pesinat)?></td>
                        <td style="font-weight:bold"><?=money_format('%i', $pesin_t_takas_bedeli)?></td>
                        <td style="font-weight:bold"><?=money_format('%i', $pesin_t_fatura)?></td>
                        <td style="font-weight:bold">-</td>
                        <td style="font-weight:bold">-</td>
                      </tr>
                      <tr style="background: #7d0000;color: white;">   
                        <td style="text-align: end;font-weight:bold" colspan="5">GENEL TOPLAM : </td>
                        <td style="font-weight:bold"><?=money_format('%i', $t_satis_fiyati)?></td>
                        <td style="font-weight:bold"><?=money_format('%i', $t_kapora)?></td>
                        <td style="font-weight:bold"><?=money_format('%i', $t_pesinat)?></td>
                        <td style="font-weight:bold"><?=money_format('%i', $t_takas_bedeli)?></td>
                        <td style="font-weight:bold"><?=money_format('%i', $t_fatura)?></td>
                        <td style="font-weight:bold">-</td>
                        <td style="font-weight:bold"><?=money_format('%i', $t_taksit)?></td>
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










<div class="col col-md-12"> 
            
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
           





















<div class="row">





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