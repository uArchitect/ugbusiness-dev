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



<div class="  min-w-full">
 
           <div class="flex flex-col sm:flex-row items-stretch sm:items-center flex-wrap gap-2 border-gray-300 border-t  border-b border-dashed  mb-4  " data-tabs="true">
           <a class="group btn px-3 text-gray-700 hover:text-primary tab-active:bg-primary-light tab-active:border-primary-clarity tab-active:text-primary  " href="<?=base_url('ugajans_talep')?>">
             <i class="ki-filled ki-message-text text-gray-500 group-hover:text-primary tab-active:text-primary">
             </i>
          TÜMÜ (<?=$tumcount?>)
            </a>
           <?php 
                $tkat = get_talep_kategoriler();
                foreach ($tkat as $tk) {
                    ?>
                  
                    <a href="<?=base_url('ugajans_talep?filter='.$tk->talep_kategori_id)?>" class="group btn px-3 text-gray-700 hover:text-primary tab-active:bg-primary-light tab-active:border-primary-clarity tab-active:text-primary  "  >
             <i class="ki-filled ki-message-text text-gray-500 group-hover:text-primary tab-active:text-primary">
             </i>
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
                    # code...
                    break;
             }
             ?>
            </a>
                    <?php
                }
                ?>
             
           
         
            
           </div>

  

</div>





      
<div class="card card-grid min-w-full">
        <div class="card-header flex-wrap gap-2">
         <h3 class="card-title font-medium text-sm">
          
         </h3>
         <div class="flex flex-wrap gap-2 lg:gap-5">
          <div class="flex">
           <label class="input input-sm">
            <i class="ki-filled ki-magnifier">
            </i>
            <input placeholder="Talep Ara..." type="text" id="talep_arama_input" value="">
            </input>
           </label>
          </div>
          <div class="flex">
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
        </div>
        <div class="card-body">
         <div   data-datatable-page-size="10">
          <div class="scrollable-x-auto">
           <table class="table table-auto table-border"   >
            <thead>
             <tr>
              
              <th class="min-w-[200px]">
               <span class="sort asc">
                <span class="sort-label font-normal text-gray-700">
                 Müşteri Bilgileri
                </span>
                <span class="sort-icon">
                </span>
               </span>
              </th>
              <th class="min-w-[165px]">
               <span class="sort">
                <span class="sort-label font-normal text-gray-700">
                 Talep Bilgileri
                </span>
                <span class="sort-icon">
                </span>
               </span>
              </th>
            
              <th class="min-w-[225px]">
               <span class="sort">
                <span class="sort-label font-normal text-gray-700">
                   Son Durum
                </span>
                <span class="sort-icon">
                </span>
               </span>
              </th>
              
              <th class="w-[60px]">
              
              </th>
              <th class="w-[60px]">
              </th>
             </tr>
            </thead>
            <tbody>
               <?php
               foreach ($talepler_data as $talep)  :

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
              <div class="flex items-center gitem gap-2.5">
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
                <?=date("d.m.Y H:i",strtotime($talep->talep_kayit_tarihi))?>
                <br>
                  <div class="flex items-center gap-1.5">
                <img alt="" style="<?=($talep->talep_kaynak_gorsel == "" || $talep->talep_kaynak_gorsel == null || $talep->talep_kaynak_gorsel == "") ? "opacity:0" : ""?>" class="rounded-full size-4 shrink-0" src="<?=base_url($talep->talep_kaynak_gorsel)?>"/>
               
                <div class="flex flex-col">
                 <a class="   hover:text-primary-active mb-px" href="#">
                 <?=$talep->ugajans_talep_kaynak_adi?>
                 </a>
                 
                </div>
               
                
               </div>
              </td>
             
              </td>
             
              <td class="!pr-7.5 min-w-16 text-center">
               <span class="badge badge-pill badge-outline <?=$talep->talep_kategori_class?> gap-1 items-center">
                  <span class="badge badge-dot size-1.5 <?=$talep->talep_kategori_class?>">
                  </span>
                  <?=$talep->talep_kategori_adi?>
                 </span>
               </td>
               
              <td>
              <a href="<?=base_url("ugajans_talep/duzenle/$talep->talep_id")?>" class="menu-toggle btn btn-sm btn-icon btn-light btn-clear" title="Düzenle">
                 <i class="ki-filled ki-notepad-edit">
               </i>
                 </a>
                 
              </td>
              <td>



              <?php $curl =base_url("ugajans_talep/talep_sil/$talep->talep_id")?>
              

              <a onclick="confirm_action('Bu talep kaydını silmek istediğinize emin misiniz?','<?=$curl?>')" class="menu-toggle btn btn-sm btn-icon btn-light btn-clear">
                 <i class="ki-filled ki-trash">
               </i>
                 </a>
                 
              </td>
             </tr>
             <?php
               endforeach;
               ?>
              
            </tbody>
           </table>
          </div>
          <div class="card-footer justify-center md:justify-between flex-col md:flex-row gap-5 text-gray-600 text-2sm font-medium">
           <div class="flex items-center gap-2 order-2 md:order-1">
            Show
            <select class="select select-sm w-16" data-datatable-size="true" name="perpage">
            </select>
            per page
           </div>
           <div class="flex items-center gap-4 order-1 md:order-2">
            <span data-datatable-info="true">
            </span>
            <div class="pagination" data-datatable-pagination="true">
            </div>
           </div>
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
