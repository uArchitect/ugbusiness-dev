<div class="content-wrapper" style="background: linear-gradient(135deg, #1e1e2f, #252542);">  
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
      margin-top: 40px;
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
    <section class="menu-section" style="    margin-top: 5px;">
    
      <div class="menu">
        <div class="menu-item"> 
          <h3>Öğle Yemek Menüsü</h3>
          <p>Kremalı ve pa srmesan sos  uyla eşsiz bir İtalyan lezzeti.</p>
        </div>
        
      </div> 
    </section>

    <section class="todo">
      <h2>Görev Bilgileri</h2>
      <span>Sizin tanımladığınız veya size tanımlanmış yeni görev bilgilerini bu bölümde listelenmiştir. Filtreme seçeneklerini kullanarak diğer görevleri görüntüleyebilirsiniz. </span>
      <section class="menu-section" style="    margin-top: 5px;">
    
    <div class="menu">
      <div class="menu-item"> 
        <h3> <svg aria-label="currently running: " width="17px" height="17px" fill="none" viewBox="0 0 16 16" class="anim-rotate"  xmlns="http://www.w3.org/2000/svg"> <path fill="none" stroke="#DBAB0A" stroke-width="2" d="M3.05 3.05a7 7 0 1 1 9.9 9.9 7 7 0 0 1-9.9-9.9Z" opacity=".5"></path> <path fill="#eda705" fill-rule="evenodd" d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Z" clip-rule="evenodd"></path> <path fill="#eda705" d="M14 8a6 6 0 0 0-6-6V0a8 8 0 0 1 8 8h-2Z"></path> </svg> Bekleyen Görev ( Gamze Oranbaş )</h3>
        <p style="text-align:left;">
        <span style="opacity:0.4!important;padding-left:">
        <i class="fa fa-info-circle"></i> Bu görev 20.02.2025 14:34 (1 saat önce) tarihinde Gamze Oranbaş tarafından oluşturulmuştur.
  </span><br> <br>
  <span style="opacity:0.8!important;"><b> <i class="fas fa-arrow-circle-right text-warning"></i> Görev Detayları</b> </span> <br>
  <span style="opacity:0.8!important;">  Bu görev 20.02.2025 14:34 (1 saat önce) tarihinde Gamze Oranbaş tarafından oluşturulmuştur. </span>
  <br>  <br>
  <span style="opacity:0.8!important;"><span style="    color: #07ed07;"> <i class="fa fa-check"></i> Tamamlama Notu</span> </span>
  <br>
  <textarea name="" class="form-control" placeholder="Bu bölüme görevle ilgili tamamlama notunuzu girebilirsiniz.." id="" style="
    background: #24243c;
    border: 1px solid #0060c7;
    margin-top: 5px;
"></textarea> 
<br>
<span style="opacity:0.8!important;"><span style="color: #fefffe;"> <i class="fa fa-question-circle"></i> Görev Durumu</span> </span>
  <br>

  <select name="" class="form-control" id="" style="
    background: #24243c;
    border: 1px solid #0060c7;
    color: #dddddd;
    margin-top: 7px;
">
  <option value="">BEKLEMEDE</option>
  <option value="">İŞLEME ALINDI</option>
  <option value="">TAMAMLANDI</option>
  <option value="">İPTAL EDİLDİ</option>
</select>

  </p>

        
 <div class="d-flex">
 <a class="btn mobile-nav-btn btn-logout d-block d-lg-none" style="border: 1px solid #3a3a7f;border-left: 0px;border-top: 0;flex:1;background:#0060c7" href="https://ugbusiness.com.tr/logout">
    <i class="fas fa-save"></i> Değişiklikleri Kaydet
</a>
 
 </div>
      </div>
      
    </div>
  </section>


<br>

  <section class="menu-section" style="    margin-top: 5px;">
    
    <div class="menu">
      <div class="menu-item" > 
        <h3> <svg aria-label="currently running: " width="17px" height="17px" fill="none" viewBox="0 0 16 16" class="anim-rotate"  xmlns="http://www.w3.org/2000/svg"> <path fill="none" stroke="#DBAB0A" stroke-width="2" d="M3.05 3.05a7 7 0 1 1 9.9 9.9 7 7 0 0 1-9.9-9.9Z" opacity=".5"></path> <path fill="#eda705" fill-rule="evenodd" d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Z" clip-rule="evenodd"></path> <path fill="#eda705" d="M14 8a6 6 0 0 0-6-6V0a8 8 0 0 1 8 8h-2Z"></path> </svg> Bekleyen Görev ( Gamze Oranbaş )</h3>
        <p style="text-align:left;">
        <span style="opacity:0.4!important;padding-left:">
          <i class="fa fa-info-circle"></i> Bu görev 20.02.2025 14:34 (1 saat önce) tarihinde Gamze Oranbaş tarafından oluşturulmuştur.
  </span><br> <br>
  <span style="opacity:0.8!important;"><b><i class="fas fa-arrow-circle-right text-warning"></i> Görev Detayları</b> </span> <br>
  <span style="opacity:0.8!important;">  Bu görev 20.02.2025 14:34 (1 saat önce) tarihinde Gamze Oranbaş tarafından oluşturulmuştur. </span>
  <br>  <br>
  <span style="opacity:0.8!important;"><span style="    color: #07ed07;"> <i class="fa fa-check"></i> Tamamlama Notu</span> </span>
  <br>
  <textarea name="" class="form-control" placeholder="Bu bölüme görevle ilgili tamamlama notunuzu girebilirsiniz.." id="" style="
    background: #24243c;
    border: 1px solid #0060c7;
    margin-top: 5px;
"></textarea> 
<br>
<span style="opacity:0.8!important;"><span style="color: #fefffe;"> <i class="fa fa-question-circle"></i> Görev Durumu</span> </span>
  <br>

  <select name="" class="form-control" id="" style="
    background: #24243c;
    border: 1px solid #0060c7;
    color: #dddddd;
    margin-top: 7px;
">
  <option value="">BEKLEMEDE</option>
  <option value="">İŞLEME ALINDI</option>
  <option value="">TAMAMLANDI</option>
  <option value="">İPTAL EDİLDİ</option>
</select>



  </p>

        
 <div class="d-flex">
 <a class="btn mobile-nav-btn btn-logout d-block d-lg-none" style="border: 1px solid #3a3a7f;border-left: 0px;border-top: 0;flex:1;background:#0060c7" href="https://ugbusiness.com.tr/logout">
    <i class="fas fa-save"></i> Değişiklikleri Kaydet
</a>
 
 </div>
      </div>
      
    </div>
  </section>





    </section>
  </div>
</div>
