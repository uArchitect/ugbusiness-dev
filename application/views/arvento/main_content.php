 
 <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
        #map {
            height: 100vh;
            margin: 0;
        } 
    </style>
<div class="content-wrapper p-1 pr-2" style="margin-left: 235px;padding-top:15px">
<div id="map" style="height: 804px !important;"></div>
<div class="row">
<div class="col" style=" padding: 0;border-left:0px;border-radius:0px; "><button class="btn btn-default" style=" width: -webkit-fill-available; height: 92px; margin: 0px!important;!importan;!importa;!import;!impor;!impo;!imp;!im;!i;!; ">01 UG 20546</button></div>
<div class="col" style=" padding: 0;border-left:0px;border-radius:0px; "><button class="btn btn-default" style=" width: -webkit-fill-available; height: 92px; margin: 0px!important;!importan;!importa;!import;!impor;!impo;!imp;!im;!i;!; ">01 UG 20546</button></div>
<div class="col" style=" padding: 0;border-left:0px;border-radius:0px; "><button class="btn btn-default" style=" width: -webkit-fill-available; height: 92px; margin: 0px!important;!importan;!importa;!import;!impor;!impo;!imp;!im;!i;!; ">01 UG 20546</button></div>
<div class="col" style=" padding: 0;border-left:0px;border-radius:0px; "><button class="btn btn-default" style=" width: -webkit-fill-available; height: 92px; margin: 0px!important;!importan;!importa;!import;!impor;!impo;!imp;!im;!i;!; ">01 UG 20546</button></div>
<div class="col" style=" padding: 0;border-left:0px;border-radius:0px; "><button class="btn btn-default" style=" width: -webkit-fill-available; height: 92px; margin: 0px!important;!importan;!importa;!import;!impor;!impo;!imp;!im;!i;!; ">01 UG 20546</button></div>
<div class="col" style=" padding: 0;border-left:0px;border-radius:0px; "><button class="btn btn-default" style=" width: -webkit-fill-available; height: 92px; margin: 0px!important;!importan;!importa;!import;!impor;!impo;!imp;!im;!i;!; ">01 UG 20546</button></div>
<div class="col" style=" padding: 0;border-left:0px;border-radius:0px; "><button class="btn btn-default" style=" width: -webkit-fill-available; height: 92px; margin: 0px!important;!importan;!importa;!import;!impor;!impo;!imp;!im;!i;!; ">01 UG 20546</button></div>
<div class="col" style=" padding: 0;border-left:0px;border-radius:0px; "><button class="btn btn-default" style=" width: -webkit-fill-available; height: 92px; margin: 0px!important;!importan;!importa;!import;!impor;!impo;!imp;!im;!i;!; ">01 UG 20546</button></div>
<div class="col" style=" padding: 0;border-left:0px;border-radius:0px; "><button class="btn btn-default" style=" width: -webkit-fill-available; height: 92px; margin: 0px!important;!importan;!importa;!import;!impor;!impo;!imp;!im;!i;!; ">01 UG 20546</button></div>
<div class="col" style=" padding: 0;border-left:0px;border-radius:0px; "><button class="btn btn-default" style=" width: -webkit-fill-available; height: 92px; margin: 0px!important;!importan;!importa;!import;!impor;!impo;!imp;!im;!i;!; ">01 UG 20546</button></div>
<div class="col" style=" padding: 0; "><button class="btn btn-default" style=" width: -webkit-fill-available; height: 92px; margin: 0px!important;!importan;!importa;!import;!impor;!impo;!imp;!im;!i;!; ">01 UG 20546</button></div>

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
        iconUrl: 'https://api.ugbusiness.com.tr/22.svg', // İkon dosyasının yolu
        iconSize: [50, 60], // İkonun boyutları (genişlik x yükseklik)
        iconAnchor: [15, 40], // İkonun haritadaki bağlantı noktası
        popupAnchor: [0, -40] // Popup'ın ikonla ilişkilendirileceği nokta
    });
    // PHP'den pin verilerini al ve haritaya ekle
    fetch('<?=base_url("anasayfa/get_vehicles")?>') // PHP dosyasının yolu
        .then(response => response.json())
        .then(pins => {
            pins.forEach((pin, index) => {
    
    
    
                L.marker([pin.lat, pin.lng], { icon: customIcon }).addTo(map)
                    .bindPopup(`Pin ${index + 1}<br>Koordinatlar: ${pin.lat.toFixed(4)}, ${pin.lng.toFixed(4)}`);
            });
        })
        .catch(error => console.error('Hata:', error));
</script>
  </div> 