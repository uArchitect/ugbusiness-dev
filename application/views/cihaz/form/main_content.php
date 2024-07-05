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
                 <b> <?=mb_strtoupper($merkez->musteri_ad)?> </b>
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
                    
                    <div class="col pl-0">
                      <div class="mt-2">
                       <i class="fas fa-calendar-alt text-danger"></i> Garanti Başlangıç Tarihi 
                       
                       <div class="input-group">
                         <div class="input-group-prepend"></div>
                         <input type="date" required class="form-control" value="<?=date("Y-m-d",strtotime($urun->garanti_baslangic_tarihi))?>" name="garanti_baslangic_tarihi" data-inputmask-alias="datetime" data-inputmask-inputformat="dd.mm.yyyy" data-mask="" inputmode="numeric">
                      </div>
                      </div>   </div>
                
                      <div class="col pr-0">
                        <div class="mt-2">
                        <i class="fas fa-calendar-alt text-danger"></i> Garanti Bitiş Tarihi 
                        <div class="input-group">
                          <div class="input-group-prepend"></div>
                          <input type="date" required class="form-control" value="<?=date("Y-m-d",strtotime($urun->garanti_bitis_tarihi))?>" name="garanti_bitis_tarihi" data-inputmask-alias="datetime" data-inputmask-inputformat="dd.mm.yyyy" data-mask="" inputmode="numeric">
                        </div>
                      </div>
                      </div>

                     


                      </div>
                    </div>
                   </div>
                 </div>
               </div>
             </div>



             
<div class="row pb-1  ">
  <div class="col">

  <h3 class="card-title p-0" style="font-weight: bolder;margin-bottom: 10px;">
    <i class="fas fa-folder-open" style="color: green;margin-left: 2px;"></i>
    Cihaza Ait Başlık Bilgileri  
  </h3>
  
  </div>
  <br>
  <div class="col text-right" style="display: contents;">

  <span style="font-weight:normal;opacity: 0.8; color:#003269;   font-size: 14px;">

  <i class="fas fa-exclamation-circle" style="
     
    color: #003269;
"></i>

    Toplam <?=count($basliklar)?> adet başlık listelenmiştir. Cihaza Tanımlı : [0], Ekstra Başlık : [0]</span>
  


  </div>

  
</div>

            
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


<div class="info-box" style="background:<?=($baslik->dahili_baslik)?'#ffffff':'#ffffff'?>;border:0px solid #164281;padding-right: 0px;margin-bottom: 5px;">
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





<br>

             
<div class="row pb-1  ">
  <div class="col">

  <h3 class="card-title p-0" style="font-weight: bolder;margin-bottom: 10px;">
    <i class="fas fa-plus-circle" style="color: green;margin-left: 2px;"></i>
    Yeni Başlık Tanımla
  </h3>
  
  </div>
  <br>
  <div class="col text-right" style="display: contents;">

  <span style="font-weight:normal;opacity: 0.8; color:#003269;   font-size: 14px;">

  <i class="fas fa-exclamation-circle" style="
     
    color: #003269;
"></i>
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