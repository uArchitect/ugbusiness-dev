<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content col-12 col-lg-12 col-xl-12 mt-2 mx-auto">
    <div class="card card-dark">
      <div class="card-header with-border">
        <h3 class="card-title">Siparis Bilgileri</h3>
      </div>
      <form class="form-horizontal" method="POST" action="<?php echo site_url('siparis/save_kurulum_rapor').'/'.$siparis->siparis_id;?>">
        <div class="card-body">
          <div class="col-12 invoice-col p-0 mb-2" style="border: 1px solid #013a8f59;background:#f6faff">
            <span style="font-weight:bold;color:#07357a;background: #d9e7f9;display: block;padding-left:5px">
              Müşteri / Merkez Bilgileri
            </span>
            <address class="m-2">
              <div class="row mb-0">
                <div class="col-12 col-sm-6 mb-2 mb-sm-0">
                  <span class="badge bg-dark text-md p-4 d-block" style="font-weight:500;border-radius:0px;background:#004993!important;border: 1px solid #093d7d;">
                    <i class="fa fa-user-circle" style="font-size:25px"></i><br><br>
                    <b class="d-block d-sm-inline"><?=mb_strtoupper($merkez->musteri_ad)?></b><br class="d-none d-sm-block">
                    <span style="font-weight:300;margin-top:0px;padding:5px" class="d-block text-sm">
                      <i class="far fa-address-card"></i> <?=$merkez->musteri_kod?><br class="d-sm-none">
                      <i class="fa fa-mobile-alt d-sm-inline d-none" style="margin-left:11px"></i>
                      <span class="d-sm-inline d-block"><?=$merkez->musteri_iletisim_numarasi?></span>
                    </span>
                  </span>
                </div>
                <div class="col-12 col-sm-6">
                  <span class="badge bg-warning text-md p-4 d-block" style="font-weight:500;border-radius:0px;color:white!important;background:#004993!important;border: 1px solid #093d7d;">
                    <i class="fa fa-building" style="font-size:25px"></i><br><br>
                    <b class="d-block d-sm-inline"><?=mb_strtoupper($merkez->merkez_adi)?></b><br class="d-none d-sm-block">
                    <span style="font-weight:300;margin-top:0px;padding:5px" class="d-block text-sm">
                      <i class="far fa-map"></i> <?=$merkez->merkez_adresi?><br class="d-sm-none">
                      <span class="d-sm-inline d-block"><?=$merkez->ilce_adi?> / <?=$merkez->sehir_adi?></span>
                    </span>
                  </span>
                </div>
              </div>
            </address>
          </div>

          <!-- FOTOĞRAF YÜKLEME ALANLARI -->
          <div class="row mt-4">
            <div class="col-12">
              <div class="card shadow-sm">
                <div class="card-header bg-gradient-primary">
                  <h4 class="card-title mb-0 text-white">
                    <i class="fas fa-cloud-upload-alt"></i> Fotoğraf Yükleme
                  </h4>
                </div>
                <div class="card-body">
                  <div class="row">
                    <!-- Belge Fotoğrafları Yükleme -->
                    <div class="col-12 col-md-6 mb-3 mb-md-0">
                      <div class="upload-section p-3 border rounded h-100" style="background: #f8f9fa;">
                        <h5 class="mb-3">
                          <i class="fas fa-file-alt text-info"></i> Belge Fotoğrafları
                        </h5>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="belge_fotograf_input" accept="image/*" multiple onchange="kurulumFotoYukle(this,'belge');">
                            <label class="custom-file-label" for="belge_fotograf_input">
                              <i class="fas fa-folder-open"></i> Dosya Seç
                            </label>
                          </div>
                        </div>
                        <small class="text-muted d-block mt-2">
                          <i class="fas fa-info-circle"></i> Birden fazla belge fotoğrafı seçebilirsiniz (JPG, PNG, max 5MB)
                        </small>
                      </div>
                    </div>
                    
                    <!-- Cihaz Fotoğrafları Yükleme -->
                    <div class="col-12 col-md-6">
                      <div class="upload-section p-3 border rounded h-100" style="background: #f8f9fa;">
                        <h5 class="mb-3">
                          <i class="fas fa-mobile-alt text-success"></i> Cihaz Fotoğrafları
                        </h5>
                        <div class="form-group mb-2">
                          <label for="cihaz_foto_tipi" class="small font-weight-bold">Fotoğraf Türü:</label>
                          <select class="form-control form-control-sm" id="cihaz_foto_tipi" onchange="cihazFotoTipiDegisti()">
                            <option value="">-- Tür Seçin --</option>
                            <option value="on">📷 Ön Fotoğraf</option>
                            <option value="arka">📷 Arka Fotoğraf</option>
                            <option value="sag_yan">📷 Sağ Yan Fotoğraf</option>
                            <option value="sol_yan">📷 Sol Yan Fotoğraf</option>
                            <option value="su_seviyesi">💧 Su Seviyesi Fotoğrafı</option>
                            <option value="ic_izolasyon">🔧 İç İzolasyon Fotoğrafı</option>
                            <option value="rulop">🎛️ Rulop Fotoğrafı</option>
                            <option value="olcu_aleti">📹 Ölçü Aleti Videosu</option>
                          </select>
                        </div>
                        <div class="input-group" id="cihaz_foto_upload_area" style="display: none;">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="cihaz_fotograf_input" accept="image/*,video/*" onchange="kurulumFotoYukle(this, 'cihaz');">
                            <label class="custom-file-label" for="cihaz_fotograf_input">
                              <i class="fas fa-folder-open"></i> Dosya Seç
                            </label>
                          </div>
                        </div>
                        <small class="text-muted d-block mt-2" id="cihaz_foto_aciklama" style="display: none;">
                          <i class="fas fa-info-circle"></i> <span id="cihaz_foto_aciklama_text"></span>
                        </small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- FOTOĞRAF YÜKLEME ALANLARI BİTTİ -->

          <!-- YÜKLENEN FOTOĞRAFLAR - TAB YAPISI -->
          <div class="row mt-4">
            <div class="col-12">
              <div class="card shadow-sm">
                <div class="card-header bg-gradient-primary p-0">
                  <ul class="nav nav-tabs card-header-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="belge-tab" data-toggle="tab" href="#belge-fotograflari" role="tab" aria-controls="belge-fotograflari" aria-selected="true">
                        <i class="fas fa-file-alt"></i> Belge Fotoğrafları
                        <span class="badge badge-light ml-2" id="belge-badge"><?=count(array_filter($kurulum_fotograflari ?? [], function($f){ return ($f->foto_tipi ?? '') == 'belge'; }))?></span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="cihaz-tab" data-toggle="tab" href="#cihaz-fotograflari" role="tab" aria-controls="cihaz-fotograflari" aria-selected="false">
                        <i class="fas fa-mobile-alt"></i> Cihaz Fotoğrafları
                      </a>
                    </li>
                  </ul>
                </div>
                <div class="card-body">
                  <div class="tab-content" id="fotograf-tab-content">
                    <?php
                    $kurulum_fotograflari_query = $this->db->where("siparis_id", $siparis->siparis_id)->get("kurulum_fotograflari");
                    $kurulum_fotograflari = $kurulum_fotograflari_query ? $kurulum_fotograflari_query->result() : [];
                    
                    // Fotoğraf tiplerini düzelt
                    foreach($kurulum_fotograflari as &$foto) {
                      $gecerli_tipler = ['belge', 'on', 'arka', 'sag_yan', 'sol_yan', 'su_seviyesi', 'ic_izolasyon', 'rulop', 'olcu_aleti'];
                      if(empty($foto->foto_tipi) || !in_array($foto->foto_tipi, $gecerli_tipler)) {
                        $foto->foto_tipi = 'belge';
                      }
                    }
                    
                    $belge_fotograflari = array_filter($kurulum_fotograflari, function($f){ return $f->foto_tipi == 'belge'; });
                    $cihaz_fotograflari = array_filter($kurulum_fotograflari, function($f){ return $f->foto_tipi != 'belge'; });
                    ?>
                    
                    <!-- Belge Fotoğrafları Tab -->
                    <div class="tab-pane fade show active" id="belge-fotograflari" role="tabpanel" aria-labelledby="belge-tab">
                      <div id="belge-fotograflari-container">
                        <?php if(!empty($belge_fotograflari)): ?>
                          <div class="row">
                            <?php foreach($belge_fotograflari as $foto): ?>
                            <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-3">
                              <div class="position-relative foto-kart" data-foto-id="<?=$foto->id?>">
                                <div class="card shadow-sm">
                                  <img src="<?=base_url($foto->foto_url)?>" class="card-img-top" style="height:150px;object-fit:cover;cursor:pointer;" alt="Belge" onclick="fotoBuyut('<?=base_url($foto->foto_url)?>')">
                                  <div class="card-footer p-2 text-center bg-light">
                                    <small class="text-muted"><i class="fas fa-file-alt text-info"></i> Belge</small>
                                  </div>
                                  <button type="button" class="btn btn-danger btn-sm position-absolute" style="top:5px;right:5px;z-index:10;" onclick="kurulumFotoSil(<?=$foto->id?>)">
                                    <i class="fas fa-times"></i>
                                  </button>
                                </div>
                              </div>
                            </div>
                            <?php endforeach; ?>
                          </div>
                        <?php else: ?>
                          <div class="text-center text-muted py-5">
                            <i class="fas fa-file-alt fa-4x mb-3 opacity-50"></i>
                            <p class="mb-0">Henüz belge fotoğrafı yüklenmemiş</p>
                            <small>Yukarıdaki "Belge Fotoğrafları" bölümünden fotoğraf yükleyebilirsiniz</small>
                          </div>
                        <?php endif; ?>
                      </div>
                    </div>
                    
                    <!-- Cihaz Fotoğrafları Tab -->
                    <div class="tab-pane fade" id="cihaz-fotograflari" role="tabpanel" aria-labelledby="cihaz-tab">
                      <div id="cihaz-fotograflari-container">
                        <?php if(!empty($cihaz_fotograflari)): 
                          $tip_adlari = [
                            'on' => '📷 Ön',
                            'arka' => '📷 Arka',
                            'sag_yan' => '📷 Sağ Yan',
                            'sol_yan' => '📷 Sol Yan',
                            'su_seviyesi' => '💧 Su Seviyesi',
                            'ic_izolasyon' => '🔧 İç İzolasyon',
                            'rulop' => '🎛️ Rulop',
                            'olcu_aleti' => '📹 Ölçü Aleti'
                          ];
                        ?>
                          <div class="row">
                            <?php foreach($cihaz_fotograflari as $foto): 
                              $is_video = $foto->foto_tipi === 'olcu_aleti';
                              $tip_label = $tip_adlari[$foto->foto_tipi] ?? $foto->foto_tipi;
                            ?>
                            <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-3">
                              <div class="position-relative foto-kart" data-foto-id="<?=$foto->id?>" data-foto-tip="<?=$foto->foto_tipi?>">
                                <div class="card shadow-sm">
                                  <?php if($is_video): ?>
                                  <video class="card-img-top" style="height:150px;object-fit:cover;cursor:pointer;" controls onclick="event.stopPropagation();">
                                    <source src="<?=base_url($foto->foto_url)?>" type="video/mp4">
                                  </video>
                                  <div class="card-footer p-2 text-center bg-light">
                                    <small class="text-muted"><i class="fas fa-video text-danger"></i> <?=$tip_label?></small>
                                  </div>
                                  <?php else: ?>
                                  <img src="<?=base_url($foto->foto_url)?>" class="card-img-top" style="height:150px;object-fit:cover;cursor:pointer;" alt="Cihaz Fotoğrafı" onclick="fotoBuyut('<?=base_url($foto->foto_url)?>')">
                                  <div class="card-footer p-2 text-center bg-light">
                                    <small class="text-muted"><i class="fas fa-camera text-primary"></i> <?=$tip_label?></small>
                                  </div>
                                  <?php endif; ?>
                                  <button type="button" class="btn btn-danger btn-sm position-absolute" style="top:5px;right:5px;z-index:10;" onclick="kurulumFotoSil(<?=$foto->id?>)">
                                    <i class="fas fa-times"></i>
                                  </button>
                                </div>
                              </div>
                            </div>
                            <?php endforeach; ?>
                          </div>
                        <?php else: ?>
                          <div class="text-center text-muted py-5">
                            <i class="fas fa-mobile-alt fa-4x mb-3 opacity-50"></i>
                            <p class="mb-0">Henüz cihaz fotoğrafı yüklenmemiş</p>
                            <small>Yukarıdaki "Cihaz Fotoğrafları" bölümünden fotoğraf türü seçip yükleyebilirsiniz</small>
                          </div>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- YÜKLENEN FOTOĞRAFLAR BİTTİ -->

          <!-- ADIM 9-->
          <div style="background: #f6faff;border: 2px dashed #07357a;" class="p-2 mt-2">
            <div class="timeline mb-0">
              <div>
                <i class="fas fa-envelope bg-blue"></i>
                <div class="timeline-item">
                  <span class="time text-white d-none d-lg-block d-xl-none">
                    <i class="fas fa-exclamation-circle text-white"></i> Kurulum Tarihi, Araç Plaka ve Kurulum Ekip alanları zorunludur
                  </span>
                  <h3 class="timeline-header bg-dark">
                    <a href="#">Kurulum Programlama</a>
                  </h3>
                  <div class="timeline-body">
                    <?php
                      $count = 1; $pcount = -1;
                      foreach($siparis_degerlendirme_parametreleri as $feature) {
                        $count++; $pcount++;
                    ?>
                    <div class="card" style="border: 1px solid #343a4069;">
                      <div class="card-header" style="background:#13172017">
                        <h3 class="card-title">
                          <input hidden
                                 data-title="$feature->parameter_name"
                                 name="feature_title_<?=$count?>"
                                 type="text" value="<?php echo $feature->siparis_parametre_adi;?>" />
                          <span id="span_title_<?=$count?>" style="font-weight:600">
                            <i class="fas fa-question-circle text-primary"></i> <?php echo $feature->siparis_parametre_adi;?>
                          </span>
                        </h3>
                      </div>
                      <div class="card-body">
                        <div class="input-group">
                          <input
                            placeholder="Hızlı seçim yapınız veya değerlendirme sonucu giriniz..."
                            name="i_feature_name_<?=$count?>"
                            id="i_feature_name_<?=$count?>"
                            style="font-weight:normal;text-transform: capitalize;"
                            type="text"
                            class="form-control capitalize-input"
                            value="<?=$degerlendirme_data ? json_decode($degerlendirme_data)[$pcount]->value : ""?>" />
                          <div class="input-group-append">
                            <button onclick="document.getElementById('i_feature_name_<?=$count?>').value='Evet'; return false;" class="btn btn-default text-success"><i class="nav-icon fas fa-check text-success" style="font-size:13px"></i> Evet</button>
                            <button style="margin-left:0px" onclick="document.getElementById('i_feature_name_<?=$count?>').value='Hayır'; return false;" class="btn btn-default text-danger"><i class="nav-icon fas fa-times text-danger" style="font-size:13px"></i> Hayır</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- ADIM 9-->
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div class="row">
            <div class="col-12 col-sm-6 mb-2 mb-sm-0">
              <a href="<?=base_url("egitim")?>" class="btn btn-flat btn-danger btn-block">İptal</a>
            </div>
            <div class="col-12 col-sm-6">
              <button type="submit" class="btn btn-flat btn-primary btn-block">Kaydet</button>
            </div>
          </div>
        </div>
        <!-- /.card-footer-->
      </form>
    </div>
    <!-- /.card -->
  </section>
</div>


<style>
/* Modern Fotoğraf Yükleme Tasarımı */
.upload-section {
  transition: all 0.3s ease;
  border: 2px dashed #dee2e6 !important;
}

.upload-section:hover {
  border-color: #007bff !important;
  background: #f0f7ff !important;
}

/* Tab Tasarımı */
.nav-tabs .nav-link {
  border: none;
  border-bottom: 3px solid transparent;
  color: rgba(255, 255, 255, 0.8);
  transition: all 0.3s ease;
}

.nav-tabs .nav-link:hover {
  color: #fff;
  border-bottom-color: rgba(255, 255, 255, 0.5);
}

.nav-tabs .nav-link.active {
  color: #fff;
  background: transparent;
  border-bottom-color: #fff;
  font-weight: 600;
}

.nav-tabs .badge {
  background: rgba(255, 255, 255, 0.3) !important;
  color: #fff !important;
}

/* Fotoğraf Kartları */
.foto-kart {
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.foto-kart:hover {
  transform: translateY(-5px);
}

.foto-kart .card {
  transition: all 0.3s ease;
  border: 1px solid #dee2e6;
}

.foto-kart:hover .card {
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
}

.foto-kart img,
.foto-kart video {
  transition: transform 0.3s ease;
}

.foto-kart:hover img,
.foto-kart:hover video {
  transform: scale(1.05);
}

/* Responsive Tasarım */
@media (max-width: 767.98px) {
  .card-header h4, .card-header h5 {
    font-size: 1rem;
  }
  
  .upload-section {
    margin-bottom: 1rem !important;
  }
  
  .foto-kart .card-img-top {
    height: 120px !important;
  }
}

@media (max-width: 575.98px) {
  .nav-tabs .nav-link {
    font-size: 0.85rem;
    padding: 0.5rem 0.75rem;
  }
  
  .foto-kart {
    margin-bottom: 0.75rem;
  }
}

/* Loading State */
.upload-section.loading {
  opacity: 0.6;
  pointer-events: none;
}

/* Empty State */
.text-center.text-muted {
  padding: 3rem 1rem;
}

.text-center.text-muted i {
  opacity: 0.3;
}

/* Custom File Input */
.custom-file-label::after {
  content: "Gözat";
}

.custom-file-input:focus ~ .custom-file-label {
  border-color: #007bff;
  box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

/* Gradient Background */
.bg-gradient-primary {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
}

/* Shadow Effects */
.shadow-sm {
  box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
}

/* Smooth Transitions */
* {
  transition: background-color 0.2s ease, border-color 0.2s ease;
}
</style>

<script>
  // Mevcut fotoğrafları tutacak değişken (dinamik olarak güncellenecek)
  // Sadece cihaz fotoğraf türlerini al (belge hariç) ve unique yap
  <?php
  $cihaz_foto_turleri_list = [];
  if(!empty($kurulum_fotograflari)) {
      foreach($kurulum_fotograflari as $foto) {
          $tip = $foto->foto_tipi ?? '';
          // Belge türünü hariç tut ve geçerli türleri kontrol et
          if($tip !== 'belge' && !empty($tip)) {
              $gecerli_tipler = ['on', 'arka', 'sag_yan', 'sol_yan', 'su_seviyesi', 'ic_izolasyon', 'rulop', 'olcu_aleti'];
              if(in_array($tip, $gecerli_tipler)) {
                  $cihaz_foto_turleri_list[] = $tip;
              }
          }
      }
  }
  // Unique yap
  $cihaz_foto_turleri_list = array_unique($cihaz_foto_turleri_list);
  ?>
  var mevcutFotoTurleri = <?php echo json_encode(array_values($cihaz_foto_turleri_list)); ?>;

  // AdminLTE custom-file-input label güncelleme ve mevcut türleri gizleme
  document.addEventListener('DOMContentLoaded', function () {
      // Mevcut türleri dropdown'dan gizle
      gizleMevcutTurleri();

      var inputs = document.querySelectorAll('.custom-file-input');
      Array.prototype.forEach.call(inputs, function (input) {
          input.addEventListener('change', function (e) {
              var fileName = '';
              if (this.files && this.files.length > 1) {
                  fileName = this.files.length + ' dosya seçildi';
              } else if (this.files.length === 1) {
                  fileName = this.files[0].name;
              }
              this.nextElementSibling.innerText = fileName;
          });
      });
  });

  function gizleMevcutTurleri() {
      const select = document.getElementById('cihaz_foto_tipi');
      if (!select) return;

      // MevcutFotoTurleri'nin doğru olduğundan emin ol
      if (!Array.isArray(mevcutFotoTurleri)) {
          mevcutFotoTurleri = [];
      }

      // Tüm seçenekleri önce görünür yap ve aktif et
      const options = select.querySelectorAll('option');
      options.forEach(function(option) {
          if (option.value !== '') {
              option.style.display = 'block';
              option.disabled = false;
              option.hidden = false;
          }
      });

      // Mevcut türleri gizle
      let hiddenCount = 0;
      options.forEach(function(option) {
          const value = option.value;
          if (value && value !== '' && mevcutFotoTurleri.includes(value)) {
              option.style.display = 'none';
              option.disabled = true;
              option.hidden = true;
              hiddenCount++;
          }
      });

      // Eğer hiç seçenek kalmadıysa uyarı göster
      const visibleOptions = Array.from(options).filter(opt => 
          !opt.disabled && 
          !opt.hidden && 
          opt.value !== '' && 
          opt.style.display !== 'none'
      );
      
      if (visibleOptions.length === 0 && options.length > 1) {
          // Tüm seçenekleri gizle ve mesaj göster
          select.innerHTML = '<option value="">Tüm fotoğraf türleri yüklendi ✅</option>';
          const uploadArea = document.getElementById('cihaz_foto_upload_area');
          const aciklama = document.getElementById('cihaz_foto_aciklama');
          if (uploadArea) uploadArea.style.display = 'none';
          if (aciklama) {
              aciklama.innerHTML = '<i class="fas fa-check-circle text-success"></i> Bu sipariş için tüm fotoğraf türleri yüklenmiştir.';
              aciklama.style.display = 'block';
          }
      } else {
          // Eğer seçenekler varsa, upload alanını göster
          const uploadArea = document.getElementById('cihaz_foto_upload_area');
          if (uploadArea && select.value === '') {
              uploadArea.style.display = 'none';
          }
      }
  }

  // Dropdown'dan türü kaldır
  function turuDropdowndanKaldir(tip) {
      if (!tip) return;
      
      // MevcutFotoTurleri'nin array olduğundan emin ol
      if (!Array.isArray(mevcutFotoTurleri)) {
          mevcutFotoTurleri = [];
      }
      
      // Mevcut türler listesine ekle (eğer yoksa)
      if (!mevcutFotoTurleri.includes(tip)) {
          mevcutFotoTurleri.push(tip);
      }
      
      // Dropdown'dan gizle
      const select = document.getElementById('cihaz_foto_tipi');
      if (!select) return;
      
      const option = select.querySelector(`option[value="${tip}"]`);
      if (option) {
          option.style.display = 'none';
          option.disabled = true;
          option.hidden = true;
      }
      
      // Eğer seçili olan tür silindiyse, seçimi sıfırla
      if (select.value === tip) {
          select.value = '';
          cihazFotoTipiDegisti();
      }
      
      // Tüm türler yüklendi mi kontrol et
      gizleMevcutTurleri();
  }

  // Dropdown'a türü geri ekle
  function turuDropdownaEkle(tip) {
      if (!tip) return;
      
      // MevcutFotoTurleri'nin array olduğundan emin ol
      if (!Array.isArray(mevcutFotoTurleri)) {
          mevcutFotoTurleri = [];
      }
      
      // Mevcut türler listesinden çıkar
      mevcutFotoTurleri = mevcutFotoTurleri.filter(t => t !== tip);
      
      // Dropdown'da göster
      const select = document.getElementById('cihaz_foto_tipi');
      if (!select) return;
      
      const option = select.querySelector(`option[value="${tip}"]`);
      if (option) {
          option.style.display = 'block';
          option.disabled = false;
          option.hidden = false;
      }
      
      // Upload alanını güncelle
      const uploadArea = document.getElementById('cihaz_foto_upload_area');
      const aciklama = document.getElementById('cihaz_foto_aciklama');
      if (uploadArea && select.value === '') {
          uploadArea.style.display = 'none';
      }
      if (aciklama && select.value === '') {
          aciklama.style.display = 'none';
      }
      
      // Tüm türler yüklendi mi kontrol et
      gizleMevcutTurleri();
  }

  function setValue(i,text){
    document.getElementById("i_feature_name_"+i).value=text;
  }

  function cihazFotoTipiDegisti(){
      const select = document.getElementById('cihaz_foto_tipi');
      const uploadArea = document.getElementById('cihaz_foto_upload_area');
      const aciklama = document.getElementById('cihaz_foto_aciklama');
      const aciklamaText = document.getElementById('cihaz_foto_aciklama_text');
      const selectedValue = select.value;
      const fileInput = document.getElementById('cihaz_fotograf_input');
      const fileLabel = fileInput.nextElementSibling;

      if(selectedValue){
          uploadArea.style.display = 'flex';
          aciklama.style.display = 'block';

          // Fotoğraf türüne göre açıklama ve input güncelleme
          const isVideo = selectedValue === 'olcu_aleti';
          const fotoTurleri = {
              'on': 'Ön taraftan çekilmiş cihaz fotoğrafı',
              'arka': 'Arka taraftan çekilmiş cihaz fotoğrafı',
              'sag_yan': 'Sağ yandan çekilmiş cihaz fotoğrafı',
              'sol_yan': 'Sol yandan çekilmiş cihaz fotoğrafı',
              'su_seviyesi': 'Su seviyesini gösteren fotoğraf',
              'ic_izolasyon': 'İç izolasyonun görünür olduğu fotoğraf',
              'rulop': 'Rulop sisteminin fotoğrafı',
              'olcu_aleti': 'Ölçü aletinin (manometre vb.) videosu'
          };

          // Input accept değerini güncelle
          fileInput.accept = isVideo ? 'video/*' : 'image/*';
          fileLabel.innerText = isVideo ? 'Video Seç' : 'Fotoğraf Seç';

          if(aciklamaText) {
              aciklamaText.textContent = fotoTurleri[selectedValue] + (isVideo ? ' (MP4, AVI, maksimum 50MB)' : ' (JPG, PNG, maksimum 5MB)');
          }
      } else {
          uploadArea.style.display = 'none';
          aciklama.style.display = 'none';
      }
  }
  
  // Fotoğraf büyütme fonksiyonu
  function fotoBuyut(url) {
      const modal = document.createElement('div');
      modal.className = 'modal fade';
      modal.innerHTML = `
          <div class="modal-dialog modal-lg modal-dialog-centered">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title">Fotoğraf Görüntüle</h5>
                      <button type="button" class="close" data-dismiss="modal">
                          <span>&times;</span>
                      </button>
                  </div>
                  <div class="modal-body text-center p-0">
                      <img src="${url}" class="img-fluid" style="max-height: 80vh;">
                  </div>
              </div>
          </div>
      `;
      document.body.appendChild(modal);
      $(modal).modal('show');
      $(modal).on('hidden.bs.modal', function() {
          modal.remove();
      });
  }

  function kurulumFotoYukle(input,tip){
      const selectedTip = document.getElementById('cihaz_foto_tipi').value;

      // Cihaz fotoğrafları için tip kontrolü
      if(tip === 'cihaz' && !selectedTip){
          alert("Lütfen önce fotoğraf türünü seçin!");
          input.value = "";
          return;
      }

      const actualTip = tip === 'cihaz' ? selectedTip : tip;

      // ÖNEMLİ: Aynı türden fotoğraf zaten var mı kontrol et (FRONTEND KONTROLÜ)
      if(actualTip !== 'belge' && mevcutFotoTurleri.includes(actualTip)) {
          alert("Bu fotoğraf türü zaten eklenmiş! Lütfen önce mevcut fotoğrafı silin.");
          input.value = "";
          return;
      }

      // Sadece ilk dosyayı al (her türden sadece 1 fotoğraf)
      const file = input.files[0];
      if(!file) {
          input.value = "";
          return;
      }

      const isVideo = actualTip === 'olcu_aleti';

      // Dosya tipi kontrolü
      if(isVideo && !file.type.match("video.*")) {
          alert("Geçerli video dosyası değil!");
          input.value = "";
          return;
      }
      if(!isVideo && !file.type.match("image.*")) {
          alert("Geçerli resim dosyası değil!");
          input.value = "";
          return;
      }

      // Dosya boyutu kontrolü (video için 50MB, resim için 5MB)
      const maxSize = isVideo ? 50*1024*1024 : 5*1024*1024;
      if(file.size > maxSize) {
          alert(`Maksimum ${isVideo ? '50MB' : '5MB'} olabilir!`);
          input.value = "";
          return;
      }

      // Loading göster
      const uploadArea = document.getElementById('cihaz_foto_upload_area');
      if(uploadArea) {
          uploadArea.style.opacity = '0.5';
          uploadArea.style.pointerEvents = 'none';
      }

      const reader = new FileReader();
      reader.onload = e => {
          fetch("<?= base_url('siparis/kurulum_fotograf_yukle') ?>",{
              method:"POST",
              headers:{"Content-Type":"application/json"},
              body:JSON.stringify({
                  image:e.target.result,
                  siparis_id:<?= $siparis->siparis_id ?>,
                  foto_tipi:actualTip
              })
          })
          .then(r=>r.json())
          .then(d=>{
              // Loading kaldır
              if(uploadArea) {
                  uploadArea.style.opacity = '1';
                  uploadArea.style.pointerEvents = 'auto';
              }

              if(d.status !== "success") {
                  const errorMsg = d.message || "Yükleme hatası!";
                  alert(errorMsg);
                  input.value = "";
                  if (input.nextElementSibling) {
                      input.nextElementSibling.innerText = "Fotoğraf Seç";
                  }
                  return;
              }
              
              // Cihaz fotoğrafları için dropdown'dan türü kaldır
              if(tip === 'cihaz' && actualTip !== 'belge') {
                  turuDropdowndanKaldir(actualTip);
              }
              
              // Fotoğrafı "Yüklenen Fotoğraflar" bölümüne ekle
              yuklenenFotograflaraEkle(d.foto_url, actualTip, isVideo, d.foto_id);
              
              // Input'u temizle
              input.value = "";
              if (input.nextElementSibling) {
                  input.nextElementSibling.innerText = "Fotoğraf Seç";
              }
              
              // Dropdown'ı sıfırla
              if(tip === 'cihaz') {
                  const select = document.getElementById('cihaz_foto_tipi');
                  if(select) {
                      select.value = '';
                      cihazFotoTipiDegisti();
                  }
              }
          })
          .catch(error => {
              console.error('Yükleme hatası:', error);
              alert("Yükleme sırasında bir hata oluştu!");
              if(uploadArea) {
                  uploadArea.style.opacity = '1';
                  uploadArea.style.pointerEvents = 'auto';
              }
              input.value = "";
              if (input.nextElementSibling) {
                  input.nextElementSibling.innerText = "Fotoğraf Seç";
              }
          });
      };
      reader.readAsDataURL(file);
  }


  // "Yüklenen Fotoğraflar" bölümüne yeni fotoğraf ekle
  function yuklenenFotograflaraEkle(url, tip, isVideo, fotoId) {
      // Tab container'larını bul
      const belgeContainer = document.getElementById('belge-fotograflari-container');
      const cihazContainer = document.getElementById('cihaz-fotograflari-container');
      
      if(!belgeContainer || !cihazContainer) return;
      
      const tip_adlari = {
          'on': '📷 Ön',
          'arka': '📷 Arka',
          'sag_yan': '📷 Sağ Yan',
          'sol_yan': '📷 Sol Yan',
          'su_seviyesi': '💧 Su Seviyesi',
          'ic_izolasyon': '🔧 İç İzolasyon',
          'rulop': '🎛️ Rulop',
          'olcu_aleti': '📹 Ölçü Aleti'
      };
      
      // Belge fotoğrafları için
      if(tip === 'belge') {
          // Empty message'ı kaldır
          const emptyMsg = belgeContainer.querySelector('.text-center.text-muted');
          if(emptyMsg) emptyMsg.remove();
          
          // Row container'ı bul veya oluştur
          let rowContainer = belgeContainer.querySelector('.row');
          if(!rowContainer) {
              rowContainer = document.createElement('div');
              rowContainer.className = 'row';
              belgeContainer.appendChild(rowContainer);
          }
          // Yeni fotoğraf kartı oluştur
          const fotoDiv = document.createElement('div');
          fotoDiv.className = 'col-6 col-sm-4 col-md-3 col-lg-2 mb-3';
          fotoDiv.setAttribute('data-foto-id', fotoId);
          fotoDiv.style.opacity = '0';
          fotoDiv.style.transition = 'opacity 0.3s';
          fotoDiv.innerHTML = `
              <div class="position-relative foto-kart">
                  <div class="card shadow-sm" style="border: 2px solid #17a2b8; box-shadow: 0 0 10px rgba(23, 162, 184, 0.5);">
                      <img src="${url}" class="card-img-top" style="height:150px;object-fit:cover;cursor:pointer;" alt="Belge" onclick="fotoBuyut('${url}')">
                      <div class="card-footer p-2 text-center bg-light">
                          <small class="text-muted"><i class="fas fa-file-alt text-info"></i> Belge</small>
                      </div>
                      <button type="button" class="btn btn-danger btn-sm position-absolute" style="top:5px;right:5px;z-index:10;" onclick="kurulumFotoSil(${fotoId})">
                          <i class="fas fa-times"></i>
                      </button>
                  </div>
              </div>
          `;
          rowContainer.appendChild(fotoDiv);
          
          // Badge'i güncelle
          const belgeBadge = document.getElementById('belge-badge');
          if(belgeBadge) {
              const currentCount = parseInt(belgeBadge.textContent) || 0;
              belgeBadge.textContent = currentCount + 1;
          }
          
          // Belge tab'ına geç
          $('#belge-tab').tab('show');
          
          // Fade-in ve highlight
          setTimeout(() => fotoDiv.style.opacity = '1', 10);
          setTimeout(() => {
              const card = fotoDiv.querySelector('.card');
              if(card) {
                  card.style.border = '';
                  card.style.boxShadow = '';
              }
          }, 3000);
          
          // Scroll
          setTimeout(() => fotoDiv.scrollIntoView({ behavior: 'smooth', block: 'center' }), 200);
      }
      // Cihaz fotoğrafları için
      else {
          // Empty message'ı kaldır
          const emptyMsg = cihazContainer.querySelector('.text-center.text-muted');
          if(emptyMsg) emptyMsg.remove();
          
          // Row container'ı bul veya oluştur
          let rowContainer = cihazContainer.querySelector('.row');
          if(!rowContainer) {
              rowContainer = document.createElement('div');
              rowContainer.className = 'row';
              cihazContainer.appendChild(rowContainer);
          }
          
          // Eğer bu türden zaten fotoğraf varsa, eski fotoğrafı kaldır (her türden sadece 1 fotoğraf)
          const existingFoto = rowContainer.querySelector(`[data-foto-tip="${tip}"]`);
          if(existingFoto) {
              existingFoto.remove();
          }
          
          const tip_label = tip_adlari[tip] || tip;
          const fotoDiv = document.createElement('div');
          fotoDiv.className = 'col-6 col-sm-4 col-md-3 col-lg-2 mb-3';
          fotoDiv.setAttribute('data-foto-tip', tip);
          fotoDiv.setAttribute('data-foto-id', fotoId);
          fotoDiv.style.opacity = '0';
          fotoDiv.style.transition = 'opacity 0.3s';
          fotoDiv.innerHTML = `
              <div class="position-relative foto-kart">
                  <div class="card shadow-sm" style="border: 2px solid #28a745; box-shadow: 0 0 10px rgba(40, 167, 69, 0.5);">
                      ${isVideo ?
                          `<video class="card-img-top" style="height:150px;object-fit:cover;cursor:pointer;" controls onclick="event.stopPropagation();">
                              <source src="${url}" type="video/mp4">
                          </video>
                          <div class="card-footer p-2 text-center bg-light">
                              <small class="text-muted"><i class="fas fa-video text-danger"></i> ${tip_label}</small>
                          </div>` :
                          `<img src="${url}" class="card-img-top" style="height:150px;object-fit:cover;cursor:pointer;" alt="Cihaz Fotoğrafı" onclick="fotoBuyut('${url}')">
                          <div class="card-footer p-2 text-center bg-light">
                              <small class="text-muted"><i class="fas fa-camera text-primary"></i> ${tip_label}</small>
                          </div>`
                      }
                      <button type="button" class="btn btn-danger btn-sm position-absolute" style="top:5px;right:5px;z-index:10;" onclick="kurulumFotoSil(${fotoId})">
                          <i class="fas fa-times"></i>
                      </button>
                  </div>
              </div>
          `;
          rowContainer.appendChild(fotoDiv);
          
          // Cihaz tab'ına geç
          $('#cihaz-tab').tab('show');
          
          // Fade-in ve highlight
          setTimeout(() => fotoDiv.style.opacity = '1', 10);
          setTimeout(() => {
              const card = fotoDiv.querySelector('.card');
              if(card) {
                  card.style.border = '';
                  card.style.boxShadow = '';
              }
          }, 3000);
          
          // Scroll
          setTimeout(() => fotoDiv.scrollIntoView({ behavior: 'smooth', block: 'center' }), 200);
      }
  }

  function kurulumFotoSil(id){
      if(!confirm("Silinsin mi?")) return;
      
      // Silinecek fotoğrafın DOM elementini bul - daha güvenli yöntem
      let fotoCard = null;
      
      // Önce data-foto-id attribute'una göre ara
      fotoCard = document.querySelector(`[data-foto-id="${id}"]`);
      
      // Eğer bulamazsa, button'a göre ara
      if(!fotoCard) {
          const fotoElement = document.querySelector(`button[onclick*="kurulumFotoSil(${id})"]`);
          if(fotoElement) {
              // En yakın col-* veya foto-kart sınıfına sahip elementi bul
              let parent = fotoElement.closest('.foto-kart') || fotoElement.closest('[data-foto-id]');
              if(!parent) {
                  parent = fotoElement.parentElement;
                  while(parent && parent !== document.body) {
                      if(parent.classList.contains('col-6') || parent.classList.contains('col-sm-4') || 
                         parent.classList.contains('col-md-3') || parent.classList.contains('col-lg-2') ||
                         parent.classList.contains('col-md-4') || parent.classList.contains('col-lg-6') || 
                         parent.classList.contains('col-xl-4') || parent.hasAttribute('data-foto-id')) {
                          fotoCard = parent;
                          break;
                      }
                      parent = parent.parentElement;
                  }
              } else {
                  fotoCard = parent;
              }
          }
      }
      
      // Loading göster
      if(fotoCard) {
          fotoCard.style.opacity = '0.5';
          fotoCard.style.pointerEvents = 'none';
      }
      
      fetch("<?= base_url('siparis/kurulum_fotograf_sil') ?>",{
          method:"POST",
          headers:{"Content-Type":"application/json"},
          body:JSON.stringify({foto_id:id})
      })
      .then(r=>{
          if(!r.ok) {
              throw new Error('Network response was not ok');
          }
          return r.json();
      })
      .then(d=>{
          if(d.status==="success"){
              // Fotoğrafı DOM'dan kaldır
              if(fotoCard) {
                  // Row container'ı bul
                  const rowContainer = fotoCard.parentElement;
                  
                  // Fotoğrafı sil
                  fotoCard.remove();
                  
                  // Badge'i güncelle (sadece belge için)
                  if(d.foto_tipi === 'belge') {
                      const belgeBadge = document.getElementById('belge-badge');
                      if(belgeBadge) {
                          const currentCount = parseInt(belgeBadge.textContent) || 0;
                          belgeBadge.textContent = Math.max(0, currentCount - 1);
                      }
                      
                      // Eğer belge fotoğrafı kalmadıysa empty message göster
                      const belgeContainer = document.getElementById('belge-fotograflari-container');
                      if(belgeContainer) {
                          const belgeRow = belgeContainer.querySelector('.row');
                          if(belgeRow && belgeRow.children.length === 0) {
                              belgeRow.remove();
                              belgeContainer.innerHTML = `
                                  <div class="text-center text-muted py-5">
                                      <i class="fas fa-file-alt fa-4x mb-3 opacity-50"></i>
                                      <p class="mb-0">Henüz belge fotoğrafı yüklenmemiş</p>
                                      <small>Yukarıdaki "Belge Fotoğrafları" bölümünden fotoğraf yükleyebilirsiniz</small>
                                  </div>
                              `;
                          }
                      }
                  } else {
                      // Cihaz fotoğrafı silindi
                      const cihazContainer = document.getElementById('cihaz-fotograflari-container');
                      if(cihazContainer) {
                          const cihazRow = cihazContainer.querySelector('.row');
                          if(cihazRow && cihazRow.children.length === 0) {
                              cihazRow.remove();
                              cihazContainer.innerHTML = `
                                  <div class="text-center text-muted py-5">
                                      <i class="fas fa-mobile-alt fa-4x mb-3 opacity-50"></i>
                                      <p class="mb-0">Henüz cihaz fotoğrafı yüklenmemiş</p>
                                      <small>Yukarıdaki "Cihaz Fotoğrafları" bölümünden fotoğraf türü seçip yükleyebilirsiniz</small>
                                  </div>
                              `;
                          }
                      }
                  }
              }
              
              // Eğer silinen fotoğraf bir cihaz fotoğrafıysa (belge değilse), dropdown'a geri ekle
              if(d.foto_tipi && d.foto_tipi !== 'belge') {
                  turuDropdownaEkle(d.foto_tipi);
              }
          } else {
              alert(d.message || "Silme hatası!");
              // Loading'i kaldır
              if(fotoCard) {
                  fotoCard.style.opacity = '1';
                  fotoCard.style.pointerEvents = 'auto';
              }
          }
      })
      .catch(error => {
          console.error('Silme hatası:', error);
          alert("Silme sırasında bir hata oluştu! Lütfen tekrar deneyin.");
          // Loading'i kaldır
          if(fotoCard) {
              fotoCard.style.opacity = '1';
              fotoCard.style.pointerEvents = 'auto';
          }
      });
  }
</script>