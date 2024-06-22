 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper" style="background:#ffffff">
 <div class="row">
   <div class="col-md-6 pt-3 pl-3 pr-1">
   <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="text-success">
          Aktif Duyurular
        </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?=base_url("duyuru/tum-duyurular")?>">Anasayfa</a></li>
          <li class="breadcrumb-item">Duyurular</li>
          <li class="breadcrumb-item active">Aktif Duyurular</li>
        </ol>
      </div>
    </div>

    <?php
   
$simdiki_tarih = date('Y-m-d');

 
$gecmis_tarih_sayaci = count(array_filter($duyurular, function($duyuru) use ($simdiki_tarih) {
    return date("d.m.Y H:i:s",strtotime($duyuru->duyuru_bitis_tarihi)) >= date("d.m.Y H:i:s");
    
}));
 
    if($gecmis_tarih_sayaci == 0){
      ?>
     
 
     <div class="card card-widget card-dark  m-2">
          <div class="card-header">
            <div class="user-block">
              <i class="fas fa-eye"></i> Sisteme tanımlanmış aktif duyuru kaydı bulunamamıştır.
            </div> 
          </div> 
        </div>
 

      <?php
    }
    ?>

    <?php
      foreach ($duyurular as $duyuru) {
         
        if(date("d.m.Y H:i:s",strtotime($duyuru->duyuru_bitis_tarihi)) <= date("d.m.Y H:i:s")){
          continue;
        }
          ?>

        <div class="card card-widget card-success card-outline m-2">
          <div class="card-header">
            <div class="user-block">
              <img class="img-circle" src="<?=base_url("assets/dist/img/green-alert.png")?>" alt="User Image">
              <span class="username">
                <a href="#"><span style="color:black"><?=$duyuru->duyuru_adi?></span> - <span style="color:black; opacity:0.7; font-weight:medium"><i class="fa fa-folder text-orange" aria-hidden="true"></i> <?=$duyuru->duyuru_kategori_adi?></span></a>
               
              </span>
              <span class="description">
                <i class="far fa-calendar-alt" style="opacity:0.5"></i> Yayınlanma Tarihi : <?=date("d.m.Y H:i",strtotime($duyuru->duyuru_kayit_tarihi))?>
                <i class="far fa-calendar-alt" style="margin-left:10px;opacity:0.5"></i> Bitiş Tarihi :  <?=date("d.m.Y",strtotime($duyuru->duyuru_bitis_tarihi))?>
                <span class="text-success" style="margin-left:10px;"><i class="fa fa-check-circle" aria-hidden="true"></i> Aktif Duyuru</span>     
              </span> 
              
            </div>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div> 
          <div class="card-body p-0" style="background:#f9fffb">
          <blockquote class="quote-success m-1" style="    border-left: 0.3rem dotted #dff5e4;">
          <span class="description" style="font-size:12px;opacity:0.7">
                <i class="far fa-file-alt"></i> Duyuru Detayları
         
              </span> 


            <p><?=$duyuru->duyuru_aciklama?></p>  
          </blockquote>
          
          </div>  
        </div>

          <?php


      }
    ?>
     
 
   </div>




   <div class="col-md-6  pt-3 pr-3 pl-1">



   <div class="row mb-2">
      <div class="col-sm-6">
      <h1 class="text-warning">
          Geçmiş Duyurular
        </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?=base_url("duyuru/tum-duyurular")?>">Anasayfa</a></li>
          <li class="breadcrumb-item">Duyurular</li>
          <li class="breadcrumb-item active">Geçmiş Duyurular</li>
        </ol>
      </div>
    </div>


    <?php
   
   $simdiki_tarih = date('Y-m-d');
   
    
   $gecmis_tarih_sayaci = count(array_filter($duyurular, function($duyuru) use ($simdiki_tarih) {
       return date("d.m.Y H:i:s",strtotime($duyuru->duyuru_bitis_tarihi)) <= date("d.m.Y H:i:s");;
   }));
    
       if($gecmis_tarih_sayaci == 0){
         ?>
        
    
        <div class="card card-widget card-dark  m-2">
             <div class="card-header">
               <div class="user-block">
                 <i class="fas fa-eye"></i> Sisteme tanımlanmış geçmiş duyuru kaydı bulunamamıştır.
               </div> 
             </div> 
           </div>
    
   
         <?php
       }
       ?>


<?php
  foreach ($duyurular as $duyuru) {
    if(date("d.m.Y H:i:s",strtotime($duyuru->duyuru_bitis_tarihi)) >= date("d.m.Y H:i:s")){
      continue;
    }
      ?>

    <div class="card card-widget collapsed-card m-2">
      <div class="card-header">
        <div class="user-block">
          <img class="img-circle" src="<?=base_url("assets/dist/img/yellow-alert.png")?>" alt="User Image">
          <span class="username">
          <a href="#"><span style="color:black"><?=$duyuru->duyuru_adi?></span> - <span style="color:black; opacity:0.7; font-weight:medium"><i class="fa fa-folder text-orange" aria-hidden="true"></i> <?=$duyuru->duyuru_kategori_adi?></span></a>
                 </span>
          <span class="description">
            <i class="far fa-calendar-alt" style="opacity:0.5"></i> Yayınlanma Tarihi : <?=date("d.m.Y H:i",strtotime($duyuru->duyuru_kayit_tarihi))?>
            <i class="far fa-calendar-alt" style="margin-left:20px;opacity:0.5"></i> Bitiş Tarihi : <?=date("d.m.Y",strtotime($duyuru->duyuru_bitis_tarihi))?>
            <span class="text-danger" style="margin-left:10px;"><i class="fa fa-clock" aria-hidden="true"></i> Geçmiş Duyuru</span>
          </span>  
                 
        </div>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-plus"></i>
          </button>
        </div>
      </div>
      <div class="card-body p-1">
      <blockquote class="quote-success m-1" style="    border-left: 0.3rem dotted #ffc2c2;">
      <span class="description" style="font-size:12px;opacity:0.7">
                <i class="far fa-file-alt"></i> Duyuru Detayları
         
              </span> 

      <p><?=$duyuru->duyuru_aciklama?></p>
          </blockquote>
       
      </div>  
    </div>

      <?php


  }
?>
 

</div>



</div>

 </div>