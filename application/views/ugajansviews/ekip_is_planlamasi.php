<!-- Container -->
<div class="container-fixed" id="content_container">
</div>
<!-- End of Container -->

<!-- Container -->
<div class="container-fixed">
 <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
  <div class="flex flex-col justify-center gap-2">
   <h1 class="text-xl font-medium leading-none text-gray-900">
    UGAjans Ekip - İş Planlaması
   </h1>
   <div class="flex items-center gap-2 text-sm font-normal text-gray-700">
    Ekip üyeleri için haftalık ve aylık iş planlaması yapabilirsiniz. Sutunlarda personel adları, satırlarda tarihler görünmektedir.
   </div>
  </div>
  <div class="flex items-center gap-2.5">
   <button class="btn btn-sm btn-primary" onclick="window.location.reload();">
    <i class="ki-filled ki-arrows-circle"></i>
    Yenile
   </button>
  </div>
 </div>
</div>
<!-- End of Container -->

<!-- Container -->
<div class="container-fixed">
 <div class="grid gap-5 lg:gap-7.5">
  <div class="card card-grid min-w-full">
   <div class="card-header flex-wrap gap-2">
    <h3 class="card-title font-medium text-sm">
     İş Planlaması Scheduler
    </h3>
   </div>
   <div class="card-body p-0">
    <div id="is_planlamasi_scheduler" style="width: 100%; height: 700px;"></div>
   </div>
  </div>
 </div>
</div>
<!-- End of Container -->

<!-- İş Planlaması Ekle/Düzenle Modal -->
<div class="modal" data-modal="true" data-modal-disable-scroll="false" id="is_planlamasi_modal">
 <div class="modal-content max-w-[700px] top-5 lg:top-[10%]">
  <div class="modal-header pr-2.5">
   <h3 class="modal-title" id="modal_baslik">Yeni İş Planı Ekle</h3>
   <button class="btn btn-sm btn-icon btn-light btn-clear shrink-0" data-modal-dismiss="true">
    <i class="ki-filled ki-cross"></i>
   </button>
  </div>
  <form id="is_planlamasi_form" action="<?=base_url("ugajans_ekip/is_planlamasi_ekle")?>" method="post">
   <input type="hidden" name="is_planlamasi_id" id="is_planlamasi_id" value="">
   <div class="modal-body grid gap-5 px-0 py-5">
    
    <div class="flex flex-col gap-2">
     <label class="text-sm font-medium text-gray-700">Personel <span class="text-danger">*</span></label>
     <select class="select" name="kullanici_no" id="kullanici_no" required>
      <option value="">Personel Seçiniz</option>
      <?php foreach ($kullanicilar_data as $kullanici): ?>
      <option value="<?=$kullanici->ugajans_kullanici_id?>"><?=$kullanici->ugajans_kullanici_ad_soyad?></option>
      <?php endforeach; ?>
     </select>
    </div>
    
    <div class="flex flex-col gap-2">
     <label class="text-sm font-medium text-gray-700">Tarih <span class="text-danger">*</span></label>
     <input type="date" class="input" name="planlama_tarihi" id="planlama_tarihi" required>
    </div>
    
    <div class="flex flex-col gap-2">
     <label class="text-sm font-medium text-gray-700">Planlama Tipi <span class="text-danger">*</span></label>
     <select class="select" name="planlama_tipi" id="planlama_tipi" required>
      <option value="haftalik">Haftalık</option>
      <option value="aylik">Aylık</option>
     </select>
    </div>
    
    <div class="flex flex-col gap-2">
     <label class="text-sm font-medium text-gray-700">Müşteri</label>
     <select class="select" name="musteri_no" id="musteri_no">
      <option value="">Müşteri Seçiniz (Opsiyonel)</option>
      <?php foreach ($musteriler_data as $musteri): ?>
      <option value="<?=$musteri->musteri_id?>"><?=$musteri->musteri_ad_soyad?> <?=isset($musteri->isletme_adi) && $musteri->isletme_adi != "" ? " - ".$musteri->isletme_adi : ""?></option>
      <?php endforeach; ?>
     </select>
    </div>
    
    <div class="flex flex-col gap-2">
     <label class="text-sm font-medium text-gray-700">Yapılacak İş</label>
     <input type="text" class="input" name="yapilacak_is" id="yapilacak_is" placeholder="Yapılacak iş başlığı (Opsiyonel)">
    </div>
    
    <div class="flex flex-col gap-2">
     <label class="text-sm font-medium text-gray-700">İş Notu <span class="text-danger">*</span></label>
     <textarea class="textarea" name="is_notu" id="is_notu" rows="5" placeholder="İş planı detaylarını buraya yazınız..." required></textarea>
    </div>
    
    <div class="flex flex-col gap-2" id="durum_div" style="display: none;">
     <label class="text-sm font-medium text-gray-700">Durum</label>
     <select class="select" name="planlama_durumu" id="planlama_durumu">
      <option value="0">Beklemede</option>
      <option value="1">Tamamlandı</option>
      <option value="2">İptal</option>
     </select>
    </div>
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-light" data-modal-dismiss="true">İptal</button>
    <button type="button" class="btn btn-danger" id="sil_btn" style="display: none;" onclick="silIsPlanlamasi()">Sil</button>
    <button type="submit" class="btn btn-primary">Kaydet</button>
   </div>
  </form>
 </div>
</div>

<!-- DayPilot Scheduler CDN -->
<script>
let scheduler;
let is_planlamasi_data = <?=json_encode($is_planlamasi_data, JSON_UNESCAPED_UNICODE)?>;
let kullanicilar_data = <?=json_encode($kullanicilar_data, JSON_UNESCAPED_UNICODE)?>;

function loadDayPilot() {
 var script = document.createElement('script');
 script.src = 'https://cdn.jsdelivr.net/npm/@daypilot/daypilot-lite-javascript@5.0.0/daypilot-javascript.min.js';
 script.onload = function() {
  initScheduler();
 };
 script.onerror = function() {
  console.error('DayPilot CDN yüklenemedi');
  var schedulerEl = document.getElementById('is_planlamasi_scheduler');
  if(schedulerEl) {
   schedulerEl.innerHTML = '<div class="p-5 text-center text-gray-600">DayPilot yüklenemedi. Lütfen sayfayı yenileyin.</div>';
  }
 };
 document.head.appendChild(script);
}

function initScheduler() {
 // DayPilot yüklendiğinde çalışacak
 if(typeof DayPilot === 'undefined') {
  console.error('DayPilot yüklenemedi');
  return;
 }
 
 var schedulerEl = document.getElementById('is_planlamasi_scheduler');
 if(!schedulerEl) {
  console.error('Scheduler elementi bulunamadı');
  return;
 }
 
 // DayPilot Scheduler oluştur
 scheduler = new DayPilot.Scheduler("is_planlamasi_scheduler", {
  timeHeaders: [
   {groupBy: "Month"},
   {groupBy: "Day", format: "d"}
  ],
  scale: "Day",
  days: 30,
  startDate: DayPilot.Date.today().firstDayOfMonth(),
  resources: [
   <?php foreach ($kullanicilar_data as $kullanici): ?>
   {
    id: "<?=strval($kullanici->ugajans_kullanici_id)?>",
    name: "<?=addslashes($kullanici->ugajans_kullanici_ad_soyad)?>"
   },
   <?php endforeach; ?>
  ],
  events: [
   <?php foreach ($is_planlamasi_data as $plan): ?>
   {
    id: "<?=strval($plan->is_planlamasi_id)?>",
    resource: "<?=strval($plan->kullanici_no)?>",
    start: "<?=$plan->planlama_tarihi?>",
    end: "<?=$plan->planlama_tarihi?>",
    text: "<?=mb_substr(addslashes($plan->is_notu), 0, 50)?><?=mb_strlen($plan->is_notu) > 50 ? '...' : ''?>",
    backColor: "<?=$plan->planlama_tipi == "haftalik" ? "#0d6efd" : "#198754"?>",
    barColor: "<?=$plan->planlama_tipi == "haftalik" ? "#0a58ca" : "#146c43"?>",
    tooltip: "<?=addslashes($plan->is_notu)?>"
   },
   <?php endforeach; ?>
  ],
  onTimeRangeSelected: function(args) {
   // Tarih ve personel seçildiğinde modal aç
   var kullaniciNoEl = document.getElementById('kullanici_no');
   var planlamaTarihiEl = document.getElementById('planlama_tarihi');
   var modalBaslikEl = document.getElementById('modal_baslik');
   var formEl = document.getElementById('is_planlamasi_form');
   var durumDivEl = document.getElementById('durum_div');
   var silBtnEl = document.getElementById('sil_btn');
   var musteriNoEl = document.getElementById('musteri_no');
   var yapilacakIsEl = document.getElementById('yapilacak_is');
   var isNotuEl = document.getElementById('is_notu');
   var planlamaTipiEl = document.getElementById('planlama_tipi');
   
   if(!kullaniciNoEl || !planlamaTarihiEl || !formEl) {
    console.error('Form elementleri bulunamadı');
    args.clearSelection();
    return;
   }
   
   kullaniciNoEl.value = args.resource;
   planlamaTarihiEl.value = args.start.toString("yyyy-MM-dd");
   if(document.getElementById('is_planlamasi_id')) {
    document.getElementById('is_planlamasi_id').value = '';
   }
   if(modalBaslikEl) modalBaslikEl.textContent = 'Yeni İş Planı Ekle';
   formEl.action = '<?=base_url("ugajans_ekip/is_planlamasi_ekle")?>';
   if(durumDivEl) durumDivEl.style.display = 'none';
   if(silBtnEl) silBtnEl.style.display = 'none';
   
   // Formu temizle
   if(musteriNoEl) musteriNoEl.value = '';
   if(yapilacakIsEl) yapilacakIsEl.value = '';
   if(isNotuEl) isNotuEl.value = '';
   if(planlamaTipiEl) planlamaTipiEl.value = 'haftalik';
   
   // Modal'ı aç
   var modal = document.querySelector('#is_planlamasi_modal');
   if(modal) {
    modal.style.display = 'flex';
    modal.classList.add('open');
   }
   
   args.clearSelection();
  },
  onEventClick: function(args) {
   // Mevcut planı düzenle
   var event = args.e;
   var planId = event.id();
   var plan = is_planlamasi_data.find(function(p) {
    return String(p.is_planlamasi_id) === String(planId);
   });
   
   if(plan) {
    document.getElementById('is_planlamasi_id').value = plan.is_planlamasi_id;
    document.getElementById('kullanici_no').value = plan.kullanici_no;
    document.getElementById('planlama_tarihi').value = plan.planlama_tarihi;
    document.getElementById('planlama_tipi').value = plan.planlama_tipi;
    document.getElementById('is_notu').value = plan.is_notu;
    document.getElementById('planlama_durumu').value = plan.planlama_durumu || 0;
    if(document.getElementById('musteri_no')) {
     document.getElementById('musteri_no').value = plan.musteri_no || '';
    }
    if(document.getElementById('yapilacak_is')) {
     document.getElementById('yapilacak_is').value = plan.yapilacak_is || '';
    }
    document.getElementById('modal_baslik').textContent = 'İş Planı Düzenle';
    document.getElementById('is_planlamasi_form').action = '<?=base_url("ugajans_ekip/is_planlamasi_guncelle/")?>' + plan.is_planlamasi_id;
    document.getElementById('durum_div').style.display = 'block';
    document.getElementById('sil_btn').style.display = 'inline-block';
    
    // Modal'ı aç
    var modal = document.querySelector('#is_planlamasi_modal');
    if(modal) {
     modal.style.display = 'flex';
     modal.classList.add('open');
    }
   }
  }
 });
 
 scheduler.init();
}

// Sayfa yüklendiğinde DayPilot'u yükle
document.addEventListener('DOMContentLoaded', function() {
 loadDayPilot();
});

function silIsPlanlamasi() {
 var id = document.getElementById('is_planlamasi_id').value;
 if(id && confirm('Bu iş planını silmek istediğinize emin misiniz?')) {
  window.location.href = '<?=base_url("ugajans_ekip/is_planlamasi_sil/")?>' + id;
 }
}
</script>

<style>
#is_planlamasi_scheduler {
 border: 1px solid #e5e7eb;
 border-radius: 0.5rem;
}
</style>
