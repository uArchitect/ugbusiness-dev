 
 
 
 <style>
 
 @media (max-width: 576px) {
  
   .custom-container2 {
     display: grid!important;
   }
 }


</style>
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
 gap:5px;
 border-radius: 3px;
 border: 1px solid #c7c7c7;
 width:49%;
 margin: 2px;
}


</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper p-3" style="background:#133d6100">
 <!-- Content Header (Page header) -->

 <!-- /.content-header -->
<section class="content mt-2 col-md-12 col-xl-12" >
<div class="card card-primary">
 <div class="card-header with-border" style="background:#181818">
   <h3 class="card-title"> Sipariş Formu</h3>
  
  
 </div>

 <?php if(!empty($musteri)){?>
         <form class="form-horizontal" id="form-banner" onsubmit="return submitForm()" method="POST" action="<?php echo site_url('siparis/save').'/'.$musteri->musteri_id;?>">
 <?php }else{?>
         <form class="form-horizontal" id="form-banner" onsubmit="return submitForm()" method="POST" action="<?php echo site_url('siparis/save');?>">
 <?php } ?>
 <div class="card-body" style="background:#fff">

 


<div class="row">

<div class="form-group col-md-12 pl-0">
     <label for="formClient-Code"><i class="fa fa-building text-danger" ></i> Merkez Adı </label> 
     <input disabled type="text" style="background:#ffffff;color:black;border: 1px solid #0458ab;" value="<?php echo !empty($merkez) ? $merkez->merkez_adi : '';?>" class="form-control" name="musteri_tckn" placeholder="" autofocus="">
   </div>
   
 <div class="form-group  col-md-12 pr-3">
     <label for="formClient-Code"><i class="fa fa-user-circle text-orange" ></i> Yetkili Adı </label> 
     <input disabled type="text" style="background:#ffffff;color:black;border: 1px solid #0458ab;" value="<?php echo !empty($merkez) ? $merkez->musteri_ad : '';?>" class="form-control" name="musteri_tckn" placeholder="" autofocus="">
   </div>



   <div class="form-group  col-md-12 pl-0">
     <label for="formClient-Name"><i class="fa fa-phone text-success" ></i> İletişim Numarası</label>
     <input disabled type="text" style="background:#ffffff;color:black;border: 1px solid #0458ab;" value="<?php echo  !empty($merkez) ? $merkez->musteri_iletisim_numarasi : '';?>" class="form-control" name="musteri_ad" required="" placeholder="" autofocus="">
    </div>


</div>

   <div class="row">

  



   
   <div class="form-group col pl-0">
     <label for="formClient-Name"><i class="fas fa-map-marker-alt text-primary"></i> Merkez Adresi</label>
     <input disabled type="text" style="background:#ffffff;color:black;border: 1px solid #0458ab;" value="<?php echo  !empty($merkez) ? $merkez->merkez_adresi." ".$merkez->ilce_adi." / ".$merkez->sehir_adi : '';?>" class="form-control" required="" placeholder="" autofocus="">
    </div>

   </div>

    
  



   <div style="background:#fff;border: 2px dashed #b5b5b5;" class="p-2">

    <table id="exampleurunsiparis"  cellspacing="0" width="100%" class="table table-bordered table-striped table-responsive text-md" style="display: inline-table; width:100%">
               <thead>
               <tr>
               <th style="font-weight:normal;color:white;background:#0e3c63;padding-top:5px;padding-bottom:5px">Ürün</th>
                
                 <th style="font-weight:normal;color:white;background:#0e3c63;padding-top:5px;padding-bottom:5px">Başlık</th>
                  <th style="font-weight:normal;color:white;background:#0e3c63;padding-top:5px;padding-bottom:5px">Renk</th>
                 <th style="font-weight:normal;color:white;background:#0e3c63;padding-top:5px;padding-bottom:5px">Satış Fiyatı</th> 
                 <th style="font-weight:normal;color:white;background:#0e3c63;padding-top:5px;padding-bottom:5px">Kapora Fiyatı</th> 
                 <th style="font-weight:normal;color:white;background:#0e3c63;padding-top:5px;padding-bottom:5px">Peşinat Fiyatı</th>
                 <th style="font-weight:normal;color:white;background:#0e3c63;padding-top:5px;padding-bottom:5px">Fatura Tutarı</th>
                
                 <th style="font-weight:normal;color:white;background:#0e3c63;padding-top:5px;padding-bottom:5px">Ödeme Seçeneği</th> 
                 <th style="font-weight:normal;color:white;background:#0e3c63;padding-top:5px;padding-bottom:5px">Vade Sayısı</th> 
                 
                
                 <th style="font-weight:normal;color:white;background:#0e3c63;padding-top:5px;padding-bottom:5px">Damla Etiket</th> 
                 <th style="font-weight:normal;color:white;background:#0e3c63;padding-top:5px;padding-bottom:5px">Açılış Ekranı / Sipariş Notu</th> 
                 

                  
               </tr>
               </thead>
               <tbody>
                  
               </tbody>
               
             </table>

            <div class="row custom-container2">

            <?php $count=0; foreach ($urunler as $urun) : ?>

            <button type="button" data-id="<?=$urun->urun_id?>" onclick="showDataId(<?=$urun->urun_id?>)" data-toggle="modal" data-target="#modal-lg" style="font-weight:bold;flex:1;height:40px;border:1px solid #bbd5eb;background: <?=($count++%2==0) ? "#d7e4f1" : "#eaf4fe" ?>;color: black;" class="btn btn-default btn btn-flat productAdd"><i class="fa fa-plus-circle" style="color:#0e3c63"></i> <?=$urun->urun_adi?></button>  
         <?php endforeach; ?>

            </div></div>
   
 
   <input type="hidden" name="merkez_id" id="merkez_id" value="<?=$merkez->merkez_id?>">
 </div>
 <!-- /.card-body -->

 <div class="card-footer" style="background:#e5ebf3">
   <div class="row">
   <div class="col text-right">   <button type="submit" id="subbutton" class="btn  btn-success"><i class="fa fa-check"></i> Sipariş Oluştur</button>
     <a href="<?=base_url("musteri")?>"  class="btn btn-danger"> İptal</a></div>
   </div>
 </div>
 <!-- /.card-footer-->

 </form>
</div>
         <!-- /.card -->
</section>






<div class="card card-primary card-outline card-outline-tabs">
<div class="card-header p-0 border-bottom-0">
 <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
   <li class="nav-item">
     <a class="nav-link active" id="custom-tabs-four-umex-lazer" data-toggle="pill" href="#custom-tabs-umex-lazer" role="tab" aria-controls="custom-tabs-four-home" aria-selected="false">UMEX LAZER</a>
   </li>
   <li class="nav-item">
     <a class="nav-link" id="custom-tabs-four-umex-plus" data-toggle="pill" href="#custom-tabs-umex-plus" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">UMEX PLUS</a>
   </li>
   <li class="nav-item">
     <a class="nav-link" id="custom-tabs-four-umex-slim" data-toggle="pill" href="#custom-tabs-umex-slim" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">UMEX SLIM</a>
   </li>
   <li class="nav-item">
     <a class="nav-link" id="custom-tabs-four-umex-ems" data-toggle="pill" href="#custom-tabs-umex-ems" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="true">UMEX EMS</a>
   </li>
   <li class="nav-item">
     <a class="nav-link" id="custom-tabs-four-umex-s" data-toggle="pill" href="#custom-tabs-umex-s" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="true">UMEX S</a>
   </li>
   <li class="nav-item">
     <a class="nav-link" id="custom-tabs-four-umex-diode" data-toggle="pill" href="#custom-tabs-umex-diode" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="true">UMEX DIODE</a>
   </li>
   <li class="nav-item">
     <a class="nav-link" id="custom-tabs-four-umex-gold" data-toggle="pill" href="#custom-tabs-umex-gold" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="true">UMEX GOLD</a>
   </li>
   <li class="nav-item">
     <a class="nav-link" id="custom-tabs-four-umex-q" data-toggle="pill" href="#custom-tabs-umex-q" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="true">UMEX Q</a>
   </li>
 </ul>
</div>
<div class="card-body">
 <div class="tab-content"  >
   <div class="tab-pane fade active show" id="custom-tabs-umex-lazer" role="tabpanel" aria-labelledby="custom-tabs-four-umex-lazer">
     

   <table style="border:2px solid red; border-top:0px" class="table table-bordered table-responsive table-striped text-md">
               <thead>
               <tr>
                 <th style="width:25%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;width: 150px;">PEŞİNAT</th> 
                 <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;">VADE</th>
                 <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;">SENET</th>
                 <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;" >AYLIK</th>
                 <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;" >DİP FİYAT</th>
              <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;" >YUVARLANMIŞ FİYAT</th>
              
               </tr>
               </thead>
               <tbody>
                 <?php $count=0; foreach ($umexlazerfiyat as $fiyat) : ?>

                   <tr>
                    <?php
                     if( $fiyat->vade == 20){
                       ?>
                       <td rowspan="11" style="border-bottom:1px solid red;vertical-align : middle;text-align:center;background:white;font-weight:bold;font-size:30px"><?="₺ ".number_format($fiyat->pesinat_fiyati,2)?><br><span style="font-weight:400;color:red">Peşinat</span></td>
                       <?php
                     }
                    ?>
                     
                     <td style="padding-left:10px;<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>font-weight:bold;"><?=$fiyat->vade?> <span style="font-weight:300;">Ay Vadeli</span></td>
                     <td style="<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>"><?=number_format($fiyat->senet,2, ',', '.')." ₺"?></td>
                     <td style="<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>"><?=number_format($fiyat->aylik_taksit_tutar,2, ',', '.')." ₺"?></td>
                     <td style="<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>"><?=number_format($fiyat->toplam_dip_fiyat,2, ',', '.')." ₺"?></td> 
             <td class="text-success" style="font-weight:500;<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>"><?=number_format($fiyat->toplam_dip_fiyat_yuvarlanmis,2, ',', '.')." ₺"?></td> 
              
              
                   </tr>
                 
                   <?php $count++; endforeach; ?>
               </tbody>
                
             </table>

   </div>
   <div class="tab-pane fade" id="custom-tabs-umex-plus" role="tabpanel" aria-labelledby="custom-tabs-four-umex-plus">
   
   <table style="border:2px solid red; border-top:0px" class="table table-bordered table-responsive table-striped text-md">
               <thead>
               <tr>
                 <th style="width:25%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;width: 150px;">PEŞİNAT</th> 
                 <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;">VADE</th>
                 <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;">SENET</th>
                 <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;" >AYLIK</th>
                 <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;" >DİP FİYAT</th>
              <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;" >YUVARLANMIŞ FİYAT</th>
              
               </tr>
               </thead>
               <tbody>
                 <?php $count=0; foreach ($umexplusfiyat as $fiyat) : ?>

                   <tr>
                    <?php
                     if( $fiyat->vade == 20){
                       ?>
                       <td rowspan="11" style="border-bottom:1px solid red;vertical-align : middle;text-align:center;background:white;font-weight:bold;font-size:30px"><?="₺ ".number_format($fiyat->pesinat_fiyati,2)?><br><span style="font-weight:400;color:red">Peşinat</span></td>
                       <?php
                     }
                    ?>
                     
                     <td style="padding-left:10px;<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>font-weight:bold;"><?=$fiyat->vade?> <span style="font-weight:300;">Ay Vadeli</span></td>
                     <td style="<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>"><?=number_format($fiyat->senet,2, ',', '.')." ₺"?></td>
                     <td style="<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>"><?=number_format($fiyat->aylik_taksit_tutar,2, ',', '.')." ₺"?></td>
                     <td style="<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>"><?=number_format($fiyat->toplam_dip_fiyat,2, ',', '.')." ₺"?></td> 
             <td class="text-success" style="font-weight:500;<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>"><?=number_format($fiyat->toplam_dip_fiyat_yuvarlanmis,2, ',', '.')." ₺"?></td> 
              
              
                   </tr>
                 
                   <?php $count++; endforeach; ?>
               </tbody>
                
             </table>


   </div>
   <div class="tab-pane fade" id="custom-tabs-umex-slim" role="tabpanel" aria-labelledby="custom-tabs-four-umex-slim">
     
   <table style="border:2px solid red; border-top:0px" class="table table-bordered table-responsive table-striped text-md">
               <thead>
               <tr>
                 <th style="width:25%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;width: 150px;">PEŞİNAT</th> 
                 <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;">VADE</th>
                 <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;">SENET</th>
                 <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;" >AYLIK</th>
                 <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;" >DİP FİYAT</th>
              <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;" >YUVARLANMIŞ FİYAT</th>
              
               </tr>
               </thead>
               <tbody>
                 <?php $count=0; foreach ($umexslimfiyat as $fiyat) : ?>

                   <tr>
                    <?php
                     if( $fiyat->vade == 20){
                       ?>
                       <td rowspan="11" style="border-bottom:1px solid red;vertical-align : middle;text-align:center;background:white;font-weight:bold;font-size:30px"><?="₺ ".number_format($fiyat->pesinat_fiyati,2)?><br><span style="font-weight:400;color:red">Peşinat</span></td>
                       <?php
                     }
                    ?>
                     
                     <td style="padding-left:10px;<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>font-weight:bold;"><?=$fiyat->vade?> <span style="font-weight:300;">Ay Vadeli</span></td>
                     <td style="<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>"><?=number_format($fiyat->senet,2, ',', '.')." ₺"?></td>
                     <td style="<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>"><?=number_format($fiyat->aylik_taksit_tutar,2, ',', '.')." ₺"?></td>
                     <td style="<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>"><?=number_format($fiyat->toplam_dip_fiyat,2, ',', '.')." ₺"?></td> 
             <td class="text-success" style="font-weight:500;<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>"><?=number_format($fiyat->toplam_dip_fiyat_yuvarlanmis,2, ',', '.')." ₺"?></td> 
              
              
                   </tr>
                 
                   <?php $count++; endforeach; ?>
               </tbody>
                
             </table>

   </div>
   <div class="tab-pane fade" id="custom-tabs-umex-ems" role="tabpanel" aria-labelledby="custom-tabs-four-umex-ems">
     
   <table style="border:2px solid red; border-top:0px" class="table table-bordered table-responsive table-striped text-md">
               <thead>
               <tr>
                 <th style="width:25%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;width: 150px;">PEŞİNAT</th> 
                 <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;">VADE</th>
                 <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;">SENET</th>
                 <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;" >AYLIK</th>
                 <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;" >DİP FİYAT</th>
              <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;" >YUVARLANMIŞ FİYAT</th>
              
               </tr>
               </thead>
               <tbody>
                 <?php $count=0; foreach ($umexemsfiyat as $fiyat) : ?>

                   <tr>
                    <?php
                     if( $fiyat->vade == 20){
                       ?>
                       <td rowspan="11" style="border-bottom:1px solid red;vertical-align : middle;text-align:center;background:white;font-weight:bold;font-size:30px"><?="₺ ".number_format($fiyat->pesinat_fiyati,2)?><br><span style="font-weight:400;color:red">Peşinat</span></td>
                       <?php
                     }
                    ?>
                     
                     <td style="padding-left:10px;<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>font-weight:bold;"><?=$fiyat->vade?> <span style="font-weight:300;">Ay Vadeli</span></td>
                     <td style="<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>"><?=number_format($fiyat->senet,2, ',', '.')." ₺"?></td>
                     <td style="<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>"><?=number_format($fiyat->aylik_taksit_tutar,2, ',', '.')." ₺"?></td>
                     <td style="<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>"><?=number_format($fiyat->toplam_dip_fiyat,2, ',', '.')." ₺"?></td> 
             <td class="text-success" style="font-weight:500;<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>"><?=number_format($fiyat->toplam_dip_fiyat_yuvarlanmis,2, ',', '.')." ₺"?></td> 
              
              
                   </tr>
                 
                   <?php $count++; endforeach; ?>
               </tbody>
                
             </table>
   </div>
   <div class="tab-pane fade" id="custom-tabs-umex-s" role="tabpanel" aria-labelledby="custom-tabs-four-umex-s">
   <table style="border:2px solid red; border-top:0px" class="table table-bordered table-responsive table-striped text-md">
               <thead>
               <tr>
                 <th style="width:25%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;width: 150px;">PEŞİNAT</th> 
                 <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;">VADE</th>
                 <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;">SENET</th>
                 <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;" >AYLIK</th>
                 <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;" >DİP FİYAT</th>
              <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;" >YUVARLANMIŞ FİYAT</th>
              
               </tr>
               </thead>
               <tbody>
                 <?php $count=0; foreach ($umexsfiyat as $fiyat) : ?>

                   <tr>
                    <?php
                     if( $fiyat->vade == 20){
                       ?>
                       <td rowspan="11" style="border-bottom:1px solid red;vertical-align : middle;text-align:center;background:white;font-weight:bold;font-size:30px"><?="₺ ".number_format($fiyat->pesinat_fiyati,2)?><br><span style="font-weight:400;color:red">Peşinat</span></td>
                       <?php
                     }
                    ?>
                     
                     <td style="padding-left:10px;<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>font-weight:bold;"><?=$fiyat->vade?> <span style="font-weight:300;">Ay Vadeli</span></td>
                     <td style="<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>"><?=number_format($fiyat->senet,2, ',', '.')." ₺"?></td>
                     <td style="<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>"><?=number_format($fiyat->aylik_taksit_tutar,2, ',', '.')." ₺"?></td>
                     <td style="<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>"><?=number_format($fiyat->toplam_dip_fiyat,2, ',', '.')." ₺"?></td> 
             <td class="text-success" style="font-weight:500;<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>"><?=number_format($fiyat->toplam_dip_fiyat_yuvarlanmis,2, ',', '.')." ₺"?></td> 
              
              
                   </tr>
                 
                   <?php $count++; endforeach; ?>
               </tbody>
                
             </table>

   </div>
   <div class="tab-pane fade" id="custom-tabs-umex-diode" role="tabpanel" aria-labelledby="custom-tabs-four-umex-diode">
   <table style="border:2px solid red; border-top:0px" class="table table-bordered table-responsive table-striped text-md">
               <thead>
               <tr>
                 <th style="width:25%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;width: 150px;">PEŞİNAT</th> 
                 <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;">VADE</th>
                 <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;">SENET</th>
                 <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;" >AYLIK</th>
                 <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;" >DİP FİYAT</th>
              <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;" >YUVARLANMIŞ FİYAT</th>
              
               </tr>
               </thead>
               <tbody>
                 <?php $count=0; foreach ($umexdiodefiyat as $fiyat) : ?>

                   <tr>
                    <?php
                     if( $fiyat->vade == 20){
                       ?>
                       <td rowspan="11" style="border-bottom:1px solid red;vertical-align : middle;text-align:center;background:white;font-weight:bold;font-size:30px"><?="₺ ".number_format($fiyat->pesinat_fiyati,2)?><br><span style="font-weight:400;color:red">Peşinat</span></td>
                       <?php
                     }
                    ?>
                     
                     <td style="padding-left:10px;<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>font-weight:bold;"><?=$fiyat->vade?> <span style="font-weight:300;">Ay Vadeli</span></td>
                     <td style="<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>"><?=number_format($fiyat->senet,2, ',', '.')." ₺"?></td>
                     <td style="<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>"><?=number_format($fiyat->aylik_taksit_tutar,2, ',', '.')." ₺"?></td>
                     <td style="<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>"><?=number_format($fiyat->toplam_dip_fiyat,2, ',', '.')." ₺"?></td> 
             <td class="text-success" style="font-weight:500;<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>"><?=number_format($fiyat->toplam_dip_fiyat_yuvarlanmis,2, ',', '.')." ₺"?></td> 
              
              
                   </tr>
                 
                   <?php $count++; endforeach; ?>
               </tbody>
                
             </table>
   </div>
   <div class="tab-pane fade" id="custom-tabs-umex-gold" role="tabpanel" aria-labelledby="custom-tabs-four-umex-gold">
   
   
   <table style="border:2px solid red; border-top:0px" class="table table-bordered table-responsive table-striped text-md">
               <thead>
               <tr>
                 <th style="width:25%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;width: 150px;">PEŞİNAT</th> 
                 <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;">VADE</th>
                 <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;">SENET</th>
                 <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;" >AYLIK</th>
                 <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;" >DİP FİYAT</th>
              <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;" >YUVARLANMIŞ FİYAT</th>
              
               </tr>
               </thead>
               <tbody>
                 <?php $count=0; foreach ($umexgoldfiyat as $fiyat) : ?>

                   <tr>
                    <?php
                     if( $fiyat->vade == 20){
                       ?>
                       <td rowspan="11" style="border-bottom:1px solid red;vertical-align : middle;text-align:center;background:white;font-weight:bold;font-size:30px"><?="₺ ".number_format($fiyat->pesinat_fiyati,2)?><br><span style="font-weight:400;color:red">Peşinat</span></td>
                       <?php
                     }
                    ?>
                     
                     <td style="padding-left:10px;<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>font-weight:bold;"><?=$fiyat->vade?> <span style="font-weight:300;">Ay Vadeli</span></td>
                     <td style="<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>"><?=number_format($fiyat->senet,2, ',', '.')." ₺"?></td>
                     <td style="<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>"><?=number_format($fiyat->aylik_taksit_tutar,2, ',', '.')." ₺"?></td>
                     <td style="<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>"><?=number_format($fiyat->toplam_dip_fiyat,2, ',', '.')." ₺"?></td> 
             <td class="text-success" style="font-weight:500;<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>"><?=number_format($fiyat->toplam_dip_fiyat_yuvarlanmis,2, ',', '.')." ₺"?></td> 
              
              
                   </tr>
                 
                   <?php $count++; endforeach; ?>
               </tbody>
                
             </table>


   </div>
   <div class="tab-pane fade" id="custom-tabs-umex-q" role="tabpanel" aria-labelledby="custom-tabs-four-umex-q">
     

   <table style="border:2px solid red; border-top:0px" class="table table-bordered table-responsive table-striped text-md">
               <thead>
               <tr>
                 <th style="width:25%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;width: 150px;">PEŞİNAT</th> 
                 <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;">VADE</th>
                 <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;">SENET</th>
                 <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;border-right:3px solid #d80000;" >AYLIK</th>
                 <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;" >DİP FİYAT</th>
              <th style="width:15%;font-size:15px;padding:6px;background:#d80000;color:white;border-bottom:3px solid #d80000;" >YUVARLANMIŞ FİYAT</th>
              
               </tr>
               </thead>
               <tbody>
                 <?php $count=0; foreach ($umexqfiyat as $fiyat) : ?>

                   <tr>
                    <?php
                     if( $fiyat->vade == 20){
                       ?>
                       <td rowspan="11" style="border-bottom:1px solid red;vertical-align : middle;text-align:center;background:white;font-weight:bold;font-size:30px"><?="₺ ".number_format($fiyat->pesinat_fiyati,2)?><br><span style="font-weight:400;color:red">Peşinat</span></td>
                       <?php
                     }
                    ?>
                     
                     <td style="padding-left:10px;<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>font-weight:bold;"><?=$fiyat->vade?> <span style="font-weight:300;">Ay Vadeli</span></td>
                     <td style="<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>"><?=number_format($fiyat->senet,2, ',', '.')." ₺"?></td>
                     <td style="<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>"><?=number_format($fiyat->aylik_taksit_tutar,2, ',', '.')." ₺"?></td>
                     <td style="<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>"><?=number_format($fiyat->toplam_dip_fiyat,2, ',', '.')." ₺"?></td> 
             <td class="text-success" style="font-weight:500;<?=( $fiyat->vade == 1) ? "border-bottom:1px solid red;" : ""?>"><?=number_format($fiyat->toplam_dip_fiyat_yuvarlanmis,2, ',', '.')." ₺"?></td> 
              
              
                   </tr>
                 
                   <?php $count++; endforeach; ?>
               </tbody>
                
             </table>

   </div>
 </div>
</div>
</div>








         </div>

















         <div class="modal fade" id="modal-lg" data-backdrop="static">
     <div class="modal-dialog modal-lg modal-dialog-centered">
       <div class="modal-content">
         <div class="modal-header bg-success" style="background:#02243d !important;padding: 0.5rem;">
           <h4 class="modal-title text-md pl-2"><i class="fas fa-file-invoice" style="color:#b9b9b9"></i> Sipariş / Ürün Bilgileri</h4>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true" style="opacity:1;color:white !important;">&times;</span>
           </button>
         </div>
         <div class="modal-header bg-success" style="margin-top:-2px;background:#fff6b3 !important;padding: 0.5rem;">
           <h5 class="modal-title text-sm pl-2" style="color:#6b5e00;font-weight:normal"><i class="fas fa-exclamation-circle"></i> Bu satır daha sonra düzenlemez. Bilgileri doğru girdiğinizden emin olunuz.</h5>
         </div>

         <form id="add_form" action="#" name="add_form">
         <div class="modal-body pt-0 pl-0 pr-0">
         

<div class="p-2">

           <div class="row p-2" >



           <div class="form-group col-md-6 pl-0 pr-2">
             <label for="formClient-Name"><i class="fa fa-box text-dark"></i> Ürün Seçimi Yapınız</label>
           
           
           <select id="ekle_urun" class="select2urun form-control ">
            <?php 
               foreach ($urunler as $urun) {
                 ?><option value="<?=$urun->urun_id?>" data-example="/ <?=$urun->urun_aciklama?>"><?=$urun->urun_adi?></option><?php
               }

            ?>
           </select>


           
           
           
           </div>



           <div class="form-group col-md-6 pr-0 pl-0 mb-1">
     <label for="formClient-Name"><i class="fas fa-swatchbook text-primary"></i> Renk</label>
  
<div id="urun_renk_div">
             </div>


           
     </div>


<div style="width: 100%;">

<label for="formClient-Name"><i class="fa fa-box text-dark"></i> Başlık Seçimi Yapınız</label><br>
           <a class="btn btn-danger btn-sm mr-2" style="display:none;" id="btnBaslikError">Siparişi oluşturmak için başlık seçimi yapılmalıdır.</a>

</div>

           <div id="checkboxContainer" style="flex-wrap: wrap;width: 100%;    display: flex;">
       
       </div>


          <br> 





<div class="row mb-0" style="display: contents;">




    
  


     <div class="form-group col pl-0 pr-2 mt-2 mb-1">
     <label for="formClient-Name"><i class="fas fa-receipt text-danger"></i> Ödeme Seçeneği</label>
     <select class="select2 form-control" onchange="odeme_secenek_kontrol(this);"  required="" min="1" id="odeme_secenegi" oninvalid="this.setCustomValidity('Ödeme Seçeneği alanı zorunludur')"  oninput="setCustomValidity('')">
     <option value="" selected>Seçim Yapılmadı</option>
       <option value="1">Peşin Satış</option>
       <option value="2">Vadeli Satış</option>
             </select>
             <div id="warningMessage"></div>
    </div>


    <div class="form-group col pl-0 pr-2 mt-2 mb-1" id="vadeSayisi" style="display:none">
     <label for="formClient-Name"><i class="fas fa-calendar text-primary"></i> Vade Sayısı</label>
     <input type="number" onkeypress='validate(event)' inputmode="numeric"  min="0" max="<?=$this->session->userdata("aktif_kullanici_id") == 9 ? "30" : "20"?>" class="form-control" value="0" id="vade_sayisi" required="" placeholder="Vade Giriniz..." autofocus="">

    
    </div>


    <div class="form-group col  pl-0 pr-0 mt-2 mb-1">
     <label for="formClient-Name"><i class="fas fa-lira-sign text-orange"></i> Satış Fiyatı</label>
     <input type="text" onkeypress='validate(event)' inputmode="numeric" min="1" class="form-control" id="ekle_satis_fiyati" pattern="^\₺\d{1,3}(,\d{3})*(\.\d+)?$" placeholder="Satış Fiyatını Giriniz" value="" data-type="currency" required="" placeholder="Satış Fiyatı Giriniz..." autofocus="">
    </div>
  


</div>

        
    
<style>
     #warningMessage {
         color: red;
         margin-top: 10px;
     }
 </style>
 
   <div class="row">
  
   
  
  
   <div class="form-group col-md-6 pl-0 pr-1">
     <label for="formClient-Name"><i class="fas fa-money-bill text-primary"></i> Kapora Fiyatı</label>
     <input type="text" onkeypress='validate(event)' inputmode="numeric" min="1"  class="form-control" id="ekle_kapora_fiyati" pattern="^\₺\d{1,3}(,\d{3})*(\.\d+)?$" placeholder="Kapora Fiyatını Giriniz" value="" data-type="currency" required="" placeholder="Kapora Giriniz..." autofocus="">
    </div>

    <div class="form-group col-md-6 pr-1 pl-1">
     <label for="formClient-Name"><i class="fas fa-money-bill text-success"></i> Peşinat Fiyatı</label>
     <input type="text" onkeypress='validate(event)' inputmode="numeric" min="1"  class="form-control" id="pesinat_fiyati" pattern="^\₺\d{1,3}(,\d{3})*(\.\d+)?$" placeholder="Peşinat Fiyatını Giriniz" value="" data-type="currency" required="" placeholder="Peşinat Giriniz..." autofocus="">
    </div>

    <div class="form-group col-md-12 pr-1 pl-1">
     <label for="formClient-Name"><i class="fas fa-money-bill text-success"></i> Fatura Tutarı</label>
     <input type="number" onkeypress='validate(event)' inputmode="numeric" min="<?=$this->session->userdata("aktif_kullanici_id") == 9 ? "0" : "50000"?>"  class="form-control" id="fatura_tutari"  placeholder="Fatura Tutarını Giriniz" value="" required="" autofocus="">
    </div>

    <div class="form-group col-md-6 pr-1 pl-1">
     <label for="formClient-Name"><i class="fa fa-box text-dark"></i> Takas Cihaz Model</label>
     
     <select class="select2 form-control" id="takas_alinan_model" onchange="takasmodelchange(this);" required> 
     <option value="">SEÇİM YAPINIZ</option> 
     <option value="0">TAKAS YOK</option> 
     <option value="UMEX">UMEX</option>
       <option value="ROBOTX">ROBOTX</option>
       <option value="DIGER">DIGER</option>
   </option>
     </select>
   
   
   </div>

    <div class="form-group col-md-6 pr-1 pl-1">
     <label for="formClient-Name"><i class="fas fa-money-bill text-success"></i> Takas Bedeli</label>
     <input type="text" style="opacity:0.3" onkeypress='validate(event)' inputmode="numeric" min="0"  class="form-control" id="takas_bedeli" pattern="^\₺\d{1,3}(,\d{3})*(\.\d+)?$" placeholder="Takas Bedelini Giriniz" value="0" data-type="currency" required="" placeholder="Takas Bedelini Giriniz..." autofocus="">
    </div>


    <div class="form-group col-md-6 pr-1 pl-1">
     <label for="formClient-Name"><i class="fa fa-box text-dark"></i> Takas Cihaz Seri Kod</label>
     <input type="text" style="opacity:0.3" class="form-control" oninput='takaskontrol(this);' id="takas_alinan_seri_kod" placeholder="Takas Cihaz Serikod Giriniz" value="" autofocus="">
    </div>
    
    <div class="form-group col-md-6 pr-1 pl-1">
     <label for="formClient-Name"><i class="fa fa-box text-dark"></i> Takas Cihaz Renk</label>
     <input type="text" style="opacity:0.3" class="form-control" id="takas_alinan_renk" placeholder="Takas Cihaz Renk Giriniz" value="" autofocus="">
    </div>



    <div class="form-group col col-md-6 pl-0 pr-0 mb-1">
    <label for="formClient-Name"><i class="fas fa-tint text-primary"></i> Damla Etiket</label>
     <select class="select2 form-control"  required="" id="damla_etiket"  >
   
   <option value="0" selected>Hayır</option>
       <option value="1">Evet</option>
             </select>
             
    </div>
    <div class="form-group col col-md-6 pl-2 pr-0 mb-1">
    <label for="formClient-Name"><i class="fas fa-desktop text-success"></i> Açılış Ekranı</label>
     <select class="select2 form-control"  required="" id="acilis_ekrani"   >
      
    <option value="0" selected>Hayır</option>
       <option value="1">Evet</option>
             </select>
             
    </div>

<div class="form-group col pr-0 pl-0 mt-1">
<label for="formClient-Name"><i class="fas fa-pen text-warning"></i> Sipariş Notu</label>
   
<textarea name="siparis_notu" id="summernotesiparisnot"></textarea>
</div>



           </div>

           <div class="row">
            
<div class="form-group col  pr-1 pl-1">
     <label for="formClient-Name"><i class="fa fa-box text-dark"></i> Yenilenmiş Cihaz Mı</label>
    <select class="select2 form-control" name="yenilenmis_cihaz_mi" id="yenilenmis_cihaz_mi" required>
     <option value="">Seçim Yapılmadı</option>
     <option value="1">EVET</option>
     <option value="0">HAYIR</option>
    </select>
    </div>
           </div>


         </div>
   </form>
         <div class="modal-footer justify-content-between">
           <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times-circle"></i> Ekranı Kapat</button>
           <button type="submit" class="btn btn-success" id="addRowBtn"><i class="fa fa-plus-circle"></i> Sipariş'e Ekle</button>
           
         </div></div>
       
       </div>
       <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
   </div>


         

<script src="https://code.jquery.com/jquery-1.12.4.min.js"   integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="   crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>


function takasmodelchange(e){
  document.getElementById('takas_alinan_renk').style.opacity=(e.value == 'UMEX' || e.value == 'ROBOTX' || e.value == 'DIGER') ? '1' : '0.3';
  document.getElementById('takas_alinan_seri_kod').style.opacity=(e.value == 'UMEX' || e.value == 'ROBOTX' || e.value == 'DIGER') ? '1' : '0.3';
  document.getElementById('takas_bedeli').style.opacity=(e.value == 'UMEX' || e.value == 'ROBOTX' || e.value == 'DIGER') ? '1' : '0.3';
}


function takaskontrol(e) {
    const value = e.value;
    if (value.length === 14) {
        const takas_alinan_seri_kod = document.getElementById("takas_alinan_seri_kod");
        const seriNo = takas_alinan_seri_kod.value;
        const telefon = "<?=$merkez->musteri_iletisim_numarasi?>";

        // Sweet loading mesajı
        Swal.fire({
            title: 'Lütfen Bekleyin',
            text: 'Takas alınacak müşteri bilgileri sorgulanıyor...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        fetch("<?= base_url('siparis/takaslikontrol') ?>", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ seri_no: seriNo, telefon: telefon }),
        })
        .then(response => response.json())
        .then(data => {
            Swal.close(); // Yükleme tamamlandıktan sonra sweet kapat
            if (data.durum == false) {
                Swal.fire({
                    title: "TAKAS - MÜŞTERİ İLİŞKİSİ KURULAMADI",
                    text: "Sipariş oluşturmak istediğiniz <?=$merkez->musteri_ad?> (" + telefon + ") müşterisi ile takas olarak girdiğiniz " + seriNo + " seri numarasına tanımlı müşteri bilgileri birbirinden farklı. Sistem yöneticiniz ile iletişime geçiniz.",
                    icon: "error",
                    confirmButtonColor: "red",
                    confirmButtonText: "TAMAM"
                });
                takas_alinan_seri_kod.value = "";
                takas_alinan_seri_kod.style.border = "1px solid red";
            }else{
              takas_alinan_seri_kod.style.border = "1px solid green";
            }
        })
        .catch(error => {
            Swal.close();
            console.error("Hata:", error);
            Swal.fire({
                title: "Bir Hata Oluştu",
                text: "İşlem sırasında bir hata meydana geldi. Lütfen tekrar deneyiniz.",
                icon: "error"
            });
        });
    }
}



function odeme_secenek_kontrol(id) {
 
if(id.value == 1){
document.getElementById("vade_sayisi").value = 0;
document.getElementById("vadeSayisi").style.display = "none"; 
}else{
document.getElementById("vadeSayisi").style.display = "block";  
} 
}


function showDataId(id) {
 


 $('#ekle_urun').val(id).trigger('change');
}





$(document).ready(function() {

 
$(function() {
 $('#ekle_satis_fiyati').maskMoney();
})



 var table =  $('#exampleurunsiparis').DataTable({
   "paging": false,
   "lengthChange": false,
   "searching": false,
   "ordering": false,
   "info": false,
   "autoWidth": false,
   "responsive": true,
 });
 

$('#exampleurunsiparis tbody').on( 'click', 'button', function () {
 table
     .row( $(this).parents('tr') )
     .remove()
     .draw();
} );
document.getElementById("vade_sayisi").addEventListener("focus", function() {
 if (this.value === '0') {
     this.value = '';
 }
});

function convertToInt(inputValue) {
 
 var intValue = parseInt(inputValue, 10);

 
 if (isNaN(intValue)) {
     intValue = 0;
 }

 return intValue;
}


   function handleFormSubmit(event) {    
     
     document.getElementById("btnBaslikError").style.display = "block";

     
     event.preventDefault();


     var numberInput = document.getElementById('ekle_satis_fiyati');

     if (numberInput.validity.valueMissing) {
         numberInput.setCustomValidity('Bu alan boş bırakılamaz.');
         return;
     } else if (numberInput.validity.rangeUnderflow) {
         numberInput.setCustomValidity('Lütfen 0\'dan büyük bir sayı girin.');
         return;
     } else {
         numberInput.setCustomValidity('');
     }









   selectElement = document.getElementById("ekle_urun");
   const fiyat_format = new Intl.NumberFormat('tr-TR', { style: 'currency', currency: 'TRY' });

   var urun = selectElement.options[selectElement.selectedIndex];
   var baslik=document.getElementsByName('baslik_select[]');
   var baslik_title = "";
   var baslik_ids = [];
   for(key=0; key < baslik.length; key++)  {
     if(baslik[key].checked){
       baslik_title += baslik[key].getAttribute("data-name");
       baslik_ids.push(baslik[key].value);
     }
   }


   if(baslik_title==""){
  document.getElementById("btnBaslikError").style.display = "block";
   }else{


    





   var renk = document.getElementById("ekle_renk").options[document.getElementById("ekle_renk").selectedIndex];

   var satis_fiyati = document.getElementById("ekle_satis_fiyati"); 
   var kapora_fiyati = document.getElementById("ekle_kapora_fiyati");
   var pesinat_fiyati = document.getElementById("pesinat_fiyati");
   var fatura_tutari = document.getElementById("fatura_tutari");
   var takas_bedeli = document.getElementById("takas_bedeli");

   var takas_alinan_seri_kod = document.getElementById("takas_alinan_seri_kod");
   var takas_alinan_model = document.getElementById("takas_alinan_model");
   var takas_alinan_renk = document.getElementById("takas_alinan_renk");

   var odeme_secenegi = document.getElementById("odeme_secenegi");
   var vade_sayisi = document.getElementById("vade_sayisi");

   var damla_etiket = document.getElementById("damla_etiket");
   var acilis_ekrani = document.getElementById("acilis_ekrani");

 var yenilenmis_cihaz_mi = document.getElementById("yenilenmis_cihaz_mi");

   
   var control_satis_fiyati = satis_fiyati.value;
   control_satis_fiyati = control_satis_fiyati.replace(",","");
   control_satis_fiyati = control_satis_fiyati.replace("₺","");


   var control_kapora_fiyati = kapora_fiyati.value;
   control_kapora_fiyati = control_kapora_fiyati.replace(",","");
   control_kapora_fiyati = control_kapora_fiyati.replace("₺","");

   var control_pesinat_fiyati = pesinat_fiyati.value;
   control_pesinat_fiyati = control_pesinat_fiyati.replace(",","");
   control_pesinat_fiyati = control_pesinat_fiyati.replace("₺","");

   var control_takas_fiyati = takas_bedeli.value;
   control_takas_fiyati = control_takas_fiyati.replace(",","");
   control_takas_fiyati = control_takas_fiyati.replace("₺","");

if(takas_alinan_model.value == "0"){
  takas_bedeli.value="0";
}

 // LİMİT KONTROL
   var limit_urun_id = $("#ekle_urun").val();

   if(limit_urun_id != 1 && limit_urun_id != 8){
     document.getElementById("takas_bedeli").value= "0";    
     $("#takas_alinan_model").select2("val", "0");
   }

   if(odeme_secenegi.value == "2" && vade_sayisi.value=="0"){
     Swal.fire({title: "Sipariş Başarısız",text: "Vadeli satışlarda vade sayısı 0'dan büyük olmak zorundadır. Bilgileri kontrol edip tekrar deneyiniz.",icon: "error",confirmButtonColor: "red", confirmButtonText: "TAMAM"});
     document.getElementById("btnBaslikError").style.display = "none";
     return;  
   }

   if(control_takas_fiyati == 0 && (takas_alinan_model.value=="UMEX" || takas_alinan_model.value=="ROBOTX" || takas_alinan_model.value=="DIGER")){
     Swal.fire({title: "Sipariş Başarısız",text: "Takaslı satışlarda takas bedeli 0'dan büyük olmak zorundadır. Bilgileri kontrol edip tekrar deneyiniz.",icon: "error",confirmButtonColor: "red", confirmButtonText: "TAMAM"});
     document.getElementById("btnBaslikError").style.display = "none";
     return;  
   }


   if(takas_alinan_model.value=="UMEX" && (takas_alinan_seri_kod.value=="" || takas_alinan_renk.value=="")){
     Swal.fire({title: "TAKAS BİLGİLERİ EKSİK",text: "UMEX Takaslı Satışlarda TAKAS CİHAZ SERİ KOD ve TAKAS CİHAZ RENK alanları zorunludur. ",icon: "error",confirmButtonColor: "red", confirmButtonText: "TAMAM"});
     
     return;  
   }
   if(takas_alinan_model.value=="UMEX"){
    if (takas_alinan_seri_kod.value.startsWith('UG') && takas_alinan_seri_kod.value.length === 14) {
                
            } else {
              Swal.fire({title: "TAKAS SERİ NO HATALI",text: "UMEX Takaslı Satışlarda TAKAS CİHAZ SERİ KODU UG ile başlamalı ve 14 karakter olmalıdır. ",icon: "error",confirmButtonColor: "red", confirmButtonText: "TAMAM"});
     
     return;  
            }
   
 


          



   }

 

   var limit_control_bool = 1;


     $.post("<?=base_url("kullanici/get_fiyat_limitleri/")?>", {
       urun_id: limit_urun_id,
       vade_sayisi: vade_sayisi.value,
       pesinat_tutari: control_pesinat_fiyati 
     }, function(data, status) {
     
         if (status === 'success') {

           if (data.status === 'fullaccess')
     {
       limit_control_bool = 1;
     }else{
        
           if((Number(control_pesinat_fiyati) + Number(control_kapora_fiyati)) < data.data[0].pesinat_fiyati){
             Swal.fire({title: "PEŞİNAT ve KAPORA HATALI",text: "Peşinat ve kapora fiyatlarını toplamı en az "+data.data[0].pesinat_fiyati+" olmak zorundadır.",icon: "error",confirmButtonColor: "red", confirmButtonText: "TAMAM"});
             document.getElementById("btnBaslikError").style.display = "none";
             return;  
           }



          


           if(odeme_secenegi.value == 1){
             if(Number(control_satis_fiyati) < Number(data.data[0].nakit_takassiz_satis_fiyat_kontrol)){
               Swal.fire({title: "SATIŞ FİYATI HATALI",text: "Satış fiyatı için girdiğiniz tutar geçersiz. Satış için izin verilen alt limit "+data.data[0].nakit_takassiz_satis_fiyat+" TL 'dir. Lütfen yetkili kişi ile iletişime geçiniz.",icon: "error",confirmButtonColor: "red", confirmButtonText: "TAMAM"});
               document.getElementById("btnBaslikError").style.display = "none";
               limit_control_bool = 0
             }


             if(convertToInt(control_takas_fiyati)>0){
                 if(takas_alinan_model.value=="UMEX"){
                   if(Number(control_takas_fiyati) > Number(data.data[0].nakit_umex_takas_fiyat)){
                     Swal.fire({
                       title: "UMEX TAKAS BEDELİ HATALI - PEŞİN",
                       text: "Umex marka takas alınan cihaz için girdiğiniz takas bedeli geçersiz. Bu takas için izin verilen üst limit : "+data.data[0].nakit_umex_takas_fiyat,
                       icon: "error",
                       confirmButtonColor: "red", 
                       confirmButtonText: "TAMAM"
                     });
                     document.getElementById("btnBaslikError").style.display = "none";
                     return;
                   }
                 }

                 if(takas_alinan_model.value=="ROBOTX"){
                   if(Number(control_takas_fiyati) > Number(data.data[0].nakit_robotix_takas_fiyat)){
                     Swal.fire({
                       title: "ROBOTX TAKAS BEDELİ HATALI - PEŞİN",
                       text: "ROBOTX marka takas alınan cihaz için girdiğiniz takas bedeli geçersiz. Bu takas için izin verilen üst limit : "+data.data[0].nakit_robotix_takas_fiyat,
                       icon: "error",
                       confirmButtonColor: "red", 
                       confirmButtonText: "TAMAM"
                     });
                     document.getElementById("btnBaslikError").style.display = "none";
                     return;
                   }
                 }

                 if(takas_alinan_model.value=="DIGER"){
                   if(Number(control_takas_fiyati) > Number(data.data[0].nakit_diger_takas_fiyat)){
                     Swal.fire({
                       title: "DIGER CİHAZ TAKAS BEDELİ HATALI - PEŞİN",
                       text: "DIGER marka takas alınan cihaz için girdiğiniz takas bedeli geçersiz. Bu takas için izin verilen üst limit : "+data.data[0].nakit_diger_takas_fiyat,
                       icon: "error",
                       confirmButtonColor: "red", 
                       confirmButtonText: "TAMAM"
                     });
                     document.getElementById("btnBaslikError").style.display = "none";
                     return;
                   }
                 }
             }



           } 
           else if(odeme_secenegi.value == 2){
             if(Number(control_satis_fiyati) < Number(data.data[0].vadeli_satis_fiyat_kontrol)){
               Swal.fire({title: "SATIŞ FİYATI HATALI",text: "Satış fiyatı için girdiğiniz tutar geçersiz."+vade_sayisi.value+" ay vadeli, "+(Number(control_pesinat_fiyati)+Number(control_kapora_fiyati))+ " peşinatlı satış için izin verilen alt limit "+data.data[0].vadeli_satis_fiyat+" TL 'dir. Lütfen yetkili kişi ile iletişime geçiniz.",icon: "error",confirmButtonColor: "red", confirmButtonText: "TAMAM"});
              
               document.getElementById("btnBaslikError").style.display = "none";
               limit_control_bool = 0
             }




             if(convertToInt(control_takas_fiyati)>0){
                 if(takas_alinan_model.value=="UMEX"){
                   if(Number(control_takas_fiyati) > Number(data.data[0].vadeli_umex_takas_fiyat)){
                     Swal.fire({
                       title: "UMEX TAKAS BEDELİ HATALI - VADELİ",
                       text: "Umex marka takas alınan cihaz için girdiğiniz takas bedeli geçersiz. Bu takas için izin verilen üst limit : "+data.data[0].vadeli_umex_takas_fiyat,
                       icon: "error",
                       confirmButtonColor: "red", 
                       confirmButtonText: "TAMAM"
                     });
                     document.getElementById("btnBaslikError").style.display = "none";
                     return;
                   }
                 }

                 if(takas_alinan_model.value=="ROBOTX"){
                   if(Number(control_takas_fiyati) > Number(data.data[0].vadeli_robotix_takas_fiyat)){
                     Swal.fire({
                       title: "ROBOTX TAKAS BEDELİ HATALI - VADELİ",
                       text: "ROBOTX marka takas alınan cihaz için girdiğiniz takas bedeli geçersiz. Bu takas için izin verilen üst limit : "+data.data[0].vadeli_robotix_takas_fiyat,
                       icon: "error",
                       confirmButtonColor: "red", 
                       confirmButtonText: "TAMAM"
                     });
                     document.getElementById("btnBaslikError").style.display = "none";
                     return;
                   }
                 }

                 if(takas_alinan_model.value=="DIGER"){
                   if(Number(control_takas_fiyati) > Number(data.data[0].vadeli_diger_takas_fiyat)){
                     Swal.fire({
                       title: "DIGER CİHAZ TAKAS BEDELİ HATALI - VADELİ",
                       text: "DIGER marka takas alınan cihaz için girdiğiniz takas bedeli geçersiz. Bu takas için izin verilen üst limit : "+data.data[0].vadeli_diger_takas_fiyat,
                       icon: "error",
                       confirmButtonColor: "red", 
                       confirmButtonText: "TAMAM"
                     });
                     document.getElementById("btnBaslikError").style.display = "none";
                     return;
                   }
                 }
             }



           }
           
           

         }








           if(limit_control_bool == 0){
return;
}





$hesaplanan_tutar = (convertToInt(control_satis_fiyati) - (convertToInt(control_kapora_fiyati) + convertToInt(control_pesinat_fiyati) + convertToInt(control_takas_fiyati)));
           if(odeme_secenegi.value == "1"){
     if($hesaplanan_tutar > 0 || $hesaplanan_tutar < 0){
       Swal.fire({
           title: "Sipariş Başarısız",
           text: "Peşin satışlarda Kapora, Peşinat ve Takas Bedeli tutarlarının toplamı Satış fiyatına eşit olmak zorundadır. Bilgileri kontrol edip tekrar deneyiniz.",
           icon: "error",
           confirmButtonColor: "red", 
       confirmButtonText: "TAMAM"
         });
         document.getElementById("btnBaslikError").style.display = "none";
         return;  
     }
   }else if(odeme_secenegi.value == "2"){
     if(vade_sayisi.value=="0"){
       Swal.fire({
           title: "Sipariş Başarısız",
           text: "Vadeli satışlarda vade sayısı 0'dan büyük olmak zorundadır. Bilgileri kontrol edip tekrar deneyiniz.",
           icon: "error",
           confirmButtonColor: "red", 
       confirmButtonText: "TAMAM"
         });
         document.getElementById("btnBaslikError").style.display = "none";
         return;  
       }
   }




   var siparis_notu = $('#summernotesiparisnot').summernote('code');

   var newRowData = [
     '<span><input type="hidden" name="urun[]"           value="'+urun.value+'">'+urun.text+'</span>',
    '<span><input type="hidden" name="baslik[]"           value="'+btoa(JSON.stringify(baslik_ids))+'">'+baslik_title+'</span>',
    
     '<span><input type="hidden" name="renk[]"           value="'+renk.value+'">'+renk.text+'</span>',
     '<span><input type="hidden" name="satis_fiyati[]"   value="'+satis_fiyati.value+'">'+satis_fiyati.value+'</span>',
     '<span><input type="hidden" name="kapora_fiyati[]"  value="'+kapora_fiyati.value+'">'+kapora_fiyati.value+'</span>',
     '<span><input type="hidden" name="pesinat_fiyati[]" value="'+pesinat_fiyati.value+'">'+pesinat_fiyati.value+'</span>',
     '<span><input type="hidden" name="fatura_tutari[]" value="'+fatura_tutari.value+'">'+fatura_tutari.value+'</span>',
    
     '<span><input type="hidden" name="odeme_secenegi[]" value="'+((document.getElementById("odeme_secenegi").value == "1") ?"1":"2")+'">'+((odeme_secenegi.value == "1") ?"PEŞİN SATIŞ":"VADELİ SATIŞ")+'</span>',
     '<span><input type="hidden" name="vade_sayisi[]" value="'+vade_sayisi.value+'">'+vade_sayisi.value+'</span>',
    
     '<span><input type="hidden" name="damla_etiket[]" value="'+damla_etiket.value+'">'+((damla_etiket.value == "1") ?"<span class='badge bg-default  text-success' style='background: #d6ebd1;padding:5px;font-weight:normal'><i class='fa fa-check-circle text-success'></i> EVET / YAPILACAK</span>" : "<span style='background: #ffdddd;padding:5px;font-weight:normal' class='badge bg-default  text-danger'><i class='fa fa-times-circle text-danger'></i> HAYIR / YAPILMAYACAK</span>")+'</span>',
     '<span><input type="hidden" name="acilis_ekrani[]" value="'+acilis_ekrani.value +'">'+((acilis_ekrani.value == "1") ?"<span class='badge bg-default  text-success' style='background: #d6ebd1;padding:5px;font-weight:normal'><i class='fa fa-check-circle text-success'></i> EVET / YAPILACAK</span>" : "<span style='background: #ffdddd;padding:5px;font-weight:normal' class='badge bg-default  text-danger'><i class='fa fa-times-circle text-danger'></i> HAYIR / YAPILMAYACAK</span>")+'</span>'
     
    + '<span><input type="hidden" name="takas_bedeli[]" value="'+takas_bedeli.value+'">'+'<input type="hidden" name="takas_alinan_seri_kod[]" value="'+takas_alinan_seri_kod.value+'">'
   +'<input type="hidden" name="takas_alinan_model[]" value="'+takas_alinan_model.value+'">'
   +'<input type="hidden" name="takas_alinan_renk[]" value="'+takas_alinan_renk.value+'">'

   +'<input type="hidden" name="yenilenmis_cihaz_mi[]" value="'+yenilenmis_cihaz_mi.value+'">'
    +'<span><input type="hidden" name="siparis_notu[]"   value="'+siparis_notu.replace(/<\/?[^>]+>/gi, '')+'">'+siparis_notu.replace(/<\/?[^>]+>/gi, '')+'</span>'
   
     

    
   
     ,
    
     '<button type="button" class="btn btn-danger btn-xs" ><i class="fa fa-times"></i> Ürün İptal</button>'
   ];

   table.row.add(newRowData).draw();
 
 
   renk.value = "";
   satis_fiyati.value = ""; 
   kapora_fiyati.value = "";fatura_tutari.value = "";
   pesinat_fiyati.value = ""; takas_bedeli.value = "";
   vade_sayisi.value = "0"; 


   document.getElementById("btnBaslikError").style.display = "none";
   $('#ekle_urun').val(1).trigger('change');
   $('#odeme_secenegi').val('').trigger('change');
   $('#summernotesiparisnot').summernote('code',null);

   $('#modal-lg').modal('hide');







           
         } else {
           limit_control_bool = 0;
           alert("Bir hata oluştu: " + status);
         }
       }).fail(function(jqXHR, textStatus, errorThrown) {
         limit_control_bool = 0
         alert("AJAX isteği başarısız oldu: " + textStatus + ", " + errorThrown);
       });








//******************** */

 }


  

}
 var form = document.getElementById('add_form');

 form.addEventListener('submit', handleFormSubmit);

});
</script>
<style>
@media (min-width: 992px) {
 .modal-lg,
 .modal-xl {
     max-width: 572px;
 }
}

.modal.fade .modal-dialog {
 transform: scale(0.1);
 transition: transform 0.3s ease-in-out;
}

.modal.fade.show .modal-dialog {
 transform: scale(1);
}
</style>







      


<script>
 $(document).ready(function(){
   $('#ekle_urun').on('change', function(e){
     var urun_id = $(this).val();
   
     if(urun_id != 1 && urun_id != 8){
       document.getElementById("takas_bedeli").value= "0";    
        $("#takas_alinan_model").select2("val", "0");
     }


     $.post('<?=base_url("urun/get_renkler/")?>'+urun_id, {}, function(result){
      

       if ( result && result.status != 'error' )
       {
       
         var renkler = result.data;
         var select = '<select name="ekle_renk" id="ekle_renk" class="select2 form-control rounded-0">';
         for( var i = 0; i < renkler.length; i++)
         {
           select += '<option value="'+ renkler[i].id +'">'+ renkler[i].renk +'</option>';
         }
         select += '</select>';
         $('#urun_renk_div').empty().html(select);
          
         $('#ekle_renk').select2();
       }
       else
       {
         alert('Hata : ' + result.message );
       }					
     });









     $.post('<?=base_url("urun/get_basliklar/")?>'+urun_id, {}, function(result){
      

      if ( result && result.status != 'error' )
      {
      
       
       var container = document.getElementById("checkboxContainer");
               
               container.innerHTML = '';
               result.data.forEach(function(state) {
          

          
               var checkboxDiv = document.createElement("div");
               checkboxDiv.className = "icheck-primary custom-container";
               checkboxDiv.setAttribute("for", "checkboxPrimary" + state.renk);
               
               
               var checkboxInput = document.createElement("input");
               checkboxInput.type = "checkbox";
               checkboxInput.name = "baslik_select[]";
               checkboxInput.value = state.id;
               checkboxInput.setAttribute("data-name", state.renk);
               
               
               checkboxInput.id = "checkboxPrimary" + state.id;
               if(urun_id == 2 || urun_id == 3 || urun_id == 4 || urun_id == 5 || urun_id == 7){
                 checkboxInput.checked = "checked";
               }
            
               /*  if (dizi.includes(state.id)) {
                 checkboxInput.checked = "checked";
              
                 }*/

                 
               var checkboxLabel = document.createElement("label");
               checkboxLabel.setAttribute("for", "checkboxPrimary" + state.id);
               checkboxLabel.style.width = "100%";checkboxLabel.style.fontWeight = "400";
               checkboxLabel.style.fontWeight = "500";
                checkboxLabel.textContent = state.renk;
               checkboxDiv.appendChild(checkboxInput);
               checkboxDiv.appendChild(checkboxLabel);
               
               container.appendChild(checkboxDiv);




               
               })


       
      }
      else
      {
        alert('Hata : ' + result.message );
      }					
    });




   });
 });









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



<script>
 function submitForm() {
     
     if (!document.getElementsByName('urun[]').length) {
          
         Swal.fire({
           title: "Sipariş Başarısız",
           text: "Sipariş kaydını oluşturumak için en az 1 adet ürün girmeniz gerekmektedir.",
           icon: "error",
           confirmButtonColor: "red", 
       confirmButtonText: "TAMAM"
         });
         return false;  
     }else{
       postChat('<?=aktif_kullanici()->kullanici_ad_soyad?> tarafından yeni sipariş kaydı oluşturulmuştur.');
       document.getElementById("subbutton").disabled = true;
       return true; 
     }
    
 }
</script>