 <!-- Container -->
 <div class="container-fixed" id="content_container">
     </div>
     <!-- End of Container -->
     <!-- Container -->
     <div class="container-fixed">
      <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
       <div class="flex flex-col justify-center gap-2">
        <h1 class="text-xl font-medium leading-none text-gray-900">
         Müşteriler
        </h1>
        <div class="flex items-center gap-2 text-sm font-normal text-gray-700">
         Tüm ug ajans müşterileri listelenmiştir. Yeni kayıt oluşturmak için Müşteri Ekle butonuna tıklayınız.
        </div>
       </div>
       <div class="flex items-center gap-2.5">
        
        <a class="btn btn-sm btn-primary" data-modal-toggle="#share_profile_modal">
         Müşteri Ekle
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
          Toplam <?=count($musteriler_data)?> adet müşteri listelenmiştir.
         </h3>
         <div class="flex flex-wrap gap-2 lg:gap-5">
          <div class="flex">
           <label class="input input-sm">
            <i class="ki-filled ki-magnifier">
            </i>
            <input placeholder="Müşteri Ara..." type="text" value="">
            </input>
           </label>
          </div>
           
         </div>
        </div>
        <div class="card-body">
         <div   data-datatable-page-size="10">
          <div class="scrollable-x-auto">
           <table class="table table-auto table-border"  >
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
                 İletişim Numarası
                </span>
                <span class="sort-icon">
                </span>
               </span>
              </th>
               
              
              <th class="min-w-[225px]">
               <span class="sort">
                <span class="sort-label font-normal text-gray-700">
                 Hizmetler
                </span>
                <span class="sort-icon">
                </span>
               </span>
              </th>
              
              <th style="width:190px">
              </th>  <th class="w-[60px]">
              </th>
             </tr>
            </thead>
            <tbody>
               <?php
               foreach ($musteriler_data as $musteri)  :
               ?>
             <tr>
             
              <td>
               <div class="flex items-center gap-2.5">
                <img alt="" class="rounded-full size-7 shrink-0" src="<?=base_url()?>/ugajansassets/assets/media/avatars/300-<?=$musteri->musteri_gorsel?>.png"/>
               
                <div class="flex flex-col">
                 <a class="text-sm font-medium text-gray-900 hover:text-primary-active mb-px" href="<?=base_url("ugajans_musteri/profil/$musteri->musteri_id")?>">
                 <?=$musteri->musteri_ad_soyad?>
                 </a>
                 <span class="text-2sm text-gray-700 font-normal">
                 <?=$musteri->isletme_adi?>
                 </span>
                </div>
               
                
               </div>
              </td>
              <td class="font-normal text-gray-800">
              <?=$musteri->musteri_iletisim_numarasi?>
              </td>
             
              
              <td>
               <div class="flex flex-wrap gap-1.5">

               <?php 
               $hizmetdata = get_musteri_hizmetleri(["musteri_hizmet_musteri_no"=>$musteri->musteri_id]);
               foreach ($hizmetdata as $hdata) {
                   ?>
                    <span class="badge badge-sm">
                         <?=$hdata->ugajans_hizmet_adi?>
                    </span>
                   <?php
               }
               if(count($hizmetdata) <= 0){
                    ?>
                     <div class="flex items-center flex-wrap">
          <a class="text-2sm font-medium text-gray-400  mb-1" href="html/demo1/network/user-cards/mini-cards.html">
          <i class="ki-filled ki-information-2 text-warning">
              </i> Tanımlı Hizmet Bulunamadı
          </a>
         
         
         </div>
                    <?php
               }
               ?>
 
               </div>
              </td>
               
              <td>

              <a href="<?=base_url("ugajans_musteri/profil/$musteri->musteri_id")?>" class="  btn btn-sm   btn-success  ">
                 <i class="ki-filled ki-notepad-edit">
               </i> Profili Görüntüle
                 </a>
 
              </td>

              <td>


              <?php $curl =base_url("ugajans_musteri/musteri_sil/$musteri->musteri_id")?>
              

<a onclick="confirm_action('Bu müşteri kaydını silmek istediğinize emin misiniz?','<?=$curl?>')" class="menu-toggle btn btn-sm btn-icon btn-light btn-clear">
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


     