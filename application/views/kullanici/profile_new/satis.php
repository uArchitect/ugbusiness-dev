
<style>
        .sales-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px 12px;
            border-bottom: 1px solid #ddd;
            font-size: 14px;
        }
        .sales-item i { margin-right: 5px; }
        .price { font-weight: bold; color: #198754; }
    </style>

<div class="container mt-4">
    <h4 class="mb-3">📋 Satış Listesi</h4>

    <!-- Arama Çubuğu -->
    <input type="text" id="search" class="form-control mb-2" placeholder="Müşteri veya ürün adı ara..." style="font-size: 14px;">

    <div id="sales-list">
        <?php foreach ($satislar as $kullanici) { ?>
        <div class="sales-item">
            <span><i class="fa fa-user"></i> <?= mb_strtoupper($kullanici->musteri_ad) ?></span>
            <span><i class="fa fa-box"></i> <?= $kullanici->urun_adi ?></span>
            <span><i class="fa fa-money-bill"></i> <span class="price"><?= number_format($kullanici->satis_fiyati,2) ?> ₺</span></span>
            <span><i class="fa fa-calendar"></i> <?= date("d.m.Y", strtotime($kullanici->kayit_tarihi)) ?></span>
        </div>
        <?php } ?>
    </div>
</div>

<script>
    document.getElementById('search').addEventListener('keyup', function () {
        let filter = this.value.toLowerCase();
        let items = document.querySelectorAll('.sales-item');
        items.forEach(item => {
            let text = item.innerText.toLowerCase();
            item.style.display = text.includes(filter) ? '' : 'none';
        });
    });
</script>