<div class="content-wrapper">  
  <style>
    /* Genel Stil */
    .my-app {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #1e1e2f, #252542);
      color: #fff;
      padding: 20px; 
      box-shadow: 0 10px 30px rgba(0,0,0,0.3);
      max-width: 1200px;
      margin: auto;
    }

    .my-app h2 {
      font-size: 2em;
      margin-bottom: 20px;
      text-transform: uppercase;
      letter-spacing: 1.5px;
      position: relative;
    }

    .my-app h2::after {
      content: "";
      width: 80px;
      height: 4px;
      background: linear-gradient(90deg, #ff416c, #ff4b2b);
      display: block;
      margin-top: 5px;
      border-radius: 2px;
    }

    /* Yemek Listesi */
    .menu {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 25px;
    }

    .menu-item {
      background: rgba(255, 255, 255, 0.1);
      border-radius: 12px;
      overflow: hidden;
      backdrop-filter: blur(8px);
      padding: 20px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.2);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
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
      font-size: 1.5em;
      margin-bottom: 10px;
      color: #ff416c;
    }

    .menu-item p {
      font-size: 1em;
      opacity: 0.8;
    }

    /* Yapılacak İşler */
    .todo {
      margin-top: 40px;
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
  </style>

  <div class="my-app">
    <section class="menu-section">
    
      <div class="menu">
        <div class="menu-item"> 
          <h3>Öğle Yemek Menüsü</h3>
          <p>Kremalı ve parmesan sosuyla eşsiz bir İtalyan lezzeti.</p>
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
