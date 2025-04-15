<!-- Container -->
<div class="container-fixed" id="content_container">
     </div>
     <!-- End of Container -->
     <!-- Container -->
      
     <!-- End of Container -->
     <!-- Container -->
     <div class="container-fixed">
      <div class="grid gap-5 lg:gap-7.5">
       <!-- begin: grid -->
       <div class="grid lg:grid-cols-3 gap-y-5 lg:gap-7.5 items-stretch">
        <div class="lg:col-span-1">
         <div class="grid grid-cols-2 gap-5 lg:gap-7.5 h-full items-stretch">
          <style>
           .channel-stats-bg {
		background-image: url('<?=base_url()?>/ugajansassets/assets/media/images/2600x1600/bg-3.png');
	}
	.dark .channel-stats-bg {
		background-image: url('<?=base_url()?>/ugajansassets/assets/media/images/2600x1600/bg-3-dark.png');
	}
          </style>
          <div class="card flex-col justify-between gap-6 h-full bg-cover rtl:bg-[left_top_-1.7rem] bg-[right_top_-1.7rem] bg-no-repeat channel-stats-bg">
           <img alt="" class="w-7 mt-4 ms-5" src="<?=base_url()?>/ugajansassets/assets/media/brand-logos/linkedin-2.svg"/>
           <div class="flex flex-col gap-1 pb-4 px-5">
            <span class="text-3xl font-semibold text-gray-900">
          30+
            </span>
            <span class="text-2sm font-normal text-gray-700">
            @ugajanstr
            </span>
           </div>
          </div>
          <div class="card flex-col justify-between gap-6 h-full bg-cover rtl:bg-[left_top_-1.7rem] bg-[right_top_-1.7rem] bg-no-repeat channel-stats-bg">
           <img alt="" class="w-7 mt-4 ms-5" src="<?=base_url()?>/ugajansassets/assets/media/brand-logos/google-analytics.svg"/>
           <div class="flex flex-col gap-1 pb-4 px-5">
            <span class="text-3xl font-semibold text-gray-900">
            -
            </span>
            <span class="text-2sm font-normal text-gray-700">
             ugajans.com
            </span>
           </div>
          </div>
          <div class="card flex-col justify-between gap-6 h-full bg-cover rtl:bg-[left_top_-1.7rem] bg-[right_top_-1.7rem] bg-no-repeat channel-stats-bg">
           <img alt="" class="w-7 mt-4 ms-5" src="<?=base_url()?>/ugajansassets/assets/media/brand-logos/instagram-03.svg"/>
           <div class="flex flex-col gap-1 pb-4 px-5">
            <span class="text-3xl font-semibold text-gray-900">
             10,7B
            </span>
            <span class="text-2sm font-normal text-gray-700">
             @ugajanstr
            </span>
           </div>
          </div>
          <div class="card flex-col justify-between gap-6 h-full bg-cover rtl:bg-[left_top_-1.7rem] bg-[right_top_-1.7rem] bg-no-repeat channel-stats-bg">
           <img alt="" class="dark:hidden w-7 mt-4 ms-5" src="<?=base_url()?>/ugajansassets/assets/media/brand-logos/tiktok.svg"/>
           <img alt="" class="light:hidden w-7 mt-4 ms-5" src="<?=base_url()?>/ugajansassets/assets/media/brand-logos/tiktok-dark.svg"/>
           <div class="flex flex-col gap-1 pb-4 px-5">
            <span class="text-3xl font-semibold text-gray-900">
             2.5k
            </span>
            <span class="text-2sm font-normal text-gray-700">
            @ugajanstr
            </span>
           </div>
          </div>
         </div>
        </div>
        <div class="lg:col-span-2">
         <style>
          
         </style>
         <div class="card h-full h-full">
          <div class="card-body p-10 bg-[length:80%] rtl:[background-position:-70%_25%] [background-position:175%_25%] bg-no-repeat entry-callout-bg">
           <div class="flex flex-col justify-center gap-4">
            <div class="flex -space-x-2">
              
             <?php 
             $kkdata = get_kullanicilar();
             foreach ($kkdata as $kd) {
               ?>
                <div class="flex">
              <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-light-light size-10" style="object-fit:cover;width: 60px; height: 60px;" src="<?=base_url($kd->ugajans_kullanici_gorsel)?>"/>
             </div>
               <?php
             }
             ?>
          
              
            </div>

           <?php 
           $paramduyuru = get_parameter()->ugajans_duyuru;
           if($paramduyuru == ""){
              ?>
              <h2 class="text-1.5xl font-semibold text-gray-900">
            <a class="link" href="#">
              UG Ajans Duyuru Merkezi
             </a> – Güncellemeler ve<br> Topluluk Bilgilendirmeleri
            
            
            </h2>
            <p class="text-sm font-normal text-gray-700 leading-5.5">
             Kullanıcılar tarafından oluşturulan genel duyuru burada yer alır. Şu anda sisteme kaydedilmiş herhangi bir duyuru bulunmuyor. Duyuru oluşturmak için Duyuru Yayınla seçeneğine tıklayabilirsiniz.
            </p>
              <?php
           }else{
            ?>
            <h2 class="text-1.5xl font-semibold text-gray-900">
          <a class="text-danger" href="#">
            Yeni Duyuru Yayınlandı
           </a> 
          
          
          </h2>
          <p class="text-sm font-normal text-gray-700 leading-5.5">
           <?=  $paramduyuru?>
          </p>
            <?php
           }


           ?>
            




           </div>
          </div>
          <div class="card-footer justify-center">
           <a class="btn btn-link"  data-modal-toggle="#duyuru_modal">
           Duyuru Yayınla
           </a>
          </div>
         </div>
        </div>
       </div>
       <!-- end: grid -->
       <!-- begin: grid -->
       <div class="grid lg:grid-cols-3 gap-5 lg:gap-7.5 items-stretch">
        <div class="lg:col-span-1">
         <div class="card h-full">
          <div class="card-header">
           <h3 class="card-title">
            Yemek Menüsü
           </h3>
         
          </div>
          <div class="card-body flex flex-col gap-4 p-5 lg:p-7.5 lg:pt-4">
           <div class="flex flex-col gap-0.5">
            <span class="text-sm font-normal text-gray-700">
             Yemek Saati
            </span>
            <div class="flex items-center gap-2.5">
             <span class="text-3xl font-semibold text-gray-900">
              11:45 - 12:00
             </span>
             
            </div>
           </div>
            
           <div class="flex items-center flex-wrap gap-4 pb-0">

           <div class="grid grid-cols-1 w-full gap-1.5 border-[0.5px] border-dashed border-gray-400 rounded-md px-2.5 py-2 shrink-0 min-w-24 max-w-auto">
            
             <span class="text-gray-700 text-xs">
              Kuru Fasülye
             </span>
            </div>

            <div class="grid grid-cols-1 w-full gap-1.5 border-[0.5px] border-dashed border-gray-400 rounded-md px-2.5 py-2 shrink-0 min-w-24 max-w-auto">
            
             <span class="text-gray-700 text-xs">
              Pirinç Pilavı
             </span>
            </div>

            <div class="grid grid-cols-1 w-full gap-1.5 border-[0.5px] border-dashed border-gray-400 rounded-md px-2.5 py-2 shrink-0 min-w-24 max-w-auto">
            
             <span class="text-gray-700 text-xs">
              Cacık
             </span>
            </div>

            <div class="grid grid-cols-1 w-full gap-1.5 border-[0.5px] border-dashed border-gray-400 rounded-md px-2.5 py-2 shrink-0 min-w-24 max-w-auto">
           
             <span class="text-gray-700 text-xs">
              Meyve
             </span>
            </div>
             
           </div>
          
        
          </div>
         </div>
        </div>
        <div class="lg:col-span-2">
       <div class="grid grid-cols-2 gap-5">
       <div class="card flex-col">
           <div class="card-header gap-2">
            <h3 class="card-title">
             Yapılacak İşler
            </h3>
           
           </div>
           <div class="card-body">
            <div class="flex flex-col gap-2 lg:gap-5">
               <?php 
               $yi = get_yapilacak_isler(["yapilacak_isler_kullanici_no"=>$this->session->userdata('ugajans_aktif_kullanici_id')]);
               foreach ($yi as $yais) {
                    if($yais->yapilacak_isler_durum == 1){
                         continue;
                    }
                   ?>
                    <div class="flex items-center gap-2">
              <div class="flex items-center grow gap-2.5">
              <i class="ki-filled ki-xmr text-2.5xl leading-none text-brand">
              </i>
               <div class="flex flex-col">
                <a class="text-sm font-medium text-gray-900 hover:text-primary-active mb-px" href="#">
                 <?= $yais->yapilacak_isler_detay?>
                </a>
                <span class="text-xs text-gray-700">
                 İş Tarihi :    <?=date("d.m.Y",strtotime($yais->yapilacak_isler_tarih))?>
                </span>
               </div>
              </div>
              <?php 
              if($yais->yapilacak_isler_durum == 0){
               ?>
              
              <a class="btn btn-sm btn-light" href="<?=base_url("ugajans_anasayfa/yapilacak_is_tamamlandi/$yais->yapilacak_isler_id")?>">
              <i class="ki-filled ki-filled ki-share">
              </i> 
                  Beklemede
                 </a>
                <?php $curl = base_url("ugajans_anasayfa/yapilacak_is_sil/$yais->yapilacak_isler_id");?>
                 <a class="btn btn-sm btn-light" onclick="confirm_action('Bu yapılacak iş kaydını silmek istediğinize emin misiniz?','<?=$curl?>')">
              <i class="ki-filled ki-filled ki-trash">
              </i> 
                   
                 </a>

               <?php
              }else{
               ?>
               

           <a class="btn btn-sm btn-success" href="<?=base_url("ugajans_anasayfa/yapilacak_is_beklemede/$yais->yapilacak_isler_id")?>">
              <i class="ki-filled ki-filled ki-check">
              </i> 
                  Tamamlandı
                 </a>

            <?php
              }
              
              ?>
           
             </div>
                   <?php
               }
               ?>
            
              
              
              
            </div>
           </div>
           <div class="card-footer justify-center">
            <a class="btn btn-link" data-modal-toggle="#is_modal" >
             Yeni Yapılacak İş Tanımla
            </a>
           </div>
          </div>


          <div class="card flex-col">
           <div class="card-header gap-2">
            <h3 class="card-title">
             Tamamlanan İşler
            </h3>
           
           </div>
           <div class="card-body">
            <div class="flex flex-col gap-2 lg:gap-5">
               <?php 
               $yi = get_yapilacak_isler(["yapilacak_isler_kullanici_no"=>$this->session->userdata('ugajans_aktif_kullanici_id')]);
               foreach ($yi as $yais) {
                    if($yais->yapilacak_isler_durum == 0){
                         continue;
                    }
                   ?>
                    <div class="flex items-center gap-2">
              <div class="flex items-center grow gap-2.5">
              <i class="ki-filled ki-xmr text-2.5xl leading-none text-brand">
              </i>
               <div class="flex flex-col">
                <a class="text-sm font-medium text-gray-900 hover:text-primary-active mb-px" href="#">
                 <?= $yais->yapilacak_isler_detay?>
                </a>
                <span class="text-xs text-gray-700">
                 İş Tarihi :    <?=date("d.m.Y",strtotime($yais->yapilacak_isler_tarih))?>
                </span>
               </div>
              </div>
              <?php 
              if($yais->yapilacak_isler_durum == 0){
               ?>
              
              <a class="btn btn-sm btn-light" href="<?=base_url("ugajans_anasayfa/yapilacak_is_tamamlandi/$yais->yapilacak_isler_id")?>">
              <i class="ki-filled ki-filled ki-share">
              </i> 
                  Beklemede
                 </a>


               <?php
              }else{
               ?>
               

           <a class="btn btn-sm btn-success" href="<?=base_url("ugajans_anasayfa/yapilacak_is_beklemede/$yais->yapilacak_isler_id")?>">
              <i class="ki-filled ki-filled ki-check">
              </i> 
                  Tamamlandı
                 </a>

            <?php
              }
              
              ?>
           
             </div>
                   <?php
               }
               ?>
            
              
              
              
            </div>
           </div>
           
          </div>
         </div>
        </div>
       </div>
       <!-- end: grid -->
       <!-- begin: grid -->
     
       <!-- end: grid -->
      </div>
     </div>
     <!-- End of Container -->