
<div class="container mt-4">
    <h2 class="mb-3">📋 Satış Listesi</h2>

    <!-- Arama Çubuğu -->
    <input type="text" id="search" class="form-control mb-3" placeholder="Müşteri veya ürün adı ara...">

    <div id="sales-list">
        <?php foreach ($satislar as $kullanici) { ?>
        <div class="card shadow">
            <div class="card-body">
                <h5 class="card-title"><i class="fa fa-user"></i> <?= mb_strtoupper($kullanici->musteri_ad) ?></h5>
                <p class="card-text">
                    <b>📆 Tarih:</b> <?= date("d.m.Y H:i", strtotime($kullanici->kayit_tarihi)) ?><br>
                    <b>📞 Telefon:</b> <?= $kullanici->musteri_iletisim_numarasi ?><br>
                    <b>📦 Ürün:</b> <?= $kullanici->urun_adi ?><br>
                    <b>💰 Satış Fiyatı:</b> <span class="price"><?= number_format($kullanici->satis_fiyati,2) ?> ₺</span><br>
                    <b>💳 Ödeme Türü:</b> <?= ($kullanici->odeme_secenek == "1") ? "Peşin" : "Vadeli ({$kullanici->vade_sayisi} Ay)" ?>
                </p>
                <a href="#" class="btn btn-primary btn-sm">Detaylar</a>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<script>
    document.getElementById('search').addEventListener('keyup', function () {
        let filter = this.value.toLowerCase();
        let cards = document.querySelectorAll('.card');
        cards.forEach(card => {
            let text = card.innerText.toLowerCase();
            card.style.display = text.includes(filter) ? '' : 'none';
        });
    });
</script>
