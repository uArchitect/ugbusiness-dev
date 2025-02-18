<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        /* Kapsayıcı */
        .profile-container {
            max-width: 900px;
            margin: 40px auto;
            font-family: 'Arial', sans-serif;
            background: #ffffff;
            color: #333;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
        }

        /* Profil üst kısmı */
        .profile-header {
            display: flex;
            align-items: center;
            border-bottom: 2px solid #0073e6;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        .profile-header img {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            border: 3px solid #0073e6;
            margin-right: 20px;
        }

        .profile-header h2 {
            font-size: 22px;
            margin: 0;
            color: #0073e6;
        }

        .profile-header p {
            margin: 5px 0 0;
            font-size: 14px;
            color: #555;
        }

        /* Kartlar */
        .info-card {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .info-card h3 {
            margin-bottom: 10px;
            font-size: 16px;
            border-bottom: 2px solid #0073e6;
            padding-bottom: 5px;
            color: #0073e6;
        }

        .info-card div {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
            font-size: 14px;
        }

        .info-card div strong {
            color: #444;
        }

        .info-card div span {
            color: #666;
        }

        /* Güncelleme Butonu */
        .update-button {
            display: block;
            width: 100%;
            padding: 12px;
            text-align: center;
            background: #0073e6;
            color: #fff;
            font-weight: bold;
            border-radius: 5px;
            text-decoration: none;
            transition: 0.3s;
            font-size: 16px;
            margin-top: 15px;
        }

        .update-button:hover {
            background: #005bb5;
        }

        /* Mobil Uyum */
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

<div class="profile-container">
        <!-- Kullanıcı Profili -->
        <div class="profile-header">
            <img src="https://i.pravatar.cc/150?img=45" alt="Profil Resmi">
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