-- ugajans_is_planlamasi tablosuna tekrarlama (recurrence) özellikleri için kolonlar ekleme
-- Bu SQL kodu görevlerin haftalık, aylık, yıllık tekrarlanması için gerekli alanları ekler



-- Açıklama:
-- tekrar_tipi: Görevin nasıl tekrarlanacağını belirler
--   - tek_seferlik: Sadece bir kez yapılacak (varsayılan)
--   - haftalik: Her hafta belirtilen günlerde
--   - aylik: Her ay belirtilen günde veya haftada
--   - yillik: Her yıl belirtilen tarihte
--
-- tekrar_gunleri: Haftalık tekrar için (örn: "1,3,5" = Pazartesi, Çarşamba, Cuma)
--
-- Aylık tekrar için iki seçenek:
--   1. Ayın belirli bir günü (tekrar_ay_gunu: 1-31)
--   2. Ayın belirli bir haftasının belirli bir günü (tekrar_hafta_gunu + tekrar_hafta_sira)
--      Örn: Her ayın ilk Pazartesi (tekrar_hafta_gunu=1, tekrar_hafta_sira=1)
--      Örn: Her ayın son Cuma (tekrar_hafta_gunu=5, tekrar_hafta_sira=-1)
--
-- Yıllık tekrar: Her yıl aynı tarihte (tekrar_yil_ay + tekrar_yil_gun)
--   Örn: Her yıl 15 Ocak (tekrar_yil_ay=1, tekrar_yil_gun=15)
--
-- tekrar_baslangic_tarihi: Tekrarlamanın başlayacağı tarih
-- tekrar_bitis_tarihi: Tekrarlamanın biteceği tarih (NULL ise sınırsız)
-- tekrar_sayisi: Kaç kez tekrarlanacak (NULL ise bitiş tarihine kadar)
--
-- ana_gorev_id: Tekrarlanan görevler için ilk oluşturulan görevin ID'si
-- son_tekrar_tarihi: Son ne zaman tekrar oluşturuldu (otomatik güncellenir)
