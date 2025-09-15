 

 

<!-- Content Wrapper. Contains page content -->
<div class="content" style="padding-top:8px">
  <section class="content text-md">
    <div class="card card-dark" style="margin-bottom:0px">
      <div class="card-header">
        <h3 class="card-title"><strong>UG Business</strong> - Kullanıcı Profil</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body" style="    padding-bottom: 20px;">

      <div class="ccontainer">
        <section>
            <div class="header">
                <h2>Şirket Giriş Çıkış Takibi</h2>
                <p>Aşağıdaki kutular çalışanların giriş çıkış bilgilerini göstermektedir. Geç giriş ve erken çıkış için referans aralığı [#] dakikadır. Bu aralığı değiştirmek için <a href="">tıklayınız.</a></p>
            </div>
            <div class="legend">
                <div class="legend-item"><div class="color-box green"></div> Tam zamanında giriş ve çıkış yapıldı</div>
                <div class="legend-item"><div class="color-box red"></div> Giriş veya çıkış yapılmadı</div>
                <div class="legend-item"><div class="color-box orange"></div> Geç geldi veya erken çıktı</div>
                <div class="legend-item"><div class="color-box black"></div> İzinli</div> 
            </div>
        </section>
    </div>


      <style>
   .ccontainer {
           
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            margin-bottom : 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }
        .header {
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
        .legend {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }
        .legend-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .color-box {
            width: 24px;
            height: 24px;
            border-radius: 4px;
        }
        .green { background-color: green; }
        .red { background-color: red; }
        .orange { background-color: orange; }
        .black { background-color: black; }
        .exclamation {
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: gray;
            color: white;
            font-weight: bold;
            border-radius: 4px;
        }
         .mesai-item {
            padding: 10px;
            margin: 5px;
            border: 1px solid #ccc;
        }
        .yesil-arka {
            background-color: green;
            color: white;
        }
        .month-row {
            display: flex;
            align-items: center;
            margin-bottom: 1px;
        }
        .month-label {
          border:1px solid #d6d6d6;
          padding-top:5px; 
    height: 35px;
            font-size: 15px;
            min-width: 175px; /* Ay ismi için sabit genişlik */
            margin-right: 1px; /* Ay ismi ile gün kutuları arasında boşluk */
            text-align: center; /* Ay ismi sağa hizalanır */
            background: #181818;
            color: white;
            border-radius: 4px;
        }
        .days-container {
            display: flex;
            width: 100%;
        }
        .day-box {
            flex:1; /* Her kutunun genişliği, toplam 31 kutuya bölünecek şekilde ayarlanır */
            padding-top: calc(100% / 31); /* Kutunun kare olmasını sağlamak için aynı oran kullanılır */
            background-color:rgb(255, 255, 255);
            border:1px solid #d6d6d6;
            margin-right: 1px;
            color:#828282 ;
            font-size:13px;
            display: flex;
            font-weight:medium;
            align-items: center;
            border-radius:5px;
            justify-content: center;
             cursor:pointer;
            box-sizing: border-box; /* Kenarlık ve dolgu kutu boyutuna dahil edilir */
            position: relative;
        }
        .day-box:hover {
             background-color: #0060c7;
             color:white;
            
        }


        
        .day-box span {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        
        .dangerdot {
  height: 10px;
  width: 10px;
  background-color: red;
  border-radius: 50%;
  display: inline-block;
}
.successdot {
  height: 10px;
  width: 10px;margin-left:-2px;
  background-color: green;
  border-radius: 50%;
  display: inline-block;
}
        .popup {
  display: none;
  position: absolute;
  background-color: #333;
  color: #fff;
  text-align: center;
  border-radius: 5px;
  padding: 5px;
  z-index: 1000;
  font-size: 14px;
  white-space: nowrap;border: 2px solid #7d7d7d;
}

.popup::after {
  content: '';
  position: absolute;
  bottom: -5px;
  left: 50%;
  transform: translateX(-50%);
  border-width: 5px;
  border-style: solid;
  border-color: #333 transparent transparent transparent;
}

    </style>
        <div id="months-container"></div>

     <script>
const months = [
    { year: "012025", name: 'Ocak 2025', days: 31 },
    { year: "022025", name: 'Şubat 2025', days: 28 },
    { year: "032025", name: 'Mart 2025', days: 31 },
    { year: "042025", name: 'Nisan 2025', days: 30 },
    { year: "052025", name: 'Mayıs 2025', days: 31 },
    { year: "062025", name: 'Haziran 2025', days: 30 },
    { year: "072025", name: 'Temmuz 2025', days: 31 },
    { year: "082025", name: 'Ağustos 2025', days: 31 },
    { year: "092025", name: 'Eylül 2025', days: 30 },
    { year: "102025", name: 'Ekim 2025', days: 31 },
    { year: "112025", name: 'Kasım 2025', days: 30 },
    { year: "122025", name: 'Aralık 2025', days: 31 }
];

const currentYear = new Date().getFullYear();
if ((currentYear % 4 === 0 && currentYear % 100 !== 0) || (currentYear % 400 === 0)) {
    months[1].days = 29;
}

const monthsContainer = document.getElementById('months-container');

months.forEach(month => {
    const monthRow = document.createElement('div');
    monthRow.className = 'month-row';
    
    const monthLabel = document.createElement('span');
    monthLabel.className = 'month-label';
    monthLabel.textContent = month.name;
    monthRow.appendChild(monthLabel);
    
    const daysContainer = document.createElement('div');
    daysContainer.className = 'days-container';
    
    for (let day = 1; day <= month.days; day++) {
        const dayBox = document.createElement('div');
        dayBox.className = 'day-box';
        dayBox.id = (day < 10 ? "0" : "") + day + "" + month.year;
        const dayLabel = document.createElement('span');
        dayLabel.textContent = day;
        dayBox.appendChild(dayLabel);
        
        daysContainer.appendChild(dayBox);
    }
    
    for (let day = 1; day <= 31 - month.days; day++) {
        const dayBox = document.createElement('div');
        dayBox.className = 'day-box empty-day';
        dayBox.style.opacity = '0.7';
        daysContainer.appendChild(dayBox);
    }
    
    monthRow.appendChild(daysContainer);
    monthsContainer.appendChild(monthRow);
});

// JSON verisini parse et
const mesaiData = <?php echo $gecis_data; ?>;

// Veriyi daha kolay erişilebilir bir Map yapısına dönüştür
const mesaiMap = new Map();
mesaiData.forEach(item => {
    // Tarih formatını 'YYYY-MM-DD'den 'DDMMYYYY'e dönüştür
    const [year, month, day] = item.tarih.split('-');
    const formattedDate = `${day}${month}${year}`;
    mesaiMap.set(formattedDate, {
        giris_saati: item.giris_saati,
        cikis_saati: item.cikis_saati
    });
});

// Takvimi renklendir ve popup bilgilerini ekle
document.querySelectorAll('.day-box:not(.empty-day)').forEach(box => {
    const boxId = box.id;
    if (mesaiMap.has(boxId)) {
        const data = mesaiMap.get(boxId);
        
        // Renklendirme mantığı (örnek)
        const girisSaati = data.giris_saati;
        const cikisSaati = data.cikis_saati;
        
        // Varsayılan mesai saatleri
        const isBaslangic = "09:00";
        const isBitis = "18:00";
        const tolerans = 15 * 60 * 1000; // 15 dakika tolerans
        
        const girisZaman = new Date(`2025-01-01T${girisSaati}`);
        const cikisZaman = new Date(`2025-01-01T${cikisSaati}`);
        const idealGirisZaman = new Date(`2025-01-01T${isBaslangic}`);
        const idealCikisZaman = new Date(`2025-01-01T${isBitis}`);

        const girisGecikme = girisZaman.getTime() - idealGirisZaman.getTime();
        const cikisGecikme = idealCikisZaman.getTime() - cikisZaman.getTime();

        if (girisGecikme <= tolerans && cikisGecikme <= tolerans) {
            box.style.backgroundColor = "green";
        } else {
            box.style.backgroundColor = "orange";
        }
        
        box.style.color = "white";

        // Popup verisi
        const popupContent = `<span style="width: 100%; display: block; border-radius: 3px 3px 0 0; color: white; background: #505050;padding: 5px;">${box.textContent.padStart(2, '0')}.${boxId.substring(2, 4)}.${boxId.substring(4, 8)}</span>
                              <div style="margin-left:5px;margin-right:5px;margin-top:5px;margin-bottom:5px;">
                                <b><span class="successdot"></span> Giriş Okutma =</b> ${girisSaati} <br>
                                <b><span class="dangerdot"></span> Çıkış Okutma =</b> ${cikisSaati}
                              </div>`;

        let popup = document.createElement('div');
        popup.className = 'popup';
        popup.innerHTML = popupContent;
        
        box.addEventListener('mouseenter', (event) => {
            document.body.appendChild(popup);
            updatePopupPosition(event, popup);
        });

        box.addEventListener('mouseleave', () => {
            if (popup.parentNode) {
                popup.remove();
            }
        });

        box.addEventListener('mousemove', (event) => {
            updatePopupPosition(event, popup);
        });
    }
});

function updatePopupPosition(event, popup) {
    let leftPos = event.pageX + 10;
    let topPos = event.pageY - popup.offsetHeight - 10;
    
    if (leftPos + popup.offsetWidth > window.innerWidth) {
        leftPos = window.innerWidth - popup.offsetWidth - 10;
    }
    
    if (topPos < 0) {
        topPos = event.pageY + 10;
        popup.style.top = topPos + 'px';
        // Ok yönünü değiştirme
        popup.style.bottom = 'auto';
        popup.style.top = topPos + 'px';
        popup.classList.add('top-arrow');
    } else {
        popup.classList.remove('top-arrow');
        popup.style.top = topPos + 'px';
        popup.style.bottom = 'auto';
    }

    popup.style.left = leftPos + 'px';
}

// Popup'ın ok yönünü değiştirmek için yeni bir CSS kuralı
const styleSheet = document.styleSheets[0];
styleSheet.insertRule(`
    .popup.top-arrow::after {
        content: '';
        position: absolute;
        top: -5px;
        left: 50%;
        transform: translateX(-50%) rotate(180deg);
        border-width: 5px;
        border-style: solid;
        border-color: #333 transparent transparent transparent;
    }
`, 0);

// Eski kuralı gizleme
styleSheet.insertRule(`
    .popup.top-arrow::after {
        transform: translateX(-50%) rotate(180deg);
        top: -5px;
        bottom: auto;
    }
`, 0);
</script>



      </div>


      <div class="card-footer">
        Bu bilgiler kullanıcıya tanımlanmış olan mesai başlama ve bitiş saatleri baz alınarak hesaplanmaktadır.
      </div>

      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </section>
</div>