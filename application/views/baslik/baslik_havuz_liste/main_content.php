 
 <div class="content-wrapper" style="padding-top:10px">
 
<section class="content text-md">
<div class="card col-12 card-dark" style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - Parametreler - Departman Yönetimi</h3>
                <a href="<?=base_url("baslik/baslik_havuz_tanimla_view")?>" type="button" class="btn btn-primary btn-sm" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Kayıt Ekle</a>
              </div>
               
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped nowrap">
                  <thead>
                  <tr>
                    <th style="width: 42px;">ID</th> 
                    <th>Başlık Adı</th>
                    <th>Başlık Seri Numarası</th>
                    <th style="width: 130px;">Cihaz Adı</th>
                    <th style="width: 130px;">Cihaz Seri Numarası</th>
                    <th style="width: 130px;">İşlem</th> 
                  </tr>
                  </thead>
                  <tbody>
                    <?php $count=0; foreach ($basliklar as $baslik) : ?>
                  
                    <tr>
                      <td>    <?=$baslik->baslik_havuz_id?> </td> 
                      <td><i class="far fa-file-alt" style="margin-right:5px;opacity:1"></i> 
                       <?=$baslik->baslik_adi?> 
                    </td>
                      <td style="display: flex;">
                        <i class="far fa-file-alt" style="margin-right:5px;opacity:0.8"></i>
                        <?=$baslik->baslik_seri_numarasi?>
                      </td>
                      <td><i class="far fa-file-alt" style="margin-right:5px;opacity:1"></i> 
                       <?=$baslik->urun_adi?> 
                    </td>
                      <td style="display: flex;">
                        <i class="far fa-file-alt" style="margin-right:5px;opacity:0.8"></i>
                        <?=$baslik->cihaz_seri_numarasi?>
                      </td>
                      <td>
                          <a href="<?=site_url("baslik/print_havuz/$baslik->baslik_havuz_id")?>" target="_blank" type="button" class="btn btn-primary btn-xs"><i class="fa fa-qrcode" style="font-size:12px" aria-hidden="true"></i> QR Yazdır</a>
                          <a type="button" onclick="confirm_action('Silme İşlemini Onayla','Seçilen bu kaydı silmek istediğinize emin misiniz ? Bu işlem geri alınamaz.','Onayla','<?=base_url('baslik/baslik_havuz_sil/').$baslik->baslik_havuz_id?>');" class="btn btn-danger btn-xs"><i class="fa fa-times" style="font-size:12px" aria-hidden="true"></i> Kayıt Sil</a>
                        
                      </td>
                       
                    </tr>
                  <?php  endforeach; ?>
                  </tbody>
                 
                </table>
              </div> 
            </div> 
</section>
            </div>