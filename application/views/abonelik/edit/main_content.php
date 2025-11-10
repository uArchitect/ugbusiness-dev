<div class="container mt-5">
    <a href="<?=base_url("abonelik")?>" class="btn btn-warning"><i class="fas fa-arrow-circle-left"></i> Abonelikler Listesine Geri Dön</a><br><br>
    <h2>Abonelik Düzenle</h2>
    <form action="<?php echo site_url('abonelik/duzenle_islem/'.$abonelik->abonelik_id); ?>" method="post" onsubmit="return validateDates()">
        <div class="form-group">
            <label>Başlık</label>
            <input type="text" name="baslik" class="form-control" value="<?php echo $abonelik->abonelik_baslik; ?>" required>
        </div>
        <div class="form-group">
            <label>Açıklama</label>
            <textarea name="aciklama" class="form-control"><?php echo $abonelik->abonelik_aciklama; ?></textarea>
        </div>
        <div class="form-group">
            <label>Başlangıç Tarihi</label>
            <input type="date" name="baslangic_tarihi" id="baslangic_tarihi" class="form-control" value="<?php echo $abonelik->abonelik_baslangic_tarihi; ?>" required>
        </div>
        <div class="form-group">
            <label>Bitiş Tarihi</label>
            <input type="date" name="bitis_tarihi" id="bitis_tarihi" class="form-control" value="<?php echo $abonelik->abonelik_bitis_tarihi; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Güncelle</button>
    </form>
</div>
<script>
function validateDates() {
    const baslangicTarihi = document.getElementById("baslangic_tarihi").value;
    const bitisTarihi = document.getElementById("bitis_tarihi").value;

    if (baslangicTarihi && bitisTarihi && baslangicTarihi > bitisTarihi) {
        alert("Başlangıç tarihi bitiş tarihinden büyük olamaz!");
        return false;
    }
    return true;
}
</script>
<style>
    .wrapper{
        background:white!important;
    }
</style>