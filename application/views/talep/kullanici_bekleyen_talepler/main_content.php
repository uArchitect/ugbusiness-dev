<div class="content-wrapper">

  <div class="row mb-4">
    <?php 
    if(empty($_GET["page"])) {
    ?>
      <a href="?page=1" class="btn custom-btn btn-primary">Beklemede</a>
      <a href="?page=2" class="btn custom-btn btn-info">Satış</a>
      <a href="?page=3" class="btn custom-btn btn-success">Bilgi Verildi</a>
      <a href="?page=4" class="btn custom-btn btn-warning">Müşteri Memnuniyeti</a>
      <a href="?page=5" class="btn custom-btn btn-danger">Dönüş Yapılacak</a>
      <a href="?page=6" class="btn custom-btn btn-secondary">Olumsuz</a>
      <a href="?page=7" class="btn custom-btn btn-dark">Numara Hatalı</a>
      <a href="?page=8" class="btn custom-btn btn-light">Ulaşılmadı / Tekrar Aranacak</a>
    <?php
    } else {
    ?> 
      <a href="?page=1" class="btn custom-btn <?=(!empty($_GET["page"]) && $_GET["page"] == "1") ? "btn-primary":"btn-outline-primary"?>">Beklemede</a>
      <a href="?page=2" class="btn custom-btn <?=(!empty($_GET["page"]) && $_GET["page"] == "2") ? "btn-info":"btn-outline-info"?>">Satış</a>
      <a href="?page=3" class="btn custom-btn <?=(!empty($_GET["page"]) && $_GET["page"] == "3") ? "btn-success":"btn-outline-success"?>">Bilgi Verildi</a>
      <a href="?page=4" class="btn custom-btn <?=(!empty($_GET["page"]) && $_GET["page"] == "4") ? "btn-warning":"btn-outline-warning"?>">Müşteri Memnuniyeti</a>
      <a href="?page=5" class="btn custom-btn <?=(!empty($_GET["page"]) && $_GET["page"] == "5") ? "btn-danger":"btn-outline-danger"?>">Dönüş Yapılacak</a>
      <a href="?page=6" class="btn custom-btn <?=(!empty($_GET["page"]) && $_GET["page"] == "6") ? "btn-secondary":"btn-outline-secondary"?>">Olumsuz</a>
      <a href="?page=7" class="btn custom-btn <?=(!empty($_GET["page"]) && $_GET["page"] == "7") ? "btn-dark":"btn-outline-dark"?>">Numara Hatalı</a>
      <a href="?page=8" class="btn custom-btn <?=(!empty($_GET["page"]) && $_GET["page"] == "8") ? "btn-light":"btn-outline-light"?>">Ulaşılmadı / Tekrar Aranacak</a>
    <?php
    }
    ?>
  </div>

  <div class="row">
    <div class="alert-box alert alert-info" role="alert">
      <p><span id="refreshMessage">Satış temsilcilerine yönlendirilmiş ve henüz beklemede olan talepler listelenmiştir. Bu sayfa <span id="countdown" style="font-weight:bold">60</span> saniye sonra otomatik olarak yenilenecektir. Şimdi yeniden yüklemek için <a href="<?=base_url("talep/bekleyen_rapor_list")?>" class="alert-link">tıklayınız</a></span></p>
    </div>
  </div>

  <div class="row">
    <?php foreach ($bekleyenler as $bekleyen) { ?>
      <div class="col-md-4 mb-4">
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
              <div class="card custom-card shadow <?= ($gun >= 1 ? "bg-danger" : ($saat >= 6 ? "bg-warning" : "bg-success")) ?> mb-2">
                <div class="card-header custom-card-header">
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
    border-radius: 50px;
    transition: all 0.3s ease-in-out;
    font-weight: 600;
    padding: 12px 30px;
    text-align: center;
    text-transform: uppercase;
  }

  .btn-primary {
    background-color: #007bff;
    border: none;
  }

  .btn-info {
    background-color: #17a2b8;
    border: none;
  }

  .btn-success {
    background-color: #28a745;
    border: none;
  }

  .btn-warning {
    background-color: #ffc107;
    border: none;
  }

  .btn-danger {
    background-color: #dc3545;
    border: none;
  }

  .btn-secondary {
    background-color: #6c757d;
    border: none;
  }

  .btn-dark {
    background-color: #343a40;
    border: none;
  }

  .btn-light {
    background-color: #f8f9fa;
    border: none;
  }

  .btn-outline-primary, .btn-outline-info, .btn-outline-success, .btn-outline-warning, .btn-outline-danger, .btn-outline-secondary, .btn-outline-dark, .btn-outline-light {
    background-color: transparent;
    color: #007bff;
    border: 2px solid #007bff;
  }

  .btn-outline-primary:hover, .btn-outline-info:hover, .btn-outline-success:hover, .btn-outline-warning:hover, .btn-outline-danger:hover, .btn-outline-secondary:hover, .btn-outline-dark:hover, .btn-outline-light:hover {
    background-color: #007bff;
    color: white;
  }

  .custom-card {
    border-radius: 10px;
    overflow: hidden;
    background-color: #f7f7f7;
    border: 1px solid #ddd;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  }

  .custom-card-header {
    background-color: #007bff;
    color: white;
    padding: 20px;
    font-weight: bold;
    font-size: 18px;
    text-transform: uppercase;
    text-align: center;
    border-bottom: 1px solid #ddd;
  }

  .custom-card-header:hover {
    background-color: #0056b3;
  }

  .custom-card .card-body {
    background-color: #ffffff;
    padding: 20px;
    font-size: 14px;
    line-height: 1.6;
  }

  .alert-box {
    background-color: #d1ecf1;
    border-color: #bee5eb;
    color: #0c5460;
    padding: 15px;
    border-radius: 10px;
    margin-bottom: 20px;
  }

  .time-ago {
    font-size: 12px;
    color: #777;
  }

  #countdown {
    font-size: 25px;
    color: #dc3545;
  }

  #refreshMessage {
    font-size: 16px;
  }

  .alert-link {
    color: #007bff;
    font-weight: bold;
  }

  .alert-link:hover {
    text-decoration: underline;
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
