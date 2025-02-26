<div class="container mt-4">
    <h2 class="mb-4 fw-bold text-dark"><i class="fa fa-list-alt"></i> Satış Listesi</h2>

    <!-- Arama Çubuğu -->
    <div class="input-group mb-3">
        <span class="input-group-text"><i class="fa fa-search"></i></span>
        <input type="text" id="search" class="form-control form-control-lg" placeholder="Müşteri veya ürün adı ara...">
    </div>

    <div id="sales-list">
        <?php foreach ($satislar as $kullanici) { ?>
        <div class="card mb-3 border-0 shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fw-bold text-primary">
                        <i class="fa fa-user text-secondary"></i> <?= mb_strtoupper($kullanici->musteri_ad) ?>
                    </h6>
                    <p class="text-muted mb-1 small">
                        <i class="fa fa-calendar-alt"></i> <?= date("d.m.Y H:i", strtotime($kullanici->kayit_tarihi)) ?> |
                        <i class="fa fa-phone"></i> <?= $kullanici->musteri_iletisim_numarasi ?>
                    </p>
                    <p class="mb-1"><b>📦 Ürün:</b> <?= $kullanici->urun_adi ?></p>
                </div>

                <div class="text-end">
                    <span class="badge bg-success fs-6 px-3 py-2">
                        <i class="fa fa-lira-sign"></i> <?= number_format($kullanici->satis_fiyati,2) ?> ₺
                    </span>
                    <br>
                    <span class="badge <?= ($kullanici->odeme_secenek == "1") ? 'bg-primary' : 'bg-warning' ?> mt-2">
                        <?= ($kullanici->odeme_secenek == "1") ? "Peşin" : "Vadeli ({$kullanici->vade_sayisi} Ay)" ?>
                    </span>
                </div>

                <a href="#" class="btn btn-dark btn-sm">Detaylar</a>
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
