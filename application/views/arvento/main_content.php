 
 <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
        #map {
            height: 100vh;
            margin: 0;
        } 
    </style>
<div class="content-wrapper p-1 pr-2" style="margin-left: 235px;padding-top: 0px !important;">

  <div class="row">
  <div class="col-md-12" style="height: 84px;background: #000951b3;margin-bottom: -100px;z-index: 999;">
        <img src="https://ugbusiness.com.tr/uploads/arventoumex.png" style="height: 106px;margin: auto;display: block;margin-top: -13px;" alt="">
      </div>
    <div class="col-md-3 d-none"></div>
    <div class="col-md-12"><div id="map" style="height: 874px !important;"></div></div>
  </div>

<div class="row" style="    margin-top: -105px;
    z-index: 999;
    position: relative;"> 
<?php
$count = 0;
foreach ($driverdata as $d) {
    
    ?>
    <div class="col" style="padding: 0 5px;<?=(++$count == 1) ? "padding-left: 21px;" :""?><?=(++$count == count($driverdata)) ? "padding-right: 21px;" :""?>">
        <button 
            class="btn btn-default pin-zoom-button" 
            data-node="<?= $d["node"] ?>" id="button-<?= $d["node"] ?>"
            style="    border-radius: 9px !important;background: #001e73bf; color: white;   border-width: 2px;    width: -webkit-fill-available; height: 92px; margin: 0px!important;">
            
            <span id="durum-<?= $d["node"] ?>-1" style="display:none;font-weight: 300;font-size: 12px;margin-top: -2px;color: red;background: white;border-radius: 9px;margin: 5px;margin-top: -16px;border: 1px solid red;font-weight: 400;">Beklemede</span>
            <span id="durum-<?= $d["node"] ?>-2" style="display:none;font-weight: 300;font-size: 12px;margin-top: -2px;color: #187901;background: white;border-radius: 9px;/* margin: 5px; */margin-top: -16px;border: 1px solid #059d26;font-weight: 400;margin-bottom: 5px;">Hareket Ediyor</span>

            <i class="fas fa-car text-white" style="font-size: 20px"></i><br>
            <span style="font-size: 9px;"><?= $d["driver"] ?></span>
            <br>
            <span class="plaka" id="plaka-<?= $d["node"] ?>" style="font-weight: 800; font-size: 14px;"><i class="fa fa-spinner fa-spin" style="font-size:24px"></i></span>
        </button>
    </div>
    <?php
}
?>
 

</div>
<style>
    .pin-zoom-button:hover {
        background-color: red !important; /* Set background to red when hovered */
    }
    .pin-zoom-button:focus {
        background-color: red !important; /* Set background to red when hovered */
    }
    .pin-zoom-button:visited {
        background-color: red !important; /* Set background to red when hovered */
    }
</style>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>

let plakas = {};  
document.addEventListener('DOMContentLoaded', function() {
    // Her buton için plakayı yüklemek üzere AJAX isteği gönder
    document.querySelectorAll('.pin-zoom-button').forEach(function(button) {
        let nodeId = button.getAttribute('data-node');
        fetchPlaka(nodeId);
    });

    function fetchPlaka(nodeId) {
        fetch(`<?=base_url("anasayfa/get_plaka?node=")?>${nodeId}`)
            .then(response => response.text())
            .then(plaka => {
                // Plakayı ilgili span'a yaz
                document.getElementById(`plaka-${nodeId}`).innerText = plaka;
                document.getElementById(`p${nodeId}`).innerText = plaka;

                plakas[nodeId] = plaka;

                 

            })
            .catch(error => {
                console.error('Hata:', error);
                document.getElementById(`plaka-${nodeId}`).innerText = 'Hata oluştu';
            });
    }
});



    // Haritayı başlat
    const map = L.map('map', {
    zoomSnap: 0.25
}).setView([39.0, 35.0], 7); // Türkiye merkez koordinatları

    // OpenStreetMap katmanı ekle
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: 'Map data &copy; <a href="https://www.ugteknoloji.com">UG YAZILIM</a> contributors'
    }).addTo(map);
 
    const customIcon = L.icon({
        iconUrl: 'https://api.ugbusiness.com.tr/3.svg',
        iconSize: [50, 60],
        iconAnchor: [15, 40],
        popupAnchor: [0, -40]
    });

    const movingIcon = L.icon({
    iconUrl: 'https://api.ugbusiness.com.tr/22.svg', // Hareketli icon
    iconSize: [50, 60],
    iconAnchor: [15, 40],
    popupAnchor: [0, -40]
});


let markers = {};  

// Fonksiyonu tekrar kullanılabilir yapmak için tanımlıyoruz
function updateMarkers() {
    fetch('<?=base_url("anasayfa/get_vehicles")?>')
        .then(response => response.json())
        .then(pins => {
            console.log("Gelen pin verileri:", pins); // Hata ayıklama için

            // Mevcut işaretçileri temizle
            Object.values(markers).forEach(marker => {
                map.removeLayer(marker);  // Önceki işaretçileri haritadan kaldırıyoruz
            });

            // markers objesini sıfırlıyoruz
            markers = {};

            // Yeni pinleri ekle
            pins.forEach(pin => {
                if (pin.lat && pin.lng) { // Geçerli koordinat kontrolü
                  const markerIcon = pin.speed > 0 ? movingIcon : customIcon; // Hareket durumu kontrolü
                    const marker = L.marker([pin.lat, pin.lng], { icon: markerIcon })
                        .addTo(map)
                        .bindPopup(`
                            Node: ${pin.node}<br>
                            Koordinatlar: ${pin.lat.toFixed(4)}, ${pin.lng.toFixed(4)}<br>
                            Güncel Hız: ${pin.speed} Km/Saat<br>
                        `);

                    const infoDiv = L.divIcon({
                        className: 'custom-marker-info',
                        html: `
                            <div style="text-align: center; margin-top: 45px; margin-left: -10px; background: #ffffffb8; border-radius: 10px; width: 134px; border: 1px dotted #b5b5b5;">
                             <strong>${plakas[pin.node] ?? '<span id="p'+pin.node+'"></span>'}</strong> <br>   
                            <strong>Hız : </strong> ${pin.speed} Km/Saat
                               
                            </div>
                        `,
                        iconSize: [100, 50],
                        iconAnchor: [50, 25] // Orta kısmı işaretçi konumuyla hizalayın
                    });

                    const infoMarker = L.marker([pin.lat, pin.lng], { icon: infoDiv })
                        .addTo(map);
                        
                    markers[pin.node] = marker;   // Ana işaretçi ekleme
                    markers[pin.node + "_info"] = infoMarker; // Info işaretçisini de ekleme


                    if(pin.speed > 0){
                      document.getElementById("durum-"+pin.node+"-1").style.display = "none";
                      document.getElementById("durum-"+pin.node+"-2").style.display = "block";
                      document.getElementById("button-"+pin.node).style.borderColor = "#04f100";
                    }else{
                      document.getElementById("durum-"+pin.node+"-2").style.display = "none";
                      document.getElementById("durum-"+pin.node+"-1").style.display = "block";
                       document.getElementById("button-"+pin.node).style.borderColor = "#003b64";
                    }


                }
            });
        })
        .catch(error => console.error('Hata:', error));
}
// İlk yükleme
updateMarkers();

// 10 saniyede bir yenile
setInterval(updateMarkers, 10000);  // 10000 ms = 10 saniye


document.querySelectorAll('.pin-zoom-button').forEach(button => {
    button.addEventListener('click', () => {
        const node = button.getAttribute('data-node');  
        console.log("Marker listesi:", markers); // Hata ayıklama için
        if (markers[node]) {
            const markerLatLng = markers[node].getLatLng();
            map.setView(markerLatLng, 17); 
            markers[node].openPopup();  
          
        } else {
            console.warn(`'${node}' için bir marker bulunamadı.`);
        }
    });
});

</script>
  </div> 