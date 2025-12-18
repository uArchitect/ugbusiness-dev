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
  <div class="card card-grid min-w-full d-none" id="api-key-uyari">
   <div class="card-body">
    <div class="flex items-center gap-4 p-4 bg-warning/10 rounded-lg border border-warning/20">
     <div class="flex-shrink-0">
      <i class="ki-filled ki-information-2 text-3xl text-warning"></i>
     </div>
     <div class="flex-1">
      <h4 class="text-base font-semibold text-gray-900 mb-1">Google Maps API Key Gerekli!</h4>
      <p class="text-sm text-gray-700 mb-2">Sistemi kullanmak için Google Maps Places API anahtarı gereklidir. Lütfen sayfa kaynağında (View Source) "YOUR_API_KEY" yerine gerçek API anahtarınızı yazın.</p>
      <p class="text-xs text-gray-600 mb-0">
       API Key almak için: 
       <a href="https://console.cloud.google.com/google/maps-apis/credentials" target="_blank" class="text-primary hover:underline font-medium">Google Cloud Console</a>
      </p>
     </div>
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
     <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
      <!-- Şehir Seçimi -->
      <div>
       <label class="form-label text-sm font-medium text-gray-700 mb-2">
        Şehir <span class="text-danger">*</span>
       </label>
       <label class="input">
        <i class="ki-filled ki-geolocation text-gray-500"></i>
        <input type="text" id="sehir-input" placeholder="Örn: Ankara, İstanbul, Bursa" required>
       </label>
       <div class="form-text text-xs text-gray-500 mt-1.5">Arama yapılacak şehri girin</div>
      </div>
      
      <!-- İş Kolu Seçimi -->
      <div>
       <label class="form-label text-sm font-medium text-gray-700 mb-2">
        İş Kolu / Sektör <span class="text-danger">*</span>
       </label>
       <label class="input">
        <i class="ki-filled ki-briefcase text-gray-500"></i>
        <input type="text" id="is-kolu-input" placeholder="Örn: Diş Klinikleri, Oto Servisleri, Restoran" required>
       </label>
       <div class="form-text text-xs text-gray-500 mt-1.5">Aranacak iş kolunu veya sektörü girin</div>
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
   <div class="card-header flex-wrap gap-2">
    <h3 class="card-title font-medium text-sm">
     Arama Durumu
    </h3>
   </div>
   <div class="card-body">
    <div class="flex items-center gap-4">
     <div class="flex-shrink-0">
      <i class="ki-filled ki-loading text-3xl text-primary animate-spin"></i>
     </div>
     <div class="flex-1">
      <h4 class="text-base font-semibold text-gray-900 mb-1">Arama Devam Ediyor...</h4>
      <p class="text-sm text-gray-600 mb-3" id="arama-durum-mesaji">İşletmeler taranıyor...</p>
      <div class="progress mb-3" style="height: 10px; border-radius: 5px; overflow: hidden;">
       <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" id="arama-progress" style="width: 0%"></div>
      </div>
      <div class="flex flex-wrap items-center gap-4 text-xs">
       <div class="flex items-center gap-2">
        <span class="badge badge-primary badge-sm">Bulunan</span>
        <strong class="text-gray-900" id="bulunan-sayisi">0</strong>
       </div>
       <div class="flex items-center gap-2">
        <span class="badge badge-success badge-sm">Kaydedilen</span>
        <strong class="text-gray-900" id="kaydedilen-sayisi">0</strong>
       </div>
       <div class="flex items-center gap-2">
        <span class="badge badge-danger badge-sm">Hata</span>
        <strong class="text-gray-900" id="hata-sayisi">0</strong>
       </div>
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
     <span class="badge badge-primary badge-sm ms-2" id="bulunan-sayisi-badge">0</span>
    </h3>
    <div class="flex items-center gap-2 ms-auto">
     <button type="button" class="btn btn-sm btn-primary" id="tumunu-kaydet-btn">
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
    <div class="scrollable-x-auto">
     <table class="table table-auto table-border" id="isletme-listesi-tablo">
      <thead>
       <tr>
        <th class="min-w-[50px]">
         <span class="sort">
          <span class="sort-label font-normal text-gray-700">#</span>
         </span>
        </th>
        <th class="min-w-[200px]">
         <span class="sort">
          <span class="sort-label font-normal text-gray-700">İşletme Adı</span>
         </span>
        </th>
        <th class="min-w-[150px]">
         <span class="sort">
          <span class="sort-label font-normal text-gray-700">Telefon</span>
         </span>
        </th>
        <th class="min-w-[250px]">
         <span class="sort">
          <span class="sort-label font-normal text-gray-700">Adres</span>
         </span>
        </th>
        <th class="min-w-[150px]">
         <span class="sort">
          <span class="sort-label font-normal text-gray-700">Web Sitesi</span>
         </span>
        </th>
        <th class="min-w-[100px]">
         <span class="sort">
          <span class="sort-label font-normal text-gray-700">Rating</span>
         </span>
        </th>
        <th class="min-w-[120px]">
         <span class="sort-label font-normal text-gray-700">İşlemler</span>
        </th>
       </tr>
      </thead>
      <tbody id="isletme-listesi-tbody">
       <tr>
        <td colspan="7" class="text-center py-8">
         <div class="flex flex-col items-center gap-3">
          <i class="ki-filled ki-magnifier text-4xl text-gray-300"></i>
          <p class="text-sm text-gray-500">Henüz arama yapılmadı. Arama başlatmak için yukarıdaki formu doldurun.</p>
         </div>
        </td>
       </tr>
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
     <span class="badge badge-success badge-sm ms-2" id="kayitli-sayisi-badge">0</span>
    </h3>
    <div class="flex items-center gap-2 ms-auto">
     <button type="button" class="btn btn-sm btn-light" id="listeyi-yenile-btn">
      <i class="ki-filled ki-arrows-circle me-1"></i>
      Yenile
     </button>
    </div>
   </div>
   <div class="card-body">
    <div class="scrollable-x-auto">
     <table class="table table-auto table-border" id="kayitli-musteri-tablo">
      <thead>
       <tr>
        <th class="min-w-[50px]">
         <span class="sort">
          <span class="sort-label font-normal text-gray-700">#</span>
         </span>
        </th>
        <th class="min-w-[200px]">
         <span class="sort">
          <span class="sort-label font-normal text-gray-700">İşletme Adı</span>
         </span>
        </th>
        <th class="min-w-[150px]">
         <span class="sort">
          <span class="sort-label font-normal text-gray-700">Telefon</span>
         </span>
        </th>
        <th class="min-w-[250px]">
         <span class="sort">
          <span class="sort-label font-normal text-gray-700">Adres</span>
         </span>
        </th>
        <th class="min-w-[150px]">
         <span class="sort">
          <span class="sort-label font-normal text-gray-700">İş Kolu</span>
         </span>
        </th>
        <th class="min-w-[120px]">
         <span class="sort">
          <span class="sort-label font-normal text-gray-700">Durum</span>
         </span>
        </th>
        <th class="min-w-[150px]">
         <span class="sort">
          <span class="sort-label font-normal text-gray-700">Tarih</span>
         </span>
        </th>
        <th class="min-w-[100px]">
         <span class="sort-label font-normal text-gray-700">İşlemler</span>
        </th>
       </tr>
      </thead>
      <tbody id="kayitli-musteri-tbody">
       <tr>
        <td colspan="8" class="text-center py-8">
         <div class="flex flex-col items-center gap-3">
          <i class="ki-filled ki-user text-4xl text-gray-300"></i>
          <p class="text-sm text-gray-500">Henüz kayıtlı potansiyel müşteri bulunmamaktadır.</p>
         </div>
        </td>
       </tr>
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
              const badge = document.getElementById('bulunan-sayisi-badge');
              if(badge) badge.textContent = bulunanIsletmeler.length;
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
    
    if(bulunanIsletmeler.length === 0) {
      tbody.innerHTML = `
        <tr>
          <td colspan="7" class="text-center py-8">
            <div class="flex flex-col items-center gap-3">
              <i class="ki-filled ki-information-2 text-4xl text-gray-300"></i>
              <p class="text-sm text-gray-500">Henüz işletme bulunamadı.</p>
            </div>
          </td>
        </tr>
      `;
      const badge = document.getElementById('bulunan-sayisi-badge');
      if(badge) badge.textContent = '0';
      return;
    }
    
    bulunanIsletmeler.forEach(function(isletme, index) {
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td class="font-normal text-gray-800">${index + 1}</td>
        <td>
          <div class="flex flex-col">
            <strong class="text-sm font-medium text-gray-900 mb-px">${escapeHtml(isletme.name)}</strong>
          </div>
        </td>
        <td class="font-normal text-gray-800">
          ${escapeHtml(isletme.phone || '-')}
        </td>
        <td class="font-normal text-gray-600 text-sm">
          ${escapeHtml(isletme.address || '-')}
        </td>
        <td>
          ${isletme.website ? `
            <a href="${isletme.website}" target="_blank" class="text-sm text-primary hover:text-primary-active hover:underline">
              ${escapeHtml(isletme.website.length > 30 ? isletme.website.substring(0, 30) + '...' : isletme.website)}
            </a>
          ` : '<span class="text-gray-400">-</span>'}
        </td>
        <td>
          ${isletme.rating ? `
            <div class="flex items-center gap-1.5">
              <span class="badge badge-success badge-sm">${isletme.rating}</span>
              <span class="text-xs text-gray-500">(${isletme.user_ratings_total})</span>
            </div>
          ` : '<span class="text-gray-400">-</span>'}
        </td>
        <td>
          <button type="button" class="btn btn-sm btn-primary" onclick="tekKaydet(${index})">
            <i class="ki-filled ki-check me-1"></i>
            Kaydet
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
        
        if(!data.musteriler || data.musteriler.length === 0) {
          tbody.innerHTML = `
            <tr>
              <td colspan="8" class="text-center py-8">
                <div class="flex flex-col items-center gap-3">
                  <i class="ki-filled ki-user text-4xl text-gray-300"></i>
                  <p class="text-sm text-gray-500">Henüz kayıtlı potansiyel müşteri bulunmamaktadır.</p>
                </div>
              </td>
            </tr>
          `;
          const kayitliBadge = document.getElementById('kayitli-sayisi-badge');
          if(kayitliBadge) kayitliBadge.textContent = '0';
          return;
        }
        
        // Kayıtlı sayısını güncelle
        const kayitliBadge = document.getElementById('kayitli-sayisi-badge');
        if(kayitliBadge) kayitliBadge.textContent = data.musteriler.length;
        
        data.musteriler.forEach(function(musteri, index) {
          const tr = document.createElement('tr');
          const durumBadge = {
            'yeni': '<span class="badge badge-primary badge-sm">Yeni</span>',
            'aranmis': '<span class="badge badge-info badge-sm">Arandı</span>',
            'ilgileniyor': '<span class="badge badge-warning badge-sm">İlgileniyor</span>',
            'musteri_oldu': '<span class="badge badge-success badge-sm">Müşteri Oldu</span>',
            'iptal': '<span class="badge badge-danger badge-sm">İptal</span>'
          }[musteri.durum] || '<span class="badge badge-secondary badge-sm">-</span>';
          
          tr.innerHTML = `
            <td class="font-normal text-gray-800">${index + 1}</td>
            <td>
              <div class="flex flex-col">
                <strong class="text-sm font-medium text-gray-900 mb-px">${escapeHtml(musteri.isletme_adi)}</strong>
              </div>
            </td>
            <td class="font-normal text-gray-800">
              ${escapeHtml(musteri.telefon_numarasi || '-')}
            </td>
            <td class="font-normal text-gray-600 text-sm">
              ${escapeHtml(musteri.adres || '-')}
            </td>
            <td>
              <span class="badge badge-sm">${escapeHtml(musteri.is_kolu || '-')}</span>
            </td>
            <td>${durumBadge}</td>
            <td class="font-normal text-gray-600 text-sm">
              ${musteri.olusturma_tarihi || '-'}
            </td>
            <td>
              <button type="button" class="btn btn-sm btn-light btn-icon btn-clear" onclick="musteriDetay(${musteri.potansiyel_musteri_id})" title="Detay Görüntüle">
                <i class="ki-filled ki-eye text-sm"></i>
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
