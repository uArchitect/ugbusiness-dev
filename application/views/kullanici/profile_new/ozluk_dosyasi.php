<div class="row pt-2">
<div class="col" style="max-width:300px;">
        <div class="quick-access">
            <h3 style="text-align:left;">Hızlı Erişim</h3>
            <ul>
                <li><a href="#personal-info"><i class="fas fa-user"></i> Kişisel Bilgiler</a></li>
                <li><a href="#contact-info"><i class="fas fa-envelope"></i> İletişim Bilgileri</a></li>
                <li><a href="#personal-info"><i class="fas fa-car"></i> Sürücü Bilgileri</a></li>
                <li><a href="#work-experience"><i class="fas fa-graduation-cap"></i> Eğitim Bilgileri</a></li>
                
                <li><a href="#health-info"><i class="fas fa-certificate"></i> Sertifika Bilgileri</a></li>
                <li><a href="#health-info"><i class="fas fa-globe"></i> Dil Bilgisi</a></li>
                <li><a href="#work-experience"><i class="fas fa-briefcase"></i> İş Deneyimi</a></li>
                <li><a href="#health-info"><i class="fas fa-heartbeat"></i> Sağlık Bilgileri</a></li>
                <li><a href="#health-info"  style="color:red!important;"><i  style="color:red!important;" class="fas fa-user-shield"></i> Acil Durum</a></li>
            </ul>
        </div>
        <div class="quick-access mt-3">
            <h3 style="text-align:left;">Dışa Aktarma Seçenekleri</h3>
            <ul>
    <li><a href="#export-pdf"><i class="fas fa-file-pdf  text-danger"></i> PDF Olarak Dışa Aktar</a></li>
    <li><a href="#export-excel"><i class="fas fa-file-excel  text-success"></i> Excel'e Aktar</a></li>
    <li><a href="#export-word"><i class="fas fa-file-word  text-primary"></i> Word'e Aktar</a></li>
    <li><a href="#export-txt"><i class="fas fa-file-alt text-orange"></i> Txt Dosyası Oluştur</a></li>
    <li><a href="#share-whatsapp"><i class="fab fa-whatsapp text-success"></i> Bilgileri Whatsapp'tan Paylaş</a></li> 
</ul>

        </div>
    </div>


    <div class="col" >

     
<div class="resume-container">
<header class="resume-header">
    <div class="resume-profile-header">
        <div class="resume-profile-img-container">
            <img src="<?=base_url("uploads/".$data_kullanici->kullanici_resim)?>" alt="[Ad Soyad]" class="resume-profile-img">
        </div>
        <div class="resume-profile-info">
            <h1><?=$data_kullanici->kullanici_ad_soyad?></h1>
            <p class="resume-job-title"><i class="fas fa-briefcase"></i> <?=$data_kullanici->kullanici_unvan?></p>  
        </div>
    </div>
</header>

        <section  id="kisisel-bilgiler"  class="resume-personal-info">
            <h2>Kişisel Bilgiler</h2>
            <table>
            <tr>
                    <th>TC Kimlik No</th>
                    <td><?=$data_kullanici->kullanici_tc_kimlik_no?></td>
                </tr>
                <tr>
                    <th>Doğum Tarihi</th>
                    <td><?=date("d.m.Y",strtotime($data_kullanici->kullanici_dogum_tarihi))?></td>
                </tr>
                <tr>
                    <th>Medeni Durum</th>
                    <td><?=$data_kullanici->kullanici_medeni_durum == 0 ? "BİLİNMİYOR" : ($data_kullanici->kullanici_medeni_durum == 1 ? "EVLİ" : "BEKAR")?></td>
                </tr>
             
                <tr>
                    <th>Uyruk</th>
                    <td><?=$data_kullanici->kullanici_uyruk?></td>
                </tr>
                <tr>
                    <th>Askerlik Durumu</th>
                    <td><?=$data_kullanici->kullanici_askerlik_durum?></td>
                </tr>
                <tr>
                    <th>Ehliyet Bilgileri</th>
                    <td><?=$data_kullanici->kullanici_ehliyet_bilgileri?></td>
                </tr>
            </table>
        </section>


        <section  id="kisisel-bilgiler"  class="resume-personal-info">
            <h2>Sürücü Bilgileri</h2>
            <table>
           
                <tr>
                    <th>Ehliyet Sınıfı</th>
                    <td><?=$data_kullanici->kullanici_ehliyet_bilgileri?></td>
                </tr>
                <tr>
                    <th>Ticari Araç Kullanım Yetkisi</th>
                    <td><?=$data_kullanici->kullanici_ehliyet_ticari?></td>
                </tr> 
            </table>
        </section>










        <section id="iletisim-bilgileri"  class="resume-contact-info">
            <h2>İletişim Bilgileri</h2>
            <table>
            <tr>
                    <th>Adres</th>
                    <td><?=$data_kullanici->kullanici_adres?></td>
                </tr>
                <tr>
                    <th>Adres Kodu</th>
                    <td><?=$data_kullanici->kullanici_adres_kodu?></td>
                </tr>
                <tr>
                    <th>Telefon</th>
                    <td><?=$data_kullanici->kullanici_bireysel_iletisim_no?></td>
                </tr>
                <tr>
                    <th>E-posta</th>
                    <td><?=$data_kullanici->kullanici_email_adresi?></td>
                </tr>
                <tr>
                    <th>LinkedIn</th>
                    <td><a href="[LinkedIn URL]" target="_blank">LinkedIn Profili</a></td>
                </tr> 
            </table>
        </section>

        
        <section id="is-deneyimi"  class="resume-work-experience">
            <h2>Eğitim Bilgileri</h2>

            <table>
            <tr>
                    <th>Öğrenim Derecesi</th>
                    <td><?=$data_kullanici->kullanici_ogrenim_derecesi?></td>
                </tr>
                <tr>
                    <th>Okul Adı</th>
                    <td><?=$data_kullanici->kullanici_okul_adi?></td>
                </tr>
                <tr>
                    <th>Mezuniyet Tarihi</th>
                    <td><?=$data_kullanici->kullanici_mezuniyet_tarihi?></td>
                </tr>
                
                
            </table>


            
        </section>


        <section id="is-deneyimi"  class="resume-work-experience">
            <h2>İş Deneyimi</h2>

            <table>
            <tr>
                    <th>İşyeri Adı</th>
                    <td>UG TEKNOLOJİ / UMEX</td>
                </tr>
                <tr>
                    <th>Pozisyon</th>
                    <td><?=$data_kullanici->kullanici_unvan?></td>
                </tr>
                <?php
    $ise_giris_tarihi = new DateTime($data_kullanici->kullanici_ise_giris_tarihi);
    $bugun = new DateTime(); // Şu anki tarih
    $fark = $ise_giris_tarihi->diff($bugun);
?>
<tr>
    <th>İşe Giriş Tarihi</th>
    <td><?= date("d.m.Y", strtotime($data_kullanici->kullanici_ise_giris_tarihi)) ?></td>
</tr>
<tr>
    <th>Çalışma Süresi</th>
    <td><?= $fark->y ?> yıl, <?= $fark->m ?> ay, <?= $fark->d ?> gün</td>
</tr>
                
            </table>


            
        </section>

        <section  id="saglik-bilgileri" class="resume-work-experience">
            <h2>Sertifika Bilgileri</h2>

            <table>
            <tr>
                    <th>Sertifikalar</th>
                    <td><?=$data_kullanici->kullanici_sertifika?></td>
                </tr> 
                        
            </table>


            
        </section>
  

        <section  id="saglik-bilgileri" class="resume-work-experience">
            <h2>Dil Bilgisi</h2>

            <table>
            <tr>
                    <th>Yabancı Dil Bilgisi</th>
                    <td><?=$data_kullanici->kullanici_dil_bilgisi?></td>
                </tr> 
                        
            </table>


            
        </section>

        <section  id="saglik-bilgileri" class="resume-work-experience">
            <h2>Sağlık Bilgileri</h2>

            <table>
            <tr>
                    <th>Kan Grubu</th>
                    <td><?=$data_kullanici->kullanici_kan_grubu?></td>
                </tr>
                <tr>
                    <th>Sürekli Kullandığı İlaç</th>
                    <td><?=$data_kullanici->kullanici_surekli_kullandigi_ilac?></td>
                </tr>
                        
            </table>


            
        </section>

        <section  id="saglik-bilgileri" class="resume-work-experience">
            <h2>Acil Durumda İletişim Bilgileri</h2>

            <table>
            <tr>
                    <th>İletişim Numarası</th>
                    <td><?=$data_kullanici->kullanici_acil_durum_iletisim?></td>
                </tr> 
                <tr>
                    <th>Yakınlık Derecesi</th>
                    <td><?=$data_kullanici->kullanici_acil_durum_yakinlik?></td>
                </tr>      
            </table>


            
        </section>
        </div>


         
    </div>


   
<style>
    body{
        overflow-y: hidden;
    }
.quick-access {
    background: #fff;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    
    top: 20px;
}
.quick-access h3 {
    font-size: 1.2em;
    margin-bottom: 10px; 
    text-align: left;
    background: #f1f1f1;
    padding: 10px;
    border-radius: 7px 7px 0 0;
    margin: -17px;
    margin-bottom: 7px;
    padding-left: 24px;
}
.quick-access ul {
    list-style: none;
    padding: 0;
}
.quick-access ul li {
    margin-bottom: 8px;
}
.quick-access ul li a {
    display: flex;
    align-items: center;
    text-decoration: none;
    color: #333;
    padding: 8px;
    border-radius: 5px;
    transition: 0.3s;
}
.quick-access ul li a i {
    margin-right: 10px;
}
.quick-access ul li a:hover {
    background: #007bff;
    color: #fff;
} 

        /* Özgeçmiş sayfasına özgü stil */
.resume-container {
    width: 100%;
    margin: 0 auto;
    margin-bottom:10px;
    height: 782px;
    overflow-y: auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}
.resume-header {
    background: linear-gradient(to right, #f1f1f1, #f1f1f1);
    padding: 20px; 
    border-radius: 3px;
    color: #343a40;border: 1px solid #d7d7d7;
    margin-bottom: 14px; 
}

.resume-profile-header {
    display: flex;
    align-items: center; 
    gap: 20px;
}

.resume-profile-img-container {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    overflow: hidden;
    border: 4px solid #343a40;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
}

.resume-profile-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.resume-profile-info h1 {
    font-size: 24px;
    margin: 0;
    font-weight: bold;
}

.resume-job-title {
    font-size: 16px;
    margin-top: 5px;
    font-weight: 500;
    opacity: 0.9;
}


.resume-profile-info h1 {
    font-size: 2.8em;
    margin-bottom: 10px;
}

.resume-profile-info p {
    margin-bottom: 5px;
}

.resume-personal-info, .resume-contact-info, .resume-work-experience, .resume-education, .resume-skills, .resume-languages {
    margin-bottom: 30px;
}

h2 {
    font-size: 1.5em;
    margin-bottom: 15px;
    color: #2c3e50;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    width: 25%;
    background-color: #f1f1f1;
}

.resume-job, .resume-degree {
    margin-bottom: 20px;
}

.resume-job h3, .resume-degree h3 {
    font-size: 1.2em;
    color: #2980b9;
}

.resume-duration {
    font-size: 0.9em;
    color: #7f8c8d;
}

a {
    color: #2980b9;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

ul {
    list-style: none;
}

ul li {
    margin-bottom: 8px;
}

        </style>


    </div>
</div>