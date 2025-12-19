# MODÜL API DURUM RAPORU

## 📊 ÖZET
Bu rapor, menüdeki modüllerin Api2'de mevcut olup olmadığını ve en hızlı eklenebilecek modülleri sıralar.

---

## ✅ HIZLI ERİŞİM MODÜLLERİ

| Modül | Api2'de Var mı? | Endpoint | Durum |
|-------|----------------|----------|-------|
| **ANASAYFA** | ✅ VAR | `yemek_listesi()` | Tam |
| **İZİN TALEBİ OLUŞTUR** | ✅ VAR | `izin_talebi_ekle()`, `izin()` | Tam |
| **ABONELİKLER** | ❌ YOK | - | **HIZLI EKLENEBİLİR** ⚡ |
| **PERSONEL** | ⚠️ KISMI | `kurumsal_iletisim()` (sadece rehber) | Eksik |
| **ŞİRKET İÇİ KURALLAR** | ❌ YOK | - | **HIZLI EKLENEBİLİR** ⚡ |
| **FABRİKA ZİMMET** | ❌ YOK | - | Orta |
| **ÜRETİM PLANLAMA** | ✅ VAR | `uretim_planlama()` | Tam |
| **YAPILACAK İŞLER** | ❌ YOK | - | **HIZLI EKLENEBİLİR** ⚡ |
| **DEPO GİRİŞ ÇIKIŞ** | ✅ VAR | `depo_talep_etme_sayfasi()`, `depo_onay()` | Tam |
| **SHOWROOM CİHAZLAR** | ✅ VAR | `showrooms()` | Tam |
| **MESAİ GENEL BAKIŞ** | ⚠️ KISMI | `kart_okutmayan_personeller()` (sadece kart okutma) | Eksik |
| **İZİN / MESAİ YÖNETİMİ** | ✅ VAR | `izin()`, `izin_talebi_ekle()` | Tam |

---

## 📦 MODÜLLER

| Modül | Api2'de Var mı? | Endpoint | Durum |
|-------|----------------|----------|-------|
| **MÜŞTERİ** | ✅ VAR | `musteriler()` | Tam |
| **STOK** | ⚠️ KISMI | `depo_talep_etme_sayfasi()`, `depo_onay()` (sadece depo) | Eksik |
| **ŞİRKET ARAÇLARI** | ❌ YOK | - | **HIZLI EKLENEBİLİR** ⚡ |
| **İL BAZLI CİHAZLAR** | ❌ YOK | - | Orta |
| **TALEP (ADMİN)** | ✅ VAR | `talepler()`, `talep_ekle()`, `talep_guncelle()`, `talep_detay()`, `talep_yonlendir()` | Tam |
| **TALEP** | ✅ VAR | Aynı endpoint'ler | Tam |
| **SİPARİŞ** | ✅ VAR | `siparisler()`, `satis_olustur()`, `siparis_report()`, `siparis_validasyon()` | Tam |
| **SMS Sonuçları** | ❌ YOK | - | Orta |
| **TRENDYOL YÖNETİM** | ❌ YOK | - | Karmaşık (Harici API) |
| **SERTİFİKA** | ❌ YOK | - | **HIZLI EKLENEBİLİR** ⚡ |
| **TEKNİK SERVİS** | ❌ YOK | - | Karmaşık |
| **ÜRETİM** | ✅ VAR | `uretim_planlama()` | Tam |
| **ENVANTER** | ❌ YOK | - | Orta |
| **RAPORLAR** | ❌ YOK | - | Karmaşık |

---

## 🔗 ENTEGRASYON

| Modül | Api2'de Var mı? | Endpoint | Durum |
|-------|----------------|----------|-------|
| **ARVENTO** | ❌ YOK | - | Karmaşık (Harici API) |
| **ÇALIŞMA PLANLAMA** | ❌ YOK | - | Orta |
| **TEKLİF FORMLARI** | ❌ YOK | - | **HIZLI EKLENEBİLİR** ⚡ |
| **KAPI** | ❌ YOK | - | Karmaşık (Donanım entegrasyonu) |
| **ÖNEMLİ GÜNLER** | ✅ VAR | `onemli_gun()` | Tam |
| **YAKLAŞAN ETKİNLİKLER** | ❌ YOK | - | **HIZLI EKLENEBİLİR** ⚡ |
| **KAMPANYALAR** | ❌ YOK | - | **HIZLI EKLENEBİLİR** ⚡ |

---

## ⚡ EN HIZLI EKLENEBİLECEK MODÜLLER (Öncelik Sırası)

### 1. **ABONELİKLER** ⭐⭐⭐
- **Neden Hızlı:** Basit CRUD işlemleri, tek tablo (`abonelikler`)
- **Controller:** `Abonelik.php`
- **Model:** `Abonelik_model`
- **Gerekli Endpoint'ler:**
  - `abonelikler()` - Liste
  - `abonelik_ekle()` - Ekleme
  - `abonelik_guncelle()` - Güncelleme
  - `abonelik_sil()` - Silme
- **Tahmini Süre:** 1-2 saat

### 2. **ŞİRKET ARAÇLARI** ⭐⭐⭐
- **Neden Hızlı:** Temel araç bilgileri, bakım/sigorta/kasko kayıtları
- **Controller:** `Arac.php`
- **Model:** `Arac_model`
- **Gerekli Endpoint'ler:**
  - `araclar()` - Liste
  - `arac_detay()` - Detay (bakım, sigorta, kasko, km, muayene)
  - `arac_km_ekle()` - KM kaydı ekleme
- **Tahmini Süre:** 2-3 saat

### 3. **YAPILACAK İŞLER** ⭐⭐⭐
- **Neden Hızlı:** Basit görev yönetimi, tek tablo (`ugajans_yapilacak_isler`)
- **Controller:** `Ugajans_anasayfa.php` (yapilacak_is_* fonksiyonları)
- **Gerekli Endpoint'ler:**
  - `yapilacak_isler()` - Liste
  - `yapilacak_is_ekle()` - Ekleme
  - `yapilacak_is_guncelle()` - Güncelleme (durum değiştirme)
  - `yapilacak_is_sil()` - Silme
- **Tahmini Süre:** 1-2 saat

### 4. **SERTİFİKA** ⭐⭐
- **Neden Hızlı:** Basit sertifika listesi ve yönetimi
- **Controller:** Yok (yeni oluşturulmalı veya başka controller'da)
- **Gerekli Endpoint'ler:**
  - `sertifikalar()` - Liste
  - `sertifika_ekle()` - Ekleme
  - `sertifika_guncelle()` - Güncelleme
- **Tahmini Süre:** 1-2 saat

### 5. **ŞİRKET İÇİ KURALLAR** ⭐⭐
- **Neden Hızlı:** Basit doküman/kural listesi
- **Controller:** Muhtemelen `Dokuman.php` veya benzeri
- **Gerekli Endpoint'ler:**
  - `kurallar()` - Liste
  - `kural_detay()` - Detay
- **Tahmini Süre:** 1 saat

### 6. **TEKLİF FORMLARI** ⭐⭐
- **Neden Hızlı:** Basit form listesi ve görüntüleme
- **Controller:** `Teklif_form.php`
- **Gerekli Endpoint'ler:**
  - `teklif_formlari()` - Liste
  - `teklif_form_detay()` - Detay
  - `teklif_form_ekle()` - Ekleme (opsiyonel)
- **Tahmini Süre:** 1-2 saat

### 7. **YAKLAŞAN ETKİNLİKLER** ⭐⭐
- **Neden Hızlı:** Basit etkinlik listesi, tarih bazlı filtreleme
- **Controller:** Muhtemelen `Onemli_gun.php` veya benzeri
- **Gerekli Endpoint'ler:**
  - `etkinlikler()` - Liste (tarih filtresi ile)
- **Tahmini Süre:** 1 saat

### 8. **KAMPANYALAR** ⭐⭐
- **Neden Hızlı:** Basit kampanya listesi
- **Controller:** Muhtemelen `Banner.php` veya benzeri
- **Gerekli Endpoint'ler:**
  - `kampanyalar()` - Liste
  - `kampanya_detay()` - Detay
- **Tahmini Süre:** 1 saat

---

## ⚠️ ORTA ZORLUKTA MODÜLLER

### 9. **STOK (Tam)** 
- **Mevcut:** Sadece depo talep/onay var
- **Eksik:** Stok giriş/çıkış, stok tanımları, ürün gönderimleri
- **Tahmini Süre:** 4-6 saat

### 10. **İL BAZLI CİHAZLAR**
- **Karmaşıklık:** Cihaz listesi + il bazlı filtreleme + harita entegrasyonu
- **Tahmini Süre:** 3-4 saat

### 11. **ENVANTER**
- **Karmaşıklık:** Envanter kayıtları, demirbaş yönetimi
- **Tahmini Süre:** 4-5 saat

### 12. **ÇALIŞMA PLANLAMA**
- **Karmaşıklık:** İş planlaması, takvim entegrasyonu
- **Tahmini Süre:** 5-6 saat

### 13. **SMS Sonuçları**
- **Karmaşıklık:** SMS logları, sonuç takibi
- **Tahmini Süre:** 2-3 saat

---

## 🔴 KARMAŞIK MODÜLLER (Uzun Süre Gerektirir)

### 14. **TEKNİK SERVİS**
- **Karmaşıklık:** Servis kayıtları, cihaz eşleştirme, müşteri ilişkilendirme
- **Controller:** `Servis.php` (çok karmaşık)
- **Tahmini Süre:** 8-10 saat

### 15. **TRENDYOL YÖNETİM**
- **Karmaşıklık:** Harici API entegrasyonu, sipariş senkronizasyonu
- **Controller:** `Trendyol.php`
- **Tahmini Süre:** 6-8 saat

### 16. **ARVENTO**
- **Karmaşıklık:** Harici API entegrasyonu
- **Tahmini Süre:** 6-8 saat

### 17. **KAPI**
- **Karmaşıklık:** Donanım entegrasyonu, kart okutma sistemi
- **Tahmini Süre:** 8-10 saat

### 18. **RAPORLAR**
- **Karmaşıklık:** Çoklu rapor türleri, grafik/istatistik hesaplamaları
- **Tahmini Süre:** 10+ saat

---

## 📈 İSTATİSTİKLER

- **Toplam Modül Sayısı:** 35
- **Api2'de Mevcut:** 12 (34%)
- **Eksik:** 23 (66%)
- **Hızlı Eklenebilir (1-3 saat):** 8 modül
- **Orta Zorluk (3-6 saat):** 5 modül
- **Karmaşık (6+ saat):** 5 modül

---

## 🎯 ÖNERİLER

1. **Öncelik 1:** Hızlı eklenebilir 8 modülü tamamlayın (toplam ~12-15 saat)
2. **Öncelik 2:** Orta zorlukta modülleri planlayın
3. **Öncelik 3:** Karmaşık modüller için ayrı sprint planı yapın

---

## 📝 NOTLAR

- **PERSONEL:** Sadece `kurumsal_iletisim` var, tam personel yönetimi yok
- **MESAİ:** Sadece `kart_okutmayan_personeller` var, tam mesai yönetimi yok
- **STOK:** Sadece depo talep/onay var, tam stok yönetimi yok
- **SERTİFİKA:** Controller bulunamadı, yeni oluşturulmalı olabilir

---

*Rapor Tarihi: 2025-12-18*
*Api2.php Toplam Endpoint Sayısı: 38*

