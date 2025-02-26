  
<style>
    .vehicle-card {
        background: linear-gradient(135deg, #0d0d0d, #0d0d0d);
        color: white; 
        padding: 20px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2); 
        position: relative;
    }
 

    .vehicle-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 2px solid rgba(255, 255, 255, 0.3);
        padding-bottom: 10px;
        margin-bottom: 15px;
    }

    .vehicle-header h3 {
        margin: 0;
        font-size: 22px;
        font-weight: bold;
    }

    .badge {
        background: #E67E22;
        color: white;
        padding: 5px 10px;
        border-radius: 10px;
       
        font-weight: bold;
    }

    .vehicle-body {
        display: flex;
        align-items: center;
    }

    .vehicle-image img {
        max-width: 327px;
        width: 327px;
        filter: drop-shadow(2px 4px 6px rgba(0, 0, 0, 0.3));
    }

    .vehicle-info {
        flex: 1;
        padding-left: 20px;
    }

    .info-row {
        display: flex;
        align-items: center;
        margin-bottom: 8px;
        font-size: 16px;
    }

    .info-row i {
        margin-right: 10px;
        color: #F1C40F;
    }

    .vehicle-footer {
        display: block;
        text-align: center; 
        padding: 12px;
        margin: auto;
        width:250px;
        margin:auto;
        border-radius: 10px;
        margin-top: 15px;
        font-weight: bold;
        transition: background 0.3s ease;
    }

    .vehicle-footer:hover {
        background: rgba(255, 255, 255, 0.4);
    }
</style>



                    <!-- Post -->
                    <div class="col-lg-12 col-6" id="arac_div" style="cursor:pointer; padding: 10px;">
    <div class="vehicle-card" style="margin-bottom: -297px;
    z-index: 999;       background: linear-gradient(179deg, rgb(0 0 0), rgb(0 73 167 / 54%));" >
        <div class="vehicle-header">
            <h3 style="margin-left:25px">FIAT FIORINO</h3>
            <span class="badge">Umex Şirket Aracı</span>
        </div>

        <div class="vehicle-body">
            <div class="vehicle-image" style="  padding-right: 110px;">
                <img src="https://ugbusiness.com.tr/uploads/fiatfiorino.png" alt="FIAT FIORINO">
            </div>
            <div class="vehicle-info">
                <div class="info-row">
                    <i class="fas fa-car"></i> <strong>Plaka : </strong> <span><?=$data_arac->arac_plaka?></span>
                </div>   <div class="info-row">
                    <i class="fas fa-file-contract"></i> <strong>Son Bakım : </strong> <span style="font-size:15px!important;"> 
 
     <b><?=(!empty($bakim_kayitlari) && count($bakim_kayitlari)>0) ? date("d.m.Y",strtotime($bakim_kayitlari[count($bakim_kayitlari)-1]->arac_bakim_baslangic_tarihi)) : "#"?></b>  </span>
                </div>
                <div class="info-row">
                    <i class="fas fa-shield-alt"></i> <strong>Sigorta Tarihi : </strong> <span style="font-size:15px!important;"> 
 
 <b><?=(!empty($sigorta_kayitlari) && count($sigorta_kayitlari)>0) ? date("d.m.Y",strtotime($sigorta_kayitlari[count($sigorta_kayitlari)-1]->arac_sigorta_baslangic_tarihi)) : "#"?></b>  </span>
                </div>
                <div class="info-row">
                    <i class="fas fa-tools"></i> <strong>Muayene Tarihi : </strong> <span style="font-size:15px!important;"> 
 
 <b><?=(!empty($muayene_kayitlari) && count($muayene_kayitlari)>0) ? date("d.m.Y",strtotime($muayene_kayitlari[count($muayene_kayitlari)-1]->arac_muayene_baslangic_tarihi)) : "#"?></b>  </span>
                </div>
                <div class="info-row">
                    <i class="fas fa-file-contract"></i> <strong>Kasko Tarihi:</strong> <span>20.07.2024</span>
                </div>
                <div class="info-row">
                    <i class="fas fa-tachometer-alt"></i> <strong>Güncel KM:</strong> <span>85,450 km</span>
                </div>
            </div>
            <div class="vehicle-info">
                <div class="info-row">
                    <i class="fas fa-car"></i> <strong>Plaka:</strong> <span>34 ABC 123</span>
                </div>
                <div class="info-row">
                    <i class="fas fa-shield-alt"></i> <strong>Sigorta Tarihi:</strong> <span>01.03.2024</span>
                </div>
                <div class="info-row">
                    <i class="fas fa-tools"></i> <strong>Muayene Tarihi:</strong> <span>15.08.2025</span>
                </div>
                <div class="info-row">
                    <i class="fas fa-file-contract"></i> <strong>Kasko Tarihi:</strong> <span>20.07.2024</span>
                </div>
                <div class="info-row">
                    <i class="fas fa-tachometer-alt"></i> <strong>Güncel KM:</strong> <span>85,450 km</span>
                </div>
            </div>
        </div>

       
    </div>


    <div id="map" style="height: 785px !important;"></div>

     
    </div>

     


    <style>

#loadingDiv {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: rgba(255, 255, 255, 0.7);
    padding: 20px;
    border-radius: 5px;
    font-size: 18px;
  }
  
        #map {
            height: 100vh;
            margin: 0;
        } 
        
.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    color: #fff;
    background-color:#0d0d0d!important; 
}
.leaflet-container {
  height: 100%;
  width: 100%;
  max-width: 100%;
  max-height: 100%;
}
 
    </style>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>

let plakas = {};  

let surucus = {};  
 



    // Haritayı başlat
    const map = L.map('map', {
    zoomSnap: 0.25
}).setView([39.0, 35.0], 15); // Türkiye merkez koordinatları
  // Loading div
  var loadingDiv = document.createElement('div');
  loadingDiv.innerText = 'Yükleniyor...';
  loadingDiv.id = 'loadingDiv';
  document.body.appendChild(loadingDiv);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: 'Map data &copy; <a href="https://www.ugteknoloji.com">UG YAZILIM</a> contributors'
    }).addTo(map);
 
    map.on('load', function() {
    document.body.removeChild(loadingDiv);
  });

    const movingIcon = L.icon({
    iconUrl: 'https://api.ugbusiness.com.tr/22.svg', // Hareketli icon
    iconSize: [50, 60],
    iconAnchor: [15, 40],
    popupAnchor: [0, -40]
});


let markers = {};  
 
function updateMarkers() { 


  let pins = <?=$driverdata?>;
  console.log(pins);
  pins.forEach(pin => {
    const markerIcon =  movingIcon;
    const marker = L.marker([pin.lat, pin.lng], { icon: markerIcon })
                        .addTo(map)
                        .bindPopup(`
                            Node: ${pin.node}<br> 
                        `);
                        const infoDiv = L.divIcon({
                        className: 'custom-marker-info',
                        html: `
                            <div style="text-align: center; margin-top: 45px; margin-left: -10px; background: #ffffffb8; border-radius: 10px; width: 134px; border: 1px dotted #b5b5b5;">
                             ${pin.address}
                            </div>
                        `,
                        iconSize: [100, 50],
                        iconAnchor: [50, 25] 
                    });

                    const infoMarker = L.marker([pin.lat, pin.lng], { icon: infoDiv })
                    .addTo(map);

                    map.setView(new L.LatLng(pin.lat, pin.lng), 15);

  });  

  
}
// İlk yükleme
updateMarkers();
 
 

</script>
</div>
