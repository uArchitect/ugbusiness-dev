# Hızlı Satış Oluştur Form Alanları

## Form Submit Edildiğinde Gönderilen Alanlar (Array - Çoklu Ürün)

### Hidden Input (Array) - Tabloya Eklenen Ürünler İçin:
1. **merkez_id** (hidden input) - Tek değer
2. **urun[]** (hidden input - array) - Ürün ID
3. **baslik[]** (hidden input - array) - Base64 encoded JSON array (çoklu seçim checkbox'lardan)
4. **renk[]** (hidden input - array) - Renk ID
5. **satis_fiyati[]** (hidden input - array) - Satış fiyatı
6. **kapora_fiyati[]** (hidden input - array) - Kapora fiyatı
7. **pesinat_fiyati[]** (hidden input - array) - Peşinat fiyatı
8. **fatura_tutari[]** (hidden input - array) - Fatura tutarı
9. **odeme_secenegi[]** (hidden input - array) - 1: Peşin, 2: Vadeli
10. **vade_sayisi[]** (hidden input - array) - Vade sayısı
11. **damla_etiket[]** (hidden input - array) - 0: Hayır, 1: Evet
12. **acilis_ekrani[]** (hidden input - array) - 0: Hayır, 1: Evet
13. **takas_bedeli[]** (hidden input - array) - Takas bedeli
14. **takas_alinan_seri_kod[]** (hidden input - array) - Takas cihaz seri kodu
15. **takas_alinan_model[]** (hidden input - array) - 0: TAKAS YOK, UMEX, ROBOTX, DIGER
16. **takas_alinan_renk[]** (hidden input - array) - Takas cihaz rengi
17. **takas_fotograflari[]** (hidden input - array) - JSON array (fotoğraf URL'leri)
18. **yenilenmis_cihaz_mi[]** (hidden input - array) - 0: Hayır, 1: Evet
19. **hediye_no[]** (hidden input - array) - Hediye ID (0: Hediye Yok)
20. **para_birimi[]** (hidden input - array) - TRY, USD, EUR
21. **siparis_notu[]** (hidden input - array) - Sipariş notu (HTML temizlenmiş)

---

## Modal İçindeki Form Alanları (Ürün Ekleme Modalı)

### SELECT (Tek Seçim):
1. **ekle_urun** (select) - Ürün seçimi (id="ekle_urun", name yok ama JavaScript'te kullanılıyor)
2. **ekle_renk** (select) - Renk seçimi (id="ekle_renk", name="ekle_renk")
3. **para_birimi** (select) - Para birimi (TRY, USD, EUR)
4. **odeme_secenegi** (select) - Ödeme seçeneği (id="odeme_secenegi", name yok)
   - 1: Peşin Satış
   - 2: Vadeli Satış
5. **takas_alinan_model** (select) - Takas cihaz modeli (id="takas_alinan_model", name yok)
   - "" (boş): SEÇİM YAPINIZ
   - "0": TAKAS YOK
   - "UMEX": UMEX
   - "ROBOTX": ROBOTX
   - "DIGER": DIGER
6. **damla_etiket** (select) - Damla etiket (id="damla_etiket", name yok)
   - 0: Hayır
   - 1: Evet
7. **acilis_ekrani** (select) - Açılış ekranı (id="acilis_ekrani", name yok)
   - 0: Hayır
   - 1: Evet
8. **yenilenmis_cihaz_mi** (select) - Yenilenmiş cihaz mı (name="yenilenmis_cihaz_mi", id="yenilenmis_cihaz_mi")
   - "" (boş): Seçim Yapılmadı
   - "1": EVET
   - "0": HAYIR
9. **hediye_no** (select) - Hediye seçimi (name="hediye_varmi", id="hediye_no")
   - "" (boş): Hediye Seçimi Yapınız
   - "0": Hediye Yok
   - [siparis_hediye_id]: Hediye ID'leri

### INPUT (Text/Number):
1. **vade_sayisi** (input number) - Vade sayısı (id="vade_sayisi", name yok)
2. **ekle_satis_fiyati** (input text) - Satış fiyatı (id="ekle_satis_fiyati", name yok)
3. **ekle_kapora_fiyati** (input text) - Kapora fiyatı (id="ekle_kapora_fiyati", name yok)
4. **pesinat_fiyati** (input text) - Peşinat fiyatı (id="pesinat_fiyati", name yok)
5. **fatura_tutari** (input number) - Fatura tutarı (id="fatura_tutari", name yok)
6. **takas_bedeli** (input text) - Takas bedeli (id="takas_bedeli", name yok)
7. **takas_alinan_seri_kod** (input text) - Takas cihaz seri kodu (id="takas_alinan_seri_kod", name yok)
8. **takas_alinan_renk** (input text) - Takas cihaz rengi (id="takas_alinan_renk", name yok)

### CHECKBOX (Çoklu Seçim):
1. **baslik_select[]** (checkbox - array) - Başlık seçimi (name="baslik_select[]", çoklu seçim)
   - Her checkbox'ın value'su: baslik_id
   - data-name attribute'u: baslik_adi

### FILE INPUT (Çoklu Seçim):
1. **takas_fotograf_input** (file input - multiple) - Takas fotoğrafları (id="takas_fotograf_input", name yok, multiple)

### TEXTAREA:
1. **siparis_notu** (textarea) - Sipariş notu (name="siparis_notu", id="summernotesiparisnot")

---

## Özet - Tipine Göre Gruplandırma

### ARRAY (Çoklu Değer - Her Ürün İçin):
- urun[]
- baslik[] (Base64 encoded JSON array)
- renk[]
- satis_fiyati[]
- kapora_fiyati[]
- pesinat_fiyati[]
- fatura_tutari[]
- odeme_secenegi[]
- vade_sayisi[]
- damla_etiket[]
- acilis_ekrani[]
- takas_bedeli[]
- takas_alinan_seri_kod[]
- takas_alinan_model[]
- takas_alinan_renk[]
- takas_fotograflari[] (JSON array)
- yenilenmis_cihaz_mi[]
- hediye_no[]
- para_birimi[]
- siparis_notu[]

### TEK DEĞER:
- merkez_id (hidden)

### MODAL İÇİNDE (JavaScript ile tabloya ekleniyor):
- **SELECT**: ekle_renk, para_birimi, odeme_secenegi, takas_alinan_model, damla_etiket, acilis_ekrani, yenilenmis_cihaz_mi, hediye_no
- **INPUT**: vade_sayisi, ekle_satis_fiyati, ekle_kapora_fiyati, pesinat_fiyati, fatura_tutari, takas_bedeli, takas_alinan_seri_kod, takas_alinan_renk
- **CHECKBOX (Çoklu)**: baslik_select[]
- **FILE (Çoklu)**: takas_fotograf_input (multiple)
- **TEXTAREA**: siparis_notu

