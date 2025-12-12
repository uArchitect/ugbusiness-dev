<!-- Container -->
<div class="container-fixed" id="content_container">
</div>
<!-- End of Container -->

<style>
.hero-bg {
 background-image: url('<?=base_url()?>/ugajansassets/assets/media/images/2600x1200/bg-1.png');
}
.dark .hero-bg {
 background-image: url('<?=base_url()?>/ugajansassets/assets/media/images/2600x1200/bg-1-dark.png');
}
</style>

<div class="bg-center bg-cover bg-no-repeat hero-bg">
 <!-- Container -->
 <div class="container-fixed">
  <div class="flex flex-col items-center gap-2 lg:gap-3.5 py-4 lg:pt-5 lg:pb-10">
   <img class="rounded-full border-3 border-primary size-[100px] shrink-0 cursor-pointer" 
        src="<?=($kullanici->ugajans_kullanici_gorsel && $kullanici->ugajans_kullanici_gorsel != "") ? base_url($kullanici->ugajans_kullanici_gorsel) : base_url("ugajansassets/assets/media/avatars/300-1.png")?>" 
        id="profil_fotografi_preview"
        alt="Profil Fotoğrafı">
   <div class="flex items-center gap-1.5">
    <div class="text-lg leading-5 font-semibold text-gray-900">
     <?=htmlspecialchars($kullanici->ugajans_kullanici_ad_soyad ?? 'Kullanıcı')?>
    </div>
    <svg class="text-primary" fill="none" height="16" viewbox="0 0 15 16" width="15" xmlns="http://www.w3.org/2000/svg">
     <path d="M14.5425 6.89749L13.5 5.83999C13.4273 5.76877 13.3699 5.6835 13.3312 5.58937C13.2925 5.49525 13.2734 5.39424 13.275 5.29249V3.79249C13.274 3.58699 13.2324 3.38371 13.1527 3.19432C13.0729 3.00494 12.9565 2.83318 12.8101 2.68892C12.6638 2.54466 12.4904 2.43073 12.2998 2.35369C12.1093 2.27665 11.9055 2.23801 11.7 2.23999H10.2C10.0982 2.24159 9.99722 2.22247 9.9031 2.18378C9.80898 2.1451 9.72371 2.08767 9.65249 2.01499L8.60249 0.957487C8.30998 0.665289 7.91344 0.50116 7.49999 0.50116C7.08654 0.50116 6.68999 0.665289 6.39749 0.957487L5.33999 1.99999C5.26876 2.07267 5.1835 2.1301 5.08937 2.16879C4.99525 2.20747 4.89424 2.22659 4.79249 2.22499H3.29249C3.08699 2.22597 2.88371 2.26754 2.69432 2.34731C2.50494 2.42709 2.33318 2.54349 2.18892 2.68985C2.04466 2.8362 1.93073 3.00961 1.85369 3.20013C1.77665 3.39064 1.73801 3.5945 1.73999 3.79999V5.29999C1.74159 5.40174 1.72247 5.50275 1.68378 5.59687C1.6451 5.691 1.58767 5.77627 1.51499 5.84749L0.457487 6.89749C0.165289 7.19 0.00115967 7.58654 0.00115967 7.99999C0.00115967 8.41344 0.165289 8.80998 0.457487 9.10249L1.49999 10.16C1.57267 10.2312 1.6301 10.3165 1.66878 10.4106C1.70747 10.5047 1.72659 10.6057 1.72499 10.7075V12.2075C1.72597 12.413 1.76754 12.6163 1.84731 12.8056C1.92709 12.995 2.04349 13.1668 2.18985 13.3111C2.3362 13.4553 2.50961 13.5692 2.70013 13.6463C2.89064 13.7233 3.0945 13.762 3.29999 13.76H4.79999C4.90174 13.7584 5.00275 13.7775 5.09687 13.8162C5.191 13.8549 5.27627 13.9123 5.34749 13.985L6.40499 15.0425C6.69749 15.3347 7.09404 15.4988 7.50749 15.4988C7.92094 15.4988 8.31748 15.3347 8.60999 15.0425L9.65999 14C9.73121 13.9273 9.81647 13.8699 9.9106 13.8312C10.0047 13.7925 10.1057 13.7734 10.2075 13.775H11.7075C12.1212 13.775 12.518 13.6106 12.8106 13.3181C13.1031 13.0255 13.2675 12.6287 13.2675 12.215V10.715C13.2659 10.6132 13.285 10.5122 13.3237 10.4181C13.3624 10.324 13.4198 10.2387 13.4925 10.1675L14.55 9.10999C14.6953 8.96452 14.8104 8.79176 14.8887 8.60164C14.9671 8.41152 15.007 8.20779 15.0063 8.00218C15.0056 7.79656 14.9643 7.59311 14.8847 7.40353C14.8051 7.21394 14.6888 7.04197 14.5425 6.89749ZM10.635 6.64999L6.95249 10.25C6.90055 10.3026 6.83864 10.3443 6.77038 10.3726C6.70212 10.4009 6.62889 10.4153 6.55499 10.415C6.48062 10.4139 6.40719 10.3982 6.33896 10.3685C6.27073 10.3389 6.20905 10.2961 6.15749 10.2425L4.37999 8.44249C4.32532 8.39044 4.28169 8.32793 4.25169 8.25867C4.22169 8.18941 4.20593 8.11482 4.20536 8.03934C4.20479 7.96387 4.21941 7.88905 4.24836 7.81934C4.27731 7.74964 4.31999 7.68647 4.37387 7.63361C4.42774 7.58074 4.4917 7.53926 4.56194 7.51163C4.63218 7.484 4.70726 7.47079 4.78271 7.47278C4.85816 7.47478 4.93244 7.49194 5.00112 7.52324C5.0698 7.55454 5.13148 7.59935 5.18249 7.65499L6.56249 9.05749L9.84749 5.84749C9.95296 5.74215 10.0959 5.68298 10.245 5.68298C10.394 5.68298 10.537 5.74215 10.6425 5.84749C10.6953 5.90034 10.737 5.96318 10.7653 6.03234C10.7935 6.1015 10.8077 6.1756 10.807 6.25031C10.8063 6.32502 10.7908 6.39884 10.7612 6.46746C10.7317 6.53608 10.6888 6.59813 10.635 6.64999Z" fill="currentColor">
     </path>
    </svg>
   </div>
   <div class="flex flex-wrap justify-center gap-1 lg:gap-4.5 text-sm">
    <?php 
    $columns = $this->db->list_fields('ugajans_kullanicilar');
    if (in_array('ugajans_kullanici_telefon', $columns) && !empty($kullanici->ugajans_kullanici_telefon)): 
    ?>
    <div class="flex gap-1.25 items-center">
     <i class="ki-filled ki-phone text-gray-500 text-sm"></i>
     <span class="text-gray-600 font-medium">
      <?=htmlspecialchars($kullanici->ugajans_kullanici_telefon)?>
     </span>
    </div>
    <?php endif; ?>
    
    <?php 
    if (in_array('ugajans_kullanici_email', $columns) && !empty($kullanici->ugajans_kullanici_email)): 
    ?>
    <div class="flex gap-1.25 items-center">
     <i class="ki-filled ki-sms text-gray-500 text-sm"></i>
     <a class="text-gray-600 font-medium hover:text-primary" href="mailto:<?=htmlspecialchars($kullanici->ugajans_kullanici_email)?>">
      <?=htmlspecialchars($kullanici->ugajans_kullanici_email)?>
     </a>
    </div>
    <?php endif; ?>
    
    <div class="flex gap-1.25 items-center">
     <i class="ki-filled ki-profile-circle text-gray-500 text-sm"></i>
     <span class="text-gray-600 font-medium">
      <?=htmlspecialchars($kullanici->ugajans_kullanici_adi ?? '')?>
     </span>
    </div>
   </div>
  </div>
 </div>
 <!-- End of Container -->
</div>

<!-- Container -->
<div class="container-fixed">
 <div class="grid grid-cols-1 gap-5 lg:gap-7.5">
  
  <!-- Ana İçerik -->
  <div class="col-span-1">
   <div class="flex flex-col gap-5 lg:gap-7.5">
    
    <!-- Profil Fotoğrafı Değiştirme Kartı -->
    <div class="card">
     <div class="card-header">
      <h3 class="card-title">
       Profil Fotoğrafı
      </h3>
     </div>
     <div class="card-body px-10 py-7.5 lg:pe-12.5">
      <form action="<?=base_url("ugajans_anasayfa/profil_guncelle")?>" method="post" enctype="multipart/form-data" id="fotografForm">
       <div class="grid gap-5">
        <!-- Şifre Doğrulama -->
        <div class="flex flex-col sm:flex-row sm:items-center gap-3">
         <label class="text-sm text-gray-600 font-semibold min-w-[140px] flex items-center gap-2">
          <i class="ki-filled ki-lock text-gray-400 text-sm"></i>
          <span>Şifre <span class="text-danger">*</span></span>
         </label>
         <div class="flex-1">
          <label class="input">
           <input type="password" 
                  name="fotograf_sifre" 
                  id="fotograf_sifre"
                  placeholder="Fotoğraf değiştirmek için şifrenizi girin"
                  required>
          </label>
          <small class="text-xs text-gray-500 mt-1.5 flex items-center gap-1">
           <i class="ki-filled ki-information-2 text-xs"></i>
           Profil fotoğrafınızı değiştirmek için şifrenizi girmeniz gerekmektedir.
          </small>
         </div>
        </div>
        
        <!-- Fotoğraf Input -->
        <div class="flex flex-col sm:flex-row sm:items-center gap-3">
         <label class="text-sm text-gray-600 font-semibold min-w-[140px] flex items-center gap-2">
          <i class="ki-filled ki-picture text-gray-400 text-sm"></i>
          <span>Yeni Fotoğraf</span>
         </label>
         <div class="flex-1">
          <label class="input">
           <input type="file" 
                  id="profil_fotografi" 
                  name="profil_fotografi" 
                  accept="image/*" 
                  onchange="previewImage(this)">
          </label>
          <small class="text-xs text-gray-500 mt-1.5 flex items-center gap-1">
           <i class="ki-filled ki-information-2 text-xs"></i>
           İzin verilen formatlar: JPG, PNG, GIF (Maksimum: 2MB)
          </small>
         </div>
        </div>
       </div>
      </form>
     </div>
     <div class="card-footer justify-end">
      <button type="submit" form="fotografForm" class="btn btn-primary">
       <i class="ki-filled ki-check"></i>
       Fotoğrafı Güncelle
      </button>
     </div>
    </div>
    
    <!-- Kişisel Bilgiler Kartı -->
    <div class="card">
     <div class="card-header">
      <h3 class="card-title">
       Kişisel Bilgiler
      </h3>
     </div>
     <div class="card-body px-10 py-7.5 lg:pe-12.5">
      <form action="<?=base_url("ugajans_anasayfa/profil_guncelle")?>" method="post" enctype="multipart/form-data" id="profilForm">
       <div class="grid gap-5">
        
        <!-- Ad Soyad -->
        <div class="flex flex-col sm:flex-row sm:items-center gap-3">
         <label class="text-sm text-gray-600 font-semibold min-w-[140px] flex items-center gap-2">
          <i class="ki-filled ki-user text-gray-400 text-sm"></i>
          <span>Ad Soyad <span class="text-danger">*</span></span>
         </label>
         <div class="flex-1">
          <label class="input">
           <input type="text" 
                  name="ugajans_kullanici_ad_soyad" 
                  value="<?=htmlspecialchars($kullanici->ugajans_kullanici_ad_soyad ?? '')?>" 
                  placeholder="Adınızı ve soyadınızı girin"
                  required>
          </label>
         </div>
        </div>
        
        <!-- Kullanıcı Adı -->
        <div class="flex flex-col sm:flex-row sm:items-center gap-3">
         <label class="text-sm text-gray-600 font-semibold min-w-[140px] flex items-center gap-2">
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
         <label class="text-sm text-gray-600 font-semibold min-w-[140px] flex items-center gap-2">
          <i class="ki-filled ki-sms text-gray-400 text-sm"></i>
          <span>E-posta Adresi</span>
         </label>
         <div class="flex-1">
          <label class="input">
           <input type="email" 
                  name="ugajans_kullanici_email" 
                  value="<?=htmlspecialchars($kullanici->ugajans_kullanici_email ?? '')?>"
                  placeholder="ornek@email.com">
          </label>
         </div>
        </div>
        <?php endif; ?>

        <?php if (in_array('ugajans_kullanici_telefon', $columns)): ?>
        <!-- Telefon -->
        <div class="flex flex-col sm:flex-row sm:items-center gap-3">
         <label class="text-sm text-gray-600 font-semibold min-w-[140px] flex items-center gap-2">
          <i class="ki-filled ki-phone text-gray-400 text-sm"></i>
          <span>Telefon Numarası</span>
         </label>
         <div class="flex-1">
          <label class="input">
           <input type="tel" 
                  name="ugajans_kullanici_telefon" 
                  value="<?=htmlspecialchars($kullanici->ugajans_kullanici_telefon ?? '')?>"
                  placeholder="05XX XXX XX XX">
          </label>
         </div>
        </div>
        <?php endif; ?>
       </div>
      </form>
     </div>
     <div class="card-footer justify-end">
      <button type="submit" form="profilForm" class="btn btn-primary">
       <i class="ki-filled ki-check"></i>
       Bilgileri Kaydet
      </button>
     </div>
    </div>

    <!-- Şifre Değiştirme Kartı -->
    <div class="card">
     <div class="card-header">
      <h3 class="card-title">
       Şifre Değiştirme
      </h3>
     </div>
     <div class="card-body px-10 py-7.5 lg:pe-12.5">
      <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
       <div class="flex items-start gap-3">
        <i class="ki-filled ki-information-2 text-blue-500 text-lg mt-0.5"></i>
        <div>
         <p class="text-sm font-medium text-blue-900 mb-1">Şifre Değiştirme Hakkında</p>
         <p class="text-xs text-blue-700">Şifrenizi değiştirmek istemiyorsanız aşağıdaki alanları boş bırakabilirsiniz. Şifre değiştirmek için mevcut şifrenizi girmeniz gerekmektedir.</p>
        </div>
       </div>
      </div>
      
      <form action="<?=base_url("ugajans_anasayfa/profil_guncelle")?>" method="post" id="sifreForm">
       <div class="grid gap-5">
        <!-- Mevcut Şifre -->
        <div class="flex flex-col sm:flex-row sm:items-center gap-3">
         <label class="text-sm text-gray-600 font-semibold min-w-[140px] flex items-center gap-2">
          <i class="ki-filled ki-lock text-gray-400 text-sm"></i>
          <span>Mevcut Şifre <span class="text-danger">*</span></span>
         </label>
         <div class="flex-1">
          <label class="input">
           <input type="password" 
                  name="mevcut_sifre" 
                  id="mevcut_sifre"
                  placeholder="Mevcut şifrenizi girin"
                  required>
          </label>
          <small class="text-xs text-gray-500 mt-1.5 flex items-center gap-1">
           <i class="ki-filled ki-information-2 text-xs"></i>
           Şifre değiştirmek için mevcut şifrenizi girmeniz gerekmektedir.
          </small>
         </div>
        </div>
        
        <!-- Yeni Şifre -->
        <div class="flex flex-col sm:flex-row sm:items-center gap-3">
         <label class="text-sm text-gray-600 font-semibold min-w-[140px] flex items-center gap-2">
          <i class="ki-filled ki-key text-gray-400 text-sm"></i>
          <span>Yeni Şifre <span class="text-danger">*</span></span>
         </label>
         <div class="flex-1">
          <label class="input">
           <input type="password" 
                  name="yeni_sifre" 
                  id="yeni_sifre"
                  placeholder="Yeni şifrenizi girin (Min. 6 karakter)"
                  required>
          </label>
          <small class="text-xs text-gray-500 mt-1.5 flex items-center gap-1">
           <i class="ki-filled ki-information-2 text-xs"></i>
           Şifre en az 6 karakter olmalıdır
          </small>
         </div>
        </div>
        
        <!-- Yeni Şifre Tekrar -->
        <div class="flex flex-col sm:flex-row sm:items-center gap-3">
         <label class="text-sm text-gray-600 font-semibold min-w-[140px] flex items-center gap-2">
          <i class="ki-filled ki-key text-gray-400 text-sm"></i>
          <span>Yeni Şifre (Tekrar) <span class="text-danger">*</span></span>
         </label>
         <div class="flex-1">
          <label class="input">
           <input type="password" 
                  name="yeni_sifre_tekrar" 
                  id="yeni_sifre_tekrar"
                  placeholder="Yeni şifrenizi tekrar girin"
                  required>
          </label>
          <small class="text-xs text-gray-500 mt-1.5 flex items-center gap-1">
           <i class="ki-filled ki-information-2 text-xs"></i>
           Yeni şifrenizi doğrulamak için tekrar girin
          </small>
         </div>
        </div>
       </div>
      </form>
     </div>
     <div class="card-footer justify-end">
      <button type="submit" form="sifreForm" class="btn btn-success">
       <i class="ki-filled ki-check"></i>
       Şifreyi Güncelle
      </button>
     </div>
    </div>

   </div>
  </div>

 </div>
</div>
<!-- End of Container -->

<script>
function previewImage(input) {
 if (input.files && input.files[0]) {
  // Dosya boyutu kontrolü (2MB)
  const maxSize = 2 * 1024 * 1024; // 2MB in bytes
  if (input.files[0].size > maxSize) {
   if (typeof Swal !== 'undefined') {
    Swal.fire({
     icon: 'error',
     title: 'Dosya Çok Büyük',
     text: 'Profil fotoğrafı maksimum 2MB olabilir. Lütfen daha küçük bir dosya seçin.'
    });
   } else {
    alert('Profil fotoğrafı maksimum 2MB olabilir. Lütfen daha küçük bir dosya seçin.');
   }
   input.value = '';
   return;
  }
  
  // Dosya tipi kontrolü
  const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
  if (!allowedTypes.includes(input.files[0].type)) {
   if (typeof Swal !== 'undefined') {
    Swal.fire({
     icon: 'error',
     title: 'Geçersiz Dosya Tipi',
     text: 'Sadece JPG, PNG ve GIF formatları desteklenmektedir.'
    });
   } else {
    alert('Sadece JPG, PNG ve GIF formatları desteklenmektedir.');
   }
   input.value = '';
   return;
  }
  
  const reader = new FileReader();
  
  reader.onload = function(e) {
   const preview = document.getElementById('profil_fotografi_preview');
   if (preview) {
    preview.src = e.target.result;
   }
  };
  
  reader.onerror = function() {
   if (typeof Swal !== 'undefined') {
    Swal.fire({
     icon: 'error',
     title: 'Hata',
     text: 'Dosya okunurken bir hata oluştu.'
    });
   } else {
    alert('Dosya okunurken bir hata oluştu.');
   }
  };
  
  reader.readAsDataURL(input.files[0]);
 }
}

// Form validasyonu
document.addEventListener('DOMContentLoaded', function() {
 // Kişisel Bilgiler Formu
 const profilForm = document.getElementById('profilForm');
 if (profilForm) {
  profilForm.addEventListener('submit', function(e) {
   // Form gönderiliyor gösterge
   const submitBtn = profilForm.querySelector('button[type="submit"]');
   if (submitBtn) {
    submitBtn.disabled = true;
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="ki-filled ki-loading spinner"></i> Kaydediliyor...';
    setTimeout(() => {
     submitBtn.disabled = false;
     submitBtn.innerHTML = originalText;
    }, 5000);
   }
   return true;
  });
 }
 
 // Fotoğraf Formu
 const fotografForm = document.getElementById('fotografForm');
 if (fotografForm) {
  fotografForm.addEventListener('submit', function(e) {
   const fotografSifre = document.getElementById('fotograf_sifre')?.value || '';
   const fotografInput = document.getElementById('profil_fotografi');
   
   if (!fotografSifre) {
    e.preventDefault();
    if (typeof Swal !== 'undefined') {
     Swal.fire({
      icon: 'error',
      title: 'Eksik Bilgi',
      text: 'Fotoğraf değiştirmek için şifrenizi girmelisiniz.',
      confirmButtonText: 'Tamam'
     });
    } else {
     alert('Fotoğraf değiştirmek için şifrenizi girmelisiniz.');
    }
    document.getElementById('fotograf_sifre')?.focus();
    return false;
   }
   
   if (!fotografInput || !fotografInput.files || fotografInput.files.length === 0) {
    e.preventDefault();
    if (typeof Swal !== 'undefined') {
     Swal.fire({
      icon: 'error',
      title: 'Dosya Seçilmedi',
      text: 'Lütfen yeni bir fotoğraf seçin.',
      confirmButtonText: 'Tamam'
     });
    } else {
     alert('Lütfen yeni bir fotoğraf seçin.');
    }
    return false;
   }
   
   // Form gönderiliyor gösterge
   const submitBtn = fotografForm.querySelector('button[type="submit"]');
   if (submitBtn) {
    submitBtn.disabled = true;
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="ki-filled ki-loading spinner"></i> Yükleniyor...';
    setTimeout(() => {
     submitBtn.disabled = false;
     submitBtn.innerHTML = originalText;
    }, 5000);
   }
   
   return true;
  });
 }
 
 // Şifre Değiştirme Formu
 const sifreForm = document.getElementById('sifreForm');
 if (sifreForm) {
  sifreForm.addEventListener('submit', function(e) {
   const yeniSifre = document.getElementById('yeni_sifre')?.value || '';
   const yeniSifreTekrar = document.getElementById('yeni_sifre_tekrar')?.value || '';
   const mevcutSifre = document.getElementById('mevcut_sifre')?.value || '';
   
   if (!mevcutSifre) {
    e.preventDefault();
    if (typeof Swal !== 'undefined') {
     Swal.fire({
      icon: 'error',
      title: 'Eksik Bilgi',
      text: 'Şifre değiştirmek için mevcut şifrenizi girmelisiniz.',
      confirmButtonText: 'Tamam'
     });
    } else {
     alert('Şifre değiştirmek için mevcut şifrenizi girmelisiniz.');
    }
    document.getElementById('mevcut_sifre')?.focus();
    return false;
   }
   
   if (!yeniSifre || !yeniSifreTekrar) {
    e.preventDefault();
    if (typeof Swal !== 'undefined') {
     Swal.fire({
      icon: 'error',
      title: 'Eksik Bilgi',
      text: 'Yeni şifre alanlarını doldurmalısınız.',
      confirmButtonText: 'Tamam'
     });
    } else {
     alert('Yeni şifre alanlarını doldurmalısınız.');
    }
    document.getElementById('yeni_sifre')?.focus();
    return false;
   }
   
   if (yeniSifre !== yeniSifreTekrar) {
    e.preventDefault();
    if (typeof Swal !== 'undefined') {
     Swal.fire({
      icon: 'error',
      title: 'Şifreler Eşleşmiyor',
      text: 'Yeni şifreler birbiriyle eşleşmiyor. Lütfen kontrol edin.',
      confirmButtonText: 'Tamam'
     });
    } else {
     alert('Yeni şifreler eşleşmiyor.');
    }
    document.getElementById('yeni_sifre_tekrar')?.focus();
    return false;
   }
   
   if (yeniSifre.length < 6) {
    e.preventDefault();
    if (typeof Swal !== 'undefined') {
     Swal.fire({
      icon: 'error',
      title: 'Şifre Çok Kısa',
      text: 'Yeni şifre en az 6 karakter olmalıdır.',
      confirmButtonText: 'Tamam'
     });
    } else {
     alert('Yeni şifre en az 6 karakter olmalıdır.');
    }
    document.getElementById('yeni_sifre')?.focus();
    return false;
   }
   
   // Form gönderiliyor gösterge
   const submitBtn = sifreForm.querySelector('button[type="submit"]');
   if (submitBtn) {
    submitBtn.disabled = true;
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="ki-filled ki-loading spinner"></i> Güncelleniyor...';
    setTimeout(() => {
     submitBtn.disabled = false;
     submitBtn.innerHTML = originalText;
    }, 5000);
   }
   
   return true;
  });
  
  // Şifre alanlarında gerçek zamanlı validasyon
  const yeniSifreInput = document.getElementById('yeni_sifre');
  const yeniSifreTekrarInput = document.getElementById('yeni_sifre_tekrar');
  
  if (yeniSifreInput && yeniSifreTekrarInput) {
   yeniSifreTekrarInput.addEventListener('input', function() {
    if (this.value && yeniSifreInput.value) {
     if (this.value !== yeniSifreInput.value) {
      this.classList.add('border-danger');
     } else {
      this.classList.remove('border-danger');
      this.classList.add('border-success');
     }
    }
   });
   
   yeniSifreInput.addEventListener('input', function() {
    if (yeniSifreTekrarInput.value) {
     if (this.value !== yeniSifreTekrarInput.value) {
      yeniSifreTekrarInput.classList.add('border-danger');
     } else {
      yeniSifreTekrarInput.classList.remove('border-danger');
      yeniSifreTekrarInput.classList.add('border-success');
     }
    }
   });
  }
 }
});

// Profil fotoğrafına tıklama ile görsel seçme (müşteri profilindeki gibi)
document.getElementById('profil_fotografi_preview')?.addEventListener('click', function() {
 const fileInput = document.getElementById('profil_fotografi');
 if (fileInput) {
  fileInput.click();
 }
});
</script>

<style>
.spinner {
 animation: spin 1s linear infinite;
}

@keyframes spin {
 from {
  transform: rotate(0deg);
 }
 to {
  transform: rotate(360deg);
 }
}

.input input.border-danger {
 border-color: #ef4444;
}

.input input.border-success {
 border-color: #10b981;
}
</style>
