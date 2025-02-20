<div style="background: linear-gradient(135deg, #1e1e2f, #252542);">  
  <style>

    body{
      background: linear-gradient(135deg, #1e1e2f, #252542);
    }
    /* Genel Stil */
    .my-app {
      font-family: 'Poppins', sans-serif;
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
      <h2>Yeni Görev Tanımla</h2>
      <span style="
    margin-top: -16px;
    display: block;
    margin-bottom: 10px;
    opacity: 0.6;
">Yeni görev tanımlamak için tüm alanları doldurunuz. Yeni eklenen görev otomatik olarak beklemede listesine alınacaktır.   </span>


<form action="<?=base_url("ugajans/gorev_ekle")?>" method="post">
<section class="menu-section" style="    margin-top: 5px;">
    
    <div class="menu">
      <div class="menu-item"> 
        <h3>   Yeni Görev Ekleme Formu</h3>
        <p style="text-align:left;">
        <span style="opacity:0.8!important;"><b> <i class="fas fa-arrow-circle-right text-warning"></i> Görev Tanımlanacak Kullanıcı</b> </span> <br>
 
       <select required name="gorev_atanan_kullanici" class="form-control" id="" style="
    background: #24243c;
    border: 1px solid #0060c7;
    color: #dddddd;
    margin-top: 7px;
">
<option value="">Kullanıcı Seçiniz</option>
<?php 
foreach ($gorev_kullanicilari as $gorev_kullanici) {
 ?>
   <option value="<?=$gorev_kullanici->kullanici_id?>"><?=$gorev_kullanici->kullanici_ad_soyad?></option>
 <?php
}
?> 
</select><br>
  <span style="opacity:0.8!important;"><b> <i class="fas fa-arrow-circle-right text-warning"></i> Görev Detayları</b> </span> <br>
  <textarea required name="gorev_detaylari" class="form-control" placeholder="Bu bölüme görevle ilgili detayları girebilirsiniz.." id="" style="
    background: #24243c;
    border: 1px solid #0060c7;
    margin-top: 5px;
"></textarea>
   

  </p>

        
 <div class="d-flex">
 <button type="submit" class="btn mobile-nav-btn btn-logout d-block d-lg-none" style="border: 1px solid #3a3a7f;border-left: 0px;border-top: 0;flex:1;background:rgb(1, 144, 30)" >
    <i class="fas fa-save"></i> Bilgileri Kaydet
</button>
 
 </div>
      </div>
      
    </div>
  </section>
  </form>

 



    </section>
  </div>
</div>
