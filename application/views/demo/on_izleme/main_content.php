<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top: 25px; background-color: #f8f9fa;">
  <section class="content pr-0">
    <div class="row">
      <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
          <!-- Card Header -->
          <div class="card-header border-0" style="background: linear-gradient(135deg, #001657 0%, #001657 100%); padding: 18px 25px;">
            <div class="d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3" style="width: 40px; height: 40px; background-color: rgba(255,255,255,0.2);">
                  <i class="fas fa-th-large" style="color: #ffffff; font-size: 18px;"></i>
                </div>
                <div>
                  <h3 class="mb-0" style="color: #ffffff; font-weight: 700; font-size: 20px; letter-spacing: 0.5px; line-height: 1.2;">
                    Demo Ön İzleme - Tüm Modüller
                  </h3>
                  <small style="color: rgba(255,255,255,0.9); font-size: 13px; line-height: 1.4;">Sidebar menü gruplarının önizlemesi</small>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Card Body -->
          <div class="card-body" style="padding: 20px; background-color: #ffffff;">
            
            <?php
            // Modül kategorileri ve modülleri
            $modul_kategorileri = [
              'HIZLI ERİŞİM' => [
                'icon' => 'fas fa-bolt',
                'moduller' => [
                  ['url' => 'anasayfa', 'title' => 'ANASAYFA', 'icon' => 'fas fa-home', 'icon_color' => '#ffc107', 'desc' => 'Ana kontrol paneli'],
                  ['url' => 'yazilim', 'title' => 'YAPILACAK İŞLER', 'icon' => 'fas fa-tasks', 'icon_color' => '#ffc107', 'desc' => 'Görev takip listesi'],
                  ['url' => 'abonelik', 'title' => 'ABONELİKLER', 'icon' => 'far fa-folder-open', 'icon_color' => '#17a2b8', 'desc' => 'Abonelik yönetimi'],
                  ['url' => 'sablon/index/26', 'title' => 'ŞİRKET KURALLARI', 'icon' => 'fas fa-gavel', 'icon_color' => '#dc3545', 'desc' => 'Şirket içi kurallar'],
                ]
              ],
              'SİPARİŞLER' => [
                'icon' => 'fas fa-shopping-cart',
                'moduller' => [
                  ['url' => 'siparis/hizli_siparis_olustur_view', 'title' => 'HIZLI SİPARİŞ', 'icon' => 'fas fa-plus-circle', 'icon_color' => '#ffc107', 'desc' => 'Hızlı sipariş oluştur'],
                  ['url' => 'onay-bekleyen-siparisler', 'title' => 'ONAY BEKLEYENLER', 'icon' => 'far fa-check-circle', 'icon_color' => '#28a745', 'desc' => 'Onay bekleyen siparişler'],
                  ['url' => 'tum-siparisler', 'title' => 'TÜM SİPARİŞLER', 'icon' => 'far fa-folder-open', 'icon_color' => '#17a2b8', 'desc' => 'Tüm siparişleri görüntüle'],
                  ['url' => 'siparis/haftalik_kurulum_plan', 'title' => 'KURULUM PLANI', 'icon' => 'far fa-calendar-alt', 'icon_color' => '#ffc107', 'desc' => 'Haftalık kurulum planı'],
                  ['url' => 'cihaz/iptal_edilen_siparisler', 'title' => 'İPTAL EDİLENLER', 'icon' => 'fas fa-ban', 'icon_color' => '#dc3545', 'desc' => 'İptal edilen siparişler'],
                  ['url' => 'siparis/degerlendirme_rapor', 'title' => 'SMS SONUÇLARI', 'icon' => 'fas fa-envelope', 'icon_color' => '#17a2b8', 'desc' => 'SMS değerlendirme raporu'],
                  ['url' => 'fiyat_limit', 'title' => 'FİYAT LİMİTLERİ', 'icon' => 'far fa-circle', 'icon_color' => '#ffc107', 'desc' => 'Fiyat limit yönetimi'],
                  ['url' => 'siparis/siparis_kisa_yollar', 'title' => 'KISA YOLLAR', 'icon' => 'fas fa-bolt', 'icon_color' => '#ffc107', 'desc' => 'Sipariş kısa yolları'],
                ]
              ],
              'TALEP' => [
                'icon' => 'fas fa-people-arrows',
                'moduller' => [
                  ['url' => 'talep/ekle', 'title' => 'YENİ TALEP', 'icon' => 'fas fa-plus', 'icon_color' => '#ffc107', 'desc' => 'Yeni talep ekle'],
                  ['url' => 'tum-taleplerim', 'title' => 'TÜM TALEPLERİM', 'icon' => 'fa fa-list-alt', 'icon_color' => '#17a2b8', 'desc' => 'Tüm taleplerim'],
                  ['url' => 'bekleyen-talepler', 'title' => 'BEKLEYEN TALEPLER', 'icon' => 'fa fa-list-alt', 'icon_color' => '#ffc107', 'desc' => 'Bekleyen talepler'],
                  ['url' => 'rut', 'title' => 'RUT PLANLAMA', 'icon' => 'fas fa-map-signs', 'icon_color' => '#28a745', 'desc' => 'Rut planlama'],
                  ['url' => 'rut/rut_tanimlari', 'title' => 'RUT LİSTESİ', 'icon' => 'far fa-circle', 'icon_color' => '#17a2b8', 'desc' => 'Rut listesi'],
                  ['url' => 'satis-talepler', 'title' => 'SATIŞ', 'icon' => 'fa fa-list-alt', 'icon_color' => '#28a745', 'desc' => 'Satış yapılan talepler'],
                  ['url' => 'bilgi-verildi-talepler', 'title' => 'BİLGİ VERİLDİ', 'icon' => 'fa fa-list-alt', 'icon_color' => '#17a2b8', 'desc' => 'Bilgi verilen talepler'],
                  ['url' => 'musteri-memnuniyeti-talepler', 'title' => 'MÜŞTERİ MEMNUNİYETİ', 'icon' => 'fa fa-list-alt', 'icon_color' => '#28a745', 'desc' => 'Müşteri memnuniyet talepleri'],
                  ['url' => 'donus-yapilacak-talepler', 'title' => 'DÖNÜŞ YAPILACAK', 'icon' => 'fa fa-list-alt', 'icon_color' => '#ffc107', 'desc' => 'Dönüş yapılacak talepler'],
                  ['url' => 'olumsuz-talepler', 'title' => 'OLUMSUZ', 'icon' => 'fa fa-list-alt', 'icon_color' => '#dc3545', 'desc' => 'Olumsuz talepler'],
                  ['url' => 'numara-hatali-talepler', 'title' => 'NUMARA HATALI', 'icon' => 'fa fa-list-alt', 'icon_color' => '#6c757d', 'desc' => 'Numara hatalı talepler'],
                  ['url' => 'tekrar-aranacak-talepler', 'title' => 'TEKRAR ARANACAK', 'icon' => 'fa fa-list-alt', 'icon_color' => '#ffc107', 'desc' => 'Tekrar aranacak talepler'],
                  ['url' => 'talep/yonlendirmeler/1', 'title' => 'YÖNLENDİRİLENLER', 'icon' => 'far fa-file-archive', 'icon_color' => '#17a2b8', 'desc' => 'Yönlendirilen talepler'],
                  ['url' => 'musteri/karaliste_view', 'title' => 'KARA LİSTE', 'icon' => 'fa fa-list-alt', 'icon_color' => '#dc3545', 'desc' => 'Kara liste yönetimi'],
                  ['url' => 'talep/bekleyen_rapor', 'title' => 'TALEP UYARI SMS', 'icon' => 'fas fa-user-clock', 'icon_color' => '#ffc107', 'desc' => 'Talep uyarı SMS gönder'],
                  ['url' => 'talep', 'title' => 'TALEP HAVUZU', 'icon' => 'far fa-folder-open', 'icon_color' => '#17a2b8', 'desc' => 'Talep havuzu'],
                ]
              ],
              'PERSONEL' => [
                'icon' => 'fas fa-user-tie',
                'moduller' => [
                  ['url' => 'kullanici', 'title' => 'PERSONEL LİSTESİ', 'icon' => 'fas fa-users', 'icon_color' => '#17a2b8', 'desc' => 'Tüm personelleri görüntüle'],
                  ['url' => 'anasayfa/rehber', 'title' => 'PERSONEL REHBER', 'icon' => 'fas fa-address-book', 'icon_color' => '#17a2b8', 'desc' => 'Personel iletişim bilgileri'],
                  ['url' => 'izin/talebi_olustur', 'title' => 'İZİN TALEBİ', 'icon' => 'fas fa-calendar-check', 'icon_color' => '#28a745', 'desc' => 'Yeni izin talebi oluştur'],
                  ['url' => 'izin/onay_bekleyenler', 'title' => 'İZİN TALEPLERİM', 'icon' => 'far fa-list-alt', 'icon_color' => '#17a2b8', 'desc' => 'İzin taleplerim'],
                  ['url' => 'izin/onay_bekleyenler', 'title' => 'ONAY BEKLEYEN İZİNLER', 'icon' => 'far fa-list-alt', 'icon_color' => '#ffc107', 'desc' => 'Onay bekleyen izinler'],
                  ['url' => 'izin', 'title' => 'İZİN YÖNETİMİ', 'icon' => 'fas fa-user-clock', 'icon_color' => '#dc3545', 'desc' => 'İzin ve mesai kontrolü'],
                  ['url' => 'api/kart_okutmayan_personeller_view', 'title' => 'MESAİ BAKIŞ', 'icon' => 'fas fa-clock', 'icon_color' => '#ffc107', 'desc' => 'Mesai genel görünüm'],
                  ['url' => 'bordro', 'title' => 'BORDRO', 'icon' => 'fas fa-file-invoice', 'icon_color' => '#17a2b8', 'desc' => 'Bordro yönetimi'],
                  ['url' => 'bordro/add', 'title' => 'YENİ BORDRO', 'icon' => 'fa fa-plus', 'icon_color' => '#28a745', 'desc' => 'Yeni bordro yükle'],
                ]
              ],
              'MÜŞTERİ' => [
                'icon' => 'fas fa-users',
                'moduller' => [
                  ['url' => 'musteri', 'title' => 'TÜM MÜŞTERİLER', 'icon' => 'fas fa-users', 'icon_color' => '#ffffff', 'desc' => 'Müşteri listesi'],
                  ['url' => 'cihaz/cihaz_tanimlama_view', 'title' => 'YENİ CİHAZ', 'icon' => 'fas fa-plus-circle', 'icon_color' => '#ffc107', 'desc' => 'Yeni cihaz tanımla'],
                  ['url' => 'cihaz/tum-cihazlar', 'title' => 'TÜM CİHAZLAR', 'icon' => 'fas fa-microchip', 'icon_color' => '#28a745', 'desc' => 'Cihaz listesi'],
                  ['url' => 'cihaz/tum-cihazlar?durum=iade', 'title' => 'İADE CİHAZLAR', 'icon' => 'fas fa-undo', 'icon_color' => '#dc3545', 'desc' => 'İade cihazları'],
                  ['url' => 'cihaz/tum-cihazlar?durum=takas', 'title' => 'TAKAS CİHAZLAR', 'icon' => 'fas fa-exchange-alt', 'icon_color' => '#6c757d', 'desc' => 'Takas cihazları'],
                  ['url' => 'cihaz/borclu_cihazlar', 'title' => 'BORÇLU MÜŞTERİLER', 'icon' => 'far fa-circle', 'icon_color' => '#dc3545', 'desc' => 'Borçlu müşteriler'],
                  ['url' => 'cihaz/tumcihazlarilbazli', 'title' => 'İL BAZLI CİHAZLAR', 'icon' => 'far fa-building', 'icon_color' => '#17a2b8', 'desc' => 'İl bazlı cihaz listesi'],
                  ['url' => 'cihaz/showrooms', 'title' => 'SHOWROOM', 'icon' => 'fas fa-store', 'icon_color' => '#ffc107', 'desc' => 'Showroom cihaz listesi'],
                  ['url' => 'cihaz/rgmedikalindex', 'title' => 'RG MEDİKAL', 'icon' => 'far fa-circle', 'icon_color' => '#28a745', 'desc' => 'RG Medikal yönetimi'],
                  ['url' => 'merkez', 'title' => 'MERKEZLER', 'icon' => 'far fa-building', 'icon_color' => '#17a2b8', 'desc' => 'Merkez listesi'],
                ]
              ],
              'STOK / ÜRÜN' => [
                'icon' => 'fas fa-box',
                'moduller' => [
                  ['url' => 'stok', 'title' => 'STOK', 'icon' => 'fas fa-boxes', 'icon_color' => '#dc3545', 'desc' => 'Stok yönetimi'],
                  ['url' => 'stok/giris_stok_kayitlari', 'title' => 'STOK ENVANTER', 'icon' => 'fas fa-clipboard-list', 'icon_color' => '#17a2b8', 'desc' => 'Stok envanter takibi'],
                  ['url' => 'depo_onay', 'title' => 'DEPO YÖNETİMİ', 'icon' => 'fas fa-warehouse', 'icon_color' => '#17a2b8', 'desc' => 'Giriş-çıkış takibi'],
                ]
              ],
              'ÜRETİM' => [
                'icon' => 'fas fa-industry',
                'moduller' => [
                  ['url' => 'uretim_planlama', 'title' => 'ÜRETİM PLANLAMA', 'icon' => 'fas fa-industry', 'icon_color' => '#6c757d', 'desc' => 'Üretim planı yönetimi'],
                  ['url' => 'cihaz/cihaz_havuz_tanimla_view', 'title' => 'YENİ CİHAZ KAYIT', 'icon' => 'fas fa-plus-circle', 'icon_color' => '#ffc107', 'desc' => 'Yeni cihaz kayıt'],
                  ['url' => 'cihaz/cihaz_havuz_liste_view', 'title' => 'CİHAZ HAVUZU', 'icon' => 'fas fa-database', 'icon_color' => '#17a2b8', 'desc' => 'Cihaz havuzu (stok)'],
                  ['url' => 'baslik/baslik_havuz_tanimla_view', 'title' => 'YENİ BAŞLIK QR', 'icon' => 'fa fa-plus-circle', 'icon_color' => '#ffc107', 'desc' => 'Yeni başlık QR (üretim)'],
                  ['url' => 'baslik/baslik_havuz_liste_view', 'title' => 'BAŞLIK HAVUZU', 'icon' => 'fa fa-list', 'icon_color' => '#17a2b8', 'desc' => 'Başlık havuzu (yeniler)'],
                  ['url' => 'zimmet/fabrika_zimmet', 'title' => 'FABRİKA ZİMMET', 'icon' => 'fas fa-battery-full', 'icon_color' => '#dc3545', 'desc' => 'Zimmet takip yönetimi'],
                ]
              ],
              'TEKNİK SERVİS' => [
                'icon' => 'fas fa-tools',
                'moduller' => [
                  ['url' => 'servis', 'title' => 'CİHAZ TEKNİK SERVİS', 'icon' => 'fa fa-list', 'icon_color' => '#28a745', 'desc' => 'Cihaz teknik servis'],
                  ['url' => 'servis/servis_cihaz_sorgula_view', 'title' => 'SERVİS SORGULA', 'icon' => 'fas fa-search', 'icon_color' => '#17a2b8', 'desc' => 'Servis cihaz sorgula'],
                  ['url' => 'baslik/isleme_alinan_basliklar', 'title' => 'İŞLEME ALINAN', 'icon' => 'fa fas fa-retweet', 'icon_color' => '#ffc107', 'desc' => 'İşleme alınan başlıklar'],
                  ['url' => 'baslik/tamamlanan_basliklar', 'title' => 'TAMAMLANAN', 'icon' => 'fa fas fa-check', 'icon_color' => '#28a745', 'desc' => 'Tamamlanan başlıklar'],
                  ['url' => 'cihaz/tum-basliklar', 'title' => 'BAŞLIK TANIMLARI', 'icon' => 'far fa-folder-open', 'icon_color' => '#17a2b8', 'desc' => 'Başlık tanımları'],
                  ['url' => 'baslik/baslik_havuz_tanimla_view', 'title' => 'YENİ BAŞLIK QR', 'icon' => 'fa fa-plus-circle', 'icon_color' => '#ffc107', 'desc' => 'Yeni başlık QR (üretim)'],
                  ['url' => 'baslik/baslik_havuz_liste_view', 'title' => 'BAŞLIK HAVUZU', 'icon' => 'fa fa-list', 'icon_color' => '#17a2b8', 'desc' => 'Başlık havuzu (yeniler)'],
                  ['url' => 'stok/urungonderim', 'title' => 'HAVA HORT. GÖNDERİM', 'icon' => 'fa fa-list', 'icon_color' => '#ffc107', 'desc' => 'Hava hortumu gönderim'],
                  ['url' => 'baslik/iade_etiket', 'title' => 'İADE ETİKETİ', 'icon' => 'fa fa-list', 'icon_color' => '#dc3545', 'desc' => 'İade etiketi yazdır'],
                ]
              ],
              'RAPORLAR' => [
                'icon' => 'fas fa-chart-bar',
                'moduller' => [
                  ['url' => 'kullanici/muhasebe_rapor/'.date('m'), 'title' => 'MUHASEBE RAPOR', 'icon' => 'far fa-circle', 'icon_color' => '#17a2b8', 'desc' => 'Muhasebe raporu'],
                  ['url' => 'talep/rapor', 'title' => 'TALEP ANALİZ', 'icon' => 'far fa-circle', 'icon_color' => '#ffc107', 'desc' => 'Talep analiz raporu'],
                  ['url' => 'talep/yogunluk_haritasi', 'title' => 'YOĞUNLUK HARİTASI', 'icon' => 'far fa-circle', 'icon_color' => '#28a745', 'desc' => 'Talep yoğunluk haritası'],
                  ['url' => 'talep/bekleyen_rapor_list', 'title' => 'BEKLEYEN TALEPLER', 'icon' => 'far fa-circle', 'icon_color' => '#ffc107', 'desc' => 'Bekleyen talepler raporu'],
                  ['url' => 'cihaz/garanti_sorgulayanlar', 'title' => 'GARANTİ SORGULAYANLAR', 'icon' => 'far fa-circle', 'icon_color' => '#17a2b8', 'desc' => 'Garanti sorgulayanlar'],
                  ['url' => 'cihaz/cihaz_harita', 'title' => 'CİHAZ HARİTA', 'icon' => 'far fa-id-card', 'icon_color' => '#28a745', 'desc' => 'Cihaz raporu (harita)'],
                  ['url' => 'cihaz/rg_medikal_cihaz_harita', 'title' => 'RG CİHAZ HARİTA', 'icon' => 'far fa-id-card', 'icon_color' => '#17a2b8', 'desc' => 'RG cihaz raporu (harita)'],
                  ['url' => 'siparis/degerlendirme_rapor', 'title' => 'SMS SONUÇLARI', 'icon' => 'fa fa-list', 'icon_color' => '#17a2b8', 'desc' => 'SMS değerlendirme raporu'],
                  ['url' => 'atis', 'title' => 'ATIŞ RAPORU', 'icon' => 'fa fa-list', 'icon_color' => '#dc3545', 'desc' => 'Atış raporu'],
                ]
              ],
              'ENTEGRASYON' => [
                'icon' => 'fas fa-plug',
                'moduller' => [
                  ['url' => 'trendyol', 'title' => 'TRENDYOL', 'icon' => 'fab fa-trendyol', 'icon_color' => '#ffc107', 'desc' => 'Trendyol entegrasyonu'],
                  ['url' => 'arvento', 'title' => 'ARVENTO', 'icon' => 'fas fa-truck', 'icon_color' => '#ffc107', 'desc' => 'Arvento entegrasyonu'],
                  ['url' => 'calisma_plan', 'title' => 'ÇALIŞMA PLANLAMA', 'icon' => 'fas fa-clock', 'icon_color' => '#28a745', 'desc' => 'Çalışma planlama'],
                  ['url' => 'teklif_form', 'title' => 'TEKLİF FORMLARI', 'icon' => 'far fa-circle', 'icon_color' => '#17a2b8', 'desc' => 'Teklif form yönetimi'],
                  ['url' => 'kapi', 'title' => 'KAPI', 'icon' => 'fas fa-door-open', 'icon_color' => '#dc3545', 'desc' => 'Kapı yönetimi'],
                  ['url' => 'onemli_gun', 'title' => 'ÖNEMLİ GÜNLER', 'icon' => 'fas fa-calendar', 'icon_color' => '#17a2b8', 'desc' => 'Önemli günler yönetimi'],
                  ['url' => 'onemli_gun/index_etkinlik', 'title' => 'YAKLAŞAN ETKİNLİKLER', 'icon' => 'fas fa-calendar', 'icon_color' => '#ffc107', 'desc' => 'Yaklaşan etkinlikler'],
                  ['url' => 'paylasim', 'title' => 'KAMPANYALAR', 'icon' => 'fas fa-calendar', 'icon_color' => '#28a745', 'desc' => 'Kampanya yönetimi'],
                ]
              ],
              'ENVANTER' => [
                'icon' => 'fas fa-box',
                'moduller' => [
                  ['url' => 'demirbas/ekle/1', 'title' => 'YENİ ENVANTER', 'icon' => 'fa fa-plus', 'icon_color' => '#28a745', 'desc' => 'Yeni envanter ekle'],
                  ['url' => 'demirbas', 'title' => 'TÜM ENVANTERLER', 'icon' => 'far fa-file-alt', 'icon_color' => '#17a2b8', 'desc' => 'Tüm envanterler'],
                ]
              ],
              'SERTİFİKA' => [
                'icon' => 'fas fa-award',
                'moduller' => [
                  ['url' => 'cihaz', 'title' => 'YENİ EĞİTİM', 'icon' => 'fa fa-plus', 'icon_color' => '#28a745', 'desc' => 'Yeni eğitim ekle'],
                  ['url' => 'sertifika/onay-bekleyen-sertifikalar', 'title' => 'ONAYLANACAK', 'icon' => 'far fa-check-circle', 'icon_color' => '#ffc107', 'desc' => 'Onaylanacak sertifikalar'],
                  ['url' => 'sertifika/uretilecek-sertifikalar', 'title' => 'ÜRETİLECEK', 'icon' => 'far fa-id-card', 'icon_color' => '#17a2b8', 'desc' => 'Üretilecek sertifikalar'],
                  ['url' => 'sertifika/uretilecek-kalemler', 'title' => 'KALEMLER', 'icon' => 'fas fa-pen-alt', 'icon_color' => '#6c757d', 'desc' => 'Üretilecek kalemler'],
                  ['url' => 'sertifika/kargo-bekleyen-sertifikalar', 'title' => 'KARGO BEKLEYENLER', 'icon' => 'fas fa-truck-loading', 'icon_color' => '#ffc107', 'desc' => 'Kargo bekleyen sertifikalar'],
                  ['url' => 'egitim', 'title' => 'TÜM EĞİTİMLER', 'icon' => 'fa fa-list-alt', 'icon_color' => '#17a2b8', 'desc' => 'Tüm eğitimler'],
                ]
              ],
              'ARAÇ' => [
                'icon' => 'fas fa-car',
                'moduller' => [
                  ['url' => 'arac', 'title' => 'ŞİRKET ARAÇLARI', 'icon' => 'fas fa-car', 'icon_color' => '#28a745', 'desc' => 'Şirket araç yönetimi'],
                ]
              ],
              'SİSTEM' => [
                'icon' => 'fas fa-cog',
                'moduller' => [
                  ['url' => 'kullanici', 'title' => 'KULLANICILAR', 'icon' => 'fa fa-users', 'icon_color' => '#17a2b8', 'desc' => 'Kullanıcı yönetimi'],
                  ['url' => 'dogum_gunu', 'title' => 'DOĞUM GÜNÜ', 'icon' => 'fa fa-calendar-check', 'icon_color' => '#ffc107', 'desc' => 'Doğum günü bildirimleri'],
                  ['url' => 'kullanici-yetkileri', 'title' => 'KULLANICI YETKİLERİ', 'icon' => 'fa fa-lock', 'icon_color' => '#dc3545', 'desc' => 'Yetki yönetimi'],
                  ['url' => 'urun', 'title' => 'ÜRÜN', 'icon' => 'fa fa-building', 'icon_color' => '#17a2b8', 'desc' => 'Ürün yönetimi'],
                  ['url' => 'departman', 'title' => 'DEPARTMANLAR', 'icon' => 'fa fa-building', 'icon_color' => '#17a2b8', 'desc' => 'Departman yönetimi'],
                  ['url' => 'duyuru-kategori', 'title' => 'DUYURU KATEGORİLERİ', 'icon' => 'fas fa-bullhorn', 'icon_color' => '#ffc107', 'desc' => 'Duyuru kategori yönetimi'],
                  ['url' => 'istek_birim', 'title' => 'İSTEK BİRİMLERİ', 'icon' => 'far fa-life-ring', 'icon_color' => '#17a2b8', 'desc' => 'İstek birim yönetimi'],
                  ['url' => 'istek_kategori', 'title' => 'İSTEK KATEGORİLERİ', 'icon' => 'far fa-life-ring', 'icon_color' => '#17a2b8', 'desc' => 'İstek kategori yönetimi'],
                  ['url' => 'is_tip', 'title' => 'İŞ TİPLERİ', 'icon' => 'far fa-list-alt', 'icon_color' => '#6c757d', 'desc' => 'İş tip yönetimi'],
                  ['url' => 'istek_durum', 'title' => 'İSTEK DURUMLARI', 'icon' => 'far fa-life-ring', 'icon_color' => '#17a2b8', 'desc' => 'İstek durum yönetimi'],
                  ['url' => 'dokuman_kategori', 'title' => 'DÖKÜMAN KATEGORİLERİ', 'icon' => 'far fa-folder', 'icon_color' => '#17a2b8', 'desc' => 'Döküman kategori yönetimi'],
                  ['url' => 'demirbas_kategori', 'title' => 'ENVANTER KATEGORİLERİ', 'icon' => 'far fa-folder', 'icon_color' => '#17a2b8', 'desc' => 'Envanter kategori yönetimi'],
                  ['url' => 'demirbas_birim', 'title' => 'ENVANTER BİRİMLERİ', 'icon' => 'far fa-life-ring', 'icon_color' => '#17a2b8', 'desc' => 'Envanter birim yönetimi'],
                  ['url' => 'kullanici_grup', 'title' => 'KULLANICI GRUPLARI', 'icon' => 'fa fa-users', 'icon_color' => '#17a2b8', 'desc' => 'Kullanıcı grup yönetimi'],
                  ['url' => 'sehir', 'title' => 'İL - İLÇE', 'icon' => 'fa fa-map-pin', 'icon_color' => '#28a745', 'desc' => 'İl-İlçe bilgileri'],
                  ['url' => 'yemek', 'title' => 'YEMEK LİSTESİ', 'icon' => 'fa fa-envelope', 'icon_color' => '#ffc107', 'desc' => 'Yemek listesi yönetimi'],
                  ['url' => 'ayar', 'title' => 'PARAMETRELER', 'icon' => 'fa fa-envelope', 'icon_color' => '#17a2b8', 'desc' => 'Sistem parametreleri'],
                  ['url' => 'ayar/arac_kilometre_ortalamalari', 'title' => 'ARAÇ KM ORTALAMALARI', 'icon' => 'fas fa-tachometer-alt', 'icon_color' => '#6c757d', 'desc' => 'Araç kilometre ortalamaları'],
                  ['url' => 'ariza', 'title' => 'BAŞLIK ARIZA TANIMLARI', 'icon' => 'fa fa-envelope', 'icon_color' => '#dc3545', 'desc' => 'Başlık arıza tanımları'],
                  ['url' => 'logs', 'title' => 'LOG', 'icon' => 'fas fa-power-off', 'icon_color' => '#28a745', 'desc' => 'Sistem log kayıtları'],
                  ['url' => 'sms_templates', 'title' => 'SMS METİNLERİ', 'icon' => 'fas fa-sms', 'icon_color' => '#ffc107', 'desc' => 'SMS metin yönetimi'],
                ]
              ],
            ];
            
            // Her kategori için döngü
            foreach($modul_kategorileri as $kategori_adi => $kategori_data): ?>
              <div class="mb-4">
                <h4 class="mb-3" style="color: #001657; font-weight: 700; font-size: 18px; position: relative; padding-left: 15px;">
                  <i class="<?=$kategori_data['icon']?> mr-2" style="color: #001657;"></i><?=$kategori_adi?>
                  <span style="position: absolute; left: 0; top: 50%; transform: translateY(-50%); width: 4px; height: 24px; background: linear-gradient(180deg, #001657 0%, #ffc107 100%); border-radius: 2px;"></span>
                </h4>
                <div class="demo-module-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 12px;">
                  <?php foreach($kategori_data['moduller'] as $modul): ?>
                    <a href="<?=base_url($modul['url'])?>" class="demo-module-item" style="text-decoration: none; color: inherit;">
                      <div class="demo-module-card">
                        <div class="demo-module-icon-wrapper">
                          <i class="<?=$modul['icon']?>" style="color: <?=$modul['icon_color']?>;"></i>
                        </div>
                        <div class="demo-module-content">
                          <h6 class="demo-module-title"><?=$modul['title']?></h6>
                          <p class="demo-module-desc"><?=$modul['desc']?></p>
                        </div>
                        <div class="demo-module-arrow">
                          <i class="fas fa-arrow-right"></i>
                        </div>
                      </div>
                    </a>
                  <?php endforeach; ?>
                </div>
              </div>
            <?php endforeach; ?>

          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<style>
  .demo-module-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 12px;
  }

  .demo-module-item {
    display: block;
    text-decoration: none;
    color: inherit;
  }

  .demo-module-card {
    position: relative;
    background: #ffffff;
    border: 2px solid #e8ecf1;
    border-radius: 12px;
    padding: 16px;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    cursor: pointer;
    overflow: hidden;
    box-shadow: 0 2px 12px rgba(0, 22, 87, 0.08);
    display: flex;
    flex-direction: column;
    min-height: 120px;
  }

  .demo-module-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: linear-gradient(180deg, #001657 0%, #ffc107 100%);
    transform: scaleY(0);
    transform-origin: bottom;
    transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  }

  .demo-module-card:hover {
    transform: translateY(-6px) scale(1.02);
    box-shadow: 0 12px 32px rgba(0, 22, 87, 0.15);
    border-color: #001657;
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
  }

  .demo-module-card:hover::before {
    transform: scaleY(1);
  }

  .demo-module-icon-wrapper {
    width: 56px;
    height: 56px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 12px;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    position: relative;
    overflow: hidden;
    background: linear-gradient(135deg, rgba(0, 22, 87, 0.08) 0%, rgba(0, 22, 87, 0.03) 100%);
  }

  .demo-module-icon-wrapper::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(0, 22, 87, 0.1);
    transform: translate(-50%, -50%);
    transition: width 0.4s, height 0.4s;
  }

  .demo-module-card:hover .demo-module-icon-wrapper {
    transform: scale(1.1) rotate(5deg);
    background: linear-gradient(135deg, rgba(0, 22, 87, 0.15) 0%, rgba(255, 193, 7, 0.1) 100%);
  }

  .demo-module-card:hover .demo-module-icon-wrapper::after {
    width: 100px;
    height: 100px;
  }

  .demo-module-icon-wrapper i {
    font-size: 28px;
    position: relative;
    z-index: 1;
    transition: all 0.4s;
  }

  .demo-module-card:hover .demo-module-icon-wrapper i {
    transform: scale(1.15);
  }

  .demo-module-content {
    flex: 1;
  }

  .demo-module-title {
    color: #001657;
    font-weight: 700;
    font-size: 14px;
    margin: 0 0 6px 0;
    line-height: 1.3;
    transition: color 0.3s;
  }

  .demo-module-desc {
    color: #6c757d;
    font-size: 12px;
    margin: 0;
    line-height: 1.4;
    transition: color 0.3s;
  }

  .demo-module-card:hover .demo-module-title {
    color: #001657;
  }

  .demo-module-card:hover .demo-module-desc {
    color: #495057;
  }

  .demo-module-arrow {
    position: absolute;
    bottom: 16px;
    right: 16px;
    width: 32px;
    height: 32px;
    border-radius: 8px;
    background: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    opacity: 0;
    transform: translateX(-10px);
  }

  .demo-module-arrow i {
    color: #001657;
    font-size: 14px;
    transition: transform 0.4s;
  }

  .demo-module-card:hover .demo-module-arrow {
    opacity: 1;
    transform: translateX(0);
    background: linear-gradient(135deg, #001657 0%, #ffc107 100%);
  }

  .demo-module-card:hover .demo-module-arrow i {
    color: #ffffff;
    transform: translateX(3px);
  }

  /* Responsive düzenlemeler */
  @media (max-width: 1200px) {
    .demo-module-grid {
      grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
      gap: 10px;
    }
  }

  @media (max-width: 768px) {
    .demo-module-grid {
      grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
      gap: 8px;
    }
    
    .demo-module-card {
      padding: 12px;
      min-height: 110px;
    }
    
    .demo-module-icon-wrapper {
      width: 48px;
      height: 48px;
      margin-bottom: 10px;
    }
    
    .demo-module-icon-wrapper i {
      font-size: 24px;
    }
    
    .demo-module-title {
      font-size: 12px;
    }
    
    .demo-module-desc {
      font-size: 11px;
    }
  }

  @media (max-width: 576px) {
    .demo-module-grid {
      grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
    }
    
    .demo-module-card {
      min-height: 100px;
    }
  }
</style>
