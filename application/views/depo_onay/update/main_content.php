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
              <div class="d-flex gap-2">
                <a href="<?=base_url("depo_onay")?>" class="btn btn-light btn-lg shadow-sm" style="border-radius: 8px; font-weight: 600; padding: 10px 20px;">
                  <i class="fas fa-arrow-left mr-2"></i> Listeye Dön
                </a>
                <button type="button" id="yeni-malzeme-ekle" class="btn btn-success btn-lg shadow-sm" style="border-radius: 8px; font-weight: 600; padding: 10px 20px;">
                  <i class="fas fa-plus-circle mr-2"></i> Kalem Ekle
                </button>
              </div>
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
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h5 style="color: #495057; font-weight: 600; margin-bottom: 0;">
                    <i class="fas fa-boxes text-primary mr-2"></i>
                    Talep Edilen Malzemeler
                  </h5>
                </div>
                <div class="alert alert-info" style="background-color: #001657; border-left: 4px solid #001657; border-radius: 6px; padding: 12px 15px; margin-bottom: 20px;">
                  <i class="fas fa-info-circle mr-2"></i>
                  <strong>Bilgi:</strong> Eski parça alınması gereken malzemeler için "Eski Parça Alınacak mı?" seçeneğini işaretleyin. 
                  <span class="text-muted">(Tüm malzemeler için zorunlu değildir)</span>
                </div>
              </div>

              <div class="table-responsive">
                <table class="table table-bordered table-hover" id="malzeme-table" style="background-color: #ffffff; border-radius: 8px; overflow: hidden;">
                  <thead style="background: linear-gradient(135deg, #001657 0%, #001657 100%); color: #ffffff;">
                    <tr>
                      <th style="font-weight: 600; padding: 15px; text-align: center; width: 25%;">
                        <i class="fas fa-box mr-2"></i>Malzeme
                      </th>
                      <th style="font-weight: 600; padding: 15px; text-align: center; width: 10%;">
                        <i class="fas fa-hashtag mr-2"></i>Miktar
                      </th>
                      <th style="font-weight: 600; padding: 15px; text-align: center; width: 25%;">
                        <i class="fas fa-recycle mr-2"></i>Eski Parça <small style="font-size: 11px; opacity: 0.8;">(Opsiyonel)</small>
                      </th>
                      <th style="font-weight: 600; padding: 15px; text-align: center; width: 15%;">
                        <i class="fas fa-check-circle mr-2"></i>Alındı mı? <small style="font-size: 11px; opacity: 0.8;">(Eski parça için)</small>
                      </th>
                      <th style="font-weight: 600; padding: 15px; text-align: center; width: 20%;">
                        <i class="fas fa-exclamation-triangle mr-2"></i>Arıza Açıklaması
                      </th>
                      <th style="font-weight: 600; padding: 15px; text-align: center; width: 10%;">
                        <i class="fas fa-cog mr-2"></i>İşlem
                      </th>
                    </tr>
                  </thead>
                  <tbody id="malzeme-container">
                <?php 
                $index = 0;
                foreach ($veriler as $veri) :
                  $eski_parca_alindi = isset($veri->eski_parca_alindi) ? $veri->eski_parca_alindi : 0;
                  $eski_parca_alindi_tarih = isset($veri->eski_parca_alindi_tarih) ? $veri->eski_parca_alindi_tarih : null;
                ?>
                    <tr class="malzeme-row" style="vertical-align: middle;">
                      <td style="padding: 15px;">
                        <select name="stok_kayit_no[]" required class="select2 form-control form-control-modern" style="width: 100%; font-size: 14px;">
                          <option value="">Malzeme Seçiniz</option>
                          <?php foreach($stok_tanimlari as $malzeme): ?> 
                            <option <?=$veri->stok_talep_edilen_malzeme_stok_no==$malzeme->stok_tanim_id ? "selected" : ""?> value="<?=$malzeme->stok_tanim_id?>"><?=$malzeme->stok_tanim_ad?></option>
                          <?php endforeach; ?>  
                        </select>
                      </td>
                      <td style="padding: 15px; text-align: center;">
                        <input type="number" value="<?=$veri->stok_talep_edilen_malzeme_miktar?>" required class="form-control form-control-modern text-center" min="1" name="talep_miktar[]" style="font-size: 14px;">
                      </td>
                      <td style="padding: 15px;">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" 
                                 class="custom-control-input eski-parca-checkbox" 
                                 id="eski_parca_<?=$index?>" 
                                 name="eski_parca_alınacak[]" 
                                 value="<?=$index?>"
                                 data-index="<?=$index?>"
                                 <?=isset($veri->eski_parca_alınacak) && $veri->eski_parca_alınacak == 1 ? 'checked' : ''?>>
                          <label class="custom-control-label" for="eski_parca_<?=$index?>" style="font-size: 14px; cursor: pointer; margin-bottom: 0; font-weight: 500;">
                            Eski Parça Alınacak mı?
                          </label>
                        </div>
                        <small class="text-muted d-block mt-1" style="font-size: 11px; line-height: 1.4;">
                          <i class="fas fa-question-circle mr-1"></i>
                          Sadece eski parça alınacaksa işaretleyin
                        </small>
                        <input type="hidden" name="eski_parca_alindi[]" id="eski_parca_alindi_<?=$index?>" value="<?=$eski_parca_alindi?>">
                        <input type="hidden" name="eski_parca_alindi_tarih[]" id="eski_parca_alindi_tarih_<?=$index?>" value="<?=$eski_parca_alindi_tarih?>">
                      </td>
                      <td style="padding: 15px;">
                        <div class="eski-parca-durum-container" id="durum_container_<?=$index?>" style="display: <?=(isset($veri->eski_parca_alınacak) && $veri->eski_parca_alınacak == 1) ? 'block' : 'none'; ?>;">
                          <label class="d-block mb-1" style="font-size: 12px; font-weight: 600; color: #495057;">
                            Durum:
                          </label>
                          <select name="eski_parca_alindi_dropdown[]" 
                                  id="eski_parca_alindi_dropdown_<?=$index?>" 
                                  class="form-control form-control-modern" 
                                  style="font-size: 14px; font-weight: 500;">
                            <option value="0" <?=$eski_parca_alindi == 0 ? 'selected' : ''?>>Alınmadı</option>
                            <option value="1" <?=$eski_parca_alindi == 1 ? 'selected' : ''?>>Alındı</option>
                          </select>
                          <?php if($eski_parca_alindi == 1 && $eski_parca_alindi_tarih): ?>
                            <small class="text-success d-block mt-2" style="font-size: 11px;">
                              <i class="fas fa-calendar-check mr-1"></i>
                              Alındı: <?=date('d.m.Y H:i', strtotime($eski_parca_alindi_tarih))?>
                            </small>
                          <?php endif; ?>
                        </div>
                        <div id="durum_container_empty_<?=$index?>" style="display: <?=(isset($veri->eski_parca_alınacak) && $veri->eski_parca_alınacak == 1) ? 'none' : 'block'; ?>;">
                          </span>
                        </div>
                      </td>
                      <td style="padding: 15px;">
                        <textarea 
                          name="urun_ariza_aciklama[]" 
                          class="form-control form-control-modern" 
                          rows="2" 
                          placeholder="Varsa ürün arızası açıklamasını yazınız..."
                          style="font-size: 13px; resize: vertical;"><?=isset($veri->urun_ariza_aciklama) ? htmlspecialchars($veri->urun_ariza_aciklama) : ''?></textarea>
                      </td>
                      <td style="padding: 15px; text-align: center;">
                        <button type="button" class="btn btn-danger btn-sm remove-row" title="Satırı Sil" style="padding: 6px 12px;">
                          <i class="fas fa-trash"></i>
                        </button>
                      </td>
                    </tr>
                <?php 
                $index++;
                endforeach;
                ?>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer border-0" style="background-color: #f8f9fa; padding: 25px 30px; border-radius: 0 0 12px 12px;">
              <div class="d-flex justify-content-between align-items-center">
                <a href="<?=base_url("depo_onay")?>" class="btn btn-danger btn-lg shadow-sm" style="border-radius: 8px; font-weight: 600; padding: 12px 30px;">
                  <i class="fas fa-times mr-2"></i> İptal
                </a>
                <button type="submit" class="btn btn-success btn-lg shadow-sm" style="border-radius: 8px; font-weight: 600; padding: 12px 30px;">
                  <i class="fas fa-check mr-2"></i> Kaydet & Depo Çıkış Onayı Ver
                </button>
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
    background-color: #f8f9fa !important;
  }

  #malzeme-table tbody tr {
    border-bottom: 1px solid #dee2e6;
  }

  #malzeme-table tbody tr:last-child {
    border-bottom: none;
  }

  #malzeme-table thead th {
    border-bottom: 2px solid rgba(255,255,255,0.3);
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
      const durumContainer = document.getElementById('durum_container_' + index);
      const alindiInput = document.getElementById('eski_parca_alindi_' + index);
      const tarihInput = document.getElementById('eski_parca_alindi_tarih_' + index);
      const dropdown = document.getElementById('eski_parca_alindi_dropdown_' + index);
      
      if (this.checked) {
        // Checkbox işaretlendiğinde dropdown'u göster
        durumContainer.style.display = 'block';
        // Eğer değer yoksa "Alınmadı" olarak ayarla
        if (alindiInput.value == '' || alindiInput.value == '0') {
          if (dropdown) {
            dropdown.value = '0';
            alindiInput.value = '0';
            tarihInput.value = '';
          }
        }
      } else {
        // Checkbox işaret kaldırıldığında dropdown'u gizle
        durumContainer.style.display = 'none';
        if (dropdown) dropdown.value = '0';
        alindiInput.value = '0';
        tarihInput.value = '';
      }
    });
  });

  // Dropdown değiştiğinde hidden input'u güncelle
  document.querySelectorAll('[id^="eski_parca_alindi_dropdown_"]').forEach(function(dropdown) {
    dropdown.addEventListener('change', function() {
      const index = this.id.replace('eski_parca_alindi_dropdown_', '');
      const alindiInput = document.getElementById('eski_parca_alindi_' + index);
      const tarihInput = document.getElementById('eski_parca_alindi_tarih_' + index);
      
      alindiInput.value = this.value;
      if (this.value == '1') {
        // Alındı seçildiğinde tarih ekle
        if (!tarihInput.value) {
          tarihInput.value = new Date().toISOString().slice(0, 19).replace('T', ' ');
        }
      } else {
        tarihInput.value = '';
      }
    });
  });

  // Yeni malzeme ekle
  document.getElementById('yeni-malzeme-ekle').addEventListener('click', function(e) {
    e.preventDefault();
    const container = document.getElementById('malzeme-container');

    const newRow = document.createElement('tr');
    newRow.classList.add('malzeme-row');
    newRow.style.verticalAlign = 'middle';
    newRow.innerHTML = `
      <td style="padding: 15px;">
        <select name="stok_kayit_no[]" required class="select2 form-control form-control-modern" style="width: 100%; font-size: 14px;">
          <option value="">Malzeme Seçiniz</option>
          ${malzemeOptions}
        </select>
      </td>
      <td style="padding: 15px; text-align: center;">
        <input type="number" required class="form-control form-control-modern text-center" min="1" name="talep_miktar[]" style="font-size: 14px;">
      </td>
      <td style="padding: 15px;">
        <div class="custom-control custom-checkbox">
          <input type="checkbox" 
                 class="custom-control-input eski-parca-checkbox" 
                 id="eski_parca_${malzemeIndex}" 
                 name="eski_parca_alınacak[]" 
                 value="${malzemeIndex}"
                 data-index="${malzemeIndex}">
          <label class="custom-control-label" for="eski_parca_${malzemeIndex}" style="font-size: 14px; cursor: pointer; margin-bottom: 0; font-weight: 500;">
            Eski Parça Alınacak mı?
          </label>
        </div>
        <small class="text-muted d-block mt-1" style="font-size: 11px; line-height: 1.4;">
          <i class="fas fa-question-circle mr-1"></i>
          Sadece eski parça alınacaksa işaretleyin
        </small>
        <input type="hidden" name="eski_parca_alindi[]" id="eski_parca_alindi_${malzemeIndex}" value="0">
        <input type="hidden" name="eski_parca_alindi_tarih[]" id="eski_parca_alindi_tarih_${malzemeIndex}" value="">
      </td>
      <td style="padding: 15px;">
        <div class="eski-parca-durum-container" id="durum_container_${malzemeIndex}" style="display: none;">
          <label class="d-block mb-1" style="font-size: 12px; font-weight: 600; color: #ffffff;">
            Durum:
          </label>
          <select name="eski_parca_alindi_dropdown[]" 
                  id="eski_parca_alindi_dropdown_${malzemeIndex}" 
                  class="form-control form-control-modern" 
                  style="font-size: 14px; font-weight: 500;">
            <option value="0">Alınmadı</option>
            <option value="1">Alındı</option>
          </select>
        </div>
        <div id="durum_container_empty_${malzemeIndex}" style="display: block;">
        </div>
      </td>
      <td style="padding: 15px;">
        <textarea 
          name="urun_ariza_aciklama[]" 
          class="form-control form-control-modern" 
          rows="2" 
          placeholder="Varsa ürün arızası açıklamasını yazınız..."
          style="font-size: 13px; resize: vertical;"></textarea>
      </td>
      <td style="padding: 15px; text-align: center;">
        <button type="button" class="btn btn-danger btn-sm remove-row" title="Satırı Sil" style="padding: 6px 12px;">
          <i class="fas fa-trash"></i>
        </button>
      </td>
    `;

    container.appendChild(newRow);
    $(newRow).find('select').select2();

    // Yeni eklenen satır için checkbox event listener
    const newCheckbox = newRow.querySelector('.eski-parca-checkbox');
    newCheckbox.addEventListener('change', function() {
      const index = this.getAttribute('data-index');
      const durumContainer = document.getElementById('durum_container_' + index);
      const alindiInput = document.getElementById('eski_parca_alindi_' + index);
      const tarihInput = document.getElementById('eski_parca_alindi_tarih_' + index);
      const dropdown = document.getElementById('eski_parca_alindi_dropdown_' + index);
      
      const emptyContainer = document.getElementById('durum_container_empty_' + index);
      
      if (this.checked) {
        // Checkbox işaretlendiğinde dropdown'u göster
        if (durumContainer) durumContainer.style.display = 'block';
        if (emptyContainer) emptyContainer.style.display = 'none';
        if (dropdown) {
          dropdown.value = '0';
          alindiInput.value = '0';
          tarihInput.value = '';
        }
      } else {
        // Checkbox işaret kaldırıldığında dropdown'u gizle
        if (durumContainer) durumContainer.style.display = 'none';
        if (emptyContainer) emptyContainer.style.display = 'block';
        if (dropdown) dropdown.value = '0';
        alindiInput.value = '0';
        tarihInput.value = '';
      }
    });

    // Yeni eklenen satır için dropdown event listener
    const newDropdown = newRow.querySelector('[id^="eski_parca_alindi_dropdown_"]');
    if (newDropdown) {
      newDropdown.addEventListener('change', function() {
        const index = this.id.replace('eski_parca_alindi_dropdown_', '');
        const alindiInput = document.getElementById('eski_parca_alindi_' + index);
        const tarihInput = document.getElementById('eski_parca_alindi_tarih_' + index);
        
        alindiInput.value = this.value;
        if (this.value == '1') {
          // Alındı seçildiğinde tarih ekle
          if (!tarihInput.value) {
            tarihInput.value = new Date().toISOString().slice(0, 19).replace('T', ' ');
          }
        } else {
          tarihInput.value = '';
        }
      });
    }

    // Sil butonu
    const removeBtn = newRow.querySelector('.remove-row');
    if(removeBtn) {
      removeBtn.addEventListener('click', function () {
        newRow.remove();
      });
    }

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
