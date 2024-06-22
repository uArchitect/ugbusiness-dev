 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
     
<section class="content col-xl-6 mt-2">






<div class="card card-dark">
    <div class="card-header with-border">
      <h3 class="card-title"> İzin Bilgileri</h3>
      <?php
    date_default_timezone_set('Europe/Istanbul'); 

    $tarih_ve_saat = date('d.m.Y H:i:s'); 
    
?>
     
    </div>
  


    <?php if(!empty($istek)){?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('izin/save').'/'.$istek->izin_talep_id;?>">
    <?php }else{?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('izin/save');?>">
    <?php } ?>
    <div class="card-body">

 

<div class="row"> 
    <div class="col-md-8" style="padding-left:0px !important;">


      <div class="form-group">
        <label for="formClient-Name"> Personel Bilgileri</label>
        <input type="text" readonly value="<?php echo  !empty($istek) ? $istek->kullanici_ad_soyad : aktif_kullanici()->kullanici_ad_soyad." - $departman_adi - $tarih_ve_saat";?>" class="form-control" name="izin_adi" required="" placeholder="İstek Adını Giriniz..." autofocus="">
       </div>
      
      </div>


  <div class="col-md-4" style="padding-left:0px !important;">

<div class="form-group">
      <label for="formClient-Name"> Departman</label>
      <input type="text" readonly value="<?=(!empty($istek)) ? $istek->departman_adi : $departman_adi?>" class="form-control" required="" placeholder="Departman Bilgisi..." autofocus="">
     
    </div>
    </div>






    <div class="col-md-6" style="padding-left:0px !important;">

<div class="form-group">
      <label for="formClient-Name"> İzin Başlangıç Tarihi</label>
      <input type="date" name="izin_baslangic_tarihi" value="<?=(!empty($istek)) ? date("Y-m-d",strtotime($istek->izin_baslangic_tarihi)) : ""?>" class="form-control" required="" autofocus="">
     
    </div>
    </div>

    <div class="col-md-6" style="padding-left:0px !important;">

<div class="form-group">
      <label for="formClient-Name"> İzin Bitiş Tarihi</label>
      <input type="date" name="izin_bitis_tarihi" value="<?=(!empty($istek)) ? date("Y-m-d",strtotime($istek->izin_bitis_tarihi)) : ""?>" class="form-control" required="" autofocus="">
     
    </div>
    </div>



    
</div>












<div class="row">



<div class="col-md-12" style="padding-left:0px !important;" >

  
<div class="form-group">
      <label for="formClient-Code"> İzin Nedeni</label>
      
      <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
      <select name="izin_neden_no" id="izin_neden_no" class="select2 form-control rounded-0" style="width: 100%;">
      <?php foreach($istek_birimleri as $birim) : ?> 
                  <option data-icon="fa fa-building" value="<?=$birim->izin_neden_id?>" <?php echo  (!empty($istek) && $istek->izin_neden_no == $birim->izin_neden_id) ? 'selected="selected"'  : '';?>><?=$birim->izin_neden_detay?></option>
    
        <?php endforeach; ?>  
                </select>
              
    </div>




</div>


 


<div class="col-md-12" style="padding-left:0px !important;">


<div class="form-group">
  <label for="formClient-Name"> Acil Durum (İletişim Numarası)</label>
  <input type="text" value="<?php echo  !empty($istek) ? $istek->acil_durum_tel_no : '';?>" class="form-control" name="acil_durum_tel_no" required="" placeholder="Acil Durumlarda Ulaşılabilecek İletişim Numarası Giriniz..." autofocus="">
  <p style="color: red;"> <?php echo json_decode($this->session->flashdata('form_errors'))->istek_adi ?? ''; ?></p>
</div>

</div>








</div>



<div class="form-group row">
  <div class="col-md-12 pl-0 ">
        <label for="formClient-Code"> İzin Süresince Yerine Vekalet Edecek Kişi</label>
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*İsteğe Bağlı)</label>
        <div class="input-group" style="flex-wrap: nowrap;">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fas fa-user"></i></span>
              </div>
              
              <select name="vekalet_edecek_kullanici_id" class="select2 form-control rounded-0" style="width: 100%;">
              <option value="0">Vekalet Edecek Kişi Seçiniz...</option>
                  
              <?php foreach($kullanicilar as $kullanici) : ?> 
                <?php if(aktif_kullanici()->kullanici_id == $kullanici->kullanici_id){continue;} ?>
                              <option data-icon="fa fa-user" value="<?=$kullanici->kullanici_id?>" <?php echo  (!empty($istek) && $istek->izin_onaylayacak_sorumlu_id == $kullanici->kullanici_id) ? 'selected="selected"'  : '';?>><?=$kullanici->kullanici_ad_soyad?> / <?=$kullanici->kullanici_unvan?> / <?=$kullanici->departman_adi?></option>
                    <?php endforeach; ?>  
              </select>
        </div>  
      </div>

 


</div>






<div class="form-group row">
  <div class="col-md-12 pl-0 ">
        <label for="formClient-Code"> Onaylayacak Kullanıcı</label>
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <div class="input-group" style="flex-wrap: nowrap;">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fas fa-user"></i></span>
              </div>
              
              <select name="izin_onaylayacak_sorumlu_id" required class="select2 form-control rounded-0" style="width: 100%;">
              <option value="">Onaylayacak Kullanıcı Seçiniz...</option>
                  
              <?php foreach($kullanicilar as $kullanici) : ?> 
                <?php if(aktif_kullanici()->kullanici_id == $kullanici->kullanici_id){continue;} ?>
                              <option data-icon="fa fa-user" value="<?=$kullanici->kullanici_id?>" <?php echo  (!empty($istek) && $istek->izin_onaylayacak_sorumlu_id == $kullanici->kullanici_id) ? 'selected="selected"'  : '';?>><?=$kullanici->kullanici_ad_soyad?> / <?=$kullanici->kullanici_unvan?> / <?=$kullanici->departman_adi?></option>
                
                    <?php endforeach; ?>  
              </select>
        </div>  
      </div>

 


</div>




<div class="form-group row">
  <div class="col-md-12 pl-0 ">
        <label for="formClient-Code"> Bilgilendirme / İnsan Kaynakları</label>
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <div class="input-group" style="flex-wrap: nowrap;">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fas fa-user"></i></span>
              </div>
              
              <select class="select2 form-control rounded-0" name="bilgilendirme_kullanici_id" style="width: 100%;">
                
              <?php foreach($insan_kaynaklari as $insan_kaynak_kullanici) : ?> 
                              <option data-icon="fa fa-user" value="<?=$insan_kaynak_kullanici->kullanici_id?>" selected><?=$insan_kaynak_kullanici->kullanici_ad_soyad?> / <?=$kullanici->kullanici_unvan?> / <?=$kullanici->departman_adi?></option>
                
                    <?php endforeach; ?>  
              </select>
        </div>  
      </div>

 


</div>

















      <div class="form-group">
        <label for="formClient-Code"> İzin Notu <span  style="font-weight:normal;transition: all 0.5s ease-in-out;"> (*İsteğe Bağlı)</span></label>
        <?php
          if(empty($istek)){
          ?>
            <textarea name="izin_notu" id="summernote4"></textarea>
          <?php
          }else{
            ?>
            <textarea name="izin_notu" id="summernote4"><?=htmlspecialchars($istek->izin_notu)?></textarea>
          <?php
          }
        ?>
        <p style="color: red;"> <?php echo json_decode($this->session->flashdata('form_errors'))->istek_aciklama ?? ''; ?></p>
      </div>








      
    
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <div class="row">
        <div class="col"><a href="<?=base_url("izin/onay_bekleyenler")?>"  class="btn btn-flat btn-danger"> İptal</a></div>
        <div class="col text-right"><button  type="submit" class="btn btn-flat btn-primary"> Kaydet</button></div>
    
    
      </div>
    </div>
    <!-- /.card-footer-->

    </form>
  </div>
            <!-- /.card -->
</section>
            </div>






<script src="<?=base_url("assets")?>/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?=base_url("assets")?>/plugins/jquery-ui/jquery-ui.min.js"></script>


           