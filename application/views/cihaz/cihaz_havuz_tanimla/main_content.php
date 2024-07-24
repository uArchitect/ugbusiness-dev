<script src="https://ugmanager.com.tr/html5-qrcode.min.js?v=1"></script>
 <style>
::placeholder {
  color: black!important;
  opacity: 1!important;; /* Firefox */
}

::-ms-input-placeholder { /* Edge 12-18 */
  color: black!important;;
}

#reader {
            width: 300px;
            margin: auto;
        }
        #html5-qrcode-anchor-scan-type-change{
            display: none;
        }
#html5-qrcode-select-camera{
    display: block;
    margin: auto;
    margin-top: 10px;
    margin-bottom: 10px;
}
        #qr-reader > div:first-of-type {
    display: none;
}

  </style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Yeni Cihaz Tanımlama Formu</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url()?>">Giriş</a></li>
              <li class="breadcrumb-item active">Yeni Cihaz Tanımlama Formu</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<section class="content col-md-12">
<div class="card card-primary" >
    <div class="card-header with-border" style="background:#050e65;">
      <h3 class="card-title"> Cihaz Bilgileri</h3>
     
     
    </div>

    <form class="form-horizontal" method="POST" action="<?php echo site_url('cihaz/cihaz_havuz_tanimla_save');?>">

    <div class="card-body">
<div class="row">
      <div class="form-group col-md-4 pr-0 pl-0 mb-1">
        <label for="formClient-Code"> Cihaz</label>
        
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <select name="cihaz_id" id="ekle_urun" required class="select2 form-control rounded-0" style="width: 100%;">
        <option  value="">Cihaz Seçimi Yapınız</option>
        <?php foreach($cihazlar as $cihaz) : ?> 
                    <option  value="<?=$cihaz->urun_id?>"><?=$cihaz->urun_adi?></option>
          <?php endforeach; ?>  
                  </select>      
      </div>

 
      <div class="form-group col-md-4 pr-2 pl-2 pr-0 pl-0 pb-1">
        <label for="formClient-Name"><i class="fas fa-swatchbook text-primary"></i> Renk</label>
     
   <div id="urun_renk_div">
   <select class="select2 form-control rounded-0" style="width: 100%;">
     
      
                  </select> 
                </div>


              
        </div>

      <div class="form-group col-md-4 pr-0 pl-0 mb-1">
        <label for="formClient-Name">Cihaz Seri Numarası</label>
        <label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>
        <input type="text" class="form-control" name="cihaz_seri_numarasi" required="" placeholder="Seri No Giriniz..." autofocus="">
       </div>

       </div>




       

<div style="border: 2px dotted #00096b;">


<div id="featureContainer" class="row" style="background: #ffffff; "></div>



<div style="margin:5px;    margin-top: 5px !important;padding:5px;background: #2196f33d;color: #001aa1;margin-top: 0px;margin-bottom: 5px;border: 2px solid #3F51B5;border-radius: 5px;">
     <span style="font-size:15px!important;"><i class="fas fa-exclamation-circle" style="
    margin-right: 4px;
    color: #2196F3;
"></i> 
<b>Son Okutulan Seri Numarası :</b>
<span id="son_okutulan_seri_no">Henüz okutma işlemi yapılmadı...</span></span>
 </div>

 </div>

    </div>









    <!-- /.card-body -->

    <div class="card-footer">
      <div class="row">
        
        <div class="col text-right"><button type="submit" class="btn btn-flat btn-primary"> Kaydet</button></div>
      </div>
    </div>
    <!-- /.card-footer-->










    </form>
  </div>
            <!-- /.card -->
</section>
            </div>

         















            <script src="https://code.jquery.com/jquery-1.12.4.min.js"   integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="   crossorigin="anonymous"></script>







            <script>


function enterMethod() {
   var event = document.getElementById("qrinput");
   event.value = event.value.replace(/\s/g,'');
       const qrInput = event;
       const qrData = qrInput.value;
 
       $.ajax({
         url: '<?= base_url('stok/stok_seri_no_kontrol') ?>',
         method: 'POST',
         data: {seri_numarasi: qrData},
         success: function(response) {
           var features = JSON.parse(response);
           //alert(response);
                 if (features.stok_durumu == 1) {
                   Swal.fire({
                     icon: "error",
                     title: "Stok Uyarısı...",
                     text: "Bu stok parçası başka cihaza tanımlanmış olduğu için bu cihaza tanımlanamaz!" 
                   }); 
                   if(document.getElementById("qrinput")){
         document.getElementById("qrinput").value="";
       } 
                 }else if (features.stok_durumu == 2) {
                   Swal.fire({
                     icon: "error",
                     title: "Stok Bulunamadı...",
                     text: "Bu seri numaralı parça stok bilgilerinde bulunamadı. Stok yetkiliniz ile iletişime geçiniz.!" 
                   });
                   if(document.getElementById("qrinput")){
                       document.getElementById("qrinput").value="";
                     }  
                 } else{
                   assignQRDataToInputs(qrData.replace(" ",""));
 
                   if (features.alt_parcalar){
                     features.alt_parcalar.forEach(element => {
                       console.log(element.stok_seri_kod);
                       assignQRDataToInputs(element.stok_seri_kod.replace(" ",""));
 
                     });
                   }
                 }
             },
             error: function(xhr, status, error) {
                 alert('Bir hata oluştu. Lütfen tekrar deneyin.');
             }
       });
 
 
       // Enter tuşuna basıldığında formun gönderilmesini engelle
       event.preventDefault();
   }




    var lastResult;
    
 
    function onScanSuccess(decodedText, decodedResult) {
        if (decodedText !== lastResult) {
            lastResult = decodedText;
            // SweetAlert modalini kapat ve sonucu textbox'a yazdır
            Swal.close();
            document.getElementById('qrinput').value = decodedText;
            enterMethod();
            // Kamerayı durdur
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
    </script>











            <script>
        $(document).ready(function() {
          function capitalize(s)
{
    return s[0].toUpperCase() + s.slice(1).toLowerCase();
}


            $('#ekle_urun').change(function() {
                var productId = $(this).val();
                if (productId) {
                    $.ajax({
                        url: '<?= base_url('stok/get_cihaz_stok_tanimlari/') ?>' + productId,
                        method: 'GET',
                        success: function(response) {
                            var features = JSON.parse(response);
                            $('#featureContainer').empty();
                            
 $('#featureContainer').append(
                                    '<div class="col-md-12" style="font-weight: 600;padding: 7px;background: #dddddd;color: #071063;margin-bottom: 10px;">Stok Kayıtlarını Tanımla</div>'
                                );
                                $('#featureContainer').append(
                                  '<div class="input-group col-md-12" style="padding-left:10px;padding-right:10px">' +
                                  '<div class="input-group-prepend" >' +
                                         '<span class="input-group-text" onclick="openQrScanner()" style="    background: #071063;color: white;"><i class="fas fa-qrcode"></i></span></div>' +
                                  
                                         '<input id="qrinput" onkeydown="handleKeyDown(event)" type="text" class="form-control" style="background: #fdffb9;" placeholder="Barkod tarayıcınız kullanarak QR okutunuz veya parça seri numarasını giriniz...">' +
                                    '</div>'
                                );
                              


 






                            features.forEach(function(feature) {
                                $('#featureContainer').append(
                                    '<div class="form-group col-md-3 p-2" style="padding-left:10px;padding-right:10px">' +
                                        '<label style="margin-left: 10px;margin-right:5px;" for="ABC' + feature.cihaz_stok_id + '">' + capitalize(feature.stok_tanim_ad)+ '</label>' +
                                        '<label for="formClient-Name" style="font-weight:normal;  opacity:0.5; ">(*Zorunlu)</label>'+
                                      
                                   
                                        '<div class="input-group col-md-12" style="padding-left:10px;padding-right:10px">' +
                                  '<div class="input-group-prepend" >' +
                                         '<span class="input-group-text" style="  border: 1px solid #cfcfcf;  background: #e7e7e7; color: black;"><i class="fas fa-cube"></i></span></div>' +
                                  
                                         '<input type="text" style="font-size: small;background:#ffdada80;" name="parca_seri_numaralar[]" class="form-control A'+feature.stok_tanim_grup_kod.replace(".","")+feature.stok_tanim_prefix+'" placeholder="' +feature.stok_tanim_grup_kod+"/"+feature.stok_tanim_prefix+'-'+ capitalize(feature.stok_tanim_ad) + '">' +
                                    '</div>'+
                                   
                                   
                                        '</div>'
                                );
                            });
                        
                         
                        }
                    });
                } else {
                    $('#featureContainer').empty();
                }
            });
        });
    </script>











<script>
 
  function assignQRDataToInputs(qrData) {
    let dataresult = "";
    if(qrData.startsWith("01.034/LM")){
      dataresult = "01.034/LM";
     
    }else{
      dataresult = qrData.substring(0, qrData.length - 10);
    } 
    const prefix = dataresult.toUpperCase().replace(/\s/g,'').replace(".","").replace("/","");

    
    const inputs = document.querySelectorAll(`.A${prefix}`);
   
    document.getElementById("son_okutulan_seri_no").innerHTML = qrData;
    
    if (inputs.length > 1) {
      let emptyInput = null;
      var count = 0;
      var tekrar = 0;
      
      inputs.forEach(input => {
        if(input.value==qrData){
          Swal.fire({
            icon: "error",
            title: "Tekrar Okutma Hatası...",
            text: "Bu QR kod zaten okutuldu!" 
          }); 
          tekrar = 1;
          return;
        }
      });
      if(tekrar == 0)
      {
        inputs.forEach(input => {
          if (!input.value) {
            count++;
            if(count==1){
              input.value = qrData;
              input.style.background="#00650c"; 
              input.style.color="#ffffff";
              input.style.borderColor="green";
              return;
            } 
          }
        });
      }

      if(document.getElementById("qrinput")){
        document.getElementById("qrinput").value="";
      }
      event.preventDefault();
      } 
      else if(inputs.length == 1){
        inputs[0].value = qrData;
        inputs[0].style.background="#00650c"; 
        inputs[0].style.color="#ffffff";
        inputs[0].style.borderColor="green";
        if(document.getElementById("qrinput")){
          document.getElementById("qrinput").value="";
        }
        event.preventDefault();
      }
    
    
    else {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Okutulan Qr barkod bu cihaz için tanımlanmamış!" 
      });
      if(document.getElementById("qrinput")){
        document.getElementById("qrinput").value="";
      } 
    }
    if(document.getElementById("qrinput")){
        document.getElementById("qrinput").value="";
      }
  }
 
  function handleKeyDown(event) {
    if (event.value.length > 10) {
      if (event.value.endsWith('/')) {
        alert(event.value);
        event.value =  event.value.slice(0, -1);
        event.preventDefault();
        enterMethod();
    }
    }

    if (event.key === 'Enter') { 
    
      event.preventDefault();
      enterMethod();
    }
  }



 



  
</script>









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
				});	});	});     </script>
