 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
  <div class="row mt-2">
    <div class="col mb*0">
      <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">YENİ KAYIT EKLE</h3>
              </div>
              <div class="card-body">
                <form action="<?=base_url("cihaz/showroom_kaydet")?>" method="post"></form>
                <div class="row">
                  <div class="col-3">
                    <select class="form-control" name="showroom_cihaz_bolum_no" id="">
                       <option value="">Showroom Seçiniz</option>
                      <option value="1">ADANA SHOWROOW</option>
                        <option value="2">İSTANBUL SHOWROOW</option>
                                <option value="3">ANKARA SHOWROOW</option>
                    </select>
                  </div>
                  <div class="col-3">
                       <select class="form-control" name="showroom_cihaz_urun_no" id="">
                           <option value="">Ürün Seçiniz</option>
                      <option value="8">UMEX PLUS</option>
                      <option value="1">UMEX LAZER</option>
                      <option value="2">UMEX DIODE</option>
                      <option value="3">UMEX EMS</option>
                      <option value="4">UMEX GOLD</option>
                      <option value="5">UMEX SLIM</option>
                      <option value="6">UMEX S</option>
                      <option value="7">UMEX Q</option>

                    </select>
                  </div>
                  <div class="col-4">
                    <input type="text" class="form-control" name="showroom_cihaz_seri_no" placeholder="Cihaz Seri Numarasını Giriniz">
                  </div>
                   <div class="col-2">
                    <button style="    width: -webkit-fill-available;" class="btn btn-success">KAYDET</button>
                  </div>
                </div>
</form>
              </div>
              <!-- /.card-body -->
            </div>
    </div>
  </div>
  <div class="row">
  <section class="content col-md-4">
    <div class="card card-dark">
      <div class="card-header with-border">
        <h3 class="card-title mt-1">ADANA SHOWROOM</h3>
         
      </div>
      <div class="card-body">
        
      </div>
    </div>
  </section>
  <section class="content col-md-4">
    <div class="card card-dark">
      <div class="card-header with-border">
        <h3 class="card-title mt-1">İSTANBUL SHOWROOM</h3>
       
      </div>
      <div class="card-body">
        
      </div>
    </div>
  </section>
  <section class="content col-md-4">
    <div class="card card-dark">
      <div class="card-header with-border">
        <h3 class="card-title mt-1">ANKARA SHOWROOM</h3>
        
      </div>
      <div class="card-body">
        
      </div>
    </div>
  </section>
  </div>
</div>