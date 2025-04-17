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
            Ürün / Hizmet Bilgileri
            </h3>
            <div class="flex gap-6">
            
            <button onclick='document.getElementById("mcol1").style.display = "block";document.getElementById("mcol2").classList.add("col-span-2");document.getElementById("mcol2").classList.remove("col-span-3");' class="btn btn-sm btn-primary">
          <i class="ki-filled ki-users">
          </i>
          Yeni Ürün / Hizmet Ekle
         </button>
            </div>
           </div>
           <div id="notifications_cards">
             <?php
             $hizmetdata = get_musteri_hizmetleri(["musteri_hizmet_musteri_no"=>$musteri_data->musteri_id]);


             if(count($hizmetdata) <= 0){
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
           Hizmet Kaydı Bulunamadı
           </h2>
           <p class="text-sm text-gray-800">
           <?=$musteri_data->musteri_ad_soyad?> için hizmet kaydı tanımlanmamıştır.
            <br>
            Yeni hizmet kaydı oluşturmak için Yeni Ürün / Hizmet Ekle butonuna tıklayınız
           </p>
          </div>
         
         </div>
        </div>
       </div>

              <?php
             }else{

             

             foreach ($hizmetdata as $hdata) :
              ?>
            <div id="hizmet_top_<?=$hdata->musteri_hizmet_id?>" class="card-group flex items-center justify-between py-4 gap-2.5">
             <div class="flex items-center gap-3.5">
               





              <div class="relative size-[50px] shrink-0">
              <svg class="w-full h-full stroke-brand-clarity fill-brand-light" fill="none" height="48" viewBox="0 0 44 48" width="44" xmlns="http://www.w3.org/2000/svg">
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
              <i class="ki-filled ki-dropbox text-2xl text-brand">
              </i>
              </div>
             </div>

              <div class="flex flex-col gap-0.5">
               <span class="flex items-center gap-1.5 leading-none font-medium text-sm text-gray-900 mb-2">
               <?=$hdata->ugajans_hizmet_adi?>
               </span>
               <span class="text-2sm text-gray-700">
               <i class="ki-filled ki-tablet-ok   text-primary">
               </i>  <?=date("d.m.Y",strtotime($hdata->musteri_hizmet_kayit_tarihi))?>

&nbsp;
               <i class="ki-filled ki-message-text     text-primary">
               </i>
              <?=$hdata->musteri_hizmet_aciklama == "" ? "<span style='opacity:0.5'>Hizmet ile ilgili detay girilmemiştir.</span>" : $hdata->musteri_hizmet_aciklama?>
               </span>
              </div>
             </div>
             <div class="flex items-center gap-2 lg:gap-5">
              
              <div class="flex items-center gap-2 lg:gap-5">
              <div class="flex items-center gap-2.5">
              <a class="btn btn-sm btn-light btn-outline text-center  " onclick="document.getElementById('hizmet_top_<?=$hdata->musteri_hizmet_id?>').style.display='none';document.getElementById('hizmet_bottom_<?=$hdata->musteri_hizmet_id?>').style.display='block';">
              <i class="ki-filled ki-notepad-edit" style="color:orange">
               </i> Bilgileri Düzenle
               </a>



               <?php $curl =base_url("ugajans_musteri/musteri_hizmet_sil/$musteri_data->musteri_id/$hdata->musteri_hizmet_id")?>
              
               <a class="btn btn-sm btn-light btn-outline text-center  "  onclick="confirm_action('Bu hizmet kaydını silmek istediğinize emin misiniz?','<?=$curl?>')">
              <i class="ki-filled ki-trash " style="color:Red">
               </i> Hizmeti Sil
               </a>
              
              </div>
             </div>
             </div>
            </div>


            <div style="display:none" id="hizmet_bottom_<?=$hdata->musteri_hizmet_id?>" class="card-group flex items-center justify-between py-4 gap-2.5">
             
             <form action="<?=base_url("ugajans_musteri/musteri_hizmet_guncelle/$musteri_data->musteri_id/$hdata->musteri_hizmet_id")?>" method="POST">
             <div class="flex items-center gap-3.5">
               
              <select class="select" name="musteri_hizmet_no">

              <?php 
                $hizmet_data = get_hizmetler();
                foreach ($hizmet_data as $hhdata) :
                ?>
             <option <?=$hdata->musteri_hizmet_no == $hhdata->ugajans_hizmet_id ? "selected" : "" ?> value="<?=$hhdata->ugajans_hizmet_id?>">
              <?=$hhdata->ugajans_hizmet_adi?>
             </option>
             <?php 
                endforeach;
                ?>
                
                  
            
             </select>
 
             <input class="input" name="musteri_hizmet_kayit_tarihi" value="<?=date("Y-m-d",strtotime($hdata->musteri_hizmet_kayit_tarihi))?>"   type="date" value="">
 
             <input class="input" name="musteri_hizmet_aciklama" value="<?=$hdata->musteri_hizmet_aciklama?>" placeholder="Hizmet Detayını Giriniz" type="text" value="">
             <button class="btn btn-sm btn-success" type="submit">
               <i class="ki-filled ki-notepad-edit">
                </i> Kaydet
                </button>
                <a class="btn btn-sm btn-danger" onclick="document.getElementById('hizmet_top_<?=$hdata->musteri_hizmet_id?>').style.display='flex';document.getElementById('hizmet_bottom_<?=$hdata->musteri_hizmet_id?>').style.display='none';">
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
        <form action="<?=base_url("ugajans_musteri/musteri_hizmet_ekle/$musteri_data->musteri_id")?>" method="POST">
  <div class="col-span-1" id="mcol1" style="display:none">
    <div class="grid gap-5 lg:gap-7.5">
      <div class="card pb-2.5 bg-success-light">
        <div class="card-header">
          <h3 class="card-title">Yeni Hizmet Ekle</h3>
        </div>
        <div class="card-body grid gap-2">
          
          <!-- Checkbox listesi -->
          <div>
            <label class="form-label">Hizmetler:</label>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
              <?php 
              $hizmet_data = get_hizmetler();
              foreach ($hizmet_data as $hdata): ?>
                <label class="flex items-center gap-2">
                  <input type="checkbox" name="musteri_hizmet_no[]" value="<?=$hdata->ugajans_hizmet_id?>" class="form-checkbox">
                  <span><?=$hdata->ugajans_hizmet_adi?></span>
                </label>
              <?php endforeach; ?>
            </div>
          </div>

          <!-- Ortak Tarih -->
          <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
            <label class="form-label max-w-56" style="max-width: 6rem;">Başl. Tarihi :</label>
            <input class="input" type="date" name="musteri_hizmet_kayit_tarihi" value="<?=date("Y-m-d")?>">
          </div>

          <!-- Ortak Açıklama -->
          <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
            <label class="form-label max-w-56" style="max-width: 6rem;">Hizmet Detay :</label>
            <textarea class="input" name="musteri_hizmet_aciklama" style="padding:10px;height:150px" rows="5"></textarea>
          </div>

          <!-- Butonlar -->
          <div class="flex justify-end gap-2">
            <button class="btn btn-success">Kaydet</button>
            <a onclick="location.reload();" class="btn btn-danger">İptal</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

      </div>