 <!-- Container -->
 <div class="container-fixed" id="content_container">
     </div>
     <!-- End of Container -->
     <!-- Container -->
     <div class="container-fixed">
      <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
       <div class="flex flex-col justify-center gap-2">
        <h1 class="text-xl font-medium leading-none text-gray-900">
         Talepler
        </h1>
        <div class="flex items-center gap-2 text-sm font-normal text-gray-700">
         Tüm ug ajans müşteri talepleri listelenmiştir. Yeni kayıt oluşturmak için Talep Ekle butonuna tıklayınız.
        </div>
       </div>
       <div class="flex items-center gap-2.5">
        <button class="btn btn-primary" data-modal-toggle="#yeni_talep_modal">
         <i class="ki-filled ki-plus"></i>
         Yeni Talep Ekle
        </button>
       </div>
      </div>
     </div>
     <!-- End of Container -->
     <!-- Container -->
     <div class="container-fixed">
      
<?php 
   $tumcount = 0;
   $yenicount = 0;
   $tekrarcount = 0;
   $olumsuzcount = 0;
   $istemiyorcount = 0;
   
foreach ($talepler_data as $talep) {
    $tumcount++;
    if($talep->talep_kategori_no == 1){ $yenicount++; }
    if($talep->talep_kategori_no == 2){ $tekrarcount++; }
    if($talep->talep_kategori_no == 3){ $olumsuzcount++; }
    if($talep->talep_kategori_no == 4){ $istemiyorcount++; }
}

?>

<div class="min-w-full mb-4">
  <div class="flex flex-col sm:flex-row items-stretch sm:items-center flex-wrap gap-2 border-gray-300 border-t border-b border-dashed py-3" data-tabs="true">
    <a class="group btn px-3 text-gray-700 hover:text-primary tab-active:bg-primary-light tab-active:border-primary-clarity tab-active:text-primary" href="<?=base_url('ugajans_talep')?>">
      <i class="ki-filled ki-message-text text-gray-500 group-hover:text-primary tab-active:text-primary"></i>
      TÜMÜ (<?=$tumcount?>)
    </a>
    <?php 
      $tkat = get_talep_kategoriler();
      foreach ($tkat as $tk) {
    ?>
    <a href="<?=base_url('ugajans_talep?filter='.$tk->talep_kategori_id)?>" class="group btn px-3 text-gray-700 hover:text-primary tab-active:bg-primary-light tab-active:border-primary-clarity tab-active:text-primary">
      <i class="ki-filled ki-message-text text-gray-500 group-hover:text-primary tab-active:text-primary"></i>
      <?=$tk->talep_kategori_adi?>
      <?php 
        switch ($tk->talep_kategori_id) {
          case 1:
            echo "(".$yenicount.")";
            break;
          case 2:
            echo "(".$tekrarcount.")";
            break;  
          case 3:
            echo "(".$olumsuzcount.")";
            break; 
          case 4:
            echo "(".$istemiyorcount.")";
            break;               
          default:
            break;
        }
      ?>
    </a>
    <?php } ?>
  </div>
</div>

<div class="card card-grid min-w-full">
  <div class="card-header flex-wrap gap-2">
    <h3 class="card-title font-medium text-sm">Talep Listesi</h3>
    <div class="flex flex-wrap gap-2 lg:gap-5">
      <div class="flex">
        <label class="input input-sm">
          <i class="ki-filled ki-magnifier"></i>
          <input placeholder="Talep Ara..." type="text" id="talep_arama_input" value="">
        </label>
      </div>
    </div>
  </div>
  <div class="card-body">
    <div class="scrollable-x-auto">
      <table class="table table-auto table-border" id="talepler_tablosu">
        <thead>
          <tr>
            <th class="min-w-[200px]">
              <span class="sort-label font-normal text-gray-700">Müşteri Bilgileri</span>
            </th>
            <th class="min-w-[140px]">
              <span class="sort-label font-normal text-gray-700">Kayıt Tarihi</span>
            </th>
            <th class="min-w-[160px]">
              <span class="sort-label font-normal text-gray-700">Talep Kaynağı</span>
            </th>
            <th class="min-w-[130px] text-center">
              <span class="sort-label font-normal text-gray-700">Durum</span>
            </th>
            <th class="min-w-[180px]">
              <span class="sort-label font-normal text-gray-700">Email</span>
            </th>
            <th class="w-[100px] text-center">
              <span class="sort-label font-normal text-gray-700">İşlemler</span>
            </th>
          </tr>
        </thead>
        <tbody>
            <?php
            $has_results = false;
            foreach ($talepler_data as $talep) :
              if(isset($_GET["filter"])){
                if($_GET["filter"] != $talep->talep_kategori_no){
                  continue;
                } 
              }
              $has_results = true;
              
              // Kaynak kontrolü - WhatsApp ve Website için özel stil
              $kaynak_adi_lower = strtolower($talep->ugajans_talep_kaynak_adi);
              $is_whatsapp = (strpos($kaynak_adi_lower, 'whatsapp') !== false || strpos($kaynak_adi_lower, 'whats') !== false);
              $is_website = (strpos($kaynak_adi_lower, 'website') !== false || strpos($kaynak_adi_lower, 'web') !== false || strpos($kaynak_adi_lower, 'site') !== false);
              
              $kaynak_badge_class = '';
              $kaynak_icon = '';
              if($is_whatsapp) {
                $kaynak_badge_class = 'bg-success text-white';
                $kaynak_icon = '<i class="fab fa-whatsapp"></i>';
              } elseif($is_website) {
                $kaynak_badge_class = 'bg-primary text-white';
                $kaynak_icon = '<i class="fas fa-globe"></i>';
              }
            ?>
            <tr>
              <td>
                <div class="flex items-center gap-2.5">
                  <div class="flex-shrink-0 size-10 flex items-center justify-center rounded-full bg-primary-light">
                    <span class="text-primary font-semibold text-sm">
                      <?=mb_substr(trim($talep->talep_ad_soyad), 0, 1, 'UTF-8')?>
                    </span>
                  </div>
                  <div class="flex flex-col">
                    <div class="text-sm font-medium text-gray-900">
                      <?=$talep->talep_ad_soyad?>
                    </div>
                    <div class="flex items-center gap-1.5 mt-0.5">
                      <i class="fas fa-phone text-xs text-gray-500"></i>
                      <span class="text-xs text-gray-700">
                        <?=$talep->talep_iletisim_numarasi?>
                      </span>
                    </div>
                  </div>
                </div>
              </td>
              <td>
                <div class="text-sm font-medium text-gray-900">
                  <?=date("d.m.Y",strtotime($talep->talep_kayit_tarihi))?>
                </div>
                <div class="text-xs text-gray-500 mt-0.5">
                  <i class="far fa-clock mr-1"></i><?=date("H:i",strtotime($talep->talep_kayit_tarihi))?>
                </div>
              </td>
              <td>
                <div class="flex items-center gap-2">
                  <?php if($talep->talep_kaynak_gorsel && $talep->talep_kaynak_gorsel != ""): ?>
                    <img alt="" class="rounded-full size-5 shrink-0" src="<?=base_url($talep->talep_kaynak_gorsel)?>"/>
                  <?php endif; ?>
                  <span class="badge badge-pill <?=$kaynak_badge_class?>" style="<?=$kaynak_badge_class ? '' : 'background: #f3f4f6; color: #374151;'?>">
                    <?=$kaynak_icon?>
                    <span class="ml-1"><?=$talep->ugajans_talep_kaynak_adi?></span>
                  </span>
                </div>
              </td>
              <td class="text-center">
                <span class="badge badge-pill badge-outline <?=$talep->talep_kategori_class?> gap-1 items-center">
                  <span class="badge badge-dot size-1.5 <?=$talep->talep_kategori_class?>"></span>
                  <?=$talep->talep_kategori_adi?>
                </span>
              </td>
              <td>
                <?php if($talep->talep_email_adresi): ?>
                  <div class="flex items-center gap-1.5">
                    <i class="fas fa-envelope text-xs text-gray-500"></i>
                    <span class="text-xs text-gray-700 truncate" style="max-width: 180px;" title="<?=$talep->talep_email_adresi?>">
                      <?=$talep->talep_email_adresi?>
                    </span>
                  </div>
                <?php else: ?>
                  <span class="text-xs text-gray-400">-</span>
                <?php endif; ?>
              </td>
              <td>
                <div class="flex items-center gap-1 justify-center">
                  <a href="#" onclick="duzenle_talep_modal(<?=$talep->talep_id?>); return false;" class="btn btn-sm btn-icon btn-light btn-clear" title="Düzenle">
                    <i class="ki-filled ki-notepad-edit"></i>
                  </a>
                  <?php $curl = base_url("ugajans_talep/talep_sil/$talep->talep_id")?>
                  <a onclick="confirm_action('Bu talep kaydını silmek istediğinize emin misiniz?','<?=$curl?>'); return false;" class="btn btn-sm btn-icon btn-light btn-clear" title="Sil">
                    <i class="ki-filled ki-trash"></i>
                  </a>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
            <?php if(!$has_results): ?>
            <tr>
              <td colspan="6" class="text-center py-12">
                <div class="flex flex-col items-center justify-center">
                  <i class="ki-filled ki-information-2 text-4xl text-gray-300 mb-3"></i>
                  <p class="text-gray-500 text-sm font-medium">Henüz talep bulunmamaktadır</p>
                  <p class="text-gray-400 text-xs mt-1">Yeni talep eklemek için yukarıdaki butonu kullanabilirsiniz</p>
                </div>
              </td>
            </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="card-footer justify-between items-center">
    <div class="text-sm text-gray-600">
      Toplam <span class="font-semibold text-gray-900"><?=$tumcount?></span> talep gösteriliyor
    </div>
  </div>
</div>

<!-- Yeni Talep Modal -->
<div class="modal" data-modal="true" data-modal-disable-scroll="false" id="yeni_talep_modal" style="display: none;">
  <div class="modal-content max-w-[600px] top-[10%]">
    <div class="modal-header pr-2.5">
      <h3 class="modal-title">Yeni Talep Oluştur</h3>
      <button class="btn btn-sm btn-icon btn-light btn-clear shrink-0" data-modal-dismiss="true">
        <i class="ki-filled ki-cross"></i>
      </button>
    </div>
    <form action="<?=base_url("ugajans_talep/talep_ekle")?>" method="post">
      <div class="modal-body p-0">
        <div class="p-5 grid gap-5">
          <p class="text-2sm text-gray-600">
            <i class="ki-filled ki-information-2 leading-none"></i> 
            Yeni talep oluşturmak için belirtilen tüm alanları doldurunuz. Görüşme sonucunun detaylı girilmesi daha sonraki süreçler için faydalı olacaktır.
          </p>
          
          <div class="flex items-center flex-wrap lg:flex-nowrap gap-2.5">
            <label class="form-label" style="min-width:120px">Ad Soyad <span class="text-danger">*</span></label>
            <div class="grow">
              <input class="input" name="talep_ad_soyad" placeholder="Müşteri Adı Soyadı" type="text" required>
            </div>
          </div>
          
          <div class="flex items-center flex-wrap lg:flex-nowrap gap-2.5">
            <label class="form-label" style="min-width:120px">İletişim <span class="text-danger">*</span></label>
            <div class="grow">
              <input class="input" name="talep_iletisim_numarasi" placeholder="İletişim Numarası" type="text" required>
            </div>
          </div>
          
          <div class="flex items-center flex-wrap lg:flex-nowrap gap-2.5">
            <label class="form-label" style="min-width:120px">Email</label>
            <div class="grow">
              <input class="input" name="talep_email_adresi" placeholder="Email Adresi" type="email">
            </div>
          </div>
          
          <div class="flex items-center flex-wrap lg:flex-nowrap gap-2.5">
            <label class="form-label" style="min-width:120px">Kaynak <span class="text-danger">*</span></label>
            <div class="grow">
              <select class="select" name="talep_kaynak_no" required>
                <option value="">Kaynak Seçiniz</option>
                <?php 
                $tkaynaklar = get_talep_kaynaklar();
                foreach ($tkaynaklar as $tk) {
                ?>
                <option value="<?=$tk->ugajans_talep_kaynak_id?>">
                  <?=$tk->ugajans_talep_kaynak_adi?>
                </option>
                <?php } ?>
              </select>
            </div>
          </div>
          
          <div class="flex items-center flex-wrap lg:flex-nowrap gap-2.5">
            <label class="form-label" style="min-width:120px">Durum <span class="text-danger">*</span></label>
            <div class="grow">
              <select class="select" name="talep_kategori_no" required>
                <option value="">Durum Seçiniz</option>
                <?php 
                $tkategoriler = get_talep_kategoriler();
                foreach ($tkategoriler as $tk) {
                ?>
                <option value="<?=$tk->talep_kategori_id?>">
                  <?=$tk->talep_kategori_adi?>
                </option>
                <?php } ?>
              </select>
            </div>
          </div>
          
          <div class="flex items-start flex-wrap lg:flex-nowrap gap-2.5">
            <label class="form-label" style="min-width:120px">Görüşme Detayları</label>
            <div class="grow">
              <textarea class="input" name="talep_gorusme_detaylari" style="height:120px" placeholder="Görüşme detaylarını buraya yazabilirsiniz..."></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer flex justify-end gap-2 p-5 pt-0">
        <button type="button" class="btn btn-light" data-modal-dismiss="true">İptal</button>
        <button type="submit" class="btn btn-success">Bilgileri Kaydet</button>
      </div>
    </form>
  </div>
</div>

<!-- Düzenleme Talep Modal -->
<div class="modal" data-modal="true" data-modal-disable-scroll="false" id="duzenle_talep_modal" style="display: none;">
  <div class="modal-content max-w-[600px] top-[10%]">
    <div class="modal-header pr-2.5">
      <h3 class="modal-title">Talep Bilgilerini Düzenle</h3>
      <button class="btn btn-sm btn-icon btn-light btn-clear shrink-0" data-modal-dismiss="true">
        <i class="ki-filled ki-cross"></i>
      </button>
    </div>
    <form id="duzenle_talep_form" method="post">
      <div class="modal-body p-0">
        <div class="p-5 grid gap-5">
          <p class="text-2sm text-gray-600">
            <i class="ki-filled ki-information-2 leading-none"></i> 
            Bilgileri güncellemek için belirtilen tüm alanları doldurunuz. Görüşme sonucunun detaylı girilmesi daha sonraki süreçler için faydalı olacaktır.
          </p>
          
          <div class="flex items-center flex-wrap lg:flex-nowrap gap-2.5">
            <label class="form-label" style="min-width:120px">Ad Soyad <span class="text-danger">*</span></label>
            <div class="grow">
              <input class="input" name="talep_ad_soyad" id="edit_talep_ad_soyad" placeholder="Müşteri Adı Soyadı" type="text" required>
            </div>
          </div>
          
          <div class="flex items-center flex-wrap lg:flex-nowrap gap-2.5">
            <label class="form-label" style="min-width:120px">İletişim <span class="text-danger">*</span></label>
            <div class="grow">
              <input class="input" name="talep_iletisim_numarasi" id="edit_talep_iletisim_numarasi" placeholder="İletişim Numarası" type="text" required>
            </div>
          </div>
          
          <div class="flex items-center flex-wrap lg:flex-nowrap gap-2.5">
            <label class="form-label" style="min-width:120px">Email</label>
            <div class="grow">
              <input class="input" name="talep_email_adresi" id="edit_talep_email_adresi" placeholder="Email Adresi" type="email">
            </div>
          </div>
          
          <div class="flex items-center flex-wrap lg:flex-nowrap gap-2.5">
            <label class="form-label" style="min-width:120px">Kaynak <span class="text-danger">*</span></label>
            <div class="grow">
              <select class="select" name="talep_kaynak_no" id="edit_talep_kaynak_no" required>
                <option value="">Kaynak Seçiniz</option>
                <?php 
                $tkaynaklar = get_talep_kaynaklar();
                foreach ($tkaynaklar as $tk) {
                ?>
                <option value="<?=$tk->ugajans_talep_kaynak_id?>">
                  <?=$tk->ugajans_talep_kaynak_adi?>
                </option>
                <?php } ?>
              </select>
            </div>
          </div>
          
          <div class="flex items-center flex-wrap lg:flex-nowrap gap-2.5">
            <label class="form-label" style="min-width:120px">Durum <span class="text-danger">*</span></label>
            <div class="grow">
              <select class="select" name="talep_kategori_no" id="edit_talep_kategori_no" required>
                <option value="">Durum Seçiniz</option>
                <?php 
                $tkategoriler = get_talep_kategoriler();
                foreach ($tkategoriler as $tk) {
                ?>
                <option value="<?=$tk->talep_kategori_id?>">
                  <?=$tk->talep_kategori_adi?>
                </option>
                <?php } ?>
              </select>
            </div>
          </div>
          
          <div class="flex items-start flex-wrap lg:flex-nowrap gap-2.5">
            <label class="form-label" style="min-width:120px">Görüşme Detayları</label>
            <div class="grow">
              <textarea class="input" name="talep_gorusme_detaylari" id="edit_talep_gorusme_detaylari" style="height:120px" placeholder="Görüşme detaylarını buraya yazabilirsiniz..."></textarea>
            </div>
          </div>
          
          <input type="hidden" name="talep_id" id="edit_talep_id">
        </div>
      </div>
      <div class="modal-footer flex justify-end gap-2 p-5 pt-0">
        <button type="button" class="btn btn-light" data-modal-dismiss="true">İptal</button>
        <button type="submit" class="btn btn-success">Değişiklikleri Kaydet</button>
      </div>
    </form>
  </div>
</div>

<script>
// Modal açma fonksiyonu
function openModal(modalId) {
  // # işaretini kaldır
  const cleanId = modalId.replace('#', '');
  const modal = document.getElementById(cleanId);
  if (modal) {
    modal.classList.add('open');
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
  }
}

// Modal kapatma fonksiyonu
function closeModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.classList.remove('open');
    modal.style.display = 'none';
    document.body.style.overflow = '';
  }
}

// Modal toggle
document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('[data-modal-toggle]').forEach(button => {
    button.addEventListener('click', function(e) {
      e.preventDefault();
      const modalId = this.getAttribute('data-modal-toggle');
      if (modalId) {
        openModal(modalId);
      }
    });
  });

  // Modal dismiss
  document.querySelectorAll('[data-modal-dismiss]').forEach(button => {
    button.addEventListener('click', function(e) {
      e.preventDefault();
      const modal = this.closest('.modal');
      if (modal) {
        closeModal(modal.id);
      }
    });
  });

  // Dışarı tıklayınca kapat
  document.querySelectorAll('.modal').forEach(modal => {
    modal.addEventListener('click', function(e) {
      if (e.target === this) {
        closeModal(this.id);
      }
    });
  });
});

// Talep düzenleme modal fonksiyonu
function duzenle_talep_modal(talep_id) {
  // AJAX ile talep bilgilerini getir
  fetch('<?=base_url("ugajans_talep/get_talep_data/")?>' + talep_id)
    .then(response => response.json())
    .then(data => {
      if(data.success) {
        document.getElementById('edit_talep_id').value = data.talep.talep_id;
        document.getElementById('edit_talep_ad_soyad').value = data.talep.talep_ad_soyad || '';
        document.getElementById('edit_talep_iletisim_numarasi').value = data.talep.talep_iletisim_numarasi || '';
        document.getElementById('edit_talep_email_adresi').value = data.talep.talep_email_adresi || '';
        document.getElementById('edit_talep_kaynak_no').value = data.talep.talep_kaynak_no || '';
        document.getElementById('edit_talep_kategori_no').value = data.talep.talep_kategori_no || '';
        document.getElementById('edit_talep_gorusme_detaylari').value = data.talep.talep_gorusme_detaylari || '';
        
        document.getElementById('duzenle_talep_form').action = '<?=base_url("ugajans_talep/talep_guncelle/")?>' + talep_id;
        
        openModal('#duzenle_talep_modal');
      } else {
        alert('Talep bilgileri yüklenemedi: ' + (data.message || 'Bilinmeyen hata'));
      }
    })
    .catch(error => {
      console.error('Hata:', error);
      alert('Talep bilgileri yüklenirken bir hata oluştu. Sayfa yenileniyor...');
      // Fallback: Sayfa yenileme ile düzenleme
      window.location.href = '<?=base_url("ugajans_talep/index/")?>' + talep_id + '?filter=<?=isset($_GET["filter"]) ? $_GET["filter"] : "0"?>';
    });
}

// Arama fonksiyonu
document.addEventListener('DOMContentLoaded', function() {
  const searchInput = document.getElementById('talep_arama_input');
  const table = document.getElementById('talepler_tablosu');
  
  if(searchInput && table) {
    const rows = table.querySelectorAll('tbody tr');
    
    searchInput.addEventListener('keyup', function() {
      const searchText = this.value.toLowerCase();
      
      rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        if(text.includes(searchText)) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
    });
  }
});
</script>

     </div>
     <!-- End of Container -->
