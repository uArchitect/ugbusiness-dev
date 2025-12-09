<?php
/**
 * Sipariş View Helper Fonksiyonları
 * 
 * View katmanındaki karmaşık mantığı buraya taşıyarak kod tekrarını önler
 */

if (!function_exists('should_show_siparis_row')) {
    /**
     * Sipariş satırının gösterilip gösterilmeyeceğini kontrol eder
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
        // Tüm Siparişler tabında (filter=3) özel kontrolleri atla
        if ($tum_siparisler_tabi) {
            return true;
        }

        // Kullanıcı ID 2 için özel kontrol
        if ($ak == 2) {
            $allowed_users = [2, 5, 18, 94];
            if (!in_array($siparis->siparisi_olusturan_kullanici, $allowed_users)) {
                return false;
            }
        }

        // Kullanıcı ID 9 için: adım 4'teki siparişleri gizle
        if ($ak == 9) {
            $adim_no = isset($siparis->adim_no) ? (int)$siparis->adim_no : null;
            if ($adim_no === 3) {
                return false;
            }
            
            if ($data && isset($data[0])) {
                if (isset($data[0]->adim_id) && (int)$data[0]->adim_id === 4) {
                    return false;
                }
                if (isset($data[0]->adim_sira_numarasi) && (int)$data[0]->adim_sira_numarasi === 4) {
                    return false;
                }
            }
        }

        // Üst satış onayı kontrolleri
        if ($siparis->siparis_ust_satis_onayi == 1) {
            $i_kul = isset($GLOBALS['i_kul']) ? $GLOBALS['i_kul'] : $ak;
            if (in_array($i_kul, [7, 1]) && isset($data[0]->adim_id) && $data[0]->adim_id == 4) {
                return false;
            }
        }

        if ($siparis->siparis_ust_satis_onayi == 0) {
            $i_kul = isset($GLOBALS['i_kul']) ? $GLOBALS['i_kul'] : $ak;
            if (in_array($i_kul, [37, 8])) {
                return false;
            }
        }

        // Eğitim ekibi kontrolü
        if ($ak != 37 && isset($data[0]->adim_id) && $data[0]->adim_id >= 11) {
            if (strpos($siparis->egitim_ekip, "\"$ak\"") === false) {
                return false;
            }
        }

        // Filtre kontrolleri
        if (!empty($filter)) {
            if ($filter == "1" && $siparis->beklemede == 0 && $ak != 9) {
                return false;
            }
            if ($filter == "2" && $siparis->beklemede == 1) {
                return false;
            }
        }

        return true;
    }
}

