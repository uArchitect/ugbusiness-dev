 


     <?php
      date_default_timezone_set('Europe/Istanbul');
     ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:8px">
 <style>.dataTables_wrapper th, td { white-space: nowrap; }</style>
<section class="content text-md">


<div class="row mb-2" style="
    display: grid;background:White;
">
    <h3 class="card-title text-center" style="display: block;margin: auto;">
    <img src="data:image/png;base64,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" style="
    margin: auto;
">
    
    </h3>
        <div class="d-flex mt-3 mb-3" style="margin: auto;">
            <button class="btn btn-default" style="    background: #ee6433;border-radius: 25px;
    color: white;" onclick="showHide('siparis_div','btn-siparis');" id="btn-siparis">
    <i class="fas fa-cart-arrow-down" style="font-size:13px"></i> 
    TRENDYOL SİPARİŞLERİ</button>
            <button style="border-radius: 25px;" class="btn btn-default mr-2 ml-2" onclick="showHide('urun_div','btn-urun');" id="btn-urun">
            <i class="fas fa-box" style="font-size:13px"></i>   
            TRENDYOL ÜRÜNLERİ</button>
            <button style="border-radius: 25px;" class="btn btn-default mr-2" onclick="showHide('soru_div','btn-soru');" id="btn-soru">
            <i class="fas fa-people-arrows" style="font-size:13px"></i>  
            TRENDYOL SORU &amp; CEVAP</button>

 <a style="border-radius: 25px;" target="_blank" href="https://www.trendyol.com/magaza/umex-lazer-m-534419?sst=0" class="btn btn-default">
 <i class="fas fa-building" style="font-size:13px"></i>    
 MAĞAZAYI GÖRÜNTÜLE</a>


            
        </div>
    </div>
<div class="card card-dark" id="siparis_div">
 
              <!-- /.card-header -->
              <div class="card-body">
                <table id="examplekullanicilar" class="table table-bordered table-striped table-responsive"    >
                  <thead>
                  <tr>
               
                    <th style="min-width:150px;">Siparis ID</th>
                    <th style="min-width:140px;">Müşteri</th>
                    <th style="min-width:340px;">Ürün Detayları</th>

                    <th>Siparis Durum</th>
                    <th>Adres Bilgileri</th>
                    <th>Fatura</th>

                  </tr>
                  </thead>
                  <tbody>
                    
                    <?php  
                    
                    foreach ($siparis_data['content'] as $order) {

if($order['status'] == "Picking"){
                            $durum = '<span class="badge bg-primary"><i class="fas fa-clock"></i> İşleme Alındı</span>';
                        }
                        if($order['status'] == "Created"){
                            $durum = '<span class="badge bg-success yanipsonenyazi">Yeni Sipariş</span>';
                        }
                        if($order['status'] == "Shipped"){
                            $durum = '<span class="badge bg-warning" style="width: -webkit-fill-available;"><i class="fa fa-truck"></i> Taşıma Durumunda</span><br><a style="width: -webkit-fill-available;" target="_blank" href="'.$order['cargoTrackingLink'].'" class="btn btn-xs btn-default">Kargo Takip</a>';
                        }

                        if($order['status'] == "Delivered"){
                            $durum = '<span class="badge bg-success" style="width: -webkit-fill-available;"><i class="fa fa-check"></i> Teslim Edildi</span><br><a style="width: -webkit-fill-available;" target="_blank" href="'.$order['cargoTrackingLink'].'" class="btn btn-xs btn-default">Kargo Takip</a>';
                        }
if($order['status'] == "Cancelled"){
                            $durum = '<span class="badge bg-danger" style="width: -webkit-fill-available;"><i class="fa fa-times"></i> İptal Edildi</span>';
                        }

                        if($order['status'] == "Returned"){
                            $durum = '<span class="badge bg-orange" style="color:white!important;width: -webkit-fill-available;"><i class="fa fa-arrow-left"></i> İade Edildi</span><br><a style="width: -webkit-fill-available;" target="_blank" href="'.$order['cargoTrackingLink'].'" class="btn btn-xs btn-default">Kargo Takip</a>'; 
                        }

                        echo "<tr data-order-date='" . ($order['orderDate'] / 1000) . "'>";
                        echo "<td>";
                        echo "<b>".$order['id']."</b><br>";
                        echo date("d.m.Y H:i", ($order['orderDate'] / 1000) - (3 * 3600));
                        echo "</td>";

                        echo "<td style='min-width:150px;'>"; 
                        if($order['shipmentAddress']['firstName'] != $order['customerFirstName']){
    echo "<b>Alıcı</b><br>".$order['shipmentAddress']['firstName'] .' '.$order['shipmentAddress']['lastName']."<br><b>Fatura</b><br>".$order['customerFirstName']." ".$order['customerLastName'];
                        }else{
                              echo $order['shipmentAddress']['firstName'] .' '.$order['shipmentAddress']['lastName'];
                        }
                    
                        echo "</td>";

                        echo "<td>"; 
                        echo  str_replace(", one size","",substr($order['lines'][0]['productName'],0,46)) . PHP_EOL;
                        echo "<br><b>Sipariş Tutarı : </b>" . number_format((float)$order['totalPrice'], 2)." ₺ ";
                      
                        echo "</td>";
 

                        echo "<td>"; 
                        echo  $durum ;
                       
                       
                        echo "</td>";

                      echo "<td>";  
                      echo $order['shipmentAddress']['address1'] . PHP_EOL;
                           
                        echo "</td>";
                        echo "<td class='text-center'>"; 
                        if($order['invoiceLink'] != ""){
                            echo "<a class='btn btn-primary' href='".$order['invoiceLink']."'>Faturayı Görüntüle</a>" ;
                        
                        }else{
                          
                            if($order['status'] == "Cancelled"){
                                 echo "<a class='btn btn-warning'>Sipariş İptal Edildi</a>" ; 
                            }else{
   echo "<a class='btn btn-danger yanipsonenyazi text-white'>Fatura Oluşturulmadı</a>" ; 
                            }
                       
                         
                          
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


            <div class="card card-warning" id="urun_div" style="display:none">
                 
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







            <div class="card card-danger" id="soru_div" style="display:none">
             
                <div class="card-body">
                  
                        
 <?php  
                    
                    foreach ($soru_data['content'] as $soru) {
                         ?>



<div class="qa-card" style="    width: -webkit-fill-available;">
        <img src="<?=$soru["imageUrl"]?>" style="    border: 1px dashed red;" alt="Ürün Görseli">
        <div class="qa-content">
            <h3>Soru : <?=$soru["text"]?>?</h3> 
            <p><strong>Tarih : </strong> <?=date("d.m.Y H:i", ($soru["creationDate"] / 1000))?> <span class="text-danger">(<?=$soru["answeredDateMessage"]?>)</span></p>
            <div class="qa-answer">
                <p><strong>Cevap : </strong><?=$soru["answer"]["text"]?></p>
            </div>
            <div class="qa-info">
                <div class="info-item"><strong>Cevaplanma Tarihi : </strong> <?=date("d.m.Y H:i", ($soru["answer"]["creationDate"] / 1000) )?> <strong style="margin-left:15px;">Cevap Veren : </strong> Umex Yetkili</div>
                
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


  function showHide(divid,btnid){
    document.getElementById("siparis_div").style.display = "none";
    document.getElementById("urun_div").style.display = "none";
    document.getElementById("soru_div").style.display = "none";
    document.getElementById(divid).style.display = "block";




   document.getElementById("btn-siparis").style.background = "#f8f9fa";
   document.getElementById("btn-urun").style.background = "#f8f9fa";
   document.getElementById("btn-soru").style.background = "#f8f9fa";
  
   document.getElementById("btn-siparis").style.color = "#444";
   document.getElementById("btn-urun").style.color = "#444";
   document.getElementById("btn-soru").style.color = "#444";
  


   document.getElementById(btnid).style.background = "#ee6433";
   document.getElementById(btnid).style.color = "#ffffff";
 

}


</script>

<style>
  .yanipsonenyazi {
      animation: blinker 0.6s linear infinite;
      color: red;
    
      font-weight: bold;
      font-family: sans-serif;
      }
      @keyframes blinker {  
      50% { opacity: 0; }
      }
      .select2-container--open {
    z-index: 99999999999999;
    }
  </style>