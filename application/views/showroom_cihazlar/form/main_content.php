<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
  <div class="row mt-2">
    <div class="col mb*0">
      <div class="card <?=isset($guncellenecekcihaz) ? "card-warning" : "card-success"?>">
        <div class="card-header">
          <h3 class="card-title"><?=isset($guncellenecekcihaz) ? "BİLGİLERİ GÜNCELLE" : "YENİ KAYIT EKLE"?></h3>
        </div>
        <div class="card-body">

<?php if(isset($guncellenecekcihaz)) { ?>

<form action="<?=base_url("cihaz/showroom_guncelle/$guncellenecekcihaz->showroom_cihaz_id")?>" method="post"> 
  <div class="row">
    <div class="col-3">
      <select class="form-control" name="showroom_cihaz_bolum_no">
        <option <?=$guncellenecekcihaz->showroom_cihaz_bolum_no == 1 ? "selected":""?> value="1">ADANA SHOWROOW</option>
        <option <?=$guncellenecekcihaz->showroom_cihaz_bolum_no == 2 ? "selected":""?> value="2">İSTANBUL SHOWROOW</option>
        <option <?=$guncellenecekcihaz->showroom_cihaz_bolum_no == 3 ? "selected":""?> value="3">ANKARA SHOWROOW</option>
      </select>
    </div>
    <div class="col-3">
      <select class="form-control" name="showroom_cihaz_urun_no">
        <option <?=$guncellenecekcihaz->showroom_cihaz_urun_no == 8 ? "selected":""?> value="8">UMEX PLUS</option>
        <option <?=$guncellenecekcihaz->showroom_cihaz_urun_no == 1 ? "selected":""?> value="1">UMEX LAZER</option>
        <option <?=$guncellenecekcihaz->showroom_cihaz_urun_no == 2 ? "selected":""?> value="2">UMEX DIODE</option>
        <option <?=$guncellenecekcihaz->showroom_cihaz_urun_no == 3 ? "selected":""?> value="3">UMEX EMS</option>
        <option <?=$guncellenecekcihaz->showroom_cihaz_urun_no == 4 ? "selected":""?> value="4">UMEX GOLD</option>
        <option <?=$guncellenecekcihaz->showroom_cihaz_urun_no == 5 ? "selected":""?> value="5">UMEX SLIM</option>
        <option <?=$guncellenecekcihaz->showroom_cihaz_urun_no == 6 ? "selected":""?> value="6">UMEX S</option>
        <option <?=$guncellenecekcihaz->showroom_cihaz_urun_no == 7 ? "selected":""?> value="7">UMEX Q</option>
      </select>
    </div>
    <div class="col-4">
      <input type="text" value="<?=$guncellenecekcihaz->showroom_cihaz_seri_no?>" class="form-control" name="showroom_cihaz_seri_no" placeholder="Cihaz Seri Numarası">
    </div>
    <div class="col-2">
      <button type="submit" class="btn btn-success" style="width: 100%;">KAYDET</button>
    </div>
  </div>
</form>

<?php } else { ?>

<form action="<?=base_url("cihaz/showroom_kaydet")?>" method="post"> 
  <div class="row">
    <div class="col-3">
      <select class="form-control" name="showroom_cihaz_bolum_no">
        <option value="">Showroom Seçiniz</option>
        <option value="1">ADANA SHOWROOW</option>
        <option value="2">İSTANBUL SHOWROOW</option>
        <option value="3">ANKARA SHOWROOW</option>
      </select>
    </div>
    <div class="col-3">
      <select class="form-control" name="showroom_cihaz_urun_no">
        <option value="">Ürün Seçiniz</option>
        <option value="8">UMEX PLUS</option>
        <option value="1">UMEX LAZER</option>
        <option value="2">UMEX DIODE</option>
        <option value="3">UMEX EMS</option>
        <option value="4">UMEX GOLD</option>
        <option value="5">UMEX SLIM</option>
        <option value="6">UMEX S</option>
        <option value="7">UMEX Q</option>
      </select>
    </div>
    <div class="col-4">
      <input type="text" class="form-control" name="showroom_cihaz_seri_no" placeholder="Cihaz Seri Numarası">
    </div>
    <div class="col-2">
      <button type="submit" class="btn btn-success" style="width: 100%;">KAYDET</button>
    </div>
  </div>
</form>

<?php } ?>

        </div>
      </div>
    </div>
  </div>

  <div class="row">

<!-- ========================================================= -->
<!-- ✅ ADANA SHOWROOM -->
<!-- ========================================================= -->

<section class="content col-md-4">
  <div class="card card-dark">
    <div class="card-header with-border">
      <h3 class="card-title mt-1">ADANA SHOWROOM</h3>
    </div>
    <div class="card-body">

<?php foreach ($cihazlar as $urun) { if($urun->showroom_cihaz_bolum_no != 1) continue; ?>

<a href="<?=base_url("cihaz/showrooms/$urun->showroom_cihaz_id ")?>"  
   style="padding-right: 0px;width: 100%; margin-bottom:10px; border: 1px dashed #002355; padding-left:0px; position:relative;"  
   class="btn btn-default text-left pb-2">

  <!-- ✅ SİLME BUTONU SAĞ ÜSTTE -->
  <a class="btn btn-danger btn-sm" 
     href="<?=base_url("cihaz/showroom_urun_dil/$urun->showroom_cihaz_id")?>" 
     style="position:absolute; top:5px; right:5px; z-index:10;">
     Sil
  </a>

  <div class="row" style="height: 71px;">
    <div class="col" style="max-width: 87px;">
      <img src="<?="https://www.umex.com.tr/uploads/products/".$urun->urun_slug.".png"?>" 
           style="width: 83px;" class="rounded img-thumbnail">
    </div>

    <div class="col" style="padding-left: 0px;">
      <span style="display:block; background:#dbdbdb; padding:5px; color:white; border-radius:3px 3px 0 0;">
        <span style="min-width:230px; padding:9px; display:inline-block; margin-left:5px">
          <b style="color:#0f3979"><?=$urun->urun_adi?></b><br>
          <span style="color:#000">
            Cihaz Seri Numarası: 
            <b><?=$urun->showroom_cihaz_seri_no?></b>
          </span>
        </span>
      </span>
    </div>
  </div>

</a>

<?php } ?>

    </div>
  </div>
</section>

<!-- ========================================================= -->
<!-- ✅ İSTANBUL SHOWROOM -->
<!-- ========================================================= -->

<section class="content col-md-4">
  <div class="card card-dark">
    <div class="card-header with-border">
      <h3 class="card-title mt-1">İSTANBUL SHOWROOM</h3>
    </div>
    <div class="card-body">

<?php foreach ($cihazlar as $urun) { if($urun->showroom_cihaz_bolum_no != 2) continue; ?>

<a href="<?=base_url("cihaz/showrooms/$urun->showroom_cihaz_id ")?>"  
   style="padding-right: 0px;width: 100%; margin-bottom:10px; border: 1px dashed #002355; padding-left:0px; position:relative;"  
   class="btn btn-default text-left pb-2">

  <!-- ✅ SİL BUTONU -->
  <a class="btn btn-danger btn-sm" 
     href="<?=base_url("cihaz/showroom_urun_dil/$urun->showroom_cihaz_id")?>" 
     style="position:absolute; top:5px; right:5px; z-index:10;">
     Sil
  </a>

  <div class="row" style="height: 71px;">
    <div class="col" style="max-width: 87px;">
      <img src="<?="https://www.umex.com.tr/uploads/products/".$urun->urun_slug.".png"?>" 
           style="width: 83px;" class="rounded img-thumbnail">
    </div>

    <div class="col" style="padding-left: 0px;">
      <span style="display:block; background:#dbdbdb; padding:5px; color:white; border-radius:3px 3px 0 0;">
        <span style="min-width:230px; padding:9px; display:inline-block; margin-left:5px">
          <b style="color:#0f3979"><?=$urun->urun_adi?></b><br>
          <span style="color:#000">
            Cihaz Seri Numarası: <b><?=$urun->showroom_cihaz_seri_no?></b>
          </span>
        </span>
      </span>
    </div>
  </div>

</a>

<?php } ?>

    </div>
  </div>
</section>

<!-- ========================================================= -->
<!-- ✅ ANKARA SHOWROOM -->
<!-- ========================================================= -->

<section class="content col-md-4">
  <div class="card card-dark">
    <div class="card-header with-border">
      <h3 class="card-title mt-1">ANKARA SHOWROOM</h3>
    </div>
    <div class="card-body">

<?php foreach ($cihazlar as $urun) { if($urun->showroom_cihaz_bolum_no != 3) continue; ?>

<a href="<?=base_url("cihaz/showrooms/$urun->showroom_cihaz_id ")?>"  
   style="padding-right: 0px;width: 100%; margin-bottom:10px; border: 1px dashed #002355; padding-left:0px; position:relative;"  
   class="btn btn-default text-left pb-2">

  <!-- ✅ SİL BUTONU -->
  <a class="btn btn-danger btn-sm" 
     href="<?=base_url("cihaz/showroom_urun_dil/$urun->showroom_cihaz_id")?>" 
     style="position:absolute; top:5px; right:5px; z-index:10;">
     Sil
  </a>

  <div class="row" style="height: 71px;">
    <div class="col" style="max-width: 87px;">
      <img src="<?="https://www.umex.com.tr/uploads/products/".$urun->urun_slug.".png"?>" 
           style="width: 83px;" class="rounded img-thumbnail">
    </div>

    <div class="col" style="padding-left: 0px;">
      <span style="display:block; background:#dbdbdb; padding:5px; color:white; border-radius:3px 3px 0 0;">
        <span style="min-width:230px; padding:9px; display:inline-block; margin-left:5px">
          <b style="color:#0f3979"><?=$urun->urun_adi?></b><br>
          <span style="color:#000">
            Cihaz Seri Numarası: <b><?=$urun->showroom_cihaz_seri_no?></b>
          </span>
        </span>
      </span>
    </div>
  </div>

</a>

<?php } ?>

    </div>
  </div>
</section>

</div>
</div>
