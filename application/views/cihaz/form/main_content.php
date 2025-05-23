 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper" style="<?=$pageformat == "1" ? "margin-left:0px!important;zoom:0.9":""?>">
   <!-- Content Header (Page header) -->
   <!-- /.content-header -->
   <section class="content col  ">
     <div class="card card-dark" style=" ">
       <div class="card-header with-border" style="background:#061f3a">
         <h3 class="card-title text-center"> UG Business - Cihaz Bilgilerini Düzenle</h3>
      
     
       </div>
       <form class="form-horizontal" method="POST" action="<?php echo site_url('cihaz/save').'/'.$urun->siparis_urun_id;?>">
         <div class="card-body p-0">
           <div class="row" style="background:#053eab;height: 269px;">
             <div class="col-4 text-left" style="height: 269px;padding: 0;" style="width:150px">
               <span class="badge bg-dark text-md p-4" style="    height: -webkit-fill-available;width: inherit;flex:1;font-weight:500;border-radius:0px;background:#004ac1!important;border: 0px solid #00274f;">
                 <div style="height:30px"></div>
                 <i class="fa fa-user-circle" style="font-size: 55px;color:#ffffff"></i>
                 <br>
                 <br>

                 <?php 
                        $purl = base_url("musteri/profil/$merkez->musteri_id");
                        ?>
                       


                 <b>  <a style="cursor:pointer; color:white;text-decoration:underline;" href="#" onclick="showWindow('<?= $purl?>');"> <?=mb_strtoupper($merkez->musteri_ad)?> </a></b>
                 <br>
                 <span style="font-weight:300;margin-top:0px;padding:5px" class="d-block text-sm">
                 <i class="fa fa-user " style="margin-left:11px"></i> <?=$merkez->musteri_kod?>  
                 <i class="fa fa-mobile-alt " style="margin-left:11px"></i> <?=$merkez->musteri_iletisim_numarasi?> 
                   
                  
                  </span>

                   
             <br>


             <a href="<?=base_url("musteri/duzenle/").$merkez->musteri_id?>" type="button" class="btn  btn-dark" style="border:2px solid white;border-radius: 50px; padding: 8px;width: max-content!important;background: #061f3a;width: -webkit-fill-available;">
                 <i class="fas fa-pen"></i> Müşteri Düzenle </a>
             
                  </div>
             <div class="col-4 text-center" style="border-width: 12px;   border-color: #004ac1; "> 
       
                    
               <img src="
												<?=base_url("assets/dist/img/".$urun->urun_slug.".png")?>" style="    margin-top: 22px;" alt="" width="145">
                        <br>
                        <div class="container-fluid">
  <div class="row p-1">
    <div class="col" style="<?=($urun->urun_slug!="umex-diode")?"display:none;":""?>">
      <img src="<?=base_url("uploads/umex-diode.png")?>" style="<?=($urun->urun_slug!="umex-diode")?"display:none;":""?>height: 54px; object-fit: contain; width: auto; background:#081f39; padding: 12px; margin-top: -8px; padding-right: 37px; padding-left: 37px; border-radius: 60px; border-color: white; border: 2px solid #a5c5ff;     " class="img-fluid" alt="umex-diode">
    </div>
    <div class="col" style="<?=($urun->urun_slug!="umex-ems")?"display:none;":""?>">
      <img src="<?=base_url("uploads/umex-ems.png")?>" style="<?=($urun->urun_slug!="umex-ems")?"display:none;":""?>height: 54px; object-fit: contain; width: auto; background: #081f39; padding: 12px; margin-top: -8px; padding-right: 37px; padding-left: 37px; border-radius: 60px; border-color: white; border: 2px solid #a5c5ff;     " class="img-fluid" alt="umex-ems">
    </div>
    <div class="col" style="<?=($urun->urun_slug!="umex-gold")?"display:none;":""?>">
      <img src="<?=base_url("uploads/umex-gold.png")?>" style="<?=($urun->urun_slug!="umex-gold")?"display:none;":""?>height: 54px; object-fit: contain; width: auto; background: #081f39; padding: 12px; margin-top: -8px; padding-right: 37px; padding-left: 37px; border-radius: 60px; border-color: white; border: 2px solid #a5c5ff;    " class="img-fluid" alt="umex-gold">
    </div>
    <div class="col" style="<?=($urun->urun_slug!="umex-lazer")?"display:none;":""?>">
      <img src="<?=base_url("uploads/umex-lazer.png")?>" style="<?=($urun->urun_slug!="umex-lazer")?"display:none;":""?>height: 54px; object-fit: contain; width: auto; background: #081f39; padding: 12px; margin-top: -8px; padding-right: 37px; padding-left: 37px; border-radius: 60px; border-color: white; border: 2px solid #a5c5ff;     " class="img-fluid" alt="umex-lazer">
    </div>
    <div class="col" style="<?=($urun->urun_slug!="umex-plus")?"display:none;":""?>">
      <img src="<?=base_url("uploads/umex-plus.png")?>" style="<?=($urun->urun_slug!="umex-plus")?"display:none;":""?>height: 54px; object-fit: contain; width: auto; background: #081f39; padding: 12px; margin-top: -8px; padding-right: 37px; padding-left: 37px; border-radius: 60px; border-color: white; border: 2px solid #a5c5ff;      " class="img-fluid" alt="umex-plus">
    </div>
    <div class="col" style="<?=($urun->urun_slug!="umex-q")?"display:none;":""?>">
      <img src="<?=base_url("uploads/umex-q.png")?>" style="<?=($urun->urun_slug!="umex-q")?"display:none;":""?>height: 54px; object-fit: contain; width: auto; background: #081f39; padding: 12px; margin-top: -8px; padding-right: 37px; padding-left: 37px; border-radius: 60px; border-color: white; border: 2px solid #a5c5ff;    " class="img-fluid" alt="umex-q">
    </div>
    <div class="col" style="<?=($urun->urun_slug!="umex-s")?"display:none;":""?>">
      <img src="<?=base_url("uploads/umex-s.png")?>" style="<?=($urun->urun_slug!="umex-s")?"display:none;":""?>height: 54px; object-fit: contain; width: auto; background: #081f39; padding: 12px; margin-top: -8px; padding-right: 37px; padding-left: 37px; border-radius: 60px; border-color: white; border: 2px solid #a5c5ff;    " class="img-fluid" alt="umex-s">
    </div>
    <div class="col" style="<?=($urun->urun_slug!="umex-slim")?"display:none;":""?>">
      <img src="<?=base_url("uploads/umex-slim.png")?>" style="<?=($urun->urun_slug!="umex-slim")?"display:none;":""?>height: 54px; object-fit: contain; width: auto; background: #081f39; padding: 12px; margin-top: -8px; padding-right: 37px; padding-left: 37px; border-radius: 60px; border-color: white; border: 2px solid #a5c5ff;    " class="img-fluid" alt="umex-slim">
    </div>
  </div>
</div>
                        <br>

                        </div>
             <div class="col-4 text-left" style="padding: 0;">
               
             
             
             
             <span class="badge bg-warning text-md p-4" style=" height: 269px;display: block;font-weight:500;border-radius:0px;color:white!important;background:#004ac1!important;border: 0px solid #093d7d;">
                 <div style="height:30px"></div>
                 <i class="fa fa-building" style="font-size: 55px;color:#ffffff"></i>
                 <br>
                 <br>
                 <b> <?=mb_strtoupper($merkez->merkez_adi)?> </b>
                 <br>
                 <span style="font-weight:300;margin-top:0px;padding:5px" class="d-block text-sm">
                   <i class="far fa-map"></i> <?=$merkez->merkez_adresi?> <b><?=$merkez->ilce_adi?> / <?=$merkez->sehir_adi?> </b></span>

                   <br>
                    
<a type="button" href="<?=base_url("merkez/duzenle/").$merkez->merkez_id?>" class="btn  btn-dark" style="color:white!important;border:2px solid white;border-radius: 50px; padding: 8px;width: max-content!important;background: #061f3a;width: -webkit-fill-available;">
    <i class="fas fa-pen"></i> Merkez Düzenle </a>

    <br>        <br>
                 <br>
             
               </span>
             </div>
           </div>
           <h3 class="timeline-header bg-dark text-center d-none" style="background:#001429!important;margin-bottom: 0;">
           <div class="container-fluid">
  <div class="row p-3">
    <div class="col" style="<?=($urun->urun_slug!="umex-diode")?"display:none;":""?>">
      <img src="<?=base_url("uploads/umex-diode.png")?>" style="<?=($urun->urun_slug!="umex-diode")?"display:none;":""?>height:40px;object-fit: contain;width:auto" class="img-fluid" alt="umex-diode">
    </div>
    <div class="col" style="<?=($urun->urun_slug!="umex-ems")?"display:none;":""?>">
      <img src="<?=base_url("uploads/umex-ems.png")?>" style="<?=($urun->urun_slug!="umex-ems")?"display:none;":""?>height:40px;object-fit: contain;width:auto" class="img-fluid" alt="umex-ems">
    </div>
    <div class="col" style="<?=($urun->urun_slug!="umex-gold")?"display:none;":""?>">
      <img src="<?=base_url("uploads/umex-gold.png")?>" style="<?=($urun->urun_slug!="umex-gold")?"display:none;":""?>height:40px;object-fit: contain;width:auto" class="img-fluid" alt="umex-gold">
    </div>
    <div class="col" style="<?=($urun->urun_slug!="umex-lazer")?"display:none;":""?>">
      <img src="<?=base_url("uploads/umex-lazer.png")?>" style="<?=($urun->urun_slug!="umex-lazer")?"display:none;":""?>height:40px;object-fit: contain;width:auto" class="img-fluid" alt="umex-lazer">
    </div>
    <div class="col" style="<?=($urun->urun_slug!="umex-plus")?"display:none;":""?>">
      <img src="<?=base_url("uploads/umex-plus.png")?>" style="<?=($urun->urun_slug!="umex-plus")?"display:none;":""?>height:40px;object-fit: contain;width:auto" class="img-fluid" alt="umex-plus">
    </div>
    <div class="col" style="<?=($urun->urun_slug!="umex-q")?"display:none;":""?>">
      <img src="<?=base_url("uploads/umex-q.png")?>" style="<?=($urun->urun_slug!="umex-q")?"display:none;":""?>height:40px;object-fit: contain;width:auto" class="img-fluid" alt="umex-q">
    </div>
    <div class="col" style="<?=($urun->urun_slug!="umex-s")?"display:none;":""?>">
      <img src="<?=base_url("uploads/umex-s.png")?>" style="<?=($urun->urun_slug!="umex-s")?"display:none;":""?>height:40px;object-fit: contain;width:auto" class="img-fluid" alt="umex-s">
    </div>
    <div class="col" style="<?=($urun->urun_slug!="umex-slim")?"display:none;":""?>">
      <img src="<?=base_url("uploads/umex-slim.png")?>" style="<?=($urun->urun_slug!="umex-slim")?"display:none;":""?>height:40px;object-fit: contain;width:auto" class="img-fluid" alt="umex-slim">
    </div>
  </div>
</div>




           </h3>





<div class="card m-2" >
  

<div style="background: #5e69771f;
    border: 2px dashed #083a75;" class="p-2">
<div style="background: #ffffe2; padding: 10px; color: #ab6800; margin-top: 0px; margin-bottom: 5px; border: 2px solid #ffbc007d; border-radius: 5px;">
     <span><i class="fas fa-exclamation-circle" style="
    margin-right: 4px;
    color: #f5a100;
"></i>Cihazın garanti süresi değiştirildiğinde cihaza tanımlı olan diğer başlıkların da garanti süresi eşitlenir. Harici olarak satın alınan başlıkların garanti süresi manuel değiştirilmelidir.</span>
 </div>
<div class="timeline mb-0">
<?php 
if($urun->cihaz_borc_uyarisi == 1){
  ?>
  <a  onclick='showcihaz(<?=$urun->siparis_urun_id?>);' style="padding-top:3px;font-size: 12px!important;" class="btn btn-danger yanipsonenyazi btn-xs">Borç Uyarısı</a>
  <?php
}
?>
             <div style="margin-right:0px">
                 <i class="fas fa-envelope bg-blue"></i>
                 <div class="timeline-item">
                   <div class="timeline-body"style="    color: black;border-radius:5px;border:0px solid #164281">
                     <i class="fas fa-qrcode text-primary"></i> Seri Numarası 
                     <input type="text" required name="seri_numarasi" value="<?=$urun->seri_numarasi?>" class="form-control" placeholder="Ürün Seri Numarasını Giriniz">
                    <div class="row">
                    
                    <div class="col-md-6 pl-0">
                      <div class="mt-2">
                       <i class="fas fa-calendar-alt text-danger"></i> Garanti Başlangıç Tarihi 
                       
                       <div class="input-group">
                         <div class="input-group-prepend"></div>
                         <input type="date" required class="form-control" value="<?=date("Y-m-d",strtotime($urun->garanti_baslangic_tarihi))?>" name="garanti_baslangic_tarihi" data-inputmask-alias="datetime" data-inputmask-inputformat="dd.mm.yyyy" data-mask="" inputmode="numeric">
                      </div>
                      </div>   </div>
                
                      <div class="col-md-6 pr-0">
                        <div class="mt-2">
                        <i class="fas fa-calendar-alt text-danger"></i> Garanti Bitiş Tarihi 
                        <div class="input-group">
                          <div class="input-group-prepend"></div>
                          <input type="date" required class="form-control" value="<?=date("Y-m-d",strtotime($urun->garanti_bitis_tarihi))?>" name="garanti_bitis_tarihi" data-inputmask-alias="datetime" data-inputmask-inputformat="dd.mm.yyyy" data-mask="" inputmode="numeric">
                        </div>
                      </div>
                      </div>

                    <div class="col-md-12 mt-3 mb-3"></div>
                      <div class="col-md-3 pr-0 pl-0 pr-2">
                        <div class="mt-2">
                        <span class="text-danger"> Takas Cihazı Mı ?</span> 
                        <div class="input-group">
                          <div class="input-group-prepend"></div>
                          <select name="c_takas_cihaz_mi" class="select2 form-control">
                    <option value="1" <?=$urun->takas_cihaz_mi == 1 ? "selected" : "" ?>> EVET</option>
                    <option value="0" <?=$urun->takas_cihaz_mi == 0 ? "selected" : "" ?>> HAYIR</option>
                  </select>  
                 </div>
                      </div>
                      </div>

                      <div class="col-md-9 pr-0">
                        <div class="mt-2">
                        <span class="text-danger"> Takas Alınan Merkez </span> 
                    
                        <div class="input-group">
                          <div class="input-group-prepend"></div>
                          <select name="takas_alinan_merkez_id" id="takas_alinan_merkez_id" class="select2 form-control">
                          <option value="0">Takas Alınan Merkez Seçilmedi</option>
                  
                    <?php foreach($mymusteriler as $mymusteri) : ?> 
                      <?php
                      $selected_control = ""; 
                        if($urun->takas_alinan_merkez_id == 0){
                          if($mymusteri->merkez_id == $merkez->merkez_id){
                            $selected_control = "selected";
                          }
                        }
                        
                        ?>
                      <option  value="<?=$mymusteri->merkez_id?>" <?=$selected_control?> <?= $mymusteri->merkez_id == $urun->takas_alinan_merkez_id ? 'selected' : '' ?>><?=$mymusteri->musteri_ad?>(<?=$mymusteri->merkez_adi?>) <?=$mymusteri->ilce_adi?> / <?=$mymusteri->sehir_adi?> / <?=$mymusteri->musteri_iletisim_numarasi?></option>
                  
                      <?php endforeach; ?> 
                  </select>  </div>
                      </div>
                      </div>


                      </div>
                    </div>
                   </div>
                 </div>
               </div>


               <div class="card card-dark">
              <div class="card-header bg-dark p-2" style="background-color: #000000!important;">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#merkezler" data-toggle="tab"><i class="fa fa-building"></i> Başlık Bilgileri</a></li>
                  <li class="nav-item d-none"><a class="nav-link" href="#teslimatlar" data-toggle="tab"><i class="fas fa-truck-loading text-warning"></i> Teslimatlar</a></li>
                  <li class="nav-item"><a class="nav-link" href="#egitimler" data-toggle="tab"><i class="far fa-folder-open text-green "></i> Eğitimler (<?=count($egitimler)?>)</a></li>
                  <li class="nav-item"><a class="nav-link" href="#atis_yuklemeleri" data-toggle="tab"><i class="far fa-share-square text-orange"></i> Atış Yüklemeleri (<?=count($atis_yuklemeleri)?>)</a></li>
                 
                 
                  <li class="nav-item"><a class="nav-link" href="#servisler" data-toggle="tab"><i class="fas fa-retweet text-danger"></i> Servis Kayıtları (<?=count($servisler)?>)</a></li>
               
               <?php 
               if(goruntuleme_kontrol("tum_siparisleri_goruntule")){
                 ?>
                 
                 <li class="nav-item"><a class="nav-link" href="#siparis" data-toggle="tab"><i class="fas fa-retweet text-orange"></i> Sipariş Detayları</a></li>
                 <?php
               }
               ?>
              
               
                </ul>
              </div><!-- /.card-header -->




              <div class="card-body p-3 pr-0" style="padding-right:3px !important;    border: 1px solid black;">
                <div class="tab-content" style="    padding-right: 10px;">
                  <div class="active tab-pane" id="merkezler">
  
          <!--***************-->

      

            
<?php

if(count($basliklar)<=0){
  ?>
  
  <div style="background: #fff4f4;padding: 10px;color: #d10000;margin-top: 0px;margin-bottom: 5px;border: 2px solid #ff00007d;border-radius: 5px;">
     <span><i class="fas fa-exclamation-circle" style="
    margin-right: 4px;
    color: #f50000;
"></i>Cihaza tanımlanmış herhangi bir başlık bilgisi bulunamamıştır. Yeni başlık tanımlamak için aşağıdaki listeden seçim yapabilirsiniz.</span>
 </div>
  
  <?php
}

?>



<?php foreach ($basliklar as $baslik) : ?>


<div class="info-box" style="background:<?=($baslik->dahili_baslik)?'#ffffff':'#ffffff'?>;border:1px solid #164281;padding-right: 0px;margin-bottom: 5px;">
<span class="info-box-icon" style="border: 1px solid #1b447e;background: <?=($baslik->dahili_baslik)?'#f9f9f9':'#f9f9f9'?>;
    width: 100px;">

<img src="<?=base_url("uploads/$baslik->baslik_resim")?>" height="70" alt="">


</span>
<div class="info-box-content">

<span style=" background:<?=($baslik->dahili_baslik)?'#00347314':'#00347314'?>;color:<?=($baslik->dahili_baslik)?'#164380':'#164380'?>;padding-left:5px;    border-radius: 5px 5px 0 0;
    font-weight: 600;"><?=$baslik->baslik_adi?><span style="font-weight:300"> / <?=($baslik->dahili_baslik) ? 'Cihaza Tanımlı Başlık' : '<span style="padding: 0px 10px; font-size: 12px !important; font-weight: 700; color: black;" class="btn btn-warning">Ekstra Başlık (Harici Olarak Satın Alınan)</span>'?></span></span>

<span class="info-box-number" style="margin-top: 0px;    border-radius: 0 0 5px 5px;background: <?=($baslik->dahili_baslik)?'#ffffff':'#ffffff'?>;padding: 5px;margin-bottom: 5px;">
    
    Başlık Seri No :<span style="font-weight:normal;margin-right:10px"> <?=$baslik->baslik_seri_no ?? "Seri No Girilmedi"?></span> 
  
    Kayıt Tarihi :<span style="font-weight:normal;margin-right:10px"> <?=date("d.m.Y H:i:s",strtotime($baslik->baslik_tanim_kayit_tarihi))?></span> 

    Garanti Başlangıç Tarihi :<span style="font-weight:normal;margin-right:10px"> <?=date("d.m.Y",strtotime($baslik->baslik_garanti_baslangic_tarihi))?></span>
    
    Garanti Bitiş Tarihi :<span style="font-weight:normal"> <?=date("d.m.Y",strtotime($baslik->baslik_garanti_bitis_tarihi))?></span>

  </span>
 
<div class="timeline-footer row" style="display: block;">
                            <a href="<?=base_url("baslik/duzenle/".$baslik->urun_baslik_tanim_id)?>" class="btn col btn-warning btn-sm text-dark mr-1"     style="background: #ffffff; border: 1px solid #00b124; color: #019720 !important;width:210px"><i class="fas fa-edit"></i> Başlık Bilgilerini Düzenle</a>
                          
                            <a href="#" class="btn col btn-danger btn-sm"                     style="background: #ffffff; border: 1px solid #d83049; color: #b50404;width:100px" onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu başlığı silmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Onayla','<?=base_url('baslik/sil/').$baslik->urun_baslik_tanim_id?>');" ><i class="fa fa-times"></i> Başlık Sil</a>
                          
                            <a href="<?=base_url("baslik/print/".$baslik->urun_baslik_tanim_id)?>" target="_blank" class="btn col btn-warning btn-sm text-dark ml-1"     style="background: #ffffff; border: 1px solid #0055ad; color: #0055c1 !important;width:100px"><i class="fas fa-qrcode"></i> QR Yazdır</a>
                           <a onclick="confirm_action('İşleme Almayı Onayla','Seçilen bu başlığı işleme almak istediğinize emin misiniz ?','Onayla','<?=base_url('baslik/baslik_isleme_al/').$baslik->urun_baslik_tanim_id?>');"
                           class="btn col btn-danger btn-sm text-dark ml-1"     style="background: #ffffff; border: 1px solid orange; color: orange !important;width:100px"><i class="fas fa-pen"></i> İşleme Al</a>
                          
                          </div>
</div>
 
         
</div>






<?php endforeach; ?>





<div class="row pb-1 mt-2">
  <div class="col">
    <h3 class="card-title p-0" style="font-weight: bolder;margin-bottom: 10px;">
      <i class="fas fa-plus-circle" style="color: green;margin-left: 2px;"></i>
      Yeni Başlık Tanımla
    </h3>
  </div>
  <br>
  <div class="col text-right" style="display: contents;">
    <span style="font-weight:normal;opacity: 0.8; color:#003269;   font-size: 14px;">
      <i class="fas fa-exclamation-circle" style="color: #003269;"></i>
      <?php 
        $f = $urun->urun_id;
        $filter_basliklar = array_filter($basliklar_data, function($baslik) use ($f) {
          return $baslik->urun_no == $f;
        });
      ?>
      Cihaza tanımlanan <?=count($filter_basliklar)?> adet başlık seçeneği listelenmiştir. Tanımlamak istediğiniz başlığı seçiniz</span>
  </div>
</div>
<div class="row d-flex" style="gap: 5px;justify-content: center;">
  <?php foreach($filter_basliklar as $baslik) : ?> 
    <button type="button" class="btn " onclick="showquestion('<?=$baslik->baslik_adi?>','<?=base_url('baslik/baslik_tanimla/').$urun->siparis_urun_id.'/'.$baslik->baslik_id?>')" style="flex: 1; color: #081f39; background-color: #ffffff; border-color: #c2d9ff;  /* border-width: medium; */ box-shadow: none; background-position: left; background-size: 50px; background-color: #ffffff; background-repeat: no-repeat;">             
      <img src="<?=base_url("uploads/$baslik->baslik_resim")?>" height="30" alt="">
      <br>
      <i class="fas fa-plus-circle text-primary"></i> 
      <b>Yeni Başlık Ekle</b><br> <?=$baslik->baslik_adi?>
    </button>
  <?php endforeach; ?>
</div>
   <!--***************-->

   </div>           
   <?php 
               if(goruntuleme_kontrol("tum_siparisleri_goruntule")){
                 ?>
                 
               
<div class="tab-pane" id="siparis">

<iframe style="width:100%;height:750px" src="<?=site_url('siparis/report/'.urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$urun->siparis_kodu."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE")))?>" frameborder="0"></iframe>


  </div>

              <?php
               }
               ?>






 
  <div class="tab-pane" id="egitimler">
  
  

  <table id="exampleeg" class="table table-striped table-bordered nowrap text-sm" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-weight:500;height: 100%; width: 100%;">
                  <thead>
                  <tr>

                    <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">İşlem</th> 

                    <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Müşteri - Merkez Adı</th>
                    <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Ürün</th>
                    
                    <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Kayıt Bilgileri</th> 
                    <?php if($filtre == "uretim_sertifika"){?>
                      <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">İşleme Al</th> 
                    <?php }?>
                    
                    <?php if($filtre == "onay_sertifika"){?>
                    <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Onay</th>
                    <?php }?>
                    <?php if($filtre == "uretim_sertifika"){?>
                      <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Sertifika Üretim</th>
                    <?php }?>
                    <?php if($filtre == "uretim_kalem"){?>
                      <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Kalem Üretim</th>
                    <?php }?>
                    <?php if($filtre == "kargo"){?>
                      <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Kargo</th>
                     <?php }?>
                    
                    
                     <?php if($filtre == "tum"){?>
                      <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Onay</th>
                      <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Sertifika Üretim</th>
                      <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Kalem Üretim</th>
                      <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Kargo</th>
                  
                      
                    
                      <?php }?>

                   
                  </tr>
                  </thead>
                  <tbody>



                    <?php $count=0; foreach ($egitimler as $egitim) : ?>
                      <?php $count++?>
                    <tr>
                    
                      <td style="padding:2px !important;">
                      <?php 
                       if($egitim->sertifika_onay_durumu == 1){
                        ?>

                          <button disabled style="padding: 9px 10px 9px 10px;width:67%;" type="button" class="btn btn-dark btn-flat btn-xs"><i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> Düzenle</button>
                        
                          <?php 
                      }else{
                        ?>
                          <a href="<?=site_url("egitim/duzenle/$egitim->egitim_id")?>"  style="padding: 9px 10px 9px 10px;width:67%;" type="button" class="btn btn-dark btn-flat btn-xs"><i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> Düzenle</a>
                        
                        
                        
                        <?php
                      }
                        ?>

                        
                        
                        
                          <a href="<?=site_url("egitim/delete/$egitim->egitim_id")?>"  style="padding: 9px 10px 9px 10px;width:30%;" type="button" class="btn btn-danger btn-flat btn-xs"><i class="fa fa-times" style="font-size:12px" aria-hidden="true"></i> Sil</a>
                     
                        </td>
                      <td><i class="fa fa-user-circle" style="margin-right:1px;opacity:1"></i> 
                       <?=sonKelimeBuyuk($egitim->musteri_ad)?> / 
                       <?php 
                        echo Transliterator::create('tr-title')->transliterate($egitim->merkez_adi);
 

                       ?><br>
                    <span style="font-weight:normal">
                      <?=$egitim->merkez_adresi?>  <?=$egitim->ilce_adi?> / <?=$egitim->sehir_adi?>
                    </span>

                   <br>
                       <span style="opacity:0.5;font-weight:normal">
                      
                      <?php
                      
                      $kursiyerler = json_decode($egitim->kursiyerler);
$count = 0;
$totalKursiyerler = count($kursiyerler);

foreach ($kursiyerler as $key => $kursiyer) {
    echo $kursiyer;
    $count++;

   
    if ($count % 3 == 0 && $key != $totalKursiyerler - 1) {
        echo "<br>";
    } elseif ($key != $totalKursiyerler - 1) {
        echo ", ";
    }
}
                      
                      
                      ?>
                      </span>
                      
                       <td><i class="fas fa-layer-group" style="margin-right:1px;opacity:1"></i> 
                       <?=$egitim->urun_adi?> <br><span style="opacity:0.5;font-weight:normal"><?=$egitim->seri_numarasi?> </span>
                    </td>
                    <td><i class="fa fa-calendar-alt" style="margin-right:1px;opacity:1"></i> 
                       <?=date("d.m.Y H:i",strtotime($egitim->egitim_tarihi))?><br>
                       <span style="opacity:0.5;font-weight:normal"><?=$egitim->kullanici_ad_soyad?></span>
                      
                        
                    </td>
                    
                       
                    </tr>
                  <?php  endforeach; ?>

               
                  </tbody>
                  <tfoot>
          
                  </tfoot>
                </table>



  </div>

  



  <div class="tab-pane" id="atis_yuklemeleri">
                     

                  <table id="example1" class="table table-striped table-bordered nowrap text-sm" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-weight:500;height: 100%; width: 100%;">
                  <thead>
                  <tr>
<th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Atış Kodu</th>
                  
                  <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Atış Kategorisi</th>
                  <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Atış Yükleme Sayısı</th>
                   
                    <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Atış Yükleme Tarihi</th>
                    
                  

                   
                  </tr>
                  </thead>
                  <tbody>



                    <?php foreach ($atis_yuklemeleri as $atis_yukleme) : ?>
                     
                    <tr>
                      
                    <td><i class="fa fa-calendar-alt" style="margin-right:1px;opacity:1"></i> 
                       <span style="opacity:0.5"><?=$atis_yukleme->servis_atis_kod?></span>
                        
                    </td> 
                    
                    <td><i class="fa fa-calendar-alt" style="margin-right:1px;opacity:1"></i> 
                       <?=$atis_yukleme->servis_atis_kategori_adi?>
                        
                    </td>
                    <td>
                       <?=$atis_yukleme->atis_yukleme_sayisi?>
                        
                    </td>
                    <td><i class="fa fa-calendar-alt" style="margin-right:1px;opacity:1"></i> 
                       <?=date("d.m.Y",strtotime($atis_yukleme->servis_atis_yukleme_tarihi))?><br>
                      
                        
                    </td>
                    
                       
                    </tr>
                  <?php  endforeach; ?>

               
                  </tbody>
                  <tfoot>
          
                  </tfoot>
                </table>


                  </div>

                   





                  <div class="tab-pane" id="servisler">
                  

                  <table id="example1" class="table text-xs table-bordered table-striped nowrap">
                  <thead>
                  <tr>
                    <th>Servis Durumu</th>
                    <th style="width: 42px;">Servis Kodu</th>
                    <th>Servis Kayıt Tarihi</th>
                    <th>Müşteri Bilgileri</th>
                    <th>Cihaz</th>
                    <th>İletişim Numarası</th>
                    <th>Cihaz Seri Numarası</th>
                    <th style="width: 210px;">İşlem</th> 
                  </tr>
                  </thead>
                  <tbody>
                 
                    <?php  foreach ($servisler as $servis) : ?>
                  


                      <?php 
                          if(!empty($_GET["page"])){
                            if($_GET["page"] != $servis->servis_durum_tanim_id){
                              continue;
                            }
                          }
                        ?>
                    <tr style="<?=($servis->servis_durum_tanim_id == 3) ? "background:#ff00001c;":""?>">
                    <td> 
                      <?php 
                      if($servis->servis_durum_tanim_id == 1){
                        ?>
                        <div class="bg-warning color-palette yanipsonenyazi" style="height: 25px; align-items: center; display: grid; margin-left: 2px; margin-right: 2px; text-align: -webkit-center; font-weight: 400; color: #000000 !important; background-color: #fcc035 !important;">
                          <span><i class="fas fa-tools"></i> <?=$servis->servis_durum_kategori_adi?></span>
                        </div>
                        <?php
                      }else if(($servis->servis_durum_tanim_id == 2)){
                        ?>
                        <div class="bg-success color-palette" style="height: 25px; align-items: center; display: grid; margin-left: 2px; margin-right: 2px; text-align: -webkit-center; font-weight: 400;">
                          <span><i class="fas fa-check-circle text-white"></i> <?=$servis->servis_durum_kategori_adi?></span>
                        </div>
                        <?php
                      }else{
                        ?>
                        <div class="bg-danger color-palette" style="height: 25px; align-items: center; display: grid; margin-left: 2px; margin-right: 2px; text-align: -webkit-center; font-weight: 400;">
                          <span><i class="fas fa-ban text-white"></i> <?=$servis->servis_durum_kategori_adi?></span>
                        </div>
                        <?php
                      }
                      ?>
                    
                    </td>
                      <td><?=$servis->servis_kod?></td>
                     
                      <td><?=date("d.m.Y H:i",strtotime($servis->servis_kayit_tarihi))?></td>
                      <td><?="<b>".$servis->merkez_adi."</b> / ".$servis->sehir_adi?></td>
                      <td><?=$servis->urun_adi?></td>
                      <td><b><?=formatTelephoneNumber($servis->musteri_iletisim_numarasi)?></b></td>
                      <td><?=$servis->seri_numarasi?></td>
                      <td>
                    
                      <?php 
                      if(($servis->servis_durum_tanim_id == 3)){
                        ?>
                        <span class="text-danger">İptal Edildi (<?=date("d.m.Y H:i",strtotime($servis->servis_durum_guncelleme_tarihi))?>)</span>
                        <?php
                      }else{
                        ?>
                        <a onclick="showdetail(<?=$servis->servis_id?>);" type="button" class="btn btn-dark btn-xs"><i class="fas fa-eye" style="font-size:12px" aria-hidden="true"></i> Görüntüle</a>
                        <a type="button" onclick="confirm_action('İptal İşlemini Onayla','Seçilen bu kaydı iptal etmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Onayla','<?=base_url('servis/servis_iptal_et/'.$servis->servis_id)?>');" class="btn btn-danger btn-xs" ><i class="fas fa-times-circle"></i> İptal Et</a>                 
                        <?php
                      }
                      ?>

                         
                        </td>
                       
                    </tr>
                  <?php  endforeach; ?>
                  </tbody>
                 
                </table>


                  </div>







                    
                  </div>
                  <!-- /.tab-pane -->

                  </div>
                  </div>







</div>


             </div>



        





<br>

             










         </div>
</div>


           
         </div>
         <!-- /.card-body -->
         <div class="card-footer" style="padding: 7px;">
           <div class="row p-0">
             <div class="col text-center" style="padding-right: 0;">
               <button type="submit" style="width: -webkit-fill-available;" class="btn  btn-success">
                 <i class="fas fa-save"></i>
                 Değişiklikleri Kaydet
                </button>
              
             </div>


             <?php 
             if($urun->urun_iade_durum == 0){
              ?>
                 <div class="col text-center" style="padding-left:5px;">
               
                  <a href="<?=base_url("cihaz/urun_iade/".$urun->siparis_urun_id)?>" style="width: -webkit-fill-available;" class="btn  btn-warning">
                    <i class="fas fa-times-circle"></i> Ürünü İade Olarak İşaretle
                  </a>
                </div>

              <?php
             }else{
              ?>
               <div class="col text-center" style="padding-left:5px;">
               
               <a href="<?=base_url("cihaz/urun_iade_sifirla/".$urun->siparis_urun_id)?>" style="width: -webkit-fill-available;" class="btn  btn-default">
                <i class="fas fa-times-circle"></i> Ürün İade Durumunu Sıfırla
               </a>
             </div>
              <?php
             }
             ?>
            

             


             <div class="col text-center" style="padding-left:5px;">
               
               <a href="<?=base_url("cihaz")?>" style="width: -webkit-fill-available;" class="btn  btn-danger">
                <i class="fas fa-times-circle"></i> İptal Et / Geri Dön
               </a>
             </div>


           </div>
         </div>
         <!-- /.card-footer-->
       </form>
     </div>
     <!-- /.card -->
       

   </section>

  
 </div>



      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 

      <script>

function showWindow($url) {
        
        var width = 1350;
      var height = 820;

    
      var left = (screen.width / 2) - (width / 2);
      var top = (screen.height / 2) - (height / 2);
      var newWindow = window.open($url, 'Yeni Pencere', 'width=' + width + ',height=' + height + ',top=' + top + ',left=' + left);

      
  };
        
      function showquestion(baslik_adi,url){
        const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
            confirmButton: "btn btn-success ml-2",
            cancelButton: "btn btn-danger"
          },
          buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
          title: "Sistem Uyarısı",
          text: baslik_adi+" adlı başlık tanımlaması yapmak istediğinize emin misiniz?",
          icon: "question",
          showCancelButton: true,
          confirmButtonText: "Evet, başlık kaydet!",
          cancelButtonText: "Hayır, iptal!",
          reverseButtons: true
        }).then((result) => {
        if (result.isConfirmed) {
          
          Swal.fire({
                title: "Lütfen Bekleyiniz!",
                html: "Başlık Kaydı Oluşturuluyor...",
                timer: 5500,
                timerProgressBar: true,
                showCancelButton: false,
                allowOutsideClick: false,
                showConfirmButton: false
              });

              const endPoint = url;
              fetch(endPoint)
                .then(data => {
                  location.reload();
                })
                .then(res => {
                  console.log(res)
                });
        } 
      });
      }


      
      
        </script>