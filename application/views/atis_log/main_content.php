 
  
 <meta http-equiv="refresh" content="5">
<div class="content-wrapper">
 <div class="row">
    <div class="col">
        
 
     
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
         
        
        .card {
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,.05);
        }
        .table-responsive {
            margin-top: 20px;
        }
        .table thead th {
            background-color: #32383dff;
            color: white;
        }
        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
        }
    </style>
 
    <div class=" mt-2">
       <div style="margin:0px;padding:5px;background: #222222ff;color: #ecececff;margin-top: 0px;margin-bottom: 5px;border: 2px solid #dfb600ff;border-radius: 5px;">
     <span style="font-size:15px!important;"><i class="fas fa-exclamation-circle" style="
    margin-right: 4px;
    color: #f7bd00ff;
"></i> 
<b>UG ATIŞ LOG</b>
Veriler her 5 saniyede bir otomatik olarak yenilenmektedir.</span>
 </div>

        <div class="row mt-2">
  
          <div class="col pb-0 p-0 pr-2">
            <!-- small box -->
            <div class="small-box bg-dark mb-2" style="border: 2px solid #dfb600ff;border-radius: 5px;">
              <div class="inner">
                <h3>
<?php echo $beklemede_count; ?>
                </h3>

                <p>Bekleyen Yüklemeler</p>
              </div>
              <div class="icon">
                 <i class="ion ion-load-d"></i>
              </div>
        
            </div>
          </div>

          <div class="col pb-0 p-0">
            <!-- small box -->
            <div class="small-box bg-dark mb-2" style="border: 2px solid #06b600ff;border-radius: 5px;" >
              <div class="inner">
                <h3>
<?php echo $success_count; ?>
                </h3>

                <p>Başarılı Yüklemeler</p>
              </div>
              <div class="icon">
                 <i class="ion ion-load-d"></i>
              </div>
        
            </div>
          </div>
          <!-- ./col -->
          <div class="col col-xs-12 pb-0 pr-0">
            <!-- small box -->
            <div class="small-box bg-dark mb-2" style="border: 2px solid #df0000ff;border-radius: 5px;">
              <div class="inner">
                <h3>
             <?php echo $failure_count; ?>
                </h3>

                <p>Başarısız Yüklemeler</p>
              </div>
              <div class="icon">    <i class="ion ion-android-alert"></i>
           
              </div>
              
            </div>
          </div>
       
       
  <!-- ./col -->
          <div class="col pb-0 pr-0">
            <!-- small box -->
            <div class="small-box bg-dark mb-2" style="border: 2px solid #0086dfff;border-radius: 5px;">
              <div class="inner">
                <h3>
            <?php echo $total_ozel_logs; ?>          </h3>

                <p>Toplam Özel İzinli Yükleme Kaydı</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
            
            </div>
          </div>
          <!-- ./col -->


       
          <!-- ./col -->
          <div class="col pb-0 pr-0">
            <!-- small box -->
            <div class="small-box bg-dark mb-2">
              <div class="inner">
                <h3>
            <?php echo $total_logs; ?>          </h3>

                <p>Toplam Log Kaydı</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
            
            </div>
          </div>
          <!-- ./col -->






        </div>
 

 <div class="row">

<div class="col-md-3 pl-0">

 <div class="col-md-12 pr-0 pl-0">
                <div class="card">
                    <div class="card-header bg-dark text-white" style="border: 2px solid #222222ff;border-radius: 5px;">
                        Yükleme Başarı Oranları
                    </div>
                    <div class="card-body">
                        <div class="chart-container" style="height:220px">
                            <canvas id="successFailureChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 pr-0 pl-0">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        Cihaz Bazlı Atış Yükleme Grafiği
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="totalUniqueChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>


</div>


    <div class="col-md-9 pr-0">
        
        <div class="table-responsive mt-0" style="border-radius:10px;max-height: 675px;">
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>İşlem Tarihi</th>
                        <th>Seri No</th>
                        <th>Sol Kod</th>
                        <th>Sağ Kod</th>
                        <th>Üretilen Kod</th>
                        <th>Özel Geçiş Kodu</th>
                        <th>Başarılı mı?</th>
                        <th>Uyarı</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($logs)): ?>
                        <?php foreach ($logs as $log): ?>
                            <tr <?=($log->atis_yukleme_basarili_mi == 1)?"style='background:#e2ffd7;'":""?>  <?=($log->atis_yukleme_basarili_mi == 0)?"style='background:#fff7e0;'":""?> <?=($log->atis_yukleme_basarili_mi == 2)?"style='background:#ffd8d8;'":""?>>
                                <td><?php echo $log->atis_log_id; ?></td>
                                <td><?php echo $log->islem_tarihi; ?></td>
                                <td><?php echo $log->seri_no; ?></td>
                                <td><?php echo $log->sol_kod; ?></td>
                                <td><?php echo $log->sag_kod; ?></td>
                                <td><?php echo $log->uretilen_kod; ?></td>
                                <td><?php echo $log->ozel_gecis_kodu; ?></td>
                                <td>
                                    <?php if ($log->atis_yukleme_basarili_mi == 1): ?>
                                        <span class="badge bg-success p-2" style=" font-size:14px;   width: -webkit-fill-available;">Başarılı</span>
                                    <?php endif; if($log->atis_yukleme_basarili_mi == 2): ?>
                                        <span class="badge bg-danger p-2" style=" font-size:14px;   width: -webkit-fill-available;"><i style="font-size:14px" class="fa"></i> </span>
                                    <?php endif; if($log->atis_yukleme_basarili_mi == 0): ?>
                                        <span class="badge bg-warning p-2" style=" font-size:14px;   width: -webkit-fill-available;"> ? </span>
                                   
                                        <?php endif; ?>
                                </td>
                                <td><?php echo $log->uyari; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center">Hiç log kaydı bulunamadı.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        
    </div>
 </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        
        const ctx1 = document.getElementById('successFailureChart').getContext('2d');
        const successFailureChart = new Chart(ctx1, {
            type: 'pie', 
            data: {
                labels: ['Bekleyen Yüklemeler','Başarılı Yüklemeler', 'Başarısız Yüklemeler'],
                datasets: [{
                    data: [<?php echo $beklemede_count; ?>, <?php echo $success_count; ?>, <?php echo $failure_count; ?>],
                    backgroundColor: [
                       'rgba(12, 12, 12, 0.8)',   'rgba(40, 167, 69, 0.8)', // Green for success
                        'rgba(220, 53, 69, 0.8)'  // Red for failure
                    ],
                    borderColor: [
                        'rgba(12, 12, 12, 0.8)', 'rgba(40, 167, 69, 1)',
                        'rgba(220, 53, 69, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed !== null) {
                                    label += context.parsed + ' adet';
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });

        
        const ctx2 = document.getElementById('totalUniqueChart').getContext('2d');
        const totalUniqueChart = new Chart(ctx2, {
            type: 'bar', 
            data: {
                labels: [  'Umex Lazer','Umex Plus','Diğer Cihaz'],
                datasets: [{
                    label: 'Sayı',
                    data: [  <?php echo $umexlazeratis; ?>, <?php echo $umexplusatis; ?>, <?php echo $digeratis; ?>],
                    backgroundColor: [
                        'rgba(0, 123, 255, 0.8)',  
                        'rgba(255, 193, 7, 0.8)'   , 'rgba(220, 53, 69, 1)' 
                    ],
                    borderColor: [
                        'rgba(0, 123, 255, 1)',
                        'rgba(255, 193, 7, 1)' , 'rgba(220, 53, 69, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += context.parsed.y + ' adet';
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });
    </script>
 






    </div>
 </div>
</div>