 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<section class="content col-md-4">

<div class="card card-primary" style="margin-top: 8px;">
<div class="card-header">
<h3 class="card-title">Stok Bilgilerini Düzenle</h3>
</div>


<form action="<?=base_url("stok_tanim/save/$data->stok_tanim_id")?>" method="POST">
<div class="card-body">
<div class="form-group">
<label for="exampleInputEmail1">Stok Adı</label>
<input type="text" class="form-control" name="stok_tanim_ad" value="<?=$data->stok_tanim_ad?>">
</div>
<div class="form-group">
<label for="exampleInputEmail1">Stok Açıklama</label>
<input type="text" class="form-control" name="stok_tanim_aciklama" value="<?=$data->stok_tanim_aciklama?>">
</div>
<div class="form-group">
<label for="exampleInputPassword1">Tanımlı Olduğu Stok</label>
<input type="text" disabled class="form-control <?=($ust_data != null ? "" : "text-danger")?>" id="exampleInputPassword1" value="<?=($ust_data != null ? $ust_data->stok_tanim_ad." - ".$ust_data->stok_seri_kod : "Herhangi bir stoğa tanımlı değil")?>">
<?php 
if($ust_data != null){
?>
<a href="<?=base_url("stok_tanim/ust_grup_sil/$data->stok_id")?>" class="btn btn-outline-danger" style="width: -webkit-fill-available; margin-top: 5px;">
    STOK BAĞLANTISINI KALDIR
</a>
<?php
}

?>




<div class="form-group mt-2">
<label for="exampleInputPassword1">Tanımlı Olduğu Cihaz Seri Numarası</label>
<input type="text" disabled class="form-control <?=($data->tanimlanan_cihaz_seri_numarasi != "" && $data->tanimlanan_cihaz_seri_numarasi != "0") ? "" : "text-danger"?>" 
id="exampleInputPassword1" value="<?=($data->tanimlanan_cihaz_seri_numarasi != "" && $data->tanimlanan_cihaz_seri_numarasi != "0") ? $data->tanimlanan_cihaz_seri_numarasi : "Herhangi bir cihaza tanımlı değil"?>">
<?php 
if($data->tanimlanan_cihaz_seri_numarasi != "" && $data->tanimlanan_cihaz_seri_numarasi != "0"){
?>
<a href="<?=base_url("stok_tanim/cihaz_baglanti_sil/$data->stok_id")?>" class="btn btn-outline-danger" style="width: -webkit-fill-available; margin-top: 5px;">
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