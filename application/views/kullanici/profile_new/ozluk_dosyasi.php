<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        /* Tüm stiller sadece bu kapsayıcı içinde geçerli olacak */
        .user-profile-container {
            font-family: 'Poppins', sans-serif;
            background: #181818;
            color: #fff;
            max-width: 900px;
            margin: auto;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0px 0px 20px rgba(255, 255, 255, 0.1);
        }

        .profile-header {
            display: flex;
            align-items: center;
            padding: 20px;
            background: #222;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: inset 0 0 10px rgba(255, 255, 255, 0.1);
        }

        .profile-header img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-right: 15px;
            border: 3px solid #FFD700;
        }

        .profile-header h2 {
            margin: 0;
            font-size: 20px;
            color: #FFD700;
        }

        .profile-header p {
            margin: 5px 0 0;
            color: #ccc;
            font-size: 14px;
        }

        .info-card {
            background: #222;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 15px;
            box-shadow: 0 4px 6px rgba(255, 255, 255, 0.1);
        }

        .info-card h3 {
            margin-bottom: 10px;
            font-size: 16px;
            border-bottom: 2px solid #FFD700;
            padding-bottom: 5px;
            color: #FFD700;
        }

        .info-card div {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
            font-size: 14px;
        }

        .info-card div span {
            color: #ccc;
        }

        .update-button {
            display: block;
            width: 100%;
            padding: 10px;
            text-align: center;
            background: #FFD700;
            color: #000;
            font-weight: bold;
            border-radius: 5px;
            text-decoration: none;
            transition: 0.3s;
        }

        .update-button:hover {
            background: #FFC300;
        }

        /* Mobil uyum */
        @media (max-width: 600px) {
            .profile-header {
                flex-direction: column;
                text-align: center;
            }
            .profile-header img {
                margin-bottom: 10px;
            }
        }
    </style>
    <div class="user-profile-container">
        <!-- Kullanıcı Profili -->
        <div class="profile-header">
            <img src="https://i.pravatar.cc/150?img=12" alt="Profil Resmi">
            <div>
                <h2>Ahmet Yılmaz</h2>
                <p>Yazılım Geliştirici - ABC Teknoloji</p>
            </div>
        </div>

        <!-- Kişisel Bilgiler -->
        <div class="info-card">
            <h3><i class="fa-solid fa-id-card"></i> Kişisel Bilgiler</h3>
            <div><strong>Ad:</strong> <span>Ahmet Yılmaz</span></div>
            <div><strong>Doğum Tarihi:</strong> <span>15 Mayıs 1990</span></div>
            <div><strong>Cinsiyet:</strong> <span>Erkek</span></div>
            <div><strong>Medeni Durum:</strong> <span>Evli</span></div>
        </div>

        <!-- Çalışma Bilgileri -->
        <div class="info-card">
            <h3><i class="fa-solid fa-briefcase"></i> Çalışma Bilgileri</h3>
            <div><strong>Şirket:</strong> <span>ABC Teknoloji A.Ş.</span></div>
            <div><strong>Görev:</strong> <span>Yazılım Geliştirici</span></div>
            <div><strong>Çalışma Süresi:</strong> <span>5 Yıl</span></div>
            <div><strong>Departman:</strong> <span>AR-GE</span></div>
        </div>

        <!-- İletişim Bilgileri -->
        <div class="info-card">
            <h3><i class="fa-solid fa-phone"></i> İletişim Bilgileri</h3>
            <div><strong>Telefon:</strong> <span>+90 532 123 45 67</span></div>
            <div><strong>Email:</strong> <span>ahmet.yilmaz@example.com</span></div>
            <div><strong>LinkedIn:</strong> <span>linkedin.com/in/ahmetyilmaz</span></div>
        </div>

        <!-- Adres Bilgileri -->
        <div class="info-card">
            <h3><i class="fa-solid fa-map-marker-alt"></i> Adres Bilgileri</h3>
            <div><strong>Şehir:</strong> <span>İstanbul</span></div>
            <div><strong>İlçe:</strong> <span>Kadıköy</span></div>
            <div><strong>Açık Adres:</strong> <span>Bağdat Caddesi, No: 23, Daire: 5</span></div>
        </div>

        <!-- Diğer Bilgiler -->
        <div class="info-card">
            <h3><i class="fa-solid fa-circle-info"></i> Diğer Bilgiler</h3>
            <div><strong>Hobiler:</strong> <span>Kitap Okuma, Fotoğrafçılık, Seyahat</span></div>
            <div><strong>Sertifikalar:</strong> <span>Google Cloud Certified, AWS Solutions Architect</span></div>
        </div>

        <a href="#" class="update-button"><i class="fa-solid fa-pen"></i> Bilgileri Güncelle</a>
    </div>