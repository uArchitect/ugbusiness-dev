<div class="row pt-2">
<div class="col" style="max-width:300px;">
        <div class="quick-access">
            <h3>Hızlı Erişim</h3>
            <ul>
                <li><a href="#personal-info"><i class="fas fa-user"></i> Kişisel Bilgiler</a></li>
                <li><a href="#contact-info"><i class="fas fa-envelope"></i> İletişim Bilgileri</a></li>
                
                <li><a href="#work-experience"><i class="fas fa-graduation-cap"></i> Eğitim Bilgileri</a></li>
                
                <li><a href="#health-info"><i class="fas fa-certificate"></i> Sertifika Bilgileri</a></li>
                <li><a href="#health-info"><i class="fas fa-globe"></i> Dil Bilgisi</a></li>
                <li><a href="#work-experience"><i class="fas fa-briefcase"></i> İş Deneyimi</a></li>
                <li><a href="#health-info"><i class="fas fa-heartbeat"></i> Sağlık Bilgileri</a></li>
                <li><a href="#health-info"><i class="fas fa-user-shield"></i> Acil Durum</a></li>
            </ul>
        </div>
    </div>


    <div class="col" >

     
<div class="resume-container">
        <header class="resume-header">
            <div class="resume-profile-header">
                <img src="<?=base_url("uploads/".$data_kullanici->kullanici_resim)?>" alt="[Ad Soyad]" class="resume-profile-img">
                <div class="resume-profile-info">
                    <h1><?=$data_kullanici->kullanici_ad_soyad?></h1>
                    <p class="resume-job-title">Pozisyon: <?=$data_kullanici->kullanici_unvan?></p> 
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
.quick-access {
    background: #fff;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    position: sticky;
    top: 20px;
}
.quick-access h3 {
    font-size: 1.2em;
    margin-bottom: 10px;
    text-align: center;
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
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.resume-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
}

.resume-profile-header {
    display: flex;
    align-items: center;
}

.resume-profile-img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    margin-right: 20px;
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
    width: 20%;
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