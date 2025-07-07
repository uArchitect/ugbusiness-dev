 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <!-- /.content-header -->
   <section class="content col  ">
     <div class="card card-dark" style=" ">
       <div class="card-header with-border" style="background:#061f3a">
         <h3 class="card-title text-center"> UG Business - Servis Kaydı Oluştur</h3>
       </div>
         <div class="card-body p-0" style="    zoom: 0.8;">
           <div class="row" style="background:#053eab;height: 269px;">
             <div class="col-4 text-left" style="height: 269px;padding: 0;" style="width:150px">
               <span class="badge bg-dark text-md p-4" style="    height: -webkit-fill-available;width: inherit;flex:1;font-weight:500;border-radius:0px;background:#004ac1!important;border: 0px solid #00274f;">
                 <div style="height:30px"></div>
                 <i class="fa fa-user-circle" style="font-size: 55px;color:#ffffff"></i>
                 <br>
                 <br>
                 <b> <?=mb_strtoupper($cihaz->musteri_ad)?> </b>
                 <br>
                 <span style="font-weight:300;margin-top:0px;padding:5px" class="d-block text-sm">
                   <i class="fa fa-user " style="margin-left:11px"></i> <?=$cihaz->musteri_kod?> <i class="fa fa-mobile-alt " style="margin-left:11px"></i> <?=$cihaz->musteri_iletisim_numarasi?> </span>
                 <br>
                 <a href="
													<?=base_url("musteri/duzenle/").$cihaz->musteri_id?>" type="button" class="btn  btn-dark" style="border:2px solid white;border-radius: 50px; padding: 8px;width: max-content!important;background: #061f3a;width: -webkit-fill-available;">
                   <i class="fas fa-pen"></i> Müşteri Düzenle </a>
             </div>
             <div class="col-4 text-center" style="border-width: 12px;   border-color: #004ac1; ">
              
             <img src="
												
													<?=base_url("assets/dist/img/".$cihaz->urun_slug.".png")?>" style="    margin-top: 22px;" alt="" width="145">
               
               <br>
               <div class="container-fluid">
                 <div class="row p-1">
                   <div class="col" style="
																	<?=($cihaz->urun_slug!="umex-diode")?"display:none;":""?>">
                     <img src="
																		<?=base_url("uploads/umex-diode.png")?>" style="
																		<?=($cihaz->urun_slug!="umex-diode")?"display:none;":""?>height: 54px; object-fit: contain; width: auto; background:#081f39; padding: 12px; margin-top: -8px; padding-right: 37px; padding-left: 37px; border-radius: 60px; border-color: white; border: 2px solid #a5c5ff;     " class="img-fluid" alt="umex-diode">
                   </div>
                   <div class="col" style="
																		<?=($cihaz->urun_slug!="umex-ems")?"display:none;":""?>">
                     <img src="
																			<?=base_url("uploads/umex-ems.png")?>" style="
																			<?=($cihaz->urun_slug!="umex-ems")?"display:none;":""?>height: 54px; object-fit: contain; width: auto; background: #081f39; padding: 12px; margin-top: -8px; padding-right: 37px; padding-left: 37px; border-radius: 60px; border-color: white; border: 2px solid #a5c5ff;     " class="img-fluid" alt="umex-ems">
                   </div>
                   <div class="col" style="
																			<?=($cihaz->urun_slug!="umex-gold")?"display:none;":""?>">
                     <img src="
																				<?=base_url("uploads/umex-gold.png")?>" style="
																				<?=($cihaz->urun_slug!="umex-gold")?"display:none;":""?>height: 54px; object-fit: contain; width: auto; background: #081f39; padding: 12px; margin-top: -8px; padding-right: 37px; padding-left: 37px; border-radius: 60px; border-color: white; border: 2px solid #a5c5ff;    " class="img-fluid" alt="umex-gold">
                   </div>
                   <div class="col" style="
																				<?=($cihaz->urun_slug!="umex-lazer")?"display:none;":""?>">
                     <img src="
																					<?=base_url("uploads/umex-lazer.png")?>" style="
																					<?=($cihaz->urun_slug!="umex-lazer")?"display:none;":""?>height: 54px; object-fit: contain; width: auto; background: #081f39; padding: 12px; margin-top: -8px; padding-right: 37px; padding-left: 37px; border-radius: 60px; border-color: white; border: 2px solid #a5c5ff;     " class="img-fluid" alt="umex-lazer">
                   </div>
                   <div class="col" style="
																					<?=($cihaz->urun_slug!="umex-plus")?"display:none;":""?>">
                     <img src="
																						<?=base_url("uploads/umex-plus.png")?>" style="
																						<?=($cihaz->urun_slug!="umex-plus")?"display:none;":""?>height: 54px; object-fit: contain; width: auto; background: #081f39; padding: 12px; margin-top: -8px; padding-right: 37px; padding-left: 37px; border-radius: 60px; border-color: white; border: 2px solid #a5c5ff;      " class="img-fluid" alt="umex-plus">
                   </div>
                   <div class="col" style="
																						<?=($cihaz->urun_slug!="umex-q")?"display:none;":""?>">
                     <img src="
																							<?=base_url("uploads/umex-q.png")?>" style="
																							<?=($cihaz->urun_slug!="umex-q")?"display:none;":""?>height: 54px; object-fit: contain; width: auto; background: #081f39; padding: 12px; margin-top: -8px; padding-right: 37px; padding-left: 37px; border-radius: 60px; border-color: white; border: 2px solid #a5c5ff;    " class="img-fluid" alt="umex-q">
                   </div>
                   <div class="col" style="
																							<?=($cihaz->urun_slug!="umex-s")?"display:none;":""?>">
                     <img src="
																								<?=base_url("uploads/umex-s.png")?>" style="
																								<?=($cihaz->urun_slug!="umex-s")?"display:none;":""?>height: 54px; object-fit: contain; width: auto; background: #081f39; padding: 12px; margin-top: -8px; padding-right: 37px; padding-left: 37px; border-radius: 60px; border-color: white; border: 2px solid #a5c5ff;    " class="img-fluid" alt="umex-s">
                   </div>
                   <div class="col" style="
																								<?=($cihaz->urun_slug!="umex-slim")?"display:none;":""?>">
                     <img src="
																									<?=base_url("uploads/umex-slim.png")?>" style="
																									<?=($cihaz->urun_slug!="umex-slim")?"display:none;":""?>height: 54px; object-fit: contain; width: auto; background: #081f39; padding: 12px; margin-top: -8px; padding-right: 37px; padding-left: 37px; border-radius: 60px; border-color: white; border: 2px solid #a5c5ff;    " class="img-fluid" alt="umex-slim">
                   </div>
                 </div>

                 
  <?php 
  if(get_borc_durum_sorgula($cihaz->seri_numarasi)>0){
    ?>
    <a style="padding-top:3px; font-size: 19px!important;color:white!important;" class="btn btn-danger yanipsonenyazifast btn-xs">Dikkat, Müşterinin Borcu Bulunmaktadır.</a>
    <?php
  }
  ?>


               </div>
               <br>
             </div>
             <div class="col-4 text-left" style="padding: 0;">
               <span class="badge bg-warning text-md p-4" style=" height: 269px;display: block;font-weight:500;border-radius:0px;color:white!important;background:#004ac1!important;border: 0px solid #093d7d;">
                 <div style="height:30px"></div>
                 <i class="fa fa-building" style="font-size: 55px;color:#ffffff"></i>
                 <br>
                 <br>
                 <b> <?=mb_strtoupper($cihaz->merkez_adi)?> </b>
                 <br>
                 <span style="font-weight:300;margin-top:0px;padding:5px" class="d-block text-sm">
                   <i class="far fa-map"></i> <?=$cihaz->merkez_adresi?> <b> <?=$cihaz->ilce_adi?> / <?=$cihaz->sehir_adi?> </b>
                 </span>
                 <br>
                 <a type="button" href="
																													<?=base_url("merkez/duzenle/").$cihaz->merkez_id?>" class="btn  btn-dark" style="color:white!important;border:2px solid white;border-radius: 50px; padding: 8px;width: max-content!important;background: #061f3a;width: -webkit-fill-available;">
                   <i class="fas fa-pen"></i> Merkez Düzenle </a>
                 <br>
                 <br>
                 <br>
               </span>
             </div>
           </div>
           <h3 class="timeline-header bg-dark text-center d-none" style="background:#001429!important;margin-bottom: 0;">
             <div class="container-fluid">
               <div class="row p-3">
                 <div class="col" style="
																																<?=($cihaz->urun_slug!="umex-diode")?"display:none;":""?>">
                   <img src="
																																	<?=base_url("uploads/umex-diode.png")?>" style="
																																	<?=($cihaz->urun_slug!="umex-diode")?"display:none;":""?>height:40px;object-fit: contain;width:auto" class="img-fluid" alt="umex-diode">
                 </div>
                 <div class="col" style="
																																	<?=($cihaz->urun_slug!="umex-ems")?"display:none;":""?>">
                   <img src="
																																		<?=base_url("uploads/umex-ems.png")?>" style="
																																		<?=($cihaz->urun_slug!="umex-ems")?"display:none;":""?>height:40px;object-fit: contain;width:auto" class="img-fluid" alt="umex-ems">
                 </div>
                 <div class="col" style="
																																		<?=($cihaz->urun_slug!="umex-gold")?"display:none;":""?>">
                   <img src="
																																			<?=base_url("uploads/umex-gold.png")?>" style="
																																			<?=($cihaz->urun_slug!="umex-gold")?"display:none;":""?>height:40px;object-fit: contain;width:auto" class="img-fluid" alt="umex-gold">
                 </div>
                 <div class="col" style="
																																			<?=($cihaz->urun_slug!="umex-lazer")?"display:none;":""?>">
                   <img src="
																																				<?=base_url("uploads/umex-lazer.png")?>" style="
																																				<?=($cihaz->urun_slug!="umex-lazer")?"display:none;":""?>height:40px;object-fit: contain;width:auto" class="img-fluid" alt="umex-lazer">
                 </div>
                 <div class="col" style="
																																				<?=($cihaz->urun_slug!="umex-plus")?"display:none;":""?>">
                   <img src="
																																					<?=base_url("uploads/umex-plus.png")?>" style="
																																					<?=($cihaz->urun_slug!="umex-plus")?"display:none;":""?>height:40px;object-fit: contain;width:auto" class="img-fluid" alt="umex-plus">
                 </div>
                 <div class="col" style="
																																					<?=($cihaz->urun_slug!="umex-q")?"display:none;":""?>">
                   <img src="
																																						<?=base_url("uploads/umex-q.png")?>" style="
																																						<?=($cihaz->urun_slug!="umex-q")?"display:none;":""?>height:40px;object-fit: contain;width:auto" class="img-fluid" alt="umex-q">
                 </div>
                 <div class="col" style="
																																						<?=($cihaz->urun_slug!="umex-s")?"display:none;":""?>">
                   <img src="
																																							<?=base_url("uploads/umex-s.png")?>" style="
																																							<?=($cihaz->urun_slug!="umex-s")?"display:none;":""?>height:40px;object-fit: contain;width:auto" class="img-fluid" alt="umex-s">
                 </div>
                 <div class="col" style="
																																							<?=($cihaz->urun_slug!="umex-slim")?"display:none;":""?>">
                   <img src="
																																								<?=base_url("uploads/umex-slim.png")?>" style="
																																								<?=($cihaz->urun_slug!="umex-slim")?"display:none;":""?>height:40px;object-fit: contain;width:auto" class="img-fluid" alt="umex-slim">
                 </div>
               </div>
             </div>
           </h3>
         </div>


  

     </div>



     <div class="row">

     <div class="col col-md-7">


<?php 
if(!empty($query_result)){
  $output="";
foreach ($query_result as $row) {
  $output .= "Eski Servis ID: " . $row->eski_servis_id . "<br>";
  $output .= "Eski Servis Seri Numarası: " . $row->eski_servis_seri_numarasi . "<br>";
  $output .= "Eski Servis Merkez Adı: " . $row->eski_servis_merkez_adi . "<br>";
  $output .= "Eski Servis İletişim: " . $row->eski_servis_iletisim_numarasi . "<br>";
$output .= "Eski Servis Sorun Bildirimi: " . $row->eski_servis_sorun . "<br>";
$output .= "Eski Servis İşlemler: " . $row->eski_servis_islem . "<br>";
$output .= "Eski Servis Görevler: " . $row->eski_servis_gorev . "<br>";
$output .= "Eski Servis Tip: " . $row->eski_servis_tip . "<br>";
$output .= "Eski Servis Garanti: " . $row->eski_garanti_durumu . "<br>";
  $output .= "Eski Servis Durum: " . $row->eski_servis_durum . "<br>";
$output .= "Eski Servis Kayıt Tarihi: " . $row->eski_servis_kayit_tarihi . "<br>";
$output .= "Eski Servis Kapatma Tarihi: " . $row->eski_servis_kapatma_tarihi . "<br><br>";


$output .= "Güncel Merkez: " . $row->merkez_adi . "<br>";
  $output .= "Güncel Müşteri: " . $row->musteri_ad . "<br>"; 
  $output .= "\n"; // Her kayıt arasına bir boş satır ekleyelim
}
echo $output;

}
?>





     <div class="card <?=(date("Y-m-d",strtotime($cihaz->garanti_bitis_tarihi)) < date("Y-m-d"))?"card-danger":"card-dark"?>">
  <div class="card-header" style="">Servis Detayları

  
  <?php 
  if((date("Y-m-d",strtotime($cihaz->garanti_bitis_tarihi)) < date("Y-m-d"))){
    ?>
    <div class="card-tools"><i class="fas fa-exclamation-circle"></i> GARANTİ SÜRESİ DOLMUŞ</div>
    <?php
  }

  ?>

</div>
  <div class="card card-body" style="margin: 10px; background: #ffffff; margin-top: 6px;">

  <div class="row">
    <div class="col">
    <div class="form-group">
        <label for="formClient-Code"><i class="fas fa-question-circle text-primary"></i> Cihaz Bilgisi</label>
        <input type="text" disabled value="<?=$cihaz->urun_adi?>" class="form-control">
</div>
    </div>

    <div class="col" style="    min-width: 287px;">
    <div class="form-group">
        <label for="formClient-Code"><i class="fas fa-users-cog text-success"></i> Seri Numarası</label>
        <input type="text" disabled value="<?=$cihaz->seri_numarasi?> (<?=$cihaz->renk_adi?>)" class="form-control">
</div>
    </div>



    <div class="col">
    <div class="form-group">
        <label for="formClient-Code"><i class="far fa-calendar-alt text-warning"></i> Garanti Başlangıç</label>
        <input type="text" disabled value="<?=date("d.m.Y",strtotime($cihaz->garanti_baslangic_tarihi))?>" class="form-control">
</div>
    </div>



    <div class="col">
    <div class="form-group">
        <label for="formClient-Code"><i class="far fa-calendar-alt text-danger"></i> Garanti Bitiş</label>
        <input type="text" disabled value="<?=date("d.m.Y",strtotime($cihaz->garanti_bitis_tarihi))?>" class="form-control">
</div>
    </div>








  </div>

<?php 

if(!empty($query_result)){
  ?>
  <form action="<?=base_url("servis/servis_kaydet/".$cihaz->siparis_urun_id."/".$query_result[0]->eski_servis_id)?>" onsubmit="disableSubmitButton()" method="post">

  <?php
}else{
 ?>
  <form action="<?=base_url("servis/servis_kaydet/".$cihaz->siparis_urun_id)?>" onsubmit="disableSubmitButton()" method="post">

  <?php
}

?>

  


<div class="form-group">
        <label for="formClient-Code"><i class="fas fa-users-cog text-success"></i> Görev Tanımla</label>
        <select class="select2bs4" inputmode='none' name="gorevler[]" multiple data-placeholder="Servis teknisyeni olarak tanımlamak istediğiniz kullanıcıları seçiniz..." style="width: 100%;">
                      
                      <?php 
                      $eski_k = 0;
                      switch ($query_result[0]->eski_servis_gorev) {
                        case 'FIRAT AYAZ':        $eski_k = 12; break;
                        case 'SERTAÇ BAYBURE':    $eski_k = 19; break;
                        case 'KAZIM IRMAK':       $eski_k = 39; break;
                        case 'FEVZİ YALTIR':      $eski_k = 40; break;
                        case 'EMRAH ÖZŞAHİN':     $eski_k = 41; break;
                        case 'HASAN LİMONLU':     $eski_k = 42; break;
                        case 'GÖKMEN DAĞPARÇASI': $eski_k = 43; break;                        
                        case 'ADEM YALMAN':       $eski_k = 44; break;
                        case 'ÖMER ÇATALKAYA':    $eski_k = 45; break;
                        case 'CAHİT ÇEKİÇ':       $eski_k = 46; break;
                        case 'MUSA ÖZLÜ':         $eski_k = 56; break;
                        case 'KENAN DUMAN':       $eski_k = 70; break;
                        case 'MELİH ÖZ':          $eski_k = 71; break;
                        case 'İLHAN GÜLCÜ':       $eski_k = 72; break;
                        case 'YUNUS EMRE ATMACA': $eski_k = 73; break;
                        case 'HAKAN TOPRAK':      $eski_k = 74; break;
                        case 'ÜMİT ÇAYIR':        $eski_k = 75; break;
                        default:
                          # code...
                          break;
                      }
                      
                      ?>
                      
                      
                      <?php 
              foreach ($kullanicilar as $kullanici) {
                ?>
                <option <?=(!empty($query_result) && ($kullanici->kullanici_id == $eski_k) )?"selected":""?> value="<?=$kullanici->kullanici_id?>"><?=$kullanici->kullanici_ad_soyad?></option>
                <?php
              }
              ?>
            </select>
</div>








<div class="row">



<div class="col" style="padding-left: 0;">
    <div class="form-group">
        <label for="formClient-Code"><i class="fas fa-question-circle text-primary"></i> Servis Türü</label>
        <select class="form-control select2" name="servis_bildirim_tanim_no" data-select2-id="1">
              <?php 
              foreach ($bildirimler as $bildirim) {
                ?>



                


                <option value="<?=$bildirim->servis_bildirim_kategori_id?>"><?=$bildirim->servis_bildirim_kategori_adi?></option>
                <?php
              }
              ?>
            </select>
</div>
    </div>






<div class="col">
    <div class="form-group">
        <label for="formClient-Code"><i class="fas fa-question-circle text-primary"></i> Servis Tipi</label>
        <select class="form-control select2" name="servis_tip_tanim_no" data-select2-id="6">
              <?php 
              foreach ($servis_tipleri as $servis_tip) {
                ?>
                <option value="<?=$servis_tip->servis_tip_id?>"
                <?=(date("Y-m-d",strtotime($cihaz->garanti_bitis_tarihi)) < date("Y-m-d") && $servis_tip->servis_tip_id == 3)?"selected":""?>
                ><?=$servis_tip->servis_tip_adi?></option>
                <?php
              }
              ?>
            </select>
</div>
    </div>

    <div class="col" style="padding-right: 0;">
    <div class="form-group">
        <label for="formClient-Code"><i class="fas fa-money-bill-wave text-success"></i> Ödeme Durumu</label>
        <select class="form-control select2" name="servis_odeme_tanim_no" data-select2-id="5">
              <?php 
              foreach ($odeme_durumlari as $odeme_durum) {
                ?>
                <option value="<?=$odeme_durum->servis_odeme_durum_id?>"
                <?=(date("Y-m-d",strtotime($cihaz->garanti_bitis_tarihi)) < date("Y-m-d") && $odeme_durum->servis_odeme_durum_id == 2)?"selected":""?>
                ><?=$odeme_durum->servis_odeme_durum_adi?></option>
                <?php
              }
              ?>
            </select>
</div>
    </div>

</div>







<label for="formClient-Code"><i class="fas fa-tools text-danger"></i> Servis Detayları</label>

    <table id="servisDetaylariTable" class="table text-md table-bordered table-striped nowrap">
      <thead>
        <tr>
          <th style="width:40%">Kategori</th>
          <th style="width:55%">Açıklama</th>
          <th style="width:5%">İşlem</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
          
            <select class="form-control select2" required name="sorun_kategori[]" data-select2-id="2">
            <option value="">Sorun Seçiniz</option>
            <?php 
              foreach ($sorunlar as $sorun) {
                ?>

<?php 
 

                $stext = "";
                if(!empty($query_result)){
                  $search=array("ç","i","ı","ğ","ö","ş","ü");
    $replace=array("Ç","İ","I","Ğ","Ö","Ş","Ü");
    $metin=str_replace($search,$replace,$query_result[0]->eski_servis_sorun);
    $metin=strtoupper($metin);

                   $aramaKelimesi = strtoupper($sorun->servis_sorun_kategori_adi);
                  // strpos() kullanarak arama
                  if (stripos($metin, $aramaKelimesi) !== false) {
                    $stext = "selected='selected'";
                  } 
                }
                ?>


                <option value="<?=$sorun->servis_sorun_kategori_id?>"  <?=$stext?> ><?=$sorun->servis_sorun_kategori_adi?></option>
                <?php
              }
              ?>
            </select>
          </td>
          <td><input type="text" name="sorun_aciklama[]" placeholder="Sorun ile ilgili açıklayıcı bir metin giriniz..." class="form-control"></td>
          <td>
            <button class="btn btn-danger" disabled>İptal</button>
          </td>
       
        </tr>
      </tbody>
    </table>
    <div class="row">
<button id="satirEkleBtn" type="button" class="btn btn-success d-block p-2 mt-2" style=" border: 2px dotted #6cbd6b;   color: #126503;background: #dfffde;width:220px;"><i class="fa fa-plus-circle"></i> Yeni Servis Bildirimi Ekle</button>
<button id="submitBtnServis" class="btn btn-success p-2 mt-2 ml-2"><i class="fas fa-save"></i> Servis Kaydı Oluştur</button>
 </div>


 </form>
       </div>

 
</div>
</div>
<div class="col col-md-5" style="padding: 0;">


<div class="row">



<div class="col-lg-6" style="padding: 0;padding-right: 7px;">

<div class="small-box bg-dark" style="margin-bottom: 8px;background-color: #181818 !important;">
  <div class="inner">
    <h3><?=count($gecmis_servisler)?></h3>
    <p>Toplam Servis<br>&nbsp;</p>
    </div>
    <div class="icon">
    <i class="fas fa-users-cog text-danger" style="font-size: 50px;"></i>

    </div>
  </div>
</div>


<div class="col-lg-6" style="padding: 0;">

<div class="small-box bg-dark" style="margin-bottom: 8px;background-color: #181818 !important;">
  <div class="inner">
    <h3><?=($atis_yukleme_sayisi) ? $atis_yukleme_sayisi : "0"?></h3>
    <p>Toplam Atış<br>
  
    <span style="font-size:14px;opacity:0.7">
      Buzlanan : <?=($buzlanan_atis_yukleme_sayisi) ? $buzlanan_atis_yukleme_sayisi : "0"?>
      Soğuk Hava : <?=($soguk_atis_yukleme_sayisi) ? $soguk_atis_yukleme_sayisi : "0"?>
  
  </span>
  </p>
    
    </div>
    <div class="icon">
    <i class="fas fa-download text-warning" style="font-size: 50px;"></i>
 
    </div>
  </div>
</div>



</div>





<div class="card card-dark">
    <div class="card-header with-border">
      <h3 class="card-title"> Yeni Atış Yüklemesi</h3>
     
     
    </div>
  
                <form id="myForm" class="form-horizontal" method="POST" action="<?=base_url("servis/servis_atis_yukle/".$cihaz->siparis_urun_id)?>">
        <div class="card-body">

    
        <div class="input-group input-group-sm mr-2">
<select name="servis_atis_kategori_no" style="margin-right: 5px;width: 170px;">
  <option value="2" selected>SOĞUK HAVA</option>
  <option value="1">BUZLANAN</option>
            </select>
<input type="date" style="margin-right: 5px;max-width:135px" name="servis_atis_yukleme_tarihi" required value="<?=date("Y-m-d")?>" class="form-control">
<input type="number" style="margin-right: 5px;width:65px;max-width:65px" name="servis_atis_yukleme_adet" required value="1" class="form-control">

<span class="input-group-append">
<button type="button" id="submitBtn"  class="btn btn-success btn-flat"><i class="fas fa-download"></i> ATIŞ YÜKLE</button>
</span>
</div>
  

      
       
    </div>
    <!-- /.card-body -->

    
    <!-- /.card-footer-->

    </form>
  </div>











<div class="card card-dark card-tabs">
  <div class="card-header p-0 pt-1">
    <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
      <li class="pt-2 px-3">
        <h3 class="card-title">Geçmiş İşlemler</h3>
      </li>
      <li class="nav-item">
        <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true"><i class="fas fa-users-cog text-danger"></i> Servisler</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false"><i class="fas fa-download text-warning"></i> Atış Yüklemeleri</a>
      </li>
 
    </ul>
  </div>
  <div class="card-body" style="min-height:  305px;">
    <div class="tab-content" id="custom-tabs-two-tabContent">
      <div class="tab-pane fade active show text-center" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab"> 
      

      <?php 
      if(count($gecmis_servisler)==0){
        ?>
         <img width="170" style="margin:auto" src="https://ugbusiness.com.tr/assets/dist/img/empty-place-holder.png">      
          <h4 style="font-size:15px;color:#e78301;font-weight:bolder">Geçmiş Servisler</h4>
          <h5 style="margin:auto;margin-bottom:30px;max-width:450px;font-size:13px;color:#edaf56"><?=$cihaz->seri_numarasi?> seri nolu <?=$cihaz->urun_adi?> adlı cihaza tanımlı geçmiş servis kaydı bulunamadı.</h5>
        <?php
      }
      
      ?>
  
<?php 
foreach ($gecmis_servisler as $gservis) {
  ?>
    <a href="<?=base_url("servis/servis_detay/".$gservis->servis_id)?>" type="button" class="btn btn-default btn-block">
      <b><?=$gservis->servis_kod?></b> - <?=date("d.m.Y",strtotime($gservis->servis_kayit_tarihi))?>
      <?php 
      if($gservis->servis_bildirim_tanim_no == 4){
        ?>
        <span class="yanipsonenyazinew" style="color:red">CİHAZ DEĞİŞİMİ YAPILDI</span>
        <?php
      }
      ?>
</a>  
  <?php
}
?>  
       


      </div>
      <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab"> 
      <?php 
      if(count($atis_yuklemeleri)==0){
        ?>
        <div class="text-center">
         <img width="170" style="margin:auto" src="https://ugbusiness.com.tr/assets/dist/img/empty-place-holder.png">      
          <h4 style="font-size:15px;color:#e78301;font-weight:bolder">Geçmiş Atış Yüklemeleri</h4>
          <h5 style="margin:auto;margin-bottom:30px;max-width:450px;font-size:13px;color:#edaf56"><?=$cihaz->seri_numarasi?> seri nolu <?=$cihaz->urun_adi?> adlı cihaza tanımlı geçmiş atış yükleme kaydı bulunamadı.</h5>
          </div>
            <?php
      }
      
      ?>

<?php 
foreach ($atis_yuklemeleri as $atis) {
  ?>
    <a href="<?=base_url("servis/atis_form/$atis->servis_atis_yukleme_id ")?>" class="btn btn-default btn-block">
      <b><?=$atis->atis_yukleme_sayisi?> ADET </b> - <?=($atis->servis_atis_kategori_no == 1) ? "BUZLANAN" : "SOĞUK HAVA" ?> - <?=date("d.m.Y",strtotime($atis->servis_atis_yukleme_tarihi))?> -
     <?=($atis->atis_yukleme_sayisi > 1) ?"<span class='text-danger'> Çoklu Atış Yüklemesi</span>" : "<span class='text-success'> Tekli Atış Yüklemesi</span>" ?>
</a>  
  <?php
}
?>

    
   
  
 
      </div>
     
    </div>
  </div>
</div>

















</div>
</div>
<br><br>

 </div>
 <!-- /.card-body -->
 <!-- /.card-footer-->

 </div>
 <!-- /.card -->






 </section>
 
 </div>



 <script>

function ekle(){
  var table = document.getElementById("servisDetaylariTable").getElementsByTagName('tbody')[0];
    var row = table.insertRow(table.rows.length);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var select2 = document.createElement("select");
    var textbox = document.createElement("input");
    var deleteButton = document.createElement("button");
    select2.className = "form-control select2";
    select2.name = "sorun_kategori[]";
    select2.innerHTML = '<option value="">Sorun Seçiniz</option><?php foreach ($sorunlar as $sorun): ?><option value="<?= $sorun->servis_sorun_kategori_id ?>"><?= $sorun->servis_sorun_kategori_adi ?></option><?php endforeach; ?>';
    textbox.type = "text";
    textbox.name = "sorun_aciklama[]";
    textbox.placeholder = "Sorun ile ilgili açıklayıcı bir metin giriniz...";
    textbox.className = "form-control";
    deleteButton.type = "button";
    deleteButton.className = "btn btn-danger satirSilBtn";
    deleteButton.textContent = "İptal";
    deleteButton.addEventListener("click", function() {
      var tables = document.getElementById("servisDetaylariTable")
      var rowIndex = row.rowIndex;
      console.log("Satır silme düğmesine tıklandı, satır indexi: " + rowIndex);
      tables.deleteRow(rowIndex);
    });
    cell1.appendChild(select2);
    cell2.appendChild(textbox);
    cell3.appendChild(deleteButton);
}



document.addEventListener("DOMContentLoaded", function() {


    var select2Inputs = table.find('.select2');


select2Inputs.each(function() {
    $(this).select2({
        templateResult: formatState
    });
});
});
</script>


 <script>
  document.getElementById("satirEkleBtn").addEventListener("click", function() {
    
    ekle();
var table = $('#servisDetaylariTable');


var select2Inputs = table.find('.select2');


select2Inputs.each(function() {
    $(this).select2({
        templateResult: formatState
    });
});
  });


 
</script>



<script>
document.getElementById('submitBtn').addEventListener('click', function() {
  
    Swal.fire({
        title: 'Atış Yükleme',
        text: "Girilen bilgiler doğrultusunda atış yükleme kaydı oluşturulacaktır. İşlemi onaylıyor musunuz?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ONAYLA',
        cancelButtonText: 'İPTAL'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('myForm').submit();
        }
    });
});
</script>
<script>
function disableSubmitButton() {
    document.getElementById('submitBtnServis').disabled = true;
}
</script>
<style>


.card-dark:not(.card-outline)>.card-header a.active {
    color: #ffffff;
    background: #3b3b3b;
    border: 0;
}


              .table th {
                background: #deeaff !important;
    color: #0a0a0a !important;
    /* padding: 10px !important; */
    padding-left: 10px !important;
} .table td {
  padding: 6px !important;
}

.yanipsonenyazifast {
      animation: blinker2 0.5s linear infinite;
   
      }
      @keyframes blinker2 {  
      50% { opacity: 0.9;scale: 1.3; }
      }

              </style>