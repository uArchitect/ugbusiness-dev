<?php 
$giris_yapan_k = aktif_kullanici();
$user_id = $giris_yapan_k->kullanici_id;
$aktif_kullanici_id = $this->session->userdata('aktif_kullanici_id');

// Helper fonksiyon: Nav item oluştur
function nav_item($url, $text, $icon = '', $icon_class = '', $extra_class = '', $onclick = '', $link_style = '') {
    $onclick_attr = $onclick ? ' onclick="' . htmlspecialchars($onclick, ENT_QUOTES, 'UTF-8') . '"' : '';
    $style_attr = $link_style ? ' style="' . htmlspecialchars($link_style, ENT_QUOTES, 'UTF-8') . '"' : '';
    $icon_class_attr = $icon_class ? ' ' . htmlspecialchars($icon_class, ENT_QUOTES, 'UTF-8') : '';
    $icon_html = $icon ? '<i class="nav-icon ' . htmlspecialchars($icon, ENT_QUOTES, 'UTF-8') . $icon_class_attr . '"></i>' : '';
    $extra_class_attr = $extra_class ? ' ' . htmlspecialchars($extra_class, ENT_QUOTES, 'UTF-8') : '';
    return '<li class="nav-item' . $extra_class_attr . '">
        <a href="' . htmlspecialchars(base_url($url), ENT_QUOTES, 'UTF-8') . '" class="nav-link"' . $onclick_attr . $style_attr . '>
            ' . $icon_html . '
            <p>' . htmlspecialchars($text, ENT_QUOTES, 'UTF-8') . '</p>
        </a>
    </li>';
}

// Helper fonksiyon: Nav header oluştur
function nav_header($text) {
    return '<li class="nav-header">' . htmlspecialchars($text, ENT_QUOTES, 'UTF-8') . '</li>';
}

// Helper fonksiyon: Kullanıcı ID kontrolü
function user_in($user_id, $ids) {
    if (empty($ids)) return false;
    return in_array($user_id, is_array($ids) ? $ids : [$ids]);
}
?>

<style>
.nav-icon { font-size: 13px; }
.nav-link p { font-size: 15px; }
.sidebar-input { background: #1d2125; border: 1px solid #4d4d4d; color: white; }
.sidebar-btn { background: #1d2125; border: 1px solid #4d4d4d; color: white; }
.support-btn { background: #2b2b2b57; color: white !important; width: 100%; font-size: 11px !important; font-weight: 700; border: 1px solid #5b5b5b; padding-left: 4px !important; }
.support-btn-success { background: #2b2b2b57; color: white !important; width: 100%; font-size: 11px !important; padding: 0; padding-top: 4px; padding-bottom: 4px; font-weight: 700; border: 1px solid #d1d1d161 !important; }
.yanipsonenyazimodul2 { animation: blinker2 1s linear infinite; }
@keyframes blinker2 { 50% { opacity: 0; } }
</style>

<aside class="main-sidebar sidebar-dark-primary elevation-4" id="main-sidebar">
    <a href="<?=($giris_yapan_k->baslangic_ekrani) ? base_url($giris_yapan_k->baslangic_ekrani) : base_url("anasayfa")?>" class="brand-link" style="text-align: center;border: 9px double #003a79;border-style: revert-layer;background:#0060c7;padding:4px">
        <span style="font-size:26px;color:white;"><strong>UG</strong> BUSINESS</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-2 d-flex">
            <div class="image" style="margin-top: 10px;">
                <img src="<?=$giris_yapan_k->kullanici_resim ? base_url("uploads/").$giris_yapan_k->kullanici_resim : base_url("uploads/default.png")?>" class="img-circle elevation-2" alt="User Image" style="BACKGROUND: #001cab;border: 2px solid white !important;">
            </div>
            <div class="info">
                <a href="#" class="d-block" style="text-transform: uppercase;"><?=$giris_yapan_k->kullanici_ad_soyad?></a>
                <a href="#" class="d-block text-sm"><?=$giris_yapan_k->kullanici_unvan?></a>
            </div>
        </div>

        <div class="row" style="padding-top: 5px;">
            <div class="col-5" style="padding-right: 0; padding-left: 0;">
                <a class="btn btn-warning btn-sm support-btn" href="https://ugbusiness.com.tr/istek/ekle">
                    <i class="fas fa-user-cog"></i> YENİ DESTEK
                </a>
            </div>
            <div class="col" style="padding-left: 3px; padding-right: 0;">
                <a class="btn btn-success btn-sm mb-1 support-btn-success" href="https://ugbusiness.com.tr/istek">
                    <i class="fa fa-list"></i> DESTEK TALEPLERİ
                    <?php if(($s = get_istek_sayi()) > 0): ?>
                        <span class="badge bg-danger"><?=$s?></span>
                    <?php endif; ?>
                </a>
            </div>
        </div>

        <a class="btn btn-success btn-sm mb-1" style="background: #0049a7ad;color:white!important;width: 100%;border: 1px solid #2474ff;" href="<?=base_url("dokuman")?>">
            <i class="fa fa-folder"></i> UG - UMEX ARŞİV
        </a>

        <?php if($user_id == 7): ?>
            <a class="btn btn-danger btn-sm mb-1" onclick="confirm_stop_system();" style="color:white!important; width:100%;">
                <i class="fas fa-exclamation-circle"></i> SİSTEMİ TAMAMEN DURDUR
                <br><span style="opacity:0.5">Yetkili : Uğur ÖLMEZ</span>
            </a>
        <?php endif; ?>

        <br>

        <form action="<?=base_url("anasayfa/genel_arama")?>" method="POST">
            <div class="input-group" data-widget="sidebar-search1">
                <input class="form-control form-control-sidebar sidebar-input" name="aranan_deger" type="search" placeholder="Hızlı Kayıt Ara..." aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar sidebar-btn" type="submit">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </form>

        <?php if(user_in($aktif_kullanici_id, [1, 9])): ?>
            <div class="input-group mt-2" style="margin-bottom: 10px;">
                <input id="sidebar-menu-filter" class="form-control form-control-sidebar sidebar-input" type="text" placeholder="Menü Ara..." aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar sidebar-btn" type="button">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        <?php endif; ?>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-child-indent nav-flat" data-widget="treeview" role="menu" data-accordion="false" id="sidebar-menu-list">
                
                <?= nav_header("HIZLI ERİŞİM") ?>
                
                <?= nav_item("anasayfa", "ANASAYFA", "fas fa-home", "text-primary") ?>
                <?= nav_item("izin/talebi_olustur", "İZİN TALEBİ OLUŞTUR", "fas fa-calendar-plus", "text-success") ?>

                <?php if(user_in($user_id, [1, 4, 6])): ?>
                    <?= nav_item("abonelik", "ABONELİKLER", "far fa-folder-open") ?>
                <?php endif; ?>

                <li class="nav-item">
                    <a href="<?=base_url("anasayfa/rehber")?>" class="nav-link">
                        <i class="fa fa-contact nav-icon"></i>
                        <p><?=user_in($aktif_kullanici_id, [9, 7, 1, 4]) ? "PERSONEL" : "KURUMSAL İLETİŞİM"?></p>
                    </a>
                </li>

                <?php if(user_in($aktif_kullanici_id, [9, 7, 1])): ?>
                    <?= nav_item("sablon/index/26", "ŞİRKET İÇİ KURALLAR", "fa fa-contact") ?>
                    <li class="nav-item">
                        <a href="<?=base_url("zimmet/fabrika_zimmet")?>" class="nav-link">
                            <i class="nav-icon fas fa-charging-station text-danger"></i>
                            <p>FABRİKA ZİMMET <span class="badge badge-info right">Restore</span></p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(user_in($aktif_kullanici_id, [1, 9, 37, 8])): ?>
                    <?= nav_item("uretim_planlama", "ÜRETİM PLANLAMA", "fa fa-contact") ?>
                <?php endif; ?>

                <?php if(user_in($aktif_kullanici_id, [1, 9, 4])): ?>
                    <?= nav_item("yazilim", "YAPILACAK İŞLER", "fa fa-contact") ?>
                <?php endif; ?>

                <?php if(goruntuleme_kontrol("depo_birinci_onay") || goruntuleme_kontrol("depo_giris_cikis") || user_in($aktif_kullanici_id, [1305, 11, 8, 9])): ?>
                    <?= nav_item("depo_onay", "DEPO GİRİŞ ÇIKIŞ", "fa fa-contact") ?>
                <?php endif; ?>

                <?php if(user_in($aktif_kullanici_id, [1, 4, 9, 7, 8])): ?>
                    <li class="nav-item">
                        <a href="<?=base_url("cihaz/showrooms")?>" class="nav-link">
                            <i class="fa fa-contact nav-icon"></i>
                            <p style="color:orange">SHOWROOM CİHAZLAR</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?=base_url("api/kart_okutmayan_personeller_view")?>" class="nav-link">
                            <i class="fa fa-contact nav-icon"></i>
                            <p style="font-weight:600;color:orange">MESAİ GENEL BAKIŞ</p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(goruntuleme_kontrol("izinleri_yonet")): ?>
                    <li class="nav-item">
                        <a href="<?=base_url("izin")?>" class="nav-link">
                            <i class="fa fa-contact nav-icon"></i>
                            <p style="font-weight:600;color:red">İZİN / MESAİ YÖNETİMİ</p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(user_in($aktif_kullanici_id, [1338, 9])): ?>
                    <li class="nav-item">
                        <a href="<?=base_url("cihaz/tumcihazlar")?>" class="nav-link">
                            <i class="fa fa-contact nav-icon"></i>
                            <p style="color:#00fb00">TÜM CİHAZLAR</p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(user_in($aktif_kullanici_id, [9])): ?>
                    <li class="nav-item">
                        <a href="<?=base_url("ayar/arac_kilometre_ortalamalari")?>" class="nav-link">
                            <i class="fas fa-tachometer-alt nav-icon"></i>
                            <p>ARAÇ KİLOMETRE ORTALAMALARI</p>
                        </a>
                    </li>
                <?php endif; ?>

                <?= nav_header("MODÜLLER") ?>

                <?php if(user_in($user_id, [40, 11, 12])): ?>
                    <?= nav_item("zimmet/kullanici_envanter_liste", "STOK ENVANTER", "fa fa-contact") ?>
                    <?= nav_item("siparis/haftalik_kurulum_plan", "Haftalık Kurulum Planı", "far fa-folder-open", "", "", "waiting('Haftalık Kurulum Planı')") ?>
                <?php endif; ?>

                <?php if($user_id == 40): ?>
                    <?= nav_item("zimmet/dagitim/2", "Zimmet Dağıtım", "fas fa-box", "text-info", "", "waiting('Zimmet Dağıtım')") ?>
                <?php endif; ?>

                <?php if(goruntuleme_kontrol("cihazlari_goruntule") && $user_id != 14): ?>
                    <li class="nav-item" style="display: none;">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-charging-station text-danger"></i>
                            <p>MÜŞTERİ <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php if(user_in($aktif_kullanici_id, [1, 9, 1330, 8])): ?>
                                <li class="nav-item">
                                    <a href="<?=base_url("cihaz/rgmedikalindex")?>" style="background: #004e0f;" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>RG MEDİKAL</p>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?= nav_item("cihaz/cihaz_tanimlama_view", "Yeni Cihaz Tanımla", "fas fa-plus-circle", "", "", "waiting('Yeni Cihaz Tanımla')") ?>

                            <?php if($user_id == 11): ?>
                                <?= nav_item("musteri", "Tüm Müşteriler", "far fa-folder-open") ?>
                            <?php endif; ?>

                            <?= nav_item("cihaz/tum-cihazlar", "Tüm Cihazları Görüntüle", "far fa-folder-open") ?>
                            <?= nav_item("cihaz/tum-cihazlar?durum=iade", "İade Cihazları Görüntüle", "far fa-folder-open") ?>
                            <?= nav_item("cihaz/tum-cihazlar?durum=takas", "Takas Cihazları Görüntüle", "far fa-folder-open") ?>

                            <?php if(goruntuleme_kontrol("borclu_cihazlari_goruntule")): ?>
                                <?= nav_item("cihaz/borclu_cihazlar", "Borçlu Müşteriler", "far fa-circle", "text-danger") ?>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php if(goruntuleme_kontrol("musterileri_goruntule") || goruntuleme_kontrol("cihazlari_goruntule") || goruntuleme_kontrol("merkezleri_goruntule")): ?>
                        <li class="nav-item">
                            <a href="<?=base_url("musteri")?>" onclick="waiting('Müşteriler');" class="nav-link">
                                <i class="nav-icon fas fa-users text-danger"></i>
                                <p>MÜŞTERİ <span class="badge badge-info right">Restore</span></p>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if(goruntuleme_kontrol("stok_yonetim")): ?>
                    <?= nav_item("stok/giris_stok_kayitlari", "STOK", "fa fa-list", "text-danger") ?>
                <?php endif; ?>

                <?php if(goruntuleme_kontrol("arac_duzenle") || goruntuleme_kontrol("sadece_kendi_aracini_yonet")): ?>
                    <?= nav_item("arac", "ŞİRKET ARAÇLARI", "fas fa-car", "text-success") ?>
                <?php endif; ?>

                <?php if(!user_in($user_id, [7, 9])): ?>
                    <?php if(!goruntuleme_kontrol("musteri_ekle") && goruntuleme_kontrol("merkezleri_goruntule")): ?>
                        <?= nav_item("merkez", "Kargo Etiketi", "far fa-building", "text-default", "", "waiting('Merkezleri Görüntüle')") ?>
                        <?= nav_item("servis/servis_cihaz_sorgula_view", "Atış Yükleme", "far fa-building", "text-default") ?>
                    <?php endif; ?>

                    <?php if(goruntuleme_kontrol("ilbazli_tum_cihazlari_goruntule")): ?>
                        <?= nav_item("cihaz/tumcihazlarilbazli", "İL BAZLI CİHAZLAR", "far fa-building", "text-default") ?>
                    <?php endif; ?>

                    <?php if((goruntuleme_kontrol("musteri_ekle") && goruntuleme_kontrol("musterileri_goruntule")) || goruntuleme_kontrol("merkezleri_goruntule")): ?>
                        <?php if(user_in($user_id, [1, 14, 12])): ?>
                            <li class="nav-item" style="display: none;">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-users text-orange"></i>
                                    <p>MÜŞTERİ <i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview" style="border-left: 0;">
                                    <?= nav_item("cihaz", "Cihazlari Görüntüle", "far fa-list-alt", "text-default", "", "", "border-left: 0;") ?>
                                    <?= nav_item("musteri", "Müşterileri Görüntüle", "far fa-list-alt", "text-default", "", "", "border-left: 0;") ?>
                                    <?php if(!user_in($user_id, [7, 9])): ?>
                                        <?= nav_item("merkez", "Merkezleri Görüntüle", "far fa-building", "text-default", "", "waiting('Merkezleri Görüntüle')", "border-left: 0;") ?>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if(goruntuleme_kontrol("talep_havuzu_goruntule")): ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-people-arrows text-red"></i>
                            <p>TALEP (ADMİN) <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php if(user_in($user_id, [1, 4])): ?>
                                <?= nav_item("talep", "Talep Havuzu", "far fa-folder-open", "", "", "waiting('Talep Havuzu')") ?>
                            <?php endif; ?>
                            <?= nav_item("rut", "Rut Planlama", "fas fa-map-signs", "", "", "waiting('Rut Planlama')") ?>
                            <?= nav_item("talep/yonlendirmeler/1", "Yönlendirilen Talepler", "far fa-file-archive", "", "", "waiting('Yönlendirilen Talepler')") ?>
                            <?= nav_item("talep/bekleyen_rapor", "Talep Uyarı Sms Gönder", "fas fa-user-clock", "text-warning") ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if(goruntuleme_kontrol("siparis_onay_1")): ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-people-arrows text-primary"></i>
                            <p>TALEP <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php if($user_id != 1341): ?>
                                <li class="nav-item">
                                    <a href="<?=base_url("urun/satici_limit/1")?>" onclick="waiting('Fiyat Limitleri');" class="nav-link text-warning">
                                        <i class="far fa-circle nav-icon text-warning"></i>
                                        <p>Fiyat Limitleri</p>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?= nav_item("talep/ekle", "Yeni Talep Ekle", "fas fa-plus", "", "", "waiting('Yeni Talep Ekle')") ?>
                            <?= nav_item("rut/rut_tanimlari", "Rut Listesi", "far fa-circle") ?>
                            <li class="nav-item">
                                <a href="<?=base_url("tum-taleplerim")?>" onclick="waiting('Bekleyen Talepler')" class="nav-link">
                                    <i class="nav-icon fa fa-list-alt"></i>
                                    <p>Tüm Taleplerim <span class="badge badge-info right">Restore</span></p>
                                </a>
                            </li>
                            <?= nav_item("bekleyen-talepler", "Bekleyen Talepler", "fa fa-list-alt", "", "", "waiting('Bekleyen Talepler')") ?>
                            <?= nav_item("satis-talepler", "Satış", "fa fa-list-alt", "", "", "waiting('Satış Yapılan Talepler')") ?>
                            <?= nav_item("bilgi-verildi-talepler", "Bilgi Verildi", "fa fa-list-alt", "", "", "waiting('Bilgi Verilen Talepler')") ?>
                            <?= nav_item("musteri-memnuniyeti-talepler", "Müşteri Memnuniyeti", "fa fa-list-alt", "", "", "waiting('Müşteri Memnuniyet Talepler')") ?>
                            <?= nav_item("donus-yapilacak-talepler", "Dönüş Yapılacak", "fa fa-list-alt", "", "", "waiting('Dönüş Yapılacak Talepler')") ?>
                            <?= nav_item("olumsuz-talepler", "Olumsuz", "fa fa-list-alt", "", "", "waiting('Olumsuz Talepler')") ?>
                            <?= nav_item("numara-hatali-talepler", "Numara Hatalı", "fa fa-list-alt", "", "", "waiting('Numara Hatalı')") ?>
                            <?= nav_item("tekrar-aranacak-talepler", "Tekrar Aranacak", "fa fa-list-alt", "", "", "waiting('Tekrar Aranacak')") ?>
                            
                            <?php if($user_id == 60): ?>
                                <?= nav_item("talep/yonlendirilen_talepler", "Yönlendirilen Talepler", "fa fa-list-alt", "", "", "waiting('Tekrar Aranacak')") ?>
                            <?php endif; ?>

                            <?= nav_item("musteri/karaliste_view", "KARA LİSTE", "fa fa-list-alt", "", "", "waiting('Kara Liste')") ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if($user_id != 11 && $user_id != 40): ?>
                    <li class="nav-item" style="display: none;">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-cart-arrow-down text-warning"></i>
                            <p>SİPARİŞ <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php if(goruntuleme_kontrol("satis_limitlerini_yonet")): ?>
                                <?= nav_item("fiyat_limit", "Satış Limitleri", "far fa-check-circle") ?>
                            <?php endif; ?>

                            <?= nav_item("siparis/hizli_siparis_olustur_view", "Hızlı Sipariş Oluştur", "fa fa-plus", "", "", "waiting('Hızlı Sipariş Oluştur')") ?>

                            <?php if(goruntuleme_kontrol("siparis_beklemeye_al")): ?>
                                <?= nav_item("onay-bekleyen-siparisler?filter=2", "Onay Bekleyen Siparişler", "far fa-check-circle", "", "", "waiting('Onay Bekleyen Siparişler')") ?>
                            <?php else: ?>
                                <?= nav_item("onay-bekleyen-siparisler", "Onay Bekleyen Siparişler", "far fa-check-circle", "", "", "waiting('Onay Bekleyen Siparişler')") ?>
                            <?php endif; ?>

                            <?= nav_item("tum-siparisler", "Tüm Siparişler", "far fa-folder-open") ?>

                            <?php if($aktif_kullanici_id == 1): ?>
                                <?= nav_item("siparis/siparis_kisa_yollar", "Siparişler Kısa Yolları", "fas fa-bolt", "", "", "waiting('Siparişler Kısa Yolları')") ?>
                                <?= nav_item("siparis/demo_on_izleme", "Demo Ön İzleme", "fas fa-th-large", "", "", "waiting('Demo Ön İzleme')") ?>
                            <?php endif; ?>

                            <?= nav_item("siparis/haftalik_kurulum_plan", "Haftalık Kurulum Planı", "far fa-folder-open", "", "", "waiting('Haftalık Kurulum Planı')") ?>

                            <?php if(goruntuleme_kontrol("iptal_edilen_siparisleri_goruntule")): ?>
                                <li class="nav-item">
                                    <a href="<?=base_url("cihaz/iptal_edilen_siparisler")?>" style="border-left: 0;" class="nav-link">
                                        <i class="fa fa-list nav-icon"></i>
                                        <p>İptal Edilenler</p>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>

                    <?php 
                    // Departman ID'si 15 olan kullanıcılar satışlara girebilir
                    $is_departman_15 = isset($giris_yapan_k->kullanici_departman_id) && $giris_yapan_k->kullanici_departman_id == 15;
                    // Satış yetkilisi kontrolü (departman_id: 12, 17, 18, 15 veya kullanici_id: 2, 9, 1)
                    $is_satis_yetkilisi = false;
                    if(isset($giris_yapan_k->kullanici_departman_id) && in_array($giris_yapan_k->kullanici_departman_id, [12, 17, 18, 15])) {
                        $is_satis_yetkilisi = true;
                    }
                    if(in_array($aktif_kullanici_id, [2, 9, 1])) {
                        $is_satis_yetkilisi = true;
                    }
                    if(goruntuleme_kontrol("tum_siparisleri_goruntule")) {
                        $is_satis_yetkilisi = true;
                    }
                    if($is_satis_yetkilisi || $is_departman_15):
                    ?>
                    <li class="nav-item">
                        <a href="<?=base_url("siparis/siparisler_restore")?>" onclick="waiting('Siparişler');" class="nav-link">
                            <i class="nav-icon fas fa-cart-arrow-down text-warning"></i>
                            <p>SİPARİŞ <span class="badge badge-info right">Restore</span></p>
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php if(goruntuleme_kontrol("sms_degerlendirme_raporunu_goruntule")): ?>
                        <li class="nav-item">
                            <a href="<?=base_url("siparis/degerlendirme_rapor")?>" style="border-left: 0;" class="nav-link">
                                <i class="fa fa-envelope nav-icon"></i>
                                <p>SMS Sonuçları</p>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if(goruntuleme_kontrol("trendyol_siparislerini_goruntule")): ?>
                    <li class="nav-item">
                        <a href="<?=base_url("trendyol")?>" style="border-left: 0;" class="nav-link">
                            <img style="margin-left: 14px; margin-right: 7px;" src="https://developers.trendyol.com/img/favicon.ico" alt="">
                            <p>TRENDYOL YÖNETİM</p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php 
                // Departman ID'si 15 olan kullanıcılar sertifikalardaki her şeye erişebilir
                $is_departman_15 = isset($giris_yapan_k->kullanici_departman_id) && $giris_yapan_k->kullanici_departman_id == 15;
                if(goruntuleme_kontrol("egitim_bilgilerini_goruntule") || goruntuleme_kontrol("sertifika_kontrol_onayla") || $is_departman_15): ?>
                    <li class="nav-item">
                        <a href="<?=base_url("egitim")?>" onclick="waiting('Sertifikalar');" class="nav-link">
                            <i class="nav-icon fas fa-award text-warning"></i>
                            <p>SERTİFİKA <span class="badge badge-info right">Restore</span></p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if($user_id == 14): ?>
                    <li class="nav-item">
                        <a href="<?=base_url("servis")?>" style="border-left: 0;" class="nav-link">
                            <i class="fa fa-list nav-icon text-success"></i>
                            <p>Cihaz Teknik Servis</p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(goruntuleme_kontrol("isleme_alinan_basliklari_goruntule")): ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users-cog text-success"></i>
                            <p>TEKNİK SERVİS <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php if(goruntuleme_kontrol("servis_goruntule")): ?>
                                <li class="nav-item">
                                    <a href="<?=base_url("servis")?>" style="border-left: 0;" class="nav-link">
                                        <i class="fa fa-list nav-icon text-success"></i>
                                        <p>Cihaz Teknik Servis</p>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?= nav_item("baslik/isleme_alinan_basliklar", "İşleme Alınan Başlıklar", "fas fa-retweet", "", "", "waiting('İşleme Alınan Başlıklar')") ?>
                            <?= nav_item("baslik/tamamlanan_basliklar", "Tamamlanan Başlıklar", "fas fa-check", "", "", "waiting('İşleme Alınan Başlıklar')") ?>
                            <?= nav_item("cihaz/tum-basliklar", "Başlık Tanımları", "far fa-folder-open", "", "", "waiting('Başlıkları Görüntüle')") ?>
                            <?= nav_item("baslik/baslik_havuz_tanimla_view", "Yeni Başlık QR (Üretim)", "fa fa-plus-circle", "", "", "waiting('Yeni Başlık QR (Üretim)')") ?>
                            <?= nav_item("baslik/baslik_havuz_liste_view", "Başlık Havuzu (Yeniler)", "fa fa-list", "", "", "waiting('Başlık Havuzu (Yeniler)')") ?>
                            
                            <li class="nav-item">
                                <a href="<?=base_url("stok/urungonderim")?>" class="nav-link">
                                    <i class="fa fa-list nav-icon"></i>
                                    <p style="color:orange">HAVA HORT. GÖNDERİM</p>
                                </a>
                            </li>
                            <?= nav_item("baslik/iade_etiket", "İADE ETİKETİ YAZDIR", "fa fa-list") ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php 
                // Üretim modülü erişim kontrolü - daha esnek
                $uretim_erisim = false;
                
                // Yetki kontrolü
                if(goruntuleme_kontrol("cihaz_havuz_duzenle") || goruntuleme_kontrol("uretim_plan_yonetimi")) {
                    $uretim_erisim = true;
                }
                
                // Üretim departmanı kontrolü - departman adına göre (case-insensitive)
                if(isset($giris_yapan_k->departman_adi) && !empty($giris_yapan_k->departman_adi)) {
                    $departman_adi = mb_strtolower(trim($giris_yapan_k->departman_adi), 'UTF-8');
                    // "Üretim", "Uretim", "ÜRETİM" gibi varyasyonları kontrol et
                    if(strpos($departman_adi, 'üretim') !== false || 
                       strpos($departman_adi, 'uretim') !== false ||
                       strpos($departman_adi, 'üret') !== false ||
                       strpos($departman_adi, 'uret') !== false) {
                        $uretim_erisim = true;
                    }
                }
                
                // Departman ID kontrolü (yedek - daha geniş aralık)
                if(isset($giris_yapan_k->kullanici_departman_id)) {
                    // Üretim departmanı ID'leri (37, 8 ve diğer olası ID'ler)
                    // Not: Eğer hala çalışmıyorsa, bu ID'leri genişletmek gerekebilir
                    if(in_array($giris_yapan_k->kullanici_departman_id, [37, 8, 7, 9])) {
                        $uretim_erisim = true;
                    }
                }
                
                // Belirli kullanıcı ID'leri (yedek kontrol)
                if(user_in($aktif_kullanici_id, [1, 9, 37, 8, 7])) {
                    $uretim_erisim = true;
                }
                
                // DEBUG: Eğer hala giremiyorsa, tüm kullanıcılara geçici olarak açılabilir
                // Bu satırı kaldırmadan önce üretim departmanı ID'sini doğrulayın
                // if(true) { $uretim_erisim = true; } // GEÇİCİ - TÜM KULLANICILARA AÇIK
                
                if($uretim_erisim): ?>
                    <li class="nav-item" style="display: none;">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users-cog text-success"></i>
                            <p>ÜRETİM <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?= nav_item("cihaz/cihaz_havuz_tanimla_view", "Yeni Cihaz Kayıt", "fa fa-plus-circle", "", "", "waiting('Yeni Başlık QR (Üretim)')") ?>
                            <?= nav_item("cihaz/cihaz_havuz_liste_view", "Cihaz Havuzu (Stok)", "fa fa-list", "", "", "waiting('Başlık Havuzu (Yeniler)')") ?>
                            <?= nav_item("baslik/baslik_havuz_tanimla_view", "Yeni Başlık QR (Üretim)", "fa fa-plus-circle", "", "", "waiting('Yeni Başlık QR (Üretim)')") ?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="<?=base_url("uretim_planlama")?>" onclick="waiting('Üretim Planlama');" class="nav-link">
                            <i class="nav-icon fas fa-users-cog text-success"></i>
                            <p>ÜRETİM <span class="badge badge-info right">Restore</span></p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(goruntuleme_kontrol("demirbas_goruntule")): ?>
                    <li class="nav-item" style="display: none;">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-box text-primary"></i>
                            <p>ENVANTER <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?=base_url("demirbas/ekle/1")?>" style="border-left: 0;" class="nav-link">
                                    <i class="fa fa-plus nav-icon text-success"></i>
                                    <p>Yeni Envanter Ekle</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a style="border-left: 0;" href="<?=base_url("demirbas")?>" class="nav-link">
                                    <i class="far fa-file-alt nav-icon text-default"></i>
                                    <p>Tüm Envanterler</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="<?=base_url("demirbas")?>" onclick="waiting('Envanter');" class="nav-link">
                            <i class="nav-icon fas fa-box text-primary"></i>
                            <p>ENVANTER <span class="badge badge-info right">Restore</span></p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(goruntuleme_kontrol("muhasebe_rapor_goruntule")): ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-people-arrows text-red"></i>
                            <p>RAPORLAR <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?= nav_item("kullanici/muhasebe_rapor/".date("m"), "Muhasebe Rapor", "far fa-circle") ?>
                            <?= nav_item("talep/rapor", "Talep Analiz", "far fa-circle", "", "", "waiting('Talep Raporu')") ?>
                            <?= nav_item("talep/yogunluk_haritasi", "Talep Yoğunluk Haritası", "far fa-circle", "", "", "waiting('Talep Raporu')") ?>
                            <?= nav_item("talep/bekleyen_rapor_list", "Bekleyen Talepler", "far fa-circle", "", "", "waiting('Yönlendirilen Talepler')") ?>

                            <?php if(goruntuleme_kontrol("garanti_sorgulayanlari_goruntule")): ?>
                                <?= nav_item("cihaz/garanti_sorgulayanlar", "Garanti Sorgulayanlar", "far fa-circle") ?>
                            <?php endif; ?>

                            <?= nav_item("cihaz/cihaz_harita", "Cihaz Raporu (Harita)", "far fa-id-card", "", "", "waiting('Cihaz Raporu')") ?>
                            <?= nav_item("cihaz/rg_medikal_cihaz_harita", "RG Cihaz Raporu (Harita)", "far fa-id-card", "", "", "waiting('Cihaz Raporu')") ?>
                            
                            <li class="nav-item">
                                <a href="<?=base_url("siparis/degerlendirme_rapor")?>" style="border-left: 0;" class="nav-link">
                                    <i class="fa fa-list nav-icon"></i>
                                    <p>SMS Sonuçları</p>
                                </a>
                            </li>

                            <?php if(user_in($aktif_kullanici_id, [1, 7, 9])): ?>
                                <li class="nav-item">
                                    <a href="<?=base_url("atis")?>" style="border-left: 0;" class="nav-link">
                                        <i class="fa fa-list nav-icon"></i>
                                        <p>Atış Raporu</p>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if($user_id != 40): ?>
                    <?= nav_header("ENTEGRASYON") ?>
                <?php endif; ?>

                <?php if(goruntuleme_kontrol("arvento_goruntuless")): ?>
                    <li class="nav-item">
                        <a href="https://web.arvento.com/ui/shareVehiclesLink/ShareVehiclesLink.aspx?g=8fb0d168d591452eIB6zmbsR5u2EXLKmYgtgEg==9e0fa12eeeb2c989&ed=20250306093044&sd=20250106093055&lc=tr&ln=0" target="_blank" class="nav-link">
                            <i class="nav-icon fas fa-car text-primary"></i>
                            <p>ARVENTO</p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(goruntuleme_kontrol("calisma_plani_goruntule")): ?>
                    <?= nav_item("calisma_plan", "ÇALIŞMA PLANLAMA", "fas fa-clock", "text-success") ?>
                <?php endif; ?>

                <?php if(goruntuleme_kontrol("sadece_kendi_teklif_formlarini_goruntule") || goruntuleme_kontrol("tum_teklif_formlarini_goruntule")): ?>
                    <?= nav_item("teklif_form", "TEKLİF FORMLARI", "far fa-circle", "text-success") ?>
                <?php endif; ?>

                <?php if(goruntuleme_kontrol("kapi_yonetim")): ?>
                    <?= nav_item("kapi", "KAPI", "fas fa-door-open", "text-danger") ?>
                <?php endif; ?>

                <?php if(goruntuleme_kontrol("arvento_goruntule")): ?>
                    <?= nav_item("arvento", "ARVENTO", "fas fa-truck", "text-warning") ?>
                <?php endif; ?>

                <?php if(goruntuleme_kontrol("onemli_gun_yonetimi")): ?>
                    <?= nav_item("onemli_gun", "ÖNEMLİ GÜNLER", "fas fa-calendar", "text-primary") ?>
                    <?= nav_item("onemli_gun/index_etkinlik", "YAKLAŞAN ETKİNLİKLER", "fas fa-calendar", "text-primary") ?>
                    <?= nav_item("paylasim", "KAMPANYALAR", "fas fa-calendar", "text-primary") ?>
                <?php endif; ?>

                <?php if(goruntuleme_kontrol("sistem_ayar_duzenle")): ?>
                    <?= nav_header("SİSTEM") ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-cog text-warning"></i>
                            <p>SİSTEM YÖNETİMİ <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?= nav_item("kullanici", "Kullanıcılar", "fa fa-users") ?>
                            <?= nav_item("dogum_gunu", "Doğum Günü Bildirimleri", "fa fa-calendar-check") ?>
                            <?= nav_item("sms_templates", "SMS Metinleri", "fas fa-sms") ?>
                            <?= nav_item("kullanici-yetkileri", "Kullanıcı Yetkileri", "fa fa-lock") ?>
                            <?= nav_item("urun", "Ürün", "fa fa-building") ?>
                            <?= nav_item("departman", "Departmanlar", "fa fa-building") ?>
                            <?= nav_item("duyuru-kategori", "Duyuru Kategorileri", "fas fa-bullhorn") ?>
                            <?= nav_item("istek_birim", "İstek Birimleri", "far fa-life-ring") ?>
                            <?= nav_item("istek_kategori", "İstek Kategorileri", "far fa-life-ring") ?>
                            <?= nav_item("is_tip", "İş Tipleri", "far fa-list-alt") ?>
                            <?= nav_item("istek_durum", "İstek Durumları", "far fa-life-ring") ?>
                            <?= nav_item("dokuman_kategori", "Döküman Kategorileri", "far fa-folder") ?>
                            <?= nav_item("demirbas_kategori", "Envanter Kategorileri", "far fa-folder") ?>
                            <?= nav_item("demirbas_birim", "Envanter Birimleri", "far fa-life-ring") ?>
                            <?= nav_item("kullanici_grup", "Kullanıcı Grupları", "fa fa-users") ?>
                            <?= nav_item("sehir", "İl - İlçe Bilgileri", "fa fa-map-pin") ?>
                            <?= nav_item("yemek", "Yemek Listesi", "fa fa-envelope") ?>
                            <?= nav_item("ayar", "Parametreler", "fa fa-envelope") ?>
                            <li class="nav-item">
                                <a href="<?=base_url("ayar/arac_kilometre_ortalamalari")?>" class="nav-link">
                                    <i class="fas fa-tachometer-alt nav-icon"></i>
                                    <p style="font-size:12px">Araç Kilometre Ortalamaları</p>
                                </a>
                            </li>
                            <?= nav_item("ariza", "Başlık Arıza Tanımları", "fa fa-envelope") ?>
                            <?= nav_item("logs", "Log", "fas fa-power-off", "text-success") ?>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</aside>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var sidebar = document.getElementById("main-sidebar");
    var contentWrappers = document.querySelectorAll(".content-wrapper");
    var headerWrappers = document.querySelectorAll(".main-header");

    if (window.opener && window.innerWidth < 1366) {
        sidebar.style.display = "none";
        contentWrappers.forEach(function(contentWrapper) {
            contentWrapper.style.marginLeft = "0";
        });
        headerWrappers.forEach(function(headerWrapper) {
            headerWrapper.style.display = "none";
        });
    }

    var sidebarFilter = document.getElementById("sidebar-menu-filter");
    if (sidebarFilter) {
        sidebarFilter.addEventListener("keyup", function() {
            var filterValue = this.value.toLowerCase();
            var menuItems = document.querySelectorAll("#sidebar-menu-list > li");
            
            menuItems.forEach(function(item) {
                var text = item.textContent.toLowerCase();
                var navHeader = item.querySelector(".nav-header");
                
                if (navHeader) {
                    item.style.display = "";
                    return;
                }
                
                var treeview = item.querySelector(".nav-treeview");
                if (treeview) {
                    var subItems = treeview.querySelectorAll("li");
                    var hasMatch = false;
                    
                    if (text.includes(filterValue)) {
                        hasMatch = true;
                    }
                    
                    subItems.forEach(function(subItem) {
                        var subText = subItem.textContent.toLowerCase();
                        if (subText.includes(filterValue)) {
                            hasMatch = true;
                            subItem.style.display = "";
                        } else {
                            subItem.style.display = filterValue === "" ? "" : "none";
                        }
                    });
                    
                    item.style.display = hasMatch || filterValue === "" ? "" : "none";
                } else {
                    if (text.includes(filterValue) || filterValue === "") {
                        item.style.display = "";
                    } else {
                        item.style.display = "none";
                    }
                }
            });
        });
    }
});
</script>