<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="content-wrapper text-center" style="background:url(<?= base_url("assets/wave-pattern-v1.svg") ?>) center top / cover no-repeat, linear-gradient(180deg, rgba(3, 120, 124, 0.2) 0%, rgba(3, 120, 124, 0.8) 100%);">
    <br>
    <div class=" text-center" style="padding: 20px; max-width: 70%; min-height: 350px; background: white; margin: auto; border-radius: 10px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
        <h1>Anket Raporu</h1>
        
        <?php foreach ($report_data as $question_id => $data): ?>
            <div class="mt-4 mb-4 text-center" style="padding:20px;border:1px solid #dddddd;position: relative;  text-align: left;">  
                <h5><?= $data['question'] ?></h5>
                <?php if ($data['type'] === 'option'): ?>
                    <canvas style="margin-bottom:20px;max-height: 150px;" id="chart_<?= $question_id ?>" style="width: 100%; height: 100%;"></canvas> 
                <?php elseif ($data['type'] === 'rating'): ?>
                    <p>Ortalama Cevap: <?= number_format($data['average'], 2) ?></p>
                <?php elseif ($data['type'] === 'text'): ?>
                    <p>Cevaplar: <?= implode(', ', $data['answers']) ?></p>  
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
        
        <a href="<?= base_url('surveycontroller') ?>" class="btn btn-primary mt-4">Anketler Sayfasına Dön</a>
        <button class="btn btn-success mt-4" onclick="window.print()">Raporu Yazdır</button>  
    </div>
</div>

<script>
    <?php foreach ($report_data as $question_id => $data): ?>
        <?php if ($data['type'] === 'option'): ?>
            const ctx_<?= $question_id ?> = document.getElementById('chart_<?= $question_id ?>').getContext('2d');
            const chartData_<?= $question_id ?> = {
                labels: <?= json_encode(array_keys($data['answers'])) ?>,
                datasets: [{
                    data: <?= json_encode(array_values($data['answers'])) ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                    ],
                    borderWidth: 1
                }]
            };

            const myPieChart_<?= $question_id ?> = new Chart(ctx_<?= $question_id ?>, {
                type: 'pie',
                data: chartData_<?= $question_id ?>,
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        <?php endif; ?>
    <?php endforeach; ?>
</script>
