<style>
  .col-span-3 {
    grid-column: span 3 / span 3;
}
  </style>

<div class="grid grid-cols-1 xl:grid-cols-3 gap-5 lg:gap-7.5">

<div class="col-span-2" id="mcol2">
        



<?php
             $dokumanlar_data = get_musteri_dokumanlari(["dokuman_musteri_no"=>$musteri_data->musteri_id]);


             if(count($dokumanlar_data) <= 0){
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
           Döküman Kaydı Bulunamadı
           </h2>
           <p class="text-sm text-gray-800">
           <?=$musteri_data->musteri_ad_soyad?> için döküman yüklemesi yapılmamıştır.
            <br>
            Yeni Sosyal Medya kaydı oluşturmak için Yeni Döküman Ekle butonuna tıklayınız
           </p>
          </div>
         
         </div>
        </div>
       </div>

              <?php
             }else{


            
             ?>




<div class="card">
          <div class="card-header">
           <h3 class="card-title">
           Müşteri Dökümanları
           </h3>
           <div class="menu" data-menu="true">
            <div class="menu-item menu-item-dropdown" data-menu-item-offset="0, 10px" data-menu-item-placement="bottom-end" data-menu-item-placement-rtl="bottom-start" data-menu-item-toggle="dropdown" data-menu-item-trigger="click|lg:click">
           
            </div>
           </div>
          </div>
          <div class="card-body">
           <div class="grid gap-2.5 lg:gap-5">

           <?php 
            foreach($dokumanlar_data as $dokuman) :
           ?>
            <div class="flex items-center gap-3">
             <div class="flex items-center grow gap-2.5">
              <img src="<?=base_url()?>assets/media/file-types/pdf.svg">
              <div class="flex flex-col">
               <span class="text-sm font-medium text-gray-900 cursor-pointer hover:text-primary mb-px">
                <?=$dokuman->dokuman_adi?>
               </span>
               <span class="text-xs text-gray-700">
               <?=$dokuman->dokuman_boyut?> - <?=date("d M Y H:i",strtotime($dokuman->dokuman_yuklenme_tarihi))?>
               </span>
              </div>
             </div>
            
               <a class="btn btn-sm btn-light btn-outline text-center  "  href="<?=base_url($dokuman->dokuman_path)?>" download="proposed_file_name">
              <i class="ki-filled ki-down" style="color:green">
               </i> Dosyayı İndir
               </a>


               <?php $curl =base_url("ugajans_musteri/musteri_dokuman_sil/$musteri_data->musteri_id/$dokuman->dokuman_id")?>
              

               <a class="btn btn-sm btn-light btn-outline text-center  " onclick="confirm_action('Bu döküman kaydını silmek istediğinize emin misiniz?','<?=$curl?>')">
              <i class="ki-filled ki-trash " style="color:Red">
               </i> Dosyayı Sil
               </a>
            </div>

            <?php 
            endforeach;
           ?>
             
            
           </div>
          </div>
          
         </div>
         <?php
             } 
             ?>
 
 
        </div>
<form action="<?php echo base_url('ugajans_musteri/musteri_dokuman_yukle/'.$musteri_data->musteri_id); ?>" enctype="multipart/form-data"  method="POST">
<div class="col-span-1" id="mcol1"  >
        <div class="grid gap-5 lg:gap-7.5">
        <div class="card pb-2.5  bg-success-light">
        <div class="card-header" id="password_settings">
         <h3 class="card-title">
          Yeni Döküman Ekle
         </h3>
        </div>
        <div class="card-body grid gap-2">
         <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
          <label class="form-label max-w-56" style="    max-width: 6rem;">
           Dosya :
          </label>
          <div class="grow">
          <input class="input p-2" required type="file" name="dokuman_dosya" />
           </div>
         </div>
         <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
          <label class="form-label max-w-56" style="    max-width: 6rem;">
           Dosya Adı :
          </label>
          <input class="input" required name="dokuman_adi" placeholder="Dosya adını giriniz" type="text" value=""/>
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