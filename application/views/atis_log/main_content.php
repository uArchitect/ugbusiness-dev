 
  
<div class="content-wrapper">
 <div class="row">
    <div class="col">
        





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atış Logları ve İstatistikler</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 30px;
        }
        .card {
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,.05);
        }
        .table-responsive {
            margin-top: 20px;
        }
        .table thead th {
            background-color: #007bff;
            color: white;
        }
        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4 text-primary">Atış Logları ve İstatistikler</h1>

        <div class="row">
            <div class="col-md-3">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Başarılı Yüklemeler</h5>
                        <p class="card-text fs-3"><?php echo $success_count; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-danger">
                    <div class="card-body">
                        <h5 class="card-title">Başarısız Yüklemeler</h5>
                        <p class="card-text fs-3"><?php echo $failure_count; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-info">
                    <div class="card-body">
                        <h5 class="card-title">Toplam Log Kaydı</h5>
                        <p class="card-text fs-3"><?php echo $total_logs; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Benzersiz Seri No</h5>
                        <p class="card-text fs-3"><?php echo $unique_serial_number_count; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Yükleme Başarı Oranları
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="successFailureChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Toplam Log vs. Benzersiz Seri Numaraları
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="totalUniqueChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="mt-5 mb-3 text-primary">Tüm Atış Logları</h2>
        <div class="table-responsive">
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
                            <tr>
                                <td><?php echo $log->atis_log_id; ?></td>
                                <td><?php echo $log->islem_tarihi; ?></td>
                                <td><?php echo $log->seri_no; ?></td>
                                <td><?php echo $log->sol_kod; ?></td>
                                <td><?php echo $log->sag_kod; ?></td>
                                <td><?php echo $log->uretilen_kod; ?></td>
                                <td><?php echo $log->ozel_gecis_kodu; ?></td>
                                <td>
                                    <?php if ($log->atis_yukleme_basarili_mi == 1): ?>
                                        <span class="badge bg-success">Evet</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Hayır</span>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Chart.js for Success/Failure Ratio
        const ctx1 = document.getElementById('successFailureChart').getContext('2d');
        const successFailureChart = new Chart(ctx1, {
            type: 'pie', // Pie chart is good for proportions
            data: {
                labels: ['Başarılı Yüklemeler', 'Başarısız Yüklemeler'],
                datasets: [{
                    data: [<?php echo $success_count; ?>, <?php echo $failure_count; ?>],
                    backgroundColor: [
                        'rgba(40, 167, 69, 0.8)', // Green for success
                        'rgba(220, 53, 69, 0.8)'  // Red for failure
                    ],
                    borderColor: [
                        'rgba(40, 167, 69, 1)',
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

        // Chart.js for Total Logs vs. Unique Serial Numbers
        const ctx2 = document.getElementById('totalUniqueChart').getContext('2d');
        const totalUniqueChart = new Chart(ctx2, {
            type: 'bar', // Bar chart is good for comparison
            data: {
                labels: ['Toplam Log Kaydı', 'Benzersiz Seri Numaraları'],
                datasets: [{
                    label: 'Sayı',
                    data: [<?php echo $total_logs; ?>, <?php echo $unique_serial_number_count; ?>],
                    backgroundColor: [
                        'rgba(0, 123, 255, 0.8)', // Blue for total logs
                        'rgba(255, 193, 7, 0.8)'   // Yellow for unique serial numbers
                    ],
                    borderColor: [
                        'rgba(0, 123, 255, 1)',
                        'rgba(255, 193, 7, 1)'
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
</body>
</html>






    </div>
 </div>
</div>