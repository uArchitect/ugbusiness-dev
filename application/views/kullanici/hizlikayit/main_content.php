 
<div class="content-wrapper">
    <section class="content-header">
        <h1><?=$kullanici->kullanici_ad_soyad?> - <?=$kullanici->kullanici_unvan?></h1>
    </section>

    <section class="content">
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="row">
                <div class="col-md-6">
            <div class="card card-primary card-outline">
                <div class="card-header p-2">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#genel">Genel</a></li> 
                    </ul>
                </div>

                <div class="card-body">
                    <div class="tab-content">

                        <!-- GENEL -->
                        <div class="tab-pane fade show active" id="genel">
                              
                            
                        
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>İşe Giriş Tarihi</label>
                                    <input type="date" name="kullanici_ise_giris_tarihi" class="form-control" value="<?= $kullanici->kullanici_ise_giris_tarihi ?>">
                                </div>
                              
                                <div class="form-group col-md-4">
                                    <label>Doğum Tarihi</label>
                                    <input type="date" name="kullanici_dogum_tarihi" class="form-control" value="<?= $kullanici->kullanici_dogum_tarihi ?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>T.C. Kimlik No</label>
                                    <input type="text" name="kullanici_tc_kimlik_no" class="form-control" value="<?= $kullanici->kullanici_tc_kimlik_no ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Uyruk</label>
                                    <input type="text" name="kullanici_uyruk" class="form-control" value="<?= $kullanici->kullanici_uyruk ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Medeni Durum</label>
                                   <select name="kullanici_medeni_durum" class="form-control">
                                    <option <?=$kullanici->kullanici_medeni_durum == "BİLİNMİYOR" ? "selected" : ""?> value="BİLİNMİYOR">BİLİNMİYOR</option>    
                                <option <?=$kullanici->kullanici_medeni_durum == "EVLİ" ? "selected" : ""?> value="EVLİ">EVLİ</option>
                                <option <?=$kullanici->kullanici_medeni_durum == "BEKAR" ? "selected" : ""?> value="BEKAR">BEKAR</option>    
                                </select>
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
                                <div class="form-group col-md-12">
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
                                 <div class="form-group col-md-12">
                                    <label>Sertifika</label>
                                    <textarea name="kullanici_sertifika" class="form-control"><?= $kullanici->kullanici_sertifika ?></textarea>
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Yabancı Dil Bilgisi</label>
                                    <textarea name="kullanici_dil_bilgisi" class="form-control"><?= $kullanici->kullanici_dil_bilgisi ?></textarea>
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
                             <div class="form-group col-md-6">
                                    <label>Ehliyet</label>
                                    <input type="text" name="kullanici_ehliyet_bilgileri" class="form-control" value="<?= $kullanici->kullanici_ehliyet_bilgileri ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>SRC Belgesi Var Mı?</label>
                                    <input type="text" name="kullanici_src_var_mi" class="form-control" value="<?= $kullanici->kullanici_src_var_mi ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Askerlik </label>
                                    <input type="text" name="kullanici_askerlik_durum" class="form-control" value="<?= $kullanici->kullanici_askerlik_durum ?>">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Kaydet</button>
                </div>
            </div>

            </div>
            </div>

        </form>
    </section>
</div>
 
