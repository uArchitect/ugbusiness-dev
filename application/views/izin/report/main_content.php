<div class="content-wrapper" style="padding-top:10px">
 
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> İSTEK BİLDİRİM RAPORU
                    <small class="float-right">Rapor Tarihi: 2/10/2014</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  Bildirimi Oluşturan
                  <address>
                 <strong><?=$istek->kullanici_ad_soyad?></strong><br>
                    Departman : <?=$istek->departman_adi?><br>
                    Email Adresi : <?=$istek->kullanici_email_adresi?><br>
                    İletişim No : <?=$istek->kullanici_bireysel_iletisim_no?><br>
                    Dahili No : <?=$istek->kullanici_dahili_iletisim_no?><br>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  Yönetici Bilgisi
                  <address>
                    <strong><?=$yonetici[0]->kullanici_ad_soyad?></strong><br>
                    Departman : <?=$yonetici[0]->departman_adi?><br>
                    Email Adresi : <?=$yonetici[0]->kullanici_email_adresi?><br>
                    İletişim No : <?=$yonetici[0]->kullanici_bireysel_iletisim_no?><br>
                    Dahili No : <?=$yonetici[0]->kullanici_dahili_iletisim_no?><br>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                İstek Bildirim Kodu :<b>  #<?=$istek->istek_kodu?></b><br>
                  <br>
                  <b>İstek Bildirim Tarihi:</b> <?=$istek->istek_kayit_tarihi?><br>
                  <?php
                    if($istek->istek_onay_tarihi){
                        ?><b>Onaylanma Tarihi:</b> <?=$istek->istek_onay_tarihi?><?php
                    }
                    if($istek->istek_red_tarihi){
                        ?><b>Reddedilme Tarihi:</b> <?=$istek->istek_onay_tarihi?><?php
                    }
                  ?> 
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
<div class="row">
    <div class="col-12">
    <?=$istek->istek_aciklama?>
    </div>
</div>
              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table id="example2" class="table table-striped">
                    <thead>
                    <tr>
                      <th style="border-bottom:0px solid">No</th>
                      <th style="border-bottom:0px solid">Hareket Detayları</th>
                      <th style="border-bottom:0px solid">Kullanıcı</th>
                      <th style="border-bottom:0px solid">Departman</th>
                      <th style="border-bottom:0px solid">Tarih</th>
                    
                    </tr>
                    </thead>
                    <tbody>
                        <?php $count = 0;
                            foreach ($istek_hareketleri as $istek_hareket) {
                              $count++;
                               ?>
                                    <tr>
                                        <td><?=$count?></td>
                                        <td><?=$istek_hareket->istek_hareket_detay?></td>
                                        <td><?=$istek_hareket->kullanici_ad_soyad?></td>
                                        <td><?=$istek_hareket->departman_adi?></td>
                                        <td><?=$istek_hareket->istek_hareket_kayit_tarihi?></td>
                                    </tr>
                               <?php
                            }
                        ?>
                    
                  
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Raporu Yazdır</a>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<style>
    .table td, .table th {
            border-left: 1px solid #dee2e6;
       
        }

        .table {
            border-bottom: 1px solid #dee2e6;
            border-right: 1px solid #dee2e6;
        }
</style>