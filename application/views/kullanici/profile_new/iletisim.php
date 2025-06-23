 
<div >
<style>
  
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
    padding: 15px;
    border-radius: 3px;
    color: #343a40;
    border: 2px dashed #e9e9e9;
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
    border: 2px solid #343a40;
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
    padding:25px;
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
 



        
<section  id="kisisel-bilgiler"  class="resume-personal-info">
            <h2><i class="fa fa-envelope text-primary"></i> SMS Gönder</h2>
            <span style="margin-top: -12px !important; display: block; margin-bottom: 19px;">NetGSM aboneliğiniz üzerinden tanımlı kullanıcının cep telefonuna UGTEKNOLOJI başlığı ile sms atabilirsiniz.</span>
            <form action="https://ugbusiness.com.tr/kullanici/profil_kullanici_sms_save/9" method="post"></form>
            <table style="    border: 1px solid #dbdbdb;">
            <tr>
                    <th>SMS Başlık</th>
                    <td>UGTEKNOLOJI</td>
                </tr>
            <tr>
                    <th>İletişim Numarası</th>
                    <td><input type="text" value="<?=str_replace(" ","",$data_kullanici->kullanici_bireysel_iletisim_no)?>" class="form-control"></td>
                </tr>
                <tr>
                    <th>Mesajınız</th>
                    <td><textarea class="form-control" rows="4"></textarea></td>
                </tr>
                <tr>
                    <th> </th>
                    <td><a href="" class="btn btn-success"><i class="fa fa-envelope"></i>  Mesajı Gönder</a><a href="" class="btn btn-warning ml-2"><i class="fa fa-eraser"></i>  Giriş Alanlarını Temizle</a></td>
                </tr>
              
            </table>
        </section></div>