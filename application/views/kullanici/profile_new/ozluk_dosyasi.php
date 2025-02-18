<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        /* Kapsayıcı: Diğer CSS'leri Etkilememesi İçin */
        .user-profile-container * {
            all: unset; /* Tüm varsayılan stilleri sıfırla */
            font-family: 'Arial', sans-serif;
            box-sizing: border-box;
        }

        /* Sayfa Genel Stilleri */
        .user-profile-container {
            background-color: #121212;
            color: #fff;
            padding: 20px;
            max-width: 800px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.1);
            font-size: 14px;
        }

        .user-profile-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #FFD700;
        }

        .user-section {
            background: #1E1E1E;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 8px;
            border-left: 4px solid #FFD700;
        }

        .user-section h3 {
            border-bottom: 2px solid #FFD700;
            padding-bottom: 5px;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .user-info {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
        }

        .user-info span {
            font-weight: bold;
            color: #FFD700;
        }

        /* Güncelleme Butonu */
        .user-button {
            display: block;
            width: 100%;
            padding: 10px;
            text-align: center;
            background: #FFD700;
            color: #000;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            margin-top: 10px;
        }

        .user-button:hover {
            background: #FFC300;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .user-info {
                flex-direction: column;
            }
        }
    </style>


<div class="user-profile-container">
        <h2><i class="fa-solid fa-user"></i> Kullanıcı Bilgileri</h2>

        <!-- Kişisel Bilgiler -->
        <div class="user-section">
            <h3><i class="fa-solid fa-id-card"></i> Kişisel Bilgiler</h3>
            <div class="user-info"><span>Ad:</span> Ahmet Yılmaz</div>
            <div class="user-info"><span>Doğum Tarihi:</span> 15 Mayıs 1990</div>
            <div class="user-info"><span>Cinsiyet:</span> Erkek</div>
            <div class="user-info"><span>Medeni Durum:</span> Evli</div>
        </div>

        <!-- Çalışma Bilgileri -->
        <div class="user-section">
            <h3><i class="fa-solid fa-briefcase"></i> Çalışma Bilgileri</h3>
            <div class="user-info"><span>Şirket:</span> ABC Teknoloji A.Ş.</div>
            <div class="user-info"><span>Görev:</span> Yazılım Geliştirici</div>
            <div class="user-info"><span>Çalışma Süresi:</span> 5 Yıl</div>
            <div class="user-info"><span>Departman:</span> AR-GE</div>
        </div>

        <!-- İletişim Bilgileri -->
        <div class="user-section">
            <h3><i class="fa-solid fa-phone"></i> İletişim Bilgileri</h3>
            <div class="user-info"><span>Telefon:</span> +90 532 123 45 67</div>
            <div class="user-info"><span>Email:</span> ahmet.yilmaz@example.com</div>
            <div class="user-info"><span>LinkedIn:</span> linkedin.com/in/ahmetyilmaz</div>
        </div>

        <!-- Adres Bilgileri -->
        <div class="user-section">
            <h3><i class="fa-solid fa-map-marker-alt"></i> Adres Bilgileri</h3>
            <div class="user-info"><span>Şehir:</span> İstanbul</div>
            <div class="user-info"><span>İlçe:</span> Kadıköy</div>
            <div class="user-info"><span>Açık Adres:</span> Bağdat Caddesi, No: 23, Daire: 5</div>
        </div>

        <!-- Diğer Bilgiler -->
        <div class="user-section">
            <h3><i class="fa-solid fa-circle-info"></i> Diğer Bilgiler</h3>
            <div class="user-info"><span>Hobiler:</span> Kitap Okuma, Fotoğrafçılık, Seyahat</div>
            <div class="user-info"><span>Sertifikalar:</span> Google Cloud Certified, AWS Solutions Architect</div>
        </div>

        <a href="#" class="user-button"><i class="fa-solid fa-pen"></i> Bilgileri Güncelle</a>
    </div>