<div class="content-wrapper">
  <div class="button-group mb-4">
    <?php 
    if(empty($_GET["page"])) {
    ?>
      <a href="?page=1" class="btn btn-status btn-primary">Beklemede</a>
      <a href="?page=2" class="btn btn-status btn-info">Satış</a>
      <a href="?page=3" class="btn btn-status btn-success">Bilgi Verildi</a>
      <a href="?page=4" class="btn btn-status btn-warning">Müşteri Memnuniyeti</a>
      <a href="?page=5" class="btn btn-status btn-danger">Dönüş Yapılacak</a>
      <a href="?page=6" class="btn btn-status btn-secondary">Olumsuz</a>
      <a href="?page=7" class="btn btn-status btn-dark">Numara Hatalı</a>
      <a href="?page=8" class="btn btn-status btn-light">Ulaşılmadı</a>
    <?php
    } else {
    ?> 
      <a href="?page=1" class="btn btn-status <?=(!empty($_GET["page"]) && $_GET["page"] == "1") ? "btn-primary":"btn-outline-primary"?>">Beklemede</a>
      <a href="?page=2" class="btn btn-status <?=(!empty($_GET["page"]) && $_GET["page"] == "2") ? "btn-info":"btn-outline-info"?>">Satış</a>
      <a href="?page=3" class="btn btn-status <?=(!empty($_GET["page"]) && $_GET["page"] == "3") ? "btn-success":"btn-outline-success"?>">Bilgi Verildi</a>
      <a href="?page=4" class="btn btn-status <?=(!empty($_GET["page"]) && $_GET["page"] == "4") ? "btn-warning":"btn-outline-warning"?>">Müşteri Memnuniyeti</a>
      <a href="?page=5" class="btn btn-status <?=(!empty($_GET["page"]) && $_GET["page"] == "5") ? "btn-danger":"btn-outline-danger"?>">Dönüş Yapılacak</a>
      <a href="?page=6" class="btn btn-status <?=(!empty($_GET["page"]) && $_GET["page"] == "6") ? "btn-secondary":"btn-outline-secondary"?>">Olumsuz</a>
      <a href="?page=7" class="btn btn-status <?=(!empty($_GET["page"]) && $_GET["page"] == "7") ? "btn-dark":"btn-outline-dark"?>">Numara Hatalı</a>
      <a href="?page=8" class="btn btn-status <?=(!empty($_GET["page"]) && $_GET["page"] == "8") ? "btn-light":"btn-outline-light"?>">Ulaşılmadı</a>
    <?php
    }
    ?>
  </div>

  <div class="alert alert-info auto-refresh-message">
    <span><strong>Satış temsilcilerine yönlendirilmiş ve henüz beklemede olan talepler listelenmiştir.</strong></span>
    <span>Bu sayfa <span id="countdown" class="countdown-timer">60</span> saniye sonra otomatik olarak yenilenecektir.</span>
    <span>Şimdi yeniden yüklemek için <a href="<?=base_url("talep/bekleyen_rapor_list")?>" class="alert-link">tıklayınız</a></span>
  </div>

  <div class="row card-wrapper">
    <?php foreach ($bekleyenler as $bekleyen) { ?>
      <div class="col-md-4 mb-4">
        <div class="card custom-card">
          <div class="card-header">
            <form id="myform<?=$bekleyen->kullanici_id?>" action="https://ugbusiness.com.tr/talep/yonlendirmeler" method="post">
              <input type="hidden" name="yonlenen_kullanici_id" value="<?=$bekleyen->kullanici_id?>">
              <a href="javascript:void(0);" class="card-title" onclick="document.getElementById('myform<?=$bekleyen->kullanici_id?>').submit()"><?=$bekleyen->kullanici_ad_soyad?></a>
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
              <div class="task-card <?= ($gun >= 1 ? "bg-danger" : ($saat >= 6 ? "bg-warning" : "bg-success")) ?>">
                <div class="task-card-header">
                  <h5 class="task-title"><?= mb_strtoupper($talep->talep_musteri_ad_soyad) ?></h5>
                  <small class="task-subtitle"><?= $talep->gorusme_detay ?></small>
                </div>
                <div class="task-card-body">
                  <p class="task-info">
                    <i class="far fa-calendar-alt"></i> Yönlendirme: <?= date("d.m.Y", strtotime($talep->yonlendirme_tarihi)) ?><br>
                    <i class="fa fa-phone"></i> İletişim: <?= ($talep->talep_yurtdisi_telefon != "") ? $talep->talep_yurtdisi_telefon : $talep->talep_cep_telefon ?>
                  </p>
                  <p class="task-time">
                    <?= $gun ?> gün, <?= $saat ?> saat, <?= $dakika ?> dakika önce yönlendirildi.
                  </p>
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
  .button-group {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    margin-bottom: 30px;
  }

  .btn-status {
    padding: 12px 25px;
    font-size: 14px;
    font-weight: bold;
    text-align: center;
    border-radius: 30px;
    transition: background-color 0.3s ease, transform 0.3s ease;
  }

  .btn-status:hover {
    transform: translateY(-5px);
  }

  .btn-outline-primary, .btn-outline-info, .btn-outline-success, .btn-outline-warning, .btn-outline-danger, .btn-outline-secondary, .btn-outline-dark, .btn-outline-light {
    border: 2px solid transparent;
    color: inherit;
  }

  .btn-outline-primary:hover {
    border-color: #007bff;
    background-color: #007bff;
    color: white;
  }

  .btn-primary {
    background-color: #007bff;
    color: white;
    border: none;
  }

  .btn-info {
    background-color: #17a2b8;
    color: white;
    border: none;
  }

  .btn-success {
    background-color: #28a745;
    color: white;
    border: none;
  }

  .btn-warning {
    background-color: #ffc107;
    color: white;
    border: none;
  }

  .btn-danger {
    background-color: #dc3545;
    color: white;
    border: none;
  }

  .btn-secondary {
    background-color: #6c757d;
    color: white;
    border: none;
  }

  .btn-dark {
    background-color: #343a40;
    color: white;
    border: none;
  }

  .btn-light {
    background-color: #f8f9fa;
    color: black;
    border: none;
  }

  .alert {
    padding: 20px;
    background-color: #eaf2f9;
    border-radius: 8px;
    font-size: 16px;
    color: #5c6b73;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .alert-info {
    background-color: #d1ecf1;
    border-color: #bee5eb;
  }

  .alert-link {
    color: #007bff;
    font-weight: bold;
  }

  .alert-link:hover {
    text-decoration: underline;
  }

  .card-wrapper {
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
  }

  .custom-card {
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    width: 100%;
    background-color: #fff;
  }

  .card-header {
    background-color: #f1f3f5;
    padding: 20px;
  }

  .card-body {
    padding: 20px;
  }

  .task-card {
    border-radius: 8px;
    padding: 20px;
    color: white;
    margin-bottom: 15px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
  }

  .task-card:hover {
    transform: translateY(-5px);
  }

  .bg-success {
    background-color: #28a745;
  }

  .bg-warning {
    background-color: #ffc107;
  }

  .bg-danger {
    background-color: #dc3545;
  }

  .task-title {
    font-size: 18px;
    font-weight: bold;
  }

  .task-subtitle {
    font-size: 14px;
    color: #b8c6d3;
  }

  .task-info {
    font-size: 14px;
    color: #ccc;
  }

  .task-time {
    font-size: 12px;
    color: #888;
  }

  .countdown-timer {
    font-size: 20px;
    color: #dc3545;
  }
</style>
