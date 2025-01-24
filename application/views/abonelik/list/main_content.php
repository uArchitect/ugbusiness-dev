<div class="content-wrapper" style="padding-top:10px">

<div class="container mt-5" style="background:white; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 30px;">
    <h2 class="text-center mb-4" style="font-family: 'Arial', sans-serif; color: #333;">Abonelikler</h2>

    <a href="<?php echo site_url('abonelik/ekle'); ?>" class="btn btn-success mb-3 px-4 py-2" style="border-radius: 5px; font-weight: bold; font-size: 16px; transition: background-color 0.3s;">
        Yeni Abonelik Ekle
    </a>
    
    <table class="table table-hover table-striped table-bordered">
        <thead class="thead-dark">
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
                $row_class = $days_remaining <= 15 ? 'alert-danger blink' : '';
            ?>
            <tr class="<?php echo $row_class; ?>" style="transition: background-color 0.3s;">
                <td><?php echo $abonelik->abonelik_id; ?></td>
                <td><?php echo $abonelik->abonelik_baslik; ?></td>
                <td><?php echo $abonelik->abonelik_aciklama; ?></td>
                <td><?php echo $abonelik->abonelik_baslangic_tarihi; ?></td>
                <td><?php echo $abonelik->abonelik_bitis_tarihi; ?></td>
                <td>
                    <a href="<?php echo site_url('abonelik/duzenle/'.$abonelik->abonelik_id); ?>" class="btn btn-warning" style="border-radius: 5px; font-weight: bold;">
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
    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        font-weight: bold;
    }

    .blink {
        animation: blink 1.5s infinite;
    }

    @keyframes blink {
        50% {
            opacity: 0;
        }
    }

    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }

    .btn:hover {
        background-color: #28a745 !important;
        color: white;
    }
</style>
