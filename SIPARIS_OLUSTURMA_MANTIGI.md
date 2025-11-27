# SİPARİŞ OLUŞTURMA MANTIĞI - MOBİL UYGULAMA İÇİN

## GENEL BAKIŞ

Sipariş oluşturma sistemi, müşterilere ürün satışı yapmak için kullanılan bir süreçtir. Sistem, bir siparişte birden fazla ürün eklenmesine, her ürün için farklı özellikler seçilmesine ve çeşitli validasyon kurallarına sahiptir.

**Base URL**: `https://ugbusiness.com.tr/api2/`

---

## 1. API ENDPOINT'LERİ

### 1.1. Sipariş Sayfası Bilgileri
**Endpoint**: `GET /api2/mobil_satis_sayfasi_bilgileri`

**Response**:
```json
{
  "status": "success",
  "urunler": [...],
  "hediyeler": [...],
  "basliklar": [...],
  "odeme_secenekleri": [...],
  "para_birimleri": [...]
}
```

**Açıklama**: Sipariş oluşturma sayfası için gerekli tüm listeleri getirir (ürünler, hediyeler, başlıklar, ödeme seçenekleri, para birimleri). Her ürün için renkler ve başlıklar da dahildir.

---

### 1.2. Sipariş Oluşturma
**Endpoint**: `POST /api2/satis_olustur`

**Request Body**:
```json
{
  "kullanici_id": 123,
  "merkez_id": 456,
  "urunler": [
    {
      "urun_no": 1,
      "renk": 5,
      "basliklar": ["1", "2", "3"],
      "satis_fiyati": "50000",
      "kapora_fiyati": "10000",
      "pesinat_fiyati": "40000",
      "fatura_tutari": "50000",
      "odeme_secenek": 1,
      "vade_sayisi": 0,
      "damla_etiket": 1,
      "acilis_ekrani": 1,
      "yenilenmis_cihaz_mi": 0,
      "para_birimi": "TRY",
      "hediye_no": 0,
      "siparis_notu": "Not metni",
      "takas_alinan_model": "0",
      "takas_bedeli": "0",
      "takas_alinan_seri_kod": "",
      "takas_alinan_renk": "",
      "takas_fotograflari": []
    }
  ]
}
```

**Response**:
```json
{
  "status": "success",
  "message": "Satış başarıyla oluşturuldu.",
  "siparis_id": 789,
  "siparis_kodu": "SPR0101202412345",
  "urunler_kaydedildi": [101, 102],
  "timestamp": "2024-01-01 12:00:00"
}
```

**Açıklama**: 
- Sipariş oluşturulduktan sonra otomatik olarak:
  - Onay hareketleri kaydedilir (Adım 1: Görüşme kaydı, Adım 2: Sipariş kaydı)
  - **Not**: SMS ve sistem bildirimleri gönderilmez (mobil uygulama için)

---

### 1.3. Sipariş Validasyon Kontrolü
**Endpoint**: `POST /api2/siparis_validasyon`

**Request Body**:
```json
{
  "kullanici_id": 123,
  "urunler": [
    {
      "urun_no": 1,
      "basliklar": ["1", "2"],
      "odeme_secenek": 1,
      "satis_fiyati": "50000",
      "kapora_fiyati": "10000",
      "pesinat_fiyati": "40000",
      "takas_bedeli": "0",
      "vade_sayisi": 0,
      "yenilenmis_cihaz_mi": 0,
      "fatura_tutari": "50000",
      "takas_alinan_model": "0"
    }
  ]
}
```

**Response (Başarılı)**:
```json
{
  "status": "success",
  "message": "Tüm validasyon kontrolleri başarılı.",
  "valid": true
}
```

**Response (Hata)**:
```json
{
  "status": "error",
  "message": "Validasyon hataları bulundu.",
  "valid": false,
  "errors": {
    "urun_1_baslik": "Ürün 1 için en az 1 başlık seçilmelidir.",
    "urun_1_fiyat": "Peşin satışlarda Kapora, Peşinat ve Takas Bedeli tutarlarının toplamı Satış fiyatına eşit olmak zorundadır."
  }
}
```

**Açıklama**: Tüm validasyon kurallarını kontrol eder. Sipariş oluşturmadan önce bu endpoint'i çağırarak hataları kontrol edin.

---

### 1.4. Takas Kontrolü
**Endpoint**: `POST /api2/takas_kontrol` veya `GET /api2/takas_kontrol`

**Request (POST)**:
```json
{
  "seri_no": "UG1234567890123",
  "telefon": "05321234567"
}
```

**Request (GET)**: `?seri_no=UG1234567890123&telefon=05321234567`

**Response (Başarılı)**:
```json
{
  "status": "success",
  "message": "Takas kontrolü başarılı. Müşteriler eşleşiyor.",
  "durum": true
}
```

**Response (Hata)**:
```json
{
  "status": "error",
  "message": "TAKAS - MÜŞTERİ İLİŞKİSİ KURULAMADI. Takas cihazının müşterisi ile sipariş müşterisi eşleşmiyor.",
  "durum": false
}
```

**Açıklama**: Takas cihazının seri numarasına kayıtlı müşteri ile sipariş oluşturulan müşterinin aynı olup olmadığını kontrol eder. UMEX takas için kullanılır.

---

### 1.5. Fiyat Limit Kontrolü
**Endpoint**: `POST /api2/fiyat_limit_kontrol` veya `GET /api2/fiyat_limit_kontrol`

**Request (POST)**:
```json
{
  "kullanici_id": 123,
  "urun_id": 1,
  "vade_sayisi": 12,
  "pesinat_tutari": "20000"
}
```

**Response (Limit Kontrolü Kapalı)**:
```json
{
  "status": "success",
  "message": "Kullanıcı limit kontrolü kapalı. Tüm fiyatlar kabul edilir.",
  "fullaccess": true,
  "data": []
}
```

**Response (Limit Kontrolü Açık)**:
```json
{
  "status": "success",
  "message": "Fiyat limitleri başarıyla getirildi.",
  "fullaccess": false,
  "data": [
    {
      "limit_urun_id": 1,
      "pesinat_fiyati": 10000,
      "nakit_takassiz_satis_fiyat": 50000,
      "nakit_takassiz_satis_fiyat_kontrol": 48000,
      "nakit_umex_takas_fiyat": 30000,
      "vadeli_umex_takas_fiyat": 35000,
      "vadeli_satis_fiyat": 55000,
      "vadeli_satis_fiyat_kontrol": 53000
    }
  ]
}
```

**Açıklama**: Kullanıcının fiyat limitlerini getirir. Vadeli satış için hesaplanmış limit fiyatları da döner.

---

## 2. ÜRÜN BİLGİLERİ (Her Ürün İçin)

### 2.1. Temel Ürün Bilgileri
- **Ürün Seçimi**: `urun_no` (Ürün ID'si) - Zorunlu
- **Renk Seçimi**: `renk` (Renk ID'si) - Zorunlu
  - Ürün seçimine göre renkler `mobil_satis_sayfasi_bilgileri` endpoint'inden alınır
- **Başlık Seçimi**: `basliklar` (Array - Başlık ID'leri) - Zorunlu
  - Bazı ürünlerde (ID: 2, 3, 4, 5, 7) tüm başlıklar otomatik seçilir
  - Diğer ürünlerde kullanıcı manuel seçim yapar
  - **ZORUNLU**: En az 1 başlık seçilmeli
  - Format: `["1", "2", "3"]` (String array)

### 2.2. Fiyat Bilgileri
- **Para Birimi**: `para_birimi` - TRY, USD, EUR - Zorunlu
- **Satış Fiyatı**: `satis_fiyati` (String, sayısal değer) - Zorunlu
- **Kapora Fiyatı**: `kapora_fiyati` (String, sayısal değer) - Zorunlu
- **Peşinat Fiyatı**: `pesinat_fiyati` (String, sayısal değer) - Zorunlu
- **Fatura Tutarı**: `fatura_tutari` (String, sayısal değer) - Zorunlu
  - Yenilenmiş cihazlarda maksimum 50.000 TL olmalı

### 2.3. Ödeme Seçeneği
- **Ödeme Seçeneği**: `odeme_secenek` - 1 (Peşin) veya 2 (Vadeli) - Zorunlu
- **Vade Sayısı**: `vade_sayisi` (Integer) - Vadeli satışta zorunlu (1-20 veya 1-30 ay)
  - Peşin satışta otomatik 0 olur

### 2.4. Takas Bilgileri (Opsiyonel)
- **Takas Cihaz Model**: `takas_alinan_model`
  - "0" = TAKAS YOK
  - "UMEX" = UMEX marka takas cihazı
  - "ROBOTX" = ROBOTX marka takas cihazı
  - "DIGER" = Diğer marka takas cihazı
- **Takas Bedeli**: `takas_bedeli` (String, sayısal değer) - Takas varsa zorunlu
- **Takas Cihaz Seri Kodu**: `takas_alinan_seri_kod` - UMEX için zorunlu
  - UMEX takaslarda seri kodu "UG" ile başlamalı ve 14 karakter olmalı
- **Takas Cihaz Renk**: `takas_alinan_renk` - UMEX için zorunlu
- **Takas Fotoğrafları**: `takas_fotograflari` (Array - URL'ler)
  - Fotoğraflar önce yüklenmeli, URL'ler alınmalı
  - Format: `["uploads/takas_fotograflari/foto1.jpg", ...]`

### 2.5. Ürün Özellikleri
- **Damla Etiket**: `damla_etiket` - 0 (Hayır) veya 1 (Evet) - Zorunlu
- **Açılış Ekranı**: `acilis_ekrani` - 0 (Hayır) veya 1 (Evet) - Zorunlu
- **Yenilenmiş Cihaz Mı**: `yenilenmis_cihaz_mi` - 0 (Hayır) veya 1 (Evet) - Zorunlu
- **Hediye**: `hediye_no` - 0 (Hediye Yok) veya hediye ID'si

### 2.6. Notlar
- **Sipariş Notu**: `siparis_notu` (String, HTML formatında) - Opsiyonel

---

## 3. VALİDASYON KURALLARI

### 3.1. Genel Validasyonlar
1. **En Az 1 Ürün**: Sipariş oluşturmak için en az 1 ürün eklenmeli
2. **Başlık Seçimi**: Her ürün için en az 1 başlık seçilmeli
3. **Zorunlu Alanlar**: Tüm zorunlu alanlar doldurulmalı

**Kontrol**: `POST /api2/siparis_validasyon` endpoint'ini kullanın.

### 3.2. Fiyat Validasyonları

#### 3.2.1. Peşin Satış Validasyonu
- **Kural**: `Satış Fiyatı = Kapora + Peşinat + Takas Bedeli`
- **Hata Mesajı**: "Peşin satışlarda Kapora, Peşinat ve Takas Bedeli tutarlarının toplamı Satış fiyatına eşit olmak zorundadır."

#### 3.2.2. Vadeli Satış Validasyonu
- **Kural**: `vade_sayisi > 0`
- **Hata Mesajı**: "Vadeli satışlarda vade sayısı 0'dan büyük olmak zorundadır."

#### 3.2.3. Yenilenmiş Cihaz Validasyonu
- **Kural**: `fatura_tutari <= 50000` (TRY için)
- **Hata Mesajı**: "Yenilenmiş Cihazlarda Fatura Tutarını Maksimum 50.000 TL Girebilirsiniz"

### 3.3. Takas Validasyonları

#### 3.3.1. Takas Bedeli Kontrolü
- **Kural**: Takas modeli seçilmişse (UMEX, ROBOTX, DIGER) `takas_bedeli > 0`
- **Hata Mesajı**: "Takaslı satışlarda takas bedeli 0'dan büyük olmak zorundadır."

#### 3.3.2. UMEX Takas Validasyonları
- **Seri Kodu Kontrolü**:
  - Boş olamaz
  - "UG" ile başlamalı
  - 14 karakter olmalı
- **Renk Kontrolü**: Boş olamaz
- **Hata Mesajı**: "UMEX Takaslı Satışlarda TAKAS CİHAZ SERİ KOD ve TAKAS CİHAZ RENK alanları zorunludur."
- **Format Hatası**: "UMEX Takaslı Satışlarda TAKAS CİHAZ SERİ KODU UG ile başlamalı ve 14 karakter olmalıdır."

#### 3.3.3. Takas Müşteri Kontrolü
- **Kontrol**: `POST /api2/takas_kontrol` endpoint'ini kullanın
- **Parametreler**: `seri_no`, `telefon` (müşteri telefon numarası)
- **Hata Mesajı**: "TAKAS - MÜŞTERİ İLİŞKİSİ KURULAMADI"
- **Açıklama**: Takas cihazının seri numarasına kayıtlı müşteri ile sipariş oluşturulan müşteri aynı olmalı

### 3.4. Fiyat Limit Kontrolleri

#### 3.4.1. Limit Kontrolü
- **Endpoint**: `POST /api2/fiyat_limit_kontrol`
- **Parametreler**: `kullanici_id`, `urun_id`, `vade_sayisi`, `pesinat_tutari`
- **Kullanıcı Limit Kontrolü**: 
  - Eğer `fullaccess: true` ise → Limit kontrolü yapılmaz
  - Eğer `fullaccess: false` ise → Limit kontrolleri yapılır

#### 3.4.2. Peşinat ve Kapora Toplamı Kontrolü
- **Kural**: `Peşinat + Kapora >= pesinat_fiyati` (endpoint'ten gelen)
- **Hata Mesajı**: "Peşinat ve kapora fiyatlarını toplamı en az [pesinat_fiyati] olmak zorundadır."

#### 3.4.3. Satış Fiyatı Limit Kontrolleri

**Peşin Satış:**
- **Kontrol**: `Satış Fiyatı >= nakit_takassiz_satis_fiyat_kontrol` (endpoint'ten gelen)
- **Hata Mesajı**: "Satış fiyatı için girdiğiniz tutar geçersiz. Satış için izin verilen alt limit [limit] TL 'dir."

**Vadeli Satış:**
- **Kontrol**: `Satış Fiyatı >= vadeli_satis_fiyat_kontrol` (endpoint'ten gelen)
- **Hata Mesajı**: "[vade] ay vadeli, [peşinat] peşinatlı satış için izin verilen alt limit [limit] TL 'dir."

#### 3.4.4. Takas Bedeli Limit Kontrolleri

**Peşin Satış - UMEX Takas:**
- **Kontrol**: `Takas Bedeli <= nakit_umex_takas_fiyat` (endpoint'ten gelen)
- **Hata Mesajı**: "UMEX TAKAS BEDELİ HATALI - PEŞİN"

**Peşin Satış - ROBOTX Takas:**
- **Kontrol**: `Takas Bedeli <= nakit_robotix_takas_fiyat` (endpoint'ten gelen)
- **Hata Mesajı**: "ROBOTX TAKAS BEDELİ HATALI - PEŞİN"

**Peşin Satış - DİĞER Takas:**
- **Kontrol**: `Takas Bedeli <= nakit_diger_takas_fiyat` (endpoint'ten gelen)
- **Hata Mesajı**: "DIGER CİHAZ TAKAS BEDELİ HATALI - PEŞİN"

**Vadeli Satış - UMEX Takas:**
- **Kontrol**: `Takas Bedeli <= vadeli_umex_takas_fiyat` (endpoint'ten gelen)
- **Hata Mesajı**: "UMEX TAKAS BEDELİ HATALI - VADELİ"

**Vadeli Satış - ROBOTX Takas:**
- **Kontrol**: `Takas Bedeli <= vadeli_robotix_takas_fiyat` (endpoint'ten gelen)
- **Hata Mesajı**: "ROBOTX TAKAS BEDELİ HATALI - VADELİ"

**Vadeli Satış - DİĞER Takas:**
- **Kontrol**: `Takas Bedeli <= vadeli_diger_takas_fiyat` (endpoint'ten gelen)
- **Hata Mesajı**: "DIGER CİHAZ TAKAS BEDELİ HATALI - VADELİ"

### 3.5. Ürün Bazlı Kurallar
- **Ürün ID 1 ve 8**: Takas yapılabilir
- **Diğer Ürünler**: Takas yapılamaz (takas bilgileri göz ardı edilir)

---

## 4. VERİ FORMATLARI

### 4.1. Başlık Verisi
- **Format**: String array (JSON array olarak gönderilir)
- **Örnek**: `["1", "2", "3"]`
- **Açıklama**: Seçilen başlık ID'leri string array olarak gönderilir. Backend'de önce JSON encode edilir, sonra base64 encode edilir ve veritabanına kaydedilir.

### 4.2. Fiyat Verileri
- **Format**: String (sayısal değer, nokta ile ondalık)
- **Örnek**: `"50000"` veya `"50000.50"`
- **Açıklama**: Backend'de virgül, ₺ ve boşluk karakterlerinden temizlenir.

### 4.3. Takas Fotoğrafları
- **Format**: String array (URL'ler)
- **Örnek**: `["uploads/takas_fotograflari/foto1.jpg", "uploads/takas_fotograflari/foto2.jpg"]`
- **Açıklama**: Fotoğraflar önce yüklenmeli, dönen URL'ler array olarak gönderilir.

---

## 5. SİPARİŞ OLUŞTURMA ADIMLARI

### 5.1. Ön Hazırlık
1. **Sayfa Bilgilerini Al**: `GET /api2/mobil_satis_sayfasi_bilgileri`
   - Ürünler, renkler, başlıklar, hediyeler listesini al
2. **Merkez Seçimi**: Kullanıcı merkez seçer (merkez_id)

### 5.2. Ürün Ekleme
Her ürün için:
1. Ürün seçilir
2. Renk seçilir (ürüne göre dinamik yüklenir)
3. Başlıklar seçilir (ürün ID 2,3,4,5,7 için otomatik seçilir)
4. Fiyat bilgileri girilir
5. Ödeme seçeneği seçilir
6. Takas bilgileri girilir (varsa)
7. Ürün özellikleri seçilir
8. Hediye seçilir (opsiyonel)
9. Not girilir (opsiyonel)

### 5.3. Validasyon Kontrolü
1. **Genel Validasyon**: `POST /api2/siparis_validasyon`
   - Tüm validasyon kurallarını kontrol eder
   - Hata varsa kullanıcıya gösterilir
2. **Takas Kontrolü** (UMEX takas varsa): `POST /api2/takas_kontrol`
   - Müşteri eşleşmesi kontrol edilir
3. **Fiyat Limit Kontrolü**: `POST /api2/fiyat_limit_kontrol`
   - Kullanıcı limitlerine göre fiyat kontrolü yapılır

### 5.4. Sipariş Oluşturma
1. **Sipariş Gönder**: `POST /api2/satis_olustur`
   - Tüm ürün bilgileri ile birlikte gönderilir
2. **Response Kontrolü**:
   - Başarılı ise: `siparis_id` ve `siparis_kodu` alınır
   - Hata varsa: Hata mesajı gösterilir

### 5.5. Backend İşlemleri (Otomatik)
1. Sipariş kaydı oluşturulur → `siparis_id` alınır
2. Sipariş kodu oluşturulur → "SPR" + tarih (dmY) + ID (5 haneli)
3. Onay hareketi 1 (Görüşme kaydı) → Otomatik kaydedilir
4. Onay hareketi 2 (Sipariş kaydı) → Otomatik kaydedilir
5. Her ürün için:
   - Sipariş ürünü kaydedilir
   - Takas kontrolü yapılır (UMEX ise)
   - Takas fotoğrafları kaydedilir
6. **Not**: SMS ve sistem bildirimleri gönderilmez (mobil uygulama için)

---

## 6. ÖZEL DURUMLAR VE KURALLAR

### 6.1. Başlık Seçimi Kuralları
- **Ürün ID 2, 3, 4, 5, 7**: Tüm başlıklar otomatik seçilir
- **Diğer Ürünler**: Kullanıcı manuel seçim yapar
- **Zorunluluk**: Her ürün için en az 1 başlık seçilmeli

### 6.2. Takas Kuralları
- **Sadece Ürün ID 1 ve 8**: Takas yapılabilir
- **Diğer Ürünler**: Takas yapılamaz (takas bilgileri göz ardı edilir)
- **UMEX Takas**: Seri kodu "UG" ile başlamalı ve 14 karakter olmalı
- **Müşteri Kontrolü**: Takas cihazının müşterisi ile sipariş müşterisi aynı olmalı
- **Kontrol Endpoint**: `POST /api2/takas_kontrol` kullanılmalı

### 6.3. Fiyat Hesaplama Mantığı

**Vadeli Satış Hesaplama:**
```
Senet = ((Satış Fiyatı - Peşinat) × (Vade Farkı / 12) × Vade Sayısı) + (Satış Fiyatı - Peşinat)
Aylık Taksit = Senet / Vade Sayısı
Toplam Dip Fiyat = Senet + Peşinat
Yuvarlanmış Fiyat = Floor((Toplam Dip Fiyat) / 5000) × 5000
Satıcı Limit Fiyatı = Yuvarlanmış Fiyat - Satış Pazarlık Payı
```

**Peşin Satış:**
```
Toplam = Kapora + Peşinat + Takas Bedeli
Kontrol: Toplam = Satış Fiyatı (eşit olmalı)
```

**Not**: Vadeli satış limitleri `fiyat_limit_kontrol` endpoint'inden alınır.

### 6.4. Para Birimi
- **TRY**: Türk Lirası (varsayılan)
- **USD**: Dolar
- **EUR**: Euro
- Tüm fiyatlar seçilen para birimine göre kaydedilir

### 6.5. Hediye Sistemi
- **0**: Hediye Yok
- **Diğer Değerler**: Hediye ID'si (`mobil_satis_sayfasi_bilgileri` endpoint'inden alınır)
- Her ürün için ayrı hediye seçilebilir

---

## 7. HATA DURUMLARI VE MESAJLARI

### 7.1. Validasyon Hataları
- "Sipariş kaydını oluşturumak için en az 1 adet ürün girmeniz gerekmektedir."
- "Ürün X için en az 1 başlık seçilmelidir."
- "Peşin satışlarda Kapora, Peşinat ve Takas Bedeli tutarlarının toplamı Satış fiyatına eşit olmak zorundadır."
- "Vadeli satışlarda vade sayısı 0'dan büyük olmak zorundadır."
- "Yenilenmiş Cihazlarda Fatura Tutarını Maksimum 50.000 TL Girebilirsiniz"
- "Takaslı satışlarda takas bedeli 0'dan büyük olmak zorundadır."
- "UMEX Takaslı Satışlarda TAKAS CİHAZ SERİ KOD ve TAKAS CİHAZ RENK alanları zorunludur."
- "UMEX Takaslı Satışlarda TAKAS CİHAZ SERİ KODU UG ile başlamalı ve 14 karakter olmalıdır."
- "Peşinat ve kapora fiyatlarını toplamı en az [limit] olmak zorundadır."
- "Satış fiyatı için girdiğiniz tutar geçersiz. Satış için izin verilen alt limit [limit] TL 'dir."
- "TAKAS - MÜŞTERİ İLİŞKİSİ KURULAMADI"

### 7.2. Takas Bedeli Limit Hataları
- "UMEX TAKAS BEDELİ HATALI - PEŞİN"
- "ROBOTX TAKAS BEDELİ HATALI - PEŞİN"
- "DIGER CİHAZ TAKAS BEDELİ HATALI - PEŞİN"
- "UMEX TAKAS BEDELİ HATALI - VADELİ"
- "ROBOTX TAKAS BEDELİ HATALI - VADELİ"
- "DIGER CİHAZ TAKAS BEDELİ HATALI - VADELİ"

---

## 8. ÖNEMLİ NOTLAR

1. **Başlık Seçimi**: String array olarak gönderilir, backend'de base64 encode edilir
2. **Fiyat Temizleme**: Tüm fiyatlar backend'de virgül, ₺ ve boşluk karakterlerinden temizlenir
3. **Takas Fotoğrafları**: Önce yüklenmeli, URL'ler array olarak gönderilir
4. **Sipariş Kodu**: Otomatik oluşturulur, format: "SPR" + tarih (dmY) + ID (5 haneli)
5. **Onay Süreci**: İlk 2 adım otomatik onaylanır, 3. adım (Satış Onayı) müdür onayı bekler
6. **Bildirimler**: SMS ve sistem bildirimi olarak gönderilir
7. **Limit Kontrolü**: `fiyat_limit_kontrol` endpoint'inden `fullaccess: true` ise limit kontrolü yapılmaz

---

## 9. İŞ KURALLARI ÖZETİ

1. ✅ En az 1 ürün eklenmeli
2. ✅ Her ürün için en az 1 başlık seçilmeli
3. ✅ Peşin satışta: Satış Fiyatı = Kapora + Peşinat + Takas Bedeli
4. ✅ Vadeli satışta: Vade sayısı > 0 olmalı
5. ✅ Yenilenmiş cihazlarda: Fatura tutarı ≤ 50.000 TL
6. ✅ Takas varsa: Takas bedeli > 0 olmalı
7. ✅ UMEX takas: Seri kodu "UG" ile başlamalı, 14 karakter, renk zorunlu
8. ✅ Takas müşteri kontrolü: `POST /api2/takas_kontrol` kullanılmalı
9. ✅ Fiyat limitleri: `POST /api2/fiyat_limit_kontrol` ile kontrol edilir
10. ✅ Sadece Ürün ID 1 ve 8'de takas yapılabilir

---

## 10. ÖRNEK KULLANIM AKIŞI

### Adım 1: Sayfa Bilgilerini Al
```
GET /api2/mobil_satis_sayfasi_bilgileri
→ Ürünler, renkler, başlıklar, hediyeler listesi alınır
```

### Adım 2: Ürün Ekle
```
Kullanıcı ürün seçer → Renkler yüklenir
Kullanıcı renk seçer → Başlıklar yüklenir
Kullanıcı başlıklar seçer (veya otomatik seçilir)
Fiyat bilgileri girilir
Ödeme seçeneği seçilir
Takas bilgileri girilir (varsa)
```

### Adım 3: Validasyon Kontrolü
```
POST /api2/siparis_validasyon
{
  "kullanici_id": 123,
  "urunler": [...]
}
→ Hatalar kontrol edilir
```

### Adım 4: Takas Kontrolü (UMEX takas varsa)
```
POST /api2/takas_kontrol
{
  "seri_no": "UG1234567890123",
  "telefon": "05321234567"
}
→ Müşteri eşleşmesi kontrol edilir
```

### Adım 5: Fiyat Limit Kontrolü
```
POST /api2/fiyat_limit_kontrol
{
  "kullanici_id": 123,
  "urun_id": 1,
  "vade_sayisi": 12,
  "pesinat_tutari": "20000"
}
→ Limitler kontrol edilir
```

### Adım 6: Sipariş Oluştur
```
POST /api2/satis_olustur
{
  "kullanici_id": 123,
  "merkez_id": 456,
  "urunler": [...]
}
→ Sipariş oluşturulur
```

---

### 1.6. Hediyeler Listesi
**Endpoint**: `GET /api2/hediyeler` veya `POST /api2/hediyeler`

**Response**:
```json
{
  "status": "success",
  "message": "Hediyeler başarıyla getirildi.",
  "data": [
    {
      "siparis_hediye_id": 1,
      "hediye_adi": "Hediye 1",
      "hediye_aciklama": "Açıklama",
      "hediye_aktif": 1
    }
  ],
  "toplam_hediye": 5,
  "timestamp": "2024-01-01 12:00:00"
}
```

**Açıklama**: Tüm hediyelerin listesini getirir. Sipariş oluştururken hediye seçimi için kullanılır.

---

### 1.7. Takas Fotoğraf Yükleme
**Endpoint**: `POST /api2/takas_fotograf_yukle`

**Request Body**:
```json
{
  "image": "data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEAYABgAAD...",
  "urun_index": 0
}
```

**Response**:
```json
{
  "status": "success",
  "message": "Fotoğraf başarıyla yüklendi.",
  "foto_url": "https://ugbusiness.com.tr/uploads/takas_fotograflari/takas_xxx.jpg",
  "foto_path": "uploads/takas_fotograflari/takas_xxx.jpg",
  "urun_index": 0,
  "timestamp": "2024-01-01 12:00:00"
}
```

**Açıklama**: Takas cihazının fotoğraflarını yüklemek için kullanılır. Base64 formatında görsel gönderilir, sunucuya kaydedilir ve URL döner. Bu URL'yi `takas_fotograflari` array'ine ekleyerek sipariş oluştururken gönderebilirsiniz.

**Not**: 
- Base64 formatı: `data:image/jpeg;base64,...` veya `data:image/png;base64,...`
- Maksimum dosya boyutu: 5MB (sunucu tarafında kontrol edilir)
- Desteklenen formatlar: JPG, PNG

---

## 11. API ENDPOINT ÖZETİ

| Endpoint | Method | Açıklama |
|----------|--------|----------|
| `/api2/mobil_satis_sayfasi_bilgileri` | GET | Sayfa bilgilerini getirir |
| `/api2/satis_olustur` | POST | Sipariş oluşturur |
| `/api2/siparis_validasyon` | POST | Validasyon kontrolü yapar |
| `/api2/takas_kontrol` | POST/GET | Takas müşteri kontrolü yapar |
| `/api2/fiyat_limit_kontrol` | POST/GET | Fiyat limitlerini getirir |
| `/api2/hediyeler` | GET/POST | Hediyeler listesini getirir |
| `/api2/takas_fotograf_yukle` | POST | Takas fotoğrafı yükler |
