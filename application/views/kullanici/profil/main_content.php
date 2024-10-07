<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="content-wrapper" style="padding-top:0px;background:#f4f4f4;padding-right:0px;">
  <section class="content p-0"> 
    <div class="row">
      <div class="col-md-2 p-0">
        <div class="card card-default" style="border-radius:0px;border-right:1px solid #dbdbdb;    border-top: 5px solid #007bff;border-radius:0px;">
          <div class="card-header text-bold" style="color: #0065e5;">
            TÜM SİSTEM KULLANICILARI
          </div>
          <div class="card-body p-0">
            <?php 
              foreach ($kullanicilar as $k) {
                ?>
                  <button style=" padding: 0; padding-bottom: 12px; padding-top: 12px;   width: -webkit-fill-available;border-bottom:1px solid #e7e7e7;" class="btn">

                  <div class="row">

<div class="col" style="max-width:60px;">
<img src="https://ugbusiness.com.tr/uploads/<?=$k->kullanici_resim?>" style="object-fit:cover;max-width:50px;max-height:50px;min-width:50px;min-height:50px;border: 3px solid #ffffff;outline: 2px solid #393c3721;" alt="user-avatar" class="img-circle img-fluid">
 
</div>
<div class="col text-left">

   <span style=" font-weight: 500;display:block"><?=$k->kullanici_ad_soyad?>
  
   </span>
  
  <span style=" font-weight: 300;display:block">
  <i class="fa fa-bookmark-o" style="color:gray"></i>    
  <?=$k->kullanici_unvan?></span>

</div>

 
 
</div>
                  
              </button>
                <?php
              }
            ?>
          </div>
        </div>
      </div>
      <div class="col-md-7 p-0">
        <div class="card card-danger" style="border-radius:0px;border-bottom:1px solid #dbdbdb;border-right:1px solid #dbdbdb;">
          
          <div class="card-body" style="padding:0px;padding-top:12px;    border-top: 5px solid #007bff;border-radius:0px;">
            <div class="row pl-3" style="padding-bottom:11px;">

            <div class="col" style="max-width:80px;">
            <img src="http://192.168.2.211/ugbusiness/uploads/1702882812540.png" style="object-fit:cover;max-width:60px;max-height:60px;min-width:60px;min-height:60px;border: 3px solid #ffffff;outline: 2px solid #393c3721;" alt="user-avatar" class="img-circle img-fluid">
             
            </div>
            <div class="col">
              <div style="margin:auto;">
               <span style="font-size: 20px; font-weight: 500;display:block">Ergül Kızılkaya  <img src="https://static.vecteezy.com/system/resources/thumbnails/047/309/930/small_2x/verified-badge-profile-icon-png.png" width="18" style="margin-top:-5px" height="18">
               </span>
              </div> 
              <span style="font-size: 15px; font-weight: 300;display:block">
              <i class="fa fa-bookmark-o" style="color:gray"></i>    
              Sistem Yöneticisi
            
              <b class="ml-3">@</b> ergul.kizilkaya
            
            
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
              <div class="col p-0"><button class="btn btn-default" style="padding-bottom:8px;padding-top:8px;font-weight:bold;border-bottom:0px;border-left:0px;background:white;border-radius:0px;width: -webkit-fill-available;"><i class="fa fa-tag"></i>  SATIŞ RAPOR</button></div>
              <div class="col p-0"><button class="btn btn-default" style="padding-bottom:8px;padding-top:8px;font-weight:bold;border-bottom:0px;border-left:0px;background:white;border-radius:0px;width: -webkit-fill-available;"><i class="fa fa-certificate"></i> EĞİTİMLER</button></div>
              <div class="col p-0"><button class="btn btn-default" style="padding-bottom:8px;padding-top:8px;font-weight:bold;border-bottom:0px;border-left:0px;background:white;border-radius:0px;width: -webkit-fill-available;"><i class="fa fa-car"></i> ŞİRKET ARAÇ</button></div>
              <div class="col p-0"><button class="btn btn-default" style="padding-bottom:8px;padding-top:8px;font-weight:bold;border-bottom:0px;border-left:0px;background:white;border-radius:0px;width: -webkit-fill-available;"><i class="fa fa-table"></i>  ENVANTER</button></div>
              <div class="col p-0"><button class="btn btn-default" style="padding-bottom:8px;padding-top:8px;font-weight:bold;border-bottom:0px;border-right:0px;border-left:0px;background:white;border-radius:0px;width: -webkit-fill-available;"><i class="fa fa-clock-o"></i>  GİRİŞ - ÇIKIŞ RAPOR</button></div>

            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3 p-0">
          <div class="card card-default" style="border-radius:0px;    border-top: 5px solid #007bff;border-radius:0px;">
            <div class="card-header text-bold" style="color: #0065e5;">
              KULLANICI İLETİŞİM VE KİŞİSEL BİLGİLER
            </div>
            <div class="card-body p-0">

              <div class="row p-2" style="border-bottom:1px solid #dbdbdb">
                <div class="col" style="max-width:20px;">
                  <i class="fa fa-phone text-red"></i>
                </div>
                <div class="col" style="font-weight:600">
                  İletişim Numarası : <span style="font-weight:normal">05382197344</span>
                </div>
              </div>


              <div class="row p-2" style="border-bottom:1px solid #dbdbdb">
                <div class="col" style="max-width:20px;">
                  <i class="fa fa-phone-square text-orange"></i>
                </div>
                <div class="col" style="font-weight:600">
                  Dahili / Şahsi İletişim Numarası : <span style="font-weight:normal"> Belirtilmedi</span>
                </div>
              </div>

              <div class="row p-2" style="border-bottom:1px solid #dbdbdb">
                <div class="col" style="max-width:20px;">
                  <i class="fa fa-envelope text-primary"></i>
                </div>
                <div class="col" style="font-weight:600">
                  Email Adresi : <span style="font-weight:normal">ergul.kizilkaya@ugteknoloji.com</span>
                </div>
              </div>
              

              <div class="row p-2" style="border-bottom:1px solid #dbdbdb">
                <div class="col" style="max-width:20px;">
                  <i class="fa fa-user text-success"></i>
                </div>
                <div class="col" style="font-weight:600">
                  Doğum Tarihi : <span style="font-weight:normal">01.01.1996 (28 Yaş)</span>
                </div>
              </div>

            
            </div>
          </div>







          
          <div class="card card-default" style="border-radius:0px;margin-top:-10px;">
            <div class="card-header text-bold" style="color: #0065e5;">
              ÇALIŞMA GÖREV BİLGİLERİ
            </div>
            <div class="card-body p-0">

              
              
            <div class="row p-2" style="border-bottom:1px solid #dbdbdb">
                <div class="col" style="max-width:20px;">
                  <i class="fa fa-calendar text-orange"></i>
                </div>
                <div class="col" style="font-weight:600">
                  İşe Başlama Tarihi : <span style="font-weight:normal">18.05.2024 (1 Yıl 5 Ay)</span>
                </div>
              </div>

            

              <div class="row p-2" style="border-bottom:1px solid #dbdbdb">
                <div class="col" style="max-width:20px;">
                  <i class="fa fa-building text-primary"></i>
                </div>
                <div class="col" style="font-weight:600">
                 Departman : <span style="font-weight:normal">Yönetim</span>
                </div>
              </div>


              <div class="row p-2" style="border-bottom:1px solid #dbdbdb">
                <div class="col" style="max-width:20px;">
                  <i class="fa fa-user text-success"></i>
                </div>
                <div class="col" style="font-weight:600">
                 Sorumlu Müdür / Kişi : <span style="font-weight:normal">Harun KISA</span>
                </div>
              </div>






              <div class="row p-2" style="border-bottom:1px solid #dbdbdb">
                <div class="col" style="max-width:20px;">
                  <i class="fa fa-building text-red"></i>
                </div>
                <div class="col" style="font-weight:600">
                 Görev Bölgesi : <span style="font-weight:normal">ADANA (FABRİKA)</span>
                </div>
              </div>




              <div class="row p-2" style="border-bottom:1px solid #dbdbdb">
                <div class="col" style="max-width:20px;">
                  <i class="fa fa-car text-orange"></i>
                </div>
                <div class="col" style="font-weight:600">
                 Şirket Aracı : <span style="font-weight:normal">Araç Tanımlı Değil</span>
                </div>
              </div>

               
  

            </div>
          </div>










          <div class="card card-default" style="border-radius:0px;margin-top:-10px;">
            <div class="card-header text-bold" style="color: #0065e5;">
              HIZLI ERİŞİM MENÜSÜ
            </div>
            <div class="card-body p-0">

              <div class="row p-2" style="border-bottom:1px solid #dbdbdb">
                <div class="col" style="max-width:20px;">
                  <i class="fa fa-envelope text-orange"></i>
                </div>
                <div class="col" style="font-weight:400">
                  <b>SMS</b> İle Giriş Bilgilerini Gönder
                </div>
              </div>

              <div class="row p-2" style="border-bottom:1px solid #dbdbdb">
                <div class="col" style="max-width:20px;">
                  <i class="fab fa-whatsapp text-success"></i>
                </div>
                <div class="col" style="font-weight:400">
                <b>Whatsapp</b> İle Giriş Bilgilerini Gönder
                </div>
              </div>
              
              <div class="row p-2" style="border-bottom:1px solid #dbdbdb">
                <div class="col" style="max-width:20px;">
                  <i class="fa fa-clock text-primary"></i>
                </div>
                <div class="col" style="font-weight:400">
                Tamamlanmayan Görev Atamaları
                </div>
              </div>


              <div class="row p-2" style="border-bottom:1px solid #dbdbdb">
                <div class="col" style="max-width:20px;">
                  <i class="fa fa-ban text-danger"></i>
                </div>
                <div class="col" style="font-weight:400">
                Kullanıcı Hesabını Engelle
                </div>
              </div>
              <div class="row p-2" style="border-bottom:1px solid #dbdbdb">
                <div class="col" style="max-width:20px;">
                  <i class="fa fa-check text-success"></i>
                </div>
                <div class="col" style="font-weight:400">
                Kullanıcı Hesabını Aktifleştir
                </div>
              </div>

              

            </div>
          </div>





          <div class="card card-default" style="border-radius:0px;margin-top:-10px;">
            <div class="card-header text-bold" style="color: #0065e5;">
              OTURUM DETAYLARI
            </div>
            <div class="card-body p-0">

              <div class="row p-2" style="border-bottom:1px solid #dbdbdb">
                <div class="col" style="max-width:20px;">
                  <i class="fa fa-envelope text-orange"></i>
                </div>
                <div class="col" style="font-weight:600">
                  Son Giriş Zamanı : <span style="font-weight:normal">07.07.2024 16:02</span>
                </div>
              </div>

              
              <div class="row p-2" style="border-bottom:1px solid #dbdbdb">
                <div class="col" style="max-width:20px;">
                  <i class="fa fa-server text-success"></i>
                </div>
                <div class="col" style="font-weight:600">
                  Son Giriş Yapılan IP Adresi : <span style="font-weight:normal">192.168.2.211</span>
                </div>
              </div>


               
  

            </div>
          </div>



      </div>

      
    </div>
  <section>
</div>



<style>
  .card{
    box-shadow: none;
  }
 
  .btn-default:hover{
background:#007bff!important;
color:white;
  }

  
  .btn-default:active{
scale:0.9;
  }
  </style>