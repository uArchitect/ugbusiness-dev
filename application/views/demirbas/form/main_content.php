 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper pt-2">
  <div class="row">
<section class="content col-md-10">
<div class="card card-primary">
    <div class="card-header with-border">
      <h3 class="card-title"> Demirbaş Bilgileri</h3>
     
     
    </div>
  
    <?php if(!empty($demirbas)){?>
            <form class="form-horizontal" id="form-demirbas" enctype="multipart/form-data" method="POST" action="<?php echo site_url('demirbas/save').'/'.$demirbas->demirbas_id;?>">
    <?php }else{?>
            <form class="form-horizontal" id="form-demirbas" enctype="multipart/form-data" method="POST" action="<?php echo site_url('demirbas/save');?>">
    <?php } ?>
    <div class="card-body">

<?php 
if(!empty($demirbas)){
?>


<!-- TELEFON -->
<div class="row">
  <div class="col">
    <a href="#" onclick='confirmRedirect("<?=base_url("demirbas/kategori_duzenle/$demirbas->demirbas_id/1")?>"); return false;' class="btn btn-default" style="background:white!important;<?=$demirbas_secilen_kategori == 1 ? "background: white !important;border: 2px solid #0060c7;" : "-webkit-filter: grayscale(100%); filter: grayscale(100%);"?>">
      <img src="https://m.media-amazon.com/images/I/71s72QE+voL.jpg" style="width:50%;display:block;margin:auto;<?=$demirbas_secilen_kategori == 1 ? "scale:1;" : "scale:0.6;opacity:0.6;" ?>" alt="">
      <span>CEP TELEFONU</span>
    </a>
  </div>
  
  <div class="col">
    <a href="#" onclick='confirmRedirect("<?=base_url("demirbas/kategori_duzenle/$demirbas->demirbas_id/4")?>"); return false;' class="btn btn-default" style="background:white!important;<?=$demirbas_secilen_kategori == 4 ? "background: white !important;border: 2px solid #0060c7;" : "-webkit-filter: grayscale(100%); filter: grayscale(100%);"?>">
      <img src="https://cdn.qukasoft.com/f/752658/bzR6WmFtNG0vcUp3ZUdGdEg4MXZKZWxESUE9PQ/p/intel-i3-4n-8gb-120gb-ssd-19-mon-masaustu-bilgisayar-195154728-sw1000sh1000.webp" style="width:50%;display:block;margin:auto;<?=$demirbas_secilen_kategori == 4 ? "scale:1;" : "scale:0.6;opacity:0.6;" ?>" alt="">
      <span>LAPTOP / MASAÜSTÜ PC</span>
    </a>
  </div>

  <div class="col">
    <a href="#" onclick='confirmRedirect("<?=base_url("demirbas/kategori_duzenle/$demirbas->demirbas_id/2")?>"); return false;' class="btn btn-default" style="background:white!important;<?=$demirbas_secilen_kategori == 2 ? "background: white !important;border: 2px solid #0060c7;" : "-webkit-filter: grayscale(100%); filter: grayscale(100%);"?>">
      <img src="https://cdn.vatanbilgisayar.com/Upload/PRODUCT/lenovo/thumb/147559-1_large.jpg" style="width:50%;display:block;margin:auto;<?=$demirbas_secilen_kategori == 2 ? "scale:1;" : "scale:0.6;opacity:0.6;" ?>" alt="">
      <span>TABLET</span>
    </a>
  </div>

  <div class="col">
    <a href="#" onclick='confirmRedirect("<?=base_url("demirbas/kategori_duzenle/$demirbas->demirbas_id/3")?>"); return false;' class="btn btn-default" style="background:white!important;<?=$demirbas_secilen_kategori == 3 ? "background: white !important;border: 2px solid #0060c7;" : "-webkit-filter: grayscale(100%); filter: grayscale(100%);"?>">
      <img src="https://yemekkarti.co/sites/yemekkarti.co/files/inline-images/MN_dikey_erkek.png" style="width:71%;display:block;margin:auto;<?=$demirbas_secilen_kategori == 3 ? "scale:1;" : "scale:0.6;opacity:0.6;" ?>" alt="">
      <span>MULTINET KART</span>
    </a>
  </div>
</div>

<script>
function confirmRedirect(url) {
  if (confirm("Bu envanterin kategorisi değiştirilecektir. İşlemi onaylıyor musunuz?")) {
    window.location.href = url;
  }
}
</script>


<?php
}else{

?>


<!-- TELEFON -->
<div class="row">
  <div class="col">
    <a href="<?=base_url("demirbas/ekle/1")?>" class="btn btn-default" style="background:white!important;<?=$demirbas_secilen_kategori == 1 ? "    background: white !important;border: 2px solid #0060c7;" : "-webkit-filter: grayscale(100%); filter: grayscale(100%);"?>">
      <img src="https://m.media-amazon.com/images/I/71s72QE+voL.jpg" style="width:50%;display:block;margin:auto;<?=$demirbas_secilen_kategori == 1 ? "scale:1;" : "scale:0.6;opacity:0.6;" ?>" alt="" srcset="">
      <span>CEP TELEFONU</span>
    </a>

  </div>
  
 <div class="col">
  <a href="<?=base_url("demirbas/ekle/4")?>" class="btn btn-default" style="background:white!important;<?=$demirbas_secilen_kategori == 4 ? "    background: white !important;border: 2px solid #0060c7;" : "-webkit-filter: grayscale(100%); filter: grayscale(100%);"?>">
      <img src="https://cdn.qukasoft.com/f/752658/bzR6WmFtNG0vcUp3ZUdGdEg4MXZKZWxESUE9PQ/p/intel-i3-4n-8gb-120gb-ssd-19-mon-masaustu-bilgisayar-195154728-sw1000sh1000.webp" style="width:50%;display:block;margin:auto;<?=$demirbas_secilen_kategori == 4 ? "scale:1;" : "scale:0.6;opacity:0.6;" ?>" alt="" srcset="">
      <span>LAPTOP / MASAÜSTÜ PC</span>
    </a>
  </div>

  <div class="col">
  <a href="<?=base_url("demirbas/ekle/2")?>" class="btn btn-default" style="background:white!important;<?=$demirbas_secilen_kategori == 2 ? "    background: white !important;border: 2px solid #0060c7;" : "-webkit-filter: grayscale(100%); filter: grayscale(100%);"?>">
      <img src="https://cdn.vatanbilgisayar.com/Upload/PRODUCT/lenovo/thumb/147559-1_large.jpg" style="width:50%;display:block;margin:auto;<?=$demirbas_secilen_kategori == 2 ? "scale:1;" : "scale:0.6;opacity:0.6;" ?>" alt="" srcset="">
      <span>TABLET</span>
    </a>
  </div>
  <div class="col">
  <a href="<?=base_url("demirbas/ekle/3")?>" class="btn btn-default" style="background:white!important;<?=$demirbas_secilen_kategori == 3 ? "    background: white !important;border: 2px solid #0060c7;" : "-webkit-filter: grayscale(100%); filter: grayscale(100%);"?>">
      <img src="https://yemekkarti.co/sites/yemekkarti.co/files/inline-images/MN_dikey_erkek.png" style="width:71%;display:block;margin:auto;<?=$demirbas_secilen_kategori == 3 ? "scale:1;" : "scale:0.6;opacity:0.6;" ?>" alt="" srcset="">
      <span>MULTINET KART</span>
    </a>
  </div>
  
  <div class="col">
  <a href="<?=base_url("demirbas/ekle/5")?>" class="btn btn-default" style="background:white!important;<?=$demirbas_secilen_kategori == 5 ? "    background: white !important;border: 2px solid #0060c7;" : "-webkit-filter: grayscale(100%); filter: grayscale(100%);"?>">
      <img src="https://www.fotografmania.com/wp-content/uploads/2018/03/n-resm-e1635440611350.jpg" style="width:71%;display:block;margin:auto;<?=$demirbas_secilen_kategori == 5 ? "scale:1;" : "scale:0.6;opacity:0.6;" ?>" alt="" srcset="">
      <span>DEMİRBAŞ</span>
    </a>
  </div>

</div>

<?php

}
?>















<input type="hidden" value="<?php echo !empty($demirbas) ? $demirbas->kategori_id : $demirbas_secilen_kategori;?>" class="form-control" name="kategori_id"  autofocus="">
  

<?php 
if($demirbas_secilen_kategori == 1)
{
?>
 
  
    <div class="row mb-3 mt-2">
      <div class="col-md-6">
        <label for="formClient-Code"> Telefon Marka - Model</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text rounded-2"><i class="fa fa-ticket-alt"></i></span>
          </div>
          <input type="text" value="<?php echo !empty($demirbas) ? $demirbas->demirbas_marka : '';?>" class="form-control" name="demirbas_marka" placeholder="Telefon Markası (Örn : Iphone 15 Plus)" autofocus="">
       </div> 
      </div>
      <div class="col-md-6">
        <label for="formClient-Code"> Kullanıcı</label>
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <div class="input-group" style="flex-wrap: nowrap;">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fas fa-user"></i></span>
              </div>
             
              <select name="demirbas_kullanici_id" class="select2 form-control rounded-0" style="width: 100%;">
                  <?php foreach($kullanicilar as $kullanici) : ?> 
                              <option  value="<?=$kullanici->kullanici_id?>" <?php echo  (!empty($demirbas) && $demirbas->demirbas_kullanici_id == $kullanici->kullanici_id) ? 'selected="selected"'  : '';?>><?=$kullanici->kullanici_ad_soyad?> / <?=$kullanici->kullanici_unvan?> / <?=$kullanici->departman_adi?></option>
                
                    <?php endforeach; ?>  
              </select>
        </div>  
      </div>
    </div>
    <div class="row  mb-3 mt-2">

    <div class="col-md-6">
        <label for="formClient-Code"> Telefon Numarası</label>
      
        <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fa fa-ticket-alt"></i></span>
              </div>
              <input type="text" value="<?php echo !empty($demirbas) ? $demirbas->demirbas_telefon_numarasi : '';?>" class="form-control" name="demirbas_telefon_numarasi" placeholder="Telefon Numarası" autofocus="">
       </div> 
    
      </div>


      <div class="col-md-6">
        <label for="formClient-Code"> Garanti Bitiş Tarihi</label>
        
        <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fas fa-barcode"></i></span>
              </div>
              <input type="date" value="<?php echo !empty($demirbas) ? date("Y-m-d",strtotime($demirbas->demirbas_garanti_bitis_tarihi)) : date("Y-m-d");?>" class="form-control" name="demirbas_garanti_bitis_tarihi"   autofocus="">
              </div> 
      
      </div>




     


       

    </div>
 

 



<div class="row  mb-3 mt-2">

<div class="col-md-6">
<label for="formClient-Code"> Pin Kodu</label>
 
 <div class="input-group">
       <div class="input-group-prepend">
         <span class="input-group-text rounded-2"><i class="fas fa-memory"></i></span>
       </div>
       <input type="text" value="<?php echo !empty($demirbas) ? $demirbas->demirbas_pin_kodu : '';?>" class="form-control" name="demirbas_pin_kodu" placeholder="Telefon Pin Bilgisini Giriniz..." autofocus="">
</div> 

</div>

<div class="col-md-6">
  <label for="formClient-Code"> Puk Kodu</label>
 
  <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text rounded-2"><i class="fas fa-memory"></i></span>
        </div>
        <input type="text" value="<?php echo !empty($demirbas) ? $demirbas->demirbas_puk_kodu : '';?>" class="form-control" name="demirbas_puk_kodu" placeholder="Telefon Puk Bilgisini Giriniz..." autofocus="">
 </div> 

</div>
</div>





<div class="row  mb-3 mt-2">

<div class="col-md-6">
<label for="formClient-Code"> Icloud Kullanıcı Adı</label>
 
 <div class="input-group">
       <div class="input-group-prepend">
         <span class="input-group-text rounded-2"><i class="fas fa-memory"></i></span>
       </div>
       <input type="text" value="<?php echo !empty($demirbas) ? $demirbas->demirbas_icloud_adres : '';?>" class="form-control" name="demirbas_icloud_adres" placeholder="Icloud Adresini Giriniz..." autofocus="">
</div> 

</div>

<div class="col-md-6">
  <label for="formClient-Code"> Icloud Şifre</label>
 
  <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text rounded-2"><i class="fas fa-memory"></i></span>
        </div>
        <input type="text" value="<?php echo !empty($demirbas) ? $demirbas->demirbas_icloud_sifre : '';?>" class="form-control" name="demirbas_icloud_sifre" placeholder="Icloud Şifresini Giriniz..." autofocus="">
 </div> 

</div>
</div>



<!-- TELEFON -->


<?php
}
if($demirbas_secilen_kategori == 4)
{
?>




<!-- BİLGİSAYAR -->

 

 
  
    <div class="row mb-3 mt-2">
      <div class="col-md-6">
        <label for="formClient-Code"> Laptop Marka - Model</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text rounded-2"><i class="fa fa-ticket-alt"></i></span>
          </div>
          <input type="text" value="<?php echo !empty($demirbas) ? $demirbas->demirbas_marka : '';?>" class="form-control" name="demirbas_marka" placeholder="Bilgisayar Markası (Örn : HP Victus)" autofocus="">
       </div> 
      </div>
      <div class="col-md-6">
        <label for="formClient-Code"> Kullanıcı</label>
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <div class="input-group" style="flex-wrap: nowrap;">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fas fa-user"></i></span>
              </div>
             
              <select name="demirbas_kullanici_id" class="select2 form-control rounded-0" required style="width: 100%;">
                <option value="">Kullanıcı Seçiniz</option>
              <?php foreach($kullanicilar as $kullanici) : ?> 
                              <option  value="<?=$kullanici->kullanici_id?>" <?php echo  (!empty($demirbas) && $demirbas->demirbas_kullanici_id == $kullanici->kullanici_id) ? 'selected="selected"'  : '';?>><?=$kullanici->kullanici_ad_soyad?> / <?=$kullanici->kullanici_unvan?> / <?=$kullanici->departman_adi?></option>
                
                    <?php endforeach; ?>  
              </select>
        </div>  
      </div>
    </div>
    <div class="row  mb-3 mt-2">

    <div class="col-md-12">
       


      <div class="col-md-12">
        <label for="formClient-Code"> Garanti Bitiş Tarihi</label>
        
        <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fas fa-barcode"></i></span>
              </div>
              <input type="date" value="<?php echo !empty($demirbas) ? date("Y-m-d",strtotime($demirbas->demirbas_garanti_bitis_tarihi)) : date("Y-m-d");?>" class="form-control" name="demirbas_garanti_bitis_tarihi"   autofocus="">
              </div> 
      
      </div>




     


       

    </div>
 

 


 

 


<!-- BİLGİSAYAR -->


<?php
}
if($demirbas_secilen_kategori == 2)
{
?>



<!-- TABLET -->


 
  
    <div class="row mb-3 mt-2">
      <div class="col-md-6">
        <label for="formClient-Code"> Tablet Marka - Model</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text rounded-2"><i class="fa fa-ticket-alt"></i></span>
          </div>
          <input type="text" value="<?php echo !empty($demirbas) ? $demirbas->demirbas_marka : '';?>" class="form-control" name="demirbas_marka" placeholder="Bilgisayar Markası (Örn : Lenovo Tab M11)" autofocus="">
       </div> 
      </div>
      <div class="col-md-6">
        <label for="formClient-Code"> Kullanıcı</label>
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <div class="input-group" style="flex-wrap: nowrap;">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fas fa-user"></i></span>
              </div>
             
              <select name="demirbas_kullanici_id" class="select2 form-control rounded-0" style="width: 100%;">
                  <?php foreach($kullanicilar as $kullanici) : ?> 
                              <option  value="<?=$kullanici->kullanici_id?>" <?php echo  (!empty($demirbas) && $demirbas->demirbas_kullanici_id == $kullanici->kullanici_id) ? 'selected="selected"'  : '';?>><?=$kullanici->kullanici_ad_soyad?> / <?=$kullanici->kullanici_unvan?> / <?=$kullanici->departman_adi?></option>
                
                    <?php endforeach; ?>  
              </select>
        </div>  
      </div>
    </div>
    <div class="row  mb-3 mt-2">

    <div class="col-md-6">
        <label for="formClient-Code"> Tablet Şifresi</label>
      
        <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fa fa-ticket-alt"></i></span>
              </div>
              <input type="text" value="<?php echo !empty($demirbas) ? $demirbas->demirbas_tablet_sifresi : '';?>" class="form-control" name="demirbas_tablet_sifresi" placeholder="Tablet Şifresini Giriniz" autofocus="">
       </div> 
    
      </div>


      <div class="col-md-6">
        <label for="formClient-Code"> Garanti Bitiş Tarihi</label>
        
        <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fas fa-barcode"></i></span>
              </div>
              <input type="date" value="<?php echo !empty($demirbas) ? date("Y-m-d",strtotime($demirbas->demirbas_garanti_bitis_tarihi)) : date("Y-m-d");?>" class="form-control" name="demirbas_garanti_bitis_tarihi"   autofocus="">
              </div> 
      
      </div>




     


       

    </div>
 

 


 

 

<!-- TABLET -->


<?php
}
if($demirbas_secilen_kategori == 3)
{
?>



<!-- MULTINET -->

 
    <div class="row mb-3 mt-2">
      <div class="col-md-6">
        <label for="formClient-Code"> Multinet Kart No</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text rounded-2"><i class="fa fa-ticket-alt"></i></span>
          </div>
          <input type="text" value="<?php echo !empty($demirbas) ? $demirbas->demirbas_multinet_kart_no : '665690001280';?>" class="form-control" name="demirbas_multinet_kart_no" placeholder="Multinet Kart Numarası Giriniz" autofocus="">
       </div> 
      </div>
      <div class="col-md-6">
        <label for="formClient-Code"> Kullanıcı</label>
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <div class="input-group" style="flex-wrap: nowrap;">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fas fa-user"></i></span>
              </div>
             
              <select name="demirbas_kullanici_id" class="select2 form-control rounded-0" style="width: 100%;">
                  <?php foreach($kullanicilar as $kullanici) : ?> 
                              <option  value="<?=$kullanici->kullanici_id?>" <?php echo  (!empty($demirbas) && $demirbas->demirbas_kullanici_id == $kullanici->kullanici_id) ? 'selected="selected"'  : '';?>><?=$kullanici->kullanici_ad_soyad?> / <?=$kullanici->kullanici_unvan?> / <?=$kullanici->departman_adi?></option>
                
                    <?php endforeach; ?>  
              </select>
        </div>  
      </div>
    </div>
    <div class="row  mb-3 mt-2">

    <div class="col-md-6">
        <label for="formClient-Code"> Multinet Kart Bakiyesi</label>
      
        <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fa fa-ticket-alt"></i></span>
              </div>
              <input type="text" value="<?php echo !empty($demirbas) ? $demirbas->demirbas_multinet_bakiye : '';?>" class="form-control" name="demirbas_multinet_bakiye" placeholder="Kart Bakiyesi Giriniz" autofocus="">
       </div> 
    
      </div>
      <div class="col-md-6">
        <label for="formClient-Code"> Multinet Kart CVV</label>
      
        <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fa fa-ticket-alt"></i></span>
              </div>
              <input type="text" value="<?php echo !empty($demirbas) ? $demirbas->demirbas_multinet_cvv : '';?>" class="form-control" name="demirbas_multinet_cvv" placeholder="Kart CVV Giriniz" autofocus="">
       </div> 
    
      </div>

      <div class="col-md-6">
        <label for="formClient-Code"> Kart Son Kullanma Tarihi</label>
        
        <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fas fa-barcode"></i></span>
              </div>
              <input type="date" value="<?php echo !empty($demirbas) ? date("Y-m-d",strtotime($demirbas->demirbas_multinet_kart_gecerlilik_tarihi)) : date("Y-m-d");?>" class="form-control" name="demirbas_multinet_kart_gecerlilik_tarihi"   autofocus="">
              </div> 
      
      </div>




     


       

    </div>
 

 


 

 

<!-- MULTINET -->




<?php
} 
if($demirbas_secilen_kategori == 5){
?>

<div class="row mb-3 mt-2">
      <div class="col-md-6">
        <label for="formClient-Code"> Telefon Marka - Model</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text rounded-2"><i class="fa fa-ticket-alt"></i></span>
          </div>
          <input type="text" value="<?php echo !empty($demirbas) ? $demirbas->demirbas_marka : '';?>" class="form-control" name="demirbas_marka" placeholder="Telefon Markası (Örn : Iphone 15 Plus)" autofocus="">
       </div> 
      </div>
      <div class="col-md-6">
        <label for="formClient-Code"> Kullanıcı</label>
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <div class="input-group" style="flex-wrap: nowrap;">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fas fa-user"></i></span>
              </div>
             
              <select name="demirbas_kullanici_id" class="select2 form-control rounded-0" style="width: 100%;">
                  <?php foreach($kullanicilar as $kullanici) : ?> 
                              <option  value="<?=$kullanici->kullanici_id?>" <?php echo  (!empty($demirbas) && $demirbas->demirbas_kullanici_id == $kullanici->kullanici_id) ? 'selected="selected"'  : '';?>><?=$kullanici->kullanici_ad_soyad?> / <?=$kullanici->kullanici_unvan?> / <?=$kullanici->departman_adi?></option>
                
                    <?php endforeach; ?>  
              </select>
        </div>  
      </div>
    </div>

<?
}
?>

</div>
    <div class="row mt-2">
       
      
    <div class="col-md-12">
        <label for="formClient-Code"> Cihaz Açıklama</label>
        <div>
         <textarea style="    width: 100%;" name="demirbas_aciklama" id="summernote5" rows="2"><?php echo !empty($demirbas) ? $demirbas->demirbas_aciklama : '';?></textarea>
        </div>     
      </div>

      </div>
 
 
    <!-- /.card-body -->

    <div class="card-footer">
      <div class="row">
        <div class="col"><a href="<?=base_url("demirbas")?>"  class="btn btn-flat btn-danger"> İptal</a></div>
        <div class="col text-right"><button type="submit" class="btn btn-flat btn-primary"> Kaydet</button></div>
      </div>
    </div>
    <!-- /.card-footer-->

    </form>
  </div>
            <!-- /.card -->
</section>







 



</div>




            </div>

 