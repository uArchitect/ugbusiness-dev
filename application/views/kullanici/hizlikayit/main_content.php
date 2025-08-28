 
<div class="content-wrapper">
    <section class="content-header">
        <h1>Kullanıcı Düzenle</h1>
    </section>

    <section class="content">
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><?= $kullanici->kullanici_ad_soyad; ?></h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php foreach ($this->db->list_fields('kullanicilar') as $alan): ?>
                            <?php if ($alan == "kullanici_id") continue; // primary key düzenlenmesin ?>

                            <div class="form-group col-md-6">
                                <label><?= ucfirst(str_replace("_", " ", $alan)); ?></label>

                                <?php if (in_array($alan, ["kullanici_adres","kullanici_resim","baslangic_ekrani","kullanici_api_pc_key","kullanici_kart","kullanici_uyruk","kullanici_medeni_durum","kullanici_cocuk_bilgileri","kullanici_askerlik_durum","kullanici_tc_kimlik_no","kullanici_adres_kodu","kullanici_kan_grubu","kullanici_surekli_kullandigi_ilac","kullanici_kronik_hastalik_bilgisi","kullanici_ehliyet_bilgileri","kullanici_sertifika","kullanici_dil_bilgisi","kullanici_okul_adi","kullanici_ogrenim_derecesi","kullanici_mezuniyet_tarihi","kullanici_acil_durum_iletisim","kullanici_acil_durum_yakinlik"])): ?>
                                    <textarea name="<?= $alan ?>" class="form-control" rows="2"><?= $kullanici->$alan ?></textarea>
                                <?php else: ?>
                                    <input type="text" name="<?= $alan ?>" class="form-control" value="<?= $kullanici->$alan ?>">
                                <?php endif; ?>
                            </div>

                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Kaydet</button>
                </div>
            </div>
        </form>
    </section>
</div>
 