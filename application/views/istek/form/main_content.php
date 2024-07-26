 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
     
<section class="content col-xl-8 mt-2">






<div class="card card-dark">
    <div class="card-header with-border">
      <h3 class="card-title"> İstek Bilgileri</h3>
      <?php
    date_default_timezone_set('Europe/Istanbul'); // Zaman dilimini ayarlayabilirsiniz, örneğin Türkiye için 'Europe/Istanbul'

    $tarih_ve_saat = date('d.m.Y H:i:s'); // Şu anki tarih ve saat bilgisi
    
?>
     
    </div>
  


    <?php if(!empty($istek)){?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('istek/save').'/'.$istek->istek_id;?>">
    <?php }else{?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('istek/save');?>">
    <?php } ?>
    <div class="card-body">









 







<div class="row"> 
    <div class="col-md-8" style="padding-left:0px !important;">


      <div class="form-group">
        <label for="formClient-Name"> İstek Adı</label>
        <input type="text" value="<?php echo  !empty($istek) ? $istek->istek_adi : aktif_kullanici()->kullanici_ad_soyad." - $departman_adi - $tarih_ve_saat";?>"  readonly class="form-control" name="istek_adi" required="" placeholder="İstek Adını Giriniz..." autofocus="">
        <p style="color: red;"> <?php echo json_decode($this->session->flashdata('form_errors'))->istek_adi ?? ''; ?></p>
      </div>
      
      </div>


  <div class="col-md-2" style="padding-left:0px !important;">

<div class="form-group">
      <label for="formClient-Name"> Departman</label>
      <input type="text" readonly value="<?=$departman_adi?>" class="form-control" required="" placeholder="Departman Bilgisi..." autofocus="">
     
    </div>
    </div>











    


  <div class="col-md-2" style="padding-left:0px !important;">


<div class="form-group">
      <label for="formClient-Code"> Öncelik</label>
       
      <select name="istek_oncelik" class="select2 form-control rounded-0" style="width: 100%;">
 
          <option data-icon="fa fa-circle text-default"  value="1" <?php echo  (!empty($istek) && $istek->istek_oncelik == 1) ? 'selected="selected"'  : '';?>>Düşük</option>
      <option data-icon="fa fa-circle text-warning"  value="2" <?php echo  (!empty($istek) && $istek->istek_oncelik == 2) ? 'selected="selected"'  : '';?>>Orta</option>
      <option data-icon="fa fa-circle text-green"  value="3" <?php echo  (!empty($istek) && $istek->istek_oncelik == 3) ? 'selected="selected"'  : '';?>>Yüksek</option>
      <option data-icon="fa fa-circle text-danger"  value="4" <?php echo  (!empty($istek) && $istek->istek_oncelik == 4) ? 'selected="selected"'  : '';?>>Acil</option> 
     
         
        </select>
    </div>



</div>
</div>












<div class="row" style="height: 0;
    opacity: 0;">



<div class="col-md-4" style="padding-left:0px !important;" >

  
<div class="form-group">
      <label for="formClient-Code"> İlgili Birim</label>
      
      <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
      <select name="istek_birim_no" id="istek_birim_no" class="select2 form-control rounded-0" style="width: 100%;">
      <?php foreach($istek_birimleri as $birim) : ?> 
                  <option data-icon="fa fa-building" value="<?=$birim->istek_birim_id?>" <?php echo  (!empty($istek) && $istek->istek_birim_no == $birim->istek_birim_id) ? 'selected="selected"'  : '';?>><?=$birim->istek_birim_adi?></option>
    
        <?php endforeach; ?>  
                </select>
               
    </div>




</div>




<div class="col-md-4" style="padding-left:0px !important;" >

  
<div class="form-group">
      <label for="formClient-Code"> İş Kategorisi</label>
      
      <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
      <select name="istek_kategori_no" id="istek_kategori_no1" class="select2 form-control rounded-0" style="width: 100%;">
      
            <option value="1" selected>UG BUSINESS</option>
         


        
      </select>
               
    </div>




</div>






  <div class="col-md-4" style="padding-left:0px !important;">


  <div class="form-group">
        <label for="formClient-Code"> İş Tipi</label>
        
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <select name="is_tip_no" required id="is_tip_no1" class="select2 form-control rounded-0" style="width: 100%;">
         
       
        
            <option value="1" selected>SİSTEM TALEP / ÖNERİ / DESTEK</option>
        
       
       
       
       
       
     
                  </select>
               
      </div>



  </div>
 













</div>









<div class="form-group row">


<div class="col-md-3 pl-0 ">
        <label for="formClient-Code"> Gönderen Kullanıcı</label>
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <div class="input-group" style="flex-wrap: nowrap;">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fas fa-user"></i></span>
              </div>
              <?php 
              if(aktif_kullanici()->kullanici_id == 9){
                  ?>
                     <select name="gonderen_sorumlu" required class="select2 form-control rounded-0" style="width: 100%;">
                      <option data-icon="fa fa-user" value="9" selected>İbrahim BİRCAN</option>
                      <option data-icon="fa fa-user" value="7">Uğur ÖLMEZ</option>
                    </select>
                  <?php
              }else{
                ?>
                <select name="gonderen_sorumlu" required class="select2 form-control rounded-0" style="width: 100%;">
                 <option data-icon="fa fa-user" value="0" selected><?=aktif_kullanici()->kullanici_ad_soyad?></option> 
               </select>
             <?php
              }
              ?>
           
        </div>  
      </div>


  <div class="col-md-6 pl-0 ">
        <label for="formClient-Code"> Onaylayacak Kullanıcı</label>
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <div class="input-group" style="flex-wrap: nowrap;">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fas fa-user"></i></span>
              </div>
              
              <select name="istek_yonetici_id" required class="select2 form-control rounded-0" style="width: 100%;">
            
              <option data-icon="fa fa-user" value="" > Kullanıcı Seçiniz</option>
                
              <?php foreach($kullanicilar as $kullanici) : ?> 
               
                              <option data-icon="fa fa-user" value="<?=$kullanici->kullanici_id?>" <?php echo  (!empty($istek) && $istek->istek_yonetici_id == $kullanici->kullanici_id) ? 'selected="selected"'  : '';?>><?=$kullanici->kullanici_ad_soyad?> / <?=$kullanici->kullanici_unvan?> / <?=$kullanici->departman_adi?></option>
                
                    <?php endforeach; ?>  
              </select>
        </div>  
      </div>

      <div class="col-md-3 pl-0  pr-0">
        <label for="formClient-Code"> İstek Durumu</label>
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <div class="input-group" style="flex-wrap: nowrap;">
              <div class="input-group-prepend">
                <span class="input-group-text rounded-2"><i class="fas fa-user"></i></span>
              </div>
              <?php $g_kullanici_id = aktif_kullanici()->kullanici_id;?>
              <select onchange="changeStatus(this);" name="istek_durum_no" class="select2 form-control rounded-0" style="width: 100%;">
                   
              <?php foreach($istek_durumlari as $istek_durum) : ?> 
                             <?php if($g_kullanici_id != 1 && $istek_durum->istek_durum_id != 2 && empty($istek)) continue; ?>
                <option value="<?=$istek_durum->istek_durum_id?>" <?php echo  (!empty($istek) && $istek->istek_durum_no == $istek_durum->istek_durum_id) ? 'selected="selected"'  : '';?>><?=$istek_durum->istek_durum_adi?></option>
                
                    <?php endforeach; ?>  
              </select>
        </div>  
      </div>



</div>






      <div class="form-group">
        <label for="formClient-Code"> İstek Açıklama <span class="text-danger" style="transition: all 0.5s ease-in-out;"> (*Zorunlu Alan)</span></label>
        <?php
          if(empty($istek)){
          ?>
            <textarea name="istek_aciklama" maxlength="300" required ></textarea>
          <?php
          }else{
            ?>
            <br><span><?=htmlspecialchars($istek->istek_aciklama)?></span>
          <?php
          }
        ?>
        <p style="color: red;"> <?php echo json_decode($this->session->flashdata('form_errors'))->istek_aciklama ?? ''; ?></p>
      </div>



      <div class="form-group" id="tamamlandi_istek_notu" style="<?=(!empty($istek) && $istek->istek_durum_no == 4) ? "display:block" : "display:none"?>">
        <label for="formClient-Code"> İstek Notu</label>
        <input style="background:#fdfbe2" id="istek_not" type="text" value="<?php echo  !empty($istek) ? $istek->istek_notu : "";?>" class="form-control" name="istek_notu" placeholder="İstek Tamamlanma / Kapatma Notunu Giriniz..." >
      
        <p style="color: red;"> <?php echo json_decode($this->session->flashdata('form_errors'))->istek_notu ?? ''; ?></p>
      </div>





      
    
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <div class="row">
        <div class="col"><a href="<?=base_url("istek")?>"  class="btn btn-flat btn-danger"> İptal</a></div>
        <div class="col text-right"><button  type="submit" class="btn btn-flat btn-primary"> Kaydet</button></div>
      </div>
    </div>
    <!-- /.card-footer-->

    </form>
  </div>
            <!-- /.card -->
</section>
            </div>

