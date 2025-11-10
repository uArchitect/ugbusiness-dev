<script src="https://ugmanager.com.tr/html5-qrcode.min.js?v=1"></script>
 
 
<div class="content-wrapper">
     
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Yeni Cihaz Tanımlama Formu</h1>
          </div> 
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url()?>">Giriş</a></li>
              <li class="breadcrumb-item active">Yeni Cihaz Tanımlama Formu</li>
            </ol>
          </div> 
        </div> 
      </div> 
    </div>
    
<section class="content col-md-6">
<div class="card card-primary">
    <div class="card-header with-border">
      <h3 class="card-title"> Cihaz Bilgileri</h3>
     
     
    </div>

    <form class="form-horizontal" method="POST" action="<?php echo site_url('cihaz/cihaz_havuz_tanimla_updatesave/'.$cihaz->cihaz_havuz_id);?>">

    <div class="card-body">

      <div class="form-group">
        <label for="formClient-Code"> Cihaz</label>
        
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <select name="cihaz_id" id="ekle_urun" required class="select2 form-control rounded-0" style="width: 100%;">
        <option  value="">Cihaz Seçimi Yapınız</option>
        <?php foreach($cihazlar as $ci) : ?> 
                    <option  value="<?=$ci->urun_id?>" <?=($cihaz->cihaz_kayit_no == $ci->urun_id) ? "selected":""?>><?=$ci->urun_adi?></option>
          <?php endforeach; ?>  
                  </select>      
      </div>

 
      <div class="form-group col-md-6 pr-0 pl-0 mb-1">
        <label for="formClient-Name"><i class="fas fa-swatchbook text-primary"></i> Renk</label>
     
   <div id="urun_renk_div">
   <select name="ekle_renk" id="ekle_renk" class="select2 form-control rounded-0">
   <?php foreach($renkler as $renk) : ?> 
                    <option  value="<?=$renk->renk_id?>" <?=($cihaz->cihaz_renk_no == $renk->renk_id) ? "selected":""?>><?=$renk->renk_adi?></option>
          <?php endforeach; ?>  
        </select>
                </div>


              
        </div>

      <div class="form-group">
        <label for="formClient-Name">Cihaz Seri Numarası</label>
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <input type="text" class="form-control" name="cihaz_seri_numarasi" required="" value="<?=$cihaz->cihaz_havuz_seri_numarasi?>" placeholder="Seri No Giriniz..." autofocus="">
       </div>

       
     


    </div>







 
    <div class="card-footer">
      <div class="row">
        
        <div class="col text-right"><button type="submit" class="btn btn-flat btn-primary"> Kaydet</button></div>
      </div>
    </div> 

    </form>
  </div>
            

            <div class="card card-dark">
            <div class="card-header">Parça Değişim - Tanımlama</div>
            <div class="card-body">
            <form id="myForm" action="<?=base_url("cihaz/cihaz_havuz_tanimla_stok_kaydet/".$cihaz->cihaz_havuz_id)?>" method="POST">
       <div class="form-group" >
        <label for="formClient-Name">Yeni Parça Tanımla</label> 
        <div class="input-group col-md-12 p-0" style="">
        <div class="input-group-prepend">
          <span class="input-group-text" onclick="openQrScanner()" style="background: #071063;color: white;">
            <i class="fas fa-qrcode"></i>
          </span>
        </div>
        <input id="qrinput" onkeydown="handleKeyDown(event)" type="text" class="form-control" name="havuz_parca_seri_no" style="background: #fdffb9;" placeholder="Barkod tarayıcınız kullanarak QR okutunuz veya parça seri numarasını giriniz...">
      </div>
       </div>
       </form>


                 
<?php 

foreach ($stoklar as $stok) {
 ?>
<div class="form-group mt-2">
        <label for="exampleInputFile"><?=$stok->stok_tanim_ad?> / <span class="text-danger" style="font-weight:normal"><b>Tanımlama Tarihi :</b> <?=(date("d.m.Y H:i",strtotime($stok->cihaz_tanimlama_tarihi)) == "25.07.2024 09:54") ? "-" : date("d.m.Y H:i",strtotime($stok->cihaz_tanimlama_tarihi) )?></span></label>
        <div class="input-group input-group-xl">
        <div class="input-group-prepend">
<span class="input-group-text"><i class="fas fa-microchip"></i></span>
</div>
<input type="text" disabled value="<?=$stok->stok_seri_kod?>" class="form-control">
<span class="input-group-append">
<button type="button" onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu stoğun <?=$cihaz->cihaz_havuz_seri_numarasi?> seri numaraları cihaz tanımı sıfırlanacaktır ? İlgili stok daha sonra başka cihaza tanımlanmak üzere beklemeye alınacaktır. İşlemi onaylıyor musunuz ?','Onayla','<?=base_url('cihaz/cihaz_havuz_stok_sil/').$stok->stok_id?>');" class="btn btn-danger btn-flat" style="    border-radius: 0 5px 5px 0;">Kayıt Sil</button>
</span>
</div>
      </div>
 <?php
}

?>


            </div>
            </div>
</section>
            </div>

         

<script>
function formatBarkod(barkod) {
     
    if (barkod.endsWith('/')) {
        barkod = barkod.slice(0, -1);
    
    
    
    let firstLetterIndex = barkod.search(/[A-Za-z]/);
    
    if (firstLetterIndex !== -1) {
        return barkod.slice(0, firstLetterIndex) + '/' + barkod.slice(firstLetterIndex);
    }
  }
    
    return barkod;
}


document.getElementById("myForm").onsubmit = function(event) {
    event.preventDefault();
};


  let str = '';
let timer = null;
  function handleKeyDown(event) {

    
    if (timer) {
        clearTimeout(timer);
        
    }
    timer = setTimeout(() => {
      document.getElementById("qrinput").value=formatBarkod(document.getElementById("qrinput").value);
      document.getElementById('myForm').submit();
    }, 500);


  }
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
				});	});	});     
        
        
        
        
        
        
        var lastResult;
    
 
    function onScanSuccess(decodedText, decodedResult) {
        if (decodedText !== lastResult) {
            lastResult = decodedText;
            
            Swal.close();
            document.getElementById('qrinput').value = decodedText;
            document.getElementById("qrinput").value=formatBarkod(document.getElementById("qrinput").value);
            document.getElementById('myForm').submit();
           
            if (html5QrcodeScanner) {
                html5QrcodeScanner.clear().then(() => {
                    console.log('QR kod okuyucu durduruldu.');
                }).catch((err) => {
                    console.error('QR kod okuyucu durdurulamadı: ', err);
                });
            }
        }
    }

    var html5QrcodeScanner;

    function openQrScanner() {
        Swal.fire({
            title: 'QR Kod Okutunuz',
            html: '<div id="qr-reader" style="width:100%;"></div>',
            confirmButtonText: "KAPAT",  
            confirmButtonColor: '#DD6B55',
            didOpen: () => {
                html5QrcodeScanner = new Html5QrcodeScanner(
                    "qr-reader", { fps: 10, qrbox: 250 });
                html5QrcodeScanner.render(onScanSuccess);
            },
            willClose: () => {
                if (html5QrcodeScanner) {
                    html5QrcodeScanner.clear().then(() => {
                        console.log('QR kod okuyucu durduruldu.');
                    }).catch((err) => {
                        console.error('QR kod okuyucu durdurulamadı: ', err);
                    });
                }
            }
        });
        document.querySelector('#html5-qrcode-button-camera-permission').value=("QR Okuyucuyu Aç");
    }
        
        
    window.onload = function() {
    document.getElementById('qrinput').focus();
};
        
        
        </script>