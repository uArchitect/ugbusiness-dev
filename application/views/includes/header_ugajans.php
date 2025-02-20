<style>
/* Genel Mobil Navbar Stili */
.mobile-navbar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    background: rgba(30, 30, 30, 0.95);
    backdrop-filter: blur(8px);
    padding: 15px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    z-index: 1000;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
}

/* Menü Butonu */
.menu-toggle {
    font-size: 26px;
    color: white;
    background: none;
    border: none;
    cursor: pointer;
    transition: transform 0.3s ease;
}

.menu-toggle:hover {
    transform: scale(1.1);
}

/* Kullanıcı Bilgisi */
.navbar-user {
    color: white;
    font-size: 16px;
    font-weight: bold;
    display: flex;
    align-items: center;
}

.navbar-user i {
    margin-right: 8px;
}

/* Açılır Menü */
.mobile-menu {
    position: fixed;
    top: 0;
    left: -100%;
    width: 75%;
    height: 100vh;
    background: #222;
    transition: left 0.4s ease-in-out;
    padding-top: 60px;
    box-shadow: 4px 0px 10px rgba(0, 0, 0, 0.3);
}

.mobile-menu.open {
    left: 0;
}

/* Menü Öğeleri */
.mobile-menu ul {
    list-style: none;
    padding: 0;
}

.mobile-menu ul li {
    padding: 15px 20px;
    font-size: 18px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.mobile-menu ul li a {
    text-decoration: none;
    color: white;
    display: flex;
    align-items: center;
    transition: all 0.3s ease;
}

.mobile-menu ul li a i {
    margin-right: 10px;
}

.mobile-menu ul li a:hover {
    color: #ff4757;
}

/* Kapatma Butonu */
.close-menu {
    font-size: 28px;
    color: white;
    position: absolute;
    top: 15px;
    right: 20px;
    cursor: pointer;
    transition: transform 0.3s ease;
}

.close-menu:hover {
    transform: rotate(90deg);
}
</style>

<!-- Mobil Navbar -->
<div class="mobile-navbar d-block d-lg-none">
    <button class="menu-toggle"><i class="fa fa-bars"></i></button>
    <div class="navbar-user">
        <i class="fa fa-user-circle"></i> <?=aktif_kullanici()->kullanici_ad_soyad?>
    </div>
</div>

<!-- Mobil Açılır Menü -->
<div class="mobile-menu">
    <span class="close-menu"><i class="fa fa-times"></i></span>
    <ul>
        <li><a href="#"><i class="fa fa-user"></i> Profilim</a></li>
        <li><a href="#"><i class="fa fa-cogs"></i> Ayarlar</a></li>
        <li><a href="https://ugbusiness.com.tr/logout"><i class="fa fa-sign-out-alt"></i> Çıkış Yap</a></li>
    </ul>
</div>

<!-- JavaScript (Mobil Menü Aç/Kapa) -->
<script>
document.querySelector(".menu-toggle").addEventListener("click", function() {
    document.querySelector(".mobile-menu").classList.add("open");
});

document.querySelector(".close-menu").addEventListener("click", function() {
    document.querySelector(".mobile-menu").classList.remove("open");
});
</script>
