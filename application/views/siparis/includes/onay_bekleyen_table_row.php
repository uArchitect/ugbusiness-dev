<?php
/**
 * Onay bekleyen sipariş tablosu için satır render partial
 * 
 * @param object $siparis Sipariş objesi
 * @param array $data Son adım bilgileri
 * @param int $ak Aktif kullanıcı ID
 * @param bool $tum_siparisler_tabi Tüm siparişler tabı aktif mi?
 * @param array $kullanici_yetkili_adimlar Kullanıcının yetkili olduğu adımlar
 * @return void
 */

// Helper fonksiyonları yükle
$this->load->helper('siparis_view_helper');

// Sipariş görüntüleme linki oluştur
$link = base_url("siparis/report/") . urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE" . $siparis->siparis_id . "Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE"));

// Fiyat kontrolü
$hatali_fiyat = hatali_fiyat_kontrol($siparis->siparis_id) == 1;

// Merkez adı kontrolü
$merkez_adi = ($siparis->merkez_adi == "#NULL#") 
    ? "<span class='badge bg-danger' style='background: #ffd1d1 !important; color: #b30000 !important; border: 1px solid red; font-size: 10px;'><i class='nav-icon fas fa-exclamation-circle'></i> Merkez Adı Yok</span>"
    : '<i class="far fa-building" style="color: green;"></i> ' . mb_substr($siparis->merkez_adi, 0, 30) . (mb_strlen($siparis->merkez_adi) > 30 ? '...' : '');

// Merkez adresi kontrolü (tooltip için)
$merkez_adresi = ($siparis->merkez_adresi == "" || $siparis->merkez_adresi == "0" || $siparis->merkez_adresi == ".") 
    ? "ADRES GİRİLMEDİ" 
    : $siparis->merkez_adresi;
$merkez_adresi_kisa = mb_strlen($merkez_adresi) > 40 ? mb_substr($merkez_adresi, 0, 40) . '...' : $merkez_adresi;

// Müşteri sabit numara
$musteri_sabit_numara = $siparis->musteri_sabit_numara ? "<br>" . $siparis->musteri_sabit_numara : "";

// Yenilenmiş cihaz kontrolü
$yenilenmis_cihaz_var = false;
$yenilenmis_check = $this->db
    ->select('COUNT(*) as count')
    ->from('siparis_urunleri')
    ->where('siparis_kodu', $siparis->siparis_id)
    ->where('yenilenmis_cihaz_mi', 1)
    ->where('siparis_urun_aktif', 1)
    ->get()
    ->row();
if($yenilenmis_check && $yenilenmis_check->count > 0) {
    $yenilenmis_cihaz_var = true;
}

// Müşteri fotoğrafı (müşteri profil fotoğrafı yoksa ikon kullan)
$musteri_icon = '<i class="fa fa-user-circle" style="color: #035ab9; font-size: 16px; margin-right: 8px;"></i>';

// Satışçı fotoğrafı
$kullanici_foto = '';
if(!empty($siparis->kullanici_resim) && $siparis->kullanici_resim != "" && $siparis->kullanici_resim != ".") {
    $kullanici_foto = '<img src="'.base_url("uploads/".$siparis->kullanici_resim).'" alt="'.htmlspecialchars($siparis->kullanici_ad_soyad).'" style="width:32px;height:32px;border-radius:50%;object-fit:cover;border:2px solid #e5e7eb;margin-right:8px;flex-shrink:0;">';
} else {
    $kullanici_foto = '<img src="'.base_url("uploads/user-default.jpg").'" alt="'.htmlspecialchars($siparis->kullanici_ad_soyad).'" style="width:32px;height:32px;border-radius:50%;object-fit:cover;border:2px solid #e5e7eb;margin-right:8px;flex-shrink:0;opacity:0.7;">';
}

// Onay butonu kontrolü - Özel durum (adım 4, üst satış onayı bekleniyor)
$onay_bekleniyor = ($data[0]->adim_sira_numarasi == 4 && $siparis->siparis_ust_satis_onayi == 0 && (aktif_kullanici()->kullanici_id == 37 || aktif_kullanici()->kullanici_id == 8));

// Kullanıcının onay yetkisi var mı kontrol et
$kullanici_yetkili_adimlar = isset($kullanici_yetkili_adimlar) ? $kullanici_yetkili_adimlar : [];
$can_approve = can_user_approve_siparis($siparis->siparis_id, $ak, $kullanici_yetkili_adimlar, $siparis);
$next_adim = isset($siparis->adim_no) ? (int)$siparis->adim_no + 1 : null;

// İkinci onay kontrolü - Eğer adım 3'te ve siparis_ust_satis_onayi = 0 ise, ikinci onay bekleniyor
$ikinci_onay_bekleniyor = false;
$ikinci_onay_kullanici_id = null;
if(isset($siparis->adim_no) && $siparis->adim_no == 3 && isset($siparis->siparis_ust_satis_onayi) && $siparis->siparis_ust_satis_onayi == 0) {
    $ikinci_onay_bekleniyor = true;
    // siparis_ikinci_onay yetkisine sahip kullanıcıları bul
    $ikinci_onay_kullanicilar = $this->db
        ->select('kullanici_id')
        ->from('kullanici_yetki_tanimlari')
        ->where('yetki_kodu', 'siparis_ikinci_onay')
        ->get()
        ->result();
    
    if(!empty($ikinci_onay_kullanicilar)) {
        // İlk kullanıcının ID'sini al (birden fazla varsa ilkini göster)
        $ikinci_onay_kullanici_id = $ikinci_onay_kullanicilar[0]->kullanici_id;
    }
}

// Adım 4'te ve 2. satış onayı bekleyen siparişler için kırmızı satır kontrolü
$adim_4_ikinci_onay_bekliyor = false;
if(isset($data[0]->adim_sira_numarasi) && $data[0]->adim_sira_numarasi == 4 && 
   isset($siparis->siparis_ust_satis_onayi) && $siparis->siparis_ust_satis_onayi == 0) {
    $adim_4_ikinci_onay_bekliyor = true;
}

// Satır stilini belirle
$row_style = "cursor:pointer;";
if($adim_4_ikinci_onay_bekliyor) {
    $row_style .= " background-color: #ffebee !important; border-left: 4px solid #dc3545 !important;";
}
?>

<tr style="<?= $row_style ?>" onclick="showWindow2('<?= $link ?>');" data-siparis-id="<?= $siparis->siparis_id ?>">
    <td style="text-align: left; vertical-align: middle;">
        <div style="display: flex; flex-direction: column; align-items: flex-start; gap: 4px;">
            <b style="font-size: 13px;">#<?= $siparis->siparis_id ?></b>
            <?php if($hatali_fiyat): ?>
                <span class="badge badge-danger" style="font-size: 9px; padding: 3px 6px;">
                    <i class="fas fa-exclamation-circle"></i> HATALI
                </span>
            <?php else: ?>
                <span class="badge badge-success" style="font-size: 9px; padding: 3px 6px;">
                    <i class="fas fa-check"></i> GEÇERLİ
                </span>
                <small style="font-size: 9px; color: #666; font-weight: bold;">Adım <?= $siparis->adim_no + 1 ?></small>
                <?php if($ikinci_onay_bekleniyor && $ikinci_onay_kullanici_id !== null): ?>
                    <small style="font-size: 8px; color: #dc3545; font-weight: bold; display: block; margin-top: 2px;">
                        <i class="fas fa-user-check"></i> 2. Onay: ID <?= $ikinci_onay_kullanici_id ?>
                    </small>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </td> 
    <td style="vertical-align: middle;">
        <div style="line-height: 1.4;">
            <div style="margin-bottom: 4px; display: flex; align-items: center; flex-wrap: wrap; gap: 4px;">
                <?= $musteri_icon ?>
                <b style="font-size: 13px;"><?= "<a target='_blank' href='" . base_url("musteri/profil/$siparis->musteri_id") . "' style='color: #001657; text-decoration: none;' onclick='event.stopPropagation();'>" . $siparis->musteri_ad . "</a>" ?></b>
                <?php if($yenilenmis_cihaz_var): ?>
                    <span class="badge badge-success" style="background:#28a745;color:#fff;padding:3px 6px;border-radius:4px;font-size:10px;white-space:nowrap;"><i class="fas fa-recycle"></i> Yenilenmiş</span>
                <?php endif; ?>
            </div>
            <div style="font-size: 11px; color: #6c757d;">
                <i class="fas fa-phone" style="font-size: 9px; margin-right: 3px;"></i>
                <?= $siparis->musteri_iletisim_numarasi ?>
                <?php if($musteri_sabit_numara): ?>
                    <br><i class="fas fa-phone-alt" style="font-size: 9px; margin-right: 3px;"></i><?= $siparis->musteri_sabit_numara ?>
                <?php endif; ?>
            </div>
        </div>
    </td>
    <td style="max-width: 200px;">
        <div style="line-height: 1.4;">
            <div style="margin-bottom: 4px;">
                <b><?= $merkez_adi ?></b>
            </div>
            <div style="color:#1461c3; font-size: 12px; margin-bottom: 4px;">
                <i class="fas fa-map-marker-alt" style="font-size: 10px;"></i> <?= $siparis->sehir_adi ?> / <?= $siparis->ilce_adi ?>
            </div>
            <?php if($merkez_adresi != "ADRES GİRİLMEDİ"): ?>
            <div style="font-size: 11px; color: #6c757d;" title="<?= htmlspecialchars($merkez_adresi) ?>">
                <i class="fas fa-home" style="font-size: 9px;"></i> <?= $merkez_adresi_kisa ?>
            </div>
            <?php else: ?>
            <div style="font-size: 10px; color: #dc3545;">
                <i class="fas fa-exclamation-triangle"></i> Adres yok
            </div>
            <?php endif; ?>
        </div>
    </td>           
    <td style="vertical-align: middle;">
        <div style="line-height: 1.4;">
            <div style="margin-bottom: 4px; display: flex; align-items: center;">
                <?= $kullanici_foto ?>
                <b style="font-size: 12px;"><?= "<a target='_blank' href='" . base_url("kullanici/profil_new/$siparis->kullanici_id") . "?subpage=ozluk-dosyasi' style='color: #001657; text-decoration: none;' onclick='event.stopPropagation();'>" . $siparis->kullanici_ad_soyad . "</a>" ?></b>
            </div>
            <div style="font-size: 10px; color: #6c757d;">
                <i class="far fa-clock" style="font-size: 9px; margin-right: 3px;"></i>
                <?= date('d.m.Y H:i', strtotime($siparis->kayit_tarihi)) ?>
            </div>
        </div>
    </td>
    <td style="vertical-align: middle;">
        <div style="line-height: 1.4;">
            <div style="margin-bottom: 6px; font-size: 12px;">
                <b style="color: #001657;"><?= $data[0]->adim_adi ?></b>
                <span style="color: #6c757d; font-size: 10px;">Bekleniyor...</span>
            </div>
            <div style="display: flex; gap: 3px; flex-wrap: wrap; justify-content: flex-start;">
                <?php for($i = 1; $i <= 12; $i++): 
                    $is_active = $siparis->adim_no + 1 >= $i;
                    $is_current = $siparis->adim_no + 1 == $i;
                    $bg_color = $is_active ? ($is_current ? "green" : "#b4d7b4") : "#e5e3e3";
                    $check_display = ($siparis->adim_no + 1 <= $i) ? "display:none;" : "";
                ?>
                <div style="border: 1px solid #178018; border-radius: 50%; background: <?= $bg_color ?>; width: 14px; height: 14px; display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <i class="fa fa-check" style="font-size: 8px; color: green; <?= $check_display ?>"></i>
                </div>
                <?php endfor; ?>
            </div>
        </div>
    </td>
    <td style="width: 140px; white-space: nowrap; vertical-align: middle;">
        <div style="display: flex; flex-direction: column; gap: 6px; align-items: stretch;">
            <?php if($onay_bekleniyor): ?>
                <button type="button" style="padding: 7px 10px; font-size: 10px; border: 1px solid #5b4002; font-weight: 500; opacity:0.5; width: 100%; white-space: nowrap;" class="btn btn-danger btn-xs" disabled>
                    <i class="fas fa-clock"></i> ONAY BEKLENİYOR
                </button>
            <?php else: ?>
                <a type="button" style="padding: 7px 10px; font-size: 10px; border: 1px solid #5b4002; font-weight: 500; width: 100%; text-align: center; display: block; white-space: nowrap;" onclick="event.stopPropagation(); showWindow2('<?= $link ?>');" class="btn btn-warning btn-xs">
                    <i class="fas fa-search"></i> GÖRÜNTÜLE
                </a>
            <?php endif; ?>
            
            <?php if($can_approve && !$onay_bekleniyor): ?>
                <form action="<?= base_url("siparis/onayla/" . $siparis->siparis_id) ?>" method="post" style="margin: 0; width: 100%;" onsubmit="event.stopPropagation(); return confirmOnay('<?= $siparis->siparis_id ?>', '<?= $next_adim ?>');" onclick="event.stopPropagation();">
                    <button type="submit" class="btn btn-success btn-xs" style="padding: 7px 10px; font-size: 10px; font-weight: 500; width: 100%; white-space: nowrap;" title="Adım <?= $next_adim ?> Onayı" onclick="event.stopPropagation();">
                        <i class="fas fa-check-circle"></i> ONAYLA
                    </button>
                </form>
            <?php elseif(!$onay_bekleniyor): ?>
                <span class="text-muted" style="font-size: 9px; text-align: center; display: block; padding: 4px 2px;">
                    <i class="fas fa-info-circle"></i> Yetki Yok
                </span>
            <?php endif; ?>
        </div>
    </td>
</tr>

