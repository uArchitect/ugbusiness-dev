<div class="content-wrapper">

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
     <input type="number" onkeypress='validate(event)' inputmode="numeric"  min="0" max="20" class="form-control" value="0" id="vade_sayisi" required="" placeholder="Vade Giriniz..." autofocus="">

    
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
     <input type="number" onkeypress='validate(event)' inputmode="numeric" min="50000"  class="form-control" id="fatura_tutari"  placeholder="Fatura Tutarını Giriniz" value="" required="" autofocus="">
    </div>



    <div class="form-group col-md-6 pr-1 pl-1">
     <label for="formClient-Name"><i class="fas fa-money-bill text-success"></i> Takas Bedeli</label>
     <input type="text" onkeypress='validate(event)' inputmode="numeric" min="0"  class="form-control" id="takas_bedeli" pattern="^\₺\d{1,3}(,\d{3})*(\.\d+)?$" placeholder="Takas Bedelini Giriniz" value="" data-type="currency" required="" placeholder="Takas Bedelini Giriniz..." autofocus="">
    </div>


    <div class="form-group col-md-6 pr-1 pl-1">
     <label for="formClient-Name"><i class="fa fa-box text-dark"></i> Takas Cihaz Seri Kod</label>
     <input type="text" class="form-control" id="takas_alinan_seri_kod" placeholder="Takas Cihaz Serikod Giriniz" value="" autofocus="">
    </div>
    <div class="form-group col-md-6 pr-1 pl-1">
     <label for="formClient-Name"><i class="fa fa-box text-dark"></i> Takas Cihaz Model</label>
     
     <select class="select2 form-control" id="takas_alinan_model" required> 
     <option value="">SEÇİM YAPINIZ</option> 
     <option value="0">TAKAS YOK</option> 
     <option value="UMEX">UMEX</option>
       <option value="ROBOTX">ROBOTX</option>
       <option value="DIGER">DIGER</option>
   </option>
     </select>
   
   
   </div>
    <div class="form-group col-md-6 pr-1 pl-1">
     <label for="formClient-Name"><i class="fa fa-box text-dark"></i> Takas Cihaz Renk</label>
     <input type="text" class="form-control" id="takas_alinan_renk" placeholder="Takas Cihaz Renk Giriniz" value="" autofocus="">
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

         </div>
   </form>

</div>