<?php
/**
 * Filtre butonları partial
 * 
 * @param string $current_filter Mevcut filtre değeri
 * @return void
 */
$current_filter = isset($_GET['filter']) ? $_GET['filter'] : '2';
?>

<div class="btn-group d-flex mb-3">
    <a type="button" href="?filter=3" class="btn <?= $current_filter == '3' ? 'btn-primary' : 'btn-outline-primary' ?>" style="font-size: x-large !important;">
        Tüm Siparişler
    </a>
    <a type="button" href="?filter=2" class="btn <?= empty($current_filter) || $current_filter == '2' ? 'btn-success' : 'btn-outline-success' ?>" style="font-size: x-large !important;">
        Onay Bekleyen Siparişler
    </a>
    <a type="button" href="?filter=1" class="btn <?= $current_filter == '1' ? 'btn-dark' : 'btn-outline-dark' ?>" style="font-size: x-large !important;">
        Beklemede Olan Siparişler
    </a>
</div>

