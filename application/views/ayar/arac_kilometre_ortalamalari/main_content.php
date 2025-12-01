<div class="content-wrapper pt-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-tachometer-alt"></i> Araç Kilometre Ortalamaları
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th style="background: #00347d; color: white; font-weight: bold;">Araç Sahibi</th>
                                        <?php if (!empty($aylik_ortalamalar)): ?>
                                            <?php foreach ($aylik_ortalamalar as $ay): ?>
                                                <th style="background: #00347d; color: white; font-weight: bold; text-align: center; min-width: 120px;">
                                                    <?= isset($ay['ay_adi']) ? $ay['ay_adi'] : '' ?><br>
                                                    <small style="font-size: 11px; opacity: 0.8;"><?= isset($ay['ay_yil']) ? $ay['ay_yil'] : '' ?></small>
                                                </th>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    // Tüm araç sahiplerini topla
                                    $tum_sahipler = [];
                                    if (!empty($aylik_ortalamalar)) {
                                        foreach ($aylik_ortalamalar as $ay) {
                                            if (isset($ay['arac_sahipler']) && is_array($ay['arac_sahipler'])) {
                                                foreach ($ay['arac_sahipler'] as $sahip) {
                                                    if (isset($sahip['kullanici_id']) && !isset($tum_sahipler[$sahip['kullanici_id']])) {
                                                        $tum_sahipler[$sahip['kullanici_id']] = isset($sahip['kullanici_ad_soyad']) ? $sahip['kullanici_ad_soyad'] : 'Bilinmeyen';
                                                    }
                                                }
                                            }
                                        }
                                        ksort($tum_sahipler);
                                    }
                                    ?>
                                    <?php foreach ($tum_sahipler as $kullanici_id => $kullanici_adi): ?>
                                        <tr>
                                            <td style="font-weight: bold; background: #f8f9fa;">
                                                <?= $kullanici_adi ?>
                                            </td>
                                            <?php if (!empty($aylik_ortalamalar)): ?>
                                                <?php foreach ($aylik_ortalamalar as $ay): ?>
                                                    <?php 
                                                    $sahip_bulundu = false;
                                                    $ortalama_km = 0;
                                                    $arac_sayisi = 0;
                                                    if (isset($ay['arac_sahipler']) && is_array($ay['arac_sahipler'])) {
                                                        foreach ($ay['arac_sahipler'] as $sahip) {
                                                            if (isset($sahip['kullanici_id']) && $sahip['kullanici_id'] == $kullanici_id) {
                                                                $ortalama_km = isset($sahip['ortalama_km']) ? floatval($sahip['ortalama_km']) : 0;
                                                                $arac_sayisi = isset($sahip['arac_sayisi']) ? intval($sahip['arac_sayisi']) : 0;
                                                                $sahip_bulundu = true;
                                                                break;
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                <td style="text-align: center; <?= $ortalama_km > 0 ? 'background: #d6ebd1;' : 'background: #ffdddd;' ?>">
                                                    <?php if ($sahip_bulundu && $ortalama_km > 0): ?>
                                                        <strong style="color: #006400; font-size: 14px;">
                                                            <?= number_format($ortalama_km, 0, ',', '.') ?> km
                                                        </strong>
                                                        <?php if ($arac_sayisi > 0): ?>
                                                            <br><small style="font-size: 11px; color: #666;">
                                                                (<?= $arac_sayisi ?> araç)
                                                            </small>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <span style="color: #999; font-size: 12px;">-</span>
                                                    <?php endif; ?>
                                                </td>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                    <?php if (empty($tum_sahipler)): ?>
                                        <tr>
                                            <td colspan="<?= !empty($aylik_ortalamalar) ? count($aylik_ortalamalar) + 1 : 1 ?>" style="text-align: center; padding: 40px;">
                                                <i class="fas fa-info-circle" style="font-size: 24px; color: #999;"></i><br>
                                                <span style="color: #999; font-size: 14px;">Araç sahibi bulunamadı veya kilometre verisi yok.</span>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i> 
                                    <strong>Bilgi:</strong> Bu tablo, son 12 ay için araç sahiplerinin aylık ortalama kilometre değerlerini göstermektedir. 
                                    Her ay için, o ay içindeki ilk ve son kilometre kayıtları arasındaki fark hesaplanarak ortalama değer bulunmaktadır.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

