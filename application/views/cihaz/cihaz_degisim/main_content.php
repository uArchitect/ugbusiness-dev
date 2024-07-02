 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
 
    <!-- /.content-header -->
<section class="content col-md-5 mt-2">
<div class="card card-dark">
    <div class="card-header with-border">
      <h3 class="card-title"> Cihaz Müşteri Değişim</h3>
     
     
    </div>
  
    <?php if(!empty($kullanici_yetki)){?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('Kullanici_yetkileri/save').'/'.$kullanici_yetki->kullanici_yetki_id;?>">
    <?php }else{?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('servis/servis_cihaz_sorgula');?>">
    <?php } ?>
    <div class="card-body">






    <div class="row">
  <div class="col">
  <div class="form-group">
        <label for="formClient-Name" style="color:#e70000;"><i class="fas fa-user-circle"></i> Değişim İşlemini Talep Eden Kullanıcı</label>
      
        <select name="" id="" class="select2 form-control">
        <?php foreach($kullanicilar as $kullanici) : ?> 
                    <option value="<?=$kullanici->kullanici_id?>"><?=$kullanici->kullanici_ad_soyad?> / <?=$kullanici->kullanici_unvan?></option>
          <?php endforeach; ?> 
    </select>

      </div>

  </div>
</div>









    
    <div class="row">

      <div class="col">
        <div class="form-group">
          <label for="formClient-Name"> Müşteri Bilgisi</label>
          <input type="text" class="form-control" disabled readonly value="<?=$siparis_urun->musteri_ad?>" name="cihaz_seri_numarasi" required autofocus="">
        </div>
      </div>

      <div class="col">
        <div class="form-group">
          <label for="formClient-Name"> İletişim</label>
          <input type="text" class="form-control" disabled readonly value="<?=formatTelephoneNumber($siparis_urun->musteri_iletisim_numarasi)?>" name="cihaz_seri_numarasi" required autofocus="">
        </div>
      </div>

    </div>
    

    <div class="row">

      <div class="col">
        <div class="form-group">
          <label for="formClient-Name"> Merkez Bilgisi</label>
          <input type="text" class="form-control" disabled readonly value="<?=$siparis_urun->merkez_adi?>" name="cihaz_seri_numarasi" required autofocus="">
        </div>
      </div>
      
      <div class="col">
        <div class="form-group">
          <label for="formClient-Name"> İletişim</label>
          <input type="text" class="form-control" disabled readonly value="<?=formatTelephoneNumber($siparis_urun->musteri_iletisim_numarasi)?>" name="cihaz_seri_numarasi" required autofocus="">
        </div>
      </div>

    </div>

    <div class="row">

<div class="col">
  <div class="form-group">
    <label for="formClient-Name"> Adres</label>
    <input type="text" class="form-control" disabled readonly value="<?=$siparis_urun->merkez_adresi?>" name="cihaz_seri_numarasi" required autofocus="">
  </div>
</div>

 

</div>





<div class="row">
  <div class="col">

  <div class="form-group">
        <label for="formClient-Name"> Ürün Adı</label>
        <input type="text" class="form-control" disabled readonly value="<?=$siparis_urun->urun_adi?>" name="cihaz_seri_numarasi" required autofocus="">
      </div>


  </div>
  <div class="col">

  <div class="form-group">
        <label for="formClient-Name"> Cihaz Seri Numarası</label>
        <input type="text" class="form-control" disabled readonly value="<?=$siparis_urun->seri_numarasi?>" name="cihaz_seri_numarasi" required autofocus="">
      </div>


  </div>
</div>

<div class="row">
  <div class="col">
  <div class="form-group">
        <label for="formClient-Name" style="color:#009b00;"><i class="fas fa-building"></i> Yeni Müşteri / Merkez Bilgisi</label>
      
        <select name="" id="" class="select2 form-control">
        <?php foreach($musteriler as $musteri) : ?> 
                    <option value="<?=$musteri->merkez_id?>"><?=$musteri->musteri_ad?>(<?=$musteri->merkez_adi?>) <?=$musteri->ilce_adi?> / <?=$musteri->sehir_adi?> / <?=$musteri->musteri_iletisim_numarasi?></option>
          <?php endforeach; ?> 
    </select>

      </div>

  </div>
</div>

<div class="row"><div class="col">
<div style="background: #ffffe2; padding: 10px; color: #ab6800; margin-top: 0px; margin-bottom: 15px; border: 2px solid #ffbc007d; border-radius: 5px;">
     <span><i class="fas fa-exclamation-circle" style="
    margin-right: 4px;
    color: #f5a100;
"></i> Cihaz aktarımı sağlandığında otomatik olarak servis, atış yükleme ve diğer cihaza tanımlı hareketler de aktarılır. Cihaz değişim hareketlerini <b>Cihaz Yönetimi > Değişim Hareketleri</b> ekranından görüntüleyebilirsiniz.</span>
 </div>
</div></div>

       <div class="form-group">
       <button type="submit" class="btn btn-block btn-success btn-lg"><i class="fas fa-search"></i> Cihaz Müşteri Değişimi Yap</button>
      </div>
       
    </div>
    <!-- /.card-body -->

    
    <!-- /.card-footer-->

    </form>
  </div>
            <!-- /.card -->
</section>
            </div>



            <style>
              .select2-container--default .select2-selection--single {
    border: 1px solid #000000 !important;
}

.text-sm .select2-container--default .select2-selection--single, select.form-control-sm~.select2-container--default .select2-selection--single {
    height: calc(1.8125rem + 2px);
    background: #effff2;
}
              </style>