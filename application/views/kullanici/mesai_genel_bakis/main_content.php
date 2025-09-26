<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kare Grid</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    html, body {
      margin: 0;
      padding: 0;
      height: 100%;
      width: 100%;
      overflow: hidden; /* kaydırma olmasın */
    }
    .card-container {
      display: grid;
      height: 100vh;
      width: 100vw;
    }
    .card {
      aspect-ratio: 1 / 1; /* kare */
      display: flex;
      justify-content: center;
      align-items: center;
      border: 1px solid #737f955c;
      border-radius: 5px;
      margin: 2px;
    }
  </style>
</head>
<body class="bg-gradient-to-br from-gray-800 to-gray-900">
  <h1 class="text-2xl font-extrabold text-center my-3 text-white tracking-tight">
    <?=date("d.m.Y")?> Mesai Takip
  </h1>
  <div class="card-container" id="card-container"></div>

  <script>
    const users = <?=json_encode($data)?>;
    const container = document.getElementById('card-container');

    function renderCards() {
      container.innerHTML = "";

      const count = users.length;
      const cols = Math.ceil(Math.sqrt(count));   // sütun sayısı
      const rows = Math.ceil(count / cols);       // satır sayısı

      container.style.gridTemplateColumns = `repeat(${cols}, 1fr)`;
      container.style.gridTemplateRows = `repeat(${rows}, 1fr)`;

      users.forEach(user => {
        const hasCheckedIn = user.mesai_takip_okutma_tarihi !== null;
        const card = document.createElement("div");
        card.className = `card p-2 ${
          hasCheckedIn 
            ? 'bg-gradient-to-br from-green-400 to-green-600 text-white' 
            : 'bg-red-500 text-white'
        }`;
        card.innerHTML = `
          <h2 class="text-sm font-bold">${user.kullanici_ad_soyad.toUpperCase()}</h2>
          <p class="text-xs mt-1">${hasCheckedIn ? user.mesai_takip_okutma_tarihi : ''}</p>
        `;
        container.appendChild(card);
      });
    }

    document.addEventListener("DOMContentLoaded", renderCards);
  </script>
</body>
</html>
