<div class="profile-container">
        <div class="profile-card">
            <div class="profile-header">
                <div class="profile-img">
                    <img src="https://via.placeholder.com/150" alt="User Image">
                </div>
                <div class="profile-info">
                    <h1>Ahmet Yılmaz</h1>
                    <p>@ahmetyilmaz</p>
                    <button class="edit-btn">Profili Düzenle</button>
                </div>
            </div>

            <div class="profile-details">
                <div class="profile-section">
                    <h3>Kişisel Bilgiler</h3>
                    <ul>
                        <li><strong>Ad:</strong> Ahmet</li>
                        <li><strong>Soyad:</strong> Yılmaz</li>
                        <li><strong>Doğum Tarihi:</strong> 01 Ocak 1990</li>
                        <li><strong>Cinsiyet:</strong> Erkek</li>
                        <li><strong>Medeni Durum:</strong> Evli</li>
                    </ul>
                </div>

                <div class="profile-section">
                    <h3>Eğitim Bilgileri</h3>
                    <ul>
                        <li><strong>Üniversite:</strong> İstanbul Teknik Üniversitesi</li>
                        <li><strong>Bölüm:</strong> Bilgisayar Mühendisliği</li>
                        <li><strong>Mezuniyet Yılı:</strong> 2012</li>
                    </ul>
                </div>

                <div class="profile-section">
                    <h3>Çalışma Bilgileri</h3>
                    <ul>
                        <li><strong>Şirket:</strong> Teknoloji A.Ş.</li>
                        <li><strong>Görev:</strong> Yazılım Geliştirici</li>
                        <li><strong>İşe Başlama Yılı:</strong> 2015</li>
                        <li><strong>Çalışma Durumu:</strong> Aktif</li>
                    </ul>
                </div>

                <div class="profile-section">
                    <h3>İletişim Bilgileri</h3>
                    <ul>
                        <li><strong>Email:</strong> ahmet@example.com</li>
                        <li><strong>Telefon:</strong> +90 123 456 7890</li>
                        <li><strong>LinkedIn:</strong> linkedin.com/in/ahmetyilmaz</li>
                        <li><strong>Website:</strong> www.ahmetyilmaz.com</li>
                    </ul>
                </div>

                <div class="profile-section">
                    <h3>Adres Bilgileri</h3>
                    <ul>
                        <li><strong>Ev Adresi:</strong> Bağcılar, İstanbul, Türkiye</li>
                        <li><strong>İş Adresi:</strong> Beylikdüzü, İstanbul, Türkiye</li>
                    </ul>
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
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 950px;
    margin: 0 auto;
    padding: 30px;
    font-size: 15px;
}

.profile-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 40px;
}

.profile-img img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #3498db;
}

.profile-info {
    flex-grow: 1;
    padding-left: 20px;
}

.profile-info h1 {
    font-size: 26px;
    color: #333;
    margin-bottom: 5px;
}

.profile-info p {
    color: #777;
    font-size: 16px;
    margin-bottom: 10px;
}

.edit-btn {
    padding: 10px 20px;
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
    margin-top: 30px;
}

.profile-section {
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 2px solid #f0f0f0;
}

.profile-section h3 {
    font-size: 18px;
    color: #333;
    margin-bottom: 15px;
    text-transform: uppercase;
    font-weight: 600;
    border-bottom: 2px solid #3498db;
    padding-bottom: 5px;
}

.profile-section ul {
    list-style: none;
}

.profile-section li {
    margin-bottom: 12px;
    font-size: 16px;
}

.profile-section li strong {
    color: #3498db;
    font-weight: bold;
}

.profile-section li:last-child {
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
        width: 100px;
        height: 100px;
    }

    .profile-info {
        padding-left: 0;
        padding-top: 15px;
    }
}
        </style>