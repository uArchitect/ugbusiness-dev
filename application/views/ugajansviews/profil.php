
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
     <div class="grid gap-5">
      
      <!-- Profil Fotoğrafı -->
      <div class="flex flex-col items-center gap-5 py-5 border-b border-gray-200">
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

      <!-- Kişisel Bilgiler -->
      <div class="grid gap-5">
       <div class="flex items-center flex-wrap lg:flex-nowrap gap-2.5">
        <label class="form-label max-w-25" style="max-width:150px">
         Ad Soyad <span class="text-danger">*</span> :
        </label>
        <div class="grow">
         <label class="input">
          <input type="text" 
                 name="ugajans_kullanici_ad_soyad" 
                 value="<?=htmlspecialchars($kullanici->ugajans_kullanici_ad_soyad ?? '')?>" 
                 placeholder="Ad Soyad"
                 required>
         </label>
        </div>
       </div>
       
       <div class="flex items-center flex-wrap lg:flex-nowrap gap-2.5">
        <label class="form-label max-w-25" style="max-width:150px">
         Kullanıcı Adı :
        </label>
        <div class="grow">
         <label class="input">
          <input type="text" 
                 value="<?=htmlspecialchars($kullanici->ugajans_kullanici_adi ?? '')?>" 
                 placeholder="Kullanıcı Adı"
                 disabled>
         </label>
         <small class="text-xs text-gray-500 mt-1 block">Kullanıcı adı değiştirilemez</small>
        </div>
       </div>

       <?php 
       $columns = $this->db->list_fields('ugajans_kullanicilar');
       if (in_array('ugajans_kullanici_email', $columns)): 
       ?>
       <div class="flex items-center flex-wrap lg:flex-nowrap gap-2.5">
        <label class="form-label max-w-25" style="max-width:150px">
         E-posta Adresi :
        </label>
        <div class="grow">
         <label class="input">
          <input type="email" 
                 name="ugajans_kullanici_email" 
                 value="<?=htmlspecialchars($kullanici->ugajans_kullanici_email ?? '')?>"
                 placeholder="E-posta Adresi">
         </label>
        </div>
       </div>
       <?php endif; ?>

       <?php if (in_array('ugajans_kullanici_telefon', $columns)): ?>
       <div class="flex items-center flex-wrap lg:flex-nowrap gap-2.5">
        <label class="form-label max-w-25" style="max-width:150px">
         Telefon Numarası :
        </label>
        <div class="grow">
         <label class="input">
          <input type="tel" 
                 name="ugajans_kullanici_telefon" 
                 value="<?=htmlspecialchars($kullanici->ugajans_kullanici_telefon ?? '')?>"
                 placeholder="Telefon Numarası">
         </label>
        </div>
       </div>
       <?php endif; ?>
      </div>

      <!-- Şifre Değiştirme -->
      <div class="border-t border-gray-200 pt-5">
       <h4 class="text-sm font-semibold text-gray-900 mb-5">Şifre Değiştirme</h4>
       <div class="grid gap-5">
        <div class="flex items-center flex-wrap lg:flex-nowrap gap-2.5">
         <label class="form-label max-w-25" style="max-width:150px">
          Mevcut Şifre :
         </label>
         <div class="grow">
          <label class="input">
           <input type="password" 
                  name="mevcut_sifre" 
                  placeholder="Şifrenizi değiştirmek için mevcut şifrenizi girin">
          </label>
          <small class="text-xs text-gray-500 mt-1 block">Şifrenizi değiştirmek istemiyorsanız bu alanları boş bırakın</small>
         </div>
        </div>
        
        <div class="flex items-center flex-wrap lg:flex-nowrap gap-2.5">
         <label class="form-label max-w-25" style="max-width:150px">
          Yeni Şifre :
         </label>
         <div class="grow">
          <label class="input">
           <input type="password" 
                  name="yeni_sifre" 
                  id="yeni_sifre"
                  placeholder="Yeni şifrenizi girin">
          </label>
         </div>
        </div>
        
        <div class="flex items-center flex-wrap lg:flex-nowrap gap-2.5">
         <label class="form-label max-w-25" style="max-width:150px">
          Yeni Şifre (Tekrar) :
         </label>
         <div class="grow">
          <label class="input">
           <input type="password" 
                  name="yeni_sifre_tekrar" 
                  placeholder="Yeni şifrenizi tekrar girin">
          </label>
         </div>
        </div>
       </div>
      </div>

      <!-- Form Butonları -->
      <div class="flex items-center justify-end gap-2.5 pt-5 border-t border-gray-200">
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
