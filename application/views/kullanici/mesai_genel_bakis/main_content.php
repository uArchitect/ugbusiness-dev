<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mesai Takip Kartları</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Sayfanın tamamını kaplaması ve kaydırmanın engellenmesi için temel stiller */
        html, body {
            height: 100%;
            margin: 0;
            overflow: hidden; /* Dikey ve yatay kaydırmayı tamamen engeller */
        }
        
        body {
            display: flex;
            flex-direction: column;
        }

        /* Başlık ve kart konteynerini tutan ana div'in dikeyde büyümesini sağlar */
        .main-container {
            display: flex;
            flex-direction: column;
            flex-grow: 1; /* Kalan tüm dikey boşluğu doldurur */
            min-height: 0; /* Flexbox'ın taşmasını engellemek için önemli */
        }

        .card-container {
            display: grid;
            gap: 4px; /* Kartlar arası boşluk için margin yerine gap kullanmak daha iyidir */
            flex-grow: 1; /* Kendisine ayrılan tüm alanı doldurur */
            padding: 4px;
        }

        .card {
            /* aspect-ratio artık grid tarafından yönetildiği için kaldırılabilir veya kalabilir */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            border:1px solid #737f955c;
            border-radius:5px;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            z-index: 10;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-800 to-gray-900">

    <div class="main-container mx-auto w-full">
        <h1 class="text-2xl font-extrabold text-center my-4 text-white tracking-tight flex-shrink-0">
            <?= date("d.m.Y") ?> Mesai Takip
        </h1>
        <div class="card-container" id="card-container"></div>
    </div>

    <script>
    // Bu değişkeni globalde tanımlayarak resize event'inde de kullanabiliriz
    let usersData = []; 
    const container = document.getElementById('card-container');

    /**
     * Ekran boyutuna ve kart sayısına göre en uygun grid yapısını hesaplar ve uygular.
     */
    function adjustGridLayout() {
        const numItems = usersData.length;
        if (numItems === 0) return;

        const containerWidth = container.clientWidth;
        const containerHeight = container.clientHeight;
        const aspectRatio = containerWidth / containerHeight;

        let bestCols = 1;
        let bestRows = numItems;
        let minDiff = Infinity;

        // Olası tüm sütun sayılarını deneyerek en iyi en-boy oranını buluruz
        for (let cols = 1; cols <= numItems; cols++) {
            const rows = Math.ceil(numItems / cols);
            const layoutRatio = (cols / rows);
            const diff = Math.abs(layoutRatio - aspectRatio);
            
            // Eğer bu düzen, ekran oranına daha yakınsa, bunu en iyi olarak kabul ederiz.
            if (diff < minDiff) {
                minDiff = diff;
                bestCols = cols;
                bestRows = rows;
            }
        }
        
        // Hesaplanan en iyi satır ve sütun sayısını grid'e uygularız
        container.style.gridTemplateColumns = `repeat(${bestCols}, 1fr)`;
        container.style.gridTemplateRows = `repeat(${bestRows}, 1fr)`;
    }

    /**
     * İki zaman (HH:MM) arasındaki farkı dakika cinsinden hesaplar.
     * @param {string} startTime 'HH:MM' formatında başlangıç zamanı (Mesai saati)
     * @param {string} endTime 'HH:MM' formatında bitiş zamanı (Okutma saati)
     * @returns {number} Farkın dakika cinsinden değeri. (endTime > startTime ise pozitif)
     */
    function calculateDelayMinutes(startTime, endTime) {
        if (!endTime || !startTime) return 0; // Eğer saat bilgisi yoksa fark 0

        const [startHour, startMinute] = startTime.split(':').map(Number);
        const [endHour, endMinute] = endTime.split(':').map(Number);

        // Her iki zamanı da gece yarısından itibaren toplam dakikaya çevir
        const totalStartMinutes = (startHour * 60) + startMinute;
        const totalEndMinutes = (endHour * 60) + endMinute;

        return totalEndMinutes - totalStartMinutes; // Farkı döndür
    }

    async function fetchData() {
        // PHP'den gelen veriyi global değişkene ata
        // NOT: PHP tarafında user nesnesi içinde 'mesai_baslangic_saati' alanının olduğundan emin olun.
        usersData = <?= json_encode($data) ?>;
        
        container.innerHTML = ''; // Konteyneri temizle

        usersData.forEach(user => {
            // Kullanıcının kendi mesai başlangıç saatini al
            const userMesaiSaati = user.mesai_baslangic_saati ? user.mesai_baslangic_saati.substring(0, 5) : '09:00'; // Sadece HH:MM kısmını al, yoksa varsayılan 09:00

            const hasCheckedIn = user.mesai_takip_okutma_tarihi !== null;
            let cardClass = '';
            let additionalContent = '';

            if (hasCheckedIn) {
                // Sadece saat:dakika kısmını al (örneğin: "2025-09-26 09:15:00" -> "09:15")
                const checkInTime = user.mesai_takip_okutma_tarihi.substring(11, 16);
                
                // Kullanıcının kendi mesai saati ile kart okutma saatini karşılaştır
                const delayMinutes = calculateDelayMinutes(userMesaiSaati, checkInTime);

                if (delayMinutes > 0) {
                    // **Geciktiyse (Pozitif fark)**
                    cardClass = 'bg-gradient-to-br from-orange-400 to-orange-600 text-white';
                    additionalContent = `<p class="text-sm font-semibold mt-1 text-white">${delayMinutes} DAKİKA GEÇ GELDİ</p>`;
                } else {
                    // **Zamanında veya Erken Geldiyse**
                    cardClass = 'bg-gradient-to-br from-green-400 to-green-600 text-white';
                }
            } else {
                // **Kart Okutmadıysa**
                cardClass = 'bg-gradient-to-br from-red-500 to-red-700 text-white';
            }


            const card = document.createElement('div');
            card.className = `card p-2 md:p-4 text-xs md:text-base cursor-pointer transition duration-300 ease-in-out transform hover:scale-[1.02] ${cardClass}`;
            card.innerHTML = `
                <h2 class="font-bold tracking-wide">${user.kullanici_ad_soyad.toUpperCase()}</h2>
                <p class="mt-1 font-medium">${
                    hasCheckedIn ? user.mesai_takip_okutma_tarihi.substring(0, 16) : '' // Yıl-Ay-Gün Saat:Dakika göster
                }</p>
                ${additionalContent}
            `;

            // Tıklama olay dinleyicisini ekleyin
            card.addEventListener('click', () => {
                // !!! BURADAKİ URL'Yİ KENDİ PROJENİZE GÖRE DÜZENLEYİNİZ !!!
                const urlToOpen = `https://ugbusiness.com.tr/kullanici/profil_new/${user.kullanici_id}?subpage=mesai-bilgileri`; 
                window.open(urlToOpen, '_blank');
            });

            container.appendChild(card);
        });

        // Veri yüklendikten sonra grid'i ayarla
        adjustGridLayout();
    }

    // Sayfa yüklendiğinde veriyi çek ve grid'i ayarla
    document.addEventListener('DOMContentLoaded', fetchData);

    // Pencere yeniden boyutlandırıldığında grid'i tekrar ayarla
    window.addEventListener('resize', adjustGridLayout);
</script>
    
</body>
</html>