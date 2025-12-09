# Onay Bekleyen Siparişler Sayfası - Kapsamlı Analiz

## 📋 Genel Bakış

**URL:** `https://ugbusiness.com.tr/onay-bekleyen-siparisler`  
**Route:** `onay-bekleyen-siparisler` → `siparis/onay_bekleyenler`  
**Controller:** `application/controllers/Siparis.php`  
**Method:** `onay_bekleyenler()`  
**View:** `application/views/siparis/list/main_content.php`

Bu sayfa, sipariş onay sürecinde bekleyen siparişleri görüntülemek ve yönetmek için kullanılır. Sistem, siparişleri 12 adımlı bir onay sürecinden geçirir ve her adım için farklı yetkilendirmeler gerektirir.

---

## 🔄 Sipariş Onay Süreci (12 Adım)

### Onay Adımları Yapısı

Sistem `siparis_onay_adimlari` tablosunda tanımlı 12 adımdan oluşur:

1. **Adım 1:** İlk onay (genellikle sipariş oluşturma)
2. **Adım 2:** İkinci onay
3. **Adım 3:** Satış onayı (özel kontroller var)
4. **Adım 4:** Üst satış onayı (merkez adresi kontrolü)
5. **Adım 5-10:** Ara onay adımları
6. **Adım 11:** Kurulum onayı (TCKN, sosyal medya, cinsiyet kontrolü)
7. **Adım 12:** Eğitim onayı (eğitim ekibi kontrolü)

### Veritabanı Tabloları

#### 1. `siparis_onay_adimlari`
- `adim_id`: Adım numarası (1-12)
- `adim_adi`: Adım adı
- `adim_sira_numarasi`: Sıra numarası

#### 2. `siparis_onay_hareketleri`
- `siparis_onay_hareket_id`: Primary key
- `siparis_no`: Sipariş ID'si
- `adim_no`: Onaylanan adım numarası
- `onay_durum`: Onay durumu (1: onaylandı)
- `onay_aciklama`: Onay açıklaması
- `onay_kullanici_id`: Onaylayan kullanıcı ID'si
- `onay_tarih`: Onay tarihi

#### 3. `kullanici_yetki_tanimlari`
- `yetki_kodu`: `siparis_onay_2`, `siparis_onay_3`, ..., `siparis_onay_12` formatında
- Her adım için farklı yetki kodu tanımlanır

---

## 🎯 Controller Mantığı (`onay_bekleyenler`)

### 1. Yetki Filtreleme

```php
// Tüm Siparişler tabı için (filter=3) tüm adımları getir
$tum_siparisler_tabi = ($this->input->get('filter') == '3');

if($tum_siparisler_tabi) {
    // Tüm adımları getir (1-11)
    $filter = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11];
} else {
    // Kullanıcının yetkili olduğu adımları bul
    $query = $this->db->select("yetki_kodu")
        ->get_where("kullanici_yetki_tanimlari", 
            array('kullanici_id' => $current_user_id));
    $filter = array();
    for ($i=2; $i <= 12; $i++) { 
        if(array_search("siparis_onay_".$i, 
            array_column($query->result(), 'yetki_kodu')) !== false){
            $filter[] = $i-1; // Yetki kodu siparis_onay_2 ise adım 1'i kontrol eder
        }
    } 
}
```

**Önemli Not:** Yetki kodları `siparis_onay_2` formatında, ancak bu adım 1'i kontrol eder. Yani:
- `siparis_onay_2` → Adım 1'i onaylama yetkisi
- `siparis_onay_3` → Adım 2'yi onaylama yetkisi
- ...
- `siparis_onay_12` → Adım 11'i onaylama yetkisi

### 2. Sipariş Çekme

```php
$viewData["onay_bekleyen_siparisler"] = 
    $this->Siparis_model->get_all_waiting($filter);
```

### 3. İstatistikler

```php
// İşlemde olan siparişler (beklemede = 0)
$islemdekiler_sayi = $this->db->query(
    'SELECT * FROM siparisler 
     WHERE beklemede = 0 
     AND siparisi_olusturan_kullanici != 12 
     AND siparisi_olusturan_kullanici != 1'
)->num_rows();

// Beklemede olan siparişler (beklemede = 1)
$bekleyenler_sayi = $this->db->query(
    'SELECT * FROM siparisler WHERE beklemede = 1'
)->num_rows();
```

---

## 📊 Model Mantığı (`get_all_waiting`)

### Sorgu Yapısı

```php
public function get_all_waiting($where_in)
{
    if(count($where_in) <= 0){
        return [];
    }
    
    $this->db->where(["siparis_aktif" => 1]);
    
    $query = $this->db
        ->where_in('adim_no', $where_in)
        ->select('siparisler.*, 
                  kullanicilar.kullanici_ad_soyad, 
                  kullanicilar.kullanici_id, 
                  merkezler.merkez_adi, 
                  merkezler.merkez_adresi, 
                  musteriler.musteri_id, 
                  musteriler.musteri_ad, 
                  musteriler.musteri_iletisim_numarasi, 
                  sehirler.sehir_adi, 
                  ilceler.ilce_adi, 
                  siparis_onay_hareketleri.*, 
                  siparis_onay_adimlari.*')
        ->from('siparisler')
        ->join('merkezler', 'merkezler.merkez_id = siparisler.merkez_no')
        ->join('musteriler', 'musteriler.musteri_id = merkezler.merkez_yetkili_id')
        ->join('sehirler', 'merkezler.merkez_il_id = sehirler.sehir_id')
        ->join('ilceler', 'merkezler.merkez_ilce_id = ilceler.ilce_id')
        ->join('kullanicilar', 'kullanicilar.kullanici_id = siparisler.siparisi_olusturan_kullanici', 'left')
        ->join('(SELECT *, ROW_NUMBER() OVER (PARTITION BY siparis_no ORDER BY siparis_onay_hareket_id DESC) as row_num
                  FROM siparis_onay_hareketleri) as siparis_onay_hareketleri',
                'siparis_onay_hareketleri.siparis_no = siparisler.siparis_id 
                 AND siparis_onay_hareketleri.row_num = 1')
        ->join('siparis_onay_adimlari', 'siparis_onay_adimlari.adim_id = adim_no')
        ->order_by('adim_no', 'ASC')
        ->get();
    
    return $query->result();
}
```

### Önemli Noktalar

1. **Son Hareket Bulma:** `ROW_NUMBER() OVER (PARTITION BY siparis_no ORDER BY siparis_onay_hareket_id DESC)` ile her siparişin en son onay hareketi bulunur.

2. **Adım Eşleştirme:** `siparis_onay_adimlari.adim_id = adim_no` ile mevcut adım bilgisi alınır.

3. **Aktif Siparişler:** Sadece `siparis_aktif = 1` olan siparişler getirilir.

---

## 🖥️ View Mantığı (`main_content.php`)

### 1. Tab Filtreleri

Sayfada 3 farklı tab bulunur:

- **Tüm Siparişler** (`filter=3`): Tüm adımlardaki siparişler (1-11)
- **Onay Bekleyen Siparişler** (`filter=2` veya boş): `beklemede = 0` olan siparişler
- **Beklemede Olan Siparişler** (`filter=1`): `beklemede = 1` olan siparişler

### 2. Kullanıcı Bazlı Filtreleme

View'da her sipariş için özel kontroller yapılır:

#### a) Kullanıcı ID = 2 Kontrolü
```php
if($ak == 2){
    if($siparis->siparisi_olusturan_kullanici != 2 
       && $siparis->siparisi_olusturan_kullanici != 5 
       && $siparis->siparisi_olusturan_kullanici != 18 
       && $siparis->siparisi_olusturan_kullanici != 94){
        continue; // Bu siparişi gösterme
    }
}
```

#### b) Üst Satış Onayı Kontrolü
```php
if($siparis->siparis_ust_satis_onayi == 1 
   && ($i_kul == 7 || $i_kul == 9 || $i_kul == 1)){
    if($data[0]->adim_id == 4){
        continue; // Adım 4'te ve üst satış onayı varsa, belirli kullanıcılar göremez
    }
}

if($siparis->siparis_ust_satis_onayi == 0 
   && ($i_kul == 37 || $i_kul == 8)){
    continue; // Üst satış onayı yoksa, belirli kullanıcılar göremez
}
```

#### c) Eğitim Ekip Kontrolü (Adım 11+)
```php
if($ak != 37){
    if($data[0]->adim_id >= 11){
        if(strpos($siparis->egitim_ekip, "\"$ak\"") == false){
            continue; // Eğitim ekibinde değilse göremez
        }
    }
}
```

#### d) Beklemede Filtresi
```php
if(!empty($_GET["filter"])){
    if($_GET["filter"] == "1" && $siparis->beklemede == 0){
        if($ak != 9){
            continue; // Sadece kullanıcı 9, beklemede olmayan siparişleri görebilir
        }
    }
    if($_GET["filter"] == "2" && $siparis->beklemede == 1){
        continue; // Beklemede olan siparişler "Onay Bekleyenler" tabında gösterilmez
    }
}
```

### 3. Son Adım Bulma

```php
$data = get_son_adim($siparis->siparis_id);
```

**Helper Fonksiyon:** `application/helpers/site_helper.php`

```php
function get_son_adim($siparis_id) { 
    $CI = get_instance();  
    $CI->db->select('*');
    $CI->db->from('siparis_onay_hareketleri');
    $CI->db->where('siparis_no', $siparis_id);
    $CI->db->order_by('onay_tarih', 'DESC');
    $CI->db->limit(1);
    $query = $CI->db->get();
    $result = $query->row();

    if ($result) {
        $guncel_adim = $result->adim_no + 1; // Bir sonraki adım
        $CI->db->select('*');
        $CI->db->from('siparis_onay_adimlari');
        $CI->db->where('adim_id', $guncel_adim);
        $query2 = $CI->db->get();
        return $query2->result();
    } else {
        return false; 
    }
}
```

### 4. Tablo Gösterimi

Her sipariş için şu bilgiler gösterilir:

- **Kayıt No:** Sipariş ID'si + Fiyat durumu (Hatalı/Geçerli)
- **Müşteri Adı:** Müşteri bilgileri + iletişim
- **Merkez Detayları:** Merkez adı, şehir/ilçe, adres
- **Sipariş Oluşturan:** Kullanıcı adı + kayıt tarihi
- **Son Durum:** Beklenen adım + 12 adımlı progress bar
- **Sipariş İşlemleri:** "Görüntüle" butonu (bazı durumlarda "ONAY BEKLENİYOR")

### 5. Progress Bar

12 adımlı görsel gösterge:

```php
<?php for($i=1; $i<=12; $i++): ?>
    <div class="mr-1" style="border: 1px solid #178018;
                             border-radius:50%;
                             background:<?=$siparis->adim_no+1 >= $i 
                                 ? (($siparis->adim_no+1 == $i) 
                                     ? "green" 
                                     : "#b4d7b4") 
                                 : "#e5e3e3"?>;
                             width:17px;height:17px;display: inline-flex;">
        <i class="fa fa-check" style="...<?=($siparis->adim_no+1 <= $i) 
            ? "display:none;" 
            : ""?>"></i>
    </div>
<?php endfor; ?>
```

**Mantık:**
- `adim_no+1 >= $i`: Tamamlanan adımlar (yeşil)
- `adim_no+1 == $i`: Şu anki adım (koyu yeşil)
- `adim_no+1 < $i`: Gelecek adımlar (gri)

---

## ✅ Onay İşlemi (`siparis_onayla`)

### Genel Akış

1. **Mevcut Adım Bulma:**
   ```php
   $hareketler = $this->Siparis_model->get_all_actions_by_order_id($id);
   $guncel_adim = $hareketler[count($hareketler)-1]->adim_no + 1;
   ```

2. **Adım Bazlı Kontroller:**
   - **Adım 3:** Satış onayı yetkisi kontrolü
   - **Adım 4:** Merkez adresi kontrolü
   - **Adım 11:** TCKN, sosyal medya, cinsiyet kontrolü
   - **Adım 12:** Eğitim ekibi kontrolü

3. **Yeni Hareket Kaydı:**
   ```php
   $siparis_onay_hareket["siparis_no"] = $id;
   $siparis_onay_hareket["adim_no"] = $last_data->adim_no + 1;
   $siparis_onay_hareket["onay_durum"] = 1;
   $siparis_onay_hareket["onay_aciklama"] = strip_tags($this->input->post("onay_aciklama"));
   $siparis_onay_hareket["onay_kullanici_id"] = $this->session->userdata('aktif_kullanici_id');
   
   $this->Siparis_onay_hareket_model->insert($siparis_onay_hareket);
   ```

4. **Sonraki Adım Yetkililerine SMS:**
   ```php
   $queryq = $this->db
       ->where("yetki_kodu", "siparis_onay_".($last_data->adim_no+2))
       ->join('kullanicilar', 'kullanicilar.kullanici_id = kullanici_yetki_tanimlari.kullanici_id')
       ->get("kullanici_yetki_tanimlari");
   
   foreach ($dkul as $kullanici_data) {
       sendSmsData($kullanici_data->kullanici_bireysel_iletisim_no, 
                   "Sn. ".$kullanici_data->kullanici_ad_soyad." 
                    ".date("d.m.Y H:i")." tarihinde işlem yapılan 
                    ".$siparis[0]->siparis_kodu." no'lu sipariş 
                    ".$adim_ad." aşaması için sizden onay beklemektedir. 
                    Siparişi onaylamak için : $url");
   }
   ```

### Özel Durumlar

#### Adım 3 - Satış Onayı
- Siparişi oluşturan kullanıcı veya yöneticisi onaylayabilir
- Diğer kullanıcılar yetkisiz erişim hatası alır

#### Adım 4 - Üst Satış Onayı
- Merkez adresi kontrolü yapılır
- Adres yoksa onay verilemez

#### Adım 11 - Kurulum Onayı
- TCKN zorunlu ve geçerli olmalı
- Sosyal medya bilgileri (Instagram veya Facebook) zorunlu
- Müşteri cinsiyet bilgisi zorunlu

#### Adım 12 - Eğitim Onayı
- Sadece eğitim ekibindeki kullanıcılar onaylayabilir
- `egitim_ekip` JSON alanında kullanıcı ID'si kontrol edilir
- Kursiyer bilgileri `cihaz_egitimleri` tablosuna kaydedilir
- Değerlendirme SMS'i gönderilir

---

## 🔗 İlgili Sayfalar ve Fonksiyonlar

### 1. Sipariş Detay Sayfası
- **URL:** `siparis/report/{encoded_id}`
- **Method:** `report($id)`
- Sipariş detaylarını ve onay geçmişini gösterir

### 2. Tüm Siparişler
- **URL:** `tum-siparisler` veya `siparis/siparisler_restore`
- **Method:** `index()` veya `siparisler_restore()`
- Tüm siparişleri filtreleme seçenekleriyle gösterir

### 3. Tab Navigasyonu
- **Dosya:** `application/views/siparis/includes/tabs.php`
- Yetki kontrolüne göre tablar gösterilir

### 4. Helper Fonksiyonlar
- `get_son_adim($siparis_id)`: Son adımı bulur
- `hatali_fiyat_kontrol($siparis_id)`: Fiyat kontrolü yapar
- `tckn_dogrula($tckn)`: TCKN doğrulama
- `degerlendirme_sms_gonder($siparis_id)`: Değerlendirme SMS'i

---

## 🎨 UI/UX Özellikleri

### 1. Modern Tab Sistemi
- `siparis/includes/tabs.php` ile dinamik tab navigasyonu
- Yetki bazlı tab gösterimi

### 2. Responsive Tasarım
- Card-based layout
- Modern tab navigation
- Progress bar gösterimi

### 3. Filtreleme
- 3 farklı tab: Tüm Siparişler, Onay Bekleyenler, Beklemede Olanlar
- Kullanıcı bazlı otomatik filtreleme

### 4. Görsel İpuçları
- Fiyat durumu badge'leri (Hatalı/Geçerli)
- Progress bar ile adım gösterimi
- Renk kodlu durum göstergeleri

---

## 🔐 Güvenlik ve Yetkilendirme

### 1. Yetki Kontrolü
- Her adım için ayrı yetki kodu (`siparis_onay_2` - `siparis_onay_12`)
- `kullanici_yetki_tanimlari` tablosundan kontrol

### 2. Kullanıcı Bazlı Filtreleme
- Kullanıcı ID'sine göre sipariş görünürlüğü
- Eğitim ekibi kontrolü
- Üst satış onayı kontrolü

### 3. Veri Doğrulama
- TCKN doğrulama
- Zorunlu alan kontrolleri
- XSS koruması (`strip_tags`)

---

## 📈 Performans Notları

### 1. Veritabanı Optimizasyonu
- `ROW_NUMBER() OVER` ile son hareket bulma (subquery yerine)
- Index'lenmiş alanlar kullanımı
- JOIN optimizasyonu

### 2. N+1 Problem
- View'da her sipariş için `get_son_adim()` çağrısı yapılıyor
- Bu, N sipariş için N+1 sorgu anlamına gelir
- **Öneri:** Model'de toplu çekme yapılabilir

### 3. Cache Fırsatları
- Adım bilgileri (`siparis_onay_adimlari`) sık değişmez, cache'lenebilir
- Yetki bilgileri session'da tutulabilir

---

## 🐛 Bilinen Sorunlar ve İyileştirme Önerileri

### 1. Yetki Kodu Mantığı
- `siparis_onay_2` → Adım 1 kontrolü karışıklığa yol açabilir
- **Öneri:** Yetki kodlarını `siparis_onay_adim_1` formatına çevirmek

### 2. Hard-coded Kullanıcı ID'leri
- View'da birçok yerde hard-coded kullanıcı ID'leri var (2, 5, 7, 8, 9, 18, 37, 94)
- **Öneri:** Bu kontrolleri config veya veritabanına taşımak

### 3. N+1 Query Problem
- `get_son_adim()` her sipariş için ayrı çağrılıyor
- **Öneri:** Model'de toplu çekme yapmak

### 4. Filter Mantığı
- `filter=1` ve `filter=2` mantığı biraz karmaşık
- **Öneri:** Daha açık isimlendirme (örn: `status=beklemede`, `status=islemde`)

---

---

## 🔗 Sipariş Detay Sayfası (Report) ile İlişki

### URL Yapısı ve Encoding

**URL Formatı:**
```
https://ugbusiness.com.tr/siparis/report/{encoded_id}
```

**Encoding Mantığı:**
```php
// Encoding (Sipariş ID'sini gizlemek için)
$encoded_id = urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE" . $siparis_id . "Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE"));

// Decoding (Controller'da)
$id = urldecode(
    str_replace(
        "Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE",
        "",
        base64_decode(str_replace("%3D", "=", $id))
    )
);
```

**Örnek:**
- Sipariş ID: `2136`
- Encoded: `R2czVEdHVWN2MjlDcEE4YVVjcHdWMktkakN6OGFFMjEzNkdnM1RHR1VjdjI5Q3BBOGFVY3B3VjJLZGpDejhhRQ==`
- URL: `https://ugbusiness.com.tr/siparis/report/R2czVEdHVWN2MjlDcEE4YVVjcHdWMktkakN6OGFFMjEzNkdnM1RHR1VjdjI5Q3BBOGFVY3B3VjJLZGpDejhhRQ%3D%3D`

### Controller Metodu (`report`)

```php
public function report($id = '', $modal_format = 0)
{
    // 1. ID Decode
    $id = urldecode(str_replace("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE", "", 
        base64_decode(str_replace("%3D", "=", $id))));
    
    // 2. Sipariş Kontrolü
    $check_id = $this->Siparis_model->get_by_id($id);
    if(!$check_id) {
        redirect(site_url('siparis'));
    }
    
    // 3. Yetki Kontrolü - Onay Durumu
    $current_user_id = $this->session->userdata('aktif_kullanici_id');
    $query = $this->db->select("yetki_kodu")
        ->get_where("kullanici_yetki_tanimlari", 
            array('kullanici_id' => $current_user_id));
    
    $hareketler = $this->Siparis_model->get_all_actions_by_order_id($id);
    $ara = $hareketler[count($hareketler)-1]->adim_no + 1; // Bir sonraki adım
    
    // Kullanıcının bu adımı onaylama yetkisi var mı?
    if(array_search("siparis_onay_".$ara, 
        array_column($query->result(), 'yetki_kodu')) !== false){
        $viewData['onay_durum'] = true; // Onay butonu göster
    } else {
        $viewData['onay_durum'] = false; // Sadece görüntüleme
    }
    
    // 4. Görüntüleme Yetkisi Kontrolü
    if(goruntuleme_kontrol("tum_siparisleri_goruntule") == false){
        if($viewData['onay_durum'] == false){
            // Onay yetkisi yoksa, sadece kendi siparişlerini görebilir
            if($check_id[0]->siparisi_olusturan_kullanici != 
               $this->session->userdata('aktif_kullanici_id')){
                redirect(site_url('siparis'));
            }
        }
    }
    
    // 5. View Data Hazırlama
    $viewData['siparis'] = $check_id[0];
    $viewData['urunler'] = $this->Siparis_model->get_all_products_by_order_id($id);
    $viewData['hareketler'] = $hareketler; // Onay geçmişi
    $viewData['guncel_adim'] = $hareketler[count($hareketler)-1]->adim_no + 1;
    $viewData['adimlar'] = $this->Siparis_model->get_all_steps(); // Tüm adımlar
    // ... diğer veriler
    
    // 6. View Yükleme
    if($modal_format == 1){
        $this->load->view('base_view_modal', $viewData); // Modal format
    } else {
        $this->load->view('base_view', $viewData); // Normal sayfa
    }
}
```

### İki Sayfa Arasındaki İlişki

#### 1. **Liste → Detay Geçişi**

**Onay Bekleyen Siparişler Sayfası:**
```php
// main_content.php - Satır 112
$link = base_url("siparis/report/")
    . urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE"
        . $siparis->siparis_id 
        . "Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE"));

// "Görüntüle" butonu
<a onclick="showWindow2('<?=$link?>');" 
   class="btn btn-warning btn-xs">
    <i class="fas fa-search"></i> <b>GÖRÜNTÜLE</b>
</a>
```

**JavaScript Fonksiyonu:**
```javascript
function showWindow2($url) {
    var width = 950;
    var height = 720;
    var left = (screen.width / 2) - (width / 2);
    var top = (screen.height / 2) - (height / 2);
    var newWindow = window.open($url, 'Yeni Pencere', 
        'width=' + width + ',height=' + height + 
        ',top=' + top + ',left=' + left);
    
    // Pencere kapanınca sayfayı yenile
    var interval = setInterval(function() {
        if (newWindow.closed) {
            clearInterval(interval);
            location.reload(); // Onay sonrası liste yenilenir
        }
    }, 1000);
}
```

#### 2. **Detay Sayfasında Onay İşlemi**

**Onay Formu:**
```php
// main_content.php - Satır 1320-2091
<?php if($onay_durum == true): ?>
    <form action="<?=base_url("siparis/onayla/$siparis->siparis_id")?>" 
          onsubmit="wait_action()" method="post">
        
        <!-- Adım 4: Özel Form Alanları -->
        <?php if($guncel_adim == 4): ?>
            <!-- Damla Etiket, Açılış Ekranı, Yurtdışı Kontrolü -->
        <?php endif; ?>
        
        <!-- Adım 12: Kursiyer Seçimi -->
        <?php if($guncel_adim == 12): ?>
            <!-- Eğitim alacak kişilerin seçimi -->
        <?php endif; ?>
        
        <!-- Onay Açıklaması -->
        <textarea name="onay_aciklama" id="summernoteonay"></textarea>
        
        <!-- Onay Butonu -->
        <button class="btn btn-success">
            <i class="fas fa-check"></i> SİPARİŞİ ONAYLA
        </button>
    </form>
<?php endif; ?>
```

#### 3. **Onay Sonrası Yönlendirme**

**Onay İşlemi Sonrası:**
```php
// siparis_onayla() metodunda
// ... onay işlemleri ...
// ... SMS gönderimi ...

// Redirect yok, ancak:
// - Liste sayfasındaki showWindow2() fonksiyonu
//   pencere kapandığında location.reload() çağırır
// - Bu sayede liste otomatik yenilenir
```

### Veri Akışı

```
┌─────────────────────────────────────┐
│  Onay Bekleyen Siparişler Sayfası   │
│  (onay_bekleyenler)                 │
└──────────────┬──────────────────────┘
               │
               │ 1. Kullanıcı yetkilerine göre
               │    siparişler listelenir
               │
               │ 2. Her sipariş için:
               │    - Son adım bulunur (get_son_adim)
               │    - Kullanıcı bazlı filtreleme yapılır
               │    - "Görüntüle" butonu gösterilir
               │
               ▼
┌─────────────────────────────────────┐
│  Sipariş Detay Sayfası (report)    │
│  - Encoded ID ile erişim            │
│  - Onay yetkisi kontrolü            │
│  - Sipariş detayları gösterilir     │
└──────────────┬──────────────────────┘
               │
               │ 3. Kullanıcı onay formunu doldurur
               │
               ▼
┌─────────────────────────────────────┐
│  Onay İşlemi (siparis_onayla)       │
│  - Adım bazlı kontroller            │
│  - Yeni hareket kaydı               │
│  - SMS gönderimi                    │
└──────────────┬──────────────────────┘
               │
               │ 4. Pencere kapanır
               │
               ▼
┌─────────────────────────────────────┐
│  Liste Sayfası Yenilenir             │
│  - Onaylanan sipariş listeden çıkar │
│  - Yeni siparişler görünür           │
└──────────────────────────────────────┘
```

### Önemli Farklar

| Özellik | Onay Bekleyen Siparişler | Sipariş Detay (Report) |
|---------|-------------------------|------------------------|
| **Amaç** | Liste görüntüleme | Detay görüntüleme ve onay |
| **Yetki Kontrolü** | Adım bazlı filtreleme | Onay yetkisi kontrolü |
| **ID Formatı** | Normal ID | Encoded ID (güvenlik) |
| **Form** | Yok | Var (onay formu) |
| **Onay İşlemi** | Yok | Var (siparis_onayla) |
| **SMS Gönderimi** | Yok | Var (onay sonrası) |

### Güvenlik Önlemleri

1. **ID Encoding:**
   - Sipariş ID'si base64 ile encode edilir
   - Özel bir string (`Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE`) ile sarılır
   - URL'de görünür ama decode edilmeden kullanılamaz

2. **Yetki Kontrolü:**
   - Liste sayfasında: Kullanıcının yetkili olduğu adımlar filtrelenir
   - Detay sayfasında: Onay yetkisi kontrol edilir
   - Görüntüleme yetkisi kontrol edilir

3. **Erişim Kontrolü:**
   - "Tüm siparişleri görüntüle" yetkisi yoksa
   - Sadece kendi siparişlerini görebilir
   - Onay yetkisi varsa başkalarının siparişlerini de görebilir

---

## 📝 Özet

"Onay Bekleyen Siparişler" sayfası, 12 adımlı bir sipariş onay sürecini yönetir. Her adım için farklı yetkilendirmeler ve kontroller vardır. Sayfa, kullanıcının yetkilerine göre ilgili siparişleri filtreler ve gösterir. 

**Sipariş Detay Sayfası (Report)** ile olan ilişki:
- Liste sayfasından "Görüntüle" butonu ile detay sayfasına geçilir
- Detay sayfasında onay işlemi yapılır
- Onay sonrası pencere kapanır ve liste otomatik yenilenir
- ID encoding ile güvenlik sağlanır

**Ana Bileşenler:**
- Controller: Yetki filtreleme ve veri hazırlama
- Model: Veritabanı sorguları
- View: Kullanıcı bazlı filtreleme ve görüntüleme
- Helper: Son adım bulma ve diğer yardımcı fonksiyonlar

**Ana Akış:**
1. Kullanıcının yetkili olduğu adımlar belirlenir
2. Bu adımlardaki siparişler çekilir
3. View'da kullanıcı bazlı ek filtreleme yapılır
4. Siparişler tabloda gösterilir
5. Kullanıcı "Görüntüle" butonuna tıklayarak detay sayfasına gider (encoded ID ile)
6. Detay sayfasında onay yetkisi kontrol edilir
7. Onay formu doldurulur ve onay işlemi yapılır
8. Onay sonrası bir sonraki adımın yetkililerine SMS gönderilir
9. Pencere kapanır ve liste sayfası otomatik yenilenir

