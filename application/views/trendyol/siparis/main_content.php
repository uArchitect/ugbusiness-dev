 


     <?php
      date_default_timezone_set('Europe/Istanbul');
     ?>

<?php
  date_default_timezone_set('Europe/Istanbul');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:8px">
  <style>
    .dataTables_wrapper th, td { white-space: nowrap; }
    .sidebar {
      width: 250px;
      position: fixed;
      top: 0;
      left: 0;
      height: 100%;
      background-color: #343a40;
      color: white;
      padding-top: 20px;
    }
    .sidebar a {
      color: white;
      padding: 10px 15px;
      text-decoration: none;
      display: block;
    }
    .sidebar a:hover {
      background-color: #575757;
    }
    .content-area {
      margin-left: 260px;
      padding: 15px;
    }
  </style>

  <section class="content text-md">
    <div class="sidebar">
      <a href="#siparisler">Siparişler</a>
      <a href="#urunler">Ürünler</a>
      <a href="#sorular">Sorular</a>
    </div>

    <div class="content-area">
      <!-- Siparişler Section -->
      <div id="siparisler" class="card card-dark">
        <div class="card-header">
          <h3 class="card-title"><strong>UG Business</strong> - Trendyol Son 1 Hafta Siparişler</h3>
          <a href="<?= base_url('kullanici/ekle') ?>" class="btn btn-success btn-xs" style="float: right; padding: 0px 5px;">
            <i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Kayıt Ekle
          </a>
        </div>
        <div class="card-body">
          <table id="examplekullanicilar" class="table table-bordered table-striped table-responsive">
            <thead>
              <tr>
                <th>Siparis ID</th>
                <th style="min-width:150px;">Müşteri</th>
                <th>Ürün Detayları</th>
                <th>Siparis Durum</th>
                <th>Adres Bilgileri</th>
                <th>Fatura</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($siparis_data['content'] as $order): ?>
                <tr data-order-date="<?= ($order['orderDate'] / 1000) ?>">
                  <td><?= $order['id'] ?></td>
                  <td style="min-width:150px;">
                    <?= $order['customerFirstName'] .' '.$order['customerLastName'] ?>
                  </td>
                  <td>
                    <?= $order['lines'][0]['productName'] ?><br><b>Sipariş Tutarı:</b> <?= number_format((float)$order['totalPrice'], 2) ?> ₺
                  </td>
                  <td><?= $durum ?><br>Sipariş Tarihi: <?= date("d.m.Y H:i", ($order['orderDate'] / 1000) - (3 * 3600)) ?></td>
                  <td><?= $order['invoiceAddress']['fullAddress'] ?></td>
                  <td>
                    <?php if ($order['invoiceLink'] != ""): ?>
                      <a class="btn btn-primary" href="<?= $order['invoiceLink'] ?>">Faturayı Görüntüle</a>
                    <?php else: ?>
                      <span class="text-danger">Fatura Oluşturulmadı</span>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Ürünler Section -->
      <div id="urunler" class="card card-warning">
        <div class="card-header">Trendyol Ürünleri</div>
        <div class="card-body">
          <div class="row">
            <?php foreach ($urun_data['content'] as $product): ?>
              <div class="card2" style="<?= ($product['onSale']) ? "" : "filter: grayscale(100%); opacity: 0.3;" ?>">
                <div class="content">
                  <div class="img">
                    <img src="<?= $product["images"][0]["url"] ?>" style="border: 3px solid #ffffff; width:70px;height:70px; border-radius:50%; object-fit:cover">
                  </div>
                  <div class="details">
                    <div class="name text-bold" style="min-height: 48px;"><?= $product["title"] ?></div>
                    <div class="job"><?= $product["categoryName"] ?></div>
                  </div>
                  <?php if ($product['onSale']): ?>
                    <span class="text-success">Ürün Satışta / Kalan Stok: <?= $product["quantity"] ?> Adet</span>
                  <?php else: ?>
                    <span class="text-danger">Ürün Satışta Değil</span>
                  <?php endif; ?>
                  <div class="d-flex">
                    <div class="media-icons text-primary" style="flex:1; background: #ebebeb; color: black; border-radius: 5px; padding: 5px;">
                      <b>Satış Fiyatı</b><br><?= number_format((float)$product['salePrice'], 2) ?> ₺
                    </div>
                    <div class="media-icons text-primary" style="flex:1; margin-left:3px; background: #ebebeb; color: black; border-radius: 5px; padding: 5px;">
                      <b>Liste Fiyatı</b><br><?= number_format((float)$product['listPrice'], 2) ?> ₺
                    </div>
                  </div>
                  <?php if ($product['onSale']): ?>
                    <a href="<?= $product['productUrl'] ?>" target="_blank" class="btn btn-success">
                      <i class="fa fa-eye"></i> Ürünü Trendyol'da Görüntüle
                    </a>
                  <?php else: ?>
                    <button disabled class="btn btn-dark">
                      <i class="fa fa-eye"></i> Ürünü Trendyol'da Görüntüle
                    </button>
                  <?php endif; ?>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

      <!-- Sorular Section -->
      <div id="sorular" class="card card-danger">
        <div class="card-header">Trendyol Soru & Cevap</div>
        <div class="card-body">
          <?php foreach ($soru_data['content'] as $soru): ?>
            <div class="qa-card">
              <img src="<?= $soru["imageUrl"] ?>" alt="Ürün Görseli">
              <div class="qa-content">
                <h3>Soru: <?= $soru["text"] ?>?</h3>
                <p><strong>Tarih:</strong> <?= date("d.m.Y H:i", ($soru["creationDate"] / 1000)) ?> <span class="text-danger">(<?= $soru["answeredDateMessage"] ?>)</span></p>
                <div class="qa-answer">
                  <p><strong>Cevap: </strong><?= $soru["answer"]["text"] ?></p>
                </div>
                <div class="qa-info">
                  <div class="info-item"><strong>Cevaplanma Tarihi: </strong><?= date("d.m.Y H:i", ($soru["answer"]["creationDate"] / 1000)) ?> <strong>Cevap Veren: </strong> Umex Yetkili</div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>
</div>


<style>
    table.dataTable td {
    word-wrap: break-word;
    white-space: normal;
}

.card2 {
    text-align: center;
    width: calc(100% / 5 - 10px);
    background: #fff;
    border-radius: 5px;
    border: 1px solid #073773;
    padding: 10px 5px;
    margin: 5px;
    box-shadow: 0 5px 5px rgba(0, 0, 0, 0.05);
    transition: all 0.4s ease;
}
.qa-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 20px;
            display: flex;
            flex-direction: row;
            gap: 20px;
        }

        .qa-card img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
        }

        .qa-card .qa-content {
            flex-grow: 1;
        }

        .qa-card .qa-content h3 {
            font-size: 18px;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .qa-card .qa-content p {
            font-size: 14px;
            color: #555;
            margin-bottom: 10px;
        }

        .qa-card .qa-info {
            font-size: 12px;
            color: #888;
            margin-top: 10px;
        }

        .qa-card .qa-info .info-item {
            margin-bottom: 5px;
        }

        .qa-card .qa-answer {
            background-color: #f1f1f1;
            padding: 10px;
            border-radius: 8px;
        }

        .qa-card .qa-answer p {
            font-size: 14px;
            margin: 0;
            color: #333;
        }
    </style>

<script> 
  function sortTableByOrderDate() {
    var table = document.getElementById('examplekullanicilar');
    var rows = Array.from(table.rows).slice(1);   
    rows.sort(function(a, b) {
      var dateA = parseInt(a.getAttribute('data-order-date'));
      var dateB = parseInt(b.getAttribute('data-order-date'));
      return dateB - dateA;   
    });
 
    rows.forEach(function(row) {
      table.appendChild(row);
    });
  }
 
  window.onload = sortTableByOrderDate;
</script>