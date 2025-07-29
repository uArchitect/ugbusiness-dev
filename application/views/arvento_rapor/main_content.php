 
  
<div class="content-wrapper">
 <div class="row">
    <div class="col">
        






<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yakıt Verileri</title>
    <style>
        
        h1 {
            color: #0056b3;
            text-align: center;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }
        table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
        }
        table th,
        table td {
            padding: 12px 15px;
            border: 1px solid #ddd;
        }
        table tbody tr {
            border-bottom: 1px solid #dddddd;
        }
        table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }
        table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }
        table tbody tr.active-row {
            font-weight: bold;
            color: #009879;
        }
    </style>
</head>
<body>

    <h1>Yakıt Seviyesi Değişim Raporu</h1>
<div class="btn-group  "   style="    width: -webkit-fill-available;">
                 
    <?php
    foreach ($araclar as $arac) {
       ?>
        <a href="<?=base_url("arvento/get_yakit/$arac->arac_arvento_key")?>" style="font-weight:600;padding-top:15px;padding-bottom:15px" class="btn <?=$secilenkey == $arac->arac_arvento_key?"btn-primary":"btn-default"?>"><?=$arac->arac_plaka?></a>
       <?php
    }
    ?>
     
                </div>
    <?php if (!empty($yakit_verileri)): ?>




    <table>
        <thead>
            <tr>
                <th>Kayıt No</th>
                <th>Cihaz</th>
                <th>Plaka</th> 
                <th>Tarih/Saat</th>
                <th>Durum</th>
                <th>Değer</th>
                <th>Odometre</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($yakit_verileri as $veri): ?>
            <tr>
                <td><?php echo htmlspecialchars($veri['kayit_no']); ?></td>
                <td><?php echo htmlspecialchars($veri['cihaz']); ?></td>
                <td><?php echo htmlspecialchars($veri['plaka']); ?></td> 
                <td><?php echo htmlspecialchars(date('d.m.Y H:i:s', strtotime($veri['tarih_saat']))); ?></td>
                <td><?php echo htmlspecialchars($veri['durum']); ?></td>
                <td><?php echo htmlspecialchars($veri['deger']); ?></td>
                <td><?php echo htmlspecialchars($veri['odometre']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
        <p>Gösterilecek yakıt verisi bulunamadı.</p>
    <?php endif; ?>

</body>
</html>







    </div>
 </div>
</div>