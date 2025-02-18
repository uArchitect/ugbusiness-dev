<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Arial', sans-serif;
        }
        .profile-container {
            max-width: 1100px;
            margin: auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.15);
            border: 1px solid #ddd;
        }
        .profile-header {
            display: flex;
            align-items: center;
            border-bottom: 3px solid #0056b3;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .profile-header img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin-right: 20px;
            border: 4px solid #0056b3;
        }
        .profile-header h2 {
            font-size: 24px;
            color: #0056b3;
            margin: 0;
        }
        .profile-header p {
            color: #777;
            margin: 5px 0 0;
            font-size: 14px;
        }
        .info-card {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-left: 5px solid #0056b3;
            margin-bottom: 15px;
        }
        .info-card h4 {
            margin: 0;
            font-size: 16px;
            color: #333;
        }
        .info-card p {
            margin: 5px 0 0;
            font-size: 14px;
            color: #666;
        }
        .contact-info {
            display: flex;
            gap: 15px;
        }
        .contact-info div {
            flex: 1;
        }
        .btn-primary {
            background-color: #0056b3;
            border: none;
        }
        .btn-primary:hover {
            background-color: #003d80;
        }
    </style>

<div class="profile-container">
    <!-- Kullanıcı Bilgileri -->
    <div class="profile-header">
        <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Profil Fotoğrafı">
        <div>
            <h2>Mehmet Yılmaz</h2>
            <p><i class="fas fa-briefcase"></i> Yazılım Mühendisi</p>
            <p><i class="fas fa-map-marker-alt"></i> İstanbul, Türkiye</p>
        </div>
    </div>

    <div class="row">
        <!-- Kişisel Bilgiler -->
        <div class="col-md-6">
            <div class="info-card">
                <h4><i class="fas fa-user"></i> Kişisel Bilgiler</h4>
                <p><b>Ad Soyad:</b> Mehmet Yılmaz</p>
                <p><b>Doğum Tarihi:</b> 15 Mart 1990</p>
                <p><b>Cinsiyet:</b> Erkek</p>
                <p><b>Medeni Hali:</b> Evli</p>
            </div>
        </div>

        <!-- Çalışma Bilgileri -->
        <div class="col-md-6">
            <div class="info-card">
                <h4><i class="fas fa-building"></i> Çalışma Bilgileri</h4>
                <p><b>Şirket:</b> XYZ Teknoloji</p>
                <p><b>Pozisyon:</b> Yazılım Mühendisi</p>
                <p><b>Çalışma Süresi:</b> 5 Yıl</p>
                <p><b>Departman:</b> AR-GE</p>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- İletişim Bilgileri -->
        <div class="col-md-6">
            <div class="info-card">
                <h4><i class="fas fa-envelope"></i> İletişim Bilgileri</h4>
                <p><b>E-posta:</b> mehmet@example.com</p>
                <p><b>Telefon:</b> +90 555 123 45 67</p>
                <p><b>Adres:</b> İstanbul, Türkiye</p>
            </div>
        </div>

        <!-- Diğer Bilgiler -->
        <div class="col-md-6">
            <div class="info-card">
                <h4><i class="fas fa-info-circle"></i> Diğer Bilgiler</h4>
                <p><b>Dil Yetkinlikleri:</b> Türkçe, İngilizce</p>
                <p><b>Sertifikalar:</b> PMP, AWS Certified Developer</p>
                <p><b>Hobiler:</b> Kodlama, Satranç, Fotoğrafçılık</p>
            </div>
        </div>
    </div>

    <!-- Buton -->
    <div class="text-center mt-3">
        <button class="btn btn-primary"><i class="fas fa-edit"></i> Bilgileri Güncelle</button>
    </div>
</div>
