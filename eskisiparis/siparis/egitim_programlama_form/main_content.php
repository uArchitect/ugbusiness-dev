 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
     
    <!-- /.content-header -->
<section class="content col col-lg-12 mt-2">
<div class="card card-dark">
    <div class="card-header with-border">
      <h3 class="card-title"> Siparis Bilgileri</h3>
    </div>
    <form class="form-horizontal" method="POST" action="<?php echo site_url('siparis/save_egitim_programlama').'/'.$siparis->siparis_id;?>">
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
   
              <!-- ADIM 10-->
              <div style="background: #f6faff;border: 2px dashed #07357a;" class="p-2 mt-2">
            <label for="formClient-Code">  ADIM 10 - Eğitim Programlama
</label>
            








            <div class="timeline mb-0">
  
          
  <div>
    <i class="fas fa-envelope bg-blue"></i>
    <div class="timeline-item">
      <span class="time text-white d-none d-lg-block d-xl-none">
    
        <i class="fas fa-exclamation-circle text-white"></i> Eğitim Tarihi, Eğitim Ekip alanları zorunludur </span>
                 
      </span>
      <h3 class="timeline-header bg-dark">
        <a href="#">Eğitim Programlama</a>
      </h3>
      <div class="timeline-body"> 
        
      
      <div class="form-group">
      <i class="fas fa-calendar-alt text-danger"></i> Eğitim Tarihi
      <input type="text" required class="form-control" name="egitim_tarih" value="<?=date("d.m.Y",strtotime($siparis->belirlenen_egitim_tarihi))?>" data-inputmask-alias="datetime" data-inputmask-inputformat="dd.mm.yyyy" data-mask="" inputmode="numeric">

      </div>


 

      <div class="form-group">
        <i class="fas fa-users text-primary"></i> Eğitmen
        <select class="select2bs4" required name="egitim_ekip[]" data-placeholder="Eğitmen Seçimi Yapınız" style="width: 100%;">
        <?php foreach($egitmenler as $kullanici) : ?> 
          <?php
                               
                               $selected = (is_array( json_decode($siparis->egitim_ekip)) && in_array($kullanici->kullanici_id, json_decode($siparis->egitim_ekip))) ? 'selected="selected"' : '';
                           ?>
            <option <?=$selected?> value="<?=$kullanici->kullanici_id?>">
          <strong>  <?=$kullanici->kullanici_ad_soyad?></strong> / 
            <?=$kullanici->kullanici_unvan?>
          </option>
        <?php endforeach; ?> 
    </select>
      
      
    </div>
      </div>
   
    </div>
  </div>

  </div>












            </div>  
             <!-- ADIM 10-->
 






 
      
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



      