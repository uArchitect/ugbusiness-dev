<div class="container mt-4">
    <h2 class="mb-3 fw-bold text-primary">📋 Satış Listesi</h2>

    <!-- Arama Çubuğu -->
    <input type="text" id="search" class="form-control form-control-sm mb-3" placeholder="Müşteri veya ürün adı ara...">

    <div id="sales-list">
        <?php foreach ($satislar as $kullanici) { ?>
        <div class="card shadow-sm mb-2 border-0">
            <div class="card-body p-3">
                <h6 class="card-title fw-bold mb-1">
                    <i class="fa fa-user text-secondary"></i> <?= mb_strtoupper($kullanici->musteri_ad) ?>
                </h6>
                <p class="card-text small text-muted mb-1">
                    📆 <?= date("d.m.Y H:i", strtotime($kullanici->kayit_tarihi)) ?> |
                    📞 <?= $kullanici->musteri_iletisim_numarasi ?>
                </p>
                <p class="card-text mb-1">
                    <b>📦 Ürün:</b> <?= $kullanici->urun_adi ?>
                </p>
                <p class="card-text">
                    <b>💰 Fiyat:</b> <span class="badge bg-success"><?= number_format($kullanici->satis_fiyati,2) ?> ₺</span>
                    <b>💳 Ödeme:</b> <span class="badge <?= ($kullanici->odeme_secenek == "1") ? 'bg-primary' : 'bg-warning' ?>">
                        <?= ($kullanici->odeme_secenek == "1") ? "Peşin" : "Vadeli ({$kullanici->vade_sayisi} Ay)" ?>
                    </span>
                </p>
                <a href="#" class="btn btn-outline-primary btn-sm">Detaylar</a>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<script>
    document.getElementById('search').addEventListener('keyup', function () {
        let filter = this.value.toLowerCase();
        document.querySelectorAll('.card').forEach(card => {
            card.style.display = card.innerText.toLowerCase().includes(filter) ? '' : 'none';
        });
    });
</script>
