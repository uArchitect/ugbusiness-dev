 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
 
<section class="content text-md">
  <div class="row">
    <div class="col-md-3">
    <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Yeni Kayıt Oluştur</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
             <!-- Form structure remains the same -->
<form onsubmit="mysub();">
    <div class="card-body">
        <div class="form-group mb-0">
            <label for="serialNumber">Seri Numarası</label>
            <input type="text" required class="form-control" id="serialNumber" name="serialNumber" placeholder="Cihaz Seri No Giriniz">
            <small id="serialNumberError" class="form-text text-danger" style="display:none;">Seri numarası 'UG' ile başlamalı ve belirtilen son dört kombinasyonla bitmelidir.</small>
        </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        <button type="submit" class="btn btn-success">Kayıt Oluştur</button>
    </div>
</form>

<script>
function mysub(){
  var serialNumber = document.getElementById("serialNumber").value;
        var errorMessage = document.getElementById("serialNumberError");

        // Log to ensure the serial number is being captured correctly
        console.log(serialNumber);

        // Define the regex pattern for the serial number
        var regex = /^UG\d{9}(UX01|DX01|MS01|GX01|TR01|US01|QX01|UP01)$/;

        // Check if the serial number matches the pattern
        if (!regex.test(serialNumber)) {
            errorMessage.style.display = "block"; // Show error message
            event.preventDefault(); // Prevent form submission
        } else {
            errorMessage.style.display = "none"; // Hide error message
           
        }
}
</script>

            </div>
    </div>
    <div class="col-md-9">
      
<div class="card card-dark" style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - Parametreler - Üretim Planlama</h3>
                <a href="<?=base_url("uretim_planlama/add")?>" type="button" class="btn btn-primary btn-sm" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Kayıt Ekle</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="width: 42px;">ID</th> 
                    <th>Cihaz Adı</th>
                    <th>Seri Numarası</th>
                    <th >Cihaz Görsel 1</th>
                    <th >Cihaz Görsel 2</th>
                    <th >Sözleşme S.1</th>
                    <th >Sözleşme S.2</th>
                    <th >Teslim T.</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $count=0; foreach ($kurulum_data as $kdata) : ?>
                      <?php $count++?>
                    <tr>
                      <td><?=$count?></td> 
                      <td><?=$kdata->urun_adi?></td>
                      <td><?=$kdata->seri_numarasi?></td>
                      <td><?=$kdata->c1?></td>
                      <td><?=$kdata->c2?></td>
                      <td><?=$kdata->s1?></td>
                      <td><?=$kdata->s2?></td>
                      <td><?=$kdata->tt?></td>




                    </tr>
                  <?php  endforeach; ?>
                  </tbody>
                  <tfoot>
                   <tr>
                    <th style="width: 42px;">ID</th> 
                    <th>Cihaz Adı</th>
                    <th>Seri Numarası</th>
                    <th >Cihaz Görsel 1</th>
                    <th >Cihaz Görsel 2</th>
                    <th >Sözleşme S.1</th>
                    <th >Sözleşme S.2</th>
                    <th >Teslim T.</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->



    </div>
  </div>
             
</section>
            </div>

 