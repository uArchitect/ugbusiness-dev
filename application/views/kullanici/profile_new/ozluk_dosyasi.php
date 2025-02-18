<div class="profile-container">
        <div class="profile-card">
            <div class="profile-header">
                <div class="profile-img">
                    <img src="https://via.placeholder.com/150" alt="User Image">
                </div>
                <div class="profile-info">
                    <h1>Ahmet Yılmaz</h1>
                    <p><span>@ahmetyilmaz</span></p>
                    <button class="edit-btn">Profili Düzenle</button>
                </div>
            </div>

            <div class="profile-details">
                <div class="profile-section">
                    <h3>Kişisel Bilgiler</h3>
                    <div class="info-box">
                        <div class="info-item"><strong>Ad:</strong> Ahmet</div>
                        <div class="info-item"><strong>Soyad:</strong> Yılmaz</div>
                        <div class="info-item"><strong>Doğum Tarihi:</strong> 01 Ocak 1990</div>
                        <div class="info-item"><strong>Cinsiyet:</strong> Erkek</div>
                        <div class="info-item"><strong>Medeni Durum:</strong> Evli</div>
                    </div>
                </div>

                <div class="profile-section">
                    <h3>Eğitim Bilgileri</h3>
                    <div class="info-box">
                        <div class="info-item"><strong>Üniversite:</strong> İstanbul Teknik Üniversitesi</div>
                        <div class="info-item"><strong>Bölüm:</strong> Bilgisayar Mühendisliği</div>
                        <div class="info-item"><strong>Mezuniyet Yılı:</strong> 2012</div>
                    </div>
                </div>

                <div class="profile-section">
                    <h3>Çalışma Bilgileri</h3>
                    <div class="info-box">
                        <div class="info-item"><strong>Şirket:</strong> Teknoloji A.Ş.</div>
                        <div class="info-item"><strong>Görev:</strong> Yazılım Geliştirici</div>
                        <div class="info-item"><strong>İşe Başlama Yılı:</strong> 2015</div>
                        <div class="info-item"><strong>Çalışma Durumu:</strong> Aktif</div>
                    </div>
                </div>

                <div class="profile-section">
                    <h3>İletişim Bilgileri</h3>
                    <div class="info-box">
                        <div class="info-item"><strong>Email:</strong> ahmet@example.com</div>
                        <div class="info-item"><strong>Telefon:</strong> +90 123 456 7890</div>
                        <div class="info-item"><strong>LinkedIn:</strong> linkedin.com/in/ahmetyilmaz</div>
                        <div class="info-item"><strong>Website:</strong> www.ahmetyilmaz.com</div>
                    </div>
                </div>

                <div class="profile-section">
                    <h3>Adres Bilgileri</h3>
                    <div class="info-box">
                        <div class="info-item"><strong>Ev Adresi:</strong> Bağcılar, İstanbul, Türkiye</div>
                        <div class="info-item"><strong>İş Adresi:</strong> Beylikdüzü, İstanbul, Türkiye</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .profile-container {
    width: 100%;
    max-width: 1200px;
    padding: 20px;
}

.profile-card {
    background-color: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 950px;
    margin: 0 auto;
    padding: 30px;
}

.profile-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 30px;
    border-bottom: 2px solid #f0f0f0;
    padding-bottom: 20px;
}

.profile-img img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    border: 5px solid #3498db;
}

.profile-info {
    flex-grow: 1;
    padding-left: 20px;
    text-align: left;
}

.profile-info h1 {
    font-size: 28px;
    color: #333;
    margin-bottom: 5px;
}

.profile-info p {
    color: #777;
    font-size: 18px;
    margin-bottom: 10px;
}

.edit-btn {
    padding: 12px 25px;
    background-color: #3498db;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.edit-btn:hover {
    background-color: #2980b9;
}

.profile-details {
    margin-top: 20px;
}

.profile-section {
    margin-bottom: 30px;
}

.profile-section h3 {
    font-size: 20px;
    color: #333;
    margin-bottom: 15px;
    text-transform: uppercase;
    font-weight: 600;
    border-bottom: 2px solid #3498db;
    padding-bottom: 5px;
}

.info-box {
    background-color: #fafafa;
    padding: 20px;
    border-radius: 8px;
    border: 1px solid #e0e0e0;
}

.info-item {
    margin-bottom: 12px;
    font-size: 16px;
    line-height: 1.5;
}

.info-item strong {
    color: #3498db;
    font-weight: 600;
}

.info-item:last-child {
    margin-bottom: 0;
}

@media (max-width: 768px) {
    .profile-card {
        padding: 20px;
    }

    .profile-header {
        flex-direction: column;
        text-align: center;
    }

    .profile-img img {
        width: 120px;
        height: 120px;
    }

    .profile-info {
        padding-left: 0;
        padding-top: 15px;
        text-align: center;
    }

    .edit-btn {
        width: 100%;
        margin-top: 15px;
    }
}
        </style>