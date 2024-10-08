<div class="col p-0">
      
<div class="row">


       <div class="card card-danger col p-0" style="    width: -webkit-fill-available;border-radius:0px;border-bottom:1px solid #dbdbdb;border-right:1px solid #dbdbdb;">
          
          <div class="card-body" style="padding:0px;padding-top:12px;    border-top: 5px solid #007bff;border-radius:0px;">
            <div class="row pl-3" style="padding-bottom:11px;">

            <div class="col" style="max-width:80px;">
            <img src="https://ugbusiness.com.tr/uploads/<?=$kullanici_data->kullanici_resim?>" style="object-fit:cover;max-width:60px;max-height:60px;min-width:60px;min-height:60px;border: 3px solid #ffffff;outline: 2px solid #393c3721;" alt="user-avatar" class="img-circle img-fluid">
             
            </div>
            <div class="col">
              <div style="margin:auto;">
               <span style="font-size: 20px; font-weight: 500;display:block"><?=$kullanici_data->kullanici_ad_soyad?>  <img src="https://static.vecteezy.com/system/resources/thumbnails/047/309/930/small_2x/verified-badge-profile-icon-png.png" width="18" style="margin-top:-5px" height="18">
               </span>
              </div> 
              <span style="font-size: 15px; font-weight: 300;display:block">
              <i class="fa fa-bookmark-o" style="color:gray"></i>    
              <?=$kullanici_data->kullanici_unvan?>
            
              <b class="ml-3">@</b> <?=$kullanici_data->kullanici_adi?>
            
            
            </span>
            
            </div>

            <div class="col" style="max-width:420px;display:flex;">
               <button class="btn btn-primary" style="height:35px;border-radius:70px;margin-top:10px;margin-right:10px;">
                <i class="fa fa-pencil  "></i> Bilgileri Düzenle
               </button>
               <button class="btn btn-primary" style="background:#e5e5e5;border:1px solid #e5e5e5;margin-right:10px;color:black;height:35px;border-radius:70px;margin-top:10px;">
                <i class="fa fa-envelope"></i> SMS Gönder
               </button>
               <button class="btn btn-primary" style="background:#e5e5e5;border:1px solid #e5e5e5;color:black;height:35px;border-radius:70px;margin-top:10px;">
                <i class="fa fa-arrow-right"></i> Görev Ata
               </button>
            </div>
             
            </div>
            <div class="row p-0">
              <div class="col p-0"><a href="<?=base_url("kullanici/profil_kullanici_satis_rapor/$secilen_kullanici")?>" class="btn btn-default" style="padding-bottom:8px;padding-top:8px;font-weight:bold;border-bottom:0px;border-left:0px;background:white;border-radius:0px;width: -webkit-fill-available;"><i class="fa fa-tag"></i>  SATIŞ RAPOR </a></div>
              <div class="col p-0"><a href="<?=base_url("kullanici/profil_kullanici_egitim_rapor/$secilen_kullanici")?>" class="btn btn-default" style="padding-bottom:8px;padding-top:8px;font-weight:bold;border-bottom:0px;border-left:0px;background:white;border-radius:0px;width: -webkit-fill-available;"><i class="fa fa-certificate"></i> EĞİTİMLER </a></div>
              <div class="col p-0"><a href="<?=base_url("kullanici/profil_kullanici_arac_rapor/$secilen_kullanici")?>" class="btn btn-default" style="padding-bottom:8px;padding-top:8px;font-weight:bold;border-bottom:0px;border-left:0px;background:white;border-radius:0px;width: -webkit-fill-available;"><i class="fa fa-car"></i> ŞİRKET ARAÇ </a></div>
               
            </div>
          </div>
        </div>
        </div>