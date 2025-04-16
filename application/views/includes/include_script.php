
<!-- jQuery -->
<script src="<?=base_url("assets")?>/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?=base_url("assets")?>/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?=base_url("assets")?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- DataTables  & Plugins -->
<script src="<?=base_url("assets")?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url("assets")?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=base_url("assets")?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=base_url("assets")?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?=base_url("assets")?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?=base_url("assets")?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?=base_url("assets")?>/plugins/jszip/jszip.min.js"></script>
<script src="<?=base_url("assets")?>/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?=base_url("assets")?>/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?=base_url("assets")?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?=base_url("assets")?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?=base_url("assets")?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script src="<?=base_url("assets")?>/plugins/select2/js/select2.full.min.js"></script>
<!-- ChartJS -->
<script src="<?=base_url("assets")?>/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?=base_url("assets")?>/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?=base_url("assets")?>/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?=base_url("assets")?>/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?=base_url("assets")?>/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?=base_url("assets")?>/plugins/moment/moment.min.js"></script>
<script src="<?=base_url("assets")?>/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?=base_url("assets")?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="<?=base_url("assets")?>/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- Summernote -->
<script src="<?=base_url("assets")?>/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?=base_url("assets")?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url("assets")?>/dist/js/adminlte.js"></script>


<script src="<?=base_url("assets")?>/plugins/dropzone/min/dropzone.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?=base_url("assets")?>/dist/js/pages/dashboard.js"></script>
<script src="<?=base_url("assets")?>/dist/js/custom.js"></script>
<script src="<?=base_url("assets")?>/plugins/inputmask/jquery.inputmask.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 

<script>


function toggleDiv() {
   
    var selectElement = document.getElementById("talep_sonuc_no");


    var sehirElement = document.getElementById("talep_sehir_no");
    var ilceElement = document.getElementById("talep_ilce_no");
if(selectElement != null && sehirElement != null && ilceElement != null){

  if (selectElement.value === "6" || selectElement.value === "7" || selectElement.value === "8") {
    
    sehirElement.removeAttribute('required');
    ilceElement.removeAttribute('required');
    } else {
     
      sehirElement.setAttribute('required', 'required');
    ilceElement.setAttribute('required', 'required');
    }
}
 
}

 

            




var dataTable;
function showAlert() {


  var inputValueAdSoyad = $('#formAdSoyad').val();
  var inputValueTelefon = $('#formTelefon').val();
  var inputValueDepartman = $('#formDepartman').val();
  // DataTable varsa yok et
  if (dataTable) {
        dataTable.destroy();
    }
      $.ajax({
          type: 'POST',
          url: '<?php echo base_url("kullanici/getContactData"); ?>',
          data: { filterAdSoyad: inputValueAdSoyad,filterTelefon: inputValueTelefon,filterDepartman: inputValueDepartman },
          success: function(response) {
            
            var jsonObject = JSON.parse(response);

            // Convert the object to an array
            var jsonArray = Object.values(jsonObject);
                      dataTable =$('#examplecontactss').DataTable({
                        data : jsonArray,  scrollY: '135px', ordering: false,
                              columns: [
                                  { data: 'kullanici_ad_soyad' },
                                  { data: 'departman_adi' },
                                  { data: 'kullanici_bireysel_iletisim_no' }
                              ]
                          });



                      }
                  });

      


 
        }

    





    
        dataTable =$('#examplecontactss').DataTable({
                        data : null,
                        language: {
        emptyTable: "<i class='fa fa-eye'></i><br><b>Veri Gösterilmiyor</b><br>Rehber kayıtlarına erişmek için filtreleme yapınız."
    },  scrollY: '135px', ordering: false,
                              columns: [
                                  { data: 'kullanici_ad_soyad' },
                                  { data: 'departman_adi' },
                                  { data: 'kullanici_bireysel_iletisim_no' }
                              ]
                          });
   $(function () {
        var params = window.location.pathname;
        params = params.toLowerCase();
 
        if (params != "/") {
            $(".nav-sidebar li a").each(function (i) {
                var obj = this;
                var url = $(this).attr("href");
                if (url == "" || url == "#") {
                    return true;
                }
                url = url.toLowerCase();
                if (url.indexOf(params) > -1) {
                    $(this).parent().addClass("active open menu-open").css("background", "rgba(255,255,255,.1)").css("font-weight", "bolder").css("margin-left", "0px").css("padding-left", "0px");
                    $(this).parent().parent().addClass("active open menu-open");
                    $(this).parent().parent().parent().addClass("active open menu-open");
                    $(this).parent().parent().parent().parent().addClass("active open menu-open");
                    $(this).parent().parent().parent().parent().parent().addClass("active open menu-open");
                    return false;
                }
            });
        }
    });

   function formatState (state) { 
  if (!state.id) { return state.text; }
  var $state = $(
    '<span style="font-family:arial !important;"><span class="'+$(state.element).data('icon')+'" /> <span style="font-weight: 500;font-family:Source Sans Pro;font-weigth:lighter !important">'+state.text +     '</span></span>'
 );
 return $state;
};










  $(function () {
//Initialize Select2 Elements
$('.menu4').click(function(){
  $.post("http://192.168.2.211/umexbusiness/kullanici/list_data",{},function (responses) {
    $(".list").html(responses);
  });
})








    //Initialize Select2 Elements
    $('.select2').select2({
      templateResult: formatState
    })
    $('#summernote').summernote({
      height: 350   
    })
    $('#summernote2').summernote({
      height: 50   
    })


    $('.summernotees').summernote({
      height: 290 ,
      placeholder: 'Detayları giriniz.'     
    })


    $('#summernotesms').summernote({
      height: 90 ,
      placeholder: 'İstek bildirim sms metnini giriniz. Özelleştirmek için aşağıda bulunanan sms parametrelerini kullanabilirsiniz.',
     toolbar:[]    
    })
    $('#summernotebirimsms').summernote({
      height: 90 ,
      placeholder: 'İstek bildirim sms metnini giriniz. Özelleştirmek için aşağıda bulunanan sms parametrelerini kullanabilirsiniz.',
     toolbar:[]    
    })
    $('#summernotesms2').summernote({
      height: 90 ,
      placeholder: 'İstek bildirim sms metnini giriniz. Özelleştirmek için aşağıda bulunanan sms parametrelerini kullanabilirsiniz.',
    toolbar:[]    
    })
    $('#summernotesms3').summernote({
      height: 90 ,
      placeholder: 'İstek bildirim sms metnini giriniz. Özelleştirmek için aşağıda bulunanan sms parametrelerini kullanabilirsiniz.',
     toolbar:[]    
    })
    $('#summernotesms4').summernote({
      height: 90 ,
      placeholder: 'İstek bildirim sms metnini giriniz. Özelleştirmek için aşağıda bulunanan sms parametrelerini kullanabilirsiniz.',
      toolbar:[]    
    })
    $('#summernotesms5').summernote({
      height: 90 ,
      placeholder: 'İstek bildirim sms metnini giriniz. Özelleştirmek için aşağıda bulunanan sms parametrelerini kullanabilirsiniz.',
      toolbar:[]    
    })
    $('#summernote3').summernote({
      height: 210   
    })
    $('#summernotemusteri').summernote({
      height: 60,
      placeholder: 'İşletme Adresini Giriniz.',
      toolbar:[]   
    })

    $('#summernoteonay').summernote({
      height: 90,
      placeholder: 'Bu siparişler ilgili diğer kullanıcılarının görebileceği bir not / uyarı / açıklama metni girebilirsiniz.',
      toolbar:[]   
    })
    $('#summernote4').summernote({
      height: 120,
      placeholder: 'Bu bölüme istek ile alakalı detaylı bilgileri yazınız.',
      toolbar:[]   
    }) 
    
    $('#summernotesiparisnot').summernote({
      height: 60,
      placeholder: 'Bu bölüme ürün ile ilgili sipariş notu girebilirsiniz.',
      toolbar:[]   
    }) 
    $('#summernotearizaaciklama').summernote({
      height: 60,
      placeholder: 'Bu bölüme başlık ile ilgili arıza / tamir notunuzu girebilirsiniz.',
      toolbar:[]   
    }) 
    $('#summernote5').summernote({
      height: 150,
      placeholder: 'Bu bölüme demirbaş ile alakalı detaylı bilgileri yazınız.',
      toolbar:[]   
    }) 
    $('#summernote9').summernote({
      height: 150,
      placeholder: 'Bu bölüme yönlendirme notunuzu yazınız.',
      toolbar:[]   
    }) 
    
    
    $('#summernote8').summernote({
      height: 85,
      placeholder: 'Bu bölüme müşteri ile görüşmenizin detaylarını yazınız.',
      toolbar:[]   
    })
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    $('#secilen_cihazlar').on('select2:opening', function(e) {
       
    });
    

    $.ajax({
                    url: "<?php echo site_url('Istek_kategori/getKategoriler'); ?>/" + 1,
                    type: "GET",
                    dataType: "json",
                    success:function(data){
                   
                      <?php 
                      if (empty($istek))
                      {
                        ?>

$('#istek_kategori_no').empty().append('<option value="">İstek Kategorisi Seçiniz...</option>');
                      $('#is_tip_no').empty().append('<option value="">İş Tipi Seçiniz...</option>');
            
                        $.each(data, function(index, item) {
                            $('#istek_kategori_no').append('<option value="' + item.istek_kategori_id + '">' + item.istek_kategori_adi + '</option>');
                        }); 
                        <?php
                      }
                     ?>

                    }
                });

   $('#istek_birim_no').on("select2:select",function(){
                var il_id = $(this).val();
                console.log("SEÇİLEN : "+il_id);
                $.ajax({
                    url: "<?php echo site_url('Istek_kategori/getKategoriler'); ?>/" + il_id,
                    type: "GET",
                    dataType: "json",
                    success:function(data){
                      console.log(data);
                      $('#istek_kategori_no').empty().append('<option value="">İstek Kategorisi Seçiniz...</option>');
                      $('#is_tip_no').empty().append('<option value="">İş Tipi Seçiniz...</option>');
            
                        $.each(data, function(index, item) {
                            $('#istek_kategori_no').append('<option value="' + item.istek_kategori_id + '">' + item.istek_kategori_adi + '</option>');
                        }); 
                    }
                });
            });
     
 $('#istek_kategori_no').on("select2:select",function(){
                var il_id = $(this).val();
                $('#is_tip_no').empty().append('<option value="">İş Tipi Seçiniz...</option>');
            
                $.ajax({
                    url: "<?php echo site_url('Is_tip/getIstipleri'); ?>/" + il_id,
                    type: "GET",
                    dataType: "json",
                    success:function(data){
                      $('#is_tip_no').empty().append('<option value="">İş Tipi Seçiniz...</option>');
            
                        $.each(data, function(index, item) {
                            $('#is_tip_no').append('<option value="' + item.is_tip_id + '">' + item.is_tip_adi + '</option>');
                        }); 
                    }
                });
            });
     



            $('.select2urun').select2({
  templateResult: formatOutput
});

function formatOutput (optionElement) {
  if (!optionElement.id) { return optionElement.text; }
  var $state = $(
    '<span><strong>' + optionElement.element.text + '</strong> ' + optionElement.element.getAttribute('data-example') + '</span>'
  );
  return $state;
};



    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    $('input[id="my-checkbox"]').bootstrapSwitch({
                    'size': 'small',
                    'onColor': 'success',
                    'offColor': 'danger'
                });
                $('input[id="my-checkbox"]:checked').bootstrapSwitch('state', true);
                document.getElementById("my-button").addEventListener("click", function() {
                    document.querySelectorAll('#my-checkbox').forEach(checkbox => checkbox.attr(checked));
                });
    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    })

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

  })
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })

  // DropzoneJS Demo Code Start
  Dropzone.autoDiscover = false

  // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  var previewNode = document.querySelector("#template")
  previewNode.id = ""
  var previewTemplate = previewNode.parentNode.innerHTML
  previewNode.parentNode.removeChild(previewNode)

  var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "https://ugbusiness.com.tr/dokuman/dragDropUpload", // Set the url
    thumbnailWidth: 80,
    maxFiles: 1,
    thumbnailHeight: 80,
    parallelUploads: 20,
    renameFile: function (file) {
    // Yeni dosya adını burada oluşturabilirsiniz.
    return file.renameFilename= new Date().getTime()+"." + file.name.split('.').pop();
  },
    acceptedFiles: "application/pdf,.png,.jpg,.jpeg,.doc,.docx,.xls,.xlsx,.csv,.tsv,.ppt,.pptx,.pages,.odt,.rtf,.mp4",
    previewTemplate: previewTemplate,
    autoQueue: true, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
  })
 
  myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
  
  })

  // Update the total progress bar
  myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
  })

  var fileNames = "";

myDropzone.on("sending", function(file, xhr, formData) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1";
    
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
    
    // Get the file name and push it to the array
    fileNames = file.renameFilename;
});

if (document.getElementById('form-dokuman')){
document.getElementById("form-dokuman").addEventListener("submit", function(event) {
 
  
    // Assuming you have an input element in your form with the name "fileNames"
    document.getElementById("form-dokuman").elements["fileNames"].value = fileNames; 
});

}

if (document.getElementById('form-revizyon')){
document.getElementById("form-revizyon").addEventListener("submit", function(event) {
   
  if(fileNames==""){
    Swal.fire({
      icon: "error",
      title: "Dosya Seçilmedi...",
      text: "Revizyon kayıt işlemini tamamlamak için dosya yüklemeniz gerekmektedir.!" 
    });
            event.preventDefault();
  }
 // Assuming you have an input element in your form with the name "fileNames"
 document.getElementById("form-revizyon").elements["revizyonFileNames"].value = fileNames; 
});
  
}


if (document.getElementById('form-banner')){
  document.getElementById("form-banner").addEventListener("submit", function(event) {
    document.getElementById("form-banner").elements["fileNames"].value = fileNames; 
  });
}


if (document.getElementById('form-demirbas')){
document.getElementById("form-demirbas").addEventListener("submit", function(event) {
   // Assuming you have an input element in your form with the name "fileNames"
   document.getElementById("form-demirbas").elements["fileNames"].value = fileNames; 
});
  
}

if (document.getElementById('form-custom')){

  document.getElementById("form-custom").addEventListener("submit", function(event) {
   // Assuming you have an input element in your form with the name "fileNames"
   document.getElementById("form-custom").elements["fileNames"].value = fileNames; 
   
});
}


  // Hide the total progress bar when nothing's uploading anymore
  myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0"
  })

  // Setup the buttons for all transfers
  // The "add files" button doesn't need to be setup because the config
  // `clickable` has already been specified.
  document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
  }
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true)
  }
  // DropzoneJS Demo Code End

  
function formatText (icon) {
    return $('<span><i class="fas ' + $(icon.element).data('icon') + '"></i> ' + icon.text + '</span>');
};
 
  
function changeStatus(e){
  
  //tamamlandı
  if(e.value == 4){
    document.getElementById("tamamlandi_istek_notu").style.display = "block";
    document.getElementById("istek_not").setAttribute('required', 'true');
  }else{
  
    document.getElementById('istek_not').removeAttribute('required');
    document.getElementById("tamamlandi_istek_notu").style.display = "none";
    
  }
}





</script>


