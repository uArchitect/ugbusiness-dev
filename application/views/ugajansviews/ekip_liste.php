<!-- Container -->
<div class="container-fixed" id="content_container">
</div>
<!-- End of Container -->

<!-- Container -->
<div class="container-fixed">
 <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
  <div class="flex flex-col justify-center gap-2">
   <h1 class="text-xl font-medium leading-none text-gray-900">
    Çalışma Takvimi
   </h1>
   <div class="flex items-center gap-2 text-sm font-normal text-gray-700">
    Tüm ug ajans ekip üyeleri listelenmiştir.
   </div>
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
     Toplam <?=count($kullanicilar_data)?> adet ekip üyesi listelenmiştir.
    </h3>
    <div class="flex flex-wrap gap-2 lg:gap-5">
     <div class="flex">
      <label class="input input-sm">
       <i class="ki-filled ki-magnifier"></i>
       <input placeholder="Ekip Üyesi Ara..." type="text" id="kullanici_arama_input" value="">
      </label>
     </div>
    </div>
   </div>
   <div class="card-body">
    <div data-datatable-page-size="10">
     <div class="scrollable-x-auto">
      <table class="table table-auto table-border">
       <thead>
        <tr>
         <th class="min-w-[200px]">
          <span class="sort asc">
           <span class="sort-label font-normal text-gray-700">Ekip Üyesi</span>
           <span class="sort-icon"></span>
          </span>
         </th>
         <th class="min-w-[165px]">
          <span class="sort">
           <span class="sort-label font-normal text-gray-700">Kullanıcı Adı</span>
           <span class="sort-icon"></span>
          </span>
         </th>
         <th class="min-w-[225px]">
          <span class="sort">
           <span class="sort-label font-normal text-gray-700">İşlemler</span>
           <span class="sort-icon"></span>
          </span>
         </th>
        </tr>
       </thead>
       <tbody>
        <?php if(count($kullanicilar_data) > 0): ?>
        <?php foreach ($kullanicilar_data as $kullanici) : ?>
        <tr>
         <td>
          <div class="flex items-center gap-2.5">
           <?php if($kullanici->ugajans_kullanici_gorsel != "" && $kullanici->ugajans_kullanici_gorsel != null): ?>
           <img alt="" class="rounded-full size-7 shrink-0" src="<?=base_url($kullanici->ugajans_kullanici_gorsel)?>"/>
           <?php else: ?>
           <div class="rounded-full size-7 shrink-0 bg-gray-200 flex items-center justify-center">
            <i class="ki-filled ki-user text-gray-400"></i>
           </div>
           <?php endif; ?>
           <div class="flex flex-col">
            <div class="text-sm font-medium text-gray-900 hover:text-primary-active mb-px">
             <?=$kullanici->ugajans_kullanici_ad_soyad?>
            </div>
            <?php if(isset($kullanici->ugajans_kullanici_email) && $kullanici->ugajans_kullanici_email != ""): ?>
            <span class="text-2sm text-gray-700 font-normal">
             <?=$kullanici->ugajans_kullanici_email?>
            </span>
            <?php endif; ?>
           </div>
          </div>
         </td>
         <td class="font-normal text-gray-800">
          @<?=$kullanici->ugajans_kullanici_adi?>
         </td>
         <td>
          <a href="<?=base_url("ugajans_ekip/is_planlamasi")?>" class="btn btn-sm btn-primary">
           <i class="ki-filled ki-calendar"></i> İş Planlaması
          </a>
         </td>
        </tr>
        <?php endforeach; ?>
        <?php else: ?>
        <tr>
         <td colspan="3" class="text-center py-10">
          <div class="flex flex-col items-center gap-2">
           <i class="ki-filled ki-information-2 text-4xl text-gray-400"></i>
           <span class="text-gray-600">Ekip üyesi bulunmamaktadır.</span>
          </div>
         </td>
        </tr>
        <?php endif; ?>
       </tbody>
      </table>
     </div>
     <div class="card-footer justify-center md:justify-between flex-col md:flex-row gap-5 text-gray-600 text-2sm font-medium">
      <div class="flex items-center gap-2 order-2 md:order-1">
       Show
       <select class="select select-sm w-16" data-datatable-size="true" name="perpage"></select>
       per page
      </div>
      <div class="flex items-center gap-4 order-1 md:order-2">
       <span data-datatable-info="true"></span>
       <div class="pagination" data-datatable-pagination="true"></div>
      </div>
     </div>
    </div>
   </div>
  </div>
 </div>
</div>
<!-- End of Container -->

<script>
// Arama fonksiyonu
document.addEventListener('DOMContentLoaded', function() {
 const searchInput = document.getElementById('kullanici_arama_input');
 const table = document.querySelector('table');
 
 if(searchInput && table) {
   const rows = table.querySelectorAll('tbody tr');
   
   if(rows.length > 0) {
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
 }
});
</script>

