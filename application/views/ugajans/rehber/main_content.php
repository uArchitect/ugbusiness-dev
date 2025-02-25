<div style="background: linear-gradient(135deg, #1e1e2f, #252542);">  
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
    <section class="menu-section" style="    margin-top: 5px;">
    
      <div class="menu mt-2">
         
        <?php 
        
        foreach ($ug_kullanicilar as $ug_kul) {
          ?>
          <div class="menu-item"> 
         
                    <p>
                    <img src="<?=base_url("uploads/".($ug_kul->kullanici_resim != "" ? $ug_kul->kullanici_resim : "1710857334737.jpg"))?>" style="object-fit:cover;max-width:150px;max-height:150px;min-width:150px;min-height:150px;border: 5px solid #272829c7;outline: 5px solid #393c3721;" alt="user-avatar" class="img-circle img-fluid">
                    <br>
          <b style="    font-size: 24px;"><?=$ug_kul->kullanici_ad_soyad?></b>  
          
          <br>
          <?=$ug_kul->kullanici_unvan?></p>

          </div>
          <?php
        }
        
        ?>

       
        
      </div> 
    </section>

      
    </section>
  </div>
</div>
