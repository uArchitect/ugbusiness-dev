

      
      <div class="col p-0" style="max-width:360px">
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
                  İletişim Numarası : <span style="font-weight:normal"><?=$kullanici_data->kullanici_bireysel_iletisim_no?></span>
                </div>
              </div>


              <div class="row p-2" style="border-bottom:1px solid #dbdbdb">
                <div class="col" style="max-width:20px;">
                  <i class="fa fa-phone-square text-orange"></i>
                </div>
                <div class="col" style="font-weight:600">
                  Dahili / Şahsi İletişim Numarası : <span style="font-weight:normal"> <?=$kullanici_data->kullanici_dahili_iletisim_no != "" ? $kullanici_data->kullanici_dahili_iletisim_no : "Belirtilmedi"?></span>
                </div>
              </div>

              <div class="row p-2" style="border-bottom:1px solid #dbdbdb">
                <div class="col" style="max-width:20px;">
                  <i class="fa fa-envelope text-primary"></i>
                </div>
                <div class="col" style="font-weight:600">
                  Email Adresi : <span style="font-weight:normal"><?=$kullanici_data->kullanici_email_adresi?></span>
                </div>
              </div>
              <div class="row p-2" style="border-bottom:1px solid #dbdbdb">
                <div class="col" style="max-width:20px;">
                  <i class="fa fa-bookmark-o text-purple"></i>
                </div>
                <div class="col" style="font-weight:600">
                  Kullanıcı Ünvan : <span style="font-weight:normal"><?=$kullanici_data->kullanici_unvan?></span>
                </div>
              </div>

              <div class="row p-2" style="border-bottom:1px solid #dbdbdb">
                <div class="col" style="max-width:20px;">
                  <i class="fa fa-user text-success"></i>
                </div>
                <div class="col" style="font-weight:600">
                  Doğum Tarihi : <span style="font-weight:normal"><?=date("d.m.Y",strtotime($kullanici_data->kullanici_dogum_tarihi))?> (<?=(date_diff(date_create(date("Y-m-d",strtotime($kullanici_data->kullanici_dogum_tarihi))), date_create('today'))->y)?> Yaş)</span>
                </div>
              </div>

            
            </div>
          </div>







          
          <div class="card card-default" style="border-radius:0px;margin-top:-6px;">
            <div class="card-header text-bold" style="color: #0065e5;">
              ÇALIŞMA GÖREV BİLGİLERİ
            </div>
            <div class="card-body p-0">

              
              
            <div class="row p-2" style="border-bottom:1px solid #dbdbdb">
                <div class="col" style="max-width:20px;">
                  <i class="fa fa-calendar text-orange"></i>
                </div>
                <div class="col" style="font-weight:600">
                  İşe Başlama Tarihi : <span style="font-weight:normal"><?=date("d.m.Y",strtotime($kullanici_data->kullanici_ise_giris_tarihi))?> (<?=(new DateTime(date("Y-m-d",strtotime($kullanici_data->kullanici_ise_giris_tarihi))))->diff(new DateTime(date("Y-m-d")))->format('%y yıl, %m ay')?>)</span>
                </div>
              </div>

            

              <div class="row p-2" style="border-bottom:1px solid #dbdbdb">
                <div class="col" style="max-width:20px;">
                  <i class="fa fa-building text-primary"></i>
                </div>
                <div class="col" style="font-weight:600">
                 Departman : <span style="font-weight:normal"><?=$kullanici_data->departman_adi?> Departmanı</span>
                </div>
              </div>


              <div class="row p-2" style="border-bottom:1px solid #dbdbdb">
                <div class="col" style="max-width:20px;">
                  <i class="fa fa-user text-success"></i>
                </div>
                <div class="col" style="font-weight:600">
                 Sorumlu Müdür / Kişi : <span style="font-weight:normal">-----</span>
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










          <div class="card card-default" style="border-radius:0px;margin-top:-6px;">
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





          <div class="card card-default" style="border-radius:0px;margin-top:-6px;">
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