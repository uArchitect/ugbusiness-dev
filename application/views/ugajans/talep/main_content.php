<div  style="background: linear-gradient(135deg, #1e1e2f, #252542);">  
  <style>

    body{
      background: linear-gradient(135deg, #1e1e2f, #252542);
    }
    /* Genel Stil */
    .my-app { 
       color: #fff;
      padding: 5px;  
      box-shadow: 0 10px 30px rgba(0,0,0,0.3);
      max-width: 1200px;
      margin: auto;
    }

    .my-app h2 {
      font-size: 1.5em;
      margin-bottom: 20px;
      text-transform: uppercase; 
      position: relative;
    }

   

    /* Yemek Listesi */
    .menu {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 25px;
    }

    .menu-item {
      background: #161628;
    border-radius: 2px;
    overflow: hidden;
    backdrop-filter: blur(8px);
    /* padding: 20px; */
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: 1px solid #0060c7;
    }

    .menu-item:hover {
      transform: translateY(-10px);
      box-shadow: 0 10px 25px rgba(0,0,0,0.3);
    }

    .menu-item img {
      width: 100%;
      border-radius: 10px;
      margin-bottom: 15px;
      transition: transform 0.3s ease;
    }

    .menu-item:hover img {
      transform: scale(1.05);
    }

    .menu-item h3 {
      font-size: 17px;
    margin-bottom: 10px;
    color: #f8f8f8;
    background: #24243c;
    padding: 9px;
    text-align: center;
    }

    .menu-item p {
      font-size: 1em;
      
    padding: 10px;
    text-align: center;
    }

    /* Yapılacak İşler */
    .todo {
      margin-top: 10px;
      padding: 10px;
    }

    .todo ul {
      list-style: none;
      padding: 0;
    }

    .todo li {
      background: rgba(255, 255, 255, 0.15);
      padding: 15px;
      border-radius: 8px;
      margin-bottom: 10px;
      display: flex;
      align-items: center;
      font-size: 1.1em;
      transition: background 0.3s ease;
    }

    .todo li:hover {
      background: rgba(255, 255, 255, 0.3);
    }

    .todo li::before {
      content: "✔";
      color: #32cd32;
      font-weight: bold;
      margin-right: 12px;
    }

    .anim-rotate{
      animation: rotate 1s linear infinite;
    } @keyframes rotate {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }
  </style>

  <div class="my-app">
     

    <section class="todo">
      <h2>Website Talep Bilgileri</h2>
      <span style="
    margin-top: -16px;
    display: block;
    margin-bottom: 10px;
    opacity: 0.6;
">Ugajans.com websitesinden gelen yeni müşteri talep bilgileri bu bölümde listelenmiştir. Filtreme seçeneklerini kullanarak diğer talepleri görüntüleyebilirsiniz.   </span>


      
<div class="d-flex" style="margin-bottom: 10px;">
 <a class="btn mobile-nav-btn btn-logout d-block " style="border: 1px solid #3a3a7f;border-left: 0px;border-top: 0;flex:1;background:<?=($_GET["talep_filter"] && $_GET["talep_filter"] == 1 ? "#0060c7" : "#252547")?>" href="https://ugbusiness.com.tr/ugajans/talep?talep_filter=1">
     Beklemede (<?=$beklemede_talep_count?>)  
</a>
<a class="btn mobile-nav-btn btn-logout d-block " style="border: 1px solid #3a3a7f;border-left: 0px;border-top: 0;flex:1;background:<?=($_GET["talep_filter"] && $_GET["talep_filter"] == 2 ? "#0060c7" : "#252547")?>" href="https://ugbusiness.com.tr/ugajans/talep?talep_filter=2">
     İşlemde (<?=$islemde_talep_count?>)   
</a>
<a class="btn mobile-nav-btn btn-logout d-block " style="border: 1px solid #3a3a7f;border-left: 0px;border-top: 0;flex:1;background:<?=($_GET["talep_filter"] && $_GET["talep_filter"] == 3 ? "#0060c7" : "#252547")?>" href="https://ugbusiness.com.tr/ugajans/talep?talep_filter=3">
     Dönüş Yapılacak (<?=$donus_talep_count?>)   
</a>
<a class="btn mobile-nav-btn btn-logout d-block" style="border: 1px solid #3a3a7f;border-left: 0px;border-top: 0;flex:1;background:<?=($_GET["talep_filter"] && $_GET["talep_filter"] == 4 ? "#0060c7" : "#252547")?>" href="https://ugbusiness.com.tr/ugajans/talep?talep_filter=4">
    Olumlu / Satış (<?=$olumlu_talep_count?>)   
</a> 
<a class="btn mobile-nav-btn btn-logout d-block" style="border: 1px solid #3a3a7f;border-left: 0px;border-top: 0;flex:1;background:<?=($_GET["talep_filter"] && $_GET["talep_filter"] == 5 ? "#0060c7" : "#252547")?>" href="https://ugbusiness.com.tr/ugajans/talep?talep_filter=5">
    Olumsuz (<?=$olumsuz_talep_count?>)   
</a> 
<a class="btn mobile-nav-btn btn-logout d-block" style="border: 1px solid #3a3a7f;border-left: 0px;border-top: 0;flex:1;background:<?=($_GET["talep_filter"] && $_GET["talep_filter"] == 6 ? "#0060c7" : "#252547")?>" href="https://ugbusiness.com.tr/ugajans/talep?talep_filter=6">
    İptal (<?=$iptal_talep_count?>)   
</a> 
 </div>

     

 
<?php 
foreach ($talepler as $talep) :
?>
 

<form action="<?=base_url("ugajans/talep_durum_guncelle/$talep->ugajans_talep_id")?>" method="post">

      <section class="menu-section" style="    margin-top: 5px;">
      <?php
        $durum = "";
        $bgcolor = "#191935";
        $brcolor = "#0060c7";
        if($talep->ugajans_talep_durum == 1){
          $durum = "Bekleyen";
         
        }
        if($talep->ugajans_talep_durum == 2){
          $durum = "İşleme Alınan";
          $bgcolor = "#1461c3";
          $brcolor = "#1461c3";
        }
        if($talep->ugajans_talep_durum == 3){
          $durum = "Dönüş Yapılacak"; 
          $bgcolor = "#a95600";
          $brcolor = "#a95600";
        }
        if($talep->ugajans_talep_durum == 4){
          $durum = "Olumlu / Satış";
          $bgcolor = "#4a851a";
          $brcolor = "#4a851a";
        }
        if($talep->ugajans_talep_durum == 5){
          $durum = "Olumsuz";
          $bgcolor = "#a60808";
          $brcolor = "#a60808";
        }
        if($talep->ugajans_talep_durum == 6){
          $durum = "İptal";
          $bgcolor = "#a60808";
          $brcolor = "#a60808";
        }
        ?>
    <div class="menu">
      <div class="menu-item p-2" style="<?=$talep->ugajans_talep_durum == 6 ? "" :""?>border:1px solid <?=$brcolor?>"> 
        <h3 style="background:<?=$bgcolor?>; "> <svg style="<?=$talep->ugajans_talep_durum > 1 ? "display:none" : ""?>" aria-label="currently running: " width="17px" height="17px" fill="none" viewBox="0 0 16 16" class="anim-rotate"  xmlns="http://www.w3.org/2000/svg"> <path fill="none" stroke="#DBAB0A" stroke-width="2" d="M3.05 3.05a7 7 0 1 1 9.9 9.9 7 7 0 0 1-9.9-9.9Z" opacity=".5"></path> <path fill="#eda705" fill-rule="evenodd" d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Z" clip-rule="evenodd"></path> <path fill="#eda705" d="M14 8a6 6 0 0 0-6-6V0a8 8 0 0 1 8 8h-2Z"></path> </svg> 
        
        
        
        <?=$talep->ugajans_hizmet_adi?> Talebi (<?=$durum?>)</h3>
        <p style="text-align:left;">
        <span style="opacity:0.4!important;padding-left:">
        <i class="fa fa-info-circle"></i> Bu talep <?=date("d.m.Y H:i",strtotime($talep->ugajans_talep_kayit_tarihi))?> tarihinde ugajans.com websitesi üzerinden oluşturulmuştur.
  </span><br> <br> 




  <div class="d-flex" style="margin-bottom: -8px!important;">
 <a class="btn mobile-nav-btn btn-logout d-block " style="background: #24243c; border: 1px solid #0060c7;border-left: 1px;flex:1; " href="https://ugbusiness.com.tr/ugajans/talep?talep_filter=1">
 <span style="opacity:0.8!important;"><b> <i class="fas fa-user text-warning"></i> Ad Soyad : </b> <?=$talep->ugajans_talep_ad_soyad?> </span>
</a>
<a class="btn mobile-nav-btn btn-logout d-block " style="background: #24243c; border: 1px solid #0060c7;border-left: 0px;flex:1;  " href="https://ugbusiness.com.tr/ugajans/talep?talep_filter=2">
<span style="opacity:0.8!important;"><b> <i class="fas fa-phone text-warning"></i> İletişim Numarası : </b> <?=$talep->ugajans_talep_iletisim_numarasi?> </span> 
</a>
<a class="btn mobile-nav-btn btn-logout d-block " style="background: #24243c; border: 1px solid #0060c7;border-left: 0px;flex:1; " href="https://ugbusiness.com.tr/ugajans/talep?talep_filter=3">
<span style="opacity:0.8!important;"><b> <i class="fas fa-envelope text-warning"></i> Email : </b> <?=$talep->ugajans_talep_email_adres?> </span>
</a>
<a class="btn mobile-nav-btn btn-logout d-block" style="background: #24243c; border: 1px solid #0060c7;border-left: 0px;flex:1; " href="https://ugbusiness.com.tr/ugajans/talep?talep_filter=4">
<span style="opacity:0.8!important;"><b> <i class="fas fa-info-circle text-warning"></i> Detay : </b> <?=$talep->ugajans_talep_detay?> </span>
</a>  
 </div>
 
  <br>  <br>
  <span style="opacity:0.8!important;"><span style="    color: #07ed07;"> <i class="fa fa-check"></i> Talep Sonlandırma Notu</span> </span>
  <br>
  <textarea name="ugajans_talep_sonlandirma_notu" class="form-control" placeholder="Bu bölüme talep ile ilgili sonlandırma veya görüşme notunuzu girebilirsiniz.." id="" style="
    background: #24243c; color:white;
    border: 1px solid #0060c7;
    margin-top: 5px;
"><?=$talep->ugajans_talep_sonlandirma_notu?></textarea> 
<br>
<span style="opacity:0.8!important;"><span style="color: #fefffe;"> <i class="fa fa-question-circle"></i> Talep Durumu</span> </span>
  <br>

  <select name="ugajans_talep_durum" class="form-control" id="" style="
    background: #24243c;
    border: 1px solid #0060c7;
    color: #dddddd;
    margin-top: 7px;
">
  <option <?=($talep->ugajans_talep_durum == 1 ? "selected" : "")?> value="1">BEKLEMEDE</option>
  <option <?=($talep->ugajans_talep_durum == 2 ? "selected" : "")?> value="2">İŞLEME ALINDI</option>
  <option <?=($talep->ugajans_talep_durum == 3 ? "selected" : "")?> value="3">DÖNÜŞ YAPILACAK</option>
  <option <?=($talep->ugajans_talep_durum == 4 ? "selected" : "")?> value="4">OLUMLU / SATIŞ</option>
  <option <?=($talep->ugajans_talep_durum == 5 ? "selected" : "")?> value="5">OLUMSUZ </option>
  
  <option <?=($talep->ugajans_talep_durum == 6 ? "selected" : "")?> value="6"> İPTAL </option>
</select>

  </p>

        
 <div class="d-flex">
 <button type="submit" class="btn mobile-nav-btn btn-logout d-block" style="border: 1px solid #3a3a7f;border-left: 0px;border-top: 0;flex:1;background:rgb(17, 139, 3)"  >
    <i class="fas fa-save"></i> Değişiklikleri Kaydet
</button>
<a class="btn mobile-nav-btn btn-logout d-block"    onclick="return confirm('Bu talebi silmek istediğinizden emin misiniz?');" style="border: 1px solid #3a3a7f;border-left: 0px;border-top: 0;flex:0.5;background:rgb(166, 8, 8)" href="https://ugbusiness.com.tr/ugajans/talep_sil/<?=$talep->ugajans_talep_id ?>">
    <i class="fas fa-times"></i> Talebi Sil
</a>
 </div>
      </div>
      
    </div>
  </section>
  </form>

  <br>

  <?php 
endforeach;
?>




 



    </section>
  </div>
</div>
