-- Sipariş Merkez Değiştirme Özelliği için SQL
-- Not: Bu özellik için yeni bir tablo oluşturmaya gerek yoktur.
-- Mevcut yapı zaten merkezler tablosu üzerinden çalışmaktadır.
-- Siparişler tablosunda merkez_no alanı zaten mevcuttur.

-- Sadece bilgilendirme amaçlı kontrol sorgusu:
-- SELECT COLUMN_NAME, DATA_TYPE, IS_NULLABLE 
-- FROM INFORMATION_SCHEMA.COLUMNS 
-- WHERE TABLE_NAME = 'siparisler' AND COLUMN_NAME = 'merkez_no';

-- Mevcut yapı:
-- siparisler.merkez_no -> merkezler.merkez_id (Foreign Key)
-- merkezler.merkez_adresi -> Adres bilgisi burada saklanıyor
-- merkezler.merkez_yetkili_id -> musteriler.musteri_id (Foreign Key)

-- Yeni özellik:
-- Sipariş detayları düzenleme sayfasından merkez seçimi yapılabilecek
-- Eğer yeni merkez oluşturulmak istenirse, aynı müşteriye ait yeni merkez oluşturulacak
-- Mevcut merkez adresi değişmeyecek, sadece sipariş yeni merkeze bağlanacak
