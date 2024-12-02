 


     <?php
      date_default_timezone_set('Europe/Istanbul');
     ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:8px">
 <style>.dataTables_wrapper th, td { white-space: nowrap; }</style>
<section class="content text-md">
<div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title"><strong>UG Business</strong> - Trendyol Son 1 Hafta Siparişler</h3>
                <a href="<?=base_url("kullanici/ekle")?>" type="button" class="btn btn-success btn-xs" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Kayıt Ekle</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="examplekullanicilar" class="table table-bordered table-striped table-responsive"    >
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
                    
                    <?php  
                    
                    foreach ($siparis_data['content'] as $order) {

if($order['status'] == "Picking"){
                            $durum = '<span class="badge bg-primary">İşleme Alındı</span>';
                        }
                        if($order['status'] == "Created"){
                            $durum = '<span class="badge bg-success">Yeni Sipariş</span>';
                        }
                        if($order['status'] == "Shipped"){
                            $durum = '<span class="badge bg-warning">Taşıma Durumunda</span>';
                        }

                        if($order['status'] == "Delivered"){
                            $durum = '<span class="badge bg-dark">Teslim Edildi</span>';
                        }
if($order['status'] == "Cancelled"){
                            $durum = '<span class="badge bg-danger">İptal Edildi</span>';
                        }

                        if($order['status'] == "Returned"){
                            $durum = '<span class="badge bg-orange" style="color:white!important;">İade Edildi</span>'; 
                        }

                        echo "<tr data-order-date='" . ($order['orderDate'] / 1000) . "'>";
                        echo "<td>";
                        echo $order['id'];
                        echo "</td>";

                        echo "<td style='min-width:150px;'>"; 
                        echo $order['customerFirstName'] .' '.$order['customerLastName'];
                        echo "</td>";

                        echo "<td>"; 
                        echo  $order['lines'][0]['productName'] . PHP_EOL;
                        echo "<br><b>Sipariş Tutarı : </b>" . number_format((float)$order['totalPrice'], 2)." ₺ ";
                      
                        echo "</td>";
 

                        echo "<td>"; 
                        echo  $durum ;
                       
                        echo "<br>Sipariş Tarihi: " . date("d.m.Y H:i", ($order['orderDate'] / 1000) - (3 * 3600)) . PHP_EOL;
                         
                        echo "</td>";

                      echo "<td>"; 
                      echo $order['invoiceAddress']['fullAddress'] . PHP_EOL;
                           
                        echo "</td>";
                        echo "<td>"; 
                        if($order['invoiceLink'] != ""){
                            echo "<a class='btn btn-primary' href='".$order['invoiceLink']."'>Faturayı Görüntüle</a>" ;
                        
                        }else{
                            echo "<span class='text-danger'>Fatura Oluşturulmadı</span>";
                        }
                               
                          echo "</td>"; 
                            
                        echo " </tr>";
                    }
                    
                    
                    
                    ?>
                  </tbody>
 
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->


            <div class="card card-warning">
                <div class="card-header">Trendyol Ürünleri</div>
                <div class="card-body">
                    <div class="row">
                        
 <?php  
                    
                    foreach ($urun_data['content'] as $product) {
                         

                        ?>



<div class="card2" style="<?=($product['onSale']) ? "" : "filter: grayscale(100%); opacity: 0.3;"?>">
<div class="content">
<div class="img">
<img style="border: 3px solid #ffffff; outline: 2px solid #393c3721;width:70px;height:70px;border-radius:50%; object-fit:cover" src="<?=$product["images"][0]["url"]?>"> 
                      
</div>
<div class="details">
<div class="name text-bold" style="    min-height: 48px;"><?=$product["title"]?></div>
  <div class="job"><?=$product["categoryName"]?></div>
  </div>
  <?php
  if($product['onSale']){
    ?>
    <span class="text-success">Ürün Satışta / Kalan Stok : <?=$product["quantity"]?> Adet</span>
    <?php
  }else{
    ?>
    <span class="text-danger">Ürün Satışta Değil</span>
    <?php
  }
  ?>
 


 <div class="d-flex">
 <div   class="media-icons text-primary" style="flex:1;background: #ebebeb; color: black !important; border-radius: 5px; padding: 5px 5px;">
  <b>Satış Fiyatı</b><br><?=number_format((float)$product['salePrice'], 2)?> ₺
   
 </div>

 <div   class="media-icons text-primary" style="flex:1;margin-left:3px;background: #ebebeb; color: black !important; border-radius: 5px; padding: 5px 5px;">
 
  <b>Liste Fiyatı</b><br><?=number_format((float)$product['listPrice'], 2)?> ₺

 </div>
 </div>

 <?php
  if($product['onSale']){
    ?>
    <a   href="<?=$product['productUrl']?>" target="_blank" style="width: -webkit-fill-available; margin-top: 3px;" class="btn btn-success">
 <i class="fa fa-eye"></i>   
 Ürünü Trendyol'da Görüntüle</a>
    <?php
  }else{
    ?>
<button disabled   target="_blank" title="Ürün Satışta Değil" style="width: -webkit-fill-available; margin-top: 3px;" class="btn btn-dark">
 <i class="fa fa-eye"></i>   
 Ürünü Trendyol'da Görüntüle</button>
    <?php
  }
  ?>

 


</div>
</div>


                        <?php
                    }
                        ?>

                    </div>
               
                </div>
            </div>







            <div class="card card-danger">
                <div class="card-header">Trendyol Soru & Cevap</div>
                <div class="card-body">
                  
                        
 <?php  
                    
                    foreach ($soru_data['content'] as $soru) {
                         ?>



<div class="qa-card" style="    width: -webkit-fill-available;">
        <img src="<?=$soru["imageUrl"]?>" alt="Ürün Görseli">
        <div class="qa-content">
            <h3>Soru : <?=$soru["text"]?>?</h3> 
            <p><strong>Tarih : </strong> <?=date("d.m.Y H:i", ($soru["creationDate"] / 1000))?></p>
            <div class="qa-answer">
                <p><strong>Cevap:</strong><?=$soru["answer"]["text"]?></p>
            </div>
            <div class="qa-info">
                <div class="info-item"><strong>Cevaplanma Tarihi : </strong> <?=date("d.m.Y H:i", ($soru["answer"]["creationDate"] / 1000) )?></div>
                <div class="info-item"><strong>Cevap Veren : </strong> Umex Yetkili</div> 
            </div>
        </div>
    </div>


                         <?php
                    }
                        ?>

               
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