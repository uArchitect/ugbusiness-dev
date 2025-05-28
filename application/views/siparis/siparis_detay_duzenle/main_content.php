 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
     
    <!-- /.content-header -->
<section class="content col col-lg-12 mt-2">
<div class="card card-dark">
    <div class="card-header with-border">
      <h3 class="card-title"> Siparis Bilgileri</h3>
    </div>
    <form class="form-horizontal" method="POST" action="<?php echo site_url('siparis/save_siparis_genel_duzenleme').'/'.$siparis->siparis_id;?>">
    <div class="card-body">

    <div class="col-sm-12 invoice-col mr-1 p-0 mb-2" style="flex:1;border: 1px solid #013a8f59;background:#f6faff">
                  
                  <span style="font-weight:bold;color:#07357a;background: #d9e7f9;display: block;padding-left:5px">
                    Müşteri / Merkez Bilgileri
                  </span>
            <address class="m-2">
                <div class="row mb-0 d-flex">

                <span class="badge bg-dark text-md p-4" style="flex:1;font-weight:500;border-radius:0px;background:#004993!important;border: 1px solid #093d7d;">
                 <i class="fa fa-user-circle" style="font-size:25px"></i><br><br> <b><?=mb_strtoupper($merkez->musteri_ad)?></b><br>
                 <span style="font-weight:300;margin-top:0px;padding:5px" class="d-block text-sm">
                 <i class="far fa-address-card"></i>  <?=$merkez->musteri_kod?>
                 <i class="fa fa-mobile-alt " style="margin-left:11px"></i>   <?=$merkez->musteri_iletisim_numarasi?>
                
                </span> 
                 
                 </span>
                 
                 
                 <span class="badge bg-warning text-md p-4" style="flex:1;font-weight:500;border-radius:0px;color:white!important;background:#004993!important;border: 1px solid #093d7d;">
                 <i class="fa fa-building" style="font-size:25px"></i><br><br> <b><?=mb_strtoupper($merkez->merkez_adi)?></b><br>
                 <span style="font-weight:300;margin-top:0px;padding:5px" class="d-block text-sm">
                 <i class="far fa-map"></i>  <?=$merkez->merkez_adresi?> <?=$merkez->ilce_adi?> / <?=$merkez->sehir_adi?>
    </span>
                 </span>
                 
                </div>
                 
                
     



               </address>
               </div>
 
                 <!-- ADIM 4-->
            <div style="background: #f6faff;border: 2px dashed #07357a;" class="p-2 mt-2">
            <label for="formClient-Code">  ADIM 4 - Merkez Bilgi Doğrulama</label>
            




            <div class="timeline mb-0">
  




            <?php $c=-1; foreach ($urunler as $urun) { ?>
          
  <div>
    <i class="fas fa-envelope bg-blue"></i>
    <div class="timeline-item">
      <span class="time text-white d-none d-lg-block d-xl-none">
      <i class="fas fa-exclamation-circle text-white"></i> Damla Etiket ve Açılış Ekranı alanları zorunludur</span>
      <h3 class="timeline-header bg-dark">
      <a href="#"><?=$urun->urun_adi?></a> <?=$urun->urun_aciklama?>
      </h3>
      <div class="timeline-body"> 
        
      
      <div class="row">

      <div class="form-group col">
      <i class="fas fa-tint text-primary"></i> Damla Etiket
       <select name="urun_damla_etiket<?=$urun->siparis_urun_id?>" id="" required  class="form-control">
        <option value="">SEÇİM YAPINIZ</option>
        <option value="1" <?=($urun->damla_etiket == "1") ? 'selected="selected"' : ''?>>EVET</option>
        <option value="0" <?=($urun->damla_etiket == "0") ? 'selected="selected"' : ''?>>HAYIR</option>
       </select>
      </div>


      <div class="form-group col">
      <i class="fas fa-desktop text-success"></i> Açılış Ekranı 
       <select name="urun_acilis_ekran<?=$urun->siparis_urun_id?>" required id="" class="form-control">
        <option value="">SEÇİM YAPINIZ</option>
        <option value="1" <?=($urun->acilis_ekrani == "1") ? 'selected="selected"' : ''?>>EVET</option>
        <option value="0" <?=($urun->acilis_ekrani == "0") ? 'selected="selected"' : ''?>>HAYIR</option>
       </select>
      </div>





      <div class="form-group col">
      <i class="fas fa-desktop text-success"></i> Ürün Rengi 
       <select name="urun_renk<?=$urun->siparis_urun_id?>" required id="" class="form-control">
        
        <?php 
        $d=get_renkler($urun->urun_id);
 

          foreach ($d as $key) {
          ?>
            <option value="<?=$key->renk_id?>" <?=($key->renk_id == $urun->renk) ? 'selected="selected"' : ''?>><?=$key->renk_adi?></option>

          <?php
          }
        ?>
       </select>
      </div>


     





      </div>


 


<div class="row">
   



<div id="checkboxContainer" style="flex-wrap: wrap;width: 100%;    display: block;">
           


<?php
 
$veri = json_decode($urun->basliklar);

 
 
$bdata = get_cihaz_basliklar($urun->urun_id);

 $c++;
foreach ($bdata as $key) {
 
    ?>
    <div class="icheck-primary custom-container" for="checkbox<?=$key->baslik_adi?>">
        <input type="checkbox" name="baslik_select<?=$c?>[]" value="<?=$key->baslik_id?>" data-name="<?=$key->baslik_adi?>" id="checkbox<?=$c?>Primary<?=$key->baslik_id?>" <?php if(in_array($key->baslik_id,$veri)) echo "checked"; ?>>
        <label for="checkbox<?=$c?>Primary<?=$key->baslik_id?>" style="width: 100%; font-weight: 500;"><?=$key->baslik_adi?></label>
    </div>
    <?php
}
?>


</div>




</div>


 
 
      </div>
   
    </div>
  </div>

  


  <?php } ?>






  <div>
                  <i class="fas fa-envelope bg-blue"></i>
                  <div class="timeline-item">
                    <span class="time d-none d-lg-block d-xl-block">
                    <i class="fas fa-exclamation-circle"></i> Teslim Tarihi alanları zorunludur </span>
                 
                    </span>
                    <h3 class="timeline-header bg-warning">
                      <a href="#">Üretim Bilgileri</a> - Talep
                    </h3>
                    <div class="timeline-body"> 
                      <i class="fas fa-qrcode text-danger"></i>
                      Teslim Tarihi (Müşteri Talebi)
                      <div class="input-group">
                        <div class="input-group-prepend"></div>
                        <input type="text" required class="form-control" value="<?=date("d.m.Y",strtotime($siparis->musteri_talep_teslim_tarihi))?>" name="musteri_talep_teslim_tarihi" data-inputmask-alias="datetime" data-inputmask-inputformat="dd.mm.yyyy" data-mask="" inputmode="numeric">
                      </div>
                    </div> 
                  </div>
                </div>



                <div>
                  <i class="fas fa-envelope bg-blue"></i>
                  <div class="timeline-item">
                    <span class="time d-none d-lg-block d-xl-block">
                   
                    </span>
                    <h3 class="timeline-header bg-success">
                      <a href="#">Eğitim Bilgileri</a>
                    </h3>
                    <div class="timeline-body"> 
                      <i class="fas fa-graduation-cap text-success"></i>
                      Eğitim Durumu
                      <div class="input-group">
                        <div class="input-group-prepend"></div>
                        <select class="select2 d-block" name="egitim_var_mi" style="width:100%">
                          <option value="1" <?=($siparis->egitim_var_mi == 1) ? "selected='selected'" : ""?>>Eğitim Var</option>
                          <option value="0" <?=($siparis->egitim_var_mi == 0) ? "selected='selected'" : ""?>>Eğitim Yok</option>
                        </select> 
                      </div>
                    </div> 
                  </div>
                </div>








                <div>
                  <i class="fas fa-envelope bg-blue"></i>
                  <div class="timeline-item">
                    <span class="time d-none d-lg-block d-xl-block">
                  
                    </span>
                    <h3 class="timeline-header bg-danger">
                      <a href="#">Sipariş Yönlendirme Bilgileri</a>
                    </h3>
                    <div class="timeline-body"> 
                      <i class="fas fa-user text-danger"></i>
                      Siparişi / Müşteriyi Yönlendiren Kişi
                      <div class="input-group">
                        <div class="input-group-prepend"></div>
                        <select class="select2 d-block" name="yonlendiren_kisi" style="width:100%">
                       
                        <option value="0">Yönlendirme Yapılmadı</option>
                            
                       <?php 
                            foreach ($kullanicilar as $kullanici) {
                              ?>
                              <option value="<?=$kullanici->kullanici_id?>" <?=($kullanici->kullanici_id == $siparis->yonlendiren_kisi) ? "selected='selected'":""?>><?=$kullanici->kullanici_ad_soyad?></option>
                              <?php
                            }
                          
                          ?>
                        </select> 
                      </div>
                    </div> 
                  </div>
                </div>






  </div>


            </div>  
             <!-- ADIM 4-->
 






 
      
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <div class="row">
        <div class="col"><a href="<?=site_url('siparis/report/'.urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$siparis->siparis_id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE")))?>"  class="btn btn-flat btn-danger"> İptal</a></div>
        <div class="col text-right"><button type="submit" class="btn btn-flat btn-primary"> Kaydet</button></div>
      </div>
    </div>
    <!-- /.card-footer-->

    </form>
  </div>
            <!-- /.card -->
</section>
            </div>

            <script src="https://code.jquery.com/jquery-1.12.4.min.js"   integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="   crossorigin="anonymous"></script>


      <script>
           const fiyat_format = new Intl.NumberFormat('tr-TR', { style: 'currency', currency: 'TRY' });


    // Jquery Dependency

    $("input[data-type='currency']").on({
    keyup: function() {
      formatCurrency($(this));
    }
     
});


function formatNumber(n) {
  // format number 1000000 to 1,234,567
  return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}


function formatCurrency(input, blur) {
  // appends $ to value, validates decimal side
  // and puts cursor back in right position.
  
  // get input value
  var input_val = input.val();
  
  // don't validate empty input
  if (input_val === "") { return; }
  
  // original length
  var original_len = input_val.length;

  // initial caret position 
  var caret_pos = input.prop("selectionStart");
    
  // check for decimal
  if (input_val.indexOf(".") >= 0) {

    // get position of first decimal
    // this prevents multiple decimals from
    // being entered
    var decimal_pos = input_val.indexOf(".");

    // split number by decimal point
    var left_side = input_val.substring(0, decimal_pos);
    var right_side = input_val.substring(decimal_pos);

    // add commas to left side of number
    left_side = formatNumber(left_side);

    // validate right side
    right_side = formatNumber(right_side);
    
    // On blur make sure 2 numbers after decimal
    if (blur === "blur") {
      right_side += "00";
    }
    
    // Limit decimal to only 2 digits
    right_side = right_side.substring(0, 2);

    // join number by .
    input_val = "₺" + left_side + "." + right_side;

  } else {
    // no decimal entered
    // add commas to number
    // remove all non-digits
    input_val = formatNumber(input_val);
    input_val = "₺" + input_val;
    
    
  }
  
  // send updated string to input
  input.val(input_val);

  // put caret back in the right position
  var updated_len = input_val.length;
  caret_pos = updated_len - original_len + caret_pos;
  input[0].setSelectionRange(caret_pos, caret_pos);
}

        </script>

        <style>
          [class*=icheck-]>input:first-child+input[type=hidden]+label::before, [class*=icheck-]>input:first-child+label::before {
  width: 25px;
    height: 25px;
    background-color: white;
    border-radius: 50%;
    vertical-align: middle;
    border: 1px solid #ddd;
    appearance: none;
    -webkit-appearance: none;
    outline: none;
    cursor: pointer;margin-top: -2px;
}
[class*=icheck-]>input:first-child:checked+input[type=hidden]+label::after, [class*=icheck-]>input:first-child:checked+label::after {
    content: "";
    display: inline-block;
    position: absolute;
    top: 0;
    left: 0;
    width: 10px;
    height: 17px;
    /* font-size: 10px; */
    border: 2px solid #fff;
    border-left: none;
    border-top: none;
    margin-top: -5px;
    transform: translate(7.75px,4.5px) rotate(45deg);
    -ms-transform: translate(7.75px,4.5px) rotate(45deg);
}

.custom-container{
  background: #e7e7e745;
    padding: 5px;
    border-radius: 3px;
    border: 1px solid #c7c7c7;
}
          </style>