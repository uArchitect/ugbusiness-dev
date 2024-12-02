 


     
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
               
                    <th>Siparis ID</th>
                    <th>Müşteri</th>
                    <th>Ürün Detayları</th>

                    <th>Siparis ID</th>
                    <th style="max-width : 150px;">Siparis ID</th>
                    <th>Siparis ID</th>

                  </tr>
                  </thead>
                  <tbody>
                    <?php  
                    
                    foreach ($siparis_data['content'] as $order) {
                        echo "<tr>";
                        echo "<td>";
                        echo $order['id'];
                        echo "</td>";

                        echo "<td>"; 
                        echo $order['customerFirstName'] .' '.$order['customerLastName'];
                        echo "</td>";

                        echo "<td>"; 
                        echo  $order['lines'][0]['productName'] . PHP_EOL;
                        echo "<br>" . $order['totalPrice'] . PHP_EOL;
                      
                        echo "</td>";
 

                        echo "<td>"; 
                        echo "Durum: " . $order['status'] . PHP_EOL;
                       
                        echo "<br>Sipariş Tarihi: " . date("d.m.Y H:i", $order['orderDate'] / 1000) . PHP_EOL;
                         
                        echo "</td>";

                      echo "<td style='max-width: 150px !important;'>"; 
                      echo "Adres: " . $order['invoiceAddress']['fullAddress'] . PHP_EOL;
                           
                        echo "</td>";
                        echo "<td>"; 
                        echo "<a class='btn btn-primary' href='".$order['invoiceLink']."'>Faturayı Görüntüle</a>" ;
                               
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
</section>
            </div>