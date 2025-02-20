<style>
/* Navbar Arka Plan ve Genel Stil */
.navbar-custom {
    background: #1e1e1e;
    border-bottom: 2px solid #ff4757;
}

/* Kullanıcı Bilgisi (Mobil) */
.mobile-user-info {
    background: #292929;
    color: white;
    padding: 12px;
    font-size: 16px;
    text-align: center;
    font-weight: bold;
    border-bottom: 1px solid #ff4757;
}

/* Butonlar (Mobil) */
.mobile-nav-btn {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 10px;
    font-size: 16px;
    border-radius: 0;
    transition: all 0.3s ease;
}

/* Çıkış Butonu */
.btn-logout {
    background: #ff4757;
    border: none;
    color: white;
}

.btn-logout:hover {
    background: #e84118;
}

/* Giriş Butonu */
.btn-user {
    background: #34495e;
    border: none;
    color: white;
}

.btn-user:hover {
    background: #2c3e50;
}
</style>

<!-- Navbar (Masaüstü için) -->
<nav class="main-header navbar navbar-expand navbar-custom navbar-dark d-none d-lg-flex">
    <ul class="navbar-nav ml-auto">
    <a href="https://ugbusiness.com.tr/anasayfa" class="brand-link" style="text-align: center;border: 9px double #003a79;border-style: revert-layer;background:#0060c7;padding:4px">
      <span style="font-size:26px;color:white;">
        <strong>UG</strong> 
      BUSINESS 
 
      </span>
    </a>
        <span class="text-white mt-1 mr-5">
            <i class="fa fa-user-circle"></i> 
            <b><?=aktif_kullanici()->kullanici_ad_soyad?></b> / <?=aktif_kullanici()->kullanici_unvan?>
        </span>
        <li class="nav-item">
            <a class="btn btn-danger btn-sm" href="https://ugbusiness.com.tr/logout">
                <i class="fas fa-sign-out-alt"></i> Oturumu Sonlandır
            </a>
        </li>
    </ul>
</nav>

<!-- Mobil Kullanıcı Bilgisi -->
<div class="mobile-user-info d-block d-lg-none">
    <i class="fa fa-user-circle"></i> <?=aktif_kullanici()->kullanici_ad_soyad?> / <?=aktif_kullanici()->kullanici_unvan?>
</div>

<!-- Mobil Butonlar -->
<a class="btn mobile-nav-btn btn-user d-block d-lg-none">
    <i class="fa fa-user"></i> Kullanıcı Profili
</a>
<a class="btn mobile-nav-btn btn-logout d-block d-lg-none" href="https://ugbusiness.com.tr/logout">
    <i class="fas fa-sign-out-alt"></i> Oturumu Sonlandır
</a>
