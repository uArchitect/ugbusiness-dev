  
 <div class="content-wrapper"> 
   <section class="content col  ">
     <div class="card card-dark" style=" ">
       <div class="card-header with-border" style="background:#061f3a">
         <h3 class="card-title text-center"> UG Business - Başlık Bilgilerini Düzenle</h3>
      
     
       </div>
       <form class="form-horizontal" method="POST" action="<?php echo site_url('baslik/save').'/'.$baslik->urun_baslik_tanim_id;?>">
         <div class="card-body p-0">
           <div class="row" style="background:#081f39;height: 269px;">
             <div class="col-4 text-left" style="height: 269px;padding: 0;" style="width:150px">
               <span class="badge bg-dark text-md p-4" style="    height: -webkit-fill-available;width: inherit;flex:1;font-weight:500;border-radius:0px;background:#00142c!important;border: 0px solid #00274f;">
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


             <a href="<?=base_url("musteri/duzenle/").$merkez->merkez_id?>" type="button" class="btn  btn-dark" style="border:2px solid white;border-radius: 50px; padding: 8px;width: max-content!important;background: #061f3a;width: -webkit-fill-available;">
                 <i class="fas fa-pen"></i> Müşteri Düzenle </a>
             
                  </div>
             <div class="col-4 text-center" style="border-width: 12px;   border-color: #004ac1; "> 
       
                    
               <img src="
												<?=base_url("uploads/".$baslik->baslik_resim)?>" style="    margin-top: 5px;" alt="" height="248">
                        <br>
                        
                        <br>

                        </div>
             <div class="col-4 text-left" style="padding: 0;">
               
             
             
             
             <span class="badge bg-warning text-md p-4" style=" height: 269px;display: block;font-weight:500;border-radius:0px;color:white!important;background:#00142c!important;border: 0px solid #093d7d;">
                 <div style="height:30px"></div>
                 <i class="fa fa-building" style="font-size: 55px;color:#ffffff"></i>
                 <br>
                 <br>
                 <b> <?=mb_strtoupper($merkez->merkez_adi)?> </b>
                 <br>
                 <span style="font-weight:300;margin-top:0px;padding:5px; line-height: initial;   text-wrap: balance;" class="d-block text-sm">
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
  

<div style="background: #0067f50f;
    border: 2px dashed #083a75;" class="p-2">
<div style="background: #ffffe2; padding: 10px; color: #ab6800; margin-top: 0px; margin-bottom: 5px; border: 2px solid #ffbc007d; border-radius: 5px;">
     <span><i class="fas fa-exclamation-circle" style="
    margin-right: 4px;
    color: #f5a100;
"></i>Cihazın garanti süresi değiştirildiğinde cihaza tanımlı olan diğer başlıkların da garanti süresi eşitlenir. Harici olarak satın alınan başlıkların garanti süresi manuel değiştirilmelidir.</span>
 </div>
<div class="timeline mb-0">
              
             <div style="margin-right:0px">
                 <i class="fas fa-envelope bg-blue"></i>
                 <div class="timeline-item">
                   <div class="timeline-body"style="    color: black;border-radius:5px;border:0px solid #164281">
                   <div class="row">
                    <div class="col col-6 pl-0">
                   <i class="fas fa-pen text-success"></i> Başlık Tanımı
                     <input type="text" disabled  value="<?=$baslik->baslik_adi?>" class="form-control mb-2" placeholder="">
</div><div class="col col-6 pr-0">
                    <i class="fas fa-box text-orange"></i> Cihaz Adı
                     <input type="text" disabled  value="<?=$urun->urun_adi?>" class="form-control mb-2" placeholder="">
                     </div> 


<div class="col col-6 pl-0">



                   <i class="fas fa-qrcode text-primary"></i> Başlık Seri Numarası 
                     <input type="text" required name="seri_numarasi" value="<?=$baslik->baslik_seri_no?>" class="form-control" placeholder="Başlık Seri Numarasını Giriniz">
                     </div> 

                   



<div class="col col-6 pr-0">
<i class="fas fa-question text-primary"></i> Başlık / Cihaz Tanımı 
<select class="select2 form-control rounded-0" name="dahili_baslik">
          <option <?php echo ($baslik->dahili_baslik == "1") ? 'selected' : '' ;?>  value="1">Cihaza Tanımlı Başlık (Garanti Süresi Otomatik Eşitlenir)</option>
          <option <?php echo ($baslik->dahili_baslik == "0") ? 'selected' : '' ;?> value="0">Ekstra Başlık (Garanti Süresi Otomatik Eşitlenmez)</option>
       </select>


   </div> 



                     
                   </div>
                     <div class="row">
                    <div class="col pl-0">
                      <div class="mt-2">
                       <i class="fas fa-calendar-alt text-danger"></i> Başlık Garanti Başlangıç Tarihi <div class="input-group">
                         <div class="input-group-prepend"></div>
                         <input type="date" required class="form-control" value="<?=date("Y-m-d",strtotime($baslik->baslik_garanti_baslangic_tarihi))?>" name="garanti_baslangic_tarihi" data-inputmask-alias="datetime" data-inputmask-inputformat="dd.mm.yyyy" data-mask="" inputmode="numeric">
                      </div>
                    </div>
                  </div>
                      <div class="col pr-0">
                      <div class="mt-2">
                       <i class="fas fa-calendar-alt text-danger"></i> Başlık Garanti Bitiş Tarihi <div class="input-group">
                         <div class="input-group-prepend"></div>
                         <input type="date" required class="form-control" value="<?=date("Y-m-d",strtotime($baslik->baslik_garanti_bitis_tarihi))?>" name="garanti_bitis_tarihi" data-inputmask-alias="datetime" data-inputmask-inputformat="dd.mm.yyyy" data-mask="" inputmode="numeric">
                       </div>
                     </div>

                      </div>
                    </div>
                   </div>
                 </div>
               </div>
             </div>










         </div>
</div>


           
         </div>
        
         <div class="card-footer" style="padding: 7px;">
           <div class="row p-0">
             <div class="col text-center" style="padding-right: 0;">
               <button type="submit" style="width: -webkit-fill-available;" class="btn  btn-success">
                 <i class="fas fa-save"></i>
                 Değişiklikleri Kaydet
                </button>
              
             </div>

             <div class="col text-center" style="padding-left:5px;">
               
               <a href="<?=base_url("cihaz")?>" style="width: -webkit-fill-available;" class="btn  btn-danger">
                <i class="fas fa-times-circle"></i> İptal Et / Geri Dön
               </a>
             </div>


           </div>
         </div>
         
       </form>
     </div>
      
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