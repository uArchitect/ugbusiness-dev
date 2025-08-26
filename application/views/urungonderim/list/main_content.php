 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
 
<section class="content text-md" style="    margin-top: -5px;">
<div class="row">
    <div class="col-md-2">

 

            

    <div class="card card-dark">
        <div class="card-header">Yeni Gönderim Ekle</div>
        <div class="card-body">

   <div class="form-group pr-0 pl-0 mb-3">
        <label for="formClient-Code"> Cihaz Seri Numarası</label>
         
        <input type="text"  class="form-control" name="takas_alinan_seri_kod_<?=$urun->siparis_urun_id?>" placeholder="Seri no Giriniz" value="<?=$urun->takas_alinan_seri_kod?>"  autofocus="">  
      </div>


             <div class="form-group pr-0 pl-0 mb-3">
        <label for="formClient-Code"> Ürün Bilgisi  </label>
         
        <select name="yenilenmis_urun_mu" onchange="updateInputDataParametre()" id="yenilenmis_urun_mu" required class="select2 form-control rounded-0" style="width: 100%;">
          <option  value="1">HAVA HORTUMU</option> 
        </select>      
      </div>


   <div class="form-group pr-0 pl-0 mb-3">
        <label for="formClient-Code"> Miktar</label>
         
        <input type="number" min="1"  class="form-control" name="takas_alinan_seri_kod_<?=$urun->siparis_urun_id?>"   value="1"  autofocus="">  
      </div>
<button type="submit" class="btn   btn-primary" style="    width: -webkit-fill-available;"> Gönderimi Kaydet</button>

        </div>
    </div>

    </div>
    <div class="col-md-10">
         <div class="card card-dark" style="border-radius:0px !important;">
    <div class="card-header" style="background:#00264f!important">
        <h3 class="card-title"><strong>UG Business</strong> - Ürün Gönderim Takibi</h3>
        <a href="<?=base_url("musteri/ekle")?>" onclick="waiting('Yeni Müşteri Ekle');" type="button" class="btn btn-primary btn-sm" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Kayıt Ekle</a>
    </div>
    <!-- /.card-header -->
    <div class="card-body" style="    min-height: 890px !important;">
        <table id="users_table"   class="table table-bordered table-striped nowrap" style="width:100%;">
            <thead>
                <tr>
                    <th style="max-width:70px;width:70px;">ID</th>
                    <th>Müşteri Adı</th>
                    <th>Merkez Bilgisi</th> 
                    <th>Adres</th>
                    <th>İletişim Numarası</th>
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
function miktarSor(kayit_id, baslangicMiktar = 15) {
    Swal.fire({
        title: 'Miktar Giriniz',
        input: 'number',
        inputValue: baslangicMiktar,  
        inputAttributes: {
            min: 1,
            step: 1
        },
        showCancelButton: true,
        confirmButtonText: 'Onayla',
        cancelButtonText: 'Vazgeç',
        inputValidator: (value) => {
            if (!value || value < 1) {
                return 'Lütfen geçerli bir miktar giriniz'
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "<?=base_url("stok/urungelenmiktarguncelle/")?>" + kayit_id,
                method: "POST",
                data: { miktar: result.value },
                success: function(response) {
                    Swal.fire('Başarılı', 'Gelen miktar güncellendi!', 'success');
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
                    { "data": 7 },
                    { "data": 8 },
                    { "data": 9 }
                ]
            });
    
            $('#users_table').on('click', '.edit-btn', function() {
                var id = $(this).data('id');
                window.location.href = "<?php echo site_url('users/edit/'); ?>" + id;
            });
    
    
        });
    </script>