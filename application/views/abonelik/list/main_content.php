<div class="content-wrapper" style="padding-top: 20px; background: linear-gradient(135deg, #0066ff, #00ccff); min-height: 100vh;">
    <div class="container" style="background: #fff; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.15); padding: 30px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary" style="font-family: 'Poppins', sans-serif; font-weight: bold;">
                <i class="fas fa-clipboard-list"></i> Abonelikler
            </h2>
            <a href="<?php echo site_url('abonelik/ekle'); ?>" class="btn btn-primary btn-lg px-4 py-2 shadow-sm" style="border-radius: 50px; font-weight: bold;">
                <i class="fas fa-plus"></i> Yeni Abonelik
            </a>
        </div>

        <table class="table table-bordered table-hover align-middle">
            <thead class="bg-primary text-white text-center">
                <tr>
                    <th>Ürün / Hizmet</th>
                    <th>Açıklama</th>
                    <th>Başlangıç Tarihi</th>
                    <th>Bitiş Tarihi</th>
                    <th>Kalan Gün</th>
                    <th>Durum</th>
                    <th>İşlem</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($abonelikler as $abonelik): 
                    $bitis_tarihi = strtotime($abonelik->abonelik_bitis_tarihi);
                    $current_date = strtotime(date('Y-m-d'));
                    $days_remaining = ($bitis_tarihi - $current_date) / (60 * 60 * 24);
                    $kalangun = gunSayisiHesapla(date("Y-m-d"), date("Y-m-d", strtotime($abonelik->abonelik_bitis_tarihi)));

                    if ($kalangun <= 0) {
                        $row_class = 'expired';
                        $status = '<span class="badge bg-danger">Süresi Doldu</span>';
                    } elseif ($kalangun <= 30) {
                        $row_class = 'warning';
                        $status = '<span class="badge bg-danger text-dark dolmak_uzere_alert ">Süresi Dolmak Üzere</span>';
                    } else {
                        $row_class = 'active';
                        $status = '<span class="badge bg-success">Aktif</span>';
                    }
                ?>
                <tr onclick="location.href='<?php echo site_url('abonelik/duzenle/'.$abonelik->abonelik_id); ?>';" 
                    class="abonelik-row <?php echo $row_class; ?>" style="cursor: pointer; text-align: center;">
                    
                    <td><strong><?php echo $abonelik->abonelik_baslik; ?></strong></td>
                    <td><?php echo $abonelik->abonelik_aciklama; ?></td>
                    <td><?php echo date("d.m.Y", strtotime($abonelik->abonelik_baslangic_tarihi)); ?></td>
                    <td><?php echo date("d.m.Y", strtotime($abonelik->abonelik_bitis_tarihi)); ?></td>
                    <td>
                        <?php  
                            if ($kalangun > 0) {
                                echo "<span class='fw-bold text-success'>$kalangun Gün Kaldı</span>";
                            } else {
                                echo "<span class='fw-bold text-danger'>" . ($kalangun * -1) . " Gün Geçti</span>";
                            }
                        ?>
                    </td>
                    <td><?php echo $status; ?></td>
                    <td>
                        <a href="<?php echo site_url('abonelik/duzenle/'.$abonelik->abonelik_id); ?>" 
                           class="btn <?php echo $kalangun > 0 ? 'btn-warning' : 'btn-danger'; ?> btn-sm shadow-sm" 
                           style="border-radius: 20px;">
                            <i class="fas fa-edit"></i> Düzenle
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
        margin: 0;
        background: linear-gradient(135deg, #0066ff, #00ccff);
        font-family: 'Poppins', sans-serif;
    }

    .table {
        border-radius: 12px;
        overflow: hidden;
    }

    .table thead th {
        font-size: 16px;
        font-weight: bold;
        letter-spacing: 0.5px;
    }

    .abonelik-row {
        transition: all 0.25s ease;
    }

    .abonelik-row:hover {
        background-color: #eaf6ff !important;
        transform: scale(1.01);
    }

    /* Duruma göre arka plan */
    .abonelik-row.active { background-color: #f9fffb; }
    .abonelik-row.warning { background-color: #fff7e6; }
    .abonelik-row.expired { background-color: #ffeaea; }

    .btn-primary {
        background: linear-gradient(135deg, #007bff, #0056b3);
        border: none;
        transition: 0.3s;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #0056b3, #003d82);
    }

    .btn-warning {
        background: linear-gradient(135deg, #ffcc00, #ff9900);
        border: none;
    }

    .btn-warning:hover {
        background: linear-gradient(135deg, #ff9900, #cc7a00);
    }

    .btn-danger {
        background: linear-gradient(135deg, #ff4d4d, #cc0000);
        border: none;
    }

    .btn-danger:hover {
        background: linear-gradient(135deg, #cc0000, #990000);
    }

    .dolmak_uzere_alert {
  animation: blink 1s infinite;
}
@keyframes blink {
  0%, 50%, 100% {
    opacity: 1;
  }
  25%, 75% {
    opacity: 0;
  }
}

.blinking-element {
  animation: blink 4s infinite; 
}
</style>



<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
