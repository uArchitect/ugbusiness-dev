<style>
  /* ============================================
     CSS Variables - Design System
     ============================================ */
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
    --primary-color: #001657;
    --primary-gradient: linear-gradient(135deg, #001657 0%, #001657 100%);
  }

  /* ============================================
     Modern Tab Navigation
     ============================================ */
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

  .modern-tab-label {
    letter-spacing: 0.01em;
    color: var(--tab-color-default);
  }

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

  .modern-tab:not(.active):hover {
    color: var(--tab-color-hover);
    background-color: var(--tab-bg-hover);
  }

  .modern-tab:not(.active):hover .modern-tab-icon {
    color: var(--tab-color-hover);
  }

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

  .modern-tab:focus {
    outline: 2px solid var(--tab-color-active);
    outline-offset: -2px;
    border-radius: 4px 4px 0 0;
  }

  .modern-tab:focus:not(:focus-visible) {
    outline: none;
  }

  /* ============================================
     Content Wrapper & Card Styles
     ============================================ */
  .content-wrapper-siparis {
    padding-top: 25px;
    background-color: #f8f9fa;
  }

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
    background: var(--primary-gradient);
    padding: 20px var(--container-padding);
    box-sizing: border-box;
    margin: 0;
  }

  .card-header-icon-wrapper {
    width: 40px;
    height: 40px;
    background-color: rgba(255, 255, 255, 0.2);
    flex-shrink: 0;
  }

  .card-header-icon {
    color: #ffffff;
    font-size: 18px;
  }

  .card-header-title {
    color: #ffffff;
    font-weight: 700;
    font-size: 20px;
    letter-spacing: 0.5px;
    line-height: 1.2;
    margin: 0;
  }

  .card-header-subtitle {
    color: rgba(255, 255, 255, 0.9);
    font-size: 13px;
    line-height: 1.4;
    display: block;
    margin-top: 2px;
  }

  .card-body-siparis {
    padding: var(--container-padding);
    background-color: #ffffff;
    box-sizing: border-box;
    margin: 0;
  }

  .form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(0, 22, 87, 0.25);
    outline: none;
  }

  .input-group-text {
    background-color: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
  }

  .input-group:focus-within .input-group-text {
    background-color: #002a7a;
    border-color: #002a7a;
  }

  .btn-primary {
    background: var(--primary-gradient);
    border-color: var(--primary-color);
  }

  .btn-primary:hover {
    background: #002a7a;
    border-color: #002a7a;
  }

  @media (max-width: 768px) {
    .modern-tabs-container {
      padding: 0 10px;
      -webkit-overflow-scrolling: touch;
    }

    .modern-tab {
      min-width: auto;
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
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3 card-header-icon-wrapper">
                  <i class="fas fa-plus-circle card-header-icon"></i>
                </div>
                <div>
                  <h3 class="mb-0 card-header-title">
                    Hızlı Sipariş Oluştur
                  </h3>
                  <small class="card-header-subtitle">Müşteri telefon numarası ile hızlı sipariş oluşturma</small>
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
            
            $tabs = [];
            
            // Tüm Siparişler - Herkes görebilir
            $tabs[] = [
              'url' => base_url("siparis/siparisler_restore"),
              'icon' => 'fas fa-list',
              'label' => 'Tüm Siparişler',
              'active' => ($relative_path == 'tum-siparisler' || $relative_path == 'siparis/siparisler_restore' || empty($relative_path) && strpos($current_url, 'siparisler_restore') !== false)
            ];
            
            // Onay Bekleyenler - Yetki kontrolüne göre URL değişir
            if(goruntuleme_kontrol("siparis_beklemeye_al")) {
              $tabs[] = [
                'url' => base_url("onay-bekleyen-siparisler?filter=2"),
                'icon' => 'far fa-check-circle',
                'label' => 'Onay Bekleyenler',
                'active' => ($relative_path == 'onay-bekleyen-siparisler' || strpos($relative_path, 'onay-bekleyen-siparisler') !== false)
              ];
            } else {
              $tabs[] = [
                'url' => base_url("onay-bekleyen-siparisler"),
                'icon' => 'far fa-check-circle',
                'label' => 'Onay Bekleyenler',
                'active' => ($relative_path == 'onay-bekleyen-siparisler' || strpos($relative_path, 'onay-bekleyen-siparisler') !== false)
              ];
            }
            
            // Kurulum Planı - Yetki kontrolü
            if(goruntuleme_kontrol("haftalik_kurulum_plan_goruntule")) {
              $tabs[] = [
                'url' => base_url("siparis/haftalik_kurulum_plan"),
                'icon' => 'far fa-calendar-alt',
                'label' => 'Kurulum Planı',
                'active' => (strpos($relative_path, 'haftalik_kurulum_plan') !== false)
              ];
            }
            
            // Hızlı Sipariş - Herkes görebilir
            $tabs[] = [
              'url' => base_url("siparis/hizli_siparis_olustur_view"),
              'icon' => 'fas fa-plus-circle',
              'label' => 'Hızlı Sipariş',
              'active' => (strpos($relative_path, 'hizli_siparis_olustur') !== false)
            ];
            
            // İptal Edilenler - Yetki kontrolü
            if(goruntuleme_kontrol("iptal_edilen_siparisleri_goruntule")) {
              $tabs[] = [
                'url' => base_url("cihaz/iptal_edilen_siparisler"),
                'icon' => 'fas fa-ban',
                'label' => 'İptal Edilenler',
                'active' => (strpos($relative_path, 'iptal_edilen_siparisler') !== false)
              ];
            }
            
            // SMS Sonuçları - Yetki kontrolü
            if(goruntuleme_kontrol("sms_degerlendirme_raporunu_goruntule")) {
              $tabs[] = [
                'url' => base_url("siparis/degerlendirme_rapor"),
                'icon' => 'far fa-envelope',
                'label' => 'SMS Sonuçları',
                'active' => (strpos($relative_path, 'degerlendirme_rapor') !== false)
              ];
            }
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
            <div class="row">
              <div class="col-lg-6">
                <form class="form-horizontal" onsubmit="submitFormWaiting()" method="POST" id="form_talep" action="<?php echo site_url('siparis/hizli_siparis_olustur');?>">
                  <?php $kontrol = !goruntuleme_kontrol("talep_yonlendirme") ?> 

                  <div class="form-group">
                    <label for="talep_cep_telefon">Cep Telefonu Numarası</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text rounded-2"><i class="fas fa-phone"></i></span>
                      </div>
                      <input type="text" required name="talep_cep_telefon" id="talep_cep_telefon" class="form-control rounded-2" value="<?php echo  !empty($talep) ? $talep->talep_cep_telefon : '';?>" placeholder="Müşteri Cep Numarasını Giriniz" data-inputmask="&quot;mask&quot;: &quot;0999 999 99 99&quot;" data-mask="" <?=(!empty($talep))?'':'onblur="validatePhoneNumber(this.value)"'?>   inputmode="numeric">
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-check-circle"></i> Hızlı Sipariş Oluştur</button>
                    <a href="<?=base_url("musteri/ekle")?>" target="_blank" class="btn btn-success"><i class="fas fa-user-plus"></i> Yeni Müşteri Kayıt</a>
                  </div>
                </form>
              </div>

              <?php if(!empty($yonlendirmeler)): ?>
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-shuffle"></i> Yönlendirme Bilgileri</h3>
                  </div>
                  <div class="card-body p-0">
                    <table id="exampleyonlendirmeler" class="table table-bordered table-striped nowrap">
                      <thead>
                        <tr>
                          <th>Yönlendirilen</th>
                          <th>Yönlendiren Kullanıcı</th>
                          <th>Görüşme Sonucu</th>
                          <th>Tarih</th> 
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($yonlendirmeler as $talep) : ?>
                          <?php 
                            if($talep->yonlenen_kullanici_id == $talep->yonlendiren_kullanici_id){
                              $background = "#e7ffca";
                              $color="#108d15";
                              $message = "*Kullanıcı Girişi";
                            }else{
                              $background = "";
                              $color = "#bfbfbf";
                              $message = "*Yönlendirme";
                            }
                          ?>
                          <tr style="background:<?=$background?>;">
                            <td><i class="fa fa-user" style="font-size:13px"></i> <?=$talep->yonlenen_ad_soyad?><span style="color:<?=$color?>"> <?=$message?></span></td>
                            <td><i class="fa fa-arrow-circle-right" style="font-size:13px"></i> <?=$talep->yonlendiren_ad_soyad?></td>  
                            <td><i class="far fa-calendar-plus" style="margin-right:5px;opacity:1"></i> <?=$talep->talep_sonuc_adi?></td>
                            <td><i class="far fa-calendar-plus" style="margin-right:5px;opacity:1"></i> <?=date('d.m.Y H:i',strtotime($talep->yonlendirme_tarihi));?></td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Yönlendirilen</th>
                          <th>Yönlendiren Kullanıcı</th>
                          <th>Görüşme Sonucu</th>
                          <th style="width: 130px;">Yönlendirme Tarih</th>  
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>

<script>
  function validatePhoneNumber(urun_id) {
    $.post('<?=base_url("talep/numara_kontrol/")?>'+urun_id, {}, function(result){
      if ( result && result.status != 'error' ) {
        // Başarılı
      } else {
        Swal.fire({
          title: "Sistem Uyarısı",
          icon: "error",
          html: urun_id+"nolu iletişim bilgisiyle oluşturulmuş ve 3 günlük görüşme sürecinde olan bir kayıt bulunmaktadır. 3 gün içinde tekrar talep kaydı oluşturulamaz.",
          showCancelButton: true,
          allowOutsideClick: true,
          showConfirmButton: false
        });
        document.getElementById("talep_cep_telefon").value = "";
      }					
    });
  }

  $(document).ready(function(){
    $('#form_talep').on('submit', function(e){
      Swal.fire({
        title: ' <i class="fa fa-spinner rotating" style="color: #343639; font-size:49px; margin-bottom:10px"></i><br>Lütfen Bekleyiniz!',
        html: "İşlem gerçekleştiriliyor...",
        timer: 2500,
        icon: '  <i class="fa fa-spinner rotating" style="color: #ffffff; font-size:49px; margin-bottom:10px"></i>',
        timerProgressBar: true,
        showCancelButton: false,
        closeOnClickOutside: false,
        showConfirmButton: false
      });
    });

    $('#talep_sehir_no').on('change', function(e){
      var il_id = $(this).val();
      $.post('<?=base_url("ilce/get_ilceler/")?>'+il_id, {}, function(result){
        if ( result && result.status != 'error' ) {
          var ilceler = result.data;
          var select = '<select name="talep_ilce_no" id="talep_ilce_no" class="select12 form-control rounded-0">';
          for( var i = 0; i < ilceler.length; i++) {
            select += '<option value="'+ ilceler[i].id +'">'+ ilceler[i].ilce +'</option>';
          }
          select += '</select>';
          $('#ilceler').empty().html(select);
          $('.select12').select2();
        } else {
          alert('Hata : ' + result.message );
        }					
      });
    });
  });

  $(document).ready(function(){
    <?php if($this->session->flashdata('flashDanger') != ""): ?>
      Swal.fire({
        title: "Sistem Uyarısı",
        text: "<?=$this->session->flashdata('flashDanger')?>",
        icon: "error",
        confirmButtonColor: "red", 
        confirmButtonText: "TAMAM"
      });
    <?php endif; ?>
  });

  function kopyalayiYapistir() {
    var kopyalanmisMetin = navigator.clipboard.readText().then(function(clipText) {
      var temizMetin = clipText.replace("+9", "");
      if (temizMetin.substring(0, 1) !== "0") {
        temizMetin = "0" + temizMetin;
      }
      document.getElementById("talep_cep_telefon").value = temizMetin;    
      const up_names = document.getElementsByName("talep_musteri_ad_soyad");
      if(up_names.length > 0) {
        up_names[0].focus();
      }
    });
  }
</script>