<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mesai Takip Kartları</title>
   <meta http-equiv="refresh" content="10">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    html, body {
      height: 100%;
      margin: 0;
      overflow: hidden;
      background: #000000ff;
    }
    #board {
      position: relative;
      width: 100%;
      height: 100%;
    }
    .card {
      position: absolute;
      padding: 8px;
      height:86px;
       font-size:13px;
      border-radius: 8px;
      cursor: move;
      user-select: none;
      max-width: 149px; min-width: 149px;
      text-align: center;
      font-weight: bold;
      transition: transform 0.2s ease;
    }
    .card:hover {
      transform: scale(1.05);
    }
    .text-card {
      background: #facc15;
      color: #000;
    }
  </style>
</head>
<body>
    <div style="background: #080808;border: 1px solid gray;height: 144px;z-index:  0;width: 974px;position: absolute;display: inline-grid;top: 46px;left: 20px;border-radius: 12px;"></div>
 <div style=" background: #080808; border: 1px solid gray; height: 144px; z-index: 0; width: 812px; position: absolute; display: inline-grid ; top: 46px; left: 1004px; border-radius: 12px;"></div>
 <div style=" background: #080808; border: 1px solid gray; height: 944px; z-index: 0; width: 812px; position: absolute; display: inline-grid ; top: 198px; left: 1004px; border-radius: 12px;"></div>
   <div style="background: #080808;border: 1px solid gray;height: 343px;z-index:  0;width: 974px;position: absolute;display: inline-grid;top: 198px;left: 20px;border-radius: 12px;"></div>
 <div style="background: #080808;border: 1px solid gray;height: 153px;z-index:  0;width: 509px;position: absolute;display: inline-grid;top: 550px;left: 20px;border-radius: 12px;"></div>
 <div style="background: #080808;border: 1px solid gray;height: 153px;z-index:  0;width: 457px;position: absolute;display: inline-grid;top: 550px;left: 538px;border-radius: 12px;"></div>
 <div style="background: #080808;border: 1px solid gray;height: 153px;z-index:  0;width: 509px;position: absolute;display: inline-grid;top: 715px;left: 20px;border-radius: 12px;"></div>
 <div style="background: #080808;border: 1px solid gray;height: 153px;z-index:  0;width: 457px;position: absolute;display: inline-grid;top: 715px;left: 538px;border-radius: 12px;"></div>
 
  <h1 class="text-center text-white text-xl py-2 font-bold">
    <?= date("d.m.Y") ?> Mesai Takip
  </h1>
 
  <div id="board">

   <?php 
  foreach ($materyaller as $m) {
    ?>

    

      <h1 style="max-width: 189px!important; min-width: 189px!important;position:absolute;left:<?= $m->mesai_takip_x?>px;top:<?= $m->mesai_takip_y?>px" data-id="<?=$m->mesai_takip_element_id ?>" class="card text-center text-white text-xl py-2 font-bold">
    <?= $m->mesai_takip_element_content?>
  </h1>
    <?php
  }
  ?>

  </div>

  <script>
    const board = document.getElementById("board");

    // sürükleme
    function makeDraggable(el) {
      let offsetX, offsetY;

      el.addEventListener("mousedown", (e) => {
        offsetX = e.clientX - el.offsetLeft;
        offsetY = e.clientY - el.offsetTop;

        function mouseMoveHandler(e) {
  let newLeft = e.clientX - offsetX;
  let newTop = e.clientY - offsetY;

  // diğer kartları dolaş
  document.querySelectorAll("#board .card").forEach(other => {
    if (other !== el) {
      let oLeft = parseInt(other.style.left) || 0;
      let oTop = parseInt(other.style.top) || 0;

      // X hizalama kontrolü
      if (Math.abs(newLeft - oLeft) < 10) {
        newLeft = oLeft; // hizaya oturt
      }
      // Y hizalama kontrolü
      if (Math.abs(newTop - oTop) < 10) {
        newTop = oTop;
      }
    }
  });

  el.style.left = newLeft + "px";
  el.style.top = newTop + "px";
}


        function mouseUpHandler() {
          document.removeEventListener("mousemove", mouseMoveHandler);
          document.removeEventListener("mouseup", mouseUpHandler);
         
            if(el.dataset.id == 9000 || el.dataset.id == 9001 || el.dataset.id == 9002 || el.dataset.id == 9003 || el.dataset.id == 9004 || el.dataset.id == 9005 || el.dataset.id == 9006 || el.dataset.id == 9007 || el.dataset.id == 9008 || el.dataset.id == 9009 || el.dataset.id == 9010    ){
                savePosition2(el.dataset.id, el.style.left, el.style.top);
            }else{
                savePosition(el.dataset.id, el.style.left, el.style.top);
            }
          // Pozisyon kaydet
          
        }

        document.addEventListener("mousemove", mouseMoveHandler);
        document.addEventListener("mouseup", mouseUpHandler);
      });
    }

    function calculateDelayMinutes(startTime, endTime) {
      if (!endTime || !startTime) return 0;
      const [sh, sm] = startTime.split(':').map(Number);
      const [eh, em] = endTime.split(':').map(Number);
      return (eh * 60 + em) - (sh * 60 + sm);
    }

    // Backend'den gelen veriler
    const usersData = <?= json_encode($data) ?>;
 
    usersData.forEach(user => {
      const mesaiSaati = user.mesai_baslangic_saati ? user.mesai_baslangic_saati.substring(0, 5) : '09:00';
      const hasCheckedIn = user.mesai_takip_okutma_tarihi !== null;
      let cardClass = '', extraContent = '';

      if (hasCheckedIn) {
        const checkIn = user.mesai_takip_okutma_tarihi.substring(11, 16);
        const delay = calculateDelayMinutes(mesaiSaati, checkIn);

if (user.servis_var_mi == 1) {

  cardClass = 'bg-gradient-to-br from-blue-600 from-blue-700 text-white';
           extraContent = `<p class="text-sm font-semibold">SERVİSTE</p>`;
}
else{

if (user.kurulum_var_mi == 1) {

  cardClass = 'bg-gradient-to-br from-blue-600 from-blue-600 text-white';
           extraContent = `<p class="text-sm font-semibold">KURULUMDA</p>`;
}
else{
        if (user.egitim_var_mi == 1) {
          cardClass = 'bg-gradient-to-br from-blue-400 to-green-600 text-white';
           extraContent = `<p class="text-sm font-semibold">EĞİTİMDE</p>`;
        } else {
          if (delay > 0) {
            cardClass = 'bg-gradient-to-br from-orange-400 to-orange-600 text-white';
            extraContent = `<p class="text-sm font-semibold">${delay} DK GEÇ KALDI</p>`;
          } else {
            cardClass = 'bg-gradient-to-br from-green-400 to-green-600 text-white';
          }
        }
      }

    }




      } else {
        cardClass = 'bg-gradient-to-br from-red-500 to-red-700 text-white';
      }

      const card = document.createElement("div");
      card.className = `card ${cardClass}`;
      card.dataset.id =  user.kullanici_id;
      card.innerHTML = `
        <h2 class="font-bold tracking-wide">${user.kullanici_ad_soyad.toUpperCase()}</h2>
        <p class="mt-1 font-medium">${ hasCheckedIn ? user.mesai_takip_okutma_tarihi.substring(11, 16) : '' }</p>
        ${extraContent}
      `; 
      // daha önceki pozisyon (veritabanında kaydedilmişse)
      card.style.left = user.mesai_pos_x ? user.mesai_pos_x + "px" : "50px";
      card.style.top = user.mesai_pos_y ? user.mesai_pos_y + "px" : "50px";

      board.appendChild(card);
      makeDraggable(card);
    });
document.querySelectorAll("#board .card").forEach(el => {
  makeDraggable(el);
});
    

    // AJAX ile kaydet
    function savePosition(id, left, top) {
      fetch("<?=base_url("api/save_position")?>", {
        method: "POST",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify({
          id: id,
          x: parseInt(left),
          y: parseInt(top)
        })
      }); 
    }

     function savePosition2(id, left, top) {
       
      fetch("<?=base_url("api/save_position2")?>", {
        method: "POST",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify({
          id: id,
          x: parseInt(left),
          y: parseInt(top)
        })
      }); 
    }
  </script>
</body>
</html>
