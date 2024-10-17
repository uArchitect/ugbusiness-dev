<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper p-1 mobil-genislik" style="padding-top:0px; margin-left:250px;">
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
