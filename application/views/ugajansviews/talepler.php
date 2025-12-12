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
    Tüm ug ajans müşteri talepleri listelenmiştir.
   </div>
  </div>
  <div class="flex items-center gap-2.5">
   <a href="<?=base_url("ugajans_talep/yeni")?>" class="btn btn-primary">
    <i class="ki-filled ki-plus"></i>
    Yeni Talep Oluştur
   </a>
  </div>
 </div>
</div>
<!-- End of Container -->

<!-- Container -->
<div class="container-fixed" style="max-width: 100% !important; width: 100% !important;">
 
 <?php 
 // Kategori sayılarını hesapla
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

 <!-- Kategori Filtreleri -->
 <div class="mb-5">
  <div class="flex flex-col sm:flex-row items-stretch sm:items-center flex-wrap gap-2 border-gray-300 border-t border-b border-dashed py-3">
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
      case 1: echo "(".$yenicount.")"; break;
      case 2: echo "(".$tekrarcount.")"; break;  
      case 3: echo "(".$olumsuzcount.")"; break; 
      case 4: echo "(".$istemiyorcount.")"; break;               
    }
    ?>
   </a>
   <?php } ?>
  </div>
 </div>

 <!-- Tablo Card -->
 <div class="card" style="width: 100%;">
  <!-- Card Header -->
  <div class="card-header flex-wrap gap-2 justify-between">
   <h3 class="card-title font-medium text-sm">Talep Listesi</h3>
   <div class="flex flex-wrap gap-2 lg:gap-5">
    <label class="input input-sm">
     <i class="ki-filled ki-magnifier"></i>
     <input placeholder="Talep Ara..." type="text" id="talep_arama_input" value="">
    </label>
    <select class="select select-sm" id="kaynak_filtre" onchange="filtreleTalepler()">
     <option value="">Tüm Kaynaklar</option>
     <?php 
     $tkaynaklar = get_talep_kaynaklar();
     foreach ($tkaynaklar as $tk) {
     ?>
     <option value="<?=$tk->ugajans_talep_kaynak_id?>" <?=(isset($_GET['kaynak']) && $_GET['kaynak'] == $tk->ugajans_talep_kaynak_id) ? 'selected' : ''?>>
      <?=$tk->ugajans_talep_kaynak_adi?>
     </option>
     <?php } ?>
    </select>
   </div>
  </div>

  <!-- Card Body -->
  <div class="card-body p-0">
   <div data-datatable-page-size="10">
    <div class="overflow-x-auto">
     <table class="table table-auto table-border w-full" id="talepler_tablosu">
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
        <th class="w-[60px]"></th>
        <th class="w-[60px]"></th>
       </tr>
      </thead>
      <tbody>
       <?php
       foreach ($talepler_data as $talep) :
        // Filtreleme kontrolü
        if(isset($_GET["filter"])){
          if($_GET["filter"] != $talep->talep_kategori_no){
            continue;
          } 
        }
        
        if(isset($_GET["kaynak"])){
          if($_GET["kaynak"] != $talep->talep_kaynak_no){
            continue;
          } 
        }
       ?>
       <tr>
        <td>
         <div class="flex items-center gap-2.5">
          <div class="flex flex-col">
           <div class="text-sm font-medium text-gray-900 hover:text-primary-active mb-px">
            <?=$talep->talep_ad_soyad?>
           </div>
           <div class="flex gap-1.5">
            <span class="text-xs text-gray-700">
             <?=$talep->talep_iletisim_numarasi?>
            </span>
           </div>
          </div>
         </div>
        </td>
        <td class="font-normal text-gray-800">
         <div><?=date("d.m.Y H:i",strtotime($talep->talep_kayit_tarihi))?></div>
         <div class="flex items-center gap-1.5 mt-1">
          <img alt="" style="<?=($talep->talep_kaynak_gorsel == "" || $talep->talep_kaynak_gorsel == null) ? "opacity:0" : ""?>" class="rounded-full size-4 shrink-0" src="<?=base_url($talep->talep_kaynak_gorsel)?>"/>
          <span class="text-sm hover:text-primary-active">
           <?=$talep->ugajans_talep_kaynak_adi?>
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
         <a href="<?=base_url("ugajans_talep/duzenle/$talep->talep_id")?>" class="btn btn-sm btn-icon btn-light btn-clear" title="Düzenle">
          <i class="ki-filled ki-notepad-edit"></i>
         </a>
        </td>
        <td>
         <?php $curl = base_url("ugajans_talep/talep_sil/$talep->talep_id")?>
         <a onclick="confirm_action('Bu talep kaydını silmek istediğinize emin misiniz?','<?=$curl?>')" class="btn btn-sm btn-icon btn-light btn-clear" title="Sil">
          <i class="ki-filled ki-trash"></i>
         </a>
        </td>
       </tr>
       <?php endforeach; ?>
      </tbody>
     </table>
    </div>
    
    <!-- Card Footer -->
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
<!-- End of Container -->

<script>
// Kaynak filtresi fonksiyonu
function filtreleTalepler() {
 const kaynakFiltre = document.getElementById('kaynak_filtre').value;
 const url = new URL(window.location.href);
 
 if(kaynakFiltre) {
   url.searchParams.set('kaynak', kaynakFiltre);
 } else {
   url.searchParams.delete('kaynak');
 }
 
 window.location.href = url.toString();
}

// Arama fonksiyonu
document.addEventListener('DOMContentLoaded', function() {
 const searchInput = document.getElementById('talep_arama_input');
 const table = document.querySelector('table');
 
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
