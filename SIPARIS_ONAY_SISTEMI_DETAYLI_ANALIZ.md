# Sipariş Onay Sistemi - Detaylı Sistem Analizi ve Dokümantasyon

**Versiyon:** 1.0  
**Tarih:** 2025-01-XX  
**Hazırlayan:** Sistem Analizi

---

## İçindekiler

1. [Genel Bakış](#genel-bakış)
2. [Sistem Mimarisi](#sistem-mimarisi)
3. [Adım Yapısı ve Yaşam Döngüsü](#adım-yapısı-ve-yaşam-döngüsü)
4. ["2. Onay" Mekanizması - Kritik Analiz](#2-onay-mekanizması---kritik-analiz)
5. [siparis_ust_satis_onayi Alanı - Yaşam Döngüsü](#siparis_ust_satis_onayi-alanı---yaşam-döngüsü)
6. [Veri Akışı ve Bağımlılıklar](#veri-akışı-ve-bağımlılıklar)
7. [Özel Durumlar ve İstisnalar](#özel-durumlar-ve-istisnalar)
8. [Mantık Hataları ve Uyarılar](#mantık-hataları-ve-uyarılar)
9. [Teknik Detaylar](#teknik-detaylar)

---

## Genel Bakış

Sipariş Onay Sistemi, 12 aşamalı bir onay süreci kullanarak siparişlerin oluşturulmasından teslim edilmesine kadar tüm süreçleri yönetir. Sistem, CodeIgniter MVC mimarisi üzerine kurulmuştur ve karmaşık yetkilendirme mantığı içerir.

### Temel Bileşenler

- **Controller:** `application/controllers/Siparis.php`
- **Model:** `application/models/Siparis_model.php`
- **Helper:** `application/helpers/siparis_view_helper.php`
- **View:** `application/views/siparis/includes/onay_bekleyen_table_row.php`

---

## Sistem Mimarisi

### Katman Yapısı

```
┌─────────────────────────────────────┐
│         VIEW LAYER                  │
│  - onay_bekleyen_table_row.php      │
│  - list/main_content.php             │
│  - report.php                        │
└──────────────┬──────────────────────┘
               │
┌──────────────▼──────────────────────┐
│      HELPER LAYER                    │
│  - siparis_view_helper.php           │
│  - site_helper.php                   │
└──────────────┬──────────────────────┘
               │
┌──────────────▼──────────────────────┐
│      CONTROLLER LAYER                │
│  - Siparis.php                      │
└──────────────┬──────────────────────┘
               │
┌──────────────▼──────────────────────┐
│        MODEL LAYER                   │
│  - Siparis_model.php                │
│  - Siparis_onay_hareket_model.php   │
└──────────────┬──────────────────────┘
               │
┌──────────────▼──────────────────────┐
│      DATABASE LAYER                 │
│  - siparisler                       │
│  - siparis_onay_hareketleri         │
│  - siparis_onay_adimlari            │
│  - kullanici_yetki_tanimlari       │
└─────────────────────────────────────┘
```

---

## Adım Yapısı ve Yaşam Döngüsü

### Adım Numaralandırma Sistemi

Sistem **iki farklı adım numaralandırma** kullanır:

1. **`adim_no`** (siparis_onay_hareketleri tablosunda): 0-11 arası (12 adım)
2. **`adim_id`** (siparis_onay_adimlari tablosunda): 1-12 arası
3. **`adim_sira_numarasi`** (siparis_onay_adimlari tablosunda): Görüntüleme için kullanılan sıra numarası

**ÖNEMLİ İLİŞKİ:**
- `adim_no = 0` → Adım 1 (Görüşme Kaydı)
- `adim_no = 1` → Adım 2 (Sipariş Kaydı)
- `adim_no = 2` → Adım 3 (Satış Onayı)
- `adim_no = 3` → Adım 4 (Üretim Onayı)
- ...
- `adim_no = 11` → Adım 12 (Eğitim Onayı)

**Formül:** `adim_id = adim_no + 1`

### 12 Adım Detaylı Analizi

#### Adım 1: Görüşme Kaydı (adim_no = 0)
- **Yetki Kodu:** `siparis_onay_2`
- **Otomatik Oluşturulur:** Evet (sipariş oluşturulduğunda)
- **Özel Durumlar:** Yok
- **Bağımlılıklar:** Yok

#### Adım 2: Sipariş Kaydı (adim_no = 1)
- **Yetki Kodu:** `siparis_onay_3`
- **Otomatik Oluşturulur:** Evet (sipariş oluşturulduğunda)
- **Özel Durumlar:** Yok
- **Bağımlılıklar:** Adım 1 tamamlanmış olmalı

#### Adım 3: Satış Onayı (adim_no = 2) ⚠️ KRİTİK ADIM
- **Yetki Kodu:** `siparis_onay_4`
- **Otomatik Oluşturulur:** Hayır
- **Özel Durumlar:**
  - Sadece siparişi oluşturan kullanıcı veya yöneticisi onaylayabilir
  - Kullanıcı ID 1 (Sistem Yöneticisi) her zaman onaylayabilir
  - Yönetici kontrolü: `kullanici_yonetici_kullanici_id` kontrolü yapılır
- **Bağımlılıklar:** Adım 2 tamamlanmış olmalı
- **Önemli:** Bu adımda `siparis_ust_satis_onayi` alanı **HENÜZ SET EDİLMEMİŞTİR** (default: 0 veya NULL)

**Kod:**
```php
if($guncel_adim == 3){
    if($currentuser->kullanici_id != 1 && 
       $currentuser->kullanici_id != $siparis[0]->siparisi_olusturan_kullanici){
        $kullanici_data_siparis = $this->Kullanici_model->get_by_id($siparis[0]->siparisi_olusturan_kullanici); 
        if($kullanici_data_siparis[0]->kullanici_yonetici_kullanici_id != $currentuser->kullanici_id){
            // Yetki yok
        }
    }
}
```

#### Adım 4: Üretim Onayı (adim_no = 3) ⚠️ KRİTİK ADIM
- **Yetki Kodu:** `siparis_onay_5`
- **Otomatik Oluşturulur:** Hayır
- **Özel Durumlar:**
  - **Üst Satış Onayı Gereksinimi:** Bazı siparişler için `siparis_ust_satis_onayi = 1` olmalı
  - Merkez adresi kontrolü zorunlu
  - Ürün bilgileri güncelleme (damla etiket, açılış ekranı, yurtdışı kontrolü)
  - Müşteri talep teslim tarihi belirlenir
  - Eğitim var mı kontrolü yapılır
- **Bağımlılıklar:** 
  - Adım 3 tamamlanmış olmalı
  - Bazı durumlarda üst satış onayı verilmiş olmalı (`siparis_ust_satis_onayi = 1`)
- **Kullanıcı Bazlı Görünürlük:**
  - Kullanıcı ID 9: Adım 4'teki siparişleri göremez (helper'da filtrelenir)
  - Kullanıcı ID 7, 1: Üst satış onayı verilmişse adım 4'teki siparişleri göremez

**Kod:**
```php
if($guncel_adim == 4){
    if($siparis[0]->merkez_adresi == "" || $siparis[0]->merkez_adresi == null){
        // Hata: Adres eksik
    }
    // Ürün bilgileri güncelleme
    foreach ($urunler as $urun) {
        // damla_etiket, acilis_ekrani, yurtdisi_mi güncelleme
    }
}
```

#### Adım 5: Üretim Planlama (adim_no = 4)
- **Yetki Kodu:** `siparis_onay_6`
- **Otomatik Oluşturulur:** Hayır
- **Özel Durumlar:** Yok
- **Bağımlılıklar:** Adım 4 tamamlanmış olmalı

#### Adım 6: Üretim Başlatma (adim_no = 5)
- **Yetki Kodu:** `siparis_onay_7`
- **Otomatik Oluşturulur:** Hayır
- **Özel Durumlar:** Yok
- **Bağımlılıklar:** Adım 5 tamamlanmış olmalı

#### Adım 7: Üretim Tamamlandı (adim_no = 6)
- **Yetki Kodu:** `siparis_onay_8`
- **Otomatik Oluşturulur:** Hayır
- **Özel Durumlar:**
  - Seri numarası kaydı zorunlu
  - Üretim tarihi belirlenir
  - Cihaz havuzu güncellenir (`cihaz_havuz_durum = 0`)
  - **Türkiye Dışı Siparişler:** `ulke_id != 190` ise adım 8 otomatik atlanır
- **Bağımlılıklar:** Adım 6 tamamlanmış olmalı

**Kod:**
```php
if($guncel_adim == 7){
    foreach ($urunler as $urun) {
        // Seri numarası ve üretim tarihi kaydı
        // Cihaz havuzu güncelleme
    }
}

// Otomatik adım 8 atlama (Türkiye dışı)
if($guncel_adim == 7 && $siparis->ulke_id == 190){
    // Adım 8 otomatik onaylanır
}
```

#### Adım 8: Başlık Kontrolü (adim_no = 7)
- **Yetki Kodu:** `siparis_onay_9`
- **Otomatik Oluşturulur:** 
  - Hayır (normal durum)
  - Evet (Türkiye dışı siparişler için adım 7'den sonra)
- **Özel Durumlar:**
  - Başlık havuzunda kayıt kontrolü yapılır
  - Başlık kayıtları oluşturulur
  - Garanti tarihleri belirlenir (2 yıl)
  - Bazı ürün tipleri için başlık kontrolü atlanır (urun_id: 3, 4, 5, 7)
- **Bağımlılıklar:** Adım 7 tamamlanmış olmalı

**Kod:**
```php
if($guncel_adim == 8){
    $baslik_kontrol = true;
    foreach ($urunler as $urun) {
        foreach (json_decode($urun->basliklar) as $baslik) {
            if($urun->urun_id != 3 && $urun->urun_id != 4 && 
               $urun->urun_id != 5 && $urun->urun_id != 7){
                // Başlık havuzunda kontrol
            }
        }
    }
    // Başlık kayıtları oluşturma
}
```

#### Adım 9: Kurulum Planlama (adim_no = 8)
- **Yetki Kodu:** `siparis_onay_10`
- **Otomatik Oluşturulur:** Hayır
- **Özel Durumlar:**
  - Kurulum tarihi belirlenir
  - Kurulum aracı plakası kaydedilir
  - Kurulum ekibi belirlenir (JSON formatında)
- **Bağımlılıklar:** Adım 8 tamamlanmış olmalı

#### Adım 10: Eğitim Planlama (adim_no = 9)
- **Yetki Kodu:** `siparis_onay_11`
- **Otomatik Oluşturulur:** Hayır
- **Özel Durumlar:**
  - Eğitim var mı kontrolü (`egitim_var_mi`)
  - Eğitim tarihi belirlenir
  - Eğitim ekibi belirlenir (JSON formatında)
- **Bağımlılıklar:** Adım 9 tamamlanmış olmalı

#### Adım 11: Kurulum Onayı (adim_no = 10) ⚠️ ÖZEL KONTROLLER
- **Yetki Kodu:** `siparis_onay_12`
- **Otomatik Oluşturulur:** 
  - Hayır (normal durum)
  - Evet (eğitim yoksa, adım 11'den sonra adım 12 otomatik onaylanır)
- **Özel Durumlar:**
  - **TCKN Zorunluluğu:** Müşteri TCKN bilgisi olmalı
  - **TCKN Doğrulama:** `tckn_dogrula()` fonksiyonu ile kontrol edilir
  - **Sosyal Medya Zorunluluğu:** Instagram veya Facebook URL'i olmalı
  - **Cinsiyet Bilgisi:** Müşteri cinsiyet bilgisi "B" (Boş) olamaz
  - **Eğitim Ekibi Kontrolü:** SMS sadece eğitim ekibindeki kullanıcılara gönderilir
  - Garanti tarihleri belirlenir (2 yıl)
- **Bağımlılıklar:** Adım 10 tamamlanmış olmalı

**Kod:**
```php
if($guncel_adim == 11){
    if($siparis[0]->musteri_tckn == "" || $siparis[0]->musteri_tckn == null){
        // Hata: TCKN zorunlu
    }
    if(!tckn_dogrula($siparis[0]->musteri_tckn)){
        // Hata: TCKN geçersiz
    }
    if($siparis[0]->instagram_url == "" && $siparis[0]->facebook_url == ""){
        // Hata: Sosyal medya zorunlu
    }
    if($siparis[0]->musteri_cinsiyet == "B"){
        // Hata: Cinsiyet bilgisi zorunlu
    }
}

// Otomatik adım 12 onayı (eğitim yoksa)
if($siparis[0]->egitim_var_mi == 0 && $guncel_adim == 11){
    // Adım 12 otomatik onaylanır
}
```

#### Adım 12: Eğitim Onayı (adim_no = 11)
- **Yetki Kodu:** Yok (özel kontrol)
- **Otomatik Oluşturulur:** 
  - Hayır (normal durum)
  - Evet (eğitim yoksa, adım 11'den sonra)
- **Özel Durumlar:**
  - **Sadece Eğitime Giden Kişi:** `egitim_ekip[0]` kullanıcısı onaylayabilir
  - Kullanıcı ID 1 (Sistem Yöneticisi) her zaman onaylayabilir
  - Kursiyer bilgileri kaydedilir
  - Değerlendirme SMS'i gönderilir
- **Bağımlılıklar:** Adım 11 tamamlanmış olmalı

**Kod:**
```php
if($guncel_adim == 12){
    $aktifk = aktif_kullanici()->kullanici_id;
    if($aktifk != 1){
        if(json_decode($siparis[0]->egitim_ekip)[0] != $aktifk){
            // Hata: Sadece eğitime giden kişi onaylayabilir
        }
    }
    // Kursiyer bilgileri kaydı
    // Değerlendirme SMS gönderimi
}
```

---

## "2. Onay" Mekanizması - Kritik Analiz

### Tanım

"2. Onay" mekanizması, **Adım 3 (Satış Onayı)** tamamlandıktan sonra, bazı siparişler için **ek bir üst satış onayı** gerektiren özel bir süreçtir.

### Gösterim Mantığı

**View Dosyası (onay_bekleyen_table_row.php):**
```php
// İkinci onay kontrolü - Eğer adım 3'te ve siparis_ust_satis_onayi = 0 ise, ikinci onay bekleniyor
$ikinci_onay_bekleniyor = false;
$ikinci_onay_kullanici_id = null;
if(isset($siparis->adim_no) && $siparis->adim_no == 3 && 
   isset($siparis->siparis_ust_satis_onayi) && 
   $siparis->siparis_ust_satis_onayi == 0) {
    $ikinci_onay_bekleniyor = true;
    // siparis_ikinci_onay yetkisine sahip kullanıcıları bul
    $ikinci_onay_kullanicilar = $this->db
        ->select('kullanici_id')
        ->from('kullanici_yetki_tanimlari')
        ->where('yetki_kodu', 'siparis_ikinci_onay')
        ->get()
        ->result();
    
    if(!empty($ikinci_onay_kullanicilar)) {
        $ikinci_onay_kullanici_id = $ikinci_onay_kullanicilar[0]->kullanici_id;
    }
}
```

**Gösterim:**
```php
<?php if($ikinci_onay_bekleniyor && $ikinci_onay_kullanici_id !== null): ?>
    <small style="font-size: 8px; color: #dc3545; font-weight: bold; display: block; margin-top: 2px;">
        <i class="fas fa-user-check"></i> 2. Onay: ID <?= $ikinci_onay_kullanici_id ?>
    </small>
<?php endif; ?>
```

### Koşullar

"2. Onay: ID X" yazısının gösterilmesi için **TÜM** şu koşullar sağlanmalıdır:

1. ✅ `$siparis->adim_no == 3` (Sipariş adım 3'te olmalı)
2. ✅ `$siparis->siparis_ust_satis_onayi == 0` (Üst satış onayı verilmemiş olmalı)
3. ✅ `isset($siparis->siparis_ust_satis_onayi)` (Alan set edilmiş olmalı)
4. ✅ `siparis_ikinci_onay` yetkisine sahip en az bir kullanıcı bulunmalı

### Model'de Filtreleme

**Siparis_model.php - get_all_waiting():**
```php
// siparis_ikinci_onay yetkisi varsa adım 3'ü de dahil et
if($has_ikinci_onay && count($where_in) > 0) {
    $this->db->group_start();
    $this->db->where_in('adim_no', $where_in);
    // Adım 3'teki ve 2. satış onayı bekleyen siparişler
    $this->db->or_group_start()
        ->where('adim_no', 3)
        ->where('siparis_ust_satis_onayi', 0)
        ->group_end();
    $this->db->group_end();
}
```

**Mantık:**
- `has_ikinci_onay = true` ise, adım 3'teki ve `siparis_ust_satis_onayi = 0` olan siparişler de getirilir
- Bu sayede `siparis_ikinci_onay` yetkisine sahip kullanıcılar, normal yetkileri olmasa bile bu siparişleri görebilir

### Üst Satış Onayı Verme

**Controller - ust_satis_onayini_ver():**
```php
public function ust_satis_onayini_ver($siparis_id)
{   
    yetki_kontrol("siparis_ikinci_onay");
    $siparis = $this->Siparis_model->get_by_id($siparis_id); 
    
    if($siparis != null){
        $data['siparis_ust_satis_onayi'] = 1;
        $data['siparis_ust_satis_onay_tarihi'] = date("Y-m-d H:i");
        $this->db->where('siparis_id', $siparis_id);
        $this->db->update('siparisler', $data);
        redirect(base_url("onay-bekleyen-siparisler"));
    }
}
```

**Mantık:**
- `siparis_ikinci_onay` yetkisine sahip kullanıcılar bu fonksiyonu çağırabilir
- `siparis_ust_satis_onayi` alanı `1` yapılır
- `siparis_ust_satis_onay_tarihi` kaydedilir
- Sipariş artık adım 4'e geçebilir

### ⚠️ KRİTİK SORUN: Adım 4'te "2. Onay" Yazısı Görünmesi

**Problem:**
- View dosyasında sadece `adim_no == 3` kontrolü var
- Ancak kullanıcı adım 4'teki bazı siparişlerde "2. Onay" yazısı görüyor

**Olası Nedenler:**

1. **Veri Tutarsızlığı:**
   - Sipariş adım 3'te iken `siparis_ust_satis_onayi = 0` kalmış
   - Adım 3 onaylanmış ve adım 4'e geçilmiş
   - Ancak `siparis_ust_satis_onayi` hala `0` (güncellenmemiş)
   - Model'de adım 3'teki siparişler getirilirken, bazı siparişler adım 4'e geçmiş olabilir

2. **Model Filtreleme Mantığı:**
   ```php
   // Model'de adım 3'teki ve siparis_ust_satis_onayi = 0 olan siparişler getiriliyor
   $this->db->or_group_start()
       ->where('adim_no', 3)
       ->where('siparis_ust_satis_onayi', 0)
       ->group_end();
   ```
   - Bu sorgu adım 3'teki siparişleri getirir
   - Ancak sipariş adım 4'e geçmişse, `adim_no` değişir
   - Eğer `siparis_ust_satis_onayi` hala `0` ise, view dosyasında kontrol yapılmaz (çünkü `adim_no == 3` değil)

3. **View Dosyası Kontrolü:**
   ```php
   if(isset($siparis->adim_no) && $siparis->adim_no == 3 && ...)
   ```
   - Bu kontrol sadece adım 3 için yapılıyor
   - Adım 4'te görünmemeli

**Çözüm Önerileri:**

1. **Veri Tutarlılığı Kontrolü:**
   - Adım 4'e geçildiğinde `siparis_ust_satis_onayi` kontrolü yapılmalı
   - Eğer `siparis_ust_satis_onayi = 0` ise, otomatik olarak `1` yapılmalı veya uyarı verilmeli

2. **View Dosyası Güncelleme:**
   - Adım 4'te de kontrol yapılabilir (ancak bu mantıksal olarak yanlış olabilir)
   - Veya sadece adım 3'te gösterilmeli (mevcut durum)

3. **Model Filtreleme Güncelleme:**
   - Model'de sadece gerçekten adım 3'teki siparişler getirilmeli
   - Adım 4'e geçmiş siparişler filtrelenmeli

---

## siparis_ust_satis_onayi Alanı - Yaşam Döngüsü

### Alan Tanımı

- **Tablo:** `siparisler`
- **Alan Adı:** `siparis_ust_satis_onayi`
- **Tip:** TINYINT veya INT (muhtemelen)
- **Değerler:**
  - `0` veya `NULL`: Üst satış onayı verilmemiş
  - `1`: Üst satış onayı verilmiş

### Yaşam Döngüsü

#### 1. Sipariş Oluşturulduğunda
- **Durum:** `NULL` veya `0` (default değer)
- **Kod:** Sipariş oluşturulurken bu alan set edilmez

#### 2. Adım 3 Onaylandığında
- **Durum:** `0` kalır (değişmez)
- **Kod:** `siparis_onayla()` fonksiyonunda adım 3 için özel bir güncelleme yok
- **Not:** Adım 3 onaylandıktan sonra, bazı siparişler için "2. Onay" mekanizması devreye girer

#### 3. "2. Onay" Verildiğinde
- **Durum:** `0` → `1`
- **Fonksiyon:** `ust_satis_onayini_ver($siparis_id)`
- **Kod:**
  ```php
  $data['siparis_ust_satis_onayi'] = 1;
  $data['siparis_ust_satis_onay_tarihi'] = date("Y-m-d H:i");
  $this->db->where('siparis_id', $siparis_id);
  $this->db->update('siparisler', $data);
  ```
- **Yetki:** `siparis_ikinci_onay` yetkisi gerekir

#### 4. Adım 4 Onaylandığında
- **Durum:** `1` kalır (değişmez)
- **Kod:** Adım 4 onaylandığında bu alan güncellenmez
- **Not:** Adım 4'e geçebilmek için `siparis_ust_satis_onayi = 1` olması gerekmez (bazı siparişler için)

### ⚠️ KRİTİK SORUN: Adım 4'te siparis_ust_satis_onayi = 0 Olması

**Problem Senaryosu:**
1. Sipariş adım 3'te, `siparis_ust_satis_onayi = 0`
2. "2. Onay" verilmeden adım 3 onaylanır
3. Sipariş adım 4'e geçer
4. `siparis_ust_satis_onayi` hala `0` kalır
5. View dosyasında adım 4'te "2. Onay" yazısı görünmez (çünkü `adim_no == 3` kontrolü var)
6. Ancak kullanıcı adım 4'te "2. Onay" yazısı görüyor

**Olası Açıklamalar:**

1. **Veri Tutarsızlığı:**
   - Bazı siparişlerde `siparis_ust_satis_onayi` alanı hiç set edilmemiş (NULL)
   - View dosyasında `isset()` kontrolü var, ancak NULL değer için farklı davranış olabilir

2. **Model'de Yanlış Filtreleme:**
   - Model'de adım 3'teki siparişler getirilirken, bazı siparişler adım 4'e geçmiş olabilir
   - JOIN işlemleri sırasında `adim_no` değeri yanlış hesaplanmış olabilir

3. **get_son_adim() Fonksiyonu:**
   ```php
   function get_son_adim($siparis_id) {
       // Son onay hareketini bul
       SELECT * FROM siparis_onay_hareketleri 
       WHERE siparis_no = $siparis_id 
       ORDER BY onay_tarih DESC 
       LIMIT 1
       
       // Bir sonraki adımı hesapla
       $guncel_adim = $result->adim_no + 1;
       
       // Bir sonraki adım bilgilerini getir
       SELECT * FROM siparis_onay_adimlari 
       WHERE adim_id = $guncel_adim
   }
   ```
   - Bu fonksiyon `adim_id` döndürür
   - View dosyasında `$siparis->adim_no` kullanılıyor
   - Bu iki değer farklı kaynaklardan geliyor olabilir

---

## Veri Akışı ve Bağımlılıklar

### Onay Bekleyen Siparişler Sayfası - Veri Akışı

```
1. Kullanıcı → /onay-bekleyen-siparisler?filter=2
   ↓
2. Controller::onay_bekleyenler()
   ↓
3. _render_onay_bekleyenler('siparis/list')
   ├─ Kullanıcı ID al
   ├─ Filter kontrolü (filter=3 → tüm siparişler)
   ├─ Kullanıcı yetkilerini al (_get_kullanici_yetkili_adimlar)
   ├─ İkinci onay yetkisi kontrolü
   ├─ Filtre adımlarını belirle (_get_filter_adimlari)
   └─ Model::get_all_waiting($filter, $kullanici_id, $has_ikinci_onay)
      ↓
4. Model::get_all_waiting()
   ├─ Adım filtrelemesi (where_in('adim_no', $where_in))
   ├─ İkinci onay kontrolü (adım 3, siparis_ust_satis_onayi = 0)
   ├─ Kullanıcı yetki kontrolü (EXISTS subquery)
   ├─ JOIN işlemleri
   │  ├─ merkezler
   │  ├─ musteriler
   │  ├─ sehirler
   │  ├─ ilceler
   │  ├─ kullanicilar
   │  ├─ siparis_onay_hareketleri (ROW_NUMBER ile son hareket)
   │  └─ siparis_onay_adimlari
   └─ Sonuç döndür
      ↓
5. View: list/main_content.php
   ├─ Her sipariş için:
   │  ├─ get_son_adim($siparis_id) çağrılır
   │  ├─ should_show_siparis_row() kontrolü
   │  └─ onay_bekleyen_table_row.php render edilir
   │     ├─ İkinci onay kontrolü (adım 3, siparis_ust_satis_onayi = 0)
   │     ├─ "2. Onay: ID X" yazısı gösterilir (koşullar sağlanırsa)
   │     └─ Tablo satırı render edilir
   └─ Tablo gösterilir
```

### Adım İlerleme Akışı

```
Sipariş Oluşturuldu
   ↓
Adım 1 (Otomatik) → Adım 2 (Otomatik)
   ↓
Adım 3 (Satış Onayı) - Manuel Onay
   ├─ siparis_ust_satis_onayi = 0 (default)
   ├─ "2. Onay" mekanizması devreye girer (bazı siparişler için)
   └─ siparis_ikinci_onay yetkisine sahip kullanıcılar görebilir
      ↓
   [2. Onay Verildi mi?]
   ├─ EVET → siparis_ust_satis_onayi = 1
   └─ HAYIR → siparis_ust_satis_onayi = 0 (kalır)
      ↓
Adım 4 (Üretim Onayı) - Manuel Onay
   ├─ siparis_ust_satis_onayi = 1 ise → Normal akış
   └─ siparis_ust_satis_onayi = 0 ise → ⚠️ TUTARSIZLIK
      ↓
Adım 5-12 (Normal Akış)
```

### Bağımlılık Grafiği

```
Adım 1 ──→ Adım 2 ──→ Adım 3 ──→ Adım 4 ──→ Adım 5 ──→ ... ──→ Adım 12
           (Otomatik) (Otomatik) (Manuel)  (Manuel)  (Manuel)        (Manuel)
                              │
                              │
                    [2. Onay Mekanizması]
                              │
                              ├─→ siparis_ust_satis_onayi = 0
                              │   └─→ "2. Onay: ID X" gösterilir
                              │
                              └─→ siparis_ust_satis_onayi = 1
                                  └─→ Normal akış devam eder
```

---

## Özel Durumlar ve İstisnalar

### 1. Kullanıcı Bazlı Özel Kurallar

#### Kullanıcı ID 2
- **Kural:** Sadece kendi oluşturduğu veya belirli kullanıcıların (2, 5, 18, 94) siparişlerini görür
- **Kod:**
  ```php
  2 => function($siparis) {
      return in_array($siparis->siparisi_olusturan_kullanici, [2, 5, 18, 94]);
  }
  ```

#### Kullanıcı ID 9 (Genel Müdür)
- **Kural:** 
  - Adım 3'teki siparişleri görebilir (3.1 adımını görmek için)
  - Adım 4'teki siparişleri göremez (helper'da filtrelenir)
- **Kod:**
  ```php
  9 => function($siparis, $data) {
      if ($data && isset($data[0])) {
          $adim_id = isset($data[0]->adim_id) ? (int)$data[0]->adim_id : null;
          $adim_sira = isset($data[0]->adim_sira_numarasi) ? (int)$data[0]->adim_sira_numarasi : null;
          // Adım 4'teki siparişleri gizle
          if ($adim_id === 4 || $adim_sira === 4) {
              return false;
          }
      }
      return true;
  }
  ```

#### Kullanıcı ID 37 ve 8
- **Kural:** 
  - Üst satış onayı verilmemişse (`siparis_ust_satis_onayi = 0`) siparişleri göremez
  - Adım 4'te ve üst satış onayı bekleniyorsa, onay butonu disabled olur
- **Kod:**
  ```php
  if ($siparis->siparis_ust_satis_onayi == 1) {
      if (in_array($i_kul, [7, 1]) && $next_adim_id == 4) {
          return false; // Gizle
      }
  } else {
      if (in_array($i_kul, [37, 8])) {
          return false; // Gizle
      }
  }
  ```

#### Kullanıcı ID 7 ve 1
- **Kural:** Üst satış onayı verilmişse (`siparis_ust_satis_onayi = 1`), adım 4'teki siparişleri göremez
- **Kod:**
  ```php
  if ($siparis->siparis_ust_satis_onayi == 1) {
      if (in_array($i_kul, [7, 1]) && $next_adim_id == 4) {
          return false; // Gizle
      }
  }
  ```

### 2. Otomatik Onaylar

#### Eğitim Yoksa
- **Koşul:** `egitim_var_mi = 0`
- **Etki:** Adım 11 onaylandığında, adım 12 otomatik onaylanır
- **Kod:**
  ```php
  if($siparis[0]->egitim_var_mi == 0 && $guncel_adim == 11){
      $siparis_onay_hareket["adim_no"] = 12;
      $siparis_onay_hareket["onay_aciklama"] = "Eğitim olmadığı için sistem tarafından otomatik onaylanmıştır.";
      $this->Siparis_onay_hareket_model->insert($siparis_onay_hareket);
  }
  ```

#### Türkiye Dışı Siparişler
- **Koşul:** `ulke_id != 190` (Türkiye = 190)
- **Etki:** Adım 7 onaylandığında, adım 8 otomatik atlanır ve adım 9'a geçilir
- **Kod:**
  ```php
  if($guncel_adim == 7 && $siparis->ulke_id == 190){
      $siparis_onay_hareket["adim_no"] = 8;
      $siparis_onay_hareket["onay_aciklama"] = "Sistem tarafından otomatik onaylanmıştır.";
      $this->Siparis_onay_hareket_model->insert($siparis_onay_hareket);
  }
  ```

### 3. Yetki Sistemi İstisnaları

#### siparis_ikinci_onay Yetkisi
- **Özel Durum:** Normal adım yetkilerinden bağımsız çalışır
- **Etki:** Adım 3'teki ve `siparis_ust_satis_onayi = 0` olan siparişleri görebilir
- **Model'de:**
  ```php
  if($has_ikinci_onay) {
      $this->db->or_group_start()
          ->where('adim_no', 3)
          ->where('siparis_ust_satis_onayi', 0)
          ->group_end();
  }
  ```

#### Kullanıcı ID 9 - siparis_ikinci_onay
- **Özel Durum:** Model'de kullanıcı ID 9 için `has_ikinci_onay` otomatik `true` yapılıyor
- **Kod:**
  ```php
  // Kullanıcı ID 9 için siparis_ikinci_onay yetkisi her zaman true
  if($kullanici_id == 9) {
      $has_ikinci_onay = true;
  }
  ```
- **⚠️ UYARI:** Bu kod mevcut versiyonda var, ancak ana_dosya yedeğinde yok. Tutarsızlık olabilir.

---

## Mantık Hataları ve Uyarılar

### ⚠️ KRİTİK UYARI 1: Adım 4'te "2. Onay" Yazısı Görünmesi

**Sorun:**
- View dosyasında sadece `adim_no == 3` kontrolü var
- Ancak kullanıcı adım 4'teki bazı siparişlerde "2. Onay" yazısı görüyor

**Olası Nedenler:**
1. **Veri Tutarsızlığı:** `siparis_ust_satis_onayi` alanı adım 4'e geçildiğinde güncellenmemiş
2. **Model Filtreleme:** Model'de adım 3'teki siparişler getirilirken, bazı siparişler adım 4'e geçmiş
3. **JOIN İşlemleri:** `siparis_onay_hareketleri` JOIN'i sırasında `adim_no` değeri yanlış hesaplanmış

**Çözüm Önerileri:**
1. Adım 4'e geçildiğinde `siparis_ust_satis_onayi` kontrolü yapılmalı
2. View dosyasında adım 4 için de kontrol eklenebilir (ancak mantıksal olarak yanlış)
3. Model'de sadece gerçekten adım 3'teki siparişler getirilmeli

### ⚠️ KRİTİK UYARI 2: siparis_ust_satis_onayi NULL Değeri

**Sorun:**
- `siparis_ust_satis_onayi` alanı NULL olabilir
- View dosyasında `isset()` kontrolü var, ancak NULL değer için farklı davranış olabilir

**Kod:**
```php
if(isset($siparis->siparis_ust_satis_onayi) && $siparis->siparis_ust_satis_onayi == 0)
```

**Sorun:**
- `isset()` NULL değer için `false` döner
- Ancak `$siparis->siparis_ust_satis_onayi == 0` kontrolü NULL için `true` dönebilir (PHP type juggling)

**Çözüm:**
```php
if(isset($siparis->siparis_ust_satis_onayi) && 
   $siparis->siparis_ust_satis_onayi !== null && 
   $siparis->siparis_ust_satis_onayi == 0)
```

### ⚠️ UYARI 3: Model'de Kullanıcı ID 9 Özel Durumu

**Sorun:**
- Model'de kullanıcı ID 9 için `has_ikinci_onay` otomatik `true` yapılıyor
- Ancak controller'da bu kontrol yok
- Ana_dosya yedeğinde bu kod yok

**Kod:**
```php
// Kullanıcı ID 9 için siparis_ikinci_onay yetkisi her zaman true
if($kullanici_id == 9) {
    $has_ikinci_onay = true;
}
```

**Çözüm:**
- Bu kod tutarlı bir şekilde tüm katmanlarda uygulanmalı veya kaldırılmalı

### ⚠️ UYARI 4: get_son_adim() vs adim_no Farkı

**Sorun:**
- `get_son_adim()` fonksiyonu `adim_id` döndürür (1-12)
- View dosyasında `$siparis->adim_no` kullanılıyor (0-11)
- Bu iki değer farklı kaynaklardan geliyor

**Kod:**
```php
// get_son_adim() döndürür: adim_id (1-12)
$data = get_son_adim($siparis_id);
$adim_id = $data[0]->adim_id; // Örnek: 4

// Model'den gelen: adim_no (0-11)
$siparis->adim_no; // Örnek: 3
```

**İlişki:**
- `adim_id = adim_no + 1`
- View dosyasında `$siparis->adim_no + 1` gösteriliyor (doğru)
- Ancak `get_son_adim()` ile karşılaştırma yapılırken dikkat edilmeli

### ⚠️ UYARI 5: ROW_NUMBER() Window Function

**Sorun:**
- Model'de `ROW_NUMBER() OVER (PARTITION BY siparis_no ORDER BY siparis_onay_hareket_id DESC)` kullanılıyor
- Bu, her sipariş için en son onay hareketini getirir
- Ancak `siparis_onay_hareket_id` sıralaması ile `onay_tarih` sıralaması farklı olabilir

**Kod:**
```php
->join(
    '(SELECT *, ROW_NUMBER() OVER (PARTITION BY siparis_no ORDER BY siparis_onay_hareket_id DESC) as row_num
      FROM siparis_onay_hareketleri) as siparis_onay_hareketleri',
    'siparis_onay_hareketleri.siparis_no = siparisler.siparis_id AND siparis_onay_hareketleri.row_num = 1'
)
```

**Öneri:**
- `ORDER BY onay_tarih DESC` kullanılmalı (ancak `get_son_adim()` fonksiyonu `onay_tarih` kullanıyor)
- Tutarlılık için aynı sıralama kriteri kullanılmalı

---

## Teknik Detaylar

### Veritabanı Yapısı

#### siparisler Tablosu
- `siparis_id` (PRIMARY KEY)
- `siparis_ust_satis_onayi` (TINYINT/INT, NULL olabilir)
- `siparis_ust_satis_onay_tarihi` (DATETIME, NULL olabilir)
- `adim_no` (INT, NULL olabilir) - ⚠️ Bu alan muhtemelen JOIN'den geliyor, tabloda yok

#### siparis_onay_hareketleri Tablosu
- `siparis_onay_hareket_id` (PRIMARY KEY)
- `siparis_no` (FOREIGN KEY → siparisler.siparis_id)
- `adim_no` (INT, 0-11 arası)
- `onay_durum` (TINYINT, 1 = onaylandı)
- `onay_tarih` (DATETIME)
- `onay_kullanici_id` (FOREIGN KEY → kullanicilar.kullanici_id)

#### siparis_onay_adimlari Tablosu
- `adim_id` (PRIMARY KEY, 1-12 arası)
- `adim_adi` (VARCHAR)
- `adim_sira_numarasi` (INT, görüntüleme için)

#### kullanici_yetki_tanimlari Tablosu
- `kullanici_id` (FOREIGN KEY)
- `yetki_kodu` (VARCHAR)
- Örnek yetki kodları:
  - `siparis_onay_2`, `siparis_onay_3`, ..., `siparis_onay_12`
  - `siparis_ikinci_onay` (özel yetki)

### Helper Fonksiyonları

#### get_son_adim($siparis_id)
```php
function get_son_adim($siparis_id) {
    // Son onay hareketini bul (onay_tarih DESC)
    $result = SELECT * FROM siparis_onay_hareketleri 
              WHERE siparis_no = $siparis_id 
              ORDER BY onay_tarih DESC LIMIT 1;
    
    if ($result) {
        $guncel_adim = $result->adim_no + 1; // adim_id hesapla
        // Bir sonraki adım bilgilerini getir
        return SELECT * FROM siparis_onay_adimlari 
               WHERE adim_id = $guncel_adim;
    }
    return false;
}
```

**Döndürdüğü Değerler:**
- `adim_id` (1-12)
- `adim_adi`
- `adim_sira_numarasi`
- Diğer adım bilgileri

#### should_show_siparis_row($siparis, $data, $ak, $tum_siparisler_tabi, $filter)
- **Amaç:** Sipariş satırının gösterilip gösterilmeyeceğini kontrol eder
- **Döndürdüğü:** `bool`
- **Kontroller:**
  1. Tüm Siparişler tabı kontrolü
  2. Kullanıcı bazlı özel kurallar
  3. Üst satış onayı kontrolleri
  4. Eğitim ekibi kontrolü
  5. Filtre bazlı kontroller

#### can_user_approve_siparis($siparis_id, $kullanici_id, $kullanici_yetkili_adimlar, $siparis)
- **Amaç:** Kullanıcının siparişi onaylayıp onaylayamayacağını kontrol eder
- **Döndürdüğü:** `bool`
- **Mantık:**
  ```php
  $current_adim = $siparis->adim_no; // Örnek: 2
  $next_adim = $current_adim + 1;    // Örnek: 3
  $required_yetki_kodu = $next_adim + 1; // Örnek: 4
  return in_array($required_yetki_kodu, $kullanici_yetkili_adimlar);
  ```

### Controller Metodları

#### _render_onay_bekleyenler($view_path)
- **Amaç:** Onay bekleyen siparişler sayfasını render eder
- **Parametreler:**
  - `$view_path`: Görüntülenecek view dosyası yolu
- **İşlemler:**
  1. Kullanıcı ID al
  2. Filter kontrolü
  3. Kullanıcı yetkilerini al
  4. İkinci onay yetkisi kontrolü
  5. Filtre adımlarını belirle
  6. Model'den siparişleri getir
  7. View'a gönder

#### _get_kullanici_yetkili_adimlar($kullanici_id)
- **Amaç:** Kullanıcının yetkili olduğu adım numaralarını getirir
- **Döndürdüğü:** `array` (örn: [2, 4, 5])
- **Mantık:**
  ```php
  // Yetki kodu siparis_onay_2 ise adım 1'i onaylayabilir
  // Yani: yetki_kodu = siparis_onay_N → adim_no = N-1 onaylanabilir
  for ($i = 2; $i <= 12; $i++) {
      if(array_search("siparis_onay_" . $i, $yetki_kodlari) !== false) {
          $kullanici_yetkili_adimlar[] = $i;
      }
  }
  ```

#### _get_filter_adimlari($tum_siparisler_tabi, $kullanici_yetkili_adimlar)
- **Amaç:** Model'e gönderilecek adım filtrelerini belirler
- **Döndürdüğü:** `array` (örn: [1, 2, 3])
- **Mantık:**
  ```php
  if($tum_siparisler_tabi) {
      return [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11];
  }
  // Kullanıcının yetkili olduğu adımları filtrele
  foreach($kullanici_yetkili_adimlar as $adim) {
      $filter[] = $adim - 1; // Yetki kodu 2 ise adım 1'i onaylayabilir
  }
  ```

### Model Metodları

#### get_all_waiting($where_in, $kullanici_id, $has_ikinci_onay)
- **Amaç:** Onay bekleyen siparişleri getirir
- **Parametreler:**
  - `$where_in`: Adım numaraları array'i (örn: [1, 2, 3])
  - `$kullanici_id`: Kullanıcı ID (null olabilir)
  - `$has_ikinci_onay`: İkinci onay yetkisi var mı?
- **Döndürdüğü:** `array` (sipariş objeleri)
- **Özel Mantık:**
  ```php
  // İkinci onay yetkisi varsa adım 3'ü de dahil et
  if($has_ikinci_onay && count($where_in) > 0) {
      $this->db->group_start();
      $this->db->where_in('adim_no', $where_in);
      // Adım 3'teki ve 2. satış onayı bekleyen siparişler
      $this->db->or_group_start()
          ->where('adim_no', 3)
          ->where('siparis_ust_satis_onayi', 0)
          ->group_end();
      $this->db->group_end();
  }
  ```

---

## Sonuç ve Öneriler

### Tespit Edilen Sorunlar

1. **Adım 4'te "2. Onay" Yazısı Görünmesi:**
   - View dosyasında sadece adım 3 kontrolü var
   - Ancak kullanıcı adım 4'te görüyor
   - Veri tutarsızlığı veya model filtreleme hatası olabilir

2. **siparis_ust_satis_onayi NULL Değeri:**
   - View dosyasında `isset()` kontrolü var, ancak NULL için farklı davranış olabilir
   - Açık NULL kontrolü eklenmeli

3. **Model'de Kullanıcı ID 9 Özel Durumu:**
   - Model'de kullanıcı ID 9 için `has_ikinci_onay` otomatik `true`
   - Ancak controller'da bu kontrol yok
   - Tutarlılık sağlanmalı

4. **ROW_NUMBER() Sıralama:**
   - Model'de `siparis_onay_hareket_id DESC` kullanılıyor
   - `get_son_adim()` fonksiyonu `onay_tarih DESC` kullanıyor
   - Tutarlılık sağlanmalı

### Öneriler

1. **Veri Tutarlılığı Kontrolü:**
   - Adım 4'e geçildiğinde `siparis_ust_satis_onayi` kontrolü yapılmalı
   - Eğer `siparis_ust_satis_onayi = 0` ise, otomatik olarak `1` yapılmalı veya uyarı verilmeli

2. **View Dosyası Güncelleme:**
   - NULL kontrolü açıkça yapılmalı
   - Adım 4 için de kontrol eklenebilir (ancak mantıksal olarak yanlış olabilir)

3. **Model Filtreleme Güncelleme:**
   - Sadece gerçekten adım 3'teki siparişler getirilmeli
   - Adım 4'e geçmiş siparişler filtrelenmeli

4. **ROW_NUMBER() Güncelleme:**
   - Model'de `ORDER BY onay_tarih DESC` kullanılmalı
   - `get_son_adim()` ile tutarlılık sağlanmalı

---

**Dokümantasyon Sonu**

*Bu dokümantasyon, sipariş onay sisteminin tüm katmanlarını analiz ederek hazırlanmıştır. Sistemde yapılacak değişiklikler öncesi bu dokümantasyonun gözden geçirilmesi önerilir.*

