
<div class="profile-container">
        <div class="profile-card">
            <div class="profile-header">
                <div class="profile-img">
                    <img src="https://via.placeholder.com/150" alt="Kullanıcı Resmi">
                </div>
                <div class="profile-info">
                    <h1>Ahmet Yılmaz</h1>
                    <p class="job-title">Yazılım Geliştirici | Teknoloji A.Ş.</p>
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
                        <div class="info-item"><strong>Email:</strong> ahmet.yilmaz@teknoloji.com</div>
                        <div class="info-item"><strong>Telefon:</strong> +90 123 456 7890</div>
                        <div class="info-item"><strong>LinkedIn:</strong> linkedin.com/in/ahmetyilmaz</div>
                        <div class="info-item"><strong>Website:</strong> www.ahmetyilmaz.com</div>
                    </div>
                </div>

                <div class="profile-section">
                    <h3>Adres Bilgileri</h3>
                    <div class="info-box">
                        <div class="info-item"><strong>Ev Adresi:</strong> Bağcılar, İstanbul</div>
                        <div class="info-item"><strong>İş Adresi:</strong> Beylikdüzü, İstanbul</div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <style>



.profile-container {
    width: 100%;
    max-width: 1200px;
}

.profile-card {
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    padding: 30px;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.profile-header {
    display: flex;
    align-items: center;
    gap: 30px;
    border-bottom: 2px solid #e9ecef;
    padding-bottom: 20px;
}

.profile-img img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #007bff;
}

.profile-info {
    flex-grow: 1;
    text-align: left;
}

.profile-info h1 {
    font-size: 28px;
    color: #343a40;
    margin-bottom: 5px;
}

.job-title {
    font-size: 16px;
    color: #6c757d;
    margin-bottom: 10px;
}

.edit-btn {
    padding: 12px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
    transition: background-color 0.3s;
}

.edit-btn:hover {
    background-color: #0056b3;
}

.profile-details {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.profile-section h3 {
    font-size: 20px;
    font-weight: 600;
    color: #343a40;
    border-bottom: 2px solid #007bff;
    padding-bottom: 5px;
}

.info-box {
    background-color: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    border: 1px solid #e9ecef;
}

.info-item {
    margin-bottom: 12px;
    font-size: 16px;
}

.info-item strong {
    color: #007bff;
    font-weight: 600;
}

.profile-section:last-child {
    margin-bottom: 0;
}

@media (max-width: 768px) {
    .profile-header {
        flex-direction: column;
        text-align: center;
    }

    .profile-img img {
        width: 120px;
        height: 120px;
    }

    .profile-info {
        text-align: center;
        padding-top: 15px;
    }

    .edit-btn {
        width: 100%;
        margin-top: 15px;
    }
}



        </style>