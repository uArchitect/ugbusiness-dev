 
 <div class="content-wrapper" style="padding-top:10px">
 
<section class="content text-md">
  <div class="row">


  <div class="badge bg-dark text-md p-4 col-12 mb-1" style=" font-weight:500;border: 1px solid #093d7d;background: radial-gradient(circle, rgb(0 0 0) 0%, rgb(4 36 69) 25%, rgb(2 21 41) 56%, rgb(4 36 69) 100%);">
  <img src="<?=base_url("assets/dist/img/umex-logo-white.png")?>" width="150">
                 <br>
                 <div style="height:15px;"></div>
                 <span style="font-weight:700;font-size:x-large;">Cihaz, Bölge ve İl Bazlı Satış Raporları</span> <br>
              <div class="mt-2"></div>
                 <span style="opacity:0.5;font-weight:400;font-size:medium;">Cihaz, Bölge ve İl Bazlı Satış Raporları</span> <br>
                
                
                </div>




      <div class="card card-dark col-6 p-0 mr-1" style="flex:1;border-radius:0px !important;">
              <div class="card-header" style="background:#05192f">
              <h3 class="card-title"><strong>UG Business</strong> - Cihaz Yönetimi - Veri Analizi</h3>
               </div>
               
              <div class="card-body p-2">
              <div class="ml-2">
                <h4 class="mb-0"><i class="fas fa-folder-open" style="color:#009b1c"></i> Adet Bazlı Satış Raporu</h4>
                <h6 style="font-weight:normal">Cihazlara göre adet bazlı satış raporu görüntülenmektedir.</h6>
                
              </div>
                <table id="example2" class="table table-bordered table-striped nowrap m-0">
                  <thead>
                  <tr>
                    <th style=" padding-top:5px;padding-bottom:5px;font-weight:bold;  border-bottom:0px solid">Ürün Kodu</th>
                    <th style=" padding-top:5px;padding-bottom:5px;font-weight:bold;  border-bottom:0px solid">Cihaz Adı</th>
                    <th style=" padding-top:5px;padding-bottom:5px;font-weight:bold;  border-bottom:0px solid">Satış Adet</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($satis_verileri as $veri) : ?>
                    <tr>
                      <td><?=$veri->urun_kod?></td>  
                      <td><?=$veri->urun_adi?> </td>
                      <td><i class="fas fa-angle-double-right" style="margin-right:5px;opacity:1"></i> <?=$veri->toplam?> </td>
                    </tr>
                  <?php  endforeach; ?>
                  </tbody>
                  
                </table>
              </div>
             
              <div class="card-footer">
            <span class="text-sm" style="opacity:0.8 "><i class="fas fa-exclamation-circle"></i>  Veriler Teslimat ve Sipariş Bilgilerine Göre Oluşturulmuştur </span>
          </div>
            </div>
           





            <div class="card card-dark col-6 p-0 mr-1" style="border-radius:0px !important;">
              <div class="card-header" style="background:#05192f">
              <h3 class="card-title"><strong>UG Business</strong> - Cihaz Yönetimi - Veri Analizi</h3>
               </div>
              
              <div class="card-body p-2">
              <div class="ml-2">
                <h4 class="mb-0"><i class="fas fa-map-marked-alt" style="color:#009b1c"></i> İl Bazlı Satış Raporu</h4>
                <h6 style="font-weight:normal">Cihazlara göre il bazlı satış raporu görüntülenmektedir.</h6>
              </div>
                <table id="rapor1" class="table table-bordered table-striped nowrap">
                  <thead>
                  <tr>
                    <th style="padding-top:5px;padding-bottom:5px;font-weight:bold; border-bottom:0px solid">Ürün Kodu</th>
                    <th style="padding-top:5px;padding-bottom:5px;font-weight:bold; border-bottom:0px solid">Şehir</th>
                    <th style="padding-top:5px;padding-bottom:5px;font-weight:bold; border-bottom:0px solid">Cihaz Adı</th>
                    <th style="padding-top:5px;padding-bottom:5px;font-weight:bold; border-bottom:0px solid">Satış Adet</th>
               
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($sehir_verileri as $veri) : ?>
                    <tr>
                      <td><?=$veri->urun_kod?></td>  
                      <td><i class="far fa-user-circle" style="margin-right:5px;opacity:1"></i> <?=$veri->sehir_adi?> </td>
                      <td><i class="fas fa-angle-double-right" style="margin-right:5px;opacity:1"></i> <?=$veri->urun_adi?> </td>
                      <td><i class="fas fa-angle-double-right" style="margin-right:5px;opacity:1"></i> <?=$veri->toplam?> </td>
                    </tr>
                  <?php  endforeach; ?>
                  </tbody>
                  
                </table>
              </div>
              
              <div class="card-footer">
            <span class="text-sm" style="opacity:0.8 "><i class="fas fa-exclamation-circle"></i>  Veriler Teslimat ve Sipariş Bilgilerine Göre Oluşturulmuştur </span>
          </div>
            </div>
            







            
 






            </div>

</section>
            </div>