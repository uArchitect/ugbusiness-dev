 
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
            <h2><i class="fa fa-envelope text-primary"></i> Menü Parametreleri</h2>
            <span style="margin-top: -12px !important; display: block; margin-bottom: 19px;">Kullanıcı profilinde görüntülenecek olan menü başlıklarını bu bölümden özelleştirebilirsiniz.</span>
            
            <form action="<?=base_url("kullanici/menu_gorunum_parametrelerini_guncelle/$data_kullanici->kullanici_id")?>" method="POST">
            <table style="    border: 1px solid #dbdbdb;">
          
            <tr>
                    <th style="<?=$data_kullanici->ozluk_menu_gorunum == 0 ? "background:#fcc5c5" : ""?>">Özlük Menü Görünüm</th>
                    <td>
                        <select name="ozluk_menu_gorunum" class="select2 form-control">
                            <option value="0" <?=$data_kullanici->ozluk_menu_gorunum == 0 ? "selected" : ""?>>GİZLE</option>
                            <option value="1" <?=$data_kullanici->ozluk_menu_gorunum == 1 ? "selected" : ""?>>GÖSTER</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th style="<?=$data_kullanici->arac_menu_gorunum == 0 ? "background:#fcc5c5" : ""?>">Araç Menü Görünüm</th>
                    <td>
                        <select name="arac_menu_gorunum" class="select2 form-control">
                            <option value="0" <?=$data_kullanici->arac_menu_gorunum == 0 ? "selected" : ""?>>GİZLE</option>
                            <option value="1" <?=$data_kullanici->arac_menu_gorunum == 1 ? "selected" : ""?>>GÖSTER</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th style="<?=$data_kullanici->satis_menu_gorunum == 0 ? "background:#fcc5c5" : ""?>">Satış Menü Görünüm</th>
                    <td>
                        <select name="satis_menu_gorunum" class="select2 form-control">
                            <option value="0" <?=$data_kullanici->satis_menu_gorunum == 0 ? "selected" : ""?>>GİZLE</option>
                            <option value="1" <?=$data_kullanici->satis_menu_gorunum == 1 ? "selected" : ""?>>GÖSTER</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th style="<?=$data_kullanici->egitim_menu_gorunum == 0 ? "background:#fcc5c5" : ""?>">Eğitim Menü Görünüm</th>
                    <td>
                        <select name="egitim_menu_gorunum" class="select2 form-control">
                            <option value="0" <?=$data_kullanici->egitim_menu_gorunum == 0 ? "selected" : ""?>>GİZLE</option>
                            <option value="1" <?=$data_kullanici->egitim_menu_gorunum == 1 ? "selected" : ""?>>GÖSTER</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th style="<?=$data_kullanici->talep_menu_gorunum == 0 ? "background:#fcc5c5" : ""?>">Talep Menü Görünüm</th>
                    <td>
                        <select name="talep_menu_gorunum" class="select2 form-control">
                            <option value="0" <?=$data_kullanici->talep_menu_gorunum == 0 ? "selected" : ""?>>GİZLE</option>
                            <option value="1" <?=$data_kullanici->talep_menu_gorunum == 1 ? "selected" : ""?>>GÖSTER</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th style="<?=$data_kullanici->mesai_menu_gorunum == 0 ? "background:#fcc5c5" : ""?>">Mesai Menü Görünüm</th>
                    <td>
                        <select name="mesai_menu_gorunum" class="select2 form-control">
                            <option value="0" <?=$data_kullanici->mesai_menu_gorunum == 0 ? "selected" : ""?>>GİZLE</option>
                            <option value="1" <?=$data_kullanici->mesai_menu_gorunum == 1 ? "selected" : ""?>>GÖSTER</option>
                        </select>
                    </td>
                </tr>   <tr>
                    <th style="<?=$data_kullanici->envanter_menu_gorunum == 0 ? "background:#fcc5c5" : ""?>">Envanter Menü Görünüm</th>
                    <td>
                        <select name="envanter_menu_gorunum" class="select2 form-control">
                            <option value="0" <?=$data_kullanici->envanter_menu_gorunum == 0 ? "selected" : ""?>>GİZLE</option>
                            <option value="1" <?=$data_kullanici->envanter_menu_gorunum == 1 ? "selected" : ""?>>GÖSTER</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th style="<?=$data_kullanici->iletisim_menu_gorunum == 0 ? "background:#fcc5c5" : ""?>">İletişim Menü Görünüm</th>
                    <td>
                        <select name="iletisim_menu_gorunum" class="select2 form-control">
                            <option value="0" <?=$data_kullanici->iletisim_menu_gorunum == 0 ? "selected" : ""?>>GİZLE</option>
                            <option value="1" <?=$data_kullanici->iletisim_menu_gorunum == 1 ? "selected" : ""?>>GÖSTER</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th> </th>
                    <td><button type="submit" class="btn btn-success"><i class="fa fa-save"></i>  Değişiklikleri Kaydet</button>
                     </td>
                </tr>
              
            </table></form>
        </section></div>