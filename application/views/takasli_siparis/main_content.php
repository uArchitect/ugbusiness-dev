<div class="content-wrapper mt-2">
    <section class="content col-md-12">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-gradient-danger text-white">
                <h3 class="card-title">
                    <i class="fas fa-exchange-alt"></i> UMEX Takaslı Sipariş
                </h3>  
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="takasSeriNumarasi" class="font-weight-bold">Takas Alınacak Umex Cihaz Seri Numarası</label>
                    <p class="text-muted ">Müşteriden takas olarak alınacak Umex cihaz seri numarasını giriniz.</p>
                    
                    <input type="text" class="form-control rounded-pill px-3 py-2"  style="font-size: 22px;"
                           id="takasSeriNumarasi" name="takas_seri_numarasi" maxlength="50" 
                           >
                    
                    <div class="border rounded p-3 mt-3 bg-light" style="font-size: 17px;">
                        <small class="d-block">
                            <span id="rule1" class="text-gray"><i id="icon1" class="fa fa-info-circle text-gray"></i> UG ile başlamalıdır.</span>
                        </small>
                        <small class="d-block">
                            <span id="rule2" class="text-gray"><i id="icon2" class="fa fa-info-circle text-gray"></i> UX01 ile bitmelidir.</span>
                        </small>
                        <small class="d-block">
                            <span id="rule3" class="text-gray"><i id="icon3" class="fa fa-info-circle text-gray"></i> 14 karakter uzunluğunda olmalıdır.</span>
                        </small>
                    </div>
                </div>
            </div>
            <div class="card-footer text-left">
                <a href="<?=base_url('teklif_form')?>" class="btn btn-danger rounded-pill px-4">
                    <i class="fa fa-search"></i> Cihaz Sorgula
                </a>
            </div>
        </div>
    </section>



 <section class="content col-md-6">
        <div class="card shadow-lg" style="border:1px solid greed;">
            
            <div class="card-body">
              <div class="row">
<div class="col-md-12">
<span class="text-danger" style="font-weight: 600;margin-bottom:10px;display:block"><i class="fa fa-info-circle text-danger"></i> TAKAS ALINACAK CİHAZ BİLGİLERİ</span>
            
</div>
              
                    <div class="col-md-12">
                        <div class="btn-group mb-2" style="display: flow;">
                            <button style="     padding-right: 0px;width: 100%;     border: 1px dashed #002355;padding-left:0px;" type="button" class="btn btn-default text-left pb-2">   
                                <div class="row">
                                    <div class="col" style="max-width: 87px;">
                                        <img src="https://www.umex.com.tr/uploads/products/umex-lazer.png" alt="..." style="width: 83px;" class="rounded img-thumbnail">
                                    </div>
                                    <div class="col" style="padding-left: 0px;">
                                        <span style="display: block;background: #dbdbdb;padding: 5px;color: white;border-radius: 5px;border-radius: 3px 3px 0 0;">
                                            <span style="min-width: 230px; width: 230px; display: inline-block; margin-left:5px">
                                                <b style="color:#0f3979">Umex Lazer / </b>
                                                <span style="color:black">UG22032201UX01</span>
                                            </span> 
                                        </span>
                                        <span style="height: 11px;"></span>
                                        <div style="padding-left:10px;background:white;border:1px solid;border-top:0px;border: 1px solid #dbdbdb; border-top: 0px; border-radius: 0px 0px 3px 3px;">
                                            <b>Garanti Bitiş : </b>
                                            22.03.2024     
                                            <br>
                                            Sipariş Kodu : 
                                            <a class="text-primary" style="cursor:pointer">
                                                <span style="opacity:0.5;color:black!important">Sistem Öncesi Kayıt</span>
                                            </a>
                                        </div>
                                    </div>
                                </div> 
                            </button>  
                            </div>
                        </div>

                        <div class="col-md-12">
<span class="text-success" style="font-weight: 600;margin-bottom:10px;margin-top:20px;display:block">YENİ SİPARİŞ BİLGİLERİNİ GİRİNİZ</span>
            
</div>


<div class="col-md-6">
<label for="formClient-Name">Ürün Seçiniz</label>
  
<select id="ekle_urun" class="select2urun form-control ">
            <?php 
               foreach ($urunler as $urun) {
                 ?><option value="<?=$urun->urun_id?>" data-example="/ <?=$urun->urun_aciklama?>"><?=$urun->urun_adi?></option><?php
               }

            ?>
           </select>       
</div>

<div class="col-md-6">
     <label   for="formClient-Name">Cihaz Renk</label>
  
<div id="urun_renk_div">
<select class="select2 form-control" style="opacity:0.6"  required="" min="1" id="odeme_secenegi" >
     <option value="">Önce Ürün Seçimi Yapınız</option>
             </select>
             </div>


           
     </div>

<div class="col-md-12">
     <label class="mt-2" for="formClient-Name">Cihaz Başlık</label>
  
     <div id="checkboxContainer" style="flex-wrap: wrap;margin-top:-5px;width: 100%;    display: flex;">
     <select class="select2 form-control" style="opacity:0.6"  required="" min="1" id="odeme_secenegi" >
     <option value="">Önce Ürün Seçimi Yapınız</option>
             </select>
       </div>
           
     </div>





<div class="col-md-12"> 
     <label for="formClient-Name" class="mt-2"><i class="fas fa-receipt text-danger"></i> Ödeme Seçeneği</label>
     <select class="select2 form-control"   required="" min="1" id="odeme_secenegi" >
     <option value="" selected>Seçim Yapılmadı</option>
       <option value="1">Peşin Satış</option>
       <option value="2">Vadeli Satış</option>
             </select>
             <div id="warningMessage"></div>
     </div>





           
     </div>





 
<div class="col-md-12"> 
     <label for="formClient-Name" class="mt-2"><i class="fas fa-calendar text-primary"></i> Vade Sayısı</label>
     <input type="number" onkeypress='validate(event)' inputmode="numeric"  min="0" max="20" class="form-control" value="0" id="vade_sayisi" required="" placeholder="Vade Giriniz..." autofocus="">

    
    </div>
<div class="row">
<div class="col-md-12"> 
     <label for="formClient-Name" class="mt-2"><i class="fas fa-money-bill text-success"></i> Takas Bedeli</label>
     <input type="text" onkeypress='validate(event)' inputmode="numeric" min="0"  class="form-control" id="takas_bedeli" pattern="^\₺\d{1,3}(,\d{3})*(\.\d+)?$" placeholder="Takas Bedelini Giriniz" value="" data-type="currency" required="" placeholder="Takas Bedelini Giriniz..." autofocus="">
    </div>

     <div class="col-md-6"> 
     <label for="formClient-Name" class="mt-2"><i class="fas fa-lira-sign text-orange"></i> Satış Fiyatı</label>
     <input type="text" onkeypress='validate(event)' inputmode="numeric" min="1" class="form-control" id="ekle_satis_fiyati" pattern="^\₺\d{1,3}(,\d{3})*(\.\d+)?$" placeholder="Satış Fiyatını Giriniz" value="" data-type="currency" required="" placeholder="Satış Fiyatı Giriniz..." autofocus="">
    </div>



    <div class="col-md-6"> 
     <label for="formClient-Name" class="mt-2"><i class="fas fa-money-bill text-primary"></i> Kapora Fiyatı</label>
     <input type="text" onkeypress='validate(event)' inputmode="numeric" min="1"  class="form-control" id="ekle_kapora_fiyati" pattern="^\₺\d{1,3}(,\d{3})*(\.\d+)?$" placeholder="Kapora Fiyatını Giriniz" value="" data-type="currency" required="" placeholder="Kapora Giriniz..." autofocus="">
    </div>

    <div class="col-md-6"> 
     <label for="formClient-Name" class="mt-2"><i class="fas fa-money-bill text-success"></i> Peşinat Fiyatı</label>
     <input type="text" onkeypress='validate(event)' inputmode="numeric" min="1"  class="form-control" id="pesinat_fiyati" pattern="^\₺\d{1,3}(,\d{3})*(\.\d+)?$" placeholder="Peşinat Fiyatını Giriniz" value="" data-type="currency" required="" placeholder="Peşinat Giriniz..." autofocus="">
    </div>

    <div class="col-md-6"> 
     <label for="formClient-Name" class="mt-2"><i class="fas fa-money-bill text-success"></i> Fatura Tutarı</label>
     <input type="number" onkeypress='validate(event)' inputmode="numeric" min="50000"  class="form-control" id="fatura_tutari"  placeholder="Fatura Tutarını Giriniz" value="" required="" autofocus="">
    </div>

    </div>

   


   
    <div class="col-md-12"> 
<label for="formClient-Name" class="mt-2"><i class="fas fa-pen text-warning"></i> Sipariş Notu</label>
   
<textarea name="siparis_notu" id="summernotesiparisnot"></textarea>
</div>

 
            </div>
            <div class="card-footer text-left">
                <a href="<?=base_url('teklif_form')?>" class="btn btn-success rounded-pill px-4" style="border: 2px solid #037903;">
                    <i class="fa fa-check"></i> Takaslı Sipariş Oluştur
                </a>
            </div>
        </div>
    </section>










    
</div>


<style>
    .card {
    border-radius: 10px;
    overflow: hidden;
}
.card-header {
    border-bottom: none; 
}
.card-footer {
    background: #f9f9f9;
}
.form-control { 
    border: 1px solid #ddd;
}
.form-control:focus {
    border-color: #dc3545;
    box-shadow: 0 0 2px rgba(220, 53, 69, 0.5);
}
.text-gray {
    color: #6c757d;
}
.text-success {
    color: #28a745;
}
.text-danger {
    color: #dc3545;
}
.bg-gradient-danger {
    background: linear-gradient(90deg, #e3342f, #dc3545);
}
.shadow-lg {
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
 width:100%;
 margin: 2px;
}


</style>
<script>
    document.getElementById('takasSeriNumarasi').focus();
    document.getElementById('takasSeriNumarasi').addEventListener('input', function() {
        const value = this.value.toLocaleUpperCase();  
        // Kurallar
        const startsWithUG = value.startsWith('UG');
        const endsWithUX01 = value.endsWith('UX01');
        const isFourteenChars = value.length === 14;

        // Kural 1: UG ile başlamalıdır
        const rule1 = document.getElementById('rule1');
        const icon1 = document.getElementById('icon1');
        rule1.className = startsWithUG ? 'text-success' : value ? 'text-danger' : 'text-gray';
        icon1.className = startsWithUG ? 'fa fa-check-circle text-success' : value ? 'fa fa-times-circle text-danger' : 'fa fa-info-circle text-gray';

        // Kural 2: UX01 ile bitmelidir
        const rule2 = document.getElementById('rule2');
        const icon2 = document.getElementById('icon2');
        rule2.className = endsWithUX01 ? 'text-success' : value ? 'text-danger' : 'text-gray';
        icon2.className = endsWithUX01 ? 'fa fa-check-circle text-success' : value ? 'fa fa-times-circle text-danger' : 'fa fa-info-circle text-gray';

        // Kural 3: 14 karakter uzunluğunda olmalıdır
        const rule3 = document.getElementById('rule3');
        const icon3 = document.getElementById('icon3');
        rule3.className = isFourteenChars ? 'text-success' : value ? 'text-danger' : 'text-gray';
        icon3.className = isFourteenChars ? 'fa fa-check-circle text-success' : value ? 'fa fa-times-circle text-danger' : 'fa fa-info-circle text-gray';
    });
</script>






<script src="https://code.jquery.com/jquery-1.12.4.min.js"   integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="   crossorigin="anonymous"></script>


<script>

$(document).ready(function(){
   $('#ekle_urun').on('change', function(e){
     var urun_id = $(this).val();
   
     


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



 
    </script>