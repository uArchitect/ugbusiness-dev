
<div class="container-fixed" id="content_container">
</div>
<!-- End of Container -->

<!-- Container -->
<div class="container-fixed">
 <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
  <div class="flex flex-col justify-center gap-2">
   <h1 class="text-2xl font-semibold leading-none text-gray-900">
    <i class="ki-filled ki-profile-user text-primary me-2"></i>
    Profil Ayarları
   </h1>
   <div class="flex items-center gap-2 text-sm font-normal text-gray-600">
    <i class="ki-filled ki-information-2 text-gray-400"></i>
    Profil bilgilerinizi ve fotoğrafınızı buradan düzenleyebilirsiniz.
   </div>
  </div>
 </div>
</div>
<!-- End of Container -->

<!-- Container -->
<div class="container-fixed">
 <div class="grid gap-5 lg:gap-7.5">
  
  <!-- Profil Fotoğrafı Kartı -->
  <div class="card card-grid min-w-full">
   <div class="card-header flex-wrap gap-2">
    <h3 class="card-title font-medium text-sm">
     <i class="ki-filled ki-picture text-primary me-2"></i>
     Profil Fotoğrafı
    </h3>
   </div>
   <div class="card-body">
    <div class="flex flex-col items-center gap-6 py-4">
     <div class="relative group">
      <div class="absolute inset-0 rounded-full bg-primary/10 blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
      <img id="profil_fotografi_preview" 
           class="relative rounded-full border-4 border-primary size-40 object-cover shadow-lg transition-transform duration-300 group-hover:scale-105" 
           src="<?=($kullanici->ugajans_kullanici_gorsel && $kullanici->ugajans_kullanici_gorsel != "") ? base_url($kullanici->ugajans_kullanici_gorsel) : base_url("ugajansassets/assets/media/avatars/300-1.png")?>" 
           alt="Profil Fotoğrafı">
      <div class="absolute bottom-0 end-0 bg-white rounded-full p-1 shadow-lg">
       <label for="profil_fotografi" class="btn btn-icon btn-sm btn-primary rounded-full cursor-pointer hover:scale-110 transition-transform">
        <i class="ki-filled ki-camera text-lg"></i>
       </label>
       <input type="file" id="profil_fotografi" name="profil_fotografi" accept="image/*" class="hidden" onchange="previewImage(this)">
      </div>
     </div>
     <div class="text-center max-w-md">
      <p class="text-sm text-gray-700 mb-1 font-medium">Profil fotoğrafınızı güncelleyin</p>
      <p class="text-xs text-gray-500">Kamera ikonuna tıklayarak yeni bir fotoğraf yükleyebilirsiniz. İzin verilen formatlar: JPG, PNG, GIF (Maksimum: 2MB)</p>
     </div>
    </div>
   </div>
  </div>

  <!-- Kişisel Bilgiler Kartı -->
  <div class="card card-grid min-w-full">
   <div class="card-header flex-wrap gap-2">
    <h3 class="card-title font-medium text-sm">
     <i class="ki-filled ki-user text-primary me-2"></i>
     Kişisel Bilgiler
    </h3>
   </div>
   <div class="card-body">
    <form action="<?=base_url("ugajans_anasayfa/profil_guncelle")?>" method="post" enctype="multipart/form-data" id="profilForm">
     <div class="grid gap-6">
      
      <!-- Ad Soyad -->
      <div class="flex flex-col sm:flex-row sm:items-center gap-3">
       <label class="form-label min-w-[140px] flex items-center gap-2">
        <i class="ki-filled ki-user text-gray-400 text-sm"></i>
        <span>Ad Soyad <span class="text-danger">*</span></span>
       </label>
       <div class="flex-1">
        <label class="input">
         <input type="text" 
                name="ugajans_kullanici_ad_soyad" 
                value="<?=htmlspecialchars($kullanici->ugajans_kullanici_ad_soyad ?? '')?>" 
                placeholder="Adınızı ve soyadınızı girin"
                required
                class="focus:ring-2 focus:ring-primary/20">
        </label>
       </div>
      </div>
      
      <!-- Kullanıcı Adı -->
      <div class="flex flex-col sm:flex-row sm:items-center gap-3">
       <label class="form-label min-w-[140px] flex items-center gap-2">
        <i class="ki-filled ki-profile-circle text-gray-400 text-sm"></i>
        <span>Kullanıcı Adı</span>
       </label>
       <div class="flex-1">
        <label class="input">
         <input type="text" 
                value="<?=htmlspecialchars($kullanici->ugajans_kullanici_adi ?? '')?>" 
                placeholder="Kullanıcı adınız"
                disabled
                class="bg-gray-50 cursor-not-allowed">
        </label>
        <small class="text-xs text-gray-500 mt-1.5 flex items-center gap-1">
         <i class="ki-filled ki-information-2 text-xs"></i>
         Kullanıcı adı değiştirilemez
        </small>
       </div>
      </div>

      <?php 
      $columns = $this->db->list_fields('ugajans_kullanicilar');
      if (in_array('ugajans_kullanici_email', $columns)): 
      ?>
      <!-- E-posta -->
      <div class="flex flex-col sm:flex-row sm:items-center gap-3">
       <label class="form-label min-w-[140px] flex items-center gap-2">
        <i class="ki-filled ki-sms text-gray-400 text-sm"></i>
        <span>E-posta Adresi</span>
       </label>
       <div class="flex-1">
        <label class="input">
         <input type="email" 
                name="ugajans_kullanici_email" 
                value="<?=htmlspecialchars($kullanici->ugajans_kullanici_email ?? '')?>"
                placeholder="ornek@email.com"
                class="focus:ring-2 focus:ring-primary/20">
        </label>
       </div>
      </div>
      <?php endif; ?>

      <?php if (in_array('ugajans_kullanici_telefon', $columns)): ?>
      <!-- Telefon -->
      <div class="flex flex-col sm:flex-row sm:items-center gap-3">
       <label class="form-label min-w-[140px] flex items-center gap-2">
        <i class="ki-filled ki-phone text-gray-400 text-sm"></i>
        <span>Telefon Numarası</span>
       </label>
       <div class="flex-1">
        <label class="input">
         <input type="tel" 
                name="ugajans_kullanici_telefon" 
                value="<?=htmlspecialchars($kullanici->ugajans_kullanici_telefon ?? '')?>"
                placeholder="05XX XXX XX XX"
                class="focus:ring-2 focus:ring-primary/20">
        </label>
       </div>
      </div>
      <?php endif; ?>
     </div>
    </form>
   </div>
  </div>

  <!-- Şifre Değiştirme Kartı -->
  <div class="card card-grid min-w-full">
   <div class="card-header flex-wrap gap-2">
    <h3 class="card-title font-medium text-sm">
     <i class="ki-filled ki-lock text-primary me-2"></i>
     Şifre Değiştirme
    </h3>
   </div>
   <div class="card-body">
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
     <div class="flex items-start gap-3">
      <i class="ki-filled ki-information-2 text-blue-500 text-lg mt-0.5"></i>
      <div>
       <p class="text-sm font-medium text-blue-900 mb-1">Şifre Değiştirme Hakkında</p>
       <p class="text-xs text-blue-700">Şifrenizi değiştirmek istemiyorsanız aşağıdaki alanları boş bırakabilirsiniz. Şifre değiştirmek için mevcut şifrenizi girmeniz gerekmektedir.</p>
      </div>
     </div>
    </div>
    
    <div class="grid gap-6">
     <!-- Mevcut Şifre -->
     <div class="flex flex-col sm:flex-row sm:items-center gap-3">
      <label class="form-label min-w-[140px] flex items-center gap-2">
       <i class="ki-filled ki-lock text-gray-400 text-sm"></i>
       <span>Mevcut Şifre</span>
      </label>
      <div class="flex-1">
       <label class="input">
        <input type="password" 
               name="mevcut_sifre" 
               id="mevcut_sifre"
               placeholder="Mevcut şifrenizi girin"
               class="focus:ring-2 focus:ring-primary/20">
       </label>
      </div>
     </div>
     
     <!-- Yeni Şifre -->
     <div class="flex flex-col sm:flex-row sm:items-center gap-3">
      <label class="form-label min-w-[140px] flex items-center gap-2">
       <i class="ki-filled ki-key text-gray-400 text-sm"></i>
       <span>Yeni Şifre</span>
      </label>
      <div class="flex-1">
       <label class="input">
        <input type="password" 
               name="yeni_sifre" 
               id="yeni_sifre"
               placeholder="Yeni şifrenizi girin (Min. 6 karakter)"
               class="focus:ring-2 focus:ring-primary/20">
       </label>
       <small class="text-xs text-gray-500 mt-1.5 flex items-center gap-1">
        <i class="ki-filled ki-information-2 text-xs"></i>
        Şifre en az 6 karakter olmalıdır
       </small>
      </div>
     </div>
     
     <!-- Yeni Şifre Tekrar -->
     <div class="flex flex-col sm:flex-row sm:items-center gap-3">
      <label class="form-label min-w-[140px] flex items-center gap-2">
       <i class="ki-filled ki-key text-gray-400 text-sm"></i>
       <span>Yeni Şifre (Tekrar)</span>
      </label>
      <div class="flex-1">
       <label class="input">
        <input type="password" 
               name="yeni_sifre_tekrar" 
               id="yeni_sifre_tekrar"
               placeholder="Yeni şifrenizi tekrar girin"
               class="focus:ring-2 focus:ring-primary/20">
       </label>
      </div>
     </div>
    </div>
   </div>
  </div>

  <!-- Form Butonları -->
  <div class="flex items-center justify-end gap-3 pt-2">
   <a href="<?=base_url("ugajans_anasayfa")?>" class="btn btn-light btn-lg">
    <i class="ki-filled ki-cross"></i>
    İptal
   </a>
   <button type="submit" form="profilForm" class="btn btn-primary btn-lg">
    <i class="ki-filled ki-check"></i>
    Değişiklikleri Kaydet
   </button>
  </div>

 </div>
</div>
<!-- End of Container -->

<script>
function previewImage(input) {
 if (input.files && input.files[0]) {
  const reader = new FileReader();
  
  reader.onload = function(e) {
   document.getElementById('profil_fotografi_preview').src = e.target.result;
  };
  
  reader.readAsDataURL(input.files[0]);
 }
}

// Form validasyonu
document.addEventListener('DOMContentLoaded', function() {
 const form = document.querySelector('form[action*="profil_guncelle"]');
 if (form) {
  form.addEventListener('submit', function(e) {
   const yeniSifre = document.getElementById('yeni_sifre').value;
   const yeniSifreTekrar = document.querySelector('input[name="yeni_sifre_tekrar"]').value;
   const mevcutSifre = document.querySelector('input[name="mevcut_sifre"]').value;
   
   // Şifre değiştirme kontrolü
   if (yeniSifre || yeniSifreTekrar || mevcutSifre) {
    if (!mevcutSifre) {
     e.preventDefault();
     if (typeof Swal !== 'undefined') {
      Swal.fire({
       icon: 'error',
       title: 'Hata',
       text: 'Şifre değiştirmek için mevcut şifrenizi girmelisiniz.'
      });
     } else {
      alert('Şifre değiştirmek için mevcut şifrenizi girmelisiniz.');
     }
     return false;
    }
    
    if (yeniSifre !== yeniSifreTekrar) {
     e.preventDefault();
     if (typeof Swal !== 'undefined') {
      Swal.fire({
       icon: 'error',
       title: 'Hata',
       text: 'Yeni şifreler eşleşmiyor.'
      });
     } else {
      alert('Yeni şifreler eşleşmiyor.');
     }
     return false;
    }
    
    if (yeniSifre.length < 6) {
     e.preventDefault();
     if (typeof Swal !== 'undefined') {
      Swal.fire({
       icon: 'error',
       title: 'Hata',
       text: 'Yeni şifre en az 6 karakter olmalıdır.'
      });
     } else {
      alert('Yeni şifre en az 6 karakter olmalıdır.');
     }
     return false;
    }
   }
   
   return true;
  });
 }
});
</script>
