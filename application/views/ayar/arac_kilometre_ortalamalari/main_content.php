<div class="content-wrapper pt-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Filtreleme Formu -->
                <div class="card" style="border-top: 3px solid #00347d;">
                    <div class="card-header" style="background: #00347d; color: white;">
                        <h3 class="card-title" style="color: white;">
                            <i class="fas fa-filter"></i> Filtreleme ve Seçim
                        </h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="<?= base_url('ayar/arac_kilometre_ortalamalari') ?>" id="filtreForm">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="kullanicilar" style="color: #00347d; font-weight: bold;">
                                            <i class="fas fa-users"></i> Araç Sahipleri (Çoklu Seçim)
                                        </label>
                                        <select name="kullanicilar[]" id="kullanicilar" class="select2bs4 form-control" multiple="multiple" data-placeholder="Araç sahiplerini seçiniz..." style="width: 100%; border-color: #00347d;">
                                            <?php if (!empty($arac_sahipler)): ?>
                                                <?php foreach ($arac_sahipler as $sahip): ?>
                                                    <option value="<?= $sahip->arac_surucu_id ?>" 
                                                        <?= !empty($secilen_kullanicilar) && in_array($sahip->arac_surucu_id, $secilen_kullanicilar) ? 'selected' : '' ?>>
                                                        <?= $sahip->kullanici_ad_soyad ? $sahip->kullanici_ad_soyad : 'Bilinmeyen' ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <small class="form-text text-muted">Birden fazla kişi seçebilirsiniz.</small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="filtre_tipi" style="color: #00347d; font-weight: bold;">
                                            <i class="fas fa-filter"></i> Filtre Tipi
                                        </label>
                                        <select name="filtre_tipi" id="filtre_tipi" class="form-control" style="border-color: #00347d;">
                                            <option value="ay_sayisi" <?= (!isset($filtre_tipi) || $filtre_tipi == 'ay_sayisi') ? 'selected' : '' ?>>Ay Sayısı</option>
                                            <option value="tarih_araligi" <?= (isset($filtre_tipi) && $filtre_tipi == 'tarih_araligi') ? 'selected' : '' ?>>Tarih Aralığı</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2" id="ay_sayisi_div">
                                    <div class="form-group">
                                        <label for="ay_sayisi" style="color: #00347d; font-weight: bold;">
                                            <i class="fas fa-calendar-alt"></i> Ay Sayısı
                                        </label>
                                        <select name="ay_sayisi" id="ay_sayisi" class="form-control" style="border-color: #00347d;">
                                            <?php for ($i = 1; $i <= 24; $i++): ?>
                                                <option value="<?= $i ?>" <?= (isset($ay_sayisi) && $ay_sayisi == $i) ? 'selected' : '' ?>>
                                                    Son <?= $i ?> Ay
                                                </option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2" id="tarih_araligi_div" style="display: none;">
                                    <div class="form-group">
                                        <label for="baslangic_tarihi" style="color: #00347d; font-weight: bold;">
                                            <i class="fas fa-calendar"></i> Başlangıç
                                        </label>
                                        <input type="date" name="baslangic_tarihi" id="baslangic_tarihi" class="form-control" value="<?= isset($baslangic_tarihi) ? $baslangic_tarihi : '' ?>" style="border-color: #00347d;">
                                    </div>
                                </div>
                                <div class="col-md-2" id="bitis_tarihi_div" style="display: none;">
                                    <div class="form-group">
                                        <label for="bitis_tarihi" style="color: #00347d; font-weight: bold;">
                                            <i class="fas fa-calendar"></i> Bitiş
                                        </label>
                                        <input type="date" name="bitis_tarihi" id="bitis_tarihi" class="form-control" value="<?= isset($bitis_tarihi) ? $bitis_tarihi : '' ?>" style="border-color: #00347d;">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <button type="submit" class="btn btn-block" style="background: #00347d; color: white; border-color: #00347d;">
                                            <i class="fas fa-search"></i> Hesapla
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Sonuçlar Tablosu -->
                <?php 
                $gosterilecek_veriler = [];
                if (!empty($tarih_araligi_ortalamalari) && isset($filtre_tipi) && $filtre_tipi == 'tarih_araligi') {
                    $gosterilecek_veriler = $tarih_araligi_ortalamalari;
                } elseif (!empty($aylik_ortalamalar)) {
                    $gosterilecek_veriler = $aylik_ortalamalar;
                }
                ?>
                <?php if (!empty($gosterilecek_veriler) || !empty($guncel_km_bilgileri)): ?>
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
                                            <th style="background: #ff9800; color: white; font-weight: bold; text-align: center; min-width: 150px;">
                                                Güncel KM
                                            </th>
                                            <?php if (!empty($aylik_ortalamalar) && (!isset($filtre_tipi) || $filtre_tipi == 'ay_sayisi')): ?>
                                                <?php foreach ($aylik_ortalamalar as $ay): ?>
                                                    <th style="background: #00347d; color: white; font-weight: bold; text-align: center; min-width: 120px;">
                                                        <?= isset($ay['ay_adi']) ? $ay['ay_adi'] : '' ?><br>
                                                        <small style="font-size: 11px; opacity: 0.8;"><?= isset($ay['ay_yil']) ? $ay['ay_yil'] : '' ?></small>
                                                    </th>
                                                <?php endforeach; ?>
                                            <?php elseif (!empty($tarih_araligi_ortalamalari) && isset($filtre_tipi) && $filtre_tipi == 'tarih_araligi'): ?>
                                                <th style="background: #00347d; color: white; font-weight: bold; text-align: center; min-width: 150px;">
                                                    Tarih Aralığı Ortalaması<br>
                                                    <small style="font-size: 11px; opacity: 0.8;"><?= isset($baslangic_tarihi) ? date('d.m.Y', strtotime($baslangic_tarihi)) : '' ?> - <?= isset($bitis_tarihi) ? date('d.m.Y', strtotime($bitis_tarihi)) : '' ?></small>
                                                </th>
                                            <?php endif; ?>
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
                                        <?php 
                                        $tum_sahipler_listesi = [];
                                        if (!empty($aylik_ortalamalar)) {
                                            foreach ($aylik_ortalamalar as $ay) {
                                                if (isset($ay['arac_sahipler']) && is_array($ay['arac_sahipler'])) {
                                                    foreach ($ay['arac_sahipler'] as $sahip) {
                                                        if (isset($sahip['kullanici_id']) && !in_array($sahip['kullanici_id'], array_keys($tum_sahipler_listesi))) {
                                                            $tum_sahipler_listesi[$sahip['kullanici_id']] = isset($sahip['kullanici_ad_soyad']) ? $sahip['kullanici_ad_soyad'] : 'Bilinmeyen';
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                        if (!empty($tarih_araligi_ortalamalari)) {
                                            foreach ($tarih_araligi_ortalamalari as $sahip) {
                                                if (isset($sahip['kullanici_id']) && !in_array($sahip['kullanici_id'], array_keys($tum_sahipler_listesi))) {
                                                    $tum_sahipler_listesi[$sahip['kullanici_id']] = isset($sahip['kullanici_ad_soyad']) ? $sahip['kullanici_ad_soyad'] : 'Bilinmeyen';
                                                }
                                            }
                                        }
                                        if (empty($tum_sahipler_listesi) && !empty($guncel_km_bilgileri)) {
                                            foreach ($guncel_km_bilgileri as $k_id => $guncel_km) {
                                                $tum_sahipler_listesi[$k_id] = isset($guncel_km['kullanici_ad_soyad']) ? $guncel_km['kullanici_ad_soyad'] : 'Bilinmeyen';
                                            }
                                        }
                                        ksort($tum_sahipler_listesi);
                                        ?>
                                        <?php foreach ($tum_sahipler_listesi as $kullanici_id => $kullanici_adi): ?>
                                            <tr>
                                                <td style="font-weight: bold; background: #f8f9fa;">
                                                    <?= $kullanici_adi ?>
                                                </td>
                                                <td style="text-align: center; background: #fff3cd; font-weight: bold;">
                                                    <?php if (isset($guncel_km_bilgileri[$kullanici_id])): ?>
                                                        <span style="color: #856404; font-size: 14px;">
                                                            <?= number_format($guncel_km_bilgileri[$kullanici_id]['ortalama_guncel_km'], 0, ',', '.') ?> km
                                                        </span>
                                                        <br><small style="font-size: 11px; color: #666;">
                                                            (<?= $guncel_km_bilgileri[$kullanici_id]['arac_sayisi'] ?> araç)
                                                        </small>
                                                    <?php else: ?>
                                                        <span style="color: #999;">-</span>
                                                    <?php endif; ?>
                                                </td>
                                                <?php 
                                                $genel_toplam = 0;
                                                $genel_sayi = 0;
                                                ?>
                                                <?php if (!empty($aylik_ortalamalar) && (!isset($filtre_tipi) || $filtre_tipi == 'ay_sayisi')): ?>
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
                                                        <?php if ($sahip_bulundu): ?>
                                                            <?php 
                                                            $ay_sonu_km = 0;
                                                            if (isset($ay['arac_sahipler']) && is_array($ay['arac_sahipler'])) {
                                                                foreach ($ay['arac_sahipler'] as $sahip_data) {
                                                                    if (isset($sahip_data['kullanici_id']) && $sahip_data['kullanici_id'] == $kullanici_id) {
                                                                        $ay_sonu_km = isset($sahip_data['ortalama_ay_sonu_km']) ? floatval($sahip_data['ortalama_ay_sonu_km']) : 0;
                                                                        break;
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                            <?php if ($ortalama_km > 0): ?>
                                                                <strong style="color: #006400; font-size: 14px;">
                                                                    <?= number_format($ortalama_km, 0, ',', '.') ?> km
                                                                </strong>
                                                                <?php if ($arac_sayisi > 0): ?>
                                                                    <br><small style="font-size: 11px; color: #666;">
                                                                        (<?= $arac_sayisi ?> araç)
                                                                    </small>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                            <?php if ($ay_sonu_km > 0): ?>
                                                                <br><small style="font-size: 10px; color: #856404; font-weight: bold; margin-top: 3px; display: block;">
                                                                    Son KM: <?= number_format($ay_sonu_km, 0, ',', '.') ?>
                                                                </small>
                                                            <?php endif; ?>
                                                            <?php if ($ortalama_km == 0 && $ay_sonu_km == 0): ?>
                                                                <span style="color: #999; font-size: 12px;">-</span>
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            <span style="color: #999; font-size: 12px;">-</span>
                                                        <?php endif; ?>
                                                    </td>
                                                <?php endforeach; ?>
                                                <?php elseif (!empty($tarih_araligi_ortalamalari) && isset($filtre_tipi) && $filtre_tipi == 'tarih_araligi'): ?>
                                                    <?php 
                                                    $tarih_ortalama = 0;
                                                    $tarih_arac_sayisi = 0;
                                                    foreach ($tarih_araligi_ortalamalari as $tarih_sahip) {
                                                        if (isset($tarih_sahip['kullanici_id']) && $tarih_sahip['kullanici_id'] == $kullanici_id) {
                                                            $tarih_ortalama = isset($tarih_sahip['ortalama_km']) ? floatval($tarih_sahip['ortalama_km']) : 0;
                                                            $tarih_arac_sayisi = isset($tarih_sahip['arac_sayisi']) ? intval($tarih_sahip['arac_sayisi']) : 0;
                                                            if ($tarih_ortalama > 0) {
                                                                $genel_toplam = $tarih_ortalama;
                                                                $genel_sayi = 1;
                                                            }
                                                            break;
                                                        }
                                                    }
                                                    ?>
                                                    <td style="text-align: center; <?= $tarih_ortalama > 0 ? 'background: #d6ebd1;' : 'background: #ffdddd;' ?>">
                                                        <?php if ($tarih_ortalama > 0): ?>
                                                            <strong style="color: #006400; font-size: 14px;">
                                                                <?= number_format($tarih_ortalama, 0, ',', '.') ?> km
                                                            </strong>
                                                            <?php if ($tarih_arac_sayisi > 0): ?>
                                                                <br><small style="font-size: 11px; color: #666;">
                                                                    (<?= $tarih_arac_sayisi ?> araç)
                                                                </small>
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            <span style="color: #999; font-size: 12px;">-</span>
                                                        <?php endif; ?>
                                                    </td>
                                                <?php endif; ?>
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

<style>
/* Form Input Renkleri - Tablo ile Uyumlu */
#kullanicilar.select2-container--bootstrap4 .select2-selection,
#ay_sayisi.form-control {
    border-color: #00347d !important;
}

#kullanicilar.select2-container--bootstrap4 .select2-selection:focus,
#kullanicilar.select2-container--bootstrap4.select2-container--focus .select2-selection,
#ay_sayisi.form-control:focus {
    border-color: #00347d !important;
    box-shadow: 0 0 0 0.2rem rgba(0, 52, 125, 0.25) !important;
}

.select2-container--bootstrap4 .select2-results__option--highlighted[aria-selected] {
    background-color: #00347d !important;
    color: white !important;
}

.select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice {
    background-color: #00347d !important;
    border-color: #00347d !important;
    color: white !important;
}

.select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice__remove {
    color: white !important;
}

.select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice__remove:hover {
    color: #ffdddd !important;
}

.btn[style*="#00347d"]:hover {
    background: #002a5f !important;
    border-color: #002a5f !important;
}

label[style*="#00347d"] {
    color: #00347d !important;
}
</style>

<script>
$(document).ready(function() {
    // Select2 initialization
    $('#kullanicilar').select2({
        theme: 'bootstrap4',
        placeholder: 'Araç sahiplerini seçiniz...',
        allowClear: true
    });
    
    // Filtre tipi değiştiğinde
    $('#filtre_tipi').on('change', function() {
        var filtreTipi = $(this).val();
        if (filtreTipi == 'tarih_araligi') {
            $('#ay_sayisi_div').hide();
            $('#tarih_araligi_div').show();
            $('#bitis_tarihi_div').show();
            $('#ay_sayisi').removeAttr('required');
            $('#baslangic_tarihi').attr('required', 'required');
            $('#bitis_tarihi').attr('required', 'required');
        } else {
            $('#ay_sayisi_div').show();
            $('#tarih_araligi_div').hide();
            $('#bitis_tarihi_div').hide();
            $('#ay_sayisi').attr('required', 'required');
            $('#baslangic_tarihi').removeAttr('required');
            $('#bitis_tarihi').removeAttr('required');
        }
    });
    
    // Sayfa yüklendiğinde filtre tipine göre göster/gizle
    var filtreTipi = $('#filtre_tipi').val();
    if (filtreTipi == 'tarih_araligi') {
        $('#ay_sayisi_div').hide();
        $('#tarih_araligi_div').show();
        $('#bitis_tarihi_div').show();
    } else {
        $('#tarih_araligi_div').hide();
        $('#bitis_tarihi_div').hide();
    }
    
    // Form submit validation
    $('#filtreForm').on('submit', function(e) {
        var filtreTipi = $('#filtre_tipi').val();
        if (filtreTipi == 'tarih_araligi') {
            var baslangic = $('#baslangic_tarihi').val();
            var bitis = $('#bitis_tarihi').val();
            if (!baslangic || !bitis) {
                alert('Lütfen başlangıç ve bitiş tarihlerini seçiniz.');
                e.preventDefault();
                return false;
            }
            if (new Date(baslangic) > new Date(bitis)) {
                alert('Başlangıç tarihi bitiş tarihinden büyük olamaz.');
                e.preventDefault();
                return false;
            }
        }
        
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
