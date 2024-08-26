 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<section class="content col-md-4">

<div class="card card-primary">
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
<input type="text" class="form-control <?=($ust_data != null ? "" : "text-danger")?>" id="exampleInputPassword1" value="<?=($ust_data != null ? $ust_data->stok_tanim_ad." - ".$ust_data->stok_seri_kod : "Herhangi bir stoğa tanımlı değil")?>">
</div>
<div class="form-group">
<label for="exampleInputFile">File input</label>
<div class="input-group">
<div class="custom-file">
<input type="file" class="custom-file-input" id="exampleInputFile">
<label class="custom-file-label" for="exampleInputFile">Choose file</label>
</div>
<div class="input-group-append">
<span class="input-group-text">Upload</span>
</div>
</div>
</div>
<div class="form-check">
<input type="checkbox" class="form-check-input" id="exampleCheck1">
<label class="form-check-label" for="exampleCheck1">Check me out</label>
</div>
</div>

<div class="card-footer">
<button type="submit" class="btn btn-primary">Submit</button>
</div>
</form>
</div>


</section>
            </div>