 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:8px">
 <style>.dataTables_wrapper th, td { white-space: nowrap; }</style>








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
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body" style="border: 1px solid black;">
                <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
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
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body" style="border: 1px solid black;">
                <canvas id="pieChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
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
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body" style="border: 1px solid black;">
                    <canvas id="pieChart3" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
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
                  <button type="button" style="border-radius: 0px; margin-left: -1px;background: #000000; color: #ffc107;" onclick="filterwrite(this,'');" class="btn btn-default">Tümünü Görüntüle</button> 
                  <button type="button" style="background: #000000; color: white;" onclick="filterwrite(this,'01.<?=date('Y')?>');" class="btn btn-default">Ocak <?=date('Y')?></button>
                  <button type="button" style="background: #000000; color: white;" onclick="filterwrite(this,'02.<?=date('Y')?>');" class="btn btn-default">Şubat <?=date('Y')?></button>
                  <button type="button" style="background: #000000; color: white;" onclick="filterwrite(this,'03.<?=date('Y')?>');" class="btn btn-default">Mart <?=date('Y')?></button>
                  <button type="button" style="background: #000000; color: white;" onclick="filterwrite(this,'04.<?=date('Y')?>');" class="btn btn-default">Nisan <?=date('Y')?></button>
                  <button type="button" style="background: #000000; color: white;" onclick="filterwrite(this,'05.<?=date('Y')?>');" class="btn btn-default">Mayıs <?=date('Y')?></button>
                  <button type="button" style="background: #000000; color: white;" onclick="filterwrite(this,'06.<?=date('Y')?>');" class="btn btn-default">Haziran <?=date('Y')?></button>
                  <button type="button" style="background: #000000; color: white;" onclick="filterwrite(this,'07.<?=date('Y')?>');" class="btn btn-default">Temmuz <?=date('Y')?></button>
                  <button type="button" style="background: #000000; color: white;" onclick="filterwrite(this,'08.<?=date('Y')?>');" class="btn btn-default">Ağustos <?=date('Y')?></button>
                  <button type="button" style="background: #000000; color: white;" onclick="filterwrite(this,'09.<?=date('Y')?>');" class="btn btn-default">Eylül <?=date('Y')?></button>
                  <button type="button" style="background: #000000; color: white;" onclick="filterwrite(this,'10.<?=date('Y')?>');" class="btn btn-default">Ekim <?=date('Y')?></button>
                  <button type="button" style="background: #000000; color: white;" onclick="filterwrite(this,'11.<?=date('Y')?>');" class="btn btn-default">Kasım <?=date('Y')?></button>
                  <button type="button" style="border-radius: 0px; margin-right: -1px;background: #000000; color: white;" onclick="filterwrite(this,'12.<?=date('Y')?>');" class="btn btn-default">Aralık <?=date('Y')?></button>
                </div>
              <!-- /.card-header --> 
              <div class="card-body" style="border: 1px solid black;">
             
                <table id="example1muhasebe" class="table text-sm table-bordered table-responsive table-striped"    >
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
                   <?php foreach ($kullanicilar as $kullanici){?>
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
                      <td>
                        <i class="fa fa-phone" style="margin-right:5px;opacity:0.8"></i>
                     <?php 
                        if($a_id == 1 || $a_id == 4 || $a_id == 6){
?>
    <span style="<?=talep_var_mi($kullanici->musteri_iletisim_numarasi) ? "color:red;":""?>"><?=$kullanici->musteri_iletisim_numarasi?></span>
                    
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
                        
                        <?=number_format($kullanici->satis_fiyati,2)." ₺"?> 
                      </td>
                      <td style="<?php if($kullanici->kapora_fiyati == 0){ echo "background:#ff000045;";}?>">
                      
                      <?=number_format($kullanici->kapora_fiyati,2)." ₺"?>  
                    </td>
                      <td>
                       
                       <?=number_format($kullanici->pesinat_fiyati,2)." ₺"?> 
                      </td>
                    
                      <td style="<?php if($kullanici->takas_bedeli == 0){ echo "background:#ffff0033;";}?>">
                        
                         <?=number_format($kullanici->takas_bedeli,2)." ₺"?>  
                      </td>
                     
                      <td style="<?php if($kullanici->fatura_tutari == 0){ echo "background:#ff000045;";}?>">
                        
                        <?=number_format($kullanici->fatura_tutari,2)." ₺"?> 
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
                            echo " (".number_format($kalan_tutar ,2)." ₺";
                            echo "<span style='opacity:0.6'> - Taksit :".(number_format($kalan_tutar/$kullanici->vade_sayisi)." ₺</span>)");
                          }
                        
                        ?>
                       
                      </td>
                     
                    </tr>
                  <?php  } ?>
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
                              <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                              </button>
                            </div>
                          </div>
                          <div class="card-body" style="border: 1px solid black;">
                          <div id="bar-chart" style="height: 300px;"></div>
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
                              <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
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


    var donutData        = {
      labels: [],
      datasets: [
        {
          data: [],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var phpVeri = <?php echo json_encode($satis_pesin_reports); ?>;
    phpVeri.forEach(function(entry) {
        donutData.labels.push(entry.kullanici_ad_soyad);
        donutData.datasets[0].data.push(entry.toplam_satis_adedi);
    });
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = donutData;
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    new Chart(pieChartCanvas, {
      type: 'doughnut',
      data: pieData,
      options: pieOptions
    })








    
    var donutData2        = {
      labels: [],
      datasets: [
        {
          data: [],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var phpVeri2 = <?php echo json_encode($satis_vadeli_reports); ?>;
    phpVeri2.forEach(function(entry) {
        donutData2.labels.push(entry.kullanici_ad_soyad);
        donutData2.datasets[0].data.push(entry.toplam_satis_adedi);
    });
    var pieChartCanvas2 = $('#pieChart2').get(0).getContext('2d')
    var pieData2        = donutData2;
    var pieOptions2     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    new Chart(pieChartCanvas2, {
      type: 'doughnut',
      data: pieData2,
      options: pieOptions2
    })













    var donutData6        = {
      labels: [],
      datasets: [
        {
          data: [],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var phpVeri6 = <?php echo json_encode($satis_bolge_adet_reports); ?>;
    phpVeri6.forEach(function(entry) {
        donutData6.labels.push(entry.kullanici_bolge);
        donutData6.datasets[0].data.push(entry.toplam_satis_adedi);
    });
    var pieChartCanvas6 = $('#pieChart3').get(0).getContext('2d')
    var pieData6        = donutData6;
    var pieOptions6    = {
      maintainAspectRatio : false,
      responsive : true,
    }
    new Chart(pieChartCanvas6, {
      type: 'doughnut',
      data: pieData6,
      options: pieOptions6
    })













        /*
     * BAR CHART
     * ---------
     */

     var bar_data = {
    data: [],
    bars: { show: true }
};

var phpVeri3 = <?php echo json_encode($satis_ay_reports); ?>;


for (let i = 0; i < 12; i++) {
    bar_data.data.push([]);
}

 

for (let index = 0; index < 12; index++) {
    bar_data.data[index].push(phpVeri3[index].ay); 
    bar_data.data[index].push(phpVeri3[index].toplam_satis_adedi);
}
   
   





    $.plot('#bar-chart', [bar_data], {
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
        ticks: [[1,'Ocak'], [2,'Şubat'], [3,'Mart'], [4,'Nisan'], [5,'Mayıs'], [6,'Haziran'], [7,'Temmuz'], [8,'Ağustos'], [9,'Eylül'], [10,'Ekim'], [11,'Kasım'], [12,'Aralık']]
      }
    })
    /* END BAR CHART */









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