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
                  <i class="fas fa-warehouse" style="color: #ffffff; font-size: 18px;"></i>
                </div>
                <div>
                  <h3 class="mb-0" style="color: #ffffff; font-weight: 700; font-size: 20px; letter-spacing: 0.5px; line-height: 1.2;">
                    Depo Malzeme Çıkış Talep Formu
                  </h3>
                  <small style="color: rgba(255,255,255,0.9); font-size: 13px; line-height: 1.4;">Talep detaylarını düzenleyin ve onay verin</small>
                </div>
              </div>
              <a href="<?=base_url("depo_onay")?>" class="btn btn-light btn-sm shadow-sm" style="border-radius: 8px; font-weight: 600;">
                <i class="fas fa-arrow-left"></i> Listeye Dön
              </a>
            </div>
          </div>
          
          <!-- Card Body -->
          <div class="card-body" style="padding: 30px; background-color: #ffffff;">
            <form class="form-horizontal" method="POST" action="<?php echo site_url('depo_onay/talep_guncelle_save').'/'.$talepid;?>">
              
              <!-- Kullanıcı Bilgileri -->
              <div class="row mb-4">
                <div class="col-md-6">
                  <div class="form-group-modern">
                    <label class="form-label-modern">
                      <i class="fas fa-user text-primary mr-2"></i>
                      Talep Oluşturan Kullanıcı
                    </label>
                    <select disabled required id="formDepartman12" class="select2 form-control form-control-modern" style="width: 100%;">
                      <option value="">Kişi Seçimi Yapınız</option>
                      <?php foreach($kullanicilar as $kul2) : ?> 
                        <option <?=$kul2->kullanici_id==$kayitolusturanid ? "selected" : ""?> value="<?=$kul2->kullanici_id?>"><?=$kul2->kullanici_ad_soyad?></option>
                      <?php endforeach; ?>  
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group-modern">
                    <label class="form-label-modern text-danger">
                      <i class="fas fa-user-check text-danger mr-2"></i>
                      Teslim Alacak Kişi
                    </label>
                    <select disabled name="teslim_alacak_kullanici_no" required id="formDepartman1" class="select2 form-control form-control-modern" style="width: 100%;">
                      <option value="">Kişi Seçimi Yapınız</option>
                      <?php foreach($kullanicilar as $kul) : ?> 
                        <option <?=$kul->kullanici_id==$teslimalacakid ? "selected" : ""?> value="<?=$kul->kullanici_id?>"><?=$kul->kullanici_ad_soyad?></option>
                      <?php endforeach; ?>  
                    </select>
                  </div>
                </div>
              </div>

              <hr style="margin: 25px 0; border-top: 2px solid #e9ecef;">

              <!-- Malzeme Listesi -->
              <div class="mb-3">
                <h5 style="color: #495057; font-weight: 600; margin-bottom: 20px;">
                  <i class="fas fa-boxes text-primary mr-2"></i>
                  Talep Edilen Malzemeler
                </h5>
              </div>

              <div id="malzeme-container">
                <?php 
                $index = 0;
                foreach ($veriler as $veri) :
                  $eski_parca_alindi = isset($veri->eski_parca_alindi) ? $veri->eski_parca_alindi : 0;
                  $eski_parca_alindi_tarih = isset($veri->eski_parca_alindi_tarih) ? $veri->eski_parca_alindi_tarih : null;
                ?>
                <div class="malzeme-row mb-3 p-3 border rounded" style="background-color: #f8f9fa; border-color: #dee2e6 !important;">
                  <div class="row align-items-end">
                    <div class="col-md-4">
                      <div class="form-group-modern mb-0">
                        <label class="form-label-modern" style="font-size: 13px; margin-bottom: 5px;">
                          <i class="fas fa-box text-primary mr-1"></i>
                          Talep Edilen Malzeme
                        </label>
                        <select name="stok_kayit_no[]" required class="select2 form-control form-control-modern" style="width: 100%;">
                          <option value="">Malzeme Seçimi Yapınız</option>
                          <?php foreach($stok_tanimlari as $malzeme): ?> 
                            <option <?=$veri->stok_talep_edilen_malzeme_stok_no==$malzeme->stok_tanim_id ? "selected" : ""?> value="<?=$malzeme->stok_tanim_id?>"><?=$malzeme->stok_tanim_ad?></option>
                          <?php endforeach; ?>  
                        </select>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group-modern mb-0">
                        <label class="form-label-modern" style="font-size: 13px; margin-bottom: 5px;">
                          <i class="fas fa-hashtag text-primary mr-1"></i>
                          Miktar
                        </label>
                        <input type="number" value="<?=$veri->stok_talep_edilen_malzeme_miktar?>" required class="form-control form-control-modern" min="1" name="talep_miktar[]">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group-modern mb-0">
                        <label class="form-label-modern" style="font-size: 13px; margin-bottom: 5px;">
                          <i class="fas fa-recycle text-warning mr-1"></i>
                          Eski Parça Bilgisi
                        </label>
                        <div class="d-flex align-items-center">
                          <div class="custom-control custom-checkbox mr-3">
                            <input type="checkbox" 
                                   class="custom-control-input eski-parca-checkbox" 
                                   id="eski_parca_<?=$index?>" 
                                   name="eski_parca_alınacak[]" 
                                   value="<?=$index?>"
                                   data-index="<?=$index?>"
                                   <?=isset($veri->eski_parca_alınacak) && $veri->eski_parca_alınacak == 1 ? 'checked' : ''?>>
                            <label class="custom-control-label" for="eski_parca_<?=$index?>" style="font-size: 13px; cursor: pointer;">
                              Eski Parça Alınacak
                            </label>
                          </div>
                          <div class="eski-parca-onay-container" id="onay_container_<?=$index?>" style="display: <?=$eski_parca_alindi == 1 ? 'block' : 'none'; ?>;">
                            <span class="badge badge-success" style="padding: 6px 12px; border-radius: 6px; font-size: 12px;">
                              <i class="fas fa-check-circle mr-1"></i>
                              Alındı
                              <?php if($eski_parca_alindi_tarih): ?>
                                <small style="display: block; margin-top: 2px; opacity: 0.8;">
                                  <?=date('d.m.Y H:i', strtotime($eski_parca_alindi_tarih))?>
                                </small>
                              <?php endif; ?>
                            </span>
                          </div>
                        </div>
                        <input type="hidden" name="eski_parca_alindi[]" id="eski_parca_alindi_<?=$index?>" value="<?=$eski_parca_alindi?>">
                        <input type="hidden" name="eski_parca_alindi_tarih[]" id="eski_parca_alindi_tarih_<?=$index?>" value="<?=$eski_parca_alindi_tarih?>">
                      </div>
                    </div>
                    <div class="col-md-3 text-right">
                      <button type="button" class="btn btn-danger btn-sm remove-row" title="Satırı Sil" style="margin-bottom: 0;">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-12">
                      <div class="form-group-modern mb-0">
                        <label class="form-label-modern" style="font-size: 13px; margin-bottom: 5px;">
                          <i class="fas fa-exclamation-triangle text-danger mr-1"></i>
                          Ürün Arızası Açıklaması <small class="text-muted">(Opsiyonel)</small>
                        </label>
                        <textarea 
                          name="urun_ariza_aciklama[]" 
                          class="form-control form-control-modern" 
                          rows="2" 
                          placeholder="Varsa ürün arızası açıklamasını buraya yazabilirsiniz..."><?=isset($veri->urun_ariza_aciklama) ? htmlspecialchars($veri->urun_ariza_aciklama) : ''?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
                <?php 
                $index++;
                endforeach;
                ?>
              </div>

              <button type="button" id="yeni-malzeme-ekle" class="btn btn-success d-block p-2 mt-3" style="border: 2px dotted #6cbd6b; color: #126503; background: #dfffde; width: 100%; border-radius: 8px; font-weight: 600;">
                <i class="fa fa-plus-circle"></i> Yeni Malzeme Ekle
              </button>
            </div>
            <!-- /.card-body -->

            <div class="card-footer border-0" style="background-color: #f8f9fa; padding: 20px 30px; border-radius: 0 0 12px 12px;">
              <div class="row">
                <div class="col">
                  <a href="<?=base_url("depo_onay")?>" class="btn btn-danger btn-lg shadow-sm" style="border-radius: 8px; font-weight: 600; padding: 10px 25px;">
                    <i class="fas fa-times"></i> İptal
                  </a>
                </div>
                <div class="col text-right">
                  <button type="submit" class="btn btn-success btn-lg shadow-sm" style="border-radius: 8px; font-weight: 600; padding: 10px 25px;">
                    <i class="fas fa-check"></i> Kaydet & Depo Çıkış Onayı Ver
                  </button>
                </div>
              </div>
            </div>
            <!-- /.card-footer-->
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<style>
  .form-group-modern {
    margin-bottom: 0;
  }

  .form-label-modern {
    display: block;
    font-weight: 600;
    color: #495057;
    margin-bottom: 8px;
    font-size: 14px;
  }

  .form-control-modern {
    border-radius: 8px;
    border: 1px solid #ced4da;
    padding: 10px 15px;
    transition: all 0.3s ease;
  }

  .form-control-modern:focus {
    border-color: #001657;
    box-shadow: 0 0 0 0.2rem rgba(0, 22, 87, 0.25);
  }

  .malzeme-row {
    transition: all 0.2s ease;
  }

  .malzeme-row:hover {
    background-color: #e9ecef !important;
    border-color: #001657 !important;
  }

  .custom-control-input:checked ~ .custom-control-label::before {
    background-color: #ffc107;
    border-color: #ffc107;
  }

  .eski-parca-onay-container {
    animation: fadeIn 0.3s ease;
  }

  @keyframes fadeIn {
    from {
      opacity: 0;
      transform: translateY(-5px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const malzemeOptions = `<?php foreach($stok_tanimlari as $malzeme): ?> 
    <option value="<?=$malzeme->stok_tanim_id?>"><?=$malzeme->stok_tanim_ad?></option>
  <?php endforeach; ?>`;

  let malzemeIndex = <?=$index?>;

  // Eski parça checkbox'ları için event listener
  document.querySelectorAll('.eski-parca-checkbox').forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
      const index = this.getAttribute('data-index');
      const onayContainer = document.getElementById('onay_container_' + index);
      const alindiInput = document.getElementById('eski_parca_alindi_' + index);
      const tarihInput = document.getElementById('eski_parca_alindi_tarih_' + index);
      
      if (this.checked) {
        // Checkbox işaretlendiğinde onay container'ını göster
        // Not: Gerçek onay işlemi controller'da yapılacak
        onayContainer.style.display = 'none'; // Başlangıçta gizli, controller'da alındığında gösterilecek
        alindiInput.value = '0';
        tarihInput.value = '';
      } else {
        onayContainer.style.display = 'none';
        alindiInput.value = '0';
        tarihInput.value = '';
      }
    });
  });

  // Yeni malzeme ekle
  document.getElementById('yeni-malzeme-ekle').addEventListener('click', function(e) {
    e.preventDefault();
    const container = document.getElementById('malzeme-container');

    const newRow = document.createElement('div');
    newRow.classList.add('malzeme-row', 'mb-3', 'p-3', 'border', 'rounded');
    newRow.style.backgroundColor = '#f8f9fa';
    newRow.style.borderColor = '#dee2e6';
    newRow.innerHTML = `
      <div class="row align-items-end">
        <div class="col-md-4">
          <div class="form-group-modern mb-0">
            <label class="form-label-modern" style="font-size: 13px; margin-bottom: 5px;">
              <i class="fas fa-box text-primary mr-1"></i>
              Talep Edilen Malzeme
            </label>
            <select name="stok_kayit_no[]" required class="select2 form-control form-control-modern" style="width: 100%;">
              <option value="">Malzeme Seçimi Yapınız</option>
              ${malzemeOptions}
            </select>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group-modern mb-0">
            <label class="form-label-modern" style="font-size: 13px; margin-bottom: 5px;">
              <i class="fas fa-hashtag text-primary mr-1"></i>
              Miktar
            </label>
            <input type="number" required class="form-control form-control-modern" min="1" name="talep_miktar[]">
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group-modern mb-0">
            <label class="form-label-modern" style="font-size: 13px; margin-bottom: 5px;">
              <i class="fas fa-recycle text-warning mr-1"></i>
              Eski Parça Bilgisi
            </label>
            <div class="d-flex align-items-center">
              <div class="custom-control custom-checkbox mr-3">
                <input type="checkbox" 
                       class="custom-control-input eski-parca-checkbox" 
                       id="eski_parca_${malzemeIndex}" 
                       name="eski_parca_alınacak[]" 
                       value="${malzemeIndex}"
                       data-index="${malzemeIndex}">
                <label class="custom-control-label" for="eski_parca_${malzemeIndex}" style="font-size: 13px; cursor: pointer;">
                  Eski Parça Alınacak
                </label>
              </div>
              <div class="eski-parca-onay-container" id="onay_container_${malzemeIndex}" style="display: none;">
                <span class="badge badge-success" style="padding: 6px 12px; border-radius: 6px; font-size: 12px;">
                  <i class="fas fa-check-circle mr-1"></i>
                  Alındı
                </span>
              </div>
            </div>
            <input type="hidden" name="eski_parca_alindi[]" id="eski_parca_alindi_${malzemeIndex}" value="0">
            <input type="hidden" name="eski_parca_alindi_tarih[]" id="eski_parca_alindi_tarih_${malzemeIndex}" value="">
          </div>
        </div>
        <div class="col-md-3 text-right">
          <button type="button" style="margin-bottom: 0;" class="btn btn-danger btn-sm remove-row" title="Satırı Sil">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="row mt-2">
        <div class="col-12">
          <div class="form-group-modern mb-0">
            <label class="form-label-modern" style="font-size: 13px; margin-bottom: 5px;">
              <i class="fas fa-exclamation-triangle text-danger mr-1"></i>
              Ürün Arızası Açıklaması <small class="text-muted">(Opsiyonel)</small>
            </label>
            <textarea 
              name="urun_ariza_aciklama[]" 
              class="form-control form-control-modern" 
              rows="2" 
              placeholder="Varsa ürün arızası açıklamasını buraya yazabilirsiniz..."></textarea>
          </div>
        </div>
      </div>
    `;

    container.appendChild(newRow);
    $(newRow).find('select').select2();

    // Yeni eklenen satır için checkbox event listener
    const newCheckbox = newRow.querySelector('.eski-parca-checkbox');
    newCheckbox.addEventListener('change', function() {
      const index = this.getAttribute('data-index');
      const onayContainer = document.getElementById('onay_container_' + index);
      const alindiInput = document.getElementById('eski_parca_alindi_' + index);
      const tarihInput = document.getElementById('eski_parca_alindi_tarih_' + index);
      
      if (this.checked) {
        onayContainer.style.display = 'none';
        alindiInput.value = '0';
        tarihInput.value = '';
      } else {
        onayContainer.style.display = 'none';
        alindiInput.value = '0';
        tarihInput.value = '';
      }
    });

    // Sil butonu
    newRow.querySelector('.remove-row').addEventListener('click', function () {
      newRow.remove();
    });

    malzemeIndex++;
  });

  // Mevcut satırlar için sil butonu
  document.querySelectorAll('.remove-row').forEach(function(btn) {
    btn.addEventListener('click', function() {
      this.closest('.malzeme-row').remove();
    });
  });
  
  $('.select2').select2();
});
</script>
