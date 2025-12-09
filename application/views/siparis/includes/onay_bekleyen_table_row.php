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
    ? "<span class='badge bg-danger' style='background: #ffd1d1 !important; color: #b30000 !important; border: 1px solid red;'><i class='nav-icon fas fa-exclamation-circle'></i> Merkez Adı Girilmedi</span>"
    : '<i class="far fa-building" style="color: green;"></i> ' . $siparis->merkez_adi;

// Merkez adresi kontrolü
$merkez_adresi = ($siparis->merkez_adresi == "" || $siparis->merkez_adresi == "0" || $siparis->merkez_adresi == ".") 
    ? "ADRES GİRİLMEDİ" 
    : $siparis->merkez_adresi;

// Müşteri sabit numara
$musteri_sabit_numara = $siparis->musteri_sabit_numara ? "<br>" . $siparis->musteri_sabit_numara : "";

// Onay butonu kontrolü - Özel durum (adım 4, üst satış onayı bekleniyor)
$onay_bekleniyor = ($data[0]->adim_sira_numarasi == 4 && $siparis->siparis_ust_satis_onayi == 0 && (aktif_kullanici()->kullanici_id == 37 || aktif_kullanici()->kullanici_id == 8));

// Kullanıcının onay yetkisi var mı kontrol et
$kullanici_yetkili_adimlar = isset($kullanici_yetkili_adimlar) ? $kullanici_yetkili_adimlar : [];
$can_approve = can_user_approve_siparis($siparis->siparis_id, $ak, $kullanici_yetkili_adimlar, $siparis);
$next_adim = isset($siparis->adim_no) ? (int)$siparis->adim_no + 1 : null;
?>

<tr style="cursor:pointer;">
    <td>
        <span style="display: block;">
            <b>#<?= $siparis->siparis_id ?></b>
            <?php if($hatali_fiyat): ?>
                <br>
                <a class="btn btn-danger btn-xs yanipsonenyazinew" style="font-size: 10px !important;color:white">
                    <i class="fas fa-exclamation-circle"></i> HATALI FİYAT
                </a>
            <?php else: ?>
                <br>
                <a class="btn btn-success btn-xs" style="font-size: 10px !important;color:white">
                    <i class="fas fa-check"></i> FİYAT GEÇERLİ
                </a>
                <br>
                <small style="font-size: 9px; color: #666; font-weight: bold;">Adım <?= $siparis->adim_no + 1 ?></small>
            <?php endif; ?>
        </span>
    </td> 
    <td>
        <i class="far fa-user-circle" style="margin-right:1px;opacity:1"></i> 
        <b><?= "<a target='_blank' href='" . base_url("musteri/profil/$siparis->musteri_id") . "'>" . $siparis->musteri_ad . "</a>" ?></b> 
        <br>İletişim : <?= $siparis->musteri_iletisim_numarasi ?><?= $musteri_sabit_numara ?> 
    </td>
    <td>
        <b><?= $merkez_adi ?> - </b> 
        <span style="color:#1461c3;"><?= $siparis->sehir_adi ?> / <?= $siparis->ilce_adi ?></span>  
        <br><span style="font-size:14px"><?= $merkez_adresi ?></span>
    </td>           
    <td>
        <b>
            <i class="far fa-user-circle" style="color:green;margin-right:1px;opacity:1"></i>  
            <?= "<a target='_blank' href='" . base_url("kullanici/profil_new/$siparis->kullanici_id") . "?subpage=ozluk-dosyasi'>" . $siparis->kullanici_ad_soyad . "</a>" ?>
        </b>
        <br><?= date('d.m.Y H:i', strtotime($siparis->kayit_tarihi)) ?>
    </td>
    <td>
        <?= "<b>" . $data[0]->adim_adi . "</b> Bekleniyor..." ?>
        <br>
        <div>
            <div class="row">
                <?php for($i = 1; $i <= 12; $i++): 
                    $is_active = $siparis->adim_no + 1 >= $i;
                    $is_current = $siparis->adim_no + 1 == $i;
                    $bg_color = $is_active ? ($is_current ? "green" : "#b4d7b4") : "#e5e3e3";
                    $check_display = ($siparis->adim_no + 1 <= $i) ? "display:none;" : "";
                ?>
                <div class="mr-1" style="border: 1px solid #178018;border-radius:50%;background:<?= $bg_color ?>;width:17px;height:17px;display: inline-flex;">
                    <i class="fa fa-check" style="font-size:10px;margin-top: 3px !important;color:green; margin-left: 2px !important;<?= $check_display ?>"></i>
                </div>
                <?php endfor; ?>
            </div>
        </div>
    </td>
    <td>
        <?php if($onay_bekleniyor): ?>
            <button type="button" style="height: 47px;padding-top: 13px;border: 1px solid #5b4002;font-weight: 400!important;opacity:0.5" class="btn btn-danger btn-xs">
                <b>ONAY BEKLENİYOR</b>
            </button>
        <?php else: ?>
            <a type="button" style="height: 47px;padding-top: 13px;border: 1px solid #5b4002;font-weight: 400!important;" onclick="showWindow2('<?= $link ?>');" class="btn btn-warning btn-xs">
                <i class="fas fa-search" style="font-size:14px" aria-hidden="true"></i> <b>GÖRÜNTÜLE</b>
            </a>
        <?php endif; ?>
    </td>
    <td>
        <?php if($can_approve && !$onay_bekleniyor): ?>
            <form action="<?= base_url("siparis/onayla/" . $siparis->siparis_id) ?>" method="post" style="display:inline;" onsubmit="return confirmOnay('<?= $siparis->siparis_id ?>', '<?= $next_adim ?>');">
                <button type="submit" class="btn btn-success btn-xs" style="height: 47px;padding-top: 13px;font-weight: 400!important;" title="Adım <?= $next_adim ?> Onayı">
                    <i class="fas fa-check-circle" style="font-size:14px"></i> <b>ONAYLA</b>
                </button>
            </form>
        <?php elseif($onay_bekleniyor): ?>
            <button type="button" class="btn btn-secondary btn-xs" style="height: 47px;padding-top: 13px;font-weight: 400!important;opacity:0.6;" disabled>
                <i class="fas fa-clock" style="font-size:14px"></i> <b>BEKLİYOR</b>
            </button>
        <?php else: ?>
            <span class="text-muted" style="font-size: 11px;">
                <i class="fas fa-info-circle"></i> Yetki Yok
            </span>
        <?php endif; ?>
    </td>
</tr>

