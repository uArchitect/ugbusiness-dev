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
         Tüm ug ajans müşteri talepleri listelenmiştir. Yeni kayıt oluşturmak için Talep Ekle butonuna tıklayınız.
        </div>
       </div>
       <div class="flex items-center gap-2.5">
        
        
       </div>
      </div>
     </div>
     <!-- End of Container -->
     <!-- Container -->
     <div class="container-fixed">
      <div class="grid grid-cols-3 gap-5 lg:gap-7.5">
 
<div class="col-span-2">
    


















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
           <a class="group btn px-3 text-gray-700 hover:text-primary tab-active:bg-primary-light tab-active:border-primary-clarity tab-active:text-primary  " href="<?=base_url('talep')?>">
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
            <input placeholder="Talep Ara..." type="text" value="">
            </input>
           </label>
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
              <a href="<?=base_url("ugajans_talep/index/$talep->talep_id?filter=".(isset($_GET["filter"]) ? $_GET["filter"] : "0"))?>" class="menu-toggle btn btn-sm btn-icon btn-light btn-clear">
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
        


<div class="col-span-1">
<?php 

if(isset($edit_talep)){
?>
<form action="<?=base_url("ugajans_talep/talep_guncelle/$edit_talep->talep_id")?>" method="post">
<div class="card pb-2.5 bg-brand-light">
          <div class="card-header" id="webhooks">
           <h3 class="card-title text-brand">
            Talep Bilgilerini Düzenle
           </h3>
          </div>
          <div class="card-body grid gap-5">
           <p class="text-2sm text-gray-600">
           <i class="ki-filled ki-information-2   leading-none">
                  </i> Bilgileri güncellemek için belirtilen tüm alanları doldurunuz. Görüşme sonucunun detaylı girilmesi daha sonraki süreçler için faydalı olacaktır.
           </p>
           <div class="flex items-center flex-wrap lg:flex-nowrap gap-2.5">
            <label class="form-label max-w-25" style="max-width:100px">
             Ad Soyad  :
            </label>
            <div class="grow">
             <input class="input" name="talep_ad_soyad" placeholder="Müşteri Adı Soyadı" type="text" value="<?=$edit_talep->talep_ad_soyad?>">
            </div>
           </div>
           <div class="flex items-center flex-wrap lg:flex-nowrap gap-2.5">
            <label class="form-label max-w-25" style="max-width:100px">
            İletişim  :
            </label>
            <div class="grow">
             <input class="input" name="talep_iletisim_numarasi" placeholder="İletişim Numarası" type="text" value="<?=$edit_talep->talep_iletisim_numarasi?>">
            </div>
           </div>
           <div class="flex items-center flex-wrap lg:flex-nowrap gap-2.5">
            <label class="form-label max-w-25" style="max-width:100px">
            Email  :
            </label>
            <div class="grow">
             <input class="input" name="talep_email_adresi" value="<?=$edit_talep->talep_email_adresi?>" placeholder="Email Adresi" type="text" >
            </div>
           </div>

           
           <div class="flex items-center flex-wrap lg:flex-nowrap gap-2.5">
            <label class="form-label" style="max-width:100px">
             Kaynak :
            </label>
            <div class="grow">
             <select class="select" name="talep_kaynak_no">
                <?php 
                $tkaynaklar = get_talep_kaynaklar();
                foreach ($tkaynaklar as $tk) {
                    ?>
                    <option <?=$edit_talep->talep_kaynak_no == $tk->ugajans_talep_kaynak_id ? "selected" : "" ?> value="<?=$tk->ugajans_talep_kaynak_id?>">
                        <?=$tk->ugajans_talep_kaynak_adi?>
                    </option>
                    <?php
                }
                ?>
             
             </select>
            </div>
           </div>

           <div class="flex items-center flex-wrap lg:flex-nowrap gap-2.5">
            <label class="form-label" style="max-width:100px">
             Durum :
            </label>
            <div class="grow">
            <select class="select" name="talep_kategori_no">
                <?php 
                $tkaynaklar = get_talep_kategoriler();
                foreach ($tkaynaklar as $tk) {
                    ?>
                    <option <?=$edit_talep->talep_kategori_no == $tk->talep_kategori_id ? "selected" : "" ?> value="<?=$tk->talep_kategori_id?>">
                        <?=$tk->talep_kategori_adi?>
                    </option>
                    <?php
                }
                ?>
             
             </select>
            </div>
           </div>
           <div class="flex items-center flex-wrap lg:flex-nowrap gap-2.5">
            <label class="form-label" style="max-width:100px">
             Görüşme Detayları :
            </label>
            <div class="grow">
           <textarea class="input" name="talep_gorusme_detaylari" style="height:120px"><?=$edit_talep->talep_gorusme_detaylari?></textarea>
            </div>
           </div>
           <div class="flex justify-end gap-2">
            <button class="btn btn-success text-center flex-1" style="text-align: center; display: block;">
             Değişiklikleri Kaydet
            </button>
            <button class="btn btn-danger" style="text-align: center; display: block;">
             İptal Et
            </button>
           </div>
          </div>
         </div>
            </form>
            <?php 
}
?>
            <?php 

if(!isset($edit_talep)){
    
?>









<form action="<?=base_url("ugajans_talep/talep_ekle")?>" method="post">
         <div class="card pb-2.5 bg-success-light">
          <div class="card-header" id="webhooks">
           <h3 class="card-title text-success">
            Yeni Talep Oluştur
           </h3>
          </div>
          <div class="card-body grid gap-5">
           <p class="text-2sm text-gray-600">
           <i class="ki-filled ki-information-2   leading-none">
                  </i> Yeni talep oluşturmak için belirtilen tüm alanları doldurunuz. Görüşme sonucunun detaylı girilmesi daha sonraki süreçler için faydalı olacaktır.
           </p>
           <div class="flex items-center flex-wrap lg:flex-nowrap gap-2.5">
            <label class="form-label max-w-25" style="max-width:100px">
             Ad Soyad  :
            </label>
            <div class="grow">
             <input class="input" name="talep_ad_soyad" placeholder="Müşteri Adı Soyadı" type="text" value="">
            </div>
           </div>
           <div class="flex items-center flex-wrap lg:flex-nowrap gap-2.5">
            <label class="form-label max-w-25" style="max-width:100px">
            İletişim  :
            </label>
            <div class="grow">
             <input class="input" name="talep_iletisim_numarasi" placeholder="İletişim Numarası" type="text" value="">
            </div>
           </div>
           <div class="flex items-center flex-wrap lg:flex-nowrap gap-2.5">
            <label class="form-label max-w-25" style="max-width:100px">
            Email  :
            </label>
            <div class="grow">
             <input class="input" name="talep_email_adresi" placeholder="Email Adresi" type="text" value="">
            </div>
           </div>

           
           <div class="flex items-center flex-wrap lg:flex-nowrap gap-2.5">
            <label class="form-label" style="max-width:100px">
             Kaynak :
            </label>
            <div class="grow">
             <select class="select" name="talep_kaynak_no">
                <?php 
                $tkaynaklar = get_talep_kaynaklar();
                foreach ($tkaynaklar as $tk) {
                    ?>
                    <option value="<?=$tk->ugajans_talep_kaynak_id?>">
                        <?=$tk->ugajans_talep_kaynak_adi?>
                    </option>
                    <?php
                }
                ?>
             
             </select>
            </div>
           </div>

           <div class="flex items-center flex-wrap lg:flex-nowrap gap-2.5">
            <label class="form-label" style="max-width:100px">
             Durum :
            </label>
            <div class="grow">
            <select class="select" name="talep_kategori_no">
                <?php 
                $tkaynaklar = get_talep_kategoriler();
                foreach ($tkaynaklar as $tk) {
                    ?>
                    <option value="<?=$tk->talep_kategori_id?>">
                        <?=$tk->talep_kategori_adi?>
                    </option>
                    <?php
                }
                ?>
             
             </select>
            </div>
           </div>
           <div class="flex items-center flex-wrap lg:flex-nowrap gap-2.5">
            <label class="form-label" style="max-width:100px">
             Görüşme Detayları :
            </label>
            <div class="grow">
           <textarea class="input" name="talep_gorusme_detaylari" style="height:120px"></textarea>
            </div>
           </div>
           <div class="flex justify-end gap-2">
            <button class="btn btn-success text-center flex-1" style="text-align: center; display: block;">
             Bilgileri Kaydet
            </button>
           
           </div>
          </div>
         </div>

         </form>

         <?php 

}
?>
</div>


      </div>
     </div>
     <!-- End of Container -->