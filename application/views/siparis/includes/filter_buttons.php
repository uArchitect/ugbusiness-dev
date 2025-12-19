<?php
/**
 * Filtre butonları partial
 * 
 * @param string $current_filter Mevcut filtre değeri
 * @return void
 */
$current_filter = isset($_GET['filter']) ? $_GET['filter'] : '2';
?>

<div class="btn-group d-flex mb-3 filter-buttons-wrapper">
    <a type="button" href="?filter=3" class="btn filter-btn <?= $current_filter == '3' ? 'btn-primary' : 'btn-outline-primary' ?>">
        <i class="fas fa-list"></i> Tüm Siparişler
    </a>
    <a type="button" href="?filter=2" class="btn filter-btn <?= empty($current_filter) || $current_filter == '2' ? 'btn-success' : 'btn-outline-success' ?>">
        <i class="far fa-check-circle"></i> Onay Bekleyenler
    </a>
    <a type="button" href="?filter=1" class="btn filter-btn <?= $current_filter == '1' ? 'btn-dark' : 'btn-outline-dark' ?>">
        <i class="fas fa-pause-circle"></i> Beklemede
    </a>
</div>

