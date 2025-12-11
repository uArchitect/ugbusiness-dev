<?php $this->load->view('uretim/includes/styles'); ?>

<div style="background:green;display:none;"></div>
<script src="https://ugmanager.com.tr/html5-qrcode.min.js?v=1"></script>
<style>
#featureContainer ::placeholder {
  color: black!important;
  opacity: 1!important;;  
}

::-ms-input-placeholder {  
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

<div class="content-wrapper content-wrapper-uretim">
  <section class="content pr-0">
    <div class="row">
      <div class="col-12">
        <div class="card card-uretim">
          <!-- Card Header -->
          <div class="card-header card-header-uretim">
            <div class="d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3 card-header-icon-wrapper">
                  <i class="fas fa-plus-circle card-header-icon"></i>
                </div>
                <div>
                  <h3 class="mb-0 card-header-title">
                    Yeni Cihaz Tanımlama
                  </h3>
                  <small class="card-header-subtitle">Cihaz havuzu için yeni kayıt oluştur</small>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Modern Tab Navigation Bar -->
          <?php $this->load->view('uretim/includes/tabs'); ?>
          
          <!-- Card Body -->
          <div class="card-body card-body-uretim">
            <div class="card-body-content" style="padding: 15px;">
              <form onsubmit="return validateInput()" class="form-horizontal" method="POST" action="<?php echo site_url('cihaz/cihaz_havuz_tanimla_save');?>">
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group pr-0 pl-0 mb-1">
                      <label for="formClient-Code">Cihaz</label>
                      <label for="formClient-Name" style="font-weight:normal; opacity:0.5;">(*Zorunlu)</label>
                      <select name="cihaz_id" id="ekle_urun" onchange="updateInputDataParametre()" required class="select2 form-control rounded-0" style="width: 100%;">
                        <option value="" data-val="0">Cihaz Seçimi Yapınız</option>
                        <?php foreach($cihazlar as $cihaz) : ?> 
                          <option value="<?=$cihaz->urun_id?>" data-val="<?=$cihaz->bitis_kod?>"><?=$cihaz->urun_adi?></option>
                        <?php endforeach; ?>  
                      </select>      
                    </div>

                    <div class="form-group mt-3 pr-0 pl-0 pb-1">
                      <label for="formClient-Name"><i class="fas fa-swatchbook text-primary"></i> Renk</label>
                      <div id="urun_renk_div">
                        <select class="select2 form-control rounded-0" style="width: 100%;"></select> 
                      </div>
                    </div>

                    <div class="form-group pr-0 pl-0 mb-1">
                      <label for="formClient-Code">Yenilenmiş Cihaz Mı ?</label>
                      <label for="formClient-Name" style="font-weight:normal; opacity:0.5;">(*Zorunlu)</label>
                      <select name="yenilenmis_urun_mu" onchange="updateInputDataParametre()" id="yenilenmis_urun_mu" required class="select2 form-control rounded-0" style="width: 100%;">
                        <option value="">Seçim Yapınız</option>
                        <option value="1">EVET</option>
                        <option value="0">HAYIR</option>
                      </select>      
                    </div>

                    <div class="form-group pr-0 pl-0 mb-1">
                      <label for="formClient-Name">Cihaz Seri Numarası</label>
                      <label for="formClient-Name" style="font-weight:normal; opacity:0.5;">(*Zorunlu)</label>
                      <input type="text" oninput="this.value = this.value.toUpperCase();validateInput();" class="form-control" data-parametre="0" name="cihaz_seri_numarasi" id="cihaz_seri_numarasi" required="" placeholder="Seri No Giriniz..." autofocus="">
                      <p id="validationMessage"></p>
                    </div>
                  </div>

                  <div class="col-md-9">
                    <div style="border: 2px dotted #00096b;">
                      <div id="featureContainer" class="row" style="background: #ffffff;"></div>
                      <div style="margin:5px; margin-top: 5px !important;padding:5px;background: #2196f33d;color: #001aa1;margin-top: 0px;margin-bottom: 5px;border: 2px solid #3F51B5;border-radius: 5px;">
                        <span style="font-size:15px!important;">
                          <i class="fas fa-exclamation-circle" style="margin-right: 4px;color: #2196F3;"></i> 
                          <b>Son Okutulan Seri Numarası :</b>
                          <span id="son_okutulan_seri_no">Henüz okutma işlemi yapılmadı...</span>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card-footer">
                  <div class="row">
                    <div class="col text-right">
                      <button type="submit" class="btn btn-flat btn-primary">Kaydet</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script>
function updateInputDataParametre() {
  const selectElement = document.getElementById('ekle_urun');
  const yenilenmis_data = document.getElementById('yenilenmis_urun_mu').value;
  const selectedOption = selectElement.options[selectElement.selectedIndex];
  const selectedDataVal = selectedOption.getAttribute('data-val');
  const inputElement = document.getElementById('cihaz_seri_numarasi');
  inputElement.setAttribute('data-parametre', selectedDataVal);
  inputElement.placeholder = `UGXXXXXXXXXX${selectedDataVal}`;
  
  if(inputElement.value != ""){
    validateInput();
  }else{
    const dataParametre = inputElement.getAttribute('data-parametre');
    validationMessage.textContent = "14 karakter olmalı, UG ile başlamalı ve "+((yenilenmis_data == 1) ? "UY01" : dataParametre)+" ile bitmelidir.";
    validationMessage.style.color = "orange";
  }
}

function validateInput() {
  const inputElement = document.getElementById('cihaz_seri_numarasi');
  const inputValue = inputElement.value;
  const dataParametre = inputElement.getAttribute('data-parametre');
  const validationMessage = document.getElementById('validationMessage');
  const yenilenmis_data = document.getElementById('yenilenmis_urun_mu').value;
  
  if(dataParametre != "0"){
    if(yenilenmis_data == 1){
      if (inputValue.length === 14 && inputValue.startsWith('UG') && inputValue.endsWith("UY01")) {
        validationMessage.textContent = "Giriş geçerli!";
        validationMessage.style.color = "green";
        return true;  
      } else {
        if(yenilenmis_data == ""){ 
          alert("Yenilenmiş Cihaz Bilgisini Belirtiniz.");
          return false; 
        }
        if(inputElement.value == ""){ 
          validationMessage.textContent = "14 karakter olmalı, UG ile başlamalı ve UY01 ile bitmelidir.";
          validationMessage.style.color = "orange";
          return false; 
        }else{
          validationMessage.textContent = "Giriş geçersiz! 14 karakter olmalı, UG ile başlamalı ve UY01 ile bitmelidir.";
          validationMessage.style.color = "red";
          return false; 
        }
      }
    }else{
      if (inputValue.length === 14 && inputValue.startsWith('UG') && inputValue.endsWith(dataParametre)) {
        validationMessage.textContent = "Giriş geçerli!";
        validationMessage.style.color = "green";
        return true;  
      } else {
        if(inputElement.value == ""){
          const dataParametre = inputElement.getAttribute('data-parametre');
          validationMessage.textContent = "14 karakter olmalı, UG ile başlamalı ve "+dataParametre+" ile bitmelidir.";
          validationMessage.style.color = "orange";
          return false; 
        }else{
          validationMessage.textContent = "Giriş geçersiz! 14 karakter olmalı, UG ile başlamalı ve "+dataParametre+" ile bitmelidir.";
          validationMessage.style.color = "red";
          return false; 
        }
      }
    }
  }else{
    return true;  
  }
}
</script>

<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>

<script>
var sound_basarili = 'https://ugbusiness.com.tr/assets/dist/stok-kodu-tanimlandi.m4a';
var sound_baska_cihaz = 'https://ugbusiness.com.tr/assets/dist/baska-cihaza-tanimli.m4a';
var sound_bulunamadi = 'https://ugbusiness.com.tr/assets/dist/stok-bulunamadi.m4a';
var sound_tekrar_okutma = 'https://ugbusiness.com.tr/assets/dist/tekrar-okutma-hatasi.m4a';
var sound_tanimlanmamis = 'https://ugbusiness.com.tr/assets/dist/tanimlanmamis.m4a';
var onaygerekmektedir = 'https://ugbusiness.com.tr/assets/dist/onaygerekmektedir.mp3';

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
      
      if (features.stok_durumu == 1) {
        (new Audio(sound_baska_cihaz)).play();
        if(document.getElementById("qrinput")){
          document.getElementById("qrinput").value="";
        } 
      }else if (features.stok_durumu == 2) {
        (new Audio(sound_bulunamadi)).play();
        
        // Debug bilgilerini console'a yazdır
        if (features.debug) {
          console.log('=== DEBUG BİLGİLERİ ===');
          console.log('Seri No:', features.debug.seri_no);
          console.log('Direct Query Count:', features.debug.direct_query_count);
          console.log('Model Query Count:', features.debug.model_query_count);
          console.log('Direct Query SQL:', features.debug.direct_query_sql);
          console.log('Direct Result:', features.debug.direct_result);
          console.log('Model Result:', features.debug.model_result);
          console.log('Full Debug Object:', features.debug);
          console.log('Full Response:', features);
        }
        
        if(document.getElementById("qrinput")){
          document.getElementById("qrinput").value="";
          setTimeout(() => {
            document.getElementById("qrinput").focus();
          }, 1000);
        }  
      }
      else if (features.stok_durumu == 5) {
        (new Audio(onaygerekmektedir)).play();
        Swal.fire({
          icon: "error",
          title: "ANAKART ONAYI VERİLMEDİ...",
          text: "Bu anakart Hüseyin Bey tarafından onaylanmadığı için cihaza tanımlama yapılamaz." 
        }); 
        if(document.getElementById("qrinput")){
          document.getElementById("qrinput").value="";
          setTimeout(() => {
            document.getElementById("qrinput").focus();
          }, 1000);
        }  
      }
      else{
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
  
  event.preventDefault();
  setTimeout(() => {
    document.getElementById("qrinput").focus();
  }, 1000);
}

var lastResult;

function onScanSuccess(decodedText, decodedResult) {
  if (decodedText !== lastResult) {
    lastResult = decodedText;
    Swal.close();
    document.getElementById('qrinput').value = decodedText;
    enterMethod();
    
    if (html5QrcodeScanner) {
      html5QrcodeScanner.clear().then(() => {
        console.log('QR kod okuyucu durduruldu.');
      }).catch((err) => {
        console.error('QR kod okuyucu durdurulamadı: ', err);
      });
    }
  }
  document.getElementById("qrinput").focus();
}

var html5QrcodeScanner;

function openQrScanner() {
  document.getElementById("qrinput").focus();
  Swal.fire({
    title: 'QR Kod Okutunuz',
    html: '<div id="qr-reader" style="width:100%;"></div>',
    confirmButtonText: "KAPAT",  
    confirmButtonColor: '#DD6B55',
    didOpen: () => {
      html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", { fps: 10, qrbox: 250 });
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
  function capitalize(s) {
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
          
          $('#featureContainer').append('<div class="col-md-12" style="font-weight: 600;padding: 7px;background: #dddddd;color: #071063;margin-bottom: 10px;">Stok Kayıtlarını Tanımla</div>');
          $('#featureContainer').append(
            '<div class="input-group col-md-12" style="padding-left:10px;padding-right:10px">' +
            '<div class="input-group-prepend">' +
            '<span class="input-group-text" onclick="openQrScanner()" style="background: #071063;color: white;"><i class="fas fa-qrcode"></i></span></div>' +
            '<input id="qrinput" onkeydown="handleKeyDown(event)" type="text" class="form-control" style="background: #fdffb9;" placeholder="Barkod tarayıcınız kullanarak QR okutunuz veya parça seri numarasını giriniz...">' +
            '</div>'
          );

          features.forEach(function(feature) {
            $('#featureContainer').append(
              '<div class="form-group col-md-4 p-2" style="padding-left:10px;padding-right:10px">' +
              '<label style="margin-left: 10px;margin-right:5px;" for="ABC' + feature.cihaz_stok_id + '">' + capitalize(feature.stok_tanim_ad)+ '</label>' +
              '<div class="input-group col-md-12" style="padding-left:10px;padding-right:10px">' +
              '<div class="input-group-prepend">' +
              '<span class="input-group-text" style="border: 1px solid #cfcfcf; background: #e7e7e7; color: black;"><i class="fas fa-cube"></i></span></div>' +
              '<input type="text" onfocus="this.blur();" style="font-size: small;background:#ffdada80;" name="parca_seri_numaralar[]" class="seriinputs form-control A'+feature.stok_tanim_grup_kod.replace(".","")+feature.stok_tanim_prefix+'" placeholder="' +feature.stok_tanim_grup_kod+"/"+feature.stok_tanim_prefix+'-'+ capitalize(feature.stok_tanim_ad) + '">' +
              '</div>' +
              '</div>'
            );
          });
          document.getElementById("qrinput").focus();
        }
      });
    } else {
      $('#featureContainer').empty();
    }
  });
});
</script>

<script>
document.querySelectorAll('.seriinputs').forEach(function(input) {
  input.addEventListener('focus', function() {
    document.getElementById('qrinput').focus();
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
        (new Audio(sound_tekrar_okutma)).play();
        document.getElementById('qrinput').focus();
        tekrar = 1;
        return;
      }
    });
    if(tekrar == 0) {
      document.getElementById("successread").style.display = "flex";
      const myTimeout = setTimeout(setSuccessNotify, 1500);
      function setSuccessNotify() {
        document.getElementById("successread").style.display = "none";
      }
      (new Audio(sound_basarili)).play();
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
    document.getElementById("successread").style.display = "flex";
    const myTimeout = setTimeout(setSuccessNotify, 1500);
    function setSuccessNotify() {
      document.getElementById("successread").style.display = "none";
    }
    (new Audio(sound_basarili)).play();
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
    (new Audio(sound_tanimlanmamis)).play();
    document.getElementById('qrinput').focus();
    if(document.getElementById("qrinput")){
      document.getElementById("qrinput").value="";
    } 
  }
  if(document.getElementById("qrinput")){
    document.getElementById("qrinput").value="";
  }
  setTimeout(() => {
    document.getElementById("qrinput").focus();
  }, 1000);
}

function formatBarkod(barkod) {
  if (barkod.endsWith('/')) {
    barkod = barkod.slice(0, -1);
  }
  let firstLetterIndex = barkod.search(/[A-Za-z]/);
  if (firstLetterIndex !== -1) {
    return barkod.slice(0, firstLetterIndex) + '/' + barkod.slice(firstLetterIndex);
  }
  return barkod;
}

let str = '';
let timer = null;
function handleKeyDown(event) {
  if (timer) {
    clearTimeout(timer);
  }
  timer = setTimeout(() => {
    document.getElementById("qrinput").value=formatBarkod(document.getElementById("qrinput").value);
    enterMethod(); 
  }, 500);
}
</script>

<script>
$(document).ready(function(){
  $('#ekle_urun').on('change', function(e){
    var urun_id = $(this).val();
    $.post('<?=base_url("urun/get_renkler/")?>'+urun_id, {}, function(result){
      if ( result && result.status != 'error' ) {
        var renkler = result.data;
        var select = '<select name="ekle_renk" id="ekle_renk" class="select2 form-control rounded-0">';
        for( var i = 0; i < renkler.length; i++) {
          select += '<option value="'+ renkler[i].id +'">'+ renkler[i].renk +'</option>';
        }
        select += '</select>';
        $('#urun_renk_div').empty().html(select);
        $('#ekle_renk').select2();
      }
      else {
        alert('Hata : ' + result.message );
      }					
    });
  });
});
</script>
