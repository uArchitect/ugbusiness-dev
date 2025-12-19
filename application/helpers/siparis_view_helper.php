<?php
/**
 * Sipariş View Helper Fonksiyonları
 * 
 * View katmanındaki karmaşık mantığı buraya taşıyarak kod tekrarını önler
 * Daha akıllı ve mantıklı bir yapı ile optimize edilmiştir
 */

if (!function_exists('should_show_siparis_row')) {
    /**
     * Sipariş satırının gösterilip gösterilmeyeceğini kontrol eder
     * Optimize edilmiş ve daha akıllı mantık ile çalışır
     * 
     * @param object $siparis Sipariş objesi
     * @param array $data Son adım bilgileri
     * @param int $ak Aktif kullanıcı ID
     * @param bool $tum_siparisler_tabi Tüm siparişler tabı aktif mi?
     * @param string $filter Mevcut filtre değeri
     * @return bool
     */
    function should_show_siparis_row($siparis, $data, $ak, $tum_siparisler_tabi, $filter = '')
    {
        // Tüm Siparişler tabında özel kontrolleri atla
        if ($tum_siparisler_tabi) {
            return true;
        }

        // Kullanıcı bazlı özel kurallar (kullanıcı ID mapping)
        $user_specific_rules = [
            2 => function($siparis) {
                return in_array($siparis->siparisi_olusturan_kullanici, [2, 5, 18, 94]);
            },
            9 => function($siparis, $data) {
                // Kullanıcı 9: Adım 3'teki siparişleri görebilir (3.1 adımını görmek için)
                // Adım 4'teki siparişleri göremez, ANCAK 2. satış onayı bekleyenler gösterilir
                if ($data && isset($data[0])) {
                    $adim_id = isset($data[0]->adim_id) ? (int)$data[0]->adim_id : null;
                    $adim_sira = isset($data[0]->adim_sira_numarasi) ? (int)$data[0]->adim_sira_numarasi : null;
                    // Adım 4'teki siparişleri kontrol et
                    if ($adim_id === 4 || $adim_sira === 4) {
                        // Eğer 2. satış onayı bekliyorsa (siparis_ust_satis_onayi = 0), göster
                        if (isset($siparis->siparis_ust_satis_onayi) && $siparis->siparis_ust_satis_onayi == 0) {
                            return true; // 2. satış onayı bekleyen adım 4 siparişleri göster
                        }
                        // Diğer adım 4 siparişlerini gizle
                        return false;
                    }
                }
                // Adım 3'teki siparişleri göster (3.1 adımını görmek için)
                return true;
            }
        ];

        if (isset($user_specific_rules[$ak])) {
            if (!$user_specific_rules[$ak]($siparis, $data)) {
                return false;
            }
        }

        // Üst satış onayı kontrolleri (daha temiz mantık)
        $i_kul = isset($GLOBALS['i_kul']) ? $GLOBALS['i_kul'] : $ak;
        $next_adim_id = isset($data[0]->adim_id) ? (int)$data[0]->adim_id : null;
        
        if ($siparis->siparis_ust_satis_onayi == 1) {
            // Üst satış onayı verilmişse, adım 4'teki siparişleri belirli kullanıcılardan gizle
            if (in_array($i_kul, [7, 1]) && $next_adim_id == 4) {
                return false;
            }
        } else {
            // Üst satış onayı verilmemişse, belirli kullanıcılar göremez
            if (in_array($i_kul, [37, 8])) {
                return false;
            }
        }

        // Eğitim ekibi kontrolü (adım 11 ve üzeri için)
        if ($ak != 37 && $next_adim_id >= 11) {
            $egitim_ekip = isset($siparis->egitim_ekip) ? $siparis->egitim_ekip : '';
            if (strpos($egitim_ekip, "\"$ak\"") === false) {
                return false;
            }
        }

        // Filtre bazlı kontroller
        if (!empty($filter)) {
            $beklemede = isset($siparis->beklemede) ? (int)$siparis->beklemede : 0;
            
            if ($filter == "1" && $beklemede == 0 && $ak != 9) {
                return false;
            }
            if ($filter == "2" && $beklemede == 1) {
                return false;
            }
        }

        return true;
    }
}

if (!function_exists('can_user_approve_siparis')) {
    /**
     * Kullanıcının siparişi onaylayıp onaylayamayacağını kontrol eder
     * Daha akıllı ve optimize edilmiş mantık
     * 
     * Mantık: Yetki kodu siparis_onay_2 ise adım 1'i onaylayabilir
     * Yani: next_adim = 1 ise, yetki kodu 2 olmalı
     * 
     * @param int $siparis_id Sipariş ID
     * @param int $kullanici_id Kullanıcı ID
     * @param array $kullanici_yetkili_adimlar Kullanıcının yetkili olduğu adımlar (yetki kodu numaraları: 2, 3, 4...)
     * @param object $siparis Sipariş objesi (adim_no içerir)
     * @return bool
     */
    function can_user_approve_siparis($siparis_id, $kullanici_id, $kullanici_yetkili_adimlar, $siparis)
    {
        // Yetkili adımlar boşsa onaylayamaz
        if (empty($kullanici_yetkili_adimlar)) {
            return false;
        }
        
        // Sipariş objesinden mevcut adımı al
        $current_adim = isset($siparis->adim_no) ? (int)$siparis->adim_no : 0;
        $next_adim = $current_adim + 1;
        
        // Mantık: Yetki kodu siparis_onay_2 ise adım 1'i onaylayabilir
        // Yani: next_adim = 1 ise, yetki kodu 2 olmalı (next_adim + 1)
        // kullanici_yetkili_adimlar array'inde yetki kodu numarası var (örn: 2, 3, 4...)
        $required_yetki_kodu = $next_adim + 1;
        
        return in_array($required_yetki_kodu, $kullanici_yetkili_adimlar);
    }
}

