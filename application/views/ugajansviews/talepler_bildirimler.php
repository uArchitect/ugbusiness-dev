<!-- Container -->
<div class="container-fixed" id="content_container">
</div>
<!-- End of Container -->

<!-- Container -->
<div class="container-fixed">
 <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
  <div class="flex flex-col justify-center gap-2">
   <h1 class="text-xl font-medium leading-none text-gray-900">
    Okunmamış Talepler
   </h1>
   <div class="flex items-center gap-2 text-sm font-normal text-gray-700">
    Henüz okunmamış müşteri talepleri listelenmiştir.
   </div>
  </div>
  <div class="flex items-center gap-2.5">
   <a href="<?=base_url("ugajans_talep")?>" class="btn btn-sm btn-light">
    <i class="ki-filled ki-arrow-left"></i>
    Tüm Taleplere Dön
   </a>
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
     Toplam <?=count($talepler_data)?> adet okunmamış talep listelenmiştir.
    </h3>
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
    <div data-datatable-page-size="10">
     <div class="scrollable-x-auto">
      <table class="table table-auto table-border">
       <thead>
        <tr>
         <th class="min-w-[200px]">
          <span class="sort asc">
           <span class="sort-label font-normal text-gray-700">Müşteri Bilgileri</span>
           <span class="sort-icon"></span>
          </span>
         </th>
         <th class="min-w-[165px]">
          <span class="sort">
           <span class="sort-label font-normal text-gray-700">Talep Bilgileri</span>
           <span class="sort-icon"></span>
          </span>
         </th>
         <th class="min-w-[225px]">
          <span class="sort">
           <span class="sort-label font-normal text-gray-700">Son Durum</span>
           <span class="sort-icon"></span>
          </span>
         </th>
         <th class="min-w-[150px]">
          <span class="sort-label font-normal text-gray-700">İşlemler</span>
         </th>
        </tr>
       </thead>
       <tbody>
        <?php if(count($talepler_data) > 0): ?>
        <?php foreach ($talepler_data as $talep) : ?>
        <tr>
         <td>
          <div class="flex items-center gap-2.5">
           <div class="flex flex-col">
            <div class="text-sm font-medium text-gray-900 hover:text-primary-active mb-px">
             <?=$talep->talep_ad_soyad?>
            </div>
            <span class="text-2sm text-gray-700 font-normal">
             <?=$talep->talep_iletisim_numarasi?>
            </span>
           </div>
          </div>
         </td>
         <td class="font-normal text-gray-800">
          <div><?=date("d.m.Y H:i",strtotime($talep->talep_kayit_tarihi))?></div>
          <div class="flex items-center gap-1.5 mt-1">
           <?php if($talep->talep_kaynak_gorsel != "" && $talep->talep_kaynak_gorsel != null): ?>
           <img alt="" class="rounded-full size-4 shrink-0" src="<?=base_url($talep->talep_kaynak_gorsel)?>"/>
           <?php endif; ?>
           <span class="text-sm hover:text-primary-active">
            <?=$talep->ugajans_talep_kaynak_adi?>
           </span>
          </div>
         </td>
         <td>
          <span class="badge badge-pill badge-outline <?=$talep->talep_kategori_class?> gap-1 items-center">
           <span class="badge badge-dot size-1.5 <?=$talep->talep_kategori_class?>"></span>
           <?=$talep->talep_kategori_adi?>
          </span>
         </td>
         <td>
          <div class="flex items-center gap-2">
           <a href="<?=base_url("ugajans_talep/duzenle/$talep->talep_id")?>" class="btn btn-sm btn-success">
            <i class="ki-filled ki-notepad-edit"></i> Düzenle
           </a>
           <a href="<?=base_url("ugajans_talep/talep_okundu_isaretle/$talep->talep_id")?>" class="btn btn-sm btn-primary" title="Okundu İşaretle">
            <i class="ki-filled ki-check"></i> Okundu
           </a>
           <?php $curl = base_url("ugajans_talep/talep_sil/$talep->talep_id")?>
           <a onclick="confirm_action('Bu talep kaydını silmek istediğinize emin misiniz?','<?=$curl?>')" class="btn btn-sm btn-icon btn-danger">
            <i class="ki-filled ki-trash"></i>
           </a>
          </div>
         </td>
        </tr>
        <?php endforeach; ?>
        <?php else: ?>
        <tr>
         <td colspan="4" class="text-center py-10">
          <div class="flex flex-col items-center gap-2">
           <i class="ki-filled ki-information-2 text-4xl text-gray-400"></i>
           <span class="text-gray-600">Okunmamış talep bulunmamaktadır.</span>
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
 const searchInput = document.getElementById('talep_arama_input');
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

