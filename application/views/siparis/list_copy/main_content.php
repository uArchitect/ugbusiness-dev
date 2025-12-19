<?php 
// Helper fonksiyonları yükle
$this->load->helper('siparis_view_helper');

// Styles yükle
$this->load->view('siparis/includes/styles');
$this->load->view('siparis/includes/styles_custom');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper content-wrapper-siparis">
  <section class="content pr-0">
    <div class="row">
      <div class="col-12">
        
        <?php if(empty($onay_bekleyen_siparisler) && empty($siparisler)): ?>
          <?php $this->load->view('siparis/includes/empty_state'); ?>
        <?php endif; ?>

        <?php if(!empty($onay_bekleyen_siparisler)) : ?>
        <div class="card card-siparis">
          <!-- Card Header -->
          <div class="card-header card-header-siparis">
            <div class="d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3 card-header-icon-wrapper">
                  <i class="far fa-check-circle card-header-icon"></i>
                </div>
                <div>
                  <h3 class="mb-0 card-header-title">Onay Bekleyen Siparişler</h3>
                  <small class="card-header-subtitle">Onay bekleyen siparişleri görüntüle ve yönet</small>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Modern Tab Navigation Bar -->
          <?php $this->load->view('siparis/includes/tabs'); ?>
          
          <!-- Card Body -->
          <div class="card-body card-body-siparis">
            <div class="card-body-content">
              <?php $this->load->view('siparis/includes/filter_buttons'); ?>
              
              <div class="table-responsive" style="overflow-x: visible;">
                <table id="onaybekleyensiparisler" class="table table-siparis table-bordered table-striped" style="width: 100%; table-layout: fixed;">
                  <thead>
                    <tr>
                      <th style="width: 80px;">Kayıt No</th> 
                      <th style="width: 180px;">Müşteri Adı</th>
                      <th style="width: 200px;">Merkez Detayları</th>
                      <th style="width: 150px;">Sipariş Oluşturan</th>   
                      <th style="width: 220px;">Son Durum</th>
                      <th style="width: 140px;">İşlemler</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $ak = aktif_kullanici()->kullanici_id;
                    // Controller'dan gelen veri artık array değil, obje olduğu için düzeltiyoruz
                    if(isset($kullanici_yetkili_adimlar) && is_array($kullanici_yetkili_adimlar)) {
                      // Eski format (array) - geriye dönük uyumluluk
                      $kullanici_yetkili_adimlar_array = $kullanici_yetkili_adimlar;
                    } else {
                      // Yeni format (obje) - adimlar kısmını al
                      $kullanici_yetkili_adimlar_array = isset($kullanici_yetkili_adimlar['adimlar']) ? $kullanici_yetkili_adimlar['adimlar'] : array();
                    }
                    $has_ikinci_onay = isset($has_ikinci_onay) ? $has_ikinci_onay : false;
                    $tum_siparisler_tabi = (!empty($_GET["filter"]) && $_GET["filter"] == "3");
                    $current_filter = isset($_GET["filter"]) ? $_GET["filter"] : "";
                    
                    foreach ($onay_bekleyen_siparisler as $siparis): 
                      $data = get_son_adim($siparis->siparis_id);
                      
                      // Helper fonksiyon ile filtreleme kontrolü
                      if (!should_show_siparis_row($siparis, $data, $ak, $tum_siparisler_tabi, $current_filter)) {
                        continue;
                      }
                      
                      // 2. satış onayı bekleyen siparişler için özel kontrol
                      // Eğer kullanıcının siparis_ikinci_onay yetkisi varsa ve sipariş adım 3'te ve siparis_ust_satis_onayi = 0 ise göster
                      if($has_ikinci_onay && isset($siparis->adim_no) && $siparis->adim_no == 3 && isset($siparis->siparis_ust_satis_onayi) && $siparis->siparis_ust_satis_onayi == 0) {
                        // Bu siparişi göster (2. satış onayı bekliyor)
                      } else {
                        // Normal kontrol - kullanıcının yetkisi var mı?
                        $next_adim = isset($siparis->adim_no) ? (int)$siparis->adim_no + 1 : null;
                        $required_yetki = $next_adim + 1;
                        if(!in_array($required_yetki, $kullanici_yetkili_adimlar_array)) {
                          continue; // Yetkisi yoksa göster
                        }
                      }
                      
                      // Satır render et
                      $this->load->view('siparis/includes/onay_bekleyen_table_row', [
                        'siparis' => $siparis,
                        'data' => $data,
                        'ak' => $ak,
                        'tum_siparisler_tabi' => $tum_siparisler_tabi,
                        'kullanici_yetkili_adimlar' => $kullanici_yetkili_adimlar_array
                      ]);
                    endforeach; 
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <?php endif; ?>

        <?php if(!empty($siparisler)) : ?>
        <div class="card card-siparis" style="margin-top: <?=!empty($onay_bekleyen_siparisler) ? '20px' : '0'?>;">
          <!-- Card Header -->
          <div class="card-header card-header-siparis">
            <div class="d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3 card-header-icon-wrapper">
                  <i class="fas fa-list card-header-icon"></i>
                </div>
                <div>
                  <h3 class="mb-0 card-header-title">Tüm Siparişler</h3>
                  <small class="card-header-subtitle">Tüm siparişleri görüntüle ve yönet</small>
                </div>
              </div>
              <a href="<?=base_url("siparis/merkez")?>" type="button" class="btn btn-light btn-sm">
                <i class="fa fa-plus"></i> Yeni Kayıt Ekle
              </a>
            </div>
          </div>
          
          <!-- Modern Tab Navigation Bar -->
          <?php $this->load->view('siparis/includes/tabs'); ?>
          
          <!-- Card Body -->
          <div class="card-body card-body-siparis">
            <!-- Filtreler -->
            <div class="row mb-3 filter-row">
              <form method="GET" action="<?=base_url('tum-siparisler')?>" id="filterForm" class="filter-form">
                <div class="row filter-row-inner">
                  <div class="col-md-2 filter-col">
                    <label class="filter-label">Şehir</label>
                    <select name="sehir_id" class="form-control filter-form-control">
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
                  <div class="col-md-2 filter-col">
                    <label class="filter-label">Kullanıcı</label>
                    <select name="kullanici_id" class="form-control filter-form-control">
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
                  <div class="col-md-2 filter-col">
                    <label class="filter-label">Başlangıç Tarihi</label>
                    <input type="date" name="tarih_baslangic" class="form-control filter-form-control" value="<?=isset($selected_tarih_baslangic) ? $selected_tarih_baslangic : ''?>">
                  </div>
                  <div class="col-md-2 filter-col">
                    <label class="filter-label">Bitiş Tarihi</label>
                    <input type="date" name="tarih_bitis" class="form-control filter-form-control" value="<?=isset($selected_tarih_bitis) ? $selected_tarih_bitis : ''?>">
                  </div>
                  <div class="col-md-2 filter-col">
                    <label class="filter-label">Teslim Durumu</label>
                    <select name="teslim_durumu" class="form-control filter-form-control">
                      <option value="">Tümü</option>
                      <option value="1" <?=isset($selected_teslim_durumu) && $selected_teslim_durumu == '1' ? 'selected' : ''?>>Teslim Edildi</option>
                      <option value="0" <?=isset($selected_teslim_durumu) && $selected_teslim_durumu == '0' ? 'selected' : ''?>>Teslim Edilmedi</option>
                    </select>
                  </div>
                  <div class="col-md-2 filter-col filter-buttons-wrapper">
                    <button type="submit" class="btn btn-primary filter-btn-primary">
                      <i class="fa fa-filter"></i> Filtrele
                    </button>
                    <a href="<?=base_url('tum-siparisler')?>" class="btn btn-secondary filter-btn-secondary">
                      <i class="fa fa-times"></i> Temizle
                    </a>
                  </div>
                </div>
              </form>
            </div>

            <div class="card-body-content">
              <div class="table-responsive">
                <table id="users_tablce" class="table table-siparis table-bordered table-striped nowrap" style="width:100%">
                  <thead>
                    <tr>
                      <th style="width: 42px;">Sipariş Kodu</th> 
                      <th>Müşteri Adı</th> 
                      <th>Adres</th>
                      <th style="width: 130px;">Siparişi Oluşturan</th>
                      <th>İşlem</th> 
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
        <?php endif; ?>

      </div>
    </div>
  </section>
</div>

<?php $this->load->view('siparis/includes/scripts'); ?>
