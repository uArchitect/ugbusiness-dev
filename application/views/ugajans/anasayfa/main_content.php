
<div class="content-wrapper">  



<style>
    /* Tüm stil tanımlamaları yalnızca .my-app kapsayıcısı altında uygulanır */
    .my-app {
      font-family: Arial, sans-serif;
      margin: 20px;
      color: #333;
    }
    
    .my-app h2 {
      border-bottom: 2px solid #ddd;
      padding-bottom: 5px;
      margin-bottom: 20px;
    }
    
    /* Yemek listesi stilleri */
    .my-app .menu {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
    }
    
    .my-app .menu-item {
      background-color: #f9f9f9;
      border: 1px solid #eee;
      border-radius: 8px;
      width: calc(33.333% - 20px);
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
      padding: 15px;
      box-sizing: border-box;
    }
    
    .my-app .menu-item:hover {
      transform: translateY(-5px);
    }
    
    .my-app .menu-item img {
      max-width: 100%;
      border-radius: 5px;
      margin-bottom: 10px;
    }
    
    .my-app .menu-item h3 {
      margin: 0 0 10px;
      font-size: 1.2em;
    }
    
    .my-app .menu-item p {
      font-size: 0.95em;
      line-height: 1.5;
    }
    
    /* Yapılacak işler bölümü stilleri */
    .my-app .todo {
      margin-top: 40px;
    }
    
    .my-app .todo ul {
      list-style: none;
      padding: 0;
    }
    
    .my-app .todo li {
      background-color: #f0f0f0;
      margin-bottom: 10px;
      padding: 10px 15px;
      border-radius: 5px;
      display: flex;
      align-items: center;
    }
    
    .my-app .todo li::before {
      content: "✔";
      color: green;
      margin-right: 10px;
    }
  </style>

<div class="my-app">
    <section class="menu-section">
      <h2>Yemek Listesi</h2>
      <div class="menu">
        <div class="menu-item">
          <img src="https://via.placeholder.com/300x200" alt="Yemek 1">
          <h3>Yemek 1</h3>
          <p>Lezzetli bir başlangıç için ideal.</p>
        </div>
        <div class="menu-item">
          <img src="https://via.placeholder.com/300x200" alt="Yemek 2">
          <h3>Yemek 2</h3>
          <p>Özel tarifimizle hazırlanmış nefis bir yemek.</p>
        </div>
        <div class="menu-item">
          <img src="https://via.placeholder.com/300x200" alt="Yemek 3">
          <h3>Yemek 3</h3>
          <p>Farklı tatlar denemek isteyenlere önerimiz.</p>
        </div>
      </div>
    </section>
    
    <section class="todo">
      <h2>Yapılacak İşler</h2>
      <ul>
        <li>Malzemeleri temin et</li>
        <li>Tarifi uygula</li>
        <li>Sunumu hazırla</li>
        <li>Tadım yap</li>
      </ul>
    </section>
  </div>

</div>