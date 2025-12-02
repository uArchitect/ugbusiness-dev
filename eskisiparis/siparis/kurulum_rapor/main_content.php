 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
     
    <!-- /.content-header -->
<section class="content col col-lg-10 mt-2">
<div class="card card-dark">
    <div class="card-header with-border">
      <h3 class="card-title"> Siparis Bilgileri</h3>
    </div>
    <form class="form-horizontal" method="POST" action="<?php echo site_url('siparis/save_kurulum_rapor').'/'.$siparis->siparis_id;?>">
    <div class="card-body">

    <div class="col-sm-12 col-12 invoice-col mr-1 p-0 mb-2" style="flex:1;border: 1px solid #013a8f59;background:#f6faff">
                  
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
 
                  <!-- ADIM 9-->
            <div style="background: #f6faff;border: 2px dashed #07357a;" class="p-2 mt-2">

            



            <div class="timeline mb-0">
  
          
              <div>
                <i class="fas fa-envelope bg-blue"></i>
                <div class="timeline-item">
                  <span class="time text-white d-none d-lg-block d-xl-none">
            
                    <i class="fas fa-exclamation-circle text-white"></i> Kurulum Tarihi, Araç Plaka ve Kurulum Ekip alanları zorunludur </span>
                  </span>
                  <h3 class="timeline-header bg-dark">
                    <a href="#">Kurulum Programlama</a>
                  </h3>
                  <div class="timeline-body" style=""> 
                    
   <?php $count = 1;$pcount = -1;
                                    foreach($siparis_degerlendirme_parametreleri as $feature) {
                                      $count++;   $pcount++;
                                    ?>

<div class="card" style="border: 1px solid #343a4069;">
<div class="card-header" style="background:#13172017">
<h3 class="card-title"> 

<input  hidden
                                                    data-title="$feature->parameter_name"
                                                    name="feature_title_<?=$count?>"
                                                    type="text" value="<?php echo $feature->siparis_parametre_adi;?>" />

                                                <span id="span_title_<?=$count?>" style="font-weight:600"><i class="fas fa-question-circle text-primary"></i> <?php echo $feature->siparis_parametre_adi;?>


</h3>
</div>
<div class="card-body">

<div class="input-group">
<input 
                                                    placeholder = "Hızlı seçim yapınız veya değerlendirme sonucu giriniz..."
                                                    name="i_feature_name_<?=$count?>"
                                                    id="i_feature_name_<?=$count?>"
                                                    style="font-weight:normal;text-transform: capitalize;"
                                                    type="text" class="form-control capitalize-input" value="<?=$degerlendirme_data ? json_decode($degerlendirme_data)[$pcount]->value : ""?>" />
<div class="input-group-append">
<button onclick="document.getElementById('i_feature_name_<?=$count?>').value='Evet';     return false;" class="btn btn-default text-success"><i class="nav-icon 	fas fa-check text-success" style="font-size:13px"></i> Evet</button>
                                                    <button style="margin-left:0px" onclick="document.getElementById('i_feature_name_<?=$count?>').value='Hayır';      return false;" class="btn btn-default text-danger"><i class="nav-icon 	fas fa-times text-danger" style="font-size:13px"></i> Hayır</button> 
                
</div>

</div>

</div>
</div>



<?php 
                                    }
?>



                    
                 

             
 

                
                  </div>
               
                </div>
              </div>
    
              </div>





            </div>  
             <!-- ADIM 9-->
 






 
      
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <div class="row">
        <div class="col"><a href="<?=base_url("egitim")?>"  class="btn btn-flat btn-danger"> İptal</a></div>
        <div class="col text-right"><button type="submit" class="btn btn-flat btn-primary"> Kaydet</button></div>
      </div>
    </div>
    <!-- /.card-footer-->

    </form>
  </div>
            <!-- /.card -->
</section>
            </div>



      