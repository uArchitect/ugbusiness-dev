<div class="grid grid-cols-1 xl:grid-cols-3 gap-5 lg:gap-7.5">
       <div class="col-span-1">








       <div class="grid grid-cols-2 gap-5 lg:gap-3  items-stretch">
          <style>
           .channel-stats-bg {
		background-image: url('/ugajansassets/assets/media/images/2600x1600/bg-3.png');
	}
	.dark .channel-stats-bg {
		background-image: url('/ugajansassets/assets/media/images/2600x1600/bg-3-dark.png');
	}
          </style>

<?php 
           
           $sosyal_medya_data = get_sosyal_medyalar(["sosyal_medya_musteri_no"=>$musteri_data->musteri_id]);
           foreach($sosyal_medya_data as $sosyal_medya) :
           
           ?>
  <a href="<?=($sosyal_medya->sosyal_medya_url != "") ? $sosyal_medya->sosyal_medya_url : "#")?>" target="_blank" rel="noopener noreferrer">
          <div class="card flex-col justify-between gap-6 h-full bg-cover rtl:bg-[left_top_-1.7rem] bg-[right_top_-1.7rem] bg-no-repeat channel-stats-bg">
           <img alt="" class="w-7 mt-4 ms-5" src="<?=base_url($sosyal_medya->sosyal_medya_kategori_gorsel)?>">
           <div class="flex flex-col gap-1 pb-4 px-5">
            <span class="text-1xl font-semibold text-gray-900">
             <?=$sosyal_medya->sosyal_medya_kategori_ad?>
            </span>
            <span class="text-2sm font-normal text-gray-700">
            @<?=$sosyal_medya->sosyal_medya_kullanici_adi?>
            </span>
           </div>
          </div>
          </a>
          <?php 
           
           endforeach;
           
           ?>
           
           
           
         </div>

















       
        <div class="grid gap-5 lg:gap-7.5 mt-5">
    
         <div class="card">
          <div class="card-header">
           <h3 class="card-title">
            Müşteri Genel Bilgiler
           </h3>
          </div>
          <div class="card-body pt-4 pb-3">
           <table class="table-auto">
            <tbody>
             <tr>
              <td class="text-sm text-gray-600 pb-3.5 pe-3" style="width: 103px;">
               İletişim :
              </td>
              <td class="text-sm text-gray-900 pb-3.5">
               <?=$musteri_data->musteri_iletisim_numarasi?>
              </td>
             </tr>
             <tr>
              <td class="text-sm text-gray-600 pb-3.5 pe-3" style="width: 103px;">
               Email : 
              </td>
              <td class="text-sm text-gray-900 pb-3.5">
              <?=$musteri_data->musteri_email_adresi?>
              </td>
             </tr>

            

             <tr>
              <td class="text-sm text-gray-600 pb-3.5 pe-3" style="width: 103px;">
               İşletme :
              </td>
              <td class="text-sm text-gray-900 pb-3.5">
              <?=$musteri_data->isletme_adi?>
              </td>
             </tr>
             <tr>
              <td class="text-sm text-gray-600 pb-3.5 pe-3" style="width: 103px;">
               Sabit No :
              </td>
              <td class="text-sm text-gray-900 pb-3.5">
              <?=$musteri_data->isletme_iletisim_numarasi?>
              </td>
             </tr>
             <tr>
              <td class="text-sm text-gray-600 pb-3.5 pe-3" style="width: 103px;">
               Adres :
              </td>
              <td class="text-sm text-gray-900 pb-3.5">
              <?=$musteri_data->isletme_adresi?>
              </td>
             </tr>
             <tr>
              <td class="text-sm text-gray-600 pb-3.5 pe-3">
                
              </td>
              <td class="text-sm text-gray-900 pb-3.5">
              <a class="btn btn-link" href="<?=base_url("ugajans_musteri/profil/$musteri_data->musteri_id/musteri_profil_isletmeler")?>">
             İşletme Bilgilerini Görüntüle
            </a>
              </td>
             </tr>
             
            </tbody>
           </table>
          </div>
         </div>
     
    






         
        </div>
       </div>
       <div class="col-span-2">
        <div class="flex flex-col gap-5 lg:gap-7.5">
        <div class="card">
           <div class="card-body px-10 py-7.5 lg:pe-12.5">
            <div class="flex flex-wrap md:flex-nowrap items-center gap-6 md:gap-10">
             <div class="flex flex-col gap-3" style="    width: -webkit-fill-available;">
             <?php 
             if($musteri_data->musteri_not != ""){
              ?>
               <h2 class="text-1.5xl font-semibold text-brand-900">
               Dikkat
              
              </h2>
              <p class="text-sm text-gray-700 leading-5.5">
              <?=$musteri_data->musteri_not?>
            </a>
              </p>

              <?php
             }else{
              ?>
               <h2 class="text-1.5xl font-semibold text-gray-900">
               Müşteri Notu Eklenmedi
              
              </h2>
              <p class="text-sm text-gray-700 leading-5.5">
               Müşteri profilini ziyaret eden kullanıcıların müşteri hakkında hızlı bilgi edinebileceği bilgi burada yer alır. <?=$musteri_data->musteri_ad_soyad?> için herhangi bir not eklenmemiştir. 
            </a>
              </p>

              <?php
             }
             ?>


              <form id="note_form" style="display:none" action="<?=base_url("ugajans_musteri/musteri_not_guncelle/$musteri_data->musteri_id")?>" method="POST">
<div class="col-span-1" id="mcol1" style="display: block;">
        <div class="grid gap-5 lg:gap-7.5">
         
        
         <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5 mb-2.5">
          
          <textarea class="input" placeholder="Müşteri hakkında not giriniz" type="text" name="musteri_not" style="padding:10px;height:150px" rows="5"><?=$musteri_data->musteri_not?></textarea>
         </div>
          
         
         <div class="flex justify-end gap-2" style="margin-top:-20px">
          <button type="submit" class="btn btn-success">
          Kaydet
          </button>
          <a class="btn btn-danger" href="<?=base_url("ugajans_musteri/profil/$musteri_data->musteri_id/musteri_profil_dashboard")?>">
          İptal
          </a>
         </div>
       
         
        </div>
       </div>
              </form>



             </div>
             <img alt="image" class="dark:hidden max-h-[160px]" src="<?=base_url()?>/ugajansassets/assets/media/illustrations/1.svg">
             <img alt="image" class="light:hidden max-h-[160px]" src="<?=base_url()?>/ugajansassets/assets/media/illustrations/1-dark.svg">
            </div>
           </div>
           <div class="card-footer justify-center">
            <a class="btn btn-link"   onclick="document.getElementById('note_form').style.display = 'block';">
             Müşteri Notunu Düzenle
            </a>
           </div>
          </div>
          
         <div class="card">
          <div class="card-header">
           <h3 class="card-title">
            Son Görüşme Kayıtları
           </h3>
           
          </div>
          <div class="card-table scrollable-x-auto">

          <?php
          $gorusmeler_data = get_gorusme_kayitlari(["gorusme_musteri_no"=>$musteri_data->musteri_id]);  
          if(count($gorusmeler_data) <= 0){
            ?>

<div class="card">
        <div class="card-body flex flex-col items-center gap-2.5 py-7.5">
         <div class="flex justify-center p-7.5 py-9">
          <img alt="image" class="dark:hidden max-h-[230px]" src="<?=base_url()?>/ugajansassets/assets/media/illustrations/22.svg">
          <img alt="image" class="light:hidden max-h-[230px]" src="<?=base_url()?>/ugajansassets/assets/media/illustrations/22-dark.svg">
         </div>
         <div class="flex flex-col gap-5 lg:gap-7.5">
          <div class="flex flex-col gap-3 text-center">
           <h2 class="text-1.5xl font-semibold text-gray-900">
           Görüşme Kaydı Bulunamadı
           </h2>
           <p class="text-sm text-gray-800">
           <?=$musteri_data->musteri_ad_soyad?> için görüşme kaydı tanımlanmamıştır.
            <br>
            Yeni görüşme kaydı oluşturmak için Yeni Görüşme Ekle butonuna tıklayınız
           </p>
          </div>
          <div class="flex justify-center mb-5">
           <a class="btn btn-primary" data-modal-toggle="#report_gorusme_modal" >
           Yeni Görüşme Ekle
           </a>
          </div>
         </div>
        </div>
       </div>


             
            <?php
          } else{
            ?>
<table class="table text-end">
            <thead>
             <tr>
              <th class="text-start min-w-52 !font-normal !text-gray-700">
               Görüşme Detayları
              </th>
              
              <th class="text-start min-w-32 !font-normal !text-gray-700">
               Kullanıcı
              </th>
              <th class="min-w-32 !font-normal !text-gray-700">
               Görüşme Tarihi
              </th>
              <th class="w-[30px]">
              </th>
             </tr>
            </thead>
            <tbody>

            <?php 
            foreach ($gorusmeler_data as $grdata) {
             ?>
              <tr>
              <td class="text-start">
               <a class="text-sm   text-gray-900 hover:text-primary" href="#">
               <?=$grdata->gorusme_detay?>
               </a>
              </td>
             
              <td>
               <div class="flex  rtl:justify-start shrink-0">
                <div class="flex -space-x-2">
                 <div class="flex">
                    
                  <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-light-light size-6" src="<?=base_url()?>/ugajansassets/assets/media/avatars/blank.png"/>
                  <a class="text-sm font-medium text-gray-900 hover:text-primary" href="#">
                         <?=$grdata->ugajans_kullanici_ad_soyad?>
                    </a>
                </div>
                  
                 
                </div>
               </div>
              </td>
              <td class="text-sm font-medium text-gray-700">
              <?=date("d.m.Y h:i",strtotime($grdata->gorusme_tarihi))?>
              </td>
              <td class="text-start">
               <div class="menu" data-menu="true">
                <div class="menu-item" data-menu-item-offset="0, 10px" data-menu-item-placement="bottom-end" data-menu-item-placement-rtl="bottom-start" data-menu-item-toggle="dropdown" data-menu-item-trigger="click|lg:click">
                 <button class="menu-toggle btn btn-sm btn-icon btn-light btn-clear">
                  <i class="ki-filled ki-dots-vertical">
                  </i>
                 </button>
                 <div class="menu-dropdown menu-default w-full max-w-[175px]" data-menu-dismiss="true">
                  <div class="menu-item">

                  <?php $curl =base_url("ugajans_musteri/gorusme_sil/$musteri_data->musteri_id/$grdata->gorusme_id")?>
              

                   <a class="menu-link" onclick="confirm_action('Bu görüşme kaydını silmek istediğinize emin misiniz?','<?=$curl?>')">
                    <span class="menu-icon">
                     <i class="ki-filled ki-search-list">
                     </i>
                    </span>
                    <span class="menu-title">
                     Görüşmeyi Sil
                    </span>
                   </a>
                  </div>
                   
                   
                  
                   
                   
                   
                 </div>
                </div>
               </div>
              </td>
             </tr>
             <?php
            }
            ?>


            
             
            </tbody>
           </table>
            <?php
          }       
          ?>
           
          </div>
           
          <div class="card-footer justify-center">
            <a class="btn btn-link"    data-modal-toggle="#report_gorusme_modal">
             Yeni Görüşme Ekle
            </a>
           </div>

         </div>



        </div>
       </div>
      </div>