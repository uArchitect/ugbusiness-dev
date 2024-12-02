 


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
// Sorting the orders based on 'orderDate' in descending order (newest first)
$siparis_data['content'] = usort($siparis_data['content'], function ($a, $b) {
    return $b['orderDate'] - $a['orderDate'];
});
?>

                    <?php  
                    
                    foreach ($siparis_data['content'] as $order) {


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
                            $durum = $order['status'];
                        }

                        echo "<tr>";
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

<style>
    table.dataTable td {
    word-wrap: break-word;
    white-space: normal;
}
    </style>

            <script>
                
                </script>