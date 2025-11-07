<div class="content-wrapper" style="padding-top: 20px; background: linear-gradient(135deg, #007bff, #00d4ff); min-height: 100vh;">
    <div class="container" style="background: white; border-radius: 15px; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); padding: 30px;">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary" style="font-family: 'Poppins', sans-serif; font-weight: bold; letter-spacing: 1px;">
                <i class="fas fa-clipboard-list"></i> Abonelikler
            </h2>
            <a href="<?php echo site_url('abonelik/ekle'); ?>" class="btn btn-primary btn-lg px-4 py-2" style="border-radius: 50px; font-weight: bold;">
                <i class="fas fa-plus"></i> Yeni Abonelik
            </a>
        </div>

        <table class="table table-bordered table-hover">
            <thead class="bg-primary text-white">
                <tr style="text-align: center; font-size: 16px;">
                    
                    <th>Ürün / Hizmet</th>
                    <th>Açıklama</th>
                    <th>Başlangıç Tarihi</th>
                    <th>Bitiş Tarihi</th> 
                     <th>Kalan Gün</th>
                    <th>İşlem</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($abonelikler as $abonelik): 
                    $bitis_tarihi = strtotime($abonelik->abonelik_bitis_tarihi);
                    $current_date = strtotime(date('Y-m-d'));
                    $days_remaining = ($bitis_tarihi - $current_date) / (60 * 60 * 24);
                    $row_class = $days_remaining <= 15 ? 'table-danger' : '';
                ?>
                <tr onclick="location.href='<?php echo site_url('abonelik/duzenle/'.$abonelik->abonelik_id); ?>';" class="<?php echo $row_class; ?>" style="text-align: center; font-size: 15px;">
                  
                    <td><?php echo $abonelik->abonelik_baslik; ?></td>
                    <td><?php echo $abonelik->abonelik_aciklama; ?></td>
                    <td><?php echo date("d.m.Y",strtotime($abonelik->abonelik_baslangic_tarihi)); ?></td>
                    <td><?php echo date("d.m.Y",strtotime($abonelik->abonelik_bitis_tarihi)); ?></td>

                    <td>
                    <?php 
                    
                    $kalangun = gunSayisiHesapla(date("Y-m-d"),date("Y-m-d",strtotime($abonelik->abonelik_bitis_tarihi)));
                    if($kalangun > 0)
                    {
                      echo $kalangun." Gün Kaldı";
                    }else{
                      echo ($kalangun*-1)." Gün Geçti !";
                    }
                    
                    ?>  
                    
                      <td>
                        <?php 
                        
                        if($kalangun > 0)
                        {
                          ?>
                          <a href="<?php echo site_url('abonelik/duzenle/'.$abonelik->abonelik_id); ?>" class="btn btn-warning btn-sm" style="border-radius: 20px;">
                            <i class="fas fa-edit"></i> Düzenle
                        </a>
                          <?php
                        }else{
                          ?>
                          <a href="<?php echo site_url('abonelik/duzenle/'.$abonelik->abonelik_id); ?>" class="btn btn-danger btn-sm" style="border-radius: 20px;">
                            <i class="fas fa-edit"></i> Düzenle
                        </a>
                          <?php
                        }

                        ?>
                        
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
        background: linear-gradient(135deg, #007bff, #00d4ff);
    }

    .table {
        border-collapse: separate;
        border-spacing: 0;
        overflow: hidden;
        border-radius: 10px;
    }

    .table thead {
        font-size: 16px;
        font-weight: bold;
    }

    .table tbody tr:hover {
        background: #e9f7ff;
        cursor: pointer;
    }

    .btn-primary {
        background: linear-gradient(135deg, #007bff, #0056b3);
        border: none;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #0056b3, #003e7d);
    }

    .btn-warning {
        background: linear-gradient(135deg, #ffcc00, #ff9900);
        border: none;
    }

    .btn-warning:hover {
        background: linear-gradient(135deg, #ff9900, #cc7a00);
    }

    .table-danger {
        background-color: #f8d7da !important;
        color: #721c24;
    }

    .table-bordered th, .table-bordered td {
        border: 1px solid #dee2e6;
        text-align: left;
        vertical-align: middle;
    }
</style>
 
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
