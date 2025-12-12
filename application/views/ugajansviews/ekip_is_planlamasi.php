<!-- Container -->
<div class="container-fixed" id="content_container">
</div>
<!-- End of Container -->

<!-- Container -->
<div class="container-fixed">
 <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
  <div class="flex flex-col justify-center gap-2">
   <h1 class="text-xl font-medium leading-none text-gray-900">
    İş Planlaması - <?=$kullanici_data->ugajans_kullanici_ad_soyad?>
   </h1>
   <div class="flex items-center gap-2 text-sm font-normal text-gray-700">
    <?=$kullanici_data->ugajans_kullanici_ad_soyad?> için haftalık ve aylık iş planlaması yapabilirsiniz.
   </div>
  </div>
  <div class="flex items-center gap-2.5">
   <a href="<?=base_url("ugajans_ekip")?>" class="btn btn-sm btn-light">
    <i class="ki-filled ki-arrow-left"></i>
    Ekip Listesine Dön
   </a>
   <button class="btn btn-sm btn-primary" data-modal-toggle="#is_planlamasi_ekle_modal">
    <i class="ki-filled ki-plus"></i>
    Yeni İş Planı Ekle
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
     İş Planlaması Takvimi
    </h3>
   </div>
   <div class="card-body">
    <div id="is_planlamasi_takvimi"></div>
   </div>
  </div>
 </div>
</div>
<!-- End of Container -->

<!-- İş Planlaması Ekle Modal -->
<div class="modal" data-modal="true" data-modal-disable-scroll="false" id="is_planlamasi_ekle_modal">
 <div class="modal-content max-w-[600px] top-5 lg:top-[10%]">
  <div class="modal-header pr-2.5">
   <h3 class="modal-title">Yeni İş Planı Ekle</h3>
   <button class="btn btn-sm btn-icon btn-light btn-clear shrink-0" data-modal-dismiss="true">
    <i class="ki-filled ki-cross"></i>
   </button>
  </div>
  <form action="<?=base_url("ugajans_ekip/is_planlamasi_ekle")?>" method="post">
   <div class="modal-body grid gap-5 px-0 py-5">
    <input type="hidden" name="kullanici_no" value="<?=$kullanici_data->ugajans_kullanici_id?>">
    
    <div class="flex flex-col gap-2">
     <label class="text-sm font-medium text-gray-700">Planlama Tipi</label>
     <select class="select" name="planlama_tipi" id="planlama_tipi" required>
      <option value="haftalik">Haftalık</option>
      <option value="aylik">Aylık</option>
     </select>
    </div>
    
    <div class="flex flex-col gap-2">
     <label class="text-sm font-medium text-gray-700">Tarih</label>
     <input type="date" class="input" name="planlama_tarihi" id="planlama_tarihi" required>
    </div>
    
    <div class="flex flex-col gap-2">
     <label class="text-sm font-medium text-gray-700">İş Notu</label>
     <textarea class="textarea" name="is_notu" rows="5" placeholder="İş planı detaylarını buraya yazınız..." required></textarea>
    </div>
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-light" data-modal-dismiss="true">İptal</button>
    <button type="submit" class="btn btn-primary">Kaydet</button>
   </div>
  </form>
 </div>
</div>

<!-- FullCalendar CDN -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/locales/tr.js'></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
 var calendarEl = document.getElementById('is_planlamasi_takvimi');
 
 var calendar = new FullCalendar.Calendar(calendarEl, {
  locale: 'tr',
  initialView: 'dayGridMonth',
  headerToolbar: {
   left: 'prev,next today',
   center: 'title',
   right: 'dayGridMonth,timeGridWeek,listWeek'
  },
  events: [
   <?php foreach ($is_planlamasi_data as $plan): ?>
   {
    id: '<?=$plan->is_planlamasi_id?>',
    title: '<?=addslashes($plan->is_notu)?>',
    start: '<?=$plan->planlama_tarihi?>',
    extendedProps: {
     tip: '<?=$plan->planlama_tipi?>',
     durum: <?=$plan->planlama_durumu?>,
     notu: '<?=addslashes($plan->is_notu)?>'
    },
    color: '<?=$plan->planlama_tipi == "haftalik" ? "#0d6efd" : "#198754"?>',
    textColor: '#fff'
   },
   <?php endforeach; ?>
  ],
  eventClick: function(info) {
   // İş planı detayını göster veya düzenle
   var event = info.event;
   var tip = event.extendedProps.tip;
   var durum = event.extendedProps.durum;
   var durumText = durum == 0 ? 'Beklemede' : durum == 1 ? 'Tamamlandı' : 'İptal';
   var tipText = tip == 'haftalik' ? 'Haftalık' : 'Aylık';
   
   alert('İş Planı Detayı:\n\n' +
    'Tarih: ' + event.start.toLocaleDateString('tr-TR') + '\n' +
    'Tip: ' + tipText + '\n' +
    'Durum: ' + durumText + '\n' +
    'Not: ' + event.extendedProps.notu);
  },
  dateClick: function(info) {
   // Tarihe tıklandığında yeni plan ekle
   document.getElementById('planlama_tarihi').value = info.dateStr;
   var modal = document.querySelector('#is_planlamasi_ekle_modal');
   if(modal) {
    modal.style.display = 'flex';
    modal.classList.add('open');
   }
  }
 });
 
 calendar.render();
 
 // Haftalık plan için tarih seçildiğinde haftanın başlangıcını ayarla
 document.getElementById('planlama_tipi').addEventListener('change', function() {
  var tip = this.value;
  var tarihInput = document.getElementById('planlama_tarihi');
  
  if(tarihInput.value && tip == 'haftalik') {
   var tarih = new Date(tarihInput.value);
   var gun = tarih.getDay();
   var fark = tarih.getDate() - gun + (gun == 0 ? -6 : 1); // Pazartesi
   var pazartesi = new Date(tarih.setDate(fark));
   tarihInput.value = pazartesi.toISOString().split('T')[0];
  } else if(tarihInput.value && tip == 'aylik') {
   var tarih = new Date(tarihInput.value);
   var ilkGun = new Date(tarih.getFullYear(), tarih.getMonth(), 1);
   tarihInput.value = ilkGun.toISOString().split('T')[0];
  }
 });
});
</script>

<style>
#is_planlamasi_takvimi {
 max-width: 100%;
 margin: 0 auto;
}
.fc-event {
 cursor: pointer;
}
.fc-event:hover {
 opacity: 0.8;
}
</style>

