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

          <!-- FOTOĞRAF YÜKLEME KUTULARI -->
          <div class="row mt-3">
            <!-- Belge Fotoğrafları -->
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3">
              <div class="card h-100">
                <div class="card-header bg-info text-white">
                  <h5 class="card-title mb-0">
                    <i class="fas fa-file-alt"></i> Belge Fotoğrafları
                  </h5>
                </div>
                <div class="card-body">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-info text-white"><i class="fas fa-plus"></i></span>
                    </div>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="belge_fotograf_input" accept="image/*" multiple onchange="kurulumFotoYukle(this,'belge');">
                      <label class="custom-file-label" for="belge_fotograf_input">Fotoğraf Seç</label>
                    </div>
                  </div>
                  <small class="text-muted d-block mb-2">Birden fazla belge fotoğrafı seçebilirsiniz (JPG, PNG)</small>
                  <div class="row" id="belge_fotograf_preview"></div>
                </div>
              </div>
            </div>
            <!-- Cihaz Fotoğrafları Detaylı -->
            <div class="col-12 col-md-6 col-lg-6 mb-3">
              <div class="card h-100">
                <div class="card-header bg-success text-white">
                  <h5 class="card-title mb-0">
                    <i class="fas fa-mobile-alt"></i> Cihaz Fotoğrafları
                  </h5>
                </div>
                <div class="card-body">
                  <!-- Fotoğraf Türü Seçimi -->
                  <div class="form-group">
                    <label for="cihaz_foto_tipi">Fotoğraf Türü Seçin:</label>
                    <select class="form-control" id="cihaz_foto_tipi" onchange="cihazFotoTipiDegisti()">
                      <option value="">-- Fotoğraf Türü Seçin --</option>
                      <option value="on">📷 Ön Fotoğraf</option>
                      <option value="arka">📷 Arka Fotoğraf</option>
                      <option value="sag_yan">📷 Sağ Yan Fotoğraf</option>
                      <option value="sol_yan">📷 Sol Yan Fotoğraf</option>
                      <option value="su_seviyesi">💧 Su Seviyesi Fotoğrafı</option>
                      <option value="ic_izolasyon">🔧 İç İzolasyon Fotoğrafı</option>
                      <option value="rulop">🎛️ Rulop Fotoğrafı</option>
                      <option value="olcu_aleti">📏 Ölçü Aleti Videosu</option>
                    </select>
                  </div>

                  <!-- Fotoğraf Yükleme Alanı -->
                  <div class="input-group mb-3" id="cihaz_foto_upload_area" style="display: none;">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-success text-white"><i class="fas fa-plus"></i></span>
                    </div>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="cihaz_fotograf_input" accept="image/*,video/*" multiple onchange="kurulumFotoYukle(this, 'cihaz');">
                      <label class="custom-file-label" for="cihaz_fotograf_input">Fotoğraf Seç</label>
                    </div>
                  </div>
                  <small class="text-muted d-block mb-2" id="cihaz_foto_aciklama" style="display: none;">Seçilen fotoğraf türü için resim yükleyebilirsiniz (JPG, PNG)</small>

                  <!-- Yüklenen Fotoğraflar -->
                  <div id="cihaz_fotograflari_container">
                    <!-- Dinamik olarak fotoğraflar eklenecek -->
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- FOTOĞRAF YÜKLEME KUTULARI BİTTİ -->

          <!-- YÜKLENEN FOTOĞRAFLAR -->
          <div class="row mt-4">
            <div class="col-12">
              <div class="card">
                <div class="card-header bg-primary">
                  <h4 class="card-title"><i class="fas fa-images"></i> Yüklenen Fotoğraflar</h4>
                </div>
                <div class="card-body">
                  <?php
                  $kurulum_fotograflari_query = $this->db->where("siparis_id", $siparis->siparis_id)->get("kurulum_fotograflari");
                  $kurulum_fotograflari = $kurulum_fotograflari_query ? $kurulum_fotograflari_query->result() : [];

                  // Debug: Fotoğraf bilgilerini göster
                  $toplam_fotograf = count($kurulum_fotograflari);
                  echo "<!-- Debug: Toplam fotoğraf sayısı: {$toplam_fotograf} -->\n";
                  if($kurulum_fotograflari) {
                    foreach($kurulum_fotograflari as $foto) {
                      echo "<!-- Debug: {$foto->foto_tipi} - {$foto->foto_url} -->\n";
                    }
                  }

                  if(!empty($kurulum_fotograflari)){
                    $belge_fotograflari = array_filter($kurulum_fotograflari, function($f){ return $f->foto_tipi == 'belge'; });
                    $cihaz_fotograflari = array_filter($kurulum_fotograflari, function($f){ return $f->foto_tipi != 'belge'; });
                  ?>
                  <div class="row">
                    <!-- Belge Fotoğrafları -->
                    <?php if(!empty($belge_fotograflari)): ?>
                    <div class="col-12 col-lg-6 mb-4">
                      <div class="card">
                        <div class="card-header bg-info text-white">
                          <h5 class="card-title mb-0">
                            <i class="fas fa-file-alt"></i> Belge Fotoğrafları (<?=count($belge_fotograflari)?>)
                          </h5>
                        </div>
                        <div class="card-body">
                          <!-- Belge açıklaması -->
                          <div class="mb-3">
                            <small class="text-muted">
                              <i class="fas fa-info-circle"></i> Faturalar, sözleşmeler, teslim belgeleri ve diğer resmi evrak fotoğrafları
                            </small>
                          </div>

                          <div class="row">
                            <?php foreach($belge_fotograflari as $foto): ?>
                            <div class="col-6 col-sm-4 col-md-4 col-lg-6 col-xl-4 mb-3">
                              <div class="position-relative">
                                <div class="card">
                                  <img src="<?=base_url($foto->foto_url)?>" class="card-img-top" style="height:120px;object-fit:cover;" alt="Belge">
                                  <div class="card-footer p-1 text-center bg-light">
                                    <small><i class="fas fa-file-alt text-info"></i> Belge</small>
                                  </div>
                                  <button type="button" class="btn btn-danger btn-xs position-absolute" style="top:5px;right:5px;" onclick="kurulumFotoSil(<?=$foto->id?>)">
                                    <i class="fas fa-times"></i>
                                  </button>
                                </div>
                              </div>
                            </div>
                            <?php endforeach; ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php endif; ?>

                    <!-- Cihaz Fotoğrafları Detaylı -->
                    <?php
                    $cihaz_foto_turleri = [
                      'on' => ['title' => '📷 Ön Fotoğraflar', 'icon' => 'fas fa-camera', 'color' => 'primary', 'is_video' => false],
                      'arka' => ['title' => '📷 Arka Fotoğraflar', 'icon' => 'fas fa-camera', 'color' => 'secondary', 'is_video' => false],
                      'sag_yan' => ['title' => '📷 Sağ Yan Fotoğraflar', 'icon' => 'fas fa-camera', 'color' => 'info', 'is_video' => false],
                      'sol_yan' => ['title' => '📷 Sol Yan Fotoğraflar', 'icon' => 'fas fa-camera', 'color' => 'warning', 'is_video' => false],
                      'su_seviyesi' => ['title' => '💧 Su Seviyesi Fotoğrafları', 'icon' => 'fas fa-tint', 'color' => 'primary', 'is_video' => false],
                      'ic_izolasyon' => ['title' => '🔧 İç İzolasyon Fotoğrafları', 'icon' => 'fas fa-tools', 'color' => 'secondary', 'is_video' => false],
                      'rulop' => ['title' => '🎛️ Rulop Fotoğrafları', 'icon' => 'fas fa-sliders-h', 'color' => 'success', 'is_video' => false],
                      'olcu_aleti' => ['title' => '📹 Ölçü Aleti Videosu', 'icon' => 'fas fa-video', 'color' => 'danger', 'is_video' => true]
                    ];

                    $cihaz_fotograflari_grup = [];
                    if(!empty($cihaz_fotograflari)){
                      foreach($cihaz_fotograflari as $foto){
                        $tip = $foto->foto_tipi;
                        if(!isset($cihaz_fotograflari_grup[$tip])) {
                          $cihaz_fotograflari_grup[$tip] = [];
                        }
                        $cihaz_fotograflari_grup[$tip][] = $foto;
                      }
                    }

                    foreach($cihaz_foto_turleri as $tip => $ayarlar):
                      if(!empty($cihaz_fotograflari_grup[$tip])):
                    ?>
                    <div class="col-12 col-lg-6 mb-4">
                      <div class="card">
                        <div class="card-header bg-<?=$ayarlar['color']?> text-white">
                          <h5 class="card-title mb-0">
                            <i class="<?=$ayarlar['icon']?>"></i> <?=$ayarlar['title']?> (<?=count($cihaz_fotograflari_grup[$tip])?>)
                          </h5>
                        </div>
                        <div class="card-body">
                          <!-- Fotoğraf türü açıklaması -->
                          <div class="mb-3">
                            <small class="text-muted">
                              <i class="fas fa-info-circle"></i>
                              <?php
                              $tip_aciklamalari = [
                                'on' => 'Cihazın ön tarafından çekilmiş fotoğraf',
                                'arka' => 'Cihazın arka tarafından çekilmiş fotoğraf',
                                'sag_yan' => 'Cihazın sağ tarafından çekilmiş fotoğraf',
                                'sol_yan' => 'Cihazın sol tarafından çekilmiş fotoğraf',
                                'su_seviyesi' => 'Su seviyesinin görünür olduğu fotoğraf',
                                'ic_izolasyon' => 'İç izolasyon sisteminin görünür olduğu fotoğraf',
                                'rulop' => 'Rulop kontrol sisteminin fotoğrafı',
                                'olcu_aleti' => 'Ölçü aletinin (manometre vb.) videosu'
                              ];
                              echo $tip_aciklamalari[$tip] ?? $tip . ' fotoğrafı';
                              ?>
                            </small>
                          </div>

                          <div class="row">
                            <?php foreach($cihaz_fotograflari_grup[$tip] as $foto): ?>
                            <div class="col-6 col-sm-4 col-md-4 col-lg-6 col-xl-4 mb-3">
                              <div class="position-relative">
                                <div class="card">
                                  <?php if($ayarlar['is_video']): ?>
                                  <video class="card-img-top" style="height:120px;object-fit:cover;" controls>
                                    <source src="<?=base_url($foto->foto_url)?>" type="video/mp4">
                                    Tarayıcınız video oynatmayı desteklemiyor.
                                  </video>
                                  <div class="card-footer p-1 text-center bg-light">
                                    <small><i class="fas fa-video text-danger"></i> Video</small>
                                  </div>
                                  <?php else: ?>
                                  <img src="<?=base_url($foto->foto_url)?>" class="card-img-top" style="height:120px;object-fit:cover;" alt="<?=$ayarlar['title']?>">
                                  <div class="card-footer p-1 text-center bg-light">
                                    <small><i class="fas fa-camera text-primary"></i> Fotoğraf</small>
                                  </div>
                                  <?php endif; ?>
                                  <button type="button" class="btn btn-danger btn-xs position-absolute" style="top:5px;right:5px;" onclick="kurulumFotoSil(<?=$foto->id?>)">
                                    <i class="fas fa-times"></i>
                                  </button>
                                </div>
                              </div>
                            </div>
                            <?php endforeach; ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php
                      endif;
                    endforeach;
                    ?>
                  </div>
                  <?php } else { ?>
                  <div class="text-center text-muted">
                    <i class="fas fa-info-circle fa-3x mb-3"></i>
                    <p>Henüz fotoğraf yüklenmemiş</p>
                  </div>
                  <?php } ?>
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
/* Mobil cihazlarda daha iyi görünüm için */
@media (max-width: 767.98px) {
  .card-header h5 {
    font-size: 1rem;
  }
  .badge {
    font-size: 0.85rem;
    padding: 0.5rem;
  }
  .btn {
    font-size: 0.9rem;
    padding: 0.5rem 1rem;
  }
}

/* Fotoğraf kartlarının tutarlı yüksekliği */
.card.h-100 .card-body {
  display: flex;
  flex-direction: column;
}

/* Küçük ekranlarda fotoğraf grid'i */
@media (max-width: 575.98px) {
  .col-6 {
    -ms-flex: 0 0 50%;
    flex: 0 0 50%;
    max-width: 50%;
  }
}
</style>

<script>
  // Mevcut fotoğrafları tutacak değişken
  var mevcutFotoTurleri = <?php echo json_encode(array_column($kurulum_fotograflari ?: [], 'foto_tipi')); ?>;

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

      const options = select.querySelectorAll('option');
      options.forEach(function(option) {
          const value = option.value;
          if (value && value !== '' && mevcutFotoTurleri.includes(value)) {
              option.style.display = 'none';
              option.disabled = true;
          }
      });

      // Eğer hiç seçenek kalmadıysa uyarı göster
      const visibleOptions = Array.from(options).filter(opt => !opt.disabled && opt.value !== '');
      if (visibleOptions.length === 0) {
          select.innerHTML = '<option value="">Tüm fotoğraf türleri yüklendi ✅</option>';
          const uploadArea = document.getElementById('cihaz_foto_upload_area');
          const aciklama = document.getElementById('cihaz_foto_aciklama');
          if (uploadArea) uploadArea.style.display = 'none';
          if (aciklama) {
              aciklama.innerHTML = '<i class="fas fa-check-circle text-success"></i> Bu sipariş için tüm fotoğraf türleri yüklenmiştir.';
              aciklama.style.display = 'block';
          }
      }
  }

  function setValue(i,text){
    document.getElementById("i_feature_name_"+i).value=text;
  }

  function cihazFotoTipiDegisti(){
      const select = document.getElementById('cihaz_foto_tipi');
      const uploadArea = document.getElementById('cihaz_foto_upload_area');
      const aciklama = document.getElementById('cihaz_foto_aciklama');
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

          aciklama.innerHTML = fotoTurleri[selectedValue] + (isVideo ? ' (MP4, AVI, maksimum 50MB)' : ' (JPG, PNG, maksimum 5MB)');
      } else {
          uploadArea.style.display = 'none';
          aciklama.style.display = 'none';
      }
  }

  function kurulumFotoYukle(input,tip){
      const selectedTip = document.getElementById('cihaz_foto_tipi').value;

      // Cihaz fotoğrafları için tip kontrolü
      if(tip === 'cihaz' && !selectedTip){
          alert("Lütfen önce fotoğraf türünü seçin!");
          return;
      }

      const actualTip = tip === 'cihaz' ? selectedTip : tip;

      [...input.files].forEach(file=>{
          const isVideo = actualTip === 'olcu_aleti';

          // Dosya tipi kontrolü
          if(isVideo && !file.type.match("video.*"))return alert("Geçerli video dosyası değil!");
          if(!isVideo && !file.type.match("image.*"))return alert("Geçerli resim dosyası değil!");

          // Dosya boyutu kontrolü (video için 50MB, resim için 5MB)
          const maxSize = isVideo ? 50*1024*1024 : 5*1024*1024;
          if(file.size>maxSize)return alert(`Maksimum ${isVideo ? '50MB' : '5MB'} olabilir!`);

          const reader=new FileReader();
          reader.onload=e=>{
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
                  if(d.status!=="success")return alert("Yükleme hatası!");
                  fotoPreviewEkle(d.foto_url, actualTip, isVideo);
              });
          };
          reader.readAsDataURL(file);
      });
      input.value="";
      if (input.nextElementSibling) {
        input.nextElementSibling.innerText = "Fotoğraf Seç";
      }
  }

  function fotoPreviewEkle(url,tip,isVideo = false){
      // Belge fotoğrafları için
      if(tip === 'belge'){
          const box=document.getElementById("belge_fotograf_preview");
          if(!box)return;

          const div=document.createElement("div");
          div.className="col-6 col-sm-4 col-md-4 col-lg-6 col-xl-4 mb-3";
          div.innerHTML=`
              <div class="position-relative">
                  <div class="card">
                      <img src="${url}" class="card-img-top" style="height:120px;object-fit:cover;">
                      <button class="btn btn-danger btn-xs position-absolute" style="top:5px;right:5px;" onclick="this.parentElement.parentElement.remove()">
                          <i class="fas fa-times"></i>
                      </button>
                      <div class="card-footer p-1 text-center" style="background:#f8f9fa;font-size:11px;">
                          Belge
                      </div>
                  </div>
              </div>`;
          box.appendChild(div);
      }
      // Cihaz fotoğrafları için
      else {
          const container = document.getElementById("cihaz_fotograflari_container");
          if(!container)return;

          // Fotoğraf türü adlarını tanımla
          const tipAdlari = {
              'on': '📷 Ön Fotoğraf',
              'arka': '📷 Arka Fotoğraf',
              'sag_yan': '📷 Sağ Yan Fotoğraf',
              'sol_yan': '📷 Sol Yan Fotoğraf',
              'su_seviyesi': '💧 Su Seviyesi',
              'ic_izolasyon': '🔧 İç İzolasyon',
              'rulop': '🎛️ Rulop',
              'olcu_aleti': isVideo ? '📹 Ölçü Aleti Videosu' : '📏 Ölçü Aleti'
          };

          // Bu tip için container oluştur veya mevcut olanı bul
          let tipContainer = container.querySelector(`[data-tip="${tip}"]`);
          if(!tipContainer){
              tipContainer = document.createElement("div");
              tipContainer.className = "mb-4";
              tipContainer.setAttribute("data-tip", tip);
              tipContainer.innerHTML = `
                  <h6 class="text-primary mb-3">${tipAdlari[tip] || tip}</h6>
                  <div class="row tip-foto-row"></div>
              `;
              container.appendChild(tipContainer);
          }

          const row = tipContainer.querySelector('.tip-foto-row');
          const div=document.createElement("div");
          div.className="col-6 col-sm-4 col-md-4 col-lg-6 col-xl-4 mb-3";
          div.innerHTML=`
              <div class="position-relative">
                  <div class="card">
                      ${isVideo ?
                          `<video class="card-img-top" style="height:120px;object-fit:cover;" controls>
                              <source src="${url}" type="video/mp4">
                              Tarayıcınız video oynatmayı desteklemiyor.
                           </video>` :
                          `<img src="${url}" class="card-img-top" style="height:120px;object-fit:cover;">`
                      }
                      <button class="btn btn-danger btn-xs position-absolute" style="top:5px;right:5px;" onclick="this.parentElement.parentElement.remove()">
                          <i class="fas fa-times"></i>
                      </button>
                  </div>
              </div>`;
          row.appendChild(div);
      }

      // Sayfa yüklendikten sonra da fotoğrafları göster
      setTimeout(()=>{ location.reload(); }, 500);
  }

  function kurulumFotoSil(id){
      if(!confirm("Silinsin mi?"))return;
      fetch("<?= base_url('siparis/kurulum_fotograf_sil') ?>",{
          method:"POST",
          headers:{"Content-Type":"application/json"},
          body:JSON.stringify({foto_id:id})
      })
      .then(r=>r.json())
      .then(d=>d.status==="success"?location.reload():alert("Silme hatası!"));
  }
</script>