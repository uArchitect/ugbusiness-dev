<?php $this->load->view('include/header'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Kullanıcı Düzenle</h1>
    </section>

    <section class="content">
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="card card-primary card-outline">
                <div class="card-header p-2">
                    <ul class="nav nav-tabs" id="custom-tabs" role="tablist">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#genel">Genel Bilgiler</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#iletisim">İletişim</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#is">İş Bilgileri</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#kisisel">Kişisel</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#saglik">Sağlık</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#egitim">Eğitim & Belgeler</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#acil">Acil Durum</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#yetki">Yetkiler</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">

                        <!-- GENEL -->
                        <div class="tab-pane fade show active" id="genel">
                            <div class="row">
                                <?php foreach (['kullanici_kod','kullanici_adi','kullanici_email_adresi','kullanici_ad_soyad','kullanici_unvan','kullanici_grup_no','kullanici_departman_id','kullanici_aktif'] as $alan): ?>
                                    <div class="form-group col-md-6">
                                        <label><?= ucfirst(str_replace("_"," ",$alan)); ?></label>
                                        <input type="text" name="<?= $alan ?>" class="form-control" value="<?= $kullanici->$alan ?>">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- ILETISIM -->
                        <div class="tab-pane fade" id="iletisim">
                            <div class="row">
                                <?php foreach (['kullanici_dahili_iletisim_no','kullanici_bireysel_iletisim_no','kullanici_adres','kullanici_bolge'] as $alan): ?>
                                    <div class="form-group col-md-6">
                                        <label><?= ucfirst(str_replace("_"," ",$alan)); ?></label>
                                        <textarea name="<?= $alan ?>" class="form-control"><?= $kullanici->$alan ?></textarea>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- IS -->
                        <div class="tab-pane fade" id="is">
                            <div class="row">
                                <?php foreach (['hizli_yonlendirme_sira_no','kullanici_satisci_mi','kurulum_ekip_durumu','kullanici_yonetici_kullanici_id','kullanici_ise_giris_tarihi','servis_elemani'] as $alan): ?>
                                    <div class="form-group col-md-6">
                                        <label><?= ucfirst(str_replace("_"," ",$alan)); ?></label>
                                        <input type="text" name="<?= $alan ?>" class="form-control" value="<?= $kullanici->$alan ?>">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- KISISSEL -->
                        <div class="tab-pane fade" id="kisisel">
                            <div class="row">
                                <?php foreach (['kullanici_dogum_tarihi','kullanici_tc_kimlik_no','kullanici_uyruk','kullanici_medeni_durum','kullanici_cocuk_var_mi','kullanici_cocuk_bilgileri','kullanici_askerlik_durum'] as $alan): ?>
                                    <div class="form-group col-md-6">
                                        <label><?= ucfirst(str_replace("_"," ",$alan)); ?></label>
                                        <textarea name="<?= $alan ?>" class="form-control"><?= $kullanici->$alan ?></textarea>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- SAGLIK -->
                        <div class="tab-pane fade" id="saglik">
                            <div class="row">
                                <?php foreach (['kullanici_kan_grubu','kullanici_surekli_kullandigi_ilac','kullanici_kronik_hastalik_bilgisi'] as $alan): ?>
                                    <div class="form-group col-md-6">
                                        <label><?= ucfirst(str_replace("_"," ",$alan)); ?></label>
                                        <textarea name="<?= $alan ?>" class="form-control"><?= $kullanici->$alan ?></textarea>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- EGITIM -->
                        <div class="tab-pane fade" id="egitim">
                            <div class="row">
                                <?php foreach (['kullanici_okul_adi','kullanici_ogrenim_derecesi','kullanici_mezuniyet_tarihi','kullanici_sertifika','kullanici_dil_bilgisi','kullanici_ehliyet_bilgileri','kullanici_ehliyet_ticari'] as $alan): ?>
                                    <div class="form-group col-md-6">
                                        <label><?= ucfirst(str_replace("_"," ",$alan)); ?></label>
                                        <textarea name="<?= $alan ?>" class="form-control"><?= $kullanici->$alan ?></textarea>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- ACIL -->
                        <div class="tab-pane fade" id="acil">
                            <div class="row">
                                <?php foreach (['kullanici_acil_durum_iletisim','kullanici_acil_durum_yakinlik'] as $alan): ?>
                                    <div class="form-group col-md-6">
                                        <label><?= ucfirst(str_replace("_"," ",$alan)); ?></label>
                                        <textarea name="<?= $alan ?>" class="form-control"><?= $kullanici->$alan ?></textarea>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- YETKI -->
                        <div class="tab-pane fade" id="yetki">
                            <div class="row">
                                <?php foreach (['ozluk_menu_gorunum','arac_menu_gorunum','satis_menu_gorunum','egitim_menu_gorunum','talep_menu_gorunum','mesai_menu_gorunum','envanter_menu_gorunum','iletisim_menu_gorunum'] as $alan): ?>
                                    <div class="form-group col-md-6">
                                        <label><?= ucfirst(str_replace("_"," ",$alan)); ?></label>
                                        <input type="text" name="<?= $alan ?>" class="form-control" value="<?= $kullanici->$alan ?>">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Kaydet</button>
                </div>
            </div>
        </form>
    </section>
</div>

<?php $this->load->view('include/footer'); ?>
