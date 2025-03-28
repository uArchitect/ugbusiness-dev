<style>
  .col-span-3 {
    grid-column: span 3 / span 3;
}
  </style>

<div class="grid grid-cols-1 xl:grid-cols-3 gap-5 lg:gap-7.5">

<div class="col-span-3" id="mcol2">
<?php if($this->session->flashdata('err')){ ?>

  <div class="card rounded-xl mb-2">
        <div class="flex items-center flex-wrap  sm:flex-wrap justify-between grow gap-2 p-5 rtl:[background-position:-30%_41%] [background-position:121%_41%] bg-no-repeat bg-[length:660px_310px] upgrade-bg" style="border:1px solid red;border-radius:10px">
         <div class="flex items-center gap-4">
          <div class="relative size-[50px] shrink-0">
           <svg class="w-full h-full stroke-danger-clarity fill-danger-light" fill="none" height="48" viewBox="0 0 44 48" width="44" xmlns="http://www.w3.org/2000/svg">
            <path d="M16 2.4641C19.7128 0.320509 24.2872 0.320508 28 2.4641L37.6506 8.0359C41.3634 10.1795 43.6506 14.141 43.6506 
			18.4282V29.5718C43.6506 33.859 41.3634 37.8205 37.6506 39.9641L28 45.5359C24.2872 47.6795 19.7128 47.6795 16 45.5359L6.34937 
			39.9641C2.63655 37.8205 0.349365 33.859 0.349365 29.5718V18.4282C0.349365 14.141 2.63655 10.1795 6.34937 8.0359L16 2.4641Z" fill="">
            </path>
            <path d="M16.25 2.89711C19.8081 0.842838 24.1919 0.842837 27.75 2.89711L37.4006 8.46891C40.9587 10.5232 43.1506 14.3196 43.1506 
			18.4282V29.5718C43.1506 33.6804 40.9587 37.4768 37.4006 39.5311L27.75 45.1029C24.1919 47.1572 19.8081 47.1572 16.25 45.1029L6.59937 
			39.5311C3.04125 37.4768 0.849365 33.6803 0.849365 29.5718V18.4282C0.849365 14.3196 3.04125 10.5232 6.59937 8.46891L16.25 2.89711Z" stroke="">
            </path>
           </svg>
           <div class="absolute leading-none start-2/4 top-2/4 -translate-y-2/4 -translate-x-2/4 rtl:translate-x-2/4">
            <i class="ki-filled ki-information-4 text-xl text-danger">
            </i>
           </div>
          </div>
          <div class="flex flex-col gap-1.5">
           <div class="flex items-center flex-wrap gap-2.5">
            <a class="text-base font-medium text-gray-900 hover:text-primary-active" href="#">
             Silme İşlemi Başarısız
            </a>
            <span class="badge badge-sm badge-outline bg-danger text-light">
             Önemli Sistem Uyarısı
            </span>
           </div>
           <div class="text-2sm text-gray-800">
           <?=$this->session->flashdata('err')?>
           </div>
          </div>
         </div>
        
        </div>
       </div>

<?php } ?>
        <div class="card">
        <div class="card-header py-5 flex-wrap gap-2">
            <h3 class="card-title">
             İşletme Bilgileri
            </h3>
            <div class="flex gap-6">
            
            <button onclick='document.getElementById("mcol1").style.display = "block";document.getElementById("mcol2").classList.add("col-span-2");document.getElementById("mcol2").classList.remove("col-span-3");' class="btn btn-sm btn-primary">
          <i class="ki-filled ki-users">
          </i>
          Yeni İşletme Ekle
         </button>
            </div>
           </div>
           <div id="notifications_cards">
             <?php
             $isletme_data = get_isletmeler(["isletme_musteri_no"=>$musteri_data->musteri_id]);
             foreach($isletme_data as $isletme) :
             ?>
            <div id="isletme_top_<?=$isletme->isletme_id?>" class="card-group flex items-center justify-between py-4 gap-2.5">
             <div class="flex items-center gap-3.5">
              <div class="relative size-[50px] shrink-0">
               <svg class="w-full h-full stroke-gray-300 fill-gray-100" fill="none" height="48" viewBox="0 0 44 48" width="44" xmlns="http://www.w3.org/2000/svg">
                <path d="M16 2.4641C19.7128 0.320509 24.2872 0.320508 28 2.4641L37.6506 8.0359C41.3634 10.1795 43.6506 14.141 43.6506 
       18.4282V29.5718C43.6506 33.859 41.3634 37.8205 37.6506 39.9641L28 45.5359C24.2872 47.6795 19.7128 47.6795 16 45.5359L6.34937 
       39.9641C2.63655 37.8205 0.349365 33.859 0.349365 29.5718V18.4282C0.349365 14.141 2.63655 10.1795 6.34937 8.0359L16 2.4641Z" fill="">
                </path>
                <path d="M16.25 2.89711C19.8081 0.842838 24.1919 0.842837 27.75 2.89711L37.4006 8.46891C40.9587 10.5232 43.1506 14.3196 43.1506 
       18.4282V29.5718C43.1506 33.6804 40.9587 37.4768 37.4006 39.5311L27.75 45.1029C24.1919 47.1572 19.8081 47.1572 16.25 45.1029L6.59937 
       39.5311C3.04125 37.4768 0.849365 33.6803 0.849365 29.5718V18.4282C0.849365 14.3196 3.04125 10.5232 6.59937 8.46891L16.25 2.89711Z" stroke="">
                </path>
               </svg>
               <div class="absolute leading-none start-2/4 top-2/4 -translate-y-2/4 -translate-x-2/4 rtl:translate-x-2/4">
               <i class="ki-filled ki-shop text-lg text-gray-500">
             </i>
               </div>
              </div>
              <div class="flex flex-col gap-0.5">
               <span class="flex items-center gap-1.5 leading-none font-medium text-sm text-gray-900">
                <?=$isletme->isletme_adi?>
               </span>
               <span class="text-2sm text-gray-700">
               <i class="ki-filled ki-phone ">
           </i> <?=$isletme->isletme_iletisim_numarasi?>   <i class="ki-filled ki-note-2  ">
               </i> <?=$isletme->isletme_adresi?>
               </span>
              </div>
             </div>
             <div class="flex items-center gap-2 lg:gap-5">
              
              <div class="flex items-center gap-2 lg:gap-5">
              <div class="flex items-center gap-2.5">
              <a class="btn btn-sm btn-light btn-outline text-center  " onclick="document.getElementById('isletme_top_<?=$isletme->isletme_id?>').style.display='none';document.getElementById('isletme_bottom_<?=$isletme->isletme_id?>').style.display='block';">
              <i class="ki-filled ki-notepad-edit" style="color:orange">
               </i> Düzenle
               </a>
               <a class="btn btn-sm btn-light btn-outline text-center " href="#">
               <i class="ki-filled ki-call" style="color:purple">
               </i> Ara
               </a>
              
               <a class="btn btn-sm btn-light btn-outline text-center" href="<?=base_url("ugajans_musteri/musteri_isletme_sil/$musteri_data->musteri_id/$isletme->isletme_id")?>">
               <i class="ki-filled ki-trash" style="color:red">
               </i> Sil
               </a>
              </div>
             </div>
             </div>
            </div>




            <div  style="display:none" id="isletme_bottom_<?=$isletme->isletme_id?>" class="card-group flex items-center justify-between py-4 gap-2.5">
             
             <form action="<?=base_url("ugajans_musteri/musteri_isletme_guncelle/$musteri_data->musteri_id/$isletme->isletme_id")?>" method="POST">
             <div class="flex items-center gap-3.5">
               
             <input class="input" name="isletme_adi" value="<?=$isletme->isletme_adi?>"   type="text" value="">
             <input class="input" name="isletme_iletisim_numarasi" value="<?=$isletme->isletme_iletisim_numarasi?>"   type="text" value="">
 
          
 
             <input class="input" name="isletme_adresi" value="<?=$isletme->isletme_adresi?>" placeholder="İşletme Adresini Giriniz" type="text" value="">
             <button class="btn btn-sm btn-success" type="submit">
               <i class="ki-filled ki-notepad-edit">
                </i> Kaydet
                </button>
                <a class="btn btn-sm btn-danger" onclick="document.getElementById('isletme_top_<?=$isletme->isletme_id?>').style.display='flex';document.getElementById('isletme_bottom_<?=$isletme->isletme_id?>').style.display='none';">
               <i class="ki-filled ki-cross">
                </i> İptal
                </a>
              </div>
               </form>
             </div>
            
            <?php
             endforeach;
             ?>
           </div>
          </div>
   
 
 
        </div>
<form action="<?=base_url("ugajans_musteri/musteri_isletme_ekle/$musteri_data->musteri_id")?>" method="POST">
<div class="col-span-1" id="mcol1" style="display:none">
        <div class="grid gap-5 lg:gap-7.5">
        <div class="card pb-2.5 bg-success-light">
        <div class="card-header" id="password_settings">
         <h3 class="card-title ">
          Yeni İşletme Ekle
         </h3>
        </div>
        <div class="card-body grid gap-2">
         <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
          <label class="form-label max-w-56" style="    max-width: 6rem;">
           İşletme Adı :
          </label>
          <div class="grow">
          <input class="input" placeholder="İşletme adını giriniz" name="isletme_adi" type="text" value=""/>
        
           </div>
         </div>
         <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
          <label class="form-label max-w-56" style="    max-width: 6rem;">
           İletişim :
          </label>
          <input class="input" name="isletme_iletisim_numarasi" placeholder="İletişim numarası giriniz" type="text" value=""/>
         </div>
         <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5 mb-2.5">
          <label class="form-label max-w-56" style="    max-width: 6rem;">
           Adres :
          </label>
          <textarea class="input" name="isletme_adresi" placeholder="İşletme adresinizi giriniz" type="text" style="padding:10px;height:150px" rows="5"></textarea>
         </div>
          
         
         <div class="flex justify-end gap-2">
          <button class="btn btn-success">
          Kaydet
          </button>
          <button class="btn btn-danger">
          İptal
          </button>
         </div>
        </div>
       </div>
         
        </div>
       </div>
       </form>
      </div>