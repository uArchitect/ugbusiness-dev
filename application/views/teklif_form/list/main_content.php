 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:10px">
 
<section class="content text-md">
<div class="card card-dark" style="border-radius:0px !important;">
              <div class="card-header">
              <h3 class="card-title"><strong>UG Business</strong> - Parametreler - Teklif Form Yönetimi</h3>
                <a href="<?=base_url("teklif_form/add")?>" type="button" class="btn btn-primary btn-sm" style="float: right!important;padding: 0px;padding-left: 5px;padding-right: 5px;"><i class="fa fa-plus" style="font-size:12px" aria-hidden="true"></i> Yeni Kayıt Ekle</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Müşteri Bilgisi</th>
                    <th>Teklif Tarihi</th>
                    <th>Kayıt Oluşturma Tarihi</th>
                    <th>Oluşturan Kullanıcı</th>
                    <th>İşlemler</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php   foreach ($teklif_formlari as $teklif_form) : ?>
                      
                    <tr>
                      
                      <td><i class="far fa-file-alt" style="margin-right:5px;opacity:1"></i> 
                       <?=$teklif_form->teklif_form_musteri_ad?> 
                       <?php 
                      
                       if($teklif_form->teklif_form_adetler == '[""]'){
                        ?>
<span style="color:red">*Ürün bilgileri eksik veya hatalı</span>
                        <?php
                       }
                       ?>
                    </td>
                    <td><i class="far fa-file-alt" style="margin-right:5px;opacity:1"></i> 
                       <?=date("d.m.Y",strtotime($teklif_form->teklif_form_tarihi))?> 
                    </td>
                    <td><i class="far fa-file-alt" style="margin-right:5px;opacity:1"></i> 
                       <?=date("d.m.Y H:i:s",strtotime($teklif_form->teklif_form_kayit_tarihi))?> 
                    </td>
                    <td>
                      <?=$teklif_form->kullanici_ad_soyad?>
                       
                    </td>
                    <td> <a href="<?=base_url("teklif_form/edit/".$teklif_form->teklif_form_id)?>" class="btn btn-warning">DÜZENLE</a>
                       <a href="<?=base_url("teklif_form/yazdir/".$teklif_form->teklif_form_id)?>" target="_blank" class="btn btn-primary">PDF OLUŞTUR</a>
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