<div class="container mt-5">
        <h2>Yeni Abonelik Ekle</h2>
        <form action="<?php echo site_url('abonelik/ekle_islem'); ?>" method="post" onsubmit="return validateDates()">
            <div class="form-group">
                <label>Başlık</label>
                <input type="text" name="baslik" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Açıklama</label>
                <textarea name="aciklama" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label>Başlangıç Tarihi</label>
                <input type="date" name="baslangic_tarihi" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Bitiş Tarihi</label>
                <input type="date" name="bitis_tarihi" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Kaydet</button>
        </form>
    </div>
<script>
    function validateDates() {
        const baslangicTarihi = document.getElementById("baslangic_tarihi").value;
        const bitisTarihi     = document.getElementById("bitis_tarihi").value;

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