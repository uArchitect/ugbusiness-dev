 
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
        <a href="<?=base_url("arvento/get_yakit/X200037136")?>" class="btn btn-warning" style="float: right; margin-top: -68px; margin-right: 20px;">Yakıt Seviye Raporu (CANBUS)</a>
      </div>
     
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
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        .cardcustom {
            position: fixed;
    top: 141px;
    z-index: 999;
    left: 259px;
    width: 498px;
    height: 655px;border-radius:5px;
    background-color: #f8f9fa;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    border-right: 1px solid #ddd;
        }
        .cardcustom-header {
            background: #f8f9fa;
            padding: 16px;
            font-weight: bold;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .cardcustom-header .search-box {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .cardcustom-header input {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .cardcustom-header .count {
            font-size: 14px;
            color: #555;
        }
        .cardcustom-body {
            max-height: 661px;
            overflow-y: auto;
        }
        .alarm-item {
            padding: 16px;
            border-bottom: 1px solid #ddd;
            display: flex;
            gap: 12px;
        } .alarm-item-alternate {
            padding: 16px;
            border-bottom: 1px solid #ddd;
            display: flex;
            gap: 12px;
            background:#e3e3e3;
        }
        .alarm-item:last-child {
            border-bottom: none;
        }
        .icon {
            font-size: 24px;
            color: #007bff;
        }
        .alarm-content {
            flex-grow: 1;
        }
        .alarm-title {
            font-weight: bold;
            color: #333;
        }
        .alarm-meta {
            font-size: 14px;
            color: #555;
        }
        .alarm-time {
            font-size: 12px;
            color: #999;
            text-align: right;
        }
    </style>


<div class="cardcustom" id="cc" style="display:none">
    <div class="cardcustom-body">
            <div class="cardcustom-header">
            <span>Alarmlar</span>
            <div class="search-box"> 
                <span class="count">Araç Sayısı: -</span>
            </div>
        </div>
        <div class="cardcustom-body" id="alarmContainer" style="overflow-y: hidden;">
    
</div>
    </div>
</div>
<script> 
setInterval(() => {
    fetch('<?=base_url()?>arvento/get_speed_alarm_data')
        .then(response => response.json())
        .then(data => {

           

 
            const container = document.getElementById('alarmContainer');
        
            container.innerHTML = '';  
            data.sort((a, b) => new Date(b.Date) - new Date(a.Date));  
            data.forEach(alarm => {
                container.innerHTML += `
                <div class="alarm-item">
                    <div class="icon"><i class="fa fa-info-circle text-danger"></i></div>
                    <div class="alarm-content">
                        <div class="alarm-title text-danger">HIZ İHLALİ BİLDİRİMİ</div>
                        <div class="alarm-meta"><b>ARAÇ BİLGİLERİ : </b> ${alarm.License_Plate} - ${alarm.Driver}</div>
                        <div class="alarm-meta">${alarm.Adress}</div>
                        <div class="alarm-meta"><b>İhlal Hızı :</b> ${alarm.Speed} , <b>Hız Limiti :</b> ${alarm.Limit}</div>
                    </div>
                    <div class="alarm-time">${new Date(alarm.Date).toLocaleString('tr-TR')}</div>
                </div>
                `;
            });
        })
        .catch(error => console.error('Veri alınırken hata oluştu:', error));
}, 10000);  
</script>

<style>
    .pin-zoom-button:hover {
        background-color: red !important;  
    }
    .pin-zoom-button:focus {
        background-color: red !important;  
    }
    .pin-zoom-button:visited {
        background-color: red !important;  
    }
</style>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>

let plakas = {};  

let surucus = {};  

document.addEventListener('DOMContentLoaded', function() {
    
    document.querySelectorAll('.pin-zoom-button').forEach(function(button) {
        let nodeId = button.getAttribute('data-node');
        fetchPlaka(nodeId);
        fetchSurucu(nodeId);
    });

    function fetchPlaka(nodeId) {
        fetch(`<?=base_url("anasayfa/get_plaka?node=")?>${nodeId}`)
            .then(response => response.text())
            .then(plaka => {
                
                document.getElementById(`plaka-${nodeId}`).innerText = plaka;
                document.getElementById(`p${nodeId}`).innerText = plaka;

                plakas[nodeId] = plaka;

                 

            })
            .catch(error => {
                console.error('Hata:', error);
                document.getElementById(`plaka-${nodeId}`).innerText = 'Hata oluştu';
                
            });
    }


    function fetchSurucu(nodeId) {
        fetch(`<?=base_url("anasayfa/get_surucu?node=")?>${nodeId}`)
            .then(response => response.text())
            .then(plaka => {
                
                 document.getElementById(`surucu${nodeId}`).innerText = plaka;

                 
                 surucus[nodeId] = plaka;


            })
            .catch(error => {
                console.error('Hata:', error);  
            });
    }

});





    
    const map = L.map('map', {
    zoomSnap: 0.25
}).setView([39.0, 35.0], 7);  

     
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
    iconUrl: 'https://api.ugbusiness.com.tr/22.svg',  
    iconSize: [50, 60],
    iconAnchor: [15, 40],
    popupAnchor: [0, -40]
});


let markers = {};  

 
function updateMarkers() {
    fetch('<?=base_url("anasayfa/get_vehicles")?>')
        .then(response => response.json())
        .then(pins => {
            console.log("Gelen pin verileri:", pins);  

          
            Object.values(markers).forEach(marker => {
                map.removeLayer(marker);  
            });

          
            markers = {};

         
            pins.forEach(pin => {
                if (pin.lat && pin.lng) {  
                  const markerIcon = pin.speed > 0 ? movingIcon : customIcon;  
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
                               <strong>${surucus[pin.node] ?? '<span id="surucu'+pin.node+'"></span>'}</strong> <br> 
                            <strong>Hız : </strong> ${pin.speed} Km/Saat
                               
                            </div>
                        `,
                        iconSize: [100, 50],
                        iconAnchor: [50, 25] 
                    });

                    const infoMarker = L.marker([pin.lat, pin.lng], { icon: infoDiv })
                        .addTo(map);
                        
                    markers[pin.node] = marker;   
                    markers[pin.node + "_info"] = infoMarker;  


                    if(pin.speed > 0){
                      document.getElementById("durum-"+pin.node+"-1").style.display = "none";
                      document.getElementById("durum-"+pin.node+"-2").style.display = "block";
                      document.getElementById("button-"+pin.node).style.borderColor = "#04f100";
                    }else{
                      document.getElementById("durum-"+pin.node+"-2").style.display = "none";
                      document.getElementById("durum-"+pin.node+"-1").style.display = "block";
                       document.getElementById("button-"+pin.node).style.borderColor = "red";
                    }


                }
            });
        })
        .catch(error => console.error('Hata:', error));
}
 
updateMarkers();
 
setInterval(updateMarkers, 10000);   


document.querySelectorAll('.pin-zoom-button').forEach(button => {
    button.addEventListener('click', () => {
        const node = button.getAttribute('data-node');  
        console.log("Marker listesi:", markers); 
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