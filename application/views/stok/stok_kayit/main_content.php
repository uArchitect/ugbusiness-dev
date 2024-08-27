 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<section class="content col-md-4">

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

<div class="form-group">
<label for="exampleInputEmail1">Stok Takip / Sıralı</label>
<select name="stok_takip"  class="form-control select2 select2-danger">
    <option value="0" <?=($tanim_data->stok_takip == 0) ? "selected" : ""?>>Sıralı Ürün / Otomatik Seri Kod</option>
    <option value="1" <?=($tanim_data->stok_takip == 1) ? "selected" : ""?>>Stok Ürünü / Seri Kod Üretilmez</option>
</select>
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
<span style="
    color: #db7000;
    /* margin: 5px; */
    display: block;
    margin-top: -12px;
    margin-bottom: 7px;
">Miktar <b>0</b> olarak seçilirse <b>stok alt limit</b> kontrolü yapılmaz.</span>
<input type="number" class="form-control" name="stok_kritik_sayi" min="0" placeholder="Kritik Stok Miktarı Giriniz" value="<?=$tanim_data->stok_kritik_sayi?>">

</div>

<div class="form-group">
<label for="exampleInputEmail1">Stok Serikod Ön Ek</label>
<input type="text" class="form-control" name="stok_tanim_prefix" min="0" placeholder="Stok Prefix Giriniz" value="<?=$tanim_data->stok_tanim_prefix?>">
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




 
</div>

<div class="card-footer">
<button type="submit" class="btn btn-success">Bilgileri Kaydet</button>
</div>
</form>
</div>


</section>
            </div>