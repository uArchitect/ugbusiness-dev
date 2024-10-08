<div class="col p-0">
      
<div class="row">


       <div class="card card-danger col p-0" style="    width: -webkit-fill-available;border-radius:0px;border-bottom:1px solid #dbdbdb;border-right:1px solid #dbdbdb;">
          
          <div class="card-body" style="padding:0px;padding-top:12px;    border-top: 5px solid #007bff;border-radius:0px;">
            <div class="row pl-3" style="padding-bottom:11px;">
            <div class="col" style="max-width:170px;">
            <a href="<?=base_url("kullanici/kullanici_detay_rapor")?>" class="btn btn-primary mt-2">
              <i class="fa fa-arrow-left"></i> Tüm Kullanıcılar 
</a>
            </div>
            <div class="col" style="max-width:80px;">
            <img src="https://ugbusiness.com.tr/uploads/<?=$kullanici_data->kullanici_resim?>" style="object-fit:cover;max-width:60px;max-height:60px;min-width:60px;min-height:60px;border: 3px solid #ffffff;outline: 2px solid #393c3721;" alt="user-avatar" class="img-circle img-fluid">
             
            </div>
            <div class="col">
              <div style="margin:auto;">
               <span style="font-size: 20px; font-weight: 500;display:block"><?=$kullanici_data->kullanici_ad_soyad?>  <img src="https://static.vecteezy.com/system/resources/thumbnails/047/309/930/small_2x/verified-badge-profile-icon-png.png" width="18" style="margin-top:-5px" height="18">
               </span>
              </div> 
              <span style="font-size: 15px; font-weight: 300;display:block">
               
              <?=$kullanici_data->kullanici_unvan?>
            
              <i class="fa fa-phone text-red ml-2"></i> <?=$kullanici_data->kullanici_bireysel_iletisim_no?>
              <i class="fa fa-user text-success ml-2"></i> Doğum Tarihi : <span style="font-weight:normal"><?=date("d.m.Y",strtotime($kullanici_data->kullanici_dogum_tarihi))?> (<?=(date_diff(date_create(date("Y-m-d",strtotime($kullanici_data->kullanici_dogum_tarihi))), date_create('today'))->y)?> Yaş)</span>
              <i class="fa fa-calendar text-orange ml-2"></i> İşe Başlama Tarihi : <span style="font-weight:normal"><?=date("d.m.Y",strtotime($kullanici_data->kullanici_ise_giris_tarihi))?> (<?=(new DateTime(date("Y-m-d",strtotime($kullanici_data->kullanici_ise_giris_tarihi))))->diff(new DateTime(date("Y-m-d")))->format('%y yıl, %m ay')?>)</span>
              <i class="fa fa-building text-primary ml-2"></i> Departman : <span style="font-weight:normal"><?=$kullanici_data->departman_adi?> Departmanı</span>
            
            </span>
            
            </div>

           
             
            </div>
            <div class="row p-0">
              <div class="col p-0"><a href="<?=base_url("kullanici/profil_kullanici_satis_rapor/$secilen_kullanici")?>" class="btn btn-default" style="padding-bottom:8px;padding-top:8px;border-bottom:0px;border-left:0px;background:white;border-radius:0px;width: -webkit-fill-available;<?=$onpage == "profil_satis_raporu" ? "font-weight:bold;" : "font-weight:normal;"?>"><i class="fa fa-tag"></i>  SATIŞ RAPOR </a></div>
              <div class="col p-0"><a href="<?=base_url("kullanici/profil_kullanici_egitim_rapor/$secilen_kullanici")?>" class="btn btn-default" style="padding-bottom:8px;padding-top:8px;border-bottom:0px;border-left:0px;background:white;border-radius:0px;width: -webkit-fill-available;<?=$onpage == "profil_egitim_raporu" ? "font-weight:bold;" : "font-weight:normal;"?>"><i class="fa fa-certificate"></i> EĞİTİMLER </a></div>
              <div class="col p-0"><a href="<?=base_url("kullanici/profil_kullanici_arac_rapor/$secilen_kullanici")?>" class="btn btn-default" style="padding-bottom:8px;padding-top:8px;border-bottom:0px;border-left:0px;background:white;border-radius:0px;width: -webkit-fill-available;<?=$onpage == "profil_arac_raporu" ? "font-weight:bold;" : "font-weight:normal;"?>"><i class="fa fa-car"></i> ŞİRKET ARAÇ </a></div>
              
              <div class="col p-0">

              <form id="myform59" action="https://ugbusiness.com.tr/talep/yonlendirmeler" method="post">
                        <input type="hidden" name="yonlenen_kullanici_id" value="<?=$secilen_kullanici?>">
                        <a onclick="document.getElementById('myform59').submit();" class="btn btn-default" style="padding-bottom:8px;padding-top:8px;border-bottom:0px;border-left:0px;background:white;border-radius:0px;width: -webkit-fill-available;<?=$onpage == "profil_arac_raporu" ? "font-weight:bold;" : "font-weight:normal;"?>">
                  <i class="fa fa-phone"></i> YÖNLENDİRMELER 
                </a>
              
              </form>

               
              </div>
               
            </div>
          </div>
        </div>
        </div>