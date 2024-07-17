 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
 
<section class="content text-md">
<div class="card col-12 card-dark" style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - Parametreler - Satış Temsilci Taban Fiyat Limitleri</h3>
                <a href="<?=base_url("baslik/baslik_havuz_tanimla_view")?>" type="button" class="btn btn-primary btn-sm" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Kayıt Ekle</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped nowrap">
                  <thead>
                  <tr>
                    <th style="width: 42px;">ID</th> 
                    <th>Kullanıcı Ad Soyad</th>
                    <th>Ürün Adı</th>
                    <th>Satış Fiyatı Alt Limit</th>
                    <th>Kapora Fiyatı Alt Limit</th>
                    <th>Peşinat Fiyatı Alt Limit</th>
                    <th>Limit Koruması</th>
                    <th>İşlem</th> 
                  </tr>
                  </thead>
                  <tbody>
                    <?php $count=0; foreach ($limitler as $limit) : ?>
                  
                    <tr>
                      <td>    <?=$limit->satis_fiyat_limit_id?> </td> 
                      <td><i class="far fa-file-alt" style="margin-right:5px;opacity:1"></i> 
                       <?=$limit->kullanici_ad_soyad?> 
                    </td>
                      <td style="display: flex;">
                        <i class="far fa-file-alt" style="margin-right:5px;opacity:0.8"></i>
                        <?=$limit->urun_adi?>
                      </td>
                      <td><i class="far fa-file-alt" style="margin-right:5px;opacity:1"></i> 
                       <?=number_format($limit->satis_fiyat_alt_limit,2)?> ₺ 
                    </td>
                      <td>
                        <i class="far fa-file-alt" style="margin-right:5px;opacity:0.8"></i>
                        <?=number_format($limit->kapora_fiyat_alt_limit,2)?> ₺
                      </td>
                      <td>
                        <i class="far fa-file-alt" style="margin-right:5px;opacity:0.8"></i>
                        <?=number_format($limit->pesinat_fiyat_alt_limit,2)?> ₺
                      </td>
                      <td>
                         
                      </td>
                      <td>
                          <a target="_blank" type="button" class="btn btn-primary btn-xs"><i class="fa fa-qrcode" style="font-size:12px" aria-hidden="true"></i> QR Yazdır</a>
                        
                      </td>
                       
                    </tr>
                  <?php  endforeach; ?>
                  </tbody>
                 
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
</section>
            </div>