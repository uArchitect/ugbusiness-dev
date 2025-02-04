 


<?php 

echo json_encode($gecis_data);

?>


<!-- Content Wrapper. Contains page content -->
<div class="content" style="padding-top:8px">
  <section class="content text-md">
    <div class="card card-dark">
      <div class="card-header">
        <h3 class="card-title"><strong>UG Business</strong> - Kullanıcı Profil</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
      <style>
        
        .month-row {
            display: flex;
            align-items: center;
            margin-bottom: 1px;
        }
        .month-label {
          border:1px solid #d6d6d6;
          padding-top:10px; 
    height: 48.5px;
            font-size: 18px;
            min-width: 175px; /* Ay ismi için sabit genişlik */
            margin-right: 1px; /* Ay ismi ile gün kutuları arasında boşluk */
            text-align: center; /* Ay ismi sağa hizalanır */
            background: #181818;
            color: white;
        }
        .days-container {
            display: flex;
            width: 100%;
        }
        .day-box {
            flex:1; /* Her kutunun genişliği, toplam 31 kutuya bölünecek şekilde ayarlanır */
            padding-top: calc(100% / 31); /* Kutunun kare olmasını sağlamak için aynı oran kullanılır */
            background-color: #ececec;
            border:1px solid #d6d6d6;
            margin-right: 1px;
            color:#828282 ;
            font-size:15px;
            display: flex;
            font-weight:medium;
            align-items: center;
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
        { name: 'Ocak 2024', days: 31 },
        { name: 'Şubat 2024', days: 28 }, // Artık yıl kontrolü aşağıda yapılacak
        { name: 'Mart 2024', days: 31 },
        { name: 'Nisan 2024', days: 30 },
        { name: 'Mayıs 2024', days: 31 },
        { name: 'Haziran 2024', days: 30 },
        { name: 'Temmuz 2024', days: 31 },
        { name: 'Ağustos 2024', days: 31 },
        { name: 'Eylül 2024', days: 30 },
        { name: 'Ekim 2024', days: 31 },
        { name: 'Kasım 2024', days: 30 },
        { name: 'Aralık 2024', days: 31 }
    ];

    const currentYear = new Date().getFullYear();
    if ((currentYear % 4 === 0 && currentYear % 100 !== 0) || (currentYear % 400 === 0)) {
        months[1].days = 29; // Şubat için artık yıl kontrolü
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
            
            const dayLabel = document.createElement('span');
            dayLabel.textContent = day;
            dayBox.appendChild(dayLabel);
            




            
            daysContainer.appendChild(dayBox);
        }
        for (let day = 1; day <= 31-month.days; day++) {
            const dayBox = document.createElement('div');
            dayBox.className = 'day-box';
            dayBox.style.opacity = '0.7';
            
            const dayLabel = document.createElement('span');
          
            dayBox.appendChild(dayLabel);
            
            daysContainer.appendChild(dayBox);
        }
        
        monthRow.appendChild(daysContainer);
        monthsContainer.appendChild(monthRow);
    });





    document.querySelectorAll('.day-box').forEach(box => {
  box.addEventListener('mouseover', function(event) {
    let popup = document.createElement('div');
    popup.className = 'popup';
    popup.innerHTML = `<span style="width: 100%; display: block; border-radius: 3px 3px 0 0; color: white; background: #505050;padding: 5px;"> ${this.textContent}.08.2024</span><div style="margin-left:5px;margin-right:5px;margin-top:5px;margin-bottom:5px;"><b>  <span class="successdot"></span> Giriş Okutma =</b> 09:25<br><b>  <span class="dangerdot"></span> Çıkış Okutma =</b> 19:14</div>`;
    
    document.body.appendChild(popup);

    let rect = this.getBoundingClientRect();
    popup.style.left = rect.left + window.scrollX + (rect.width / 2) - (popup.offsetWidth / 2) + 'px';
    popup.style.top = rect.top + window.scrollY - popup.offsetHeight - 10 + 'px';

    popup.style.display = 'block';

    
this.addEventListener('mousemove', function(event) {
  let leftPos = Math.max(event.pageX + 10, 0);
  let topPos = Math.max(event.pageY - popup.offsetHeight - 10, 0);

  if (leftPos + popup.offsetWidth > window.innerWidth) {
    leftPos = window.innerWidth - popup.offsetWidth - 10;
  }

  if (topPos + popup.offsetHeight > window.innerHeight) {
    topPos = window.innerHeight - popup.offsetHeight - 10;
  }

  popup.style.left = leftPos + 'px';
  popup.style.top = topPos + 'px';
});

    this.addEventListener('mouseout', function() {
      popup.remove();
    });
  });
});


</script>



      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </section>
</div>