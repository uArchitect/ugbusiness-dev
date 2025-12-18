<!-- Container -->
<div class="container-fixed">
 <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
  <div class="flex flex-col justify-center gap-2">
   <h1 class="text-xl font-medium leading-none text-gray-900">
    Potansiyel Müşteri Bulma
   </h1>
   <div class="flex items-center gap-2 text-sm font-normal text-gray-700">
    Google Maps üzerinden otomatik müşteri bulma ve rehber oluşturma sistemi.
   </div>
  </div>
 </div>
</div>
<!-- End of Container -->

<!-- Container -->
<div class="container-fixed">
 <div class="grid gap-5 lg:gap-7.5">
  
  <!-- API Key Uyarısı -->
  <div class="alert alert-warning d-none" id="api-key-uyari" role="alert">
   <div class="flex items-center gap-3">
    <i class="ki-filled ki-information-2 text-2xl text-warning"></i>
    <div class="flex-1">
     <strong class="text-gray-900">Google Maps API Key Gerekli!</strong>
     <p class="text-sm text-gray-700 mb-1">Sistemi kullanmak için Google Maps Places API anahtarı gereklidir. Lütfen sayfa kaynağında (View Source) "YOUR_API_KEY" yerine gerçek API anahtarınızı yazın.</p>
     <p class="text-xs text-gray-600 mb-0">API Key almak için: <a href="https://console.cloud.google.com/google/maps-apis/credentials" target="_blank" class="text-primary hover:underline">Google Cloud Console</a></p>
    </div>
   </div>
  </div>
  
  <!-- Arama Formu -->
  <div class="card card-grid min-w-full">
   <div class="card-header flex-wrap gap-2">
    <h3 class="card-title font-medium text-sm">
     İşletme Ara
    </h3>
   </div>
   <div class="card-body">
    <form id="potansiyel-musteri-arama-form">
     <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
      <!-- Şehir Seçimi -->
      <div>
       <label class="form-label text-sm font-medium text-gray-700 mb-2">
        Şehir <span class="text-danger">*</span>
       </label>
       <div class="input-group">
        <span class="input-group-text bg-primary text-white">
         <i class="ki-filled ki-geolocation text-sm"></i>
        </span>
        <input type="text" id="sehir-input" class="form-control" placeholder="Örn: Ankara, İstanbul, Bursa" required>
       </div>
       <div class="form-text text-xs text-gray-500 mt-1">Arama yapılacak şehri girin</div>
      </div>
      
      <!-- İş Kolu Seçimi -->
      <div>
       <label class="form-label text-sm font-medium text-gray-700 mb-2">
        İş Kolu / Sektör <span class="text-danger">*</span>
       </label>
       <div class="input-group">
        <span class="input-group-text bg-primary text-white">
         <i class="ki-filled ki-briefcase text-sm"></i>
        </span>
        <input type="text" id="is-kolu-input" class="form-control" placeholder="Örn: Diş Klinikleri, Oto Servisleri, Restoran" required>
       </div>
       <div class="form-text text-xs text-gray-500 mt-1">Aranacak iş kolunu veya sektörü girin</div>
      </div>
     </div>
     
     <!-- Arama Butonu -->
     <div class="flex items-center gap-3">
      <button type="submit" class="btn btn-primary" id="arama-baslat-btn">
       <i class="ki-filled ki-magnifier me-2"></i>
       Arama Başlat
      </button>
      <button type="button" class="btn btn-light d-none" id="arama-durdur-btn">
       <i class="ki-filled ki-cross me-2"></i>
       Aramayı Durdur
      </button>
     </div>
    </form>
   </div>
  </div>
  
  <!-- Arama İlerleme Durumu -->
  <div class="card card-grid min-w-full d-none" id="arama-durum-kart">
   <div class="card-body">
    <div class="flex items-center gap-4">
     <div class="flex-shrink-0">
      <i class="ki-filled ki-loading text-3xl text-primary animate-spin"></i>
     </div>
     <div class="flex-1">
      <h4 class="text-base font-semibold text-gray-900 mb-1">Arama Devam Ediyor...</h4>
      <p class="text-sm text-gray-600 mb-2" id="arama-durum-mesaji">İşletmeler taranıyor...</p>
      <div class="progress" style="height: 8px;">
       <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" id="arama-progress" style="width: 0%"></div>
      </div>
      <div class="flex items-center gap-4 mt-2 text-xs text-gray-500">
       <span>Bulunan: <strong id="bulunan-sayisi">0</strong></span>
       <span>Kaydedilen: <strong id="kaydedilen-sayisi">0</strong></span>
       <span>Hata: <strong id="hata-sayisi">0</strong></span>
      </div>
     </div>
    </div>
   </div>
  </div>
  
  <!-- Bulunan İşletmeler Listesi -->
  <div class="card card-grid min-w-full d-none" id="sonuc-listesi-kart">
   <div class="card-header flex-wrap gap-2">
    <h3 class="card-title font-medium text-sm">
     Bulunan İşletmeler
    </h3>
    <div class="flex items-center gap-2 ms-auto">
     <button type="button" class="btn btn-sm btn-light" id="tumunu-kaydet-btn">
      <i class="ki-filled ki-check me-1"></i>
      Tümünü Kaydet
     </button>
     <button type="button" class="btn btn-sm btn-light" id="listeyi-temizle-btn">
      <i class="ki-filled ki-trash me-1"></i>
      Listeyi Temizle
     </button>
    </div>
   </div>
   <div class="card-body">
    <div class="table-responsive">
     <table class="table table-row-bordered table-row-gray-200 align-middle gs-0 gy-4" id="isletme-listesi-tablo">
      <thead>
       <tr class="fw-bold text-muted">
        <th class="min-w-50px">#</th>
        <th class="min-w-200px">İşletme Adı</th>
        <th class="min-w-150px">Telefon</th>
        <th class="min-w-200px">Adres</th>
        <th class="min-w-100px">Web Sitesi</th>
        <th class="min-w-80px">Rating</th>
        <th class="min-w-100px">İşlemler</th>
       </tr>
      </thead>
      <tbody id="isletme-listesi-tbody">
       <!-- Dinamik olarak doldurulacak -->
      </tbody>
     </table>
    </div>
   </div>
  </div>
  
  <!-- Kaydedilen Müşteriler Listesi -->
  <div class="card card-grid min-w-full">
   <div class="card-header flex-wrap gap-2">
    <h3 class="card-title font-medium text-sm">
     Kaydedilen Potansiyel Müşteriler
    </h3>
    <div class="flex items-center gap-2 ms-auto">
     <button type="button" class="btn btn-sm btn-light" id="listeyi-yenile-btn">
      <i class="ki-filled ki-arrows-circle me-1"></i>
      Yenile
     </button>
    </div>
   </div>
   <div class="card-body">
    <div class="table-responsive">
     <table class="table table-row-bordered table-row-gray-200 align-middle gs-0 gy-4" id="kayitli-musteri-tablo">
      <thead>
       <tr class="fw-bold text-muted">
        <th class="min-w-50px">#</th>
        <th class="min-w-200px">İşletme Adı</th>
        <th class="min-w-150px">Telefon</th>
        <th class="min-w-200px">Adres</th>
        <th class="min-w-100px">İş Kolu</th>
        <th class="min-w-100px">Durum</th>
        <th class="min-w-150px">Tarih</th>
        <th class="min-w-100px">İşlemler</th>
       </tr>
      </thead>
      <tbody id="kayitli-musteri-tbody">
       <!-- Dinamik olarak doldurulacak -->
      </tbody>
     </table>
    </div>
   </div>
  </div>
  
 </div>
</div>
<!-- End of Container -->

<!-- Google Maps Places API CDN -->
<!-- ÖNEMLİ: YOUR_API_KEY yerine Google Cloud Console'dan aldığınız API anahtarını yazın -->
<!-- API Key almak için: https://console.cloud.google.com/google/maps-apis/credentials -->
<!-- Places API'yi etkinleştirmeyi unutmayın! -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places&v=3.63.4a"></script>

<!-- Custom JavaScript -->
<script>
(function() {
  'use strict';
  
  // Global değişkenler
  let aramaDevamEdiyor = false;
  let aramaDurduruldu = false;
  let bulunanIsletmeler = [];
  let nextPageToken = null;
  
  // Form submit
  document.getElementById('potansiyel-musteri-arama-form')?.addEventListener('submit', function(e) {
    e.preventDefault();
    aramaBaslat();
  });
  
  // Arama durdur butonu
  document.getElementById('arama-durdur-btn')?.addEventListener('click', function() {
    aramaDurduruldu = true;
    aramaDevamEdiyor = false;
    aramaDurumGuncelle('Arama durduruldu.', false);
  });
  
  // Tümünü kaydet butonu
  document.getElementById('tumunu-kaydet-btn')?.addEventListener('click', function() {
    if(bulunanIsletmeler.length === 0) {
      alert('Kaydedilecek işletme bulunamadı.');
      return;
    }
    tumunuKaydet();
  });
  
  // Listeyi temizle butonu
  document.getElementById('listeyi-temizle-btn')?.addEventListener('click', function() {
    if(confirm('Listeyi temizlemek istediğinize emin misiniz?')) {
      bulunanIsletmeler = [];
      sonucListesiniGuncelle();
    }
  });
  
  // Listeyi yenile butonu
  document.getElementById('listeyi-yenile-btn')?.addEventListener('click', function() {
    kayitliMusterileriYukle();
  });
  
  // Arama başlat
  function aramaBaslat() {
    const sehir = document.getElementById('sehir-input').value.trim();
    const isKolu = document.getElementById('is-kolu-input').value.trim();
    
    if(!sehir || !isKolu) {
      alert('Lütfen şehir ve iş kolu bilgilerini girin.');
      return;
    }
    
    // Google Maps API yüklendi mi kontrol et
    if(typeof google === 'undefined' || !google.maps || !google.maps.places) {
      alert('Google Maps API yüklenmedi. Lütfen API anahtarını kontrol edin.');
      return;
    }
    
    // Reset
    bulunanIsletmeler = [];
    nextPageToken = null;
    aramaDevamEdiyor = true;
    aramaDurduruldu = false;
    
    // UI güncelle
    document.getElementById('arama-baslat-btn').classList.add('d-none');
    document.getElementById('arama-durdur-btn').classList.remove('d-none');
    document.getElementById('arama-durum-kart').classList.remove('d-none');
    document.getElementById('sonuc-listesi-kart').classList.remove('d-none');
    
    // İstatistikleri sıfırla
    document.getElementById('bulunan-sayisi').textContent = '0';
    document.getElementById('kaydedilen-sayisi').textContent = '0';
    document.getElementById('hata-sayisi').textContent = '0';
    
    // Arama başlat
    isletmeleriAra(sehir, isKolu);
  }
  
  // İşletmeleri ara
  function isletmeleriAra(sehir, isKolu, pageToken = null) {
    if(!aramaDevamEdiyor || aramaDurduruldu) {
      return;
    }
    
    const aramaQuery = `${isKolu} ${sehir}`;
    aramaDurumGuncelle(`"${aramaQuery}" aranıyor...`, true);
    
    // PlacesService oluştur
    const service = new google.maps.places.PlacesService(document.createElement('div'));
    
    const request = {
      query: aramaQuery,
      fields: ['name', 'formatted_phone_number', 'website', 'formatted_address', 'rating', 'user_ratings_total', 'place_id', 'url', 'geometry']
    };
    
    if(pageToken) {
      request.pageToken = pageToken;
    }
    
    service.textSearch(request, function(results, status, pagination) {
      if(status === google.maps.places.PlacesServiceStatus.OK && results) {
        // Sonuçları işle
        results.forEach(function(place) {
          if(!aramaDurduruldu) {
            const isletme = {
              name: place.name || '',
              phone: place.formatted_phone_number || '',
              website: place.website || '',
              address: place.formatted_address || '',
              rating: place.rating || null,
              user_ratings_total: place.user_ratings_total || 0,
              place_id: place.place_id || '',
              maps_url: place.url || '',
              sehir: sehir,
              is_kolu: isKolu
            };
            
            // Duplicate kontrolü
            const duplicate = bulunanIsletmeler.find(function(item) {
              return item.place_id === isletme.place_id;
            });
            
            if(!duplicate) {
              bulunanIsletmeler.push(isletme);
              document.getElementById('bulunan-sayisi').textContent = bulunanIsletmeler.length;
            }
          }
        });
        
        // Sonuç listesini güncelle
        sonucListesiniGuncelle();
        
        // Sayfa token varsa, bir sonraki sayfayı al
        if(pagination && pagination.hasNextPage && !aramaDurduruldu) {
          setTimeout(function() {
            pagination.nextPage();
          }, 2000); // Rate limit için bekle
        } else {
          // Arama tamamlandı
          aramaDevamEdiyor = false;
          aramaDurumGuncelle('Arama tamamlandı!', false);
          document.getElementById('arama-baslat-btn').classList.remove('d-none');
          document.getElementById('arama-durdur-btn').classList.add('d-none');
        }
      } else if(status === google.maps.places.PlacesServiceStatus.ZERO_RESULTS) {
        aramaDevamEdiyor = false;
        aramaDurumGuncelle('Sonuç bulunamadı.', false);
        document.getElementById('arama-baslat-btn').classList.remove('d-none');
        document.getElementById('arama-durdur-btn').classList.add('d-none');
      } else {
        document.getElementById('hata-sayisi').textContent = 
          parseInt(document.getElementById('hata-sayisi').textContent) + 1;
        console.error('Places API hatası:', status);
        
        // Hata olsa bile devam et (bir sonraki sayfa varsa)
        if(pagination && pagination.hasNextPage && !aramaDurduruldu) {
          setTimeout(function() {
            pagination.nextPage();
          }, 2000);
        } else {
          aramaDevamEdiyor = false;
          aramaDurumGuncelle('Arama tamamlandı (bazı hatalar oluştu).', false);
          document.getElementById('arama-baslat-btn').classList.remove('d-none');
          document.getElementById('arama-durdur-btn').classList.add('d-none');
        }
      }
    });
  }
  
  // Sonuç listesini güncelle
  function sonucListesiniGuncelle() {
    const tbody = document.getElementById('isletme-listesi-tbody');
    if(!tbody) return;
    
    tbody.innerHTML = '';
    
    bulunanIsletmeler.forEach(function(isletme, index) {
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td>${index + 1}</td>
        <td><strong>${escapeHtml(isletme.name)}</strong></td>
        <td>${escapeHtml(isletme.phone || '-')}</td>
        <td class="text-muted">${escapeHtml(isletme.address || '-')}</td>
        <td>${isletme.website ? `<a href="${isletme.website}" target="_blank" class="text-primary">${escapeHtml(isletme.website)}</a>` : '-'}</td>
        <td>
          ${isletme.rating ? `
            <div class="d-flex align-items-center">
              <span class="badge badge-success me-1">${isletme.rating}</span>
              <small class="text-muted">(${isletme.user_ratings_total})</small>
            </div>
          ` : '-'}
        </td>
        <td>
          <button type="button" class="btn btn-sm btn-primary" onclick="tekKaydet(${index})">
            <i class="ki-filled ki-check"></i> Kaydet
          </button>
        </td>
      `;
      tbody.appendChild(tr);
    });
  }
  
  // Tek kaydet
  window.tekKaydet = function(index) {
    const isletme = bulunanIsletmeler[index];
    if(!isletme) return;
    
    kaydet([isletme], function() {
      bulunanIsletmeler.splice(index, 1);
      sonucListesiniGuncelle();
    });
  };
  
  // Tümünü kaydet
  function tumunuKaydet() {
    if(bulunanIsletmeler.length === 0) return;
    
    kaydet(bulunanIsletmeler, function() {
      bulunanIsletmeler = [];
      sonucListesiniGuncelle();
      kayitliMusterileriYukle();
    });
  }
  
  // Kaydet (Backend'e gönder)
  function kaydet(isletmeler, callback) {
    fetch('<?=base_url("ugajans_ekip/potansiyel_musteri_kaydet")?>', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        isletmeler: isletmeler
      })
    })
    .then(response => response.json())
    .then(data => {
      if(data.status === 'success') {
        const kaydedilenSayisi = data.kaydedilen || 0;
        document.getElementById('kaydedilen-sayisi').textContent = 
          parseInt(document.getElementById('kaydedilen-sayisi').textContent) + kaydedilenSayisi;
        
        if(callback) callback();
        
        // Başarı mesajı
        alert(`${kaydedilenSayisi} işletme başarıyla kaydedildi.`);
      } else {
        alert('Hata: ' + (data.message || 'Bilinmeyen hata'));
      }
    })
    .catch(error => {
      console.error('Hata:', error);
      alert('Kayıt sırasında bir hata oluştu.');
    });
  }
  
  // Arama durum güncelle
  function aramaDurumGuncelle(mesaj, devamEdiyor) {
    const durumMesaji = document.getElementById('arama-durum-mesaji');
    if(durumMesaji) {
      durumMesaji.textContent = mesaj;
    }
    
    const progressBar = document.getElementById('arama-progress');
    if(progressBar) {
      if(devamEdiyor) {
        progressBar.style.width = '100%';
        progressBar.classList.add('progress-bar-animated');
      } else {
        progressBar.style.width = '100%';
        progressBar.classList.remove('progress-bar-animated');
      }
    }
  }
  
  // Kayıtlı müşterileri yükle
  function kayitliMusterileriYukle() {
    fetch('<?=base_url("ugajans_ekip/potansiyel_musteri_liste")?>')
    .then(response => response.json())
    .then(data => {
      if(data.status === 'success') {
        const tbody = document.getElementById('kayitli-musteri-tbody');
        if(!tbody) return;
        
        tbody.innerHTML = '';
        
        data.musteriler.forEach(function(musteri, index) {
          const tr = document.createElement('tr');
          const durumBadge = {
            'yeni': '<span class="badge badge-primary">Yeni</span>',
            'aranmis': '<span class="badge badge-info">Arandı</span>',
            'ilgileniyor': '<span class="badge badge-warning">İlgileniyor</span>',
            'musteri_oldu': '<span class="badge badge-success">Müşteri Oldu</span>',
            'iptal': '<span class="badge badge-danger">İptal</span>'
          }[musteri.durum] || '<span class="badge badge-secondary">-</span>';
          
          tr.innerHTML = `
            <td>${index + 1}</td>
            <td><strong>${escapeHtml(musteri.isletme_adi)}</strong></td>
            <td>${escapeHtml(musteri.telefon_numarasi || '-')}</td>
            <td class="text-muted">${escapeHtml(musteri.adres || '-')}</td>
            <td>${escapeHtml(musteri.is_kolu || '-')}</td>
            <td>${durumBadge}</td>
            <td>${musteri.olusturma_tarihi || '-'}</td>
            <td>
              <button type="button" class="btn btn-sm btn-light" onclick="musteriDetay(${musteri.potansiyel_musteri_id})">
                <i class="ki-filled ki-eye"></i>
              </button>
            </td>
          `;
          tbody.appendChild(tr);
        });
      }
    })
    .catch(error => {
      console.error('Hata:', error);
    });
  }
  
  // HTML escape
  function escapeHtml(text) {
    if(!text) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
  }
  
  // API Key kontrolü
  function apiKeyKontrol() {
    const scriptTag = document.querySelector('script[src*="maps.googleapis.com"]');
    if(scriptTag && scriptTag.src.includes('YOUR_API_KEY')) {
      document.getElementById('api-key-uyari').classList.remove('d-none');
    }
  }
  
  // Sayfa yüklendiğinde kayıtlı müşterileri yükle
  document.addEventListener('DOMContentLoaded', function() {
    apiKeyKontrol();
    kayitliMusterileriYukle();
  });
  
})();
</script>
