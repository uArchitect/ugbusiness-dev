<div class="content-wrapper">  
  <style>
    /* Tüm stil tanımlamaları yalnızca .my-app kapsayıcısı altında uygulanır */
    .my-app {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 20px;
      color: #444;
      background: #f5f7fa;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }
    
    .my-app h2 {
      position: relative;
      font-size: 1.8em;
      margin-bottom: 25px;
      padding-bottom: 10px;
      color: #333;
    }
    
    .my-app h2::after {
      content: "";
      position: absolute;
      bottom: 0;
      left: 0;
      width: 60px;
      height: 4px;
      background: linear-gradient(45deg, #ff6b6b, #f06595);
      border-radius: 2px;
    }
    
    /* Yemek listesi stilleri */
    .my-app .menu {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 20px;
      margin-bottom: 40px;
    }
    
    .my-app .menu-item {
      background-color: #fff;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      display: flex;
      flex-direction: column;
    }
    
    .my-app .menu-item:hover {
      transform: translateY(-8px);
      box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
    
    .my-app .menu-item img {
      width: 100%;
      height: auto;
      display: block;
    }
    
    .my-app .menu-item .item-content {
      padding: 20px;
    }
    
    .my-app .menu-item .item-content h3 {
      margin-top: 0;
      font-size: 1.4em;
      color: #222;
    }
    
    .my-app .menu-item .item-content p {
      font-size: 0.95em;
      line-height: 1.6;
      color: #666;
    }
    
    /* Yapılacak işler bölümü stilleri */
    .my-app .todo {
      background: #fff;
      padding: 20px 25px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    
    .my-app .todo ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }
    
    .my-app .todo li {
      padding: 15px 10px;
      border-bottom: 1px solid #eee;
      display: flex;
      align-items: center;
      transition: background 0.3s ease;
    }
    
    .my-app .todo li:last-child {
      border-bottom: none;
    }
    
    .my-app .todo li:hover {
      background: #f9f9f9;
    }
    
    .my-app .todo li::before {
      content: "✔";
      color: #28a745;
      margin-right: 15px;
      font-weight: bold;
    }
  </style>

  <div class="my-app">
    <section class="menu-section">
      <h2>Yemek Listesi</h2>
      <div class="menu">
        <div class="menu-item">
          <img src="https://via.placeholder.com/400x250" alt="Yemek 1">
          <div class="item-content">
            <h3>Yemek 1</h3>
            <p>Lezzetli bir başlangıç için özenle hazırlanmış tarif.</p>
          </div>
        </div>
        <div class="menu-item">
          <img src="https://via.placeholder.com/400x250" alt="Yemek 2">
          <div class="item-content">
            <h3>Yemek 2</h3>
            <p>Özel soslarımızla tatlandırılmış nefis bir yemek deneyimi.</p>
          </div>
        </div>
        <div class="menu-item">
          <img src="https://via.placeholder.com/400x250" alt="Yemek 3">
          <div class="item-content">
            <h3>Yemek 3</h3>
            <p>Farklı tatların bir araya geldiği, özgün sunumuyla dikkat çeken lezzet.</p>
          </div>
        </div>
      </div>
    </section>
    
    <section class="todo">
      <h2>Yapılacak İşler</h2>
      <ul>
        <li>Malzemeleri temin et</li>
        <li>Tarifi uygula</li>
        <li>Sunumu hazırla</li>
        <li>Tadım yap ve not al</li>
      </ul>
    </section>
  </div>
</div>
