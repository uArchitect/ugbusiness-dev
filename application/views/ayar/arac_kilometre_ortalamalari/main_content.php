<div class="content-wrapper pt-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Filtreleme Formu -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-filter"></i> Filtreleme ve Seçim
                        </h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="<?= base_url('ayar/arac_kilometre_ortalamalari') ?>" id="filtreForm">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kullanicilar">
                                            <i class="fas fa-users"></i> Araç Sahipleri (Çoklu Seçim)
                                        </label>
                                        <select name="kullanicilar[]" id="kullanicilar" class="select2bs4 form-control" multiple="multiple" data-placeholder="Araç sahiplerini seçiniz..." style="width: 100%;">
                                            <?php if (!empty($arac_sahipler)): ?>
                                                <?php foreach ($arac_sahipler as $sahip): ?>
                                                    <option value="<?= $sahip->arac_surucu_id ?>" 
                                                        <?= !empty($secilen_kullanicilar) && in_array($sahip->arac_surucu_id, $secilen_kullanicilar) ? 'selected' : '' ?>>
                                                        <?= $sahip->kullanici_ad_soyad ? $sahip->kullanici_ad_soyad : 'Bilinmeyen' ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <small class="form-text text-muted">Birden fazla kişi seçebilirsiniz. Seçim yapmazsanız tüm kişiler gösterilir.</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="ay_sayisi">
                                            <i class="fas fa-calendar-alt"></i> Ay Sayısı
                                        </label>
                                        <select name="ay_sayisi" id="ay_sayisi" class="form-control" required>
                                            <?php for ($i = 1; $i <= 24; $i++): ?>
                                                <option value="<?= $i ?>" <?= $ay_sayisi == $i ? 'selected' : '' ?>>
                                                    Son <?= $i ?> Ay
                                                </option>
                                            <?php endfor; ?>
                                        </select>
                                        <small class="form-text text-muted">Hesaplanacak ay sayısını seçin (1-24 ay arası)</small>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <button type="submit" class="btn btn-primary btn-block">
                                            <i class="fas fa-search"></i> Hesapla
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Sonuçlar Tablosu -->
                <?php if (!empty($aylik_ortalamalar)): ?>
                    <div class="card card-success mt-3">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-tachometer-alt"></i> Araç Kilometre Ortalamaları
                                <small class="ml-2">(<?= $ay_sayisi ?> Ay)</small>
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th style="background: #00347d; color: white; font-weight: bold; min-width: 200px;">Araç Sahibi</th>
                                            <?php foreach ($aylik_ortalamalar as $ay): ?>
                                                <th style="background: #00347d; color: white; font-weight: bold; text-align: center; min-width: 120px;">
                                                    <?= isset($ay['ay_adi']) ? $ay['ay_adi'] : '' ?><br>
                                                    <small style="font-size: 11px; opacity: 0.8;"><?= isset($ay['ay_yil']) ? $ay['ay_yil'] : '' ?></small>
                                                </th>
                                            <?php endforeach; ?>
                                            <th style="background: #28a745; color: white; font-weight: bold; text-align: center;">
                                                Genel Ortalama
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        // Tüm araç sahiplerini topla
                                        $tum_sahipler = [];
                                        $sahipler_toplam_ortalama = [];
                                        
                                        foreach ($aylik_ortalamalar as $ay) {
                                            if (isset($ay['arac_sahipler']) && is_array($ay['arac_sahipler'])) {
                                                foreach ($ay['arac_sahipler'] as $sahip) {
                                                    if (isset($sahip['kullanici_id'])) {
                                                        if (!isset($tum_sahipler[$sahip['kullanici_id']])) {
                                                            $tum_sahipler[$sahip['kullanici_id']] = isset($sahip['kullanici_ad_soyad']) ? $sahip['kullanici_ad_soyad'] : 'Bilinmeyen';
                                                            $sahipler_toplam_ortalama[$sahip['kullanici_id']] = ['toplam' => 0, 'sayi' => 0];
                                                        }
                                                        if (isset($sahip['ortalama_km']) && $sahip['ortalama_km'] > 0) {
                                                            $sahipler_toplam_ortalama[$sahip['kullanici_id']]['toplam'] += $sahip['ortalama_km'];
                                                            $sahipler_toplam_ortalama[$sahip['kullanici_id']]['sayi']++;
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                        ksort($tum_sahipler);
                                        ?>
                                        <?php foreach ($tum_sahipler as $kullanici_id => $kullanici_adi): ?>
                                            <tr>
                                                <td style="font-weight: bold; background: #f8f9fa;">
                                                    <?= $kullanici_adi ?>
                                                </td>
                                                <?php 
                                                $genel_toplam = 0;
                                                $genel_sayi = 0;
                                                ?>
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
                                                                if ($ortalama_km > 0) {
                                                                    $genel_toplam += $ortalama_km;
                                                                    $genel_sayi++;
                                                                }
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
                                                <td style="text-align: center; background: #c3e6cb; font-weight: bold;">
                                                    <?php 
                                                    $genel_ortalama = $genel_sayi > 0 ? round($genel_toplam / $genel_sayi, 2) : 0;
                                                    ?>
                                                    <?php if ($genel_ortalama > 0): ?>
                                                        <span style="color: #155724; font-size: 16px;">
                                                            <?= number_format($genel_ortalama, 0, ',', '.') ?> km
                                                        </span>
                                                        <br><small style="font-size: 11px; color: #666;">
                                                            (<?= $genel_sayi ?> ay)
                                                        </small>
                                                    <?php else: ?>
                                                        <span style="color: #999;">-</span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <?php if (empty($tum_sahipler)): ?>
                                            <tr>
                                                <td colspan="<?= !empty($aylik_ortalamalar) ? count($aylik_ortalamalar) + 2 : 1 ?>" style="text-align: center; padding: 40px;">
                                                    <i class="fas fa-info-circle" style="font-size: 24px; color: #999;"></i><br>
                                                    <span style="color: #999; font-size: 14px;">Seçilen kriterlere uygun veri bulunamadı.</span>
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
                                        <strong>Bilgi:</strong> Bu tablo, seçilen <?= $ay_sayisi ?> ay için araç sahiplerinin aylık ortalama kilometre değerlerini göstermektedir. 
                                        Her ay için, o ay içindeki ilk ve son kilometre kayıtları arasındaki fark hesaplanarak ortalama değer bulunmaktadır.
                                        "Genel Ortalama" sütunu, seçilen dönem için tüm ayların ortalamasını göstermektedir.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="card card-warning mt-3">
                        <div class="card-body text-center" style="padding: 40px;">
                            <i class="fas fa-info-circle" style="font-size: 48px; color: #856404;"></i><br>
                            <h4 class="mt-3">Veri Gösterimi İçin Filtreleme Yapın</h4>
                            <p class="text-muted">Yukarıdaki formdan araç sahiplerini seçip ay sayısını belirleyerek "Hesapla" butonuna tıklayın.</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Select2 initialization
    $('#kullanicilar').select2({
        theme: 'bootstrap4',
        placeholder: 'Araç sahiplerini seçiniz...',
        allowClear: true
    });
    
    // Form submit validation
    $('#filtreForm').on('submit', function(e) {
        var selectedUsers = $('#kullanicilar').val();
        if (!selectedUsers || selectedUsers.length === 0) {
            if (confirm('Hiçbir kullanıcı seçilmedi. Tüm kullanıcılar için hesaplama yapılacak. Devam etmek istiyor musunuz?')) {
                return true;
            }
            e.preventDefault();
            return false;
        }
    });
});
</script>
