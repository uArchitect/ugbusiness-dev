 

<div class="grid grid-cols-1 xl:grid-cols-3 gap-5 lg:gap-7.5">

<div class="col-span-1"  >
        <div class="grid gap-5 lg:gap-7.5">
       
 



        
<?php 
           
           $sosyal_medya_data = get_sosyal_medyalar(["sosyal_medya_hesap_id"=>$medya_no]);
           foreach($sosyal_medya_data as $sosyal_medya) :
           
           ?>
  <a href="<?=$sosyal_medya->sosyal_medya_url?>" target="_blank" rel="noopener noreferrer">
          <div class="card flex-col justify-between gap-6 h-full bg-cover rtl:bg-[left_top_-1.7rem] bg-[right_top_-1.7rem] bg-no-repeat channel-stats-bg" style="background-image: url(<?=base_url("ugajansassets/assets/media/images/2600x1600/bg-3.png")?>); ">
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
           

 


<?php      


$liste = get_onemli_gunler(); 
$onemli_gun_data = get_onemli_gun_tanimlari(["onemli_gun_tanim_sosyal_medya_no"=>$medya_no]);
?>
        <div class="card"   >
          <div class="card-header">
           <h3 class="card-title text-brand">
           Özel Günler
           </h3>
          </div>
          <div class="card-body flex flex-col gap-5">
           <div   class="text-sm text-gray-800">
           Bu listeden müşteri post planlamasına eklemek istediğiniz özel günü seçebilirsiniz.
           </div>
           <div    class="input-group">
           <input type="text" id="searchInput" placeholder="Ara..." class="border p-2 mb-2 w-full">
 
            
           </div>
           <div class="flex flex-col gap-5" style="height: 226px; overflow-y: auto;overflow-x: hidden;padding: 18px;">
            <?php 
      
            
              
            foreach ($liste as $odata) {

             /* $flag = 0;
              foreach ($onemli_gun_data as $od) {
               if($od->onemli_gun_tanim_gun_no == $odata->onemli_gun_id ){
                 $flag = 1;
                 break;
               }
              }
              if($flag == 1){
                 continue;
              }
*/
              ?>
               <div class="flex items-center justify-between gap-2.5  list-item">
             <div class="flex items-center gap-2.5">
            
              <div class="flex flex-col gap-0.5">
               <a class="flex items-center gap-1.5 leading-none font-medium text-sm text-gray-900 hover:text-primary" href="html/demo1/public-profile/teams.html">
                <?=$odata->onemli_gun_adi?>
               </a>
               <span class="text-2sm text-gray-700">
               <?=$odata->onemli_gun_tarih?>
               </span>
              </div>
             </div>
             <div class="flex items-center gap-2.5">
             <a class="btn btn-sm btn-light btn-outline shrink-0" href="<?=base_url("ugajans_musteri/onemli_gun_tanimla/$musteri_data->musteri_id/$medya_no/$odata->onemli_gun_id")?>">
             <i class="ki-filled ki-note-2 text-lg" style="color:green">
             </i>
            </a>

            <?php $curl =base_url("ugajans_musteri/onemli_gun_sil/$musteri_data->musteri_id/$odata->onemli_gun_id/$medya_no")?>
              


            <a class="btn btn-sm btn-light btn-outline shrink-0"  onclick="confirm_action('Bu özel gün kaydını silmek istediğinize emin misiniz?','<?=$curl?>')">
            <i class="ki-filled ki-trash" style="color:red">
            </i>
            </a>
             </div>
            </div>
              <?php
            }
        
            ?>
           
           
           </div>
          </div>

          <div class="card-footer justify-center">

          <?php $curl =base_url("ugajans_musteri/musteri_tum_gunleri_ekle/$musteri_data->musteri_id/$medya_no")?>
              

           <a style="display:none;" class="btn btn-link"    onclick="confirm_action('Tüm özel günleri planlama listesine eklemek istediğinize emin misiniz?','<?=$curl?>')">
            Tümünü Planlama Listesine Ekle
           </a>
          </div>
         </div>
         <div class="card pb-2.5">
        <div class="card-header" id="password_settings">
         <h3 class="card-title text-success">
          Yeni Görev Tanımı Ekle
         </h3>
        </div>
        <form action="<?=base_url("ugajans_musteri/onemli_gun_ekle/$musteri_data->musteri_id/$medya_no")?>" method="post"> 
        <div class="card-body grid gap-2">
         <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
          <label class="form-label max-w-56" style="    max-width: 6rem;">
           Görev Adı :
          </label>
          <div class="grow">
          <input class="input" required name="onemli_gun_adi" placeholder="Görev başlık giriniz" type="text" value=""/>
        
           </div>
         </div>

         <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
          <label class="form-label max-w-56" style="    max-width: 6rem;">
           Kategori :
          </label>
          <div class="grow">
           <select class="select" required name="onemli_gun_kategori">
           <option value="">Kategori Seçiniz</option>
           <option value="1">Post</option>
            <option value="2">Video</option>
            <option value="3">Çekim</option>
            <option value="4">Yapılacak İş / Diğer</option>
            </select>


           </div>
         </div>

         <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
          <label class="form-label max-w-56" style="    max-width: 6rem;">
           Tarih :
          </label>
          <div class="grow">
          <input class="input" required name="onemli_gun_tarih" type="date" value=""/>
        
           </div>
         </div>
         <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5 mb-2.5">
          <label class="form-label max-w-56" style="    max-width: 6rem;">
           Açıklama :
          </label>
          <textarea class="input" required name="alt_metin" placeholder="Görev hakkında bilgi giriniz" type="text" style="padding:10px;height:100px" rows="5"></textarea>
         </div>
          
         
         <div class="flex justify-end gap-2">
          <button type="submit" class="btn btn-success">
          Kaydet
          </button>
          <button class="btn btn-danger">
          İptal
          </button>
         </div>
        </div>
        </form>
       </div>
        </div>
       </div>
      


       
<div class="col-span-2"  >
        
        <div class="card">
        <div class="card-header py-5 flex-wrap gap-2">
            <h3 class="card-title text-primary">
            Sosyal Medya Paylaşım Planlaması
            
            </h3>

            <div class="  min-w-full">
 
           <div class="flex flex-col sm:flex-row items-stretch sm:items-center flex-wrap gap-2 border-gray-300 border-t  border-b border-dashed  mb-4  " data-tabs="true">
           <a class="group btn px-3 text-gray-700 hover:text-primary tab-active:bg-primary-light tab-active:border-primary-clarity tab-active:text-primary  " href="http://localhost/ugbusiness/ugbusiness/ugajans_talep">
             <i class="ki-filled ki-message-text text-gray-500 group-hover:text-primary tab-active:text-primary">
             </i>
          TÜMÜ (80)
            </a>
                             
                    <a href="http://localhost/ugbusiness/ugbusiness/ugajans_talep?filter=1" class="group btn px-3 text-gray-700 hover:text-primary tab-active:bg-primary-light tab-active:border-primary-clarity tab-active:text-primary  ">
             <i class="ki-filled ki-message-text text-gray-500 group-hover:text-primary tab-active:text-primary">
             </i>
             BEKLEYENLER             (34)            </a>
                                      
                    <a href="http://localhost/ugbusiness/ugbusiness/ugajans_talep?filter=2" class="group btn px-3 text-gray-700 hover:text-primary tab-active:bg-primary-light tab-active:border-primary-clarity tab-active:text-primary  ">
             <i class="ki-filled ki-message-text text-gray-500 group-hover:text-primary tab-active:text-primary">
             </i>
             SÜRESİ GEÇENLER             (14)            </a>
                                      
                    <a href="http://localhost/ugbusiness/ugbusiness/ugajans_talep?filter=3" class="group btn px-3 text-gray-700 hover:text-primary tab-active:bg-primary-light tab-active:border-primary-clarity tab-active:text-primary  ">
             <i class="ki-filled ki-message-text text-gray-500 group-hover:text-primary tab-active:text-primary">
             </i>
             TAMAMLANANLAR             (32)            </a>
                                      
                  
         
            
           </div>
 
  

</div>
            <div class="flex gap-6">
            

            
             
           
            </div>
           </div>
           <div id="notifications_cards" style="height: 1140px; overflow-y: auto;">
             
             
             <?php
         
             $aylar = ["Oca", "Şub", "Mar", "Nis", "May", "Haz", "Tem", "Ağu", "Eyl", "Eki", "Kas", "Ara"];

             if(count($onemli_gun_data)<=0){
              ?>


<div class="card" style="box-shadow: 0px 0 0px 0px rgba(0, 0, 0, 0);border:0px;padding-top:100px">
        <div class="card-body flex flex-col items-center gap-2.5 py-7.5">
         <div class="flex justify-center p-7.5 py-9">
          <img alt="image" class="dark:hidden max-h-[230px]" src="<?=base_url()?>/ugajansassets/assets/media/illustrations/22.svg">
          <img alt="image" class="light:hidden max-h-[230px]" src="<?=base_url()?>/ugajansassets/assets/media/illustrations/22-dark.svg">
         </div>

         
         <div class="flex flex-col gap-5 lg:gap-7.5">
          <div class="flex flex-col gap-3 text-center">
           <h2 class="text-1.5xl font-semibold text-gray-900">
           Kayıt Bulunamadı
           </h2>
           <p class="text-sm text-gray-800" style="max-width: 544px;">
           <?=$musteri_data->musteri_ad_soyad?> için post planlama tablosunda tanımlanmış olan kayıt bulunamadı. Özel günler listesinden eklemek istediğiniz günü tanımlayabilirsiniz.
           </p>
          </div>
          <div class="flex justify-center mb-5">
           <a class="btn btn-primary" href="html/demo1/account/home/user-profile.html">
            Tüm Özel Günleri Ekle
           </a>
          </div>
         </div>
        </div>
       </div>


              <?php
             }else{
             foreach($onemli_gun_data as $onemli_gun) :
             ?>


  

            <div  class="card-group flex items-center flex-wrap sm:flex-nowrap justify-between py-4 gap-2.5">
           <div class="flex items-center gap-3.5">
           

            <div class="border border-brand-clarity rounded-lg max-h-20">
                   <div style="<?=date("Y-m-d",strtotime($onemli_gun->onemli_gun_tarih)) < date("Y-m-d") ? "opacity:0.5" : "" ?>" class="flex items-center justify-center border-b border-b-brand-clarity bg-brand-light rounded-t-lg">
                    <span class="text-2sm text-brand font-medium p-2">
                     <?= $aylar[date("m",strtotime($onemli_gun->onemli_gun_tarih))-1]?>
                    </span>
                   </div>
                   <div style="<?=date("Y-m-d",strtotime($onemli_gun->onemli_gun_tarih)) < date("Y-m-d") ? "opacity:0.5" : "" ?>" class="flex items-center justify-center size-12">
                    <span class="font-medium text-gray-800 text-1.5xl tracking-tight">
                     <?=date("d",strtotime($onemli_gun->onemli_gun_tarih))?>
                    </span>
                   </div>
                  </div>
                  <div style="<?=date("Y-m-d",strtotime($onemli_gun->onemli_gun_tarih)) < date("Y-m-d") ? "opacity:0.5" : "" ?>" class="flex flex-col gap-2">
                  <a class="text-xs text-brand leading-[14px] hover:text-primary-active mb-px" href="#">
                   
 
                   <?php 
                   switch ($onemli_gun->onemli_gun_kategori) {
                    case 1:
                      echo "POST";
                      break;
                      case 2:
                        echo "VİDEO";
                        break;
                        case 3:
                          echo "ÇEKİM";
                          break;
                          case 4:
                            echo "YAPILACAK İŞ / DİĞER";
                            break;
                    default:
                      echo "#";
                      break;
                   }
                   ?>

                  </a>
                  <a style="<?=date("Y-m-d",strtotime($onemli_gun->onemli_gun_tarih)) < date("Y-m-d") ? "opacity:0.5" : "" ?>" class="text-md font-medium hover:text-primary text-gray-900 leading-4" href="#">
                  <?=$onemli_gun->onemli_gun_adi?>


                  <span class="badge badge-xs badge-info badge-outline">
               <?=date("d.m.Y",strtotime($onemli_gun->onemli_gun_tarih))?>
              </span>


              <?php
 
$target_date = strtotime($onemli_gun->onemli_gun_tarih);
$current_date = time();
$diff_days = floor(($target_date - $current_date) / (60 * 60 * 24));
 

if (date("Y-m-d",strtotime($onemli_gun->onemli_gun_tarih)) == date("Y-m-d") ) {
    
  ?>
   <span class="badge badge-xs badge-danger b4">Bugün</span>
  <?php
}else {
  

if ($diff_days < 1) {
    
  ?>
  <span class="badge badge-xs badge-outline b4"><?= $diff_days*-1 ?> gün önce</span>
  <?php
}else if ($diff_days == 0) {
    
  ?>
  <span class="badge badge-xs badge-danger b4">Bugün</span>
  <?php
}else if ($diff_days <= 3) {
    
  ?>
  <span class="badge badge-xs badge-danger b4"><?= $diff_days ?> gün kaldı</span>
  <?php
} elseif ($diff_days <= 11) {
   
    ?>
  <span class="badge badge-xs badge-warning b4"><?= $diff_days ?> gün kaldı</span>
  <?php
} else {
   
    ?>
    <span class="badge badge-xs badge-outline b4"><?= $diff_days ?> gün kaldı</span>
    <?php
}
}
?>



                  </a>
                  <p class="text-xs text-gray-800 leading-[22px]">
                  <?=$onemli_gun->alt_metin?>
                  </p>
                 </div>

 
           </div>
           <div class="flex items-center gap-2.5">
            
           <?php 
           if($onemli_gun->tanim_durum == 0){
            ?>
             <a class="btn btn-sm btn-light btn-outline shrink-0" href="#">
            Beklemede <?=date("Y-m-d",strtotime($onemli_gun->onemli_gun_tarih)) < date("Y-m-d") ? "(Süre Geçti)" : "" ?>
            </a>

            <?php
           }else if($onemli_gun->tanim_durum == 1){
            ?>
            <a class="btn btn-sm btn-light btn-success btn-outline shrink-0" href="#">
             Tamamlandı
            </a>

           <?php
           }else{
            ?>
            <a class="btn btn-sm btn-light btn-danger btn-outline shrink-0" href="#">
             Yapılmadı
            </a>

           <?php
           }
           ?>
           


            <div class="dropdown" data-dropdown="true" data-dropdown-placement="bottom-end" data-dropdown-placement-rtl="bottom-start" data-dropdown-trigger="click">
         <button class="dropdown-toggle btn btn-sm btn-icon btn-light">
          <i class="ki-filled ki-dots-vertical">
          </i>
         </button>
         <div class="dropdown-content menu-default w-full max-w-[220px] hidden" style="opacity: 0;">
          <div class="menu-item" data-dropdown-dismiss="true">
          <a class="menu-link" href="<?=base_url("ugajans_musteri/onemli_gun_durum_guncelle/$musteri_data->musteri_id/$onemli_gun->onemli_gun_tanim_id/0/$medya_no")?>">
            <span class="menu-icon">
             <i class="ki-filled ki-award">
             </i>
            </span>
            <span class="menu-title">
             Beklemede
            </span>
           </a>
          </div>
          <div class="menu-item" data-dropdown-dismiss="true">
          <a class="menu-link" href="<?=base_url("ugajans_musteri/onemli_gun_durum_guncelle/$musteri_data->musteri_id/$onemli_gun->onemli_gun_tanim_id/1/$medya_no")?>">
            <span class="menu-icon">
            <i class="ki-filled ki-file-up">
            </i>
            </span>
            <span class="menu-title">
             Tamamlandı
            </span>
           </a>
          </div>
          <div class="menu-item" data-dropdown-dismiss="true">
          <a class="menu-link" href="<?=base_url("ugajans_musteri/onemli_gun_durum_guncelle/$musteri_data->musteri_id/$onemli_gun->onemli_gun_tanim_id/2/$medya_no")?>">
            <span class="menu-icon">
            <i class="ki-filled ki-dislike">
            </i>
            </span>
            <span class="menu-title">
             Yapılmadı
            </span>
           </a>
          </div>
          <div class="menu-item" data-dropdown-dismiss="true">
           <a class="menu-link" href="<?=base_url("ugajans_musteri/onemli_gun_tanim_sil/$musteri_data->musteri_id/$onemli_gun->onemli_gun_tanim_id/$medya_no")?>">
            <span class="menu-icon">
             <i class="ki-filled ki-information-2">
             </i>
            </span>
            <span class="menu-title">
             Listeden Kaldır
            </span>
          </a>
          </div>
         </div>
        </div>




           </div>
          </div>
            <?php
             endforeach;}
             ?>
           </div>
          </div>
   
 

















          
 
        </div>

      </div>
 













     <script>
      document.addEventListener("DOMContentLoaded", function () {





        const scrollPosition = localStorage.getItem("scrollPosition");
    if (scrollPosition) {
        window.scrollTo(0, scrollPosition);
    }


    const scrollableDiv = document.getElementById("notifications_cards");
    const divScrollPosition = localStorage.getItem("divScrollPosition");

    if (scrollableDiv && divScrollPosition) {
        scrollableDiv.scrollTop = divScrollPosition;
    }

    window.addEventListener("scroll", function () {
    localStorage.setItem("scrollPosition", window.scrollY);
});

document.getElementById("notifications_cards").addEventListener("scroll", function () {
    localStorage.setItem("divScrollPosition", this.scrollTop);
});



    var container = document.getElementById("notifications_cards");
    var cards = document.querySelectorAll(".card-group");
    
    if (!container || cards.length === 0) return;

    var closestCard = null;
    var minDiff = Infinity;
    
    cards.forEach(function (card) {
        var badge = card.querySelector(".b4");
      
        if (badge) {
            var text = badge.textContent.trim();
            var match = text.match(/(\d+)/);
           
            if (match) {
                var daysDiff = parseInt(match[1]);
                
                if (text.includes("kaldı")) {
                    daysDiff = Math.abs(daysDiff); // Geçmiş günler pozitif olarak hesaplanır.
                
                }
                
                if (daysDiff < minDiff) {
                    minDiff = daysDiff;
                    closestCard = card;
                    
                }
            }
        }
    });

    if (closestCard) {
       container.scrollTop = closestCard.offsetTop - container.offsetTop ;
    }
});

      </script>