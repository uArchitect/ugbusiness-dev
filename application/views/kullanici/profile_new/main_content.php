<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<div class="content-wrapper " style="    padding-top: 23px;" >
    <!-- Content Header (Page header) -->
     
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src=" <?=base_url("uploads/".$data_kullanici->kullanici_resim)?>" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?=$data_kullanici->kullanici_ad_soyad?></h3>

                <p class="text-muted text-center" style="margin-top:-5px!important;display:block"><?=$data_kullanici->kullanici_unvan?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Mail Adresi</b> <a class="float-right"><?=$data_kullanici->kullanici_email_adresi?></a>
                  </li>
                  <li class="list-group-item">
                    <b>İletişim Numarası</b> <a class="float-right"><?=$data_kullanici->kullanici_bireysel_iletisim_no?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Departman</b> <a class="float-right"><?=$data_kullanici->departman_adi?> Departmanı</a>
                  </li>
                </ul>

                <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Education</strong>

                <p class="text-muted">
                  B.S. in Computer Science from the University of Tennessee at Knoxville
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                <p class="text-muted">Malibu, California</p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                <p class="text-muted">
                  <span class="tag tag-danger">UI Design</span>
                  <span class="tag tag-success">Coding</span>
                  <span class="tag tag-info">Javascript</span>
                  <span class="tag tag-warning">PHP</span>
                  <span class="tag tag-primary">Node.js</span>
                </p>

                <hr>

                <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">
                  <i class="nav-icon fas fa-car" style="font-size:13px"></i>  
                  Araç Bilgisi</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">
                  <i class="nav-icon 	fas fa-people-arrows " style="font-size:13px"></i>  
                  Satış Rapor</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">
                  <i class="nav-icon 	fas fa-phone " style="font-size:13px"></i>  
                  Talep Rapor</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">
                  <i class="nav-icon 	fas fa-calendar " style="font-size:13px"></i>  
                  Mesai Bilgileri</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">
                  <i class="nav-icon 	fas fa-award " style="font-size:13px"></i>  
                  Envanter</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">
                  <i class="nav-icon 	fas fa-envelope " style="font-size:13px"></i>  
                  İletişim</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="activity">

                    <!-- Post -->
                    <div class="col-lg-12 col-6" style="cursor:pointer; padding: 10px;">
    <div class="vehicle-card" onclick="marka_model_guncelle();">
        <div class="vehicle-header">
            <h3>FIAT FIORINO</h3>
            <span class="badge">Umex Şirket Aracı</span>
        </div>

        <div class="vehicle-body">
            <div class="vehicle-image" style="  padding-right: 110px;">
                <img src="https://ugbusiness.com.tr/uploads/fiatfiorino.png" alt="FIAT FIORINO">
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

        <a onclick="marka_model_guncelle();" style="color:white;" class="vehicle-footer btn btn-success">
           Araç Bilgilerini Düzenle <i class="fas fa-arrow-circle-right"></i>
        </a>
    </div>


    <div id="map" style="height: 374px !important;"></div>

    <?php
$count = 0;
foreach ($driverdata as $d) {
         echo $data_arac->arac_arvento_key;
        echo "<br><br>";
        echo $d["node"];
      
    }
    ?>
    
<div class="row" style="    margin-top: -105px;
    z-index: 999;
    position: relative;"> 
<?php
$count = 0;
foreach ($driverdata as $d) {
     if($d["node"] == $data_arac->arac_arvento_key){
        echo "TESTTESTTESTTEST";
     }
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
        #map {
            height: 100vh;
            margin: 0;
        } 
    </style>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>

let plakas = {};  

let surucus = {};  

document.addEventListener('DOMContentLoaded', function() {
    // Her buton için plakayı yüklemek üzere AJAX isteği gönder
    document.querySelectorAll('.pin-zoom-button').forEach(function(button) {
        let nodeId = button.getAttribute('data-node');
        fetchPlaka(nodeId);
        fetchSurucu(nodeId);
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
                location.reload();
            });
    }


    function fetchSurucu(nodeId) {
        fetch(`<?=base_url("anasayfa/get_surucu?node=")?>${nodeId}`)
            .then(response => response.text())
            .then(plaka => {
                // Plakayı ilgili span'a yaz
                 document.getElementById(`surucu${nodeId}`).innerText = plaka;

                 
                 surucus[nodeId] = plaka;


            })
            .catch(error => {
                console.error('Hata:', error);  
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
                               <strong>${surucus[pin.node] ?? '<span id="surucu'+pin.node+'"></span>'}</strong> <br> 
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
                       document.getElementById("button-"+pin.node).style.borderColor = "red";
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

<style>
    .vehicle-card {
        background: linear-gradient(135deg, #2C3E50, #34495E);
        color: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
    }

    .vehicle-card:hover {
        transform: scale(1.03);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
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





                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <div class="timeline timeline-inverse">
                      <!-- timeline time label -->
                      <div class="time-label">
                        <span class="bg-danger">
                          10 Feb. 2014
                        </span>
                      </div>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-envelope bg-primary"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 12:05</span>

                          <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                          <div class="timeline-body">
                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                            weebly ning heekya handango imeem plugg dopplr jibjab, movity
                            jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                            quora plaxo ideeli hulu weebly balihoo...
                          </div>
                          <div class="timeline-footer">
                            <a href="#" class="btn btn-primary btn-sm">Read more</a>
                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-user bg-info"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                          <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                          </h3>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-comments bg-warning"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                          <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                          <div class="timeline-body">
                            Take me to your leader!
                            Switzerland is small and neutral!
                            We are more like Germany, ambitious and misunderstood!
                          </div>
                          <div class="timeline-footer">
                            <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline time label -->
                      <div class="time-label">
                        <span class="bg-success">
                          3 Jan. 2014
                        </span>
                      </div>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-camera bg-purple"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                          <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                          <div class="timeline-body">
                            <img src="https://placehold.it/150x100" alt="...">
                            <img src="https://placehold.it/150x100" alt="...">
                            <img src="https://placehold.it/150x100" alt="...">
                            <img src="https://placehold.it/150x100" alt="...">
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <div>
                        <i class="far fa-clock bg-gray"></i>
                      </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputName" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName2" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>