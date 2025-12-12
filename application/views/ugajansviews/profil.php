<!-- Container -->
<div class="container-fixed" id="content_container">
</div>
<!-- End of Container -->

<!-- Container -->
<div class="container-fixed">
 <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
  <div class="flex flex-col justify-center gap-2">
   <h1 class="text-xl font-medium leading-none text-gray-900">
    Profil Ayarları
   </h1>
   <div class="flex items-center gap-2 text-sm font-normal text-gray-700">
    Profil bilgilerinizi ve fotoğrafınızı buradan düzenleyebilirsiniz.
   </div>
  </div>
 </div>
</div>
<!-- End of Container -->

<!-- Container -->
<div class="container-fixed">
 <div class="grid gap-5 lg:gap-7.5">
  <div class="card card-grid min-w-full">
   <div class="card-header flex-wrap gap-2">
    <h3 class="card-title font-medium text-sm">
     Profil Bilgileri
    </h3>
   </div>
   <div class="card-body">
    <form action="<?=base_url("ugajans_anasayfa/profil_guncelle")?>" method="post" enctype="multipart/form-data">
     <div class="grid gap-5 lg:gap-7.5">
      
      <!-- Profil Fotoğrafı -->
      <div class="card card-grid">
       <div class="card-header">
        <h4 class="card-title font-medium text-sm">Profil Fotoğrafı</h4>
       </div>
       <div class="card-body">
        <div class="flex flex-col items-center gap-5">
         <div class="relative">
          <img id="profil_fotografi_preview" 
               class="rounded-full border-4 border-primary size-32 object-cover" 
               src="<?=($kullanici->ugajans_kullanici_gorsel && $kullanici->ugajans_kullanici_gorsel != "") ? base_url($kullanici->ugajans_kullanici_gorsel) : base_url("ugajansassets/assets/media/avatars/300-1.png")?>" 
               alt="Profil Fotoğrafı">
          <div class="absolute bottom-0 end-0">
           <label for="profil_fotografi" class="btn btn-icon btn-sm btn-primary rounded-full cursor-pointer">
            <i class="ki-filled ki-camera"></i>
           </label>
           <input type="file" id="profil_fotografi" name="profil_fotografi" accept="image/*" class="hidden" onchange="previewImage(this)">
          </div>
         </div>
         <div class="text-center">
          <p class="text-sm text-gray-600 mb-2">Profil fotoğrafınızı değiştirmek için yukarıdaki kamera ikonuna tıklayın.</p>
          <p class="text-xs text-gray-500">İzin verilen formatlar: JPG, PNG, GIF (Max: 2MB)</p>
         </div>
        </div>
       </div>
      </div>

      <!-- Kişisel Bilgiler -->
      <div class="card card-grid">
       <div class="card-header">
        <h4 class="card-title font-medium text-sm">Kişisel Bilgiler</h4>
       </div>
       <div class="card-body">
        <div class="grid gap-5">
         <div class="flex flex-col gap-2">
          <label class="text-sm font-medium text-gray-700">
           Ad Soyad <span class="text-danger">*</span>
          </label>
          <input type="text" 
                 class="input" 
                 name="ugajans_kullanici_ad_soyad" 
                 value="<?=htmlspecialchars($kullanici->ugajans_kullanici_ad_soyad ?? '')?>" 
                 required>
         </div>
         
         <div class="flex flex-col gap-2">
          <label class="text-sm font-medium text-gray-700">
           Kullanıcı Adı
          </label>
          <input type="text" 
                 class="input" 
                 value="<?=htmlspecialchars($kullanici->ugajans_kullanici_adi ?? '')?>" 
                 disabled>
          <small class="text-xs text-gray-500">Kullanıcı adı değiştirilemez</small>
         </div>

         <?php 
         $columns = $this->db->list_fields('ugajans_kullanicilar');
         if (in_array('ugajans_kullanici_email', $columns)): 
         ?>
         <div class="flex flex-col gap-2">
          <label class="text-sm font-medium text-gray-700">
           E-posta Adresi
          </label>
          <input type="email" 
                 class="input" 
                 name="ugajans_kullanici_email" 
                 value="<?=htmlspecialchars($kullanici->ugajans_kullanici_email ?? '')?>">
         </div>
         <?php endif; ?>

         <?php if (in_array('ugajans_kullanici_telefon', $columns)): ?>
         <div class="flex flex-col gap-2">
          <label class="text-sm font-medium text-gray-700">
           Telefon Numarası
          </label>
          <input type="tel" 
                 class="input" 
                 name="ugajans_kullanici_telefon" 
                 value="<?=htmlspecialchars($kullanici->ugajans_kullanici_telefon ?? '')?>">
         </div>
         <?php endif; ?>
        </div>
       </div>
      </div>

      <!-- Şifre Değiştirme -->
      <div class="card card-grid">
       <div class="card-header">
        <h4 class="card-title font-medium text-sm">Şifre Değiştirme</h4>
       </div>
       <div class="card-body">
        <div class="grid gap-5">
         <div class="flex flex-col gap-2">
          <label class="text-sm font-medium text-gray-700">
           Mevcut Şifre
          </label>
          <input type="password" 
                 class="input" 
                 name="mevcut_sifre" 
                 placeholder="Şifrenizi değiştirmek için mevcut şifrenizi girin">
          <small class="text-xs text-gray-500">Şifrenizi değiştirmek istemiyorsanız bu alanları boş bırakın</small>
         </div>
         
         <div class="flex flex-col gap-2">
          <label class="text-sm font-medium text-gray-700">
           Yeni Şifre
          </label>
          <input type="password" 
                 class="input" 
                 name="yeni_sifre" 
                 id="yeni_sifre"
                 placeholder="Yeni şifrenizi girin">
         </div>
         
         <div class="flex flex-col gap-2">
          <label class="text-sm font-medium text-gray-700">
           Yeni Şifre (Tekrar)
          </label>
          <input type="password" 
                 class="input" 
                 name="yeni_sifre_tekrar" 
                 placeholder="Yeni şifrenizi tekrar girin">
         </div>
        </div>
       </div>
      </div>

      <!-- Form Butonları -->
      <div class="flex items-center justify-end gap-2.5">
       <a href="<?=base_url("ugajans_anasayfa")?>" class="btn btn-light">
        <i class="ki-filled ki-cross"></i>
        İptal
       </a>
       <button type="submit" class="btn btn-primary">
        <i class="ki-filled ki-check"></i>
        Kaydet
       </button>
      </div>
     </div>
    </form>
   </div>
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
     alert('Şifre değiştirmek için mevcut şifrenizi girmelisiniz.');
     return false;
    }
    
    if (yeniSifre !== yeniSifreTekrar) {
     e.preventDefault();
     alert('Yeni şifreler eşleşmiyor.');
     return false;
    }
    
    if (yeniSifre.length < 6) {
     e.preventDefault();
     alert('Yeni şifre en az 6 karakter olmalıdır.');
     return false;
    }
   }
   
   return true;
  });
 }
});
</script>

<style>
.card-grid {
 background: white;
 border-radius: 12px;
 box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.card-header {
 padding: 20px 24px;
 border-bottom: 1px solid #e5e7eb;
}

.card-body {
 padding: 24px;
}

.input {
 width: 100%;
 padding: 10px 14px;
 border: 1px solid #d1d5db;
 border-radius: 8px;
 font-size: 14px;
 transition: all 0.2s;
}

.input:focus {
 outline: none;
 border-color: #0d6efd;
 box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
}

.input:disabled {
 background-color: #f3f4f6;
 cursor: not-allowed;
}
</style>

