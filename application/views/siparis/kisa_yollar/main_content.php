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

  /* ============================================
     MODÜLER TABLO TASARIMI - Her yerde kullanılabilir
     ============================================ */
  
  /* Tablo Container */
  #siparis-tablo-container {
    border-radius: 8px;
    overflow: hidden;
    background: #ffffff;
  }

  /* Ana Tablo */
  #siparis-tablo {
    width: 100%;
    margin: 0;
    border-collapse: separate;
    border-spacing: 0;
    background: #ffffff;
  }

  /* Tablo Başlıkları */
  #siparis-tablo-header.siparis-tablo-thead {
    background: linear-gradient(135deg, #001657 0%, #001657 100%);
  }

  #siparis-tablo-header .siparis-th {
    color: #ffffff;
    font-weight: 600;
    padding: 12px 15px;
    text-align: center;
    vertical-align: middle;
    font-size: 14px;
    border: none;
  }

  #siparis-tablo-header .siparis-th-action {
    width: 120px;
  }

  /* Tablo Satırları */
  #siparis-tablo-body.siparis-tablo-tbody tr {
    border-left: 3px solid transparent;
    transition: all 0.2s ease;
    background: #ffffff;
  }

  #siparis-tablo-body.siparis-tablo-tbody tr:hover {
    background: #f8f9fa;
    border-left-color: #001657;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
  }

  /* Tablo Hücreleri */
  #siparis-tablo-body.siparis-tablo-tbody td {
    padding: 12px 15px;
    vertical-align: middle;
    color: #495057;
    font-size: 14px;
    border-bottom: 1px solid #e5e7eb;
    line-height: 1.5;
  }

  #siparis-tablo-body.siparis-tablo-tbody tr:last-child td {
    border-bottom: none;
  }

  /* DataTable Kontrolleri */
  #siparis-tablo_wrapper .dataTables_processing {
    background: linear-gradient(135deg, #001657 0%, #001657 100%);
    color: #ffffff;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 4px 12px rgba(0, 22, 87, 0.3);
  }

  #siparis-tablo_wrapper .dataTables_paginate .paginate_button {
    border-radius: 6px;
    margin: 0 2px;
    padding: 6px 12px;
  }

  #siparis-tablo_wrapper .dataTables_paginate .paginate_button.current {
    background: linear-gradient(135deg, #001657 0%, #001657 100%);
    border-color: #001657;
    color: #ffffff;
  }

  #siparis-tablo_wrapper .dataTables_paginate .paginate_button:hover {
    background: linear-gradient(135deg, #002a7a 0%, #002a7a 100%);
    border-color: #002a7a;
    color: #ffffff;
  }

  #siparis-tablo_wrapper .dataTables_filter input,
  #siparis-tablo_wrapper .dataTables_length select {
    border: 1px solid #dee2e6;
    border-radius: 6px;
    padding: 6px 12px;
  }

  #siparis-tablo_wrapper .dataTables_filter input:focus,
  #siparis-tablo_wrapper .dataTables_length select:focus {
    border-color: #001657;
    box-shadow: 0 0 0 0.2rem rgba(0, 22, 87, 0.25);
    outline: none;
  }

  /* Filtre Formu */
  .input-group:focus-within .input-group-text {
    background-color: #002a7a;
    border-color: #002a7a;
  }

  .form-control:focus {
    border-color: #001657;
    box-shadow: 0 0 0 0.2rem rgba(0, 22, 87, 0.25);
    outline: none;
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
            <!-- Filtreler -->
            <div class="row mb-3" style="background-color: #f8f9fa; padding: 15px; border-radius: 5px; margin-bottom: 15px;">
              <form method="GET" action="<?=base_url('siparis/siparis_kisa_yollar')?>" id="filterForm" style="width: 100%;">
                <div class="row">
                  <div class="col-md-2">
                    <label style="font-weight: 600; margin-bottom: 5px; display: block; color: #001657;">Şehir</label>
                    <div class="input-group input-group-sm">
                      <div class="input-group-prepend">
                        <span class="input-group-text" style="background-color: #001657; color: white; border-color: #001657;">
                          <i class="fas fa-map-marker-alt"></i>
                        </span>
                      </div>
                      <select name="sehir_id" class="form-control" style="border-color: #001657;">
                        <option value="">Tümü</option>
                        <?php if(!empty($sehirler)): ?>
                          <?php foreach($sehirler as $sehir): ?>
                            <option value="<?=$sehir->sehir_id?>" <?=isset($selected_sehir_id) && $selected_sehir_id == $sehir->sehir_id ? 'selected' : ''?>>
                              <?=$sehir->sehir_adi?>
                            </option>
                          <?php endforeach; ?>
                        <?php endif; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <label style="font-weight: 600; margin-bottom: 5px; display: block; color: #001657;">Kullanıcı</label>
                    <div class="input-group input-group-sm">
                      <div class="input-group-prepend">
                        <span class="input-group-text" style="background-color: #001657; color: white; border-color: #001657;">
                          <i class="fas fa-user"></i>
                        </span>
                      </div>
                      <select name="kullanici_id" class="form-control" style="border-color: #001657;">
                        <option value="">Tümü</option>
                        <?php if(!empty($kullanicilar)): ?>
                          <?php foreach($kullanicilar as $kullanici): ?>
                            <option value="<?=$kullanici->kullanici_id?>" <?=isset($selected_kullanici_id) && $selected_kullanici_id == $kullanici->kullanici_id ? 'selected' : ''?>>
                              <?=$kullanici->kullanici_ad_soyad?>
                            </option>
                          <?php endforeach; ?>
                        <?php endif; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <label style="font-weight: 600; margin-bottom: 5px; display: block; color: #001657;">Başlangıç Tarihi</label>
                    <div class="input-group input-group-sm">
                      <div class="input-group-prepend">
                        <span class="input-group-text" style="background-color: #001657; color: white; border-color: #001657;">
                          <i class="fas fa-calendar-alt"></i>
                        </span>
                      </div>
                      <input type="date" name="tarih_baslangic" class="form-control" value="<?=isset($selected_tarih_baslangic) ? $selected_tarih_baslangic : ''?>" style="border-color: #001657;">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <label style="font-weight: 600; margin-bottom: 5px; display: block; color: #001657;">Bitiş Tarihi</label>
                    <div class="input-group input-group-sm">
                      <div class="input-group-prepend">
                        <span class="input-group-text" style="background-color: #001657; color: white; border-color: #001657;">
                          <i class="fas fa-calendar-check"></i>
                        </span>
                      </div>
                      <input type="date" name="tarih_bitis" class="form-control" value="<?=isset($selected_tarih_bitis) ? $selected_tarih_bitis : ''?>" style="border-color: #001657;">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <label style="font-weight: 600; margin-bottom: 5px; display: block; color: #001657;">Teslim Durumu</label>
                    <div class="input-group input-group-sm">
                      <div class="input-group-prepend">
                        <span class="input-group-text" style="background-color: #001657; color: white; border-color: #001657;">
                          <i class="fas fa-truck"></i>
                        </span>
                      </div>
                      <select name="teslim_durumu" class="form-control" style="border-color: #001657;">
                        <option value="">Tümü</option>
                        <option value="1" <?=isset($selected_teslim_durumu) && $selected_teslim_durumu == '1' ? 'selected' : ''?>>Teslim Edildi</option>
                        <option value="0" <?=isset($selected_teslim_durumu) && $selected_teslim_durumu == '0' ? 'selected' : ''?>>Teslim Edilmedi</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-2" style="display: flex; align-items: flex-end; gap: 5px;">
                    <button type="submit" class="btn btn-sm" style="background: linear-gradient(135deg, #001657 0%, #001657 100%); color: white; border-color: #001657; flex: 1;">
                      <i class="fa fa-filter"></i> Filtrele
                    </button>
                    <a href="<?=base_url('siparis/siparis_kisa_yollar')?>" class="btn btn-secondary btn-sm" style="flex: 1;">
                      <i class="fa fa-times"></i> Temizle
                    </a>
                  </div>
                </div>
              </form>
            </div>

            <!-- Tüm Siparişler Tablosu -->
            <div class="table-responsive" id="siparis-tablo-container">
              <table id="siparis-tablo" class="siparis-data-table">
                <thead id="siparis-tablo-header" class="siparis-tablo-thead">
                  <tr>
                    <th class="siparis-th">Sipariş Kodu</th> 
                    <th class="siparis-th">Müşteri Adı</th> 
                    <th class="siparis-th">Adres</th>
                    <th class="siparis-th">Siparişi Oluşturan</th>
                    <th class="siparis-th siparis-th-action">İşlem</th> 
                  </tr>
                </thead>
                <tbody id="siparis-tablo-body" class="siparis-tablo-tbody">
                  <!-- DataTable tarafından doldurulacak -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script type="text/javascript">
  // Modern Tabs Component - Vanilla JS
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
      
      // Aktif tab'ı görünür alana getir
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
      scrollToActiveTab();
      
      // Tab click tracking
      tabsContainer.addEventListener('click', function(e) {
        const tab = e.target.closest('.modern-tab');
        if (tab && !tab.classList.contains('active')) {
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
</script>

<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script type="text/javascript">
  // showWindow fonksiyonu - Global scope
  function showWindow(url) {
    var width = 950;
    var height = 720;
    var left = (screen.width / 2) - (width / 2);
    var top = (screen.height / 2) - (height / 2);
    var newWindow = window.open(url, 'Yeni Pencere', 'width=' + width + ',height=' + height + ',top=' + top + ',left=' + left);
    
    var interval = setInterval(function() {
      if (newWindow.closed) {
        clearInterval(interval);
        if($.fn.DataTable.isDataTable('#siparis-tablo')) {
          var currentPage = $('#siparis-tablo').DataTable().page();
          $('#siparis-tablo').DataTable().ajax.reload(function() {
            $('#siparis-tablo').DataTable().page(currentPage).draw(false);
          });
        } else {
          location.reload();
        }
      }
    }, 1000);
  }

  $(document).ready(function() {
    // DataTables başlatma - Abonelik sayfası gibi temiz yapı
    $('#siparis-tablo').DataTable({
      "processing": true,
      "serverSide": true,
      "pageLength": 25,
      "order": [[0, "desc"]],
      "ajax": {
        "url": "<?php echo site_url('siparis/siparisler_ajax_kisa_yollar'); ?>",
        "type": "GET",
        "data": function(d) {
          d.sehir_id = $('select[name="sehir_id"]').val();
          d.kullanici_id = $('select[name="kullanici_id"]').val();
          d.tarih_baslangic = $('input[name="tarih_baslangic"]').val();
          d.tarih_bitis = $('input[name="tarih_bitis"]').val();
          d.teslim_durumu = $('select[name="teslim_durumu"]').val();
        },
        "error": function(xhr, error, thrown) {
          console.error('DataTable AJAX Error:', error);
          console.error('Error Type:', thrown);
          console.error('Status:', xhr.status);
          console.error('Response:', xhr.responseText);
          alert('Veri yüklenirken bir hata oluştu. Lütfen sayfayı yenileyin veya konsolu kontrol edin.');
        }
      },
      "language": {
        "processing": '<div style="text-align:center;padding:20px;"><i class="fa fa-spinner fa-spin fa-3x" style="color:#001657;"></i><br><span style="margin-top:10px;display:block;">Veriler yükleniyor...</span></div>',
        "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Turkish.json"
      },
      "columns": [
        { "data": 0, "orderable": true },
        { "data": 1, "orderable": true },
        { "data": 2, "orderable": true },
        { "data": 3, "orderable": true },
        { "data": 4, "orderable": false }
      ],
      "responsive": true,
      "autoWidth": false
    });
    
    // Filtre formu submit
    $('#filterForm').on('submit', function(e) {
      e.preventDefault();
      $('#siparis-tablo').DataTable().ajax.reload();
    });
  });
</script>


