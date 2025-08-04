
<style>
  .bg-dark {
    background-color: #2b2929!important;
}
  </style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper mt-1" style="">
 

    <!-- Main content -->
    <section class="content" style="margin:-6px;margin-right:-8px;margin-left:-8px;">
      <div class="container-fluid pl-0 pr-0">
        <div class="row">
 
        <style>
          .profile-head {
    transform: translateY(1rem)
}

.cover {
    background-image:linear-gradient(
          rgba(0, 0, 0, 0.8), 
          rgba(0, 0, 0, 0.8)
        ),
        /* bottom, image */ url(<?=base_url("assets/dist/profile-banner.jpeg")?>);
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    height: 187px;
}

body {
    min-height: 100vh;
    overflow-x:hidden;
}
          </style>
        <div class="col-12 pl-0 pr-0">
          <div class="row py-0 px-0"> 
            <div class="col-md-12 mx-auto pl-0 pr-0" > 
              <!-- Profile widget -->
              <div class="bg-white shadow rounded overflow-hidden" style="height:120px">
                <div class="px-4 pt-0 pb-4 cover">
                  <div class="media align-items-end profile-head">
                    <div class="profile mr-3">
                      <?php 
                      
                      if($musteri->musteri_doktor_mu == 1){
                        ?>
                        <img src="<?=base_url("assets/dist/img/doctor-user.png")?>" alt="..." width="85" class="rounded mb-2 img-thumbnail">
                                        
                        <?php
                      }else{
                        if($musteri->musteri_cinsiyet == "E"){
                          ?>
                          <img src="https://static.vecteezy.com/system/resources/previews/036/594/084/original/flat-illustration-in-grayscale-avatar-user-profile-person-icon-profile-picture-suitable-for-social-media-profiles-icons-screensavers-and-as-a-template-free-vector.jpg" alt="..." width="85" class="rounded mb-2 img-thumbnail">
                                          
                          <?php
                      }else if($musteri->musteri_cinsiyet == "K"){
                        ?>
                            <img src="https://static.vecteezy.com/system/resources/previews/045/944/216/non_2x/person-gray-photo-placeholder-female-head-silhouette-for-social-media-profile-icon-user-screensaver-and-as-template-greyscale-free-vector.jpg" alt="..." width="85" class="rounded mb-2 img-thumbnail">
                                         
                        <?php
                      }else{
                        ?>
                           <img src="https://static.vecteezy.com/system/resources/previews/036/594/084/original/flat-illustration-in-grayscale-avatar-user-profile-person-icon-profile-picture-suitable-for-social-media-profiles-icons-screensavers-and-as-a-template-free-vector.jpg" alt="..." width="85" class="rounded mb-2 img-thumbnail">
                                       
                        <?php
                      }
                      }
                     
                      
                      ?>
                      
                    </div>
                    <div class="media-body text-white">
                      <h4 class="mt-0 mb-0" style="font-size: 30px;"><?=$musteri->musteri_ad?></h4>
                      <p class="small mb-4 <?=($musteri->rg_medikal	== 1)?"pl-2 pr-2 bg-success":""?>" style="font-size: 15px;width: max-content;">
                  
                        <?=($musteri->musteri_doktor_mu == 1) ? "DOKTOR" : (($musteri->rg_medikal	== 1) ? "RG MEDİKAL MÜŞTERİSİ" : "UMEX BİREYSEL MÜŞTERİ")?>
                      </p>
                    </div>
                  </div>
                </div>
              
                 </div> </div>
</div>
        </div>
 
 
        <div class="col-md-2" style="padding: 0;">

         
            <!-- /.card -->

            <!-- About Me Box -->
          
            <!-- /.card -->

            <div class="row">
    <div class="col p-0">
<a href="https://ugbusiness.com.tr/cihaz/tum-cihazlar" class="btn btn-primary mt-1 ml-1" style="border: 1px solid;
 
    width: -webkit-fill-available;
    "><i class="fas fa-arrow-circle-left"></i> Müşteriler</a>
    </div>
    <div class="col p-0">
        <a onclick="showWindow('https://ugbusiness.com.tr/musteri/duzenle/<?=$musteri->musteri_id?>');" class="btn btn-warning mt-1 ml-1" style=" 
    /* margin-right: 29px; */
    width: -webkit-fill-available;
    margin-right: 7px;"><i class="fas fa-pen"></i> Düzenle</a>
    </div>
</div>

            <div class="card card-dark mb-2 m-1 mr-2">
              <div class="card-header">
                <h3 class="card-title">İletişim Bilgileri</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="        padding-bottom: 0 !important;">
                <strong><i class="fas fa-phone mr-1"></i> İletişim Numarası (*CEP)</strong>

                <p class="text-muted" style="margin-left: 21px;">
                  <?=formatTelephoneNumber($musteri->musteri_iletisim_numarasi)?>
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Sabit Telefon</strong>

                <p class="text-muted" style="margin-left: 19px;margin-bottom: 8px;"><?=($musteri->musteri_sabit_numara == "" || $musteri->musteri_sabit_numara == null) ? "<span style='opacity:0.5'>Sabit iletişim numarası girilmedi</span>" : $musteri->musteri_sabit_numara?></p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Email Adresi</strong>
                
                <p class="text-muted" style="margin-left: 19px;margin-bottom: 8px;"><?=($musteri->musteri_email_adresi == "" || $musteri->musteri_email_adresi == null) ? "<span style='opacity:0.5'>Email adresi girilmedi</span>" : $musteri->musteri_email_adresi?></p>


              </div>
              <!-- /.card-body -->
            </div>




 <!---whatsap--->

            <div class="card card-dark mb-2 m-1 mr-2 <?=($musteri->instagram_url == "" && $musteri->facebook_url == "") ? "d-none":""?>">
              <div class="card-header  ">
                <h3 class="card-title" style="font-size:15px">SOSYAL MEDYA HESAPLARI</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                
              <div class="small-box bg-danger mb-1 <?=($musteri->instagram_url == "")? "d-none":""?>" style="background: radial-gradient(circle at 50% 157%, #fdf497 0%, #fdf497 1.002%, #fd5949 45%, #d6249f 60%, #285AEB 90%);">
              <div class="inner p-0 pl-3 pr-3 pt-2">
              <h3><?=($musteri->instagram_takipci_sayisi != "") ? $musteri->instagram_takipci_sayisi : "0"?></h3>
              <p style="margin-top:-10px">Takipçi Sayısı</p>
              </div>
              <div class="icon">
              <i>
              <img style="margin-top:-95px;width:50px" src="<?=base_url("assets/dist/img/icon_instagram.png")?>">
              </i>
              </div>
              <a href="<?=$musteri->instagram_url?>" target="_blank" class="small-box-footer">
              Instagram Profilini Görüntüle <i class="fas fa-arrow-circle-right"></i>
              </a>
              </div>


              <div class="small-box bg-danger mb-0 <?=($musteri->facebook_url == "") ? "d-none":""?>" style="background: radial-gradient(circle at 50% 157%, #fdf497 0%, #285AEB 60%, #285AEB 90%);">
              <div class="inner p-0 pl-3 pr-3 pt-2">
              <h3><?=($musteri->facebook_takipci_sayisi != "") ? $musteri->facebook_takipci_sayisi : "0"?></h3>
              <p style="margin-top:-10px">Takipçi Sayısı</p>
              </div>
              <div class="icon">
              <i>
              <img style="margin-top:-95px;width:50px" src="<?=base_url("assets/dist/img/icon_facebook.png")?>">
              </i>
              </div>
              <a href="<?=$musteri->facebook_url?>" target="_blank" class="small-box-footer">
              Facebook Profilini Görüntüle <i class="fas fa-arrow-circle-right"></i>
              </a>
              </div>

              </div>
              <!-- /.card-body -->
            </div>


            <!---whatsap--->


            <!---whatsap--->

            <div class="card card-dark mb-2 m-1 mr-2 d-none">
              <div class="card-header  ">
                <h3 class="card-title" style="font-size:15px">WHATSAPP MESAJ GÖNDER</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
                <strong>Mesaj Giriniz :</strong>

                <p class="text-muted">
                  <textarea class="form-control" rows="1"></textarea>
                </p>
                <a href="" style="width: 100%;margin-top: -11px;" class="btn btn-success"><i class="fas fa-arrow-circle-right"></i> GÖNDER</a>
                
             

              </div>
              <!-- /.card-body -->
            </div>


            <!---whatsap--->




               <!---whatsap--->

               <div class="card card-dark mb-2 m-1 mr-2 d-none">
              <div class="card-header  ">
                <h3 class="card-title" style="font-size:15px">SMS GÖNDER</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <strong>Mesaj Başlığı Seçiniz :</strong>

              <select name="talep_kaynak_no" required="" class="select2 form-control rounded-2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                <option selected="selected" data-icon="fa fa-globe" value="1">
                  UMEX LAZER
                </option>
                <option selected="selected" data-icon="fa fa-globe" value="2">
                  UGTEKNOLOJI
                </option>
            
                  </select>


                <strong style="    margin-top: 9px !important;
    display: block;">Mesaj Giriniz :</strong>

                <p class="text-muted">
                  <textarea class="form-control" rows="2"></textarea>
                </p>
 
                <a href="" style="width: 100%;margin-top: -11px;" class="btn btn-success"><i class="fas fa-arrow-circle-right"></i> GÖNDER</a>

              </div>
              <!-- /.card-body -->
            </div>


            <!---whatsap--->

          </div>
          <!-- /.col -->
          <div class="col-md-10 mt-1 pr-0 pl-0" style="    margin-top: -51px !important;">


 





            <div class="card card-dark" style="box-shadow:none;background:transparent!important;">
              <div class="card-header bg-dark p-2" style="background-color: transparent !important;">
                <ul class="nav nav-pills" style="float: right;">
                  <li class="nav-item"><a class="nav-link active" href="#merkezler" data-toggle="tab"><i class="fa fa-building"></i> MERKEZ BİLGİLERİ (<?=count($merkezler)?>)</a></li>
                  <li class="nav-item d-none"><a class="nav-link" href="#teslimatlar" data-toggle="tab"><i class="fas fa-truck-loading text-warning"></i> Teslimatlar (<?=count($urunler)?>)</a></li>
                  <li class="nav-item"><a class="nav-link" href="#egitimler" data-toggle="tab"><i class="far fa-folder-open text-green "></i> EĞİTİMLER (<?=count($egitimler)?>)</a></li>
                  <li class="nav-item"><a class="nav-link" href="#atis_yuklemeleri" data-toggle="tab"><i class="far fa-share-square text-orange"></i> ATIŞ YÜKLEMELERİ (<?=count($atis_yuklemeleri)?>)</a></li>
                  <li class="nav-item"><a class="nav-link" href="#servisler" data-toggle="tab"><i class="fas fa-retweet text-danger"></i> SERVİS KAYITLARI (<?=count($servisler)?>)</a></li> 
                  <li class="nav-item" onclick="window.open(`https://wa.me/9<?=$musteri->musteri_iletisim_numarasi?>`, '_blank');"><a class="nav-link" target="_blank" href="" data-toggle="tab"><i class="fab fa-whatsapp text-success"></i> WHATSAPP MESAJ GÖNDER</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body p-3 pr-0" style="    border: 1px solid gray;margin: 5px;
    border-radius: 3px;background:white;padding-right:0px !important; margin-left:0px !important;">
                <div class="tab-content">
                  <div class="active tab-pane" id="merkezler">

                  <div class="row mb-2">
                      <div class="col-sm-10 pl-0 p-0">
                        <h5>
                          <i class="fa fa-building"></i>
                          Merkez / İşyeri Bilgileri
                        </h5>
                        <span style="opacity:0.7">Müşteri kartına tanımlı <?=count($merkezler)?> adet merkez listelenmiştir.  </span>
                      </div>
                      <div class="col-sm-2">
                        <a href="<?=base_url("merkez/add/".$musteri->musteri_id)?>" type="button" class="btn btn-block bg-success"><i class="fa fa-plus-circle"></i> Yeni Merkez Ekle</a>
                      </div>
                    </div>



                    <!-- Post -->
                    <?php foreach ($merkezler as $merkez) : ?>
                    
                      <div class="timeline timeline-inverse" style="margin-bottom: 0px;">
                        <div>
                          <i class="fas fa-envelope bg-primary"></i>
                          <div class="timeline-item" style="border: 1px solid #042657">
                            <span class="time text-white"><i class="far fa-clock"></i> Kayıt Tarihi : <?=date("d.m.Y H:s",strtotime($merkez->merkez_kayit_tarihi))?></span>
                            <h3 class="timeline-header" style="background:#002559;color:white;padding-left: 9px;"><span class="text-bold text-white"><?=$merkez->merkez_adi?><br>
                            <span style="
    font-size: small;
    font-weight: 400;
">     <?=$merkez->merkez_adresi?> - <?=$merkez->ilce_adi?> / <?=$merkez->sehir_adi?> </span>
                          </span></h3>
                            <div class="timeline-body">
                             
 
                       
                              <div class="row">
                                <?php foreach ($urunler as $urun) : ?>
                                <?php 
                                   if($urun->siparis_urun_aktif != 1){continue;} 
                                  
                                  if($urun->teslimat_merkez_no != 0){
                                    if($urun->teslimat_merkez_no != $merkez->merkez_id){continue;} 
                                  
                                  }else{
                                    if($urun->merkez_id != $merkez->merkez_id){continue;} 
                                  
                                  }

                                  
                                  ?>
                                <div class="col-md-4">
                                <div class="btn-group mb-2" style="display: flow;">
                                <button style=" <?=($urun->takas_cihaz_mi == 1) ? "opacity:0.5;" : ""?>   padding-right: 0px;width: 100%;     border: 1px dashed #002355;padding-left:0px;" onclick="if (event.target.tagName.toLowerCase() === 'a') { event.stopPropagation(); } else{ showcihaz(<?=$urun->siparis_urun_id?>); }" type="button" class="btn btn-default text-left pb-2">   
<div class="row">
  <div class="col" style="max-width: 87px;">

  <img src="<?="https://www.umex.com.tr/uploads/products/".$urun->urun_slug.".png"?>" alt="..." style="width: 83px;" class="rounded img-thumbnail">
                            

  </div>
  <div class="col" style="padding-left: 0px;">



  <span style="
    display: block;
    background: #dbdbdb;
    padding: 5px;
    color: white;
    border-radius: 5px;
    border-radius: 3px 3px 0 0;
">   <span style="min-width: 230px; width: 230px; display: inline-block; margin-left:5px"> <b style="color:#0f3979"><?=$urun->urun_adi?> / </b>   <?=$urun->seri_numarasi != "" ? '<span style="color:black">'.$urun->seri_numarasi."</span>" : "<span class='text-danger'>Sipariş devam ediyor...</span>"?> </span> 
                        
    </span>

                                  <span style="
    height: 11px;
"></span>
<div style="padding-left:10px;background:white;border:1px solid;border-top:0px;border: 1px solid #dbdbdb; border-top: 0px; border-radius: 0px 0px 3px 3px;">
                             <b>Garanti Bitiş : </b><?=date("d.m.Y",strtotime($urun->garanti_bitis_tarihi))?>
     <br>

     <?php 
     
      $a = get_borc_durum_sorgula($urun->seri_numarasi);
              if($urun->seri_numarasi != "" && ($a>0) ){
                $uu =  '<br><a style="padding-top:3px;color:white!important;font-size: 12px!important;" class="btn btn-danger yanipsonenyazinew   btn-xs">Borç Uyarısı</a>';
            }else{
                $uu = '';
            }

     ?>


                            <br>
                            <?php 
                             echo ($urun->urun_iade_durum != 0 ? '<br><div style="  background: #ff03031c;border: 1px solid #ff0000;border-radius: 3px;padding: 2px;color: #801e00; "><i class="fas fa-times-circle"></i><b style="font-weight: 490;"> İade : </b><span style="font-weight:normal"> '.$urun->urun_iade_notu." - ".date("d.m.Y H:i",strtotime($urun->urun_iade_tarihi)).'</span></div>' : "");
                             ?>
                             


                             </div>
  </div>
</div>
                               
                              </button> 


<?php 
if($urun->takas_cihaz_mi == "1"){
?>

<span class="text-danger" style="
    float: right;
    margin-top: -79px;
    z-index: 99999999;
    margin-right: 18px;
    position: relative;
    font-weight: 600;
">TAKAS</span>
<?php
}

?>






                              </div></div>
                              <?php endforeach;?>


                            <!-- TAKAS CİHAZ -->
                              <?php 
                              $takas_cihazlari = get_takas_cihaz_by_merkez_id($merkez->merkez_id);
                              if(count($takas_cihazlari)>0){
                                foreach ($takas_cihazlari as $t_cihaz) {
                                  if($t_cihaz->merkez_id == $merkez->merkez_id){
                                    continue;
                                  }
 ?>

                                    <div class="col-md-4">
                                      <div class="btn-group mb-2" style="display: flow;">
                                          <button style="opacity:0.5; padding-right: 0px;width: 100%;     border: 1px dashed #002355;padding-left:0px;" onclick="if (event.target.tagName.toLowerCase() === 'a') { event.stopPropagation(); } else{ showcihaz(<?=$t_cihaz->siparis_urun_id?>); }" type="button" class="btn btn-default text-left pb-2">
                                            <div class="row">
                                                <div class="col" style="max-width: 87px;">
                                                  <img src="<?="https://www.umex.com.tr/uploads/products/".$t_cihaz->urun_slug.".png"?>" alt="..." style="width: 83px;" class="rounded img-thumbnail">
                                                </div>
                                                <div class="col" style="padding-left: 0px;">
                                                  <span style="
                                                      display: block;
                                                      background: #dbdbdb;
                                                      padding: 5px;
                                                      color: white;
                                                      border-radius: 5px;
                                                      border-radius: 3px 3px 0 0;
                                                      ">   <span style="min-width: 230px; width: 230px; display: inline-block; margin-left:5px"> <b style="color:#0f3979"><?=$t_cihaz->urun_adi?> / </b>   <?=$t_cihaz->seri_numarasi != "" ? '<span style="color:black">'.$t_cihaz->seri_numarasi."</span>" : "<span class='text-danger'>Sipariş devam ediyor...</span>"?> </span> 
                                                  </span>
                                                  <span style="
                                                      height: 11px;
                                                      "></span>
                                                  <div style="padding-left:10px;background:white;border:1px solid;border-top:0px;border: 1px solid #dbdbdb; border-top: 0px; border-radius: 0px 0px 3px 3px;">
                                                      <b>Garanti Bitiş : </b><?=date("d.m.Y",strtotime($t_cihaz->garanti_bitis_tarihi))?>
                                                      <br>
                                                      <?php 
                                                        $urlcustom = base_url("siparis/report/").urlencode(base64_encode("Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE".$t_cihaz->siparis_id."Gg3TGGUcv29CpA8aUcpwV2KdjCz8aE"));
                                                        
                                                        ?>Sipariş Kodu : 
                                                      <a class="text-primary" style="cursor:pointer" onclick="showWindow('<?=$urlcustom?>')">
                                                      <?php 
                                                        echo  (($t_cihaz->satis_fiyati > 0) ? $t_cihaz->siparis_kodu : "<span style='opacity:0.5;color:black!important'>Sistem Öncesi Kayıt</span>")."</a>".($t_cihaz->takas_bedeli > 0 ? " <span style='color: red;'>(Takaslı)</span>" : "");
                                                        ?>
                                                      </a>
                                                      <?php 
                                                        echo ($t_cihaz->urun_iade_durum != 0 ? '<br><div style="  background: #ff03031c;border: 1px solid #ff0000;border-radius: 3px;padding: 2px;color: #801e00; "><i class="fas fa-times-circle"></i><b style="font-weight: 490;"> İade : </b><span style="font-weight:normal"> '.$t_cihaz->urun_iade_notu." - ".date("d.m.Y H:i",strtotime($t_cihaz->urun_iade_tarihi)).'</span></div>' : "");
                                                        ?>
                                                  </div>
                                                </div>
                                            </div>
                                          </button>
                                         
                                          <span class="text-danger" style="
                                            float: right;
                                            margin-top: -79px;
                                            z-index: 99999999;
                                            margin-right: 18px;
                                            position: relative;
                                            font-weight: 600;
                                            ">TAKAS</span>
                                         
                                      </div>
                                    </div>


                                  <?php

                                }
                              }
                              ?>
                            <!-- TAKAS CİHAZ -->
















                              </div>



                            </div>
                            <div class="timeline-footer" style="      padding-top: 0;  padding-left: 16px;">
                              <a style="background: #042657; color: white !important; border: 1px solid #042657;  "  onclick='showWindow("<?=base_url("merkez/duzenle/".$merkez->merkez_id)?>")' class="btn btn-primary btn-sm text-dark"><i class="far fa-eye"></i> Merkez Bilgilerini Düzenle</a>
                              <a onclick='showWindow("<?=base_url("cihaz/cihaz_tanimlama_view/".$merkez->merkez_id)?>");' class="btn btn-danger btn-sm" ><i class="fas fa-plus-circle nav-icon" ></i> Cihaz Tanımla</a>
                            </div>
                          </div>
                        </div>
                      </div>

                    <?php endforeach;?>





                    
                   





                    
                  </div>
                  <!-- /.tab-pane -->


              
                  <div class="tab-pane" id="teslimatlar">
                    <!-- The timeline -->
                   




                    <table id="example1" class="table table-bordered table-striped nowrap" style="font-weight: 600;">
                  <thead>
                  <tr>
                    <th style="width: 42px;">ID</th> 
                 
                    <th>Cihaz Adı</th>
                    <th>Merkez Bilgisi</th>
                    <th>Seri Numarası</th> 
                    <th style="width: 130px;">Garanti Başlangıç</th>
                    <th style="width: 130px;">Garanti Bitiş</th> 
                    <th style="">İşlem</th> 
                  </tr>
                  </thead>
                  <tbody>
                  
                    <?php foreach ($urunler as $urun) : ?>
                    <?php 
                      $bcolor="#e4ffe6";
                      $fcolor = "";
                      $rowbg = "";
                      if(date("Y-m-d",strtotime($urun->garanti_bitis_tarihi)) == date("Y-m-d",strtotime($urun->garanti_baslangic_tarihi))){
                        $bcolor = "#fef7ea";
                        $fcolor = "#616161";
                        $rowbg = "#fef7ea";
                      }
                      else if(date("Y-m-d",strtotime($urun->garanti_bitis_tarihi)) < date("Y-m-d")){
                        $bcolor = "#bd0606";
                        $fcolor = "#ffffff";
                        $rowbg = "#bd0606";
                      } 
                      ?>

                    <tr style="background:<?=$rowbg?>;color:<?=$fcolor?>">
                      <td><?=$urun->siparis_urun_id?></td>




                       <td>  
                       <?=$urun->urun_adi?>
                    </td> 
                      <td><i class="far fa-user-circle" style="margin-right:5px;opacity:1"></i> 
                      <?=$urun->merkez_adi?>  <?=$urun->sehir_adi?> / <?=$urun->ilce_adi?> 
                    </td>
                  
                      <td><i class="fas fa-qrcode" style="margin-right:5px;opacity:1"></i> 
                       <?=$urun->seri_numarasi ?? "<span style='opacity:0.3'>UG00000000UX00</span>"?> 
                    </td>
                   
                    <td style="background:<?=$bcolor?>; color:<?=$fcolor?>">
                    <?php 
                    
                    if(date("Y-m-d",strtotime($urun->garanti_bitis_tarihi)) == date("Y-m-d",strtotime($urun->garanti_baslangic_tarihi))){
                      echo '<i class="fas fa-exclamation-circle" style="padding:4px;border-radius:7px;color:white;background:#ee9500;margin-right:5px;opacity:1"></i> '." Başlatılmadı";
                
                    }else{
                      echo '<i class="far fa-calendar-check" style="margin-right:5px;opacity:1"></i>'.date("d.m.Y",strtotime($urun->garanti_baslangic_tarihi));
                    }
                    
                    ?> 
                     
                    </td>
                    <td style="background:<?=$bcolor?>; color:<?=$fcolor?>">
                    
                    <?php 
                    
                    if(date("Y-m-d",strtotime($urun->garanti_bitis_tarihi)) == date("Y-m-d",strtotime($urun->garanti_baslangic_tarihi))){
                      echo '<i class="fas fa-exclamation-circle" style="padding:4px;border-radius:7px;color:white;background:#ee9500;margin-right:5px;opacity:1"></i> '." Başlatılmadı";
                
                    }else{
                      if(date("Y-m-d",strtotime($urun->garanti_bitis_tarihi)) < date("Y-m-d")){
                        echo '<i class="fas fa-exclamation-triangle" style="padding:4px;border-radius:7px;color:white;background:#ea4e2c;margin-right:5px;opacity:1"></i> '.date("d.m.Y",strtotime($urun->garanti_bitis_tarihi))." / (".gunSayisiHesapla(date("d.m.Y"),date("d.m.Y",strtotime($urun->garanti_bitis_tarihi)))." gün önce)";
                      }else if(date("Y-m-d",strtotime($urun->garanti_bitis_tarihi)) == date("Y-m-d",strtotime($urun->garanti_baslangic_tarihi))){
                        echo '<i class="fas fa-exclamation-circle" style="padding:4px;border-radius:7px;color:white;background:#ee9500;margin-right:5px;opacity:1"></i> '." Başlatılmadı";
                  
                      }else{
                        echo '<i class="far fa-calendar-check" style="margin-right:5px;opacity:1;color:green;"></i> '.date("d.m.Y",strtotime($urun->garanti_bitis_tarihi))." (".gunSayisiHesapla(date("d.m.Y"),date("d.m.Y",strtotime($urun->garanti_bitis_tarihi)))." gün kaldı)";
                      }
                         }
                    
                    ?> 
                   
                       <?php 
                        
                     
                       ?>
                    </td>
                      
                      <td>
                    
                          <a type="button" href="<?=base_url("cihaz/duzenle/".$urun->siparis_urun_id)?>" class="btn btn-warning btn-xs" style="font-size: 12px!important;"><i class="fa fa-pen" style="font-size:12px" aria-hidden="true"></i> Düzenle</a>
                           
                      </td>
                       
                    </tr>
                  <?php  endforeach; ?>
              
                  </tbody>
                  
                </table>






                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="egitimler">
                     



                  <table id="exampleeg" class="table table-striped table-bordered nowrap text-sm" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-weight:500;height: 100%; width: 100%;">
                  <thead>
                  <tr>

                  
    <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Eğitim Alanlar</th>
                    
                     
                    <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Ürün</th>
                    
                    <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">Kayıt Bilgileri</th> 
                    <?php if($filtre == "uretim_sertifika"){?>
                      <th style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;padding-top:5px;padding-bottom:5px;font-weight:normal; color:white;background: #00347d;border-bottom:0px solid">İşleme Al</th> 
                    <?php }?>
                    
                  
                  
                    
                    
                    
                    

                   
                  </tr>
                  </thead>
                  <tbody>



                    <?php $count=0; foreach ($egitimler as $egitim) : ?>
                      <?php $count++?>
                    <tr>
                    
                       
                      <td> 
 
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
                  <!-- /.tab-pane -->






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
                  <!-- /.tab-pane -->










                  <div class="tab-pane" id="servisler">
                  

                  <table id="example1" class="table text-xs table-bordered table-striped nowrap">
                  <thead>
                  <tr>
                    <th>Servis Durumu</th>
                    <th style="width: 42px;">Servis Kodu</th>
                    <th>Servis Kayıt Tarihi</th>
                    <th>Müşteri Bilgileri</th>
                    <th>Cihaz</th> 
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
                  <!-- /.tab-pane -->







                </div>
                <!-- /.tab-content -->

                <div class="card-footer" style="
    margin-top: -2px;
    padding: 5px;
    border: 1px solid #498ff1;
    border-radius: 5px;
    background: #e0edff;
    color: #0050c1;margin-right: 10px;
    padding-left: 16px;padding-right: 16px;
">Bu müşteri <?=date("d.m.Y H:i",strtotime($musteri->musteri_kayit_tarihi))?> tarihinde <?=$musteri->kullanici_ad_soyad?> tarafından kaydedilmiştir.
</div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <style>
        /* Modal içindeki iframe'ın boyutunu ayarlamak için CSS */
        .swal2-content iframe {
            width: 90%;
            height: 100%;
            border: none;
        }

        .swal2-html-container{
          height: 690px;
          display: block;
    padding: 0px !important;
    margin: 0px!important;
        }
        .swal2-title{
          display: none!important;
          padding: 0!important;
        }
        .swal2-close{
          background: red!important;
    color: white!important;
        }
    </style>




<script>
   function showDetailSiparis(param){
            Swal.fire({
               
                html: '<iframe src="'+param+'" width="100%" height="100%" frameborder="0"></iframe>',
                showCloseButton: true,
                showConfirmButton: false,
                focusConfirm: false,
                width: '50%',
                height: '80%',
            });
        };
      
  </script>


  <script>
        // Sayfa yüklendiğinde modal dialogu göster
        function showdetail(param){
            Swal.fire({
               
                html: '<iframe src="https://ugbusiness.com.tr/servis/servis_detay/'+param+'/0/0/0/1" width="100%" height="100%" frameborder="0"></iframe>',
                showCloseButton: true,
                showConfirmButton: false,
                focusConfirm: false,
                width: '80%',
                height: '80%',
            });
        };



        function showcihaz(param){



          var width = 866;
        var height = 768;

        // Pencerenin konumunu hesapla
        var left = (screen.width / 2) - (width / 2);
        var top = (screen.height / 2) - (height / 2 + 50);
        var newWindow = window.open('https://ugbusiness.com.tr/cihaz/edit/'+param, 'Yeni Pencere', 'width=' + width + ',height=' + height + ',top=' + top + ',left=' + left);
        var interval = setInterval(function() {
            if (newWindow.closed) {
                clearInterval(interval);
                location.reload();
              
            }
        }, 1000); 
 
        };



        function showWindow($url) {
        
        var width = 750;
      var height = 790;

     
      var left = (screen.width / 2) - (width / 2);
      var top = (screen.height / 2) - (height / 2);
      var newWindow = window.open($url, 'Yeni Pencere', 'width=' + width + ',height=' + height + ',top=' + top + ',left=' + left);
      var interval = setInterval(function() {
            if (newWindow.closed) {
                clearInterval(interval);
                location.reload();
              
            }
        }, 1000); 
  };
    </script>