<style>
  /* CSS Variables - Design System */
  :root {
    --tab-height: 56px;
    --tab-padding-x: 20px;
    --tab-padding-y: 16px;
    --tab-color-default: #6b7280;
    --tab-color-hover: #374151;
    --tab-color-active: #001657;
    --tab-bg-hover: #f9fafb;
    --tab-bg-active: #f0f4ff;
    --tab-border-color: #e5e7eb;
    --tab-separator-color: #d1d5db;
    --container-padding: 24px;
    --card-border-radius: 12px;
    --card-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
  }

  /* Modern Tab Navigation - Material 3 / Tailwind Inspired - CRITICAL CSS LOADED FIRST */
  .modern-tabs-nav {
    background-color: #ffffff;
    border-bottom: 1px solid var(--tab-border-color);
    position: relative;
    overflow: hidden;
    margin: 0;
    padding: 0;
  }

  .modern-tabs-container {
    display: flex;
    align-items: stretch;
    overflow-x: auto;
    overflow-y: hidden;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: thin;
    scrollbar-color: var(--tab-separator-color) transparent;
    padding: 0 var(--container-padding);
    margin: 0;
    min-height: var(--tab-height);
    width: 100%;
    box-sizing: border-box;
  }

  .modern-tabs-container::-webkit-scrollbar {
    height: 4px;
  }

  .modern-tabs-container::-webkit-scrollbar-track {
    background: transparent;
  }

  .modern-tabs-container::-webkit-scrollbar-thumb {
    background-color: var(--tab-separator-color);
    border-radius: 2px;
  }

  .modern-tabs-container::-webkit-scrollbar-thumb:hover {
    background-color: #9ca3af;
  }

  /* Tab Item - Default State (Passive) - NO ANIMATIONS */
  .modern-tab {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 8px;
    padding: var(--tab-padding-y) var(--tab-padding-x);
    margin: 0;
    text-decoration: none;
    color: var(--tab-color-default);
    font-size: 14px;
    font-weight: 500;
    white-space: nowrap;
    position: relative;
    border-bottom: 3px solid transparent;
    background-color: transparent;
    cursor: pointer;
    user-select: none;
    -webkit-tap-highlight-color: transparent;
    border-radius: 0;
    flex-shrink: 0;
    box-sizing: border-box;
    min-height: var(--tab-height);
    height: 100%;
    line-height: 1.5;
  }
  
  .modern-tab:first-child {
    margin-left: 0;
    padding-left: 0;
  }
  
  .modern-tab:last-child {
    margin-right: 0;
    padding-right: 0;
  }

  /* Tab Icon - NO ANIMATIONS */
  .modern-tab-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 18px;
    height: 18px;
    font-size: 16px;
    color: var(--tab-color-default);
  }

  .modern-tab-icon i {
    display: block;
    line-height: 1;
  }

  /* Tab Label - NO ANIMATIONS */
  .modern-tab-label {
    letter-spacing: 0.01em;
    color: var(--tab-color-default);
  }

  /* Tab Separator */
  .modern-tab-separator {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: var(--tab-separator-color);
    font-size: 14px;
    font-weight: 300;
    padding: 0 4px;
    user-select: none;
    flex-shrink: 0;
    height: var(--tab-height);
    line-height: var(--tab-height);
  }

  /* Passive Tab States - NO ANIMATIONS */
  .modern-tab:not(.active):hover {
    color: var(--tab-color-hover);
    background-color: var(--tab-bg-hover);
  }

  .modern-tab:not(.active):hover .modern-tab-icon {
    color: var(--tab-color-hover);
  }

  /* Active Tab State - NO ANIMATIONS */
  .modern-tab.active {
    color: var(--tab-color-active);
    background-color: var(--tab-bg-active);
    border-bottom-color: var(--tab-color-active);
    font-weight: 600;
    margin-bottom: -1px;
    position: relative;
    z-index: 1;
  }
  
  .modern-tab.active::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: var(--tab-bg-active);
    z-index: -1;
  }

  .modern-tab.active .modern-tab-icon {
    color: var(--tab-color-active);
  }

  .modern-tab.active .modern-tab-label {
    color: var(--tab-color-active);
  }

  /* Focus State for Accessibility */
  .modern-tab:focus {
    outline: 2px solid var(--tab-color-active);
    outline-offset: -2px;
    border-radius: 4px 4px 0 0;
  }

  .modern-tab:focus:not(:focus-visible) {
    outline: none;
  }

  /* Content Wrapper */
  .content-wrapper-siparis {
    padding-top: 25px;
    background-color: #f8f9fa;
  }

  /* Card Styles */
  .card-siparis {
    border: 0;
    border-radius: var(--card-border-radius);
    overflow: hidden;
    box-shadow: var(--card-shadow);
    padding: 0;
    margin: 0;
  }

  .card-header-siparis {
    border: 0;
    background: linear-gradient(135deg, #001657 0%, #001657 100%);
    padding: 20px var(--container-padding);
    box-sizing: border-box;
    margin: 0;
  }

  /* Card Body - NO PADDING */
  .card-body-siparis {
    padding: 0;
    background-color: #ffffff;
    box-sizing: border-box;
    margin: 0;
  }

  /* Filter Container - NO PADDING, INNER PADDING */
  .filter-container {
    background-color: #f8f9fa;
    padding: 20px var(--container-padding);
    border-radius: 6px;
    margin: 0 0 20px 0;
  }

  /* Table Container - NO PADDING, INNER PADDING */
  .table-container {
    overflow-x: auto;
    margin: 0;
    padding: 0;
    width: 100%;
  }

  .table-container-inner {
    padding: 0 var(--container-padding);
    width: 100%;
  }

  /* Responsive Design - Consolidated */
  @media (max-width: 1024px) {
    :root {
      --tab-height: 52px;
      --tab-padding-x: 18px;
      --tab-padding-y: 14px;
      --container-padding: 20px;
    }
  }

  @media (max-width: 768px) {
    :root {
      --tab-height: 48px;
      --tab-padding-x: 16px;
      --tab-padding-y: 12px;
      --container-padding: 18px;
    }
    
    .modern-tab {
      gap: 6px;
    }
  }

  @media (max-width: 640px) {
    :root {
      --tab-padding-x: 14px;
      --tab-padding-y: 12px;
      --container-padding: 16px;
    }
    
    .modern-tab {
      gap: 6px;
    }
    
    .modern-tab-label {
      display: none;
    }
    
    .modern-tab-icon {
      width: 18px;
      height: 18px;
      font-size: 16px;
    }
  }
  
  /* Separator responsive - uses CSS variables automatically */
  .modern-tab-separator {
    height: var(--tab-height);
    line-height: var(--tab-height);
  }
  
  @media (max-width: 768px) {
    .modern-tab-separator {
      font-size: 12px;
      padding: 0 3px;
    }
  }
  
  @media (max-width: 640px) {
    .modern-tab-separator {
      font-size: 11px;
      padding: 0 2px;
    }
  }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper content-wrapper-siparis">
  <section class="content pr-0">
    <div class="row">
      <div class="col-12">
        <div class="card card-siparis">
          <!-- Card Header -->
          <div class="card-header card-header-siparis">
            <div class="d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3" style="width: 40px; height: 40px; background-color: rgba(255,255,255,0.2); flex-shrink: 0;">
                  <i class="fas fa-shopping-cart" style="color: #ffffff; font-size: 18px;"></i>
                </div>
                <div>
                  <h3 class="mb-0" style="color: #ffffff; font-weight: 700; font-size: 20px; letter-spacing: 0.5px; line-height: 1.2; margin: 0;">
                    Siparişler Kısa Yolları
                  </h3>
                  <small style="color: rgba(255,255,255,0.9); font-size: 13px; line-height: 1.4; display: block; margin-top: 2px;">Sipariş yönetim modülleri</small>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Modern Tab Navigation Bar -->
          <?php
            $current_url = current_url();
            $current_path = parse_url($current_url, PHP_URL_PATH);
            $base_path = parse_url(base_url(), PHP_URL_PATH);
            $relative_path = str_replace($base_path, '', $current_path);
            $relative_path = trim($relative_path, '/');
            
            $tabs = [
              [
                'url' => base_url("tum-siparisler"),
                'icon' => 'fas fa-list',
                'label' => 'Tüm Siparişler',
                'active' => ($relative_path == 'tum-siparisler' || $relative_path == 'siparis/siparis_kisa_yollar' || empty($relative_path) && strpos($current_url, 'siparis_kisa_yollar') !== false)
              ],
              [
                'url' => base_url("onay-bekleyen-siparisler"),
                'icon' => 'far fa-check-circle',
                'label' => 'Onay Bekleyenler',
                'active' => ($relative_path == 'onay-bekleyen-siparisler' || strpos($relative_path, 'onay-bekleyen-siparisler') !== false)
              ],
              [
                'url' => base_url("siparis/haftalik_kurulum_plan"),
                'icon' => 'far fa-calendar-alt',
                'label' => 'Kurulum Planı',
                'active' => (strpos($relative_path, 'haftalik_kurulum_plan') !== false)
              ],
              [
                'url' => base_url("siparis/hizli_siparis_olustur_view"),
                'icon' => 'fas fa-plus-circle',
                'label' => 'Hızlı Sipariş',
                'active' => (strpos($relative_path, 'hizli_siparis_olustur') !== false)
              ],
              [
                'url' => base_url("cihaz/iptal_edilen_siparisler"),
                'icon' => 'fas fa-ban',
                'label' => 'İptal Edilenler',
                'active' => (strpos($relative_path, 'iptal_edilen_siparisler') !== false)
              ],
              [
                'url' => base_url("siparis/degerlendirme_rapor"),
                'icon' => 'far fa-envelope',
                'label' => 'SMS Sonuçları',
                'active' => (strpos($relative_path, 'degerlendirme_rapor') !== false)
              ]
            ];
          ?>
          <nav class="modern-tabs-nav" role="tablist">
            <div class="modern-tabs-container">
              <?php 
              $tab_count = count($tabs);
              $index = 0;
              foreach($tabs as $tab): 
                $index++;
              ?>
                <a href="<?=$tab['url']?>" 
                   class="modern-tab <?=$tab['active'] ? 'active' : ''?>" 
                   role="tab"
                   aria-selected="<?=$tab['active'] ? 'true' : 'false'?>">
                  <span class="modern-tab-icon">
                    <i class="<?=$tab['icon']?>"></i>
                  </span>
                  <span class="modern-tab-label"><?=$tab['label']?></span>
                </a>
                <?php if($index < $tab_count): ?>
                  <span class="modern-tab-separator">|</span>
                <?php endif; ?>
              <?php endforeach; ?>
            </div>
          </nav>
          
          <!-- Card Body -->
          <div class="card-body card-body-siparis">
            <!-- Filtreler - Sadece Yönetim Departmanı Görebilir -->
            <?php if(isset($is_yonetim) && $is_yonetim): ?>
            <div class="row filter-container">
              <div class="col-12">
                <h5 style="color: #495057; font-weight: 600; margin-bottom: 15px; font-size: 16px;">
                  <i class="fas fa-filter"></i> Filtreler
                </h5>
                <form id="filterForm" method="GET">
                  <div class="row">
                    <div class="col-md-3 mb-3">
                      <label style="font-weight: 600; color: #495057; font-size: 13px; margin-bottom: 5px;">Şehir</label>
                      <select name="sehir_id" id="sehir_id" class="form-control select2" style="width: 100%;">
                        <option value="">Tümü</option>
                        <?php if(!empty($sehirler)): foreach($sehirler as $sehir): ?>
                          <option value="<?=$sehir->sehir_id?>" <?=($selected_sehir_id == $sehir->sehir_id) ? 'selected' : ''?>><?=htmlspecialchars($sehir->sehir_adi)?></option>
                        <?php endforeach; endif; ?>
                      </select>
                    </div>
                    
                    <div class="col-md-3 mb-3">
                      <label style="font-weight: 600; color: #495057; font-size: 13px; margin-bottom: 5px;">Siparişi Oluşturan</label>
                      <select name="kullanici_id" id="kullanici_id" class="form-control select2" style="width: 100%;">
                        <option value="">Tümü</option>
                        <?php if(!empty($kullanicilar)): foreach($kullanicilar as $kullanici): ?>
                          <option value="<?=$kullanici->kullanici_id?>" <?=($selected_kullanici_id == $kullanici->kullanici_id) ? 'selected' : ''?>><?=htmlspecialchars($kullanici->kullanici_ad_soyad)?></option>
                        <?php endforeach; endif; ?>
                      </select>
                    </div>
                    
                    <div class="col-md-2 mb-3">
                      <label style="font-weight: 600; color: #495057; font-size: 13px; margin-bottom: 5px;">Başlangıç Tarihi</label>
                      <input type="date" name="tarih_baslangic" id="tarih_baslangic" value="<?=$selected_tarih_baslangic?>" class="form-control">
                    </div>
                    
                    <div class="col-md-2 mb-3">
                      <label style="font-weight: 600; color: #495057; font-size: 13px; margin-bottom: 5px;">Bitiş Tarihi</label>
                      <input type="date" name="tarih_bitis" id="tarih_bitis" value="<?=$selected_tarih_bitis?>" class="form-control">
                    </div>
                    
                    <div class="col-md-2 mb-3">
                      <label style="font-weight: 600; color: #495057; font-size: 13px; margin-bottom: 5px;">Teslim Durumu</label>
                      <select name="teslim_durumu" id="teslim_durumu" class="form-control select2" style="width: 100%;">
                        <option value="">Tümü</option>
                        <option value="1" <?=($selected_teslim_durumu == '1') ? 'selected' : ''?>>Teslim Edildi</option>
                        <option value="0" <?=($selected_teslim_durumu == '0') ? 'selected' : ''?>>Teslim Edilmedi</option>
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Filtrele
                      </button>
                      <a href="<?=base_url('siparis/siparis_kisa_yollar')?>" class="btn btn-secondary" style="margin-left: 10px;">
                        <i class="fas fa-redo"></i> Sıfırla
                      </a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <?php endif; ?>

            <!-- Tüm Siparişler Tablosu -->
            <div class="table-container">
              <div class="table-container-inner">
                <table id="users_tablce" class="table table-bordered table-hover align-middle mb-0" style="width:100%; margin: 0;">
                  <thead class="text-white text-center" style="background: linear-gradient(135deg, #001657 0%, #001657 100%);">
                    <tr>
                      <th style="width: 42px; font-weight: 600; padding: 15px 10px;">Sipariş Kodu</th> 
                      <th style="font-weight: 600; padding: 15px 10px;">Müşteri Adı</th> 
                      <th style="font-weight: 600; padding: 15px 10px;">Adres</th>
                      <th style="width: 130px; font-weight: 600; padding: 15px 10px;">Siparişi Oluşturan</th>
                      <th style="font-weight: 600; padding: 15px 10px;">İşlem</th> 
                    </tr>
                  </thead>
                  <tbody>
                    <!-- DataTable server-side ile doldurulacak -->
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script type="text/javascript">
  // showWindow fonksiyonu
  function showWindow(url) {
    var width = 950;
    var height = 720;
    var left = (screen.width / 2) - (width / 2);
    var top = (screen.height / 2) - (height / 2);
    var newWindow = window.open(url, 'Yeni Pencere', 'width=' + width + ',height=' + height + ',top=' + top + ',left=' + left);
    
    var interval = setInterval(function() {
      if (newWindow.closed) {
        clearInterval(interval);
        // DataTable varsa yenile, yoksa sayfayı yenile
        if($.fn.DataTable.isDataTable('#users_tablce')) {
          var currentPage = $('#users_tablce').DataTable().page();
          $('#users_tablce').DataTable().ajax.reload(function() {
            $('#users_tablce').DataTable().page(currentPage).draw(false);
          });
        } else {
          location.reload();
        }
      }
    }, 1000);
  }

  // Modern Tabs Component
  (function() {
    'use strict';
    
    function initModernTabs() {
      const tabsContainer = document.querySelector('.modern-tabs-container');
      if (!tabsContainer) return;
      
      // Scroll kontrolü
      function checkScrollable() {
        const isScrollable = tabsContainer.scrollWidth > tabsContainer.clientWidth;
        tabsContainer.classList.toggle('scrollable', isScrollable);
      }
      
      // Aktif tab'ı görünür alana getir - NO ANIMATION
      function scrollToActiveTab() {
        const activeTab = tabsContainer.querySelector('.modern-tab.active');
        if (activeTab) {
          const containerRect = tabsContainer.getBoundingClientRect();
          const tabRect = activeTab.getBoundingClientRect();
          
          if (tabRect.left < containerRect.left) {
            tabsContainer.scrollLeft = tabsContainer.scrollLeft + (tabRect.left - containerRect.left) - 16;
          } else if (tabRect.right > containerRect.right) {
            tabsContainer.scrollLeft = tabsContainer.scrollLeft + (tabRect.right - containerRect.right) + 16;
          }
        }
      }
      
      // Event listeners
      window.addEventListener('resize', checkScrollable);
      checkScrollable();
      
      // Sayfa yüklendiğinde aktif tab'ı görünür alana getir
      scrollToActiveTab();
      
      // Tab click tracking (analytics için)
      tabsContainer.addEventListener('click', function(e) {
        const tab = e.target.closest('.modern-tab');
        if (tab && !tab.classList.contains('active')) {
          // Tab değişikliği tracking
          console.log('Tab switched to:', tab.querySelector('.modern-tab-label')?.textContent);
        }
      });
    }
    
    // Initialize on DOM ready
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initModernTabs);
    } else {
      initModernTabs();
    }
  })();

  $(document).ready(function() {
    // Yönetim kontrolü
    var isYonetim = <?=isset($is_yonetim) && $is_yonetim ? 'true' : 'false'?>;
    
    // Select2 başlatma - Sadece yönetim departmanı görebilir
    if(isYonetim) {
      if($('#sehir_id').length) {
        $('#sehir_id').select2({
          placeholder: "Şehir seçin...",
          allowClear: true
        });
      }
      
      if($('#kullanici_id').length) {
        $('#kullanici_id').select2({
          placeholder: "Kullanıcı seçin...",
          allowClear: true
        });
      }
      
      if($('#teslim_durumu').length) {
        $('#teslim_durumu').select2({
          placeholder: "Durum seçin...",
          allowClear: true,
          minimumResultsForSearch: Infinity
        });
      }
    }
    
    // DataTables başlatma - tum-siparisler sayfasındaki gibi
    $('#users_tablce').DataTable({
      "processing": true,
      "serverSide": true,
      "pageLength": 11,
      scrollX: true,
      "ajax": {
        "url": "<?php echo site_url('siparis/siparisler_ajax'); ?>",
        "type": "GET",
        "data": function(d) {
          // Filtre parametrelerini ekle
          d.sehir_id = $('select[name="sehir_id"]').val();
          d.kullanici_id = $('select[name="kullanici_id"]').val();
          d.tarih_baslangic = $('input[name="tarih_baslangic"]').val();
          d.tarih_bitis = $('input[name="tarih_bitis"]').val();
          d.teslim_durumu = $('select[name="teslim_durumu"]').val();
        }
      },
      "language": {
        "processing": '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>'
      },
      "columns": [
        { "data": 0 },
        { "data": 1 },
        { "data": 2 },
        { "data": 3 },
        { "data": 4 }
      ]
    });
    
    // Filtre formu submit edildiğinde DataTable'ı yenile
    $('#filterForm').on('submit', function(e) {
      e.preventDefault();
      $('#users_tablce').DataTable().ajax.reload();
    });
  });
</script>


