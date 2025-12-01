 
<style>
  .col{
    font-size:16px !important;
    padding:0px;
  }
  .col>span{
    font-weight:bolder;
    font-size:27px !important;
    padding:0px;
  }
  p{
    font-size:13px !important;
  }
  </style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:0px">
<?php
 
$dataPoints = array();
	foreach ($data as $d) {
    array_push($dataPoints,array("label"=> $d->kaynak_adi, "y"=>  $d->toplam_talep_tayisi,"color"=>$d->talep_kaynak_renk));
  }
?>



<div class="card card-dark m-2">
  <div class="card-header">TALEP RAPORU</div>
  <div class="card-body">
  <div class="btn-group" style="padding: 0px;width: -webkit-fill-available;">
                  <a href="?filterMonth=0" type="button" style="border-radius: 0px; margin-left: -1px;background: #000000; <?=(isset($_GET["filterMonth"]) && ($_GET["filterMonth"] == 0)) ? "color: #ffc107;" : "color: white;"?>" class="btn btn-default">Tümünü Görüntüle</a> 
                  <a href="?filterMonth=1" type="button" style="background: #000000; <?=(isset($_GET["filterMonth"]) && ($_GET["filterMonth"] == 1)) ? "color: #ffc107;" : "color: white;"?>" class="btn btn-default">Ocak <?=date("Y")?></a>
                  <a href="?filterMonth=2" type="button" style="background: #000000; <?=(isset($_GET["filterMonth"]) && ($_GET["filterMonth"] == 2)) ? "color: #ffc107;" : "color: white;"?>" class="btn btn-default">Şubat <?=date("Y")?></a>
                  <a href="?filterMonth=3" type="button" style="background: #000000; <?=(isset($_GET["filterMonth"]) && ($_GET["filterMonth"] == 3)) ? "color: #ffc107;" : "color: white;"?>" class="btn btn-default">Mart <?=date("Y")?></a>
                  <a href="?filterMonth=4" type="button" style="background: #000000; <?=(isset($_GET["filterMonth"]) && ($_GET["filterMonth"] == 4)) ? "color: #ffc107;" : "color: white;"?>" class="btn btn-default">Nisan <?=date("Y")?></a>
                  <a href="?filterMonth=5" type="button" style="background: #000000; <?=(isset($_GET["filterMonth"]) && ($_GET["filterMonth"] == 5)) ? "color: #ffc107;" : "color: white;"?>" class="btn btn-default">Mayıs <?=date("Y")?></a>
                  <a href="?filterMonth=6" type="button" style="background: #000000; <?=(isset($_GET["filterMonth"]) && ($_GET["filterMonth"] == 6)) ? "color: #ffc107;" : "color: white;"?>" class="btn btn-default">Haziran <?=date("Y")?></a>
                  <a href="?filterMonth=7" type="button" style="background: #000000; <?=(isset($_GET["filterMonth"]) && ($_GET["filterMonth"] == 7)) ? "color: #ffc107;" : "color: white;"?>" class="btn btn-default">Temmuz <?=date("Y")?></a>
                  <a href="?filterMonth=8" type="button" style="background: #000000; <?=(isset($_GET["filterMonth"]) && ($_GET["filterMonth"] == 8)) ? "color: #ffc107;" : "color: white;"?>" class="btn btn-default">Ağustos <?=date("Y")?></a>
                  <a href="?filterMonth=9" type="button" style="background: #000000; <?=(isset($_GET["filterMonth"]) && ($_GET["filterMonth"] == 9)) ? "color: #ffc107;" : "color: white;"?>" class="btn btn-default">Eylül <?=date("Y")?></a>
                  <a href="?filterMonth=10" type="button" style="background: #000000; <?=(isset($_GET["filterMonth"]) && ($_GET["filterMonth"] == 10)) ? "color: #ffc107;" : "color: white;"?>" class="btn btn-default">Ekim <?=date("Y")?></a>
                  <a href="?filterMonth=11" type="button" style="background: #000000; <?=(isset($_GET["filterMonth"]) && ($_GET["filterMonth"] == 11)) ? "color: #ffc107;" : "color: white;"?>" class="btn btn-default">Kasım <?=date("Y")?></a>
                  <a href="?filterMonth=12" type="button" style="border-radius: 0px; margin-right: -1px;background: #000000; <?=(isset($_GET["filterMonth"]) && ($_GET["filterMonth"] == 12)) ? "color: #ffc107;" : "color: white;"?>" class="btn btn-default">Aralık <?=date("Y")?></a>
                </div>





                <form action="<?=base_url("talep/report")?>" method="post">

<div class="row m-2" style="display: flex;">
 
  
        <div class="col mr-2">
          <div class="form-group">
            <label for="formClient-Name">Başlangıç Tarihi</label>
            <div class="input-group">
            
           
            <input type="date" class="form-control" name="baslangic_tarihi" value="<?=(isset($baslangic_tarihi)) ? date("Y-m-d",strtotime($baslangic_tarihi)) : ""?>" data-inputmask-alias="datetime" data-inputmask-inputformat="dd.mm.yyyy" data-mask="" inputmode="numeric">

            </div>
          </div>
        </div>



        <div class="col">
          <div class="form-group">
            <label for="formClient-Name">Bitiş Tarihi</label>
            <div class="input-group">
            
            <input type="date" class="form-control" name="bitis_tarihi" value="<?=(isset($bitis_tarihi)) ? date("Y-m-d",strtotime($bitis_tarihi)) : ""?>" data-inputmask-alias="datetime" data-inputmask-inputformat="dd.mm.yyyy" data-mask="" inputmode="numeric">
 
            </div>
          </div>
        </div>





        <button type="submit" class="btn btn-success" style="height: 40px; margin-top: 30px; padding: 20px; padding-top: 10px;">Filtrele</button>
      </div>  </form>











      <div class="row">
  <div class="col-lg-3 col-6">
    <div class="small-box bg-dark">
      <div class="inner">
        <?php 
        $s = 0;
        foreach ($data as $d) {
          if($d->kaynak_adi == "Sosyal Medya"){
            $s = $d->toplam_talep_tayisi;
          }
        }
        $w = 0;
        foreach ($data as $d) {
          if($d->kaynak_adi == "Website"){
            $w = $d->toplam_talep_tayisi;
          }
        }

        $sat = 0;
        foreach ($data as $d) {
          if($d->kaynak_adi == "Satışçı"){
            $sat = $d->toplam_talep_tayisi;
          }
        }
        ?>
        <h3><?=$s+$w?></h3>
        <p>Toplam Talep Sayısı (Website + Sosyal Medya)</p>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
      
      </a>
    </div>
  </div>
  <div class="col-lg-3 col-6">
    <a href="<?=base_url('talep/rapor_detay?kaynak_adi=Sosyal Medya'.(isset($baslangic_tarihi) ? '&baslangic_tarihi='.date('Y-m-d', strtotime($baslangic_tarihi)) : '').(isset($bitis_tarihi) ? '&bitis_tarihi='.date('Y-m-d', strtotime($bitis_tarihi)) : ''))?>" style="text-decoration: none; color: inherit;">
      <div class="small-box bg-success" style="cursor: pointer; transition: all 0.3s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
        <div class="inner">
          <h3><?=$s?>
          </h3>
          <p>Sosyal Medya Talepleri <i class="fas fa-arrow-right ml-2"></i></p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
      </div>
    </a>
  </div>
  <div class="col-lg-3 col-6">
    <a href="<?=base_url('talep/rapor_detay?kaynak_adi=Website'.(isset($baslangic_tarihi) ? '&baslangic_tarihi='.date('Y-m-d', strtotime($baslangic_tarihi)) : '').(isset($bitis_tarihi) ? '&bitis_tarihi='.date('Y-m-d', strtotime($bitis_tarihi)) : ''))?>" style="text-decoration: none; color: inherit;">
      <div class="small-box bg-warning" style="cursor: pointer; transition: all 0.3s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
        <div class="inner">
          <h3><?=$w?></h3>
          <p>Website Talepleri <i class="fas fa-arrow-right ml-2"></i></p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
      </div>
    </a>
  </div>
  <div class="col-lg-3 col-6">
    <a href="<?=base_url('talep/rapor_detay?kaynak_adi=Satışçı'.(isset($baslangic_tarihi) ? '&baslangic_tarihi='.date('Y-m-d', strtotime($baslangic_tarihi)) : '').(isset($bitis_tarihi) ? '&bitis_tarihi='.date('Y-m-d', strtotime($bitis_tarihi)) : ''))?>" style="text-decoration: none; color: inherit;">
      <div class="small-box bg-danger" style="cursor: pointer; transition: all 0.3s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
        <div class="inner">
          <h3><?=$sat?></h3>
          <p>Satışçı Talepleri <i class="fas fa-arrow-right ml-2"></i></p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
      </div>
    </a>
  </div>
</div>





<div id="chartContainer" style="height: 650px; width: 100%;"></div>



  </div>
</div>














<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>


<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	title:{
		text: "Kategori Bazlı Talep Raporu",
    fontFamily: "tahoma"
	},
	subtitles: [{
		text: "<?=$aciklama?>",
    fontFamily: "tahoma"
	}],
	data: [{
		type: "pie",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - {y} (#percent%)",
		yValueFormatString: "#,##0",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>,
		click: function(e) {
			var kaynak_adi = e.dataPoint.label;
			var url = "<?=base_url('talep/rapor_detay?kaynak_adi=')?>" + encodeURIComponent(kaynak_adi);
			<?php if(isset($baslangic_tarihi)): ?>
				url += "&baslangic_tarihi=<?=date('Y-m-d', strtotime($baslangic_tarihi))?>";
			<?php endif; ?>
			<?php if(isset($bitis_tarihi)): ?>
				url += "&bitis_tarihi=<?=date('Y-m-d', strtotime($bitis_tarihi))?>";
			<?php endif; ?>
			window.location.href = url;
		}
	}]
});

chart.render();
 
}
</script>

</div>












            

