 
 <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
        #map {
            height: 100vh;
            margin: 0;
        } 
    </style>
<div class="content-wrapper p-1 pr-2" style="margin-left: 235px;padding-top:15px">

  <div class="row">
      <div class="col-md-12" style="height: 100px; background: #000951b3; margin-bottom: -100px; z-index: 999;">
        <img src="<?=base_url("uploads/arventoumex.png")?>" style="height: 100px; margin: auto; display: block;" alt="">
      </div>
    <div class="col-md-3 d-none"></div>
    <div class="col-md-12"><div id="map" style="height: 804px !important;"></div></div>
  </div>

<div class="row"> 
  <?php
  foreach ($driverdata as $d) {
    ?>
    <div class="col" style=" padding: 0; ">
    <button 
        class="btn btn-default pin-zoom-button" 
        data-node="<?= $d["node"] ?>" 
        style="background: #2523d5; color: white; border-left: 0px!important; border-radius: 0px!important; width: -webkit-fill-available; height: 92px; margin: 0px!important;">
        <i class="fas fa-car text-white" style="font-size: 20px"></i><br>
        <span style="font-size: 12px;"><?=$d["driver"]?></span>
        <br>
        <span style="font-weight: 800; font-size: 19px;">
          <?php echo get_arvento_plaka($d["node"]) ?>
        </span>
      </button>
    </div>

    <?php
  }
  ?>
 

</div>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    // Haritayı başlat
    const map = L.map('map').setView([39.0, 35.0], 7.4); // Türkiye merkez koordinatları

    // OpenStreetMap katmanı ekle
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    const customIcon = L.icon({
        iconUrl: 'https://api.ugbusiness.com.tr/22.svg',
        iconSize: [50, 60],
        iconAnchor: [15, 40],
        popupAnchor: [0, -40]
    });

    let markers = {}; // Node değerine göre pinleri saklayacak obje

    // PHP'den pin verilerini al ve haritaya ekle
    fetch('<?=base_url("anasayfa/get_vehicles")?>')
        .then(response => response.json())
        .then(pins => {
            pins.forEach(pin => {
                const marker = L.marker([pin.lat, pin.lng], { icon: customIcon })
                    .addTo(map)
                    .bindPopup(`Node: ${pin.node}<br>Koordinatlar: ${pin.lat.toFixed(4)}, ${pin.lng.toFixed(4)}`);
                markers[pin.node] = marker; // Node'u key olarak kullanarak marker'ı sakla
            });
        })
        .catch(error => console.error('Hata:', error));

    // Butonlara tıklama olayını dinle
    document.querySelectorAll('.pin-zoom-button').forEach(button => {
        button.addEventListener('click', () => {
            const node = button.getAttribute('data-node'); // Butonun node değerini al
            if (markers[node]) {
                map.setView(markers[node].getLatLng(), 13); // Marker konumuna zoom yap
                markers[node].openPopup(); // Popup'ı aç
            }
        });
    });
</script>
  </div> 