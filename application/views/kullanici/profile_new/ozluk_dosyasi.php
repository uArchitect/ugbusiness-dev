<button id="printButton" style="display:none;" onclick="printResume()">Yazdır</button>

<script>
    function printResume() {
        // Yazdırma işleminden önce sadece özgeçmiş sayfasını al
        var content = document.querySelector('.resume-container').innerHTML;

        // Yeni bir pencere aç ve içerik yazdırma için yerleştir
        var printWindow = window.open('', '', 'height=600, width=800');
        printWindow.document.write('<html><head><title>Özgeçmiş Yazdır</title>');
        printWindow.document.write('<style>body {font-family: Arial, sans-serif; margin: 20px;} .resume-container {width: 100%; margin: 0 auto;}</style>'); // Yazdırma için özel stil
        printWindow.document.write('</head><body>');
        printWindow.document.write(content); // Özgeçmiş içeriğini ekle
        printWindow.document.write('</body></html>');
        
        // Yazdırma işlemi başlat
        printWindow.document.close();
        printWindow.print();
    }
</script>
<div class="resume-container">
        <header class="resume-header">
            <div class="resume-profile-header">
                <img src="<?=base_url("uploads/".$data_kullanici->kullanici_resim)?>" alt="[Ad Soyad]" class="resume-profile-img">
                <div class="resume-profile-info">
                    <h1><?=$data_kullanici->kullanici_ad_soyad?></h1>
                    <p class="resume-job-title">Pozisyon: <?=$data_kullanici->kullanici_unvan?></p>
                    <p class="resume-email">E-posta: <?=$data_kullanici->kullanici_email_adresi?></p>
                    <p class="resume-phone">Telefon: <?=$data_kullanici->kullanici_bireysel_iletisim_no?></p>
                </div>
            </div>
        </header>

        <section class="resume-personal-info">
            <h2>Kişisel Bilgiler</h2>
            <table>
                <tr>
                    <th>Doğum Tarihi</th>
                    <td><?=date("d.m.Y",strtotime($data_kullanici->kullanici_dogum_tarihi))?></td>
                </tr>
                <tr>
                    <th>Medeni Durum</th>
                    <td><?=$data_kullanici->kullanici_medeni_durum == 0 ? "BİLİNMİYOR" : ($data_kullanici->kullanici_medeni_durum == 1 ? "EVLİ" : "BEKAR")?></td>
                </tr>
                <tr>
                    <th>Adres</th>
                    <td><?=$data_kullanici->kullanici_adres?></td>
                </tr>
                <tr>
                    <th>Uyruk</th>
                    <td><?=$data_kullanici->kullanici_uyruk?></td>
                </tr>
                <tr>
                    <th>Askerlik Durumu</th>
                    <td><?=$data_kullanici->kullanici_askerlik_durum?></td>
                </tr>
            </table>
        </section>

        <section class="resume-contact-info">
            <h2>İletişim Bilgileri</h2>
            <table>
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
                <tr>
                    <th>Web Sitesi</th>
                    <td><a href="[Web Sitesi URL]" target="_blank">Kişisel Web Sitesi</a></td>
                </tr>
            </table>
        </section>

        <section class="resume-work-experience">
            <h2>İş Deneyimi</h2>
            <div class="resume-job">
                <h3>UG TEKNOLOJİ / UMEX - <?=$data_kullanici->kullanici_unvan?></h3>
                <p class="resume-duration">[Başlangıç Tarihi : <?=date("d.m.Y",strtotime($data_kullanici->kullanici_ise_giris_tarihi))?>] - [<?=$data_kullanici->kullanici_aktif ? "Devam Ediyor" : "İşten Ayrıldı"?>]</p>
                <p>[İş Tanımı ve Başarılar]</p>
            </div>
        </section>

        <section class="resume-education">
            <h2>Eğitim</h2>
            <div class="resume-degree">
                <h3>[Okul Adı] - [Bölüm]</h3>
                <p class="resume-duration">[Başlangıç Tarihi] - [Bitiş Tarihi]</p>
                <p>[Başarılar veya Mezuniyet Detayları]</p>
            </div>
        </section>

         
    </div>



    <style>
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
    width: 120px;
    height: 120px;
    border-radius: 50%;
    margin-right: 20px;
}

.resume-profile-info h1 {
    font-size: 1.8em;
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
    width: 30%;
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