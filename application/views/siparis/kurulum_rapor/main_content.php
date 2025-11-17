<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content col-12 col-lg-12 col-xl-8 mt-2 mx-auto">
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
            <!-- Cihaz Fotoğrafları -->
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3">
              <div class="card h-100">
                <div class="card-header bg-success text-white">
                  <h5 class="card-title mb-0">
                    <i class="fas fa-mobile-alt"></i> Cihaz Fotoğrafları
                  </h5>
                </div>
                <div class="card-body">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-success text-white"><i class="fas fa-plus"></i></span>
                    </div>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="cihaz_fotograf_input" accept="image/*" multiple onchange="kurulumFotoYukle(this,'cihaz');">
                      <label class="custom-file-label" for="cihaz_fotograf_input">Fotoğraf Seç</label>
                    </div>
                  </div>
                  <small class="text-muted d-block mb-2">Birden fazla cihaz fotoğrafı seçebilirsiniz (JPG, PNG)</small>
                  <div class="row" id="cihaz_fotograf_preview"></div>
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

                  if(!empty($kurulum_fotograflari)){
                    $belge_fotograflari = array_filter($kurulum_fotograflari, function($f){ return $f->foto_tipi == 'belge'; });
                    $cihaz_fotograflari = array_filter($kurulum_fotograflari, function($f){ return $f->foto_tipi == 'cihaz'; });
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
                          <div class="row">
                            <?php foreach($belge_fotograflari as $foto): ?>
                            <div class="col-6 col-sm-4 col-md-4 col-lg-6 col-xl-4 mb-3">
                              <div class="position-relative">
                                <div class="card">
                                  <img src="<?=base_url($foto->foto_url)?>" class="card-img-top" style="height:120px;object-fit:cover;" alt="Belge">
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

                    <!-- Cihaz Fotoğrafları -->
                    <?php if(!empty($cihaz_fotograflari)): ?>
                    <div class="col-12 col-lg-6 mb-4">
                      <div class="card">
                        <div class="card-header bg-success text-white">
                          <h5 class="card-title mb-0">
                            <i class="fas fa-mobile-alt"></i> Cihaz Fotoğrafları (<?=count($cihaz_fotograflari)?>)
                          </h5>
                        </div>
                        <div class="card-body">
                          <div class="row">
                            <?php foreach($cihaz_fotograflari as $foto): ?>
                            <div class="col-6 col-sm-4 col-md-4 col-lg-6 col-xl-4 mb-3">
                              <div class="position-relative">
                                <div class="card">
                                  <img src="<?=base_url($foto->foto_url)?>" class="card-img-top" style="height:120px;object-fit:cover;" alt="Cihaz">
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
  // AdminLTE custom-file-input label güncelleme
  document.addEventListener('DOMContentLoaded', function () {
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

  function setValue(i,text){
    document.getElementById("i_feature_name_"+i).value=text;
  }

  function kurulumFotoYukle(input,tip){
      [...input.files].forEach(file=>{
          if(!file.type.match("image.*"))return alert("Geçerli resim değil!");
          if(file.size>5*1024*1024)return alert("Maksimum 5MB olabilir!");

          const reader=new FileReader();
          reader.onload=e=>{
              fetch("<?= base_url('siparis/kurulum_fotograf_yukle') ?>",{
                  method:"POST",
                  headers:{"Content-Type":"application/json"},
                  body:JSON.stringify({
                      image:e.target.result,
                      siparis_id:<?= $siparis->siparis_id ?>,
                      foto_tipi:tip
                  })
              })
              .then(r=>r.json())
              .then(d=>{
                  if(d.status!=="success")return alert("Yükleme hatası!");
                  fotoPreviewEkle(d.foto_url,tip);
              });
          };
          reader.readAsDataURL(file);
      });
      input.value="";
      if (input.nextElementSibling) {
        input.nextElementSibling.innerText = "Fotoğraf Seç";
      }
  }

  function fotoPreviewEkle(url,tip){
      const box=document.getElementById(tip+"_fotograf_preview");
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
                      ${tip === 'belge' ? 'Belge' : 'Cihaz'}
                  </div>
              </div>
          </div>`;
      box.appendChild(div);

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