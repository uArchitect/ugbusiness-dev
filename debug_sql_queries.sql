-- Onay Sistemi Debug SQL Sorguları
-- Bu sorguları phpMyAdmin veya MySQL client'ta çalıştırın

-- 1. Kullanıcı ID 9'un sipariş onay yetkilerini göster
SELECT 
    yetki_kodu,
    CASE 
        WHEN yetki_kodu LIKE 'siparis_onay_%' THEN 
            CAST(REPLACE(yetki_kodu, 'siparis_onay_', '') AS UNSIGNED) - 1
        ELSE NULL
    END AS onaylayabilecegi_adim
FROM kullanici_yetki_tanimlari
WHERE kullanici_id = 9
  AND yetki_kodu LIKE 'siparis_onay_%'
ORDER BY yetki_kodu;

-- 2. Örnek bir onay bekleyen sipariş ve durumunu göster
SELECT 
    s.siparis_id,
    s.siparis_kodu,
    soh.adim_no AS mevcut_adim_no,
    soh.adim_no + 1 AS bir_sonraki_adim,
    CONCAT('siparis_onay_', soh.adim_no + 2) AS gerekli_yetki_kodu,
    CASE 
        WHEN EXISTS (
            SELECT 1 FROM kullanici_yetki_tanimlari 
            WHERE kullanici_id = 9 
            AND yetki_kodu = CONCAT('siparis_onay_', soh.adim_no + 2)
        ) THEN 'VAR'
        ELSE 'YOK'
    END AS kullanici_9_yetkisi
FROM siparisler s
LEFT JOIN (
    SELECT 
        siparis_no,
        adim_no,
        ROW_NUMBER() OVER (PARTITION BY siparis_no ORDER BY siparis_onay_hareket_id DESC) as row_num
    FROM siparis_onay_hareketleri
) soh ON soh.siparis_no = s.siparis_id AND soh.row_num = 1
WHERE s.siparis_aktif = 1
  AND soh.adim_no IS NOT NULL
  AND soh.adim_no < 12
LIMIT 10;

-- 3. get_son_adim() fonksiyonunun döndüreceği değerleri göster
SELECT 
    s.siparis_id,
    s.siparis_kodu,
    soh.adim_no AS son_onaylanan_adim,
    soh.adim_no + 1 AS bir_sonraki_adim_id,
    soa.adim_id,
    soa.adim_adi,
    soa.adim_sira_numarasi,
    CONCAT('siparis_onay_', soh.adim_no + 2) AS gerekli_yetki_kodu
FROM siparisler s
LEFT JOIN (
    SELECT 
        siparis_no,
        adim_no,
        ROW_NUMBER() OVER (PARTITION BY siparis_no ORDER BY siparis_onay_hareket_id DESC) as row_num
    FROM siparis_onay_hareketleri
) soh ON soh.siparis_no = s.siparis_id AND soh.row_num = 1
LEFT JOIN siparis_onay_adimlari soa ON soa.adim_id = soh.adim_no + 1
WHERE s.siparis_aktif = 1
  AND soh.adim_no IS NOT NULL
  AND soh.adim_no < 12
LIMIT 10;

-- 4. Kullanıcı 9'un hangi adımlardaki siparişleri görebileceğini hesapla
SELECT 
    s.siparis_id,
    s.siparis_kodu,
    soh.adim_no AS mevcut_adim,
    soh.adim_no + 1 AS bir_sonraki_adim,
    CONCAT('siparis_onay_', soh.adim_no + 2) AS gerekli_yetki,
    CASE 
        WHEN EXISTS (
            SELECT 1 FROM kullanici_yetki_tanimlari 
            WHERE kullanici_id = 9 
            AND yetki_kodu = CONCAT('siparis_onay_', soh.adim_no + 2)
        ) THEN 'GÖSTERİLMELİ'
        ELSE 'GÖSTERİLMEMELİ'
    END AS durum
FROM siparisler s
LEFT JOIN (
    SELECT 
        siparis_no,
        adim_no,
        ROW_NUMBER() OVER (PARTITION BY siparis_no ORDER BY siparis_onay_hareket_id DESC) as row_num
    FROM siparis_onay_hareketleri
) soh ON soh.siparis_no = s.siparis_id AND soh.row_num = 1
WHERE s.siparis_aktif = 1
  AND soh.adim_no IS NOT NULL
  AND soh.adim_no < 12
ORDER BY s.siparis_id DESC
LIMIT 20;

