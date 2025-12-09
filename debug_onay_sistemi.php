<?php
/**
 * Onay Sistemi Debug Script
 * Bu script, kullanıcı ID 9'un yetkilerini ve sipariş durumlarını kontrol eder
 * 
 * Kullanım: Tarayıcıda açın veya terminal'de çalıştırın
 */

// CodeIgniter'i yükle
require_once('index.php');

// Kullanıcı ID
$kullanici_id = 9;

echo "<h2>Onay Sistemi Debug - Kullanıcı ID: $kullanici_id</h2>";

// 1. Kullanıcının yetkilerini kontrol et
echo "<h3>1. Kullanıcının Sipariş Onay Yetkileri:</h3>";
$CI =& get_instance();
$CI->load->database();

$yetki_query = $CI->db->select("yetki_kodu")
    ->get_where("kullanici_yetki_tanimlari", array('kullanici_id' => $kullanici_id));

$kullanici_yetkileri = array();
foreach ($yetki_query->result() as $yetki) {
    if (strpos($yetki->yetki_kodu, 'siparis_onay_') === 0) {
        $yetki_no = str_replace('siparis_onay_', '', $yetki->yetki_kodu);
        $kullanici_yetkileri[] = $yetki_no;
        echo "✓ Yetki: <strong>{$yetki->yetki_kodu}</strong> (Yetki No: $yetki_no) → Adım " . ($yetki_no - 1) . "'i onaylayabilir<br>";
    }
}

echo "<br><strong>Yetkili Olduğu Adımlar:</strong> ";
foreach ($kullanici_yetkileri as $yetki_no) {
    $adim_no = $yetki_no - 1;
    echo "Adım $adim_no, ";
}
echo "<br><br>";

// 2. Örnek bir sipariş al (onay bekleyen)
echo "<h3>2. Örnek Onay Bekleyen Siparişler:</h3>";
$siparisler = $CI->db
    ->select('siparisler.siparis_id, siparisler.siparis_kodu, siparis_onay_hareketleri.adim_no')
    ->from('siparisler')
    ->join('(SELECT *, ROW_NUMBER() OVER (PARTITION BY siparis_no ORDER BY siparis_onay_hareket_id DESC) as row_num
              FROM siparis_onay_hareketleri) as siparis_onay_hareketleri',
            'siparis_onay_hareketleri.siparis_no = siparisler.siparis_id AND siparis_onay_hareketleri.row_num = 1', 'left')
    ->where('siparisler.siparis_aktif', 1)
    ->limit(10)
    ->get()
    ->result();

echo "<table border='1' cellpadding='5'>";
echo "<tr><th>Sipariş ID</th><th>Sipariş Kodu</th><th>Mevcut Adım (adim_no)</th><th>Bir Sonraki Adım</th><th>Gerekli Yetki</th><th>Kullanıcının Yetkisi Var mı?</th></tr>";

foreach ($siparisler as $siparis) {
    $mevcut_adim = $siparis->adim_no ? $siparis->adim_no : 0;
    $bir_sonraki_adim = $mevcut_adim + 1;
    $gerekli_yetki_no = $bir_sonraki_adim + 1; // siparis_onay_{bir_sonraki_adim+1}
    $yetki_var = in_array($gerekli_yetki_no, $kullanici_yetkileri);
    
    echo "<tr>";
    echo "<td>{$siparis->siparis_id}</td>";
    echo "<td>{$siparis->siparis_kodu}</td>";
    echo "<td>$mevcut_adim</td>";
    echo "<td><strong>$bir_sonraki_adim</strong></td>";
    echo "<td>siparis_onay_$gerekli_yetki_no</td>";
    echo "<td>" . ($yetki_var ? "<span style='color:green'>✓ VAR</span>" : "<span style='color:red'>✗ YOK</span>") . "</td>";
    echo "</tr>";
}

echo "</table>";

// 3. get_son_adim() fonksiyonunu test et
echo "<h3>3. get_son_adim() Fonksiyonu Test:</h3>";
if (!empty($siparisler)) {
    $test_siparis_id = $siparisler[0]->siparis_id;
    echo "Test Sipariş ID: $test_siparis_id<br>";
    
    // get_son_adim() fonksiyonunu çağır
    $son_adim = get_son_adim($test_siparis_id);
    
    if ($son_adim) {
        echo "get_son_adim() sonucu:<br>";
        echo "- adim_id: " . $son_adim[0]->adim_id . "<br>";
        echo "- adim_adi: " . $son_adim[0]->adim_adi . "<br>";
        echo "- adim_sira_numarasi: " . $son_adim[0]->adim_sira_numarasi . "<br>";
        
        $bir_sonraki_adim = $son_adim[0]->adim_id;
        $gerekli_yetki_no = $bir_sonraki_adim + 1;
        $yetki_var = in_array($gerekli_yetki_no, $kullanici_yetkileri);
        
        echo "<br><strong>Kontrol:</strong><br>";
        echo "- Bir sonraki adım: $bir_sonraki_adim<br>";
        echo "- Gerekli yetki: siparis_onay_$gerekli_yetki_no<br>";
        echo "- Kullanıcının yetkisi: " . ($yetki_var ? "VAR ✓" : "YOK ✗") . "<br>";
    } else {
        echo "get_son_adim() false döndü (sipariş henüz onay sürecine girmemiş olabilir)<br>";
    }
}

// 4. Adım yapısını göster
echo "<h3>4. Sipariş Onay Adımları Yapısı:</h3>";
$adimlar = $CI->db->select('*')
    ->from('siparis_onay_adimlari')
    ->order_by('adim_id', 'ASC')
    ->get()
    ->result();

echo "<table border='1' cellpadding='5'>";
echo "<tr><th>adim_id</th><th>adim_adi</th><th>adim_sira_numarasi</th><th>Gerekli Yetki Kodu</th></tr>";
foreach ($adimlar as $adim) {
    $gerekli_yetki = "siparis_onay_" . ($adim->adim_id + 1);
    echo "<tr>";
    echo "<td>{$adim->adim_id}</td>";
    echo "<td>{$adim->adim_adi}</td>";
    echo "<td>{$adim->adim_sira_numarasi}</td>";
    echo "<td>$gerekli_yetki</td>";
    echo "</tr>";
}
echo "</table>";

echo "<br><br><strong>Not:</strong> Yetki kodu 'siparis_onay_X' formatındadır. X numarası, adım ID'sinden 1 fazladır.<br>";
echo "Örnek: Adım 3'ü onaylamak için 'siparis_onay_4' yetkisi gerekir.<br>";

