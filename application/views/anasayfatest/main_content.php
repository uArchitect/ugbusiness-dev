<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper p-1 mobil-genislik" style="padding-top:0px; margin-left:250px;">






<div style="position: relative; width: 100%; height: 0; padding-top: 50.0000%;
 padding-bottom: 0; box-shadow: 0 2px 8px 0 rgba(63,69,81,0.16);  margin-bottom: 0.9em; overflow: hidden;
 border-radius: 8px; will-change: transform;">
  <iframe loading="lazy" style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; border: none; padding: 0;margin: 0;"
    src="https://www.canva.com/design/DAGT7hcPHQc/tL9MP00uO79UoQqzpAqasw/view?embed" allowfullscreen="allowfullscreen" allow="fullscreen">
  </iframe>
</div> 








  <div class="grid-container">
    <!-- 13 sütun ve 19 satır için butonlar -->
    <div class="grid">
      <!-- Toplam 247 buton (13 x 19) -->
      <!-- Butonları oluşturmak için döngü kullanın -->
      <script>
        for (let i = 0; i < 19; i++) {
          for (let j = 0; j < 13; j++) {
          
            if(i == 0 && j == 6){
              document.write('<button class="grid-button">UĞUR ÖLMEZ</button>');
            }else if(i == 2 && j == 6){
              document.write('<button class="grid-button">İBRAHİM BİRCAN</button>');
            }
            
            else{
              document.write('<button class="grid-button">&nbsp;</button>');
            }
          }
        }
      </script>
    </div>
  </div>
</div>

<style>
  .grid-container {
    display: flex;
    justify-content: center;
    align-items: center;
    
  }

  .grid {
    display: grid;
    grid-template-columns: repeat(13, 1fr); /* 13 sütun */
    grid-template-rows: repeat(19, 1fr);   /* 19 satır */
    gap: 1px; /* Butonlar arası boşluk */
    width: 100%;
    height: 100%;
  }

  .grid-button {
    width: 100%;
    height: 100%;
    padding: 10px 3px 10px 3px;
    background-color: #ffffff;
    border: 0px solid whitesmoke;
    cursor: pointer;
    transition: background-color 0.3s;
  }

  .grid-button:hover {
    background-color: #f0f0f0; /* Hover rengi */
  }
</style>
