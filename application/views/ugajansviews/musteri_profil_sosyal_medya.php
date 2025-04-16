<style>
  .col-span-3 {
    grid-column: span 3 / span 3;
}
  </style>

<div class="grid grid-cols-1 xl:grid-cols-3 gap-5 lg:gap-7.5">

<div class="col-span-3" id="mcol2">
        
        <div class="card">
        <div class="card-header py-5 flex-wrap gap-2">
            <h3 class="card-title text-primary">
             Sosyal Medya Hesapları
            </h3>
            <div class="flex gap-6">
            
            <button id="addButton" onclick='document.getElementById("mcol1").style.display = "block";document.getElementById("mcol2").classList.add("col-span-2");document.getElementById("mcol2").classList.remove("col-span-3");this.style.display="none";' class="btn btn-sm btn-primary">
          <i class="ki-filled ki-users">
          </i>
          Yeni Hesap Ekle
         </button>
            </div>
           </div>
           <div id="notifications_cards">
             <?php
             $sosyal_medya_data = get_sosyal_medyalar(["sosyal_medya_musteri_no"=>$musteri_data->musteri_id]);


             if(count($sosyal_medya_data) <= 0){
              ?>

              <div class="card">
        <div class="card-body flex flex-col items-center gap-2.5 py-7.5">
         <div class="flex justify-center p-7.5 py-9">
          <img alt="image" class="dark:hidden max-h-[230px]" src="<?=base_url("ugajansassets")?>/assets/media/illustrations/22.svg">
          <img alt="image" class="light:hidden max-h-[230px]" src="<?=base_url("ugajansassets")?>/assets/media/illustrations/22-dark.svg">
         </div>
         <div class="flex flex-col gap-5 lg:gap-7.5">
          <div class="flex flex-col gap-3 text-center">
           <h2 class="text-1.5xl font-semibold text-gray-900">
           Sosyal Medya Kaydı Bulunamadı
           </h2>
           <p class="text-sm text-gray-800">
           <?=$musteri_data->musteri_ad_soyad?> için Sosyal Medya kaydı tanımlanmamıştır.
            <br>
            Yeni Sosyal Medya kaydı oluşturmak için Yeni Hesap Ekle butonuna tıklayınız
           </p>
          </div>
         
         </div>
        </div>
       </div>

              <?php
             }else{


             foreach($sosyal_medya_data as $sosyal_medya) :
             ?>
            <div id="social_media_top_<?=$sosyal_medya->sosyal_medya_hesap_id?>" class="card-group flex items-center justify-between py-4 gap-2.5">
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
               <img alt="" class="h-11 shrink-0" src="<?=base_url($sosyal_medya->sosyal_medya_kategori_gorsel)?>"/>
               </div>
              </div>
              <div class="flex flex-col gap-0.5">
               <span class="flex items-center gap-1.5 leading-none font-medium text-sm text-gray-900">
               <a href="<?=base_url("ugajans_musteri/profil/$sosyal_medya->sosyal_medya_musteri_no/musteri_profil_post_yonetimi/$sosyal_medya->sosyal_medya_hesap_id")?>">
               <span class="flex items-center gap-1.5 leading-none font-medium text-sm text-gray-900">
                <?=$sosyal_medya->sosyal_medya_kategori_ad?>
               </span></a>
               </span>
               <span class="text-2sm text-gray-700">
               <i class="ki-filled ki-profile-circle ">
           </i> <?=$sosyal_medya->sosyal_medya_kullanici_adi?>  
           
           <i class="ki-filled ki-note-2  ">
               </i> <?php
               
               if(ugajans_aktif_kullanici()->sosyal_medya_sifre_goruntuleme == 0){
                echo "********";
               }else{
                echo  $sosyal_medya->sosyal_medya_kullanici_sifre;
               }
               
              ?>
 
               
               </span>
              </div>
             </div>
             <div class="flex items-center gap-2 lg:gap-5">
              
              <div class="flex items-center gap-2 lg:gap-5">
              <div class="flex items-center gap-2.5">

              <?php 
               if(ugajans_aktif_kullanici()->musteri_sosyal_medya_duzenleme == 1 || $sosyal_medya->atanan_kullanici_no ==  $this->session->userdata('ugajans_aktif_kullanici_id')){
                ?>
                    <a  href="<?=base_url("ugajans_musteri/profil/$musteri_data->musteri_id/musteri_profil_post_yonetimi/$sosyal_medya->sosyal_medya_hesap_id")?>" class="btn btn-sm btn-success btn-outline text-center">
              <i class="ki-filled ki-notepad-edit"  >
               </i> Hesap Yönetim
               </a>

                <?php
              }
              
              ?>


          
              <?php 
               if(ugajans_aktif_kullanici()->musteri_sosyal_medya_duzenleme == 1){
                ?>
                  <a onclick="document.getElementById('social_media_top_<?=$sosyal_medya->sosyal_medya_hesap_id?>').style.display='none';document.getElementById('social_media_bottom_<?=$sosyal_medya->sosyal_medya_hesap_id?>').style.display='block';" class="btn btn-sm btn-light btn-outline text-center">
              <i class="ki-filled ki-notepad-edit" style="color:orange">
               </i> Bilgileri Düzenle
               </a>
                <?php
              }
              
              ?>


            
              <a class="btn btn-sm btn-light btn-outline text-center" target="_blank" href="<?=$sosyal_medya->sosyal_medya_url?>">
               <i class="ki-filled ki-icon" style="color:blue">
               </i> Profili Ziyaret Et
               </a>
               <?php $curl =base_url("ugajans_musteri/sosyal_medya_sil/$musteri_data->musteri_id/$sosyal_medya->sosyal_medya_hesap_id")?>
            
               <a class="btn btn-sm btn-light btn-outline text-center" onclick="confirm_action('Bu sosyal medya kaydını silmek istediğinize emin misiniz?','<?=$curl?>')">
               <i class="ki-filled ki-trash" style="color:red">
               </i> Hesap Sil
               </a>
              </div>
             </div>
             </div>
            </div>




            <div style="display:none" id="social_media_bottom_<?=$sosyal_medya->sosyal_medya_hesap_id?>" class="card-group flex items-center justify-between py-4 gap-2.5">
             
            <form action="<?=base_url("ugajans_musteri/sosyal_medya_guncelle/$musteri_data->musteri_id/$sosyal_medya->sosyal_medya_hesap_id")?>" method="POST">
            <div class="flex items-center gap-3.5">
              
             <select class="select" name="sosyal_medya_kategori_no">
                <?php 
                $kategori_data = get_sosyal_medya_kategoriler();
                foreach ($kategori_data as $kdata) :
                ?>
             <option <?=$kdata->sosyal_medya_kategori_id == $sosyal_medya->sosyal_medya_kategori_id ? "selected" : ""?> value="<?=$kdata->sosyal_medya_kategori_id ?>">
              <?=$kdata->sosyal_medya_kategori_ad?>
             </option>
             <?php 
                endforeach;
                ?>
           
            </select>

            <input class="input" name="sosyal_medya_kullanici_adi" value="<?=$sosyal_medya->sosyal_medya_kullanici_adi?>" placeholder="Kullanıcı adını giriniz" type="text"  >

            <input class="input" name="sosyal_medya_kullanici_sifre" value="<?=$sosyal_medya->sosyal_medya_kullanici_sifre?>" placeholder="Kullanıcı şifresini giriniz" type="text"  >
            
            
             <input class="input" name="sosyal_medya_url" value="<?=$sosyal_medya->sosyal_medya_url?>" placeholder="Profil url giriniz" type="text"  >
            

             <select name="atanan_kullanici_no"  class="input">
             <option <?=$uk->ugajans_kullanici_id == $sosyal_medya->atanan_kullanici_no ? "selected" : ""?> value="0">Kullanıcı Atanmadı</option>

              <?php 
              $ugk = get_kullanicilar();
              foreach ($ugk as $uk) {
               ?>
               <option <?=$uk->ugajans_kullanici_id == $sosyal_medya->atanan_kullanici_no ? "selected" : ""?> value="<?=$uk->ugajans_kullanici_id?>"><?=$uk->ugajans_kullanici_ad_soyad?></option>
               <?php
              }
              ?>
             </select>
             


            
            <button class="btn btn-sm btn-success" type="submit">
              <i class="ki-filled ki-notepad-edit">
               </i> Kaydet
               </button>
               <a class="btn btn-sm btn-danger" onclick="document.getElementById('social_media_top_<?=$sosyal_medya->sosyal_medya_hesap_id?>').style.display='flex';document.getElementById('social_media_bottom_<?=$sosyal_medya->sosyal_medya_hesap_id?>').style.display='none';">
              <i class="ki-filled ki-cross">
               </i> İptal
               </a>
             </div>
              </form>
            </div>
            <?php
             endforeach;}
             ?>
           </div>
          </div>
   
 
 
        </div>
<form action="<?=base_url("ugajans_musteri/sosyal_medya_ekle/$musteri_data->musteri_id")?>" method="POST">
<div class="col-span-1" id="mcol1" style="display:none">
        <div class="grid gap-5 lg:gap-7.5">
        <div class="card pb-2.5  bg-success-light">
        <div class="card-header" id="password_settings">
         <h3 class="card-title">
          Yeni Sosyal Medya Hesabı Ekle
         </h3>
        </div>
        <div class="card-body grid gap-2">
         <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
          <label class="form-label max-w-56" style="    max-width: 6rem;">
           Platform :
          </label>
          <div class="grow">
            <select class="select" name="sosyal_medya_kategori_no">
                <?php 
                $kategori_data = get_sosyal_medya_kategoriler();
                foreach ($kategori_data as $kdata) :
                ?>
             <option value="<?=$kdata->sosyal_medya_kategori_id ?>">
              <?=$kdata->sosyal_medya_kategori_ad?>
             </option>
             <?php 
                endforeach;
                ?>
           
            </select>
           </div>
         </div>
         <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
          <label class="form-label max-w-56" style="    max-width: 6rem;">
           Kullanıcı Adı :
          </label>
          <input class="input" name="sosyal_medya_kullanici_adi" placeholder="Kullanıcı adını giriniz" type="text" value=""/>
         </div>
         <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5 mb-2.5">
          <label class="form-label max-w-56" style="    max-width: 6rem;">
           Şifre :
          </label>
          <input class="input" name="sosyal_medya_kullanici_sifre" placeholder="Kullanıcı şifresini giriniz" type="text" value=""/>
         </div>
          
           <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5 mb-2.5">
          <label class="form-label max-w-56" style="    max-width: 6rem;">
           Profil Url :
          </label>
          <input class="input" name="sosyal_medya_url" placeholder="Profil url giriniz" type="text" value=""/>
         </div>
         <div class="flex justify-end gap-2">
          <button class="btn btn-success">
          Kaydet
          </button>
          <button type="button"  onclick='document.getElementById("mcol1").style.display = "none";document.getElementById("mcol2").classList.add("col-span-3");document.getElementById("mcol2").classList.remove("col-span-2");document.getElementById("addButton").style.display="block";' class="btn btn-danger">
          İptal
          </button>
         </div>
        </div>
       </div>
         
        </div>
       </div>
           </form>
      </div>