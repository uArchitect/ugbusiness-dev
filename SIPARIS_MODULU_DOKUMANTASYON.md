# Siparişler Modülü - Detaylı Dokümantasyon

## Genel Bakış

Siparişler modülü, CodeIgniter framework'ü kullanılarak geliştirilmiş kapsamlı bir sipariş yönetim sistemidir. Sistem, siparişlerin oluşturulmasından teslim edilmesine kadar tüm süreçleri yönetir ve çok aşamalı bir onay sistemi kullanır.

---

## Modül Yapısı

### 1. Controller: `application/controllers/Siparis.php`
- **Ana Controller**: Tüm sipariş işlemlerini yönetir
- **Önemli Metodlar**:
  - `index()`: Tüm siparişleri listeler
  - `onay_bekleyenler()`: Onay bekleyen siparişleri gösterir
  - `siparis_onayla($id)`: Sipariş onaylama işlemini gerçekleştirir
  - `report($id)`: Sipariş detay sayfasını gösterir
  - `_render_onay_bekleyenler()`: Onay bekleyen siparişler sayfasını render eder

### 2. Model: `application/models/Siparis_model.php`
- **Ana Model**: Veritabanı işlemlerini yönetir
- **Önemli Metodlar**:
  - `get_by_id($id)`: Tek bir siparişi getirir
  - `get_all()`: Tüm siparişleri getirir
  - `get_all_waiting()`: Onay bekleyen siparişleri getirir (ÖNEMLİ)
  - `get_all_products_by_order_id()`: Sipariş ürünlerini getirir
  - `get_all_actions_by_order_id()`: Onay hareketlerini getirir

### 3. Model: `application/models/Siparis_onay_hareket_model.php`
- Onay hareketlerini kaydeder

### 4. Views: `application/views/siparis/`
- `list/main_content.php`: Ana liste sayfası
- `includes/onay_bekleyen_table_row.php`: Onay bekleyen siparişler için tablo satırı
- `includes/filter_buttons.php`: Filtre butonları
- `includes/tabs.php`: Tab navigasyonu
- `includes/scripts.php`: JavaScript kodları

### 5. Helper: `application/helpers/siparis_view_helper.php`
- `should_show_siparis_row()`: Sipariş satırının gösterilip gösterilmeyeceğini kontrol eder
- `can_user_approve_siparis()`: Kullanıcının onay yetkisi olup olmadığını kontrol eder

### 6. Helper: `application/helpers/site_helper.php`
- `get_son_adim($siparis_id)`: Siparişin son adımını getirir
- `hatali_fiyat_kontrol($id)`: Fiyat kontrolü yapar

---

## Onay Bekleyen Siparişler Sayfası - Detaylı Algoritma

### 1. Sayfa Yükleme Akışı

```
Kullanıcı → /onay-bekleyen-siparisler
    ↓
Siparis::onay_bekleyenler()
    ↓
_render_onay_bekleyenler('siparis/list')
    ↓
View: siparis/list/main_content.php
```

### 2. Veri Hazırlama Algoritması (`_render_onay_bekleyenler`)

#### Adım 1: Kullanıcı Bilgilerini Al
```php
$current_user_id = $this->session->userdata('aktif_kullanici_id');
```

#### Adım 2: Filtre Kontrolü
```php
$tum_siparisler_tabi = ($this->input->get('filter') == '3');
```
- `filter=3`: Tüm siparişler tabı (tüm adımlar gösterilir)
- `filter=2` veya boş: Sadece onay bekleyen siparişler
- `filter=1`: Beklemede olan siparişler

#### Adım 3: Kullanıcı Yetkilerini Belirle
```php
$kullanici_yetkili_adimlar = $this->_get_kullanici_yetkili_adimlar($current_user_id);
```

**Algoritma:**
- `kullanici_yetki_tanimlari` tablosundan kullanıcının yetki kodlarını al
- `siparis_onay_2`, `siparis_onay_3`, ... `siparis_onay_12` formatındaki yetkileri bul
- Yetki kodundaki numarayı (2, 3, 4...) array'e ekle
- **Önemli**: Yetki kodu `siparis_onay_2` ise, kullanıcı adım 1'i onaylayabilir
- Yani: `yetki_kodu = siparis_onay_N` → `adim_no = N-1` onaylanabilir

#### Adım 4: İkinci Onay Yetkisi Kontrolü
```php
$has_ikinci_onay = $this->db
    ->where('kullanici_id', $current_user_id)
    ->where('yetki_kodu', 'siparis_ikinci_onay')
    ->get('kullanici_yetki_tanimlari')
    ->num_rows() > 0;
```
- Özel yetki: Adım 3'teki ve `siparis_ust_satis_onayi = 0` olan siparişleri onaylayabilir

#### Adım 5: Filtre Adımlarını Belirle
```php
$filter = $this->_get_filter_adimlari($tum_siparisler_tabi, $kullanici_yetkili_adimlar);
```

**Algoritma:**
- Eğer `tum_siparisler_tabi = true` → Tüm adımları getir: `[1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]`
- Değilse:
  - Kullanıcının yetkili olduğu adımları filtrele
  - `yetki_kodu = 2` → `adim_no = 1` (adım 1'i onaylayabilir)
  - `yetki_kodu = 3` → `adim_no = 2` (adım 2'yi onaylayabilir)
  - Formül: `filter[] = adim - 1`

#### Adım 6: Siparişleri Getir
```php
$viewData["onay_bekleyen_siparisler"] = $this->Siparis_model->get_all_waiting(
    $filter, 
    $kullanici_id_filtre, 
    $has_ikinci_onay
);
```

### 3. Model Metodu: `get_all_waiting()` - Detaylı Algoritma

#### SQL Sorgu Yapısı:
```sql
SELECT 
    siparisler.*,
    kullanicilar.*,
    merkezler.*,
    musteriler.*,
    sehirler.*,
    ilceler.*,
    siparis_onay_hareketleri.*,
    siparis_onay_adimlari.*
FROM siparisler
JOIN merkezler ON ...
JOIN musteriler ON ...
JOIN sehirler ON ...
JOIN ilceler ON ...
JOIN kullanicilar ON ...
JOIN (
    SELECT *, 
           ROW_NUMBER() OVER (PARTITION BY siparis_no ORDER BY siparis_onay_hareket_id DESC) as row_num
    FROM siparis_onay_hareketleri
) as siparis_onay_hareketleri 
    ON siparis_onay_hareketleri.siparis_no = siparisler.siparis_id 
    AND siparis_onay_hareketleri.row_num = 1
JOIN siparis_onay_adimlari 
    ON siparis_onay_adimlari.adim_id = adim_no
```

#### Önemli Noktalar:

1. **Son Onay Hareketini Bulma:**
   - `ROW_NUMBER() OVER (PARTITION BY siparis_no ORDER BY siparis_onay_hareket_id DESC)`
   - Her sipariş için en son onay hareketini getirir
   - `row_num = 1` olan kayıt seçilir

2. **Adım Filtreleme:**
   ```php
   if($has_ikinci_onay && count($where_in) > 0) {
       // Hem normal adımlar hem de 2. satış onayı bekleyen siparişler
       WHERE (adim_no IN (1,2,3...) OR (adim_no = 3 AND siparis_ust_satis_onayi = 0))
   } elseif($has_ikinci_onay) {
       // Sadece 2. satış onayı bekleyen siparişler
       WHERE adim_no = 3 AND siparis_ust_satis_onayi = 0
   } else {
       // Normal adım filtrelemesi
       WHERE adim_no IN (1,2,3...)
   }
   ```

3. **Kullanıcı Bazlı Filtreleme:**
   ```php
   if($kullanici_id !== null) {
       WHERE EXISTS (
           SELECT 1 
           FROM kullanici_yetki_tanimlari 
           WHERE kullanici_id = $kullanici_id
             AND yetki_kodu = CONCAT('siparis_onay_', adim_no + 1)
       )
   }
   ```
   - Mantık: Bir sonraki adım = `adim_no + 1`
   - Yetki kodu = `siparis_onay_{bir_sonraki_adım}`
   - Örnek: Sipariş adım 2'de ise, bir sonraki adım 3'tür
   - Kullanıcının `siparis_onay_3` yetkisi olmalı

4. **İkinci Onay Özel Durumu:**
   ```php
   if($has_ikinci_onay) {
       OR (
           adim_no = 3 
           AND siparis_ust_satis_onayi = 0
           AND EXISTS (
               SELECT 1 
               FROM kullanici_yetki_tanimlari 
               WHERE kullanici_id = $kullanici_id
                 AND yetki_kodu = 'siparis_ikinci_onay'
           )
       )
   }
   ```

### 4. View Render Algoritması

#### Adım 1: Helper Fonksiyonları Yükle
```php
$this->load->helper('siparis_view_helper');
```

#### Adım 2: Her Sipariş İçin Döngü
```php
foreach ($onay_bekleyen_siparisler as $siparis):
    $data = get_son_adim($siparis->siparis_id);
    
    // Filtreleme kontrolü
    if (!should_show_siparis_row($siparis, $data, $ak, $tum_siparisler_tabi, $current_filter)) {
        continue;
    }
    
    // Satır render et
    $this->load->view('siparis/includes/onay_bekleyen_table_row', [...]);
endforeach;
```

#### Adım 3: `get_son_adim()` Fonksiyonu
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
    
    return $adim_bilgileri;
}
```

#### Adım 4: `should_show_siparis_row()` Fonksiyonu

**Filtreleme Kuralları:**

1. **Tüm Siparişler Tabı:**
   - `filter=3` ise → Tüm siparişler gösterilir

2. **Kullanıcı Bazlı Özel Kurallar:**
   - Kullanıcı ID 2: Sadece kendi oluşturduğu veya belirli kullanıcıların siparişlerini görür
   - Kullanıcı ID 9: Adım 3'teki siparişleri görebilir, adım 4'teki siparişleri göremez

3. **Üst Satış Onayı Kontrolü:**
   ```php
   if ($siparis->siparis_ust_satis_onayi == 1) {
       // Üst satış onayı verilmişse
       if (kullanici_id IN [7, 1] AND next_adim_id == 4) {
           return false; // Gizle
       }
   } else {
       // Üst satış onayı verilmemişse
       if (kullanici_id IN [37, 8]) {
           return false; // Gizle
       }
   }
   ```

4. **Eğitim Ekibi Kontrolü:**
   ```php
   if (next_adim_id >= 11) {
       if (kullanici_id != 37) {
           // Eğitim ekibinde değilse gizle
           if (strpos($siparis->egitim_ekip, "\"$kullanici_id\"") === false) {
               return false;
           }
       }
   }
   ```

5. **Beklemede Filtresi:**
   ```php
   if ($filter == "1" && $beklemede == 0 && $ak != 9) {
       return false; // Sadece beklemede olanlar
   }
   if ($filter == "2" && $beklemede == 1) {
       return false; // Sadece işlemde olanlar
   }
   ```

#### Adım 5: `can_user_approve_siparis()` Fonksiyonu

**Onay Yetkisi Kontrolü:**
```php
function can_user_approve_siparis($siparis_id, $kullanici_id, $kullanici_yetkili_adimlar, $siparis) {
    $current_adim = $siparis->adim_no; // Örnek: 2
    $next_adim = $current_adim + 1;    // Örnek: 3
    
    // Yetki kodu: siparis_onay_{next_adim + 1}
    $required_yetki_kodu = $next_adim + 1; // Örnek: 4
    
    // Kullanıcının yetkili adımlarında bu numara var mı?
    return in_array($required_yetki_kodu, $kullanici_yetkili_adimlar);
}
```

**Örnek Senaryo:**
- Sipariş adım 2'de (adım 2 onaylanmış, adım 3 bekleniyor)
- Bir sonraki adım: 3
- Gerekli yetki kodu: `siparis_onay_4` (çünkü `next_adim + 1 = 4`)
- Kullanıcının `kullanici_yetkili_adimlar = [2, 4, 5]` ise → Onaylayabilir ✓

### 5. Tablo Satırı Render (`onay_bekleyen_table_row.php`)

#### Gösterilen Bilgiler:

1. **Kayıt No:**
   - Sipariş ID
   - Fiyat durumu (HATALI/GEÇERLİ)
   - Mevcut adım numarası
   - İkinci onay bilgisi (varsa)

2. **Müşteri Adı:**
   - Müşteri adı (link)
   - İletişim numaraları
   - Yenilenmiş cihaz badge'i (varsa)

3. **Merkez Detayları:**
   - Merkez adı
   - Şehir / İlçe
   - Adres (tooltip ile tam adres)

4. **Sipariş Oluşturan:**
   - Kullanıcı fotoğrafı
   - Kullanıcı adı (link)
   - Kayıt tarihi

5. **Son Durum:**
   - Adım adı
   - 12 adımlık progress bar
   - Tamamlanan adımlar yeşil, bekleyen adımlar gri

6. **İşlemler:**
   - **GÖRÜNTÜLE** butonu: Sipariş detay sayfasını açar
   - **ONAYLA** butonu: Sadece yetkisi varsa gösterilir
   - **ONAY BEKLENİYOR** butonu: Özel durumlar için (disabled)

#### Özel Durumlar:

1. **Üst Satış Onayı Bekleniyor:**
   ```php
   $onay_bekleniyor = (
       $data[0]->adim_sira_numarasi == 4 
       && $siparis->siparis_ust_satis_onayi == 0 
       && (kullanici_id == 37 || kullanici_id == 8)
   );
   ```
   - Adım 4'te ve üst satış onayı bekleniyor
   - Kullanıcı 37 veya 8 ise → Buton disabled

2. **İkinci Onay Bekleniyor:**
   ```php
   $ikinci_onay_bekleniyor = (
       $siparis->adim_no == 3 
       && $siparis->siparis_ust_satis_onayi == 0
   );
   ```
   - Adım 3'te ve üst satış onayı verilmemiş
   - `siparis_ikinci_onay` yetkisine sahip kullanıcılar görebilir

### 6. Onaylama İşlemi (`siparis_onayla`)

#### Adım 1: Veri Hazırlama
```php
$hareketler = $this->Siparis_model->get_all_actions_by_order_id($id);
$guncel_adim = $hareketler[count($hareketler)-1]->adim_no + 1;
$urunler = $this->Siparis_model->get_all_products_by_order_id($id);
$siparis = $this->Siparis_model->get_by_id($id);
```

#### Adım 2: Adım Bazlı Kontroller

**Adım 3 (Satış Onayı):**
- Sadece siparişi oluşturan veya yöneticisi onaylayabilir

**Adım 4 (Üretim Onayı):**
- Merkez adresi kontrolü
- Ürün bilgileri güncelleme (damla etiket, açılış ekranı, yurtdışı kontrolü)
- Müşteri talep teslim tarihi
- Eğitim var mı kontrolü

**Adım 7 (Üretim Tamamlandı):**
- Seri numarası kaydı
- Üretim tarihi
- Cihaz havuzu güncelleme

**Adım 8 (Başlık Kontrolü):**
- Başlık havuzunda kayıt kontrolü
- Başlık kayıtları oluşturma
- Garanti tarihleri belirleme

**Adım 11 (Kurulum Onayı):**
- TCKN zorunluluğu
- TCKN doğrulama
- Sosyal medya bilgileri zorunluluğu
- Müşteri cinsiyet bilgisi zorunluluğu

**Adım 12 (Eğitim Onayı):**
- Sadece eğitime giden kişi onaylayabilir
- Kursiyer bilgileri kaydı
- Değerlendirme SMS gönderimi

#### Adım 3: Onay Hareketi Kaydetme
```php
$siparis_onay_hareket = [
    "siparis_no" => $id,
    "adim_no" => $last_data->adim_no + 1,
    "onay_durum" => 1,
    "onay_aciklama" => strip_tags($this->input->post("onay_aciklama")),
    "onay_kullanici_id" => $this->session->userdata('aktif_kullanici_id')
];

$this->Siparis_onay_hareket_model->insert($siparis_onay_hareket);
```

#### Adım 4: Bir Sonraki Adım Kullanıcılarına SMS Gönderme
```php
// Bir sonraki adımı bul
$next_adim = $last_data->adim_no + 2;

// Bu adım için yetkili kullanıcıları bul
SELECT * FROM kullanici_yetki_tanimlari 
WHERE yetki_kodu = "siparis_onay_{$next_adim}"

// Her kullanıcıya SMS gönder
foreach ($kullanicilar as $kullanici) {
    sendSmsData($kullanici->kullanici_bireysel_iletisim_no, 
        "Sipariş {$siparis_kodu} {$adim_adi} aşaması için sizden onay beklemektedir. 
         Siparişi onaylamak için: {$url}");
}
```

#### Adım 5: Özel Durumlar

**Otomatik Onaylar:**
- Eğitim yoksa → Adım 10 ve 11 otomatik onaylanır
- Sistem tarafından otomatik onaylanan adımlar için açıklama: "Eğitim olmadığı için sistem tarafından otomatik onaylanmıştır."

**Türkiye Dışı Siparişler:**
- Adım 7'de Türkiye dışı ise → Adım 8 atlanır, direkt adım 9'a geçilir

---

## Onay Adımları Sistemi

### Adım Yapısı

Sistem 12 adımlı bir onay süreci kullanır:

1. **Adım 1**: İlk Kontrol
2. **Adım 2**: İkinci Kontrol
3. **Adım 3**: Satış Onayı
4. **Adım 4**: Üretim Onayı (Üst Satış Onayı gerekebilir)
5. **Adım 5**: Üretim Planlama
6. **Adım 6**: Üretim Başlatma
7. **Adım 7**: Üretim Tamamlandı
8. **Adım 8**: Başlık Kontrolü
9. **Adım 9**: Kurulum Planlama
10. **Adım 10**: Eğitim Planlama
11. **Adım 11**: Kurulum Onayı
12. **Adım 12**: Eğitim Onayı

### Yetki Sistemi

- **Yetki Kodu Formatı**: `siparis_onay_{N}`
- **Onaylama Mantığı**: 
  - Yetki kodu `siparis_onay_N` → Adım `N-1`'i onaylayabilir
  - Örnek: `siparis_onay_4` yetkisi → Adım 3'ü onaylayabilir

### Özel Yetkiler

- **`siparis_ikinci_onay`**: Adım 3'teki ve `siparis_ust_satis_onayi = 0` olan siparişleri onaylayabilir
- **`tum_siparisleri_goruntule`**: Tüm siparişleri görüntüleyebilir

---

## Veritabanı Tabloları

### `siparisler`
- Ana sipariş tablosu
- Önemli alanlar:
  - `siparis_id`: Primary key
  - `siparis_kodu`: Sipariş kodu
  - `merkez_no`: Merkez ID
  - `siparisi_olusturan_kullanici`: Oluşturan kullanıcı ID
  - `siparis_ust_satis_onayi`: Üst satış onayı (0/1)
  - `beklemede`: Beklemede durumu (0/1)
  - `siparis_aktif`: Aktif durumu (0/1)

### `siparis_onay_hareketleri`
- Onay hareketleri geçmişi
- Önemli alanlar:
  - `siparis_onay_hareket_id`: Primary key
  - `siparis_no`: Sipariş ID
  - `adim_no`: Adım numarası
  - `onay_durum`: Onay durumu (1: onaylandı)
  - `onay_kullanici_id`: Onaylayan kullanıcı ID
  - `onay_tarih`: Onay tarihi
  - `onay_aciklama`: Onay açıklaması

### `siparis_onay_adimlari`
- Onay adımları tanımları
- Önemli alanlar:
  - `adim_id`: Adım ID (1-12)
  - `adim_adi`: Adım adı
  - `adim_sira_numarasi`: Sıra numarası

### `kullanici_yetki_tanimlari`
- Kullanıcı yetki tanımları
- Önemli alanlar:
  - `kullanici_id`: Kullanıcı ID
  - `yetki_kodu`: Yetki kodu (örn: `siparis_onay_2`)

---

## Frontend (JavaScript) Algoritması

### DataTables Entegrasyonu

1. **Onay Bekleyen Siparişler Tablosu:**
   ```javascript
   $('#onaybekleyensiparisler_new').DataTable({
       "processing": true,
       "serverSide": false,  // Client-side processing
       "pageLength": 10,
       "order": [[0, "desc"]]
   });
   ```

2. **Tüm Siparişler Tablosu:**
   ```javascript
   $('#users_tablce').DataTable({
       "processing": true,
       "serverSide": true,  // Server-side processing
       "ajax": {
           "url": "<?php echo site_url('siparis/siparisler_ajax'); ?>",
           "data": function(d) {
               // Filtre parametrelerini ekle
               d.sehir_id = ...
               d.kullanici_id = ...
               d.tarih_baslangic = ...
               d.tarih_bitis = ...
               d.teslim_durumu = ...
           }
       }
   });
   ```

### Pencere Yönetimi

- `showWindow2(url)`: Sipariş detay sayfasını yeni pencerede açar
- Pencere kapatıldığında sayfa otomatik yenilenir
- DataTable'lar otomatik güncellenir

---

## Önemli Notlar ve Edge Cases

1. **Fiyat Kontrolü:**
   - Her sipariş için fiyat kontrolü yapılır
   - Hatalı fiyat varsa kırmızı badge gösterilir
   - Kontrol: `(satis_fiyati - pesinat - kapora - takas_bedeli) > 0 && vade_sayisi == 0` → HATALI

2. **Merkez Adı Kontrolü:**
   - Merkez adı `#NULL#` ise uyarı gösterilir

3. **Adres Kontrolü:**
   - Adres boş, "0" veya "." ise uyarı gösterilir

4. **Yenilenmiş Cihaz:**
   - Siparişte yenilenmiş cihaz varsa badge gösterilir

5. **Eğitim Ekibi:**
   - Adım 11 ve üzeri için sadece eğitim ekibindeki kullanıcılar görebilir
   - `egitim_ekip` JSON array'inde kullanıcı ID'si olmalı

6. **Otomatik Onaylar:**
   - Eğitim yoksa adım 10 ve 11 otomatik onaylanır
   - Sistem tarafından otomatik onaylanan adımlar için özel açıklama eklenir

---

## Performans Optimizasyonları

1. **SQL Optimizasyonu:**
   - `ROW_NUMBER() OVER()` ile son onay hareketi tek sorguda getirilir
   - JOIN'ler optimize edilmiştir
   - Index'ler kullanılmalı: `siparis_no`, `adim_no`, `onay_tarih`

2. **View Optimizasyonu:**
   - Helper fonksiyonlar ile kod tekrarı önlenir
   - Partial view'lar ile modüler yapı
   - DataTables ile client-side pagination

3. **Cache Stratejisi:**
   - Kullanıcı yetkileri session'da tutulabilir
   - Adım tanımları cache'lenebilir

---

## Güvenlik Önlemleri

1. **Yetki Kontrolü:**
   - Her işlemde yetki kontrolü yapılır
   - SQL injection koruması (CodeIgniter Query Builder)
   - XSS koruması (`strip_tags`, `htmlspecialchars`)

2. **Veri Doğrulama:**
   - TCKN doğrulama
   - Tarih formatı kontrolü
   - Zorunlu alan kontrolleri

3. **Session Yönetimi:**
   - Aktif kullanıcı bilgisi session'dan alınır
   - Yetkisiz erişim engellenir

---

## Sonuç

Siparişler modülü, karmaşık bir onay sürecini yöneten, kullanıcı yetkilerine göre dinamik filtreleme yapan ve gerçek zamanlı bildirimler gönderen kapsamlı bir sistemdir. Onay bekleyen siparişler sayfası, bu sistemin kalbidir ve kullanıcıların yetkilerine göre sadece ilgili siparişleri gösterir, onay işlemlerini kolaylaştırır.

