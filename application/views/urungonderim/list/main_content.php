 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
 
<section class="content text-md" style="    margin-top: -5px;">
<div class="row">
    <div class="col-md-2">

 

            

    <div class="card card-dark">
        <div class="card-header">Yeni Gönderim Ekle</div>
        <div class="card-body">
<form id="urunForm" action="<?=base_url("stok/urungonderimyenikayit")?>" method="post">
   <div class="form-group pr-0 pl-0 mb-3">
        <label for="formClient-Code"> Cihaz Seri Numarası</label>
         
        <input type="text" required  class="form-control" name="seri_numarasi" placeholder="Seri no Giriniz" autofocus="">  
      </div>


             <div class="form-group pr-0 pl-0 mb-3">
        <label for="formClient-Code"> Ürün Bilgisi  </label>
         
        <select name="urun_no"  required class="select2 form-control rounded-0" style="width: 100%;">
          <option  value="1">HAVA HORTUMU</option> 
               <option  value="2">BUZ BAŞLIK</option> 
                    <option  value="3">SOĞUK BAŞLIK</option> 
        </select>      
      </div>


   <div class="form-group pr-0 pl-0 mb-3">
        <label for="formClient-Code"> Miktar</label>
         
        <input type="number" min="1"  class="form-control" name="miktar"   value="1"  autofocus="">  
      </div>

       <div class="form-group pr-0 pl-0 mb-3">
        <label for="formClient-Code"> Açıklama</label>
         
        <input type="text" required  class="form-control" name="gonderim_aciklama" placeholder="Açıklama Giriniz" autofocus="">  
      </div>
<button type="submit" class="btn   btn-primary" style="    width: -webkit-fill-available;"> Gönderimi Kaydet</button>


</form>
        </div>
    </div>

    </div>
    <div class="col-md-10">
         <div class="card card-dark" style="border-radius:0px !important;">
    <div class="card-header" style="background:#00264f!important">
        <h3 class="card-title"><strong>UG Business</strong> - Ürün Gönderim Takibi</h3>
          </div>
    <!-- /.card-header -->
    <div class="card-body" style="    min-height: 890px !important;">
        <table id="users_table"   class="table table-bordered table-striped nowrap" style="width:100%;">
            <thead>
                <tr>
                    <th style="max-width:70px;width:70px;">ID</th>
                    <th>Müşteri Adı</th>  
                    <th>Adres / İletişim</th> 
                    <th>Cihaz Seri No</th>
                    <th>Ürün</th>
                    <th>Gönderilen</th>
                            <th>Gelen</th>
                    <th style="width:120px">İşlem</th>
                
                    
                </tr>
            </thead>
        </table>
    </div>
</div>
    </div>
</div>






         
</section>






<script>
document.getElementById("urunForm").addEventListener("submit", function() {
    var btn = document.getElementById("submitBtn");
    btn.disabled = true;                 // butonu pasif yap
    btn.innerText = "Kaydediliyor...";   // kullanıcıya bilgi ver
});
</script>








            </div>



            



            <style>
      
      

      .custom-href:hover {
            text-decoration: underline;
          }
    
          .users_table_processing{
            margin-top:50px;
          }
       
         
    table.dataTable tbody th, table.dataTable tbody td {
        padding: 8px 10px  ;
    }
     </style>
    
    
    
    
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
 


    <script>
function miktarSor(kayit_id, baslangicGelen = 15, baslangicGiden = 0, aciklama = "") {
    Swal.fire({
        title: 'Miktar Giriniz',
        html:
             '<label>Gönderilen Miktar:</label><br>' +
            '<input id="gidenMiktar" type="number" value="'+baslangicGiden+'" min="0" step="1" class="swal2-input"><br>'+
            '<label>Gelen Miktar:</label><br>' +
            '<input id="gelenMiktar" type="number" value="'+baslangicGelen+'" min="1" step="1" class="swal2-input"><br>'+
             '<label>Açıklama:</label><br>' +
            '<input id="aciklama" type="text" value="'+aciklama+'" min="1" step="1" class="swal2-input"><br>',
       
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: 'Onayla',
        cancelButtonText: 'Vazgeç',
        preConfirm: () => {
            let gelen = document.getElementById('gelenMiktar').value;
            let giden = document.getElementById('gidenMiktar').value;
   let aciklama = document.getElementById('aciklama').value;

            if (gelen == 0 && giden == 0) {
                Swal.showValidationMessage('Lütfen geçerli bir gelen - giden miktar giriniz');
                return false;
            }

            if (giden < 0) {
                Swal.showValidationMessage('Giden miktar negatif olamaz');
                return false;
            }

            return { gelen: gelen, giden: giden, aciklama: aciklama };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "<?=base_url("stok/urungelenmiktarguncelle/")?>" + kayit_id,
                method: "POST",
                data: { gelen: result.value.gelen, giden: result.value.giden, aciklama: result.value.aciklama },
                success: function(response) {
                    Swal.fire('Başarılı', 'Miktarlar güncellendi!', 'success');
                    location.reload();
                },
                error: function() {
                    Swal.fire('Hata', 'Bir sorun oluştu', 'error');
                }
            });
        }
    });
}
</script>


<script>
function kayitsil(kayit_id) {
    Swal.fire({
        title: 'Kayıt Silinecek! Onaylıyor Musunuz ?', 
        showCancelButton: true,
        confirmButtonText: 'Onayla',
        cancelButtonText: 'Vazgeç', 
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "<?=base_url("stok/urungonderimkayitsil/")?>" + kayit_id,
                method: "POST",
                data: { miktar: result.value },
                success: function(response) {
                    Swal.fire('Başarılı', 'Kayıt Silindi!', 'success');
                    location.reload();
                },
                error: function() {
                    Swal.fire('Hata', 'Bir sorun oluştu', 'error');
                }
            });
        }
    });
}
</script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#users_table').DataTable({
                "processing": true,
                "serverSide": true,
                "pageLength": 16,
                scrollX: true,
                "ajax": {
                    "url": "<?php echo site_url('stok/urungonderim_ajax'); ?>",
                    "type": "GET"
                },
                "language": {
                        "processing": '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>'
                    },
                "columns": [
                    { "data": 0 },
                    { "data": 1 },
                    { "data": 2 },
                    { "data": 3 },
                    { "data": 4 },
                    { "data": 5 },
                    { "data": 6 },
                    { "data": 7 } 
                ]
            });
    
            $('#users_table').on('click', '.edit-btn', function() {
                var id = $(this).data('id');
                window.location.href = "<?php echo site_url('users/edit/'); ?>" + id;
            });
    
    
        });
    </script>