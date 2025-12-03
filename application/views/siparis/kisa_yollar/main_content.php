<style>
  /* Modern Tab Navigation - Material 3 / Tailwind Inspired - CRITICAL CSS LOADED FIRST */
  .modern-tabs-nav {
    background-color: #ffffff;
    border-bottom: 1px solid #e5e7eb;
    position: relative;
    overflow: hidden;
    margin: 0;
  }

  .modern-tabs-container {
    display: flex;
    align-items: stretch;
    overflow-x: auto;
    overflow-y: hidden;
    scroll-behavior: smooth;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: thin;
    scrollbar-color: #d1d5db transparent;
    padding: 0;
    margin: 0;
    min-height: 56px;
    width: 100%;
    box-sizing: border-box;
    align-content: flex-start;
  }

  .modern-tabs-container::-webkit-scrollbar {
    height: 4px;
  }

  .modern-tabs-container::-webkit-scrollbar-track {
    background: transparent;
  }

  .modern-tabs-container::-webkit-scrollbar-thumb {
    background-color: #d1d5db;
    border-radius: 2px;
  }

  .modern-tabs-container::-webkit-scrollbar-thumb:hover {
    background-color: #9ca3af;
  }

  /* Tab Item - Default State (Passive) */
  .modern-tab {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 8px;
    padding: 16px 20px;
    margin: 0;
    text-decoration: none;
    color: #6b7280 !important;
    font-size: 14px;
    font-weight: 500;
    white-space: nowrap;
    position: relative;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    border-bottom: 3px solid transparent;
    background-color: transparent !important;
    cursor: pointer;
    user-select: none;
    -webkit-tap-highlight-color: transparent;
    border-radius: 0;
    flex-shrink: 0;
    box-sizing: border-box;
    min-height: 56px;
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

  /* Tab Icon */
  .modern-tab-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 18px;
    height: 18px;
    font-size: 16px;
    transition: transform 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    color: #6b7280;
  }

  .modern-tab-icon i {
    display: block;
    line-height: 1;
  }

  /* Tab Label */
  .modern-tab-label {
    letter-spacing: 0.01em;
    transition: color 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    color: #6b7280;
  }

  /* Tab Separator */
  .modern-tab-separator {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: #d1d5db;
    font-size: 14px;
    font-weight: 300;
    padding: 0 4px;
    user-select: none;
    flex-shrink: 0;
    height: 56px;
    line-height: 56px;
  }

  /* Passive Tab States */
  .modern-tab:not(.active):hover {
    color: #374151 !important;
    background-color: #f9fafb !important;
  }

  .modern-tab:not(.active):hover .modern-tab-icon {
    transform: scale(1.05);
    color: #374151;
  }

  .modern-tab:not(.active):active {
    transform: scale(0.98);
  }

  /* Active Tab State - ONLY when .active class is present */
  .modern-tab.active {
    color: #001657 !important;
    background-color: #f0f4ff !important;
    border-bottom-color: #001657;
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
    background-color: #f0f4ff;
    z-index: -1;
  }

  .modern-tab.active .modern-tab-icon {
    color: #001657 !important;
    transform: scale(1);
  }

  .modern-tab.active .modern-tab-label {
    color: #001657 !important;
  }

  /* Focus State for Accessibility */
  .modern-tab:focus {
    outline: 2px solid #001657;
    outline-offset: -2px;
    border-radius: 4px 4px 0 0;
  }

  .modern-tab:focus:not(:focus-visible) {
    outline: none;
  }

  /* Responsive Design */
  @media (max-width: 1024px) {
    .modern-tab {
      padding: 14px 18px;
      font-size: 13px;
      min-height: 52px;
    }
    
    .modern-tab:first-child {
      padding-left: 0;
    }
    
    .modern-tab:last-child {
      padding-right: 0;
    }
    
    .modern-tab-separator {
      height: 52px;
      line-height: 52px;
      font-size: 13px;
    }
  }

  @media (max-width: 768px) {
    .modern-tab {
      padding: 12px 16px;
      font-size: 12px;
      gap: 6px;
      min-height: 48px;
    }
    
    .modern-tab:first-child {
      padding-left: 0;
    }
    
    .modern-tab:last-child {
      padding-right: 0;
    }
    
    .modern-tab-separator {
      height: 48px;
      line-height: 48px;
      font-size: 12px;
      padding: 0 3px;
    }
  }

  @media (max-width: 640px) {
    .modern-tab {
      padding: 12px 14px;
      font-size: 11px;
      gap: 6px;
      min-height: 48px;
    }
    
    .modern-tab:first-child {
      padding-left: 0;
    }
    
    .modern-tab:last-child {
      padding-right: 0;
    }
    
    .modern-tab-label {
      display: none;
    }
    
    .modern-tab-icon {
      width: 18px;
      height: 18px;
      font-size: 16px;
    }
    
    .modern-tab-separator {
      height: 48px;
      line-height: 48px;
      font-size: 11px;
      padding: 0 2px;
    }
  }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top: 25px; background-color: #f8f9fa;">
  <section class="content pr-0">
    <div class="row">
      <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);">
          <!-- Card Header -->
          <div class="card-header border-0" style="background: linear-gradient(135deg, #001657 0%, #001657 100%); padding: 20px 24px; box-sizing: border-box;">
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
          <nav class="modern-tabs-nav" role="tablist" style="padding: 0 24px; box-sizing: border-box;">
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
          <div class="card-body" style="padding: 24px; background-color: #ffffff; box-sizing: border-box;">
            <!-- Filtreler - Sadece Yönetim Departmanı Görebilir -->
            <?php if(isset($is_yonetim) && $is_yonetim): ?>
            <div class="row mb-3" style="background-color: #f8f9fa; padding: 20px; border-radius: 6px; margin-bottom: 20px; margin-left: 0; margin-right: 0;">
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
            <?php if(!empty($siparisler)) : ?>
            <div style="overflow-x: auto; margin: 0 -24px; padding: 0 24px;">
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
                  <?php 
                  $current_user_id = aktif_kullanici()->kullanici_id;
                  foreach($siparisler as $row): 
                    if($current_user_id == 2 && $row->siparis_id == 2687) continue;
                    $urlcustom = base_url("siparis/report/").urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$row->siparis_id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE"));
                    $musteri = '<a target="_blank" style="font-weight: 500;" href="'.base_url("musteri/profil/".$row->musteri_id).'"><i class="fa fa-user-circle" style="color: #035ab9;"></i> '.$row->musteri_ad.'</a>';
                    
                    if($row->merkez_ulke_id == 190){
                      $bilgi = "<b>".$row->merkez_adi."</b><span style='font-weight:normal'> / ".$row->sehir_adi." (".$row->ilce_adi.")"."</span><br>";
                    }else{
                      $bilgi = "<b>".$row->merkez_adi."</b><span style='font-weight:normal'> / ".$row->ulke_adi."<br>";
                    }
                  ?>
                  <tr>
                    <td>
                      <a href="#" onclick="showWindow('<?=$urlcustom?>');"><?=$row->siparis_kodu?></a><br>
                      <span style='font-weight:normal'><?=date('d.m.Y H:i',strtotime($row->kayit_tarihi))?></span>
                    </td>
                    <td>
                      <b><?=$musteri?></b><?=($row->adim_no>11 ? " <i class='fas fa-check-circle text-success'></i><span class='text-success'>Teslim Edildi</span>":'<span style="margin-left:10px;opacity:0.5">Teslim Edilmedi</span>')?><br>
                      <span style='font-weight:normal'>İletişim : <?=formatTelephoneNumber($row->musteri_iletisim_numarasi)?><?=(($row->musteri_sabit_numara != "" ? " / Sabit No : ".$row->musteri_sabit_numara : ""))?></span>
                    </td>
                    <td>
                      <?=$bilgi?>
                      <?=(($row->merkez_adresi == "" || $row->merkez_adresi == "." || $row->merkez_adresi == "0") ? '<span style="opacity:0.4;font-weight:normal">BU MERKEZE TANIMLI ADRES KAYDI BULUNAMADI</span>' : "<span title='".$row->merkez_adresi."' style='font-weight:normal'>".substr($row->merkez_adresi,0,90).(strlen($row->merkez_adresi)>90 ? "...":"")."...</span>")?>
                    </td>
                    <td><?=$row->kullanici_ad_soyad?></td>
                    <td>
                      <a type="button" onclick="showWindow('<?=$urlcustom?>');" class="btn btn-warning btn-xs">
                        <i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> Düzenle
                      </a>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <?php else: ?>
              <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> Henüz sipariş bulunmamaktadır.
              </div>
            <?php endif; ?>
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
        location.reload();
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
      
      // Aktif tab'ı görünür alana getir
      function scrollToActiveTab() {
        const activeTab = tabsContainer.querySelector('.modern-tab.active');
        if (activeTab) {
          const containerRect = tabsContainer.getBoundingClientRect();
          const tabRect = activeTab.getBoundingClientRect();
          
          if (tabRect.left < containerRect.left) {
            tabsContainer.scrollTo({
              left: tabsContainer.scrollLeft + (tabRect.left - containerRect.left) - 16,
              behavior: 'smooth'
            });
          } else if (tabRect.right > containerRect.right) {
            tabsContainer.scrollTo({
              left: tabsContainer.scrollLeft + (tabRect.right - containerRect.right) + 16,
              behavior: 'smooth'
            });
          }
        }
      }
      
      // Event listeners
      window.addEventListener('resize', checkScrollable);
      checkScrollable();
      
      // Sayfa yüklendiğinde aktif tab'ı görünür alana getir
      setTimeout(scrollToActiveTab, 100);
      
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
    
    // DataTables başlatma - Client-side
    function initDataTable() {
      var $table = $('#users_tablce');
      if($table.length) {
        // Tablo var mı kontrol et
        var hasData = $table.find('tbody tr').length > 0;
        
        if(hasData) {
          try {
            // Eğer zaten başlatılmışsa destroy et
            if($.fn.DataTable.isDataTable('#users_tablce')) {
              $table.DataTable().destroy();
              $table.empty(); // Clean up
            }
            
            // DataTable'ı başlat
            $table.DataTable({
              "pageLength": 25,
              "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Tümü"]],
              "scrollX": true,
              "searching": true,
              "paging": true,
              "info": true,
              "autoWidth": false,
              "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Turkish.json",
                "search": "Ara:",
                "lengthMenu": "Sayfa başına _MENU_ kayıt göster",
                "info": "Toplam _TOTAL_ kayıttan _START_ - _END_ arası gösteriliyor",
                "infoEmpty": "Kayıt bulunamadı",
                "infoFiltered": "(_MAX_ kayıt içerisinden bulunan)",
                "zeroRecords": "Eşleşen kayıt bulunamadı",
                "processing": "İşleniyor...",
                "paginate": {
                  "first": "İlk",
                  "last": "Son",
                  "next": "Sonraki",
                  "previous": "Önceki"
                }
              },
              "order": [[0, "desc"]],
              "columnDefs": [
                { "orderable": true, "targets": [0, 1, 2, 3] },
                { "orderable": false, "targets": [4] }
              ],
              "dom": '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rt<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
              "initComplete": function(settings, json) {
                console.log("DataTable başarıyla başlatıldı. Toplam kayıt:", json.recordsTotal || $table.find('tbody tr').length);
              },
              "error": function(xhr, error, thrown) {
                console.error("DataTable hatası:", error, thrown);
              }
            });
          } catch(e) {
            console.error("DataTable başlatma hatası:", e);
          }
        } else {
          console.log("DataTable için veri bulunamadı");
        }
      }
    }
    
    // DOM hazır olduğunda başlat
    if(document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', function() {
        setTimeout(initDataTable, 200);
      });
    } else {
      setTimeout(initDataTable, 200);
    }
  });
</script>

