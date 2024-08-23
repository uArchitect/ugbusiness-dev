<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
  <section class="content text-md">
    <div class="row">
      <div class="col-md-3">

        <div class="card card-dark" style="border-radius:0px !important;">
          <div class="card-header">
            <h3 class="card-title"><strong>UG Business</strong> - Tüm Kapılar</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
              <?php
              $this->load->view("kapi/kapi_view.php");
              $this->load->view("kapi/kapi_view.php");
              $this->load->view("kapi/kapi_view.php");
              $this->load->view("kapi/kapi_view.php");
              $this->load->view("kapi/kapi_view.php");
              $this->load->view("kapi/kapi_view.php");
              $this->load->view("kapi/kapi_view.php");
              $this->load->view("kapi/kapi_view.php");
              $this->load->view("kapi/kapi_view.php");
              $this->load->view("kapi/kapi_view.php");
              $this->load->view("kapi/kapi_view.php"); 
              ?>     
          </div>
        </div>

      </div>


      <div class="col" style="padding-left:0">
      
      <div class="row">
        
        <div class="col-md-12 p-0" style="margin-bottom: -11px;">

          <div class="card card-dark" style="border-radius:0px !important;">
            <div class="card-header">
              <h3 class="card-title"><strong><i class="fas fa-door-closed"></i> Kapı / Kontrol Cihazı Detayları ve Yönetim</strong></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0" style="min-height:100px">
                  
              <div class="row">
                <div class="col" style="max-width:100px">
                  <img src="<?=base_url("assets/dist/img/perkotek-p20.png")?>" style="width:100px">
                </div>
                <div class="col ml-3" style="    margin: auto;">
                  <span style="font-size:25px;font-weight:bold">ANA GİRİŞ 1</span>
                  <div class="d-flex">
                  <span><b>Marka :</b>Perkotek </span>
                  <span class="ml-3"><b>Model :</b> P20 (Magic Pass 20656)</span>
                  
                  <span class="ml-3"><b>Cihaz IP Adresi :</b> 192.168.2.211</span>
                  <span class="ml-3"><b>Cihaz Seri Numarası :</b> 12565211</span>
                  
                  </div>
                </div>
              </div>


            </div>
          </div>

        </div>


        <div class="col-md-4 p-0 mt-0">

          <div class="card card-danger" style="border-radius:0px !important;">
            <div class="card-header">
              <h3 class="card-title"><strong><i class="fas fa-user-lock"></i> Geçiş Yetkisi Olmayan Kişiler</strong></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0" style="min-height:622px">
            <input type="text" id="customSearchBox" placeholder="Geçiş Yetkisi Olmayan Kullanıcı Ara..." style="width: -webkit-fill-available; margin: 8px; margin-bottom: 0px; border: 1px solid #cbcbcb; padding: 12px; border-radius: 4px;">
            <table id="examplekapikullanici" class="table table-bordered table-striped"    >
                  <thead>
                  <tr>
                    <th style="padding:5px;"> </th>
                    <th style="padding:5px;">Ad Soyad</th>
                    <th style="padding:5px;">İşlem</th> 
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                    foreach ($kullanicilar_pasif as $kullanici) {
                      if($kullanici->kullanici_id == 7){
                        continue;
                      }
                      ?>
                      <tr>
                        <td></td>
                        <td><?=$kullanici->kullanici_ad_soyad?></td>
                        <td>
                        <a href="<?=base_url("kapi/success_door/$kullanici->kullanici_id")?>" class="btn btn-dark btn-xs">Yetki Ver</a>
                        </td>
                    </tr>
                      <?php
                    }
                    ?>
                  </tbody>
                </table>
                </div>
          </div>

          </div>
          <div class="col-md-4 p-0 pl-1 pr-1">

<div class="card card-success" style="border-radius:0px !important;">
  <div class="card-header">
    <h3 class="card-title"><strong><i class="fas fa-lock-open"></i> Geçiş Yetkisi Olan Kişiler</strong></h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body p-0" style="min-height:622px">
  <input type="text" id="customSearchBox2" placeholder="Geçiş Yetkisi Olan Kullanıcı Ara..." style="width: -webkit-fill-available; margin: 8px; margin-bottom: 0px; border: 1px solid #cbcbcb; padding: 12px; border-radius: 4px;">
            <table id="examplekapikullanici2" class="table table-bordered table-striped"    >
                  <thead>
                  <tr>
                    <th style="padding:5px;"> </th>
                    <th style="padding:5px;">Ad Soyad</th>
                    <th style="padding:5px;width:108px">İşlem</th> 
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                    foreach ($kullanicilar_aktif as $kullanici) {
                      if($kullanici->kullanici_id == 7){
                        continue;
                      }
                      ?>
                      <tr>
                        <td></td>
                        <td><?=$kullanici->kullanici_ad_soyad?></td>
                        <td>
                          <a href="<?=base_url("kapi/disable_door/$kullanici->kullanici_id")?>" class="btn btn-danger btn-xs">Yetki Kaldır</a>
                        </td>
                    </tr>
                      <?php
                    }
                    ?>
                  </tbody>
                </table>
  </div>
</div>

</div>
<div class="col-md-4 p-0">

<div class="card card-primary" style="border-radius:0px !important;">
  <div class="card-header">
    <h3 class="card-title"><strong><i class="fas fa-sign-out-alt"></i> Kapı Giriş / Çıkış Log Kayıtları</strong></h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body p-0" style="min-height:622px">
        
  </div>
</div>

</div>






      </div>


      </div>



    </div>
  </section>
</div>

<style>
  #examplekapikullanici_wrapper .dataTables_filter input {
    width: 100%;
}
.dataTables_filter {
            display: none;
        }
  </style>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
    

    
    var customSearchBox = document.getElementById("customSearchBox");
    customSearchBox.addEventListener("input", function () {
      var table = $('#examplekapikullanici').DataTable();
    table.search(this.value).draw();
    });

    var customSearchBox2 = document.getElementById("customSearchBox2");
    customSearchBox2.addEventListener("input", function () {
      var table = $('#examplekapikullanici2').DataTable();
    table.search(this.value).draw();
    });
});
    </script>