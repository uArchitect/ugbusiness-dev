<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">

  <div class="row">
    <?php 
    if(empty($_GET["page"])) {
    ?>
      <a href="?page=1" class="btn btn-primary col-md-1 custom-btn">Beklemede</a>
      <a href="?page=2" class="btn btn-default col-md-1 custom-btn">Satış</a>
      <a href="?page=3" class="btn btn-default col-md-1 custom-btn">Bilgi Verildi</a>
      <a href="?page=4" class="btn btn-default col-md-1 custom-btn">Müşteri Memnuniyeti</a>
      <a href="?page=5" class="btn btn-default col-md-1 custom-btn">Dönüş Yapılacak</a>
      <a href="?page=6" class="btn btn-default col-md-1 custom-btn">Olumsuz</a>
      <a href="?page=7" class="btn btn-default col-md-1 custom-btn">Numara Hatalı</a>
      <a href="?page=8" class="btn btn-default col-md-1 custom-btn">Ulaşılmadı / Tekrar Aranacak</a>
    <?php
    } else {
    ?> 
      <a href="?page=1" class="btn col-md-1 <?=(!empty($_GET["page"]) && $_GET["page"] == "1") ? "btn-primary":"btn-default"?> custom-btn">Beklemede</a>
      <a href="?page=2" class="btn col-md-1 <?=(!empty($_GET["page"]) && $_GET["page"] == "2") ? "btn-primary":"btn-default"?> custom-btn">Satış</a>
      <a href="?page=3" class="btn col-md-1 <?=(!empty($_GET["page"]) && $_GET["page"] == "3") ? "btn-primary":"btn-default"?> custom-btn">Bilgi Verildi</a>
      <a href="?page=4" class="btn col-md-1 <?=(!empty($_GET["page"]) && $_GET["page"] == "4") ? "btn-primary":"btn-default"?> custom-btn">Müşteri Memnuniyeti</a>
      <a href="?page=5" class="btn col-md-1 <?=(!empty($_GET["page"]) && $_GET["page"] == "5") ? "btn-primary":"btn-default"?> custom-btn">Dönüş Yapılacak</a>
      <a href="?page=6" class="btn col-md-1 <?=(!empty($_GET["page"]) && $_GET["page"] == "6") ? "btn-primary":"btn-default"?> custom-btn">Olumsuz</a>
      <a href="?page=7" class="btn col-md-1 <?=(!empty($_GET["page"]) && $_GET["page"] == "7") ? "btn-primary":"btn-default"?> custom-btn">Numara Hatalı</a>
      <a href="?page=8" class="btn col-md-1 <?=(!empty($_GET["page"]) && $_GET["page"] == "8") ? "btn-primary":"btn-default"?> custom-btn">Ulaşılmadı / Tekrar Aranacak</a>
    <?php
    }
    ?>
  </div>

  <div class="row">
    <div class="callout callout-info" style="width: -webkit-fill-available; margin-left: 8px; margin-right: 8px;">
      <p><span id="refreshMessage">Satış temsilcilerine yönlendirilmiş ve henüz beklemede olan talepler listelenmiştir. Bu sayfa <span id="countdown" style="font-size:16px;font-weight:bold">60</span> saniye sonra otomatik olarak yenilenecektir. Şimdi yeniden yüklemek için <a href="<?=base_url("talep/bekleyen_rapor_list")?>">tıklayınız</a></span></p>
    </div>
  </div>

  <div class="row">
    <?php foreach ($bekleyenler as $bekleyen) { ?>
      <div class="col">
        <div class="card custom-card">
          <div class="card-header custom-card-header">
            <form id="myform<?=$bekleyen->kullanici_id?>" action="https://ugbusiness.com.tr/talep/yonlendirmeler" method="post">
              <input type="hidden" name="yonlenen_kullanici_id" value="<?=$bekleyen->kullanici_id?>">
              <a style="cursor:pointer; font-size:22px" onclick="document.getElementById('myform<?=$bekleyen->kullanici_id?>').submit()"><b><?=$bekleyen->kullanici_ad_soyad?></b></a>
            </form>
          </div>
          <div class="card-body">
            <?php foreach ($talepler as $talep) {
              $tarih1 = new DateTime(date("Y-m-d H:i:s"));
              $tarih2 = new DateTime(date("Y-m-d H:i:s", strtotime($talep->yonlendirme_tarihi)));
              $fark = $tarih1->diff($tarih2);
              $gun = $fark->days;
              $saat = $fark->h;
              $dakika = $fark->i;
              if ($talep->yonlenen_kullanici_id != $bekleyen->kullanici_id) continue;
            ?>
              <div class="card custom-card <?= ($gun >= 1 ? "card-danger" : ($saat >= 6 ? "card-warning" : "card-success")) ?> card-outline">
                <div class="card-header custom-card-header" style="background-color: <?= ($gun >= 1 ? "#ff0000" : ($saat >= 6 ? "#ffe200" : "#0eff00")) ?>;">
                  <h5 class="card-title">
                    <b><?= mb_strtoupper($talep->talep_musteri_ad_soyad) ?></b><br>
                    <span style="font-weight:normal"><?= $talep->gorusme_detay ?></span><br>
                    <span style="font-size:13px">
                      <i class="far fa-calendar-alt"></i> Yönlendirme: <?= date("d.m.Y", strtotime($talep->yonlendirme_tarihi)) ?>
                      <i class="fa fa-phone ml-2"></i> İletişim: <?= ($talep->talep_yurtdisi_telefon != "") ? $talep->talep_yurtdisi_telefon : $talep->talep_cep_telefon ?>
                    </span>
                  </h5>
                </div>
                <div class="card-tools">
                  <a href="#" class="btn btn-tool text-danger">
                    <span class="<?= ($gun >= 1 ? "text-danger" : ($saat >= 6 ? "text-warning" : "text-success")) ?>"><b><?= $gun ?></b> gün, <b><?= $saat ?></b> saat, <b><?= $dakika ?></b> dakika önce yönlendirildi.</span>
                  </a>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>

</div>

<style>
  .custom-btn {
    border-radius: 25px;
    transition: all 0.3s ease;
  }
  .custom-btn:hover {
    background-color: #1c87c9;
    color: white;
  }

  .custom-card {
    border-radius: 10px;
    margin-bottom: 15px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  }
  .custom-card-header {
    background-color: #1c87c9;
    color: white;
    font-weight: bold;
    padding: 12px;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
  }
  .custom-card-header:hover {
    background-color: #157a99;
  }

  .custom-card .card-body {
    background-color: #f9f9f9;
    padding: 15px;
  }

  .card-danger .card-header {
    background-color: #ffcccc;
  }
  .card-warning .card-header {
    background-color: #fff3cd;
  }
  .card-success .card-header {
    background-color: #d4edda;
  }

  .yanipsonenyazi2 {
    animation: blinker 0.3s linear infinite;
    color: #1c87c9;
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
  var seconds = 60; // Countdown in seconds

  function startCountdown() {
    var countdownElement = document.getElementById('countdown');
    var refreshMessage = document.getElementById('refreshMessage');
    setInterval(function() {
      seconds--;
      countdownElement.innerHTML = seconds;
      if (seconds <= 0) {
        window.location.reload();
      }
    }, 1000);
  }
  startCountdown();
</script>
