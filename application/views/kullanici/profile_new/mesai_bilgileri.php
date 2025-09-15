 

 

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
        { year: "202501", name: 'Ocak 2025', days: 31 },
        { year: "202502", name: 'Şubat 2025', days: 28 },
        { year: "202503", name: 'Mart 2025', days: 31 },
        { year: "202504", name: 'Nisan 2025', days: 30 },
        { year: "202505", name: 'Mayıs 2025', days: 31 },
        { year: "202506", name: 'Haziran 2025', days: 30 },
        { year: "202507", name: 'Temmuz 2025', days: 31 },
        { year: "202508", name: 'Ağustos 2025', days: 31 },
        { year: "202509", name: 'Eylül 2025', days: 30 },
        { year: "202510", name: 'Ekim 2025', days: 31 },
        { year: "202511", name: 'Kasım 2025', days: 30 },
        { year: "202512", name: 'Aralık 2025', days: 31 }
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
            dayBox.id = month.year + (day < 10 ? "0" : "") + day;
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

    const mesaiData = <?php echo $gecis_data; ?>;
    const mesaiMap = new Map();

    mesaiData.forEach(item => {
        const [year, month, day] = item.tarih.split('-');
        const formattedDate = `${year}${month}${day}`;
        mesaiMap.set(formattedDate, {
            giris_saati: item.giris_saati,
            cikis_saati: item.cikis_saati
        });
    });

    const idealGirisSaati = "09:00";
    const idealCikisSaati = "18:00";
    // 15 dakika tolerans
    const toleransMiliseconds = 15 * 60 * 1000;

    document.querySelectorAll('.day-box:not(.empty-day)').forEach(box => {
        const boxId = box.id;
        if (mesaiMap.has(boxId)) {
            const data = mesaiMap.get(boxId);
            const girisSaati = data.giris_saati;
            const cikisSaati = data.cikis_saati;

            // Tarih ve saat nesnelerini oluştur
            const girisZaman = new Date(`2025-01-01T${girisSaati}`);
            const cikisZaman = new Date(`2025-01-01T${cikisSaati}`);
            const idealGirisZaman = new Date(`2025-01-01T${idealGirisSaati}`);
            const idealCikisZaman = new Date(`2025-01-01T${idealCikisSaati}`);

            // Giriş ve çıkış saatlerinin ideal saatlere göre farkı
            const girisFarki = girisZaman.getTime() - idealGirisZaman.getTime();
            const cikisFarki = idealCikisZaman.getTime() - cikisZaman.getTime();

            // Renklendirme mantığı
            if (girisSaati === cikisSaati) {
                // Giriş ve çıkış saati aynıysa (tek okutma varsa)
                box.style.backgroundColor = "red";
                box.style.color = "white";
            } else if (girisFarki > toleransMiliseconds || cikisFarki > toleransMiliseconds) {
                // Giriş veya çıkışta toleransı aşan bir gecikme/erken çıkış varsa
                box.style.backgroundColor = "orange";
                box.style.color = "white";
            } else {
                // Her iki durumda da tolerans dahilindeyse
                box.style.backgroundColor = "green";
                box.style.color = "white";
            }

            // Popup verisini dinamik olarak oluştur
            let girisMetni = `<b><span class="successdot"></span> Giriş Okutma =</b> ${girisSaati}`;
            let cikisMetni = `<b><span class="dangerdot"></span> Çıkış Okutma =</b> ${cikisSaati}`;
            if (girisSaati === cikisSaati) {
                cikisMetni = `<b><span class="dangerdot"></span> Çıkış Okutma =</b> Yapılmadı`;
            }

            const popupContent = `<span style="display:none;width: 100%; display: block; border-radius: 3px 3px 0 0; color: white; background: #505050;padding: 5px;">${box.textContent.padStart(2, '0')}.${boxId.substring(6, 8)}.${boxId.substring(0, 4)}</span>
                                  <div style="margin-left:5px;margin-right:5px;margin-top:5px;margin-bottom:5px;">
                                    ${girisMetni}<br>${cikisMetni}
                                  </div>`;

            let popup = document.createElement('div');
            popup.className = 'popup';
            popup.innerHTML = popupContent;

            let isHovering = false;
            let popupVisible = false;

            box.addEventListener('mouseenter', () => {
                if (!popupVisible) {
                    isHovering = true;
                    document.body.appendChild(popup);
                    popupVisible = true;
                }
            });

            box.addEventListener('mousemove', (event) => {
                if (isHovering) {
                    updatePopupPosition(event, popup);
                }
            });

            box.addEventListener('mouseleave', () => {
                isHovering = false;
                if (popup.parentNode) {
                    popup.remove();
                    popupVisible = false;
                }
            });
        }
    });

    function updatePopupPosition(event, popup) {
        let rect = event.currentTarget.getBoundingClientRect();
        let leftPos = rect.left + window.scrollX + (rect.width / 2) - (popup.offsetWidth / 2);
        let topPos = rect.top + window.scrollY - popup.offsetHeight - 10;

        if (leftPos + popup.offsetWidth > window.innerWidth) {
            leftPos = window.innerWidth - popup.offsetWidth - 10;
        }
        if (leftPos < 0) {
            leftPos = 10;
        }

        if (topPos < 0) {
            topPos = rect.top + window.scrollY + rect.height + 10;
        }

        popup.style.left = leftPos + 'px';
        popup.style.top = topPos + 'px';
        popup.style.display = 'block';
    }
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