 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<section class="content col-md-4">

<div class="card card-primary" style="margin-top: 8px;">
<div class="card-header">
<h3 class="card-title">Stok Bilgilerini Düzenle</h3>
</div>


<form action="stok">
<div class="card-body">
<div class="form-group">
<label for="exampleInputEmail1">Stok Adı</label>
<input type="text" class="form-control" value="<?=$data->stok_tanim_ad?>">
</div>
<div class="form-group">
<label for="exampleInputPassword1">Tanımlı Olduğu Stok</label>
<input type="text" disabled class="form-control <?=($ust_data != null ? "" : "text-danger")?>" id="exampleInputPassword1" value="<?=($ust_data != null ? $ust_data->stok_tanim_ad." - ".$ust_data->stok_seri_kod : "Herhangi bir stoğa tanımlı değil")?>">
<?php 
if($ust_data != null){
?>
<a href="stok_tanim/ust_grup_sil/<?=$data->stok_ust_grup_kayit_no?>" class="btn btn-danger" style="width: -webkit-fill-available; margin-top: 5px;">
    BAĞLANTIYI KALDIR
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