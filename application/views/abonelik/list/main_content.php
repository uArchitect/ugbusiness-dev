<div class="content-wrapper" style="padding-top:10px; background: #f0f8ff;">
    <div class="content" style="background: white; border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); padding: 30px;">

        <h2 class="text-center mb-4" style="font-family: 'Arial', sans-serif; color: #004080;">Abonelikler</h2>

        <div class="text-end">
            <a href="<?php echo site_url('abonelik/ekle'); ?>" class="btn btn-primary mb-3 px-4 py-2" style="border-radius: 5px; font-weight: bold; font-size: 16px;">
                Yeni Abonelik Ekle
            </a>
        </div>

        <table class="table table-hover" style="background: white; border-radius: 8px; overflow: hidden;">
            <thead style="background: #004080; color: white;">
                <tr>
                    <th>ID</th>
                    <th>Başlık</th>
                    <th>Açıklama</th>
                    <th>Başlangıç Tarihi</th>
                    <th>Bitiş Tarihi</th>
                    <th>Aksiyon</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($abonelikler as $abonelik): 
                    $bitis_tarihi = strtotime($abonelik->abonelik_bitis_tarihi);
                    $current_date = strtotime(date('Y-m-d'));
                    $days_remaining = ($bitis_tarihi - $current_date) / (60 * 60 * 24);
                    $row_class = $days_remaining <= 15 ? 'table-danger' : '';
                ?>
                <tr class="<?php echo $row_class; ?>" style="transition: background-color 0.3s;">
                    <td><?php echo $abonelik->abonelik_id; ?></td>
                    <td><?php echo $abonelik->abonelik_baslik; ?></td>
                    <td><?php echo $abonelik->abonelik_aciklama; ?></td>
                    <td><?php echo $abonelik->abonelik_baslangic_tarihi; ?></td>
                    <td><?php echo $abonelik->abonelik_bitis_tarihi; ?></td>
                    <td>
                        <a href="<?php echo site_url('abonelik/duzenle/'.$abonelik->abonelik_id); ?>" class="btn btn-info btn-sm" style="border-radius: 5px; font-weight: bold;">
                            Düzenle
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f0f8ff;
    }

    .table thead th {
        text-align: center;
    }

    .table tbody tr:hover {
        background-color: #d9edf7;
    }

    .btn-primary {
        background-color: #004080;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-info {
        background-color: #1e90ff;
        border: none;
    }

    .btn-info:hover {
        background-color: #4682b4;
    }

    .table-danger {
        background-color: #ffe5e5 !important;
        color: #c82333 !important;
    }
</style>
