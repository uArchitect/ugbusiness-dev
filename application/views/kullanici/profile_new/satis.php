<div class="container mt-4">
    <h2 class="mb-4 fw-bold text-dark">
        <i class="fa fa-chart-line text-primary"></i> Satış Listesi
    </h2>

    <!-- Arama Çubuğu -->
    <div class="input-group mb-4">
        <span class="input-group-text bg-white border-0"><i class="fa fa-search text-muted"></i></span>
        <input type="text" id="search" class="form-control form-control-lg border-0 shadow-sm" placeholder="Müşteri veya ürün adı ara...">
    </div>

    <div id="sales-list">
        <?php foreach ($satislar as $kullanici) { ?>
        <div class="card mb-3 border-0 shadow-lg rounded-4 p-3" style="background: linear-gradient(135deg, #f8f9fa, #ffffff);">
            <div class="card-body d-flex justify-content-between align-items-center">
                
                <!-- Sol Kısım -->
                <div>
                    <h5 class="fw-bold text-dark mb-1">
                        <i class="fa fa-user-circle text-primary"></i> <?= mb_strtoupper($kullanici->musteri_ad) ?>
                    </h5>
                    <p class="text-muted small mb-1">
                        📆 <?= date("d.m.Y H:i", strtotime($kullanici->kayit_tarihi)) ?>  
                        &nbsp;|&nbsp;  
                        📞 <?= $kullanici->musteri_iletisim_numarasi ?>
                    </p>
                    <p class="mb-0 text-secondary fw-semibold">📦 <?= $kullanici->urun_adi ?></p>
                </div>

                <!-- Sağ Kısım -->
                <div class="text-end">
                    <span class="badge bg-dark fs-5 px-4 py-2 shadow-sm">
                        💰 <?= number_format($kullanici->satis_fiyati,2) ?> ₺
                    </span>
                    <br>
                    <span class="badge <?= ($kullanici->odeme_secenek == "1") ? 'bg-success' : 'bg-warning' ?> mt-2">
                        <?= ($kullanici->odeme_secenek == "1") ? "Peşin" : "Vadeli ({$kullanici->vade_sayisi} Ay)" ?>
                    </span>
                </div>

                <a href="#" class="btn btn-outline-primary btn-sm rounded-pill shadow-sm">Detaylar</a>
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
