 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">

<div class="row">
 
<?php 
if((empty($_GET["page"]))){
?>
   <a href="?page=1" type="button" class="btn btn-primary col-md-1">Beklemede</a>
   <a href="?page=2" type="button" class="btn btn-default col-md-1">Satış</a>
   <a href="?page=3" type="button" class="btn btn-default col-md-1">Bilgi Verildi</a>
   <a href="?page=4" type="button" class="btn btn-default col-md-1">Müşteri Memnuniyeti</a>
   <a href="?page=5" type="button" class="btn btn-default col-md-1">Dönüş Yapılacak</a>
   <a href="?page=6" type="button" class="btn btn-default col-md-1">Olumsuz</a>
   <a href="?page=7" type="button" class="btn btn-default col-md-1">Numara Hatalı</a>
   <a href="?page=8" type="button" class="btn btn-default col-md-1">Ulaşılmadı / Tekrar Aranacak</a>

<?php
}else{
  ?> 
   <a href="?page=1" type="button" class=" col-md-1 btn <?=(!empty($_GET["page"]) && $_GET["page"] == "1") ? "btn-primary":"btn-default"?> ">Beklemede</a>
   <a href="?page=2" type="button" class=" col-md-1 btn <?=(!empty($_GET["page"]) && $_GET["page"] == "2") ? "btn-primary":"btn-default"?> ">Satış</a>
   <a href="?page=3" type="button" class=" col-md-1 btn <?=(!empty($_GET["page"]) && $_GET["page"] == "3") ? "btn-primary":"btn-default"?> ">Bilgi Verildi</a>
   <a href="?page=4" type="button" class=" col-md-1 btn <?=(!empty($_GET["page"]) && $_GET["page"] == "4") ? "btn-primary":"btn-default"?> ">Müşteri Memnuniyeti</a>
   <a href="?page=5" type="button" class=" col-md-1 btn <?=(!empty($_GET["page"]) && $_GET["page"] == "5") ? "btn-primary":"btn-default"?> ">Dönüş Yapılacak</a>
   <a href="?page=6" type="button" class=" col-md-1 btn <?=(!empty($_GET["page"]) && $_GET["page"] == "6") ? "btn-primary":"btn-default"?> ">Olumsuz</a>
   <a href="?page=7" type="button" class=" col-md-1 btn <?=(!empty($_GET["page"]) && $_GET["page"] == "7") ? "btn-primary":"btn-default"?> ">Numara Hatalı</a>
   <a href="?page=8" type="button" class=" col-md-1 btn <?=(!empty($_GET["page"]) && $_GET["page"] == "8") ? "btn-primary":"btn-default"?> ">Ulaşılmadı / Tekrar Aranacak</a>

  <?php
}
?>
   


</div>

<div class="row">
<div class="callout callout-warning" style="width: -webkit-fill-available; margin-left: 8px; margin-right: 8px;">
 
<p><span id="refreshMessage">Satış temsilcilerine yönlendirilmiş ve henüz beklemede olan talepler listelenmiştir. Bu sayfa <span id="countdown" style="font-size:16px;font-weight:bold">60</span> saniye sonra otomatik olarak yenilenecektir. Şimdi yeniden yüklemek için <a href="<?=base_url("talep/bekleyen_rapor_list")?>">tıklayınız</a></span>
</p>
</div>
</div>
 <div class="row">

<?php

foreach ($bekleyenler as $bekleyen) {
    ?>
<div class="col">

<div class="card">
      <div class="card-header bg-dark text-lg">
        
      
      <form id="myform<?=$bekleyen->kullanici_id?>" action="https://ugbusiness.com.tr/talep/yonlendirmeler" method="post">
                        <input type="hidden" name="yonlenen_kullanici_id" value="<?=$bekleyen->kullanici_id?>">
                        <a style="cursor:pointer;font-size:22px" onclick="document.getElementById('myform<?=$bekleyen->kullanici_id?>').submit()"  ><b><?=$bekleyen->kullanici_ad_soyad?></b></a>
                      </form>
    
    </div>
      <div class="card-body">
        <?php 
        
          foreach ($talepler as $talep) {

            
 

$tarih1 = new DateTime(date("Y-m-d H:i:s"));

 
$tarih2 = new DateTime(date("Y-m-d H:i:s",strtotime($talep->yonlendirme_tarihi)));

 
$fark = $tarih1->diff($tarih2);

 
$gun = $fark->days;
$saat = $fark->h;
$dakika = $fark->i;


            
            if($talep->yonlenen_kullanici_id != $bekleyen->kullanici_id){continue;}
            ?>

              <div class="card <?=(($gun >= 1)?"card-danger":(($saat>=6)?"card-orange":"card-success"))?> card-outline">
                <div class="card-header" style="<?=(($gun >= 1)?"background:#ff000014":(($saat>=6)?"background:#ffe20014":"background:#0eff0014"))?>">
                  <h5 class="card-title" style="font-size: normal;font-weight:bold;"><b><?=mb_strtoupper($talep->talep_musteri_ad_soyad)?></b>



<?php 
if($talep->gorusme_detay){
?>


<br>
                <span style="font-weight:normal">
                <?=$talep->gorusme_detay?>
              </span>

<?php
}
?>


                  <br>
                <span style="font-size:13px"> 
                  
                  <i class="far fa-calendar-alt"></i> Yönlendirme : <?=date("d.m.Y",strtotime($talep->yonlendirme_tarihi))?>
                  <i class="fa fa-phone ml-2"></i> İletişim : <?=($talep->talep_yurtdisi_telefon != "") ? $talep->talep_yurtdisi_telefon : $talep->talep_cep_telefon?>
                  <span>
                </h5>
                  <div class="card-tools" style="float: left;">
                   
      

                    <a href="#" style="    margin-left: -10px;cursor:none" class="btn btn-tool text-danger">
                       <?php
               
 
echo "<span class='".(($gun >= 1)?"text-danger yanipsonenyazi2":(($saat>=6)?"text-orange yanipsonenyazi3":"text-success"))."'><b>$gun</b> gün, <b>$saat</b> saat, <b>$dakika</b> dakika önce yönlendirildi.</span>";
?>
                      
                    </a>
                  </div>
           





                <?php 

if($gun>=0){

  ?>



<div class="btn-group mt-2" style="margin-left:0px!important;width: -webkit-fill-available;">
                       <button type="button" style="margin-left: 0px !important;" class="btn ml-2 btn-xs btn-danger dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                          <span style="margin-right:8px"><i class="fa fa-arrow-circle-right"></i> Talebi Tekrar Yönlendir </span>
                        </button>
                        <div class="dropdown-menu" role="menu" style="left: -141px !important;">
                          
                        <?php 
                          foreach ($kullanicilar as $kullanici) {
                            if($kullanici->kullanici_id == 9){
                              continue;
                            }
                            $url = base_url("talep/tekraryonlendir/$talep->talep_yonlendirme_id/$kullanici->kullanici_id");
                           

                            ?>
                          
 



                          <a class="dropdown-item" style="cursor:pointer"  onclick="confirm_talep_redirect('Yönlendir / <?=$kullanici->kullanici_ad_soyad?>','Seçilen bu talebi [<?=$kullanici->kullanici_ad_soyad?>] adlı kullanıcıya tekrar yönlendirmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Yönlendir','<?= $url ?>');">
                            <b><i class="fa fa-user-circle"></i> <?=$kullanici->kullanici_ad_soyad?> - </b><span style="font-size:13px"><?=$kullanici->kullanici_unvan?></span>
                          </a>

                            <?php
                          }
                          $url2 = base_url("talep/tekraryonlendir/$talep->talep_yonlendirme_id/66");
                           
                        ?>
                           
                          <a class="dropdown-item" style="cursor:pointer"  onclick="confirm_talep_redirect('Yönlendir / Fabrika Satış','Seçilen bu talebi [Fabrika Satış] adlı kullanıcıya tekrar yönlendirmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Yönlendir','<?= $url2 ?>');">
                            <b><i class="fa fa-user-circle"></i> Fabrika Satış </b> 
                          </a>

                         
                          
                        </div>
                      </div>



  <?php


}

?>

</div>






              </div>

            <?php
          }
        ?>
    







      </div>
      <div class="card-footer"></div>
    </div>

    
    </div>
  
<?php
}

?>



 </div>

</div>



            



 <style>
    .yanipsonenyazi2 {
      animation: blinker 0.3s linear infinite;
      color: #1c87c9;
  
      }
      @keyframes blinker {  
      50% { opacity: 0.2; }
      }

      .yanipsonenyazi3 {
      animation: blinker 1.2s linear infinite;
      color: #1c87c9;
  
      }
      @keyframes blinker {  
      50% { opacity: 0.2; }
      }
  </style>
<script>
var seconds = 60;  
var countdownElement = document.getElementById('countdown');

function countdown() {
    seconds--;
    countdownElement.textContent = seconds;  

    if (seconds <= 0) {
        window.location.reload();  
    }
}
 
var countdownInterval = setInterval(countdown, 1000);  

</script>