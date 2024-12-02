foreach ($data['content'] as $order) {
        echo "Sipariş ID: " . $order['id'] . PHP_EOL;
        echo "Müşteri Adı: " . $order['customerFirstName'] .' '.$order['customerLastName']. PHP_EOL;
        echo "Toplam Tutar: " . $order['totalPrice'] . PHP_EOL;
        echo "Durum: " . $order['status'] . PHP_EOL;
           echo "Adres: " . $order['invoiceAddress']['fullAddress'] . PHP_EOL;
            echo "Ürün: " . $order['lines'][0]['productName'] . PHP_EOL;
            echo "Sipariş Tarihi: " . date("d.m.Y H:i", $order['orderDate'] / 1000) . PHP_EOL;
           echo "Fatura: " .$order['invoiceLink']  . PHP_EOL;
           
        echo str_repeat('-', 20) . PHP_EOL;
        
    }








     
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
                <table id="examplekullanicilar" class="table table-bordered table-striped"    >
                  <thead>
                  <tr>
               
                    <th>Siparis</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php  
                    
                    foreach ($data['content'] as $order) {
                        echo "<tr><td>";
                        echo "Sipariş ID: " . $order['id'] . PHP_EOL;
                        echo "Müşteri Adı: " . $order['customerFirstName'] .' '.$order['customerLastName']. PHP_EOL;
                        echo "Toplam Tutar: " . $order['totalPrice'] . PHP_EOL;
                        echo "Durum: " . $order['status'] . PHP_EOL;
                           echo "Adres: " . $order['invoiceAddress']['fullAddress'] . PHP_EOL;
                            echo "Ürün: " . $order['lines'][0]['productName'] . PHP_EOL;
                            echo "Sipariş Tarihi: " . date("d.m.Y H:i", $order['orderDate'] / 1000) . PHP_EOL;
                           echo "Fatura: " .$order['invoiceLink']  . PHP_EOL;
                           
                        echo str_repeat('-', 20) . PHP_EOL;
                        echo "</td></tr>";
                    }
                    
                    
                    
                    ?>
                  </tbody>
 
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
</section>
            </div>