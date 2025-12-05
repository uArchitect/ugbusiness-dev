<?php $this->load->view('musteri/includes/styles'); ?>

<style>
  /* Form Özel Stilleri */
  .form-container {
    max-width: 900px;
    margin: 0 auto;
  }

  .form-group-modern {
    margin-bottom: 1.5rem;
  }

  .form-label-modern {
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-weight: 600;
    color: #495057;
    margin-bottom: 0.5rem;
    font-size: 14px;
    letter-spacing: 0.3px;
  }

  .form-label-modern .required-badge {
    font-weight: normal;
    opacity: 0.6;
    font-size: 12px;
    color: #6c757d;
  }

  .form-label-modern .action-link {
    font-size: 13px;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s ease;
  }

  .form-label-modern .action-link:hover {
    text-decoration: underline;
    color: #28a745 !important;
  }

  .form-control-modern {
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    padding: 12px 16px;
    font-size: 14px;
    transition: all 0.3s ease;
    background-color: #ffffff;
    width: 100%;
  }

  .form-control-modern:focus {
    border-color: #001657;
    box-shadow: 0 0 0 0.2rem rgba(0, 22, 87, 0.15);
    outline: none;
  }

  .form-control-modern::placeholder {
    color: #adb5bd;
    font-style: italic;
  }

  select.form-control-modern {
    height: auto;
    cursor: pointer;
  }

  .alert-info-modern {
    background: #fff3cd;
    border: 2px solid #ffc107;
    border-radius: 8px;
    padding: 14px 18px;
    color: #856404;
    margin-bottom: 1.5rem;
    font-size: 13px;
    line-height: 1.6;
    display: flex;
    align-items: flex-start;
    gap: 10px;
  }

  .alert-info-modern i {
    color: #ffc107;
    font-size: 16px;
    margin-top: 2px;
    flex-shrink: 0;
  }

  .form-section {
    background: #ffffff;
    border-radius: 12px;
    padding: 0;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
  }

  .form-section-header {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 16px 20px;
    border-bottom: 2px solid #e0e0e0;
    border-radius: 12px 12px 0 0;
  }

  .form-section-header h4 {
    margin: 0;
    font-size: 16px;
    font-weight: 600;
    color: #495057;
  }

  .form-section-body {
    padding: 24px;
  }

  .form-actions-modern {
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 2px solid #e9ecef;
    display: flex;
    gap: 12px;
    justify-content: flex-end;
  }

  .btn-modern {
    padding: 12px 28px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
  }

  .btn-primary-modern {
    background: linear-gradient(135deg, #001657 0%, #001657 100%);
    color: #ffffff;
    box-shadow: 0 2px 4px rgba(0, 22, 87, 0.2);
  }

  .btn-primary-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 22, 87, 0.3);
    background: linear-gradient(135deg, #002080 0%, #001657 100%);
    color: #ffffff;
  }

  .btn-danger-modern {
    background-color: #dc3545;
    color: #ffffff;
  }

  .btn-danger-modern:hover {
    background-color: #c82333;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
    color: #ffffff;
  }

  /* Responsive Düzenlemeler */
  @media (max-width: 992px) {
    .form-container {
      max-width: 100%;
    }
  }

  @media (max-width: 768px) {
    .form-section-body {
      padding: 20px 16px;
    }

    .form-group-modern {
      margin-bottom: 1.25rem;
    }

    .form-actions-modern {
      flex-direction: column-reverse;
      gap: 10px;
    }

    .form-actions-modern .btn-modern {
      width: 100%;
      justify-content: center;
    }

    .form-label-modern {
      flex-direction: column;
      align-items: flex-start;
      gap: 4px;
    }

    .form-label-modern .action-link {
      align-self: flex-end;
    }
  }

  @media (max-width: 576px) {
    .form-section-body {
      padding: 16px 12px;
    }

    .form-label-modern {
      font-size: 13px;
    }

    .form-control-modern {
      padding: 10px 14px;
      font-size: 13px;
    }

    .alert-info-modern {
      padding: 12px 14px;
      font-size: 12px;
    }
  }

  /* Select2 Uyumluluğu */
  .select2-container--default .select2-selection--single {
    border: 2px solid #e0e0e0 !important;
    border-radius: 8px !important;
    height: auto !important;
    padding: 8px 12px !important;
  }

  .select2-container--default .select2-selection--single:focus {
    border-color: #001657 !important;
  }

  .select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 1.5 !important;
    padding: 0 !important;
  }

  .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 100% !important;
    right: 10px !important;
  }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper content-wrapper-musteri">
  <section class="content pr-0">
    <div class="row">
      <div class="col-12">
        <div class="card card-musteri">
          <!-- Card Header -->
          <div class="card-header card-header-musteri">
            <div class="d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3 card-header-icon-wrapper">
                  <i class="fas fa-plus-circle card-header-icon"></i>
                </div>
                <div>
                  <h3 class="mb-0 card-header-title">
                    Cihaz Tanımlama Formu
                  </h3>
                  <small class="card-header-subtitle">Yeni cihaz tanımlama ve kayıt işlemleri</small>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Modern Tab Navigation Bar -->
          <?php $this->load->view('musteri/includes/tabs'); ?>
          
          <!-- Card Body -->
          <div class="card-body card-body-musteri">
            <div class="card-body-content">
              <div class="form-container">
                <form class="form-horizontal" method="POST" action="<?php echo site_url('cihaz/cihaz_tanimla_save'.((!empty($_GET["filter"])) ? "/1" : ""));?>">
                  <div class="form-section">
                    <div class="form-section-header">
                      <h4><i class="fas fa-info-circle mr-2"></i>Cihaz Bilgileri</h4>
                    </div>
                    
                    <div class="form-section-body">
                      <div class="alert-info-modern">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>Sipariş kaydı seçilmezse sistem otomatik olarak yeni sipariş oluşturup, bilgileri girilen cihazı o siparişe tanımlar.</span>
                      </div>

                      <div class="form-group-modern">
                        <label class="form-label-modern" for="musteri_id">
                          <span>Müşteri <span class="required-badge">(*Zorunlu)</span></span>
                          <a href="<?=((!empty($_GET["filter"])) ? base_url("musteri/add/0/0/1") : base_url("musteri/add"))?>" class="action-link text-success">
                            <i class="fas fa-user-plus"></i> Yeni Müşteri Kayıt
                          </a>
                        </label>
                        <select name="musteri_id" id="musteri_id" required class="form-control-modern select2" style="width: 100%;">
                          <option value="">Müşteri Seçimi Yapınız</option>
                          <?php foreach($musteriler as $musteri) : ?> 
                            <option <?=($secilen_musteri == $musteri->merkez_id)?"selected":""?> value="<?=$musteri->merkez_id?>"><?=$musteri->musteri_ad?>(<?=$musteri->merkez_adi?>) <?=$musteri->ilce_adi?> / <?=$musteri->sehir_adi?> / <?=$musteri->musteri_iletisim_numarasi?></option>
                          <?php endforeach; ?>  
                        </select> 
                      </div>

                      <div class="form-group-modern" style="height: 0px; opacity: 0; margin: 0; padding: 0; overflow: hidden;">
                        <label class="form-label-modern" for="siparis_id">
                          <span>Sipariş <span class="required-badge">(*Zorunlu)</span></span>
                        </label>
                        <div id="urun_siparis_div">
                          <select name="renkc" id="renkc" disabled class="form-control-modern select2" style="width: 100%;">
                            <option value="0">Yeni Sipariş Oluştur</option>
                          </select>  
                        </div>    
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group-modern">
                            <label class="form-label-modern" for="cihaz_id">
                              <span>Cihaz <span class="required-badge">(*Zorunlu)</span></span>
                            </label>
                            <select name="cihaz_id" id="cihaz_id" required class="form-control-modern select2" style="width: 100%;">
                              <option value="">Cihaz Seçimi Yapınız</option>
                              <?php foreach($cihazlar as $cihaz) : ?> 
                                <option value="<?=$cihaz->urun_id?>"><?=$cihaz->urun_adi?></option>
                              <?php endforeach; ?>  
                            </select>      
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group-modern">
                            <label class="form-label-modern" for="renk">
                              <span>Renk <span class="required-badge">(*Zorunlu)</span></span>
                            </label>
                            <div id="urun_renk_div">
                              <select name="renkc" id="renkc" disabled class="form-control-modern select2" style="width: 100%;">
                                <option value="">Renk Seçmek İçin Önce Cihaz Seçimi Yapınız</option>
                              </select>  
                            </div>    
                          </div>
                        </div>
                      </div>

                      <div class="form-group-modern">
                        <label class="form-label-modern" for="seri_numarasi">
                          <span>Seri Numarası <span class="required-badge">(*Zorunlu)</span></span>
                        </label>
                        <input type="text" class="form-control-modern" name="seri_numarasi" id="seri_numarasi" required placeholder="Seri No Giriniz..." autofocus>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group-modern">
                            <label class="form-label-modern" for="garanti_baslangic">
                              <span>Garanti Başlangıç Tarihi <span class="required-badge">(*Zorunlu)</span></span>
                            </label>
                            <input type="date" required class="form-control-modern" value="<?=date("Y-m-d")?>" name="garanti_baslangic" id="garanti_baslangic">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group-modern">
                            <label class="form-label-modern" for="garanti_bitis">
                              <span>Garanti Bitiş Tarihi <span class="required-badge">(*Zorunlu)</span></span>
                            </label>
                            <input type="date" required class="form-control-modern" value="<?=date("Y-m-d", strtotime('+2 years'))?>" name="garanti_bitis" id="garanti_bitis">
                          </div>
                        </div>
                      </div>

                      <div class="form-actions-modern">
                        <a href="<?=base_url("servis/servis_cihaz_sorgula_view")?>" class="btn-modern btn-danger-modern">
                          <i class="fas fa-times"></i> İptal
                        </a>
                        <button type="submit" class="btn-modern btn-primary-modern">
                          <i class="fas fa-save"></i> Kaydet
                        </button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>

<script>
  $(document).ready(function(){
    // Select2 başlatma
    if (typeof $.fn.select2 !== 'undefined') {
      $('.select2').select2({
        theme: 'bootstrap4',
        width: '100%'
      });
    }

    $('#cihaz_id').on('change', function(e){
      var urun_id = $(this).val();
      
      $.post('<?=base_url("urun/get_renkler/")?>'+urun_id, {}, function(result){
        if ( result && result.status != 'error' ) {
          var renkler = result.data;
          var select = '<select name="renk" id="ekle_renk" class="form-control-modern select2" style="width: 100%;">';
          for( var i = 0; i < renkler.length; i++) {
            select += '<option value="'+ renkler[i].id +'">'+ renkler[i].renk +'</option>';
          }
          select += '</select>';
          $('#urun_renk_div').empty().html(select);
          if (typeof $.fn.select2 !== 'undefined') {
            $('#ekle_renk').select2({
              theme: 'bootstrap4',
              width: '100%'
            });
          }
        } else {
          alert('Hata : ' + result.message );
        }					
      });
    });

    $('#musteri_id').on('change', function(e){
      var urun_id = $(this).val();
      
      $.post('<?=base_url("siparis/get_siparisler/")?>'+urun_id, {}, function(result){
        if ( result && result.status != 'error' ) {
          var siparisler = result.data;
          var select = '<select name="siparis_id" id="ekle_siparis" class="form-control-modern select2" style="width: 100%;">';
          select += '<option value="0">Yeni Sipariş Oluştur</option>';
          for( var i = 0; i < siparisler.length; i++) {
            select += '<option value="'+ siparisler[i].id +'"><b>'+ siparisler[i].siparis_kodu +'</b> / '+ siparisler[i].siparis_kayit_tarihi +'</option>';
          }
          select += '</select>';
          $('#urun_siparis_div').empty().html(select);
          if (typeof $.fn.select2 !== 'undefined') {
            $('#ekle_siparis').select2({
              theme: 'bootstrap4',
              width: '100%'
            });
          }
        } else {
          var select = '<select name="siparis_id" id="ekle_siparis" class="form-control-modern select2" style="width: 100%;">';
          select += '<option value="0">Yeni Sipariş Oluştur</option>';
          select += '</select>';
          $('#urun_siparis_div').empty().html(select);
          if (typeof $.fn.select2 !== 'undefined') {
            $('#ekle_siparis').select2({
              theme: 'bootstrap4',
              width: '100%'
            });
          }
        }					
      });
    });
  });
</script>