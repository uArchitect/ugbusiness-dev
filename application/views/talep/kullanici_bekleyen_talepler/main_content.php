<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <div class="row mb-4">
    <?php 
    if(empty($_GET["page"])) {
    ?>
      <a href="?page=1" class="btn btn-blue col-md-2 custom-btn">Beklemede</a>
      <a href="?page=2" class="btn btn-light-blue col-md-2 custom-btn">Satış</a>
      <a href="?page=3" class="btn btn-light-blue col-md-2 custom-btn">Bilgi Verildi</a>
      <a href="?page=4" class="btn btn-light-blue col-md-2 custom-btn">Müşteri Memnuniyeti</a>
      <a href="?page=5" class="btn btn-light-blue col-md-2 custom-btn">Dönüş Yapılacak</a>
      <a href="?page=6" class="btn btn-light-blue col-md-2 custom-btn">Olumsuz</a>
      <a href="?page=7" class="btn btn-light-blue col-md-2 custom-btn">Numara Hatalı</a>
      <a href="?page=8" class="btn btn-light-blue col-md-2 custom-btn">Ulaşılmadı / Tekrar Aranacak</a>
    <?php
    } else {
    ?> 
      <a href="?page=1" class="btn col-md-2 <?=(!empty($_GET["page"]) && $_GET["page"] == "1") ? "btn-primary":"btn-light-blue"?> custom-btn">Beklemede</a>
      <a href="?page=2" class="btn col-md-2 <?=(!empty($_GET["page"]) && $_GET["page"] == "2") ? "btn-primary":"btn-light-blue"?> custom-btn">Satış</a>
      <a href="?page=3" class="btn col-md-2 <?=(!empty($_GET["page"]) && $_GET["page"] == "3") ? "btn-primary":"btn-light-blue"?> custom-btn">Bilgi Verildi</a>
      <a href="?page=4" class="btn col-md-2 <?=(!empty($_GET["page"]) && $_GET["page"] == "4") ? "btn-primary":"btn-light-blue"?> custom-btn">Müşteri Memnuniyeti</a>
      <a href="?page=5" class="btn col-md-2 <?=(!empty($_GET["page"]) && $_GET["page"] == "5") ? "btn-primary":"btn-light-blue"?> custom-btn">Dönüş Yapılacak</a>
      <a href="?page=6" class="btn col-md-2 <?=(!empty($_GET["page"]) && $_GET["page"] == "6") ? "btn-primary":"btn-light-blue"?> custom-btn">Olumsuz</a>
      <a href="?page=7" class="btn col-md-2 <?=(!empty($_GET["page"]) && $_GET["page"] == "7") ? "btn-primary":"btn-light-blue"?> custom-btn">Numara Hatalı</a>
      <a href="?page=8" class="btn col-md-2 <?=(!empty($_GET["page"]) && $_GET["page"] == "8") ? "btn-primary":"btn-light-blue"?> custom-btn">Ulaşılmadı / Tekrar Aranacak</a>
    <?php
    }
    ?>
  </div>

  <div class="row">
    <div class="callout callout-info alert-box" style="width: 100%;">
      <p><span id="refreshMessage">Satış temsilcilerine yönlendirilmiş ve henüz beklemede olan talepler listelenmiştir. Bu sayfa <span id="countdown" style="font-size:16px;font-weight:bold">60</span> saniye sonra otomatik olarak yenilenecektir. Şimdi yeniden yüklemek için <a href="<?=base_url("talep/bekleyen_rapor_list")?>">tıklayınız</a></span></p>
    </div>
  </div>

  <div class="row">
    <?php foreach ($bekleyenler as $bekleyen) { ?>
      <div class="col-md-4 mb-4">
        <div class="card shadow-sm custom-card">
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
              <div class="card shadow-sm <?= ($gun >= 1 ? "bg-danger" : ($saat >= 6 ? "bg-warning" : "bg-success")) ?> mb-2">
                <div class="card-header card-header-custom">
                  <h5 class="card-title">
                    <b><?= mb_strtoupper($talep->talep_musteri_ad_soyad) ?></b><br>
                    <span style="font-weight:normal"><?= $talep->gorusme_detay ?></span><br>
                    <span style="font-size:13px">
                      <i class="far fa-calendar-alt"></i> Yönlendirme: <?= date("d.m.Y", strtotime($talep->yonlendirme_tarihi)) ?>
                      <i class="fa fa-phone ml-2"></i> İletişim: <?= ($talep->talep_yurtdisi_telefon != "") ? $talep->talep_yurtdisi_telefon : $talep->talep_cep_telefon ?>
                    </span>
                  </h5>
                </div>
                <div class="card-body">
                  <span class="time-ago"><?= $gun ?> gün, <?= $saat ?> saat, <?= $dakika ?> dakika önce yönlendirildi.</span>
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
    border-radius: 30px;
    transition: all 0.3s ease-in-out;
    text-transform: uppercase;
    font-weight: bold;
    padding: 12px 20px;
    text-align: center;
  }

  .btn-blue {
    background-color: #007bff;
    color: white;
  }

  .btn-light-blue {
    background-color: #a0c1d1;
    color: white;
  }

  .btn-blue:hover, .btn-light-blue:hover {
    background-color: #0056b3;
    color: white;
    transform: translateY(-2px);
  }

  .custom-card {
    border-radius: 15px;
    overflow: hidden;
    background-color: #f9f9f9;
    margin-bottom: 20px;
  }

  .custom-card-header {
    background-color: #007bff;
    color: white;
    padding: 20px;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 18px;
  }

  .custom-card-header:hover {
    background-color: #0056b3;
  }

  .card-header-custom {
    background-color: #f1f1f1;
    font-size: 14px;
    padding: 15px;
    color: #555;
    font-weight: normal;
  }

  .card-body {
    background-color: #ffffff;
    padding: 15px;
    color: #555;
  }

  .bg-success {
    background-color: #28a745 !important;
  }

  .bg-warning {
    background-color: #ffc107 !important;
  }

  .bg-danger {
    background-color: #dc3545 !important;
  }

  .time-ago {
    font-size: 12px;
    color: #999;
  }

  .alert-box {
    background-color: #eef6f9;
    border-left: 5px solid #007bff;
    padding: 20px;
    margin-bottom: 20px;
  }

  .yanipsonenyazi2 {
    animation: blinker 0.3s linear infinite;
  }

  @keyframes blinker {
    50% {
      opacity: 0;
    }
  }

  #countdown {
    font-weight: bold;
    font-size: 20px;
    color: #dc3545;
  }
</style>

<script>
  var seconds = 60;

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
