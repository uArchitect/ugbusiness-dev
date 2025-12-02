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
                  ['url' => 'siparis/satis_limitleri', 'title' => 'SATIŞ LİMİTLERİ', 'icon' => 'fas fa-chart-line', 'icon_color' => '#ffc107', 'desc' => 'Satış limit yönetimi'],
                  ['url' => 'siparis/siparis_kisa_yollar', 'title' => 'KISA YOLLAR', 'icon' => 'fas fa-bolt', 'icon_color' => '#ffc107', 'desc' => 'Sipariş kısa yolları'],
                ]
              ],
              'TALEP' => [
                'icon' => 'fas fa-people-arrows',
                'moduller' => [
                  ['url' => 'talep/ekle', 'title' => 'YENİ TALEP', 'icon' => 'fas fa-plus', 'icon_color' => '#ffc107', 'desc' => 'Yeni talep ekle'],
                  ['url' => 'tum-taleplerim', 'title' => 'TÜM TALEPLERİM', 'icon' => 'fa fa-list-alt', 'icon_color' => '#17a2b8', 'desc' => 'Tüm taleplerim'],
                  ['url' => 'bekleyen-talepler', 'title' => 'BEKLEYEN TALEPLER', 'icon' => 'fa fa-list-alt', 'icon_color' => '#ffc107', 'desc' => 'Bekleyen talepler'],
                  ['url' => 'rut/rut_tanimlari', 'title' => 'RUT PLANLAMA', 'icon' => 'fas fa-map-signs', 'icon_color' => '#28a745', 'desc' => 'Rut planlama'],
                  ['url' => 'rut/rut_tanimlari', 'title' => 'RUT LİSTESİ', 'icon' => 'far fa-circle', 'icon_color' => '#17a2b8', 'desc' => 'Rut listesi'],
                  ['url' => 'satis-talepler', 'title' => 'SATIŞ', 'icon' => 'fa fa-list-alt', 'icon_color' => '#28a745', 'desc' => 'Satış yapılan talepler'],
                  ['url' => 'talep', 'title' => 'TALEP HAVUZU', 'icon' => 'far fa-folder-open', 'icon_color' => '#17a2b8', 'desc' => 'Talep havuzu'],
                ]
              ],
              'PERSONEL' => [
                'icon' => 'fas fa-user-tie',
                'moduller' => [
                  ['url' => 'kullanici', 'title' => 'PERSONEL LİSTESİ', 'icon' => 'fas fa-users', 'icon_color' => '#17a2b8', 'desc' => 'Tüm personelleri görüntüle'],
                  ['url' => 'anasayfa/rehber', 'title' => 'PERSONEL REHBER', 'icon' => 'fas fa-address-book', 'icon_color' => '#17a2b8', 'desc' => 'Personel iletişim bilgileri'],
                  ['url' => 'izin/talebi_olustur', 'title' => 'İZİN TALEBİ', 'icon' => 'fas fa-calendar-check', 'icon_color' => '#28a745', 'desc' => 'Yeni izin talebi oluştur'],
                  ['url' => 'izin', 'title' => 'İZİN YÖNETİMİ', 'icon' => 'fas fa-user-clock', 'icon_color' => '#dc3545', 'desc' => 'İzin ve mesai kontrolü'],
                  ['url' => 'api/kart_okutmayan_personeller_view', 'title' => 'MESAİ BAKIŞ', 'icon' => 'fas fa-clock', 'icon_color' => '#ffc107', 'desc' => 'Mesai genel görünüm'],
                  ['url' => 'bordro', 'title' => 'BORDRO', 'icon' => 'fas fa-file-invoice', 'icon_color' => '#17a2b8', 'desc' => 'Bordro yönetimi'],
                ]
              ],
              'MÜŞTERİ' => [
                'icon' => 'fas fa-users',
                'moduller' => [
                  ['url' => 'musteri', 'title' => 'TÜM MÜŞTERİLER', 'icon' => 'fas fa-users', 'icon_color' => '#ffffff', 'desc' => 'Müşteri listesi'],
                  ['url' => 'cihaz/cihaz_tanimlama_view', 'title' => 'YENİ CİHAZ', 'icon' => 'fas fa-plus-circle', 'icon_color' => '#ffc107', 'desc' => 'Yeni cihaz tanımla'],
                  ['url' => 'cihaz/tum-cihazlar', 'title' => 'TÜM CİHAZLAR', 'icon' => 'fas fa-microchip', 'icon_color' => '#28a745', 'desc' => 'Cihaz listesi'],
                  ['url' => 'cihaz/showrooms', 'title' => 'SHOWROOM', 'icon' => 'fas fa-store', 'icon_color' => '#ffc107', 'desc' => 'Showroom cihaz listesi'],
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
                  ['url' => 'cihaz/cihaz_tanimlama_view', 'title' => 'YENİ CİHAZ KAYIT', 'icon' => 'fas fa-plus-circle', 'icon_color' => '#ffc107', 'desc' => 'Yeni cihaz kayıt'],
                  ['url' => 'cihaz/tum-cihazlar?durum=stok', 'title' => 'CİHAZ HAVUZU', 'icon' => 'fas fa-database', 'icon_color' => '#17a2b8', 'desc' => 'Cihaz havuzu (stok)'],
                  ['url' => 'zimmet/fabrika_zimmet', 'title' => 'FABRİKA ZİMMET', 'icon' => 'fas fa-battery-full', 'icon_color' => '#dc3545', 'desc' => 'Zimmet takip yönetimi'],
                ]
              ],
              'TEKNİK SERVİS' => [
                'icon' => 'fas fa-tools',
                'moduller' => [
                  ['url' => 'servis/servis_cihaz_sorgula_view', 'title' => 'SERVİS SORGULA', 'icon' => 'fas fa-search', 'icon_color' => '#17a2b8', 'desc' => 'Servis cihaz sorgula'],
                  ['url' => 'baslik', 'title' => 'BAŞLIK YÖNETİMİ', 'icon' => 'fas fa-heading', 'icon_color' => '#ffc107', 'desc' => 'Başlık yönetimi'],
                ]
              ],
              'RAPORLAR' => [
                'icon' => 'fas fa-chart-bar',
                'moduller' => [
                  ['url' => 'rapor', 'title' => 'RAPORLAR', 'icon' => 'fas fa-chart-line', 'icon_color' => '#17a2b8', 'desc' => 'Rapor yönetimi'],
                ]
              ],
              'ENTEGRASYON' => [
                'icon' => 'fas fa-plug',
                'moduller' => [
                  ['url' => 'trendyol', 'title' => 'TRENDYOL', 'icon' => 'fab fa-trendyol', 'icon_color' => '#ffc107', 'desc' => 'Trendyol entegrasyonu'],
                ]
              ],
              'SİSTEM' => [
                'icon' => 'fas fa-cog',
                'moduller' => [
                  ['url' => 'kullanici', 'title' => 'KULLANICILAR', 'icon' => 'fa fa-users', 'icon_color' => '#17a2b8', 'desc' => 'Kullanıcı yönetimi'],
                  ['url' => 'kullanici-yetkileri', 'title' => 'KULLANICI YETKİLERİ', 'icon' => 'fa fa-lock', 'icon_color' => '#dc3545', 'desc' => 'Yetki yönetimi'],
                  ['url' => 'urun', 'title' => 'ÜRÜN', 'icon' => 'fa fa-building', 'icon_color' => '#17a2b8', 'desc' => 'Ürün yönetimi'],
                  ['url' => 'departman', 'title' => 'DEPARTMANLAR', 'icon' => 'fa fa-building', 'icon_color' => '#17a2b8', 'desc' => 'Departman yönetimi'],
                  ['url' => 'sehir', 'title' => 'İL - İLÇE', 'icon' => 'fa fa-map-pin', 'icon_color' => '#28a745', 'desc' => 'İl-İlçe bilgileri'],
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
                        <div class="demo-module-icon-wrapper" style="background: linear-gradient(135deg, <?=$modul['icon_color']?>15 0%, <?=$modul['icon_color']?>05 100%);">
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
    background: linear-gradient(135deg, #001657 0%, #002a7a 100%);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    padding: 16px;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    cursor: pointer;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
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
    box-shadow: 0 12px 32px rgba(255, 193, 7, 0.3);
    border-color: #ffc107;
    background: linear-gradient(135deg, #002a7a 0%, #001657 100%);
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
    background: rgba(255, 255, 255, 0.1) !important;
    backdrop-filter: blur(10px);
  }

  .demo-module-icon-wrapper::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    transform: translate(-50%, -50%);
    transition: width 0.4s, height 0.4s;
  }

  .demo-module-card:hover .demo-module-icon-wrapper {
    transform: scale(1.1) rotate(5deg);
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
