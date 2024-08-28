 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content">
        <div class="row d-flex">
            <div class="col">
                <div class="card card-primary" style="margin-top: 8px;">
                    <div class="card-header">
                        <h3 class="card-title">Stok Bilgilerini Düzenle</h3>
                    </div>
                    <form action="<?=base_url("stok_tanim/save/$tanim_data->stok_tanim_id")?>" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Stok Adı</label>
                                <input type="text" class="form-control" name="stok_tanim_ad" value="<?=$tanim_data->stok_tanim_ad?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Stok Açıklama</label>
                                <input type="text" class="form-control" name="stok_tanim_aciklama" placeholder="Stok Açıklaması Girilmedi" value="<?=$tanim_data->stok_tanim_aciklama?>">
                            </div>
                            <div class="row">
                                <div class="col pl-0">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Stok Takip / Sıralı</label>
                                        <select name="stok_takip"  class="form-control select2 select2-danger">
                                            <option value="0" <?=($tanim_data->stok_takip == 0) ? "selected" : ""?>>Sıralı Ürün / Otomatik Seri Kod</option>
                                            <option value="1" <?=($tanim_data->stok_takip == 1) ? "selected" : ""?>>Stok Ürünü / Seri Kod Üretilmez</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col pr-0">

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Stok Serikod Ön Ek</label>
                                        <input type="text" class="form-control" name="stok_tanim_prefix" min="0" placeholder="Stok Prefix Giriniz" value="<?=$tanim_data->stok_tanim_prefix?>">
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Kritik Stok SMS Bildirim</label>
                                <select name="stok_kritik_sms_bildirim"  class="form-control select2 select2-danger">
                                    <option value="1" <?=($tanim_data->stok_kritik_sms_bildirim == 1) ? "selected" : ""?>>EVET</option>
                                    <option value="0" <?=($tanim_data->stok_kritik_sms_bildirim == 0) ? "selected" : ""?>>HAYIR</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Kritik Stok Miktarı</label>
                                <span style="color: #db7000;display: block;margin-top: -12px;margin-bottom: 7px;">Miktar <b>0</b> olarak seçilirse <b>stok alt limit</b> kontrolü yapılmaz.</span>
                                <input type="number" class="form-control" name="stok_kritik_sayi" min="0" placeholder="Kritik Stok Miktarı Giriniz" value="<?=$tanim_data->stok_kritik_sayi?>">
                            </div>
                          
                            <div class="form-group <?=($stok_data == null) ? "d-none":""?>">
                                <label for="exampleInputPassword1">Tanımlı Olduğu Stok</label>
                                <input type="text" disabled class="form-control <?=($ust_data != null ? "" : "text-danger")?>" id="exampleInputPassword1" value="<?=($ust_data != null ? $ust_data->stok_tanim_ad." - ".$ust_data->stok_seri_kod : "Herhangi bir stoğa tanımlı değil")?>">
                                <?php 
                                if($ust_data != null){
                                ?>
                                <a href="<?=base_url("stok_tanim/ust_grup_sil/$stok_data->stok_id")?>" class="btn btn-outline-danger" style="width: -webkit-fill-available; margin-top: 5px;">
                                    STOK BAĞLANTISINI KALDIR
                                </a>
                                <?php
                                }

                                ?>
                                </div>

                                <div class="form-group mt-3 <?=($stok_data == null) ? "d-none":""?>">
                                <label for="exampleInputPassword1">Tanımlı Olduğu Cihaz Seri Numarası</label>
                                <input type="text" disabled class="form-control <?=($stok_data->tanimlanan_cihaz_seri_numarasi != "" && $stok_data->tanimlanan_cihaz_seri_numarasi != "0") ? "" : "text-danger"?>" 
                                id="exampleInputPassword1" value="<?=($stok_data->tanimlanan_cihaz_seri_numarasi != "" && $stok_data->tanimlanan_cihaz_seri_numarasi != "0") ? $stok_data->tanimlanan_cihaz_seri_numarasi : "Herhangi bir cihaza tanımlı değil"?>">
                                <?php 
                                if($stok_data->tanimlanan_cihaz_seri_numarasi != "" && $stok_data->tanimlanan_cihaz_seri_numarasi != "0"){
                                ?>
                                <a href="<?=base_url("stok_tanim/cihaz_baglanti_sil/$stok_data->stok_id")?>" class="btn btn-outline-danger" style="width: -webkit-fill-available; margin-top: 5px;">
                                    CİHAZ BAĞLANTISINI KALDIR
                                </a>
                                <?php
                                }

                                ?>
                                </div>


                                <div class="form-group mt-3 <?=($stok_data == null) ? "d-none":""?>">
                                <label for="exampleInputPassword1">Kullanılabilirlik Durumu</label>
                                    <?php 
                                    if($stok_data->stok_cop_mu == 0){
                                    ?>
                                    <a href="<?=base_url("stok_tanim/cop_kutusu_guncelle/$stok_data->stok_id/1")?>" class="btn btn-outline-danger" style="width: -webkit-fill-available; margin-top: 5px;">
                                        Çöp Kutusuna Aktar
                                    </a>
                                    <?php
                                    }else{
                                        ?>
                                        <a href="<?=base_url("stok_tanim/cop_kutusu_guncelle/$stok_data->stok_id/0")?>" class="btn btn-outline-warning" style="width: -webkit-fill-available; margin-top: 5px;">
                                        Çöp Kutusundan Çıkar
                                        </a>
                                        <?php
                                        
                                    }

                                    ?>
                                </div>
                        </div>

                        <div class="card-footer">
                        <button type="submit" class="btn btn-success">Bilgileri Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col">


            <?php if(count($hareket_list) > 0){ ?>
            <div class="card card-danger" style="margin-top: 8px;">
                <div class="card-header">
                    STOK HAREKETLERİ
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Stok Adı</th>
                            
                                <th>Giriş Miktar</th>
                                <th>Çıkış Miktar</th>
                                <th>Çıkış Birimi</th>
                                <th>Kullanıcı</th>
                                <th>Hareket Tarihi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($hareket_list as $h): ?>
                            <tr>
                                    <td></td>
                                    <?php 
                                    
                                    if($h->giris_miktar == 0){
                                        ?>
                                            <td style="color: red;">STOK ÇIKIŞI YAPILDI</td>
                                        <?php
                                    }else{
                                        ?>
                                        <td style="color: green;">STOK GİRİŞİ YAPILDI</td>
                                    <?php
                                    }
                                    
                                    ?>
                                 
                                    <td style="<?= $h->giris_miktar > 0 ? 'font-weight:bold' : '' ?>">
                                        <?= $h->giris_miktar > 0 ? "{$h->giris_miktar} ADET" : '-' ?>
                                    </td>
                                    <td style="<?= $h->cikis_miktar > 0 ? 'font-weight:bold' : '' ?>">
                                        <?= $h->cikis_miktar > 0 ? "{$h->cikis_miktar} ADET" : '-' ?>
                                    </td>
                                    <td><?= htmlspecialchars($h->stok_cikis_birim_adi ?? '-') ?></td>
                                    <td><i class="fa fa-user-circle"></i> <?= htmlspecialchars($h->kullanici_ad_soyad) ?></td>
                                    <td><?= date('d.m.Y H:i', strtotime($h->hareket_kayit_tarihi)) ?></td>
                                </tr>
                            <?php endforeach; ?>
                                
                        </tbody>
                    </table>
                    </div>
            </div>
            <?php
            }

            ?>

</div>
</div>


</section>
            </div>