 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
<div class="card card-danger col-md-6">
 
 <div class="card-body">
 <form action="<?=base_url("musteri/karaliste_view")?>" method="POST">
 <div class="row">
 
 
 <div class="col-md-9">
 <label for="exampleInputEmail1">Tekrar Aranmak İstemeyen Müşteri Numarası</label>
 <input type="text" required name="kara_liste_iletisim_numarasi" id="exampleInputEmail1" class="form-control">
 </div>
 <div class="col-md-3">
 <label for="exampleInputEmasil1">&nbsp;</label>
 <button type="submit" id="exampleInputEmasil1" class="btn btn-block btn-success btn-lg">Kaydet</button>
 </div>
 </div>
 
 </form>
 
 
 </div>
 
 </div>
<section class="content text-md">
<div class="card card-dark" style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - TEKRAR ARANMAK İSTEMEYEN MÜŞTERİ LİSTESİ</h3>
                   </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="width: 42px;">ID</th> 
                    <th>Müşteri İletişim Numarası</th>
                    <th>Kaydeden Kullanıcı</th>
                    <th style="width: 130px;">Kayıt Tarihi</th> 
                  </tr>
                  </thead>
                  <tbody>
                    <?php $count=0; foreach ($numaralar as $numara) : ?>
                      <?php $count++?>
                    <tr>
                      <td><?=$count?></td> 
                      <td> 
                       <?=$numara->kara_liste_iletisim_numarasi?> 
                    </td>
                      
                    <td> 
                       <?=$numara->kullanici_ad_soyad?> 
                    </td>
                    <td> 
                       <?=date("d.m.Y H:i",strtotime($numara->kara_liste_kayit_tarihi))?> 
                    </td>
                        
                    </tr>
                  <?php  endforeach; ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th style="width: 42px;">ID</th> 
                    <th>Müşteri İletişim Numarası</th>
                    <th>Kaydeden Kullanıcı</th>
                    <th style="width: 130px;">Kayıt Tarihi</th> 
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
</section>
            </div>