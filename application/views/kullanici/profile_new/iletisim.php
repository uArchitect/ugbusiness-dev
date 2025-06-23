 
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
            <form class="form-horizontal" method="POST" action="<?php echo site_url('kullanici/profil_kullanici_sms_save2/'.$kullanici_data->kullanici_id);?>">
 
    <div class="card-body">

    

      <div class="form-group">
        <label for="formClient-Name"> İletişim Numarası</label>
        <input type="text" readonly value="<?=str_replace(" ","",$kullanici_data->kullanici_bireysel_iletisim_no)?>" class="form-control" name="iletisim_numarasi" required="" autofocus="">
        
      </div>

      <div class="form-group">
        <label for="formClient-Name"> SMS Başlık</label>
        <input type="text" readonly  value="UGTEKNOLOJI" class="form-control" required="" autofocus="">
        
      </div>

      <div class="form-group">
        <label for="formClient-Code"> Mesajınız</label>
        <textarea type="text" class="form-control" name="sms_detay" placeholder="Mesajınızı Giriniz..." autofocus=""></textarea>
       
      </div>
  
      
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <div class="row">
     
        <div class="col text-right"><button type="submit" class="btn btn-flat btn-primary"> Kaydet</button></div>
      </div>
    </div>
    <!-- /.card-footer-->

    </form>




    <div class="card card-warning">
  <div class="card-header">
    Son Gönderilen Smsler (Kullanıcı Bazlı)
  </div>
  <div class="card-body">
    <?php 
    foreach ($son_gonderilen_smsler as $sms) {
      ?>
      <div style="background: #f1f1f1; margin: 0; padding: 11px;margin-bottom:5px;">
        <span><b>Gönderici :</b></span> <?=$sms->kullanici_ad_soyad?><br>
        <span><b>Gönderim Tarihi :</b></span> <?=date("d.m.Y H:i",strtotime($sms->gonderim_tarihi))?><br>
        <span><b>Mesaj :</b></span> <?=$sms->gonderilen_sms_detay?>
      </div>
      <?php
    }
    ?>
  </div>
</div>
        </section></div>