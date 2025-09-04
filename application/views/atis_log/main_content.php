<div class="content-wrapper">
    <div class="row">
        <div class="col">
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <style>
                /* Mevcut CSS kodlarınız */
                .card {
                    margin-bottom: 20px;
                    box-shadow: 0 4px 8px rgba(0,0,0,.05);
                }
                .table-responsive {
                    margin-top: 20px;
                }
                .table thead th {
                    background-color: #16181aff;
                    border-color: #38393aff;
                    color: white;
                }
                .chart-container {
                    position: relative;
                    height: 300px;
                    width: 100%;
                }
            </style>

            <div class=" mt-2">
                   <form action="<?=base_url("atis")?>" method="post">
                <div class="row">
                 
                    <div class="col pl-0 pr-1">
                   <input type="date" name="baslangic_date" style="border:2px solid black!important;    font-weight: 800;" value="<?=date("Y-m-d",strtotime($baslangicTarihZaman))?>" class="form-control" placeholder=".col-3"> 
                    </div>
                     <div class="col">
                   <input type="date" name="bitis_date" style="  border:2px solid black!important;  font-weight: 800;" value="<?=date("Y-m-d",strtotime($bitisTarihZaman))?>" class="form-control" placeholder=".col-3"> 
                    </div>
                    <div class="col-1 p-0">
                          <button type="submit" style="background:#35a74c;width: -webkit-fill-available;" class="btn btn-dark p-2">Filtrele</button>
                    </div>

                    
                      <div class="col-md-6 pr-0">
                        <div class="btn-group" style="width: -webkit-fill-available;">
                        <a href="<?=base_url("atis/index/1")?>"  type="button" style="<?=!empty($filter) && $filter == 1? "" : "background:#222222ff"?>" class="btn <?=!empty($filter) && $filter == 1? "btn-warning" : "btn-dark"?> p-2">Bugün</a>
                        <a href="<?=base_url("atis/index/2")?>"  type="button" style="<?=!empty($filter) && $filter == 2? "" : "background:#222222ff"?>" class="btn <?=!empty($filter) && $filter == 2? "btn-warning" : "btn-dark"?> p-2">Dün</a>
                        <a href="<?=base_url("atis/index/3")?>"  type="button" style="<?=!empty($filter) && $filter == 3? "" : "background:#222222ff"?>" class="btn <?=!empty($filter) && $filter == 3? "btn-warning" : "btn-dark"?> p-2">Son 3 Gün</a>
                        <a href="<?=base_url("atis/index/4")?>"  type="button" style="<?=!empty($filter) && $filter == 4? "" : "background:#222222ff"?>" class="btn <?=!empty($filter) && $filter == 4? "btn-warning" : "btn-dark"?> p-2">Bu Hafta</a>
                        <a href="<?=base_url("atis/index/5")?>"  type="button" style="<?=!empty($filter) && $filter == 5? "" : "background:#222222ff"?>" class="btn <?=!empty($filter) && $filter == 5? "btn-warning" : "btn-dark"?> p-2">Bu Ay</a>
                        <a href="<?=base_url("atis/index/6")?>"  type="button" style="<?=!empty($filter) && $filter == 6? "" : "background:#222222ff"?>" class="btn <?=!empty($filter) && $filter == 6? "btn-warning" : "btn-dark"?> p-2">Geçen Ay</a>
                        <a href="<?=base_url("atis/index/7")?>"  type="button" style="<?=!empty($filter) && $filter == 7? "" : "background:#222222ff"?>" class="btn <?=!empty($filter) && $filter == 7? "btn-warning" : "btn-dark"?> p-2">Son 3 Ay</a>
                        <a href="<?=base_url("atis/index/8")?>"  type="button" style="<?=!empty($filter) && $filter == 8? "" : "background:#222222ff"?>" class="btn <?=!empty($filter) && $filter == 8? "btn-warning" : "btn-dark"?> p-2">Son 6 Ay</a>
                        <a href="<?=base_url("atis/index/9")?>"  type="button" style="<?=!empty($filter) && $filter == 9? "" : "background:#222222ff"?>" class="btn <?=!empty($filter) && $filter == 9? "btn-warning" : "btn-dark"?> p-2">Bu Yıl</a>
                        <a href="<?=base_url("atis/index/10")?>" type="button" style="<?=!empty($filter) && $filter == 10?"" : "background:#222222ff"?>" class="btn <?=!empty($filter) && $filter == 10?"btn-warning" : "btn-dark"?> p-2">Geçen Yıl</a>
                      <a href="<?=base_url("atis/index/11")?>" type="button" style="<?=!empty($filter) && $filter == 11?"" : "background:#222222ff"?>" class="btn <?=!empty($filter) && $filter == 11?"btn-warning" : "btn-dark"?> p-2">Tüm Zamanlar</a>
                     
                    </div>
                    </div>
                </div>
</form>

                <div class="row mt-2">
                    <div class="col-3 pb-0 p-0 pr-2">
                        <div class="small-box bg-dark mb-2" style="background:#222222ff!important;border: 2px solid #dfb600ff;border-radius: 5px;">
                            <div class="inner">
                                <h3 id="bekleyen-yuklemeler"><?php echo $beklemede_count; ?></h3>
                                <p>Bekleyen Yüklemeler</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-load-d text-warning"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col pb-0 p-0">
                        <div class="small-box bg-dark mb-2" style="background:#222222ff!important;border: 2px solid #06b600ff;border-radius: 5px;" >
                            <div class="inner">
                                <h3 id="basarili-yuklemeler"><?php echo $success_count; ?></h3>
                                <p>Başarılı Yüklemeler</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-check text-success"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col col-xs-12 pb-0 pr-0">
                        <div class="small-box bg-dark mb-2" style="background:#222222ff!important;border: 2px solid #df0000ff;border-radius: 5px;">
                            <div class="inner">
                                <h3 id="basarisiz-yuklemeler"><?php echo $failure_count; ?></h3>
                                <p>Başarısız Yüklemeler</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-android-alert text-danger"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col pb-0 pr-0">
                        <div class="small-box bg-dark mb-2" style="background:#222222ff!important;border: 2px solid #0086dfff;border-radius: 5px;">
                            <div class="inner">
                                <h3 id="toplam-ozel-izinli-yukleme"><?php echo $total_ozel_logs; ?></h3>
                                <p>Özel İzinli Yükleme </p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-user text-primary"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col pb-0 pr-0">
                        <div class="small-box bg-dark mb-2" style="background:#222222ff!important;border: 2px solid #dfb600ff;border-radius: 5px;">
                            <div class="inner">
                                <h3 id="toplam-log-kaydi"><?php echo $total_logs; ?></h3>
                                <p>Toplam Log Kaydı</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 pl-0">
                        <div class="col-md-12 pr-0 pl-0">
                            <div class="card p-1 mb-1" style="border: 2px solid #333333ff;border-radius: 5px;">
                                <div class="card-header bg-dark text-white" style="font-weight: 800;background:#222222ff!important;">
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
                            <div class="card p-1 mb-0" style="border: 2px solid #333333ff;border-radius: 5px;">
                                <div class="card-header bg-dark text-white" style="font-weight: 800;background:#222222ff!important;">
                                    Cihaz Bazlı Atış Yükleme Grafiği
                                </div>
                                <div class="card-body">
                                    <div class="chart-container">
                                        <canvas id="totalUniqueChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 pr-0 pl-0">
                            <div class="card p-1 mb-0" style="border: 2px solid #333333ff;border-radius: 5px;">
                                <div class="card-header bg-dark text-white" style="font-weight: 800;background:#222222ff!important;">
                                    Departman Bazlı Atış Yükleme Grafiği
                                </div>
                                <div class="card-body">
                                    <div class="chart-container">
                                        <canvas id="totalUniqueChart2"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9 pr-0 pl-0">
                        <div class="table-responsive mt-0" style="border-radius:10px;max-height: 680px;border: 2px solid #333333ff;border-radius: 5px;">
                            <table class="table table-striped table-hover table-bordered" id="logTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th style="min-width:160px">İŞLEM TARİHİ</th>
                                        <th>SERİ NO</th>
                                        <th style="min-width:90px">SOL KOD</th>
                                        <th style="min-width:90px">SAĞ KOD</th>
                                        <th>ÜRETİLEN KOD</th>
                                        <th>ÖZEL GEÇİŞ KODU</th>
                                        <th>BAŞARILI MI?</th>  
                                        
                                        <th>TABLET</th>
                                        <th>UYARI / İŞLEM DETAYI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($logs)): ?>
                                        <?php foreach ($logs as $log): ?>
                                            <tr <?=($log->atis_yukleme_basarili_mi == 1)?"style='background:#e2ffd7;'":""?>  <?=($log->atis_yukleme_basarili_mi == 0)?"style='background:#fff7e0;'":""?> <?=($log->atis_yukleme_basarili_mi == 2)?"style='background:#ffd8d8;'":""?>>
                                                <td style="font-weight:bold"><?php echo $log->atis_log_id; ?></td>
                                                <td><?php echo $log->islem_tarihi; ?></td>
                                                <td style="font-weight:bold"><?php echo $log->seri_no; ?></td>
                                                <td><?php echo $log->sol_kod; ?></td>
                                                <td style="font-weight:bold"><?php echo $log->sag_kod; ?></td>
                                                <td><?php echo $log->uretilen_kod=="0"?"-":$log->uretilen_kod; ?></td>
                                                <td style="font-weight:bold"><?php echo $log->ozel_gecis_kodu=="0"?"-":$log->ozel_gecis_kodu; ?></td>
                                                <td>
                                                    <?php if ($log->atis_yukleme_basarili_mi == 1): ?>
                                                        <span class="badge bg-success p-2" style="font-size:14px; width: -webkit-fill-available;"><i style="font-size:14px" class="fa fa-check"> </i> Başarılı</span>
                                                    <?php endif; if($log->atis_yukleme_basarili_mi == 2): ?>
                                                        <span class="badge bg-danger p-2" style="font-size:14px; width: -webkit-fill-available;"><i style="font-size:14px" class="fa"></i> Başarısız </span>
                                                    <?php endif; if($log->atis_yukleme_basarili_mi == 0): ?>
                                                        <span class="badge bg-warning p-2" style="font-size:14px; width: -webkit-fill-available;"> Beklemede </span>
                                                    <?php endif; ?>
                                                </td>
                                                   <td><?php if($log->tablet_no == 0){echo "Teknik Servis";}else{echo "Üretim";} ?></td>
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
                // Mevcut Chart.js grafik tanımlamalarınız
                const ctx1 = document.getElementById('successFailureChart').getContext('2d');
                const successFailureChart = new Chart(ctx1, {
                    type: 'pie',
                    data: {
                        labels: ['Bekleyen Yüklemeler', 'Başarılı Yüklemeler', 'Başarısız Yüklemeler'],
                        datasets: [{
                            data: [<?php echo $beklemede_count; ?>, <?php echo $success_count; ?>, <?php echo $failure_count; ?>],
                            backgroundColor: [
                                'rgba(12, 12, 12, 0.8)', 'rgba(40, 167, 69, 0.8)', // Green for success
                                'rgba(220, 53, 69, 0.8)' // Red for failure
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
                        labels: ['Umex Lazer', 'Umex Plus', 'Diğer Cihaz'],
                        datasets: [{
                            label: 'Sayı',
                            data: [<?php echo $umexlazeratis; ?>, <?php echo $umexplusatis; ?>, <?php echo $digeratis; ?>],
                            backgroundColor: [
                                'rgba(0, 123, 255, 0.8)',
                                'rgba(255, 193, 7, 0.8)', 'rgba(220, 53, 69, 1)'
                            ],
                            borderColor: [
                                'rgba(0, 123, 255, 1)',
                                'rgba(255, 193, 7, 1)', 'rgba(220, 53, 69, 1)'
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



                const ctx3 = document.getElementById('totalUniqueChart2').getContext('2d');
                const totalUniqueChart2 = new Chart(ctx3, {
                    type: 'bar',
                    data: {
                        labels: ['Üretim Yeni Cihaz', 'Müşteri Cihazı'],
                        datasets: [{
                            label: 'Sayı',
                            data: [<?php echo $uretim_atis; ?>, <?php echo $musteri_atis; ?>],
                            backgroundColor: [
                                'rgba(0, 123, 255, 0.8)',
                                'rgba(255, 193, 7, 0.8)', 'rgba(220, 53, 69, 1)'
                            ],
                            borderColor: [
                                'rgba(0, 123, 255, 1)',
                                'rgba(255, 193, 7, 1)', 'rgba(220, 53, 69, 1)'
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

                // Yeni JavaScript kodu
                function updateDashboardData() {
                    fetch('<?php echo base_url('atis/get_atis_data/'.$filter); ?>') // Kontrolcü ve metod adınızı doğru yazın
                        .then(response => response.json())
                        .then(data => {
                            // Sayısal verileri güncelle
                            document.getElementById('bekleyen-yuklemeler').innerText = data.beklemede_count;
                            document.getElementById('basarili-yuklemeler').innerText = data.success_count;
                            document.getElementById('basarisiz-yuklemeler').innerText = data.failure_count;
                            document.getElementById('toplam-ozel-izinli-yukleme').innerText = data.total_ozel_logs;
                            document.getElementById('toplam-log-kaydi').innerText = data.total_logs;

                            // Grafikleri güncelle
                            successFailureChart.data.datasets[0].data = [data.beklemede_count, data.success_count, data.failure_count];
                            successFailureChart.update();

                            totalUniqueChart.data.datasets[0].data = [data.umexlazeratis, data.umexplusatis, data.digeratis];
                            totalUniqueChart.update();

                                              totalUniqueChart2.data.datasets[0].data = [data.uretim_atis, data.musteri_atis];
                            totalUniqueChart2.update();


                            // Log tablosunu güncelle
                            const logTableBody = document.querySelector('#logTable tbody');
                            logTableBody.innerHTML = ''; // Mevcut içeriği temizle

                            if (data.logs.length > 0) {
                                data.logs.forEach(log => {
                                    let row = document.createElement('tr');
                                    let statusHtml = '';
                                    let rowStyle = '';

                                    if (log.atis_yukleme_basarili_mi == 1) {
                                        statusHtml = '<span class="badge bg-success p-2" style="font-size:14px; width: -webkit-fill-available;"><i style="font-size:14px" class="fa fa-check"> </i> Başarılı</span>';
                                        rowStyle = 'background:#e2ffd7;';
                                    } else if (log.atis_yukleme_basarili_mi == 2) {
                                        statusHtml = '<span class="badge bg-danger p-2" style="font-size:14px; width: -webkit-fill-available;"><i style="font-size:14px" class="fa"></i> Başarısız </span>';
                                        rowStyle = 'background:#ffd8d8;';
                                    } else {
                                        statusHtml = '<span class="badge bg-warning p-2" style="font-size:14px; width: -webkit-fill-available;"> Beklemede </span>';
                                        rowStyle = 'background:#fff7e0;';
                                    }

                                    row.innerHTML = `
                                        <td style="font-weight:bold">${log.atis_log_id}</td>
                                        <td>${log.islem_tarihi}</td>
                                        <td style="font-weight:bold">${log.seri_no}</td>
                                        <td>${log.sol_kod}</td>
                                        <td style="font-weight:bold">${log.sag_kod}</td>
                                        <td>${log.uretilen_kod=="0"?"-":log.uretilen_kod}</td>
                                        <td style="font-weight:bold">${log.ozel_gecis_kodu=="0"?"-":log.ozel_gecis_kodu}</td>
                                        <td>${statusHtml}</td>
                                          <td>${log.tablet_no=="0"?"Teknik Servis":"Üretim"}</td>
                                        <td >${log.uyari}</td>
                                    `;
                                    row.style = rowStyle;
                                    logTableBody.appendChild(row);
                                });
                            } else {
                                logTableBody.innerHTML = '<tr><td colspan="9" class="text-center">Hiç log kaydı bulunamadı.</td></tr>';
                            }
                        })
                        .catch(error => console.error('Veriler çekilirken hata oluştu:', error));
                }

            
                document.addEventListener('DOMContentLoaded', function() {
                      updateDashboardData();  
                      
                    var dd = <?=$filter?>;
                    if(dd === 1){
                     
                    setInterval(updateDashboardData, 5000);  
                    }
                  
                });
            </script>
        </div>
    </div>
</div>