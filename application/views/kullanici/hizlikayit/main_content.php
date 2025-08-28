 
<div class="content-wrapper">
    <section class="content-header">
        <h1><?=$kullanici->kullanici_ad_soyad?> - <?=$kullanici->kullanici_unvan?></h1>
    </section>

    <section class="content">
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="card card-primary card-outline">
                <div class="card-header p-2">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#genel">Genel</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#iletisim">İletişim</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#is">İş</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#kisisel">Kişisel</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#saglik">Sağlık</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#egitim">Eğitim</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#acil">Acil</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#yetki">Yetkiler</a></li>
                    </ul>
                </div>

                <div class="card-body">
                    <div class="tab-content">

                        <!-- GENEL -->
                        <div class="tab-pane fade show active" id="genel">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Kullanıcı Kod</label>
                                    <input type="text" name="kullanici_kod" class="form-control" value="<?= $kullanici->kullanici_kod ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Kullanıcı Adı</label>
                                    <input type="text" name="kullanici_adi" class="form-control" value="<?= $kullanici->kullanici_adi ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>E-Posta</label>
                                    <input type="email" name="kullanici_email_adresi" class="form-control" value="<?= $kullanici->kullanici_email_adresi ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Ad Soyad</label>
                                    <input type="text" name="kullanici_ad_soyad" class="form-control" value="<?= $kullanici->kullanici_ad_soyad ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Unvan</label>
                                    <input type="text" name="kullanici_unvan" class="form-control" value="<?= $kullanici->kullanici_unvan ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Aktif mi?</label>
                                    <select name="kullanici_aktif" class="form-control">
                                        <option value="1" <?= $kullanici->kullanici_aktif==1?"selected":"" ?>>Evet</option>
                                        <option value="0" <?= $kullanici->kullanici_aktif==0?"selected":"" ?>>Hayır</option>
                                    </select>
                                </div>
                            </div>
                      
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Dahili İletişim No</label>
                                    <input type="text" name="kullanici_dahili_iletisim_no" class="form-control" value="<?= $kullanici->kullanici_dahili_iletisim_no ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Bireysel İletişim No</label>
                                    <input type="text" name="kullanici_bireysel_iletisim_no" class="form-control" value="<?= $kullanici->kullanici_bireysel_iletisim_no ?>">
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Adres</label>
                                    <textarea name="kullanici_adres" class="form-control"><?= $kullanici->kullanici_adres ?></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Bölge</label>
                                    <input type="text" name="kullanici_bolge" class="form-control" value="<?= $kullanici->kullanici_bolge ?>">
                                </div>
                            </div>
                        
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>İşe Giriş Tarihi</label>
                                    <input type="date" name="kullanici_ise_giris_tarihi" class="form-control" value="<?= $kullanici->kullanici_ise_giris_tarihi ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Kurulum Ekip Durumu</label>
                                    <select name="kurulum_ekip_durumu" class="form-control">
                                        <option value="1" <?= $kullanici->kurulum_ekip_durumu==1?"selected":"" ?>>Evet</option>
                                        <option value="0" <?= $kullanici->kurulum_ekip_durumu==0?"selected":"" ?>>Hayır</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Departman ID</label>
                                    <input type="number" name="kullanici_departman_id" class="form-control" value="<?= $kullanici->kullanici_departman_id ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Yönetici Kullanıcı ID</label>
                                    <input type="number" name="kullanici_yonetici_kullanici_id" class="form-control" value="<?= $kullanici->kullanici_yonetici_kullanici_id ?>">
                                </div>
                            </div>
                        
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Doğum Tarihi</label>
                                    <input type="date" name="kullanici_dogum_tarihi" class="form-control" value="<?= $kullanici->kullanici_dogum_tarihi ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>T.C. Kimlik No</label>
                                    <input type="text" name="kullanici_tc_kimlik_no" class="form-control" value="<?= $kullanici->kullanici_tc_kimlik_no ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Uyruk</label>
                                    <input type="text" name="kullanici_uyruk" class="form-control" value="<?= $kullanici->kullanici_uyruk ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Medeni Durum</label>
                                    <input type="text" name="kullanici_medeni_durum" class="form-control" value="<?= $kullanici->kullanici_medeni_durum ?>">
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Çocuk Bilgileri</label>
                                    <textarea name="kullanici_cocuk_bilgileri" class="form-control"><?= $kullanici->kullanici_cocuk_bilgileri ?></textarea>
                                </div>
                            </div>
                     
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Kan Grubu</label>
                                    <input type="text" name="kullanici_kan_grubu" class="form-control" value="<?= $kullanici->kullanici_kan_grubu ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Sürekli Kullandığı İlaç</label>
                                    <input type="text" name="kullanici_surekli_kullandigi_ilac" class="form-control" value="<?= $kullanici->kullanici_surekli_kullandigi_ilac ?>">
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Kronik Hastalık</label>
                                    <textarea name="kullanici_kronik_hastalik_bilgisi" class="form-control"><?= $kullanici->kullanici_kronik_hastalik_bilgisi ?></textarea>
                                </div>
                            </div>
                      
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Okul Adı</label>
                                    <input type="text" name="kullanici_okul_adi" class="form-control" value="<?= $kullanici->kullanici_okul_adi ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Öğrenim Derecesi</label>
                                    <input type="text" name="kullanici_ogrenim_derecesi" class="form-control" value="<?= $kullanici->kullanici_ogrenim_derecesi ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Mezuniyet Tarihi</label>
                                    <input type="text" name="kullanici_mezuniyet_tarihi" class="form-control" value="<?= $kullanici->kullanici_mezuniyet_tarihi ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Dil Bilgisi</label>
                                    <textarea name="kullanici_dil_bilgisi" class="form-control"><?= $kullanici->kullanici_dil_bilgisi ?></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Sertifika</label>
                                    <textarea name="kullanici_sertifika" class="form-control"><?= $kullanici->kullanici_sertifika ?></textarea>
                                </div>
                            </div>
                      
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Acil İletişim</label>
                                    <input type="text" name="kullanici_acil_durum_iletisim" class="form-control" value="<?= $kullanici->kullanici_acil_durum_iletisim ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Yakınlık</label>
                                    <input type="text" name="kullanici_acil_durum_yakinlik" class="form-control" value="<?= $kullanici->kullanici_acil_durum_yakinlik ?>">
                                </div>
                            </div>
                       
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Özlük Menüsü</label>
                                    <select name="ozluk_menu_gorunum" class="form-control">
                                        <option value="1" <?= $kullanici->ozluk_menu_gorunum==1?"selected":"" ?>>Evet</option>
                                        <option value="0" <?= $kullanici->ozluk_menu_gorunum==0?"selected":"" ?>>Hayır</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Araç Menüsü</label>
                                    <select name="arac_menu_gorunum" class="form-control">
                                        <option value="1" <?= $kullanici->arac_menu_gorunum==1?"selected":"" ?>>Evet</option>
                                        <option value="0" <?= $kullanici->arac_menu_gorunum==0?"selected":"" ?>>Hayır</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Satış Menüsü</label>
                                    <select name="satis_menu_gorunum" class="form-control">
                                        <option value="1" <?= $kullanici->satis_menu_gorunum==1?"selected":"" ?>>Evet</option>
                                        <option value="0" <?= $kullanici->satis_menu_gorunum==0?"selected":"" ?>>Hayır</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Eğitim Menüsü</label>
                                    <select name="egitim_menu_gorunum" class="form-control">
                                        <option value="1" <?= $kullanici->egitim_menu_gorunum==1?"selected":"" ?>>Evet</option>
                                        <option value="0" <?= $kullanici->egitim_menu_gorunum==0?"selected":"" ?>>Hayır</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Talep Menüsü</label>
                                    <select name="talep_menu_gorunum" class="form-control">
                                        <option value="1" <?= $kullanici->talep_menu_gorunum==1?"selected":"" ?>>Evet</option>
                                        <option value="0" <?= $kullanici->talep_menu_gorunum==0?"selected":"" ?>>Hayır</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Mesai Menüsü</label>
                                    <select name="mesai_menu_gorunum" class="form-control">
                                        <option value="1" <?= $kullanici->mesai_menu_gorunum==1?"selected":"" ?>>Evet</option>
                                        <option value="0" <?= $kullanici->mesai_menu_gorunum==0?"selected":"" ?>>Hayır</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Envanter Menüsü</label>
                                    <select name="envanter_menu_gorunum" class="form-control">
                                        <option value="1" <?= $kullanici->envanter_menu_gorunum==1?"selected":"" ?>>Evet</option>
                                        <option value="0" <?= $kullanici->envanter_menu_gorunum==0?"selected":"" ?>>Hayır</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>İletişim Menüsü</label>
                                    <select name="iletisim_menu_gorunum" class="form-control">
                                        <option value="1" <?= $kullanici->iletisim_menu_gorunum==1?"selected":"" ?>>Evet</option>
                                        <option value="0" <?= $kullanici->iletisim_menu_gorunum==0?"selected":"" ?>>Hayır</option>
                                    </select>
                                </div>
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
 
